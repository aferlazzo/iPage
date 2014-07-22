<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright © Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/

include("check1.php");
Include("conn.php");
include("removesettings.php");  //get the 'click to remove' text line at bottom of message
$_SESSION['LockKey'] = "BroadcastAllAction.php";
$arid		= $_POST["arid"];
$CampaignDescription = $_POST["CampaignDescription"];
$Subject	= $_POST["txtMessage_Subject"];
$Body		= $_POST["txtMessage_Text"];
//print("<p>BroadcastAllAction line ".__LINE__." Subject: $Subject Body:<br />\n$Body</p>\n");

$WithinScript = "I know the arid";
include("settings.php");
// don't leave the 'BroadcastAll.php' page in the fram frame...
print("<script type='text/javascript'>top.frames['Main'].location.href='CampaignManager.php?arid=$arid';</script>");

print("<style type='text/css'>");	
print("h1, h2, p {color:#039;font-family:verdana;white-space:nowrap;}");
print("p {font-size:10pt;}");
print("</style>\n");


// first get the SMTP settings from the admin table
$result = mysql_query("SELECT * FROM admin where adminname='admin'", $link);
if($result == false)
{							
	die(logMessage("us.php(".__LINE__.")  Session |".$_SESSION['LockKey']."| No admin row to fetch"));
}

$num_rows = mysql_num_rows($result); 	
if ($num_rows == 0)
{							
	die(logMessage("us.php(".__LINE__.")  Session |".$_SESSION['LockKey']."| No admin row to found"));
}
//mysql_data_seek($result, 0);
$row = mysql_fetch_object($result);
$SMTPDebugging=$row->SMTPDebugging;
$SMTPTimeout=$row->SMTPTimeout;

function SendTestMessage($debugIt, $MsgNo, $Subject, $Body, $Signature, $FullName, $Email, $WrapOn, $MailFormat, 
$LengthOfWrap, $RemovalLinkHTML, $RemoveHTML, $RemovalLinkText, $RemoveText, $CampaignDescription, $SMTPDebugging, $SMTPTimeout)
{
	GLOBAL $UserDefined1,$UserDefined2,$UserDefined3, $UserDefined4;
	
	if (eregi('[a-z]', $Body)==false) //if message text is empty
		die("BroadcastAllAction (".__LINE__.") message body is empty");

	$Body =$Body.$Signature;	
	//print("<p>BroadcastAllAction line ".__LINE__." Body:<br />\n$Body</p>\n");

	// Replace message personalization (EmailAddress & FullName)

	$Body 	= eregi_replace("%EmailAddress%",$Email,$Body);
	$Subject = eregi_replace("%EmailAddress%",$Email,$Subject);

	$Body 	= eregi_replace("%FullName%",$FullName,$Body);
	$Subject = eregi_replace("%FullName%",$FullName,$Subject);

	$Body 	= eregi_replace("%UserDefined1%",$UserDefined1,$Body);
	$Subject = eregi_replace("%UserDefined1%",$UserDefined1,$Subject);

	$Body 	= eregi_replace("%UserDefined2%",$UserDefined2,$Body);
	$Subject = eregi_replace("%UserDefined2%",$UserDefined2,$Subject);

	$Body 	= eregi_replace("%UserDefined3%",$UserDefined3,$Body);
	$Subject = eregi_replace("%UserDefined3%",$UserDefined3,$Subject);

	$Body 	= eregi_replace("%UserDefined4%",$UserDefined4,$Body);
	$Subject = eregi_replace("%UserDefined4%",$UserDefined4,$Subject);

	// Perform message word wrap on text messages
	
	if (($WrapOn == 1) && ($MailFormat == 0)) 
		$Body = wordwrap($Body, $LengthOfWrap,"\n");

	// clean up any message 'artifacts' that may exist so message will display properly on the screen

	$Body	= eregi_replace("\r\n","\n",$Body);
	$Body 	= stripslashes($Body);
	$Subject = stripslashes($Subject);

	//Append the removal instructions and the removal instructions lines to *every* message body
	if($MailFormat == 1)
		$FinalBody = "$Body<br>$RemovalLinkHTML$Email'>$RemoveHTML</a><br>\n";
	else
		$FinalBody = $Body."\n\n".$RemoveText." ".$RemovalLinkText.$Email;

	if (!isset($RemovalLinkText))
		die ("BroadcastAllAction (".__LINE__.") no remove link found");
	
	//die (logMessage("BroadcastAllAction: \$RemoveText |$RemoveText|\n\$RemovalLinkText |$RemovalLinkText.$Email|\n\$PoweredbyText |$PoweredbyText|"));

	$BodyToSend=$FinalBody;

	$Attachment="";
	//print(__LINE__."Sending... Subject |$Subject| Body<br />\n|$Body|<br />\n");

	if ($MailFormat == 1)
	{
		$HTMLBody=$BodyToSend;
		$Format = "HTML";
	}
	else
	{	
		$TextBody=$BodyToSend;
		$Format = "Text";
	}
	
	set_time_limit(0);

	$Sent = phpmailer($Email, $FullName, $Subject, $TextBody, $HTMLBody, $Attachment, $MailFormat, $arid, $SMTPDebugging, $SMTPTimeout);
	/*
	if ($debugIt > 0)
	{
		if ($Sent == TRUE)
			logMessage ("BroadcastAllAction (".__LINE__.") Sending email format $Format To: |$FullName| &lt;$Email&gt; Subject: |$Subject|");
		else
			logMessage ("BroadcastAllAction (".__LINE__.") Error: Not Sent: email format $Format To: |$FullName| &lt;$Email&gt; Subject: |$Subject|");
	}
	*/
}
//---------------------------------------

	
	//logMessage("BroadcastAllAction (".__LINE__.") arid $arid Subject: |$Subject|");
	$SplitBody = split("\n", $Body); //split the text area elements (delimited by \n) and put into a table

	$LineCount = 0;
	$Body = "";
	reset ($SplitBody);

	while (list(, $tempLine) = each ($SplitBody))  
	{
		$LineCount++;
		trim($tempLine);
		//print("Line $LineCount: $tempLine<br />");
		$Body .= $tempLine."\n";
	}
	//print("\n----msg end------<br/<br />\n");

	$strSQL = "SELECT * FROM `users` WHERE (arid=$arid) and (currentmsg < 253) order by fname"; //active users

	$Query_Result = mysql_query($strSQL,$link);
	$NumberOfSubscribers = mysql_num_rows($Query_Result);
	
	//print ("Line ".__LINE__." |$NumberOfSubscribers|");
		
	if ($NumberOfSubscribers < 1)
	{
		print("<script language='javascript' type='text/javascript'>alert ('There are *No Active* subscribers to arid $arid - \"$CampaignDescription\"');window.history.back();</script>\n");
		die();
	}

	//print("\n<script language='javascript' type='text/javascript'>\nif (!confirm('Do you want to send this to all |$NumberOfSubscribers| subscribers of \"$CampaignDescription?\"'))\nwindow.history.back();</script>\n");
	
	//print(__LINE__."Sending... Subject |$Subject| Body<br />\n|$Body|<br />\n");
	
$Signature="";
$WrapOn = 0;
$MailFormat = 0;
$LengthOfWrap = 0;
$RemovalLinkHTML = "";
$RemoveHTML = "";
$RemoveText="To unsubscribe:";
print("<p>");
	for ($i = 0; $i < $NumberOfSubscribers; $i++)
	{
		mysql_data_seek($Query_Result, $i);
		$row = mysql_fetch_object($Query_Result);
		$MessageNumber = $row->currentmsg;
		$FullName = $row->fname;
		$Email = $row->email;
		print("Sent to Subscriber ".($i + 1).": $row->fname &lt;$Email&gt;<br />\n");
		SendTestMessage($debugIt, $MsgNo, $Subject, $Body, $Signature, $FullName, $Email, $WrapOn, $MailFormat, $LengthOfWrap, 
		$Removal_Link_HTML, $RemoveHTML, $Removal_Link_Text, $RemoveText, $CampaignDescription, $SMTPDebugging, $SMTPTimeout);
		flush();
		ob_flush();		
	}
		
print("</p><h2>Broadcast sent to all current subscribers</h2>");
?>
</body>
</html>

