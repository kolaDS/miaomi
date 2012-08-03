<?php

class image extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        
    }

    public function index($imgid=0,$imguid=0)
    {   
        $this->load->database();
        $this->db->select('likeimgid');


        // 需要获取的数据
        // 这个图片的详细信息
        // 这个用户上传的其它图片
        // 谁还喜欢过这张图片

       
    }

      
}
?>