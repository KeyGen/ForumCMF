<?php

namespace Qp;

class QBD {

    private $host;      // Host
    private $name;      // Имя пользователя базы данных
    private $password;  // Пароль пользователя базы данных
    private $db;        // Название BD
    private $table;     // Таблица в которой будем работать

    private $tablesBD = array();
    private $fieldsBD = array();

    // Конструктор
    function __construct($name, $password, $db, $table, $host = 'localhost'){

        $this->name = $name;
        $this->password = $password;
        $this->db = $db;
        $this->host = $host;
        $this->table = $table;

        $connection = mysql_connect("$this->host", "$this->name", "$this->password") or die("Error connect");
        mysql_select_db($this->db, $connection) or die("Error connect db");

        // Получаем список таблиц в базе данных для зациты от ошибок запросов (sql иньекции курят)
        $tables = mysql_list_tables($this->db, $connection);
        while($arr = mysql_fetch_array($tables))
            $this->tablesBD[] = $arr[0];

        // Получаем список ячеек в таблице для зациты
        $fields = mysql_list_fields($this->db, $this->table, $connection);
        for($i = 0; $i< $fields; $i++)
            $this->fieldsBD[] = mysql_field_name($fields, $i);
    }

    // Деструктор
    function __destruct() {
        mysql_close();
    }

    // Обезопасим класс
    private function protectorFieldsBD($fields){
        $bl = false;
        foreach($this->fieldsBD as $value){
            if($fields == $value){
                $bl = true; break;
            }
        }

        return $bl;
    }

    // Подключение к BD
    function connectDB($name, $password, $db, $table, $host = 'localhost'){

        mysql_close();

        $this->name = $name;
        $this->password = $password;
        $this->db = $db;
        $this->host = $host;
        $this->table = $table;

        $connection = mysql_connect("$this->host", "$this->name", "$this->password") or die("Error connect");
        mysql_select_db("$this->db", $connection) or die("Error connect db");
    }

    // Изменение таблицы
    function setTable($table){
        $this->table = $table;
    }

    // Получение массива данных по id
    // associative - ассоциативный массив
    // indicial - индексный массив
    function getDataId($id, $case = 'associative'){
        if($id){

            $query = "SELECT * FROM $this->table WHERE id='$id'";
            $result = mysql_query($query) or die ("Error: ".mysql_error());

            switch($case){
                case 'associative':
                    $arrReturn = array();
                    while($arr = mysql_fetch_assoc($result)){
                        $arrReturn[] = $arr;
                    }
                    return $arrReturn;
                    break;
                case 'indicial':
                    $arrReturn = array();
                    while($arr = mysql_fetch_row($result)){
                        $arrReturn[] = $arr;
                    }
                    return $arrReturn;
                    break;
            }
        }
        else{
            return false;
        }

        return false;
    }

    // Получение массива данных по имени
    // associative - ассоциативный массив
    // indicial - индексный массив
    function getDataName($name, $case = 'associative'){
        if($name){

            $query = "SELECT * FROM $this->table WHERE name='$name'";
            $result = mysql_query($query) or die ("Error: ".mysql_error());

            switch($case){
                case 'associative':
                    $arrReturn = array();
                    while($arr = mysql_fetch_assoc($result)){
                        $arrReturn[] = $arr;
                    }
                    return $arrReturn;
                    break;
                case 'indicial':
                    $arrReturn = array();
                    while($arr = mysql_fetch_row($result)){
                        $arrReturn[] = $arr;
                    }
                    return $arrReturn;
                    break;
            }
        }
        else{
            return false;
        }

        return false;
    }

    // Получение массива данных с указанием ячейки
    // associative - ассоциативный массив
    // indicial - индексный массив
    function getDataCell($tableCell, $find, $case = 'associative'){
        if($tableCell && $find){

            $query = "SELECT * FROM $this->table WHERE $tableCell='$find'";
            $result = mysql_query($query) or die ("Error: ".mysql_error());

            switch($case){
                case 'associative':
                    $arrReturn = array();
                    while($arr = mysql_fetch_assoc($result)){
                        $arrReturn[] = $arr;
                    }
                    return $arrReturn;
                    break;
                case 'indicial':
                    $arrReturn = array();
                    while($arr = mysql_fetch_row($result)){
                        $arrReturn[] = $arr;
                    }
                    return $arrReturn;
                    break;
            }
        }
        else{
            return false;
        }

        return false;
    }

    // Получение данных по ячейке
    function getDataOne($tableCell, $find, $get){
        if($tableCell && $find){

            $query = "SELECT * FROM $this->table WHERE $tableCell='$find'";
            $result = mysql_query($query) or die ("Error: ".mysql_error());
            $arr = mysql_fetch_assoc($result);

            return $arr[$get];
        }
        else{
            return false;
        }
    }

    // Установка данных в ячейку
    // $lineFind - ячейка
    // $dataFind - ищем данные
    // $cellSet  - ячейка для добовления данных
    // $dataSet  - данные помещаемые в ячейку
    function setDataOne($lineFind, $dataFind, $cellSet, $dataSet){
        $query = "UPDATE $this->table SET $cellSet='$dataSet' WHERE $lineFind='$dataFind'";
        $result = mysql_query($query) or die ("Error: ".mysql_error());
        return true;
    }

    // Установка ассоциативного массива в ячейки
    // $lineFind - ячейка
    // $dataFind - ищем данные
    // $arrSet   - массив
    function setDataArr($lineFind, $dataFind, $arrSet = array()){
        foreach($arrSet as $key => $value){
            $query = "UPDATE $this->table SET $key='$value' WHERE $lineFind='$dataFind'";
            $result = mysql_query($query) or die ("Error: ".mysql_error());
        }
        return true;
    }


    // Получение количества повторов
    // $cellFind - ячейка
    // $dataFind - ищем данные
    function getQuantityRepetition($cellFind, $dataFind){
        $query = "SELECT * FROM $this->table WHERE $cellFind='$dataFind'";
        $result = mysql_query($query) or die ("Error: ".mysql_error());

        $quantity = 0;
        while(mysql_fetch_array($result))  $quantity++;

        return $quantity;
    }

    // Получение количества повторов с указанием нескольких аргументов
    // $caseArr - массив значений фильтра
    function getQuantityArr($caseArr){
        $query = "SELECT * FROM $this->table WHERE ";

        $i = 0;
        foreach($caseArr as $key=>$value){
            if(!$i)
                $query = $query."$key='$value'";
            else
                $query = $query." AND $key='$value'";
            $i++;
        }

        $result = mysql_query($query) or die ("Error: ".mysql_error());

        $quantity = 0;
        while(mysql_fetch_array($result))  $quantity++;

        return $quantity;
    }

    // Проверка повтора в ячейке
    function testData($cellFind, $dataFind){
        $query = "SELECT * FROM $this->table WHERE $cellFind='$dataFind'";
        $result = mysql_query($query) or die ("Error: ".mysql_error());

        if(count(mysql_fetch_array($result)) > 1)
            return true;
        else
            return false;
    }

    // Вставка строки в таблицу
    function setLine($setData = array()){
        $cell = "";
        $valueCell = "";
        foreach($setData as $key => $value){
            $cell = "{$cell}{$key},";
            $valueCell = "{$valueCell}'{$value}',";
        }
        $cell = substr($cell, 0, strlen($cell)-1);
        $valueCell = substr($valueCell, 0, strlen($valueCell)-1);

        $query = "INSERT INTO $this->table ({$cell}) VALUES ({$valueCell})";

        mysql_query($query) or die ("Error: ".mysql_error());
        return true;
    }
}

// echo "<script>alert('yes')</script>";