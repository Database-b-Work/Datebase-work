<?php


class Captcha extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('CaptchaModel');
	}

	public function get(){
		$img = $this->CaptchaModel->generate();
		return $this->output
			->set_content_type('image/png')
			->set_output($img);
	}

	public function check() {
		$out = $this->output->set_content_type('application/json');
		if(!isset($_GET['code'])){
			return $out->set_output(json_encode([
				"code"	=> 1,
				"msg"		=> "验证码参数错误",
			]));
		}
		$is_success = $this->CaptchaModel->verify($_GET['code']);
		if($is_success){
			return $out->set_output(json_encode([
				"code"	=> 0,
				"msg"		=> "",
			]));
		}else{
			return $out->set_output(json_encode([
				"code"	=> 1,
				"msg"		=> "验证码错误",
			]));
		}
	}
}
