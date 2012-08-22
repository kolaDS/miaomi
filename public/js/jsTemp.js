

var newItemHtml = [
	'<div class="item" imgid="<%=imgid%>">',
		'<div class="item-inner">',
			'<div class="item-pic" style="height:<%=imgviewheight%>">',
				'<img src="/miaomi/public/uploads/<%=imgname%>.jpg" class="J-miaoPic" imgid="<%=imgid%>" uid="<%=uid%>" uname="<%=uname%>" uurl="<%=uurl%>" uavatar="<%=uavatar%>" imgtext="<%=imgtext%>" imgdate="<%=imgdate%>" />',
			'</div>',
			'<div class="item-info">',
				'<p class="item-describe-txt"><%=imgtext%></p>',
				'<p class="item-info-num"><span class="num-like"><span class="num-like-detail" imgid="<%=imgid%>"><%=imglike%></span>喜欢</span><span class="num-share">2分享</span></p>',
			'</div>',
			'<div class="item-describe">',
				'<a target="_blank" class="avatar-wrap" href="http://weibo.com/<%=uurl%>"><img class="avatar" src="<%=uavatar%>"/></a>',
			'<p class="item-upload-info">上传于 <%=imgdate%></p>',
			'<p><%=imgid%></p>',
			'</div>',
			'<div class="item-op">',
				'<a href="javascript:void(0);" class="ui-icon icon-like"  imgid="<%=imgid%>">喜欢</a>',
				'<a href="javascript:void(0);" class="ui-icon icon-share">分享</a>',
			'</div>',
		'</div>',
		'<div class="item-sd"></div>',
	'</div>'
].join('');