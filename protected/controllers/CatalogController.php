<?php

class CatalogController extends Controller
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
                'application.filters.PerformanceFilter - index, viewBrand, viewCollection, infoBrand',
            ),
        );
    }
    
    public function actionInfoBrand(){
        if(isset($_POST['id'])){
           $collection =  Collection::model()->findByPk($_POST['id']);
           $div = '<h6>'.$collection->name.'</h6>';
           $div .=  CHtml::link($collection->brand->name, '/catalog/viewBrand/'.$collection->brand->id , array('style'=>'display:block; margin-bottom:15px;'));
           $div .= '<p>'.$collection->first_text.'</p>';
           $div .= '<p>'.CHtml::link('Перейти к коллекции &rarr;', array('/catalog/viewCollection', 'id'=>$collection->id)).'</p>';
           echo CJSON::encode(array('div'=>$div));
        }
    }
    
    public function actionIndex(){
        $criteria = new CDbCriteria();
        $criteria->limit = '12';
        $collections = Collection::model()->findAll($criteria);
        $section = Section::model()->with('brand')->findAll();
        $this->render($this->autorize.'index', array('section'=>$section, 'collections'=>$collections));
    }
    
    public function actionViewBrand($id){
        if(!empty($id)){
            $brand = Brand::model()->with('collection')->findByPk((int)$id);
            $this->render($this->autorize.'viewBrand', array('brand'=>$brand));
        }
    }
    
    public function actionViewCollection($id){
        $collection = Collection::model()->findByPk($id);
        $section = Section::model()->with('brand')->findAll();
        $this->render($this->autorize.'viewCollection', array('section'=>$section, 'collection'=>$collection));
    }
    
    public function actionAddCategory(){
        if(isset($_POST['Section'])){
           $category = new Section();
           $category->setAttributes($_POST['Section']);
           $category->save();
           $this->redirect('/catalog/index');
        }
    }
    
     public function actionAddBrand(){
        $brand = new Brand();
        $max_first = false;
        if(isset($_POST['Brand'])){            
           $brand->setAttributes($_POST['Brand']);
           $brand->site = 'http://'.str_replace('http://', '', $_POST['Brand']['site']);
           
           // Ограничение на 7 штук 
           if($_POST['Brand']['first_page'] && $model->first_page == 0){
               $collec = Brand::model()->findAllByAttributes(array('first_page'=>'1')); 
               if(count($collec) >= 7)
                   $max_first = true;
           } 
           
           if(!$max_first && $brand->validate()){
               $brand->save(false);
               foreach($_POST['section'] as $section){
                   $sect = new RelSection();
                   $sect->brand_id = $brand->id;
                   $sect->section_id = $section;
                   $sect->save(false);
               }
               $this->redirect('/catalog/viewBrand/'.$brand->id);
           }
        }
        $this->render('edit/add', array('brand'=>$brand, 'max_first'=>$max_first));
    }
    
    public function actionEditBrand($id){
        $max_first = false;
        
        if(isset($_POST['Brand']['id']))
            $id = $_POST['Brand']['id'];
        
        $model = Brand::model()->findByPk((int)$id);
        if(isset($_POST['Brand'])){            
            $model->site = 'http://'.str_replace('http://', '', $_POST['Brand']['site']);
            
            // Ограничение на 7 штук 
           if($_POST['Brand']['first_page'] && $model->first_page == 0){
               $collec = Brand::model()->findAllByAttributes(array('first_page'=>'1')); 
               if(count($collec) >= 7)
                   $max_first = true;
           } 
           
           $model->setAttributes($_POST['Brand']);
            
            if(!$max_first){
                $model->save(false);
                $this->redirect('/catalog/viewBrand/'.$model->id);
            }
        }
            
            $sections = RelSection::model()->findAll('brand_id=:brand_id', array(':brand_id'=>$model->id));
            $this->render('edit/edit', array('brand'=>$model, 'sections'=>$sections, 'max_first'=>$max_first));
        
    } 
    
    public function actionUploadBrand(){
          $image = CUploadedFile::getInstanceByName('img_project');
          $upload = Yii::getPathOfAlias('webroot').'/uploads/';
          if($image !== null){
              $file_name = md5(time().rand(1,5000)).'.'.$image->extensionName; 
              $sucsave = $image->saveAs($upload.$file_name);

              $pic = Yii::app()->ih->load($upload. $file_name);
              $pic->resize('191', false);
              $pic->save($upload . $file_name);

              echo '<script>window.parent.onBrand("'.$file_name.'");</script>'; 
          }  
    }
    
    public function actionUploadCollection(){
          $image = CUploadedFile::getInstanceByName('img_project');
          $upload = Yii::getPathOfAlias('webroot').'/uploads/';
          if($image !== null){
              $file_name = md5(time().rand(1,5000)).'.'.$image->extensionName; 
              $sucsave = $image->saveAs($upload.$file_name);

              $pic = Yii::app()->ih->load($upload. $file_name);
              if($pic->getWidth() > $pic->getHeight())
                 $pic->resize(false, '113');
              else      
                 $pic->resize('150', false); 

              $pic->crop('150', '113');
              $pic->save($upload .'sm_'.$file_name);

              echo '<script>window.parent.onBrand("sm_'.$file_name.'");</script>'; 
          }  
    }
    
    public function actionDeleteSection($id){
        if(!empty($id)){
            Section::model()->findByPk($id)->delete();
            $this->redirect('/catalog/');
        }
    }
    
    public function actionDeleteCollection($id){
        if(!empty($id)){
            Collection::model()->findByPk($id)->delete();
            $this->redirect('/catalog/');
        }
    }
    
    public function actionDeleteBrand($id){
        if(!empty($id)){
            Brand::model()->findByPk($id)->delete();
            Collection::model()->deleteAll('brand_id=:brand_id', array(':brand_id'=>(int)$id));
            RelSection::model()->deleteAll('brand_id=:brand_id', array(':brand_id'=>(int)$id));
            $this->redirect('/catalog/');
        }
    }
    
    public function actionEditSection($id){
        if(isset($_POST['name'])){
            $section = Section::model()->findByPk($id);
            $section->name = $_POST['name'];
            $section->save(false);
            $this->redirect('/catalog/');
        }
    }
    
    public function actionAddCollection(){
        $collection = new Collection();
        if(isset($_POST['Collection'])){            
           $collection->setAttributes($_POST['Collection']);
           
           if($collection->first_page == 1){
               $mod = Collection::model()->findAll('first_page=:first_page', array(':first_page'=>1));
               foreach($mod as $collect){
                   $collect->first_page = 0;
                   $collect->save(false);
               }
           }
           
           if($collection->save(false)){
               $this->redirect('/catalog/viewCollection/'.$collection->id);
           }
        }
        $this->render('edit/addCollection', array('collection'=>$collection));
    }
    
    public function actionEditCollection($id){
        $collection = Collection::model()->findByPk($id);
        
        $max_first = false;
        if(isset($_POST['Collection'])){         
            
           // Ограничение на 6 штук 
           if($_POST['Collection']['first_page'] && $collection->first_page == 0){
               $collec = Collection::model()->findAllByAttributes(array('first_page'=>'1')); 
               if(count($collec) >= 6)
                   $max_first = true;
           } 
            
           $collection->setAttributes($_POST['Collection']);
           
           if(!$max_first && $collection->save(false)){
               $this->redirect('/catalog/viewCollection/'.$collection->id);
           }
        }
        $this->render('edit/editCollection', array('collection'=>$collection, 'max_first'=>$max_first));
    }
    
    
}
