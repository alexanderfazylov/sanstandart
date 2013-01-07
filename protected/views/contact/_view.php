<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('city_id')); ?>:</b>
	<?php echo CHtml::encode($data->city_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('position')); ?>:</b>
	<?php echo CHtml::encode($data->position); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('weekdays_working_time')); ?>:</b>
	<?php echo CHtml::encode($data->weekdays_working_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('saturday_working_time')); ?>:</b>
	<?php echo CHtml::encode($data->saturday_working_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sunday_working_time')); ?>:</b>
	<?php echo CHtml::encode($data->sunday_working_time); ?>
	<br />

	*/ ?>

</div>