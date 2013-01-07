<?php
Yii::app()->clientScript->registerScriptFile('/js/jquery.js');
Yii::app()->clientScript->registerScriptFile('/js/project.js');
$this->pageTitle=Yii::app()->name . ' - '.$project->title;
$this->breadcrumbs=array(
	'Проекты' => array('project/'),
);?>
<div id="content" class="project">
    <h1><?php echo $project->title; 
            echo CHtml::link(CHtml::image('/images/blog.gif', '', array('title'=>'редактировать')), array('/project/edit', 'id'=>$project->id), array('class'=>'edit')).' '.
               CHtml::link(CHtml::image('/images/del2.png', '', array('title'=>'удалить')), array('/project/delete', 'id'=>$project->id), array('class'=>'delete', 'confirm'=>"Вы действительно хотите удалить проект ". $project->title ."?")) 
        ?></h1>
    <?php echo $project->text ?>
</div><!-- #content-->
<div class="sidebar" id="sideRight">
    <div class="bl">
            <ul class="sity">
                <?php foreach($cityes as $city){

                    echo '<li city="'.$city->id.'" '.(($project->city_project_id == $city->id) ? 'class="act"' : '').'>'.CHtml::link($city->name, 'javascript://');
                    foreach($projects[$city->id] as $project_city){

                        echo '<ul projects="city_'.$city->id.'" '.(($project->city_project_id == $city->id) ? '' : 'style="display:none"').'>';
                        foreach($project_city as $proj){
                            echo '<li>'.CHtml::link($proj->title, array('/project/view', 'id'=>$proj->id)).'</li>';
                        }
                        echo '</ul>';
                    }
                    echo '</li>';
                } ?>
            </ul>
    </div>
</div><!-- .sidebar#sideRight -->                        