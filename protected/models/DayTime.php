<?php

/**
 * This is the model class for table "day_time".
 *
 * The followings are the available columns in table 'day_time':
 * @property integer $id
 * @property integer $day_week_id
 * @property integer $working_time_id
 */
class DayTime extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return DayTime the static model class
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
		return 'day_time';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, day_week_id, working_time_id', 'required'),
			array('id, day_week_id, working_time_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, day_week_id, working_time_id', 'safe', 'on'=>'search'),
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
                     'day_week'=>array(self::BELONGS_TO, 'DayWeek', 'day_week_id'),
                     'working_time'=>array(self::BELONGS_TO, 'WorkingTime', 'working_time_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'day_week_id' => 'Day Week',
			'working_time_id' => 'Working Time',
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
		$criteria->compare('day_week_id',$this->day_week_id);
		$criteria->compare('working_time_id',$this->working_time_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}