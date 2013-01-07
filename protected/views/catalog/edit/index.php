<?php
Yii::app()->clientScript->registerScriptFile('/js/news.js');
$this->pageTitle=Yii::app()->name . ' - Каталог';
$this->breadcrumbs=array(
	'',
);
?>
<div id="content" class="catalog">
        <h1>Каталог</h1>
        <?php foreach($collections as $collection){
            echo '<div class="cat">'.CHtml::link( CHtml::image('/uploads/'.$collection->preview), '/catalog/viewCollection/'.$collection->id).'<br/>'.$collection->name.'<br/>'.CHtml::link($collection->brand->name, array('/catalog/viewBrand', 'id'=>$collection->brand->id)) .'</div>';
        }?>
</div><!-- #content-->

<div class="sidebar" id="sideRight">
        <div id="sideAdd">
           <?php echo CHtml::link(CHtml::image('/images/add.png').' добавить бренд', '/catalog/addBrand', array('class'=>'add')); ?>
        </div>
        <div class="bl">
                <ul class="menu_cat">
                    <?php
                        foreach($section as $sect){
                            echo '<li>';
                            echo '<span id="sect_'.$sect->id.'" onclick="$(this).hide(); $(\'#form_'.$sect->id.'\').show();"><h6>'.$sect->name.
                                    CHtml::link(CHtml::image('/images/blog.gif', '', array('title'=>'редактировать')), 'javascript://', array('class'=>'edit')).' '.
                                    CHtml::link(CHtml::image('/images/del2.png', '', array('title'=>'удалить')), array('/catalog/deleteSection', 'id'=>$sect->id), array('class'=>'delete', 'confirm'=>"Вы действительно хотите удалить раздел ". $sect->name ." и все его коллекции?"))
                                   .'</h6></span>';
                                   echo CHtml::form('/catalog/editSection/'.$sect->id, 'post', array('id'=>'form_'.$sect->id, 'style'=>'display:none'));
                                   echo CHtml::textField('name', $sect->name);
                                   echo CHtml::submitButton('ok');
                                   echo CHtml::endForm();
                            
                            echo '<ul>';
                            foreach($sect->brand as $brand)
                                echo '<li>'.CHtml::link($brand->name, array('/catalog/viewBrand', 'id'=>$brand->id)).
                                    CHtml::link(CHtml::image('/images/blog.gif', '', array('title'=>'редактировать')), array('/catalog/editBrand', 'id'=>$brand->id), array('class'=>'edit')).' '.
                                    CHtml::link(CHtml::image('/images/del2.png', '', array('title'=>'удалить')), array('/catalog/deleteBrand', 'id'=>$brand->id), array('class'=>'delete', 'confirm'=>"Вы действительно хотите удалить бренд ". $brand->name ." и все его коллекции?"))
                                    .'</li>';
                             echo '</ul>';
                             echo '</li>';
                        }
                    ?>
                </ul>
                <?php echo CHtml::link(CHtml::image('/images/add.png').' добавить раздел', 'javascript://', array('class'=>'add', 'id'=>'link_addCategory')); ?>
                <div class="form" id="addCategory" style="display:none;">
                <?php $form=$this->beginWidget('CActiveForm', array(
                        'action'=>'/catalog/AddCategory',
                        'enableClientValidation'=>true,
                        'clientOptions'=>array(
                                'validateOnSubmit'=>true,
                        ),
                )); ?>

                <div class="row">
                    <?php echo $form->label(Section::model(),'name'); ?>
                    <?php echo $form->textField(Section::model(),'name'); ?>
                    <?php echo CHtml::submitButton('ок'); ?>
                    <?php echo $form->error(Section::model(),'name'); ?>
                </div>

                <?php $this->endWidget(); ?>
                </div><!-- form -->
        </div>

</div><!-- .sidebar#sideRight -->