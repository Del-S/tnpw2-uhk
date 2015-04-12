<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Příspěvky';
?>
    <h1><?= Html::encode($this->title) ?></h1>
    <div class='new-post'><?= Html::a('Nový Příspěvek', ["/admin0854/post_new"], ['class'=>'btn btn-new']) ?></div>

    <table>
    <tr>
        <th>ID</th>
        <th>Název</th>
        <th>Rubriky</th>
        <th>Datum</th>
        <th>Autor</th>
    </tr>
    <?php foreach ($posts as $post): ?>
        
    <tr>
        <td><?= Html::encode("{$post->post_id}") ?></td>
        <td>
          <a href=""><?= Html::encode("{$post->post_name}") ?></a>
          <div class="row-actions">
              <span class="edit"><?= Html::a('Upravit', ["/admin0854/post_detail?post={$post->post_id}"], ['class'=>'btn btn-edit']) ?></span>  
              <span class="delete"><a href="">Smazat</a></span>  
          </div>  
        </td>
        <td>xx</td>
        <td><?= Html::encode("{$post->post_date}") ?></td>
        <td><?= Html::encode("{$post->user_display_name}") ?></td>
    </tr>
    <?php endforeach; ?>
    </table>

    

    <p>Vytvořit novou Kategorii</p>

    <?php $form = ActiveForm::begin([
        'id' => 'new-post-form',
        'action' => '#',
        'options' => ['class' => 'form-left'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($post_form, 'post_title') ?>

    <?= $form->field($post_form, 'post_content') ?>

    <?= $form->field($post_form, 'post_excerpt') ?>

    <?= $form->field($post_form, 'post_name') ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Vytvořit', ['class' => 'btn btn-primary', 'name' => 'new-post-button'])  ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>