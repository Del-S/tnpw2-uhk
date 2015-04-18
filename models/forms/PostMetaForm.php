<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\models\User;
use app\models\db\PostMeta;
use app\models\Formate;

class PostMetaForm extends Model
{
    public $meta_id;
    public $post_id;
    public $meta_key;
    public $meta_value;

    public function __construct( $data = [], $config = [] ) {
        foreach($data as $k => $v) {
            if($this->hasProperty($k)) {
                if($k == 'meta_value') { 
                    $test = @unserialize($v);
                    if($test !== false) { $v = $test; }
                }
                $this->$k = $v;
            }
        }
        
        parent::__construct();
    }
    
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['meta_key', 'meta_value' ], 'default', 'value' => ''],
        ];
    }

    public function savePostMeta($post_id)
    {
        if ($this->validate()) {
            $this->post_id = $post_id;
            $this->meta_value = serialize($this->meta_value);
            $post_meta = PostMeta::find()->where(['post_id' => $this->post_id, 'meta_key' => $this->meta_key])->one(); 
            $attributes = $this::getAttributes();
            if(!isset($post_meta) || $post_meta == '') {
                $post_meta = new PostMeta();
                $post_meta->savePostMeta($attributes);
            } else { 
                $post_meta->isNewRecord = false;
                $post_meta->savePostMeta($attributes);
            }
            return true;
        } else {
            return false;
        }
    }
}
