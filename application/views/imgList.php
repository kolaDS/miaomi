<!-- 图片列表 -->	
<form name="" id="mainForm">
<div class="main-list" id="mainList">
	<?php foreach ($imglist as $item):?>
	<div class="item">
		<div class="item-inner">
			<div class="item-pic"><img src="../public/uploads/<?php echo($item['imgname']);?>.jpg" /></div>
			<div class="item-info">
				<p class="item-info-num"><span class="num-like"><?php echo($item['imglike']);?>喜欢</span><span class="num-share">2分享</span></p>
				<p class="item-info-date"><?php echo($item['imgdate']);?></p>
			</div>
			<div class="item-describe">
					<a target="_blank" class="avatar-wrap" href="http://weibo.com/<?php echo($item['uurl']);?>"><img class="avatar" src="<?php echo($item['uavatar']); ?>"/></a>
					<p class="item-describe-txt"><?php echo($item['imgtext']);?></p>
			</div>
			<div class="item-op">
				<a href="#" class="ui-icon icon-like"  imgid="<?php echo($item['imgid']);?>">喜欢</a>
				<a href="#" class="ui-icon icon-share">分享</a>
			</div>
		</div>

		<div class="item-sd"></div>
	</div>
	<?php endforeach;?>
</div>
</form>
<!-- 图片列表 -->	