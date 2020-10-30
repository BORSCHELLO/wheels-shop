$(".brand").on("click",function (){
    let idBrand = '#brand'+this.id;
    $(".fade").removeClass('active in');
    $(idBrand).addClass('active in');
});