var href = 'http://forum/';


function goGenPassword(){
    $.ajax({
        type: "POST",
        //путь к скрипту
        url: '/php/functionPHP.php',
        data:{'function' : 'genPassword'},
        dataType: "text",
        success: function(data) {
            //в перменной data мы получим ответ от скрипта
            if (data) {   //true
                document.getElementById('randPasswContainer').value = data;
                document.getElementById('krpassvfy_genpassbutton_ok').className="block";
            } else {      //false
                alert ("Внутренния ошибка");
            }
        },
        error:function (xhr, ajaxOptions, thrownError){
            //если ошибка аякса, то выведем ее
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

// Тестируем ник в php
function testNik(nik){

    var iconYes = document.getElementById('iconYesNik');
    var iconNo = document.getElementById('iconNoNik');

    if(!nik){
        iconYes.className="none";
        iconNo.className="none";
    }
    else{
        $.ajax({
            type: "POST",
            //путь к скрипту
            url: '/php/functionPHP.php',
            data: {'function' : 'testNik', 'nik' : nik},
            dataType: "text",
            success: function(data) {
                //в перменной data мы получим ответ от скрипта
                if (data) {   //true
                    if(data == "true"){
                        iconYes.className="none";
                        iconNo.className="block";
                    }
                    else{
                        iconYes.className="block";
                        iconNo.className="none";
                    }
                } else {      //false
                    alert ("Внутренния ошибка");
                }
            },
            error:function (xhr, ajaxOptions, thrownError){
                //если ошибка аякса, то выведем ее
                alert(xhr.status);
                alert(thrownError);
            }
        });
    }
}

// Тестируем email in php
function testEmail(email, emailControl){

    var iconYes = document.getElementById('iconYesEmail');
    var iconNo = document.getElementById('iconNoEmail');

    if(!email || !emailControl){
        iconYes.className="none";
        iconNo.className="none";
    }
    else if(email != emailControl){
        iconYes.className="none";
        iconNo.className="block";
    }
    else {

        $.ajax({
            type: "POST",
            //путь к скрипту
            url: '/php/functionPHP.php',
            data:{'function' : 'testEmail', 'email' : email},
            dataType: "text",
            success: function(data) {
                //в перменной data мы получим ответ от скрипта
                if (data) {   //true
                    if(data == "true"){
                        iconYes.className="none";
                        iconNo.className="block";
                    }
                    else{
                        iconYes.className="block";
                        iconNo.className="none";
                    }
                } else {      //false
                    alert ("Внутренния ошибка");
                }
            },
            error:function (xhr, ajaxOptions, thrownError){
                //если ошибка аякса, то выведем ее
                alert(xhr.status);
                alert(thrownError);
            }
        });
    }
}

function testPassword(password, passwordControl){

    var iconYes = document.getElementById('iconYesPassword');
    var iconNo = document.getElementById('iconNoPassword');

    if(!password || !passwordControl){
        //alert("пусто");
        iconYes.className="none";
        iconNo.className="none";
    }
    else if(password != passwordControl){
        //alert("!=");
        iconYes.className="none";
        iconNo.className="block";
    }
    else if(password.length < 6 || passwordControl.length < 6){
        //alert("<6");
        iconYes.className="none";
        iconNo.className="block";
    }
    else if(password.length >20 || passwordControl.length > 20){
        //alert(">20");
        iconYes.className="none";
        iconNo.className="block";
    }
    else {
        //alert("ajax");
        $.ajax({
            type: "POST",
            //путь к скрипту
            url: '/php/functionPHP.php',
            data:{'function' : 'testPassword','password' :password},
            dataType: "text",
            success: function(data) {
                //в перменной data мы получим ответ от скрипта
                if (data) {   //true
                    if(data == "true"){
                        iconYes.className="block";
                        iconNo.className="none";
                    }
                    else{
                        iconYes.className="none";
                        iconNo.className="block";
                    }
                } else {      //false
                    alert ("Внутренния ошибка");
                }
            },
            error:function (xhr, ajaxOptions, thrownError){
                //если ошибка аякса, то выведем ее
                alert(xhr.status);
                alert(thrownError);
            }
        });
    }
}

// Тестируем поля для регистрации
function testReg(){

    var nik = document.getElementById('username');
    var email = document.getElementById('email');
    var emailControl = document.getElementById('emailControl');
    var password = document.getElementById('password');
    var passwordControl = document.getElementById('passwordControl');
    var captcha = document.getElementById('codeCaptcha');


    if(!nik.value){
        alert("Введите ник!");
        goToPosElementForm('#username', -screen.height/2);
    }
    else if(!email.value){
        alert("Введите email!");
        goToPosElementForm('#email', -screen.height/2);
    }
    else if(!emailControl.value){
        alert("Введите проверочный email!");
        goToPosElementForm('#emailControl', -screen.height/2);
    }
    else if(!password.value){
        alert("Введите пароль!");
        goToPosElementForm('#password', -screen.height/2);
    }
    else if(!passwordControl.value){
        alert("Введите проверочный пароль!");
        goToPosElementForm('#passwordControl', -screen.height/2);
    }
    else if(!captcha.value){
        alert("Введите текст с картинки!");
        goToPosElementForm('#codeCaptcha', -screen.height/2);
    }
    else{
        var iconNoNik = document.getElementById('iconNoNik');
        var iconNoEmail = document.getElementById('iconNoEmail');
        var iconNoPassword = document.getElementById('iconNoPassword');

        if(iconNoNik.className == "block"){
            alert("Вы выбрали не подходящий ник! Измените его.");
            goToPosElementForm('#username', -screen.height/2);
        }
        else if(iconNoEmail.className == "block"){
            alert("Вы выбрали не подходящий email! Измените его.");
            goToPosElementForm('#email', -screen.height/2);
        }
        else if(iconNoPassword.className == "block"){
            alert("Вы выбрали не подходящий пароль! Измените его.");
            goToPosElementForm('#password', -screen.height/2);
        }
        else{
            $.ajax({
                type: "POST",
                //путь к скрипту !!!!!!!!!!!!
                url: '/php/functionPHP.php',
                data:{'function' : 'setUser',
                    'username' : document.getElementById('username').value,
                    'password' : document.getElementById('password').value,
                    'email' : document.getElementById('email').value,
                    'captchaCode' : captcha.value
                },
                dataType: "text",
                success: function(data) {
                    //в перменной data мы получим ответ от скрипта
                    if (data) {   //true
                        if(data == "false"){
                            alert("Код с картинки не верен!");
                            goToPosElementForm('#codeCaptcha', -screen.height/2);
                        }
                        else if(data == "true"){
                            alert("Добро пожаловать!\nДля проверки связи с вами по email вам на него высланна ссылка.\nПерейдите по ссылке для потверждения регистрации в течении часа.\nПосле этого можно входить на форум.");
                            window.location.href = "/";
                        }
                        else{
                            alert(data);
                        }

                    } else {      //false
                        alert ("Внутренния ошибка");
                    }
                },
                error:function (xhr, ajaxOptions, thrownError){
                    //если ошибка аякса, то выведем ее
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        }
    }
}

function goToPosElementForm(name,height){
    var target_top= $(name).offset().top;
    $('html, body').animate({scrollTop: target_top+height}, 400);
    $(name).focus();
}

function setPasswordGen(e_password, e_passwordControl, setPassword){
    e_password.value = setPassword;
    e_passwordControl.value = setPassword;
    testPassword(e_password.value, e_passwordControl.value);
}

function goToPageRegistration(){
    window.location.href = "/registration.php";
}

// Вход на сайт
function actionUser(name, password, goToIndex){

    if(!name.value){
        alert("Введите ник!");
    }
    else if(!password.value){
        alert("Введите пароль!");
    }
    else {
        $.ajax({
            type: "POST",
            //путь к скрипту
            url: '/php/functionPHP.php',
            data:{'function' : 'authorizationUser', 'name' : name.value, 'password' : password.value },
            dataType: "text",
            success: function(data) {
                //в перменной data мы получим ответ от скрипта
                if (data) {   //true
                    if(data == "true"){
                        if(goToIndex){
                            window.location.href = "/";
                        }
                        else{
                            window.location.href = window.location.href;
                        }
                    }
                    else if(data == "false"){
                        alert("Такого пользователя не существует!");
                    }
                    else{
                        alert(data);
                    }
                } else {      //false
                    alert ("Внутренния ошибка");
                }
            },
            error:function (xhr, ajaxOptions, thrownError){
                //если ошибка аякса, то выведем ее
                alert(xhr.status);
                alert(thrownError);
            }
        });
    }
}

// Выход с сайта
function exitUser(){
    $.ajax({
        type: "POST",
        //путь к скрипту
        url: '/php/functionPHP.php',
        data:{'function' : 'exitUser'},
        dataType: "text",
        success: function(data) {
            //в перменной data мы получим ответ от скрипта
            if (data) {   //true
                if(data == "true"){
                    window.location.href = window.location.href;
                }
                else{
                    alert(data);
                }
            } else {      //false
                alert ("Внутренния ошибка");
            }
        },
        error:function (xhr, ajaxOptions, thrownError){
            //если ошибка аякса, то выведем ее
            alert(xhr.status);
            alert(thrownError);
        }
    });
}


// Получение текста приватного сообщения по id
function getTextPrivateMail(img, textMail, name, id, idTake){
    $.ajax({
        type: "POST",
        //путь к скрипту
        url: '/php/functionPHP.php',
        data:{'function' : 'getTextPrivateMail', 'name' : name, 'id' : id, 'idTake' : idTake },
        dataType: "text",
        success: function(data) {
            //в перменной data мы получим ответ от скрипта
            if (data) {   //true
                if(data == "false"){
                    alert('Нарушены права доступа');
                }
                else{
                    textMail.innerHTML = data;

                    if(idTake != 'take')
                        if(img.src == href+'css/forumStyle/images/privateNewMail.png'){
                            img.src = 'css/forumStyle/images/privateMail.png';
                            var amount = document.getElementById('newMailCountFormUserAfterAuthorization').innerHTML;
                            amount--;
                            document.getElementById('newMailCountFormUserAfterAuthorization').innerHTML = amount;
                        }
                }
            } else {      //false
                alert ("Внутренния ошибка");
            }
        },
        error:function (xhr, ajaxOptions, thrownError){
            //если ошибка аякса, то выведем ее
            alert(xhr.status);
            alert(thrownError);
        }
    });
}


function setFriend( userName, friendName){
    $.ajax({
        type: "POST",
        //путь к скрипту
        url: '/php/functionPHP.php',
        data:{'function' : 'setFriend', 'userName' : userName, 'friendName' : friendName},
        dataType: "text",
        success: function(data) {
            //в перменной data мы получим ответ от скрипта
            if (data) {   //true
                if(data == "true"){
                    alert("Добавлен новый кореш " + friendName);
                }
                else{
                    alert(data);
                }

            } else {      //false
                alert ("Внутренния ошибка");
            }
        },
        error:function (xhr, ajaxOptions, thrownError){
            //если ошибка аякса, то выведем ее
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function setDisdain( userName, disdainName){
    $.ajax({
        type: "POST",
        //путь к скрипту
        url: '/php/functionPHP.php',
        data:{'function' : 'setDisdain', 'userName' : userName, 'disdainName' : disdainName},
        dataType: "text",
        success: function(data) {
            //в перменной data мы получим ответ от скрипта
            if (data) {   //true
                if(data == "true"){
                    alert("Пользователь " + disdainName + " в игнор добавлен!");
                }
                else{
                    alert(data);
                }

            } else {      //false
                alert ("Внутренния ошибка");
            }
        },
        error:function (xhr, ajaxOptions, thrownError){
            //если ошибка аякса, то выведем ее
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function delFriend( userName, friendName, div){
    $.ajax({
        type: "POST",
        //путь к скрипту
        url: '/php/functionPHP.php',
        data:{'function' : 'delFriend', 'userName' : userName, 'friendName' : friendName},
        dataType: "text",
        success: function(data) {
            //в перменной data мы получим ответ от скрипта
            if (data) {   //true
                if(data == "true"){
                    alert("Кореш " + friendName + " исключен!");
                    div.innerHTML = "<img width='35px' src='css/forumStyle/images/no.png'/>";
                }
                else{
                    alert(data);
                }

            } else {      //false
                alert ("Внутренния ошибка");
            }
        },
        error:function (xhr, ajaxOptions, thrownError){
            //если ошибка аякса, то выведем ее
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function delDisdain( userName, disdainName, div){
    $.ajax({
        type: "POST",
        //путь к скрипту
        url: '/php/functionPHP.php',
        data:{'function' : 'delDisdain', 'userName' : userName, 'disdainName' : disdainName},
        dataType: "text",
        success: function(data) {
            //в перменной data мы получим ответ от скрипта
            if (data) {   //true
                if(data == "true"){
                    alert("Пользователь " + disdainName + " убран из игнора!");
                    div.innerHTML = "<img width='35px' src='css/forumStyle/images/no.png'/>";
                }
                else{
                    alert(data);
                }

            } else {      //false
                alert ("Внутренния ошибка");
            }
        },
        error:function (xhr, ajaxOptions, thrownError){
            //если ошибка аякса, то выведем ее
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function sendPrivateMail(tempTheme, theme, sender, addressee, mail){

    if(!sender){
        alert("Зарегистрируйтесь!")
    }
    else if(sender == addressee){
        alert('Самому себе письмо?');
        $('#receiveMail').focus();
    }
    else if(!addressee){
        alert('Введите адресата');
        $('#receiveMail').focus();
    }
    else if(!mail){
        alert('Напишите письмо');
        $('#textReceiveMail').focus();
    }
    else if(mail.length < 4){
        alert('Письмо не менее 4 символов');
        $('#textReceiveMail').focus();
    }
    else if(document.getElementById('iconTableNewLetterUserYes').className != 'block'){
        alert('Такого пользователя не существует!');
        $('#receiveMail').focus();
    }
    else{
        $.ajax({
            type: "POST",
            //путь к скрипту
            url: '/php/functionPHP.php',
            data: {'function' : 'setPrivateMail', 'theme': theme, 'sender': sender, 'addressee': addressee, 'mail': mail},
            dataType: "text",
            success: function(data) {
                //в перменной data мы получим ответ от скрипта
                if (data) {   //true
                    if(data == "true"){
                        alert('Письмо '+addressee+' отправленно!');
                        document.getElementById('inputThemeMail').value = tempTheme;
                        document.getElementById('textReceiveMail').value = '';
                    }
                    else{
                        alert(data);
                        document.getElementById('inputThemeMail').value = tempTheme;
                        document.getElementById('textReceiveMail').value = '';
                    }
                } else {      //false
                    alert ("Внутренния ошибка");
                }
            },
            error:function (xhr, ajaxOptions, thrownError){
                //если ошибка аякса, то выведем ее
                alert(xhr.status);
                alert(thrownError);
            }
        });
    }
}

// Тестируем ник в php
function testNikPrivateMail(nik){

    if(!nik){
        document.getElementById('iconTableNewLetterUserYes').className = 'none';
        document.getElementById('iconTableNewLetterUserNo').className = 'none';
    }
    else{
        $.ajax({
            type: "POST",
            //путь к скрипту
            url: '/php/functionPHP.php',
            data: {'function' : 'testNik', 'nik' : nik},
            dataType: "text",
            success: function(data) {
                //в перменной data мы получим ответ от скрипта
                if (data) {   //true
                    if(data != "true"){
                        document.getElementById('iconTableNewLetterUserYes').className = 'none';
                        document.getElementById('iconTableNewLetterUserNo').className = 'block';
                    }
                    else{
                        document.getElementById('iconTableNewLetterUserYes').className = 'block';
                        document.getElementById('iconTableNewLetterUserNo').className = 'none';
                    }
                } else {      //false
                    alert ("Внутренния ошибка");
                }
            },
            error:function (xhr, ajaxOptions, thrownError){
                //если ошибка аякса, то выведем ее
                alert(xhr.status);
                alert(thrownError);
            }
        });
    }
}

function setAvatar(img, name){

    $.ajax({
        type: "POST",
        //путь к скрипту
        url: '/php/functionPHP.php',
        data:{'function' : 'saveSetAvatar', 'img' : img, 'name' : name},
        dataType: "text",
        success: function(data) {
            //в перменной data мы получим ответ от скрипта
            if (data) {   //true
                if(data){
                    document.getElementById('image_list').value = "";
                    document.getElementById('image_list').value = "";
                    document.getElementById('buttonEditorAvatarSaveDownload2').className = 'none';
                    document.getElementById('gfile').value = "";
                    document.getElementById('generalAvatar').src = data;
                    document.getElementById('generalAvatar2').src = data;

                    alert('Аватарка успешно изменена');
                }
            } else {      //false
                alert ("Внутренния ошибка");
            }
        },
        error:function (xhr, ajaxOptions, thrownError){
            //если ошибка аякса, то выведем ее
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function setDataOne(editText, dataInput, id, name){

    //alert("ajax");
    $.ajax({
        type: "POST",
        //путь к скрипту
        url: '/php/functionPHP.php',
        data:{'function' : 'setDataOne', 'data' : dataInput, 'id' : id, 'name' : name},
        dataType: "text",
        success: function(data) {
            //в перменной data мы получим ответ от скрипта
            if (data) {   //true
                if(data == "true"){
                    //alert("Save!");
                    editHtmlSaveOne(name);
                    editText.innerHTML = dataInput;
                }
                else{
                    alert("error");
                    alert(data);
                }
            } else {      //false
                alert ("Внутренния ошибка");
            }
        },
        error:function (xhr, ajaxOptions, thrownError){
            //если ошибка аякса, то выведем ее
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function testPasswordUser(name, password){

    var iconYes = document.getElementById('iconPasswordEditYes1');
    var iconNo = document.getElementById('iconPasswordEditNo1');

    if(!password){
        iconYes.className="none";
        iconNo.className="none";
    }
    else{
        //alert("ajax");
        $.ajax({
            type: "POST",
            //путь к скрипту
            url: '/php/functionPHP.php',
            data:{'function' : 'testPasswordUser', 'name' : name, 'password' :password},
            dataType: "text",
            success: function(data) {
                //в перменной data мы получим ответ от скрипта
                if (data) {   //true
                    if(data == "true"){
                        iconYes.className="block";
                        iconNo.className="none";
                    }
                    else if(data == "false"){
                        iconYes.className="none";
                        iconNo.className="block";
                    }
                    else{
                        alert(data);
                    }
                } else {      //false
                    alert ("Внутренния ошибка");
                }
            },
            error:function (xhr, ajaxOptions, thrownError){
                //если ошибка аякса, то выведем ее
                alert(xhr.status);
                alert(thrownError);
            }
        });
    }
}


function testPasswordUpdate(password, documentYes, documentNo){

    var iconYes = documentYes;
    var iconNo  = documentNo;

    if(!password){
        iconYes.className="none";
        iconNo.className="none";
    }
    else if(password.length < 6){
        iconYes.className="none";
        iconNo.className="block";
    }
    else {
        //alert("ajax");
        $.ajax({
            type: "POST",
            //путь к скрипту
            url: '/php/functionPHP.php',
            data:{'function' : 'testPassword', 'password' :password},
            dataType: "text",
            success: function(data) {
                //в перменной data мы получим ответ от скрипта
                if (data) {   //true
                    if(data == "true"){
                        iconYes.className="block";
                        iconNo.className="none";
                    }
                    else{
                        iconYes.className="none";
                        iconNo.className="block";
                    }
                } else {      //false
                    alert ("Внутренния ошибка");
                }
            },
            error:function (xhr, ajaxOptions, thrownError){
                //если ошибка аякса, то выведем ее
                alert(xhr.status);
                alert(thrownError);
            }
        });
    }
}

function setNewPasswordUser(name, password){

    var dataInput = password;
    var id = 'password';

    var iconYes1 = document.getElementById('iconPasswordEditYes1');
    var iconYes2 = document.getElementById('iconPasswordEditYes2');
    var iconYes3 = document.getElementById('iconPasswordEditYes3');

    if(!document.getElementById('inputEditorPassword1').value){
        alert('Введите пароль пользователя!');
        $('#inputEditorPassword1').focus();
    }
    else if(!document.getElementById('inputEditorPassword2').value){
        alert('Введите новый пароль пользователя!');
        $('#inputEditorPassword2').focus();
    }
    else if(!document.getElementById('inputEditorPassword3').value){
        alert('Введите проверочный пароль пользователя!');
        $('#inputEditorPassword3').focus();
    }
    else{
        if(iconYes1.className != 'block'){
            alert("Пароль пользователя не верен!");
            $('#inputEditorPassword1').focus();
        }
        else if(iconYes2.className != 'block'){
            alert("Пароль не соответсвует правилам!");
            $('#inputEditorPassword2').focus();
        }
        else if(iconYes3.className != 'block'){
            alert("Проверочный пароль не верен!");
            $('#inputEditorPassword3').focus();
        }
        else{
            //alert("ajax");
            $.ajax({
                type: "POST",
                //путь к скрипту
                url: '/php/functionPHP.php',
                data:{'function' : 'setDataOne', 'data' : password, 'id' : id, 'name' : name},
                dataType: "text",
                success: function(data) {
                    //в перменной data мы получим ответ от скрипта
                    if (data) {   //true
                        if(data == "true"){
                            document.getElementById('inputEditorPassword1').value = "";
                            document.getElementById('inputEditorPassword2').value = "";
                            document.getElementById('inputEditorPassword3').value = "";
                            iconYes1.className = "none";
                            iconYes2.className = "none";
                            iconYes3.className = "none";
                            alert("Пароль изменен! Ваш новый пароль: \""+password+"\".");
                        }
                        else{
                            alert("error");
                            alert(data);
                        }
                    } else {      //false
                        alert ("Внутренния ошибка");
                    }
                },
                error:function (xhr, ajaxOptions, thrownError){
                    //если ошибка аякса, то выведем ее
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        }
    }
}

function reconstructionPassword(name){
    //alert("ajax");
    $.ajax({
        type: "POST",
        //путь к скрипту
        url: '/php/functionPHP.php',
        data:{'function' : 'reconstructionPassword', 'name' : name},
        dataType: "text",
        success: function(data) {
            //в перменной data мы получим ответ от скрипта
            if (data) {   //true
                if(data == "true"){
                    alert("Новый пароль выслан вам на почту!");
                }
                else if(data == "false"){
                    alert("Неудалось выслать пароль. Обратитесь к админу.");
                }
                else{
                    alert("error");
                    alert(data);
                }
            } else {      //false
                alert ("Внутренния ошибка");
            }
        },
        error:function (xhr, ajaxOptions, thrownError){
            //если ошибка аякса, то выведем ее
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

// Тестируем email in php
function testEmailEdit(email){

    var iconYes = document.getElementById('iconEmailEditYes1');
    var iconNo = document.getElementById('iconEmailEditNo1');

    if(!email){
        iconYes.className="none";
        iconNo.className="none";
    }
    else {

        $.ajax({
            type: "POST",
            //путь к скрипту
            url: '/php/functionPHP.php',
            data:{'function' : 'testEmail', 'email' : email},
            dataType: "text",
            success: function(data) {
                //в перменной data мы получим ответ от скрипта
                if (data) {   //true
                    if(data == "true"){
                        iconYes.className="none";
                        iconNo.className="block";
                    }
                    else{
                        iconYes.className="block";
                        iconNo.className="none";
                    }
                } else {      //false
                    alert ("Внутренния ошибка");
                }
            },
            error:function (xhr, ajaxOptions, thrownError){
                //если ошибка аякса, то выведем ее
                alert(xhr.status);
                alert(thrownError);
            }
        });
    }
}

function testControlEmailUpdate(email, controlEmail){

    var iconYes = document.getElementById('iconEmailEditYes2');
    var iconNo = document.getElementById('iconEmailEditNo2');

    if(!email || !controlEmail){
        iconYes.className="none";
        iconNo.className="none";
    }
    else if(email == controlEmail){
        iconYes.className="block";
        iconNo.className="none";
    }
    else{
        iconYes.className="none";
        iconNo.className="block";
    }
}

function setNewEmailUser(name, email){

    var id = 'email';

    var iconYes1 = document.getElementById('iconEmailEditYes1');
    var iconYes2 = document.getElementById('iconEmailEditYes2');

    if(!document.getElementById('inputEditorEmail1').value){
        alert('Вы не ввели новый email!');
        $('#inputEditorEmail1').focus();
    }
    else if(!document.getElementById('inputEditorEmail2').value){
        alert('Повторите новый email!');
        $('#inputEditorEmail2').focus();
    }
    else{
        if(iconYes1.className != 'block'){
            alert("Email или существует или введен неправильно!");
            $('#inputEditorEmail1').focus();
        }
        else if(iconYes2.className != 'block'){
            alert("Неправильно введен проверочный email");
            $('#inputEditorEmail2').focus();
        }
        else{
            //alert("ajax");
            $.ajax({
                type: "POST",
                //путь к скрипту
                url: '/php/functionPHP.php',
                data:{'function' : 'setDataOne', 'data' : email, 'id' : id, 'name' : name},
                dataType: "text",
                success: function(data) {
                    //в перменной data мы получим ответ от скрипта
                    if (data) {   //true
                        if(data == "true"){
                            document.getElementById('inputEditorEmail1').value = "";
                            document.getElementById('inputEditorEmail2').value = "";
                            iconYes1.className = "none";
                            iconYes2.className = "none";
                            document.getElementById('emailUserShow').innerHTML = email;
                            alert("Для проверки нового Email вам выслана ссылка на него.\nЕсли в течении часа вы его не подтвердите выернется старый на место.");
                        }
                        else{
                            alert("error");
                            alert(data);
                        }
                    } else {      //false
                        alert ("Внутренния ошибка");
                    }
                },
                error:function (xhr, ajaxOptions, thrownError){
                    //если ошибка аякса, то выведем ее
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        }
    }
}

function editHtmlSaveOne(name){
    document.getElementById('infoUserEdit').innerHTML = 'Данные '+name+' изменены!';
    setTimeout(function() { editHtmlSaveTwo(name); }, 2500);
}

function editHtmlSaveTwo(name){
    document.getElementById('infoUserEdit').innerHTML = '';
}

function setDataAll(name){
    setDataOne(document.getElementById('realName'), document.getElementById('inputEditorUser1').value, 'realName', name);
    setDataOne(document.getElementById('specialization'), document.getElementById('inputEditorUser2').value, 'specialization', name);
    setDataOne(document.getElementById('computerConfiguration'), document.getElementById('inputEditorUser3').value, 'computerConfiguration', name);
    setDataOne(document.getElementById('location'), document.getElementById('inputEditorUser4').value, 'location', name);
    setDataOne(document.getElementById('interests'), document.getElementById('inputEditorUser5').value, 'interests', name);
    setDataOne(document.getElementById('occupation'), document.getElementById('inputEditorUser6').value, 'occupation', name);
    setDataOne(document.getElementById('recordOfService'), document.getElementById('inputEditorUser7').value, 'recordOfService', name);
    setDataOne(document.getElementById('signature'), document.getElementById('inputEditorUser8').value, 'signature', name);
}

$(function() {

});

function shwoDialogReconstructionPassword(name){

    $('#dialog-message').dialog({
        resizable:false,
        modal:true,
        position: 'top',
        buttons:{
            'Выполнить': function(){
                $(this).dialog( 'close' );
                reconstructionPassword(name);
            },
            'Отменить' : function(){
                $(this).dialog( 'close' );
            }
        }
    });

}

function testControlPasswordUpdate(password, controlPassword){

    var iconYes = document.getElementById('iconPasswordEditYes3');
    var iconNo = document.getElementById('iconPasswordEditNo3');

    if(!password || !controlPassword){
        iconYes.className="none";
        iconNo.className="none";
    }
    else if(password == controlPassword){
        iconYes.className="block";
        iconNo.className="none";
    }
    else{
        iconYes.className="none";
        iconNo.className="block";
    }
}


$(function() {

    $( '#buttonPrivateLetterSend' ).button();

    $( "#buttonEditorAvatarDownload1" ).button();
    $( "#buttonEditorAvatarSaveDownload1" ).button();

    $( "#buttonEditorPassword" ).button();
    $( "#buttonEditorEmail").button();
    $( "#buttonPasswordToEmail").button();

/*
 */
    $( "#accordionOne" ).accordion({autoHeight:false, collapsible:true, active: 10});
    $( "#accordionTwo" ).accordion({autoHeight:false, collapsible:true, active: 10});
    $( "#accordionThree" ).accordion({autoHeight:false, collapsible:true, active: 10});
    $( "#accordionFour" ).accordion({autoHeight:false, collapsible:true, active: 10});



    //////////////////////////////////////////

    var sizeDocElement = 18;
    var i = 0;

    // tableStaticUser.php
    if(document.getElementById('buttonStaticUser1')){
        for(i = 0; i<10; i++)
            if(document.getElementById("buttonStaticUser"+i))
                $("#buttonStaticUser"+i).button();
    }

    var $tabs = $( "#tabs" ).tabs({
        fx: {opacity:'toggle', duration:'fast' },
        collapsible: true
    });


    $tabs.select(function(){
        for(i = 6; i<sizeDocElement; i++){
            if(document.getElementById('tabs-'+i))
                document.getElementById('tabs-'+i).className = 'none';
        }
        if(document.getElementById('tableTabs'))
            document.getElementById('tableTabs').className = 'none';
    });


    if(document.getElementById('accordionMenu1')){
        $( "#accordionMenu1" ).accordion({autoHeight:false, collapsible:true, active: 0});
        $( "#accordionMenu2" ).accordion({autoHeight:false, collapsible:true, active: 10});
        $( "#accordionMenu3" ).accordion({autoHeight:false, collapsible:true, active: 10});
        $( "#accordionMenu4" ).accordion({autoHeight:false, collapsible:true, active: 10});
        $( "#accordionMenu5" ).accordion({autoHeight:false, collapsible:true, active: 10});
    }

    for(i = 1; i<10; i++){
        if(document.getElementById('buttonEditorUser'+i))
            $("#buttonEditorUser"+i).button();
    }

    if(document.getElementById('button13') || document.getElementById('button15')){

        $( "#accordionMenu6" ).accordion({autoHeight:false, collapsible:true, active: 10});

        sizeDocElement += 2;

        $( "#button13" )
            .button()
            .click(function(){
                if($tabs.tabs('option','selected') != -1){
                    $tabs.tabs('select', $tabs.tabs('option','selected'));
                }

                for(var i = 6; i<sizeDocElement; i++){
                    if(i != 18)
                        if(document.getElementById('tabs-'+i))
                            document.getElementById('tabs-'+i).className = 'none';
                }

                document.getElementById('tabs-18').className = 'divPrivateOffice';
                document.getElementById('tableTabs').className = 'block';
                goToPosElementForm('#href',0);
            });

        $( "#button14" )
            .button()
            .click(function(){
                if($tabs.tabs('option','selected') != -1){
                    $tabs.tabs('select', $tabs.tabs('option','selected'));
                }

                for(var i = 6; i<sizeDocElement; i++){
                    if(i != 19)
                        if(document.getElementById('tabs-'+i))
                            document.getElementById('tabs-'+i).className = 'none';
                }

                document.getElementById('tableTabs').className = 'block';
                document.getElementById('tabs-19').className = 'divPrivateOffice';
                goToPosElementForm('#href',0);
            });
    }

    if(document.getElementById('button15')){

        $( "#accordionMenu7" ).accordion({autoHeight:false, collapsible:true, active: 10});

        sizeDocElement += 2;

        $( "#button15" )
            .button()
            .click(function(){
                if($tabs.tabs('option','selected') != -1){
                    $tabs.tabs('select', $tabs.tabs('option','selected'));
                }

                for(var i = 6; i<sizeDocElement; i++){
                    if(i != 20)
                        if(document.getElementById('tabs-'+i))
                            document.getElementById('tabs-'+i).className = 'none';
                }

                document.getElementById('tableTabs').className = 'block';
                document.getElementById('tabs-20').className = 'divPrivateOffice';
                goToPosElementForm('#href',0);
            });

        $( "#button16" )
            .button()
            .click(function(){
                if($tabs.tabs('option','selected') != -1){
                    $tabs.tabs('select', $tabs.tabs('option','selected'));
                }

                for(var i = 6; i<sizeDocElement; i++){
                    if(i != 21)
                        if(document.getElementById('tabs-'+i))
                            document.getElementById('tabs-'+i).className = 'none';
                }

                document.getElementById('tableTabs').className = 'block';
                document.getElementById('tabs-21').className = 'divPrivateOffice';
                goToPosElementForm('#href',0);
            });
    }

    if(document.getElementById('button1')){
        $( "#button1" )
            .button()
            .click(function(){
                if($tabs.tabs('option','selected') != -1){
                    $tabs.tabs('select', $tabs.tabs('option','selected'));
                }

                for(var i = 6; i<sizeDocElement; i++){
                    if(i != 6)
                        if(document.getElementById('tabs-'+i))
                            document.getElementById('tabs-'+i).className = 'none';
                }

                document.getElementById('tabs-6').className = 'divPrivateOffice';
                document.getElementById('tableTabs').className = 'block';
                goToPosElementForm('#href',0);
            });

        $( "#button2" )
            .button()
            .click(function(){
                if($tabs.tabs('option','selected') != -1){
                    $tabs.tabs('select', $tabs.tabs('option','selected'));
                }

                for(var i = 6; i<sizeDocElement; i++){
                    if(i != 7)
                        if(document.getElementById('tabs-'+i))
                            document.getElementById('tabs-'+i).className = 'none';
                }

                document.getElementById('tableTabs').className = 'block';
                document.getElementById('tabs-7').className = 'divPrivateOffice';
                goToPosElementForm('#href',0);
            });

        $( "#button3" )
            .button()
            .click(function(){
                if($tabs.tabs('option','selected') != -1){
                    $tabs.tabs('select', $tabs.tabs('option','selected'));
                }

                for(var i = 6; i<sizeDocElement; i++){
                    if(i != 8)
                        if(document.getElementById('tabs-'+i))
                            document.getElementById('tabs-'+i).className = 'none';
                }

                document.getElementById('tableTabs').className = 'block';
                document.getElementById('tabs-8').className = 'divPrivateOffice';
                goToPosElementForm('#href',0);
            });

        $( "#button4" )
            .button()
            .click(function(){
                if($tabs.tabs('option','selected') != -1){
                    $tabs.tabs('select', $tabs.tabs('option','selected'));
                }

                for(var i = 6; i<sizeDocElement; i++){
                    if(i != 9)
                        if(document.getElementById('tabs-'+i))
                            document.getElementById('tabs-'+i).className = 'none';
                }

                document.getElementById('tableTabs').className = 'block';
                document.getElementById('tabs-9').className = 'divPrivateOffice';
                goToPosElementForm('#href',0);
            });

        $( "#button5" )
            .button()
            .click(function(){
                if($tabs.tabs('option','selected') != -1){
                    $tabs.tabs('select', $tabs.tabs('option','selected'));
                }

                for(var i = 6; i<sizeDocElement; i++){
                    if(i != 10)
                        if(document.getElementById('tabs-'+i))
                            document.getElementById('tabs-'+i).className = 'none';
                }

                document.getElementById('tableTabs').className = 'block';
                document.getElementById('tabs-10').className = 'divPrivateOffice';
                goToPosElementForm('#href',0);
            });

        $( "#button6" )
            .button()
            .click(function(){
                if($tabs.tabs('option','selected') != -1){
                    $tabs.tabs('select', $tabs.tabs('option','selected'));
                }

                for(var i = 6; i<sizeDocElement; i++){
                    if(i != 11)
                        if(document.getElementById('tabs-'+i))
                            document.getElementById('tabs-'+i).className = 'none';
                }

                document.getElementById('tableTabs').className = 'block';
                document.getElementById('tabs-11').className = 'divPrivateOffice';
                goToPosElementForm('#href',0);
            });

        $( "#button7" )
            .button()
            .click(function(){
                if($tabs.tabs('option','selected') != -1){
                    $tabs.tabs('select', $tabs.tabs('option','selected'));
                }

                for(var i = 6; i<sizeDocElement; i++){
                    if(i != 12)
                        if(document.getElementById('tabs-'+i))
                            document.getElementById('tabs-'+i).className = 'none';
                }

                document.getElementById('tableTabs').className = 'block';
                document.getElementById('tabs-12').className = 'divPrivateOffice';
                goToPosElementForm('#href',0);
            });

        $( "#button8" )
            .button()
            .click(function(){

                if($tabs.tabs('option','selected') != 2){
                    $tabs.tabs('select', 2);
                }

                goToPosElementForm('#href',0);
            });

        $( "#button9" )
            .button()
            .click(function(){
                if($tabs.tabs('option','selected') != -1){
                    $tabs.tabs('select', $tabs.tabs('option','selected'));
                }

                for(var i = 6; i<sizeDocElement; i++){
                    if(i != 14)
                        if(document.getElementById('tabs-'+i))
                            document.getElementById('tabs-'+i).className = 'none';
                }

                document.getElementById('tableTabs').className = 'block';
                document.getElementById('tabs-14').className = 'divPrivateOffice';
                goToPosElementForm('#href',0);
            });

        $( "#button10" )
            .button()
            .click(function(){
                if($tabs.tabs('option','selected') != -1){
                    $tabs.tabs('select', $tabs.tabs('option','selected'));
                }

                for(var i = 6; i<sizeDocElement; i++){
                    if(i != 15)
                        if(document.getElementById('tabs-'+i))
                            document.getElementById('tabs-'+i).className = 'none';
                }

                document.getElementById('tableTabs').className = 'block';
                document.getElementById('tabs-15').className = 'divPrivateOffice';
                goToPosElementForm('#href',0);
            });

        $( "#button11" )
            .button()
            .click(function(){
                if($tabs.tabs('option','selected') != -1){
                    $tabs.tabs('select', $tabs.tabs('option','selected'));
                }

                for(var i = 6; i<sizeDocElement; i++){
                    if(i != 16)
                        if(document.getElementById('tabs-'+i))
                            document.getElementById('tabs-'+i).className = 'none';
                }

                document.getElementById('tableTabs').className = 'block';
                document.getElementById('tabs-16').className = 'divPrivateOffice';
                goToPosElementForm('#href',0);
            });

        $( "#button12" )
            .button()
            .click(function(){
                if($tabs.tabs('option','selected') != -1){
                    $tabs.tabs('select', $tabs.tabs('option','selected'));
                }

                for(var i = 6; i<sizeDocElement; i++){
                    if(i != 17)
                        if(document.getElementById('tabs-'+i))
                            document.getElementById('tabs-'+i).className = 'none';
                }

                document.getElementById('tableTabs').className = 'block';
                document.getElementById('tabs-17').className = 'divPrivateOffice';
                goToPosElementForm('#href',0);
            });
    }

    // Link to open the dialog
    $( "#dialog-link" ).click(function( event ) {
        $( "#dialog" ).dialog( "open" );
        event.preventDefault();
    });

    // Hover states on the static widgets
    $( "#dialog-link, #icons li" ).hover(
        function() {
            $( this ).addClass( "ui-state-hover" );
        },
        function() {
            $( this ).removeClass( "ui-state-hover" );
        }
    );
});

