<?php
namespace Controller\Admin;


use Core\Controller;

class BaseController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->checkLogin();
    }

    private function checkLogin()
    {
        if (in_array(CONTROLLER_NAME, ['Login'])){
            return;
        }
        if(empty($_SESSION['user'])){
            $this->error('index.php?p=Admin&c=Login&a=login', '您没有登录');
            exit;
        }
    }
}