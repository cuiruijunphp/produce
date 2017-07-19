<?php

class Sen_info extends MY_Model {

    public $_table;

    public function __construct()
    {
        parent::__construct();
        $this->_table = strtolower(__CLASS__);
    }

    //传感器列表
    public function get_sen_list($where,$offset,$page_size){
        $this->db->select('a.id,a.sen_id,a.status,s.id as cowid,s.cow_id');
        $this->db->from($this->_table.' as a');
        $this->db->join('cow_info as s','a.id = s.sen_id','left');
        if(!empty($where)){
            $this->db->where($where);
        }
        $this->db->where(['a.is_del' => 0]);
        if ($page_size > 0) {
            $this->db->limit($page_size, $offset);
        }
        $result = $this->db->get();
//        echo $this->db->last_query();

        return $result->num_rows() ? $result->result_array() : [];
    }

    //传感器总数
    public function get_sen_count($where=[]){
        $this->db->from($this->_table);
        if(!empty($where)){
            $this->db->where($where);
        }
        $this->db->where(['is_del' => 0]);
        return $this->db->count_all_results();
    }
}
