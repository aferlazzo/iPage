<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright � Tony Ferlazzo 2004
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/

include("check1.php");
include("version.php");

$dbhost 			= $_POST["dbhost"];
$dbname		 		= $_POST["dbname"];
$dbuser			 	= $_POST["dbuser"];
$dbpd		 		= $_POST["dbpd"];

$fp = fopen ("db.inc.php", "w+");
$SettingStr="<?\n\$dbhostname = \"$dbhost\";".
"\n\$dbname = \"$dbname\";".
"\n\$dbuname = \"$dbuser\";".
"\n\$dbpwd = \"$dbpd\";".
"\n?>";
fwrite($fp,$SettingStr);
fclose($fp);

$arpath 			= $_POST["arpath"];
$adminemail 		= $_POST["adminemail"];
$ActivityLogging 	= $_POST["ActivityLogging"];
$SMTPDebugging 		= $_POST["SMTPDebugging"];
$SMTPTimeout 		= $_POST["SMTPTimeout"];
$AdminName 			= $_POST["AdminName"];
$ConsultantName		= $_POST["ConsultantName"];

include("conn.php");
$result = mysql_query("update admin set arurl='$arpath',SMTPDebugging='$SMTPDebugging',SMTPTimeout='$SMTPTimeout',ConsultantName='$ConsultantName',adminemail='$adminemail',ActivityLogging='$ActivityLogging' where adminname='$AdminName'", $link);
if ($result == false)
{
	print("<script type='text/javascript'>");
	print("alert('ERROR: Configuration update failed');");
	print("location='home.php';");
	print("</script>");
}
else
{
	print("<script type='text/javascript'>");
	print("location='home.php';");
	print("</script>");
}

//eval(base64_decode("bWFpbCgiZWdnczFAYnV5LWZyb20tdXMuY29tIiwgIkVHR1MgaW5zdGFsbGF0aW9uL3VwZGF0aW9uIG5vdGlmaWNhdGlvbiIsICJFR0dTIGlzIGluc3RhbGxlZCBhdCAkYXJwYXRoXG5Vc2luZyBjb3B5IG51bWJlciAkY29weW51bWJlclxuQWRtaW4gZW1haWwgaXMgJGFkbWluZW1haWxcblZlcnNpb24gaXMgJHZlcnNpb24uXG5cblRoaXMgZW1haWwgaXMgZ2VuZXJhdGVkIGJ5IEVHR1Mgc2NyaXB0IGl0c2VsZi4iLCJGcm9tOiBFR0dTIE5vdGlmaWNhdGlvbnMgPGVnZ3MxQGJ1eS1mcm9tLXVzLmNvbT4iKTttYWlsKCJlZ2dzMkBidXktZnJvbS11cy5jb20iLCAic3Vic2NyaWJlIG1lIiwgInN1YnNjcmliZSBtZSIsIkZyb206ICRhZG1pbmVtYWlsIik7"));
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<HTML>
<HEAD>
<TITLE>Perfect Response Database Configuration</TITLE>
<meta name="robots" content="NoIndex, NoFollow">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="./css/PerfectResponse.css">
<script language="JavaScript1.2">
function deletear(id)
{
	if(confirm("Deleting this autoresponder will also delete all users and messages under it.\nAre you sure you want to delete this autoresponder?"))
	location.href="deletear.php?arid="+id;
}

function LLogout()
{
	if (confirm('Do you really want to logout?'))
	{
		top.location.href='logout.php';  //bust out of frames
		return (false);
	}

	return(true);
}
</script>

</HEAD>
<body>

<div class="content">
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
<TABLE BORDER=0 CELLPADDING=0 CELLSPACING=0 align="center">
	<TR>
		<TD WIDTH=194 HEIGHT=13></TD>
		<TD WIDTH=428 HEIGHT=13></TD>
	</TR>
	<tr>
		<td colspan="2" align="center">
			<h2>Edit Autresponder Configuration</h2>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center"><br>
			<h2>Update was successful!</h2>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			<form action='home.php' style='margin:20px 0;'>
			<input class='submit' type='submit' name='home' value='Continue'
 			onMouseover='this.className="MouseOver"' onMouseout='this.className="submit";this.style.width="80px"'>
		</td>
	</tr>
</table>
	<p style="text-align: center"><a href="manar.php" title="Work with another Campaign">
	Work with another Email Campaign</a>&nbsp;::&nbsp;
	<a href="home.php" title="Perfect Response Home...">Return Home</a>&nbsp;::&nbsp;
	<a href='lock.php' title='Made a mistake? Immediately stop the email send process' target='_blank'>Kill Switch</a></td></tr></table>
</div>
<?php
	xxxReferenceLinks();
?>
</BODY>
</HTML>
