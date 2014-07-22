function GetSize(navBetaHeight, Obj) 
{
	var ObjId = document.getElementById(Obj);
	var ContentId = document.getElementById('content');
	var WrapperId = document.getElementById('Wrapper');
	var myHeight = 0;
	var myWidth = 0;
	var notIE=45;

	if (Obj != "navBeta")
	{
		if (typeof(ObjId.clientHeight) == 'number') 
		{
			myHeight = ObjId.clientHeight;
			myWidth = ObjId.clientWidth;
		}
		else 
		if (ObjId && typeof(ObjId.clientHeight) != 'undefined') // IE
		{
			//alert('clientHeight is NOT undefined '+ObjId.clientHeight);
			myHeight = ObjId.clientHeight;
			myWidth = ObjId.clientWidth;
			notIE=0;
		}
	
		//alert("pathname: "+location.pathname);
		var PathName = location.pathname;
		if ((PathName == "/pr/EditMessages.php") || (PathName == "/pr/AddMessages.php"))
		{
			//alert('adding for editor');
			myHeight += 430;	//add for the size of the div containing the <textarea> used by FCKeditor	
		}
	}	
	
	if (Obj == "navBeta") // meaning function called by the Show() function, so add/subtract the size of this div
	{
		var ContentHeight = ContentId.clientHeight;

		myWidth = ContentId.clientWidth;
		if( document.getElementById('navBeta').style.display == '')
		{
  			myHeight = ContentHeight - navBetaHeight - notIE;
			//alert('subtracting for hidden navBeta. height: '+myHeight+' = '+ ContentHeight +' - '+navBetaHeight+'\n\nmyHeight = ContentHeight - navBetaHeight');
		}
		else
		{
  			myHeight = ContentHeight + navBetaHeight + notIE;
			//alert('adding for visible navBeta. height: '+myHeight+' = '+ ContentHeight +' + '+navBetaHeight+'\n\nmyHeight = ContentHeight + navBetaHeight');
		}
	}
	
	myHeight += "px";
	ContentId.style.height = myHeight;
	ContentId.style.width  = myWidth+"px";
	WrapperId.style.height = myHeight;
	WrapperId.style.width  = myWidth+2+"px";
}

//-------------------------------
//
//To do rounded corners
//
//The function NiftyCheck performs a check for DOM support. If the test has passed,
//the Rounded function is called, that is now the only one function that you should 
//call to get nifty corners. It accepts five parameters, that are in order:
//
//   1. A CSS selector that indicates on wich elements apply the function
//   2. A string that indicates which corners to round: all, top, bottom, etc.
//   3. Outer color of the rounded corners
//   4. Inner color of the rounded corners
//   5. An optional fifth parameter, that will contain the options for Nifty Corners
//
//-------------------------------
function GetNifty()
{
if(!NiftyCheck())
    return;
//Rounded("div#Wrapper","all","#FFE4C4","#48D1CC","border #000080");
Rounded("div#Wrapper","all","transparent","#48D1CC","border #000080");
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 	//
//																//
//	This routine is used with FCKeditor to swap the textarea 	//
//																//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 	//

function getFCKeditor()
{

	var sBasePath = '/fckeditor/';

	var oFCKeditor = new FCKeditor( 'PerfectResponseMessage' ) ;  //defined only for the <textarea> used by FCKeditor.js	
	oFCKeditor.BasePath	= sBasePath ;
	oFCKeditor.Height	= '400';
	oFCKeditor.Width	= '100%' ;
	//$output = $oFCKeditor->CreateHtml() ;
	oFCKeditor.Value	= '<p>Edit your message here.</p>';
	oFCKeditor.ReplaceTextarea() ;
}

window.onload = function()
{
	var PathName = location.pathname;
	//alert("PathName: "+PathName);
	if ((PathName == "/pr/EditMessage.php") || (PathName == "/pr/AddMessage.php"))
		getFCKeditor();
	GetSize(0,'content');  //fix the size od the main div
	GetNifty();
	
	if (PathName == "/pr/Monitor.php")//initialize monitoring loop
		setUpCheck();
		
	if ((PathName == "/pr/EditSubscriber.php") || (PathName == "/pr/FindSubscribers.php")) //initialize the edit form
	{
		window.document.EditSubscriberForm.Email.focus();
		document.EditSubscriberForm.vtype.value='email';
	}
}



function LLogout()
{
	if (confirm('Do you really want to logout?'))
	{
		top.location.href='logout.php';  //bust out of frames
		return (false);
	}
	
	return(true);
}
function Show()
{
//alert(document.getElementById('navBeta').style.display);
if (document.getElementById('navBeta').style.display == '')
{

document.getElementById('navBeta').style.display='block';
navBetaHeight = document.getElementById('navBeta').clientHeight;
document.getElementById('submit').value='Click to hide hints!';
document.getElementById('submit').style.borderWidth='2px';
document.getElementById('submit').style.borderStyle='solid';
document.getElementById('submit').style.borderColor='#ffffff';
document.getElementById('submit').style.backgroundColor='#939';
//document.getElementById('submit').focus();
}
else
{
navBetaHeight = document.getElementById('navBeta').clientHeight;
document.getElementById('navBeta').style.display='';
document.getElementById('submit').value='Click for helpful hints!';
document.getElementById('submit').style.borderWidth='2px';
document.getElementById('submit').style.borderStyle='solid';
document.getElementById('submit').style.borderColor='#ffffff';
document.getElementById('submit').style.backgroundColor='#004a8d';
//document.getElementById('submit').focus();
}

//Now update size of div for showing/hiding the documentation 
//alert('navBeta height: '+ navBetaHeight);
GetSize(navBetaHeight, 'navBeta');

}

// function arguments: current count, total count, pixels in bar
function ProgressBar(Count, Total, TotalLength)
{
	Count=Count+1;
	var VisibleLength = (Count /Total) * TotalLength;
	var Bar = document.getElementById('ProgressBar');
	var BarWritten = document.getElementById('ProgressBarWritten');
	Bar.style.width=VisibleLength+"px";
	Percent = (Count /Total) * 100;
	var xxx = Math.round(Percent);
	Bar.innerHTML = "<p>"+xxx+"% Complete -- "+Count+" of "+Total+" Matches</p>";
}

function DeleteRow(email, arid, Row)
{
	if(confirm('Do you want to really delete Email <'+email+'> from arid '+arid+'?') == true)
	{
		myJax(email, arid, Row);
	}	
	else
	{
		var MyRow = arid+"Row"+Row;
		box = eval("document.MyForm"+MyRow+".chk"+MyRow);
		box.checked=false;
		box.blur();
	}
}

//This Ajax routine initializes variables, does the actual post, and returns the value.
//We use Ajax so there is no need for a page refresh
function myJax(email, arid, Row)
{
	//Here we try to get an AJAX object instantiated. First we try to create an AJAX object 
	//for Opera, Firefox, Safari, Camino, etc., then we try to create two different types 
	//for Internet Explorer. If all of those fail, we simply display an error on our page.
	
	var ajax;
	try
	{
		// Firefox, Opera, and the like
		ajax = new XMLHttpRequest();
	}
	catch (e)
	{
		//Internet Exploder?
		try
		{
			ajax= new ActiveXObject("Msxm12.XMLHTTP");
		}
		catch (e)
		{
			//...
			try
			{
				ajax = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e)
			{
				document.getElementById("name").innerHTML="Don't bother, your browser doesnt support AJAX";
			}
		}
	}
	// This is opening our connection, sending some HTTP headers, then posting our data
	// to our Ajax Server script
	
	ajax.open('POST', 'DeleteFoundUser.php', 'true');
	ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//	ajax.setRequestHeader("Content-length", eval(email.length + arid.length));
//	ajax.setRequestHeader("Connection", "close");
	ajax.send("email=" + email+"&arid="+arid);
	
	//If the server’s done respnding (which is what a readyState of 4 means), then we fill our special 
	//little div in with the data the server just sent back to us.
	
	ajax.onreadystatechange=function()
	{
		if(ajax.readyState == 4)
		{
			//alert("I'm back: "+ajax.responseText+" arid: "+arid+" row: "+Row);
						
			if (ajax.responseText.charAt(0) == "T")
			{
				var MyRow = arid+"Row"+Row;
				//alert("query success:\n'"+ajax.responseText.slice(1)+"'\nMyRow: "+MyRow);			
				document.getElementById(MyRow).style.display='none';
				//document.getElementById(MyRow).style.backgroundColor='red';
				box = eval("document.MyForm"+MyRow+".chk"+MyRow);
				box.checked=false;
				box.blur();
			}
			else
				alert("Database deletion query failed");
		}
	}
}

//This Ajax routine initializes variables, does the actual post, and returns the value.
//We use Ajax so there is no need for a page refresh
function ToggleCampaignStatus(arid)
{
	//Here we try to get an AJAX object instantiated. First we try to create an AJAX object 
	//for Opera, Firefox, Safari, Camino, etc., then we try to create two different types 
	//for Internet Explorer. If all of those fail, we simply display an error on our page.
	
	var AjaxToggle;
	try
	{
		// Firefox, Opera, and the like
		AjaxToggle = new XMLHttpRequest();
	}
	catch (e)
	{
		//Internet Exploder?
		try
		{
			AjaxToggle= new ActiveXObject("Msxm12.XMLHTTP");
		}
		catch (e)
		{
			//...
			try
			{
				AjaxToggle = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e)
			{
				document.getElementById("name").innerHTML="Don't bother, your browser doesnt support AJAX";
			}
		}
	}
	// This is opening our connection, sending some HTTP headers, then posting our data
	// to our Ajax Server script
	
	//alert('ToggleCampaignStatus:: arid: '+arid);
	AjaxToggle.open('POST', 'ToggleCampaignStatus.php', 'true');  //POST / true means asynchronous. false means wait for an answer: not asynchronous...
	AjaxToggle.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	AjaxToggle.send("arid="+arid);
	
	//If the server’s done respnding (which is what a readyState of 4 means), then update the page 
	AjaxToggle.onreadystatechange=function()
	{
		if(AjaxToggle.readyState == 4)
		{
			var TextString = AjaxToggle.responseText;
			
			AjaxToggleResult = TextString.split('|');
			if (AjaxToggleResult[0] == "T")
			{
				//alert(AjaxToggleResult[1]+" is campaign status for arid:"+arid);
				if (AjaxToggleResult[1] == "A")
				{
					document.getElementById('CampaignButton').value='Active';
					document.getElementById('CampaignButton').style.backgroundColor='#004a8d';
				}
				if (AjaxToggleResult[1] == "S")
				{
					document.getElementById('CampaignButton').value='Suspended';
					document.getElementById('CampaignButton').style.backgroundColor='#DC143C';
				}
			}
			
			if (AjaxToggleResult[0] == "F")
				alert("Campaign "+AjaxToggleResult[1]+" status toggle failed.");
			
			//alert("Toggle request returned: |"+AjaxToggle.responseText+"|");
			//alert("I'm back: |"+TextString+"|");
		}		
	}
}


