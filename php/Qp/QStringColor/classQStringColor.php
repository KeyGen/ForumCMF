<?php

namespace Qp;

include_once('../QDir/classQDir.php');

class QStringColor{

    // Имя стиля
    private $style;
    // Тип кода
    private $typeCode;

    // Ассоциативный массив key-ключь стиля для доступа для класса, value - название стиля в css
    private $styleClass = array(
        'default'=>'defaultQStringColor'
    );

    // Ассоциативный массив key-ключь стиля для доступа для класса, value - название стиля в css
    private $typeCodeArr = array(
        'c++'=>'CPlusPlus',
        'php'=>'PHP',
        'html'=>'Html'
    );

    // Конструктор
    public function __construct($typeCode = 'C++', $style = 'default'){
        $this->style = $style;
        $this->typeCode = $this->typeCodeArr[strtolower($typeCode)]; // Присваевает тип понижая ригистр возвращает имя класса
        if(!$typeCode)
            echo "<script>alert('Не поддерживаемый тип кода')</script>";
    }

    // Установка стиля
    public function setStyle($style){
        $this->style = $style;
    }

    // Метод для вставки стилей класса на страницу
    // $case - выводит полностью отдельную строку подключения (style) или только @import (import)
    public function getStyle($dir, $case){
        $dirClass = __DIR__;
        $dirFile = $dir;
        $outDir =  str_replace($dirFile.'/', '', $dirClass);

        if($case == 'style')
            echo "<style type='text/css'>@import '$outDir/styleQStringColor.css';</style>
";
        elseif($case == 'import')
            echo "@import '$outDir/styleQStringColor.css';
";
    }

    public function getStringStyle($string){
        return $this->editString($string);
    }

    private function editString($string){
        switch($this->typeCode){
            case 'CPlusPlus':
                return $this->editCodeCPlusPlus($string);
            break;
            case 'PHP':
                return $this->editCodePhp($string);
                break;
            case 'Html':
                return $this->editCodeHtml($string);
                break;
        }
        return false;
    }

    private function editCodeCPlusPlus($string){
        $arrKey = array(
            'class',
            'int',
            'char',
            'short',
            'double'
        );

        foreach($arrKey as $value){
            if(substr_count($string, "$value"))
            $string = str_replace(''.$value.' ', " <div class='key'>$value</div> ", $string);
        }

        return $string;
    }

    private function editCodePhp($string){
        return $string;
    }

    private function editCodeHtml($string){
        return $string;
    }
}