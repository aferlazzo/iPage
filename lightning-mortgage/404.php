<?php
include('Mail.php');
include('Mail/mime.php');

function SendMessage($Subject, $Message)
{
	$IPaddr = GetIP();

    $To = "anthony";
    $To .= "@lightning-mortgage.com";
        // the email address of the person receiving the email
    $From = "\"A Web Site Visitor\" <web.visitor@lightning-mortgage.com>";
    	//$attachment = "/path/to/someFile.pdf";
        // the path to the file we are attaching to the email

    // Next we must build an array of email headers for the email.
    // This is structured slightly differently to the mail() function.
    // The array key is the header name. Remember that subject
    // is a header too!
	$SendDate = date('r');
    $Headers = array('From'    => $From,
					 'To'      => $To,
                     'Subject' => $Subject,
					 'Date'    => $SendDate);

$Params["host"] = "lightning-mortgage.ipower.com";
$Params["port"] = "25";
$Params["auth"] = false;
$Params["username"] = "anthony@lightning-mortgage.com";
$Params["password"] = "1commguru";


    // Here we create the plaintext version of the email to be sent
    // $textMessage = "Dear John,\n\nThis is a fake email, I hope you enjoy it.\n\nFrom Jane.";
    // set our plaintext message
    // $mime->setTxtBody($textMessage);
    // attach the file to the email
    //$mime->addAttachment($attachment);

    // create a new instance of the Mail_Mime class
    $mime = new Mail_Mime();
    // set our HTML message
    $mime->setHtmlBody($Message);

    // This builds the email message and returns it to $body.
    // This should only be called after all the text, html and
    // attachments are set.
    $Body = $mime->get();

    // This builds the corresponding headers for the plaintext,
    // HTML and any other required headers. It also includes
    // the headers we created earlier by passing them as an argument.
    $Hdrs = $mime->headers($Headers);

    // Creates an instance of the mail backend that we can use
    // to send the email.
    $mail = &Mail::factory("smtp", $Params);

    // Send our email, according to the address in $To, the email
    // headers in $hdrs, and the message body in $body.
    $mail->send($To, $Hdrs, $Body);
}

//~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ -	\\
//								\\
// Get the visitor's IP Address	\\
//								\\
//~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ -	\\

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

// ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~	\\
//																		\\
// A. The IncludePathFileExists() Function to check for existence of 	\\
// php page.															\\
//																		\\
// This is a generic function that steps "B" and "C" use to check 		\\
// whether newp ages exist for non-existent requested pages . 			\\
//																		\\
// ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~	\\

function IncludePathFileExists($OldPath) 
{ 
	$Paths = explode(":", ini_get("include_path")); // get the server's configuration option "include_path"
	$Result = false; 
	
	while( (!($Result)) && (list($Key,$Value) = each($Paths)) ) 
	{ 
		$Result = file_exists($Value . "/" . $OldPath); 
	} 
	
	return $Result;
}


// ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~	\\
//																		\\
// B. Archive pages - send to correct URL			 					\\
//																		\\
// The first and important bit of "B" is: (stristr($REQUEST_URI,  		\\
// "Archive")). This checks the requested URL for the word "Archive."   \\
// All my archive files are saved in the "Archive" directory, so it's a \\
// handy way to spot instantly what the person's looking for. 			\\
//																		\\
// Once the script verifies that yes, the person is looking for an 		\\
// archive file, it replaces the .php with .php. Then it calls the 		\\
// function in "A" to look at the path you've created and see if that  	\\
// new .php page exists. If it does, the new path is saved as a 		\\
// variable called $NewPage. 											\\
//																		\\
// ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~	\\

if (stristr($REQUEST_URI, "Archive"))
{
	$OldArchive = $REQUEST_URI;
	$OldArchive = ereg_replace(".php", ".php", $OldArchive);
	
	if ((IncludePathFileExists($OldArchive)) == 1)
	{
		$NewPage = $OldArchive;
	}
}

// ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~	\\
//																		\\
// C. Static pages - send to correct URL				 				\\
//																		\\
// This function works exactly the same way as "B" above, except that  	\\
// this time we're looking at static pages in the root directory.  		\\
// Because I'm using PHP includes on all my pages, all the old static 	\\
// HTML pages got renamed from a .php extension to a .php extension.	\\
//																		\\
// The first line checks to see if the requested path contains a ".php" \\
// and is NOT an "Archive" (just so we don't process the archive    	\\
// requests twice). Then it follows exactly the same steps as "B". 		\\
//																		\\
// ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~	\\

if ((stristr($REQUEST_URI, ".php")) && (!(stristr($REQUEST_URI, "Archive"))))
{
	$OldPage = $REQUEST_URI;
	$OldPage = ereg_replace(".php", ".php", $OldPage);
	
	if ((IncludePathFileExists($OldPage)) == 1)
	{
		$NewPage = $OldPage;
	}
}

// ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~	\\
//																		\\
// D. Check for moved pages								 				\\
//																		\\
// "B" and "C" work great for pages that you've renamed the extension  	\\
// but left in the same directory, but what about pages that I've moved \\
// or renamed?															\\
//																		\\
// I had a number of files that were originally in the root directory 	\\
// but I moved them into sub-directories to make things neater. 		\\
//																		\\
// ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~	\\

// note that pages at the root level do not need a leading '/'

if (stristr($REQUEST_URI, "open")) 					{ $NewPage = "/Open.php"; }
if (stristr($REQUEST_URI, "login")) 				{ $NewPage = "login.php"; }
if (stristr($REQUEST_URI, "laps")) 					{ $NewPage = "https://host373.ipowerweb.com/~lightnin/LAPS/ApplicantMaster.php"; }
if (stristr($REQUEST_URI, "blog")) 					{ $NewPage = "/Blog/"; }

if (stristr($REQUEST_URI, "/robot.txt")) 		{ $NewPage = "robots.txt"; }
if (stristr($REQUEST_URI, "/Answers.php")) 		{ $NewPage = "Answers.php"; }
if (stristr($REQUEST_URI, "/ArticleLibrary.php")) 		{ $NewPage = "Administrative/ArticleLibrary.php"; }

if ((stristr($REQUEST_URI, "Article.php") == true) && (stristr($REQUEST_URI, "/Administrative/") == false))
										 		{ $NewPage = "Administrative".$REQUEST_URI; }
if (stristr($REQUEST_URI, "/Administrative/index.php")) 	{ $NewPage = "index.php"; }

if (stristr($REQUEST_URI, "zerodown")) 					{ $NewPage = "/LoanTypes/ZeroDown.php"; }
if (stristr($REQUEST_URI, "ZeroDown")) 					{ $NewPage = "/LoanTypes/ZeroDown.php"; }

if (stristr($REQUEST_URI, "GreenSheet")) 				{ $NewPage = "/Administrative/GreenSheet.php"; }

if (stristr($REQUEST_URI, "/Postcard/Welcome.php")) { $NewPage = "/Postcards/Welcome.php"; }
if (stristr($REQUEST_URI, "/LoanTypes.php")) 	{ $NewPage = "LoanTypes.php"; }
if (stristr($REQUEST_URI, "ClosingCosts.php")) 				{ $NewPage = "/Administrative/ClosingCosts.php"; }
if (stristr($REQUEST_URI, "ClosingCosts.php")) 				{ $NewPage = "/Administrative/ClosingCosts.php"; }
if (stristr($REQUEST_URI, "AboutUs.php")) 					{ $NewPage = "/Administrative/AboutUs.php"; }
if (stristr($REQUEST_URI, "Referral")) 						{ $NewPage = "/Administrative/Referral.php"; }
if (stristr($REQUEST_URI, "/Administrative/AboutUs.php")) 	{ $NewPage = "/Administrative/AboutUs.php"; }
if (stristr($REQUEST_URI, "AffiliateLinks.php")) 			{ $NewPage = "/Administrative/AffiliateLinks.php"; }
if (stristr($REQUEST_URI, "Calculators.php")) 				{ $NewPage = "/Administrative/Calculators.php"; }
if (stristr($REQUEST_URI, "ContactUs.php")) 				{ $NewPage = "/Administrative/ContactUs.php"; }
if (stristr($REQUEST_URI, "/Administration/Documentation.php"))		{ $NewPage = "/Administrative/Documentation.php"; }
if (stristr($REQUEST_URI, "ExitSurvey.php")) 				{ $NewPage = "/Administrative/ExitSurvey.php"; }
if (stristr($REQUEST_URI, "ExitSurvey.php")) 				{ $NewPage = "/Administrative/ExitSurvey.php"; }
if (stristr($REQUEST_URI, "Feedback.php")) 					{ $NewPage = "/Administrative/Feedback.php"; }
if (stristr($REQUEST_URI, "Guarantee.php")) 				{ $NewPage = "/Administrative/Guarantee.php"; }
if (stristr($REQUEST_URI, "Legal.php")) 					{ $NewPage = "/Administrative/Legal.php"; }
if (stristr($REQUEST_URI, "PrivacyPolicy.php")) 			{ $NewPage = "/Administrative/PrivacyPolicy.php"; }
if (stristr($REQUEST_URI, "RecommendSite.php"))		 		{ $NewPage = "/Administrative/RecommendSite.php"; }
if (stristr($REQUEST_URI, "SiteMap.php"))		 			{ $NewPage = "/Administrative/SiteMap.php"; }
if (stristr($REQUEST_URI, "UpfrontMortgageBroker.php")) 	{ $NewPage = "/Administrative/UpfrontMortgageBroker.php"; }

if (stristr($REQUEST_URI, "/Answers/Secrets.php")) 			{ $NewPage = "/Answers/MortgageInsiderSecrets.php"; }
if (stristr($REQUEST_URI, "MortgageInsiderSecretsSuccess.php")) 	{ $NewPage = "/Answers/MortgageInsiderSecretsSuccess.php"; }
if (stristr($REQUEST_URI, "/Answers/PreAnswers.php")) 		{ $NewPage = "/Answers/PreAnswers.php"; }
if (stristr($REQUEST_URI, "APRAnswers.php")) 				{ $NewPage = "/Answers/APRAnswers.php"; }
if (stristr($REQUEST_URI, "Documentation.php")) 			{ $NewPage = "/Answers/Documentation.php"; }
if (stristr($REQUEST_URI, "eBookRequest.php")) 				{ $NewPage = "/Answers/eBookRequest.php"; }
if (stristr($REQUEST_URI, "eBookRequestSuccess.php"))		{ $NewPage = "/Answers/eBookRequestSuccess.php"; }
if (stristr($REQUEST_URI, "eBookRequestFailure.php"))		{ $NewPage = "/Answers/eBookRequestFailure.php"; }
if (stristr($REQUEST_URI, "FAQ.php")) 						{ $NewPage = "/Answers/FAQ.php"; }
if (stristr($REQUEST_URI, "GFEExplained.php")) 				{ $NewPage = "/Answers/GFEExplained.php"; }
if (stristr($REQUEST_URI, "/Answers/GFEExplained.php")) 	{ $NewPage = "/Answers/GFEExplained.php"; }
if (stristr($REQUEST_URI, "GlossaryAD.php")) 				{ $NewPage = "/Answers/GlossaryAD.php"; }
if (stristr($REQUEST_URI, "GlossaryEH.php")) 				{ $NewPage = "/Answers/GlossaryEH.php"; }
if (stristr($REQUEST_URI, "GlossaryIL.php")) 				{ $NewPage = "/Answers/GlossaryIL.php"; }
if (stristr($REQUEST_URI, "GlossaryMP.php")) 				{ $NewPage = "/Answers/GlossaryMP.php"; }
if (stristr($REQUEST_URI, "GlossaryQT.php")) 				{ $NewPage = "/Answers/GlossaryQT.php"; }
if (stristr($REQUEST_URI, "GlossaryUZ.php")) 				{ $NewPage = "/Answers/GlossaryUZ.php"; }
if (stristr($REQUEST_URI, "HoldingTitle.php")) 				{ $NewPage = "/Answers/HoldingTitle.php"; }
if (stristr($REQUEST_URI, "/Answers/HUD1Explained.php")) 	{ $NewPage = "/Answers/HUD1Explained.php"; }
if (stristr($REQUEST_URI, "HUD1Explained.php")) 			{ $NewPage = "/Answers/HUD1Explained.php"; }
if (stristr($REQUEST_URI, "ImpoundAccountAnswers.php")) 	{ $NewPage = "/Answers/ImpoundAccountAnswers.php"; }
if (stristr($REQUEST_URI, "MortgageBrokerAnswers.php")) 	{ $NewPage = "/Answers/MortgageBrokerAnswers.php"; }
if (stristr($REQUEST_URI, "MortgageInsiderSecrets.php")) 	{ $NewPage = "/Answers/MortgageInsiderSecrets.php"; }

if (stristr($REQUEST_URI, "MortgageTips.php")) 				{ $NewPage = "/Answers/MortgageTips.php"; }
if (stristr($REQUEST_URI, "PMIAnswers.php")) 				{ $NewPage = "/Answers/PMIAnswers.php"; }
if (stristr($REQUEST_URI, "PreAnswers.php")) 				{ $NewPage = "/Answers/PreAnswers.php"; }
if (stristr($REQUEST_URI, "TILExplained.php")) 				{ $NewPage = "/Answers/TILExplained.php"; }
if (stristr($REQUEST_URI, "WhatsInvolved.php")) 			{ $NewPage = "/Answers/WhatsInvolved.php"; }

// insensitive of case: stristr

if (stristr($REQUEST_URI, "Index1.php")) 	{ $NewPage = "/Index/Financing.php"; }
if (stristr($REQUEST_URI, "Index2.php")) 	{ $NewPage = "/Index/BadCreditRefinancing.php"; }
if (stristr($REQUEST_URI, "Index3.php")) 	{ $NewPage = "/Index/BaitAndSwitch.php"; }

if (stristr($REQUEST_URI, "EducationTaxes.php")) 			{ $NewPage = "/InterestRates/EducationTaxes.php"; }
if (stristr($REQUEST_URI, "InterestRateSetting.php")) 		{ $NewPage = "/InterestRates/InterestRateSetting.php"; }
if (stristr($REQUEST_URI, "InterestRateSweetSpot.php")) 	{ $NewPage = "/InterestRates/InterestRateSweetSpot.php"; }

if (stristr($REQUEST_URI, "HomeBuyerSeminarSlides.php"))	{ $NewPage = "/LoanTypes/HomeBuyerSeminarSlide1.php"; }

if (stristr($REQUEST_URI, "HomeBuyerSeminarSlide1.php"))	{ $NewPage = "/LoanTypes/HomeBuyerSeminarSlide1.php"; }
if (stristr($REQUEST_URI, "HomeBuyerSeminarSlide2.php"))	{ $NewPage = "/LoanTypes/HomeBuyerSeminarSlide2.php"; }
if (stristr($REQUEST_URI, "HomeBuyerSeminarSlide3.php"))	{ $NewPage = "/LoanTypes/HomeBuyerSeminarSlide3.php"; }
if (stristr($REQUEST_URI, "HomeBuyerSeminarSlide4.php"))	{ $NewPage = "/LoanTypes/HomeBuyerSeminarSlide4.php"; }
if (stristr($REQUEST_URI, "HomeBuyerSeminarSlide5.php"))	{ $NewPage = "/LoanTypes/HomeBuyerSeminarSlide5.php"; }
if (stristr($REQUEST_URI, "HomeBuyerSeminarSlide6.php"))	{ $NewPage = "/LoanTypes/HomeBuyerSeminarSlide6.php"; }
if (stristr($REQUEST_URI, "HomeBuyerSeminarSlide7.php"))	{ $NewPage = "/LoanTypes/HomeBuyerSeminarSlide7.php"; }
if (stristr($REQUEST_URI, "HomeBuyerSeminarSlide8.php"))	{ $NewPage = "/LoanTypes/HomeBuyerSeminarSlide8.php"; }
if (stristr($REQUEST_URI, "HomeBuyerSeminarSlide9.php"))	{ $NewPage = "/LoanTypes/HomeBuyerSeminarSlide9.php"; }
if (stristr($REQUEST_URI, "HomeBuyerSeminarSlide10.php"))	{ $NewPage = "/LoanTypes/HomeBuyerSeminarSlide10.php"; }
if (stristr($REQUEST_URI, "HomeBuyerSeminarSlide11.php"))	{ $NewPage = "/LoanTypes/HomeBuyerSeminarSlide11.php"; }
if (stristr($REQUEST_URI, "HomeBuyerSeminarSlide12.php"))	{ $NewPage = "/LoanTypes/HomeBuyerSeminarSlide12.php"; }
if (stristr($REQUEST_URI, "HomeBuyerSeminarSlide13.php"))	{ $NewPage = "/LoanTypes/HomeBuyerSeminarSlide13.php"; }
if (stristr($REQUEST_URI, "HomeBuyerSeminarSlide14.php"))	{ $NewPage = "/LoanTypes/HomeBuyerSeminarSlide14.php"; }
if (stristr($REQUEST_URI, "HomeBuyerSeminarSlide15.php"))	{ $NewPage = "/LoanTypes/HomeBuyerSeminarSlide15.php"; }
if (stristr($REQUEST_URI, "HomeBuyerSeminarSlide16.php"))	{ $NewPage = "/LoanTypes/HomeBuyerSeminarSlide16.php"; }
if (stristr($REQUEST_URI, "HomeBuyerSeminarSlide17.php"))	{ $NewPage = "/LoanTypes/HomeBuyerSeminarSlide17.php"; }
if (stristr($REQUEST_URI, "HomeBuyerSeminarSlide18.php"))	{ $NewPage = "/LoanTypes/HomeBuyerSeminarSlide18.php"; }
if (stristr($REQUEST_URI, "HomeBuyerSeminarSlide19.php"))	{ $NewPage = "/LoanTypes/HomeBuyerSeminarSlide19.php"; }
if (stristr($REQUEST_URI, "HomeBuyerSeminarSlide20.php"))	{ $NewPage = "/LoanTypes/HomeBuyerSeminarSlide20.php"; }
if (stristr($REQUEST_URI, "HomeBuyerSeminarSlide21.php"))	{ $NewPage = "/LoanTypes/HomeBuyerSeminarSlide21.php"; }
if (stristr($REQUEST_URI, "HomeBuyerSeminarSlide22.php"))	{ $NewPage = "/LoanTypes/HomeBuyerSeminarSlide22.php"; }
if (stristr($REQUEST_URI, "HomeBuyerSeminarSlide23.php"))	{ $NewPage = "/LoanTypes/HomeBuyerSeminarSlide23.php"; }
if (stristr($REQUEST_URI, "HomeBuyerSeminarSlide24.php"))	{ $NewPage = "/LoanTypes/HomeBuyerSeminarSlide24.php"; }
if (stristr($REQUEST_URI, "HomeBuyerSeminarSlide25.php"))	{ $NewPage = "/LoanTypes/HomeBuyerSeminarSlide25.php"; }
if (stristr($REQUEST_URI, "HomeBuyerSeminarSlide26.php"))	{ $NewPage = "/LoanTypes/HomeBuyerSeminarSlide26.php"; }
if (stristr($REQUEST_URI, "HomeBuyerSeminarSlide27.php"))	{ $NewPage = "/LoanTypes/HomeBuyerSeminarSlide27.php"; }
if (stristr($REQUEST_URI, "HomeBuyerSeminarSlide28.php"))	{ $NewPage = "/LoanTypes/HomeBuyerSeminarSlide28.php"; }
if (stristr($REQUEST_URI, "HomeBuyerSeminarSlide29.php"))	{ $NewPage = "/LoanTypes/HomeBuyerSeminarSlide29.php"; }
if (stristr($REQUEST_URI, "IncomeDocVariations.php")) 		{ $NewPage = "/LoanTypes/IncomeDocVariations.php"; }

if (stristr($REQUEST_URI, "LoanTypeARM.php")) 				{ $NewPage = "/LoanTypes/ARM.php"; }
if (stristr($REQUEST_URI, "LoanTypeBalloon.php")) 			{ $NewPage = "/LoanTypes/Balloon.php"; }
if (stristr($REQUEST_URI, "LoanTypeBuyDown.php")) 			{ $NewPage = "/LoanTypes/Buydown.php"; }
if (stristr($REQUEST_URI, "LoanTypeBuydown.php")) 			{ $NewPage = "/LoanTypes/Buydown.php"; }
if (stristr($REQUEST_URI, "LoanTypeDescriptions.php")) 		{ $NewPage = "/LoanTypes/LoanTypeDescriptions.php"; }
if (stristr($REQUEST_URI, "LoanTypeFixed.php")) 			{ $NewPage = "/LoanTypes/Fixed.php"; }
if (stristr($REQUEST_URI, "LoanTypeFTHB.php")) 				{ $NewPage = "/LoanTypes/FTHB.php"; }
if (stristr($REQUEST_URI, "LoanTypeHELOC.php")) 			{ $NewPage = "/LoanTypes/HELOC.php"; }
if (stristr($REQUEST_URI, "LoanTypeInterestOnly.php")) 		{ $NewPage = "/LoanTypes/InterestOnly.php"; }
if (stristr($REQUEST_URI, "LoanTypePiggyBack.php")) 		{ $NewPage = "/LoanTypes/Piggyback.php"; }
if (stristr($REQUEST_URI, "LoanTypeZeroDown.php")) 			{ $NewPage = "/LoanTypes/ZeroDown.php"; }
if (stristr($REQUEST_URI, "/LoanTypes/ZeroDown.php"))		{ $NewPage = "/LoanTypes/ZeroDown.php"; }

if (stristr($REQUEST_URI, "ApplyNow")) 				{ $NewPage = "/MortgageApplication/LoanAppShort.php"; }
if (stristr($REQUEST_URI, "LoanAppShort.php")) 			{ $NewPage = "/MortgageApplication/LoanAppShort.php"; }
if (stristr($REQUEST_URI, "LoanAppShort.php")) 			{ $NewPage = "/MortgageApplication/LoanAppShort.php"; }
if (stristr($REQUEST_URI, "LoanAppDB.php")) 			{ $NewPage = "/MortgageApplication/LoanAppDB.php"; }
if (stristr($REQUEST_URI, "OrderCreditCancel.php")) 	{ $NewPage = "/MortgageApplication/OrderCreditCancel.php"; }
if (stristr($REQUEST_URI, "OrderCreditDirect.php")) 	{ $NewPage = "/MortgageApplication/OrderCreditDirect.php"; }
if (stristr($REQUEST_URI, "OrderCreditFailure.php")) 	{ $NewPage = "/MortgageApplication/OrderCreditFailure.php"; }
if (stristr($REQUEST_URI, "OrderCreditSuccess.php")) 	{ $NewPage = "/MortgageApplication/OrderCreditSuccess.php"; }


if (stristr($REQUEST_URI, "/CreditScores/SatisfiedJudgement.php")) 	{ $NewPage = "/CreditScores/SatisfiedJudgment.php"; }
if (stristr($REQUEST_URI, "CreditReportExSpouse.php")) 	{ $NewPage = "/CreditScores/ExSpouse.php"; }
if (stristr($REQUEST_URI, "CreditReportInquiry.php")) 	{ $NewPage = "/CreditScores/Inquiry.php"; }
if (stristr($REQUEST_URI, "CreditReportMistakes1.php")) { $NewPage = "/CreditScores/Mistakes1.php"; }
if (stristr($REQUEST_URI, "CreditReportMistakes2.php")) { $NewPage = "/CreditScores/OthersAccounts.php"; }
if (stristr($REQUEST_URI, "/CreditScores/Mistakes2.php")) { $NewPage = "/CreditScores/OthersAccounts.php"; }
if (stristr($REQUEST_URI, "CreditReportRecords.php")) 	{ $NewPage = "/CreditScores/CreditReportRecords.php"; }
if (stristr($REQUEST_URI, "CreditReportSatisfiedJudgement.php")) { $NewPage = "/CreditScores/SatisfiedJudgement.php"; }
if (stristr($REQUEST_URI, "CreditScoreDefined.php")) 	{ $NewPage = "/CreditScores/CreditScoreDefined.php"; }
if (stristr($REQUEST_URI, "/CreditScores/CreditScoreDefined.php")) 	{ $NewPage = "/CreditScores/CreditScoreDefined.php"; }
if (stristr($REQUEST_URI, "CreditScoreEffects.php")) 	{ $NewPage = "/CreditScores/CreditScoreEffects.php"; }
if (stristr($REQUEST_URI, "CreditScoreEval.php")) 		{ $NewPage = "/CreditScores/CreditScoreEval.php"; }
if (stristr($REQUEST_URI, "CreditScoreImprovements.php")) { $NewPage = "/CreditScores/Improvements.php"; }
if (stristr($REQUEST_URI, "CreditScoresCorrectingMistakes.php")) { $NewPage = "/CreditScores/CorrectingMistakes.php"; }
if (stristr($REQUEST_URI, "FicoScoreDefined.php")) 		{ $NewPage = "/CreditScores/FicoScoreDefined.php"; }
if (stristr($REQUEST_URI, "credit.php")) 			{ $NewPage = "CreditScores.php"; }
if (stristr($REQUEST_URI, "Rates.php")) 			{ $NewPage = "InterestRates.php"; }
if (stristr($REQUEST_URI, "MortgageSecrets.php")) 	{ $NewPage = "/Answers/MortgageInsiderSecrets.php"; }
if (stristr($REQUEST_URI, "MailingListSignUp.php")) { $NewPage = "/Answers/MortgageInsiderSecrets.php"; } 
if (stristr($REQUEST_URI, "Glossary.php")) 			{ $NewPage = "/Answers/GlossaryAD.php"; }

//if (stristr($_SERVER['REQUEST_URI'], "/404.php") == false)  // don't send back a header if called directly
header("HTTP/1.0 404 Not Found");

//Ignore MS Office Discussion Toolbar crap

//if ((stristr($REQUEST_URI, "_vti_bin/owssvr.dll")) || (stristr($REQUEST_URI, "_vti_inf.phpl")))
//{
//	header("HTTP/1.1 200 OK");
//	exit; // make sure not to execute any of the code below this line.
//}

$IPaddr = GetIP();

if ($NewPage)
{
	//print("<p>Don't worry, just a slight delay on your web visit. You've found a link to a page ");
	//print("that was<i>foreclosed</i> upon. <b>You're being redirected to the new and improved page</b> as ");
	//print("we speak. If you don't magically move on in about 5 seconds, try clicking <a ");
	//print("href='$NewPage'>here</a>.</p>");

	$Message  = "<html>";
	$Message .= "<body style='font-family:Verdana,Arial,Helvetica,sans-serif;font-size:small;'>";
	$Message .= "<p>An attempt to visit '".$REQUEST_URI."'<br />";
	$Message .= "resulted in a redirection to '".$NewPage."'<br >";
	$Message .= "for the user at IP address ".$IPaddr.", ".gethostbyaddr($IPaddr)."</p>";
	
	$Message .= "<p>User agent: ".  $_SERVER['HTTP_USER_AGENT'] . "</p>\n";

	$Message .= "<p>Host name: ".  gethostbyaddr($_SERVER['REMOTE_ADDR']) . "</p>\n";

if ($_SERVER['HTTP_REFERER'] != "")
{
	$Message .= "<p>Referrer name: ". $_SERVER['HTTP_REFERER'] . "</p>\n";
	$Message .= "</body></html>";

	$s=$_SERVER['HTTP_REFERER'];
	$s=ereg_replace("&","|",$s);
	$raw=$s=ereg_replace("\?","|",$s);
	$Start = 3 + strpos($s,"|q=");
	if ($Start < 4)   //if not found
	{
		$raw="'q=' not found in |".$s."|";
		$Start = 3 + strpos($s,"|p=");  //try this for a Yahoo search
	}
	else
		$raw="'q=' found in |".$s."| at position ".$Start;
	$s=substr($s,$Start);
	$End=strpos($s,"|");
	if ($End > 0)
		$Searched=substr($s, 0, $End);
	else
		$Searched=$s;
	$Searched=eregi_replace("\+"," ",$Searched);
	$Searched=eregi_replace("%20"," ",$Searched);
	$Searched=eregi_replace("%25","%",$Searched);
	$Searched=eregi_replace("%3F","?",$Searched);

	$s=substr($_SERVER['HTTP_REFERER'],7);
	$x = strpos($s,"/");
	if($x > 0)
		$SearchEngine = substr($s, 0, $x);
	else
		$SearchEngine = $s;
	$Message .= "<p>Search Engine (Referrer): '$SearchEngine', Search Term: '$Searched'</p>\n";
	//die("Testing |$Message|");

	$Message .= "</p><p>(message generated by '".$_SERVER['PHP_SELF']."')</p>";
}

$Subject = "Successful Redirect of ".$REQUEST_URI." by '$SearchEngine', Search Term: '$Searched'";

// ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~	\\
//																\\
// Uncomment the @mail command to have 'Success' messages sent.	\\
//																\\
// An empty search term is a direct hit from a surfer (not the	\\
// result of a search request). No need to email those out, or	\\
// (more likely) a spider visit.								\\
//																\\
// ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~	\\	
	
	//if ($Searched == "")
		//SendMessage($Subject, $Message);
/*
print("$Subject<br />");
print("$Message");
*/


	
// VERY IMPORTANT!!!
// To update search engines and make the move permanent we must use the 301 status code 	\\
// to tell search engines to update their databases.
// For direct hits to old names, do a 302 (temporarily moving URL)

	//if ($Searched == "")
	//header("HTTP/1.1 302 Found");
	//else
	header("HTTP/1.1 301 Moved Permanently");
	
	header("Location: $NewPage");
	exit; // make sure not to execute any of the code below this line.
}
else
{

// ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ - - - -	\\
//																		\\
// If the new page wasn't found, we'll have to get input from the	 	\\
// visitor. The rest of the page is just a nicely done (if I do say so	\\
// myself) 404 Page Not Found error.									\\
//																		\\
// ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ - - - -	\\

	$Message  = "<html>";
	$Message .= "<body style='font-family:Verdana,Arial,Helvetica,sans-serif;font-size:small;'>";
	$Message .= "<p>A request for page '".$REQUEST_URI."' was unfilled because the page was missing.</p>";
	$Message .= "<p>The visitor at IP address ".$IPaddr.", ".gethostbyaddr($IPaddr)." could not be redirected because there is no replacement page.</p>";
	
	if ($REQUEST_URI == $_SERVER['PHP_SELF'])
		$Message .= "<p>Had this been a real error, you would have been told to stay calm and update the 404 error handler.</p>";
	else
		$Message .= "<p>The error handler page, 404.php, doesn't have a redirect page for this page. Please investigate ASAP.</p>";

	$Message .= "<p>User agent: ".  $_SERVER['HTTP_USER_AGENT'] . "</p>\n";
	
	$Message .= "<p>host name: ".  gethostbyaddr($_SERVER['REMOTE_ADDR']) . "</p>\n";
if ($_SERVER['HTTP_REFERER'] != "")
	$Message .= "<p>Referrer name: ".  $_SERVER['HTTP_REFERER'] . "</p>\n";

	$Message .= "<p>(message generated by '".$_SERVER['PHP_SELF']."')</p>";
	$Message .= "</body></html>";
	$Subject = "Error From IP ".$IPaddr." Unsuccessful Redirect of Web Page ".$REQUEST_URI;

	
	
	
	//************************ uncomment to send message *****************************
	//SendMessage($Subject, $Message);
}
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<html>
<head>
<!--
// ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ -	\\
//																			\\
// 404.php Create .htaccess, if necessary									\\
//																			\\
// Go to your website and then type in a bad URL. This error page should 	\\
// come up! If it doesn't, some additional trickery will be necessary. 		\\
// To make the .php version automatically come up as default error  		\\
// handler, I had toc reate a document called .htaccess and put it in my   	\\
// root directory as well.A ll you need to do is open up your text editor 	\\
// and type the line:														\\
//																			\\
// ErrorDocument 404 /~lightnin/404.php										\\
//																			\\
// Then save the file as htaccess.txt. After FTPing it to server (in the 	\\
// directory above public_html), rename it to ".htaccess" (that's just an  	\\
// extension, nob ase name).												\\
//																			\\
// ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ -	\\
-->
<base href="http://www.lightning-mortgage.com/">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

<title>404 Error - Page not found</title>
<script src="http://www.google.com/coop/cse/brand?form=cse-search-box&lang=en" type="text/javascript"></script>
<link rel="stylesheet" href="http://www.lightning-mortgage.com/css/AdministrativeStyles.css" type="text/css">
<link rel="stylesheet" href="./css/Tabs.css" type="text/css">
</head>

<body>
<?php include('include/top-root.php'); ?>
<div id="Heading" style="width:80%;">
<div class="Title"><h1 id="Small">Whoops!<br />This web page is in</h1></div>
<div class="Title">
<div id="Big"><h1>Foreclosure...</h1></div>
<div id="BigShadow"><h1>Foreclosure...</h1></div></div>
</div><br style="clear:left;">

	<table border="0" cellpadding="5" cellspacing="0" width="720">
		<tr>
			<td>

	<p>I know it's around here somewhere...We've done some remodeling and now the page you're 
	looking for,
<?php

if ($_SERVER['HTTP_REFERER'])
	print ("You were sent here by: '".  $_SERVER['HTTP_REFERER'] . "'</p>");

if ($REQUEST_URI == $_SERVER['PHP_SELF'])
	print("(Testing me out, are you?)");
else
	print("<span style='font-weight: bold;'>\"http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].",\"</span>");
?>		
 				cannot be found. It may have been moved or deleted. Or, it might just be misspelled.</p>
 				
 				<p>You're probably best off just going to the 
 				<a href="http://www.lightning-mortgage.com/Administrative/SiteMap.php">Site Map</a> and looking 
 				there. The site's not that complicated even if it does have a lot of pages, 
				so hopefully you'll be able to find what you're looking for. By the 
 				way, the webmaster was just automatically notified of the error.</p>
						
				<p>Click on <a href="javascript:history.back()">RETURN</a>
				to return to the previous page.</p>
				<p>&nbsp;</p>
			</td>
		</tr>
	</table>
<?php include('./include/bottom-root.php'); ?>
</body>
</html>
