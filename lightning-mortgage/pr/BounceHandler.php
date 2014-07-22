<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright © Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/

/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -	*/
/*																				*/
/*	BounceHandler: This script queries the autoresponder db.					*/
/*	For each of user admin's autoresponders found, it reads messages waiting on the server.	*/
/*				user admin only 												*/
/*				user admin only 												*/
/*				user admin only 												*/
/*				user admin only 												*/
/*				user admin only 												*/
/*				user admin only 												*/
/*																				*/
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -	*/

include("conn.php");
//print ("BounceHandler (".__LINE__.") start program<br />");	
$arSQL = "select * from autoresponders where user='admin'";
$result_ar = mysql_query($arSQL) or die("$arSQL");
$num_rows_ar = mysql_num_rows($result_ar);
//print ("BounceHandler (".__LINE__.") found $num_rows_ar email campaigns<br />");
$maildelete=1;
if ($num_rows_ar < 1)
{
	exit;
}

$WithinScript = "I am embedded in another script";
include("settings.php");
include("removesettings.php");
require("pop3.php");

//print ("BounceHandler (".__LINE__.") prior to loop<br />");	
$pop3=new pop3_class;
//for($count=0;$count<$num_rows_ar;$count++)	// for each mail campaign....
$count=0;
{
	mysql_data_seek($result_ar, $count);
	$arrow 			= mysql_fetch_object($result_ar);
	$arid			= $arrow->arid;
	$user 			= $arrow->user;
	$ArDescription	= $arrow->ardescription;
	$server		 	= $arrow->pophostname;
	$port 			= $arrow->popport;
	$username 		= strtolower($arrow->popuname);
	$password 		= $arrow->poppwd;
	$EmailAddressFrom = strtolower($arrow->popuname);
	$CampaignState  = $arrow->CampaignState;
	$User			= $arrow->user;
	
	$pop3->hostname=$arrow->pophostname;     /* POP 3 server host name                      */
	$pop3->port=$arrow->popport;             /* POP 3 server host port                      */
	$user=strtolower($arrow->popuname);      /* Authentication user name                    */
	$password=$arrow->poppwd;                /* Authentication password                     */
	$pop3->realm="";                         /* Authentication realm or domain              */
	$pop3->workstation="";                   /* Workstation for NTLM authentication         */
	$apop=0;                                 /* Use APOP authentication                     */
	$pop3->authentication_mechanism="USER";  /* SASL authentication mechanism               */
	$pop3->debug=0;                          /* If = 1, output debug information            */
	$pop3->html_debug=1;                     /* Debug information is in HTML                */
	$pop3->join_continuation_header_lines=1; /* Concatenate headers split in multiple lines */
	
	if(($error=$pop3->Open())=="")
	{
		if ($debugIt>0)
			logMessage("BounceHandler (".__LINE__.") Processing arid: $arid - $ArDescription - Connected to the POP3 server '$server'");

		if(($error=$pop3->Login($user,$password,$apop))=="")
		{
			if ($debugIt>1)
				logMessage("BounceHandler (".__LINE__.") User '$user' logged in.");
			if(($error=$pop3->Statistics($messages,$size))=="")
			{
				//echo "<PRE>There are $messages messages in the mail box with a total of $size bytes.</PRE>\n";
				$result=$pop3->ListMessages("",0);
				$Pattern="^From:.+MAILER-DAEMON@.*";
				if(GetType($result)=="array")
				{
					if($messages>0)
					{
						for($MsgNo=1;$MsgNo<=$messages;$MsgNo++)
						{
							if(($error=$pop3->RetrieveMessage($MsgNo,$headers,$body,-1))=="")// -1 = entire messages
							{	
								for($HdrNo=0; $HdrNo<count($headers);$HdrNo++)
								{
									if(eregi($Pattern, $headers[$HdrNo]))
									{
										//echo "<PRE>regular expression match: Msg No. $MsgNo Header[$HdrNo] - ",HtmlSpecialChars($headers[$HdrNo]),"</PRE>\n";
										DetermineBadAddress($pop3, $MsgNo, $body);
										$pop3->must_update = 1;
										break;
									}
									if ($headers[$HdrNo]=="From: postmaster@hotmail.com")
									{		
										//echo "<PRE>hotmail.com match: Msg No. $MsgNo Header[$HdrNo] - ",HtmlSpecialChars($headers[$HdrNo]),"</PRE>\n";
										HotmailBadAddress($pop3, $MsgNo, $body[10]);
										$pop3->must_update = 1;
										break;
									}
								}
							
								if($HdrNo >= count($headers)) //if message not standard format...
								{
									for($line=0;$line<count($headers);$line++)
									{
										if ($debugIt>0)
											logMessage("BounceHandler (".__LINE__.") Msg No. $MsgNo Header[$line] - ".phplSpecialChars($headers[$line]));
										$H = strtolower(HtmlSpecialChars($headers[$line]));
										//print("|$H|<br />");
										if (substr($H,0,5) == "from:")
											print("Deleting Bad Email: ".substr($H,6,66)."<br/>");
									}	
									/*
									for($line=0;$line<count($body);$line++)
										if ($debugIt>0)
											logMessage("BounceHandler (".__LINE__.") Msg No. $MsgNo Message[$line]  - ".phplSpecialChars($body[$line]));
									*/

									if(($error=$pop3->DeleteMessage($MsgNo))=="")
									{
										if ($debugIt>0)
											logMessage("BounceHandler (".__LINE__.") Marked message ",$MsgNo," for deletion.");
										UpdateDB($BadAddr);
										$pop3->must_update = 1;
									}
								}
							}
						}
					}
					
					if($error==""
					&& ($error=$pop3->Close())=="")
						if ($debugIt>1)
							logMessage("BounceHandler (".__LINE__.") Disconnected from the POP3 server ".$pop3->hostname);
				}
				else
					$error=$result;
			}
		}
	}

	if($error!="")
	{
		echo "<H2>Error: ",HtmlSpecialChars($error),"</H2>";
		break;
	}
}
?>
<script type="text/javascript">
if(confirm("Ok?") == true)
  window.history.go(-1);
</script>
<?php


function HotmailBadAddress($pop3, $MsgNo, $line)
{
	GLOBAL $debugIt;
	
	//echo "<PRE>Msg No. $MsgNo Message[10]  - ",HtmlSpecialChars($line),"</PRE>\n";

	$BadAddr = trim($line);
	//print("Msg No. $MsgNo - Bad email found: $BadAddr<br />");

	if(($error=$pop3->DeleteMessage($MsgNo))=="")
	{
		if ($debugIt>0)
			logMessage("BounceHandler (".__LINE__.") Marked message ",$MsgNo," for deletion.");
		UpdateDB($BadAddr);
		/*
		if(($error=$pop3->ResetDeletedMessages())=="")
		{
			//echo "<PRE>Reset the list of messages to be deleted.</PRE>\n";
		}
		*/
	}
}


function DetermineBadAddress($pop3, $MsgNo, $body)
{
GLOBAL $debugIt;
	
for($line=0;$line<count($body);$line++)
{
	$Pattern =" \(unrecoverable error\)";
	$Addr = ereg_replace($Pattern, "", trim($body[$line]));

	//echo "<PRE>Msg No. $MsgNo Message[$line]  - ",HtmlSpecialChars($Addr),"</PRE>\n";
	
	  
//5.1.0 - Unknown address error 550-'5.1.1 unknown or illegal alias: jjordan11@midsouth.rr.com'	  
//12345678901234567890123456789012345678901234567890123456789012345678901234567890

	$Pattern="5.1.0 - Unknown address error 550-'5.1.1 unknown or illegal alias: ";

	if(substr($Addr,0,67) == $Pattern)
	{
		$Addr = ereg_replace($Pattern, "<", $Addr);
		$Addr = ereg_replace("'", "", $Addr);
		$Addr = $Addr.">";
		//print("Fixed: ".phplSpecialChars($Addr)."<br />");
	}

//The following message to <carolinaskies@carolina.rr.com> was undeliverable.	
	$Pattern ="(The following message to <)(.*)(> was undeliverable.)";
	$Addr = ereg_replace($Pattern, "\<\\2>", $Addr);
	//print("xxx $Addr<br>");

//Your mail to the following recipients could not be delivered because they are not accepting mail from
//next line is mailbox...

	$Pattern="Your mail to the following recipients could not be delivered because they are not accepting mail from";
	if(stristr($Addr, $Pattern) != false)
		$Addr="\<".$body[$line + 1]."@aol.com>";
	
//<markmorrison@consultant.com>): host
	$Pattern ="(.+)(>\): host)";
	$Addr = ereg_replace($Pattern, "\\1>", $Addr);

	$Addr = trim($Addr);
	$End = strlen($Addr) - 3;
	if (substr($Addr,0,1)=='<')
	{
	  if((substr($Addr,$End+1,2)==">:") || (substr($Addr,$End+2,1)==">"))
	  {
	  	$Pattern="^<?(.*)([>:]+)?$"; //email address matching pattern
		$Replace="\\1";
		$BadAddr=eregi_replace($Pattern, $Replace, $Addr); //strip off and < and or >: from beginning or end of the line containing the email address
	  	$Pattern="(.*)([>:]+)"; //email address matching pattern
		$Replace="\\1";
		$BadAddr=eregi_replace($Pattern, $Replace, $BadAddr); //strip off and < and or >: from beginning or end of the line containing the email address
	  	$Pattern="(.*)([>]+)"; //email address matching pattern
		$Replace="\\1";
		$BadAddr=eregi_replace($Pattern, $Replace, $BadAddr); //strip off and < and or >: from beginning or end of the line containing the email address
		
		print("Deleting Bad Email: $BadAddr<br/>");
		if ($debugIt>0)
			logMessage("BounceHandler (".__LINE__.") DetermineBadAddress() Msg No. $MsgNo - Bad email found: ".phplSpecialChars($BadAddr));

		if(($error=$pop3->DeleteMessage($MsgNo))=="")
		{
		if ($debugIt>0)
			logMessage("BounceHandler (".__LINE__.") Marked message ",$MsgNo," for deletion.");
			UpdateDB($BadAddr);
			/*
			if(($error=$pop3->ResetDeletedMessages())=="")
			{
				//echo "<PRE>Reset the list of messages to be deleted.</PRE>\n";
			}
			*/
		}
		break;
	  }
	}
}
}
function UpdateDB ($BadRecipient)
{
	GLOBAL $debugIt;
	
	//print("BounceHandler (".__LINE__.") Bad Recipient Notice for $BadRecipient<br />\n");
	$SQL_Statement = "select * from users where email='$BadRecipient'";
	$Query_Result = mysql_query($SQL_Statement);
	$NumberOfCampaigns = mysql_num_rows($Query_Result);

	//print("BounceHandler (".__LINE__.") arid: |$arid| for bad email address: $BadRecipient<br />");
	if($NumberOfCampaigns>0)
	{
		$UserRow = mysql_fetch_object($Query_Result);
		$arid=$UserRow->arid; //get arid from user record
		mysql_data_seek($Query_Result, 0);
	
		$FailedUser = mysql_fetch_object($Query_Result); //now we have the user record for delivery failures

		$Query_Update_Message = "update users set currentmsg='253' where email='$BadRecipient'";
		//print("BounceHandler (".__LINE__.") Bad recipient found. User update to occur: |$Query_Update_Message|<br />\n");

		if ($debugIt==2)
		{
			logMessage("BounceHandler (".__LINE__.") Bad recipient found. User update to occur: $Query_Update_Message");
		}
		else
			mysql_query($Query_Update_Message) or die(logMessage("BounceHandler (".__LINE__.") Could not update user record: '$Query_Update_Message'"));
				
		if ($debugIt > 0)
			logMessage("BounceHandler (".__LINE__.") Bad recipient found. $msgid/mailbox $username/password $password Update to occur: $Query_Update_Message<br>");
	}
}

?>