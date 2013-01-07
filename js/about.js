$(document).ready(function() {
  $('p img').click(function(){
     var src = $(this).attr('src').split('/uploads/sm_');
     $('#main_img').attr('src','/uploads/'+src[1]);
  });
});