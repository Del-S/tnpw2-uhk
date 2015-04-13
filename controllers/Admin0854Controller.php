<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\User;
use app\models\db;
use app\models\forms;

class Admin0854Controller extends Controller
{
    
    public $layout = 'admin';
    
    public function actionIndex()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->render('index');
        } else { $this->redirect('./login'); }
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

    public function actionPosts()
    {
        if (!\Yii::$app->user->isGuest) {
            $posts = db\Posts::findBySql('SELECT posts.*,user.user_display_name FROM posts LEFT JOIN user ON post_author = user_id ORDER BY post_id')->all();
            return $this->render('posts', [
                'posts' => $posts,
            ]);            
        } else { $this->redirect('./login'); }
    }
    
    public function actionCategory()
    {
        if (!\Yii::$app->user->isGuest) {
            
            $category_form = new forms\CategoryForm();
            if ($category_form->load(Yii::$app->request->post()) && $category_form->createCategory()) {
                Yii::$app->session->setFlash('contactFormSubmitted');

                return $this->refresh();
            } else {
                $errors = $category_form->errors;
                $categories = db\Category::find()->all();
                return $this->render('category', [
                    'categories' => $categories,
                    'category_form' => $category_form,
                    'errors' => $errors,
                ]);
            }
            
        } else { $this->redirect('./login'); }
    }
    
    public function actionComments()
    {
        if (!\Yii::$app->user->isGuest) {
            
            $comments = db\Comments::find()->all();
            return $this->render('comments', [
                'comments' => $comments,
            ]);
            
        } else { $this->redirect('./login'); }
    }
    
    public function actionUser()
    {
        if (!\Yii::$app->user->isGuest) {
            $users = User::find()->all();
            return $this->render('user', [
                'users' => $users,
            ]);     
        } else { $this->redirect('./login'); }
    }
    
    /* Details */
    
    public function actionPost_detail() {
        if (!\Yii::$app->user->isGuest) {
            
            $post_id = $_GET['post'];
            $post = db\Posts::find()->where(['post_id' => $post_id])->one();
            $post_attributes = array_combine($post->attributes(), $post->getAttributes());
            
            $post_form = new forms\PostForm($post_attributes);
            if ($post_form->load(Yii::$app->request->post()) && $post_form->updatePost($post)) {
                return $this->refresh();
            } else {     
                return $this->render('post_detail', [
                    'post_form' => $post_form,
                ]);
            }
            
        } else { $this->redirect('./login'); }
    }
    
    public function actionCategory_detail() {
        if (!\Yii::$app->user->isGuest) {
            
            $category_id = $_GET['cat'];
            $category = db\Category::find()->where(['category_id' => $category_id])->one();
            $category_attributes = array_combine($category->attributes(), $category->getAttributes());
            
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
            
        } else { $this->redirect('./login'); }
    }
    
    public function actionUser_detail() {
        if (!\Yii::$app->user->isGuest) {
            
            $user_id = $_GET['user'];
            $user = User::find()->where(['user_id' => $user_id])->one();
            $user_attributes = array_combine($user->attributes(), $user->getAttributes());
            
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
            
        } else { $this->redirect('./login'); }
    }
    
    /* New forms */
    
    public function actionPost_new() {
        if (!\Yii::$app->user->isGuest) {
            
            $post_form = new forms\PostForm();
            if ($post_form->load(Yii::$app->request->post()) && $post_form->createPost()) {
                $post_id = $post_form->getPostID();
                return $this->redirect('./post_detail?post='.$post_id);
            } else {   
                $errors = $post_form->errors;
                return $this->render('post_new', [
                    'post_form' => $post_form,
                    'errors' => $errors,
                ]);
            }
            
        } else { $this->redirect('./login'); }
    }
    
    public function actionUser_new() {
        if (!\Yii::$app->user->isGuest) {
            
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
            
        } else { $this->redirect('./login'); }
    }
    
    /* Trash controllers */
    
    public function actionPost_trash() {
        if (!\Yii::$app->user->isGuest) {
            $post_id = $_GET['post'];
            $post = db\Posts::find()->where(['post_id' => $post_id])->one();
            $post->post_status = 'trash';
            $post->save();
            $this->redirect('./posts');
        } else { $this->redirect('./login'); }
    }
    
    public function actionCategory_trash() {
        if (!\Yii::$app->user->isGuest) {
            $category_id = $_GET['cat'];
            $category = db\Category::find()->where(['category_id' => $category_id])->one();
            $category->delete();
            $this->redirect('./category');
        } else { $this->redirect('./login'); }
    }
    
    public function actionComment_trash() {
        if (!\Yii::$app->user->isGuest) {
            $comment_id = $_GET['comm'];
            $comment = db\Comments::find()->where(['comment_id' => $comment_id])->one();
            $comment->delete();
            $this->redirect('./comments');
        } else { $this->redirect('./login'); }
    }
    
    public function actionUser_trash() {
        if (!\Yii::$app->user->isGuest) {
            $user_id = $_GET['u'];
            $user = User::find()->where(['user_id' => $user_id])->one();
            $user->delete();
            $this->redirect('./user');
        } else { $this->redirect('./login'); }
    }
}
