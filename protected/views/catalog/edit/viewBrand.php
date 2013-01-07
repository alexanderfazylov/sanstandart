<?php
$this->pageTitle=Yii::app()->name . ' - '.$brand->name;
$this->breadcrumbs=array(
	'Каталог продукции' => '/catalog',
);
?>
<div id="content" class="factory">
  <h1><?php echo $brand->name .
          CHtml::link(CHtml::image('/images/blog.gif', '', array('title'=>'редактировать')), array('/catalog/editBrand', 'id'=>$brand->id), array('class'=>'edit')).' '.
          CHtml::link(CHtml::image('/images/del2.png', '', array('title'=>'удалить')), array('/catalog/deleteBrand', 'id'=>$brand->id), array('class'=>'delete', 'confirm'=>"Вы действительно хотите удалить бренд ". $brand->name ." и все его коллекции?"))
          ?></h1>
  <div class="vb">
      <?php echo (!empty($brand->image)) ? CHtml::image('/uploads/'.$brand->image) : '' ?>
      <br />
      <?php echo (!empty($brand->site)) ? CHtml::link(str_replace('http://', '', $brand->site) , $brand->site, array('target'=>'_blank')) : '' ?>
      <br />
      <?php echo $brand->country ?>
  </div>
  <p><?php echo $brand->text; ?></p>
  <div class="fact">
    <div id="sideAdd">
       <?php echo CHtml::link(CHtml::image('/images/add.png').' добавить коллекцию', '/catalog/addCollection', array('class'=>'add')); ?>
    </div>
    <?php foreach($brand->collection as $collection){
        echo '<div>'.CHtml::link( CHtml::image('/uploads/'.$collection->preview), '/catalog/viewCollection/'.$collection->id).'<br/>'.CHtml::link($collection->name, array('/catalog/viewCollection', 'id'=>$collection->id)).
                     CHtml::link(CHtml::image('/images/blog.gif', '', array('title'=>'редактировать')), array('/catalog/editCollection', 'id'=>$collection->id), array('class'=>'edit')).' '.
                     CHtml::link(CHtml::image('/images/del2.png', '', array('title'=>'удалить')), array('/catalog/deleteCollection', 'id'=>$collection->id), array('class'=>'delete', 'confirm'=>"Вы действительно хотите удалить коллекцию ". $collection->name ."?"))
                    .'</div>';
    } ?>  
  </div>
</div><!-- #content-->