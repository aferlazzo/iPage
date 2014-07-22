<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">					  
<html>
<!--
//  . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .	//
//																							//
//	LoanAppDB.php - does the Back-end processing of newly entered applications.				//
//	Date put into production: 6/26/03	- Tony Ferlazzo, copyright, all rights reserved.	//
//	Date Modified	Description																//
//																							//
//	Arguments passed for 																	//
//																							//
//	Once confirmed, the data is added to the Loan Applications database. Next, 				//
//	an e-mail is created and sent. Finally, eCreditLending's credit card page is			//
//	called.																					//
//																							//
//	Initially, the Loan Status is set to "Ne"												//
//	The Status Flag is set to "N"															//
//																							//
//	There is a corresponding error notification e-mailed if any of the following 			//
//	functions fail:																			//
//																							//
//	InsertApplicantInfoTable fills the ApplicantInfo Table. Parameters it passes are:		//
//																							//
//	InsertContactInfoTablefills the ContactInfo Table. Parameters it passes 				//
//																							//
//	InsertEmploymentInfoTable fills the EmploymentInfo Table. Parameters it 				//
//	passes are:																				//
//																							//
//	InsertCoEmploymentInfoTable also fills the EmploymentInfo Table. Parameters 			//
//	it passes are:																			//
//																							//
//	InsertLoanInfoTable fills the LoanInfo Table. Parameters it passes are:					//
//																							//
//	InsertWorkingStatusInfoTable fills the WorkingStatus Info Table. Parameters 			//
//	it passes are:																			//
//																							//
//  . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .	//
-->

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta http-equiv="Content-Language" content="en-us">
<title>Insert Loan App into Database</title>
<meta name="robots" content="NoIndex, NoFollow">
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
<?php
//set_include_path(get_include_path() . PATH_SEPARATOR . '/home/lightnin/public_html/pear/');
include('Mail.php');
include('Mail/mime.php');
function SendMessage($Subject, $Message, $From, $To, $cc)
{
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
$Params["host"] = "mail.lightning-mortgage.com";
$Params["port"] = "25";
$Params["auth"] = true;
$Params["username"] = "anthony@lightning-mortgage.com";
$Params["password"] = "1commguru";

$mail = &Mail::factory("smtp", $Params);
$mail->send($To, $hdrs, $body);
}

$SavedIPaddress='0';	// This must be defined prior to use

include ("../include/SetCookies.php");

//---------------
//
// Create a valid mail header for an HTML formatted message used to notify us that an app has been sent
//
//---------------
function CreateHeader($sender_name, $sender_email, $Recipient, $cc)
{
	$header    = 'MIME-Version: 1.0' . "\r\n";
	$header   .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$header   .= "From: \"".addslashes($sender_name)."\" <".$sender_email.">\r\n";
	$header   .= "Reply-To: ".$sender_email."\r\n";
	$header   .= "X-Priority: 1\r\n";
	$header   .= "X-Mailer: PHP / ".phpversion()."\r\n";
	$header   .= "Cc: ".$cc."\r\n";			// comment out this line to presevent the cc: recipient from
											// getting the message

//	$header   .= "Bcc: ".$another_email."\r\n";
    return $header;
}




// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//
//																						//
//	MailApplicantTableError() Create the mail header and body. Then send the message.	//
//																						//
//																						//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//
function MailApplicantTableError($ApplicantName, $email, $recipient, $cc, $ErrorNo, $ErrorName, $Street,
		$PropertyCity, $PropertyState, $PropertyZipcode, $SSN)
{
	$headers = CreateHeader($ApplicantName, $email, $recipient, $cc);
//	print "Headers:\n$headers";                          /* use date("YmdHis"); for insertion into database */
	$message  = "<p><font face='Verdana' color='#000066' size='2'><b>Date Sent:</b> ".date ("l dS of F Y h:i:s A")."</p>";
	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>IP Address: </b>".$SavedIPaddress."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Applicant Name: </b>".$ApplicantName."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Street: </b>".$Street."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>City: </b>".$PropertyCity."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>State: </b>".$PropertyState."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Zipcode: </b>".$PropertyZipcode."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>SSN: </b>".$SSN."</p>";

  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b><br>Error Number: </b>".$ErrorNo."</p>";
	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Error Name: </b>".$ErrorName."</p>";

	$message .= "<br><center><font face='Verdana' size='5' color='#000080'><strong>Error!</strong></font><br><br>";
	$message .= "<font face='Verdana' size='2' color='#000080'>Applicant Information not added.<br><br>\n";
	$message .= "Social Security Number  <font face='Verdana' size='3' color='#000080'>'$SSN' </font>";
	$message .= "<font face='Verdana' size='2' color='#000080'>is a possible duplicate.</font><br>\n";

//	print "Message Body:\n$message";
    $Subject = $Street.", ".$PropertyCity.", ".$PropertyState." ".$PropertyZipcode." (ApplicantTable Insert Error)";
	mail($recipient, $Subject, $message, $headers);
//	print "Debugging: message sent\nTo:$recipient\nSubject:$Subject\n";
}



// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//
//																								//
//	InsertApplicantInfoTable() Do the ApplicantInfo Table database insert here.					//
//	Befeore attempting to insert the new table entry, see if the SSN matches an existing 		//
//	table entry. If it exists, send an e-mail and do not try to add the SSN to any other tables.//
//	Otherwise,																					//																											//
//																								//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//

function InsertApplicantInfoTable($ApplicantName, $email, $recipient, $cc, $DOB, $SSN, $Co_ApplicantName,
		$Co_DOB, $Co_SSN, $HowReferred, $LoanStatus, $Street, $PropertyCity, $PropertyState, $PropertyZipcode)
{
	global $ApplicantFirstName;
	global $ApplicantLastName;

	$Host="lightning-mortgage.ipowermysql.com";
	$User="lightnin_tony";
	$Password="ipowerwe";
	$DBname="lightnin_LoanApps";
	$TableName="ApplicantInfo";

	/*	First connect to the MySQL DBMS on this server */

	$Link=mysql_connect ($Host, $User, $Password) or die ('I cannot connect to the DBMS because: '.mysql_error());

	$Query = "SELECT * from $TableName where (SSN=$SSN)"; // see if this SSN already exists in database

	//	Returns a positive MySQL result resource to the query result, or FALSE on error.

	$Found = mysql_db_query ($DBname, $Query, $Link); // execute the actual DBMS query
	//echo mysql_errno() . ": " . mysql_error(). "\n";

	if (mysql_errno() > 0)	// pass error information
	{
		while($Row = mysql_fetch_array($Found))
		{
			print ("Found SSN=$Row[SSN] ApplicantName=$Row[ApplicantName]<br>\n");
		}

		mysql_close($Link);

		print ("Error in InsertApplicantInfoTable() at line at line ".__LINE__."<br>");
		print ("ApplicantName $ApplicantName<br>");
		print ("Duplicate SSN ($SSN) was found<br>");
		print ("Sending e-mail about error<br>");

		/*
		MailApplicantTableError($ApplicantName, $email, $recipient, $cc, 0, 'Duplicate SSN exists in database',
			$Street, $PropertyCity, $PropertyState, $PropertyZipcode, $SSN);
		*/
		return(0);
	}
	else		//Now do the inserts
	{
		 //print ("InsertApplicantInfoTable() at line at line ".__LINE__."<br>");
		 //print ("name='ApplicantName' 	value=|$ApplicantName|<br>");
		 //print ("name='DOB' 				value=$DOB<br>");
		 //print ("name='SSN' 				value=$SSN<br>");
		 //print ("name='Co_ApplicantName'	value=$Co_ApplicantName<br>");
		 //print ("name='Co_DOB' 			value=$Co_DOB<br>");
		 //print ("name='Co_SSN' 			value=$Co_SSN<br>");
		 //print ("name='HowReferred'		value=$HowReferred<br>");
		 //print ("name='LoanStatus'		value=$LoanStatus<br>");

		$DateInserted = date ("y/m/d");

		FormatNames();

		//print ("Line ".__LINE__." ApplicantName = :$ApplicantName: ApplicantLastName =:$ApplicantLastName: ApplicantFirstName =:$ApplicantFirstName: Middle = :$Middle:<br>\n");
		//die ("Co_ApplicantName = :$Co_ApplicantName: Co_ApplicantLastName =:$Co_ApplicantLastName: Co_ApplicantFirstName =:$Co_ApplicantFirstName: Middle = :$Middle:<br>\n");

	   	$Query = "INSERT into $TableName values ('$SSN', '$ApplicantName','$ApplicantFirstName','$ApplicantLastName',
	   	  '$DOB', '$Co_SSN', '$Co_ApplicantName','$Co_ApplicantFirstName','$Co_ApplicantLastName',
		    '$Co_DOB', '$HowReferred', '$LoanStatus', '$DateInserted')";

	    //die("Query is: $Query<br>\n");

		mysql_db_query($DBname, $Query, $Link); // execute the actual DBMS insert request

		/* mysql_db_query() returns TRUE on success and FALSE on failure */

		// printf ("Insert to ApplicantInfoTable affected %d rows\n", mysql_affected_rows());

		if (mysql_affected_rows() < 1)	// if insert failed
		{
			/*
			MailApplicantTableError($ApplicantName, $email, $recipient, $cc, 0, 'No row added',
				$Street, $PropertyCity, $PropertyState, $PropertyZipcode, $SSN);	// pass error information
			*/
			return(0);
		}

		mysql_close($Link);
		return(1);
	}
}


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 	//
//																					//
//	MailContactTableError() Create the mail header and body. Then send the message.	//
//																					//
//																					//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -	//

function MailContactTableError($ErrorNo, $ErrorName, $ApplicantName, $email, $recipient, $cc, $SSN,	$Street,
		$PropertyCity,	$PropertyState,	$PropertyZipcode, $WorkPhone, $HomePhone, $BestCallTime,
		$BestCallNumber, $email, $StatusFlag)
{

	$headers = CreateHeader($ApplicantName, $email, $recipient, $cc);
//	print "Headers:\n$headers";                          /* use date("YmdHis"); for insertion into database */
	$message  = "<p><font face='Verdana' color='#000066' size='2'><b>Date Sent:</b> ".date ("l dS of F Y h:i:s A")."</p>";
	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>IP Address: </b>".$IPaddress."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Applicant Name: </b>".$ApplicantName."</p>";
	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>SSN: </b>".$SSN."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Street: </b>".$Street."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>City: </b>".$PropertyCity."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>State: </b>".$PropertyState."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Zipcode: </b>".$PropertyZipcode."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Work Phone: </b>".$WorkPhone."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Home Phone: </b>".$HomePhone."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Best Time To Call: </b>".$BestCallTime."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Best Number To Call: </b>".$BestCallNumber."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Email Address: </b>".$email."</p>";

  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b><br>Error Number: </b>".$ErrorNo."</p>";
	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Error Name: </b>".$ErrorName."</p>";

	$message .= "<br><center><font face='Verdana' size='5' color='#000080'><strong>Error!</strong></font><br><br>";
	$message .= "<font face='Verdana' size='2' color='#000080'>Contact Information not added.<br><br>\n";
	$message .= "Social Security Number  <font face='Verdana' size='3' color='#000080'>'$SSN' </font>";
	$message .= "<font face='Verdana' size='2' color='#000080'>is a possible duplicate.</font><br>\n";

//	print "Message Body:\n$message";
    $Subject = $Street.", ".$PropertyCity.", ".$PropertyState." ".$PropertyZipcode." (ContactTable Insert Error)";
	mail($recipient, $Subject, $message, $headers);
//	print "Debugging: message sent\nTo:$recipient\nSubject:$Subject\n";
}


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -	//
//																						//
//	InsertContactInfoTable() Do the ContactInfo Table database insert here.				//
//																						//
//																						//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -	//

function InsertContactInfoTable($ApplicantName, $email, $recipient, $cc, $SSN, $Street, $PropertyCity,
		$PropertyState, $PropertyZipcode, $WorkPhone, $HomePhone,	$BestCallTime, $BestCallNumber, $email,
		$StatusFlag)
{
	$Host="localhost";
	$User="lightnin_Tony";
	$Password="ipowerwe";
	$DBname="lightnin_LoanApps";
	$TableName="ContactInfo";

	/*	First connect to the MySQL DBMS on this server */

	$Link=mysql_connect ($Host, $User, $Password) or die ('I cannot connect to the DBMS because: '.mysql_error());

	$Query = "SELECT * from $TableName where (SSN=$SSN)"; // see if this SSN already exists in database

	//	Returns a positive MySQL result resource to the query result, or FALSE on error.

	$Found = mysql_db_query ($DBname, $Query, $Link); // execute the actual DBMS query
	//echo mysql_errno() . ": " . mysql_error(). "\n";

	if (mysql_errno() > 0)	// pass error information
	{
		while($Row = mysql_fetch_array($Found))
		{
			print ("Found SSN=$Row[SSN] Street=$Row[Street]<br>\n");
		}

		mysql_close($Link);

		print ("Error in InsertContactInfoTable() at line at line ".__LINE__."<br>");
		print ("Street $Street<br>");
		print ("Duplicate SSN ($SSN) was found<br>");
		print ("Sending e-mail about error<br>");

		/*MailContactTableError(mysql_errno(), mysql_error(), $ApplicantName, $email, $recipient, $cc, $SSN, $Street,
				$PropertyCity, $PropertyState, $PropertyZipcode, $WorkPhone, $HomePhone, $BestCallTime,
				$BestCallNumber, $email, $StatusFlag);	// pass error information
		*/
		return(0);
	}
	else
	{
		//Now do the inserts
/*********
		print ("<pre>");
		print ("InsertContactInfoTable() at line at line ".__LINE__."<br>");
		print ("name='Applicant Name' 		value=$ApplicantName<br>");
		print ("name='SSN' 						value=$SSN<br>");
		print ("name='Street' 					value=$Street<br>");
		print ("name='City' 						value=$PropertyCity<br>");
		print ("name='State' 					value=$PropertyState<br>");
		print ("name='Zipcode' 				value=$PropertyZipcode<br>");
		print ("name='Work Phone' 			value=$WorkPhone<br>");
		print ("name='Home Phone'	 		value=$HomePhone<br>");
		print ("name='Best Time To Call'	value=$BestCallTime<br>");
		print ("name='Best Number To Call'	value=$BestCallNumber<br>");
		print ("name='Email Address'		value=$email<br>");
		print ("name='Status Flag' 			value=$StatusFlag<br>");

		print ("</pre>");
*********/
 	  	$Query = "INSERT into $TableName values ('$SSN', '$Street',	'$PropertyCity', '$PropertyState',
 	  		'$PropertyZipcode', '$WorkPhone', '$HomePhone', '$BestCallTime', '$BestCallNumber',	'$email',
 	  		'$StatusFlag')";

    	// print("Query is: $Query<br>\n");

		mysql_db_query($DBname, $Query, $Link); // execute the actual DBMS insert request

		/* mysql_query() returns TRUE on success and FALSE on failure */

		//	Note: When using UPDATE, MySQL will not update columns where the new
		//	value is the same as the old value. This creates the possiblity that
		//	class=function>mysql_affected_rows() may not actually equal the number of
		//	rows matched, only the number of rows that were literally affected by the query.

		// printf ("Insert to ContactInfoTable affected %d rows<br>\n", mysql_affected_rows());

		if (mysql_affected_rows() < 1)
		{
			/*
			MailContactTableError(0, 'No row added', $ApplicantName, $email, $recipient,
				$cc, $SSN, $Street,	$PropertyCity, $PropertyState, $PropertyZipcode, $WorkPhone, $HomePhone,
				$BestCallTime, $BestCallNumber, $email, $StatusFlag);	// pass error information
			*/
			return(0);
		}

		mysql_close($Link);
		return(1);
	}
}



// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//
//																						//
//	MailEmploymentTableError() Create the mail header and body. Then send the message.	//
//																						//
//																						//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//

function MailEmploymentTableError($ErrorNo, $ErrorName, $ApplicantName, $email, $recipient, $cc, $SSN,
		$Employer, $MonthlyIncome, $Position, $B_2002AnnualIncome, $EmployerTime, $Street, $PropertyCity,
		$PropertyState,	$PropertyZipcode)
{

	$headers = CreateHeader($ApplicantName, $email, $recipient, $cc);
//	print "Headers:\n$headers";                          /* use date("YmdHis"); for insertion into database */
	$message  = "<p><font face='Verdana' color='#000066' size='2'><b>Date Sent:</b> ".date ("l dS of F Y h:i:s A")."</p>";
	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>IP Address: </b>".$SavedIPaddress."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Applicant Name: </b>".$ApplicantName."</p>";
	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>SSN: </b>".$SSN."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Employer Name: </b>".$Employer."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Monthly Income: </b>".$MonthlyIncome."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Last Year's  ";
	
	$message .= " Annual Income: </b>".$B_2002Income."</p>"; 	
	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Length of Employment: </b>".$EmployerTime."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Position Title: </b>".$Position."</p>";

  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Street: </b>".$Street."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>City: </b>".$PropertyCity."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>State: </b>".$PropertyState."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Zipcode: </b>".$PropertyZipcode."</p>";

  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b><br>Error Number: </b>".$ErrorNo."</p>";
	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Error Name: </b>".$ErrorName."</p>";

	$message .= "<br><center><font face='Verdana' size='5' color='#000080'><strong>Error!</strong></font><br><br>";
	$message .= "<font face='Verdana' size='2' color='#000080'>Employment Information not added.<br><br>\n";
	$message .= "Social Security Number  <font face='Verdana' size='3' color='#000080'>'$SSN' </font>";
	$message .= "<font face='Verdana' size='2' color='#000080'>is a possible duplicate.</font><br>\n";

//	print "Message Body:\n$message";
    $Subject = $Street.", ".$PropertyCity.", ".$PropertyState." ".$PropertyZipcode." (EmploymentTable Insert Error)";
	mail($recipient, $Subject, $message, $headers);
//	print "Debugging: message sent\nTo:$recipient\nSubject:$Subject\n";

}




// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//
//																					//
//	InsertEmploymentInfoTable() Do the EmploymentInfo Table database insert here.	//
//																					//
//																					//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//

function InsertEmploymentInfoTable($ApplicantName, $email, $recipient, $cc, $SSN, $Employer, $EmployerTime,
	$Position, $MonthlyIncome, $B_2002AnnualIncome, $Street, $PropertyCity, $PropertyState, $PropertyZipcode)
{
	$Host="localhost";
	$User="lightnin_Tony";
	$Password="ipowerwe";
	$DBname="lightnin_LoanApps";
	$TableName="EmploymentInfo";

	/*	First connect to the MySQL DBMS on this server */

	$Link=mysql_connect ($Host, $User, $Password) or die ('I cannot connect to the DBMS because: '.mysql_error());
	$Query = "SELECT * from $TableName where (SSN=$SSN)"; // see if this SSN already exists in database

	//	Returns a positive MySQL result resource to the query result, or FALSE on error.

	$Found = mysql_db_query ($DBname, $Query, $Link); // execute the actual DBMS query
	//echo mysql_errno() . ": " . mysql_error(). "\n";

	if (mysql_errno() > 0)	// pass error information
	{
		while($Row = mysql_fetch_array($Found))
		{
			print ("Found SSN=$Row[SSN] Employer=$Row[Employer]<br>\n");
		}

		mysql_close($Link);

		print ("Error in InsertEmploymentInfoTable() at line at line ".__LINE__."<br>");
		print ("Employer $Employer<br>");
		print ("Duplicate SSN ($SSN) was found<br>");
		print ("Sending e-mail about error<br>");

		/*
		MailEmploymentTableError(mysql_errno(), mysql_error(), $ApplicantName, $email, $recipient, $cc, $SSN,
				$Employer, $MonthlyIncome, $Position, $B_2002AnnualIncome, $EmployerTime, $Street, $PropertyCity,
				$PropertyState,	$PropertyZipcode);	// pass error information
		*/
		return(0);
	}
	else
	{
		//Now do the inserts
/******************
		print ("<pre>");
		print ("InsertEmploymentInfoTable() at line ".__LINE__."<br>");
		print ("name='ApplicantName' 		value=$ApplicantName<br>");
		print ("name='SSN' 			value=$SSN<br>");
	  	print ("name='Employer'			value=$Employer<br>");
	   	print ("name='Length of Employment' 	value=$EmployerTime<br>");
	  	print ("name='Position Title' 		value=$Position<br>");
	  	print ("name='Monthly Income' 		value=$MonthlyIncome<br>");
	  	print ("name='Year 2007 Annual Income' 	value=$B_2002AnnualIncome<br>");
		print ("</pre>");
****************/
   		$Query = "INSERT into $TableName values
   			('$SSN', '$Employer', '$Position', '$MonthlyIncome', '$B_2002AnnualIncome', '$EmployerTime')";

    	// print("Query is: $Query<br>\n");

		mysql_db_query($DBname, $Query, $Link); // execute the actual DBMS insert request

		/* mysql_query() returns TRUE on success and FALSE on failure */

		//	Note: When using UPDATE, MySQL will not update columns where the new
		//	value is the same as the old value. This creates the possiblity that
		//	class=function>mysql_affected_rows() may not actually equal the number of
		//	rows matched, only the number of rows that were literally affected by the query.

		//	printf ("Insert to EmploymentInfoTable affected %d rows<br>\n", mysql_affected_rows());

		if (mysql_affected_rows() < 1)
		{
			/*
			MailEmploymentTableError(mysql_errno(), mysql_error(), $ApplicantName, $email, $recipient, $cc, $SSN,
					$Employer, $MonthlyIncome, $Position, $B_2002AnnualIncome, $EmployerTime, $Street, $PropertyCity,
					$PropertyState,	$PropertyZipcode);	// pass error information
			*/
			return(0);
		}

		mysql_close($Link);
		return(1);
	}
}



// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//
//																							//
//	MailCoEmploymentTableError() Create the mail header and body. Then send the message.	//
//																							//
//																							//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//

function MailCoEmploymentTableError($ErrorNo, $ErrorName, $ApplicantName, $email, $recipient, $cc, $Co_SSN,
	$Co_Employer, $Co_MonthlyIncome, $Co_Position, $Co_2002Income, $EmployerTime, $Street, $PropertyCity,
	$PropertyState, $PropertyZipcode)
{

	$headers = CreateHeader($ApplicantName, $email, $recipient, $cc);
//	print "Headers:\n$headers";                          /* use date("YmdHis"); for insertion into database */
	$message  = "<p><font face='Verdana' color='#000066' size='2'><b>Date Sent:</b> ".date ("l dS of F Y h:i:s A")."</p>";
	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>IP Address: </b>".$SavedIPaddress."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Applicant Name: </b>".$ApplicantName."</p>";

	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Co_SSN: </b>".$Co_SSN."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Co_Employer Name: </b>".$Co_Employer."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Length of Employment:</b>".$Co_EmployerTime."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Co_Monthly Income: </b>".$Co_MonthlyIncome."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Co_Annual Income: </b>".$Co_2002Income."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Co_Position Title: </b>".$Co_Position."</p>";

  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Street: </b>".$Street."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>City: </b>".$PropertyCity."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>State: </b>".$PropertyState."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Zipcode: </b>".$PropertyZipcode."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>SSN: </b>".$Co_SSN."</p>";

  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b><br>Error Number: </b>".$ErrorNo."</p>";
	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Error Name: </b>".$ErrorName."</p>";
	$message .= "<br><center><font face='Verdana' size='5' color='#000080'><strong>Error!</strong></font><br><br>";
	$message .= "<font face='Verdana' size='2' color='#000080'>CoEmployment Information not added.<br><br>\n";
	$message .= "Social Security Number  <font face='Verdana' size='3' color='#000080'>'$SSN' </font>";
	$message .= "<font face='Verdana' size='2' color='#000080'>is a possible duplicate.</font><br>\n";

//	print "Message Body:\n$message";
    $Subject = $Street.", ".$PropertyCity.", ".$PropertyState." ".$PropertyZipcode." (Co-EmploymentTable Insert Error)";
	mail($recipient, $Subject, $message, $headers);
//	print "Debugging: message sent\nTo:$recipient\nSubject:$Subject\n";

}




// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//
//																					//
//	InsertCoEmploymentInfoTable() Do the EmploymentInfo Table database insert here.	//
//																					//
//																					//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//

function InsertCoEmploymentInfoTable($Co_ApplicantName, $ApplicantName, $email, $recipient, $cc, $Co_SSN,
	$Co_Employer, $Co_EmployerTime, $Co_Position, $Co_MonthlyIncome, $Co_2002Income, $Street, $PropertyCity,
	$PropertyState,	$PropertyZipcode)
{
	if (($Co_SSN == 0) || ($Co_SSN == ""))  // if there is no co-applicant
		return(0);

	$Host="localhost";
	$User="lightnin_Tony";
	$Password="ipowerwe";
	$DBname="lightnin_LoanApps";
	$TableName="EmploymentInfo";

	/*	First connect to the MySQL DBMS on this server */


	$Link=mysql_connect ($Host, $User, $Password) or die ('I cannot connect to the DBMS because: '.mysql_error());
	$Query = "SELECT * from $TableName where (SSN=$Co_SSN)"; // see if this SSN already exists in database

	//	Returns a positive MySQL result resource to the query result, or FALSE on error.

	$Found = mysql_db_query ($DBname, $Query, $Link); // execute the actual DBMS query
	//echo mysql_errno() . ": " . mysql_error(). "\n";

	if (mysql_errno() > 0)	// pass error information
	{
		while($Row = mysql_fetch_array($Found))
		{
			print ("Found SSN=$Row[SSN] Employer=$Row[Employer]<br>\n");
		}

		mysql_close($Link);

		print ("Error in InsertCoEmploymentInfoTable() at line at line ".__LINE__."<br>");
		print ("Employer $Employer<br>");
		print ("Duplicate SSN ($SSN) was found<br>");
		print ("Sending e-mail about error<br>");

		/*
		MailCoEmploymentTableError(mysql_errno(), mysql_error(), $ApplicantName, $email,
			$recipient, $cc, $Co_SSN, $Co_Employer,	$Co_MonthlyIncome, $Co_Position, $Co_2002Income,
			$Co_EmployerTime, $Street, $PropertyCity, $PropertyState, $PropertyZipcode); // pass error information
		*/
		return(0);
	}
	else
	{	//Now do the inserts
/***************
		print ("<pre>");
		print ("InsertCoEmploymentInfoTable() at line ".__LINE__."<br>");
		print ("name='ApplicantName' 			value=$Co_ApplicantName<br>");
		print ("name='SSN' 				value=$Co_SSN<br>");
	  	print ("name='Employer Name' 			value=$Co_Employer<br>");
	  	print ("name='Length of Employment' 		value=$Co_EmployerTime<br>");
	  	print ("name='Position Title' 			value=$Co_Position<br>");
	  	print ("name='Monthly Income' 			value=$Co_MonthlyIncome<br>");
	  	print ("name='2007 Annual Income' 		value=$Co_2002Income<br>");
		print ("</pre>");
***************/
	   	$Query = "INSERT into $TableName values
	   		('$Co_SSN', '$Co_Employer', '$Co_Position', '$Co_MonthlyIncome', '$Co_2002Income', '$Co_EmployerTime')";

    	//print("Query is: $Query<br>\n");

		mysql_db_query($DBname, $Query, $Link); // execute the actual DBMS insert request

		/* mysql_query() returns TRUE on success and FALSE on failure */

		//	Note: When using UPDATE, MySQL will not update columns where the new
		//	value is the same as the old value. This creates the possiblity that
		//	class=function>mysql_affected_rows() may not actually equal the number of
		//	rows matched, only the number of rows that were literally affected by the query.

		//	printf ("Insert to CoEmploymentInfoTable affected %d rows<br>\n", mysql_affected_rows());

		if (mysql_affected_rows() < 1)
		{
			/*
			MailCoEmploymentTableError(mysql_errno(), mysql_error(), $ApplicantName, $email,
				$recipient, $cc, $Co_SSN, $Co_Employer,	$Co_MonthlyIncome, $Co_Position, $Co_2002Income,
				$Co_EmployerTime, $Street, $PropertyCity, $PropertyState, $PropertyZipcode); // pass error information
			*/
			return(0);
		}

		mysql_close($Link);
		return(1);
	}
}



// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//
//																											//
//	MailLoanTableInfoError() Create the mail header and body. Then send the message.						//
//																											//
//																											//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//
function MailLoanInfoTableError($ErrorNo, $ErrorName, $ApplicantName, $email, $recipient, $cc, $LoanAmount,
	$FinancePurpose, $PurchasePrice, $EstimatedValue, $LenderNameOn1st,	$BalanceOn1st, 	$InterestRateOn1st,
	$MonthlyPaymentOn1st, $Impounds, $LenderNameOn2nd, $BalanceOn2nd, $InterestRateOn2nd, $CreditReport,
	$MonthlyPaymentOn2nd, $MonthlyCreditCardDebt, $SSN, $FinanceRequest, $EstCreditRating, $MonthlyOtherDebt,
	$PropertyType, $Street, $PropertyCity, $PropertyState,	$PropertyZipcode)
{
  	$headers = CreateHeader($ApplicantName, $email, $recipient, $cc);
//	print "Headers:\n$headers";                          /* use date("YmdHis"); for insertion into database */
	$message  = "<p><font face='Verdana' color='#000066' size='2'><b>Date Sent:</b> ".date ("l dS of F Y h:i:s A")."</p>";
	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>IP Address: </b>".$SavedIPaddress."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Applicant Name: </b>".$ApplicantName."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>SSN: </b>".$SSN."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Self-described Credit Rating: </b>".$EstCreditRating."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Monthly Credit Card Payments: </b>".$MonthlyCreditCardDebt."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Other Monthly Debt: </b>".$MonthlyOtherDebt."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Requested Loan Amount: </b>".$LoanAmount."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Requested Loan Type: </b>".$LoanType."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Finance Request: </b>".$FinanceRequest."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Property Type: </b>".$PropertyType."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Purchase Price: </b>".$PurchasePrice."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Estimated Value: </b>".$EstimatedValue."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Current 1st Lender Name: </b>".$LenderNameOn1st."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Loan Balance On 1st: </b>".$LoanBalanceOn1st."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Interest Rate: </b>".$InterestRateOn1st."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Monthly Payment: </b>".$MonthlyPaymentOn1st."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Impounds: </b>".$Impounds."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Current 2nd Lender Name: </b>".$LenderNameOn2nd."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Loan Balance: </b>".$LoanBalanceOn2nd."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Interest Rate: </b>".$InterestRateOn2nd."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Monthly Payment: </b>".$MonthlyPaymentOn2nd."</p>";

  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Street: </b>".$Street."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>City: </b>".$PropertyCity."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>State: </b>".$PropertyState."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Zipcode: </b>".$PropertyZipcode."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>SSN: </b>".$Co_SSN."</p>";

  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b><br>Error Number: </b>".$ErrorNo."</p>";
	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Error Name: </b>".$ErrorName."</p>";

	$message .= "<br><center><font face='Verdana' size='5' color='#000080'><strong>Error!</strong></font><br><br>";
	$message .= "<font face='Verdana' size='2' color='#000080'>Loan Information not added.<br><br>\n";
	$message .= "Social Security Number  <font face='Verdana' size='3' color='#000080'>'$SSN' </font>";
	$message .= "<font face='Verdana' size='2' color='#000080'>is a possible duplicate Social Security Number.</font><br>\n";

//	print "Message Body:\n$message";
    $Subject = $Street.", ".$PropertyCity.", ".$PropertyState." ".$PropertyZipcode." (LoanTable Insert Error)";
	mail($recipient, $Subject, $message, $headers);
//	print "Debugging: message sent\nTo:$recipient\nSubject:$Subject\n";
}




// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 	//
//																			//
//	InsertLoanInfoTable() Do the LoanInfo Table database insert here.		//
//																			//
//																			//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -	//

function InsertLoanInfoTable($ApplicantName, $email, $recipient, $cc, $EstCreditRating, $LoanAmount,
	$FinanceRequest, $PurchasePrice, $EstimatedValue, $LenderNameOn1st,	$LoanBalanceOn1st, 	$InterestRateOn1st,
	$MonthlyPaymentOn1st, $Impounds, $LenderNameOn2nd, $LoanBalanceOn2nd, $InterestRateOn2nd, $CreditReport,
	$MonthlyPaymentOn2nd, $MonthlyCreditCardDebt, $SSN, $FinanceRequest, $EstCreditRating, $MonthlyOtherDebt,
	$PropertyType, $Street, $PropertyCity, $PropertyState,	$PropertyZipcode)
{
	$Host="localhost";
	$User="lightnin_Tony";
	$Password="ipowerwe";
	$DBname="lightnin_LoanApps";
	$TableName="LoanInfo";

	/*	First connect to the MySQL DBMS on this server */

	$Link=mysql_connect ($Host, $User, $Password) or die ('I cannot connect to the DBMS because: '.mysql_error());

	$Query = "SELECT * from $TableName where (SSN=$SSN)"; // see if this SSN already exists in database

	//	Returns a positive MySQL result resource to the query result, or FALSE on error.

	$Found = mysql_db_query ($DBname, $Query, $Link); // execute the actual DBMS query
	//echo mysql_errno() . ": " . mysql_error(). "\n";

	if (mysql_errno() > 0)	// pass error information
	{
		while($Row = mysql_fetch_array($Found))
		{
			print ("Found SSN=$Row[SSN] FinanceRequest=$Row[FinanceRequest]<br>\n");
		}

		mysql_close($Link);

		print ("Error in InsertLoanInfoTable() at line at line ".__LINE__."<br>");
		print ("FinanceRequest $FinanceRequest<br>");
		print ("Duplicate SSN ($SSN) was found<br>");
		print ("Sending e-mail about error<br>");

		/*
		MailLoanInfoTableError(mysql_errno(), mysql_error(), $ApplicantName, $email, $recipient, $cc, $LoanAmount,
			$FinanceRequest, $PurchasePrice, $EstimatedValue, $LenderNameOn1st,	$BalanceOn1st, 	$InterestRateOn1st,
			$MonthlyPaymentOn1st, $Impounds, $LenderNameOn2nd,	$BalanceOn2nd, $InterestRateOn2nd, $CreditReport,
			$MonthlyPaymentOn2nd, $MonthlyCreditCardDebt, $SSN, $FinanceRequest, $EstCreditRating,
			$MonthlyOtherDebt, $PropertyType, $Street, $PropertyCity, $PropertyState, $PropertyZipcode);
			// pass error information
		*/
		return(0);
	}
	else
	{	//Now do the inserts
/**************
		print ("<pre>");
		print ("InsertLoanInfoTable() at line ".__LINE__."<br>");
		print ("name=SSN 				value=$SSN<br>");
		print ("name=Self-described Credit Rating	value=$EstCreditRating<br>");
	  	print ("name=Monthly Credit Card Payments	value=$MonthlyCreditCardDebt<br>");
	  	print ("name=Other Monthly Debt			value=$MonthlyOtherDebt<br>");
	  	print ("name=Requested Loan Amount		value=$LoanAmount<br>");
	  	print ("name=Requested Loan Type		value=$LoanType<br>");
	  	print ("name=Finance Request			value=$FinanceRequest<br>");
	  	print ("name=Property Type			value=$PropertyType<br>");
	  	print ("name=Purchase Price			value=$PurchasePrice<br>");
	  	print ("name=Estimated Value			value=$EstimatedValue<br>");
	  	print ("name=Lender Name On 1st 		value=$LenderNameOn1st<br>");
	  	print ("name=Loan Balance On 1st		value=$LoanBalanceOn1st<br>");
	  	print ("name=Interest Rate On 1st		value=$InterestRateOn1st<br>");
	  	print ("name=Monthly Payment On 1st		value=$MonthlyPaymentOn1st<br>");
	  	print ("name=Impounds				value=$Impounds<br>");
	  	print ("name=Lender Name On 2nd 		value=$LenderNameOn2nd<br>");
	  	print ("name=Loan Balance On 2nd		value=$LoanBalanceOn2nd<br>");
	  	print ("name=Interest Rate On 2nd		value=$InterestRateOn2nd<br>");
	  	print ("name=Monthly Payment On 2nd		value=$MonthlyPaymentOn2nd<br>");
		print ("</pre>");
****************/
		$Query = "INSERT $TableName SET	RequestedLoanAmount='$LoanAmount', LoanPurpose='$FinanceRequest',
			PurchasePrice='$PurchasePrice', EstimatedValue='$EstimatedValue', LenderNameOn1st='$LenderNameOn1st',
			BalanceOn1st='$LoanBalanceOn1st', InterestRateOn1st='$InterestRateOn1st',
			MonthlyPaymentOn1st='$MonthlyPaymentOn1st', Impounds='$Impounds', LenderNameOn2nd='$LenderNameOn2nd',
			BalanceOn2nd='$LoanBalanceOn2nd', InterestRateOn2nd='$InterestRateOn2nd', 	MonthlyPaymentOn2nd='$MonthlyPaymentOn2nd', CreditReport='$CreditReport', SSN='$SSN'";

		//	print("Query is: $Query<br>\n");

		mysql_db_query($DBname, $Query, $Link); // execute the actual DBMS insert request

		/* mysql_query() returns TRUE on success and FALSE on failure */

		//	Note: When using UPDATE, MySQL will not update columns where the new
		//	value is the same as the old value. This creates the possiblity that
		//	class=function>mysql_affected_rows() may not actually equal the number of
		//	rows matched, only the number of rows that were literally affected by the query.

		//	printf ("Insert to LoanInfoTable affected %d rows<br>\n", mysql_affected_rows());

		if (mysql_affected_rows() < 1)
		{
			/*
			MailLoanInfoTableError(mysql_errno(), mysql_error(), $ApplicantName, $email, $recipient, $cc, $LoanAmount,
				$FinanceRequest, $PurchasePrice, $EstimatedValue, $LenderNameOn1st,	$BalanceOn1st, 	$InterestRateOn1st,
				$MonthlyPaymentOn1st, $Impounds, $LenderNameOn2nd,	$BalanceOn2nd, $InterestRateOn2nd, $CreditReport,
				$MonthlyPaymentOn2nd, $MonthlyCreditCardDebt, $SSN, $FinanceRequest, $EstCreditRating,
				$MonthlyOtherDebt, $PropertyType, $Street, $PropertyCity, $PropertyState, $PropertyZipcode);
				// pass error information
			*/
			return(0);
		}

		mysql_close($Link);
		return(1);
	}
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -	//
//																																	//
//	MailWorkingStatusTableError() Create the mail header and body. Then send the message.	//
//																																	//
//																																	//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -	//

function MailWorkingStatusTableError($ErrorNo, $ErrorName, $ApplicantName, $email, $recipient, $cc, $SSN,
		$Situation)
{

	$headers = CreateHeader($ApplicantName, $email, $recipient, $cc);
//	print "Headers:\n$headers";                          /* use date("YmdHis"); for insertion into database */
	$message  = "<p><font face='Verdana' color='#000066' size='2'><b>Date Sent:</b> ".date ("l dS of F Y h:i:s A")."</p>";
	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>IP Address: </b>".$SavedIPaddress."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Applicant Name: </b>".$ApplicantName."</p>";
	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>SSN: </b>".$SSN."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Comments: </b>".$Situation."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>ReportDare: </b>".date ("l dS of F Y h:i:s A")."</p>";

  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Street: </b>".$Street."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>City: </b>".$PropertyCity."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>State: </b>".$PropertyState."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Zipcode: </b>".$PropertyZipcode."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>SSN: </b>".$Co_SSN."</p>";

  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b><br>Error Number: </b>".$ErrorNo."</p>";
	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Error Name: </b>".$ErrorName."</p>";

	$message .= "<br><center><font face='Verdana' size='5' color='#000080'><strong>Error!</strong></font><br><br>";
	$message .= "<font face='Verdana' size='2' color='#000080'>Working Status Information not added.<br><br>\n";
	$message .= "Social Security Number  <font face='Verdana' size='3' color='#000080'>'$SSN' </font>";
	$message .= "<font face='Verdana' size='2' color='#000080'>is a possible duplicate Social Security Number.</font><br>\n";

//	print "Message Body:\n$message";
    $Subject = $Street.", ".$PropertyCity.", ".$PropertyState." ".$PropertyZipcode." (New Loan App for you)";
	mail($recipient, $Subject, $message, $headers);
//	print "Debugging: message sent\nTo:$recipient\nSubject:$Subject\n";

}


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//
//																															//
//	InsertWorkingStatusInfoTable() Do the WorkingStatusInfo Table database insert here.	//
//																															//
//																															//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//

function InsertWorkingStatusInfoTable($ApplicantName, $email, $recipient, $cc, $SSN, $Situation, $Street,
	$PropertyCity, $PropertyState, $PropertyZipcode)
{
	$Host="localhost";
	$User="lightnin_Tony";
	$Password="ipowerwe";
	$DBname="lightnin_LoanApps";
	$TableName="WorkingStatusInfo";

	/*	First connect to the MySQL DBMS on this server */

	$Link=mysql_connect ($Host, $User, $Password) or die ('I cannot connect to the DBMS because: '.mysql_error());
	$Query = "SELECT * from $TableName where (SSN=$SSN)"; // see if this SSN already exists in database

	//	Returns a positive MySQL result resource to the query result, or FALSE on error.

	$Found = mysql_db_query ($DBname, $Query, $Link); // execute the actual DBMS query
	//echo mysql_errno() . ": " . mysql_error(). "\n";

	if (mysql_errno() > 0)	// pass error information
	{
		while($Row = mysql_fetch_array($Found))
		{
			print ("Found SSN=$Row[SSN]<br>\n");
		}

		mysql_close($Link);
		print ("Error in InsertWorkingStatusInfoTable() at line at line ".__LINE__."<br>");
		print ("Employer $Employer<br>");
		print ("Duplicate SSN ($SSN) was found<br>");
		print ("Sending e-mail about error<br>");

		/*
		MailWorkingStatusTableError(mysql_errno(), mysql_error(), $ApplicantName, $email, $recipient, $cc, $SSN,
				$Situation);	// pass error information
		*/
		return(0);
	}
	else
	{ 	//Now do the inserts

		$ReportDate= date ("y/m/d");

/*****************
		print ("<pre>");
		print ("InsertWorkingStatusInfoTable() at line ".__LINE__."<br>");
		print ("name=SSN 		value=$SSN<br>");
		print ("name=Comments		value=$Situation<br>");
				print ("name=ReportDate		value=$ReportDate<br>");
		print ("</pre>");
*********************/
		if ($Situation == "")
			$Comments="Applicant comment submitted with the application: None";
		else
			$Comments="Applicant comment submitted with the application: ".addslashes($Situation);
			
		$PointStatus='Select One';
		$Query = "INSERT into $TableName values ('$id', '$SSN', '$Comments', '$ReportDate', '$PointStatus')";

		//	print("Query is: $Query<br>\n");

		mysql_db_query($DBname, $Query, $Link); // execute the actual DBMS insert request

		/* mysql_query() returns TRUE on success and FALSE on failure */

		//	Note: When using UPDATE, MySQL will not update columns where the new
		//	value is the same as the old value. This creates the possiblity that
		//	class=function>mysql_affected_rows() may not actually equal the number of
		//	rows matched, only the number of rows that were literally affected by the query.

		//	printf ("Insert to WorkingStatusInfoTable affected %d rows<br>\n", mysql_affected_rows());

		if (mysql_affected_rows() < 1)
		{
			/*
			MailWorkingStatusTableError(mysql_errno(), mysql_error(), $ApplicantName, $email, $recipient, $cc, $SSN,
					$Comments);	// pass error information
			*/
			return(0);
		}

		mysql_close($Link);
		// die("<br>At line ".__LINE__." Stopping for this test<br>\n");
		return(1);
	}
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -- - - - - - - - 	//
//																														//
//	MailUsersTableError() Create the mail header and body. Then send the message.		//
//																														//
//																														//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -	//

function MailUsersTableError($ErrorNo, $ErrorName, $ApplicantName, $email, $recipient, $cc, $SSN)
{

	$headers = CreateHeader($ApplicantName, $email, $recipient, $cc);
//	print "Headers:\n$headers";                          /* use date("YmdHis"); for insertion into database */
	$message  = "<p><font face='Verdana' color='#000066' size='2'><b>Date Sent:</b> ".date ("l dS of F Y h:i:s A")."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Applicant Name: </b>".$ApplicantName."</p>";
	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>SSN: </b>".$SSN."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>ReportDare: </b>".date ("l dS of F Y h:i:s A")."</p>";

  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Street: </b>".$Street."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>City: </b>".$PropertyCity."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>State: </b>".$PropertyState."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Zipcode: </b>".$PropertyZipcode."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>SSN: </b>".$Co_SSN."</p>";

  	$message .= "<p><font face='Verdana' color='#000066' size='2'><b><br>Error Number: </b>".$ErrorNo."</p>";
	$message .= "<p><font face='Verdana' color='#000066' size='2'><b>Error Name: </b>".$ErrorName."</p>";

	$message .= "<br><center><font face='Verdana' size='5' color='#000080'><strong>Error!</strong></font><br><br>";
	$message .= "<font face='Verdana' size='2' color='#000080'>Working Status Information not added.<br><br>\n";
	$message .= "Social Security Number  <font face='Verdana' size='3' color='#000080'>'$SSN' </font>";
	$message .= "<font face='Verdana' size='2' color='#000080'>is a possible duplicate Social Security Number.</font><br>\n";

//	print "Message Body:\n$message";
    $Subject = $Street.", ".$PropertyCity.", ".$PropertyState." ".$PropertyZipcode." (New Loan App for you)";
	mail($recipient, $Subject, $message, $headers);
//	print "Debugging: message sent\nTo:$recipient\nSubject:$Subject\n";

}


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -	//
//																													//
//	InsertUsersTable() Do the Users Table database insert here.	Each Applicant 	//
//	will be given a user ID and password to check loan status via the 						//
//	MyLoanStatus.php page.																				//
//																													//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -	//

function InsertUsersTable($ApplicantName, $email, $recipient, $cc, $SSN, $Street,
	$PropertyCity, $PropertyState, $PropertyZipcode)
{
	global $ApplicantFirstName;
	global $ApplicantLastName;

	$Host="localhost";
	$User="lightnin_Tony";
	$Password="ipowerwe";
	$DBname="lightnin_LoanApps";
	$TableName="Users";

	/*	First connect to the MySQL DBMS on this server */

	$Link=mysql_connect ($Host, $User, $Password) or die ('I cannot connect to the DBMS because: '.mysql_error());
	$Query = "SELECT * from $TableName where (Password=$SSN)"; // see if this SSN already exists in database

	//	Returns a positive MySQL result resource to the query result, or FALSE on error.

	$Found = mysql_db_query ($DBname, $Query, $Link); // execute the actual DBMS query
	//echo mysql_errno() . ": " . mysql_error() . $Found . "\n";

	if (mysql_errno() > 0)	// pass error information
	{
		while($Row = mysql_fetch_array($Found))
		{
			print ("Found SSN=$Row[SSN]<br>\n");
		}

		mysql_close($Link);
		print ("Error in InsertUsersTable() at line at line ".__LINE__."<br>");
		print ("ApplicantName $ApplicantName<br>");
		print ("Duplicate SSN ($SSN) was found<br>");
		print ("Sending e-mail about error<br>");

		//MailUsersTableError(mysql_errno(), mysql_error(), $ApplicantName, $email, $recipient, $cc, $SSN);	// pass error information
		return(0);
	}
	else
	{ 	//Now do the inserts

		$ReportDate= date ("y/m/d");

		$User = substr($ApplicantFirstName, 0, 1).$ApplicantLastName; //User is 1st initial + last name
		$Query = "INSERT into $TableName values ('$ApplicantName', '$User', '$SSN', 'User')";

		//	print("Query is: $Query<br>\n");

		mysql_db_query($DBname, $Query, $Link); // execute the actual DBMS insert request

		/* mysql_query() returns TRUE on success and FALSE on failure */

		//	Note: When using UPDATE, MySQL will not update columns where the new
		//	value is the same as the old value. This creates the possiblity that
		//	class=function>mysql_affected_rows() may not actually equal the number of
		//	rows matched, only the number of rows that were literally affected by the query.

		//	printf ("Insert to WorkingStatusInfoTable affected %d rows<br>\n", mysql_affected_rows());

		if (mysql_affected_rows() < 1)
		{
			//MailUsersTableError(mysql_errno(), mysql_error(), $ApplicantName, $email, $recipient, $cc, $SSN);	// pass error information
			return(0);
		}

		mysql_close($Link);
		// die("<br>At line ".__LINE__." Stopping for this test<br>\n");
		return(1);
	}
}


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -	//
//																															//
//	PrintMailHeaderAndBody() Create the mail header and body. Then send the message.	//
//																															//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -	//

function PrintMailHeaderAndBody($Array)
{
/*
	$n = count($Array);
	print ("In PrintMailHeaderAndBody(). $n parameters received.<br>\n");

/***************
	if (!is_array($Array))
		print ("In PrintMailHeaderAndBody(). An Array was not passed<br>\n");
	else
	{
		$n = count($Array);
		print ("In PrintMailHeaderAndBody(). $n parameters received.<br>\n");

		for ($n=0; $n < count($Array); $n++)
		{
			$Parameter= each($Array);
			//print ("Posted $Parameter[key] = $Parameter[value]<p>\n");
		}
	}
*****************/
 	/* Format the $Array[DOB] */

	if ($Array[DOB].length > 0)
	{
		$xxx= substr($Array[DOB],0,2).'/'.substr($Array[DOB],2,2).'/'.substr($Array[DOB],4,4);
		$Array[DOB]=$xxx;
	}

	if ($Array[DOB] == "")  // Don't print DOB numbers that equal null
	{
		$Array[DOB]='&nbsp;';
	}

 	/* Format the $Array[Co_DOB] */

	if ($Array[Co_DOB].length > 0)
	{
		$xxx= substr($Array[Co_DOB],0,2).'/'.substr($Array[Co_DOB],2,2).'/'.substr($Array[Co_DOB],4,4);
		$Array[Co_DOB]=$xxx;
	}

	if ($Array[Co_DOB] == "")  // Don't print Co_DOB numbers that equal null
	{
		$Array[Co_DOB]='&nbsp;';
	}

	/* Format the SSN */

	if ($Array[SSN].length > 0)
	{
		$xxx= substr($Array[SSN],0,3).'-'.substr($Array[SSN],3,2).'-'.substr($Array[SSN],5,4);
		$Array[SSN]=$xxx;
	}

	/* Format the Co_SSN */

	if ($Array[Co_SSN].length > 0)
	{
		$xxx= substr($Array[Co_SSN],0,3).'-'.substr($Array[Co_SSN],3,2).'-'.substr($Array[Co_SSN],5,4);
		$Array[Co_SSN]=$xxx;
	}

	$headers = CreateHeader($Array[ApplicantName], $Array[email], $Array[recipient], $Array[cc]);
	$From = "\"".addslashes($Array[ApplicantName])."\" <".$Array[email].">";
    $To = $Array[recipient];
	$cc = "$Array[cc]";
//	print "Headers:\n$headers";
	$message  = "<p><font face='Verdana' color='#000066' size='2'>";
	$message .= "<b>Date Sent:</b> ".date ("l dS of F Y h:i:s A")."</p>";
	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	$message .= "<b>IP Address: </b>".$Array[IPaddress]."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	$message .= "<b>Applicant Name: </b>".$Array[ApplicantName]."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
  	$message .= "<b>Date Of Birth: </b>".$Array[DOB]."</p>";
	$message .= "<p><font face='Verdana' color='#000066' size='4'>";
	$message .= "<b>Digital Signature: </b>".$Array[Signature]."</p>";  	
	$message .= "<b>How Referred: </b>".$Array[HowReferred]."</p>";  	
  	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
  	$message .= "<p>____________________________________________________________________</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	$message .= "<b>Street: </b>".$Array[Street]."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	$message .= "<b>City: </b>".$Array[PropertyCity]."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	$message .= "<b>State: </b>".$Array[PropertyState]."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	$message .= "<b>Zipcode: </b>".$Array[PropertyZipcode]."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	$message .= "<b>Home Phone: </b>".$Array[HomePhone]."</p>";
	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	$message .= "<b>Work Phone: </b>".$Array[WorkPhone]."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	$message .= "<b>Best Time To Call: </b>".$Array[BestCallTime]."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	$message .= "<b>Best Number To Call: </b>".$Array[BestCallNumber]."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	$message .= "<b>Email Address: </b>".$Array[email]."</p>";
  	$message .= "<p>____________________________________________________________________</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	$message .= "<b>SSN: </b>".$Array[SSN]."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	$message .= "<b>Employer Name: </b>".$Array[Employer]."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	$message .= "<b>Monthly Income: </b>".$Array[MonthlyIncome]."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	$message .= "<b>Last Year's Annual Income: </b>".$Array[B_2002Income]."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	$message .= "<b>Length of Employment: </b>".$Array[EmployerTime]."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	$message .= "<b>Position Title: </b>".$Array[Position]."</p>";

	if ($Array[Co_ApplicantName] != null)
	{
  		$message .= "<p>____________________________________________________________________</p>";
  		$message .= "<p><font face='Verdana' color='#000066' size='2'>";
  		$message .= "<b>Co-Applicant Name: </b>".$Array[Co_ApplicantName]."</p>";
  		$message .= "<p><font face='Verdana' color='#000066' size='2'>";
		$message .= "<b>Date Of Birth: </b>".$Array[Co_DOB]."</p>";
  		$message .= "<p><font face='Verdana' color='#000066' size='2'>";
		$message .= "<b>SSN: </b>".$Array[Co_SSN]."</p>";
  		$message .= "<p><font face='Verdana' color='#000066' size='2'>";
		$message .= "<b>Employer Name: </b>".$Array[Co_Employer]."</p>";
  		$message .= "<p><font face='Verdana' color='#000066' size='2'>";
		$message .= "<b>Monthly Income: </b>".$Array[Co_MonthlyIncome]."</p>";
  		$message .= "<p><font face='Verdana' color='#000066' size='2'>";
		$message .= "<b>Last Year's Annual Income: </b>".$Array[Co_2002Income]."</p>";
  		$message .= "<p><font face='Verdana' color='#000066' size='2'>";
		$message .= "<b>Length of Employment: </b>".$Array[Co_EmployerTime]."</p>";
  		$message .= "<p><font face='Verdana' color='#000066' size='2'>";
		$message .= "<b>Position Title: </b>".$Array[Co_Position]."</p>";
	}

  	$message .= "<p>____________________________________________________________________</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
  	$message .= "<b>Self-described Credit Rating: </b>". $Array[EstCreditRating]."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	$message .= "<b>Monthly Credit Card Payments: </b>". $Array[MonthlyCreditCardDebt]."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	$message .= "<b>Other Monthly Debt: </b>".$Array[MonthlyOtherDebt]."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	$message .= "<b>Requested Loan Amount: </b>".$Array[LoanAmount]."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	$message .= "<b>Requested Loan Type: </b>".$Array[LoanType]."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	$message .= "<b>Kind of Loan: </b>".$Array[FinanceRequest]."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	$message .= "<b>Property Type: </b>".$Array[PropertyType]."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	$message .= "<b>Purchase Price: </b>".$Array[PurchasePrice]."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	$message .= "<b>Estimated Value: </b>".$Array[EstimatedValue]."</p>";
  	$message .= "<p>____________________________________________________________________</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
  	$message .= "<b>Current 1st Lender Name: </b>".$Array[LenderNameOn1st]."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	$message .= "<b>Loan Balance On 1st: </b>".$Array[LoanBalanceOn1st]."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	$message .= "<b>Interest Rate: </b>".$Array[InterestRateOn1st]."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	$message .= "<b>Monthly Payment: </b>".$Array[MonthlyPaymentOn1st]."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	$message .= "<b>Impounds: </b>".$Array[Impounds]."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	$message .= "<b>Current 2nd Lender Name: </b>".$Array[LenderNameOn2nd]."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	$message .= "<b>Loan Balance: </b>".$Array[LoanBalanceOn2nd]."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	$message .= "<b>Interest Rate: </b>".$Array[InterestRateOn2nd]."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	$message .= "<b>Monthly Payment: </b>".$Array[MonthlyPaymentOn2nd]."</p>";
	$message .= "<p>____________________________________________________________________</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	$message .= "<b>How Referred: </b>".$Array[HowReferred]."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	$message .= "<b>Situation:</b><br />";
	
	$SituationLine = explode("\r\n", $Array[Situation]);
	
	for ($k=0; $k < count($SituationLine); $k++)
		$message.= $SituationLine[$k]."<br />";
	
  	$message .= "</p><p><font face='Verdana' color='#000066' size='2'>";
	//$message .= "<b>recipient: </b>".$Array[recipient]."</p>";
  	//$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	//$message .= "<b>cc: </b>".$Array[cc]."</p>";
  	//$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	//$message .= "<b>IPaddress: </b>".$Array[IPaddress]."</p>";
  	$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	$message .= "<b>Redirect string: </b>".$Array[redirect]."</p>";
  	//$message .= "<p><font face='Verdana' color='#000066' size='2'>";
	//$message .= "<b>title: </b>".$Array[title]."</p>";

//	print "Message Body:\n$message";
    $Subject = $Array[Street].", ".$Array[PropertyCity].", ".$Array[PropertyState]." ".$Array[PropertyZipcode]." (New Loan App for you)";
	//mail($Array[recipient], $Subject, $message, $headers);

	SendMessage($Subject, $message, "anthony@lightning-mortgage.com", $To, $cc);


	//print ("Debugging line ".__LINE__.": message sent\nTo:$Array[recipient]\nSubject:$Subject\n");
}



//  . . . . . . . . . . . . . . . . . . . . . . .  . . . . . . . .	//
//																	//
//	Beginning of this page: 								//
//	The data can now be added to the database	//
//																	//
//  . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .	//

 	if ((empty($_GET)) && (empty($_POST))) // no parameters passed, must have backed up?
 	{
 		print("<h1 style='color: #006666;'>testing succeeded....</h1></div>");
 		include("../include/bottom.php");
 		include("../include/top.php");
 		print ("<script language=javascript>alert('No data found');window.location = '../MortgageApplication/LoanAppShort.php';</script>\n");
 	}
	
	if(empty($_GET))
	{
	  $ApplicantName		= ereg_replace("[\]", "", $_POST['ApplicantName']);
	  $DOB					= ereg_replace("[\]", "", $_POST['DOB']);
	  $Street				= ereg_replace("[\]", "", $_POST['Street']);
	  $PropertyCity			= ereg_replace("[\]", "", $_POST['PropertyCity']);
	  $PropertyState		= ereg_replace("[\]", "", $_POST['PropertyState']);
	  $PropertyZipcode		= ereg_replace("[\]", "", $_POST['PropertyZipcode']);
	  $WorkPhone			= ereg_replace("[\]", "", $_POST['WorkPhone']);
	  $HomePhone			= ereg_replace("[\]", "", $_POST['HomePhone']);
	  $BestCallTime			= ereg_replace("[\]", "", $_POST['BestCallTime']);
	  $BestCallNumber		= ereg_replace("[\]", "", $_POST['BestPhoneToCall']);
	  $email				= ereg_replace("[\]", "", $_POST['email']);
	  $SSN					= ereg_replace("[\]", "", $_POST['SSN']);
	  $Employer				= ereg_replace("[\]", "", $_POST['Employer']);
	  $MonthlyIncome		= ereg_replace("[\]", "", $_POST['MonthlyIncome']);
	  $B_2002Income			= ereg_replace("[\]", "", $_POST['B_2002Income']);
	  $EmployerTime			= ereg_replace("[\]", "", $_POST['EmployerTime']);
	  $Position				= ereg_replace("[\]", "", $_POST['Position']);
	  $Co_ApplicantName		= ereg_replace("[\]", "", $_POST['Co_ApplicantName']);
	  $Co_DOB				= ereg_replace("[\]", "", $_POST['Co_DOB']);
	  $Co_SSN				= ereg_replace("[\]", "", $_POST['Co_SSN']);
	  $Co_Employer			= ereg_replace("[\]", "", $_POST['Co_Employer']);
	  $Co_MonthlyIncome		= ereg_replace("[\]", "", $_POST['Co_MonthlyIncome']);
	  $Co_2002Income		= ereg_replace("[\]", "", $_POST['Co_2002Income']);
	  $Co_EmployerTime		= ereg_replace("[\]", "", $_POST['Co_EmployerTime']);
	  $Co_Position			= ereg_replace("[\]", "", $_POST['Co_Position']);
	  $EstCreditRating		= ereg_replace("[\]", "", $_POST['EstCreditRating']);
	  $MonthlyCreditCardDebt= ereg_replace("[\]", "", $_POST['MonthlyCreditCardDebt']);
	  $MonthlyOtherDebt		= ereg_replace("[\]", "", $_POST['MonthlyOtherDebt']);
	  $FinanceRequest		= ereg_replace("[\]", "", $_POST['FinanceRequest']);
	  $LoanAmount			= ereg_replace("[\]", "", $_POST['LoanAmount']);
	  $PropertyType			= ereg_replace("[\]", "", $_POST['PropertyType']);
	  $PurchasePrice		= ereg_replace("[\]", "", $_POST['PurchasePrice']);
	  $EstimatedValue		= ereg_replace("[\]", "", $_POST['EstimatedValue']);
	  $LenderNameOn1st		= ereg_replace("[\]", "", $_POST['LenderNameOn1st']);
	  $InterestRateOn1st	= ereg_replace("[\]", "", $_POST['InterestRateOn1st']);
	  $LoanBalanceOn1st		= ereg_replace("[\]", "", $_POST['LoanBalanceOn1st']);
	  $MonthlyPaymentOn1st	= ereg_replace("[\]", "", $_POST['MonthlyPaymentOn1st']);
	  $Impounds				= ereg_replace("[\]", "", $_POST['Impounds']);
	  $LenderNameOn2nd		= ereg_replace("[\]", "", $_POST['LenderNameOn2nd']);
	  $InterestRateOn2nd	= ereg_replace("[\]", "", $_POST['InterestRateOn2nd']);
	  $LoanBalanceOn2nd		= ereg_replace("[\]", "", $_POST['LoanBalanceOn2nd']);
	  $MonthlyPaymentOn2nd	= ereg_replace("[\]", "", $_POST['MonthlyPaymentOn2nd']);
	  $HowReferred			= ereg_replace("[\]", "", $_POST['HowReferred']);

	  $Situation			= ereg_replace("[\]", "", urldecode($_POST['Situation']));
	  $recipient			= ereg_replace("[\]", "", $_POST['recipient']);
	  $cc					= ereg_replace("[\]", "", $_POST['cc']);
	  $IPaddress			= ereg_replace("[\]", "", $_POST['IPaddress']);
	  $redirect				= ereg_replace("[\]", "", $_POST['redirect']);
	  $title				= ereg_replace("[\]", "", $_POST['title']);
	  $Signature			= ereg_replace("[\]", "", $_POST['Signature']);

	  // neat way to printout the arrays keys and their values

	  $n = count($_POST);
	  //print ("POST: $n parameters received.<br>\n");

	  for ($n=0; $n < count($_POST); $n++)
	  {
		$Parameter= each($_POST);
		//print ("Posted $Parameter[key] = $Parameter[value]<p>\n");
	  }

	//	Now we are putting the variables in a table to pass to a function later on.

	$ApplicantName = strtolower($ApplicantName);
	$ApplicantName = ucwords($ApplicantName);
	$ApplicantFirstName="Initializing At";
	$ApplicantLastName="Program Start";
	$Co_ApplicantName = strtolower($Co_ApplicantName);
	$Co_ApplicantName = ucwords($Co_ApplicantName);

	  $Test[ApplicantName] = $ApplicantName;
	  $Test[DOB] = $DOB;
	  $Test[Street] = $Street;
	  $Test[PropertyCity] = $PropertyCity;
	  $Test[PropertyState] = $PropertyState;
	  $Test[PropertyZipcode] = $PropertyZipcode;
	  $Test[WorkPhone] = $WorkPhone;
	  $Test[HomePhone] = $HomePhone;
	  $Test[BestCallTime] = $BestCallTime;
	  $Test[BestCallNumber] = $BestPhoneToCall;
	  $Test[email] = $email;
	  $Test[SSN] = $SSN;
	  $Test[Employer] = $Employer;
	  $Test[MonthlyIncome] = $MonthlyIncome;
	  $Test[B_2002Income] = $B_2002Income;
	  $Test[EmployerTime] = $EmployerTime;
	  $Test[Position] = $Position;
	  $Test[Co_ApplicantName] = $Co_ApplicantName;
	  $Test[Co_DOB] = $Co_DOB;
	  $Test[Co_SSN] = $Co_SSN;
	  $Test[Co_Employer] = $Co_Employer;
	  $Test[Co_MonthlyIncome] = $Co_MonthlyIncome;
	  $Test[Co_2002Income] = $Co_2002Income;
	  $Test[Co_EmployerTime] = $Co_EmployerTime;
	  $Test[Co_Position] = $Co_Position;
	  $Test[EstCreditRating] = $EstCreditRating;
	  $Test[MonthlyCreditCardDebt] = $MonthlyCreditCardDebt;
	  $Test[MonthlyOtherDebt] = $MonthlyOtherDebt;
	  $Test[FinanceRequest] = $FinanceRequest;
	  $Test[LoanAmount] = $LoanAmount;
	  $Test[LoanType] = $LoanType;
	  $Test[PropertyType] = $PropertyType;
	  $Test[PurchasePrice] = $PurchasePrice;
	  $Test[EstimatedValue] = $EstimatedValue;
	  $Test[LenderNameOn1st] = $LenderNameOn1st;
	  $Test[InterestRateOn1st] = $InterestRateOn1st;
	  $Test[LoanBalanceOn1st] = $LoanBalanceOn1st;
	  $Test[MonthlyPaymentOn1st] = $MonthlyPaymentOn1st;
	  $Test[Impounds] = $Impounds;
	  $Test[LenderNameOn2nd] = $LenderNameOn2nd;
	  $Test[InterestRateOn2nd] = $InterestRateOn2nd;
	  $Test[LoanBalanceOn2nd] = $LoanBalanceOn2nd;
	  $Test[MonthlyPaymentOn2nd] = $MonthlyPaymentOn2nd;
	  $Test[HowReferred] = $HowReferred;
	  $Test[Situation] = $Situation;
	  $Test[recipient] = $recipient;
	  $Test[cc] = $cc;
	  $Test[IPaddress] = $IPaddress;
	  $Test[redirect] = $redirect;
	  $Test[title] = $title;
	  $Test[Signature] = $Signature;
	}


	if(empty($_POST))
	{
	  $ApplicantName		= ereg_replace("[\]", "", $_GET['ApplicantName']);
	  $DOB					= ereg_replace("[\]", "", $_GET['DOB']);
	  $Street				= ereg_replace("[\]", "", $_GET['Street']);
	  $PropertyCity			= ereg_replace("[\]", "", $_GET['PropertyCity']);
	  $PropertyState		= ereg_replace("[\]", "", $_GET['PropertyState']);
	  $PropertyZipcode		= ereg_replace("[\]", "", $_GET['PropertyZipcode']);
	  $WorkPhone			= ereg_replace("[\]", "", $_GET['WorkPhone']);
	  $HomePhone			= ereg_replace("[\]", "", $_GET['HomePhone']);
	  $BestCallTime			= ereg_replace("[\]", "", $_GET['BestCallTime']);
	  $BestCallNumber		= ereg_replace("[\]", "", $_GET['BestPhoneToCall']);
	  $email				= ereg_replace("[\]", "", $_GET['email']);
	  $SSN					= ereg_replace("[\]", "", $_GET['SSN']);
	  $Employer				= ereg_replace("[\]", "", $_GET['Employer']);
	  $MonthlyIncome		= ereg_replace("[\]", "", $_GET['MonthlyIncome']);
	  $B_2002Income			= ereg_replace("[\]", "", $_GET['B_2002Income']);
	  $EmployerTime			= ereg_replace("[\]", "", $_GET['EmployerTime']);
	  $Position				= ereg_replace("[\]", "", $_GET['Position']);
	  $Co_ApplicantName		= ereg_replace("[\]", "", $_GET['Co_ApplicantName']);
	  $Co_DOB				= ereg_replace("[\]", "", $_GET['Co_DOB']);
	  $Co_SSN				= ereg_replace("[\]", "", $_GET['Co_SSN']);
	  $Co_Employer			= ereg_replace("[\]", "", $_GET['Co_Employer']);
	  $Co_MonthlyIncome		= ereg_replace("[\]", "", $_GET['Co_MonthlyIncome']);
	  $Co_2002Income		= ereg_replace("[\]", "", $_GET['Co_2002Income']);
	  $Co_EmployerTime		= ereg_replace("[\]", "", $_GET['Co_EmployerTime']);
	  $Co_Position			= ereg_replace("[\]", "", $_GET['Co_Position']);
	  $EstCreditRating		= ereg_replace("[\]", "", $_GET['EstCreditRating']);
	  $MonthlyCreditCardDebt= ereg_replace("[\]", "", $_GET['MonthlyCreditCardDebt']);
	  $MonthlyOtherDebt		= ereg_replace("[\]", "", $_GET['MonthlyOtherDebt']);
	  $FinanceRequest		= ereg_replace("[\]", "", $_GET['FinanceRequest']);
	  $LoanAmount			= ereg_replace("[\]", "", $_GET['LoanAmount']);
	  $LoanType				= ereg_replace("[\]", "", $_GET['LoanType']);
	  $PropertyType			= ereg_replace("[\]", "", $_GET['PropertyType']);
	  $PurchasePrice		= ereg_replace("[\]", "", $_GET['PurchasePrice']);
	  $EstimatedValue		= ereg_replace("[\]", "", $_GET['EstimatedValue']);
	  $LenderNameOn1st		= ereg_replace("[\]", "", $_GET['LenderNameOn1st']);
	  $InterestRateOn1st	= ereg_replace("[\]", "", $_GET['InterestRateOn1st']);
	  $LoanBalanceOn1st		= ereg_replace("[\]", "", $_GET['LoanBalanceOn1st']);
	  $MonthlyPaymentOn1st	= ereg_replace("[\]", "", $_GET['MonthlyPaymentOn1st']);
	  $Impounds				= ereg_replace("[\]", "", $_GET['Impounds']);
	  $LenderNameOn2nd		= ereg_replace("[\]", "", $_GET['LenderNameOn2nd']);
	  $InterestRateOn2nd	= ereg_replace("[\]", "", $_GET['InterestRateOn2nd']);
	  $LoanBalanceOn2nd		= ereg_replace("[\]", "", $_GET['LoanBalanceOn2nd']);
	  $MonthlyPaymentOn2nd	= ereg_replace("[\]", "", $_GET['MonthlyPaymentOn2nd']);
	  $HowReferred			= ereg_replace("[\]", "", $_GET['HowReferred']);
	  $Situation			= ereg_replace("[\]", "", urldecode($_GET['Situation']));
	  $recipient			= ereg_replace("[\]", "", $_GET['recipient']);
	  $cc					= ereg_replace("[\]", "", $_GET['cc']);
	  $IPaddress			= ereg_replace("[\]", "", $_GET['IPaddress']);
	  $redirect				= ereg_replace("[\]", "", $_GET['redirect']);
	  $title				= ereg_replace("[\]", "", $_GET['title']);
	  $Signature			= ereg_replace("[\]", "", $_GET['Signature']);

	  // A neat way to printout the arrays keys and their values

	  $n = count($_GET);
	  // print ("GET: $n parameters received.<br>\n");

	  for ($n=0; $n < count($_GET); $n++)
	  {
		$Parameter= each($_GET);
		//print ("$Parameter[key] = $Parameter[value]<p>\n");
	  }
	}

	$SavedIPaddress = $IPaddress;  // Needed for the mailed information in an above function

	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 	//
	//																	//
	// We grabbed the application in LoanAppShort.php from user input	//
	// We displayed a confirmation page in LoanAppShort.php				//
	// Now we are finally going to send the application by				//
	// creating the mail header and body. 								//
	// Then add the application into various tables in the database.	//
	//																	//
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -	//

	PrintMailHeaderAndBody($Test);

	// print("In main() at line ".__LINE__." Applicant name is |$ApplicantName|<br>\n");
	//		"Insert Applicant Info"
		
	include("../include/top.php");
?>
<div id="Heading" style="width:95%;">
<div class="Title"><h1 id="Small">Your application is now being<br />input into our system</h1></div>
<div class="Title">
<div id="Big"><h1>One moment...</h1></div>
<div id="BigShadow"><h1>One moment...</h1></div></div>
</div></div>
<?php
	include("../include/bottom.php");
//	$Success = InsertApplicantInfoTable($ApplicantName, $email, $recipient, $cc, $DOB, $SSN, $Co_ApplicantName,
//		$Co_DOB, $Co_SSN, $HowReferred, "New", $Street, $PropertyCity, $PropertyState, $PropertyZipcode);


//	if ($Success)
//	{
//		print ("Your contact information is being recorded.<br>\n"); //("Inserting Contact Info");
//		$Success = InsertContactInfoTable($ApplicantName, $email, $recipient, $cc, $SSN, $Street, $PropertyCity,
//			$PropertyState,	$PropertyZipcode, $WorkPhone, $HomePhone, $BestCallTime, $BestPhoneToCall, $email, 'N');
//	}
//	else
//	{
//		print ("Oh no! This website has encountered a problem with accepting your application. Have you applied ");
//		print ("before? We have encountered a duplicate entry....No, I'm sorry. It's okay. Please ");
//		print ("allow me to continue.<br>\n");
//		// "Failed to Insert Applicant Info"
//	}



//	if ($Success)
//	{
//		print ("Your employment information is being recorded.<br>\n"); //("Inserting Employment Info");
//		$Success = InsertEmploymentInfoTable($ApplicantName, $email, $recipient, $cc, $SSN, $Employer, $EmployerTime,
//			$Position, $MonthlyIncome, $B_2002Income, $Street, $PropertyCity, $PropertyState,	$PropertyZipcode);
//	}
//	else
//	{
//		print ("Oh no! This website has encountered a problem with accepting your application. Have you applied ");
//		print ("before? We've encountered a duplicate entry....No, I'm sorry. It's okay. Please ");
//		print ("allow me to continue.<br>\n");
//		// ("Failed to Insert Contact Info<br>\n");
//	}



//	if ($Success)
//	{
//		print ("Your co-applicant's employment information is being recorded.<br>\n"); //Inserting CoEmployment Info
//		$Success = InsertCoEmploymentInfoTable($Co_ApplicantName, $ApplicantName, $email, $recipient, $cc, $Co_SSN,
//			$Co_Employer, $Co_EmployerTime, $Co_Position, $Co_MonthlyIncome, $Co_2002Income, $Street, $PropertyCity,
//			$PropertyState,	$PropertyZipcode);
//	}
//	else
//	{
//		print ("Oh no! This website has encountered a problem with accepting your application. Have you applied ");
//		print ("before? We've encountered a duplicate entry....No, I'm sorry. It's okay. Please ");
//		print ("allow me to continue.<br>\n");
//		//("Failed to Insert Employment Info<br>\n");
//	}




//	if ($Success)
//	{
//		print ("Your loan requirements are being recorded.<br>\n"); //("Inserting Loan Info<br>\n");
//		$Success = InsertLoanInfoTable($ApplicantName, $email, $recipient, $cc, $EstCreditRating, $LoanAmount,
//			$FinanceRequest, $PurchasePrice, $EstimatedValue, $LenderNameOn1st,	$LoanBalanceOn1st,
//			$InterestRateOn1st, $MonthlyPaymentOn1st, $Impounds, $LenderNameOn2nd, $LoanBalanceOn2nd,
//			$InterestRateOn2nd, $CreditReport, $MonthlyPaymentOn2nd, $MonthlyCreditCardDebt, $SSN,
//			$FinanceRequest, $EstCreditRating, $MonthlyOtherDebt, $PropertyType, $Street, $PropertyCity,
//			$PropertyState, $PropertyZipcode);
//	}
//	else
//	{
//		print ("Oh no! This website has encountered a problem with accepting your co-applicant's employment ");
//		print ("information. Have you applied before? ");
//		print ("We've encountered a duplicate entry....No, I'm sorry. It's okay. Please ");
//		print ("allow me to continue.<br>\n");
//		//("Failed to Insert CoEmployment Info<br>\n");
//	}
//


//	if ($Success)
//	{
//		print ("Your specific comments about your needs are now being recorded.<br>\n"); //Inserting WorkingStatus Info
//		$Success = InsertWorkingStatusInfoTable($ApplicantName, $email, $recipient, $cc, $SSN, $Situation, $Street,
//			$PropertyCity, $PropertyState, $PropertyZipcode);
/*
		If ($Success == 0)
		{
			print ("Oh no! This website has encountered a problem with accepting your specific comments ");
			print ("about your financing needs. Have you applied before? ");
			print ("We've encountered a duplicate entry....No, I'm sorry. It's okay. Please ");
			print ("allow me to continue.<br>\n"); // ("Failed to Insert WorkingStatus Info<br>\n");
		}
	}
	else
	{
		print ("Oh no! This website has encountered a problem with accepting your loan requirements. ");
		print ("Have you applied before? ");
		print ("We've encountered a duplicate entry....No, I'm sorry. It's okay. Please ");
		print ("allow me to continue.<br>\n");	// ("Failed to Insert Loan Info<br>\n");
	}
*/
//	$Success = InsertUsersTable($ApplicantName, $email, $recipient, $cc, $SSN, $Street,
//			$PropertyCity, $PropertyState, $PropertyZipcode);


//	Now go to the credit card verification screen
//	print ("Transferring to: $redirect<br>\n");
//
//This location.replace command removes this current program from the browser's history before transferring to the new page.
//We wanted to do this so that a user hitting the back button will not resubmit the loan application by accident.

	print ("<script type='text/javascript'>\n");
	
	//print("alert('Your Application is being Processed.\\n \\nWarning!\\n \\nOur Credit Reporting Company\\'s server is scheduled to be down\\\nfor maintenance at various times July 6th-8th.\\n \\nPlease excuse this inconvenience.');");
	//print("</script>\n<h1>end</h1>\n");

	print ("window.location.replace('http://www.lightning-mortgage.com/MortgageApplication/LoanAppSuccess.php');</script>\n");

	//print ("window.location.replace('$redirect');</script>\n");
?>
</body>
</html>