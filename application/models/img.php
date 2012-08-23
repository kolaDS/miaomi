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
        $this->db->insert('img', $data);    
        $imgid=$this->db->query("SELECT last_insert_id() as imgid from img limit 1")->row()->imgid;
        return $imgid;
    }

    function getImg($num=10)
    {
        $this->load->database();
        $query=$this->db->query("SELECT * FROM img ORDER BY imgid DESC LIMIT {$num}");
        $data_array=$query->result_array();
        return $data_array;
    }

    function getImgUser($numS=0,$count=1,$lastImgid=0)
    {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("img");
        $this->db->join("user", "img.imguid = user.uid","inner");
        if ($lastImgid > 0) {
            $this->db->where("imgid <", $lastImgid);
        }
        $this->db->order_by("img.imgid", "DESC");
        $this->db->limit($count,$numS);
        $query = $this->db->get();
        $data_array = $query->result_array();
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