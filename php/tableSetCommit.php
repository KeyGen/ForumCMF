<?php
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

$typeCode = array('C++' => '[CPLUSPLUS][/CPLUSPLUS]','Php'=>'[PHP][/PHP]');

echo"

<table style='width: 100%;'>
    <tr><td style='height: 14px;'></td></tr>
    <tr><td style='width: 0px;'></td></tr>
    <tr><td><div style='margin: 30px 30px 30px 30px; border: 1px solid #000000; border-radius: 10px; background-color: #666666;'>
    <div id='showText' style='margin: 30px 30px 30px 30px; color: #ffffff; font-weight: bold;'></div></div><br><br></td></tr>
    <tr>
        <td style='height: 30px; color: #ffffff; text-align: center; font-weight: bold; border-radius: 6px;' class='borderColor' colspan='3'>
            Оставить коментарий
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
            <select id='selectTypeCode'
            onchange=\"
            if(document.getElementById('selectTypeCode').value == 'selectOne'){
                document.getElementById('textReceiveMail').value = document.getElementById('textReceiveMail').value;
                $('#textReceiveMail').focus();
            }
            else{
                document.getElementById('textReceiveMail').value = document.getElementById('textReceiveMail').value + document.getElementById('selectTypeCode').value;
                $('#textReceiveMail').focus();
            }
            \">
              <option value='selectOne'>Тип кода</option>";

foreach($typeCode as $key=>$value){
    if($key)
        echo "<option value='$value'>$key</option>";
}

echo "
            </select>
            <!-- /////////////////////// -->
    </tr>
    <tr>
        <td colspan='3' >
            <textarea id='textReceiveMail' rows='7' style='width: 100%; font-size: 14px;' maxlength='1000'></textarea>
        </td>
    </tr>
    <tr>
        <td style='text-align: center' colspan='3'>
            <input type='button' onclick=\"previewSetCommit(document.getElementById('textReceiveMail').value);\" value='Предворительный просмотр'>
        </td>
    </tr>
    <tr><td style='height: 5px;'></td></tr>
    <tr><td style='height: 10px;  border-radius: 6px;' class='borderColor' colspan='3'></td></tr>
    <tr><td style='height: 14px;'></td></tr>
</table>
";