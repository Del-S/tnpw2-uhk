<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use moonland\tinymce\TinyMCE;

$this->title = 'Detail příspěvku';
?>
    <div id="post-detail">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="form-error">
    <?php if(is_array($errors)) {
        foreach ($errors as $error) { 
            foreach ($error as $k => $v) { ?>
        <p><?= Html::encode("{$v}") ?></p>
    <?php }}} ?>
    </div>

        <?php $form = ActiveForm::begin([
            'id' => 'edit-post-form',
            'action' => '#',
            'options' => ['class' => 'form-left'],
            'fieldConfig' => [
                'template' => "{label}\n{input}\n<div class=\"col-lg-8\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-2 control-label'],
            ],
        ]); ?>
    <div id="post-detail-wrap">
        <div id="post-detail-main">
            <?= $form->field($post_form, 'post_title', array('template'=>"{input}\n<div class=\"col-lg-8\">{error}</div>", 'inputOptions'=>array('placeholder'=>'Zadejte název'))); ?>
            <?= $form->field($post_form, 'guid') ?>
            <?= $form->field($post_form, 'post_content', array('template'=>"{input}\n<div class=\"col-lg-8\">{error}</div>"))->widget(TinyMCE::className(), [
                    'toggle' => [
                        'active' => true,
                        'language' => "cs",
                        'button' => [
			                 'show' => true,
			                 'toggle' => ['label' => 'Editor', 'options' => ['class' => 'btn-tinymce']],
			                 'unToggle' => ['label' => 'Html', 'options' => ['class' => 'btn-tinymce']]
		                ],
                        'addon' => [
			                 'before' => '<div class="tinymce-buttons"><button class="btn">Nahrát mediální subor</button><div class="tinymce-toogle">',
			                 'after' => '</div></div>',
		                 ],
                    ],
                    'skin' => 'light',
                    'language' => "cs",
                    'menubar' => false,
                ]);  ?>
        </div>
     
        <div id="post-detail-sidebar">
            <div class="block info">
                <h3>Publikovat</h3>
                <div class="inside">
                <?php if($post_form->post_status == 'publish') { $status = 'Publikováno'; }
                    else { $status = $post_form->post_status; } ?>
                <?= Html::tag('div', 'Stav: '.$status, ['class' => 'info post-status']); ?>
                <?= Html::tag('div', 'Publikováno: '.$post_form->post_date, ['class' => 'info post-date']); ?>
                </div>
                <div class="actions">
                <?= Html::a('Odstranit', ["/admin0854/post_trash?post={$post_form->post_id}"], ['class'=>'btn-trash']) ?>
                <?= Html::submitButton('Aktualizovat', ['class' => 'btn btn-primary save-post', 'name' => 'new-post-button'])  ?>
                <div class="clear"></div>
                </div>
            </div> 

            <div class="block categories">
                <h3>Kategorie</h3>
                <div class="inside">
                <?php 
                    $checkboxitems = [];
                    foreach($categories as $category) { 
                        $checkboxitems[$category->category_id] = $category->category_name;
                    } 
                    $category_meta_form->meta_key = 'post_categories';
                    $category_meta_form->post_id = $post_form->post_id;
                ?>
                <?= Html::activeHiddenInput($category_meta_form, 'meta_key'); ?>
                <?= Html::activeHiddenInput($category_meta_form, 'post_id'); ?>
                <?= $form->field($category_meta_form, 'meta_value', array('template'=>"{input}\n<div class=\"col-lg-8\">{error}</div>"))->checkboxList($checkboxitems); ?>
                </div> 
            </div>
        </div>
        
        <div id="post-detail-second">
            <div class="block excerpt"> 
                <h3>Stručný výpis příspěvku</h3>
                <div class="inside">
                <?= $form->field($post_form, 'post_excerpt', array('template'=>"{input}\n<div class=\"col-lg-8\">{error}</div>"))->textarea(); ?> 
                </div>
            </div>
            
            <?php foreach($post_meta_blocks_settings as $k => $blocks) {  ?>
            <div class="block <?php echo $k ?>">  
                <?= Html::tag('h3', $k); ?>
                <div class="inside"> 
            <?php foreach($blocks as $k => $v) { 
                    $post_meta = $post_meta_blocks[$k];
                    $type = $v['type'];
                    $label = $v['label']; ?>
                    <?= $form->field($post_meta, '['.$post_meta->meta_key.']meta_value')->label($label) ?>
              <?php } ?>
                 </div>
            </div>
            <?php } ?>
        </div>
        <?= Html::tag('div', '', ['class' => 'clear']); ?>
    </div>
    <?php ActiveForm::end(); ?>
    </div>