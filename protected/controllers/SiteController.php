<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
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
                    'application.filters.PerformanceFilter - about, index, captcha, view, contact, login, logout, error, services, viewService',
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

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{   
            $first_collection = Collection::model()->findAllByAttributes(array('first_page'=>'1'));
            $galery_files = News::model()->findAllByAttributes(array('first_block'=>'1'));
            $brand_files = Brand::model()->findAllByAttributes(array('first_page'=>'1'));
            $project_files = Project::model()->findAllByAttributes(array('first_page'=>'1'));
            $news = News::model()->findAllByAttributes(array('first_page'=>'1'));
            $about_company = Page::model()->findByAttributes(array('source'=>'first_company'));
            $about_project = Page::model()->findByAttributes(array('source'=>'first_project'));
            $this->render($this->autorize.'index', array('about_company' => $about_company, 
                'about_project'=>$about_project, 
                'news'=>$news, 
                'project_files'=>$project_files, 
                'brand_files'=>$brand_files, 
                'galery_files'=>$galery_files,
                'first_collection'=>$first_collection,
                ));
	}
        
        public function actionCompanyText(){
            if(isset($_POST['preliminary'])){
                $about_company = Page::model()->findByAttributes(array('source'=>'first_company'));
                if(!$about_company)
                    $about_company = new Page();
                $about_company->source = 'first_company';
                $about_company->text = $_POST['preliminary'];
                $about_company->save(false);
                $this->redirect('/site');
            }
            
        }
        
        public function actionAddNew(){
            if(isset($_POST['new_text'])){
                $new = new Page();
                $new->source = 'first_new';
                $new->text = $_POST['new_text'];
                $new->save(false);
                $this->redirect('/site');
            }
        }
        
        public function actionDeleteNew($id){
            if(!empty($id)){
                Page::model()->findByPk((int)$id)->delete();
                $this->redirect('/site');
            }
        }
        
        public function actionEditNew($id){
            if(!empty($id)){
                $new = Page::model()->findByPk((int)$id);
                $new->text = $_POST['edit_text'];
                $new->save(false);
                $this->redirect('/site');
            }
        }
        
        public function actionProjectText(){
            if(isset($_POST['preliminary'])){
                $about_company = Page::model()->findByAttributes(array('source'=>'first_project'));
                if(!$about_company)
                    $about_company = new Page();
                $about_company->source = 'first_project';
                $about_company->text = $_POST['preliminary'];
                $about_company->save(false);
                $this->redirect('/site');
            }
            
        }

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Благодарим Вас за обращение к нам. Мы ответим вам как можно скорее.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;
                
		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){
                            echo CJSON::encode (array('status'=>'success'));
                            Yii::app()->end();
                        }else{
                            echo CJSON::encode (array('status'=>'failure'));
                            Yii::app()->end();
                        }
				
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}
        
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
                echo CJSON::encode(array('status'=>'success'));
	}
        
        public function actionAbout(){
            $categoryes = NewsCategory::model()->findAll();
            $model = Page::model()->findByAttributes(array('source'=>'about'));
            $this->render('/about/index', array('categoryes'=>$categoryes, 'model'=>$model));
        }
        
        public function actionEdit(){
            $model = Page::model()->findByAttributes(array('source'=>'about'));
            if(isset($_POST['Page'])){
               if(!$model) $model = new Page(); 
               $model->text = $_POST['Page']['text'];
               $model->source = 'about';
               $model->save(false);
               $this->redirect('/site/about');
            }
            $this->render('/about/edit/index', array('model'=>$model));
        }
        
        public function actionSaveImage(){
          $image = CUploadedFile::getInstanceByName('nicImage');
          $upload = Yii::getPathOfAlias('webroot').'/uploads/';
          if($image !== null){
              $file_name = md5(time().rand(1,5000)).'.'.$image->extensionName; 
              $sucsave = $image->saveAs($upload.$file_name);

              $pic = Yii::app()->ih->load($upload. $file_name);
              $pic->resize('230', false);
              $pic->save($upload . $file_name);
              
              if($pic->getWidth() > $pic->getHeight())
                 $pic->resize(false, '60');
              else      
                 $pic->resize('60', false); 
                   
              $pic->crop('60', '60');
              $pic->save($upload . 'sm_'.$file_name);
               
              $session = new CHttpSession();
              $session->open();
              $session['file_name'] = $file_name;   
          } 
        }
        
        public function actionHomeService(){
            if(isset($_POST['Service'])){
                $home_service = Page::model()->findByAttributes(array('source'=>'home_services', 'source_id'=>$_POST['Service']['id']));
                if(!$home_service)
                    $home_service = new Page;
                
                $home_service->source = 'home_services';
                $home_service->source_id = (int)$_POST['Service']['id'];
                $home_service->title = $_POST['Service']['title'];
                $home_service->text = $_POST['Service']['text'];
                $home_service->save(false);
                $this->redirect('/site');
            }
        }
        
        public function actionConvert(){
          $session = new CHttpSession();
          $session->open();
          if(!empty($session['file_name'])){
             $content = Page::convert($_POST['text'], $session['file_name']);
             echo CJSON::encode(array('status'=>'success', 'text'=>$content));
             unset($session['file_name']);
          }else{
              echo CJSON::encode(array('status'=>'failure'));
          }
        }
        
        public function actionUploadProject(){
              $image = CUploadedFile::getInstanceByName('img_project');
              $upload = Yii::getPathOfAlias('webroot').'/uploads/';
              if($image !== null){
                  $file_name = md5(time().rand(1,5000)).'.'.$image->extensionName; 
                  $sucsave = $image->saveAs($upload.$file_name);

                  $pic = Yii::app()->ih->load($upload. $file_name);
                  $pic->resize(false, '57');
                  $pic->save($upload . $file_name);
                  
                  $file = new File();
                  $file->name = $file_name;
                  $file->source = 'first_project';
                  $file->save(false);
                  
                  echo '<script>window.parent.onProject("'.$file->id.'","'.$file_name.'");</script>'; 
              }  
        }
        
         public function actionUploadBrand(){
              $image = CUploadedFile::getInstanceByName('img_project');
              $upload = Yii::getPathOfAlias('webroot').'/uploads/';
              if($image !== null){
                  $file_name = md5(time().rand(1,5000)).'.'.$image->extensionName; 
                  $sucsave = $image->saveAs($upload.$file_name);

                  $pic = Yii::app()->ih->load($upload. $file_name);
                  $pic->resize(false, '57');
                  $pic->save($upload . $file_name);
                  
                  $file = new File();
                  $file->name = $file_name;
                  $file->source = 'first_brand';
                  $file->save(false);
                  
                  echo '<script>window.parent.onBrand("'.$file->id.'","'.$file_name.'");</script>'; 
              }  
        }
        
        public function actionUploadGalery(){
              $image = CUploadedFile::getInstanceByName('img_project');
              $upload = Yii::getPathOfAlias('webroot').'/uploads/';
              if($image !== null){
                  $file_name = md5(time().rand(1,5000)).'.'.$image->extensionName; 
                  $sucsave = $image->saveAs($upload.$file_name);

                  $pic = Yii::app()->ih->load($upload. $file_name);
                  $pic->resize(false, '75');
                  $pic->save($upload . $file_name);
                  
                  $file = new File();
                  $file->name = $file_name;
                  $file->source = 'first_galery';
                  $file->save(false);
                  
                  echo '<script>window.parent.onGalery("'.$file->id.'","'.$file_name.'");</script>'; 
              }  
        }
        
        public function actionDeleteImg(){
            if(isset($_POST['id_file'])){
                $model = File::model()->findByPk((int)$_POST['id_file']);
                $namefile = $model->name;
                $upload = Yii::getPathOfAlias('webroot').'/uploads/'.$namefile;
                //удаление файла
                if($namefile!='')
                   @unlink($upload);
                
                $model->delete();
            }
        }
}