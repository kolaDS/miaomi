<?php

class imglist extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        
    }

    public function index()
    {   
        $this->load->view("miaoHead",$this->getUserInfo());
        $this->load->view("imgList",$this->getImageListData());
        $this->load->view("miaoFoot");     
       
    }


    public function getUserInfo()
    {
        session_start();        
        if(isset($_SESSION['user']))
            return $_SESSION['user'];
        else return false;
    }

    // 得到图片信息的列表
    public function getImageListData()
    {
        $this->load->model("img","userUploadImg");
        $imgdata['imglist']=$this->userUploadImg->getImgUser(0,50);
        return $imgdata;
    }

    public function getWhoLikeThisImg()
    {
        $imgid=$this->input->post("imgid");
        $this->load->model("like","getWho");
        $userListData=$this->getWho->getUserLike($imgid);
        echo json_encode($userListData);

    }

      
}
?>