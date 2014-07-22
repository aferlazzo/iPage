<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<html>
<head>
<!--
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="expires" content="0">
-->
<title>Send a Credit Request</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" >
<meta name="copyright" content="Copyright 2006, Anthony Ferlazzo, Lightning Mortgage" >
<meta name="rating" content="General" >
<meta name="robots" content="NoIndex, NoFollow" >
<script src="http://www.google.com/coop/cse/brand?form=cse-search-box&lang=en" type="text/javascript"></script>
<link rel="stylesheet" href="../css/MortgageApplicationStyles.css" type="text/css">
<link rel="stylesheet" href="../css/Tabs.css" type="text/css">
<script type="text/javascript">
//---------unique code segment start---------------------------
var DisplayDebug = 1; // change to 1 to view debug data

var AppInfo;
var URLlist;
var Decoded;
var URLlistVariables;
var AppInfoVariables;
var URLlistCookie = new Array;
var AppInfoCookie = new Array;


var coid;
var a_fullname;
var a_lname;
var a_fname;
var a_mi;
var a_gen;
var a_ssn;
var co_fullname;
var co_lname;
var co_fname;
var co_mi;
var co_gen;
var co_ssn;
var bill_phone;
var bill_email;
var ca_fullstreet_name;
var houseno;
var direction;
var streetname;
var streettype;
var aptno;
var ca_city;
var ca_state;
var ca_zipcode;
var autopopcc = "";
var cancelURL;
var returnURL;
var errorURL;
var charge;
var to_email;
var cc_email;
var email_subj;

function ReadCookies()
{
AppInfo = GetMyValue("AppInfo");
Decoded = unescape(AppInfo);
AppInfoVariables = Decoded.split("\&");

URLlist = GetMyValue("URLlist");
Decoded = unescape(URLlist);
URLlistVariables = Decoded.split("\&");

//alert("Decoded List: "+Decoded+"\n URL List Variables found: "+URLlistVariables.length);
for (var i=0;i<URLlistVariables.length;i++)
{
	//alert(Variables[i]);
	URLlistCookie = URLlistVariables[i].split("=");
	//alert("name: "+URLlistCookie[0]+"\nvalue: "+URLlistCookie[1]);
	if (URLlistCookie[0] == "returnURL")
		returnURL = URLlistCookie[1];
	else
	if (URLlistCookie[0] == "cancelURL")
		cancelURL = URLlistCookie[1];
	else
	if (URLlistCookie[0] == "errorURL")
		errorURL = URLlistCookie[1];
	else
	if (URLlistCookie[0] == "charge")
		charge = URLlistCookie[1];
	else
	if (URLlistCookie[0] == "to_email")
		to_email = URLlistCookie[1];
	else
	if (URLlistCookie[0] == "cc_email")
		cc_email = URLlistCookie[1];
	else
	if (URLlistCookie[0] == "email_subj")
		email_subj = URLlistCookie[1];
}


var sSSNValue;
var rgSSN1;

for (i=0;i<AppInfoVariables.length;i++)
{
	AppInfoCookie = AppInfoVariables[i].split("=");
	if (AppInfoCookie[0] == "ID")
		coid = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "a_fullname")
		a_fullname = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "a_lname")
		a_lname = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "a_fname")
		a_fname = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "a_mi")
		a_mi  = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "a_gen=")
		a_gen = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "a_ssn")
	{
		sSSNValue = AppInfoCookie[1];
		rgSSN1 = /^ *[0-9]{9} *$/;
		a_ssn = sSSNValue.replace(/[\- ]/g, "");
	}
	else
	if (AppInfoCookie[0] == "co_fullname")
		co_fullname = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "co_lname")
		co_lname = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "co_fname")
		co_fname = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "co_mi")
		co_mi = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "co_gen")
		co_gen = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "co_ssn")
	{
		sSSNValue = AppInfoCookie[1];
		rgSSN1 = /^ *[0-9]{9} *$/;
		co_ssn = sSSNValue.replace(/[\- ]/g, "");
	}
	else
	if (AppInfoCookie[0] == "bill_phone")
		bill_phone = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "bill_email")
		bill_email = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "ca_fullstreet_name")
		ca_fullstreet_name = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "&houseno")
		houseno = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "direction")
		direction = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "streetname")
		streetname = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "streettype")
		streettype = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "aptno")
		aptno = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "city")
		ca_city = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "state")
		ca_state = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "zipcode")
		ca_zipcode = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "autopopcc")
		autopopcc = AppInfoCookie[1];
}
}

function GoToURL(URL)
{
	window.location = URL;
}


function parseName(fullname)
{
	var NameArray = new Array;
	var FirstName, LastName, MiddleName, Suffix;
	var ReturnName = new Array();

	//alert(fullname);

	if(fullname != undefined)
		NameArray = fullname.split(" ");

	if (NameArray.length == 1) //if no space
	{
		FirstName = fullname;
		MiddleName = "";
		LastName = "";
		Suffix = "";
	}
	else
	if (NameArray.length == 2) //if 1 space
	{
		FirstName = NameArray[0];
		MiddleName = "";
		LastName = NameArray[1];
		Suffix = "";
	}
	else
	if (NameArray.length == 3) //if 2 spaces
	{   //if there is a suffix, it means there is no middle name
		if (   (NameArray[2].toUpperCase == "SR")
			|| (NameArray[2].toUpperCase == "JR")
			|| (NameArray[2].toUpperCase == "III")
			|| (NameArray[2].toUpperCase == "IV")
			|| (NameArray[2].toUpperCase == "I")
			|| (NameArray[2].toUpperCase == "II"))
		{
			FirstName = NameArray[0];
			MiddleName = "";
			LastName = NameArray[1];
			if (NameArray[2].toUpperCase == "SR")
				Suffix = 1;
			if (NameArray[2].toUpperCase == "JR")
				Suffix = 2;
			if (NameArray[2].toUpperCase == "III")
				Suffix = 3;
			if (NameArray[2].toUpperCase == "IV")
				Suffix = 4;
			if (NameArray[2].toUpperCase == "I")
				Suffix = 5;
			if (NameArray[2].toUpperCase == "II")
				Suffix = 6;
		}
		else
		{
			FirstName = NameArray[0];
			MiddleName = NameArray[1];
			LastName = NameArray[2];
			Suffix = "";
		}
	}
	else
	if (NameArray.length == 4) //if 3 spaces: middle and suffix
	{
		//alert("First: "+NameArray[0]+"\nMiddle: "+NameArray[1]+"\nLast: "+NameArray[0]+"\nSuffix: "+NameArray[1]);
		FirstName = NameArray[0];
		MiddleName = NameArray[1];
		LastName = NameArray[2];
			if (NameArray[3].toUpperCase == "SR")
				Suffix = 1;
			if (NameArray[3].toUpperCase == "JR")
				Suffix = 2;
			if (NameArray[3].toUpperCase == "III")
				Suffix = 3;
			if (NameArray[3].toUpperCase == "IV")
				Suffix = 4;
			if (NameArray[3].toUpperCase == "I")
				Suffix = 5;
			if (NameArray[3].toUpperCase == "II")
				Suffix = 6;
	}

	ReturnName[0] = FirstName;
	ReturnName[1] = MiddleName;
	ReturnName[2] = LastName;
	ReturnName[3] = Suffix;

	return(ReturnName);
}


function CoAddress()
{
//alert("SameAddress checked: "+document.forms.frm.CoSameAddress.checked);
if (document.forms.DebugForm.CoSameAddress.checked == true)
{
	document.forms.DebugForm.DeCoStreetAddress.value = ca_fullstreet_name;
	document.forms.DebugForm.DeCoCity.value = ca_city;
	document.forms.DebugForm.DeCoState.value = ca_state;
	document.forms.DebugForm.DeCoZip.value = ca_zipcode;
}
  else
{
	document.forms.DebugForm.DeCoStreetAddress.value = "";
	document.forms.DebugForm.DeCoCity.value = "";
	document.forms.DebugForm.DeCoState.value = "";
	document.forms.DebugForm.DeCoZip.value = "";
}
}

function BillingAddress()
{
//alert("Same Address: "+document.forms.frm.SameAddress.checked);
if (document.forms.frm.SameAddress.checked == true)
{
	document.forms.frm.StreetAddress.value = ca_fullstreet_name;
	document.forms.frm.City.value = ca_city;
	document.forms.frm.state.value = ca_state;
	document.forms.frm.Zip.value = ca_zipcode;
	document.forms.frm.EmailAddress.value = bill_email;
}
  else
{
	document.forms.frm.StreetAddress.value = "";
	document.forms.frm.City.value = "";
	document.forms.frm.state.value = "";
	document.forms.frm.Zip.value = "";
	document.forms.frm.EmailAddress.value = "";
}
}

function GetMyValue (CookieName)
{
var Name, Value;
var Beginning, Middle, End;
Beginning = 0;

while (Beginning < document.cookie.length)
{
	// find the next equals sign
	Middle = document.cookie.indexOf('=', Beginning);

	// find the next semicolon
	End = document.cookie.indexOf(';', Beginning);

	if (End == -1)	// if no semicolon exists, it's the last cookie...
		End = document.cookie.length;

	// if nothing is in the cookie, blank out its value
	if ((Middle > End) || (Middle == -1))
	{
		Name = document.cookie.substring(Beginning, End);
		Value = "";
	}
	else
	{
		//extract the Name and value
		Name = document.cookie.substring(Beginning, Middle);
		Value = document.cookie.substring(Middle + 1, End);
	}
	if(Name == CookieName)
	{
		return(Value);
	}
	// jump over the next space to the Beginning of next cookie
	Beginning = End + 2;
}
	return("");
}


function FillValues()
{
	var BnameArray = new Array();
	var CnameArray = new Array();

	BnameArray = parseName(a_fullname);
	//document.forms.DebugForm.BillingFullName.value=a_fullname;
	document.forms.DebugForm.DeApplicantFullName.value=a_fullname;
	document.forms.DebugForm.DeCoApplicantFullName.value=co_fullname;
	//alert("FirstName: " + BnameArray[0] + "\nMiddleName: " + BnameArray[1] + "\nLastName: " + BnameArray[2] + "\nSuffix: " + BnameArray[3]);
	CnameArray = parseName(co_fullname);

	document.forms.frm.Firstname.value=BnameArray[0];
	document.forms.frm.Middlename.value=BnameArray[1];
	document.forms.frm.Lastname.value=BnameArray[2];
	document.forms.frm.Suffix.value=BnameArray[3];
	document.forms.frm.FirstnameCoborrower.value=CnameArray[0];
	document.forms.frm.MiddlenameCoborrower.value=CnameArray[1];
	document.forms.frm.LastnameCoborrower.value=CnameArray[2];
	document.forms.frm.SuffixCoborrower.value=CnameArray[3];
	document.forms.frm.SSN.value = a_ssn;
	document.forms.DebugForm.DeSSN.value = a_ssn;
	document.forms.DebugForm.DeCoSSN.value = co_ssn;
	document.forms.frm.SSNCoborrower.value = co_ssn;

	document.forms.frm.billing_st.value=ca_fullstreet_name;
	document.forms.frm.billing_city.value=ca_city;
	document.forms.frm.billing_state.value=ca_state;
	document.forms.frm.billing_zip.value=ca_zipcode;

	if (autopopcc.toUpperCase() == "Y")
	{
		document.forms.frm.billing_st.value=ca_fullstreet_name;
		document.forms.frm.billing_city.value=ca_city;
		document.forms.frm.billing_state.value=ca_state;
		document.forms.frm.billing_zip.value=ca_zipcode;
		document.forms.frm.PhoneNumber.value = bill_phone;
		document.forms.frm.EmailAddress.value = bill_email;

		document.forms.frm.SameAddress.checked = true;
		BillingAddress();

		document.forms.frm.billing_month.value="";
		document.forms.frm.billing_year.value="";
		document.forms.frm.billing_cardnum.value="";
		document.forms.frm.billing_cvv.value="";
	}

	document.forms.frm.Firstname.value = BnameArray[0];
	document.forms.frm.Middlename.value = BnameArray[1];
	document.forms.frm.Lastname.value = BnameArray[2];
	document.forms.frm.Suffix.value = BnameArray[3];

	document.forms.frm.FirstnameCoborrower.value = CnameArray[0];
	document.forms.frm.MiddlenameCoborrower.value = CnameArray[1];
	document.forms.frm.LastnameCoborrower.value = CnameArray[2];
	document.forms.frm.SuffixCoborrower.value = CnameArray[3];

	document.forms.frm.PhoneNumber.value = bill_phone;
	document.forms.frm.EmailAddress.value = bill_email;
	document.forms.frm.OwnOrRent.value = "Own";
	document.forms.frm.MortgageInfo[0].value = "InfoYes";

	document.forms.frm.MortgageInfo[1].value = "InfoNo";
	document.forms.frm.LoanType.value = "Conventional";
	document.forms.frm.ResidenceType.value = "Primary Residence";
	document.forms.frm.PaymentTerm.value = "15 Years";
	document.forms.frm.EstimatedLoanAmount.value = "300000";

	document.forms.frm.LoanPurpose.value = "Purchase";
	document.forms.frm.NumberOfUnits.value="4";
	document.forms.frm.InterestRateRequested.value = "5.5";
}


//---------unique code segment end---------------------------

		function Submit()
		{
			if(!Validate()) return;
			//add confim window.
			//var ret = window.showModalDialog("aspec_confirm.asp", this,"dialogHeight:120px; dialogWidth:250px; center:yes; resizable:no; scroll:no; status=no; help=no;")
			//if(ret != "yes") return;
			document.forms.frm.cmd.value = "order";
			//location.href="aspec.asp?cmd=order";
			document.forms.frm.SUBMIT.disabled = true;
			document.forms.frm.CLEAR.disabled = true;
			document.forms.frm.submit();
		}
		function Clear()
		{
			document.forms.frm.Firstname.value="";
			document.forms.frm.Middlename.value="";
			document.forms.frm.Lastname.value="";
			document.forms.frm.SSN.value="";
			document.forms.frm.StreetAddress.value="";
			document.forms.frm.City.value="";
			document.forms.frm.state.value="";
			document.forms.frm.Zip.value="";
			document.forms.frm.Suffix.value="";

			document.forms.frm.FirstnameCoborrower.value="";
			document.forms.frm.MiddlenameCoborrower.value="";
			document.forms.frm.LastnameCoborrower.value="";
			document.forms.frm.SuffixCoborrower.value="";
			document.forms.frm.SSNCoborrower.value="";

			document.forms.frm.billing_cardnum.value="";
			document.forms.frm.billing_st.value="";
			document.forms.frm.billing_city.value="";
			document.forms.frm.billing_zip.value="";
			document.forms.frm.billing_state.value="";
			document.forms.frm.billing_month.value="";
			document.forms.frm.billing_year.value="";
			document.forms.frm.billing_cvv.value="";

			document.forms.frm.PhoneNumber.value = "";
			document.forms.frm.EmailAddress.value = "";
			document.forms.frm.OwnOrRent.value = "";
			document.forms.frm.LoanType.value = "";
			document.forms.frm.ResidenceType.value = "";
			document.forms.frm.PaymentTerm.value = "";
			document.forms.frm.EstimatedLoanAmount.value = "";
			document.forms.frm.LoanPurpose.value = "";
			document.forms.frm.NumberOfUnits.value = "";
			document.forms.frm.InterestRateRequested.value = "";

			document.forms.frm.referral.value = "No Referral";
		}







		function Validate()
		{
			var bHasError=false;
			var ErrorText = "";

			// BORROWER
			if(document.forms.frm.Firstname.value == "")
			{
				document.getElementById('firstname_st').style.visibility = "visible";
				ErrorText += "First Name is empty.\n";
				bHasError=true;
			}
			else
			{
				document.getElementById('firstname_st').style.visibility = "hidden";
			}

			if(document.forms.frm.Lastname.value == "")
			{
				document.getElementById('lastname_st').style.visibility = "visible";
				ErrorText += "Last name is empty.\n";
				bHasError=true;
			}
			else
			{
				document.getElementById('lastname_st').style.visibility = "hidden";
			}

			if(document.forms.frm.SSN.value == "")
			{
				document.getElementById('ssn_st').style.visibility = "visible";
				ErrorText += "SSN is empty.\n";
				bHasError=true;
			}
			else
			{
				var sSSNValue = document.forms.frm.SSN.value;
				var rgSSN1 = /^ *[0-9]{9} *$/;
				sSSNValue = sSSNValue.replace(/[\- ]/g, "");
				var sMatch = rgSSN1.exec(sSSNValue);
				if(sMatch == null)
				{
					document.getElementById('ssn_st').style.visibility = "visible";
					ErrorText += "SSN is in incorrect format\n";
					bHasError=true;
				}
				else
				{
					document.getElementById('ssn_st').style.visibility = "hidden";
					document.forms.frm.SSN.value = sSSNValue;
				}
			}

			// COBORROWER
			// Coborrower fields, if any of them are filled, First/Last/SSN becomes required
			if (document.forms.frm.FirstnameCoborrower.value  == "" &&
				document.forms.frm.MiddlenameCoborrower.value == "" &&
				document.forms.frm.LastnameCoborrower.value   == "" &&
				document.forms.frm.SuffixCoborrower.value     == "" &&
				document.forms.frm.SSNCoborrower.value        == ""    )
			{
				document.getElementById('firstnameCoborrower_st').style.visibility = "hidden";
				document.getElementById('lastnameCoborrower_st').style.visibility  = "hidden";
				document.getElementById('ssnCoborrower_st').style.visibility       = "hidden";
			}
			else if (document.forms.frm.FirstnameCoborrower.value != "" &&
					 document.forms.frm.LastnameCoborrower.value  != "" &&
					 document.forms.frm.SSNCoborrower.value       != ""    )
			{
				document.getElementById('firstnameCoborrower_st').style.visibility = "hidden";
				document.getElementById('lastnameCoborrower_st').style.visibility  = "hidden";
				document.getElementById('ssnCoborrower_st').style.visibility       = "hidden";
			}
			else
			{
				document.getElementById('firstnameCoborrower_st').style.visibility = (document.forms.frm.FirstnameCoborrower.value == "") ? "visible" : "hidden";
				document.getElementById('lastnameCoborrower_st').style.visibility  = (document.forms.frm.LastnameCoborrower.value == "")  ? "visible" : "hidden";
				document.getElementById('ssnCoborrower_st').style.visibility       = (document.forms.frm.SSNCoborrower.value == "")       ? "visible" : "hidden";
				ErrorText += "CoBorrower First, last, or SSN is blank.\n";
				bHasError = true;
			}

			// test Coborrower's SSN value
			if(document.forms.frm.SSNCoborrower.value != "")
			{
				var sSSNValue = document.forms.frm.SSNCoborrower.value;
				var rgSSN2 = /^ *[0-9]{9} *$/;
				sSSNValue = sSSNValue.replace(/[\- ]/g, "");
				var sMatch = rgSSN2.exec(sSSNValue);
				if(sMatch == null)
				{
					document.getElementById('ssnCoborrower_st').style.visibility = "visible";
					ErrorText += "Coborrower SSN is in incorrect format\n";
					bHasError=true;
				}
				else
				{
					document.getElementById('ssnCoborrower_st').style.visibility = "hidden";
					document.forms.frm.SSNCoborrower.value = sSSNValue;
				}
			}

			if(document.forms.frm.StreetAddress.value == "")
			{
				document.getElementById('staddress_st').style.visibility="visible";
				ErrorText += "StreetAddress is blank.\n";
				bHasError=true;
			}
			else
			{
				document.getElementById('staddress_st').style.visibility="hidden";
			}

			if(document.forms.frm.City.value == "")
			{
				document.getElementById('City_st').style.visibility = "visible";
				ErrorText += "City is blank.\n";
				bHasError=true;
			}
			else
			{
				document.getElementById('City_st').style.visibility = "hidden";
			}

			if(document.forms.frm.state.value == "")
			{
				document.getElementById('state_st').style.visibility = "visible";
				ErrorText += "State is blank.\n";
				bHasError=true;
			}
			else
			{
				document.getElementById('state_st').style.visibility = "hidden";
			}

			if(document.forms.frm.Zip.value == "" )
			{
				document.getElementById('Zip_st').style.visibility = "visible";
				ErrorText += "Zip is blank.\n";
				bHasError=true;
			}
			else
			{
				var rgZip1 = /^ *[0-9]{5} *$/;
				document.forms.frm.Zip.value = document.forms.frm.Zip.value.replace(/[\-, ]/g, "");
				var rgMatch = rgZip1.exec(document.forms.frm.Zip.value);
				//alert("Zip result: "+rgMatch+'\nlength: '+rgMatch.length);
				if (rgMatch == null)
				{
					//alert("Zip is null");
					ErrorText += "Zip Code is in incorrect format.\n";
					document.getElementById('Zip_st').style.visibility = "visible";
					bHasError = true;
				}
				else
				{
					document.getElementById('Zip_st').style.visibility = "hidden";
				}
			}

			if(document.forms.frm.billing_cardnum.value =="")
			{
				document.getElementById('billing_cardnum_st').style.visibility = "visible";
				ErrorText += "Billing card number is blank.\n";
				bHasError = true;
			}
			else
			{
				var rgCardNumber1 = /^ *[0-9]{15,16} *$/;
				document.forms.frm.billing_cardnum.value = document.forms.frm.billing_cardnum.value.replace(/[ \-]/g, "");
				var rgMatch = rgCardNumber1.exec(document.forms.frm.billing_cardnum.value);
				if(rgMatch == null)
				{
					ErrorText += "Credit card number is not valid.\n";
					document.getElementById('billing_cardnum_st').style.visibility = "visible";
					bHasError = true;
				}
				else
					document.getElementById('billing_cardnum_st').style.visibility = "hidden";
			}
			if(document.forms.frm.billing_st.value =="")
			{
				document.getElementById('billing_st_st').style.visibility = "visible";
				ErrorText += "Billing st is blank.\n";
				bHasError = true;
			}
			else
			{
				document.getElementById('billing_st_st').style.visibility = "hidden";
			}
			if(document.forms.frm.billing_city.value =="")
			{
				document.getElementById('billing_city_st').style.visibility = "visible";
				ErrorText += "Billing city is blank.\n";
				bHasError = true;
			}
			else
			{
				document.getElementById('billing_city_st').style.visibility = "hidden";
			}
			if(document.forms.frm.billing_state.value =="")
			{
				document.getElementById('billing_state_st').style.visibility = "visible";
				ErrorText += "Billing state is blank.\n";
				bHasError = true;
			}
			else
			{
				document.getElementById('billing_state_st').style.visibility = "hidden";
			}
			if(document.forms.frm.billing_zip.value =="")
			{
				document.getElementById('billing_zip_st').style.visibility = "visible";
				ErrorText += "Billing zip is blank.\n";
				bHasError = true;
			}
			else
			{
				var rgZip1 = /^ *[0-9]{5} *$/;
				document.forms.frm.billing_zip.value = document.forms.frm.billing_zip.value.replace(/[\-, ]/g, "");
				var rgMatch = rgZip1.exec(document.forms.frm.billing_zip.value);
				if (rgMatch == null)
				{
					ErrorText += "Billing Zip Code is in incorrect format.\n";
					document.getElementById('billing_zip_st').style.visibility = "visible";
					bCCHasError = true;
				}
				else
				{
					document.getElementById('billing_zip_st').style.visibility = "hidden";
				}
			}
			if(document.forms.frm.billing_month.value =="")
			{
				document.getElementById('billing_month_st').style.visibility = "visible";
				ErrorText += "Billing month is blank.\n";
				bHasError = true;
			}
			else
			{
				document.getElementById('billing_month_st').style.visibility = "hidden";
			}
			if(document.forms.frm.billing_year.value =="")
			{
				document.getElementById('billing_year_st').style.visibility = "visible";
				ErrorText += "Billing year is blank.\n";
				bHasError = true;
			}
			else
			{
				var rgYear1 = /^ *[0-9]{4} *$/;
				document.forms.frm.billing_year.value = document.forms.frm.billing_year.value.replace(/[\-, ]/g, "");
				var rgMatch = rgYear1.exec(document.forms.frm.billing_year.value);
				if (rgMatch == null)
				{
					ErrorText += "Expiration Year is in incorrect format.\n";
					document.getElementById('billing_year_st').style.visibility = "visible";
					bCCHasError = true;
				}
				else
				{
					document.getElementById('billing_year_st').style.visibility = "hidden";
				}
			}

			/* CVV shouldn't be a required field
			if(document.forms.frm.billing_cvv.value == "")
			{
				document.forms.frm.billing_cvv_st.style.visibility= "visible";
			}
			else
			{
				document.forms.frm.billing_cvv_st.style.visibility= "hidden";
			}
			*/

			// Check for new fields

			if (document.forms.frm.PhoneNumber.value == "")
			{
				document.getElementById('PhoneNumber_st').style.visibility = "visible";
				ErrorText += "Phone number is blank.\n";
				bHasError = true;
			}
			else
			{
				document.getElementById('PhoneNumber_st').style.visibility = "hidden";
			}
			if (document.forms.frm.OwnOrRent.value == "")
			{
				document.getElementById('OwnOrRent_st').style.visibility = "visible";
				ErrorText += "Rent/Own not chosen.\n";
				bHasError = true;
			}
			else
			{
				document.getElementById('OwnOrRent_st').style.visibility = "hidden";
			}

			// User wants mortgage info and needs to fill out fields
			if (document.forms.frm.MortgageInfo[0].checked)
			{
				if (document.forms.frm.LoanType.value == "")
				{
					document.getElementById('LoanType_st').style.visibility = "visible";
					ErrorText += "Loantype is blank.\n";
					bHasError = true;
				}
				else
				{
					document.getElementById('LoanType_st').style.visibility = "hidden";
				}
				if (document.forms.frm.ResidenceType.value == "")
				{
					document.getElementById('ResidenceType_st').style.visibility = "visible";
					ErrorText += "Residence type is blank.\n";
					bHasError = true;
				}
				else
				{
					document.getElementById('ResidenceType_st').style.visibility = "hidden";
				}
				if (document.forms.frm.PaymentTerm.value == "")
				{
					document.getElementById('PaymentTerm_st').style.visibility = "visible";
					ErrorText += "Payment term is blank.\n";
					bHasError = true;
				}
				else
				{
					document.getElementById('PaymentTerm_st').style.visibility = "hidden";
				}
				if (document.forms.frm.EstimatedLoanAmount.value == "")
				{
					document.getElementById('EstimatedLoanAmount_st').style.visibility = "visible";
					ErrorText += "Loan amount is blank.\n";
					bHasError = true;
				}
				else
				{
					document.getElementById('EstimatedLoanAmount_st').style.visibility = "hidden";
				}
				if (document.forms.frm.LoanPurpose.value == "")
				{
					document.getElementById('LoanPurpose_st').style.visibility = "visible";
					ErrorText += "Loan purpose is blank.\n";
					bHasError = true;
				}
				else
				{
					document.getElementById('LoanPurpose_st').style.visibility = "hidden";
				}
				if (document.forms.frm.NumberOfUnits.value == "")
				{
					document.getElementById('NumberOfUnits_st').style.visibility = "visible";
					ErrorText += "Number of units is blank.\n";
					bHasError = true;
				}
				else
				{
					document.getElementById('NumberOfUnits_st').style.visibility = "hidden";
				}
				if (document.forms.frm.InterestRateRequested.value == "")
				{
					document.getElementById('InterestRateRequested_st').style.visibility = "visible";
					ErrorText += "Interest rate requested is blank.\n";
					bHasError = true;
				}
				else
				{
					document.getElementById('InterestRateRequested_st').style.visibility = "hidden";
				}
			}
			// User don't want mortgage info and don't need to fill out fields
			else
			{
				document.getElementById('LoanType_st').style.visibility = "hidden";
				document.getElementById('ResidenceType_st').style.visibility = "hidden";
				document.getElementById('PaymentTerm_st').style.visibility = "hidden";
				document.getElementById('EstimatedLoanAmount_st').style.visibility = "hidden";
				document.getElementById('LoanPurpose_st').style.visibility = "hidden";
				document.getElementById('NumberOfUnits_st').style.visibility = "hidden";
				document.getElementById('InterestRateRequested_st').style.visibility = "hidden";
			}

			// End checking for new fields

			if (bHasError == true)
			{
				alert('Item(s) Needing Attention:\n'+ErrorText);
				document.forms.frm.SUBMIT.value = "Run My Credit";
				document.forms.frm.SUBMIT.disabled = false;
				document.forms.frm.CLEAR.disabled = false;
				return false;
			}

			return true;
		}
		function FillForm()
		{
			document.forms.frm.Firstname.value="Bill";
			document.forms.frm.Lastname.value="Steiner";
			document.forms.frm.Suffix.value="";
			document.forms.frm.SSN.value="216965192";

			document.forms.frm.FirstnameCoborrower.value="Charles";
			document.forms.frm.LastnameCoborrower.value="Garrett";
			document.forms.frm.SuffixCoborrower.value="";
			document.forms.frm.SSNCoborrower.value="243434449";

			document.forms.frm.StreetAddress.value="563 68th B";
			document.forms.frm.City.value="Arverne";
			document.forms.frm.state.value="NY";
			document.forms.frm.Zip.value="11692";
			document.forms.frm.Suffix.value="";
			//document.forms.frm.billing_first.value = "Wayne";
			//document.forms.frm.billing_sur.value = "Ma";
			document.forms.frm.billing_cardnum.value = "4111111111111111";
			document.forms.frm.billing_st.value = "1048 Sunflower Ave. Ste. 100";
			document.forms.frm.billing_city.value = "Costa Mesa";
			document.forms.frm.billing_state.value = "CA";
			document.forms.frm.billing_zip.value = "92626";
			document.forms.frm.billing_month.value = "12";
			document.forms.frm.billing_year.value = "2009";
			//document.forms.frm.billing_cvv.value = "987";
			//document.frm.msgbox.style.visibility = "hidden";

			document.forms.frm.PhoneNumber.value = "800.555.1212";
			document.forms.frm.EmailAddress.value = "MyEmail@yahoo.com";
			document.forms.frm.OwnOrRent.value = "Rent";
			document.forms.frm.LoanType.value = "Conventional";
			document.forms.frm.ResidenceType.value = "Primary Residence";
			document.forms.frm.PaymentTerm.value = "15 Years";
			document.forms.frm.EstimatedLoanAmount.value = "300000";
			document.forms.frm.LoanPurpose.value = "Purchase";
			document.forms.frm.NumberOfUnits.value = "4";
			document.forms.frm.InterestRateRequested.value = "5.5";
		}

		function CopyAddress()
		{
			if (document.forms.frm.SameAddress.checked)
			{
				document.forms.frm.billing_st.value = document.forms.frm.StreetAddress.value;
				document.forms.frm.billing_city.value = document.forms.frm.City.value;
				document.forms.frm.billing_state.value = document.forms.frm.state.value;
				document.forms.frm.billing_zip.value = document.forms.frm.Zip.value;
			}
			else
			{
				document.forms.frm.billing_st.value = "";
				document.forms.frm.billing_city.value = "";
				document.forms.frm.billing_state.value = "";
				document.forms.frm.billing_zip.value = "";
			}
		}
//--------------------------------------------------------
function DisplayData()
{
	var Data;

	Data = "<h3>URLlist Variables:<\/h3>";
	if (URLlistVariables == null)
	{
		alert("Loan Application not found: URL list");
		history.go(-2);
	}
	else
	{
		var vv = 0;
		if (URLlistVariables != null)
			vv = URLlistVariables.length;
		for (var i=0;i<vv;i++)
		{
			URLlistCookie = URLlistVariables[i].split("=");
			Data += URLlistCookie[0]+": "+URLlistCookie[1]+"<br />";
		}
	}

	Data += "<h3>AppInfo Variables:<\/h3>";
	if (AppInfoVariables == null)
	{
		alert("Loan Application not found: AppInfo");
		history.go(-2);
	}
	else
	{
		if (URLlistVariables != null)
		for (var i=0;i<AppInfoVariables.length;i++)
		{
			AppInfoCookie = AppInfoVariables[i].split("=");
			Data += AppInfoCookie[0]+": "+AppInfoCookie[1]+"<br />";
		}
	}
	CoAddress();

	if (DisplayDebug == 0)
	{
		document.getElementById('Debugging').style.display='none';
		document.getElementById('Co-Overall').style.display='none';
		document.getElementById('stars').style.display='none';
		document.getElementById('Fill').style.display='none';
	}

	document.getElementById('Debugging').innerHTML = Data;
}


function DisplayFormElements()
{
	var Data = "<h3>Form Elements Being Sent:<\/h3>";
	var FormVariables=document.forms.frm;

	for (var i=0;i<FormVariables.length;i++)
		Data += FormVariables.elements[i].name+": |"+FormVariables.elements[i].value+"|<br />";

	document.getElementById('Debugging').innerHTML += Data;
}

function SynchFields()
{
	document.forms.frm.cmd.value = "order";
	document.forms.frm.SUBMIT.disabled = true;
	document.forms.frm.CLEAR.disabled = true;
	DisplayFormElements();

	if(document.forms.frm.billing_cardnum.value == "")
	{
		alert("Please Enter Your Credit Card Number");
		document.forms.frm.SUBMIT.value = "Run My Credit";
		document.forms.frm.SUBMIT.disabled = false;
		document.forms.frm.CLEAR.disabled = false;
		return(false);
	}

	return(true);
}


</script>
<style type="text/css">
div#Overall {background:#EBF5F5;border:2px solid #099;height:386px;text-align:center;padding:12px 4px;}
div#Overall{margin:0 auto;width:450px;}
div#Text {float:left;background:#EBF5F5;height:460px;text-align:center;}
div#Text {border:2px solid #099;border-right:none;padding:12px 6px;width:240px;}
div#Co-Overall {background:#EBF5F5;border:2px solid #099;height:400px;width:450px;text-align:center;padding:4px;}
div#Co-Overall {margin-top:30px;}
div.co-data {float:right;color:#009;font-size:100%;margin:0;padding:5px;width:290px;}

div.Labels p {height:20px;margin:0;text-align:right;color:#066;font-weight:bold;font-size:90%;}
div.data input,div.data select, div#co-data input,div#co-data select {font-size:90%;margin:2px 0;}
div.data input {width:270px;}
div.Labels p {height:26px;line-height:26px;}
div.data p, div#co-data p {font-size:90%;}
div#Text p {font-size:10pt;}
div#stars p {margin:0;}
div.data {width:124px;color:#009;}
div.data, div.Labels {float:right;padding:2px;margin:0;}
div.data{width:290px;}
div.Labels {width:140px;}
#Form {margin:0;padding:0;}
h1, h2, h3 {background:transparent;color:#066;font-weight:bold;}
h3 {text-align:left;margin:0;font-size:110%;}
</style>
</HEAD>
<body onload='ReadCookies();FillValues();DisplayData();'>

<?php include('../include/top.php'); ?>
<div id="Heading" style="width:90%;">
<div class="Title"><h1 id="Small">Credit<br />Plus</h1></div>
<div class="Title">
<div id="Big"><h1>Credit Report Request</h1></div>
<div id="BigShadow"><h1>Credit Report Request</h1></div></div>
</div><br style="clear:left;">
<div id='cont' style='width:720px;'>
  <h3>Important</h3><p>To process your application, your tri-merged credit report must be run for us (with our name on the report), even if you know
  your score. It is a requirement from our lenders and investors. The charge is $15.00 for either a single applicant or married
  CoApplicants.</p>

<div id='Overall'>
<form id="frm" method="post" onSubmit='return(SychFields());'  
action='https://credit.creditplus.com/custom/aspec/aspec.asp'>
<h3 style='text-align:center;'>Credit Card Processing</h3>
<INPUT type="hidden" id="cmd" name="cmd">
<INPUT type="hidden" name="uid" value="52ee5158-474f-489b-83af-e57d8bc626c0">
<INPUT type="hidden" name="sid" value="D4E20C153C704947563C5B3835453335344948384841393FB8F6522016A8D858">

<INPUT type="hidden" id="Firstname" name="Firstname" size="16" value="">
<INPUT type="hidden" id="Middlename" name="Middlename" size="12" value="">
<INPUT type="hidden" id="Lastname" size="16" name="Lastname" value="">
<input type="hidden" id="Select1" name="Suffix">

<INPUT type="hidden" id="FirstnameCoborrower" name="FirstnameCoborrower" size="16">
<INPUT type="hidden" id="MiddlenameCoborrower" name="MiddlenameCoborrower" size="12" value="">
<INPUT type="hidden" id="LastnameCoborrower" size="16" name="LastnameCoborrower" value="">
<input type="hidden" id="Select2" name="SuffixCoborrower">

<INPUT type="hidden" id="billing_st" name="billing_st" size="53" value="">
<INPUT type="hidden" id="billing_city" name="billing_city" size="29" value="">
<input type="hidden" id="billing_state" name="billing_state">
<INPUT type="hidden" id="billing_zip" size="10" name="billing_zip" value="">

<!--
<div class='data'><p><input type="text" tabindex='1' name="BillingFullName" id="BillingFullName"></p></div>
<div class="Labels"><p>Name on Card</p></div>
-->
<div class='data'><p><input type="text" tabindex='8' name="billing_cardnum" value="" size='19' style='width:120px;'></p></div>
<div class="Labels"><p>Credit Card #</p></div>
<INPUT type="hidden" id="billing_cvv" name="billing_cvv" size="5" value="">
<div class='data'><p><select size="1" tabindex='12' name="billing_month">
	<option selected value="1">01
	<option value="2">02</option>
	<option value="3">03</option>
	<option value="4">04</option>
	<option value="5">05</option>
	<option value="6">06</option>
	<option value="7">07</option>
	<option value="8">08</option>
	<option value="9">09</option>
	<option value="10">10</option>
	<option value="11">11</option>
	<option value="12">12</option>
	</select>
	<select size="1" tabindex='16' name="billing_year">
	<option value="2006">2006</option>
	<option selected value="2007">2007</option>
	<option value="2008">2008</option>
	<option value="2009">2009</option>
	<option value="2010">2010</option>
	<option value="2011">2011</option>
	<option value="2012">2012</option>
	<option value="2013">2013</option>
	<option value="2014">2014</option>
	<option value="2015">2015</option>
	<option value="2016">2016</option>
	</select></p></div>
<div class="Labels"><p>Expiration Date</p></div>
<div class="data"><h3>We Accept</h3></div>
<div class="Labels"><h3>&nbsp;</h3></div>
<div class="data" style='text-align:left;'><img src="../images/CreditCards/Discover.gif" title='Discover' style='width:50px;margin-right:12px;' alt='' >
	<img src="../images/CreditCards/AMEX.gif" title='American Express' style='width:50px;margin-right:12px;' alt='' >
	<img src="../images/CreditCards/DinersClub.gif" title='Diners Club' style='width:50px;height:33px;margin-right:12px;' alt='' ></div>
<div class="Labels">
    <img src="../images/CreditCards/MasterCard.gif" title='MasterCard' style='width:50px;margin-right:12px;' alt='' >
	<img src="../images/CreditCards/Visa.gif" title='Visa' style='width:50px;' alt='' ></div>

<div class="data"><p><input type="checkbox" tabindex='19' name="SameAddress" style='width:13px;height:13px;' onclick='BillingAddress();' >
Copy Applicant's Current Address</p></div>
<div class="Labels"><p>&nbsp;</p></div>
<br style='clear:right;'><p style='font-weight:bold;color:#066;'>For your protection we verify credit card billing address information.</p>
<div class="data"><p><input type="text" tabindex='20' name="StreetAddress" id="StreetAddress" ></p></div>
<div class="Labels"><p>Billing Address</p></div>
<div class="data"><p><input type="text" tabindex='24' name="City" id="City" style='width:150px;'>
	<select size="1" tabindex='28' name="state">
	<option selected value=" ">&nbsp;</option>
	<option value="AL">AL</option>
	<option value="AK">AK</option>
	<option value="AR">AR</option>
	<option value="AZ">AZ</option>
	<option value="CA">CA</option>
	<option value="CO">CO</option>
	<option value="CT">CT</option>
	<option value="DE">DE</option>
	<option value="FL">FL</option>
	<option value="HI">HI</option>
	<option value="ID">ID</option>
	<option value="IL">IL</option>
	<option value="IN">IN</option>
	<option value="KY">KY</option>
	<option value="LA">LA</option>
	<option value="MA">MA</option>
	<option value="ME">ME</option>
	<option value="MO">MO</option>
	<option value="MS">MS</option>
	<option value="NE">NE</option>
	<option value="NH">NH</option>
	<option value="NJ">NJ</option>
	<option value="NM">NM</option>
	<option value="NV">NV</option>
	<option value="NY">NY</option>
	<option value="OH">OH</option>
	<option value="OK">OK</option>
	<option value="OR">OR</option>
	<option value="PA">PA</option>
	<option value="SC">SC</option>
	<option value="TN">TN</option>
	<option value="TX">TX</option>
	<option value="UT">UT</option>
	<option value="VA">VA</option>
	<option value="WI">WI</option>
	<option value="WY">WY</option>
</select>
	<input type="text" tabindex='32' name="Zip" id='Zip' style='width:70px;'></p></div>
<div class="Labels"><p>City/State/Zip</p></div>
<div class="data"><p><input type="text" tabindex='32' name="EmailAddress"  style='width:270px;'></p></div>
<div class="Labels"><p>Billing Email</p></div>
  </div><br style='clear:both;' >

<!--
<STRONG>Credit Card Billing Information</STRONG>
You must use your own credit card with your name (as specified above) on it.

<INPUT type="hidden" id="billing_st" name="billing_st" size="53" value="">
<INPUT type="hidden" id="billing_city" name="billing_city" size="29" value="">
<input type="hidden" id="billing_state" name="billing_state">
<INPUT type="hidden" id="billing_zip" name="billing_zip" size="10" value="">
<INPUT type="hidden" id="billing_cardnum" name="billing_cardnum" size="16" maxlength="16" value="">
<INPUT type="hidden" id="billing_cvv" name="billing_cvv" size="5" value="">
<input type="hidden" id="billing_month" name="billing_month" size="1">
<INPUT type="hidden" id="billing_year" name="billing_year" size="6" maxlength="4" value="">
<INPUT type="hidden" id="EmailAddress" name="EmailAddress" size="30" value="">
-->
<INPUT type="hidden" id="PhoneNumber" name="PhoneNumber" size="16" value="">
<input type="hidden" id="OwnOrRent" name="OwnOrRent" value="Own">
<INPUT type="hidden" name="MortgageInfo" value="InfoYes">
<INPUT type="hidden" name="MortgageInfo" value="InfoNo">
<INPUT type="hidden" name="LoanType" value="Conventional">
<INPUT type="hidden" name="ResidenceType" value="Primary Residence">
<INPUT type="hidden" name="PaymentTerm" value="15 Years">
<INPUT type="hidden" name="EstimatedLoanAmount" value="300000">
<INPUT type="hidden" name="LoanPurpose" value="Purchase">
<INPUT type="hidden" name="NumberOfUnits" value="4">
<INPUT type="hidden" name="InterestRateRequested" value="5.5">

<h3 style='margin:16px 0 12px;text-align:center;'>Authorization Agreement</h3>
<textarea readonly rows='12' cols='86'>I hereby authorize WESTERN THRIFT &amp; LOAN to verify my past and present employment earnings records, bank accounts, stockholdings, and any other asset balances that are needed to process my mortgage loan application. I further authorize WESTERN THRIFT &amp; LOAN to order a consumer credit report and verify other credit information, including past and present mortgages and landlord references.

WESTERN THRIFT &amp; LOAN may also utilize the services of CREDITPLUS to further verify my personal credit information and the information WESTERN THRIFT &amp; LOAN obtains is only to be used in the processing of my application for a mortgage loan. It is understood that a copy of this form will also serve as authorization. This authorization expires 120 days from the date indicated below.

Privacy Act Notice: This information is to be used by the agency collecting it or its assignees in determining whether you qualify as a prospective mortgagor under its program. It will not be disclosed outside the agency except as required and permitted by law. You do not have to provide this information, but if you do not your application for approval as a prospective mortgagor or borrower may be delayed or rejected. The information requested in this form is authorized by Title 38, USC, Chapter 37 (if VA); by 12 USC, Section 1701 et. seq. (if HUD/FHA); by 42 USC, Section 1452b (if HUD/CPD); and Title 42 USC, 1471 et. seq., or 7 USC, 1921 et. seq. (if USDA/FmHA).
</textarea>
<div style='width:100%;text-align:center;'>
<h3 style='text-align:center;margin:6px 0;'>By typing my Social Security Number in the box below, I hereby authorize
WESTERN THRIFT &amp; LOAN to pull a credit report on me.</h3>

<p style='text-align:center;'>Borrower SSN&nbsp;<input id="SSN" name="SSN" size="9" maxlength="9" value="" style='margin-right:24px;'>
Coborrower SSN&nbsp;<input id="SSNCoborrower" name="SSNCoborrower" size="9" maxlength="9" value=""></p>
<input type='hidden' id='referral' name='referral' value='TONY FERLAZZO'>

<INPUT id='SUBMIT' tabindex='72' onclick='SynchFields();this.value="One moment...";Submit();' type='button' value='Run My Credit' name='SUBMIT' >
<INPUT id='CLEAR' tabindex='76' onclick='GoToURL(cancelURL)' type='button' value='Cancel' name='CLEAR' >
<!-- The Fill button is for testing purpose -->

<INPUT id="Fill" onclick="FillForm();" type="button" value="Fill" name="Fill" >
</div></form></div>
<br style='clear:both;' >

<form name="DebugForm" id="DebugForm" method="post" action='#'>
	<div id='Co-Overall'>
	<div class='co-data'><h3>Borrower</h3></div>
	<div class='co-data'><p><input type="text" tabindex='40' name="DeApplicantFullName" ><br ></p></div>
	<div class="Labels"><p>Full Name</p></div>
	<div class='co-data'><p><input type="text" tabindex='36' name="DeSSN" id="DeSSN" ></p></div>
	<div class="Labels"><p>Social Security #</p></div>
	<div class='co-data'><h3>Co-Borrower</h3></div>
	<p>&nbsp;</p>
	<div class='co-data'><p><input type="text" tabindex='40' name="DeCoApplicantFullName" ></p></div>
	<div class="Labels"><p>Full Name</p></div>
	<div class='co-data'><p><input type="text" tabindex='48' name="DeCoSSN" ></p></div>
	<div class="Labels"><p>Social Security #</p></div>
	<div class='co-data'><p><input type="checkbox" tabindex='52' checked name="CoSameAddress" style='width:13px;height:13px;background:yellow;border:none;' onclick='CoAddress();' > Same Address As Borrower</p></div>
	<p>&nbsp;</p>
	<div class='co-data'><p><input type="text" tabindex='56' name="DeCoStreetAddress"  ></p></div>
	<div class="Labels"><p>Address</p></div>
	<div class='co-data'><p><input type="text" tabindex='60' name="DeCoCity" >
	<select size="1" tabindex='64' name="DeCoState">
	<option value=" ">&nbsp;</option>
	<option value="AL">AL</option>
	<option value="AK">AK</option>
	<option value="AR">AR</option>
	<option value="AZ">AZ</option>
	<option value="CA">CA</option>
	<option value="CO">CO</option>
	<option value="CT">CT</option>
	<option value="DE">DE</option>
	<option value="FL">FL</option>
	<option value="HI">HI</option>
	<option value="ID">ID</option>
	<option value="IL">IL</option>
	<option value="IN">IN</option>
	<option value="KY">KY</option>
	<option value="LA">LA</option>
	<option value="MA">MA</option>
	<option value="ME">ME</option>
	<option value="MO">MO</option>
	<option value="MS">MS</option>
	<option value="NE">NE</option>
	<option value="NH">NH</option>
	<option value="NJ">NJ</option>
	<option value="NM">NM</option>
	<option value="NV">NV</option>
	<option value="OH">OH</option>
	<option value="OK">OK</option>
	<option value="OR">OR</option>
	<option value="PA">PA</option>
	<option value="SC">SC</option>
	<option value="TN">TN</option>
	<option value="TX">TX</option>
	<option value="UT">UT</option>
	<option value="VA">VA</option>
	<option value="WI">WI</option>
	<option value="WY">WY</option>
</select>
	<input type="text" tabindex='68' name="DeCoZip" style='width:70px;'></p>
    </div>
	<div class="Labels"><p>City, State Zip</p></div>
</div>

</form><br >
<div id='Debugging' style='display:block;text-align:left;'>
<hr style='width:100%;' ><h1>Debug Data</h1></div>
<div id='stars'>
<p id='firstname_st'>first name Borrower</p>
<p id='lastname_st'>last name Borrower</p>
<p id='ssn_st'>ssn Borrower</p>
<p id='firstnameCoborrower_st'>first name Coborrower</p>
<p id='lastnameCoborrower_st'>last name Coborrower</p>
<p id='ssnCoborrower_st'>ssn Coborrower</p>
<p id='staddress_st'>Street address</p>
<p id='City_st'>City</p>
<p id='state_st'>State</p>
<p id='Zip_st'>Zip</p>
<p id='billing_cardnum_st'>Card Number</p>
<p id='billing_st_st'>Billing Adress</p>
<p id='billing_city_st'>Billing City</p>
<p id='billing_state_st'>Billing State</p>
<p id='billing_zip_st'>Billing Zip</p>
<p id='billing_month_st'>Billing Month</p>
<p id='billing_year_st'>Billing Year</p>
<p id='PhoneNumber_st'>Phone Number</p>
<p id='OwnOrRent_st'>Own or Rent</p>
<p id='LoanType_st'>Loan Type</p>
<p id='ResidenceType_st'>Residence Type</p>
<p id='PaymentTerm_st'>Payment Term</p>
<p id='EstimatedLoanAmount_st'>Estimated Loan Amount</p>
<p id='LoanPurpose_st'>Loan Purpost</p>
<p id='NumberOfUnits_st'>Number Of Units</p>
<p id='InterestRateRequested_st'>Interest Rate Requested</p>
</div>
<?php include("../include/bottom.php"); ?>

</body>
</HTML>
