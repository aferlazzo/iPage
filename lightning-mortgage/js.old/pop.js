
var ns_lightning = document.layers || navigator.userAgent.toLowerCase().indexOf("mac") != -1; // don't do on Macintoshes
var ns6_lightning = (!document.all && document.getElementById) ? true : false;
var debug = false;
if (ns6_lightning && !debug)
{
	document.write('<div style="position: relative;z-index:1">');
}

// grey table with rounded corners
var message_lightning='<div id="mainDiv"><table id="mainTable" cellspacing="0" cellpadding="0" border="0" width="100%" ' + (ns6_lightning ? 'style="margin-bottom:2px"' : '') + '>';
//<!-- top -->
message_lightning+='<tr>';
message_lightning+='	<td>';
message_lightning+='		<img src="http://www.lightning-mortgage.com/images/pop/_top_left.gif" alt="" border="0"></td>';
message_lightning+='	<td style="background-color: #f1f1f1; border-top: 1px solid #00357D; text-width:100%">';
message_lightning+='		<img src="http://www.lightning-mortgage.com/images/pop/_.gif" width="1" height="1"></td>';
message_lightning+='	<td>';
message_lightning+='		<img src="http://www.lightning-mortgage.com/images/pop/_top_right.gif" alt="" border="0"></td>';
message_lightning+='</tr>';
//<!-- middle -->
message_lightning+='<tr>';
message_lightning+='<td bgcolor="#f1f1f1" style="border-left: 1px solid #00357D;">';
message_lightning+='<img src="http://www.lightning-mortgage.com/images/pop/_.gif" width="1" height="1"></td>';
message_lightning+='	<td bgcolor="#f1f1f1" align="center">';


//	main content

message_lightning+="<style type=\"text/css\">";
message_lightning+=".rText {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px}";
message_lightning+=".hText {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; color:#00357D; }";
message_lightning+="</style>";
message_lightning+='<table width="97%" border="0" cellpadding="0" cellspacing="0" align="center"><tr><td align="left">';
message_lightning+='<font face=\"\'Times New Roman\',Times,serif\" size=\"3\">'+
'<DIV><FONT style=\"BACKGROUND-COLOR: '+
'#eaeaea;\"><FONT color=#000080><FONT '+
'face=Arial,Helvetica,sans-serif '+
'size=2>Please sign up to receive our FREE 14 '+
'part email course : <STRONG>'+
'Mortgage Insider Secrets</STRONG><BR></FONT><FONT '+
'face=Arial,Helvetica,sans-serif size=2> and save thousands '+
'on your next mortgage!</FONT></DIV>'+
'</font>' + (ns6_lightning ? '<br/><br/>' : '<br/><br/>') + (debug ? '<a href="javascript:alert(document.body.innerHTML)">debug</a>' : '');
message_lightning+='</td></tr><tr><td align="center">';
message_lightning+="<form name=\"Main\" onSubmit=\"Exit=false; return(Validate());\" Action=\"http://www.lightning-mortgage.com/pr/optin.php\" Method=\"post\">";
message_lightning+="	<table width=\"97%\" border=\"0\" bgcolor=\"DEDEF4\" cellpadding=\"0\" cellspacing=\"0\" style=\"border: 1px #404040 solid;\"><tr><td align=\"center\">";
message_lightning+="<input type=\"hidden\" name=\"arid\" value=\"2\"><input type=\"Hidden\" name=\"redirect\"";
message_lightning+="value=\"http://www.lightning-mortgage.com/MortgageInsiderSecretsSuccess.php\">";

message_lightning+="		<span class=\"hText\">Your name:</span><br><input type=\"text\" name=\"Full_Name\" onmousedown=\"this.focus();\"><br>";
message_lightning+="  	<span class=\"hText\">Your email:</span><br><input type=\"text\" name=\"Email_Address\" onmousedown=\"this.focus();\"><br>";
message_lightning+="		<img border=\"0\" src=\"images/pop/_.gif\" width=\"1\" height=\"5\"><br>";
message_lightning+="		<input type=\"submit\" id=\"mainSubmit\" value=\"Sign Up!\" ";
message_lightning+="style=\"color:#ffffff; size: xx-small; background-color: #004a8d;\">";
message_lightning+='		<input type=\"hidden\" name=\"category1\" value=\"autores_ecourse\">';
message_lightning+='		<input type=\"hidden\" name=\"confirmation\" value=\"\">';
message_lightning+="		<input type=\"hidden\" name=\"misc\" value=\"\">";
message_lightning+="		<input type=\"hidden\" name=\"ref\" value=\"\">";
message_lightning+="		<br><img src=\"images/pop/_.gif\" width=\"1\" height=\"4\"><br>";
message_lightning+="	</td></tr></table>";
message_lightning+="<img src=\"images/pop/_.gif\" width=\"1\" height=\"1\"><br>";
message_lightning+="</form>";
message_lightning+="<span style=\"color:#000080\">Remember, your privacy is safe!</span></td></tr></table>";

//	end of main content

message_lightning+='</td>';
message_lightning+='	<td bgcolor="#f1f1f1" style="border-right: 1px solid #00357D;">';
message_lightning+='		<img src="http://www.lightning-mortgage.com/images/pop/_.gif" width="1" height="1"></td>';
message_lightning+='</tr>';
//<!-- bottom -->
message_lightning+='<tr>';
message_lightning+='	<td>';
message_lightning+='		<img src="http://www.lightning-mortgage.com/images/pop/_bottom_left.gif" alt="" border="0"></td>';
message_lightning+='<td bgcolor="#f1f1f1" style="border-bottom: 1px solid #00357D;">';
message_lightning+='		<img src="http://www.lightning-mortgage.com/images/pop/_.gif" width="1" height="1"></td>';
message_lightning+='	<td>';
message_lightning+='		<img src="http://www.lightning-mortgage.com/images/pop/_bottom_right.gif" alt="" border="0"></td>';
message_lightning+='</tr>';
message_lightning+='</table></div>';

var title_lightning = 'lightning-mortgage.com';

var responder_lightning = 'autores_ecourse';

var confirmation_page_lightning = '';




var cookie_lightning="InsidersSecrets";
var drag_lightning= false, x_lightning, y_lightning, a_lightning, b_lightning;

function move(e)
{
	if (drag_lightning)
	{
		left_lightning = ns6_lightning ? a_lightning + e.clientX - x_lightning : a_lightning + event.clientX-x_lightning;
		optinover.style.left = left_lightning;
		top_lightning = ns6_lightning ? b_lightning + e.clientY - y_lightning : b_lightning + event.clientY - y_lightning - document.body.scrollTop;
		optinover.style.top = top_lightning + (ns6_lightning ? 0 : document.body.scrollTop);
		shadow.style.left = left_lightning + 0;
		shadow.style.top = top_lightning+(ns6_lightning ? 0 : document.body.scrollTop) + 0;
		return false;
	}
}

function drags_lightning(e)
{
	if (!document.all && !ns6_lightning)
	return;

	var obj_lightning = ns6_lightning ? e.target : event.srcElement;
	var topelement = ns6_lightning ? "HTML" : "BODY";
	while (obj_lightning.tagName != topelement && obj_lightning.className != "draggable_lightning")
	{
		obj_lightning = ns6_lightning ? obj_lightning.parentNode : obj_lightning.parentElement;
	}
	if (obj_lightning.className == "draggable_lightning")
	{
		drag_lightning = true;
		a_lightning = parseInt(optinover.style.left + 0);
		b_lightning = parseInt(optinover.style.top + 0);
		x_lightning = ns6_lightning ? e.clientX : event.clientX;
		y_lightning = ns6_lightning ? e.clientY : event.clientY;
		document.onmousemove = move;
		return false;
	}
}

if (!ns_lightning)
{
	document.onmousedown = drags_lightning;
}
if (!ns_lightning)
{
	document.onmouseup = new Function("drag_lightning=false");
}



function create_lightning(doc)
{
	d_lightning = (doc ? doc : document);

	if(ns6_lightning && !debug)
	{
		d_lightning.write('</div>');
	}
	/*
	d_lightning.write('<div id="shadow" class="draggable_lightning" style="position:absolute;visibility:hidden;display:none;background-color:lightgrey;z-index:' + (ns6_lightning ? '0' : 0) + ';">');
	d_lightning.write('<table width="100%" align="right" valign="top" cellpadding="0" cellspacing="0" border="0">');
	d_lightning.write('<tr><td>&nbsp;</td></tr></table>');
	d_lightning.write('</div>');
	*/
	d_lightning.write('<div id="shadow" style="position:absolute;visibility:hidden;display:none;z-index:0;">&nbsp;</div>');
//	d_lightning.write('<div id="optinover" class="draggable_lightning" style="border-style:outset;border-width:3;visibility:hidden;position:absolute;z-index:100;background-color:#ff0000;width:250px; overflow:hidden;">');
	d_lightning.write('<div id="optinover" class="draggable_lightning" style="visibility:hidden; position:absolute; z-index:100; width:250px; overflow:hidden;">');
	d_lightning.write('<table id="optinoverTable" width="100%" align="left" valign="top" cellpadding="0" cellspacing="0" border="0" bgcolor="#FFFFFF" style="cursor:move;background-color:#FFFFFF;border-style:solid;border-width:2;border-color:#004a8d;">');
	d_lightning.write('<tr><td width=100% bgcolor="#004a8d" height=26><font style="font-family:Arial,verdana; font-size:13px; color:#ffffff;"><b>&nbsp;');
	d_lightning.write(title_lightning);
	d_lightning.write('</b></font></td>');
	d_lightning.write('<td bgcolor=\"#004a8d\" align=center>');
	d_lightning.write('	<table width="20" cellspacing="0" cellpadding="0" align="center" bgcolor="#004a8d" bordercolor="#004a8d" style="border-collapse:collapse;border-style:outset;border-width:1;border-color:white">');
	d_lightning.write('	<tr><td>');
	d_lightning.write('	<a onclick="hide_lightning();" onmouseover="this.style.cursor=\'default\';this.style.background=\'#FF7359\'" onmouseout="this.style.cursor=\'default\';this.style.background=\'#E76741\'" style="background:#E76741;border:0;color:white;font-family:arial,system,verdana;margin-left:0px;padding-left:4px;padding-right:' + (ns6_lightning ? '3' : '4') + 'px;padding-top:' + ( ns6_lightning ? '0' : '3') + 'px;'+(ns6_lightning?'padding-bottom:1px;':'')+'text-decoration:none;font-size:16px;left-indent:0px;"><b>X</b></a>');
	d_lightning.write('	</td></tr>');
	d_lightning.write('	</table>');
	d_lightning.write('</td></tr>');
	d_lightning.write('<tr><td valign="top" colspan="2">');
	d_lightning.write('	<table width="100%" cellpadding="0" cellspacing="3" border="0" style="cursor:default;">');
	d_lightning.write('	<tr><td align="center" valign="top">');
//	d_lightning.write('		<table cellpadding=0 border="1" width=100% style="cursor:default;">');
//	d_lightning.write('		<tr><td>');

	d_lightning.write(message_lightning);

//	d_lightning.write('<font face=Arial');
//	d_lightning.write(' style="font-size:8pt">' + message_lightning);
//	d_lightning.write('</font>');
//	d_lightning.write('		</td></tr>');
//	d_lightning.write('		</table>');
//	d_lightning.write('	</td></tr>');
//	d_lightning.write('	<tr><td align=center height=5>');
//	d_lightning.write('		<font size=-2></font>');
	d_lightning.write('	</td></tr>');
	d_lightning.write('	</table>');
	d_lightning.write('</td></tr>');
	d_lightning.write('</table></div>');
	//alert("oio:" + d_lightning.body.innerHTML);
}



function create_ns_lightning()
{

}

if(getcookie_lightning(cookie_lightning) == "")
{
	if(ns_lightning)
	{
		create_ns_lightning();
	}
	else
	{
		//alert("oio:create");
		create_lightning();
	}
}

var id_lightning,d_lightning,optinover,shadow,height_lightning,left_lightning,top_lightning;

function var_lightning()
{
	id_lightning = "optinover";
	d_lightning = document;
	optinover = d_lightning.getElementById ? d_lightning.getElementById(id_lightning) : d_lightning.all[id_lightning];
	shadow = d_lightning.getElementById ? d_lightning.getElementById("shadow") : d_lightning.all["shadow"];
	b = (typeof(window.innerWidth) == 'number') ? window.innerWidth : (document.documentElement && document.documentElement.clientWidth ? document.documentElement.clientWidth : (document.body && document.body.clientWidth ? document.body.clientWidth : 800));
	left_lightning = 200;
	top_lightning = 165;
}

if(!ns_lightning && getcookie_lightning(cookie_lightning) == "")
{
	var_lightning();
	repos_lightning();
}

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

function mail_lightning()
{
	if(ns_lightning)
	{
		document.mailer.subscribe.click();
	}
	else
	{
		window.location = "mailto:?body=N/A - to use, select 'Show email' below";
	}
}

function show_ns_lightning()
{
	message_lightnings = message_lightning.split("<P><UL>");
	message_lightning = message_lightnings[0];

	for(i = 1; i < message_lightnings.length; i++)
	{
		message_lightning += "\n" + message_lightnings[i];
	}
	message_lightnings = message_lightning.split("<P>");
	message_lightning = message_lightnings[0];

	for(i = 1; i < message_lightnings.length; i++)
	{
		message_lightning += "\n\n" + message_lightnings[i];
	}
	message_lightnings = message_lightning.split("<BR>");
	message_lightning = message_lightnings[0];

	for(i = 1; i < message_lightnings.length; i++)
	{
		message_lightning += "\n" + message_lightnings[i];
	}
	message_lightnings = message_lightning.split("<LI>");
	message_lightning=message_lightnings[0];

	for(i = 1; i < message_lightnings.length; i++)
	{
		message_lightning += "\n* " + message_lightnings[i];
	}
	message_lightnings = message_lightning.split("<");
	message_lightning = message_lightnings[0];

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

		message_lightning += temp_lightning;
	}

	if(confirm(message_lightning))
	{
		mail_lightning();
	}
}

var temp_top_lightning;

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
				shadow.style.top = 0; // - optinover.offsetHeight; // 0;
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

function getcookie_lightning(cookieName)
{
	var id = cookieName + "=";
	var cookievalue = "";

	if (document.cookie.length>0)
	{
		offset = document.cookie.indexOf(id);

		if (offset != -1)
		{
			cookievalue = "x";
		}
	}

	return cookievalue;
}

function setcookie_lightning()
{
	if (1 == 0) return false;

	var today = new Date();
	var expdate = new Date(today.getTime() + 1 * 1 * 1 * 60 * 1000); 
	// 1,000 milliseconds * 60 (seconds) * 1 (minutes) * 1 (hour) * 1 (day). It was + 1 * 24 * 60 * 60 * 1000);
	document.cookie = cookie_lightning + "=" + escape("done") + ";path=/;expires=" + expdate.toGMTString();
}

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




function Validate()
{
	var objName = document.Main;

	if(Trim(objName.Full_Name.value)=="")
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
	else
	{
		return true;
	}
}

setTimeout("show_lightning();", 2 == 2 ? 2000 : 1000);




