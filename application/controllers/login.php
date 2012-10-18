<?php
class login extends CI_Controller {   


    public function index()
    {
    	
    }   

    // qq callback
    public function qqCallback()
    {
        session_start();
        require_once('oauth/qq/comm/config.php');
        $this->qqCallbackInit();
        $qqopenid=$this->qqGetOpenID();
        $userinfo=$this->qqGetUserInfo();
        $userdata['uqqid']=$qqopenid;     
        $userdata['uname']=$userinfo['nickname'];
        $userdata['uavatar']=$userinfo['figureurl_2'];
        $userdata['udescription']='';
        $userdata['ulocation']='';
        $userdata['ufrom']='qq';
        switch ($userinfo['gender']) {
            case '男':
                # code...
            $userdata['usex']='m';
                break;
            case '女':
            $userdata['usex']='f';
            
            default:
                # code...
            $userdata['usex']='f';  
            break;
        } 

        if($this->checkIfHasThisUser($qqopenid,'qq')) $userdata=$this->checkIfHasThisUser($qqopenid,'qq');
        else 
        {
            $userdata['uid']=$this->insertUser($userdata);
            // echo("Hello world!{$userdata['uname']}");
        }
        $this->setSession($userdata);
        // print_r($_SESSION);
        header("Location:".base_url());

    }  

    //qq论证登陆 
    public function qqCallbackInit()
    {
        if($_REQUEST['state'] == $_SESSION['state']) //csrf
        {
            $token_url = "https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&"
                . "client_id=" . $_SESSION["appid"]. "&redirect_uri=" . urlencode($_SESSION["callback"])
                . "&client_secret=" . $_SESSION["appkey"]. "&code=" . $_REQUEST["code"];

            $response = file_get_contents($token_url);
            if (strpos($response, "callback") !== false)
            {
                $lpos = strpos($response, "(");
                $rpos = strrpos($response, ")");
                $response  = substr($response, $lpos + 1, $rpos - $lpos -1);
                $msg = json_decode($response);
                if (isset($msg->error))
                {
                    echo "<h3>error:</h3>" . $msg->error;
                    echo "<h3>msg  :</h3>" . $msg->error_description;
                    exit;
                }
            }
            $params = array();
            parse_str($response, $params);
            //set access token to session
            $_SESSION["access_token"] = $params["access_token"];
        }
        else 
        {
            echo("The state does not match. You may be a victim of CSRF.");
        }
    }

    // 获取openid 用来标识唯一的qq用户
    public function qqGetOpenID()
    {     
        $graph_url = "https://graph.qq.com/oauth2.0/me?access_token=" 
            . $_SESSION['access_token'];

        $str  = file_get_contents($graph_url);
        if (strpos($str, "callback") !== false)
        {
            $lpos = strpos($str, "(");
            $rpos = strrpos($str, ")");
            $str  = substr($str, $lpos + 1, $rpos - $lpos -1);
        }

        $user = json_decode($str);
        if (isset($user->error))
        {
            echo "<h3>error:</h3>" . $user->error;
            echo "<h3>msg  :</h3>" . $user->error_description;
            exit;
        }
        $_SESSION["openid"] = $user->openid;
        return $user->openid;
    }

    // 获取QQ用户信息
    public function qqGetUserInfo()
    {   
        $get_user_info = "https://graph.qq.com/user/get_user_info?"
            . "access_token=" . $_SESSION['access_token']
            . "&oauth_consumer_key=" . $_SESSION["appid"]
            . "&openid=" . $_SESSION["openid"]
            . "&format=json";
        $info = file_get_contents($get_user_info);
        $arr = json_decode($info, true);
        return $arr;
    }

    // 微博用户的callback
    public function weiboCallback()
    {
    	session_start();
    	require_once('oauth/weibo/config.php');
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
           	$userdata=$this->weiboGetUserInfo($uid);
            if($this->checkIfHasThisUser($uid,'sina')) $userdata=$this->checkIfHasThisUser($uid,'sina');
            else 
            {
                $userdata['uid']=$this->insertUser($userdata);
                // echo("Hello world!{$userdata['uname']}");
            }
            $this->setSession($userdata);
            header("Location:".base_url());
			return true;
			
		}
		else return false;
    }


    // 获取微博用户信息
    public function weiboGetUserInfo($uid)
    {    	   
		require_once('oauth/weibo/config.php');
		$auth_params = array('client_id' => WB_AKEY, 'client_secret' => WB_SKEY,'access_token' => NULL,'refresh_token'=>NULL);
		$this->load->library('saetclientv2', $auth_params);
		$client=$this->saetclientv2;   
		$user_array=$client->show_user_by_id($uid);           
		$userinfo = array('usinaid' =>$user_array['id'],
            'uname'=>$user_array['screen_name'],
            'udescription' =>$user_array['description'],
            'usex' =>$user_array['gender'] ,
            'uavatar'=>$user_array['profile_image_url'],
            'uurl'=>$user_array['profile_url'],
            'ufrom'=>'sina',
            'ulocation'=>$user_array['location']);           
		// print_r($userinfo);
		return $userinfo;
           
    }

    // 插入记录 并返回插入该记录的id
    public function insertUser($data)

    {
        date_default_timezone_set('UTC');        
        $date=date("Y-m-d H-i-s");
        $this->load->database();              
        $data['udate']=$date;
        if($this->db->insert('user', $data))        return $this->db->insert_id();

        else return false;
    }

    // 检查是否存在这个用户，如果存在返回用户信息的数组
    public function checkIfHasThisUser($openid,$snsname)
    {
    	$this->load->database();
        $fromsns='';
        switch ($snsname) {
            case 'sina':
                # code...
                $fromsns='usinaid';
                break;
            case 'qq':
                # code...
                $fromsns='uqqid';
                break;
            default:
                # code...
                break;
        }
    	$query=$this->db->query("SELECT * from user where ".$fromsns." = '" . $openid . "'");
    	if($query->num_rows() > 0)
        {
            $data_array=$query->result_array();            
            return $data_array[0];
            
        }
    	else false;
    }

    // 设置session
    public function setSession($userArray){
        $_SESSION['user']=$userArray;        
    }

    
}

?>