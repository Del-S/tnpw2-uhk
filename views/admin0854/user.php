<?php
use yii\helpers\Html;

$this->title = 'Uživatelé';
?>
    <h1><?= Html::encode($this->title) ?></h1>
    
    <table>
    <tr>
        <th>Uživatelské jméno</th>
        <th>Jméno</th>
        <th>Email</th>
        <th>Práva</th>
    </tr>
    <?php foreach ($users as $user): ?>
        
    <tr>
        <td>
          <a href=""><?= Html::encode("{$user->user_login}") ?></a>
          <div class="row-actions">
              <span class="edit"><?= Html::a('Upravit', ["/admin0854/user_detail?user={$user->user_id}"], ['class'=>'btn btn-edit']) ?></span>  
              <span class="delete"><a href="">Smazat</a></span>  
          </div>  
        </td>
        <td>xx</td>
        <td><?= Html::encode("{$user->user_email}") ?></td>
        <td><?= Html::encode("{$user->user_status}") ?></td>
    </tr>
    <?php endforeach; ?>
    </table>