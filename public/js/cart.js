let discount = 0;

function discountAndCost(totalPriceOrder) {
    if (totalPriceOrder > 400) {
        discount = totalPriceOrder.toFixed(2) * 0.05;
        $("#discount").text((discount).toFixed(2) + ' p.');
    } else {
        $("#discount").text(0);
    }

    $("#total-cost").text((totalPriceOrder - (discount) + 15).toFixed(2) + ' p.');
}

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

            discountAndCost(totalPriceOrder);
        }
    })
})

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

                discountAndCost(totalPriceOrder);
            }
        })
    }
})

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

            discountAndCost(totalPriceOrder);
        }
    })
})

