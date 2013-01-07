<?php
$this->pageTitle=Yii::app()->name . ' - '.CHtml::encode($new->title);
Yii::app()->clientScript->registerScriptFile('/js/news.js');
$this->breadcrumbs=array(
	'Пресс-центр' => array('/news'),
        $category->name => array('/news/category/', 'id'=>$category->id),
);
?>
<div id="content" class="view_news">
<p class="archive"><?php echo CHtml::link('Архив новостей', array('news/category/', 'id'=>$category->id)); ?></p>
<h1><?php echo CHtml::encode($new->title); 
          echo CHtml::link(CHtml::image('/images/blog.gif', '', array('title'=>'редактировать')), array('/news/edit', 'id'=>$new->id), array('class'=>'edit')).' '.
               CHtml::link(CHtml::image('/images/del2.png', '', array('title'=>'удалить')), array('/news/delete', 'id'=>$new->id), array('class'=>'delete', 'confirm'=>"Вы действительно хотите удалить новость ". $new->title ."?")) 
    ?></h1>
<?php echo $new->text; ?>
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