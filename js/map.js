var map, geoResult;

$(document).ready(function(){
        var map1 = new YMaps.Map(document.getElementById("YMapsID"));
        map = map1;
        map.setCenter(new YMaps.GeoPoint(49.141638,55.786878), 13);
        map.addControl(new YMaps.Zoom());
        map.addControl(new YMaps.TypeControl());
        
        city = $('#Address_city_id option:selected').text();
        
        if(city != '')
            showAddress(city, true); 
        
        $('#Address_city_id').change(function(){
            city = $(this).find('option:selected').text();
            showAddress(city, true); 
        });
        
        $('#Address_address').change(function(){
            city = $('#Address_city_id').find('option:selected').text();
            addres = $(this).val();
            showAddress(city+', '+addres); 
            $('#Address_code').val('0');
        });
});

function showAddress(value, city, code) {
    if(city === undefined){
        city = false;
    } 
    
    if(code != undefined){
        var cod = code.split(',');
    } 
      
    // Удаление предыдущего результата поиска
    map.removeOverlay(geoResult);
    
    // Запуск процесса геокодирования
    if(code === undefined)
        var geocoder = new YMaps.Geocoder(value, {results: 1, boundedBy: map.getBounds()});

    if(code === undefined){
        
        // Создание обработчика для успешного завершения геокодирования
        YMaps.Events.observe(geocoder, geocoder.Events.Load, function () {
            // Если объект был найден, то добавляем его на карту
            // и центрируем карту по области обзора найденного объекта
            if (this.length()) {
                geoResult = this.get(0);
                if(!city)
                    map.addOverlay(geoResult);

                map.setBounds(geoResult.getBounds());

            }else {
               // alert("Ничего не найдено")
            }
        });

        // Процесс геокодирования завершен неудачно
        YMaps.Events.observe(geocoder, geocoder.Events.Fault, function (geocoder, error) {
            alert("Произошла ошибка: " + error);
        })
        
    }else{
        
            geoResult = new YMaps.Placemark(new YMaps.GeoPoint(cod[0],cod[1]));
            map.setCenter(new YMaps.GeoPoint(cod[0],cod[1]), 15);
            //Добавление нового
            map.addOverlay(geoResult);
        
    }
    
}

