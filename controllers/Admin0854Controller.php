<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\forms\LoginForm;
use app\models\Category;
use app\models\forms\CategoryForm;

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

        $model = new LoginForm();
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
            return $this->render('posts');
        } else { $this->redirect('./login'); }
    }
    
    public function actionCategory()
    {
        if (!\Yii::$app->user->isGuest) {
            
            $category_form = new CategoryForm();
            if ($category_form->load(Yii::$app->request->post()) && $category_form->createCategory()) {
                Yii::$app->session->setFlash('contactFormSubmitted');

                return $this->refresh();
            } else {
                $categories = Category::find()->all();
                return $this->render('category', [
                    'categories' => $categories,
                    'category_form' => $category_form,
                ]);
            }
            
        } else { $this->redirect('./login'); }
    }
    
    public function actionComments()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->render('comments');
        } else { $this->redirect('./login'); }
    }
    
    public function actionUser()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->render('user');
        } else { $this->redirect('./login'); }
    }
}
