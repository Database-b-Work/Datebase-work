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
    
    public function roleIndex(
        string $mode="",
        string $value=""
      )
      {
          //获取搜索条件
          if($mode=="id")
          {
              $users=$this->AdminModel->findRole('id',$value);            
          }
          elseif($mode=="name")
          {
              $users=$this->AdminModel->findRole('username',$value);
          }else
          {
              $mode="id";
              $users=$this->AdminModel->findRole('2>','1');
              $roles=$this->AdminModel->findRole2('2>','1');
          }
  
          $this->ci_smarty->assign("mode",$mode);
          $this->ci_smarty->assign("users",$users);
          $this->ci_smarty->assign("roles",$roles);
          $this->ci_smarty->display("admin/roleIndex.html");
      }
  
      public function addRole()
      {
  
          $c=$this->AdminModel->findAuth();
        //  print_r($c);
          $b=array();
          $a=array();
          $b=$c[1];
          $a=$c[0];    
          
          
         // $c=array('Joe Schmoe','Jack Smith','Jane Johnson','Charlie Brown');
          //print_r($b); 
          $this->ci_smarty->assign('b',$b);
          $this->ci_smarty->assign('a',$a);
          $this->ci_smarty->display("admin/roleAdd.html");
          
      }
      public function insertRole()
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
          
         
          $role['value']=  $this->input->post('value',TRUE);
          $role['text']=$this->input->post('text',TRUE);
          if(in_array("",$role))
          {
              $this->output->set_output(json_encode([
                  "code" => 0,
                  "message" => "请填写完整信息"
              ]));
              return;
          }
  
          $result=$this->AdminModel->findRolebyname($role['text']);
          if(!empty($result))
          {
              $this->output->set_output(json_encode([
                  "code"=>0,
                  "message"=>"该角色已存在"
              ]));
              return;
          }
  
          else
          {
              //$number=sizeof($this->AdminModel->findRoleall())+1;
              $role_add=array();
              $roleid=array();
              $temp=array();
            //  $role_add['code']=$number; //角色id
              $role_add['name']=$role['text'];
              $this->AdminModel->addRole($role_add);
              $ruleid=explode(",",$role['value']);
              $result1=$this->AdminModel->findRolebyname($role['text']);
              
              for($i=0;$i<sizeof($ruleid)-1;$i++) //循环更新角色对应的权限
             //-1是因为有一个空格 
              {   
                  $temp['roleid']=$result1[0]['code']; //得到自增的角色号
                  $temp['ruleid']=$ruleid[$i];
                  $this->AdminModel->addRole_rule($temp);
              }
              $this->output->set_output(json_encode([
                  "code" => 1,
                  "message" => "角色添加成功"
              ]));
          }
  
  
        return ;
  
      }
      public function deleteRole() //弹页面用
      {
          $c=$this->AdminModel->findRole1();
          $b=array();
          $a=array();
          $b=$c[1];
          $a=$c[0];
          $this->ci_smarty->assign('b',$b);
          $this->ci_smarty->assign('a',$a);
          $this->ci_smarty->display("admin/roleDelete.html");
      }
      public function dropRole() //真正的删除数据库
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
          $role['value']=  $this->input->post('value',TRUE);
          if(in_array("",$role))
          {
              $this->output->set_output(json_encode([
                  "code" => 0,
                  "message" => "请填写完整信息"
              ]));
              return;
          }
  
          else
          {
              $temp=array();
              $ruleid=explode(",",$role['value']); //删除的角色号
             
              for($i=0;$i<sizeof($ruleid)-1;$i++) //循环更新角色对应的权限
             //-1是因为有一个空格 
              {   
                
                  $temp['roleid']=$ruleid[$i];
                  $this->AdminModel->deleteRole($temp['roleid']); //删除三个与role有关的表内容
              }
  
              $this->output->set_output(json_encode([
                  "code" => 1,
                  "message" => "删除角色成功"
              ]));
          }
  
  
        return ;
      }
      public function instituteIndex(
        string $mode="",
        string $value=""
    )
    {
        //获取搜索条件
        if($mode=="id")
        {
            $institute=$this->AdminModel->findinstitute('id',$value);            
        }
        elseif($mode=="name")
        {
            $institute=$this->AdminModel->findinstitute('name',$value);
        }else
        {
            $mode="id";
            $institute=$this->AdminModel->findinstitute('2>','1');
        }

        $parentname=array();
        foreach($institute as $row)
        {
            $parentname[]=$this->AdminModel->findinstitute('id',$row['id']);
        }
        /*$son1=$this->AdminModel->findson(1);
       
        for($i=0;$i<sizeof($son1);$i++)
        {
            if(!empty($son1[$i])){
            for($j=0;j<sizeof($this->AdminModel->findson($son1[$i]['id']));$j++)
            {
                $son1[$i][$j]=$this->AdminModel->findson($son1[$i][$j]['id']);
            }
        }
        }
        print_r($son1);*/
        $this->ci_smarty->assign("mode",$mode);
        $this->ci_smarty->assign("institutes",$institute);
        $this->ci_smarty->assign("parentname",$parentname);
        $this->ci_smarty->display("admin/instituteIndex.html");
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
    public function instituteManager(
        int $id = null
    )
    {
        if(empty($id))
        {
            redirect("admin/instituteIndex");
        }

        $result=$this->AdminModel->findinstitute('id',$id);
        $instituteInfo=$result[0];
        
        $result=$this->AdminModel->findinstitute('id',$instituteInfo['parentid']);
        
        if(empty($result))
        {
            $parentname['name']='无上级公司';
            
        }
        else{
            $parentname=$result[0];
        }
        $result=$this->AdminModel->findson($id);
        if(empty($result))
        {
            $sonname[0]['name']='无下级公司';
            
        }
        else{
            $sonname=$result;
        }
        $this->ci_smarty->assign('sonname',$sonname);
        $this->ci_smarty->assign('parentname',$parentname);
        $this->ci_smarty->assign('instituteInfo',$instituteInfo);
        $this->ci_smarty->display("admin/instituteManager.html");
        

    }
    public function roleManager(
        int $id = null
    )
    {
        if(empty($id))
        {
            redirect("admin/roleIndex");
        }
        
        $result=$this->AdminModel->findRolebycode($id);
        
        $result1=$this->AdminModel->findrolenamebycode($id);
       
        //$result=$this->AdminModel->findRole('roleid',$result[0]['roleid'])
        $roleInfo=$result;

        $c=$this->AdminModel->findAuth(); //用于接受权限名和权限id并显示到前端复选框，下同
        $b=array();
        $a=array();
        $b=$c[1];
        $a=$c[0];    
        
        $d=$this->AdminModel->finduser1();
        $e=array();
        $f=array();
        $e=$d[1];
        $f=$d[0];
        
        $g=$this->AdminModel->finduser2($id);
        $h=array();
        $i=array();
        $h=$g[1];
        $i=$g[0];

       // $c=array('Joe Schmoe','Jack Smith','Jane Johnson','Charlie Brown');
        //print_r($b); 
        $this->ci_smarty->assign('i',$i);
        $this->ci_smarty->assign('h',$h);
        $this->ci_smarty->assign('f',$f);
        $this->ci_smarty->assign('e',$e);
        $this->ci_smarty->assign('b',$b);
        $this->ci_smarty->assign('a',$a);
        $this->ci_smarty->assign('roleInfo',$roleInfo);
        $this->ci_smarty->assign('rolename',$result1[0]);
        $this->ci_smarty->display("admin/roleManager.html");
        

    } 
    public function changerolename()

    {
        $this->output->set_content_type('application/json');

        $id = $this->input->post('id');
        
        $rolename['name'] = $this->input->post('rolename');
        if(empty($id))
        {
            $this->output->set_output(json_encode([
                "code" => 0,
                "message" => "没有检测到角色id"
            ]));
            return;
        }
        if(in_array("",$rolename))
        {
            $this->output->set_output(json_encode([
                "code" => 0,
                "message" => "请填写完整信息"
            ]));
            return;
        }

        $this->AdminModel->updaterole($id,$rolename);
        $this->output->set_output(json_encode([
            "code" => 1,
            "message" => "修改信息成功"
        ]));
        return;

    }
    public function updateauth()
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
        
        $role['roleid']=$this->input->post('id');
        $role['value']=$this->input->post('value');
        
        if(in_array("",$role))
        {
            $this->output->set_output(json_encode([
                "code" => 0,
                "message" => "请填写完整信息"
            ]));
            return;
        }

     
        $roleid=array();
        $temp=array();
      //  $role_add['code']=$number; //角色id
        $ruleid=explode(",",$role['value']);
        $this->AdminModel->deleteRole1($role['roleid']); //先删除原有权限
        for($i=0;$i<sizeof($ruleid)-1;$i++) //循环更新角色对应的权限
       //-1是因为有一个空格 
        {   
            $temp['roleid']=$role['roleid']; //得到角色号
            $temp['ruleid']=$ruleid[$i];
            $this->AdminModel->addRole_rule($temp);
        }
        $this->output->set_output(json_encode([
            "code" => 1,
            "message" => "角色权限修改成功"
        ]));
        return;

    }
    public function updaterole()
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
        
        $role['roleid']=$this->input->post('roleid'); //roleid
        $role['value']=$this->input->post('value');//userid复选框传入
        if(in_array("",$role))
        {
            $this->output->set_output(json_encode([
                "code" => 0,
                "message" => "请填写完整信息"
            ]));
            return;
        }
        $roleid=array();
        $temp=array();
        $userid=explode(",",$role['value']);
        $temp['roleid']=$role['roleid']; //roleid保持不变 
        for($i=0;$i<sizeof($userid)-1;$i++) //循环更新角色对应的权限
        //-1是因为有一个空格 
         {        
             $temp['userid']=$userid[$i];
             $this->AdminModel->delete_user_role($temp['userid']);
             $this->AdminModel->add_user_role($temp);
         }
         $this->output->set_output(json_encode([
             "code" => 1,
             "message" => "角色权限修改成功"
         ]));
         return;

    }
    public function deleteroleuser()
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
        
        $role['value']=$this->input->post('value');//userid复选框传入
        if(in_array("",$role))
        {
            $this->output->set_output(json_encode([
                "code" => 0,
                "message" => "请填写完整信息"
            ]));
            return;
        }
        $roleid=array();
        $temp=array();
        $userid=explode(",",$role['value']);
        for($i=0;$i<sizeof($userid)-1;$i++) //循环更新角色对应的权限
        //-1是因为有一个空格 
         {   
             $temp['userid']=$userid[$i];     
             $this->AdminModel->delete_user_role($temp['userid']);       
         }
         $this->output->set_output(json_encode([
             "code" => 1,
             "message" => "已删除角色对应用户"
         ]));
         return;

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
    public function changeInstituteInfo(
  
    )
    {
        $this->output->set_content_type('application/json');
      //  echo "11111";
        $id = $this->input->post('id');
        $instituteInfo['name'] = $this->input->post('institutename');
        $parentname['parentname'] = $this->input->post('parentname');

       
        if(empty($id))
        {
            $this->output->set_output(json_encode([
                "code" => 0,
                "message" => "没有检测到机构id"
            ]));
            return;
        }

        if(in_array("",$instituteInfo))
        {
            $this->output->set_output(json_encode([
                "code" => 0,
                "message" => "请填写完整信息"
            ]));
            return;
        }
        $temp=$this->AdminModel->findinstitute('name',$parentname['parentname']);
       // print_r($temp);
       if(empty($temp)){
        $this->output->set_output(json_encode([
            "code" => 0,
            "message" => "无此上级公司！"
        ]));
        return;
       }
        $instituteInfo['parentid']=$temp[0]['id'];
       
        $this->AdminModel->updateInstitute($id,$instituteInfo);
        $this->output->set_output(json_encode([
            "code" => 1,
            "message" => "修改成功！"
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
    public function deleteinstitute()
    {
        $this->output->set_content_type('application/json');

        $id = $this->input->post('id');
        $name=$this->input->post('name');
        if(empty($id))
        {
            $this->output->set_output(json_encode([
                "code" => 0,
                "message" => "没有检测到用户id"
            ]));
            return;
        }

        $this->AdminModel->deleteInstitute($id,$name);
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
    public function addInstitute()
    {
        $this->ci_smarty->display("admin/instituteAdd.html");
    }
    public function insertInstitute()
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

        $institute['name']      =  $this->input->post('name',TRUE);
        $parentname['parentname']     = $this->input->post('parent',TRUE);
 
        
        if(in_array("",$institute))
        {
            $this->output->set_output(json_encode([
                "code" => 0,
                "message" => "请填写完整信息"
            ]));
            return;
        }


        //先查重
        $result=$this->AdminModel->findinstitute('name',$institute['name']);
        if(!empty($result))
        {
            $this->output->set_output(json_encode([
                "code" => 0,
                "message" => '机构已存在'
            ]));
        }
        else
        {
            $temp=$this->AdminModel->findInstitute('name',$parentname['parentname']);
            if(empty($temp)){
                $temp[0]['parentid']=0; //若是上级公司不确定
            }
            $institute['parentid']=$temp[0]['parentid'];
            $this->AdminModel->addInstitute($institute);
            $this->output->set_output(json_encode([
                "code" => 1,
                "message" => "机构添加成功"
            ]));
        }
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