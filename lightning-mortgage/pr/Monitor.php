<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright © Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/
?>
<HTML>
<HEAD>
<TITLE>Monitor Campaign - Perfect Response</TITLE>
<meta name="robots" content="NoIndex, NoFollow">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="./css/PerfectResponse.css">
<link rel="stylesheet" type="text/css" href="./css/niftyCorners.css">
<script type="text/javascript" src="./js/PerfectResponse.js"></script>
<script type="text/javascript" src="../js/Monitor.js"></script>
<script type="text/javascript" src="./js/nifty.js"></script>
<style type="text/css" media="screen">
th, td {font-family:Verdana, Arial, Helvetica;color:#000080;font-size:x-small;padding:2px 4px;white-space:nowrap;}
.content{width:666px;}
.wrapper{width:668px;}
</style>
</HEAD>
<body>
<div id="Wrapper"><div id="content">
<?

include ("conn.php");
$arid=$_GET['arid'];
$WithinScript = "I know the arid";
include("settings.php");
include("removesettings.php");

//get the campaign name for the report header
$arSQL = "select arid, ardescription from autoresponders where arid=$arid";
$result_ar = mysql_query($arSQL) or die("Schedule (".__LINE__.") $arSQL");
$num_rows_ar = mysql_num_rows($result_ar);

mysql_data_seek($result_ar, $count);
$arrow = mysql_fetch_array($result_ar);
$ardescription = $arrow[ardescription];

if ($num_rows_ar == 0)
{
	print ("<h1>");
	print "<i>Perfect Response</i> Mail Campaign Schedule is empty</h1>\n";
}
else

// - - - - - - - - - - - - - - - - - - - - - - - - - - -
//
//	ReadSchedule
//	
// - - - - - - - - - - - - - - - - - - - - - - - - - - -

{
	//print ("Processing Schedule for \$arid $arid<br>");
	set_time_limit(0);

	$maxSQL = "select max(seqno) as maxseq from messages where arid=$arid";
	$result_max = mysql_query($maxSQL) or die("$maxSQL");
	mysql_data_seek($result_max, 0);
	$maxrow = mysql_fetch_object($result_max);
	$maxmsg=$maxrow->maxseq;  //number of total msgs in campaign
	
	if($maxmsg<1)
		$maxmsg=0;
	
	//
	//	Get all the records that have a current message number less than the maximum messages 
	//	from the users database
	//
	
	$SQL_Statement = "SELECT * FROM users where currentmsg<=$maxmsg and arid=$arid and confirmed='Y' order by currentmsg, fname";
	$Query_Result = mysql_query($SQL_Statement);
	$num_rows_usr = mysql_num_rows($Query_Result);

	print("<script type='text/javascript'>arid=$arid;</script>"); //needed for the javascript/Ajax functions

	if ($num_rows_usr > 0)
	{
		print ("<table id='MyTable'>");
		print ("<tr><th colspan='3'>\n");
		print ("<h2>Monitoring '".$ardescription."'</h2></th></tr>\n");
		print ("<tr><th colspan='3' style='background:#48D1CC;'>\n");
		print (number_format($num_rows_usr)." Subscribers As Of ".date('l F j, Y')."</th></tr>\n");		
		print ("<tr><th style='text-align:left;width:400px;'>Subscriber Name &lt;Email Address&gt;</th>\n");
		print ("<th width='70px' >Send In</th>\n");
		print ("<th width='40px' >Message<br>Number</th></tr>\n");
	}
	else
	{
		print ("<h2>No messages are scheduled to be sent</h2>\n");
	}
	
	//
	// for each subscriber  row...
	//	
	for($ucount=0;$ucount<$num_rows_usr;$ucount++)
	{
		mysql_data_seek($Query_Result, $ucount);
		$rowusr 		= mysql_fetch_object($Query_Result);
		$IP_Address 	= $rowusr->ip;
		$email 			= $rowusr->email;
		$MsgNo 			= $rowusr->currentmsg;
		$TimeToSendMsg	= $rowusr->senddate;

		$UserName 		= trim($rowusr->fname." ".$rowusr->lname);
		
		//print("<p>Line (".__LINE__.") Inspecting record: |$UserName| message number: $MsgNo  maxmsg: $maxmsg</p>\n");
		
		print("<script type='text/javascript'>TimeToSendMsg$ucount=$TimeToSendMsg;</script>"); //needed for the javascript/Ajax functions
		print("<script type='text/javascript'>email$ucount='$email';</script>"); //needed for the javascript/Ajax functions
		print("<script type='text/javascript'>seqno$ucount=$MsgNo;</script>"); //needed for the javascript/Ajax functions

//	Print this message's fields
//	Format this user record's Date & Time from the field Mail_Send_Date 

		//print("<p>line (".__LINE__.") row $ucount is on msg |$MsgNo| for max of |$maxmsg|</p>\n");
		if ($MsgNo <= $maxmsg)
		{
			print ("<tr onMouseover='this.style.backgroundColor=\"#fff\";' onMouseout='this.style.backgroundColor=\"transparent\"'><td>\n");		
			//printf ("%5s: ",number_format($ucount + 1));
			print("$UserName &lt;");
			print("$email");
			print("&gt;</td>\n");
	
	//	Read the *current* actual message we're planning to send to get the Subject for the report
	
/*
			$msgSQL = "select * from messages where arid=$arid and seqno=$MsgNo order by seqno limit 0,1";
			$result_msg = mysql_query($msgSQL) or die("$msgSQL");
			$num_rows_msg = mysql_num_rows($result_msg);
	
			if($num_rows_msg>0)  // if message is not empty
			{
				mysql_data_seek($result_msg, 0);
				$row_msg = mysql_fetch_object($result_msg);			
				$Subject = $row_msg->subject;
			}
			else
				$Subject = "Unknown";
			
			print ("<td>$Subject</td>\n");
*/
			$sDateH = date("m-d-y H:i", $TimeToSendMsg);  //from user (the subscriber) row
			//print ("<td style='text-align:center;'>$sDateH");
//		Format the current Date & Time		
	
			$cDateH = date("H");
			$cDateI = date('i');
			$cDateS = date('s');  
			$cDateM = date('m');
			$cDateD = date('d');
			$cDateY = date('y');
			
			
			//print (" will send in ".($sDateD - $cDateD)." days, ".($sDateH - $cDateH)." hours, ".($sDateI - $cDateI)." minutes");
			$CurrentTime = mktime($cDateH, $cDateI, $cDateS, $cDateM, $cDateD, $cDateY);
			$Offset = $TimeToSendMsg - $CurrentTime;
			
			//print (" will send in ");
			print ("<td id='SendStatus$ucount' style='text-align:center;'>\n"); // to store the updated time
			
			if ($Offset < 1)
				print("<b>Past Due</b>\n");
			else
			{
				$days = floor($Offset/85399);//a day in seconds
				$Offset = $Offset % 85399;
				$hours = floor($Offset/3600);//an hour in seconds
				$Offset = $Offset % 3600;
				$minutes = floor($Offset/60);//a minute in seconds
				printf("%u d %02u:%02u", $days, $hours, $minutes);
			}
			print ("</td>\n");
			print ("<td style='text-align:center;'>".$MsgNo."</td></tr>\n");
		} // if message no < maxmsg

		//print("<p>line (".__LINE__.") row $ucount end</p>\n");
		
	} //for number of users
	
	print("</table>\n");	
}

print ("<br><center>\n");

print("<script type='text/javascript'>RowsInReport=$num_rows_usr;</script>"); //needed for the javascript/Ajax functions
?>
</div>

</body>
</html>
