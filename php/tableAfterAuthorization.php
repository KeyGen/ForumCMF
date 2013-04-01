<?php

session_start();

global $bdUsers;

// Кноапка выхода
$buttonExitUser = new \Qp\QPush('Выход','100%','22px','11px');
$buttonExitUser->setOnClick("exitUser();");
// Имя пользователя
$name = $_SESSION['userName'];
// Получаем массив ([0][]...) с его данными
$dataUser = $bdUsers->getDataName($name);
// Достаем адрес картинки
$avatar = $dataUser[0]['avatar'];
// Получем количество новых и всех полученных приватных сообщений
$newPrivateMail = $bdPrivateMail->getQuantityArr(array('addressee'=>$name, 'status'=>'no-read'));
$allPrivateMail = $bdPrivateMail->getQuantityArr(array('addressee'=>$name));

// Выводим полученную таблицу
echo "
<table width='100%' height='100%'>
    <tr>
        <td>
        <center>Добро пожаловать<br> <a class='afterAuthorizationUser' href='privateoffice.php?user=$name'>$name</a>!</center>
        </td>
        <td>
        <center><a href='privateoffice.php?user=$name'><img id='generalAvatar2' width='50px' src='$avatar'></a></center>
        </td>
    </tr>
    <tr>
        <td colspan='2' style='text-align: center;'>
        <hr>
            <div style='font-size: 14px;'>
                <a class='afterAuthorizationUser' href='privateoffice.php?user=$name&&mail=show'>
                    Личные сообщения
                </a>
            </div> Новых <div style='display: inline' id='newMailCountFormUserAfterAuthorization'>$newPrivateMail</div>, всего $allPrivateMail.
        </td>
    </tr>
        <tr>
        <td colspan='2'>";
echo        $buttonExitUser->show();
echo "  </td>
    </tr>
</table>

";