<?php
use yii\helpers\Html;

$this->title = 'Komentáře';
?>
    <h1><?= Html::encode($this->title) ?></h1>
    
    <table>
    <tr>
        <th>Autor</th>
        <th>Komentáž</th>
        <th>Příspěvek</th>
    </tr>
    <?php foreach ($comments as $comment): ?>
        
    <tr>
        <td><?= Html::encode("{$comment->comment_author}") ?></td>
        <td>
          <?= Html::encode("{$comment->comment_content}") ?>
          <div class="row-actions">
              <span class="delete"><?= Html::a('Smazat', ["/admin0854/comment_trash?comm={$comment->comment_id}"], ['class'=>'btn btn-trash']) ?></span>  
          </div>  
        </td>
        <td>xx</td>
    </tr>
    <?php endforeach; ?>
    </table>