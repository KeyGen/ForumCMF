<?php

// Подключаем библиотеку
include_once('classQMail.php');

$body = 'Ошибка открытия файла. Папка с классом должна иметь право на запись!';
$name_from = 'Ошибка открытия файла. Папка с классом должна иметь право на запись!';
$name_to = 'Ошибка открытия файла. Папка с классом должна иметь право на запись!';
$subject = 'Ошибка открытия файла. Папка с классом должна иметь право на запись!';

$dir = __DIR__;

// указываем на название файла и говорим, что хотим открыть его для чтения и записи
$fp = fopen ( "{$dir}/tempFileBody", 'a+' );
// если система нашла наш файл 'file.txt', значит будет $fp, который мы дальше будем читать
if ( $fp ) {
    // находим размер файла в байтах
    $size = filesize ( "{$dir}/tempFileBody" );
    // считываем весь файл в переменную $content
    $body = fread ( $fp, $size );
    //  закрываем процесс
    fclose ( $fp );
}
unlink("{$dir}/tempFileBody");

// указываем на название файла и говорим, что хотим открыть его для чтения и записи
$fp = fopen ( "{$dir}/tempFileNameFrom", 'a+' );
// если система нашла наш файл 'file.txt', значит будет $fp, который мы дальше будем читать
if ( $fp ) {
    // находим размер файла в байтах
    $size = filesize ( "{$dir}/tempFileNameFrom" );
    // считываем весь файл в переменную $content
    $name_from = fread ( $fp, $size );
    //  закрываем процесс
    fclose ( $fp );
}
unlink("{$dir}/tempFileNameFrom");

// указываем на название файла и говорим, что хотим открыть его для чтения и записи
$fp = fopen ( "{$dir}/tempFileNameTo", 'a+' );
// если система нашла наш файл 'file.txt', значит будет $fp, который мы дальше будем читать
if ( $fp ) {
    // находим размер файла в байтах
    $size = filesize ( "{$dir}/tempFileNameTo" );
    // считываем весь файл в переменную $content
    $name_to = fread ( $fp, $size );
    //  закрываем процесс
    fclose ( $fp );
}
unlink("{$dir}/tempFileNameTo");

// указываем на название файла и говорим, что хотим открыть его для чтения и записи
$fp = fopen ( "{$dir}/tempFileSubject", 'a+' );
// если система нашла наш файл 'file.txt', значит будет $fp, который мы дальше будем читать
if ( $fp ) {
    // находим размер файла в байтах
    $size = filesize ( "{$dir}/tempFileSubject" );
    // считываем весь файл в переменную $content
    $subject = fread ( $fp, $size );
    //  закрываем процесс
    fclose ( $fp );
}
unlink("{$dir}/tempFileSubject");

$EmailNewUser = new Qp\QMail($argv[1], $argv[2]);
$EmailNewUser->setNameFrom($name_from);
$EmailNewUser->setNameTo($name_to);
$EmailNewUser->setDataCharset($argv[3]);
$EmailNewUser->setSendCharset($argv[4]);
$EmailNewUser->setSubject($subject);

if($argv[5] == "true")
    $EmailNewUser->setHtml(true);
else
    $EmailNewUser->setHtml(false);


$EmailNewUser->sendMail($body);