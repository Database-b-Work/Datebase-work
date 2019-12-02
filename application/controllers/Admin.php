<?php
class Admin extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
        // $this->load->model("AdminModel");

        //权限控制
        if(@!($_SESSION['isLogined']&&$_SESSION['admin'])){
            redirect("user/login");
            return;
        }
    }

    public function  index()
    {   
        $this->ci_smarty->assign("");
        $this->ci_smarty->display("admin/index.html");
    }

    //用户管理
    public function userManager()
    {
        


        $this->ci_smarty->assign("");
        $this->ci_smarty->display("admin/userManager.html");
    }


    //审核
    public function audit()
    {
        
        $this->ci_smarty->assign("");
        $this->ci_smarty->display("admin/audit.html");
    }
    
}