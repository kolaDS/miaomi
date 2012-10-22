


var Miaomi={
	init:function(){
		this.getCurrentUser();
	},

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
	

	addShare:function(iconShareEL){
		var imgEl=iconShareEL.parents(".item-inner").find("img");
		var imgEl_url=imgEl.attr("src");		
		this.log(imgEl_url);
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
				else list_HTML+="<li>矮油，还没有人喜欢哦～</li>"

				$(selector).append(list_HTML).removeClass('loading');
			})
	}

};

(function($,M){
	// 初始化赞icon
	M.initIconLike=function(){
		$(".icon-like").click(function(){M.addLike($(this))});
		
	};
	M.initIconShare=function(){
		$(".icon-share").click(function(){M.addShare($(this))});
	};
	//弹出层对象
	M.pop = function(){
		var body = $('body'),
			html = $('html'),
			//sTop = html.scrollTop(),
			//弹出层标志位
			popFlag = 0,
			popPreviewContainer = $('#zoomPreview'),
			popInner=$("#innerPreview");
		function popShow(){
			var sTop = html.scrollTop();
			html.scrollTop(sTop);
			html.addClass('noscroll');
			if(!popFlag){
				 popPreviewContainer.addClass('zoom-show zoom-mask');
				popFlag = 1;
			}
		}
		function popHide(){
			popPreviewContainer.removeClass('zoom-show zoom-mask');
			popPreviewContainer.unbind('click');
			popInner.empty();
			html.removeClass('noscroll');
			popFlag = 0;
		}
		function loginShow(){
			var sTop = html.scrollTop();
			html.scrollTop(sTop);
			html.addClass('noscroll');
			if(!popFlag){
				 popPreviewContainer.addClass('zoom-mask zoom-show login-show');
				var sheetLogin=$("#sheetLogin");
				sheetLogin.animate({top:'+=400'},500);
				popFlag = 1;
			}
		}
		function loginHide(){

			var sheetLogin=$("#sheetLogin");
			popPreviewContainer.removeClass("zoom-mask");
			sheetLogin.animate({top:'-=400'},400,function(){
				popPreviewContainer.removeClass('login-show zoom-show');
				popInner.empty();
				html.removeClass('noscroll');
				popFlag = 0;
			});

		}
		return {
			// 弹出层方法 closeElm是关闭开关
			init:function(closeElm){
				var argLen = arguments.length;
				popShow();
				if(argLen == 0){
					popPreviewContainer.bind('click',
						function(e){
							var $target = $(e.target);
							e.stopPropagation();
							if($target.is(popPreviewContainer)){
								popHide();
						}
					}
					);
				}else{
					closeElm.click(function(){
						popHide();
						return false;
					})
				}
			},
			// 登录的Tips
			loginTipsDefault:"使用下列第三方账号登录，无需注册更安全",
			loginTipsSuspend:"喵~登录之后才能继续操作噢~",

			// 登录弹出层 closeElm是关闭开关
			loginInit:function(closeElm){
				var argLen = arguments.length;
					loginShow();

					closeElm.click(function(){
						loginHide();
						return false;
					})
			},
			loginPanel:function(tipsText){
				if(!popFlag){
					popInner.empty();
					var loginTips = M.tmpl(login_tips,{logintips:tipsText});
					M.pop.insertHtml(loginTips);
					var popClose = $("#btnLoginClose");

					M.pop.loginInit(popClose);
				}else{
					return false;
				}
			},
			//弹出层插入内容的方法
			insertHtml:function(htmlString){
					popInner.append(htmlString);
				},
			//关闭弹出层方法
			tipsClose:function(){popHide();},
			//提示弹出层，带关闭按钮
			tipsInit:function(popClose){
							popShow();
							var popTips = $(".pop-tips"),
								popHeight = popTips.outerHeight(),
								popWidth = popTips.outerWidth();
							popTips.css({
								"margin-top":-popHeight/2,
								"margin-left":-popWidth/2
							});
							popClose.click(function(){popHide();})
			}
		};

	}();



	M.initPopImg=function(){
		//图片点击事件
		var pics = $('.J-miaoPic');
		//图片点击之后显示数据
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

				M.pop.init();

			})
		});
	}

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
		}
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
			<p>"+obj.imgdate+" 上传</p>\
		</div>\
		<i class='icon-adorn'></i>\
	</div>\
	<div class='pic-preview'>\
		<div class='pic-preview-inner'>\
			<a href='#'><img src='"+obj.imgurl+"'alt='' class='pic'></a>\
			<div class='item-op'>\
				<a href='#' class='ui-icon icon-like'><i></i>喜欢</a>\
				<span class='divide'></span>\
				<a href='#' class='ui-icon icon-com'><i></i>评论</a>\
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
	this.pop.insertHtml(popImg_HTML);
	};
	// 得到评论并且插入评论
	M.popCommenList=function(obj){
		$.post(
			"uploadComment/getCommentList",
		 	{ "imgid": obj.imgid}
		 ).success(function(data) {// 转换成json
		    var commlist=eval(data);
		    // 遍历
		    var commlist_HTML= M.tmpl(commlist_HTML_hd,{});
		    for(var index in commlist)
		    	{
					commlist_HTML += M.tmpl(commlist_HTML_loop,{
										comment_uavatar: commlist[index].uavatar,
										comment_uname: commlist[index].comment_uname,
										comment_date: commlist[index].comment_date,
										comment_text: commlist[index].comment_text
									});
				}
			commlist_HTML += M.tmpl(commlist_HTML_ft,{
								imgid:obj.imgid,
								cur_uavatar:M.currentUser.uavatar
							});
		    M.pop.insertHtml(commlist_HTML);

		    $(".btn-submit").click(function(){
		    	var $textarea=$(this).parents(".mod-comment-report").find(".report-textarea");
		    	var comm_text=$textarea.val();
		    	var comm_imgid=obj.imgid;
		    	M.addFakeComment(comm_text,$textarea);
		    	M.uploadComment(comm_imgid,comm_text);
		    });
		});
	};
	//输入框和占位文字 label + input 结构  label标签带有 J-holder 类名即可
	M.initInput = function(){
		var inputText = $("label + input");
		inputText.each(function(){
			var $this = $(this),
				thisInputHolder = $this.prev();
			if(thisInputHolder.hasClass("J-holder")){
				$this.focus(function(){
					if($this.val() == ""){thisInputHolder.addClass("focus-holder");}

				});
				$this.keyup(function(){
					console.log($this.val());
					if($this.val() != ""){thisInputHolder.removeClass("focus-holder").hide();}
				});
				$this.blur(function(){
					if($this.val() == ""){thisInputHolder.removeClass("focus-holder").show();}
				});
			}
		})
	};

	//上传文件对象
	M.upLoadFile = function(){
		//私有属性和方法
		var btnUpload = $("#btnUpload"),
			btnUploadWrap = $("#btnUploadWrap"),
			formUpload = $("#formUpload"),
			userDescWrap = $("#userDescWrap"),
			imgTextInput = $("#imgText");
		function fileTypeJudge(){
			var allowType = ["jpg","jpeg","bmp","gif","png"],
				filePath = btnUpload.val(),
				fileType = filePath.substring(filePath.lastIndexOf(".")+1).toLowerCase(),
				inArr = function(needle, haystack){
					var type = typeof needle;
					if(type == "string" || type =="number"){
						for(var i in haystack){
							if(haystack[i] == needle){
								return true;
							}
						}
					}
					return false;
				}
				return inArr(fileType,allowType);
		}
		function hasFileChange(){
			var judgeRes = fileTypeJudge();
			if(judgeRes){
				btnUploadWrap.addClass("hide");
				userDescWrap.show();
			}else{
				var warningTips = M.tmpl(warning_tips,{
					iconclass:"icon_warning",
					tips:"骚年~ 只支持jpg、jpeg、bmp、gif、png的文件上传噢~ "});
				M.pop.insertHtml(warningTips);
				var popClose = $(".pop-close,.btn-sure");
				M.pop.tipsInit(popClose);
				formReset();
			}
		}
		function formReset(){
			btnUpload.val("");
			imgTextInput.val("");
			imgTextInput.prev(".J-holder").show();
			btnUploadWrap.removeClass("hide");
			userDescWrap.hide();
		}
		return {
			callback:function(o){
				//成功上传之后的返回值
				var uploadFlag = o['error'];
				if(!uploadFlag){
					var imgId = o.imgid,
						imgName = o.imgname,
						imgText = o.imgtext,
							//添加用户信息
						uName = M.currentUser.uname,
						uUrl = M.currentUser.uurl,
						uId = M.currentUser.uid,
						uAvatar = M.currentUser.uavatar,
						$newItem = $(M.tmpl(newItemHtml, {
										imgid: imgId,
										imgname: imgName,
										imglike: '223',
										uid:  uId,
										uname:  uName,
										uurl:  uUrl,
										uavatar:  uAvatar,
										imgtext:  imgText,
										imgdate:  '刚刚'
									})).css({opacity:0});
						//图片加载完后插入
						$newItem.imagesLoaded(function(){
							$('#mainList').prepend($newItem).masonry('reload');
							$newItem.animate({opacity:1});
						})
						//上传表单重置
					formReset();
				}else{
					var warningTips = M.tmpl(warning_tips,{
						iconclass:"icon_warning",
						tips:"orz~上传失败了，换个姿势再来一次吧~"});
					M.pop.insertHtml(warningTips);
					var popClose = $(".pop-close,.btn-sure");
					M.pop.tipsInit(popClose);
					formReset();
				}
			},
			//上传框里的值改变时执行
			fileChange: function(){
				btnUpload.change(hasFileChange);
			}
		}
	}();
	M.upLoadFile.fileChange();

	//js模板引擎方法
	M.tmpl = function tmpl(str, data){
		var cache = {},
	   		fn = !/\W/.test(str) ?
	    cache[str] = cache[str] ||
	      tmpl(document.getElementById(str).innerHTML) :
	    new Function("obj",
	      "var p=[],print=function(){p.push.apply(p,arguments);};" +
	      "with(obj){p.push('" +
	      str
	        .replace(/[\r\t\n]/g, " ")
	        .split("<%").join("\t")
	        .replace(/((^|%>)[^\t]*)'/g, "$1\r")
	        .replace(/\t=(.*?)%>/g, "',$1,'")
	        .split("\t").join("');")
	        .split("%>").join("p.push('")
	        .split("\r").join("\\'")
	    + "');}return p.join('');");
	  return data ? fn( data ) : fn;
	};
	//回到顶部
	M.goTop =function goTop(){
		var btnGoTop = $("#goTop"),
			sideScrollFun = function() {
				var st = $(document).scrollTop(); //开始向下滚动的时候出现，加上渐隐渐显效果
				(st > 100) ? btnGoTop.show() : btnGoTop.hide();
			} //绑定一下
			$(window).bind("scroll", sideScrollFun);
			btnGoTop.click(function() { //滚动的动画效果
				$("html, body").animate({
					scrollTop: 0
				},
				400);
				return false;
			})
	}
})(jQuery,Miaomi);

(function($,M){
	M.init();
    M.initMasonry();
    M.initIconLike();
    M.initIconShare();
//	M.initPopImg();
	M.initInput();
	M.goTop();
})(jQuery,Miaomi);
//登录测试
$("#head-login").click(function(){
Miaomi.pop.loginPanel(Miaomi.pop.loginTipsSuspend);
return false;
});

