<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright © Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/

/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
/*																											*/
/*	capture: This script queries the autoresponder db.									*/
/*	For each autoresponder it finds, it reads messages waiting on the server.	*/
/*																											*/
/*	If someone sends an e-mail to subscribe to a mailing list, this script			*/
/*  will add them to the database.															*/
/*																											*/
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -	*/

include("conn.php");

$arSQL = "select * from autoresponders";
$result_ar = mysql_query($arSQL) or die("$arSQL");
$num_rows_ar = mysql_num_rows($result_ar);
$maildelete=1;
if ($num_rows_ar < 0)
{
	exit;
}

$WithinScript = "I am embedded in another script";
include("settings.php");
include("removesettings.php");

// for each ar record...

for($count=0;$count<$num_rows_ar;$count++)
{
	mysql_data_seek($result_ar, $count);
	$arrow 				= mysql_fetch_object($result_ar);
	$arid					= $arrow->arid;
	$Display_Name	= $arrow->arname;
	$server		 		= $arrow->pophostname;
	$port 				= $arrow->popport;
	$username 		= strtolower($arrow->popuname);
	$password 		= $arrow->poppwd;

	$maxmail = 100;


	// Read the number of msg for the autoresponder
	
	$maxSQL = "select max(seqno) as maxseq from messages where arid=$arid";
	$result_max = mysql_query($maxSQL) or die("$maxSQL");
	mysql_data_seek($result_max, 0);
	$maxrow = mysql_fetch_object($result_max);
	$maxmsg=$maxrow->maxseq;
	if($maxmsg<1)
	$maxmsg=0;
	$Number_Of_Days	= $maxrow->delay;
	
	// select users in ar who are currently receiving messages
	
	$SQL_Statement = "SELECT * FROM users where currentmsg < $maxmsg";
	$Query_Result = mysql_query($SQL_Statement);
	$num_rows_usr = mysql_num_rows($Query_Result);

	if ($debugIt == 2)
		logMessage ("Capture (".__LINE__.") Now checking autoresponder $arid - '$Display_Name'");

	// try opening the mail server

	$mailserver=@fsockopen($server,$port,&$errno,&$errstr,30);

	if(!$mailserver)
	{

		if ($debugIt > 0)
	  		logMessage ("Capture (".__LINE__.") Mail server $server for autoresponder $arid - '$Display_Name' cannot be contacted.\nPlease check mail server settings.\nContinuing...");
	}
	else 
	{
		// mail server is reachable, try logging into the user specified in the autoresponder db

		$buffer=fgets($mailserver,512);

		$buffer="USER $username\n";
		fputs($mailserver,$buffer);
		$buffer=fgets($mailserver,512);

		$buffer="PASS $password\n";
		fputs($mailserver,$buffer);

		$buffer=fgets($mailserver,512);

		if (substr($buffer,0,4)=="-ERR")
		{
			fclose($mailserver);
			if ($debugIt > 0)
				logMessage ("Capture (".__LINE__.") $username inbox failed to open. Possible cause: Incorrect username/password");
			
			$msgid=$mailtop=$mailbot = 0;			
		}
		else 
		{	// logged into mail server

			if ($debugIt == 2)
				logMessage ("Capture (".__LINE__.") Inbox for Autoresponder $arid - '$Display_Name' (user: $username) successfully queried for subscription emails");

			// how many messages are waiting for me?

			$buffer="STAT\n";
			fputs($mailserver,$buffer);
			$buffer 	= fgets($mailserver,512);
			$answ		= explode(" ", $buffer);
			$mailsum	= $answ[1];
			$mailmem	= $answ[2];

			$ahem = (int) $mailsum;

			if ($debugIt == 2)
				logMessage ("Capture (".__LINE__.") Inbox for Autoresponder $arid - '$Display_Name' mailsum: $mailsum mailmem: $mailmem");
			
			for ($q = 1; $q <= $ahem; $q++)
			{
				$buffer="LIST ".$q."\n";
				fputs($mailserver,$buffer);
				$buffer		= fgets($mailserver,512);
				$tablo		= explode(" ", $buffer);
				$saize[]	= $tablo[2];
			}

			if ($debugIt == 2)
				logMessage ("Capture (".__LINE__.") Inbox for Autoresponder $arid - '$Display_Name' (user: $username) successfully queried for subscription emails");

			if (!isset($lastdone)) 
				$lastdone = $mailsum;

			if ($mailsum > $maxmail) //if over 100 messages
			{
				$mailtop = $lastdone;  // make top = mailtop
				$mailbot = $mailtop - ($maxmail - 1);
				
				if ($mailbot < 1) 
					$mailbot = 1;
			}
			else
			{
				$mailtop = $mailsum;
				$mailbot = 1;
			}

			$lastdone = $mailtop;

			if ($debugIt == 2)
				logMessage ("Capture (".__LINE__.") reading $mailsum messages for Autoresponder $arid - '$Display_Name' (user: $username)");
			
			if($mailsum > 0)
			for($msgid=$mailtop; $msgid >= $mailbot; $msgid--) //read last-in first
			{
				if ($debugIt == 2)
					logMessage ("Capture (".__LINE__.") message $msgid for debugging purpose");
					
				$SQL_Statement = "select count(*) as TOTAL from users where arid=$arrow->arid";
				$Query_Result = mysql_query($SQL_Statement);
				mysql_data_seek($Query_Result, 0);
				$Query_Result_Data	= mysql_fetch_object($Query_Result);
				$usercount 			= $Query_Result_Data->TOTAL;
				$buffer				= "TOP $msgid 0\n";
				
				fputs($mailserver,$buffer);
				$buffer=fgets($mailserver,512);  // read a line (512 bytes max) of the message.
				
				for($i=0;$i < 70; $i++) //reading header, max 70 lines
				{
					$buffer=fgets($mailserver,512); // read a line (512 bytes max) of the message.
					
					// capture the date, from, to, subject, and IP address

					if(strcasecmp(substr($buffer,0,5),"Date:")==0) 
					{
				  		$maildate=substr($buffer,6,strlen($buffer)-6);
					}

					if(strcasecmp(substr($buffer,0,5),"From:")==0) 
					{
				  		$fromperson=substr($buffer,6,strlen($buffer)-6);
				  		$fromperson=htmlspecialchars($fromperson);
					}

					if(strcasecmp(substr($buffer,0,3),"To:")==0) 
					{
				  		$toperson=substr($buffer,4,strlen($buffer)-4);
				  		$toperson=htmlspecialchars($toperson);
					}

					if(strcasecmp(substr($buffer,0,8),"Subject:")==0)
					{
				  		$subject=substr($buffer,9,strlen($buffer)-9);
				  		$subject=htmlspecialchars($subject);
					}

					if(strcasecmp(substr($buffer,0,9),"Received:")==0) 
					{
				   		// was $matches=preg_split ("/[.s,]+/",$buffer); 
						// was $ipadd = substr($matches[0], strlen($matches[0])-3, strlen($matches[0])).".".$matches[1].".".$matches[2].".".substr($matches[3], 0, 3);
				   		
				   		preg_match ("([[0-9]+\.[0-9]+\.[0-9]+\.[0-9]+])",$buffer, $matches); 
						$xxx = $matches[0];
						$ipadd = substr($xxx,1,strlen($xxx)-2);
						
						if ($debugIt == 2)
							logMessage ("Capture (".__LINE__.") ip address|$ipadd|");
					}

					if(strcmp($buffer,"\r\n")==0 || strcmp($buffer,"\n\r")==0 || strcmp($buffer,"\n\n")==0 && $maildate!=0 && $subject!=0 && $fromperson!=0) 
					{
				  		break;
					}
				} // end for loop, reading header

				if ($debugIt == 2)
					logMessage ("Capture (".__LINE__.") message $msgid header. Sent: |$maildate| From: |$fromperson| To: |$toperson| Subject: |$subject| from ip: |$ipadd|");
									

				$msgsize = $saize[$msgid-1];

				$datearray = explode(" ", $maildate);

				if (sizeof($datearray) == 6)
				{
					$maildate = $datearray[0]." ".$datearray[1]." ".$datearray[2]." ".$datearray[3]."<br>".$datearray[4]." ".$datearray[5];
				}

				if (sizeof($datearray) == 5)
				{
					$maildate = $datearray[0]." ".$datearray[1]." ".$datearray[2]."<br>".$datearray[3]." ".$datearray[4];
				}

				$buffer = explode("&lt;", $fromperson);

				if (sizeof($buffer) == 2)
				{
					$fromperson = implode("<br>&lt;", $buffer);
				}

				$mystr=stristr($subject,"subscribe");  

				if ($mystr != "")	// is 'subscribe' in the subject line?
				{

					$myarr=split("<br>",$fromperson);

				   	$fromname=trim(substr($myarr[0], 6, strlen($myarr[0])-13));
				    
				   	$fromemail=substr($myarr[1], 4, strlen($myarr[1])-10);
					
					if ($debugIt == 2)
						logMessage ("Capture (".__LINE__.") '$fromname' $fromemail '$subject'");
						
					$SQL_Statement = "select * from users where email='$fromemail' AND arid=$arrow->arid";
					$Query_Result = mysql_query($SQL_Statement);
					$num_rows_u = mysql_num_rows($Query_Result);

					if($num_rows_u>0)
					{
						mysql_data_seek($Query_Result, 0);
						$Query_Result_Data = mysql_fetch_object($Query_Result);
					}

					$Check_Email = $Query_Result_Data->email;
					
					// Add the requester to the subscription list

					if ($Check_Email != $fromemail)// if users email does not match the database
					{
						$ReceivedDate = mktime(date("H")-1,date("i"),date("s"),date("m"),date("d")+1,date("Y"));

						if($ipadd=="") 
							$What_Address="Unknown";
						else 
							$What_Address=$ipadd;
						
						$SQL_Statement = "INSERT INTO users (fname,lname,email,ip,method,senddate,confirmed,currentmsg,arid,UserDefined1,UserDefined2,UserDefined3,UserDefined4) VALUES ('$fromname','','$fromemail','$What_Address',2,'$ReceivedDate','Y',1,$arid,'$UserDefined1','$UserDefined2','$UserDefined3','$UserDefined4')";
/********************
						if($armode=1)  //1-step opt-in
						{
							$SQL_Statement = "INSERT INTO users (fname,lname,email,ip,method,senddate,confirmed,currentmsg,arid,UserDefined1,UserDefined2,UserDefined3,UserDefined4) VALUES ('$fromname','','$fromemail','$What_Address',2,'$ReceivedDate','N',1,$arid,'$UserDefined1','$UserDefined2','$UserDefined3','$UserDefined4')";
						}
						else  //2-step opt-in
						{
							$SQL_Statement = "INSERT INTO users (fname,lname,email,ip,method,senddate,confirmed,currentmsg,arid,UserDefined1,UserDefined2,UserDefined3,UserDefined4) VALUES ('$fromname','','$fromemail','$What_Address',2,'$ReceivedDate','Y',1,$arid,'$UserDefined1','$UserDefined2','$UserDefined3','$UserDefined4')";
						}
*********************/

					}

					$Query_Result = mysql_query($SQL_Statement) or die(logMessage("capture (".__LINE__.") $SQL_Statement"));
					
					$SQL_Statement = "Select * from autoresponders where arid=$arid";
	
					$Query_Result =  mysql_query($SQL_Statement);

					mysql_data_seek($Query_Result, 0);
					$row = mysql_fetch_object($Query_Result);
					$armode		 	= $row->armode;
					$Mail_Format 	= $row->aremailformat;	// text or html message format?
					$Wrap_On 		= $row->arwordwrap;		// wrap of text messages?
					$Length_Of_Wrap	= $row->arwraplen;		// column of text line to wrap
	
					$Remove_Text	= $row->remtext;		// text to send like "click to be removed"
					$Remove_HTML	= $row->remhtml;		// HTML to send like "click to be removed"
					
					// now get the welcome email for the autoresponder
		
					$msgSQL = "select * from messages where (arid=$arid) and (seqno=-2)";
					$result_msg = mysql_query($msgSQL) or die(logMessage("capture (".__LINE__.") Error: $msgSQL"));
					mysql_data_seek($result_msg, 0);  // confirmation email
					$row_msg = mysql_fetch_object($result_msg);
	
					if ($row_msg->seqno != -2) 
						die("ImportAction (".__LINE__.") Error: sequence error");
		
					$Automatic_Subject_Text = $row_msg->subject;		
					$Automatic_Message_Text = $row_msg->body;		
					
					/*
					if($armode=1)
					{

					}
					else
					{
						$Automatic_Subject_Text = $row->welconfsubject;
						$Automatic_Message_Text = $row->welconfbody; 
					}
					*/
					$Automatic_Message_Text = eregi_replace("%EmailAddress%",$fromemail,$Automatic_Message_Text);
					$Automatic_Subject_Text = eregi_replace("%EmailAddress%",$fromemail,$Automatic_Subject_Text);
					$Automatic_Message_Text = eregi_replace("%FullName%",$fromname,$Automatic_Message_Text);
					$Automatic_Subject_Text = eregi_replace("%FullName%",$fromname,$Automatic_Subject_Text);
					$Automatic_Message_Text = eregi_replace("%UserDefined1%",$UserDefined1,$Automatic_Message_Text);
					$Automatic_Subject_Text = eregi_replace("%UserDefined1%",$UserDefined1,$Automatic_Subject_Text);
					$Automatic_Message_Text = eregi_replace("%UserDefined2%",$UserDefined2,$Automatic_Message_Text);
					$Automatic_Subject_Text = eregi_replace("%UserDefined2%",$UserDefined2,$Automatic_Subject_Text);
					$Automatic_Message_Text = eregi_replace("%UserDefined3%",$UserDefined3,$Automatic_Message_Text);
					$Automatic_Subject_Text = eregi_replace("%UserDefined3%",$UserDefined3,$Automatic_Subject_Text);
					$Automatic_Message_Text = eregi_replace("%UserDefined4%",$UserDefined4,$Automatic_Message_Text);
					$Automatic_Subject_Text = eregi_replace("%UserDefined4%",$UserDefined4,$Automatic_Subject_Text);

					$Remove_Email_Link = $Installation_Path."/us.php?arid=".$arid."&ra=".$arid."&RE=".$fromemail;
					//logMessage ("capture (".__LINE__.") arid '$arid' Email_Address '$fromemail'");
					//logMessage ("capture (".__LINE__.") Remove_Email_Link '$Remove_Email_Link'");
					
					if($Mail_Format == 1) //html format
					{
						$Mail_Header	= "Content-type: text/html; charset=iso-8859-1";
						$Remove_HTML	= "<a href='".$Remove_Email_Link."'>Unsubscribe</a>";
						$Mail_Footer	= eregi_replace("%RemoveLink%",$Remove_Email_Link,$Mail_Footer);
					}
					elseif($Mail_Format == 0) 
					{
						$Mail_Header	= "Content-Type: text/plain; charset=us-ascii";
						$Remove_Text	= "\n".$Remove_Email_Link."\n";
						$Mail_Footer	= eregi_replace("%RemoveLink%",$Remove_Email_Link,$Mail_Footer);
					}

					if (($Wrap_On == 1) && ($Mail_Format == 0))
					{
						$Automatic_Message_Text = wordwrap($Automatic_Message_Text, $Length_Of_Wrap,"\n");
					}

					$Automatic_Message_Text = eregi_replace("\r\n","\n",$Automatic_Message_Text);
					$txtMessage_Send 		= $Automatic_Message_Text;
					$txtMessage_Text 		= $txtMessage_Send;
					$txtMessage_Body 		= stripslashes($txtMessage_Text);
					$txtMessage_Subject		= stripslashes($Automatic_Subject_Text);

/****************emailed subscription requests don't need confirming
					if($armode=2)	
					{
						if($Mail_Format == 1)
							$txtMessage_Body.="<br><a href='$Installation_Path/optin.php?arid=$arid&Email_Address=".$fromemail."'>Click the here to confirm your subscription</a><br>\n";
						else
							$txtMessage_Body.="\n*****************************************\n";
							$txtMessage_Body.="* Click this link to *CONFIRM* your subscription\n$Installation_Path/optin.php?arid=".$arid."&Email_Address=".$fromemail."\n";
							$txtMessage_Body.=*****************************************\n";
					}
****************/
					//Append the removal instructions and the removal instructions lines to *every* message body
					//logMessage ("capture (".__LINE__.") Remove_HTML '$Remove_HTML'");
					//logMessage ("capture (".__LINE__.") Remove_Text '$Remove_Text'");

					if($Mail_Format == 1)
					{
						$Final_Body.="$txtMessage_Body<br><br>$row->remhtml<br>$Remove_HTML";

						if ($Ad != 45)
							$Final_Body.=$PoweredbyHTML;
					}
					else
					{
						$Final_Body=$txtMessage_Body."\n\n".$row->remtext."\n".$Remove_Text;
						// die	("optin (".__LINE__.") \$Ad='$Ad'");
						if ($Ad != 45)
							$Final_Body.=$PoweredbyText;
					}
		
					if (!isset($Removal_Link_Text))
						die (logMessage ("capture (".__LINE__.") no remove link found"));

					//die (logMessage(capture (".__LINE__.") \$Remove_Text |$Remove_Text|\n\$Removal_Link_Text |$Removal_Link_Text.$Email_Address|\n\$PoweredbyText |$PoweredbyText|"));

					$directory=dirname(__FILE__);

		         	if (stristr($directory, "demo"))
  		         	{
						if ($debugIt > 0)
						{
							logMessage ("capture (".__LINE__.") ***Beta Test*** Not sending email To: ".$fromname." |".$fromemail."| Subject: ".$txtMessage_Subject." From: ".$EmailAddressFrom);
						}
					}
					else
					{
						$Sent = phpmailer($fromemail, $fromname, $txtSubjectComplete,  "$Final_Body",  "$Final_Body", "", $Mail_Format, $arid);

						if ($debugIt > 0)
						{
							if ($Sent == true)
								logMessage ("capture (".__LINE__.") Sending email back To: ".$fromname." |".$fromemail."| Subject: ".$txtMessage_Subject." From: ".$EmailAddressFrom);
							else
								logMessage ("capture (".__LINE__.") Error: Not sent To: ".$fromname." |".$fromemail."| Subject: ".$txtMessage_Subject." From: ".$EmailAddressFrom);
						}

						NotifyOfAdd("$fromname", "$fromemail", $arid, "$CampaignDescription");						
					}
				} //end subscribe request
				else
				$mystr=stristr($subject,"Home Loan Credit Report Waiting for your review-See below");  

				if ($mystr != "")	// is 'Home Loan Credit Report Waiting for your review-See below' in the subject line?
				{	
				
				
				}
			} // end for loop, reading last-in first

			$subject=0;
			$maildate=0;
			$fromperson=0;

			if ($debugIt == 2)
				logMessage ("Capture (".__LINE__.") buffer $buffer");

			if($maildelete==1)
			{
				for($msgid=$mailtop;$msgid>=$mailbot;$msgid--)
				{
					//print("msgid '$msgid' top message '$mailtop' bottom message '$mailbot' mail server '$server' port '$port'<br>");
			
					$buffer="DELE $msgid\n";
					fputs($mailserver,$buffer);
					$buffer=fgets($mailserver,512);

				}
			}

			$buffer="QUIT\n";
			fputs($mailserver, $buffer);
			$buffer=fgets($mailserver,512);

			fclose($mailserver);
		}// end logged into mail server
	} //end else, there's a mail server
}  //end 'for' loop

exit;
?>