<?php

/**
 * This is the model class for table "day_week".
 *
 * The followings are the available columns in table 'day_week':
 * @property integer $id
 * @property integer $monday
 * @property integer $tuesday
 * @property integer $wednesday
 * @property integer $thursday
 * @property integer $friday
 * @property integer $saturday
 * @property integer $sunday
 */
class DayWeek extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return DayWeek the static model class
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
		return 'day_week';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('monday, tuesday, wednesday, thursday, friday, saturday, sunday', 'required'),
			array('monday, tuesday, wednesday, thursday, friday, saturday, sunday', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, monday, tuesday, wednesday, thursday, friday, saturday, sunday', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'monday' => 'Monday',
			'tuesday' => 'Tuesday',
			'wednesday' => 'Wednesday',
			'thursday' => 'Thursday',
			'friday' => 'Friday',
			'saturday' => 'Saturday',
			'sunday' => 'Sunday',
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
		$criteria->compare('monday',$this->monday);
		$criteria->compare('tuesday',$this->tuesday);
		$criteria->compare('wednesday',$this->wednesday);
		$criteria->compare('thursday',$this->thursday);
		$criteria->compare('friday',$this->friday);
		$criteria->compare('saturday',$this->saturday);
		$criteria->compare('sunday',$this->sunday);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}