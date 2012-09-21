<?php

class Userdata extends CI_Model {
    
    function __construct()
    {
        parent::__construct();
    }
    
    //插入新用户
    public function insertUser($data)
    {
        date_default_timezone_set('UTC');        
        $date=date("Y-m-d H-i-s");
        $this->load->database();                      
        if($this->db->insert('user', $data))        return true;
        else return false;       
    }

    public function getUserInfoData($uid)
    {    
        $this->load->database();
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('uid',$uid);   
        $query=$this->db->get();
        $data_array=$query->result_array();
        return ($data_array[0]);
    }

    // 更新用户
    public function updateUser()
    {
       
    }

    //删除用户
    public function deleteUser()
    {

    }

}