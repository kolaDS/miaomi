<?php 

class testdate extends CI_Controller {
    public function index()
    {
     $this->load->helper('url');
     echo site_url()."<br />";
     echo base_url();
    }
}
