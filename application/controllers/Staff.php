<?php
class Staff extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
        // $this->load->model("AdminModel");

        //权限控制
        if(@!$_SESSION['isLogined']){
            redirect("common/login");
            return;
        }elseif(@$_SESSION['admin']){
            //helper("url")已经在autoload.php中自动加载
            redirect("/admin/index");
        }
    }
  
    public function  index()
    { //  $a=5;
        //$this->ci_smarty->assign("a",$a);
        $this->ci_smarty->assign("");
        $this->ci_smarty->display("staff/index.html");
    }

    public function fileupload()
    {
        $this->ci_smarty->assign("");
        $this->ci_smarty->display("staff/fileupload.html");

    }

}