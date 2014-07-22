<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright © Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/

$Is_Remove=1;
$Installation_Path="http://www.lightning-mortgage.com/pr";
$Removal_Link_Text = "\n$Installation_Path/us.php?arid=$arid&RE=";
$Removal_Link_HTML = "<br><br><a href='$Installation_Path/us.php?arid=$arid&RE=";
$PoweredbyHTML="<br><br><a href='http://www.perfectresponse.com'></a>";
$PoweredbyText="\n\nPowered by <i>Perfect Response</i>, Email Marketing At Its Best! (http://www.perfectresponse.com). Remove this message by registering this copy.";

if (!function_exists(UnsubscriptionNotification))
{
	function UnsubscriptionNotification($Full_Name, $Email_Address, $arid, $CampaignDescription, $MessageToBeSent, $link)
	{
		GLOBAL $Notification, $debugIt, $EmailAddressFrom;
		
		// first get the SMTP settings from the admin table
		$AdminQuery = "SELECT * FROM admin where adminname='admin'";
		$result = mysql_query("$AdminQuery", $link);
		if($result == false)							
			die(logMessage("removesettings (".__LINE__.")  Session |".$_SESSION['LockKey']."| No admin row to fetch |$AdminQuery|"));

		$num_rows = mysql_num_rows($result); 	
		if ($num_rows == 0)						
			die(logMessage("removesettings(".__LINE__.")  Session |".$_SESSION['LockKey']."| No admin row to found"));

		$row = mysql_fetch_object($result);
		$SMTPDebugging=$row->SMTPDebugging;
		$SMTPTimeout=$row->SMTPTimeout;

		$MsgBody  = "Name: $Full_Name\nEmail: $Email_Address\nUnsubscribed from mail campaign $arid - $CampaignDescription, before message $MessageToBeSent could be sent.";
		$MsgBody .= "\n\nI remain,\n\nYour Perfect Response, always making your life simpler\n";
		phpmailer("$Notification", "Admin", "$Full_Name - $Email_Address removed from '$CampaignDescription'",  "$MsgBody",  "$MsgBody", "", "0", "0", $SMTPDebugging, $SMTPTimeout);
	/*
		if($debugIt > 0)
			logMessage ("removesettings (".__LINE__.") notified $Notification that Email: $Email_Address was removed from '$CampaignDescription'");	
	*/
	}
}	

?>