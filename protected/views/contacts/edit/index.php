<?php
Yii::app()->clientScript->registerScriptFile('/js/news.js');
Yii::app()->clientScript->registerScriptFile('/js/map.js');
$this->pageTitle=Yii::app()->name . ' - Контакты';
$this->breadcrumbs=array(
	''
);?>
<div id="content" class="contact">
        <h1>Контакты</h1>
        <div id="YMapsID" class="map" style="width:620px;height:300px"></div>
        <?php
                    
            foreach($cities as $city){
                echo '<h2>'.$city->name.'</h2>';
                $i = 0;
                foreach($addresses[$city->id] as $address_city){
                    foreach($address_city as $address){
                       if($i == 0){ $one_adress = $address; $one_city = $city->name; }
                        ?>
                    <div class="adr">
                      <p><?php echo $address->type.' '.$address->name?>
                          <?php echo CHtml::link(CHtml::image('/images/blog.gif', '', array('title'=>'редактировать')), array('/contacts/edit', 'id'=>$address->id), array('class'=>'edit')).' '.
                            CHtml::link(CHtml::image('/images/del2.png', '', array('title'=>'удалить')), array('/contacts/delete', 'id'=>$address->id), array('class'=>'delete', 'confirm'=>"Вы действительно хотите удалить объект ". $address->name ."?")) ?>
                      </p>
                      <p><?php echo CHtml::link($address->address, 'javascript://', array('onclick'=>(($address->code !=0)? 'showAddress("",false,"'.$address->code.'");' : 'showAddress("'.$city->name.', '.$address->address.'");').' showTime('.$address->id.')'));  ?><br />
                      тел.: <?php echo $address->phone ?></p>
                    </div>
          <?php  $i++;   }
                }
            }?>
        
</div><!-- #content-->

<div class="sidebar" id="sideRight">
        <div class="bl">
                <div class="schedule">
                        <h6><?php echo isset($one_adress->name) ? $one_adress->name : ''; ?></h6>
                        <?php if(isset($one_adress->day_time)): ?>
                        <ul>
                                <li class="<?php echo DayType::model()->findByPk($one_adress->day_time->day_week->monday)->column; ?>">Пн</li>
                                <li class="<?php echo DayType::model()->findByPk($one_adress->day_time->day_week->tuesday)->column; ?>">Вт</li>
                                <li class="<?php echo DayType::model()->findByPk($one_adress->day_time->day_week->wednesday)->column; ?>">Ср</li>
                                <li class="<?php echo DayType::model()->findByPk($one_adress->day_time->day_week->thursday)->column; ?>">Чт</li>
                                <li class="<?php echo DayType::model()->findByPk($one_adress->day_time->day_week->friday)->column; ?>">Пт</li>
                                <li class="<?php echo DayType::model()->findByPk($one_adress->day_time->day_week->saturday)->column; ?>">Сб</li>
                                <li class="<?php echo DayType::model()->findByPk($one_adress->day_time->day_week->sunday)->column; ?>">Вс</li>
                        </ul>
                        <p class="pn"><?php echo $one_adress->day_time->working_time->full_time ?></p>
                        <p class="sb"><?php echo $one_adress->day_time->working_time->part_time ?></p>
                        <p class="vs">Выходной</p> 
                        <?php endif; ?>
                </div>
        </div>
        <p><?php echo CHtml::link('Обратная связь', '/site/contact', array('class'=>'feedback'));?></p>    
        <div id="sideAdd">
           <?php echo CHtml::link(CHtml::image('/images/add.png').' добавить адрес', '/contacts/add', array('class'=>'add')); ?>
        </div>
        <div class="bl">
    <ul class="sub">
        <?php foreach ($cities as $city){
         echo '<li><span id="cat_'.$city->id.'">'.$city->name.' '.
                     CHtml::link(CHtml::image('/images/blog.gif', '', array('title'=>'редактировать')), 'javascript://', array('class'=>'edit', 'onclick'=>'showEdit('.$city->id.')')).' '.
                     CHtml::link(CHtml::image('/images/del2.png', '', array('title'=>'удалить')), array('/contacts/deleteCity', 'id'=>$city->id), array('class'=>'delete', 'confirm'=>"Вы действительно хотите удалить город ". $city->name ." и все его адреса?"))
                 .'</span><span id="form_cat_'.$city->id.'" style="display:none;"><input type="text" value="'.$city->name.'"/> <input type="submit" value="ok" onclick="saveCity('.$city->id.')" /></span>'
            .'</li>';  
        }?>
    </ul>
        <?php echo CHtml::link(CHtml::image('/images/add.png').' добавить город', 'javascript://', array('class'=>'add', 'id'=>'link_addCategory')); ?>
        <div class="form" id="addCategory" style="display:none;">
        <?php $form=$this->beginWidget('CActiveForm', array(
                'action'=>'/contacts/AddCity',
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                ),
        )); ?>
            
        <div class="row">
            <?php echo $form->label(City::model(),'name'); ?>
            <?php echo $form->textField(City::model(),'name'); ?>
            <?php echo CHtml::submitButton('ок'); ?>
            <?php echo $form->error(City::model(),'name'); ?>
        </div>
            
        <?php $this->endWidget(); ?>
        </div><!-- form -->

        </div> 

</div><!-- .sidebar#sideRight -->
<script type="text/javascript">
$(document).ready(function(){
    <?php if(isset($one_city) && isset($one_adress->address) && !isset($_GET['address'])): ?>
    <?php if($one_adress->code !=0)
            echo 'showAddress("",false,"'.$one_adress->code.'")';
          else
            echo 'showAddress("'.$one_city.', '.$one_adress->address.'")';
           
              
        ?>        
    <?php endif; ?>
    <?php if(isset($_GET['address'])){
             $addr = Address::model()->findByPk($_GET['address']);
          if($addr->code !=0)
            echo 'showAddress("",false,"'.$addr->code.'");';
          else
            echo 'showAddress("'.$addr->city->name.', '.$addr->address.'");';
          
          echo 'showTime('.$addr->id.');';
    }?>    
});
</script>
