<?php if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Request Sent</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta name="copyright" content="Copyright 2006, Anthony Ferlazzo, Pronto Commercial Funding">
<meta name="rating" content="General">
<meta name="robots" content="Index, ALL, follow">
<META NAME="OWNER" CONTENT=" Pronto Commercial Funding">
<LINK REL="SHORTCUT ICON" HREF="http://www.prontocommercial.com/favicon.ico"> 
	<?php
	if (file_exists("./css/ProntoStylesCompressed.css"))
		print("<link rel='stylesheet' href='./css/ProntoStylesCompressed.css' type='text/css'>\n");
	else
		print("<link rel='stylesheet' href='./css/ProntoStyles.css' type='text/css'>\n");
?>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
<?php
	if (file_exists("./js/ProntoCommonCompressed.js"))
		print("<script src='./js/ProntoCommonCompressed.js' type='text/javascript'>\n");
	else
		print("<script src='./js/ProntoCommon.js' type='text/javascript'>\n");
?>
</script>
</head>
<body>
<!--ih:includeHTML file="include/top.php"--><!--/ih:includeHTML-->
	<h1>Thank You</h1>
	<p>Your request has been sent. You will be contacted by email or phone to move forward with your request.</p>
<?php include("./include/bottom.php"); ?>
</body>
</html>
