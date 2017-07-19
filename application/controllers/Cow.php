<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cow extends MY_Controller {

	/**
	 * 奶牛信息相关接口
	 *
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('cow_info');
		$this->load->model('sen_info');
	}

	/*
	 * 奶牛列表
	 */
	public function cow_list()
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
		$res = $this->cow_info->get_cow_list([],$offset,$page_size);
		$count = $this->cow_info->get_cow_count();
        $this->return_data(['result'=>$res,'total'=>$count]);
	}

	/*
	 * 添加修改奶牛
	 */
	public function add()
	{
		// 按设置的规则检查参数
		$rules = ['cow_id' => 'required', 'sex,age,weight,sen_id' => 'trim','id'=>'trim|integer'];
		$params = $this->check_param($rules,[],'post');
		if(!$params['sen_id']){
			$params['sen_id'] = 0;
		}
		if($params['id']){
			//修改
			$data = $params;
			unset($data['id']);
			$res = $this->cow_info->update($params['id'],$data);
		}else{
			//增加
			$res = $this->cow_info->add($params);
		}

		if($res){
			$this->return_data('操作成功',200);
		}else{
			$this->returnError('操作失败',500);
		}
	}

	/*
	 * 删除该奶牛
	 */
	public function del(){
		// 按设置的规则检查参数
		$rules = ['id' => 'required|integer'];
		$params = $this->check_param($rules);
		$res = $this->cow_info->read($params['id']);
		if($res){
			$data['is_del'] = 1;
			$res = $this->cow_info->update($params['id'],$data);
			//更改绑定的传感器状态
			$cow_info_read = $this->cow_info->read($params['id']);
			if($cow_info_read['sen_id']){
				//如果有绑定传感器，更改传感器状态
				$this->sen_info->update($cow_info_read['sen_id'],['status'=>2]);
			}
		}else{
			$this->returnError('不存在的奶牛id');
			exit;
		}
		$this->return_data('成功删除该奶牛');
	}

	/*
	 * 通过奶牛编号搜索奶牛(模糊搜索)
	 */
	/**
	 *
     */
	public function search(){
		// 按设置的规则检查参数
		$rules = ['cow_id' => 'trim'];
		$params = $this->check_param($rules);
		$where = [];
        if($params['cow_id']){
            $where['cow_id like'] = '%'.$params['cow_id'].'%';
        }
		$res = $this->cow_info->get_cow_list($where,-1,-1);
		$where['is_del'] = 0;
		$count = $this->cow_info->get_total($where);
		$this->return_data(['result'=>$res,'total'=>$count]);
	}

	/*
 	 * 下拉提示，根据奶牛号
	 */
	public function search_down(){
		// 按设置的规则检查参数
		$rules = ['cow_id' => 'required'];
		$params = $this->check_param($rules);
		$where['cow_id like'] = '%'.$params['cow_id'].'%';
		$where['is_del'] = 0;
		$res = $this->cow_info->get_list($where,-1);
		$result = [];
		if($res){
			foreach($res as $v){
				$result[] = $v['cow_id'];
			}
		}
		$this->return_data($res);
	}

	//绑定传感器
	public function bind_sen(){
		// 按设置的规则检查参数
		$rules = ['id,sen_id' => 'required',[],'post'];
		$params = $this->check_param($rules);
		$sen_res = $this->sen_info->read($params['sen_id']);
		if($sen_res){
			$data['sen_id'] = $params['sen_id'];
			$res = $this->cow_info->update($params['id'],$data);
			if($res){
				$this->return_data('绑定成功');
			}else{
				$this->returnError('绑定失败');
			}
		}else{
			$this->returnError('没有相应传感器');
		}
	}

	//解绑传感器
	public function unbind_sen(){
		// 按设置的规则检查参数
		$rules = ['id,sen_id' => 'required',[],'post'];
		$params = $this->check_param($rules);
		$sen_res = $this->sen_info->read($params['sen_id']);
		if($sen_res){
			$data['sen_id'] = '';
			$res = $this->cow_info->update($params['id'],$data);
			$res1 = $this->sen_info->update($params['sen_id'],['status'=>2]);
			if($res){
				$this->return_data('解绑成功');
			}else{
				$this->returnError('解绑失败');
			}
		}else{
			$this->returnError('没有相应传感器');
		}
	}

	/*
	 * 全部奶牛列表
	 */
	public function get_all_cow()
	{
		$res = $this->cow_info->get_list([],-1);
		$result = [];
		if($res){
			foreach($res as $k=>$v){
				$result[$k]['value'] = $v['id'];
				$result[$k]['label'] = $v['cow_id'];
			}
		}
		$this->return_data($result);
	}

	/*
 	* 未绑定奶牛列表
 	*/
	public function get_unbind_cow()
	{
		$res = $this->cow_info->get_list(['sen_id <'=> 1,'is_del'=> 0],-1);
		$result = [];
		if($res){
			foreach($res as $k=>$v){
				$result[$k]['value'] = $v['id'];
				$result[$k]['label'] = $v['cow_id'];
			}
		}
		$this->return_data($result);
	}
}
