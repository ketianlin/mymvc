<?php
//第一步：创建目标图
$dst_img=imagecreatetruecolor(200,200);
//第二步：打开源图
$src_img=imagecreatefromjpeg('./imgs/face.jpg');
//第三步：复制源图拷贝到目标图上，并缩放大小
$src_w=imagesx($src_img);
$src_h=imagesy($src_img);
imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, 200, 200, $src_w, $src_h);
//第四步：保存缩略图
//header('content-type:image/jpeg');
imagejpeg($dst_img,'./imgs/face1.jpg');
?>
<img src="./imgs/face1.jpg" alt="">
