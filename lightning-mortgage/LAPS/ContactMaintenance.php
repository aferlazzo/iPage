<?php
require ("../include/authenticate.php");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<html>
<head>
<title>ContactMaintenance</title>
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
*	ContactMaintenance - This page is user interface page for adding and chaging Contact table entries.			*/
*	It displays a record from the table. 																		*/
*																												*/
* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
-->

<script language="JavaScript">

/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */
/*																												*/
/*	Validate()	This JavaScript function is called by the html onSubmit object prior to the page passing the 	*/
/*	the user to the ContactUpdate page (which performs the actual my_SQL database queries). The function		*/
/*	simply verifies the user input prior to the database updating page.											*/
/*																												*/
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */

function Validate()
{
	/*
	alert("In Validate() passed ContactInfo.elements[0] is |" + document.ContactInfo.elements[0].value + "|");
	alert("In Validate() passed ContactInfo.elements[1] is |" + document.ContactInfo.elements[1].value + "|");
	alert("In Validate() passed ContactInfo.elements[2] is |" + document.ContactInfo.elements[2].value + "|");
	alert("In Validate() passed ContactInfo.elements[3] is |" + document.ContactInfo.elements[3].value + "|");
	alert("In Validate() passed ContactInfo.elements[4] is |" + document.ContactInfo.elements[4].value + "|");
	alert("In Validate() passed ContactInfo.elements[5] is |" + document.ContactInfo.elements[5].value + "|");
	alert("In Validate() passed ContactInfo.elements[6] is |" + document.ContactInfo.elements[6].value + "|");
	alert("In Validate() passed ContactInfo.elements[7] is |" + document.ContactInfo.elements[7].value + "|");

	document.writeln("A writeln is |" + document.ContactInfo.StatusFlag.value + "|");
	*/

	if (!document.ContactInfo.SSN.value.length == 11)   /* check the length of the SS Numbers */
	{
	  alert("SSN length error: Must be 11 characters");
	  document.ContactInfo.SSN.focus();
	  document.ContactInfo.SSN.select();
	  return(false);
	}

	if (document.ContactInfo.Street.value.length == 0)
	{
	  alert("Street: Must be entered");
	  document.ContactInfo.Street.focus();
	  document.ContactInfo.Street.select();
	  return(false);
	}

    if (document.ContactInfo.City.value.length == 0)   /* if there's no space in the name */
	{
	  alert("City: Must be entered");
	  document.ContactInfo.City.focus();
	  document.ContactInfo.City.select();
	  return(false);
	}

	/*
	alert("|" + document.ContactInfo.State.value + "| length = " + document.ContactInfo.State.value.length);
	*/

	if (!document.ContactInfo.State.value.length == 2)
	{
	  alert("State: Must be entered");
	  document.ContactInfo.State.focus();
	  document.ContactInfo.State.select();
	  return(false);
	}

	if (document.ContactInfo.Zip.value.length == 0)
	{
	  alert("Zip: Must be entered");
	  document.ContactInfo.Zip.focus();
	  document.ContactInfo.Zip.select()
	  return(false);
	}

	/* if there is a work phome */

	if ((document.ContactInfo.WorkPhone.value.length > 0) && (document.ContactInfo.WorkPhone.length < 12))
	{
	  alert("WorkPhone: please use 999-999-9999 format");
	  document.ContactInfo.WorkPhone.focus();
	  document.ContactInfo.WorkPhone.select();
	  return(false);
	}

	/* if there is a home home */

	if ((document.ContactInfo.HomePhone.value.length > 0) && (document.ContactInfo.HomePhone.length < 12))
	{
	  alert("HomePhone: please use 999-999-9999 format");
	  document.ContactInfo.HomePhone.focus();
	  document.ContactInfo.HomePhone.select();
	  return(false);
	}

	if (document.ContactInfo.BestCallTime.value == "none")
	{
	  alert("BestCallTime: must be entered");
	  document.ContactInfo.BestCallTime.focus();
	  return(false);
	}

	if (document.ContactInfo.BestCallNumber.value=="none")
	{
	  alert("Please Choose 'Best Call Number'");
	  document.ContactInfo.BestCallNumber.focus();
	  return(false);
	}
/*
	if (document.ContactInfo.StatusFlag.value.length ==0)
	{
	  alert("Please Choose the current 'Status Flag'");
	  document.ContactInfo.StatusFlag.focus();
	  document.ContactInfo.StatusFlag.select();
	  return(false);
	}
	else
	{
		return(true);
	}
*/
}
</script>
</head>

<body>
<!--
#	/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
#	/*																									*/
#	/*	ContactMaintenance.php - This current page has to pass the variables value to the Contact 	*/
#	/*	Update page, or back to the Contact List page (whichever one is called from here, depending 	*/
#	/*	on user input).																					*/
#	/*																									*/
#	/*																									*/
#	/*	Calls ContactUpdate.php. Passes the variables $RequestType, $ContactName, */
#	/*	$DOB, $SSN, $Co_Contact, $Co_DOB, $Co_SSN														*/
#	/*																									*/
#	/*	Calls ContactList.php. Passes $SavedFilter													*/
#	/*																									*/
#	/*																									*/
#	/*	Sample of URL string: http://www.lightning-mortgage.com/ContactMaintenance.php?SSN=111111111	*/
#	/*	&DOB=060606&ContactName=This%20is%20another%20%20new%20Contact&Co_SSN=666551111&Co_DOB=		*/
#	/*	060606&Co_ContactName=Newer%20Contact&RequestType=Update&HowReferred=Mortgage%20Professor	*/
#	/*	&LoanStatus=Active																				*/
#	/*																									*/
#	/*																									*/
#	/*																									*/
#	/*	ContactUpdate.php all calls this page.  				*/
#	/*																									*/
#	/*																									*/
#	/*																									*/
#	/* We must do this because once the update of an existing record or the insertion of a new record	*/
#	/* is performed, this ContactUpdate page will return	the user to the ContactList.php page. 	*/
#	/* We want to maintain the current filter & continue the same list when we return. Since the Loan 	*/
#	/* of this current record may be changed by user input in the course of executing this page, we 	*/
#	/* save the value of this variable and pass it back when returning to the ContactList page. 		*/
#	/*																									*/
#	/* Returning to the List page directly from here (that is, without updating the database/without	*/
#	/* transferring control to the ContactUpdate page) is done by the user when he presses the Reset 	*/
#	/* button. The onClick method passes the URL and filter 			.								*/
#	/*																									*/
#	/* When records are being updated, we pass the saved value to the ContactUpdate page using this	*/
#	/* hidden field for Saved Loan Status to the ContactUpdate page. It is passed with the other form */
#	/* fields using the built-in <form> variable passing functionality.									*/
#	/*																									*/
#	/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
-->
<?php

	if ($RequestType == 'Delete')
	{
		$aaa = $_POST[SSN];
		$bbb = $_POST[ApplicantName];
		$ccc = $_POST[Street];
		$ddd = $_POST[City];
		$eee = $_POST[State];
		$fff = $_POST[Zip];
		$ggg = $_POST[WorkPhone];
		$hhh = $_POST[HomePhone];
		$iii = $_POST[BestCallTime];
		$jjj = $_POST[BestCallNumber];
		$kkk = $_POST[email];
		$lll = $_POST[StatusFlag];
		$mmm = $_POST[LoanStatus];

		print ("<form name='EditRecord' action='ContactUpdate.php' method='post'>");
		print ("<input type='hidden' name=SSN value='$aaa'>");
		print ("<input type='hidden' name=ApplicantName value='$bbb'>");
		print ("<input type='hidden' name=Street value='$ccc'>");
		print ("<input type='hidden' name=City value='$ddd'>");
		print ("<input type='hidden' name=State value='$eee'>");
		print ("<input type='hidden' name=Zip value='$fff'>");
		print ("<input type='hidden' name=WorkPhone value='$ggg'>");
		print ("<input type='hidden' name=HomePhone value='$hhh'>");
		print ("<input type='hidden' name=BestCallTime value='$iii'>");
		print ("<input type='hidden' name=BestCallNumber value='$jjj'>");
		print ("<input type='hidden' name=email value='$kkk'>");
		print ("<input type='hidden' name=StatusFlag value='$lll'>");
		print ("<input type='hidden' name=LoanStatus value='$mmm'>");
		print ("<input type='hidden' name=RequestType value='$RequestType'>");
		print ("<script language='Javascript'>document.EditRecord.submit();</script>");
		print ("</form>");

	}

/*
	print ("RequestType='$RequestType'<br>\n");
	print ("SSN:$SSN<br>\n");
	print ("ApplicantName:'$ApplicantName'<br>\n");
	print ("Street:'$Street'<br>\n");
	print ("City:'$City'<br>\n");
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
		$xxx= substr($SSN,0,3).'-'.substr($SSN,3,2).'-'.substr($SSN,5,4);
		$SSN=$xxx;
	}

/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
/*																					*/
/* Start of a new form, necessary to inputs and/or display the fields for the table	*/
/*																					*/
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
	$xxx=$RequestType;

	if ($UserLevel != "Admin")
		print ("<form name='ContactInfo' action='FunctionDisabled.php' method='get' onSubmit='return(Validate());'><br>");
	else
		print ("<form name='ContactInfo' action='ContactUpdate.php' method='get' onSubmit='return(Validate());'><br>");


	/************ minor php annoyance *******************/


	/*********** print must start and end with double quotes to do variable name substitution with values *******/


	print ("<input type='hidden' name='RequestType' value='$xxx'>");

	print ("<input type='hidden' name='SavedLoanStatus'>");


	// create a table

	print ("<table border=1 cellspacing=0 cellpadding=4 align=center>");

	/* ------- Header Row ---------- */

	print ("<tr align='center' valign='middle'><td align='center' valign='middle'>");
	print ("<font face='Verdana' size='2' color='#000099'><a href='ApplicantMaster.php'>Home</a></font></td>");

	if ($RequestType == "Update")
	{
		print ("<td align=center valign=middle colspan='2'><font face='Verdana' size='3'
		color='#000099'><strong>Update Contact Information</strong></font></td>");
	}
	else
	{
		print ("<td align=center valign=middle colspan='2'><font face='Verdana' size='3'
		color='#000099'><strong>Add New Contact Information</strong></font></td>");
	}

	print ("</tr>"); // end of row

	/* --------- Contact Info ------------ */

	print ("<tr align=right valign=middle><td align=right bgcolor='#003399' valign=middle>");

	print ("<p class='White' style='text-align: right;'>Social Security #</p></td>");

	/* --------- Prohibit Update function to change social security number -------------- */

	if ($RequestType == "Update") /* since the SSN is the primary key, don't allow the user to change it */
	{
		print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099' ");
		print ("bgcolor=><input type='text' name='SSN' readonly style='background: #CCCCCC' value='$SSN' size='11'");
		print ("title='Can not change this field. Delete and re-add record to change'><br>");

		print ("</tr><tr align='right' valign='middle'><td align='right' bgcolor='#003399' valign='middle'>");
		print ("<p class='White' style='text-align: right;'>Applicant Name</p></td>");

		print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");

		print ("<input type='text' name='ApplicantName' readonly style='background: #CCCCCC' value='$ApplicantName' size='25'");
		print ("title='Can not change this field. Delete and or change in Applicant Info List'></td>");
	}

	/* --------- Allow New Records to  have social security number added -------------- */

	if ($RequestType == "Insert")
	{
		print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");
		print ("<input type='text' name='SSN' value='$SSN' size='11'><br></td>");
		print("<script language='Javascript'>document.ContactInfo.SSN.select(); document.ContactInfo.SSN.focus();</script>");
	}

	print ("</tr>"); // end of row

	print ("<tr align=right valign=middle><td align=right bgcolor='#003399' valign=middle>");

	print ("<p class='White' style='text-align: right;'>Street</p></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");

	print ("<input type='text' name='Street' value='$Street' size='30'><br></td>");

	if ($RequestType == "Update")
	{
		print("<script language='Javascript'>document.ContactInfo.Street.select(); document.ContactInfo.Street.select();</script>");
		print("<script language='Javascript'>document.ContactInfo.Street.select(); document.ContactInfo.Street.focus();</script>");

	}

	print ("</tr>"); // end of row

	print ("<tr align=right valign=middle><td align=right bgcolor='#003399' valign=middle>");

	print ("<p class='White' style='text-align: right;'>City</p></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");

	print ("<input type='text' name='City' value='$City' size='20'><br></td>");

	print ("</tr>"); // end of row

	print ("<tr align=right valign=middle><td align=right bgcolor='#003399' valign=middle>");

	print ("<p class='White' style='text-align: right;'>State</p></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");

	print ("<input type='text' name='State' value='$State' size='2'><br></td>");

	print ("</tr>"); // end of row


	print ("<tr align=right valign=middle><td align=right bgcolor='#003399' valign=middle>");

	print ("<p class='White' style='text-align: right;'>Zip</p></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");

	print ("<input type='text' name='Zip' value='$Zip' size='11'><br></td>");

	print ("</tr>"); // end of row


	print ("<tr align=right valign=middle><td align=right bgcolor='#003399' valign=middle>");

	print ("<p class='White' style='text-align: right;'>Work Phone</p></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");

	print ("<input type='text' name='WorkPhone' value='$WorkPhone' size='12'><br></td>");

	print ("</tr>"); // end of row


	print ("<tr align=right valign=middle><td align=right bgcolor='#003399' valign=middle>");

	print ("<p class='White' style='text-align: right;'>Home Phone</p></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");

	print ("<input type='text' name='HomePhone' value='$HomePhone' size='12'><br></td>");

	print ("</tr>"); // end of row


	print ("<tr align=right valign=middle><td align=right bgcolor='#003399' valign=middle>");

	print ("<p class='White' style='text-align: right;'>Best Call Time</p></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");

	/*print ("<input type='text' name='BestCallTime' value='$BestCallTime' size='9'><font face='Verdana size='2'><br></td>");*/

		print ("<select size='1' name='BestCallTime'>");

	//print("<td>$BestCallTime</td>");

	switch ($BestCallTime)
	{
		case "8 am - 10 am":
			print ("<option value='Anytime' selected>Anytime");
			print ("<option selected value='8 am - 10 am'>8 am - 10 am");
			print ("<option value='10 am - 12 pm'>10 am - 12 pm");
	 		print ("<option value='12 pm - 2 pm'>12 pm - 2 pm");
			print ("<option value='2 pm - 4 pm'>2 pm - 4 pm");
			print ("<option value='4 pm - 6 pm'>4 pm - 6 pm");
			print ("<option value='6 pm - 8 pm'>6 pm - 8 pm");
			break;

		case "10 am - 12 pm":
			print ("<option value='Anytime' selected>Anytime");
			print ("<option value='8 am - 10 am'>8 am - 10 am");
			print ("<option selected value='10 am - 12 pm'>10 am - 12 pm");
	 		print ("<option value='12 pm - 2 pm'>12 pm - 2 pm");
			print ("<option value='2 pm - 4 pm'>2 pm - 4 pm");
			print ("<option value='4 pm - 6 pm'>4 pm - 6 pm");
			print ("<option value='6 pm - 8 pm'>6 pm - 8 pm");
			break;

		case "12 pm - 2 pm":
			print ("<option value='Anytime' selected>Anytime");
			print ("<option value='8 am - 10 am'>8 am - 10 am");
			print ("<option value='10 am - 12 pm'>10 am - 12 pm");
 			print ("<option selected value='12 pm - 2 pm'>12 pm - 2 pm");
			print ("<option value='2 pm - 4 pm'>2 pm - 4 pm");
			print ("<option value='4 pm - 6 pm'>4 pm - 6 pm");
			print ("<option value='6 pm - 8 pm'>6 pm - 8 pm");
			break;

		case "2 pm - 4 pm":
			print ("<option value='Anytime' selected>Anytime");
			print ("<option value='8 am - 10 am'>8 am - 10 am");
			print ("<option value='10 am - 12 pm'>10 am - 12 pm");
	 		print ("<option value='12 pm - 2 pm'>12 pm - 2 pm");
			print ("<option selected value='2 pm - 4 pm'>2 pm - 4 pm");
			print ("<option value='4 pm - 6 pm'>4 pm - 6 pm");
			print ("<option value='6 pm - 8 pm'>6 pm - 8 pm");
			break;

		case "4 pm - 6 pm":
			print ("<option value='Anytime' selected>Anytime");
			print ("<option value='8 am - 10 am'>8 am - 10 am");
			print ("<option value='10 am - 12 pm'>10 am - 12 pm");
	 		print ("<option value='12 pm - 2 pm'>12 pm - 2 pm");
			print ("<option value='2 pm - 4 pm'>2 pm - 4 pm");
			print ("<option selected value='4 pm - 6 pm'>4 pm - 6 pm");
			print ("<option value='6 pm - 8 pm'>6 pm - 8 pm");
			break;

		case"6 pm - 8 pm":
			print ("<option value='Anytime' selected>Anytime");
			print ("<option value='8 am - 10 am'>8 am - 10 am");
			print ("<option value='10 am - 12 pm'>10 am - 12 pm");
	 		print ("<option value='12 pm - 2 pm'>12 pm - 2 pm");
			print ("<option value='2 pm - 4 pm'>2 pm - 4 pm");
			print ("<option value='4 pm - 6 pm'>4 pm - 6 pm");
			print ("<option selected value='6 pm - 8 pm'>6 pm - 8 pm");
			break;

		default:
			print ("<option selected value='Anytime' selected>Anytime");
			print ("<option value='8 am - 10 am'>8 am - 10 am");
			print ("<option value='10 am - 12 pm'>10 am - 12 pm");
 			print ("<option value='12 pm - 2 pm'>12 pm - 2 pm");
			print ("<option value='2 pm - 4 pm'>2 pm - 4 pm");
			print ("<option value='4 pm - 6 pm'>4 pm - 6 pm");
			print ("<option value='6 pm - 8 pm'>6 pm - 8 pm");
			break;
	}

	print ("</select></font></tr>"); // end of row


	print ("<tr align=right valign=middle><td align=right bgcolor='#003399' valign=middle>");

	print ("<p class='White' style='text-align: right;'>Best Call Phone</p></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");

	/*print ("<input type='text' name='BestCallNumber' value='$BestCallNumber' size='5'><br></td>");*/

	print ("<select size='1' name='BestCallNumber'>");

	if (($BestCallNumber=="") || ($BestCallNumber=='Either Phone'))
	{
		print ("<option selected value='Either Phone'>Either Phone");
		print ("<option value='Home Phone'>Home Phone");
		print ("<option value='Work Phone'>Work Phone");
	}

	if ($BestCallNumber=="Home Phone")
	{
		print ("<option value='Either Phone'>Either Phone");
		print ("<option selected value=''>Home Phone");
		print ("<option value='Work Phone'>Work Phone");
	}

	if ($BestCallNumber=="Work Phone")
	{
		print ("<option value='Either Phone'>Either Phone");
		print ("<option value='Home Phone'>Home Phone");
		print ("<option selected value='Work Phone'>Work Phone");
	}

	print ("</select></font></tr>"); // end of row


	print ("<tr align=right valign=middle><td align=right bgcolor='#003399' valign=middle>");

	print ("<p class='White' style='text-align: right;'>E-Mail Address</p></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");

	print ("<input type='text' name='email' value='$email' size='30'><br></td>");

	print ("</tr>"); // end of row

/*
	print ("<tr align=right valign=middle><td align=right bgcolor='#003399' valign=middle>");

	print ("<p class='White' style='text-align: right;'>Status Flag</p></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");

	print ("<input type='text' name='StatusFlag' value='$StatusFlag' size='10'><br></td>");

	print ("</tr>"); // end of row
*/

	print ("<tr align=right  valign=middle><td align=right bgcolor='#003399' valign=middle>");
	print ("<p class='White' style='text-align: right;'>Loan Status</p></td>");

	print ("<td align=left bgcolor='#6699FF' valign=middle><font face='Verdana' size='2' color='#000099'>");

	print ("<input type='text' readonly style='background: #CCCCCC' name='LoanStatus' value='$LoanStatus' size='30' ");
	print ("title='Change this field in the Applicant List Maintentance page.'><br>");
	print ("</font></td>");
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

	print ("<form name='ReList' action='ContactList.php' method='get'>");

	print ("<input class='Submit' type='submit' name='submit' value='Browse Contacts'");
	print ("</form>");

	/* verify the passed parameter values */
	/*
	print ("RequestType=$RequestType<br>\n");
	print ("ContactName=$ContactName<br>\n");
	print ("DOB=$DOB<br>\n");
	print ("SSN=$SSN<br>\n");
	print ("Co_ContactName=$Co_ContactName<br>\n");
	print ("Co_DOB=$Co_DOB<br>\n");
	print ("Co_SSN=$Co_SSN<br>\n");
	*/

	/* If the user wants to return to the Contact List page, send along the saved Loan Status filter value	*/

	print ("</td></tr>");	// end of row
	print ("</table>"); // end of table
?>
</body>

</html>
