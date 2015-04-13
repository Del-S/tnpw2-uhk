<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Category';
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="form-error">
    <?php if(is_array($errors)) {
        foreach ($errors as $error) { 
            foreach ($error as $k => $v) { ?>
        <p><?= Html::encode("{$v}") ?></p>
    <?php }}} ?>
    </div>

    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
        <?= $form->errorSummary($category_form); ?>
        <?= $form->field($category_form, 'category_name') ?>
        <?= $form->field($category_form, 'category_title') ?>
        <?= $form->field($category_form, 'category_parent') ?>
        <?= $form->field($category_form, 'guid') ?>
        <?= $form->field($category_form, 'menu_order') ?>
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
        </div>
    <?php ActiveForm::end(); ?>
