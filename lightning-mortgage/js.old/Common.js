function preloadImages() {
  var d=document; if(d.images){ if(!d.p) d.p=new Array();
    var i,j=d.p.length,a=preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.p[j]=new Image; d.p[j++].src=a[i];}}
}


preloadImages('./images/sprites.png');




var d=document;
var P=window.location.pathname;
//alert("P: "+P); 
var L=P.length;
var tail=P.substring(10,L);
var K=L - 16;
Names=P.split('/');

uriIndex=Names.length - 1;
uriDirectory = Names.length - 2;
//alert('Directory: ' + Names[uriDirectory] + ' uri: ' + Names[uriIndex]);

//for (i=0;i<Names.length;i++)
//	alert('|'+Names[i]+'|');

var Directory = 'root';

if (Names[uriDirectory] == 'Index')
{
	//alert("Index page");
	Directory = 'Index';
}
if (Names[uriDirectory] == 'Administrative')
{
	//alert("Administrative page");
	Directory = 'Administrative';
}
if (Names[uriDirectory] == 'CreditScores')
{
	//alert("CreditScores page");
	Directory = 'CreditScores';
}
else
if (Names[uriDirectory] == 'Answers')
{
	//alert("Answers page");
	Directory = 'Answers';
}
else
if (Names[uriDirectory] == 'LoanTypes')
{
	//alert("LoanTypes page");
	Directory = 'LoanTypes';
}
else
if (Names[uriDirectory] == 'InterestRates')
{
	//alert("InterestRates page");
	Directory = 'InterestRates';
}
else
if (Names[uriDirectory] == 'MortgageApplication')
{
	//alert("MortgageApplication page");
	Directory = 'MortgageApplication';
}


var Path=window.location.pathname;
var SplitExp = /\/|\\/;
var myArray=Path.split(SplitExp);
var ArrD=myArray.length-2;
var Qd='../images/';
/*
alert("Path broken into "+myArray.length+' parts\nDirectory is '+myArray[ArrD]);
for (var i=0;i<myArray.length;i++)
 alert('Part '+i+': '+myArray[i]);
*/
if((myArray[ArrD]=="My%20Webs") || (myArray[ArrD]=="www.lightning-mortgage.com") || (myArray[ArrD]==""))
{
Qd='./images/';
//alert("At Root");
}
else
if(myArray[ArrD]=="Scripts")
{
Qd='../images/';
//alert("At "+myArray[ArrD]+"\nFull "+Path);
}


function ShowTabs(Directory)
{
//alert(' in ShowTabs. Directory is ' + Directory);
var d=document;
var hh;
if (Directory=="root")
hh='<ul><li id="IndexTab-nav"><a onfocus="if(this.blur) this.blur();" href=".\/index.php" title="Go Back Home">';
else
hh='<ul><li id="IndexTab-nav"><a onfocus="if(this.blur) this.blur();" href="..\/index.php" title="Go Back Home">';
if ((window.location.pathname=="\/") || (window.location.href.indexOf("\/Index")>-1) || (window.location.href.indexOf("\/index")>-1))
hh+="<div style='border-bottom:2px solid #060;'></div>";
if (window.location.href.indexOf("\/Index\/")==-1)
hh+="Home";
else
hh+="To Home";

hh+='</a></li>';
d.write(hh);
if (Directory=="root")
hh='<li id="LoanAppTab-nav"><a onfocus="if(this.blur) this.blur();" href="http:\/\/lightning-mortgage.com\/MortgageApplication\/LoanAppShort.php" title="Apply for a loan or for prequalification">';
else
hh='<li id="LoanAppTab-nav"><a onfocus="if(this.blur) this.blur();" href="http:\/\/lightning-mortgage.com\/MortgageApplication\/LoanAppShort.php" title="Apply for a loan or for prequalification">';
if (window.location.href.indexOf("\/MortgageApplication\/")>-1) 
hh+="<div style='border-bottom:2px solid #099;'></div>";
hh+='Apply Now<\/a><\/li>';
d.write(hh);
if (Directory=="root")
hh='<li id="AnswersTab-nav"><a onfocus="if(this.blur) this.blur();" href=".\/Answers.php" title="Learn about all that\'s involved in the process">';
else
hh='<li id="AnswersTab-nav"><a onfocus="if(this.blur) this.blur();" href="..\/Answers.php" title="Learn about all that\'s involved in the process">';

if ((window.location.href.indexOf("\/Survey.php")>-1) || (window.location.href.indexOf("\/Answers")>-1))
hh+="<div style='border-bottom:2px solid #93c;'></div>";
if (window.location.href.indexOf("\/Answers\/")==-1) 
hh+='Our Loan Process';
else
hh+='More on Our Loan Process';

hh+='</a></li>';
d.write(hh);
if (Directory=="root")
hh='<li id="CreditScoresTab-nav"><a onfocus="if(this.blur) this.blur();" href=".\/CreditScores.php" title="Find out about credit report subjects">';
else
hh='<li id="CreditScoresTab-nav"><a onfocus="if(this.blur) this.blur();" href="..\/CreditScores.php" title="Find out about credit report subjects">';
if (window.location.href.indexOf("\/CreditScores")>-1)
hh+="<div style='border-bottom:2px solid #906;'></div>";
if (window.location.href.indexOf("\/CreditScores\/")==-1)
hh+='Credit Scores';
else
hh+='More on Credit Scores';

hh+='</a></li>';
d.write(hh);
if (Directory=="root")
hh='<li id="LoanTypesTab-nav"><a onfocus="if(this.blur) this.blur();" href=".\/LoanTypes.php" title="Learn about the types of loans we handle">';
else
hh='<li id="LoanTypesTab-nav"><a onfocus="if(this.blur) this.blur();" href="..\/LoanTypes.php" title="Learn about the types of loans we handle">';
if (window.location.href.indexOf("\/LoanTypes")>-1)
hh+="<div style='border-bottom:2px solid #c60;'></div>";
if (window.location.href.indexOf("\/LoanTypes\/")==-1)
hh+='Loan Types';
else
hh+='More on Loan Types';

hh+='</a></li>';
d.write(hh);
if (Directory=="root")
hh='<li id="InterestRatesTab-nav"><a onfocus="if(this.blur) this.blur();" href=".\/InterestRates.php" title="Learn about interest rate topics">';
else
hh='<li id="InterestRatesTab-nav"><a onfocus="if(this.blur) this.blur();" href="..\/InterestRates.php" title="Learn about interest rate topics">';
if (window.location.href.indexOf("\/InterestRates")>-1)
hh+="<div style='border-bottom:2px solid #996;'></div>";
if (window.location.href.indexOf("\/InterestRates\/")==-1)
hh+='Interest Rates';
else
hh+='More on Interest Rates';

hh+='</a></li>';
d.write(hh);
}
var cookies = new Object();  // LAPS needs this variable
var bcolor;
var UName=GetMyValue("UName");
function ShowLoginButton(Dir)
{

if(Dir==undefined)
Dir="Administrative";

if ((typeof(Small) != undefined) && (window == top)) //not in frame
{
bcolor=findStyleValue("Small","color","color");
//alert('..\/'+Dir+'\/Login.php');
if((UName==undefined) || (UName == "null") || (UName == ""))
 d.write('<input type="submit" class="Submit" value="Login" onclick="window.location.href=\'..\/'+Dir+'\/Login.php\'" ');
else
 d.write('<input type="submit" class="Submit" value="Logout" onclick="Logout();window.location.href=\'..\/'+Dir+'\/Logout.php\'" ');

d.write('onMouseover="this.style.color=\'#039\';this.style.background=\'#fff\';" onMouseout="this.style.color=\'#fff\';this.style.background=bcolor;">\n');
}
}
function ShowHelpButton(Dir)
{
if (window == top) //not in frame
{
//alert('..\/'+Dir+'\/Login.php');
d.write('<input type="submit" class="Submit" value="Help" onclick="window.location.href=\'../'+Dir+'/Help.php\'" ');
d.write('onMouseover="this.style.color=\'#009\';this.style.background=\'#fff\';" onMouseout="this.style.color=\'#fff\';this.style.background=bcolor;">\n');
}
}

function BType()
{ 
/*
var isIE4 = document.all? true : false; 
var isIE6 = document.getElementById && document.all ? true : false; 
var isNS4 = document.layers? true : false; 
var isNS6 = document.getElementById && !document.all ? true : false; 
if(isNS6)
alert('Netscape 6');  
if(isNS4)
alert('Netscape 4');  
if(isIE6)
alert('IE 6');  
if(isIE4)
alert('IE 4'); 
*/ 
//----------------------------


  var isNS = 0;
  if (navigator.appName.indexOf('Netscape') > -1)
  {
    isNS = 1;
  }

  var isFirefox = 0;
  if (navigator.userAgent.indexOf( "Firefox" ) > -1)
   isFirefox = 1;

  if ((isNS == 1) && (isFirefox == 0))
  {
//    document.getElementById('BigShadow').style.visibility = 'hidden';
	if(typeof(BS2) != "undefined")
     document.getElementById('BigShadow2').style.visibility = 'hidden';
  }
}
function findStyleValue(objectID,styleProp,IEstyleProp)
{
//***********Note: Make sure some css object has id='Small' on page
var object=document.getElementById(objectID);
if(object.currentStyle) 
 return object.currentStyle[IEstyleProp];
else
if(window.getComputedStyle)
{
 var compStyle = window.getComputedStyle(object,'');
 return compStyle.getPropertyValue(styleProp);
}
}
function Unblock()
{
window.SecondWindow=open("http://www.lightning-mortgage.com/Answers/UnblockingMessages.php", "RemoteControl", 
"height=710,width=700,scrollbars=yes,left=1,top=1,screenx=1,screeny=1");
}
function AdjustHeight(Parent,LL,RR)  
{  
// get actual height of each column, take the bigger one.
var ll = d.getElementById(LL).offsetHeight;
var rr = d.getElementById(RR).offsetHeight;
var hh = Math.max(ll, rr);
//alert("ll: " + ll + "\nrr: " + rr);

var textHeight;
if (hh == 0)
textHeight = "100%";
else
textHeight = hh + "px";
var totalHeight = hh + 10;
totalHeight += "px"
d.getElementById(LL).style.height = totalHeight;
d.getElementById(RR).style.height = totalHeight;
d.getElementById(Parent).style.height = totalHeight;
//alert("textHeight: " + textHeight + "\ntotalHeight: " + totalHeight);
}  
function Logout()
{
d.cookie='UName=""; expires=Thu, 01-Jan-1999 00:00:01 GMT; path=/;';
d.cookie='CName=""; expires=Thu, 01-Jan-1999 00:00:01 GMT; path=/;';
//window.location.href='../Administrative/BusinessPractices.php';
//window.location.reload( true );
}
var tags=new Array('div','td','tr','p','b','table','strong','emphasis','a','pre','sub','sup','i','th','cp','ul','ol','li','dt','dd');
var pixelArray=new Array('10','12','14','18','20','24','30');
var emArray=new Array('0.7','0.9','1.0','1.5','2.0','2.5','3');
var getAllTags=new Array;
var GetDIV=new Array;
var SizeIndex=1;
var WhiteDIV=false;

function isBlank(){
value=d.Atomz.elements['sp-q'].value;
if((value.indexOf("Your search word(s)")==-1)&&(value!=""))
return true;
else
return false;
}
var userString=new Array();
userString[0]="It was great how you kept me informed as to the status of my refinancing, and the transaction was completed in a timely and flawless manner.<br />-Laury L.";
userString[1]="We received personal and speedy responses and now have a nice low interest rate.<br />-Catherine and Harlan T.";
userString[2]="I appreciate your efforts and candor; please feel free to have any future clients contact me regarding your integrity.<br />-Matthew M.";
userString[3]="I just wanted to thank you for all your hard work.  I'm so glad to pay off most of my bills...what a relief ! When I need another mortgage, I will contact you.<br />-Evelyn K.";
userString[4]="Thank you for everything on this loan - it has all been pretty smooth and we are happy with our financing and closing!!! You guys do a great job!!</br />-Tricia and Carl S.";
userString[5]="I must commend you for your professionalism and diligence.  Kudos to you and keep up the great work. You solved all my problems!<br />- Joe B.";
userString[6]="First of all the information I got from the website was the most up front detailed info that I have seen. It answered all my questions.  Thanks for being there.<br />-Stephanie D.";
var currentString=0;
var activeColor=254;
var isIE=d.all;
var delay;
var fadeInterval;
isIE>-1?delay=8:delay=150;
var hexValues=new Array('00','01','02','03','04','05','06','07','08','09','0A','0B','0C','0D','0E','0F','10','11','12','13','14','15','16','17','18','19','1A','1B','1C','1D','1E','1F','20','21','22','23','24','25','26','27','28','29','2A','2B','2C','2D','2E','2F','30','31','32','33','34','35','36','37','38','39','3A','3B','3C','3D','3E','3F','40','41','42','43','44','45','46','47','48','49','4A','4B','4C','4D','4E','4F','50','51','52','53','54','55','56','57','58','59','5A','5B','5C','5D','5E','5F','60','61','62','63','64','65','66','67','68','69','6A','6B','6C','6D','6E','6F','70','71','72','73','74','75','76','77','78','79','7A','7B','7C','7D','7E','7F','80','81','82','83','84','85','86','87','88','89','8A','8B','8C','8D','8E','8F','90','91','92','93','94','95','96','97','98','99','9A','9B','9C','9D','9E','9F','A0','A1','A2','A3','A4','A5','A6','A7','A8','A9','AA','AB','AC','AD','AE','AF','B0','B1','B2','B3','B4','B5','B6','B7','B8','B9','BA','BB','BC','BD','BE','BF','C0','C1','C2','C3','C4','C5','C6','C7','C8','C9','CA','CB','CC','CD','CE','CF','D0','D1','D2','D3','D4','D5','D6','D7','D8','D9','DA','DB','DC','DD','DE','DF','E0','E1','E2','E3','E4','E5','E6','E7','E8','E9','EA','EB','EC','ED','EE','EF','F0','F1','F2','F3','F4','F5','F6','F7','F8','F9','FA','FB','FC','FD','FE','FF');

function fadeText(direction)
{
	var object=document.getElementById("Testimonial");
	Object.innerHTML=userString[currentString];

	var ColorHex = hexValues[activeColor]+hexValues[activeColor]+hexValues[activeColor];
	var ColorVal = "#" + ColorHex;

	if (currentString >= userString.length)
	{
		//alert('length '+ userString.length + ' userString[' + currentString + '] = ' + userString[currentString]);
		currentString = 0;			
	}
	
	if( typeof( object.style.color ) == undefined )
    //Non-IE
		object.style.color=ColorHex;	
	else
		object.style.color=ColorVal;

	if(direction)
	{
		activeColor-=10;
		if(activeColor<=0)
		{
			activeColor=0;
			clearInterval(fadeInterval);
			fadeInterval=setInterval("fadeText("+0+")",delay);
		}
	}
	else
	{
		activeColor+=10;
		if(activeColor>=255)
		{
			activeColor=254;
			clearInterval(fadeInterval);
			currentString++;
			fadeInterval=setInterval("fadeText("+1+")",delay);
		}
	}
}

// ----------------------------------------------------------
//
// debugged
//
// ----------------------------------------------------------

function fadeText2(direction)
{
	var Object=document.getElementById("Testimonial");
	//alert('A Object.innerHTML '+ Object.innerHTML);
	Object.innerHTML=userString[currentString];
	//alert('B Object.innerHTML '+ Object.innerHTML);
	var ColorHex = hexValues[activeColor]+hexValues[activeColor]+hexValues[activeColor];
	var ColorVal = "#" + ColorHex;

	//alert('1. currentString: ' + currentString + 'userString.length ' + userString.length + ' Object.innerHTML '+ Object.innerHTML + ' activeColor ' + activeColor);
	if (currentString >= userString.length)
	{
		//alert('2. length '+ userString.length + ' userString[' + currentString + '] = ' + userString[currentString]);
		currentString = 0;			
	}
	
	if( typeof( Object.style.color ) == undefined )
    //Non-IE
		Object.style.color=ColorHex;	
	else
		Object.style.color=ColorVal;

	if(direction == 1)
	{
		activeColor-=10;
		if(activeColor<=0)
		{
			activeColor=0;
			clearInterval(fadeInterval);
			//currentString++;
			//alert('3. currentString: ' + currentString + ' Object.innerHTML '+ Object.innerHTML + ' activeColor ' + activeColor);
			Object.innerHTML=userString[currentString];
			fadeInterval=setInterval("fadeText2("+0+")",delay);
		}
	}
	else
	{
		activeColor+=10;
		if(activeColor>=255)
		{
			activeColor=254;
			clearInterval(fadeInterval);
			currentString++;
			if(currentString >= userString.length)
				currentString = 0;
			
			Object.innerHTML=userString[currentString];
			//alert('4. currentString: ' + currentString + ' Object.innerHTML '+ Object.innerHTML + ' activeColor ' + activeColor);
			fadeInterval=setInterval("fadeText2("+1+")",delay);
		}
	}
}
function doClock()
{
var t=new Date();
var a=['M0','%20','D0',',%20','Y0'];
var str="";
var i,a1,lang="1";
var month=new Array('January','Jan','February','Feb','March','Mar','April','Apr','May','May','June','Jun','July','Jul','August','Aug','September','Sep','October','Oct','November','Nov','December','Dec');
var tday=new Array('Sunday','Sun','Monday','Mon','Tuesday','Tue','Wednesday','Wed','Thursday','Thr','Friday','Fri','Saturday','Sat');
for(i=0;i<a.length;i++)
{
a1=a[i].charAt(1);
switch(a[i].charAt(0))
{
case "M":
if((Number(a1)==3)&&((t.getMonth()+1)<10))
str+="0";
str+=(Number(a1)>1)?t.getMonth()+1:month[t.getMonth()*2+Number(a1)];
break;
case "D":
if((Number(a1)==1)&&(t.getDate()<10))
str+="0";
str+=t.getDate();
break;
case "Y":
str+=(a1=='0')?t.getFullYear():t.getFullYear().toString().substring(2);
break;
case "W":
str+=tday[t.getDay()*2+Number(a1)];
break;
default:str+=unescape(a[i]);
}
}
return str;
}
var Cookies = new Object;
function GetMyValue (CookieName)
{
var Name, Value;
var Beginning, Middle, End;
Beginning = 0;

while (Beginning < d.cookie.length)
{
	// find the next equals sign
	Middle = d.cookie.indexOf('=', Beginning);

	// find the next semicolon
	End = d.cookie.indexOf(';', Beginning);

	if (End == -1)	// if no semicolon exists, it's the last cookie...
		End = d.cookie.length;

	// if nothing is in the cookie, blank out its value
	if ((Middle > End) || (Middle == -1))
	{
		Name = d.cookie.substring(Beginning, End);
		Value = "";
	}
	else
	{
		//extract the Name and value
		Name = d.cookie.substring(Beginning, Middle);
		Value = d.cookie.substring(Middle + 1, End);
	}
	if(Name == CookieName)
	{
		return(Value);
	}
	// jump over the next space to the Beginning of next cookie
	Beginning = End + 2;
}
	return("");
}
function ViewHUD1(DeleteIt)
{
ShowHUD1Lines=GetMyValue("HUD1Registered");
var MyDate = new Date();
var Day = MyDate.getDate();
Day = Day + 1;
MyDate.setDate(Day);
DDate=MyDate.toString();
if (DeleteIt=="delete")
{
d.cookie="HUD1Registered=deleted; expires=Thu, 01-Jan-1970 00:00:01 GMT"+DDate;
d.cookie="HUD1Registered=0; expires=Thu, 01-Jan-1970 00:00:01 GMT"+DDate;
ShowHUD1Lines="0";
}
else
{
d.cookie="HUD1Registered=1; expires="+DDate;
ShowHUD1Lines="1";
}
return(ShowHUD1Lines);
}

function ShowNewTabs(Directory)
{
//alert('in ShowNewTabs(Directory):' + Directory);
if(Directory=='Index')
	document.writeln("<ul id='nav-list'><li class='Home'><a href='../index.php'>Home</a></li><li><a href='../MortgageApplication/LoanAppShort.php'>Apply Now</a></li><li><a href='../Answers.php'>Loan Process</a></li><li><a href='../CreditScores.php'>Credit Scores</a></li><li><a href='../LoanTypes.php'>Loan Types</a></li><li><a href='../InterestRates.php'>Interest Rates</a></li></ul>");
else
if(Directory=='MortgageApplication')
	document.writeln("<ul id='nav-list'><li><a href='../index.php'>Home</a></li><li class='ApplyNow'><a href='LoanAppShort.php'>Apply Now</a></li><li><a href='../Answers.php'>Loan Process</a></li><li><a href='../CreditScores.php'>Credit Scores</a></li><li><a href='../LoanTypes.php'>Loan Types</a></li><li><a href='../InterestRates.php'>Interest Rates</a></li></ul>");
else
if(Directory=='Answers')
	document.writeln("<ul id='nav-list'><li><a href='../index.php'>Home</a></li><li><a href='../MortgageApplication/LoanAppShort.php'>Apply Now</a></li><li class='Answers'><a href='../Answers.php'>Loan Process</a></li><li><a href='../CreditScores.php'>Credit Scores</a></li><li><a href='../LoanTypes.php'>Loan Types</a></li><li><a href='../InterestRates.php'>Interest Rates</a></li></ul>");
else
if(Directory=='CreditScores')
	document.writeln("<ul id='nav-list'><li><a href='../index.php'>Home</a></li><li><a href='../MortgageApplication/LoanAppShort.php'>Apply Now</a></li><li><a href='../Answers.php'>Loan Process</a></li><li class='CreditScores'><a href='../CreditScores.php'>Credit Scores</a></li><li><a href='../LoanTypes.php'>Loan Types</a></li><li><a href='../InterestRates.php'>Interest Rates</a></li></ul>");
else
if(Directory=='LoanTypes')
	document.writeln("<ul id='nav-list'><li><a href='../index.php'>Home</a></li><li><a href='../MortgageApplication/LoanAppShort.php'>Apply Now</a></li><li><a href='../Answers.php'>Loan Process</a></li><li><a href='../CreditScores.php'>Credit Scores</a></li><li class='LoanTypes'><a href='../LoanTypes.php'>Loan Types</a></li><li><a href='../InterestRates.php'>Interest Rates</a></li></ul>");
else
if(Directory=='InterestRates')
	document.writeln("<ul id='nav-list'><li><a href='../index.php'>Home</a></li><li><a href='../MortgageApplication/LoanAppShort.php'>Apply Now</a></li><li><a href='../Answers.php'>Loan Process</a></li><li><a href='../CreditScores.php'>Credit Scores</a></li><li><a href='../LoanTypes.php'>Loan Types</a></li><li class='InterestRates'><a href='../InterestRates.php'>Interest Rates</a></li></ul>");
else
if(Directory=='Administrative')
	document.writeln("<ul id='nav-list'><li><a href='../index.php'>Home</a></li><li><a href='../MortgageApplication/LoanAppShort.php'>Apply Now</a></li><li><a href='../Answers.php'>Loan Process</a></li><li><a href='../CreditScores.php'>Credit Scores</a></li><li><a href='../LoanTypes.php'>Loan Types</a></li><li><a href='../InterestRates.php'>Interest Rates</a></li></ul>");
else
{
	var P=window.location.pathname;
	var Names=P.split('/');
	var uriDirectory = Names.length - 2;
	var uriIndex=Names.length - 1;
	var NN = Names[uriIndex];
	NN = NN.substr(0,NN.length - 4)
	//alert(' uri: ' + Names[uriIndex] + ' Directory: ' + Names[uriDirectory] + ' directory name length ' + NN);
	//alert(NN);
	//ShowNewTabs(NN);
	
	document.write("<ul id='nav-list'>");
	if(NN == 'index')
		document.write("<li class='Home'>");
	else
		document.write("<li>");
	document.write("<a href='./index.php'>Home</a></li>");

	if(NN == 'MortgageApplication')
		document.write("<li class='ApplyNow'>");
	else
		document.write("<li>");
	document.write("<a href='./MortgageApplication/LoanAppShort.php'>Apply Now</a></li>");
		
	if(NN=='Answers')
		document.write("<li class='Answers'>");
	else
		document.write("<li>");	
	document.write("<a href='./Answers.php'>Loan Process</a></li>");

	if(NN=='CreditScores')
		document.write("<li class='CreditScores'>");
	else
		document.write("<li>");	
	document.write("<a href='./CreditScores.php'>Credit Scores</a></li>");

	if(NN=='LoanTypes')
		document.write("<li class='LoanTypes'>");
	else
		document.write("<li>");
	document.write("<a href='./LoanTypes.php'>Loan Types</a></li>");

	if(NN=='InterestRates')
		document.write("<li class='InterestRates'>");
	else
		document.write("<li>");
	document.writeln("<a href='./InterestRates.php'>Interest Rates</a></li></ul>");
}

document.close();
}
function SetContentHeight() 
{
  myHeight = 0;
  var ContentDIVelement, LeftFrameElement, RightFrameElement;

  LeftFrameElement = document.getElementById("LeftFrame");
  RightFrameElement = document.getElementById("RightFrame");
  ContentDIVelement = document.getElementById("ContentDIV");
  
	myHeight = ContentDIVelement.offsetHeight + "px";
	//alert(myHeight);
	ContentDIVelement.style.height = myHeight;
	LeftFrameElement.style.height = myHeight;
	RightFrameElement.style.height = myHeight;
}

/*
function SetContentHeight() 
{
  var myWidth = 0, myHeight = 0, divHeight = 0;
  var ContentDIVelement, LeftFrameElement, RightFrameElement;
  if (self.innerHeight) // all except Explorer
  {
    //Non-IE
	//window.alert('not IE');
    myHeight = self.innerHeight;
  } 
  else 
  if (document.documentElement && document.documentElement.clientHeight) 
  {
    //IE 6+ in 'standards compliant mode'
    myHeight = document.documentElement.clientHeight;
  } 
  else 
  if(document.body) 
  {
    //IE 4 compatible
    myHeight = document.body.clientHeight;
  }

  LeftFrameElement = document.getElementById("LeftFrame");
  RightFrameElement = document.getElementById("RightFrame");
  ContentDIVelement = document.getElementById("ContentDIV");
  myHeight -= 290; //150 pixels is approximate height of header
  
  //myHeight = "height: " + myHeight + "px";
  //ContentDIVelement.setAttribute("style",myHeight);
  
  divHeight = document.getElementById("ContentDIV").offsetHeight;
  
  //window.alert( 'myHeight = "' + myHeight + '" divHeight = "' + divHeight + '"');
  
  if(divHeight > myHeight) 
  {
	myHeight += "px";
	ContentDIVelement.style.height = myHeight;
	LeftFrameElement.style.height = myHeight;
	RightFrameElement.style.height = myHeight;
  }

  //window.alert( 'myHeight = "' + myHeight + '" divHeight = "' + divHeight + '"');

  if(divHeight < myHeight)
  {
	myHeight = myHeight + "px";
	ContentDIVelement.style.height = myHeight;
	LeftFrameElement.style.height = myHeight;
	RightFrameElement.style.height = myHeight;
  }
  //window.alert( 'myHeight = "' + myHeight + '" divHeight = "' + divHeight + '"');
}
*/