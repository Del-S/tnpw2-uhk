<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
//use app\models\forms\ContactForm;
use app\models\db;
use app\commands\SidebarController;

class SiteController extends Controller
{

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        if(array_key_exists('recentPosts', Yii::$app->params)) {
            $count = Yii::$app->params['recentPosts'];
        } else { $count = 10; }
        $post = [];
        $categories = [];
        $posts = db\Posts::find()->orderBy(['post_date' => SORT_DESC])->limit($count)->all();
        if(is_array($posts)) {
            foreach($posts as $post) {
                $categories[$post->post_id] = $post->getCategories(true);
            }
        }
        return $this->render('index', [
            'posts' => $posts,
            'categories' => $categories,
        ]);  
    }

    /*
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    } */
}
