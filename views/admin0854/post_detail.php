<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use moonland\tinymce\TinyMCE;

$this->title = 'Detail příspěvku';
?>
    <div id="post-detail">
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
                'template' => "{label}\n{input}\n<div class=\"col-lg-8\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-1 control-label'],
            ],
        ]); ?>
    <div id="post-detail-wrap">
        <div id="post-detail-main">
            <?= $form->field($post_form, 'post_title') ?>
            <?= $form->field($post_form, 'guid') ?>
            <?= $form->field($post_form, 'post_content')->widget(TinyMCE::className(), [
                    'toggle' => [
                        'active' => true,
                        'language' => "cs",
                    ],
                    'skin' => 'light',
                    'language' => "cs",
                    'menubar' => false,
                ]);  ?>
            <?= $form->field($post_form, 'post_excerpt') ?>
        </div>
     
        <div id="post-detail-sidebar">
            <div class="form-meta-info">
                <?php if($post_form->post_status == 'publish') { $status = 'Publikováno'; }
                    else { $status = $post_form->post_status; } ?>
                <?= Html::tag('div', 'Stav: '.$status, ['class' => 'post-status']); ?>
                <?= Html::tag('div', 'Publikováno: '.$post_form->post_date, ['class' => 'post-date']); ?>
                <?= Html::submitButton('Aktualizovat', ['class' => 'btn btn-primary', 'name' => 'new-post-button'])  ?> 
            </div> 

            <div class="form-meta-info">
                <?php 
                        $checkboxitems = [];
                    foreach($categories as $category) { 
                        $checkboxitems[$category->category_id] = $category->category_name;
                    } 
                    $category_meta_form->meta_key = 'post_categories';
                    $category_meta_form->post_id = $post_form->post_id;
                ?>
                <?= Html::activeHiddenInput($category_meta_form, 'meta_key'); ?>
                <?= Html::activeHiddenInput($category_meta_form, 'post_id'); ?>
                <div class="form-category">
                    <?= $form->field($category_meta_form, 'meta_value')->checkboxList($checkboxitems); ?>
                </div> 
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    </div>