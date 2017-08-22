<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Custom extends MY_Controller {

	/**
	 * 用户相关接口
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
	 * 根据商家uid获取商家信息
	 */
	public function get_user_by_uid()
	{
		// 按设置的规则检查参数
		$rules = ['shop_uid' => 'required|trim'];
		$params = $this->check_param($rules);

        $where['uid'] = $params['shop_uid'];
        $user_info = $this->user->get_one($where);
        $this->return_data($user_info);
	}

    /*
     *
     * 根据uid获取个人信息
     *
     *
     */
    public function get_info_by_uid(){
        // 按设置的规则检查参数
        $rules = ['uid' => 'trim'];
        $params = $this->check_param($rules);

        if(!$params['uid']){
            $params['uid'] = '';
        }
        $return_code = $this->is_uid($params['uid']);
        if($return_code == -1){
            $this->returnError('先登录',501);
            exit;
        }

        $where['uid'] = $params['uid'];
        $user_info = $this->user->get_one($where);
        $this->return_data($user_info);
    }

    /*
     *
     * 注册
     *
     *
     */
    public function seller_register(){
        // 按设置的规则检查参数
        $rules = ['uid,company_name' => 'trim|required','company_logo'=>'trim'];
        $params = $this->check_param($rules,[],'post');

        if(!$params['uid']){
            $params['uid'] = '';
        }
        $return_code = $this->is_uid($params['uid']);
        if($return_code == -1){
            $this->returnError('先登录',501);
            exit;
        }

        $where['uid'] = $params['uid'];
        $user_info = $this->user->get_one($where);
        $res = $this->user->update($user_info['id'],['company_name'=>$params['company_name']]);
        if($res){
            $this->return_data(['code'=>$res],'注册成功');
            exit;
        }else{
            $this->returnError('注册失败');
            exit;
        }

//        if($user_info['type'] == 2){
//            $res = $this->user->update($user_info['id'],['company_name'=>$params['company_name']]);
//            $this->return_data(['code'=>$res]);
//        }else{
//            $this->returnError('只允许卖家注册');
//            exit;
//        }
    }

    /*
     *
     * 买家---我的-个人中心
     *
     */
    public function my_center(){
        // 按设置的规则检查参数
        $rules = ['uid' => 'trim'];
        $params = $this->check_param($rules);

        if(!$params['uid']){
            $params['uid'] = '';
        }
        $return_code = $this->is_uid($params['uid']);
        if($return_code == -1){
            $this->returnError('先登录',501);
            exit;
        }

        $where['uid'] = $params['uid'];
        $user_info = $this->user->get_one($where);
        if(!$user_info['mobile']){
            $this->returnError('请先绑定手机号',507);
            exit;
        }

        if(($user_info['type'] == 2) && $user_info['mobile']){
            $this->returnError('您不是买家哦~请返回公众号主页点击“我是卖家家”选项进入卖家主页~');
            exit;
        }
        $this->return_data($user_info);
    }

    /*
     *
     * 卖家---我的-个人中心
     *
     */
    public function seller_my_center(){
        // 按设置的规则检查参数
        $rules = ['uid' => 'trim'];
        $params = $this->check_param($rules);

        if(!$params['uid']){
            $params['uid'] = '';
        }
        $return_code = $this->is_uid($params['uid']);
        if($return_code == -1){
            $this->returnError('先登录',501);
            exit;
        }

        $where['uid'] = $params['uid'];
        $user_info = $this->user->get_one($where);
        if(!$user_info['mobile']){
            $this->returnError('请先绑定手机号',507);
            exit;
        }

        if(($user_info['type'] == 1) && $user_info['mobile']){
            $this->returnError('您不是卖家哦~请返回公众号主页点击“我是买家”选项进入买家主页~');
            exit;
        }
        $this->return_data($user_info);
    }

}
