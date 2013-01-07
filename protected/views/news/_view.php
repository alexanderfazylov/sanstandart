<p class="hd">
  <span>&rarr;</span>
  <?php echo CHtml::link(CHtml::encode($data->title), array('view', 'id'=>$data->id)); ?>
</p>
<p>
  <?php echo CHtml::encode($data->short_content); ?>
</p>
<?php if (!empty($data->source)):?>
<p class="pst">
  <?php echo CHtml::encode($data->source); ?>
</p>
<?php endif?>