function dp(price) //decimal point function
{
var string = "" + price;
var x=string;
x = x.replace(/\,/g, ""); //remove commas and dollar signs
string = x.replace(/\$/g, ""); 
var number = string.length - string.indexOf('.');
if (string.indexOf('.') == -1)
return string + '.00';
if (number == 1) return string + '0';
if (number == 2) return string + '0';
if (number > 3)  return string.substring(0,string.length-number+3);
return string;
}
function calculate()
{
document.calcform.LoanAmt.value = dp(document.calcform.LoanAmt.value);
document.getElementById('AFee').innerHTML = dp(document.getElementById('AFee').innerHTML);
document.getElementById('BFee').innerHTML = dp(document.calcform.LoanAmt.value * .015);

if(document.calcform.LoanAmt.value < 166666)
 document.getElementById('BFee').innerHTML = dp(2500.00);

if (document.calcform.LoanAmt.value <= 35000)
 document.getElementById('TFee').innerHTML = dp(349.00);
else
if ((document.calcform.LoanAmt.value > 35000) && (document.calcform.LoanAmt.value <= 50000))
 document.getElementById('TFee').innerHTML = dp((document.calcform.LoanAmt.value - 35000)*.00661 + 350);
else
if ((document.calcform.LoanAmt.value > 50000) && (document.calcform.LoanAmt.value <= 100000))
 document.getElementById('TFee').innerHTML = dp((document.calcform.LoanAmt.value - 50000)*.0041 + 449);
else
if ((document.calcform.LoanAmt.value > 100000) && (document.calcform.LoanAmt.value <= 500000))
 document.getElementById('TFee').innerHTML = dp((document.calcform.LoanAmt.value - 100000)*.00331 + 653.15);
else
if ((document.calcform.LoanAmt.value > 500000) && (document.calcform.LoanAmt.value <= 1000000))
 document.getElementById('TFee').innerHTML = dp((document.calcform.LoanAmt.value - 500000)*.00296 + 1977.15);
var bfee = document.getElementById('BFee').innerHTML;
document.getElementById('TCosts').innerHTML = "$"+dp(eval(document.getElementById('BFee').innerHTML) 
+ eval(document.getElementById('AFee').innerHTML) + (895.00) + (85.00) + (19.00) + (15.00) 
+ (350.00) + eval(document.getElementById('TFee').innerHTML) + (100.00) + (150.00) + (100.00) + (125.00));

document.getElementById('AFee').innerHTML = "$"+dp(document.getElementById('AFee').innerHTML);
document.getElementById('BFee').innerHTML = "$"+dp(document.getElementById('BFee').innerHTML);
document.getElementById('TFee').innerHTML = "$"+dp(document.getElementById('TFee').innerHTML);


}

