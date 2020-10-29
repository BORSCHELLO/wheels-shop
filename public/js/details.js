let statusVisibility=4;
let elem = $("a.carousel-inner");
let imageCount = elem.length+1;
let recommended = $("a.carousel-inner-rec");
let recommendedCount = recommended.length+1;

$(document).ready(function(){
    $("#prev-recommended").addClass('hide');
    $("#prev-product").addClass('hide');
});
if(elem.length<4)
{
    $("#prev-product").addClass('hide');
    $("#next-product").addClass('hide');
}

if(recommended.length<4)
{
    $("#prev-recommended").addClass('hide');
    $("#next-recommended").addClass('hide');
}

//Карусель для миниатюр
$("#prev-product").on("click",function ()
{
    $("#next-product").removeClass('hide');
    if(statusVisibility>4)
    {
        var idImageNext = '#' + (statusVisibility-1);
        var idImagePrev = '#' + (statusVisibility-4);
        statusVisibility--;
        $(idImagePrev).removeClass('hide');
        $(idImageNext).addClass('hide');
    }
    if(statusVisibility == 4)
    {
        $("#prev-product").addClass('hide');
    }
});

$("#next-product").on("click",function ()
{
    $("#prev-product").removeClass('hide');
    if(statusVisibility<imageCount)
    {
        var idImageNext = '#' + statusVisibility;
        var idImagePrev = '#' + (statusVisibility-3);
        statusVisibility++;
        $(idImageNext).removeClass('hide');
        $(idImagePrev).addClass('hide');
        if(statusVisibility == imageCount)
        {
            $("#next-product").addClass('hide');
        }
    }
});

//Карусель для рекомендуемых
$("#prev-recommended").on("click",function ()
{
    $("#next-recommended").removeClass('hide');
    if(statusVisibility>4)
    {
        $("#prev-recommended").addClass('hide');
        var idImageNext = '#recommended' + (statusVisibility-1);
        var idImagePrev = '#recommended' + (statusVisibility-4);
        statusVisibility--;
        $(idImagePrev).removeClass('hide');
        $(idImageNext).addClass('hide');
    }
    if(statusVisibility == 4)
    {
        $("#prev-recommended").addClass('hide');
    }
});

$("#next-recommended").on("click",function ()
{
    $("#prev-recommended").removeClass('hide');
    if(statusVisibility<recommendedCount)
    {
        var idImageNext = '#recommended' + statusVisibility;
        var idImagePrev = '#recommended' + (statusVisibility-3);
        statusVisibility++;
        $(idImageNext).removeClass('hide');
        $(idImagePrev).addClass('hide');
        if(statusVisibility == recommendedCount)
        {
            $("#next-recommended").addClass('hide');
        }
    }
});


