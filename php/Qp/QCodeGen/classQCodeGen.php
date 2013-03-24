<?php

namespace Qp;

class QCodeGen{
    private $code;
    private $sizeCode;

    private $arrEngSmall  = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','r','s','t','u','v','x','y','z');
    private $arrEngBig    = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','R','S','T','U','V','X','Y','Z');
    private $arrRusSmall  = array('а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ','э','ю','я');
    private $arrRusBig    = array('А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Э','Ю','Я');
    private $arrNumber    = array('1','2','3','4','5','6','7','8','9','0');

    function __construct($sizeCode = 8){
        $this->sizeCode = $sizeCode;
    }

    function setSymbols($myArrSymbols){
        $this->code = "";
        for($i = 0; $i < $this->sizeCode; $i++){
            $index = rand(0, count($myArrSymbols) - 1); // Вычисляем случайный индекс массива
            $this->code .= $myArrSymbols[$index];
        }
    }

    function genCodeEng(){
        $this->code = "";
        $arrSum = array_merge($this->arrEngSmall,$this->arrEngBig);
        for($i = 0; $i < $this->sizeCode; $i++){
            $index = rand(0, count($arrSum) - 1); // Вычисляем случайный индекс массива
            $this->code .= $arrSum[$index];       // Добовляем полученный символ к коду
        }
    }

    function genCodeEngSmall(){
        $this->code = "";
        for($i = 0; $i < $this->sizeCode; $i++){
            $index = rand(0, count($this->arrEngSmall) - 1); // Вычисляем случайный индекс массива
            $this->code .= $this->arrEngSmall[$index];       // Добовляем полученный символ к коду
        }
    }

    function genCodeRus(){
        $this->code = "";
        $arrSum = array_merge($this->arrRusSmall,$this->arrRusBig);
        for($i = 0; $i < $this->sizeCode; $i++){
            $index = rand(0, count($arrSum) - 1); // Вычисляем случайный индекс массива
            $this->code .= $arrSum[$index];       // Добовляем полученный символ к коду
        }
    }

    function genCodeNumber(){
        $this->code = "";
        for($i = 0; $i < $this->sizeCode; $i++){
            $index = rand(0, count($this->arrNumber) - 1); // Вычисляем случайный индекс массива
            $this->code .= $this->arrNumber[$index];       // Добовляем полученный символ к коду
        }
    }

    function genCodeEng_Number(){
        $this->code = "";
        $arrSum = array_merge($this->arrEngSmall,$this->arrEngBig);
        $arrSum = array_merge($arrSum, $this->arrNumber);
        for($i = 0; $i < $this->sizeCode; $i++){
            $index = rand(0, count($arrSum) - 1); // Вычисляем случайный индекс массива
            $this->code .= $arrSum[$index];       // Добовляем полученный символ к коду
        }
    }

    function getCode(){
        return $this->code;
    }
}