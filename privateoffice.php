<!-- Подключение php -->
<?php
session_start();
include_once('php/Qp/includeQP.php');
// Подключаем класс QBD
$bdUsers = new \Qp\QBD('keygen','12345','bdForum','users');
$bdPrivateMail = new \Qp\QBD('keygen','12345','bdForum','mail');
?>
<!-- ############################################### -->
<!-- Форум тестовый сайт на html php css javascript  -->
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Форум</title>

    <!-- Подключение стилей -->
    <style type="text/css">
        @import "css/style.css";
        <?php Qp\QPush::getStyle(__DIR__,'import'); ?>
        @import "jQuery/css/ui-darkness/jquery-ui-1.9.2.custom.css";
    </style>

    <!-- Подключение javaScript -->
    <script src="js/function.js"></script>
    <script type='text/javascript' src='jQuery/js/jquery-1.8.3.js'></script>
    <script type='text/javascript' src='jQuery/js/jquery-ui-1.9.2.custom.js'></script>
    <script type='text/javascript' src='jQuery/js/jquery-ui-1.9.2.custom.min.js'></script>

    <!-- Icon title -->
    <link rel="icon" type="files_ru/image/png" href="css/images/logo.png" />
    <link rel="shortcut icon" type="image/png" href="css/images/logo.png" />
</head>

<!-- ############################################### -->

<body>

<!-- ############## Модальны диалог ################# -->
<div style="display: none;" id="dialog-message"><p id='dialog-body'></p></div>
<!-- ############################################### -->

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
                        <a href="/"> <img src="css/images/logo.png" width='85px' align='middle'></a>
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
            if (!isset($_SESSION['userName']))
                include("php/tableAuthorization.php");
            else
                include("php/tableAfterAuthorization.php");
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
            <br>
            <?php include_once('php/tablePrivateOffice.php') ?>
            <br>
            <!-- =========================================================================== -->
        </td>
    </tr>
    <tr><td colspan="3" style="height: 20px;" class="radiusTopLeft10 radius10TopRight borderColor"></td></tr>
    <tr>
        <td colspan="3" class="background" style="text-align: center; height: 1px;">
            <b style="font-size: 7px;"><br></b>
            <b>Кто на форуме</b><br>
            <b style="font-size: 9px;">( онлайн: <?php echo $bdUsers->getQuantityRepetition('status','on-line'); ?> )</b>
            <hr>
            <?php

            foreach($bdUsers->getDataCell('title', 'admin') as $arr){
                if($arr['status'] == 'on-line')
                    echo "<a class='admin' href='privateoffice.php?user=".$arr['name']."'> ".$arr['name']." </a>";
            }
            foreach($bdUsers->getDataCell('title', 'moder') as $arr){
                if($arr['status'] == 'on-line')
                    echo "<a class='moder' href='privateoffice.php?user=".$arr['name']."'> ".$arr['name']." </a>";
            }
            foreach($bdUsers->getDataCell('title', 'user') as $arr){
                if($arr['status'] == 'on-line')
                    echo "<a class='user' href='privateoffice.php?user=".$arr['name']."'> ".$arr['name']." </a>";
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
                        <img src="css/images/logo.png" width="85px" align="middle">
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
