<?php

session_start();
include_once("functionPHP.php");

$name = $_SESSION['userName'];
$avatar = getAvatar($name);
$newPrivateMail = getAmountPrivateNewMail($name);
$allPrivateMail = getAmountPrivateAllMail($name);

echo "
<table width='100%' height='100%'>
    <tr>
        <td>
        <center>Добро пожаловать<br> <a class='afterAuthorizationUser' href='privateOffice.php?userName=$name'>$name</a>!</center>
        </td>
        <td>
        <center><a href='privateOffice.php?userName=$name'><img id='generalAvatar2' width='50px' src='$avatar'></a></center>
        </td>
    </tr>
    <tr>
        <td colspan='2' style='text-align: center;'>
        <hr>
            <div style='font-size: 14px;'>
                <a class='afterAuthorizationUser' href='privateOffice.php?userName=$name&&mail=show'>
                    Личные сообщения
                </a>
            </div> Новых <div style='display: inline' id='newMailCountFormUserAfterAuthorization'>$newPrivateMail</div>, всего $allPrivateMail.
        </td>
    </tr>
        <tr>
        <td colspan='2'>
        <input id='passwordAction' type='button' value='Выход' style='width: 100%;' onclick=\"exitUser();\" />
        </td>
    </tr>
</table>

";