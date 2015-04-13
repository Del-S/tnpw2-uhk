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
              <span class="delete"><?= Html::a('Smazat', ["/admin0854/post_trash?post={$post->post_id}"], ['class'=>'btn btn-trash']) ?></span>  
          </div>  
        </td>
        <td>xx</td>
        <td><?= Html::encode("{$post->post_date}") ?></td>
        <td><?= Html::encode("{$post->user_display_name}") ?></td>
    </tr>
    <?php endforeach; ?>
    </table>