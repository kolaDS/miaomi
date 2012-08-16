<?php

class commentlist extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        
    }

    public function index()
    {   
        session_start();
        if(isset($_SESSION['user']))
            {   
                echo ("你好 {$_SESSION['user']['uname']} ！");
                if ( ! $this->uploadComment())
                    {
                        $this->load->view("comment");
                    }

                else $this->uploadComment();
            }
         else echo("Please login!");       
                 
    }


    public function uploadComment()
    {
        
        $this->load->model("comment","userComment");                    
        $imgid=$this->input->post('comment_imgid',true);
        $uid=$_SESSION['user']['uid'];
        $uname=$_SESSION['user']['uname'];
        $text=$this->input->post('comment_text',true);
        $this->userComment->insertComment($imgid,$uid,$uname,$text);       
      
    }

    public function getCommentList($imgid)
    {
        $this->load->model("comment","metersComment");        
        $this->metersComment->getCommentList($imgid);
    }

    public function getWhoLike($imgid)
    {
        $this->load->model("like","imglike");
        $this->imglike->getUserLike($imgid);
    }

      
}
?>