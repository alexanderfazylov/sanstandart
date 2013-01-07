var metr = 0;
var curent = 0;
var interval;
var slider = new Array();

function deleteImg(id){
    $.ajax({
      type: "POST",
      url: "/site/deleteImg",
      dataType: "json",
      data: {id_file: id},
      success: function(data){
          $('#_image'+id).hide('slow');
      }
    });
}

function loadInfo(id){
  $.ajax({
      type: "POST",
      url: "/catalog/infoBrand",
      dataType: "json",
      data: {id: id},
      success: function(data){
          $('.information').html(data.div);
      }
    });
}

$(document).ready(function(){
    $('.preview img').click(function(){
        var atr = $(this).attr('onclick');
        var src = $(this).addClass('coll_active').attr('src').split('/uploads/sm_');
        $('.im img:first-child').attr('src','/uploads/'+src[1]);
        
        for(var i=0; i<slider.length; i++) {
            if(slider[i] == atr)
                curent = i;
	}
    
    });
    
    $('.preview img').hover(function(){
        $('.preview img').each(function(index){
            $(this).removeClass('coll_active');
        });
        $(this).addClass('coll_active');
        
    },function(){
        $('.preview img').each(function(index){
            $(this).removeClass('coll_active');
        });
    });
    
    
    $('.arrow img').click(function(){
        var str = 1000;
        var summ_width = parseInt($('.summ_width').width());
        var direction = $(this).attr('direction');
        if(direction == 'right' && summ_width > str){
            if(metr == 0) metr = summ_width - str;
            if(metr > 0){
                $('.cont_galery').animate({'marginLeft':'-'+metr+'px'}, 1000);
            }
        }else if(direction == 'left' && metr > 0){
            metr = 0;
            $('.cont_galery').animate({'marginLeft':'0px'}, 1000);
        }
    });
    
    sliderPreview();
    interval = setInterval(sliderPreview, 4000);
    
    $('.collection').hover(function(){
        clearInterval(interval);
    },function(){
        interval = setInterval(sliderPreview, 4000);
    }); 
    
});

function sliderPreview(){
    $('.preview img').each(function(index){
        slider[index] = $(this).removeClass('coll_active').attr('onclick');
    });
   
    if(slider.hasOwnProperty(curent)){
        setTimeout(slider[curent], 50);
        $('.preview img[onclick="'+slider[curent]+'"]').addClass('coll_active').click();
        curent = curent+1;
    }else{
        curent = 0;
        if(slider.hasOwnProperty(curent)){
        setTimeout(slider[curent], 50);
        $('.preview img[onclick="'+slider[curent]+'"]').addClass('coll_active').click();
        curent = curent+1;}
    }
        
}