
</div>
<!--主体 End-->
<!--底部 Str-->
<div class="footer">Copyright <span>&copy;</span> <a href="http://himeters.com/">meters</a>/<a href="http://hikola.com/">kola</a> All Rights Reserved.</div>
<!--底部 End-->
</div>
<!--大图查看弹出层 Str-->
<div id="zoomPreview" class="zoom-preview">
	<div id='popPreview' class='pop-wrapper pop-preview'>
		<div id="innerPreview" class='pop-inner'>
		</div>
	</div>
</div>
<!--大图查看弹出层 End-->
</body>
 
	<script type="text/javascript" src="/miaomi/public/js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="/miaomi/public/js/jquery.imgareaselect.pack.js"></script>
	<script type="text/javascript" src="/miaomi/public/js/jquery.masonry.min.js"></script>
	<script type="text/javascript" src="/miaomi/public/js/jquery.infinitescroll.js"></script>
	<script type="text/javascript" src="/miaomi/public/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/miaomi/public/js/jquery.mousewheel.min.js"></script>
	<script type="text/javascript" src="/miaomi/public/js/jsTemp.js"></script>
	<script type="text/javascript" src="/miaomi/public/js/miaomi.js"></script>
	<script type="text/javascript">
	$(function(){

		// 瀑布流的方法
		function do_masonry()
		{
			var $container = $('#mainList');

			$container.imagesLoaded( function(){//imagesloaded 方法导致ie8，ie7下瀑布流不生效
			  $container.masonry({
			    itemSelector : '.item',
			    isAnimated: !Modernizr.csstransitions
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

        $(function () {

            var $container = $('#mainList');     
            var lastimgid=$(".item").last().attr("imgid");
                        
                        $("#page-nav a").attr("href","/miaomi/imglist/page/"+lastimgid);       
            
            $container.infinitescroll({
                    navSelector:'#page-nav', // selector for the paged navigation
                    nextSelector:'#page-nav a', // selector for the NEXT link (to page 2)
                    itemSelector:'.item', // selector for all items you'll retrieve
                    loading:{
                        finishedMsg:'No more pages to load.',
                        img:'http://i.imgur.com/6RMhx.gif'
                    },                    
                    bufferPx:0,
                    debug:"true",
                    errorCallback: function(){$(".loading-txt").fadeIn(300)}
                },
                // trigger Masonry as a callback
                function (newElements) {

                    // hide new items while they are loading
                    var $newElems = $(newElements).css({ opacity:0 });
                    // ensure that images load before adding to masonry layout
                    $newElems.imagesLoaded(function () {
                        // show elems now they're ready
                        $newElems.animate({ opacity:1 });
                        $container.masonry('appended', $newElems, true);
                        var lastimgid=$(".item").last().attr("imgid");                        
                        $("#page-nav a").attr("href","/miaomi/imglist/page/"+lastimgid);
                    });
                }
            );

        });



			  

//		do_masonry();



		});
	</script>
	
</html>