<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\widgets\Breadcrumbs;
use app\components\SidebarWidget;

$this->title = $post->post_title;
$date = date('j.n.Y', strtotime($post->post_date));

$caregory_info = "";
if(is_array($categories)) {
    foreach($categories as $k => $cat) {
       $caregory_info .= '<a href="'.Url::to(['category/'.$cat]).'">'.$cat."</a>, ";
    }
    $caregory_info = substr($caregory_info, 0, -2);
}

if(array_key_exists('sidebar', Yii::$app->params)) {
    $sidebar = Yii::$app->params['sidebar'];
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

    <div class="post <?php if($sidebar['enabled']) { echo 'left'; } ?>">
    <div id="post_wrap">
        <h1 class="title"><?= Html::encode($this->title) ?></h1>
        <p class="meta-info"><?= Html::encode('Publikováno: dne '.$date) ?>
        <?php if(!empty($caregory_info)) { echo " v ".$caregory_info; } ?></p>
        <div class="post_content">
            <?php echo $post->post_content; ?>
        </div>
    </div>
    <div id="comment-section">
        <?php if(is_array($comments)) { ?>
        <h3 class="reply-title">Komentáře (<?php echo count($comments); ?>)</h2>
        <ol class="commentlist">
            <?php foreach($comments as $comment) { ?>
                    <li class="comment-thread">
                        <div class="comment">
                            <div class="comment_info"><p class="meta-info"><?php echo $comment->getCommentInfo(); ?></p></div>
                            <div class="comment_content"><p><?= Html::encode($comment->comment_content) ?></p></div>
                        </div>
                    </li>
            <?php } ?>
        </ol>
        <?php } ?>
    </div>
    <div id="respond">
        <h3 class="reply-title">Váš komentář</h2>
        <?php $form = ActiveForm::begin(['class' => 'comment-form', 
                'fieldConfig' => [ 'template' => "{input}\n<div class=\"col-lg-8\">{error}</div>",]]); ?>
            <?= $form->field($comment_form, 'comment_author', array('inputOptions'=>array( 'placeholder'=>'Jméno *'))) ?>
            <?= $form->field($comment_form, 'comment_author_email', array('inputOptions'=>array( 'placeholder'=>'Emailová adresa *'))) ?>
            <?= $form->field($comment_form, 'comment_content', array('inputOptions'=>array( 'placeholder'=>'Komentář *')))->textArea(['rows' => 6]) ?>
            <div class="form-group">
                <?= Html::submitButton('Odeslat komentář', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>
        <?php ActiveForm::end(); ?>
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
