<?php

namespace app\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['user_login', 'user_email'], 'unique'],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $user = self::find()->where(['user_id' => $id])->one();
        return isset($user) ? new static($user) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $user = self::find()->where(['user_access_token' => $token])->one();
        return isset($user) ? new static($user) : null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $user = self::find()->where(['user_login' => $username])->one();
        return isset($user) ? new static($user) : null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->user_id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->user_auth_key;
    }
    
    /**
     * @inheritdoc
     */
    public function getRights()
    {
        return $this->user_status;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->user_auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        $salt = $this->user_pass_second;
        $pass_encrypt = crypt('pass', '$5$rounds=6250$'.$salt.'$');
        $pass_check = str_replace('$5$rounds=6250$', '',$pass_encrypt);
        return $this->user_pass === $pass_check;
    }
    
    public function saveUser($attributes) {
        foreach($attributes as $k => $v) {
            if($this->hasAttribute($k)) {
                if($k == 'user_pass') {
                    $pass = $v;
                    $salt = substr(str_replace('+', '.', base64_encode(pack('V6', mt_rand(), mt_rand(), mt_rand(), mt_rand(), mt_rand(), mt_rand()))), 0, 25);
                    $this->user_pass_second = $salt;
                    $pass_encrypt = crypt($pass, '$5$rounds=6250$'.$salt.'$');
                    $pass_save = str_replace('$5$rounds=6250$', '',$pass_encrypt);
                    $this->$k = $pass_save;
                }
                else { $this->$k = $v; }
            }
        }
        $this->save();
        return $this->user_id;
    } 
}
