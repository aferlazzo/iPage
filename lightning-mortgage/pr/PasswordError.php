<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright © Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/
$user=$_GET['U'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<HTML>
<HEAD>
<TITLE>Perfect Response Password Error</TITLE>
<meta name="robots" content="NoIndex, NoFollow">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="./css/PerfectResponse.css">
<link rel="stylesheet" type="text/css" href="./css/niftyCorners.css">
<script type="text/javascript" src="./js/PerfectResponse.js"></script>
<script type="text/javascript" src="./js/nifty.js"></script>
</HEAD>
<body>
<div id="Wrapper"><div id="content">
<div class="title"> 
<table>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td width="45%"><td>
		<td width="55%"><h2>&nbsp;</h2>
		</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
</table>
</div>
<?php
print("<h1>Login or Password Error for '$user'</h1>");
?>
<p>The username and/or password you have provided was incorrect.<br>
Please go <a href="javascript:window.history.go(-2);">back</a> and try again.</p>

<h2>Forgot your password?</h2>

<?php 
print("<p>Click here to <a href='RetrievePassword.php?U=$user'>Retrieve Your Password</a> and have it emailed to you.</p>")
?>
<p><form action='login.php'>
<input class='submit' type='submit' name='Login' value='Login'></form></p>
</div></div>

</BODY>
</HTML>
