<?php
if ($_SERVER['REQUEST_METHOD']=="POST")  // if receiving the answers to the questions
{
//path to store variables (required by ipower new servers):
session_save_path("/home/users/web/b668/ipw.lightning-mortgage/public_html/cgi-bin/tmp"); 
	session_start();

	if(($_SESSION['security_code'] == $_POST['security_code']) && (!empty($_SESSION['security_code'])) ) 
	{
		//die("match occured"); 
		unset($_SESSION['security_code']);
    	$BorrowerName=$_POST['BorrowerName'];
		$q1=$_POST['q1'];
		$q2=$_POST['q2'];
		$q3=$_POST['q3'];
		$q4=$_POST['q4'];
		$q5=$_POST['q5'];
		$q6=$_POST['q6'];
		$q7=$_POST['q7'];
		$q8=$_POST['q8'];
		$q9=$_POST['q9'];
		$q10=$_POST['q10'];
		$URL=$_POST['url_to_send'];
		$errs="";		
	} 
	else 
	{
		print("Keyed in code: |".$_POST['security_code']."|<br/>");
		print("Session security code: |".$_SESSION['security_code']."|");

		print("<h1>Sorry!</h1><p>As a way to conteract malicious web site hacking, we require you to correctly enter the unique security code when filling out this form.</p>");
		//print("The code was: |".$_SESSION['security_code']."| but you entered |".$_POST['security_code']."|"); 
		die("<p>Click on <a href=\"javascript:location.href='Survey.php';\">Try Another Security Code</a>.</p>");
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<html>
<head>
<title>Survey for Lightning Mortgage</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta http-equiv="Content-Language" content="en-us">
<meta name="copyright" content="Copyright 2006, Anthony Ferlazzo, Lightning Mortgage">
<meta name="rating" content="General">
<meta name="robots" content="Index, ALL">
<link rel="stylesheet" href="./css/AnswersStyles.css" type="text/css">
<link rel="stylesheet" href="./css/Tabs.css" type="text/css">
<base target="_self">
<style type="text/css">
p.Qlabel,p.Qlabel:first-letter{
text-align:left;
margin:14px 0 14px 0;
color:#009;
font-size:small;
font-family:Verdana,Arial,Helvetica,sans-serif;
font-weight:bolder;
}
div Lcolumn {float:left;width:6em;background:white;border:thin solid black; }
/*div#ContentDIV {width:766px;padding:0;margin:0 4px;}*/
/*div#TopFrame, div#BottomFrame, div.Bottom2{width:774px;}*/
/*div#ContentBackground{width:810px;}*/
</style>


<script language="JavaScript" src="./js/Common.js" type="text/javascript"></script>
<script src="http://www.google.com/coop/cse/brand?form=cse-search-box&lang=en" type="text/javascript"></script>
<script language="JavaScript" type="text/javascript">
<!--
function Validate()
{
if (document.F.BorrowerName.value == "")
{
alert("Please include your name");
window.document.F.BorrowerName.focus();
return(false);
}

if (document.F.q2.value == "Select")
{
alert("Please rate how we met your expectations");
window.document.F.q2.focus();
return(false);
}
/*
alert("document.F.BorrowerName.value "+ document.F.BorrowerName.value);
alert("document.F.q1.value "+ document.F.q1.value);
alert("document.F.q2.value "+ document.F.q2.value);
alert("document.F.q3.value "+ document.F.q3.value);
alert("document.F.q4.value "+ document.F.q4.value);
alert("document.F.q5.value "+ document.F.q5.value);
alert("document.F.q6.value "+ document.F.q6.value);
alert("document.F.q7.value "+ document.F.q7.value);
alert("document.F.q8.value "+ document.F.q8.value);
alert("document.F.q9.value "+ document.F.q9.value);
alert("document.F.q10.value "+ document.F.q10.value);
*/
return (true);
}
//-->
</script>
<?php
//set_include_path(get_include_path() . PATH_SEPARATOR . '/home/lightnin/public_html/pear/');
include('Mail.php');
include('Mail/mime.php');
function SendMessage($Subject, $Message, $From, $To, $cc)
{
$IPaddr = GetIP();
$text = $Message;
$html = '<html><body>'.nl2br($Message).'</body></html>';
$crlf = "\n";
$SendDate = date('r');

$To = $To.", ".$cc;
$hdrs = array('From'    => $From,
              'Subject' => $Subject,
			  'Cc'		=> $cc,
			  'Date'    => $SendDate);

$mime = new Mail_mime($crlf);

$mime->setTXTBody($text);
$mime->setHTMLBody($html);
//$mime->addAttachment($file, 'text/plain');

$body = $mime->get();
$hdrs = $mime->headers($hdrs);
$Params["Return-Path"] = '<anthony@lightning-mortgage.com>';
$Params["host"] = "lightning-mortgage.ipower.com";
$Params["port"] = "25";
$Params["auth"] = true;
$Params["username"] = "anthony@lightning-mortgage.com";
$Params["password"] = "1commguru";

$mail = &Mail::factory("smtp", $Params);
$mail->send($To, $hdrs, $body);
}


//---------------
//
// Get the visitor's IP Address
//
//---------------
function GetIP()
{
  if (isSet($_SERVER))
  {
  	//print("hello at line ".__LINE__."<br />");
    if (isSet($_SERVER["HTTP_X_FORWARDED_FOR"]))
    {
      $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    }
    elseif ( $_SERVER["HTTP_CLIENT_IP"] )
    {
      $realip = $_SERVER["HTTP_CLIENT_IP"];
    }
    else
    {
      $realip = $_SERVER["REMOTE_ADDR"];
    }
  }
  else
  {
    if ( getenv( 'HTTP_X_FORWARDED_FOR' ) )
    {
      $realip = getenv( 'HTTP_X_FORWARDED_FOR' );
    }
    elseif ( getenv( 'HTTP_CLIENT_IP' ) )
    {
      $realip = getenv( 'HTTP_CLIENT_IP' );
    }
    else
    {
      $realip = getenv( 'REMOTE_ADDR' );
    }
  }

  return $realip;
}

?>
</head>
<body>
<?php
	$ReferringServer = "http://" . $HTTP_HOST . $REDIRECT_URL; 

	//print ("Referrer: $ReferringServer<br />\n");
	
if (!ReferringServer)
	die("Sorry, but I did not get the address of the page to send. 
	This information may be being blocked by your browser settings, 
	or your firewall");

if ($_SERVER['REQUEST_METHOD']=="POST")  // if receiving the answers to the questions
{

	if (!$url_to_send)
		$errs.="<p>URL to page not received. It may be blocked by your firewall or browser</p>";

	if (strpos($url_to_send, $HTTP_HOST) < 7)
		$errs.="<p>Bad referring page|$url_to_send|$HTTP_HOST|<br /></p>";

	if ($errs)
	{
		print ("<h1 style='text-align: center; font: italic normal bold x-large Verdana; color: red;'>");
		print ("Survey Not Sent!</h1>");
		print ("<table border='0' cellpadding='2' cellspacing='0'><tr><td>");
		print ("<p>Could not send the link because of the following error(s):<br />$errs</p>");

		print ("<center><input style='color: #ffffff; background-color: #000099; font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; width: 150px;'");
		print ("type='button' value='Make Correction(s)' onClick='window.history.back()'></center><br />&nbsp;");
		print ("</td></tr></table>");
	}
	else 
	{


$IPaddress = GetIP();

// Now use PHP to create the mail header and body. Then send the message -->

	//print "Headers:\n$headers\n";
	$message  = "<h1 style='font:large Verdana;color:#009'>This survey comes to you as a result of a borrower filling out<br />the web page http://www.lightning-mortgage.com/Survey.php</h1>";
	$message .= "<p style='font:small Verdana;color:#009'><b>Date Sent:</b> ".date ("l dS of F Y h:i:s A")."</p>";
	$message .= "<p style='font:small Verdana;color:#009'><b>IP Address: </b>".$IPaddress."</p>";
	$message .= "<p style='font:small Verdana;color:#009'><b>Their Name: </b>".$BorrowerName."</p>";
	$message .= "<p style='font:small Verdana;color:#009'><b>Why they chose Lightning Mortgage: </b>".$q1."</p>";
	$message .= "<p style='font:small Verdana;color:#009'><b>Overall Satisfaction: </b>".$q2."</p>";
	$message .= "<p style='font:small Verdana;color:#009'><b>What was most valuable: </b>".$q3."</p>";
	$message .= "<p style='font:small Verdana;color:#009'><b>How they pleased with the service: </b>".$q4."</p>";
	$message .= "<p style='font:small Verdana;color:#009'><b>Was it world-class service throughout the process?: </b>".$q5."</p>";
	$message .= "<p style='font:small Verdana;color:#009'><b>What caused them to feel uncomfortable: </b>".$q6."</p>";
	$message .= "<p style='font:small Verdana;color:#009'><b>What specific situation stands out most: </b>".$q7."</p>";
	$message .= "<p style='font:small Verdana;color:#009'><b>Will they use us again?: </b>".$q8."</p>";
	$message .= "<p style='font:small Verdana;color:#009'><b>Have we earned their trust?: </b>".$q9."</p>";
	$message .= "<p style='font:small Verdana;color:#009'><b>May we share their comments with others?: </b>".$q10."</p>";
	
	//die("Message Body:\n$message");

	//mail($recipient, "Client Satisfaction Survey", $message, $headers);
    $email = "<client.survey@lightning-mortgage.com>";
	$From = addslashes($BorrowerName)." ".$email;
	$To = "anthony@lightning-mortgage.com, fran@lightning-mortgage.com";
	$cc = "";
	SendMessage("Client Satisfaction Survey", $message, $From, $To, $cc)
?>
<script type='text/javascript'>Directory='Answers';</script>
<!--ih:includeHTML file="./include/top-root.php"--><!--/ih:includeHTML-->
<div id="Heading" style="width:100%;">
<div class="Title"><h1 id="Small">For You<br />Our Valued Client</h1></div>
<div class="Title">
<div id="Big"><h1>Satisfaction Survey</h1></div>
<div id="BigShadow"><h1>Satisfaction Survey</h1></div></div>
</div><br style="clear:left;">
<h1>Thank You!</h1>
<p>We want to make sure that we provide our valued clients like you with a great borrowing experience.
Your answers will help us to do a better job for you and others.</p>
	<div class="NextSteps">
	<hr><br />
	<div style="float:left;height:15em;width:70%;text-align:left;"><h2 class="NextSteps">Next Steps</h2>	
	<ul>
		<li><a
		href=".//Answers.php">Explore the Loan Process</a></li>
		<li><a
		href="./CreditScores.php">Explore Credit Score Topics</a></li>
		<li><a
		href="./LoanTypes.php">Learn about Loan Types</a></li>
		<li><a
		href="./Answers/PreAnswers.php">Determine if you want to be pre-qualified or pre-approved</a></li>
		<li><a
		href="./Answers/MortgageTips.php">Review The Top 10 Factors That Influence Your Mortgage</a></li>
		<li><a
		href="./InterestRates/EducationTaxes.php">Learn about the Tax Advantages of Home Ownership</a></li>
		<li><a
    	href="../MortgageApplication/LoanAppShort.php">Submit A Loan Application</a></li>
	</ul></div>
	</div>
<?php
	}
} 
else // Performed initially, if asking the questions
{

	$ReferringServer = "http://" . $HTTP_HOST . $REDIRECT_URL; 

	//print ("Referrer: $ReferringServer<br />\n");
?>
<script type='text/javascript'>Directory='Answers';</script>
<!--ih:includeHTML file="./include/top-root.php"--><!--/ih:includeHTML-->
<form name='F' onsubmit='return Validate();' action='Survey.php' method='post'>
<?php
print ("<input type='hidden' name='url_to_send' value='$ReferringServer'>");
?>
<div id="Heading" style="width:100%;">
<div class="Title"><h1 id="Small">For You<br />Our Valued Client</h1></div>
<div class="Title">
<div id="Big"><h1>Satisfaction Survey</h1></div>
<div id="BigShadow"><h1>Satisfaction Survey</h1></div></div>
</div><br style="clear:left;">
<p>Thanks in advance for taking the time to answer a few questions. Your answers are important, and we read
and reflect on every survey. We seek to continually improve the service and loan products to provide the 
best experience for our valued clients like you. Please don't feel obligated to answer every question - just 
write about anything you wish to share.  Your comments will help us see our service through your eyes.</p> 
 
<p style="margin-left:1.7em;">Your Name&nbsp;<input type='text' name='BorrowerName' id='BorrowerName' size='30'></p>
<ol>
<li><p>Why did you choose Lightning Mortgage to assist you with your borrowing process?</p>
<textarea name="q1" id="q1" cols="80" rows="5"></textarea></li>


<li>
<select name="q2" id="q2" size="1" style="width:400px;">
	<option style='text-align:right;' value='Select' selected>Please Select One</option>
	<option style='text-align:right;' value='A'>A - I'm Your Newest Raving Fan!</option>
	<option style='text-align:right;' value='B'>B - Exceeded My Expectations</option>
	<option style='text-align:right;' value='C'>C - Met My Expectations</option>
	<option style='text-align:right;' value='D'>D - Did Not Meet All My Expectations</option>
	<option style='text-align:right;' value='F'>F - Failed to Meet My Expectations</option>
</select>
Please rank how we met your expectations.</li>

<li><p>In thinking about the borrowing process, what did we do for you that was most valuable?  Please comment.
<textarea name="q3" id="q3" cols="80" rows="5"></textarea></li>


<li><p>Were you pleased with the service provided by Fran and Anthony?  Please comment.</p>
<textarea name="q4" id="q4" cols="80" rows="5"></textarea></li>


<li><p>Do you feel that you received world-class service throughout the process?  Please comment.</p>
<textarea name="q5" id="q5" cols="80" rows="5"></textarea></li>


<li><p>Was there anything about the transaction that caused you to feel uncomfortable?  Please comment.</p>
<textarea name="q6" id="q6" cols="80" rows="5"></textarea></li>


<li><p>What specific situation stands out most in your mind about the entire process?</p>
<textarea name="q7" id="q7" cols="80" rows="5"></textarea></li>


<li><p>Will you use Lightning Mortgage for your borrowing needs in the future?</p>
<textarea name="q8" id="q8" cols="80" rows="5"></textarea></li>


<li><p>Have we earned your trust? Will you recommend our services to your family members, friends and colleagues?</p>
<textarea name="q9" id="q9" cols="80" rows="5"></textarea></li>


<li><p>May we share your comments with others?</p>
<textarea name="q10" id="q10" cols="80" rows="5"></textarea></li>

<li><p>This is the Security Code:</p></li>
					
<img src="./captcha/CaptchaSecurityImages.php" style="height:42px;margin:4px 500px 4px 0;"/>


<li><p>Copy the Security Code in the box below</p>
<input type="text" name="security_code" id="security_code" maxlength="50" size="36"  tabindex="6"
	onkeypress="return(NoEnterKey('security_code', event, 'Submit'));"
	onfocus="this.style.border='2px solid #000080'"
	onblur="this.style.border='2px solid silver'"></li></ol>

	
	
	
<div style="margin:0 auto;text-align:center">
<input style="width:200px;font-size:medium;" type="Submit" class="Submit" value="Submit Survey" 
onMouseover="this.className='MouseOver'" onMouseout="this.className='Submit'"></div>
</form></div>
<?php
}
?>
<!--ih:includeHTML file="./include/bottom-root.php"--><!--/ih:includeHTML-->
</body>
</html>
