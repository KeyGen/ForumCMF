<?php

namespace Qp;

include_once('../QDir/classQDir.php');

class QStringColor{

    private $maxWidth;  // Максимальная ширина окна кода
    private $maxHeight; // Максимальная высота окна кода
    private $style;     // Выбор стиля (default, one, two)

    // Ассоциативный массив key-ключь стиля для доступа для класса, value - название стиля в css
    private $typeCodeArr = array(
        '[CPLUSPLUS]'=>'CPlusPlus',
        '[PHP]'=>'PHP'
    );

    // Конструктор
    public function __construct( $maxWidth = '700px', $maxHeight = '100px', $style = 'default' ){
        $this->maxWidth = $maxWidth;
        $this->maxHeight = $maxHeight;
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

    // Редактироватирование html
    private function  createHtml($string){
        $string = str_replace('&', '&amp;',  $string);
        $string = str_replace(' ', '&nbsp;',$string);
        $string = str_replace('\'','&apos;',$string);
        $string = str_replace('\"','&quot;',$string);
        $string = str_replace('<', '&lt;',  $string);
        $string = str_replace('>', '&gt;',  $string);
        $string = str_replace("\n", '<br>',$string);
        $string = str_replace("\r", '<br>',$string);
        return $string;
    }

    // Разбираем текст на массивы ели есть теги ([CPLUSPLUS][/CPLUSPLUS],[PHP][/PHP])
    function getCodeTeg($string){

        $string = ltrim($string); // Удаляет пробелы из начала строки
        $string = rtrim($string); // Удаляет пробелы из конца строки
        $string = $this->createHtml($string); // Редактироватирование html

        preg_match_all("/(\[([\w]+)[^\]]?\])(.*)(\[\/\\2\])/U", $string, $matches);


        for ($i=0; $i< count($matches[0]); $i++) {
            //$string = $this->editCodeCPlusPlus($matches[3][$i],$matches[0][$i], $string);

            switch($matches[1][$i]){
                case '[CPLUSPLUS]':
                    $string = $this->editCodeCPlusPlus($matches[3][$i],$matches[0][$i], $string);
                break;
                case '[PHP]':
                    $string = $this->editCodePHP($matches[3][$i],$matches[0][$i], $string);
                break;
            }
        }

        return $string;
    }

    private function getTableNumLines($string, $title, $style){

        // Установка нумерачии строк
        $table = "<table style='width: 100%;'>";
        $tableLines = explode('<br>',$string);
        for($i = 1; $i<count($tableLines)+1; $i++){
            $enum = "<tr><td style='width: 10px;' class='QnumBackground'>";
            $table = $table.$enum.$i."</td><td>&nbsp;&nbsp;&nbsp;&nbsp;".$tableLines[$i-1]."&nbsp;</td></tr>";
        }
        $string = $table."</table>";
        // Установка нумерачии строк ...

        // Заваричиваем таблицу в <div>
        $div = "$title<div style='display: block; height: $this->maxHeight; width: $this->maxWidth; overflow: auto;' class='$style Qbackground'>";
        $string = $div.$string."</div>";
        // Заваричиваем таблицу в <div> ....

        return $string;
    }

    private function editCodeCPlusPlus($string, $replace, $initial){

        $title = "Код С++<br><hr style='width: $this->maxWidth; float: left;'>"; // Строка на верху
        $style = $this->typeCodeArr['[CPLUSPLUS]']; // Получаем название стиля из массива

        // Создаем таблицу с пронумерованными строками
        $string = $this->getTableNumLines($string, $title, $style);

        // <include>
        preg_match_all("/&lt;(.*)&gt;/", $string, $matches);
        for ($i=0; $i< count($matches[0]); $i++) {
            $string = str_replace($matches[0][$i],"<div class='$style Qinclude'>".$matches[0][$i]."</div>", $string);
        }

        // "строки"
        preg_match_all("/\"(.*)\"/", $string, $matches);
        for ($i=0; $i< count($matches[0]); $i++) {
            $string = str_replace($matches[0][$i],"<div class='$style Qstring'>".$matches[0][$i]."</div>", $string);
        }

        // комментарии '//'
        preg_match_all("/(\/\/)(.*)(&nbsp;)/", $string, $matches);
        for ($i=0; $i< count($matches[0]); $i++) {
            $string = str_replace($matches[0][$i],"<div class='$style Qcomment'>".$matches[0][$i]."</div>", $string);
        }

        // комментарии
        preg_match_all("/(\/\*)(.*)(\*\/)/", $string, $matches);
        for ($i=0; $i< count($matches[0]); $i++) {
            $string = str_replace($matches[0][$i],"<div class='$style Qcomment'>".$matches[0][$i]."</div>", $string);
        }

        // Цифры
        preg_match_all("/((&nbsp;))(\d)+(&nbsp;)/", $string, $matches);
        for ($i=0; $i< count($matches[0]); $i++) {
            $key = str_replace('&nbsp;', '', $matches[0][$i]);
            $string = str_replace($matches[0][$i],"&nbsp;<div class='$style Qnum'>".$key."</div>&nbsp;", $string);
        }
        preg_match_all("/(&nbsp;)(\d)+(;)/", $string, $matches);
        for ($i=0; $i< count($matches[0]); $i++) {
            $key = str_replace('&nbsp;', '', $matches[0][$i]);
            $string = str_replace($matches[0][$i],"&nbsp;<div class='$style Qnum'>".$key."</div>&nbsp;", $string);
        }


        // ключи из массива
        foreach($this->arrKeyCPLUS as $key){
            preg_match_all("/(&nbsp;)($key)(&nbsp;)/", $string, $matches);
            for ($i=0; $i< count($matches[0]); $i++) {
                $key = str_replace('&nbsp;', '', $matches[0][$i]);
                $string = str_replace($matches[0][$i],"&nbsp;<div class='$style Qkey'>".$key."</div>&nbsp;", $string);
            }
        }

        return str_replace($replace, $string, $initial);
    }

    private function editCodePHP($string, $replace, $initial){
        $title = "Код Php<br><hr style='width: $this->maxWidth; float: left;'>";
        $style = $this->typeCodeArr['[PHP]']; // Получаем название стиля из массива

        // Создаем таблицу с пронумерованными строками
        $string = $this->getTableNumLines($string, $title, $style);

        // "строки"
        preg_match_all("/\"(.*)\"/", $string, $matches);
        for ($i=0; $i< count($matches[0]); $i++) {
            $string = str_replace($matches[0][$i],"<div class='$style Qstring'>".$matches[0][$i]."</div>", $string);
        }

        // комментарии '//'
        preg_match_all("/(\/\/)(.*)(&nbsp;)/", $string, $matches);
        for ($i=0; $i< count($matches[0]); $i++) {
            $string = str_replace($matches[0][$i],"<div class='$style Qcomment'>".$matches[0][$i]."</div>", $string);
        }

        // комментарии
        preg_match_all("/(\/\*)(.*)(\*\/)/", $string, $matches);
        for ($i=0; $i< count($matches[0]); $i++) {
            $string = str_replace($matches[0][$i],"<div class='$style Qcomment'>".$matches[0][$i]."</div>", $string);
        }

        // Цифры
        preg_match_all("/((&nbsp;))(\d)+(&nbsp;)/", $string, $matches);
        for ($i=0; $i< count($matches[0]); $i++) {
            $key = str_replace('&nbsp;', '', $matches[0][$i]);
            $string = str_replace($matches[0][$i],"&nbsp;<div class='$style Qnum'>".$key."</div>&nbsp;", $string);
        }
        preg_match_all("/(&nbsp;)(\d)+(;)/", $string, $matches);
        for ($i=0; $i< count($matches[0]); $i++) {
            $key = str_replace('&nbsp;', '', $matches[0][$i]);
            $string = str_replace($matches[0][$i],"&nbsp;<div class='$style Qnum'>".$key."</div>&nbsp;", $string);
        }


        // ключи из массива
        foreach($this->arrKeyPHP as $key){
            preg_match_all("/(&nbsp;)($key)(&nbsp;)/", $string, $matches);
            for ($i=0; $i< count($matches[0]); $i++) {
                $key = str_replace('&nbsp;', '', $matches[0][$i]);
                $string = str_replace($matches[0][$i],"&nbsp;<div class='$style Qkey'>".$key."</div>&nbsp;", $string);
            }
        }

        return str_replace($replace, $string, $initial);
    }

    private $arrKeyPHP = array(
        'class', // Обязательно распологаем первым!!!
        'as',
        'foreach',
        'for',
        'while',
        'switch',
        '__DIR__',
        '__FILE__',
        '$_POST',
        '$_COOKIE',
        '$_GET',
        '&lt;\?php',
        '\?&gt;',
        'echo'
    );

    private $arrKeyCPLUS = array( // Ключевые слова
        'class', // Обязательно распологаем первым!!!
        '#include',
        'return',
        'int',
        'char',
        'short',
        'double',
        '&lt;iostream&gt;',
        'std::cout'
    );
}