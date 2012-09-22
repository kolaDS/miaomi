<ul>
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
</ol>