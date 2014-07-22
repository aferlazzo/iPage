<?php
//echo "success";

$user	= $_COOKIE['UName'];
if (isset($_GET['Stat']))  //for testing use command line URI
	$Stat = $_GET['Stat'];
else
	$Stat = $_POST['Stat'];

include("conn.php");
	$SQL = "select * from admin where adminname='$user'";
	$result_ar = mysql_query($SQL) or die("ToggleCampaignStatus (".__LINE__.") $SQL");
	$arrow = mysql_fetch_array($result_ar);
	
	//$arrow['SMTPDebugging'] holds current status

	if ($Stat == 1)  //debugging is on 
	{
		$strSQL  = "Update admin set SMTPDebugging=0 where adminname='$user'";
		$result = mysql_query($strSQL, $link); 
		if ($result == true) 
			echo(0);
		else
			echo(1);
	}
	elseif ($Stat == "0") 
	{
		$strSQL  = "Update admin set SMTPDebugging=1 where adminname='$user'";
		$result = mysql_query($strSQL, $link); 
		if ($result == true) 
			echo(1);
		else
			echo(0);
	}
	else
		echo(2);  //should never get
?>
