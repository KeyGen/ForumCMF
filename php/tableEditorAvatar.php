<?php

$id = $dataUser[0]['id'];

echo "
<script>
    $(function(){
         $('#buttonEditorAvatarDownload1').button();
         $('#buttonEditorAvatarSaveDownload1').button();
    });
</script>

<table style='width: 100%;'>
    <tr><td style='height: 14px;'></td></tr>
    <tr>
        <td style='height: 30px; color: #ffffff; text-align: center; font-weight: bold; border-radius: 6px;' class='borderColor' colspan='3'>
            Изменение аватарки $name
        </td>
    </tr>
    <tr><td style='height: 5px;'></td></tr>
    <tr>
        <td style='text-align: center'>
            <img id='avatar' src='$avatar' border='1' />
        </td>
    </tr>
    <tr><td style='height: 30px;'></td></tr>
    <tr>
        <td style='text-align: center; font-size: 13px;'>
            <!-- Изменение аватарки -->
            <input id=image_list type='hidden'/>
            <form id=sp target=p_a action=php/setAvatar.php method=POST enctype='multipart/form-data'>
                <input id=gfile type=File name=ufile size=20>
                <input type=hidden name=act value=upf>
                <br>
                <br>
                <button id='buttonEditorAvatarDownload1' style='height: 30px; width: 200px; font-size: 14px; text-align: center;'
                onclick=\"javascript:with(document.getElementById('sp')){submit()}\">Загрузить</button>
            </form>
            <iframe name=p_a frameborder=0 src=php/setAvatar.php width=0 height=0 scrolling=no></iframe>

            <div id='buttonEditorAvatarSaveDownload2' class='none'>
            <button id='buttonEditorAvatarSaveDownload1' style='height: 30px; width: 200px; font-size: 14px; text-align: center;'
            onclick=\"setAvatar(document.getElementById('image_list').value, '$name', '$id');\">Сохранить</button>
            </div>
            <!-- Изменение аватарки -->
        </td>
    </tr>
    <tr><td style='height: 5px;'></td></tr>
    <tr><td style='height: 10px;  border-radius: 6px;' class='borderColor' colspan='3'></td></tr>
    <tr><td style='height: 14px;'></td></tr>
</table>

";