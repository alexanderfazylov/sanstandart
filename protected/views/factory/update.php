<?php
$this->breadcrumbs=array(
	'Factories'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Factory', 'url'=>array('index')),
	array('label'=>'Create Factory', 'url'=>array('create')),
	array('label'=>'View Factory', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Factory', 'url'=>array('admin')),
);
?>

<h1>Update Factory <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>