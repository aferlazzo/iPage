<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright © Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/
$_SESSION['LockKey'] = "RetrievePassword.php";
include("conn.php");
$WithinScript = "I know the arid";
$arid="1";
include("settings.php");
$user = $_GET["U"];
$result = mysql_query("SELECT * FROM admin where adminname='$user'", $link); 
$num_rows = mysql_num_rows($result); 	
mysql_data_seek($result, 0);
if($num_rows == 0)
{
print("There is no registered user named '$user'<br />");
print("Please go <a href='javascript:history.back()'>back</a> and try again.</p>");
}
else
{
$row = mysql_fetch_object($result);

$Mailstr="Your username and password for <i>Perfect Response</i> system is:<br /><br />
Username: $row->adminname<br>
Password: $row->adminpwd<br><br>
As always,<br><br>
Your <i>Perfect Response</i> Assistant<br><br>

";
$Display_Name="Password Retrieval";

$directory=dirname(__FILE__);
//print("in demo directory".stristr($directory, 'demo'));

if (stristr($directory, "demo")) 
{
	print (">");
	logMessage("resetar (".__LINE__.") **Not sending password from demo**");
}
else
	SwiftMailer($row->adminemail, "$row->adminname", "Your Retrieved Perfect Response Password",  "$Mailstr",  "$Mailstr", "", "1", "0", "0", 60);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<HTML>
<HEAD>
<TITLE>Perfect Response Password Retrieval</TITLE>
<meta name="robots" content="NoIndex, NoFollow">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="./css/PerfectResponse.css">
<link rel="stylesheet" type="text/css" href="./css/niftyCorners.css">
<script type="text/javascript" src="./js/PerfectResponse.js"></script>
<script type="text/javascript" src="./js/nifty.js"></script>
</HEAD>
<body>

<div id='Wrapper'><div id="content">
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
<center>
<TABLE style="width: 540; BORDER: 1; PADDING: 4px;">
	<tr> 
		<td align='left'> 
			<h3>Password sent!</h3>
		</td>
	</tr>
	<tr> 
		<td  align='left'>
			<h2>Your has been emailed to the your registered email address.</h2>
		</td>
	</tr>
	<tr> 
		<td>&nbsp;</td>
	</tr>
	<tr> 
		<td align="center">
			<p>
			<form action='login.php'>
			<input class='submit' type='submit' name='Login' value='Login'>
			</form>
			</p>
		</td>
	</tr>	
</table>
</center>
	<p style="text-align: center"><a href="manar.php" title="Work with another Campaign">
	Work with another Email Campaign</a>&nbsp;::&nbsp; 
	<a href="home.php" title="Perfect Response Home...">Return Home</a>&nbsp;::&nbsp; 
	<a href='<?php echo "$PHP_SELF?arid=$arid" ?>' onclick="return(LLogout());">Logout</a>
	</center></p>
</div></div>

</BODY>
</HTML>
<?php 
}
?>
