<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<html>
<!--
//  . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .	//
//																						//
//	LoanAppShort.php - does the Back-end processing of newly entered applications.		//
//	Date put into production: 6/26/03	- Tony Ferlazzo, copyright, all rights reserved.//
//																						//
//	A confirmation page is displayed for the user to decide whether corrections to the 	//
//	data entered is required.  LoanAppDB.php is called at confirmation.					//
//																						//
//  . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .	//
-->

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta http-equiv="Content-Language" content="en-us">
<title>Loan Application Confirmation</title>
<!-- dissolve screen -->
<!--<META http-equiv="Page-Enter" content="revealTrans(duration=3, Transition=12)"> -->
<meta name="robots" content="NoIndex, NoFollow">
<base target="_self">
<link rel="stylesheet" href="../css/MortgageApplicationStyles.css" type="text/css">
<link rel="stylesheet" href="../css/Tabs.css" type="text/css">
<!--[if IE 6]>
<style type="text/css">
html
{
	scrollbar-base-color: #EBF5F5;
	scrollbar-arrow-color: #FFF;
	scrollbar-track-color: #007B5D;
	scrollbar-face-color: #099;
	scrollbar-3dlight-color: #099;
}
</style>
<![endif]-->
<script src="https://www.google.com/coop/cse/brand?form=cse-search-box&lang=en" type="text/javascript"></script>
</head>
<body>
<?php include('../include/top.php'); ?>
<div id="Heading" style="width:80%;">
<div class="Title"><h1 id="Small">Application<br />Double-check and</h1></div>
<div class="Title">
<div id="Big"><h1>Confirmation</h1></div>
<div id="BigShadow"><h1>Confirmation</h1></div></div>
</div><br style="clear:left;">
 <table border="0" cellpadding="4" cellspacing="0" bordercolor="#009999" width="720">
  <tr>
   <td>
   <table border="0" cellpadding="0" cellspacing="0">
    <tr>
     <td valign="bottom" height="30">

<!-- Now let's embed some true PHP code into this HTML docuement -->

<?php
// ---------------
//
// Get the visitors IP Address
//
// ---------------
function GetIP()
{
  if ($_SERVER)
  {
    if ( $_SERVER[HTTP_X_FORWARDED_FOR] )
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




//---------------
//
// This handles leading zeros correctly, by using the "%s" instead of "%d" argument to sscanf().
// This function assumes that the input has been stripped of all non-integer values.
//
//---------------


function formatPhone($phone)
{
       if (empty($phone)) return "";
       if (strlen($phone) == 7)
               sscanf($phone, "%3s%4s", $prefix, $exchange);
       else if (strlen($phone) == 10)
             sscanf($phone, "%3s%3s%4s", $area, $prefix, $exchange);
      else if (strlen($phone) > 10)
               sscanf($phone, "%3s%3s%4s%s", $area, $prefix, $exchange, $extension);
      else
               return "unknown phone format: $phone";
       $out = "";
       $out .= isset($area) ? $area . '-' : "";
       $out .= $prefix . '-' . $exchange;
       $out .= isset($extension) ? ' x' . $extension : "";
       return $out;
}


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//
//																											//
//	PrintFor2nd() conditionally display the following lines. We do this because there's no reason to list 	//
//	blank lines because the visitor has no second mortgage. Notice the way HTML is embedded into PHP code.	//
//	Tricky, huh?																							//
//																											//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//
function PrintFor2nd($LenderNameOn2nd, $LoanBalanceOn2nd, $InterestRateOn2nd, $MonthlyPaymentOn2nd)
{
 	//print("LenderNameOn2nd |$LenderNameOn2nd|<br>\n");

   if ($LenderNameOn2nd != "")
   {
      print "<tr>
      <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>Current 2nd Lender:</b></font></td>
      <td width=451 height='20' align='left'>
      <font face='Verdana' color='#000066' size='2'>$LenderNameOn2nd</font></td></tr>\n";

      print "<tr>
      <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>Balance on 2nd:</b></font></td>
      <td width=451 height='20' align='left'>
      <font face='Verdana' color='#000066' size='2'>$LoanBalanceOn2nd</font></td></tr>\n";

      print "<tr>
      <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>Interest Rate:</b></font></td>
      <td width=451 height='20' align='left'>
      <font face='Verdana' color='#000066' size='2'>$InterestRateOn2nd</font></td></tr>\n";

      print "<tr>
      <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>Monthly Payment:</b></font></td>
      <td width=451 height='20' align='left'>
      <font face='Verdana' color='#000066' size='2'>$MonthlyPaymentOn2nd</font></td></tr>\n";
   }
}

//---------------
//
// // The calling HTML form 'method' could have been a method of Post of Get.
//
// First, put the passed variables into working variables. When the code begins passed variables are in one of
// two arrays: $_POST array or $_GET array. Like any other array in PHP, you retrieve each element by using the
// HTML page's form values as the array 'index' as in $_POST['DOB'] refers to the DOB form field.
//
// Rather than just do the simple assignment to a local variable, e.g. $DOB	= $_POST['B_DOB'], I'm going
// to perform a 'regular expression' replacement function to remove any PHP escape characters ('\') that
// might have been inserted by the PHP interpreter.
//
//---------------

if(empty($_GET))
{
//  print "variables from POST:\n<p>";
  $ApplicantName			= ereg_replace('[\]', '', $_POST['ApplicantName']);
  $DOB						= ereg_replace('[\]', '', $_POST['DOB']);
  $Street					= ereg_replace('[\]', '', $_POST['Street']);
  $City						= ereg_replace('[\]', '', $_POST['PropertyCity']);
  $State					= ereg_replace('[\]', '', $_POST['PropertyState']);
  $Zipcode					= ereg_replace('[\]', '', $_POST['PropertyZipcode']);
  $WorkPhone				= ereg_replace('[\]', '', $_POST['WorkPhone']);
  $HomePhone				= ereg_replace('[\]', '', $_POST['HomePhone']);
  $BestCallTime				= ereg_replace('[\]', '', $_POST['BestCallTime']);
  $BestCallNumber			= ereg_replace('[\]', '', $_POST['BestPhoneToCall']);
  $email					= ereg_replace('[\]', '', $_POST['email']);
  $SSN						= ereg_replace('[\]', '', $_POST['SSN']);
  $Employer					= ereg_replace('[\]', '', $_POST['Employer']);
  $MonthlyIncome			= ereg_replace('[\]', '', $_POST['MonthlyIncome']);
  $B_2002Income				= ereg_replace('[\]', '', $_POST['B_2002Income']);
  $EmployerTime				= ereg_replace('[\]', '', $_POST['EmployerTime']);
  $Position					= ereg_replace('[\]', '', $_POST['Position']);
  $Co_ApplicantName			= ereg_replace('[\]', '', $_POST['Co_ApplicantName']);
  $Co_DOB					= ereg_replace('[\]', '', $_POST['Co_DOB']);
  $Co_SSN					= ereg_replace('[\]', '', $_POST['Co_SSN']);
  $Co_Employer				= ereg_replace('[\]', '', $_POST['Co_Employer']);
  $Co_MonthlyIncome			= ereg_replace('[\]', '', $_POST['Co_MonthlyIncome']);
  $Co_2002Income			= ereg_replace('[\]', '', $_POST['Co_2002Income']);
  $Co_EmployerTime			= ereg_replace('[\]', '', $_POST['Co_EmployerTime']);
  $Co_Position				= ereg_replace('[\]', '', $_POST['Co_Position']);
  $EstCreditRating			= ereg_replace('[\]', '', $_POST['EstCreditRating']);
  $MonthlyCreditCardDebt	= ereg_replace('[\]', '', $_POST['MonthlyCreditCardDebt']);
  $MonthlyOtherDebt			= ereg_replace('[\]', '', $_POST['MonthlyOtherDebt']);
  $FinanceRequest			= ereg_replace('[\]', '', $_POST['FinanceRequest']);
  $LoanAmount				= ereg_replace('[\]', '', $_POST['LoanAmount']);
  $PropertyType				= ereg_replace('[\]', '', $_POST['PropertyType']);
  $PurchasePrice			= ereg_replace('[\]', '', $_POST['PurchasePrice']);
  $EstimatedValue			= ereg_replace('[\]', '', $_POST['EstimatedValue']);
  $LenderNameOn1st			= ereg_replace('[\]', '', $_POST['LenderNameOn1st']);
  $InterestRateOn1st		= ereg_replace('[\]', '', $_POST['InterestRateOn1st']);
  $LoanBalanceOn1st			= ereg_replace('[\]', '', $_POST['LoanBalanceOn1st']);
  $MonthlyPaymentOn1st		= ereg_replace('[\]', '', $_POST['MonthlyPaymentOn1st']);
  $Impounds						= ereg_replace('[\]', '', $_POST['Impounds']);
  $LenderNameOn2nd			= ereg_replace('[\]', '', $_POST['LenderNameOn2nd']);
  $InterestRateOn2nd		= ereg_replace('[\]', '', $_POST['InterestRateOn2nd']);
  $LoanBalanceOn2nd			= ereg_replace('[\]', '', $_POST['LoanBalanceOn2nd']);
  $MonthlyPaymentOn2nd		= ereg_replace('[\]', '', $_POST['MonthlyPaymentOn2nd']);
  $HowReferred				= ereg_replace('[\]', '', $_POST['HowReferred']);
  $Situation				= ereg_replace('[\]', '', $_POST['Situation']);
  $recipient				= ereg_replace('[\]', '', $_POST['recipient']);
  $cc						= ereg_replace('[\]', '', $_POST['cc']);
  $IPaddress				= ereg_replace('[\]', '', $_POST['IPaddress']);
  $redirect					= ereg_replace('[\]', '', $_POST['redirect']);
  $title					= ereg_replace('[\]', '', $_POST['title']);
  $Signature				= ereg_replace('[\]', '', $_POST['Signature']);
  $GetOrPost				= $_POST;
}


if(empty($_POST))
{
//  print "variables from GET:\n<p>";
  $ApplicantName            = ereg_replace('[\]', '', $_GET['ApplicantName']);
  $DOB						= ereg_replace('[\]', '', $_GET['DOB']);
  $Street					= ereg_replace('[\]', '', $_GET['Street']);
  $City						= ereg_replace('[\]', '', $_GET['PropertyCity']);
  $State					= ereg_replace('[\]', '', $_GET['PropertyState']);
  $Zipcode					= ereg_replace('[\]', '', $_GET['PropertyZipcode']);
  $WorkPhone				= ereg_replace('[\]', '', $_GET['WorkPhone']);
  $HomePhone				= ereg_replace('[\]', '', $_GET['HomePhone']);
  $BestCallTime				= ereg_replace('[\]', '', $_GET['BestCallTime']);
  $BestCallNumber			= ereg_replace('[\]', '', $_GET['BestPhoneToCall']);
  $email					= ereg_replace('[\]', '', $_GET['email']);
  $SSN						= ereg_replace('[\]', '', $_GET['SSN']);
  $Employer					= ereg_replace('[\]', '', $_GET['Employer']);
  $MonthlyIncome			= ereg_replace('[\]', '', $_GET['MonthlyIncome']);
  $B_2002Income				= ereg_replace('[\]', '', $_GET['B_2002Income']);
  $EmployerTime				= ereg_replace('[\]', '', $_GET['EmployerTime']);
  $Position					= ereg_replace('[\]', '', $_GET['Position']);
  $Co_ApplicantName			= ereg_replace('[\]', '', $_GET['Co_ApplicantName']);
  $Co_DOB					= ereg_replace('[\]', '', $_GET['Co_DOB']);
  $Co_SSN					= ereg_replace('[\]', '', $_GET['Co_SSN']);
  $Co_Employer				= ereg_replace('[\]', '', $_GET['Co_Employer']);
  $Co_MonthlyIncome			= ereg_replace('[\]', '', $_GET['Co_MonthlyIncome']);
  $Co_2002Income			= ereg_replace('[\]', '', $_GET['Co_2002Income']);
  $Co_EmployerTime			= ereg_replace('[\]', '', $_GET['Co_EmployerTime']);
  $Co_Position				= ereg_replace('[\]', '', $_GET['Co_Position']);
  $EstCreditRating			= ereg_replace('[\]', '', $_GET['EstCreditRating']);
  $MonthlyCreditCardDebt	= ereg_replace('[\]', '', $_GET['MonthlyCreditCardDebt']);
  $MonthlyOtherDebt			= ereg_replace('[\]', '', $_GET['MonthlyOtherDebt']);
  $FinanceRequest			= ereg_replace('[\]', '', $_GET['FinanceRequest']);
  $LoanAmount				= ereg_replace('[\]', '', $_GET['LoanAmount']);
  $PropertyType				= ereg_replace('[\]', '', $_GET['PropertyType']);
  $PurchasePrice			= ereg_replace('[\]', '', $_GET['PurchasePrice']);
  $EstimatedValue			= ereg_replace('[\]', '', $_GET['EstimatedValue']);
  $LenderNameOn1st			= ereg_replace('[\]', '', $_GET['LenderNameOn1st']);
  $InterestRateOn1st		= ereg_replace('[\]', '', $_GET['InterestRateOn1st']);
  $LoanBalanceOn1st			= ereg_replace('[\]', '', $_GET['LoanBalanceOn1st']);
  $MonthlyPaymentOn1st		= ereg_replace('[\]', '', $_GET['MonthlyPaymentOn1st']);
  $Impounds					= ereg_replace('[\]', '', $_GET['Impounds']);
  $LenderNameOn2nd			= ereg_replace('[\]', '', $_GET['LenderNameOn2nd']);
  $InterestRateOn2nd		= ereg_replace('[\]', '', $_GET['InterestRateOn2nd']);
  $LoanBalanceOn2nd			= ereg_replace('[\]', '', $_GET['LoanBalanceOn2nd']);
  $MonthlyPaymentOn2nd		= ereg_replace('[\]', '', $_GET['MonthlyPaymentOn2nd']);
  $HowReferred				= ereg_replace('[\]', '', $_GET['HowReferred']);
  $Situation				= ereg_replace('[\]', '', $_GET['Situation']);
  $recipient				= ereg_replace('[\]', '', $_GET['recipient']);
  $cc						= ereg_replace('[\]', '', $_GET['cc']);
  $IPaddress				= ereg_replace('[\]', '', $_GET['IPaddress']);
  $redirect					= ereg_replace('[\]', '', $_GET['redirect']);
  $title					= ereg_replace('[\]', '', $_GET['title']);
  $Signature				= ereg_replace('[\]', '', $_GET['Signature']);
  $GetOrPost				= $_GET;
}

$LoanType = $GetOrPost[LoanType];
//print("loan type: $LoanType");

// Replace a 'regular expression' syntax:
// Scan $Phone for anything that matches $Pattern.
// Replace it with "" (remove it)

// Regular expression metacharacter explanantion:    [[:digit:]] is any character that's a digit
// Regular expression metacharacter explanantion:    [^[:digit:]] is any character that's NOT a digit

$Pattern="[^[:digit:]]"; /* first assign the pattern we'll use to the variabe '$Pattern' */

$out = ereg_replace($Pattern, "", $HomePhone); /* now perform the replacement for both phone numbers */

// print "unformatted phone number|$out|\n";
$HomePhone=formatPhone($out);
// print "formatted phone number|$HomePhone|\n";

$out = ereg_replace($Pattern, "", $WorkPhone);
$WorkPhone=formatPhone($out);

	/* before storing these values, remove the formatting (non-digit) characters */

	$GetOrPost[SSN]					= ereg_replace($Pattern, "", $SSN);
    $GetOrPost[Co_SSN]				= ereg_replace($Pattern, "", $Co_SSN);
    $GetOrPost[DOB]					= ereg_replace($Pattern, "", $DOB);
	$GetOrPost[Co_DOB]				= ereg_replace($Pattern, "", $Co_DOB);

	$GetOrPost[MonthlyIncome]		= round($MonthlyIncome,0);
	$GetOrPost[Co_MonthlyIncome]	= round($Co_MonthlyIncome,0);
	$GetOrPost[B_2002Income]		= round($B_2002Income,0);
	$GetOrPost[Co_2002Income]		= round($Co_2002Income,0);

	$SS1			 				= substr($GetOrPost[SSN], 0, 3);
	$SS2			 				= substr($GetOrPost[SSN], 3, 2);
	$SS3			 				= substr($GetOrPost[SSN], 5, 4);
	$SSN 						= $SS1."-".$SS2."-".$SS3;

	
	$SS1			 				= substr($GetOrPost[Co_SSN], 0, 3);
	$SS2			 				= substr($GetOrPost[Co_SSN], 3, 2);
	$SS3			 				= substr($GetOrPost[Co_SSN], 5, 4);
	$Co_SSN 					= $SS1."-".$SS2."-".$SS3;
	
	$DOB1						= substr($GetOrPost[DOB], 0, 2);
	$DOB2						= substr($GetOrPost[DOB], 2, 2);
	$DOB3						= substr($GetOrPost[DOB], 4, 4);
	$DOB						= $DOB1."-".$DOB2."-".$DOB3;
	
	$DOB1						= substr($GetOrPost[Co_DOB], 0, 2);
	$DOB2						= substr($GetOrPost[Co_DOB], 2, 2);
	$DOB3						= substr($GetOrPost[Co_DOB], 4, 4);
	$Co_DOB					= $DOB1."-".$DOB2."-".$DOB3;
	

	$MonthlyIncome			= $GetOrPost[MonthlyIncome];
	$Co_MonthlyIncome	= $GetOrPost[Co_MonthlyIncome];
	$B_2002Income		= $GetOrPost[B_2002Income];
	$Co_2002Income		= $GetOrPost[Co_2002Income];

	// *-*-*-*-*-* format Street *-*-*-*-*-*-*-*-*-*

	$Street = strtolower($GetOrPost[Street]);
	$Street = ucwords($Street);
	$GetOrPost[Street]=$Street;

	// *-*-*-*-*-* format PropertyCity *-*-*-*-*-*-*-*-*-*

	$City = strtolower($GetOrPost[PropertyCity]);
	$City = ucwords($City);
	$GetOrPost[PropertyCity]=$City;

	// *-*-*-*-*-* format email *-*-*-*-*-*-*-*-*-*

	$email = strtolower($GetOrPost[email]);
	$GetOrPost[email]=$email;

// neat way to printout the arrays keys and their values
//
//	for ($n=0; $n < count($GetOrPost); $n++)
//	{
//		$Parameter= each($GetOrPost);
//		print ("In LoanAppShort.php $Parameter[key] = $Parameter[value]<p>\n");
//	}

 $SavedIPaddress = GetIP(); /* retrieve the visitor's IP address using PHP's convenient tools */

// print "Visitor's IP Address: $SavedIPaddress\n<p>";
// print "               Title: $title\n<p>";
// print "      E-mail Address: $email\n<p>";
// print "           Recipient: $recipient\n<p>";
// print "                  cc: $cc\n<p>";
// print "     Redirect String: $redirect\n<p>";

//	now that we've obtained the calling page's form variables, display them to the visitor



	print ("<tr><td valign='top'><div style='text-align:center;'><center>\n");
	print ("<table border='0' cellpadding='0' cellspacing='4'><tr>\n");
	print ("<td align='left' colspan='2'><p style='text-align:center;margin:0 auto;width:47em;'>\n");
	print ("Here is a summary of your answers. Please review the information before continuing.</p>\n");
	print ("</td></tr><tr><td align='center' colspan='2'>\n");

	/* test $redirect string is hard-coded in. Normally it will be passed */
	// $GetOrPost[redirect]="cp1Validation.php?&coid=9202&login=tony2003&password=lightning&transtype=CRD&charge=15.00&to_email=tony@lightning-mortgage.com&cc_email=fran@lightning-mortgage.com&email_subj=Home+Loan+Credit+Report+Waiting+for+your+review-See+below&returnURL=OrderCreditSuccess.php&a_fullname=Robbie+Refinance&a_ssn=111-22-3333&co_fullname=Randi+Refinance&co_ssn=333-22-1111&ca_fullstreet_name=123+Anywhere+St.&ca_city=Pleasanton&ca_state=CA&ca_zipcode=98765&ca_county=Alameda&bill_email=tferlazzo@attbi.com&bill_phone=999-999-9999&autopopcc=Y";


	print ("<font face='Verdana' color='#000066' size='2'><font face='Verdana'>");


	//	When the Submit button is pressed, before performing the desired action, transferring control to LoanAppDB.php,
	//	execute the JavaScript confirm function contained in the onsubmit= parameter
	//	When executing LoanAppDB.php pass the $redirect string and the $GetOrPost array

    print ("<form action='https://lightning-mortgage.ipower.com/MortgageApplication/LoanAppDB.php' method='post' name='VerifyDataForm' id='VerifyDataForm'>\n");

    //This works well for confirmations:
    //print ("<form action='LoanAppDB.php' method='post' name='VerifyDataForm' id='VerifyDataForm'
    //onreset= 'return(confirm(\"Clear Fields?\"))' onsubmit='confirm(\"Submit Form?\")'>");

	print ("<input type='hidden' name='ApplicantName' value='$GetOrPost[ApplicantName]'>\n");
	print ("<input type='hidden' name='DOB' value='$GetOrPost[DOB]'>\n");
	print ("<input type='hidden' name='Street' value='$GetOrPost[Street]'>\n");
	print ("<input type='hidden' name='PropertyCity' value='$GetOrPost[PropertyCity]'>\n");
	print ("<input type='hidden' name='PropertyState' value='$GetOrPost[PropertyState]'>\n");
	print ("<input type='hidden' name='PropertyZipcode' value='$GetOrPost[PropertyZipcode]'>\n");
	print ("<input type='hidden' name='WorkPhone' value='$GetOrPost[WorkPhone]'>\n");
	print ("<input type='hidden' name='HomePhone' value='$GetOrPost[HomePhone]'>\n");
	print ("<input type='hidden' name='BestCallTime' value='$GetOrPost[BestCallTime]'>\n");
	print ("<input type='hidden' name='BestPhoneToCall' value='$GetOrPost[BestPhoneToCall]'>\n");
	print ("<input type='hidden' name='email' value='$GetOrPost[email]'>\n");
	print ("<input type='hidden' name='SSN' value='$GetOrPost[SSN]'>\n");
	print ("<input type='hidden' name='Employer' value='$GetOrPost[Employer]'>\n");

	// now format the employer's name
	$Employer = strtolower($Employer);
	$Employer = ucwords($Employer);
	$GetOrPost[Employer]=$Employer;

	print ("<input type='hidden' name='MonthlyIncome' value='$GetOrPost[MonthlyIncome]'>\n");
	print ("<input type='hidden' name='B_2002Income' value='$GetOrPost[B_2002Income]'>\n");
	print ("<input type='hidden' name='EmployerTime' value='$GetOrPost[EmployerTime]'>\n");
	print ("<input type='hidden' name='Position' value='$GetOrPost[Position]'>\n");
	$Position = strtolower($Position);
	$Position = ucwords($Position);
	$GetOrPost[Position]=$Position;

	print ("<input type='hidden' name='Co_ApplicantName' value='$GetOrPost[Co_ApplicantName]'>\n");
	$Co_ApplicantName = strtolower($Co_ApplicantName);
	$Co_ApplicantName = ucwords($Co_ApplicantName);
	$GetOrPost[Co_ApplicantName]= $Co_ApplicantName;

	print ("<input type='hidden' name='Co_DOB' value='$GetOrPost[Co_DOB]'>\n");
	print ("<input type='hidden' name='Co_SSN' value='$GetOrPost[Co_SSN]'>\n");
	print ("<input type='hidden' name='Co_Employer' value='$GetOrPost[Co_Employer]'>\n");
	$Co_Employer = strtolower($Co_Employer);
	$Co_Employer = ucwords($Co_Employer);
	$GetOrPost[Co_Employer]=$Co_Employer;

	print ("<input type='hidden' name='Co_MonthlyIncome' value='$GetOrPost[Co_MonthlyIncome]'>\n");
	print ("<input type='hidden' name='Co_2002Income' value='$GetOrPost[Co_2002Income]'>\n");
	print ("<input type='hidden' name='Co_EmployerTime' value='$GetOrPost[Co_EmployerTime]'>\n");
	print ("<input type='hidden' name='Co_Position' value='$GetOrPost[Co_Position]'>\n");
	$Co_Position = strtolower($Co_Position);
	$Co_Position = ucwords($Co_Position);
	$GetOrPost[Co_Position]=$Co_Position;

	print ("<input type='hidden' name='EstCreditRating' value='$GetOrPost[EstCreditRating]'>\n");
	print ("<input type='hidden' name='MonthlyCreditCardDebt' value='$GetOrPost[MonthlyCreditCardDebt]'>\n");
	print ("<input type='hidden' name='MonthlyOtherDebt' value='$GetOrPost[MonthlyOtherDebt]'>\n");
	print ("<input type='hidden' name='FinanceRequest' value='$GetOrPost[FinanceRequest]'>\n");
	print ("<input type='hidden' name='LoanType' value='$GetOrPost[LoanType]'>\n");
	print ("<input type='hidden' name='LoanAmount' value='$GetOrPost[LoanAmount]'>\n");
	print ("<input type='hidden' name='PropertyType' value='$GetOrPost[PropertyType]'>\n");
	print ("<input type='hidden' name='PurchasePrice' value='$GetOrPost[PurchasePrice]'>\n");
	print ("<input type='hidden' name='EstimatedValue' value='$GetOrPost[EstimatedValue]'>\n");
	print ("<input type='hidden' name='LenderNameOn1st' value='$GetOrPost[LenderNameOn1st]'>\n");
	$LenderNameOn1st = strtolower($LenderNameOn1st);
	$LenderNameOn1st = ucwords($LenderNameOn1st);
	$GetOrPost[LenderNameOn1st]=$LenderNameOn1st;

	print ("<input type='hidden' name='InterestRateOn1st' value='$GetOrPost[InterestRateOn1st]'>\n");
	print ("<input type='hidden' name='LoanBalanceOn1st' value='$GetOrPost[LoanBalanceOn1st]'>\n");
	print ("<input type='hidden' name='MonthlyPaymentOn1st' value='$GetOrPost[MonthlyPaymentOn1st]'>\n");
	print ("<input type='hidden' name='Impounds' value='$GetOrPost[Impounds]'>\n");
	print ("<input type='hidden' name='LenderNameOn2nd' value='$GetOrPost[LenderNameOn2nd]'>\n");
	$LenderNameOn2nd = strtolower($LenderNameOn2nd);
	$LenderNameOn2nd = ucwords($LenderNameOn2nd);
	$GetOrPost[LenderNameOn2nd]=$LenderNameOn2nd;

	print ("<input type='hidden' name='InterestRateOn2nd' value='$GetOrPost[InterestRateOn2nd]'>\n");
	print ("<input type='hidden' name='LoanBalanceOn2nd' value='$GetOrPost[LoanBalanceOn2nd]'>\n");
	print ("<input type='hidden' name='MonthlyPaymentOn2nd' value='$GetOrPost[MonthlyPaymentOn2nd]'>\n");
	print ("<input type='hidden' name='HowReferred' value='$GetOrPost[HowReferred]'>\n");
	print ("<input type='hidden' name='Situation' value='$GetOrPost[Situation]'>\n");
	print ("<input type='hidden' name='recipient' value='$GetOrPost[recipient]'>\n");
	print ("<input type='hidden' name='cc' value='$GetOrPost[cc]'>\n");
	print ("<input type='hidden' name='IPaddress' value='$SavedIPaddress'>\n");
	print ("<input type='hidden' name='redirect' value='$GetOrPost[redirect]'>\n");
	print ("<input type='hidden' name='title' value='$GetOrPost[title]'>\n");
	print ("<input type='hidden' name='Signature' value='$GetOrPost[Signature]'>\n");

	//print ("<br><input type='Submit' value='Continue' name='Continue' id='Continue'>\n");
	//print ("<input type='Reset' value='Make Corrections' onClick='history.back()'>\n");
	
//	This works well for confirmations:
//	print ("<br><input type='Submit' value='Continue' name='Continue' id='Continue' onclick='alert(\"clicked\")'>\n");

	
/*
	// print ("<input type='button' value='regular button'       onClick='alert(\"clicked\")'><br>\n");
	// was onClick='alert(\"clicked\")'><br>\n");

	print ("<input type='button' value='Focus Submit button'  onClick='document.VerifyDataForm.Continue.focus()'>\n");
	print ("<input type='button' value='Blur Submit button'   onClick='document.VerifyDataForm.Continue.blur()'>\n");
	print ("<input type='button' value='Clicks Submit button' onClick='document.VerifyDataForm.Continue.click()'>\n");
*/
	print ("</form></font>\n");


	print ("</td></tr>\n");
	print ("<tr><td colspan='2'><hr></td></tr><tr>\n");
	print (" <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>Applicant Name:</b></font></td>\n");
	print (" <td width=451 height='20' align='left'>\n");
	print (" <font face='Verdana' color='#000066' size='2'>$ApplicantName</font></td></tr>\n");
	print ("<tr>\n");
	print (" <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>Date Of Birth:</b></font></td>\n");
	print (" <td width=451 height='20' align='left'>\n");
	
	print (" <font face='Verdana' color='#000066' size='2'>$DOB</font></td></tr>\n");

	print ("<tr>\n");
	print (" <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>Street:</b></font></td>\n");
	print (" <td width=451 height='20' align='left'>\n");
	print (" <font face='Verdana' color='#000066' size='2'>$Street</font></td></tr>\n");

	print ("<tr>\n");
	print (" <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>City:</b></font></td>\n");
	print (" <td width=451 height='20' align='left'>\n");
	print (" <font face='Verdana' color='#000066' size='2'>$City</font></td></tr>\n");

	print ("<tr>\n");
	print (" <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>State:</b></font></td>\n");
	print (" <td width=451 height='20' align='left'>\n");
	print (" <font face='Verdana' color='#000066' size='2'>$State</font></td></tr>\n");

	print ("<tr>\n");
	print (" <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>Zip:</b></font></td>\n");
	print (" <td width=451 height='20' align='left'>\n");
	print (" <font face='Verdana' color='#000066' size='2'>$Zipcode</font></td></tr>\n");

	print ("<tr>\n");
	print (" <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>Work Phone:</b></font></td>\n");
	print (" <td width=451 height='20' align='left'>\n");
	print (" <font face='Verdana' color='#000066' size='2'>$WorkPhone</font></td></tr>\n");

	print ("<tr>\n");
	print (" <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>Home Phone:</b></font></td>\n");
	print (" <td width=451 height='20' align='left'>\n");
	print (" <font face='Verdana' color='#000066' size='2'>$HomePhone</font></td></tr>\n");

	print ("<tr>\n");
	print (" <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>Best Time To Call:</b></font></td>\n");
	print (" <td width=451 height='20' align='left'>\n");
	print (" <font face='Verdana' color='#000066' size='2'>$BestCallTime</font></td></tr>\n");

	print ("<tr>\n");
	print (" <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>Phone To Call:</b></font></td>\n");
	print (" <td width=451 height='20' align='left'>\n");
	print (" <font face='Verdana' color='#000066' size='2'>$BestCallNumber</font></td></tr>\n");

	print ("<tr>\n");
	print (" <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>E-Mail Address:</b></font></td>\n");
	print (" <td width=451 height='20' align='left'>\n");
	print (" <font face='Verdana' color='#000066' size='2'>$email</font></td></tr>\n");

	print ("<tr>\n");
	print (" <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>Social Security #:</b></font></td>\n");
	print (" <td width=451 height='20' align='left'>\n");
	print (" <font face='Verdana' color='#000066' size='2'>$SSN</font></td></tr>\n");

	print ("<tr>\n");
	print (" <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>Employer:</b></font></td>\n");
	print (" <td width=451 height='20' align='left'>\n");
	print (" <font face='Verdana' color='#000066' size='2'>$Employer</font></td></tr>\n");

	print ("<tr>\n");
	print (" <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>Position:</b></font></td>\n");
	print (" <td width=451 height='20' align='left'>\n");
	print (" <font face='Verdana' color='#000066' size='2'>$Position</font></td></tr>\n");

	print ("<tr>\n");
	print (" <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>Years Of Employment:</b></font></td>\n");
	print (" <td width=451 height='20' align='left'>\n");
	print (" <font face='Verdana' color='#000066' size='2'>$EmployerTime</font></td></tr>\n");

	print ("<tr>\n");
	print (" <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>Monthly Income:</b></font></td>\n");
	print (" <td width=451 height='20' align='left'>\n");
	print (" <font face='Verdana' color='#000066' size='2'>$MonthlyIncome</font></td></tr>\n");

	print ("<tr>\n");
	print (" <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>");
?>
				<script type="text/javascript">
				var Today 	= new Date();
				var ThisYear 	= Today.getFullYear();
				var DayName = Today.getDate();
				var LastYear = ThisYear - 1;
				document.write(LastYear + " Annual Income:</b></font></td>\n");
			</script>	

<?php
	print (" <td width=451 height='20' align='left'>\n");
	print (" <font face='Verdana' color='#000066' size='2'>$B_2002Income</font></td></tr>\n");

	if (($Co_SSN != "") && ($Co_SSN > 0))
	{
		print ("<tr><td colspan='2' align='center'><hr></td></tr>\n");

		print ("<tr>\n");
		print (" <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>CoApplicant's Name:</b></font></td>\n");
		print (" <td width=451 height='20' align='left'>\n");
		print (" <font face='Verdana' color='#000066' size='2'>$Co_ApplicantName</font></td></tr>\n");

		print ("<tr>\n");
		print (" <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>Date Of Birth:</b></font></td>\n");
		print (" <td width=451 height='20' align='left'>\n");
		print (" <font face='Verdana' color='#000066' size='2'>$Co_DOB</font></td></tr>\n");

		print ("<tr>\n");
		print (" <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>Social Security #:</b></font></td>\n");
		print (" <td width=451 height='20' align='left'>\n");
		print (" <font face='Verdana' color='#000066' size='2'>$Co_SSN</font></td></tr>\n");

		print ("<tr>\n");
		print (" <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>Employer:</b></font></td>\n");
		print (" <td width=451 height='20' align='left'>\n");
		print (" <font face='Verdana' color='#000066' size='2'>$Co_Employer</font></td></tr>\n");

		print ("<tr>\n");
		print (" <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>Position:</b></font></td>\n");
		print (" <td width=451 height='20' align='left'>\n");
		print (" <font face='Verdana' color='#000066' size='2'>$Co_Position</font></td></tr>\n");

		print ("   <tr>\n");
		print ("    <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>Years Of Employment:</b></font></td>\n");
		print ("    <td width=451 height='20' align='left'>\n");
		print (" <font face='Verdana' color='#000066' size='2'>$Co_EmployerTime</font></td></tr>\n");

		print ("   <tr>\n");
		print ("    <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>Monthly Income:</b></font></td>\n");
		print ("    <td width=451 height='20' align='left'>\n");
		print ("    <font face='Verdana' color='#000066' size='2'>$Co_MonthlyIncome</font></td></tr>\n");

		print ("   <tr>\n");
		print ("    <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>");
?>		
			<script type="text/javascript">
				document.write(LastYear + " Annual Income:</b></font></td>\n");
			</script>	

<?php
		print ("    <td width=451 height='20' align='left'>\n");
		print (" <font face='Verdana' color='#000066' size='2'>$Co_2002Income</font></td></tr>\n");
	}

	print ("<tr><td colspan='2' align='center'><hr></td></tr>\n");

	print ("<tr>\n");
	print (" <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>Self-described Credit Rating:</b></font></td>\n");
	print (" <td width=451 height='20' align='left'>\n");
	print (" <font face='Verdana' color='#000066' size='2'>$EstCreditRating</font></td></tr>\n");

	print (" <tr>\n");
	print ("    <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>Monthly Credit Card Debt:</b></font></td>\n");
	print ("    <td width=451 height='20' align='left'>\n");
	print ("    <font face='Verdana' color='#000066' size='2'>$MonthlyCreditCardDebt</font></td></tr>\n");

	print ("   <tr>\n");
	print ("    <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>Other Monthly Debt:</b></font></td>\n");
	print ("    <td width=451 height='20' align='left'>\n");
	print ("    <font face='Verdana' color='#000066' size='2'>$MonthlyOtherDebt</font></td></tr>\n");

	print ("   <tr>\n");
	print ("    <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>Requested Loan Amount:</b></font></td>\n");
	print ("    <td width=451 height='20' align='left'>\n");
	print ("    <font face='Verdana' color='#000066' size='2'>$LoanAmount</font></td></tr>\n");

	print ("   <tr>\n");
	print ("    <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>Financing Request Type:</b></font></td>\n");
	print ("    <td width=451 height='20' align='left'>\n");
	print ("    <font face='Verdana' color='#000066' size='2'>$FinanceRequest</font></td></tr>\n");

	print ("   <tr>\n");
	print ("    <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>Loan Type:</b></font></td>\n");
	print ("    <td width=451 height='20' align='left'>\n");
	print ("    <font face='Verdana' color='#000066' size='2'>$LoanType</font></td></tr>\n");
//die("loan type: $LoanType");
	print ("   <tr><td colspan='2' align='center'><hr></td></tr>\n");

	print ("   <tr>\n");
	print ("    <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>Property Type:</b></font></td>\n");
	print ("    <td width=451 height='20' align='left'>\n");
	print ("    <font face='Verdana' color='#000066' size='2'>$PropertyType</font></td></tr>\n");

	print ("   <tr>\n");
	print ("    <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>Purchase Price:</b></font></td>\n");
	print ("    <td width=451 height='20' align='left'>\n");
	print ("    <font face='Verdana' color='#000066' size='2'>$PurchasePrice</font></td></tr>\n");

	print ("   <tr>\n");
	print ("    <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>Estimated Value:</b></font></td>\n");
	print ("    <td width=451 height='20' align='left'>\n");
	print ("    <font face='Verdana' color='#000066' size='2'>$EstimatedValue</font></td></tr>\n");

	print ("   <tr>\n");
	print ("    <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>Current 1st Lender:</b></font></td>\n");
	print ("    <td width=451 height='20' align='left'>\n");
	print ("    <font face='Verdana' color='#000066' size='2'>$LenderNameOn1st</font></td></tr>\n");

	print ("   <tr>\n");
	print ("    <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>Balance on 1st:</b></font></td>\n");
	print ("    <td width=451 height='20' align='left'>\n");
	print ("    <font face='Verdana' color='#000066' size='2'>$LoanBalanceOn1st</font></td></tr>\n");

	print ("   <tr>\n");
	print ("    <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>Interest Rate:</b></font></td>\n");
	print ("    <td width=451 height='20' align='left'>\n");
	print ("    <font face='Verdana' color='#000066' size='2'>$InterestRateOn1st</font></td></tr>\n");

	print ("   <tr>\n");
	print ("    <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>Monthly Payment:</b></font></td>\n");
	print ("    <td width=451 height='20' align='left'>\n");
	print ("    <font face='Verdana' color='#000066' size='2'>$MonthlyPaymentOn1st</font></td></tr>\n");

	print ("   <tr>\n");
	print ("    <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>Includes Taxes &amp; Insurance:</b></font></td>\n");
	print ("    <td width=451 height='20' align='left'>\n");
	print ("    <font face='Verdana' color='#000066' size='2'>$Impounds</font></td></tr>\n");

// * * * * * * * * * * * * * *

//	now use PHP to conditionally display the following lines. We do this because there's no reason to list blank
//	lines because the visitor has no second mortgage. Notice the way HTML is embedded into PHP code. Tricky, huh?


	PrintFor2nd($LenderNameOn2nd, $LoanBalanceOn2nd, $InterestRateOn2nd, $MonthlyPaymentOn2nd);


	print ("   <tr>\n");
	print ("    <td align='right' width='50%' height='20'><font face='Verdana' color='#000066' size='2'><b>You Found Us By:</b></font></td>\n");
	print ("    <td width=451 height='20' align='left'>\n");
	print ("    <font face='Verdana' color='#000066' size='2'>$HowReferred</font></td></tr>\n");


// 	don't show this field to the user
//	print ("<tr>\n");
//	print ("<td align='right' width='50%' height='20' valign='top'><font face='Verdana' color='#000066' size='2'><b>Redirect String:</b></font></td>\n");
//	print ("<td width=451 height='20' align='left'>\n");
//	print ("<font face='Verdana' color='#000066' size='2'>$redirect</font></td></tr>\n");


	print ("   <tr>\n");
	print ("    <td align='right' width='50%' height='20' valign='top'><font face='Verdana' color='#000066' size='2'><b>Present Situation:</b></font></td>\n");
	print ("    <td width=451 height='20' align='left'>\n");
	print (" <font face='Verdana' color='#000066' size='2'><br />\n");
	$SituationLine = explode("\r\n", $Situation);
	
	for ($k=0; $k < count($SituationLine); $k++)
		print("$SituationLine[$k]<br />\n");

	print("</font></td></tr>\n");

    //	This form's action calls eCreditLending's page. The was built in the JavaScript portion of the Loan Application
    //  web page. This PHP file can contain all the html you want plus any php commands. Because the page has a PHP
    //  suffix, the server will strip out the PHP code and execute it itself. The browser will execute the HTML and
  	//	JavaScript.

	// The difference between GET and POST is that a GET method will send all gathered information as part of the URL.

	// A page page generated by a for that used the GET method can be bookmarked.
	// This limits the amount of data that can be passed. For example, you don't want a password visible

	// It is easier to test pages generated by the GET  method because one can manually test the passed parameters
	// on the URL line.

	// The POST method will only not put the gathered data on the URL line where all can see.

	// A page generated by the POST method cannot be Bookmarked.
    // We use Post because the URL has already been manually created in the LoanAppShort.php page JavaScript functions

	print ("<tr><td colspan='2' align='center'><hr><br></td></tr>\n");
	print ("<tr>\n");
	print ("<td colspan='2'><p style='text-align:center;margin:0 auto;width:27em;'>Please review the information before continuing.<br /><br />&nbsp;</p></td></tr>\n");
	print ("<tr><td align='center' colspan='2'>\n");
	print ("<font face='Verdana' color='#000066' size='2'><font face='Verdana'>\n");


	//	When the Submit button is pressed, before performing the desired action, transferring control to LoanAppDB.php,
	//	execute the JavaScript confirm function contained in the onsubmit= parameter
	//	When executing LoanAppDB.php pass the $redirect string and the $GetOrPost array

    print ("<form action='LoanAppDB.php' method='post' name='VerifyDataForm' id='VerifyDataForm'>\n");

	print ("<input type='hidden' name='ApplicantName' value='$GetOrPost[ApplicantName]'>\n");
	print ("<input type='hidden' name='DOB' value='$GetOrPost[DOB]'>\n");
	print ("<input type='hidden' name='Street' value='$GetOrPost[Street]'>\n");
	print ("<input type='hidden' name='PropertyCity' value='$GetOrPost[PropertyCity]'>\n");
	print ("<input type='hidden' name='PropertyState' value='$GetOrPost[PropertyState]'>\n");
	print ("<input type='hidden' name='PropertyZipcode' value='$GetOrPost[PropertyZipcode]'>\n");
	print ("<input type='hidden' name='WorkPhone' value='$GetOrPost[WorkPhone]'>\n");
	print ("<input type='hidden' name='HomePhone' value='$GetOrPost[HomePhone]'>\n");
	print ("<input type='hidden' name='BestCallTime' value='$GetOrPost[BestCallTime]'>\n");
	print ("<input type='hidden' name='BestPhoneToCall' value='$GetOrPost[BestPhoneToCall]'>\n");
	print ("<input type='hidden' name='email' value='$GetOrPost[email]'>\n");
	print ("<input type='hidden' name='SSN' value='$GetOrPost[SSN]'>\n");
	print ("<input type='hidden' name='Employer' value='$GetOrPost[Employer]'>\n");
	print ("<input type='hidden' name='MonthlyIncome' value='$GetOrPost[MonthlyIncome]'>\n");
	print ("<input type='hidden' name='B_2002Income' value='$GetOrPost[B_2002Income]'>\n");
	print ("<input type='hidden' name='EmployerTime' value='$GetOrPost[EmployerTime]'>\n");
	print ("<input type='hidden' name='Position' value='$GetOrPost[Position]'>\n");
	print ("<input type='hidden' name='Co_ApplicantName' value='$GetOrPost[Co_ApplicantName]'>\n");
	print ("<input type='hidden' name='Co_DOB' value='$GetOrPost[Co_DOB]'>\n");
	print ("<input type='hidden' name='Co_SSN' value='$GetOrPost[Co_SSN]'>\n");
	print ("<input type='hidden' name='Co_Employer' value='$GetOrPost[Co_Employer]'>\n");
	print ("<input type='hidden' name='Co_MonthlyIncome' value='$GetOrPost[Co_MonthlyIncome]'>\n");
	print ("<input type='hidden' name='Co_2002Income' value='$GetOrPost[Co_2002Income]'>\n");
	print ("<input type='hidden' name='Co_EmployerTime' value='$GetOrPost[Co_EmployerTime]'>\n");
	print ("<input type='hidden' name='Co_Position' value='$GetOrPost[Co_Position]'>\n");
	print ("<input type='hidden' name='EstCreditRating' value='$GetOrPost[EstCreditRating]'>\n");
	print ("<input type='hidden' name='MonthlyCreditCardDebt' value='$GetOrPost[MonthlyCreditCardDebt]'>\n");
	print ("<input type='hidden' name='MonthlyOtherDebt' value='$GetOrPost[MonthlyOtherDebt]'>\n");
	print ("<input type='hidden' name='FinanceRequest' value='$GetOrPost[FinanceRequest]'>\n");
	print ("<input type='hidden' name='LoanAmount' value='$GetOrPost[LoanAmount]'>\n");
	print ("<input type='hidden' name='LoanType' value='$GetOrPost[LoanType]'>\n");
	print ("<input type='hidden' name='PropertyType' value='$GetOrPost[PropertyType]'>\n");
	print ("<input type='hidden' name='PurchasePrice' value='$GetOrPost[PurchasePrice]'>\n");
	print ("<input type='hidden' name='EstimatedValue' value='$GetOrPost[EstimatedValue]'>\n");
	print ("<input type='hidden' name='LenderNameOn1st' value='$GetOrPost[LenderNameOn1st]'>\n");
	print ("<input type='hidden' name='InterestRateOn1st' value='$GetOrPost[InterestRateOn1st]'>\n");
	print ("<input type='hidden' name='LoanBalanceOn1st' value='$GetOrPost[LoanBalanceOn1st]'>\n");
	print ("<input type='hidden' name='MonthlyPaymentOn1st' value='$GetOrPost[MonthlyPaymentOn1st]'>\n");
	print ("<input type='hidden' name='Impounds' value='$GetOrPost[Impounds]'>\n");
	print ("<input type='hidden' name='LenderNameOn2nd' value='$GetOrPost[LenderNameOn2nd]'>\n");
	print ("<input type='hidden' name='InterestRateOn2nd' value='$GetOrPost[InterestRateOn2nd]'>\n");
	print ("<input type='hidden' name='LoanBalanceOn2nd' value='$GetOrPost[LoanBalanceOn2nd]'>\n");
	print ("<input type='hidden' name='MonthlyPaymentOn2nd' value='$GetOrPost[MonthlyPaymentOn2nd]'>\n");
	print ("<input type='hidden' name='HowReferred' value='$GetOrPost[HowReferred]'>\n");
	
	print ("<input type='hidden' name='Situation' value=".urlencode($GetOrPost[Situation]).">\n");

	print ("<input type='hidden' name='recipient' value='$GetOrPost[recipient]'>\n");
	print ("<input type='hidden' name='cc' value='$GetOrPost[cc]'>\n");
	print ("<input type='hidden' name='IPaddress' value='$SavedIPaddress'>\n");
	print ("<input type='hidden' name='redirect' value='$GetOrPost[redirect]'>\n");
	print ("<input type='hidden' name='title' value='$GetOrPost[title]'>\n");
	print ("<input type='hidden' name='Signature' value='$GetOrPost[Signature]'>\n");

	print ("<br><input style='font-size:small;width:12em;' ");
	print ("onMouseover='this.className=\"MouseOver\"' onMouseout='this.className=\"Submit\"'");
	print ("type='Submit' class='Submit' value='Submit as Entered' name='Continue' id='Continue' onclick=\"this.value='Submitting...'\"> ");
/*
	print ("<input style='font-size:small;width:12em;' ");
	print ("onMouseover='this.className=\"MouseOver\"' onMouseout='this.className=\"Submit\"'");
	print ("type='Reset' class='Submit' value='Make Corrections' onClick='history.back()'>\n");
*/
	print ("</form></font>\n");
//	Ends PHP segment
?>


    </td>
    </tr>
  </table>
 </center>
</div>
    <p style="text-align: center;">
<img border="0" src="../images/Bullseye.gif" alt="Loan Application Received" width="187" height="140">
	</p>
  </tr>

</table>
   </td>
  </tr>
 </table>
 </center>
 </div>
</center>
<?php include("../include/bottom.php"); ?>
</body>
</html>
 
