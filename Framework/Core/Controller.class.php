<?php
namespace Core;

use Lib\Session;
use Traits\Jump;

class Controller
{
    use Jump;
    public function __construct()
    {
        $this->initSession();
    }

    private function initSession()
    {
        new Session();
    }
}