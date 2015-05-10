<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

$this->title = $post->post_title;
$date = date('j.n.Y', strtotime($post->post_date));

$caregory_info = "";
if(is_array($categories)) {
    foreach($categories as $k => $cat) {
       $caregory_info .= '<a href="'.Url::to(['category/'.$cat]).'">'.$cat."</a>, ";
    }
    $caregory_info = substr($caregory_info, 0, -2);
}
?>
<div class="container">
<?php
echo Breadcrumbs::widget([
    'itemTemplate' => "<li><i>{link}</i></li>\n", // template for all links
    'links' => [
        [
            'label' => 'Post Category',
            'url' => ['post-category/view', 'id' => 10],
            'template' => "<li><b>{link}</b></li>\n", // template for this link only
        ],
        $post->post_title,
    ],
]);
?>
<div class="site-index">

    <div id="post_wrap">
        <h1 class="title"><?= Html::encode($this->title) ?></h1>
        <p class="meta-info"><?= Html::encode('Publikováno: dne '.$date) ?>
        <?php if(!empty($caregory_info)) { echo " v ".$caregory_info; } ?></p>
        <div class="post_content">
            <?php echo $post->post_content; ?>
        </div>
    </div>
</div>
</div>
