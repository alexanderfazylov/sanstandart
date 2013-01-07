<?php
$this->pageTitle=Yii::app()->name . ' - Новости в черновиках';
Yii::app()->clientScript->registerScriptFile('/js/news.js');
$this->breadcrumbs=array(
	'Пресс-центр'=>array('/news'),
        'Новости в черновиках',
);
?>
<div id="content" class="presscenter">
       <h1>Новости в черновиках</h1>
       <?php 
             foreach($news as $new){ ?>
       
                <p class="hd"><span>&rarr;</span>
                 <?php echo CHtml::link($new->title, array('/news/view/' , 'id'=>$new->id));
                    echo CHtml::link(CHtml::image('/images/edit.png', '', array('title'=>'редактировать')), array('/news/edit', 'id'=>$new->id), array('class'=>'edit')).' '.
                         CHtml::link(CHtml::image('/images/del.png', '', array('title'=>'удалить')), array('/news/delete', 'id'=>$new->id), array('class'=>'delete', 'confirm'=>"Вы действительно хотите удалить новость ". $new->title ."?")) 
                ?></p>
                <p><?php echo News::crop($new->text); ?></p>

        <? } ?>
</div><!-- #content-->