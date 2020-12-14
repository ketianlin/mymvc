<?php
namespace Lib;

class Image{
    /**
     * 制作缩略图
     * @param $src_path  源图的路径   比如：./Public/Uploads/2020-12-14/aa.jpg
     * @param string $prefix
     * @param int $w
     * @param int $h
     */
    public function thumb($src_path, $prefix='small_', $w=200, $h=200){
        $dst_img = imagecreatetruecolor($w, $h);    //目标图
        $src_img = imagecreatefromjpeg($src_path);  //源图
        $src_w = imagesx($src_img);
        $src_h = imagesy($src_img);
        if ($src_w/$src_h > $w/$h){
            $dst_w = $w;
            $dst_h = $dst_w * $src_h / $src_w;
        }else{
            $dst_h = $h;
            $dst_w = $src_w * $dst_h / $src_h;
        }
        $dst_w = (int)$dst_w;
        $dst_h = (int)$dst_h;
        //目标的坐标
        $dst_x = ($w - $dst_w) / 2;
        $dst_y = ($h - $dst_h) / 2;
        imagecopyresampled($dst_img, $src_img, $dst_x, $dst_y, 0,0, $dst_w, $dst_h,$src_w, $src_h);
        $filename = basename($src_path);//文件名    aa.jpg
        $foldername = substr(dirname($src_path), -10);//目录名  2020-12-14
        $save_path = dirname($src_path).'/'.$prefix.$filename;//./Public/Uploads/2020-12-14/aa.jpg
        imagejpeg($dst_img, $save_path);
        return "{$foldername}/{$prefix}{$filename}";//2020-12-14/small_aa.jpg
    }

    /*
     * 非等比制作缩略图
     * @param $src_path 源图的路径   比如：./Public/Uploads/2019-07-01/aa.jpg
     */
    public function thumb2($src_path,$prefix='small_',$w=200,$h=200){
        $dst_img=imagecreatetruecolor($w,$h);   //目标图
        $src_img=imagecreatefromjpeg($src_path);    //源图
        $src_w=imagesx($src_img);
        $src_h=imagesy($src_img);
        imagecopyresampled($dst_img,$src_img,0,0,0,0,$w,$h,$src_w,$src_h);
        $filename=basename($src_path);  //文件名    aa.jpg
        $foldername=substr(dirname($src_path),-10); //目录名  2019-07-01
        $save_path= dirname($src_path).'/'.$prefix.$filename;   //  ./Public/Uploads/2019-07-01/small_aa.jpg
        imagejpeg($dst_img,$save_path);
        return "{$foldername}/{$prefix}{$filename}";    //2019-07-01/small_aa.jpg
    }
}