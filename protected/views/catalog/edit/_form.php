<script>
 function onBrand(name) {  
    $('#project_img').html('<img src="/uploads/'+name+'">');
    $("#loader_progect").hide();
    $('#hidden_image').val(name);
 }    
</script>   
<!-- ЗАГРУЗКА ЛОГОТИПА  -->
<div id="project_img"><?php echo (!empty($brand->image))? CHtml::image('/uploads/'.$brand->image) : '' ?></div>
<form action="/catalog/uploadBrand" target="rFrame" method="POST" enctype="multipart/form-data" id="upload_project">      
    <iframe id="rFrame" name="rFrame" style="display:none;"></iframe>      
    <div class="row">
        <?php echo CHtml::link(CHtml::image('/images/add.png').' Загрузить бренд', 'javascript://', array('onclick'=>'$("#img_project").focus().click()', 'class'=>'add', 'id'=>'add_preliminary_pr')); ?>
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
    <?php echo $form->label($brand,'name'); ?>
    <?php echo $form->textField($brand,'name', array('size'=>88)); ?>
    <?php echo $form->error($brand,'name'); ?>
</div>
    
<div class="row">
    <?php echo $form->label($brand,'site'); ?>
    <?php echo $form->textField($brand,'site', array('size'=>88)); ?>
    <?php echo $form->error($brand,'site'); ?>
</div> 

<div class="row">
    <?php echo $form->label($brand,'country'); ?>
    <?php echo $form->textField($brand,'country', array('size'=>88)); ?>
    <?php echo $form->error($brand,'country'); ?>
</div>      

    
<div class="row">
    <?php echo $form->label($brand,'text'); ?>
    <?php echo $form->textArea($brand,'text', array('cols'=>68, 'rows'=>5)); ?>
    <?php echo $form->error($brand,'text'); ?>
</div> 

<?php echo CHtml::label('Раздел', 'section')?>
<div class="row2">  
    <?php 
        $section = array();
        if(isset($edit_mod)){
            foreach($sections as $sect)
              $section[]= $sect->section_id; 
        }
    ?>
    <?php echo CHtml::checkBoxList('section', $section, CHtml::listData($us = Section::model()->findAll(), 'id', 'name'));?>
    <?php if(count($us) == 0 ) echo '! Создайте раздел.'; ?>
    <div id="Brand_section_em_" class="errorMessage" style="display:none;">Необходимо выбрать Раздел.</div>
</div>    
   
<?php echo CHtml::hiddenField('Brand[image]', $brand->image, array('id'=>'hidden_image')); ?>  
<?php if(!$brand->isNewRecord) echo CHtml::hiddenField('Brand[id]', $brand->id); ?>
    
 <?php if(isset($max_first))
        if($max_first)
            echo '<div class="errorMessage">Брендов на главной странице должно быть не больше 7</div>';?> 
<div class="row rememberMe">    
    <?php echo CHtml::activeCheckBox($brand,'first_page'); ?>
    <?php echo $form->label($brand,'first_page'); ?>
</div>      
    
<?php echo CHtml::submitButton('Сохранить', array('onclick'=>'validate(event)')); ?>
    
<?php $this->endWidget(); ?>
</div><!-- form -->   



<script>
    function validate(event){
        $('#Brand_section_em_').hide();
        $('.row2').removeClass('error');
        if($('.row2 input:checked').val() === undefined){
            $('#Brand_section_em_').show();
            $('.row2').addClass('error');
            event.preventDefault();
        }
    }
</script>    



