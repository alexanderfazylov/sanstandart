<?php 
Yii::app()->clientScript->registerScriptFile('/js/news.js');
Yii::app()->clientScript->registerScriptFile('/js/map.js');
Yii::app()->clientScript->registerScriptFile('/js/map2.js');
?>
<div class="form" id="addCategory">
<?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>$action,
        'id'=>'add-new-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
                'validateOnSubmit'=>true,
        ),
)); ?>

<div class="row">
    <?php echo $form->label($address,'name'); ?>
    <?php echo $form->textField($address,'name', array('size'=>88)); ?>
    <?php echo $form->error($address,'name'); ?>
</div>
    
<div class="row">
    <?php echo $form->label($address,'type'); ?>
    <?php echo $form->textField($address,'type', array('size'=>88)); ?>
    <?php echo $form->error($address,'type'); ?>
</div>

<div class="row">
    <?php echo $form->label($address,'city_id'); ?>
    <?php echo Chtml::activeDropDownList($address, 'city_id', CHtml::listData(City::model()->findAll(), 'id', 'name'))?>
</div>    
    
<div class="row">
    <?php echo $form->label($address,'address'); ?>
    <?php echo $form->textArea($address,'address', array('cols'=>65, 'rows'=>1)); ?>
    <?php echo $form->error($address,'address'); ?>
</div> 

<div class="row">
    <?php echo $form->label($address,'phone'); ?>
    <?php echo $form->textField($address,'phone', array('size'=>88)); ?>
    <?php echo $form->error($address,'phone'); ?>
</div> 
    
<?php echo CHtml::hiddenField('Address[code]', $address->code) ?>    

<div class="update_select day_week">
    <h3>Режим работы</h3> 
    
    <?php $day_type = CHtml::listData(DayType::model()->findAll(), 'id', 'name'); ?>
    <div class="row">
        <b>пн</b> <span><img src="/images/pn.gif" /></span> <?php echo CHtml::activeDropDownList($day_week, 'monday', $day_type) ?>
    </div> 
    <div class="row">
        <b>вт</b> <span><img src="/images/pn.gif" /></span> <?php echo CHtml::activeDropDownList($day_week, 'tuesday', $day_type) ?>
    </div> 
    <div class="row">
        <b>ср</b> <span><img src="/images/pn.gif" /></span> <?php echo CHtml::activeDropDownList($day_week, 'wednesday', $day_type) ?>
    </div>
    <div class="row">
        <b>чт</b> <span><img src="/images/pn.gif" /></span> <?php echo CHtml::activeDropDownList($day_week, 'thursday', $day_type) ?>
    </div>
    <div class="row">
        <b>пт</b> <span><img src="/images/pn.gif" /></span> <?php echo CHtml::activeDropDownList($day_week, 'friday', $day_type) ?>
    </div>
    <div class="row">
        <b>сб</b> <span><img src="/images/pn.gif" /></span> <?php echo CHtml::activeDropDownList($day_week, 'saturday', $day_type) ?>
    </div>
    <div class="row">
        <b>вс</b> <span><img src="/images/pn.gif" /></span> <?php echo CHtml::activeDropDownList($day_week, 'sunday', $day_type) ?>
    </div>
</div>
    
<div class="day_week">
    <h3>Время работы</h3> 
    
    <div class="row">
        <?php echo $form->label($working_time,'full_time'); ?>
        <img src="/images/pn.gif" /> c <?php echo $form->textField($working_time, 'full_time_from', array('size'=>6)); ?> до <?php echo $form->textField($working_time, 'full_time_to', array('size'=>6)); ?>
        <?php echo $form->error($working_time,'full_time'); ?>
    </div>
    <div class="row">
        <?php echo $form->label($working_time,'part_time'); ?>
        <img src="/images/sb.gif" /> c <?php echo $form->textField($working_time, 'part_time_from', array('size'=>6)); ?> до <?php echo $form->textField($working_time, 'part_time_to', array('size'=>6)); ?>
        <?php echo $form->error($working_time,'full_time'); ?>
    </div>
</div>   
<div style="clear: both"></div>    

<div id="YMapsID" class="map" style="width:620px;height:300px"></div>

<?php if(!$address->isNewRecord) echo CHtml::hiddenField('Address[id]', $address->id); ?>
    
<?php echo CHtml::submitButton('Сохранить'); ?>
    
<?php $this->endWidget(); ?>
</div><!-- form -->   



