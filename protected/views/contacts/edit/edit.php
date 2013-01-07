<div id="content" class="add_address">
<h1>Редактирование адреса</h1>
<?php
    $this->renderPartial('edit/_form', array('address'=>$address, 'working_time'=>$working_time, 'day_week'=>$day_week)); ?>
</div>

<script>
$(document).ready(function(){
    <?php if($address->code !=0)
            echo 'setTimeout(function(){showAddress("",false,"'.$address->code.'")},400)';
          else{
              $city = City::model()->findByPk($address->city_id);
              echo 'showAddress("'.$city->name.', '.$address->address.'")';
          } 
              
        ?>
});
</script>