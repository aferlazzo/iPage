<?php
//Start the session
if ($_SERVER['SERVER_NAME'] == "www.lightning-mortgage.com")
{
	session_save_path("/home/users/web/b668/ipw.lightning-mortgage/public_html/cgi-bin/tmp"); 
}
else
if ($_SERVER['SERVER_NAME'] == "www.prontocommercial.com")
{
	session_save_path("/home/users/web/b1398/ipw.prontoco/public_html/cgi-bin/tmp"); 
}
else
{
	logMessage ("UnlockCampaigns&nbsp;&nbsp;(".__LINE__.")  No match for Server Name ".$_SESSION['SERVER_NAME']);			
	die("mailout() No match for Server Name ".$_SERVER['SERVER_NAME']);
}

session_start();
//echo 'Starting Session...<br />';

// die("<h1>UnlockCampaigns.php</h1>");

include("conn.php");
$WithinScript = "I am embedded in another script";
include("settings.php");

$arSQL = "select * from autoresponders order by arid";
$result_ar = mysql_query($arSQL) or die(logMessage("UnlockCampaigns (".__LINE__.") Could not $arSQL"));
$num_rows_ar = mysql_num_rows($result_ar) or die("UnlockCampaigns (".__LINE__.") Could not calculate number of rows");

for($count=0;$count<$num_rows_ar;$count++)
{
	mysql_data_seek($result_ar, $count) or die("UnlockCampaigns (".__LINE__.") Could not move pointer to next autoresponder row");
	$arrow = mysql_fetch_object($result_ar) or die("UnlockCampaigns (".__LINE__.") Could not read next autoresponder row");
	$arid = $arrow->arid;
	$Now = date ('m\/d\/y H:i:s'); //returns current date/time
	$ComputedLockTime = 500 + $Now; //add 5 minutes returned as unsigned integer

	$CampaignLockQuery  = "UPDATE autoresponders set LockExpiryTime = 0, LockKey=0";
	$CampaignLockQuery .= " WHERE arid=$arid limit 1";
	$Update_Result = mysql_query($CampaignLockQuery) or die("UnlockCampaigns (".__LINE__.") Could not lock |$arid|");
	printf("<p style='color:#039;font-family:verdana;font-size:small;'>UnlockCampaigns (".__LINE__.")  unlocking  |%03s| at %s</p>", $arid, $Now);			
	
}
exit;
?>
