<?php

namespace app\models\db;

use yii\db\ActiveRecord;

class CategoryMeta extends ActiveRecord
{
    public function saveCategoryMeta($attributes) {
        foreach($attributes as $k => $v) {
            if($this->hasAttribute($k)) {
                $this->$k = $v;
            }
        }
        $this->save();
    }
}
