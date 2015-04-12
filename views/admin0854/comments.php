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
          <a href=""><?= Html::encode("{$comment->comment_content}") ?></a>
          <div class="row-actions">
              <span class="delete"><a href="">Smazat</a></span>  
          </div>  
        </td>
        <td><?= Html::encode("{$comment->post_id}") ?></td>
    </tr>
    <?php endforeach; ?>
    </table>