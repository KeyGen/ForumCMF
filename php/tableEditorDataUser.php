<?php

$realName = getUserUniversal($name,'realName');
$specialization = getUserUniversal($name,'specialization');
$computerConfiguration = getUserUniversal($name,'computerConfiguration');
$location = getUserUniversal($name,'location');
$interests = getUserUniversal($name,'interests');
$occupation = getUserUniversal($name,'occupation');
$recordOfService = getUserUniversal($name,'recordOfService');
$signature = getUserUniversal($name,'signature');

echo "
<center>
<table style='width: 100%;'>
    <tr><td style='height: 14px;'></td></tr>
    <tr>
        <td style='height: 30px; color: #ffffff; text-align: center; font-weight: bold; border-radius: 6px;' class='borderColor' colspan='3'>
            Редактирование данных $name
        </td>
    </tr>
    <tr><td style='height: 5px;'></td></tr>
    <tr>
        <td style='width: 250px;'>
            Реальное имя
        </td>
        <td>
            <input id='inputEditorUser1' style='height: 30px; width: 100%;' maxlength='40' type='text' value='$realName'/>
        </td>
        <td style='width: 150px;'>
            <button type='button' id='buttonEditorUser1' style='height: 30px; width: 100%; font-size: 14px; text-align: center;'
            onclick=\"setDataOne(document.getElementById('realName'), document.getElementById('inputEditorUser1').value, 'realName', '$name');\">Сохранить</button>
        </td>
    </tr>
    <tr>
        <td>
        Специализация
        </td>
        <td>
        <input id='inputEditorUser2' style='height: 30px; width: 100%;' maxlength='100' type='text' value='$specialization'/>
        </td>
        <td>
            <button id='buttonEditorUser2' style='height: 30px; width: 100%; font-size: 14px; text-align: center;'
            onclick=\"setDataOne(document.getElementById('specialization'), document.getElementById('inputEditorUser2').value, 'specialization', '$name');\">Сохранить</button>
        </td>
    </tr>
    <tr>
        <td>
             Конфигурация компьютера
        </td>
        <td>
        <input id='inputEditorUser3' style='height: 30px; width: 100%;' maxlength='100' type='text' value='$computerConfiguration'/>
        </td>
        <td>
            <button id='buttonEditorUser3' style='height: 30px; width: 100%; font-size: 14px; text-align: center;'
            onclick=\"setDataOne(document.getElementById('computerConfiguration'), document.getElementById('inputEditorUser3').value, 'computerConfiguration', '$name');\">Сохранить</button>
        </td>
    </tr>
    <tr>
        <td>
            Местоположение
        </td>
        <td>
        <input id='inputEditorUser4' style='height: 30px; width: 100%;' maxlength='40' type='text' value='$location'/>
        </td>
        <td style='width: 150px;'>
            <button id='buttonEditorUser4' style='height: 30px; width: 100%; font-size: 14px; text-align: center;'
            onclick=\"setDataOne(document.getElementById('location'), document.getElementById('inputEditorUser4').value, 'location', '$name');\">Сохранить</button>
        </td>
    </tr>
    <tr>
        <td>
            Интересы
        </td>
        <td>
        <input id='inputEditorUser5' style='height: 30px; width: 100%;' maxlength='100' type='text' value='$interests'/>
        </td>
        <td>
            <button id='buttonEditorUser5' style='height: 30px; width: 100%; font-size: 14px; text-align: center;'
            onclick=\"setDataOne(document.getElementById('interests'), document.getElementById('inputEditorUser5').value, 'interests', '$name');\">Сохранить</button>
        </td>
    </tr>
    <tr>
        <td>
            Чем занимаетесь
        </td>
        <td>
        <input id='inputEditorUser6' style='height: 30px; width: 100%;' maxlength='100' type='text' value='$occupation'/>
        </td>
        <td>
            <button id='buttonEditorUser6' style='height: 30px; width: 100%; font-size: 14px; text-align: center;'
            onclick=\"setDataOne(document.getElementById('occupation'), document.getElementById('inputEditorUser6').value, 'occupation', '$name');\">Сохранить</button>
        </td>
    </tr>
    <tr>
        <td>
            Стаж работы
        </td>
        <td>
        <input id='inputEditorUser7' style='height: 30px; width: 100%;' maxlength='40' type='text' value='$recordOfService'/>
        </td>
        <td>
            <button id='buttonEditorUser7' style='height: 30px; width: 100%; font-size: 14px; text-align: center;'
            onclick=\"setDataOne(document.getElementById('recordOfService'), document.getElementById('inputEditorUser7').value, 'recordOfService', '$name');\">Сохранить</button>
        </td>
    </tr>
    <tr>
        <td>
            Подпись
        </td>
        <td>
        <input id='inputEditorUser8' style='height: 30px; width: 100%;' maxlength='100' type='text' value='$signature'/>
        </td>
        <td>
            <button id='buttonEditorUser8' style='height: 30px; width: 100%; font-size: 14px; text-align: center;'
            onclick=\"setDataOne(document.getElementById('signature'), document.getElementById('inputEditorUser8').value, 'signature', '$name');\">Сохранить</button>
        </td>
    </tr>
    <tr><td style='height: 5px;'></td></tr>
    <tr>
        <td style='height: 10px;  border-radius: 6px;' class='borderColor' colspan='3'></td>
    </tr>
</table>
<table style='width: 100%;'>
    <tr><td style='height: 10px;'></td></tr>
    <tr>
        <td id='infoUserEdit' style='width: 350px; text-align: center; font-weight: bold; color: #006400;'></td>
        <td colspan='4' style='text-align: center;'>
            <button id='buttonEditorUser9' style='height: 30px; width: 200px; font-size: 14px; text-align: center;' onclick=\"setDataAll('$name');\">Сохранить все</button>
        </td>
        <td style='width: 350px;'></td>
    </tr>
    <tr><td style='height: 10px;'></td></tr>
</table>
</center>
";