<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\db;

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
        if(is_object($post)) {
            $categories = $post->getCategories(false);
            return $this->render('post', [
                'post' => $post,
                'categories' => $categories,
            ]);  
        } else {  $this->redirect('../index'); }
    }
}
