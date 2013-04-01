<?php

$realName = $dataUser[0]['realName'];
$specialization = $dataUser[0]['specialization'];
$computerConfiguration = $dataUser[0]['computerConfiguration'];
$location = $dataUser[0]['location'];
$interests = $dataUser[0]['interests'];
$occupation = $dataUser[0]['occupation'];
$recordOfService = $dataUser[0]['recordOfService'];
$signature= $dataUser[0]['signature'];


echo "
<table style='width: 100%;'>
    <tr>
        <td style='height: 5px;'></td>
    </tr>
    <tr>
        <td style='height: 30px; color: #ffffff; text-align: center; font-weight: bold; border-radius: 6px;' class='borderColor' colspan='2'>
            О $name
        </td>
    </tr>
    <tr><td style='height: 5px;'></td></tr>
    <tr>
        <td style='width: 250px;'>
            Реальное имя
        </td>
        <td>
            <div id='realName'>$realName</div>
        </td>
    </tr>
    <tr>
        <td>
        Специализация
        </td>
        <td>
            <div id='specialization'>$specialization</div>
        </td>
    </tr>
    <tr>
        <td>
             Конфигурация компьютера
        </td>
        <td>
            <div id='computerConfiguration'>$computerConfiguration</div>
        </td>
    </tr>
    <tr>
        <td>
            Местоположение
        </td>
        <td>
            <div id='location'>$location</div>
        </td>
    </tr>
    <tr>
        <td>
            Интересы
        </td>
        <td>
            <div id='interests'>$interests</div>
        </td>
    </tr>
    <tr>
        <td>
            Чем занимаетесь
        </td>
        <td>
            <div id='occupation'>$occupation</div>
        </td>
    </tr>
    <tr>
        <td>
            Стаж работы
        </td>
        <td>
            <div id='recordOfService'>$recordOfService</div>
        </td>
    </tr>
    <tr>
        <td>
            Подпись
        </td>
        <td>
            <div id='signature'>$signature</div>
        </td>
    </tr>
    <tr><td style='height: 5px;'></td></tr>
    <tr>
        <td style='height: 10px;  border-radius: 6px;' class='borderColor' colspan='2'>
    </td>
    </tr>
</table>
";