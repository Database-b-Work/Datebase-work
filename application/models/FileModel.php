<?php
class FileModel extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session');

    }


    //通过province得到报表,返回结果数组
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

        if($row->status == 5 || $row->status == 6){
            return false;
        }
        return true;
    }


}
