<?php

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property string $created_at
 * @property integer $news_category_id
 * @property integer $status_id
 */
class News extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return News the static model class
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
		return 'news';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, news_category_id, status_id', 'required'),
			array('news_category_id, status_id, first_page, first_block', 'numerical', 'integerOnly'=>true),
			array('title, source, first_text', 'length', 'max'=>255),
			array('text, created_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, text, created_at, news_category_id, status_id', 'safe', 'on'=>'search'),
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
                    'category'=>array(self::BELONGS_TO, 'NewsCategory', 'news_category_id'),
                    'status'=>array(self::BELONGS_TO, 'Status', 'status_id '),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Заголовок',
			'text' => 'Текст новости',
			'created_at' => 'Created At',
			'news_category_id' => 'Раздел',
			'status_id' => 'Статус',
                        'source'=>'Источник',
                        'first_page'=>'Отображать новость на главной странице',
                        'first_text'=>'Текст для главной страницы',
                        'first_block' => 'Выводить превью новости в блоке'
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('news_category_id',$this->news_category_id);
		$criteria->compare('status_id',$this->status_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public static function draftCount(){
            $criteria = new CDbCriteria();
            $criteria->compare('status_id ', '1');
            $count = News::model()->count($criteria);
            return $count;
        }
        
        public static function crop($string){
            $max = 400;
            $i = true;
            $step = 1;
            $string = strip_tags($string);
            $string1 = $string;
            
            while($i){
               $string = strrev(strstr(strrev(substr($string,0,$max)),'.'));
               if(empty($string))
                  $max +=100; 
               else
                 $i = false;
               
               if($step > 10){
                  if(strlen($string) > 400) 
                    $string = mb_subsrt($string, 0, 400, 'utf-8');
                  else
                    $string = $string1; 
                  $i = false; 
               }
               
               $step++;
            }
            return $string;
        }
}