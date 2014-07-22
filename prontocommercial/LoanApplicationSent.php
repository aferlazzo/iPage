<!DOCTYPE html PUBLIC "-//W3c//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Loan Application Sent</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta name="copyright" content="Copyright 2006, Anthony Ferlazzo, Pronto Commercial Funding">
<meta name="rating" content="General">
<meta name="robots" content="Index, ALL">
<meta name="description"
content="Commercial Mortgage and Leasing.">
<meta name="keywords"
content="commercial mortgage, commercial leasing, equipment leasing, commercial loans">
<link rel="shortcut icon" href="favicon.ico">
<link rel="stylesheet" href="./css/ProntoStyles.css" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
<script src="./js/ProntoCommon.js" type="text/javascript"></script>
</head>
<body>
<?php include("include/top.php"); ?>
<h1>Thank You For Applying!</h1>

<?php
set_include_path(get_include_path() . PATH_SEPARATOR . './public_html/pear/');
//echo get_include_path();
//die();




include('Mail.php');
include('Mail/mime.php');
function SendMessage($Subject, $Message, $From, $To, $cc)
{
$text = $Message;
$html = '<html><body>'.nl2br($Message).'</body></html>';
$crlf = "\n";
$SendDate = date('r');
//print ("Date sent $SendDate<br>");
$To = $To.", ".$cc;
$hdrs = array('From'    => $From,
			'Subject' => $Subject,
			'To'		=> $To,
			'Cc'		=> $cc,
			'Date'    => $SendDate);

$mime = new Mail_mime($crlf);

$mime->setTXTBody($text);
$mime->setHTMLBody($html);
//$mime->addAttachment($file, 'text/plain');

$body = $mime->get();
$hdrs = $mime->headers($hdrs);
$Params["Return-Path"] = '<anthony@prontocommercial.com>';
$Params["host"] = "mail.prontocommercial.com";
$Params["port"] = "25";
$Params["username"] = "anthony@prontocommercial.com";
$Params["password"] = "1commguru";
$Params["auth"] = true;
$Auth = true;

$mail = &Mail::factory("smtp", $Params);
$mail->send($To, $hdrs, $body);
}


	$Message = urldecode($_POST['Message']);
	$Email = $_POST['Email'];
	$Pname = $_POST['Pname'];
	$From = "anthony@prontocommercial.com";
	$To = "anthony@prontocommercial.com";
	$cc = "fran@prontocommercial.com";
	$Subject = "Commercial Loan Application from $Pname <$Email>";

	//print("$From<br>$To<br>$Subject<br>$Email<br>$Pname<br>$Message<br>");
	if($Email != "")
	SendMessage($Subject, $Message, $From, $To, $cc)
?>

<p>Thank you for taking the time to fill out this Commercial Loan Application.
One of our Commercial Lending Specialists will personally review this information
and contact you directly within the next 24 business hours to notify you of your
pre-qualification status.</p>
<?php include("./include/bottom.php"); ?>
</body>
</html>
