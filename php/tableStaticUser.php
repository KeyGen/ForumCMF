<?php

$allPress = getUserUniversal($name,'allPress');
$thanks = getUserUniversal($name, 'thanks');
$thanksAnother = getUserUniversal($name, 'thanksAnother');
$registration = getUserUniversal($name, 'registration');
$lastActivity = getUserUniversal($name, 'lastActivity');

echo "
<table style='width: 100%;'>
    <tr>
        <td>
            <fieldset>
                <legend>Всего сообщений</legend>
                Всего сообщений: $allPress<br><br>
                <button id='buttonStaticUser1' style='height: 30px; font-size: 12px; text-align: left;'>Найти все сообщения от KeyGen</button>
                <button id='buttonStaticUser2' style='height: 30px; font-size: 12px; text-align: left;'>Найти все темы, созданные KeyGen</button>
            </fieldset>
        </td>
    </tr>
    <tr>
        <td>
            <fieldset>
                <legend>Всего благодарностей</legend>
                Сказал(а) спасибо: $thanksAnother<br>
                Поблагодарили: $thanks раз(а) <br><br>
                <button id='buttonStaticUser3' style='height: 30px; font-size: 12px; text-align: left;'>Найти все полезные сообщения от KeyGen</button>
                <button id='buttonStaticUser4' style='height: 30px; font-size: 12px; text-align: left;'>Найти все сообщения с благодарностями от KeyGen</button>
            </fieldset>
        </td>
    </tr>
    <tr>
        <td>
            <fieldset>
                <legend>Дополнительная информация</legend>
                Последняя активность: $lastActivity<br>
                Регистрация: $registration
            </fieldset>
        </td>
    </tr>
</table>
";