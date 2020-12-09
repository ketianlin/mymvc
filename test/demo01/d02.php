<?php
$img = imagecreate(200,100);	//创建图片资源
$color = imagecolorallocate($img,200,200,200);
//更改背景色
switch(rand(1,100)%3) {
    case 0:
        $color=imagecolorallocate($img,255,0,0);	//颜色的索引编号
        break;
    case 1:
        $color=imagecolorallocate($img,0,255,0);
        break;
    default:
        $color=imagecolorallocate($img,0,0,255);
}
//填充颜色
imagefill($img,0,0,$color);
//显示图片
header('content-type:image/png');
imagepng($img);