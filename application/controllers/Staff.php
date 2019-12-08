<?php
class Staff extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
        $this->load->model("FileModel");
        // $this->load->model('TestImportExcel_model','testimportexcel_model');
        $this->load->model('StaffModel');
        $this->load->model('ZhiBiaoModel');


        //权限控制
        if(@!$_SESSION['isLogined']){
            redirect("user/login");
            return;
        }elseif(@$_SESSION['admin']){
            //helper("url")已经在autoload.php中自动加载
            redirect("/admin/index");
        }
    }
  
    public function  index()
    {
        $result=$this->FileModel->getFileInfo($_SESSION['province']);
        //直接返回结果(二维数组)，然后交给前端处理
        $this->ci_smarty->assign("baobiaos",$result);
        $this->ci_smarty->display("staff/index.html");
    }


    /**
     * @description: 报表查看 (也是报表修改,稽核,计算，上报的唯一入口点)
     * @param {type} 
     * @return: 
     */
    public function viewFile(
        int $month
    ){
        $_SESSION['editMonth']=$month;
        $_SESSION['editStatus']=$this->FileModel->getFileStatus($month);
        //通过把要修改的month 放到session里，绑定要操作的month,防止用户恶意篡改其他月份信息，比如修改已经通过审核的月份报表信息
        //同时把status 放到session中，为了方便后面使用
        $result=$this->FileModel->getFileDetail($month);
        if(empty($result)){
            echo "<script>alert('未上传$month 月份报表')</script>";
            header("refresh:0;url=/staff/index");
            return;
        }

        //传二维数组的json 形式到前端 ，前端不需要解析json，直接用
        //如果直接传二维数组会报错
        //前端script标签要加上type="text/Javascript"，否则js中无法使用smarty
        $this->ci_smarty->assign('result',json_encode($result));
        $this->ci_smarty->display('staff/viewFile.html');
    }


    
    /**
     * @description: 报表修改
     * @param {type} 
     * @return: 
     */
    public function editFile()
    {
        if(empty($_SESSION['editMonth'])){
            echo "<script>alert('url来源错误！')</script>";
            //由于$_SESSION['editMonth']里面是空的，所以没有经过viewFile.php直接请求该页面,请求非法
            header("refresh:0;url=/staff/index");
            return;
        }

        $this->output->set_content_type("application/json");

        //已上报的不允许编辑（还有已上报和未上传,防止前端绕过,这里再次进行检查）
        if($_SESSION['editStatus']==5|| $_SESSION['editStatus']==6||$_SESSION['editStatus']==0){
            $this->output->set_output(json_encode([
                "code" => 0,
                "message" => "该状态不允许编辑"
            ]));
            return;
        }


        $data=$this->input->post('value');
        $month=$_SESSION['editMonth'];    
        // $month=$data[0][1]   //还没解决用户修改month 导致删错的问题(已解决)

        //先删除数据
        $this->StaffModel->deleteExcel($month);
        //再重新导入数据，导入之前按公式先计算
        foreach($data as $excel_data){
            $excel_data[3]=$excel_data[5]+$excel_data[14]; 
            $excel_data[4]=$excel_data[6]+$excel_data[15];
            $excel_data[9]=$excel_data[7]/$excel_data[8];
            $excel_data[18]=$excel_data[16]/$excel_data[17];
            $excel_data[24]=$excel_data[23]/$excel_data[14];
            $excel_data[26]=$excel_data[25]/$excel_data[14];
            $this->StaffModel->insertExcel($excel_data);
        }

        $this->output->set_output(json_encode([
            "code" => 1,
            "message" => "更新成功"
        ]));
        
        //更新报表状态为2(草稿状态)
        $condition=[
            "province"=>$_SESSION['province'],
            "month" => $_SESSION['editMonth']
        ];
        $dest=[
            "status" => 2
        ];
        $this->FileModel->updateFile($condition,$dest);
        
        return;
    }

    
    /**
     * @description: 报表稽核
     * @param {type} 
     * @return: 
     */
    public function checkFile()
    {
        if(empty($_SESSION['editMonth'])){
            echo "<script>alert('url来源错误！')</script>";
            //由于$_SESSION['editMonth']里面是空的，所以没有经过viewFile.php直接请求该页面,请求非法
            header("refresh:0;url=/staff/index");
            return;
        }
        
        $this->output->set_content_type("application/json");

        //已上报的不允许编辑（还有已上报和未上传,防止前端绕过,这里再次进行检查）
        if($_SESSION['editStatus']==5|| $_SESSION['editStatus']==6||$_SESSION['editStatus']==0){
            $this->output->set_output(json_encode([
                "code" => 0,
                "message" => "该状态不允许编辑"
            ]));
            return;
        }
        
        $data=$this->input->post('value');
        $msg=[
            "不满足：直供电平均单价应在最高单价和最低单价之间",
            "不满足: 转供电评价单价应在最高单价和最低单价之间",
            "不满足: 直供电最高单价<=最高单价(含税)<=1.17*最高单价(不含税)",
            "不满足: 直供电最低单价<=最低单价(含税)<=1.17*最低单价(不含税)",
            "不满足: 转供电最高单价<=最高单价(含税)<=1.17*最高单价(不含税)",
            "不满足: 转供电最低单价<=最低单价(含税)<=1.17*最低单价(不含税)",
            "不满足: 转供电转供电费自缴比例+转供电转供电费代缴比例=1 或者 转供电自缴的电站数量+转供电费三方公司代缴的站点数量=转供电的电站数量",
        ];
        $i=1;
        foreach($data as $item){
            if(!(($item[11]<$item[9])&&($item[9]<=$item[10]))){
                $errMsg="第$i 行不满足".$msg[0];
                break;
            }elseif(!(($item[20]<=$item[18])&&($item[18]<=$item[19]))){
                $errMsg="第$i 行不满足".$msg[1];
                break;
            }elseif(!(($item[11]<=$item[13])&&($item[13]<=1.17*$item[11]))){
                $errMsg="第$i 行不满足".$msg[2];
                break;
            }elseif(!(($item[19]<=$item[21])&&($item[21]<=1.17*$item[19]))){
                $errMsg="第$i 行不满足".$msg[3];
                break;
            }elseif(!(($item[20]<=$item[22])&&($item[22]<=1.17*$item[20]))){
                $errMsg="第$i 行不满足".$msg[4];
                break;
            }elseif(($item[24]+$item[26]!=1)&&($item[23]+$item[25]!=$item[14])){
                $errMsg="第$i 行不满足".$msg[5];
                break;
            }
            $i=$i+1;
        }

        if(!empty($errMsg)){
            $errMsg="稽核失败: ".$errMsg;
            $this->output->set_output(json_encode([
                "code" => 0,
                "message" => $errMsg
            ]));
            return;
        }

        $this->output->set_output(json_encode([
            "code" => 1,
            "message" => "稽核成功"
        ]));
        
       //更新报表状态3(已稽核状态)
        $condition=[
            "province"=>$_SESSION['province'],
            "month" => $_SESSION['editMonth']
        ];
        $dest=[
            "status" => 3
        ];
        $this->FileModel->updateFile($condition,$dest);

        return;
    }


    /**
     * @description: 报表计算
     * @param {type} 
     * @return: 
     */
    public function calculateFile()
    {
        if(empty($_SESSION['editMonth'])){
            echo "<script>alert('url来源错误！')</script>";
            //由于$_SESSION['editMonth']里面是空的，所以没有经过viewFile.php直接请求该页面,请求非法
            header("refresh:0;url=/staff/index");
            return;
        }

        $this->output->set_content_type("application/json");

        //已上报的不允许编辑（还有已上报和未上传,防止前端绕过,这里再次进行检查）
        if($_SESSION['editStatus']!=3){
            $this->output->set_output(json_encode([
                "code" => 0,
                "message" => "只有先稽核才能进行计算"
            ]));
            return;
        }


        $data=$this->input->post('value');
        foreach($data as $item){
            $arr=array();
            $arr['average']=($item[8]+$item[17])/($item[6]+$item[14]);
            $arr['proportion']=($item[14]/($item[6]+$item[14]));
            $arr['cost']=($item[7]+$item[16])/($item[8]+$item[17]);
            $this->ZhiBiaoModel->insert($item);
        }

        //更新报表状态为4(已计算状态)
        $condition=[
            "province"=>$_SESSION['province'],
            "month" => $_SESSION['editMonth']
        ];
        $dest=[
            "status" => 4
        ];
        $this->FileModel->updateFile($condition,$dest);

        $this->output->set_output(json_encode([
            "code" => 0,
            "message" => "计算成功"
        ]));
        return;



    }


    /**
     * @description: 报表上报
     * @param {type} 
     * @return: 
     */
    public function submitFile()
    {
        if(empty($_SESSION['editMonth'])){
            echo "<script>alert('url来源错误！')</script>";
            //由于$_SESSION['editMonth']里面是空的，所以没有经过viewFile.php直接请求该页面,请求非法
            header("refresh:0;url=/staff/index");
            return;
        }

        $this->output->set_content_type("application/json");

        //已上报的不允许编辑（还有已上报和未上传,防止前端绕过,这里再次进行检查）
        if($_SESSION['editStatus']!=4){
            $this->output->set_output(json_encode([
                "code" => 0,
                "message" => "只有先计算才能进行上报"
            ]));
            return;
        }


        //更新报表状态为5(已上报状态)
        $condition=[
            "province"=>$_SESSION['province'],
            "month" => $_SESSION['editMonth']
        ];
        $dest=[
            "status" => 5
        ];
        $this->FileModel->updateFile($condition,$dest);

        $this->output->set_output(json_encode([
            "code" => 1,
            "message" => "上报成功"
        ]));


        return;

    }
}