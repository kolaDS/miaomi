<?php

class Comment extends CI_Model {
    
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

    function getCommentList($imgid=1)
    {
        $this->load->database();
        $this->db->select('*');
        $this->db->from('comment');
        $this->db->where('comment_imgid',$imgid);
        $query=$this->db->get();
        $data_array=$query->result_array();        
        print_r($data_array);
    }

    // 插入喜欢记录
    function insertComment($imgid,$uid,$uname,$text)
    {
        date_default_timezone_set('UTC');        
        $date=date("Y-m-d H-i-s");
        $this->load->database();
        $data=array(
            'comment_imgid'=>$imgid,
            'comment_uid'=>$uid,
            'comment_uname'=>$uname,
            'comment_text'=>$text,
            'comment_date'=>$date);
        // print_r($data);
        $this->db->insert('comment', $data);                 

    }  


    

}