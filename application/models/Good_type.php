<?php

class Good_type extends MY_Model {

    public $_table;

    public function __construct()
    {
        parent::__construct();
        $this->_table = strtolower(__CLASS__);
    }


    public function get_cow_list($where=[],$offset=0,$page_size=10){
        $this->db->select('a.id,a.cow_id,a.sex,a.age,a.weight,s.sen_id,s.id as sid');
        $this->db->from($this->_table.' as a');
        $this->db->join('sen_info as s','a.sen_id = s.id','left');
        if(!empty($where)){
            $this->db->where($where);
        }
        $this->db->where(['a.is_del' => 0]);
        if ($page_size > 0) {
            $this->db->limit($page_size, $offset);
        }
        $result = $this->db->get();

        return $result->num_rows() ? $result->result_array() : [];
    }

    //获取奶牛基本信息
    public function get_cow_info($where) {
        $this->db->select('a.*,s.sen_id as sid');
        $this->db->from($this->_table.' as a');
        $this->db->join('sen_info as s','a.sen_id = s.id','left');
        if(!empty($where)){
            $this->db->where($where);
        }
        $this->db->where(['a.is_del' => 0]);
        $this->db->limit(1);
        $result = $this->db->get();
//        echo $this->db->last_query();

        return $result->num_rows() ? $result->row_array() : NULL;
    }


    //奶牛总数
    public function get_cow_count($where=[]){
        $this->db->from($this->_table);
        if(!empty($where)){
            $this->db->where($where);
        }
        $this->db->where(['is_del' => 0]);
        return $this->db->count_all_results();
    }

}
