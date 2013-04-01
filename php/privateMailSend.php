<?php

include_once("functionPHP.php");

global $name;
global $bdPrivateMail;
$titleMail = array();

$allAmountMail = $bdPrivateMail->getQuantityRepetition('sender', $name);

if( $allAmountMail != 0){

    $tempArrPrivateMail = $bdPrivateMail->getDataCell('sender', $name);

    for($i = 0; $i<count($tempArrPrivateMail); $i++){
        $tempArr = array();

        $tempArr['id'] = $tempArrPrivateMail[$i]['id'];
        $tempArr['status'] = $tempArrPrivateMail[$i]['status'];
        $tempArr['date'] = $tempArrPrivateMail[$i]['date'];
        $tempArr['theme'] = $tempArrPrivateMail[$i]['theme'];
        $tempArr['addressee'] = $tempArrPrivateMail[$i]['addressee'];

        $titleMail[] = $tempArr;
    }

    $countPageMail = 3;

    for($i = $allAmountMail-1; $i >= 0; $i--){
        $sender = $titleMail[$i]['sender'];

        echo "
        <script>
            $(function(){
                $( '#accordionMailSend$i' ).accordion({autoHeight:false, collapsible:true, active: false,
                    changestart: function(event, ui) {

                    var active = $('#accordionMailSend$i').accordion( 'option', 'active' );

                    if(active !== 0)
                        getTextPrivateMail(document.getElementById('imgIdPrivateMailSend$i'),
                                           document.getElementById('textMailSend$i'),
                                           '$name',
                                           document.getElementById('idMailSend$i').value,
                                           'take');
                    }
                });
            });
        </script>
    ";
    }

// Определяем нужное количество div
    $amountPage = 0;
    for($i = 0; $i<$allAmountMail; $i++){
        if(!($i%$countPageMail)){
            $amountPage++;
        }
    }

// Создаем div-ы
    for($div = 0; $div<$amountPage; $div++){

        if($div > 0){
            echo "<div id='mailPageSend$div' class='none'>";
            $allAmountMail -= $countPageMail;
        }
        else
            echo "<div id='mailPageSend$div'>";

        echo "
        <table style='width: 100%;'>
            <tr><td style='height: 14px;'></td></tr>
            <tr>
                <td style='height: 30px; color: #ffffff; text-align: center; font-weight: bold; border-radius: 6px;' class='borderColor' colspan='3'>
                    Исходящие сообщения
                </td>
            </tr>
            <tr><td style='height: 5px;'></td></tr>
            <tr>
            <tr>
                <td style='text-align: center'>
    ";

        $iStop = $countPageMail;
        for($i = $allAmountMail-1; $i >= 0; $i--, $iStop--){

            if(!$iStop)
                break;

            $id = $titleMail[$i]['id'];
            $status = $titleMail[$i]['status'];
            $date = $titleMail[$i]['date'];
            $theme = $titleMail[$i]['theme'];
            $sender = $titleMail[$i]['addressee'];

            echo "
                <div id='accordionMailSend$i'>
                    <!-- ////////////////////////// -->
                    <h3 style=' font-size: 13px;'>
                        <table style='width: 100%; font-weight: bold; color: #ffffff;'  cellpadding='0' cellspacing='0'>
                            <tr>
                                <td style='width: 40px; height: 10px;'>
                                ";

            if($status == 'notRead')
                echo " <img id='imgIdPrivateMailSend$i' width='40px;' src='css/images/privateNewMail.png'> ";
            else
                echo "<img id='imgIdPrivateMailSend$i' width='40px;' src='css/images/privateMail.png'>";

            echo "
                                </td>
                                <td style='width: 10px;'></td>
                                <td>
                                    <input id='idMailSend$i' type='hidden' value='$id'/>
                                    $theme <br>
                                    <div style='font-size: 12px;'>$sender</div>
                                </td>
                                <td style='text-align: center; width: 150px; border-radius: 6px; font-size: 12px;' class='borderColor'>
                                     $date
                                </td>
                            </tr>
                        </table>
                    </h3>
                    <div style='background-color: #ffffff; color: #000000;'>
                        <table style='width: 100%;' cellspacing='10' cellpadding='10'>
                            <tr>
                                <td style='border-radius: 6px; border: 1px solid #808080;'>
                                    <div id='textMailSend$i' ></div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                    <!-- ////////////////////////// -->
             ";
        }

        echo "
            </td>
        </tr>
        <tr><td style='height: 10px;'></td></tr>
        <tr><td style='height: 10px;  border-radius: 6px;' class='borderColor' colspan='3'></td></tr>
        <tr><td style='height: 4px;'></td></tr>
    </table>";

        echo "<table style='width: 100%; font-weight: bolder;'><tr><td>"; echo $div+1; echo "</td><td style='text-align: right;'>";
        for($button = 0; $button<$amountPage; $button++){
            $numPage = $button+1;

            if($button == 0 || $button == $div || $button == $div-1 || $button == $div+1 || $button == $amountPage-1){
                echo "
                <button onclick=\"
                    for(var i = 0; i<100; i++){
                        if(document.getElementById('mailPageSend'+i))
                            document.getElementById('mailPageSend'+i).className = 'none';
                        else
                            break;
                    }
                        document.getElementById('mailPageSend$button').className = 'block';
                        goToPosElementForm('#href',0);
                    \">
                    $numPage
                </button>
            ";
            }
            else{
                if($button == $div-2 || $button == $div+2)
                    echo "...";
            }

        }

        echo "</td></tr><tr><td style='height: 4px;'></td></tr></table>";
        echo "</div>";
    }
}
else{
    echo "
        <table style='width: 100%;'>
            <tr><td style='height: 14px;'></td></tr>
            <tr>
                <td style='height: 30px; color: #ffffff; text-align: center; font-weight: bold; border-radius: 6px;' class='borderColor' colspan='3'>
                    Исходящие сообщения
                </td>
            </tr>
            <tr><td style='height: 5px;'></td></tr>
            <tr>
            <tr>
                <td style='text-align: center'>
                    У вас пока нет сообщений
                </td>
            </tr>
            <tr><td style='height: 10px;'></td></tr>
            <tr><td style='height: 10px;  border-radius: 6px;' class='borderColor' colspan='3'></td></tr>
            <tr><td style='height: 14px;'></td></tr>
        </table>
    ";
}