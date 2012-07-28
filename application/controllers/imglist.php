<?php

class imglist extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        
    }

    public function index()
    {   
        $this->load->model("img","userUploadImg");
        $imgdata['imglist']=$this->userUploadImg->getImgUser(0,50);
        // print_r($imgdata);
        $this->load->view("miaoHead");
        $this->load->view("imgList",$imgdata);        
        $this->load->view("miaoFoot");     
       
    }

      
}
?>