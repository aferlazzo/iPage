<?php
require ("../include/authenticate.php");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<html>
<head>
<title>EmploymentMaintenance</title>
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
*	EmploymentMaintenance - This page is user interface page for adding and chaging Employment table entries.	*/
*	It displays a record from the table. 																		*/
*																												*/
* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
-->


<script language="JavaScript">

/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */
/*																												*/
/*	Validate()	This JavaScript function is called by the html onSubmit object prior to the page passing the 	*/
/*	the user to the EmploymentUpdate page (which performs the actual my_SQL database queries). The function		*/
/*	simply verifies the user input prior to the database updating page.											*/
/*																												*/
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */

function Validate()
{
	/*
	alert("In Validate() passed EmploymentInfo.elements[0] is |" + document.EmploymentInfo.elements[0].value + "|");
	alert("In Validate() passed EmploymentInfo.elements[1] is |" + document.EmploymentInfo.elements[1].value + "|");
	alert("In Validate() passed EmploymentInfo.elements[2] is |" + document.EmploymentInfo.elements[2].value + "|");
	alert("In Validate() passed EmploymentInfo.elements[3] is |" + document.EmploymentInfo.elements[3].value + "|");
	alert("In Validate() passed EmploymentInfo.elements[4] is |" + document.EmploymentInfo.elements[4].value + "|");
	alert("In Validate() passed EmploymentInfo.elements[5] is |" + document.EmploymentInfo.elements[5].value + "|");
	alert("In Validate() passed EmploymentInfo.elements[6] is |" + document.EmploymentInfo.elements[6].value + "|");
	alert("In Validate() passed EmploymentInfo.elements[7] is |" + document.EmploymentInfo.elements[7].value + "|");

	alert("In Validate() passed SavedLoanStatus is |" + document.EmploymentInfo.SavedLoanStatus.value + "|");
	alert("In Validate() SavedLoanStatus length is |" + document.EmploymentInfo.SavedLoanStatus.value.length + "|");
	document.writeln("A writeln is |" + document.EmploymentInfo.StatusFlag.value + "|");
	*/

	if (!document.EmploymentInfo.SSN.value.length == 11)   /* check the length of the SS Numbers */
	{
	  alert("SSN length error: Must be 11 characters");
	  document.EmploymentInfo.SSN.focus();
	  document.EmploymentInfo.SSN.select();
	  return(false);
	}

	if (document.EmploymentInfo.Employer.value.length == 0)
	{
	  alert("Employer: Must be entered");
	  document.EmploymentInfo.Employer.focus();
	  document.EmploymentInfo.Employer.select();
	  return(false);
	}

    if (document.EmploymentInfo.MonthlyIncome.value.length == 0)   /* if there's no space in the name */
	{
	  alert("MonthlyIncome: Must be entered");
	  document.EmploymentInfo.MonthlyIncome.focus();
	  document.EmploymentInfo.MonthlyIncome.select();
	  return(false);
	}

	/*
	alert("|" + document.EmploymentInfo.IncomeLastYear.value + "| length = " + document.EmploymentInfo.IncomeLastYear.value.length);
	*/

	if (!document.EmploymentInfo.IncomeLastYear.value.length == 2)
	{
	  alert("Income Last Year: Must be entered");
	  document.EmploymentInfo.IncomeLastYear.focus();
	  document.EmploymentInfo.IncomeLastYear.select();
	  return(false);
	}

	if (document.EmploymentInfo.LengthOfEmployment.value.length == 0)
	{
	  alert("LengthOfEmployment: Must be entered");
	  document.EmploymentInfo.LengthOfEmployment.focus();
	  document.EmploymentInfo.LengthOfEmployment.select()
	  return(false);
	}
	else
	{
		return(true);
	}
}
</script>
</head>

<body>
<!--
#	/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
#	/*																									*/
#	/*	EmploymentMaintenance.php - This current page has to pass the variables value to the Employment */
#	/*	Update page, or back to the Employment List page (whichever one is called from here, depending 	*/
#	/*	on user input).																					*/
#	/*																									*/
#	/*																									*/
#	/*	Calls EmploymentUpdate.php. Passes the variables 												*/
#	/*																									*/
#	/*	Calls EmploymentList.php. Passes $SavedFilter													*/
#	/*																									*/
#	/*																									*/
#	/*	Sample of URL string: http://www.lightning-mortgage.com/LAPS/EmploymentMaintenance.php?SSN=111111111	*/
#	/*	...																								*/
#	/*																									*/
#	/*																									*/
#	/*	EmploymentUpdate.php all calls this page. It passes the variable $SavedLoanStatus 				*/
#	/*																									*/
#	/*																									*/
#	/*																									*/
#	/* We must do this because once the update of an existing record or the insertion of a new record	*/
#	/* is performed, this EmploymentUpdate page will return	the user to the EmploymentList.php page. 	*/
#	/* We want to maintain the current filter & continue the same list when we return. Since the Loan 	*/
#	/* of this current record may be changed by user input in the course of executing this page, we 	*/
#	/* save the value of this variable and pass it back when returning to the EmploymentList page. 		*/
#	/*																									*/
#	/* Returning to the List page directly from here (that is, without updating the database/without	*/
#	/* transferring control to the EmploymentUpdate page) is done by the user when he presses the Reset */
#	/* button. The onClick method passes the URL and filter 			.								*/
#	/*																									*/
#	/* When records are being updated, we pass the saved value to the EmploymentUpdate page using this	*/
#	/* hidden field for Saved Loan Status to the EmploymentUpdate page. It is passed with the other form*/
#	/* fields using the built-in <form> variable passing functionality.									*/
#	/*																									*/
#	/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
-->
<?php

	if ($RequestType == 'Delete')
	{
		$aaa = $_POST[SSN];
		$bbb = $_POST[ApplicantName];
		$ccc = $_POST[Employer];
		$ddd = $_POST[Position];
		$eee = $_POST[MonthlyIncome];
		$fff = $_POST[IncomeLastYear];
		$ggg = $_POST[LengthOfEmployment];


		print ("<form name='EditRecord' action='EmploymentUpdate.php' method='post'>");
		print ("<input type='hidden' name=SSN value='$aaa'>");
		print ("<input type='hidden' name=ApplicantName value='$bbb'>");
		print ("<input type='hidden' name=Employer value='$ccc'>");
		print ("<input type='hidden' name=Position value='$ddd'>");
		print ("<input type='hidden' name=MonthlyIncome value='$eee'>");
		print ("<input type='hidden' name=IncomeLastYear value='$fff'>");
		print ("<input type='hidden' name=LengthOfEmployment value='$ggg'>");
		print ("<input type='hidden' name=RequestType value='$RequestType'>");
		print ("<script language='Javascript'>document.EditRecord.submit();</script>");
		print ("</form>");
	}

	// print ("RequestType='$RequestType'<br>\n");
	// print ("<b>SSN:$SSN, Employment Name:$EmploymentName</b><br>\n");


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
		$xxx= substr($SSN,0,3).'-'.substr($SSN,3,2).'-'.substr($SSN,5,4);
		$SSN=$xxx;
	}
	else
		$SSN="";

	if ($Co_SSN == 0)
	{
		$Co_SSN = " ";
		$NoCo = 1;
	}
	else
		$NoCo = 0;
/*
	print ("SSN '$SSN'<br>\n");
	print ("Employer '$Employer'<br>\n");
	print ("Position '$Position'<br>\n");
	print ("MonthlyIncome '$MonthlyIncome'<br>\n");
	print ("IncomeLastYear '$IncomeLastYear'<br>\n");
	print ("LengthOfEmployment '$LengthOfEmployment'<br>\n");
	print ("Co_SSN '$Co_SSN'<br>\n");
	print ("Co_Employer '$Co_Employer'<br>\n");
	print ("Co_Position '$Co_Position'<br>\n");
	print ("Co_MonthlyIncome '$Co_MonthlyIncome'<br>\n");
	print ("Co_IncomeLastYear '$Co_IncomeLastYear'<br>\n");
	print ("Co_LengthOfEmployment '$Co_LengthOfEmployment'<br>\n");
*/

/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
/*																					*/
/* Start of a new form, necessary to inputs and/or display the fields for the table	*/
/*																					*/
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/

	if ($UserLevel != "Admin")
		print ("<form name='EmploymentInfo' action='FunctionDisabled.php' method='get' onSubmit='return(Validate());'>");
	else
		print ("<form name='EmploymentInfo' action='EmploymentUpdate.php' method='get' onSubmit='return(Validate());'>");


	/************ minor php annoyance *******************/


	/*********** print must start and end with double quotes to do variable name substitution with values *******/


	print ("<input type='hidden' name='RequestType' value='$RequestType'>");

	//print ("<input type='hidden' name='SavedLoanStatus'><br>");

	/* $SavedLoanStatus=$LoanStatus;  // $LoanStatus came from the URL */


	/* * * * * * * * * * * * * * * * * * major php annoyance! * * * * * * * * * * * * * * * * * */
	/*																							*/
	/*		We can't say $SavedLoanStatus=$LoanStatus for some strange reason.					*/
	/*		If we do, we can say print ("$SavedLoanStatus"); and obtain the desired result.		*/
	/*		But because SavedLoanStatus is a form variable, the variable is still null when 	*/
	/*		the variable is passed.																*/
	/*																							*/
	/*		So, we use JavaScript to assign the $LoanStatus variable's value to the form		*/
	/*		variable.																			*/
	/*																							*/
	/******** To assign the value of one php variable to another you must use JavaScript ********/

	//print ("<script>document.EmploymentInfo.SavedLoanStatus.value='".$LoanStatus."';</script>");

	/*
	print ("LoanStatus=$LoanStatus <br>\n");
	print ("Line 186 SavedLoanStatus=$SavedLoanStatus<br>\n");
	*/

	// create a table

	print ("<table border=1 cellspacing=0 cellpadding=4 align=center>");

	/* ------- Header Row ---------- */

	print ("<tr align='center' valign='middle'><td align='center' valign='middle'>");
	print ("<font face='Verdana' size='2' color='#000099'><a href='ApplicantMaster.php'>Home</a></font></td>");


	if ($RequestType == "Update")
	{
		print ("<td align=center valign=middle><font face='Verdana' size='3'");
		print ("color='#000099'><strong>Update Employment Information</strong></font></td>");
	}
	else
	{
		print ("<td align=center valign=middle><font face='Verdana' size='3'");
		print ("color='#000099'><strong>Add Employment Information</strong></font></td>");
	}

	print ("</tr>"); // end of row

	/* --------- Applicant's Employment Info ------------ */

	print ("<tr align=right valign=middle><td align=right bgcolor='#003399' valign=middle>");

	print ("<p class='White' style='text-align: right;'>Social Security #</p></td>");

	/* --------- Prohibit Update function to change social security number or the name -------------- */

	if ($RequestType == "Update") /* since the SSN is the primary key, don't allow the user to change it */
	{
		print ("<td align=left bgcolor='#6699FF' valign=middle>");
		print ("<input type='text' name='SSN' readonly style='background: #CCC;' value='$SSN' size='11' ");
		print ("title='Can not change this field. Delete and re-add record to change'>");

		print ("</tr><tr align=right valign=middle><td align='right' bgcolor='#003399' valign=middle>");
		print ("<p class='White' style='text-align:right;'>Applicant Name</td>");

		print ("<td align=left bgcolor='#6699FF' valign=middle>");

		print ("<input type='text' name='ApplicantName' readonly style='background: #CCCCCC' value='$ApplicantName' size='25'></td>");
	}

	/* --------- Allow New Records to have social security number added -------------- */

	if ($RequestType == "Insert")
	{
		print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");
		print ("<input type='text' name='SSN' value='$SSN' size='11'></td>");
	}

	print ("</tr>"); // end of row

	print ("<tr align=right valign=middle><td align=right bgcolor='#003399' valign=middle>");

	print ("<p class='White' style='text-align: right;'>Employer</font></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");

	if ($UserLevel != "Admin")
		$Employer = substr($Employer, 0, 4)."xxxxxx";

	print ("<input type='text' name='Employer' value='$Employer' size='35'></td>");

	if ($RequestType == "Update") // position the cursor to the employer box
		print("<script language='Javascript'>document.EmploymentInfo.Employer.select(); document.EmploymentInfo.Employer.focus();</script>");
	else
		print("<script language='Javascript'>document.EmploymentInfo.SSN.select(); document.EmploymentInfo.SSN.focus();</script>");

	print ("</tr>"); // end of row

	print ("<tr align=right valign=middle><td align=right bgcolor='#003399' valign=middle>");

	print ("<p class='White' style='text-align: right;'>Position</font></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");

	print ("<input type='text' name='Position' value='$Position' size='35'></td>");

	print ("</tr>"); // end of row

	print ("<tr align=right valign=middle><td align=right bgcolor='#003399' valign=middle>");

	print ("<p class='White' style='text-align: right;'>Monthly Income</font></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");

	print ("<input type='text' name='MonthlyIncome' value='$MonthlyIncome' size='6'></td>");

	print ("</tr>"); // end of row

	print ("<tr align=right valign=middle><td align=right bgcolor='#003399' valign=middle>");

	print ("<p class='White' style='text-align: right;'>Income Last Year</font></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");

	print ("<input type='text' name='IncomeLastYear' value='$IncomeLastYear' size='6'></td>");

	print ("</tr>"); // end of row


	print ("<tr align=right valign=middle><td align=right bgcolor='#003399' valign=middle>");

	print ("<p class='White' style='text-align: right;'>Length Of Employment</font></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");

	print ("<input type='text' name='LengthOfEmployment' value='$LengthOfEmployment' size='2'></td>");

	print ("</tr>"); // end of row

	/* --------- Co_Applicant's Employment Info ------------ */

	print ("<tr align=right valign=middle><td align=right bgcolor='#003399' valign=middle>");

	print ("<p class='White' style='text-align: right;'>Co-Applicant&acute;s Social Security #</font></td>");

	/* --------- Prohibit Update function to change social security number or the name -------------- */

	if ($RequestType == "Update") /* since the SSN is the primary key, don't allow the user to change it */
	{
		print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");
		print ("<input type='text' name='Co_SSN' readonly style='background: #CCCCCC' value='$Co_SSN' size='11'");
		print ("title='Can not add or change this field. Update Co_Applicant SSN on Applicant Maintenance page'>");

		print ("</tr><tr align=right valign=middle><td align=right bgcolor='#003399' valign=middle>");
		print ("<p class='White' style='text-align: right;'>Co-Applicant Name</p></td>");

		print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");

		print ("<input type='text' name='Co_ApplicantName' readonly style='background: #CCCCCC' value='$Co_ApplicantName' size='25'></td>");
	}

	/* --------- Allow New Records to have social security number added -------------- */

	if ($RequestType == "Insert")
	{
		print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");
		print ("<input type='text' name='Co_SSN' value='$Co_SSN' size='11'></td>");
	}

	print ("</tr>"); // end of row

	print ("<tr align=right valign=middle><td align=right bgcolor='#003399' valign=middle>");

	print ("<p class='White' style='text-align: right;'>Employer</p></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");

	if ($UserLevel != "Admin")
		$Employer = substr($Employer, 0, 4)."xxxxxx";

	if ($NoCo)
	{
		print ("<input type='text' name='Co_Employer' readonly style='background: #CCCCCC' size='35'");
		print ("title='Can not add or change this field. First add the Co_Applicant SSN on Applicant Maintenance page'></font>");
	}
	else
		print ("<input type='text' name='Co_Employer' value='$Co_Employer' size='35'>");

	print ("</td></tr>"); // end of row

	print ("<tr align=right valign=middle><td align=right bgcolor='#003399' valign=middle>");

	print ("<p class='White' style='text-align: right;'>Position</p></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");


	if ($NoCo)
	{
		print ("<input type='text' name='Co_Position' readonly style='background: #CCCCCC' size='35'");
		print ("title='Can not add or change this field. First add the Co_Applicant SSN on Applicant Maintenance page'></font>");
	}
	else
		print ("<input type='text' name='Co_Position' value='$Co_Position' size='35'></td>");

	print ("</tr>"); // end of row

	print ("<tr align=right valign=middle><td align=right bgcolor='#003399' valign=middle>");

	print ("<p class='White' style='text-align: right;'>Monthly Income</p></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");

	if ($NoCo)
	{
		print ("<input type='text' name='Co_MonthlyIncome' readonly style='background: #CCCCCC' size='6'");
		print ("title='Can not add or change this field. First add the Co_Applicant SSN on Applicant Maintenance page'></font>");
	}
	else
		print ("<input type='text' name='Co_MonthlyIncome' value='$Co_MonthlyIncome' size='6'></td>");

	print ("</tr>"); // end of row

	print ("<tr align=right valign=middle><td align=right bgcolor='#003399' valign=middle>");

	print ("<p class='White' style='text-align: right;'>Income Last Year</p></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");

	if ($NoCo)
	{
		print ("<input type='text' name='Co_IncomeLastYear' readonly style='background: #CCCCCC' size='6'");
		print ("title='Can not add or change this field. First add the Co_Applicant SSN on Applicant Maintenance page'></font>");
	}
	else
		print ("<input type='text' name='Co_IncomeLastYear' value='$Co_IncomeLastYear' size='6'></td>");

	print ("</tr>"); // end of row


	print ("<tr align=right valign=middle><td align=right bgcolor='#003399' valign=middle>");

	print ("<p class='White' style='text-align: right;'>Length Of Employment</p></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");

	if ($NoCo)
	{
		print ("<input type='text' name='Co_LengthOfEmployment' readonly style='background: #CCCCCC' size='2'");
		print ("title='Can not add or change this field. First add the Co_Applicant SSN on Applicant Maintenance page'></font>");
	}
	else
		print ("<input type='text' name='Co_LengthOfEmployment' value='$Co_LengthOfEmployment' size='2'></td>");

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

	print ("<form name='ReList' action='EmploymentList.php' method='get'>");

	print ("<input class='Submit' type='submit' name='ListAll' value='Browse Employment Info'");
	print ("</form>");

	/* verify the passed parameter values */
	/*
	print ("<br>\nSavedLoanStatus=$SavedLoanStatus<br>\n");
	print ("RequestType=$RequestType<br>\n");
	print ("EmploymentName=$EmploymentName<br>\n");
	print ("SSN=$SSN<br>\n");
	print ("Co_EmploymentName=$Co_EmploymentName<br>\n");
	*/

	/* If the user wants to return to the Employment List page, send along the saved Loan Status filter value	*/

	/*
	print ("SavedLoanStatus=$SavedLoanStatus\n");
	*/

	print ("</td></tr>");	// end of row
	print ("</table>"); // end of table
?>
</body>

</html>
