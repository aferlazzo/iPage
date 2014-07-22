<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Send a Credit Request</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta name="copyright" content="Copyright 2006, Anthony Ferlazzo, Lightning Mortgage" />
<meta name="rating" content="General" />
<meta name="robots" content="NoIndex, NoFollow" />
<script src="http://www.google.com/coop/cse/brand?form=cse-search-box&lang=en" type="text/javascript"></script>
<link rel="stylesheet" href="../css/MortgageApplicationStyles.css" type="text/css" />
<script type="text/javascript">
var DisplayDebug = 1; // change to 1 to view debug data

var AppInfo = GetMyValue("AppInfo");
var URLlist = GetMyValue("URLlist");
var Decoded = unescape(URLlist);
var URLlistCookie = new Array;
var AppInfoCookie = new Array;
var URLlistVariables = Decoded.split("\&");
//alert("Decoded List: "+Decoded+"\nVariables found: "+Variables.length);
for (var i=0;i<URLlistVariables.length;i++)
{
	//alert(Variables[i]);
	URLlistCookie = URLlistVariables[i].split("=");
	//alert("name: "+URLlistCookie[0]+"\nvalue: "+URLlistCookie[1]);
	if (URLlistCookie[0] == "returnURL")
		var returnURL = URLlistCookie[1];
	else
	if (URLlistCookie[0] == "cancelURL")
		var cancelURL = URLlistCookie[1];
	else
	if (URLlistCookie[0] == "errorURL")
		var errorURL = URLlistCookie[1];
	else
	if (URLlistCookie[0] == "charge")
		var charge = URLlistCookie[1];
	else
	if (URLlistCookie[0] == "to_email")
		var to_email = URLlistCookie[1];
	else
	if (URLlistCookie[0] == "cc_email")
		var cc_email = URLlistCookie[1];
	else
	if (URLlistCookie[0] == "email_subj")
		var email_subj = URLlistCookie[1];
}

Decoded = unescape(AppInfo);
var AppInfoVariables = Decoded.split("\&");
for (i=0;i<AppInfoVariables.length;i++)
{
	AppInfoCookie = AppInfoVariables[i].split("=");
	if (AppInfoCookie[0] == "ID")
		var coid = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "a_fullname")
		var a_fullname = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "a_lname")
		var a_lname = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "a_fname")
		var a_fname = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "a_mi")
		var a_mi  = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "a_gen=")
		var a_gen = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "a_ssn")
		var a_ssn = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "co_fullname")
		var co_fullname = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "co_lname")
		var co_lname = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "co_fname")
		var co_fname = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "co_mi")
		var co_mi = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "co_gen")
		var co_gen = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "co_ssn")
		var co_ssn = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "bill_phone")
		var bill_phone = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "bill_email")
		var bill_email = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "ca_fullstreet_name")
		var ca_fullstreet_name = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "&houseno")
		var houseno = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "direction")
		var direction = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "streetname")
		var streetname = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "streettype")
		var streettype = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "aptno")
		var aptno = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "city")
		var ca_city = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "state")
		var ca_state = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "zipcode")
		var ca_zipcode = AppInfoCookie[1];
	else
	if (AppInfoCookie[0] == "autopopcc")
		var autopopcc = AppInfoCookie[1];
}

//--------------------------------------------------------

var ErrorMsg="";
var xmlHttp = null;

function createXMLHttpRequest() 
{
	if (window.ActiveXObject)
    	xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	else
	{
		alert("Browser type is not supported.\nYou must use Internet Explorer to make a credit report requests.");
	}
}
//---------------------------------
//
// Build the xml server request to pull credit    
//
//---------------------------------
function loadRequestAsXml()
{
	var BnameArray = new Array();
	var CnameArray = new Array();
	
	BnameArray = parseName(a_fullname);
	//alert("FirstName: " + BnameArray[0] + "\nMiddleName: " + BnameArray[1] + "\nLastName: " + BnameArray[2] + "\nSuffix: " + BnameArray[3]);
	
	CnameArray = parseName(co_fullname);
	
	aSSN = document.Form.SSN.value.replace(/\-/g, "");
	coSSN = document.Form.CoSSN.value.replace(/\-/g, "");
	var ccard = document.Form.CardNumber.value.replace(/\- /g, "");
	var sRequest  = "<INPUT>";
	sRequest = sRequest + "<USER_INFO login='westernthrift' password='tonyf345'\/>";
	sRequest = sRequest + "<REQUEST request_type='NEW' async='T'>";
	sRequest = sRequest + "<ORDER_DETAIL reference_number='Case #12' experian_credit_flag='T' transunion_credit_flag='T' equifax_credit_flag='T' experian_score_flag='T' transunion_score_flag='T' equifax_score_flag='T' \/>";
	sRequest = sRequest + "<APPLICANT firstname='"+BnameArray[0]+"' surname='"+BnameArray[2]+"' ssn='"+aSSN+"'\/>";
	sRequest = sRequest + "<CURRENT_ADDRESS streetaddress='"+document.Form.BillingStreetAddress.value+"' city='"+document.Form.BillingCity.value+"' state='"+document.Form.BillingState.value+"' zip='"+document.Form.BillingZip.value+"'\/>";

	if ((CnameArray[0] != "") || (CnameArray[2] != "") || (document.Form.CoSSN.value != ""))
		sRequest = sRequest + "<SPOUSE firstname='"+CnameArray[0]+"' surname='"+CnameArray[2]+"' ssn='"+coSSN+"'\/>";

	if ((document.Form.CoStreetAddress.value != "") ||(document.Form.CoCity.value != "") ||(document.Form.CoState.value != "") ||(document.Form.CoZip.value != ""))
		sRequest = sRequest + "<PREVIOUS_ADDRESS streetaddress='"+document.Form.CoStreetAddress.value+"' city='"+document.Form.CoCity.value+"' state='"+document.Form.CoState.value+"' zip='"+document.Form.CoZip.value+"'\/>";
	BnameArray = parseName(document.Form.BillingFullName.value);
	sRequest = sRequest + "<CREDITCARD_PAYMENT billing_firstname='"+BnameArray[0]+"' billing_surname='"+BnameArray[2]+"' billing_street='"+document.Form.BillingStreetAddress.value+"' ";
	sRequest = sRequest + "billing_city='"+document.Form.BillingCity.value+"' billing_state='"+document.Form.BillingState.value+"' billing_zip='"+document.Form.BillingZip.value+"' ";
	sRequest = sRequest + "card_number='"+document.Form.CardNumber.value+"' expiration_month='"+document.Form.ExpirationMonth.value+"' expiration_year='"+document.Form.ExpirationYear.value+"' \/>";
	sRequest = sRequest + "<OUTPUT_FORMAT format_type='XML'\/>";
	sRequest = sRequest + "<\/REQUEST>";
	sRequest = sRequest + "<\/INPUT>";
	return(sRequest);
}
//-----------------------
//
// first, build the XMLHttpRequest object. If successful, then...
// open: Set up the call to the server
// The call will be a post, with the parameters passed via xml
// onreadystatechange: sets up the state change handler
// then call the server.
//
//-----------------------

function postRequest()
{
    if(createXMLHttpRequest() != false)
	{
    	var xml = loadRequestAsXml();
    	var url = "https://credit.meridianlink.com/inetapi/get_credit.aspx";

    	xmlHttp.open("POST", url, true); //true means call is asynchronous
		xmlHttp.onreadystatechange = handleRequestStateChange;
    	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");    
    	xmlHttp.send(xml);
		document.Debug.Request.value = xml;
	}
	//alert("Request xml:\n"+xml+"\nurl:\n"+url+"\nSent");
	//alert("XMLHttpRequest status:\n"+xmlHttp.status+", "+xmlHttp.statusText);
}

// -----------------
// Each time the XMLHttpRequest object's internal state changes, this function is called.
// Once the response is received (ready state == 4) parseResults() is called. 
// -----------------
function handleRequestStateChange() 
{
    if(xmlHttp.readyState == 4) 
	{
		//alert("responseText:\n"+xmlHttp.responseText);
		document.Debug.Response.value = xmlHttp.responseText;

		var x = 7 + xmlHttp.responseText.indexOf("[CDATA[");
		var y = xmlHttp.responseText.indexOf(']', x);
		ErrorMsg = xmlHttp.responseText.substring(x,y);
		//alert('|'+ErrorMsg+'|');
		if (ErrorMsg == "Required attribute CREDITCARD_PAYMENT[@billing_street")
			ErrorMsg = "Please enter the billing address";
	
		if (ErrorMsg == "Required attribute CREDITCARD_PAYMENT[@billing_city")
			ErrorMsg = "Please enter the billing city";
	
		if (ErrorMsg == "Required attribute CREDITCARD_PAYMENT[@billing_zip")
			ErrorMsg = "Please enter the billing zipcode";
	
		if (ErrorMsg == "Required attribute CREDITCARD_PAYMENT[@card_number")
			ErrorMsg = "Invalid credit card number";
		
		if (ErrorMsg == "Missing borrower's ssn.")
			ErrorMsg = "Please enter the borrower's social security number";
		
		//alert("readyState of Request: "+xmlHttp.readyState+"\nDetected: Credit Report Server Status: "+xmlHttp.statusText+", "+xmlHttp.status);
		//alert("responseXML:\n"+xmlHttp.responseXML);

        if(xmlHttp.status == 200) 
		{
            parseResults();
        }

    }
	/*
	else
		alert("readyState of Request: "+xmlHttp.readyState);
	*/
}



function GoToURL(URL)
{
	window.location = URL;
}

//------------------------------
//
// Get the server's response to the request
//
//------------------------------

function parseResults() 
{
// First empty DIV contents

    var responseDiv = document.getElementById("serverResponse");
    if(responseDiv.hasChildNodes()) {
        responseDiv.removeChild(responseDiv.childNodes[0]);
    }

// Get the server's response
    
// First extract the status code

	var responseText = document.createTextNode(xmlHttp.responseText);
	var x = 13 + xmlHttp.responseText.indexOf("status_code");
	var y = xmlHttp.responseText.indexOf('"', x);
	Stat = xmlHttp.responseText.substring(x,y);
	//alert("Status: "+Stat);
	
	if (Stat == "READY")
	{
		ErrorMsg="Success! I'm off to ".returnURL;
		var Sresponse = "<h1>"+ErrorMsg+"<\/h1>";
		document.getElementById('serverResponse').innerHTML = Sresponse;;
    	//uncomment next line to view complete response
		//responseDiv.appendChild(responseText);
		document.getElementById("Button").value="Request Credit Report";
		//alert("Response Text"+xmlHttp.responseText);

		timer=setTimeout('GoToURL(returnURL)',2000);
	}	
	else
	if (Stat == "ERROR")
	{
		//alert("Status: Error. Now what?");
		//responseDiv.appendChild(responseText);
		document.getElementById('serverResponse').innerHTML = "<h1>"+ErrorMsg+"<\/h1>";
		document.getElementById("Button").value="Request Credit Report";
		document.getElementById("BillingFullName").focus();
		//timer=setTimeout('GoToURL(errorURL)',10000);
	}
// amx card begins w/34, visa begins with 4, mc begings with 5, Discover begings with 6
// diners begins with 30

	if ((ErrorMsg == "Invalid credit card number")
	 || (ErrorMsg == "Credit card number is invalid.")
	 || (ErrorMsg == "Visa card must have 13 or 16 digits.")
	 || (ErrorMsg == "MasterCard card must have 16 digits.")
	 || (ErrorMsg == "Discover card must have 16 digits.")
	 || (ErrorMsg == "AmericanExpress card must have 15 digits.")
	 || (ErrorMsg == "DinersClub card must have 14 or 16 digits.")
	 || (ErrorMsg == "Card number cannot be assigned to a credit card type.")
	 || (ErrorMsg == "Card number too short."))
	{
		//alert("Status: Not Ready. Waiting 5 seconds");
		document.getElementById('serverResponse').innerHTML = "<h1>"+ErrorMsg+"<\/h1>";
		document.getElementById("Button").value="Request Credit Report";
		document.getElementById("CardNumber").focus();
	}
	else
	if (ErrorMsg == "Please enter the billing address")
	{
		document.getElementById('serverResponse').innerHTML = "<h1>"+ErrorMsg+"<\/h1>";
		document.getElementById("Button").value="Request Credit Report";
		document.getElementById("BillingStreetAddress").focus();
	}	
	else
	if (ErrorMsg == "Please enter the billing city")
	{
		document.getElementById('serverResponse').innerHTML = "<h1>"+ErrorMsg+"<\/h1>";
		document.getElementById("Button").value="Request Credit Report";
		document.getElementById("City").focus();
	}	
	else
	if (ErrorMsg == "Please enter the billing zipcode")
	{
		document.getElementById('serverResponse').innerHTML = "<h1>"+ErrorMsg+"<\/h1>";
		document.getElementById("Button").value="Request Credit Report";
		document.getElementById("BillingZip").focus();
	}	
	else
	if (ErrorMsg == "Please enter the borrower's social security number")
	{
		document.getElementById('serverResponse').innerHTML = "<h1>"+ErrorMsg+"<\/h1>";
		document.getElementById("Button").value="Request Credit Report";
		document.getElementById("SSN").focus();
	}	
	else
	if (ErrorMsg == "Invalid credit card number")
	{
		document.getElementById('serverResponse').innerHTML = "<h1>"+ErrorMsg+"<\/h1>";
		document.getElementById("Button").value="Request Credit Report";
		document.getElementById("CardNumber").focus();
	}	
	else
	if (ErrorMsg == "undefined")
	{
		//alert("Status: Not Ready. Waiting 5 seconds");
		document.getElementById('serverResponse').innerHTML = "<h1>"+ErrorMsg+"<\/h1>";
		document.getElementById("Button").value="Request Credit Report";
		document.getElementById("CardNumber").focus();
	}	
	else
	{
		//alert("Status: Not Ready. Waiting 5 seconds");
		document.getElementById("Button").value="Processing...";
     	setTimeout('postRequest()',5000);
	}	
}

//-------------------------------------------
function parseName(fullname)
{
	var NameArray = fullname.split(" ");
	var FirstName, LastName, MiddleName, Suffix;
	var ReturnName = new Array(); 
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
if (document.Form.SameAddress.checked == true)
{
	document.Form.CoStreetAddress.value = ca_fullstreet_name;
	document.Form.CoCity.value = ca_city;
	document.Form.CoState.value = ca_state;
	document.Form.CoZip.value = ca_zipcode;
}
  else
{
	document.Form.CoStreetAddress.value = "";
	document.Form.CoCity.value = "";
	document.Form.CoState.value = "";
	document.Form.CoZip.value = "";
}
}

function BillingAddress()
{
if (document.Form.SameBillingAddress.checked == true)
{
	document.Form.BillingStreetAddress.value = ca_fullstreet_name;
	document.Form.BillingCity.value = ca_city;
	document.Form.BillingState.value = ca_state;
	document.Form.BillingZip.value = ca_zipcode;
	document.Form.BillingPhone.value = bill_phone;
	document.Form.BillingEmail.value = bill_email;
}
  else
{
	document.Form.BillingStreetAddress.value = "";
	document.Form.BillingCity.value = "";
	document.Form.BillingState.value = "";
	document.Form.BillingZip.value = "";
	document.Form.BillingPhone.value = "";
	document.Form.BillingEmail.value = "";
}
}

function GetMyValue (CookieName)
{
var Name, Value;
var Beginning, Middle, End;
Beginning = 0;

while (Beginning < d.cookie.length)
{
	// find the next equals sign
	Middle = d.cookie.indexOf('=', Beginning);

	// find the next semicolon
	End = d.cookie.indexOf(';', Beginning);

	if (End == -1)	// if no semicolon exists, it's the last cookie...
		End = d.cookie.length;

	// if nothing is in the cookie, blank out its value
	if ((Middle > End) || (Middle == -1))
	{
		Name = d.cookie.substring(Beginning, End);
		Value = "";
	}
	else
	{
		//extract the Name and value
		Name = d.cookie.substring(Beginning, Middle);
		Value = d.cookie.substring(Middle + 1, End);
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
if (a_fullname != "")
{
	var BnameArray = new Array();
	var CnameArray = new Array();
	
	BnameArray = parseName(a_fullname);
	//alert("FirstName: " + BnameArray[0] + "\nMiddleName: " + BnameArray[1] + "\nLastName: " + BnameArray[2] + "\nSuffix: " + BnameArray[3]);
	CnameArray = parseName(co_fullname);
	document.Form.ApplicantFullName.value   = a_fullname;
	document.Form.BillingFullName.value     = a_fullname;
	document.Form.CoApplicantFullName.value = co_fullname;

	if (autopopcc.toUpperCase() == "Y")
	{
		document.Form.SameBillingAddress.checked = true;
		document.Form.BillingStreetAddress.value = ca_fullstreet_name;
		document.Form.BillingCity.value  = ca_city;
		document.Form.BillingState.value = ca_state;
		document.Form.BillingZip.value   = ca_zipcode;
		document.Form.BillingPhone.value = bill_phone;
		document.Form.BillingEmail.value = bill_email;
	}
	
	if (document.Form.SameAddress.value == "on")
	{
		document.Form.CoStreetAddress.value = ca_fullstreet_name;
		document.Form.CoCity.value = ca_city;
		document.Form.CoState.value = ca_state;
		document.Form.CoZip.value = ca_zipcode;
	}
	document.Form.SSN.value = a_ssn;
	document.Form.CoSSN.value = co_ssn;
}
else
{
	document.Form.ApplicantFullName.value = "ALFONSO EACOMMON";

	document.Form.BillingStreetAddress.value = "5 Compliant Ave";
	document.Form.BillingCity.value = "Tomorrow";
	document.Form.BillingState.value = "IL";
	document.Form.BillingZip.value = "60750";
	document.Form.SSN.value = "133-40-5381";
	document.Form.CoApplicantFullName.value ="Kelly AEACOMMON";
	document.Form.CoSSN.value = "050-60-5998";
}


}

createXMLHttpRequest();
</script>
<style type="text/css">
div#Overall, div#Text, div#Co-Overall {float:left;background:#EBF5F5;border:2px solid #099;height:470px;width:410px;text-align:center;padding:4px;}
div#Text {border-right:none;padding:12px;width:250px;height:454px;}
div#Co-Overall {float:none;margin-top:30px;}
div.Labels, div#data, div#co-data {height:180px;width:124px;float:right;padding:5px;color:#009;font-size:100%;margin:0;}
div#data, div#co-data {padding:5px;width:266px;}
div.Labels p {height:29px;padding-top:1px;margin:0;text-align:right;color:#066;font-weight:bold;}
div#data input,div#data select, div#co-data input,div#co-data select {font-size:90%;line-height:100%;}
div#data p, div#co-data p {height:30px;margin:0; }
#Form {margin:0;padding:0;}
h1, h2, h3 {background:transparent;color:#066;font-weight:bold;}
h3 {text-align:left;margin-bottom:12px;font-size:110%;}
</style>
</head>

<body onload='FillValues();document.getElementById("CardNumber").focus();'>

<?php include('../include/top.php'); ?>
<div id="Heading" style="width:90%;">
<div class="Title"><h1 id="Small">Credit<br />Plus</h1></div>
<div class="Title">
<div id="Big"><h1>Credit Report Request</h1></div>
<div id="BigShadow"><h1>Credit Report Request</h1></div></div>
</div><br style="clear:left;">
<div id='cont' style='width:700px;'>
  <div id="Text">
  <p>To process your application, your tri-merged credit report must be run for us (with our name on the report), even if you know
  your score. It is a requirement from our lenders and investors. The charge is $15.00 for either a single applicant or married 
  CoApplicants.</p>
  <p style='color:red;font-weight:bold;'>This process normally takes about 30 seconds, but it may take longer during certain times of the day. 
  When your credit card has been successfully charged, you will see a confirmation page.</p>
  <p>By clicking the 'Request Credit Report' button you are transmitting your electronic signature, 
  indicating you are authorized to use this card, and further that you are authorizing us to debit this credit 
  card for the specific purpose and limited amount you've selected. To cancel this transaction, click on the 'Cancel Transaction' button.</p></div>

  <div id='Overall'>
  <form name="Form" id="Form" action="#">
  <h3 style='text-align:center;'>Credit Card Processing</h3>
<div id='data'>
	<p><input type="text" tabindex='1' name="BillingFullName" id="BillingFullName" /></p>
	<p><input type="text" tabindex='8' name="CardNumber" value="" /></p>
	<p><select size="1" tabindex='12' name="ExpirationMonth">
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
	<select size="1" tabindex='16' name="ExpirationYear">
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
	</select></p>
	<h3>We Accept<br />
	<img src="../images/CreditCards/Discover.gif" style='width:50px;margin-right:12px;' alt='' />
	<img src="../images/CreditCards/AMEX.gif" style='width:50px;margin-right:12px;' alt='' />
	<img src="../images/CreditCards/DinersClub.jpg" style='width:50px;height:33px;margin-right:12px;' alt='' /></h3>
	<p><input type="checkbox" tabindex='19' name="SameBillingAddress" style='width:13px;height:13px;' onclick='BillingAddress();' /> 
	<span style='font-weight:bold;color:#066;'>Copy Applicant's Current Address</span></p>
	<p><input type="text" tabindex='20' name="BillingStreetAddress" id="BillingStreetAddress" /></p>
	<p><input type="text" tabindex='24' name="BillingCity" id="City" />
	<select size="1" tabindex='28' name="BillingState" />
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
	<input type="text" tabindex='32' name="BillingZip" id='BillingZip' style='width:70px;'/></p>
	<p><input type="text" tabindex='32' name="BillingEmail"  style='width:170px;'/></p>
    </div>
  <div class="Labels">
  <p>Name on Card</p>
  <p>Credit Card #</p>
  <p>Expiration Date</p>
  <h3>&nbsp;<br />
	<img src="../images/CreditCards/MasterCard.gif" style='width:50px;margin-right:12px;' alt='' />
	<img src="../images/CreditCards/Visa.gif" style='width:50px;' alt='' /></h3>
  <p>&nbsp;</p>
  <p>Billing Address</p>
  <p>City/State/Zip</p>
  <p>Billing Email</p>
  </div><br style='clear:right;' /><br />
  <p><span style='font-weight:bold;color:#066;'>For your protection we verify credit card billing address information.</span></p>
  <input type="button" tabindex='72' style='width:150px;margin:20px 6px 0 20px;' id="Button" value="Request Credit Report" onclick="this.value='One moment...';postRequest();"/>
  <input type='button' tabindex='76' style='width:130px;' value='Cancel Transaction' onClick='xmlHttp.abort();GoToURL(cancelURL)' />
  </div>
<br style='clear:both;' />

  <div id='Co-Overall'>
  <div id='co-data'>
	<h3>Borrower</h3>
	<p><input type="text" tabindex='40' name="ApplicantFullName" /><br /></p>
	<p><input type="text" tabindex='36' name="SSN" id="SSN" /></p>
	<p><input type="text" tabindex='32' name="BillingPhone"  style='width:90px;'/></p>
	<h3>CoBorrower</h3>
	<p><input type="text" tabindex='40' name="CoApplicantFullName" /><br /></p>
	<p><input type="text" tabindex='48' name="CoSSN" /></p>
	<p><input type="checkbox" tabindex='52' checked name="SameAddress" style='width:13px;height:13px;background:yellow;border:none;' onclick='CoAddress();' /> Same Address As Borrower</p>
	<p><input type="text" tabindex='56' name="CoStreetAddress"  /></p>
	<p><input type="text" tabindex='60' name="CoCity" />
	<select size="1" tabindex='64' name="CoState">
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
	<input type="text" tabindex='68' name="CoZip" style='width:70px;'/></p>
    </div>
  <div class="Labels">
  <h3>&nbsp;</h3>
  <p>Full Name</p>
  <p>Social Security #</p>
  <p>Billing Phone #</p>
  <h3>&nbsp;</h3>
  <p>Full Name</p>
  <p>Social Security #</p>
<p>&nbsp;</p>
  <p>Address</p>
  <p>City, State Zip</p>
  </div></div>
  <br /><br />
  </div></form><br />
  <div style='width:700px;'>
  <h2>Server Response</h2>

  <div id="serverResponse"></div>

<div id='Debugging' style='display:block;text-align:left;'>
<hr style='width:100%;' /><h1>Debug Data</h1>

<form name="Debug" id="Debug" action="#">
<h2>Request</h2><textarea tabindex='91' name="Request" id="Request" rows="10" cols="80"></textarea>
<h2>Response</h2><textarea tabindex='93' name="Response" id="Response" rows="30" cols="80"></textarea>
<br />
<script type="text/javascript">
document.write("<br />URLlist Variables:<br />");
for (var i=0;i<URLlistVariables.length;i++)
{
	URLlistCookie = URLlistVariables[i].split("=");
	document.write(URLlistCookie[0]+": "+URLlistCookie[1]+"<br />");
}
document.write("<br />AppInfo Variables:<br />");
for (var i=0;i<AppInfoVariables.length;i++)
{
	AppInfoCookie = AppInfoVariables[i].split("=");
	document.write(AppInfoCookie[0]+": "+AppInfoCookie[1]+"<br />");
}
CoAddress();

if (DisplayDebug == 0)
{
	document.getElementById('Debugging').style.display='none';
	document.getElementById('Co-Overall').style.display='none';
}
else
{
	document.getElementById('cont').style.width='100%';
}
</script>
</form>
</div></div></div>
<!--ih:includeHTML file="../include/bottom.php"-->
		<!--
		// http://www.lightning-mortgage.com/include/bottom-root.php is a copy of the contents ../include/bottom.php. It is the
		// web page bottom border that is inserted in all appropriate .php pages located at
		// the root level of the website.
		-->
		<div id='RightFrame'></div><div style='clear:left;'></div>
		<div id='LeftFrame' style='height:102px;'></div>
		<div class="Bottom2">
			<div style="float:right;height:90px;width:80px;">
				<img border='0' src='../images/equalhouse.gif' alt='Equal housing lender' style="">
			</div>
			<a href="http://www.lightning-mortgage.com/Administrative/SiteMap.php">Site Map</a>&nbsp;|
			<a href="http://www.lightning-mortgage.com/Administrative/Calculators.php">Calculators</a>&nbsp;|
			<a href="http://www.lightning-mortgage.com/Answers/GlossaryAD.php">Glossary</a>&nbsp;|
			<a href="http://www.lightning-mortgage.com/Administrative/PrivacyPolicy.php">Privacy Policy</a>&nbsp;|
			<a href="http://www.lightning-mortgage.com/Administrative/Legal.php">Legal</a>&nbsp;|
			<a href="http://www.lightning-mortgage.com/Administrative/AffiliateLinks.php">Affiliates</a><br />

			<p class="CenterSmall" style='text-align:center;'>Click on <a href="http://www.lightning-mortgage.com/Administrative/Feedback.php">feedback</a> 
			or call (866) 822-8500 for assistance - Last Updated:
			<script language="JavaScript1.2" type="text/javascript">
			<!--
				var lastMod = new Date(document.lastModified);
				var MM = lastMod.getMonth() + 1;
				var DD = lastMod.getDate();
				document.write(MM+"\/"+DD+"\/"+lastMod.getFullYear());
			//-->
			</script>
			</p>

			<p class="CenterSmall" style="margin:0;">This Website is NOT intended as a solicitation to customers in any jurisdiction in which we
			are not authorized to operate. 

			<script type="text/javascript">
				var Today 	= new Date();
				var ThisYear 	= Today.getFullYear();
				var DayName = Today.getDate();
				document.write("&copy; Lightning Mortgage 2002-" + ThisYear + " All Rights Reserved. No part of this website may be ");
			</script>

			reused commercially without the expressed written consent of Lightning Mortgage.
			This site is directed at, and made available to, persons in the continental U.S., Alaska and Hawaii only.</p>
		</div><!-- Bottom2 silver -->
		<div id='RightFrame' style='height:102px;'></div><div style='clear:left;'></div>
		<div id='BottomLeftCorner'></div><div id='BottomFrame'></div><div id='BottomRightCorner'></div>	
	</div> <!-- ContentBackground yellow -->	
</div> <!-- Main -->

<SCRIPT language="JavaScript" type="text/javascript"> 
<!--
BType();
SetContentHeight();
//-->
</SCRIPT>
<!--/ih:includeHTML-->
<!--ih:includeHTML file="../include/top.php-new"--><!-- ./include/top-root.php is a copy of the contents ./include/top.php with the directory levels changed-->
<div class="Top">
	<div id='MS'>
		<a href="http://www.lightning-mortgage.com/Answers/MortgageInsiderSecrets.php" class="Top" onfocus="if(this.blur) this.blur();">
		<img src="../images/SignUp.jpg" onMouseover='this.src="../images/SignUpHover.jpg"' onMouseout='this.src="../images/SignUp.jpg"' 
		style='border:none;' alt='sign-up'></a>
	</div><!--MS-->
	<div id='TipTop'>
		<a class="Logo" onfocus="if(this.blur) this.blur();" href="http://www.lightning-mortgage.com/index.php">
		<img src="../images/Lightning-Mortgage.jpg" style="border:none;"
		alt="Lightning Mortgage - Mortgages, even with Bad Credit" title="Lucio is in the house!"></a>
	</div><!--TipTop-->
	<noscript>
	<!--
	<p style="text-align:center;border:5px dotted #fff;font-size:large;color:#fff;">
	<br />Warning! Either your browser does not support JavaScript or it is currently disabled.<br />
	This website requires JavaScript to be properly viewed. Please enable JavaScript.<br />&nbsp;</p>
	//-->
	</noscript>
	<br style="clear:both;"> <!-- tabs here -->
	<div id="TabDiv">
		<div id="navTab">
			<script language="JavaScript" type="text/javascript">
			<!--
			ShowNewTabs(Directory);
			//-->
			</SCRIPT>
		</div><!--navTab-->
	</div><!-- TabDiv-->
</div><!--Top-->

<div class="TopFrame">
	<div class="TFL"></div>
	<div id='BelowTabs'>
		<a href="http://www.lightning-mortgage.com/Survey.php" title="Take our Satisfaction Survey"
		class="Top">Survey</a>&nbsp;|
		<a href="http://www.lightning-mortgage.com/Administrative/Feedback.php" title="Ask questions and give us feedback"
		class="Top">Questions?</a>&nbsp;|
		<a href="http://www.lightning-mortgage.com/Administrative/AboutUs.php" title="About Us"
		class="Top">About</a>&nbsp;|
		<a href="http://www.lightning-mortgage.com/Administrative/ContactUs.php" title="How to contact us"
		class="Top">Contact</a>&nbsp;|
		<a href="#" title="opens a new window" onclick="if (window.MapWindow) window.MapWindow.close();MapWindow=open('../Administrative/WhereWeLend.php',
			'pcalculator','height=520,width=600,top=0,left=0,alwaysRaised=yes,resizable=no,scrollbars=no,menubar=no,titlebar=yes,toolbar=no, scroll=yes');"
		class="Top">Where We Lend</a><img src="../images/NewWindow.gif" alt="opens new window">
	</div> <!-- BelowTabs -->
	<div class="TFR">
		<script language="JavaScript" type="text/javascript">
		<!--
		ShowSearchButton();
		//d.getElementById('ContentDIV').style.visibility = 'visible';
		-->
		</script>
	</div><!--TFR-->
</div>

<div class="Main">
	<div id="ContentBackground" style='background:transparent;'>
		<div id='TopLeftCorner'></div><div id='TopFrame'></div><div id='TopRightCorner'></div>
		<div style='clear:left;'></div>

		<div id='LeftFrame'></div>
		<div id="ContentDIV">
<!-- TopFrame -->
<!--/ih:includeHTML-->
</body>
</html>
