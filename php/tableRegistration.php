<?php
$genPassword = "";

echo "

<form name='regForm'>
    <table cellpadding='5' cellspacing='1' width='100%' align='center'>
        <tr>
            <td align='center'>
                <div style='width:850px' align='left'>
                    <div style='margin-bottom:3px'>
                        <div style='height: 15px; margin: 2px 0 2px 0;'></div>
                        Чтобы оставлять на форуме программистов сообщения, необходимо сначала зарегистрироваться.
                        Пожалуйста, укажите ваше имя пользователя, адрес электронной почты и прочую обязательную информацию о себе в форме ниже.
                        <br><br><b>Регистрация ников, содержащих в себе символы из разных раскладок клавиатуры, например русской и английской, запрещена.</b>
                    </div>
                    <div style='margin-bottom:3px'>
                        <div style='height: 5px; margin: 2px 0 2px 0;'></div>
                        <strong id='href1'>Имя</strong>:<br>
                        <input type='text' id='username' onchange='testNik(this.value);' size='21' maxlength='20' />
                        <img id='iconYesNik' class='none' width='20px' src='css/forumStyle/images/yes.png'>
                        <img id='iconNoNik' class='none' width='20px' src='css/forumStyle/images/no.png'>
                        <div style='height: 5px; margin: 2px 0 2px 0;'></div>
                    </div>

                    <fieldset>
                        <legend>Пароль</legend>
                        <table cellpadding='0' cellspacing='3' border='0' width='400' bordter=1>
                            <tr>
                                <td colspan='2'>
                                Введите свой пароль. Пароль чувствителен к регистру букв.
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Пароль:<br>
                                    <input type='password' name='password' id='password' size='21' maxlength='20' onchange=\"testPassword(this.value, document.getElementById('passwordControl').value);\"/>
                                </td>
                                <td>
                                    Подтвердите пароль:<br>
                                    <input type='password' id='passwordControl' size='21' maxlength='20' onchange=\"testPassword(document.getElementById('password').value, this.value);\"/>
                                </td>
                                <td>
                                    <img id='iconYesPassword' class='none' width='20px' src='css/forumStyle/images/yes.png'>
                                    <img id='iconNoPassword' class='none' width='20px' src='css/forumStyle/images/no.png'>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='2'>
                                    <div style='height: 5px; margin: 2px 0 2px 0;'></div>
                                    <div>Требования к паролю:</div>
                                    <div id='passwdMinLen' style='margin: 1px;'>Длина пароля не менее 6 символов</div>

                                    <fieldset>
                                        <legend>
                                            <input type='button' id='krpassvfy_genpassbutton' value='Сгенерировать пароль' onclick='goGenPassword();' />
                                        </legend>
                                        <input type='text' id='randPasswContainer' size='10' maxlength='10' value='$genPassword' autocomplete='off' />
                                        <input class='none' type='button' id='krpassvfy_genpassbutton_ok' value='Использовать' onclick=\"setPasswordGen(document.getElementById('password'),
                                                                                                                                                        document.getElementById('passwordControl'),
                                                                                                                                                        document.getElementById('randPasswContainer').value);\" />
                                    </fieldset>
                                </td>
                            </tr>
                        </table>

                        </fieldset>
                            <fieldset>
                                    <legend>Адрес электронной почты</legend>

                                    <table cellpadding='0' cellspacing='3' border='0' width='400'>
                                        <tr>
                                            <td colspan='2'>
                                                Введите правильный адрес электронной почты.
                                            </td>
                                        </tr>
                            <tr>
                                <td>
                                    Адрес электронной почты:<br>
                                    <input type='text' id='email' size='25' maxlength='20' onchange=\"testEmail(document.getElementById('email').value, document.getElementById('emailControl').value);\" />
                                </td>
                                <td>
                                    &nbsp;Подтвердите адрес:<br>
                                    <input type='text' id='emailControl' size='25' maxlength='20' onchange=\"testEmail(document.getElementById('email').value, document.getElementById('emailControl').value);\" '/>
                                </td>
                                <td>
                                    <img id='iconYesEmail' class='none' width='20px' src='css/forumStyle/images/yes.png'>
                                    <div id='iconWarningEmail' class='none'> <img width='20px' src='css/forumStyle/images/warning.png'>&nbsp;Такой&nbsp;email&nbsp;уже&nbsp;зарегистрированн&nbsp;на&nbsp;сайте!</div>
                                    <img id='iconNoEmail' class='none' width='20px' src='css/forumStyle/images/no.png'>
                                </td>
                            </tr>
                        </table>
                    </fieldset>

                    <fieldset>
                        <legend>Проверочный вопрос</legend>
                                Учтите: регистр имеет значение.
                        <table cellpadding='0' cellspacing='3'  border='0' width='100%'>
                            <tr>
                                <td>
                                    <fieldset>
                                        <legend>
                                            <input type='button' id='captcha' value='Обновить каринку' onclick=\"document.getElementById('codeCaptcha').value = ''; document.getElementById('captchaImg').src='php/MyLib/QCaptcha/classQCaptcha.php?'+Math.random(); return false; \" />
                                        </legend>
                                        <p><a href='#' onclick=\"document.getElementById('captchaImg').src='php/Qp/QCaptcha/classQCaptcha.php?'+Math.random(); return false;\"><img id='captchaImg' src='php/Qp/QCaptcha/classQCaptcha.php'></a></p>
                                        <p><input type='text' id='codeCaptcha' size='8' maxlength='8'></p>
                                    </fieldset>
                                    <!-- В code/my_codegen.php генерируется код и рисуется изображение -->
                                 </td>
                            </tr>
                        </table>
                    </fieldset>
                </div>
            </td>
         </tr>
         <tr>
            <td align='center'>
                <input type='button' value='            Регистрация            ' onclick='testReg();'>
            </td>
         </tr>
    </table>
</form>
";