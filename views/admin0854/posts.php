<?php
use yii\helpers\Html;

$this->title = 'Category';
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?php foreach ($categories as $category): ?>
    <li>
        <?= Html::encode("{$category->category_name} ({$category->category_title})") ?>:
    </li>
    <?php endforeach; ?>
