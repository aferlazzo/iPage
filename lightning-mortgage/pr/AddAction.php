<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright � Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/

// This script is the form action for import.php (imports users into an autoresponder)
$user = ucwords(strtolower($_COOKIE["UName"]));

$_SESSION['LockKey'] = "AddAction.php";

include("check1.php");
include("conn.php");
$arid				= $_POST["arid"];
$hdnActionText		= $_POST["hdnActionText"];
$Auto_Sender		= $_POST["Auto_Sender"];
$CurrentMessage		= $_POST["CurrentMessage"];
$Emails_For_Action	= $_POST["Emails_For_Action"];
$WithinScript = "I know the arid";
include("settings.php");
include("removesettings.php");

$query = "set session wait_timeout=600";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
if($result == false)
{							
	//print("<p>AddAction (".__LINE__.")  'set session wait_timeout=600' failed</p>");	
	die(logMessage("AddAction (".__LINE__.")  'set session wait_timeout=600' failed"));
}
	
	
// first get the SMTP settings from the admin table
$result = mysql_query("SELECT * FROM admin where adminname='admin'", $link);
if($result == false)
{							
	//print("<p>AddAction (".__LINE__.")  Session |". $_SESSION['LockKey']."| No admin row to fetch'</p>");	
	die(logMessage("AddAction (".__LINE__.")  Session |".$_SESSION['LockKey']."| No admin row to fetch"));
}

$num_rows = mysql_num_rows($result); 	
if ($num_rows == 0)
{							
	//print("<p>AddAction (".__LINE__.")  Session |". $_SESSION['LockKey']."| No admin row to found'</p>");	
	die(logMessage("AddAction&nbsp;&nbsp;(".__LINE__.")  Session |".$_SESSION['LockKey']."| No admin row to found"));
}
//mysql_data_seek($result, 0);
$row = mysql_fetch_object($result);
$SMTPDebugging=$row->SMTPDebugging;
$SMTPTimeout=$row->SMTPTimeout;
//logMessage("AddAction (".__LINE__.") SMTPDebugging |$SMTPDebugging| SMTPTimeout |$SMTPTimeout|");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<HTML>
<HEAD>
<TITLE>Perfect Response Add Action</TITLE>
<meta name="robots" content="NoIndex, NoFollow">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="./css/PerfectResponse.css">
<link rel="stylesheet" type="text/css" href="./css/niftyCorners.css">
<script type="text/javascript" src="./js/PerfectResponse.js"></script>
<script type="text/javascript" src="./js/nifty.js"></script>
</HEAD>
<body>

<?php

//Get the Welcome message once

function FormatWelcomeMessage()
{
	GLOBAL $DelayToSend, $link, $arid, $Automatic_Subject_Text, $Automatic_Message_Text, $Mail_Format, $Mail_Header, $Mail_Footer;
	
  	// 	Get the *signature* message db record 
  		
  	$msgSQL = "select * from messages where (arid=$arid) and (seqno=0)";
  	$result_msg = mysql_query($msgSQL) or die(logMessage("AddAction (".__LINE__.") Error: $msgSQL"));
  	mysql_data_seek($result_msg, 0);  // signature message
  	$row_msg = mysql_fetch_object($result_msg);
  			
  	if ($row_msg->seqno != 0) 
  		die(logMessage("AddAction (".__LINE__.") sequence error"));
  			
  	$Signature = $row_msg->body;
  	
  	// now get the welcome email for the autoresponder
  	
  	$msgSQL = "select * from messages where (arid=$arid) and (seqno=-2)";
  	$result_msg = mysql_query($msgSQL, $link) or die("AddAction (".__LINE__.") Error: $msgSQL");
  	mysql_data_seek($result_msg, 0);  // confirmation email
  	$row_msg = mysql_fetch_object($result_msg);
  	
  	if ($row_msg->seqno != -2) 
  		die("AddAction (".__LINE__.") Error: sequence error");
  		
		
  	$Automatic_Subject_Text = $row_msg->subject;		
  	$Automatic_Message_Text = $row_msg->body.$Signature;  //add the signature to the message	
	//print("AddAction (".__LINE__.") |$arid| Welcome Message Subject |$Automatic_Subject_Text|<br />");
	
	
	// Now get the delay until msg 1 is sent
  	$msgSQL = "select * from messages where (arid=$arid) and (seqno=1)";
  	$result_msg = mysql_query($msgSQL, $link) or die("AddAction (".__LINE__.") Error: $msgSQL");
  	mysql_data_seek($result_msg, 0);  // confirmation email
  	$row_msg = mysql_fetch_object($result_msg);
  	
  	$DelayToSend = $row_msg->delay;	
}
//--------------------------------------------------------------
 
	set_time_limit(0);
	if (!$Emails_For_Action) //this comes from the textarea box of the form in Add.php
	{
		echo "<b>No subscribers added. The form was blank!<BR>Please go <a href ='void(history.back())'>back</a> and try again";

		exit;
	}
 
	if ($arid=="") 
	{
		echo "<b>Unable to find record for selected Autoresponder.<BR>Please go <a href ='void(history.back())'>back</a> and try again";
		exit;
	}
	
	$ar_result = mysql_query("SELECT * FROM autoresponders where arid=$arid", $link); 
	$num_rows = mysql_num_rows($ar_result);
	
	if ( $num_rows < 0 ) 
	{
		echo "<b>Unable to find record for selected Autoresponder.<BR>Please go <a href ='void(history.back())'>back</a> and try again";
		exit;
	}

	mysql_data_seek($ar_result, 0);
	$row = mysql_fetch_object($ar_result);	
	$SenderName 	= $row->arname;
	$SenderEmail 	= $row->arfromemail;
	$SMTPhost 		= $row->smtphostname;
	$SMTPport		= $row->smtpport;
	$SMTPuser		= $row->smtpuname;
	$SMTPpassword	= $row->smtppwd;
	$ReplytoEmail 	= $row->arreplytoemail;
	
	FormatWelcomeMessage();

	//die("AddAction (".__LINE__.") |$arid| Welcome Message Subject |$Automatic_Subject_Text|");


	//print ("<Font size='2' face='Verdana'>Importing<br>");
	$Emails_For_Action = trim($Emails_For_Action);
	
	$lstSplitTareaRemove = split("\n", $Emails_For_Action); //split the text area elements (delimited by \n) and put into a table
	$TotalSubscribers = count($lstSplitTareaRemove);
	
	if ($debugIt == 2)
		logMessage("AddAction (".__LINE__.") |$arid| There are $TotalSubscribers subscribers to add");

	$Count = 0;
	$Emails_For_Action_Count = 0;
	$Mail_Error_Flag = 0;
	$DuplicateEmail = 0;
	print("<div id='ProgressBarOutline'><div id='ProgressBar'></div></div>\n");
	print("<div id='Wrapper'><div id='content'>\n"); 

	reset ($lstSplitTareaRemove);
	while (list(, $temp) = each ($lstSplitTareaRemove))  
	{		
		trim($temp);

		
		if (!ereg("\|",$temp)) // if just an email address (no name) put 'Friend' in the FullName field
		{
			$FullName = "Friend";
			$Email_Address = $temp;
		} 
		else 
		{		// import the subscriber list in the format 'full name|email address|user defined1|user defined2|user defined3|unser defined4'
			list ($FullName, $Email_Address, $UserDefined1, $UserDefined2, $UserDefined3, $UserDefined4) = split("\|", $temp, 6); // if both name and email were passed
			$FullName = trim($FullName);
			$FullName = ucwords(strtolower($FullName));
			//if ($debugIt > 0)
			//{
			//	logMessage("  AddAction (".__LINE__.") importing '$FullName' '$Email_Address' '$UserDefined1' '$UserDefined2' '$UserDefined3' '$UserDefined4'");
			//}
		}
				
		$Email_Address = trim($Email_Address);
		$Email_Address = strtolower($Email_Address);		
		//print("Name: '$FullName' Email Address '$Email_Address' User Defined field1 $UserDefined1' User Defined field2 '$UserDefined2' User Defined field3 '$UserDefined3' User Defined field4 '$UserDefined4'<br>\n");
		//die("AddAction (".__LINE__.") importing |$FullName|$Email_Address<br>");
		
		print("<script type='text/javascript'>ProgressBar($Count, $TotalSubscribers, 500);</script>\n");
		$Count++;
		ob_flush();
		flush();  // needed ob_flush
		
		$SQL_Statement = "select count(uid) usrcount from users where arid=$arid";
		$Query_Result = mysql_query($SQL_Statement);
		mysql_data_seek($Query_Result, 0);
		$row = mysql_fetch_object($Query_Result);
		$usercount = $row->usrcount;
		
		// check for an existing record for the email address
		
		$SQL_Statement = "select * from users where email='$Email_Address' and arid=$arid";
		$Query_Result = mysql_query($SQL_Statement);
		
		
		$num_rows = mysql_num_rows($Query_Result);
		$row = mysql_fetch_object($Query_Result);
	
		if ( $num_rows > 0 ) //found an existing match ***************************
		{
			//mysql_data_seek($Query_Result, 0);
			//$row = mysql_fetch_object($Query_Result); 
			$Check_Email = $row->email;
			$UserDefined1=$row->UserDefined1;
			$UserDefined2=$row->UserDefined2;
			$UserDefined3=$row->UserDefined3;
			$UserDefined4=$row->UserDefined4;			
  			$DuplicateEmail++; 
		}
		else  // no match, so add to the database, send welcome msg
		{

			// now check to ensure the email address is constructed properly
		
			if (!ereg("^[a-z0-9\._-]+@+[a-z0-9\._-]+\.+[a-z]{2,3}$",$Email_Address)) 
			{ 
				$Email_Flag = 0;
				$Mail_Error_Flag++; 
			} 
			elseif (eregi("([^-\.\(\)a-z0-9[:space:]])", $FullName)) 
			{ 
				$Email_Flag = 0;
				$Mail_Error_Flag++; 
			} 
			elseif ($Check_Email == $Email_Address) //already in database
			{ 
				$Email_Flag = 0;
				$DuplicateEmail++; 
			} 
			else 
			{
				$Email_Flag = 1;
			}
			
			if ($Email_Flag == 1) // looks like a valid import, so add user to autoresponder db
			{
				if ($Auto_Sender == 1 ) //if the imported addresses are to receive 'welcome' email
				{
					$ThisMessageText 	= eregi_replace("%EmailAddress%",$Email_Address,$Automatic_Message_Text);
					$ThisSubjectText 	= eregi_replace("%EmailAddress%",$Email_Address,$Automatic_Subject_Text);
					$ThisMessageText 	= eregi_replace("%FullName%",$FullName,$ThisMessageText);
					$ThisSubjectText 	= eregi_replace("%FullName%",$FullName,$ThisSubjectText);
					$ThisMessageText	= eregi_replace("%UserDefined1%",$UserDefined1,$ThisMessageText);
					$ThisSubjectText 	= eregi_replace("%UserDefined1%",$UserDefined1,$ThisSubjectText);
					$ThisMessageText 	= eregi_replace("%UserDefined2%",$UserDefined2,$ThisMessageText);
					$ThisSubjectText 	= eregi_replace("%UserDefined2%",$UserDefined2,$ThisSubjectText);
					$ThisMessageText 	= eregi_replace("%UserDefined3%",$UserDefined3,$ThisMessageText);
					$ThisSubjectText 	= eregi_replace("%UserDefined3%",$UserDefined3,$ThisSubjectText);
					$ThisMessageText 	= eregi_replace("%UserDefined4%",$UserDefined4,$ThisMessageText);
					$ThisSubjectText 	= eregi_replace("%UserDefined4%",$UserDefined4,$ThisSubjectText);
					
					if (($Wrap_On == 1)  && ($Mail_Format == 0))
					{ 
						$ThisMessageText = wordwrap($ThisMessageText, $Length_Of_Wrap);
					}
					
					$ThisMessageText = eregi_replace("\r\n","\n",$ThisMessageText);
					$txtMessage_Send = $ThisMessageText;
					$txtMessage_Text = $txtMessage_Send;
					$txtMessage_Body = stripslashes($txtMessage_Text);
					$txtMessage_Subject = stripslashes($ThisSubjectText);


					//Append the removal instructions and the removal instructions lines to *every* message body

					if($Mail_Format == 1)
					{
						$Final_Body ="$txtMessage_Body<br><br>$Removal_Link_HTML$Email_Address'>$Remove_HTML";
					}
					else
					{
						$Final_Body=$txtMessage_Body."\n\n".$Remove_Text." ".$Removal_Link_Text.$Email_Address;
					}

					if (!isset($Removal_Link_Text))
						die (logMessage ("AddAction (".__LINE__.") no remove link found"));

					//die (logMessage("AddAction: \$Remove_Text |$Remove_Text|\n\$Removal_Link_Text |$Removal_Link_Text.$Email_Address|\n\$PoweredbyText |$PoweredbyText|"));

					$Body_To_Send=$Final_Body;
					
					$TextBody='';
					$HTMLBody='';

					$directory=dirname(__FILE__);
					//
					//	Is there a file attachment for this message?
					//

					$MessageAttachmentFound=0;

					//	If an attachment is found, then add it the the email message we are constructing

					if($MessageAttachmentFound==1)
					{
						$Attachment="attachments/$arid/$mid/$attfile";
					
						if ($Mail_Format == 1)
							$HTMLBody=$Final_Body;
						else
							$TextBody=$Final_Body;
						set_time_limit(0);					
						alert("AddAction (".__LINE__.")attachment");
						$Sent = SwiftMailer($Email_Address, $FullName, $txtMessage_Subject, $TextBody, $HTMLBody, $Attachment, $Mail_Format, $arid, $SMTPDebugging, $SMTPTimeout);
					}
					else
					{
						$Attachment="";
					
						if ($Mail_Format == 1)
							$HTMLBody=$Final_Body;
						else
							$TextBody=$Final_Body;
						
						set_time_limit(0);
					
						// send out the welcome message right now.
						
						if ($SMTPport == 465)
							$Encryption = 'ssl';
						else
							$Encryption = '';
						//$Sent = phpmailer($Email_Address, $FullName, $txtMessage_Subject, $TextBody, $HTMLBody, $Attachment, $Mail_Format, $arid, $SMTPDebugging, $SMTPTimeout);
						if ($debugIt == 2)
						{
							print("AddAction (".__LINE__.") Subject |$txtMessage_Subject| RecipientName |$FullName| RecipientEmail |$Email_Address| SenderName |$SenderName| SenderEmail |$SenderEmail| ReplytoName |$SenderName| ReplytoEmail |$ReplytoEmail|<br/>");
							logMessage ("AddAction (".__LINE__.") Subject |$txtMessage_Subject| RecipientName |$FullName| RecipientEmail |$Email_Address| SenderName |$SenderName| SenderEmail |$SenderEmail| ReplytoName |$SenderName| ReplytoEmail |$ReplytoEmail|");
						}
						
						$message = CreateMessage($debugIt, $txtMessage_Subject, $FullName, $Email_Address, $SenderName, $SenderEmail, $SenderName, $ReplytoEmail, $TextBody, $HTMLBody);

						if ($debugIt == 2)
						{
							print("AddAction (".__LINE__.") message |$message| Debug |$debugIt| SMTPhost |$SMTPhost| SMTPport |$SMTPport| Encryption |$Encryption| UserId |$SMTPuser| Password |$SMTPpassword| Referrer |AddAction.php|<br/>");
							logMessage ("AddAction (".__LINE__.") message |$message| Debug |$debugIt| SMTPhost |$SMTPhost| SMTPport |$SMTPport| Encryption |$Encryption| UserId |$SMTPuser| Password |$SMTPpassword| Referrer |AddAction.php|");
						}
						
						$Sent = SendMessage($message, $debugIt, $SMTPhost, $SMTPport, $Encryption, $SMTPuser, $SMTPpassword, "AddAction.php");
					}
					
					//die ("Sent to $Email_Address<br>");
					if ($debugIt > 0)
						if ($Sent == true)
							logMessage ("AddAction (".__LINE__.") sending 'welcome' email of mail campaign ".$arid." to ".$FullName."<".$Email_Address.">");
						else
							logMessage ("AddAction (".__LINE__.") Error: Not sent: 'welcome' email of mail campaign ".$arid." to ".$FullName."<".$Email_Address.">");
					
					if ($Sent != true) //delete the record from the database if the welcome message couldn't be sent
					{
						$SQL_Statement = "delete from users where email='$Email_Address' AND arid=$arid";
						mysql_query($SQL_Statement,$link) or die("AddAction (".__LINE__.") error on deleting '$Email_Address'");
						$Mail_Error_Flag++; //chauk up another error
						
						if ($debugIt > 0)
						{
							logMessage ("AddAction (".__LINE__.") ".$FullName."<".$Email_Address."> had problem sending. Deleted from database");
							//print ("$FullName <$Email_Address> had problem getting the message sent. Deleted address from database. Please re-import<br />\n");
						}
					}
					else
					{
						NotifyOfAdd("$FullName", "$Email_Address", $arid, "$CampaignDescription", $SMTPDebugging, $SMTPTimeout);							
						if ($debugIt > 0)
							logMessage ("AddAction (".__LINE__.") importing '$FullName' '$Email_Address' '$UserDefined1' '$UserDefined2' '$UserDefined3' '$UserDefined4' to autoresponder $arid");
					
						$Emails_For_Action_Count++;
				
						$Send_Time = mktime(1,0,0,date("m"),(date("d")+$DelayToSend),date("Y")); // record the date (1:00:00 am today) to send 1st message (welcome message sent immediately)

						// when we import a user, add him to the user table with the senddate as ('1:00:00 today') + the delay before sending msg 1 and the current msg as 1.
						
						$SQL_Statement = "INSERT INTO users (fname,lname,email,ip,method,senddate,confirmed,currentmsg,arid,UserDefined1,UserDefined2,UserDefined3,UserDefined4) 
						VALUES ('$FullName','','$Email_Address','Imported',1,'$Send_Time','Y',1,$arid,'$UserDefined1','$UserDefined2','$UserDefined3','$UserDefined4')";
	
						$Query_Result = mysql_query($SQL_Statement, $link);
			
						if (!$Query_Result)
						{
							die ("db insertion error: ".mysql_error($link));
						}
					}
				}//end of imported addesses are to receive the welcome message
			} // end adding a new record in db
		} //end if not duplicate
	}	//end of while
	
	print("<br><b>Add Subscribers: Results</b><br>\n");
	print("<b>$Emails_For_Action_Count</b> NEW subscribers were added.<BR>\n");
	print("<b>$DuplicateEmail</b> EXISTING subscribers were already in the campaign.<br>\n");
	print("<b>$Mail_Error_Flag</b> WERE NOT ADDED to the campaign.<br>\n");
	print("<br/><br/><br/>\n");
	mysql_close($link);
	print("<script type='text/javascript'>\nparent.Main.location.href='CampaignManager.php?arid=$arid&cmd=1';\n</script>\n");
	//print("<script type='text/javascript'>\nalert('parent.Main.location.href=\"CampaignManager.php?arid='+$arid+'&cmd=1\"');\n</script>\n");
?>
</body>
</html>
