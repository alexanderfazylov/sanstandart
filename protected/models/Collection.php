<?php

/**
 * This is the model class for table "collection".
 *
 * The followings are the available columns in table 'collection':
 * @property integer $id
 * @property string $preview
 * @property string $name
 * @property string $text
 * @property integer $brand_id
 */
class Collection extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Collection the static model class
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
		return 'collection';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('brand_id, name', 'required'),
			array('brand_id, first_page', 'numerical', 'integerOnly'=>true),
			array('preview, name', 'length', 'max'=>255),
			array('text, first_text', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, preview, name, text, brand_id', 'safe', 'on'=>'search'),
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
                    'brand'=>array(self::BELONGS_TO, 'Brand', 'brand_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'preview' => 'Preview',
			'name' => 'Название коллекции',
			'text' => 'Контент',
			'brand_id' => 'Бренд',
                        'first_page'=>'Отображать коллекцию на главной странице',
                        'first_text'=>'Текст для главной страницы',
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
		$criteria->compare('preview',$this->preview,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('brand_id',$this->brand_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}