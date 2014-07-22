<?php
if(count($_POST) > 0)
{
	$sFile = $_POST['sFile'];
	if(trim($sFile) == "")		//	exit gracefully (and silently) file name is empty
		exit('1|0|0');

	$destinationPath = getcwd().DIRECTORY_SEPARATOR . "uploadedSprites" .DIRECTORY_SEPARATOR . $sFile;
	$size = @getimagesize($destinationPath);	// try obtaining the image size of supplied path

	//unlink($destinationPath);	// we do not need the sprite any longer so delete if from the server.

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