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
        $guid = $_GET['slug'];
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
                'categories' => $categories,
                'comments' => $comments,
                'comment_form' => $comment_form,
            ]);  
        } else {  $this->redirect('../index'); }
    }
}
