<?php
$max_w=300;
$max_h=300;
$dst=imagecreatetruecolor($max_w,$max_h);
$src=imagecreatefromjpeg('./imgs/1211.jpg');
$src_w=imagesx($src);		//源图的宽度
$src_h=imagesy($src);		//源图的高度
if($src_w/$src_h>$max_w/$max_h){
    $dst_w=$max_w;
    $dst_h=$dst_w*$src_h/$src_w;
}else {
    $dst_h=$max_h;
    $dst_w=$src_w*$dst_h/$src_h;
}
$dst_w=(int)$dst_w;
$dst_h=(int)$dst_h;
//目标的坐标
$dst_x=($max_w-$dst_w)/2;
$dst_y=($max_h-$dst_h)/2;
imagecopyresampled($dst,$src,$dst_x,$dst_y,0,0,$dst_w,$dst_h,$src_w,$src_h);
header('content-type:image/jpeg');
imagejpeg($dst);
