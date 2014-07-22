<?php
include("conn.php");
$WithinScript = "I am embedded in another script";
include("settings.php");

print("<link rel='stylesheet' type='text/css' href='./css/PerfectResponse.css'>");
print("<style type='text/css'>\n");	
print("h1, h2, p {color:#039;font-family:verdana;white-space:nowrap;}\n");
print("</style>\n");

$dir="mailout.stop";

if (file_exists($dir))
{
	if (rmdir($dir)) 
	{
		logMessage("unlock (".__LINE__.") The Kill Switch was removed for all mailout processes");
		print("<h2>The Kill Switch was removed for all mailout processes.<br />The mailout process is now unlocked.</h2>");
	}
} 
else
{
	logMessage("unlock (".__LINE__.") The mailout processes were not locked");
	print("<h2>Could not unlock Perfect Response mailout process<br />(Process is not locked...)</h2>");
	exit;
}

include("conn.php");
$WithinScript = "I am embedded in another script";
//include("settings.php");

$arSQL = "select * from autoresponders order by arid";
$result_ar = mysql_query($arSQL) or die(logMessage("UnlockCampaigns (".__LINE__.") Could not $arSQL"));
$num_rows_ar = mysql_num_rows($result_ar) or die("UnlockCampaigns (".__LINE__.") Could not calculate number of rows");
$camps = "Unlocking campaigns ";

for($count=0;$count<$num_rows_ar;$count++)
{
	if($count > 0)
		$camps .= ", ";
	mysql_data_seek($result_ar, $count) or die("UnlockCampaigns (".__LINE__.") Could not move pointer to next autoresponder row");
	$arrow = mysql_fetch_object($result_ar) or die("UnlockCampaigns (".__LINE__.") Could not read next autoresponder row");
	$arid = $arrow->arid;
	$Now = date ('m\/d\/y H:i:s'); //returns current date/time
	$ComputedLockTime = 500 + $Now; //add 5 minutes returned as unsigned integer

	$CampaignLockQuery  = "UPDATE autoresponders set LockExpiryTime = 0, LockKey=0";
	$CampaignLockQuery .= " WHERE arid=$arid limit 1";
	$Update_Result = mysql_query($CampaignLockQuery) or die("UnlockCampaigns (".__LINE__.") Could not unlock |$arid|");
	$camps .= sprintf("'%03s'", $arid);			
}
print("<p>$camps</p>");
logMessage("unlock (".__LINE__.") $camps");	
exit;
?>
