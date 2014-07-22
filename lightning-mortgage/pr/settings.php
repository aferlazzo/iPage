<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright © Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/
//  - - - - - - - - - - - - // - - - - - - - - - - - - - - - //

//customized error reporting/logging

if (!function_exists(ReportErrors))
{
	function ReportErrors($number, $message, $file, $line, $context)
	{
		$out="";
		
		if ($number != 8)
		{
			if (($number & E_ERROR) == E_ERROR)
				{ $out =" E_ERROR | "; }

			if (($number & E_WARNING) == E_WARNING)
				{ $out .=" E_WARNING | "; }

			if (($number & E_PARSE  ) == E_PARSE)
				{ $out .=" E_PARSE | "; }

			if (($number & E_NOTICE) == E_NOTICE)
				{ $out .=" E_NOTICE | "; }

			if (($number & E_CORE_ERROR) == E_CORE_ERROR)
				{ $out .=" E_CORE_ERROR | "; }

			if (($number & E_CORE_WARNING)  == E_CORE_WARNING)
				{ $out .=" E_CORE_WARNING | "; }

			if (($number & E_COMPILE_ERROR) == E_COMPILE_ERROR)
				{ $out .=" E_COMPILE_ERROR | "; }

			if (($number & E_COMPILE_WARNING) == E_COMPILE_WARNING)
				{ $out .=" E_COMPILE_WARNING | "; }

			if (($number & E_USER_ERROR) == E_USER_ERROR)
				{ $out .=" E_USER_ERROR | "; }

			if (($number & E_USER_WARNING) == E_USER_WARNING)
				{ $out .=" E_USER_WARNING | "; }

			if (($number & E_USER_NOTICE) == E_USER_NOTICE)
				{ $out .=" E_USER_NOTICE | "; }

			if (($number & E_ALL) == E_ALL)
				{ $out .=" E_ALL | "; }
			
			// get last string in $file string
			$filename = substr(strrchr($file, "//"), 1);	
			//logMessage("settings (".__LINE__.") Real PHP error occurred in '$filename' script on line ($line) context |$context| error: ($number/$out) $message");
			logMessage("settings (".__LINE__.") Error occurred in '$filename' script on line ($line) $message");
			//echo "<br>Logged PHP error in $filename ($line) context |$context| error number ($number) $message<br>";
		}
	}
}

//  - - - - - - - - - - - - // - - - - - - - - - - - - - - - //

if (!function_exists(NotifyOfAdd))
{
	function NotifyOfAdd($Full_Name, $Email_Address, $arid, $CampaignDescription, $SMTPDebugging, $SMTPTimeout)
	{
		GLOBAL $Notification, $debugIt, $SMTPhost, $SMTPport, $SMTPuser, $SMTPpassword;
		
		//logMessage("settings (".__LINE__.") NotifyOfAdd setup check: SMTPDebugging |$SMTPDebugging| SMTPTimeout |$SMTPTimeout|");
	
		$SavedIPaddress = GetIP(); /* retrieve the visitor's IP address using PHP's convenient tools */
		$Host = gethostbyaddr($SavedIPaddress);
		$MsgBody  = "Name: $Full_Name\nEmail: $Email_Address\nSubscribed to mail campaign $arid - $CampaignDescription\n";
		$MsgBody .= "IP Address: $SavedIPaddress\nDNS Host Name: $Host\n";
		$MsgBody .= "\n\nI remain,\n\nYour Perfect Response\n";
		$HTMLBody = nl2br($MsgBody);
		SwiftMailer($Email_Address, $Full_Name, "$Full_Name - $Email_Address added to '$CampaignDescription'",  "$MsgBody",  "$MsgBody", "", 1, $arid, $SMTPDebugging, $SMTPTimeout);
		if($debugIt > 0)
			logMessage ("settings (".__LINE__.") notified $Notification that Email: $Email_Address was added to '$CampaignDescription'");
	}
}

//  - - - - - - - - - - - - // - - - - - - - - - - - - - - - //


// ---------------
//
// Get the visitors IP Address
//
// ---------------

if (!function_exists(GetIP))
{
	function GetIP()
	{
	  if ($_SERVER)
	  {
	    if ( $_SERVER[HTTP_X_FORWARDED_FOR] )
	    {
	      $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	    }
	    elseif ( $_SERVER["HTTP_CLIENT_IP"] )
	    {
	      $realip = $_SERVER["HTTP_CLIENT_IP"];
	    }
	    else
	    {
	      $realip = $_SERVER["REMOTE_ADDR"];
	    }
	  }
	  else
	  {
	    if ( getenv( 'HTTP_X_FORWARDED_FOR' ) )
	    {
	      $realip = getenv( 'HTTP_X_FORWARDED_FOR' );
	    }
	    elseif ( getenv( 'HTTP_CLIENT_IP' ) )
	    {
	      $realip = getenv( 'HTTP_CLIENT_IP' );
	    }
	    else
	    {
	      $realip = getenv( 'REMOTE_ADDR' );
	    }
	  }

	  return $realip;
	}
}
//----------------------------
//
// This function is a common 'footer' for Perfect Response pages 
//
//----------------------------
if (!function_exists(JumpToCampaign))
{
	function JumpToCampaign($link, $arid)
	{
		$user = $_COOKIE["UName"];
		
		//die("settings (".__LINE__.") would jump to script $_SERVER[SCRIPT_NAME]");
		print("<hr><div style='height:23px;width:400px;margin:20px auto;'><div style='float:left;'>\n");
		$AutoresponderResult 	= mysql_query("SELECT * FROM autoresponders where user='$user' order by ardescription", $link); 
		$NumberOfAutoresponders = mysql_num_rows($AutoresponderResult); 		

		if($NumberOfAutoresponders > 0) //autoresponder=email campaign
		{
			print ("<form name='formJump' action='$_SERVER[SCRIPT_NAME]' method='get'>\n");  //this script
			print ("<input type='hidden' name='NewArid' value='$arid'>\n");
			print ("<input type='hidden' name='cmd' value=1>\n");
			print ("<select style='color:#800000;font-weight:bold;font-size:12px;width:230px;' size='1' name='arid' onChange='submit();'>\n");
			print ("<option selected value='0'>Select Another Email Campaign</option>\n");

			for($count=0; $count < $NumberOfAutoresponders; $count++) 
			{
				mysql_data_seek($AutoresponderResult, $count); //set db pointer to next autoresponder
				$AutoresponderRow	= mysql_fetch_object($AutoresponderResult);
				$NextArid			= $AutoresponderRow->arid;
				$NextAridName		= $AutoresponderRow->ardescription;

				if ($arid != $NextArid) //can't jump from the current autoresponder
					printf ("<option value='$NextArid'>%03s $NextAridName</option>\n",$NextArid);
			}
			
			print ("</select></form>\n");
		}
		
		print("</div>\n<div style='float:left;'>&nbsp;:: <a href='ManageCampaigns.php' title=''>View All Campaigns</a>\n</div></div>\n");
	}
}	

if (!function_exists(ReferenceLinks))
{
	function ReferenceLinks($arid)
	{
		print("<div id='navKappa'>\n");
		print("<div id='navKappaPadlock' onMouseOver='this.style.backgroundColor=\"#ff0\"' onMouseOut='this.style.backgroundColor=\"transparent\"'>\n");
		print("<a href='unlock.php' target='Monitor' title='If you stopped all campaigns, restart them here.' onMouseOver='this.style.backgroundColor=\"transparent\"'>\n");
		print("<img src='./images/unlocked.png' alt='If you stopped all campaigns, restart them here.' style='border:none;'></a></div>\n");

		print("<div id='navKappaLinks'>\n");

		print("<a href='DisplayLog.php?f=activity' title='View the Activity Log' target='LogFile'>Refresh Log</a> ::\n"); 
		print("<a href='home.php'>Home</a> :: \n");
		print("<a href='DisplaySchedule.php?arid=$arid' title=\"View this campaign's schedule email delivery\" target='Monitor'>View Schedule</a> ::\n"); 
		print("<a href='/pr/home.php?arid=$arid&amp;cmd=1' onclick='return(LLogout());'>Logout</a>\n");

		print("<br/><br/><a href='mailout.php' target='Monitor'>Send All Past Due</a> :: \n"); 
		print("<a href='Monitor.php?arid=$arid' title=\"View this campaign's pending email delivery\" target='Monitor'>Monitor Pending</a></div>\n");

		print("<div id='navKappaStop' onMouseOver='this.style.backgroundColor=\"#ff0\"' onMouseOut='this.style.backgroundColor=\"transparent\"'>\n");
		print("<a href='lock.php' target='Monitor' title='Made a mistake? Immediately stop the email Send process.' onMouseOver='this.style.backgroundColor=\"transparent\"'>\n");
		print("<img src='./images/stop.gif' alt='Made a mistake? Immediately stop the email Send process.' style='border:none;margin-top:10px;'></a></div><br style='clear:left;'></div>\n");
	}
}

if (!function_exists(htmlWrapper))
{
	function htmlWrapper($Msg)
	{
		$Final  = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">';
		$Final .= '<HTML>';
		$Final .= '<HEAD>';
		$Final .= '<TITLE>Your Message - Perfect Response</TITLE>';
		$Final .= '</HEAD>';
		$Final .= '<body>';
		$Final .= "$Msg";
		$Final .= '</body>';
		$Final .= '</html>';
		return($Final);
	}
}
include("GetARstuff.php");
include("SwiftNeeded.php");
?>
