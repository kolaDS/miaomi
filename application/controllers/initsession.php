<?php

class initsession extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $user=array(
            "uid"=>"1689983905",
            "uname"=>"_HappyPrince",
            "udescription"=>"节操掉了一地的二逼青年...",
            "usex"=>"m",
            "uavatar"=>"http://tp2.sinaimg.cn/1689983905/50/5624207018/1",
            "uurl"=>"u/1689983905",
            "ulocation"=>"四川 成都"
        );
        
        session_start();
        $_SESSION['user']=$user;
        echo("初始化成功！<a href='imglist'>返回图片列表</a>");

    }

    public  function meters(){
        $user=array(
                   "uid"=>"1738767847",
                   "uname"=>"猴子与面包",
                   "udescription"=>"你看我是一个嬉皮。",
                   "usex"=>"m",
                   "uavatar"=>"http://tp4.sinaimg.cn/1738767847/50/5621223593/1",
                   "uurl"=>"cxfmeters",
                   "ulocation"=>"新疆 阿勒泰"
               );

               session_start();
               $_SESSION['user']=$user;
               echo("初始化成功！<a href='../imglist'>返回图片列表</a>");
    }
    



}