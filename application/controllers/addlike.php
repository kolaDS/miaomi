<?php

class addlike extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
    }

    public function index($imgid)
    {
        if(isset($_POST['imgid'])) $imgid=$_POST['imgid'];
        session_start();
        if(isset($_SESSION['user'])){
        $uid=$_SESSION['user']['uid'];
        $this->load->model("like");
        $this->like->insertLike($imgid,$uid);
        }
        else echo("You are not login!");
    }
    



}