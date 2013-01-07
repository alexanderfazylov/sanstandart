<?php
$this->pageTitle=Yii::app()->name . ' - '.$service->title;
$this->breadcrumbs=array(
	'Услуги' => array('/site/services'),
        $service->title,
);
?>
<div id="content" class="view_news">
<?php 
    echo '<h1>'.$service->title.'</h1>';
    echo $service->text;
?>    
</div><!-- #content-->

<div class="sidebar" id="sideRight">
    <div class="bl">
    <ul class="sub">
        <?php foreach ($services as $service){
         echo '<li>'.CHtml::link($service->title, array('/services/view/', 'id'=>$service->id)).'</li>'; 
        }?>
    </ul>
    </div>
    <p><?php echo CHtml::link('Обратная связь', '/site/contact', array('class'=>'feedback'));?></p>
</div> 
<!--sideRight --> 
