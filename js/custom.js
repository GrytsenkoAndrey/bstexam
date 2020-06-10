'use strict';

/* список заказов */
const pageOrderList = document.querySelector('.page-order__list');
if (pageOrderList) {

  pageOrderList.addEventListener('click', evt => {


    if (evt.target.classList && evt.target.classList.contains('order-item__toggle')) {
      var path = evt.path || (evt.composedPath && evt.composedPath());
      Array.from(path).forEach(element => {

        if (element.classList && element.classList.contains('page-order__item')) {

          element.classList.toggle('order-item--active');

        }

      });

      evt.target.classList.toggle('order-item__toggle--active');

    }
    /* кнопка статуса Заказа */
    if (evt.target.classList && evt.target.classList.contains('order-item__btn')) {

      const status = evt.target.previousElementSibling;

      if (status.classList && status.classList.contains('order-item__info--no')) {
        status.textContent = 'Выполнено';
      } else {
        status.textContent = 'Не выполнено';
      }

      status.classList.toggle('order-item__info--no');
      status.classList.toggle('order-item__info--yes');

    }

    /* кнопка оплаты заказа */
    if (evt.target.classList && evt.target.classList.contains('order-item__btnpay')) {

      const status = evt.target.previousElementSibling;

      if (status.classList && status.classList.contains('order-item__info--no')) {
        status.textContent = 'Оплачен';
      } else {
        status.textContent = 'Не оплачен';
      }

      status.classList.toggle('order-item__info--no');
      status.classList.toggle('order-item__info--yes');

    }


  });

}
/* -- конец списка заказов */

/**
* сравниваем пароль при добавлении нового пользователя
*/
function comparePass()
{
  var p1 = document.getElementById('pass');
  var p2 = document.getElementById('pass2');

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

/**
* добавление нового заказа ::
* отключаем "залог"
*/
function disDeposit()
{
    const deposit = document.getElementById('deposit');
    const pay = document.getElementById('pay');

    if(pay.checked) {
      deposit.value = '';
      deposit.setAttribute('disabled','disabled');
      // обновляем сумму при оплате сразу
      totalPrice();
    } else {
      deposit.removeAttribute('disabled');
    }
}

/**
* добавление нового заказа ::
* активируем/дезактивируем поле ввода цены фурнитуры
*/
function enFurPrice()
{
    const furPrice = document.getElementById('furprice');
    const furName = document.getElementById('furnit');
    const furCBox = document.getElementById('furpay');
    const furNameVal = furName.value.trim();
    if (furNameVal.length === 0) {
      furPrice.value = '';
      furPrice.setAttribute('disabled', 'disabled');
      furCBox.checked = false;
      furCBox.setAttribute('disabled', 'disabled');
    } else {
      furCBox.removeAttribute('disabled');
      furPrice.removeAttribute('disabled');
      furPrice.setAttribute('required', '');
    }
}

/**
* добавление нового заказа ::
* добавляем поля для ещё одной услуги
*/
function addService()
{
    var serviceNameDiv = document.querySelector("div.serviceName");
    var servicePriceDiv = document.querySelector("div.servicePrice");
    // количество элементов
    var qntEl = document.getElementsByClassName('serviceName').length;
    // клонируем элемент serviceDiv
    var newServiceNameDiv = serviceNameDiv.cloneNode(true);
    var newServicePriceDiv = servicePriceDiv.cloneNode(true);
    // добавляем в конец элемента service
    document.getElementById('service').appendChild(newServiceNameDiv);
    document.getElementById('service').appendChild(newServicePriceDiv);
    var number = qntEl + 1;
    newServiceNameDiv.querySelector("select").setAttribute("name", "service"+number);
    newServiceNameDiv.querySelector("select").setAttribute("id", "service"+number);
    newServiceNameDiv.querySelector("label").setAttribute("for", "service"+number);
    newServicePriceDiv.querySelector("input").setAttribute("name", "price"+number);
    newServicePriceDiv.querySelector("input").setAttribute("id", "price"+number);
    newServicePriceDiv.querySelector("input").value = '';
    newServicePriceDiv.querySelector("label").setAttribute("for", "price"+number);  
}

/**
* добавление нового заказа ::
* убираем поля услуг
* если поля остались в единственном числе, то не убираем единственное
*/
function removeService()
{
    var serviceDiv = document.getElementById("service");
    var qnt = document.getElementsByClassName('serviceName').length;
    // находим узел, который будем удалять - первый параграф
    var serviceNameDiv = document.querySelectorAll("div#service div.serviceName")[qnt-1];
    var servicePriceDiv = document.querySelectorAll("div#service div.servicePrice")[qnt-1];
    // удаляем узел только если элемент не остался 1 на странице
    if (qnt > 1) {
      serviceDiv.removeChild(servicePriceDiv);
      serviceDiv.removeChild(serviceNameDiv);
      
      // обновляем цену при удалении
      totalPrice();
    }
}

/**
* добавление нового заказа ::
* считаем и выводим общую сумму заказа
*/
function totalPrice()
{
  var service = document.querySelectorAll('.servicePrice input');
  var res = document.getElementById('price');
  var furniture = document.getElementById('furprice');
  var deposit = document.getElementById('deposit');
  var sum = 0.0;
  // суммируем все цены услуг
  service.forEach( inp => {
    sum += Number(inp.value);
  })
  // добавляем фурнитуру и вычитаем залог (если есть)
  res.value = sum + Number(furniture.value) - Number(deposit.value);
}

/**
* проверяем день недели из поля "дата"
* в форме оформления нового заказа
*/
function checkDayWeek()
{
  const inp = document.getElementById('order_to');

  const oDate = new Date(inp.value);
  const dayOfWeek = oDate.getDay();

  if (dayOfWeek == 1) {
    alert('ПОНЕДЕЛЬНИК - ВЫХОДНОЙ; НЕЛЬЗЯ ВЫБРАТЬ ПОНЕДЕЛЬНИК!')
    $('#order_to_fault').show();
    //$('#order_to_modal').show();
  } else {
    $('#order_to_fault').hide();
    //$('#order_to_modal').hide();
  }
}