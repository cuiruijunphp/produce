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
}
