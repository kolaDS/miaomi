<?php

class share extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        
    }

    public function index()
    {   
        session_start();
        // print_r($_SESSION['token']);
        if(isset($_SESSION['token']['access_token'])) 
        {
            require_once('config/weibo_config.php');
            $auth_params = array('client_id' => WB_AKEY, 'client_secret' => WB_SKEY,'access_token' => $_SESSION['token']['access_token'],'refresh_token'=>NULL);
            $this->load->library('saetclientv2', $auth_params);
            $MIAOMI=$this->saetclientv2;
            $shareText="这是来自喵咪网的问候～ @_HappyPrince";            
            $MIAOMI_POST_RETURN=$MIAOMI->update($shareText);
                // $MIAO_POST_RETURN=$MIAO->update($MIAO_POST);

            if ( isset($MIAOMI_POST_RETURN['error_code']) && $MIAOMI_POST_RETURN['error_code'] > 0 ) {
                    echo "<p>发送失败，错误：{$MIAOMI_POST_RETURN['error_code']}:{$MIAOMI_POST_RETURN['error']}</p>";
                } else {
                    echo "<p>发送成功</p>";
                }                       
        }   

        
    }


    public function shareImg($imagePath)
    {
        session_start();
      
    }

    
}
?>