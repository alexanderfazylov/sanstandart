<?php
$this->pageTitle=Yii::app()->name . ' - '.CHtml::encode($new->title);
$this->breadcrumbs=array(
	'Пресс-центр' => array('/news'),
        $category->name => array('/news/category/', 'id'=>$category->id),
);
?>
<div id="content" class="view_news">
<p class="archive"><?php echo CHtml::link('Архив новостей', array('news/category/', 'id'=>$category->id)); ?></p>
<h1><?php echo CHtml::encode($new->title); ?></h1>
<?php echo $new->text; ?>
<?php if(isset($new->source)) echo '<p class="pst" style="margin-top:8px;">'.$new->source.'</p>';  ?>
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