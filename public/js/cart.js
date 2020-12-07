let discount = 0;
let delivery = 0;

/*Работа чекбоксов, исключения выбора 2 одновременно. СПОСОБ ДОСТАВКИ*/
$('#courierDelivery').on("click", function () {
    if ($('#courierDelivery').prop('checked') == true & $('#pickup').prop('checked') == true) {
        $('#pickup').attr('checked', false);
    }
    DeliveryMethod();
})

$('#pickup').on("click", function () {
    if ($('#courierDelivery').prop('checked') == true & $('#pickup').prop('checked') == true) {
        $('#courierDelivery').attr('checked', false);
    }
    DeliveryMethod();
})

/*Работа чекбоксов, исключения выбора 2 одновременно. СПОСОБ ОПЛАТЫ*/
$('#cash').on("click", function () {
    if ($('#card').prop('checked') == true & $('#cash').prop('checked') == true) {
        $('#card').attr('checked', false);
    }
})

$('#card').on("click", function () {
    if ($('#card').prop('checked') == true & $('#cash').prop('checked') == true) {
        $('#cash').attr('checked', false);
    }
})

/*Функция рассчета стоимости доставки*/
function DeliveryMethod() {
    if ($('#courierDelivery').prop('checked') == true) {
        let totalPriceOrder = parseFloat($("#total-price-order").text());
        delivery = 15;
        $("#delivery").text(15 + ' p.');
        discountAndCost(totalPriceOrder, delivery);
    } else {
        let totalPriceOrder = parseFloat($("#total-price-order").text());
        delivery = 0;
        $("#delivery").text(0 + ' p.');
        discountAndCost(totalPriceOrder, delivery);
    }
}

/*Функция рассчета конечной стоимости*/
function discountAndCost(totalPriceOrder, delivery) {
    if (totalPriceOrder > 400) {
        discount = totalPriceOrder.toFixed(2) * 0.05;
        $("#discount").text((discount).toFixed(2) + ' p.');
    } else {
        $("#discount").text(0);
    }
    if (totalPriceOrder <= 0) {
        $("#total-cost").text(0 + ' p.');
    } else {
        $("#total-cost").text((totalPriceOrder - (discount) + delivery).toFixed(2) + ' p.');
    }
}

/*Удаление из корзины*/
$(".cart_delete").on("click", function () {
    let idForAjax = this.id;
    let idForPriceItem = "#price-" + idForAjax;
    let currentPriceOrder = parseFloat($("#total-price-order").text());
    let totalPriceForItem = parseFloat($(idForPriceItem).text());
    let totalPriceOrder = (currentPriceOrder - totalPriceForItem);
    $.ajax({
        url: 'cart/delete/' + idForAjax,
        type: 'POST',
        data: {id: idForAjax},
        dataType: 'json',
        success: function (data) {
            let id = "#cart-item-" + idForAjax;
            $(id).addClass('hide');
            $("#total-price-order").text(totalPriceOrder.toFixed(2) + " p.");

            discountAndCost(totalPriceOrder, delivery);
        }
    })
})

/*Уменьшение количества товара*/
$(".cart_quantity_down").on("click", function () {
    let idForAjax = this.id;
    let idForCheck = "#input-" + idForAjax;
    let idForPriceItem = "#price-" + idForAjax;
    let idPriceItemHidden = "#price-item-" + idForAjax;
    let price = parseFloat($(idPriceItemHidden).text());
    let check = $(idForCheck).val();
    let currentPriceOrder = parseFloat($("#total-price-order").text());
    if (check > 1) {
        $.ajax({
            url: 'cart/decrement/' + idForAjax,
            type: 'POST',
            data: {},
            dataType: 'json',
            success: function (data) {
                $(idForCheck).val(data);
                let totalPriceForItem = (price * data);
                $(idForPriceItem).text(totalPriceForItem + " p.");
                let totalPriceOrder = currentPriceOrder - price;
                $("#total-price-order").text(totalPriceOrder.toFixed(2) + " p.")

                discountAndCost(totalPriceOrder, delivery);
            }
        })
    }
})

/*Увеличение количества товара*/
$(".cart_quantity_up").on("click", function () {
    let idForAjax = this.id;
    let idForCheck = "#input-" + idForAjax;
    let idForPriceItem = "#price-" + idForAjax;
    let idPriceItemHidden = "#price-item-" + idForAjax;
    let price = parseFloat($(idPriceItemHidden).text());
    let currentPriceOrder = parseFloat($("#total-price-order").text());
    $.ajax({
        url: 'cart/increment/' + idForAjax,
        type: 'POST',
        data: {},
        dataType: 'json',
        success: function (data) {
            $(idForCheck).val(data);
            let totalPriceForItem = (price * data);
            $(idForPriceItem).text(totalPriceForItem + " p.");
            let totalPriceOrder = currentPriceOrder + price;
            $("#total-price-order").text(totalPriceOrder.toFixed(2) + " p.");

            discountAndCost(totalPriceOrder, delivery);
        }
    })
})

/*Оформление заказа*/
$('#checkout').on("click", function () {
    let firstName = $('#firstName').val().trim();
    let lastName = $('#lastName').val().trim();
    let address = $('#address').val().trim();
    let postalCode = $('#postalCode').val().trim();
    let phone = $('#phone').val().trim();
    let noteOfOrder = $('#noteOfOrder').val().trim();
    let courierDelivery = $('#courierDelivery').prop('checked');
    let pickup = $('#pickup').prop('checked');
    let cash = $('#cash').prop('checked');
    let card = $('#card').prop('checked');
    let paymentMethod;
    let deliveryMethod;

     if (firstName == "") {
         $('#firstNameErrorValid').text('Введите Имя');
         return false;
     } else if (firstName.length < 5) {
         $('#firstNameErrorValid').text('Имя должно быть больше 5 символов');
         return false;
     } else if (firstName.length > 30) {
         $('#firstNameErrorValid').text('Имя должно быть меньше 30 символов');
         return false;
     } else {
         $('#firstNameErrorValid').text('');
     }

     if (lastName == "") {
         $('#lastNameErrorValid').text('Введите Фамилию');
         return false;
     } else if (lastName.length < 5) {
         $('#lastNameErrorValid').text('Фамилия должна быть больше 5 символов');
         return false;
     } else if (lastName.length > 30) {
         $('#lastNameErrorValid').text('Фамилия должна быть меньше 30 символов');
         return false;
     } else {
         $('#lastNameErrorValid').text('');
     }

     if (address == "") {
         $('#addressErrorValid').text('Введите Адрес');
         return false;
     } else if (address.length < 5) {
         $('#addressErrorValid').text('Адрес должен быть больше 5 символов');
         return false;
     } else if (address.length > 255) {
         $('#addressErrorValid').text('Адрес должен быть меньше 255 символов');
         return false;
     } else {
         $('#addressErrorValid').text('');
     }

     if (postalCode == "") {
         $('#postalCodeErrorValid').text('Введите Индекс');
         return false;
     } else if (postalCode.length < 5) {
         $('#postalCodeErrorValid').text('Индекс должен быть больше 5 символов');
         return false;
     } else if (postalCode.length > 15) {
         $('#postalCodeErrorValid').text('Индекс должен быть меньше 15 символов');
         return false;
     } else {
         $('#postalCodeErrorValid').text('');
     }

     if (phone == "") {
         $('#phoneErrorValid').text('Введите Телефон');
         return false;
     } else if (phone.length < 5) {
         $('#phoneErrorValid').text('Телефон должен быть больше 5 символов');
         return false;
     } else if (phone.length > 30) {
         $('#phoneErrorValid').text('Телефон должен быть меньше 30 символов');
         return false;
     } else {
         $('#phoneErrorValid').text('');
     }

     if (noteOfOrder.length > 500) {
         $('#noteOfOrderErrorValid').text('Примечание к заказу должно быть меньше 500 символов');
         return false;
     } else {
         $('#phoneErrorValid').text('');
     }

     if (courierDelivery != true & pickup != true) {
         $('#deliveryErrorValid').text('Выберите способ доставки');
         return false;
     } else {
         $('#deliveryErrorValid').text('');
     }

     if (cash != true & card != true) {
         $('#payMethodErrorValid').text('Выберите способ оплаты');
         return false;
     } else {
         $('#payMethodErrorValid').text('');
     }

    if (cash) {
        paymentMethod = 'cash';
    } else {
        paymentMethod = 'card'
    }

    if (courierDelivery) {
        deliveryMethod = 'courierDelivery';
    } else {
        deliveryMethod = 'pickup'
    }

    $.ajax({
        url: 'order/add',
        type: 'POST',
        data: {
            firstName: firstName,
            lastName: lastName,
            address: address,
            postalCode: postalCode,
            phone: phone,
            noteOfOrder: noteOfOrder,
            paymentMethod: paymentMethod,
            deliveryMethod: deliveryMethod
        },
        dataType: 'json',
        success: function (data) {
            $("#user-info").trigger("reset");
            if (data.path == "cartEmpty"){
                let property = data.path;
                let selector = '#' + property + 'ErrorValid';
                let message = data.message;
                if (property) {
                    $(selector).text(message);
                    return false;
                } else {
                    $(selector).text('');
                }
            }

            if (data.length > 1){
                data.forEach(function (item) {
                    let property = item.path;
                    let selector = '#' + property + 'ErrorValid';
                    let message = item.message;
                    if (property) {
                        $(selector).text(message);
                        return false;
                    } else {
                        $(selector).text('');
                    }
                })
            }

            $("#cart_items").remove();
            let orderNumber = 'Ваш заказ № '+ data.id + ' принят в обработку!';
            let orderCost = 'Итоговая стоимость: '+ data.price.toFixed(2) + ' р.';
            $("#orderNumber").text(orderNumber);
            $("#orderCost").text(orderCost);
            $("#containerOrder").removeClass('hide');
        }
    })
})