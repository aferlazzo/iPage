<!doctype html public "-//w3//dtd html 4.01 transitional//en"
					  "http://www.w3.org/TR/html4/loose.dtd">
<?php
error_reporting (E_ALL); // for better error reporting....


// -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-	//
//																								//
//	Format Names		 																		//
//																								//
// -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-	//

function FormatNames ($Name1, $Name2)
{
	global $ApplicantName;
	global $Co_ApplicantName;

	$ApplicantName = $Name1;
	$Co_ApplicantName = $Name2;

	// -*-*-*-*- Separate the first/middle name from the last name for applicant -*-*-*-*-*-*-


	$ApplicantName = ereg_replace ("\++", " ", $ApplicantName); // replace plus signs with spaces
	//print ("Line ".__LINE__." ApplicantName =:$ApplicantName:<br>\n");

	$ApplicantFirstName = strtok($ApplicantName, " "); //everything up to the space
	$ApplicantLastName = substr ($ApplicantName, strlen($ApplicantFirstName) + 1, 30);

	$Middle = strtok(trim($ApplicantLastName), " "); //everything up to the space
	//print ("Line ".__LINE__." ApplicantLastName =:$ApplicantLastName: ApplicantFirstName =:$ApplicantFirstName: Middle = :$Middle:<br>\n");

	if ($Middle != $ApplicantLastName)  // must be a middle name
	{
		$xxx = substr ($ApplicantLastName, strlen($Middle) + 1, 30);
		$ApplicantLastName = $xxx;

		$xxx = $ApplicantFirstName." ".$Middle;  // put first & middle together
		$ApplicantFirstName = $xxx;
	}

	//print ("Line ".__LINE__." ApplicantLastName =:$ApplicantLastName: ApplicantFirstName =:$ApplicantFirstName: Middle = :$Middle:<br>\n");

	// -*-*-*-*- Separate the first/middle name from the last name for co-applicant -*-*-*-*-*-*-

	$Co_ApplicantName = ereg_replace ("\++", " ", $Co_ApplicantName);

	$Co_ApplicantFirstName = strtok($Co_ApplicantName, " "); //everything up to the space
	$Co_ApplicantLastName = substr ($Co_ApplicantName, strlen($Co_ApplicantFirstName) + 1, 30);

	$Middle = strtok(trim($Co_ApplicantLastName), " "); //everything up to the space

	if ($Middle != $Co_ApplicantLastName)  // must be a middle name
	{
		$Co_ApplicantLastName = substr ($Co_ApplicantLastName, strlen($Middle) + 1, 30);
		$Co_ApplicantFirstName = $Co_ApplicantFirstName." ".$Middle;  // put first & middle together
	}

	//print ("Co_ApplicantLastName =:$Co_ApplicantLastName: Co_ApplicantFirstName =:$Co_ApplicantFirstName: Middle = :$Middle:<br>\n");
}


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//
//																												//
//	SendEmail: Reads a named file in, then sends it to the person referenced along with the URL					//
//	Author of the LAPS programs: Tony Ferlazzo. Date written 7/27/03											//
//	LAPS: Loan Application Pipeline System																		//
//																												//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//

	// To view all the global variables:
	//print '<pre>';
	//print_r($GLOBALS);
	//PRINT '</pre>';


	// Be careful with 'Post' as the $_POST variables remain active for the browser session

	if ($_POST)  //if this page was called from a form
	{
		//print("Found posted name. Executing line ".__LINE__."<br>\n");
       	$ApplicantName = trim($_POST['ApplicantName']);
       	$Co_ApplicantName = trim($_POST['Co_ApplicantName']);

       	FormatNames ($ApplicantName, $Co_ApplicantName);
       	$FileName = './cgi-bin/messages/'.trim($_POST['FileName']);

		// Make sure message file exists. If it does, send it.

       	if (file_exists($FileName))
       	{
	       	$Message 	= file_get_contents ($FileName);
			$userEmail  = 'invalidName@lightning-mortgage.com';
			$mail_subject = 'Automated Send';

			/* To send HTML mail, you can set the Content-type header. */
			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

			/* additional headers */
			$headers .= "From: The Man <tony@lightning-mortgage.com>\r\n";

			//$headers .= "Cc: fran@lightning-mortgage.com\r\n";

	        if($userEmail)
	        {
	            if( mail($userEmail, $mail_subject, $Message, $headers))
	            {
	                $html  = 'Your email was sent';
	            }
	            else
	            {
	                $html = 'There was an error';
	            }
	        }
		}
		else
		{
			$html = "File '".$FileName."' not found";
		}
    }
    else
    {
		//print("Name not found, so displaying the form. Executing line ".__LINE__."<br>\n");
        $FileName   = '<input type="text" name="FileName">';
        $Recipient1 = '<input type="text" name="ApplicantName">';
        $Recipient2 = '<input type="text" name="Co_ApplicantName">';

        $Send 		= '<input type="submit" name="submit" value="Send">';

        $html = "
            <p>
                Send E-Mail:
            </p>
            <form action=\"$PHP_SELF\" method=\"post\">
                <table border=\"0\" cellspacing=\"5\">
                    <tr>
                    	<td>  Send To: $Recipient1</td>
                    </tr>
                    <tr>
                        <td>   And To: $Recipient2</td>
                    </tr>
                    <tr>
                        <td>File Name (in ./cgi-bin/messages/): $FileName</td>
                    </tr>
                    <tr>
                        <td>$Send</td>
                    </tr>
                </table>
            </form>
            ";
		//print("Executing line ".__LINE__."<br>\n");
    }
?>
<html>
<head>
</head>
<body>
	<?php
		//print("Executing line ".__LINE__."<br>\n");
		print("$html");
		//print("Executing line ".__LINE__."<br>\n");
	?>
</body>
</html>









<!--


	// -*-*-*-*- Create Applicant Age fields -*-*-*-*-*-*-


	// fist check for needing to add leading zero

	if (strlen($_GET[DOB]) == 7)
	{
		$DOB = "0".$_GET[DOB];

	}
	else
	{
		$DOB = $_GET[DOB];
	}

	/* Format the $DOB */

	if (strlen($DOB) > 0)
	{
		$xxx = substr($DOB,0,2).'/'.substr($DOB,2,2).'/'.substr($DOB,4,4);
		$DOB_MM = substr($DOB,0,2);
		$DOB_DD = substr($DOB,2,2);
		$DOB_YYYY = substr($DOB,4,4);
		$DOB = $xxx;

		$MM = date('m');
		$YYYY = date ('Y');

		$Age = $YYYY - $DOB_YYYY;

		if ($MM < $DOB_MM)
			$Age = $Age - 1;
	}






	// -*-*-*-*- Format the SSN -*-*-*-*-*-*-

	//print ("length is ".strlen($_GET[SSN]).", value is $_GET[SSN]<br>\n");
	$SSN = $_GET[SSN];
	$x = strlen($_GET[SSN]);

	while ($x < 9)  // pad with leading zeros
	{
		$SSNxx = "0".$SSN;
		$SSN = $SSNxx;
		$x = strlen($SSN);
	}

	if ($SSN > 0)
	{
		$SSNxx= substr($SSN,0,3).'-'.substr($SSN,3,2).'-'.substr($SSN,5,4);
		$SSN=$SSNxx;
	}

	// -*-*-*-*- Format the Co_SSN -*-*-*-*-*-*-

	//print ("length is ".strlen($_GET[Co_SSN]).", value is $_GET[Co_SSN]<br>\n");
	$Co_SSN = $_GET[Co_SSN];
	$x = strlen($Co_SSN);

	while ($x < 9)  // pad with leading zeros
	{
		$Co_SSNxx = "0".$Co_SSN;
		$Co_SSN = $Co_SSNxx;
		$x = strlen($Co_SSN);
	}

	if ($Co_SSN > 0)
	{
		$Co_SSNxx= substr($Co_SSN,0,3).'-'.substr($Co_SSN,3,2).'-'.substr($Co_SSN,5,4);
		$Co_SSN=$Co_SSNxx;
	}
	// -*-*-*-*- Create Co_Applicant Age fields -*-*-*-*-*-*-


	// fist check for needing to add leading zero

	if (strlen($_GET[Co_DOB]) == 7)
	{
		$Co_DOB = "0".$_GET[Co_DOB];

	}
	else
	{
		$Co_DOB = $_GET[Co_DOB];
	}

	/* Format the $DOB */

	if (strlen($Co_DOB) > 0)
	{
		$xxx = substr($Co_DOB,0,2).'/'.substr($Co_DOB,2,2).'/'.substr($Co_DOB,4,4);
		$Co_DOB_MM = substr($Co_DOB,0,2);
		$Co_DOB_DD = substr($Co_DOB,2,2);
		$Co_DOB_YYYY = substr($Co_DOB,4,4);
		$Co_DOB = $xxx;

		$MM = date('m');
		$YYYY = date ('Y');

		$Co_Age = $YYYY - $Co_DOB_YYYY;

		if ($MM < $Co_DOB_MM)
			$Co_Age = $Co_Age - 1;
	}
-->