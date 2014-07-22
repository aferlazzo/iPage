<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright © Tony Ferlazzo 2004 
Version 1.0 Written by: Anthony Ferlazzo, anthony@prontocommercial.com

*/
?>
<HTML>
<HEAD>
<TITLE>Display All Schedule - Perfect Response</TITLE>
<meta name="robots" content="NoIndex, NoFollow">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="./css/PerfectResponse.css">
<style type="text/css" media="screen">
th, td {background:#fff;font-family:Verdana, Arial, Helvetica;color:#000080;font-size:x-small;padding:2px;white-space:nowrap;}
</style>
<script type="text/javascript">
<!--

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

//-->
</script>
</HEAD>
<BODY>
</body>
</html>
<div id='ProgressBarOutline'><div id='ProgressBar'></div></div>


<?
include ("check1.php");
$user = $_COOKIE["UName"];
$Order=$_GET['Order'];

include ("conn.php");
set_time_limit(0);
	
$WithinScript = "I am embedded in another script";
include("settings.php");
//include("removesettings.php"); 

//Get all the campaigns 'owned' by the logged in user

$arSQL = "select arid, ardescription from autoresponders where user='$user' order by ardescription";
$result_ar = mysql_query($arSQL) or die("DisplayAllSchedule (".__LINE__.") $arSQL");
$NumberOfCampaigns = mysql_num_rows($result_ar);

if ($NumberOfCampaigns == 0)
{
	print ("<h1>");
	print "<i>Perfect Response</i> Mail Campaign Schedule is empty</h1>\n";
}
else
{	
	for ($count = 0; $count < $NumberOfCampaigns; $count++)
	{
		mysql_data_seek($result_ar, $count);
		$arrow = mysql_fetch_array($result_ar);
		$ardescription = $arrow[ardescription];
		$Campaign[$count]['arid'] = $arrow[arid];
		$Campaign[$count]['Description'] = $arrow[ardescription];
	}
	
	/*
	for ($count = 0; $count < $NumberOfCampaigns; $count++) 
	{
    	print($Campaign[$count]['arid']." ".$Campaign[$count]['Description']."<br />\n");
	}
	*/
	// - - - - - - - - - - - - - - - - - - - - - - - - - - -
	//
	//	Determine the last message of each campaign
	//	
	// - - - - - - - - - - - - - - - - - - - - - - - - - - -
	
	//print ("Processing Schedule for \$arid $arid<br>");
	
	
	for ($count = 0; $count < $NumberOfCampaigns; $count++) 
	{
		$maxSQL = "select max(seqno) as maxseq from messages where arid=".$Campaign[$count]["arid"];  //determine the last message in campaign sequence
		$result_max = mysql_query($maxSQL) or die("$maxSQL");
		mysql_data_seek($result_max, 0);
		$maxrow = mysql_fetch_object($result_max);
		$maxmsg=$maxrow->maxseq + 1;
		
		if($maxmsg<1)
			$maxmsg=0;
		$Campaign[$count]['maxmsg'] = $maxmsg;
	}		
	/*
	for ($count = 0; $count < $NumberOfCampaigns; $count++) 
	{
    	print($Campaign[$count]['arid'] ." ".$Campaign[$count]['Description']." ". $Campaign[$count]['maxmsg']."<br />\n");
	}
	die();
	*/

	//
	//	Get all the records that have a current message number less than the maximum messages 
	//	from the users database
	//
	$SQL_Statement = "SELECT * FROM users where confirmed='Y' order by senddate, arid, fname";
		
	$Query_Result = mysql_query($SQL_Statement);
	$NumberOfUserMatches = mysql_num_rows($Query_Result);
	$TotalSubscribers = $NumberOfUserMatches;
	
	//$TotalSubscribers = 3000;
	
	if ($TotalSubscribers > 0)
	{
		print ("<table style='margin:16px 0;border:0 solid #000080;background:#004a8d;'>");
		//print ("<tr><td colspan='5' 	style=\"height:72px;background-image: url('images/PerfectResponseLogo-extend.jpg'); background-repeat: no-repeat;\"><br><br>&nbsp;</td></tr>");
		print ("<tr><th colspan='5' style='font-family: Verdana, Arial, Helvetica;color:#fff;background:#004a8d;font-size:medium;'>");
		//print ("<h2>Schedule For '".$ardescription."'</h2></th></tr>");
		print ("<tr><th colspan='5' style='color: #fff; background:#004a8d;'>".number_format($TotalSubscribers)." Subscribers As of ".date('l F j, Y g:i A')."</th></tr>");		
		print ("<tr><th style='text-align:left;width:430px;'>");
		print ("Send To Name &lt;Email Address&gt;</th>");
		//print ("<th width='360px' >Next Message's Subject</th>");
		//print ("<th style='width:70px;font-size:8px;'>Send Time</th>");
		print ("<th style='width:70px;'>Send In</th>");
		print ("<th style='width:60px;'>Message<br>Number</th><th>arid</th></tr>\n");
	}
	else
	{
		print ("<p>No messages are scheduled to be sent</p>");
	}
		
	//
	// for each user record...
	//	
	for($ucount=0;$ucount<$TotalSubscribers; $ucount++)
	{
		print("<script type='text/javascript'>ProgressBar($ucount, $TotalSubscribers, 500);</script>\n");
		mysql_data_seek($Query_Result, $ucount);
		$rowusr 		= mysql_fetch_object($Query_Result);
		$IP_Address 	= $rowusr->ip;
		$email 			= $rowusr->email;
		$MsgNo 			= $rowusr->currentmsg;
		$TimeToSendMsg	= $rowusr->senddate;
		$CurrentMsg		= $rowusr->currentmsg;
		$UserName 		= trim($rowusr->fname." ".$rowusr->lname);
		$arid			= $rowusr->arid;
		//print("<p>looking for a match for arid $arid, $CurrentMsg < maxmsg</p>"); 		 		
		$Found = false;
		for ($count = 0; ($count < $NumberOfCampaigns) && ($Found == false); $count++) 
		{
	    	if (($arid == $Campaign[$count]['arid']) && ($CurrentMsg < $Campaign[$count]['maxmsg']))
			{
				//print("arid: $arid, Messages in campaign: ".$Campaign[$count]['maxmsg']." current msg: $CurrentMsg<br />\n");
				$Found = true;
				break;
			}
		}
		
		if ($Found == true)
		{
			//print("<p>Found it </p>");
			print ("<tr><td>\n");		
			//printf ("%5s: ",number_format($ucount + 1));
			print("$UserName &lt;");
			print("$email");
			print("&gt;</td>\n");
			$sDateH = date("m-d-y H:i", $TimeToSendMsg);
			//print ("<td style='text-align:center;'>$sDateH");
			//	Format the current Date & Time		
		
			$cDateH = date("H");
			$cDateI = date('i');
			$cDateS = date('s');  
			$cDateM = date('m');
			$cDateD = date('d');
			$cDateY = date('y');
					
			$CurrentTime = mktime($cDateH, $cDateI, $cDateS, $cDateM, $cDateD, $cDateY);
			$Offset = $TimeToSendMsg - $CurrentTime;
				
			print ("<td style='text-align:center;'>");
			if ($Offset < 1)
				print("<b>Past Due</b>");
			else
			{			
				if ($Offset > 85399) //a day in seconds
				{
					$days = floor($Offset/85399);
					print ("$days d ");
					$Offset = $Offset % 85399;
				}
				else
					print("0 d ");
		
				if ($Offset > 3600) //an hour in seconds
				{
					$hours = floor($Offset/3600);
					print ("$hours h ");
					$Offset = $Offset % 3600;
				}
				else
					print("0 h ");
					
				if ($Offset > 60) //a minute in seconds
				{
					$minutes = floor($Offset/60);
					print ("$minutes m");
				}
				else
					print("0 d ");
			}  //end not past due	
					
			print ("<br></td>");
			print ("<td style='text-align:center;'>$MsgNo</td><td>$arid</td></tr>\n");

		} //if $Found == true
		/*
		else
			print("<p>No match found</p>");
		*/
		ob_flush();
		flush();  // needed ob_flush		
	}  //for each subscriber record
	print("</table><br />End of Report\n");	
	
} //end of number of campaign != 0
?>
		