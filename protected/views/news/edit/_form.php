<?php 
Yii::app()->clientScript->registerScriptFile('/js/nicEdit.js');
Yii::app()->clientScript->registerScriptFile('/js/news.js');
?>
<script type="text/javascript">
    bkLib.onDomLoaded(function() { nicEditors.idTextArea('', 'textarea_text') });
</script>
<div class="form" id="addCategory">
<?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>$action,
        'id'=>'add-new-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
                'validateOnSubmit'=>true,
        ),
)); ?>

<div class="row">
    <?php echo $form->label($new,'title'); ?>
    <?php echo $form->textField($new,'title', array('size'=>88)); ?>
    <?php echo $form->error($new,'title'); ?>
</div>
    
<div class="row">
    <?php echo $form->label($new,'text'); ?>
    <?php echo $form->textArea($new,'text', array('cols'=>74, 'rows'=>10, 'id'=>'textarea_text')); ?>
    <?php echo $form->error($new,'text'); ?>
</div> 

<div class="row">
    <?php echo $form->label($new,'source'); ?>
    <?php echo $form->textField($new,'source', array('size'=>88)); ?>
    <?php echo $form->error($new,'source'); ?>
</div>    
    
<div class="row">
    <?php echo $form->label($new,'news_category_id'); ?>
    <?php echo Chtml::activeDropDownList($new, 'news_category_id', CHtml::listData(NewsCategory::model()->findAll(), 'id', 'name'))?>
</div> 
    
<div class="row">
    <?php echo $form->label($new,'status_id'); ?>
    <?php  echo Chtml::activeDropDownList($new, 'status_id', CHtml::listData(Status::model()->findAll(), 'id', 'name'))?>
    <p>! Новость в статусе <b>Черновик</b> не отображается.</p>
</div>   
    
<div class="row rememberMe">    
    <?php echo CHtml::activeCheckBox($new,'first_block'); ?>
    <?php echo $form->label($new,'first_block'); ?>
</div>  
    
<div class="row rememberMe">    
    <?php echo CHtml::activeCheckBox($new,'first_page'); ?>
    <?php echo $form->label($new,'first_page'); ?>
</div>  

<div class="row" <?php echo ($new->isNewRecord)? 'style="display:none"' : '' ?> <?php echo !($new->first_page)? 'style="display:none"' : '' ?> id="textarea_first">
    <?php echo $form->label($new,'first_text'); ?>
    <?php echo $form->textArea($new,'first_text', array('cols'=>50, 'rows'=>5)); ?>
    <?php echo $form->error($new,'first_text'); ?>
</div>    
 
<?php if(!$new->isNewRecord) echo CHtml::hiddenField('News[id]', $new->id); ?>
    
<?php echo CHtml::submitButton('Сохранить', array('onclick'=>'addNew(); return false;')); ?>
    
<?php $this->endWidget(); ?>
</div><!-- form -->   

<div id="upload_img_nic">
<form method="post" action="/news/SaveImage" id="form_magic_file" target="rFrame" enctype="multipart/form-data">
<iframe id="rFrame" name="rFrame" style="display: none"></iframe>    
<input name="nicImage" id="magic_file" type="file" style="opacity:0"/>
</form></div> 



