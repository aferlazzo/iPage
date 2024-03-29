// /////////////////////start function fontSizer
//
// global variables for fontSizer():
//
// This code is for using the DOM to change font sizes,
// Notice there is no 'h1','h2','h3' tags in the list on purpose! We don't
// want them to change size.

var tags = new Array('div','td','tr','p','b','table','strong','emphasis','a','pre','sub','sup','i','th','cp','ul','ol','li','dt','dd');
var pixelArray =  new Array('10','12','14','18','20','24','30');
var emArray =  new Array('0.7','0.9','1.0','1.5','2.0','2.5','3');
var getAllTags =  new Array;
var GetDIV =  new Array;
var SizeIndex = 1; // Font Size array index
var WhiteDIV = false;

//var SubString = Pathname.split("/");
var Directory;
//var PageGradient="empty";
//alert("initializing Common.js");

function fontSizer(inc,unit)
{
	//alert(inc+","+unit);

	if (!document.getElementById)
		return;

	SizeIndex += inc;

	if (SizeIndex < 0)
	{
		SizeIndex = 0;
	}
	if (SizeIndex > 3) //although the table has more entries, we don't allow the font to be that big
	{
		SizeIndex = 3;
	}

	GetDIV = document.getElementById('ContentDIV');
	//alert("Class should be 'Content': |"+GetDIV.className+"|"); // this should be  'Content'

	for (i = 0 ; i < tags.length ; i++ )
	{
		getAllTags = GetDIV.getElementsByTagName(tags[i]);

		for (k = 0 ; k < getAllTags.length ; k++)
		{
			getAllTags[k].style.fontSize = (unit=='px') ? pixelArray[SizeIndex]+unit: emArray[SizeIndex]+unit;
			//alert(getAllTags[k]);
		}
	}
}
// ///////end function fontSizer

//
//
// This code is for using the DOM to change background color of the Content
// <div>

function WhiteBackground()
{
	//alert("start of WhiteBackground()");

	if (document.styleSheets)		// if not Opera (i.e. has styleSheets)
	{
		if (document.styleSheets[0])
			var styleSheet = document.styleSheets[0];	//the first stylesheet
	}
	else
		var styleSheet = document.style;

	var AdministrativeGradient	= "url(https:\/\/host373.ipowerweb.com\/~lightnin/images\/AdministrativeGradient.gif)";
	var AnswersGradient			= "url(http:\/\/www.lightning-mortgage.com\/images\/AnswersGradient.gif)";
	var CreditScoresGradient	= "url(http:\/\/www.lightning-mortgage.com\/images\/CreditScoresGradient.gif)";
	var IndexGradient			= "url(http:\/\/www.lightning-mortgage.com\/images\/IndexGradient.gif)";
	var InterestRatesGradient	= "url(http:\/\/www.lightning-mortgage.com\/images\/InterestRatesGradient.gif)";
	var LoanAppGradient			= "url(https:\/\/host373.ipowerweb.com\/~lightnin\/images\/LoanAppGradient.gif)";
	var LoanTypesGradient		= "url(http:\/\/www.lightning-mortgage.com\/images\/LoanTypesGradient.gif)";
	var GetButton =  new Array;

	Directory = GetDirectoryName();
	//alert("Directory " + Directory);

	var AdministrativeBack	= "https:\/\/host373.ipowerweb.com/~lightnin/images/AdministrativeGradient.gif";
	var AnswersBack			= "http:\/\/www.lightning-mortgage.com/images/AnswersGradient.gif";
	var CreditScoresBack	= "http:\/\/www.lightning-mortgage.com/images/CreditScoresGradient.gif";
	var IndexBack			= "http:\/\/www.lightning-mortgage.com/images/IndexGradient.gif";
	var InterestRatesBack	= "http:\/\/www.lightning-mortgage.com/images/InterestRatesGradient.gif";
	var LoanAppBack			= "https:\/\/host373.ipowerweb.com/~lightnin/images/LoanAppGradient.gif";
	var LoanTypesBack		= "http:\/\/www.lightning-mortgage.com/images/LoanTypesGradient.gif";

	Directory = GetDirectoryName();
	PageGradient = eval(Directory+"Gradient");
	PageBack = eval(Directory+"Back");

	if (!document.styleSheets)	// if Opera (i.e. has no styleSheets object)
	{
		if (WhiteDIV == false)
		{
			WhiteDIV = true;
			document.body.bgcolor="#ffffff";
		}
		else
		{
			WhiteDIV = false;
			document.body.background=PageBack;
		}
	}
	else
	{
		if (styleSheet.rules)		// rules is incorrect DOM syntax, so change/duplicate the name
			styleSheet.cssRules = styleSheet.rules;

		//alert("styleSheet.cssRules[0].selectorText: "+styleSheet.cssRules[0].selectorText);

		if(styleSheet.cssRules[0].selectorText.toLowerCase() != "body")	// if the first selector is not BODY, we're in the stylesheet for lightning.js
			styleSheet = document.styleSheets[1];		// so go to the next stylesheet

		//alert("styleSheet.cssRules.length: "+styleSheet.cssRules.length);

		for(var x = 0;x < styleSheet.cssRules.length; x++)
		{
			if(styleSheet.cssRules[x].selectorText.toLowerCase() == "div.content")
			{
				styleSheet.cssRules[x].style.backgroundRepeat="no-repeat";

				if (WhiteDIV == true)
				{
					WhiteDIV = false;
					styleSheet.cssRules[x].style.backgroundColor="transparent";
					GetButton = document.getElementById('WhiteButton');
					//alert("Value should be 'Colorful Background': |"+GetButton.value+"|"); // this should be  'Colorful Background'
					GetButton.value = "White Background";
				}
				else
				{
					WhiteDIV = true;
					styleSheet.cssRules[x].style.backgroundColor="#ffffff";
					GetButton = document.getElementById('WhiteButton');
					//alert("Value should be 'White Background': |"+GetButton.value+"|"); // this should be  'White Background'
					GetButton.value = "Colorful Background";
				}
			}

			//document.write('styleSheet.cssRules['+x+'].selectorText'+styleSheet.cssRules[x].selectorText+'<br />');

			if(styleSheet.cssRules[x].selectorText.toLowerCase() == "div.main")
			{
				//alert("DIV.Main  backgroundImage currently |"+styleSheet.cssRules[x].style.backgroundImage+"|\nDIV.Main  Setting backgroundImage to|"+PageGradient+"|");

				styleSheet.cssRules[x].style.backgroundImage=PageGradient;

				//alert("DIV.Main  backgroundImage set to |"+styleSheet.cssRules[x].style.backgroundImage+"|");
			}
		}
	}
}

// /////// function GetDirectory

function GetDirectoryName()
{
	var Pathname = document.location.pathname;
	var Directory;
	var SubString = [,,,,,,,,];

	//alert("Pathname "+Pathname);

	if ((Pathname.indexOf("\/D:") == 0) || (Pathname.indexOf("\/C:") == 0) ||
		(Pathname.indexOf("\/d:") == 0) || (Pathname.indexOf("\/c:") == 0))	// if running on the C: or D: drive
	{
		//Pathname="/Answers/GFEExplained.php";  					//uncomment for debugging
		//Pathname="/LoanTypes/HomeBuyerSeminarSlide1.php";
		//Pathname="/Index/Financing.php"; 
		//Pathname="/MortgageApplication/OrderCreditSuccess.php";
		//Pathname="/CreditScores/ExSpouse.php";
		//Pathname="/InterestRates/EducationTaxes.php";
		//Pathname="/Administrative/Legal.php";

		if (Pathname.charAt(3) == "\\")
			SubString = Pathname.split("\\"); // for Windows Pathname
		else
			SubString = Pathname.split("/");

		Directory = '';
			
		if ((SubString[5].indexOf('index') == 0) || (SubString[5].indexOf('Index') == 0))
			Directory = 'Index';

		if (SubString[5].indexOf('Administrative') == 0)
			Directory = 'Administrative';

		if (SubString[5].indexOf('LoanTypes') == 0)
			Directory = 'LoanTypes';

		if (SubString[5].indexOf('CreditScores') == 0)
			Directory = 'CreditScores';

		if (SubString[5].indexOf('InterestRates') == 0)
			Directory = 'InterestRates';

		if (SubString[5].indexOf('Answers') == 0)
			Directory = 'Answers';

		if ((Directory =='') && (SubString[6]))
		{
			if ((SubString[6].indexOf('index') == 0) || (SubString[6].indexOf('Index') == 0))
				Directory = 'Index';

			if (SubString[6].indexOf('Administrative') == 0)
				Directory = 'Administrative';

			if (SubString[6].indexOf('LoanTypes') == 0)
				Directory = 'LoanTypes';

			if (SubString[6].indexOf('CreditScores') == 0)
				Directory = 'CreditScores';

			if (SubString[6].indexOf('InterestRates') == 0)
				Directory = 'InterestRates';

			if (SubString[6].indexOf('Answers') == 0)
				Directory = 'Answers';
		}

	}
	else	// if on a real web page
	{
		SubString = Pathname.split("/");
		Directory = SubString[1];
	}
	
	//alert("Pathname: |"+Pathname+"|\nSubString[2]: |"+SubString[2]+"|\nSubString[3]: |"+SubString[3]+"|\nSubString[4]: |"+SubString[4]+"|");
	if ((Directory == "MortgageApplication") || (SubString[2] == "MortgageApplication") || 
		(SubString[3] == "MortgageApplication") || (SubString[4] == "MortgageApplication") ||
		(SubString[5] == "MortgageApplication") || (SubString[6] == "MortgageApplication"))	// with secure server (https:) SubString[1]="~lightnin"
		Directory = "LoanApp";

	// For all pages EXCEPT the homebuyer slides
	
	if ((SubString[2] != null) && (SubString[2].substring(0, 21) == "HomeBuyerSeminarSlide"))
	{
		var Slide = SubString[2].substring(21, 23);

		if (Slide < 13)
			Directory = 'Administrative';

		if ((Slide > 12) && (Slide < 21))
			Directory = 'LoanTypes';

		if ((Slide > 20) && (Slide < 26))
			Directory = 'Index';

		if (Slide > 25)
			Directory = 'Answers';
	}
	else
	{
		switch (SubString[1])
		{
			case 'Index': Directory = 'Index';
			break;

			case 'Administrative': Directory = 'Administrative';
			break;

			case 'LoanTypes': Directory = 'LoanTypes';
			break;

			case 'LoanApp': Directory = 'LoanApp';
			break;

			case 'CreditScores': Directory = 'CreditScores';
			break;

			case 'InterestRates': Directory = 'InterestRates';
			break;

			case 'Answers': Directory = 'Answers';
			break;
		}
	}

	if ((Directory.indexOf(".php") != -1) || (Directory.indexOf(".php") != -1))
		Directory = Directory.slice(0, Directory.length - 4); //eliminate the trailing ".php"

	if ((Directory=="index") || (Pathname == "\/"))
		Directory="Index";

	if ((Directory=="LAPS") || (SubString[2] == "LAPS") || (Directory == "404"))
		Directory="Administrative";

	return (Directory);
}

// This code frames the common top heading with an appropriately colored
// frame. Controls for allowing IE browsers to paint the background color
// white and to resize the content font are also available.

function WriteTopFrame()
{
	if (document.styleSheets)		// if not Opera (i.e. has styleSheets)
	{
		if (document.styleSheets[0])
			var styleSheet = document.styleSheets[0];	//the first stylesheet
	}
	else
		var styleSheet = document.style;

	var GetHtml = new Array;
	var Directory;
	var AdministrativeGradient	= "url(https:\/\/host373.ipowerweb.com/~lightnin/images/AdministrativeGradient.gif)";
	var AnswersGradient			= "url(http:\/\/www.lightning-mortgage.com/images/AnswersGradient.gif)";
	var CreditScoresGradient	= "url(http:\/\/www.lightning-mortgage.com/images/CreditScoresGradient.gif)";
	var IndexGradient			= "url(http:\/\/www.lightning-mortgage.com/images/IndexGradient.gif)";
	var InterestRatesGradient	= "url(http:\/\/www.lightning-mortgage.com/images/InterestRatesGradient.gif)";
	var LoanAppGradient			= "url(https:\/\/host373.ipowerweb.com/~lightnin/images/LoanAppGradient.gif)";
	var LoanTypesGradient		= "url(http:\/\/www.lightning-mortgage.com/images/LoanTypesGradient.gif)";

	var AdministrativeBack	= "https:\/\/host373.ipowerweb.com/~lightnin/images/AdministrativeGradient.gif";
	var AnswersBack			= "http:\/\/www.lightning-mortgage.com/images/AnswersGradient.gif";
	var CreditScoresBack	= "http:\/\/www.lightning-mortgage.com/images/CreditScoresGradient.gif";
	var IndexBack			= "http:\/\/www.lightning-mortgage.com/images/IndexGradient.gif";
	var InterestRatesBack	= "http:\/\/www.lightning-mortgage.com/images/InterestRatesGradient.gif";
	var LoanAppBack			= "https:\/\/host373.ipowerweb.com/~lightnin/images/LoanAppGradient.gif";
	var LoanTypesBack		= "http:\/\/www.lightning-mortgage.com/images/LoanTypesGradient.gif";

	Directory = GetDirectoryName();
	PageGradient = eval(Directory+"Gradient");
	PageBack = eval(Directory+"Back");

	if ((Directory != "none") &&
		(Directory != "Administrative") &&
		(Directory != "Answers") &&
		(Directory != "LoanTypes") &&
		(Directory != "LoanApp") &&
		(Directory != "InterestRates") &&
		(Directory != "Index") &&
		(Directory != "CreditScores"))
	{
		Directory="Administrative";
	}

	if ((Directory == "Answers") || (Directory == "InterestRates") ||
		 (Directory == "Index")	 || (Directory == "CreditScores")  ||
		 (Directory == "LoanTypes") || (Directory == "Administrative")|| (Directory == "LoanApp"))
	{
		document.write('<div class="' + Directory + 'TopFrame">'); 	//external frame
		document.write('<div class="' + Directory + 'TopFrameLeft">');  //internal frame

    // This code isn't run on a secure server page 

  		if (window.location.href.substring(0,5)!="https")
		{
			document.write('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://edit.yahoo.com/config/send_webmesg?.target=tucson94588&.src=pg">');
			document.write('<img border=0 src="http://opi.yahoo.com/online?u=tucson94588&m=g&t=2"></a>');
		}

		//ShowURLPath();

		document.write('<\/div><div class="' + Directory + 'TopFrameRight">');

		// don't show buttons on Macintoshes, older Netscape, Opera
		var ns_lightning = document.all || document.layers || navigator.userAgent.toLowerCase().indexOf("mac") != -1;

		// if (!ns_lightning)
		{
			document.write('<input style="width: 110px; font-size: xx-small;" id="WhiteButton" type="button" class="Submit' + Directory + '"');
			document.write('value="White Background" title="Remove/Adds the background color on this page" onClick="QuakeMe(); WhiteBackground();">&nbsp; &nbsp;');

			document.write('<input style="height: 20px; width: 20px; line-height: 85%; font-size: 16px;" type="button" class="Submit' + Directory + '"');
			document.write('value="+" title="Increase font size" onClick="fontSizer(1,\'px\');">&nbsp; &nbsp;');
			document.write('<input style="height: 20px; width: 20px; line-height: 85%; font-size: 16px;" type="button" class="Submit' + Directory + '"\n');
			document.write('value="-" title="Decrease font size" onClick="fontSizer(-1,\'px\');">');
		}

		document.write('<\/div><br clear="all"><\/div>'); // end of TopFrameRight and TopFrame div

		if (!document.styleSheets)	// if Opera (i.e. has no styleSheets object)
		{
			//alert("body.background: "+document.body.background);
			document.body.background=PageBack;
			//alert("body.background: "+document.body.background);
		}
		else
		{
			if (styleSheet.rules)		// rules is incorrect DOM syntax, so change/duplicate the name
				styleSheet.cssRules = styleSheet.rules;
		
			for(var x = 0;x < styleSheet.cssRules.length; x++)
			{
				// document.write("styleSheet.cssRules["+x+"] |"+styleSheet.cssRules[x].selectorText+"<br />\n");

				if(styleSheet.cssRules[x].selectorText.toLowerCase() == "div.main")
				{
					//alert("DIV.Main  backgroundImage currently |"+styleSheet.cssRules[x].style.backgroundImage+"|\nDIV.Main  Setting backgroundImage to|"+PageGradient+"|");

					styleSheet.cssRules[x].style.backgroundImage=PageGradient;
					//alert("PageGradient: "+PageGradient);
					//alert("DIV.Main  backgroundImage set to |"+styleSheet.cssRules[x].style.backgroundImage+"|");
				}
			}
		}
	}
}

// /// end WriteTopFrame

// ~ ~ ~ ~ ~
//
// Shake the screen
//
// ~ ~ ~ ~ ~
function QuakeMe()
{
	if (parent.moveBy)
	{
		for (i=16; i>0; i--)
		{
			parent.moveBy(0,i);
			parent.moveBy(i,0);
			parent.moveBy(0,-i);
			parent.moveBy(-i,0);
		}
	}
}

// ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~
//
// display the path in the top frame
//
// ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~

function ShowURLPath()
{
	var path = "";
	var href = document.location.href;
	var SubString = href.split("/");

	// example href: http://www.lightning-mortgage.com/CreditScores.php
	// SubString[0]: 'http:'
	// SubString[1]: ''
	// SubString[2]: ''
	// SubString[3]: 'www.lightning-mortgage.com'
	// SubString[4]: 'CreditScores.php'

	for (var i = 3; i < (SubString.length-1); i++)
	{	
		path+="<A class='Top' HREF='"+href.substring(0,href.indexOf(SubString[i])+SubString[i].length)+"/'>";

		if(SubString[i]=="~lightnin")
			path+="Secure Server for www.lightning-mortgage.com";
		else
			path+=SubString[i];

		path+="</A> <span style='font-weight: bold;'>-></span> ";
	}

	i=SubString.length-1; /* number of SubStrings */

	path+="<A class='Top' HREF=\""+href.substring(0,href.indexOf(SubString[i])+SubString[i].length)+"\">"+SubString[i]+"</A>";
	//var url = window.location.protocol + "//" + path;
	var url = path;
	document.write("<span style='text-align: center; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: x-small;'>"+url+"</span>");
}

// . . . . . . For Atomz Search 

function isBlank() {
value=document.Atomz.elements['sp-q'].value;

//alert ("The value is |"+value+"|");

if ((value.indexOf("Your search word(s)")==-1) && (value != ""))
	return true;
else
	return false;
}

// . . . . . For Testimonials

userString = new Array();
userString[0] = "It was great how you kept me informed as to the status of my refinancing, and the transaction was completed in a timely and flawless manner.<br />-Laury L.";
userString[1] = "We received personal and speedy responses and now have a nice low interest rate.<br />-Catherine and Harlan T.";
userString[2] = "I appreciate your efforts and candor; please feel free to have any future clients contact me regarding your integrity.<br />-Matthew M.";
userString[3] = "I just wanted to thank you for all your hard work.  I'm so glad to pay off most of my bills...what a relief ! When I need another mortgage, I will contact you.<br />-Evelyn K.";
userString[4] = "Thank you for everything on this loan - it has all been pretty smooth and we are happy with our financing and closing!!! You guys do a great job!!</br />-Tricia and Carl S.";
userString[5] = "I must commend you for your professionalism and diligence.  Kudos to you and keep up the great work. You solved all my problems!<br />- Joe B.";
userString[6] = "First of all the information I got from the website was the most up front detailed info that I have seen. It answered all my questions.  Thanks for being there.<br />-Stephanie D.";

currentString = 0;
activeColor = 254;

isIE = document.all; //navigator.userAgent.indexOf('MSIE');
isIE>-1?delay=4:delay=300;

var hexValues = new Array('00','01','02','03','04','05','06','07','08','09','0A','0B','0C','0D','0E','0F','10','11','12','13','14','15','16','17','18','19','1A','1B','1C','1D','1E','1F','20','21','22','23','24','25','26','27','28','29','2A','2B','2C','2D','2E','2F','30','31','32','33','34','35','36','37','38','39','3A','3B','3C','3D','3E','3F','40','41','42','43','44','45','46','47','48','49','4A','4B','4C','4D','4E','4F','50','51','52','53','54','55','56','57','58','59','5A','5B','5C','5D','5E','5F','60','61','62','63','64','65','66','67','68','69','6A','6B','6C','6D','6E','6F','70','71','72','73','74','75','76','77','78','79','7A','7B','7C','7D','7E','7F','80','81','82','83','84','85','86','87','88','89','8A','8B','8C','8D','8E','8F','90','91','92','93','94','95','96','97','98','99','9A','9B','9C','9D','9E','9F','A0','A1','A2','A3','A4','A5','A6','A7','A8','A9','AA','AB','AC','AD','AE','AF','B0','B1','B2','B3','B4','B5','B6','B7','B8','B9','BA','BB','BC','BD','BE','BF','C0','C1','C2','C3','C4','C5','C6','C7','C8','C9','CA','CB','CC','CD','CE','CF','D0','D1','D2','D3','D4','D5','D6','D7','D8','D9','DA','DB','DC','DD','DE','DF','E0','E1','E2','E3','E4','E5','E6','E7','E8','E9','EA','EB','EC','ED','EE','EF','F0','F1','F2','F3','F4','F5','F6','F7','F8','F9','FA','FB','FC','FD','FE','FF');

function fadeText(direction)
{
	document.getElementById("Testimonial").innerHTML = userString[currentString];
	document.getElementById("Testimonial").style.color = hexValues[activeColor] + hexValues[activeColor] + hexValues[activeColor];
	if(direction)
	{
		activeColor -=10;
		if(activeColor<=0)
		{
			activeColor=0;
			clearInterval(fadeInterval);
			fadeInterval = setInterval("fadeText(" +0 + ")",delay);
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
			if(currentString == userString.length) currentString=0;
				fadeInterval = setInterval("fadeText(" + 1 + ")",delay);
		}
	}
}

/* . . .. */

function AddFavorite()
{
	window.external.AddFavorite('http:\/\/www.lightning-mortgage.com','Lightning Mortgage - Good or bad credit, no problem')
}

var debugging = false;


function UpdateCookie(Setting)
{
	XX = 'SavedFilter=' + Setting;
	document.cookie=XX;
	/*alert("SavedFilter cookie set to " + Setting);*/
	return(true);
}

//
//	GetMyValue: Retrieve the value of a cookie and return the value	
//

function GetMyValue (CookieName)
{
	var Name, Value;
	var Beginning, Middle, End;

	//alert ("GetMyValue() was passed CookieName=" + CookieName);

	//if there is an entry for this cookie show it to me
	Beginning = 0;

	while (Beginning < document.cookie.length)
	{
		// find the next equals sign
		Middle = document.cookie.indexOf('=', Beginning);

		// find the next semicolon
		End = document.cookie.indexOf(';', Beginning);

		if (End == -1)	// if no semicolon exists, it's the last cookie...
			End = document.cookie.length;

		// if nothing is in the cookie, blank out it's value
		if ((Middle > End) || (Middle == -1))
		{
			Name = document.cookie.substring(Beginning, End);
			Value = "";
		}
		else
		{
			//extract the Name and value
			Name = document.cookie.substring(Beginning, Middle);
			Value = document.cookie.substring(Middle + 1, End);
		}
		// add the cookie to the associative array
		cookies[Name] = unescape(Value);
		// jump over the next space to the Beginning of next cookie
		Beginning = End + 2;
	}

	//alert('GetMyValue() returns --> cookies[' + CookieName + ']=' + cookies[CookieName]);
	return(cookies[CookieName]);
}

/******  **************/

function doClock()
{
	var t=new Date();
	var a=doClock.arguments,str="";
	var i,a1,lang="1";
	var month=new Array('January','Jan', 'February','Feb', 'March','Mar', 'April','Apr', 'May','May', 'June','Jun', 'July','Jul', 'August','Aug', 'September','Sep', 'October','Oct', 'November','Nov', 'December','Dec');
	var tday= new Array('Sunday','Sun','Monday','Mon', 'Tuesday','Tue', 'Wednesday','Wed','Thursday','Thr','Friday','Fri','Saturday','Sat');
  
	for(i=0;i<a.length;i++) 
	{
		a1=a[i].charAt(1);
		switch (a[i].charAt(0)) 
		{
  			case "M":
  				if ((Number(a1)==3) && ((t.getMonth()+1)<10)) 
  					str+="0";
  				str+=(Number(a1)>1)?t.getMonth()+1:month[t.getMonth()*2+Number(a1)];
  				break;

			case "D": 
				if ((Number(a1)==1) && (t.getDate()<10)) 
					str+="0";
				str+=t.getDate();
				break;

			case "Y": 
				str+=(a1=='0')?t.getFullYear():t.getFullYear().toString().substring(2);
				break;

			case "W":
				str+=tday[t.getDay()*2+Number(a1)];
				break; 

			default: str+=unescape(a[i]);
		}
	}
	return str;
}

// associative array indexed as cookies["Name"] = "Value"

var cookies = new Object();

function GetCookies (PrintThem)
{
	var Name, Value;
	var Beginning, Middle, End;

	//if there are currently entries in cookies show them to me
	Beginning = 0;

	while (Beginning < document.cookie.length)
	{
		// find the next equals sign
		Middle = document.cookie.indexOf('=', Beginning);

		// find the next semicolon
		End = document.cookie.indexOf(';', Beginning);

		if (End == -1)	// if no semicolon exists, it's the last cookie...
			End = document.cookie.length;

		// if nothing is in the cookie, blank out it's value
		if ((Middle > End) || (Middle == -1))
		{
			Name = document.cookie.substring(Beginning, End);
			Value = "";
		}
		else
		{
			//extract the Name and value
			Name = document.cookie.substring(Beginning, Middle);
			Value = document.cookie.substring(Middle + 1, End);

			if (PrintThem == 'y')
			{
				document.writeln('Cookie Name=' + Name + ' Value= |' + unescape(Value) + '|\n');
			}
			else
			{
				alert('Cookie Name=' + Name + ' Value= |' + unescape(Value) + '|');
			}
		}
		// add the cookie to the associative array
		cookies[Name] = unescape(Value);
		// jump over the next space to the Beginning of next cookie
		Beginning = End + 2;
	}

}

function AtStartCookies()
{
	//GetCookies();
	User		= GetMyValue('User');
	//alert("User=" + User);
	SavedFilter 	= GetMyValue('SavedFilter');
	//alert("SavedFilter=" + SavedFilter);
	Password	= GetMyValue('Password');
	//alert("Password=" + Password);
	SortColumn	= GetMyValue('SortColumn');
	//alert("SortColumn=" + SortColumn);
	SearchTerm	= GetMyValue('SearchTerm');
	//alert("SearchTerm=" + SearchTerm);
	MyValue 	= GetMyValue('SavedFilter');
	//alert("MyValue=" + MyValue);

	FromDate 	= GetMyValue('FromDate');
	//alert("FromDate=" + FromDate);
	FromMonth	= GetMyValue('FromMonth');
	//alert("FromMonth=" + FromMonth);
	FromDay	 	= GetMyValue('FromDay');
	//alert("FromDay=" + FromDay);
	FromYear	= GetMyValue('FromYear');
	//alert("FromYear=" + FromYear);

	ToDate	 	= GetMyValue('ToDate');
	//alert("ToDate=" + ToDate);
	ToMonth	 	= GetMyValue('ToMonth');
	//alert("ToMonth=" + ToMonth);
	ToDay	 	= GetMyValue('ToDay');
	//alert("ToDay=" + ToDay);
	ToYear	 	= GetMyValue('ToYear');
	//alert("ToYear=" + ToYear);

	DateRange	 = GetMyValue('DateRange');
	//alert("DateRange=" + DateRange);

	UpdatedBy 	= GetMyValue('UpdatedBy');
	//alert("UpdatedBy=" + UpdatedBy);
	CommentLimit 	= GetMyValue('CommentLimit');
	//alert("CommentLimit=" + CommentLimit);

	Page	 	= GetMyValue('Page');
	//alert("Page=" + Page);
	LastApplicantPrinted	 	= GetMyValue('LastApplicantPrinted');
	//alert("LastApplicantPrinted=" + LastApplicantPrinted);
	CommentsOtApplicantPrinted	 	= GetMyValue('CommentsOtApplicantPrinted');
	//alert("CommentsOtApplicantPrinted=" + CommentsOtApplicantPrinted);

}



//
//
//	Exit Survey handler: First check for the cookie, WebVisitorAlreadyRegistered.
//	If cookie is NOT set to 1 AND we are exiting the website, display the survey.
//
//

function ExitPage()
{
	var Page = "http:\/\/www.lightning-mortgage.com/Administrative/ExitSurvey.php";

	//alert("Exit=" + Exit);

	var HereBefore=GetMyValue("WebVisitorAlreadyRegistered");

	//alert("HereBefore=" + HereBefore);

	if((Exit==true) && (HereBefore != 1))
	{
		if (confirm("Would you like to participate in a brief\n3-question Lightning Mortgage survey?\nIf so, a survey will pop-up."))
		{
			document.cookie = "WebVisitorAlreadyRegistered=1; expires=Fri, 31 Dec 2006 23:59:59 GMT; ";

			var NewWin=window.open(Page, "NewWin", "width=725,height=590,scrollbars=yes,menubar=no");
			NewWin.window.focus();
			//<a href=Page target="_blank">
		}
	}
}

//
//
//	Review the Standard Documnent Object Model for Javascript Event Handler background
//
//	HighlightPageRow: This is an event handler for mouse clicking, depending on theAction. When the
//	mouse passes over the row this handler controls, the color of the cells in the row are changed
//	to thePointerColor. When the area is clicked, the color of the cells change to theMarkedColor.
//	When a marked row is clicked on a second time, the color of the cells is reset to theDefaultColor.
//
//	All major browsers are supported.
//
//

function HighlightPageRow(theRow, theRowNumber, theAction, theDefaultColor, thePointerColor, theMarkColor)
{

/**
 * This array is used to remember mark status of rows in browse mode
 */
	var markedRow = new Array;
	var linkNumber = 13 + theRowNumber;
	//alert ("document.links[" + linkNumber + "] " + document.links[linkNumber]);

	//alert("theDefaultColor:" + theDefaultColor + " thePointerColor:" + thePointerColor + " theMarkColor:" + theMarkColor);
	var theCells = null;

	// 1. Pointer and mark feature are disabled or the browser can't get the
	//	row -> exits
	if ((thePointerColor == '' && theMarkColor == '') || typeof(theRow.style) == 'undefined')
	{
		alert("Exit 1");
		return -1;
	}

	// 2. Gets the current row and exits if the browser can't get it
	if (typeof(document.getElementsByTagName) != 'undefined')
	{
		theCells = theRow.getElementsByTagName('td');
	}
	else if (typeof(theRow.cells) != 'undefined')
	{
		theCells = theRow.cells;
	}
	else
	{
		alert("Exit 2");
		return -1;
	}

	// 3. Gets the current color...
	var rowCellsCount = theCells.length;
	var domDetect	 = null;
	var currentColor  = null;
	var newColor	  = null;

  // 3.1 ... with DOM compatible browsers except Opera that does not return
	//		 valid values with "getAttribute"
	if (typeof(window.opera) == 'undefined'  && typeof(theCells[1].getAttribute) != 'undefined')
	{
		currentColor = theCells[1].getAttribute('bgcolor'); //we don't want to use the gray color of column 0
		domDetect	= true;
	}
	// 3.2 ... with other browsers
	else
	{
		currentColor = theCells[1].style.backgroundColor; //we don't want to use the gray color of column 0
		domDetect	= false;
	} // end 3

	//alert("domDetect " + domDetect);
	//alert("currentColor:" + currentColor + " theDefaultColor:" + theDefaultColor + " thePointerColor:" + thePointerColor + " theMarkColor:" + theMarkColor);

	// 4. Defines the new color
	// 4.1 If Current color is null or the current color equals the default color
	if (currentColor == '' || currentColor.toLowerCase() == theDefaultColor.toLowerCase())
	{
		//alert("theAction:" + theAction);

		if (theAction == 'over' && thePointerColor != '') //if it is a mouseover and thePointerColor is not empty
		{
			newColor			  = thePointerColor;  //use the pointer color
			//alert("4.1 over, newColor:" + newColor);
		}
		else if (theAction == 'click' && theMarkColor != '') //if the mouse was clicked and the line was marked
		{
			newColor			  = theMarkColor;
			markedRow[theRowNumber] = true;

			//alert("4.1 click, newColor else:" + newColor);
		}

	  // don't set current color

	}

	// 4.1.2 Current color is the pointer one
	else if (currentColor.toLowerCase() == thePointerColor.toLowerCase()
			 && (typeof(markedRow[theRowNumber]) == 'undefined' || !markedRow[theRowNumber]))
	{
		//alert("theAction:" + theAction);

		if (theAction == 'out')
		{
			  newColor			  = theDefaultColor; // if the row is set to pointerColor and not marked OR marked already
			  //alert("4.1.2 out, newColor:" + newColor);
		}
		else if (theAction == 'click' && theMarkColor != '')
		{
			newColor			  = theMarkColor;
			markedRow[theRowNumber] = true;
			location.href=document.links[linkNumber];  //transfer control to the page referenced by the link on the clicked row
			//alert("4.1.2 click, newColor else:" + newColor);
		}
	}

	// 4.1.3 Current color is the marker one
	else if (currentColor.toLowerCase() == theMarkColor.toLowerCase())
	{
		if (theAction == 'click')
		{
			newColor	= (thePointerColor != '')	//expression: if there is a pointer color
						? thePointerColor	   	//if true, use this value
						: theDefaultColor;		//if false, use this value

			markedRow[theRowNumber] = (typeof(markedRow[theRowNumber]) == 'undefined' || !markedRow[theRowNumber])
						? true
						: null;
			//alert("4.1.3 newColor:" + newColor);
		}
	} // end 4

	// 5. Sets the new color...
	if (newColor)
	{
		//rowCellsCount = 3; //this will limit the change of background color to column 3
		//alert("Number of cells in row is: " + theCells.length);

		var c = 0;
		// 5.1 ... with DOM compatible browsers except Opera
		if (domDetect)
		{
			for (c = 0; c < rowCellsCount; c++)
			{
				theCells[c].setAttribute('bgcolor', newColor, 0); // change background color
			} // end for loop
		}
		// 5.2 ... with other browsers
		else
		{
			for (c = 0; c < rowCellsCount; c++)
			{
				theCells[c].style.backgroundColor = newColor;
			}
		}
	} // end 5

} // end of the 'HighlightPageRow()' function
