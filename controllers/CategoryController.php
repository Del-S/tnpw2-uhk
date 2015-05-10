<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\db;

class CategoryController extends Controller
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
        $category = db\Category::find()->where(['guid' => $guid])->one();
        if(is_object($category)) {
            $category_meta = db\CategoryMeta::find()->where(['category_id' => $category->category_id])->one();
            $posts = [];
            $categories = [];
            if(is_object($category_meta)) {
                $category_meta = $category_meta->getAttributes();
                $category_meta = $category_meta['meta_value'];
                $post_ids = array_filter(str_getcsv($category_meta, ';'));
                $count = 0;
                foreach($post_ids as $k => $post_id) {
                    $post = db\Posts::find()->where(['post_id' => $post_id])->one();
                    $categories[$count] = $post->getCategories(true);
                    $posts[$count] = $post;
                    $count++;
                }
            } 
            return $this->render('category', [
                'category' => $category,
                'categories' => $categories,
                'posts' => $posts,
            ]);  
        } else {  $this->redirect('../index'); }
    }
}
