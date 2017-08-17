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
	 * 商品列表
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
     * 获取商品详情
     *
     *
     */
    public function detail(){
        // 按设置的规则检查参数
        $rules = ['id' => 'required|integer'];
        $params = $this->check_param($rules);

        $res = $this->goods->read($params['id']);
        if($res){
            if($res['img']){
                $img_list = explode(',',trim($res['img'],','));
                foreach($img_list as $kk=>&$vv){
                    $vv = APP_URL.$vv;
                }
                $res['img'] = $img_list;
            }
        }
        $res['img_thumb'] = $res['img'] ? $res['img'][0] : '';

        $this->return_data($res);
    }

	/*
	 * 添加商品
	 */
	public function add()
	{
		// 按设置的规则检查参数
		$rules = ['name,price,type_id,uid,stock' => 'required','desc,img'=>'trim'];
		$params = $this->check_param($rules,[],'post');


        //载入所需文件上传类库
        $this->load->library('upload');

        //配置上传参数
        $upload_config = array(
            'upload_path' => './static/uploads/goods/',
            'allowed_types' => 'jpg|png|gif',
//            'max_size' => '500',
//            'max_width' => '1024',
//            'max_height' => '768',
        );
        $this->upload->initialize($upload_config);
        //循环处理上传文件
//        $data_res = $this->upload->do_upload('img');
        //循环处理上传文件
        $file = $_FILES;
        if($file){
            $count = count($_FILES['img']['name']);
            $img_url = '';
            for($i=0;$i<$count;$i++){
                $type_name = explode('.',$file['img']['name'][$i]);

                $file_name_save = time().$i.'.'.$type_name[count($type_name)-1];
                $_FILES['img']['name'] = $file_name_save;
                $_FILES['img']['type'] = $file['img']['type'][$i];
                $_FILES['img']['tmp_name'] = $file['img']['tmp_name'][$i];
                $_FILES['img']['error'] = $file['img']['error'][$i];
                $_FILES['img']['size'] = $file['img']['size'][$i];
                $res_data = $this->upload->do_upload('img');
                if($res_data){
                    $img_url .= '/static/uploads/goods/'.$file_name_save.',';
                }
            }
            $params['img'] = $img_url;
        }

        $user_info = $this->user->get_one(['uid'=>$params['uid']]);
        if($user_info){
            $params['shop_id'] = $user_info['id'];
        }
        unset($params['uid']);

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
