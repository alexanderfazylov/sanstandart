<?php
$this->pageTitle=Yii::app()->name . ' - Каталог';
$this->breadcrumbs=array(
);
?>
<div id="content" class="add_address">
<h1>Редактирование Коллекции</h1>
    <?php $this->renderPartial('edit/_formCollection', array('collection'=>$collection, 'max_first'=>$max_first, 'action'=>'/catalog/editCollection/'.$collection->id)); ?>
</div><!-- #content-->
