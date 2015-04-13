<?php

namespace app\models\db;

use yii\db\ActiveRecord;

class Category extends ActiveRecord
{    
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
}