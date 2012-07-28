<?php

class testlike extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
    }

    public function index($imgid=2)
    {
        session_start();
        if(isset($_SESSION['user'])){
        $uid=$_SESSION['user']['uid'];
        $this->load->model("like");
        $this->like->insertLike($imgid,$uid);
        }
        else echo("You are not login!");
    }
    
    public function getlike()
    {

       
    }


}