<?php
$this->pageTitle=Yii::app()->name . ' - Контакты';
?>

<?php
$this->breadcrumbs=array(
  '',
);
?>

<div id="container">
  <div id="content" class="contact">

    <?php if(isset($this->breadcrumbs)):?>
      <?php $this->widget('zii.widgets.CBreadcrumbs', array(
        'homeLink'=>CHtml::link('Главная', Yii::app()->homeUrl),
        'links'=>$this->breadcrumbs,
        'separator'=>' / ',
        'tagName'=>'p',
      )); ?><!-- breadcrumbs -->
    <?php endif?>

    <h1>Контакты</h1>
    <!--<div class="map"><img src="/images/images/map.gif" /></div>-->
    
<!-- Этот блок кода нужно вставить в ту часть страницы, где вы хотите разместить карту  (начало) -->
<script src="http://api-maps.yandex.ru/1.1/?key=AIIHwE4BAAAAKfjzOwIAwAbRSAkSJLvY6wZ02Qar37mbofoAAAAAAAAAAABW8F__m-xyFtZdb9ng5r64aLS8-Q==&modules=pmap&wizard=constructor" type="text/javascript"></script>
<script type="text/javascript">
    YMaps.jQuery(window).load(function () {
        var map = new YMaps.Map(YMaps.jQuery("#YMapsID-299")[0]);
        map.setCenter(new YMaps.GeoPoint(49.15544,55.787336), 17, YMaps.MapType.MAP);
        map.addControl(new YMaps.Zoom());
        map.addControl(new YMaps.ToolBar());
        YMaps.MapType.PMAP.getName = function () { return "Народная"; };
        map.addControl(new YMaps.TypeControl([
            YMaps.MapType.MAP,
            YMaps.MapType.SATELLITE,
            YMaps.MapType.HYBRID,
            YMaps.MapType.PMAP
        ], [0, 1, 2, 3]));

        YMaps.Styles.add("constructor#pmdbmPlacemark", {
            iconStyle : {
                href : "http://api-maps.yandex.ru/i/0.3/placemarks/pmdbm.png",
                size : new YMaps.Point(28,29),
                offset: new YMaps.Point(-8,-27)
            }
        });

       map.addOverlay(createObject("Placemark", new YMaps.GeoPoint(49.155258,55.787366), "constructor#pmdbmPlacemark", "Салон Villeroy&Boch"));
        
        function createObject (type, point, style, description) {
            var allowObjects = ["Placemark", "Polyline", "Polygon"],
                index = YMaps.jQuery.inArray( type, allowObjects),
                constructor = allowObjects[(index == -1) ? 0 : index];
                description = description || "";
            
            var object = new YMaps[constructor](point, {style: style, hasBalloon : !!description});
            object.description = description;
            
            return object;
        }
    });
</script>

<div id="YMapsID-299" style="width:650px;height:330px"></div>
<!-- Этот блок кода нужно вставить в ту часть страницы, где вы хотите разместить карту (конец) -->

<br/><br/>
    <h2>Казань</h2>
    <div class="adr">
        <p>Салон Villeroy & Boch</p>
        <p><a href="#">ул. Достоевского, д. 66</a><br />
        тел.: +7 (843) 258-19-96</p>
      </div>
    <div class="adr">
        <p>Cалон Ideal Standart</p>
        <p><a href="#">ул. Чистопольская, д. 32</a><br />
        тел.: +7 (843) 523-09-57 </p>
      </div>
    <h2>Москва</h2>
    <div class="adr">
        <p>Офис</p>
        <p><a href="#">Щелковское шоссе, д. 5, оф. 728</a><br />
        тел.: +7 (495) 984-68-64</p>
      </div>
    <div class="adr">
        <p>Склад</p>
        <p>Московская область, дер. Черное,<br />
        <a href="#">ул. Чернореченская, влад. 172 </a><br />
       тел.: +7 (915) 199-70-01</p>
      </div>
    
  </div><!-- #content-->
</div><!-- #container-->

<div class="sidebar" id="sideRight">
  <div class="bl">
    <div class="schedule">
      <h6>Время работы салонов</h6>
      <ul>
        <li class="pn">Пн</li>
        <li class="pn">Вт</li>
        <li class="pn">Ср</li>
        <li class="pn">Чт</li>
        <li class="pn">Пт</li>
        <li class="sb">Сб</li>
        <li class="vs">Вс</li>
      </ul>
      <p class="pn">09:00 – 19:00</p>
      <p class="sb">10:00 – 15:00</p>
      <p class="vs">Выходной</p> 
    </div>
  </div>
<p>
  <?php echo CHtml::mailto('Обратная связь', 'contact@sanstandart.ru', array('class'=>'feedback')); ?>
</p>
</div><!-- .sidebar#sideRight -->  

