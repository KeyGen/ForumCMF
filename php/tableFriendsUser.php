<?php

preg_match_all("/(\[)(.*)(\])/U", $dataUser[0]['friends'], $arrFriends);
$BLDel = $adminBL || $userBL;

if(!isset($arrFriends[0][0])){
    echo "
    <table style='width: 100%; height: 10px;'><tr><td></td></tr></table>
    <table style='width: 100%;'>
        <tr>
            <td style='height: 30px; color: #ffffff; text-align: center; font-weight: bold; border-radius: 6px;' class='borderColor' colspan='3'>
                Друзья $name
            </td>
        </tr>
        <tr><td style='height: 5px;'></td></tr>
        <tr>
        <tr>
            <td style='text-align: center'>
                Список пуст
            </td>
        </tr>
        <tr><td style='height: 10px;'></td></tr>
        <tr><td style='height: 10px;  border-radius: 6px;' class='borderColor' colspan='3'></td></tr>
    </table>
    <table style='width: 100%; height: 10px;'><tr><td></td></tr></table>
    ";
}
else{
    echo "
    <table style='width: 100%;'>
        <tr>
            <td style='height: 30px; color: #ffffff; text-align: center; font-weight: bold; border-radius: 6px;' class='borderColor' colspan='3'>
                Друзья $name
            </td>
        </tr>
        <tr><td style='height: 5px;'></td></tr>
        <tr>
        <tr>
            <td style='text-align: center'>
                <table style='width: 100%; border-radius: 6px; border: 2px solid; background-color: #fbf9ee; font-size: 12px; font-weight: bolder; text-align: center;'>
                    <tr>
                        <td>
                            <table style='width: 60px; font-weight: bolder; text-align: center; font-size: 12px;'><tr><td>Аватарка</td></tr></table>
                        </td>
                        <td style='width: 100%;'>
                        Ник/Статус
                        </td>
                        <td>
                            <table style='width: 75px; font-weight: bolder; text-align: center; font-size: 12px;'><tr><td>on-line</td></tr></table>
                        </td>
                        <td>
                            <table style='width: 170px; font-weight: bolder; text-align: center; font-size: 12px;'><tr><td>Активность пользователя</td></tr></table>
                        </td>";

                if($BLDel)
                echo "
                        <td>
                            <table style='width: 160px; font-weight: bolder; text-align: center; font-size: 12px;'><tr><td>Удалить из друзей</td></tr></table>
                        </td>";

                echo "
                    </tr>
                </table>
                <table style='width: 100%; height: 5px;'><tr><td></td></tr></table>
            ";


    for($i = 0; $i<count($arrFriends[0]); $i++){
        $friend = $arrFriends[2][$i];
        $dataFriend = $bdUsers->getDataName($friend);

        $avatarFriend = $dataFriend[0]['avatar'];
        $titleFriend = $dataFriend[0]['title'];
        $statusFriend = $dataFriend[0]['status'];
        $lastActivityFriend = $dataFriend[0]['lastActivity'];

        if($friend){

            if($BLDel){
                echo "
                <script>
                $(function(){
                    $('#buttonDelFriend$friend').button();
                });
                </script>";
            }

        echo "
        <table style='width: 100%; border-radius: 6px; border: 2px solid; background-color: #fbf9ee;'>
            <tr>
                <td>
                    <table style='width: 50px; height: 50px; text-align: center; border-radius: 6px; border: 1px solid;' cellpadding='0' cellspacing='0'>
                        <tr>
                            <td>
                                <a href='privateoffice.php?user=$friend'><img style='border-radius: 6px; width: 50px;' src='$avatarFriend'></a>
                            </td>
                        </tr>
                    </table>
                </td>
                <td style='width: 100%; text-align: center;'>
                    <div style='display: inline; font-weight: bolder; font-size: 20px;'>$friend</div>
                    <br>";

            if($titleFriend == 'user')
                echo "<div style='display: inline; font-weight: bolder; font-size: 13px; color: #000000;'>Пользователь</div>";
            elseif($titleFriend == 'admin')
                echo "<div style='display: inline; font-weight: bolder; font-size: 13px; color: red;'>Админ</div>";
            elseif($titleFriend == 'moder')
                echo "<div style='display: inline; font-weight: bolder; font-size: 13px; color: #006400;'>Модератор</div>";

                echo "
                </td>
                <td>
                    <table style='width: 75px; font-weight: bolder; text-align: center; font-size: 12px;'><tr><td>";

                if($statusFriend == 'on-line')
                    echo "<img width='35px' src='css/images/yes.png'/>";
                else
                    echo "<img width='35px' src='css/images/no.png'/>";

                echo "</td></tr></table>
                </td>
                <td>
                    <table style='width: 170px;'>
                        <tr>
                            <td style='text-align: center; height: 30px; width: 150px; border-radius: 6px; font-size: 13px; font-weight: bolder; color: #ffffff;' class='borderColor'>
                                 $lastActivityFriend
                            </td>
                        </tr>
                    </table>
                </td>";

            if($BLDel)
            echo "
                <td>
                    <table style='width: 160px; font-weight: bolder; text-align: center; font-size: 12px;'><tr><td>
                        <div style='display: inline' id='idDivDelFriend$friend'>
                            <button id='buttonDelFriend$friend' style='height: 30px; width: 100%; font-size: 14px; text-align: center;'
                            onclick=\"delFriend('$name', '$friend', document.getElementById('idDivDelFriend$friend'))\">Удалить</button>
                        </div>
                    </td></tr></table>
                </td>";

            echo "
            </tr>
        </table>
        <table style='width: 100%; height: 10px;'><tr><td></td></tr></table>
            ";
        }
    }


    echo "
            </td>
        </tr>
        <tr><td style='height: 10px;'></td></tr>
        <tr><td style='height: 10px;  border-radius: 6px;' class='borderColor' colspan='3'></td></tr>
    </table>
    ";
}