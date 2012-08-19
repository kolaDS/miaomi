<?php

class logout extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        
    }

    public function index()
    {   
        session_start();
        if(isset($_SESSION['user']))
            {   
                $_SESSION['user']=NULL;
            }
            
                 
    }


   

      
}
?>