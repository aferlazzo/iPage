<?php
		//echo get_include_path();
	
	set_include_path(get_include_path().":.home/public_html/lightning-mortgage.com/pr/phpmailer:.home/public_html/lightning-mortgage.com/pr/phpmailer/language");
	
	//print("<br>\n");
		//echo get_include_path();
		//die("<br>end");



	//error_reporting (E_ALL & ~E_WARNING);
	error_reporting (E_ALL);
	set_error_handler("ReportErrors");

	if ($WithinScript == "I know the arid")
	{
		if ($arid=="") 
		{
			logMessage("GetARstuff (".__LINE__.") did not receive an arid. ");
			if($RE != "")
			{
				logMessage("GetARstuff (".__LINE__.") ERROR: Possible failure unsubscribing '$RE'.");
				echo "<p style='color:#039;font-family:verdana;font-size:x-large;'>Possible failure unsubscribing '$RE'.<br />Please reply to the email that was sent to you, putting 'UNSUBSCRIBE' in the subject line.</p>";
			}
			exit;
		}
//print ("GetARstuff (".__LINE__.") I know the arid... \$arid '$arid'<br />");
		//logMessage("GetARstuff (".__LINE__.") arid |$arid| was captured") ;
		$ar_result = mysql_query("SELECT * FROM autoresponders where arid=$arid", $link);

		if ($ar_result == false)
		{
      echo "<h1>Cannot select arid |$arid|</h1>\n";
      echo "<h1>Script terminated.</h1>\n";	
		  die (logMessage ("GetARstuff (".__LINE__.") Died. Cannot select arid |$arid|"));
    }
	}
	elseif ($WithinScript == "I am embedded in another script")
	{
		$ar_result = mysql_query("SELECT * FROM autoresponders", $link) or die(logMessage("GetARstuff (".__LINE__."): Died. could not select autoresponder db. link '".$link."'")); 		
	}
	else
	{
			$arid=$_GET["arid"];
			
			if ($arid=="") 
			{
				echo "GetARstuff (".__LINE__.") <b>Autoresponder ID not read.<BR>Please go <a href ='void(history.back())'>back</a> and try again<br>";
				exit;
			}
			/*
			else
				logMessage ("GetARstuff (".__LINE__.") arid from GET |$arid|");
			*/
			$ar_result = mysql_query("SELECT * FROM autoresponders where arid=$arid", $link) or die(logMessage("GetARstuff (".__LINE__."); could not select autoresponder where arid=".arid)); 	
	}

	$num_rows = mysql_num_rows($ar_result) or die("<h1 style='background:#fff;'>GetARstuff (".__LINE__.") Error on Campaign '$arid'</h1>");

	if ( $num_rows < 1 ) 
	{
		echo "<b>Unable to find record for selected Autoresponder: $arid.<BR>Please go <a href ='void(history.back())'>back</a> and try again";
		exit;
	}
	
	mysql_data_seek($ar_result, 0) or die("setting(".__LINE__."); could not seek autoresponder");
	$ar_row = mysql_fetch_object($ar_result) or die("setting(".__LINE__."); could not fetch autoresponder");
	
	if ($debugIt == 2)	// display result of fetch in a formatted fashion
	{
		logMessage ("GetARstuff (".__LINE__.") autoresponder contents: $ar_row->arid $ar_row->arname");
	}
$user = $_COOKIE["UName"];
if ($user == '')
  $user = 'admin';
  
  
	$admin_result = mysql_query("SELECT * FROM admin where adminname='$user'", $link) or die("setting(".__LINE__."); could not select admin");
	mysql_data_seek($admin_result, 0) or die("setting(".__LINE__."); could not seek admin");
	$row_admin = mysql_fetch_object($admin_result) or die("setting(".__LINE__."); could not seek admin");
	
	//if ($row_admin->ActivityLogging == 2)	// display result of fetch in a formatted fashion
	//{
	//	logMessage ("GetARstuff (".__LINE__.") admin contents:\n".print_r($row_admin, true));
	//	logMessage ("GetARstuff (".__LINE__.") autoresponder contents:\n".print_r($ar_row, true));
	//}
	
	//admin row
	$Administrator 			= $row_admin->adminname;
	$Administrator_Password = $row_admin->adminpwd;
	$Installation_Path 		= $row_admin->arurl;
	$debugIt 				= $row_admin->ActivityLogging;		// 0 == no logging, 1 == normal logging, 2 == debugging
	$Ad 					= $row_admin->Ad;
	$Notification			= $row_admin->adminemail;
		
	//autoresponder row
	$EmailAddressFrom 		= $ar_row->arfromemail;
	$CampaignDescription	= $ar_row->ardescription;
	$Display_Name 			= $ar_row->arname;
	$EmailAddressReplyTo	= $ar_row->arreplytoemail;
	$EmailAddressReturn 	= $ar_row->arbademail;
	$Administrator_EmailAddress = $ar_row->aradminemail;
	$Subscription_EmailAddress	= $ar_row->arsubemail;
	
	$SMTPmailServer		= $ar_row->smtphostname;
	$SMTPport			= $ar_row->smtpport;
	$SMTPmailbox		= $ar_row->smtpuname;
	$SMTPpassword 		= $ar_row->smtppwd;
	$aa = $ar_row->arid;
//print("<br />GetARstuff (".__LINE__.") autoresponder GLOBAL setting:<br />\$arid $arid<br />\$Display_Name $Display_Name<br />\$EmailAddressFrom $EmailAddressFrom<br />\$SMTPmailServer $SMTPmailServer<br />\$SMTPmailbox $SMTPmailbox<br />\$SMTPpassword $SMTPpassword<br />\$SMTPport $SMTPport<br />\$Wrap_On $Wrap_On<br />\$Length_Of_Wrap $Length_Of_Wrap<br />");
	
	/*
	if (strlen($CampaignDescription) > 0)
	{
	  logMessage ("GetARstuff (".__LINE__.")  number of arids |$num_rows| description |$CampaignDescription| length |".strlen($CampaignDescription)."| SMTP port |$SMTPport| arid |$aa|");
	  //sleep(1);
	}
	*/
	$POPMailServer		= $ar_row->pophostname;
	$POPport			= $ar_row->popport;
	$POPServerName		= $ar_row->popuname;
	$POPEmailPassword	= $ar_row->poppwd;

	$Is_Custom 			= $ar_row->customconf;		// Is there a custom web page?
	$RedirectPage 		= $ar_row->custompage;		// URL of confirmation web page when joining
	
	$Mail_Format 		= $ar_row->aremailformat;	// text or html message format?

	if ($debugIt == 2)	// display result of fetch in a formatted fashion
	{
		logMessage ("GetARstuff (".__LINE__.") \$arid '$arid' \$Mail_Format $Mail_Format");
	}

	$Wrap_On 		= $ar_row->arwordwrap;		// wrap of text messages?
	$Length_Of_Wrap = $ar_row->arwraplen;		// column of text line to wrap
	
	$Remove_Text	= $ar_row->remtext;			// text to send like "click to be removed"
	$Remove_HTML	= $ar_row->remhtml;			// HTML to send like "click to be removed"
	
	$armode			= $ar_row->armode;
	//echo ("<br>GetARstuff debugIt:$debugIt:<br>");


//  - - - - - - - - - - - - // - - - - - - - - - - - - - - - //
?>