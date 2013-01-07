<?php

/**
 * This is the model class for table "working_time".
 *
 * The followings are the available columns in table 'working_time':
 * @property integer $id
 * @property string $full_time
 * @property string $part_time
 */
class WorkingTime extends CActiveRecord
{
        public  $full_time_from;
        public  $full_time_to;
        public  $part_time_from;
        public  $part_time_to;
	/**
	 * Returns the static model of the specified AR class.
	 * @return WorkingTime the static model class
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
		return 'working_time';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('full_time, part_time', 'length', 'max'=>80),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, full_time, part_time', 'safe', 'on'=>'search'),
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
			'full_time' => 'Полный день',
			'part_time' => 'Сокращенный день',
		);
	}
        
        public function beforeSave() {
            if(parent::beforeSave()){
                $this->full_time = $this->full_time_from.' - '.$this->full_time_to;
                $this->part_time = $this->part_time_from.' - '.$this->part_time_to;
                return true;
            }
        }
        
        public function afterFind() {
                parent::afterFind();
                $full = explode(' - ', $this->full_time);
                $part = explode(' - ', $this->part_time);
                $this->full_time_from = $full[0];
                $this->full_time_to = $full[1];
                $this->part_time_from = $part[0];
                $this->part_time_to = $part[1];
                return true;
            
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
		$criteria->compare('full_time',$this->full_time,true);
		$criteria->compare('part_time',$this->part_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}