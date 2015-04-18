<?php

namespace app\models\db;

use yii\db\ActiveRecord;

class PostMeta extends ActiveRecord
{
    public function savePostMeta($attributes) {
        foreach($attributes as $k => $v) {
            if($this->hasAttribute($k)) {
                $this->$k = $v;
            }
        }
        $this->save();
    }
}
