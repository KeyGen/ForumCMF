<?php
// QCaptcha - настройки класса в нутри classQCaptcha.php.
// Пример использования:
//<p><a href='#' onclick="document.getElementById('captchaImg').src='php/QP/QCaptcha/classQCaptcha.php?'+Math.random(); return false;"><img id='captchaImg' src='php/QP/QCaptcha/classQCaptcha.php'></a></p>

// Подключение всей библиотеки
include_once('QCodeGen/classQCodeGen.php');
include_once('QDir/classQDir.php');
include_once('QPush/classQPush.php');
include_once('QTestString/classQTestString.php');
include_once('QBD/classQBD.php');
include_once('QStringColor/classQStringColor.php');
include_once('QMail/classQMail.php');