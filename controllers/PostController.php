<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\db;
use app\models\forms\CommentForm;

class PostController extends Controller
{

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionView()
    {
        $guid = '';
        $category_guid = '';
        if(array_key_exists('slug', $_GET)) {
            $guid = $_GET['slug'];
        }
        if(array_key_exists('category', $_GET)) {
            $category_guid = $_GET['category'];
        }
        $category = db\Category::find()->where(['guid' => $category_guid])->one();
        $post = db\Posts::find()->where(['guid' => $guid])->one();
        $comment_form = new CommentForm;
        if ($comment_form->load(Yii::$app->request->post()) && $comment_form->comment($post->post_id)) { 
            return $this->refresh();
        }
        $comments = db\Comments::find()->where(['post_id' => $post->post_id])->all();
        if(is_object($post)) {
            $categories = $post->getCategories(false);
            return $this->render('post', [
                'post' => $post,
                'category' => $category,
                'categories' => $categories,
                'comments' => $comments,
                'comment_form' => $comment_form,
            ]);  
        } else {  $this->redirect('../index'); }
    }
}
