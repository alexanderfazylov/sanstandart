<?php
$this->breadcrumbs=array(
	'Factories'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Factory', 'url'=>array('index')),
	array('label'=>'Create Factory', 'url'=>array('create')),
	array('label'=>'Update Factory', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Factory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Factory', 'url'=>array('admin')),
);
?>

<h1>View Factory #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
		'website',
		'country_id',
		'logo_id',
		'category_id',
		'position',
		'create_time',
		'update_time',
		'author_id',
	),
)); ?>
