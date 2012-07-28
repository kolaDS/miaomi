<?php 

class table extends CI_Controller {
    public function index()
    {
        
    }

    public function insert()

    {
        $this->load->database();
        $data = array(
                
               'uid' => "3424353423",
               't_name' => "猴子与面包",
               't_ava' => "http://geting.in/100tcat",
               't_url' => "http://miaomi.in"
            );

            $this->db->insert('user', $data); 
    }


    public function delete($database_name="hello")
    {
        $this->load->dbforge();

        try{
            if ($this->dbforge->drop_database($database_name))
            {
                echo '数据库已经被删除!';
            }
        }
        catch(Exception $e){
             echo 'Message: ' .$e->getMessage();
         }
    }

    
}
