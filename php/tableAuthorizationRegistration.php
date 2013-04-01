<?php

// Создание кнопок
$buttonGoToRegistration = new \Qp\QPush('Регистрация','100%','22px','11px');
$buttonEntry = new \Qp\QPush('Вход','100%','22px','11px');

// Установки нажатия
$buttonGoToRegistration->setOnClick("window.location.href = 'registration.php';");
$buttonEntry->setOnClick("
    // JS вход пользователя
    entryUser(
        document.getElementById('entryUserNameRegistration').value ,
        document.getElementById('entryUserPasswordRegistration').value
        );
");

echo "
<table width='100%'>
    <tr>
        <td colspan='2'>";
echo $buttonGoToRegistration->show();
echo "  <div style='height: 5px;'></div>
        </td>
    </tr>
    <tr>
        <td>
        Ник:
        </td>
        <td>
        <input id='entryUserNameRegistration' type='text' style='width: 100%;'>
        </td>
    </tr>
    <tr>
        <td>
        Пароль:
        </td>
        <td>
        <input id='entryUserPasswordRegistration' type='password' style='width: 100%;'>
        </td>
    </tr>
    <tr>
        <td colspan='2'>
        <div style='height: 5px;'></div>";
echo $buttonEntry->show();
echo " </td>
    </tr>
</table>
";