<?php

/**
 * This is the model class for table "brand".
 *
 * The followings are the available columns in table 'brand':
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property string $logo
 * @property string $site
 * @property string $country
 * @property string $text
 */
class Brand extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Brand the static model class
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
		return 'brand';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('name, text','required'),
			array('name, image, logo, site, country', 'length', 'max'=>255),
                        array('text', 'length', 'max'=>1000),
			array('first_page', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, image, logo, site, country, text', 'safe', 'on'=>'search'),
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
                    'section'=>array(self::MANY_MANY, 'Section', 'rel_section(brand_id, section_id)'),
                    'collection'=>array(self::HAS_MANY, 'Collection', 'brand_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Название',
			'image' => 'Image',
			'logo' => 'Logo',
			'site' => 'Адрес сайта',
			'country' => 'Страна',
			'text' => 'Текст',
                        'first_page' => 'Отображать бренд на главной странице'
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
		$criteria->compare('image',$this->image,true);
		$criteria->compare('logo',$this->logo,true);
		$criteria->compare('site',$this->site,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('text',$this->text,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}