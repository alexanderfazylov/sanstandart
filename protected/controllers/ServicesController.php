<?php

class ServicesController extends Controller
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
        
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
        
        public function actionIndex(){
            $criteria = new CDbCriteria();
            $criteria->compare('source', 'service');
            $criteria->order = 'id desc';
            $services = Page::model()->findAll($criteria);
            $this->render($this->autorize.'index', array('services'=>$services));
        }
        
        public function actionAdd(){
            $model = new Page();
            if(isset($_POST['Page'])){
               $model->setAttributes($_POST['Page']); 
               $model->source = 'service';
               $model->save(false);
               $this->redirect(array('view', 'id'=>$model->id));
            }
            $this->render('edit/add', array('model'=>$model, 'action'=>'Создание'));
        }
        
        public function actionDelete($id){
            if(!empty($id)){
               $new = Page::model()->findByPk((int)$id)->delete(); 
               $this->redirect('/services/index');
            }
        }
        
        public function actionView($id){
            if(!empty($id)){
                $criteria = new CDbCriteria();
                $criteria->compare('source', 'service');
                $criteria->order = 'id desc';
               $services = Page::model()->findAll($criteria);
               $service = Page::model()->findByPk((int)$id); 
               $this->render($this->autorize.'view', array('service'=>$service, 'services'=>$services));
            }
        }
        
        public function actionEdit($id){
            if(isset($_POST['Page'])){
                  $service = Page::model()->findByPk((int)$_POST['Page']['id']); 
                  $service->title = $_POST['Page']['title'];
                  $service->text = $_POST['Page']['text'];
                  $service->save(false);
                  $this->redirect(array('services/view/', 'id'=>$service->id)); 
               }
            if(!empty($id)){   
               $service = Page::model()->findByPk((int)$id); 
               $this->render('edit/edit', array('model'=>$service));
            }
        }
}