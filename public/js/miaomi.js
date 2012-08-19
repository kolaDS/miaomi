//关闭弹出层

var Miaomi={
	log:function(i){
		console.log(i);
	},
	pop:function(htmlString){

	},
	popImg:function(obj){

	}

};

(function($,M){


	// TODO 须重写
	M.initPopImg=function(){
		//图片点击事件
		var body = $('body'),
			html = $('html'),
			pics = $('.J-miaoPic'),
			picPreviewed = 0,
			picPreviewContainer = $('#zoomPreview'),
			picPreviewMod = "<div id='popPreview' class='pop-wrapper pop-preview'><div class='pop-inner'><div class='mod-avatar-txt pic-info'><a href='#' class='avatar-wrap'><img src='http://www.getimg.in/img/50x50tsunyanzi'alt='' class='avatar'></a><div class='txt-wrap'><p class='nickname-wrap'><a href='#' class='nickname'>船到桥头自然沉</a></p><p>上传于2012-09-12</p></div><i class='icon-adorn'></i></div><div class='pic-preview'><div class='pic-preview-inner'><a href='#'><img src='http://www.getimg.in/img/640x500tbigcat'alt='' class='pic'></a><div class='item-op'><a href='#' class='ui-icon icon-like'>喜欢</a><a href='#' class='ui-icon icon-share'>分享</a></div></div><p class='pic-preview-info'>二货喵星人！啪啪啪啪啪！！</p></div><div class='more-info-item'><div class='more-info-list'><h3>他们也喜欢这只喵星人：</h3><ul class='list-pic'><li><a href='#'><img src='http://www.getimg.in/img/50x50tbluecat'alt=''></a></li><li><a href='#'><img src='http://www.getimg.in/img/50x50tredcat'alt=''></a></li><li><a href='#'><img src='http://www.getimg.in/img/50x50tsmallcat'alt=''></a></li><li><a href='#'><img src='http://www.getimg.in/img/50x50tblackcat'alt=''></a></li></ul></div></div><div class='more-info-item'><div class='more-info-list list-a'><h3>他们也喜欢：</h3><ul class='list-pic'><li><a href='#'><img src='http://www.getimg.in/img/50x50tbluecat'alt=''></a></li><li><a href='#'><img src='http://www.getimg.in/img/50x50tredcat'alt=''></a></li><li><a href='#'><img src='http://www.getimg.in/img/50x50tsmallcat'alt=''></a></li><li><a href='#'><img src='http://www.getimg.in/img/50x50tblackcat'alt=''></a></li><li><a href='#'><img src='http://www.getimg.in/img/50x50tblackcat'alt=''></a></li></ul></div><div class='more-info-list list-b'><h3>他们也喜欢：</h3><ul class='list-pic'><li><a href='#'><img src='http://www.getimg.in/img/50x50tbluecat'alt=''></a></li><li><a href='#'><img src='http://www.getimg.in/img/50x50tredcat'alt=''></a></li><li><a href='#'><img src='http://www.getimg.in/img/50x50tsmallcat'alt=''></a></li><li><a href='#'><img src='http://www.getimg.in/img/50x50tblackcat'alt=''></a></li></ul></div></div><div class='mod-comment'><div class='mod-comment-list'><ul class='list'><li class='list-item'><div class='mod-avatar-txt'><a href='#' class='avatar-wrap'><img src='http://www.getimg.in/img/50x50tsunyanzi'alt='' class='avatar'></a><div class='txt-wrap'><p class='nickname-wrap'><a href='#' class='nickname'>船到桥头自然沉</a><span class='date'>-前天说：</span></p><p>我姨妈是90后！啪啪啪啪啪！嘿咻嘿咻嘿咻！巴扎黑！我姨妈是90后！啪啪啪啪啪！嘿咻嘿咻嘿咻！巴扎黑！我姨妈是90后！啪啪啪啪啪！嘿咻嘿咻嘿咻！巴扎黑！我姨妈是90后！啪啪啪啪啪！嘿咻嘿咻嘿咻！巴扎黑！我姨妈是90后！啪啪啪啪啪！嘿咻嘿咻嘿咻！巴扎黑！</p></div></div></li><li class='list-item'><div class='mod-avatar-txt'><a href='#' class='avatar-wrap'><img src='http://www.getimg.in/img/50x50tsunyanzi'alt='' class='avatar'></a><div class='txt-wrap'><p class='nickname-wrap'><a href='#' class='nickname'>船到桥头自然沉</a><span class='date'>-前天说：</span></p><p>我姨妈是90后！啪啪啪啪啪！嘿咻嘿咻嘿咻！</p></div></div></li><li class='list-item'><div class='mod-avatar-txt'><a href='#' class='avatar-wrap'><img src='http://www.getimg.in/img/50x50tsunyanzi'alt='' class='avatar'></a><div class='txt-wrap'><p class='nickname-wrap'><a href='#' class='nickname'>船到桥头自然沉</a><span class='date'>-前天说：</span></p><p>我姨妈是90后！啪啪啪啪啪！嘿咻嘿咻嘿咻！</p></div></div></li></ul></div><div class='mod-comment-report'><div class='avatar-wrap'><img src='http://www.getimg.in/img/50x50tsunyanzi'alt='' class='avatar'></div><div class='report-container'><div class='report-textarea-wrapper'><textarea id='' class='report-textarea'></textarea></div><div class='report-op-wrapper'><a href='#' class='btn-submit'>提交</a></div></div></div></div></div></div>";

		//显示大图弹出层
		function picPreviewShow(){			
			var sTop = html.scrollTop();
			html.addClass('noscroll');
			html.scrollTop(sTop);	
			if(!picPreviewed){
				picPreviewContainer.addClass('zoom-show').append(picPreviewMod);
				picPreviewed = 1;
			}
			
		}

		picPreviewContainer.live('click',function(e){
				e.stopPropagation();
				var $target = $(e.target);				
				if($target.is(picPreviewContainer)){
					picPreviewContainer.removeClass('zoom-show').children('#popPreview').remove();
					html.removeClass('noscroll');
					picPreviewed = 0;
			}
		});
		
		pics.each(function(){			
			var $pic = $(this);			
			$pic.live('click',function(){
				var imgdata=M.getImgInfo($(this));
				var sTop = html.scrollTop();
				html.addClass('noscroll');
				html.scrollTop(sTop);	
				if(!picPreviewed){
					picPreviewContainer.addClass('zoom-show').append(picPreviewMod);
					picPreviewed = 1;
				}
			})
		});
	};

	//获取鼠标点击图片的信息
	M.getImgInfo=function(El){
		var obj={
			imgid:El.attr("imgid"),
			uid:El.attr("uid"),
			uname:El.attr("uname"),
			uurl:El.attr("uurl"),
			uavatar:El.attr("uavatar"),
			imgtext:El.attr("imgtext"),
			imgdate:El.attr("imgdate")
		}
		return obj;
	}

})(jQuery,Miaomi);


(function($,M){
	M.initPopImg();
})(jQuery,Miaomi);
