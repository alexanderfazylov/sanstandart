<?php

/**
 * This is the model class for table "{{factory}}".
 *
 * The followings are the available columns in table '{{factory}}':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $website
 * @property integer $country_id
 * @property integer $logo_id
 * @property integer $category_id
 * @property integer $position
 * @property string $create_time
 * @property string $update_time
 * @property integer $author_id
 */
class Factory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Factory the static model class
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
		return '{{factory}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, description, website, country_id, logo_id, category_id, position, create_time, update_time, author_id', 'required'),
			array('country_id, logo_id, category_id, position, author_id', 'numerical', 'integerOnly'=>true),
			array('name, website', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, description, website, country_id, logo_id, category_id, position, create_time, update_time, author_id', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'description' => 'Description',
			'website' => 'Website',
			'country_id' => 'Country',
			'logo_id' => 'Logo',
			'category_id' => 'Category',
			'position' => 'Position',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'author_id' => 'Author',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('country_id',$this->country_id);
		$criteria->compare('logo_id',$this->logo_id);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('position',$this->position);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('author_id',$this->author_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}