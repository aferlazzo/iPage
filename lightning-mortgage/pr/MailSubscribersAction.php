<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright � Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/




?>
<HTML>
<HEAD>
<TITLE>Mail Subscribers - Perfect Response Mail</TITLE>
<meta name="robots" content="NoIndex, NoFollow">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="./css/PerfectResponse.css">
<script type="text/javascript" src="./js/PerfectResponse.js"></script>
<style type="text/css" media="screen">
th, td {font-family:Verdana, Arial, Helvetica;color:#000080;font-size:8pt;padding:2px 4px;white-space:nowrap;}
</style>
</HEAD>
<body>

<?
	// verify
	
	print("<script type='text/javascript'>if (VerifyAction() == false)\nlocation.href='home2.php';\n"); 
	print("</script>\n");
	
include ("conn.php");
$arid=$_GET['arid'];
$WithinScript = "I know the arid";
include("settings.php");
include("removesettings.php");

$arSQL = "select arid, ardescription, arfromemail from autoresponders where arid=$arid";
$result_ar = mysql_query($arSQL) or die("DisplaySubscribers (".__LINE__.") $arSQL");
$num_rows_ar = mysql_num_rows($result_ar);

mysql_data_seek($result_ar, $count);
$arrow = mysql_fetch_array($result_ar);

$ardescription = $arrow[ardescription];
$EmailAddressFrom = $arrow[arfromemail];
//print("<p>line (".__LINE__.") From Email: $EmailAddressFrom</p>\n");
if ($num_rows_ar == 0)
{
	print ("<font face='Verdana' size='2' color='#000080'>");
	print "<i>Perfect Response</i> Autoresponder '$ardescription' Subscriber List is empty\n";
}
else

// - - - - - - - - - - - - - - - - - - - - - - - - - - -
//
//	ReadSubscribers
//	
// - - - - - - - - - - - - - - - - - - - - - - - - - - -

{

/*
Preparing the lock
~~~~~~~~~~~~~~~~~~
Generate a random number or string to use as the LOCK_KEY. This must be retained by the script 
(php variable $_SESSION['LockKey']) and will be entered into the database shortly.
*/
$_SESSION['LockKey']=rand(1,1000000000);

$MessageBodyTemplate = "<p>Dear %FullName%,</p><p>this is a special message...</p>";

if (false == ($MessageBodyTemplate = file_get_contents('MailSubscribersMessage.php')))
	die("Message file 'MailSubscribersMessage.php' does not exist");
$MessageBody;
$MessageSubject = "This is the subject";
if (false == ($MessageSubject = file_get_contents('MailSubscribersSubject.txt')))
	die("Message Subject file 'MailSubscribersSubject.txt' does not exist");
$MessageSubject = trim($MessageSubject);
	
$Format;
$HTMLBody;
$TextBody;


function PrepareMessage()
{
	//print("<p>MailSubscribers (".__LINE__.") PrepareMessage()</p>\n");
	GLOBAL $debugIt, $MessageBody, $MessageBodyTemplate, $MessageSubject, $Email_Address, $Full_Name;
	GLOBAL $UserDefined1, $UserDefined2, $UserDefined3, $UserDefined4, $Wrap_On, $Mail_Format, $Length_Of_Wrap;
	GLOBAL $Final_Body, $Removal_Link_HTML, $Remove_HTML, $Removal_Link_Text, $Remove_Text, $Body_To_Send;
	GLOBAL $Format, $Mail_Format, $HTMLBody, $Body_To_Send, $TextBody, $arid;
	include("removesettings.php");  //get the 'click to remove' text line at bottom of message
	   	 
	if ($debugIt > 999)
		logMessage ("MailSubscribers&nbsp;&nbsp;(".__LINE__.") Preparing message to send");
	// Replace message personalization (EmailAddress & FullName)
	$MessageBody    = $MessageBodyTemplate; 
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
		die (logMessage ("MailSubscribers&nbsp;&nbsp;(".__LINE__.") no remove link found"));
	$Body_To_Send=$Final_Body;
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
		logMessage ("MailSubscribers&nbsp;&nbsp;(".__LINE__.") Message body is constructed. Time to send.");
	
	//logMessage("MailSubscribers&nbsp;&nbsp;(".__LINE__.") SMTPDebugging |$SMTPDebugging| SMTPTimeout |$SMTPTimeout|");

	$Sent = SwiftMailer($Email_Address, $Full_Name, $MessageSubject, $TextBody, $HTMLBody, $Attachment, $Mail_Format, $arid, $SMTPDebugging, $SMTPTimeout);
	//$Sent=true;	
	//logMessage("MailSubscribers&nbsp;&nbsp;(".__LINE__.") From Email: $EmailAddressFrom<br/>To Email: $Email_Address<br/>name: $Full_Name<br/>subject:$MessageSubject");			

	if ($Sent == false) 
	{
		if ($debugIt > 0)
		{
			logMessage ("MailSubscribers&nbsp;&nbsp;(".__LINE__.") autoresponder GLOBAL settings: \$arid $arid \$Display_Name $Display_Name \$EmailAddressFrom $EmailAddressFrom");
			logMessage ("MailSubscribers&nbsp;&nbsp;(".__LINE__.") \$SMTPmailServer $SMTPmailServer \$SMTPmailbox $SMTPmailbox \$SMTPpassword $SMTPpassword \$SMTPport $SMTPport");
			logMessage ("MailSubscribers&nbsp;&nbsp;(".__LINE__.") \$Wrap_On $Wrap_On \$Length_Of_Wrap $Length_Of_Wrap ");
			logMessage ("MailSubscribers&nbsp;&nbsp;(".__LINE__.") Not sent. email format $Format To: $Full_Name '$Email_Address' Subject: $MessageSubject");
			//logMessage ("MailSubscribers&nbsp;&nbsp;(".__LINE__.") Ending MailSubscribers.php");
		}
		return (false);
	}
	return (true);
} // end 




// first get the SMTP settings from the admin table
$result = mysql_query("SELECT * FROM admin where adminname='admin'", $link);
if($result == false)
{							
	//print("<p>MailSubscribers (".__LINE__.")  Session |". $_SESSION['LockKey']."| No admin row to fetch'</p>");	
	die(logMessage("MailSubscribers&nbsp;&nbsp;(".__LINE__.")  Session |".$_SESSION['LockKey']."| No admin row to fetch"));
}
$num_rows = mysql_num_rows($result); 	
if ($num_rows == 0)
{							
	//print("<p>MailSubscribers (".__LINE__.")  Session |". $_SESSION['LockKey']."| No admin row to found'</p>");	
	die(logMessage("MailSubscribers&nbsp;&nbsp;(".__LINE__.")  Session |".$_SESSION['LockKey']."| No admin row to found"));
}
//mysql_data_seek($result, 0);
$row = mysql_fetch_object($result);
$SMTPDebugging=$row->SMTPDebugging;
$SMTPTimeout=$row->SMTPTimeout;

//logMessage("MailSubscribers&nbsp;&nbsp;(".__LINE__.") SMTPDebugging |$SMTPDebugging| SMTPTimeout |$SMTPTimeout|");


	//print ("Exporting Subscribers for \$arid $arid<br>");
	set_time_limit(0);

	$Mail_Error_Flag = 1;
	
	$SQL_Statement = "select * from users where arid=$arid and currentmsg<253 order by fname";
	
	$Query_Result = mysql_query($SQL_Statement,$link) or die ("DisplaySubscribers (".__LINE__.") $SQL_Statement:<br />".mysql_error($link));
	$num_rows_usr = mysql_num_rows($Query_Result);
	if ($num_rows_usr > 0)
	{
		
		print("<h2>Special Mail To '$ardescription'</h2>\n");
		print("<p>".number_format($num_rows_usr)." Subscribers As Of ".date('l F j, Y g:i A')."</p>\n");
		print("<p>Format: $Mail_Format, arid: $arid, Debug: $SMTPDebugging, Timeout: $SMTPTimeout</p>\n");		
	}
	else
	{
		print ("No Subscribers are stored for Autoresponder '$ardescription'<br>");
	}
	
	//
	// for each user record...
	//	
	for($ucount=0;$ucount<$num_rows_usr;$ucount++)
	{
		mysql_data_seek($Query_Result, $ucount);
		$rowusr 					= mysql_fetch_object($Query_Result);
		$Email_Address 				= $rowusr->email;
		$MessageNumberInSequence 	= $rowusr->currentmsg;
		$Full_Name 					= trim($rowusr->fname." ".$rowusr->lname);
		$UserDefined1				= trim($rowusr->UserDefined1);
		$UserDefined2				= trim($rowusr->UserDefined2);
		$UserDefined3				= trim($rowusr->UserDefined3);
		$UserDefined4				= trim($rowusr->UserDefined4);
		$MsgNumber					= $rowusr->currentmsg;
		$uid						= $rowusr->uid;
		
		if ($UserDefined1 == "")
			$UserDefined1 = "&nbsp;";

		if ($UserDefined2 == "")
			$UserDefined2 = "&nbsp;";
			
		if ($UserDefined3 == "")
			$UserDefined3 = "&nbsp;";
			
		if ($UserDefined4 == "")
			$UserDefined4 = "&nbsp;";

		$ThisTR = $arid."Row".$ucount;
		//print("<p>$Full_Name &lt;$Email_Address&gt;</p>\n");


		//print("<p>MailSubscribers (".__LINE__.") PrepareMessage()</p>\n");
		PrepareMessage();
		SendTheMessage($SMTPDebugging, $SMTPTimeout);
	}
	
	print("</table>\n");	
}
?>
</body>
</html>
