<?php
$w=256; // Ширина уменьшеного фото
$nh=256; // Высота уменьшеного фото
$size=500; // Максимальный вес фото в киллобайтах, если её размеры меньше 500*375. Например, если грузят анимацию gif размером 50*35, но весит она 1мб
$dir='../resources/tempAvatar/'; // Папка для сохранения фото (не менять)
$tt='Ваше фото по размерам меньше '.$w.'*'.$nh.', но весит больше '.$size.' кб';

error_reporting (1);
$sd=strtolower($_FILES['ufile']['name']);

if ($_POST['act']=="upf" && $_FILES['ufile']['name']<>'' && (preg_match("/\.jpg$/",$sd) or preg_match("/\.png$/",$sd) or preg_match("/\.gif$/",$sd))) {

    $s=GetImageSize($_FILES['ufile']['tmp_name']) or exit;
    $na=substr(time(),3,9).substr(sprintf('%.3f',microtime()),2,4);
    $t=preg_replace('/(.*)(.{4})$/','\2',$sd);

    $sf=$_FILES['ufile']['size']/1024;

    if($s[0]<=$w && $s[1]<=$nh && $sf<$size){
        copy($_FILES['ufile']['tmp_name'], $dir.$na.$t);
        echo "<script>parent.document.getElementById('image_list').value ='$na$t';</script>";
        echo "<script>parent.document.getElementById('avatar').src = 'resources/tempAvatar/$na$t';</script>";
        echo "<script>parent.document.getElementById('buttonEditorAvatarSaveDownload2').className = 'block';</script>";

        exit;
    }
    if($s[0]<=$w && $s[1]<=$nh && $sf>$size){
        echo "<script>alert('".$tt."');</script>";
        exit;
    }

    $sn=$_FILES['ufile']['tmp_name'];

    if(preg_match("/\.png$/",$sd)){
        $p=ImageCreateFromPNG($sn);
    }
    if(preg_match("/\.jpg$/",$sd)){
        $p=ImageCreateFromjpeg($sn);
    }
    if(preg_match("/\.gif$/",$sd)){
        $p=ImageCreateFromgif($sn);
    }
    $k=$s[0]/$w;
    $h=ceil($s[1]/$k);
    if($h>$nh){
        $kh=$h/$nh;
        $h=$nh;
        $w=ceil($w/$kh);
    }
    $d=ImageCreateTrueColor($w,$h);
    imageAlphaBlending($d,false);
    imageSaveAlpha($d,true);
    imagecopyresampled($d,$p,0,0,0,0,$w,$h,$s[0],$s[1]);
    imagejpeg($d,$dir.$na.'.jpg');
    imagedestroy($p);
    imagedestroy($d);

    echo "<script>parent.document.getElementById('image_list').value ='$na.jpg';</script>";
    echo "<script>parent.document.getElementById('avatar').src = 'resources/tempAvatar/$na.jpg';</script>";
    echo "<script>parent.document.getElementById('buttonEditorAvatarSaveDownload2').className = 'block';</script>";
    exit;
}
else {exit;}
?>