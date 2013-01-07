<?php
Yii::app()->clientScript->registerScriptFile('/js/sm_nicEdit.js');
Yii::app()->clientScript->registerScriptFile('/js/news.js');
$this->pageTitle=Yii::app()->name . ' - О компании';
$this->breadcrumbs=array(
	'',
);
?>
<div class="form" id="addCategory">
<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'add-new-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
                'validateOnSubmit'=>true,
        ),
)); ?>
<script type="text/javascript">
    bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
<?php if(!$model) $model = new Page(); ?>    
<div class="row">
    <?php echo $form->label($model,'text'); ?>
    <?php echo $form->textArea($model,'text', array('cols'=>89, 'rows'=>10, 'id'=>'textarea_text')); ?>
    <?php echo $form->error($model,'text'); ?>
</div>  

    
<?php echo CHtml::submitButton('Сохранить', array('onclick'=>'addNew(); return false;')); ?>
    
<?php $this->endWidget(); ?>
</div><!-- form --> 

<div id="upload_img_nic">
<form method="post" action="/site/SaveImage" id="form_magic_file" target="rFrame" enctype="multipart/form-data">
<iframe id="rFrame" name="rFrame" style="display: none"></iframe>    
<input name="nicImage" id="magic_file" type="file" style="opacity:0"/>
</form></div> 
