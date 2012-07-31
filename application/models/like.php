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

    public function insertImg($imgid)
    {
        $this->load->database();
    
        $this->db->select('imglike');
        $this->db->from('img');
        $this->db->where('imgid',$imgid);   
        $query=$this->db->get();
        $data_array=$query->result_array();
        $imglikenum=$data_array[0]['imglike'];
        
        $newdata = array('imglike' => $imglikenum+1);
        $this->db->where('imgid', $imgid);
        $this->db->update('img', $newdata); 
    }


    

}