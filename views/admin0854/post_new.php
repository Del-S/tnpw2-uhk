<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use moonland\tinymce\TinyMCE;

$this->title = 'Detail příspěvku';
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

    <?php $form = ActiveForm::begin([
        'id' => 'edit-post-form',
        'action' => '#',
        'options' => ['class' => 'form-left'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>
    <?= $form->field($post_form, 'post_title') ?>
    <?= $form->field($post_form, 'guid') ?>
    <?= $form->field($post_form, 'post_content')->widget(TinyMCE::className(), [
            'toggle' => [
                'active' => false,
            ]
        ]);  ?>
    <?= $form->field($post_form, 'post_excerpt') ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Vytvořit', ['class' => 'btn btn-primary', 'name' => 'new-post-button'])  ?>
        </div>
    </div>
    <?php 
        $checkboxitems = [];
        foreach($categories as $category) { 
            $checkboxitems[$category->category_id] = $category->category_name;
        } 
        $post_meta_form->meta_key = 'post_categories';
        $post_meta_form->post_id = $post_form->post_id;
    ?>
    <?= Html::activeHiddenInput($post_meta_form, 'meta_key'); ?>
    <div class="form-category">
       <?= $form->field($post_meta_form, 'meta_value')->checkboxList($checkboxitems); ?>
    </div>
    <?php ActiveForm::end(); ?>