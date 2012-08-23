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
         $suffix = '<scr'.'ipt>parent.Miaomi.upLoadFile.callback(';
         $ss2 = ');</script>';
        //Todo hard code
        if(isset($_SESSION['user']))
        {
            
            $imguid=$_SESSION['user']['uid'];
            $imgname=date("YmdHis")."_".$imguid;
            $imgcatid=$catid;
            $imgtext=$this->input->post('imgtext');
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
                $error = array('error' => $this->upload->display_errors('',''));
                $error_code=$this->encodeError($error);
                echo $suffix.json_encode($error_code).$ss2;
            }
            else
            {
                
                $formdata=array('imgusrid'=>$imguid,'imgcatid'=>$imgcatid,'imgtext'=>$imgtext,'imgname'=>$imgname,'imgdata'=>$this->upload->data());
                $data=array('imgtext'=> $imgtext,'imguid'=>$imguid,'imgcatid'=>$imgcatid,'imgname'=>$imgname);
                $this->load->model('img');                
                $imgidInDatabase=$this->img->insertImg($data);
                $data['imgid']=$imgidInDatabase;                
                echo $suffix.json_encode($data).$ss2;
            }
        }

        else   Header("Location: https://api.weibo.com/oauth2/authorize?client_id=1994141322&redirect_uri=http%3A%2F%2Flocalhost%2FMiaoClock%2Fci%2Findex.php%2Fcallback&response_type=code");
    }

    //映射错误代码
    public function encodeError($error){
        switch ($error['error']) {
            case 'Unable to find a post variable called userfile.':
                //"Unable to find a post variable called userfile.";
                $error['error'] = 101;
                break;

            case 'The uploaded file exceeds the maximum allowed size in your PHP configuration file.':
                //"The uploaded file exceeds the maximum allowed size in your PHP configuration file.";
                $error['error'] = 102;
                break;

            case 'The uploaded file exceeds the maximum size allowed by the submission form.':
                //"The uploaded file exceeds the maximum size allowed by the submission form.";
                $error['error'] = 103;
                break;

            case 'The file was only partially uploaded.':
                //"The file was only partially uploaded.";
                $error['error'] = 104;
                break;

            case 'The temporary folder is missing.':
                //"The temporary folder is missing.";
                $error['error'] = 105;
                break;

            case 'The file could not be written to disk.':
                //"The file could not be written to disk.";
                $error['error'] = 106;
                break;
            case 'The file upload was stopped by extension.':
                //"The file upload was stopped by extension.";
                $error['error'] = 107;
                break;

            case 'You did not select a file to upload.':
                //"You did not select a file to upload.";
                $error['error'] = 108;
                break;

            case 'The filetype you are attempting to upload is not allowed.':
                //"The filetype you are attempting to upload is not allowed.";
                $error['error'] = 109;
                break;

            case 'The file you are attempting to upload is larger than the permitted size.':
                //"The file you are attempting to upload is larger than the permitted size.";
                $error['error'] = 110;
                break;

            case 'The image you are attempting to upload exceedes the maximum height or width.':
                //"The image you are attempting to upload exceedes the maximum height or width.";
                $error['error'] = 111;
                break;

            case 'A problem was encountered while attempting to move the uploaded file to the final destination.':
                //"A problem was encountered while attempting to move the uploaded file to the final destination.";
                $error['error'] = 112;
                break;

            case 'The upload path does not appear to be valid.':
                //"The upload path does not appear to be valid.";
                $error['error'] = 113;
                break;

            case 'You have not specified any allowed file types.':
                //"You have not specified any allowed file types.";
                $error['error'] = 114;
                break;

            case 'The file name you submitted already exists on the server.':
                //"The file name you submitted already exists on the server.";
                $error['error'] = 115;
                break;

            case 'The upload destination folder does not appear to be writable.':
                //"The upload destination folder does not appear to be writable.";
                $error['error'] = 116;
                break;
            default:
                $error['error'] = 100;
                break;
        }
        return $error;
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