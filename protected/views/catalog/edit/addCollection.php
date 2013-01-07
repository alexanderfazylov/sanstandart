<?php
$this->pageTitle=Yii::app()->name . ' - Каталог';
$this->breadcrumbs=array(
);
?>
<div id="content" class="add_address">
<h1>Создание Коллекции</h1>
    <?php $this->renderPartial('edit/_formCollection', array('collection'=>$collection, 'action'=>'/catalog/addCollection')); ?>
</div><!-- #content-->
