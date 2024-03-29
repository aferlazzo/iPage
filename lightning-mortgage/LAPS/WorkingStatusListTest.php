<?php
require ("../include/authenticate.php");
require ("../include/SetCookies.php");
SetCookies();
?>
<html>
<head>
<title>Daily Progress Report handler</title>
<script language="JavaScript" src="https://host373.ipowerweb.com/~lightnin/js/Common.js">
</script>
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
//													//
//	DisplayFormattedRow: Displays the line			//
//													//
// -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*	//



function DisplayFormattedRow($Row, $Link, $UserLevel)
{
	global $SortColumn;
	
	/* Display records that are in the table */

	print ("<tr align=center valign=middle>");

	/* -*-*-*-*-* Edit An Existing Record column -*-*-*-*-*-*-*-*-*- */

	$ApplicantName = GetBorrower($Row[SSN], $Link, $UserLevel);

	// die ("ApplicantName=:$ApplicantName:<br>\n");

	$yyy=$ApplicantName;
	$xxx=strlen($Row[Comments]);
	$ccc=urlencode($Row[Comments]);

	print ("<td colspan='3' bgcolor='#CCCCCC'>");
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

	print ("<input type='hidden' name=SSN value='$Row[SSN]'>");
	print ("<input type='hidden' name=id value='$Row[id]'>");
	print ("<input type='hidden' name=ReportDate value='$Row[ReportDate]'>");
	print ("<input type='hidden' name=Comments value='$ccc'>");
	print ("<input type='hidden' name=ApplicantName value='$yyy'>");
	print ("<input type='hidden' name=PointStatus value='$Row[PointStatus]'>");
	print ("<font face='Verdana' size='1' color='#000099'></font></td></form>");


/*
	print ("<td bgcolor='#CCCCCC'>");
	print ("<form name='EditRecord' action='WorkingStatusMaintenance.php' method='post'>");

	print ("<td>&nbsp;</td>");

	print ("<form name='EditRecord' action='WorkingStatusMaintenance.php' method='post'>");
	print ("<input type='hidden' name=SSN value='$Row[SSN]'>");
	print ("<input type='hidden' name=id value='$Row[id]'>");
	print ("<input type='hidden' name=ReportDate value='$Row[ReportDate]'>");
	print ("<input type='hidden' name=Comments value='$ccc'>");
	print ("<input type='hidden' name=ApplicantName value='$yyy'>");
	print ("<input type='hidden' name=RequestType value='Update'>");
	print ("<input type='hidden' name=PointStatus value='$Row[PointStatus]'>");
	print ("<input type='button' value='Edit' onClick='submit()'>");
	print ("</form></td>");
*/
	/* -*-*-*-*- Delete Record column -*-*-*-*-*-*-*-*-*-*-*-*-*- */
/*
	print ("<td>&nbsp;</td>");

	print ("<td bgcolor='#CCCCCC'>");

	if ($UserLevel != "Admin")
		print ("<form name='DeleteRecord' action='FunctionDisabled.php' method='post'>");
	else
		print ("<form name='DeleteRecord' action='WorkingStatusUpdate.php' method='post'>");

	print ("<input type='hidden' name=SSN value='$Row[SSN]'>");
	print ("<input type='hidden' name=id value='$Row[id]'>");
	print ("<input type='hidden' name=Comments value='$ccc'>");
	print ("<input type='hidden' name=ApplicantName value='$yyy'>");
	print ("<input type='hidden' name=RequestType value='Delete'>");
	print ("<input type='button' value='Delete' onClick='submit()'>");
	print ("</form></td>");
*/
	/* -*-*-*-*- Add New Comment Record column -*-*-*-*-*-*-*-*-*-*-*-*-*- */
/*
	print ("<td>&nbsp;</td>");

	print ("<td bgcolor='#CCCCCC'>");

	print ("<form name='EditRecord' action='WorkingStatusMaintenance.php' method='post'>");
	print ("<input type='hidden' name=SSN value='$Row[SSN]'>");
	print ("<input type='hidden' name=id value='$Row[id]'>");
	print ("<input type='hidden' name=ReportDate value='$Today'>");
	print ("<input type='hidden' name=ApplicantName value='$yyy'>");
	print ("<input type='hidden' name=RequestType value='Insert'>");
	print ("<input type='hidden' name=PointStatus value='$Row[PointStatus]'>");
	print ("<input type='button' value='New' onClick='submit()'>");
	print ("</form></td>");
*/
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

	$Row[ReportDate] = urlencode($Row[ReportDate]);

	/* Format the $Row[ReportDate] */


	if ($Row[ReportDate] == "")  // Don't print ReportDates that equal null
	{
		$Row[ReportDate]='&nbsp;';
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
	
	$CommentsStart = ShortComment($Row[Comments]);
	print ("$CommentsStart");
	
	//$Options="width=860,height=515,scrollbars=yes,location=yes,resizable=yes";
	$Options="width=860,height=515,scrollbars=yes,resizable=yes";
	

	
	$URLencodedComments=urlencode($Row[Comments]);
	$Page="https://host373.ipowerweb.com/~lightnin/LAPS/Comments.php?Comments=".$URLencodedComments;	

	if (strlen($Row[Comments]) > 240)
	{
		print ("...&nbsp;&nbsp;&nbsp;&nbsp;");
		print ("<a href='onclick=\"javascript: CommentsWindow = open('$Page', 'Comments', '$Options');\">more</a> �");
		print ("</font></td></tr>");			
		//print ("<script language='Javascript'>CommentsWindow.window.focus();</script>");
	}
	else
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
	$x = 239;
	
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
	print ("<table border='1' bordercolor='#000099' cellpadding='3' cellspacing='0' align='center'>");
	print ("<tr align='center' valign='top'>");
	print ("<td align='center' width='5%' valign='middle' colspan='3' bgcolor='#003399'>");

	print ("<form action='ApplicantMaster.php'>");
	print ("<font face='Verdana' size='2' color='#000099'>");
	print ("<input type='button' value='Home' onClick='submit();'");
	print ("title='Click to Go Home'>");
	print ("</font></form></td>");

	print ("<td align='right' width='40%' valign='middle' colspan='5' bgcolor='#003399'>");
	//print ("<font face='Verdana' size='5' color='#FFFFFF'><strong>Lightning Mortgage&nbsp;&nbsp;</strong></font></td>");
    print ("<a href='./index.php'>");
    print ("<img border='0' src='images/WebLogo.gif' align='center' ");
    print ("alt='Lightning Mortgage - Mortgage Finance and Refinance' width='354' height='58'></a></td>");

	//print ("<td colspan='3' align='right' width='50%' valign='middle' bgcolor='#003399'>");
	print ("<td align='right' width='55%' valign='middle' bgcolor='#003399'>");
	DisplayReportingPeriodRangeOptions();
	print ("</td></tr>");
	print ("<tr align=center valign=top><td colspan='11'>");
	
	// Navigation Bar line

	print ("<table border='0' bordercolor='#CCCCCC'cellpadding='3' cellspacing='0' align='center'>");

	print ("<form name='Navigation' action='WorkingStatusList.php' method='post'>");
	print ("<td align='middle' width='12%' valign='middle'>\n");
	print ("&nbsp;&nbsp;<input type='submit' value='Clear' onclick='window.document.Navigation.SearchTerm.value=\"\"'>");

	if ($SearchTerm != "")
		print ("&nbsp;&nbsp;<input type='text' style='background: #FFFF00' name='SearchTerm' value='$SearchTerm'size='20'>&nbsp;&nbsp;");
	else
		print ("&nbsp;&nbsp;<input type='text' name='SearchTerm' value='$SearchTerm' size='20'>&nbsp;&nbsp;");

	print ("<input type='submit' name'Search' value='Search'></td>");

	print ("<td align='center' width='45%' valign='middle'>\n");
	
	print ("<table border='1' bordercolor='#000099' cellpadding='2' cellspacing='0'>");
	print ("<td bgcolor='#000099C9C'><font face='Verdana' size='3' color='#FFFF00'><b>Daily Status</b></font></td>");
	print ("<td bgcolor='#9C31CE'><a href='./ApplicantList.php'><font face='Verdana' size='3' color='#FFFFFF'>Applicant</a></font></td>");
	print ("<td bgcolor='#397352'><a href='./ContactList.php'><font face='Verdana' size='3' color='#FFFFFF'>Contact</a></font></td>");
	print ("<td bgcolor='#CE6300'><a href='./LoanList.php'><font face='Verdana' size='3' color='#FFFFFF'>Loan</a></font></td>");
	print ("<td bgcolor='#9C9C31'><a href='./EmploymentList.php'><font face='Verdana' size='3' color='#FFFFFF'>Employment</a></font></td>");
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

	print ("<form name='FilterIt' action='WorkingStatusList.php' method='post'>");
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
	print ("<form action='WorkingStatusMaintenance.php' method='post'>");
	print ("<input type='hidden' name=RequestType value='Insert'>");

	/* we'll put the "Add New" button in this cell */

	$Today=date("m/d/y");
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
		print ("<td align=center valign='middle' bgcolor='#000099C9C'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center valign='middle' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");

	
	print ("<form action='$PHP_SELF' method='post'>");
	print ("<input type='submit' name='SortColumn' value='Point Status'");	/* Point Status button */
	print (" title='Click to sort on the Point Status Column'>");
	print ("<input type='hidden' name='SavedFilter' value='$xxx'>");
	print ("</td></form>");
	
	/* * * * Print the Heading Applicant Name  * * * */

if ($SortColumn == 'ApplicantName')
		print ("<td align=center valign='middle' bgcolor='#000099C9C'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center valign='middle' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	
	
	print ("<form action='$PHP_SELF' method='post'>");
	print ("<input type='submit' name='SortColumn' value='ApplicantName'");	/* ApplicantName button */
	print (" title='Click to sort on Applicant Name Column'>");
	print ("<input type='hidden' name='SavedFilter' value='$xxx'>");
	print ("</td></form>");

	/* * * * Print the Heading, Sort on Report Date  * * * */

if ($SortColumn == 'Date')
		print ("<td align=center bgcolor='#000099C9C'><font face='Verdana' strong size='2' color='#FFFFFF'>");
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
		print ("<td align=center colspan='5' bgcolor='#000099C9C'><font face='Verdana' strong size='2' ");
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

	$LastApplicantName="";
	$x ="";

	while ($Row=mysql_fetch_array($Result))
	{
		list($month, $day, $year) = sscanf($Row[DateInserted],"%02d/%02d/%02d");// reformat MM/DD/YY date
		$CompareDate = sprintf("%02d%02d%02d", $year, $month, $day);			// to YYMMDD

		if ($Debug)
		{
			print ("Line ".__LINE__.", print record if ('$x' < \$CommentLimit '$CommentLimit'), ");
			print ("(\$SearchTerm |$SearchTerm| is null or matches), ");
			print ("(\$SavedFilter |$SavedFilter| == 'All'' or \$Row[LoanStatus] |$Row[LoanStatus]|), and ");
			print ("($FromDate <= $CompareDate <= $ToDate)<br>\n");
		}

		if (($CompareDate >= $FromDate) && ($CompareDate <= $ToDate))
		{
			if ($LastApplicantName != $Row[ApplicantName])
			{
				$x=0;
				$LastApplicantName = $Row[ApplicantName];
			}

			if (($x < $CommentLimit) || ($CommentLimit == "All"))
			{
				$x++;

				if ($SearchTerm != "")
				{	// look through the Comments column and associated ApplicantName in the row for a match of the search term
					$ApplicantName = GetBorrower($Row[SSN], $Link, $UserLevel);

					if (stristr($Row[Comments], $SearchTerm))
					{
						DisplayFormattedRow($Row, $Link, $UserLevel);
					}
					elseif (stristr($Row[PointStatus], $SearchTerm))
					{
						DisplayFormattedRow($Row, $Link, $UserLevel);
					}
					elseif (stristr($ApplicantName, $SearchTerm))
					{
						DisplayFormattedRow($Row, $Link, $UserLevel);
					}
				}
				else
				{
					if (($SavedFilter == "All") || ($SavedFilter == $Row[LoanStatus]))//LoanStatus is part of ApplicantInfo table
					{
						DisplayFormattedRow($Row, $Link, $UserLevel);
					}
				}
			}
		}
	}

	/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
	/*																												*/
	/*	We must keep the end of form down here because HTML is sequential executed. The $SavedFilter value doesn't	*/
	/*	get assigned until rows in the table are listed.															*/
	/*																												*/
	/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/

	//print ("<input type='hidden' name=Filter      		value=$SavedFilter>");
	//print ("<input type='hidden' name=BestCallNumber	value=$SavedFilter>");
	//print ("<input type='hidden' name=RequestType 		value='Insert'>");
	//print ("</form>");
	mysql_close($Link);

?>
</body>
</html>
