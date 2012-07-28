<?php 

class database extends CI_Controller {
    public function index()
    {
        
    }

    public function create($database_name="hello")
    {
        $this->load->dbforge();

        try{
            if ($this->dbforge->create_database($database_name))
            {
                echo '数据库已经被创建!';
            }
        }
        catch(Exception $e){
             echo 'Message: ' .$e->getMessage();
         }
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
