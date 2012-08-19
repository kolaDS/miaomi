<!DOCTYPE HTML>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8" />
	<meta name="robots" content="all" />
	<meta name="author" content="" />
	<meta name="copyright" content="" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>miaomi</title>
	<link rel="stylesheet" href="public/css/miaomi.css" />
</head>
<body>
<div class="bg-wrapper">
<!--头部 Str-->
	<div class="header">
		<div class="header-inner">
			<div class="header-bar wrapper">
				<a href="#" class="logo"></a>
				<div class="tab-nav">
					<ul>
						<li class="on">
							<a href="#" class="tab-nav-a"><b>iphone壁纸</b></a>
						</li>
						<li>
							<a href="#" class="tab-nav-b"><b>喵友上传</b></a>
						</li>
					</ul>
				</div>
				<div class="head-user" id="head-user" uid="<?php echo $uid ?>" uname="<?php echo $uname?>" uurl="<?php echo $uurl?>" uavatar="<?php echo $uavatar ;?>"  style="height:50px;line-height:50px;position:absolute;right:160px;top:0;text-align:right;">
					<a  href="#" style="vertical-align:middle;"><img src="<?php echo $uavatar ;?>" style="display:inline-block;;width:20px;height:20px;"></a> <span><?php echo $uname; ?>！</span>
				</div>
				<a href="#" class="btn-upload txt-hidden">上传喵图<input type="file" class="file-upload" size="3"></a>
				<div class="pop_uploadcat" style="position:absolute;right:0;top:50px;background:#fff">
					<form action="uploadcat/do_upload" target="unvisibleiframe" method="post" accept-charset="utf-8" enctype="multipart/form-data">
						<li>description<input type="text" name="imgtext"></li>
						<li>img<input type="file" name="userfile" size="20"></li>						
						<input type="submit" value="upload">
					</form>		
					<iframe src="" name="unvisibleiframe" style="visibily:hidden;width:0;height:0;position:absolute;left:-999px;top:-999px"></iframe>
				</div>

			</div>
		</div>
	</div>
<!--头部 End-->
<!--主体 Str-->
	<div class="main wrapper">
		<div class="main-top">
			<p><i class="ui-icon icon-list"></i>共有<em class="pic-num txt-em">209</em>张iphone壁纸</p>
		</div>