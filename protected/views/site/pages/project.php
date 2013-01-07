<?php
$this->pageTitle=Yii::app()->name . ' - Проекты';
?>

<?php
$this->breadcrumbs=array(
  'Проекты'=>array('page&view=projects'),
);
?>

<div id="container">
    <div id="content" class="project">
    
    <?php if(isset($this->breadcrumbs)):?>
      <?php $this->widget('zii.widgets.CBreadcrumbs', array(
        'homeLink'=>CHtml::link('Главная', Yii::app()->homeUrl),
        'links'=>$this->breadcrumbs,
        'separator'=>' / ',
        'tagName'=>'p',
      )); ?><!-- breadcrumbs -->
    <?php endif?>
    
    <h1>Гостиница «Marriot Grand Hotel»</h1>
      <p>Гостиница Марриотт Гранд, Москва была построена в 1996 году, на главной улице города, менее чем
в 1 километре от Кремля. Принадлежит она крупной строительной компании Моспромстрой, и входит
в международную сеть отелей высочайшего класса Marriott Hotels Collection. </p>
    <div class="gallery">
      <img src="/images/images/gallery.gif" />
      <img src="/images/images/gallery_s.gif" class="gal_s" />
      <img src="/images/images/gallery_s.gif" />
      <img src="/images/images/gallery_s.gif" />
      <img src="/images/images/gallery_s.gif" />
      <img src="/images/images/gallery_s.gif" />
    </div>
    <p>Расположение гостиницы, уютные номера, обслуживание, соответствующее количеству звезд отеля,
а также всемирно известная марка «Марриотт» привлекают высшее руководство крупных российских
и западных компаний и всех, кто ценит комфорт и роскошь.</p>
    <p>Периодически Марриот Гранд выбирают известные деятели спорта, науки и искусства для проведения
здесь конференций или презентаций. В 2004 году Константин Цзю, абсолютный чемпион мира по боксу
в первом полусреднем весе, представил здесь спортивный напиток, названный его именем, здесь же
проходила презентация книги Егора Гайдара «Долгое время». Ежегодно в Мариот Гранд проходят
различные тематические конференции.</p>
    
  </div><!-- #content-->
</div><!-- #container-->

<div class="sidebar" id="sideRight">
  <div class="bl">
    <ul class="sity">
      <li><a href="#">Казань</a></li>
      <li class="act"><a href="#">Москва
        </a>
        <ul>
        <li><a href="#">Гостиница «Marriot Grand Hotel»</a></li>
        <li><a href="#">Гостиница «Аврора»</a></li>
        <li><a href="#">Гостиница «Тверская»</a></li>
        <li><a href="#">Гостиница «HILTON»</a></li>
        <li><a href="#">Гостиница «Покровка»</a></li>
        <li><a href="#">Гостиница «Ленинградская Hilton»</a></li>
        <li><a href="#">Гостиница «Холлидей»</a></li>
        </ul>
      </li>
      <li><a href="#">Самара</a></li>
      <li><a href="#">Сочи</a></li>
      <li><a href="#">Екатеринбург</a></li>
      <li><a href="#">Краснодар</a></li>
      <li><a href="#">Тула</a></li>
      <li><a href="#">Ясная поляна</a></li>
      <li><a href="#">Кисловодск</a></li>
      <li><a href="#">Воронеж</a></li>
    </ul>
  </div>
  
</div><!-- .sidebar#sideRight -->