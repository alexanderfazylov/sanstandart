<?php
$this->pageTitle=Yii::app()->name;
?>
<div id="content" class="add_address">
<h1>Создание адреса</h1>
    <?php $this->renderPartial('edit/_form', array('address'=>$address, 'action'=>'/contacts/add', 'working_time'=>$working_time, 'day_week'=>$day_week)); ?>
</div><!-- #content-->
