<?php

class Goods extends MY_Model {

    public $_table;

    public function __construct()
    {
        parent::__construct();
        $this->_table = strtolower(__CLASS__);
    }

    //根据id获取商品详情(包括商家信息)--买家
    public function get_good_detail($id,$where = []){
        $this->db->select('a.*,u.nick_name,u.head_img_url,u.company_name,u.mobile');
        $this->db->from($this->_table.' as a');
        $this->db->join('user as u','u.id = a.shop_id','left');
        $this->db->where(['a.id'=>$id]);
        if(!empty($where)){
            $this->db->where($where);
        }

        $result = $this->db->get();

        return $result->num_rows() ? $result->result_array() : [];
    }

    //根据id获取商品详情--卖家
    public function get_sell_good_detail($id,$where = []){
        $this->db->select('a.*,u.name as type_name');
        $this->db->from($this->_table.' as a');
        $this->db->join('good_type as u','u.id = a.type_id','left');
        $this->db->where(['a.id'=>$id]);
        if(!empty($where)){
            $this->db->where($where);
        }

        $result = $this->db->get();

        return $result->num_rows() ? $result->result_array() : [];
    }
}
