<?php
class Admin extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
        $this->load->model("AdminModel");

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

    //用户管理index
    public function userIndex(
        string $mode="",
        string $value=""
    )
    {
        //获取搜索条件
        if($mode=="id")
        {
            $users=$this->AdminModel->findUser('id',$value);            
        }
        elseif($mode=="name")
        {
            $users=$this->AdminModel->findUser('username',$value);
        }else
        {
            $mode="id";
            $users=$this->AdminModel->findUser('2>','1');
        }

        $this->ci_smarty->assign("mode",$mode);
        $this->ci_smarty->assign("users",$users);
        $this->ci_smarty->display("admin/userIndex.html");
    }

    //用户管理详细
    public function userManager(
        int $id = null
    )
    {
        if(empty($id))
        {
            redirect("admin/userindex");
        }

        $result=$this->AdminModel->findUser('id=',$id);
        $userInfo=$result[0];

        $this->ci_smarty->assign('userInfo',$userInfo);
        $this->ci_smarty->display("admin/userManager.html");
        

    }

    //修改用户信息(姓名或者省份/公司)
    public function changeUserInfo(
        // int $id=null,
        // string $username="",
        // string $province=""
    )
    {
        $this->output->set_content_type('application/json');

        $id = $this->input->post('id');
        $userInfo['username'] = $this->input->post('username');
        $userInfo['province'] = $this->input->post('province');


        if(empty($id))
        {
            $this->output->set_output(json_encode([
                "code" => 0,
                "message" => "没有检测到用户id"
            ]));
            return;
        }

        if(in_array("",$userInfo))
        {
            $this->output->set_output(json_encode([
                "code" => 0,
                "message" => "请填写完整信息"
            ]));
            return;
        }

        $this->AdminModel->updateUser($id,$userInfo);
        $this->output->set_output(json_encode([
            "code" => 1,
            "message" => "修改信息成功"
        ]));
        return;

    }

    //修改密码
    public function changeUserPasswd(
        // int $id=null,
        // string $newPasswd=''
    )
    {
        $this->output->set_content_type('application/json');

        $id = $this->input->post('id');
        $pwd = $this->input->post("pwd");

        $userInfo['passwd']=password_hash($pwd,PASSWORD_BCRYPT);

        if(empty($id))
        {
            $this->output->set_output(json_encode([
                "code" => 0,
                "message" => "没有检测到用户id"
            ]));
            return;
        }

        if(empty($userInfo['passwd']))
        {
            $this->output->set_output(json_encode([
                "code" => 0,
                "message" => "请填写完整信息"
            ]));
            return;
        }

        $this->AdminModel->updateUser($id,$userInfo);
        $this->output->set_output(json_encode([
            "code" => 1,
            "message" => "修改密码成功"
        ]));
        return;

    }

    //删除用户
    public function deleteUser(
        // int $id=null,
        // string $newPasswd=''
    )
    {
        $this->output->set_content_type('application/json');

        $id = $this->input->post('id');

        if(empty($id))
        {
            $this->output->set_output(json_encode([
                "code" => 0,
                "message" => "没有检测到用户id"
            ]));
            return;
        }

        $this->AdminModel->deleteUser($id);
        $this->output->set_output(json_encode([
            "code" => 1,
            "message" => "删除用户成功"
        ]));
        return;

    }  

    //添加用户
    public function addUser()
    {
        $this->ci_smarty->display("admin/userAdd.html");
    }
    

    public function insertUser()
    {

        $this->output->set_content_type("application/json");

        if($this->input->method()!='post')
        {
            $this->output->set_output(json_encode([
                "code" => 0,
                "message" => "非法请求"
            ]));
            return;
        }

        $user['id']      =  $this->input->post('id',TRUE);
        $user['passwd']     =  password_hash($this->input->post('password'),PASSWORD_BCRYPT);
        $user['username']    =  $this->input->post('username',TRUE);
        $user['province']   =  $this->input->post('province',True);


        if(in_array("",$user))
        {
            $this->output->set_output(json_encode([
                "code" => 0,
                "message" => "请填写完整信息"
            ]));
            return;
        }


        //先查重
        $result=$this->AdminModel->findUser('id',$user['id']);
        if(!empty($result))
        {
            $this->output->set_output(json_encode([
                "code" => 0,
                "message" => '用户已存在'
            ]));
        }
        else
        {
            $this->AdminModel->addUser($user);
            $this->output->set_output(json_encode([
                "code" => 1,
                "message" => "用户添加成功"
            ]));
        }

    }

    


    //审核
    public function audit()
    {
        
        $this->ci_smarty->assign("");
        $this->ci_smarty->display("admin/audit.html");
    }

}