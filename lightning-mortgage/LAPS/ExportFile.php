<!doctype html public "-//w3//dtd html 4.01 transitional//en"
					  "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>ExportFile form handler</title>
</head>
<body>
<?php


// -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-	//
//																								//
//	Format Names		 																		//
//																								//
// -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-	//

function FormatNames ($Name1, $Name2)
{
	global $ApplicantName, $ApplicantFirstName, $ApplicantMiddleName, $ApplicantLastName, $ApplicantSuffix;
	global $Co_ApplicantName, $Co_ApplicantFirstName, $Co_ApplicantMiddleName, $Co_ApplicantLastName, $Co_ApplicantSuffix;

	$ApplicantName = $Name1;
	$Co_ApplicantName = $Name2;
	$ApplicantMiddleName = "";
	$Co_ApplicantMiddleName = "";
	$ApplicantSuffix = "";
	$Co_ApplicantSuffix = "";

	// -*-*-*-*- Separate the first/middle name from the last name for applicant -*-*-*-*-*-*-


	$ApplicantName = ereg_replace ("\++", " ", $ApplicantName); // replace plus signs with spaces
	print ("Line ".__LINE__." ApplicantName =:$ApplicantName:<br>\n");

	$ApplicantFirstName = strtok($ApplicantName, " "); //everything up to the space
	$ApplicantLastName = substr ($ApplicantName, strlen($ApplicantFirstName) + 1, 30);

	$ApplicantMiddleName = strtok(trim($ApplicantLastName), " "); //everything up to the space
	print ("Line ".__LINE__." ApplicantLastName =:$ApplicantLastName: ApplicantFirstName =:$ApplicantFirstName: ApplicantMiddleName = :$ApplicantMiddleName:<br>\n");

	if ($ApplicantMiddleName != $ApplicantLastName)  // there must be a middle name
	{
		$xxx = substr ($ApplicantLastName, strlen($ApplicantMiddleName) + 1, 30);
		$ApplicantLastName = $xxx;
	}

	$ApplicantSuffix = strtok(trim($ApplicantLastName), " "); //everything up to the space
	print ("Line ".__LINE__." ApplicantLastName =:$ApplicantLastName: ApplicantFirstName =:$ApplicantFirstName: ApplicantMiddleName = :$ApplicantMiddleName:<br>\n");

	if ($ApplicantSuffix != $ApplicantLastName)  // there must be a suffix
	{
		$xxx = substr ($ApplicantLastName, strlen($ApplicantSuffix) + 1, 30);
		$$ApplicantSuffix = $xxx;
		$ApplicantLastName = strtok($ApplicantLastName, " ");
	}

	print ("Line ".__LINE__." ApplicantLastName =:$ApplicantLastName: ApplicantFirstName =:$ApplicantFirstName: ApplicantMiddleName = :$ApplicantMiddleName:: ApplicantSuffix = :$ApplicantSuffix:<br>\n");

	// -*-*-*-*- Separate the first/middle name from the last name for co-applicant -*-*-*-*-*-*-

	$Co_ApplicantName = ereg_replace ("\++", " ", $Co_ApplicantName);

	$Co_ApplicantFirstName = strtok($Co_ApplicantName, " "); //everything up to the space
	$Co_ApplicantLastName = substr ($Co_ApplicantName, strlen($Co_ApplicantFirstName) + 1, 30);

	$Co_ApplicantMiddleName = strtok(trim($Co_ApplicantLastName), " "); //everything up to the space
	print ("Line ".__LINE__." ApplicantLastName =:$ApplicantLastName: ApplicantFirstName =:$ApplicantFirstName: ApplicantMiddleName = :$ApplicantMiddleName:<br>\n");

	if ($Co_ApplicantMiddleName != $Co_ApplicantLastName)  // must be a middle name
	{
		$Co_ApplicantLastName = substr ($Co_ApplicantLastName, strlen($Co_ApplicantMiddleName) + 1, 30);
		$Co_ApplicantFirstName = $Co_ApplicantFirstName." ".$Co_ApplicantMiddleName;  // put first & middle together
	}

	$Co_ApplicantSuffix = strtok(trim($Co_ApplicantLastName), " "); //everything up to the space
	print ("Line ".__LINE__." ApplicantLastName =:$Co_ApplicantLastName: ApplicantFirstName =:$Co_ApplicantFirstName: Co_ApplicantMiddleName = :$Co_ApplicantMiddleName:<br>\n");

	if ($Co_ApplicantSuffix != $Co_ApplicantLastName)  // there must be a suffix
	{
		$xxx = substr ($Co_ApplicantLastName, strlen($Co_ApplicantSuffix) + 1, 30);
		$$Co_ApplicantSuffix = $xxx;
		$Co_ApplicantLastName = strtok($Co_ApplicantLastName, " ");
	}

	print ("Line ".__LINE__." ApplicantLastName =:$Co_ApplicantLastName: ApplicantFirstName =:$Co_ApplicantFirstName: Co_ApplicantMiddleName = :$Co_ApplicantMiddleName:: Co_ApplicantSuffix = :$Co_ApplicantSuffix:<br>\n");
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//
//																												//
//	WriteDelimitedFile: Name the exported data file, then write the record to it using the tab character as the	//
//	field delimiter.																							//
//																												//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//

	// -*-*-*-*- Separate the first/middle name from the last name for applicant -*-*-*-*-*-*-

	$ApplicantFirstName="";
	$ApplicantMiddleName="";
	$ApplicantLastName="";
	$ApplicantSuffix="";
	$Co_ApplicantFirstName="";
	$Co_ApplicantMiddleName="";
	$Co_ApplicantLastName="";
	$Co_ApplicantSuffix="";

	FormatNames ($ApplicantName, $Co_ApplicantName);
	
	// -*-*-*-*- Create Applicant Age fields -*-*-*-*-*-*-


	// fist check for needing to add leading zero

	if (strlen($_GET[DOB]) == 7)
	{
		$DOB = "0".$_GET["DOB"];

	}
	else
	{
		$DOB = $_GET["DOB"];
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


	// -*-*-*-*- Create Co_Applicant Age fields -*-*-*-*-*-*-


	// fist check for needing to add leading zero

	if (strlen($_GET[Co_DOB]) == 7)
	{
		$Co_DOB = "0".$_GET["Co_DOB"];

	}
	else
	{
		$Co_DOB = $_GET["Co_DOB"];
	}

	/* Format the $Co_DOB */

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
		$Co_DOB = "0".$_GET["Co_DOB"];
	}
	else
	{
		$Co_DOB = $_GET["Co_DOB"];
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
		die ("\$DOB $DOB \$Co_DOB $Co_DOB \$Age $Age \$Co_Age $Co_Age");
	}

	// -*-*-*-*-*-*-*-*-*-*-*-*-*-* now write the file -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-

	//print ("File name passed is $_GET[FileName]<br>\n");
	
	die ("Line ".__LINE__." SSN $SSN Co_SSN $Co_SSN<br>\n");

	$TheFile = '../cgi-bin/formdata/'.$_GET[FileName];
	$Open = fopen($TheFile, "w+");

	if ($Open)
	{
		fwrite($Open, "SSN	ApplicantFirstName	ApplicantMiddleName	ApplicantLastName	ApplicantSuffix	DOB	Age	Co_SSN	Co_ApplicantFirstName	");
		fwrite($Open, "Co_ApplicantMiddleName	Co_ApplicantLastName	Co_ApplicantSuffix	");
		fwrite($Open, "Co_DOB	Co_Age	Street	City	State	Zip	WorkPhone	HomePhone	email	Employer	");
		fwrite($Open, "Position	MonthlyIncome	MonthlyPaymentOn1st	MonthlyPaymentOn2nd	");
		fwrite($Open, "Co_Employer	Co_Position	Co_MonthlyIncome	RequestedLoanAmount	LoanPurpose	PurchasePrice\n");

		fwrite($Open, "$SSN	$ApplicantFirstName	$ApplicantMiddleName	$ApplicantLastName	$ApplicantSuffix	$_GET[DOB]	$Age	$Co_SSN	");
		fwrite($Open, "$Co_ApplicantFirstName	$Co_ApplicantMiddleName	$Co_ApplicantLastName	$Co_ApplicantSuffix	");
		fwrite($Open, "$_GET[Co_DOB]	$Co_Age	$_GET[Street]	$_GET[City]	$_GET[State]	$_GET[Zip]	$_GET[WorkPhone]	");
		fwrite($Open, "$_GET[HomePhone]	$_GET[email]	$_GET[Employer]	$_GET[Position]	$_GET[MonthlyIncome]	");
		fwrite($Open, "$_GET[MonthlyPaymentOn1st]	$_GET[MonthlyPaymentOn2nd]	$_GET[Co_Employer]	");
		fwrite($Open, "$_GET[Co_Position]	$_GET[Co_MonthlyIncome]	$_GET[RequestedLoanAmount]	$_GET[LoanPurpose]	");
		fwrite($Open, "$_GET[PurchasePrice]\n");

		fclose($Open);

		print ("File exported to $TheFile on server<br>\n");
		print ("\nWhen download is complete, press back arrow twice to continue exporting files, else close browser window<br>\n");
		print("<script>window.location='CopyToLocalFile.php?FileName=$TheFile';</script>\n"); // copy file
	}
	else
	{
		print ("Export failed!<br>\n");
	}
?>

</body>
</html>