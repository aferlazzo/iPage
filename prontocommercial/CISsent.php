<!DOCTYPE html>
<html>
<head>
<title>CIS Form Sent</title>
<meta charset=utf-8>
<meta name="copyright" content="Copyright 2006, Anthony Ferlazzo, Pronto Commercial Funding">
<meta name="rating" content="General">
<meta name="robots" content="Index, ALL">
<meta name="description"
content="Commercial Mortgage and Leasing.">
<meta name="keywords"
content="commercial mortgage, commercial leasing, equipment leasing, commercial loans">
<link rel="shortcut icon" href="favicon.ico">
<?php include("./include/head.php"); ?>
<style>
h1{display:block !important;}
#pause{display:none !important;}
#Smiley{
background:url('./images/Smiley.png') no-repeat;
width:250px;
height:251px;
position:absolute;
left:250px;
top:80px;
}
</style>
</head>
<body>
<?php include("include/top.php"); ?>
<h1>Thank You For Sending The CIS Form</h1>
<div id='Smiley'></div>
<?php include("./include/bottom.php"); ?>
<script>
	$(document).ready(function(){
		$('#Smiley').effect('bounce','normal');
	});
</script>
</body>
</html>
