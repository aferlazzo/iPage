<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright © Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/

$_SESSION['LockKey'] = "us.php";
$WithinScript = "I know the arid";
include("conn.php");
$ID=$_GET["arid"];
$arid=$_GET["arid"];
$user="";
$RE=$_GET["RE"];
include("settings.php");
set_time_limit(0);			// don't time-out
ignore_user_abort (TRUE);	//don't abort script even if the user disconnects. Just continue mail delivery.

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<HTML>
<HEAD>
<TITLE>Perfect Response Unsubscribe</TITLE>
<meta name="robots" content="NoIndex, NoFollow">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="./css/PerfectResponse.css">
<link rel="stylesheet" type="text/css" href="./css/niftyCorners.css">
<script type="text/javascript" src="./js/PerfectResponse.js"></script>
<script type="text/javascript" src="./js/nifty.js"></script>
<?php

// first get the SMTP settings from the admin table
$result = mysql_query("SELECT * FROM admin where adminname='admin'", $link);
if($result == false)
{							
	die(logMessage("us.php(".__LINE__.")  Session |".$_SESSION['LockKey']."| No admin row to fetch"));
}

$num_rows = mysql_num_rows($result); 	
if ($num_rows == 0)
{							
	die(logMessage("us.php(".__LINE__.")  Session |".$_SESSION['LockKey']."| No admin row to found"));
}
//mysql_data_seek($result, 0);
$row = mysql_fetch_object($result);
$SMTPDebugging=$row->SMTPDebugging;
$SMTPTimeout=$row->SMTPTimeout;
//logMessage("us (".__LINE__.") SMTPDebugging |$SMTPDebugging| SMTPTimeout |$SMTPTimeout|");
include("removesettings.php");

//logMessage ("us (".__LINE__.") arid |".$arid."| is from command line");
//print("us (".__LINE__.") arid |$arid| is from command line");

	if ($arid==177)
	{
		$arid=2;
		$ID=2;
	}

	if ($ID=="")
	{
		echo "<h1 style='color:#009;font-family : Verdana, Geneva, Arial, Helvetica, sans-serif;'>Unable to find a subscription record for email address $RE<BR>Please contact the <a href ='mailto:$Administrator_EmailAddress'>Administrator</a> if you are experiencing difficulties unsubscribing.</h1>";
		if ($debugIt > 0)
			logMessage ("us (".__LINE__.") Unable to find a subscription record for &lt;$RE&gt; in responder $ID");
		exit;
	}

	if ($RE=="") 
	{
		if ($debugIt > 0)
			logMessage ("us  (".__LINE__.") Unable to find a subscription record. Email address not received.");
		
		print("<h1 style='color:#009;font-family : Verdana, Geneva, Arial, Helvetica, sans-serif;'>Unable to unsubscribe your email address:<br/><br/>$RE</h1>");
		print("<form method='get' action='us.php'><input type='hidden' name='arid' value='$arid'>\n");
		print("<input type='hidden' name='ra' value='$arid'>\n");
		print("<p style='color:#009;font-family : Verdana, Geneva, Arial, Helvetica, sans-serif;'>Enter your email address to unsubscribe: <input type='text' name='RE' value='$RE' style='width:250px;'>\n");
		print("<input type='submit' value='Remove'></p></form>\n");
				
		exit;
	}

	// get the user record requesting deletion
	
	$result = mysql_query("SELECT * FROM users where arid=$ID AND email='$RE'", $link); 	
	$num_rows = mysql_num_rows($result);
	
	if ($num_rows<=0) 
	{
		if ($debugIt > 0)
			logMessage ("us: (".__LINE__.") Unable to delete the subscription record from |$RE| in responder |$ID|");		
		
		print("<h1 style='color:#009;font-family : Verdana, Geneva, Arial, Helvetica, sans-serif;'>Unable to unsubscribe the email address:<br/><br/>$RE</h1>");
		print("<form method='get' action='us.php'><input type='hidden' name='arid' value='$arid'>\n");
		print("<input type='hidden' name='ra' value='$arid'>\n");
		print("<p style='color:#009;font-family : Verdana, Geneva, Arial, Helvetica, sans-serif;'>Enter the email address to unsubscribe: <input type='text' name='RE' value='$RE' style='width:250px;'>\n");
		print("<input type='submit' value='Remove'></p></form>\n");
				
		exit;
	}
	
	mysql_data_seek($result, 0);
	$row =  mysql_fetch_object($result);//$row is record from users db

	$MessageToBeSent = $row->currentmsg;
	
	$result_ar = mysql_query("SELECT * FROM autoresponders where arid=$ID", $link); 
	mysql_data_seek($result_ar, 0);
	$row_ar = mysql_fetch_object($result_ar);	

	$ArDescription = $row_ar->ardescription;
	if ($row_ar->armode==99)  	// armode (used to signal 1-step or 2-step opt-in) of 99 is invalid on purpose. 
	{							// This won't get executed since we do not *ever* request a deletion confirmation.
		Header("Location:remove2.php?arid=$ID&RE=$RE&ra=$ID");
		exit;
	}
	else
	{
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
		
	//	If armode != 2 then execute this PHP and HTML code:
	
		$Full_Name = trim($row->fname." ".$row->lname);
		$Full_Name = ucwords($Full_Name);

		$SQL_Statement = "select * from autoresponders where arid=$arid";
		$arResult = mysql_query($SQL_Statement);
		$ar_row = mysql_fetch_object($arResult); //record from autoresponders db
		mysql_data_seek($arResult, 0);
		$Email_Address 			= $RE;
		$EmailAddressFrom 		= $ar_row->arfromemail;
		$EmailAddressReplyTo	= $ar_row->arreplytoemail;
		$Display_Name 			= $ar_row->arname;
		$CampaignDescription	= $ar_row->ardescription;
		$EmailAddressReturn 	= $ar_row->arbademail;
		$OptOutPage 	= $ar_row->custompage;

		$msgSQL = "select * from messages where (arid=$arid) and (seqno=0)"; //signature
		$result_msg = mysql_query($msgSQL) or die(logMessage("us (".__LINE__.") Error: $msgSQL"));
		mysql_data_seek($result_msg, 0);  // signature message
		$row_msg = mysql_fetch_object($result_msg);
			
		if ($row_msg->seqno != 0) 
			die(logMessage("us (".__LINE__.") sequence error"));
				
		$Signature = $row_msg->body;

		$msgSQL = "select * from messages where (arid=$arid) and (seqno=-1)"; //unsubscribe message
		$result_msg = mysql_query($msgSQL) or die(logMessage("us (".__LINE__.") Error: $msgSQL"));
		mysql_data_seek($result_msg, 0);  
		$row_msg = mysql_fetch_object($result_msg);
			
		if ($row_msg->seqno != -1) 
			die(logMessage("us (".__LINE__.") sequence error"));		

		$Remove_Email_Subject = $row_msg->subject;
		$Remove_Email_Body = $row_msg->body.$Signature;	
		
		// insert message personalization

		$Remove_Email_Body 		= eregi_replace("%EmailAddress%",$Email_Address,$Remove_Email_Body);
		$Remove_Email_Subject 	= eregi_replace("%EmailAddress%",$Email_Address,$Remove_Email_Subject);
		$Remove_Email_Body 		= eregi_replace("%FullName%",$Full_Name,$Remove_Email_Body);
		$Remove_Email_Subject 	= eregi_replace("%FullName%",$Full_Name,$Remove_Email_Subject);
		$Remove_Email_Body 		= eregi_replace("%UserDefined1%",$UserDefined1,$Remove_Email_Body);
		$Remove_Email_Subject 	= eregi_replace("%UserDefined1%",$UserDefined1,$Remove_Email_Subject);
		$Remove_Email_Body 		= eregi_replace("%UserDefined2%",$UserDefined2,$Remove_Email_Body);
		$Remove_Email_Subject 	= eregi_replace("%UserDefined2%",$UserDefined2,$Remove_Email_Subject);
		$Remove_Email_Body 		= eregi_replace("%UserDefined3%",$UserDefined3,$Remove_Email_Body);
		$Remove_Email_Subject 	= eregi_replace("%UserDefined3%",$UserDefined3,$Remove_Email_Subject);
		$Remove_Email_Body 		= eregi_replace("%UserDefined4%",$UserDefined4,$Remove_Email_Body);
		$Remove_Email_Subject 	= eregi_replace("%UserDefined4%",$UserDefined4,$Remove_Email_Subject);

		// now adjust the message body
		
		$Wrap_On = $ar_row->arwordwrap;
		$Length_Of_Wrap = $ar_row->arwraplen;

		if (($Wrap_On == 1) && ($Mail_Format == 0))
		{ 
			$Remove_Email_Body = wordwrap($Remove_Email_Body, $Length_Of_Wrap);
		}

		// clean up any message 'artifacts' that may exist so message will display properly in the email
		
		$Remove_Email_Body	= eregi_replace("\r\n","\n",$Remove_Email_Body);	
		$txtMessage_Send	= $Remove_Email_Body;
		$txtMessage_Text	= $txtMessage_Send;
		$txtMessage_Text	= stripslashes($txtMessage_Text);
		$txtMessage_Subject = stripslashes($Remove_Email_Subject);
		$Final_Body			= $txtMessage_Text;
		//Append the removal instructions and the removal instructions lines to *every* message body

		if($Mail_Format == 1)
		{
			if ($Ad != 45)
				$Final_Body.=$PoweredbyHTML;
		}
		else
		{
			if ($Ad != 45)
				$Final_Body.=$PoweredbyText;
		}

		if (!isset($Removal_Link_Text))
			die (logMessage ("us (".__LINE__.") no remove link found"));

		//logMessage("us (".__LINE__.") SMTPDebugging |$SMTPDebugging| SMTPTimeout |$SMTPTimeout|");
		$Sent = SwiftMailer($Email_Address, $Full_Name, $txtMessage_Subject,  "$Final_Body",  "$Final_Body", "", $Mail_Format, $arid, $SMTPDebugging, $SMTPTimeout);
		
		if ($Sent == true)
		{
			UnsubscriptionNotification("$Full_Name", "$Email_Address", $arid, "$CampaignDescription", $MessageToBeSent, $link);
	
			if ($debugIt == 2)
			{
				logMessage ("us (".__LINE__.") Wrap_On: ".$Wrap_On." Length_Of_Wrap: ".$Length_Of_Wrap);
				logMessage ("us Final_Body (wrapped): ".$Final_Body);
			}
		
			// Update the record from the users database. We do not delete unsubscriptions so that those addresses won't 
			// be erroneously added a second time.
		
			//$result = mysql_query("UPDATE users set currentmsg='255' where arid=$ID AND email='$RE'", $link) or die(logMessage("us (".__LINE__.") Could not move pointer to next update user record")); 
			//delete user from all auto responder mailing lists
			$result = mysql_query("UPDATE users set currentmsg='255' where email='$RE'", $link) or die(logMessage("us (".__LINE__.") Could not move pointer to next update user record")); 
		
			$num_rows = mysql_affected_rows();
			if ($debugIt > 0)
				logMessage ("us (".__LINE__.") unsubscribed $Full_Name <$Email_Address> from Autoresponder $ID - $ArDescription and sent confirmation message");

			if ($ID == 146) // if zero down report also unsubscribe user from past success stories (arid 147) 
				$result = mysql_query("UPDATE users set currentmsg='255' where arid=147 AND email='$RE'", $link) or die(logMessage("us (".__LINE__.") Could not move pointer to next update user record")); 
			if ($ID == 147) // if past success storiesalso unsubscribe user from zero down report (arid 146) 
				$result = mysql_query("UPDATE users set currentmsg='255' where arid=146 AND email='$RE'", $link) or die(logMessage("us (".__LINE__.") Could not move pointer to next update user record")); 

			
			// note: closing brace is at end of html code
		}
		
mysql_close($link);
?>
<style type="text/css" media="screen">
p {text-align:left;}
</style>
<script type="text/javascript">
<!--

//-------------------------------
//
//To do rounded corners on the <div id=' contents':
//
//(link rel="stylesheet" type="text/css" href="./css/niftyCorners.css")
//(script type="text/javascript" src="./js/nifty.js"></script)
//
//The function NiftyCheck performs a check for DOM support. If the test has passed,
//the Rounded function is called, that is now the only one function that you should 
//call to get nifty corners. It accepts five parameters, that are in order:
//
//   1. A CSS selector that indicates on wich elements apply the function
//   2. A string that indicates which corners to round: all, top, bottom, etc.
//   3. Outer color of the rounded corners
//   4. Inner color of the rounded corners
//   5. An optional fifth parameter, that will contain the options for Nifty Corners
//
//-------------------------------
window.onload=function(){
if(!NiftyCheck())
    return;
Rounded("div#Wrapper","all","#FFE4C4","#48D1CC","border #000080");
}
//-->
</script>
</HEAD>
<body>
<div id='Wrapper'><div id='content'> 
<div class="title" style='display:block;'> 
<table>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td width="45%"><td>
		<td width="55%"><h2>&nbsp;</h2>
		</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
</table>
</div>
<TABLE BORDER=0 CELLPADDING=4 CELLSPACING=4 align="center">
	<TR>
		<TD>
			<?php	
				if ($num_rows>0)
				{
					//success
					echo "<p>We are sorry to see you leave.</p><p>Your email address '$RE' has been unsubscribed from the mailing list '$row_ar->ardescription.'<BR>Please come back and visit us again. We will be more than happy to welcome you to our list again.</p>";
					echo "<p>You will receive a removal confirmation email from us.</p><p>Please contact us if you continue to receive unwanted communication from us and we will fix the problem.</p>";
				}
				else
				{
					// not found
					echo "We could not remove you from our mailing list '$row_ar->ardescription.'<BR>You may have already unsubscribed from this list.<BR />If you continue to receive messages to this email address after unsubscribing, please contact the list <a href='mailto:$row_ar->aradminemail'>Administrator</a>.";
				}
			?> 
		</td>
	</tr>
</TABLE>
</div></div>
</BODY>
</HTML>
<?php 

if ($OptOutPage != "")
{
print("<script type='text/javascript'>");
print("location.href='$OptOutPage';");
print("</script>");

}
} //closing brace


?>
