<?php

/**
 * This is the model class for table "{{contact}}".
 *
 * The followings are the available columns in table '{{contact}}':
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property integer $city_id
 * @property string $address
 * @property string $phone
 * @property integer $position
 * @property string $weekdays_working_time
 * @property integer $saturday_working_time
 * @property integer $sunday_working_time
 */
class Contact extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Contact the static model class
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
		return '{{contact}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, city_id, address, phone, weekdays_working_time, saturday_working_time, sunday_working_time', 'required'),
			array('type, city_id, position', 'numerical', 'integerOnly'=>true),
			array('name, address', 'length', 'max'=>128),
			array('type', 'in', 'range'=>array(1,2,3)),
			array('phone, weekdays_working_time, saturday_working_time, sunday_working_time', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
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
      'city' => array(self::BELONGS_TO, 'City', 'city_id'),
    );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Идентификатор',
			'name' => 'Наименование',
			'type' => 'Тип',
			'city_id' => 'Город',
			'address' => 'Адрес',
			'phone' => 'Телефон',
			'position' => 'Порядковый номер',
			'weekdays_working_time' => 'Режим работы в будни',
			'saturday_working_time' => 'Режим работы в субботу',
			'sunday_working_time' => 'Режим работы в воскресенье',
		);
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
		$criteria->compare('type',$this->type);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('position',$this->position);
		$criteria->compare('weekdays_working_time',$this->weekdays_working_time,true);
		$criteria->compare('saturday_working_time',$this->saturday_working_time);
		$criteria->compare('sunday_working_time',$this->sunday_working_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}