var d_lightning;
var ns_lightning = document.layers || navigator.userAgent.toLowerCase().indexOf("mac") != -1; // don't do on Macintoshes
var ns6_lightning = (!document.all && document.getElementById) ? true : false;
var debug = false;
if (ns6_lightning && !debug)
{
	document.write('<div style="position: relative;z-index:1">');
}

// / / / / / / / / / / / / / / / / / / 	//
//	
//	This is the draggable_window table HTML & contents.
//										//
// / / / / / / / / / / / / / / / / / /	//

var CaptureWindow="<div id='CaptureDiv' style='margin:0 auto;width:660px;height:160px;'";
CaptureWindow+="'><b class='top'><b class='b1'></b><b class='b2'></b><b class='b3'></b><b class='b4'></b></b>\n";
CaptureWindow+="<div style='margin-left:1px;border-right:4px solid #060;border-left:4px solid #060;padding:10px;width:630px;'>";
CaptureWindow+="<div style='float:left;width:188px;margin:6px;'>";
CaptureWindow+="<p style='text-align:left;'>Sign up to receive our FREE ";
CaptureWindow+="14-part email course 'Mortgage Insider Secrets' ";
CaptureWindow+="<span class='Highlight'>and save thousands</span> ";
CaptureWindow+="on your next mortgage!</p></div>";

CaptureWindow+="<div style='float:left;width:205px;margin:6px;'><form name='CaptureForm' onSubmit='if(ValidateCapture(document.CaptureForm) == false) {document.CaptureForm.Submit.value=\"Sign Up!\"; return(false);} else return(true);' style='position:relative;top:0;'";
CaptureWindow+="action='http://www.lightning-mortgage.com/pr/optin.php' method='post'style='margin:0;'>";
CaptureWindow+="<p style='line-height:80%;'>";
CaptureWindow+="<input type='hidden' name='arid' value='2'>";
CaptureWindow+="<input type='Hidden' name='redirect' value='http://www.lightning-mortgage.com/Answers/MortgageInsiderSecretsSuccess.php'>";

CaptureWindow+="<input type='Text' name='Full_Name' maxlength='50' style='width:200px;background:#9fc;' title=''";
CaptureWindow+="onfocus=\"this.style.border='2px solid #3F7551'; if (this.value=='Enter Your First Name Here') this.value='';\" value='Enter Your First Name Here'";
CaptureWindow+="onblur=\"this.style.border='2px solid silver'; if (this.value=='') this.value='Enter Your First Name Here';\"><br /><br />";

CaptureWindow+="<input type='Text' name='Email_Address' maxlength='50' style='width:200px;background:#9fc;' title=''";
CaptureWindow+="onfocus=\"this.style.border='2px solid #3F7551'; if(this.value=='Enter Your Email Address Here') this.value='';\" value='Enter Your Email Address Here'";
CaptureWindow+="onblur=\"this.style.border='2px solid silver';if(this.value=='') this.value='Enter Your Email Address Here';\"><br /><br />";

CaptureWindow+="<input style='width:200px;font-size:medium;' type='submit' class='Submit' value='Sign Up!' name='Submit'";
CaptureWindow+="onclick=\"this.value='One moment...'\" onMouseover=\"this.className='MouseOver'\" onMouseout=\"this.className='Submit'\" onfocus='if(this.blur) this.blur();'></p></form>";
CaptureWindow+="</div>";
CaptureWindow+="<div style='float:left;width:188px;margin:6px;'>";
CaptureWindow+="<p style='text-align:left;'>Rest assured, we respect your ";
CaptureWindow+="privacy and will not give your email address to anyone under any circumstance.</p>";
CaptureWindow+="</div>";
CaptureWindow+="<br style='clear:both;'></div>";
CaptureWindow+="<b class='bottom'><b class='b4'></b><b class='b3'></b><b class='b2'></b><b class='b1'></b></b></div>";
CaptureWindow+="</div>";

var title_lightning = '  From Lightning Mortgage: Mortgage Insider Secrets Sign-Up';

// This sets up IE browsers so that on mousedown events the drags_lightning()
// function is executed, and when a mouseup event occurs the drags_lightning
// variable is set to false.

if (!ns_lightning)
{
	document.onmousedown = drags_lightning;
	document.onmouseup = new Function("drag_lightning=false");
}




var cookie_lightning="InsidersSecrets";
var drag_lightning = false, x_lightning, y_lightning, a_lightning, b_lightning;

// / / / / / / / / / / / / / / / / / / / / / / /	//
//													//
// move() A mousedown event occurred. reposition  	//
// the X and Y coordinates of the window.			//
//													//
// / / / / / / / / / / / / / / / / / / / / / / /	//

function move(e)
{
	if (drag_lightning)
	{
		left_lightning = ns6_lightning ? a_lightning + e.clientX - x_lightning : a_lightning + event.clientX - x_lightning;
		optinover.style.left = left_lightning;
		top_lightning = ns6_lightning ? b_lightning + e.clientY - y_lightning : b_lightning + event.clientY - y_lightning - document.body.scrollTop;
		optinover.style.top = top_lightning + (ns6_lightning ? 0 : document.body.scrollTop);
		shadow.style.left = left_lightning + 0;
		shadow.style.top = top_lightning+(ns6_lightning ? 0 : document.body.scrollTop) + 0;
		return false;
	}
}

// / / / / / / / / / / / / / / / / / / / / / / / / / / / / / / / / / /	//
//																		//
// drags_lightning() A mousedown event occurred. If the click is on the //
// draggable_window, call the move function.							//
//																		//
// / / / / / / / / / / / / / / / / / / / / / / / / / / / / / / / / / /	//

function drags_lightning(e)
{
	if (!document.all && !ns6_lightning)	// document.all is a collection used by IE browsers of all the HTML elements in the document.
	return false;					// ns6_lightning  tells us this is a Netscape Navigator document

	var obj_lightning = ns6_lightning ? e.target : event.srcElement; // capture the source of the event in a variable
	var topelement = ns6_lightning ? "HTML" : "BODY"; // each browser has a different top element IE: body, NS: html
	
	// chain through the elements until you reach the top, or the class = draggable_window
	
	if(obj_lightning.parentElement != undefined) // if the parentElement is undefined, someone clicked on scrollbar or somewhere not in document 
	{
		while ((obj_lightning.tagName != undefined) && (obj_lightning.tagName!=topelement) && (obj_lightning.className!="draggable_window"))
		{
			if (obj_lightning.parentElement == undefined)
				obj_lightning = ns6_lightning ? "HTML" : "BODY";
			else
				obj_lightning = ns6_lightning ? obj_lightning.parentNode : obj_lightning.parentElement;

			//alert("obj_lightning.className |"+obj_lightning.className+"|");
			//alert("obj_lightning.tagName |"+obj_lightning.tagName+"|");
		}
	}
	
	// if the click is on an element within the draggable_window, then capture the current location and move the draggable_window
	
	if (obj_lightning.className == "draggable_window") /* if someone clicked on an element with the class=="draggable_window" */
	{
		drag_lightning = true;
		a_lightning = parseInt(optinover.style.left + 0);
		b_lightning = parseInt(optinover.style.top + 0);
		x_lightning = ns6_lightning ? e.clientX : event.clientX;
		y_lightning = ns6_lightning ? e.clientY : event.clientY;
		document.onmousemove = move;
		return false;
	}
	return true;
}

// create_lightning() creates the draggable_window optinover division and frame that holds the draggable windows.

function create_lightning(doc)
{
	d_lightning = (doc ? doc : document);

	if(ns6_lightning && !debug)
	{
		d_lightning.write('</div>');
	}
	d_lightning.write('<div id="shadow" style="position:absolute;visibility:hidden;display:none;z-index:0;">&nbsp;</div>');
	d_lightning.write('<div id="optinover" class="draggable_window" style="visibility:hidden; position:absolute; z-index:100; width:250px; overflow:hidden;">');
	d_lightning.write('<table id="optinoverTable" width="660" align="left" valign="top" cellpadding="0" cellspacing="0" border="0" bgcolor="#FFFFFF" style="cursor:move;background-color:#FFFFFF;border-style:solid;border-width:2;border-color:#003399;">');
	d_lightning.write('<tr><td width=100% bgcolor="#006600" height=26><font style="font-family:Arial,verdana; font-size:13px; color:#ffffff;"><b>&nbsp;');
	d_lightning.write(title_lightning);
	d_lightning.write('</b></font></td>');
	d_lightning.write('<td bgcolor=\"#003399\" align=center>');
	d_lightning.write('	<table cellspacing="0" cellpadding="0" style="width:20px;text-align:center;background:#060;border:1px solid #060;border-collapse:collapse;border-style:outset;border-width:1;border-color:white">');
	d_lightning.write('	<tr><td>');
	d_lightning.write('	<a onclick="hide_lightning();" onmouseover="this.style.cursor=\'default\';this.style.background=\'#FF7359\'" onmouseout="this.style.cursor=\'default\';this.style.background=\'#E76741\'" ');
	d_lightning.write('style="background:#E76741;border:0;color:white;font-family:arial,system,verdana;margin-left:0px;padding-left:4px;padding-right:' + (ns6_lightning ? '3' : '4') + 'px;padding-top:' + ( ns6_lightning ? '0' : '3') + 'px;'+(ns6_lightning?'padding-bottom:1px;':'')+'text-decoration:none;font-size:16px;left-indent:0px;"><b>X</b></a>');
	d_lightning.write('	</td></tr>');
	d_lightning.write('	</table>');
	d_lightning.write('</td></tr>');
	d_lightning.write('<tr><td valign="top" colspan="2">');
	d_lightning.write('	<table width="100%" cellpadding="0" cellspacing="3" style="border:3px solid #060;cursor:default;">');
	d_lightning.write('	<tr><td align="center" valign="top">');
	d_lightning.write(CaptureWindow);
	d_lightning.write('	</td></tr>');
	d_lightning.write('	</table>');
	d_lightning.write('</td></tr>');
	d_lightning.write('</table></div>');
	//alert("oio:" + d_lightning.body.innerHTML);
}





// / / / / / / / / / / / / / / / / / / / / / /	//
//												//
// 												//
// If there is no cookie, the IE window doesn't	//
// yet exist, so create the draggable window.	//
//												//
// / / / / / / / / / / / / / / / / / / / / / /	//

if(getcookie_lightning(cookie_lightning) == "")
{
	if(!ns_lightning) 
	{
		//alert("oio:create");
		create_lightning();
	}
}

var id_lightning,optinover,shadow,height_lightning,left_lightning,top_lightning;


// / / / / / / / / / / / / / / / / / /	//
//										//

//										//
// / / / / / / / / / / / / / / / / / /	//

function var_lightning()
{
	id_lightning = "optinover";
	d_lightning = document;
	optinover = d_lightning.getElementById ? d_lightning.getElementById(id_lightning) : d_lightning.all[id_lightning];
	shadow = d_lightning.getElementById ? d_lightning.getElementById("shadow") : d_lightning.all["shadow"];
	var b = (typeof(window.innerWidth) == 'number') ? window.innerWidth : (document.documentElement && document.documentElement.clientWidth ? document.documentElement.clientWidth : (document.body && document.body.clientWidth ? document.body.clientWidth : 800));
	left_lightning = 200;
	top_lightning = 165;
}

if(!ns_lightning && getcookie_lightning(cookie_lightning) == "")
{
	var_lightning();
	repos_lightning();
}

// / / / / / / / / / / / / / / / / / /	//
//										//

//										//
// / / / / / / / / / / / / / / / / / / 	//

function repos_lightning()
{
	if(ns6_lightning)
	{
		optinover.style.top = top_lightning + window.pageYOffset;
		shadow.style.top = top_lightning + window.pageYOffset + 0;
		optinover.style.height = document.defaultView.getComputedStyle(document.getElementById("optinoverTable"), "").getPropertyValue("height");
		shadow.style.height = document.defaultView.getComputedStyle(document.getElementById("optinoverTable"), "").getPropertyValue("height");
		shadow.style.width = document.defaultView.getComputedStyle(document.getElementById("optinoverTable"), "").getPropertyValue("width");
	}
	else
	{
		optinover.style.top = top_lightning + d_lightning.body.scrollTop;
		shadow.style.height = optinover.offsetHeight;
		shadow.style.top = (top_lightning * 1 + 0 * 1) + d_lightning.body.scrollTop;
		shadow.style.width = optinover.style.width;
	}

	optinover.style.left = left_lightning;
	shadow.style.left = left_lightning + 0;
}

// / / / / / / / / / / / / / / / / / / / / / / / /	//
//													//
// hide_lightning() scrolls the draggable_window  	//
// to the right until it leaves the viewable page.	//
//													//
// / / / / / / / / / / / / / / / / / / / / / / / /	//
function hide_lightning()
{
	if(optinover.style.left.substring(0, optinover.style.left.length - 2) < screen.width && !ns6_lightning)
	{
		optinover.style.left=optinover.style.left.substring(0, optinover.style.left.length - 2) * 1 + 20;
		shadow.style.left=shadow.style.left.substring(0 ,shadow.style.left.length - 2) * 1 + 20;
		setTimeout("hide_lightning()", 10);
	}
	else
	{
		optinover.style.visibility = 'hidden';
		shadow.style.visibility = 'hidden';
		window.scrollBy(0,1);

		if (!ns6_lightning)
		{
			setTimeout('window.document.body.onscroll=null;', 2000);
		}

		optinover.style.left = 0;
	}
}

// / / / / / / / / / / / / / / / / / / 	//
//										//

//										//
// / / / / / / / / / / / / / / / / / / 	//

function show_ns_lightning()
{
	message_lightnings = message_lightning.split("<P><UL>");
	CaptureWindow = message_lightnings[0];

	for(i = 1; i < message_lightnings.length; i++)
	{
		CaptureWindow += "\n" + message_lightnings[i];
	}
	message_lightnings = CaptureWindow.split("<P>");
	CaptureWindow = message_lightnings[0];

	for(i = 1; i < message_lightnings.length; i++)
	{
		CaptureWindow += "\n\n" + message_lightnings[i];
	}
	message_lightnings = CaptureWindow.split("<BR>");
	CaptureWindow = message_lightnings[0];

	for(i = 1; i < message_lightnings.length; i++)
	{
		CaptureWindow += "\n" + message_lightnings[i];
	}
	message_lightnings = CaptureWindow.split("<LI>");
	CaptureWindow=message_lightnings[0];

	for(i = 1; i < message_lightnings.length; i++)
	{
		CaptureWindow += "\n* " + message_lightnings[i];
	}
	message_lightnings = CaptureWindow.split("<");
	CaptureWindow = message_lightnings[0];

	for(i = 1; i < message_lightnings.length; i++)
	{
		temp_lightnings = message_lightnings[i].split(">");
		temp_lightning="";

		if(temp_lightnings.length > 1)
		{
			temp_lightning = temp_lightnings[1];
		}
		else
		{
			temp_lightning = message_lightnings[i];
		}

		CaptureWindow += temp_lightning;
	}

}

var temp_top_lightning;

// / / / / / / / / / / / / / / / / / /	//
//										//

//										//
// / / / / / / / / / / / / / / / / / /	//

function show_lightning()
{
	if(getcookie_lightning(cookie_lightning) == "")
	{
		if(ns_lightning)
		{
			show_ns_lightning();
		}
		else
		{
			temp_top_lightning = (ns6_lightning ? window.pageYOffset : d_lightning.body.scrollTop) - (ns6_lightning ? document.defaultView.getComputedStyle(document.getElementById("optinoverTable"), "").getPropertyValue("height").substring(0,document.defaultView.getComputedStyle(document.getElementById("optinoverTable"), "").getPropertyValue("height").length -2 ) : optinover.offsetHeight) - 0;
			optinover.style.top = 100; //temp_top_lightning;

			if(ns6_lightning)
			{
				shadow.style.top = 0; 
			}
			else
			{
				shadow.style.top = 0 - optinover.offsetHeight;
			}

			optinover.style.overflow = 'visible';
			optinover.style.visibility = 'visible';
			shadow.style.visibility = 'visible';
			shadow.style.overflow = 'visible';
			move_lightning();

			if(!ns6_lightning)
			{
				window.document.body.onscroll = repos_lightning;
			}
		}

		setcookie_lightning();
	}
}

// / / / / / / / / / / / / / / / / / / 	//
//										//

//										//
// / / / / / / / / / / / / / / / / / / 	//

function move_lightning()
{
	if (optinover.style.top.substring(0, optinover.style.top.length-2) < 165 + (ns6_lightning ? window.pageYOffset : d_lightning.body.scrollTop))
	{
		temp_top_lightning += 10;
		optinover.style.top = temp_top_lightning;
		shadow.style.top = temp_top_lightning + 0;
		setTimeout("move_lightning()", 10);
	}
}

// / / / / / / / / / / / / / / / / / / / / / / /	//
//													//
//  getcookie_lightning verifies a cookie exists.	//
//													//
// / / / / / / / / / / / / / / / / / / / / / / /	//

function getcookie_lightning(cookieName)
{
	var id = cookieName + "=";
	var cookievalue = "";

	if (document.cookie.length>0)
	{
		var offset = document.cookie.indexOf(id);

		if (offset != -1)
		{
			cookievalue = "x";
		}
	}

	return cookievalue;
}

// / / / / / / / / / / / / / / / / / / / / / / / /	//
//													//
// setcookie_lightning sets a cookie for 1 minute	//
//													//
// / / / / / / / / / / / / / / / / / / / / / / / /	//

function setcookie_lightning()
{
	if (1 == 0) return false;

	var today = new Date();
	var expdate = new Date(today.getTime() + 1 * 1 * 1 * 60 * 1000); 
	// 1,000 milliseconds * 60 (seconds) * 1 (minutes) * 1 (hour) * 1 (day). It was + 1 * 24 * 60 * 60 * 1000);
	document.cookie = cookie_lightning + "=" + escape("done") + ";path=/;expires=" + expdate.toGMTString();
	return true;
}

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

setTimeout("show_lightning();", 2 == 2 ? 2000 : 1000);