<?php
class UserModel extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session');

    }


    //登录
    public function login(
        string $username,
        string $passwd
    ){
        $sql="select * from user where username=? and passwd=?";
        $query=$this->db->query($sql,array($username,$passwd));
        $row=$query->row();
        if(isset($row)){
            $_SESSION['isLogined']=1;
            $_SESSION['name']=$username;

            if($row->isAdmin){
                $_SESSION['admin']=1;
            }else{
                $_SESSION['admin']=0;
            }
            return true;
        }
        
        return false;
    }


}
