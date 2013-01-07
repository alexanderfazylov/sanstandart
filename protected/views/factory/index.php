<?php
$this->breadcrumbs=array(
	'Factories',
);

$this->menu=array(
	array('label'=>'Create Factory', 'url'=>array('create')),
	array('label'=>'Manage Factory', 'url'=>array('admin')),
);
?>

<h1>Factories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
