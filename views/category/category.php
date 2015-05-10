<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\components\SidebarWidget;

$this->title = $category->category_name;

if(array_key_exists('sidebar', Yii::$app->params)) {
    $sidebar = Yii::$app->params['sidebar'];
}
?>
<div class="container">
<?php
echo Breadcrumbs::widget([
    'itemTemplate' => "<li><i>{link}</i></li>\n", // template for all links
    'links' => [
        $category->category_name,
    ],
]);
?>
<div class="site-index">

    <div id="category_wrap">
        <h1 class="title"><?= Html::encode($category->category_name) ?></h1>
        <div class="recent_wrap <?php if($sidebar['enabled']) { echo 'left'; } ?>">
        <?php 
            if(!empty($posts)) {
                foreach($posts as $k => $post) { 
                    $date = date('j.n.Y', strtotime($post->post_date)); 
                    $post->editExcerpt();
                    $caregory_info = $categories[$k]; ?>
                    <div class="post_wrap">
                        <div class="thumb"><img src="#" alt="" width="128" height="128" /></div>
                        <h2 class="title"><a href="<?php echo Url::to(['post/'.$post->guid]); ?>"><?= Html::encode($post->post_title) ?></a></h2>
                        <p class="meta-info"><?= Html::encode('Publikováno: dne '.$date) ?>
                        <?php if(!empty($caregory_info)) { echo " v ".$caregory_info; } ?></p>
                        <div class="post_content">
                            <?php echo $post->post_excerpt; ?>
                            <a href="<?php echo Url::to(['post/'.$post->guid]); ?>" class="more"><?= Html::encode('Více informací >') ?></a>
                        </div>
                    </div>
               <?php }
            } else { ?>
                <p>Tato kategorie je prázdná</p>
            <?php } ?>
            </div>
    <?php if($sidebar['enabled']) { ?>
        <div id="sidebar">
            <?php if(isset($sidebar['widgets']['category'])) { ?>
            <?= SidebarWidget::widget(['name' => $sidebar['widgets']['category']]) ?>
            <?php } ?>
        </div>
    <?php } ?>
    </div>
</div>
</div>