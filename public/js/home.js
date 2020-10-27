function createElement(type)
{
    return  document.createElement(type);
}

$(document).ready(function() {
    var products = $('.product-data').data('product');
    products.forEach(function (item) {
        let containerMainWrapper = document.getElementById('container-main-wrapper');
        let container= createElement('div')
        let productWrapper = createElement('div');
        let productSingle = createElement('div');
        let productInfoMain = createElement('div');
        let img = createElement('img');
        let path = 'images/shop/'+item.images[0].source;
        let productPriceMain = createElement('h2');
        let productBrand = createElement('p');
        let productModel = createElement('p');
        let productSeason = createElement('p');
        let productDiameter = createElement('p');
        let linkCart = createElement('a');
        let productOverlayContainer = createElement('div');
        let productOverlayContent = createElement('div');
        let productOverlayBrand = createElement('p');
        let productOverlayModel = createElement('p');
        let productOverlayDiameter = createElement('p');
        let productOverlayWidth = createElement('p');
        let productOverlayHeight = createElement('p');
        let productOverlaySeason = createElement('p');
        let productOverlayPrice = createElement('h2');
        let linkOverlayCart = createElement('a');
        let choose = createElement('div');
        let detailslinkUl = createElement('ul');
        let detailslinkLi = createElement('li');
        let linkDetails = createElement('a');

        container.className='col-sm-4';
        productWrapper.className='product-image-wrapper';
        productSingle.className='single-products';
        productInfoMain.className='productinfo text-center';
        img.src= path;
        img.height=300;

        productPriceMain.innerHTML='<b class="overlay-info">Цена: </b>'+ item.price+' р.';
        productBrand.innerHTML='<b class="brand-name">'+item.brand.name+'</b>';
        productModel.innerHTML='<b>'+item.name+'</b>';
        productSeason.innerHTML='<b>Сезон:</b>'+' '+item.season.name;
        productDiameter.innerHTML='<b>Диаметр:</b>'+' '+item.diameter+'"';
        linkCart.innerHTML='<a class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>В корзину</a>';
        linkCart.href='#';
        productOverlayContainer.className='product-overlay';
        productOverlayContent.className='overlay-content';
        productOverlayBrand.innerHTML='<b class="overlay-info brand-name">'+item.brand.name+'</b>';
        productOverlayModel.innerHTML='<b class="overlay-info">'+item.name+'</b>';
        productOverlayDiameter.innerHTML='<b class="overlay-info">Диаметр:</b>'+' '+'<b>'+item.diameter+'"'+'</b>';
        productOverlayWidth.innerHTML='<b class="overlay-info">Ширина:</b>'+' '+'<b>'+item.width+'</b>';
        productOverlayHeight.innerHTML='<b class="overlay-info">Высота:</b>'+' '+'<b>'+item.height+'</b>';
        productOverlaySeason.innerHTML='<b class="overlay-info">Сезон:</b>'+' '+'<b>'+item.season.name+'</b>';
        productOverlayPrice.innerHTML='<b class="overlay-info">Цена:</b>'+' '+item.price+' р.';
        linkOverlayCart.innerHTML='<a class="btn btn-default cart home-cart"><i class="fa fa-shopping-cart"></i>В корзину</a>';
        linkOverlayCart.href='#';
        choose.className='choose';
        detailslinkUl.className='nav nav-pills nav-justified';
        linkDetails.innerHTML='<i class="fa fa-plus-square"></i>Подробнее';
        linkDetails.href='details/'+item.id;

        containerMainWrapper.append(container);
        container.append(productWrapper);
        productWrapper.appendChild(productSingle);
        productSingle.appendChild(productInfoMain);
        productInfoMain.appendChild(img);
        productInfoMain.appendChild(productPriceMain);
        productInfoMain.appendChild(productBrand);
        productInfoMain.appendChild(productModel);
        productInfoMain.appendChild(productSeason);
        productInfoMain.appendChild(productDiameter);
        productInfoMain.appendChild(linkCart);
        productSingle.appendChild(productOverlayContainer);
        productOverlayContainer.appendChild(productOverlayContent);
        productOverlayContent.appendChild(productOverlayBrand);
        productOverlayContent.appendChild(productOverlayModel);
        productOverlayContent.appendChild(productOverlayDiameter);
        productOverlayContent.appendChild(productOverlayWidth);
        productOverlayContent.appendChild(productOverlayHeight);
        productOverlayContent.appendChild(productOverlaySeason);
        productOverlayContent.appendChild(productOverlayPrice);
        productOverlayContent.appendChild(linkOverlayCart);
        productWrapper.appendChild(choose);
        choose.appendChild(detailslinkUl);
        detailslinkUl.appendChild(detailslinkLi);
        detailslinkLi.appendChild(linkDetails);
    })
});