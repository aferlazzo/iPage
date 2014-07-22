<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<html>
<head>
<title>Credit Secrets - Lightning Mortgage</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta name="copyright" content="Copyright 2006, Anthony Ferlazzo, Lightning Mortgage">
<meta name="rating" content="General">
<meta name="robots" content="Index, ALL">
<meta name="description" content="mortgage information by email, mortgage secrets by email. ">
<meta name="keywords"
content="mortgage secrets, mortgage insider secrets, mortgage email, mortgage rates, loan,
home loans, home financing, home equity loans, refinance, credit,
125% home equity loans, credit report, mortgage, home mortgage, mortgage refinancing, mortgage loan, mortgage broker,
equity loan, mortgage financing, home financing, home equity">
<link rel="stylesheet" href="../css/AnswersStyles.css" type="text/css">
<link rel="stylesheet" href="../css/Tabs.css" type="text/css">

<script language="JavaScript" src="../js/Common.js"  type="text/javascript"></script>
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

	var objName = document.Main;


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
<style type="text/css">
ol li{ padding-bottom:4px;margin:0 6em 0 4em; }
ol p{ text-align:justified; }
</style>
</head>

<body onload="window.document.Main.Full_Name.focus();">

<?php include('../include/top.php'); ?>
<div id="Heading" style="width:110%">
<div class="Title"><h1 id="Small">Money<br />Saving</h1></div>
<div class="Title">
<div id="Big"><h1>Credit Secrets</h1></div>
<div id="BigShadow"><h1>Credit Secrets</h1></div></div>
</div><br style="clear:left;">

	<form name="Main" onsubmit="return(Validate());"
	action="http://www.lightning-mortgage.com/pr/optin-test.php" method="post">

	<table border="0" cellpadding="4" cellspacing="0" width="720">
		<tr>
			<td width="253">
					<input type="hidden" name="arid" value="143">
					<input type="hidden" name="redirect"
					value="http://www.lightning-mortgage.com/Answers/MortgageInsiderSecretsSuccess.php">
					<p style="text-align: right"><label
					for="Full_Name">Your First Name</label></p>
				</td>
				<td width="439">
					<p style="text-align: left"><input
					type="Text" name="Full_Name" id="Full_Name"
					maxlength="50" size="30"
					onfocus="this.style.border='2px solid #9933CC'"
					onblur="this.style.border='2px solid silver'"></p>
				</td>
			</tr>
			<tr>
				<td width="253">
					<p style="text-align: right"><label
					for="Email_Address">Email</label></p>
				</td>
				<td width="439">
					<p style="text-align: left"><input
					type="Text" name="Email_Address"
					id="Email_Address" maxlength="50" size="30"
					onfocus="this.style.border='2px solid #9933CC'"
					onblur="this.style.border='2px solid silver'"></p>
				</td>
			</tr>
			<tr>
				<td width="253" height="27">&nbsp;</td>
				<td style="text-align: left" class="main"
				width="439" height="27">
				<input style="width:200px;font-size:medium;" type="Submit" class="Submit" value="Subscribe Now!"
				onMouseover="this.className='MouseOver'" onMouseout="this.className='Submit'">

				</td>
			</tr>
	</table>
	</form>


<?php include("../include/bottom.php"); ?>

</body>
</html>
