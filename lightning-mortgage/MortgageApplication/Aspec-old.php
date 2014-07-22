<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="expires" content="0">
<!--
Copyright 2001 MeridianLink, Inc.  All Rights Reserved.
-->


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" >
<HTML>
	<HEAD>
		<title>old ASPEC Order Page</title>
		<script language="javascript">

function DisplayFormElements()
{
	var Data = "<h3>Form Elements Being Sent:</h3>";
	var FormVariables=document.forms.frm;

	for (var i=0;i<FormVariables.length;i++)
		Data += FormVariables.elements[i].name+": |"+FormVariables.elements[i].value+"|<br />";

	document.getElementById('Debugging').innerHTML += Data;	
}

			
		function Submit()
		{
			if(!Validate()) return;
			//add confim window.
			//var ret = window.showModalDialog("aspec_confirm.asp", this,"dialogHeight:120px; dialogWidth:250px; center:yes; resizable:no; scroll:no; status=no; help=no;")
			//if(ret != "yes") return; 
			document.all.cmd.value = "order";
			//location.href="aspec.asp?cmd=order";
			document.all.SUBMIT.disabled = true;
			document.all.CLEAR.disabled = true;
			DisplayFormElements()
			if(confirm("Submit it?"))
				document.forms.frm.submit();
		}
		function Clear()
		{
/*		
			document.all.Firstname.value="";
			document.all.Middlename.value="";
			document.all.Lastname.value="";
			document.all.SSN.value="";
			document.all.StreetAddress.value="";
			document.all.City.value="";
			document.all.State.value="";
			document.all.Zip.value="";
			document.all.Suffix.value="";
			document.all.msgbox.style.visibility = "hidden";
			
			document.all.FirstnameCoborrower.value="";
			document.all.MiddlenameCoborrower.value="";
			document.all.LastnameCoborrower.value="";
			document.all.SuffixCoborrower.value="";
			document.all.SSNCoborrower.value="";
			
			document.all.billing_cardnum.value="";
			document.all.billing_st.value="";
			document.all.billing_city.value="";
			document.all.billing_zip.value="";
			document.all.billing_state.value="";
			document.all.billing_month.value="";
			document.all.billing_year.value="";
			document.all.billing_cvv.value="";
			
			document.all.PhoneNumber.value = "";
			document.all.EmailAddress.value = "";
			document.all.OwnOrRent.value = "";
			document.all.LoanType.value = "";
			document.all.ResidenceType.value = "";
			document.all.PaymentTerm.value = "";
			document.all.EstimatedLoanAmount.value = "";
			document.all.LoanPurpose.value = "";
			document.all.NumberOfUnits.value = "";
			document.all.InterestRateRequested.value = "";
			
			document.all.referral.value = "No Referral";
*/
		}
		function Validate()
		{
			var bHasError=false;
/*
			document.all.msgtext.innerHTML = "<font color=red>Please complete all the required fields.</font>";
			
			// BORROWER
			if(document.all.Firstname.value == "") 
			{
				document.all.firstname_st.style.visibility = "visible";
				bHasError=true;
			}
			else
			{
				document.all.firstname_st.style.visibility = "hidden";
			}
			
			if(document.all.Lastname.value == "")
			{
				document.all.lastname_st.style.visibility = "visible";
				bHasError=true;
			}
			else
			{
				document.all.lastname_st.style.visibility = "hidden";
			}
			
			if(document.all.SSN.value == "") 
			{
				document.all.ssn_st.style.visibility = "visible";
				bHasError=true;
			}
			else
			{
				var sSSNValue = document.all.SSN.value;
				var rgSSN1 = /^ *[0-9]{9} *$/;
				sSSNValue = sSSNValue.replace(/[\- ]/g, "");
				var sMatch = rgSSN1.exec(sSSNValue);
				if(sMatch == null) 
				{
					document.all.ssn_st.style.visibility = "visible";
					document.all.msgtext.innerHTML = "<font color=red>SSN is in incorrect format</font>";
					bHasError=true;
				}
				else 
				{
					document.all.ssn_st.style.visibility = "hidden";
					document.all.SSN.value = sSSNValue;
				}
			}
			
			// COBORROWER
			// Coborrower fields, if any of them are filled, First/Last/SSN becomes required
			if (document.all.FirstnameCoborrower.value  == "" &&
				document.all.MiddlenameCoborrower.value == "" &&
				document.all.LastnameCoborrower.value   == "" &&
				document.all.SuffixCoborrower.value     == "" &&
				document.all.SSNCoborrower.value        == ""    )
			{
				document.all.firstnameCoborrower_st.style.visibility = "hidden";
				document.all.lastnameCoborrower_st.style.visibility  = "hidden";
				document.all.ssnCoborrower_st.style.visibility       = "hidden";
			}
			else if (document.all.FirstnameCoborrower.value != "" &&
					 document.all.LastnameCoborrower.value  != "" &&
					 document.all.SSNCoborrower.value       != ""    )
			{
				document.all.firstnameCoborrower_st.style.visibility = "hidden";
				document.all.lastnameCoborrower_st.style.visibility  = "hidden";
				document.all.ssnCoborrower_st.style.visibility       = "hidden";
			}
			else
			{
				document.all.firstnameCoborrower_st.style.visibility = (document.all.FirstnameCoborrower.value == "") ? "visible" : "hidden";
				document.all.lastnameCoborrower_st.style.visibility  = (document.all.LastnameCoborrower.value == "")  ? "visible" : "hidden";
				document.all.ssnCoborrower_st.style.visibility       = (document.all.SSNCoborrower.value == "")       ? "visible" : "hidden";
			
				bHasError = true;
			}
			
			// test Coborrower's SSN value
			if(document.all.SSNCoborrower.value != "") 
			{
				var sSSNValue = document.all.SSNCoborrower.value;
				var rgSSN2 = /^ *[0-9]{9} *$/;
				sSSNValue = sSSNValue.replace(/[\- ]/g, "");
				var sMatch = rgSSN2.exec(sSSNValue);
				if(sMatch == null) 
				{
					document.all.ssnCoborrower_st.style.visibility = "visible";
					document.all.msgtext.innerHTML = "<font color=red>Coborrower SSN is in incorrect format</font>";
					bHasError=true;
				}
				else 
				{
					document.all.ssnCoborrower_st.style.visibility = "hidden";
					document.all.SSNCoborrower.value = sSSNValue;
				}
			}
			
			if(document.all.StreetAddress.value == "") 
			{
				document.all.staddress_st.style.visibility="visible";
				bHasError=true;
			}
			else
			{
				document.all.staddress_st.style.visibility="hidden";
			}
			
			if(document.all.City.value == "")
			{
				document.all.city_st.style.visibility = "visible";
				bHasError=true;
			}
			else
			{
				document.all.city_st.style.visibility = "hidden";
			}
			
			if(document.all.State.value == "")
			{
				document.all.state_st.style.visibility = "visible"; 
				bHasError=true;
			}
			else
			{
				document.all.state_st.style.visibility = "hidden"; 
			}
			
			if(document.all.Zip.value == "" ) 
			{
				document.all.zip_st.style.visibility = "visible"; 
				bHasError=true;
			}
			else
			{
				var rgZip1 = /^ *[0-9]{5} *$/;
				document.all.Zip.value = document.all.Zip.value.replace(/[\-, ]/g, "");
				var rgMatch = rgZip1.exec(document.all.Zip.value);
				if (rgMatch == null)
				{
					document.all.msgtext.innerHTML = "<font color=red>Zip Code is in incorrect format.</font>";
					document.all.zip_st.style.visibility = "visible";
					bHasError = true;
				}
				else
				{
					document.all.zip_st.style.visibility = "hidden";
				}
			}
			
			/*----
			if(document.all.billing_first.value =="")
			{
				document.all.billing_first_st.style.visibility = "visible";
				bHasError = true;
			}
			else
			{
				document.all.billing_first_st.style.visibility = "hidden";
			}
			if(document.all.billing_sur.value =="")
			{
				document.all.billing_sur_st.style.visibility = "visible";
				bHasError = true;
			}
			else
			{
				document.all.billing_sur_st.style.visibility = "hidden";
			}
			----*/
/*
			if(document.all.billing_cardnum.value =="")
			{
				document.all.billing_cardnum_st.style.visibility = "visible";
				bHasError = true;
			}
			else
			{
				var rgCardNumber1 = /^ *[0-9]{15,16} *$/;
				document.all.billing_cardnum.value = document.all.billing_cardnum.value.replace(/[ \-]/g, "");
				var rgMatch = rgCardNumber1.exec(document.all.billing_cardnum.value);
				if(rgMatch == null)
				{
					document.all.msgtext.innerHTML="<font color=red>Credit card number is not valid.</font>";
					document.all.billing_cardnum_st.style.visibility = "visible";
					bHasError = true;
				}
				else document.all.billing_cardnum_st.style.visibility = "hidden";
			}
			if(document.all.billing_st.value =="")
			{
				document.all.billing_st_st.style.visibility = "visible";
				bHasError = true;
			}
			else
			{
				document.all.billing_st_st.style.visibility = "hidden";
			}
			if(document.all.billing_city.value =="")
			{
				document.all.billing_city_st.style.visibility = "visible";
				bHasError = true;
			}
			else
			{
				document.all.billing_city_st.style.visibility = "hidden";
			}
			if(document.all.billing_state.value =="")
			{
				document.all.billing_state_st.style.visibility = "visible";
				bHasError = true;
			}
			else
			{
				document.all.billing_state_st.style.visibility = "hidden";
			}
			if(document.all.billing_zip.value =="")
			{
				document.all.billing_zip_st.style.visibility = "visible";
				bHasError = true;
			}
			else
			{
				var rgZip1 = /^ *[0-9]{5} *$/;
				document.all.billing_zip.value = document.all.billing_zip.value.replace(/[\-, ]/g, "");
				var rgMatch = rgZip1.exec(document.all.billing_zip.value);
				if (rgMatch == null)
				{
					document.all.msgtext.innerHTML = "<font color=red>Billing Zip Code is in incorrect format.</font>";
					document.all.billing_zip_st.style.visibility = "visible";
					bCCHasError = true;
				}
				else
				{
					document.all.billing_zip_st.style.visibility = "hidden";
				}
			}
			if(document.all.billing_month.value =="")
			{
				document.all.billing_month_st.style.visibility = "visible";
				bHasError = true;
			}
			else
			{
				document.all.billing_month_st.style.visibility = "hidden";
			}
			if(document.all.billing_year.value =="")
			{
				document.all.billing_year_st.style.visibility = "visible";
				bHasError = true;
			}
			else
			{
				var rgYear1 = /^ *[0-9]{4} *$/;
				document.all.billing_year.value = document.all.billing_year.value.replace(/[\-, ]/g, "");
				var rgMatch = rgYear1.exec(document.all.billing_year.value);
				if (rgMatch == null)
				{
					document.all.msgtext.innerHTML = "<font color=red>Expiration Year is in incorrect format.</font>";
					document.all.billing_year_st.style.visibility = "visible";
					bCCHasError = true;
				}
				else
				{
					document.all.billing_year_st.style.visibility = "hidden";
				}
			}
			
			/*--- CVV shouldn't be a required field
			if(document.all.billing_cvv.value == "")
			{
				document.all.billing_cvv_st.style.visibility= "visible";
			}
			else
			{
				document.all.billing_cvv_st.style.visibility= "hidden";
			}
			---*/
			
			// Check for new fields
/*			
			if (document.all.PhoneNumber.value == "")
			{
				document.all.PhoneNumber_st.style.visibility = "visible";
				bHasError = true;
			}
			else
			{
				document.all.PhoneNumber_st.style.visibility = "hidden";
			}
			if (document.all.OwnOrRent.value == "")
			{
				document.all.OwnOrRent_st.style.visibility = "visible";
				bHasError = true;
			}
			else
			{
				document.all.OwnOrRent_st.style.visibility = "hidden";
			}
			
			// User wants mortgage info and needs to fill out fields
			if (document.all.MortgageInfo[0].checked)
			{
				if (document.all.LoanType.value == "")
				{
					document.all.LoanType_st.style.visibility = "visible";
					bHasError = true;
				}
				else
				{
					document.all.LoanType_st.style.visibility = "hidden";
				}
				if (document.all.ResidenceType.value == "")
				{
					document.all.ResidenceType_st.style.visibility = "visible";
					bHasError = true;
				}
				else
				{
					document.all.ResidenceType_st.style.visibility = "hidden";
				}
				if (document.all.PaymentTerm.value == "")
				{
					document.all.PaymentTerm_st.style.visibility = "visible";
					bHasError = true;
				}
				else
				{
					document.all.PaymentTerm_st.style.visibility = "hidden";
				}
				if (document.all.EstimatedLoanAmount.value == "")
				{
					document.all.EstimatedLoanAmount_st.style.visibility = "visible";
					bHasError = true;
				}
				else
				{
					document.all.EstimatedLoanAmount_st.style.visibility = "hidden";
				}
				if (document.all.LoanPurpose.value == "")
				{
					document.all.LoanPurpose_st.style.visibility = "visible";
					bHasError = true;
				}
				else
				{
					document.all.LoanPurpose_st.style.visibility = "hidden";
				}
				if (document.all.NumberOfUnits.value == "")
				{
					document.all.NumberOfUnits_st.style.visibility = "visible";
					bHasError = true;
				}
				else
				{
					document.all.NumberOfUnits_st.style.visibility = "hidden";
				}
				if (document.all.InterestRateRequested.value == "")
				{
					document.all.InterestRateRequested_st.style.visibility = "visible";
					bHasError = true;
				}
				else
				{
					document.all.InterestRateRequested_st.style.visibility = "hidden";
				}
			}
			// User don't want mortgage info and don't need to fill out fields
			else
			{
				document.all.LoanType_st.style.visibility = "hidden";
				document.all.ResidenceType_st.style.visibility = "hidden";
				document.all.PaymentTerm_st.style.visibility = "hidden";
				document.all.EstimatedLoanAmount_st.style.visibility = "hidden";
				document.all.LoanPurpose_st.style.visibility = "hidden";
				document.all.NumberOfUnits_st.style.visibility = "hidden";
				document.all.InterestRateRequested_st.style.visibility = "hidden";
			}
			
			// End checking for new fields
			
			if(bHasError) 
			{
				document.all.msgbox.style.visibility = "visible";
				return false;
			}
			else
			{
				document.all.msgbox.style.visibility = "hidden";
			}
*/
			return true;
		}
		function FillForm()
		{
			document.all.Firstname.value="Anthony";
			document.all.Lastname.value="Ferlazzo";
			document.all.Suffix.value="";
			document.all.SSN.value="001010022";
			
			document.all.FirstnameCoborrower.value="Frances";
			document.all.LastnameCoborrower.value="Ferlazzo";
			document.all.SuffixCoborrower.value="";
			document.all.SSNCoborrower.value="001002003";
			
			document.all.StreetAddress.value="2114 Delucchi Dr";
			document.all.City.value="Pleasanton";
			document.all.State.value="CA";
			document.all.Zip.value="94588";
			document.all.Suffix.value="";
			//document.all.billing_first.value = "Wayne";
			//document.all.billing_sur.value = "Ma";
			document.all.billing_cardnum.value = "4111111111111111";
			document.all.billing_st.value = "2114 Delucchi Dr";
			document.all.billing_city.value = "Pleas";
			document.all.billing_state.value = "CA";
			document.all.billing_zip.value = "94588";
			document.all.billing_month.value = "12";
			document.all.billing_year.value = "2007";
			//document.all.billing_cvv.value = "987";
			//document.frm.msgbox.style.visibility = "hidden";
			
			document.all.PhoneNumber.value = "925-484-4657";
			document.all.EmailAddress.value = "tony@lightning-mortgage.com";
			document.all.OwnOrRent.value = "Rent";
			document.all.LoanType.value = "Conventional";
			document.all.ResidenceType.value = "Primary Residence";
			document.all.PaymentTerm.value = "15 Years";
			document.all.EstimatedLoanAmount.value = "300000";
			document.all.LoanPurpose.value = "Purchase";
			document.all.NumberOfUnits.value = "4";
			document.all.InterestRateRequested.value = "5.5";
		}
		
		function CopyAddress()
		{
			if (document.all.SameAddress.checked)
			{
				document.all.billing_st.value = document.all.StreetAddress.value;
				document.all.billing_city.value = document.all.City.value;
				document.all.billing_state.value = document.all.State.value;
				document.all.billing_zip.value = document.all.Zip.value;
			}
			else
			{
				document.all.billing_st.value = "";
				document.all.billing_city.value = "";
				document.all.billing_state.value = "";
				document.all.billing_zip.value = "";
			}
		}
		</script>
	</HEAD>

	<LINK rel="stylesheet" type="text/css" href="https://credit.creditplus.com/custom/aspec/aspec.css">
		<body>
			<form id="frm" method="post" action="https://credit.creditplus.com/custom/aspec/aspec.asp">
				<INPUT id="cmd" type="hidden" name="cmd">
				<INPUT type="hidden" name="uid" value="52ee5158-474f-489b-83af-e57d8bc626c0">
				<INPUT type="hidden" name="sid" value="BB042CB18ED74C8E00443138454600444D4C584B494B38598214C38CE7DDE80D">
				<TABLE id=Table1 style="VISIBILITY: visible" cellPadding=2 border=0 width=420>
<TBODY>
  <TR>

    <TD colSpan=2 bgcolor=lightblue>
        <STRONG>Credit Analysis</STRONG> </TD>
    </TR>
<TR><td>
	<table border=0>
	<!-- BORROWER -->
	<TR>
		<TD class=label colSpan=4 bgcolor="#CCCCCC"><STRONG>Borrower Info:</STRONG></TD>

	</TR>
	
	<tr>	
      <TD class=label>First Name <LABEL id=firstname_st 
      style="VISIBILITY: hidden"><FONT color=red>*</FONT></LABEL><br>
		<INPUT id=Firstname name=Firstname size=16 value="">
      </TD>  
<TD class=label>Middle Name <br><INPUT id=Middlename name=Middlename size=12 value=""></TD>
      <TD class=body>Last Name <LABEL id=lastname_st 
      style="VISIBILITY: hidden"><FONT color=red>*</FONT></LABEL><br><INPUT id=Lastname size=16 name=Lastname value="">

        </TD>
		<TD class=body>Suffix <br><SELECT id=Select1 name=Suffix value="">
								<OPTION value="" selected></OPTION>
								<OPTION value="2" >JR</OPTION>
								<OPTION value="1" >SR</OPTION>
								<OPTION value="5" >I</OPTION>
								<OPTION value="6" >II</OPTION>

								<OPTION value="3" >III</OPTION>
								<OPTION value="4" >IV</OPTION>
								<!-- the original code had JR and SR's value flipped -->
        </SELECT></TD>
    </TR>
    
    <TR><TD>&nbsp;</TD></TR>
    
   </table>
</td>

</tr>

<TR>
	<TD>
		<TABLE>
			<!-- COBORROWER -->
			<TR>
				<TD class=label colSpan=4 bgcolor="#CCCCCC"><STRONG>Coborrower Info:</STRONG></TD>
			</TR>

			<TR>	
			<TD class=label>First Name <LABEL id=firstnameCoborrower_st 
				style="VISIBILITY: hidden"><FONT color=red>*</FONT></LABEL><br>
				<INPUT id=FirstnameCoborrower name=FirstnameCoborrower size=16 value="">
			</TD>  
			<TD class=label>Middle Name <br><INPUT id=MiddlenameCoborrower name=MiddlenameCoborrower size=12 value=""></TD>
			<TD class=body>Last Name <LABEL id=lastnameCoborrower_st 
				style="VISIBILITY: hidden"><FONT color=red>*</FONT></LABEL><br><INPUT id=LastnameCoborrower size=16 name=LastnameCoborrower value="">
			</TD>

			<TD class=body>Suffix <br><SELECT id=Select2 name=SuffixCoborrower value="">
								<OPTION value="" selected></OPTION>
								<OPTION value="2" >JR</OPTION>
								<OPTION value="1" >SR</OPTION>
								<OPTION value="5" >I</OPTION>
								<OPTION value="6" >II</OPTION>

								<OPTION value="3" >III</OPTION>
								<OPTION value="4" >IV</OPTION>
								<!-- the original code had JR and SR's value flipped -->
			</SELECT></TD>
			</TR>
			
			<TR><TD>&nbsp;</TD></TR>
			
		</TABLE>
	</TD>

</TR>

<tr>
<td>
	<table>
	<TR>
		<TD class=label colSpan=3 bgcolor="#CCCCCC"><STRONG>Current Address:</STRONG></TD>
	</TR>
  <TR>
            <TD class=label colspan=3>Street <LABEL 
      id=staddress_st style="VISIBILITY: hidden"><FONT 
    color=red>*</FONT></LABEL><br>

<INPUT id=StreetAddress name=StreetAddress size=53 value=""></TD>
   </TR>
  <TR>
    <TD class=label>City <LABEL id=city_st 
      style="VISIBILITY: hidden"><FONT color=red>*</FONT></LABEL><br>
		<INPUT id=City name=City size=29 value="">
	</TD>
    <TD class=label>State <LABEL id=state_st 
      style="VISIBILITY: hidden"><FONT color=red>*</FONT></LABEL><Br><SELECT id=State name=state>

								<option value="" selected>&nbsp;&nbsp;</option>
								<option value="AA" >AA&nbsp;</option>
								<option value="AE" >AE&nbsp;</option>
								<option value="AK" >AK&nbsp;</option>
								<option value="AL" >AL&nbsp;</option>
								<option value="AP" >AP&nbsp;</option>

								<option value="AR" >AR&nbsp;</option>
								<option value="AS" >AS&nbsp;</option>
								<option value="AZ" >AZ&nbsp;</option>
								<option value="CA" >CA&nbsp;</option>
								<option value="CO" >CO&nbsp;</option>
								<option value="CT" >CT&nbsp;</option>

								<option value="DC" >DC&nbsp;</option>
								<option value="DE" >DE&nbsp;</option>
								<option value="FL" >FL&nbsp;</option>
								<option value="GA" >GA&nbsp;</option>
								<option value="GU" >GU&nbsp;</option>
								<option value="HI" >HI&nbsp;</option>

								<option value="IA" >IA&nbsp;</option>
								<option value="ID" >ID&nbsp;</option>
								<option value="IL" >IL&nbsp;</option>
								<option value="IN" >IN&nbsp;</option>
								<option value="KS" >KS&nbsp;</option>
								<option value="KY" >KY&nbsp;</option>

								<option value="LA" >LA&nbsp;</option>
								<option value="MA" >MA&nbsp;</option>
								<option value="MD" >MD&nbsp;</option>
								<option value="ME" >ME&nbsp;</option>
								<option value="MH" >MH&nbsp;</option>
								<option value="MI" >MI&nbsp;</option>

								<option value="MN" >MN&nbsp;</option>
								<option value="MO" >MO&nbsp;</option>
								<option value="MP" >MP&nbsp;</option>
								<option value="MS" >MS&nbsp;</option>
								<option value="MT" >MT&nbsp;</option>
								<option value="NC" >NC&nbsp;</option>

								<option value="ND" >ND&nbsp;</option>
								<option value="NE" >NE&nbsp;</option>
								<option value="NH" >NH&nbsp;</option>
								<option value="NJ" >NJ&nbsp;</option>
								<option value="NM" >NM&nbsp;</option>
								<option value="NV" >NV&nbsp;</option>

								<option value="NY" >NY&nbsp;</option>
								<option value="OH" >OH&nbsp;</option>
								<option value="OK" >OK&nbsp;</option>
								<option value="OR" >OR&nbsp;</option>
								<option value="PA" >PA&nbsp;</option>
								<option value="PR" >PR&nbsp;</option>

								<option value="RI" >RI&nbsp;</option>
								<option value="SC" >SC&nbsp;</option>
								<option value="SD" >SD&nbsp;</option>
								<option value="TN" >TN&nbsp;</option>
								<option value="TX" >TX&nbsp;</option>
								<option value="UT" >UT&nbsp;</option>

								<option value="VA" >VA&nbsp;</option>
								<option value="VI" >VI&nbsp;</option>
								<option value="VT" >VT&nbsp;</option>
								<option value="WA" >WA&nbsp;</option>
								<option value="WI" >WI&nbsp;</option>
								<option value="WV" >WV&nbsp;</option>

								<option value="WY" >WY&nbsp;</option>
        </SELECT></TD>
    <TD class=label>Zip <LABEL id=zip_st 
      style="VISIBILITY: hidden"><FONT color=red>*</FONT></LABEL><BR><INPUT id=Zip size=10 name=Zip value=""></TD>
    </TR>
	</table>
</td>
</tr>
  <TR>

    <TD class=label>&nbsp;</TD>
</TR>
  <TR>
    <TD colSpan=2 bgcolor=lightblue>
        <STRONG>Credit Card Billing Information</STRONG> </TD>
    </TR>
  <TR>
      <TD><i><font size=1>You must use your own credit card with your name (as specified above) 
        on it.</font></i></TD>

    </TR>

  <TR>
      <TD><input id="SameAddress" type="checkbox" name="SameAddress" onClick="CopyAddress()">Same address as above</TD>
    <TD> </TD></TR>
  <TR>
    <TD>
<table>
  <TR>

            <TD class=label colspan=3>Street <LABEL 
      id=billing_st_st style="VISIBILITY: hidden"><FONT 
    color=red>*</FONT></LABEL><br>
<INPUT id=billing_st name=billing_st size=53 value=""></TD>
   </TR>
  <TR>
    <TD class=label>City <LABEL id=billing_city_st 
      style="VISIBILITY: hidden"><FONT color=red>*</FONT></LABEL><br>
		<INPUT id=billing_city name=billing_city size=29 value="">
	</TD>

    <TD class=label>State <LABEL id=billing_state_st 
      style="VISIBILITY: hidden"><FONT color=red>*</FONT></LABEL><Br><SELECT id=billing_state name=billing_state>
								<option value="" selected>&nbsp;&nbsp;</option>
								<option value="AA" >AA&nbsp;</option>
								<option value="AE" >AE&nbsp;</option>
								<option value="AK" >AK&nbsp;</option>
								<option value="AL" >AL&nbsp;</option>

								<option value="AP" >AP&nbsp;</option>
								<option value="AR" >AR&nbsp;</option>
								<option value="AS" >AS&nbsp;</option>
								<option value="AZ" >AZ&nbsp;</option>
								<option value="CA" >CA&nbsp;</option>
								<option value="CO" >CO&nbsp;</option>

								<option value="CT" >CT&nbsp;</option>
								<option value="DC" >DC&nbsp;</option>
								<option value="DE" >DE&nbsp;</option>
								<option value="FL" >FL&nbsp;</option>
								<option value="GA" >GA&nbsp;</option>
								<option value="GU" >GU&nbsp;</option>

								<option value="HI" >HI&nbsp;</option>
								<option value="IA" >IA&nbsp;</option>
								<option value="ID" >ID&nbsp;</option>
								<option value="IL" >IL&nbsp;</option>
								<option value="IN" >IN&nbsp;</option>
								<option value="KS" >KS&nbsp;</option>

								<option value="KY" >KY&nbsp;</option>
								<option value="LA" >LA&nbsp;</option>
								<option value="MA" >MA&nbsp;</option>
								<option value="MD" >MD&nbsp;</option>
								<option value="ME" >ME&nbsp;</option>
								<option value="MH" >MH&nbsp;</option>

								<option value="MI" >MI&nbsp;</option>
								<option value="MN" >MN&nbsp;</option>
								<option value="MO" >MO&nbsp;</option>
								<option value="MP" >MP&nbsp;</option>
								<option value="MS" >MS&nbsp;</option>
								<option value="MT" >MT&nbsp;</option>

								<option value="NC" >NC&nbsp;</option>
								<option value="ND" >ND&nbsp;</option>
								<option value="NE" >NE&nbsp;</option>
								<option value="NH" >NH&nbsp;</option>
								<option value="NJ" >NJ&nbsp;</option>
								<option value="NM" >NM&nbsp;</option>

								<option value="NV" >NV&nbsp;</option>
								<option value="NY" >NY&nbsp;</option>
								<option value="OH" >OH&nbsp;</option>
								<option value="OK" >OK&nbsp;</option>
								<option value="OR" >OR&nbsp;</option>
								<option value="PA" >PA&nbsp;</option>

								<option value="PR" >PR&nbsp;</option>
								<option value="RI" >RI&nbsp;</option>
								<option value="SC" >SC&nbsp;</option>
								<option value="SD" >SD&nbsp;</option>
								<option value="TN" >TN&nbsp;</option>
								<option value="TX" >TX&nbsp;</option>

								<option value="UT" >UT&nbsp;</option>
								<option value="VA" >VA&nbsp;</option>
								<option value="VI" >VI&nbsp;</option>
								<option value="VT" >VT&nbsp;</option>
								<option value="WA" >WA&nbsp;</option>
								<option value="WI" >WI&nbsp;</option>

								<option value="WV" >WV&nbsp;</option>
								<option value="WY" >WY&nbsp;</option>
        </SELECT></TD>
    <TD class=label>Zip <LABEL id=billing_zip_st 
      style="VISIBILITY: hidden"><FONT color=red>*</FONT></LABEL><BR><INPUT id=billing_zip size=10 name=billing_zip value=""></TD>
    </TR>
	</table>
</TD>

</TR>
<TR>
<TD>
	<table>
	<tr>
		    <td>Card Number <LABEL 
      id=billing_cardnum_st style="VISIBILITY: hidden"><FONT 
      color=red>*</FONT></LABEL><br>
               <INPUT id=billing_cardnum name=billing_cardnum size=16 maxlength=16 value=""></TD>
            <TD>CVV <LABEL id=billing_cvv_st 
      style="VISIBILITY: hidden"><FONT color=red>*</FONT></LABEL><br>

    <INPUT id=billing_cvv name=billing_cvv size=5 value=""> </TD>
            <TD>Expiration Mo<LABEL 
      id=billing_month_st style="VISIBILITY: hidden"><FONT 
      color=red>*</FONT></LABEL><br>
              <SELECT id=billing_month size=1 name=billing_month>
								<OPTION value="" selected></OPTION>
								<OPTION value="1" >January</OPTION>
								<OPTION value="2" >February</OPTION>

								<OPTION value="3" >March</OPTION>
								<OPTION value="4" >April</OPTION>
								<OPTION value="5" >May</OPTION>
								<OPTION value="6" >June</OPTION>
								<OPTION value="7" >July</OPTION>
								<OPTION value="8" >August</OPTION>

								<OPTION value="9" >September</OPTION>
								<OPTION value="10" >October</OPTION>
								<OPTION value="11" >November</OPTION>
								<OPTION value="12" >December</OPTION>
		</SELECT>  </TD>
            <TD>Year <LABEL id=billing_year_st 
      style="VISIBILITY: hidden"><FONT color=red>*</FONT></LABEL> <br>

              <INPUT id=billing_year name=billing_year size=6 maxlength=4 value=""> </TD>
    </TR>
	</table>
</td>



<tr><td>&nbsp;</td></tr>
<tr>
	<td bgcolor=lightblue><STRONG>Additional Information For Borrower</strong></td>
</tr>

<tr><td><table>

<tr>
	<td>Phone Number <LABEL id=PhoneNumber_st style="VISIBILITY: hidden">
		<FONT color=red>*</FONT></LABEL><br>
		<INPUT id=PhoneNumber name=PhoneNumber size=16 value="">
	</td>
	<td>Email Address <LABEL id=EmailAddress_st style="VISIBILITY: hidden">

		<FONT color=red>*</FONT></LABEL><br>
		<INPUT id=EmailAddress name=EmailAddress size=30 value="">
	</td>
	<td>Do You: <LABEL id=OwnOrRent_st style="VISIBILITY: hidden">
		<FONT color=red>*</FONT></LABEL><br>
		<SELECT id=OwnOrRent name=OwnOrRent value="">
			<OPTION value="" selected></OPTION>

			<OPTION value="Own" >Own</OPTION>
			<OPTION value="Rent" >Rent</OPTION>
			<OPTION value="Other" >Other</OPTION>
        </SELECT>
    </td>
</tr>

</table></td></tr>

<tr>
	<td>Would you like to receive mortgage information?<br>
		&nbsp;<INPUT type="radio" id="MortgageInfo" name="MortgageInfo" value="InfoYes" 
					 checked>Yes
		&nbsp;<INPUT type="radio" id="MortgageInfo" name="MortgageInfo" value="InfoNo" 
					 >No
		&nbsp;<i><font size=1>Please fill out the following fields if you select Yes</font></i>
	</td>
</tr>

<tr><td><table>

<tr>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Loan Type <LABEL id=LoanType_st style="VISIBILITY: hidden">

		<FONT color=red>*</FONT></LABEL><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<SELECT id=LoanType name=LoanType style="width:160px" value="">
			<OPTION value="" selected></OPTION>
			<OPTION value="Conventional" >Conventional</OPTION>
			<OPTION value="VA" >VA</OPTION>
			<OPTION value="FHA" >FHA</OPTION>
			<OPTION value="FmHA" >FmHA</OPTION>

			<OPTION value="Other" >Other</OPTION>
        </SELECT>
    </td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;Residence Type <LABEL id=ResidenceType_st style="VISIBILITY: hidden">
		<FONT color=red>*</FONT></LABEL><br>&nbsp;&nbsp;&nbsp;
		<SELECT id=ResidenceType name=ResidenceType style="width:160px" value="">
			<OPTION value="" selected></OPTION>

			<OPTION value="Primary Residence" >Primary Residence</OPTION>
			<OPTION value="Secondary Residence" >Secondary Residence</OPTION>
			<OPTION value="Investment or Rental" >Investment or Rental</OPTION>
        </SELECT>
    </td>
</tr>
<tr>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Payment Term <LABEL id=PaymentTerm_st style="VISIBILITY: hidden">

		<FONT color=red>*</FONT></LABEL><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<SELECT id=PaymentTerm name=PaymentTerm style="width:160px" value="">
			<OPTION value="" selected></OPTION>
			<OPTION value="30 Years" >30 Years</OPTION>
			<OPTION value="20 Years" >20 Years</OPTION>
			<OPTION value="15 Years" >15 Years</OPTION>
			<OPTION value="10 Years" >10 Years</OPTION>

			<OPTION value="7 Years" >7 Years</OPTION>
			<OPTION value="5 Years" >5 Years</OPTION>
        </SELECT>
    </td>

	<td>&nbsp;&nbsp;&nbsp;&nbsp;Estimated Loan Amount <LABEL id=EstimatedLoanAmount_st style="VISIBILITY: hidden">
		<FONT color=red>*</FONT></LABEL><br>&nbsp;&nbsp;&nbsp;

		<INPUT id=EstimatedLoanAmount name=EstimatedLoanAmount value="">
	</td>
</tr>

<tr>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Loan Purpose <LABEL id=LoanPurpose_st style="VISIBILITY: hidden">
		<FONT color=red>*</FONT></LABEL><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<SELECT id=LoanPurpose name=LoanPurpose style="width:160px" value="">
			<OPTION value="" selected></OPTION>

			<OPTION value="Purchase" >Purchase</OPTION>
			<OPTION value="Refinance" >Refinance</OPTION>
			<OPTION value="Construction" >Construction</OPTION>
			<OPTION value="Pre-Approval" >Pre-Approval</OPTION>
			<OPTION value="Other" >Other</OPTION>
        </SELECT>

    </td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;Number of Units <LABEL id=NumberOfUnits_st style="VISIBILITY: hidden">
		<FONT color=red>*</FONT></LABEL><br>&nbsp;&nbsp;&nbsp;
		<SELECT id=NumberOfUnits name=NumberOfUnits style="width:160px" value="">
			<OPTION value="" selected></OPTION>
			<OPTION value="0" >0</OPTION>
			<OPTION value="1" >1</OPTION>

			<OPTION value="2" >2</OPTION>
			<OPTION value="3" >3</OPTION>
			<OPTION value="4" >4</OPTION>
        </SELECT>
    </td>
</tr>

<tr>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Interest Rate Requested <LABEL id=InterestRateRequested_st style="VISIBILITY: hidden">

		<FONT color=red>*</FONT></LABEL><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<INPUT id=InterestRateRequested name=InterestRateRequested value="">
		&nbsp;%
	</td>
</tr>

</table></td></tr>



<tr><Td>&nbsp;</td></tr>
<tr>
      <td bgcolor=lightblue><STRONG>Authorization Agreement</strong></td>

</tr>
<tr><td>
<textarea readonly rows=7 cols=48>I hereby authorize WESTERN THRIFT & LOAN to verify my past and present employment earnings records, bank accounts, stockholdings, and any other asset balances that are needed to process my mortgage loan application. I further authorize WESTERN THRIFT & LOAN to order a consumer credit report and verify other credit information, including past and present mortgages and landlord references.

WESTERN THRIFT & LOAN may also utilize the services of CREDITPLUS to further verify my personal credit information and the information WESTERN THRIFT & LOAN obtains is only to be used in the processing of my application for a mortgage loan. It is understood that a copy of this form will also serve as authorization. This authorization expires 120 days from the date indicated below.

Privacy Act Notice: This information is to be used by the agency collecting it or its assignees in determining whether you qualify as a prospective mortgagor under its program. It will not be disclosed outside the agency except as required and permitted by law. You do not have to provide this information, but if you do not your application for approval as a prospective mortgagor or borrower may be delayed or rejected. The information requested in this form is authorized by Title 38, USC, Chapter 37 (if VA); by 12 USC, Section 1701 et. seq. (if HUD/FHA); by 42 USC, Section 1452b (if HUD/CPD); and Title 42 USC, 1471 et. seq., or 7 USC, 1921 et. seq. (if USDA/FmHA).
 </textarea>
</tD>
</tr>
<tr>
	<TD class=label><font size=1>
        By typing my Social Security Number in the box below, I hereby authorize 
          WESTERN THRIFT & LOAN to pull a credit report on me.</font><br><br>
        <TABLE>
			<TR>

				<TD align="right" bgcolor="#CCCCCC">Borrower SSN&nbsp;</TD>
				<TD>
        <input id=SSN name=SSN size=9 maxlength=9 value="">
        <LABEL id=ssn_st style="VISIBILITY: hidden"><FONT color=red>*</FONT></LABEL><BR>
				</TD>
			</TR>
			<TR>
				<TD align="right" bgcolor="#CCCCCC">Coborrower SSN&nbsp;</TD>

				<TD>
		<input id=SSNCoborrower name=SSNCoborrower size=9 maxlength=9 value="">
        <LABEL id=ssnCoborrower_st style="VISIBILITY: hidden"><FONT color=red>*</FONT></LABEL> 
				</TD>
			</TR>
        </TABLE>
        <hr size=1>
    </TD>
      

</TR>
        
    <!-- Referral drop down menu, requested by Randall from Broker's Home -->
    <TR>
        <TD class=label>
			I Am Referred By:
			<SELECT id=referral name=referral value="">
				<option value="No Referral" selected>No Referral</option>
				
				<option value="ASPECT" >ASPECT</option>
				
				<option value="TONY FERLAZZO" >TONY FERLAZZO</option>

				
			</SELECT>
			<hr size=1>
		</TD>
    </TR>

    <TD class=label align=middle><INPUT id=SUBMIT onclick=Submit(); type=button value=SUBMIT name=SUBMIT> 
<INPUT id=CLEAR onclick=Clear(); type=button value=CLEAR name=CLEAR>
<!-- The Fill button is for testing purpose -->

<INPUT id="FILL" onclick="FillForm();" type="button" value="FILL" name="FILL">(for testing)

</TD></TR>
  <TR>

    <TD class=label colSpan=2>
      <TABLE id=msgbox style="VISIBILITY: hidden">
        <TBODY>
        <TR>
          <TD 
id=msgtext></TD></TR></TBODY></TABLE>
</TD></TR>
</TBODY></TABLE>
			</form>
<div id='Debugging' style='display:block;text-align:left;'>
<hr style='width:100%;' ><h1>Debug Data</h1></div>
		</body>
</HTML>

