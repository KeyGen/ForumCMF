<?php

preg_match_all("/(\[)(.*)(\])/U", $dataUser[0]['friends'], $arrFriends);
$themeMail = 'Тема сообщения';

$specialSymbol = array( '&bull;', '&hellip;', '&prime;', '&Prime;', '&oline;', '&larr;',
                        '&uarr;', '&rarr;', '&darr;', '&harr;', '&crarr;', '&forall;',
                        '&part;', '&exist;', '&empty;', '&nabla;', '&isin;', '&notin;',
                        '&ni;', '&ni;', '&sum;', '&lowast;', '&radic;', '&prop;',
                        '&infin;', '&ang;', '&and;', '&or;', '&cap;', '&cup;',
                        '&int;', '&there4;', '&cong;', '&asymp;', '&ne;', '&equiv;',
                        '&le;', '&ge;', '&sub;', '&sup;', '&nsub;', '&sube;',
                        '&supe;', '&perp;');

$greekLanguage = array('Альфа' => '&Alpha;', 'Бета' => '&Beta;', 'Гамма' => '&Gamma;', 'Дельта' => '&Delta;',
                       'Эпсилон' => '&Epsilon;', 'Дзета' => '&Zeta;', 'Эта' => '&Eta;', 'Тета' => '&Theta;',
                       'Йота' => '&Iota;', 'Каппа' => '&Kappa;', 'Лямбда' => '&Lambda;', 'Мю' => '&Mu;', 'Ню' => '&Nu;',
                       'Кси' => '&Xi;', 'Омикрон' => '&Omicron;', 'Пи' => '&Pi;', 'Ро' => '&Rho;', 'Сигма' => '&Sigma;',
                       'Тау' => '&Tau;', 'Ипсилон' => '&Upsilon;', 'Фи' => '&Phi;',
                       'Хи' => '&Chi;', 'Пси' => '&Psi;', 'Омега' => '&Omega;');

echo"

<table style='width: 100%;'>
    <tr><td style='height: 14px;'></td></tr>
    <tr><td style='width: 0px;'></td></tr>
    <tr>
        <td style='height: 30px; color: #ffffff; text-align: center; font-weight: bold; border-radius: 6px;' class='borderColor' colspan='3'>
            Отправить личное сообщение
        </td>
    </tr>
    <tr><td style='height: 5px;'></td></tr>
    <tr>
    <tr>
        <td style='width: 35%;'>
            <select id='selectFriend'
            onchange=\"
            if(document.getElementById('selectFriend').value == 'selectFriend'){
                document.getElementById('receiveMail').value = '';
                $('#receiveMail').focus();
            }
            else{
                document.getElementById('receiveMail').value = document.getElementById('selectFriend').value;
                $('#receiveMail').focus();
            }
            \">
              <option value='selectFriend'>Выбрать друга</option>";

for($i = 0; $i<count($arrFriends[0]); $i++){
    $friend = $arrFriends[2][$i];
    if($friend)
    echo "<option value='$friend'>$friend</option>";
}

echo "
            </select>
        </td>
        <td style='text-align: center'>

            <input id='receiveMail' style='height: 30px; width: 250px;' maxlength='20'  type='text' value='' onfocus=\"
            testNikPrivateMail(document.getElementById('receiveMail').value);
            \" onchange = \"
            testNikPrivateMail(document.getElementById('receiveMail').value);
            \">
        </td>
        <td style='width: 35%;'>
            <img id='iconTableNewLetterUserYes' class='none' width='20px' src='css/forumStyle/images/yes.png'>
            <img id='iconTableNewLetterUserNo' class='none' width='20px' src='css/forumStyle/images/no.png'>
        </td>
    </tr>
    <tr>
        <td>
            <!-- /////////////////////// -->
            <select id='selectSymbol'
            onchange=\"
            if(document.getElementById('selectSymbol').value == 'selectOne'){
                document.getElementById('textReceiveMail').value = document.getElementById('textReceiveMail').value;
                $('#textReceiveMail').focus();
            }
            else{
                document.getElementById('textReceiveMail').value = document.getElementById('textReceiveMail').value + document.getElementById('selectSymbol').value;
                $('#textReceiveMail').focus();
            }
            \">
              <option value='selectOne'>Спец символы</option>";

for($i = 0; $i<count($specialSymbol); $i++){
    $special = $specialSymbol[$i];
    if($special)
        echo "<option value='$special'>$special</option>";
}

echo "
            </select>
            <!-- /////////////////////// -->
            <!-- /////////////////////// -->
            <select id='selectGreekLanguage'
            onchange=\"
            if(document.getElementById('selectGreekLanguage').value == 'selectOne'){
                document.getElementById('textReceiveMail').value = document.getElementById('textReceiveMail').value;
                $('#textReceiveMail').focus();
            }
            else{
                document.getElementById('textReceiveMail').value = document.getElementById('textReceiveMail').value + document.getElementById('selectGreekLanguage').value;
                $('#textReceiveMail').focus();
            }
            \">
              <option value='selectOne'>Греческие буквы</option>";

foreach($greekLanguage as $key=>$value){
    echo "<option value='$value'>$key</option>";
}

echo "
            </select>
            <!-- /////////////////////// -->
        </td>
        <td style='text-align: center;'>
            <input id='inputThemeMail' style='height: 30px; width: 250px;' maxlength='20'  type='text' value='Тема сообщения' onclick=\"
            if(this.value == '$themeMail')
            this.value = '';
            \" onblur=\"
            if(this.value == '')
            this.value = '$themeMail';
            \"/>
        </td>
        <td></td>
    </tr>
    <tr>
        <td colspan='3' >
            <textarea id='textReceiveMail' rows='7' style='width: 100%; font-size: 14px;' maxlength='1000'></textarea>
        </td>
    </tr>
    <tr>
        <td style='text-align: center' colspan='3'>
            <button id='buttonPrivateLetterSend' style='height: 30px; width: 250px; font-size: 14px; text-align: center;'
            onclick=\"
            var themeMail = document.getElementById('inputThemeMail').value;
            if(document.getElementById('inputThemeMail').value == '$themeMail')
            themeMail = 'Без темы';

            sendPrivateMail(
            '$themeMail',
            themeMail,
            '$nameSession',
            document.getElementById('receiveMail').value,
            document.getElementById('textReceiveMail').value);\">Отправить</button>
        </td>
    </tr>
    <tr><td style='height: 5px;'></td></tr>
    <tr><td style='height: 10px;  border-radius: 6px;' class='borderColor' colspan='3'></td></tr>
    <tr><td style='height: 14px;'></td></tr>
</table>
";