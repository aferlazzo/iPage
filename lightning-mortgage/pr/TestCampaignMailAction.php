<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright � Tony Ferlazzo 2004 
Version 1.0 Written by: Anthony Ferlazzo, anthony@prontocommercial.com

*/

$_SESSION['LockKey'] = "TestCampaignMailAction";
$user = $_COOKIE["UName"];
include("conn.php");
$WithinScript = "I know the arid";
include("settings.php");
// first get the SMTP settings from the admin table
$result = mysql_query("SELECT * FROM admin where adminname='admin'", $link);

if($result == false)
{							
	die(logMessage("ImportTestAction (".__LINE__.")  Session |".$_SESSION['LockKey']."| No admin row to fetch"));
}

$num_rows = mysql_num_rows($result); 	
if ($num_rows == 0)
{							
	//print("<p>mailout (".__LINE__.")  Session |". $_SESSION['LockKey']."| No admin row to found'</p>");	
	die(logMessage("ImportTestAction (".__LINE__.")  Session |".$_SESSION['LockKey']."| No admin row to found"));
}
//mysql_data_seek($result, 0);
$row = mysql_fetch_object($result);
$SMTPDebugging=$row->SMTPDebugging;
$SMTPTimeout=$row->SMTPTimeout;
//logMessage("us (".__LINE__.") SMTPDebugging |$SMTPDebugging| SMTPTimeout |$SMTPTimeout|");

include("removesettings.php");

$result = mysql_query("SELECT * FROM admin where adminname='admin'", $link);
if($result == false)
{							
	die(logMessage("ImportTestAction (".__LINE__.")  Session |".$_SESSION['LockKey']."| No admin row to fetch"));
}


$num_rows = mysql_num_rows($result); 	
mysql_data_seek($result, 0);
$row = mysql_fetch_object($result);
$SMTPDebugging=$row->SMTPDebugging;
$SMTPTimeout=$row->SMTPTimeout;


$MsgNo					= $_POST["MsgNo"];
$InstantFullName 		= $_POST["InstantTestFullName"];
$InstantEmailAddress 	= $_POST["InstantTestEmailAddress"];
$InstantUserDefined1	= $_POST["InstantTestUserDefined1"];
$InstantUserDefined2	= $_POST["InstantTestUserDefined2"];
$InstantUserDefined3	= $_POST["InstantTestUserDefined3"];
$InstantUserDefined4	= $_POST["InstantTestUserDefined4"];
$arid					= $_POST["arid"];
//die("InstantTestAction (".__LINE__.") name '$InstantFullName' email '$InstantEmailAddress' msgno '$MsgNo'");
function SendTestMessage($debugIt, $MsgNo, $Subject, $Body, $Signature, $FullName, $Email, $WrapOn, $MailFormat, $LengthOfWrap, $RemovalLinkHTML, $RemoveHTML, $RemovalLinkText, $RemoveText, $CampaignDescription, $SMTPDebugging, $SMTPTimeout)
{
	GLOBAL $UserDefined1,$UserDefined2,$UserDefined3, $UserDefined4;
	
	//print("<p>InstantTestAction line ".__LINE__." Body:<br />\n$Body</p>\n");
	if (eregi('[a-z]', $Body)==false) //if message text is empty
		$Body ="<message body is empty>";
	else
		$Body =$Body.$Signature;	
	//print("<p>InstantTestAction line ".__LINE__." Body:<br />\n$Body</p>\n");

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
		die (logMessage ("InstantTestAction (".__LINE__.") no remove link found"));
	
	//die (logMessage("InstantTestAction: \$RemoveText |$RemoveText|\n\$RemovalLinkText |$RemovalLinkText.$Email|\n\$PoweredbyText |$PoweredbyText|"));

	$BodyToSend=$FinalBody;

	$directory=dirname(__FILE__);

	//
	//	Is there a file attachment for this message?
	//
	
	$MessageAttachmentFound=0;
	
	if(is_dir("attachments/$arid/$mid"))
	{
		$d = dir("attachments/$arid/$mid");
		$icount = 1;	
		while (false !== ($entry = $d->read())) 
		{
			if (!(($entry == ".") || ($entry == "..")))
			{
				$attfile=$entry;
				$icount++;
				$MessageAttachmentFound=1;
				break;
			}
		}
	
		$d->close();
	}
 

	$Attachment="";

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

	$Sent = SwiftMailer($Email, $FullName, $Subject, $TextBody, $HTMLBody, $Attachment, $MailFormat, $arid, $SMTPDebugging, $SMTPTimeout);
	/*
	if ($debugIt > 0)
	{
		if ($Sent == TRUE)
			logMessage ("InstantTestAction (".__LINE__.") Sending email format $Format To: |$FullName| &lt;$Email&gt; Subject: |$Subject|");
		else
			logMessage ("InstantTestAction (".__LINE__.") Error: Not Sent: email format $Format To: |$FullName| &lt;$Email&gt; Subject: |$Subject|");
	}
	*/
}



// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -	/
//																					/
//	InstantTestAction: Sends all messages as a test in a Mail Campaign.				/
//																					/
//																					/
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -	/
/*
	if($Mail_Format == 1)
	{
		$Mail_Header="Content-type: text/html; charset=iso-8859-1";
		$Mail_Footer=$Remove_HTML;
	}
	else
	{
		$Mail_Header="Content-Type: text/plain; charset=us-ascii";
		$Mail_Footer=$Remove_Text;
	}
*/
	$Mail_Error_Flag = 1;

	$result = mysql_query("SELECT * FROM autoresponders where arid=$arid") or die("InstantTestAction.php (".__LINE__.") cannot select arid |$arid|"); 
	$num_rows = mysql_num_rows($result);
	//mysql_data_seek($result, 0) or die(logMessage("InstantTestAction (".__LINE__.") Could not move pointer to autoresponder row"));
	$arrow = mysql_fetch_object($result) or die(logMessage("InstantTestAction (".__LINE__.") Could not read next autoresponder row"));
	$CampaignState = $arrow->CampaignState;

	$maxSQL = "select max(seqno) as maxseq from messages where arid=$arid";
	$result_max = mysql_query($maxSQL) or die("InstantTestAction (".__LINE__.") Error: $maxSQL");
	mysql_data_seek($result_max, 0);
	$maxrow = mysql_fetch_object($result_max);
	$NumberOfMessages=$maxrow->maxseq;
	if($NumberOfMessages < 1)
	$NumberOfMessages = 0;
	
	$Email_Address 			= $InstantEmailAddress;
	$MessageNumberInSequence= 0;
	$UserDefined1			= $InstantUserDefined1;
	$UserDefined2			= $InstantUserDefined2;
	$UserDefined3			= $InstantUserDefined3;
	$UserDefined4			= $InstantUserDefined4;		
	$FullName 				= $InstantFullName;

//	Read the actual messages we're planning to send
	
	if ($MsgNo != "")  //blank is all messages, non-blank we must check
	{
		if (stristr($MsgNo,"B") != false) // test send the broadcast msg
		{
			$msgSQL = "select * from messages where arid=$arid and seqno='-4'";
		}
		else
		if ($MsgNo== 0) // test send the welcome msg
		{
			$msgSQL = "select * from messages where arid=$arid and seqno='-2'";
		}
		else
		if ($MsgNo <= $NumberOfMessages) //test send an actual message number passed to me
		{
			$msgSQL = "select * from messages where arid=$arid and seqno='$MsgNo'";
			$NumberOfMessages = 0;
		}
		else
		{
			print("<p>Message $MsgNo not found. There are $NumberOfMessages messages in this campaign. See Hints for more info.</p>");
			die("<p>Click on <a href=\"javascript:window.back();\">Try Again</a>.</p>");
		}
	}
	else
		$msgSQL = "select * from messages where arid=$arid order by seqno";

	$result_msg = mysql_query($msgSQL) or die("InstantTestAction (".__LINE__.") Error: $msgSQL");
	//print("InstantTestAction (".__LINE__.") number of messages = $NumberOfMessages<br>\n");
	/*
	if ($debugIt > 0)
	{
		logMessage("InstantTestAction (".__LINE__.") arid $arid Campaign Name '$CampaignDescription' sending ".($NumberOfMessages +1)." messages to '$FullName' &lt;$Email_Address&gt;\n");
		print("One moment. Sending ".($NumberOfMessages +1)." messages to '$FullName' &lt;$Email_Address&gt;<br />\n");
	}
	*/
	
// 	Get the *signature* message db record 
	
	$msgSQL = "select * from messages where (arid=$arid) and (seqno=0)";
	$result_msg = mysql_query($msgSQL) or die("InstantTestAction (".__LINE__.") Error: $msgSQL");
	mysql_data_seek($result_msg, 0);  // signature message
	$row_msg = mysql_fetch_object($result_msg);
	
	$Signature = $row_msg->body;
	//print("<pre>");
	
if ($MsgNo != "") //if just a single test message will be sent
{
	if ($MsgNo == "0")
		$MsgNo = "-2";
	if (stristr($MsgNo, "B") != false)
		$MsgNo = "-4";
	$msgSQL = "select * from messages where arid=$arid and seqno='$MsgNo'";
	$result_msg = mysql_query($msgSQL) or die("InstantTestAction (".__LINE__.") Error: $msgSQL");
	mysql_data_seek($result_msg, 0);
	$row_msg = mysql_fetch_object($result_msg);
		
	if ($Mail_Format == 1)
		$MessageBody .="$row_msg->body";
	else
		$MessageBody .="$row_msg->body";				

	$mid = $row_msg->mid;			
	SendTestMessage($debugIt, $MsgNo, $row_msg->subject, $MessageBody, $Signature, $FullName, $Email_Address, $Wrap_On, $Mail_Format, $Length_Of_Wrap,$Removal_Link_HTML, $Remove_HTML,$Removal_Link_Text, $Remove_Text, $CampaignDescription, $SMTPDebugging, $SMTPTimeout);
}
else
{
	for ($i = -4; $i <= ($NumberOfMessages); $i++)
	{
		$msgSQL = "select * from messages where arid=$arid and seqno=$i";
		$result_msg = mysql_query($msgSQL) or die("InstantTestAction (".__LINE__.") Error: $msgSQL");
		mysql_data_seek($result_msg, 0);
		$row_msg = mysql_fetch_object($result_msg);
		$m = $i;
		
//	Every campaign will have the following common messages:
//	squno	subject
//	-------	---------
//	  -4		Broadcast Message
//	  -3		Subscription Confirmation Message, in a 2-step opt-in
//	  -2		Welcome Message
//	  -1		Unsubscribe Acknowledgement Message
//	   0		Campaign Signature
		//print("'$msgSQL' Row |$m| subject |$row_msg->subject|<br>");
			
		if (($row_msg != false)) 
		{
			switch ($m)
			{
				case -4:
					$MessageBody 	= "Opt-in Broadcast Message:";
					break;

				case -3:
					$MessageBody 	= "Opt-in Confirmation Message:";
					break;

				case -2:
					$MessageBody 	= "Welcome Message:";
					break;

				case -1:
					$MessageBody 	= "Unsubscribe Acknowledgement Message:";
					break;

				case 0:
					$MessageBody 	= "Message Signature:";
					break;

				default:
					$DelayDays		= $row_msg->delay;
					$MessageBody 	= "Message ".$m." of $NumberOfMessages is sent after ".$DelayDays." days after last message:";
					break;
			}
			
			if ($Mail_Format == 1)
				$MessageBody .="<br>$row_msg->body";
			else
				$MessageBody .="\n$row_msg->body";				
			//print("InstantTestAction (".__LINE__.")$MessageBody");	
			$mid = $row_msg->mid;	

			SendTestMessage($debugIt, $m, $row_msg->subject, $MessageBody, $Signature, $FullName, $Email_Address, $Wrap_On, $Mail_Format, $Length_Of_Wrap,$Removal_Link_HTML, $Remove_HTML,$Removal_Link_Text, $Remove_Text, $CampaignDescription, $SMTPDebugging, $SMTPTimeout);
			
					
			//print("<p>InstantTestAction (".__LINE__.") seq |$m| subject |$row_msg->subject| MessageBody |$MessageBody| FullName |$FullName| Email |$Email_Address| wrap_on |$Wrap_On| Mail_Format |$Mail_Format| Length_Of_Wrap |$Length_Of_Wrap| Remove_HTML |$Remove_HTML| Removal_Link_Text |$Removal_Link_Text| RemoveText |$Remove_Text| CampaignDescription |$CampaignDescription|</p>\n");
		} // end if	

		ob_flush();
		flush();  // needed ob_flush

	} 	// end for each message
}
	//print("</pre>\n");
/*
print("<script type='text/javascript'>\n");
print("	location.href='CampaignManager.php?arid=$arid';\n");
print("</script>\n");
*/
?>
