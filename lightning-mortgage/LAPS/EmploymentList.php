<?php
require ("../include/authenticate.php");
require ("../include/SetCookies.php");
SetCookies();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>EmploymentList form handler</title>
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

// -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*	//
//													//
//	DisplayFormattedRow: Displays the line			//
//													//
// -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*	//


function DisplayFormattedRow($Row, $Link, $UserLevel)
{
	global $SortColumn;
	global $SSNIsCoApp;
	$Host="localhost";
	$DBname="lightnin_LoanApps";

	// put in defaults if field is null

	if (is_null($Row[Employer]))
	{
		$Row[Employer]="none";
	}

	if (is_null($Row[MonthlyIncome]))
	{
		$Row[MonthlyIncome]="0";
	}

	if (is_null($Row[IncomeLastYear]))
	{
		$Row[IncomeLastYear]="none";
	}

	//	 Display records that are in the table

	print ("<tr align=center valign=middle>");


	print ("<td bgcolor='#CCCCCC'>");
	
	if ($UserLevel == "Admin")
		print ("<form name='EditRecord' action='EmploymentMaintenance.php' method='post'>");
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


// */*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/
//
//	We must get both the applicant and co-applicant data just in case the user decides to update
//	the employment record. The data will be stored in form fields for the potential Update.
//
//
//	Read the Applicant Table to check that the SSN match the Applicant
//	-If they do, 
//		-Save the Co_SSN and Co_ApplicantName from the Applicant record
//		-Take the Employer data from the $Row array and save it as Applicant data in the form
//		-Read the Employer Table for the Co_Applicant to obtain the necessary employer data
//	
//
//	Read the Applicant Table to check that the SSN match the Co_Applicant
//	-If they do, 
//		-Save the SSN and ApplicantName from the Applicant record
//		-Take the Employer data from the $Row array and save it as Co_Applicant data in the form
//		-Read the Employer Table for the Applicant to obtain the necessary employer data
//
//
// */*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/

	//- - - - - - - - get Applicant & Co-applicant data here - - - - - - - - - - -

	$TableName="ApplicantInfo";

	$Query = "Select * from $TableName where SSN = '$Row[SSN]'"; //select a record with the match SSN

	$Result=mysql_db_query($DBname, $Query, $Link);

	if (mysql_query ($Query, $Link))
	{
		$AppRecord=mysql_fetch_array($Result);	
		
		if ($Row[SSN] == $AppRecord[SSN]) //Is this new fetch's SSN == the table row's SSN
		{
			print ("<input type='hidden' name=SSN value='$Row[SSN]'>");
			// pass the just-now obtained Applicant Name
			print ("<input type='hidden' name=ApplicantName value='$AppRecord[ApplicantName]'>");
			
			$Row[ApplicantName] = $AppRecord[ApplicantName];	// make sure this list has the right name
			
			print ("<input type='hidden' name=Co_SSN value='$AppRecord[Co_SSN]'>");
			print ("<input type='hidden' name=Co_ApplicantName value='$AppRecord[Co_ApplicantName]'>");
			
			print ("<input type='hidden' name=Employer value='$Row[Employer]'>");
			print ("<input type='hidden' name=Position value='$Row[Position]'>");
			print ("<input type='hidden' name=MonthlyIncome value='$Row[MonthlyIncome]'>");
			print ("<input type='hidden' name=IncomeLastYear value='$Row[IncomeLastYear]'>");
			print ("<input type='hidden' name=LengthOfEmployment value='$Row[LengthOfEmployment]'>");

			if (($AppRecord[Co_SSN] > 0) && ($AppRecord[Co_SSN] != "")) //If this applicant really does have a co-applicant
			{
				$TableName="EmploymentInfo"; // read employer data to get Co_Applicant's Employer Data
				
				$Query = "Select * from $TableName where SSN = '$AppRecord[Co_SSN]'";

				$Result=mysql_db_query($DBname, $Query, $Link);

				if (mysql_query ($Query, $Link)) // did we find a match?
				{
					$EmpRecord=mysql_fetch_array($Result);	// fetch the matching row in the EmploymentInfo table

					print ("<input type='hidden' name=Co_Employer value='$EmpRecord[Employer]'>");
					print ("<input type='hidden' name=Co_Position value='$EmpRecord[Position]'>");
					print ("<input type='hidden' name=Co_MonthlyIncome value='$EmpRecord[MonthlyIncome]'>");
					print ("<input type='hidden' name=Co_IncomeLastYear value='$EmpRecord[IncomeLastYear]'>");
					print ("<input type='hidden' name=Co_LengthOfEmployment value='$EmpRecord[LengthOfEmployment]'>");
				}
				else //no Co_Applicant match was found in the Applicant record
				{
					print ("<input type='hidden' name=Co_Employer>");
					print ("<input type='hidden' name=Co_Position>");
					print ("<input type='hidden' name=Co_MonthlyIncome>");
					print ("<input type='hidden' name=Co_IncomeLastYear>");
					print ("<input type='hidden' name=Co_LengthOfEmployment>");
				}				
			}
			else //no Co_Applicant in the Applicant record
			{
				print ("<input type='hidden' name=Co_Employer>");
				print ("<input type='hidden' name=Co_Position>");
				print ("<input type='hidden' name=Co_MonthlyIncome>");
				print ("<input type='hidden' name=Co_IncomeLastYear>");
				print ("<input type='hidden' name=Co_LengthOfEmployment>");		
			}
		}
	}
	
	// - - - - - - - - - - End getting Applicant data, if the was a match - - - - - - - - - - - - - - - - 
	
	// - - - - - - - - - - Was this a CoApplicant? - - - - - - - -

	$Query = "Select * from $TableName where Co_SSN = '$Row[SSN]'"; //select a record with the match SSN

	$Result=mysql_db_query($DBname, $Query, $Link);

	if (mysql_query ($Query, $Link))
	{
		$AppRecord=mysql_fetch_array($Result);	
		
		if ($Row[SSN] == $AppRecord[Co_SSN]) //Is this new fetch's Co_SSN == the table row's SSN
		{
			print ("<input type='hidden' name=Co_SSN value='$Row[SSN]'>");
			print ("<input type='hidden' name=Co_ApplicantName value='$AppRecord[Co_ApplicantName]'>");
			
			$Row[ApplicantName] = $AppRecord[Co_ApplicantName]; // make sure this list has the right name

			print ("<input type='hidden' name=SSN value='$AppRecord[SSN]'>");
			print ("<input type='hidden' name=ApplicantName value='$AppRecord[ApplicantName]'>");
			
			print ("<input type='hidden' name=Co_Employer value='$Row[Employer]'>");
			print ("<input type='hidden' name=Co_Position value='$Row[Position]'>");
			print ("<input type='hidden' name=Co_MonthlyIncome value='$Row[MonthlyIncome]'>");
			print ("<input type='hidden' name=Co_IncomeLastYear value='$Row[IncomeLastYear]'>");
			print ("<input type='hidden' name=Co_LengthOfEmployment value='$Row[LengthOfEmployment]'>");
		}
		
		$TableName="EmploymentInfo"; // read employer data to get Applicant's Employer Data
				
		$Query = "Select * from $TableName where SSN = '$AppRecord[SSN]'";

		$Result=mysql_db_query($DBname, $Query, $Link);

		if (mysql_query ($Query, $Link)) // did we find a match?
		{
			$EmpRecord=mysql_fetch_array($Result);	// fetch the matching row in the EmploymentInfo table
			print ("<input type='hidden' name=Employer value='$EmpRecord[Employer]'>");

			print ("<input type='hidden' name=Position value='$EmpRecord[Position]'>");
			print ("<input type='hidden' name=MonthlyIncome value='$EmpRecord[MonthlyIncome]'>");
			print ("<input type='hidden' name=IncomeLastYear value='$EmpRecord[IncomeLastYear]'>");
			print ("<input type='hidden' name=LengthOfEmployment value='$EmpRecord[LengthOfEmployment]'>");
		}
		else //no Co_Applicant match was found in the Applicant record
		{
			print ("<input type='hidden' name=Employer>");
			print ("<input type='hidden' name=Position>");
			print ("<input type='hidden' name=MonthlyIncome>");
			print ("<input type='hidden' name=IncomeLastYear>");
			print ("<input type='hidden' name=LengthOfEmployment>");
		}				
	}
	else //no Co_Applicant in the Applicant record
	{
		print ("<input type='hidden' name=Employer>");
		print ("<input type='hidden' name=Position>");
		print ("<input type='hidden' name=MonthlyIncome>");
		print ("<input type='hidden' name=IncomeLastYear>");
		print ("<input type='hidden' name=LengthOfEmployment>");		
	}
	
	print ("</td></form>");
	
	//- - - - - - - - End of getting Applicant & Co-applicant data - - - - - - - - - - -

	/* Format the SSN */

	//print ("length is ".strlen($Row[SSN]).", value is $Row[SSN]<br>\n");
	$x = strlen($Row[SSN]);

	while ($x < 9)  // pad with leading zeros
	{
		$TempField = "0".$Row[SSN];
		$Row[SSN] = $TempField;
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
		print ("<td align=center bgcolor='#F3F3E9' valign=middle>");
	else
		print ("<td align=center valign=middle>");
		
	print ("<font face='Verdana' size='2' color='#000099'>$Row[SSN]</font></td>");



	if($SortColumn == 'ApplicantName')
	{
		print ("<td align='left' bgcolor='#F3F3E9' valign=middle>");
	}
	else
	{
		print ("<td align='left' valign=middle>");
		//print ("blank? $ApplicantName</font></td>");
	}


	print ("<font face='Verdana' size='2' color='#000099'>$Row[ApplicantName]</font></td>");
	$Row[Employer] = urlencode($Row[Employer]);


	// Format the $Row[Employer]

	if ($Row[Employer] == "")  // Don't print Employer names that equal null
	{
		$Row[Employer]='&nbsp;';
	}
	else
	{
		if ($UserLevel != "Admin")
			$Row[Employer]=substr($Row[Employer],0,4)."xxxxxx";
	}

	if($SortColumn == 'Employer')
		print ("<td align='left' bgcolor='#F3F3E9' valign=middle>");
	else
		print ("<td align='left' valign=middle>");
			
	print ("<font face='Verdana' size='2' color='#000099'>".urldecode($Row[Employer])."</font></td>");

	// Format the $Row[Position]

	if ($Row[Position] == "")  // Don't print Position names that equal null
	{
		$Row[Position]='&nbsp;';
	}

	if($SortColumn == 'Position')
		print ("<td align='left' bgcolor='#F3F3E9' valign=middle>");
	else
		print ("<td align='left' valign=middle>");
		
	print ("<font face='Verdana' size='2' color='#000099'>".urldecode($Row[Position])."</font></td>");

	// Format the $Row[MonthlyIncome]

	if ($Row[MonthlyIncome] == "")  // Don't print MonthlyIncome names that equal null
	{
		$Row[MonthlyIncome]='0';
	}

	if($SortColumn == 'Last Month')
		print ("<td align='right' bgcolor='#F3F3E9' valign=middle>");
	else
		print ("<td align='right' valign=middle>");
		
	print ("<font face='Verdana' size='2' color='#000099'>$");
	printf ("%d.", $Row[MonthlyIncome]);
	print ("&nbsp;&nbsp;</font></td>");

	// Format the $Row[Last Year]

	if ($Row[IncomeLastYear] == "")  // Don't print IncomeLastYear that equal null
	{
		$Row[IncomeLastYear]='0';
	}

	if($SortColumn == 'Last Year')
		print ("<td align='right' bgcolor='#F3F3E9' valign=middle>");
	else
		print ("<td align='right' valign=middle>");
			
	print ("<font face='Verdana' size='2' color='#000099'>$");
	printf ("%d.", $Row[IncomeLastYear]);
	print ("&nbsp;&nbsp;</font></td>");
	
	
	if($SortColumn == 'Years')
		print ("<td align=center bgcolor='#F3F3E9' valign=middle>");
	else
		print ("<td align=center valign=middle>");
		


	if ($Row[LengthOfEmployment] == "")  // Don't print LengthOfEmployment that equal null
	{
		$Row[LengthOfEmployment]='&nbsp;';
	}

	print ("<font face='Verdana' size='2' color='#000099'>$Row[LengthOfEmployment]</font></td>");

	print ("</tr>"); // end of row
}




/* --------------------------------------------------------	*/
/*															*/
/*	Gets the name associated with a ss# from the database	*/
/*															*/
/*--------------------------------------------------------- */

function GetApplicantName($MySSN, $Link, $UserLevel)
{
	$Host="localhost";
	$DBname="lightnin_LoanApps";
	$TableName="ApplicantInfo";
	global $SSNIsCoApp; //flag to tell the page that this ssn is for a co_applicant
	global $DateInserted;

	$TempField = ereg_replace("[^[:digit:]]", "", $MySSN);

	if ($SSNIsCoApp == 'n')
		$Query = "SELECT * from $TableName where SSN = $TempField";
	else
	{
		$Query = "SELECT * from $TableName where Co_SSN = $TempField";
		//print ("Line ".__LINE__." Start of GetApplicantName() \$SSNIsCoApp is '$SSNIsCoApp' Query is $Query<br>\n");
	}
	
	//print ("Line ".__LINE__." Start of GetApplicantName() \$SSNIsCoApp is '$SSNIsCoApp' Query is $Query<br>\n");

	$Result=mysql_db_query($DBname, $Query, $Link); // look for the match


	if (!mysql_query ($Query, $Link)) // check the results of the query
	{
		print ("Line ".__LINE__." Error-->Link |$Link|<br>\n");

		print ("<br><center><font face='Verdana' size='5' color='#000099'><strong>Warning!</strong></font><br><br>");
		print ("<font face='Verdana' size='2' color='#000099'>Query not executed correctly.<br><br>\n");
		print ("Social Security Number<font face='Verdana' size='3' color='#000099'>'$MySSN' </font>");
		print ("<font face='Verdana' size='2' color='#000099'>was the passed Social Security Number.</font><br>\n");

		echo mysql_errno() . ": " . mysql_error(). "\n";
		mysql_close($Link);
		die ("Error in GetApplicantName()");
	}

	$Record=mysql_fetch_array($Result);	// fetch the matching row in the ApplicantInfo table

	if ($SSNIsCoApp == 'n') 
	{
		if ($MySSN == ($Record[SSN]))	// If SSN matches Applicant's
		{
			$Name		  = $Record[ApplicantName];
			$DateInserted = $Record[DateInserted];
			//print ("Line ".__LINE__." Ran SSN $MySSN as an Applicant. Found name $Name. Inserted $DateInserted<br>\n");
		}
		else
		{
			//print ("Line ".__LINE__." SSN $MySSN Not found in Applicant Table. Must be a co-applicant<br>\n");
			$SSNIsCoApp = 'y';
			
			$Name 			 = GetApplicantName($MySSN, $Link, $UserLevel);
			//print ("Line ".__LINE__." Ran SSN $MySSN as a co_applicant. Found name $Name Date Inserted $DateInserted \$Record[DateInserted] $Record[DateInserted]<br>\n");
			$Row[LoanStatus] = $Record[LoanStatus];			
			$SSNIsCoApp = 'n';
		}			
	}

	if ($SSNIsCoApp == 'y') 
	{
		//print ("Line ".__LINE__." Checking CoApp<br>\n");
		
		if ($MySSN == ($Record[Co_SSN]))	// If SSN matches Co_Applicant's
		{
			$Name			 = $Record[Co_ApplicantName];	// we have a co-applicant name/SSN
			$Row[LoanStatus] = $Record[LoanStatus];
			$DateInserted 	 = $Record[DateInserted];
			//print ("Line ".__LINE__." In GetApplicantName() SSN $MySSN as a co_applicant. Found name $Name Date Inserted $DateInserted.<br>\n");
		}
		else // neither applicant or co-app match
		{
			$Name = "->>--->Not Found!<---<<-";
			print ("Line ".__LINE__." In GetApplicantName() SSN $MySSN as an applicant & co_applicant. Name not found<br>\n");			
		}
	}


	if ($UserLevel != "Admin")
	{
		$Initial = substr($Record[ApplicantLastName], 0, 1);
		$Name = $Record[ApplicantFirstName]." ".$Initial.".";
		//$DateInserted = $Record[DateInserted];
	}

	//die ("User Level $UserLevel, Name $Name ($Record[ApplicantName], $Record[ApplicantFirstName], $Record[ApplicantLastName])");
	return($Name);
}




/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
/*																													*/
/*	SelectRecords: Takes the existing $Link from the mysql_connect() function, which points to the database on the 	*/
/*	server and the $TableName that specifies the particular table in the database to retrieve matching records in 	*/
/*	the order dictated bythe $SortColumn variable.																	*/
/*																													*/
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/

function SelectRecords ($SortColumn, $DBname, $TableName, $Link)
{
	//print ("line ".__LINE__."<br>\n");

	$Table2Name="ApplicantInfo";


// -------------------------------------------------
//
// Important: we join these two records so that there is a field in the Row array for records fields we use 
// in this program from both tables
//
// -------------------------------------------------

	switch ($SortColumn)
	{
		case "ApplicantName": // If sort of list is by ApplicantName,  
			$Query  = "(SELECT * from $TableName, $Table2Name where $TableName.SSN=$Table2Name.SSN order by ApplicantLastName)";
			break;

		case "Employer":
			$Query  = "SELECT * from $TableName, $Table2Name where $TableName.SSN=$Table2Name.SSN order by Employer";
			break;

		case "SSN":
			$Query  = "SELECT * from $TableName, $Table2Name where $TableName.SSN=$Table2Name.SSN order by $TableName.SSN";
			break;

		case "Last Month":
			$Query = "SELECT * from $TableName, $Table2Name where $TableName.SSN=$Table2Name.SSN order by MonthlyIncome";
			break;

		case "Last Year":
			$Query = "SELECT * from $TableName, $Table2Name where $TableName.SSN=$Table2Name.SSN order by IncomeLastYear";
			break;

		case "Employer":
			$Query = "SELECT * from $TableName, $Table2Name where $TableName.SSN=$Table2Name.SSN order by Employer";
			break;

		case "Position":
			$Query = "SELECT * from $TableName, $Table2Name where $TableName.SSN=$Table2Name.SSN order by Position";
			break;

		case "Years":
			$Query = "SELECT * from $TableName, $Table2Name where $TableName.SSN=$Table2Name.SSN order by LengthOfEmployment";
			break;

		default:
			$Query = "SELECT * from $TableName, $Table2Name where $TableName.SSN=$Table2Name.SSN order by $TableName.SSN";   // This is the default
			$SortColumn="SSN";
			break;
	}

	//print ("line ".__LINE__." Inside SelectRecords (), Query:|$Query|<br>\n");
	//print ("line ".__LINE__." \$DBname |$DBname| \$Link |$Link|<br>\n");
    $Result=mysql_db_query($DBname, $Query, $Link);

	return($Result);
}


// -----------------------------------------------
// double check the applican name matches the SSN
// -----------------------------------------------

function GetName ($Link, $MySSN)
{
	$Host="localhost";
	$DBname="lightnin_LoanApps";
	$TableName="ApplicantInfo";
	global $SSNIsCoApp;

	$TempField = ereg_replace("[^[:digit:]]", "", $MySSN);

	if ($SSNIsCoApp == 'n')
		$Query = "SELECT * from $TableName where SSN = $TempField";
	else
	{
		$Query = "SELECT * from $TableName where Co_SSN = $TempField";
		//print ("Line ".__LINE__." Start of GetName() \$SSNIsCoApp is '$SSNIsCoApp' Query is $Query<br>\n");
	}
	
	//print ("Line ".__LINE__." Start of GetName() \$SSNIsCoApp is '$SSNIsCoApp' Query is $Query<br>\n");

	$Result=mysql_db_query($DBname, $Query, $Link); // look for the match


	if (!mysql_query ($Query, $Link)) // check the results of the query
	{
		print ("Line ".__LINE__." Error-->Link |$Link|<br>\n");

		print ("<br><center><font face='Verdana' size='5' color='#000099'><strong>Warning!</strong></font><br><br>");
		print ("<font face='Verdana' size='2' color='#000099'>Query not executed correctly.<br><br>\n");
		print ("Social Security Number<font face='Verdana' size='3' color='#000099'>'$MySSN' </font>");
		print ("<font face='Verdana' size='2' color='#000099'>was the passed Social Security Number.</font><br>\n");

		echo mysql_errno() . ": " . mysql_error(). "\n";
		mysql_close($Link);
		die ("Error in GetName()");
	}

	$Record=mysql_fetch_array($Result);	// fetch the matching row in the ApplicantInfo table
	
	if ($SSNIsCoApp == 'n')
		$Name = $Record[ApplicantName];
	else
		$Name = $Record[Co_ApplicantName];
	
	//print ("Line ".__LINE__." MySSN $MySSN Using Name '$Name' \$Record[ApplicantName] '$Record[ApplicantName]' \$Record[Co_ApplicantName] '$Record[Co_ApplicantName]'<br>\n");
	
	return($Name);
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//
//																													//
// PaginateDisplay: We need to run through the database twice.														//
//					The first time is simply to count the number of records that will actually be displayed.		//
//					The second time is to actually display the records that match the previously chosen criteria.	//
//																													//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//

function PaginateDisplay($Row, $Link, $UserLevel, $DateInserted, $CompareDate, $CountOrDisplay)
{
	global $Debug;
	global $SSNIsCoApp;
	global $SearchTerm;
	global $SavedFilter;
	global $FromDate;
	global $ToDate;
	
	$Count = false;
	
	//was list($month, $day, $year) = sscanf($DateInserted, "%02d/%02d/%02d");// reformat MM/DD/YY date
	list($year, $month, $day) = sscanf($DateInserted, "%02d/%02d/%02d");// reformat YY/MM/DD date

	$CompareDate = sprintf("%02d%02d%02d", $year, $month, $day);			// to YYMMDD

	//die("DateInserted $Row[DateInserted] -  YY $year MM $month DD $day - $CompareDate - $FromDate - $ToDate");
	
	//print("Line ". __LINE__." DateInserted $DateInserted -  YY $year MM $month DD $day - $CompareDate - $FromDate - $ToDate<br>\n");
	//if (($CompareDate >= $FromDate) && ($CompareDate <= $ToDate))
	//	print ("printing record<br>\n");

	if ($Debug)
	{
		print ("Line ".__LINE__.", print record if ");
		print ("(\$SearchTerm |$SearchTerm| is null or matches), ");
		print ("(\$SavedFilter |$SavedFilter| == 'All'' or \$Row[LoanStatus] |$Row[LoanStatus]|), and ");
		print ("($FromDate <= $CompareDate <= $ToDate)<br>\n");
	}

	if (($CompareDate >= $FromDate) && ($CompareDate <= $ToDate))
	{
		if ($SearchTerm != "")
		{	// look through the Position, Employer, and associated ApplicantName columns in the row for a match of the search term

			if (stristr($Row[Employer], $SearchTerm))
			{
				$Count = true;
				if ($CountOrDisplay == 'Display')
					DisplayFormattedRow($Row, $Link, $UserLevel);
			}

			elseif (stristr($Row[Position], $SearchTerm))
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
			//print ("Line ".__LINE__." (\$SavedFilter == \$Row[LoanStatus]) '$SavedFilter'=='$Row[LoanStatus]' $FromDate <= $CompareDate >= $ToDate<br>\n");
		
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
//	EmploymentList: This page retrieves and displays the data in the database table 'EmploymentInfo'//
//	A list filter is passed from other pages as a variable "$SavedFilter" and is used to list records 	//
//	with the matching BestCallNumber.																//
//																									//
//	The variable passed to this page from EmploymentUpdate.php and EmploymentMaintenance.php is 	//
//	$SavedFilter 																					//
//	Calls EmploymentMaintenance.php. Passes variables Filter, BestCallNumber, RequestType			//
//																									//
//																									//
//	Sample 																							//
//	http://www.lightning-mortgage.com/EmploymentList.php?SavedFilter=Active&ListAll=Browse+Employments	//
//																									//
//																									//
//																									//
//																									//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//

// Always remember when you do a print ("$variable..."); the variable will be substituted.
// When you use a single quote, print ('$variable...'); the value WILL NOT be substituted.

/* variables to access Database */

	$Host="localhost";
	$DBname="lightnin_LoanApps";
	$TableName="EmploymentInfo";

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
	print ("<table border='0' bordercolor='#CCCCCC' width='100%' cellpadding='3' cellspacing='0' align='center'>");
	print ("<tr align='center' valign='top'>");
	print ("<form action='ApplicantMaster.php'>");
	print ("<td align='center' width='5%' valign='middle' bgcolor='#003399'>\n");

	print ("<p><input class='Submit' type='submit' value='LAPS Home' style='color:#fff;'></p></td></form>");

	print ("<td align='center' valign='middle' width='19%' bgcolor='#003399'>");
    print ("<a class='Logo' href='http://www.lightning-mortgage.com/index.php'>");
    print ("<img border='0' src='../images/Lightning-Mortgage.jpg' align='center' ");
    print ("alt='Lightning Mortgage - Mortgage Finance and Refinance'></a></td>");

	print ("<td align='left' width='30%' colspan='3' valign='middle' bgcolor='#003399'>\n");
	DisplayReportingPeriodRangeOptions();
	print ("</td><td bgcolor='#003399' </td></tr></table>\n");

	print ("<table><form name='FilterIt' action='EmploymentList.php' method='post'>");

	print ("<td align='left' valign='middle'>");
	print ("&nbsp;&nbsp;<input type='submit' value='Clear' onclick='window.document.FilterIt.SearchTerm.value=\"\"'>");

	if ($SearchTerm != "")
		print ("&nbsp;&nbsp;<input type='text' style='background: #FFFF00' name='SearchTerm' value='$SearchTerm'size='20'>&nbsp;&nbsp;");
	else
		print ("&nbsp;&nbsp;<input type='text' name='SearchTerm' value='$SearchTerm' size='20'>&nbsp;&nbsp;");

	print ("<input type='submit' name'Search' value='Search'></td>\n");

	print ("<td align='left' valign='middle'><font face='Verdana' size='3' color='#000099'>");

	print ("<table border='1' bordercolor='#000099' cellpadding='2' cellspacing='0'>");
	print ("<td bgcolor='#003399'><a class='Top' href='./WorkingStatusList.php'>Daily Status</a></td>");
	print ("<td bgcolor='#9C31CE'><a class='Top' href='./ApplicantList.php'>Applicant</a></td>");
	print ("<td bgcolor='#397352'><a class='Top' href='./ContactList.php'>Contact</a></td>");
	print ("<td bgcolor='#CE6300'><a class='Top' href='./LoanList.php'>Loan</a></font></td>");
	print ("<td style='background:#9C9C31;'><span style='font:small bolder Verdana,Geneva,Arial,Helvetica,sans-serif;color:yellow;'>Employment</span></td>");
	print ("</table></td>");

	print ("<td align='right' width='12%' valign='middle'><font face='Verdana' size='2' color='#000099'>");
	print ("Filter By Status&nbsp;</font></td>\n");

	print ("<td align='Left' width='8%' valign='middle'><font face='Verdana' size='2' color='#000099'>");
	FilterStatus();
	print ("</td>");
	print ("</font></td></form></table>\n");

	/* - - - - - - Title Row: Create a screen table for displaying the data, print the Title row  - - - - - - - */

	print ("<table border=1 width='100%' cellpadding=4 cellspacing='0' bordercolor='#000099' align=center>");
/*
	print ("<tr align=center valign=top>");
	print ("<td align=center valign=middle><font face='Verdana' size='2' color='#000099'>");
	print ("<a href='ApplicantMaster.php'>Home</a></td>");
	print ("</font></td>");
	print ("<td align=right valign=middle colspan='3'><font face='Verdana' size='3' color='#000099'>");
	print ("<strong>Employment List</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
	print ("<font size='2'>Filter By Status &nbsp;</font></td>");
*/
	/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
	/*																									*/
	/* Neat trick for the pulldown menu: When an item changes, simulate the submit button being pressed	*/
	/* the form action reloads this page. The method=get displays the passed Filter field and the chosen*/
	/* parameter on the command line on reload.															*/
	/*																									*/
	/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
/*
	$TempVariable = $SearchTerm;
	$TempVariable2 = $SortColumn;

	print ("<form name='FilterIt' action='EmploymentList.php' method='post'>");

	print ("<input type='hidden' name='SortColumn' value='$TempVariable2'>");

	print ("<td align='right' valign=middle><font face='Verdana' size='2' color='#000099'>");
	FilterStatus();
	print ("</td></font>");
	//print ("<td align='left' valign=top><font face='Verdana' size='2' color='#000099'>&nbsp;</td>");
	print ("<td align='middle' valign='middle' colspan='3'><input type='text' name='SearchTerm' ");
	print ("value='$TempVariable'size='20'>&nbsp;&nbsp;");
	print ("<input type='submit' name'Search' value='Search'>");

	print ("</td>"); // end of row
	print ("</form>");
*/
	/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
	/*																										*/
	/* 	We are planning to pass the current Loan Status (when the value of the variable is created below).	*/
	/*	The reason we are going to do this is to maintain a consistent user experience. We want the records	*/
	/*	listed to have the same record filter enabled as it presently is without the user having to choose	*/
	/*	the BestCallNumber again.																			*/
	/*																										*/
	/*	When control passes back to this page (from EmploymentUpdate or EmploymentMaintenance) we 			*/
	/*	will want to use the same filtering criteria for displaying the list of table entries that we are	*/
	/*	presently using to display records for the user. We use a <form> to pass the this filter variable	*/
	/*	to EmploymentMaintenace.																			*/
	/*																										*/
	/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/

	$xxx=$SavedFilter;

	print ("<tr align=center valign=middle>");
	print ("<form action='EmploymentMaintenance.php' method='get'>");
	print ("<input type='hidden' name=RequestType value='Insert'>");

	// we'll put the "Add New" button in this cell

	print ("<td align=center height='10' valign=top bgcolor='#CCCCCC'>");
	print ("<font face='Verdana' size='2' color='#000099'>");
	print ("<input type='submit' name='submit' value='Add New'");
	print ("title='Click to Add a New Record'>");
	print ("</td></form>");

	// print the Headings row in the table using white characters on a blue background.

	// Header row has "sort by" column headers. When you click on a header name, the database is reread and redisplayed
	// Set the order of the records retrieved according to $SortColumn

	if ($SortColumn == 'SSN')
		print ("<td align=center valign='middle' bgcolor='#9C9C31'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center valign='middle' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");

	print ("<font face='Verdana' strong size='2' color='#FFFFFF'>");
	print ("<form action='$PHP_SELF' method='post'>");
	print ("<input type='submit' name='SortColumn' value='SSN'");	// Social Security button
	print ("title='Click to sort on Social Security Number Column'>");
	print ("<input type='hidden' name='SavedFilter' value='$xxx'>");
	print ("</td></form>");

	if ($SortColumn == 'ApplicantName')
		print ("<td align=center valign='middle' bgcolor='#9C9C31'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center valign='middle' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");

	print ("<font face='Verdana' strong size='2' color='#FFFFFF'>");
	print ("<form action='$PHP_SELF' method='post'>");
	print ("<input type='submit' name='SortColumn' value='ApplicantName'");	// Applicant button
	print (" title='Click to sort on Applicant Name Column'>");
	print ("<input type='hidden' name='SavedFilter' value='$xxx'>");
	print ("</td></form>");

	if ($SortColumn == 'Employer')
		print ("<td align=center valign='middle' bgcolor='#9C9C31'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center valign='middle' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");

	print ("<font face='Verdana' strong size='2' color='#FFFFFF'>");
	print ("<form action='$PHP_SELF' method='post'>");
	print ("<input type='submit' name='SortColumn' value='Employer'");	// Employer button
	print (" title='Click to sort on Employer Column'>");
	print ("<input type='hidden' name='SavedFilter' value='$xxx'>");
	print ("</td></form>");

	if ($SortColumn == 'Position')
		print ("<td align=center valign='middle' bgcolor='#9C9C31'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center valign='middle' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");

	print ("<font face='Verdana' strong size='2' color='#FFFFFF'>");
	print ("<form action='$PHP_SELF' method='post'>");
	print ("<input type='submit' name='SortColumn' value='Position'");	// Position button
	print (" title='Click to sort on Position Column'>");
	print ("<input type='hidden' name='SavedFilter' value='$xxx'>");
	print ("</td></form>");

	if ($SortColumn == 'Last Month')
		print ("<td align=center valign='middle' bgcolor='#9C9C31'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center valign='middle' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");

	print ("<font face='Verdana' strong size='2' color='#FFFFFF'>");
	print ("<form action='$PHP_SELF' method='post'>");
	print ("<input type='submit' name='SortColumn' value='Last Month'");	// MonthlyIncome button
	print (" title='Click to sort on MonthlyIncome Column'>");
	print ("<input type='hidden' name='SavedFilter' value='$xxx'>");
	print ("</td></form>");

	if ($SortColumn == 'Last Year')
		print ("<td align=center valign='middle' bgcolor='#9C9C31'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center valign='middle' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");

	print ("<font face='Verdana' strong size='2' color='#FFFFFF'>");
	print ("<form action='$PHP_SELF' method='post'>");
	print ("<input type='submit' name='SortColumn' value='Last Year'>");	// IncomeLastYear button
	print ("<input type='hidden' name='SavedFilter' value='$xxx'>");
	print ("</td></form>");

	if ($SortColumn == 'Years')
		print ("<td align=center valign='middle' bgcolor='#9C9C31'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center valign='middle' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");

	print ("<font face='Verdana' strong size='2' color='#FFFFFF'>");
	print ("<form action='$PHP_SELF' method='post'>");
	print ("<input type='submit' name='SortColumn' value='Years'>");	// LengthOfEmployment button
	print ("<input type='hidden' name='SavedFilter' value='$xxx'>");
	print ("</td></form>");
	print ("</tr>"); // end of row
	
	//print ("Line ".__LINE__." Done with headings<br>\n");
	
	// *-*-*-*-*-*-*-*-*-*-*-*-*-*-*-* End of Header Rows *-*-*-*-*-*-*-*-*-*-*-*-*-*
		
	$DateInserted; //must declare veriable before using the global keyword in a function
	
	// first, connect to the MySQL DBMS on this server
	
	$Link=mysql_connect ($Host, $User, $Password) or die ('I cannot connect to the DBMS because: '.mysql_error());

	// select everything from the database table. Sort by the column name passed

	// Set the order of the records retrieved according to $SortColumn

	$Result = SelectRecords($SortColumn, $DBname, $TableName, $Link);
	
	// Let's process the Employer Table's records that have been sorted according to the $ColumnSort value
	// First we want to count the number of rows that actually meet the other filter and Search criteria
	
	
	$MatchingRow = array_fill(0, 5000, 0); //Create the array to handle tables with up to 5000 rows
	$MatchingSSN = array_fill(0, 5000, 9999999999); //Create the array to handle tables with up to 5000 rows
	$MatchingApplicantName = array_fill(0, 5000, "ZZZZZZ"); //Create the array to handle tables with up to 5000 rows
	$MatchingApplicantLastName = array_fill(0, 5000, "ZZZZZZ"); //Create the array to handle tables w/up to 5000 rows
	$MatchingEmployer = array_fill(0, 5000, "ZZZZZZ"); //Create the array to handle tables with up to 5000 rows
	$MatchingPosition = array_fill(0, 5000, "ZZZZZZ"); //Create the array to handle tables with up to 5000 rows
	$MatchingMonthlyIncome = array_fill(0, 5000, 9999999999); //Create the array to handle tables with up to 5000 rows
	$MatchingIncomeLastYear = array_fill(0, 5000, 999999999); //Create the array to handle tables with up to 5000 rows
	$MatchingLengthOfEmployment = array_fill(0, 5000, 99999); //Create the array to handle tables with up to 5000 rows
	$MatchingDateInserted = array_fill(0, 5000, 0); //Create the array to handle tables with up to 5000 rows
	
	$SSNIsCoApp = 'n'; //flag tells whether the ssn is for an applicant or co_applicant
	
	// The challenge is: All rows in the table will not be printed. So we must determine which rows should
	// be printed so we can later jump to those rows as we later page through the Table.
	
	// Now fetch the the Employment data from the database and display Applicant and CoApplicant records 
	//with a matching Employer Status
	$TotalRows = 0;
	
	while ($Row=mysql_fetch_array($Result))
	{
		//print ("Line ".__LINE__." Beginning to process row $Row[SSN]<br>\n");

		$Row[ApplicantName] = GetApplicantName($Row[SSN], $Link, $UserLevel);

		//was list($month, $day, $year) = sscanf($DateInserted, "%02d/%02d/%02d");// reformat MM/DD/YY date
		list($year, $month, $day) = sscanf($DateInserted, "%02d/%02d/%02d");// reformat YY/MM/DD date

		$CompareDate = sprintf("%02d%02d%02d", $year, $month, $day);			// to YYMMDD

		//add the row to the table if the row matches the filter criteria
		if (PaginateDisplay($Row, $Link, $UserLevel, $DateInserted, $CompareDate, 'Count')==true)
		{		
			$MatchingRow[$TotalRows]				= $TotalRows;
			$MatchingSSN[$TotalRows] 				= $Row[SSN];
			$MatchingApplicantName[$TotalRows]		= $Row[ApplicantName];
			$MatchingApplicantLastName[$TotalRows]	= $Row[ApplicantLastName];
			$MatchingEmployer[$TotalRows] 			= $Row[Employer];
			$MatchingPosition[$TotalRows]  			= $Row[Position];
			$MatchingMonthlyIncome[$TotalRows]  	= $Row[MonthlyIncome];
			$MatchingIncomeLastYear[$TotalRows]  	= $Row[IncomeLastYear];
			$MatchingLengthOfEmployment[$TotalRows] = $Row[LengthOfEmployment];
			$MatchingDateInserted[$TotalRows] 		= $Row[DateInserted];
			
			//print ("Line ".__LINE__." \$MatchingRow[$TotalRows] = $MatchingRow[$TotalRows] \$MatchingSSN[$TotalRows] =$MatchingSSN[$TotalRows] \$MatchingApplicantName[$TotalRows] = $MatchingApplicantName[$TotalRows] \$MatchingEmployer[$TotalRows] = $MatchingEmployer[$TotalRows] \$MatchingPosition[$TotalRows] = $MatchingPosition[$TotalRows] \$MatchingMonthly[$TotalRows] = $MatchingMonthly[$TotalRows] \$MatchingIncomeLastYear[$TotalRows] = $MatchingIncomeLastYear[$TotalRows] \$MatchingLengthOfEmployment[$TotalRows] = $MatchingLengthOfEmployment[$TotalRows] <br>\n");

			$TotalRows++;
			
			if ($Row[Co_SSN] > 0)	//if there is a co-applicant, get their info, too
			{
				$CoQuery  = "SELECT * from EmploymentInfo where EmploymentInfo.SSN=$Row[Co_SSN]";
				//print ("Line ".__LINE__." \$Row[Co_SSN] $Row[Co_SSN]<br>\n");
				$CoResult=mysql_db_query($DBname, $CoQuery, $Link) or die ("Cannot perform CoQuery on EmploymentInfo");
				$CoRow=mysql_fetch_array($CoResult) or die ("Cannot perform CoFetch  on EmploymentInfo");
				PaginateDisplay($Row, $Link, $UserLevel, $DateInserted, $CompareDate, 'Count');
				
				$MatchingRow[$TotalRows]				= $TotalRows;
				$MatchingSSN[$TotalRows] 				= $Row[Co_SSN];
				
				$MatchingEmployer[$TotalRows] 			= $CoRow[Employer];
				$MatchingPosition[$TotalRows]  			= $CoRow[Position];
				$MatchingMonthlyIncome[$TotalRows]  	= $CoRow[MonthlyIncome];
				$MatchingIncomeLastYear[$TotalRows]  	= $CoRow[IncomeLastYear];
				$MatchingLengthOfEmployment[$TotalRows] = $CoRow[LengthOfEmployment];
				$MatchingDateInserted[$TotalRows] 		= $Row[DateInserted];
				
				$CoQuery  = "SELECT * from ApplicantInfo where ApplicantInfo.Co_SSN=$Row[Co_SSN]";
				$CoResult=mysql_db_query($DBname, $CoQuery, $Link) or die ("Cannot perform CoQuery on Applicant Info");
				$CoRow=mysql_fetch_array($CoResult) or die ("Cannot perform CoFetch on ApplicantInfo");				$MatchingApplicantName[$TotalRows]		= $CoRow[Co_ApplicantName];
				$MatchingApplicantLastName[$TotalRows]	= $Row[Co_ApplicantLastName];
				
				
				//print ("Line ".__LINE__." \$MatchingRow[$TotalRows] = $MatchingRow[$TotalRows] \$MatchingSSN[$TotalRows] =$MatchingSSN[$TotalRows] \$MatchingApplicantName[$TotalRows] = $MatchingApplicantName[$TotalRows] \$MatchingEmployer[$TotalRows] = $MatchingEmployer[$TotalRows] \$MatchingPosition[$TotalRows] = $MatchingPosition[$TotalRows] \$MatchingMonthly[$TotalRows] = $MatchingMonthly[$TotalRows] \$MatchingIncomeLastYear[$TotalRows] = $MatchingIncomeLastYear[$TotalRows] \$MatchingLengthOfEmployment[$TotalRows] = $MatchingLengthOfEmployment[$TotalRows] <br>\n");

				//echo "<pre\n";
				//print_r ($Row);
				//echo "<pre\n";
				//die ("ending");
				$TotalRows++;			
			}
		}
	}

	//print ("Line ".__LINE__." End of Table Input. $TotalRows rows.<br><br>\n");

	if (TotalRows > 5000)
	 	die("Error: EmployerList line ".__LINE__." Matching Row array exceeds 5,000 records. Must increase table size.");
	 	
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
	 	$q = intval($q); //lets try 15 rows per page
		//print ("Line ".__LINE__." \$TotalRows=$TotalRows \$TotalPages=$TotalPages \$q=$q \$s=$s<br>\n");
		$s = $TotalRows % $RowsPerPage;
		//print ("Line ".__LINE__." \$TotalRows=$TotalRows \$TotalPages=$TotalPages \$q=$q \$s=$s<br>\n");
		$s = intval($s); //lets try 15 rows per page
		//print ("Line ".__LINE__." \$TotalRows=$TotalRows \$TotalPages=$TotalPages \$q=$q \$s=$s<br>\n");
		$TotalPages = $q; //lets try 15 rows per page
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

	if (!empty($_GET[Page])) // This is the passed parameter. If over rides the cookie value if not on the first page
		$Page= $_GET[Page];
		
	$ThisRow = ($Page - 1) * $RowsPerPage;	//depending on which page we're now on will determine the first row to display

	//if (!mysql_data_seek($Result, $MatchingRow[$ThisRow])) // reset the EmployerInfoTable's pointer
	//     die ("Cannot seek to row $ThisRow: " . mysql_error() . "\n");


	//print ("On Line ".__LINE__." This page's first row = MatchingRow[$ThisRow] \$MatchingSSN[$ThisRow] \$MatchingSSN[$ThisRow] $MatchingSSN[$ThisRow] <br>\n");
	
	
	$Index = $MatchingRow[$ThisRow];
	
	//sort the tables according to the $SortColum variable
	
	//for ($x=0; $x < $TotalRows; $x++)
	//	print ("Line ".__LINE__." \$MatchingRow[$x] = $MatchingRow[$x] \$MatchingSSN[$x] =$MatchingSSN[$x] \$MatchingApplicantName[$x] = $MatchingApplicantName[$x] \$MatchingEmployer[$x] = $MatchingEmployer[$x] \$MatchingPosition[$x] = $MatchingPosition[$x] \$MatchingMonthly[$x] = $MatchingMonthly[$x] \$MatchingIncomeLastYear[$x] = $MatchingIncomeLastYear[$x] \$MatchingLengthOfEmployment[$x] = $MatchingLengthOfEmployment[$x] <br>\n");	

	$x = 0;	// Set counter for the row number on the page to zero
	
	switch ($SortColumn)
	{
		case "SSN":
			array_multisort($MatchingSSN, SORT_ASC, SORT_NUMERIC,
							$MatchingRow,
							$MatchingApplicantName,
							$MatchingApplicantLastName,
							$MatchingEmployer,
							$MatchingPosition,
							$MatchingMonthlyIncome,
							$MatchingIncomeLastYear,
							$MatchingLengthOfEmployment,
							$MatchingDateInserted);
			break;
			
		case "ApplicantName":
			array_multisort($MatchingApplicantLastName,SORT_ASC, SORT_REGULAR,
							$MatchingRow,
							$MatchingSSN,
							$MatchingApplicantName, 
							$MatchingEmployer,
							$MatchingPosition,
							$MatchingMonthlyIncome,
							$MatchingIncomeLastYear,
							$MatchingLengthOfEmployment,
							$MatchingDateInserted);
			break;
					
		case "Employer":
			array_multisort($MatchingEmployer, SORT_ASC, SORT_REGULAR,
							$MatchingRow,
							$MatchingSSN,
							$MatchingApplicantName,
							$MatchingApplicantLastName,
							$MatchingPosition,
							$MatchingMonthlyIncome,
							$MatchingIncomeLastYear,
							$MatchingLengthOfEmployment,
							$MatchingDateInserted);
			break;

		case "Position":
			array_multisort($MatchingPosition, SORT_ASC, SORT_REGULAR,
							$MatchingRow,
							$MatchingSSN,
							$MatchingApplicantName,
							$MatchingApplicantLastName,
							$MatchingEmployer,
							$MatchingMonthlyIncome,
							$MatchingIncomeLastYear,
							$MatchingLengthOfEmployment,
							$MatchingDateInserted);
			break;	

		case "Last Month":
			array_multisort($MatchingMonthlyIncome, SORT_ASC, SORT_NUMERIC,
							$MatchingRow,
							$MatchingSSN,
							$MatchingApplicantName,
							$MatchingApplicantLastName,
							$MatchingEmployer,
							$MatchingPosition,
							$MatchingIncomeLastYear,
							$MatchingLengthOfEmployment,
							$MatchingDateInserted);
			break;	

		case "Last Year":
			array_multisort($MatchingIncomeLastYear, SORT_ASC, SORT_NUMERIC,
							$MatchingRow,
							$MatchingSSN,
							$MatchingApplicantName,
							$MatchingApplicantLastName,
							$MatchingEmployer,
							$MatchingMonthlyIncome,
							$MatchingPosition,
							$MatchingLengthOfEmployment,
							$MatchingDateInserted);
			break;	
			
		case "Years":
			array_multisort($MatchingLengthOfEmployment, SORT_ASC, SORT_NUMERIC,
							$MatchingRow,
							$MatchingSSN,
							$MatchingApplicantName,
							$MatchingApplicantLastName,
							$MatchingEmployer,
							$MatchingMonthlyIncome,
							$MatchingIncomeLastYear,
							$MatchingPosition,
							$MatchingDateInserted);
			break;	
	}
	
	while (($Index < $TotalRows) && ($x <= $EndRow) && ($x < $RowsPerPage))//print up to 15 rows
	{
		$Row[SSN] 				= $MatchingSSN[$Index];
		$Row[ApplicantName] 	= $MatchingApplicantName[$Index];
		$Row[Employer] 			= $MatchingEmployer[$Index];
		$Row[Position]			= $MatchingPosition[$Index];
		$Row[MonthlyIncome]		= $MatchingMonthlyIncome[$Index];
		$Row[IncomeLastYear] 	= $MatchingIncomeLastYear[$Index];
		$Row[LengthOfEmployment]= $MatchingLengthOfEmployment[$Index];
		$Row[DateInserted]		= $MatchingDateInserted[$Index];

		//print ("Line ".__LINE__." \$MatchingRow[$Index] = $MatchingRow[$Index] \$MatchingSSN[$Index] =$MatchingSSN[$Index] \$MatchingApplicantName[$Index] = $MatchingApplicantName[$Index] \$MatchingEmployer[$Index] = $MatchingEmployer[$Index] \$MatchingPosition[$Index] = $MatchingPosition[$Index] \$MatchingMonthly[$Index] = $MatchingMonthly[$Index] \$MatchingIncomeLastYear[$Index] = $MatchingIncomeLastYear[$Index] \$MatchingLengthOfEmployment[$Index] = $MatchingLengthOfEmployment[$Index] <br>\n");			
		//print ("Line ".__LINE__." processing row \$x=|$x| $Row[ApplicantName] $Row[DateInserted]<br>\n");
		
		// Display the row if it meets all criteria
		
		
		if (PaginateDisplay($Row, $Link, $UserLevel, $Row[DateInserted], $CompareDate, 'Display'))
		{
			//print ("Line ".__LINE__." \$MatchingRow[$Index] = |$MatchingRow[$Index]| \$Row[ApplicantName] = |$Row[ApplicantName]|");
			$x++;
		}
		
		$Index++;
	}

	//while (($Row=mysql_fetch_array($Result)) && ($x <= $EndRow) && ($x < $RowsPerPage))//print up to 15 rows
	//{
	//	//print ("Line ".__LINE__." processing row \$x=|$x| $Row[ApplicantName] $Row[DateInserted]<br>\n");
	//	
	//	// Display the row if it meets all criteria
	//	
	//	if (PaginateDisplay($Row, $Link, $UserLevel, $Row[DateInserted], $CompareDate, 'Display'))
	//	{
	//		//print ("Line ".__LINE__." \$MatchingRow[$TotalRows] = |$MatchingRow[$TotalRows]| \$Row[ApplicantName]=$Row[ApplicantName]|");
	//		$x++;
	//	}
	//}

	
	if($Page > 1)
	{ 
        $PagePrev = $Page - 1; 
        $Page=$PagePrev; 
        print ("</table><br>&nbsp;&nbsp;<FONT color=red>�</FONT><font face='Verdana' strong size='2' color='#000099'><a href=\"$PHP_SELF?Page=$PagePrev\"><b> Previous</b></a>&nbsp;&nbsp;</font>"); 
        //print ("</table><br>&nbsp;&nbsp;<FONT color=red>�</FONT><font face='Verdana' strong size='2' color='#000099'><a href=\"$PHP_SELF?Page=$PagePrev\"><b> Previous</b></a>&nbsp;&nbsp;</font>"); 
    }
    else  // if on first page...
    { 
        print ("</table><br>&nbsp;&nbsp;<FONT color=red>�</FONT><font face='Verdana' strong size='2' color='#000099'> Previous&nbsp;&nbsp;</font>"); //simulate the Previous page HyperLink
    } 

    //print ("Line ".__LINE__." \$TotalPages=$TotalPages ");
    
    print ("<font face='Verdana' strong size='2' color='#000099'>");
    $i = 1;
    
    while ($i <= $TotalPages) //now create the navigation hyperlinks
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
          
        print ("  <a href=\"$PHP_SELF?Page=$Pagenext\"><b>Next</b></a> <FONT color=red>�</FONT>"); //create a link to the next page
    }
    else
    { 
        print ("<font face='Verdana' strong size='2' color='#000099'>  Next <FONT color=red>�</FONT>"); //simulate the hyperlink to the non-existent next page
    }

	mysql_close($Link);
?>
</body>
</html>