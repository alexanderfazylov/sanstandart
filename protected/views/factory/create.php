<?php
$this->breadcrumbs=array(
	'Factories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Factory', 'url'=>array('index')),
	array('label'=>'Manage Factory', 'url'=>array('admin')),
);
?>

<h1>Create Factory</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>