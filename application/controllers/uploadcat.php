<?php

class uploadcat extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

    public function index()
    {
        session_start();
        if(isset($_SESSION['user'])) echo("Hello ".$_SESSION['user']['uid'].$_SESSION['user']['uname']);
        else echo("You are not login!");
        $this->load->view('upload_form', array('error' => '' ));
       
    }

    public function do_upload($catid=2)
    {
        session_start();
        date_default_timezone_set('UTC');
        //Todo hard code
        if(isset($_SESSION['user']))
        {
            
            $imguid=$_SESSION['user']['uid'];
            $imgname=date("YmdHis")."_".$imguid;
            $imgcatid=$catid;
            $imgtext=$_POST['imgtext'];            
            $imgdate=date("ymdHis");

            $config['file_name'] = $imgname.".jpg";
            $config['upload_path'] = 'public/uploads';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '10000';
            $config['max_width']  = '1024';
            $config['max_height']  = '1000';

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload())
            {
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('upload_form', $error);
            }
            else
            {
                $imgdata = array('upload_data' => $this->upload->data());
                $formdata=array('imgusrid'=>$imguid,'imgcatid'=>$imgcatid,'imgtext'=>$imgtext,'imgdata'=>$imgdata);
                $data=array('imgtext'=> $imgtext,'imguid'=>$imguid,'imgcatid'=>$imgcatid,'imgname'=>$imgname);
                $this->load->model('img');                
                $this->img->insertImg($data);
                $this->load->view('upload_success', $formdata);
            }
        }

        else   Header("Location: https://api.weibo.com/oauth2/authorize?client_id=1994141322&redirect_uri=http%3A%2F%2Flocalhost%2FMiaoClock%2Fci%2Findex.php%2Fcallback&response_type=code");
    }

    public function showimg()
    {
        $this->load->model('img');
        $imgdata=$this->img->getImg(10);
        print_r($imgdata);
    }

    public function showuser()
    {
        $this->load->model('user');
        $data=$this->user->getUser(10);
        print_r($data);
    }

    
}
?>