<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright © Tony Ferlazzo 2004
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/

// This script is the form action for import.php (imports users into an autoresponder)

include("check1.php");
include("conn.php");
$arid						= $_POST["arid"];
$hdnActionText		= $_POST["hdnActionText"];
$Auto_Sender			= $_POST["Auto_Sender"];
$CurrentMessae		= $_POST["CurrentMessage"];
$Emails_For_Action	= $_POST["Emails_For_Action"];

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<HTML>
<HEAD>
<TITLE>Perfect Response Import Action</TITLE>
<meta name="robots" content="NoIndex, NoFollow">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="./css/PerfectResponse.css">
</HEAD>
<body>


<div class="content">
<div class="title">
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
if ($hdnActionText == "add")
{


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
	$ar_row = mysql_fetch_object($ar_result);

	$admin_result = mysql_query("SELECT * FROM admin", $link);
	mysql_data_seek($admin_result, 0);
	$row_admin = mysql_fetch_object($admin_result);
	$WithinScript = "I know the arid";
	include("settings.php");
	include("removesettings.php");

	if($Mail_Format == 1)
	{
		$Mail_Header="Content-type: text/html; charset=iso-8859-1";
		$Mail_Footer=$Removal_Link_HTML;
	}
	else
	{
		$Mail_Header="Content-Type: text/plain; charset=us-ascii";
		$Mail_Footer=$Removal_Link_Text;
	}

	set_time_limit(0);

	if (!$Emails_For_Action) //this comes from the textarea box of the form in import.php
	{
		echo "<b>No subscribers added. The form was blank!<BR>Please go <a href ='void(history.back())'>back</a> and try again";

		exit;
	}

	//print ("<Font size='2' face='Verdana'>Importing<br>");
	$Emails_For_Action = trim($Emails_For_Action);
	$lstSplitTareaRemove = split("\n", $Emails_For_Action); //split the text area elements (delimited by \n) and put into a table

	$Count = 0;
	$Emails_For_Action_Count = 0;
	$Mail_Error_Flag = 0;
	$Mail_Dump = 0;

	reset ($lstSplitTareaRemove);
	while (list(, $temp) = each ($lstSplitTareaRemove))
	{

		$Count++;
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
			//if ($debugIt > 0)
			//{
			//	logMessage("  ImportAction (".__LINE__.") importing '$FullName' '$Email_Address' '$UserDefined1' '$UserDefined2' '$UserDefined3' '$UserDefined4'");
			//}
		}

		$Email_Address = trim($Email_Address);
		$Email_Address = strtolower($Email_Address);
		//print("Name: '$FullName' Email Address '$Email_Address' User Defined field1 $UserDefined1' User Defined field2 '$UserDefined2' User Defined field3 '$UserDefined3' User Defined field4 '$UserDefined4'<br>\n");
		//die("ImportAction (".__LINE__.") importing |$FullName|$Email_Address<br>");
		print(".");

		$SQL_Statement = "select count(uid) usrcount from users where arid=$arid";
		$Query_Result = mysql_query($SQL_Statement);
		mysql_data_seek($Query_Result, 0);
		$row = mysql_fetch_object($Query_Result);
		$usercount = $row->usrcount;

		// check for an existing record for the email address

		$SQL_Statement = "select * from users where email='$Email_Address' and arid=$arid";
		$Query_Result = mysql_query($SQL_Statement);


		$num_rows = mysql_num_rows($Query_Result);

		if ( $num_rows > 0 ) //found an existing match
		{
			mysql_data_seek($Query_Result, 0);
			$row = mysql_fetch_object($Query_Result);
			$Check_Email = $row->email;
			$UserDefined1=$row->UserDefined1;
			$UserDefined2=$row->UserDefined2;
			$UserDefined3=$row->UserDefined3;
			$UserDefined4=$row->UserDefined4;
		}

		// 	Get the *signature* message db record

		$msgSQL = "select * from messages where (arid=$arid) and (seqno=0)";
		$result_msg = mysql_query($msgSQL) or die(logMessage("ImportAction (".__LINE__.") Error: $msgSQL"));
		mysql_data_seek($result_msg, 0);  // signature message
		$row_msg = mysql_fetch_object($result_msg);

		if ($row_msg->seqno != 0)
			die(logMessage("ImportAction (".__LINE__.") sequence error"));

		$Signature = $row_msg->body;

		// now get the welcome email for the autoresponder

		$msgSQL = "select * from messages where (arid=$arid) and (seqno=-2)";
		$result_msg = mysql_query($msgSQL) or die("ImportAction (".__LINE__.") Error: $msgSQL");
		mysql_data_seek($result_msg, 0);  // confirmation email
		$row_msg = mysql_fetch_object($result_msg);

		if ($row_msg->seqno != -2)
			die("ImportAction (".__LINE__.") Error: sequence error");

		$Automatic_Subject_Text = $row_msg->subject;
		$Automatic_Message_Text = $row_msg->body. $Signature;

		// now check to ensure the email address is constructed properly

		if (!ereg("^[a-z0-9\._-]+@+[a-z0-9\._-]+\.+[a-z]{2,3}$",$Email_Address))
		{
			$Email_Flag = 0;
			$Mail_Error_Flag++;
		}
		elseif (eregi("([^-\.a-z0-9[:space:]])", $FullName))
		{
			$Email_Flag = 0;
			$Mail_Error_Flag++;
		}
		elseif ($Check_Email == $Email_Address) //already in database
		{
			$Email_Flag = 0;
			$Mail_Dump++;
		}
		else
		{
			$Email_Flag = 1;
		}

		if ($Email_Flag == 1) // looks like a valid import, so add user to autoresponder database
		{
			if ($debugIt > 0)
				logMessage ("ImportAction (".__LINE__.") importing '$FullName' '$Email_Address' '$UserDefined1' '$UserDefined2' '$UserDefined3' '$UserDefined4' to autoresponder $arid");

			$Emails_For_Action_Count++;
			$Send_To = mktime(date("H")-1,date("i"),date("s"),date("m"),date("d")+1,date("Y"));
			$SQL_Statement = "INSERT INTO users (fname,lname,email,ip,method,senddate,confirmed,currentmsg,arid,UserDefined1,UserDefined2,UserDefined3,UserDefined4)
			VALUES ('$FullName','','$Email_Address','Imported',1,'$Send_To','Y',$CurrentMessage,$arid,'$UserDefined1','$UserDefined2','$UserDefined3','$UserDefined4')";
			$Query_Result = mysql_query($SQL_Statement);

			if (!$Query_Result)
			{
				die (mysql_error());
			}


			if ($Auto_Sender == 1 ) //if the imported addresses are to receive 'welcome' email
			{
				$Automatic_Message_Text 	= eregi_replace("%EmailAddress%",$Email_Address,$Automatic_Message_Text);
				$Automatic_Subject_Text 	= eregi_replace("%EmailAddress%",$Email_Address,$Automatic_Subject_Text);
				$Automatic_Message_Text 	= eregi_replace("%FullName%",$FullName,$Automatic_Message_Text);
				$Automatic_Subject_Text 	= eregi_replace("%FullName%",$FullName,$Automatic_Subject_Text);
				$Automatic_Message_Text	= eregi_replace("%UserDefined1%",$UserDefined1,$Automatic_Message_Text);
				$Automatic_Subject_Text 	= eregi_replace("%UserDefined1%",$UserDefined1,$Automatic_Subject_Text);
				$Automatic_Message_Text 	= eregi_replace("%UserDefined2%",$UserDefined2,$Automatic_Message_Text);
				$Automatic_Subject_Text 	= eregi_replace("%UserDefined2%",$UserDefined2,$Automatic_Subject_Text);
				$Automatic_Message_Text 	= eregi_replace("%UserDefined3%",$UserDefined3,$Automatic_Message_Text);
				$Automatic_Subject_Text 	= eregi_replace("%UserDefined3%",$UserDefined3,$Automatic_Subject_Text);
				$Automatic_Message_Text 	= eregi_replace("%UserDefined4%",$UserDefined4,$Automatic_Message_Text);
				$Automatic_Subject_Text 	= eregi_replace("%UserDefined4%",$UserDefined4,$Automatic_Subject_Text);

				if (($Wrap_On == 1)  && ($Mail_Format == 0))
				{
					$Automatic_Message_Text = wordwrap($Automatic_Message_Text, $Length_Of_Wrap);
				}

				$Automatic_Message_Text = eregi_replace("\r\n","\n",$Automatic_Message_Text);
				$txtMessage_Send = $Automatic_Message_Text;
				$txtMessage_Text = $txtMessage_Send;
				$txtMessage_Body = stripslashes($txtMessage_Text);
				$txtMessage_Subject = stripslashes($Automatic_Subject_Text);


				//Append the removal instructions and the removal instructions lines to *every* message body

				if($Mail_Format == 1)
				{
					$Final_Body.="$txtMessage_Body<br><br>$Remove_HTML<br>$Removal_Link_HTML.$Email_Address'>$Remove_HTML";
					if ($Ad != 45)
						$Final_Body.=$PoweredbyHTML;
				}
				else
				{
					$Final_Body=$txtMessage_Body."\n\n".$Remove_Text." ".$Removal_Link_Text.$Email_Address;

					if ($Ad != 45)
						$Final_Body.=$PoweredbyText;
				}

				if (!isset($Removal_Link_Text))
					die (logMessage ("mailout (".__LINE__.") no remove link found"));

				//die (logMessage("mailout: \$Remove_Text |$Remove_Text|\n\$Removal_Link_Text |$Removal_Link_Text.$Email_Address|\n\$PoweredbyText |$PoweredbyText|"));

				$directory=dirname(__FILE__);

         		if (stristr($directory, "demo"))
         		{
					if ($debugIt > 0)
					{
						logMessage ("ImportAction (".__LINE__.") ***Beta Test*** Not sending email To: ".$FullName."<".$Email_Address."> Subject: ".$txtNew_Subject." From: ".$EmailAddressFrom);
					}
				}
				else
				{
					$txtMessage_Subject = addslashes($txtMessage_Subject);
					$Final_Body = addslashes($Final_Body);

					//print("Ready to send to $Email_Address<br>");
					//print("$FullName|$txtMessage_Subject|$Final_Body|<br>");
					//print("ImportAction (".__LINE__.") importing |$FullName|$Email_Address<br>");

					$Sent = phpmailer($Email_Address, $FullName, $txtMessage_Subject, $Final_Body, $HTMLBody, $Attachment, $Mail_Format);

					//die ("Sent to $Email_Address<br>");
					if ($debugIt > 0)
						if ($Sent == true)
							logMessage ("ImportAction (".__LINE__.") sending 'welcome' email of mail campaign ".$arid." to ".$FullName."<".$Email_Address.">");
						else
							logMessage ("ImportAction (".__LINE__.") Error: Not sent: 'welcome' email of mail campaign ".$arid." to ".$FullName."<".$Email_Address.">");
				}
			}
		}
		else
		{
			print ("<br>*** Error *** '$Email_Address' already in database,<br>or either '$Email_Address' or '$FullName' contain invalid characters. Not added.<br>\n");
		}

		flush();
		ob_flush();
		sleep(1);
	}	//end of while
}	//end of action==add

//print ("import done<br>");


print("<br><b>Import Propects: Results</b><br>\n");
print("<b>$Emails_For_Action_Count</b> NEW subscribers were added.<BR>\n");
print("<b>$Mail_Dump</b> EXISTING subscribers were already in your database.<br>\n");
print("<b>$Mail_Error_Flag</b> WERE NOT ADDED due to invalid characters.<br>\n");
print "<BR><BR>\n";
//print "<form><input class='cancel' type='button' value='Continue' onClick=\"javascript:window.location.href='CampaignManager.php?arid=$arid'\"></form>\n";
?>

<script language='Javascript1.2'>
if (window.history.length < 2)
{
	document.write("<form>");
	document.write("<input class='submit' type='button' value='Close' onClick='window.close();'>");
	/*document.write("</form>");*/
}
else
{
	document.write("<form>");
	document.write("<input class='submit' type='button' value='Continue' onClick='window.location.href=\"CampaignManager.php?arid=<?php echo $arid ?>\"'>");
	/*document.write("</form>");*/
}

<?php
if (($Mail_Dump > 0) || ($Mail_Error_Flag > 0))
{
?>
	if (window.history.length > 1)
	{
		/*document.write("<form>");*/
		document.write("&nbsp;&nbsp;<input class='cancel' type='button' value='Back' onClick='void(history.go(-1))'>");
	}

	document.write("</form>");
<?php
}
?>
</script>
		</td>
	</tr>
</TABLE>
</body>
</html>
