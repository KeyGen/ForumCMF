<?php

namespace Qp;

class QBD {

    private $host;      // Host
    private $name;      // Имя пользователя базы данных
    private $password;  // Пароль пользователя базы данных
    private $db;        // Название BD
    private $table;     // Таблица в которой будем работать

    // Конструктор
    function __construct($name, $password, $db, $table, $host = 'localhost'){

        $this->name = $name;
        $this->password = $password;
        $this->db = $db;
        $this->host = $host;
        $this->table = $table;

        $connection = mysql_connect("$this->host", "$this->name", "$this->password") or die("Error connect");
        mysql_select_db("$this->db", $connection) or die("Error connect db");
    }

    // Деструктор
    function __destruct() {
        mysql_close();
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
                    return mysql_fetch_assoc($result);
                break;
                case 'indicial':
                    return mysql_fetch_row($result);
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
                    return mysql_fetch_assoc($result);
                    break;
                case 'indicial':
                    return mysql_fetch_row($result);
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
                    return mysql_fetch_assoc($result);
                    break;
                case 'indicial':
                    return mysql_fetch_row($result);
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