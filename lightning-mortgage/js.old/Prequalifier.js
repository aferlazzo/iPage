function Trim(strInput)
{
var Tstr;
if(strInput.length == 0)
{
return "";
}
else
{
strTemp = strInput.substring(strInput.length - 1);
}
while (strTemp == " ")
{
strInput = strInput.substring(0, strInput.length - 1);
if (strInput.length == 0)
strTemp = "";
else
strTemp = strInput.substring(strInput.length - 1);
}
if (strInput.length == 0)
strTemp = "";
else
strTemp = strInput.substring(0, 1);
while (strTemp == " ")
{
//alert("|"+strTemp+"|");
Tstr = strInput.substring(1);
strInput = Tstr;
if (strInput.length == 0)
strTemp = "";
else
strTemp = strInput.substring(0, 1)
}
return strInput;
}//close Trim Function
function checkEmail(strEmail)
{
emailflag="";
if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(strEmail))
   emailflag="Valid";
else
emailflag="Not Valid";
return emailflag;
}//Ending check mail function
function Validate()
{
var objName = document.Main;
//alert(objName.FullName.value);
if((Trim(objName.FullName.value) == "") || (objName.FullName.value == "Enter Your First Name"))
{
alert("Please enter your name");
objName.FullName.focus();
return false;
}
if(Trim(objName.email.value) == "")
{
alert("Please enter your E-mail address");
objName.email.focus();
return false;
}
if(checkEmail(objName.email.value) == "Not Valid")
{
alert("Please enter a valid E-mail address");
objName.email.focus();
return false;
}
else
return true;
}
function init() {
  if (!document.getElementById) return
  var imgOriginSrc;
  var imgTemp = new Array();
  var imgarr = document.getElementsByTagName('img');
  for (var i = 0; i < imgarr.length; i++) {
    if (imgarr[i].getAttribute('hsrc')) {
        imgTemp[i] = new Image();
        imgTemp[i].src = imgarr[i].getAttribute('hsrc');
        imgarr[i].onmouseover = function() {
            imgOriginSrc = this.getAttribute('src');
            this.setAttribute('src',this.getAttribute('hsrc'))
        }
        imgarr[i].onmouseout = function() {
            this.setAttribute('src',imgOriginSrc)
        }
    }
  }
}
onload=init;

function formatNum(Vnum) {

   if(Vnum > 99000000) {
   alert("Sorry, this will not generate numbers larger that 99 million.");
   focus();
   } else {
   
   var V10million = parseInt(Vnum / 10000000);

   var V1million = (Vnum % 10000000)  / 1000000;
      if(V1million / 1000000 == 1) {
      V1million = 1;
      } else
      if(V1million < 1) {
      V1million = "0";
     } else {
      V1million = parseInt(V1million,10);
     }

    var V100thousand = (Vnum % 1000000)  / 100000;
      if(V100thousand / 100000 == 1) {
      V100thousand = 1;
      } else
      if(V100thousand < 1) {
      V100thousand = "0";
     } else {
      V100thousand = parseInt(V100thousand,10);
     }

   var V10thousand = (Vnum % 100000)  / 10000;
      if(V10thousand / 10000 == 1) {
      V10thousand = 1;
      } else
      if(V10thousand < 1) {
      V10thousand = "0";
      } else {
      V10thousand = parseInt(V10thousand,10);
      }

   var V1thousand = (Vnum % 10000)  / 1000;
      if(V1thousand / 1000 == 1) {
      V1thousand = 1;
      } else
      if(V1thousand < 1) {
      V1thousand = "0";
     } else {
      V1thousand = parseInt(V1thousand,10);
     }

   var Vhundreds = (Vnum % 1000)  / 100;
      if(Vhundreds / 100 == 1) {
      Vhundreds = 1;
      } else
      if(Vhundreds < 1) {
      Vhundreds = "0";
     } else {
      Vhundreds = parseInt(Vhundreds,10);
     }

   var Vtens = (Vnum % 100)  / 10;
      if(Vtens / 10 == 1) {
      Vtens = 1;
      } else
      if(Vtens < 1) {
      Vtens = "0";
     } else {
      Vtens = parseInt(Vtens,10);
     }

   var Vones = (Vnum % 10)  / 1;
      if(Vones / 1 == 1) {
      Vones = 1;
      } else
      if(Vones < 1) {
      Vones = "0";
     } else {
      Vones = parseInt(Vones,10);
     }

//START UPGRADE
var Vcents = 0;

if(Vnum % 1 * 100 < 1) {
   Vcents = 0;
   } else {
   Vcents = parseInt(((eval(Vnum % 1) * 100)),10);
   }
//END UPGRADE

 if(Vcents < 1) {
  Vcents = "00";
  }
  else
  if(Vcents % 10 == 0) {
  Vcents = Vcents + "0";
  }
  else
  if(Vcents % 10 == Vcents) {
  Vcents = "0" + Vcents;
  } else {
  Vcents = Vcents;
  }

  if(Vcents == "900") {
  Vcents = "90";
  } else
  if(Vcents == "800") {
  Vcents = "80";
  } else 
  if(Vcents == "700") {
  Vcents = "70";
  } else 
  if(Vcents == "600") {
  Vcents = "60";
  } else 
  if(Vcents == "500") {
  Vcents = "50";
  } else 
  if(Vcents == "400") {
  Vcents = "40";
  } else 
  if(Vcents == "300") {
  Vcents = "30";
  } else
  if(Vcents == "200") {
  Vcents = "20";
  } else
  if(Vcents == "100") {
  Vcents = "10";
  } else {
  Vcents = Vcents;
  }

   
   var Vformat = "";

   if(Vnum >= 10000000) {
   Vformat = (V10million + "" + V1million + "," + V100thousand + "" + V10thousand + "" + V1thousand + "," + Vhundreds + "" + Vtens + "" + Vones + "." + Vcents);
   }
   else
   if(Vnum >= 1000000) {
   Vformat = (V1million + "," + V100thousand + "" + V10thousand + "" + V1thousand + "," + Vhundreds + "" + Vtens + "" + Vones + "." + Vcents);
   }
   else
   if(Vnum >= 100000) {
   Vformat = (V100thousand + "" + V10thousand + "" + V1thousand + "," + Vhundreds + "" + Vtens + "" + Vones + "." + Vcents);
   }
   else
   if(Vnum >= 10000) {
   Vformat = (V10thousand + "" + V1thousand + "," + Vhundreds + "" + Vtens + "" + Vones + "." + Vcents);
   }
   else
   if(Vnum >= 1000) {
   Vformat = (V1thousand + "," + Vhundreds + "" + Vtens + "" + Vones + "." + Vcents);
   }
   else
   if(Vnum >= 100) {
   Vformat = (Vhundreds + "" + Vtens + "" + Vones + "." + Vcents);
   }
   else
   if(Vnum >= 10) {
   Vformat = (Vtens + "" + Vones + "." + Vcents);
   }
   else
   if(Vnum >= 1) {
   Vformat = (Vones + "." + Vcents);
   } else {
   Vformat = ("0." + Vcents);
   }

  return Vformat;
  }
}

function computeForm(form) 
{
//IF REQUIRED FIELDS EMPTY, ALERT AND KILL SCRIPT
if(form.FullName.value == "" || form.FullName.value == 0) {
   alert("Please enter the name you want on the letter.");
   form.FullName.focus();
   form.FullName.select();
   } else
if(form.Street.value == "" || form.Street.value == 0) {
   alert("Please enter your Current Street Addtess.");
   form.Street.focus();
   form.Street.select();
   } else
if(form.City.value == "" || form.City.value == 0) {
   alert("Please enter your Current City.");
   form.City.focus();
   form.City.select();
   } else
if(form.State.value == "" || form.State.value == 0) {
   alert("Please enter your Current State.");
   form.State.focus();
   form.State.select();
   } else
if(form.Zip.value == "" || form.Zip.value == 0) {
   alert("Please enter your Current Zip Code.");
   form.Zip.focus();
   form.Zip.select();
   } else
if(form.Email.value == "" || form.Email.value == 0) {
   alert("Please enter your Email Address.");
   form.Email.focus();
   form.Email.select();
   } else
if(checkEmail(form.Email.value) == "Not Valid")
{
   alert("Please enter a valid Email Address");
   form.Email.focus();
   form.Email.select();
   } else
if(form.Phone.value == "" || form.Phone.value == 0) {
   alert("Please enter a Contact Phone Number.");
   form.Phone.focus();
   form.Phone.select();
   } else
if(form.AnnualGross.value == "" || form.AnnualGross.value == 0) {
   alert("Please enter your gross annual income.");
   form.AnnualGross.focus();
   form.AnnualGross.select();
   } else
if(form.DownPayment.value == "" || form.DownPayment.value == 0) {
   alert("Please enter the amount you have available for the down payment.\nYou will likely need at least 5 percent of the purchase price in\norder to qualify for the mortgage.");
   form.DownPayment.focus();
   form.DownPayment.select();
   } else
if(form.InterestRate.value == "" || form.InterestRate.value == 0) {
   alert("Please enter an interest rate you selected from the rate sheet.");
   form.InterestRate.focus();
   form.InterestRate.select();
   } else {
//START REQUIRED FIELD VARIFICATION

//SET OPTIONAL BLANK FIELDS EQUAL TO ZERO;
var VmonthlyDebtPmts = form.MonthlyDebt.value;
if(VmonthlyDebtPmts == "") {
   VmonthlyDebtPmts = 0;
   } else {
   VmonthlyDebtPmts = VmonthlyDebtPmts;
   }

var VmoInsurance = form.moInsurance.value;
if(VmoInsurance == "") {
   VmoInsurance = 0;
   } else {
   VmoInsurance = VmoInsurance;
   }

var VmoPropTax = form.moPropTax.value;
if(VmoPropTax == "") {
   VmoPropTax = 0;
   } else {
   VmoPropTax = VmoPropTax;
   }

var x=form.AnnualGross.value;
x=x.replace(/\,/g,"");
//alert('Gross: '+x);
form.AnnualGross.value=x;

x=form.DownPayment.value;
x=x.replace(/\,/g,"");
//alert('DownPayment: '+x);
form.DownPayment.value=x;

x=form.InterestRate.value;
x=x.replace(/\,/g,"");
//alert('InterestRate: '+x);
form.InterestRate.value=x;

var x=form.MonthlyDebt.value;
x=x.replace(/\,/g,"");
//alert('MonthlyDebt: '+x);
form.MonthlyDebt.value=x;

x=form.moInsurance.value;
x=x.replace(/\,/g,"");
//alert('moInsurance: '+x);
form.moInsurance.value=x;

x=form.moPropTax.value;
x=x.replace(/\,/g,"");
//alert('moPropTax: '+x);
form.moPropTax.value=x;

//form okay. Allow user to issue letter by showing the button
document.getElementById('IssueLetter').style.display='block';
document.getElementById('Choices').style.width='41em';
document.getElementById('Results').style.width='13.5em';
document.getElementById('Calculate').value='Change Criteria';
document.getElementById('Calculate').style.width='10em';


//COMPUTE MONTHLY INCOME BASED ON ANNUAL INCOME
var VAnnualGross = form.AnnualGross.value;
var monthlyIncome = VAnnualGross /12;
//alert("monthly income: "+monthlyIncome);
//MORTGAGE PAYMENT CAN'T EXCEED 28% OF MONTHLY INCOME
var maxIncomePmt = monthlyIncome * .28;
//alert("maximum payment (28% of income): "+maxIncomePmt);
//MORTGAGE PAYMENT PLUS DEBT PMTS CAN'T EXCEED 35% OF MONTHLY INCOME
var maxDebtToIncomePmt = .35 * monthlyIncome - eval(VmonthlyDebtPmts);

//USE THE LOWER OF 28% OR 35% AS MAXIMUM HOUSE PAYMENT
var maxHousePmt = 0;
if(maxIncomePmt > maxDebtToIncomePmt) 
   maxHousePmt = maxDebtToIncomePmt;
else
   maxHousePmt = maxIncomePmt;

//IF MAX HOUSE PAYMENT IS LESS THAN $1, ALERT & KILL SCRIPT
if(maxHousePmt < 1) {
   form.DownPayment2.value = "";
   form.LoanAmt.value = "";
   form.homePrice.value = "";
   form.MonthlyPayment.value = "";
   alert("Based on industry standards you would not qualify for a home mortgage.\nIn order to qualify you will need to either increase your annual income\nor lower your monthly debt payments, or a combination of both.\n\nSee the disclaimer below for how we are determining your ability to borrow.\n\nNote that we have alternative loan programs that you might qualify for\nthat are not covered by the automated pre-qualifier. Fill out an application\nand run your credit by clicking on the 'Apply Now' tab above if you'd like to\nuse that method.");
   form.Disclaimer.focus();
   } else {
//START HOUSE PAYMENT VERIFICATION

//ADJUST HOUSE PAYMENT DOWN TO REFLECT MONTHLY INSURANCE & TAX
maxHousePmt = eval(maxHousePmt) - (eval(VmoInsurance) + eval(VmoPropTax));

//Compute maximum home price based on down payment & Closing costs
var VdownPmt = form.DownPayment.value;
var maxDownPaymentPrice = VdownPmt / .05;

//COMPUTE MAXIMUM LOAN AMOUNT BASED ON DOWN PAYMENT
var maxDownPaymentLoan = maxDownPaymentPrice * .95;
var maxLoan = maxDownPaymentLoan;

//GATHER VARIABLES FOR PAYMENT AND PRINCIPLE COMPUTATIONS
var VInterestRate = form.InterestRate.value;
     if(VInterestRate >= 1) {
     VInterestRate = VInterestRate / 100;
     } else {
     VInterestRate = VInterestRate;
     }

    VInterestRate = VInterestRate / 12;


    var Vterm = 0;
    if(form.term.selectedIndex == 0) {
       Vterm = 180;
       } else
       if(form.term.selectedIndex == 1) {
       Vterm = 240;
       } else {
       Vterm = 360;
       }

//COMPUTE PRINCIPAL PAID ON MAXIMUM MONTHLY PAYMENT
   var prin = eval(maxHousePmt) - (eval(maxHousePmt * VInterestRate));
   var intPort = 0;
   var prinPort =0;
   var count = 1;

   while(count < Vterm) {
      intPort = prin * VInterestRate;
      prinPort = eval(maxHousePmt) - eval(intPort);
      prin = eval(prin) + eval(prinPort);
      count = count + 1;
      if(count > 360) {break; } else {continue; }
      }

var maxPmtLoanAmt = prin;

//COMPUTE MONTHLY PAYMENT BASED ON MAXIMUM LOAN AMOUNT

    var factor = 1;

    for (var j = 0; j < Vterm; j++) {

        factor = factor * (eval(1) + eval(VInterestRate));
        }


    var maxLoanPmt = (maxLoan * factor * VInterestRate) / (eval(factor) - eval(1));

//CHOOSE THE LESSOR OF THE TWO PAYMENT AMOUNTS
var maxMoPmt = 0;
if(maxHousePmt > maxLoanPmt) {
   maxMoPmt = maxLoanPmt;
   } else {
   maxMoPmt = maxHousePmt;
   }

//CALCULATE FINAL TOTALS BASED ON FINAL MAX MONTHLY PAYMENT
var prin2 = eval(maxMoPmt) - (eval(maxMoPmt * VInterestRate));
   var intPort2 = 0;
   var prinPort2 =0;
   var count2 = 1;

   while(count2 < Vterm) {
      intPort2 = prin2 * VInterestRate;
      prinPort2 = eval(maxMoPmt) - eval(intPort2);
      prin2 = eval(prin2) + eval(prinPort2);
      count2 = count2 + 1;
      if(count2 > 360) {break; } else {continue; }
      }

var finalMaxLoanAmt = prin2;

//CALCULATE CLOSING COSTS
var closeCost = finalMaxLoanAmt * .02;
var finalDownPayment = VdownPmt - closeCost;

//ADDED FOR ROUNDING TO $100
finalDownPayment = (finalDownPayment - (finalDownPayment % 100));
finalMaxLoanAmt = (finalMaxLoanAmt - (finalMaxLoanAmt % 100));

 var factor2 = 1;

    for (var j2 = 0; j2 < Vterm; j2++) {

        factor2 = factor2 * (eval(1) + eval(VInterestRate));
        }


    maxMoPmt = (finalMaxLoanAmt * factor2 * VInterestRate) / (eval(factor2) - eval(1));

//ENTER TOTALS
form.DownPayment2.value = formatNum(finalDownPayment);
form.LoanAmt.value = formatNum(finalMaxLoanAmt);
form.homePrice.value = formatNum(eval(finalDownPayment) + eval(finalMaxLoanAmt));
var PITI= eval(maxMoPmt) + eval(VmoInsurance) + eval(VmoPropTax);
//alert("PITI: "+PITI+"\nPI: "+maxMoPmt+"\nInsurance: "+VmoInsurance+"\nProperty Tax: "+VmoPropTax);
maxMoPmt=PITI;
form.MonthlyPayment.value = formatNum(maxMoPmt);

//DISPLAY SUMMARY
SummaryText = "Based on your down payment amount, you could qualify for a house costing $".concat(form.homePrice.value, 
".  Obviously this amount is merely an estimate and your actual amount could ",
"vary. See the disclaimer below for how we are determining your ability to borrow. ",
"Press the 'Issue Pre-Qualification Letter' button to obtain your letter to accept, or modify the amounts you entered and press 'Change Criteria'.",
"<br /><br />Place your mouse over the<span class='Highlight'> question marks </span>at left to see an explanation of each Result below.");
document.getElementById('enterHelp').innerHTML = SummaryText;
//DISPLAY SUMMARY

//END HOUSE PAYMENT VERIFICATION
      }

//END REQUIRED FIELD VARIFICATION
   }

}

//GIVE ENTRY INSTRUCTIONS
function help01() {
document.getElementById('enterHelp').innerHTML = "Press the Tab key to move between fields, or click on field directly.<br /><br />Hint: Your gross annual household income.  This is the amount<span class='Highlight'> before taxes </span>are deducted.";
}

function clearHelp() {
document.getElementById('enterHelp').innerHTML = "Press the<span class='Highlight'> Tab </span>key to move between fields, or click on field directly.";
}

function help02() {
document.getElementById('enterHelp').innerHTML = ("Press the Tab key to move between fields, or click on field directly.<br /><br />Hint: The total of your<span class='Highlight'> monthly non-mortgage and non-rent payments. </span>This would include car loans, student loans, credit card payments, child support, alimony and so on.");
}

function help03() {
document.getElementById('enterHelp').innerHTML = ("Press the Tab key to move between fields, or click on field directly.<br /><br />Hint: Money you have<span class='Highlight'> available to cover both the mortgage down payment and closing costs. </span>At the very least, you must have 5% of the home cost.");
}

function help04() {
document.getElementById('enterHelp').innerHTML = ("Press the<span class='Highlight'> Tab </span>key to move between fields, or click on field directly.<br /><br />Hint: The annual interest rate you expect to pay on this mortgage. You can enter the rate either as a percentage (for example, 7.0) or as a decimal (.07), whichever you prefer.");
}

function help05() {
document.getElementById('enterHelp').innerHTML = ("Press the Tab key to move between fields, or click on field directly.<br /><br />Hint: The monthly insurance payment you expect to pay. As a rule of thumb,<span class='Highlight'> expect to pay .25% (home price X .0025) of the purchase price </span>per month.\n\nFor more help on this, please email or call us.");
}

function help06() {
document.getElementById('enterHelp').innerHTML = ("Press the Tab key to move between fields, or click on field directly.<br /><br />Hint: The monthly property tax payment you expect to pay. As a rule of thumb, <span class='Highlight'>expect to pay 1.25% (home price X .0125) of the purchase price </span>per month.\n\nFor more help on this, please email or call us.");
}

function help07() {
document.getElementById('enterHelp').innerHTML = ("Press the<span class='Highlight'> Tab </span>key to move between fields, or click on field directly.<br /><br />Hint: Length of Mortgage.");
}


//GIVE RESULT EXPLANATIONS
function help08() {
document.getElementById('resultHelp').innerHTML = ("RESULT: This is your original down payment amount less an estimated 2% for closing costs.");
}

function help09() {
document.getElementById('resultHelp').innerHTML = ("RESULT: This is the maximum mortgage you would qualify for based on your current entries.");
}

function help10() {
document.getElementById('resultHelp').innerHTML = ("RESULT: This is maximum home price you could afford - the total of your down payment and your maximum mortgage amount.");
}

function help11() {
document.getElementById('resultHelp').innerHTML = ("RESULT: This is your maximum monthly mortgage payment (including Taxes & Insurance) based upon your current entries.");
}

function helpClear() {
document.getElementById('resultHelp').innerHTML = "Results Explanation Box: Hover the mouse pointer over a<span class='Highlight'> ? </span> for details.";
}


function clearForm(form)
{
form.AnnualGross.value = "";
form.MonthlyDebt.value = "";
form.DownPayment.value = "";
form.InterestRate.value = "";
form.moInsurance.value = "";
form.moPropTax.value = "";
form.homePrice.value = "";
form.MonthlyPayment.value = "";
form.LoanAmt.value = "";
form.DownPayment2.value = "";
form.AnnualGross.focus();
document.getElementById('enterHelp').innerHTML = "Press the<span class='Highlight'> Tab </span>key to move between fields, or click on field directly.";
document.getElementById('resultHelp').innerHTML = "Results Explanation Box: Hover the mouse pointer over a<span class='Highlight'> ? </span> for details.";
}
