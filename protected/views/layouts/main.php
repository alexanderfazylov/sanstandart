<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/edit.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.js" type="text/javascript"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/main.js" type="text/javascript"></script>
	<!--[if lte IE 6]><link rel="stylesheet" href="style_ie.css" type="text/css" media="screen, projection" /><![endif]-->
	<link href='http://fonts.googleapis.com/css?family=PT+Serif:400,400italic,700,700italic|PT+Sans:400,400italic,700,700italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
</head>
<body>

<div id="wrapper">

	<div id="header">
		<div class="hlp">
		<img src="/images/logo.gif" class="logo" />
		<ul class="menu">
			<li>01<a href="/catalog">Каталог продукции</a></li>
			<li>02<a href="/project">Проекты</a></li>
			<li>03<a href="/site/about">О компании</a></li>
			<li>04<a href="/services">Услуги</a></li>
			<li>05<a href="/news">Пресс-центр</a></li>
			<li>06<a href="/contacts">Контакты</a></li>
		</ul>
		<div class="contacts">
                        <?php $contacts_city = City::model()->findAll();
                               $i=0;
                               foreach($contacts_city as $city){
                                   echo '<h6>'.$city->name.'</h6>';
                                   $address = Address::model()->findAllByAttributes(array('city_id'=>$city->id));
                                   foreach($address as $addr){
                                      
                                       if($i>1)
                                            echo '<p>'.$addr->address.'<br/>'.$addr->phone.'</p>';    
                                       else
                                           echo '<p>'.$addr->name.'<br/>'.$addr->address.'<br/>'.$addr->phone.'</p>';
                                       
                                       if($i>1)
                                           break;
                                           
                                      $i++;
                                   }
                               }?>
		</div>
                <div class="social">
                    <a href="http://vk.com/sanstandart" title="Вконтакте" class="vk"></a>
                    <a href="http://facebook.com/sanstandart" title="Facebook" class="fb"></a>
                    <a href="http://twitter.com/sanstandart" title="twitter" class="twitter"></a>
                </div>
		</div>
	</div><!-- #header-->

	<div id="middle">

		<div id="container">
			<div id="content" class="home">
			<?php echo $content; ?>
			</div><!-- #content-->
		</div><!-- #container-->


	</div><!-- #middle-->

</div><!-- #wrapper -->

<div id="footer">
	<div class="hlp">
	<img src="/images/logo_f.gif" class="logo" />
	<p class="copy">&copy; 2011 Салон-магазин «СанСтандарт»</p>
	<ul class="menu">
			<li><a href="/catalog">Каталог продукции</a></li>
			<li><a href="/project">Проекты</a></li>
			<li><a href="/site/about">О компании</a></li>
			<li><a href="/services">Услуги</a></li>
			<li><a href="/news">Пресс-центр</a></li>
			<li><a href="/contacts">Контакты</a></li>
                        
                        <?php if(Yii::app()->user->isGuest): ?>                        
                        <li class="pr">
                            <?php $this->renderPartial('/site/login', array('model'=>new LoginForm())); ?>
                            <a href="javascript://" onclick="showForm()">Войти</a>
                        </li>
                        <?php else: ?>
                        <li><a href="javascript://" onclick="logout()">Выйти</a></li>
                        <?php endif;?>
                        
		</ul>
		<div class="contacts">
                    <?php $contacts_city = City::model()->findAll();
                        $i=0;
                        foreach($contacts_city as $city){
                            echo '<div>';
                            echo '<h6>'.$city->name.'</h6>';
                            $address = Address::model()->findAllByAttributes(array('city_id'=>$city->id));
                            foreach($address as $addr){

                                if($i>1)
                                    echo '<p>'.$addr->address.'<br/>'.$addr->phone.'</p>';    
                                else
                                    echo '<p>'.$addr->name.'<br/>'.$addr->address.'<br/>'.$addr->phone.'</p>';

                                if($i>1)
                                    break;

                                $i++;
                            }
                            echo '</div>';
                        }?>
		</div>
	</div>
</div><!-- #footer -->

</body>
</html>