<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Příspěvky';
?>
    <h1><?= Html::encode($this->title) ?>
        <?= Html::a('Nový Příspěvek', ["/admin0854/post_new"], ['class'=>'btn btn-new']) ?></h1>

    <table class="list-table widefat">
    <thead>
        <tr>
            <th>ID</th>
            <th>Název</th>
            <th>Rubriky</th>
            <th>Datum</th>
            <th>Autor</th>
        </tr>
    </thead>
    <?php 
    $rights = Yii::$app->user->identity->getRights();
    $id = Yii::$app->user->id;
    foreach ($posts as $post): ?>
        
    <tr>
        <td><?= Html::encode("{$post->post_id}") ?></td>
        <td class="actions">
          <?= Html::a($post->post_title, ["/admin0854/post_detail?post={$post->post_id}"], ['class'=>'btn-edit-main']) ?>
          <div class="row-actions">
              <?php if(($rights >= 0 && $rights <= 1) || ($id == $post->post_author)) { ?>
              <span class="edit"><?= Html::a('Upravit', ["/admin0854/post_detail?post={$post->post_id}"], ['class'=>'btn-edit']) ?></span>
              <?php } if($rights >= 0 && $rights <= 1) { ?>
              <span class="delete"><?= Html::a('Odstranit', ["/admin0854/post_trash?post={$post->post_id}"], ['class'=>'btn-trash']) ?></span> 
              <?php } ?>
          </div>  
        </td>
        <td><?= Html::encode("{$post->cat_display_name}") ?></td>
        <td><?= Html::encode("{$post->post_date}") ?></td>
        <td><?= Html::encode("{$post->user_display_name}") ?></td>
    </tr>
    <?php endforeach; ?>
    </table>