<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\UploadedFile;
use app\models\forms\UploadForm;
use app\models\User;
use app\models\db;
use app\models\forms;

class Admin0854Controller extends Controller
{
    
    public $layout = 'admin';
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'posts', 'post_new', 'post_detail', 'upload', 'category', 'category_detail', 'comments', 'user', 'user_detail', 'options', 'logout'],
                        'roles' => ['@'],
                    ],
                    // everything else is denied
                ],
            ],
        ];
    }
    
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->render('index');
        }

        $model = new forms\LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('./index');
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect('./login');
    }
    
    /* Post controllers */

    public function actionPosts()
    {     
        $rights = Yii::$app->user->identity->getRights();
        if( $rights >= 0 && $rights <= 2 ) {
            $posts = db\Posts::find()
                ->select(['posts.*', 'user.user_display_name'])
                ->leftJoin('user', '`user`.`user_id` = `posts`.`post_author`')
                ->all();       
                
            foreach($posts as $post) {
                $categories = db\CategoryMeta::find()
                    ->select(['category_name'])
                    ->leftJoin('category', '`category`.`category_id` = `category_meta`.`category_id`')
                    ->where(['LIKE', 'meta_value', '"'.$post->post_id.'"'])
                    ->with('category')
                    ->column();
                $cat_string = "";
                foreach ($categories as $k => $cat_name ) {
                    $cat_string .= $cat_name.", ";
                }
                $cat_string = substr($cat_string, 0, -2);
                $post->cat_display_name = $cat_string;
            }
                
            return $this->render('posts', [
                'posts' => $posts,
            ]);  
        } else {  $this->redirect('./index'); }
    }
    
    public function actionPost_detail() {
        $rights = Yii::$app->user->identity->getRights();
        if( $rights >= 0 && $rights <= 2 ) {
            if($rights == 2 && $post->post_author == Yii::$app->user->id) { $this->redirect('./posts'); }
                
            $post_id = $_GET['post'];
            if(is_numeric($post_id)) {
                $post = db\Posts::find()->where(['post_id' => $post_id])->one();
                $post_attributes = array_combine($post->attributes(), $post->getAttributes());

                $categories_attr['meta_key'] = "post_categories";
                $categories_attr['meta_value'] = db\CategoryMeta::find()->select(['category_id'])->where(['LIKE', 'meta_value', '"'.$post_id.'"'])->column();
            } else { $this->redirect('./posts'); }
            
            $categories = db\Category::find()->all();
            $category_meta_form = new forms\CategoryMetaForm($categories_attr);
            $post_form = new forms\PostForm($post_attributes);
             
            if (($post_form->load(Yii::$app->request->post()) && $post_form->updatePost($post)) && ($category_meta_form->load(Yii::$app->request->post())) && $category_meta_form->saveCategoryMeta()) {
                return $this->refresh();
            } else {  
                $errors = $post_form->errors;
                return $this->render('post_detail', [
                    'post_form' => $post_form,
                    'category_meta_form' => $category_meta_form,
                    'categories' => $categories,
                    'errors' => $errors,
                ]);
            }  
        } else { $this->redirect('./posts'); }
    }
    
    public function actionPost_new() {
        $rights = Yii::$app->user->identity->getRights();
        if( $rights >= 0 && $rights <= 2 ) {
            $categories = db\Category::find()->all();
            $post_form = new forms\PostForm();
            $category_meta_form = new forms\CategoryMetaForm();
            if (($post_form->load(Yii::$app->request->post()) && $post_form->createPost()) && ($category_meta_form->load(Yii::$app->request->post())) && $category_meta_form->saveCategoryMeta()) {
                $post_id = $post_form->getPostID();
                return $this->redirect('./post_detail?post='.$post_id);
            } else {   
                $errors = $post_form->errors;
                return $this->render('post_new', [
                    'post_form' => $post_form,
                    'category_meta_form' => $category_meta_form,
                    'categories' => $categories,
                    'errors' => $errors,
                ]);
            }
        } else { $this->redirect('./posts'); }
    }
    
    public function actionPost_trash() {
        if (!\Yii::$app->user->isGuest) {
            $rights = Yii::$app->user->identity->getRights();
            if( $rights >= 0 && $rights <= 1 ) {
                $post_id = $_GET['post'];
                if(is_numeric($post_id)) {
                    $post = db\Posts::find()->where(['post_id' => $post_id])->one();
                    $post->post_status = 'trash';
                    $post->save();
                }
            }
            $this->redirect('./posts');
        } else { $this->redirect('./login'); }
    }
    
    /* Post controllers -- END */
    
    /* Category controllers */
    
    public function actionCategory() {
        $rights = Yii::$app->user->identity->getRights();
        if( $rights >= 0 && $rights <= 2 ) {
            $category_form = new forms\CategoryForm();
            if ($category_form->load(Yii::$app->request->post()) && $category_form->createCategory()) {
                Yii::$app->session->setFlash('contactFormSubmitted');
                    return $this->refresh();
            } else {
                $errors = $category_form->errors;
                $categories = db\Category::find()
                    ->select(['category.*', 'category_meta.meta_value as post_ids'])
                    ->leftJoin('category_meta', '`category_meta`.`category_id` = `category`.`category_id`')
                    ->all();
                
                return $this->render('category', [
                    'categories' => $categories,
                    'category_form' => $category_form,
                    'errors' => $errors,
                ]);
            }
        } else { $this->redirect('./index'); }
    }
    
    public function actionCategory_detail() {
        $rights = Yii::$app->user->identity->getRights();
        if( $rights >= 0 && $rights <= 1 ) {
            $category_id = $_GET['cat'];
            if(is_numeric($category_id)) {
                $category = db\Category::find()->where(['category_id' => $category_id])->one();
                $category_attributes = array_combine($category->attributes(), $category->getAttributes());
            } else { $this->redirect('./category'); }
            
            $category_form = new forms\CategoryForm($category_attributes);
            if ($category_form->load(Yii::$app->request->post()) && $category_form->updateCategory($category)) {
                return $this->redirect('./category');
            } else {  
                $errors = $category_form->errors;
                return $this->render('category_detail', [
                    'category_form' => $category_form,
                    'errors' => $errors,
                ]);
            }
        } else { $this->redirect('./category'); }
    }
    
    public function actionCategory_trash() {
        if (!\Yii::$app->user->isGuest) {
            $rights = Yii::$app->user->identity->getRights();
            if( $rights >= 0 && $rights <= 1 ) {
                $category_id = $_GET['cat'];
                if(is_numeric($category_id)) {
                    $category = db\Category::find()->where(['category_id' => $category_id])->one();
                    $category->delete();
                }
            }
            $this->redirect('./category');
        } else { $this->redirect('./login'); }
    }
    
    /* Category controllers -- END */
    
    /* Comment controllers */
    
    public function actionComments() {
        $rights = Yii::$app->user->identity->getRights();
        if( $rights >= 0 && $rights <= 2 ) {              
            $comments = db\Comments::find()
                ->select(['comments.*', 'posts.post_title'])
                ->leftJoin('posts', '`comments`.`post_id` = `posts`.`post_id`')
                ->all(); 
                
            return $this->render('comments', [
                'comments' => $comments,
            ]);
        } else { $this->redirect('./index'); }
    }
    
    public function actionComment_trash() {
        if (!\Yii::$app->user->isGuest) {
            $rights = Yii::$app->user->identity->getRights();
            if( $rights >= 0 && $rights <= 2 ) {
                $comment_id = $_GET['comm'];
                if(is_numeric($comment_id)) {
                    $comment = db\Comments::find()->where(['comment_id' => $comment_id])->one();
                    $comment->delete();
                }
            }
            $this->redirect('./comments');
        } else { $this->redirect('./login'); }
    }
    
    /* Comment controllers -- END */
    
    /* User controllers */
    
    public function actionUser() {
        $rights = Yii::$app->user->identity->getRights();
        if($rights == 0) {
            $users = User::find()->all();
            return $this->render('user', [
                'users' => $users,
            ]);   
        } else if ($rights > 0 && $rights <= 2) { $id = Yii::$app->user->id; $this->redirect('./user_detail?user='.$id); 
        } else { $this->redirect('./index'); }
    }
    
    public function actionUser_detail() {
        $user_id = $_GET['user'];
        if(is_numeric($user_id)) {
            $user = User::find()->where(['user_id' => $user_id])->one();
            $user_attributes = array_combine($user->attributes(), $user->getAttributes()); 
        } else { 
            $user = User::find()->where(['user_id' => Yii::$app->user->id])->one();
            $user_attributes = array_combine($user->attributes(), $user->getAttributes()); 
        }
            
        $user_form = new forms\UserForm($user_attributes);
        if ($user_form->load(Yii::$app->request->post()) && $user_form->updateUser($user)) {
            return $this->refresh();
        } else {    
            $errors = $user_form->errors;
            return $this->render('user_detail', [
                'user_form' => $user_form,
                'errors' => $errors,
            ]);
        } 
    }
    
    public function actionUser_new() {
        if(Yii::$app->user->identity->getRights() == 0) {
            $user_form = new forms\UserForm();
            $user_form->setScenario('createUser');
            if ($user_form->load(Yii::$app->request->post()) && $user_form->createUser()) {
                $user_id = $user_form->getUserID();
                return $this->redirect('./user_detail?user='.$user_id);
            } else {     
                $errors = $user_form->errors;
                return $this->render('user_new', [
                    'user_form' => $user_form,
                    'errors' => $errors,
                ]);
            }
        } else { $id = Yii::$app->user->id; $this->redirect('./user_detail?user='.$id); }    
    }
    
    public function actionUser_trash() {
        if (!\Yii::$app->user->isGuest) {
            if(Yii::$app->user->identity->getRights() == 0) {
                $user_id = $_GET['u'];
                if(is_numeric($user_id)) {
                    $user = User::find()->where(['user_id' => $user_id])->one();
                    $user->delete();
                }
                $this->redirect('./user');
            } else { $id = Yii::$app->user->id; $this->redirect('./user_detail?user='.$id); }   
        } else { $this->redirect('./login'); }
    }
    
    /* User controllers -- END */
    
    /* Upload Files controller */
    
    public function actionUpload()
    {
        $upload_form = new UploadForm();
        if (Yii::$app->request->isPost) {
            $upload_form->file = UploadedFile::getInstances($upload_form, 'file');

            if ($upload_form->file && $upload_form->validate()) {
                foreach ($upload_form->file as $file) {
                    $curr_dir = getcwd();
                    $check = $file->saveAs($curr_dir.'/uploads/' . $file->baseName . '.' . $file->extension);
                }
            }
        }

        return $this->render('upload', ['upload_form' => $upload_form]);
    }
    
    /* Upload Files controller -- END */
}
