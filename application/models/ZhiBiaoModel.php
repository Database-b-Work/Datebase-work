<?php
class ZhiBiaoModel extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    //插入数据到ZhiBiao 表中
    //pronvice month average proportion cost
    public function insert(
        array $data
    ){
        $this->db->insert('zhibiao',$data);
        return;
    }

	//通过此函数删除zhibiao 里面的数据
	public function deleteZhibiao(
        int $month,
		string $province
    ){
        $this->db
		->where('province',$province)
        ->where('month',$month)
		->delete('zhibiao');

    }

}
