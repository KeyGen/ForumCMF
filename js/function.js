// Функция для запроса
// inquiry - что передаем
// delivery - массив передаваемых данных
var globalAjaxData = "";
function getPostAjax(type, inquiry, delivery){

    $.ajax({
        type: "POST",
        //путь к скрипту
        url: '/php/inquiryAjax.php',
        data:{'inquiry' : inquiry, 'array': delivery},
        dataType: type,
        success: function(data) {
            //в перменной data мы получим ответ от скрипта
            if (data) {   //true
                getDataAjax(data);
            } else {      //false
                alert ("Внутренния ошибка");
                getDataAjax(data);
            }
        },
        error: function (xhr, ajaxOptions, thrownError){
            //если ошибка аякса, то выведем ее
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function getDataAjax(data){
    globalAjaxData = data;
}

function previewSetCommit(text){

    var delivery = {'text' : text};
    getPostAjax('text', 'QCodeColor', delivery);

    setTimeout(function() {
        //alert(globalAjaxData);
        document.getElementById('showText').innerHTML = globalAjaxData;
        globalAjaxData = "";
    }, 300);

    //getPostAjax('setCommit', arr); = document.getElementById('textReceiveMail').value;
}