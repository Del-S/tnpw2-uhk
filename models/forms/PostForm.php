<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\models\User;
use app\models\db\Posts;
use app\models\Formate;

class PostForm extends Model
{
    public $post_id;
    public $post_author;
    public $post_date;
    public $post_date_gmt;
    public $post_content;
    public $post_title;
    public $post_excerpt;
    public $post_status;
    public $guid;
    public $post_parent;
    public $post_type;
    public $comment_status;
    public $comment_count;
    public $errors;

    public function __construct( $data = [], $config = [] ) {
        foreach($data as $k => $v) {
            if($this->hasProperty($k)) {
                $this->$k = $v;
            }
        }
        
        if(!isset($this->post_author) || $this->post_author == '') { $this->post_author = Yii::$app->user->getID(); }
        
        parent::__construct();
    }
    
    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'post_title' => '',
            'guid' => 'Odkaz příspěvku',
            'post_content' => '',
            'post_excerpt' => 'Stručný výpis příspěvku',
        ];
    }
    
    public function getPostID() {
        return $this->post_id;
    }
    
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // required and default values
            [['post_title'], 'required'],
            [['post_author' ], 'default', 'value' => 1],
            [['post_parent', 'comment_count' ], 'default', 'value' => 0],
            [['post_content', 'post_excerpt', 'guid', 'guid' ], 'default', 'value' => ''],
            [['post_date', 'post_date_gmt' ], 'default', 'value' => '0000-00-00 00:00:00'],
            [['post_status' ], 'default', 'value' => 'publish'],
            [['comment_status' ], 'default', 'value' => 'open'],
            [['post_type' ], 'default', 'value' => 'post'],
        ];
    }

    public function updatePost($post)
    {
        if ($this->validate()) {
            if(!isset($this->guid) || $this->guid == '') { $this->guid = $this->post_title; }
            $formate = new Formate();
            $this->guid = $formate->createGuid($this->guid);
            
            $attributes = $this::getAttributes();
            $post->isNewRecord = false;
            $post->savePost($attributes);
            
            if($post->hasErrors()) { 
                $this->errors = $post->getErrors();
                return false;  
            }
            return true;
        } else {
            return false;
        }
    }
    
    public function createPost()
    {    
        if ($this->validate()) {
            if(!isset($this->guid) || $this->guid == '') { $this->guid = $this->post_title; }
            $formate = new Formate();
            $this->guid = $formate->createGuid($this->guid);
            
            $this->post_date = date('Y-m-d H:i:s');
            $this->post_date_gmt = gmdate('Y-m-d H:i:s');
            
            $post = new Posts();
            /* Check if url already exists */
            $count = $post->find()->where(['like', 'guid', $this->guid.'%', false])->count();
            if($count != 0) {
                $count++;
                $this->guid .= "-".$count;
            }
     
            $attributes = $this::getAttributes();
            $this->post_id = $post->savePost($attributes);
            
            if($post->hasErrors()) { 
                $this->errors = $post->getErrors();
                return false;  
            }
            return true;
        } else {
            return false;
        }
    }
}
