#!home/prontoc2/public_html/php -q
<?php
//Start the session


if ($_SERVER['SERVER_NAME'] == "www.lightning-mortgage.com")
{
	session_save_path("/home/prontoc2/public_html/lightning-mortgage.com/pr/cgi-bin/tmp"); 
}
else
if ($_SERVER['SERVER_NAME'] == "www.prontocommercial.com")
{
	session_save_path("/home/prontoc2/public_html/pr/cgi-bin/tmp"); 
}
else
{
	logMessage ("mailout&nbsp;&nbsp;(".__LINE__.")  No match for Server Name ".$_SESSION['SERVER_NAME']);			
	die("mailout() No match for Server Name ".$_SERVER['SERVER_NAME']);
}








session_start();
date_default_timezone_set('America/Los_Angeles');
/*
Perfect Response - Email Marketing at Its Best!
Copyright © Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<HTML>
  <HEAD>
    <TITLE>
      mailoutcron - Perfect Response cron job
    </TITLE>
    <meta name="robots" content="NoIndex, NoFollow">
    <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
  </head>
  <body>
<?php
//die("<h1>mailoutcron.php</h1>");
	// . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .  //
	//																						//
	// Email campaigns that are monthly reminders are different than other campaigns.		//
	// Their campaign names (arname) begin with the literal "Monthly Schedule:"				//
	//																						//
	// All recipients (users) receive the same message on the same day of the month for 	//
	// which it was sent.																	//
	// For these campaigns, message 1 is sent in January, message 2 is sent in February,	//
	// ...message 12 is sent in December for every user in the campaign.					//
	// The day of month to send is stored in the $DelayDays field of the message for 		//
	// each month.																			//
	//																						//
	// . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .  //
	
include("conn.php");
$WithinScript = "I am embedded in another script";
include("settingscron.php");


/*
logMessage("Server: ". $_SERVER['SERVER_NAME']);

function logMessage($Message)
{
	$TimeStamp = date("D, d M Y H:i:s",time());
	die("<p>$TimeStamp: $Message</p>");
}
function logSMTPmessage($Message)
{
	$TimeStamp = date("D, d M Y H:i:s",time());
	print("<p>$TimeStamp SMTP: $Message</p>");
}
*/

//logMessage("mailoutcron&nbsp;&nbsp;(".__LINE__.") Test of logging");


/*
Preparing the lock
~~~~~~~~~~~~~~~~~~
Generate a random number or string to use as the LOCK_KEY. This must be retained by the script 
(php variable $_SESSION['LockKey']) and will be entered into the database shortly.
*/
$_SESSION['LockKey']=rand(1,1000000000);
// first get the SMTP settings from the admin table
$result = mysql_query("SELECT * FROM admin where adminname='admin'", $link);
if($result == false)
{							
	//print("<p>mailoutcroncron (".__LINE__.")  Session |". $_SESSION['LockKey']."| No admin row to fetch'</p>");	
	die(logMessage("mailoutcron&nbsp;&nbsp;(".__LINE__.")  Session |".$_SESSION['LockKey']."| No admin row to fetch"));
}
$num_rows = mysql_num_rows($result); 	
if ($num_rows == 0)
{							
	//print("<p>mailoutcron (".__LINE__.")  Session |". $_SESSION['LockKey']."| No admin row to found'</p>");	
	die(logMessage("mailoutcron&nbsp;&nbsp;(".__LINE__.")  Session |".$_SESSION['LockKey']."| No admin row to found"));
}
//mysql_data_seek($result, 0);
$row = mysql_fetch_object($result);
$SMTPDebugging=$row->SMTPDebugging;
$SMTPTimeout=$row->SMTPTimeout;
//logMessage("mailoutcron&nbsp;&nbsp;(".__LINE__.") SMTPDebugging |$SMTPDebugging| SMTPTimeout |$SMTPTimeout|");
//Housekeeping: delete messagesSent Rows created prior to today (this table is used by MonitorServer.php
$Yesterday = time() - (24 * 60 * 60); //get timestamp from 24 hours ago
	
$PriorSentDate=date("YmdHis0000", $Yesterday); //format to include YYYYmmddHHiissuuuu (milliseconds)
$DeleteQuery  = "delete from messagesSent where sentdate < $PriorSentDate";
//die("$DeleteQuery");
$Result = mysql_query($DeleteQuery, $link) or die(logMessage("mailoutcron&nbsp;&nbsp;(".__LINE__.") Could not delete old messagesSent rows using '$DeleteQuery' Error: |".mysql_error($link)."|"));
if($Result == false)
	logMessage ("mailoutcron&nbsp;&nbsp;(".__LINE__.") Could not delete old messagesSent rows using '$DeleteQuery'");
set_time_limit(0);			// don't time-out
ignore_user_abort (TRUE);	//don't abort script even if the user disconnects. Just continue mail delivery.
//	Don't send empty messages: If the message NO text has alphabetic characters AND we have reached the time to send 
//	skip the message, update user row to the next sequence number
//		
function SkipEmptyMsg ()
{
	GLOBAL $MessageNumberInSequence, $NextMsgTimeToSend, $Email_Address, $arid, $debugIt;
			
	if ($MessageNumberInSequence < 0)  //just in case campaign was restarted and message number is -2, the welcome message
		$MessageNumberInSequence = 0;			
	$MessageNumberInSequence++;
	$Update_Query  = "update users set currentmsg='$MessageNumberInSequence', senddate='$NextMsgTimeToSend' ";
	$Update_Query .= "where email='$Email_Address' and arid=$arid";
	mysql_query($Update_Query) or die(logMessage("mailoutcron&nbsp;&nbsp;(".__LINE__.") Could not update user to next msg sequence number"));
	logMessage ("mailoutcron&nbsp;&nbsp;(".__LINE__.") Not Sent. $Email_Address had blank message, '$MessageNumberInSequence'. ");
}
function GetUserRow($rowusr)
{
	GLOBAL $debugIt, $TimeToSendMsg, $ComputedLockTime, $IP_Address, $UserDefined1, $UserDefined2, $UserDefined3, $UserDefined4;
	GLOBAL $MessageNumberInSequence, $Full_Name, $Email_Address, $Now, $arid;
	
	// first extend the autoresponder lock time 
	$CampaignLockQuery  = "UPDATE autoresponders set LockExpiryTime = $ComputedLockTime, LockKey=" . $_SESSION['LockKey'];
	$CampaignLockQuery .= " WHERE arid=$arid limit 1";
	$Update_Result = mysql_query($CampaignLockQuery) or die(logMessage("mailoutcron&nbsp;&nbsp;(".__LINE__.") Could not update lock |$arid|"));
	$Future = substr($ComputedLockTime, 0, 2)." ".substr($ComputedLockTime, 2, 2).":".substr($ComputedLockTime, 4, 2).":".substr($ComputedLockTime, 6, 2);
	if ($debugIt > 999)							
		logMessage (sprintf("mailoutcron&nbsp;&nbsp;(".__LINE__.")  Session |".$_SESSION['LockKey']."| updated lock  |%03s| until |%s|", $arid, $Future));			
			
	$TimeToSendMsg 	= $rowusr[senddate];	
	$Email_Address 	= $rowusr[email];
	$IP_Address 	= $rowusr[ip];
	$UserDefined1	= $rowusr[UserDefined1];
	$UserDefined2	= $rowusr[UserDefined2];
	$UserDefined3	= $rowusr[UserDefined3];
	$UserDefined4	= $rowusr[UserDefined4];
	$MessageNumberInSequence	= $rowusr[currentmsg];
	$Full_Name = strtolower(trim($rowusr[fname]." ".$rowusr[lname]));
	$Full_Name = ucwords($Full_Name);
	if ($debugIt > 999)
		logMessage ("mailoutcron&nbsp;&nbsp;(".__LINE__.")  Session |". $_SESSION['LockKey']."| read |$Full_Name| &lt;$Email_Address&gt;");
}
function GetMessageToSendAndSignature()
{
	GLOBAL $debugIt, $Email_Address, $Signature, $MessageNumberInSequence, $MessageSubject, $MessageBody, $arid;
	
	// 	Get the *signature* message db row (mesaage seqno=0)
	$msgSQL = "select * from messages where (arid=$arid) and (seqno=0)";
	$result_msg = mysql_query($msgSQL) or die(logMessage("mailoutcron&nbsp;&nbsp;(".__LINE__.") Error: $msgSQL"));
	mysql_data_seek($result_msg, 0);  // signature message
	$row_msg = mysql_fetch_object($result_msg);
	if ($row_msg->seqno != 0) 
		die("sequence error on signature");
	$Signature = $row_msg->body;
	
	//	Read the actual message we're planning to send
	if ($MessageNumberInSequence == 0) //to resend the Welcome message, EditSubscriber.php could have set the msg number to 0
		$msgSQL = "select * from messages where arid=$arid and seqno=-2 order by seqno limit 0,1"; //actual welcome msg
	else  
		$msgSQL = "select * from messages where arid=$arid and seqno=$MessageNumberInSequence limit 0,1";
	 
	$result_msg = mysql_query($msgSQL) or die(logMessage("mailoutcron&nbsp;&nbsp;(".__LINE__.") Error: $msgSQL"));
	$num_rows_msg = mysql_num_rows($result_msg);
	if($num_rows_msg>0) // if there is a message, read the subject/body
	{
		mysql_data_seek($result_msg, 0);
		$row_msg = mysql_fetch_object($result_msg);
		$MessageSubject = $row_msg->subject;
		$MessageBody 	= $row_msg->body;
	}
	else
		die(logMessage("mailoutcron&nbsp;&nbsp;(".__LINE__.") Couldn't read messages for campaign $arid. Check to see if campaign should be suspended. Preparing to send next message to $Email_Address, SQL statement: $msgSQL"));
	//print("<p>mailoutcron (".__LINE__.") Session |". $_SESSION['LockKey']."| $Email_Address Subject |$MessageSubject|</p>");
}
function PrepareMessage()
{
	GLOBAL $debugIt, $TimeToSendMsg, $WallclockTime, $MessageBody, $MessageSubject, $Email_Address, $Full_Name;
	GLOBAL $UserDefined1, $UserDefined2, $UserDefined3, $UserDefined4, $Wrap_On, $Mail_Format, $Length_Of_Wrap;
	GLOBAL $Final_Body, $Removal_Link_HTML, $Remove_HTML, $Removal_Link_Text, $Remove_Text, $Body_To_Send;
	GLOBAL $MessageAttachmentFound, $Format, $Mail_Format, $HTMLBody, $Body_To_Send, $TextBody, $arid;
	include("removesettings.php");  //get the 'click to remove' text line at bottom of message
	   	 
	if ($debugIt > 999)
		logMessage ("mailoutcron&nbsp;&nbsp;(".__LINE__.") Preparing message to send");
	// Replace message personalization (EmailAddress & FullName)
	$MessageBody .= $Signature;
	$MessageBody 	= eregi_replace("%EmailAddress%",$Email_Address,$MessageBody);
	$MessageSubject = eregi_replace("%EmailAddress%",$Email_Address,$MessageSubject);
			
	$MessageBody 	= eregi_replace("%FullName%",$Full_Name,$MessageBody);
	$MessageSubject = eregi_replace("%FullName%",$Full_Name,$MessageSubject);
			
	$MessageBody 	= eregi_replace("%UserDefined1%",$UserDefined1,$MessageBody);
	$MessageSubject = eregi_replace("%UserDefined1%",$UserDefined1,$MessageSubject);
			
	$MessageBody 	= eregi_replace("%UserDefined2%",$UserDefined2,$MessageBody);
	$MessageSubject = eregi_replace("%UserDefined2%",$UserDefined2,$MessageSubject);
			
	$MessageBody 	= eregi_replace("%UserDefined3%",$UserDefined3,$MessageBody);
	$MessageSubject = eregi_replace("%UserDefined3%",$UserDefined3,$MessageSubject);
			
	$MessageBody 	= eregi_replace("%UserDefined4%",$UserDefined4,$MessageBody);
	$MessageSubject = eregi_replace("%UserDefined4%",$UserDefined4,$MessageSubject);
	
	// Perform message word wrap on text messages
			
	if (($Wrap_On == 1) && ($Mail_Format == 0)) 
		$MessageBody = wordwrap($MessageBody, $Length_Of_Wrap,"\n");
			
	// clean up any message 'artifacts' that may exist so message will display properly on the screen
			
	$MessageBody	= eregi_replace("\r\n","\n",$MessageBody);
	$MessageBody 	= stripslashes($MessageBody);
	$MessageSubject = stripslashes($MessageSubject);
	//Append the removal instructions and the removal instructions lines to *every* message body
	if($Mail_Format == 1)
	{
		$Final_Body = "$MessageBody<br>$Removal_Link_HTML$Email_Address'>$Remove_HTML</a><br>\n";
	}
	else
	{
		$Final_Body = $MessageBody."\n\n".$Remove_Text." ".$Removal_Link_Text.$Email_Address;
	}
	if (!isset($Removal_Link_Text))
		die (logMessage ("mailoutcron&nbsp;&nbsp;(".__LINE__.") no remove link found"));
	$Body_To_Send=$Final_Body;
	$MessageAttachmentFound=0;
	if ($Mail_Format == 1)
	{
		$Format = "HTML";
		$HTMLBody=$Body_To_Send;
		$TextBody="";
	}
	else
	{
		$Format = "Text";
		$TextBody=$Body_To_Send;
		$HTMLBody="";
	}	
}
function SendTheMessage($SMTPDebugging, $SMTPTimeout)
{   
	GLOBAL $Email_Address, $Full_Name, $MessageSubject, $TextBody, $HTMLBody, $Attachment, $Mail_Format, $arid, $debugIt;
	GLOBAL $Format, $Display_Name, $Format, $EmailAddressFrom, $SMTPmailServer, $SMTPmailbox, $SMTPpassword, $SMTPport;
	GLOBAL $Wrap_On, $Length_Of_Wrap; 
	if ($debugIt > 999)
		logMessage ("mailoutcron&nbsp;&nbsp;(".__LINE__.") Message body is constructed. Time to send.");
	
	//logMessage("mailoutcron&nbsp;&nbsp;(".__LINE__.") SMTPDebugging |$SMTPDebugging| SMTPTimeout |$SMTPTimeout|");
	$Sent = SwiftMailer($Email_Address, $Full_Name, $MessageSubject, $TextBody, $HTMLBody, $Attachment, $Mail_Format, $arid, $SMTPDebugging, $SMTPTimeout);
				
	if ($Sent == false) 
	{
		if ($debugIt > 0)
		{
			logMessage ("mailoutcron&nbsp;&nbsp;(".__LINE__.") autoresponder GLOBAL settings: \$arid $arid \$Display_Name $Display_Name \$EmailAddressFrom $EmailAddressFrom");
			logMessage ("mailoutcron&nbsp;&nbsp;(".__LINE__.") \$SMTPmailServer $SMTPmailServer \$SMTPmailbox $SMTPmailbox \$SMTPpassword $SMTPpassword \$SMTPport $SMTPport");
			logMessage ("mailoutcron&nbsp;&nbsp;(".__LINE__.") \$Wrap_On $Wrap_On \$Length_Of_Wrap $Length_Of_Wrap ");
			logMessage ("mailoutcron&nbsp;&nbsp;(".__LINE__.") Not sent. email format $Format To: $Full_Name '$Email_Address' Subject: $MessageSubject");
			//logMessage ("mailoutcron&nbsp;&nbsp;(".__LINE__.") Ending mailoutcron.php");
		}
		return (false);
	}
	return (true);
} // end 
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//
//																					//
//	This function should be called whenever a PHPmailer message gets sent, before	//
//	the subscriber's row is updated to reflect the next message number.				//
//	The messagesSent table is used by the MonitorServer.php script to determine 	//
//	whether a message was sent mailoutcron.php has a housekeeping routine in it to 		//
//	delete rows older than 24 hours.												//
//																					//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//
function RecordTheSendEvent($arid, $Email, $MessageNumberInSequence, $link)
{
	//can't do milliseconds, so use a 4-digit random number
	$x =rand(0, 9999);
	$u = sprintf("%04s", $x);
	$SentDate=date("YmdHmi").$u;
	$InsertQuery  = "insert into messagesSent(sentdate,email,arid,seqno) ";
	$InsertQuery .= "values('$SentDate','$Email','$arid','$MessageNumberInSequence');";
	$Result = mysql_query($InsertQuery, $link) or logMessage("mailoutcron&nbsp;&nbsp;(".__LINE__.") Could not insert messagesSent row using '$InsertQuery' Error: |".mysql_error($link)."|");
	if($Result == false)
		logMessage ("mailoutcron&nbsp;&nbsp;(".__LINE__.") Could not insert messagesSent row using '$InsertQuery'");
}
	/*
	Updating the row if sent
	~~~~~~~~~~~~~
	*/	
	
function UpdateUserRowAfterSend($uid)
{
	GLOBAL $debugIt, $ComputedLockTime, $Email_Address, $ExpiryTimeOnRow, $MessageNumberInSequence, $NextMsgTimeToSend, $arid, $link;  
	RecordTheSendEvent($arid, $Email_Address, $MessageNumberInSequence, $link);
	if ($MessageNumberInSequence < 0)  //just in case campaign was restarted and message number is -2, the welcome message
		$MessageNumberInSequence = 0;			
	$MessageNumberInSequence++;		// the next message in the sequence to send
	// now read the next message number in the sequence to determine how long to delay before sending it
	$msgSQL = "select * from messages where arid=$arid and seqno=$MessageNumberInSequence limit 1";
	$resultNext = mysql_query($msgSQL) or die(logMessage("mailoutcron&nbsp;&nbsp;(".__LINE__.") Error: $msgSQL"));
	$num_rows_msg = mysql_num_rows($resultNext);
	if($num_rows_msg>0) // if there is a 'next' message, read the delay for setting the time to send it
	{
		mysql_data_seek($resultNext, 0);
		$rowNext = mysql_fetch_object($resultNext);
		$DelayDays	= $rowNext->delay;
		//logMessage("mailoutcron&nbsp;&nbsp;(".__LINE__.") Next msg will be MsgNo $rowNext->seqno, with a delay of $rowNext->delay days before it will be sent");
		$NextMsgTimeToSend = mktime(9,0,0, date("m"), date("d")+$DelayDays, date("Y")); // send out message at 9 am in DelayDays days
	}
	else  //last message was reached so there is no 'Next' message to send, so the next time will be set to 0
	{
		$DelayDays = 0;	
		$NextMsgTimeToSend = mktime(9,0,0, date("m"), date("d"), date("Y")); // put today's date
	}
	//logMessage("mailoutcron&nbsp;&nbsp;(".__LINE__.") $Email_Address Next msg: $MessageNumberInSequence has a delay of $DelayDays days before it will be sent. TimeToSend will be ".date('m-d-y H:i:s', $NextMsgTimeToSend));
	if ($debugIt > 999)
		logMessage("mailoutcron&nbsp;&nbsp;(".__LINE__.") Session |".$_SESSION['LockKey']."| will now update &lt;$Email_Address&gt; next msg |$MessageNumberInSequence| senddate |$NextMsgTimeToSend|");
	//need to get the uid 
	$sqlUpdateQuery  = "update users set currentmsg='$MessageNumberInSequence', senddate='$NextMsgTimeToSend' ";
	$sqlUpdateQuery .= "where uid=$uid limit 1";
	$Result = mysql_query($sqlUpdateQuery);				
	
	if($Result == true)
	{
		if ($debugIt > 1)
			logMessage("mailoutcron&nbsp;&nbsp;(".__LINE__.")  Session |". $_SESSION['LockKey']."| updated user &lt;$Email_Address&gt; next msg |$MessageNumberInSequence| senddate |$NextMsgTimeToSend|. Autoresponder lock extended until |$ComputedLockTime|");
	}
	else
		die(logMessage("mailoutcron&nbsp;&nbsp;(".__LINE__.")  Session |". $_SESSION['LockKey']."| ERROR: updating user &lt;$Email_Address&gt; failed."));
}
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -	/
//																					/
//	SendQueuedMessages: Check all users in this campaign.							/
//	If it is time to send the next message, do so after cleaning up the message.	/
//																					/
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -	/
function SendQueuedMessages($aid, $EmailAddressFrom, $SMTPDebugging, $SMTPTimeout, $Remove_HTML, $Remove_Text, $debugIt, $MonthlySchedule)
{
	GLOBAL $Display_Name, $Installation_Path, $Wrap_On, $Ad, $Length_Of_Wrap, $Mail_Format, $link, $arid;
	GLOBAL $Administrator, 
	$Administrator_Password,
	$Installation_Path,
	$Now, 
	$Notification, 
	$EmailAddressFrom, 
	$CampaignDescription, 
	$Display_Name, 
	$EmailAddressReplyTo, 
	$EmailAddressReturn, 
	$Administrator_EmailAddress, 
	$Subscription_EmailAddress, 
	$SMTPmailServer, 
	$SMTPport,
	$SMTPmailbox, 
	$SMTPpassword, 
	$aa, 
	$POPMailServer, 
	$POPport, 
	$POPServerName, 
	$POPEmailPassword, 
	$Is_Custom, 
	$RedirectPage, 
	$Mail_Format, 
	$Wrap_On, 
	$Length_Of_Wrap, 
	$Remove_Tex, 
	$Remove_HTML, 
	$armode;
	GLOBAL $ComputedLockTime, $TimeToSendMsg, $ExpiryTimeOnRow, $IP_Address, $UserDefined1, $UserDefined2, $UserDefined3, $UserDefined4;
	GLOBAL $MessageNumberInSequence, $Full_Name, $Email_Address, $MessageBody, $WallclockTime;
	$arid=$aid;
	$user="arid ".$arid;
	
	if (!function_exists(logMessage))
	{
		include("conn.php");  	
	}
		
	$WithinScript = "I know the arid";
	include("GetARstuff.php");	
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
	$Mail_Error_Flag = 1;
	$WallclockTime = mktime(date("H")+2,date("i"),date("s"),date("m"),date("d"),date("Y"));
	
	$maxSQL = "select max(seqno) as maxseq from messages where arid=$arid";	// determine the last msg in campaign
	$result_max = mysql_query($maxSQL) or die("mailoutcron&nbsp;&nbsp;(".__LINE__.") Error: $maxSQL");
	mysql_data_seek($result_max, 0);
	$maxrow = mysql_fetch_object($result_max);
	$maxmsg=$maxrow->maxseq;
	
	if ($maxmsg<1)
		$maxmsg=0;
	//	Get all the rows that have a current message number less than the maximum messages 
	//	from the users database unless this is for a monthly campaign. 
	//  For monthly campaigns just use the month number as the message number.
	// select users in the mail campaign who have not yet received the last message and are are not locked
	$Now = date ("dHis"); //returns current time in ddhhmmss format. 
	$SQL_Statement  = "SELECT * FROM users where currentmsg<=$maxmsg and arid=$arid and confirmed='Y' and ";
	$SQL_Statement .= "senddate < $WallclockTime order by fname";
	$SelectedRows = mysql_query($SQL_Statement) or die(logMessage("mailoutcron&nbsp;&nbsp;(".__LINE__.") Could not obtain all the user rows for arid=".$arid));
	$UserCandidates = mysql_num_rows($SelectedRows);
	if($debugIt > 999)
		logMessage("mailoutcron&nbsp;&nbsp;(".__LINE__.") Query: $SQL_Statement<br />Found $UserCandidates candidates for sending");
	$NoMoreRows = false;	
	for($ucount=0;($ucount<$UserCandidates) && ($NoMoreRows == false);$ucount++)
	{
//print("<p>$ucount - 1 ");
		$Now = date ("dHis"); // returns current time in ddhhmmss string format.
		$ComputedLockTime = 1000 + $Now; //add 10 minutes returned as unsigned integer
		// Now select 1 user row	
		$SQL_Statement = "SELECT * FROM users where currentmsg<=$maxmsg and arid=$arid and confirmed='Y' and senddate < $WallclockTime order by fname limit 1";
		$SelectedRow = mysql_query($SQL_Statement)or die(logMessage("mailoutcron&nbsp;&nbsp;(".__LINE__.") Could not |$SQL_Statement|"));
		// Verify I still have the lock, too
		$arSQL = "select * from autoresponders where arid=$arid";
		$result_ar = mysql_query($arSQL) or die(logMessage("mailoutcron&nbsp;&nbsp;(".__LINE__.") Could not |$arSQL|"));
		$arrow=mysql_fetch_array($result_ar);
		if ($arrow[LockKey] != $_SESSION['LockKey'])
			$SelectedRow = false;
		if ($SelectedRow == false)
		{
			$NoMoreRows = true;
			logMessage ("mailoutcron&nbsp;&nbsp;(".__LINE__.")  Session |".$_SESSION['LockKey']."| lost lock to session|$arrow[LockKey]|");
		}
		else //found a row
		{
//print("2 ");
			$rowusr = mysql_fetch_assoc($SelectedRow);
			if ($rowusr == false)
			{							
				//print("<p>mailoutcron (".__LINE__.")  Session |". $_SESSION['LockKey']."| No user row to fetch'</p>");	
				logMessage ("mailoutcron&nbsp;&nbsp;(".__LINE__.")  Session |".$_SESSION['LockKey']."| No user row to fetch");
			}
			$Email_Address = $rowusr[email];
			$uid = $rowusr[uid];
			
			GetUserRow($rowusr);
		
			//die("mailoutcron (".__LINE__.") path for mailoutcron.stop: ".realpath('.'));
			//test to see if this script should be stopped by looking for a directory names mailoutcron.stop
			if(file_exists("mailoutcron.stop"))
			{
				logMessage ("mailoutcron&nbsp;&nbsp;(".__LINE__.") A directory named mailoutcron.stop exists. Script halted.");
				die;
			}
//print("3 ");
			/*
			We now have the lock for 5 minutes before it will be available to other users.
			Now process the user row...
			*/
			GetMessageToSendAndSignature();
			//print("<p>mailoutcron (".__LINE__.")  Session |". $_SESSION['LockKey']."| to send |$Email_Address| |$TimeToSendMsg| must be <= |$WallclockTime|</p>");
			if (!eregi("[a-z]", $MessageBody)) // if message is empty..
				SkipEmptyMsg();
			else	// if message was NOT empty...
			{
				PrepareMessage();
				$Sent	= false;				
				$Attachment="";
				$Now = date("dHis"); //returns current time in ddhhmmss format. 
				//logMessage("mailoutcron&nbsp;&nbsp;(".__LINE__.") SMTPDebugging |$SMTPDebugging| SMTPTimeout |$SMTPTimeout|");
				$Sent = SendTheMessage($SMTPDebugging, $SMTPTimeout);
										 			
				if ($Sent == TRUE)
					UpdateUserRowAfterSend($uid);
			}	//  end of 'if message was NOT empty...'
		} //end found a row
		flush();
		ob_flush();
	}	// end of 'for each user row'
//logMessage ("mailoutcron&nbsp;&nbsp;(".__LINE__.") Loop completed for the campaign |$arid|");
}//end funcation
// ------------------------------------------
$arSQL = "select * from autoresponders order by arid";
$result_ar = mysql_query($arSQL) or die(logMessage("mailoutcron&nbsp;&nbsp;(".__LINE__.") Could not |$arSQL|"));
$num_rows_ar = mysql_num_rows($result_ar) or die(logMessage("mailoutcron&nbsp;&nbsp;(".__LINE__.") Could not calculate number of rows"));
$lockcount=0;
//logMessage("mailoutcron&nbsp;&nbsp;(".__LINE__.") Test of logging");
for($count=0;$count<$num_rows_ar;$count++)
{
	mysql_data_seek($result_ar, $count) or die(logMessage("mailoutcron&nbsp;&nbsp;(".__LINE__.") Could not move pointer to next autoresponder row"));
	$arrow = mysql_fetch_object($result_ar) or die(logMessage("mailoutcron&nbsp;&nbsp;(".__LINE__.") Could not read next autoresponder row"));
	$arid = $arrow->arid;
	$Now = date ("dHis"); //returns current time in ddhhmmss format. 
	$ComputedLockTime = sprintf("%08s",(1000 + $Now)); //add 10 minutes returned as 8 digit string with leading zeros
	//if campaign's locktime is exceeded or this seesion has it locked
	if (($arrow->LockExpiryTime < $Now) || ($arrow->LockKey == $_SESSION['LockKey']))
	{
		//lock campaign
		$CampaignLockQuery  = "UPDATE autoresponders set LockExpiryTime = $ComputedLockTime, LockKey=" . $_SESSION['LockKey'];
		$CampaignLockQuery .= " WHERE arid=$arid limit 1";
		$Update_Result = mysql_query($CampaignLockQuery) or die(logMessage("mailoutcron&nbsp;&nbsp;(".__LINE__.") Could not lock |$arid|"));
		if (($debugIt > 0) && ($lockcount == 0))	
		{			
			$lockcount++;			
			$Future = substr($ComputedLockTime, 0, 2)." ".substr($ComputedLockTime, 2, 2).":".substr($ComputedLockTime, 4, 2).":".substr($ComputedLockTime, 6, 2);
			logMessage ("mailoutcron&nbsp;&nbsp;(".__LINE__.")  Session |".$_SESSION['LockKey']."| locking  email campaigns until |$Future|");			
			//logMessage (sprintf("mailoutcron&nbsp;&nbsp;(".__LINE__.")  Session |".$_SESSION['LockKey']."| locking  |%03s| until |$ComputedLockTime|", $arid));			
		}
		if ($arrow->CampaignState == "Active")
		{
			//logMessage("mailoutcron&nbsp;&nbsp;(".__LINE__.") SMTPDebugging |$SMTPDebugging| SMTPTimeout |$SMTPTimeout|");
			SendQueuedMessages($arrow->arid, $arrow->arfromemail, $SMTPDebugging, $SMTPTimeout, $arrow->remhtml, $arrow->remtext, $debugIt, $MonthlySchedule);
		}
	}
	else
		if (($debugIt > 0) && ($lockcount == 0))	
		{
			$lockcount++;			
			$Future = substr($arrow->LockExpiryTime, 0, 2)." ".substr($arrow->LockExpiryTime, 2, 2).":".substr($arrow->LockExpiryTime, 4, 2).":".substr($arrow->LockExpiryTime, 6, 2);
			logMessage ("mailoutcron&nbsp;&nbsp;(".__LINE__.")  Session |".$_SESSION['LockKey']."| email campaigns appear to be locked until |$Future|");			
			//logMessage (sprintf("mailoutcron&nbsp;&nbsp;(".__LINE__.")  Session |".$_SESSION['LockKey']."| appears locked |%03s| until |$arrow->LockExpiryTime|", $arid));			
		}
		
}
mysql_close($link);
  ?>
  </body>
</html>
