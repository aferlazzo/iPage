<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright � Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/

date_default_timezone_set('America/Los_Angeles');


if (!function_exists(translateErrorReportingConstant2String))
{
	function translateErrorReportingConstant2String()
	{
		$current = error_reporting();
		$out = "";

		if (($current & E_ERROR)			== E_ERROR)				{$out .=" E_ERROR           | "; }
		if (($current & E_WARNING)			== E_WARNING)			{$out .=" E_WARNING         | "; }
		if (($current & E_PARSE)			== E_PARSE)				{$out .=" E_PARSE           | "; }
		if (($current & E_NOTICE)			== E_NOTICE)			{$out .=" E_NOTICE          | "; }
		if (($current & E_CORE_ERROR)		== E_CORE_ERROR)		{$out .=" E_CORE_ERROR      | "; }
		if (($current & E_CORE_WARNING)		== E_CORE_WARNING)		{$out .=" E_CORE_WARNING    | "; }
		if (($current & E_COMPILE_ERROR)	== E_COMPILE_ERROR)		{$out .=" E_COMPILE_ERROR   | "; }
		if (($current & E_COMPILE_WARNING)	== E_COMPILE_WARNING)	{$out .=" E_COMPILE_WARNING | "; }
		if (($current & E_USER_ERROR)		== E_USER_ERROR)		{$out .=" E_USER_ERROR      | "; }
		if (($current & E_USER_WARNING)		== E_USER_WARNING)		{$out .=" E_USER_WARNING    | "; }
		if (($current & E_USER_NOTICE)		== E_USER_NOTICE)		{$out .=" E_USER_NOTICE     | "; }
		if (($current & E_ALL)				== E_ALL)				{$out .=" E_ALL             | "; }
		return $out;
	}
}

if (!function_exists(logMessage))
{
	function logMessage($msg) 
	{
		GLOBAL $user, $arid, $UA;
		
		//echo("Line (".__LINE__.")");
		$logfile = "Logs/PerfectResponseLog.txt";
		$Retries=0;
		do
		{
			$file = fopen($logfile,"a");
			$Retries++;
		}
		while(($file == false) && ($Retries < 10));
		
		//echo("conn (".__LINE__.") writing<br />$msg<br />to $logfile ");
		
		if ($msg[strlen($msg)-1]!="\n") //make every log entry end with a new line character
		{
			$msg.="\n";
		}
		$TimeStamp = date("D, d M Y H:i:s",time());
		$WriteString = "empty";
		if($user=="")
		{
			if($arid == "")
			{
				$WriteString = "admin   ".$TimeStamp." ".$msg;
			}
			else	
			{
				$WriteString = sprintf("arid %03s $TimeStamp $msg", $arid);
		  	}
		}
		else
		{
			$WriteString = $user." ".$TimeStamp." ".$msg;
		}
		
  		$result = fputs($file,$WriteString);
		if(!$result)
			print("conn.php (".__LINE__.") error on write to log file $WriteString<br/>\n");
		fclose($file);
		if($UA != '') //in other words, don't do this for mailout cron jobs.
			print("<script type='text/javaScript'>top.frames['LogFile'].location.href='DisplayLog.php?f=activity';</script>\n");  //update the visible log real-time
	}
}	
	
if (!function_exists(logSMTPmessage))
{
	function logSMTPmessage($msg) 
	{
		GLOBAL $user, $arid;
		
		//echo("Line (".__LINE__.")");
		$logfile = "Logs/PerfectResponseSMTPlog.txt";
		$Retries=0;
		do
		{
			$file = fopen($logfile,"a");
			$Retries++;
		}
		while(($file == false) && ($Retries < 10));
		
		//echo("conn (".__LINE__.") writing<br />$msg<br />to $logfile ");
		
		if ($msg[strlen($msg)-1]!="|") //make every log entry end with a | character
		{
			$msg.="|";
		}
		$TimeStamp = date("D, d M Y H:i:s",time());
		$WriteString = "empty";
		if($user=="")
		{
			if($arid == "")
			{
				$WriteString = "admin   ".$TimeStamp." ".$msg;
			}
			else	
			{
				$WriteString = sprintf("arid %03s $TimeStamp $msg", $arid);
		  	}
		}
		else
		{
			$WriteString = $user." ".$TimeStamp." ".$msg;
		}
		
  		$result = fputs($file,$WriteString);
		if(!$result)
			print("conn.php (".__LINE__.") error on write to SMTP log file $WriteString<br/>\n");
		fclose($file);
	}
}	
	
if(!(file_exists("version.php")))
{
	echo "version.php file is missing or corrupt.<br> Please contact the vendor or re-install";
}
include("db.inc.php");
//print("<p>conn (".__LINE__.") try to connect</p>"); 
$link = mysql_connect("$dbhostname", "$dbuname", "$dbpwd");
	if($link == false)
	{
		print("<p>conn (".__LINE__.") mysql_connect(\"$dbhostname\", \"$dbuname\", \"$dbpwd\");"); 		
		print("<p>conn (".__LINE__.") Could not connect to the database. Error: |".mysql_error()."|</p>");
		print("<p>conn (".__LINE__.") dbhostname: |$dbhostname|</p>"); 		
		print("<p>conn (".__LINE__.") dbuname: |$dbuname|</p>"); 		
		print("<p>conn (".__LINE__.") dbpwd: |$dbpwd|</p>"); 
	} 
	else
	{
		//logMessage("conn (".__LINE__.") connected to server \"$dbhostname\" and user \"$dbuname\" "); 		
		$Result = mysql_select_db("$dbname", $link);
		if (!$Result)
		{
			print("<p>conn (".__LINE__.") Could not select database |$dbname| ".mysql_error()."</p>");
			logMessage ("conn (".__LINE__.") Could not select database: ".mysql_error());
		}
		/*
		else
			logMessage("conn (".__LINE__.") selected database \"$dbname\" ");
		*/
	}

/*
$rcount=0;

while (($rcount < 19) && (isset($link) == false)  || ($link == false))//if not linked to database
{
	//print("<p>linking</p>");
	$link = @mysql_connect("$dbhostname", "$dbuname", "$dbpwd");
	if($link == false)
	{
		logMessage ("conn (".__LINE__.") Could not connect to database. ".mysql_error().". Retry count: ".$rcount++);
		sleep(1);  //wait 1 second
		if ($rcount > 18)
		{
			print("<p>conn (".__LINE__.") Could not connect to database ".mysql_error().". Retry count exceeded: ".$rcount."</p>");
			print("<p>conn (".__LINE__.") dbhostname: |$dbhostname|</p>"); 		
			print("<p>conn (".__LINE__.") dbuname: |$dbuname|</p>"); 		
			print("<p>conn (".__LINE__.") dbpwd: |$dbpwd|</p>"); 		
			die(logMessage ("conn (".__LINE__.") Retries exceeded."));
		}
	} 
	else
	{
		//print("<p>linked</p>");
		$Result = mysql_select_db("$dbname", $link);
		if (!$Result)
		{
			print("<p>conn (".__LINE__.") Could not select database |$dbname| ".mysql_error()."</p>");
			logMessage ("conn (".__LINE__.") Could not select database: ".mysql_error());
		}
	}
}
*/
?>