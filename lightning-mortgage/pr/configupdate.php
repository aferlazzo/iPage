<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright � Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/

include("check1.php");
include("conn.php");
$ID				= $_POST["arid"];
$arid			= $_POST["arid"];
$consubject		= $_POST["consubject"];
$conbody		= $_POST["conbody"];
$welconfsubject	= $_POST["welconfsubject"];
$welconfbody	= $_POST["welconfbody"];
$remsubject		= $_POST["remsubject"];
$rembody		= $_POST["rembody"];
$remconsubject	= $_POST["remconsubject"];
$remconbody		= $_POST["remconbody"];

$user			= $_COOKIE["UName"];

$WithinScript = "I know the arid";
include("settings.php");

if ($debugIt > 0)
{
	$Lconbody		= strlen($conbody);
	$Lwelconfbody	= strlen($welconfbody);
	$Lrembody 		= strlen($rembody);
	$Lremconbody 	= strlen($remconbody);
	
	logMessage("configupdate (".__LINE__.") Updating database. Length of conbody $Lconbody Length of welconfbody $Lwelconfbody Length of remconbody $Lremconbody Length of rembody $Lrembody");
}

$strSQL="Update autoresponders set consubject='$consubject', conbody='$conbody', welconfsubject='$welconfsubject', welconfbody='$welconfbody', remsubject='$remsubject', rembody='$rembody', remconsubject='$remconsubject',remconbody='$remconbody' where arid=$arid";

	$result = mysql_query($strSQL, $link); 

	
	if (!$result) 
	{
		echo "<b>Unable to update record for Autoresponder \"$arid\"<BR>Please go <a href ='void(history.back())'>back</a> and try again";
	}	
	Header("Location: CampaignManager.php?arid=$ID");
?>
