<?php
$this->pageTitle=Yii::app()->name . ' - Каталог';
$this->breadcrumbs=array(
);
?>
<div id="content" class="add_address">
<h1>Редактирование Бренда</h1>
    <?php $this->renderPartial('edit/_form', array('brand'=>$brand, 'action'=>'/catalog/editBrand/1', 'edit_mod'=>1, 'sections'=>$sections, 'max_first'=>$max_first)); ?>
</div><!-- #content-->
