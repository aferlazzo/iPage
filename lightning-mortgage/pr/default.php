<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright � Tony Ferlazzo 2004
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/
if (!($_COOKIE["UName"]==""))
{
	//die("UName: |$_COOKIE[\"UName\"]|");
	header("Location: manar.php");
	exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<HTML>
<HEAD>
<TITLE>Perfect Response</TITLE>
<meta name="robots" content="NoIndex, NoFollow">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="./css/PerfectResponse.css">
<script language="JavaScript1.2">
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
<table style='padding:8px;text-align:center;'>
	<TR>
		<TD>
			<p align="justify"><i>Perfect Response</i> is an advanced Email Marketing System. Any series of messages, lessons, or reports
			can make up an email campaign. Those messages can be sent out to people who sign up to receive them. </p>

			<br /><p align="justify">Unlike sending a newsletter to a list of subscribers, which all subscribers
			receive at the same time, this system is an autoresponder. It automatically responds to subscription
			requests given to it from your web page. Alternatively, you can manually import one or more subscribers
			from an existing list of names and email adresses.</p>

			<br /><p align="justify">As people sign up to receive your messages, lessons, or sales letters, they each
			start receiving	the predefined messages in sequence. There is virtually no limit to the number of
			different email campaigns or messages in a campaign that you may have.</p>

			<br /><p align="justify">You can develop one email campaign for
			prospective customers, another for past clients, and a third for referral sources. The variety of
			uses for this technology is limited only by your imagination. These message can be plain text or HTML
			formatted.</p>
		</td>
	</tr>
	<tr>
		<td align="center">
			<p>
			<form action='login.php'>
			<input class='submit' type='submit' name='Login' value='Login' onClick="this.value='One moment...'">
			</form>
			</p>
		</td>
	</tr>
</table>
	<br /><p style="text-align: center"><a href="manar.php" title="Work with another Campaign">
	Work with another Email Campaign</a>&nbsp;::&nbsp;
	<a href="home.php" title="Perfect Response Home...">Return Home</a>&nbsp;::&nbsp;
	<a href='<?php echo "$PHP_SELF?arid=$arid" ?>' onclick="return(LLogout());">Logout</a>
	</center></p>
</div>
<div id="navKappa">
	<p>
		<br><a href="DisplayLog.php?f=activity" target="_blank">Log File</a>
	</p>
</div>
</BODY>
</HTML>
