<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright © Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/
$user = $_COOKIE["UName"];
include("conn.php");
$WithinScript = "I know the arid";
include("settings.php");
include("removesettings.php");

//include("phpmailer_function.php");

$InstantFullName 		= $_GET["InstantTestFullName"];
$InstantEmailAddress 	= $_GET["InstantTestEmailAddress"];
$InstantUserDefined1	= $_GET["InstantTestUserDefined1"];
$InstantUserDefined2	= $_GET["InstantTestUserDefined2"];
$InstantUserDefined3	= $_GET["InstantTestUserDefined3"];
$InstantUserDefined4	= $_GET["InstantTestUserDefined4"];
$arid					= $_GET["arid"];

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -	/
//																					/
//	InstantTestAction: Sends all messages as a test in a Mail Campaign.				/
//																					/
//																					/
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -	/

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

	if ($debugIt==2)
		logMessage ("InstantTestAction ".__LINE__." Testing autoresponder $arid");
	
	$maxSQL = "select max(seqno) as maxseq from messages where arid=$arid";
	$result_max = mysql_query($maxSQL) or die("InstantTestAction (".__LINE__.") Error: $maxSQL");
	mysql_data_seek($result_max, 0);
	$maxrow = mysql_fetch_object($result_max);
	$maxmsg=$maxrow->maxseq;
	if($maxmsg<1)
	$maxmsg=0;
	
	$Email_Address 			= $InstantEmailAddress;
	$MessageNumberInSequence= 0;
	$UserDefined1			= $InstantUserDefined1;
	$UserDefined2			= $InstantUserDefined2;
	$UserDefined3			= $InstantUserDefined3;
	$UserDefined4			= $InstantUserDefined4;		
	$Full_Name 				= $InstantFullName;


//	Read the actual messages we're planning to send
	
	$msgSQL = "select * from messages where arid=$arid order by seqno";
	$result_msg = mysql_query($msgSQL) or die("InstantTestAction (".__LINE__.") Error: $msgSQL");
	$NumberOfMessages = $maxmsg + 4;
	//print("number of messages = $NumberOfMessages<br>");
	
	if ($debugIt > 0)
		logMessage("InstantTestAction (".__LINE__.") arid $arid Campaign Name '$Display_Name' test send to '$Full_Name' email '$Email_Address' $NumberOfMessages messages");

// 	Get the *signature* message db record 
	
	$msgSQL = "select * from messages where (arid=$arid) and (seqno=0)";
	$result_msg = mysql_query($msgSQL) or die("InstantTestAction (".__LINE__.") Error: $msgSQL");
	mysql_data_seek($result_msg, 0);  // signature message
	$row_msg = mysql_fetch_object($result_msg);
	
	if ($row_msg->seqno != 0) 
		die("sequence error");
		
	$Signature = $row_msg->body;
	$msgSQL = "select * from messages where arid=$arid order by seqno";
	$result_msg = mysql_query($msgSQL) or die("InstantTestAction (".__LINE__.") Error: $msgSQL");
	

		
	for ($i = 0; $i < ($NumberOfMessages); $i++)
	{
		mysql_data_seek($result_msg, $i);
		$row_msg = mysql_fetch_object($result_msg);
		
		//print("Row sequno $row_msg->seqno subject $row_msg->subject<br>");
			
		if (($row_msg != false) && ($row_msg->seqno != 0)) // message signature 
		{

//	Every campaign will have the following common messages:
//	squno	subject
//	-------	---------
//	  -3		Subscription Confirmation Message, in a 2-step opt-in
//	  -2		Welcome Message
//	  -1		Unsubscribe Acknowledgement Message
//	   0		Campaign Signature

			switch ($row_msg->seqno)
			{
				case -3:
					$MessageBody 	= "Subscription Confirmation Message:";
					break;

				case -2:
					$MessageBody 	= "Welcome Message:";
					break;
	
				case -1:
					$MessageBody 	= "Unsubscribe Message:";
					break;

				default:
					$DelayDays		= $row_msg->delay;
					$MessageBody 	= "Message ".$row_msg->seqno." of ".($NumberOfMessages - 4)." sent after ".$DelayDays." days after last message:";
					break;
			}

			$MessageSubject = $row_msg->subject;
			
			if ($Mail_Format == 1)
				$MessageBody .="<br>";
			else
				$MessageBody .="\n";				
				
			$mid = $row_msg->mid;			

			if (eregi('[a-z]', $row_msg->body)==false) //if message text is empty
				$MessageBody .="<message body is empty>";
			else
				$MessageBody .=$row_msg->body.$Signature;	
		
			// Replace message personalization (EmailAddress & FullName)
		
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
			{
				$MessageBody = wordwrap($MessageBody, $Length_Of_Wrap,"\n");
			}
		
			// clean up any message 'artifacts' that may exist so message will display properly on the screen
		
			$MessageBody	= eregi_replace("\r\n","\n",$MessageBody);
			$MessageBody 	= stripslashes($MessageBody);
			$MessageSubject = stripslashes($MessageSubject);
		
			//Append the removal instructions and the removal instructions lines to *every* message body
			if($Mail_Format == 1)
			{
				$Final_Body = "$MessageBody<br>$Removal_Link_HTML$Email_Address'>$Remove_HTML</a><br>\n";
				if ($Ad != 45)
					$Final_Body.=$PoweredbyHTML;
			}
			else
			{
				$Final_Body = $MessageBody."\n\n".$Remove_Text." ".$Removal_Link_Text.$Email_Address;
			
				if ($Ad != 45)
					$Final_Body.=$PoweredbyText;
			}
		
			if (!isset($Removal_Link_Text))
				die (logMessage ("InstantTestAction (".__LINE__.") no remove link found"));
			
			//die (logMessage("InstantTestAction: \$Remove_Text |$Remove_Text|\n\$Removal_Link_Text |$Removal_Link_Text.$Email_Address|\n\$PoweredbyText |$PoweredbyText|"));
		
			$Body_To_Send=$Final_Body;
		
			if ($debugIt==2)
			{
				logMessage ("InstantTestAction ".__LINE__." Simulation of Email:$Email_Address Subject:$MessageSubject");
			}		
			else // not debugging
			{							
				$directory=dirname(__FILE__);
				
	      if (stristr($directory, "demo"))	// if beta testing
	      {
					if ($debugIt > 0)
					{
						logMessage ("InstantTestAction ".__LINE__." ***Beta Test*** Not sending email To: ".$Full_Name."<".$Email_Address."> Subject: ".$MessageSubject." From: ".$EmailAddressFrom);
					}
				}
				else	// if not beta testing - - - - - - - - - - - - - - 
				{
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
 
					//	
					//	If an attachment is found, then add it the the email message we are constructing
		
					if($MessageAttachmentFound==1)
					{
						$Attachment="attachments/$arid/$mid/$attfile";
					
						if ($Mail_Format == 1)
							$HTMLBody=$Body_To_Send;
						else
							$TextBody=$Body_To_Send;
					
						phpmailer($Email_Address, $Full_Name, $MessageSubject, $TextBody, $HTMLBody, $Attachment, $Mail_Format, $arid);
					
				
						//$arrFiles=Array("$attfile"=>"attachments/$arid/$mid/$attfile");
						//if (!mail_attach($Email_Address, "\"$Display_Name\" <$EmailAddressFrom>", $MessageSubject, $Body_To_Send, $arrFiles))
						//	die(logMessage ("InstantTestAction (".__LINE__.") ----->Error on Sending email To: ".$Full_Name." '".$Email_Address."' Subject: ".$MessageSubject));
					}
					else
					{
						$Attachment="";
					
						if ($Mail_Format == 1)
							$HTMLBody=$Body_To_Send;
						else
							$TextBody=$Body_To_Send;
						set_time_limit(0);
						phpmailer($Email_Address, $Full_Name, $MessageSubject, $TextBody, $HTMLBody, $Attachment, $Mail_Format, $arid);
					
					}

					if ($debugIt > 0)
					{
						if($Mail_Format == 1)
							$Format = "HTML";
						else
							$Format = "Text";
					
						logMessage ("InstantTestAction (".__LINE__.") Sending email format $Format To: ".$Full_Name." '".$Email_Address."' Subject: ".$MessageSubject);
					}
				}	// end not beta testing
			}	// end not debugging
		} // end if not seqno == 4							
	} 	// end for each message
	
	header("Location: CampaignManager.php?arid=$arid"); 
	exit;      
?>
