<?php
class login extends CI_Controller {   


    public function index()
    {
    	require_once('../config/weibo_config.php');
        $auth_params = array('client_id' => WB_AKEY, 'client_secret' => WB_SKEY,'access_token' => NULL,'refresh_token'=>NULL);
        $this->load->library('saetoauthv2', $auth_params);
        $o=$this->saetoauthv2;
        $code_url = $o->getAuthorizeURL( WB_CALLBACK_URL );

        echo("<a href='".$code_url."'>使用新浪微博登陆</a>");




    }  


    
    
}

?>
