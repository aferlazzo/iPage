<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright � Tony Ferlazzo 2004 
Version 1.0 Written by: Anthony Ferlazzo, anthony@prontocommercial.com

*/

include("check1.php");
$user			= $_COOKIE["UName"];
$ID				= $_POST["arid"];
$arid			= $_POST["arid"];
$vtype			= $_POST["vtype"];
$UserName		= $_POST["UserName"];
$Email			= $_POST["Email"];
$MM				= $_POST["MM"];
$DD				= $_POST["DD"];
$YY				= $_POST["YY"];
$hh				= $_POST["hh"];
$mm				= $_POST["mm"];
$MessageNumber	= $_POST["MessageNumber"];
$Returned		= $_POST["Returned"];
$uid			= $_POST["uid"];
//die("EditSubscriberAction (".__LINE__.") arid: $arid vtype: $vtype Email: $Email UserName: $UserName Returned: $Returned");

$SendDate = mktime($hh, $mm, 0, $MM, $DD, $YY);

Include("conn.php");

$WithinScript = "I know the arid";
include("settings.php");


if ($Returned == "")
	$Returned = "false";

if ($Returned == "false")
{
	$found = 0;
	if($vtype == 'email')
	{
		$strSQL = "SELECT * FROM `users` WHERE `email` LIKE CONVERT( _utf8 '$Email' USING latin1 ) and arid=$arid LIMIT 1";
		//dir("$strSQL");
		$Query_Result = mysql_query($strSQL,$link);
		$num_rows = mysql_num_rows($Query_Result);

		if ( $num_rows <= 0 )
		{
			print("<script type='text/javascript'>;alert ('Email |$Email|\\nis not subscribed to arid |$arid|');</script>");
			$Returned=false;
		}
		else
			$found = 1;
	}

	if($vtype == 'username')
	{
		$UserName = ucwords(strtolower($UserName));
		$strSQL = "SELECT * FROM users WHERE fname LIKE '$UserName' and arid=$arid LIMIT 1";

		$Query_Result = mysql_query($strSQL,$link);
		$num_rows = mysql_num_rows($Query_Result);
		
		if ( $num_rows <= 0 )
		{
		  print("<script type='text/javascript'>;alert ('User Name |$UserName|\\nis not subscribed to arid |$arid|');</script>");
		  $Returned=false;
		}
		 else
		   $found = 1;		
	}
	if ($found == 1)
	{
		$Returned = "true";
		mysql_data_seek($Query_Result, 0);
		$row = mysql_fetch_object($Query_Result);
		$SendDate 		= $row->senddate;
		$MessageNumber 	= $row->currentmsg;
		$UserName 		= $row->fname;
		$Email 			= $row->email;
		$uid 			= $row->uid;
		/*
		$LockKeyOnRow	= $row->LockKey;
		$LockExpiryTime	= $row->LockExpiryTime;
		*/
		$MM = date("m", $SendDate);
		$DD = date("d", $SendDate);
		$YY = date("y", $SendDate);
		$hh = date("H", $SendDate);
		$mm = date("i", $SendDate);
	}
}
else   // $Returned =='true'
{
	$Returned = 'true';
	$strSQL  = "Update users set fname='$UserName',email='$Email',senddate='$SendDate',";
/*	$strSQL .= "LockKey=$LockKeyOnRow,LockExpiryTime=$LockExpiryTime,";*/
	$strSQL .= "currentmsg='$MessageNumber' where uid='$uid' limit 1";
	$Query_Result = mysql_query($strSQL, $link);
		
	if (!$Query_Result)
	{
		die (mysql_error($link));
	}
	print("<script language='javascript'>window.location.href='CampaignManager.php?arid=$arid&cmd=1';</script>\n");
}


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<HTML>
<HEAD>
<TITLE>Edit User Action - Perfect Response</TITLE>
<meta name="robots" content="NoIndex, NoFollow">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
</head>
<body>
<form name="EditUserForm" method="post" action="EditSubscriber.php" target='Main'>
<input type="hidden" name="arid" value="<?php echo $arid ?>">
<input type="hidden" name="vtype" value="<?php echo $vtype ?>">
<input type="hidden" name="UserName" value="<?php echo $UserName ?>">
<input type="hidden" name="Email" value="<?php echo $Email ?>">
<input type="hidden" name="MM" value="<?php echo $MM ?>">
<input type="hidden" name="DD" value="<?php echo $DD ?>">
<input type="hidden" name="YY" value="<?php echo $YY ?>">
<input type="hidden" name="hh" value="<?php echo $hh ?>">
<input type="hidden" name="mm" value="<?php echo $mm ?>">
<input type="hidden" name="MessageNumber" value="<?php echo $MessageNumber; ?>">
<input type="hidden" name="Returned" value="<?php echo $Returned; ?>">
<input type="hidden" name="uid" value="<?php echo $uid; ?>">
<script language='Javascript'>document.EditUserForm.submit();</script>
</form>
</body>
</html>
