<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Nahrát soubory';
?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
      <?= $form->field($upload_form, 'file[]')->fileInput(['multiple' => true]) ?>
      <button>Nahrát soubor</button>
    <?php ActiveForm::end(); ?>