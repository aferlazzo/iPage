<?php
/*
//path to store variables (required by JustHost)
*/
session_save_path("/home/prontoc2/php");
session_start();

//Simple mail function with HTML header
function sendmail($to, $cc, $subject, $message, $from, $replyto)
{
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
	$headers .= 'From: ' . $from . "\r\n";
	$headers .= 'Cc: ' . $cc . "\r\n";
	$headers .= 'Reply-To: ' . $replyto . "\r\n";

	$sent = mail($to,$subject,$message,$headers);

	if ($sent == true)
		return('1');
	else
		return('Error - not sent');
}

if(count($_GET) > 0)
{
	$Principal					= $_GET['Principal'];
	$Passport				= $_GET['Passport'];
	$Expiration				= $_GET['Expiration'];
	$DOB						= $_GET['DOB'];
	$Address					= $_GET['Address'];
	$City						= $_GET['City'];
	$State						= $_GET['State'];
	$Country					= $_GET['Country'];
	$Phone1					= $_GET['Phone1'];
	$Phone2					= $_GET['Phone2'];
	$Email						= $_GET['Email'];
	$BankName				= $_GET['BankName'];
	$BankAddress			= $_GET['BankAddress'];
	$Swift						= $_GET['Swift'];
	$OfficerName			= $_GET['OfficerName'];
	$bPhone					= $_GET['bPhone'];
	$bFax						= $_GET['bFax'];
	$beName					= $_GET['beName'];
	$AccountNumber		= $_GET['AccountNumber'];
	$Routing					= $_GET['Routing'];
	$AccountName			= $_GET['AccountName'];
	$AccountSignatory	= $_GET['AccountSignatory'];
	$cStructure				= $_GET['cStructure'];
	$cName					= $_GET['cName'];
	$cType						= $_GET['cType'];
	$cAddress				= $_GET['cAddress'];
	$cCity						= $_GET['cCity'];
	$cState					= $_GET['cState'];
	$cCountry				= $_GET['cCountry'];
	$cPhone					= $_GET['cPhone'];
	$cFax						= $_GET['cFax'];
	$pIncorp					= $_GET['pIncorp'];
	$dIncorp					= $_GET['dIncorp'];
	$ID							= $_GET['ID'];
	$Category				= $_GET['Category'];
	$Amount					= $_GET['Amount'];
	$Term						= $_GET['Term'];
	$DesiredClose			= $_GET['DesiredClose'];
	$Top25					= $_GET['Top25'];
	$DesiredBank			= $_GET['DesiredBank'];
	$MessageType			= $_GET['MessageType'];
	$instrumentUse		= $_GET['instrumentUse'];
}
else
{
	$Principal					= $_POST['Principal'];
	$Passport				= $_POST['Passport'];
	$Expiration				= $_POST['Expiration'];
	$DOB						= $_POST['DOB'];
	$Address					= $_POST['Address'];
	$City						= $_POST['City'];
	$State						= $_POST['State'];
	$Country					= $_POST['Country'];
	$Phone1					= $_POST['Phone1'];
	$Phone2					= $_POST['Phone2'];
	$Email						= $_POST['Email'];
	$BankName				= $_POST['BankName'];
	$BankAddress			= $_POST['BankAddress'];
	$Swift						= $_POST['Swift'];
	$OfficerName			= $_POST['OfficerName'];
	$bPhone					= $_POST['bPhone'];
	$bFax						= $_POST['bFax'];
	$beName					= $_POST['beName'];
	$AccountNumber		= $_POST['AccountNumber'];
	$Routing					= $_POST['Routing'];
	$AccountName			= $_POST['AccountName'];
	$AccountSignatory	= $_POST['AccountSignatory'];
	$cStructure				= $_POST['cStructure'];
	$cName					= $_POST['cName'];
	$cType						= $_POST['cType'];
	$cAddress				= $_POST['cAddress'];
	$cCity						= $_POST['cCity'];
	$cState					= $_POST['cState'];
	$cCountry				= $_POST['cCountry'];
	$cPhone					= $_POST['cPhone'];
	$cFax						= $_POST['cFax'];
	$pIncorp					= $_POST['pIncorp'];
	$dIncorp					= $_POST['dIncorp'];
	$ID							= $_POST['ID'];
	$Category				= $_POST['Category'];
	$Amount					= $_POST['Amount'];
	$Term						= $_POST['Term'];
	$DesiredClose			= $_POST['DesiredClose'];
	$Top25					= $_POST['Top25'];
	$DesiredBank			= $_POST['DesiredBank'];
	$MessageType			= $_POST['MessageType'];
	$instrumentUse		= $_POST['instrumentUse'];
}
	//recipient
	$to = $Principal . ' <' . $Email . '>';
	$cc = 'Pronto Commercial Funding <prontocommercial@gmail.com>';
	//sender
	$from = 'CIS form <website.visitor@prontocommercial.com>';

	//subject and the html message
	$subject = "Completed CIS Form";
	$message = '
	<html>
	<body>
	<p>Dear ' . $Principal.',</p>
	<p>Thank you for sending in your information. It will be used as part of your contract.</p>
	<p>Best Regards,</p>
	<p>All of us at Pronto Commercial Funding</p><p>&nbsp;</p>';

	$cisForm =	'<table>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">Principal:</td><td>' . $Principal . '</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">Passport:</td><td>' . $Passport . '</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">Expiration:</td><td>' . $Expiration . '</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">DOB:</td><td>' . $DOB . '</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">Address:</td><td>' . $Address . '</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">City:</td><td>' . $City . '</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">State:</td><td>' . $State . '</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">Country:</td><td>' . $Country . '</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">Phone1:</td><td>' . $Phone1 . '</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">Phone2:</td><td>' . $Phone2 . '</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">Email:</td><td>' . $Email . '</td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">Company Structure:</td><td>' . $cStructure . '</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">Company Name:</td><td>' . $cName . '</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">Company Type:</td><td>' . $cType . '</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">Address:</td><td>' . $cAddress . '</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">City:</td><td>' . $cCity . '</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">State:</td><td>' . $cState . '</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">Country:</td><td>' . $cCountry . '</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">Phone:</td><td>' . $cPhone . '</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">Fax:</td><td>' . $cFax . '</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">Place of Incorporation:</td><td>' . $pIncorp . '</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">Date of Incorporation:</td><td>' . $dIncorp . '</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">Corporate ID:</td><td>' . $ID	 . '</td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">Bank Name:</td><td>' . $BankName . '</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">Bank Address:</td><td>' . $BankAddress . '</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">Swift:</td><td>' . $Swift . '</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">Officer Name:</td><td>' . $OfficerName . '</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">Bank Phone:</td><td>' . $bPhone . '</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">Bank Fax:</td><td>' . $bFax . '</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">Beneficiary\'s Name:</td><td>' . $beName . '</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">Account Number:</td><td>' . $AccountNumber . '</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">Routing:</td><td>' . $Routing . '</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">Account Name:</td><td>' . $AccountName . '</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">Account Signatory:</td><td>' . $AccountSignatory . '</td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">Funding Request:</td><td>' . $Category . '</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">Amount:</td><td>' . $Amount . '</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">Term:</td><td>' . $Term . '</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">Desired Close Date:</td><td>' . $DesiredClose . '</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">Top 25 Bank Required:</td><td>' . $Top25 . '</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">Desired Bank:</td><td>' . $DesiredBank . '</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">Message Type Needed:</td><td>' . $MessageType . '</td></tr>
		<tr><td style="font-family:sans-serif;margin-right:5px;width:160px;text-align:right;">Use of the Instrument:</td><td>' . $instrumentUse . '</td></tr>
	</table>
	</body>
	</html>';

	//send the mail
	$callresults = sendmail($to, $cc, $subject, $message.$cisForm, $from, $cc);

	echo ($callresults);
?>