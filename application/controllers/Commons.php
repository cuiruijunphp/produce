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
		$rules = ['open_id,access_token,nick_name,type,head_img_url' => 'trim'];
		$params = $this->check_param($rules,[],'post');

		$access_token = $params['access_token'];
		$where['open_id'] = $params['open_id'];
		//查看是否已经注册
		$user_res = $this->user->get_one($where);
		if($user_res){
			//查询access_token过期时间
			$access_token_res = $this->access_token->get_one($where,' expire_time desc');
			//查询个人信息
		}else{
			//如果没有的话,就新建一个账户,然后写入表
			$uid = $this->create_guid();
			$type = $params['type'];
			$insert_res = $this->user->add(['open_id'=>$params['open_id'],'uid'=>$uid,'type' => $type,'nick_name'=>urldecode($params['nick_name']),'head_img_url'=>$params['head_img_url']]);

			//增加access_token
			if($insert_res){
				$access_token_insert_data = [
					'open_id' => $params['open_id'],
					'uid' => $uid,
					'create_time' => time(),
					'expire_time' => time() + 60*60*24*30,
					'accessToken' => $access_token,
				];
				$access_token_insert_res = $this->access_token->add($access_token_insert_data);
			}
			$access_token_res = $this->access_token->get_one($where,' expire_time desc');
		}

		$user_info = $this->user->get_one($where);
		$access_token_res['nick_name'] = $user_info['nick_name'];
		$access_token_res['type'] = $user_info['type'];
		$access_token_res['head_img_url'] = $user_info['head_img_url'];
		$access_token_res['phone'] = $user_info['mobile'];
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


		public function send_msg(){
//        header('Content-Type: text/plain; charset=utf-8');

		$rules = ['phone' => 'trim'];
        $params = $this->check_param($rules,[],'post');

		//判断该手机号是否在允许注册范围内
		$phone_is_exist = 0;
		$this->load->model('phones');
		$phone_list = $this->phones->get_list([],-1);
		foreach($phone_list as $v){
			if($v['phone'] == $params['phone']){
				$phone_is_exist = 1;
				break;
			}
		}
		if($phone_is_exist == 0){
			$this->returnError('手机号不在允许范围内');
			exit;
		}

		//判断手机验证码是否失效
		$this->load->model('sms_msg');
		$phone_is_use = $this->sms_msg->get_one(['phone'=>$params['phone']],' expire_time desc');
		if($phone_is_use){
			if($phone_is_use['expire_time'] > time()){
				$this->returnError('验证码依然有效~');
				exit;
			}
		}

		$this->load->library('AliyunSms');
		$signName = '湘联采';
		$templateCode = 'SMS_85990047';
		$phoneNumbers = $params['phone'];
		$verfiry = rand(1000,9999);

        $tmp = ['number'=>$verfiry];

		//写入数据库,返回结果
		$res = $this->sms_msg->add([
				'phone'=>$params['phone'],
				'create_time'=>time(),
				'expire_time'=>time()+600,
				'text'=>$verfiry,
		]);
		if($res){
			$result = $this->aliyunsms->sendSms($signName, $templateCode, $phoneNumbers, $tmp);
			if($result){
				$this->return_data(['code'=>1]);
			}else{
				$this->return_data(['code'=>-1]);
			}
		}else{
			$this->return_data(['code'=>-2]);
		}
	}

	/*
	 * 验证码验证
	 */
	public function verify_code(){
		$rules = ['phone,code,uid' => 'required|trim'];
		$params = $this->check_param($rules,[],'post');

		if(!$params['uid']){
			$params['uid'] = '';
		}
		$return_code = $this->is_uid($params['uid']);
		if($return_code == -1){
			$this->returnError('先登录',501);
			exit;
		}

		$this->load->model('sms_msg');
		$phone_is_use = $this->sms_msg->get_one(['phone'=>$params['phone']],' expire_time desc');
		if($phone_is_use){
			if($phone_is_use['expire_time'] > time()){
				if($params['code'] == $phone_is_use['text']){
					//更新数据库中mobile字段
					$user_info = $this->user->get_one(['uid' => $params['uid']]);
					$phone_data = ['mobile' => $params['phone']];
					$this->user->update($user_info['id'],$phone_data);
					$this->return_data(['code'=>1]);
				}else{
					$this->returnError('验证码错误');
				}
			}else{
				$this->returnError('验证码已经过期');
			}
		}

	}
}
