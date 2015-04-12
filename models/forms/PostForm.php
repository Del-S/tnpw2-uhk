<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\models\User;
use app\models\db\Posts;
use app\models\Formate;

class PostForm extends Model
{
    public $post_author;
    public $post_date;
    public $post_date_gmt;
    public $post_content;
    public $post_title;
    public $post_excerpt;
    public $post_status;
    public $comment_status;
    public $post_name;
    public $post_parent;
    public $guid;
    public $menu_order;
    public $post_type;
    public $comment_count;

    public function __construct( $data = [], $config = [] ) {
        $this->post_author = Yii::$app->user->getID();
        
        foreach($data as $k => $v) {
            if($this->hasProperty($k)) {
                $this->$k = $v;
            }
        }
        
        parent::__construct();
    }
    
    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'post_name' => 'Post Link',
        ];
    }
    
    public function getTitle() {
        return $this->post_title;
    }
    
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['post_title'], 'required'],
            [['post_author' ], 'default', 'value' => 1],
            [['post_parent', 'menu_order', 'comment_count' ], 'default', 'value' => 0],
            [['post_content', 'post_excerpt', 'post_name', 'guid' ], 'default', 'value' => ''],
            [['post_date', 'post_date_gmt' ], 'default', 'value' => '0000-00-00 00:00:00'],
            [['post_status' ], 'default', 'value' => 'publish'],
            [['comment_status' ], 'default', 'value' => 'open'],
            [['post_type' ], 'default', 'value' => 'post'],
        ];
    }

    public function updatePost($post)
    {
        if ($this->validate()) {
            if(!isset($this->post_name) && $this->post_name == '') { $this->post_name = $this->post_title; }
            $formate = new Formate();
            $this->post_name = $formate->createGuid($this->post_name);
            
            $attributes = $this::getAttributes();
            $post->isNewRecord = false;
            $post->savePost($attributes);
            return true;
        } else {
            return false;
        }
    }
    
    public function createPost()
    {
        if ($this->validate()) {
            if(!isset($this->post_name) && $this->post_name == '') { $this->post_name = $this->post_title; }
            $formate = new Formate();
            $this->post_name = $formate->createGuid($this->post_name);
            
            $attributes = $this::getAttributes();
            $post = new Posts();
            $post->savePost($attributes);
            return true;
        } else {
            return false;
        }
    }
}
