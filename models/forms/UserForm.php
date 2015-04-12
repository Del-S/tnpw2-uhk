<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\models\User;

class UserForm extends Model
{
    public $user_id;
    public $user_login;
    public $user_pass;
    public $user_pass_check;
    public $user_nickname;
    public $user_email;
    public $user_url;
    public $user_registered;
    public $user_auth_key;
    public $user_access_token;
    public $user_status;
    public $user_display_name;

    public function __construct( $data = [], $config = [] ) {    
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
    
    public function getUserLogin() {
        return $this->user_login;
    }
    
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['user_login', 'user_pass', 'user_pass_check', 'user_nickname', 'user_email' ], 'required'],
            [['user_id' ], 'default', 'value' => NULL],
            [['user_registered' ], 'default', 'value' => '0000-00-00 00:00:00'],
            [['user_status' ], 'default', 'value' => 4],
            [['user_url', 'user_auth_key', 'user_access_token','user_display_name' ], 'default', 'value' => ''],  
        ];
    }

    public function updateUser($user)
    {
        if ($this->validate()) {            
            $attributes = $this::getAttributes();
            $user->isNewRecord = false;
            $user->saveUser($attributes);
            return true;
        } else {
            return false;
        }
    }
    
    public function createUser()
    {
        if ($this->validate()) {
            $attributes = $this::getAttributes();
            $user = new User();
            $user->saveUser($attributes);
            return true;
        } else {
            return false;
        }
    }
}
