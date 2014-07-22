<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright © Tony Ferlazzo 2004 
Version 1.0 Written by: Anthony Ferlazzo, anthony@prontocommercial.com

*/
/*
//path to store variables (required by JustHost)
*/
session_save_path("/home/prontoc2/php"); 
session_start();
	
//print("passed code: ".$_POST['security_code']."<br/>");
//print("session code: ".$_SESSION['security_code']);

	if(($_SESSION['security_code'] == $_POST['security_code']) && (!empty($_SESSION['security_code'])) ) 
	{
		//die("match occured"); 
		unset($_SESSION['security_code']);
	} 
	else 
	{
		print("<h1>Sorry!</h1><p>As a way to conteract malicious web site hacking, we require you to correctly enter the unique security code when filling out this form.</p>");
		die("<p>Click on <a href=\"javascript:window.location.href='http://www.lightning-mortgage.com/Answers/MortgageInsiderSecrets.php';\">Try Another Security Code</a>.</p>");
		//die("<p>Click on <a href=\"javascript:window.history.go(-1);\">Try Another Security Code</a>.</p>");
	}


$_SESSION['LockKey'] = "optin.php";

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<html>
<head>
<title>Insider Secrets Opt-in - Lightning Mortgage</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript">
function SetMyValue (CookieName, Value)
{
var MyDate = new Date();
var Day = MyDate.getDate();
Day = Day + 360; //number of days cookie exists
MyDate.setDate(Day);
var DDate=MyDate.toGMTString();
var Path=escape('/');

var Cook = escape(CookieName);
document.cookie=Cook+'='+Value+'; expires='+DDate+'; Path='+Path;
}

function EnableAccess()
{
SetMyValue('creditletter', 'no'); //don't show the credit secrets signup letter
SetMyValue('letter', 'no'); //don't show the mortgage secrets signup letter
//alert("cookie letter is being set to 'no'");
}
EnableAccess(); 

</script>
</head>

<?php

if ($_SERVER['SERVER_NAME'] == "www.lightning-mortgage.com")
{
	$Installation_Path = "http://www.lightning-mortgage.com/pr";
}
else
if ($_SERVER['SERVER_NAME'] == "www.prontocommercial.com")
{
	$Installation_Path = "http://www.prontocommercial.com/pr";
}
else
	die("No match for Server Name ".$_SERVER['SERVER_NAME']);



$user="";
include("conn.php");
	
if(empty($_GET))
{
	$ID	= $_POST["arid"];
	$arid = $_POST["arid"];
	$Full_Name = addslashes($_POST['Full_Name']);
	$Full_Name = ucwords(strtolower($Full_Name));
	$Email_Address = $_POST['Email_Address'];
	$HumanVerifyID = $_POST['HumanVerifyID'];
	$WithinScript = "I know the arid";
//die("optin received name: $Full_Name");
	include("settings.php");
	include("removesettings.php");

	$RedirectPage = $_POST['redirect'];
	
	$UserDefined1 = addslashes($_POST['UserDefined1']);
	$UserDefined2 = addslashes($_POST['UserDefined2']);
	$UserDefined3 = addslashes($_POST['UserDefined3']);
	$UserDefined4 = addslashes($_POST['UserDefined4']);
}
else  //just for message confirmations
{
	if (isset($_GET['a']) == true)
	{
		$ID				= $_GET["a"];
		$arid			= $_GET["a"];
	}
	else
	{
		$ID				= $_GET["arid"];
		$arid			= $_GET["arid"];
	}
	
	$Full_Name		= 'Error - Already have';
	if (isset($_GET['e']) == true)
		$Email_Address	= $_GET['e'];
	else
		$Email_Address	= $_GET['Email_Address'];
	$WithinScript = "I know the arid";

	include("settings.php");
	include("removesettings.php");

	if (isset($_GET['r']) == true)
		$RedirectPage = $_GET['r'];
	else
		$RedirectPage = $_GET['redirect'];
	$UserDefined1 = 'Error - Already have';
	$UserDefined2 = 'Error - Already have';
	$UserDefined3 = 'Error - Already have';
	$UserDefined4 = 'Error - Already have';
}

// first get the SMTP settings from the admin table
$result = mysql_query("SELECT * FROM admin where adminname='admin'", $link);
if($result == false)
{							
	die(logMessage("optin (".__LINE__.")  Session |".$_SESSION['LockKey']."| No admin row to fetch"));
}

$num_rows = mysql_num_rows($result); 	
if ($num_rows == 0)
{							
	die(logMessage("optin (".__LINE__.")  Session |".$_SESSION['LockKey']."| No admin row to found"));
}
//mysql_data_seek($result, 0);
$row = mysql_fetch_object($result);
$SMTPDebugging=$row->SMTPDebugging;
$SMTPTimeout=$row->SMTPTimeout;
//logMessage("optin (".__LINE__.") SMTPDebugging |$SMTPDebugging| SMTPTimeout |$SMTPTimeout|");


if($RedirectPage == '')
$Is_Custom=0;
else
$Is_Custom=1;


if ($debugIt == 2)
{
	logMessage ("optin (".__LINE__.") \$arid: $arid \$Full_Name: $Full_Name \$Email_Address: $Email_Address \$RedirectPage: $RedirectPage");
	logMessage ("optin (".__LINE__.") \$UserDefined1: '$UserDefined1' \$UserDefined2: '$UserDefined2' \$UserDefined3: '$UserDefined3' \$UserDefined4: '$UserDefined4'");
}

if($Is_Custom==1)
	$GoTo=$RedirectPage;
else
	$GoTo="thankyou.php";
	
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

		
$Email_Flag = 1;  // This means values passed were judged okay. Start this way...
$Email_Address = trim($Email_Address);
$Email_Address = strtolower($Email_Address);

if($Full_Name=="") 
	$Full_Name="Friend";

if (eregi( "([^-\.a-z0-9[:space:]])", $Full_Name) )
{ 
	print ("<br>Names can only contain letters, number, and - or . characters.<br><br>\n"); 
	$Email_Flag = 0; 
}
elseif (!eregi(".+@.+\\..+",$Email_Address))
{ 
	print ("<br>Invalid email address was given. Please make sure your formatting is correct<br><br>\n"); 
	$Email_Flag = 0; 
}
else
{
	list($EmailUser, $EmailDomain) = split("@", $Email_Address);

	if (!getmxrr($EmailDomain, $mxhosts, $weight)) // make sure the domain has an MX record (a mail server)
	{
		print ("<br>Invalid email domain was given: $EmailDomain<br>\n"); 
		$Email_Flag = 0; 
	}
}

//die("<p>optin (".__LINE__.") |$EmailUser|$EmailDomain|</p>");

$RestartIfInDB=0; //default is record is not in DB

// If address is valid, check to see if email is already in db.

if ($Email_Flag == 1) 
{
	if ($debugIt == 2)
		logMessage ("optin (".__LINE__.") entry passed edits");

	$SQL_Statement = "select * from users where email='$Email_Address' and arid=$arid";
	$Query_Result =  mysql_query($SQL_Statement, $link) or die ("db query failed: ". mysql_error($link));
//	$Query_Result_Data = @MYSQL_FETCH_ARRAY($Query_Result);
	
	$Confirmed = '?';
	$Check_Email = ''; // Start at this point: no record in database, so there's no email address in the db. Good.

	//print ("$SQL_Statement<br>Query_Result");
	$num_rows = mysql_num_rows($Query_Result); 	
	
	if ($num_rows > 0)	//There's a record in the db
	{
		if(!mysql_data_seek($Query_Result, 0))  // set pointer to the first record
		{
			die ("Cannot seek to row 0: ".mysql_error($link));
		}
		
		$RestartIfInDB=1;
		$row = mysql_fetch_object($Query_Result);
		$Confirmed = $row->confirmed;  // will be 'Y' or 'N' in database
		
		if ($Confirmed == 'N') // if in database for an 2-step opt-in then gather the fields
		{
			$Full_Name = $row->fname;
			$UserDefined1 = $row->UserDefined1;
			$UserDefined2 = $row->UserDefined2;
			$UserDefined3 = $row->UserDefined3;
			$UserDefined4 = $row->UserDefined4;
		}

			
		$Check_Email = $row->email;	// if email address was found in db, copy the email address from the db
		$CurrentMsg = $row->currentmsg;
		$What_Address = $row->ip;	// copy the ip address, too

		if ($debugIt == 2)
			logMessage (" optin (".__LINE__.") user is already in db: Email: $Check_Email Confirmed: $Confirmed");
	}

//die("<p>optin (".__LINE__.") |Attempting to send: $Full_Name|$Email_Address|</p>");
	
	// get the autoresponder's name, admin's email, and opt-in mode
	
	$result_ar = mysql_query("SELECT * FROM autoresponders where arid=$arid", $link); 
	mysql_data_seek($result_ar, 0);
	$row_ar = mysql_fetch_object($result_ar);
	$Display_Name	= $row_ar->arname;
	$armode 		= $row_ar->armode;
	//$RedirectPage	= $row_ar->custompage;
	$CampaignState	= $row_ar->CampaignState;

	if($Is_Custom==1)
		$GoTo=$RedirectPage;
	else
		$GoTo="$Installation_Path/thankyou.php";
	
	if ($debugIt == 2)
		logMessage ("optin (".__LINE__.") \$arid: $arid \$row_ar->arname: '$row_ar->arname' \$row_ar->armode: '$row_ar->armode' \$row_ar->aradminemail: $row_ar->aradminemail send to \$Email_Address: $Email_Address");
	
	// 	Get the *signature* message db record 
	
	$msgSQL = "select * from messages where (arid=$arid) and (seqno=0)";
	$result_msg = mysql_query($msgSQL) or die(logMessage("optin (".__LINE__.") Error: $msgSQL"));
	mysql_data_seek($result_msg, 0);  // signature message
	$row_msg = mysql_fetch_object($result_msg);
		
	if ($row_msg->seqno != 0) 
		die(logMessage("optin (".__LINE__.") sequence error"));
			
	$Signature = $row_msg->body;
	
	
	
	if (($armode==1) || ($Confirmed=='N')) //1-step sign-up or a 2-step that is not yet confirmed but already entered into db
		$msgSQL = "select * from messages where (arid=$arid) and (seqno=-2)";
	else // 2-step confirmation
		$msgSQL = "select * from messages where (arid=$arid) and (seqno=-3)";
		
	$result_msg = mysql_query($msgSQL) or die(logMessage("optin (".__LINE__.") Error: $msgSQL"));
	mysql_data_seek($result_msg, 0); 
	$row_msg = mysql_fetch_object($result_msg);
	
	$Automatic_Subject_Text = $row_msg->subject;
/*
print("-----------<br />");
print("Message body:<br />$row_msg->body<br />");
print("-----------<br />");
print("Message Signature:<br /><pre>$Signature</pre><br />");
print("-----------<br />");
*/
	if ($row_msg->seqno==-3) //2-step sign-up that is not yet confirmed but already entered into db
		$Automatic_Message_Text = $row_msg->body;
	else // 2-step confirmation
		$Automatic_Message_Text = $row_msg->body.$Signature;

	// if we don't have a db duplicate, and we do have an Email address from the user...
	
	// First check to see if $Check_Email does not have an address from the db,  or if in db 
	// is not yet a confirmed subscriber. Execute if so 
	
//die("<p>optin (".__LINE__.") |Attempting to send: $Full_Name|$Email_Address|$Check_Email|$Confirmed|$CurrentMsg|</p>");
	
	if (($Check_Email=='') || ($Confirmed=='N') || ($CurrentMsg == 255)) 
	{
		$IP_Address = getenv("REMOTE_ADDR");	// capture the user's IP address
		
		//$Send_Time = mktime(date("H")-1,date("i"),date("s"),date("m"),date("d")+1,date("Y"),1); // record the date to send 1st message (welcome message sent immediately)

		// Now get the delay until msg 1 is sent
	  	$msgSQL = "select * from messages where (arid=$arid) and (seqno=1)";
  		$resultMsg = mysql_query($msgSQL, $link) or die("optin.php (".__LINE__.") Error: $msgSQL");
	  	mysql_data_seek($resultMsg, 0);  
  		$rowMsg = mysql_fetch_object($resultMsg);
  	
	  	$DelayToSend = $rowMsg->delay;	

		$Send_Time = mktime(1,0,0,date("m"),(date("d")+$DelayToSend),date("Y")); // record the date (1:00:00 am today) to send the welcome message
		
		if($armode==2) 
		{
			if ($Confirmed == '?') // if a 2-step opt-in add to db but set confirm address to 'N' for 'not yet confirmed'
			{
				if ($RestartIfInDB == 1)
				{
					$SQL_Statement = "UPDATE users set fname='$Full_Name', currentmsg=1 where arid=$ID and email='$Email_Address'";
				}
				else
				{		
					//the message number  - 2 is the welcome message	
					$SQL_Statement = "INSERT INTO users (fname,lname,email,ip,method,senddate,confirmed,currentmsg,arid,UserDefined1,UserDefined2,UserDefined3,UserDefined4) VALUES ('$Full_Name','','$Email_Address','$IP_Address',2,'$Send_Time','N',-2,$ID,'$UserDefined1','$UserDefined2','$UserDefined3','$UserDefined4')";
					if ($ID == 146)
					{
					 $Query_Result =  mysql_query($SQL_Statement);
					 if ($Query_Result != FALSE) // if zero down report also send past success stories (arid 147)
						$SQL_Statement = "INSERT INTO users (fname,lname,email,ip,method,senddate,confirmed,currentmsg,arid,UserDefined1,UserDefined2,UserDefined3,UserDefined4) VALUES ('$Full_Name','','$Email_Address','$IP_Address',2,'$Send_Time','N',-2,147,'$UserDefined1','$UserDefined2','$UserDefined3','$UserDefined4')";
					}
				}

				$Confirmed = 'N';
				
				if ($debugIt == 2)
					logMessage ("optin (".__LINE__.") added, but not confirmed, $Full_Name <$Email_Address> to Autoresponder $ID");
			}
			else
			{
				if ($Confirmed == 'N')	// if a 2-step opt-in, update db and set confirm address to 'Y' for 'confirmed'
				{
					$SQL_Statement = "UPDATE users set confirmed='Y' where arid=$ID and email='$Email_Address'";
					$Confirmed = 'Y';
?>
<script type="text/javascript">
//alert("2 step signup");
EnableAccess(); 
</script>
<?php			
					
					if ($debugIt == 2)
						logMessage ("optin (".__LINE__.") confirming, $Full_Name <$Email_Address> to Autoresponder $ID");
				}
			}
			
		}
		else	// if 1-step opt-in, then just add user and mark it confirmed='Y'
		{
//die("<p>optin (".__LINE__.") |Attempting to send: $Full_Name|$Email_Address|$RestartInInDB|</p>");
		
			if ($RestartIfInDB == 1)
				$SQL_Statement = "UPDATE users set fname='$Full_Name', currentmsg=1 where arid=$ID and email='$Email_Address'";
			else
			{
				$SQL_Statement = "INSERT INTO users (fname,lname,email,ip,method,senddate,confirmed,currentmsg,arid,UserDefined1,UserDefined2,UserDefined3,UserDefined4) VALUES ('$Full_Name','','$Email_Address','$IP_Address',2,'$Send_Time','Y',1,$ID,'$UserDefined1','$UserDefined2','$UserDefined3','$UserDefined4')";
				$Confirmed='Y';
?>
<script type="text/javascript">
//alert("1 step signup");
EnableAccess(); 
</script>
<?php			
				if ($ID == 146)
				{				
				 $Query_Result =  mysql_query($SQL_Statement);
				 if ($Query_Result != FALSE) // if zero down report also send past success stories (arid 147)
					$SQL_Statement = "INSERT INTO users (fname,lname,email,ip,method,senddate,confirmed,currentmsg,arid,UserDefined1,UserDefined2,UserDefined3,UserDefined4) VALUES ('$Full_Name','','$Email_Address','$IP_Address',2,'$Send_Time','Y',1,147,'$UserDefined1','$UserDefined2','$UserDefined3','$UserDefined4')";
				}
			}
			if ($debugIt > 0)
				logMessage ("optin (".__LINE__.") subscribing $Full_Name <".$Email_Address."> to mail campaign $ID");
		}
		
		$Query_Result =  mysql_query($SQL_Statement);
		
		if (!$Query_Result)
		{
			logMessage("optin (".__LINE__.") **ERROR** could not insert/update user: $SQL_Statement");
			die ("<b>Unable to add you. Possible server error. If problem persists please contact this web site's administrator/owner for help.<BR>Please go <a href ='void(history.back())'>back</a> and try again");
			
		}
		else
		{
			if ($debugIt == 2)
				logMessage ("optin (".__LINE__.") inserted \$Email_Address: $Email_Address into users db");
		}
			
		//die ("Welcome message: |$Automatic_Message_Text| arid |$ID| arname |$Display_Name|");
		
		if ($Automatic_Message_Text == "")
			$HaveMsg = 0;
		else
			$HaveMsg = 1;
		
// added the 'trim' to fix personalization 'FullName' trailing space 12-31-03 - Tony Ferlazzo
// capitalized the first letter of each word 1-4-04 - Tony Ferlazzo

		$xxx = strtolower(trim($Full_Name));
		$Full_Name = ucwords($xxx);		
		$ConfirmURL = $Installation_Path."/optin.php?arid=".$arid."&redirect=../CreditScores.php&Email_Address=".$Email_Address;
		//die("ConfirmURL |$ConfirmURL|");
		
		//save this file to server and run a test		
		
		$Automatic_Message_Text = eregi_replace("%EmailAddress%",$Email_Address,$Automatic_Message_Text);
		$Automatic_Subject_Text = eregi_replace("%EmailAddress%",$Email_Address,$Automatic_Subject_Text);
		$Automatic_Message_Text = eregi_replace("%FullName%",$Full_Name,$Automatic_Message_Text);
		$Automatic_Subject_Text = eregi_replace("%FullName%",$Full_Name,$Automatic_Subject_Text);
		$Automatic_Message_Text = eregi_replace("%UserDefined1%",$UserDefined1,$Automatic_Message_Text);
		$Automatic_Subject_Text = eregi_replace("%UserDefined1%",$UserDefined1,$Automatic_Subject_Text);
		$Automatic_Message_Text = eregi_replace("%UserDefined2%",$UserDefined2,$Automatic_Message_Text);
		$Automatic_Subject_Text = eregi_replace("%UserDefined2%",$UserDefined2,$Automatic_Subject_Text);
		$Automatic_Message_Text = eregi_replace("%UserDefined3%",$UserDefined3,$Automatic_Message_Text);
		$Automatic_Subject_Text = eregi_replace("%UserDefined3%",$UserDefined3,$Automatic_Subject_Text);
		$Automatic_Message_Text = eregi_replace("%UserDefined4%",$UserDefined4,$Automatic_Message_Text);
		$Automatic_Subject_Text = eregi_replace("%UserDefined4%",$UserDefined4,$Automatic_Subject_Text);		

		$Automatic_Message_Text = eregi_replace("%Confirmation%",$ConfirmURL,$Automatic_Message_Text);		
		
		if (($Wrap_On == 1) && ($Mail_Format == 0))
		{ 
			$Automatic_Message_Text = wordwrap($Automatic_Message_Text, $Length_Of_Wrap);
		}
		
		//die ("optin \$Wrap_On $Wrap_On, \$Length_Of_Wrap $Length_Of_Wrap");
		
		$Automatic_Message_Text = eregi_replace("\r\n","\n",$Automatic_Message_Text);
		
		$txtMessage_Send = $Automatic_Message_Text;
		$txtMessage_Text = $txtMessage_Send; 
		
		$txtMessage_Body = stripslashes($txtMessage_Text);
		$txtMessage_Subject = stripslashes($Automatic_Subject_Text);
		
		if ($debugIt == 2)
			logMessage ("optin (".__LINE__.") Now Adding footers. armode $armode Mail_Format $Mail_Format");
		
		if($armode==2)  //if 2-step opt-in
		{
			if ($Confirmed == 'N')
			{
				if($Mail_Format == 1) // if html
					$txtMessage_Body.="<br><a href='$Installation_Path/optin.php?arid=$arid&Email_Address=$Email_Address'>Click the here to confirm your subscription</a><br>";				
				else
				{
				
$txtMessage_Body.="\nClick this link (or paste it in your browser address bar) to CONFIRM your subscription\n";
$txtMessage_Body.="\n$Installation_Path/optin.php?a=".$arid."&r=/&e=".$Email_Address."\n";
$txtMessage_Body.="\nIt's fast and easy!  If you cannot click the ";
$txtMessage_Body.="full URL above please copy and paste it into your web ";
$txtMessage_Body.="browser.\n\nAgain, if you do not want to subscribe, simply ignore this message.\n\n";
				}

			}
			else
			{
				if ($debugIt == 2)
					logMessage ("optin (".__LINE__.") Has user confirmed? \$Confirmed $Confirmed");
			}
		}

	if ($row_msg->seqno == -3) //do not add signature to a 2-step sign-up message
	{
		$Final_Body="$txtMessage_Body";
	}
	else //1-step sign-up or a 2-step that is not yet confirmed but already entered into db
	{
		//Append the removal instructions and the removal instructions lines to *every* message body
		
		if($Mail_Format == 1) //if HTML
		{
			$Final_Body="$txtMessage_Body<br><br>$Remove_HTML<br>$Removal_Link_HTML$Email_Address'>$Remove_Text</a>";
			if ($Ad != 45)
				$Final_Body.=$PoweredbyHTML;
		}
		else
		{
			$Final_Body=$txtMessage_Body."\n\n".$Remove_Text."\n".$Removal_Link_Text.$Email_Address;
			// die	("optin (".__LINE__.") \$Ad='$Ad'");
			if ($Ad != 45)
				$Final_Body.=$PoweredbyText;
		}
	}
		//die ("mailout (".__LINE__.") \$Remove_Text $Remove_Text<br>\$Removal_Link_HTML $Removal_Link_HTML<br>\$Remove_HTML $Remove_HTML<br>\$Removal_Link_HTML2 $Removal_Link_HTML2");	
		
		if ($HaveMsg == 1)
		{
			if ($debugIt == 2)
			{
				logMessage("optin(".__LINE__.") simulating mail to |$Email_Address| '$txtMessage_Subject' MsgBody |$Final_Body| From: '$Display_Name' $EmailAddressFrom Reply-To: $EmailAddressReplyTo Return-Path: $EmailAddressReturn Errors-To: $EmailAddressReturn $Mail_Header");
			}
			else
			{
				$directory=dirname(__FILE__);
					
                if (stristr($directory, "demo"))
                {
					if ($debugIt > 0)
					{
						logMessage ("optin ".__LINE__." ***Beta Test*** Not sending email To: ".$Full_Name."<".$Email_Address."> Subject: ".$txtNew_Subject." From: ".$EmailAddressFrom);
					}
						
				}
				else
				{	
					if ($CampaignState == "Active")
					{
						logMessage("optin (".__LINE__.") $Email_Address", "$txtMessage_Subject", "$Final_Body",
						"From: $Display_Name <$EmailAddressFrom>\nReply-To: <$EmailAddressReplyTo>\nReturn-Path: <$EmailAddressReturn>\nErrors-To: <$EmailAddressReturn>");
						logMessage("optin (".__LINE__.") Attempting to send: $Full_Name|$Email_Address|");
					}
					
					if($Mail_Format == 1)
						SwiftMailer($Email_Address, $Full_Name, $txtMessage_Subject,  "",  "$Final_Body", "", $Mail_Format, $arid, $SMTPDebugging, $SMTPTimeout);
					else	
						SwiftMailer($Email_Address, $Full_Name, $txtMessage_Subject,  "$Final_Body",  "", "", $Mail_Format, $arid, $SMTPDebugging, $SMTPTimeout);

					if ($debugIt > 0)
						if ($CampaignState == "Active")
							logMessage("optin(".__LINE__.") Subscribed and mailed to $Email_Address '$txtMessage_Subject'");
						else
							logMessage("optin(".__LINE__.") Subscribed but not mailed to $Email_Address '$txtMessage_Subject'");

					if ($Confirmed =='Y')
					{	// in settings.php
						NotifyOfAdd("$Full_Name", "$Email_Address", $arid, "$CampaignDescription", $SMTPDebugging, $SMTPTimeout);
					}
					else
						if ($debugIt > 0)
							logMessage("optin(".__LINE__.") Did step 1 of 2-step opt-in to $Email_Address '$txtMessage_Subject'");
				}
			}
?>
<script type="text/javascript">
//alert("x Going to: "+"<? echo $GoTo ?>");
window.location.href="<? echo $GoTo ?>";
</script>
<?php
		}
		else
		{
			if ($debugIt == 2)
				logMessage ("optin (".__LINE__.") empty confirmation body for autoresponder $ID. Nothing sent to $Email_Address");
		}
				
	} 
	else
	{
		if ($debugIt == 2)
		 	logMessage ("optin (".__LINE__.") Ending without send");
	
	}
?>
<script type="text/javascript">
//alert("xx Going to: "+"<? echo $GoTo ?>");
window.location.href="<? echo $GoTo ?>";
</script>
<?php
}
?>
<script type="text/javascript">
//alert("xxx Going to: "+"<? echo $GoTo ?>");
window.location.href="<? echo $GoTo ?>";
</script>
<?php
?>
<body>
</body>
</html>
