<?php
if(count($_POST) > 0)
{
	$sFile = $_POST['sFile'];
	if(trim($sFile) == "")		//	exit gracefully (and silently) file name is empty
		exit('1|0|0');

	$size = @getimagesize($sFile);	// try obtaining the image size of supplied path
	if(($size == 0)	|| ($size == FALSE))
		exit('0');
	$iWidth = $size[0];
	$iHeight = $size[1];
	$code = "1|$iWidth|$iHeight";
	print("$code");
}
else
	print('1');
?>