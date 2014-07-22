<?php
require ("../include/authenticate.php");
require ("../include/SetCookies.php");
SetCookies();
?>

<!DOCTYPE html PUBLIC "-//W3//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/2000/REC-xhtml1-20000126/DTD/xhtml1-transitional.dtd">
<html xlns="http://www.w3.org.1999.xhtml">
<head>
<title>WorkingStatusUpdate: My-SQL table handler</title>
<script language="JavaScript" src="https://host373.ipowerweb.com/~lightnin/js/Common.js">
</script>
<script language="JavaScript">
var cookies=new Object();
function GetMyValue(CookieName)
{
var Name,Value;
var Beginning,Middle,End;
Beginning=0;
while(Beginning<document.cookie.length)
{
Middle=document.cookie.indexOf('=',Beginning);
End=document.cookie.indexOf(';',Beginning);
if(End==-1)
End=document.cookie.length;
if((Middle>End)||(Middle==-1))
{
Name=document.cookie.substring(Beginning,End);
Value="";
}
else
{
Name=document.cookie.substring(Beginning,Middle);
Value=document.cookie.substring(Middle+1,End);
}
cookies[Name]=unescape(Value);
Beginning=End+2;
}
return(cookies[CookieName]);
}

function AtStartCookies()
{
User=GetMyValue('User');
SavedFilter=GetMyValue('SavedFilter');
Password=GetMyValue('Password');
SortColumn=GetMyValue('SortColumn');
SearchTerm=GetMyValue('SearchTerm');
MyValue=GetMyValue('SavedFilter');
FromDate=GetMyValue('FromDate');
FromMonth=GetMyValue('FromMonth');
FromDay=GetMyValue('FromDay');
FromYear=GetMyValue('FromYear');
ToDate=GetMyValue('ToDate');
ToMonth=GetMyValue('ToMonth');
ToDay=GetMyValue('ToDay');
ToYear=GetMyValue('ToYear');
DateRange=GetMyValue('DateRange');
UpdatedBy=GetMyValue('UpdatedBy');
CommentLimit=GetMyValue('CommentLimit');
Page=GetMyValue('Page');
LastApplicantPrinted=GetMyValue('LastApplicantPrinted');
CommentsOtApplicantPrinted=GetMyValue('CommentsOtApplicantPrinted');
}
</script>
</head>
<body>
<?php


// -------------------------------------------------------------------------------------------------//
//																									//
//	WorkingStatusUpdate.php: This page is called by the WorkingStatusMaintenace page to perform 	//
//	the actual database Insert, Update, and Delete query functions. 								//
//																									//
// -------------------------------------------------------------------------------------------------//



// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//
//																												//
//	Delete a record in the table, then take the user to the WorkingStatusList.php page with the saved list filter.	//
//																												//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//


function DeleteRecord($DBname, $TableName, $Link, $SSN, $id)
{
	$Query = "SELECT * from $TableName where id=$id and SSN=$SSN";
	$Result=mysql_db_query($DBname, $Query, $Link);

	if ($Result)
	{
		/* print("The query \"$Query\" was successfully executed!<br>\n");*/

		if (mysql_fetch_array($Result)) /* Did we obtain an existing table entry? */
		{
			$Query = "DELETE from $TableName where id=$id and SSN=$SSN limit 1";
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

		/*	Call the WorkingStatusList.php page for further table (Add, change, delete) processing. */
		/*											*/
		print ("<script>window.location='WorkingStatusList.php';</script>\n");
	}
	else
	{
		die("The query--".$Query."--was bad!<br>\n".mysql_errno().": ".mysql_error()."\n");
	}
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//
//																												//
//	Update a record in the table, then take the user to the WorkingStatusList.php page with the saved list filter.	//
//																												//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//

function UpdateRecord($DBname, $TableName, $Link, $id, $SSN, $Comments, $ReportDate, $PointStatus)
{
	global $SavedFilter;
	global $SortColumn;
	global $SearchTerm;

	$Query = "UPDATE $TableName SET Comments='$Comments', ReportDate='$ReportDate', PointStatus='$PointStatus' WHERE SSN='$SSN' and id='$id'";

	mysql_select_db($DBname,$Link); // execute the DBMS request

	/* mysql_query() returns TRUE on success and FALSE on error */

	if (!mysql_query ($Query, $Link))
	{
		print ("The query was:<br>$Query<br>Link: $Link<br>WorkingStatus Item could not be updated in the database!<br>\n");

		print ("<br><center><font face='Verdana' size='5' color='#000099'><strong>Warning!</strong></font><br><br>");
		print ("<font face='Verdana' size='2' color='#000099'>WorkingStatus Information not added.<br><br>\n");
		print ("Social Security Number  <font face='Verdana' size='3' color='#000099'>'$SSN' </font>");
		print ("<font face='Verdana' size='2' color='#000099'>is the problem Social Security Number.</font><br>\n");

		echo mysql_errno() . ": " . mysql_error(). "\n";

		mysql_close($Link);
		die ("<br>Page processing is terminated<br>\n");
	}
	else
	{
		mysql_close($Link);

		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
		/*																			*/
		/* If the Query was an Update, go to back to the WorkingStatusList.php.		*/
		/*																			*/
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/

		//die ("On line ".__LINE__." SavedFilter $SavedFilter, SortColumn $SortColumn, SearchTerm $SearchTerm<br>\n");

		print ("<script>window.location=\"WorkingStatusList.php\";</script>\n");
	}
}


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//
//																												//
//	Insert a record in the table, then take the user to the WorkingStatusMaintenance.php page to continue adding.	//
//																												//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//

function InsertRecord($DBname, $TableName, $Link, $SSN, $Comments, $ReportDate, $PointStatus)
{
   	$Query = "INSERT into $TableName values (0, '$SSN', '$Comments', '$ReportDate', '$PointStatus')";

    //print("Query is: $Query<br>\n");

	mysql_select_db($DBname, $Link); // select the DBMS database


	if ($SSN=="")
	{
		$SSN="Blank";
	}

	/* mysql_query() returns TRUE on success and FALSE on failure */

	if (!mysql_query ($Query, $Link)) // execute the query
	{
		print ("Error-->Link |$Link|$Query|<br>\n");

		print ("<br><center><font face='Verdana' size='5' color='#000099'><strong>Warning!</strong></font><br><br>");
		print ("<font face='Verdana' size='2' color='#000099'>Working Status Information not added.<br><br>\n");
		print ("Social Security Number  <font face='Verdana' size='3' color='#000099'>'$SSN' </font>");
		print ("<font face='Verdana' size='2' color='#000099'>is a possible duplicate Social Security Number.</font><br>\n");

		echo mysql_errno() . ": " . mysql_error(). "\n";

		mysql_close($Link);

		print("<form action='https://host373.ipowerweb.com/~lightnin/LAPS/WorkingStatusList.php' method='post>");

		print("<input type='button' value='Review WorkingStatus Record'");
		print("onClick='location.href=\"WorkingStatusList.php\"'>&nbsp;&nbsp;");

		print("<input type='submit' value='Browse All WorkingStatus Records'><br></center>");
		print("</form>\n");
	}
	else
	{
		mysql_close($Link);

		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
		/*																										*/
		/*	If the Query was performed okay, go to adding more records using WorkingStatusMaintenance.php page, */
		/*	Be sure to send null variables, except for RequestType (to be used for requesting another Insert)	*/
		/*	and the filter (to be used when returning to WorkingStatusList.php).								*/
		/*																										*/
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/

		//print("Insert Complete. Now transfer to a new page<br>\n");
		print("<script>window.location='WorkingStatusList.php';</script>\n");

		print ("window.location='WorkingStatusList.php';");
	}
}




/*- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
/*																												*/
/*	WorkingStatusUpdate.php: This php page receives and handles the data generated by 							*/
/*	'WorkingStatusMaintenance.php' and 'WorkingStatusList.php.' This page does the actual database queries 		*/
/*	based on the request type that was passed.																	*/
/*																												*/
/*																												*/
/*	Sample URL:																									*/
/*																												*/
/*- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */

	print("<script type='text/javascript' language='Javascript'>AtStartCookies();</script>");

	//print ("On line ".__LINE__." SavedFilter $SavedFilter, SortColumn $SortColumn, SearchTerm $SearchTerm<br>\n");

	/* variables to access Database */

	$Host="localhost";
	//$User="lightnin_Tony";
	//$Password="ipowerwe";
	$DBname="lightnin_LoanApps";
	$TableName="WorkingStatusInfo";
	//UpdatedBy; //must define variable before using in SetCookies () with the global variable.

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

	$SSN = ereg_replace("[^[:digit:]]", "", $SSN);  // remove dashes

	/* remove leading and trailing spaces, if any */

	//$SSN				= trim ($SSN);
	//$Comments			= trim ($Comments);
	//$ReportDate		= trim ($ReportDate);

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
    $Comments			= ereg_replace($Pattern, "", $Comments);
    $ReportDate    		= ereg_replace($Pattern, "", $ReportDate);
    $PointStatus   		= ereg_replace($Pattern, "", $PointStatus);
	$SSN = ereg_replace("[^[:digit:]]", "", $SSN);

/*	Now the clean up is done. Either insert, delete, or update the table entry depending on the Request Type sent */

	//print ("RequestType = $RequestType<br>\n");

	switch ($RequestType)
	{
		case "Insert":
			$xxx = "Entered By $UpdatedBy: ".$Comments;
			//print ("Inserted By $UpdatedBy<br>\n");
			InsertRecord($DBname, $TableName, $Link, $SSN, $xxx, $ReportDate, $PointStatus);
			break;

		case "Update":
			$xxx = "Updated By $UpdatedBy: ".$Comments;
			//die ("In WorkingStatusUpdate line ".__LINE__." ReportDate $ReportDate UpdatedBy = $UpdatedBy<br>\n");
			UpdateRecord($DBname, $TableName, $Link, $id, $SSN, $xxx, $ReportDate, $PointStatus);
  			break;

		case "Delete":

			/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
			/*																			*/
			/*	Use a form and Yes/No buttons to make the user verify record deletions	*/
			/*	Once deletion is confirmed, pass a special Request Type to a new 		*/
			/*	 instance of thsi page.													*/
			/*																			*/
			/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/

			print ("<font face='Verdana' color='#000099'><br><center><table width='30%'>");
			print ("<tr><H1><strong>Warning</strong></center></H1></tr><tr><left>Delete confirmation for ");
			print ("DailyStatus:</tr><tr>&nbsp;</tr><tr>Applicant Name: $ApplicantName</tr>");
			print ("<tr>&nbsp;</tr><tr>Social Security Number: ");

			/* Format the SSN */

			//print ("length is ".strlen($SSN).", value is $SSN<br>\n");
			$x = strlen($SSN);

			while ($x < 9)  // pad with leading zeros
			{
				$xxx = "0".$SSN;
				$SSN = $xxx;
				$x = strlen($SSN);
				//print ("length is ".strlen($SSN).", value is $SSN<br>\n");
			}

			if (strlen($SSN) > 0)
			{
				$xxx= substr($SSN,0,3).'-'.substr($SSN,3,2).'-'.substr($SSN,5,4);
				$SSN=$xxx;
			}

			print ("$SSN</tr><tr>&nbsp;</tr>");
			print ("<tr>id=$id</tr><tr>&nbsp;</tr><tr>Comment=".urldecode($Comments)."</tr><tr>&nbsp;</tr>");
			$xxx=$id;
			print ("<tr><form action=\"$PHP_SELF\" method='post'></tr>");
			print ("<tr><input type='submit' value='Yes'>&nbsp;&nbsp;");
			print ("<input type='button' value='No' onClick='location.href=\"WorkingStatusList.php\"'></tr>");
			print ("<input type='hidden' name='SSN' value=$SSN>");
			print ("<input type='hidden' name='RequestType' value='ConfirmedDelete'>");
			print ("<input type='hidden' name='id' value=$xxx>");
			print ("</left></form></table>");
			break;

		case "ConfirmedDelete": /* this is a neat trick: Call yourself and execute the actual delete */
			DeleteRecord($DBname, $TableName, $Link, $SSN, $id);
			break;

		default:
		 	die("Request is not an Insert, Delete, or Update. It is a '".$RequestType."' for SSN '".$SSN."'\n");
			break;
	}

?>

</body>
</html>