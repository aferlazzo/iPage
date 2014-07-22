<?php
include("check1.php");
$user = ucwords(strtolower($_COOKIE["UName"]));
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<html>
<head>
<!--
Perfect Response - Email Marketing at Its Best!
Copyright � Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com
-->
<title>Perfect Response Home</TITLE>
<LINK REL="SHORTCUT ICON" HREF="http://lightning-mortgage.com/favicon.ico">
<meta name="robots" content="NoIndex, NoFollow">
<link rel="stylesheet" type="text/css" href="./css/PerfectResponse.css">
<link rel="stylesheet" type="text/css" href="./css/niftyCorners.css">
<script type="text/javascript" src="./js/PerfectResponse.js"></script>
<script type="text/javascript" src="./js/nifty.js"></script>
</head>
<body>
<div id="Wrapper"><div id="content">
<div class="BoxHeading">
<input type="button" id="submit" name="submit" value="Click for helpful hints!" class="Button" onclick="Show();" onmouseover="document.getElementById('submit').style.fontWeight='bold';" onmouseout="document.getElementById('submit').style.fontWeight='normal';">
</div>
<div id="navBeta">
	<h2>What It All Means</h2>
	<p>The primary task for this system is to manage email campaigns. You can create, change, and delete campaigns, 
	campaign messages, and subscribers.</p>
<?php

if(strcasecmp($user,"admin")==0)
{
?>
	<p>In addition, you can do 5 other tasks from this point:</p><ul><li>
	<p>You can view the activity log to see what <i>Perfect Response</i> has been up to while you've been doing other
	things.</p>
	</li><li><p>You can view a list of all <i>Perfect Response</i> subscribers in all of your campaigns.</p>

	</li><li><p>You can edit <i>Perfect Response's</i> configuration, where you specify the name and location of theMySQL
	database, turn SMTP debugging on and  off, set the SMTP timeout, and the activity logging level.</p>
	</li><li><p>A much quicker way to toggle SMTP debugging is by clicking the button within the Log File viewing frame at the bottom 
	of the web page.</p>
	</li><li><p>You can adjust the size of each of the 3 web page frames by dragging the frame borders.</p>
	</li><li><p>Even when turned on, SMTP logging takes place only if you mailout from this web page. Mailout is also initiated by
	the act of having someone visit the lighttning-mortgage.com web page. The SMTP dialog of those messages will not be logged.</p> 
	</li><li><p>You can backup and the current log file if you find yourself wading through too much data or the file grows
	bigger than 2M bytes.</p>
	
	</li><li><p>You can manage user passwords.</p></li></ul>
<?php 
}
else
{
?>
	<p>In addition, you can do 3 other tasks from this point:</p><ul><li>
	<p>You can view the activity log to see what <i>Perfect Response</i> has been up to while you've been doing other
	things.</p>
	</li><li><p>You can view a list of all <i>Perfect Response</i> subscribers in all of your campaigns.
	To view subscribers in a particular campaign, use the choice found on the management page of that campaign.</p>
	</li><li><p>You can change your password.</p></li></ul>

<?php 
}
?>
</div>
<div class="title" style='display:none;'> 
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
print("<h1>Welcome ".$Full_Name = $user."</h1>");
?>
<ul style="line-height:180%;text-align:left;"><li><p><a href="ManageCampaigns.php">Manage Email Campaigns</a> - Both messages and subscribers</p></li>
<?php	
	print("<li><p><a href='DisplayLog.php?f=activity' target='LogFile'>View Activity Log</a>\n");

	if (file_exists("Logs/PerfectResponseLog.txt") == false)
	{
		$Handle=fopen("Logs/PerfectResponseLog.txt","w+");
		fclose($Handle);
	}
	
	$Size = filesize("Logs/PerfectResponseLog.txt");
	print("- Size: \n");
			
	if ($Size > 1024000)
	{
		$Size = round($Size/1024000, 2);
		print($Size."M bytes\n");
	}
	else
	{
		if ($Size > 0)
		{
			$Size = round($Size/1024, 0);
			print($Size."K bytes\n");
		}
		else
		{
			print("empty\n");
		}
	}
	print(" (drag up the frame border below)</p></li>\n");
	if(strcasecmp($user,"admin")==0)
	  print("<li><p><a href='ConfigurationManager.php'>Edit <i>Perfect Response</i> Configuration</a></p></li>\n");
	  
	print("<li><p><a href='DisplayAllSchedule.php' target='Monitor'>View Schedule</a> - of All Campaigns</p></li>\n");
	print("<li><p><a href='DisplayAllSubscribers.php' target='Monitor'>View Subscribers</a> - in All Campaigns</p></li>\n");
	print("<li><p><a href='FindSubscribers.php' target='Main'>Find Subscribers</a> - Search All Campaigns For Matches</p></li>\n");

	if(strcasecmp($user,"admin")==0)
	{
	  print("<li><p><a href='BackupActivityLog.php'>Backup and reset Activity Log</a></p></li>\n");
	  print("<li><p><a href='Admin.php'>Admin</a> - Add Users and Change Their Passwords or Email Addresses</p></li>\n");
	}
	else
	  print("<li><p><a href='Admin.php'>Admin</a> - Change your <i>Perfect Response</i> Password or Email Address</p></li>\n");
	  
	print("</ul>\n");
	xxxReferenceLinks();
?>
</div></div>
<script type="text/javascript">
// don't leave the 'Monitor' frame on the screen blank...
top.frames['Monitor'].location.href='home2.php';
</script>
</BODY>
</HTML>
