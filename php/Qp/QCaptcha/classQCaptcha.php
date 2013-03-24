<?php

namespace Qp;

session_start();

include_once('../QCodeGen/classQCodeGen.php');
include_once('../QDir/classQDir.php');

class QCaptcha {

    private $dirImage;
    private $dirTff;
    private $fontSize = 16;
    private $lines = 6;
    private $sizeCode;
    private $enumCode;

    private $arrImage = array();
    private $arrTtf = array();
    // Конструктор
    function __construct($sizeCode = 8, $enumCode = 0){
        $this->dir = 'codeGen/';

        $this->dirImage = 'captchaBack/';
        $this->dirTff = 'captchaTTF/';

        $this->enumCode = $enumCode;
        $this->sizeCode = $sizeCode;

        $qDir = new QDir($this->dirImage);
        $this->arrImage = $qDir->entryListFiles('png');
        $qDir->setDir($this->dirTff);
        $this->arrTtf = $qDir->entryListFiles('ttf');
    }
    // Установка размера шрифта
    function setFontSize($fontSize){
        $this->fontSize = $fontSize;
    }
    // Установка количества линий
    function setNumLines($lines){
        $this->lines = $lines;
    }

    function getCaptcha(){

        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s", 10000) . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Content-Type:image/png");

        $img = imagecreatefrompng($this->dirImage.$this->arrImage[rand(0,count($this->arrImage)-1)]); //создаем изображение со случайным фоном

        // Рисуем линии
        for ($i=0; $i<$this->lines; $i++){
            $color = imagecolorallocate($img, rand(0, 150), rand(0, 100), rand(0, 150));
            imageline($img, rand(0, -10), rand(1, 50), rand(150, 180), rand(1, 50), $color);
        }

        $color = imagecolorallocate($img, rand(0, 200), 0, rand(0, 200));

        // Генерируем нужный пароль
        $codeGen = new QCodeGen($this->sizeCode);

        switch($this->enumCode){
            case 0:
                $codeGen->genCodeEng_Number();  // Генерируется код англ+цифры
                break;
            case 1:
                $codeGen->genCodeEng();         // Генерируется код англ
                break;
            case 2:
                $codeGen->genCodeNumber();      // Генерируется код цифры
                break;
        }

        $code = $codeGen->getCode(); // Получение кода из класса

        $_SESSION['captchaCode'] = $code; // Сохранение кода в сессии для проверки

        imagettftext ($img, $this->fontSize, rand(0, 4), rand(0, 25), rand(30, 40), $color, $this->dirTff.$this->arrTtf[rand(0,count($this->arrTtf)-1)], $code);//накладываем код

        //еще раз линии! Уже сверху.
        for ($i=0; $i<$this->lines; $i++){
            $color = imagecolorallocate($img, rand(0, 150), rand(0, 100), rand(0, 150));
            imageline($img, rand(0, 150), rand(0, 0), rand(0, 0), rand(150, 150), $color);
        }

        ImagePNG($img);
        ImageDestroy($img);//ну вот и создано изображение!
    }
}

$captcha = new QCaptcha(6);
$captcha->setFontSize(20);
$captcha->setNumLines(4);
$captcha->getCaptcha();