<?php
class callback extends CI_Controller {   


    public function index()
    {
    	session_start();
    	require_once('config/weibo_config.php');
    	$auth_params = array('client_id' => WB_AKEY, 'client_secret' => WB_SKEY,'access_token' => NULL,'refresh_token'=>NULL);
    	$this->load->library('saetclientv2', $auth_params);
    	$client=$this->saetclientv2;
    	$oauth=$this->saetclientv2->oauth;   
    	$the_access_token;

    	if (isset($_REQUEST['code'])) {
			$keys = array();
			$keys['code'] = $_REQUEST['code'];
			$keys['redirect_uri'] = WB_CALLBACK_URL;
			try {
				$token = $oauth->getAccessToken( 'code', $keys ) ;	
				$the_access_token=$token["access_token"];
			} 
			catch (OAuthException $e) {
			}			
		}

		if ($token) {
			$_SESSION['token'] = $token;
			setcookie( 'weibojs_'.$oauth->client_id, http_build_query($token) );
			$uid_array=$client->get_uid();	
           	$uid=$uid_array['uid'];
           	$userdata=$this->getUserInfo($uid);           
           	if($this->checkIfHasThisUser($uid)) echo("Welcome back ! {$userdata['uname']}");
           	else {
                $this->insertUser($userdata);
                echo("Hello world!{$userdata['uname']}");
            }
            $this->setSession($userdata);
			return true;
			
		}
		else return false;

    }  

// 获取用户信息
    public function getUserInfo($uid)
    {    	   
    		require_once('config/weibo_config.php');
    		$auth_params = array('client_id' => WB_AKEY, 'client_secret' => WB_SKEY,'access_token' => NULL,'refresh_token'=>NULL);
    		$this->load->library('saetclientv2', $auth_params);
    		$client=$this->saetclientv2;   
           $user_array=$client->show_user_by_id($uid);           
           $userinfo = array('uid' =>$user_array['id'] ,'uname'=>$user_array['screen_name'],'udescription' =>$user_array['description'] ,'usex' =>$user_array['gender'] ,'uavatar'=>$user_array['profile_image_url'],'uurl'=>$user_array['profile_url'],'ulocation'=>$user_array['location']);           
           return $userinfo;
           
    }

    public function insertUser($data)

    {
        date_default_timezone_set('UTC');        
        $date=date("Y-m-d H-i-s");
        $this->load->database();              
        $data['udate']=$date;
        if($this->db->insert('user', $data))        return true;

        else return false;
    }

    public function checkIfHasThisUser($uid)
    {
    	$this->load->database();
    	$query=$this->db->query("SELECT uname from user where uid =" . $uid);
    	if($query->num_rows() > 0) return true;
    	else false;
    }

    public function setSession($userArray){
        $_SESSION['user']=$userArray;        
    }

    
}

?>
