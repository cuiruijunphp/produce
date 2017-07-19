<?php

class Cow_taa extends MY_Model {

    public $_table;

    public function __construct()
    {
        parent::__construct();
        $this->_table = strtolower(__CLASS__);
    }

    //传感器列表
    public function get_sen_list($where,$offset,$page_size){
        $this->db->select('a.id,a.sen_id,a.status,s.sen_id,s.id as cowid,s.cow_id');
        $this->db->from($this->_table.' as a');
        $this->db->join('cow_info as s','a.id = s.sen_id','left');
        if(!empty($where)){
            $this->db->where($where);
        }
        $this->db->where(['s.is_del' => 0]);
        if ($page_size > 0) {
            $this->db->limit($page_size, $offset);
        }
        $result = $this->db->get();

        return $result->num_rows() ? $result->result_array() : [];
    }
}
