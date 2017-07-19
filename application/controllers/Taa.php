<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Taa extends MY_Controller {

	/**
	 * 图标相关接口
	 *
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('cow_info');
		$this->load->model('sen_info');
		$this->load->model('cow_taa');
	}

	/*
	 * 图表列表
	 */
	public function get_taa_list()
	{
		// 按设置的规则检查参数
		$rules = [ 'page_size' => 'trim|integer','cow_id'=>'required|integer'];
		$params = $this->check_param($rules);

		//默认一页多少条
		if(!isset($params['page_size'])){
			$page_size = 360;
		}else{
			$page_size = $params['page_size'];
		}

		$where['cow_id'] = $params['cow_id'];
        $cow_res = $this->cow_info->get_cow_info(['a.id'=>$params['cow_id']]);
		$res = $this->cow_taa->get_list($where,$page_size,0,' time desc');
		$res = array_reverse($res);
        $x_list = [];
        $y_list = [];
        $z_list = [];
        foreach($res as $k=>$v){
            $x_list[$k]['time'] = $v['time'];
            $x_list[$k]['x_value'] = $v['xaxis'];
            $y_list[$k]['time'] = $v['time'];
            $y_list[$k]['y_value'] = $v['yaxis'];
            $z_list[$k]['time'] = $v['time'];
            $z_list[$k]['z_value'] = $v['zaxis'];
        }
        $result = [
            'id'=>$cow_res['id'],
            'cow_id'=>$cow_res['cow_id'],
            'sex'=>$cow_res['sex'],
            'age'=>$cow_res['age'],
            'weight'=>$cow_res['weight'],
            'sid'=>$cow_res['sid'],
            'x_list'=>$x_list,
            'y_list'=>$y_list,
            'z_list'=>$z_list
            ];
		$this->return_data($result);
	}

    //数据添加
    public function insert_data() {
        $where = [];
        for($i=0;$i<=1000;$i++){
           $where['xaxis'] = rand(500,50000);
           $where['yaxis'] = rand(100,2000);
           $where['zaxis'] = rand(1,10000);
           $where['time'] = time()-rand(1,100000);
           $where['cow_id'] = rand(1,15);
           $res = $this->cow_taa->add($where);
        }
    }
}
