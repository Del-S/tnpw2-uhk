<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\Pagination;
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
        if(array_key_exists('slug', $_GET)) {
            $guid = $_GET['slug'];
        }
        $pagination = new Pagination(['totalCount' => 0]);

        $category = db\Category::find()->where(['guid' => $guid])->one();
        if(is_object($category)) {
            $category_meta = db\CategoryMeta::find()->where(['category_id' => $category->category_id])->one();
            $posts = [];
            $categories = [];
            if(is_object($category_meta)) {
                if(array_key_exists('categoryPosts', Yii::$app->params)) {
                    $count = Yii::$app->params['categoryPosts'];
                } else { $count = 5; }
                
                $category_meta = $category_meta->getAttributes();
                $category_meta = $category_meta['meta_value'];
                $post_ids = array_filter(str_getcsv($category_meta, ';'));
                $posts_query = db\Posts::find()->where(['IN', 'post_id', $post_ids]);
                $pagination = new Pagination(['totalCount' => $posts_query->count(), 'defaultPageSize' => $count, 'validatePage' => true]);
                $posts = $posts_query->offset($pagination->offset)
                    ->limit($pagination->limit)
                    ->andWhere(['post_status' => 'publish'])
                    ->orderBy(['post_date' => SORT_DESC])
                    ->all();

                foreach($posts as $post) {
                    $categories[$post->post_id] = $post->getCategories(true);
                }
            } 
            return $this->render('category', [
                'category' => $category,
                'categories' => $categories,
                'posts' => $posts,
                'pagination' => $pagination,
            ]);  
        } else {  $this->redirect('../index'); }
    }
}
