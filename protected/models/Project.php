<?php

/**
 * This is the model class for table "project".
 *
 * The followings are the available columns in table 'project':
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property string $preview
 * @property integer $city_project_id
 */
class Project extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Project the static model class
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
		return 'project';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, city_project_id', 'required'),
			array('city_project_id, first_page', 'numerical', 'integerOnly'=>true),
			array('title, preview, brand', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, text, preview, first_page, brand, city_project_id', 'safe', 'on'=>'search'),
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
			'title' => 'Название проекта',
			'text' => 'Текст',
			'preview' => 'Изображение',
			'city_project_id' => 'Город',
                        'first_page'=>'Отображать изображение бренда на главной странице'
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
		$criteria->compare('preview',$this->preview,true);
                $criteria->compare('brand',$this->brand,true);
		$criteria->compare('city_project_id',$this->city_project_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public static function convert($string, $upload_image = null){
             $content = '';
              //Обработка текста
              //
              // Чистим от мусора
              $subject = preg_replace('/<p[^>]*>/','',$string);   // p
              $subject = preg_replace('/<\/p>/','',$subject);      // /p
              $subject = preg_replace('/<br[^>]*>/','',$subject);  // br
              $subject = preg_replace('/<div[^>]*>/','',$subject);  // div
              $subject = preg_replace('/<\/div[^>]*>/','',$subject);  // div
              
              $part = explode('<img src="/images/cursor.png">', $subject);
              
             // $stroke = $part[0].' '.$part[1];
             // $pos = stripos($stroke, '<img');
              
              preg_match_all('/<img[^>]*?src="\/uploads\/(.*?)"/', $subject, $images);  // собрали урл картинок
              
              $part[0] = preg_replace('/<img[^>]*>/','', $part[0]); // img
              $part[1] = preg_replace('/<img[^>]*>/','', $part[1]); // img
              
             /* if($pos != false){
               //  $part[0] = mb_substr($stroke, 0, $pos, 'utf-8');
               //  $part[1] = mb_substr($stroke, $pos, strlen($stroke), 'utf-8');
              } */
              
              $i = 0;
              
              $content .= '<p>'.$part[0].'</p>';
              if(count($images[1]) != 0){
                  $content .= '<div class="gallery">';
                  $imag = str_replace('sm_','',$images[1][0]);
                  $content .= '<img src="/uploads/'.$imag.'" />';
                  foreach($images[1] as $image){
                      $img = str_replace('sm_','',$image);
                        if($i == 0)
                          $content .= '<img class="gal_s" src="/uploads/sm_'.$imag.'" />';
                        else if($img != $imag)
                          $content .= '<img src="/uploads/sm_'.$img.'" />'; 
                        
                      $i++;  
                  }
                  $content .= '<img src="/uploads/sm_'.$upload_image.'" />';
                  $content .= '</div>';
              }else{
                  $content .= '<div class="gallery">';
                  $content .= '<img src="/uploads/'.$upload_image.'" />';
                  $content .= '<img class="gal_s" src="/uploads/sm_'.$upload_image.'" />';
                  $content .= '</div>';
              }
              
              $content .=(isset($part[1]))? '<p>'.$part[1].'</p>' : '';            
            return $content;
         }  
}