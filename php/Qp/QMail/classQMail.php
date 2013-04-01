<?php

namespace Qp;

class QMail {

    private $name_from = 'indefinitely';// имя отправителя
    private $email_from;                // email отправителя
    private $name_to = 'indefinitely';  // имя получателя
    private $email_to;                  // email получателя
    private $data_charset = 'UTF-8';    // кодировка переданных данных
    private $send_charset = 'UTF-8';    // кодировка письма
    private $subject = 'indefinitely';  // тема письма
    private $body = 'indefinitely';     // текст письма
    private $html = FALSE;              // письмо в виде html или обычного текста

    // Конструктор
    public function __construct( $email_from, $email_to, $send_charset = 'UTF-8' ){
        $this->email_from = $email_from;
        $this->email_to = $email_to;
        $this->send_charset = $send_charset;
    }
    // Установка email отправителя
    public function setEmailFrom($email_from){
        $this->email_from = $email_from;
    }
    // Установка имени отправителя
    public function setNameFrom($name_from){
        $this->name_from = $name_from;
    }
    // Установка email получателя
    public function setEmailTo($email_to){
        $this->email_to = $email_to;
    }
    // Установка имени получателя
    public function setNameTo($name_to){
        $this->name_to = $name_to;
    }
    // Установка кодировки передачи данных
    public function setDataCharset($data_charset){
        $this->data_charset = $data_charset;
    }
    // Установка кодировки письма
    public function setSendCharset($send_charset){
        $this->send_charset = $send_charset;
    }
    // Установка темы письма
    public function setSubject($subject){
        $this->subject = $subject;
    }
    // Установка текста писма
    public function setTextEmail($body){
        $this->body = $body;
    }
    // Установка письма в виде html или обычного текста
    public function setHtml($html = FALSE){
        $this->html = $html;
    }

    // Метод отправки письма
    public function sendMail($bodyMail){

        $body = "";
        if(!$bodyMail)
            $body = $this->body;
        else
            $body = $bodyMail;

        return $this->send_mime_mail(
            $this->name_from,
            $this->email_from,
            $this->name_to,
            $this->email_to,
            $this->data_charset,
            $this->send_charset,
            $this->subject,
            $body,
            $this->html
        );
    }

    public function sendExecMail($bodyMail){

        $body = "";
        if(!$bodyMail)
            $body = $this->body;
        else
            $body = $bodyMail;

        $dir = __DIR__;

        $BLHtml = "false";
        if($this->html){
            $BLHtml = "true";
        }

        // Записуем данные в файлы
        $fp = fopen("{$dir}/tempFileBody", "w"); // Открываем файл в режиме записи
        $test = fwrite($fp, $body); // Запись в файл
        if (!$test) echo 'Ошибка при записи в файл. Папка с классом должна иметь право на запись!';
        fclose($fp); //Закрытие файла

        $fp = fopen("{$dir}/tempFileNameFrom", "w"); // Открываем файл в режиме записи
        $test = fwrite($fp, $this->name_from); // Запись в файл
        if (!$test) echo 'Ошибка при записи в файл. Папка с классом должна иметь право на запись!';
        fclose($fp); //Закрытие файла

        $fp = fopen("{$dir}/tempFileNameTo", "w"); // Открываем файл в режиме записи
        $test = fwrite($fp, $this->name_to); // Запись в файл
        if (!$test) echo 'Ошибка при записи в файл. Папка с классом должна иметь право на запись!';
        fclose($fp); //Закрытие файла

        $fp = fopen("{$dir}/tempFileSubject", "w"); // Открываем файл в режиме записи
        $test = fwrite($fp, $this->subject); // Запись в файл
        if (!$test) echo 'Ошибка при записи в файл. Папка с классом должна иметь право на запись!';
        fclose($fp); //Закрытие файла

        exec("nohup php {$dir}/sendMail.php $this->email_from $this->email_to $this->data_charset $this->send_charset $BLHtml > /dev/null 2>&1 &");
    }

    // Отправка письма
    private function send_mime_mail($name_from, // имя отправителя
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
        $to = $this->mime_header_encode($name_to, $data_charset, $send_charset)
            . ' <' . $email_to . '>';
        $subject = $this->mime_header_encode($subject, $data_charset, $send_charset);
        $from =  $this->mime_header_encode($name_from, $data_charset, $send_charset)
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

    // Установка кодировки
    private function mime_header_encode($str, $data_charset, $send_charset) {
        if($data_charset != $send_charset) {
            $str = iconv($data_charset, $send_charset, $str);
        }
        return '=?' . $send_charset . '?B?' . base64_encode($str) . '?=';
    }
}

// поток ...
// exec('nohup php emailscript.php >/dev/null 2>&1 &');