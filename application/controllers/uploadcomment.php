<?php

class uploadComment extends CI_Controller {

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
                if (  $this->uploadComment())
                    {
                        $this->load->view("comment");
                    }

                else $this->uploadComment();
            }
         else echo("Please login!");       
                 
    }


    public function uploadCommentAPI()
    {
        session_start();
        $this->load->model("comment","userComment");                    
        $imgid=$this->input->post('comment_imgid',true);
        $uid=$_SESSION['user']['uid'];
        // 判断imgid是否为空
        if(!$imgid){echo (2);}
        else if($uid){
            
            $uname=$_SESSION['user']['uname'];
            $text=$this->input->post('comment_text',true);
            if($this->userComment->insertComment($imgid,$uid,$uname,$text)) {echo(1);}       
            else {echo(0);}
        }
        else echo(3);
      
    }

    public function uploadComment()
    {
        session_start();
        $this->load->model("comment","userComment");                    
        $imgid=$this->input->post('comment_imgid',true);
        $uid=$_SESSION['user']['uid'];
        // 判断imgid是否为空
        if(!$imgid){return 2;}

        // 用户登陆了
        else if($uid){
            
            $uname=$_SESSION['user']['uname'];
            $text=$this->input->post('comment_text',true);
            // 上传成功
            if($this->userComment->insertComment($imgid,$uid,$uname,$text)) return 1;
            // 上传失败
            else return 0;
        }   
        // 用户木有登陆
        else return 3;
      
    }

    // 
    public function getCommentList()
    {
        $imgid=$this->input->post('imgid',true);        
        $this->load->model("comment","metersComment");        
        $commentlist_data=$this->metersComment->getCommentList($imgid);        
        echo json_encode($commentlist_data);

    }



    public function getWhoLike($imgid)
    {
        $this->load->model("like","imglike");
        $this->imglike->getUserLike($imgid);
    }

      
}
?>