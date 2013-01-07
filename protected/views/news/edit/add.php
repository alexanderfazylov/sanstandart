<?php
$this->pageTitle=Yii::app()->name . ' - Пресс-центр';
$this->breadcrumbs=array(
	'Пресс-центр' => array('/news'),
);
?>
<div id="content" class="view_news">
<h1>Создание новости</h1>
    <?php $this->renderPartial('edit/_form', array('new'=>$new, 'action'=>'/news/add')); ?>
</div><!-- #content-->
