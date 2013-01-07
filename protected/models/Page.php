<?php

/**
 * This is the model class for table "page".
 *
 * The followings are the available columns in table 'page':
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property string $source
 * @property integer $source_id
 */
class Page extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Page the static model class
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
		return 'page';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('source_id', 'required'),
                        array('title', 'required'),
			array('source_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('source', 'length', 'max'=>5),
			array('text', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, text, source, source_id', 'safe', 'on'=>'search'),
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
			'title' => 'Заголовок',
			'text' => 'Контент',
			'source' => 'Source',
			'source_id' => 'Source',
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
		$criteria->compare('source',$this->source,true);
		$criteria->compare('source_id',$this->source_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
         public static function crop($string, $max){
                $sections = array();
                if(strlen($string) > $max){
                    $i=0;
                    $string1 = '';
                    $string2 = '';
                    $coun = '';
                    
                    $text = explode('. ', $string);
                    foreach($text as $proposal){
                        if($i == 0)
                            $string1 .= $proposal.'. ';
                        else{
                            $coun = $string1.' '.$proposal.'. ';
                           if(strlen($coun) > $max){
                              $string2 .= $proposal.'. '; 
                           }else 
                              $string1 .= $proposal.' ';
                        }
                        $i++;
                    }
                    $sections[0] = $string1;
                    $sections[1] = $string2;

                }else
                    $sections[0] = $string;

               return $sections;     
           }
           
         public static function convert($string, $upload_image = null){
             $content = '';
              //Обработка текста
              preg_match_all('/<img[^>]*?src="\/uploads\/(.*?)"/', $string, $images);  // собрали урл картинок
              
              // Чистим от мусора
              $subject = preg_replace('/<img[^>]*>/','',$string); // img
              $subject = preg_replace('/<p[^>]*>/','',$subject);   // p
              $subject = preg_replace('/<\/p>/','',$subject);      // /p
              $subject = preg_replace('/<br[^>]*>/','',$subject);  // br
              $subject = preg_replace('/<div[^>]*>/','',$subject);  // div
              $subject = preg_replace('/<\/div[^>]*>/','',$subject);  // div
              
              //Текст
              $text = Page::crop($subject, 700);
              
              if(count($images[1]) == 0 && $upload_image != null){
                  $content = '<img src="/uploads/'.$upload_image.'" id="main_img" class="fon fl" align="left" />';
                  $content .= '<div class="fr comp"><br/><p>'.$text[0].'</p>';
                  $content .= '<p><img src="/uploads/sm_'.$upload_image.'" /></p>';
                  $content .= '</div><div style="clear:both;"></div>';
                  $content .= isset($text[1]) ? '<p style="padding-left:20px;">'.$text[1].'</p>' : '';
              }else if(count($images[1]) == 0){
                  $content .= '<p>'.$text[0].'</p>';
                  $content .= isset($text[1]) ? '<p>'.$text[1].'</p>' : '';
              }else{
                  $i = 0;
                  $imag = str_replace('sm_','',$images[1][0]);
                  $content = '<img src="/uploads/'.$imag.'" class="fon fl" id="main_img" align="left" />';
                  $content .= '<div class="fr comp"><br/><p>'.$text[0].'</p>';
                  $content .= '<p>';
                  $images[1] = array_unique($images[1]);
                  foreach($images[1] as $image){
                      $img = str_replace('sm_','',$image);
                        if($i == 0)
                          $content .= '<img src="/uploads/sm_'.$imag.'" />'; 
                        else if($img != $imag)
                          $content .= '<img src="/uploads/sm_'.$img.'" />'; 
                        
                     $i++;
                  }
                  if($upload_image != null) $content .= '<img src="/uploads/sm_'.$upload_image.'" />'; 
                  $content .= '</p>';
                  $content .= '</div><div style="clear:both;"></div>';
                  $content .= isset($text[1]) ? '<p style="padding-left:20px;">'.$text[1].'</p>' : '';
              }
              
            return $content;
         }  
      
}