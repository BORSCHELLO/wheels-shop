
function createElement(type)
{
    return  document.createElement(type);
}

$(document).ready(function(){
    $.ajax({
        url: 'filter-data',
        type: 'POST',
        data: {},
        dataType:'json',
        success: function (data) {
            data.forEach(function (item){
                var element = document.getElementById('category-container');
                var li= createElement('li');
                var a= createElement('a');

                li.className='margin-li-style';
                a.className='category-name';
                a.id= 'category'+item.id;
                a.href='#';

                a.innerHTML= item.name;
                element.appendChild(li);
                li.append(a);
            });
        }
    });
});