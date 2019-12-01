<?php
class Staff extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
        // $this->load->model("AdminModel");
    }

    public function  index()
    {
        //权限控制
        if(!$_SESSION['isLogined']){
            $this->load->view("common/login");
            return;
        }elseif($_SESSION['admin']){
            //helper("url")已经在autoload.php中自动加载
            redirect("/admin/index");
        }
        
        $this->load->view("staff/index");
    }
}