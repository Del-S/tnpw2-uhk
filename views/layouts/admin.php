<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AdminAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'Admin',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Home', 'url' => ['/admin0854/index']],
                    Yii::$app->user->isGuest ?
                        ['label' => 'Login', 'url' => ['/admin0854/login']] :
                        ['label' => 'Logout (' . Yii::$app->user->identity->user_login . ')',
                            'url' => ['/admin0854/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
            NavBar::end();
        ?>
        
       <div class="nav admin">
       <?php
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-left'],
                'items' => [
                    ['label' => 'Nástěnka', 'url' => ['/admin0854/index']],
                    ['label' => 'Příspěvky', 'url' => ['/admin0854/posts']],
                    ['label' => 'Kategorie', 'url' => ['/admin0854/category']],
                    ['label' => 'Komentáře', 'url' => ['/admin0854/comments']],
                    ['label' => 'Uživatelé', 'url' => ['/admin0854/user']],
                ],
            ]);
        ?> 
        </div>
        
        <div class="container_admin">
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
