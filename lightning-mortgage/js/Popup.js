// Browser Detect  v2.1.6
// documentation: http://www.dithered.com/javascript/browser_detect/index.phpl
// license: http://creativecommons.org/licenses/by/1.0/
// code by Chris Nott (chris[at]dithered[dot]com)


function setCookie(name, value, expires, path, domain, secure)
{
    document.cookie= name + "=" + escape(value) +
        ((expires) ? "; expires=" + expires.toGMTString() : "") +
        ((path) ? "; path=" + path : "") +
        ((domain) ? "; domain=" + domain : "") +
        ((secure) ? "; secure" : "");
}

function getCookie(name)
{
    var dc = document.cookie;
    var prefix = name + "=";
    var begin = dc.indexOf("; " + prefix);
    if (begin == -1)
    {
        begin = dc.indexOf(prefix);
        if (begin != 0) return null;
    }
    else
    {
        begin += 2;
    }
    var end = document.cookie.indexOf(";", begin);
    if (end == -1)
    {
        end = dc.length;
    }
    return unescape(dc.substring(begin + prefix.length, end));
}

function BrowserDetect() {
   var ua = navigator.userAgent.toLowerCase(); 

   // browser engine name
   this.isGecko       = (ua.indexOf('gecko') != -1 && ua.indexOf('safari') == -1);
   this.isAppleWebKit = (ua.indexOf('applewebkit') != -1);

   // browser name
   this.isKonqueror   = (ua.indexOf('konqueror') != -1); 
   this.isSafari      = (ua.indexOf('safari') != - 1);
   this.isOmniweb     = (ua.indexOf('omniweb') != - 1);
   this.isOpera       = (ua.indexOf('opera') != -1); 
   this.isIcab        = (ua.indexOf('icab') != -1); 
   this.isAol         = (ua.indexOf('aol') != -1); 
   this.isIE          = (ua.indexOf('msie') != -1 && !this.isOpera && (ua.indexOf('webtv') == -1) ); 
   this.isMozilla     = (this.isGecko && ua.indexOf('gecko/') + 14 == ua.length);
   this.isFirebird    = (ua.indexOf('firebird/') != -1);
   this.isNS          = ( (this.isGecko) ? (ua.indexOf('netscape') != -1) : ( (ua.indexOf('mozilla') != -1) && !this.isOpera && !this.isSafari && (ua.indexOf('spoofer') == -1) && (ua.indexOf('compatible') == -1) && (ua.indexOf('webtv') == -1) && (ua.indexOf('hotjava') == -1) ) );
   
   // spoofing and compatible browsers
   this.isIECompatible = ( (ua.indexOf('msie') != -1) && !this.isIE);
   this.isNSCompatible = ( (ua.indexOf('mozilla') != -1) && !this.isNS && !this.isMozilla);
   
   // rendering engine versions
   this.geckoVersion = ( (this.isGecko) ? ua.substring( (ua.lastIndexOf('gecko/') + 6), (ua.lastIndexOf('gecko/') + 14) ) : -1 );
   this.equivalentMozilla = ( (this.isGecko) ? parseFloat( ua.substring( ua.indexOf('rv:') + 3 ) ) : -1 );
   this.appleWebKitVersion = ( (this.isAppleWebKit) ? parseFloat( ua.substring( ua.indexOf('applewebkit/') + 12) ) : -1 );
   
   // browser version
   this.versionMinor = parseFloat(navigator.appVersion); 
   
   // correct version number
   if (this.isGecko && !this.isMozilla) {
      this.versionMinor = parseFloat( ua.substring( ua.indexOf('/', ua.indexOf('gecko/') + 6) + 1 ) );
   }
   else if (this.isMozilla) {
      this.versionMinor = parseFloat( ua.substring( ua.indexOf('rv:') + 3 ) );
   }
   else if (this.isIE && this.versionMinor >= 4) {
      this.versionMinor = parseFloat( ua.substring( ua.indexOf('msie ') + 5 ) );
   }
   else if (this.isKonqueror) {
      this.versionMinor = parseFloat( ua.substring( ua.indexOf('konqueror/') + 10 ) );
   }
   else if (this.isSafari) {
      this.versionMinor = parseFloat( ua.substring( ua.lastIndexOf('safari/') + 7 ) );
   }
   else if (this.isOmniweb) {
      this.versionMinor = parseFloat( ua.substring( ua.lastIndexOf('omniweb/') + 8 ) );
   }
   else if (this.isOpera) {
      this.versionMinor = parseFloat( ua.substring( ua.indexOf('opera') + 6 ) );
   }
   else if (this.isIcab) {
      this.versionMinor = parseFloat( ua.substring( ua.indexOf('icab') + 5 ) );
   }
   
   this.versionMajor = parseInt(this.versionMinor); 
   
   // dom support
   this.isDOM1 = (document.getElementById);
   this.isDOM2Event = (document.addEventListener && document.removeEventListener);
   
   // css compatibility mode
   this.mode = document.compatMode ? document.compatMode : 'BackCompat';

   // platform
   this.isWin    = (ua.indexOf('win') != -1);
   this.isWin32  = (this.isWin && ( ua.indexOf('95') != -1 || ua.indexOf('98') != -1 || ua.indexOf('nt') != -1 || ua.indexOf('win32') != -1 || ua.indexOf('32bit') != -1 || ua.indexOf('xp') != -1) );
   this.isMac    = (ua.indexOf('mac') != -1);
   this.isUnix   = (ua.indexOf('unix') != -1 || ua.indexOf('sunos') != -1 || ua.indexOf('bsd') != -1 || ua.indexOf('x11') != -1)
   this.isLinux  = (ua.indexOf('linux') != -1);
   
   // specific browser shortcuts
   this.isNS4x = (this.isNS && this.versionMajor == 4);
   this.isNS40x = (this.isNS4x && this.versionMinor < 4.5);
   this.isNS47x = (this.isNS4x && this.versionMinor >= 4.7);
   this.isNS4up = (this.isNS && this.versionMinor >= 4);
   this.isNS6x = (this.isNS && this.versionMajor == 6);
   this.isNS6up = (this.isNS && this.versionMajor >= 6);
   this.isNS7x = (this.isNS && this.versionMajor == 7);
   this.isNS7up = (this.isNS && this.versionMajor >= 7);
   
   this.isIE4x = (this.isIE && this.versionMajor == 4);
   this.isIE4up = (this.isIE && this.versionMajor >= 4);
   this.isIE5x = (this.isIE && this.versionMajor == 5);
   this.isIE55 = (this.isIE && this.versionMinor == 5.5);
   this.isIE5up = (this.isIE && this.versionMajor >= 5);
   this.isIE6x = (this.isIE && this.versionMajor == 6);
   this.isIE6up = (this.isIE && this.versionMajor >= 6);
   
   this.isIE4xMac = (this.isIE4x && this.isMac);
}

var CaptureWindow="<div style='float:left;width:150px;height:200px;margin:4px 6px;'>";
CaptureWindow+="</div>";

CaptureWindow+="<div id='PopCapture' style='visibility:hidden;float:left;width:205px;height:200px;margin:4px 38px;'><form name='CaptureForm' onSubmit='if(ValidateCapture(document.CaptureForm) == false) {document.CaptureForm.Submit.value=\"Sign Up!\"; return(false);} else return(true);' style='position:relative;top:0;'";
CaptureWindow+="action='http://www.lightning-mortgage.com/pr/optin.php' method='post' style='margin:0;padding:0;'>";
CaptureWindow+="<input type='hidden' name='arid' value='176'>";
CaptureWindow+="<input type='Hidden' name='redirect' value='http://www.lightning-mortgage.com/Answers/MortgageInsiderSecretsSuccess.php'>";

CaptureWindow+="<input type='Text' name='Full_Name' maxlength='50' style='width:200px;background:#F6FFC7;' title='' tabindex='1'";
CaptureWindow+="onfocus=\"this.style.border='2px solid #f00'; if (this.value=='Enter Your First Name Here') this.value='';\" value='Enter Your First Name Here'";
CaptureWindow+="onblur=\"this.style.border='2px solid silver'; if (this.value=='') this.value='Enter Your First Name Here';\"><br /><br />";

CaptureWindow+="<input type='Text' name='Email_Address' maxlength='50' style='width:200px;background:#F6FFC7;' title='' tabindex='2'";
CaptureWindow+="onfocus=\"this.style.border='2px solid #f00'; if(this.value=='Enter Your Email Address Here') this.value='';\" value='Enter Your Email Address Here'";
CaptureWindow+="onblur=\"this.style.border='2px solid silver';if(this.value=='') this.value='Enter Your Email Address Here';\"><br /><br />";

CaptureWindow+="<input style='width:200px;font-size:medium;background:#FFDC14;color:#000;' type='submit' class='Submit' tabindex='3' value='Sign Up!' name='Submit'";
CaptureWindow+="onclick=\"this.value='One moment...'\" onMouseover=\"this.style.borderColor='#f00';\" onMouseout=\"this.style.borderColor='silver';\" onfocus='if(this.blur) this.blur();'></form>";
CaptureWindow+="</div>";
CaptureWindow+="<div style='float:left;width:150px;margin:4px 6px 0;'>";
CaptureWindow+="</div>";
CaptureWindow+="<br style='clear:both;'></div>";

function displayPOP(top, lft, link) {
 if (pngAlpha) {
  document.write('<div id="popwin" style="visibility:hidden;position:absolute;width:667px;height:240px;z-index:10;left:'+lft+'px;top:'+top+'px">');
  document.write('<div id="popwin3" style="position:relative;width:667px;height:240px;z-index:3;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\'./images/Popup.png\',sizingMethod=\'scale\');"></div>');
	} else {
  document.write('<div id="popwin" style="visibility:hidden;position:absolute;width:667px;height:240px;z-index:10;left:'+lft+'px;top:'+top+'px;">');
  document.write('<div id="popwin3" style="position:absolute;width:667px;height:240px;z-index:3;left:0;top:0;background:url(./images/Popup.png);"></div>');
  }
  
  document.write('<div id="popwin4" style="position:relative;width:667px;height:240px;z-index:4;background:url(./images/PopupY.gif);"></div>');
  document.write('<div id="popwin5" style="position:absolute;width:567px;height:240px;z-index:6;left:40px;top:30px;text-align:right;margin-right:90px"><a class="Top" href="javascript:Close();"><img src="./images/PopupX.gif" style="border:0;"></a>');

  document.write(CaptureWindow);

  document.write('  </div>');
}

function Close()
{
	var popwin = document.getElementById("popwin");
	popwin.style.visibility = 'hidden';
	popwin = document.getElementById("PopCapture");
	popwin.style.visibility = 'hidden';
}

function ShowPop()
{
	var popwin1 = document.getElementById("popwin");
	popwin1.style.visibility = 'visible';
	popwin1 = document.getElementById("PopCapture");
	popwin1.style.visibility = 'visible';
}

var browser = new BrowserDetect();
// if IE5.5+ on Win32, then display PNGs with AlphaImageLoader
if ((browser.isIE55 || browser.isIE6up) && browser.isWin32) {
	var pngAlpha = true;
// else, if the browser can display PNGs normally, then do that
} else if ((browser.isGecko) || (browser.isIE5up && browser.isMac) || (browser.isOpera && browser.isWin && browser.versionMajor >= 6) || (browser.isOpera && browser.isUnix && browser.versionMajor >= 6) || (browser.isOpera && browser.isMac && browser.versionMajor >= 5) || (browser.isOmniweb && browser.versionMinor >= 3.1) || (browser.isIcab && browser.versionMinor >= 1.9) || (browser.isWebtv) || (browser.isDreamcast)) {
	var pngNormal = true;
}

preloadImages('./images/Popup.png','./images/PopupX.gif','./images/PopupY.gif');

// Create the pop-up
// displayPOP(position_from_left, position_from_top, URL);
displayPOP(100,150, 'http://moneyclicking.net/index.php/archives/2005/10/16/cool-wow-pop-up/');

// Show Pop-Up after a few seconds after page loads
// setTimeout('ShowPop();',secs);
setTimeout('ShowPop();',1000);

// Automatically close Pop-Up a few secods after page loads
// setTimeout('Close();',secs);
//setTimeout('Close();',15000);
// / / / / / / / / / / / / / / /	//
//									//
// These routines edit user input	//
//									//
// / / / / / / / / / / / / / / /	//

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
        {        //submit = 0;
               emailflag="Valid";
        }
        else
        {
            emailflag="Not Valid";
        }

        return emailflag;

}//Ending check mail function




function ValidateCapture()
{
	var objName = document.CaptureForm;

	if((Trim(objName.Full_Name.value)=="") || (Trim(objName.Full_Name.value)=="Enter Your First Name Here"))
	{
		alert("Please enter your first name");
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