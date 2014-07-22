<?php
require ("../include/authenticate.php");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<html>
<head>
<title>ApplicantMaintenance</title>
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
*	ApplicantMaintenance - This page is user interface page for adding and chaging Applicant table entries.		*/
*	It displays a record from the table. 																		*/
*																												*/
* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
-->


<script language="JavaScript">

/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */
/*																												*/
/*	Validate()	This JavaScript function is called by the html onSubmit object prior to the page passing the 	*/
/*	the user to the ApplicantUpdate page (which performs the actual my_SQL database queries). The function		*/
/*	simply verifies the user input prior to the database updating page.											*/
/*																												*/
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */

function Validate()
{
	
	/* request type */
	/*alert("In Validate() passed ApplicantInfo.elements[0] is |" + document.ApplicantInfo.elements[0].value + "|");
	/* ApplicantName */
	/*alert("In Validate() passed ApplicantInfo.elements[1] is |" + document.ApplicantInfo.elements[1].value + "|");
	/* ApplicantFirstName */
	/*alert("In Validate() passed ApplicantInfo.elements[2] is |" + document.ApplicantInfo.elements[2].value + "|");
	/* ApplicantLastName */
	/*alert("In Validate() passed ApplicantInfo.elements[3] is |" + document.ApplicantInfo.elements[3].value + "|");
	/*  DOB */
	/*alert("In Validate() passed ApplicantInfo.elements[4] is |" + document.ApplicantInfo.elements[4].value + "|");
	/* ss# */
	/*alert("In Validate() passed ApplicantInfo.elements[5] is |" + document.ApplicantInfo.elements[5].value + "|");
	/* Co_ApplicantName */
	/*alert("In Validate() passed ApplicantInfo.elements[6] is |" + document.ApplicantInfo.elements[6].value + "|");
	/* Co_ApplicantFirstName */
	/*alert("In Validate() passed ApplicantInfo.elements[7] is |" + document.ApplicantInfo.elements[7].value + "|");
	/* Co_ApplicantLastName */
	/*alert("In Validate() passed ApplicantInfo.elements[8] is |" + document.ApplicantInfo.elements[8].value + "|");
	/*  Co_DOB */
	/*alert("In Validate() passed ApplicantInfo.elements[9] is |" + document.ApplicantInfo.elements[9].value + "|");
	/* Co_ss# */
	/*alert("In Validate() passed ApplicantInfo.elements[10] is |" + document.ApplicantInfo.elements[10].value + "|");
	/*  HowReferred */
	/*alert("In Validate() passed ApplicantInfo.elements[11] is |" + document.ApplicantInfo.elements[11].value + "|");
	/* LoanStatus */
	/*alert("In Validate() passed ApplicantInfo.elements[12] is |" + document.ApplicantInfo.elements[12].value + "|");
	/* DateInserted */
	/*alert("In Validate() passed ApplicantInfo.elements[13] is |" + document.ApplicantInfo.elements[13].value + "|");*/

	/*document.writeln("A writeln is |" + document.ApplicantInfo.SavedLoanStatus.value + "|");*/

	if (!document.ApplicantInfo.SSN.value.length == 11)   /* check the length of the SS Numbers */
	{
	  alert("SSN length error: Must be 11 characters");
	  document.ApplicantInfo.SSN.focus();
	  return(false);
	}

	if ((!document.ApplicantInfo.Co_SSN.value.length == 11)&&(!document.ApplicantInfo.Co_SSN.value.length == 0))
	{
	  alert("Co_SSN length error: Must be 11 characters");
	  document.ApplicantInfo.Co_SSN.focus();
	  document.ApplicantInfo.Co_SSN.select();
	  return(false);
	}

    if (document.ApplicantInfo.ApplicantName.value.indexOf(" ") == -1)   /* if there's no space in the name */
	{
	  alert("ApplicantName: Please enter both First and Last names");
	  document.ApplicantInfo.ApplicantName.focus();
	  document.ApplicantInfo.ApplicantName.select();
	  return(false);
	}

	/*
	alert("|" + document.ApplicantInfo.Co_ApplicantName.value + "| length = " + document.ApplicantInfo.Co_ApplicantName.value.length);
	*/

	if ((document.ApplicantInfo.Co_ApplicantName.value.indexOf(" ") == -1)&&(document.ApplicantInfo.Co_ApplicantName.value.length > 0))
	{
	  alert("Co_ApplicantName: Please enter both First and Last names");
	  document.ApplicantInfo.Co_ApplicantName.focus();
	  document.ApplicantInfo.Co_ApplicantName.select();
	  return(false);
	}

	if (document.ApplicantInfo.DOB.value.length != 10)
	{
	  alert("DOB: please use MM/DD/YYYY format");
	  document.ApplicantInfo.DOB.focus();
	  document.ApplicantInfo.DOB.select();
	  return(false);
	}

	if (document.ApplicantInfo.Co_DOB.value.length > 0)
	{
		if (document.ApplicantInfo.Co_SSN.value.length < 1)
		{
		  alert("Co_Applicant: if adding Co_DOB, please add Co_Applicant SSN");
		  document.ApplicantInfo.Co_SSN.focus();
		  document.ApplicantInfo.Co_SSN.select();
		  return(false);
		}

		if (document.ApplicantInfo.Co_ApplicantName.value.length < 1)
		{
		  alert("Co_Applicant: if adding Co_DOB, please add Co_Applicant Name");
		  document.ApplicantInfo.Co_ApplicantName.focus();
		  document.ApplicantInfo.Co_ApplicantName.select();
		  return(false);
		}
	}

	if (document.ApplicantInfo.DateInserted.value.length != 8)
	{
		alert("Date Inserted: this field must have the MM/DD/YY format");
		document.ApplicantInfo.DateInserted.focus();
		document.ApplicantInfo.DateInserted.select();
		return(false);
	}
		
	/* if there is a co-borrower */

	if (document.ApplicantInfo.Co_ApplicantName.value.length > 0)
	{
		if ((document.ApplicantInfo.Co_DOB.length < 9)||(document.ApplicantInfo.Co_DOB.value.length > 10))
		{
		  alert("Co_DOB: please use MM/DD/YYYY format");
		  document.ApplicantInfo.Co_DOB.focus();
		  document.ApplicantInfo.Co_DOB.select();
		  return(false);
		}
	}

	if (document.ApplicantInfo.HowReferred.value=="none")
	{
	  alert("Please Choose 'How Referred'");
	  document.ApplicantInfo.HowReferred.focus();
	  return(false);
	}
/*
	if (document.ApplicantInfo.LoanStatus.value=="none")
	{
	  alert("Please Choose the current 'Loan Status'");
	  document.ApplicantInfo.HowReferred.focus();
	  return(false);
	}

	document.cookie='SavedFilter=<?php $SavedFilter ?>';
*/
	return(true);
}
</script>
</head>

<body>
<!--
#	/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
#	/*																									*/
#	/*	ApplicantMaintenance.php - This current page has to pass the variables value to the Applicant 	*/
#	/*	Update page, or back to the Applicant List page (whichever one is called from here, depending 	*/
#	/*	on user input).																					*/
#	/*																									*/
#	/*																									*/
#	/*	Calls ApplicantUpdate.php. Passes the variables $SavedLoanStatus, $RequestType, $ApplicantName, */
#	/*	$DOB, $SSN, $Co_Applicant, $Co_DOB, $Co_SSN														*/
#	/*																									*/
#	/*	Calls ApplicantList.php. Passes $SavedFilter													*/
#	/*																									*/
#	/*																									*/
#	/*	Sample of URL string: http://www.lightning-mortgage.com/ApplicantMaintenance.php?SSN=111111111	*/
#	/*	&DOB=060606&ApplicantName=This%20is%20another%20%20new%20Applicant&Co_SSN=666551111&Co_DOB=		*/
#	/*	060606&Co_ApplicantName=Newer%20Applicant&RequestType=Update&HowReferred=Mortgage%20Professor	*/
#	/*	&LoanStatus=Active																				*/
#	/*																									*/
#	/*																									*/
#	/*																									*/
#	/*	ApplicantUpdate.php all calls this page. It passes the variable $SavedLoanStatus 				*/
#	/*																									*/
#	/*																									*/
#	/*																									*/
#	/* We must do this because once the update of an existing record or the insertion of a new record	*/
#	/* is performed, this ApplicantUpdate page will return	the user to the ApplicantList.php page. 	*/
#	/* We want to maintain the current filter & continue the same list when we return. Since the Loan 	*/
#	/* of this current record may be changed by user input in the course of executing this page, we 	*/
#	/* save the value of this variable and pass it back when returning to the ApplicantList page. 		*/
#	/*																									*/
#	/* Returning to the List page directly from here (that is, without updating the database/without	*/
#	/* transferring control to the ApplicantUpdate page) is done by the user when he presses the Reset 	*/
#	/* button. The onClick method passes the URL and filter 			.								*/
#	/*																									*/
#	/* When records are being updated, we pass the saved value to the ApplicantUpdate page using this	*/
#	/* hidden field for Saved Loan Status to the ApplicantUpdate page. It is passed with the other form */
#	/* fields using the built-in <form> variable passing functionality.									*/
#	/*																									*/
#	/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
-->
<?php

include ("../include/SetCookies.php");


	if (($RequestType == 'Delete') || ($RequestType == 'Export'))
	{
		$aaa = $_POST[SSN];
		$bbb = $_POST[DOB];
		$ccc = $_POST[ApplicantName];
		$ddd = $_POST[Co_SSN];
		$eee = $_POST[Co_DOB];
		$fff = $_POST[Co_ApplicantName];
		$ggg = $_POST[HowReferred];
		$hhh = $_POST[LoanStaus];
		$iii = $_POST[RequestType];

		print ("<form name='EditRecord' action='ApplicantUpdate.php' method='post'>");
		print ("<input type='hidden' name=SSN value='$aaa'>");
		print ("<input type='hidden' name=DOB value='$bbb'>");
		print ("<input type='hidden' name=ApplicantName value='$ccc'>");
		print ("<input type='hidden' name=Co_SSN value='$ddd'>");
		print ("<input type='hidden' name=Co_DOB value='$eee'>");
		print ("<input type='hidden' name=Co_ApplicantName value='$fff'>");
		print ("<input type='hidden' name=HowReferred value='$ggg'>");
		print ("<input type='hidden' name=LoanStatus value='$hhh'>");
		print ("<input type='hidden' name=RequestType value='$iii'>");
		print ("<script language='Javascript'>document.EditRecord.submit();</script>");
		print ("</form>");
	}

	//print ("Line ".__LINE__." RequestType='$RequestType'<br>\n");
	//print ("Line ".__LINE__." SSN:$SSN, Applicant Name:$ApplicantName<br>\n");
	//print ("Line ".__LINE__." Loan Status:$LoanStatus<br>\n");

	if($RequestType == "Insert")
		$DateInserted = date("m/d/y");

	$Co_DOB = ereg("0-9/", "", $Co_DOB);
	$Co_DOB = urlencode($Co_DOB);

	//print ("<b>DOB |$DOB|, Co_DOB |$Co_DOB|</b><br>\n");

	if (($RequestType != 'Insert') && ($RequestType != 'Update'))  //if the request was not an insert, update,
		print("<script language='Javascript'>history.back();</scrpt>");//export or delete then just exit

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
		if ($UserLevel != "Admin")
			$TempField = 'xxx-xx-'.substr($SSN,5,4);
		else
			$TempField = substr($SSN,0,3).'-'.substr($SSN,3,2).'-'.substr($SSN,5,4);

		$SSN=$TempField;
	}


	/* Format the Co_SSN */

	//print ("length is ".strlen($Co_SSN).", value is $Co_SSN<br>\n");
	$x = strlen($Co_SSN);

	while ($x < 9)  // pad with leading zeros
	{
		$xxx = "0".$Co_SSN;
		$Co_SSN = $xxx;
		$x = strlen($Co_SSN);
		//print ("length is ".strlen($Co_SSN).", value is $Co_SSN<br>\n");
	}

	if (strlen($Co_SSN) > 0)
	{
		if ($UserLevel != "Admin")
			$TempField = 'xxx-xx-'.substr($Co_SSN,5,4);
		else
			$TempField = substr($Co_SSN,0,3).'-'.substr($Co_SSN,3,2).'-'.substr($Co_SSN,5,4);

		$Co_SSN=$TempField;
	}

	//print ("<br>\n Co_DOB |$Co_DOB| Co_SSN |$Co_SSN|<br>\n");

	/* print ("Formatted ssn=$xxx"); */

/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
/*																					*/
/* Start of a new form, necessary to inputs and/or display the fields for the table	*/
/*																					*/
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/

	if ($UserLevel != "Admin")
		print ("<form name='ApplicantInfo' action='FunctionDisabled.php' method='post';'>");
	else
		print ("<form name='ApplicantInfo' action='ApplicantUpdate.php' method='post' onSubmit='return(Validate());'>");


	/************ minor php annoyance *******************/


	/*********** print must start and end with double quotes to do variable name substitution with values *******/


	print ("<input type='hidden' name='RequestType' value='$RequestType'>");

	// create a table

	print ("<table border=1 cellspacing=0 cellpadding=4 align=center>");

	print ("<tr align='center' valign='middle'><td align='center' valign='middle'>");
	print ("<font face='Verdana' size='2' color='#000099'><a href='ApplicantMaster.php'>Home</a></font></td>");

	/* ------- Header Row ---------- */

	if ($RequestType == "Update")
	{
		print ("<td align=center valign=middle colspan='2'><font face='Verdana' size='3'
		color='#000099'><strong>Update An Applicant</strong></font></td>");
	}

	if ($RequestType == "Insert")
	{
		print ("<td align=center valign=middle colspan='2'><font face='Verdana' size='3'
		color='#000099'><strong>Add An Applicant</strong></font></td>");
	}

	print ("</tr>"); // end of row

	/* --------- Applicant Info ------------ */

	print ("<tr align=right valign=middle><td align=right bgcolor='#003399' valign=middle>");

	print ("<p class='White' style='text-align: right;'>Applicant Name</p></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");

	print ("<input type='text' name='ApplicantName' value='$ApplicantName' size='30'></td>");
	print("<script language='Javascript'>document.ApplicantInfo.ApplicantName.select(); document.ApplicantInfo.ApplicantName.focus();</script>");

	print ("<input type='hidden' name='ApplicantFirstName 'value='$ApplicantFirstName' size='30'><br></td>");
	print ("<input type='hidden' name='ApplicantLastName' value='$ApplicantLastName' size='30'><br></td>");

	print ("</tr>"); // end of row

	print ("<tr align=right valign=middle><td align=right bgcolor='#003399' valign=middle>");

	print ("<p class='White' style='text-align: right;'>Date of Birth</p></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");

	print ("<input type='text' name='DOB' value='$DOB' size='10'><br></td>");

	print ("</tr>"); // end of row

	/* --------- Prohibit Update function to change social security number -------------- */

	if ($RequestType == "Update") /* since the SSN is the primary key, don't allow the user to change it */
	{
		print ("<tr align=right valign=middle><td align=right bgcolor='#003399' valign=middle>");
		print ("<p class='White' style='text-align: right;'>SSN</p></td>");
		print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");
		print ("<input type='text' name='SSN' readonly style='background: #CCCCCC' value=$SSN size='11'");
		print ("title='Can not change this field. Delete and re-add record to change'><br>");
	}

	/* --------- Allow New Records to have social security number added -------------- */

	if ($RequestType == "Insert")
	{
		print ("<tr align=right valign=middle><td align=right bgcolor='#003399' valign=middle>");
		print ("<p class='White' style='text-align: right;'>SSN</p></td>");
		print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");
		print ("<input type='text' name='SSN' size='11'><br></td>");
	}

	print ("</tr>"); // end of row

	/* empty row */

	print ("<tr align=right valign=middle><td bgcolor='#003399' align=right valign=middle>");
	print ("<p class='White' style='text-align: right;'>&nbsp;</p></td>");
	print ("<td align=right bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' ");
	print ("color='#000099'>&nbsp;</font></td></tr>");

	/* --------- Co-Applicant Info ------------ */

	print ("<tr align=right valign=middle><td align=right bgcolor='#003399' valign=middle>");
	print ("<p class='White' style='text-align: right;'>Co-Applicant Name</font></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");

	print ("<input type='text' name='Co_ApplicantName' value='$Co_ApplicantName' size='30'><br></td>");
	print ("<input type='hidden' name='Co_ApplicantFirstName' value='$Co_ApplicantFirstName' size='30'><br></td>");
	print ("<input type='hidden' name='Co_ApplicantLastName' value='$Co_ApplicantLastName' size='30'><br></td>");

	print ("</tr>"); // end of row

	print ("<tr align=right  valign=middle><td align=right bgcolor='#003399' valign=middle>");
	print ("<p class='White' style='text-align: right;'>Date of Birth</p></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");

	print ("<input type='text' name='Co_DOB' value='$Co_DOB' size='10'><br></td>");

	print ("</tr>"); // end of row

	print ("<tr align=right valign=middle><td bgcolor='#003399' align=right valign=middle>");
	print ("<p class='White' style='text-align: right;'>SSN</p></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");

	if ($Co_SSN == 0)  // Don't print social security numbers that equal zero
	{
		$Co_SSN='&nbsp;';
	}

	print ("<input type='text' name='Co_SSN' value='$Co_SSN' size='11'><br></td>");

	print ("</tr>"); // end of row

	/* empty row */

	print ("<tr align=right valign=middle><td bgcolor='#003399' align=right valign=middle><font color='#FFFFFF' ");
	print ("face='Verdana' size='2' color='#000099'>&nbsp;</font></td>");
	print ("<td align=right bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' ");
	print ("color='#000099'>&nbsp;</font></td></tr>");

	/* --------------- Other Applicant Info fields ------------ */

	print ("<tr align=right  valign=middle><td align=right bgcolor='#003399' valign=middle>");
	print ("<p class='White' style='text-align: right;'>Referred Method</p></td>");


	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");

	print ("<select size='1' name='HowReferred'>");

	if (($HowReferred=='') or ($HowReferred=='Please Select'))
	{
		print ("<option selected value='none'>Please Select</option>");
		print ("<option value='Google'>Google</option>");
		print ("<option value='Yahoo'>Yahoo</option>");
		print ("<option value='MSN'>MSN</option>");
		print ("<option value='AOL'>AOL</option>");
		print ("<option value='Other Search Engine'>Other Search Engine</option>");
		print ("<option value='Mortgage Professor'>Mortgage Professor</option>");
		print ("<option value='A Friend'>Friend</option>");
		print ("<option value='TV Commercial'>TV Commercial</option>");
		print ("<option value='Radio Commercial'>Radio Commercial</option>");
		print ("<option value='Newspaper Ad'>Newspaper Ad</option>");
		print ("<option value='Other'>Other</option>");

		print ("<option value='Internet Lead'>Internet Lead</option>");

	}

	if ($HowReferred=='Google')
	{
		print ("<option selected value='Google'>Google</option>");
		print ("<option value='Yahoo'>Yahoo</option>");
		print ("<option value='MSN'>MSN</option>");
		print ("<option value='AOL'>AOL</option>");
		print ("<option value='Other Search Engine'>Other Search Engine</option>");
		print ("<option value='Mortgage Professor'>Mortgage Professor</option>");
		print ("<option value='A Friend'>Friend</option>");
		print ("<option value='Other'>Other</option>");
		print ("<option value='TV Commercial'>TV Commercial</option>");
		print ("<option value='Radio Commercial'>Radio Commercial</option>");
		print ("<option value='Newspaper Ad'>Newspaper Ad</option>");
		print ("<option value='Internet Lead'>Internet Lead</option>");
	}

	if ($HowReferred=='MSN')
	{
		print ("<option value='Google'>Google</option>");
		print ("<option value='Yahoo'>Yahoo</option>");
		print ("<option selected value='MSN'>MSN</option>");
		print ("<option value='AOL'>AOL</option>");
		print ("<option value='Other Search Engine'>Other Search Engine</option>");
		print ("<option value='Mortgage Professor'>Mortgage Professor</option>");
		print ("<option value='A Friend'>Friend</option>");
		print ("<option value='Other'>Other</option>");
		print ("<option value='TV Commercial'>TV Commercial</option>");
		print ("<option value='Radio Commercial'>Radio Commercial</option>");
		print ("<option value='Newspaper Ad'>Newspaper Ad</option>");
	    print ("<option value='Internet Lead'>Internet Lead</option>");
	}

	if ($HowReferred=='AOL')
	{
		print ("<option value='Google'>Google</option>");
		print ("<option value='Yahoo'>Yahoo</option>");
		print ("<option value='MSN'>MSN</option>");
		print ("<option selected value='AOL'>AOL</option>");
		print ("<option value='Other Search Engine'>Other Search Engine</option>");
		print ("<option value='Mortgage Professor'>Mortgage Professor</option>");
		print ("<option value='A Friend'>Friend</option>");
		print ("<option value='Other'>Other</option>");
		print ("<option value='TV Commercial'>TV Commercial</option>");
		print ("<option value='Radio Commercial'>Radio Commercial</option>");
		print ("<option value='Newspaper Ad'>Newspaper Ad</option>");
	    print ("<option value='Internet Lead'>Internet Lead</option>");
	}

	if ($HowReferred=='Other Search Engine')
	{
		print ("<option value='Google'>Google</option>");
		print ("<option value='Yahoo'>Yahoo</option>");
		print ("<option value='MSN'>MSN</option>");
		print ("<option value='AOL'>AOL</option>");
		print ("<option selected value='Other Search Engine'>Other Search Engine</option>");
		print ("<option value='Mortgage Professor'>Mortgage Professor</option>");
		print ("<option value='A Friend'>Friend</option>");
		print ("<option value='Other'>Other</option>");
		print ("<option value='TV Commercial'>TV Commercial</option>");
		print ("<option value='Radio Commercial'>Radio Commercial</option>");
		print ("<option value='Newspaper Ad'>Newspaper Ad</option>");
	    print ("<option value='Internet Lead'>Internet Lead</option>");
	}

	if ($HowReferred=='Mortgage Professor')
	{
		print ("<option value='Google'>Google</option>");
		print ("<option value='Yahoo'>Yahoo</option>");
		print ("<option value='MSN'>MSN</option>");
		print ("<option value='AOL'>AOL</option>");
		print ("<option value='Other Search Engine'>Other Search Engine</option>");
		print ("<option selected value='Mortgage Professor'>Mortgage Professor</option>");
		print ("<option value='A Friend'>Friend</option>");
		print ("<option value='Other'>Other</option>");
		print ("<option value='TV Commercial'>TV Commercial</option>");
		print ("<option value='Radio Commercial'>Radio Commercial</option>");
		print ("<option value='Newspaper Ad'>Newspaper Ad</option>");
	    print ("<option value='Internet Lead'>Internet Lead</option>");
	}

	if ($HowReferred=='A Friend')
	{
		print ("<option value='Google'>Google</option>");
		print ("<option value='Yahoo'>Yahoo</option>");
		print ("<option value='MSN'>MSN</option>");
		print ("<option value='AOL'>AOL</option>");
		print ("<option value='Other Search Engine'>Other Search Engine</option>");
		print ("<option value='Mortgage Professor'>Mortgage Professor</option>");
		print ("<option selected value='A Friend'>Friend</option>");
		print ("<option value='Other'>Other</option>");
		print ("<option value='TV Commercial'>TV Commercial</option>");
		print ("<option value='Radio Commercial'>Radio Commercial</option>");
		print ("<option value='Newspaper Ad'>Newspaper Ad</option>");
	    print ("<option value='Internet Lead'>Internet Lead</option>");
	}

	if ($HowReferred=='Other')
	{
		print ("<option value='Google'>Google</option>");
		print ("<option value='Yahoo'>Yahoo</option>");
		print ("<option value='MSN'>MSN</option>");
		print ("<option value='AOL'>AOL</option>");
		print ("<option value='Other Search Engine'>Other Search Engine</option>");
		print ("<option value='Mortgage Professor'>Mortgage Professor</option>");
		print ("<option value='A Friend'>Friend</option>");
		print ("<option selected value='Other'>Other</option>");
		print ("<option value='TV Commercial'>TV Commercial</option>");
		print ("<option value='Radio Commercial'>Radio Commercial</option>");
		print ("<option value='Newspaper Ad'>Newspaper Ad</option>");
	    print ("<option value='Internet Lead'>Internet Lead</option>");
	}

	if ($HowReferred=='TV Commercial')
	{
		print ("<option value='Google'>Google</option>");
		print ("<option value='Yahoo'>Yahoo</option>");
		print ("<option value='MSN'>MSN</option>");
		print ("<option value='AOL'>AOL</option>");
		print ("<option value='Other Search Engine'>Other Search Engine</option>");
		print ("<option value='Mortgage Professor'>Mortgage Professor</option>");
		print ("<option value='A Friend'>Friend</option>");
		print ("<option value='Other'>Other</option>");
		print ("<option selected value='TV Commercial'>TV Commercial</option>");
		print ("<option value='Radio Commercial'>Radio Commercial</option>");
		print ("<option value='Newspaper Ad'>Newspaper Ad</option>");
	    print ("<option value='Internet Lead'>Internet Lead</option>");
	}

	if ($HowReferred=='Radio Commercial')
	{
		print ("<option value='Google'>Google</option>");
		print ("<option value='Yahoo'>Yahoo</option>");
		print ("<option value='MSN'>MSN</option>");
		print ("<option value='AOL'>AOL</option>");
		print ("<option value='Other Search Engine'>Other Search Engine</option>");
		print ("<option value='Mortgage Professor'>Mortgage Professor</option>");
		print ("<option value='A Friend'>Friend</option>");
		print ("<option value='Other'>Other</option>");
		print ("<option value='TV Commercial'>TV Commercial</option>");
		print ("<option selected value='Radio Commercial'>Radio Commercial</option>");
		print ("<option value='Newspaper Ad'>Newspaper Ad</option>");
	    print ("<option value='Internet Lead'>Internet Lead</option>");
	}

	if ($HowReferred=='Newspaper Ad')
	{
		print ("<option value='Google'>Google</option>");
		print ("<option value='Yahoo'>Yahoo</option>");
		print ("<option value='MSN'>MSN</option>");
		print ("<option value='AOL'>AOL</option>");
		print ("<option value='Other Search Engine'>Other Search Engine</option>");
		print ("<option value='Mortgage Professor'>Mortgage Professor</option>");
		print ("<option value='A Friend'>Friend</option>");
		print ("<option value='Other'>Other</option>");
		print ("<option value='TV Commercial'>TV Commercial</option>");
		print ("<option value='Radio Commercial'>Radio Commercial</option>");
		print ("<option selected value='Newspaper Ad'>Newspaper Ad</option>");
	    print ("<option value='Internet Lead'>Internet Lead</option>");
	}

	if ($HowReferred=='Internet Lead')
	{
		print ("<option value='Google'>Google</option>");
		print ("<option value='Yahoo'>Yahoo</option>");
		print ("<option value='MSN'>MSN</option>");
		print ("<option value='AOL'>AOL</option>");
		print ("<option value='Other Search Engine'>Other Search Engine</option>");
		print ("<option value='Mortgage Professor'>Mortgage Professor</option>");
		print ("<option value='A Friend'>Friend</option>");
		print ("<option value='Other'>Other</option>");
		print ("<option value='TV Commercial'>TV Commercial</option>");
		print ("<option value='Radio Commercial'>Radio Commercial</option>");
		print ("<option value='Newspaper Ad'>Newspaper Ad</option>");
	    print ("<option selected value='Internet Lead'>Internet Lead</option>");
	}

	if ($HowReferred=='Yahoo')
	{
		print ("<option value='Google'>Google</option>");
		print ("<option selected value='Yahoo'>Yahoo</option>");
		print ("<option value='MSN'>MSN</option>");
		print ("<option value='AOL'>AOL</option>");
		print ("<option value='Other Search Engine'>Other Search Engine</option>");
		print ("<option value='Mortgage Professor'>Mortgage Professor</option>");
		print ("<option value='A Friend'>Friend</option>");
		print ("<option value='Other'>Other</option>");
		print ("<option value='TV Commercial'>TV Commercial</option>");
		print ("<option value='Radio Commercial'>Radio Commercial</option>");
		print ("<option value='Newspaper Ad'>Newspaper Ad</option>");
	    print ("<option value='Internet Lead'>Internet Lead</option>");
	}

    print ("</select></font><br></td>");

	print ("</tr>"); // end of row

	print ("<tr align=right  valign=middle><td align=right bgcolor='#003399' valign=middle>");
	print ("<p class='White' style='text-align: right;'>Loan Status");
	//print ("Line ".__LINE__." Loan Status:$LoanStatus:");
	print ("</p></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");

	FilterStatus(); //This is actually the $LoanStatus field on this (ApplicantMaintenance.php) page

	print ("</font><br></td>");
	print ("</tr>"); // end of row

	/* --------- Date Inserted ------------ */

	print ("<tr align=right valign=middle><td align=right bgcolor='#003399' valign=middle>");

	print ("<p class='White' style='text-align: right;'>Date Entered (MM/DD/YY Format)</p></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");
	if($RequestType != "Insert")
	{
		list($year, $month, $day) = sscanf($DateInserted, "%02d/%02d/%02d");	// reformat YY/MM/DD date
		$DateInserted = sprintf("%02d/%02d/%02d", $month, $day, $year);			// to MM/DD/YY
	}
	print ("<input type='text' name='DateInserted' value='$DateInserted' size='8'><br></td>");

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

	print ("<form name='ReList' action='ApplicantList.php' method='post'>");

	print ("<input class='Submit' type='submit' name='Submit' value='Browse Applicants'");
	print ("</form>");

	/* verify the passed parameter values */
	/*
	print ("<br>\nSavedLoanStatus=$SavedLoanStatus<br>\n");
	print ("RequestType=$RequestType<br>\n");
	print ("ApplicantName=$ApplicantName<br>\n");
	print ("DOB=$DOB<br>\n");
	print ("SSN=$SSN<br>\n");
	print ("Co_ApplicantName=$Co_ApplicantName<br>\n");
	print ("Co_DOB=$Co_DOB<br>\n");
	print ("Co_SSN=$Co_SSN<br>\n");
	*/

	/* If the user wants to return to the Applicant List page, send along the saved Loan Status filter value	*/

	/*
	print ("SavedLoanStatus=$SavedLoanStatus\n");
	*/

	print ("</td></tr>");	// end of row
	print ("</table>"); // end of table
?>
</body>

</html>
