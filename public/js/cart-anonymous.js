$(".cart_delete").on("click",function (){
    let idForAjax = this.id;
    let idForPriceItem = "#price-"+idForAjax;
    let currentPriceOrder = parseFloat($("#total-price-order").text());
    let totalPriceForItem = parseFloat($(idForPriceItem).text());
    let totalPriceOrder = (currentPriceOrder - totalPriceForItem);
    $.ajax({
        url: 'cart/delete',
        type: 'POST',
        data: {id:idForAjax},
        dataType:'json',
        success: function (data)
        {
            let id = "#cart-item-"+idForAjax;
            $(id).addClass('hide');
            $("#total-price-order").text(totalPriceOrder + " p.");
        }
    })
})

$(".cart_quantity_down").on("click",function () {
    let idForAjax = this.id;
    let idForCheck ="#input-"+idForAjax;
    let idForPriceItem = "#price-"+idForAjax;
    let idPriceItemHidden = "#price-item-"+idForAjax;
    let price = parseFloat($(idPriceItemHidden).text());
    let check = $(idForCheck).val();
    let currentPriceOrder = parseFloat($("#total-price-order").text());
    if(check > 1){
        $.ajax({
            url: 'cart/decrement',
            type: 'POST',
            data: {id:idForAjax},
            dataType:'json',
            success: function (data)
            {
                $(idForCheck).val(data);
                let totalPriceForItem = (price*data);
                $(idForPriceItem).text(totalPriceForItem+" p.");
                let totalPriceOrder= currentPriceOrder - price;
                $("#total-price-order").text(totalPriceOrder + " p.");
            }
        })}
})

$(".cart_quantity_up").on("click",function () {
    let idForAjax = this.id;
    let idForCheck ="#input-"+idForAjax;
    let idForPriceItem = "#price-"+idForAjax;
    let idPriceItemHidden = "#price-item-"+idForAjax;
    let price = parseFloat($(idPriceItemHidden).text());
    let currentPriceOrder = parseFloat($("#total-price-order").text());
    $.ajax({
        url: 'cart/increment',
        type: 'POST',
        data: {id:idForAjax},
        dataType:'json',
        success: function (data)
        {
            $(idForCheck).val(data);
            let totalPriceForItem = (price*data);
            $(idForPriceItem).text(totalPriceForItem + " p.");
            let totalPriceOrder= currentPriceOrder + price;
            $("#total-price-order").text(totalPriceOrder + " p.");
        }
    })
})