<html>
<head>
	<meta charset="UTF-8" />
<title>Upload Form</title>
</head>
<body>

<?php echo $error;?>

<?php echo form_open_multipart('uploadcat/do_upload');?>
<li>catID<input type="text" name="imgcatid" /></li>
<li>description<input type="text" name="imgtext"></li>
<li>img<input type="file" name="userfile" size="20" /></li>
<br /><br />

<input type="submit" value="upload" />

</form>

</body>
</html>