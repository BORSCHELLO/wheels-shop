let statusVisibility=4;
let elem = $("a.carousel-inner");
let imageCount = elem.length+1;
//Карусель
$("#prev-product").on("click",function () {
    if(statusVisibility>4)
    {
        var idImageNext = '#' + (statusVisibility-1);
        var idImagePrev = '#' + (statusVisibility-4);
        statusVisibility--;
        $(idImagePrev).removeClass('hide');
        $(idImageNext).addClass('hide');
    }
});

$("#next-product").on("click",function () {
    if(statusVisibility<imageCount)
    {
        var idImageNext = '#' + statusVisibility;
        var idImagePrev = '#' + (statusVisibility-3);
        statusVisibility++;
        $(idImageNext).removeClass('hide');
        $(idImagePrev).addClass('hide');
    }
});
