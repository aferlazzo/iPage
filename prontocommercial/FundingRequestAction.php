<?php
//die("|".count($_GET)."|");
if(count($_GET) > 0)
{
$FullName	= $_GET['FullName'];
$Phone		= $_GET['Phone'];
$Skype		= $_GET['Skype'];
$Country	= $_GET['Country'];
$Category	= $_GET['Category'];
$Amount		= $_GET['Amount'];
$Currency	= $_GET['Currency'];
$Email		= $_GET['Email'];
$Months		= $_GET['Months'];
$Swift		= $_GET['Swift'];
$Comments	= $_GET['Comments'];
$Captcha	= $_GET['Captcha'];
$arg0		= $_GET['arg0'];
$arg1		= $_GET['arg1'];
$arg2		= $_GET['arg2'];
}
else
{
$FullName	= $_POST['FullName'];
$Phone		= $_POST['Phone'];
$Skype		= $_POST['Skype'];
$Country	= $_POST['Country'];
$Category	= $_POST['Category'];
$Amount		= $_POST['Amount'];
$Currency	= $_POST['Currency'];
$Email		= $_POST['Email'];
$Months		= $_POST['Months'];
$Swift		= $_POST['Swift'];
$Comments	= $_POST['Comments'];
$Captcha	= $_POST['Captcha'];
$arg0		= $_POST['arg0'];
$arg1		= $_POST['arg1'];
$arg2		= $_POST['arg2'];
}
//die ("|$Captcha|$arg0|$arg1|$arg2|");
//Simple mail function with HTML header
function sendmail($to, $subject, $message, $from, $replyto)
{
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
	$headers .= 'From: ' . $from . "\r\n";
	$headers .= 'Reply-To: ' . $replyto . "\r\n";

	$sent = mail($to,$subject,$message,$headers);

	if ($sent == true)
		return('1');
	else
		return('E');
}

if ($arg1 == ' + ')
	$xx = $arg0 + $arg2;
else
	$xx = $arg0 - $arg2;

if ($Captcha == $xx)
{
	//recipient
	$to = 'Anthony Ferlazzo <aferlazzo@gmail.com>';
	//sender
	$from = 'Pronto Web Visitor<website.visitor@prontocommercial.com>';

	//subject and the html message
	$subject = "Funding Request - $Category";
	$message = '
	<html>
	<body>
	<style type="text/css">
	td {font-family:sans-serif;}
	td.tl {margin-right:5px;width:80px;text-align:right;}
	</style>
	<table>
		<tr><td class="tl">FullName:</td><td>' . $FullName . '</td></tr>
		<tr><td class="tl">Phone:</td><td>' . $Phone . '</td></tr>
		<tr><td class="tl">Skype:</td><td>' . $Skype . '</td></tr>
		<tr><td class="tl">Country:</td><td>' . $Country . '</td></tr>
		<tr><td class="tl">Category:</td><td>' . $Category . '</td></tr>
		<tr><td class="tl">Amount:</td><td>' . $Amount . '</td></tr>
		<tr><td class="tl">Currency:</td><td>' . $Currency . '</td></tr>
		<tr><td class="tl">Email:</td><td>' . $Email . '</td></tr>
		<tr><td class="tl">Months:</td><td>' . $Months . '</td></tr>
		<tr><td class="tl">Swift:</td><td>' . $Swift . '</td></tr>
		<tr><td class="tl">Comments:</td><td>' . nl2br($Comments) . '</td></tr>
	</table>
	</body>
	</html>';

	//send the mail
	$callresults = sendmail($to, $subject, $message, $from, $Email);
	echo ($callresults);
}
else
{
		print("$callresults failed:$Captcha|<br>|$arg0|$arg1|$arg2|");
}
?>
