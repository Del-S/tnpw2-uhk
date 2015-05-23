<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Detail uživatele';
?>
    <div id="user-detail">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php 
    $rights = array(0 => 'Administrátor', 1 => 'Šéfredaktor', 2 => 'Redaktor');
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
    <?php if($user_form->user_status == 0) { ?>
        <?= $form->field($user_form, 'user_status')->dropDownList($rights); ?>
    <?php } ?>
    <?= $form->field($user_form, 'user_display_name') ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Upravit', ['class' => 'btn btn-primary', 'name' => 'edit-user-button'])  ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    </div>