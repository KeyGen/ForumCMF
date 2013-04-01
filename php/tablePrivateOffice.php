<?php

global $bdUsers;

$name = $_GET['user'];
$nameSession = $_SESSION['userName'];

$adminBL = false;
$moderBL = false;
$userBL = false;

if(!isset($name)){
    header("Location: index.php");
}
elseif($name == $nameSession){
    $userBL = true;
}

if(isset($nameSession)){
    $titleSession = $bdUsers->getDataOne('name',$_SESSION['userName'],'title');
    if($titleSession == 'admin') $adminBL = true;
    elseif($titleSession == 'moder') $moderBL = true;
}

$dataUser = $bdUsers->getDataName($name);

$avatar = $dataUser[0]['avatar'];
// Буду использовать для защиты. Еще одна не помешает...
$code = $dataUser[0]['id'];

// Меню
$menuFriendDisdain = "";
$menuUser  = "";
$menuModer = "";
$menuAdmin = "";
$enumButtonDiv = 15;

if(isset($nameSession) && !$userBL)
$menuFriendDisdain = "
    <script>
        $(function(){
            $('#buttonSetFriend').button().click(function(){
                setFriend('$nameSession', '$name');
            });

            $('#buttonSetDisdain').button().click(function(){
                setDisdain('$nameSession', '$name');
            });
        });
    </script>
    <table style='height: 5px;'><tr><td></td></tr></table>
    <button id='buttonSetFriend' style='width: 100%; height: 30px; font-size: 12px; text-align: left;'>Добавить в друзья</button>
    <table style='height: 5px;'><tr><td></td></tr></table>
    <button id='buttonSetDisdain' style='width: 100%; height: 30px; font-size: 12px; text-align: left;'>Добавить в игнор</button>
    <table style='height: 5px;'><tr><td></td></tr></table>
";

if($userBL || $adminBL)
$menuUser = "
    <script>
        $(function(){
        $( '#accordionMenu1' ).accordion({autoHeight:false, collapsible:true, active: 0});
        $( '#accordionMenu2' ).accordion({autoHeight:false, collapsible:true, active: 10});
        $( '#accordionMenu3' ).accordion({autoHeight:false, collapsible:true, active: 10});
        $( '#accordionMenu4' ).accordion({autoHeight:false, collapsible:true, active: 10});
        $( '#accordionMenu5' ).accordion({autoHeight:false, collapsible:true, active: 10});

                var tabs = $('#tabs');

        $( '#button1' ).button().click(function(){
            if(tabs.tabs('option','selected') != -1)
                tabs.tabs('select', tabs.tabs('option','selected'));
            for(var i = 1; i<$enumButtonDiv+1; i++){
                if(i != 1 && i != 8)
                    document.getElementById('button_'+i+'_div').className = 'none';
            }
            document.getElementById('button_1_div').className = 'divPrivateOffice';
            goToPosElementForm('#href',0);
        });

        $( '#button2' ).button().click(function(){
            if(tabs.tabs('option','selected') != -1)
                tabs.tabs('select', tabs.tabs('option','selected'));
            for(var i = 1; i<$enumButtonDiv+1; i++){
                if(i != 2 && i != 8)
                    document.getElementById('button_'+i+'_div').className = 'none';
            }
            document.getElementById('button_2_div').className = 'divPrivateOffice';
            goToPosElementForm('#href',0);
        });

        $( '#button3' ).button().click(function(){
            if(tabs.tabs('option','selected') != -1)
                tabs.tabs('select', tabs.tabs('option','selected'));
            for(var i = 1; i<$enumButtonDiv+1; i++){
                if(i != 3 && i != 8)
                    document.getElementById('button_'+i+'_div').className = 'none';
            }
            document.getElementById('button_3_div').className = 'divPrivateOffice';
            goToPosElementForm('#href',0);
        });

        $( '#button4' ).button().click(function(){
            if(tabs.tabs('option','selected') != -1)
                tabs.tabs('select', tabs.tabs('option','selected'));
            for(var i = 1; i<$enumButtonDiv+1; i++){
                if(i != 4 && i != 8)
                    document.getElementById('button_'+i+'_div').className = 'none';
            }
            document.getElementById('button_4_div').className = 'divPrivateOffice';
            goToPosElementForm('#href',0);
        });

        $( '#button5' ).button().click(function(){
            if(tabs.tabs('option','selected') != -1)
                tabs.tabs('select', tabs.tabs('option','selected'));
            for(var i = 1; i<$enumButtonDiv+1; i++){
                if(i != 5 && i != 8)
                    document.getElementById('button_'+i+'_div').className = 'none';
            }
            document.getElementById('button_5_div').className = 'divPrivateOffice';
            goToPosElementForm('#href',0);
        });

        $( '#button6' ).button().click(function(){
            if(tabs.tabs('option','selected') != -1)
                tabs.tabs('select', tabs.tabs('option','selected'));
            for(var i = 1; i<$enumButtonDiv+1; i++){
                if(i != 6 && i != 8)
                    document.getElementById('button_'+i+'_div').className = 'none';
            }
            document.getElementById('button_6_div').className = 'divPrivateOffice';
            goToPosElementForm('#href',0);
        });

        $( '#button7' ).button().click(function(){
            if(tabs.tabs('option','selected') != -1)
                tabs.tabs('select', tabs.tabs('option','selected'));
            for(var i = 1; i<$enumButtonDiv+1; i++){
                if(i != 7 && i != 8)
                    document.getElementById('button_'+i+'_div').className = 'none';
            }
            document.getElementById('button_7_div').className = 'divPrivateOffice';
            goToPosElementForm('#href',0);
        });

         $( '#button8' ) .button() .click(function(){
            // Отключаем все divЫ :)
            for(var i = 1; i<$enumButtonDiv+1; i++)
                if(i != 8)
                    document.getElementById('button_'+i+'_div').className = 'none';

            if(tabs.tabs('option','selected') != 2) tabs.tabs('select', 2);
            goToPosElementForm('#href',0);
        });

        $( '#button9' ).button().click(function(){
            if(tabs.tabs('option','selected') != -1)
                tabs.tabs('select', tabs.tabs('option','selected'));
            for(var i = 1; i<$enumButtonDiv+1; i++){
                if(i != 9 && i != 8)
                    document.getElementById('button_'+i+'_div').className = 'none';
            }
            document.getElementById('button_9_div').className = 'divPrivateOffice';
            goToPosElementForm('#href',0);
        });

        $( '#button10' ).button().click(function(){
            if(tabs.tabs('option','selected') != -1)
                tabs.tabs('select', tabs.tabs('option','selected'));
            for(var i = 1; i<$enumButtonDiv+1; i++){
                if(i != 10 && i != 8)
                    document.getElementById('button_'+i+'_div').className = 'none';
            }
            document.getElementById('button_10_div').className = 'divPrivateOffice';
            goToPosElementForm('#href',0);
        });

        });
    </script>

    <style>
        .ui-accordion .ui-accordion-content {
            border-top: 0 none;
            overflow: auto;
            padding: 2px 2px;
        }
    </style>

    <!-- ##################################### -->
    <div id='accordionMenu1'>
        <h3 style='height: 15px; font-size: 13px;'>
            Мой профиль
        </h3>
        <div>
            <table style='width: 100%;'>
                <tr>
                    <td>
                        <button id='button1' style='width: 100%; height: 30px; font-size: 12px; text-align: left;'>Редактировать данные</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button id='button2' style='width: 100%; height: 30px; font-size: 12px; text-align: left;'>Изменить аватарку</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <!-- ##################################### -->
    <div id='accordionMenu2'>
        <h3 style='height: 15px; font-size: 13px;'>
            Настройки и параметры
        </h3>
        <div>
            <table style='width: 100%;'>
                <tr>
                    <td>
                        <button id='button3' style='width: 100%; height: 30px; font-size: 12px; text-align: left;'>Редактировать email и пароль</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button id='button4' style='width: 100%; height: 30px; font-size: 12px; text-align: left;'>Список игнорирования</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <!-- ##################################### -->
    <div id='accordionMenu3'>
        <h3 style='height: 15px; font-size: 13px;'>
            Личные сообщения
        </h3>
        <div>
            <table style='width: 100%;'>
                <tr>
                    <td>
                        <button id='button5' style='width: 100%; height: 30px; font-size: 12px; text-align: left;'>Отправить сообщение</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button id='button6' style='width: 100%; height: 30px; font-size: 12px; text-align: left;'>Входящие сообщения</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button id='button7' style='width: 100%; height: 30px; font-size: 12px; text-align: left;'>Изходящие сообщения</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <!-- ##################################### -->
    <div id='accordionMenu4'>
        <h3 style='height: 15px; font-size: 13px;'>
            Контакты
        </h3>
        <div>
            <table style='width: 100%;'>
                <tr>
                    <td>
                        <button id='button8' style='width: 100%; height: 30px; font-size: 12px; text-align: left;'>Друзья</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <!-- ##################################### -->
    <div id='accordionMenu5'>
        <h3 style='height: 15px; font-size: 13px;'>
            Темы с подпиской
        </h3>
        <div>
            <table style='width: 100%;'>
                <tr>
                    <td>
                        <button id='button9' style='width: 100%; height: 30px; font-size: 12px; text-align: left;'>Подписаные темы</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button id='button10' style='width: 100%; height: 30px; font-size: 12px; text-align: left;'>Подписаные разделы </button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <!-- ##################################### -->
";

if($moderBL || $adminBL)
$menuModer = "
    <script>
        $(function(){
        $( '#accordionMenu6' ).accordion({autoHeight:false, collapsible:true, active: 10});

        var tabs = $('#tabs');

        $( '#button11' ).button().click(function(){
            if(tabs.tabs('option','selected') != -1)
                tabs.tabs('select', tabs.tabs('option','selected'));
            for(var i = 1; i<$enumButtonDiv+1; i++){
                if(i != 11 && i != 8)
                    document.getElementById('button_'+i+'_div').className = 'none';
            }
            document.getElementById('button_11_div').className = 'divPrivateOffice';
            goToPosElementForm('#href',0);
        });

        $( '#button12' ).button().click(function(){
            if(tabs.tabs('option','selected') != -1)
                tabs.tabs('select', tabs.tabs('option','selected'));
            for(var i = 1; i<$enumButtonDiv+1; i++){
                if(i != 12 && i != 8)
                    document.getElementById('button_'+i+'_div').className = 'none';
            }
            document.getElementById('button_12_div').className = 'divPrivateOffice';
            goToPosElementForm('#href',0);
        });

        $( '#button13' ).button().click(function(){
            if(tabs.tabs('option','selected') != -1)
                tabs.tabs('select', tabs.tabs('option','selected'));
            for(var i = 1; i<$enumButtonDiv+1; i++){
                if(i != 13 && i != 8)
                    document.getElementById('button_'+i+'_div').className = 'none';
            }
            document.getElementById('button_13_div').className = 'divPrivateOffice';
            goToPosElementForm('#href',0);
        });

        });
    </script>
    <div id='accordionMenu6'>
        <h3 style='height: 15px; font-size: 13px;'>
            Меню модератора
        </h3>
        <div>
            <table style='width: 100%;'>
                <tr>
                    <td>
                        <button id='button11' style='width: 100%; height: 30px; font-size: 12px; text-align: left;'>Новые темы</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button id='button12' style='width: 100%; height: 30px; font-size: 12px; text-align: left;'>Новые сообщения</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button id='button13' style='width: 100%; height: 30px; font-size: 12px; text-align: left;'>Бан пользователей</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
";

if($adminBL)
$menuAdmin = "
    <script>
        $(function(){
        $( '#accordionMenu7' ).accordion({autoHeight:false, collapsible:true, active: 10});

        var tabs = $('#tabs');

        $( '#button14' ).button().click(function(){
            if(tabs.tabs('option','selected') != -1)
                tabs.tabs('select', tabs.tabs('option','selected'));
            for(var i = 1; i<$enumButtonDiv+1; i++){
                if(i != 14 && i != 8)
                    document.getElementById('button_'+i+'_div').className = 'none';
            }
            document.getElementById('button_14_div').className = 'divPrivateOffice';
            goToPosElementForm('#href',0);
        });

        $( '#button15' ).button().click(function(){
            if(tabs.tabs('option','selected') != -1)
                tabs.tabs('select', tabs.tabs('option','selected'));
            for(var i = 1; i<$enumButtonDiv+1; i++){
                if(i != 15 && i != 8)
                    document.getElementById('button_'+i+'_div').className = 'none';
            }
            document.getElementById('button_15_div').className = 'divPrivateOffice';
            goToPosElementForm('#href',0);
        });

        });
    </script>
    <!-- ##################################### -->
    <div id='accordionMenu7'>
        <h3 style='height: 15px; font-size: 13px;'>
            Меню админа
        </h3>
        <div>
            <table style='width: 100%;'>
                <tr>
                    <td>
                        <button id='button14' style='width: 100%; height: 30px; font-size: 12px; text-align: left;'>Назначение статуса</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button id='button15' style='width: 100%; height: 30px; font-size: 12px; text-align: left;'>Удаление пользователя</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <!-- ##################################### -->
";

// Вывод готовой таблицы
echo "
    <script>
        $(function(){
            $( '#tabs' ).tabs({
                fx: {opacity:'toggle', duration:'fast' },
                collapsible: true
            }).click(function(){
                for(var i = 1; i<$enumButtonDiv+1; i++)
                    document.getElementById('button_'+i+'_div').className = 'none';
            });
        });
    </script>

<table id='href' style='width: 100%;'>
    <tr>
        <td style='vertical-align: top;'>
            <img id='generalAvatar' src='$avatar' width='230px' border='1'/>
            <!-- Menu begin -->
            $menuFriendDisdain
            $menuUser
            $menuModer
            $menuAdmin
            <!-- Menu end -->
        </td>
        <td style='vertical-align: top;'>
             <!-- Tabs begin -->
            <div id='tabs' style='background-color: #dddddd;'>
                <ul>
                    <li><a href='#tabs-1'>
                        <div style='width: 165px; font-size: 15px;'>Обо мне</div>
                    </a></li>
                    <li><a href='#tabs-2'>
                        <div style='width: 165px; font-size: 15px;'>Статистика</div>
                    </a></li>
                    <li><a href='#tabs-3'>
                        <div style='width: 165px; font-size: 15px;'>Друзья</div>
                    </a></li>
                    <li><a href='#tabs-4'>
                        <div style='width: 165px; font-size: 15px;'>Связь</div>
                    </a></li>
                    <li><a href='#tabs-5'>
                        <div style='width: 165px; font-size: 15px;'>Активность на форуме</div>
                    </a></li>
                </ul>
                <div id='tabs-1' style='color: #000000;'>";
                    include_once("tableInfoUser.php");
echo "          </div>
                <div id='tabs-2' style='color: #000000;'>";
                    include_once("tableStaticUser.php");
echo "          </div>
                <div id='tabs-3' style='color: #000000;'>";
                    include_once("tableFriendsUser.php");
echo "          </div>
                <div id='tabs-4' style='color: #000000;'>";
                    include_once("tableMessageUser.php");
echo "          </div>
                <div id='tabs-5' style='color: #000000;'>
                    Пока нет
                </div>
            </div>
            <!-- Tabs end -->
                            <table style='width: 100%; border-radius: 6px; border: 1px solid #000000; background-color: #dddddd;'>
                    <tr>
                        <td style='width: 20px;'></td>
                        <td style='text-align: center;'>
            <!-- ////////////////////////////////////////////// -->
            <div id='button_1_div' class='none' >";
                include_once("tableEditorDataUser.php");
echo "      </div>
            <!-- ////////////////////////////////////////////// -->
            <div id='button_2_div' class='none' >";
                include_once("tableEditorAvatar.php");
echo "      </div>
            <!-- ////////////////////////////////////////////// -->
            <div id='button_3_div' class='none' >";
                include_once("tableEditorEmailAndPassword.php");
echo "     </div>
            <!-- ////////////////////////////////////////////// -->
            <div id='button_4_div' class='none' >";
                include_once("tableDisdainUser.php");
echo "     </div>
            <!-- ////////////////////////////////////////////// -->
            <div id='button_5_div' class='none' >";
                include_once("tableNewLetter.php");
echo "     </div>
            <!-- ////////////////////////////////////////////// -->
            <div id='button_6_div' class='none' >";
                include_once("privateMailTake.php");
echo "     </div>
            <!-- ////////////////////////////////////////////// -->
            <div id='button_7_div' class='none' >";
                include_once("privateMailSend.php");
echo "     </div>
            <!-- ////////////////////////////////////////////// -->
            <div id='button_9_div' class='none' >";
//include_once("privateMailSend.php");
echo "
            </div>
            <!-- ////////////////////////////////////////////// -->
            <div id='button_10_div' class='none' >";
//include_once("privateMailSend.php");
echo "
            </div>
            <!-- ////////////////////////////////////////////// -->
            <div id='button_11_div' class='none' >";
//include_once("privateMailSend.php");
echo "
            </div>
            <!-- ////////////////////////////////////////////// -->
            <div id='button_12_div' class='none' >";
//include_once("privateMailSend.php");
echo "
            </div>
            <!-- ////////////////////////////////////////////// -->
            <div id='button_13_div' class='none' >";
//include_once("privateMailSend.php");
echo "
            </div>
            <!-- ////////////////////////////////////////////// -->
            <div id='button_14_div' class='none' >";
//include_once("privateMailSend.php");
echo "
            </div>
            <!-- ////////////////////////////////////////////// -->
            <div id='button_15_div' class='none' >abra";
//include_once("privateMailSend.php");
echo "
            </div>
            <!-- ////////////////////////////////////////////// -->
                 </td>
                </tr>
                </table>
        </td>
    </tr>
</table>
                ";

/*

    $menuModer = "";
    $menuAdmin = "";
    $tableModer = "";
    $tableAdmin = "";


        $menuModer = "
                    <!-- ##################################### -->
                    <div id='accordionMenu6'>
                        <h3 style='height: 15px; font-size: 13px;'>
                            Меню Модера
                        </h3>
                        <div>
                            <table style='width: 100%;'>
                                <tr>
                                    <td>
                                        <button id='button11' style='width: 100%; height: 30px; font-size: 12px; text-align: left;'>Новые темы</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button id='button12' style='width: 100%; height: 30px; font-size: 12px; text-align: left;'>Новые сообщения</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button id='button13' style='width: 100%; height: 30px; font-size: 12px; text-align: left;'>Бан пользователей</button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- ##################################### -->
    ";


        $tableModer = "
                        <!-- ////////////////////////////////////////////// -->
                    <div id='tabs-17' class='none' >
                                    Новые темы
                    </div>
                    <!-- ////////////////////////////////////////////// -->
                    <!-- ////////////////////////////////////////////// -->
                    <div id='tabs-18' class='none' >
                                    Новые сообщения
                    </div>
                    <!-- ////////////////////////////////////////////// -->
                    <!-- ////////////////////////////////////////////// -->
                    <div id='tabs-19' class='none' >
                                    Бан пользователей
                    </div>
                    <!-- ////////////////////////////////////////////// -->

        ";

        $menuAdmin = "
                    <!-- ##################################### -->
                    <div id='accordionMenu7'>
                        <h3 style='height: 15px; font-size: 13px;'>
                            Меню админа
                        </h3>
                        <div>
                            <table style='width: 100%;'>
                                <tr>
                                    <td>
                                        <button id='button14' style='width: 100%; height: 30px; font-size: 12px; text-align: left;'>Назначение статуса</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button id='button15' style='width: 100%; height: 30px; font-size: 12px; text-align: left;'>Удаление пользователя</button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- ##################################### -->
    ";

        $tableAdmin = "
                    <!-- ////////////////////////////////////////////// -->
                    <div id='tabs-20' class='none' >
                                    Назначение статуса
                    </div>
                    <!-- ////////////////////////////////////////////// -->
                    <!-- ////////////////////////////////////////////// -->
                    <div id='tabs-21' class='none' >
                                    Удаление пользователя
                    </div>
                    <!-- ////////////////////////////////////////////// -->


        ";


echo "
<br><br>
<table style='width: 100%;'>";

if($_sessionBL){
echo "
    <tr>
        <td rowspan='2' style='width: 230px; vertical-align: top;'>
        <!-- Здесь будет аватарка -->
            <img id='generalAvatar' src='$avatar' width='230px' border='1'/>";

    if($title == "admin" && $name != $nameSession){
        echo "
            <script>
                $(function(){
                    $('#buttonSetFriend').button().click(function(){
                        setFriend('$nameSession', '$name');
                    });

                    $('#buttonSetDisdain').button().click(function(){
                        setDisdain('$nameSession', '$name');
                    });
                });
            </script>
            <table style='height: 5px;'><tr><td></td></tr></table>
            <button id='buttonSetFriend' style='width: 100%; height: 30px; font-size: 12px; text-align: left;'>Добавить в друзья</button>
            <table style='height: 5px;'><tr><td></td></tr></table>
            <button id='buttonSetDisdain' style='width: 100%; height: 30px; font-size: 12px; text-align: left;'>Добавить в игнор</button>
            <table style='height: 5px;'><tr><td></td></tr></table>
        ";
    }

    echo "
            <!-- ##################################### -->
            <div id='accordionMenu1'>
                <h3 style='height: 15px; font-size: 13px;'>
                    Мой профиль
                </h3>
                <div>
                    <table style='width: 100%;'>
                        <tr>
                            <td>
                                <button id='button1' style='width: 100%; height: 30px; font-size: 12px; text-align: left;'>Редактировать данные</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button id='button2' style='width: 100%; height: 30px; font-size: 12px; text-align: left;'>Изменить аватарку</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- ##################################### -->
            <div id='accordionMenu2'>
                <h3 style='height: 15px; font-size: 13px;'>
                    Настройки и параметры
                </h3>
                <div>
                    <table style='width: 100%;'>
                        <tr>
                            <td>
                                <button id='button3' style='width: 100%; height: 30px; font-size: 12px; text-align: left;'>Редактировать email и пароль</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button id='button4' style='width: 100%; height: 30px; font-size: 12px; text-align: left;'>Список игнорирования</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- ##################################### -->
            <div id='accordionMenu3'>
                <h3 style='height: 15px; font-size: 13px;'>
                    Личные сообщения
                </h3>
                <div>
                    <table style='width: 100%;'>
                        <tr>
                            <td>
                                <button id='button5' style='width: 100%; height: 30px; font-size: 12px; text-align: left;'>Отправить сообщение</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button id='button6' style='width: 100%; height: 30px; font-size: 12px; text-align: left;'>Входящие сообщения</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button id='button7' style='width: 100%; height: 30px; font-size: 12px; text-align: left;'>Изходящие сообщения</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- ##################################### -->
            <div id='accordionMenu4'>
                <h3 style='height: 15px; font-size: 13px;'>
                    Контакты
                </h3>
                <div>
                    <table style='width: 100%;'>
                        <tr>
                            <td>
                                <button id='button8' style='width: 100%; height: 30px; font-size: 12px; text-align: left;'>Друзья</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- ##################################### -->
            <div id='accordionMenu5'>
                <h3 style='height: 15px; font-size: 13px;'>
                    Темы с подпиской
                </h3>
                <div>
                    <table style='width: 100%;'>
                        <tr>
                            <td>
                                <button id='button9' style='width: 100%; height: 30px; font-size: 12px; text-align: left;'>Подписаные темы</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button id='button10' style='width: 100%; height: 30px; font-size: 12px; text-align: left;'>Подписаные разделы </button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- ##################################### -->
            $menuModer
            $menuAdmin
        </td>
    </tr>";
}
else{
    echo "
        <td rowspan='2' style='width: 230px; vertical-align: top;'>
        <!-- Здесь будет аватарка -->
            <img src='$avatar' width='230px' border='1'/><br><br>";

    if($nameSession != "")
        echo "
            <script>
                $(function(){
                    $('#buttonSetFriend').button().click(function(){
                        setFriend('$nameSession', '$name');
                    });

                    $('#buttonSetDisdain').button().click(function(){
                        setDisdain('$nameSession', '$name');
                    });
                });
            </script>
            <button id='buttonSetFriend' style='width: 100%; height: 30px; font-size: 12px; text-align: left;'>Добавить в друзья</button>
            <br><br>
            <button id='buttonSetDisdain' style='width: 100%; height: 30px; font-size: 12px; text-align: left;'>Добавить в игнор</button>
        ";

    echo "
        </td>
    </tr>
    ";
}

echo "
    <tr>
        <td id='href' style='vertical-align: top;'>
            <div class='section'>
                <!-- Tabs -->
                <div id='tabs' style='background-color: #dddddd;'>
                    <ul>
                        <li><a href='#tabs-1'>
                            <div style='width: 165px; font-size: 15px;'>Обо мне</div>
                        </a></li>
                        <li><a href='#tabs-2'>
                            <div style='width: 165px; font-size: 15px;'>Статистика</div>
                        </a></li>
                        <li><a href='#tabs-3'>
                            <div style='width: 165px; font-size: 15px;'>Друзья</div>
                        </a></li>
                        <li><a href='#tabs-4'>
                            <div style='width: 165px; font-size: 15px;'>Связь</div>
                        </a></li>
                        <li><a href='#tabs-5'>
                            <div style='width: 165px; font-size: 15px;'>Активность на форуме</div>
                        </a></li>
                    </ul>
                    <div id='tabs-1' style='color: #000000;'>";
                        //include_once("tableInfoUser.php");
                        echo "
                    </div>
                    <div id='tabs-2' style='color: #000000;'>";
                        //include_once("tableStaticUser.php");
                        echo "
                    </div>
                    <div id='tabs-3' style='color: #000000;'>";
                        //include_once("tableFriendsUser.php");
                        echo "
                    </div>
                    <div id='tabs-4' style='color: #000000;'>";
                        //include_once("tableMassegeUser.php");
                        echo "
                    </div>
                    <div id='tabs-5' style='color: #000000;'>
                        Пока нет
                    </div>
                </div>
            </div>";

if($_sessionBL){
    echo "
            <div id='tableTabs' class='none'>
                <table style='width: 100%; border-radius: 6px; border: 1px solid #000000; background-color: #dddddd;'>
                    <tr>
                        <td style='width: 20px;'></td>
                        <td style='text-align: center;'>
                            <!-- ////////////////////////////////////////////// -->
                            <div id='tabs-6' class='none' >";
                                //include_once("tableEditorDataUser.php");
                                echo "
                            </div>
                            <!-- ////////////////////////////////////////////// -->
                            <div id='tabs-7' class='none' >";
                                //include_once("tableEditorAvatar.php");
                                echo "
                            </div>
                            <!-- ////////////////////////////////////////////// -->
                            <div id='tabs-8' class='none' >";
                                //include_once("tableEditorEmailAndPassword.php");
                                echo "
                            </div>
                            <!-- ////////////////////////////////////////////// -->
                            <div id='tabs-9' class='none' >";
                                //include_once("listDisdain.php");
                                echo "
                            </div>
                            <!-- ////////////////////////////////////////////// -->
                            <div id='tabs-10' class='none' >";
                                //include_once("tableNewLetter.php");
                                echo "
                            </div>
                            <!-- ////////////////////////////////////////////// -->
                            <!-- ////////////////////////////////////////////// -->
                            <div id='tabs-11' class='none' >";
                                //include_once("privateMailTake.php");
                                echo "
                            </div>
                            <!-- ////////////////////////////////////////////// -->
                            <div id='tabs-12' class='none' >";
                                //include_once("privateMailSend.php");
                                echo "
                            </div>
                            <!-- ////////////////////////////////////////////// -->
                            <div id='tabs-13' class='none' ></div>
                            <!-- ////////////////////////////////////////////// -->
                            <div id='tabs-14' class='none' >
                                            Здесь будет изменнение данных 10
                            </div>
                            <!-- ////////////////////////////////////////////// -->
                            <div id='tabs-15' class='none' >
                                            Здесь будет изменнение данных 11
                            </div>
                            <!-- ////////////////////////////////////////////// -->
                            <div id='tabs-16' class='none' >
                                            Здесь будет изменнение данных 12
                            </div>
                            <!-- ////////////////////////////////////////////// -->
                                $tableModer
                                $tableAdmin
                         </td>
                    </tr>
                </table>
            </div>";
}

echo "
        </td>
    </tr>
</table>
<br><br>
";


// Для отправки писма
if($_GET['mail'] != ""){
    // Для просмотра почты
    if($_GET['mail'] == "show"){
        echo "
        <script>
        $(function() {
            if(document.getElementById('accordionMenu3'))
            $( '#accordionMenu3' ).accordion({active: 0});

            if(document.getElementById('button6'))
            $( '#button6' ).button().click();
        });
        </script>
        ";
    }
    else{
        $privateMailUserName = $_GET['mail'];

        echo "
        <script>
        $(function() {
            document.getElementById('receiveMail').value = $privateMailUserName;
            document.getElementById('iconTableNewLetterUserYes').className = 'block';

            if(document.getElementById('accordionMenu3'))
            $( '#accordionMenu3' ).accordion({active: 0});

            if(document.getElementById('button5'))
            $( '#button5' ).button().click();
        });
        </script>
    ";
    }
}

*/