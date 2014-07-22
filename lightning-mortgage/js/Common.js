function preloadImages() {
  var d=document; if(d.images){ if(!d.p) d.p=new Array();
    var i,j=d.p.length,a=preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.p[j]=new Image; d.p[j++].src=a[i];}}
}

var d=document;
var P=window.location.pathname;
//alert("P: "+P); 
var L=P.length;
var tail=P.substring(10,L);
var K=L - 16;
Names=P.split('/');

uriIndex=Names.length - 1;
uriDirectory = Names.length - 2;

//alert('Directory: |' + Names[uriDirectory] + '| uri: |' + Names[uriIndex]+'| table size: '+ Names.length);
//for (i=0;i<Names.length;i++)
//	alert('|'+Names[i]+'|');


if(Names[uriDirectory] == 'MortgageApplication')
	Names[uriDirectory] = 'ApplyNow';
else
if((Names[uriDirectory] == 'Index') || (Names[uriIndex] == 'index.php') || (Names[uriIndex] == ''))
	Names[uriDirectory] = 'Index';
else	
if(Names[uriIndex] == 'CreditScores.php')
	Names[uriDirectory] = 'CreditScores';
else
if(Names[uriIndex] == 'Answers.php')
	Names[uriDirectory] = 'Answers';
else
if(Names[uriIndex] == 'LoanTypes.php')
	Names[uriDirectory] = 'LoanTypes';
else
if(Names[uriIndex] == 'InterestRates.php')
	Names[uriDirectory] = 'InterestRates';

if((Names[uriDirectory] != 'Administrative') && (Names[uriDirectory] != 'lightning-mortgage.com'))
	document.getElementById(Names[uriDirectory]).className=Names[uriDirectory];

function SetContentHeight() 
{
  myHeight = 0;
  var LeftFrameElement, RightFrameElement;

  LeftFrameElement = document.getElementById("LeftFrame");
  RightFrameElement = document.getElementById("RightFrame");
  ContentDIVelement = document.getElementById("ContentDIV");
  
	myHeight = ContentDIVelement.offsetHeight + "px";
	//alert(myHeight);
	ContentDIVelement.style.height = myHeight;
	LeftFrameElement.style.height = myHeight;
	RightFrameElement.style.height = myHeight;
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
