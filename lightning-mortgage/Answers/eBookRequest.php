<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<html>
<head>
<title>eBook Request</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta http-equiv="Content-Language" content="en-us">
<meta name="copyright" content="Copyright 2006, Anthony Ferlazzo, Lightning Mortgage">
<meta name="rating" content="General">
<meta name="robots" content="Index, ALL">
<meta name="description"
content="We provide real solutions, and refinancing &amp; home equity loans nationally to all credit grades, with liberal borrowing guidelines. ">
<meta name="keywords"
content="mortgage rates, mortgage calculator, loan, home loans, home financing, loan calculator, home equity loans, refinance, credit,
125% home equity loans, credit report, mortgage, home mortgage, mortgage refinancing, mortgage loan, mortgage broker, mortgage company,
interest rate, equity loan, online credit report, mortgage financing, home financing, home equity">
<base target="_self">
<link rel="stylesheet" href="../css/AnswersStyles.css" type="text/css">
<link rel="stylesheet" href="../css/Tabs.css" type="text/css">

<script src="http://www.google.com/coop/cse/brand?form=cse-search-box&lang=en" type="text/javascript"></script>
<script language="JavaScript1.2"  type="text/javascript">
<!--
function Trim(strInput)
{
	if(strInput.length == 0)
	{
		return "";
	}
	else
	{
		strTemp = strInput.substring(strInput.length - 1)
	}

	while (strTemp == " ")
	{
		strInput = strInput.substring(0, strInput.length - 1)

		if (strInput.length == 0)
		{
			strTemp = "";
		}
		else
		{
			strTemp = strInput.substring(strInput.length - 1)
		}
	}


	if (strInput.length == 0)
	{
		strTemp = "";
	}
	else
	{

		strTemp = strInput.substring(0, 1)
	}

	while (strTemp == " ")
	{
		strInput = strInput.substring(1)

		if (strInput.length == 0)
		{
			strTemp = "";
		}
		else
		{
			strTemp = strInput.substring(0, 1)
		}
	}

	return strInput;

}//close Trim Function



function checkEmail(strEmail)
{
		emailflag="";

   		if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(strEmail))
		{		//submit = 0;
			   emailflag="Valid";
		}
		else
		{
			emailflag="Not Valid";
		}

		return emailflag;

}//Ending check mail function




function Validate()
{

	var objName = document.Name;


	if(Trim(objName.Full_Name.value)=="")
	{
		alert("Please enter your name");
		objName.Full_Name.focus();
		return false;
	}


	if(Trim(objName.Email_Address.value) == "")
	{
		alert("Please enter your E-mail address");
		objName.Email_Address.focus();
		return false;
	}


	if(checkEmail(objName.Email_Address.value) == "Not Valid")
	{
		alert("Please enter a valid E-mail address");
		objName.Email_Address.focus();
		return false;
	}

	else

	{
		return true;
	}

}
//-->
</SCRIPT>
</head>
<body onload="window.document.Name.Full_Name.focus();">
<?php include('../include/top.php'); ?>
<div id="Heading" style="width:100%">
<div class="Title"><h1 id="Small">How To Play The<br />Mortgage Game and Win!</h1></div>
<div class="Title">
<div id="Big"><h1>Mortgage eBook</h1></div>
<div id="BigShadow"><h1>Mortgage eBook</h1></div></div>
</div><br style="clear:left;">
	<form name="Name" onsubmit="return(Validate());"
	action="http://www.lightning-mortgage.com/pr/optin.php" method="post">

	<table cellspacing="0" cellpadding="4" width="720">
		<tr>
			<td valign="bottom" align="center" colspan="2" width="516">
			</td>
			<td valign="middle" align="center" width="200" height="107" rowspan="5"><img border="0"
				src="../images/MortgageGameeBook.gif"
				alt="How To Play The Mortgage Game and Win! eBook"
				align="right" width="176" height="220">
			</td>
		</tr>
		<tr>
			<td align="center" valign="top" colspan="2" width="516">
				<p>We wrote the book about
				understanding how the mortgage industry works.
				You can receive a free online copy of
				understanding how refinancing really works by
				simply entering your name and e-mail address.</p>
				<p>Please rest assured that we
				respect your privacy and will not abuse the
				privilege of your subscription or give your email
				address to anyone under any circumstance. You may
				remove yourself at any time.</p>
				<p>For a copy, simply
				provide your information below:<br />
				&nbsp;</p>
			</td>
		</tr>
		<tr>
			<td width="253">
					<input type="hidden" name="arid" value="176">
					<input type="Hidden" name="redirect"
					value="http://www.lightning-mortgage.com/Answers/eBookRequestSuccess.php">
					<p style="text-align: right"><label
					for="Full_Name">Your First Name</label></p>
			</td>
			<td width="439">
				<p>
				<input type="Text" name="Full_Name" id="Full_Name"
				maxlength="50" size="30"
				onfocus="this.style.border='2px solid #93C'"
				onblur="this.style.border='2px solid silver'"></p>
			</td>
		</tr>
		<tr>
			<td width="253">
				<p style="text-align: right"><label
				for="Email_Address">Email</label></p>
			</td>
			<td width="439">
				<p>
				<input type="Text" name="Email_Address"
				id="Email_Address" maxlength="50" size="30"
				onfocus="this.style.border='2px solid #93C'"
				onblur="this.style.border='2px solid silver'"></p>
			</td>
		</tr>
		<tr>
			<td width="253" height="27">&nbsp;</td>
			<td style="text-align: left" width="439" height="35">
				<input style="width:200px;font-size:medium;" type="Submit" class="Submit" value="Get Free Information"
				onMouseover="this.className='MouseOver'" onMouseout="this.className='Submit'">
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<p>Adobe Reader is required
				to read our eBook. Click on the icon to
				download the newest version.</p>
				<a href="http://www.adobe.com/products/acrobat/readstep2.phpl">
				<img src="../images/getacro.gif" align="middle"
					border="0" alt="Adobe Reader" width="88" height="31"></a>
			</td>
		</tr>
	</table>
	</form>
	<hr><br />
<div style='width:120px;'>
<b class="top"><b class="b1"></b><b class="b2"></b><b class="b3"></b><b class="b4"></b></b>
<h2 style='width:118px;'>Next Steps</h2>
<b class="bottom"><b class="b4"></b><b class="b3"></b><b class="b2"></b><b class="b1"></b></b></div>
	<ul>
		<li><a
		href="../Answers.php">Explore the rest of the Loan Process</a></li>
		<li><a
		href="../CreditScores.php">Explore Credit Score Topics</a></li>		<li><a
		href="../LoanTypes.php">Learn about Loan Types</a></li>
		<li><a
		href="../Answers/PreAnswers.php">Determine if you want to be pre-qualified or pre-approved</a></li>
		<li><a
		href="../InterestRates/EducationTaxes.php">Learn about the Tax Advantages of Home Ownership</a></li>
		<li><a
    	href="../MortgageApplication/LoanAppShort.php">Submit A Loan Application</a></li>
	</ul>

<?php include('../include/bottom.php'); ?>

</body>
</html>
