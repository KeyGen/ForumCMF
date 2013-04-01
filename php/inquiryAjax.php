<?php
// Включаем сессию
session_start();

// Подключаем библиотеку
include_once('Qp/includeQP.php');

// Подключаем класс QBD
$dbUsers = new \Qp\QBD('keygen','12345','bdForum','users');
$dbPrivateMail = new \Qp\QBD('keygen','12345','bdForum','mail');

// Тело сообщений
$bodyEmail = "
<style>
body { font-family: Arial, Tahoma; color:#000; font-size:14px;}
.radiusTopLeft10 { border-radius: 10px 0px 0px 0px }
.radius10TopRight { -moz-border-radius-topright: 10px; -webkit-border-top-right-radius: 10px; -khtml-border-top-right-radius: 10px; border-top-right-radius: 10px; }
.radius10Left { -moz-border-radius-bottomleft: 10px; -webkit-border-bottom-left-radius: 10px; -khtml-border-bottom-left-radius: 10px; border-bottom-left-radius: 10px; }
.radius10Right { -moz-border-radius-bottomright: 10px; -webkit-border-bottom-right-radius: 10px; -khtml-border-bottom-right-radius: 10px; border-bottom-right-radius: 10px; }
.background {background-image: url('http://www.test.net/css/images/titleBackground.png') !important;}
A {text-decoration: none;}A:hover {text-decoration: underline; color: red;}
</style>
<table cellspacing='0' style='width: 100%;'>
    <tr>
        <td style='height: 10px; background-color: #4a434b;' class='radiusTopLeft10 radius10TopRight'></td>
    </tr>
    <tr>
        <td style='background-color: #f6931f;' class='background'>
            <table cellpadding='15px' cellpadding='0' cellspacing='0' style='width: 100%;'>
                <tr>
                    <td style='width: 10%;'>
                        <a href='http://www.test.net'> <img src='http://images.sevstar.net/images/49989624223350433883.png' width='50px' align='middle'></a>
                    </td>
                    <td style='text-align: center; font-size: 13px; font-weight: bold; width: 25%'>
                        <b>Форум&nbsp;программистов</b>
                        <br>
                        <b style='font-size: 9px;'>(пример форума)</b>
                    </td>
                    <td style='text-align: center; font-weight: bolder; font-size: 16px; color: #555555; width: 65%;'>
                        titleHtml
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr><td style='height: 10px; background-color: #4a434b;' class='radius10Right radius10Left'></td></tr>
</table>
<table style='width: 100%; height: 200px; margin: 20px;'>
    <tr>
        <td style='width: 10%;'></td>
        <td style='text-align: center; border: 2px solid #5c5c5c; border-radius: 10px;'>
            <div>
                <b>Это писмо отправленно автоматически. Не отвечайте на него.</b>
                <p>bodyHtml</p>
                <p><a href='hrefUserControlEmail'>hrefUserControlEmail</a></p>
            </div>
        </td>
        <td style='width: 10%;'></td>
    </tr>
</table>
<table cellspacing='0' style='width: 100%;'>
    <tr><td style='height: 10px; background-color: #4a434b;' class='radiusTopLeft10 radius10TopRight'></td></tr>
    <tr>
        <td style='background-color: #f6931f;' class='background'>
            <table cellpadding='15px' cellpadding='0' cellspacing='0' style='width: 100%;'>
                <tr>
                    <td style='width: 10%;'>
                        <a href='http://www.test.net'> <img src='http://images.sevstar.net/images/49989624223350433883.png' width='50px' align='middle'></a>
                    </td>
                    <td style='text-align: center; font-size: 13px; font-weight: bold; width: 25%'>
                    <b>Форум&nbsp;программистов</b>
                    <br>
                    <b style='font-size: 9px;'>(пример форума)</b>
                    </td>
                    <td style='text-align: right; font-size: 13px;'>
                        <b>Форум программистов, компьютерный форум, программирование</b>
                        <br>
                        <br>
                        Создатель KeyGen Version 1.0 GPL2
                        <br>
                        Copyright 2000 - 2013
                        <br>
                        Связь:
                        <a href='http://www.test.net'>KeyGen</a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr><td style='height: 10px; background-color: #4a434b;' class='radius10Right radius10Left'></td></tr>
</table>
";

// Обработка Ajax запросов
switch($_POST['inquiry']){
    case 'QCodeColor':
        echo QCodeColor();
    exit;
    case 'exitUser':
        exitUser();
    exit;
    case 'entryUser':
        echo entryUser();
    exit;
    case 'getGenPassword':
        echo getGenPassword();
    exit;
    case 'testData':
        echo testData();
    exit;
    case 'testPassword':
        echo testPassword();
    exit;
    case 'testEmail':
        echo testEmail();
    exit;
    case 'userRegistration':
        echo userRegistration();
    exit;
    case 'saveSetAvatar':
        echo saveSetAvatar();
    exit;
    case 'setInfoUser':
        echo setInfoUser();
    exit;
}

function setInfoUser(){

    $dataCase = $_POST['array']['dataCase'];
    $data = $_POST['array']['data'];
    $name = $_POST['array']['name'];
    $id = $_POST['array']['code'];

    global $dbUsers;

    // Защита в действии :)
    if($dbUsers->getDataOne('id',$id,'name') == $name){
        // Еще одна защита...
        $defenceArr = array(
            'realName',
            'specialization',
            'computerConfiguration',
            'location',
            'interests',
            'occupation',
            'recordOfService',
            'signature');

        $defence = false;
        foreach($defenceArr as $value) {if($value == $dataCase) {$defence = true; break;}}

        if($defence) $dbUsers->setDataOne('name', $name, $dataCase, $data);
        else violation();

    } else{
        return violation();
    }

    return "true";
}

function QCodeColor(){
    $codeColor = new Qp\QStringColor('700px', '400px');
    return $codeColor->getCodeTeg($_POST['array']['text']);
}

function exitUser(){
    global $dbUsers;
    $dbUsers->setDataOne('name', $_SESSION['userName'], 'status', 'no-line');
    unset($_SESSION['userName']); // Чистка $_SESSION
}

function getGenPassword(){
    $codeGen = new \Qp\QCodeGen(12);
    $codeGen->genCodeEng_Number();
    return $codeGen->getCode();
}

function testData(){
    global $dbUsers;

    $case = $_POST['array']['find'];
    $valueCase = $_POST['array']['value'];

    // Возможно надо пересмотреть защиту
    $bool = false;
    $arrCell = array('name'=>20,'email'=>40,'password'=>20);

    foreach($arrCell as $key=>$value) {if($case == $key) {$bool = true; break;}}

    if(!$bool)
        return "Ключь не найден!";

    if(strlen($valueCase)>$arrCell[$case])
        return "Превышен допустимый размер!";

    if($case == 'password'){
        $valueCase = passwordMd5($valueCase);
    }

    return $dbUsers->getQuantityRepetition($case, $valueCase);
}

function testPassword(){
    $testReg = new Qp\QTestString($_POST['array']['password']);
    return $testReg->password();
}

function testEmail(){
    $testReg = new Qp\QTestString($_POST['array']['email']);
    return $testReg->email();
}

function entryUser(){
    $name = $_POST['array']['name'];
    $password = $_POST['array']['password'];

    if(!$name){
        return "Введите имя!";
    }
    elseif(!$password){
        return "Введите пароль!";
    } else {
        global $dbUsers;
        $dataUser = $dbUsers->getDataName($name);

        if(is_array($dataUser) && isset($dataUser[0])){
            if($dataUser[0]['status'] == 'on-line'){
                return 'Пользователь под таким именем уже осуществил вход!';
            }
            elseif(substr_count($dataUser[0]['status'],'controlEmail')){
                return 'От пользователя ожидается переход по ссылке, для подтверждения email.';
            }
            elseif($dataUser[0]['password'] == passwordMd5($password)){
                $_SESSION['userName'] = $name;
                $dbUsers->setDataOne('name', $name, 'status', 'on-line');
                return "true";
            }
            else {
                return "Пароль не верен!";
            }
        }
        else{
            return "Пользователь не найден!";
        }
    }
}

function userRegistration(){
    global $dbUsers;

    if($_POST['array']['captcha'] != $_SESSION['captchaCode']){
        return "captchaFalse";
    }
    elseif($dbUsers->getQuantityRepetition('name', $_POST['array']['name'])){
        return "Пользователь существует попробуйте изменить имя.";
    }
    elseif($dbUsers->getQuantityRepetition('email', $_POST['array']['email'])){
        return "Email существует попробуйте ввести другой.";
    }
    else {
        //unset($_SESSION['captchaCode']); // Чистка $_SESSION
        $name = $_POST['array']['name'];
        $password = $_POST['array']['password'];
        $email = $_POST['array']['email'];
    }

    $date = date("H:i:s d.m.Y");        // Дата регистрации
    $status = 'controlEmail?'.time();   // Статус пользователя
    $ip = $_SERVER['REMOTE_ADDR'];      // ip пользователя
    $password = passwordMd5($password); // Хешируем пароль

    // Получем случайную аватарку
    $getAvatar = new Qp\QDir(__DIR__."/../resources/defaultAvatar");
    $arrAvatar = $getAvatar->entryListFiles("png/jpg/gif");
    $newAvatar = 'resources/defaultAvatar/'.$arrAvatar[rand(0, count($arrAvatar) - 1)];

    $setLine = array(
        'ip'=>$ip,
        'name'=>$name,
        'password'=>$password,
        'email'=>$email,
        'avatar'=>$newAvatar,
        'status'=>$status,
        'registration'=>$date
    );

    // Добавление в базу данных нового пользователя
    $dbUsers->setLine($setLine);
    $id = $dbUsers->getDataOne('name',$name,'id');

    global $bodyEmail;
    $body = $bodyEmail;

    $hrefUserControlEmail = "http://www.test.net/registration.php?user=".$name."&id=".$id;

    $body = str_replace('titleHtml', 'Регистрация', $body);
    $body = str_replace('hrefUserControlEmail', $hrefUserControlEmail, $body);
    $body = str_replace('bodyHtml', 'Для завершения регистрации перейдите по ссылке расположенной ниже: ', $body);

    $emailNewUser = new Qp\QMail('forum@test.ru', $email);
    $emailNewUser->setHtml(true);
    $emailNewUser->setSubject('Регистрация на форуме');
    $emailNewUser->setNameFrom('Форум программистов');
    $emailNewUser->setNameTo($name);
    $emailNewUser->sendExecMail($body);

    return "true";
}

// установка нового аватара для пользователя
/*для защиты от козлов + для имени (id всегда уникален)*/
function saveSetAvatar(){

    $img = $_POST['array']['img'];
    $name = $_POST['array']['name'];
    $id = $_POST['array']['code'];

    global $dbUsers;
    $return = "true";

    // Защита в действии :)
    if($dbUsers->getDataOne('id',$id,'name') == $name){
        $hrefImg = "../resources/tempAvatar/".$img;
        $widening = explode('.',$img);
        $ok = "resources/avatarUser/".$id.".".$widening[1];
        $hrefImgSave = "../".$ok;

        // Удаляем старую картинку
        unlink("../".$dbUsers->getDataOne('id',$id,'avatar'));

        if (!copy($hrefImg, $hrefImgSave)) {
            $return = "Картинка не изменена";
        }
        else{
            $return = $ok;
            $dbUsers->setDataOne('name',$name,'avatar',$ok);
        }

        if(!unlink($hrefImg))
            $return = "Картинка не удалена! $hrefImg";
    }
    else{
        $return = violation();
    }

    return $return;
}
// установка нового аватара для пользователя....

function violation(){
    $return = "Замеченно нарушение. Твой ip гаденыш в бане!";
    return $return;
}

function passwordMd5($password){

    $password = md5($password);
    $password = strrev($password);
    $password = $password."a515f899ef822";

    return $password;
}