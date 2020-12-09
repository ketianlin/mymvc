<?php
//第一步：创建随机字符串
//1.1  创建字符数组
$all_array = array_merge(range('a', 'z'), range('A', 'Z'), range('0', '9'));//所有字符数组
$div_array = ['1','l','0','o','O','I','9','g'];	//去除容易混淆的字符
$array = array_diff($all_array, $div_array);//剩余的字符数组
unset($all_array, $div_array);//销毁不需要使用的数组
//1.2	随机获取4个字符
$index = array_rand($array, 4);//随机取4个字符,返回字符下标，按先后顺序排列
shuffle($index);	//打乱字符
//1.3	通过下标拼接字符串
$code = '';
foreach ($index as $i){
    $code .= $array[$i];
}

//第二步：创建画布
$img = imagecreate(150, 30);
imagecolorallocate($img, 255, 0, 0);//分配背景色
$color = imagecolorallocate($img,255,255,255);	//分配前景色

//第三步：将字符串写到画布上
$font = 5;		//内置5号字体
$x = (imagesx($img) - imagefontwidth($font)*strlen($code))/2;
$y = (imagesy($img) - imagefontheight($font))/2;
imagestring($img, $font, $x, $y, $code, $color);

//显示验证码
header('content-type:image/gif');
imagegif($img);