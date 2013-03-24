<!-- Подключение php -->
<?php
session_start();
include_once("php/functionPHP.php");
include_once('php/Qp/includeQP.php');
?>
<!-- ############################################### -->
<!-- Форум тестовый сайт на html php css javascript  -->
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Форум</title>

    <!-- Подключение стилей -->
    <style type="text/css">
        @import "css/forumStyle/index.css";
        <?php Qp\QPush::getStyle(__DIR__,'import'); ?>
        @import "jQuery/css/ui-darkness/jquery-ui-1.9.2.custom.css";
    </style>

    <!-- Подключение javaScript -->
    <script src="js/functionJS.js"></script>
    <script type='text/javascript' src='jQuery/js/jquery-1.8.3.js'></script>
    <script type='text/javascript' src='jQuery/js/jquery-ui-1.9.2.custom.js'></script>
    <script type='text/javascript' src='jQuery/js/jquery-ui-1.9.2.custom.min.js'></script>

    <!-- Icon title -->
    <link rel="icon" type="files_ru/image/png" href="css/forumStyle/images/logo.png" />
    <link rel="shortcut icon" type="image/png" href="css/forumStyle/images/logo.png" />
</head>

<!-- ############################################### -->

<body>
<table width="98%" height="100%" cellpadding='0' cellspacing='0' style="margin-left: 1%;">
    <tr>
        <td style="height: 20px;" class="radiusTopLeft10 radius10TopRight borderColor"></td>
        <td style="width: 1px"></td>
        <td style="height: 20px;" class="radiusTopLeft10 radius10TopRight borderColor"></td>
    </tr>
    <tr>
        <td class="background">
            <table cellpadding='15px' cellpadding='0' cellspacing='0'>
                <tr>
                    <td>
                        <a href="/"> <img src="css/forumStyle/images/logo.png" width="85px" align="middle"></a>
                    </td>
                    <td style="text-align: center;">
                        <b>Форум программистов</b><br>
                        <b style="font-size: 9px;">(пример форума)</b>
                    </td>
                </tr>
            </table>
        </td>
        <td style="width: 1px"></td>

        <td style="width: 250px; height: 100px;" class="background">
            <?php
            if($_SESSION['userName'] == "")
                include("php/formAuthorization.php");
            else{
                include("php/formUserAfterAuthorization.php");
            }
            ?>
        </td>
    </tr>
    <tr>
        <td style="height: 20px;" class="radius10Left radius10Right borderColor"></td>
        <td style="width: 1px"></td>
        <td style="height: 20px;" class="radius10Left radius10Right borderColor"></td>
    </tr>
    <tr>
        <td colspan="3">
            <!-- =========================================================================== -->
            <center><?php include_once("php/tablePrivateOffice.php"); ?></center>
            <!-- =========================================================================== -->
        </td>
    </tr>
    <tr><td colspan="3" style="height: 20px;" class="radiusTopLeft10 radius10TopRight borderColor"></td></tr>
    <tr>
        <td colspan="3" class="background" style="text-align: center; height: 1px;">
            <b style="font-size: 7px;"><br></b>
            <b>Кто на форуме</b><br>
            <b style="font-size: 9px;">( онлайн: <?php echo allUserOnline(); ?> )</b>
            <hr>
            <?php
            $userOnline = getUserOnline();
            foreach($userOnline as $key=>$value){
                if($value == 'moder'){
                    echo "<a class='moder' href='privateOffice.php?userName=$key'> ".$key." </a>";
                }
                elseif($value == 'admin'){
                    echo "<a class='admin' href='privateOffice.php?userName=$key'> ".$key." </a>";
                }
                elseif($value == 'user'){
                    echo "<a class='user' href='privateOffice.php?userName=$key'> ".$key." </a>";
                }
            }
            ?>
            <hr>
        </td>
    </tr>
    <tr>
        <td colspan="3" style="height: 20px;" class="radius10Left radius10Right borderColor">
        </td>
    </tr>
    <tr><td style="height: 10px;"></td></tr>
    <tr><td colspan="3" style="height: 20px;" class="radiusTopLeft10 radius10TopRight borderColor"></td></tr>
    <tr>
        <td colspan="3" style="height: 150px;" class="background">
            <table cellpadding='15px' cellpadding='0' cellspacing='0' width=100%>
                <tr>
                    <td style="text-align: center; width: 90px;">
                        <img src="css/forumStyle/images/logo.png" width="85px" align="middle">
                    </td>
                    <td style="text-align: center; width: 200px;">
                        <b>Форум программистов</b><br>
                        <b style="font-size: 9px;">(пример форума)</b>
                    </td>
                    <td style="text-align: right;">
                        <b>Форум программистов, компьютерный форум, программирование</b>
                        <br>
                        <br>
                        <br>
                        Создатель KeyGen Version 1.0 GPL2
                        <br>
                        Copyright © 2000 - 2013
                        <br>
                        Связь: <a href="index.php">KeyGen</a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr><td colspan="3" style="height: 20px;" class="radius10Left radius10Right borderColor"></td></tr>
</table>
</body>

<!-- ############################################### -->
</html>
