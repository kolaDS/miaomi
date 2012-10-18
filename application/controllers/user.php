<?php

class User extends CI_Controller {

    function __construct()
    {
        parent::__construct();        
    }

    public function index($UID=0)
    {   
        if($UID){
            $data["userinfo"]=$this->getUserInfo($UID);
            $data["uploadimglist"]=$this->getUserUploadImg($UID);
            $this->load->view("miaoHead",$this->getCurrentUserInfo());
            $this->load->view("userView",$data);
            $this->load->view("miaoFoot");            
        }
        else{
            echo "fuck!";
        }
    }

    public function getCurrentUserInfo()
    {
        session_start();        
        if(isset($_SESSION['user']))
            return $_SESSION['user'];
        else return false;
    }


    public function getUserInfo($userid)
    {
        $this->load->model("userdata","userData");
        $userinfo=$this->userData->getUserInfoData($userid);
        return $userinfo;
    }

    public function getUserUploadImg($userid)
    {
        $this->load->model("img","userUploadData");
        $useruploaddata=$this->userUploadData->getImgByUID($userid);
        return $useruploaddata;
    }

    public function getUserLikeImg($UID)
    {

    }


    public function getUserCommentImg($UID)
    {
        
      
    }

    
}
?>