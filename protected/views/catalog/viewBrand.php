<?php
$this->pageTitle=Yii::app()->name . ' - '.$brand->name;
$this->breadcrumbs=array(
	'Каталог продукции' => '/catalog',
        
);
?>
<div id="content" class="factory">
  <h1><?php echo $brand->name?></h1>
  <div class="vb">
      <?php echo (!empty($brand->image)) ? CHtml::image('/uploads/'.$brand->image) : '' ?>
      <br />
      <?php echo (!empty($brand->site)) ? CHtml::link(str_replace('http://', '', $brand->site) , $brand->site, array('target'=>'_blank')) : '' ?>
      <br />
      <?php echo $brand->country ?>
  </div>
  <p><?php echo $brand->text; ?></p>
  <div class="fact">
    <?php foreach($brand->collection as $collection){
        echo '<div>'.CHtml::link( CHtml::image('/uploads/'.$collection->preview), '/catalog/viewCollection/'.$collection->id).'<br/>'.CHtml::link($collection->name, array('/catalog/viewCollection', 'id'=>$collection->id)).'</div>';
    } ?>  
  </div>
</div><!-- #content-->