<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright � Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

		**  **  **  ** Special thing going on with this script **  **  **  ** 

		The LogFile frame is at the bottom of the window. It displays the Activity 
		log and the SMTP log. The Acctivity log is updated by scripts to keep a 
		record of actions and changes that are taking place within 'Perfect Response.'
		The SMTP log is updated by the phpmailer smtp class script when it talks to 
		smtp servers in order to send email. 
		
		Turning on and off activity logging is not usually something done on-the-fly.
		Usually it remains on during normal operation of the system. The SMTP log is
		much more dynamic and is more of a diagnostic tool than for keeping long-term.
		The problem is that the phpmailer function would need to query the database
		before each and every send to check to see if the toggle switch is turned on.
		
		Since this could present undue overhead, I could use the capabilities of 
		inter-frame communication to have the phpmailer function (located in the 
		settings.php script and running in the Monitor frame) look at the real-time
		toggle switch state of SMTP logging. My goal is to turn on smtp logging when 
		I believe the phpmailer function is stalled *WITHOUT* interrupting the mailout
		script. 
		
		Well, due to the difficulty of javascript DOM variable updating a php variable on the fly,
		I opted to just read the config settings in the database before each send to dynamically
		toggle the debug switch and generation of smtp deata in the log file.  


*/
include("check1.php");

include("conn.php");
$WithinScript = "I am embedded in another script";
include("settings.php");
$LogToDisplay = $_GET['f'];
if ($LogToDisplay == "smtp")
	$LogFile = "Logs/PerfectResponseSMTPlog";
if ($LogToDisplay == "activity")
	$LogFile = "Logs/PerfectResponseLog";
if ($LogToDisplay == "")
{
	print("<script type='text/javaScript'>\n");
	print("alert('Log File type not specified on URI');\n");
	print("</script>\n");
	die();
}

$user = ucwords(strtolower($_COOKIE["UName"]));

// check on debug switch
		
$SQL = "select * from admin where adminname='$user'";
$result_ar = mysql_query($SQL) or die("ToggleCampaignStatus (".__LINE__.") $SQL");
$arrow = mysql_fetch_array($result_ar);
//here is where the php variable $Dsetting begins keeping track of the current state of SMTP debugging
$Dsetting = $arrow['SMTPDebugging'];

//print("<h2>At start debug is set to $Dsetting</h2>\n");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<HTML>
<HEAD>
<TITLE>Activity Log - Perfect Response</TITLE>
<meta name="robots" content="NoIndex, NoFollow">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="./css/PerfectResponse.css">
<style type="text/css" media="screen">
th, td {background:#fff;font-family:Verdana, Arial, Helvetica;color:#000080;font-size:10pt;padding:2px 2px;text-align:left;white-space:nowrap;}
th {color:#fff;background:#004a8d;}
h3 {margin-top:6px;}
div#dOn, div#dOff {float:left;margin-left:20px;display:none;line-height:22px;vertical-align:bottom;}
div#onForm, div#offForm, div#clearAform, div#clearSform {float:left;margin-left:10px;display:none}
div#ActivityLog, div#SMTPlog {float:left;margin-left:20px;}

div#Log {float:left;margin:0 0 40px 0;padding:1px 0;background:#004a8d;width:100%;}
div#Log p{color:#fff;}
div.LogLine {background:#fff;text-align:left;margin:2px;white-space:nowrap;}
div#smtpLog {float:left;margin:0 0 40px 0;padding:1px 0;background:#004a8d;width:600px;}
div.smtpLogLine {background:#fff;text-align:left;margin:2px;white-space:normal;}
div#CheatSheet {float:left;width:500px;border:1px dashed #004a8d;background:#fff;margin-left:20px;padding:8px;}
</style>
<script type="text/javascript">

//Here is where the javascript variable Dsetting is globally defined for use in this script
var Dsetting;
var MaxLineWidth = 0;

// Use AJAX to toggle the SMTP login switch

function ToggleSMTPdebugging(Stat)
{
	//Here we try to get an AJAX object instantiated. First we try to create an AJAX object 
	//for Opera, Firefox, Safari, Camino, etc., then we try to create two different types 
	//for Internet Explorer. If all of those fail, we simply display an error on our page.
	
	var DebuggingToggle;
	try
	{
		// Firefox, Opera, and the like
		DebuggingToggle = new XMLHttpRequest();
	}
	catch (e)
	{
		//Internet Exploder?
		try
		{
			DebuggingToggle= new ActiveXObject("Msxm12.XMLHTTP");
		}
		catch (e)
		{
			//...
			try
			{
				DebuggingToggle = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e)
			{
				document.getElementById("name").innerHTML="Don't bother, your browser doesnt support AJAX";
			}
		}
	}
	// This is opening our connection, sending some HTTP headers, then posting our data
	// to our Ajax Server script
	
	//alert('ToggleCampaignStatus:: Stat: '+Stat);
	DebuggingToggle.open('POST', 'ToggleSMTPdebugging.php', 'true');  //POST / true means asynchronous. false means wait for an answer: not asynchronous...
	DebuggingToggle.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	DebuggingToggle.send('Stat='+Stat);
	
	//If the server�s done respnding (which is what a readyState of 4 means), then update the page 
	DebuggingToggle.onreadystatechange=function()
	{
		if(DebuggingToggle.readyState == 4)
		{
			//Here is where the updated PHP smtp debugging toggle switch variable updates the 
			//javascript global variable. Remember, the phpmailer function (or any script running 
			//in the Monitor frame) will read a variable that is getting updated using inter-frame 
			//state management. This is done by them using the *parent* frame notation:
			//parent.LogFile.Dsetting.value = Dsetting
			 
			Dsetting = DebuggingToggle.responseText;
			
			if (Dsetting == 1)
			{
				document.getElementById('dOn').style.display='block';
				document.getElementById('onForm').style.display='block';
				document.getElementById('dOff').style.display='none';
				document.getElementById('offForm').style.display='none';
			}
			if (Dsetting == 0)
			{
				document.getElementById('dOn').style.display='none';
				document.getElementById('onForm').style.display='none';
				document.getElementById('dOff').style.display='block';
				document.getElementById('offForm').style.display='block';
			}
		}		
	}
}


function ClearLog(CFname)
{
	if (!confirm("Are you sure you want to empty "+CFname+"?"))
		return;
		
	//Here we try to get an AJAX object instantiated. First we try to create an AJAX object 
	//for Opera, Firefox, Safari, Camino, etc., then we try to create two different types 
	//for Internet Explorer. If all of those fail, we simply display an error on our page.
	
	var AjaxCF;
	try
	{
		// Firefox, Opera, and the like
		AjaxCF = new XMLHttpRequest();
	}
	catch (e)
	{
		//Internet Exploder?
		try
		{
			AjaxCF= new ActiveXObject("Msxm12.XMLHTTP");
		}
		catch (e)
		{
			//...
			try
			{
				AjaxCF = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e)
			{
				document.getElementById("name").innerHTML="Don't bother, your browser doesnt support AJAX";
			}
		}
	}
	// This is opening our connection, sending some HTTP headers, then posting our data
	// to our Ajax Server script
	
	AjaxCF.open('POST', 'DisplayLogServer.php', 'true');  //POST / true means asynchronous. false means wait for an answer: not asynchronous...
	AjaxCF.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	AjaxCF.send("CFname="+CFname);
	
	//If the server�s done respnding (which is what a readyState of 4 means), then update the page 
	AjaxCF.onreadystatechange=function()
	{
		if(AjaxCF.readyState == 4)
		{
			CFresult = AjaxCF.responseText;
			if(CFresult == "T")
				window.location.reload(); //reload the script so we can see the file is empty	
			else
				alert("Result from ClearFile server code is: "+CFresult);	
		}		
	}
}



function InitialSetting(DebugSwitch, LogToDisplay)
{	
	//here is where the initial setting of the debug toggle switch initializes the globally defined
	//javascript variable Dsetting
	
	Dsetting = DebugSwitch;
	
	if (Dsetting == 1)  //debugging is on
	{
		document.getElementById('dOn').style.display='block';
		document.getElementById('onForm').style.display='block';
		document.getElementById('dOff').style.display='none';
		document.getElementById('offForm').style.display='none';
	}
	if (Dsetting == 0)  //debugging is off 
	{
		document.getElementById('dOn').style.display='none';
		document.getElementById('onForm').style.display='none';
		document.getElementById('dOff').style.display='block';
		document.getElementById('offForm').style.display='block';
	}
	
	//display the appropriate 'Clear Log Button'
	if (LogToDisplay == "activity")
	{
		document.getElementById('clearAform').style.display='block';
		//fix the width of the Log div to fully contain each LogLine
		var LogId = document.getElementById('Log');
		//alert("Max Line was "+MaxLineWidth+" characters. In pixels, width is "+eval(MaxLineWidth * 7.5));
		LogId.style.width  = (MaxLineWidth * 7.5) +"px";
	}
	else
		document.getElementById('clearSform').style.display='block';


}
function Verify()
{
	var Answer = confirm('Do you *really* want to archive the log file?'); 
	return(Answer);
}
</script>
</HEAD>
<!-- This is where the php variable $Dsetting initially sets the javascript variable Dsetting --> 
<BODY onload='InitialSetting(<?php echo $Dsetting ?>, "<?php echo $LogToDisplay ?>");'>

<?php
	
function ListFile($FF, $LogToDisplay)
{
	GLOBAL $user;
	if ($LogToDisplay == "smtp")
		print("<div id='smtpLog'>\n");
	else	
		print("<div id='Log'>\n");	
		
		
	print("<p>Logfile: $FF</p>");
	$Open = fopen ("$FF","r") or die ("<p>Can't read the Log File, $FF. It may have just been emptied, or there may be another problem</p>");

	// Display each log record, newest entry first...

	$LogRecords = file ("$FF"); //return file as array

	//var_dump($LogRecords);
	
	$count = (count($LogRecords) - 1);	
	if ($LogToDisplay != "smtp")
		print("<p>There are ".count($LogRecords)." records</p>");	
	if ($count < 0)
	{
		print ("<div class='LogLine'>Log File '$FF' is empty!</div>\n");
		print("<script type='text/javascript'>\n");
		print("MaxLineWidth = 70"); //This signals to make sure the div is at least 70 characters wide
		print("</script>\n");
	}	
	else
	{
		for ($lcount = $count; $lcount > -1; $lcount--)
		{
			$GetLine = explode("\n", $LogRecords[$lcount]);

			$arid = substr($GetLine[0], 0, 5);
			if (strcmp($arid,"arid|") == 0)
			{
				$ll=$GetLine[0];	
				$ll = ereg_replace("[\r\n]", " ", $ll); //get rid of \n and \r characters
				
				list($label, $arid, $RestOfLine) = explode("|", $ll);
				$Retries=0;

				do
				{
					$ar_result = mysql_query("SELECT * FROM autoresponders where arid=$arid", $link);
					$Retries++;
				}
				while (($ar_result == false) && ($Retries < 10));

				if ($ar_result != false)
				 	$ar_row = mysql_fetch_object($ar_result) or die("<tr><td colspan='2' style='background:#fff;text-align:left;'>DisplayLog (".__LINE__.") |$arid|</td></tr>\n");
				$GetLine[0] = $ar_row->user." ".$RestOfLine;
			}

			//print("$GetLine[0]<br />");
			$ll=$GetLine[0];
			//print("<p>file |$LogToDisplay|: $ll</p>");
				
			if ($LogToDisplay != "smtp")
				$ll = ereg_replace("[\r\n]", " ", $ll); //get rid of \n and \r characters
			else
			{
				$ll = str_replace("\x00", "", $ll); //get rid of |, and replace with \n and \r characters
				$ll = str_replace("\x7c", "<br>", $ll); //get rid of |, and replace with \n and \r characters
			}
				
			//print("<div class='LogLine'>file |$LogToDisplay| after replacement: $ll</div>\n");
			$Ulength = strpos($GetLine[0], " ");
			$UserLine = substr($GetLine[0], 0, $Ulength);			

			if ((strcasecmp($user, "admin") == 0) || (strcasecmp($user,$UserLine) ==0 ))
			{
				if ($LogToDisplay == "smtp")
					print("<div class='LogLine'>$ll</div>\n");
				else
					print ("<div class='LogLine'>$GetLine[0]</div>\n");
				
				print("<script type='text/javascript'>\n");
				print("if (MaxLineWidth < ".strlen($GetLine[0]).")\n");
				print("MaxLineWidth = ".strlen($GetLine[0]));
				print("</script>\n");
			}
		}
	}
	
	fclose ($Open);
	print("</div>\n");
}

//Display a smtp cheat sheet next to the table

function DisplayCheatSheet()
{

?>
<div id='CheatSheet'>
<p>SMTP is responsible for sending out your messages. So if you get a SMTP error message, it means emails were not sent. 
It is very important to understand why this has happened. It is the first step in fixing the problem.</p>
<p>All SMTP codes consist of three digits, for example, 550, 221, 354, etc. Most of them are mere computer-to-computer handshaking
as opposed to meaning there was an error. In order to understand what these codes mean, you have to know that each digit (the first, the second and the third) have there own meaning.</p>

<p>The first digit tells you if your command was accepted and processed. There are five different values for that:</p>

<ol><li><p>Mail server has accepted the command, but does not yet take any action. A confirmation message is required.</p></li>
<li><p>Mail server has completed the task successfully without errors.</p></li>
<li><p>Mail server has understood the request, but requires further information to complete it.</p></li>
<li><p>Mail server has encountered a temporary failure. If the command is repeated without any change, it might be completed. Try again, it may help!</p></li>
<li><p>Mail server has encountered a fatal error. Your request can't be processed.</p></li></ol>

<p>As you can see, the codes that start with 4 and 5 are the ones that tell you that your message won't be sent until you find and fix the problem.</p>

<p>The second digit tells you more</p>

<ol start="0"><li><p>Syntax error</p></li>
<li><p>Information reply (for example to HELP request)</p></li>
<li><p>This digit refers to the status of connection</p></li>
<li><p>This digit refers to the status of the mail server</p></li></ol>

<p>The third (last) digit of the code tells you the details of mail transferring status.</p>

<p>Here is the list of most important SMTP error codes:</p>

<ol><li value=421> Service not available, closing transmission channel (This may be a reply to any command if the service knows it must shut down)</p></li>
<li>value=450> Requested mail action not taken: mailbox unavailable (E.g., mailbox busy)</p></li>
<li value=451> Requested action aborted: local error in processing</p></li>
<li value=452> Requested action not taken: insufficient system storage</p></li>
<li value=500> Syntax error, command unrecognized (This may include errors such as command line too long)</p></li>
<li value=501> Syntax error in parameters or arguments</p></li>
<li value=502> Command not implemented</p></li>
<li value=503> Bad sequence of commands</p></li>
<li value=504> Command parameter not implemented</p></li>
<li value=550> Requested action not taken: mailbox unavailable (E.g., mailbox not found, no access)</p></li>
<li value=551> User not local; please try</p></li>
<li value=552> Requested mail action aborted: exceeded storage allocation</p></li>
<li value=553> Requested action not taken: mailbox name not allowed (E.g., mailbox syntax incorrect)</p></li>
<li value=554> Transaction failed<br /><br /></p></li></ol>

<p>The other codes that provide you with helpful information about what's happening with your messages are:</p>

<ol><li value=211> System status, or system help reply</p></li>
<li value=214> Help message (Information on how to use the receiver or the meaning of a particular non-standard command; this reply is useful only to the human user)</p></li>
<li value=220> Service ready</p></li>
<li value=221> Service closing transmission channel</p></li>
<li value=250> Requested mail action okay, completed</p></li>
<li value=251> User not local; will forward to</p></li>
<li value=354> Start mail input; end with . (a dot)</p></li></ol></div>
<?php
}

//------------------------------------------------------
	$WallclockTime = mktime(date("H")+2,date("i"),date("s"),date("m"),date("d"),date("Y"));

	$Open = fopen ("$LogFile.txt","r") or die ("<p>Can't read the Log File, $LogFile.txt. It may have just been emptied, or there may be another problem</p>");

	if ($Open)
	{
		print ("<div id='ActivityLog'><form name='aForm' action='' method='get'>\n");	
		print ("<input class='submit' type='button' value=");
		if ($LogToDisplay == "activity")		
		{
			//$LogFile = "Logs/PerfectResponseLog";
			print("'Refresh Activity Log'");
		}
		if ($LogToDisplay == "smtp")
		{
			//$LogFile = "Logs/PerfectResponseLog";
			print("'View Activity Log'");
		}
		print(" onClick='window.location.href=\"DisplayLog.php?f=activity\" '\n");  
		print ("onMouseover=\"this.className='MouseOver'\" onMouseout=\"this.className='submit'\"></form></div>\n\n");			
				
		print("<div id='clearAform'><form name='clearAform' method='get' onsubmit='return(Verify());' action='BackupActivityLog.php'>\n");
		print("<input name='clearButton' id='clearButton' type='submit' class='cancel' \n");
		print ("onMouseover=\"this.className='MouseOver'\" onMouseout=\"this.className='cancel'\"\n");			
		print("style='width:180px;' value='Archive Activity Log'></form></div>\n\n");	

		print ("<div id='SMTPlog'><form name='sForm' action='' method='get'>\n");
		print ("<input class='submit' type='button' value=");
		if ($LogToDisplay == "smtp")		
		{
			//$LogFile = "Logs/PerfectResponseSMTPlog";
			print("'Refresh SMTP Log'");
		}
		if ($LogToDisplay == "activity")
		{
			//$LogFile = "Logs/PerfectResponseSMTPlog";
			print("'View SMTP Log'");
		}		
		print(" onClick='window.location.href=\"DisplayLog.php?f=smtp\"'\n");  
		print ("onMouseover=\"this.className='MouseOver'\" onMouseout=\"this.className='submit'\"></form></div>\n\n");			
	
		print("<div id='clearSform'><form name='clearSform' action=''>\n");
		print("<input name='clearButton' id='clearButton' type='button' class='cancel' onClick='ClearLog(\"$LogFile.txt\");'\n");
		print ("onMouseover=\"this.className='MouseOver'\" onMouseout=\"this.className='cancel'\"\n");			
		print("style='width:140px;' value='Clear SMTP Log'></form></div>\n\n");	
		
		print("<div id='dOn'>SMTP Logging is <b>On</b>.</div><div id='onForm'><form name='onForm' action=''>\n");
		print("<input name='onButton'   id='onButton' type='button' class='cancel' onClick='ToggleSMTPdebugging(1);'\n");
		print ("onMouseover=\"this.className='MouseOver'\" onMouseout=\"this.className='cancel'\"\n");			
		print("style='width:180px;' value='Turn Off SMTP Logging'></form></div>\n\n");	
	
		print("<div id='dOff'>SMTP Logging is <b>Off</b>.</div><div id='offForm'><form name='offForm' action=''>\n");
		print("<input name='offButton' id='offButton' type='button' class='cancel' onClick='ToggleSMTPdebugging(0);'\n");
		print ("onMouseover=\"this.className='MouseOver'\" onMouseout=\"this.className='cancel'\"\n");			
		print("style='width:180px;' value='Turn On SMTP Logging'></form></div><br style='clear:left;'>\n\n");	
		
		print ("<h3><i>Perfect Response</i> ");
		if ($LogToDisplay == "smtp") 
			print("SMTP");
		else
			print("Activity");
		print(" Log - <span style='color:red;'>Most Recent Activity is Displayed First</span> - As of ".date('l F j, Y g:i A')."</h3>\n\n");	
		
		
		fclose ($Open);
		ListFile("$LogFile.txt", $LogToDisplay);
		if ($LogToDisplay == "smtp")		
			DisplayCheatSheet();
	}
	else
	{
		print ("<p>Unable to read the log file: $LogFile.txt</p>\n");
	}
?>
</body>
</html>