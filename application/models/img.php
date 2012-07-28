<?php

class Img extends CI_Model {
    
    function __construct()
    {
        parent::__construct();
    }
    
    //插入新用户
    function insertImg($data)
    {
        date_default_timezone_set('UTC');        
        $date=date("Y-m-d H-i-s");
        $data['imgdate']=$date;
        $this->load->database();                      

        if($this->db->insert('img', $data))        return true;
        else return false;
       
    }

    function getImg($num=10)
    {
        $this->load->database();
        $query=$this->db->query("SELECT * FROM img ORDER BY imgid DESC LIMIT {$num}");
        $data_array=$query->result_array();
        return $data_array;
    }

    function getImgUser($numS=0,$numE=10)
    {
        $this->load->database();
        $query=$this->db->query("SELECT user.*,img.* FROM user,img WHERE img.imguid=user.uid ORDER BY img.imgid DESC LIMIT {$numS} , {$numE}");
        $data_array=$query->result_array();
        return $data_array;
    }

    // 插入喜欢记录
    function imgLike($imgid,$uid)
    {
        date_default_timezone_set('UTC');        
        $date=date("Y-m-d H-i-s");
        $this->load->database();
        $data=array(
            'likeimgid'=>$imgid,
            'likeuid'=>$uid,
            'likedate'=>$date);
        $this->db->insert('like', $data); 
    }

    
    // 更新用户
    function updateImg()
    {
       
    }

    //删除用户
    function deleteImg()
    {

    }

}