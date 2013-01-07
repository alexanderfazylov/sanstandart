<?php
$this->pageTitle=Yii::app()->name . ' - Пресс-центр';
?>

<?php
$this->breadcrumbs=array(
  'Пресс-центр'=>array('index'),
);
?>

<div id="container">
  <div id="content" class="presscenter">
    
    <?php if(isset($this->breadcrumbs)):?>
      <?php $this->widget('zii.widgets.CBreadcrumbs', array(
        'homeLink'=>CHtml::link('Главная', Yii::app()->homeUrl),
        'links'=>$this->breadcrumbs,
        'separator'=>' / ',
        'tagName'=>'p',
      )); ?><!-- breadcrumbs -->
    <?php endif?>
    
    <h1><?php echo Lookup::item('NewsType',$type); ?></h1>
    
    <div class="mn">
      <?php $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'_view',
        'template'=>'{items}',
        'emptyText'=>'Новостей в данной категории нет.',
      )); ?>
    </div>
  </div><!-- #content-->
</div><!-- #container-->

<div class="sidebar" id="sideRight">
  <div class="bl">
  <?php $this->widget('zii.widgets.CMenu',array(
    'items'=>array(
      array('label'=>'Новости компании', 'url'=>array('/news/archive', 'type'=>'1')),
      array('label'=>'Пресса о нас', 'url'=>array('/news/archive', 'type'=>'2')),
      array('label'=>'Новости индустрии', 'url'=>array('/news/archive', 'type'=>'3')),
    ),
    'htmlOptions'=>array(
      'class'=>'sub'
    ),
  )); ?> 
</div>
<p>
  <?php echo CHtml::mailto('Обратная связь', 'contact@sanstandart.ru', array('class'=>'feedback')); ?>
</p>
</div> 
<!--sideRight -->