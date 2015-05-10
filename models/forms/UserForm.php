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
    public $errors;

    public function __construct( $data = [], $config = [] ) {    
        foreach($data as $k => $v) {
            if($this->hasProperty($k)) {
                if($k != 'user_pass') {$this->$k = $v;}
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
            'user_login' => 'Uživatelské jméno',
            'user_pass' => 'Heslo',
            'user_pass_check' => 'Kontrola hesla',
            'user_nickname' => 'Přezdívka',
            'user_email' => 'Email (vyžadováno)',
            'user_url' => 'Webová stránka',
            'user_status' => 'Úroveň',
            'user_display_name' => 'Veřejně zobrazovat jako',
        ];
    }
    
    public function getUserID() {
        return $this->user_id;
    }
    
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['user_login', 'user_nickname', 'user_email' ], 'required'],
            ['user_email', 'email'],
            [['user_pass', 'user_pass_check' ], 'required', 'on' => 'createUser'],
            
            [['user_pass_check'], 'compare', 'compareAttribute' => 'user_pass', 'operator'=>'==', 'skipOnEmpty' => false],
            
            [['user_pass'], 'default', 'value' => ''],
            [['user_id' ], 'default', 'value' => NULL],
            [['user_registered' ], 'default', 'value' => '0000-00-00 00:00:00'],
            [['user_status' ], 'default', 'value' => 3],
            [['user_url', 'user_auth_key', 'user_access_token','user_display_name' ], 'default', 'value' => ''],  
        ];
    }

    public function updateUser($user)
    {
        echo $this->user_pass_check."<br />";
        echo $this->user_pass;
        if ($this->validate()) {            
            $attributes = $this::getAttributes();
            $user->isNewRecord = false;
            $user->saveUser($attributes);
            
            if($user->hasErrors()) { 
                $this->errors = $user->getErrors();
                return false;  
            }
            return true;
        } else {
            return false;
        }
    }
    
    public function createUser()
    {
        if ($this->validate()) {
            $this->user_auth_key = substr(str_replace('+', '.', base64_encode(pack('V4', mt_rand(), mt_rand(), mt_rand(), mt_rand()))), 0, 32);
            $this->user_access_token = substr(str_replace('+', '.', base64_encode(pack('V4', mt_rand(), mt_rand(), mt_rand(), mt_rand()))), 0, 32);
            
            $attributes = $this::getAttributes();
            $user = new User();
            $this->user_id = $user->saveUser($attributes);
            
            if($user->hasErrors()) { 
                $this->errors = $user->getErrors();
                return false;  
            }
            return true;
        } else {
            return false;
        }
    }
}
