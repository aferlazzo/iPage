<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright � Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/

// This script is the form action for import.php (imports users into an autoresponder)
$user = $_COOKIE["UName"];
include("check1.php");
include("conn.php");
$arid				= $_GET["arid"];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<HTML>
<HEAD>
<TITLE>DuplicateCheck</TITLE>
<meta name="robots" content="NoIndex, NoFollow">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="./css/PerfectResponse.css">
<link rel="stylesheet" type="text/css" href="./css/niftyCorners.css">
<script type="text/javascript" src="./js/PerfectResponse.js"></script>
<script type="text/javascript" src="./js/nifty.js"></script>
</HEAD>
<body>

<div id='ProgressBarOutline'><div id='ProgressBar'></div></div>
<div id="Wrapper"><div id="content">
<h2>Duplicate Check</h2>
<TABLE id='MyTable' BORDER=0 CELLPADDING=4 CELLSPACING=4 align="center">
	<TR>
		<TD>



<?php	
	if ($arid=="") 
	{
		echo "<b>Unable to find record for selected Autoresponder.<BR>Please go <a href ='void(history.back())'>back</a> and try again";
		exit;
	}
	
	$ar_result = mysql_query("SELECT * FROM autoresponders where arid=$arid", $link); 
	$num_rows = mysql_num_rows($ar_result);
	
	if ( $num_rows < 0 ) 
	{
		echo "<b>Unable to find record for selected Autoresponder.<BR>Please go <a href ='void(history.back())'>back</a> and try again";
		exit;
	}
	
	mysql_data_seek($ar_result, 0);
	$ar_row = mysql_fetch_object($ar_result);
	
	$admin_result = mysql_query("SELECT * FROM admin", $link); 
	mysql_data_seek($admin_result, 0);
	$row_admin = mysql_fetch_object($admin_result);
	$WithinScript = "I know the arid";
	include("settings.php");
	include("removesettings.php");

	set_time_limit(0); // don't time out when executing
	
	$SQL_Statement = "select count(uid) usrcount from users where arid=$arid";
	$Query_Result = mysql_query($SQL_Statement);
	mysql_data_seek($Query_Result, 0);
	$row = mysql_fetch_object($Query_Result);
	$usercount = $row->usrcount;
	print("<p>$usercount users are found in arid $arid</p>\n");
		
	$result = mysql_query("SELECT * FROM users where arid=$arid order by email", $link); 
	$num_rows = mysql_num_rows($result); 	
	
	// check for an existing record for the email address

	mysql_data_seek($result, 0); //point to first user
	$row = mysql_fetch_object($result); //fetch the row
	//print("<p>debug: |$row->email|</p>\n");
	$lastEmail = $row->email;
	$DeletedRows = 0;
	for($count=1; $count<$usercount; $count++)
	{	
		mysql_data_seek($result, $count); //move point to next user row
		$row = mysql_fetch_object($result); //fetch the row
	  $currentEmail = $row->email;
		$uid = $row->uid;
		
  		//print("<p>debug: count $count last email |$row->email| current email |$row->email|</p>\n");
	
	  if ($uid != "")
		{
      if($lastEmail == $currentEmail)
	  	{
		    if($currentEmail == "")
		      die("<p>email address for row $count is blank. uid is |$uid| arid is $arid.</p>\n");

  			print("<p>Removing duplicate email '$currentEmail'<br />in row $count uid $uid from arid $arid</p>");
  		  logMessage ("DuplicateCheck (".__LINE__.") Removing duplicate email '$currentEmail' from arid $arid");
			  $Query = "DELETE from users where arid=$arid AND email='$currentEmail' limit 1";
			  mysql_query($Query, $link) or die(logMessage("DuplicateCheck (".__LINE__.") Could not move pointer to next update user record"));
			  $DeletedRows++;
		  }
		  else
		    $lastEmail = $currentEmail;
		}
	  print("<script type='text/javascript'>ProgressBar($count, $usercount, 500);</script>\n");
	}	//end of for all emails in an arid
	
	//print("<p>$usercount users were in arid $arid.<BR/>\n");
	print("<p>$DeletedRows rows were deleted from the database.</p>\n");
	
	$SQL_Statement = "select count(uid) usrcount from users where arid=$arid";
	$Query_Result = mysql_query($SQL_Statement);
	mysql_data_seek($Query_Result, 0);
	$row = mysql_fetch_object($Query_Result);
	$usercount = $row->usrcount;
			
	print("<p>$usercount users are now in arid $arid.</p>\n");

?> 
		</td>
	</tr>
</TABLE>
</div></div>

</body>
</html>
