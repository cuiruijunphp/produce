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
	 * 买家--我的订单列表
	 */
	public function cart_list()
	{
		// 按设置的规则检查参数
		$rules = [ 'page,page_size' => 'trim|integer','uid'=>'trim'];
		$params = $this->check_param($rules);

		if(!$params['uid']){
			$params['uid'] = '';
		}
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
			$where['a.uid'] = $params['uid'];
		}else{
			//如果是卖家，则提示相应信息
			$this->returnError('只有买家才能操作');
			exit;
		}

		$res = $this->cart->get_cart_list($where,$page_size,$offset);
		if($res){
			foreach($res as $kk=>&$vv){
				if($vv['img']){
					$img_list = explode(',',trim($vv['img'],','));
					$vv['img'] = APP_URL.$img_list[0];
				}
			}
		}
		$count = $this->cart->get_cart_total($where);
        $this->return_data(['result'=>$res,'total'=>$count]);
	}


    /*
	 * 卖家--我的订单列表
	 */
    public function seller_cart_list()
    {
        // 按设置的规则检查参数
        $rules = [ 'page,page_size' => 'trim|integer','uid'=>'trim'];
        $params = $this->check_param($rules);

        if(!$params['uid']){
            $params['uid'] = '';
        }
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
            $this->returnError('只有卖家才能操作');
            exit;
        }else{
            //如果是卖家，取所有shop_id = 卖家id的订单
            $shop_id = $user_info['id'];
            $where['s.shop_id'] = $shop_id;
        }

        $res = $this->cart->get_seller_cart_list($where,$page_size,$offset);
        if($res){
            foreach($res as $kk=>&$vv){
                if($vv['img']){
                    $img_list = explode(',',trim($vv['img'],','));
                    $vv['img'] = APP_URL.$img_list[0];
                }
            }
        }
        $count = $this->cart->get_seller_cart_total($where);
        $this->return_data(['result'=>$res,'total'=>$count]);
    }

	/*
	 * 买家--购买接口
	 */
	public function add()
	{
		// 按设置的规则检查参数
		$rules = ['good_id' => 'required','num'=>'trim|integer','uid'=>'trim'];
		$params = $this->check_param($rules,[],'post');
		if(!$params['uid']){
			$params['uid'] = '';
		}
		$return_code = $this->is_uid($params['uid'],1);
		if($return_code == -1){
			$this->returnError('先登录',501);
			exit;
		}

        if($return_code == -2){
            $this->returnError('请先绑定手机号',509);
            exit;
        }


        if(!isset($params['num'])){
			$num = 1;
		}else{
			$num = $params['num'];
		}

		//先判断是否是买家，是买家才能进行购买
        $user_info = $this->user->get_one(['uid'=>$params['uid']]);
        if($user_info){
            if($user_info['type'] == 2){
                $this->returnError('只有买家才能进行购买~');
                exit;
            }
        }

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

        $res = $this->cart->add($params);

		if($res){
			//减少库存
			$limit_num = $good_info['stock'] - $num;
			$update_res = $this->goods->update($params['good_id'],['stock'=>$limit_num]);
			if($update_res){
				$this->return_data(['code'=>1],'操作成功');
                exit;
			}
		}else{
			$this->returnError('操作失败');
            exit;
		}
	}
}
