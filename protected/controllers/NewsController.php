<?php

class NewsController extends Controller
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
                'application.filters.PerformanceFilter - index, view, category',
            ),
        );
    }

    public function actionIndex(){
        $news = array();
        $categoryes = NewsCategory::model()->findAll();
        foreach ($categoryes as $category){
            $criteria = new CDbCriteria();
            $criteria->order = 'id desc';
            $criteria->limit = '3';
            $criteria->compare('news_category_id', $category->id);
            $criteria->addCondition('(status_id != "1")');
            $news[$category->id][] = News::model()->findAll($criteria);
        }
        $this->render($this->autorize.'index', array('categoryes'=>$categoryes, 'news'=>$news));
    }
    
    public function actionView($id){
        if(!empty($id)){
             $categoryes = NewsCategory::model()->findAll();
             $new = News::model()->findByPk((int)$id);
             $category = $new->category;
             $this->render($this->autorize.'view', array('new'=>$new, 'category'=>$category, 'categoryes'=>$categoryes));
        }
    }
    
    public function actionDeleteCategory($id){
        if(!empty($id)){
           $category = NewsCategory::model()->findByPk((int)$id)->delete(); 
           $news = News::model()->deleteAll('news_category_id=:category_id AND status_id != 1', array(':category_id'=>(int)$id));
           $this->redirect('/news/index');
        }
    }
    
    public function actionEditCategory(){
        if(isset($_POST['category_id']) && isset($_POST['name'])){
            $category = NewsCategory::model()->findByPk((int)$_POST['category_id']);
            $category->name = CHtml::encode($_POST['name']);
            $category->save(false);
            echo CJSON::encode(array('status'=>'success'));
        }
    }
    
    public function actionAdd(){
        $new = new News();
        if(isset($_POST['News'])){
           $new->setAttributes($_POST['News']);
           $new->created_at = date('Y-m-d H:i:s');
           
           if($new->validate()){
               $new->save(false);
               $this->redirect('/news/view/'.$new->id);
           }
        }
        $this->render('edit/add', array('new'=>$new));
    }
    
    public function actionDelete($id){
        if(!empty($id)){
           $new = News::model()->findByPk((int)$id)->delete(); 
           $this->redirect('/news/index');
        }
    }
    
    public function actionEdit($id){
       if(isset($_POST['News'])){
          $new = News::model()->findByPk((int)$_POST['News']['id']);  
          $new->setAttributes($_POST['News']);
          $new->created_at = date('Y-m-d H:i:s');
          
         /* if($_POST['News']['first_block']){
              preg_match_all('/<img[^>]*?src="\/uploads\/(.*?)"/', $new->text, $images); 
              if(!file_exists('/uploads/xx_'.$images[1][0]) &&  count($images[1]) != 0){
                  Yii::app()->ih
                    ->load('/uploads/1c3f0d42a41ac7b50a7b2e28aafb94c8.jpg');
                  //  ->resize('245', false)
                  //  ->crop('245', '75')      
                  //  ->save('/uploads/xx_'.$images[1][0]); 
              }
          } */

          if($new->validate()){
             $new->save(false);
             $this->redirect('/news/view/'.$new->id); 
          }
       }
        if(!empty($id)){   
           $new = News::model()->findByPk((int)$id); 
           $this->render('edit/edit', array('new'=>$new));
        }
    }
    
    public function actionCategory($id){
       $criteria = new CDbCriteria();
       $criteria->order = 'id desc'; 
       $criteria->compare('news_category_id', (int)$id);
       $criteria->addCondition('(status_id != "1")');
       $news = News::model()->findAll($criteria);
       $category = NewsCategory::model()->findByPk((int)$id);
       $this->render($this->autorize.'category', array('news'=>$news, 'category'=>$category));
    }
    
    public function actionDraft(){
       $criteria = new CDbCriteria();
       $criteria->order = 'id desc'; 
       $criteria->compare('status_id', '1');
       $news = News::model()->findAll($criteria);
       $this->render('edit/draft', array('news'=>$news));
    }
    
    public function actionAddCategory(){
        if(isset($_POST['NewsCategory'])){
           $category = new NewsCategory();
           $category->setAttributes($_POST['NewsCategory']);
           $category->save();
           $this->redirect('/news/index');
        }
    }
    
    public function actionSaveImage(){
      $image = CUploadedFile::getInstanceByName('nicImage');
      $upload = Yii::getPathOfAlias('webroot').'/uploads/';
      if($image !== null){
          $file_name = md5(time().rand(1,5000)).'.'.$image->extensionName; 
          $sucsave = $image->saveAs($upload.$file_name);
          
          Yii::app()->ih
            ->load($upload. $file_name)
            ->resize('400', false)
            ->save($upload . $file_name);  
          
          $session = new CHttpSession();
          $session->open();
          $session['file_name'] = $file_name;   
      } 
    }
    
    public function actionSession(){
      $session = new CHttpSession();
      $session->open();
      if(!empty($session['file_name'])){
         echo CJSON::encode(array('status'=>'success', 'name'=>$session['file_name']));
           unset($session['file_name']);
      }else{
          echo CJSON::encode(array('status'=>'failure'));
      }
    }
    
    
    
}