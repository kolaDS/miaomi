<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>喵时钟，从flickr获取图片</title>
		<link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../../css/bootstrap-responsive.css">
		<link rel="stylesheet" type="text/css" href="../../css/miaoclock_edit.css">
		<link rel="stylesheet" type="text/css" href="../../css/imgareaselect-default.css">		
	</head>
	<body>
		<div class="navbar navbar-fixed-top">
	      <div class="navbar-inner">
	        <div class="container">
	          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <a class="brand" href="./index.html">MiaoClock <sup>beta</a>
	          <div class="nav-collapse collapse">
	            <ul class="nav">
	              <li class="">
	                <a href="./index.html">Overview</a>
	              </li>	              
	              <li class="">
	                <a href="./examples.html">Examples</a>
	              </li>
	            </ul>
	          </div>
	        </div>
	      </div>
	    </div>

	    <!-- 顶部导航 -->

	    <div class="miao_edit container">

		<!-- 图片列表 -->
		<ul id="source_list" class="source_list">		
			<?php foreach ($url_list as $item):?>
			<li class="source_item"><img class="source_img" src="<?php echo $item;?>"/></li>
			<?php endforeach;?>			
		</ul>
		<!-- 图片列表 -->

		<!-- popup层 -->
		<div class="lay_pop">
			<div class="edit_modal modal  hide" id="myModal" style="">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h3>Modal header</h3>
				</div>
				<div class="modal-body">
			 		<div id="edit_container" class="edit_container">
			 			<div id="edit_inner" class="edit_inner">

			 			</div>
			 		</div>			 		
				</div>
				<div class="modal-footer">
					<form method="post" action="createimg">
					        <input type="hidden" name="Edit_X1" id="Edit_X1" value="-">
					        <input type="hidden" name="Edit_X2" id="Edit_X2" value="-">
					        <input type="hidden" name="Edit_Y1" id="Edit_Y1" value="-">
					        <input type="hidden" name="Edit_Y2" id="Edit_Y2" value="-">
					        <input type="hidden" name="Edit_W" id="Edit_W" value="-">					        
					        <input type="hidden" name="Edit_H" id="Edit_H" value="-">					        
					        <input type="hidden" name="Src_URL" id="Src_URL" value="-">
							<a href="#" class="btn" data-dismiss="modal">Close</a>
							<button type="submit" href="#" class="btn btn-primary">Save changes</button>
					      
					</form>
				</div>
			</div>
		</div>
		<!-- popup层 -->
		</div>

	</body>  
	<script type="text/javascript" src="../../js/jquery-1.7.2.min.js"></script>	
	<script type="text/javascript" src="../../js/jquery.imgareaselect.pack.js"></script>
	<script type="text/javascript" src="../../js/jquery.masonry.min.js"></script>
	<script type="text/javascript" src="../../js/jquery.infinitescroll.min.js"></script>
	<script type="text/javascript" src="../../js/bootstrap.min.js"></script>
	<script type="text/javascript">
	$(function(){

		// 瀑布流的方法
		function do_masonry()
		{
			var $container = $('#source_list');
			$container.imagesLoaded( function(){
			  $container.masonry({
			    itemSelector : '.source_item',			    
			  });			  
			  $(".source_img").live("click",function(){
				  var img_source_url=$(this).attr("src");
				  if(img_source_url) img_source_url=img_source_url.slice(0,img_source_url.length-5)+"b.jpg";
				  var img_big_source_url="<img id='editimg_img' class='editing_img' src='"+img_source_url+"' />";
				  $("#edit_inner").html(img_big_source_url);
				  $("#myModal").modal({
				  	keyboard: false
				  	
				  });
				  $("#Src_URL").val($("#editimg_img").attr("src"));
				  $("#edit_inner").imgAreaSelect({   
				        aspectRatio: '640:960',  //设置缩放比例  
				        handles: true,  //显示手型  
				        fadeSpeed: 200,  
				        onSelectChange: preview //选区改变后返回函数  
				    });  
				});
			});
		}

		function preview(img, selection) {  
		    if (!selection.width || !selection.height)  
		        return;  
		    
		  
		    $('#Edit_X1').val(selection.x1);  
		    $('#Edit_X2').val(selection.x2);  		     
		    $('#Edit_Y1').val(selection.y1);  
		    $('#Edit_Y2').val(selection.y2);  
		    $('#Edit_W').val($("#editimg_img")[0].width);  
		    $('#Edit_H').val($("#editimg_img")[0].height);  
		    
		}  
		do_masonry();
		});
	</script>
	
</html>