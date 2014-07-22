var object = null;
var d=document;
var xml1;
/*
var rButton='Logout';
var lButton='EditProfile';
*/


//------------- Ajax routines ------------------------
/**
 *=-------------------------------------------------------=
 * getNewHTTPObject
 *=-------------------------------------------------------=
 * This function is here just to create a new 
 * XmlHttpRequest object.
 */
function getNewHTTPObject()
{
    var xmlhttp;

    /** Special IE only code ... */
    /*@cc_on
      @if (@_jscript_version >= 5)
          try
          {
              xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
          }
          catch (e)
          {
              try
              {
                  xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
              }
              catch (E)
              {
                  xmlhttp = false;
              }
         }
      @else
         xmlhttp = false;
    @end @*/

    /** Every other browser on the planet */
    if (!xmlhttp && typeof XMLHttpRequest != 'undefined')
    {
        try
        {
            xmlhttp = new XMLHttpRequest();
        }
        catch (e)
        {
            xmlhttp = false;
        }
    }

    return xmlhttp;
}

/**
 *=-------------------------------------------------------=
 * We call this function when when want an email checked.
 * It calls the server to check the mysql table messagesSent 
 * for a match. The value returned can is received in the
 * SentMonitorResponse function.
 *=-------------------------------------------------------=
 */
function SentMonitor(TimeToSendMsg, email, arid, seqno, row)
{
	//alert("in SentMonitorAjax()");
    xml1 = getNewHTTPObject();
    xml1.open('POST', './MonitorServer.php', true); //true for asynchronous sends (don't wait for server response), false is synchronous sends (wait)
    xml1.onreadystatechange = SentMonitorResponse;
	
	QueryString = "email="  + email
  				+ "&arid="  + arid
 				+ "&seqno=" + seqno
 				+ "&TimeToSendMsg=" + TimeToSendMsg
				+ "&row="	+ row;

	
    xml1.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;");
	xml1.send(QueryString);
}

/**
 *=-------------------------------------------------------=
 * SentMonitorResponse
 * This handles the response from the Ajax request.
 *=-------------------------------------------------------=

 */
function SentMonitorResponse()
{
    if (xml1.readyState == 4)
    {
		if(xml1.status == 200)
		{
			var Response = xml1.responseText;
			//parse out the server response
			if (Response.charAt(0) == "T")
				ChangeSubscriberSendStatus(Response.slice(1));
			else
			{
				if (Response.charAt(0) == "F")
				{
					//alert("Returned from SentMonitor.php: |"+Response+"|");
					Row = Response.split("|")[1];
					Time = Response.split("|")[2];
					ChangeSubscriberSendItTime(Row, Time);
				}
				else
				{
					//alert("Returned from SentMonitor.php: |"+Response+"|");
					//parse the returned value from the SentMonitor server here
					return(false);
				}
			}
		}
		else
			alert("Returned from SentMonitor.php - xml1.status: "+xml1.status);
	}
}

//--------------End Ajax routines---------------------------
function ChangeSubscriberSendStatus(MonitorTableRow)
{
	//alert("Server told me to change row: "+MonitorTableRow);
	//var Tb = document.getElementById('Table');
	//Tb.style.backgroundColor = 'red';
	var Status = eval(document.getElementById('SendStatus'+MonitorTableRow));
	//var email = eval(document.getElementById('email'+MonitorTableRow));

	//alert("Before: Subscriber "+MonitorTableRow+"'s SendStatus:"+Status.innerHTML);
	
	Status.style.backgroundColor = '#004a8d';
	Status.style.fontWeight = 'bold';
	Status.style.color = '#fff';
	Status.innerHTML="Sent";
	//email.innerHTML="Sent";

	//alert("After: Subscriber "+MonitorTableRow+"'s SendStatus:"+Status.innerHTML);
}

function ChangeSubscriberSendItTime(MonitorTableRow, Time)
{
	//alert("row: "+MonitorTableRow+" Time: "+Time);
	var Status = eval(document.getElementById('SendStatus'+MonitorTableRow));
	//var email = eval(document.getElementById('email'+MonitorTableRow));

	//alert("Before: Subscriber "+MonitorTableRow+"'s SendStatus:"+Status.innerHTML);
	/*
	Status.style.backgroundColor = '#004a8d';
	Status.style.fontWeight = 'bold';
	Status.style.color = '#fff';
	*/
	Status.innerHTML=Time;
	//email.innerHTML="Sent";

	//alert("After: Subscriber "+MonitorTableRow+"'s SendStatus:"+Status.innerHTML);
}

//global variables for recursive function

var RowTimer;
var ReportTimer;
var RowCheckInterval = 3000; //3000 milliseconds = 3 seconds
var ReportCheckInterval = 60000; //60000 millisecoconds = 1 minute
var i=0;
var x=1;

// Monitor.php supplies the following variables
// arid, RowsInReport
// The following 3 variables repeat with X = the row in the table:
// emailX,seqnoX, TimeToSendMsgX 

// This recursive function cyles through the email adresses in the report to see if any of them have been sent.
//   
function xxxSentMonitor(TimeToSendMsg, email, arid, seqno, i)
{
	document.writeln(x+" Row: "+eval(i+1)+" of report (having "+RowsInReport+" rows):<br />");
	document.writeln("email: "+email+" arid: "+arid+" seqno: "+seqno+" TimeToSendMsg: "+TimeToSendMsg+" delay: "+eval(RowCheckInterval/1000)+" seconds<br />");
}
function RowCheck()
{
	var ee = 'email'+i;
	var ss = 'seqno'+i;
	var tt = 'TimeToSendMsg'+i;
	email			= eval(ee);
	seqno 			= eval(ss);
	TimeToSendMsg	= eval(tt);

	// To test intervals, rename entMonitor to xxxSentMonitor
	SentMonitor(TimeToSendMsg, email, arid, seqno, i);
	x++;	
	if (i < (RowsInReport - 1))
		i++;
	else
	{
		window.clearInterval(RowTimer); //cancels the further execution of RowCheck()
		i = 0;
		//alert('Completed 1 pass of report. RowTimer cleared.\nDelaying '+ReportCheckInterval/1000+' seconds before next pass.');
		ReportTimer = window.setTimeout("ReportCheck()", ReportCheckInterval); //waits "RowCheckInterval" milliseconds BEFORE executing ReportCheck()
	}		
}

	
function ReportCheck()
{
	//alert("Next pass of monitoring begins.");
	window.clearTimeout(ReportTimer); //cancels the delay before executing the next execution of ReportCheck()
	RowTimer = window.setInterval("RowCheck()", RowCheckInterval); //waits "RowCheckInterval" milliseconds between executions
}
	
// This function is executed onload from html
function setUpCheck()
{
	if(RowsInReport > 0)
	{
		//alert('There are '+RowsInReport+' rows to monitor.\nDelay between each row check is '+RowCheckInterval/1000+' seconds');
		RowTimer = window.setInterval("RowCheck()", RowCheckInterval); //waits "RowCheckInterval" milliseconds between executions
	}
}
