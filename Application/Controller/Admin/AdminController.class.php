<?php


namespace Controller\Admin;


class AdminController extends BaseController
{
    public function adminAction(){
        var_dump($_SESSION);exit;
        require __VIEW__.'admin.html';
    }
    public function topAction(){
        require __VIEW__.'top.html';
    }
    public function menuAction(){
        require __VIEW__.'menu.html';
    }
    public function mainAction(){
        require __VIEW__.'main.html';
    }
}