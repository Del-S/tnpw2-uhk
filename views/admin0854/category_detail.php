<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Detail kategorie';
?>
    <div id="category-detail">
    <h1><?= Html::encode($this->title) ?></h1>
        
    <div class="form-error">
    <?php if(is_array($errors)) {
        foreach ($errors as $error) { 
            foreach ($error as $k => $v) { ?>
        <p><?= Html::encode("{$v}") ?></p>
    <?php }}} ?>
    </div>

    <?php $form = ActiveForm::begin([
            'id' => 'contact-form',
            'action' => '#',
            'options' => ['class' => 'form-left'],
            'fieldConfig' => [
                'template' => "{label}\n{input}\n<div class=\"col-lg-8\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-2 control-label'],
            ],
        ]); ?>
        <?= $form->errorSummary($category_form); ?>
        <?= $form->field($category_form, 'category_name') ?>
        <?= $form->field($category_form, 'guid') ?>
        <?= $form->field($category_form, 'category_parent') ?>
        <?= $form->field($category_form, 'category_title')->textarea(); ?>
        <div class="clear"></div>
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
        </div>
    <?php ActiveForm::end(); ?>
    </div>
