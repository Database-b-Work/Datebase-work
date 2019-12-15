<?php
class AdminModel extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session');

    }
  
    public function addRole( 
        array $name
   )
   {   
       $this->db->insert('role',$name);  //insert()所以的数据会被自动转义，生成安全的查询语句
   }
   public function addRole_rule(
       array $name
   )
   {
       $this->db->insert('role_rule',$name);
   }
   public function findAuth()
   {
       $result=$this->db
       ->select('id,name')
       ->from('rule')
       ->get()->result_array();
       $a=array();
       $b=array();
       $i=0;
       foreach($result as $row)
       {
         $a[$i]=$row['name'];
         $b[$i]=$row['id'];
         $i=$i+1;
       } 
       $c=array($a,$b);
       return $c;
   }
   public function finduser1() //返回用户名和用户id
   {
       $result=$this->db
       ->select('username,id')
       ->from('user')
       ->get()->result_array();
       $a=array();
       $b=array();
       $i=0;
       foreach($result as $row)
       {
           $a[$i]=$row['username'];
           $b[$i]=$row['id'];
           $i=$i+1;
       }
       $c=array($a,$b);
       return $c;
   }
   public function finduser2(int $id) //查询id角色下的用户名
   {
       $subQuery=$this->db
       ->select('userid')
       ->from('user_role')
       ->where('roleid',$id)
       ->get_compiled_select();


       $result=$this->db
       ->select('username,id')
       ->from('user')
       ->join("(($subQuery) AS TABLEB)",'user.id=TABLEB.userid')
       ->get()->result_array();

       $a=array();
       $b=array();
       $i=0;
       foreach($result as $row)
       {
           $a[$i]=$row['username'];
           $b[$i]=$row['id'];
           $i=$i+1;
       }
       $c=array($a,$b);
       return $c;
   }
   public function findRole1()//查询角色名+角色号并回传二维数组
       {
       $result=$this->db
       ->select('*')
       ->from('role')
       ->get()->result_array();
       $a=array();
       $b=array();
       $i=0;
       foreach($result as $row)
       {
         $a[$i]=$row['name'];
         $b[$i]=$row['code'];
         $i=$i+1;
       } 
       $c=array($a,$b);
       return $c;
   }
   public function findRole(  //返回页面所需值
       string $condition,
       string $value
   )
   {
       $subQuery=$this->db
       ->select('*')
       ->from('user_role')
       ->where($condition,$value )// AND  user_role.userid=user.id AND user_role.roleid=role.code
       //->join('user','user.userid=user_role.userid')
       ->get_compiled_select();
       
       $subQuery=$this->db
       ->select('username,roleid,userid')
       ->from('user')
       ->join("(($subQuery) AS TABLEB)",'user.id=TABLEB.userid')
       ->get_compiled_select();
       
       $result=$this->db
       ->select('username,name,userid')
       ->from('role')
       ->join("($subQuery) AS TABLEB",'role.code=TABLEB.roleid')
       ->get()->result_array();
       return $result;
   }
   public function findRole2(  //返回页面所需值
       string $condition,
       string $value
   )
   {
       $result=$this->db
       ->select('*')
       ->from('role')
       ->where($condition,$value )// AND  user_role.userid=user.id AND user_role.roleid=role.code
       ->get()->result_array();  
       return $result;
   }
   //查询用户
   public function findRolebyname( //检查角色是否存在
       string $name
   )
   {
       $result=$this->db
       ->select('*')
       ->from('role')
       ->where('name',$name)
       ->get()->result_array();
       return $result;
   }
   public function findRolebyuserid(
       int $id
   )
   {
       $result=$this->db
       ->select('*')
       ->from('user_role')
       ->where('userid',$id)
       ->get()->result_array();
       return $result;
   }
   public function findRoleall()//查找角色名+角色号
   {
       $result=$this->db
       ->select('*')
       ->from('role')
       ->get()->result_array();
       return $result;
   }
   public function findRolebycode(
       int $code
   ) //通过角色id查 role表中为code字段 并返回权限
  {
      $subQuery=$this->db
      ->select('*')
      ->from('role')
      ->where('code',$code)
      ->get_compiled_select();

      $subQuery=$this->db
      ->select('*')
      ->from('role_rule')
      ->join("($subQuery) AS TABLEA",'role_rule.roleid=TABLEA.code')
      
      ->get_compiled_select();
      $result=$this->db
      ->select('rule.name as name1')
      ->from('rule')
      ->join("($subQuery) AS TABLEB",'rule.id=TABLEB.ruleid')
      ->get()->result_array();
      return $result;
  }
  public function findrolenamebycode(int $code)
  {
       $result=$this->db
       ->select('*')
       ->from('role')
       ->where('code',$code)
       ->get()->result_array();
       return $result;
  }
    //查询用户
    public function findUser(
        string $condition,
        string $value
    )
    {
        $result=$this->db
        ->select('id,username,province')
        ->from('user')
        ->order_by('id')
        ->where([
            $condition => $value
        ])
        ->get()->result_array(); //返回二维结果数组或者是null

        return $result;
    }
    public function addInstitute(
        array $institute
    )
        {
            $this->db->insert('institute',$institute);
        }
    public function findson(
         int  $value
    )
    {
        $result=$this->db
        ->select('id,name,parentid')
        ->from('institute')
        ->order_by('id')
        ->where('parentid',$value)
        ->get()->result_array(); //返回二维结果数组或者是null

        return $result;
    }
    public function findinstitute(
        string $condition,
        $value
    )
    {
        $result=$this->db
        ->select('id,name,parentid')
        ->from('institute')
        ->order_by('id')
        ->where($condition,$value)
        ->get()->result_array(); //返回二维结果数组或者是null

        return $result;
    }
    //新增用户
    public function addUser(
        array $user
    )
    {   
        $this->db->insert('user',$user);  //insert()所以的数据会被自动转义，生成安全的查询语句
    }

    public function updaterole(
        int $id,
        array $rolename
    )
    {
        $this->db
        ->where('code',$id)
        ->update('role',$rolename);
    }
    public function deleteRole(
        int $id
    )
    {
        $this->db
        ->where('code',$id)
        ->delete('role');

        $this->db
        ->where('roleid',$id)
        ->delete('role_rule');

        $this->db
        ->where('roleid',$id)
        ->delete('user_role');
    }
    public function deleteRole1( //用在更新权限，先删除再添加
        int $id
    )
    {
        $this->db
        ->where('roleid',$id)
        ->delete('role_rule');
    }
    public function delete_user_role(
        int $id
    )
    {
        $this->db
        ->where('userid',$id)
        ->delete('user_role');
    }
    public function add_user_role(
        array $userrole
    )
    {
        $this->db
        ->insert('user_role',$userrole);
    }
    //修改用户
    public function updateUser(
        int $id,
        array $userInfo
    )
    {
        $this->db
        ->where('id',$id)
        ->update('user',$userInfo);
    }
    public function updateInstitute(
        int $id,
        array $instituteInfo
    )
    {
        $this->db
        ->where('id',$id)
        ->update('institute',$instituteInfo);
    }
    //删除用户
    public function deleteUser(
        int $id
    )
    {
        $this->db
        ->where('id',$id)
        ->delete('user');
    }

    public function deleteInstitute(
        int $id
        
    )
    {
        $this->db
        ->where('id',$id)
        ->delete('institute');

        $sql="update institute set parentid='null' where parentid=$id";
        $this->db
        ->query($sql);
        
    }
    
}
