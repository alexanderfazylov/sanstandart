$(document).ready(function(){
    // При щелчке на карте показывается балун со значениями координат указателя мыши и масштаба
    YMaps.Events.observe(map, map.Events.Click, function (map, mEvent) {
        var geocode = mEvent.getGeoPoint();
        geocode = geocode+'';
        var code = geocode.split(',');

        // Удаление предыдущего результата поиска
        map.removeOverlay(geoResult);

        geoResult = new YMaps.Placemark(new YMaps.GeoPoint(code[0],code[1]));
        //Добавление нового
        map.addOverlay(geoResult);
        
        $('#Address_code').val(code[0]+','+code[1]);
    });
});