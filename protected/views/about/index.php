<?php
Yii::app()->clientScript->registerScriptFile('/js/jquery.js');
Yii::app()->clientScript->registerScriptFile('/js/about.js');
$this->pageTitle=Yii::app()->name . ' - О компании';
$this->breadcrumbs=array(
	'',
);
?>
<div id="content" class="about">
        <h1>О компании</h1>
        <?php echo $model->text;?>
</div><!-- #content-->

<div class="sidebar" id="sideRight">
    <?php if(!Yii::app()->user->isGuest):?>
    <div id="sideAdd">
       <?php echo CHtml::link(CHtml::image('/images/edit.png').' Изменить страницу', '/site/edit', array('class'=>'add')); ?>
    </div>
    <?php endif; ?>
    <div class="bl">
    <ul class="sub">
        <?php foreach ($categoryes as $category){
         echo '<li>'.CHtml::link($category->name, array('/news/category/', 'id'=>$category->id)).'</li>';  
        }?>
    </ul>
    </div>
    <p><?php echo CHtml::link('Обратная связь', '/site/contact', array('class'=>'feedback'));?></p>
</div> 
<!--sideRight -->

