<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Kategorie';
?>
    <h1><?= Html::encode($this->title) ?></h1>
    
    <table>
    <tr>
        <th>ID</th>
        <th>Jméno</th>
        <th>Popis</th>
        <th>Url</th>
        <th>Počet Postů</th>
    </tr>
    <?php foreach ($categories as $category): ?>
        
    <tr>
        <td><?= Html::encode("{$category->category_id}") ?></td>
        <td>
          <a href=""><?= Html::encode("{$category->category_name}") ?></a>
          <div class="row-actions">
              <span class="edit"><a href="">Upravit</a></span>  
              <span class="delete"><a href="">Smazat</a></span>  
          </div>  
        </td>
        <td><?= Html::encode("{$category->category_title}") ?></td>
        <td><?= Html::encode("{$category->guid}") ?></td>
        <td>xx</td>
    </tr>
    <?php endforeach; ?>
    </table>

    <p>Vytvořit novou Kategorii</p>

    <?php $form = ActiveForm::begin([
        'id' => 'new-category-form',
        'action' => '#',
        'options' => ['class' => 'form-left'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($category_form, 'category_name') ?>

    <?= $form->field($category_form, 'category_title') ?>

    <?= $form->field($category_form, 'category_parent') ?>

    <?= $form->field($category_form, 'guid') ?>

    <?= $form->field($category_form, 'menu_order') ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Vytvořit', ['class' => 'btn btn-primary', 'name' => 'new-category-button']) ?>
        </div>
    </div>