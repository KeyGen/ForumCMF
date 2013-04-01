// Функция для запроса
// inquiry - что передаем
// delivery - массив передаваемых данных
function getPostAjax(type, inquiry, delivery){

    $.ajax({
        type: "POST",
        async : false, // Вырубаем асинхронный режим ! :)
        //путь к скрипту
        url: '/php/inquiryAjax.php',
        data:{'inquiry' : inquiry, 'array': delivery},
        dataType: type,
        success: function(data) {
            //в перменной data мы получим ответ от скрипта
            value = data;
        },
        error: function (xhr, ajaxOptions, thrownError){
            //если ошибка аякса, то выведем ее
            alert(xhr.status);
            alert(thrownError);
        }
    });

    return value;
}

// Вывод модального инфорационного сообщения
function showDial(title, body, type){

    var icon = 'css/images/no.png'; // По умолчанию information

    switch (type){
        case 'information':
            icon = 'css/images/Info-Shield.png';
            break;
        case 'warning':
            icon = 'css/images/Error-Shield.png';
            break;
        case 'error':
            icon = 'css/images/Warning-Shield.png';
            break;
    }

    var setTitle = "<table cellpadding='0' cellspacing='0'><tr><td><img src='" + icon + "' width='30px'>&nbsp;&nbsp;&nbsp;</td><td style='color: #ffffff; font-weight: bolder;'>" + title + "</td></tr></table>";
    $('#dialog-body').html(body);

    var dialog = $("#dialog-message").dialog({
        title: setTitle,
        show: 'slide',
        position: 'left, top',
        minHeight: 200,
        minWidth: 400,
        buttons:{
            Ok: function(){
                $(this).dialog("close");
            }
        }
    });

    setTimeout(function() { $(dialog).dialog("close"); }, 2000);
}

// Вход пользователя
function entryUser(name, password){

    var delivery = {'name': name, 'password': password};
    var data = getPostAjax('text', 'entryUser', delivery);
    if(data != 'true'){
        showDial('Ошибка!','<p>'+data+'</p>');
    } else{
        location.reload();
    }
}

// Выход пользователя
function exitUser(){
    var delivery = [];
    getPostAjax('text', 'exitUser', delivery);
    location.reload();
}

// Получение сгенирированного пароля
function getGenPassword(){
    var delivery = [];
    var password = getPostAjax('text', 'getGenPassword', delivery);

    var style = document.getElementById('QPush_setGenPassword').className;
    document.getElementById('QPush_setGenPassword').className = style.replace('none','block');

    document.getElementById('randPasswordContainer').value = password;
}

// Тестирование данных по базе
function testData(find, value){

    var delivery = {'find': find, 'value': value};
    var data = getPostAjax('text', 'testData', delivery);

    if(data == 1)
        return false;
    else if(data == 0)
        return true;
    else
        alert(data);
}

// Тест регуляркой
function testPassword(value){
    var delivery = {'password': value};
    var data = getPostAjax('text', 'testPassword', delivery);

    if(data)
        return true;
    else
        return false;
}

// Тест регуляркой
function testEmail(value){
    var delivery = {'email': value};
    var data = getPostAjax('text', 'testEmail', delivery);

    if(data)
        return true;
    else
        return false;
}

// Регистрация пользователя
function userRegistration(){

    var name = document.getElementById('username');
    var email = document.getElementById('email');
    var emailControl = document.getElementById('emailControl');
    var password = document.getElementById('password');
    var passwordControl = document.getElementById('passwordControl');
    var captcha = document.getElementById('codeCaptcha');
    var time = 400;

    if(!name.value){
        goToPosElementForm('#username', -screen.height/2);
        setTimeout(function() { showDial('Ошибка!','Регистрация не возможна.<p>Введите ник.</p>');
            $('#username').focus();}, time);
    }
    else if(!password.value){
        goToPosElementForm('#password', -screen.height/2);
        setTimeout(function() { showDial('Ошибка!','Регистрация не возможна.<p>Введите пароль!</p>');
            $('#password').focus();}, time);
    }
    else if(!passwordControl.value){
        goToPosElementForm('#passwordControl', -screen.height/2);
        setTimeout(function() { showDial('Ошибка!','Регистрация не возможна.<p>Введите проверочный пароль!</p>');
            $('#passwordControl').focus();}, time);
    }
    else if(!email.value){
        goToPosElementForm('#email', -screen.height/2);
        setTimeout(function() { showDial('Ошибка!','Регистрация не возможна.<p>Введите email!.</p>');
            $('#email').focus();}, time);
    }
    else if(!emailControl.value){
        goToPosElementForm('#emailControl', -screen.height/2);
        setTimeout(function() { showDial('Ошибка!','Регистрация не возможна.<p>Введите проверочный email!</p>');
            $('#emailControl').focus();}, time);
    }
    else if(!captcha.value){
        goToPosElementForm('#codeCaptcha', -screen.height/2);
        setTimeout(function() { showDial('Ошибка!','Регистрация не возможна.<p>Введите текст с картинки!</p>');
            $('#codeCaptcha').focus();}, time);
    }
    else{
        var iconNoNik = document.getElementById('iconNoNik');
        var iconNoEmail = document.getElementById('iconNoEmail');
        var iconNoPassword = document.getElementById('iconNoPassword');

        if(iconNoNik.className == "block"){
            goToPosElementForm('#username', -screen.height/2);
            setTimeout(function() { showDial('Ошибка!','Регистрация не возможна.<p>Вы выбрали не подходящий ник! Измените его.</p>');
                $('#username').focus();}, time);
        }
        else if(iconNoPassword.className == "block"){
            goToPosElementForm('#password', -screen.height/2);
            setTimeout(function() { showDial('Ошибка!','Регистрация не возможна.<p>Вы выбрали не подходящий пароль! Измените его.</p>');
                $('#password').focus();}, time);
        }
        else if(iconNoEmail.className == "block"){
            goToPosElementForm('#email', -screen.height/2);
            setTimeout(function() { showDial('Ошибка!','Регистрация не возможна.<p>Вы выбрали не подходящий email! Измените его.</p>');
                $('#email').focus();}, time);
        }
        else{
            var delivery = {'name' : name.value, 'password': password.value, 'email': email.value, 'captcha': captcha.value}; // Создаем массив
            var data = getPostAjax('text', 'userRegistration', delivery);

            if(data == 'true'){

                $('#dialog-body').html('Регистрация успешна.<br>Для завершения регистрации вам на email выслана ссылка прейдите по ней. Спасибо.');

                var dialog = $("#dialog-message").dialog({
                    title: 'Регистрация на форуме',
                    position: 'left, top',
                    modal:true,
                    show: 'slide',
                    minHeight: 200,
                    minWidth: 400,
                    buttons:{
                        Ok: function(){
                            $(this).dialog("close");
                            window.location.href = "/";
                        }
                    }
                });
            }
            else if(data == 'captchaFalse'){
                goToPosElementForm('#codeCaptcha', -screen.height/2);
                setTimeout(function() { showDial('Ошибка!','Регистрация не выполнена.<p> Код с каптчи не верен!</p>');
                    $('#codeCaptcha').focus();}, time);
            }
            else {
                showDial('Ошибка!','Регистрация не выполнена.<p>'+data+'</p>');
            }
        }
    }
}

function setAvatar(img, name, code){

    var delivery = {'img': img, 'name': name, 'code': code};
    var data = getPostAjax('text', 'saveSetAvatar', delivery);

    if(data.indexOf('.png') != -1 || data.indexOf('.jpg') != -1){
        document.getElementById('image_list').value = "";
        document.getElementById('image_list').value = "";
        document.getElementById('buttonEditorAvatarSaveDownload2').className = 'none';
        document.getElementById('gfile').value = "";
        document.getElementById('generalAvatar').src = data;
        document.getElementById('generalAvatar2').src = data;
        showDial('Изменение автарки!','<p>Изменение аватарки выполнено.</p>','information');
    }
    else{
        document.getElementById('image_list').value = "";
        document.getElementById('image_list').value = "";
        document.getElementById('buttonEditorAvatarSaveDownload2').className = 'none';
        document.getElementById('gfile').value = "";
        showDial('Ошибка!','Изменение аватарки не выполнено.<p>'+data+'</p>');
    }
}

function setInfoUser(dataCase, data, name, code){
    var delivery = {'dataCase': dataCase, 'data': data, 'name': name, 'code': code};
    var answer = getPostAjax('text', 'setInfoUser', delivery);
    if(answer != 'true'){
        showDial('Ошибка!','Изменение данных не выполнено.<p>'+answer+'</p>');
        return false;
    }
    return true;
}

function goToPosElementForm(name,height){
    var target_top= $(name).offset().top;
    $('html, body').animate({scrollTop: target_top+height}, 400);
}

///////////////////////////////////////////
///////////////////////////////////////////
// Пока не знаю :)
function previewSetCommit(text){

    if(!text){
        alert('Введите текст!');
    }
    else if(text.length < 4){
        alert('Не менее четырех символов!');
    }
    else{
        var delivery = {'text' : text}; // Создаем массив
        var data = getPostAjax('text', 'QCodeColor', delivery);
        $('#showText').html(data);
    }
}


/*

 window.location.href = '/';
 location.reload();

    setTimeout( function() { object1.func() } , 1);
    var i = 0;

    object1 = {
        func: function() {
            alert('hello 1');
            var data = getPostAjax('text', 'exitUser', delivery);
            if(!data){
                i++;
                setTimeout(
                    function() {
                        object2.func()
                    },
                    10
                );
            } else {
                alert(data);
            }
        }
    };

    object2 = {
        func: function() {
            alert('hello 2');
            var data = getPostAjax('text', 'exitUser', delivery);
            if(!data){
                setTimeout(
                    function() {
                        object1.func()
                    },
                    10
                );
            } else {
                alert(data);
            }
        }
    };
    */