<?php
session_start();

switch($_POST['function']){
    case '':
        break;
    case 'authorizationUser':
        echo authorizationUser($_POST["name"],$_POST["password"]);
        exit;
    case 'exitUser':
        echo exitUser();
        exit;
    case 'delDisdain':
        echo delDisdain($_POST['userName'],$_POST['disdainName']);
        exit;
    case 'delFriend':
        echo delFriend($_POST['userName'],$_POST['friendName']);
        exit;
    case 'setDisdain':
        echo setDisdain($_POST['userName'],$_POST['disdainName']);
        exit;
    case 'setFriend':
        echo setFriend($_POST['userName'],$_POST['friendName']);
        exit;
    case 'genPassword':
        echo genPassword(10);
        exit;
    case 'setPrivateMail':
        echo setPrivateMail($_POST['theme'],$_POST['sender'],$_POST['addressee'], $_POST['mail']);
        exit;
    case 'testNik':
        echo testNik($_POST["nik"]);
        exit;
    case 'saveSetAvatar':
        echo saveSetAvatar($_POST['img'],$_POST['name']);
        exit;
    case 'setUser':
        if($_SESSION['captchaCode'] != $_POST['captchaCode']){
            echo "false";
        }
        else{
            echo setUser($_SERVER['REMOTE_ADDR'], $_POST['username'], $_POST['password'], $_POST['email'], getRandAvatarDefault());
        }
        exit;
    case 'setDataOne':
        if($_SESSION['userName'] == $_POST['name'] || getUserUniversal($_SESSION['userName'],'title') == 'admin'){
            echo setDataOne($_POST['data'],$_POST['id'],$_POST['name']);
        }
        else{
            echo "false";
        }
        exit;
    case 'testPassword':
        echo testPassword($_POST["password"]);
        exit;
    case 'testPasswordUser':
        echo testPasswordUser($_POST['name'], $_POST['password']);
        exit;
    case 'reconstructionPassword':
        echo reconstructionPassword($_POST['name']);
        exit;
    case 'testEmail':
        echo testEmail($_POST["email"]);
        exit;
    case 'getTextPrivateMail':
        if($_SESSION['userName'] == $_POST['name']){
            echo getTextPrivateMail($_POST['id'], $_POST['idTake']);
        }
        elseif(getUserUniversal($_SESSION['userName'],'title') == 'admin'){
            echo getTextPrivateMail($_POST['id'], 'take');
        }
        else{
            echo "false";
        }
        exit;

}

// Получение имен пользователей и его статуса на форуме  ----------------- begin -----------------
function getUserOnline(){
    $user = array();

    $connection = mysql_connect("localhost", "keygen", "12345")
        or die("Error connect");

    $db = mysql_select_db("bdForum", $connection)
        or die("Error connect db");

    $query = "SELECT * FROM users WHERE status='on-line'";

    $result = mysql_query($query)
        or die ("Error запрос".mysql_error());

    mysql_close();


    while($arr =mysql_fetch_array($result)){
        $name = $arr['name'];
        $title = $arr['title'];
        $user[$name] = $title;
    }

    return $user;
}
// Получение имени пользователя и его статуса на форуме  ----------------- end -----------------

// Подсчет онлайн пользователей проверка в базе ----------------- begin -----------------
function allUserOnline(){

    $connection = mysql_connect("localhost", "keygen", "12345")
        or die("Error connect");

    $db = mysql_select_db("bdForum", $connection)
        or die("Error connect db");

    $query = "SELECT * FROM users WHERE status='on-line'";

    $result = mysql_query($query)
        or die ("Error запрос".mysql_error());

    mysql_close();

    $i = 0;
    while(mysql_fetch_array($result))
        $i++;

    return $i;
}
// Подсчет онлайн пользователей проверка в базе ----------------- end -----------------

function getUserOnluneCPlusPlusBeginner(){
    return 100;
}

// Проверка имя пользователя по базе ----------------- begin -----------------
function testNik($nik){

    if(testNikString($nik))
        return "true";

    $connection = mysql_connect("localhost", "keygen", "12345")
        or die("Error connect");

    $db = mysql_select_db("bdForum", $connection)
        or die("Error connect db");

    $query = "SELECT * FROM users WHERE name='$nik'";

    $result = mysql_query($query)
            or die ("Error запрос".mysql_error());

    mysql_close();

    if(count(mysql_fetch_array($result)) > 1)
        return "true";
    else
        return "false";
}
// Проверка имя пользователя по базе ----------------- end -----------------

// Проверка имя пользователя на разумность :) ----------------- begin -----------------
function testNikString($nik){

    if(preg_match("/(^[a-zA-Z0-9]+([a-zA-Z\_0-9\.-]*))$/" , $nik)==NULL)
        return true;

    return false;
}
// Проверка имя пользователя на разумность :) ----------------- end -----------------

// Проверка email по базе ----------------- begin -----------------
function testEmail($email){

    if(testEmailString($email))
        return "true";

    $connection = mysql_connect("localhost", "keygen", "12345")
        or die("Error connect");

    $db = mysql_select_db("bdForum", $connection)
        or die("Error connect db");

    $query = "SELECT * FROM users WHERE email='$email'";

    $result = mysql_query($query)
        or die ("Error запрос".mysql_error());

    mysql_close();

    if(count(mysql_fetch_array($result)) > 1)
        return "true";
    else
        return "false";
}
// Проверка email по базе ----------------- end -----------------

// Проверка email строки ----------------- begin -----------------
function testEmailString($email){

    if(preg_match('/^((\"[^\"\f\n\r\t\v\b]+\")|([\w\!\#\$\%\&\'\*\+\-\~\/\^\`\|\{\}]+(\.[\w\!\#\$\%\&\'\*\+\-\~\/\^\`\|\{\}]+)*))@((\[(((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9])))\])|(((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9])))|((([A-Za-z0-9\-])+\.)+[A-Za-z\-]+))$/D', $email)){
        return false;
    }
    else
        return true;
}
// Проверка email строки ----------------- end -----------------

// Проверка пароля на разумность :) ----------------- begin -----------------
function testPassword($password){

    if (preg_match("/(^[a-zA-Z0-9]+([a-zA-Z\_0-9\.-]*))$/" , $password)==NULL)
        return "false";
    else
        return "true";
}
// Проверка пароля на разумность :) ----------------- end -----------------

// Генерация пароля ----------------- begin -----------------
function genPassword($number = 8){
    // Параметр $number - сообщает число
    // символов в пароле
    $arr = array('a','b','c','d','e','f',
        'g','h','i','j','k','l',
        'm','n','o','p','r','s',
        't','u','v','x','y','z',
        'A','B','C','D','E','F',
        'G','H','I','J','K','L',
        'M','N','O','P','R','S',
        'T','U','V','X','Y','Z',
        '1','2','3','4','5','6',
        '7','8','9','0');
// Генерируем пароль
    $pass = "";
    for($i = 0; $i < $number; $i++)
    {
        // Вычисляем случайный индекс массива
        $index = rand(0, count($arr) - 1);
        $pass .= $arr[$index];
    }

    return $pass;
}
// Генерация пароля ----------------- end -----------------

// Выбор случайной аватарки ----------------- begin -----------------
function getRandAvatarDefault(){

    $arr = array('resources/avatar/defaultFive.png',
                'resources/avatar/defaultFour.png',
                'resources/avatar/defaultOne.png',
                'resources/avatar/defaultThree.png',
                'resources/avatar/defaultTwo.png');

    $index = rand(0, count($arr) - 1);
    return $arr[$index];
}
// Выбор случайной аватарки ----------------- end -----------------

// Регистрация пользователя ----------------- begin -----------------
// echo setUser($_SERVER['REMOTE_ADDR'], $_POST['username'], $_POST['password'], $_POST['email'], getRandAvatarDefault());
function setUser($ip, $name, $password, $email, $avatar){

    $date = date("H:i:s d.m.Y");
    $controlEmail = 'controlEmail?'.time();
    $connection = mysql_connect("localhost", "keygen", "12345")
        or die("Error connect");

    $db = mysql_select_db("bdForum", $connection)
        or die("Error connect db");

    $password = getMd5($password);

    $query = "INSERT INTO users (ip, name, password, email, avatar, status, registration)
    VALUES ('$ip', '$name', '$password', '$email', '$avatar', '$controlEmail', '$date')";

    $result = mysql_query($query) or die ("Error: ".mysql_error());

    mysql_close();

    if(!sendEmail($email,$name))
        return "Письмо не отправлено!";

    return "true";
}
// Регистрация пользователя ----------------- end -----------------

// Адаптация сообщения ---- begin ----
function editingMailSymbol($text){

    $text = str_replace(' ', '&nbsp;',$text);
    $text = str_replace('\'','&apos;',$text);
    $text = str_replace('\"','&quot;',$text);
    $text = str_replace('<', '&lt;',  $text);
    $text = str_replace('>', '&gt;',  $text);

    return $text;
}
// Адаптация сообщения ---- end ----

// Подкраска кода C++ -- begin --
function editCodeCPlusPlus($text){

    return $text;
}
// Подкраска кода C++ -- begin --

// Добавление сообщения в базу ----------------- begin -----------------
function setPrivateMail($theme, $sender, $addressee, $mail){

    $alertAdmin = "true";
    $BL = true;
    $disdain = getUserUniversal($addressee,'disdain');
    $disdain = explode('/',$disdain);

    for($i = 0; $i<count($disdain); $i++){
        if($sender == $disdain[$i]){
            $BL = false;
            $alertAdmin = "Писмо отправленно!\nАдминам можно все!\nНо пользователь $addressee добавил вас в список игнорирования.";
        }
    }

    if($BL || getUserUniversal($sender,'title') == 'admin'){
        $mail = editingMailSymbol($mail);
        $dateLocal = date("H:i:s d.m.Y");
        $connection = mysql_connect("localhost", "keygen", "12345")
            or die("Error connect");

        $db = mysql_select_db("bdForum", $connection) or die("Error connect db");

        $query = "INSERT INTO mail (theme, sender, addressee, mail, date) VALUES ('$theme', '$sender', '$addressee', '$mail', '$dateLocal')";

        $result = mysql_query($query) or die ("Error: ".mysql_error());

        mysql_close();

        return $alertAdmin;
    }
    else{
        return "Невозможно отправить!\nПользователь $addressee добавил вас в список игнорирования.";
    }
}
// Добавление сообщения в базу ----------------- begin -----------------

// Подсчет количества новых приватных сообщений ----------------- begin -----------------
function getAmountPrivateNewMail($name){

    $connection = mysql_connect("localhost", "keygen", "12345")
        or die("Error connect");

    $db = mysql_select_db("bdForum", $connection)
        or die("Error connect db");

    $query = "SELECT * FROM mail WHERE status='notRead' AND addressee='$name'";

    $result = mysql_query($query)
        or die ("Error запрос".mysql_error());

    mysql_close();

    $i = 0;
    while(mysql_fetch_array($result)){
        $i++;
    }

    return $i;
}
// Подсчет количества новых приватных сообщений ----------------- end -----------------

// Подсчет количества всех входящих приватных сообщений ----------------- begin -----------------
function getAmountPrivateAllMail($name, $id = 'addressee'){

    $connection = mysql_connect("localhost", "keygen", "12345")
        or die("Error connect");

    $db = mysql_select_db("bdForum", $connection)
        or die("Error connect db");

    $query = "SELECT * FROM mail WHERE $id='$name'";

    $result = mysql_query($query)
        or die ("Error запрос".mysql_error());

    mysql_close();

    $i = 0;
    while(mysql_fetch_array($result)){
        $i++;
    }

    return $i;
}
// Подсчет количества всех входящих приватных сообщений ----------------- end -----------------

// Получение загаловков сообщений ----------------- begin -----------------
function getTitlePrivateMail($name, $id = 'addressee'){

    $titleMail = array();

    $connection = mysql_connect("localhost", "keygen", "12345")
        or die("Error connect");

    $db = mysql_select_db("bdForum", $connection)
        or die("Error connect db");

    $query = "SELECT * FROM mail WHERE $id='$name'";

    $result = mysql_query($query)
        or die ("Error запрос".mysql_error());

    mysql_close();

    while($arr = mysql_fetch_array($result)){

        $id = $arr['id'];
        $status = $arr['status'];
        $date = $arr['date'];
        $theme = $arr['theme'];
        $sender = $arr['sender'];

        $tempArr['id'] = $id;
        $tempArr['status'] = $status;
        $tempArr['date'] = $date;
        $tempArr['theme'] = $theme;
        $tempArr['sender'] = $sender;

        $titleMail[] = $tempArr;
    }

    return $titleMail;
}
// Получение загаловков сообщений ----------------- end -----------------

// Получение текста сообщения  по иду ----------------- begin -----------------
function getTextPrivateMail($id, $idTake){

    $connection = mysql_connect("localhost", "keygen", "12345") or die("Error connect");
    $db = mysql_select_db("bdForum", $connection) or die("Error connect db");

    $query = "SELECT * FROM mail WHERE id='$id'";

    $result = mysql_query($query) or die ("Error запрос".mysql_error());

    mysql_close();

    if($idTake == 'sender')
    setPrivateMailRead($id);

    while($arr = mysql_fetch_array($result)){
        return $arr['mail'];
    }

    return "false";
}
// Получение текста сообщения  по иду ----------------- end -----------------

// Отмечаем приватное письмо как прочитанное
function setPrivateMailRead($id){
    $connection = mysql_connect("localhost", "keygen", "12345") or die("Error connect");
    $db = mysql_select_db("bdForum", $connection) or die("Error connect db");

    $query = "UPDATE mail SET status='read' WHERE id='$id'";

    $result = mysql_query($query) or die ("Error email update: ".mysql_error());
    mysql_close();
}

// Отправка emil ----------------- begin -----------------
function sendEmail($email, $name){

    $pageGen = pageConfirmationGen($name);

    $subject = 'Регистрация local Forum';

    $message = "
    <div style='color: red'> Это письмо было создано автаматически не отвечайте на него!</div>
    <br>
    <b>Для завершения регистрации перейдите по ссылке:</b><br><br><a href='$pageGen'>$pageGen</a>";

    $headers = 'localForum@example.com';

    return send_mime_mail('Local Forum',$headers, $name, $email, 'utf-8', 'utf-8', $subject, $message,true);
}

function send_mime_mail($name_from, // имя отправителя
                        $email_from, // email отправителя
                        $name_to, // имя получателя
                        $email_to, // email получателя
                        $data_charset, // кодировка переданных данных
                        $send_charset, // кодировка письма
                        $subject, // тема письма
                        $body, // текст письма
                        $html = FALSE, // письмо в виде html или обычного текста
                        $reply_to = FALSE
) {
    $to = mime_header_encode($name_to, $data_charset, $send_charset)
        . ' <' . $email_to . '>';
    $subject = mime_header_encode($subject, $data_charset, $send_charset);
    $from =  mime_header_encode($name_from, $data_charset, $send_charset)
        .' <' . $email_from . '>';
    if($data_charset != $send_charset) {
        $body = iconv($data_charset, $send_charset, $body);
    }
    $headers = "From: $from\r\n";
    $type = ($html) ? 'html' : 'plain';
    $headers .= "Content-type: text/$type; charset=$send_charset\r\n";
    $headers .= "Mime-Version: 1.0\r\n";
    if ($reply_to) {
        $headers .= "Reply-To: $reply_to";
    }
    return mail($to, $subject, $body, $headers);
}

function mime_header_encode($str, $data_charset, $send_charset) {
    if($data_charset != $send_charset) {
        $str = iconv($data_charset, $send_charset, $str);
    }
    return '=?' . $send_charset . '?B?' . base64_encode($str) . '?=';
}

// Отправка emil ----------------- end -----------------

function getMd5($password){
    ////////////////-- md5 --////////////////////
    $password = md5($password);
    $password = strrev($password);
    $password = $password."a515f899ef822";
    //////////////////////////////////
    return $password;
}

function getId($name){

    $connection = mysql_connect("localhost", "keygen", "12345")
        or die("Error connect");

    $db = mysql_select_db("bdForum", $connection)
        or die("Error connect db");

    $query = "SELECT * FROM users WHERE name='$name'";

    $result = mysql_query($query)
        or die ("Error запрос".mysql_error());

    mysql_close();

    $arr = mysql_fetch_array($result);

    if(!empty($arr)){
        return $arr['id'];
    }
    else{
        return "";
    }
}

function getAvatar($name){

    $connection = mysql_connect("localhost", "keygen", "12345")
        or die("Error connect");

    $db = mysql_select_db("bdForum", $connection)
        or die("Error connect db");

    $query = "SELECT * FROM users WHERE name='$name'";

    $result = mysql_query($query)
        or die ("Error запрос".mysql_error());

    mysql_close();

    $arr = mysql_fetch_array($result);

    if(!empty($arr)){
        return $arr['avatar'];
    }
    else{
        return "";
    }
}

function getUserUniversal($name, $cell){

    $connection = mysql_connect("localhost", "keygen", "12345")
        or die("Error connect");

    $db = mysql_select_db("bdForum", $connection)
        or die("Error connect db");

    $query = "SELECT * FROM users WHERE name='$name'";

    $result = mysql_query($query)
        or die ("Error запрос".mysql_error());

    mysql_close();

    $arr = mysql_fetch_array($result);

    if(!empty($arr)){
        return $arr[$cell];
    }
    else{
        return "";
    }
}

function pageConfirmationGen($name){

    $id = getId($name);

    if(strlen($id)){
        $get = "?name=$name&id=$id";
        return "http://forum/authorizationUserPage.php".$get;
    }
    else{
        return "false";
    }

}

function pageConfirmation($id, $name){
    $connection = mysql_connect("localhost", "keygen", "12345")
        or die("Error connect");

    $db = mysql_select_db("bdForum", $connection)
        or die("Error connect db");

    $query = "SELECT * FROM users WHERE id='$id' AND name='$name'";

    $result = mysql_query($query)
        or die ("Error запрос".mysql_error());

    $arr = mysql_fetch_array($result);

    mysql_close();

    if(!empty($arr)){
        // Изменение статуса на зарегистрированного (вне сети)
        setUserOnline($name, 'no-line');
        return true;
    }
    else{
        return false;
    }
}

function authorizationUser($name, $password){

    $connection = mysql_connect("localhost", "keygen", "12345")
        or die("Error connect");

    $db = mysql_select_db("bdForum", $connection)
        or die("Error connect db");

    $query = "SELECT * FROM users WHERE name='$name'";

    $result = mysql_query($query)
        or die ("Error запрос".mysql_error());

    $row = mysql_fetch_array($result);

    mysql_close();

    $password = getMd5($password);

    if($row["name"] == $name and $row["password"] == $password){
        if($row['status'] == "no-line"){
            setUserOnline($name, 'on-line');
            $_SESSION['userName'] = $name;
            return "true";
        }
        else{
            if($row['status'] == "on-line"){
                return "Пользователь под ником $name уже осуществил вход";
            }
            else{
                return "Форум ждет от пользователя под ником $name \nпереход по ссылке (отправленного на его email)\nдля потверждения регистрации!";
            }
        }
    }
    else{
        if($row["name"] == $name){
            return "Пароль не верен!";
        }
        else{
            return "false";
        }
    }
}

function setUserOnline($name, $case){
    $connection = mysql_connect("localhost", "keygen", "12345")
        or die("Error connect");

    $db = mysql_select_db("bdForum", $connection)
        or die("Error connect db");

    $query = "UPDATE users SET status='$case' WHERE name='$name'";

    $result = mysql_query($query)
        or die ("Error запрос".mysql_error());

    mysql_close();
    return true;
}

// выход пользователя
function exitUser(){

    $name = $_SESSION['userName'];
    $_SESSION['userName'] = "";

    if(setUserOnline($name,"no-line")){
        return "true";
    }
    else{
        return "Не удалось осуществить выход";
    }
}
// выход пользователя....

// функция возвращает количество онлайн пользователей
function getForumOnlineUser($forum = "all"){
    $index = rand(0, 1000 - 1);

    return $index;
}
// функция возвращает количество онлайн пользователей....

// установка данных в базу по пользователя и ячейки
function setDataOne($data, $id, $name){

    if($id == 'password')
        $data = getMd5($data);

    if($id == 'email'){
        $email = getUserUniversal($name,'email');
        $controlEmail = 'controlEmail?'.time().'?'.$email;

        $connection = mysql_connect("localhost", "keygen", "12345") or die("Error connect");
        $db = mysql_select_db("bdForum", $connection) or die("Error connect db");
        $query = "UPDATE users SET status='$controlEmail' WHERE name='$name'";
        $result = mysql_query($query) or die ("Error email update: ".mysql_error());
        mysql_close();

        sendEmail($data, $name);
    }

    $connection = mysql_connect("localhost", "keygen", "12345") or die("Error connect");
    $db = mysql_select_db("bdForum", $connection) or die("Error connect db");

    $query = "UPDATE users SET $id='$data' WHERE name='$name'";
    $result = mysql_query($query) or die ("Error запрос".mysql_error());
    mysql_close();

    return "true";
}
// установка данных в базу по пользователя и ячейки....

// функция востановления пароля
function reconstructionPassword($name){

    $email = getUserUniversal($name,'email');
    $password = genPassword();
    $subject = 'Востановление пароля. local Forum.';
    $message = "
    <div style='color: red'> Это письмо было создано автаматически не отвечайте на него!</div>
    <br>
    <b>Ваш новый пароль: $password";
    $headers = 'localForum@example.com';

    if(send_mime_mail('Local Forum',$headers, $name, $email, 'utf-8', 'utf-8', $subject, $message,true)){
        if(setDataOne($password, 'password', $name)){
            return "true";
        }
        else{
            return "false";
        }
    }
    else{
        return "false";
    }
}
// функция востановления пароля....

// проверяем введенный пароль по базе
function testPasswordUser($name, $password){

    $userPassword = getUserUniversal($name,'password');
    $password = getMd5($password);

    if($userPassword == $password)
        return "true";
    else
        return "false";
}
// проверяем введенный пароль по базе....

// установка нового аватара для пользователя
function saveSetAvatar($img, $name){

    $return = "true";

    $hrefImg = "../resources/tempAvatar/".$img;
    $widening = explode('.',$img);
    $ok = "resources/avatarUser/".getNameAvatar().".".$widening[1];
    $hrefImgSave = "../".$ok;


    if (!copy($hrefImg, $hrefImgSave)) {
        $return = "Картинка не изменена";
    }
    else{
        $return = $ok;
        setDataOne($ok,'avatar',$name);
    }

    if(!unlink($hrefImg))
        $return = 'Картинка не удалена!';

    return $return;
}
// установка нового аватара для пользователя....

// поиск файлов в папке
// пример применения
//выводим содержимое массива
// define( 'root_path', dirname( __FILE__ ) );
//print_r (get_name_file ( scan_dir( root_path . '/dir', 'files')));

function scan_dir($dir, $mode='folders'){
    $items = array();

    if( !preg_match( "/^.*\/$/", $dir ) )
        $dir .= '/';

    $handle = opendir( $dir );
    if( $handle != false ){
        while($item=readdir($handle)) {
            if($item != '.' && $item != '..'){
                switch($mode) {
                    case 'folders' :
                        if(is_dir($dir.$item))
                            $items[] = $item;
                        break;
                    case 'files' :
                        if(!is_dir($dir.$item))
                            $items[] = $item;
                        break;
                    case  'all' :
                        $items[] = $item;
                        break;
                }
            }
        }
        closedir($handle);
        return $items;
    } else
        return false;
}

// поиск файлов в папке ....

// возвращает тип файла
function get_type_file($type){

    return preg_replace('/(.+?)[.]([a-zA-z0-9]+)$/', '\\2', $type);
}
// возвращает тип файла....

// возвращает имя файла
function get_name_file($file){

    return preg_replace('/(.+?)[.]([a-zA-z0-9]+)$/', '\\1', $file);
}
// возвращает имя файла ....

// создает имя которое нет в папке
function getNameAvatar(){
    $nameFiles = get_name_file( scan_dir( '../resources/avatarUser', 'files'));

    $count = 0;

    if($nameFiles){

        for($i = 0; $i< count($nameFiles); $i++){
                if($count < (int)$nameFiles[$i])
                    $count = (int)$nameFiles[$i];
        }

        $count++;
    }
    return $count;
}
// создает имя которое нет в папке .....

// добавление друга в базу пользователя
function setFriend($userName, $friendName){

    $BL = true;
    $friends = getUserUniversal($userName,'friends');
    $friendsMass = explode('/',$friends);

    for($i = 0; $i<count($friendsMass); $i++)
        if($friendsMass[$i] == $friendName){
            $BL = false;
            break;
        }

    if($BL)
        return setDataOne($friends."/".$friendName, 'friends', $userName);
    else
        return "Такой кореш уже добавлен!";
}
// добавление друга в базу пользователя.....

// добавление пользователя в базу игнора
function setDisdain($userName, $disdainName){

    $BL = true;
    $disdain = getUserUniversal($userName,'disdain');
    $disdainMass = explode('/',$disdain);

    for($i = 0; $i<count($disdainMass); $i++)
        if($disdainMass[$i] == $disdainName){
            $BL = false;
            break;
        }

    if($BL)
        return setDataOne($disdain."/".$disdainName, 'disdain', $userName);
    else
        return "Пользователь $disdainName в игнор уже добавлен!";
}
// добавление пользователя в базу игнора....

// удаление друга пользователя из базы
function delFriend($userName, $friendName){

    $friends = getUserUniversal($userName,'friends');
    $clearFriend = str_replace('/'.$friendName, '', $friends);

    return setDataOne($clearFriend, 'friends', $userName);
}
// удаление друга пользователя из базы....

// удаление пользователя из игнора
function delDisdain($userName, $disdainName){

    $disdain = getUserUniversal($userName,'disdain');
    $clearDisdain = str_replace('/'.$disdainName, '', $disdain);

    return setDataOne($clearDisdain, 'disdain', $userName);
}
// удаление пользователя из игнора....