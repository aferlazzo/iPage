<?php
require ("../include/authenticate.php");
?>

<!DOCTYPE html PUBLIC "-//W3//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/2000/REC-xhtml1-20000126/DTD/xhtml1-transitional.dtd">
<html xlns="http://www.w3.org.1999.xhtml">
<head>
<title>ApplicantList form handler</title>
<script language="JavaScript" src="https://host373.ipowerweb.com/~lightnin/js/Common.js">
</script>
</head>
<body>
<?php

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//
//																									//
//	ApplicantList: This page retrieves and displays the data in the database table 'ApplicantInfo' 	//
//	A list filter is passed from other pages as a variable "$Filter" and is used to list records 	//
//	with the matching LoanStatus.																	//
//																									//
//	The variable passed to this page from ApplicantUpdate.php and ApplicantMaintenance.php is 		//
//	$SavedFilter 																					//
//	Calls ApplicantMaintenance.php. Passes variables Filter, LoanStatus, RequestType				//
//																									//
//																									//
//	Sample 																							//
//	http://www.lightning-mortgage.com/ApplicantList.php?SavedFilter=Active&ListAll=Browse+Applicants//
//																									//
//																									//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//


// Always remember when you do a print ("$variable...); the variable's value will be substituted.
// When you use a single quote, print ('$variable...); the value WILL NOT be substituted.

/* variables to access Database */

	$Host="localhost";
	$DBname="lightnin_LoanApps";
	$TableName="ApplicantInfo";


	print("<script language='Javascript'>User= GetMyValue('User');</script>\n");

	print("<script language='Javascript'>Password = GetMyValue('Password');</script>\n");

	//print("User variable set to $User<br>\n");
	//print("Password variable set to $Password<br>\n");

/*  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -*/
/*																							*/
/*	Cookies must be set prior to any displaying table										*/
/*																							*/
/*  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -*/

	//print("<script language='Javascript'>GetCookies();</script>\n");
	print("<script language='Javascript'>MyValue = GetMyValue('SavedFilter');</script>\n");

	if (!isset($MyValue))  //if 'SavedFilter' cookie is not set, make it so...
	{
		print("<script language='Javascript'>document.cookie='SavedFilter=All';</script>\n");
		print("<script language='Javascript'>MyValue = GetMyValue('SavedFilter');</script>\n");
		if ($MyValue == 'All')
		{
			print("Set SavedFilter cookie to 'All'\n");
		}
		else
		{
			print("Error: Could not Set SavedFilter cookie to 'All', it is set to |$MyValue|\n");
		}
	}
	else
	{
		$SavedFilter = $MyValue;
		print("SavedFilter cookie previously set to $SavedFilter\n");
	}

	print("<script language='Javascript'>MyValue = GetMyValue('SortColumn');</script>\n");

	if (!isset($MyValue))	//if 'SortColumn' not a cookie, make it so...
	{
		print("<script language='Javascript'>document.cookie='SortColumn=SSN';</script>\n");
		print("Set SortColumn cookie to 'SSN'<br>\n");
	}
	else
	{
		$SortColumn = $MyValue;
		print("SortColumn cookie previously set to $SortColumn<br>\n");
	}


/* -*-*-*-*-*-*-*-*-*-*-*-*-*- variables to access Database -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*- */


	/* first, connect to the MySQL DBMS on this server */

	$Link=mysql_connect ($Host, $User, $Password) or die ('I cannot connect to the DBMS because: '.mysql_error());

	/* select everything from the database table. Sort by the column name passed in the cookie SortColumn */

	$Query = "SELECT * from $TableName Where SSN = ".$SSN;

	$Result=mysql_db_query($DBname, $Query, $Link);

	/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
	/*																												*/
	/*	We must keep the end of form down here because HTML is sequential executed. The $FilterSave value doesn't	*/
	/*	get assigned until rows in the table are listed.															*/
	/*																												*/
	/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/

	print ("<input type='hidden' name=Filter      value=$FilterSave>\n");
	print ("<input type='hidden' name=LoanStatus  value=$FilterSave>\n");
	print ("<input type='hidden' name=RequestType value='Insert'>\n");
	print ("</form>");
	mysql_close($Link);

?>
</body>
</html>