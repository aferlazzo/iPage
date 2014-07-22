<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Send a Credit Request</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta name="description" content="blank">
<meta name="keywords" content="blank">
<meta name="copyright" content="Copyright 2006, Anthony Ferlazzo, Lightning Mortgage">
<meta name="rating" content="General">
<meta name="robots" content="Index, ALL">
<script src="http://www.google.com/coop/cse/brand?form=cse-search-box&lang=en" type="text/javascript"></script>
<script language="JavaScript" src="../AJAX/xmlhttp.js" type="text/javascript"></script>
<link rel="stylesheet" href="../css/MortgageApplicationStyles.css" type="text/css">
<link rel="stylesheet" href="../css/Tabs.css" type="text/css">
<script type="text/javascript">

//AJAX Extended...
var oDocXMLhttp = new XMLHTTP();
oDocXMLhttp.onerror = function(description) { alert('Error: ' + description) }

/*
var oTheGetXMLhttp;

var oDocXMLhttp = false;

function createXMLHttpRequest()
{
	if (window.ActiveXObject)
    	oDocXMLhttp = new ActiveXObject("Microsoft.XMLHTTP");
	else
	{
		if (window.XMLHttpRequest)
	    	oDocXMLhttp = new XMLHttpRequest();
	}
}

function createXMLHttpResponse()
{
    if (window.ActiveXObject) {
        oTheGetXMLhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    else if (window.XMLHttpResponse) {
        oTheGetXMLhttp = new XMLHttpResponse();
    }
}
*/
function loadRequest()
{
	var sRequest  = "<INPUT>";
	sRequest = sRequest + "<USER_INFO login='westernthrift' password='tonyf345'\/>";
	sRequest = sRequest + "<REQUEST request_type='NEW' async='T'>";
	sRequest = sRequest + "<ORDER_DETAIL reference_number='Case #12' experian_credit_flag='T' transunion_credit_flag='T' equifax_credit_flag='T' experian_score_flag='T' transunion_score_flag='T' equifax_score_flag='T' \/>";
	sRequest = sRequest + "<APPLICANT firstname='"+document.Form.ApplicantFirstName.value+"' surname='"+document.Form.ApplicantLastName.value+"' ssn='"+document.Form.SSN.value+"'\/>";
	sRequest = sRequest + "<CURRENT_ADDRESS streetnumber='"+document.Form.StreetNumber.value+"' streetname='"+document.Form.StreetName.value+"' aptnumber='"+document.Form.AptNumber.value+"' city='"+document.Form.City.value+"' state='"+document.Form.State.value+"' zip='"+document.Form.Zip.value+"'\/>";
	sRequest = sRequest + "<OUTPUT_FORMAT format_type='XML'\/>";
	sRequest = sRequest + "<\/REQUEST>";
	sRequest = sRequest + "<\/INPUT>";
	return(sRequest);
}

function loadResponseQuery()
{
	var sPolling  = "<INPUT>";
	sPolling = sPolling + "<USER_INFO login='westernthrift' password='tonyf345'\/>";
	sPolling = sPolling + "<REQUEST request_type='GET' async='T'>";
	var nReportID = "test-1a";
	sPolling = sPolling + "<ORDER_DETAIL report_id='" & nReportID & "'\/>";
	sPolling = sPolling + "<OUTPUT_FORMAT format_type='XML'\/>";
	sPolling = sPolling + "<\/REQUEST>";
	sPolling = sPolling + "<\/INPUT>";
	return(sPolling);
}

function postRequest()
{
    //createXMLHttpRequest();

    var xml = loadRequest();
    var url = "https://credit.meridianlink.com/inetapi/get_credit.aspx";

    oDocXMLhttp.open("POST", url, false); //false means call is not asynchronous
	oDocXMLhttp.onreadystatechange = handleRequestStateChange;
    oDocXMLhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    oDocXMLhttp.send(xml);
	//alert("Request xml:\n"+xml+"\nurl:\n"+url+"\nSent");
	//alert("XMLHttpRequest status:\n"+oDocXMLhttp.status+", "+oDocXMLhttp.statusText);
}

// -----------------
// Each time the XMLHttpRequest object's internal state changes, this function is called.
// Once the response is received (ready state == 4) parseResults() is called.
// -----------------
function handleRequestStateChange()
{
    if(oDocXMLhttp.readyState == 4)
	{
        if(oDocXMLhttp.status == 200)
		{
            parseResults();
        }

		else
			alert("Detected: Credit Report Server Status: "+oDocXMLhttp.statusText+", "+oDocXMLhttp.status);

    }

	alert("readyState of Request: "+oDocXMLhttp.readyState+" responseText: "+oDocXMLhttp.responseText);

}
function parseResults()
{
// First empty DIV contents

    var responseDiv = document.getElementById("serverResponse");
    if(responseDiv.hasChildNodes()) {
        responseDiv.removeChild(responseDiv.childNodes[0]);
    }

// Get response

	var xmlDoc = oDocXMLhttp.responseXML;

	// Extract the status code
	var responseText = document.createTextNode(oDocXMLhttp.responseText);
	var x = 13 + oDocXMLhttp.responseText.indexOf("status_code");
	var y = oDocXMLhttp.responseText.indexOf('"', x);
	Stat = oDocXMLhttp.responseText.substring(x,y);
	//alert("Status: "+Stat);

	if (Stat == "READY")
	{
		alert("Status: Ready. Now what?");
    	//uncomment next line to view complete response
		//responseDiv.appendChild(responseText);
		document.getElementById("Button").value="Request Credit Report";
	}

	if (Stat == "ERROR")
	{
		//alert("Status: Error. Now what?");
		//responseDiv.appendChild(responseText);
		document.getElementById('serverResponse').innerHTML = "<h1>Please double-check input values and try again</h1>";
		document.getElementById("Button").value="Request Credit Report";
		document.getElementById("ApplicantFirstName").focus();
	}

	//alert("Response Text"+oDocXMLhttp.responseText);

/*
    createXMLHttpResponse();

    var xml = loadResponseQuery();
    var url = "https://web.com/inetapi/get_credit.aspx";
*/
}
</script>
<style type="text/css">
div#Overall {background:silver;border:2px solid #009;height:310px;width:460px;text-align:center;}
div#labels, div#data {height:180px;width:160px;float:right;padding:5px;color:#009;font-size:100%;margin:0;}
div#data {padding:5px;width:280px;}
div#labels p {height:30px;margin:0;text-align:right;}
div#data input {font-size:90%;line-height:100%;}
div#data p {height:30px;margin:0;width:280px;}
#Form {margin:0;padding:0;}
</style>
</head>

<body>
  <h1>Credit Report Request</h1>
  <div id='Overall'><h3>Current Billing Address</h3>
  <form name="Form" id="Form" action="#"><div id='data'>

	<p><input type="text" name="ApplicantFirstName" id="ApplicantFirstName" value="BILL" /></p>
	<p><input type="text" name="ApplicantLastName" value="STEINER" /><br /></p>
	<p><input type="text" name="StreetNumber" value="563" style='width:40px;text-align:right;' />
	<input type="text" name="StreetName" value="68TH" />
	Apt <input type="text" name="AptNumber" value="B" style='width:40px;'/></p>
	<p><input type="text" name="City" value="ARVERNE" />
	<input type="text" name="State" value="NY" style='width:40px;'/>
	<input type="text" name="Zip" value="11692" style='width:70px;'/></p>
	<p><input type="text" name="SSN" value="216965192" /></p>
	<p><input type="text" name="CardNumber" value="" /></p>
    </div>
  <div id="labels">
  <p>First Name</p>
  <p>Last Name</p>
  <p>Address</p>
  <p>City, State Zip</p>

  <p>Social Security Number</p>
  <p>Credit card number</p>
  </div>
  <br style="clear:right;">
    <input type="button" id="Button" value="Request Credit Report" onclick="this.value='One moment...';postRequest();"/>
  </form></div><br />
  <h2>Server Response:</h2>

  <div id="serverResponse"></div>

</body>
</html>
