<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\components\SidebarWidget;

if(array_key_exists('webName', Yii::$app->params)) {
    $this->title = Yii::$app->params['webName'];
}

if(array_key_exists('sidebar', Yii::$app->params)) {
    $sidebar = Yii::$app->params['sidebar'];
}
?>
<script type="text/javascript">
$(document).ready(function(){
  $('.slider').bxSlider({
  auto: true,
  speed: 2000,
  buildPager: function(slideIndex){
    switch(slideIndex){
      case 0:
        return 'Link 1';
      case 1:
        return 'Link 2';
      case 2:
        return 'Link 3';
    }
  }
});
    $('.slider').show(); 
    $('.bx-controls-direction').show();
});
</script>
<div class="home container">
<div class="site-index">

    <div id="home">
        <div id="featured_section">
            <div class="container">
                <ul class="slider">
                    <li><img src="/tnpw2/web/uploads/beautiful_nature_landscape_05_hd_picture.jpg" width="1170" height="360" /></li>
                    <li><img src="/tnpw2/web/uploads/beautiful_nature_landscape_05_hd_picture.jpg" width="1170" height="360"/></li>
                    <li><img src="/tnpw2/web/uploads/beautiful_nature_landscape_05_hd_picture.jpg" width="1170" height="360" /></li>
                </ul>
                
            </div>
        </div>
        
        <div class="heading">
            <div class="container">
                <h1>Vítejte na tomto Blogu</h1>
                <p>Text</p>
            </div>
        </div>
        
        <div class="content">
            <div class="container">
                <div class="recent_wrap <?php if($sidebar['enabled']) { echo 'left'; } ?>">
                <h2 class="box-title"><?= Html::encode('Nové příspěvky') ?></h2>
                <div class="post_wrap">
                <?php 
                    if(!empty($posts)) {
                        foreach($posts as $k => $post) { 
                            $date = date('j.n.Y', strtotime($post->post_date));
                            $post->editExcerpt();
                            if(array_key_exists($post->post_id, $categories)) {
                            $caregory_info = $categories[$post->post_id]; } ?>
                            <div class="post_detail">
                                <div class="thumb"><img src="<?php echo Url::to(['/img/dummy.png']); ?>" alt="" width="128" height="128" /></div>
                                <h2 class="title"><a href="<?php echo Url::to(['post/'.$post->guid]); ?>"><?= Html::encode($post->post_title) ?></a></h2>
                                <p class="meta-info"><?= Html::encode('Publikováno: dne '.$date) ?><?php if(!empty($caregory_info)) { echo " v ".$caregory_info; } ?></p>
                                <div class="post_content">
                                    <?php echo $post->post_excerpt; ?>
                                </div>
                            </div>
                    <?php }
                    }?>
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
    </div>
</div>
</div>
