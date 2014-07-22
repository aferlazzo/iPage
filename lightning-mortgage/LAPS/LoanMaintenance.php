<?php
require ("../include/authenticate.php");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<html>
<head>
<title>LoanMaintenance</title>
<script language="JavaScript" src="https://host373.ipowerweb.com/~lightnin/js/Common.js"></script>
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

<!--
* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
*																												*/
*	LoanMaintenance - This page is user interface page for adding and chaging Loan table entries.				*/
*	It displays a record from the table. 																		*/
*																												*/
* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
-->


<script language="JavaScript">

/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */
/*																												*/
/*	Validate()	This JavaScript function is called by the html onSubmit object prior to the page passing the 	*/
/*	the user to the LoanUpdate page (which performs the actual my_SQL database queries). The function		*/
/*	simply verifies the user input prior to the database updating page.											*/
/*																												*/
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */

function Validate()
{
	/*
	alert("In Validate() passed LoanInfo.elements[0] is |" + document.LoanInfo.elements[0].value + "|");
	alert("In Validate() passed LoanInfo.elements[1] is |" + document.LoanInfo.elements[1].value + "|");
	alert("In Validate() passed LoanInfo.elements[2] is |" + document.LoanInfo.elements[2].value + "|");
	alert("In Validate() passed LoanInfo.elements[3] is |" + document.LoanInfo.elements[3].value + "|");
	alert("In Validate() passed LoanInfo.elements[4] is |" + document.LoanInfo.elements[4].value + "|");
	alert("In Validate() passed LoanInfo.elements[5] is |" + document.LoanInfo.elements[5].value + "|");
	alert("In Validate() passed LoanInfo.elements[6] is |" + document.LoanInfo.elements[6].value + "|");
	alert("In Validate() passed LoanInfo.elements[7] is |" + document.LoanInfo.elements[7].value + "|");

	alert("In Validate() passed SavedLoanStatus is |" + document.LoanInfo.SavedLoanStatus.value + "|");
	alert("In Validate() SavedLoanStatus length is |" + document.LoanInfo.SavedLoanStatus.value.length + "|");
	document.writeln("A writeln is |" + document.LoanInfo.SavedLoanStatus.value + "|");
	*/

	if (document.LoanInfo.SSN.value.length != 11)   /* check the length of the SS Numbers */
	{
	  alert("SSN length error: Must be 11 characters");
	  document.LoanInfo.SSN.focus();
	  return(false);
	}
}
</script>
</head>

<body>
<!--
#	/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
#	/*																									*/
#	/*	LoanMaintenance.php - This current page has to pass the variables value to the Loan 	*/
#	/*	Update page, or back to the Loan List page (whichever one is called from here, depending 	*/
#	/*	on user input).																					*/
#	/*																									*/
#	/*																									*/
#	/*	Calls LoanUpdate.php. Passes the variables .....												*/
#	/*																									*/
#	/*	Calls LoanList.php. Passes .................													*/
#	/*																									*/
#	/*																									*/
#	/*	Sample of URL string: 																			*/
#	/*																									*/
#	/*																									*/
#	/*																									*/
#	/*	LoanUpdate.php  calls this page. It passes the variable $SavedLoanStatus 						*/
#	/*	LoanList.php calls this page.																	*/																								*/
#	/*																									*/
#	/*																									*/
#	/* We must do this because once the update of an existing record or the insertion of a new record	*/
#	/* is performed, this LoanUpdate page will return	the user to the LoanList.php page. 	*/
#	/* We want to maintain the current filter & continue the same list when we return. Since the Loan 	*/
#	/* of this current record may be changed by user input in the course of executing this page, we 	*/
#	/* save the value of this variable and pass it back when returning to the LoanList page. 		*/
#	/*																									*/
#	/* Returning to the List page directly from here (that is, without updating the database/without	*/
#	/* transferring control to the LoanUpdate page) is done by the user when he presses the Reset 	*/
#	/* button. The onClick method passes the URL and filter 			.								*/
#	/*																									*/
#	/* When records are being updated, we pass the saved value to the LoanUpdate page using this	*/
#	/* hidden field for Saved Loan Status to the LoanUpdate page. It is passed with the other form */
#	/* fields using the built-in <form> variable passing functionality.									*/
#	/*																									*/
#	/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
-->
<?php

	// print ("RequestType='$RequestType'<br>\n");
	// print ("<b>SSN:$SSN, Loan Name:$LoanName</b><br>\n");
/*
	print ("(<pre>");
	print_r ($_GET);
	print ("(</pre>");
*/

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

	if ($SSN > 0)
	{
		if($UserLevel != "Admin")
			$TempField = 'xxx-xx-'.substr($SSN,5,4);
		else
			$TempField = substr($SSN,0,3).'-'.substr($SSN,3,2).'-'.substr($SSN,5,4);

		$SSN=$TempField;
	}
	else
		$SSN="";

	$LoanPurpose=urldecode($_GET[LoanPurpose]);

	//print ("LoanPurpose |$LoanPurpose|<br>\n");

/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
/*																					*/
/* Start of a new form, necessary to inputs and/or display the fields for the table	*/
/*																					*/
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/

	if ($UserLevel != "Admin")
		print ("<form name='LoanInfo' action='FunctionDisabled.php' method='get' onSubmit='return(Validate());'>");
	else
		print ("<form name='LoanInfo' action='LoanUpdate.php' method='get' onSubmit='return(Validate());'>");


	/************ minor php annoyance *******************/


	/*********** print must start and end with double quotes to do variable name substitution with values *******/


	print ("<input type='hidden' name='RequestType' value='$RequestType'>");

	print ("<input type='hidden' name='SavedLoanStatus'>");

	// create a table

	print ("<table border=1 cellspacing=0 cellpadding=4 align=center>");

	/* ------- Header Row ---------- */

	print ("<tr align='center' valign='middle'><td align='center' valign='middle'>");
	print ("<font face='Verdana' size='2' color='#000099'><a href='ApplicantMaster.php'>Home</a></font></td>");

	if ($RequestType == "Update")
	{
		print ("<td align=center valign=middle><font face='Verdana' size='3'
		color='#000099'><strong>Update Loan Information</strong></font></td>");
	}
	else
	{
		print ("<td align=center valign=middle><font face='Verdana' size='3'
		color='#000099'><strong>Add Loan Information</strong></font></td>");
	}

	print ("</tr>"); // end of row

	/* --------- Loan Info ------------ */

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");

	/* --------- Prohibit Update function to change social security number -------------- */

	if ($RequestType == "Update") /* since the SSN is the primary key, don't allow the user to change it */
	{
		print ("<tr align=right valign=middle><td align=right bgcolor='#003399' valign=middle>");
		print ("<p class='White' style='text-align: right;'>Social Security Number</p></td>");
		print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099' ");
		print ("bgcolor=><input type='text' name='SSN' readonly style='background: #CCCCCC' value='$SSN' size='11'");
		print ("title='Can not change this field. Delete and re-add record to change'><br>");

		print ("</tr><tr align=right valign=middle><td align=right bgcolor='#003399' valign=middle>");
		print ("<p class='White' style='text-align: right;'>Applicant Name</p></td>");

		print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");

		print ("<input type='text' name='ApplicantName' readonly style='background: #CCCCCC' value='$ApplicantName' size='25'></td>");
	}

	/* --------- Allow New Records to  have social security number added -------------- */

	if ($RequestType == "Insert")
	{
		print ("<tr align=right valign=middle><td align=right bgcolor='#003399' valign=middle>");
		print ("<p class='White' style='text-align: right;'>Social Security Number</p></td>");
		print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");
		print ("<input type='text' name='SSN' value='$SSN' size='11'></td>");
	}

	print ("</tr>"); // end of row


	/* --------- Loan Amount Info ------------ */

	print ("<tr align=right valign=middle><td align=right bgcolor='#003399' valign=middle>");
	print ("<p class='White' style='text-align: right;'>Requested Loan Amount</p></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");

	print ("<input type='text' name='RequestedLoanAmount' value='$RequestedLoanAmount' size='10'></td>");

	print ("</tr>"); // end of row

	print ("<tr align=right  valign=middle><td align=right bgcolor='#003399' valign=middle>");
	print ("<p class='White' style='text-align: right;'>Loan Purpose</p></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");
	print ("<select size='1' name='LoanPurpose'>");

	switch ($LoanPurpose)
	{
		case 'Straight Refinance':
			print ("<option selected value='Straight Refinance'>Straight Refinance</option>");
			print ("<option value='Refinance & Payoff Other Bills'>Refinance & Payoff Other Bills</option>");
			print ("<option value='New Purchase'>New Purchase</option>");
			print ("<option value='Second Mortgage'>Second Mortgage</option>");
			break;

		case 'Refinance & Payoff Other Bills':
			print ("<option value='Straight Refinance'>Straight Refinance</option>");
			print ("<option selected value='Refinance & Payoff Other Bills'>Refinance & Payoff Other Bills</option>");
			print ("<option value='New Purchase'>New Purchase</option>");
			print ("<option value='Second Mortgage'>Second Mortgage</option>");
			break;

		case 'New Purchase':
			print ("<option value='Straight Refinance'>Straight Refinance</option>");
			print ("<option value='Refinance & Payoff Other Bills'>Refinance & Payoff Other Bills</option>");
			print ("<option selected value='New Purchase'>New Purchase</option>");
			print ("<option value='Second Mortgage'>Second Mortgage</option>");
			break;

		case 'Second Mortgage':
			print ("<option value='Straight Refinance'>Straight Refinance</option>");
			print ("<option value='Refinance & Payoff Other Bills'>Refinance & Payoff Other Bills</option>");
			print ("<option value='New Purchase'>New Purchase</option>");
			print ("<option selected value='Second Mortgage'>Second Mortgage</option>");
			break;

		default:
			print ("<option selected value='none'>Please Select</option>");
			print ("<option value='Straight Refinance'>Straight Refinance</option>");
			print ("<option value='Refinance & Payoff Other Bills'>Refinance & Payoff Other Bills</option>");
			print ("<option value='New Purchase'>New Purchase</option>");
			print ("<option value='Second Mortgage'>Second Mortgage</option>");
			break;
	}


	print ("</td></tr>"); // end of row

	print ("<tr align=right valign=middle><td bgcolor='#003399' align=right valign=middle>");
	print ("<p class='White' style='text-align: right;'>Purchase Price</p></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");
	print ("<input type='text' name='PurchasePrice' value='$PurchasePrice' size='11'></td></tr>");

	print ("<tr align=right  valign=middle><td align=right bgcolor='#003399' valign=middle>");
	print ("<p class='White' style='text-align: right;'>Estimated Value</p></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");
	print ("<input type='text' name='EstimatedValue' value='$EstimatedValue' size='10'></td></tr>");



	print ("<tr align=right valign=middle><td bgcolor='#003399' align=right valign=middle>");
	print ("<p class='White' style='text-align: right;'>1st Loan Lender Name</p></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");
	print ("<input type='text' name='LenderNameOn1st' value='$LenderNameOn1st' size='25'></td></tr>");

	print ("<tr align=right  valign=middle><td align=right bgcolor='#003399' valign=middle>");
	print ("<p class='White' style='text-align: right;'>1st Loan Balance</p></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");
	print ("<input type='text' name='BalanceOn1st' value='$BalanceOn1st' size='10'></td></tr>");

	print ("<tr align=right valign=middle><td bgcolor='#003399' align=right valign=middle>");
	print ("<p class='White' style='text-align: right;'>1st Loan Interest Rate</p></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");
	print ("<input type='text' name='InterestRateOn1st' value='");

	if ($InterestRateOn1st > 0)
		printf ("%01.3f", ($InterestRateOn1st * 100));

	print ("' size='3'>%</td></tr>");

	print ("<tr align=right valign=middle><td bgcolor='#003399' align=right valign=middle>");
	print ("<p class='White' style='text-align: right;'>1st Loan Monthly Payment</p></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");
	print ("<input type='text' name='MonthlyPaymentOn1st' value='$MonthlyPaymentOn1st' size='10'></td></tr>");


	print ("<tr align=right valign=middle><td bgcolor='#003399' align=right valign=middle>");
	print ("<p class='White' style='text-align: right;'>Have Impound Accounts</p></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");
	print ("<select size='1' name='Impounds'>");

	if (($Impounds !='Y')  &&  ($Impounds != 'N'))
	{
		print ("<option selected value='none'>Please Select</option>");
		print ("<option value='Y'>Yes</option>");
		print ("<option value='N'>No</option>");
	}

	if ($Impounds=='Y')
	{
		print ("<option selected value='Y'>Yes</option>");
		print ("<option value='N'>No</option>");
	}

	if ($Impounds=='N')
	{
		print ("<option value='Y'>Yes</option>");
		print ("<option selected value='N'>No</option>");
	}

	print ("</td></tr>");

	print ("<tr align=right valign=middle><td bgcolor='#003399' align=right valign=middle>");
	print ("<p class='White' style='text-align: right;'>2nd Loan Lender Name</p></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");
	print ("<input type='text' name='LenderNameOn2nd' value='$LenderNameOn2nd' size='25'></td></tr>");

	print ("<tr align=right  valign=middle><td align=right bgcolor='#003399' valign=middle>");
	print ("<p class='White' style='text-align: right;'>2nd Loan Balance</p></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");
	print ("<input type='text' name='BalanceOn2nd' value='$BalanceOn2nd' size='10'></td></tr>");

	print ("<tr align=right valign=middle><td bgcolor='#003399' align=right valign=middle>");
	print ("<p class='White' style='text-align: right;'>2nd Loan Interest Rate</p></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");
	print ("<input type='text' name='InterestRateOn2nd' value='");

	if ($InterestRateOn2nd > 0)
		printf ("%01.3f", $InterestRateOn2nd);

	print ("' size='3'>%</td></tr>");

	print ("<tr align=right valign=middle><td bgcolor='#003399' align=right valign=middle>");
	print ("<p class='White' style='text-align: right;'>2nd Loan Monthly Payment</p></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");
	print ("<input type='text' name='MonthlyPaymentOn2nd' value='$MonthlyPaymentOn2nd' size='10'></td></tr>");

	print ("<tr align=right valign=middle><td bgcolor='#003399' align=right valign=middle>");
	print ("<p class='White' style='text-align: right;'>Credit Report</p></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");
	print ("<select size='1' name='CreditReport'>");

	if (($CreditReport !='Y')  &&  ($CreditReport != 'N'))
	{
		print ("<option selected value='none'>Please Select</option>");
		print ("<option value='Y'>Yes</option>");
		print ("<option value='N'>No</option>");
	}

	if ($CreditReport=='Y')
	{
		print ("<option selected value='Y'>Yes</option>");
		print ("<option value='N'>No</option>");
	}

	if ($CreditReport=='N')
	{
		print ("<option value='Y'>Yes</option>");
		print ("<option selected value='N'>No</option>");
	}

	print ("<tr align=right  valign=middle><td align=right bgcolor='#003399' valign=middle>");
	print ("<p class='White' style='text-align: right;'>Loan Status</p></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");
	print ("<select size='1' name='LoanStatus'>");

	switch ($SavedFilter)
	{

		case "All":
			print ("<option selected value='All'>All</option>");
			print ("<option value='New'>New</option>");
			print ("<option value='Active'>Active</option>");
			print ("<option value='Denied Credit'>Denied Credit</option>");
			print ("<option value='No Credit Report'>No Credit Report</option>");
			print ("<option value='Withdrawn'>Withdrawn</option>");
			print ("<option value='Completed'>Completed</option>");
			break;

		case "New":
			print ("<option value='All'>All</option>");
			print ("<option selected value='New'>New</option>");
			print ("<option value='Active'>Active</option>");
			print ("<option value='Denied Credit'>Denied Credit</option>");
			print ("<option value='No Credit Report'>No Credit Report</option>");
			print ("<option value='Withdrawn'>Withdrawn</option>");
			print ("<option value='Completed'>Completed</option>");
			break;

		case "Active":
			print ("<option value='All'>All</option>");
			print ("<option value='New'>New</option>");
			print ("<option selected value='Active'>Active</option>");
			print ("<option value='Denied Credit'>Denied Credit</option>");
			print ("<option value='No Credit Report'>No Credit Report</option>");
			print ("<option value='Withdrawn'>Withdrawn</option>");
			print ("<option value='Completed'>Completed</option>");
			break;

		case "Completed":
			print ("<option value='All'>All</option>");
			print ("<option value='New'>New</option>");
			print ("<option value='Active'>Active</option>");
			print ("<option value='Denied Credit'>Denied Credit</option>");
			print ("<option value='No Credit Report'>No Credit Report</option>");
			print ("<option value='Withdrawn'>Withdrawn</option>");
			print ("<option selected value='Completed'>Completed</option>");
			break;

		case "Denied Credit":
			print ("<option value='All'>All</option>");
			print ("<option value='New'>New</option>");
			print ("<option value='Active'>Active</option>");
			print ("<option selected value='Denied Credit'>Denied Credit</option>");
			print ("<option value='No Credit Report'>No Credit Report</option>");
			print ("<option value='Withdrawn'>Withdrawn</option>");
			print ("<option value='Completed'>Completed</option>");
			break;

		case "No Credit Report":
			print ("<option value='All'>All</option>");
			print ("<option value='New'>New</option>");
			print ("<option value='Active'>Active</option>");
			print ("<option value='Denied Credit'>Denied Credit</option>");
			print ("<option selected value='No Credit Report'>No Credit Report</option>");
			print ("<option value='Withdrawn'>Withdrawn</option>");
			print ("<option value='Completed'>Completed</option>");
			break;

		case "Withdrawn":
			print ("<option value='All'>All</option>");
			print ("<option value='New'>New</option>");
			print ("<option value='Active'>Active</option>");
			print ("<option value='Denied Credit'>Denied Credit</option>");
			print ("<option value='No Credit Report'>No Credit Report</option>");
			print ("<option selected value='Withdrawn'>Withdrawn</option>");
			print ("<option value='Completed'>Completed</option>");
			break;

		default:
			print ("<option selected value='All'>All</option>");
			print ("<option value='New'>New</option>");
			print ("<option value='Active'>Active</option>");
			print ("<option value='Denied Credit'>Denied Credit</option>");
			print ("<option value='No Credit Report'>No Credit Report</option>");
			print ("<option value='Withdrawn'>Withdrawn</option>");
			print ("<option value='Completed'>Completed</option>");
			break;
	}

	print ("</select></font></td>");
	print ("</tr>"); // end of row

	/* ----------------- Buttons ---------------------- */

	print ("<tr align=right valign=middle><td align=center valign=middle>");


	if ($RequestType=="Update")
	{
		print ("<input class='Submit' type='submit' name='Update' value='Update Record'>&nbsp;");
	}
	else
	{
		print ("<input class='Submit' type='submit' name='Insert' value='Insert Record'>&nbsp;");
	}

	print ("<td align=center valign=middle><font face='Verdana' size='2' color='#000099'>");

	print ("</form>");	// end of form

	print ("<form name='ReList' action='LoanList.php' method='get'>");

	print ("<input class='Submit' type='submit' name='Submit' value='Browse Loans'");
	print ("</form>");

	/* verify the passed parameter values */
	/*
	print ("<br>\nSavedLoanStatus=$SavedLoanStatus<br>\n");
	print ("RequestType=$RequestType<br>\n");
	print ("LoanName=$LoanName<br>\n");
	print ("DOB=$DOB<br>\n");
	print ("SSN=$SSN<br>\n");
	*/

	/* If the user wants to return to the Loan List page, send along the saved Loan Status filter value	*/

	/*
	print ("SavedLoanStatus=$SavedLoanStatus\n");
	*/

	print ("</td></tr>");	// end of row
	print ("</table>"); // end of table
?>
</body>

</html>
