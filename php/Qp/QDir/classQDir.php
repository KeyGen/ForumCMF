<?php

namespace Qp;

include_once('../QCodeGen/classQCodeGen.php');

class QDir {
    private $dir;

    // Конструктор
    function __construct($dir = ''){
        if($dir)
            $this->dir = $dir;
        else
            $this->dir = __DIR__;

    }

    // Приватная функция поиска файлов
    private function scan_dir($mode='folders'){
        $items = array();

        if( !preg_match( "/^.*\/$/", $this->dir ) )
            $this->dir .= '/';

        $handle = opendir( $this->dir );
        if( $handle != false ){
            while($item=readdir($handle)) {
                if($item != '.' && $item != '..'){
                    switch($mode) {
                        case 'folders' :
                            if(is_dir($this->dir.$item))
                                $items[] = $item;
                            break;
                        case 'files' :
                            if(!is_dir($this->dir.$item))
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

    // Метод возвращает все папки в указанной деректории
    function entryListDir(){
        return $this->scan_dir();
    }

    // Метод возвращает все файлы или отфилтрует
    // Пример вернет все файлы с разрешением png/html/php:
    // $arr = $class->entryListFiles('png/html/php');
    function entryListFiles($filter = ''){

        if(!strlen($filter)){
            return $this->scan_dir('files');
        }
        else{
            $arr = $this->scan_dir('files');
            $arrFilterFiles = array();
            $arrFilter = explode('/',$filter);

            for($i = 0; $i<count($arrFilter); $i++)
                for($j = 0; $j<count($arr); $j++)
                    if(!strcasecmp(preg_replace('/(.+?)[.]([a-zA-z0-9]+)$/', '\\2', $arr[$j]), $arrFilter[$i]))
                        $arrFilterFiles[] = $arr[$j];

            return $arrFilterFiles;
        }
    }

    // Метод возвращает имя не встречающиеся в указанной папке
    function getNotFoundName($size = 8){
        $newName = ''; $BL = true;
        $arrFiles = $this->scan_dir('all'); // Сканируем на папки и файлы
        while($BL){
            $BL = false;
            $genName = new QCodeGen($size);
            $genName->genCodeEngSmall();    // Генерируем англ слово
            $newName = $genName->getCode(); // Получаем случайное слово
            foreach($arrFiles as $value)
                if(!strcasecmp($newName, preg_replace('/(.+?)[.]([a-zA-z0-9]+)$/', '\\1', $value))){ // Возвращает имя файла без расширения
                    $BL = true;
                    break;
                }
        }

        return $newName;
    }

    // Метод проверки есть ли файл в директории
    // $fileName - имя файла
    // $register - учитывать регистр или нет
    // $case     - с раширением файла или без него (full = index.php, name = index)
    function isFile($fileName, $register = 'yes', $case = 'full'){
        $arrFiles = $this->scan_dir('files'); // Сканируем файлы

        if($case == 'full'){
            if($register == 'yes'){
                foreach($arrFiles as $value)
                    if($fileName == $value)
                        return true;
            }
            elseif($register = 'no'){
                foreach($arrFiles as $value)
                    if(!strcasecmp($fileName, $value))
                        return true;
            }
        }
        elseif($case == 'name'){
            if($register == 'yes'){
                foreach($arrFiles as $value)
                    if($fileName == preg_replace('/(.+?)[.]([a-zA-z0-9]+)$/', '\\1', $value))
                        return true;
            }
            elseif($register = 'no'){
                foreach($arrFiles as $value)
                    if(!strcasecmp($fileName, preg_replace('/(.+?)[.]([a-zA-z0-9]+)$/', '\\1', $value)))
                        return true;
            }
        }

        return false;
    }

    // Метод проверки есть ли папка в директории
    // $folderName - имя папки
    // $register - учитывать регистр или нет
    function isFolder($fileName, $register = 'yes'){
        $arrFiles = $this->scan_dir('folders'); // Сканируем файлы

        if($register == 'yes'){
            foreach($arrFiles as $value)
                if($fileName == $value)
                    return true;
        }
        elseif($register = 'no'){
            foreach($arrFiles as $value)
                if(!strcasecmp($fileName, $value))
                    return true;
        }

        return false;
    }

    // Установка директории
    function setDir($dir){
        $this->dir = $dir;
    }

    // Вывод директории
    function alertDir(){
        echo "<script>alert('$this->dir')</script>";
    }
}

/*
function get_name_file($file){ return preg_replace('/(.+?)[.]([a-zA-z0-9]+)$/', '\\1', $file); } // возвращает имя файла
*/

