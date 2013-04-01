<?php

$allPress= $dataUser[0]['allPress'];
$thanks= $dataUser[0]['thanks'];
$thanksAnother= $dataUser[0]['thanksAnother'];
$registration= $dataUser[0]['registration'];
$lastActivity= $dataUser[0]['lastActivity'];

echo "
<script>
    $(function(){
        $( '#buttonStaticUser1' ).button();
        $( '#buttonStaticUser2' ).button();
        $( '#buttonStaticUser3' ).button();
        $( '#buttonStaticUser4' ).button();
    });
</script>
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