<?php 
Yii::app()->clientScript->registerScriptFile('/js/nicEdit.js');
Yii::app()->clientScript->registerScriptFile('/js/news.js');
?>
<script type="text/javascript">
    bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
<div class="form" id="addCategory">
<?php $form=$this->beginWidget('CActiveForm', array(
        'action' => $action,
        'id'=>'add-new-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
                'validateOnSubmit'=>true,
        ),
)); ?>
<div class="row">
    <?php echo $form->label($model,'title'); ?>
    <?php echo $form->textField($model,'title', array('size'=>58)); ?>
    <?php echo $form->error($model,'title'); ?>
</div>
    
<div class="row">
    <?php echo $form->label($model,'text'); ?>
    <?php echo $form->textArea($model,'text', array('cols'=>80, 'rows'=>10, 'id'=>'textarea_text')); ?>
    <?php echo $form->error($model,'text'); ?>
</div>  
    
<?php if(!$model->isNewRecord) echo CHtml::hiddenField('Page[id]', $model->id); ?>    
        
<?php echo CHtml::submitButton('Сохранить', array('onclick'=>'addNew(); return false;')); ?>
    
<?php $this->endWidget(); ?>
</div><!-- form -->  

<div id="upload_img_nic">
<form method="post" action="/news/SaveImage" id="form_magic_file" target="rFrame" enctype="multipart/form-data">
<iframe id="rFrame" name="rFrame" style="display: none"></iframe>    
<input name="nicImage" id="magic_file" type="file" style="opacity:0"/>
</form></div> 
