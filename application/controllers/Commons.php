<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Commons extends MY_Controller {

	/**
	 * 公共接口
	 *
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('banner');
		$this->load->model('user');
		$this->load->model('access_token');
	}

	/*
	 * 商品列表
	 */
	public function banner_list()
	{
		$res = $this->banner->get_list([],-1,0,' sort desc');
        if($res){
            foreach($res as $k=>&$v){
                if($v['img']){
                    $v['img'] = APP_URL.$v['img'];
                }
            }
        }
		$count = $this->banner->get_total();
        $this->return_data(['result'=>$res,'total'=>$count]);
	}

	public  function open_id_is_exist(){
		// 按设置的规则检查参数
		$rules = ['open_id' => 'trim|required'];
		$params = $this->check_param($rules);


		$where['openid'] = $params['open_id'];
		//查看是否已经注册

		$user_res = $this->user->get_one($where);
		if($user_res){
			//查询access_token过期时间

		}
		$count = $this->goods->get_total($where);
		$this->return_data(['result'=>$res,'total'=>$count]);
	}
}
