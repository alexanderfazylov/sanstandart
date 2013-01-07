<?php
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
                        
                        <p class="hd"><span>&rarr;</span><?php echo CHtml::link($new->title, array('/news/view/' , 'id'=>$new->id));?></p>
                        <p><?php echo News::crop($new->text); ?></p>
                        <?php if(isset($new->source)) echo '<p class="pst">'.$new->source.'</p>';  ?>
                     <? }
                }?>
            </div>   
       <? } ?>
</div><!-- #content-->

<div class="sidebar" id="sideRight">
    <div class="bl">
    <ul class="sub">
        <?php foreach ($categoryes as $category){
         echo '<li>'.CHtml::link($category->name, array('/news/category/', 'id'=>$category->id)).'</li>';  
        }?>
    </ul>
    </div>
    <p><?php echo CHtml::link('Обратная связь', '/site/contact', array('class'=>'feedback'));?></p>
</div> 
<!--sideRight -->