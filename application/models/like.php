<?php

class Like extends CI_Model {
    
    function __construct()
    {
        parent::__construct();
    }

    // 获取赞的计数
    function getCountImg($imgid)
    {
        $this->load->database();
        $this->db->select('likeimgid');
        $this->db->from('imglike');
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
        $this->db->insert('imglike', $data); 
        
        $this->insertImg($imgid);

    }  


    public function getUserLike($imgid,$num=10)
    {
        $this->load->database();    
        $this->db->select('*');
        $this->db->from('imglike');
        $this->db->where('likeimgid',$imgid);   
        $query=$this->db->get();
        $data_array=$query->result_array();
        print_r($data_array);
    }


    

}