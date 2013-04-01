<?php

// Создание кнопок
$buttonRegistration = new \Qp\QPush('Регистрация','200px','32px','14px');

$buttonGenPassword = new \Qp\QPush('Сгенирировать пароль', '200px', '22px', '11px');

$buttonSetGenPassword = new \Qp\QPush('Использовать пароль', '170px', '22px', '11px', 'none');
$buttonSetGenPassword->setId('setGenPassword');

$buttonReloadCaptcha = new \Qp\QPush('Обновить картинку', '200px', '22px', '11px');

// Установки нажатия
$buttonReloadCaptcha->setOnClick("document.getElementById('captchaImg').src='php/Qp/QCaptcha/classQCaptcha.php?'+Math.random(); return false;");

$buttonGenPassword->setOnClick("getGenPassword();");

$buttonSetGenPassword->setOnClick("
var code = document.getElementById('QPush_setGenPassword').value;
document.getElementById('password').value = code;
document.getElementById('passwordControl').value = code;
document.getElementById('iconYesPassword').className = 'block';
document.getElementById('iconNoPassword').className = 'none';
");

$buttonRegistration->setOnClick("userRegistration();");

// Вывод таблицы
echo "
<table>
    <tr>
        <td style='width: 20%;'></td>
        <td style='border: 2px solid #666666; border-radius: 10px;'>
            <div style='width:850px; margin: 20px 20px 20px 20px;'>
                <div>
                    Чтобы оставлять на форуме программистов сообщения, необходимо сначала зарегистрироваться.
                    Пожалуйста, укажите ваше имя пользователя, адрес электронной почты и прочую обязательную информацию о себе в форме ниже.
                 </div>
                 <br>
                <div>
                    <b>Регистрация ников содержащих в себе, пробелы, различного рода символы (исключая _ ), символы из разных раскладок клавиатуры, например русской и английской, запрещена.</b>
                </div>

                <div>
                    <div style='height: 5px; margin: 2px 0 2px 0;'></div>
                    <strong id='href1'>Имя</strong>:<br>
                    <!-- ################## -->
                    <input type='text' id='username' onchange=\"
                    if(this.value){
                        if(testData('name',this.value) && testPassword(this.value)){
                            document.getElementById('iconYesNik').className = 'block';
                            document.getElementById('iconNoNik').className = 'none';
                        }
                        else{
                            document.getElementById('iconYesNik').className = 'none';
                            document.getElementById('iconNoNik').className = 'block';
                        }
                    } else {
                            document.getElementById('iconYesNik').className = 'none';
                            document.getElementById('iconNoNik').className = 'none';
                    }
                    \" size='21' maxlength='20' />
                    <!-- ################## -->
                    <img id='iconYesNik' class='none' width='20px' src='css/images/yes.png'>
                    <img id='iconNoNik' class='none' width='20px' src='css/images/no.png'>
                    <div style='height: 5px; margin: 2px 0 2px 0;'></div>
                </div>
                <!-- ################## -->
                <fieldset>
                    <legend>Пароль</legend>
                    <table cellpadding='0' cellspacing='3' width='100%'>
                        <tr>
                            <td colspan='3'>
                            Требования к паролю:<br>
                            Пароль чувствителен к регистру букв. Длина пароля не менее 6 символов.
                            </td>
                        </tr>
                        <tr>
                            <td style='width: 200px;'>
                                Пароль:<br>
                                <!-- ################## -->
                                <input style='width: 200px;' type='password' id='password' maxlength='20' onchange=\"
                                    if(this.value&&document.getElementById('passwordControl').value){
                                        if( this.value == document.getElementById('passwordControl').value){
                                            if(testPassword(this.value) && this.value.length >= 6){
                                                document.getElementById('iconYesPassword').className = 'block';
                                                document.getElementById('iconNoPassword').className = 'none';
                                            }
                                            else{
                                                document.getElementById('iconYesPassword').className = 'none';
                                                document.getElementById('iconNoPassword').className = 'block';
                                            }
                                        } else {
                                            document.getElementById('iconYesPassword').className = 'none';
                                            document.getElementById('iconNoPassword').className = 'block';
                                        }
                                    } else {
                                        document.getElementById('iconYesPassword').className = 'none';
                                        document.getElementById('iconNoPassword').className = 'none';
                                    }
                                \"/>
                                <!-- ################## -->
                            </td>
                            <td style='width: 200px;'>
                                Подтвердите пароль:<br>
                                <!-- ################## -->
                                <input style='width: 200px;' type='password' id='passwordControl' maxlength='20' onchange=\"
                                    if(this.value&&document.getElementById('password').value){
                                        if( this.value == document.getElementById('password').value){
                                            if(testPassword(this.value) && this.value.length >= 6){
                                                document.getElementById('iconYesPassword').className = 'block';
                                                document.getElementById('iconNoPassword').className = 'none';
                                            }
                                            else{
                                                document.getElementById('iconYesPassword').className = 'none';
                                                document.getElementById('iconNoPassword').className = 'block';
                                            }
                                        } else {
                                            document.getElementById('iconYesPassword').className = 'none';
                                            document.getElementById('iconNoPassword').className = 'block';
                                        }
                                    } else {
                                        document.getElementById('iconYesPassword').className = 'none';
                                        document.getElementById('iconNoPassword').className = 'none';
                                    }
                                \"/>
                                <!-- ################## -->
                            </td>
                            <td>
                                <img id='iconYesPassword' class='none' width='20px' src='css/images/yes.png'>
                                <img id='iconNoPassword' class='none' width='20px' src='css/images/no.png'>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='3'>
                                <div style='height: 5px; margin: 2px 0 2px 0;'></div>
                                <fieldset>
                                    <legend>";
                                        echo $buttonGenPassword->show();
echo "                                  </legend>
                                    <input style='width: 200px;' type='text' id='randPasswordContainer' maxlength='20' /> &nbsp;&nbsp;&nbsp;";
                                    echo $buttonSetGenPassword->show();
echo "                           </fieldset>
                            </td>
                        </tr>
                    </table>
                </fieldset>
                <!-- ################## -->
                <fieldset>
                        <legend>Адрес электронной почты</legend>

                        <table style='width: 100%;' cellpadding='0' cellspacing='3'>
                            <tr>
                                <td colspan='3'>
                                    Введите правильный адрес электронной почты.
                                </td>
                            </tr>
                            <tr>
                                <td style='width: 300px;'>
                                    Адрес электронной почты:<br>
                                    <!-- ################## -->
                                    <input style='width: 300px;' type='text' id='email' maxlength='40' onchange=\"
                                    if(this.value&&document.getElementById('emailControl').value){
                                        if( this.value == document.getElementById('emailControl').value){
                                            if(testEmail(this.value) && testData('email',this.value)){
                                                document.getElementById('iconYesEmail').className = 'block';
                                                document.getElementById('iconNoEmail').className = 'none';
                                            }
                                            else{
                                                document.getElementById('iconYesEmail').className = 'none';
                                                document.getElementById('iconNoEmail').className = 'block';
                                            }
                                        } else {
                                            document.getElementById('iconYesEmail').className = 'none';
                                            document.getElementById('iconNoEmail').className = 'block';
                                        }
                                    } else {
                                        document.getElementById('iconYesEmail').className = 'none';
                                        document.getElementById('iconNoEmail').className = 'none';
                                    }
                                    \"/>
                                    <!-- ################## -->
                                </td>
                                <td style='width: 300px;'>
                                    Подтвердите адрес:<br>
                                    <!-- ################## -->
                                    <input style='width: 300px;' type='text' id='emailControl' maxlength='40' onchange=\"
                                    if(this.value&&document.getElementById('email').value){
                                        if( this.value == document.getElementById('email').value){
                                            if(testEmail(this.value) && testData('email',this.value)){
                                                document.getElementById('iconYesEmail').className = 'block';
                                                document.getElementById('iconNoEmail').className = 'none';
                                            }
                                            else{
                                                document.getElementById('iconYesEmail').className = 'none';
                                                document.getElementById('iconNoEmail').className = 'block';
                                            }
                                        } else {
                                            document.getElementById('iconYesEmail').className = 'none';
                                            document.getElementById('iconNoEmail').className = 'block';
                                        }
                                    } else {
                                        document.getElementById('iconYesEmail').className = 'none';
                                        document.getElementById('iconNoEmail').className = 'none';
                                    }
                                    \"/>
                                    <!-- ################## -->
                                </td>
                                <td>
                                    <img id='iconYesEmail' class='none' width='20px' src='css/images/yes.png'>
                                    <img id='iconNoEmail' class='none' width='20px' src='css/images/no.png'>
                                </td>
                            </tr>
                        </table>
                </fieldset>
                <!-- ################## -->
                <fieldset>
                    <legend>Проверочный вопрос</legend>
                            Учтите: регистр имеет значение.
                    <table cellpadding='0' cellspacing='3' width='100%'>
                        <tr>
                            <td>
                                <fieldset>
                                    <legend>";
                                        echo $buttonReloadCaptcha->show();
echo "                                  </legend>
                                    <p><a href='#' onclick=\"document.getElementById('captchaImg').src='php/Qp/QCaptcha/classQCaptcha.php?'+Math.random(); return false;\"><img id='captchaImg' src='php/Qp/QCaptcha/classQCaptcha.php'></a></p>
                                    <p><input style='width: 150px;' type='text' id='codeCaptcha' maxlength='8'></p>
                                </fieldset>
                             </td>
                        </tr>
                    </table>
                </fieldset>
                <!-- ################## -->
            </div>
        </td>
        <td style='width: 20%;'></td>
     </tr>
     <tr>
        <td colspan='3' style='text-align: center;'>
            <br>";
            echo $buttonRegistration->show();
echo "      </td>
     </tr>
</table>
";