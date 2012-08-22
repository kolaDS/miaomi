<?php 

class testweibo extends CI_Controller {
    


    public function index()
    {
        session_start();
        
    	   require_once('config/weibo_config.php');
    	   $auth_params = array('client_id' => WB_AKEY, 'client_secret' => WB_SKEY,'access_token' => "2.001GK8IDiPNxKCdac01b8bebU5SKfE");
           $this->load->library('saetclientv2', $auth_params);
           print_r($this->saetclientv2->home_timeline());      
           
        
    }

    
}
