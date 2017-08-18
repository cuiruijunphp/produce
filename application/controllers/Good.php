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
            $img_array = [];
            foreach($res as $k=>&$v){
                if($v['img']){
                    $img_list = explode(',',trim($v['img'],','));
                    $v['img'] = APP_URL.$img_list[0];
//                    foreach($img_list as $kk=>&$vv){
//                        $vv = APP_URL.$vv;
//                    }
//                    $v['img'] = $img_list;
                }
            }
        }
		$count = $this->goods->get_total($where);
        $this->return_data(['result'=>$res,'total'=>$count]);
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

        $res = $this->goods->get_good_detail($params['id']);
        $res = $res[0];

//        $res = $this->goods->read($params['id']);
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
	public function add(){
		// 按设置的规则检查参数
		$rules = ['name,price,type_id,uid,stock' => 'trim','desc,img,id'=>'trim'];
		$params = $this->check_param($rules,[],'post');

        var_dump($_POST['img']);
        echo PHP_EOL;

        $img = $_POST['img'];
        $img_tmp = ltrim($img,'"[');
        $img_tmp_1 = rtrim($img_tmp,']"');

        $img_str = explode(',',$img_tmp_1);
        $count = count($img_str);
        for($i=0;$i<$count/2;$i++){
            $type = 'txt';
            if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $img_str[2*$i], $result)){
                $type = $result[2];
            }
            var_dump($img_str[2*$i+1]);
            $name = time().$i.'.'.$type;
            $content = rtrim($img_str[2*$i+1],'"');
            $content = rtrim($content,'\\');
            file_put_contents('./static/uploads/goods/'.$name,$content);
        }


        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $_POST['img'], $result)){
            $type = $result[2];
            $new_file = "./static/uploads/goods/test.{$type}";
            if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $_POST['img'])))){
                echo '新文件保存成功：', $new_file;
            }
        }else{
            echo '11111111111';
        }

        exit;


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
            if($user_info['type'] == 1){
                $this->returnError('只有卖家才能进行商品上传~');
            }
            $params['shop_id'] = $user_info['id'];
        }
        unset($params['uid']);

        if($params['id']){
            //更新
            $id = $params['id'];
            unset($params['id']);
            $res = $this->goods->update($id,$params);
        }else{
            $res = $this->goods->add($params);
        }


		if($res){
			$this->return_data('操作成功',200);
		}else{
			$this->returnError('操作失败');
		}
	}

    /*
	 * 删除商品
	 */
    public function del()
    {
        // 按设置的规则检查参数
        $rules = ['id'=>'trim|integer|required','uid'=>'trim|required'];
        $params = $this->check_param($rules,[],'post');

        if(!$params['uid']){
            $params['uid'] = '';
        }
        $return_code = $this->is_uid($params['uid']);
        if($return_code == -1){
            $this->returnError('先登录',501);
            exit;
        }
        $good_info = $this->goods->read($params['id']);
        $user_info = $this->user->get_one(['uid'=>$params['uid']]);

        if($good_info['good_id'] != $user_info['id']){
            $this->returnError('只有商家才能进行操作');
        }

        $res = $this->goods->delete_by_id($params['id']);

        if($res){
            $this->return_data('操作成功',200);
        }else{
            $this->returnError('操作失败');
        }
    }
}
