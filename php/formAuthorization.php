<?php

$actionReg = "registration.php";

echo "
<table width='100%'>
    <tr>
        <td colspan='2'>
            <input type='button' value='Регистрация' style='width: 100%;' onclick=\"goToPageRegistration();\">
        </td>
    </tr>
    <tr>
        <td>
        Ник:
        </td>
        <td>
        <input id='nameAction' type='text' style='width: 100%;'>
        </td>
    </tr>
    <tr>
        <td>
        Пароль:
        </td>
        <td>
        <input id='passwordAction' type='password' style='width: 100%;'>
        </td>
    </tr>
    <tr>
        <td colspan='2'>
        <input type='button' value='Войти' style='width: 100%;' onclick=\"actionUser(document.getElementById('nameAction'), document.getElementById('passwordAction'), '');\">
        </td>
    </tr>
</table>
";