<?php

namespace app\models;

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
}
