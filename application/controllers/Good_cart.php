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
	 * 买家/卖家--我的订单列表
	 */
	public function cart_list()
	{
		// 按设置的规则检查参数
		$rules = [ 'page,page_size' => 'trim|integer','uid'=>'integer|required'];
		$params = $this->check_param($rules);
		$return_code = $this->is_uid($params['uid']);
		if($return_code == -1){
			$this->returnError('先登录',501);
			exit;
		}

		$user_info = $this->user->get_one(['uid' => $params['uid']]);

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
		if($user_info['type'] == 1){
			$where['uid'] = $params['uid'];
		}else{
			$where['shop_id'] = $params['id'];
		}

		$res = $this->cart->get_list($where,$page_size,$offset,' sort desc');
		$count = $this->cart->get_total();
        $this->return_data(['result'=>$res,'total'=>$count]);
	}

	/*
	 * 买家--购买接口
	 */
	public function add()
	{
		// 按设置的规则检查参数
		$rules = ['uid,good_id' => 'required','num'=>'trim|integer'];
		$params = $this->check_param($rules,[],'post');
		$return_code = $this->is_uid($params['uid']);
		if($return_code == -1){
			$this->returnError('先登录',501);
			exit;
		}

		if(!isset($params['num'])){
			$num = 1;
		}else{
			$num = $params['num'];
		}

		//先判断是否是买家，是买家才能进行购买


		//插入商家id
		$good_info = $this->goods->read($params['good_id']);
		if($good_info){
			$shop_id = $good_info['shop_id'];
		}else{
			$this->returnError('没有该商品');
			exit;
		}

		$insert_data = [
			'uid' => $params['uid'],
			'good_id' => $params['good_id'],
			'num' => $num,
			'shop_id' => $shop_id
		];

        $res = $this->goods->add($params);

		if($res){
			//减少库存
			$limit_num = $good_info['stock'] - $num;
			$update_res = $this->goods->update($params['good_id'],['stock'=>$limit_num]);
			if($update_res){
				$this->return_data('操作成功',200);
			}
		}else{
			$this->returnError('操作失败',500);
		}
	}
}
