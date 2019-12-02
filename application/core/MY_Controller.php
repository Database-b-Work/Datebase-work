<?php

//进行smarty 的一些封装,可以直接继承MY_controller类，达到直接使用assign,display函数
class MY_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function assign($key, $val)
    {
        $this->ci_smarty->assign($key, $val);
    }
    public function display($html)
    {
        $this->ci_smarty->display($html);
    }
}