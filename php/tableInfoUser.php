<?php

$noData = "Нет данных";

$realName = getUserUniversal($name,'realName');
$specialization = getUserUniversal($name,'specialization');
$computerConfiguration = getUserUniversal($name,'computerConfiguration');
$location = getUserUniversal($name,'location');
$interests = getUserUniversal($name,'interests');
$occupation = getUserUniversal($name,'occupation');
$recordOfService = getUserUniversal($name,'recordOfService');
$signature = getUserUniversal($name,'signature');

if(!strlen($realName))
    $realName = $noData;

if(!strlen($specialization))
    $specialization = $noData;

if(!strlen($computerConfiguration))
    $computerConfiguration = $noData;

if(!strlen($location))
    $location = $noData;

if(!strlen($interests))
    $interests = $noData;

if(!strlen($occupation))
    $occupation = $noData;

if(!strlen($recordOfService))
    $recordOfService = $noData;

if(!strlen($signature))
    $signature = $noData;

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