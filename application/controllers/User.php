<?php
class User extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("UserModel");
        $this->load->model("CaptchaModel");
    }

    public function login()
    {
        if($_SERVER['REQUEST_METHOD']=='GET'){
            $this->load->view("common/login");
            return;
        }

        //先判断验证码是否正确
        if(!$this->CaptchaModel->verify(
            $_POST['verify']
        )){
            return $this->output
            ->set_content_type("application/json")
            ->set_output(json_encode([
                "code" => 1,
                "message" => "验证码错误",
            ]));
        }

        //再判断用户登录是否正确
        if(!$this->UserModel->login(
            $_POST['username'],
            $_POST['password']
        )){
            return $this->output
            ->set_content_type("application/json")
            ->set_output(json_encode([
                "code" => 1,
                "message" => "用户名或密码错误",
            ]));
        }

        return $this->output
        ->set_content_type("application/json")
        ->set_output(json_encode([
            "code" => 0,
            "message" => "",
            "admin" => $_SESSION['admin'],
        ]));
    }

    public function index(){
        if(!$_SESSION['isLogined']){
            redirect("/user/login");
            //url辅助函数重定向到login
        }elseif($_SESSION['admin']){
            redirect("admin/index");
        }else{
            redirect("staff/index");
        }
    }
}