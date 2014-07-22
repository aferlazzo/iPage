<?php
require ("../include/authenticate.php");
require ("../include/SetCookies.php");
SetCookies();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<html>
<head>
<title>Business Statistics</title>
<link rel="stylesheet" href="../css/AdministrativeStyles.css" type="text/css">
<!--[if IE 6]>
<style type="text/css">
html
{
  scrollbar-base-color: #F4F4F4;
  scrollbar-arrow-color: #FFFFFF;
  scrollbar-track-color: #002179;
  scrollbar-face-color: #000099;
  scrollbar-3dlight-color: #000099;
}
</style>
<![endif]-->
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

<?php
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -- - - - - - - -	*/
/*																												*/
/*	SelectRecords: Takes the existing $Link from the mysql_connect() function, which points to the database 	*/
/*	on the server and the $TableName that specifies the particular table in the database to retrieve matching 	*/
/*	records in the order dictated by the $SortColumn variable.													*/
/*																												*/
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/

function SelectRecords ($SortColumn, $DBname, $TableName, $Link)
{
	switch ($SortColumn)
	{
		case "ApplicantName":
			$Query = "SELECT * from $TableName order by ApplicantLastName";
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
		default:
			$Query = "SELECT * from $TableName order by SSN";   // This is the default
			$SortColumn="SSN";
			break;
	}

	//print ("Inside SelectRecords (), line ".__LINE__." SortColumn |$SortColumn| Query:|$Query|<br>\n");

    $Result=mysql_db_query($DBname, $Query, $Link);

	return($Result);
}

// - - - - - - - - - - - - - - - - - - - - - - - - 	//
//													//
// Prints the correctly formated line on the screen	//
//													//
// - - - - - - - - - - - - - - - - - - - - - - - - 	//

function DisplayStats($StatNumber, $StatPercentage, $StatText)
{
	print ("<tr><td height='15' width='157' align='right' valign='middle'>\n");
	print ("$StatNumber</td>\n");

	if ($StatText != "active applications have been submitted to a lender")
	{
		print ("<td height='15' width='14' align='right' valign='middle'>\n");
		print ("-</td>\n");
		print ("<td height='15' width='54' align='right' valign='middle'>\n");
		printf("%2.1f%%</td>", $StatPercentage);
		print ("<td height='15' align='left' valign='middle'>\n");
	}
	else
		print ("<td height='15' colspan='3' align='left' valign='middle'>\n");

	print ("<p class='Administration'>$StatText</p></td></tr>\n");
}


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -	//
//																			//
//	DBStatistics: This page retrieves and displays the data in the database //
//	table 'ApplicantInfo' and computes/displays loan applicant statistics.	//
//																			//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -	//

//print ("Start test<br>");

// Another way to debug/test is to view all cookies
//print_r($_COOKIE);
//die("<br>end test");

// Always remember when you do a print ("$variable...); the variable's value will be substituted.
// When you use a single quote, print ('$variable...); the value WILL NOT be substituted.

	/* variables to access Database */

	$Host="localhost";
	$DBname="lightnin_LoanApps";
	$TableName="ApplicantInfo";

	//Declare time period reporting variables

	$FromDate;
	$FromMonthName;
	$FromMonth;
	$FromDay;
	$FromYear;
	$DateRange = $_POST['DateRange']; // we do this because a change to the DateRange causes the form to restart the page
	$ToDate;
	$ToMonthName;
	$ToMonth;
	$ToDay;
	$ToYear;

	ComputeReportingPeriod();

	/* variables to access Database */

	//print ("User |$User| Password |$Password|<br>\n");

	/* first, connect to the MySQL DBMS on this server */

	$Link=mysql_connect ($Host, $User, $Password) or die ('I cannot connect to the DBMS because: '.mysql_error());
	$Link2=mysql_connect ($Host, $User, $Password) or die ('I cannot connect to the DBMS because: '.mysql_error());

	/* select everything from the database table. Sort by the column name passed in the cookie SortColumn */

	$Result = SelectRecords($SortColumn, $DBname, $TableName, $Link); /* Set the order of the records retrieved according to $SortColumn */

	$TotalRecords = 0;
	$NewRecords = 0;
	$ActiveRecords = 0;
	$CancelledRecords = 0;
	$DeniedCreditRecords = 0;
	$DeniedByLenderRecords = 0;
	$NoCreditReportRecords = 0;
	$WithdrawnRecords = 0;
	$SubmittedRecords = 0;
	$CompletedRecords = 0;
	$GiftRecords = 0;

	$GoogleRecords = 0;
	$YahooRecords = 0;
	$MSNRecords = 0;
	$AOLRecords = 0;
	$OtherSearchEngineRecords = 0;
	$OtherRecords = 0;
	$MortgageProfessorRecords = 0;
	$FriendRecords = 0;
	$TVRecords = 0;
	$RadioRecords = 0;
	$NewspaperRecords = 0;
	$InternetLeadRecords = 0;


	//print ("FromMonthName $FromMonthName, FromMonth $FromMonth<br>\n");

// *-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*//
//																							//
// Normally we compare the reporting date to the ApplicantInfoTable record's $DateInserted	//
// if the loan status is "Submitted to Lender" we want to see if this activity occurred 	//
// within the reporting period																//
//																							//
// *-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*//

	while ($Row=mysql_fetch_array($Result))
	{
		//print ("Line ".__LINE__." Record for SSN $Row[SSN] ApplicantName $Row[ApplicantName]<br>\n");

		if ($Row[LoanStatus] == "Submitted to Lender")
		{
			$Table2Name ="WorkingStatusInfo";
			//$TableName="ApplicantInfo";

			$Query2  = "SELECT * from $TableName, $Table2Name where $TableName.SSN=$Table2Name.SSN and ";
			$Query2 .= "$Table2Name.PointStatus='Submitted To Lender'";
			//print ("Line ".__LINE__." Query2 = $Query2<br>\n");

			$Result2=mysql_db_query($DBname, $Query2, $Link2);

			if ($Result2)	// found match
			{
				$Match=mysql_fetch_array($Result2);
				$CompareDate = $Match[ReportDate];	// The date PointStatus was set to "Submitted to Lender"
				//list($month, $day, $year) = sscanf($CompareDate,"%02d/%02d/%02d");// reformat MM/DD/YY date
				//$CompareDate = sprintf("%02d%02d%02d", $year, $month, $day);			// to YYMMDD
			}
			else
			{
				print ("Line ".__LINE__." Error! SSN = $SSN: Matching WorkingStatus record with PointStatus=");
				die ("\"Submitted to Lender\" not found");
			}

			//print ("Line ".__LINE__." SSN $Row[SSN] ApplicantName $Row[ApplicantName] Date Inserted ");
			//print ("$Row[DateInserted] LoanStatus |$Row[LoanStatus]| Date Submitted to Lender $CompareDate<br>\n");
		}
		else
		{
			//was list($month, $day, $year) = sscanf($Row[DateInserted], "%02d/%02d/%02d");// reformat MM/DD/YY date
			list($year, $month, $day) = sscanf($Row[DateInserted], "%02d/%02d/%02d");// reformat YY/MM/DD date

			$CompareDate = sprintf("%02d%02d%02d", $year, $month, $day);			// to YYMMDD

			//die("DateInserted $Row[DateInserted] -  YY $year MM $month DD $day - $CompareDate - $FromDate - $ToDate");
		}

		if (($CompareDate >= $FromDate) && ($CompareDate <= $ToDate))
		{
			if ($Row[LoanStatus] != "Submitted to Lender")
				$TotalRecords++;

			//print ("Line ".__LINE__." LoanStatus |$Row[LoanStatus]|<br>\n");

			switch ($Row[LoanStatus])
			{
				case "New":
					$NewRecords++;
					break;

				case "Active":
					$ActiveRecords++;
					break;

				case "Cancelled":
					$CancelledRecords++;
					break;

				case "Denied Credit":
					$DeniedCreditRecords++;
					break;

				case "Denied By Lender":
					$DeniedByLenderRecords++;
					break;

				case "No Credit Report":
					$NoCreditReportRecords++;
					break;

				case "Submitted to Lender":
					$SubmittedRecords++;
					break;

				case "Gift Lead":
					$GiftRecords++;
					break;

				case "Withdrawn":
					$WithdrawnRecords++;
					break;

				case "Completed":
					$CompletedRecords++;
					break;

				default:
					print ("Line ".__LINE__." LoanStatus |$Row[LoanStatus]| not found, SSN |$Row[SSN]|. Please update.<br>\n");
					break;
			}

			switch ($Row[HowReferred])
			{
				case "Google":
					$GoogleRecords++;
					break;

				case "Yahoo":
					$YahooRecords++;
					break;

				case "MSN":
					$MSNRecords++;
					break;

				case "AOL":
					$AOLRecords++;
					break;

				case "Other Search Engine":
					$OtherSearchEngineRecords++;
					break;

				case "Other":
					$OtherRecords++;
					break;

				case "Mortgage Professor":
					$MortgageProfessorRecords++;
					break;

				case "A Friend":
					$FriendRecords++;
					break;

				case "TV Commercial":
					$TVRecords++;
					break;

				case "Radio":
					$RadioRecords++;
					break;

				case "Newspaper Ad":
					$NewspaperRecords++;
					break;

				case "Internet Lead":
					$InternetLeadRecords++;
					break;
			}
		}
	}

	mysql_close($Link);

	//print ("Line ".__LINE__." TotalRecords=$TotalRecords<br>\nNewRecords=$NewRecords<br>\nActiveRecords=$ActiveRecords<br>\n");
	//print ("Line ".__LINE__." CancelledRecords=$CancelledRecords<br>\nDeniedCreditRecords=$DeniedCreditRecords<br>\n");
	//print ("Line ".__LINE__." NoCreditReportRecords=$NoCreditReportRecords<br>\nWithdrawnRecords=$WithdrawnRecords<br>\n");
	//print ("Line ".__LINE__." SubmittedRecords=$SubmittedRecords<br>\nGiftRecords=$GiftRecords<br>\n");

	if ($NoCreditReportRecords > 0)
		$CreditReportPercentage	= 100 - ($NoCreditReportRecords/$TotalRecords * 100);
	else
		$CreditReportPercentage	= 100;

	$CreditReportRecords = $TotalRecords - $NoCreditReportRecords;

	if ($ActiveRecords > 0)
		$ActivePercentage = $ActiveRecords/$TotalRecords * 100;
	else
		$ActivePercentage = 0;

	if ($DeniedCreditRecords > 0)
		$DeniedCreditPercentage	= $DeniedCreditRecords/$TotalRecords * 100;
	else
		$DeniedCreditPercentage	= 0;

	if ($DeniedByLenderRecords > 0)
		$DeniedByLenderPercentage = $DeniedByLenderRecords/$TotalRecords * 100;
	else
		$DeniedByLenderPercentage = 0;

	if ($WithdrawnRecords > 0)
		$WithdrawnPercentage = $WithdrawnRecords/$TotalRecords * 100;
	else
		$WithdrawnPercentage = 0;

	if ($GiftRecords > 0)
		$GiftPercentage = $GiftRecords/$TotalRecords * 100;
	else
		$GiftPercentage = 0;

	if ($CompletedRecords > 0)
		$CompletedPercentage = $CompletedRecords/$TotalRecords * 100;
	else
		$CompletedPercentage = 0;

	if ($NoCreditReportRecords > 0)
		$NoCreditReportPercentage = $NoCreditReportRecords/$TotalRecords * 100;
	else
		$NoCreditReportPercentage = 0;

	if ($SubmittedRecords > 0)
		$SubmittedPercentage = $SubmittedRecords/$TotalRecords * 100;
	else
		$SubmittedPercentage = 0;

	if ($NewRecords > 0)
		$NotYetProcessedPercentage = $NewRecords/$TotalRecords * 100;
	else
		$NotYetProcessedPercentage = 0;



//------------Advertising Statistics -------------------------------

	if ($GoogleRecords > 0)
		$GooglePercentage = $GoogleRecords/$TotalRecords * 100;
	else
		$GooglePercentage = 0;

	if ($YahooRecords > 0)
		$YahooPercentage = $YahooRecords/$TotalRecords * 100;
	else
		$YahooPercentage = 0;

	if ($AOLRecords > 0)
		$AOLPercentage = $AOLRecords/$TotalRecords * 100;
	else
		$AOLPercentage = 0;

	if ($MSNRecords > 0)
		$MSNPercentage = $MSNRecords/$TotalRecords * 100;
	else
		$MSNPercentage = 0;

	if ($OtherRecords > 0)
		$OtherPercentage = $OtherRecords/$TotalRecords * 100;
	else
		$OtherPercentage = 0;

	if ($FriendRecords > 0)
		$FriendPercentage = $FriendRecords/$TotalRecords * 100;
	else
		$FriendPercentage = 0;

	if ($TVRecords > 0)
		$TVPercentage = $TVRecords/$TotalRecords * 100;
	else
		$TVPercentage = 0;

	if ($RadioRecords > 0)
		$RadioPercentage = $RadioRecords/$TotalRecords * 100;
	else
		$RadioPercentage = 0;

	if ($NewspaperRecords > 0)
		$NewspaperPercentage = $NewspaperRecords/$TotalRecords * 100;
	else
		$NewspaperPercentage = 0;

	if ($InternetLeadRecords > 0)
		$InternetLeadPercentage = $InternetLeadRecords/$TotalRecords * 100;
	else
		$InternetLeadPercentage = 0;

	if ($OtherSearchEngineRecords > 0)
		$OtherSearchEnginePercentage = $OtherSearchEngineRecords/$TotalRecords * 100;
	else
		$OtherSearchEnginePercentage = 0;

	if ($MortgageProfessorRecords > 0)
		$MortgageProfessorPercentage = $MortgageProfessorRecords/$TotalRecords * 100;
	else
		$MortgageProfessorPercentage = 0;
?>

<!-- * * * * * * * * * * * * * * * * Begin HTML * * * * * * * * * * * * * * * * * * * * * * * * -->

<body>

<script>
  if (window.location.href.substring(0,5)!="https"){ window.location.replace('https://host373.ipowerweb.com/~lightnin/LAPS/ApplicantMaster.php') }
</script>

<div class="Main" id="MainDIV">
<div class="Content" id="ContentDIV">

<?php

	print ("<script type='text/javascript' language='Javascript'>AtStartCookies();</script>");

	//print ("On line ".__LINE__." SavedFilter $SavedFilter, SortColumn $SortColumn, SearchTerm $SearchTerm<br>\n");

?>
    <h1>Loan Application Statistics</h1>

    <table border="0" cellpadding="4" cellspacing="0" width="720">
      <tr>
       <td height="18" align='left' colspan='3'>
       <!--<a href='ApplicantMaster.php'>LAPS Home</a></td>-->
		<form action='ApplicantMaster.php'>
		<p align='left'><input class='Submit' type='submit' value='LAPS Home' style='color:#fff;'></p>
       <td height="18" colspan='2'>

<?php
	print ("<p align='left'>&nbsp;&nbsp;&nbsp;<b>Welcome, $RealName</b>\n");
	print ("</p></td></tr></form>");

	print ("<tr><td height='15' align='middle' valign='top' colspan='5'>\n");
	DisplayReportingPeriodRangeOptions();	//find in include/SetCookies.php
	print ("</td></tr>");


	// -*-*-*-*-* Display the Reporting Period statistics *-*-*-*-*-

	// We are using 6 arrays (3 for the list of application categories, and 3 for the method they found us,
	// to display the lines. Lines with values of zero are not displayed.
	//
	// Before the lines are displayed, the values are sorted
	
	if ($TotalRecords > 0)
		DisplayStats($TotalRecords, "100", "Of applications received for this period");
	else
	{
		print ("<tr><td height='15' width='157' align='right' colspan='3' valign='middle'>\n");
		print ("&nbsp;</td>\n");
		print ("</td><td height='15' align='left' width='491' valign='middle'>\n");
		print ("<p>No applications received for this period</p></td></tr>\n");
	}

	$AppCategory = array ($NoCreditReportRecords,
						$CreditReportRecords,
						$ActiveRecords,
						$DeniedCreditRecords,
						$DeniedByLenderRecords,
						$WithdrawnRecords,
						$GiftRecords,
						$CompletedRecords,
						$NewRecords);

	$AppPercentage = array ($NoCreditReportPercentage,
							$CreditReportPercentage,
							$ActivePercentage,
							$DeniedCreditPercentage,
							$DeniedByLenderPercentage,
							$WithdrawnPercentage,
							$GiftPercentage,
							$CompletedPercentage,
							$NotYetProcessedPercentage);

	$AppDescription = array ("Applications did not include credit report requests",
								"Applications included credit reports",
								"Applications are currently 'Active' loans",
								"Applications have been denied credit based on their scores",
								"Applications have been denied by a lender",
								"Applications have been withdrawn after applying",
								"Applications have been given away to other brokers",
								"Applications have resulted in closed loans",
								"Applications have just been received and not yet processed");

	array_multisort($AppCategory, SORT_DESC, SORT_NUMERIC,
					$AppPercentage,
					$AppDescription);
					
	for ($x=0; $x < count($AppCategory); $x++)
	{
		if ($AppCategory[$x] > 0)
		{
			$RR = $AppCategory[$x];
			$PP = $AppPercentage[$x];
			$DD = $AppDescription[$x];

			DisplayStats($RR, $PP, $DD);
		}
	}

	if($SubmittedRecords > 0)
	{
		print ("<tr><td colspan='4'>&nbsp;</td></tr>");
		DisplayStats($SubmittedRecords, $SubmittedPercentage, "active applications have been submitted to a lender");
	}

	// *-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*

	if ($TotalRecords > 0)
	{
		print ("<tr><td>&nbsp;</td></tr>");
		print ("<tr height='6'><td bgcolor='#003399' align='middle' colspan='4'>");
		print ("<h1 style='background-color: #04a8d; color: #FFFFFF; text-align: center; margin-top: 0; margin-bottom: 0;'>How They Found Us</h1></td></tr>\n");
		print ("<tr><td colspan='4'>&nbsp;</td></tr>");
	}

	$DisplayArrayRecords = array ($GoogleRecords,
									$YahooRecords,
									$AOLRecords,
									$MSNRecords,
									$OtherSearchEngineRecords,
									$FriendRecords,
									$TVRecords,
									$RadioRecords,
									$NewspaperRecords,
									$InternetLeadRecords,
									$MortgageProfessorRecords,
									$OtherRecords);

	$DisplayArrayPercentage = array ($GooglePercentage,
										$YahooPercentage,
										$AOLPercentage,
										$MSNPercentage,
										$OtherSearchEnginePercentage,
										$FriendPercentage,
										$TVPercentage,
										$RadioPercentage,
										$NewspaperPercentage,
										$InternetLeadPercentage,
										$MortgageProfessorPercentage,
										$OtherPercentage);

	$DisplayArrayDescription = array ("Found website from a Google search",
										"Found website from a Yahoo search",
										"Found website from an AOL search",
										"Found website from a MSN search",
										"Found website via some unspecified search engine",
										"Found website based on a friend's recommendation",
										"Found website from watching a TV commercial",
										"Found website from hearing a radio commercial",
										"Found website reading a newspaper ad",
										"Found website via an Internet lead",
										"Found website from the Mortgage Professor website",
										"Found website using some other method");

	array_multisort($DisplayArrayRecords, SORT_DESC, SORT_NUMERIC,
					$DisplayArrayPercentage,
					$DisplayArrayDescription);



	for ($x=0; $x < count($DisplayArrayPercentage); $x++)
	{
		if ($DisplayArrayRecords[$x] > 0)
		{
			$RR = $DisplayArrayRecords[$x];
			$PP = $DisplayArrayPercentage[$x];
			$DD = $DisplayArrayDescription[$x];

			DisplayStats($RR, $PP, $DD);
		}
	}

?>


          <tr>
           <td height="18" colspan='4'></td>
          </tr>
         </table>
        </div>




<!--  * * * * * * * * * * * * * * * * COMMON FOOTER  * * * * * * * * * * * * * * * -->

<?php include("../include/bottom.php"); ?>


<!-- * * * * * * * * * * * * * * * * Begin COMMON HEADER * * * * * * * * * * * * * * * * * * * * * * * * -->

<?php include("../include/top.php"); ?>

<!--  * * * * * * * * * * * * * * * * * * * End of COMMON HEADER * * * * * * * * * * * * * * * * * * -->
</body>
</html>
