<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright © Tony Ferlazzo 2004
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/
?>
<?php
include("check1.php");
Include("conn.php");
$arid=$_GET["arid"];
$ID=$_GET["arid"];
$WithinScript = "I know the arid";
Include("settings.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<HTML>
<HEAD>
<TITLE>Perfect Response Spam Tracker</TITLE>
<meta name="robots" content="NoIndex, NoFollow">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="./css/PerfectResponse.css">
<script type="text/javascript">
<!--
function LLogout()
{
	if (confirm('Do you really want to logout?'))
	{
		top.location.href='logout.php';  //bust out of frames
		return (false);
	}

	return(true);
}
var Size=125;
function GrowIt()
{
Size=Size+10;
var I=Size+'%';
document.getElementById('Grow').style.fontSize=I;
if(Size>=200)
 clearInterval(timer);
}
function SSS()
{
//timer=setInterval('GrowIt()', 20);
}

function manar(id)
{
	location.href="EditCampaign.php?arid="+id;
}
//-->
</script>
</HEAD>
<body  onload="window.document.Spam.spamemail.focus();SSS();">

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
<TABLE CELLPADDING='4' align="center">
	<tr>
		<td colspan='2' align='center'>
			<h2>Spam Tracking for<br />
<?php print("<span id='Grow'><i>$CampaignDescription</i></span></h2>"); ?>
		</td>
	</TR>
		<form name="Spam" method="post" action="spamaction.php?arid=<?php echo $arid; ?>">
	<tr>
		<td>
				<h3 align='center'>Check Origin of an Email Address:<br>&nbsp;</h3>
		</td>
	</tr>
	<tr>
		<td align="center">
			<input type="text" name="spamemail" size="35"><br>&nbsp;
		</td>
	</tr>
	<tr>
		<td align="center">
			<br><input class='submit' type="submit" name="Submit" value="Track"
	 			onMouseover="this.className='MouseOver'" onMouseout="this.className='submit'">&nbsp;
			<input class='cancel' type='button' value='Cancel' onClick='window.location.href="CampaignManager.php?arid=<?php echo $arid ?>&cmd=1"'
 			onMouseover="this.className='MouseOver'" onMouseout="this.className='cancel'"><br />
		</td>
	</tr>
	</form>
</table>

<?php
	JumpToCampaign($link, $arid);
	print("</div>\n");
	ReferenceLinks($arid);
?>
<div id="navBeta">
	<h2>Usage</h2>
		<p> Sometimes email campaigns become filled with many fake email addresses or
		multiple subscriptions from	same person. They tend to bog down campaigns.
		With the Spam Tracking feature, you can root out fake or dead email addresses and
		by inspecting logged information.</p>
</div>
</BODY>
</HTML>
