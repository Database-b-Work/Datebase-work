<?php
class Admin extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
        $this->load->model("AdminModel");
		$this->load->model("FileModel");
		$this->load->model('ZhiBiaoModel');
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
     
		
		// $result=$this->FileModel->getFileDetail($i);
		
		$result=$this->FileModel->getFullinfo();
        //直接返回结果(二维数组)，然后交给前端处理
        $this->ci_smarty->assign("baobiaos",$result);
        $this->ci_smarty->display("admin/audit.html");
    }
	
	public function viewFile(int $month,string $province){
	
        //$_SESSION['editMonth']=$month;
        //$_SESSION['editStatus']=$this->FileModel->getFileStatus($month);
        //通过把要修改的month 放到session里，绑定要操作的month,防止用户恶意篡改其他月份信息，比如修改已经通过审核的月份报表信息
        //同时把status 放到session中，为了方便后面使用
		$province=urldecode($province);
        $result=$this->FileModel->getFileDetail_byAdmin($month,$province);
        if(empty($result)){
            echo "<script>alert('未上传$month 月份报表')</script>";
            header("refresh:0;url=/admin/audit");
            return;
        }

        //传二维数组的json 形式到前端 ，前端不需要解析json，直接用
        //如果直接传二维数组会报错
        //前端script标签要加上type="text/Javascript"，否则js中无法使用smarty
        $this->ci_smarty->assign('result',json_encode($result));
        $this->ci_smarty->display('admin/viewFile.html');
    

	}

	public function passFile(
		string $province,
		int $month
	){
	//更新报表状态6(确认状态)
	 $condition=[
            "province"=>urldecode($province),
            "month" => $month
        ];
        $dest=[
            "status" =>6
        ];
        $this->FileModel->updateFile($condition,$dest);

        $this->output->set_content_type("application/json");

		$this->output->set_output(json_encode([
            "code" => 1,
            "message" => "通过成功"
        ]));
        return;

	}

	//退回文件
	public function backFile(
		string $province,
		int $month
	){
	//更新报表状态1(退回状态)
	 $condition=[
            "province"=>urldecode($province),
            "month" => $month
        ];
        $dest=[
            "status" =>1
        ];
        $this->FileModel->updateFile($condition,$dest);
		
		//删除zhibiao表中的相关数据
		$this->ZhiBiaoModel->deleteZhibiao($month,urldecode($province));

        $this->output->set_content_type("application/json");

		$this->output->set_output(json_encode([
            "code" => 1,
            "message" => "退回成功"
        ]));
        return;

	}



}
