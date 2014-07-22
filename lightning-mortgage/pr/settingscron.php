<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright © Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/
//  - - - - - - - - - - - - // - - - - - - - - - - - - - - - //

//customized error reporting/logging

if (!function_exists(ReportErrors))
{
	function ReportErrors($number, $message, $file, $line, $context)
	{
		$out="";
		
		if ($number != 8)
		{
			if (($number & E_ERROR) == E_ERROR)
				{ $out =" E_ERROR | "; }

			if (($number & E_WARNING) == E_WARNING)
				{ $out .=" E_WARNING | "; }

			if (($number & E_PARSE  ) == E_PARSE)
				{ $out .=" E_PARSE | "; }

			if (($number & E_NOTICE) == E_NOTICE)
				{ $out .=" E_NOTICE | "; }

			if (($number & E_CORE_ERROR) == E_CORE_ERROR)
				{ $out .=" E_CORE_ERROR | "; }

			if (($number & E_CORE_WARNING)  == E_CORE_WARNING)
				{ $out .=" E_CORE_WARNING | "; }

			if (($number & E_COMPILE_ERROR) == E_COMPILE_ERROR)
				{ $out .=" E_COMPILE_ERROR | "; }

			if (($number & E_COMPILE_WARNING) == E_COMPILE_WARNING)
				{ $out .=" E_COMPILE_WARNING | "; }

			if (($number & E_USER_ERROR) == E_USER_ERROR)
				{ $out .=" E_USER_ERROR | "; }

			if (($number & E_USER_WARNING) == E_USER_WARNING)
				{ $out .=" E_USER_WARNING | "; }

			if (($number & E_USER_NOTICE) == E_USER_NOTICE)
				{ $out .=" E_USER_NOTICE | "; }

			if (($number & E_ALL) == E_ALL)
				{ $out .=" E_ALL | "; }
			
			// get last string in $file string
			$filename = $file;	
			//$filename = substr(strrchr($file, "//"), 1);	
			//logMessage("settings (".__LINE__.") Real PHP error occurred in '$filename' script on line ($line) context |$context| error: ($number/$out) $message");
			logMessage("settings (".__LINE__.") Error occurred in '$filename' script on line ($line) $message");
			//echo "<br>Logged PHP error in $filename ($line) context |$context| error number ($number) $message<br>";
		}
	}
}

//  - - - - - - - - - - - - // - - - - - - - - - - - - - - - //

if (!function_exists(NotifyOfAdd))
{
	function NotifyOfAdd($Full_Name, $Email_Address, $arid, $CampaignDescription, $SMTPDebugging, $SMTPTimeout)
	{
		GLOBAL $Notification, $debugIt;
		
		//logMessage("settings (".__LINE__.") NotifyOfAdd setup check: SMTPDebugging |$SMTPDebugging| SMTPTimeout |$SMTPTimeout|");
	
		$SavedIPaddress = GetIP(); /* retrieve the visitor's IP address using PHP's convenient tools */
		$Host = gethostbyaddr($SavedIPaddress);
		$MsgBody  = "Name: $Full_Name\nEmail: $Email_Address\nSubscribed to mail campaign $arid - $CampaignDescription\n";
		$MsgBody .= "IP Address: $SavedIPaddress\nDNS Host Name: $Host\n";
		$MsgBody .= "\n\nI remain,\n\nYour Perfect Response\n";
		phpmailer($Notification, "Admin", "$Full_Name - $Email_Address added to '$CampaignDescription'",  "$MsgBody",  "$MsgBody", "", 0, $arid, $SMTPDebugging, $SMTPTimeout);
	
		if($debugIt > 0)
			logMessage ("settings (".__LINE__.") notified $Notification that Email: $Email_Address was added to '$CampaignDescription'");
	}
}

// - - - - - - - - - - - - - - // - - - - - - - - - //
//													//
//	phpmailer: This is where all email is sent out	//
//										 			//
//  - - - - - - - - - - - - // - - - - - - - - - -	//

if (!function_exists(phpmailer))
{
	function phpmailer($ToEmail, $ToName, $Subject, $TextBody, $HTMLBody, $Attachment, $HTML, $arid, $SMTPDebugging, $SMTPTimeout)
	{
		GLOBAL $EmailAddressReplyTo, $debugIt, $Installation_Path, $Display_Name, $SMTPport, $EmailAddressFrom;
		GLOBAL $SMTPmailServer, $SMTPmailbox, $SMTPpassword, $Wrap_On, $Length_Of_Wrap; //read from the system configuration

		//logMessage("settings (".__LINE__.") PHPmailer setup check: SMTPDebugging |$SMTPDebugging| SMTPTimeout |$SMTPTimeout|");
			
		if(($TextBody == "") && ($HTMLBody == ""))
		{
			logMessage("settings (".__LINE__.") message is empty");
			print("<h1>settings (".__LINE__.") text message:</h1>$TextBody");
			die("<h1>settings (".__LINE__.") html message:</h1>$HTMLBody");
		}
	
		if ($debugIt == 2)
		{
			logMessage("settings (".__LINE__.") set on include_path was successfully set to 'phpmailer'");

			logMessage("From:$Display_Name<br>\$EmailAddressFrom:$EmailAddressFrom<br>\$EmailAddressReplyTo:$EmailAddressReplyTo<br>");
			logMessage("\$ToEmail:$ToEmail<br>\$ToName:$ToName<br>\$Subject:$Subject<br>");
			logMessage("\$TextBody:$TextBody<br>\$HTMLBody:$HTMLBody<br>\$Attachment:$Attachment<br>\$HTML:$HTML<br>");

			logMessage("\$Installation_Path:$Installation_Path<br>\$SMTPmailServer:$SMTPmailServer<br>\$Display_Name:$Display_Name<br>");
			logMessage("\$SMTPpassword:$SMTPpassword<br>");
			logMessage("\$Wrap_On:$Wrap_On<br>\$Length_Of_Wrap:$Length_Of_Wrap<br>");
		}

		require_once("phpmailer/class.phpmailer.php");
		
		$Sent = false;
		$RetryCount = 0;
		$ErrorInfo = "";	
		
		// When the smtp server timesout, PHPmailer returns a msg that the data wasn't accepted. 
		// So I'm going to extend the timeout and try sending the message 4 times with 2 seconds between attempts.
		
		while (($Sent==false) && ($RetryCount < 4) && ($ErrorInfo != "SMTP Error: Data not accepted."))
		{
		  if (($_SESSION['LockKey'] != "InstantTestAction.php") //if not a one-off email then honor the kill switch
		   && ($_SESSION['LockKey'] != "AddAction.php") 
		   && ($_SESSION['LockKey'] != "BroadcastAllAction.php") 
		   && ($_SESSION['LockKey'] != "optin.php") 
		   && ($_SESSION['LockKey'] != "RemoveAction.php.php") 
		   && ($_SESSION['LockKey'] != "RetrieveAction.php") 
		   && ($_SESSION['LockKey'] != "us.php"))
		  {
		  	if((file_exists("mailout.stop")))  // If this file exists, the script will end. This is a kill switch.
				die(logMessage ("settings (".__LINE__.") KILL SWITCH: A file named mailout.stop exists. Script halted."));
		  }

		  //logMessage ("settings (".__LINE__.") Mail send::: Using smtp, mail server $SMTPmailServer, Username $SMTPmailbox, Password $SMTPpassword");
		  $mail = new PHPMailer();
		  $mail->SMTPDebug = false;
		  
		  //if in a frame the script is not being executed by a person visition the web site (imagecron)

		  print("<script type='text/javascript'>\n");
		  print("if(self.location != top.location)\n");  // if in a frame
		  print("{\n");
		   		// To display the smtp server dialog
		  		if ($SMTPDebugging == 1) //set in mailout depending on the system configuration setting
		  		{
			  		print ("document.writeln('<br /> - - - - SMTP: Debugging - Preparing to Send to SMTP Server- - - - - - - - - <br />');\n");
		  			$mail->SMTPDebug = true;
		  		}
		  print("}\n</script>\n");


		  $mail->IsSMTP();							// send via SMTP 
  		  //$mail->IsSendmail();					// send via Sendmail
		  $mail->Timeout	= $SMTPTimeout;			//set in mailout depending on the system configuration setting
		  $mail->Host 	= $SMTPmailServer;			// SMTP server
		  
		  if ($mail->SetLanguage("en", "./phpmailer/") == false)
		  {
			logMessage("settings (".__LINE__.") error on setting language file Error: " . $mail->ErrorInfo);		   
			//die("Language file");
		  }
		
		  if ($SMTPmailbox == "")
		  {
		 	 $mail->SMTPAuth	= false;			// turn off SMTP authentication
			 $mail->Username	= $SMTPmailbox;		// SMTP username
			 $mail->Password	= $SMTPpassword;	// SMTP password
		  }
		  else
		  {
		 	 $mail->SMTPAuth	= true;				// turn on SMTP authentication
			 $mail->Username	= $SMTPmailbox;		// SMTP username
			 $mail->Password 	= $SMTPpassword;	// SMTP password
		  }
		  
		  $mail->SMTP_PORT	= $SMTPport;			// SMTP port
		  $mail->From = $EmailAddressFrom;
		
		  if (strtolower(substr($Display_Name, 0, 17)) == "monthly schedule:")	
			  $mail->FromName	= substr($Display_Name, 17, 40);
		  else
			  $mail->FromName	= "$Display_Name";
			
		  if ($Display_Name == 'Fran Ferlazzo')
			  $mail->AddReplyTo("fran.ferlazzo@westernthrift.net");
		  else
			  $mail->AddReplyTo($EmailAddressReplyTo);
		
		  $mail->AddAddress($ToEmail,"$ToName"); // 'To:' address

		  if ($Wrap_On == 1)
			  $mail->WordWrap = $Length_Of_Wrap;	
			  	
		  if ($Attachment != "")
			  $mail->AddAttachment("$Attachment");// attachment
	
		  if ($HTML == 1)
		  {
			  $mail->IsHTML(true);				// send as HTML
			  $wrappedHTMLBody = htmlWrapper(addslashes($HTMLBody));
			  $mail->Body     =  stripslashes($wrappedHTMLBody);
			  $mail->AltBody  =  "";		
		  }
		  else
		  {
			  $mail->IsHTML(false);
			  $mail->Body     =  "$TextBody";		
		  }
	
		  $mail->Subject  =  "$Subject";

		  $mail->Body=stripslashes($mail->Body);
		  $mail->Subject=stripslashes($mail->Subject);  
		  
		  $Sent = $mail->Send();
		  $ErrorInfo = $mail->ErrorInfo; //record the error message
		  $RetryCount++;
			
		  //usleep(0500000);	// 0.5 seconds between sends
		  sleep(1);				// at least 1 second between send attempts
		  
		  //if ($ErrorInfo == "SMTP Error: Data not accepted.") // This error is returned even though the message gets sent
		  //	$Sent = true;									  // so don't send it again.
						  
		  if ($Sent==false)
		  {
			if ($debugIt > 0)
				logMessage("settings (".__LINE__.") * Error * NOT SENT, Message:'$ErrorInfo' &lt;$ToEmail&gt; '$Subject'");

			sleep(1); // 1 second between retries
		  }
		  else
		  {
			if ($debugIt > 0)
				logMessage ("settings (".__LINE__.") Session |".$_SESSION['LockKey']."| sending email to: $ToName &lt;$ToEmail&gt; Subject: |$Subject| phpmailer version ".$mail->Version);
		  }
		}  //end while $Sent==false
		
		if ($ErrorInfo == "SMTP Error: Data not accepted.")
			die(logMessage("settings (".__LINE__.") PHPmailer (version ".$mail->Version.") SMTP server timed out"));
			
		if($Sent == false)
		{
			if ($debugIt > 0)
			{
				logMessage("settings (".__LINE__.") Retry Count was exceeded. '$ToName' &lt;$ToEmail&gt; Subject: $mail->Subject not sent");
				logMessage("settings (".__LINE__.") PHPmailer error: |$mail->ErrorInfo| SMTPmailbox |$mail->Username| SMTPpassword |$mail->Password| server |$SMTPmailServer| port |$SMTPport| SMTPDebugging |$SMTPDebugging| SMTPTimeout |$SMTPTimeout|");
				//logMessage("Body: $mail->Body");
				//logMessage("settings (".__LINE__.") error '$ToName' arid '$arid' server '$SMTPmailServer' Error Detail: " . $mail->ErrorInfo);		   
			}	
			return(false);
		}
		else
		{
		  //if in a frame the script is not being executed by a person visition the web site (imagecron)

		  print("<script type='text/javascript'>\n");
		  print("if(self.location != top.location)\n");  // if in a frame
		  print("{\n");
		
			if ($SMTPDebugging == 1)
			  	print ("document.writeln('<br /> - - - - SMTP: Debugging - Transaction Complete- - - - - - - - - <br />');\n");
		  print("}\n</script>\n");
		}

		return(true);
	}	
}

//  - - - - - - - - - - - - // - - - - - - - - - - - - - - - //


// ---------------
//
// Get the visitors IP Address
//
// ---------------

if (!function_exists(GetIP))
{
	function GetIP()
	{
	  if ($_SERVER)
	  {
	    if ( $_SERVER[HTTP_X_FORWARDED_FOR] )
	    {
	      $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	    }
	    elseif ( $_SERVER["HTTP_CLIENT_IP"] )
	    {
	      $realip = $_SERVER["HTTP_CLIENT_IP"];
	    }
	    else
	    {
	      $realip = $_SERVER["REMOTE_ADDR"];
	    }
	  }
	  else
	  {
	    if ( getenv( 'HTTP_X_FORWARDED_FOR' ) )
	    {
	      $realip = getenv( 'HTTP_X_FORWARDED_FOR' );
	    }
	    elseif ( getenv( 'HTTP_CLIENT_IP' ) )
	    {
	      $realip = getenv( 'HTTP_CLIENT_IP' );
	    }
	    else
	    {
	      $realip = getenv( 'REMOTE_ADDR' );
	    }
	  }

	  return $realip;
	}
}
//----------------------------
//
// This function is a common 'footer' for Perfect Response pages 
//
//----------------------------
if (!function_exists(JumpToCampaign))
{
	function JumpToCampaign($link, $arid)
	{
		$user = $_COOKIE["UName"];
		
		//die("settings (".__LINE__.") would jump to script $_SERVER[SCRIPT_NAME]");
		print("<hr><div style='height:23px;width:400px;margin:20px auto;'><div style='float:left;'>\n");
		$AutoresponderResult 	= mysql_query("SELECT * FROM autoresponders where user='$user' order by ardescription", $link); 
		$NumberOfAutoresponders = mysql_num_rows($AutoresponderResult); 		

		if($NumberOfAutoresponders > 0) //autoresponder=email campaign
		{
			print ("<form name='formJump' action='$_SERVER[SCRIPT_NAME]' method='get'>\n");  //this script
			print ("<input type='hidden' name='NewArid' value='$arid'>\n");
			print ("<input type='hidden' name='cmd' value=1>\n");
			print ("<select style='color:#800000;font-weight:bold;font-size:12px;width:230px;' size='1' name='arid' onChange='submit();'>\n");
			print ("<option selected value='0'>Select Another Email Campaign</option>\n");

			for($count=0; $count < $NumberOfAutoresponders; $count++) 
			{
				mysql_data_seek($AutoresponderResult, $count); //set db pointer to next autoresponder
				$AutoresponderRow	= mysql_fetch_object($AutoresponderResult);
				$NextArid			= $AutoresponderRow->arid;
				$NextAridName		= $AutoresponderRow->ardescription;

				if ($arid != $NextArid) //can't jump from the current autoresponder
					printf ("<option value='$NextArid'>%03s $NextAridName</option>\n",$NextArid);
			}
			
			print ("</select></form>\n");
		}
		
		print("</div>\n<div style='float:left;'>&nbsp;:: <a href='ManageCampaigns.php' title=''>View All Campaigns</a>\n</div></div>\n");
	}
}	

if (!function_exists(ReferenceLinks))
{
	function ReferenceLinks($arid)
	{
		print("<div id='navKappa'>\n");
		print("<div id='navKappaPadlock' onMouseOver='this.style.backgroundColor=\"silver\"' onMouseOut='this.style.backgroundColor=\"transparent\"'>\n");
		print("<a href='unlock.php' target='Monitor' title='If you stopped all campaigns, restart them here.' onMouseOver='this.style.backgroundColor=\"transparent\"'>\n");
		print("<img src='./images/unlocked.png' alt='If you stopped all campaigns, restart them here.' style='border:none;'></a></div>\n");

		print("<div id='navKappaLinks'>\n");

		print("<a href='DisplayLog.php?f=activity' title='View the Activity Log' target='LogFile'>Refresh Log</a> ::\n"); 
		print("<a href='home.php'>Home</a> :: \n");
		print("<a href='DisplaySchedule.php?arid=$arid' title=\"View this campaign's schedule email delivery\" target='Monitor'>View Schedule</a> ::\n"); 
		print("<a href='/pr/home.php?arid=$arid&amp;cmd=1' onclick='return(LLogout());'>Logout</a>\n");

		print("<br/><br/><a href='mailout.php' target='Monitor'>Send All Past Due</a> :: \n"); 
		print("<a href='Monitor.php?arid=$arid' title=\"View this campaign's pending email delivery\" target='Monitor'>Monitor Pending</a></div>\n");

		print("<div id='navKappaStop' onMouseOver='this.style.backgroundColor=\"silver\"' onMouseOut='this.style.backgroundColor=\"transparent\"'>\n");
		print("<a href='lock.php' target='Monitor' title='Made a mistake? Immediately stop the email Send process.' onMouseOver='this.style.backgroundColor=\"transparent\"'>\n");
		print("<img src='./images/stop.gif' alt='Made a mistake? Immediately stop the email Send process.' style='border:none;'></a></div><br style='clear:left;'></div>\n");
	}
}

if (!function_exists(htmlWrapper))
{
	function htmlWrapper($Msg)
	{
		$Final  = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">';
		$Final .= '<HTML>';
		$Final .= '<HEAD>';
		$Final .= '<TITLE>Your Message - Perfect Response</TITLE>';
		$Final .= '</HEAD>';
		$Final .= '<body>';
		$Final .= "$Msg";
		$Final .= '</body>';
		$Final .= '</html>';
		return($Final);
	}
}
include("GetARstuff.php");
include("SwiftNeeded.php");
?>
