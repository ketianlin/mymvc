<?php
namespace Core;

use Lib\Session;
use Traits\Jump;

class Controller
{
    protected $smarty;
    use Jump;
    public function __construct()
    {
        $this->initSession();
        $this->initSmarty();
    }

    private function initSession()
    {
        new Session();
    }

    private function initSmarty()
    {
        $this->smarty = new \Smarty();
        $this->smarty->setTemplateDir(__VIEW__);//设置模板目录
        $this->smarty->setCompileDir(__VIEWC__);//设置混编目录
    }
}