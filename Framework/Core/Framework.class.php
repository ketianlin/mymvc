<?php

class Framework
{
    //启动框架
    static public function run(){
        self::initConst();
        self::initConfig();
        self::initRoutes();
        self::initAutoLoad();
        self::initDispatch();
    }

    //定义路径常量
    static private function initConst()
    {
        define('DS', DIRECTORY_SEPARATOR);//定义目录分隔符
        define('ROOT_PATH', getcwd().DS);//入口文件所在的目录
        define('APP_PATH', ROOT_PATH.'Application'.DS);//application目录
        define('CONFIG_PATH', APP_PATH.'Config'.DS);
        define('CONTROLLER_PATH', APP_PATH.'Controller'.DS);
        define('MODEL_PATH', APP_PATH.'Model'.DS);
        define('VIEW_PATH', APP_PATH.'View'.DS);
        define('FRAMEWORK_PATH', ROOT_PATH.'Framework'.DS);
        define('CORE_PATH', FRAMEWORK_PATH.'Core'.DS);
        define('LIB_PATH', FRAMEWORK_PATH.'Lib'.DS);
        define('TRAITS_PATH', ROOT_PATH.'Traits'.DS);
    }

    //引入配置文件
    static private function initConfig()
    {
        $GLOBALS['config'] = require CONFIG_PATH.'config.php';
    }

    //确定路由
    static private function initRoutes()
    {
        $p = $_GET['p'] ?? $GLOBALS['config']['app']['dp'];
        $c = $_GET['c'] ?? $GLOBALS['config']['app']['dc'];
        $a = $_GET['a'] ?? $GLOBALS['config']['app']['da'];
        $p = ucfirst(strtolower($p));
        $c = ucfirst(strtolower($c));
        $a = strtolower($a);
        define('PLATFROM_NAME', $p);//平台名常量
        define('CONTROLLER_NAME', $c);//控制器名常量
        define('ACTION_NAME', $a); //方法名常量
        define('__URL__', CONTROLLER_PATH.$p.DS);//当前请求控制器的目录地址
        define('__VIEW__', VIEW_PATH.$p.DS);//当前视图的目录地址
        define('__VIEWC__', APP_PATH.'Viewc'.DS.$p.DS);//混编目录
    }

    //自动加载类
    static private function initAutoLoad()
    {
        spl_autoload_register(function ($class_name){
            //Smarty类存储不规则，所以将类名和地址做一个映射
            $map = [
                'Smarty' => LIB_PATH.'Smarty'.DS.'Smarty.class.php'
            ];
            $namespace = dirname($class_name);      //命名空间
            $class_name = basename($class_name);    //类名
            if (in_array($namespace, ['Core', 'Lib'])){
                $path = FRAMEWORK_PATH.$namespace.DS.$class_name.'.class.php';
            }elseif ($namespace == 'Model'){
                $path = MODEL_PATH.$class_name.'.class.php';
            }elseif ($namespace == 'Traits'){
                $path = TRAITS_PATH.$class_name.'.class.php';
            }elseif (isset($map[$class_name])){
                $path = $map[$class_name];
            }else{
                $path = __URL__.$class_name.'.class.php';
            }
            if (file_exists($path) && is_file($path)){
                require $path;
            }
        });
    }

    //请求分发
    static private function initDispatch()
    {
        $contoller_name = DS.'Controller'.DS.PLATFROM_NAME.DS.CONTROLLER_NAME.'Controller';
        $action_name = ACTION_NAME.'Action';
        $obj = new $contoller_name();
        $obj->$action_name();
    }
}