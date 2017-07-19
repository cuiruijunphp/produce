<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		//$this->load->view('welcome_message');
		$this->load->model('h_member_room');
		$this->h_member_room->getData(1,2);
	}

	public function down(){
		$this->load->model('h_member_room');
		$export_data = $this->h_member_room->getData(0,1);

		var_dump($export_data);
		return;
		/*header ( "Content-type:application/vnd.ms-excel" );
		header ( "Content-Disposition:filename=data.csv" );
        //设置超时时间
		set_time_limit(0);

        // 打开PHP文件句柄，php://output 表示直接输出到浏览器
		$fp = fopen('php://output', 'a');
        // 将中文标题转换编码，否则乱码
		$column_name = ['会员id', '会员姓名', '手机号', '证件类型', '证件号码', '房子id', '房子名称', '租户类型'];
		foreach ($column_name as $i => $v) {
			$column_name[$i] = iconv('utf-8', 'gbk', $v);
		}
        // 将标题名称通过fputcsv写到文件句柄
		fputcsv($fp, $column_name);


		$pre_count = 100;//每页多少条
     	$this->load->model('h_member_room');
		//$total_export_count = $this->h_member_room->getDataCount(); //获取总条数
		$total_export_count = 515231; //获取总条数
		$page_totol = ceil($total_export_count/$pre_count);

		for ($i=1;$i<=$page_totol;$i++){
			$export_data = $this->h_member_room->getData($i,$pre_count);
			foreach ($export_data as $item ) {
				$rows = array();
				foreach ( $item as $k=>$export_obj){
					$rows[$k] = @iconv('utf-8', 'gbk', $export_obj);
				}
				fputcsv($fp, $rows);
			}
			// 将已经写到csv中的数据存储变量销毁，释放内存占用
			unset($export_data);
			ob_flush();
			flush();
		}
		exit ();*/
	}

	public function test(){
		//大小写敏感验证
		$a = 'A';
		$b = 'a';
		if($a == $b){
			echo '111111';
		}else{
			echo '222222222';
		}

		//解析url
		var_dump(parse_url('111111111111'));

		//解码
		echo rawurldecode('%woshinibi');

		var_dump(array_merge([],[1,3]));

		//快速排序
		$arr = [1,29,3,5,16,30,10,6];
		$return_arr = $this->quick_sort($arr);
		var_dump($return_arr);
	}

	public function quick_sort($arr){
		$len = count($arr);
		if($len <= 1){
			return $arr;
		}
		$quick_element = $arr[0];
		$arr_left = [];
		$arr_right = [];
		for($i=0;$i<$len;$i++){
            if($arr[$i]<$quick_element){
				$arr_left[] = $arr[$i];
			}else{
				$arr_right[] = $arr[$i];
			}
		}
		if(count($arr_left) > 0){
			$left_return = $this->quick_sort($arr_left);
		}
		if(count($arr_right) > 0){
			$right_return = $this->quick_sort($arr_right);
		}
		//var_dump(array_merge($left_return,$right_return));
		return array_merge($left_return,[$arr[0]],$right_return);
	}
}
