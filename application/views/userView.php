<!-- <ul>
	<li><?php echo($userinfo['id']);?></li>
	<li><?php echo($userinfo['uid']);?></li>
	<li><?php echo($userinfo['uname']);?></li>
	<li><?php echo($userinfo['uavatar']);?></li>
	<li><?php echo($userinfo['uurl']);?></li>
	<li><?php echo($userinfo['udescription']);?></li>
	<li><?php echo($userinfo['usex']);?></li>
	<li><?php echo($userinfo['ulocation']);?></li>
	<li><?php echo($userinfo['udate']);?></li>
</ul>

<ol>
<?php foreach ($uploadimglist as $item):?>
	<li>
		<ul>
			<li><?php echo($item['imgid']);?></li>
			<li><?php echo($item['imgname']);?></li>
			<li><?php echo($item['imguid']);?></li>
			<li><?php echo($item['imgcatid']);?></li>
			<li><?php echo($item['imgtext']);?></li>
			<li><?php echo($item['imglike']);?></li>
			<li><?php echo($item['imgdate']);?></li>
		</ul>
	</li>
<?php endforeach;?>
</ol> -->
<div class="details-info">
	<div class="profile-sidebar">
		<div class="sidebar-inner">
			<i class="sidebar-top"></i>
			<div class="sidebar-main">
				<div class="user-avatar">
					<img src="<?php echo($userinfo['uavatar']);?>" alt="" class="avatar">

				</div>
			</div>
			<i class="sidebar-hr"></i>
			<div class="user-info">
				<h2 class="nick-name textoverflow"><?php echo($userinfo['uname']);?></h2>
				<p class="autograph"><?php echo($userinfo['udescription']);?></p>
			</div>

		</div>
		<i class="sidebar-sd"></i>

	</div>
	<div class="profile-main">
		<div class="tab-hd">
			<ul class="tab-group">
				<li class="tab-item current"><span>上传的</span><i class="arw"></i></li>
				<li class="tab-item"><span>喜欢的</span><i class="arw"></i></li>
				<li class="tab-item"><span>分享的</span><i class="arw"></i></li>
			</ul>
		</div>
		<div class="tab-bd">
			<div class="amount"><span class="amount-inner"><i class="ui-icon icon-list-tint"></i>共<em class="amount-mum">93</em>张</span></div>
			<ul class="img-list">
				<?php foreach ($uploadimglist as $item):?>
				<li class="img-list-item"><a href="#"><i></i><img src="/miaomi/public/uploads/<?php echo($item['imgname']);?>.jpg" alt=""></a></li>						
				<?php endforeach;?>
			</ul>
		</div>
	</div>
</div>		

