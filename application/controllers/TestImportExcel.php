<?php
 
	class TestImportExcel extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
            $this->load->model('TestImportExcel_model','testimportexcel_model');
           $this->load->model('FileModel');
           $this->load->model('UserModel');
           $this->load->library('session');
        }
 
		public function importExcel(){
            
            $this->output->set_content_type('application/json');
            $month=$this->input->post('month');


            if(!is_numeric(trim($month))||floor($month)!=$month||$month<0||$month>12){
                $this->output->set_output(json_encode([
                    "code" => 0,
                    "message" => "输入的月份只能是1-12的正整数"
                ]));
                return;
            }



			if ($_FILES['userfile']['name']) {
				$tmp_file = $_FILES['userfile']['tmp_name'];
				$file_types = explode('.', $_FILES['userfile']['name']);
				$file_type = $file_types[count($file_types)-1];
				
				//判断是否为excel文件
				if (strtolower($file_type) != 'xlsx') {
                    $this->output->set_output(json_encode([
                        "code" => 0,
                        "message" => "请上传.xlsx文件"
                    ]));              
                    return;
                }


                if(!$this->FileModel->canUpload($month,$_SESSION['province'])){
                    $this->output->set_output(json_encode([
                        "code" => 0,
                        "message" => "该状态不允许上传"
                    ]));
                    return;
                }

 
				//设置上传路径
				$savePath = FCPATH."uploads".DIRECTORY_SEPARATOR;
				//文件命名
				$str = date('Ymdhis');
                $file_name = $str.".".$file_type;
                // if(file_exists(""))
                $saveName=$savePath.$file_name;
					if (!move_uploaded_file($tmp_file,$saveName)) {
                        $this->output->set_output(json_encode([
                            "code" => 0,
                            "message" => "上传失败"
                        ]));
                        return;
					}
					$this->load->library('PHPExcel');
					$objPHPExcel = new PHPExcel();
                    $objProps = $objPHPExcel->getProperties();
                   // require_once( APPPATH . 'libraries\PHPExcel');
                    $objReader = \PHPExcel_IOFactory::createReader('Excel2007');
					$objPHPExcel = $objReader->load($savePath . $file_name);
					$sheet = $objPHPExcel->getSheet(0);
					$highestRow = $sheet->getHighestRow();
					$highestColumn = $sheet->getHighestColumn();
 
					//excel中的一条数据
                    $excel_data = array();
                    //echo $highestColumn,$highestRow;
                    //echo '\n';
                    $statement_temp;
                    $month_temp;
					for ($currentRow=4; $currentRow <= $highestRow; $currentRow++) { 
                      //  echo $currentRow;
						for ($currentColumn=0; $currentColumn < PHPExcel_Cell::columnIndexFromString($highestColumn) ; $currentColumn++) { 
                           
                            if($currentColumn==3||$currentColumn==4||$currentColumn==9||$currentColumn==18||$currentColumn==24||$currentColumn==26)
                               {
                                    continue; //自动计算的导入不进来
                               }
                            elseif($currentRow!=4 && $currentColumn==0) //合并单元格只有第一行有值
                            {
                                $excel_data[0]=$statement_temp;
                            }
                            elseif($currentRow!=4 && $currentColumn==1)
                            {
                                $excel_data[1]=$month_temp;
                            }
                               else
                            {
                            $excel_data[$currentColumn]=$objPHPExcel->getActiveSheet()->getCell(PHPExcel_Cell::stringFromColumnIndex($currentColumn) . $currentRow)->getValue();
                      //      echo $currentColumn;
                            }          
                            
                        }

                        if($currentRow==4){
                            $statement_temp=$excel_data[0]; //四行A
                            $month_temp=$excel_data[1];//四行B

                            if($month_temp != $month){
                                $this->output->set_output(json_encode([
                                    "code" => 0,
                                    "message" => "月份不匹配"
                                ]));
                                return;
                            }
                        }

                        //下面为自动计算的缺省值
                        $excel_data[3]=$excel_data[5]+$excel_data[14]; 
                        $excel_data[4]=$excel_data[6]+$excel_data[15];
                        $excel_data[9]=$excel_data[7]/$excel_data[8];
                        $excel_data[18]=$excel_data[16]/$excel_data[17];
                        $excel_data[24]=$excel_data[23]/$excel_data[14];
                        $excel_data[26]=$excel_data[25]/$excel_data[14];
                        $this->testimportexcel_model->insert_excel($excel_data[0],$excel_data[1],$excel_data[2],$excel_data[3],$excel_data[4],$excel_data[5],$excel_data[6],$excel_data[7],$excel_data[8],$excel_data[9],
                        $excel_data[10],$excel_data[11],$excel_data[12],$excel_data[13],$excel_data[14],$excel_data[15],$excel_data[16],$excel_data[17],$excel_data[18],
                        $excel_data[19],$excel_data[20],$excel_data[21],$excel_data[22],$excel_data[23],$excel_data[24],$excel_data[25],$excel_data[26],$excel_data[27]);
					}
                    

                    //更新baobiao表的状态,即添加文件名，修改报表状态为草稿状态
                    $condition=[];
                    $condition['province']=$_SESSION['province'];
                    $condition['month']=$month_temp;
                    $dest=[];
                    $dest['filename']=$saveName;
                    $dest['status']=2;
                    $a=$this->FileModel->updateFile($condition,$dest);

                    $this->output->set_output(json_encode([
                        "code" => 1,
                        "message" => "上传成功"
                    ]));
                    return;
                //    $this->ci_smarty->display("staff/index.html");
                    
			}
		}
	}
?>