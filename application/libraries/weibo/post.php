<?php
session_start();

include_once( 'config.php' );
include_once( 'saetv2.ex.class.php' );


// 声明Sae对象
$MIAO = new SaeTClientV2( WB_AKEY , WB_SKEY , Meters_ACCESS_TOKEN );

// 朋友的微博feed
$MIAO_HOME_FEED=$MIAO->friends_timeline();


$UID_GET=$MIAO->get_uid();
$UID=$UID_GET['uid'];
$USER=$MIAO->show_user_by_id($UID);

	
print_r($USER['screen_name']."<br />");


date_default_timezone_set('UTC');
$Time_H=intval(date("H"));
$Time_H>12?$Time_H-=12:$Time_H;
$i=0;
$MIAO_POST="";

for($i;$i<$Time_H;$i++)
{
	$MIAO_POST.="喵～";
}
$MIAO_POST.="【喵时间".$Time_H."点整】";
$MIAO_POST_RETURN=$MIAO->upload($MIAO_POST,"../image/640x960tcatty.png");
// $MIAO_POST_RETURN=$MIAO->update($MIAO_POST);

if ( isset($MIAO_POST_RETURN['error_code']) && $MIAO_POST_RETURN['error_code'] > 0 ) {
		echo "<p>发送失败，错误：{$MIAO_POST_RETURN['error_code']}:{$MIAO_POST_RETURN['error']}</p>";
	} else {
		echo "<p>发送成功</p>";
	}



?>
<html>
<body>
	<head>
		<title>喵时钟</title>
	</head>

</body>
</html>
