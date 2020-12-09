<?php
//第一步：打开图片
$img=imagecreatefromjpeg('./imgs/2211.jpg');
//第二步：将文字写到图片上
$color=imagecolorallocate($img,255,0,0);
$size=35;	//字号
$angle=0;	//角度
$fontfile=realpath('./ttf/simkai.ttf');	//字体路径
$code='我是一个福州人';

$info=imagettfbbox($size,$angle,$fontfile,$code);
$code_w=$info[4]-$info[6];	//字符串的宽度
$code_h=$info[1]-$info[7];	//字符串的高度

$x=imagesx($img)-$code_w;	//起始点的$x
$y=imagesy($img)-$code_h;	//起始点的$y
//将中文字符串写到画布上
imagettftext($img,$size,$angle,$x,$y,$color,$fontfile,$code);	//将文字写到画布上
//第三步：保存图片
imagejpeg($img,'./imgs/face.jpg');
?>
<img src="./imgs/face.jpg" alt="">
