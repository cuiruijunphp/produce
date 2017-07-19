<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sen extends MY_Controller {

	/**
	 * 传感器相关接口
	 *
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('cow_info');
		$this->load->model('sen_info');
	}

	/*
	 * 传感器列表
	 */
	public function sen_list()
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
		$res = $this->sen_info->get_sen_list([],$offset,$page_size);
		$count = $this->sen_info->get_sen_count();
        $this->return_data(['result'=>$res,'total'=>$count]);
	}

	/*
	 * 添加修改传感器
	 */
	public function add()
	{
		// 按设置的规则检查参数
		$rules = ['sen_id' => 'required','id'=>'integer|trim','cowid'=>'trim'];
		$params = $this->check_param($rules,[],'post');
		if($params['id']){
			//修改
			$data = $params;
			unset($data['id']);
			unset($data['cowid']);
			//查询cow_info表中是否有记录
			$cow_read_res = $this->cow_info->get_one(['sen_id'=>$params['id']]);
			if(!$params['cowid']){
				//修改的时候，cowid必传，如果为空，则先执行解绑操作，然后状态置为停用
				if($cow_read_res){
					$data['status'] = 2;
					//修改传感器状态
					$res = $this->sen_info->update($params['id'],$data);
					//修改奶牛表中记录,需要把之前记录置空，把这条记录绑定
					$status_condition['sen_id'] = '';
					$res = $this->cow_info->update($cow_read_res['id'],$status_condition);
//					$status_condition1['sen_id'] = $params['cowid'];
//					$res1 = $this->cow_info->update($params['cowid'],$status_condition);
				}else{
					$data['status'] = 0;
					//修改传感器状态
					$res = $this->sen_info->update($params['id'],$data);
					$res = 1;
//					//修改奶牛表中记录
//					$status_condition['sen_id'] = '';
//					$res1 = $this->cow_info->update($params['cowid'],$status_condition);
				}
			}else{
				//如果之前绑定过奶牛，则先解绑，如果没有绑定过，则直接解绑
				//修改的时候，cowid必传，如果为空，则先执行解绑操作，然后状态置为停用
				if($cow_read_res){
					$data['status'] = 1;
					//修改传感器状态
					$res = $this->sen_info->update($params['id'],$data);
					//修改奶牛表中记录,需要把之前记录置空，把这条记录绑定
					$status_condition['sen_id'] = '';
					$res1 = $this->cow_info->update($cow_read_res['id'],$status_condition);
					$status_condition1['sen_id'] = $params['cowid'];
					$res = $this->cow_info->update($params['cowid'],$status_condition);
				}else{
					$data['status'] = 1;
					//修改传感器状态
					$res = $this->sen_info->update($params['id'],$data);
					//修改奶牛表中记录
					$status_condition['sen_id'] = $params['id'];
					$res = $this->cow_info->update($params['cowid'],$status_condition);
				}
			}
		}else{
			//增加
			$data = $params;
			$data['status'] = 0;
			unset($data['cowid']);
			$res = $this->sen_info->add($data);
			if($params['cowid']){
				//如果绑定奶牛，则更新cow_info表中sen_id信息
				$cow_info_res = $this->sen_info->get_one(['sen_id'=>$params['sen_id']]);
				$data_status['status'] = 1;
				$cow_where['sen_id'] = $cow_info_res['id'];
				//更新奶牛表中sen_id
				$co_res = $this->cow_info->update($params['cowid'],$cow_where);
				//更新sen_info表中状态
				$this->sen_info->update($cow_info_res['id'],$data_status);
			}
		}
		//返回
		if($res){
			$this->return_data('操作成功',200);
		}else{
			$this->returnError('操作失败',500);
		}
	}

	/*
	 * 删除该传感器
	 */
	public function del(){
		// 按设置的规则检查参数
		$rules = ['id' => 'required|integer'];
		$params = $this->check_param($rules);
		$res = $this->sen_info->read($params['id']);
		if($res){
			$data['is_del'] = 1;
			$res = $this->sen_info->update($params['id'],$data);
			//删除传感器对应的奶牛
			$sen_read_one = $this->sen_info->read($params['id']);
			if($sen_read_one['status'] == 1){
				$cow_read_one = $this->cow_info->get_one(['sen_id'=>$params['id']]);
				if($cow_read_one){
					//如果存在，则更新绑定sen_id为空
					$this->cow_info->update($cow_read_one['id'],['sen_id' => 0]);
				}
			}
		}else{
			$this->returnError('不存在的传感器id');
			exit;
		}
		$this->return_data('删除成功');
	}

	/*
	 * 通过传感器编号搜索传感器(模糊搜索)
	 */
	public function search(){
		// 按设置的规则检查参数
		$rules = ['sen_id' => 'trim'];
		$params = $this->check_param($rules);
        $where = [];
        if(isset($params['sen_id'])){
            $where['a.sen_id like'] = '%'.$params['sen_id'].'%';
			$total_where['sen_id like'] = '%'.$params['sen_id'].'%';
        }
		$res = $this->sen_info->get_sen_list($where,-1,-1);
		$total_where['is_del'] = 0;
        $count = $this->sen_info->get_total($total_where);
		$this->return_data(['result'=>$res,'total'=>$count]);
	}

	/*
 	 * 下拉提示，根据传感器号
	 */
	public function search_down(){
		// 按设置的规则检查参数
		$rules = ['sen_id' => 'required'];
		$params = $this->check_param($rules);
		$where['sen_id like'] = '%'.$params['sen_id'].'%';
		$where['is_del'] = 0;
		$res = $this->sen_info->get_list($where,-1);
		$this->return_data($res);
	}

	//绑定传感器
	public function bind_sen(){
		// 按设置的规则检查参数
		$rules = ['id,cow_id' => 'required',[],'post'];
		$params = $this->check_param($rules);
		$cow_res = $this->cow_info->read($params['cow_id']);
		if($cow_res){
			$data['sen_id'] = $params['id'];
			$res = $this->cow_info->update($cow_res['id'],$data);
			if($res){
				$this->return_data('绑定成功');
			}else{
				$this->returnError('绑定失败');
			}
		}else{
			$this->returnError('没有找到相应奶牛');
		}
	}

	//解绑传感器
	public function unbind_sen(){
		// 按设置的规则检查参数
		$rules = ['id,cow_id' => 'required',[],'post'];
		$params = $this->check_param($rules);
		$cow_res = $this->sen_info->read($params['cow_id']);
		if($cow_res){
			$data['sen_id'] = '';
			$res = $this->cow_info->update($cow_res['id'],$data);
			if($res){
				$this->return_data('解绑失败');
			}else{
				$this->returnError('解绑失败');
			}
		}else{
			$this->returnError('没有找到相应传感器');
		}
	}

	/*
 	* 全部传感器列表
 	*/
	public function get_all_sen()
	{
        $where['is_del'] = 0;
		$res = $this->sen_info->get_list($where,-1);
		$result = [];
		if($res){
			foreach($res as $k=>$v){
				$result[$k]['value'] = $v['id'];
				$result[$k]['label'] = $v['sen_id'];
			}
		}
		$this->return_data($result);
	}

	/*
 	* 全部传感器列表
 	*/
	public function get_unbind_sen()
	{
		$where['cow_id is NULL'] = NULL;
		$res = $this->sen_info->get_sen_list($where,-1,-1);
		$result = [];
		if($res){
			foreach($res as $k=>$v){
				$result[$k]['value'] = $v['id'];
				$result[$k]['label'] = $v['sen_id'];
			}
		}
		$this->return_data($result);
	}
}
