<?php

/**
 * This is the model class for table "address".
 *
 * The followings are the available columns in table 'address':
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property integer $city_id
 * @property integer $day_time_id
 */
class Address extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Address the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'address';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('city_id, name, address', 'required'),
			array('city_id, day_time_id', 'numerical', 'integerOnly'=>true),
			array('name, address, phone, code, type', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, address, phone, city_id, day_time_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'day_time'=>array(self::BELONGS_TO, 'DayTime', 'day_time_id'),
                    'city'=>array(self::BELONGS_TO, 'City', 'city_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Название объекта',
			'address' => 'Адрес',
			'phone' => 'Телефон',
			'city_id' => 'Город',
                        'type' => 'Тип точки',
			'day_time_id' => 'Work',
		);
	}
        
        public static function layoutAddress(){
            $sessia = new CHttpSession;  
            $sessia->open();
            if(isset($sessia['address'])){
                return $sessia['address'];
            }else{ 
                $arr_address = array();
                $criteria = new CDbCriteria();
                $criteria->order = 'id';
                $criteria->limit = '3';
                $addresses = Address::model()->findAll($criteria);
                foreach($addresses as $address)
                    $arr_address[$address->city->name][] = $address;
                
                return $arr_address;
            }
        }

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('work_id',$this->work_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}