/**
* сравниваем пароль при добавлении нового пользователя
*/
function comparePass()
{
  var p1 = document.getElementById('password');
  var p2 = document.getElementById('confirm');

  if ( (p1.value.length > 0) && (p2.value.length > 0) ) {
    if (p1.value != p2.value) {
      $('#info').show();
    } else {
      $('#info').hide();
    };
  }; 

}

/**
* проверяем существует ли клиент и заполняем данными если да
* на странице создания нового заказа
*/
function checkClient()
{
    var client_phone = document.getElementById('phone');
    var client_name = document.getElementById('client_name');
    var client_sname = document.getElementById('client_sname');
   
    $.ajax({
        type: "POST",
        async:true,
        url: "/clients/check/",
        data: {"phone": client_phone.value},
        dataType: 'json',
        success: function(data) {
          if (data['id'] >= 1) {
              client_name.value = data['name'];
              client_sname.value = data['second_name'];
          } else {
            client_name.value = "";
            client_sname.value = "";
          }
        }
    }) 
}
