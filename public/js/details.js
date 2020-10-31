let statusVisibilityMin=4;
let statusVisibilityRec=4;
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
    if(statusVisibilityMin>4)
    {
        var idImageNext = '#' + (statusVisibilityMin-1);
        var idImagePrev = '#' + (statusVisibilityMin-4);
        statusVisibilityMin--;
        $(idImagePrev).removeClass('hide');
        $(idImageNext).addClass('hide');
    }
    if(statusVisibilityMin == 4)
    {
        $("#prev-product").addClass('hide');
    }
});

$("#next-product").on("click",function ()
{
    $("#prev-product").removeClass('hide');
    if(statusVisibilityMin<imageCount)
    {
        var idImageNext = '#' + statusVisibilityMin;
        var idImagePrev = '#' + (statusVisibilityMin-3);
        statusVisibilityMin++;
        $(idImageNext).removeClass('hide');
        $(idImagePrev).addClass('hide');
        if(statusVisibilityMin == imageCount)
        {
            $("#next-product").addClass('hide');
        }
    }
});

//Карусель для рекомендуемых
$("#prev-recommended").on("click",function ()
{
    $("#next-recommended").removeClass('hide');
    if(statusVisibilityRec>4)
    {
        $("#prev-recommended").addClass('hide');
        var idImageNext = '#recommended' + (statusVisibilityRec-1);
        var idImagePrev = '#recommended' + (statusVisibilityRec-4);
        statusVisibilityRec--;
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
    if(statusVisibilityRec<recommendedCount)
    {
        var idImageNext = '#recommended' + statusVisibilityRec;
        var idImagePrev = '#recommended' + (statusVisibilityRec-3);
        statusVisibilityRec++;
        $(idImageNext).removeClass('hide');
        $(idImagePrev).addClass('hide');
        if(statusVisibilityRec == recommendedCount)
        {
            $("#next-recommended").addClass('hide');
        }
    }
});


