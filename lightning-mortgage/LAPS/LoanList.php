<?php
require ("../include/authenticate.php");
require ("../include/SetCookies.php");
SetCookies();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>LoanList form handler</title>
<script language="JavaScript" src="https://host373.ipowerweb.com/~lightnin/js/Common.js">
</script>
<script language="JavaScript">
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

function DisplayFormattedRow($RowNumber, $Row, $Link, $UserLevel)
{
	global $SortColumn;
	
	//print("Loan Purpose |".urlencode($Row[LoanPurpose])."|");

	/*	 Display records that are in the table */

	//original line
	//print ("<tr align=centeR valign=middle>");

/**
 * setPointer/unsets the pointer and marker in browse mode
 *
 * @param   object    the table row
 * @param   interger  the row number
 * @param   string    the action calling this script (over, out or click)
 * @param   string    the default background color
 * @param   string    the color to use for mouseover
 * @param   string    the color to use for marking a row
 *
 * @return  boolean  whether pointer is set or not
 */

//$RowNumber++;
//print("$RowNumber");

print ("\n<tr align=center valign=middle>");
//print ("\n<tr align=center valign=middle            onmouseover=\"setPointer(this, '$Row[ApplicantName]', $RowNumber, ");
//print ("'over', '#FFFFFF', '#CCFFCC', '#FFCC99');\"  onmouseout=\"setPointer(this, '$Row[ApplicantName]', $RowNumber, ");
//print ("'out', '#FFFFFF', '#CCFFCC', '#FFCC99');\" onmousedown=\"setPointer(this, '$Row[ApplicantName]', $RowNumber, ");
//print ("'click', '#FFFFFF', '#CCFFCC', '#FFCC99');\">\n");
	
	print ("<td bgcolor='#CCCCCC'>");

	$Row[ApplicantName] = GetBorrower($Row[SSN], $Link, $UserLevel);

	$URLvar= 'SSN='					.$Row[SSN]
			.'&RequestedLoanAmount='.$Row[RequestedLoanAmount]
			.'&LoanPurpose='		.urlencode($Row[LoanPurpose])
			.'&PurchasePrice='		.$Row[PurchasePrice]
			.'&EstimatedValue='		.$Row[EstimatedValue]
			.'&LenderNameOn1st='	.$Row[LenderNameOn1st]
			.'&BalanceOn1st='		.$Row[BalanceOn1st]
			.'&InterestRateOn1st='	.$Row[InterestRateOn1st]
			.'&MonthlyPaymentOn1st='.$Row[MonthlyPaymentOn1st]
			.'&Impounds='			.$Row[Impounds]
			.'&LenderNameOn2nd='	.$Row[LenderNameOn2nd]
			.'&BalanceOn2nd='		.$Row[BalanceOn2nd]
			.'&InterestRateOn2nd='	.$Row[InterestRateOn2nd]
			.'&MonthlyPaymentOn2nd='.$Row[MonthlyPaymentOn2nd]
			.'&CreditReport='		.$Row[CreditReport]
			.'&ApplicantName='		.$Row[ApplicantName]
			;

	print ("<a href='LoanMaintenance.php?$URLvar&RequestType=Update'>Edit</a></td>\n");

	print ("<td bgcolor='#CCCCCC'>\n");

	if ($UserLevel != "Admin")
		print ("<a href='FunctionDisabled.php'>Delete</a></td>\n");
	else
		print ("<a href='LoanUpdate.php?$URLvar&RequestType=Delete'>Delete</a></td>\n");

	$SavedSSN = $Row[SSN];

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
			$TempField= 'xxx-xx-'.substr($Row[SSN],5,4);
		else
			$TempField= substr($Row[SSN],0,3).'-'.substr($Row[SSN],3,2).'-'.substr($Row[SSN],5,4);

		$Row[SSN]=$TempField;
	}

	if($SortColumn == 'SSN')
		print ("<td align=center bgcolor='#FFECEC' valign=middle>");
	else
		print ("<td align=center valign=middle>");
		
	print ("<font face='Verdana' size='2' color='#000099'>$Row[SSN]</font></td>\n");



	$Row[ApplicantName] = GetBorrower($SavedSSN, $Link, $UserLevel);

	if($SortColumn == 'ApplicantName')
		print ("<td align='left' bgcolor='#FFECEC' valign=middle>");
	else
		print ("<td align='left' bgcolor='#FFFFFF' valign=middle>");
		
	print ("<font face='Verdana' size='2' color='#000099'>$Row[ApplicantName]</font></td>\n");

	if($SortColumn == 'Amount')
		print ("<td align='right' bgcolor='#FFECEC' valign=middle>");
	else
		print ("<td align='right' bgcolor='#FFFFFF' valign=middle>");
		
	print ("<font face='Verdana' size='2' color='#000099'>$$Row[RequestedLoanAmount].&nbsp;</font></td>\n");


	if($SortColumn == 'Purpose')
		print ("<td align='left' bgcolor='#FFECEC' valign=middle>");
	else
		print ("<td align='left' valign=middle>");
		
	if ($Row[LoanPurpose] == null)
		print ("<font face='Verdana' size='2' color='#000099'>&nbsp;</font></td>\n");
	else
		print ("<font face='Verdana' size='2' color='#000099'>$Row[LoanPurpose]</font></td>\n");

	if($SortColumn == 'Original')
		print ("<td align='right' bgcolor='#FFECEC' valign=middle>");
	else
		print ("<td align='right' valign=middle>");
		
	print ("<font face='Verdana' size='2' color='#000099'>$$Row[PurchasePrice].&nbsp;</font></td>\n");

	if($SortColumn == 'EstValue')
		print ("<td align='right' bgcolor='#FFECEC' valign=middle>");
	else
		print ("<td align='right' valign=middle>");
		
	print ("<font face='Verdana' size='2' color='#000099'>$$Row[EstimatedValue].&nbsp;</font></td>\n");

	if($SortColumn == '1stLender')
		print ("<td align='left' bgcolor='#FFECEC' valign=middle>");
	else
		print ("<td align='left' valign=middle>");
		

	if ($Row[LenderNameOn1st] == null)
		print ("<font face='Verdana' size='2' color='#000099'>&nbsp;</font></td>\n");
	else
		print ("<font face='Verdana' size='2' color='#000099'>$Row[LenderNameOn1st]</font></td>\n");


	if($SortColumn == '1stBalance')
		print ("<td align='right' bgcolor='#FFECEC' valign=middle>");
	else
		print ("<td align='right' valign=middle>");
		
	print ("<font face='Verdana' size='2' color='#000099'>$$Row[BalanceOn1st].&nbsp;</font></td>\n");

	if($SortColumn == '1stIntRate')
		print ("<td align='right' bgcolor='#FFECEC' valign=middle>");
	else
		print ("<td align='right' valign=middle>");
		
	print ("<font face='Verdana' size='2' color='#000099'>".($Row[InterestRateOn1st] * 100)."%</font></td>\n");


	if($SortColumn == '1stPayment')
		print ("<td align='right' bgcolor='#FFECEC' valign=middle>");
	else
		print ("<td align='right' valign=middle>");
			
	print ("<font face='Verdana' size='2' color='#000099'>$$Row[MonthlyPaymentOn1st].&nbsp;</font></td>\n");


	if($SortColumn == 'Impounds')
		print ("<td align=center bgcolor='#FFECEC' valign=middle>");
	else
		print ("<td align=center valign=middle>");
		
	if ($Row[Impounds] == "")
		print ("<font face='Verdana' size='2' color='#000099'>&nbsp;</font></td>\n");
	else
		print ("<font face='Verdana' size='2' color='#000099'>$Row[Impounds]</font></td>\n");

	if($SortColumn == '2ndLender')
		print ("<td align='left' bgcolor='#FFECEC' valign=middle>");
	else
		print ("<td align='left' valign=middle>");
		
	if ($Row[LenderNameOn2nd] == null)
		print ("<font face='Verdana' size='2' color='#000099'>&nbsp;</font></td>\n");
	else
		print ("<font face='Verdana' size='2' color='#000099'>$Row[LenderNameOn2nd]</font></td>\n");

	if($SortColumn == '2ndBalance')
		print ("<td align='right' bgcolor='#FFECEC' valign=middle>");
	else
		print ("<td align='right' valign=middle>");
		

	if ($Row[BalanceOn2nd] != 0)
		print ("<font face='Verdana' size='2' color='#000099'>$$Row[BalanceOn2nd].&nbsp;</font></td>\n");
	else
		print ("<font face='Verdana' size='2' color='#000099'>&nbsp;</font></td>\n");


	if($SortColumn == '2ndIntRate')
		print ("<td align='right' bgcolor='#FFECEC' valign=middle>");
	else
		print ("<td align='right' valign=middle>");
		
	if ($Row[BalanceOn2nd] != 0)
		print ("<font face='Verdana' size='2' color='#000099'>".($Row[InterestRateOn2nd] * 100)."%</font></td>\n");		
	else
		print ("<font face='Verdana' size='2' color='#000099'>&nbsp;</font></td>\n");
	

	if($SortColumn == '2ndPayment')
		print ("<td align='right' bgcolor='#FFECEC' valign=middle>");
	else
		print ("<td align='right' valign=middle>");
		
	if ($Row[BalanceOn2nd] != 0)
		print ("<font face='Verdana' size='2' color='#000099'>$$Row[MonthlyPaymentOn2nd].&nbsp;</font></td>\n");
	else
		print ("<font face='Verdana' size='2' color='#000099'>&nbsp;</font></td>\n");



	if($SortColumn == 'LoanStatus')
		print ("<td align='left' bgcolor='#FFECEC' valign=middle>");
	else
		print ("<td align='left' valign=middle>");

	if ($Row[LoanStatus] == null)
		print ("<font face='Verdana' size='2' color='#000099'>&nbsp;</font></td>\n");
	else
		print ("<font face='Verdana' size='2' color='#000099'>$Row[LoanStatus]</font></td>\n");

	print ("</tr>\n"); // end of row
	/*
	print("Row:<br>\n");
	echo ("<pre>\n");
	print_r ($Row);
	echo ("</pre>\n");
	*/
}



/* -------------------------------------------				*/
/*															*/
/*	Gets the name associated with a ss# from the database	*/
/*															*/
/*--------------------------------------------				*/
function GetBorrower($MySSN, $Link, $UserLevel)
{
	$Host="localhost";
	//$User="lightnin_Tony";
	//$Password="ipowerwe";
	$DBname="lightnin_LoanApps";
	$TableName="ApplicantInfo";
	global $DateInserted;
	global $BorrowerResult;

	$TempField = ereg_replace("[^[:digit:]]", "", $MySSN);

	$Query = "SELECT * from $TableName where SSN = $TempField";
	/*print ("In GetBorrower () Query is $Query<br>\n");*/

	$BorrowerResult=mysql_query($Query, $Link); // look for the match


	if (!mysql_query ($Query, $Link)) // check the BorrowerResults of the query
	{
		print ("Line ".__LINE__." Error-->Link |$Link|<br>\n");

		print ("<br><center><font face='Verdana' size='5' color='#000099'><strong>Warning!</strong></font><br><br>");
		print ("<font face='Verdana' size='2' color='#000099'>ApplicantTable Record Not Found.<br><br>\n");
		print ("Social Security Number<font face='Verdana' size='3' color='#000099'>'$MySSN' </font>");
		print ("<font face='Verdana' size='2' color='#000099'>was the passed Social Security Number.</font><br>\n");

		echo mysql_errno() . ": " . mysql_error(). "\n";
		mysql_close($Link);
		die ("Error in GetBorrower()");
	}

	$Record=mysql_fetch_array($BorrowerResult);	// fetch the matching row in the ApplicantInfo table

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
/*	SelectRecords: Takes the existing $Link from the mysql_connect() function, which points to the database on the 	*/
/*	server and the $TableName that specifies the particular table in the database to retrieve matching records in  	*/
/*	the order dictated bythe $SortColumn variable.																	*/
/*																													*/
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/

function SelectRecords ($SortColumn, $DBname, $TableName, $Link)
{
	global $LoanQuery;
	
	$LoanQuery = "SELECT * from $TableName order by SSN";

	switch ($SortColumn)
	{
		case "SSN":
			$LoanQuery = "SELECT * from $TableName order by SSN";   // This is the default
			break;

		case "ApplicantName":
			$Table2Name="ApplicantInfo"; // If sort of list is by ApplicantName,  we must read/join 2 different tables
			$LoanQuery = "SELECT * from $TableName, $Table2Name where $TableName.SSN=$Table2Name.SSN order by ApplicantLastName";
			break;

		case "LoanStatus":
			$Table2Name="ApplicantInfo"; // If sort of list is by ApplicantName,  we must read/join 2 different tables
			$LoanQuery = "SELECT * from $TableName, $Table2Name where $TableName.SSN=$Table2Name.SSN order by LoanStatus";
			break;

		case "Amount":
			$LoanQuery = "SELECT * from $TableName order by RequestedLoanAmount";
			break;

		case "Purpose":
			$LoanQuery = "SELECT * from $TableName order by LoanPurpose";
			break;

		case "Original":
			$LoanQuery = "SELECT * from $TableName order by PurchasePrice";
			break;

		case "EstValue":
			$LoanQuery = "SELECT * from $TableName order by EstimatedValue";
			break;

		case "1stLender":
			$LoanQuery = "SELECT * from $TableName order by LenderNameOn1st";
			break;

		case "1stBalance":
			$LoanQuery = "SELECT * from $TableName order by BalanceOn1st";
			break;

		case "1stIntRate":
			$LoanQuery = "SELECT * from $TableName order by InterestRateOn1st";
			break;

		case "1stPayment":
			$LoanQuery = "SELECT * from $TableName order by MonthlyPaymentOn1st";
			break;
			
		case "Impounds":
			$LoanQuery = "SELECT * from $TableName order by Impounds";
			break;
			
		case "2ndLender":
			$LoanQuery = "SELECT * from $TableName order by LenderNameOn2nd";
			break;

		case "2ndBalance":
			$LoanQuery = "SELECT * from $TableName order by BalanceOn2nd";
			break;

		case "2ndIntRate":
			$LoanQuery = "SELECT * from $TableName order by InterestRateOn2nd";
			break;

		case "2ndPayment":
			$LoanQuery = "SELECT * from $TableName order by MonthlyPaymentOn2nd";
			break;

		default:
			$Table2Name="ApplicantInfo"; // If sort of list is by ApplicantName,  we must read/join 2 different tables
			$LoanQuery = "SELECT * from $TableName, $Table2Name where $TableName.SSN=$Table2Name.SSN order by ApplicantLastName";
			break;
	}

	//print ("On Line ".__LINE__." SortColumn = '$SortColumn' Query = '$LoanQuery'<br>\n");

    $Result=mysql_query($LoanQuery, $Link);

	return($Result);
}


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//
//																													//
// PaginateDisplay: We need to run through the database twice.														//
//					The first time is simply to count the number of records that will actually be displayed.		//
//					The second time is to actually display the records that match the previously chosen criteria.	//
//																													//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//

function PaginateDisplay($RowNumber, $Row, $Link, $UserLevel, $DateInserted, $CountOrDisplay)
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

	//die("DateInserted $Row[DateInserted] -  YY $year MM $month DD $day - $CompareDate - $FromDate - $ToDate");

	if (($CompareDate >= $FromDate) && ($CompareDate <= $ToDate))
	{

		$Row[LoanStatus] = GetLoanStatus($Row[SSN], $Link);

		//print ("On Line ".__LINE__." SavedFilter = |$SavedFilter|   LoanStatus =|$Row[LoanStatus]| SSN =|$Row[SSN]|<br>\n");

		if ($SearchTerm != "")
		{	// look through the xxx and associated ApplicantName columns in the row for a match of the search term

			if (stristr($Row[RequestedLoanAmount], $SearchTerm))
			{
				$Count = true;
				if ($CountOrDisplay == 'Display')
					DisplayFormattedRow($RowNumber, $Row, $Link, $UserLevel);
			}

			elseif (stristr($Row[PurchasePrice], $SearchTerm))
			{
				$Count = true;
				if ($CountOrDisplay == 'Display')
					DisplayFormattedRow($RowNumber, $Row, $Link, $UserLevel);
			}

			elseif (stristr($Row[LoanPurpose], $SearchTerm))
			{
				$Count = true;
				if ($CountOrDisplay == 'Display')
					DisplayFormattedRow($RowNumber, $Row, $Link, $UserLevel);
			}

			elseif (stristr($Row[LenderNameOn1st], $SearchTerm))
			{
				$Count = true;
				if ($CountOrDisplay == 'Display')
					DisplayFormattedRow($RowNumber, $Row, $Link, $UserLevel);
			}

			elseif (stristr($Row[BalanceOn1st], $SearchTerm))
			{
				$Count = true;		
				if ($CountOrDisplay == 'Display')
					DisplayFormattedRow($RowNumber, $Row, $Link, $UserLevel);
			}

			elseif (stristr($Row[InterestRateOn1st], $SearchTerm))
			{
				$Count = true;		
				if ($CountOrDisplay == 'Display')
					DisplayFormattedRow($RowNumber, $Row, $Link, $UserLevel);
			}

			elseif (stristr($Row[MonthlyPaymentOn1st], $SearchTerm))
			{
				$Count = true;		
				if ($CountOrDisplay == 'Display')
					DisplayFormattedRow($RowNumber, $Row, $Link, $UserLevel);
			}

			elseif (stristr($Row[Impounds], $SearchTerm))
			{
				$Count = true;			
				if ($CountOrDisplay == 'Display')
					DisplayFormattedRow($RowNumber, $Row, $Link, $UserLevel);
			}

			elseif (stristr($Row[LenderNameOn2nd], $SearchTerm))
			{
				$Count = true;
				if ($CountOrDisplay == 'Display')	
					DisplayFormattedRow($RowNumber, $Row, $Link, $UserLevel);
			}

			elseif (stristr($Row[BalanceOn2nd], $SearchTerm))
			{
				$Count = true;
				if ($CountOrDisplay == 'Display')
					DisplayFormattedRow($RowNumber, $Row, $Link, $UserLevel);
			}

			elseif (stristr($Row[InterestRateOn2nd], $SearchTerm))
			{
				$Count = true;
				if ($CountOrDisplay == 'Display')		
					DisplayFormattedRow($RowNumber, $Row, $Link, $UserLevel);
			}

			elseif (stristr($Row[MonthlyPaymentOn2nd], $SearchTerm))
			{
				$Count = true;
				if ($CountOrDisplay == 'Display')		
					DisplayFormattedRow($RowNumber, $Row, $Link, $UserLevel);
			}

			elseif (stristr($ApplicantName, $SearchTerm))
			{
				$Count = true;
				if ($CountOrDisplay == 'Display')		
					DisplayFormattedRow($RowNumber, $Row, $Link, $UserLevel);
			}
		}
		else
		{
			if (($SavedFilter == "All") || ($SavedFilter == $Row[LoanStatus]))//LoanStatus is part of ApplicantInfo table
			{
				//print ("Line ".__LINE__." Display Record<br>\n");
				$Count = true;
				if ($CountOrDisplay == 'Display')	
					DisplayFormattedRow($RowNumber, $Row, $Link, $UserLevel);
			}
		}
	}
	
	return ($Count);
}


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//
//																									//
//	LoanList: This page retrieves and displays the data in the database table 'LoanInfo'	 		//
//	A list filter is passed from other pages as a variable "$SavedFilter" and is used to list  		//
//	records with the matching Loan Status.															//
//																									//
//																									//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//

// Always remember when you do a print ("$variable...); the variable's value will be substituted.
// When you use a single quote, print ('$variable...); the value WILL NOT be substituted.

/* variables to access Database */

	$Host="localhost";
	$DBname="lightnin_LoanApps";
	$TableName="LoanInfo";

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

	//print ("After reading URL parameters on line ".__LINE__.", Sort Column:|$SortColumn| - Saved Filter:|$SavedFilter|<br>\n");

	/* -*-*-*-*-*-*-*-*-*-*-*-*-*-*-* Header Row of Table *-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*- */

	// to debug cell width use border='1' and bordercolor='#CCCCCC'
	print ("<table border='0' bordercolor='#CCCCCC width='190%'cellpadding='4' cellspacing='0' align='center'>");
	print ("<tr align='center' valign='top'>");
	print ("<form action='ApplicantMaster.php'>");
	print ("<td align='center' width='2%' valign='middle' bgcolor='#003399'>\n");

	print ("<p><input class='Submit' type='submit' value='LAPS Home' style='color:#fff;'></p></td></form>");

	print ("<td align='center' valign='middle' width='19%' bgcolor='#003399'>");
    print ("<a class='Logo' href='http://www.lightning-mortgage.com/index.php'>");
    print ("<img border='0' src='../images/Lightning-Mortgage.jpg' align='center' ");
    print ("alt='Lightning Mortgage - Mortgage Finance and Refinance'></a></td>");

	print ("<td align='left' width='15%' colspan='3' valign='middle' bgcolor='#003399'>\n");
	DisplayReportingPeriodRangeOptions();
	print ("</td><td width='70%' bgcolor='#003399'>&nbsp;</td></tr></table>\n");

	print ("<table width='100%'><form name='FilterIt' action='LoanList.php' method='post'>");
	print ("<td align='left' width='25%' valign='middle'>");
	print ("&nbsp;&nbsp;<input type='submit' value='Clear' onclick='window.document.FilterIt.SearchTerm.value=\"\"'>\n");

	if ($SearchTerm != "")
		print ("&nbsp;&nbsp;<input type='text' style='background: #FFFF00' name='SearchTerm' value='$SearchTerm'size='20'>&nbsp;&nbsp;");
	else
		print ("&nbsp;&nbsp;<input type='text' name='SearchTerm' value='$SearchTerm' size='20'>&nbsp;&nbsp;");

	print ("<input type='submit' name'Search' value='Search'></td>\n");

	print ("<td align='center' width='35%' valign='middle'><font face='Verdana' size='3' color='#000099'>");

	print ("<table border='1' bordercolor='#000099' cellpadding='2' cellspacing='0'>");
	print ("<td bgcolor='#003399'><a class='Top' href='./WorkingStatusList.php'>Daily Status</a></td>");
	print ("<td bgcolor='#9C319C'><a class='Top' href='./ApplicantList.php'>Applicant</a></td>");
	print ("<td bgcolor='#397352'><a class='Top' href='./ContactList.php'>Contact</a></td>");
	print ("<td style='background:#CE6300;'><span style='font:small bolder Verdana,Geneva,Arial,Helvetica,sans-serif;color:yellow;'>Loan</span></td>");
	print ("<td bgcolor='#9C9C31'><a class='Top' href='./EmploymentList.php'>Employment</a></td>");
	print ("</table></td>\n");

	print ("<td align='right' width='14%' valign='middle'><font face='Verdana' size='2' color='#000099'>");
	print ("Filter By Status&nbsp;</font></td>\n");

	print ("<td align='Left' width='8%' valign='middle'><font face='Verdana' size='2' color='#000099'>");
	FilterStatus();
	print ("</td><td align=center valign=middle width='8%'><font face='Verdana' size='3' color='#000099'>&nbsp;</td></font>");
	print ("</tr>\n");
	print ("</font></form></table>\n");
	
	

	/* *-*-*-*-*-*-*-*-*-*- Title Row: Create a screen table for displaying the data, print the Title row -*-*-*-*-*-*/

	print ("<table border=1 bordercolor='#000099' cellpadding=3 cellspacing='0' align=center width='190%'>\n");

	$xxx = $SavedFilter;

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
	/*	When control passes back to this page (from LoanUpdate or LoanMaintenance) we 						*/
	/*	will want to use the same filtering criteria for displaying the list of table entries that we are	*/
	/*	presently using to display records for the user. We use a <form> to pass the this filter variable	*/
	/*	to LoanMaintenace.																					*/
	/*																										*/
	/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/

	// print ("On line ".__LINE__." xxx=$xxx");

	print ("<tr align=center valign=middle>\n");
	print ("<form action='LoanMaintenance.php' method='post'>");
	print ("<input type='hidden' name=RequestType value='Insert'>");

	/* we'll put the "Add New" button in this cell */

	print ("<td align=center height='10' width='3%' valign=middle colspan='2' bgcolor='#CCCCCC'><font face='Verdana' size='2' color='#000099'>");
	print ("<input type='submit' name='submit' value='Add New'");
	print ("title='Click to Add a New Record'>");
	print ("</td></form>\n");

	/* print the Headings row in the table using white characters on a blue background.*/

	/* Header row has "sort by" column headers. When you click on a header name, the database is reread and redisplayed */
	/* Set the order of the records retrieved according to $SortColumn */

	//print ("On Line ".__LINE__." SortColumn = |$SortColumn| Result=|$Result|  DBname =|$DBname| TableName =|$TableName| Link=|$Link|<br>\n");


	if ($SortColumn == 'SSN')
		print ("<td align=center valign='middle' width='7%' bgcolor='#CE6300'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center valign='middle' width='7%' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");

	print ("<font face='Verdana' strong size='2' color='#FFFFFF'>");
	print ("<form action='$PHP_SELF' method='post'>");
	print ("<input type='submit' name='SortColumn' value='SSN'>");	/* Social Security button */
	print ("</td></form>");

	if ($SortColumn == 'ApplicantName')
		print ("<td align=center valign='middle' width='10%' bgcolor='#CE6300'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center valign='middle' width='10%' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");

	print ("<form action='$PHP_SELF' method='post'>");
	print ("<input type='submit' name='SortColumn' value='ApplicantName'>");	/* Applicant button */
	print ("</td></form>\n");

	if ($SortColumn == 'Amount')
		print ("<td align=center valign='middle' width='2%' bgcolor='#CE6300'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center valign='middle' width='2%' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");

	print ("<form action='$PHP_SELF' method='post'>");
	print ("<input type='submit' name='SortColumn' value='Amount'>");	/* Loan Amount button */
	print ("</td></form>\n");

	if ($SortColumn == 'Purpose')
		print ("<td align=center valign='middle' width='13%' bgcolor='#CE6300'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center valign='middle' width='13%' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");

	print ("<form action='$PHP_SELF' method='post'>");
	print ("<input type='submit' name='SortColumn' value='Purpose'>");	/* Loan Purpose button */
	print ("</td></form>\n");

	if ($SortColumn == 'Original')
		print ("<td align=center valign='middle' width='3%' bgcolor='#CE6300'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center valign='middle' width='3%' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");

	print ("<form action='$PHP_SELF' method='post'>");
	print ("<input type='submit' name='SortColumn' value='Original'>");	/* Purchase Price button */
	print ("</td></form>\n");

	if ($SortColumn == 'EstValue')
		print ("<td align=center valign='middle' width='3%' bgcolor='#CE6300'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center valign='middle' width='3%' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");

	print ("<form action='$PHP_SELF' method='post'>");
	print ("<input type='submit' name='SortColumn'  value='EstValue'>");	/* EstimatedValue button */
	print ("</td></form>\n");

	if ($SortColumn == '1stLender')
		print ("<td align=center valign='middle' width='10%' bgcolor='#CE6300'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center valign='middle' width='10%' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");

	print ("<form action='$PHP_SELF' method='post'>");
	print ("<input type='submit' name='SortColumn' value='1stLender'>");	/* Lender button */
	print ("</td></form>\n");

	if ($SortColumn == '1stBalance')
		print ("<td align=center valign='middle' width='3%' bgcolor='#CE6300'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center valign='middle' width='3%' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");

	print ("<form action='$PHP_SELF' method='post'>");
	print ("<input type='submit' name='SortColumn' value='1stBalance'>");	/* Balance button */
	print ("</td></form>\n");

	if ($SortColumn == '1stIntRate')
		print ("<td align=center valign='middle' width='2%' bgcolor='#CE6300'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center valign='middle' width='2%' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");

	print ("<form action='$PHP_SELF' method='post'>");
	print ("<input type='submit' name='SortColumn' value='1stIntRate'>");	/* IntRate button */
	print ("</td></form>\n");

	if ($SortColumn == '1stPayment')
		print ("<td align=center valign='middle' width='4%' bgcolor='#CE6300'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center valign='middle' width='4%' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");

	print ("<form action='$PHP_SELF' method='post'>");
	print ("<input type='submit' name='SortColumn' value='1stPayment'>");	/* Monthly Payment button */
	print ("</td></form>\n");

	if ($SortColumn == 'Impounds')
		print ("<td align=center valign='middle' width='2%' bgcolor='#CE6300'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center valign='middle' width='2%' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");

	print ("<form action='$PHP_SELF' method='post'>");
	print ("<input type='submit' name='SortColumn' value='Impounds'>");	/* Impounds button */
	print ("</td></form>\n");

	if ($SortColumn == '2ndLender')
		print ("<td align=center valign='middle' width='10%' bgcolor='#CE6300'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center valign='middle' width='10%' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");

	print ("<form action='$PHP_SELF' method='post'>");
	print ("<input type='submit' name='SortColumn' value='2ndLender'>");	/* Lender button */
	print ("</td></form>\n");

	if ($SortColumn == '2ndBalance')
		print ("<td align=center valign='middle' width='3%' bgcolor='#CE6300'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center valign='middle' width='3%' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");

	print ("<form action='$PHP_SELF' method='post'>");
	print ("<input type='submit' name='SortColumn' value='2ndBalance'>");	/* Balance button */
	print ("</td></form>\n");

	if ($SortColumn == '2ndIntRate')
		print ("<td align=center valign='middle' width='2%' bgcolor='#CE6300'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center valign='middle' width='2%' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");

	print ("<form action='$PHP_SELF' method='post'>");
	print ("<input type='submit' name='SortColumn' value='2ndIntRate'>");	/* IntRate button */
	print ("</td></form>\n");

	if ($SortColumn == '2ndPayment')
		print ("<td align=center valign='middle' width='4%' bgcolor='#CE6300'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center valign='middle' width='4%' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");

	print ("<form action='$PHP_SELF' method='post'>");
	print ("<input type='submit' name='SortColumn' value='2ndPayment'>");	/* Monthly Payment button */
	print ("</td></form>\n");

	if ($SortColumn == 'LoanStatus')
		print ("<td align=center valign='middle' width='10%' bgcolor='#CE6300'><font face='Verdana' strong size='2' color='#FFFFFF'>");
	else
		print ("<td align=center valign='middle' width='10%' bgcolor='#CCCCCC'><font face='Verdana' strong size='2' color='#FFFFFF'>");

	print ("<form action='$PHP_SELF' method='post'>");
	print ("<input type='submit' name='SortColumn' value='LoanStatus'>");	/* Loan Status */
	print ("</td></form>\n");
	print ("</tr>"); 
	
	// *-*-*-*-*-*-*-*-*-*-*-*-*-*-*-* End of Header Rows *-*-*-*-*-*-*-*-*-*-*-*-*-*
	
	$Result; //for LoanInfoTable
	$LoanQuery;
	
	$BorrowerResult; //for ApplicantInfoTable (looking up ApplicantName)
	$LoanStatusResult; //for ApplicantInfoTable (looking up the LoanStatus)
	

	/* First, connect to the MySQL DBMS on this server */
	
	$Link=mysql_connect ($Host, $User, $Password) or die ('I cannot connect to the DBMS because: '.mysql_error());

	// Now fetch ALL the Loan data from the database 
	
	$Result = SelectRecords($SortColumn, $DBname, $TableName, $Link);
	
	//print ("On Line ".__LINE__." \$Link = |$Link| \$Result = |$Result|<br>\n");

	$DateInserted; //must declare veriable before using the global keyword in a function


	// Let's process the Loan Table's records that have been sorted according to the $ColumnSort value
	// First we want to count the number of rows that actually meet the other filter and Search criteria
	
	$TotalRows = 0;
	$MatchingRow = array_fill(0, 5000, 0); //Create the array to handle tables with up to 5000 rows
	$x = 0;
	
	// The challenge is: All rows in the table will not be printed. So we must determine which rows should
	// be printed so we can later jump to those rows as we later page through the Table.
	
	while ($Row=mysql_fetch_array($Result))
	{
		//print ("Line ".__LINE__." LoanInfoTable.SSN=|$Row[SSN]|<br>\n");
		
		$ApplicantName = GetBorrower($Row[SSN], $Link, $UserLevel);

		//was list($month, $day, $year) = sscanf($DateInserted, "%02d/%02d/%02d");// reformat MM/DD/YY date
		list($year, $month, $day) = sscanf($DateInserted, "%02d/%02d/%02d");// reformat YY/MM/DD date
		$CompareDate = sprintf("%02d%02d%02d", $year, $month, $day);			// to YYMMDD

		//print("DateInserted $Row[DateInserted] -  YY $year MM $month DD $day - $CompareDate - $FromDate - $ToDate<br>\n");

		// The Number of rows that will be displayed is counted,

		if (PaginateDisplay($x, $Row, $Link, $UserLevel, $DateInserted, 'Count'))
		{
			$MatchingRow[$TotalRows] = $x;
			//print ("Line ".__LINE__." Record match: \$MatchingRow[$TotalRows] = |$MatchingRow[$TotalRows]| \$ApplicantName = |$ApplicantName|<br>\n");
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
	$RowsPerPage = 16;
	
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


	//print ("On Line ".__LINE__." This page's first row = |$ThisRow|<br>\n");
	
	//print ("Line ".__LINE__." \$Link = |$Link| \$LoanQuery=|$LoanQuery|<br>\n");

	$x = 0;	// Set counter for the row number on the page to zero
	
	while (($Row=mysql_fetch_array($Result)) && ($x <= $EndRow) && ($x < $RowsPerPage))//print up to 16 rows
	{
		//print ("Line ".__LINE__." processing row \$x=|$x|<br>\n");
		
		$ApplicantName = GetBorrower($Row[SSN], $Link, $UserLevel);

		//was list($month, $day, $year) = sscanf($DateInserted, "%02d/%02d/%02d");// reformat MM/DD/YY date
		list($year, $month, $day) = sscanf($DateInserted, "%02d/%02d/%02d");// reformat YY/MM/DD date
		$CompareDate = sprintf("%02d%02d%02d", $year, $month, $day);			// to YYMMDD

		//die("DateInserted $Row[DateInserted] -  YY $year MM $month DD $day - $CompareDate - $FromDate - $ToDate");

		// Display the row if it meets all criteria
		if (PaginateDisplay($x, $Row, $Link, $UserLevel, $DateInserted, 'Display'))
		{
			//print ("Line ".__LINE__." \$MatchingRow[$TotalRows] = |$MatchingRow[$TotalRows]| \$ApplicantName = |$ApplicantName|");
			$x++;
		}
	}

	if (!empty($_GET[Page])) // This is the passed parameter. If over rides the cookie value if not on the first page
		$Page= $_GET[Page];
	
	if($Page > 1)  // This is the cookie value. If not on the first page
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
          
        print ("  <a href=\"$PHP_SELF?Page=$Pagenext\"><b>Next</b></a> <FONT color=red>�</FONT>"); //create a link to the next page
    }
    else
    { 
        print ("<font face='Verdana' strong size='2' color='#000099'>  Next <FONT color=red>�</FONT>"); //simulate the hyperlink to the non-existent next page
    }     

	//die ("end");
	//print ("<input type='hidden' name=RequestType 		value='Insert'>\n");
	//print ("</form>");
	mysql_close($Link);
?>
</body>
</html>
