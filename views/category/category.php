<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;
use app\components\SidebarWidget;

$this->title = $category->category_name;

if(array_key_exists('sidebar', Yii::$app->params)) {
    $sidebar = Yii::$app->params['sidebar'];
}
$this->params['breadcrumbs'][] = ['label' => $category->category_name, 'url' => ['category/'.$category->guid]];
?>
<div class="container">
<div id="category">
    <h1 class="title"><?= Html::encode($category->category_name) ?></h1>
<?php
echo Breadcrumbs::widget([
    'itemTemplate' => "<li>{link}</li>\n",
    'homeLink' => [ 'label' => 'Úvod', 'url' => Yii::$app->homeUrl, ],
    'links' => [
        $category->category_name,
    ],
]);
?>
    <div class="category_body <?php if($sidebar['enabled']) { echo 'left'; } ?>">
    <div id="category_wrap">
        <div class="recent_wrap">
        <?php 
            if(!empty($posts)) {
                foreach($posts as $k => $post) { 
                    $date = date('j.n.Y', strtotime($post->post_date)); 
                    $post->editExcerpt();
                    $caregory_info = $categories[$post->post_id]; ?>
                    <div class="post_wrap clearfix">
                        <div class="thumb"><img src="<?php echo Url::to(['/img/dummy.png']); ?>" alt="" width="128" height="128" /></div>
                        <h2 class="title"><a href="<?php echo Url::to([$category->guid."/".$post->guid]); ?>"><?= Html::encode($post->post_title) ?></a></h2>
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
      <?php  echo LinkPager::widget([
            'pagination' => $pagination,
        ]); ?>
    </div>
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