<?php

namespace app\models\db;

use yii\db\ActiveRecord;
use app\models\db;

class Category extends ActiveRecord
{    
    public $post_ids = '';
    public $post_count = '';
    
    public function saveCategory($attributes) {
        foreach($attributes as $k => $v) {
            if($this->hasAttribute($k)) {
                $this->$k = $v;
            }
        }
        $this->save();
    }
    
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['category_name'], 'unique'],
        ];
    }
    
    public function afterFind() {
        $this->post_ids = array_filter(str_getcsv($this->post_ids, ';'));
        $this->post_count = count($this->post_ids);
    }
}