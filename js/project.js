$(document).ready(function(){
    $('.sity li').click(function(){
        if($(this).attr('city') != undefined && $(this).attr('class') != 'act'){
            var element = $(this);
            var city_id = element.attr('city');
            $('.sity li ul').each(function(){
                   var ul = $(this);
                   ul.slideUp('slow').parent().removeClass('act');
            });
            element.addClass('act');
            $('ul[projects*=city_'+city_id+']').slideDown('slow');
        }
    });
    
    $('.gallery img:not(".gallery img:first-child")').click(function(){
        $('.gallery img').each(function(){
            $(this).removeClass('gal_s');
        });
        $(this).addClass('gal_s');
        var src = $(this).attr('src').split('/uploads/sm_');
        $('.gallery img:first-child').attr('src','/uploads/'+src[1]);
    });
});