<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Good extends MY_Controller {

	/**
	 * 商品相关接口
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
	 * 商品列表
	 */
	public function good_list()
	{
		// 按设置的规则检查参数
		$rules = ['page,page_size' => 'trim|integer','type_id,shop_id'=>'integer'];
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

        $where = [];
        if(isset($params['type_id']) && $params['type_id']){
            $where['type_id'] = $params['type_id'];
        }
        if(isset($params['shop_id']) && $params['shop_id']){
            $where['shop_id'] = $params['shop_id'];
        }

		$offset = ($page-1)*$page_size;
        $where['is_show'] = 1;
		$res = $this->goods->get_list($where,$page_size,$offset,' sort desc');
        if($res){
            foreach($res as $k=>&$v){
                if($v['img']){
                    $v['img'] = APP_URL.$v['img'];
                }
            }
        }
		$count = $this->goods->get_total($where);
        $this->return_data(['result'=>$res,'total'=>$count]);
	}

	/*
	 * 添加商品
	 */
	public function add()
	{
		// 按设置的规则检查参数
		$rules = ['uid,good_id' => 'required','num'=>'trim|integer'];
		$params = $this->check_param($rules,[],'post');

        $res = $this->goods->add($params);

		if($res){
			$this->return_data('操作成功',200);
		}else{
			$this->returnError('操作失败',500);
		}
	}

    /*
	 * 删除商品
	 */
    public function del()
    {
        // 按设置的规则检查参数
        $rules = ['id'=>'trim|integer|required'];
        $params = $this->check_param($rules,[],'post');

        $res = $this->goods->delete_by_id($params['id']);

        if($res){
            $this->return_data('操作成功',200);
        }else{
            $this->returnError('操作失败',500);
        }
    }
}
