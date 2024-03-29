<?php
require ("../include/authenticate.php");
?>

<!DOCTYPE html PUBLIC "-//W3//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/2000/REC-xhtml1-20000126/DTD/xhtml1-transitional.dtd">
<html xlns="http://www.w3.org.1999.xhtml">
<head>
<title>ContactUpdate form handler</title>
</head>
<body>
<?php


// -------------------------------------------------------------------------------------------------//
//																									//
//	ContactUpdate.php: This page is called by the ContactMaintenace page to perform the actual	//
//	database Insert, Update, and Delete query functions. 											//
//																									//
// -------------------------------------------------------------------------------------------------//



// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//
//																												//
//	Delete a record in the table, then take the user to the ContactList.php page with the saved list filter.	//
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

		/*	Call the ContactList.php page for further table (Add, change, delete) processing. */
		/*											*/
		print ("<script>window.location='ContactList.php';</script>\n");
	}
	else
	{
		die("The query--".$Query."--was bad!<br>\n".mysql_errno().": ".mysql_error()."\n");
	}
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//
//																												//
//	Update a record in the table, then take the user to the ContactList.php page with the saved list filter.	//
//																												//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//

function UpdateRecord($DBname, $TableName, $Link, $SSN, $Street, $City, $State, $Zip,$WorkPhone,
					$HomePhone, $BestCallTime, $BestCallNumber, $email, $StatusFlag)
{
   	$Query = "UPDATE $TableName SET
  	    Street='$Street', City='$City', State='$State', Zip='$Zip', WorkPhone='$WorkPhone',
  	      HomePhone='$HomePhone', BestCallTime='$BestCallTime', BestCallNumber='$BestCallNumber',
  	      email='$email', StatusFlag='$StatusFlag' WHERE SSN='$SSN'";

	mysql_select_db($DBname,$Link); // execute the DBMS request

	/* mysql_query() returns TRUE on success and FALSE on error */

	if (!mysql_query ($Query, $Link))
	{
		die("The query was:<br>$Query<br>Link: $Link<br>Contact Item could not be updated in the database!<br>\n");
	}
	else
	{
		mysql_close($Link);
/*
   	    print("UpdateRecord: Query was: $Query<br>\n");
		die ("Testing\n");
*/

		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
		/*																			*/
		/* If the Query was an Update, go to back to the ContactList.php, page	*/
		/* Pass the List filter, $SavedFilter									*/
		/*																			*/
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/


		print ("<script>window.location=\"ContactList.php\";</script>\n");
	}
}


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//
//																												//
//	Insert a record in the table, then take the user to the ContactMaintenance.php page to continue adding.		//
//																												//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//

function InsertRecord($DBname, $TableName, $Link, $SSN, $Street, $City, $State, $Zip,$WorkPhone,
					$HomePhone, $BestCallTime, $BestCallNumber, $email, $StatusFlag)
{
   	$Query = "INSERT into $TableName values ('$SSN',	'$Street',	'$City',	'$State',	'$Zip',	'$WorkPhone',
	        '$HomePhone',	'$BestCallTime',	'$BestCallNumber',	'$email',	'$StatusFlag')";



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
		print ("<font face='Verdana' size='2' color='#000099'>Contact Information not added.<br><br>\n");
		print ("Social Security Number  <font face='Verdana' size='3' color='#000099'>'$SSN' </font>");
		print ("<font face='Verdana' size='2' color='#000099'>is a possible duplicate Social Security Number.</font><br>\n");

		echo mysql_errno() . ": " . mysql_error(). "\n";

		mysql_close($Link);

		/* Pass the List filter, $SavedLoanStatus back to the ContactList.php page	*/

		print("<form action='ContactList.php' method='post'>\n");
		print("<input type='button' value='Review Contact Record' onclick='location.href=\"ContactList.php\"'>&nbsp;&nbsp;");
		print("<input type='submit' value='Browse All Contact Records'><br></center>");
		print("</form>\n");
	}
	else
	{
		mysql_close($Link);

		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
		/*																										*/
		/*	If the Query was performed okay, go to adding more records using ContactMaintenance.php page, 	*/
		/*	Be sure to send null variables, except for RequestType (to be used for requesting another Insert)	*/
		/*	and the filter (to be used when returning to ContactList.php).									*/
		/*																										*/
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/

		print("Insert Complete. Now transfer to a new page<br>\n");
		print("<script>window.location='ContactMaintenance.php';</script>\n");

		print ("window.location='ContactMaintenance.php';");
	}
}



/*- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
/*																												*/
/*	ContactUpdate.php: This php page receives and handles the data generated by 'ContactMaintenance.php'  	*/
/*	and 'ContactList.php.' This page does the actual database queries based on the request type that was 		*/
/*	passed.																										*/
/*																												*/
/*	The values passed to this page should be: SavedLoanStatus, $RequestType, $ContactName, $DOB, $SSN,		*/
/*	$Co_ContactName, $Co_DOB, $Co_SSN																			*/
/*																												*/
/*	This page calls ContactList.php and passes $SavedFilter													*/
/*	This page also calls ContactMaintenance.php and passes $SavedLoanFilter									*/
/*																												*/
/*	Sample URL:																									*/
/*																												*/
/*	http://www.lightning-mortgage.com/ContactUpdate.php?RequestType=Update&SavedLoanStatus=Active				*/
/*	&ContactName=John+Consumer&DOB=11%2F11%2F11&SSN=777-44-1111&Co_ContactName=Jane+Consumer				*/
/*	&Co_DOB=10%2F10%2F10&Co_SSN=333-66-9999&HowReferred=Newspaper+Ad&LoanStatus=Active&Update=Update+Record		*/
/*																												*/
/*- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */

	/* variables to access Database */

	$Host="localhost";
	$User="lightnin_Tony";
	$Password="ipowerwe";
	$DBname="lightnin_LoanApps";
	$TableName="ContactInfo";

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

	$SSN		= ereg_replace("[^[:digit:]]", "", $SSN);
    //$HomePhone	= ereg_replace("[^[:digit:]]", "", $HomePhone);
    //$WorkPhone	= ereg_replace("[^[:digit:]]", "", $WorkPhone);

	/* remove leading and trailing spaces, if any */

	$SSN			= trim ($SSN);
	$Street			= trim ($Street);
	$City			= trim ($City);
	$State			= trim ($State);
	$Zip			= trim ($Zip);
	$WorkPhone		= trim ($WorkPhone);
	$HomePhone		= trim ($HomePhone);
	$BestCallTime	= trim ($BestCallTime);
	$BestCallNumber = trim ($BestCallNumber);
	$email 			= trim ($email);
	$StatusFlag 	= trim ($StatusFlag);

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


	$Pattern = "\"\"";  /* this is the pattern "", which will be replaced by an empty string */

	$SSN			= ereg_replace($Pattern, "", $SSN);
    $Street			= ereg_replace($Pattern, "", $Street);
    $City          	= ereg_replace($Pattern, "", $City);
    $State			= ereg_replace($Pattern, "", $State);
	$Zip			= ereg_replace($Pattern, "", $Zip);
	$WorkPhone		= ereg_replace($Pattern, "", $WorkPhone);
	$HomePhone		= ereg_replace($Pattern, "", $HomePhone);
	$BestCallTime	= ereg_replace($Pattern, "", $BestCallTime );
	$BestCallNumber	= ereg_replace($Pattern, "", $BestCallNumber);
	$email			= ereg_replace($Pattern, "", $email);
	$StatusFlag		= ereg_replace($Pattern, "", $StatusFlag);

/*	Now the clean up is done. Either insert, delete, or update the table entry depending on the Request Type sent */

	if ($RequestType=="Insert")
	{
		InsertRecord($DBname, $TableName, $Link, $SSN, $Street, $City, $State, $Zip,$WorkPhone,
					$HomePhone, $BestCallTime, $BestCallNumber, $email, $StatusFlag);
	}
	else
	{
		if ($RequestType=="Update")
		{
			UpdateRecord($DBname, $TableName, $Link, $SSN, $Street, $City, $State, $Zip,$WorkPhone,
					$HomePhone, $BestCallTime, $BestCallNumber, $email, $StatusFlag);
  		}
		else
		{
			if ($RequestType=="Delete")
			{
				/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
				/*																			*/
				/*	Use a form and Yes/No buttons to make the user verify record deletions	*/
				/*	Once deletion is confirmed, pass a special Request Type to a new 		*/
				/*	 instance of thsi page.													*/
				/*																			*/
				/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/

				print ("<br><center><H1><strong>Warning</strong></H1>Contact Information delete conformation for ");
				print ("Contact with Social Security Number: $SSN.<br>\n");

				print ("<form action='http://www.lightning-mortgage.com/LAPS/ContactUpdate.php' method='get'><br>\n");
				print ("<input type='submit' value='Yes'>&nbsp;&nbsp;");
				print ("<input type='button' value='No' onClick='location.href=\"ContactList.php\"'></center>");
				print ("<input type='hidden' name='SSN' value=$SSN><br>\n");
				print ("<input type='hidden' name='RequestType' value='ConfirmedDelete'<br>\n");
				print ("</form><br>\n");
			}
			else
			{	/* this is a trick: Call yourself and execute the actual delete */
				if ($RequestType=="ConfirmedDelete")
				{
					DeleteRecord($DBname, $TableName, $Link, $SSN);
					/* die ("deleting $SSN"); */
		  		}
		  		else
		  		{
				 	die("Request is not an Insert, Delete, or Update. It is a '".$RequestType."' for SSN '".$SSN."'\n");
				}
			}
		}
	}
?>

</body>
</html>