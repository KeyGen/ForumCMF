<?php

echo "
<script>
$(function() {
    $( '#buttonPrivateLetter' ).button().click(function(){
        var nameSession = '$nameSession';
        if(nameSession)
        window.location.href = 'privateOffice.php?userName=$nameSession&&mail=$name';
        else
        alert('Сначало зарегистрируйтесь!');
    });
});
</script>

<table style='width: 100%;'>
    <tr>
        <td>
            <fieldset>
                <legend>Отправить личное сообщение</legend>
                <button id='buttonPrivateLetter' style='height: 30px; width: 100%; font-size: 14px; text-align: center;'
                            onclick=\";\"><img style='height: 25px; position: absolute; left: 15px; top: -1px;' src='css/forumStyle/images/folderEmail.png'/>Отправить личное сообщение пользователю $name</button>
            </fieldset>
        </td>
    </tr>
</table>
";