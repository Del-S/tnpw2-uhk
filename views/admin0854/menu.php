<?php
use yii\helpers\Html;

$this->title = 'Menu';
?>
    <h1><?= Html::encode($this->title) ?>

    <table class="list-table widefat">
    <thead>
        <tr>
            <th>Uživatelské jméno</th>
            <th>Jméno</th>
            <th>Email</th>
            <th>Práva</th>
        </tr>
    </thead>
    <?php 
    $rights = array(0 => 'Administrátor', 1 => 'Šéfredaktor', 2 => 'Redaktor', 3 => 'Návštěvník');
    foreach ($users as $user): ?>
        
    <tr>
        <td class="actions">
          <?= Html::a($user->user_login, ["/admin0854/user_detail?user={$user->user_id}"], ['class'=>'btn-edit-main']) ?>
          <div class="row-actions">
              <span class="edit"><?= Html::a('Upravit', ["/admin0854/user_detail?user={$user->user_id}"], ['class'=>'btn-edit']) ?></span>  
              <span class="delete"><?= Html::a('Smazat', ["/admin0854/user_trash?u={$user->user_id}"], ['class'=>'btn-trash']) ?></span>   
          </div>  
        </td>
        <td>xx</td>
        <td><?= Html::encode("{$user->user_email}") ?></td>
        <td><?= Html::encode("{$rights[$user->user_status]}") ?></td>
    </tr>
    <?php endforeach; ?>
    </table>