function createElement(type)
{
    return  document.createElement(type);
}

$(document).ready(function(){
    $.ajax({
        url: 'showProducts',
        type: 'POST',
        data: {},
        dataType:'json',
        success: function (data) {
            data.forEach(function (item){
                console.log(item);

                let container = document.getElementById('product-container');
                let divImageContainer = createElement('div');
                let divImage = createElement('div');
                let img = createElement('img');
                let path = 'images/shop/'+item.images[0].source;

                let divProductContainer= createElement('div');
                let divProductInformation= createElement('div');
                let productFullName = createElement('h2');
                let productId = createElement('p');
                let productRating = createElement('p');
                let divProductInfo = createElement('div');
                let productPrice = createElement('p');
                let productCategory = createElement('p');
                let productSeason = createElement('p');
                let productDiameter = createElement('p');
                let productWidth = createElement('p');
                let productHeight = createElement('p');
                let linkCart = createElement('a');
                let linkDetails = createElement('a');

                divImageContainer.className='col-sm-5 margin-bottom';
                divImage.className='view-product';
                img.src= path;

                divProductContainer.className='col-sm-7 margin-bottom';
                divProductInformation.className='product-information';
                productFullName.innerHTML=item.brand.name+' '+item.name;
                productId.innerHTML='Web ID:' + ' '+item.id;
                productRating.innerHTML='Рейтинг:' + ' '+item.rating;
                divProductInfo.className='product-info';
                productPrice.innerHTML='<b class="bold price">'+item.price+'р'+'</b>';
                productCategory.innerHTML='<b>Назначение:</b>'+' '+item.category.name;
                productSeason.innerHTML='<b>Сезон:</b>'+' '+item.season.name;
                productDiameter.innerHTML='<b>Диаметр:</b>'+' '+item.diameter+'"';
                productWidth.innerHTML='<b>Ширина:</b>'+' '+item.width;
                productHeight.innerHTML='<b>Высота:</b>'+' '+item.height;

                linkCart.className='btn btn-default add-to-cart margin-right';
                linkCart.innerHTML='<i class="fa fa-shopping-cart"></i>В корзину';
                linkCart.href='cart';

                linkDetails.className='btn btn-default add-to-cart';
                linkDetails.innerHTML='<i class="fa fa-plus-square"></i>Подробнее';
                linkDetails.href='details/'+item.id;

                container.append(divImageContainer);
                container.append(divProductContainer);

                divImageContainer.appendChild(divImage);

                divImage.appendChild(img);

                divProductContainer.appendChild(divProductInformation);

                divProductInformation.appendChild(productFullName);
                divProductInformation.appendChild(productId);
                divProductInformation.appendChild(productRating);
                divProductInformation.appendChild(divProductInfo);

                divProductInfo.appendChild(productPrice);
                divProductInfo.appendChild(productCategory);
                divProductInfo.appendChild(productSeason);
                divProductInfo.appendChild(productDiameter);
                divProductInfo.appendChild(productWidth);
                divProductInfo.appendChild(productHeight);
                divProductInfo.appendChild(linkCart);
                divProductInfo.appendChild(linkDetails);
            });
        }
    });
});