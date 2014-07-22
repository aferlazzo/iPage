<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright © Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/
?>
<HTML>
<HEAD>
<TITLE>Display Schedule - Perfect Response</TITLE>
<meta name="robots" content="NoIndex, NoFollow">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="./css/PerfectResponse.css">
<link rel="stylesheet" type="text/css" href="./css/niftyCorners.css">
<script type="text/javascript" src="./js/PerfectResponse.js"></script>
<script type="text/javascript" src="./js/nifty.js"></script>
<style type="text/css" media="screen">
th, td {font-family:Verdana, Arial, Helvetica;color:#000080;font-size:x-small;padding:2px 0;white-space:nowrap;}
.content{width:666px;}
.wrapper{width:668px;}
</style>
</HEAD>
<body>
<div id='ProgressBarOutline'><div id='ProgressBar'></div></div>
<div id="Wrapper"><div id="content">
<?

include ("conn.php");
$arid=$_GET['arid'];
$WithinScript = "I know the arid";
include("settings.php");
include("removesettings.php");
date_default_timezone_set('America/Los_Angeles');
$arSQL = "select arid, ardescription from autoresponders where arid=$arid";
$result_ar = mysql_query($arSQL) or die("Display Schedule (".__LINE__.") $arSQL");
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

	$Mail_Error_Flag = 1;
	
	$WallclockTime = mktime(date("H")+2,date("i"),date("s"),date("m"),date("d"),date("Y"));
	
	$maxSQL = "select max(seqno) as maxseq from messages where arid=$arid";
	$result_max = mysql_query($maxSQL) or die("$maxSQL");
	mysql_data_seek($result_max, 0);
	$maxrow = mysql_fetch_object($result_max);
	$maxmsg=$maxrow->maxseq;
	
	if($maxmsg<1)
		$maxmsg=0;
	
	//
	//	Get all the records that have a current message number less than the maximum messages 
	//	from the users database
	//
	
	$SQL_Statement = "SELECT * FROM users where currentmsg<=$maxmsg and arid=$arid and confirmed='Y' order by senddate, fname";
	$Query_Result = mysql_query($SQL_Statement);
	$num_rows_usr = mysql_num_rows($Query_Result);
	if ($num_rows_usr > 0)
	{
		print ("<table id='MyTable' style='background: url(\"../pr/images/background.jpg\") repeat-x;'>");
		print ("<tr><th colspan='4' style='font-family: Verdana, Arial, Helvetica;background:#48D1CC;font-size:medium;'>");
		print ("<h2>Schedule For '".$ardescription."'</h2></th></tr>");
		print ("<tr><th colspan='4' style='background:#48D1CC;'>".number_format($num_rows_usr)." Subscribers As of ".date('l F j, Y g:i A')."</th></tr>");		
		print ("<tr><th>Del Edit </th><th style='text-align:left;width:430px;'>");
		print ("Send To Name &lt;Email Address&gt;</th>");
		//print ("<th width='360px' >Next Message's Subject</th>");
		//print ("<th style='width:70px;font-size:8px;'>Send Time</th>");
		print ("<th style='width:70px;'>Send In</th>");
		print ("<th style='width:60px;'>Message<br>Number</th></tr>\n");
	}
	else
	{
		print ("No messages are scheduled to be sent<br>");
	}
	
	//
	// for each user record...
	//	
	for($ucount=0;$ucount<$num_rows_usr;$ucount++)
	{
		mysql_data_seek($Query_Result, $ucount);
		$rowusr 		= mysql_fetch_object($Query_Result);
		$IP_Address 	= $rowusr->ip;
		$email 			= $rowusr->email;
		$MsgNo 			= $rowusr->currentmsg;
		$TimeToSendMsg	= $rowusr->senddate;
		$uid			= $rowusr->uid;

		$UserName 		= trim($rowusr->fname." ".$rowusr->lname);
		
		//print("<p>Line (".__LINE__.") Inspecting record: |$UserName| message number: $MsgNo  maxmsg: $maxmsg</p>\n");
		

//	Print this message's fields
//	Format this user record's Date & Time from the field Mail_Send_Date 

		//print("<p>line (".__LINE__.") row $ucount is on msg |$MsgNo| for max of |$maxmsg|</p>");
		if ($MsgNo <= $maxmsg)
		{
			$ThisTR = $arid."Row".$ucount;
			print ("<tr id='$ThisTR' onMouseover='this.style.backgroundColor=\"#fff\"' onMouseout='this.style.backgroundColor=\"transparent\"'>\n");		
			//printf ("%5s: ",number_format($ucount + 1));
			print("<form name='MyForm$ThisTR' method='post' target='Main' action='EditSubscriberAction.php'>\n");
			print("<td><input id='chk$ThisTR' class='radiogroup' type='checkbox' style='height:16px;margin:0 5px 0 5px;padding:0;vertical-align:bottom;' onclick='DeleteRow(\"$email\", $arid, $ucount);'>\n");

			print("<input type='hidden' name='Returned' value='false'>\n");
			print("<input type='hidden' name='arid'  value='$arid'>\n");
			print("<input type='hidden' name='Email' value='$email'>\n");
			print("<input type='hidden' name='uid'   value='$uid'>\n");
			print("<input type='hidden' name='vtype' value='email'>\n");
			print("<input id='Editchk$ThisTR' class='radiogroup' type='checkbox' style='height:16px;margin:0;padding:0;vertical-align:bottom;' onclick='this.form.submit();'></form></td>\n");

			print("<td>$UserName &lt;");
			print("$email");
			print("&gt;</td>\n");
	
// 		Get the *current* message db record in this autoresponder's sequence
	//	Read the *current* actual message we're planning to send
	
			$msgSQL = "select * from messages where arid=$arid and seqno=$MsgNo order by seqno limit 0,1";
			$result_msg = mysql_query($msgSQL) or die("$msgSQL");
			$num_rows_msg = mysql_num_rows($result_msg);
	
			if($num_rows_msg>0)  // if message is not empty
			{
				mysql_data_seek($result_msg, 0);
				$row_msg = mysql_fetch_object($result_msg);			
				$txtMessage_Subject = $row_msg->subject;
			}
			else
				$txtMessage_Subject = "Unknown";
			
			//print ("<td>$txtMessage_Subject</td>");

			$sDateH = date("m-d-y H:i", $TimeToSendMsg);
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
			print ("<td style='text-align:center;'>");
			
			if ($Offset > 85399) //a day in seconds
			{
				$days = floor($Offset/85399);
				print ("$days d ");
				$Offset = $Offset % 85399;
			}
				
			if ($Offset > 3600) //an hour in seconds
			{
				$hours = floor($Offset/3600);
				print ("$hours h ");
				$Offset = $Offset % 3600;
			}
			
			if ($Offset > 60) //a minute in seconds
			{
				$minutes = floor($Offset/60);
				print ("$minutes m");
			}
			
			if ($Offset < 1)
				print("<b>Past Due</b>");
			print ("<br></td>");
			print ("<td style='text-align:center;'>".$MsgNo."</td></tr>\n");
		} // if message no < maxmsg

		//print("<p>line (".__LINE__.") row $ucount end</p>");

		print("<script type='text/javascript'>ProgressBar($ucount, $num_rows_usr, 500);</script>\n");		
		ob_flush();
		flush();  // needed ob_flush
	} //for number of users
	
	print("</table>\n");	
}
?>
</div>
</body>
</html>

