$(".cart_delete").on("click",function (){
    let idForAjax = this.id;
    $.ajax({
        url: 'cart/delete',
        type: 'POST',
        data: {id:idForAjax},
        dataType:'json',
        success: function (data)
        {
    let id = "#cart-item-"+idForAjax;
    $(id).addClass('hide');
        }
    })
})

$(".cart_quantity_down").on("click",function () {
    let idForAjax = this.id;
    let idForCheck ="#input-"+idForAjax;
    let idForPriceItem = "#price-"+idForAjax;
    let idPriceItemHidden = "#price-item-"+idForAjax;
    let price = $(idPriceItemHidden).text();
    let check = $(idForCheck).val();
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
        }
    })}
})

$(".cart_quantity_up").on("click",function () {
    let idForAjax = this.id;
    let idForCheck ="#input-"+idForAjax;
    let idForPriceItem = "#price-"+idForAjax;
    let idPriceItemHidden = "#price-item-"+idForAjax;
    let price = $(idPriceItemHidden).text();
    let check = $(idForCheck).val();
    $.ajax({
        url: 'cart/increment',
        type: 'POST',
        data: {id:idForAjax},
        dataType:'json',
        success: function (data)
        {
            $(idForCheck).val(data);
            let totalPriceForItem = (price*data);
            $(idForPriceItem).text(totalPriceForItem+" p.");
        }
    })
})