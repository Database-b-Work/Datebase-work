<?php
class StaffModel extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session');

    }

    public function deleteExcel(
        int $month
    ){
        $this->db
        ->where('statement',$_SESSION['province'])
        ->where('month',$month)
        ->delete('branch');
    }
  
    //通过数组直接插入,用于用户修改报表 editFile.php ,TestImportExcel_model中则是传入字符串，两种不同的方式
    public function insertExcel(
        array $item
    ){
        $data=array(
            'statement'=>$item[0],
            'month'=>$item[1],
            'type'=>$item[2],   
            'station_num'=>$item[3],
            'meter_num'=>$item[4],
            'straight_station_num'=>$item[5],
            'straight_meter_num'=>$item[6],
            'straight_fee'=>$item[7],
            'straight_count'=>$item[8],
            'straight_average_fee_non'=>$item[9],
            'straight_top_fee_non'=>$item[10],
            'straight_low_fee_non'=>$item[11],
            'straight_top_fee'=>$item[12],
           'straight_low_fee'=>$item[13],
           'trans_station_num'=>$item[14],
           'trans_meter_num'=>$item[15],
           'trans_fee'=>$item[16],
           'trans_count'=>$item[17],
           'trans_average_fee_non'=>$item[18],
           'trans_top_fee_non'=>$item[19],
           'trans_low_fee_non'=>$item[20],
           'trans_top_fee'=>$item[21],
           'trans_low_fee'=>$item[22],
           'trans_self_station_num'=>$item[23],
           'trans_fee_self_proportion'=>$item[24],
           'trans_replace_station_num'=>$item[25],
          'trans_replace_proportion'=>$item[26],
          'index_explain'=>$item[27]
           );
        $this->db->insert('branch',$data);
    }

}
