function SetMyValue (CookieName, Value)
{
var MyDate = new Date();
var Day = MyDate.getDate();
Day = Day + 60; //number of days cookie exists
MyDate.setDate(Day);
var DDate=MyDate.toGMTString();
var Path=escape('/');

var Cook = escape(CookieName);
document.cookie=Cook+'='+Value+'; expires='+DDate+'; Path='+Path;
}
function EnableAccess()
{
SetMyValue('creditletter', 'no'); //don't show the credit secrets signup letter
SetMyValue('letter', 'no'); //don't show the mortgage secrets signup letter
//alert("cookie letter is being set to 'no'");

}
function PrintDate()
{
var months = new Array();
months[0] = "January";  months[6] = "July";
months[1] = "February"; months[7] = "August";
months[2] = "March";    months[8] = "September";
months[3] = "April";    months[9] = "October";
months[4] = "May";      months[10] = "November";
months[5] = "June";     months[11] = "December";
var days = new Array();
days[0] = "Sunday";    days[4] = "Thursday";
days[1] = "Monday";    days[5] = "Friday";
days[2] = "Tuesday";   days[6] = "Saturday";
days[3] = "Wednesday";
var lastMod = new Date();
var MM = lastMod.getMonth();
var Day = lastMod.getDay();
var DD = lastMod.getDate();
document.write(days[Day]+" "+months[MM]+" "+DD+", "+lastMod.getFullYear());
}
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
}

function Validate(FormName)
{
var objName = FormName;
if((Trim(objName.Full_Name.value) == "") || (objName.Full_Name.value == "Enter Your First Name Here"))
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
if((Trim(objName.security_code.value) == "") || (objName.security_code.value == "Enter the Security Code Here"))
{
alert("Please enter the Security Code");
objName.security_code.focus();
return false;
}




else
return true;
}
