<?php
$this->pageTitle=Yii::app()->name . ' - Услуги';
$this->breadcrumbs=array(
	'Услуги',
);
?>
<div id="content" class="view_news">
<?php if($services){
    echo '<h1>'.$services[0]->title.'</h1>';
    echo $services[0]->text;
}?> 
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