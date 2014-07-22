<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>BalboaMortgage.com</title>
	<style>  
  <!--

input, select {  font-size: 8pt; font-face: Arial;}
   
   //
  -->
  </style>

</head>
<link rel="STYLESHEET" type="text/css" href="balboa.css">
<body bgcolor="#FFFFFF">
<center><table width="780" border="0" cellspacing="0" cellpadding="0"><tr><td valign="top" align="center"><a href="index.phpl"><img src="images/sys/top-left-logo.gif" width="128" height="213" alt="" border="0"></a>
<br><br>
<br>
<a href="begin.phpl">Apply Now</a><br>
<br>
<a href="calc.consolidate.phpl">Consolidation Calculator</a> <br>
<br><a href="calc.cash.phpl">Cash-Out Calculator</a> 
<br>
<br><a href="calc.interest.phpl">Interest-Only Calculator</a><br>
<br><a href="calc.mortgage.phpl">Refinance Calculator</a>


</td><td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td align="right"><span style="font-size: 8pt; color: silver; font-family: Verdana;"><a href="/mortgage_calculator.phpl">Mortgage Calculator</a> &nbsp; <a href="/Legal.phpl">Legal</a> &nbsp; <a href="/about.phpl">About Us</a> &nbsp; <a href="/contact.phpl">Contact Us</a></span>
<br><br>
<center><img border="0" src="images/sys/NO-YES.gif" width="510" height="32" alt="mortgage calculator" alt="bad credit loans, mortgage calculator, debt consolidation, home equity"></center>







</td></tr><tr><td valign="top">
<map name="top-links">
<area alt="" coords="34, 0, 116, 20" href="begin.phpl" shape="rect">
<area alt="" coords="121, 0, 219, 20" href="do.phpl" shape="rect">
<area alt="" coords="223, 0, 325, 20" href="101.phpl" shape="rect">
<area alt="" coords="329, 0, 419, 20" href="calculators.phpl" shape="rect">
<area alt="" coords="423, 0, 524, 20" href="login.phpl" shape="rect">
</map>
<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td><img src="images/sys/orange-corner-1.gif" width="13" height="11" alt="" border="0"></td><td bgcolor="#E8A646" width="100%"><img src="images/sys/dot_clear.gif" width="1" height="11" alt="" border="0"></td><td><img src="images/sys/orange-corner-2.gif" width="13" height="11" alt="" border="0"></td><td><img src="images/sys/dot_clear.gif" width="5" height="1" alt="" border="0"></td></tr><tr><td colspan="3" bgcolor="#E8A646"><img src="images/sys/top-link-calculators2.gif" width="524" height="21" alt="" border="0" usemap="#top-links"></td><td><img src="images/sys/dot_clear.gif" width="5" height="1" alt="" border="0"></td></tr><tr><td colspan="4">
<table width="100%" border="0" cellspacing="0" cellpadding="5" align="center"><tr><td bgcolor="#E8A646"><img src="images/sys/dot_clear.gif" width="5" height="1" alt="" border="0"></td><td bgcolor="#0091BA"><img src="images/sys/dot_clear.gif" width="5" height="1" alt="" border="0"></td><td bgcolor="#0091BA" width="100%">
<img src="images/sys/dot_clear.gif" width="5" height="1" alt="" border="0"></td></tr><tr><td bgcolor="#E8A646"><img src="images/sys/dot_clear.gif" width="5" height="1" alt="" border="0"></td><td bgcolor="#0091BA"><img src="images/sys/dot_clear.gif" width="5" height="1" alt="" border="0"></td><td bgcolor="#FFFFFF" width="100%">



<span style="font-size: 8pt; color: black; font-family: Verdana;">

<span style="font-family: Arial; font-size: 12pt; color: #00376A; font-weight: bold;">Calculators</span>
<br>

<table border="0" cellspacing="0" cellpadding="20"><tr><td>
<script>
//Debt Consolidation Calculator V3
//2003 Daniel C. Peterson ALL RIGHTS RESERVED
//Created: 10/09/2003
//Last Modified: 10/09/2003
//This script may not be copied, edited, distributed or reproduced
//without express written permission from
//Daniel C. Peterson of Web Winder Website Services
//For commercial use rates, contact:
//Dan Peterson:
//Web Winder Website Services
//P.O. Box 11
//Bemidji, MN  56619
//dan@webwinder.com
//http://www.webwinder.com
//Commercial User Licence #:887-181-111-178
//Commercial Licence Date:2003-10-07
//*******************************************



function stripNum(num) {

var iPercent
var iDollar
var iSpace
var iComma
var numLength = num.length

//lalalla Line #114

if(numLength > 0) {

   num=num.toString();

   iPercent = num.indexOf("%");
   if(iPercent >= 0) {
      num=num.substring(0,iPercent) + "" + num.substring(iPercent + 1,numLength);
      numLength=num.length;
      }
   iDollar = num.indexOf("$");
   if(iDollar >= 0) {
      num=num.substring(0,iDollar) + "" + num.substring(iDollar + 1,numLength);
      numLength=num.length;
      }
   iSpace = num.indexOf(" ");
   if(iSpace >= 0) {
      num=num.substring(0,iSpace) + "" + num.substring(iSpace + 1,numLength);
      numLength=num.length;
      }
   iComma = num.indexOf(",");
   if(iComma >= 0) {
      while(iComma >=1) {
         num=num.substring(0,iComma) + "" + num.substring(iComma + 1,numLength);
         numLength=num.length;
         iComma = num.indexOf(",");
      }
      }

      num = eval(num);


} else {

num = 0;

}

return num;

}




function computeMonthlyPayment(prin, numPmts, intRate) {

var pmtAmt = 0;

if(intRate == 0) {
   pmtAmt = prin / numPmts;
} else {
   
   if (intRate >= 1.0) {
     intRate = intRate / 100.0;
   }
   intRate /= 12;

   var pow = 1;
   for (var j = 0; j < numPmts; j++)
      pow = pow * (1 + intRate);

   pmtAmt = (prin * pow * intRate) / (pow - 1);

}

return pmtAmt;

}




function computeFixedInterestCost(principal, intRate, pmtAmt) { 

   var i = eval(intRate);
   if(i >= 1) {
   i /= 100;
   }
   i /= 12;

   var prin = eval(principal);
   var intPort = 0;
   var accumInt = 0;
   var prinPort = 0;
   var pmtCount = 0;
   var testForLast = 0;


   //CYCLES THROUGH EACH PAYMENT OF GIVEN DEBT
   while(prin > 0) {

      testForLast = (prin * (1 + i));

      if(pmtAmt < testForLast) {
         intPort = prin * i;
         accumInt = eval(accumInt) + eval(intPort);
         prinPort = eval(pmtAmt) - eval(intPort);
         prin = eval(prin) - eval(prinPort);
      } else {
      //DETERMINE FINAL PAYMENT AMOUNT
      intPort = prin * i;
      accumInt = eval(accumInt) + eval(intPort);
      prinPort = prin;
      prin = 0;
      }

      pmtCount = eval(pmtCount) + eval(1);

      if(pmtCount > 1000 || accumInt > 1000000) {
         prin = 0;
      }

   }

return accumInt;

}




function formatNumberDec(num, places, comma) {

var isNeg=0;

    if(num < 0) {
       num=num*-1;
       isNeg=1;
    }

    var myDecFact = 1;
    var myPlaces = 0;
    var myZeros = "";
    while(myPlaces < places) {
       myDecFact = myDecFact * 10;
       myPlaces = eval(myPlaces) + eval(1);
       myZeros = myZeros + "0";
    }
    
	onum=Math.round(num*myDecFact)/myDecFact;
		
	integer=Math.floor(onum);

	if (Math.ceil(onum) == integer) {
		decimal=myZeros;
	} else{
		decimal=Math.round((onum-integer)* myDecFact)
	}
	decimal=decimal.toString();
	if (decimal.length<places) {
        fillZeroes = places - decimal.length;
	   for (z=0;z<fillZeroes;z++) {
        decimal="0"+decimal;
        }
     }

   if(places > 0) {
      decimal = "." + decimal;
   }

   if(comma == 1) {
	integer=integer.toString();
	var tmpnum="";
	var tmpinteger="";
	var y=0;

	for (x=integer.length;x>0;x--) {
		tmpnum=tmpnum+integer.charAt(x-1);
		y=y+1;
		if (y==3 & x>1) {
			tmpnum=tmpnum+",";
			y=0;
		}
	}

	for (x=tmpnum.length;x>0;x--) {
		tmpinteger=tmpinteger+tmpnum.charAt(x-1);
	}


	finNum=tmpinteger+""+decimal;
   } else {
      finNum=integer+""+decimal;
   }

    if(isNeg == 1) {
       finNum = "-" + finNum;
    }

	return finNum;
}




function computeNPR(principal, intRate, pmtAmt) {

   var i = eval(intRate);
   if(i >= 1) {
   i /= 100;
   }
   i /= 12;

   var prin = eval(principal);
   var intPort = 0;
   var accumInt = 0;
   var prinPort = 0;
   var pmtCount = 0;
   var testForLast = 0;


   //CYCLES THROUGH EACH PAYMENT OF GIVEN DEBT
   while(prin > 0) {

      testForLast = (prin * (1 + i));

      if(pmtAmt < testForLast) {
         intPort = prin * i;
         accumInt = eval(accumInt) + eval(intPort);
         prinPort = eval(pmtAmt) - eval(intPort);
         prin = eval(prin) - eval(prinPort);
      } else {
      //DETERMINE FINAL PAYMENT AMOUNT
      intPort = prin * i;
      accumInt = eval(accumInt) + eval(intPort);
      prinPort = prin;
      prin = 0;
      }

      pmtCount = eval(pmtCount) + eval(1);

      if(pmtCount > 1000 || accumInt > 1000000) {
         prin = 0;
      }

   }

return pmtCount;

}


function computeForm(form) {

    var VtaxRate = stripNum(form.incomeTax.value);
    if(VtaxRate >= 1) {
       VtaxRate /= 100;
    }

    var accumTotBal = 0;
    var accumRate = 0;
    var accumTotPmt = 0;
    var accumCount = 0;
    var accumTotFees = 0;

    var VloanType = 0;
    var Vprincipal = 0;
    var Vpayment = 0;
    var Vrate = 0;
    var VAnnFees = 0;
    var VbeforeTaxInt = 0;
    var VbeforeTaxInt = 0;
    var accumBeforeTaxInt = 0;
    var accumAfterTaxInt = 0;

    var maxConsumerRate = 0;

    var i = 0;

    while(i < 10) {

       i += 1;

       eval("Vprincipal = stripNum(document.debtForm.prin" + i + ".value);");
       eval("Vpayment = stripNum(document.debtForm.pmt" + i + ".value);");
       eval("Vrate = stripNum(document.debtForm.intRate" + i + ".value);");
       eval("VannFees = stripNum(document.debtForm.annFees" + i + ".value);");

       if(Vprincipal > 0 && Vrate > 0) {

          eval("VloanType = document.debtForm.debt" + i + ".options[document.debtForm.debt"+ i + ".selectedIndex].value;");

          if(Vrate >= 1) {
             Vrate /= 100;
          }
          if(maxConsumerRate < Vrate) {
             maxConsumerRate = Vrate;
          }
          Vrate /= 12;

          VbeforeTaxInt = Vprincipal * Vrate;
          if(VloanType == 1) {
             VafterTaxInt = VbeforeTaxInt * (1 - VtaxRate);
          } else {
             VafterTaxInt = VbeforeTaxInt;
          }

          accumCount = eval(accumCount) + eval(1);
          accumRate = eval(accumRate) + eval(Vrate);
          accumTotBal = eval(accumTotBal) + eval(Vprincipal);
          accumTotPmt = eval(accumTotPmt) + eval(Vpayment);
          accumTotFees = eval(accumTotFees) + eval(VannFees);
          accumBeforeTaxInt = eval(accumBeforeTaxInt) + eval(VbeforeTaxInt);
          accumAfterTaxInt = eval(accumAfterTaxInt) + eval(VafterTaxInt);

       }



    }

if(accumTotBal <= 0) {
   alert("Please enter at least one debt before computing the form.");
   form.prin1.focus();
} else {

    var VcashOut = stripNum(form.cashOut.value);
    if(maxConsumerRate >= 1) {
       maxConsumerRate /= 100;
    }
    maxConsumerRate /= 12;

    VbeforeTaxInt = VcashOut * maxConsumerRate;
    VafterTaxInt = VbeforeTaxInt;
    accumBeforeTaxInt = eval(accumBeforeTaxInt) + eval(VbeforeTaxInt);
    accumAfterTaxInt = eval(accumAfterTaxInt) + eval(VafterTaxInt);
    

//TOTALS

var VtotCur = eval(accumTotBal) + eval(VcashOut);
form.totCur.value = "$" + formatNumberDec(VtotCur,2,1);

var VcloseCost = stripNum(form.closeCost.value);
var VtotProp = eval(VtotCur) + eval(VcloseCost); 
form.totProp.value =  "$" + formatNumberDec(VtotProp,2,1);

var VeffRateCur = accumBeforeTaxInt / VtotCur * 12 * 100;
form.effRateCur.value = formatNumberDec(VeffRateCur,2,0) + "%";

var VnewRate = stripNum(form.newRate.value);
var VeffRateProp = VnewRate;
form.effRateProp.value = formatNumberDec(VeffRateProp,2,0) + "%";

var VeffRateCurTax = accumAfterTaxInt / VtotCur * 12 * 100;
form.effRateCurTax.value = formatNumberDec(VeffRateCurTax,2,0) + "%";

var VeffRatePropTax = VeffRateProp * (1 - VtaxRate);
form.effRatePropTax.value = formatNumberDec(VeffRatePropTax,2,0) + "%";

var VtotPmtCur = accumTotPmt;
form.totPmtCur.value = "$" + formatNumberDec(VtotPmtCur,2,1);

var VnewTerm = form.newTerm.options[form.newTerm.selectedIndex].value;
var VtotPmtProp = computeMonthlyPayment(VtotProp, VnewTerm, VnewRate)
form.totPmtProp.value = "$" + formatNumberDec(VtotPmtProp,2,1);

if(VtotPmtCur < VtotPmtProp) { //If new payment less than old one

   form.moSave.value = "N/A";
   form.annSave.value = "N/A";
   form.fiveYrSave.value = "N/A";
   form.ultYearsSaved.value = "N/A";
   form.ultTotYears.value = "N/A";
   form.ultIntSaved.value = "N/A";

} else { //If new payment greater than old one

   var VmoSave = VtotPmtCur - VtotPmtProp;
   form.moSave.value= "$" + formatNumberDec(VmoSave,2,1);

   var VannSave = VmoSave * 12;
   form.annSave.value = "$" + formatNumberDec(VannSave,2,1);

   var VfiveYrSave = VannSave * 5;
   form.fiveYrSave.value = "$" + formatNumberDec(VfiveYrSave,2,1);

   //ULTIMATE SAVINGS REPORT
   var oldNumPmtsLeft = computeNPR(VtotProp, VnewRate, VtotPmtCur);
   var oldYearsLeft = oldNumPmtsLeft / 12;
   form.ultTotYears.value = formatNumberDec(oldYearsLeft,1,0);

   var newTotYears = VnewTerm / 12;
   var VultYearsSaved = newTotYears - oldYearsLeft;
   form.ultYearsSaved.value = formatNumberDec(VultYearsSaved,1,0);

   var oldLoanInterest = computeFixedInterestCost(VtotProp, VnewRate, VtotPmtCur)
   var newLoanInterest = computeFixedInterestCost(VtotProp, VnewRate, VtotPmtProp)
   var VultIntSaved = newLoanInterest - oldLoanInterest;
   form.ultIntSaved.value = "$" + formatNumberDec(VultIntSaved,2,1);
}

}
}

function clearResults(form) {

form.totCur.value = "";
form.totProp.value = "";
form.effRateCur.value = "";
form.effRateProp.value = "";
form.effRateCurTax.value = "";
form.effRatePropTax.value = "";
form.totPmtCur.value = "";
form.totPmtProp.value = "";
form.moSave.value = "";
form.annSave.value = "";
form.fiveYrSave.value = "";
form.ultYearsSaved.value = "";
form.ultTotYears.value = "";
form.ultIntSaved.value = "";

}</script>
<FORM name="debtForm" method="POST">

<table width="450" border="1" cellspacing="0" bordercolor="silver" cellpadding="2" bgcolor="#ECFBFF">
<tr>
<td colspan='5' align='center'>
<font size='4' color='#000000'><b> Debt Consolidation Calculator</b></font>
</td>
</tr>
<tr>
<td colspan='5'>

<P>

</font> 
</td>
</tr>

<TR>
<TD align="center"><b>Credit<BR>Type</b></font></TD>
<TD align="center"><b>Balance</b></font></TD>
<TD align="center"><b>Payment</b></font></TD>
<TD align="center"><b>Interest<BR>Rate</b></font></TD>
<TD align="center"><b>Annual<BR>Fees</b></font></TD>
</TR>


<tr>
<td align="center">
<select name="debt1" onChange="clearResults(this.form)">
<option value="1" selected>Mortgage</option>
<option value="0">Credit Card</option>
<option value="0">Auto Loan</option>
<option value="0">Student Loan</option>
<option value="0">Other</option>
</select></td>
<td align="center"><input type="text" name="prin1" size="12" value="" onKeyUp="clearResults(this.form)"></td>
<td align="center"><input type="text" name="pmt1" size="12" value="" onKeyUp="clearResults(this.form)"></td>
<td align="center"><input type="text" name="intRate1" size="9" value="" onKeyUp="clearResults(this.form)"></td>
<td align="center"><input type="text" name="annFees1" size="12" value="" onKeyUp="clearResults(this.form)"></td>
</tr>

<tr>
<td align="center">
<select name="debt2" onChange="clearResults(this.form)">
<option value="1" selected>Mortgage</option>
<option value="0">Credit Card</option>
<option value="0">Auto Loan</option>
<option value="0">Student Loan</option>
<option value="0">Other</option>
</select></td>
<td align="center"><input type="text" name="prin2" size="12" onKeyUp="clearResults(this.form)"></td>
<td align="center"><input type="text" name="pmt2" size="12" onKeyUp="clearResults(this.form)"></td>
<td align="center"><input type="text" name="intRate2" size="9" onKeyUp="clearResults(this.form)"></td>
<td align="center"><input type="text" name="annFees2" size="12" onKeyUp="clearResults(this.form)"></td>
</tr>

<tr>
<td align="center">
<select name="debt3" onChange="clearResults(this.form)">
<option value="1">Mortgage</option>
<option value="0" selected>Credit Card</option>
<option value="0">Auto Loan</option>
<option value="0">Student Loan</option>
<option value="0">Other</option>
</select></td>
<td align="center"><input type="text" name="prin3" size="12" value="" onKeyUp="clearResults(this.form)"></td>
<td align="center"><input type="text" name="pmt3" size="12" value="" onKeyUp="clearResults(this.form)"></td>
<td align="center"><input type="text" name="intRate3" size="9" value="" onKeyUp="clearResults(this.form)"></td>
<td align="center"><input type="text" name="annFees3" size="12" value="" onKeyUp="clearResults(this.form)"></td>
</tr>

<tr>
<td align="center">
<select name="debt4" onChange="clearResults(this.form)">
<option value="1">Mortgage</option>
<option value="0" selected>Credit Card</option>
<option value="0">Auto Loan</option>
<option value="0">Student Loan</option>
<option value="0">Other</option>
</select></td>
<td align="center"><input type="text" name="prin4" size="12" value="" onKeyUp="clearResults(this.form)"></td>
<td align="center"><input type="text" name="pmt4" size="12" value="" onKeyUp="clearResults(this.form)"></td>
<td align="center"><input type="text" name="intRate4" size="9" value="" onKeyUp="clearResults(this.form)"></td>
<td align="center"><input type="text" name="annFees4" size="12" onKeyUp="clearResults(this.form)"></td>
</tr>

<tr>
<td align="center">
<select name="debt5" onChange="clearResults(this.form)">
<option value="1">Mortgage</option>
<option value="0" selected>Credit Card</option>
<option value="0">Auto Loan</option>
<option value="0">Student Loan</option>
<option value="0">Other</option>
</select></td>
<td align="center"><input type="text" name="prin5" size="12" value="" onKeyUp="clearResults(this.form)"></td>
<td align="center"><input type="text" name="pmt5" size="12" value="" onKeyUp="clearResults(this.form)"></td>
<td align="center"><input type="text" name="intRate5" size="9" value="" onKeyUp="clearResults(this.form)"></td>
<td align="center"><input type="text" name="annFees5" size="12" value="" onKeyUp="clearResults(this.form)"></td>
</tr>

<tr>
<td align="center">
<select name="debt6" onChange="clearResults(this.form)">
<option value="1">Mortgage</option>
<option value="0" selected>Credit Card</option>
<option value="0">Auto Loan</option>
<option value="0">Student Loan</option>
<option value="0">Other</option>
</select></td>
<td align="center"><input type="text" name="prin6" size="12" onKeyUp="clearResults(this.form)"></td>
<td align="center"><input type="text" name="pmt6" size="12" onKeyUp="clearResults(this.form)"></td>
<td align="center"><input type="text" name="intRate6" size="9" onKeyUp="clearResults(this.form)"></td>
<td align="center"><input type="text" name="annFees6" size="12" onKeyUp="clearResults(this.form)"></td>
</tr>

<tr>
<td align="center">
<select name="debt7" onChange="clearResults(this.form)">
<option value="1">Mortgage</option>
<option value="0" selected>Credit Card</option>
<option value="0">Auto Loan</option>
<option value="0">Student Loan</option>
<option value="0">Other</option>
</select></td>
<td align="center"><input type="text" name="prin7" size="12" value="" onKeyUpe="clearResults(this.form)"></td>
<td align="center"><input type="text" name="pmt7" size="12" value="" onKeyUp="clearResults(this.form)"></td>
<td align="center"><input type="text" name="intRate7" size="9" value="" onKeyUp="clearResults(this.form)"></td>
<td align="center"><input type="text" name="annFees7" size="12" value="" onKeyUp="clearResults(this.form)"></td>
</tr>

<tr>
<td align="center">
<select name="debt8">
<option value="1">Mortgage</option>
<option value="0" selected>Credit Card</option>
<option value="0">Auto Loan</option>
<option value="0">Student Loan</option>
<option value="0">Other</option>
</select></td>
<td align="center"><input type="text" name="prin8" size="12" onKeyUp="clearResults(this.form)"></td>
<td align="center"><input type="text" name="pmt8" size="12" onKeyUp="clearResults(this.form)"></td>
<td align="center"><input type="text" name="intRate8" size="9" onKeyUp="clearResults(this.form)"></td>
<td align="center"><input type="text" name="annFees8" size="12" onKeyUp="clearResults(this.form)"></td>
</tr>

<tr>
<td align="center">
<select name="debt9" onChange="clearResults(this.form)">
<option value="1">Mortgage</option>
<option value="0" selected>Credit Card</option>
<option value="0">Auto Loan</option>
<option value="0">Student Loan</option>
<option value="0">Other</option>
</select></td>
<td align="center"><input type="text" name="prin9" size="12" value="" onKeyUp="clearResults(this.form)"></td>
<td align="center"><input type="text" name="pmt9" size="12" value="" onKeyUp="clearResults(this.form)"></td>
<td align="center"><input type="text" name="intRate9" size="9" value="" onKeyUp="clearResults(this.form)"></td>
<td align="center"><input type="text" name="annFees9" size="12" value="" onKeyUp="clearResults(this.form)"></td>
</tr>

<tr>
<td align="center">
<select name="debt10" onChange="clearResults(this.form)">
<option value="1">Mortgage</option>
<option value="0" selected>Credit Card</option>
<option value="0">Auto Loan</option>
<option value="0">Student Loan</option>
<option value="0">Other</option>
</select></td>
<td align="center"><input type="text" name="prin10" size="12" onKeyUp="clearResults(this.form)"></td>
<td align="center"><input type="text" name="pmt10" size="12" onKeyUp="clearResults(this.form)"></td>
<td align="center"><input type="text" name="intRate10" size="9" onKeyUp="clearResults(this.form)"></td>
<td align="center"><input type="text" name="annFees10" size="12" onKeyUp="clearResults(this.form)"></td>
</tr>

<tr>
<td align="center"><b>Additional Cash?</b></font>
</td>
<td align="center"><INPUT TYPE="text" NAME="cashOut" VALUE="" SIZE=12 onKeyUp="clearResults(this.form)"></td>
<td align="left" colspan="3"> 
<select name="purpose" size="1">
<option>Purpose...</option>
<option>Pay personal IOU's</option>
<option>Improve home</option>
<option>Vacation</option>
<option>Support family</option>
<option>Self-employment business</option>
<option>Combination of uses</option>
</select></td>
</tr>

<TR>
<TD COLSPAN=5 align="center">
<b>New Loan Information</b></font>
</TD>
</TR>

<tr>
<td colspan='5'>

Enter data about your planned New Loan with us
(change any of the proposed numbers below).
</font> 
</td>
</tr>

<TR>
<TD COLSPAN=4><b>Porposed interest rate (%):</b></font></TD>
<TD align="center"><INPUT TYPE="text" NAME="newRate" VALUE="9" SIZE=12 onKeyUp="clearResults(this.form)"></TD>
</TR>

<TR>
<TD COLSPAN=4><b>Loan term:</b></font></TD>
<TD align="center"><SELECT NAME="newTerm" SIZE="1" onChange="clearResults(this.form)">
<OPTION VALUE="60">5 Years
<OPTION VALUE="120">10 Years
<OPTION VALUE="180">15 Years
<OPTION VALUE="240">20 Years
<OPTION VALUE="300">25 Years
<OPTION VALUE="360" selected>30 Years
</SELECT>
</TD>
</TR>

<TR>
<TD COLSPAN=4><b>Estimated closing costs ($):</b></font></TD>
<TD align="center"><INPUT TYPE="text" NAME="closeCost" VALUE="2300" SIZE=12 onKeyUp="clearResults(this.form)"></TD>
</TR>

<TR>
<TD COLSPAN=4><b>Federal & state tax rate (%):</b></font></TD>
<TD align="center"><INPUT TYPE="text" NAME="incomeTax" VALUE="36" SIZE=12 onKeyUp="clearResults(this.form)"></TD>
</TR>

<TR>
<TD COLSPAN=5><CENTER><INPUT TYPE="button" VALUE="Calculate New" ONCLICK="computeForm(this.form)"><INPUT TYPE="reset" VALUE="Reset"></CENTER></TD>
</TR>


<TR>
<TD COLSPAN=3><b>Results</b></font></TD>
<TD align="center"><b>Current</b></font></TD>
<TD align="center"><b>New Loan</b></font></TD>
</TR>


<TR>
<TD COLSPAN=3><b>Total debts:</b></font></TD>
<TD align="center"><INPUT TYPE="text" NAME="totCur" SIZE=12 ></TD>
<TD align="center"><INPUT TYPE="text" NAME="totProp" SIZE=12 ></TD>
</TR>

<TR>
<TD COLSPAN=3><b>Effective rate before taxes:</b></font></TD>
<TD align="center"><INPUT TYPE="text" NAME="effRateCur" SIZE=12 ></TD>
<TD align="center"><INPUT TYPE="text" NAME="effRateProp" SIZE=12 ></TD>
</TR>

<TR>
<TD COLSPAN=3><b>Effective rate after taxes:</b></font></TD>
<TD align="center"><INPUT TYPE="text" NAME="effRateCurTax" SIZE=12 ></TD>
<TD align="center"><INPUT TYPE="text" NAME="effRatePropTax" SIZE=12 ></TD>
</TR>

<TR>
<TD COLSPAN=3><b>Total monthly payment:</b></font></TD>
<TD align="center"><INPUT TYPE="text" NAME="totPmtCur" SIZE=12 ></TD>
<TD align="center"><INPUT TYPE="text" NAME="totPmtProp" SIZE=12 ></TD>
</TR>

<TR>
<TD COLSPAN=4><b>Monthly savings:</b></font></TD>
<TD align="center"><INPUT TYPE="text" NAME="moSave" SIZE=12 ></TD>
</TR>

<TR>
<TD COLSPAN=4><b>Annual savings:</b></font></TD>
<TD align="center"><INPUT TYPE="text" NAME="annSave" SIZE=12 ></TD>
</TR>

<TR>
<TD COLSPAN=4><b>Five year savings:</b></font></TD>
<TD align="center"><INPUT TYPE="text" NAME="fiveYrSave" SIZE=12 ></TD>
</TR>

<TR>
<TD COLSPAN=5><b>Ultimate Savings Report</b></font></TD>
</TR>

<tr>
<td colspan='5'>

What if you were to pay the same OLD payments instead of your NEW LOWER PAYMENTS... (which is your choice every month)... your monthly SAVINGS will reduce the loan principal each month, SHORTENING the loan itself... without ANY more costs than you used to pay.
</font> 
</td>
</tr>

<TR>
<TD COLSPAN=4><b>Total years SAVED if same OLD payments are made on NEW loan:</b></font></TD>
<TD align="center"><INPUT TYPE="text" NAME="ultYearsSaved" SIZE=12 ></TD>
</TR>

<TR>
<TD COLSPAN=4><b>Total years until "FREE & CLEAR" if savings are paid to principal:</b></font></TD>
<TD align="center"><INPUT TYPE="text" NAME="ultTotYears" SIZE=12 ></TD>
</TR>

<TR>
<TD COLSPAN=4><b>TOTAL INTEREST SAVED over life of loan if savings are applied to principal:</b></font></TD>
<TD align="center"><INPUT TYPE="text" NAME="ultIntSaved" SIZE=12 ></TD>
</TR>



</TABLE>


</FORM>

</td></tr></table>

</span>

</td></tr></table>
</td></tr></table></td></tr></table>
</td></tr></table></td></tr></table>

<table width="780" border="0" cellspacing="0" cellpadding="0"><tr><td align="center">
<span style="font-size: 8pt; color: silver; font-family: Verdana;">
<a href="index.phpl">Home</a>  |  <a href="begin.phpl">Begin Now</a>  |  <a href="do.phpl">What We Do</a>  |  <a href="101.phpl">Mortgage 101</a>  |  <a href="login.phpl">Member Login</a><br> | <a href="mortgage_calculator.phpl">Calculators</a> |  <a href="Legal.phpl">Legal</a> |  <a href="about.phpl">About Us</a> |  <a href="contact.phpl">Contact Us</a> |  <a href="privacy.phpl">Privacy</a> |  <a href="sitemap.phpl">Site Map</a></span>


</td></tr></table>


</center>


</body>
</html>




