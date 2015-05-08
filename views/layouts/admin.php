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
    <link rel="stylesheet" id="open-sans-css" href="//fonts.googleapis.com/css?family=Open+Sans%3A300italic%2C400italic%2C600italic%2C300%2C400%2C600&amp;subset=latin%2Clatin-ext" type="text/css" media="all">
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'Admin',
                'brandUrl' => ['/admin0854/index'],
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    Yii::$app->user->isGuest ?
                        ['label' => 'Login', 'url' => ['/admin0854/login']] :
                        ['label' => 'Logout (' . Yii::$app->user->identity->user_login . ')',
                            'url' => ['/admin0854/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
            NavBar::end();
        ?>
        
        <?php if (!\Yii::$app->user->isGuest) { ?>
            <div class="admin-back"></div>
            <div class="nav admin">
            <?php
                $rights = Yii::$app->user->identity->getRights();
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-left'],
                    'items' => [
                        ['label' => 'Nástěnka', 'url' => ['/admin0854/index']],
                        ($rights >= 0 && $rights <= 2) ? 
                        ['label' => 'Příspěvky', 'url' => ['/admin0854/posts']]: [],
                        ($rights >= 0 && $rights <= 2) ?
                        ['label' => 'Media', 'url' => ['/admin0854/upload']]: [],
                        ($rights >= 0 && $rights <= 2) ?
                        ['label' => 'Kategorie', 'url' => ['/admin0854/category']]: [],
                        ($rights >= 0 && $rights <= 2) ?
                        ['label' => 'Komentáře', 'url' => ['/admin0854/comments']]: [],
                        ($rights == 0) ? 
                            ['label' => 'Uživatelé', 'url' => ['/admin0854/user']]: 
                            ['label' => 'Uživatel', 'url' => ['/admin0854/user_detail']],
                    ],
                ]);
            ?> 
            </div>
         <?php } ?>
        
        <div class="container_admin">
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left"></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
