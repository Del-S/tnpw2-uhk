<?php

namespace app\models\db;

use yii\db\ActiveRecord;

class Posts extends ActiveRecord
{
    public $user_display_name = '';
    
    public function savePost($attributes) {
        foreach($attributes as $k => $v) {
            if($this->hasAttribute($k)) {
                $this->$k = $v;
            }
        }
        $this->save();
    }
}
