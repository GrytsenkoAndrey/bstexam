'use strict';

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

/**
* фильтр для выборки клиента по части номера телефона
*/
function lookClient()
{
    var client_phone = document.getElementById('phone');
   
    $.ajax({
        type: "POST",
        async:true,
        url: "/clients/look/",
        data: {"phone": client_phone.value},
        success: function(data) {
            $('#nv').hide();
            $('#result').html(data);
            $('#result').show();
        }
    }) 
}

/**
* записываем сумму в кассу при нажатии кнопки "оплачен"
* на странице отображения заказов
*/
function updateTill(order_to, price, id)
{
  //console.log(order_to);
  //console.log(price);
  //console.log(id);

  $('#bp'+id).hide();

    $.ajax({
        type: "POST",
        async: true,
        url: "/till/update/",
        data: {"order_to": order_to, "price": price, "id": id},
        success: function(data) {
          console.log(data);
        }
    })
}

/**
* изменяем статус заказа Выполнен/Не выполнен
* на странице отображения заказов
*/
function updateOrder(id, status)
{
  //console.log(order_to);
  //console.log(status);
  //console.log(id);
  if (status == 0) {
    status = 1;
  } else {
    status = 0;
  }
  //console.log(status);
  //console.log(id);

    $.ajax({
        type: "POST",
        async: true,
        url: "/orders/updstatus/",
        data: {"id": id, "status": status},
        success: function(data) {
          console.log(data);
        }
    })
}
