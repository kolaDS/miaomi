<?php 

class createimg extends CI_Controller {

    public $imageWidth=640;
    public $imageHeight=960;        

	public function index()
	{
        if($_POST["Edit_X1"] != "-") $Edit_X1=$_POST["Edit_X1"];
        if($_POST["Edit_Y1"] != "-") $Edit_Y1=$_POST["Edit_Y1"];
        if($_POST["Edit_X2"]) $Edit_X2=$_POST["Edit_X2"];
		if($_POST["Edit_Y2"]) $Edit_Y2=$_POST["Edit_Y2"];
        if($_POST["Edit_W"]) $Edit_W=$_POST["Edit_W"];
        if($_POST["Edit_H"]) $Edit_H=$_POST["Edit_H"];
        if($_POST["Src_URL"]) $Src_URL=$_POST["Src_URL"];

        if($Edit_W!="-") $this->CreateImage($Edit_X1, $Edit_Y1, $Edit_X2, $Edit_Y2, $Src_URL, $Edit_W ,$Edit_H);
        else $this->CreateImageDefault($Src_URL);

	}


     /*使用图片来生成*/
    public function CreateImage($Edit_X1, $Edit_Y1, $Edit_X2, $Edit_Y2, $Src_URL, $Edit_W ,$Edit_H)
    {
        date_default_timezone_set('UTC');
        
        /*从flickr获取到图片*/
        $src = imagecreatefromjpeg($Src_URL);    
        /*创建一个真彩的画布，为了解决图片失真的问题*/
        $des = imagecreatetruecolor($this->imageWidth, $this->imageHeight);
        /*获取到源图版的宽高*/
        $src_w = imagesx($src);
        $src_h = imagesy($src);        
        /*声明源图片裁剪的宽高、起始坐标*/
        $src_resize_w=0;
        $src_resize_h=0;
        $p_x=$src_w/$Edit_W;
        $p_y=$src_h/$Edit_H;
        $src_x1=$Edit_X1*$p_x;
        $src_y1=$Edit_Y1*$p_y;
        $src_x2=$Edit_X2*$p_x;
        $src_y2=$Edit_Y2*$p_y;
        $src_resize_w=round($src_x2-$src_x1);
        $src_resize_h=round($src_y2-$src_y1);        

        /*把图片画进去，保存出来*/        
        imagecopyresampled($des, $src, 0, 0, $src_x1, $src_y1, $this->imageWidth, $this->imageHeight, $src_resize_w, $src_resize_h);

        if(file_exists("../image/" .date("n"). "_" .date("j"). "_" . date("g") ."_".date("i"). ".png")) unlink("../image/" .date("n"). "_" .date("j"). "_" . date("g") ."_".date("i"). ".png");     
        
        imagepng($des, "../image/" .date("n"). "_" .date("j"). "_" . date("g") ."_".date("i"). ".png");        
        imagedestroy($des);        
    }



     /*使用图片来生成*/
    public function CreateImageDefault($Src_URL)
    {
        date_default_timezone_set('UTC');
        
        /*从flickr获取到图片*/
        $src = imagecreatefromjpeg($Src_URL);    
        /*创建一个真彩的画布，为了解决图片失真的问题*/
        $des = imagecreatetruecolor($this->imageWidth, $this->imageHeight);
        /*获取到源图版的宽高*/
        $src_w = imagesx($src);
        $src_h = imagesy($src);        
        /*声明源图片裁剪的宽高、起始坐标*/
        $src_resize_w=0;
        $src_resize_h=0;
        $src_x=0;
        $src_y=0;
        /*根据不同宽高比来调整*/
        if ($src_w / $src_h < $this->imageWidth / $this->imageHeight) {
            $src_resize_w = $src_w;
            $src_resize_h = ($src_w * $this->imageHeight) / $this->imageWidth;
            $src_x = 0;   
            $src_y = ($src_h - $src_resize_h) / 2;

        }
        /*根据不同宽高比来调整*/
        if ($src_w / $src_h >= $this->imageWidth / $this->imageHeight) {
            $src_resize_h = $src_h;
            $src_resize_w = ($src_h * $this->imageWidth) / $this->imageHeight;
            $src_y = 0;
            $src_x = ($src_w - $src_resize_w) / 2;

        }       

        /*把图片画进去，保存出来*/        
        imagecopyresampled($des, $src, 0, 0, $src_x, $src_y, $this->imageWidth, $this->imageHeight, $src_resize_w, $src_resize_h);

        if(file_exists("../image/" .date("n"). "_" .date("j"). "_" . date("g") ."_".date("i"). ".png")) unlink("../image/" .date("n"). "_" .date("j"). "_" . date("g") ."_".date("i"). ".png");     
        
        imagepng($des, "../image/" .date("n"). "_" .date("j"). "_" . date("g") ."_".date("i"). ".png");        
        imagedestroy($des);        
    }

   	
}
