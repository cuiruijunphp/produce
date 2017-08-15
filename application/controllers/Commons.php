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
		$this->load->model('user');
		$this->load->model('access_token');
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

	//查看是否有注册用户
	public  function open_id_is_exist(){
		// 按设置的规则检查参数
		$rules = ['open_id,access_token,nick_name,type' => 'trim',[],'post'];
		$params = $this->check_param($rules);

		$access_token = $params['access_token'];
		echo $access_token;
		echo $params['open_id'];
		$where['open_id'] = $params['open_id'];
		return;
		//查看是否已经注册
		$user_res = $this->user->get_one($where);
		if($user_res){
			//查询access_token过期时间
			$access_token_res = $this->access_token->get_one($where,' expire_time desc');
		}else{
			//如果没有的话,就新建一个账户,然后写入表
			$uid = $this->create_guid();
			$type = 1;
			//1-买家，2-商户
			if($type == 1){
				$mobile = '';
			}else{
				$mobile = 1;
			}
			$insert_res = $this->user->add(['open_id'=>$params['open_id'],'uid'=>$uid,'type' => $type,'mobile'=>$mobile,'nick_name'=>base64_decode($params['nick_name'])]);

			//增加access_token
			if($insert_res){
				$access_token_insert_data = [
					'open_id' => $params['open_id'],
					'uid' => $params['open_id'],
					'create_time' => time(),
					'expire_time' => time() + 60*60*24*30,
					'accessToken' => $access_token,
				];
				$access_token_insert_res = $this->access_token->add($access_token_insert_data);
			}
			$access_token_res = $this->access_token->get_one($where,' expire_time desc');
		}
		$this->return_data($access_token_res);
	}

		//生成唯一uid
		private function create_guid()
		{
			$charid = strtoupper(md5(uniqid(mt_rand(), true)));
			$uuid = substr($charid, 0, 8) . '-' . substr($charid, 8, 4) . '-'
					. substr($charid, 12, 4) . '-' . substr($charid, 16, 4) . '-'
					. substr($charid, 20, 12);
			return $uuid;
		}
}
