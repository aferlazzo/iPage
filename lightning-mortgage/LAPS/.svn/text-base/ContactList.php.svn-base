<?php
require ("../include/authenticate.php");
require ("../include/SetCookies.php");
SetCookies();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>ContactList</title>
<script language="JavaScript" src="https://host373.ipowerweb.com/~lightnin/js/Common.js"></script>
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
<link rel="stylesheet" href="../css/AdministrativeStyles.css" type="text/css">

<!--[if IE 6]>
<style type="text/css">
html
{
	scrollbar-base-color: #F4F4F4;
	scrollbar-arrow-color: #FFFFFF;
	scrollbar-track-color: #002179;
	scrollbar-face-color: #009;
	scrollbar-3dlight-color: #009;
}
</style>
<![endif]-->
</head>
<body topmargin="0" leftmargin="0">
<?php

/******************use this veriable to dump a list of applicants********************************/	
	
$ExportRecords=false;

/******************use this veriable to dump a list of applicants********************************/	

// -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*	//
//													//
//	DisplayFormattedRow: Displays the line			//
//													//
// -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*	//

function DisplayFormattedRow($Row, $Link, $UserLevel)
{
	global $SortColumn;
	global $SearchTerm;
	global $SavedFilter;

	//print ("On Line ".__LINE__." SearchTerm = |$SearchTerm|   SavedFilter = |$SavedFilter|   LoanStatus =|$Row[LoanStatus]| SSN =|$Row[SSN]|<br>\n");

	/* put in defaults if field is null */

	if (is_null($Row[Street]))
	{
		$Row[Street]="none";
	}

	if (is_null($Row[City]))
	{
		$Row[City]="00/00/00";
	}

	if (is_null($Row[State]))
	{
	$Row[State]="none";
	}

	if (is_null($Row[HomePhone]))
	{
		$Row[HomePhone]="000-000-0000";
	}

	$Row[ApplicantName]=GetBorrower($Row[SSN], $Link, $UserLevel);

	/*	 Display records that are in the table */

	print ("<tr align=center valign=middle>");

	print ("<td bgcolor='#CCCCCC'>");
	
	if  ($UserLevel == "Admin")
		print ("<form name='EditRecord' action='ContactMaintenance.php' method='post'>");
	else
		print ("<form name='EditRecord' action='FunctionDisabled.php' method='post'>");

	print ("<select size='1' name='RequestType' onChange='submit();'>");

	switch ($RequestType)
	{
		case "Edit":
			print ("<option selected value='Update'>Edit</option>");
			print ("<option value='Delete'>Delete</option>");
			break;

		case "Delete":
			print ("<option value='Update'>Edit</option>");
			print ("<option selected value='Delete'>Delete</option>");
			break;

		default:
			print ("<option selected value='Select'>Select</option>");
			print ("<option value='Update'>Edit</option>");
			print ("<option value='Delete'>Delete</option>");
			break;
	}

	if ($UserLevel != "Admin")
	{
		$Initial = substr($Row[ApplicantLastName], 0, 1);
		$ApplicantName .= $Row[ApplicantFirstName]." ".$Initial.".";
	}

	print ("</select>\n"); 
	print ("<input type='hidden' name=SSN value='$Row[SSN]'>");
	print ("<input type='hidden' name=ApplicantName value='$Row[ApplicantName]'>");
	print ("<input type='hidden' name=Street value='$Row[Street]'>");
	print ("<input type='hidden' name=City value='$Row[City]'>");
	print ("<input type='hidden' name=State value='$Row[State]'>");
	print ("<input type='hidden' name=Zip value='$Row[Zip]'>");
	print ("<input type='hidden' name=WorkPhone value='$Row[WorkPhone]'>");
	print ("<input type='hidden' name=HomePhone value='$Row[HomePhone]'>");
	print ("<input type='hidden' name=BestCallTime value='$Row[BestCallTime]'>");
	print ("<input type='hidden' name=BestCallNumber value='$Row[BestCallNumber]'>");
	print ("<input type='hidden' name=email value='$Row[email]'>");
	print ("<input type='hidden' name=StatusFlag value='$Row[StatusFlag]'>");
	print ("<input type='hidden' name=LoanStatus value='$Row[LoanStatus]'>");
	print ("</td></form>\n");
	
	/* Format the SSN */

	//print ("length is ".strlen($Row[SSN]).", value is $Row[SSN]<br>\n");
	$x = strlen($Row[SSN]);

	while ($x < 9)  // pad with leading zeros
	{
		$xxx = "0".$Row[SSN];
		$Row[SSN] = $xxx;
		$x = strlen($Row[SSN]);
		//print ("length is ".strlen($Row[SSN]).", value is $Row[SSN]<br>\n");
	}

	if (strlen($Row[SSN]) > 0)
	{
		if ($UserLevel != "Admin")
			$TempField = 'xxx-xx-'.substr($Row[SSN],5,4);
		else
			$TempField = substr($Row[SSN],0,3).'-'.substr($Row[SSN],3,2).'-'.substr($Row[SSN],5,4);

		$Row[SSN]=$TempField;
	}


	if($SortColumn == 'SSN')
		print ("<td align=center bgcolor='#EBF8F8' valign=middle>");
	else
		print ("<td align=center valign=middle>");
		
	print ("<font face='Verdana' size='2' color='#000099'>$Row[SSN]</font></td>\n");

	
	if($SortColumn == 'ApplicantName')
		print ("<td align='left' bgcolor='#EBF8F8' valign=middle>");
	else
		print ("<td align='left' valign=middle>");
		
	print ("<font face='Verdana' size='2' color='#000099'>");
	print ("$Row[ApplicantName]</font></td>");


	/* Format the $Row[Street] */

	if ($Row[Street] == "")  // Don't print Street names that equal null
	{
		$Row[Street]='&nbsp;';
	}
	else
	{
		if ($UserLevel != "Admin")
			$Row[Street]=substr($Row[Street],0,6)."xxxxxxxx";
	}

	if($SortColumn == 'Street')
		print ("<td align='left' bgcolor='#EBF8F8' valign=middle>");
	else
		print ("<td align='left' valign=middle>");

	print ("<font face='Verdana' size='2' color='#000099'>$Row[Street]</font></td>\n");

	/* Format the $Row[City] */

	if ($Row[City] == "")  // Don't print City names that equal null
	{
		$Row[City]='&nbsp;';
	}
	else
	{
		if ($UserLevel != "Admin")
			$Row[City]=substr($Row[City],0,4)."xxxxxxx";
	}

	if($SortColumn == 'City')
		print ("<td align='left' bgcolor='#EBF8F8' valign=middle>");
	else
		print ("<td align='left' valign=middle>");
		
	print ("<font face='Verdana' size='2' color='#000099'>$Row[City]</font></td>\n");

	if ($Row[State] == "")  // Don't print State that equal null
	{
		$Row[State]='&nbsp;';
	}
	else
	{
		if ($UserLevel != "Admin")
			$Row[State]="xx";
	}

	if($SortColumn == 'State')
		print ("<td align=center bgcolor='#EBF8F8' valign=middle>");
	else
		print ("<td align=center valign=middle>");
		
	print ("<font face='Verdana' size='2' color='#000099'>$Row[State]</font></td>\n");

	if ($Row[Zip] == "")  // Don't print Zip that equal null
	{
		$Row[Zip]='&nbsp;';
	}
	else
	{
		if ($UserLevel != "Admin")
			$Row[Zip]="99999";
	}


	if($SortColumn == 'Zip')
		print ("<td align=center bgcolor='#EBF8F8' valign=middle>");
	else
		print ("<td align=center valign=middle>");
		
	print ("<font face='Verdana' size='2' color='#000099'>$Row[Zip]</font></td>\n");

	if ($Row[HomePhone] == "")  // Don't print Home Phone numbers that equal null
	{
		$Row[HomePhone]='&nbsp;';
	}
	else
	{
		if ($UserLevel != "Admin")
			$Row[HomePhone]="987-654-3210";
	}

	if($SortColumn == 'Home Phone')
		print ("<td align=center bgcolor='#EBF8F8' valign=middle>");
	else
		print ("<td align=center valign=middle>");
		
	print ("<font face='Verdana' size='2' color='#000099'>$Row[HomePhone]</font></td>\n");

	if ($Row[WorkPhone] == "")  // Don't print work phone numbers that equal zero
	{
		$Row[WorkPhone]='&nbsp;';
	}
	else
	{
		if ($UserLevel != "Admin")
			$Row[WorkPhone]="123-456-7890";
	}


	if($SortColumn == 'Work Phone')
		print ("<td align=center bgcolor='#EBF8F8' valign=middle>");
	else
		print ("<td align=center valign=middle>");
		
	print ("<font face='Verdana' size='2' color='#000099'>$Row[WorkPhone]</font></td>\n");

	/* Format the $Row[BestCallTime] */

	if ($Row[BestCallTime] == "")
	{
		$Row[BestCallTime]='Anytime';
	}

	if($SortColumn == 'Best Call Time')
		print ("<td align='center' bgcolor='#EBF8F8' valign=middle>");
	else
		print ("<td align='center' valign=middle>");
		
	print ("<font face='Verdana' size='2' color='#000099'>$Row[BestCallTime]</font></td>\n");


	/* Format the $Row[Best Call Number] */

	if ($Row[BestCallNumber] == "")
	{
		$Row[BestCallNumber]='Either Phone';
	}

	if($SortColumn == 'Best Call Number')
		print ("<td align='center' bgcolor='#EBF8F8' valign=middle>");
	else
		print ("<td align='center' valign=middle>");
		
	print ("<font face='Verdana' size='2' color='#000099'>$Row[BestCallNumber]</font></td>\n");
	
	/* Format the $Row[email] */

	if ($Row[email] == "")
	{
		$Row[email]='&nbsp;';
	}
	else
	{
		if ($UserLevel != "Admin")
			$Row[email]="mailbox@domain.com";
	}

	if($SortColumn == 'E-Mail Address')
		print ("<td align='left' bgcolor='#EBF8F8' valign=middle>");
	else
		print ("<td align='left' valign=middle>");
		
	print ("<font face='Verdana' size='2' color='#000099'>");
	print ("<a href='mailto:$Row[email]'>$Row[email]</a></font></td>");

	/* Format the $Row[LoanStatus] */

	if ($Row[StatusFlag] == "")
	{
		$Row[StatusFlag]='&nbsp;';
	}
	

	if($SortColumn == 'LoanStatus')
		print ("<td align='left' width='15%' bgcolor='#EBF8F8' valign=middle>");
	else
		print ("<td align='left' width='15%' valign=middle>");
		
	print ("<font face='Verdana' size='2' color='#000099'>$Row[LoanStatus]</font></td>\n");
	
	print ("</tr>"); // end of row
	//print ("</table>");
	//die("End");
}




/* -------------------------------------------				*/
/*															*/
/*	Gets the name associated with a ss# from the database	*/
/*															*/
/*--------------------------------------------				*/
function GetBorrower($MySSN, $Link, $UserLevel)
{
	$Host="localhost";
	$DBname="lightnin_LoanApps";
	$TableName="ApplicantInfo";
	global $DateInserted;

	$TempField = ereg_replace("[^[:digit:]]", "", $MySSN);

	$Query = "SELECT * from $TableName where SSN = $TempField";
	/*print ("In GetBorrower () Query is $Query<br>\n");*/

	$Result=mysql_db_query($DBname, $Query, $Link); // look for the match


	if (!mysql_query ($Query, $Link)) // check the results of the query
	{
		print ("Error-->Link |$Link|<br>\n");

		print ("<br><center><font face='Verdana' size='5' color='#000099'><strong>Warning!</strong></font><br><br>");
		print ("<font face='Verdana' size='2' color='#000099'>Applicant Not Found.<br><br>\n");
		print ("Social Security Number<font face='Verdana' size='3' color='#000099'>'$MySSN' </font>");
		print ("<font face='Verdana' size='2' color='#000099'>was the passed Social Security Number.</font><br>\n");

		echo mysql_errno() . ": " . mysql_error(). "\n";
		mysql_close($Link);
		die ("Error in GetBorrower()");
	}

	$Record=mysql_fetch_array($Result);	// fetch the matching row in the ApplicantInfo table

	if (empty($Record[ApplicantName]))
	{
		$Name= "->>--->Not Found!<---<<-";
	}
	else
	{
		$Name=$Record[ApplicantName];
	}

	if  ($UserLevel != "Admin")
	{
		$Initial = substr($Record[ApplicantLastName], 0, 1);
		$Name = $Record[ApplicantFirstName]." ".$Initial.".";
	}

	$DateInserted = $Record[DateInserted]; //capture the Date Inserted in a global variarble

	//die ("User Level $UserLevel, Name $Name ($Record[ApplicantName], $Record[ApplicantFirstName], $Record[ApplicantLastName])");
	return($Name);
}

/* -------------------------------------------		*/
/*													*/
/*	Gets the Loan Status associated with a ss# from */
/*	the database									*/
/*													*/
/* -------------------------------------------		*/
function GetLoanStatus($MySSN, $Link)
{
	$Host="localhost";
	//$User="lightnin_Tony";
	//$Password="ipowerwe";
	$DBname="lightnin_LoanApps";
	$TableName="ApplicantInfo";

	$TempField = ereg_replace("[^[:digit:]]", "", $MySSN);

	$Query = "SELECT LoanStatus from $TableName where SSN = $TempField";
	/*print ("In GetLoanStatus () Query is $Query<br>\n");*/

	$Result=mysql_db_query($DBname, $Query, $Link); // look for the match


	if (!mysql_query ($Query, $Link)) // check the results of the query
	{
		print ("Error-->Link |$Link|<br>\n");

		print ("<br><center><font face='Verdana' size='5' color='#000099'><strong>Warning!</strong></font><br><br>");
		print ("<font face='Verdana' size='2' color='#000099'>Applicant Not Found.<br><br>\n");
		print ("Social Security Number<font face='Verdana' size='3' color='#000099'>'$MySSN' </font>");
		print ("<font face='Verdana' size='2' color='#000099'>was the passed Social Security Number.</font><br>\n");

		echo mysql_errno() . ": " . mysql_error(). "\n";
		mysql_close($Link);
		die ("Error in GetLoanStatus()");
	}

	$Record=mysql_fetch_array($Result);	// fetch the matching row in the ApplicantInfo table

	if (empty($Record[LoanStatus]))
	{
		$Name= "Not Found!";
	}
	else
	{
		$Name=$Record[LoanStatus];
	}

	return ($Name);
}


/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
/*																																*/
/*	SelectRecords: Takes the existing $Link from the mysql_connect() function, which points to the database on the server and	*/
/*	the $TableName that specifies the particular table in the database to retrieve matching records in the order dictated by	*/
/*	the $SortColumn variable.																									*/
/*																																*/
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/

function SelectRecords ($SortColumn, $DBname, $TableName, $Link)
{
	$Table2Name="ApplicantInfo";

	switch ($SortColumn)
	{
		case "SSN":
			$Query = "SELECT * from $TableName, $Table2Name where $TableName.SSN=$Table2Name.SSN order by $TableName.SSN";
			break;

		case "ApplicantName": // If sort of list is by ApplicantName,  we must read/join 2 different tables

			$Query = "SELECT * from $TableName, $Table2Name where $TableName.SSN=$Table2Name.SSN order by ApplicantLastName";
			break;

		case "Street":
			$Query = "SELECT * from $TableName, $Table2Name where $TableName.SSN=$Table2Name.SSN order by Street";
			break;

		case "City":
			$Query = "SELECT * from $TableName, $Table2Name where $TableName.SSN=$Table2Name.SSN order by City";
			break;

		case "State":
			$Query = "SELECT * from $TableName, $Table2Name where $TableName.SSN=$Table2Name.SSN order by State";
			break;

		case "Zip":
			$Query = "SELECT * from $TableName, $Table2Name where $TableName.SSN=$Table2Name.SSN order by Zip";
			break;

		case "Work Phone":
			$Query = "SELECT * from $TableName, $Table2Name where $TableName.SSN=$Table2Name.SSN order by WorkPhone";
			break;

		case "Home Phone":
			$Query = "SELECT * from $TableName, $Table2Name where $TableName.SSN=$Table2Name.SSN order by HomePhone";
			break;

		case "Best Call Time":
			$Query = "SELECT * from $TableName, $Table2Name where $TableName.SSN=$Table2Name.SSN order by BestCallTime";
			break;

		case "Best Call Number":
			$Query = "SELECT * from $TableName, $Table2Name where $TableName.SSN=$Table2Name.SSN order by BestCallNumber";
			break;

		case "E-Mail Address":
			$Query = "SELECT * from $TableName, $Table2Name where $TableName.SSN=$Table2Name.SSN order by email";
			break;

		case "SSN":
			$Query = "SELECT * from $TableName, $Table2Name where $TableName.SSN=$Table2Name.SSN order by SSN";
			break;

		case "LoanStatus":
			$Query = "SELECT * from $TableName, $Table2Name where $TableName.SSN=$Table2Name.SSN order by LoanStatus";
			break;

		default:
			$Query = "SELECT * from $TableName, $Table2Name where $TableName.SSN=$Table2Name.SSN order by ApplicantLastName";
			$SortColumn="ApplicantName";
			break;
	}

	//print ("Inside SelectRecords (), line ".__LINE__." SortColumn |$SortColumn| Query:|$Query|<br>\n");

    $Result=mysql_db_query($DBname, $Query, $Link);

	return($Result);
}


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//
//																													//
// PaginateDisplay: We need to run through the database twice.														//
//					The first time is simply to count the number of records that will actually be displayed.		//
//					The second time is to actually display the records that match the previously chosen criteria.	//
//																													//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//

function PaginateDisplay($Row, $Link, $UserLevel, $DateInserted, $CountOrDisplay)
{
	global $FromDate;	// These are cookie values
	global $ToDate;
	global $SearchTerm;
	global $SavedFilter;
	
	$Count = false;
	
	$ApplicantName = GetBorrower($Row[SSN], $Link, $UserLevel); //also sets DateInserted variable

	//was list($month, $day, $year) = sscanf($DateInserted, "%02d/%02d/%02d");// reformat MM/DD/YY date
	list($year, $month, $day) = sscanf($DateInserted, "%02d/%02d/%02d");// reformat YY/MM/DD date

	$CompareDate = sprintf("%02d%02d%02d", $year, $month, $day);			// to YYMMDD

	
	//if ($CountOrDisplay == 'Display')
	//{
	//	print ("Line ".__LINE__.", print record if ");
	//	print ("(\$SavedFilter |$SavedFilter| == 'All'' or \$Row[LoanStatus] |$Row[LoanStatus]|), and ");
	//	print ("($FromDate <= $CompareDate <= $ToDate)<br>\n");
	//}

	if (($CompareDate >= $FromDate) && ($CompareDate <= $ToDate))
	{
		//if ($CountOrDisplay == 'Display')
		//	print ("Line ".__LINE__." Candidate for printing. Within date range! $FromDate <= $CompareDate >= $ToDate<br>\n");
		
		if ($SearchTerm != "")
		{	// look through the Street, City, State, Zip and associated ApplicantName columns in the row for a match of the search term

			if (stristr($Row[Street], $SearchTerm))
			{
				$Count = true;
				if ($CountOrDisplay == 'Display')
					DisplayFormattedRow($Row, $Link, $UserLevel);			
			}

			elseif (stristr($Row[City], $SearchTerm))
			{
				$Count = true;
				if ($CountOrDisplay == 'Display')
					DisplayFormattedRow($Row, $Link, $UserLevel);			
					
			}

			elseif (stristr($Row[State], $SearchTerm))
			{
				$Count = true;
				if ($CountOrDisplay == 'Display')
					DisplayFormattedRow($Row, $Link, $UserLevel);			
			}

			elseif (stristr($Row[Zip], $SearchTerm))
			{
				$Count = true;
				if ($CountOrDisplay == 'Display')
					DisplayFormattedRow($Row, $Link, $UserLevel);			
			}

			elseif (stristr($Row[email], $SearchTerm))
			{
				$Count = true;
				if ($CountOrDisplay == 'Display')
					DisplayFormattedRow($Row, $Link, $UserLevel);			
			}

			elseif (stristr($Row[HomePhone], $SearchTerm))
			{
				$Count = true;
				if ($CountOrDisplay == 'Display')
					DisplayFormattedRow($Row, $Link, $UserLevel);			
			}

			elseif (stristr($Row[WorkPhone], $SearchTerm))
			{
				$Count = true;
				if ($CountOrDisplay == 'Display')
					DisplayFormattedRow($Row, $Link, $UserLevel);			
			}

			elseif (stristr($Row[BestCallNumber], $SearchTerm))
			{
				$Count = true;
				if ($CountOrDisplay == 'Display')
					DisplayFormattedRow($Row, $Link, $UserLevel);			
			}

			elseif (stristr($Row[BestCallTime], $SearchTerm))
			{
				$Count = true;
				if ($CountOrDisplay == 'Display')
					DisplayFormattedRow($Row, $Link, $UserLevel);			
			}

			elseif (stristr($ApplicantName, $SearchTerm))
			{
				$Count = true;
				if ($CountOrDisplay == 'Display')
					DisplayFormattedRow($Row, $Link, $UserLevel);			
			}
		}
		else
		{
			//if ($CountOrDisplay == 'Display')
			//{
			//	print ("Line ".__LINE__.", \$Row[ApplicantName] $Row[ApplicantName] print record if ");
			//	print ("(\$SavedFilter |$SavedFilter| == 'All'' or \$Row[LoanStatus] |$Row[LoanStatus]|), and ");
			//	print ("($FromDate <= $CompareDate <= $ToDate)<br>\n");
			//}
		
			//print ("Line ".__LINE__." (\$SavedFilter == \$Row[LoanStatus]) '$SavedFilter'=='$Row[LoanStatus]' $FromDate <= $CompareDate >= $ToDate<br>\n");
		
			if (($SavedFilter == "All") || ($SavedFilter == $Row[LoanStatus]))//LoanStatus is part of ApplicantInfo table
			{
				$Count = true;
				if ($CountOrDisplay == 'Display')
					DisplayFormattedRow($Row, $Link, $UserLevel);			}
		}
	}
	
	return ($Count);
}


//require ("../include/SetCookies.php");


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//
//																									//
//	ContactList: This page retrieves and displays the data in the database table 'ContactInfo'	 	//
//	A list filter is passed from other pages as a variable "$SavedFilter" and is used to list records 	//
//	with the matching BestCallNumber.																//
//																									//
//	The variable passed to this page from ContactUpdate.php and ContactMaintenance.php is 			//
//	$SavedFilter 																					//
//	Calls ContactMaintenance.php. Passes variables Filter, BestCallNumber, RequestType				//
//																									//
//																									//
//	Sample 																							//
//	http://www.lightning-mortgage.com/ContactList.php?SavedFilter=Active&ListAll=Browse+Contacts	//
//																									//
//																									//
//																									//
//																									//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//

// Always remember when you do a print ("$variable...); the variable's value will be substituted.
// When you use a single quote, print ('$variable...); the value WILL NOT be substituted.

/* variables to access Database */

	$Host="localhost";
	//$User="lightnin_Tony";
	//$Password="ipowerwe";
	$DBname="lightnin_LoanApps";
	$TableName="ContactInfo";

	$Debug = false;

	//Declare time period reporting variables

	$FromDate;
	$FromMonthName;
	$FromMonth;
	$FromDay;
	$FromYear;
	$DateRange;
	$ToDate;
	$ToMonthName;
	$ToMonth;
	$ToDay;
	$ToYear;

	print("<script type='text/javascript' language='Javascript'>AtStartCookies();</script>");

	ComputeReportingPeriod();

	/* -*-*-*-*-*-*-*-*-*-*-*-*-*-*-* Header Row of Table *-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*- */

	// to debug cell width use border='1' and bordercolor='#CCCCCC'
	print ("<table border='0' bordercolor='#CCCCCC' width='165%'cellpadding='4' cellspacing='0' align='center'>");
	print ("<tr align='center'>");
	print ("<form action='ApplicantMaster.php'>");
	print ("<td align='center' width='5%' valign='middle' bgcolor='#003399'>\n");

	print ("<p><input class='Submit' type='submit' value='LAPS Home' style='color:#fff;'></p></td></form>");

	print ("<td align='center' valign='middle' width='19%' bgcolor='#003399'>");
    print ("<a class='Logo' href='http://www.lightning-mortgage.com/index.php'>");
    print ("<img border='0' src='../images/Lightning-Mortgage.jpg' align='center' ");
    print ("alt='Lightning Mortgage - Mortgage Finance and Refinance'></a></td>");

	print ("<td align='left' width='34%' valign='middle' bgcolor='#003399'>\n");
	DisplayReportingPeriodRangeOptions();
	print ("</td><td bgcolor='#003399'>&nbsp;</td></tr></table>\n");

	print ("<table><form name='FilterIt' action='ContactList.php' method='post'>");

	print ("<tr><td align='left' valign='middle'>&nbsp;&nbsp;");
	print ("<input type='submit' value='Clear' onclick='window.document.FilterIt.SearchTerm.value=\"\"'>");

	if ($SearchTerm != "")
		print ("&nbsp;&nbsp;<input type='text' style='background: #FFFF00' name='SearchTerm' value='$SearchTerm'size='20'>&nbsp;&nbsp;");
	else
		print ("&nbsp;&nbsp;<input type='text' name='SearchTerm' value='$SearchTerm' size='20'>&nbsp;&nbsp;");

	print ("<input type='submit' name'Search' value='Search'></td>\n");

	print ("<td align='center' valign='middle'><font face='Verdana' size='3' color='#000099'>");

	print ("<table border='1' bordercolor='#000099' cellpadding='2' cellspacing='0'>");
	print ("<td bgcolor='#003399'><a class='Top' href='./WorkingStatusList.php'>Daily Status</a></td>");
	print ("<td bgcolor='#9C31CE'><a class='Top' href='./ApplicantList.php'>Applicant</a></td>");
	print ("<td style='background:#397352;'><span style='font:small bolder Verdana,Geneva,Arial,Helvetica,sans-serif;color:yellow;'>Contact</span></td>");
	print ("<td bgcolor='#CE6300'><a class='Top' href='./LoanList.php'>Loan</a></td>");
	print ("<td bgcolor='#9C9C31'><a class='Top' href='./EmploymentList.php'>Employment</a></td>");
	print ("</table></td>");

	print ("<td align='right' width='15%' valign='middle'><font face='Verdana' size='2' color='#000099'>");
	print ("Filter By Status&nbsp;</font></td>\n");

	print ("<td align='Left' width='8%' valign='middle'><font face='Verdana' size='2' color='#000099'>");
	FilterStatus();
	print ("</td><td align=center valign=middle width='90'><font face='Verdana' size='3' color='#000099'>&nbsp;");
	print ("</font></td></tr>");
	print ("</form></table>\n");

	/* *-*-*-*-*-*-*-*-*-*- Title Row: Create a screen table for displaying the data, print the Title row -*-*-*-*-*-*/
	
	/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
	/*																									*/
	/* Neat trick for the pulldown menu: When an item changes, simulate the submit button being pressed	*/
	/* the form action reloads this page. The method=get displays the passed Filter field and the chosen*/
	/* parameter on the command line on reload.															*/
	/*																									*/
	/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/

	/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
	/*																										*/
	/* 	We are planning to pass the current Loan Status (when the value of the variable is created below).	*/
	/*	The reason we are going to do this is to maintain a consistent user experience. We want the records	*/
	/*	listed to have the same record filter enabled as it presently is without the user having to choose	*/
	/*	the BestCallNumber again.																			*/
	/*																										*/
	/*	When control passes back to this page (from ContactUpdate or ContactMaintenance) we 				*/
	/*	will want to use the same filtering criteria for displaying the list of table entries that we are	*/
	/*	presently using to display records for the user. We use a <form> to pass the this filter variable	*/
	/*	to ContactMaintenace.																				*/
	/*																										*/
	/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/

	$xxx=$SavedFilter;
	
	print ("<table border=1 cellpadding=3 cellspacing='0' bordercolor='#000099' align=center width='165%'>");
	print ("<tr align='center' valign='middle'>");

	/* we'll put the "Add New" button in this cell */

	print ("<td align=center width='5%' valign='middle' bgcolor='#CCCCCC'><font face='Verdana' size='2' color='#000099'>");
	print ("<form action='ContactMaintenance.php' method='get'>");
	print ("<input type='hidden' name=RequestType value='Insert'>");	
	print ("<input type='submit' name='submit' value='Add New'");
	print ("title='Click to Add a New Record'>");
	print ("</td></form>");
	
	//print ("</tr></table>");
	//die("End");
	/* print the Headings row in the table using white characters on a blue background.*/

	/* Header row has "sort by" column headers. When you click on a header name, the database is reread and redisplayed */
	/* Set the order of the records retrieved according to $SortColumn */

	if ($SortColumn == 'SSN')
		print ("<td align=center width='7%' valign='middle' bgcolor='#397352'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center width='7%' valign='middle' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	
	print ("<form action='$PHP_SELF' method='post'>");	
	print ("<input type='submit' name='SortColumn' value='SSN'");	/* Social Security button */
	print (" title='Click to sort on Social Security Number Column'>");
	print ("<input type='hidden' name='SavedFilter' value='$SavedFilter'>");
	print ("</td></form>");

	if ($SortColumn == 'ApplicantName')
		print ("<td align=center width='14%' valign='middle' bgcolor='#397352'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center width='14%' valign='middle' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	
	print ("<form action='$PHP_SELF' method='post'>");
	print ("<input type='submit' name='SortColumn' value='ApplicantName'");	/* ApplicantName button */
	print (" title='Click to sort on ApplicantName Column'>");
	print ("<input type='hidden' name='SavedFilter' value='$SavedFilter'>");
	print ("</td></form>");

	if ($SortColumn == 'Street')
		print ("<td align=center width='16%' valign='middle' bgcolor='#397352'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center width='16%' valign='middle' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	
	print ("<form action='$PHP_SELF' method='post'>");	
	print ("<input type='submit' name='SortColumn' value='Street'");	/* Street button */
	print (" title='Click to sort on Street Column'>");
	print ("<input type='hidden' name='SavedFilter' value='$SavedFilter'>");
	print ("</td></form>");


	if ($SortColumn == 'City')
		print ("<td align=center width='10%' valign='middle' bgcolor='#397352'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center width='10%' valign='middle' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	
	print ("<form action='$PHP_SELF' method='post'>");	
	print ("<input type='submit' name='SortColumn' value='City'");	/* City button */
	print (" title='Click to sort on City Column'>");
	print ("<input type='hidden' name='SavedFilter' value='$SavedFilter'>");
	print ("</td></form>");

	if ($SortColumn == 'State')
		print ("<td align=center width='3%' valign='middle' bgcolor='#397352'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center width='3%' valign='middle' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	
	print ("<form action='$PHP_SELF' method='post'>");	
	print ("<input type='submit' name='SortColumn' value='State'>");	/* State button */
	print ("<input type='hidden' name='SavedFilter' value='$SavedFilter'>");
	print ("</td></form>");

	if ($SortColumn == 'Zip')
		print ("<td align=center width='3%' valign='middle' bgcolor='#397352'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center width='3%' valign='middle' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	
	print ("<form action='$PHP_SELF' method='post'>");	
	print ("<input type='submit' name='SortColumn' value='Zip'>");	/* Zipcode button */
	print ("<input type='hidden' name='SavedFilter' value='$SavedFilter'>");
	print ("</td></form>");

	if ($SortColumn == 'Home Phone')
		print ("<td align=center width='5%' valign='middle' bgcolor='#397352'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center width='5%' valign='middle' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	
	print ("<form action='$PHP_SELF' method='post'>");	
	print ("<input type='submit' name='SortColumn' value='Home Phone'>");	/* Home Phone button */
	print ("<input type='hidden' name='SavedFilter' value='$SavedFilter'>");
	print ("</td></form>");

	if ($SortColumn == 'Work Phone')
		print ("<td align=center width='5%' valign='middle' bgcolor='#397352'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center width='5%' valign='middle' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	
	print ("<form action='$PHP_SELF' method='post'>");	
	print ("<input type='submit' name='SortColumn' value='Work Phone'>");	/* Work Phone button */
	print ("<input type='hidden' name='SavedFilter' value='$SavedFilter'>");
	print ("</td></form>");

	if ($SortColumn == 'Best Call Time')
		print ("<td align=center width='7%' valign='middle' bgcolor='#397352'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center width='7%' valign='middle' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	
	print ("<form action='$PHP_SELF' method='post'>");	
	print ("<input type='submit' name='SortColumn' value='Best Call Time'>");	/* Best Call Time button */
	print ("<input type='hidden' name='SavedFilter' value='$SavedFilter'>");
	print ("</td></form>");

	if ($SortColumn == 'Best Call Number')
		print ("<td align=center width='7%' valign='middle' bgcolor='#397352'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center width='7%' valign='middle' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	
	print ("<form action='$PHP_SELF' method='post'>");	
	print ("<input type='submit' name='SortColumn' value='Best Call Number'>");	/* Best Call Number button */
	print ("<input type='hidden' name='SavedFilter' value='$SavedFilter'>");
	print ("</td></form>");

	if ($SortColumn == 'E-Mail Address')
		print ("<td align=center width='10%' valign='middle' bgcolor='#397352'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center width='10%' valign='middle' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	
	print ("<form action='$PHP_SELF' method='post'>");	
	print ("<input type='submit' name='SortColumn' value='E-Mail Address'>");	/* E-Mail Address button */
	print ("<input type='hidden' name='SavedFilter' value='$SavedFilter'>");
	print ("</td></form>");

	if ($SortColumn == 'LoanStatus')
		print ("<td align=center width='3%' valign='middle' bgcolor='#397352'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center width='3%' valign='middle' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	
	print ("<form action='$PHP_SELF' method='post'>");	
	print ("<input type='submit' name='SortColumn' value='LoanStatus'>");	/* Loan Status button */
	print ("<input type='hidden' name='SavedFilter' value='$SavedFilter'>");
	print ("</td></form>");

	print ("</tr>"); // end of row

	// *-*-*-*-*-*-*-*-*-*-*-*-*-*-*-* End of Header Rows *-*-*-*-*-*-*-*-*-*-*-*-*-*

	/* first, connect to the MySQL DBMS on this server */
	$Link=mysql_connect ($Host, $User, $Password) or die ('I cannot connect to the DBMS because: '.mysql_error());

	/* select everything from the database table. Sort by the column name passed */

	//print ("At Start SortColumn is |$SortColumn| SavedFilter is |$SavedFilter| SearchTerm is |$SearchTerm|<br>\n");

	$Result = SelectRecords($SortColumn, $DBname, $TableName, $Link); /* Set the order of the records retrieved according to $SortColumn */


	// Now fetch the the Contact data from the database and display records with a matching Loan Status

	//$TableName.SSN=$Table2Name.SSN
	//print ("On Line ".__LINE__." SavedFilter = |$SavedFilter| Result=|$Result|  LoanStatus =|$Row[LoanStatus]| SSN =|$Row[SSN]|<br>\n");

	$DateInserted; //must declare veriable before using the global keyword in a function


	// Let's process the Contact Table's records that have been sorted according to the $ColumnSort value
	// First we want to count the number of rows that actually meet the other filter and Search criteria
	//
	// pseudo code: for x = 0 to end of table, if record meets filter criteria, 
	// put the ContactTable's row number in the $MatchingRow table
	
	$TotalRows = 0;
	$MatchingRow = array_fill(0, 5000, 0); //Create the array to handle tables with up to 5000 rows
	$x = 0;
	
	// The challenge is: All rows in the table will not be printed. So we must determine which rows should
	// be printed so we can later jump to those rows as we later page through the Table.

	while ($Row=mysql_fetch_array($Result))
	{
		$Row[LoanStatus] = GetLoanStatus($Row[SSN], $Link);

		$Row[ApplicantName] = GetBorrower($Row[SSN], $Link, $UserLevel);

		//print ("Line ".__LINE__." \$ApplicantName '$ApplicantName' \$Row[ApplicantName] '$Row[ApplicantName]' \$Row[ApplicantName] '$Row[ApplicantName]'<br>\n");

		//was list($month, $day, $year) = sscanf($DateInserted, "%02d/%02d/%02d");// reformat MM/DD/YY date
		list($year, $month, $day) = sscanf($DateInserted, "%02d/%02d/%02d");// reformat YY/MM/DD date

		$CompareDate = sprintf("%02d%02d%02d", $year, $month, $day);			// to YYMMDD

		//print ("Line ".__LINE__." DateInserted $DateInserted -  YY $year MM $month DD $day - $CompareDate - $FromDate - $ToDate<br>\n");

		// Display the row if it meets all criteria
		if (PaginateDisplay($Row, $Link, $UserLevel, $DateInserted, 'Count'))
		{
			$MatchingRow[$TotalRows] = $x;
			//print ("Line ".__LINE__." \$MatchingRow[$TotalRows]  \$x $x \$Row[ApplicantName] = |$Row[ApplicantName]|<br>\n");
			$TotalRows++;
		}
		
		$x++;
	}

	 if (TotalRows > 5000)
	 	die("Error: LoanList line ".__LINE__." Matching Row array exceeds 5,000 records. Must increase table size.");
	 	
	// TotalRows == Total. Now determine if we have called ourselves (i.e. was the Page variable passed?)
	
   if(empty($Page))  //not passed, so set $Page variable to 1.
        $Page = 1; 
 
	// *-*-*-*-*-* Compute the display maximums for rows and pages variables *-*-*-*-*-*
	
	if (!empty($_GET[Page])) // This is the passed parameter. If over rides the cookie value if not on the first page
		$Page= $_GET[Page];
	
	//print ("Line ".__LINE__." \$TotalRows=$TotalRows to be printed<br>\n");

	$RowsPerPage = 15;
	
	if ($TotalRows > 0)
	{
		//print ("Line ".__LINE__." \$TotalRows=$TotalRows \$TotalPages=$TotalPages<br>\n");
		$q = $TotalRows / $RowsPerPage;
		//print ("Line ".__LINE__." \$TotalRows=$TotalRows \$TotalPages=$TotalPages \$q=$q<br>\n");
	 	$q = intval($q); //lets try 16 rows per page
		//print ("Line ".__LINE__." \$TotalRows=$TotalRows \$TotalPages=$TotalPages \$q=$q \$s=$s<br>\n");
		$s = $TotalRows % $RowsPerPage;
		//print ("Line ".__LINE__." \$TotalRows=$TotalRows \$TotalPages=$TotalPages \$q=$q \$s=$s<br>\n");
		$s = intval($s); //lets try 16 rows per page
		//print ("Line ".__LINE__." \$TotalRows=$TotalRows \$TotalPages=$TotalPages \$q=$q \$s=$s<br>\n");
		$TotalPages = $q; //lets try 16 rows per page
		//print ("Line ".__LINE__." \$TotalRows=$TotalRows \$TotalPages=$TotalPages \$q=$q \$s=$s<br>\n");
		
		if ($s > 0)
			$TotalPages = $TotalPages + 1;

		//print ("Line ".__LINE__." \$TotalRows=$TotalRows \$TotalPages=$TotalPages \$q=$q \$s=$s<br>\n");
	}
	else
	{
		$TotalPages	= 1;		//if no rows found
		print ("<tr><br><br><H1>No Matching Records</H1></tr>\n");
	}
		
	//print ("Line ".__LINE__." \$TotalRows = $TotalRows. At 16 lines/page there are $TotalPages pages. \$q=$q \$s=$s<br>\n");

	
	if ($TotalRows < $RowsPerPage)  //if the number of rows do not warrant at least second page...
	{
		$TotalPages 	= 1;
		$StartRow		= 0;
		$EndRow			= $TotalRows - 1;		//Compute the last row for the one page & query
		
		//print ("Line ".__LINE__." Screen $TotalPages (Single screen), has rows $StartRow - $EndRow; ");
	}
	else	//Multiple pages 
	{
		for ($x=0; $x < $TotalPages; $x++)
		{
			$CurrentPage    = $x + 1;
			$StartRow 		= $x * $RowsPerPage;
		
			if ($CurrentPage < $TotalPages)
				$EndRow 		= ($x * $RowsPerPage) + ($RowsPerPage - 1);		//Compute the last row for the page
			else
				$EndRow 		= $TotalRows; 	//Compute the last row for the query
			
			//print ("Line ".__LINE__." Page $CurrentPage, will display rows $StartRow - $EndRow;<br>\n");
		}
	}
	
	// *-*-*-*-*-*-*-* Now let's export the records -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*
	
	if ($ExportRecords==true)
	{
		//print("\$TotalRows $TotalRows<br>\n");
		
		for ($e = 0; $e < $TotalRows; $e++)
		{
			
			if (!mysql_data_seek($Result, $MatchingRow[$e])) // reset the ContactInfoTable's pointer
			     die ("Cannot seek to row $MatchingRow[$e]: " . mysql_error() . "\n");
			print("\$e $e<br>\n");
			
			if ($Row=mysql_fetch_array($Result)) // got a match
			{
				//print("\$Row[SSN] $Row[SSN]<br>\n");
				$Row[ApplicantName] = GetBorrower($Row[SSN], $Link, $UserLevel);
				print ("$Row[ApplicantName]|$Row[email]<br\n");
			}
		}
	}
				

		
	// *-*-*-*-*-*-*-* Now let's display the records -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*
	
	if (!empty($_GET[Page])) // This is the passed parameter. It overrides the cookie value if not on the first page
		$Page= $_GET[Page];
		
	$ThisRow = ($Page - 1) * $RowsPerPage;	//depending on which page we're now on will determine the first row to display

	//for ($x=0; $x < 20; $x++)
	//	print(On Line ".__LINE__." \$MatchingRow[$x] $MatchingRow[$x]<br>\n");
		
	if (!mysql_data_seek($Result, $MatchingRow[$ThisRow])) // reset the ContactInfoTable's pointer
	     die ("Cannot seek to row $MatchingRow[$ThisRow]: " . mysql_error() . "\n");


	//print ("On Line ".__LINE__." This page's first row = |$ThisRow| \$MatchingRow[$ThisRow] $MatchingRow[$ThisRow] in the ContactTable<br>\n");
	
	$x = 0;	// Set counter for the row number on the page to zero
	
	//print ("Line ".__LINE__." At row \$ThisRow $ThisRow in table, \$EndRow $EndRow \$RowsPerPage $RowsPerPage preparing to process...<br>\n");
	
	while (($Row=mysql_fetch_array($Result)) && ($x <= $EndRow) && ($x < $RowsPerPage))//print up to 15 rows
	{
		//print ("Line ".__LINE__." fetching row \$ApplicantName '$Row[ApplicantName]' screen row \$x=|$x| \$EndRow $EndRow \$RowsPerPage $RowsPerPage<br>\n");
		
		// needed when sortcolumn != applicant name:
		//$Row[ApplicantName] = GetBorrower($Row[SSN], $Link, $UserLevel);

		//list($month, $day, $year) = sscanf($Row[DateInserted], "%02d/%02d/%02d");// reformat MM/DD/YY date
		//$CompareDate = sprintf("%02d%02d%02d", $year, $month, $day);			// to YYMMDD

		//print ("Line ".__LINE__." DateInserted $Row[DateInserted] -  YY $year MM $month DD $day - $CompareDate - $FromDate - $ToDate<br>\n");
		//print ("Line ".__LINE__." checking line: $x \$MatchingRow[$ThisRow] $MatchingRow[$ThisRow] \$Row[DateInserted] $Row[DateInserted] \$Row[ApplicantName] = |$Row[ApplicantName]|<br>\n");

		// Display the row if it meets all criteria
		
		if (PaginateDisplay($Row, $Link, $UserLevel, $Row[DateInserted], 'Display'))
		{
			//print ("Line ".__LINE__." Printed: \$ApplicantName = |$Row[ApplicantName]|<br>\n");
			$x++;
		}
	}

	//print ("Line ".__LINE__." \$Page $Page \$TotalPages=$TotalPages ");
	
	if($Page > 1)  // This is the passed parameter or cookie value.
	{ 
        $PagePrev = $Page - 1; 
        //$Page=$PagePrev; 
        print ("</table><br>&nbsp;&nbsp;<FONT color=red>«</FONT><font face='Verdana' strong size='2' color='#000099'><a href=\"$PHP_SELF?Page=$PagePrev\"><b> Previous</b></a>&nbsp;&nbsp;</font>"); 
        //print ("</table><br>&nbsp;&nbsp;<FONT color=red>«</FONT><font face='Verdana' strong size='2' color='#000099'><a href=\"$PHP_SELF?Page=$PagePrev\"><b> Previous</b></a>&nbsp;&nbsp;</font>"); 
    }
    else  // if on first page...
    { 
        print ("</table><br>&nbsp;&nbsp;<FONT color=red>«</FONT><font face='Verdana' strong size='2' color='#000099'> Previous&nbsp;&nbsp;</font>"); //simulate the Previous page HyperLink
    } 

    //print ("Line ".__LINE__." \$Page $Page \$TotalPages=$TotalPages ");
    
    print ("<font face='Verdana' strong size='2' color='#000099'>");
    $i = 1;
    
    while ($i < (1 + $TotalPages)) //now create the navigation hyperlinks
    { 
        if ($i == $Page)
        { 
            print ("<b>$i</b>&nbsp;"); //don't create a hyperlink for the current page
        }
        
        if (($i <> $Page) && ($TotalPages > 1))
        { 
            print ("<a href='$PHP_SELF?Page=$i'>$i</a>&nbsp;&nbsp;"); 
        } 
        
        $i++;
    } 
    
//    if(($TotalRows % $TotalPages) != 0)  //if the number of rows are not evenly divisible by the number of screens
//    { 
//        if($i == $Page)
//        { 
//            print ($i."&nbsp;"); // we are on this page, so just print the page number, don't make it a hyperlink
//        }
//        else
//        { 
//            print ("<a href=\"$PHP_SELF?Page=$i\">$i</a>&nbsp;&nbsp;"); 
//        } 
//    } 

    if(($TotalRows - ($RowsPerPage * $Page)) > 0)  //if not on the last page
    { 
        $Pagenext = $Page + 1; 
          
        print ("  <a href=\"$PHP_SELF?Page=$Pagenext\"><b>Next</b></a> <FONT color=red>»</FONT>"); //create a link to the next page
    }
    else
    { 
        print ("<font face='Verdana' strong size='2' color='#000099'>  Next <FONT color=red>»</FONT>"); //simulate the hyperlink to the non-existent next page
    }     

	//die ("end");
	//print ("<input type='hidden' name=RequestType 		value='Insert'>\n");
	//print ("</form>");
	mysql_close($Link);
?>
</body>
</html>
