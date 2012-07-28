<?php

class Like extends CI_Model {
    
    function __construct()
    {
        parent::__construct();
    }
    
    
    

    function getCountImg($imgid)
    {
        $this->load->database();
        $this->db->select('likeimgid');
        $this->db->from('like');
        $this->db->where('likeimgid',$imgid);
        $count=$this->db->count_all();
        return $count;
    }

    // 插入喜欢记录
    function insertLike($imgid,$uid)
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
    

}