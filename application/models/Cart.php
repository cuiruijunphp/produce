<?php

class Cart extends MY_Model {

    public $_table;

    public function __construct()
    {
        parent::__construct();
        $this->_table = strtolower(__CLASS__);
    }

    //获取买家订单详细列表
    public function get_cart_list($where=[],$offset=0,$page_size=10){
        $this->db->select('a.num,a.create_time,a.uid,s.name,s.img,s.price,s.desc');
        $this->db->from($this->_table.' as a');
        $this->db->join('goods as s','a.good_id = s.id','left');
        $this->db->join('user as u','u.id = s.shop_id','left');
        if(!empty($where)){
            $this->db->where($where);
        }

        if ($page_size > 0) {
            $this->db->limit($page_size, $offset);
        }
        $result = $this->db->get();

        return $result->num_rows() ? $result->result_array() : [];
    }


    //获取订单总数
    public function get_cart_total($where=[]){
        $this->db->select('a.num,a.create_time,a.uid,s.name,s.img,s.price,s.desc,s.unit');
        $this->db->from($this->_table.' as a');
        $this->db->join('goods as s','a.good_id = s.id','left');
        $this->db->join('user as u','u.id = s.shop_id','left');
        if(!empty($where)){
            $this->db->where($where);
        }

        return  $this->db->count_all_results();
    }


    //获取卖家订单详细列表
    public function get_seller_cart_list($where=[],$offset=0,$page_size=10){
        $this->db->select('a.num,a.create_time,a.uid,s.name,s.img,s.price,s.desc,u.company_name,u.mobile');
        $this->db->from($this->_table.' as a');
        $this->db->join('goods as s','a.good_id = s.id','left');
        $this->db->join('user as u','u.uid = s.uid','left');
        if(!empty($where)){
            $this->db->where($where);
        }

        if ($page_size > 0) {
            $this->db->limit($page_size, $offset);
        }
        $result = $this->db->get();

        return $result->num_rows() ? $result->result_array() : [];
    }

    //获取卖家订单总数
    public function get_seller_cart_total($where=[]){
        $this->db->select('a.num,a.create_time,a.uid,s.name,s.img,s.price,s.desc,s.unit,u.company_name,u.mobile');
        $this->db->from($this->_table.' as a');
        $this->db->join('goods as s','a.good_id = s.id','left');
        $this->db->join('user as u','u.uid = s.uid','left');
        if(!empty($where)){
            $this->db->where($where);
        }

        return  $this->db->count_all_results();
    }
}
