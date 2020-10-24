var statusVisibility=4;
var imageCount=0;

function createElement(type)
{
    return  document.createElement(type);
}

$(document).ready(function() {
    //Вывод изображений
    var product = $('.product-data').data('product');
    product=product[0];
    var container = document.getElementById('image-container');
    var imageMain =  createElement('img');
    console.log(product);
    var litleImageContainer = document.getElementById('litleImage-container');

        product.images.forEach(function (item,i) {
            imageCount++;
        var litleImage =  createElement('a');
        litleImage.className='carousel-inner';
        if(i==0 || i>3){
            litleImage.className='carousel-inner hide';
        }
        litleImageContainer.appendChild(litleImage);
        var image=createElement('img');
        image.src = '/images/shop/' + item.source;
        litleImage.id=i;
        litleImage.appendChild(image);
        })
    imageMain.src= '/images/shop/' + product.images[0].source;

    container.appendChild(imageMain);

    //Вывод информации о товаре
    let containerProduct = document.getElementById('product-container');
    let productFullName = createElement('h2');
    let productId = createElement('p');
    let productRating = createElement('p');
    let productPrice = createElement('p');
    let productCategory = createElement('p');
    let productBrand = createElement('p');
    let productDiameter = createElement('p');
    let productWidth = createElement('p');
    let productHeight = createElement('p');
    let productSeason = createElement('p');
    let productDesign = createElement('p');
    let productSealing = createElement('p');
    let productSpeed = createElement('p');
    let productLoad = createElement('p');
    let productThorns = createElement('p');
    let productLaunchDate = createElement('p');
    let linkCart = createElement('a');

    productFullName.innerHTML=product.brand.name+' '+product.name;
    productId.innerHTML='Web ID:' + ' '+product.id;
    productRating.innerHTML='Рейтинг:' + ' '+product.rating;
    productPrice.innerHTML='<b class="bold price">'+product.price+'р'+'</b>';
    productCategory.innerHTML='<b>Назначение:</b>'+' '+product.category.name;
    productBrand.innerHTML='<b>Производитель:</b>'+' '+product.brand.name;
    productDiameter.innerHTML='<b>Диаметр:</b>'+' '+product.diameter+'"';
    productWidth.innerHTML='<b>Ширина:</b>'+' '+product.width;
    productHeight.innerHTML='<b>Высота:</b>'+' '+product.height;
    productSeason.innerHTML='<b>Сезон:</b>'+' '+product.season.name;
    productDesign.innerHTML='<b>Конструкция:</b>'+' '+product.design.name;
    productSealing.innerHTML='<b>Способ герметизации:</b>'+' '+product.sealingMethod.name;
    productSpeed.innerHTML='<b>Индекс скорости:</b>'+'до '+product.speedIndex+' км\/ч';
    productLoad.innerHTML='<b>Индекс нагрузки:</b>'+' '+product.loadIndex;
    productThorns.innerHTML='<b>Шипы:</b>'+' '+product.thorns.name;
    productLaunchDate.innerHTML='<b>Дата выхода на рынок:</b>'+' '+product.marketLaunchDate+' г.';

    linkCart.className='btn btn-default cart';
    linkCart.innerHTML='<i class="fa fa-shopping-cart"></i> В корзину';
    linkCart.href= '#';

    containerProduct.appendChild(productFullName);
    containerProduct.appendChild(productId);
    containerProduct.appendChild(productRating);
    containerProduct.appendChild(productPrice);
    containerProduct.appendChild(productCategory);
    containerProduct.appendChild(productBrand);
    containerProduct.appendChild(productDiameter);
    containerProduct.appendChild(productWidth);
    containerProduct.appendChild(productHeight);
    containerProduct.appendChild(productSeason);
    containerProduct.appendChild(productDesign);
    containerProduct.appendChild(productSealing);
    containerProduct.appendChild(productSpeed);
    containerProduct.appendChild(productLoad);
    containerProduct.appendChild(productThorns);
    containerProduct.appendChild(productLaunchDate);
    containerProduct.appendChild(linkCart);

});

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
