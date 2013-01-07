<?php
$this->pageTitle=Yii::app()->name . ' - О компании';
?>

<?php
$this->breadcrumbs=array(
  'Каталог продукции'=>array('page&view=catalog'),
  'Villeroy & Boch'=>array('page&view=factory'),
);
?>

<div id="container">
  <div id="content" class="view_collection">

    <?php if(isset($this->breadcrumbs)):?>
      <?php $this->widget('zii.widgets.CBreadcrumbs', array(
        'homeLink'=>CHtml::link('Главная', Yii::app()->homeUrl),
        'links'=>$this->breadcrumbs,
        'separator'=>' / ',
        'tagName'=>'p',
      )); ?><!-- breadcrumbs -->
    <?php endif?>

    <h1>Pure Stone</h1>
      <p>Коллекция мебели для ванной комнаты Pure Stone от Villeroy & Bosh прекрастно сочетает в себе природную красоту натуральных материалов (камень, дерево) с совеременным дизайном ванной комнаты. Роскошное сочетание керамики и дерева – актуальный тренд в дизайне ванных комнат.</p>
    <p>Все это придает еще больший уют вашей ванной и превращает ее в оазис релаксации а, что еще более важно является своеобразным щитом, укрывающим вас от стрессов и нагрузок сегодняшней жизни.</p>
    <div class="gallery">
      <img src="/images/images/gallery.gif" />
      <img src="/images/images/gallery_s.gif" class="gal_s" />
      <img src="/images/images/gallery_s.gif" />
      <img src="/images/images/gallery_s.gif" />
      <img src="/images/images/gallery_s.gif" />
      <img src="/images/images/gallery_s.gif" />
      <img src="/images/images/gallery_s.gif" />
      <img src="/images/images/gallery_s.gif" />
      <img src="/images/images/gallery_s.gif" />
      <img src="/images/images/gallery_s.gif" />
      <img src="/images/images/gallery_s.gif" />
    </div>
    
  </div><!-- #content-->
</div><!-- #container-->

<div class="sidebar" id="sideRight">
  <div class="bl">
    <ul class="menu_cat">
      <li>
        <h6>Аксессуары</h6>
        <ul>
          <li><a href="index.php?r=site/page&view=factory">Colombo</a></li>
          <li><a href="index.php?r=site/page&view=factory">Gessа</a></li>
        </ul>
      </li>
      <li>
        <h6>Ванны</h6>
        <ul>
          <li><a href="index.php?r=site/page&view=factory">Colombo</a></li>
          <li><a href="index.php?r=site/page&view=factory">Gessа</a></li>
          <li><a href="index.php?r=site/page&view=factory">Colombo</a></li>
          <li><a href="index.php?r=site/page&view=factory">Gessа</a></li>
        </ul>
      </li>
      <li>
        <h6>Душевые кабины</h6>
        <ul>
          <li><a href="index.php?r=site/page&view=factory">Colombo</a></li>
          <li><a href="index.php?r=site/page&view=factory">Gessа</a></li>
          <li><a href="index.php?r=site/page&view=factory">Colombo</a></li>
          <li><a href="index.php?r=site/page&view=factory">Gessа</a></li>
          <li><a href="index.php?r=site/page&view=factory">Colombo</a></li>
          <li><a href="index.php?r=site/page&view=factory">Gessа</a></li>
          <li><a href="index.php?r=site/page&view=factory">Colombo</a></li>
        </ul>
      </li>
      <li>
        <h6>Керамика и мебель для ванной</h6>
        <ul>
          <li><a href="index.php?r=site/page&view=factory">Colombo</a></li>
          <li><a href="index.php?r=site/page&view=factory">Gessа</a></li>
          <li><a href="index.php?r=site/page&view=factory">Colombo</a></li>
          <li><a href="index.php?r=site/page&view=factory">Gessа</a></li>
          <li><a href="index.php?r=site/page&view=factory">Colombo</a></li>
        </ul>
      </li>
      <li>
        <h6>Плитка</h6>
        <ul>
          <li><a href="index.php?r=site/page&view=factory">Colombo</a></li>
          <li><a href="index.php?r=site/page&view=factory">Gessа</a></li>
          <li><a href="index.php?r=site/page&view=factory">Colombo</a></li>
        </ul>
      </li>
      <li>
        <h6>Полотенцесушители</h6>
        <ul>
          <li><a href="index.php?r=site/page&view=factory">Colombo</a></li>
          <li><a href="index.php?r=site/page&view=factory">Gessа</a></li>
          <li><a href="index.php?r=site/page&view=factory">Gessа</a></li>
          <li><a href="index.php?r=site/page&view=factory">Colombo</a></li>
        </ul>
      </li>
      <li>
        <h6>Смесители</h6>
        <ul>
          <li><a href="index.php?r=site/page&view=factory">Colombo</a></li>
          <li><a href="index.php?r=site/page&view=factory">Gessа</a></li>
          <li><a href="index.php?r=site/page&view=factory">Colombo</a></li>
      
        </ul>
      </li>
      <li>
        <h6>Фаянс</h6>
        <ul>
          <li><a href="index.php?r=site/page&view=factory">Colombo</a></li>
          <li><a href="index.php?r=site/page&view=factory">Gessа</a></li>
          <li><a href="index.php?r=site/page&view=factory">Colombo</a></li>
          <li><a href="index.php?r=site/page&view=factory">Gessа</a></li>
          <li><a href="index.php?r=site/page&view=factory">Colombo</a></li>
          <li><a href="index.php?r=site/page&view=factory">Gessа</a></li>
          <li><a href="index.php?r=site/page&view=factory">Colombo</a></li>
        </ul>
      </li>
    </ul>
  </div>
  
</div><!-- .sidebar#sideRight -->