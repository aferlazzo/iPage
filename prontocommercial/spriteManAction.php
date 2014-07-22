<?php
if(count($_POST) > 0)
{
	$code				= $_POST['code'];
	$code2				= $_POST['code2'];

	$code = "<html><head><style type=\"text/css\">div#sprite{";
	$code2 = "</style></head><body><div id='sprite'></div></body></html>";
	$sHeight			= $_POST['sHeight'];
	$sWidth 			= $_POST['sWidth'];
	$sBackgroundColor 	= $_POST['sBackgroundColor'];
	$sFile				= $_POST['sFile'];
	$sX					= $_POST['sX'];
	$sY					= $_POST['sY'];

	$code .= "height:" . $sHeight . ";\n";
	$code .= "width:" . $sWidth . ";\n";
	$code .= "background:" . $sBackgroundColor . " ";
	$code .= "url('" . $sFile . "') " . $sX . " " . $sY . " ";
	$code .= "no-repeat;\n}\n";
	$code .= $code2;
	$code = stripslashes($code);
	echo "$code";
}
else
	echo 'nothing was received';
?>