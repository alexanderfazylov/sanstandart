<?php
Yii::app()->clientScript->registerScriptFile('/js/jquery.js');
Yii::app()->clientScript->registerScriptFile('/js/first.js');
$this->pageTitle=Yii::app()->name; ?>

<div id="content" class="home">
    <?php if($first_collection): ?>
    <div class="collection fon">
        <div class="im">
            <?php 
                   $img = str_replace('sm_','',$first_collection[0]->preview);
                   echo CHtml::image('/uploads/'.$img, '', array('style'=>'width:650px')); 
            ?>
        </div>
        <div class="preview">
            <?php 
            foreach($first_collection as $collection){
                $img = str_replace('sm_','',$collection->preview);
                  echo CHtml::image('/uploads/sm_'.$img, '', array('style'=>'width:60px', 'onclick'=>'loadInfo('.$collection->id.')'));
            }?>
        </div>
        <div class="information">
            <h6><?php echo $first_collection[0]->name; ?></h6>
            <?php echo CHtml::link($first_collection[0]->brand->name, '/catalog/viewBrand/'.$first_collection[0]->brand->id , array('style'=>'display:block; margin-bottom:15px;')); ?>
            <p><?php echo $first_collection[0]->first_text; ?></p>
            <p><?php echo CHtml::link('Перейти к коллекции &rarr;', array('/catalog/viewCollection', 'id'=>$first_collection[0]->id)); ?></p> 
        </div>
    </div>
    <?php endif; ?>

    <div class="news">
            <h6>Новости</h6>
            <ul>
                <?php foreach($news as $new){
                    echo '<li>';
                    echo CHtml::link($new->title, array('/news/view', 'id'=>$new->id)).'<br/>'.$new->first_text;
                    echo '</li>';
                 }?>
            </ul>
    </div>

    <div class="block bb">
            <h6>О компании</h6>
            <?php if(!empty($about_company->text))
                    echo '<p>'.str_replace("\n", '</p><p>', $about_company->text).'</p>'; ?>
    </div>

    <div class="block">
            <h6>Проекты</h6>
            <?php if(!empty($about_project->text))
                    echo '<p>'.str_replace("\n", '<br/>', $about_project->text).'</p>'; ?>
            
            <p>
             <?php foreach($project_files as $project_file)
                 echo CHtml::link(CHtml::image('/uploads/'.$project_file->brand), '/project/'.$project_file->id, array('style'=>'display:inline-block')); ?>
            </p>
    </div>

    <div class="carusel">
            <div class="fon">
                <div class="cont_galery">
                <span class="summ_width">     
                <?php foreach($galery_files as $galery_file){
                    preg_match_all('/<img[^>]*?src="\/uploads\/(.*?)"/', $galery_file->text, $images); 
                    if(count($images[1]) != 0){
                        echo CHtml::link(CHtml::image('/uploads/'.$images[1][0], '', array('style'=>'width:245px; margin-top:-30px;')), 'javascript://', array('onclick'=>'$("#title_news_dynamic").html("'.$galery_file->title.'")')) ;
                    }
                }?>    
                </span>
                </div>    
            </div>
            <div class="arrow"><img src="/images/carusel_left.gif" direction="left" /> <img src="/images/carusel_right.gif" direction="right" /></div>
            <p id="title_news_dynamic">ISH 2011: <?php  if($galery_files) echo $galery_files[0]->title; ?></p>
    </div>

    <ul class="service">
            <?php for($i=0; $i < 4; $i++){
                echo '<li>';
                $home_service = Page::model()->findByAttributes(array('source'=>'home_services', 'source_id'=>$i));
                if($home_service){
                  echo '<h6>'.$home_service->title.'</h6>';   
                  echo '<p>'.$home_service->text.'</p></span>';   
                }
                echo '</li>';    
            } ?>
    </ul>

    <div class="brand">
            <h6>Бренды</h6>
            <p>
                <?php foreach($brand_files as $brand_file)
                 echo CHtml::link('<img src="/uploads/'.$brand_file->image.'">', '/catalog/viewBrand/'.$brand_file->id); ?>
            </p>
    </div>
</div>    