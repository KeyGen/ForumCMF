<?php

$actionReg = "registration.php";

echo "
<hr>
<table width='100%'>
    <tr>
        <td>
        Ник:
        </td>
        <td>
        <input id='nameActionPage' type='text' style='width: 100%;'>
        </td>
    </tr>
    <tr>
        <td>
        Пароль:
        </td>
        <td>
        <input id='passwordActionPage' type='password' style='width: 100%;'>
        </td>
    </tr>
    <tr>
        <td colspan='2'>
        <br>
        <center>
        <input type='button' value='Войти' style='width: 80%;' onclick=\"actionUser(document.getElementById('nameActionPage'), document.getElementById('passwordActionPage'),'goToIndex');\">
        </center>
        </td>
    </tr>
</table>
<hr>
";