<?php 

class testdate extends CI_Controller {
    public function index()
    {
     $date_str="2012-07-25 11:05:35";
     $date_obj=strtotime($date_str);
     $my_date=strftime("%H:%M:%S",$date_obj);
     print_r($my_date);
    }
}
