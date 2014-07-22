<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright � Tony Ferlazzo 2004 
Version 1.0 Written by: Anthony Ferlazzo, anthony@prontocommercial.com

*/

include("check1.php");
include("conn.php");
$arid	= $_POST["arid"];
$subject= $_POST["subject"];
$body	= $_POST["PerfectResponseMessage"];
$delay	= $_POST["delay"];
$NewAR	= $_POST["NewAR"];

//die ("\$arid: $arid<br>\$subject: $subject<br>\$body: $body<br>\$delay: $delay<br>\$NewAR: '$NewAR'<br>");
$WithinScript = "I know the arid";
include("settings.php");

set_time_limit(0);			// don't time-out
ignore_user_abort (TRUE);	//don't abort script even if the user disconnects. Just continue mail delivery.

$result = mysql_query("select max(seqno) maxseqno from messages where arid=$arid", $link);
mysql_data_seek($result, 0);
$row = mysql_fetch_object($result);
$NewSeqno = $row->maxseqno + 1;
//print ("NewSeqno: $NewSeqno<br>");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<HTML>
<HEAD>
<TITLE>Perfect Response Add Message Action</TITLE>
<meta name="robots" content="NoIndex, NoFollow">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="./css/PerfectResponse.css">
<link rel="stylesheet" type="text/css" href="./css/niftyCorners.css">
<script type="text/javascript" src="./js/PerfectResponse.js"></script>
<script type="text/javascript" src="./js/nifty.js"></script>
</HEAD>
<body>

<?php

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//
//																					//
// Update all users who have already sent the old last message in this sequence 	//
// and are waiting for this message to be created so it can be queued for sending.	//
//																					//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//

function UpdateUsers($arid,$seqno,$link, $DelayDays)
{
	GLOBAL $debugIt;
	
	{
		print("<h2>Updating Subscribers Who Have Reached<br/>The End of the Campaign</h2>\n");
		print("<div id='ProgressBarOutline'><div id='ProgressBar'></div></div>\n");
		print("<div id='Wrapper'><div id='content'>\n<p style='text-align:right;'>"); 
	
		for($ucount=0; $ucount < $UserCandidates; $ucount++)
		{
			mysql_data_seek($SelectedRows, $ucount);
			$rowuser = mysql_fetch_object($SelectedRows);
			$email = $rowuser->email;
			$LastSendDate = $rowuser->senddate;
			//print("<p>Selected $ucount: $rowusr->seqno LastSendDate $LastSendDate</p>");
			$mLast = date("m", $LastSendDate);
			$dLast = date("d", $LastSendDate);
			$yLast = date("y", $LastSendDate);
			$HLast = date("H", $LastSendDate);
			$iLast = date("i", $LastSendDate);
			//print("<p>Date: $mLast-$dLast-$yLast $HLast:$iLast</p>");

			$LastSendDate = mktime(9,0,0, $mLast, $dLast, $yLast); // send out message at 9 am in DelayDays days
			$L = date("m-d-y H:i:s", $LastSendDate);
			//print("<p>LastSendDate |$LastSendDate| L |$L|</p>");
			//logMessage("AddMessageAction (".__LINE__.") &lt;$email&gt; is on msg |$seqno| senddate: $L $LastSendDate");
			
			$NewSendDate = mktime(9,0,0, $mLast, ($dLast + $DelayDays), $yLast); // send out message at 9 am in DelayDays days
			$N = date("m-d-y H:i:s", $NewSendDate);
			//print("<p>NewSendDate |$NewSendDate| N |$N|</p>");

			$sqlUpdateQuery  = "update users set currentmsg=$seqno, senddate='$NewSendDate' ";
			$sqlUpdateQuery .= "where email='$email' and arid=$arid";

			//print("<br />AddMessageAction (".__LINE__.") &lt;$email&gt; seqno |$seqno| new senddate: $N ".($NewSendDate - $LastSendDate)." = $NewSendDate - $LastSendDate\n");
			print("&lt;$email&gt; seqno |$seqno| new senddate: $N<br />\n");
			logMessage("AddMessageAction (".__LINE__.") &lt;$email&gt; seqno '$seqno' to send $N");
			$Result = mysql_query($sqlUpdateQuery, $link);				
		
			if($Result == true)
			{
				if ($debugIt > 0)
					logMessage("AddMessageAction (".__LINE__.") updated user &lt;$email&gt; next msg |$seqno| senddate |$NewSendDate|");
			}
			else
				die(logMessage("AddMessageAction (".__LINE__.") ERROR: $sqlUpdateQuery: ".mysql_error()));

			print("<script type='text/javascript'>ProgressBar($ucount, $UserCandidates, 500);</script>\n");
			ob_flush();
			flush();  // needed ob_flush
		}
	}
}


//	Every campaign will have the following common messages:
//	seqno	subject
//	-------	---------
//	-4			Broadcast Message
//	-3			Subscription Confirmation Message, in a 2-step opt-in
//	-2			Welcome Message
//	-1			Unsubscribe Acknowledgement Message
//	 0			Campaign Signature
//
// When adding a new autoresponder, these empty messages will need to be created. 
// This is accomplished by having AddCampaign.php pass the $NewAR variable

if ($NewAR == true)
{
	$result = mysql_query("INSERT INTO messages (arid, subject, body, delay, seqno) VALUES ($arid, 'Immediate Broadcast Message', '', 0, -4)", $link) or die("AddMessageAction: error -4");
	$result = mysql_query("INSERT INTO messages (arid, subject, body, delay, seqno) VALUES ($arid, 'Subscription Confirmation Message', '', 0, -3)", $link) or die("AddMessageAction: error -3");
	$result = mysql_query("INSERT INTO messages (arid, subject, body, delay, seqno) VALUES ($arid, 'Welcome Message', '', 0, -2)", $link) or die("AddMessageAction: error -2");
	$result = mysql_query("INSERT INTO messages (arid, subject, body, delay, seqno) VALUES ($arid, 'Unsubscribe Acknowledgement Message', '', 0, -1)", $link) or die("AddMessageAction: error -1");
	$result = mysql_query("INSERT INTO messages (arid, subject, body, delay, seqno) VALUES ($arid, 'Campaign Signature', '', 0, 0)", $link) or die("AddMessageAction: error 0");
}
else
{
	$result = mysql_query("INSERT INTO messages (arid, subject, body, delay, seqno) VALUES ($arid, '$subject', '$body', $delay, $NewSeqno)", $link);

	$mid=mysql_insert_id();

	if (is_uploaded_file($ufile))
	{
		$tempUmask = umask();
		umask(0000);

		if (!file_exists("attachments/$arid"))
			@mkdir("attachments/$arid", 0777);
	
		if (!file_exists("attachments/$arid$mid"))
			@mkdir("attachments/$arid/$mid", 0777);
	
		$fname = $_FILES['ufile']['name'];
		$Destination = "attachments/$arid/$mid/$fname";
	
		move_uploaded_file($ufile, $Destination);
	}
	
	if (is_uploaded_file($uimage))
	{
		$uimage = $_FILES['uimage']['name'];
		$uimagetmp = $_FILES['uimage']['tmp_name'];
		//logMessage("editmsgaction (".__LINE__.") Attempting to upload image: $uimage");

		$Destination = "/home/lightnin/public_html/pr/uploadedimages/$uimage";
	
		$Result = move_uploaded_file($uimagetmp, $Destination);
		if($Result == false)
			logMessage("editmsgaction (".__LINE__.") Error uploading |$uimagetmp| to |$Destination|");
	}

	$SQL_Statement  = "SELECT * FROM users where currentmsg=$NewSeqno and arid=$arid order by fname";
	$SelectedRows = mysql_query($SQL_Statement) or die(logMessage("admsgaction (".__LINE__.") Could not obtain all the user rows: $SQL_Statement"));
	$UserCandidates = mysql_num_rows($SelectedRows);

	if($UserCandidates > 0)
		UpdateUsers($arid, $NewSeqno, $link, $delay);
	print("</div></div>\n");
}
mysql_close($link);
print("<script type='text/javascript'>\nparent.Monitor.document.open();\n</script>\n");
print("<script type='text/javascript'>\nparent.Monitor.document.close();\n</script>\n");
print("<script type='text/javascript'>\nparent.Main.location.href='ManageMessages.php?arid=$arid';\n</script>\n");
?>


