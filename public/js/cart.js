let discount = 0;
let delivery = 0;

/*Работа чекбоксов, исключения выбора 2 одновременно. СПОСОБ ДОСТАВКИ*/
$('#courierDelivery').on("click", function () {
    if($('#courierDelivery').prop('checked') == true & $('#pickup').prop('checked') == true){
        $('#pickup').attr('checked', false);
    }
  deliveryMethod();
})

$('#pickup').on("click", function () {
    if($('#courierDelivery').prop('checked') == true & $('#pickup').prop('checked') == true){
        $('#courierDelivery').attr('checked', false);
    }
    deliveryMethod();
})

/*Работа чекбоксов, исключения выбора 2 одновременно. СПОСОБ ОПЛАТЫ*/
$('#cash').on("click", function () {
    if($('#card').prop('checked') == true & $('#cash').prop('checked') == true){
    $('#card').attr('checked', false);
    }
})

$('#card').on("click", function () {
    if($('#card').prop('checked') == true & $('#cash').prop('checked') == true){
        $('#cash').attr('checked', false);
    }
})

/*Функция рассчета стоимости доставки*/
function deliveryMethod()
{
    if($('#courierDelivery').prop('checked') == true) {
        let totalPriceOrder =parseFloat($("#total-price-order").text());
        delivery = 15;
        $("#delivery").text(15 + ' p.');
        discountAndCost(totalPriceOrder, delivery);
    } else {
        let totalPriceOrder =parseFloat($("#total-price-order").text());
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
    if (totalPriceOrder <= 0){
        $("#total-cost").text(0 + ' p.');
    }else {
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
$('#checkout').on("click", function (){
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

    if (firstName == ""){
        $('#firstNameErrorValid').removeClass('hide');
        return false;
    }else {
        $('#firstNameErrorValid').addClass('hide');
    }

    if (lastName == ""){
        $('#lastNameErrorValid').removeClass('hide');
        return false;
    }else {
        $('#lastNameErrorValid').addClass('hide');
    }

    if (address == ""){
        $('#addressErrorValid').removeClass('hide');
        return false;
    }else {
        $('#addressErrorValid').addClass('hide');
    }

    if (postalCode == ""){
        $('#postalCodeErrorValid').removeClass('hide');
        return false;
    }else {
        $('#postalCodeErrorValid').addClass('hide');
    }

    if (phone == ""){
        $('#phoneErrorValid').removeClass('hide');
        return false;
    }else {
        $('#phoneErrorValid').addClass('hide');
    }

    if (courierDelivery != true & pickup != true){
        $('#deliveryErrorValid').removeClass('hide');
        return false;
    }else {
        $('#deliveryErrorValid').addClass('hide');
    }

    if (cash != true & card != true){
        $('#payMethodErrorValid').removeClass('hide');
        return false;
    }else {
        $('#payMethodErrorValid').addClass('hide');
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
            courierDelivery: courierDelivery,
            pickup: pickup,
            cash: cash,
            card: card
            },
        dataType: 'json',
        success: function (data) {
            $("#user-info").trigger("reset");
            console.log(data);
        }
    })
})