<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends MY_Controller {

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
		$count = $this->banner->get_total();
        $this->return_data(['result'=>$res,'total'=>$count]);
	}
}
