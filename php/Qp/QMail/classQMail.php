<?php

namespace Qp;

class QMail {

    private $string;

    public function __construct($string = ''){
        $this->string = $string;
    }

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
        $to = mime_header_encode($name_to, $data_charset, $send_charset)
            . ' <' . $email_to . '>';
        $subject = mime_header_encode($subject, $data_charset, $send_charset);
        $from =  mime_header_encode($name_from, $data_charset, $send_charset)
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

    private function mime_header_encode($str, $data_charset, $send_charset) {
        if($data_charset != $send_charset) {
            $str = iconv($data_charset, $send_charset, $str);
        }
        return '=?' . $send_charset . '?B?' . base64_encode($str) . '?=';
    }
}

//echo "<script>alert('$this->id')</script>";

/*
// Отправка emil ----------------- begin -----------------
function sendEmail($email, $name){

    $pageGen = pageConfirmationGen($name);

    $subject = 'Регистрация local Forum';

    $message = "
    <div style='color: red'> Это письмо было создано автаматически не отвечайте на него!</div>
    <br>
    <b>Для завершения регистрации перейдите по ссылке:</b><br><br><a href='$pageGen'>$pageGen</a>";

    $headers = 'localForum@example.com';

    return send_mime_mail('Local Forum',$headers, $name, $email, 'utf-8', 'utf-8', $subject, $message,true);
}

function send_mime_mail($name_from, // имя отправителя
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
    $to = mime_header_encode($name_to, $data_charset, $send_charset)
        . ' <' . $email_to . '>';
    $subject = mime_header_encode($subject, $data_charset, $send_charset);
    $from =  mime_header_encode($name_from, $data_charset, $send_charset)
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

function mime_header_encode($str, $data_charset, $send_charset) {
    if($data_charset != $send_charset) {
        $str = iconv($data_charset, $send_charset, $str);
    }
    return '=?' . $send_charset . '?B?' . base64_encode($str) . '?=';
}

// Отправка emil ----------------- end -----------------
 */