<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile file attribute
     */
    public $file;

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'file' => 'Soubor',
        ];
    }
    
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
             [['file'], 'file', 'maxFiles' => 10],
        ];
    }
}
