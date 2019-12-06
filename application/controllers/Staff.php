<?php
class Staff extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
        $this->load->model("FileModel");

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
    {
        $result=$this->FileModel->getFileInfo($_SESSION['province']);
        //直接返回结果(二维数组)，然后交给前端处理
        $this->ci_smarty->assign("baobiaos",$result);
        $this->ci_smarty->display("staff/index.html");
    }





    //报表上报
    public function uploadFile()
    {



    }

    //报表修改
    public function editFile()
    {

    }



    //报表查看
    public function viewFile()
    {

    }



    




    public function check()
    {
        $this->ci_smarty->assign("");
        $this->ci_smarty->display("staff/check.html");
    }

    //报表管理
    public function managerFile()
    {
        


    }

}