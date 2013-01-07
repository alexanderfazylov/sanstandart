<?php 
Yii::app()->clientScript->registerScriptFile('/js/pr_nicEdit.js');
Yii::app()->clientScript->registerScriptFile('/js/news.js');
?>
<script type="text/javascript">
    bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
<script type="text/javascript">  
 function onResponse(d) {  
    eval('var obj = ' + d + ';'); 
    $('#finish_image').html('<img src="/uploads/'+obj.filename+'">');
    $('#edit_preview').show();
    $('#hidden_image').val(obj.filename);
    $('#add_preview').hide();
 }  
 function onProject(id, name) {  
    $('#project_img').html('<img src="/uploads/'+name+'">');
    $("#loader_progect").hide();
    $('#hidden_brand').val(name);
 }
</script> 
<!-- ЗАГРУЗКА ПРЕВЬЮШКИ  -->
<div class="prew">
    <div id="finish_image"><?php echo (!empty($model->preview))? CHtml::image('/uploads/'.$model->preview) : '' ?></div>
    <div style="<?php echo (empty($model->preview))? 'display: none;' : '' ?>margin-top: 8px;" id="edit_preview" onclick="$('#input_preview').click();"><?php echo CHtml::link(CHtml::image('/images/add.png').' Изменить', 'javascript://', array('class'=>'add')); ?></div>
    <?php echo (empty($model->preview))? CHtml::link(CHtml::image('/images/add.png').' Загрузить превью', 'javascript://', array('class'=>'add', 'onclick'=>"$('#input_preview').click();", 'id'=>'add_preview')) : '' ?>
</div>

<!-- ЗАГРУЗКА ЛОГОТИПА  -->
<div class="prew">
    <div id="project_img"><?php echo (!empty($model->brand))? CHtml::image('/uploads/'.$model->brand) : '' ?></div>
    <form action="/site/uploadProject" target="rFrame" method="POST" enctype="multipart/form-data" id="upload_project">      
        <iframe id="rFrame" name="rFrame" style="display:none">  
        </iframe>      
        <div class="row">
            <?php echo CHtml::link(CHtml::image('/images/add.png').' Загрузить бренд', 'javascript://', array('onclick'=>'$("#img_project").focus().click()', 'class'=>'add', 'id'=>'add_preliminary_pr')); ?>
            <?php echo CHtml::fileField('img_project', '', array('size'=>8, 'onchange'=>'$("#upload_project").submit(); $("#loader_progect").show()', 'style'=>'opacity:0')) ?>
            <img src="/images/ajax-loader.gif" id="loader_progect" style="display:none;"/>
        </div> 
    </form>
</div>
<div style="clear:both"></div>
<br/>
<div class="form" id="addCategory">
    <form action="/project/upload" target="rFrame" method="POST" enctype="multipart/form-data" id="upload_preview">      
        <iframe id="rFrame" name="rFrame" style="display:none">  
        </iframe>      
        <div class="row">
            <?php echo CHtml::fileField('preview', '', array('size'=>10, 'onchange'=>'$("#upload_preview").submit()', 'id'=>'input_preview', 'style'=>'opacity:0')) ?>
        </div>
    </form>  
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
    
<div class="row">
    <?php echo $form->label($model,'city_project_id'); ?>
    <?php echo Chtml::activeDropDownList($model, 'city_project_id', CHtml::listData(CityProject::model()->findAll(), 'id', 'name'))?>
    <?php echo $form->error($model,'city_project_id'); ?>
</div>     
<?php echo CHtml::hiddenField('Project[preview]', $model->preview, array('id'=>'hidden_image')); ?>   
<?php echo CHtml::hiddenField('Project[brand]', $model->brand, array('id'=>'hidden_brand')); ?>    
    
<?php if(!$model->isNewRecord) echo CHtml::hiddenField('Project[id]', $model->id); ?>    

  <?php if(isset($max_first))
        if($max_first)
            echo '<div class="errorMessage">Изображений бренда на главной странице должно быть не больше 5</div>';?>    
<div class="row rememberMe">    
    <?php echo CHtml::activeCheckBox($model,'first_page'); ?>
    <?php echo $form->label($model,'first_page'); ?>
</div>    
    
<?php echo CHtml::submitButton('Сохранить', array('onclick'=>'addNew(); return false;')); ?>
    
<?php $this->endWidget(); ?>
</div><!-- form --> 

<div id="upload_img_nic">
<form method="post" action="/project/SaveImage" id="form_magic_file" target="rFrame" enctype="multipart/form-data">
<iframe id="rFrame" name="rFrame" style="display: none"></iframe>    
<input name="nicImage" id="magic_file" type="file" style="opacity:0"/>
</form></div> 
