<?php
require ("../include/authenticate.php");
require ("../include/SetCookies.php");
SetCookies();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Applicant List</title>
<script language="JavaScript" src="https://host373.ipowerweb.com/~lightnin/js/Common.js">
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
<script type="text/javascript" language='Javascript'>
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


function UpdateCookie(Setting)
{
	XX = 'SavedFilter=' + Setting;
	document.cookie=XX;
	return(true);
}
</script>
</head>
<body topmargin="0" leftmargin="0">
<?php

// -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*	//
//																		//
//	DisplayFormattedRow: Displays the line				//
//																		//
// -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*	//


function DisplayFormattedRow($Row, $Link, $UserLevel)
{
	global $SortColumn;
	
	/* put in defaults if field is null */

	if (is_null($Row[ApplicantName]))
	{
		$Row[ApplicantName]="none";
	}

	if (is_null($Row[DOB]))
	{
		$Row[DOB]="00/00/0000";
	}

	if (is_null($Row[Co_ApplicantName]))
	{
	$Row[Co_ApplicantName]="none";
	}

	if (is_null($Row[Co_DOB]))
	{
		$Row[Co_DOB]="00/00/0000";
	}

	/*	 Display records that are in the table */

	print ("<tr align=center valign=middle>");
	$Row[SSN] = urlencode($Row[SSN]);
	$Row[DOB] = urlencode($Row[DOB]);
	$Row[ApplicantName] = urldecode($Row[ApplicantName]);
	$Row[Co_SSN] = urldecode($Row[Co_SSN]);
	$Row[Co_DOB] = urldecode($Row[Co_DOB]);
	$Row[Co_ApplicantName] = urldecode($Row[Co_ApplicantName]);
	$Row[HowReferred] = urldecode($Row[HowReferred]);
	$Row[LoanStatus] = urldecode($Row[LoanStatus]);
	// fist check for needing to add leading zero

	if (strlen($Row[DOB]) == 7)
	{
		$xxx = "0".$Row[DOB];
		$Row[DOB] = $xxx;
	}

	/* Format the $Row[DOB] */

	//if (strlen($Row[DOB]) > 0)
	{
		$xxx= substr($Row[DOB],0,2).'/'.substr($Row[DOB],2,2).'/'.substr($Row[DOB],4,4);
		$Row[DOB]=$xxx;
	}

	if ($Row[DOB] == "")  // Don't print DOB numbers that equal null
	{
		$Row[DOB]='&nbsp;';
	}
	// fist check for needing to add leading zero

	//print ("\nlength = strlen($Row[Co_DOB])");

	if (strlen($Row[Co_DOB]) == 7)
	{
		$xxx = "0".$Row[Co_DOB];
		$Row[Co_DOB] = $xxx;
	}

	/* Format the $Row[Co_DOB] */

	if (strlen($Row[Co_DOB]) > 0)
	{
		$xxx= substr($Row[Co_DOB],0,2).'/'.substr($Row[Co_DOB],2,2).'/'.substr($Row[Co_DOB],4,4);
		$Row[Co_DOB]=$xxx;
	}

	if ($Row[Co_DOB] == "")  // Don't print DOB numbers that equal null
	{
		$Row[Co_DOB]='&nbsp;';
	}

	/* -*-*-*-*-*-*-*-*-* Left column in row action button *-*-*-*-*-*-*-*-*-*/

	print ("<td width='3%' bgcolor='#CCCCCC'>");

	if  ($UserLevel == "Admin")
		print ("<form name='EditRecord' action='ApplicantMaintenance.php' method='post'>");
	else
		print ("<form name='EditRecord' action='FunctionDisabled.php' method='post'>");

	print ("<select size='1' name='RequestType' onChange='submit();'>");

	switch ($RequestType)
	{
		case "Export":
			print ("<option selected value='Export'>Export</option>");
			print ("<option value='Update'>Edit</option>");
			print ("<option value='Delete'>Delete</option>");
			break;

			case "Edit":
			print ("<option value='Export'>Export</option>");
			print ("<option selected value='Update'>Edit</option>");
			print ("<option value='Delete'>Delete</option>");

			break;

		case "Delete":
			print ("<option value='Export'>Export</option>");
			print ("<option value='Update'>Edit</option>");
			print ("<option selected value='Delete'>Delete</option>");
			break;



		default:
			print ("<option selected value='Select'>Select</option>");
			print ("<option value='Export'>Export</option>");
			print ("<option value='Update'>Edit</option>");
			print ("<option value='Delete'>Delete</option>");
			break;
	}

	print ("<input type='hidden' name=SSN value='$Row[SSN]'>");
	print ("<input type='hidden' name=DOB value='$Row[DOB]'>");
	print ("<input type='hidden' name=ApplicantName value='$Row[ApplicantName]'>");
	print ("<input type='hidden' name=Co_SSN value='$Row[Co_SSN]'>");
	print ("<input type='hidden' name=Co_DOB value='$Row[Co_DOB]'>");
	print ("<input type='hidden' name=Co_ApplicantName value='$Row[Co_ApplicantName]'>");

	if ($UserLevel != "Admin")
	{
		$Initial = substr($Row[ApplicantLastName], 0, 1);
		$ApplicantName .= $Row[ApplicantFirstName]." ".$Initial.".";

		$Initial    = substr($Row[Co_ApplicantLastName], 0, 1);
		$Co_ApplicantName .= $Row[Co_ApplicantFirstName]." ".$Initial.".";
	}

	print ("<input type='hidden' name=HowReferred value='$Row[HowReferred]'>");
	print ("<input type='hidden' name=DateInserted value='$Row[DateInserted]'>");
	print ("<input type='hidden' name=LoanStatus value='$Row[LoanStatus]'>");
	print ("</td></form>");

	/*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*/

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
		if($UserLevel != "Admin")
			$xxx = 'xxx-xx-'.substr($Row[SSN],5,4);
		else
			$xxx = substr($Row[SSN],0,3).'-'.substr($Row[SSN],3,2).'-'.substr($Row[SSN],5,4);

		$Row[SSN]=$xxx;
	}
	
	// -*-*-*-*-*-*-*-* Print Columns *-*-*-*-*-*-*-*-*-*-*-*-*-*

	if($SortColumn == 'SSN')
		print ("<td align=center bgcolor='#F5F2FE' valign=middle>");
	else
		print ("<td align=center valign=middle>");
	
	print ("<font face='Verdana' size='2' color='#000099'>$Row[SSN]</font></td>");

	if($SortColumn == 'ApplicantName')
		print ("<td align='left' bgcolor='#F5F2FE' valign=middle>");
	else
		print ("<td align='left' valign=middle>");

	if  ($UserLevel != "Admin")
	{
		print ("<font face='Verdana' size='2' color='#000099'>");
		$Initial = substr($Row[ApplicantLastName], 0, 1);
		print ("$Row[ApplicantFirstName] $Initial.</font></td>");
	}
	else
		print ("<font face='Verdana' size='2' color='#000099'>$Row[ApplicantName]</font></td>");

	if($SortColumn == 'DOB')
		print ("<td align=center bgcolor='#F5F2FE' valign=middle>");
	else
		print ("<td align=center valign=middle>");

	print ("<font face='Verdana' size='2' color='#000099'>$Row[DOB]</font></td>");
	
	/* Format the Co_SSN */

	if (strlen($Row[Co_SSN]) > 0)
	{
		//print ("length is ".strlen($Row[Co_SSN]).", value is $Row[Co_SSN]<br>\n");
		$x = strlen($Row[Co_SSN]);

		while ($x < 9)  // pad with leading zeros
		{
			$xxx = "0".$Row[Co_SSN];
			$Row[Co_SSN] = $xxx;
			$x = strlen($Row[Co_SSN]);
		}

		//print("Line ".__LINE__." $UserLevel '$Row[Co_SSN]'");

		if ($Row[Co_SSN] != "000000000")
		{
			if ($UserLevel != "Admin")
			{
				//print("equal");
			 	$xxx = 'xxx-xx-'.substr($Row[Co_SSN],5,4);
			}
			else
			{
				//print("unequal");
				$xxx = substr($Row[Co_SSN],0,3).'-'.substr($Row[Co_SSN],3,2).'-'.substr($Row[Co_SSN],5,4);
			}

			$Row[Co_SSN]=$xxx;
		}
		else
			$Row[Co_SSN]='&nbsp;';

	}
	else  // Do not print social security numbers that equal zero
	{
			$Row[Co_SSN]='&nbsp;';
	}

	if($SortColumn == 'Co_SSN')
		print ("<td align=center width='10%' bgcolor='#F5F2FE' valign=middle>");
	else
		print ("<td align=center width='10%' valign=middle>");
		
	print ("<font face='Verdana' size='2' color='#000099'>$Row[Co_SSN]</font></td>");


	if ($Row[Co_ApplicantName] == "")  // Don't print name that equal null
	{
		$Row[Co_ApplicantName]='&nbsp;';
	}


	if($SortColumn == 'Co_ApplicantName')
		print ("<td align='left' bgcolor='#F5F2FE' valign=middle>");
	else
		print ("<td align='left' valign=middle>");
		
		
	if ($UserLevel != "Admin")
	{
		if ($Row[Co_ApplicantName] == "")  // Don't print name that equal null
		{
			$Row[Co_ApplicantName]='&nbsp;';
		}
		else
		{
			print ("<font face='Verdana' size='2' color='#000099'>");
			$Initial = substr($Row[Co_ApplicantLastName], 0, 1);
			print ("$Row[Co_ApplicantFirstName] $Initial.</font></td>");
		}
	}
	else
	{
		print ("<font face='Verdana' size='2' color='#000099'>
			$Row[Co_ApplicantName]</font></td>");
	}


	if($SortColumn == 'Co_DOB')
		print ("<td align=center bgcolor='#F5F2FE' valign=middle>");
	else
		print ("<td align=center valign=middle>");
		
	print ("<font face='Verdana' size='2' color='#000099'>$Row[Co_DOB]</font></td>");


	if($SortColumn == 'HowReferred')
		print ("<td align=center bgcolor='#F5F2FE' valign=middle>");
	else
		print ("<td align=center valign=middle>");
		
	print ("<font face='Verdana' size='2' color='#000099'>$Row[HowReferred]</font></td>");

	if ($Row[DateInserted] == "")  // Don't print name that equal null
		$Row[DateInserted]='&nbsp;';
	else
	{
		list($year, $month, $day) = sscanf($Row[DateInserted], "%02d/%02d/%02d");// reformat YY/MM/DD date
		$Row[DateInserted] = sprintf("%02d/%02d/%02d", $month, $day, $year);			// to MM/DD/YY
	}

	if($SortColumn == 'DateEntered')
		print ("<td align=center bgcolor='#F5F2FE' valign=middle>");
	else
		print ("<td align=center valign=middle>");
		
	print ("<font face='Verdana' size='2' color='#000099'>$Row[DateInserted]</font></td>");

	if ($Row[LoanStatus] == "")  // Don't print name that equal null
		$Row[LoanStatus]='&nbsp;';


	if($SortColumn == 'LoanStatus')
		print ("<td align='left' bgcolor='#F5F2FE' valign=middle>");
	else
		print ("<td align='left' valign=middle>");
		
	print ("<font face='Verdana' size='2' color='#000099'>$Row[LoanStatus]</font></td>");

	print ("</tr>"); // end of row


	$FilterSave=$Row[LoanStatus];
	/*print ("FilterSave= $FilterSave     LoanStatus=$LoanStatus       Row[LoanStatus]=$Row[LoanStatus]\n");*/
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
	//print ("Inside SelectRecords (), line ".__LINE__." SortColumn |$SortColumn|<br>\n");

	switch ($SortColumn)
	{
		case "SSN":
			$Query = "SELECT * from $TableName order by SSN";
			break;

		case "DOB":
			$Query = "SELECT * from $TableName order by DOB";
			break;

		case "Co_SSN":
			$Query = "SELECT * from $TableName order by Co_SSN";
			break;

		case "Co_ApplicantName":
			$Query = "SELECT * from $TableName order by Co_ApplicantLastName";
			break;

		case "Co_DOB":
			$Query = "SELECT * from $TableName order by Co_DOB";
			break;

		case "HowReferred":
			$Query = "SELECT * from $TableName order by HowReferred";
			break;

		case "LoanStatus":
			$Query = "SELECT * from $TableName order by LoanStatus";
			break;

		case "DateEntered":
			$Query = "SELECT * from $TableName order by DateInserted";
			break;

		default:
			$Query = "SELECT * from $TableName order by ApplicantLastName"; // This is the default
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

	//was list($month, $day, $year) = sscanf($DateInserted, "%02d/%02d/%02d");// reformat MM/DD/YY date
	list($year, $month, $day) = sscanf($DateInserted, "%02d/%02d/%02d");// reformat YY/MM/DD date

	$CompareDate = sprintf("%02d%02d%02d", $year, $month, $day);			// to YYMMDD
	
	if (($CompareDate >= $FromDate) && ($CompareDate <= $ToDate))
	{
		//print ("Row = |$Row| Result = |$Result|");
		//print("In list. SavedFiler=|$SavedFilter|<br>\n");

		if ($SearchTerm != "")
		{	// look through the ApplicantName, Co_Applicant, HowReferred columns in the row for a match of the search term

			if (stristr($Row[Co_ApplicantName], $SearchTerm))
			{
				$Count = true;
				if ($CountOrDisplay == 'Display')
					DisplayFormattedRow($Row, $Link, $UserLevel);
			}
			elseif (stristr($Row[ApplicantName], $SearchTerm))
			{
				$Count = true;
				if ($CountOrDisplay == 'Display')			
					DisplayFormattedRow($Row, $Link, $UserLevel);
			}
			elseif (stristr($Row[HowReferred], $SearchTerm))
			{
				$Count = true;
				if ($CountOrDisplay == 'Display')
					DisplayFormattedRow($Row, $Link, $UserLevel);
			}
		}
		else
		{
			//if ($CountOrDisplay == 'Display')
			//	print ("Line ".__LINE__." (\$SavedFilter == \$Row[LoanStatus]) '$SavedFilter'=='$Row[LoanStatus]' $FromDate <= $CompareDate >= $ToDate<br>\n");

			if (($SavedFilter == "All") || ($SavedFilter == $Row[LoanStatus]))//LoanStatus is part of ApplicantInfo table
			{
				$Count = true;
				if ($CountOrDisplay == 'Display')			
			 		DisplayFormattedRow($Row, $Link, $UserLevel);
			}
		}
	}
	
	return ($Count);
}


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
	//print ("WWW<br>\n");

	ComputeReportingPeriod();
	//print ("XXX<br>\n");

	// neat way to printout the arrays keys and their values
/*
	$n = count($_POST);
	print ("Line ".__LINE__." POST: $n parameters received.<br>\n");

	for ($n=0; $n < count($_POST); $n++)
	{
		$Parameter= each($_POST);
		print ("Line ".__LINE__." Posted $Parameter[key] = $Parameter[value]<p>\n");
	}

	print ("Line ".__LINE__." SavedFilter =|$SavedFilter|<br>\n");
*/



	/* -*-*-*-*-*-*-*-*-*-*-*-*-*-*-* Header Row of Table *-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*- */

			//debug using bordercolor='#CCCCCC'
	print ("<table bgcolor='#003399' border='0' bordercolor='#cccccc' width='115%' cellpadding='4' cellspacing='0' align='center'>");
	print ("<tr align='center' valign='top'>");
	print ("<form action='ApplicantMaster.php'>");
	print ("<td bgcolor='#003399' align='center' width='5%' valign='middle'>\n");

	print ("<p><input class='Submit' type='submit' value='LAPS Home' style='color:#fff;'></p></form>");
	print ("<form action='Logout.php'><p><input class='Submit' type='submit' value='Logout'></p></td></form>");

	print ("<td bgcolor='#003399' align='right' valign='middle' colspan='3'>");
    print ("<a class='Logo' href='http://www.lightning-mortgage.com/index.php'>");
    print ("<img border='0' src='../images/Lightning-Mortgage.jpg' align='center' ");
    print ("alt='Lightning Mortgage - Mortgage Finance and Refinance'></a></td>");

	print ("<td align='right' width='10%' valign='middle' bgcolor='#003399'>\n");
	DisplayReportingPeriodRangeOptions();
	print ("</td><td bgcolor='#003399' width='45%'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table>\n");

	print ("<table width='115%' border='0' bordercolor='#CCCCCC' cellpadding='3' cellspacing='0' align='center'>");

	print ("<form name='FilterIt' action='ApplicantList.php' method='post'>");
	print ("<tr><td align='middle' width='12%' valign='middle'>");
	print ("&nbsp;&nbsp;<input type='submit' value='Clear' onclick='window.document.FilterIt.SearchTerm.value=\"\"'>");

	if ($SearchTerm != "")
		print ("&nbsp;&nbsp;<input type='text' style='background: #FFFF00' name='SearchTerm' value='$SearchTerm'size='20'>&nbsp;&nbsp;");
	else
		print ("&nbsp;&nbsp;<input type='text' name='SearchTerm' value='$SearchTerm' size='20'>&nbsp;&nbsp;");

	print ("<input type='submit' name'Search' value='Search'></td>\n");

	print ("<td align='center' width='40%' valign='middle'><font face='Verdana' size='3' color='#000099'>");
	
	print ("<table border='1' bordercolor='#000099' cellpadding='2' cellspacing='0'>");
	print ("<td bgcolor='#003399'><a class='Top' href='./WorkingStatusList.php'>Daily Status</a></td>");
	print ("<td style='background:#9C31CE;'><span style='font:small bolder Verdana,Geneva,Arial,Helvetica,sans-serif;color:yellow;'>Applicant</span></td>");
	print ("<td bgcolor='#397352'><a class='Top' href='./ContactList.php'>Contact</a></td>");
	print ("<td bgcolor='#CE6300'><a class='Top' href='./LoanList.php'>Loan</a></td>");
	print ("<td bgcolor='#9C9C31'><a class='Top' href='./EmploymentList.php'>Employment</a></td>");
	print ("</table></td>");
	
	print ("<td align='right' width='15%' valign='middle'><font face='Verdana' size='2' color='#000099'>");
	print ("Filter By Status&nbsp;</font></td>\n");

	print ("<td align='Left' valign='middle'><font face='Verdana' size='2' color='#000099'>&nbsp;");
	FilterStatus();

	print ("</font></td></form><td></td></tr></table>");
	print ("<table width='115%' border='1' bordercolor='#000099' cellpadding='3' cellspacing='0' align='center'>\n");


	/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
	/*																										*/
	/* 	We are planning to pass the current Loan Status (when the value of the variable is created below).	*/
	/*	The reason we are going to do this is to maintain a consistent user experience. We want the records	*/
	/*	listed to have the same record filter enabled as it presently is without the user having to choose	*/
	/*	the LoanStatus again.																				*/
	/*																										*/
	/*	When control passes back to this page (from ApplicantUpdate or ApplicantMaintenance) we 			*/
	/*	will want to use the same filtering criteria for displaying the list of table entries that we are	*/
	/*	presently using to display records for the user. We use a <form> to pass the this filter variable	*/
	/*	to ApplicantMaintenace.																				*/
	/*																										*/
	/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/

	/* we'll put the "Add New" button in this cell */

	print ("<form action='ApplicantMaintenance.php' method='get'>");
	print ("<input type='hidden' name=RequestType value='Insert'>");
	print ("<td align=center valign=top bgcolor='#CCCCCC'><font face='Verdana' size='2' color='#000099'>");
	print ("<input type='submit' name='submit' value='Add New'>");
	print ("</td></form>");

	/* print the Headings row in the table using white characters on a blue background.*/

	/* Header row has "sort by" column headers */

	// SSN Heading

	if ($SortColumn == 'SSN')
		print ("<td align=center width='8%' bgcolor='#A020F0'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center width='8%' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");

	print ("<form action='$PHP_SELF' method='post'>");
	print ("<input type='submit' name='SortColumn' value='SSN' color='#FFFFFF'");
	print (" title='Click to sort on Social Security Number Column'>");
	print ("</td></form>");

	//Applicant Name Heading

	if ($SortColumn == 'ApplicantName')
		print ("<td align=center width='14%' bgcolor='#A020F0'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center width='14%' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");

	print ("<form action='$PHP_SELF' method='post'>");
	print ("<input type='submit' name='SortColumn' value='ApplicantName' ");
	print (" title='Click to sort on Applicant Name Column'>");
	print ("</td></form>");

	//DOB Heading

	if ($SortColumn == 'DOB')
		print ("<td align=center width='7%' bgcolor='#A020F0'>");
	else
		print ("<td align=center width='7%' bgcolor='#CCCCCC'>");

	print ("<font face='Verdana' strong size='2' color='#FFFFFF'>");
	print ("<form action='ApplicantList.php' method='post'>");
	print ("<input type='submit' name='SortColumn' value='DOB' ");
	print (" title='Click to sort on Date Of Birth Column'>");
	print ("</td></form>");

	// Co_SSN Heading

	if ($SortColumn == 'Co_SSN')
		print ("<td align=center width='8%' bgcolor='#A020F0'>");
	else
		print ("<td align=center width='8%' bgcolor='#CCCCCC'>");
		
	print ("<font face='Verdana' strong size='2' color='#FFFFFF'>");
	print ("<form action='ApplicantList.php' method='post'>");
	print ("<input type='submit' name='SortColumn' value='Co_SSN' ");
	print (" title='Click to sort on Co-Applicant Social Security Number Column'>");
	print ("</td></form>");

	//Co_Applicant Name Heading

	if ($SortColumn == 'Co_ApplicantName')
		print ("<td align=center width='14%' bgcolor='#A020F0'>");
	else
		print ("<td align=center width='14%' bgcolor='#CCCCCC'>");
		
	print ("<font face='Verdana' strong size='2' color='#FFFFFF'>");
	print ("<form action='ApplicantList.php' method='post'>");
	print ("<input type='submit' name='SortColumn' value='Co_ApplicantName' ");
	print (" title='Click to sort on Co-Applicant Name Column'>");
	print ("</td></form>");

	//Co_DOB Heading

	if ($SortColumn == 'Co_DOB')
		print ("<td align=center width='7%' bgcolor='#A020F0'>");
	else
		print ("<td align=center width='7%' bgcolor='#CCCCCC'>");

	print ("<font face='Verdana' strong size='2' color='#FFFFFF'>");
	print ("<form action='ApplicantList.php' method='post'>");
	print ("<input type='submit' name='SortColumn' value='Co_DOB' ");
	print (" title='Click to sort on Co_Applicant Date Of Birth Column'>");
	print ("</td></form>");

	//Referred By Heading

	if ($SortColumn == 'HowReferred')
		print ("<td align=center width='12%' bgcolor='#A020F0'>");
	else
		print ("<td align=center width='12%' bgcolor='#CCCCCC'>");

	print ("<font face='Verdana' strong size='2' color='#FFFFFF'>");
	print ("<form action='ApplicantList.php' method='post'>");
	print ("<input type='submit' name='SortColumn' value='HowReferred' ");
	print (" title='Click to sort on \"HowReferred\" Column'>");
	print ("</td></form>");

	//Date Entered Heading

	if ($SortColumn == 'DateEntered')
		print ("<td align=center width='12%' bgcolor='#A020F0'>");
	else
		print ("<td align=center width='12%' bgcolor='#CCCCCC'>");

	print ("<font face='Verdana' strong size='2' color='#FFFFFF'>");
	print ("<form action='ApplicantList.php' method='post'>");
	print ("<input type='submit' name='SortColumn' value='DateEntered' ");
	print (" title='Click to sort on DateEntered Column'>");
	print ("</td></form>");

	//Loan Status Heading

	if ($SortColumn == 'LoanStatus')
		print ("<td align=center width='12%' bgcolor='#A020F0'>");
	else
		print ("<td align=center width='12%' bgcolor='#CCCCCC'>");

	print ("<font face='Verdana' strong size='2' color='#FFFFFF'>");
	print ("<form action='ApplicantList.php' method='post'>");
	print ("<input type='submit' name='SortColumn' value='LoanStatus' ");
	print (" title='Click to sort on \"LoanStatus\" Column'>");
	print ("</td></form>");
	print ("</tr>"); // end of row
	print ("</form>");

	// *-*-*-*-*-*-*-*-*-*-*-*-*-*-*-* End of Header Rows *-*-*-*-*-*-*-*-*-*-*-*-*-*
	
	/* first, connect to the MySQL DBMS on this server */

	$Link=mysql_connect ($Host, $User, $Password) or die ('I cannot connect to the DBMS because: '.mysql_error());

	/* select everything from the database table, sorting by the column name passed in $SortColumn */

	$Result = SelectRecords($SortColumn, $DBname, $TableName, $Link); /* Set the order of the records retrieved according to $SortColumn */


	//print ("Query |$Query| DBname |$DBname| Link |$Link| Result |$Result|<br>\n");
	
	// Now fetch the the Applicant from the database and display records with a matching Loan Status

	//print("\nSearching for: $SearchTerm\n");
	

	// Let's process the Loan Table's records that have been sorted according to the $ColumnSort value
	// First we want to count the number of rows that actually meet the other filter and Search criteria
	
	$TotalRows = 0;
	$MatchingRow = array_fill(0, 5000, 0); //Create the array to handle tables with up to 5000 rows
	$x = 0;
	
	// The challenge is: All rows in the table will not be printed. So we must determine which rows should
	// be printed so we can later jump to those rows as we later page through the Table.
		
	

	while ($Row=mysql_fetch_array($Result))
	{
			//was list($month, $day, $year) = sscanf($Row[DateInserted], "%02d/%02d/%02d");// reformat MM/DD/YY date
			list($year, $month, $day) = sscanf($Row[DateInserted], "%02d/%02d/%02d");// reformat YY/MM/DD date
			$CompareDate = sprintf("%02d%02d%02d", $year, $month, $day);			// to YYMMDD

			//print ("DateInserted $Row[DateInserted] -  YY $year MM $month DD $day - $CompareDate - $FromDate - $ToDate<br>\n");

			if ($Debug)
			{
				print ("Line ".__LINE__.", print record if ");
				print ("(\$SearchTerm |$SearchTerm| is null or matches), ");
				print ("(\$SavedFilter |$SavedFilter| == 'All'' or \$Row[LoanStatus] |$Row[LoanStatus]|), and ");
				print ("($FromDate <= $CompareDate <= $ToDate)<br>\n");
			}

		// The Number of rows that will be displayed is counted,

		if (PaginateDisplay($Row, $Link, $UserLevel, $Row[DateInserted], 'Count'))
		{
			$MatchingRow[$TotalRows] = $x;
			//print ("Line ".__LINE__." Record match: \$MatchingRow[$TotalRows] = |$MatchingRow[$TotalRows]| \$ApplicantName = |$Row[ApplicantName]|<br>\n");
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
	
	// *-*-*-*-*-*-*-* Now let's display the records -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*

	$ThisRow = ($Page - 1) * $RowsPerPage;	//depending on which page we're now on will determine the first row to display




	if (!mysql_data_seek($Result, $MatchingRow[$ThisRow])) // reset the LoanInfoTable's pointer
	     die ("Cannot seek to row $ThisRow: " . mysql_error() . "\n");


	//print ("Line ".__LINE__." This page's first row = |$ThisRow|<br>\n");
	
	//print ("Line ".__LINE__." \$Link = |$Link| \$LoanQuery=|$LoanQuery|<br>\n");

	$x = 0;	// Set counter for the row number on the page to zero
	
	//print ("Line ".__LINE__." At row $ThisRow in table preparing to prosess screen row \$x=|$x| \$EndRow $EndRow \$RowsPerPage $RowsPerPage<br>\n");
	
	while (($Row=mysql_fetch_array($Result)) && ($x <= $EndRow) && ($x < $RowsPerPage))//print up to 16 rows
	{
		//print ("Line ".__LINE__." processing row \$x=|$x|<br>\n");
		
		//was list($month, $day, $year) = sscanf($DateInserted, "%02d/%02d/%02d");// reformat MM/DD/YY date
		list($year, $month, $day) = sscanf($DateInserted, "%02d/%02d/%02d");// reformat YY/MM/DD date

		$CompareDate = sprintf("%02d%02d%02d", $year, $month, $day);			// to YYMMDD

		//die("DateInserted $Row[DateInserted] -  YY $year MM $month DD $day - $CompareDate - $FromDate - $ToDate");

		// Display the row if it meets all criteria
		if (PaginateDisplay($Row, $Link, $UserLevel, $Row[DateInserted], 'Display'))
		{
			//print ("Line ".__LINE__." \$MatchingRow[$TotalRows] = |$MatchingRow[$TotalRows]| \$ApplicantName = |$Row[ApplicantName]|");
			$x++;
		}
	}

	if($Page > 1)  // This is the cookie value. If not on the first page
	{ 
        $PagePrev = $Page - 1; 
         
        print ("</table><br>&nbsp;&nbsp;<FONT color=red>«</FONT><font face='Verdana' strong size='2' color='#000099'><a href=\"$PHP_SELF?Page=$PagePrev\"><b> Previous</b></a>&nbsp;&nbsp;</font>"); 
    }
    else  // if on first page...
    { 
        print ("</table><br>&nbsp;&nbsp;<FONT color=red>«</FONT><font face='Verdana' strong size='2' color='#000099'> Previous&nbsp;&nbsp;</font>"); //simulate the Previous page HyperLink
    } 

    //print ("Line ".__LINE__." \$TotalPages=$TotalPages ");
    
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

	print ("</form>");
	mysql_close($Link);

?>
</body>
</html>
