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
	<link rel="stylesheet" href="../public/css/miaomi.css" />
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
				
				<div class="fn_uploadcat">
					<form action="uploadcat/do_upload" target="unvisibleiframe" method="post" accept-charset="utf-8" enctype="multipart/form-data">
						description<input type="text" name="imgtext">
						<a href="#" class="btn-upload txt-hidden">上传喵图<input type="file" name="userfile" class="file-upload" size="3"></a>
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