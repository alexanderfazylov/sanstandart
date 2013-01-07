function logout(){
    $.ajax({
      type: "POST",
      url: "/site/logout",
      dataType: "json",
      success: function(data){
          if(data.status == 'success'){
              window.location.reload();
          }
      }
    });
}

function login(){
    $('#err_log').remove();
    $.ajax({
      type: "POST",
      url: "/site/login",
      dataType: "json",
      data: $('#login-form').serialize(),
      success: function(data){
          if(data.status == 'success'){
              window.location.reload();
          }else{
              $('#login-form').prepend('<span style="color:red" id="err_log">Не правильный логин или пароль</span>');
          }
      }
    });
}

function showForm(){
  $('#login_form').show();
}