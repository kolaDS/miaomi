var newItemHtml = [
	'<div class="item" imgid="<%=imgid%>">',
		'<div class="item-inner">',
				'<i class="item-top"></i>',
				'<div class="item-main">',
					'<div class="item-pic">',
						'<img src="public/uploads/<%=imgname%>.jpg" class="J-miaoPic" imgid="<%=imgid%>" uid="<%=uid%>" uname="<%=uname%>" uurl="<%=uurl%>" uavatar="<%=uavatar%>" imgtext="<%=imgtext%>" imgdate="<%=imgdate%>" />',
					'</div>',
					'<div class="item-info">',
						'<p class="item-describe-txt"><%=imgtext%></p>',
						'<p class="item-info-num"><span class="num-like"><span class="num-like-detail" imgid="<%=imgid%>"><%=imglike%></span>喜欢</span><span class="num-share">2分享</span></p>',
					'</div>',
				'</div>',
				'<i class="item-hr"></i>',
				'<div class="item-describe">',
					'<a target="_blank" class="avatar-wrap" href="http://weibo.com/<%=uurl%>"><img class="avatar" src="<%=uavatar%>"/></a>',
					'<p class="item-upload-info"><a href="#" class="nickname"><%=uname%></a><%=imgdate%> 上传</p>',
				'</div>',
			'<div class="item-op">',

				'<a href="javascript:void(0);" class="ui-icon icon-like"  imgid="<%=imgid%>"><i></i>喜欢</a>',
				'<span class="divide"></span>',
				'<a href="javascript:void(0);" class="ui-icon icon-com" title="评论"><i></i>评论</a>',
			'</div>',
		'</div>',
		'<div class="item-sd"></div>',
	'</div>'
].join('');

//评论头部
var commlist_HTML_hd = [
	'<div class="mod-comment">',
				'<div class="mod-comment-list">',
					'<ul class="list">'
].join('');

//评论列表
var commlist_HTML_loop = [
	'<li class="list-item">',
		'<div class="mod-avatar-txt">',
			'<a href="#" class="avatar-wrap"><img src="<%=comment_uavatar%>" alt="" class="avatar"></a>',
			'<div class="txt-wrap">',
					'<p class="nickname-wrap">',
						'<a href="#" class="nickname"><%=comment_uname%></a>',
						'<span class="date"><%=comment_date%></span>',
					'</p>',
					'<p><%=comment_text%></p>',
			'</div>',
		'</div>',
	'</li>'
].join('');

//评论底部
var commlist_HTML_ft = [
	'</ul></div>',
			   ' <div class="mod-comment-report" comment_imgid="<%=imgid%>">',
					'<div class="avatar-wrap">',
						'<img src="<%=cur_uavatar%>" alt="" class="avatar">',
					'</div>',
					'<div class="report-container">',
						'<div class="report-textarea-wrapper">',
							'<textarea id="" class="report-textarea"></textarea>',
						'</div>',
					'<div class="report-op-wrapper">',
						'<a href="#" class="btn-M btn-submit">提交</a>',
					'</div>',
				'</div>',
			    '</div>'
].join('');

//上传失败提示
var warning_tips = [
		'<div class="pop-tips">',
			'<div class="pop-tips-inner">',
				'<div class="pop-tips-hd"><i class="pop-close"></i></div>',
				'<div class="pop-tips-cont">',
					'<i class="ui-icon <%=iconclass%>"></i><div class="pop-tips-text single"><p><%=tips%></p></div>',
				'</div>',
				'<div class="pop-tips-ft">',
					'<a href="#" class="btn-M btn-sure"></a>',
				'</div>',
			'</div>',
		'</div>'
].join('');

//登录弹出层
var login_tips =[
			'<div id="sheetLogin" class="sheet-login">',
				'<div class="sheet-login-container">',
					'<div class="sheet-login-option">',
						'<p class="login-tips-txt"><%=logintips%></p>',
					'<div class="sheet-login-btns"><a href="oauth/weibo/login.php" class="btn-login btn-login-weibo" title="使用新浪微博账号登录">微博账号</a><a href="oauth/qq/login.php" class="btn-login btn-login-qzone" title="使用QQ账号登录">QQ账号</a></div>',
					'</div>',
					'<a href="#" id="btnLoginClose" class="sheet-close">关闭</a>',
				'</div>',
			'</div>'
].join('');