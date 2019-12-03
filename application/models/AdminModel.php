<?php
class AdminModel extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session');

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
        ->where([
            $condition => $value
        ])
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

    //删除用户
    public function deleteUser(
        int $id
    )
    {
        $this->db
        ->where('id',$id)
        ->delete('user');
    }


    
}
