<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Kategorie';
?>
    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="form-error">
    <?php if(is_array($errors)) {
        foreach ($errors as $error) { 
            foreach ($error as $k => $v) { ?>
        <p><?= Html::encode("{$v}") ?></p>
    <?php }}} ?>
    </div>   

    <div class="col-left">
        <p>Vytvořit novou Kategorii</p>
        <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
            <?= $form->errorSummary($category_form); ?>
            <?= $form->field($category_form, 'category_name') ?>
            <?= $form->field($category_form, 'category_title') ?>
            <?= $form->field($category_form, 'category_parent') ?>
            <?= $form->field($category_form, 'guid') ?>
            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>
        <?php ActiveForm::end(); ?>
    </div>

    <div class="col-right">
        <table class="list-table widefat">
        <thead>
            <tr>
                <th>ID</th>
                <th>Název</th>
                <th>Url</th>
                <th>Počet Postů</th>
            </tr>
        </thead>
        <?php 
        $rights = Yii::$app->user->identity->getRights();
        foreach ($categories as $category): ?> 
        <tr>
            <td><?= Html::encode("{$category->category_id}") ?></td>
            <td class="actions">
            <?= Html::a($category->category_name, ["/admin0854/category_detail?cat={$category->category_id}"], ['class'=>'btn-edit-main']) ?>
            <div class="row-actions">
                <?php if($rights >= 0 && $rights <= 1) { ?>
                <span class="edit"><?= Html::a('Upravit', ["/admin0854/category_detail?cat={$category->category_id}"], ['class'=>'btn-edit']) ?></span> 
                <span class="delete"><?= Html::a('Smazat', ["/admin0854/category_trash?cat={$category->category_id}"], ['class'=>'btn-trash']) ?></span>
                <?php } ?>
            </div>  
            </td>
            <td><?= Html::encode("{$category->guid}") ?></td>
            <td><?= Html::encode("{$category->post_count}") ?></td>
        </tr>
        <?php endforeach; ?>
        </table>
    </div>