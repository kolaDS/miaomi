<?php


    $imageName="";
    $imageWidth=640;
    $imageHeight=960;
    $imageText="";
    $tagName="cat";

    /*主入口 */
    function index()
    {


        global $tagName,$imageName,$imageWidth,$imageHeight,$imageText;
        GetImageUrl();

    }

    /*检查静态图是否存在*/
    function IsHaveStatic($imgCode)
    {
        if(file_exists("image/".$imgCode.".png")) return true;
        else return false;
    }




    /*使用图片来生成*/
    function CreateImageWithImage($imageWidth, $imageHeight, $tagName)
    {
        global $tagName,$imageName,$imageWidth,$imageHeight,$imageText;
    	/*从flickr获取到图片*/
    	if(!file_exists("source/".$tagName.".jpg")) $src=imagecreatefrompng("ad/face.png");
    	else $src = imagecreatefromjpeg("source/".$tagName.".jpg");        
    	/*创建一个真彩的画布，为了解决图片失真的问题*/
    	$des = imagecreatetruecolor($imageWidth, $imageHeight);
    	/*声明一个背景色*/
    	$dex_bk_color = imagecolorallocate($des, 100, 0, 0);
    	/*获取到源图版的宽高*/
    	$src_w = imagesx($src);
    	$src_h = imagesy($src);        
    	/*声明源图片裁剪的宽高、起始坐标*/
    	$src_resize_w=0;
    	$src_resize_h=0;
    	$src_x=0;
    	$src_y=0;
    	/*根据不同宽高比来调整*/
    	if ($src_w / $src_h < $imageWidth / $imageHeight) {
    		$src_resize_w = $src_w;
    		$src_resize_h = ($src_w * $imageHeight) / $imageWidth;
    		$src_x = 0;   
    		$src_y = ($src_h - $src_resize_h) / 2;

    	}
    	/*根据不同宽高比来调整*/
    	if ($src_w / $src_h >= $imageWidth / $imageHeight) {
    		$src_resize_h = $src_h;
    		$src_resize_w = ($src_h * $imageWidth) / $imageHeight;
    		$src_y = 0;
    		$src_x = ($src_w - $src_resize_w) / 2;

    	}
    	/*把图片画进去，保存出来*/        
        imagecopyresampled($des, $src, 0, 0, $src_x, $src_y, $imageWidth, $imageHeight, $src_resize_w, $src_resize_h);
        if(file_exists("image/" . $imageWidth . "x" . $imageHeight . "t" . $tagName . ".png")) unlink("image/" . $imageWidth . "x" . $imageHeight . "t" . $tagName . ".png");        
        imagepng($des, "image/" . $imageWidth . "x" . $imageHeight . "t" . $tagName . ".png");        
        imagedestroy($des);
        ReturnImage($imageWidth . "x" . $imageHeight . "t" . $tagName);
    }


   
    /*获取图片url*/
    function GetImageUrl($tagName="cat",$sizeSign="q")
    {
        /*flickr的api url*/
        $url="http://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=0f20a27d40cfc38e324f886fdd5a08c1&tags=".$tagName."&per_page=10&format=json&nojsoncallback=1";
        /*获取json字符串*/
        $result = file_get_contents($url);
        /*转成php数组格式*/
        $data=json_decode($result,true);
        /*找到photo节点，变成一个数组*/
        $photo=$data["photos"]["photo"];
        if(count($photo)==0) $url=false;
        else
        {
        /*搞个随机数*/
        for($i=0;$i<count($photo);$i++)        
        /*返回这个图片url*/
            {
                $url="http://farm".$photo[$i]["farm"].".staticflickr.com/".$photo[$i]["server"]."/".$photo[$i]["id"]."_".$photo[$i]["secret"]."_".$sizeSign.".jpg";        
                echo("<img src='".$url."' /><br/>");
            }
        }
        
    }

index();

//if(CheckImageTimeOut("200x300")) echo 1;
//else echo 0;
?>