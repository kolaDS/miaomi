<?php 

class getsource extends CI_Controller {

	public function index()
	{
		$data['url_list']=$this->GetImageUrl();		
		$this->load->view('getsource_view',$data);
	}

	public function GetImageUrl($tagName="kitty",$sizeSign="n",$perpage=30)
    {
        /*flickr的api url*/
        $url="http://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=0f20a27d40cfc38e324f886fdd5a08c1&tags=".$tagName."&per_page=".$perpage."&format=json&nojsoncallback=1";
        /*声明一个数组用来传值*/
        $source_url_data;
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
                $source_url_data[$i]=$url;      
                
            }
        }      

        return $source_url_data;
        
    }
}
