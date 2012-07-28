<?php

class User extends CI_Model {
    
    function __construct()
    {
        parent::__construct();
    }
    
    //插入新用户
    function insertUser($data)
    {
        date_default_timezone_set('UTC');        
        $date=date("Y-m-d H-i-s");
        $this->load->database();                      
        if($this->db->insert('user', $data))        return true;
        else return false;
       
    }


 function getUser($num=10)
    {
        $this->load->database();
        $query=$this->db->query("SELECT * FROM user ORDER BY id DESC LIMIT {$num}");
        $data_array=$query->result_array();
        return $data_array;
    }

    // 更新用户
    function updateUser()
    {
       
    }

    //删除用户
    function deleteUser()
    {

    }

}