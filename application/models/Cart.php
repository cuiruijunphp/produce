<?php

class Cart extends MY_Model {

    public $_table;

    public function __construct()
    {
        parent::__construct();
        $this->_table = strtolower(__CLASS__);
    }

    //获取订单详细列表
    public function get_cart($uid){

    }
}
