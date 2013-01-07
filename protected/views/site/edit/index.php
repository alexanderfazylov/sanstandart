<?php 
Yii::app()->clientScript->registerScriptFile('/js/jquery.js');
Yii::app()->clientScript->registerScriptFile('/js/first.js');
$this->pageTitle=Yii::app()->name; ?>
<script type="text/javascript"> 
 function onProject(id, name) {  
    $('#project_img').append('<span id="_image'+id+'" style="display:inline-block; margin-right:40px;"><img src="/uploads/'+name+'"><a class="delete" href="javascript://" onclick="deleteImg('+id+')"><img alt="" src="/images/del2.png" title="удалить"></a></span>');
    $("#loader_progect").hide();
 }  
 function onBrand(id, name) {  
    $('#upload_img_brand').append('<span id="_image'+id+'" style="display:inline-block; margin-right:40px;"><img src="/uploads/'+name+'"><a class="delete" href="javascript://" onclick="deleteImg('+id+')"><img alt="" src="/images/del2.png" title="удалить"></a></span>');
    $("#loader_brand").hide();
 }  
function onGalery(id, name) {  
    $('.carusel .fon .cont_galery .summ_width').append('<span id="_image'+id+'" style="margin-right:40px;"><img src="/uploads/'+name+'"><a class="delete" href="javascript://" onclick="deleteImg('+id+')"><img alt="" src="/images/del2.png" title="удалить"></a></span>');
    $("#loader_galery").hide();
 }  
</script> 

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
    <br/>
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
            <p>
            <?php if(!empty($about_company->text)){
                    echo str_replace("\n", '<br/>', $about_company->text); 
                    echo CHtml::link(CHtml::image('/images/blog.gif'), 'javascript://', array('onclick'=>'$(this).parent().hide(); $("#form_preliminary").show().find("textarea").select();', 'class'=>'edit')); 
   
                  }else
                    echo CHtml::link(CHtml::image('/images/add.png').' Добавить текст о компании', 'javascript://', array('onclick'=>'$("#add_preliminary").hide(); $("#form_preliminary").show();', 'class'=>'add', 'id'=>'add_preliminary'));   
            ?>
            </p>    
            <?php echo CHtml::form('/site/companyText', 'post', array('id'=>'form_preliminary', 'style'=>'display:none')); 
              echo CHtml::textArea('preliminary', ((!empty($about_company->text)) ? $about_company->text : ''), array('cols'=>'70'));
              echo '<br/>'.CHtml::submitButton('Сохранить');
              echo CHtml::endForm();
         ?>
    </div>

    <div class="block">
            <h6>Проекты</h6>
            <p>
            <?php if(!empty($about_project->text)){
                    echo str_replace("\n", '<br/>', $about_project->text);
                    echo CHtml::link(CHtml::image('/images/blog.gif'), 'javascript://', array('onclick'=>'$(this).parent().hide(); $("#form_preliminary_project").show().find("textarea").select();', 'class'=>'edit')); 
   
                  }else
                    echo CHtml::link(CHtml::image('/images/add.png').' Добавить текст о проектах', 'javascript://', array('onclick'=>'$("#add_preliminary_pr").hide(); $("#form_preliminary_project").show();', 'class'=>'add', 'id'=>'add_preliminary_pr'));   
            ?>
            </p>
             <?php echo CHtml::form('/site/projectText', 'post', array('id'=>'form_preliminary_project', 'style'=>'display:none')); 
              echo CHtml::textArea('preliminary', ((!empty($about_project->text)) ? $about_project->text : ''), array('cols'=>'70'));
              echo '<br/>'.CHtml::submitButton('Сохранить');
              echo CHtml::endForm();
             ?>  
            
            
             <p id="project_img">
                 <?php foreach($project_files as $project_file)
                          echo CHtml::link(CHtml::image('/uploads/'.$project_file->brand), '/project/'.$project_file->id); ?>
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
            <p id="title_news_dynamic"><?php  if($galery_files) echo $galery_files[0]->title; ?></p>
    </div>

    <ul class="service">
            <?php for($i=0; $i < 4; $i++){
                    echo '<li>';
                    $home_service = Page::model()->findByAttributes(array('source'=>'home_services', 'source_id'=>$i));
                    if($home_service){
                      echo '<span id="service_content'.$i.'"><h6>'.$home_service->title.
                               CHtml::link(CHtml::image('/images/blog.gif'), 'javascript://', array('onclick'=>'$("#service_content'.$i.'").hide(); $("#form_preliminary'.$i.'").show().find("textarea").select();', 'class'=>'edit')).
                              '</h6>';   
                      echo '<p>'.$home_service->text.'</p></span>';   
                    }else{
                       echo CHtml::link(CHtml::image('/images/add.png').' Добавить текст услуги', 'javascript://', array('onclick'=>'$("#add_preliminary'.$i.'").hide(); $("#form_preliminary'.$i.'").show();', 'class'=>'add', 'id'=>'add_preliminary'.$i.'')); 
                    }
                    
                  echo CHtml::form('/site/homeService', 'post', array('id'=>'form_preliminary'.$i, 'style'=>'display:none')); 
                  echo CHtml::textField('Service[title]', ((isset($home_service->title))? $home_service->title : ""), array('size'=>'18'));
                  echo CHtml::textArea('Service[text]', ((isset($home_service->text))? $home_service->text : ""), array('cols'=>'28'));
                  echo CHtml::hiddenField('Service[id]', $i);
                  echo '<br/>'.CHtml::submitButton('Сохранить');
                  echo CHtml::endForm();
                  
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