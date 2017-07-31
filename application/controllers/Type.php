<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type extends MY_Controller {

	/**
	 * 商品分类相关接口
	 *
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('good_type');
	}

	/*
	 * 商品分类列表
	 */
	public function good_type_list()
	{
		// 按设置的规则检查参数
		$rules = [ 'page,page_size' => 'trim|integer'];
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
		$res = $this->good_type->get_list([],$page_size,$offset,' sort desc');
		$count = $this->good_type->get_total();
        $this->return_data(['result'=>$res,'total'=>$count]);
	}

	/*
	 * 添加商品分类
	 */
	public function add()
	{
		// 按设置的规则检查参数
		$rules = ['name,sort' => 'required','id'=>'trim|integer'];
		$params = $this->check_param($rules,[],'post');

		if($params['id']){
			//修改
			$data = $params;
			unset($data['id']);
			$res = $this->good_type->update($params['id'],$data);
		}else{
			//增加
			$res = $this->good_type->add($params);
		}

		if($res){
			$this->return_data('操作成功',200);
		}else{
			$this->returnError('操作失败',500);
		}
	}

    /*
	 * 删除商品类别
	 */
    public function del()
    {
        // 按设置的规则检查参数
        $rules = ['id'=>'trim|integer|required'];
        $params = $this->check_param($rules,[],'post');

        $res = $this->good_type->delete_by_id($params['id']);

        if($res){
            $this->return_data('操作成功',200);
        }else{
            $this->returnError('操作失败',500);
        }
    }
}
