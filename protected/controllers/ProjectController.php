<?php

class ProjectController extends Controller
{
    public $layout='main';
    public $autorize='';
    
    public function init() {
        parent::init();
        if(!Yii::app()->user->isGuest)
            $this->autorize = 'edit/'; 
    } 
    
    public function filters(){
        
        return array(
            array(
                'application.filters.PerformanceFilter - index, view',
            ),
        );
    }
    
    public function actionIndex(){
        $start_text = Page::model()->findByAttributes(array('source' => 'project'));
        $cityes = CityProject::model()->findAll();
        $projects = array();
        foreach($cityes as $city){
            $projects[$city->id][] = Project::model()->findAllByAttributes(array('city_project_id'=>$city->id));
        }
        $this->render($this->autorize.'index', array('start_text' => $start_text, 'cityes'=>$cityes, 'projects'=>$projects));
    }
    
    public function actionView($id){
        if(!empty($id)){
            $cityes = CityProject::model()->findAll();
            $projects = array();
            foreach($cityes as $city){
                $projects[$city->id][] = Project::model()->findAllByAttributes(array('city_project_id'=>$city->id));
            }
            $project = Project::model()->findByPk((int)$id);
            $this->render($this->autorize.'view', array('project'=>$project, 'cityes'=>$cityes, 'projects'=>$projects));
        }
    }
    
    public function actionAdd(){
        $model = new Project();
        $max_first = false;
        
        if(isset($_POST['Project'])){
            // Ограничение на 5 штук 
           if($_POST['Project']['first_page']){
               $collec = Project::model()->findAllByAttributes(array('first_page'=>'1')); 
               if(count($collec) >= 5)
                   $max_first = true;
           } 
            
            $model->setAttributes($_POST['Project']);
            $model->text = $_POST['Project']['text'];
            
            if(!$max_first){
                $model->save(false);
                $this->redirect('/project/view/'.$model->id);
            }
            
        }
        $this->render('edit/add', array('model'=>$model, 'max_first'=>$max_first));
    }
    
    public function actionPreliminary(){
        if(isset($_POST['preliminary'])){
            $project = Page::model()->findByAttributes(array('source' => 'project'));
            if(!$project)
                $project = new Page;
            
            $project->source = 'project';
            $project->text = $_POST['preliminary'];
            $project->save(false);
            
            $this->redirect('/project');
            
        }
    }
    
    public function actionAddCity(){
        if(isset($_POST['CityProject'])){
            $city = new CityProject();
            $city->setAttributes($_POST['CityProject']);
            $city->save(false);
            $this->redirect('/project');
        }
    } 
    
    public function actionEditCity(){
        if(isset($_POST['city_id']) && isset($_POST['name'])){
            
            $city = CityProject::model()->findByPk((int)$_POST['city_id']);
            $city->name = CHtml::encode($_POST['name']);
            $city->save(false);
            echo CJSON::encode(array('status'=>'success'));
        }
    }
    
    public function actionEdit($id){
        $max_first = false;
        if(isset($_POST['Project'])){
            $id = (int)$_POST['Project']['id'];
            $model = Project::model()->findByPk((int)$_POST['Project']['id']);
            
            // Ограничение на 5 штук 
           if($_POST['Project']['first_page'] && $model->first_page == 0){
               $collec = Project::model()->findAllByAttributes(array('first_page'=>'1')); 
               if(count($collec) >= 5)
                   $max_first = true;
           } 
            
            $model->setAttributes($_POST['Project']);
            $model->text = $_POST['Project']['text'];
            
            if(!$max_first){
                $model->save(false);
                $this->redirect('/project/view/'.$model->id);
            }
            
        }
        if(!empty($id)){
            $project = Project::model()->findByPk((int)$id);
            $this->render('edit/edit', array('model'=>$project, 'max_first'=>$max_first));
        }
    }
    
    public function actionDelete($id){
        if(!empty($id)){
            Project::model()->findByPk((int)$id)->delete();
            $this->redirect('/project');
        }
    }
    
    public function actionDeleteCity($id){
        if(!empty($id)){
            CityProject::model()->findByPk((int)$id)->delete();
            Project::model()->deleteAll('city_project_id=:city_project_id', array(':city_project_id'=>(int)$id));
            $this->redirect('/project');
        }
    }
    
    public function actionUpload(){
      $image = CUploadedFile::getInstanceByName('preview');
      $upload = Yii::getPathOfAlias('webroot').'/uploads/';
      if($image !== null){
          $file_name = md5(time().rand(1,5000)).'.'.$image->extensionName; 
          $sucsave = $image->saveAs($upload.$file_name);
          
          $pic = Yii::app()->ih->load($upload. $file_name);
          if($pic->getWidth() > $pic->getHeight())
             $pic->resize(false, '63');
          else      
             $pic->resize('63', false); 

          $pic->crop('63', '63');
          if($image->type != 'image/png')
             $pic->watermark($_SERVER['DOCUMENT_ROOT'] . '/images/wt.png', 0, 0, CImageHandler::CORNER_LEFT_BOTTOM);
          $pic->save($upload . $file_name);
          
          $this->jsOnResponse("{'filename':'" . $file_name . "'}");  
      }  
    }
    
    public function actionSaveImage(){
          $image = CUploadedFile::getInstanceByName('nicImage');
          $upload = Yii::getPathOfAlias('webroot').'/uploads/';
          if($image !== null){
              $file_name = md5(time().rand(1,5000)).'.'.$image->extensionName; 
              $sucsave = $image->saveAs($upload.$file_name);

              $pic = Yii::app()->ih->load($upload. $file_name);
              $pic->resize('565', false);
              $pic->save($upload . $file_name);
              
              if($pic->getWidth() > $pic->getHeight())
                 $pic->resize(false, '63');
              else      
                 $pic->resize('63', false); 
                   
              $pic->crop('63', '63');
              $pic->save($upload . 'sm_'.$file_name);
               
              $session = new CHttpSession();
              $session->open();
              $session['file_name'] = $file_name;   
          } 
        }
    
    public function actionConvert(){
          $session = new CHttpSession();
          $session->open();
          if(!empty($session['file_name'])){
             $content = Project::convert($_POST['text'], $session['file_name']);
             echo CJSON::encode(array('status'=>'success', 'text'=>$content));
             unset($session['file_name']);
          }else{
              echo CJSON::encode(array('status'=>'failure'));
          }
        }
    
    private function jsOnResponse($obj) {
        echo ' 
         <script type="text/javascript"> 
         window.parent.onResponse("'.$obj.'"); 
         </script> 
         ';  
    } 
}
