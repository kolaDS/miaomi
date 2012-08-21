//关闭弹出层

var Miaomi={
	initCurrentUser:function(){
		this.getCurrentUser();
	},
	$innerPreview:$("#innerPreview"),
	// 打印方法
	log:function(i){
		console.log(i);
	},
    //瀑布流方法
    initMasonry:function(){
        var $container = $('#mainList');
        $container.imagesLoaded(function () {//imagesloaded 方法导致ie8，ie7下瀑布流不生效
                    $container.masonry({
                        itemSelector:'.item'
                    });
        })
    },
    //瀑布流滚动
    scrollList:function(){

    },

	// 插入浮层方法
	pop:function(htmlString){
		this.$innerPreview.append(htmlString);
	},
	// 添加赞
	addLike:function(iconLikeEL){		
		var imgid=iconLikeEL.attr('imgid');
		$.ajax({
			type:"POST",
			url:"addlike",
			data:"imgid="+imgid,
			success:function(){						
				console.log("ok");
			}
		});		
	},
	// 提交评论
	uploadComment:function(imgid,text){
		$.post(
			"uploadComment/uploadCommentAPI",
				{
					"comment_imgid":imgid,
					"comment_text":text
				}
			).success(function(data){return data;});

	},
	// 添加假评论数据
	addFakeComment:function(text,textarea){
			var $commList=$(".mod-comment-list .list");
			var fakeCommentText="<li class='list-item'>\
						<div class='mod-avatar-txt'>\
							<a href='#' class='avatar-wrap'><img src='"+this.currentUser.uavatar+"' alt='' class='avatar'></a>\
							<div class='txt-wrap'>\
								<p class='nickname-wrap'>\
									<a href='#' class='nickname'>"+this.currentUser.uname+"</a>\
									<span class='date'>-刚刚说：</span>\
								</p>\
								<p>"+text+"</p>\
							</div>\
						</div>\
					</li>";
			$commList.append(fakeCommentText);
			textarea.val("");


	},	
	// 获取当前登陆用户的数据
	getCurrentUser:function(){
		var $userEL=$("#head-user");
		this.currentUser={
			'uid':$userEL.attr("uid"),
			'uname':$userEL.attr("uname"),
			'uurl':$userEL.attr("uurl"),
			'uavatar':$userEL.attr("uavatar")
		};
	},
	// 加载谁也喜欢
	getWhoLikeThisImg:function(selector,imgid){
		$.post(
			"imglist/getWhoLikeThisImg",
				{
					"imgid":imgid
				}
			).success(function(data){
				var list=eval(data);
				var list_HTML="";
				if(list.length) for(var index in list)
				{
					list_HTML+= "<li><a uid='"+list[index].uid+"' href='#'><img src='"+list[index].uavatar+"' alt=''></a></li>";
				}
				else list_HTML+="<li>矮油，还没有人喜欢哦～</li>";
				$(selector).append(list_HTML).removeClass('loading');
			})
	}

};

(function($,M){
	// 初始化赞icon
	M.initIconLike=function(){
		$(".icon-like").click(function(){M.addLike($(this))});
		
	};
	// TODO 须重写
	M.initPopImg=function(){
		//图片点击事件
		var body = $('body'),
			html = $('html'),
			pics = $('.J-miaoPic'),
			picPreviewed = 0,
			picPreviewContainer = $('#zoomPreview'),
			previewInner=$("#innerPreview"),
			picPreviewMod = "";

		//显示大图弹出层
		function picPreviewShow(){
			var sTop = html.scrollTop();
			html.addClass('noscroll');
			html.scrollTop(sTop);
			if(!picPreviewed){
				 picPreviewContainer.addClass('zoom-show');
				 // picPreviewContainer.addClass('zoom-show').append(picPreviewMod);
				picPreviewed = 1;
			}

		}

		picPreviewContainer.live('click',function(e){
				e.stopPropagation();
				var $target = $(e.target);
				if($target.is(picPreviewContainer)){
					picPreviewContainer.removeClass('zoom-show');
					previewInner.empty();
					html.removeClass('noscroll');
					picPreviewed = 0;
			}
		});

		pics.each(function(){
			var $pic = $(this);
			$pic.live('click',function(){
				// 得到obj
				var data=M.getImgInfo($(this));

				// 展示图片
				M.popImg(data);

				// 加载评论
				M.popCommenList(data);

				// 加载谁也喜欢
				M.getWhoLikeThisImg("#list-who-like",data.imgid);
				var sTop = html.scrollTop();
				picPreviewShow();
			})
		});
	};

	//获取鼠标点击图片的信息
	M.getImgInfo=function(El){
		var obj={
			imgid:El.attr("imgid"),
			imgurl:El.attr("src"),
			uid:El.attr("uid"),
			uname:El.attr("uname"),
			uurl:El.attr("uurl"),
			uavatar:El.attr("uavatar"),
			imgtext:El.attr("imgtext"),
			imgdate:El.attr("imgdate")
		};
		return obj;
	};
	// 通过传入一个obj信息，把图片展示出来
	M.popImg=function(obj){
		var popImg_HTML="\
	<div class='mod-avatar-txt pic-info'>\
		<a href='http://weibo.com/u/"+obj.uurl+"' class='avatar-wrap'>\
		<img src='"+obj.uavatar+"'alt='' class='avatar'>\
		</a>\
		<div class='txt-wrap'>\
			<p class='nickname-wrap'>\
				<a href='#' class='nickname'>"+obj.uname+"</a>\
			</p>\
			<p>上传于"+obj.imgdate+"</p>\
		</div>\
		<i class='icon-adorn'></i>\
	</div>\
	<div class='pic-preview'>\
		<div class='pic-preview-inner'>\
			<a href='#'><img src='"+obj.imgurl+"'alt='' class='pic'></a>\
			<div class='item-op'>\
				<a href='#' class='ui-icon icon-like'>喜欢</a>\
				<a href='#' class='ui-icon icon-share'>分享</a>\
			</div>\
		</div>\
		<p class='pic-preview-info'>"+obj.imgtext+"</p>\
	</div>\
	<div class='more-info-item'>\
		<div class='more-info-list'>\
			<h3>他们也喜欢这只喵星人：</h3>\
			<ul id='list-who-like' class='list-pic loading'>\
			</ul>\
		</div>\
	</div>\
	<div class='more-info-item'>\
		<div class='more-info-list list-a'>\
			<h3>他们也喜欢：</h3>\
			<ul class='list-pic'>\
				<li><a href='#'><img src='http://www.getimg.in/img/50x50tbluecat' alt=''></a></li>\
				<li><a href='#'><img src='http://www.getimg.in/img/50x50tredcat' alt=''></a></li>\
				<li><a href='#'><img src='http://www.getimg.in/img/50x50tsmallcat' alt=''></a></li>\
				<li><a href='#'><img src='http://www.getimg.in/img/50x50tblackcat' alt=''></a></li>\
				<li><a href='#'><img src='http://www.getimg.in/img/50x50tblackcat' alt=''></a></li>\
			</ul>\
		</div>\
		<div class='more-info-list list-b'>\
			<h3>他们也喜欢：</h3>\
			<ul class='list-pic'>\
				<li><a href='#'><img src='http://www.getimg.in/img/50x50tbluecat' alt=''></a></li>\
				<li><a href='#'><img src='http://www.getimg.in/img/50x50tredcat' alt=''></a></li>\
				<li><a href='#'><img src='http://www.getimg.in/img/50x50tsmallcat' alt=''></a></li>\
				<li><a href='#'><img src='http://www.getimg.in/img/50x50tblackcat' alt=''></a></li>\
			</ul>\
		</div>\
	</div>";	
	this.pop(popImg_HTML);
	};
	// 得到评论并且插入评论
	M.popCommenList=function(obj){
		$.post(
			"uploadComment/getCommentList",
		 	{ "imgid": obj.imgid}
		 ).success(function(data) {// 转换成json
		    var commlist=eval(data);
		    // 遍历
		    var commlist_HTML="<div class='mod-comment'>\
			<div class='mod-comment-list'>\
				<ul class='list'>";
		    for(var index in commlist)
		    	{
		    		commlist_HTML+="<li class='list-item'>\
						<div class='mod-avatar-txt'>\
							<a href='#' class='avatar-wrap'><img src='"+commlist[index].uavatar+"' alt='' class='avatar'></a>\
							<div class='txt-wrap'>\
								<p class='nickname-wrap'>\
									<a href='#' class='nickname'>"+commlist[index].comment_uname+"</a>\
									<span class='date'>"+commlist[index].comment_date+"</span>\
								</p>\
								<p>"+commlist[index].comment_text+"</p>\
							</div>\
						</div>\
					</li>";
//					M.log(commlist[index]);
				}

		    commlist_HTML+="</ul></div>\
		    <div class='mod-comment-report' comment_imgid='"+obj.imgid+"'>\
				<div class='avatar-wrap'>\
					<img src='"+M.currentUser.uavatar+"' alt='' class='avatar'>\
				</div>\
				<div class='report-container'>\
					<div class='report-textarea-wrapper'>\
						<textarea id='' class='report-textarea'></textarea>\
					</div>\
				<div class='report-op-wrapper'>\
					<a href='#' class='btn-submit'>提交</a>\
				</div>\
			</div>\
		    </div>";
		    M.pop(commlist_HTML); 
		    $(".btn-submit").click(function(){
		    	var $textarea=$(this).parents(".mod-comment-report").find(".report-textarea");
		    	var comm_text=$textarea.val();
		    	var comm_imgid=obj.imgid;
		    	M.addFakeComment(comm_text,$textarea);
		    	M.uploadComment(comm_imgid,comm_text);
		    });
		});
	};

})(jQuery,Miaomi);


(function($,M){
	M.initCurrentUser();
    M.initMasonry();
	M.initIconLike();
	M.initPopImg();
    M.scrollList();
})(jQuery,Miaomi);
