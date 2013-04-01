<?php

$realName = $dataUser[0]['realName'];
$specialization = $dataUser[0]['specialization'];
$computerConfiguration = $dataUser[0]['computerConfiguration'];
$location = $dataUser[0]['location'];
$interests = $dataUser[0]['interests'];
$occupation = $dataUser[0]['occupation'];
$recordOfService = $dataUser[0]['recordOfService'];
$signature= $dataUser[0]['signature'];

global $name;
global $code;

echo "
<script>
    $(function(){
        var buttonEditorUser1 = $('#buttonEditorUser1').button().click(function(){
            var input = document.getElementById('inputEditorUser1').value;
            if(setInfoUser(
            'realName',
            input,
            '$name',
            '$code'
            )){
            document.getElementById('realName').innerHTML = input
            }
        });
        var buttonEditorUser2 = $('#buttonEditorUser2').button().click(function(){
            var input = document.getElementById('inputEditorUser2').value;
            if(setInfoUser(
            'specialization',
            input,
            '$name',
            '$code'
            )){
            document.getElementById('specialization').innerHTML = input;
            }
        });
        var buttonEditorUser3 = $('#buttonEditorUser3').button().click(function(){
            var input = document.getElementById('inputEditorUser3').value;
            if(setInfoUser(
            'computerConfiguration',
            input,
            '$name',
            '$code'
            )){
            document.getElementById('computerConfiguration').innerHTML = input;
            }
        });
        var buttonEditorUser4 = $('#buttonEditorUser4').button().click(function(){
            var input = document.getElementById('inputEditorUser4').value;
            if(setInfoUser(
            'location',
            input,
            '$name',
            '$code'
            )){
            document.getElementById('location').innerHTML = input;
            }
        });
        var buttonEditorUser5 = $('#buttonEditorUser5').button().click(function(){
            var input = document.getElementById('inputEditorUser5').value;
            if(setInfoUser(
            'interests',
            input,
            '$name',
            '$code'
            )){
            document.getElementById('interests').innerHTML = input;
            }
        });
        var buttonEditorUser6 = $('#buttonEditorUser6').button().click(function(){
            var input = document.getElementById('inputEditorUser6').value;
            if(setInfoUser(
            'occupation',
            input,
            '$name',
            '$code'
            )){
            document.getElementById('occupation').innerHTML = input;
            }
        });
        var buttonEditorUser7 = $('#buttonEditorUser7').button().click(function(){
            var input = document.getElementById('inputEditorUser7').value;
            if(setInfoUser(
            'recordOfService',
            input,
            '$name',
            '$code'
            )){
            document.getElementById('recordOfService').innerHTML = input;
            }
        });
        var buttonEditorUser8 = $('#buttonEditorUser8').button().click(function(){
            var input = document.getElementById('inputEditorUser8').value;
            if(setInfoUser(
            'signature',
            input,
            '$name',
            '$code'
            )){
            document.getElementById('signature').innerHTML = input;
            }
        });

        $('#buttonEditorUser9').button().click(function(){
            // Активизируем все кнопки
            buttonEditorUser1.click();
            buttonEditorUser2.click();
            buttonEditorUser3.click();
            buttonEditorUser4.click();
            buttonEditorUser5.click();
            buttonEditorUser6.click();
            buttonEditorUser7.click();
            buttonEditorUser8.click();
        });
    });
</script>
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
            <button type='button' id='buttonEditorUser1' style='height: 30px; width: 100%; font-size: 14px; text-align: center;'>Сохранить</button>
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
            <button id='buttonEditorUser2' style='height: 30px; width: 100%; font-size: 14px; text-align: center;'>Сохранить</button>
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
            <button id='buttonEditorUser3' style='height: 30px; width: 100%; font-size: 14px; text-align: center;'>Сохранить</button>
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
            <button id='buttonEditorUser4' style='height: 30px; width: 100%; font-size: 14px; text-align: center;'>Сохранить</button>
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
            <button id='buttonEditorUser5' style='height: 30px; width: 100%; font-size: 14px; text-align: center;'>Сохранить</button>
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
            <button id='buttonEditorUser6' style='height: 30px; width: 100%; font-size: 14px; text-align: center;'>Сохранить</button>
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
            <button id='buttonEditorUser7' style='height: 30px; width: 100%; font-size: 14px; text-align: center;'>Сохранить</button>
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
            <button id='buttonEditorUser8' style='height: 30px; width: 100%; font-size: 14px; text-align: center;'>Сохранить</button>
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
            <button id='buttonEditorUser9' style='height: 30px; width: 200px; font-size: 14px; text-align: center;'>Сохранить все</button>
        </td>
        <td style='width: 350px;'></td>
    </tr>
    <tr><td style='height: 10px;'></td></tr>
</table>
";