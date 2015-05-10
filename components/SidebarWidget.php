<?php
namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;
use app\models\db\Category;
use yii\helpers\Url;

class SidebarWidget extends Widget{
    public $name = ""; 
    
    public function init(){
        parent::init();
        if($this->name===null){
            $this->name = 'Sidebar Widget';
        }
    }
     
    public function run(){
        $categories = Category::find()->all();
        $sidebar_html = '<div class="widget windget_categories">';
        $sidebar_html .= '<h3>'.$this->name.'</h3>';
        if(is_array($categories)) {
            $sidebar_html .= '<ul>';
            foreach($categories as $category) {
                $sidebar_html .= '<li><a href="'.Url::to(['post/'.$category->guid]).'">'.$category->category_title.'</a></li>'; 
            }
            $sidebar_html .= '</ul>';
        }
        $sidebar_html .= '</div>';
        return $sidebar_html;
    }
}
?>
