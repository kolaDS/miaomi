<?php
class signup extends CI_Controller {   


    public function index()
    {
    	$this->load->view("login");

    	if(isset($_POST['ID'])) $ID=$_POST['ID'];
    	if(isset($_POST['UID'])) $UID=$_POST['UID'];
    	if(isset($_POST['UNAME'])) $UNAME=$_POST['UNAME'];
    	if(isset($_POST['UAVA'])) $UAVA=$_POST['UAVA'];

    	if(isset($_POST['ID']) && isset($_POST['UID']) && isset($_POST['UNAME']) && isset($_POST['UAVA']) ){
    		$this -> insertUser($ID,$UID,$UNAME,$UAVA);
    		$this -> getUserList();
    	}




    }  


    public function insertUser($ID,$UID,$UNAME,$UAVA)

    {
        $this->load->database();
        $data = array(                
               'id' => $ID,
               'uid' => $UID,
               'uname' => $UNAME,
               'uavatar' => $UAVA
            );

        if($this->db->insert('user', $data))        return true;
        else return false;
    }


    public function getUserList()
    {
    	$this->load->database();
    	$query = $this->db->query('SELECT id,uid, uname, uavatar FROM user');
    	$data['use_list']=$query->result_array();
    	// print_r($data);
    	$this->load->view('userlist',$data);
		
    }

    
}

?>
