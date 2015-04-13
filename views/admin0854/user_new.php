<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Nový uživatel';
?>
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Vytvořit novou Kategorii</p>

    <div class="form-error">
    <?php if(is_array($errors)) {
        foreach ($errors as $error) { 
            foreach ($error as $k => $v) { ?>
        <p><?= Html::encode("{$v}") ?></p>
    <?php }}} ?>
    </div>

    <?php 
    $rights = array(0 => 'Administrátor', 1 => 'Šéfredaktor', 2 => 'Redaktor', 4 => 'Návštěvník');
    $form = ActiveForm::begin([
        'id' => 'edit-user-form',
        'action' => '#',
        'options' => ['class' => 'form-left'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>
    <?= $form->field($user_form, 'user_login') ?>
    <?= $form->field($user_form, 'user_pass') ?>
    <?= $form->field($user_form, 'user_pass_check') ?>
    <?= $form->field($user_form, 'user_nickname') ?>
    <?= $form->field($user_form, 'user_email') ?>
    <?= $form->field($user_form, 'user_url') ?>
    <?= $form->field($user_form, 'user_status')->dropDownList($rights); ?>
    <?= $form->field($user_form, 'user_display_name') ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Upravit', ['class' => 'btn btn-primary', 'name' => 'edit-user-button'])  ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>