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
    public $meta_value_old;

    public function __construct( $data = [], $config = [] ) {
        if(!empty($data)) {
            foreach($data as $k => $v) {
                if($this->hasProperty($k)) {
                    $this->$k = $v;
                }
            }
            if(array_key_exists('meta_value', $data)) {
                $this->meta_value_old = $data['meta_value'];
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
            [['post_id' ], 'default', 'value' => '0'],
            [['meta_key', 'meta_value' ], 'default', 'value' => ''],
        ];
    }

    public function savePostMeta()
    {
        if ($this->validate()) {
            $post_meta = PostMeta::find()->where(['post_id' => $this->post_id, 'meta_key' => $this->meta_key])->one();
            if(!is_object($post_meta)) {
                $post_meta = new PostMeta;
            }
            $post_meta->savePostMeta($this::getAttributes());
            if($post_meta->save()) { return true; }
            else { return false; }
        } else {
            return false;
        }
    }
}
