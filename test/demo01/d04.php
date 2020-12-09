<?php
//第一步：生成随机字符串
$codeSet='2345678abcdefhijkmnpqrstuvwxyzABCDEFGHJKLMNPQRTUVWXY';
$code='';
$max = strlen($codeSet);
for ($i=1;$i<=4;$i++){
    $index = rand(0, $max-1);
    $code .= $codeSet[$index];
}
//第二步：打开图片
$path = './captcha/captcha_bg'.rand(1,5).'.jpg';
$img = imagecreatefromjpeg($path);
//第三步：将字符串写到图片上
$font=5;		//内置5号字体
$x = (imagesx($img) - imagefontwidth($font)*strlen($code))/2;
$y = (imagesy($img) - imagefontheight($font))/2;
//随机前景色
$color=imagecolorallocate($img,255,255,255);	//设置背景色
if (rand(1,100)%2){
    $color=imagecolorallocate($img,255,0,255);	//设置背景色
}
imagestring($img, $font, $x, $y, $code, $color);
//显示验证码
header('content-type:image/gif');
imagegif($img);
