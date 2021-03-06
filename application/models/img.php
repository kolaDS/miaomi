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

        if($this->db->insert('img', $data)) return true;
        else return false;
       
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
        // $this->db->join("like", "imglike.likeimgid = img.imgid","outer");
        if ($lastImgid > 0) {
            $this->db->where("imgid <", $lastImgid);
        }
        $this->db->order_by("img.imgid", "DESC");
        $this->db->limit($count,$numS);
        $query = $this->db->get();
        $data_array = $query->result_array();
        return $data_array;
    }

    // 获取某用户上传的图片
    function getImgByUID($uid)
    {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("img");
        $this->db->where("imguid",$uid);
        $this->db->order_by("imgid", "DESC");
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