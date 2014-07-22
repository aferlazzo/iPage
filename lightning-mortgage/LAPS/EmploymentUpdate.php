<?php
require ("../include/authenticate.php");
?>

<!DOCTYPE html PUBLIC "-//W3//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/2000/REC-xhtml1-20000126/DTD/xhtml1-transitional.dtd">
<html xlns="http://www.w3.org.1999.xhtml">
<head>
<title>EmploymentUpdate: My-SQL table handler</title>
</head>
<body>
<?php


// -------------------------------------------------------------------------------------------------//
//																									//
//	EmploymentUpdate.php: This page is called by the EmploymentMaintenace page to perform the actual//
//	database Insert, Update, and Delete query functions. 											//
//																									//
// -------------------------------------------------------------------------------------------------//



// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//
//																												//
//	Delete a record in the table, then take the user to the EmploymentList.php page with the saved list filter.	//
//																												//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//


function DeleteRecord($DBname, $TableName, $Link, $SSN)
{
	$Query = "SELECT * from $TableName where SSN=$SSN";
	$Result=mysql_db_query($DBname, $Query, $Link);

	if ($Result)
	{
		/* print("The query \"$Query\" was successfully executed!<br>\n");*/

		if (mysql_fetch_array($Result)) /* Did we obtain an existing table entry? */
		{
			$Query = "DELETE from $TableName where SSN=$SSN limit 1";
			$Result=mysql_db_query($DBname, $Query, $Link);

			if (!mysql_db_query ($DBname, $Query, $Link))
			{
				die("The query--".$Query."--was bad!<br>\n".mysql_errno().": ".mysql_error()."\n");
			}
			else
			{
				/* print("The query \"$Query\" was successfully executed!<br>\n"); */
			}
		}
		else
		{
			die("Match for borrower with Social Security Number |$SSN| was NOT found<br>\n");
		}

		mysql_close($Link);

		/*	Call the EmploymentList.php page for further table (Add, change, delete) processing. */
		/*											*/
		print ("<script>window.location='EmploymentList.php';</script>\n");
	}
	else
	{
		die("The query--".$Query."--was bad!<br>\n".mysql_errno().": ".mysql_error()."\n");
	}
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//
//																												//
//	Update a record in the table, then take the user to the EmploymentList.php page with the saved list filter.	//
//																												//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//

function UpdateRecord($DBname, $TableName, $Link, $SSN, $Employer, $Position, $MonthlyIncome, $IncomeLastYear, $LengthOfEmployment)
{
   	$Query = "UPDATE $TableName SET
  	    Employer='$Employer', Position='$Position', MonthlyIncome='$MonthlyIncome', IncomeLastYear='$IncomeLastYear',
  	    	LengthOfEmployment='$LengthOfEmployment' WHERE SSN='$SSN'";


    //print("UpdateRecord: Query was: $Query<br>\n");

	mysql_select_db($DBname,$Link); // execute the DBMS request

	/* mysql_query() returns TRUE on success and FALSE on error */

	if (!mysql_query ($Query, $Link))
	{
		print ("The query was:<br>$Query<br>Link: $Link<br>Employment Item could not be updated in the database!<br>\n");

		print ("<br><center><font face='Verdana' size='5' color='#000099'><strong>Warning!</strong></font><br><br>");
		print ("<font face='Verdana' size='2' color='#000099'>Employment Information not added.<br><br>\n");
		print ("Social Security Number  <font face='Verdana' size='3' color='#000099'>'$SSN' </font>");
		print ("<font face='Verdana' size='2' color='#000099'>is the problem Social Security Number.</font><br>\n");

		echo mysql_errno() . ": " . mysql_error(). "\n";

		mysql_close($Link);
		die ("<br>Page processing is terminated<br>\n");
	}
}


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//
//																												//
//	Insert a record in the table, then take the user to the EmploymentMaintenance.php page to continue adding.		//
//																												//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//

function InsertRecord($DBname, $TableName, $Link, $SSN, $Employer, $Position, $MonthlyIncome, $IncomeLastYear, $LengthOfEmployment)
{
   	$Query = "INSERT into $TableName values
   		('$SSN', '$Employer', 'Position', '$MonthlyIncome', '$IncomeLastYear', '$LengthOfEmployment')";

    print("Query is: $Query<br>\n");

	mysql_select_db($DBname,$Link); // select the DBMS database


	if ($SSN=="")
	{
		$SSN="Blank";
	}

	/* mysql_query() returns TRUE on success and FALSE on failure */

	if (!mysql_query ($Query, $Link)) // execute the query
	{
		print ("Error-->Link |$Link|<br>\n");

		print ("<br><center><font face='Verdana' size='5' color='#000099'><strong>Warning!</strong></font><br><br>");
		print ("<font face='Verdana' size='2' color='#000099'>Employment Information not added.<br><br>\n");
		print ("Social Security Number  <font face='Verdana' size='3' color='#000099'>'$SSN' </font>");
		print ("<font face='Verdana' size='2' color='#000099'>is a possible duplicate Social Security Number.</font><br>\n");

		echo mysql_errno() . ": " . mysql_error(). "\n";

		mysql_close($Link);

		/* Pass the List filter, $SavedLoanStatus back to the EmploymentList.php page	*/

		print("<form action='EmploymentList.php' method='post'>\n");

		//print("SavedFilter=|$SavedLoanStatus|<br><br>\n");

		print("<input type='button' value='Review Employment Record'
			onclick='timer=setTimeout(history.back(),6000);'>&nbsp;&nbsp;");

		print("<input type='submit' value='Browse All Employment Records'><br></center>");
		print("</form>");
	}
}



/*- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
/*																												*/
/*	EmploymentUpdate.php: This php page receives and handles the data generated by 'EmploymentMaintenance.php'  */
/*	and 'EmploymentList.php.' This page does the actual database queries based on the request type that was 	*/
/*	passed.																										*/
/*																												*/
/*	The values passed to this page should be: SavedLoanStatus, $RequestType, $EmploymentName, $DOB, $SSN,		*/
/*	$Co_EmploymentName, $Co_DOB, $Co_SSN																		*/
/*																												*/
/*	This page calls EmploymentList.php and passes $SavedFilter													*/
/*	This page also calls EmploymentMaintenance.php and passes $SavedLoanFilter									*/
/*																												*/
/*	Sample URL:																									*/
/*																												*/
/*- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */

	/* variables to access Database */

	$Host="localhost";
	//$User="lightnin_Tony";
	//$Password="ipowerwe";
	$DBname="lightnin_LoanApps";
	$TableName="EmploymentInfo";

/*	First connect to the MySQL DBMS on this server */

	$Link=mysql_connect ($Host, $User, $Password) or die ('I cannot connect to the DBMS because: '.mysql_error());

	//print ("Connected to database |$DBname|. Link |$Link|<br>\n");

/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
/*																		*/
/*	Next, Clean up the data before putting it in the database			*/
/*	Remove any non-digit from the social security numbers  and dates.	*/
/*																		*/
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/

	/* before storing these values, remove the formatting (non-digit) characters */

	$Pattern = "[^[:digit:]]";  /* this is the pattern (non-digits), which will be replaced by an empty string */

	$SSN = ereg_replace("[^[:digit:]]", "", $SSN);

	/* remove leading and trailing spaces, if any */

	$SSN				= trim ($SSN);
	$Employer			= trim ($Employer);
	$Position			= trim ($Position);
	$MonthlyIncome		= trim ($MonthlyIncome);
	$IncomeLastYear		= trim ($IncomeLastYear);
	$LengthOfEmployment	= trim ($LengthOfEmployment);
	$Co_SSN				= trim ($Co_SSN);

	$Co_Employer			= trim ($Co_Employer);
	$Co_Position			= trim ($Co_Position);
	$Co_MonthlyIncome		= trim ($Co_MonthlyIncome);
	$Co_IncomeLastYear		= trim ($Co_IncomeLastYear);
	$Co_LengthOfEmployment	= trim ($Co_LengthOfEmployment);

	/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
	/*																				*/
	/*	Remove double quotes. The ereg_replace uses "Regular Expression" syntax. 	*/
	/*	The backslash character (known as the Escape charater) negates the special 	*/
	/*	meaning of the following character, which in this case is a double quote,	*/
	/*	so the pattern "\"\"" is really two side-by-side double quote characters,	*/
	/*	signa=ifying an empty string that may have been erroneously passed in one	*/
	/*	of the parameters when this page was called.								*/
	/*																				*/
	/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/


	$Pattern = "\"\"";  /* this is the pattern "\"\"", which will be replaced by an empty string */

	$SSN				= ereg_replace($Pattern, "", $SSN);
    $Employer			= ereg_replace($Pattern, "", $Employer);
    $Position			= ereg_replace($Pattern, "", $Position);
    $MonthlyIncome      = ereg_replace($Pattern, "", $MonthlyIncome);
    $IncomeLastYear		= ereg_replace($Pattern, "", $IncomeLastYear);
	$LengthOfEmployment	= ereg_replace($Pattern, "", $LengthOfEmployment);

	$Co_SSN					= ereg_replace($Pattern, "", $Co_SSN);
    $Co_Employer			= ereg_replace($Pattern, "", $Co_Employer);
    $Co_Position			= ereg_replace($Pattern, "", $Co_Position);
    $Co_MonthlyIncome       = ereg_replace($Pattern, "", $Co_MonthlyIncome);
    $Co_IncomeLastYear		= ereg_replace($Pattern, "", $Co_IncomeLastYear);
	$Co_LengthOfEmployment	= ereg_replace($Pattern, "", $Co_LengthOfEmployment);

/*
	print ("SSN '$SSN'<br>\n");
	print ("Employer '$Employer'<br>\n");
	print ("Position '$Position'<br>\n");
	print ("MonthlyIncome '$MonthlyIncome'<br>\n");
	print ("IncomeLastYear '$IncomeLastYear'<br>\n");
	print ("LengthOfEmployment '$LengthOfEmployment'<br>\n");
	print ("Co_SSN '$Co_SSN'<br>\n");
	print ("Co_Employer '$Co_Employer'<br>\n");
	print ("Co_Position '$Co_Position'<br>\n");
	print ("Co_MonthlyIncome '$Co_MonthlyIncome'<br>\n");
	print ("Co_IncomeLastYear '$Co_IncomeLastYear'<br>\n");
	print ("Co_LengthOfEmployment '$Co_LengthOfEmployment'<br>\n");
*/
/*	Now the clean up is done. Either insert, delete, or update the table entry depending on the Request Type sent */

	switch ($RequestType)
	{
		case "Insert":
			InsertRecord($DBname, $TableName, $Link, $SSN, $Employer, $Position, $MonthlyIncome, $IncomeLastYear,
				$LengthOfEmployment);

			if (SCo_SSN != "")
				InsertRecord($DBname, $TableName, $Link, $Co_SSN, $Co_Employer, $Co_Position, $Co_MonthlyIncome,
					$Co_IncomeLastYear,	$Co_LengthOfEmployment);

			mysql_close($Link);

			/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
			/*																										*/
			/*	If the Queries were performed okay, go to adding more records using EmploymentMaintenance.php page, */
			/*	Be sure to send null variables, except for RequestType (to be used for requesting another Insert)	*/
			/*	and the filter (to be used when returning to EmploymentList.php).									*/
			/*																										*/
			/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/

			print("<form name='InsertRecord' action='EmploymentMaintenance.php' method='post'>\n");
			print("<input type='hidden' name='RequestType' value='Insert'>");
			print ("<script language='Javascript'>document.InsertRecord.submit();</script>");
			print("</form>");
			break;

		case "Update":
			UpdateRecord($DBname, $TableName, $Link, $SSN, $Employer, $Position, $MonthlyIncome, $IncomeLastYear,
				$LengthOfEmployment);

			if (SCo_SSN != "")
				UpdateRecord($DBname, $TableName, $Link, $Co_SSN, $Co_Employer, $Co_Position, $Co_MonthlyIncome,
					$Co_IncomeLastYear,	$Co_LengthOfEmployment);

			//die ("Testing");
			mysql_close($Link);
/*
	   	    print("UpdateRecord: Query was: $Query<br>\n");
			die ("Testing\n");
*/

			/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
			/*																			*/
			/* If the Query was an Update, go to back to the EmploymentList.php, page	*/
			/* Pass the List filter, $SavedFilter										*/
			/*																			*/
			/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/

			print ("<script>window.location=\"EmploymentList.php\";</script>\n");
			break;

		case "Delete":
			/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
			/*																			*/
			/*	Use a form and Yes/No buttons to make the user verify record deletions	*/
			/*	Once deletion is confirmed, pass a special Request Type to a new 		*/
			/*	 instance of thsi page.													*/
			/*																			*/
			/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
			print ("<br><center><H1><strong>Warning</strong></H1>Employment Information delete conformation for ");
			print ("Employment with Social Security Number: $SSN.<br>\n");

			print ("<form action='http://www.lightning-mortgage.com/LAPS/EmploymentUpdate.php' method='get'><br>\n");
			print ("<input type='submit' value='Yes'>&nbsp;&nbsp;");
			print ("<input type='button' value='No' onClick='location.href=\"EmploymentList.php\"'></center>");
			print ("<input type='hidden' name='SSN' value=$SSN><br>\n");
			print ("<input type='hidden' name='RequestType' value='ConfirmedDelete'<br>\n");
			print ("</form>");
			break;


		case "ConfirmedDelete":
			DeleteRecord($DBname, $TableName, $Link, $SSN);
			/* die ("deleting $SSN"); */
		  	break;

		default:
		 	die("Request is not an Insert, Delete, or Update. It is a '".$RequestType."' for SSN '".$SSN."'\n");
			break;

	}
?>

</body>
</html>