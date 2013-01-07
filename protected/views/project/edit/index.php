<?php
Yii::app()->clientScript->registerScriptFile('/js/news.js');
$this->pageTitle=Yii::app()->name . ' - Проекты';
$this->breadcrumbs=array(
	''
);
?>
<div id="content" class="projects add_address">
    <h1>Проекты</h1>
    <p><?php if(!empty($start_text->text)){
         echo $start_text->text;   
         echo CHtml::link(CHtml::image('/images/blog.gif'), 'javascript://', array('onclick'=>'$(this).parent().hide(); $("#form_preliminary").show().find("textarea").select();', 'class'=>'edit')); 
    }else{
         echo CHtml::link(CHtml::image('/images/add.png').' Добавить предварительный текст', 'javascript://', array('onclick'=>'$("#add_preliminary").hide(); $("#form_preliminary").show();', 'class'=>'add', 'id'=>'add_preliminary')); 
    } ?></p>
    <?php echo CHtml::form('/project/preliminary', 'post', array('id'=>'form_preliminary', 'style'=>'display:none')); 
          echo CHtml::textArea('preliminary', $start_text->text, array('cols'=>'70'));
          echo '<br/>'.CHtml::submitButton('Сохранить');
          echo CHtml::endForm();
     ?>
    
    <?php foreach($cityes as $city){
            echo '<h3>'.$city->name.'</h3>';
            foreach($projects[$city->id] as $proj_city){
                foreach($proj_city as $project){ ?>
                    <table class="pr" cellpadding="0" border="0">
                        <tbody>
                            <tr>
                                <td>
                                    <?php echo CHtml::image('/uploads/'.$project->preview); ?>
                                </td>
                                <td valign="middle">
                                    <?php echo CHtml::link($project->title, array('/project/view', 'id'=>$project->id)); ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                     <?php echo CHtml::link(CHtml::image('/images/blog.gif', '', array('title'=>'редактировать')), array('/project/edit', 'id'=>$project->id), array('class'=>'edit')).' '.
                            CHtml::link(CHtml::image('/images/del2.png', '', array('title'=>'удалить')), array('/project/delete', 'id'=>$project->id), array('class'=>'delete', 'confirm'=>"Вы действительно хотите удалить проект ". $project->title ."?")) ?>
                    
          <?php }
            }
    }?>
</div>

<div class="sidebar" id="sideRight">
    <div id="sideAdd">
       <?php echo CHtml::link(CHtml::image('/images/add.png').' Добавить проект', '/project/add', array('class'=>'add')); ?>
    </div>
    <div class="bl">
    <ul class="sub">
        <?php foreach ($cityes as $city){
         echo '<li><span id="cat_'.$city->id.'">'.$city->name.' '.
                     CHtml::link(CHtml::image('/images/blog.gif', '', array('title'=>'редактировать')), 'javascript://', array('class'=>'edit', 'onclick'=>'showEdit('.$city->id.')')).' '.
                     CHtml::link(CHtml::image('/images/del2.png', '', array('title'=>'удалить')), array('/project/deleteCity', 'id'=>$city->id), array('class'=>'delete', 'confirm'=>"Вы действительно хотите удалить город ". $city->name ." и все его проекты?"))
                 .'</span><span id="form_cat_'.$city->id.'" style="display:none;"><input type="text" value="'.$city->name.'"/> <input type="submit" value="ok" onclick="saveCityProj('.$city->id.')" /></span>'
            .'</li>'; 
        }?>
    </ul>
        <?php echo CHtml::link(CHtml::image('/images/add.png').' добавить город', 'javascript://', array('class'=>'add', 'id'=>'link_addCategory')); ?>
        <div class="form" id="addCategory" style="display:none;">
        <?php $form=$this->beginWidget('CActiveForm', array(
                'action'=>'/project/AddCity',
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                ),
        )); ?>
            
        <div class="row">
            <?php echo $form->label(CityProject::model(),'name'); ?>
            <?php echo $form->textField(CityProject::model(),'name'); ?>
            <?php echo CHtml::submitButton('ок'); ?>
            <?php echo $form->error(CityProject::model(),'name'); ?>
        </div>
            
        <?php $this->endWidget(); ?>
        </div><!-- form -->
    </div>
</div> 