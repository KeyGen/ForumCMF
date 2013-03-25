<?php

include_once('Qp/includeQP.php');

switch($_POST['inquiry']){
    case 'QCodeColor':
        $codeColor = new Qp\QStringColor('700px', '150px');
        echo $codeColor->getCodeTeg($_POST['array']['text']);
    exit;
}