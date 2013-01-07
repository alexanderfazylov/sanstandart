<?php

class ContactsController extends Controller
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
                'application.filters.PerformanceFilter - index, time',
            ),
        );
    }
    
    public function actionIndex(){
        Yii::app()->clientScript->registerScriptFile('http://api-maps.yandex.ru/1.1/index.xml?key='.Yii::app()->params['ymap']);
        $addresses = array();
        $cities = City::model()->findAll();
        foreach ($cities as $city){
            $criteria = new CDbCriteria();
            $criteria->order = 'id';
            $criteria->compare('city_id', $city->id);
            $addresses[$city->id][] = Address::model()->findAll($criteria);
        }
        
        $this->render($this->autorize.'index', array('cities'=>$cities, 'addresses'=>$addresses));
    }
    
    public function actionAddCity(){
        if(isset($_POST['City'])){
           $city = new City();
           $city->setAttributes($_POST['City']);
           $city->save();
           $this->redirect('/contacts/index');
        }
        $this->unsetLayoutAddress();
    }
    
    public function actionEditCity(){
        if(isset($_POST['city_id']) && isset($_POST['name'])){
            $city = City::model()->findByPk((int)$_POST['city_id']);
            $city->name = CHtml::encode($_POST['name']);
            $city->save(false);
            echo CJSON::encode(array('status'=>'success'));
        }
        
        $this->unsetLayoutAddress();
    }
    
    public function actionDeleteCity($id){
        if(!empty($id)){
           $city = City::model()->findByPk((int)$id)->delete(); 
           $addresses = Address::model()->findAll('city_id=:city_id', array(':city_id'=>(int)$id));
           
           foreach($addresses as $address){
               if(isset($address->day_time)){
                    $address->day_time->delete();
                    if(isset($address->day_time->working_time))
                            $address->day_time->working_time->delete();
                    if(isset($address->day_time->day_week))
                            $address->day_time->day_week->delete();
                }
                $address->delete();
           }
           $this->redirect('/contacts/index');
        }
        $this->unsetLayoutAddress();
    }
    
    public function actionTime(){
        if(isset($_POST['address_id'])){
            $address = Address::model()->findByPk((int)$_POST['address_id']);
            $working_time = '';
            $day_week = '';
            if(isset($address->day_time)){
                if(isset($address->day_time->working_time))
                        $working_time = $address->day_time->working_time;
                if(isset($address->day_time->day_week))
                        $day_week = $address->day_time->day_week;
            }
            
            echo CJSON::encode(array('time' => $this->renderPartial('_time', array('address'=>$address, 'working_time'=>$working_time, 'day_week'=>$day_week), true)));
        }
    }
    
    public function actionEdit($id){
        Yii::app()->clientScript->registerScriptFile('http://api-maps.yandex.ru/1.1/index.xml?key='.Yii::app()->params['ymap']);
        if(!empty($id)){
            $address = Address::model()->findByPk((int)$id);
            $working_time = '';
            $day_week = '';
            if(isset($address->day_time)){
                if(isset($address->day_time->working_time))
                        $working_time = $address->day_time->working_time;
                if(isset($address->day_time->day_week))
                        $day_week = $address->day_time->day_week;
            }
            
            if(isset($_POST['Address'])){
               $address->setAttributes($_POST['Address']);

               $day_week->setAttributes($_POST['DayWeek']);
               $working_time->full_time_from = $_POST['WorkingTime']['full_time_from'];
               $working_time->full_time_to = $_POST['WorkingTime']['full_time_to'];
               $working_time->part_time_from = $_POST['WorkingTime']['part_time_from'];
               $working_time->part_time_to = $_POST['WorkingTime']['part_time_to'];


               if($address->validate()){
                   $working_time->save(false);
                   $day_week->save(false);
                   $address->save(false);
                   $this->redirect('/contacts/index');
               }
            }
            
            $this->render('edit/edit', array('address'=>$address, 'working_time'=>$working_time, 'day_week'=>$day_week));
        }
        $this->unsetLayoutAddress();
    }
    
    public function actionDelete($id){
        if(!empty($id)){
            $address = Address::model()->findByPk((int)$id);
            if(isset($address->day_time)){
                $address->day_time->delete();
                if(isset($address->day_time->working_time))
                        $working_time = $address->day_time->working_time->delete();
                if(isset($address->day_time->day_week))
                        $day_week = $address->day_time->day_week->delete();
            }
            $address->delete();
            $this->redirect('/contacts/index');
        }
        $this->unsetLayoutAddress();
    }
    
    public function actionAdd(){
        Yii::app()->clientScript->registerScriptFile('http://api-maps.yandex.ru/1.1/index.xml?key='.Yii::app()->params['ymap']);
        $address = new Address();
        $day_week = new DayWeek();
        $working_time = new WorkingTime();
        if(isset($_POST['Address'])){
           $address->setAttributes($_POST['Address']);
           $day_week->setAttributes($_POST['DayWeek']);
           $working_time->full_time_from = $_POST['WorkingTime']['full_time_from'];
           $working_time->full_time_to = $_POST['WorkingTime']['full_time_to'];
           $working_time->part_time_from = $_POST['WorkingTime']['part_time_from'];
           $working_time->part_time_to = $_POST['WorkingTime']['part_time_to'];
           
           
           if($address->validate()){
               $working_time->save(false);
               $day_week->save(false);
               
               $day_time = new DayTime();
               $day_time->day_week_id = $day_week->id;
               $day_time->working_time_id = $working_time->id;
               $day_time->save(false);
               
               $address->day_time_id = $day_time->id;
               $address->save(false);
               $this->redirect('/contacts/index');
           }
           
           $this->unsetLayoutAddress();
        }
        $this->render('edit/add', array('address'=>$address, 'working_time'=>$working_time, 'day_week'=>$day_week));
    }
    
    public function actionSelect($id){
        echo CJSON::encode(array('src'=>DayType::model()->findByPk((int)$id)->img));
    }
    
    // Чистим адреса из сессии
    public static function unsetLayoutAddress(){
        $sessia = new CHttpSession;
        $sessia->open();
        unset($sessia['address']);
    }
}
