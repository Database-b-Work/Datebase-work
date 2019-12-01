<?php
class Admin extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
        // $this->load->model("AdminModel");
    }

    public function  index()
    {
        //权限控制
        if(!($_SESSION['isLogined']&&$_SESSION['admin'])){
            $this->load->view("common/login");
            return;
        }
        
        $this->load->view("admin/index");
    }
}