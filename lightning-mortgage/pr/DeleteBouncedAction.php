<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright © Tony Ferlazzo 2004 
Version 1.0 Written by: Anthony Ferlazzo, anthony@prontocommercial.com

*/

/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -	*/
/*																				*/
/*	DeleteBounced: This script deletes subscribers from the database if error 	*/
/*  messages are bounced back.													*/
/*																				*/
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -	*/

if ($_POST["arid"] == "")
{
	$arid=176;
	$msgtext="garbage line\n   anthony@prontocommercial.com\nmore garbage fran@lala.com reb sara@bob.org hhhh\n";
}
else
{
	$arid=$_POST["arid"];
	$Body=$_POST["msgtext"];
}
//die("DeleteBouncedAction:|$arid|$msgtext|");

include("conn.php");			// connect to the Perfect Response db
$WithinScript = "I know the arid";
include("settings.php");
//print("Notification: $Notification<br>");	
/*
print("<script type='text/javascript'>\n");
print("alert('Start');\n");
print("</script>\n");
*/

// -----------------------------

// Examine the message messaage body to find  bad email address

// -----------------------------

function FindBadEmail($MsgBody, $arid)
{
	GLOBAL $Notification;
	
	$usLinePattern = "(^.*)(arid=".$arid.".RE=)";
	//print("$usLinePattern<br>");
	//$EmailPattern ="^([0-9a-z]+)([0-9a-z\.-_]+)@([-0-9a-z\._]+)\.([0-9a-z]+)(.*)";
	$EmailPattern ="^([0-9a-z]+)([0-9a-z\.-_]+)@([-0-9a-z\._]+)\.([0-9a-z]+)";

	$SplitTarea = split("[ \n]", $MsgBody); //split the text area elements (delimited by \n) and put into a table
	//print("$SplitTarea);
	$xxx = count($SplitTarea);
	//print("$xxx lines<br>");
	$AddrList= "";
	for($x = 0; $x < $xxx; $x++)
	{
		$LL = $SplitTarea[$x];
		$LL = eregi_replace($usLinePattern, "", $LL);
		$LL = eregi_replace("['\]", "", $LL); //remove any \ or ' characters
		$LL = trim($LL);

		if (eregi($EmailPattern, $LL)) //
		{
			//We're looking at a line that is something like this:
			//<markmorrison@consultant.com>: host
			$Addr = ereg_replace($EmailPattern, "\\1\\2@\\3.\\4", $LL);
			//print("<p>|$Addr|</p>");
			// don't try removing yourself
			if (stristr($Addr, $Notification) == false) // if not the administrator's email address, add to list
			{
				//print("$Notification is not in $Addr<br>");
				$AddrList = $Addr." ".$AddrList;  //lines in textareas are separated by a space character
			}
		}
	}
	return($AddrList);	
}

// - - - - - - - - - - - - - - - -

// Update the database:
// set the currentmsg of the subscriber in the user table to 253

// - - - - - - - - - - - - - - - -

function UpdateDB ($BadRecipient, $arid)
{
	GLOBAL $debugIt;
	
	$QuerySelectSql = "select count(uid) usrcount from users where email='$BadRecipient' and arid=$arid";
	$Query_Result = mysql_query($QuerySelectSql);
	mysql_data_seek($Query_Result, 0);
	$row = mysql_fetch_object($Query_Result);
	$usercount = $row->usrcount;
	print("<div style='margin-left:10px;width:500px;text-align:left;'>\n");
	if ($usercount == 0)
	{
		if ($debugIt > 0)
			logMessage("DeleteBouncedAction (".__LINE__.") '$BadRecipient' not found in arid");
		print("<p>&lt;$BadRecipient&gt; not found in campaign.</p></div>");
		return(false);
	}
	else
	{
		$QueryUpdateSql = "update users set currentmsg='253' where email='$BadRecipient' and arid=$arid";
	
		if (mysql_query($QueryUpdateSql) == true)
		{
			if ($debugIt > 0)
				logMessage("DeleteBouncedAction (".__LINE__.") Bad recipient $BadRecipient found. Updating currentmsg to 253");
			print("<p>&lt;$BadRecipient&gt; removed from this campaign.</p></div>");
			return(true);
		}
		else
		{
			if ($debugIt > 0)
				logMessage("DeleteBouncedAction (".__LINE__.") Could not update user record: '$QueryUpdateSql'");
			die("<p>Could not update subscriber: '$QueryUpdateSql'.</p></div>");
			return(false);
		}
	}
	flush();
	ob_flush();	
}

$emailList = FindBadEmail($msgtext,$arid);
/*
print("<script type='text/javascript'>\n");
print("alert('emailList: $emailList');\n");
print("</script>\n");	
*/


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<HTML>
<HEAD>
<TITLE>Delete Bounced Action</TITLE>
<meta name="robots" content="NoIndex, NoFollow">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="./css/PerfectResponse.css">
<link rel="stylesheet" type="text/css" href="./css/niftyCorners.css">
<style type="text/css">
h2 {width:500px;}
</style>
<script type="text/javascript" src="./js/PerfectResponse.js"></script>
<script type="text/javascript" src="./js/nifty.js"></script>
</head>
<body>
<div id='ProgressBarOutline'><div id='ProgressBar'></div></div>
<div id='Wrapper'><div id='content'> 
<?php

	$emailList = trim($emailList); 
	
	$SplitList = split("[\n| ]", $emailList);
	$SplitList = array_unique($SplitList);
	$TotalSubscribers = count($SplitList);
	
	reset ($SplitList);
	$Count=0;
	print("<h2>Deleting Bounced Subscribers From</h2><h2><i>$CampaignDescription</i></h2>\n");

	while (list(, $temp) = each ($SplitList))  
	{
		//print("<p>$temp will be deleted</p>");
		UpdateDB($temp, $arid);
		print("<script type='text/javascript'>ProgressBar(".$Count++.", $TotalSubscribers, 500);</script>\n");
		ob_flush();
		flush();  // needed ob_flush
	}	// end while not at end of list
?>
</div></div>
</body>
</html>
