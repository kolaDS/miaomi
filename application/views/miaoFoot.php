
</div>
<!--主体 End-->
</body>
 
	<script type="text/javascript" src="../public/js/jquery-1.7.2.min.js"></script>	
	<script type="text/javascript" src="../public/js/jquery.imgareaselect.pack.js"></script>
	<script type="text/javascript" src="../public/js/jquery.masonry.min.js"></script>
	<script type="text/javascript" src="../public/js/jquery.infinitescroll.min.js"></script>
	<script type="text/javascript" src="../public/js/bootstrap.min.js"></script>
	<script type="text/javascript">
	$(function(){

		// 瀑布流的方法
		function do_masonry()
		{
			var $container = $('#mainList');
			$container.imagesLoaded( function(){
			  $container.masonry({
			    itemSelector : '.item',			    
			  });
			  // 给图片加点击弹出层事件
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


		$(document).ready(function() {
			// 使用 jQuery 异步提交表单
			$('.icon-like').live("click",function(){
				var imgid=$(this).attr('imgid');
				$.ajax({
					type:"POST",
					url:"addlike",
					data:"imgid="+imgid,
					success:function(){alert('你赞得好！');}
				});
			});
			  
			});
		// 给图片加点击赞操作
			  

		do_masonry();



		});
	</script>
	
</html>