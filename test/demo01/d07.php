<?php
//第一步：打开源图
$src_img = imagecreatefromjpeg('./imgs/12.jpg');
//第二步：打开目标图
$dst_img = imagecreatefromjpeg('./imgs/2211.jpg');
//第三步：将源图复制到目标图上
$dst_x = imagesx($dst_img)-imagesx($src_img);//开始粘贴的x
$dst_y = imagesx($dst_img)-imagesy($src_img);//开始粘贴的y
$src_w=imagesx($src_img);
$src_h=imagesy($src_img);
imagecopy($dst_img, $src_img, $dst_x, $dst_y, 0, 0,$src_w-100, $src_h-200);
//显示水印图
header('content-type:image/jpeg');
imagejpeg($dst_img);