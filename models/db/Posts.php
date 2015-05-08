<?php

namespace app\models\db;

use yii\db\ActiveRecord;

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
}
