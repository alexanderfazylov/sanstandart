$('#link_addCategory').live('click', function(){
    $('#addCategory').show().find('#NewsCategory_name').focus();
    $('#link_addCategory').hide();
});

function addNew(){
    $('#textarea_text').html($('.nicEdit-main').html());
    $('#add-new-form').submit();
}

function uploadImage(element){
    alert(element.val());
}

function showEdit(id){
    $('#cat_'+id).hide();
    $('#form_cat_'+id).show().find('input[type=text]').select();
}

function saveCategory(id){
    var name = $('#form_cat_'+id).find('input[type=text]').val();
    $.ajax({
      type: "POST",
      url: "/news/editCategory",
      dataType: "json",
      data: {category_id: id, name: name},
      success: function(data){
          if(data.status == 'success'){
              window.location.reload();
          }
      }
    });
}

function saveCity(id){
    var name = $('#form_cat_'+id).find('input[type=text]').val();
    $.ajax({
      type: "POST",
      url: "/contacts/editCity",
      dataType: "json",
      data: {city_id: id, name: name},
      success: function(data){
          if(data.status == 'success'){
              window.location.reload();
          }
      }
    });
}

function saveCityProj(id){
    var name = $('#form_cat_'+id).find('input[type=text]').val();
    $.ajax({
      type: "POST",
      url: "/project/editCity",
      dataType: "json",
      data: {city_id: id, name: name},
      success: function(data){
          if(data.status == 'success'){
              window.location.reload();
          }
      }
    });
}

function showTime(id){
  $.ajax({
      type: "POST",
      url: "/contacts/time",
      dataType: "JSON",
      data: {address_id: id},
      success: function(data){
          $('.schedule').html(data.time);
      }
    });
}

$(document).ready(function(){
  $('.update_select select').change(function(){
      var select = $(this);
      var id = select.find('option:selected').val();
      $.ajax({
          type: "POST",
          url: "/contacts/select/"+id,
          dataType: "json",
          success: function(data){
              select.parent().find('img').attr('src','/images/'+data.src);
          }
        });
  });
  
  
  $('.update_select select').each(function(){
      var select = $(this);
      var id = select.find('option:selected').val();
      $.ajax({
          type: "POST",
          url: "/contacts/select/"+id,
          dataType: "json",
          success: function(data){
              select.parent().find('img').attr('src','/images/'+data.src);
          }
        });
  });
  
  $('#News_first_page, #Collection_first_page').change(function(){
      if($(this).attr('checked') === undefined)
          $('#textarea_first').hide();
      else
         $('#textarea_first').show(); 
  });
  
  
});




