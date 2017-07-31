<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Good_cart extends MY_Controller {

	/**
	 * 购物车相关接口
	 *
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('cart');
		$this->load->model('goods');
		$this->load->model('user');
	}

	/*
	 * 购物车列表
	 */
	public function cart_list()
	{
		// 按设置的规则检查参数
		$rules = [ 'page,page_size' => 'trim|integer','uid'=>'integer|required'];
		$params = $this->check_param($rules);

		//默认页码
		if(!isset($params['page'])){
			$page = 1;
		}else{
			$page = $params['page'];
		}

		//默认一页多少条
		if(!isset($params['page_size'])){
			$page_size = 15;
		}else{
			$page_size = $params['page_size'];
		}

		$offset = ($page-1)*$page_size;
        $where['uid'] = $params['uid'];
        $where['is_del'] = 0;
		$res = $this->cart->get_list($where,$page_size,$offset,' sort desc');
		$count = $this->cart->get_total();
        $this->return_data(['result'=>$res,'total'=>$count]);
	}

	/*
	 * 添加购物车
	 */
	public function add()
	{
		// 按设置的规则检查参数
		$rules = ['uid,good_id' => 'required','num'=>'trim|integer'];
		$params = $this->check_param($rules,[],'post');

        $res = $this->good_type->add($params);

		if($res){
			$this->return_data('操作成功',200);
		}else{
			$this->returnError('操作失败',500);
		}
	}
}
