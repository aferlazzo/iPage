<?php
require ("../include/authenticate.php");
require ("../include/SetCookies.php");
SetCookies();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Daily Progress Report handler</title>
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
/* -------------------------------------------				*/
/*															*/
/*	Gets the name associated with a ss# from the database	*/
/*															*/
/*--------------------------------------------				*/
function GetBorrower($MySSN, $Link, $UserLevel)
{
	$Host="localhost";
	$User="lightnin_Tony";
	$Password="ipowerwe";
	$DBname="lightnin_LoanApps";
	$TableName="ApplicantInfo";

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

	//die ("User Level $UserLevel, Name $Name ($Record[ApplicantName], $Record[ApplicantFirstName], $Record[ApplicantLastName])");
	return($Name);
}




/* -------------------------------------------	*/
/*												*/
/*	Gets the loan status associated with a ss# 	*/
/*	from the database							*/
/*												*/
/* -------------------------------------------	*/
function GetLoanStatus($MySSN, $Link)
{
	$Host="localhost";
	//$User="lightnin_Tony";
	//$Password="ipowerwe";
	$DBname="lightnin_LoanApps";
	$TableName="ApplicantInfo";
	global $LoanStatusResult;

	$TempField = ereg_replace("[^[:digit:]]", "", $MySSN);

	$Query = "SELECT LoanStatus from $TableName where SSN = $TempField";
	/*print ("In GetLoanStatus () Query is $Query<br>\n");*/

	$LoanStatusResult=mysql_query($Query, $Link); // look for the match


	if (!mysql_query ($Query, $Link)) // check the LoanStatusResults of the query
	{
		print ("Line ".__LINE__." Error-->Link |$Link|<br>\n");

		print ("<br><center><font face='Verdana' size='5' color='#000099'><strong>Warning!</strong></font><br><br>");
		print ("<font face='Verdana' size='2' color='#000099'>ApplicantTable Record Not Found.<br><br>\n");
		print ("Social Security Number<font face='Verdana' size='3' color='#000099'>'$MySSN' </font>");
		print ("<font face='Verdana' size='2' color='#000099'>was the passed Social Security Number.</font><br>\n");

		echo mysql_errno() . ": " . mysql_error(). "\n";
		mysql_close($Link);
		die ("Error in GetLoanStatus() line ".__LINE__);
	}

	$Record=mysql_fetch_array($LoanStatusResult);	// fetch the matching row in the ApplicantInfo table

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



/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
/*																													*/
/*	SelectRecords: Takes the existing $Link from the mysql_connect() function, which points to the database on the	*/
/*	server andthe $TableName that specifies the particular table in the database to retrieve matching records in 	*/
/*	the order dictated by the $SortColumn variable.																	*/
/*																													*/
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/

function SelectRecords ($SortColumn, $DBname, $TableName, $Link)
{
	$Table2Name="ApplicantInfo";

	switch ($SortColumn)
	{
		case "Date":
			$Query = "SELECT * from $TableName, $Table2Name where $TableName.SSN=$Table2Name.SSN order by ReportDate DESC, id DESC"; //descending order-newest first
			break;

		case "Comments":
			$Query = "SELECT * from $TableName, $Table2Name where $TableName.SSN=$Table2Name.SSN order by Comments";
			break;

		case "Point Status":
			$Query = "SELECT * from $TableName, $Table2Name where $TableName.SSN=$Table2Name.SSN order by PointStatus";
			break;

		case "SSN":
			$Query = "SELECT * from $TableName, $Table2Name where $TableName.SSN=$Table2Name.SSN order by $TableName.SSN, ReportDate DESC";   // This is the default
			break;

		default:
		//case "ApplicantName":	// If sort of list is by ApplicantName,  we must read/join 2 different tables
			$Query = "SELECT * from $TableName, $Table2Name where $TableName.SSN=$Table2Name.SSN order by ApplicantLastName ASC, ReportDate DESC, id DESC";
			$SortColumn="ApplicantName";
			break;	}

	 //print ("Inside SelectRecords (), line ".__LINE__." Query:|$Query|<br>\n");
	 //print ("Comared to 	SELECT * from WorkingStatusInfo, ApplicantInfo where WorkingStatusInfo.SSN=ApplicantInfo.SSN order by ReportDate DESC<br>\n");


    $Result=mysql_db_query($DBname, $Query, $Link);

	return($Result);
}


// -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*	//
//																		//
//	DisplayFormattedRow: Displays the line				//
//																		//
// -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*	//



function DisplayFormattedRow($Row, $Link, $UserLevel, $RowOnPage)
{
	global $SortColumn;
	
	/* Display records that are in the table */

	//print ("Line ".__LINE__." \$RowOnPage $RowOnPage<br>\n");
	print ("<tr>\n");




	/* -*-*-*-*-* Edit An Existing Record column -*-*-*-*-*-*-*-*-*- */

	$ApplicantName = GetBorrower($Row[SSN], $Link, $UserLevel);

	// die ("ApplicantName=:$ApplicantName:<br>\n");

	$yyy=$ApplicantName;
	$xxx=strlen($Row[Comments]);
	$ccc=urlencode($Row[Comments]);

	print ("<td colspan='3' bgcolor='#CCCCCC' align='center'>");
	print ("<form name='EditRecord' action='WorkingStatusMaintenance.php' method='post'>");

	print ("<select size='1' name='RequestType' onChange='submit();'>");

	switch ($RequestType)
	{
		case "Update":
			print ("<option value='Insert'>New</option>");
			print ("<option selected value='Update'>Update</option>");
			print ("<option value='Delete'>Delete</option>");

			break;

		case "Delete":
			print ("<option value='Insert'>New</option>");
			print ("<option value='Update'>Update</option>");
			print ("<option selected value='Delete'>Delete</option>");
			break;

		case "Insert":
			print ("<option selected value='Insert'>New</option>");
			print ("<option value='Update'>Update</option>");
			print ("<option value='Delete'>Delete</option>");
			break;

		default:
			print ("<option selected value='Select'>Select</option>");
			print ("<option value='Insert'>New</option>");
			print ("<option value='Update'>Update</option>");
			print ("<option value='Delete'>Delete</option>");
			break;
	}

	print ("</select><input type='hidden' name=SSN value='$Row[SSN]'>");
	print ("<input type='hidden' name=id value='$Row[id]'>");
	print ("<input type='hidden' name=ReportDate value='$Row[ReportDate]'>");
	print ("<input type='hidden' name=Comments value='$ccc'>");
	print ("<input type='hidden' name=ApplicantName value='$yyy'>");
	print ("<input type='hidden' name=PointStatus value='$Row[PointStatus]'>");
	print ("<font face='Verdana' size='1' color='#000099'></font></td></form>");

	/* -*-*-*-*-*-*-*-*- Print the Point Status -*-*-*-*-*-*-*-*-*-*-*-*- */

	if($SortColumn == 'Point Status')
		print ("<td align=center bgcolor='#EBF5F5' valign=middle>");
	else
		print ("<td align=center valign=middle>");
		
	
	if ($Row[PointStatus] != null)
	  print ("<font face='Verdana' size='2' color='#000099'>"
		.$Row[PointStatus]."</font></td>");
	else
	  print ("&nbsp;</td>");

	/* -*-*-*-*-*-*-*-*- Print the Applicant Name -*-*-*-*-*-*-*-*-*-*-*-*- */

	if($SortColumn == 'ApplicantName')
		print ("<td align=left bgcolor='#EBF5F5' valign=middle>");
	else
		print ("<td align=left valign=middle>");
		
	print ("<font face='Verdana' size='2' color='#000099'>");
	print ("$ApplicantName</font></td>");

	/* -*-*-*-*-*-*-*-*- Print the Report Date -*-*-*-*-*-*-*-*-*-*-*-*- */

	//$Row[ReportDate] = urlencode($Row[ReportDate]);

	/* Format the $Row[ReportDate] */


	if ($Row[ReportDate] == "")  // Don't print ReportDates that equal null
	{
		$Row[ReportDate]='&nbsp;';
	}
	else
	{
		//print ("**** $Row[ReportDate] ");
		list($year, $month, $day) = sscanf($Row[ReportDate], "%02d/%02d/%02d");// reformat YY/MM/DD date
		$Row[ReportDate] = sprintf("%02d/%02d/%02d", $month, $day, $year);			// to MM/DD/YY
		//print ("$Row[ReportDate] ****<br />");
	}	

	if($SortColumn == 'Date')
		print ("<td align=center bgcolor='#EBF5F5' valign=middle>");
	else
		print ("<td align=center valign=middle>");
		
	print ("<font face='Verdana' size='2' color='#000099'>"
				.urldecode($Row[ReportDate])."</font></td>");
/*
*****		print ("<td align=left valign=middle><font face='Verdana' size='2' color='#000099'>$Row[id]</font></td>");
*/

	/* -*-*-*-*-*-*-*-*- Print the Comments -*-*-*-*-*-*-*-*-*-*-*-*- */

	if ($Row[Comments] == "")  // Don't print Comments that equal null
	{
		$Row[Comments]='&nbsp;';
	}

	if($SortColumn == 'Comments')
		print ("<td align=left colspan='5' bgcolor='#EBF5F5' valign=middle>");
	else
		print ("<td align=left colspan='5' valign=middle>");
		
	print ("<font face='Verdana' size='2' color='#000099'>");
	
	if (strlen($Row[Comments]) > 240)
	{
		//limit the comment size
		$CommentsStart = ShortComment($Row[Comments]);
		print ("$CommentsStart");
	}
	else
		print ("$Row[Comments]");
	
	//$Options="width=860,height=515,scrollbars=yes,location=yes,resizable=yes";
	$Options="width=860,height=515,resizable=yes";
	

	
	$URLencodedComments=urlencode($Row[Comments]);
	
	// concatenate the URL?parameters string for a "comments" window
	$Page="https://host373.ipowerweb.com/~lightnin/LAPS/Comments.php?Comments&SSN=$Row[SSN]&id=$Row[id]&".$URLencodedComments;	

	if (strlen($Row[Comments]) > 240)
	{
		print ("...&nbsp;&nbsp;&nbsp;&nbsp;");
		print ("<a href='onclick=\"CommentsWindow = open('$Page', 'Comments', '$Options');CommentsWindow.window.focus();\">more</a> »");	
	}
	
	
	print ("</font></td></tr>");
}

// ---------------
//
// break at end of word not in the middle.
//
// ---------------

function ShortComment($Comments)
{
	$Comments = substr($Comments, 0, 240);
	//print ("|$Comments|<br>\n");
	$x = 241;
	
	while 	 ((($Comments[$x] != " ") 
			&& ($Comments[$x] != ".") 
			&& ($Comments[$x] != ",") 
			&& ($Comments[$x] != "?") 
			&& ($x > 0)))
	{
		//print($Comments[$x]);
		$x--;
	}

	return(substr($Comments, 0, $x));
}
			
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//
//																													//
// PaginateDisplay: We need to run through the database twice.														//
//					The first time is simply to count the number of records that will actually be displayed.		//
//					The second time is to actually display the records that match the previously chosen criteria.	//
//																													//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//

function PaginateDisplay($Row, $Link, $UserLevel, $ReportDate, $CountOrDisplay, $RowOnPage)
{
	global $FromDate;	// These are cookie values
	global $ToDate;
	global $SearchTerm;
	global $SavedFilter;
	
	$Count = false;
	
	$ApplicantName = GetBorrower($Row[SSN], $Link, $UserLevel);

	// was list($month, $day, $year) = sscanf($Row[ReportDate], "%02d/%02d/%02d");// reformat MM/DD/YY date
	list($year, $month, $day) = sscanf($Row[ReportDate], "%02d/%02d/%02d");// reformat MM/DD/YY date
	$CompareDate = sprintf("%02d%02d%02d", $year, $month, $day);			// to YYMMDD

	//die("ReportDate $Row[ReportDate] -  YY $year MM $month DD $day - $CompareDate - $FromDate - $ToDate");

	if (($CompareDate >= $FromDate) && ($CompareDate <= $ToDate))//verify the report date falls within the range
	{
		$Row[LoanStatus] = GetLoanStatus($Row[SSN], $Link);

		//print ("On Line ".__LINE__." SavedFilter = |$SavedFilter|   LoanStatus =|$Row[LoanStatus]| SSN =|$Row[SSN]|<br>\n");

		if ($SearchTerm != "")
		{	// look through the xxx and associated ApplicantName columns in the row for a match of the search term
			
			if (stristr($Row[Comments], $SearchTerm))
			{
				//print ("Line ".__LINE__." \$SearchTerm '$SearchTerm' found in Comments<br>\n");
				$Count = true;
				if ($CountOrDisplay == 'Display')
					DisplayFormattedRow($Row, $Link, $UserLevel, $RowOnPage);
			}

			elseif (stristr($Row[PointStatus], $SearchTerm))
			{
				//print ("Line ".__LINE__." \$SearchTerm '$SearchTerm' found in PointStatus<br>\n");
				$Count = true;
				if ($CountOrDisplay == 'Display')
					DisplayFormattedRow($Row, $Link, $UserLevel, $RowOnPage);
			}

			elseif (stristr($ApplicantName, $SearchTerm))
			{
				//print ("Line ".__LINE__." \$SearchTerm '$SearchTerm' found in ApplicantName \$Row[Comments] |$Row[Comments]|<br>\n");
				$Count = true;
				if ($CountOrDisplay == 'Display')		
					DisplayFormattedRow($Row, $Link, $UserLevel, $RowOnPage);
			}
		}
		else
		{
			if (($SavedFilter == "All") || ($SavedFilter == $Row[LoanStatus]))//LoanStatus is part of ApplicantInfo table
			{
				//print ("Line ".__LINE__." Display Record<br>\n");
				$Count = true;
				if ($CountOrDisplay == 'Display')	
					DisplayFormattedRow($Row, $Link, $UserLevel, $RowOnPage);
			}
		}
	}
	
	return ($Count);
}



// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//
//																									//
//	WorkingStatusList: This page retrieves and displays the data in the database table 				//
//	'WorkingStatusInfo'																				//
//																									//
//																									//
//																									//
//																									//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//

// Always remember when you do a print ("$variable...); the variable's value will be substituted.
// When you use a single quote, print ('$variable...); the value WILL NOT be substituted.

/* variables to access Database */

	$Host="localhost";
	$DBname="lightnin_LoanApps";
	$TableName="WorkingStatusInfo";

	$Debug = false;

	//Declare time period reporting variables

	$FromDate;
	$FromMonthName;
	$FromMonth;
	$FromDay;
	$FromYear;
	
	
	$DateRange;
//	$DateRange = $_POST['DateRange']; // we do this because a change to the DateRange causes the form to restart the page
	
	
	$ToDate;
	$ToMonthName;
	$ToMonth;
	$ToDay;
	$ToYear;

	/* first, connect to the MySQL DBMS on this server */
	$Link=mysql_connect ($Host, $User, $Password) or die ('I cannot connect to the DBMS because: '.mysql_error());

	print("<script type='text/javascript' language='Javascript'>AtStartCookies();</script>");

	//print ("On line ".__LINE__." CommentLimit $CommentLimit SavedFilter $SavedFilter, SortColumn ");
	//print ("$SortColumn, SearchTerm $SearchTerm<br>\n");

	ComputeReportingPeriod();


	/* variables to access Database */

	$Result = SelectRecords($SortColumn, $DBname, $TableName, $Link); /* Set the order of the records retrieved according to $SortColumn */


	/* create a screen table for displaying the data */

	/* -*-*-*-*-*-*-*-*-*-*-*-*-*- Print the Title and Header rows -*-*-*-*-*-*-*-*-*-*-*--*-*-*-*- */

	//debug table by changing bordercolor='#CCCCCC'
	print ("<table border='1' bordercolor='#000099' cellpadding='4' cellspacing='0' align='center'>");
	print ("<tr align='center' valign='top'>");
	print ("<form action='ApplicantMaster.php'>");
	print ("<td align='center' width='3%' valign='middle' colspan='3' bgcolor='#003399'>");

	print ("<p style='text-align: center;'><input class='Submit' type='submit' value='LAPS Home' style='color:#fff;'></p></td></form>");

	print ("<td align='center' width='40%' valign='middle' colspan='5' bgcolor='#003399'>"); // bgcolor='#003399'
	//print ("<font face='Verdana' size='5' color='#FFFFFF'><strong>Lightning Mortgage&nbsp;&nbsp;</strong></font></td>");
    print ("<a class='Logo' href='http://www.lightning-mortgage.com/index.php'>");
    print ("<img border='0' src='../images/Lightning-Mortgage.jpg'></a></td>");

	//print ("<td colspan='3' align='right' width='50%' valign='middle' bgcolor='#003399'>");
	print ("<td align='right' width='55%' valign='middle' bgcolor='#003399'>");
	DisplayReportingPeriodRangeOptions();
	print ("</td></tr>");
	print ("<tr align=center valign=top><td colspan='11'>");
	
	// Navigation Bar line

	print ("<table border='0' bordercolor='#CCCCCC'cellpadding='3' cellspacing='0' align='center'>");

	print ("<form name='Navigation' action='$PHP_SELF' method='post'>");
	print ("<td align='middle' width='12%' valign='middle'>\n");
	print ("&nbsp;&nbsp;<input type='submit' value='Clear' onclick='window.document.Navigation.SearchTerm.value=\"\"'>");

	if ($SearchTerm != "")
		print ("&nbsp;&nbsp;<input type='text' style='background: #FFFF00' name='SearchTerm' value='$SearchTerm'size='20'>&nbsp;&nbsp;");
	else
		print ("&nbsp;&nbsp;<input type='text' name='SearchTerm' value='$SearchTerm' size='20'>&nbsp;&nbsp;");

	print ("<input type='submit' name'Search' value='Search'></td>");

	print ("<td align='center' width='45%' valign='middle'>\n");
	
	print ("<table border='1' bordercolor='#000099' cellpadding='2' cellspacing='0'>");
	print ("<td style='background:#000099;'><span style='font:small bolder Verdana,Geneva,Arial,Helvetica,sans-serif;color:yellow;'>Daily Status</span></td>");
	print ("<td bgcolor='#9C31CE'><a class='Top' href='./ApplicantList.php'>Applicant</a></td>");
	print ("<td bgcolor='#397352'><a class='Top' href='./ContactList.php'>Contact</a></td>");
	print ("<td bgcolor='#CE6300'><a class='Top' href='./LoanList.php'>Loan</a></td>");
	print ("<td bgcolor='#9C9C31'><a class='Top' href='./EmploymentList.php'>Employment</a></td>");
	print ("</table></td>");

	print ("<td align='right' width='15%' valign='middle'><font face='Verdana' size='2' color='#000099'>");
	print ("Filter By Status&nbsp;</font></td>");

	print ("<td align='Left' valign='middle'><font face='Verdana' size='2' color='#000099'>&nbsp;");
	FilterStatus();
	print ("</font></td>");

	print ("<td align='right' width='5%' valign='middle'><font face='Verdana' size='2' color='#000099'>");
	print ("Comments/<br>\nBorrower&nbsp;</td>");

	print ("<td align='left' valign='middle'>\n");
	print ("<select size='1' name='CommentLimit' value='$CommentLimit' onChange='submit();'>");

	if ($CommentLimit == 'All')
		print ("<option selected value='All'>All</option>");
	else
		print ("<option value='All'>All</option>");

	if ($CommentLimit == '01')
		print ("<option selected value='01' style='background: #FFFF00'> 1</option>");
	else
		print ("<option value='01'> 1</option>");

	if ($CommentLimit == '02')
		print ("<option selected value='02' style='background: #FFFF00'> 2</option>");
	else
		print ("<option value='02'> 2</option>");

	if ($CommentLimit == '03')
		print ("<option selected value='03' style='background: #FFFF00'> 3</option>");
	else
		print ("<option value='03'> 3</option>");

	if ($CommentLimit == '04')
		print ("<option selected value='04' style='background: #FFFF00'> 4</option>");
	else
		print ("<option value='04'> 4</option>");

	if ($CommentLimit == '05')
		print ("<option selected value='05' style='background: #FFFF00'> 5</option>");
	else
		print ("<option value='05'> 5</option>");

	if ($CommentLimit == '06')
		print ("<option selected value='06' style='background: #FFFF00'> 6</option>");
	else
		print ("<option value='06'> 6</option>");

	print ("/select>");

	print ("&nbsp;&nbsp;</font></td>");

	print ("</form></tr>");
	print ("</table></td></tr>\n");

/*

	print ("<tr align=center valign=top>");

	//print ("<div><table border='1' bordercolor='#CCCCCC' cellpadding='3' cellspacing='0' align='center'><tr>");
	//print ("<td align=center valign=middle><font face='Verdana' size='3' color='#000099'>");
	//print ("<strong>Daily Progress Report</strong></font></td>");

	print ("<td align=center valign=middle colspan='6'><font face='Verdana' size='3' color='#000099'>");
	print ("<strong>Daily Progress Report</strong></font></td>");
*/
	/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
	/*																									*/
	/* Neat trick for the pulldown menu: When an item changes, simulate the submit button being pressed	*/
	/* the form action reloads this page. The method=get displays the passed Filter field and the chosen*/
	/* parameter on the command line on reload.	The method=post doesn't displays the passed	variables.	*/
	/*																									*/
	/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
/*

	print ("<td align='right' width='10%' valign='middle'><font face='Verdana' size='2' color='#000099'>Filter By Status&nbsp;</font></td>");

	print ("<form name='FilterIt' action='$PHP_SELF' method='post'>");
	print ("<td align='Left' valign='middle'><font face='Verdana' size='2' color='#000099'>&nbsp;");
	FilterStatus();

	print ("</font></td><td align='middle' valign='middle'>\n");
	print ("<input type='text' name='SearchTerm' value='$SearchTerm'size='20'>&nbsp;&nbsp;");
	//print ("<input type='hidden' name='SortColumn' value='$SortColumn'>");
	print ("<input type='submit' name'Search' value='Search'></td>");

	print ("<td align='right' valign='middle'><font face='Verdana' size='2' color='#000099'>");
	print ("Comments/<br>\nBorrower&nbsp;</td>");

	if (isset($_POST[CommentLimit]))
		$CommentLimit = $_POST[CommentLimit];

	print ("<td align='middle' valign='middle'>\n");
	print ("<select size='1' name='CommentLimit' value='$CommentLimit' onChange='submit();'>");

	if ($CommentLimit == 'All')
		print ("<option selected value='All'>All</option>");
	else
		print ("<option value='All'>All</option>");

	if ($CommentLimit == '01')
		print ("<option selected value='01'> 1</option>");
	else
		print ("<option value='01'> 1</option>");

	if ($CommentLimit == '02')
		print ("<option selected value='02'> 2</option>");
	else
		print ("<option value='02'> 2</option>");

	if ($CommentLimit == '03')
		print ("<option selected value='03'> 3</option>");
	else
		print ("<option value='03'> 3</option>");

	if ($CommentLimit == '04')
		print ("<option selected value='04'> 4</option>");
	else
		print ("<option value='04'> 4</option>");

	if ($CommentLimit == '05')
		print ("<option selected value='05'> 5</option>");
	else
		print ("<option value='05'> 5</option>");

	if ($CommentLimit == '06')
		print ("<option selected value='06'> 6</option>");
	else
		print ("<option value='06'> 6</option>");

	print ("/select>");

	print ("&nbsp;&nbsp;</font></td>");

	print ("</form></tr>");
	//print ("</table></div></tr>"); // end of row
*/

	/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
	/*																										*/
	/* 	We are planning to pass the current Loan Status (when the value of the variable is created below).	*/
	/*	The reason we are going to do this is to maintain a consistent user experience. We want the records	*/
	/*	listed to have the same record filter enabled as it presently is without the user having to choose	*/
	/*	the BestCallNumber???? again.																		*/
	/*																										*/
	/*	When control passes back to this page (from WorkingStatusUpdate or WorkingStatusMaintenance) we 	*/
	/*	will want to use the same filtering criteria for displaying the list of table entries that we are	*/
	/*	presently using to display records for the user. We use a <form> to pass the this filter variable	*/
	/*	to WorkingStatusMaintenace.																			*/
	/*																										*/
	/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/

	$xxx=$SavedFilter;
	// print ("On line ".__LINE__." xxx=$xxx");

	print ("<tr align=center valign=middle>");
	print ("<form action='$PHP_SELF' method='post'>");
	print ("<input type='hidden' name=RequestType value='Insert'>");

	/* we'll put the "Add New" button in this cell */

	$Today=date("y/m/d");
	print ("<input type='hidden' name='ReportDate' value='$Today'>");

	print ("<td align=center valign=top colspan='3' bgcolor='#CCCCCC'><font face='Verdana' size='2' color='#000099'>");
	print ("<input type='submit' name='submit' value='Add New'");
	print ("title='Click to Add a New Record'>");
	print ("</td></form>");

	/* --------------- Print the Headings row in the table using white characters on a blue background.-------------*/

	/* Header row has "sort by" column headers. When you click on a header name, the database is reread and redisplayed */
	/* Set the order of the records retrieved according to $SortColumn */

	$Result = SelectRecords($SortColumn, $DBname, $TableName, $Link);



	/* * * * Print the Heading, Sort on Point Status * * * */

	if ($SortColumn == 'Point Status')
		print ("<td align=center valign='middle' bgcolor='#003399'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center valign='middle' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");

	
	print ("<form action='$PHP_SELF' method='post'>");
	print ("<input type='submit' name='SortColumn' value='Point Status'");	/* Point Status button */
	print (" title='Click to sort on the Point Status Column'>");
	print ("<input type='hidden' name='SavedFilter' value='$xxx'>");
	print ("</td></form>");
	
	/* * * * Print the Heading Applicant Name  * * * */

if ($SortColumn == 'ApplicantName')
		print ("<td align=center valign='middle' bgcolor='#003399'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center valign='middle' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	
	
	print ("<form action='$PHP_SELF' method='post'>");
	print ("<input type='submit' name='SortColumn' value='ApplicantName'");	/* ApplicantName button */
	print (" title='Click to sort on Applicant Name Column'>");
	print ("<input type='hidden' name='SavedFilter' value='$xxx'>");
	print ("</td></form>");

	/* * * * Print the Heading, Sort on Report Date  * * * */

if ($SortColumn == 'Date')
		print ("<td align=center bgcolor='#003399'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");

	print ("<form action='$PHP_SELF' method='post'>");
	print ("<input type='submit' name='SortColumn' value='Date'");	/* ReportDate button */
	print (" title='Click to sort on ReportDate Column'>");
	print ("<input type='hidden' name='SavedFilter' value='$xxx'>");
	print ("</td></form>");
/*
***	print ("<td align=center height='10' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");
***	print ("<b>ID</b></font></a></td>");
*/

	/* * * * Print the Heading, Sort on Comments * * * */

	if ($SortColumn == 'Comments')
		print ("<td align=center colspan='5' bgcolor='#003399'><font face='Verdana' strong size='2' ");
	else
		print ("<td align=center colspan='5' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' ");

	print ("color='#FFFFFF'><form action='$PHP_SELF' method='post'>");
	print ("<input type='submit' name='SortColumn' value='Comments'");	/* Comments button */
	print (" title='Click to sort on Comments Column'>");
	print ("<input type='hidden' name='SavedFilter' value='$xxx'>");
	print ("</td></form>");

	print ("</tr>"); // end of row

	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//
	//																											//
	// Now fetch the the WorkingStatus data from the database and display records with a matching Loan Status	//
	//																											//
	// Sometimes we want to limit the number of comments we display for a particular borrower. The $CommentLimit//
	// cookie is used to do this.																				//
	// Sometimes we want to search for specific text. The $SearchTerm cookie is used to do this.				//
	//																											//
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//

	//$SearchTerm = trim($_GET[SearchTerm]);

	//print("\nSearching for: $SearchTerm\n");

	// Let's process the Loan Table's records that have been sorted according to the $ColumnSort value
	// First we want to count the number of rows that actually meet the other filter and Search criteria
	
	$TotalRows = 0;
	$MatchingRow = array_fill(0, 5000, 0); //Create the array to handle tables with up to 5000 rows, zero-fill it
	//
	//	When a match in the filtering criteria is found, put the matching 
	//
	//
	
	
	
	$LastApplicantName="";
	$x = 0; //matching name count of comments
	$i = 0; //row number index, just counts the records
	
	if ((empty($_GET[CommentsOfApplicantPrinted])) && (empty($_POST[CommentsOfApplicantPrinted])))
		$CommentsOfApplicantPrinted = 0;
	
	// The challenge is: All rows in the table will not be printed. So we must determine which rows should
	// be printed so we can later jump to those rows as we later page through the Table.
	
	while ($Row=mysql_fetch_array($Result)) //fetch each record in the table
	{
		//print ("Line ".__LINE__." $TableName.SSN=|$Row[SSN]| \n");
		
		$ApplicantName = GetBorrower($Row[SSN], $Link, $UserLevel);

		//was list($month, $day, $year) = sscanf($Row[ReportDate], "%02d/%02d/%02d");// reformat MM/DD/YY date
		list($year, $month, $day) = sscanf($Row[ReportDate], "%02d/%02d/%02d");// reformat YY/MM/DD date
		$CompareDate = sprintf("%02d%02d%02d", $year, $month, $day);			// to YYMMDD

		if ($LastApplicantName != $Row[ApplicantName]) //each time Applicant Name changes reset the counter $x
		{
			$x=0;
			$LastApplicantName = $Row[ApplicantName];
		}

		if (($x < $CommentLimit) || ($CommentLimit == "All")) //If the CommentLimit has NOT been exceeded
		{	
			//print("ReportDate $Row[ReportDate] -  YY $year MM $month DD $day - $CompareDate - $FromDate - $ToDate<br>\n");

			// The Number of rows that will be displayed is counted,
 	
 			//print ("Line ".__LINE__." \$Row[ApplicantName] $Row[ApplicantName] \$CommentsOfApplicantPrinted $CommentsOfApplicantPrinted, \$CommentLimit $CommentLimit<br>\n");

			if (PaginateDisplay($Row, $Link, $UserLevel, $Row[ReportDate], 'Count', 0)) //returns 'TRUE' if record meets all the search criteria
			{
				$x++; //add 1 to the comment count
				$MatchingRow[$TotalRows] = $i;
				//print ("Line ".__LINE__." \$MatchingRow[$TotalRows] = |$MatchingRow[$TotalRows]| \$ApplicantName = |$ApplicantName|<br>\n");
				$TotalRows++;
			}
		}
		
		$i++;
	}
	
	if (TotalRows > 5000)
		die("Error: LoanList line ".__LINE__." Matching Row array exceeds 5,000 records. Must increase table size.");
	 	
	// TotalRows == Total. Now determine if we have called ourselves (i.e. was the Page variable passed?)
	
	if(empty($Page))  //not passed, so set $Page variable to 1.
    	$Page = 1; 
    	
    //print ("Line ".__LINE__." Total matches found = $TotalRows<br>\n");
 
	// *-*-*-*-*-* Compute the display maximums for rows and pages variables *-*-*-*-*-*

	if ($TotalRows > 0)
		$TotalPages = round($TotalRows / 9); //lets try 16 rows per page
	else
	{
		$TotalPages	= 1;		//if no rows found
		print ("<tr><br><br><H1>No Matching Records</H1></tr>\n");
	}
		
	//print ("Line ".__LINE__." \$TotalRows = $TotalRows. At 10 lines/page there are $TotalPages pages. ");

	$EndRow = 9; // at minimum, this is the rows per page

	
	if ($TotalRows < $RowsPerPage)  //if the number of rows do not warrant at least second page...
	{
		$TotalPages 	= 1;
		$StartRow		= 0;
		$EndRow			= $TotalRows - 1;		//Compute the last row for the one page & query
		
		print ("Line ".__LINE__." Screen $TotalPages (Single screen), has rows $StartRow - $EndRow; ");
	}
	else	//Multiple pages 
	{
		for ($i=0; $i < $TotalPages; $i++)
		{
			$CurrentPage    = $i + 1;
			$StartRow 		= $i * $RowsPerPage;
			
			if ($CurrentPage < $TotalPages)
				$EndRow 		= $i * $RowsPerPage + ($RowsPerPage - 1);	//Compute the last row for the page
			else
				$EndRow 		= $TotalRows - 1; 	//Compute the last row for the query
			
			//print (Line ".__LINE__." Page $CurrentPage, will display rows $StartRow - $EndRow; ");
		}
	}
	
	// *-*-*-*-*-*-*-* Now let's display the records -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*
	$RowsPerPage = 9;
	
	$ThisRow = ($Page - 1) * $RowsPerPage;	//depending on which page we're now on will determine the first row to display

	if (!mysql_data_seek($Result, $MatchingRow[$ThisRow])) // reset the LoanInfoTable's pointer
	     die ("Cannot seek to row $ThisRow: " . mysql_error() . "\n");

	

	//print ("On Line ".__LINE__." This page's first row = |$ThisRow|<br>\n");
	
	//print ("Line ".__LINE__." \$Link = |$Link| \$LoanQuery=|$LoanQuery|<br>\n");
	
	if (empty($CommentsOfApplicantPrinted)) // if there weren't any comments of this applicant printed on a previous page
		$CommentsOfApplicantPrinted = 0; // counts the number of comments per Applicant to be sure the limit isn't exceeded

	if (empty($LastApplicantNamePrinted)) // if there wasn't a name of the last applicant printed on a previous page
		$LastApplicantNamePrinted = ""; // blank of variable
		
	$y = 0; // counts the number of rows per page that have been printed
	$i = $ThisRow;	// Set counter for the row number on the page to first row on the page
	//$i is now used to count the records (rows) printed
	
	//print ("Line ".__LINE__." \$i=|$i| \$EndRow |$EndRow| \$RowsPerPage |$RowsPerPage|<br>\n");
	
	while (($Row=mysql_fetch_array($Result)) && ($i <= $EndRow) && ($y < $RowsPerPage))//print up to 9 rows
	{
		//print ("Line ".__LINE__." processing row \$i=|$i|<br>\n");
		
		$ApplicantName = GetBorrower($Row[SSN], $Link, $UserLevel);

		//was list($month, $day, $year) = sscanf($Row[ReportDate], "%02d/%02d/%02d");// reformat MM/DD/YY date
		list($year, $month, $day) = sscanf($Row[ReportDate], "%02d/%02d/%02d");// reformat YY/MM/DD date
		
		$CompareDate = sprintf("%02d%02d%02d", $year, $month, $day);			// to YYMMDD

		if ($LastApplicantNamePrinted != $ApplicantName) //each time Applicant Name changes reset the counter $CommentsOfApplicantPrinted
		{
			//print ("Line ".__LINE__." Name changed \$LastApplicantNamePrinted: $LastApplicantNamePrinted, \$ApplicantName: $ApplicantName<br>\n");
			$CommentsOfApplicantPrinted=0;
			$LastApplicantNamePrinted = $ApplicantName;
		}

		//die("ReportDate $Row[ReportDate] -  YY $year MM $month DD $day - $CompareDate - $FromDate - $ToDate");
		
		//print ("Line ".__LINE__." \$ApplicantName $ApplicantName \$CommentsOfApplicantPrinted $CommentsOfApplicantPrinted, \$CommentLimit $CommentLimit<br>\n");

		if (($CommentsOfApplicantPrinted < $CommentLimit) || ($CommentLimit == "All")) //If the CommentLimit has NOT been exceeded
		{
			// Display the row if it meets all criteria
			if (PaginateDisplay($Row, $Link, $UserLevel, $Row[ReportDate], 'Display', $y))
			{
				//print ("Line ".__LINE__." \$MatchingRow[$i] = |$MatchingRow[$i]| \$ApplicantName = |$ApplicantName| \$Row[Comments] + |$Row[Comments]|<br>\n");
				$i++;
				$CommentsOfApplicantPrinted++;  //add 1 to the comment count
				$y++;  //add 1 to the number of records that have been printed on the page
			}
		}
	}

	if($Page > 1)
	{ 
        $PagePrev = $Page - 1; 
         
        print ("</table><br>&nbsp;&nbsp;<FONT color=red>«</FONT><a href=\"$PHP_SELF?Page=$PagePrev&LastApplicantNamePrinted=$LastApplicantNamePrinted&CommentsOfApplicantPrinted=$CommentsOfApplicantPrinted\"><b>Previous</b></a>&nbsp;&nbsp;"); 
    }
    else  // if at first page...
    { 
        print ("</table><br>&nbsp;&nbsp;<FONT color=red>«</FONT>Previous&nbsp;&nbsp;"); //simulate the Previous page HyperLink
    } 

     
    for($i = 1; $i < $TotalPages; $i++)
    { 
        if($i == $Page)
        { 
            print ("<b>$i</b>&nbsp;"); //don't create a hyperlink for the current page
        }
        else
        { 
            print ("<a href=\"$PHP_SELF?Page=$i&LastApplicantNamePrinted=$LastApplicantNamePrinted&CommentsOfApplicantPrinted=$CommentsOfApplicantPrinted\">$i</a>&nbsp;&nbsp;"); 
        } 
    } 
    
    //if(($TotalRows % $TotalPages) != 0)  //if the number of rows are not evenly divisible by the number of screens
    //if(($TotalRows % $RowsPerPage) != 0)  //if the number of rows are not evenly divisible by the number of RowsPerPage
    { 
        if($Page == $TotalPages) //if current page = Total pages
        { 
            print ($i."&nbsp;"); // we are on the last page, so just print the page number, don't make it a hyperlink
        }
        else
        { 
            print ("<a href=\"$PHP_SELF?Page=$i&LastApplicantNamePrinted=$LastApplicantNamePrinted&CommentsOfApplicantPrinted=$CommentsOfApplicantPrinted\">$i</a>&nbsp;&nbsp;"); 
        } 
    } 

    if(($TotalRows - ($RowsPerPage * $Page)) > 0)  //if not on the last page
    { 
        $Pagenext = $Page + 1; 
          
        print ("  <a href=\"$PHP_SELF?Page=$Pagenext&LastApplicantNamePrinted=$LastApplicantNamePrinted&CommentsOfApplicantPrinted=$CommentsOfApplicantPrinted\"><b>Next</b></a> <FONT color=red>»</FONT>"); //create a link to the next page
    }
    else
    { 
        print ("  Next <FONT color=red>»</FONT>"); //simulate the hyperlink to the non-existent next page
    }     

	mysql_close($Link);

?>
</body>
</html>
