<?php

namespace app\models\db;

use yii\db\ActiveRecord;

class Comments extends ActiveRecord
{
    public $post_title = "";
    
    public function saveComment($attributes) {
        foreach($attributes as $k => $v) {
            if($this->hasAttribute($k)) {
                $this->$k = $v;
            }
        }
        $this->save();
    }
    
    public function getCommentInfo() {
        $comment_info = $this->comment_author." ";
        $comment_info .= date('j.n.Y', strtotime($this->comment_date));
        return $comment_info;
    }
}
