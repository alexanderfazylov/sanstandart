<?php
Yii::app()->clientScript->registerScriptFile('/js/news.js');
$this->pageTitle=Yii::app()->name . ' - Пресс-центр';
$this->breadcrumbs=array(
	'',
);
?>
<div id="content" class="presscenter">
        <h1>Пресс-центр</h1>
        <?php 
        $end = end($categoryes);
        foreach($categoryes as $category){ ?>
    
            <div class="mn <?php echo ($end->id != $category->id) ? 'bb' : ''; ?>">
                <p class="archive"><?php echo CHtml::link('Все материалы', array('news/category/', 'id'=>$category->id)); ?></p>
               <h3><?php echo $category->name; ?></h3>
               
               <? foreach($news[$category->id] as $news_category){ 
                     foreach($news_category as $new){ ?>
                        
                        <p class="hd">
                            <span>&rarr;</span><?php echo CHtml::link($new->title, array('/news/view/' , 'id'=>$new->id));?>
                            <?php echo CHtml::link(CHtml::image('/images/blog.gif', '', array('title'=>'редактировать')), array('/news/edit', 'id'=>$new->id), array('class'=>'edit')).' '.
                            CHtml::link(CHtml::image('/images/del2.png', '', array('title'=>'удалить')), array('/news/delete', 'id'=>$new->id), array('class'=>'delete', 'confirm'=>"Вы действительно хотите удалить новость ". $new->title ."?")) ?>
                        </p>
                        
                        <p><?php echo News::crop($new->text); ?></p>
                        <?php if(!empty($new->source)) echo '<p class="pst">'.$new->source.'</p>';  ?>
                     <? }
                }?>
            </div>   
       <? } ?>
</div><!-- #content-->

<div class="sidebar" id="sideRight">
    <div id="sideAdd">
       <?php echo CHtml::link(CHtml::image('/images/add.png').' добавить новость', '/news/add', array('class'=>'add')); ?>
    </div>
    <div class="bl">
    <ul class="sub">
        <?php foreach ($categoryes as $category){
         echo '<li><span id="cat_'.$category->id.'">'.CHtml::link($category->name, array('/news/category/', 'id'=>$category->id)).' '.
                     CHtml::link(CHtml::image('/images/blog.gif', '', array('title'=>'редактировать')), 'javascript://', array('class'=>'edit', 'onclick'=>'showEdit('.$category->id.')')).' '.
                     CHtml::link(CHtml::image('/images/del2.png', '', array('title'=>'удалить')), array('/news/deleteCategory', 'id'=>$category->id), array('class'=>'delete', 'confirm'=>"Вы действительно хотите удалить раздел ". $category->name ." и все его содержимое?"))
                 .'</span><span id="form_cat_'.$category->id.'" style="display:none;"><input type="text" value="'.$category->name.'"/> <input type="submit" value="ok" onclick="saveCategory('.$category->id.')" /></span>'
            .'</li>';  
        }?>
        <li><?php echo CHtml::link('Новости в черновиках ('.News::draftCount().')', '/news/draft');?></li>
    </ul>
        <?php echo CHtml::link(CHtml::image('/images/add.png').' добавить раздел', 'javascript://', array('class'=>'add', 'id'=>'link_addCategory')); ?>
        <div class="form" id="addCategory" style="display:none;">
        <?php $form=$this->beginWidget('CActiveForm', array(
                'action'=>'/news/AddCategory',
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                ),
        )); ?>
            
        <div class="row">
            <?php echo $form->label(NewsCategory::model(),'name'); ?>
            <?php echo $form->textField(NewsCategory::model(),'name'); ?>
            <?php echo CHtml::submitButton('ок'); ?>
            <?php echo $form->error(NewsCategory::model(),'name'); ?>
        </div>
            
        <?php $this->endWidget(); ?>
        </div><!-- form -->

        </div>   
    <p><?php echo CHtml::link('Обратная связь', '/site/contact', array('class'=>'feedback'));?></p>
</div>
<!--sideRight -->