<?php

namespace app\models\db;

use yii\db\ActiveRecord;
use yii\helpers\Url;

class Posts extends ActiveRecord
{
    public $user_display_name = '';
    public $cat_display_name = '';
    
    public function savePost($attributes) {
        foreach($attributes as $k => $v) {
            if($this->hasAttribute($k)) {
                $this->$k = $v;
            }
        }
        $this->save();
        return $this->post_id;
    }
    
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['guid'], 'unique'],
        ];
    }
    
    public function editExcerpt() {
        if(empty($this->post_excerpt)) {
        $this->post_excerpt = substr($this->post_content, 0, 250)."...";
        } else { $this->post_excerpt = "<p>".$this->post_excerpt."</p>"; }
    }
    
    public function getCategories($string) {
        $categories = CategoryMeta::find()
            ->select(['category_name'])
            ->leftJoin('category', '`category`.`category_id` = `category_meta`.`category_id`')
            ->where(['LIKE', 'meta_value', '"'.$this->post_id.'"'])
            ->with('category')
            ->column();
        if(!$string) { return $categories; }
        else {
            $caregory_info = "";
            if(is_array($categories)) {
                foreach($categories as $k => $cat) {
                    $caregory_info .= '<a href="'.Url::to(['category/'.$cat]).'">'.$cat."</a>, ";
                }
                $caregory_info = substr($caregory_info, 0, -2);
            }
            return $caregory_info;
        }
    }
}
