<?php
$this->pageTitle=Yii::app()->name . ' - '.$category->name;
$this->breadcrumbs=array(
	'Пресс-центр'=>array('/news'),
        $category->name,
);
?>
<div id="content" class="presscenter">
       <h1><?php echo CHtml::encode($category->name);?></h1>
       <div style="margin-left: 20px">
       <?php 
             foreach($news as $new){ ?>
                
                <p class="hd">
                    <span>&rarr;</span><?php echo CHtml::link($new->title, array('/news/view/' , 'id'=>$new->id));?>
                    <?php echo CHtml::link(CHtml::image('/images/blog.gif', '', array('title'=>'редактировать')), array('/news/edit', 'id'=>$new->id), array('class'=>'edit')).' '.
                    CHtml::link(CHtml::image('/images/del2.png', '', array('title'=>'удалить')), array('/news/delete', 'id'=>$new->id), array('class'=>'delete', 'confirm'=>"Вы действительно хотите удалить новость ". $new->title ."?")) ?>
                </p>
                <p><?php echo News::crop($new->text); ?></p>
                <?php if(!empty($new->source)) echo '<p class="pst">'.$new->source.'</p>';  ?>
                
        <? } ?>
        </div>
</div><!-- #content-->
