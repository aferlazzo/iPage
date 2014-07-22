<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<html>
<head>
<title>Checklist of Documents For Financing with Lightning Mortgage</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta http-equiv="Content-Language" content="en-us">
<meta name="copyright" content="Copyright 2006, Anthony Ferlazzo, Lightning Mortgage">
<meta name="rating" content="General">
<meta name="robots" content="Index, ALL">
<meta name="description"
content="mortgage borrower documentation">
<meta name="keywords"
content="mortgage borrower documentation">
<base target="_self">
<style type="text/css">
p.Qlabel,p.Qlabel:first-letter{
text-align:left;
margin:14px 0 14px 0;
color:#009;
font-size:small;
font-family:Verdana,Arial,Helvetica,sans-serif;
font-weight:bolder;
}
div Lcolumn {float:left;width:6em;background:white;border:thin solid black; }
</style>
<link rel="stylesheet" href="../css/AnswersStyles.css" type="text/css">
<link rel="stylesheet" href="../css/Tabs.css" type="text/css">

<style type="text/css" media="print">
@page regular{
size:8.5in 11in;
margin:0.3in 0.5in;
marks:none;
}
div#BigShadow{display:none;}
body, div.Main, h1, h2, p, ul, ol, input {color: black; background:transparent;}
div.Main {height:600px;}
div.Content {height:450px;border:2px solid black;}
body { font-size:small; }
ol { font-size:small; }
h1 { font-size:medium; }
p:first-letter { font-size:small;font-family:Verdana,Arial,Helvetica,sans-serif; }
p { padding-bottom:0.25em;margin:0; }

div#TopLeftCorner, div#TopFrame, div#TopRightCorner,
div#BottomLeftCorner, div#BottomRightCorner, div#BottomFrame,div#LeftFrame, div#RightFrame,
div#MS, div#TipTop, div#Tabs, div.Top, div.TopFrame, div.TFR, div.TFL, div.Bottom1, div.Bottom2, form,
input.Submit, div.NextSteps, .top, .b1, .b2, .b3, .b4,
div#steps, #bot {height:0;display:none;}
div#ContentDIV {overflow:visible;}

div.Main{position:static;}
h2{
width:100%;
margin: 0 4px;
}

p.Qlabel,p.Qlabel:first-letter{
text-align:left;
margin:14px 0 14px 0;
color:#009;
font-size:small;
font-family:Verdana,Arial,Helvetica,sans-serif;
font-weight:bolder;
}

input.Property{margin:1px;}
</style>

<script language="JavaScript" type="text/javascript">
<!--
function Validate()
{
if ((document.F.SelfEmployed[0].checked == false ) && (document.F.SelfEmployed[1].checked == false ))
{
alert("Please specify whether this is full doc");
return(false);
}

if ((document.F.Salaried[0].checked == false ) && (document.F.Salaried[1].checked == false ))
{
alert("Please specify whether or not you are a salaried employee");
return(false);
}

if ((document.F.Retired[0].checked == false ) && (document.F.Retired[1].checked == false ))
{
alert("Please specify whether or not you receive retirement income");
return(false);
}

if ((document.F.Disabled[0].checked == false ) && (document.F.Disabled[1].checked == false ))
{
alert("Please specify whether or not you are receiving disability income");
return(false);
}

if ((document.F.PSupport[0].checked == false ) && (document.F.PSupport[1].checked == false ))
{
alert("Please specify whether or not you are paying child support or alimony");
return(false);
}

if ((document.F.PSupport[0].checked == false ) && (document.F.PSupport[1].checked == false ))
{
alert("Please specify whether or not you are paying child support or alimony");
return(false);
}

if ((document.F.RSupport[0].checked == false ) && (document.F.RSupport[1].checked == false ))
{
alert("Please specify whether or not you are receiving child support or alimony");
return(false);
}

if ((document.F.BK[0].checked == false ) && (document.F.BK[1].checked == false ))
{
alert("Please specify whether or not you have declared bankruptcy in the past 7 years");
return(false);
}

if ((document.F.Purchase[0].checked == false ) && (document.F.Purchase[1].checked == false ))
{
alert("Please specify whether or not you have are purchasing a home");
return(false);
}

if ((document.F.HOA[0].checked == false ) && (document.F.HOA[1].checked == false ))
{
alert("Please specify whether or not the property is part of a Homeowner's Association");
return(false);
}
if ((document.F.Owner[0].checked == false ) && (document.F.Owner[1].checked == false ))
{
alert("Please specify whether or not you currently own a home");
return(false);
}

if ((document.F.UScitizen[0].checked != true ) && (document.F.UScitizen[1].checked != true ))
{
alert("Please specify whether or not you are a US citizen");
return(false);
}

return (true);
}
//-->
</script>
</head>
<body>
<?php include('../include/top.php'); ?>
<?php
	$ReferringServer = "http://" . $HTTP_HOST . $REDIRECT_URL;

	//print ("Referrer: $ReferringServer<br />\n");

if (!ReferringServer)
	die("Sorry, but I did not get the address of the page to send.
	This information may be being blocked by your browser settings,
	or your firewall");

if ($_SERVER['REQUEST_METHOD']=="POST")  // if receiving the answers to the questions
{
	$SelfEmployed=$_POST['SelfEmployed'];
	$Salaried=$_POST['Salaried'];
	$Retired=$_POST['Retired'];
	$Disabled=$_POST['Disabled'];
	$PSupport=$_POST['PSupport'];
	$RSupport=$_POST['RSupport'];
	$BK=$_POST['BK'];
	$Purchase=$_POST['Purchase'];
	$HOA=$_POST['HOA'];
	$Owner=$_POST['Owner'];
	$URL=$_POST['url_to_send'];
	$errs="";


	if (!$url_to_send)
		$errs.="<p>URL to page not recieved. It may be blocked by your firewall or browser</p>";

	if (strpos($url_to_send, $HTTP_HOST) < 7)
		$errs.="<p>Bad referring page|$url_to_send|$HTTP_HOST|<br /></p>";

	if ($errs)
	{
		print ("<h1 style='text-align: center; font: italic normal bold x-large Verdana; color: red;'>");
		print ("Documentation List Not Generated!</h1>");
		print ("<table border='0' cellpadding='2' cellspacing='0'><tr><td>");
		print ("<p>Could not create the list because of the following error(s):<br />$errs</p>");

		print ("<center><input style='color: #ffffff; background-color: #000099; font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; width: 150px;'");
		print ("type='button' value='Make Correction(s)' onClick='window.history.back()'></center><br />&nbsp;");
		print ("</td></tr></table>");
	}
	else
	{
?>
<div id="Heading" style="width:90%">
<div class="Title"><h1 id="Small">My<br />Customized</h1></div>
<div class="Title">
<div id="Big"><h1>Documentation List</h1></div>
<div id="BigShadow"><h1>Documentation List</h1></div></div>
</div><br style="clear:left;">

<table style="width:100%;border:none;">
<tr><td style="width:50%;text-align:left;"><p>From:______________________________<br />&nbsp;</p>

<p>Phone:__________________<br />&nbsp;</p><p>Fax:____________________</p></td>
<td style="vertical-align:top;text-align:left;"><p>Fax this cover page along with the specified documents to us at (866) 822-8500
so we can complete your loan.<br />&nbsp;</p><p>Number pages faxed:______</p>
<div class="NextSteps" style="padding:0;margin:0;"><p>Press this Print button to correctly print this page.</p></div>
</td></tr></table>
<div class="NextSteps" ><form>
<input style="width:9em;font-size:medium;" type="Submit" class="Submit" value="Print This Page"
onclick="if (window.print) window.print()" onMouseover="this.className='MouseOver'" onMouseout="this.className='Submit'">
</form>
</div>
<div> <!-- style='height:550px;' -->
	<p style='font-weight:bold;font-size:110%;'>Please use BLACK INK only. Other colors do not fax well.</p>
	<ul>
		<li>
			<p>A copy of your last 3 months bank statements (all pages, even those with no data on them)</p>
		</li>
		<li>
			<p>Clear crisp copy of your current driver license(s). Please make a photo-copy
			of your license and enlarge the copy of the little card. Fax us the enlargement.
			Otherwise we won't be able to read any of the information on it. This is an
			absolute 'must have' in light of the US Patriot Act <a target="_blank" title="opens a new window"
			href="http://www.epic.org/privacy/terrorism/hr3162.phpl">(HR 3162)</a><img src="../images/NewWindow.gif" ALT=""></p>
		</li>
<?php
	if ($Owner == "Yes")
	{
		print("<li><p>Copy of your present First Mortgage monthly statement</p></li>");
		print("<li><p>Copy of your present Second Mortgage monthly statement, if you have a second mortgage</p></li>");
		print("<li><p>Copy of your present Property Tax statement</p></li>");

		if ($Purchase == "No")
		print("<li><p>Copy of the Declaration Page (front) of your currently active homeowner (fire) insurance policy (must include insurance agent's name and telephone number, coverage and costs)</p></li>");
	}

	if ($Purchase == "Yes")
	{
		print("<li><p>The name and phone number of the insurance agent you are using for homeowners/hazard insurance<br />");
		print("<br />___________________________________________________________________________________<br />&nbsp;</p></li>");
	}

	if ($HOA == "Yes")
	{
		print("<li><p>Name and phone number of the HOA contact (for a certification and to obtain insurance information)<br />");
		print("<br />___________________________________________________________________________________<br />&nbsp;</p></li>");
	}

	if ($Salaried == "Yes")
		{
		print("<li><p>Pay stubs for past one month (4 weekly, 2 bi-weekly). Pay stubs should show your name, your employer's name, current earnings, and YTD totals).</p></li>");
?>
					<script type="text/javascript">
				var Today 	= new Date();
				var ThisYear 	= Today.getFullYear();
				var DayName = Today.getDate();
				var LastYear = ThisYear - 1;
				document.write("<li><p>W-2s and/or 1099's for last 2 years</p></li> ");
			</script>
<?php
		}

	if ($SelfEmployed == "Yes")
	{
	print("<li><p>Copy of your business license that shows dates business has been in operation (minimum 2 years)<br />");
	print("or, letter from your tax preparer stating you have filed income taxes as a business entity for at least two years</p></li>");
	}

	if ($Disabled == "Yes")
		print("<li><p>Include your Disability Award Letter(s)</p></li>");

	if ($Retired == "Yes")
		print("<li><p>Include your Retirement Award Letter(s)</p></li>");

	if ($Owner == "Yes")
		print("<li><p>Rental Agreement(s) for any rental property (if you are a landlord)</p></li>");
	else
	{
		print("<li><p>Name, address and phone number for your landlord(s) or property management company(s) for the past 12 months<br />");
		print("<br />___________________________________________________________________________________<br />&nbsp;</p></li>\n");
	}
	if ($UScitizen == "No")
		print("<li><p>Resident Alien card (front &amp; back)</p></li>");

	if (($PSupport == "Yes") || ($RSupport == "Yes"))
	{
		print("<li><p>Copy of the Divorce Decree</p></li>");
		print("<li><p>For each child you are receiving or paying child support, a copy of their birth certificate</p></li>");
	}

	if ($BK == "Yes")
	{
		print("<li><p>Bankruptcy Discharge Paperwork, including Schedule E and Schedule F<br />");
		print("For Chapter 13, list Trustee name and phone number, and trustee pay-off amount if you have it<br />");
		print("<br />___________________________________________________________________________________<br />&nbsp;</p></li>\n");
	}

print("</ul><div style='width:280px;'>\n");
print("<b class='top'></b><b class='b1'></b><b class='b2'></b><b class='b3'></b><b class='b4'></b>\n");
print("<h2 style='width:278px;'>Your Questionnaire Answers</h2>\n");
print("<b class='bottom'></b><b class='b4'></b><b class='b3'></b><b class='b2'></b><b class='b1'></b></div><ul>\n");

	if($SelfEmployed == "Yes")
	print ("<li>I am self-employed/own my own business</li>\n");
	else
	print ("<li>I am not self-employed</li>\n");
	if($Salaried == "Yes")
	print ("<li>I am a salaried (W-2 or 1099) wage earner (I receive no tips or commission income)</li>\n");
	else
	print ("<li>My salary is inconsistant. It includes tips or commission income</li>\n");
	if($Retired == "Yes")
	print ("<li>I receive retirement income</li>\n");
	else
	print ("<li>I am NOT retired</li>\n");
	if($Disabled == "Yes")
	print ("<li>I receive disability income</li>\n");
	else
	print ("<li>I do NOT receive diability income</li>\n");
	if ($PSupport== "Yes")
	print ("<li>I am paying child support or alimony</li>\n");
	else
	print ("<li>I am NOT paying child support or alimony</li>\n");
	if ($RSupport== "Yes")
	print ("<li>I am receiving child support or alimony</li>\n");
	else
	print ("<li>I am NOT receiving child support or alimony</li>\n");
	if ($BK== "Yes")
	print ("<li>I've declared bankruptcy in the past 7 years</li>\n");
	else
	print ("<li>I have NOT declared bankruptcy in the past 7 years</li>\n");
	if ($Purchase == "Yes")
	print ("<li>I am purchasing a home</li>\n");
	else
	print ("<li>I am refinancing a home</li>\n");
	if ($HOA== "Yes")
	print ("<li>The property is part of a Homeowners Association</li>\n");
	else
	print ("<li>The property is NOT part of a Homeowners Association</li>\n");
	if ($Owner== "Yes")
	print ("<li>I own the property I'm living in</li>\n");
	else
	print ("<li>I rent the property I'm living in</li>\n");
	if ($UScitizen== "Yes")
	print ("<li>I am a US citizen</li>\n");
	else
	print ("<li>I am NOT a US citizen</li></ol>\n");
?>
	</ul></div>
	<div id='bot' class="NextSteps">
	<hr>
<div id='steps' style='width:120px;'>
<b class="top"></b><b class="b1"></b><b class="b2"></b><b class="b3"></b><b class="b4"></b>
<h2 style='width:118px;'>Next Steps</h2>
<b class="bottom"></b><b class="b4"></b><b class="b3"></b><b class="b2"></b><b class="b1"></b></div>
	<ul>
		<li><a
		href="../Answers.php">Explore the rest of the Loan Process</a></li>
		<li><a
		href="../CreditScores.php">Explore Credit Score Topics</a></li>
		<li><a
		href="../LoanTypes.php">Learn about Loan Types</a></li>
		<li><a
		href="../Answers/PreAnswers.php">Determine if you want to be pre-qualified or pre-approved</a></li>
		<li><a
		href="../InterestRates/EducationTaxes.php">Learn about the Tax Advantages of Home Ownership</a></li>
		<li><a
    	href="../MortgageApplication/LoanAppShort.php">Submit A Loan Application</a></li>
	</ul>
	</div>
<?php
	}
}
else // Performed initially, if asking the questions
{
	$ReferringServer = "http://" . $HTTP_HOST . $REDIRECT_URL;

	//print ("Referrer: $ReferringServer<br />\n");

//	print ("<form name='F' action=".$_SERVER['PHP_SELF']." onsubmit='return(ShowValue(document.F.UScitizen));' method='post'>");
	print ("<form name='F' onsubmit='return Validate();' action='Documentation.php' method='post'>");
	print ("<input type='hidden' name='url_to_send' value='$ReferringServer'>");
?>
<div id="Heading" style="width:75%">
<div class="Title"><h1 id="Small">Documents<br />and Records</h1></div>
<div class="Title">
<div id="Big"><h1>Questionnaire</h1></div>
<div id="BigShadow"><h1>Questionnaire</h1></div>
</div></div><br style="clear:left;">

	<p>Congratulations. You're almost through the hardest part of the loan process. We have received
	your application, have thoroughly reviewed your credit report, <i>and</i> have had a telephone
	conversation with you about	our findings. You're ready to move forward. Please complete the following
	questionnaire to create a custom tailored list of documents you'll need to send us. If you are a
	co-borrower, answer for both parties.</p>

<p class="Qlabel"><input type="radio" value="Yes" name="SelfEmployed" id="YesSelfEmployed" tabindex="1"><label for='YesSelfEmployed'>Yes</label>
<input type="radio" value="No" name="SelfEmployed" id="NoSelfEmployed" tabindex="2"><label for='NoSelfEmployed'>No</label> - I am self-employed/own my own business</p>

<p class="Qlabel"><input type="radio" value="Yes" name="Salaried" id="YesSalaried" tabindex="3"><label for='YesSalaried'>Yes</label>
<input type="radio" value="No" name="Salaried" id="NoSalaried" tabindex="4"><label for='NoSalaried'>No</label> - I am a salaried (W-2 or 1099) wage earner (I receive no tips or commission income)</p>

<p class="Qlabel"><input type="radio" value="Yes" name="Retired" id="YesRetired" tabindex="5"><label for='YesRetired'>Yes</label>
<input type="radio" value="No" name="Retired" id="NoRetired" tabindex="6"><label for='NoRetired'>No</label> - I receive retirement income</p>

<p class="Qlabel"><input type="radio" value="Yes" name="Disabled" id="YesDisabled" tabindex="7"><label for='YesDisabled'>Yes</label>
<input type="radio" value="No" name="Disabled" id="NoDisabled" tabindex="8"><label for='NoDisabled'>No</label> - I receive disability income</p>

<p class="Qlabel"><input type="radio" value="Yes" name="PSupport" id="YesPSupport" tabindex="9"><label for='YesPSupport'>Yes</label>
<input type="radio" value="No" name="PSupport" id="NoPSupport" tabindex="10"><label for='NoPSupport'>No</label> - I am paying child support or alimony</p>

<p class="Qlabel"><input type="radio" value="Yes" name="RSupport" id="YesRSupport" tabindex="11"><label for='YesRSupport'>Yes</label>
<input type="radio" value="No" name="RSupport" id="NoRSupport" tabindex="12"><label for='NoRSupport'>No</label> - I am receiving child support or alimony</p>

<p class="Qlabel"><input type="radio" value="Yes" name="BK" id="YesBK" tabindex="13"><label for='YesBK'>Yes</label>
<input type="radio" value="No" name="BK" id="NoBK" tabindex="14"><label for='NoBK'>No</label> - I've declared bankruptcy in the past 7 years</p>
<hr>

<p class="Qlabel"><input type="radio" value="Yes" name="Purchase" id='YesPurchase' tabindex="15"><label for='YesPurchase'>Yes</label>
<input type="radio" value="No" name="Purchase" id='NoPurchase' tabindex="16"><label for='NoPurchase'>No</label> - I am purchasing a home</p>

<!--
<p class="Qlabel"><input type="radio" value="Yes" name="Purchase" tabindex="15" onclick='document.F.Owner[1].click();'><label for='YesSelfEmployed'>Yes</label>
<input type="radio" value="No" name="Purchase" tabindex="16" onclick='document.F.Owner[0].click();'><label for='NoSelfEmployed'>No</label> - I am purchasing a home</p>
-->
<p class="Qlabel"><input type="radio" value="Yes" name="HOA" id="YesHOA" tabindex="17"><label for='YesHOA'>Yes</label>
<input type="radio" value="No" name="HOA" id="NoHOA" tabindex="18"><label for='NoHOA'>No</label> - This home is part of Homeowners Association</p>

<p class="Qlabel"><input type="radio" value="Yes" name="Owner" id='YesOwner' tabindex="19"><label for='YesOwner'>Yes</label>
<input type="radio" value="No" name="Owner" id='NoOwner' tabindex="20"><label for='NoOwner'>No</label> - I presently own my home</p>

<p class="Qlabel"><input type="radio" value="Yes" name="UScitizen" id='YesUScitizen' tabindex="21"><label for='YesUScitizen'>Yes</label>
<input type="radio" value="No" name="UScitizen" id='NoUScitizen' tabindex="22"><label for='NoUScitizen'>No</label> - I am a US Citizen</p>

<div style='height:80px;'>
<input type="submit" class="Submit" style="width:9em;font-size:medium;" value="Generate List" onMouseover="this.className='MouseOver'" onMouseout="this.className='Submit'">
</form></div>
<?php
}
?>
<?php include('../include/bottom.php'); ?>
</body>
</html>
