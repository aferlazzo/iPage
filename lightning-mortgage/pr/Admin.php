<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright © Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com



This script is used to add/change users.
*/

include("check1.php");
Include("conn.php");
$user = $_COOKIE["UName"];
$SQLselect="SELECT * FROM admin where adminname='$user'";

$result = mysql_query($SQLselect, $link) or die("Can't read admin name:<br />$SQLselect"); 
$num_rows = mysql_num_rows($result); 	
mysql_data_seek($result, 0);
$row = mysql_fetch_object($result);
$adminpwd 		= $row->adminpwd;
$arurl			= $row->arurl;
$perlpath 		= $row->perlpath;
$adminemail		= $row->adminemail;
$manarid		= $row->manarid;
$ActivityLogging= $row->ActivityLogging;
$Ad				= $row->Ad;
$user = ucwords(strtolower($_COOKIE["UName"]));


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<HTML>
<HEAD>
<TITLE>Admin - Perfect Response</TITLE>
<meta name="robots" content="NoIndex, NoFollow">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="./css/PerfectResponse.css">
<link rel="stylesheet" type="text/css" href="./css/niftyCorners.css">
<script type="text/javascript" src="./js/PerfectResponse.js"></script>
<script type="text/javascript" src="./js/nifty.js"></script>
<script type="text/javascript">
function Validate(UserN)
{

var UN=UserN.toLowerCase();
var UL=document.AdminAction.adminpwd.value.length;

//alert("User: "+UN+" password length: "+UL);

if ((UN != "admin") && (UL==0))
{
alert("Password cannot be blank");
return(false);
}

if(document.AdminAction.adminpwd.value!=document.AdminAction.cnfpwd.value)
{
alert("Passwords do not match");
return(false);
}
var EL=document.AdminAction.adminemail.value.length;
if ((UN != "admin") && (EL==0))
{
alert("Please enter you email address");
return(false);
}
return(true);
}
</script>
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
print("<form name='AdminAction' action='AdminAction.php' onsubmit='return(Validate(\"$user\"));' method='post'>");
/*
print("<input name='arurl' type='hidden' value='$arurl'>");
print("<input name='manarid' type='hidden' value='$manarid'>");
print("<input name='ActivityLogging' type='hidden' value='$ActivityLogging'>");
print("<input name='Ad' type='hidden' value='$Ad'>");
*/
?>
 
<TABLE CELLPADDING='4' CELLSPACING=0 align="center">
	<tr>
		<td colspan='2' align='center'>
<?php
if (strlen($adminpwd) == 0)
	print("<h2>Create User Password</h2>");
else
	if(strcasecmp($user,"admin")==0)
		print("<h2>Create and Modify User Accounts</h2>");
	else
		print("<h2>Modify Your Password or Email Address</h2>");
?>
		</TD>
	<tr> 
		<td colspan="2" align="center">&nbsp;</td>
	</tr>
	<tr> 
		<td width='50%' align='right'><label for='adminname'>Login Name:</td>
		<td width='50%' align='left'>
<?php
		if(strcasecmp($user,"admin")==0)
			print("<input name='adminname' type='text' id='adminname' size='20' value='admin'>");
		else
			print("<input name='adminname' type='text' id='adminname' readonly size='20' value='$user'>");
?>
		</td>
	</tr>
	<tr> 
		<td align="right"><label for="adminpwd">Password:</label></td>
		<td align="left">
	<?php
		print ("<input name='adminpwd' id='adminpwd' type='password' size='20' value='$adminpwd'>");
	?>
		</td>
	</tr>
	<tr> 
		<td align="right"><label for='cnfpwd'>Confirm Password:<br /><span style='font-size:x-small;'>(re-enter password)</span></label></td>
		<td align="left"> 
	<?php
		print ("<input name='cnfpwd' id='cnfpwd' type='password' size='20' value='$adminpwd'>");
	?>
		</td>
	</tr>
	<tr> 
		<td align="right"><label for='cnfpwd'>Email Address:<br /><span style='font-size:x-small;'>(used if you forget password)</span></label></td>
		<td align="left">
		<?php
		print("<input name='adminemail' type='text' id='adminemail' size='35' value='$adminemail'></td>");
		?>
	<tr> 
		<td colspan="2" align="center"></td>
	</tr>
	<tr> 
		<td colspan="2" align="center"> 
<?php
if (strlen($adminpwd) == 0)
{
	print("<input class='submit' type='submit' name='submit' value='Create' ");
	print ("onMouseover=\"this.className='MouseOver'\" onMouseout=\"this.className='submit'\">");
}
else
{
	print("<input class='submit' type='submit' name='submit' value='Update' ");
	print ("onMouseover=\"this.className='MouseOver'\" onMouseout=\"this.className='submit'\">");
}
?>
		
	&nbsp;<input class='cancel' name='Cancel' type='button' id='Cancel' value='Cancel' onClick='window.location.href="home.php"'
	onMouseover="this.className='MouseOver'" onMouseout="this.className='cancel'"><br />&nbsp;
		</td>
	</tr>
</TABLE>
</form>
</div>
</div>
</BODY>
</HTML>
