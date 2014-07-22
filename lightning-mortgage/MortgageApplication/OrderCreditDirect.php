<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<html>
<head>
<title>Order Credit Report Direct</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta name="copyright" content="Copyright 2006, Anthony Ferlazzo, Lightning Mortgage">
<meta name="description" content="Credit Report">
<meta name="robots" content="NoIndex, NoFollow">
<meta name="keywords" content="credit report for mortgage">
<meta name="rating" content="General">
<meta name="robots" content="Index, ALL">
<base target="_self">
<link rel="stylesheet" href="../css/MortgageApplicationStyles.css" type="text/css">
<link rel="stylesheet" href="../css/Tabs.css" type="text/css">
<!--[if IE 6]>
<style type="text/css">
html
{
	scrollbar-base-color: #EBF5F5;
	scrollbar-arrow-color: #FFF;
	scrollbar-track-color: #007B5D;
	scrollbar-face-color: #099;
	scrollbar-3dlight-color: #099;
}
</style>
<![endif]-->
<script src="http://www.google.com/coop/cse/brand?form=cse-search-box&lang=en" type="text/javascript"></script>
<script language="JavaScript" type="text/javascript">
<!--
// debug can be either none or alert depending
// on the kind of debugging I want to do
//
var debug="none";
var redirectString;


// doError is the error handling routine
// depending on the type of debug message
// it presents either no debug message, an alert
// or puts the message in a textarea
//

function doError(the_message)
{
   if (debug == "alert")
   {
	alert(the_message);
   }
}

function validate()
{
 doError("Start validate()");

  /*  build URL string to send */

  redirectString="https://ecreditlending.com/V2.00/cp1ccplugin.aspx?";

/* if the cookie is not found (meaning an application has NOT previously been submitted) then go here */
  redirectString+="&errorURL=http://www.lightning-mortgage.com/OrderCreditFailure.php";

  doError("Redirect String: " + redirectString);
}

var time = null;

function move()
{
  window.location = redirectString
}

//  window.location.replace(redirectString)

//-->
</script>
</head>

<!-- load this page, then wait x milliseconds (timeout value) before executing the move() function) -->

<body onload="timer=setTimeout('move()',2000)">

<div class="Content" id="ContentDIV" style='height:250px;'>
<div id="Heading" style="width:85%;">
<div class="Title"><h1 id="Small">Credit<br />Report</h1></div>
<div class="Title">
<div id="Big"><h1>Request For Report</h1></div>
<div id="BigShadow"><h1>Request For Report</h1></div></div>
</div><br style="clear:left;">
	<div style="float:left;margin-right:1em;"><img border="0" src="../images/StackOfMoney.gif"
	alt="Apply For A Mortgage Loan At Lightning Mortgage" style="padding-bottom:2em;width:145px;height:123px;"></div>

	<p>You will now be taken to the credit card processing
	screen to run your credit report.</p>
	<p>The credit card will be charged $15.</p>
</div>
<script language="JavaScript" type="text/javascript">
validate();
</script>
<?php include("../include/bottom.php"); ?>

</body>
</html>
