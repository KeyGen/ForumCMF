<?php

echo "
<script type='text/javascript' src='http://scriptjava.net/source/scriptjava/scriptjava.js'></script>
<script type='text/javascript'>
function SendFile() {
	//отправка файла на сервер
	$$f({
		formid:'test_form',//id формы
		url:'/php/setAvatar.php',//адрес на серверный скрипт который будет принимать файл
		onstart:function () {//действие при начале загрузки файла
		alert('start');
			$$('result','начинаю отправку файла');//в элемент с id='esult' выводим результат
		},
		onsend:function () {//действие по окончании загрузки файла
			$$('result',$$('result').innerHTML+'<br />файл успешно загружен');//в элемент с id='result' выводим результат
		},
        error:function (xhr, ajaxOptions, thrownError){
            //если ошибка аякса, то выведем ее
            alert(xhr.status);
            alert(thrownError);
        }
	});
}
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
    <button id='buttonEditorAvatarDownload1' style='height: 30px; width: 200px; font-size: 14px; text-align: center;' onclick=\"javascript:with(document.getElementById('sp')){submit()}\">Загрузить</button>
</form>

<iframe name=p_a frameborder=0 src=php/setAvatar.php width=0 height=0 scrolling=no></iframe>

<div id='buttonEditorAvatarSaveDownload2' class='none'>
<button id='buttonEditorAvatarSaveDownload1' style='height: 30px; width: 200px; font-size: 14px; text-align: center;' onclick=\"setAvatar(document.getElementById('image_list').value, '$name');\">Сохранить</button>
</div>
<!-- Изменение аватарки -->
        </td>
    </tr>
    <tr><td style='height: 5px;'></td></tr>
    <tr><td style='height: 10px;  border-radius: 6px;' class='borderColor' colspan='3'></td></tr>
    <tr><td style='height: 14px;'></td></tr>
</table>

";