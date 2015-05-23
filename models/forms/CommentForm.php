<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\models\db\Comments;

/**
 * ContactForm is the model behind the contact form.
 */
class CommentForm extends Model
{
    public $post_id;
    public $comment_author;
    public $comment_author_email;
    public $comment_author_url;
    public $comment_date;
    public $comment_date_gmt;
    public $comment_content;
    public $comment_parent;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['comment_author', 'comment_author_email', 'comment_content'], 'required'],
            [['comment_author_url'], 'default', 'value' => ''],
            [['comment_parent'], 'default', 'value' => 0],
            [['comment_date', 'comment_date_gmt' ], 'default', 'value' => '0000-00-00 00:00:00'],
            // email has to be a valid email address
            ['comment_author_email', 'email'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param  string  $email the target email address
     * @return boolean whether the model passes validation
     */
    public function comment($post_id)
    {
        if ($this->validate()) {
            $comment = new Comments;
            $this->post_id = $post_id;
            $this->comment_date = date('Y-m-d H:i:s');
            $this->comment_date_gmt = gmdate('Y-m-d H:i:s');
            
            $attributes = $this::getAttributes();
            $comment->saveComment($attributes);
            return true;
        } else {
            return false;
        }
    }
}
