<?php
$this->pageTitle=Yii::app()->name . ' - Каталог';
$this->breadcrumbs=array(
);
?>
<div id="content" class="add_address">
<h1>Создание Бренда</h1>
    <?php $this->renderPartial('edit/_form', array('brand'=>$brand, 'action'=>'/catalog/addBrand', 'max_first'=>$max_first)); ?>
</div><!-- #content-->
