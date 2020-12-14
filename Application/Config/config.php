<?php
return [
    //数据库配置
    'database'=>[
        'type'=>'mysql',
        'host'=>'127.0.0.1',
        'port'=>'3306',
        'dbname'=>'abc',
        'charset'=>'utf8',
        'user'=>'root',
        'pwd'=>'root'
    ],
    //应用程序配置
    'app'=>[
        'dp'    =>  'Admin',        //默认平台
        'dc'    =>  'Products',     //默认控制器
        'da'    =>  'list',          //默认方法

        'key'   =>  'mymvc',       //加密秘钥
        'path'  =>  './Public/Uploads/',
        'size'  =>  1234567,
        'type'  =>  ['image/png','image/jpeg','image/gif']
    ]
];