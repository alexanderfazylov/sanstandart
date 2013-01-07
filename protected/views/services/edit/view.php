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
    <div id="sideAdd">
       <?php echo CHtml::link(CHtml::image('/images/add.png').' Добавить услугу', '/services/add', array('class'=>'add')); ?>
    </div>
    <div class="bl">
    <ul class="sub">
        <?php foreach ($services as $service){
         echo '<li>'.CHtml::link($service->title, array('/services/view/', 'id'=>$service->id)).' '.
                     CHtml::link(CHtml::image('/images/blog.gif', '', array('title'=>'редактировать')), array('/services/edit', 'id'=>$service->id), array('class'=>'edit')).' '.
                     CHtml::link(CHtml::image('/images/del2.png', '', array('title'=>'удалить')), array('/services/delete', 'id'=>$service->id), array('class'=>'delete', 'confirm'=>"Вы действительно хотите удалить услугу ". $service->title ."?"))
              .'</li>'; 
        }?>
    </ul>
    </div>
    <p><?php echo CHtml::link('Обратная связь', '/site/contact', array('class'=>'feedback'));?></p>
</div> 
<!--sideRight --> 
