<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<html>
<head>
<title>Piggyback Mortgages</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta http-equiv="Content-Language" content="en-us">
<meta name="copyright" content="Copyright 2006, Anthony Ferlazzo, Lightning Mortgage">
<meta name="rating" content="General">
<meta name="robots" content="Index, ALL">
<meta name="description" content="Piggyback mortgage options with Lightning Mortgage">
<meta name="keywords"
content="Piggyback Mortgage Options, piggyback loan calculator, no down payment mortgage, zero down payment mortgage, 100% financing mortgage, blended interest rate calculator">
<base target="_self">
<link rel="stylesheet" href="../css/LoanTypesStyles.css" type="text/css">
<link rel="stylesheet" href="../css/Tabs.css" type="text/css">
<script src="../js/Letter.js" type="text/javascript"></SCRIPT>
<script src="http://www.google.com/coop/cse/brand?form=cse-search-box&lang=en" type="text/javascript"></script>

<script language="JavaScript" type="text/javascript">
<!--
function clearForm(form)
{
		form.interest1.value = "";
		form.interest2.value = "";
		form.Ratio1.value = "";
		form.Ratio2.value = "";
}

function computeField(input)
{
		if (input.value != null && input.value.length != 0)
			input.value = "" + eval(input.value);
		computeForm(input.form);
}

function computeForm(form)
{

	if ((form.interest1.value == null || form.interest1.value.length == 0) ||
		(form.interest2.value == null || form.interest2.value.length == 0) ||
		(form.Ratio1.value == null || form.Ratio1.value.length == 0) ||
		(form.Ratio2.value == null || form.Ratio2.value.length == 0))
	{
		return(false);
	}

	if (!checkNumber(form.interest1, .001, 99, "Interest1") ||
		!checkNumber(form.interest2, .001, 99, "Interest2") ||
		!checkNumber(form.Ratio1, 0, 100, "Ratio1") ||
		!checkNumber(form.Ratio2, 0, 100, "Ratio2"))
	{
		return(false);
	}

	var i1 = form.interest1.value;
	var i2 = form.interest2.value;
	var r1 = form.Ratio1.value;
	var r2 = form.Ratio2.value;

	var q1 = i1 * r1; //alert(q1);
	var q2 = i2 * r2; //alert(q2);
	form.Blended.value = (q1+q2)/100;
	return(true);
}
function checkNumber(input, min, max, msg)
{

	msg = msg + " field has invalid data: " + input.value;

	var str = input.value;
	for (var i = 0; i < str.length; i++)
	{
			var ch = str.substring(i, i + 1)
			if ((ch < "0" || "9" < ch) && ch != '.')
			{
				alert(msg);
				return false;
			}
	}
	var num = 0 + str
	if (num < min || max < num)
	{
			alert(msg + " not in range [" + min + ".." + max + "]");
			return false;
	}
	input.value = str;
	return true;
}
// Round a field two (2) decimals
function round(number)
{
  return Math.round(number*Math.pow(10,2))/Math.pow(10,2);
}

function trim(str)
{
	 return str.replace(/^\s+/g, '').replace(/\s+$/g, '');
}
//-->
</SCRIPT>
<style type="text/css">
input{
text-align:right;
}
input.Submit{
margin:2px 0;
color:#ffffff;
font-size:small;
background:#c60;
font-family :Verdana,Geneva,Arial,Helvetica,sans-serif;
}
</style>
</head>
<body>

<?php include('../include/top.php'); ?>
<div id="Heading" style="width:95%;">
<div class="Title"><h1 id="Small">Ride 'em<br />Cowboy!</h1></div>
<div class="Title">
<div id="Big"><h1>Piggyback Mortgages</h1></div>
<div id="BigShadow"><h1>Piggyback Mortgages</h1></div></div>
</div>
<div class="QuickHits" style="width:136px;">
<ul style="font-size:x-small;margin-bottom:0;">
	<li style="padding-bottom:1em;"><a
	href="http://www.lightning-mortgage.com/InterestRates/EducationTaxes.php">How much can you afford?</a></li>
	<li style="padding-bottom:1em;"><a href="#" title="opens a new window"
	onclick="if (window.secondwindow) window.secondwindow.close();secondwindow=open('http://www.lightning-mortgage.com/Administrative/PaymentCalculator.php',
	'pcalculator','height=360,width=280,top=0,left=0,alwaysRaised=yes,resizable=yes,scrollbars=yes,menubar=no,titlebar=yes,toolbar=no, scroll=yes');">
	Monthly Payment Calculator</a><img src="../images/NewWindow.gif" ALT=""></li>
	<li style="padding-bottom:1em;"><a href="#" title="opens a new window"
	onclick="if (window.thirdwindow) window.thirdwindow.close();thirdwindow=open('http://www.lightning-mortgage.com/Administrative/MinimumSalaryCalculator.php',
	'scalculator','height=600,width=300,top=0,left=0,alwaysRaised=yes,resizable=yes,scrollbars=yes,menubar=no,titlebar=yes,toolbar=no, scroll=yes');">
	Minimum Salary Calculator</a><img src="../images/NewWindow.gif" ALT=""></li>
	<li style="padding-bottom:1em;"><a href="#" title="opens a new window"
	onclick="if (window.fourthwindow) window.fourthwindow.close();fouthwindow=open('http://www.lightning-mortgage.com/Administrative/BlendedRateCalculator.php',
	'scalculator','height=600,width=370,top=0,left=0,alwaysRaised=yes,resizable=yes,scrollbars=yes,menubar=no,titlebar=yes,toolbar=no, scroll=yes');">
	Blended Interest Rate Calculator</a><img src="../images/NewWindow.gif" ALT=""></li>
</ul>
</div>
	<p>Looking for a way to break out of the rental stable but
	can't save enough for a big down payment? Let me tell you how we do it, partner!
	Big down payments aren't
	always necessary. Rather than going with a single, 100% LTV mortgage,
	which most often will require PMI, savvy mortgage brokers like Lightning
	Mortgage will recommend a piggyback mortgage.</p>

	<p>Piggyback loans are constructed by dividing the loan amount into two mortgages.
	The first loan, the bigger mortgage, is usually no more than 80% of the home's value (or purchase price).
	Since it is no more than 80%, <a href='../Answers/PMIAnswers.php'>PMI</a> is avoided.</p>

	<p>Since these loans represent a greater risk to the
	lender, a borrower is typically required to have better credit scores than if a down payment
	was made. The second loan will always have a higher interest rate than the first loan. Use this
	<a href="#" title="opens a new window"
	onclick="if (window.fifthwindow) window.fifthwindow.close();fifthwindow=open('http://www.lightning-mortgage.com/Administrative/BlendedRateCalculator.php',
	'scalculator','height=600,width=370,top=0,left=0,alwaysRaised=yes,resizable=yes,scrollbars=yes,menubar=no,titlebar=yes,toolbar=no, scroll=yes');">
	Blended Interest Rate Calculator</a><img src="../images/NewWindow.gif" ALT=""> to see
	<span class="Highlight">the combined interest rate really isn't as bad as you may think.</span></p>

	<p>The first mortgage may be a 15- or 30-year
	fixed rate, an ARM, or a 30/15 balloon. The second mortgage is typically a 15 year
	fixed rate, 30/15 balloon or a home equity line of credit (<a
	class="LoanTypes"
	href="http://www.lightning-mortgage.com/LoanTypes/HELOC.php">HELOC</a>)
	product. Both first and second loans must be the same<br />
	<a href="http://www.lightning-mortgage.com/LoanTypes/IncomeDocVariations.php">income
	documentation type</a>.</p>
	<ul>
		<li>A piggyback mortgage may be
			just the ticket if you want
			to avoid paying <a
			class="LoanTypes"

			href="http://www.lightning-mortgage.com/Answers/PMIAnswers.php">PMI</a>.</li>
		<li>Loan size can be <a

			href="../Answers/GlossaryIL.php#Jumbo">jumbo</a></li>
		<li>Maximum combined financing to
			<a

			href="http://www.lightning-mortgage.com/LoanTypes/ZeroDown.php">100%</a>
			for purchases</li>
		<li>2nd homes with only 5% down
			(95% LTV refinance)</li>
		<li>Investment properties with
			only 10% down (95% LTV
			refinance)</li>
	</ul>
	<p>Alternatively, you may be interested in paying your
	loan off early, but as painlessly as possible. If you want to ease into
	homeownership check into our temporary <a
	href="http://www.lightning-mortgage.com/LoanTypes/Buydown.php">buydown</a>
	or <a
	href="http://www.lightning-mortgage.com/LoanTypes/ARM.php">ARM</a> options.&nbsp;</p><hr>

	<p>There's no magic to figuring out your combined interest rate when you have a piggyback
	mortgage as long as the term of both loans are the same (e.g. they are both 30 year mortgages). Let's say you
	have an 80% first loan at 7% and a second mortgage at 9.5% for 20%. Simply multiply 80 * .07 and 20 * .095,
	then add their products together. That's 5.6 + 1.9 or a combined interest rate of 7.5%.<br /><br />
	Simple, huh? Well, for speed and convenience, you can also use this calculator:</p>
	<div style="text-align:center;">
	<div style="width:60%;margin:0 auto;">
	<form name="Blend" method="post" action="">
	<table cellspacing='0' cellpadding='4' style="width:100%;border:4px solid #c60;">
		<tr><td colspan="4" style="text-align:center;font-size:medium;font-weight:bold;"><br />Blended Interest Rate Calculator<br /><br />
		<span style="font-size:x-small;font-weight:normal;">Note: Both loans must be amortized for the same term<br /><br />
		(Won't work if 1 loan is 30 years and another is 15 years)<br /><br />
		The sum of both loans (the amount borrowed)<span class="Highlight"> must equal </span>100%</span><br />&nbsp;</td></tr>

		<tr style="height:4em;">
			<td style="text-align:right;background-color:#c60;color:#fff;width:25%;">
				First Loan
			</td>
			<td style="text-align:left;background-color:#c60;color:#fff;width:24%;">
				<input onchange="document.Blend.Ratio2.value=100 - document.Blend.Ratio1.value;" style="width:3em;" size="6" name="Ratio1" value="80"> %
			</td>
			<td style="text-align:right;background-color:#fa8c00;width:25%;">
				Second Loan
			</td>
			<td style="text-align:left;background-color:#fa8c00;width:24%;">
				<input onchange="document.Blend.Ratio1.value=100 - document.Blend.Ratio2.value;" style="width:3em;" size="6" name="Ratio2" value="20"> %
			</td>
		</tr>
		<tr style="height:4em;">
			<td style="text-align:right;background-color:#c60;color:#fff;width:25%;">
				Interest Rate
			</td>
			<td style="text-align:left;background-color:#c60;color:#fff;width:24%;">
				<input style="width:3em;" size="6" name="interest1" value="7.5"> %
			</td>
			<td style="text-align:right;background-color:#fa8c00;width:25%;">
				Interest Rate
			</td>
			<td style="text-align:left;background-color:#fa8c00;width:24%;">
				<input style="width:3em;" size="6" name="interest2" value="7.5"> %
			</td>
		</tr>
		<tr>
			<td colspan="2" align="right">
				Blended Rate
			</td>
			<td colspan="2" style="text-align:left;height:2.5em;">
				<input readonly style="width:3em;" size="6" name="Blended"> %</td>
		</tr>
		<tr>
			<td colspan="6" align="center">
				<br /><input onclick="clearForm(this.form)" type="reset" class="Button"
				onMouseover="this.className='MouseOver'" onMouseout="this.className='Button'"
				onfocus="if(this.blur) this.blur();"
				style="text-align:center;width:65px;" value="Reset">&nbsp;&nbsp;
				<input onclick="computeForm(this.form)" type="button" class="Button"
				onMouseover="this.className='MouseOver'" onMouseout="this.className='Button'"
				onfocus="if(this.blur) this.blur();"
				style="text-align:center;width:90px;" value="Calculate"><br />&nbsp;
			</td>
		</tr>
	</table>
	</form></div>
<blockquote style="text-align:left;font-size:xx-small;">The Legal Stuff, From Our Lawyer: Information provided by these calculators is for illustrative purposes only. The information entered may
vary from your actual loan, mortgage, investment, or savings results. Interest rates are hypothetical and are not
meant to represent any specific investment. Rates of return will vary over time, particularly for long-term investments.
The calculated results are not guaranteed to be accurate and are in no way endorsed, offered or guaranteed by Lightning Mortgage.</blockquote>
	</div>
	<hr>
<br /><div style='width:120px;'>
<b class="top"><b class="b1"></b><b class="b2"></b><b class="b3"></b><b class="b4"></b></b>
<h2 style='width:118px;'>Next Steps</h2>
<b class="bottom"><b class="b4"></b><b class="b3"></b><b class="b2"></b><b class="b1"></b></b></div>
	<ul>
		<li><a
		href="../Answers/HomeBuyingMistakes.php">Find Out About the 8 Deadly Home Buying Mistakes</a></li>
		<li><a
		href="LoanTypeDescriptions.php">Explore other Loan Types</a></li>
		<li><a
		href="../CreditScores.php">Learn about Credit Scores</a></li>
		<li><a
		href="../Answers/PreAnswers.php">Determine if you want to be pre-qualified or pre-approved</a></li>
		<li><a
		href="../InterestRates/EducationTaxes.php">Learn about the Tax Advantages of Home Ownership</a></li>
		<li><a
    	href="../MortgageApplication/LoanAppShort.php">Submit a Loan Application</a></li>
	</ul>
<?php include("../include/bottom.php"); ?>

</body>
</html>
