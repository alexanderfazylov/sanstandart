<?php
$this->pageTitle=Yii::app()->name . ' - Проекты';
$this->breadcrumbs=array(
	''
);
?>
<div id="content" class="projects">
    <h1>Проекты</h1>
    <?php  if(!empty($start_text->text)) echo '<p>'.$start_text->text.'</p>'; ?>
        
     <?php foreach($cityes as $city){
            echo '<h3>'.$city->name.'</h3>';
            foreach($projects[$city->id] as $proj_city){
                foreach($proj_city as $project){ ?>
                    <table class="pr" cellpadding="0" border="0">
                        <tbody>
                            <tr>
                                <td>
                                    <?php echo CHtml::image('/uploads/'.$project->preview); ?>
                                </td>
                                <td valign="middle">
                                    <?php echo CHtml::link($project->title, array('/project/view', 'id'=>$project->id)); ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
          <?php }
            }
    }?>   
</div>
