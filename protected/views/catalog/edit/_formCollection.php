<?php 
Yii::app()->clientScript->registerScriptFile('/js/pr_nicEdit.js');
Yii::app()->clientScript->registerScriptFile('/js/news.js');
?>
<script type="text/javascript">
    bkLib.onDomLoaded(function() { nicEditors.idTextArea('', 'textarea_text') });
</script>
<script>
 function onBrand(name) {  
    $('#project_img').html('<img src="/uploads/'+name+'">');
    $("#loader_progect").hide();
    $('#hidden_image').val(name);
 }    
</script>   
<!-- ЗАГРУЗКА ЛОГОТИПА  -->
<div id="project_img"><?php echo (!empty($collection->preview))? CHtml::image('/uploads/'.$collection->preview) : '' ?></div>
<form action="/catalog/uploadCollection" target="zFrame" method="POST" enctype="multipart/form-data" id="upload_project">      
    <iframe id="rFrame" name="zFrame" style="display:none;"></iframe>      
    <div class="row">
        <?php echo CHtml::link(CHtml::image('/images/add.png').' Загрузить превью', 'javascript://', array('onclick'=>'$("#img_project").focus().click()', 'class'=>'add', 'id'=>'add_preliminary_pr')); ?>
        <?php echo CHtml::fileField('img_project', '', array('size'=>8, 'onchange'=>'$("#upload_project").submit(); $("#loader_progect").show()', 'style'=>'opacity:0')) ?>
        <img src="/images/ajax-loader.gif" id="loader_progect" style="display:none;"/>
    </div> 
</form>
<br/>

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
    <?php echo $form->label($collection,'name'); ?>
    <?php echo $form->textField($collection,'name', array('size'=>88)); ?>
    <?php echo $form->error($collection,'name'); ?>
</div>
    
<div class="row">
    <?php echo $form->label($collection,'text'); ?>
    <?php echo $form->textArea($collection,'text', array('cols'=>80, 'rows'=>10, 'id'=>'textarea_text')); ?>
    <?php echo $form->error($collection,'text'); ?>
</div>  

<div class="row">
    <?php echo $form->label($collection,'brand_id'); ?>
    <?php echo Chtml::activeDropDownList($collection, 'brand_id', CHtml::listData(Brand::model()->findAll(), 'id', 'name'))?>
    <?php echo $form->error($collection,'brand_id'); ?>
</div>
    
 <?php if(isset($max_first))
        if($max_first)
            echo '<div class="errorMessage">Коллекций на главной странице должно быть не больше 6</div>';?> 
<div class="row rememberMe">    
    <?php echo CHtml::activeCheckBox($collection,'first_page'); ?>
    <?php echo $form->label($collection,'first_page'); ?>
</div>  

<div class="row" <?php echo ($collection->isNewRecord)? 'style="display:none"' : '' ?> <?php echo !($collection->first_page)? 'style="display:none"' : '' ?> id="textarea_first">
    <?php echo $form->label($collection,'first_text'); ?>
    <?php echo $form->textArea($collection,'first_text', array('cols'=>50, 'rows'=>5)); ?>
    <?php echo $form->error($collection,'first_text'); ?>
</div>      
   
  
<?php echo CHtml::hiddenField('Collection[preview]', $collection->preview, array('id'=>'hidden_image')); ?>  
<?php if(!$brand->isNewRecord) echo CHtml::hiddenField('Collection[id]', $collection->id); ?>
    
<?php echo CHtml::submitButton('Сохранить', array('onclick'=>'addNew(); return false;')); ?>
    
<?php $this->endWidget(); ?>
</div><!-- form -->   

<div id="upload_img_nic">
<form method="post" action="/project/SaveImage" id="form_magic_file" target="rFrame" enctype="multipart/form-data">
<iframe id="rFrame" name="rFrame" style="display: none"></iframe>    
<input name="nicImage" id="magic_file" type="file" style="opacity:0"/>
</form></div> 
 



