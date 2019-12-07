<?php
/**
 * @description:  FileMOdel对应数据库中的baobiao表
 * @param {type} 
 * @return: 
 */
class FileModel extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session');

    }


    //通过province查询baobiao表,得到报表信息,返回结果数组  //可以改进
    public function getFileInfo(
        string $province
    ){
        $query=$this->db
        ->where('province',$province)
        ->order_by('month')
        ->from('baobiao')
        ->get();

        $result=$query->result_array();
        return $result;
    }



    //查询baobiao表,得到报表状态 ,staff.php中的viewFile函数用到
    public function getFileStatus(
        int $month
    ){

        $a=1;
        $result=$this->db
        ->select('status')
        ->where('month',$month)
        ->where('province',$_SESSION['province'])
        ->from('baobiao')
        ->get()
        ->row();

        return $result->status;
    }

    //通过月份得到报表，返回结果数组，viewFile.php中使用
    public function getFileDetail(
        int $month
    ){

        $query=$this->db
        ->where('month',$month)
        ->where('statement',$_SESSION['province'])
        ->from('branch')
        ->get();

        $result=$query->result_array();
        return $result;
    }



    

    //更新file表
    public function updateFile(
        array $condition,
        array $dest
    ){
        return $this->db->update('baobiao',$dest,$condition);
    }

    //检查状态是否允许上报
    public function canUpload(
        string $month,
        string $province
    ){
        $row=$this->db
        ->select('status')
        ->from('baobiao')
        ->where('month' , $month)
        ->where('province',$province)
        ->get()->row();

        if(empty($row)||$row->status == 5 || $row->status == 6){
            return false;
        }
        return true;
    }





}
