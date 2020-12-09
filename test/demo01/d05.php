<?php
//第一步：生成随机字符串
$codeSet='们以我到他会作时要动国产的一是工就年阶义发成部民可出能方进在了不和有大这主中人上为来';
$max=mb_strlen($codeSet)-1;	//中文字符的最大索引号
$code='';
for($i=0; $i<4; $i++) {
    $start=rand(0,$max);
    $code.=mb_substr($codeSet,$start,1);
}
//第二步：创建画布
$img=imagecreate(150,40);
imagecolorallocate($img,255,0,0);
//第三步：将字符串写到画布上
//3.1  指定字符串的参数
$color = imagecolorallocate($img,255,255,255);
$size=15;	//字号
$angle=0;	//角度
//$fontfile='C:/phpstudy_pro/WWW/mymvc/test/demo01/ttf/simhei.ttf';	//字体路径
$fontfile=realpath('./ttf/simkai.ttf');	//字体路径
//3.2 测定字符串的范围
$info = imagettfbbox($size, $angle, $fontfile, $code);
$code_w=$info[4]-$info[6];	//字符串的宽度
$code_h=$info[1]-$info[7];	//字符串的高度
$x=(imagesx($img)-$code_w)/2;	//起始点的$x
$y=(imagesy($img)+$code_h)/2;	//起始点的$y
//3.3  将中文字符串写到画布上
imagettftext($img, $size, $angle, $x, $y, $color, $fontfile, $code);//将文字写到画布上
//显示验证码
header('content-type:image/jpeg');
imagejpeg($img);