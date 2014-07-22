<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright © Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/

include("check1.php");
$user			= $_COOKIE["UName"];
Include("conn.php");
$ID				= $_POST["arid"];
$arid			= $_POST["arid"];
$xarname 		= $_POST["arname"];
$ardescription	= $_POST["ardescription"];
$xCampaignState	= $_POST["CampaignState"];
$xarfromemail	= $_POST["arfromemail"];
$xarreplytoemail= $_POST["arreplytoemail"];
$xarbademail 	= $_POST["arbademail"];
$xarmode		= $_POST["armode"];
$xremhtml		= $_POST["remhtml"];
$xremtext		= $_POST["remtext"];
$xaradminemail 	= $_POST["aradminemail"];
$xarsubemail 	= $_POST["arsubemail"];
$xpophostname 	= $_POST["pophostname"];
$xpopport 		= $_POST["popport"];
$xpopuname 		= $_POST["popuname"];
$xpoppwd 		= $_POST["poppwd"];
$xsmtphostname 	= $_POST["smtphostname"];
$xsmtpport 		= $_POST["smtpport"];
$xsmtpuname 	= $_POST["smtpuname"];
$xsmtppwd 		= $_POST["smtppwd"];
$xarwraplen		= $_POST["arwraplen"];
$xarwordwrap 	= $_POST["arwordwrap"];
$xcustomconf	= $_POST["customconf"];
$xcustompage	= $_POST["custompage"];
$xaremailformat = $_POST["aremailformat"];
//die("editaraction (".__LINE__.")user $user arid $arid description $ardescription<br />");
$WithinScript = "I know the arid";
include("settings.php");


$SQL = "select * from autoresponders where arid=$arid";
$result_ar = mysql_query($SQL) or die("editaraction (".__LINE__.") $SQL");
$arrow = mysql_fetch_array($result_ar);

if ($debugIt > 0)
{
	//logMessage ("editaraction (".__LINE__.") \$user: $user<br>");
	logMessage ("editaraction (".__LINE__.") \$arid: '$arid'<br>");
	if ($_POST["arname"] != $arrow["arname"])
		logMessage ("editaraction (".__LINE__.") \$arname changed: '$arrow[arname]' to '$_POST[arname]'");
			
	if ($_POST["ardescription"] != $arrow["ardescription"])
		logMessage ("editaraction (".__LINE__.") \$ardescription changed: '$arrow[ardescription]' to '$_POST[ardescription]'");
			
	if ($_POST["CampaignState"] != $arrow["CampaignState"])
		logMessage ("editaraction (".__LINE__.") \$CampaignState changed: '$arrow[CampaignState]' to '$_POST[CampaignState]'");
			
	if ($_POST["arfromemail"] != $arrow["arfromemail"])
		logMessage ("editaraction (".__LINE__.") \$arfromemail changed: '$arrow[arfromemail]' to '$_POST[arfromemail]'");
			
	if ($_POST["arreplytoemail"] != $arrow["arreplytoemail"])
		logMessage ("editaraction (".__LINE__.") \$arreplytoemail changed: '$arrow[arreplytoemail]' to '$_POST[arreplytoemail]'");
			
	if ($_POST["arbademail"] != $arrow["arbademail"])
		logMessage ("editaraction (".__LINE__.") \$arbademail changed: '$arrow[arbademail]' to '$_POST[arbademail]'");
			
	if ($_POST["aradminemail"] != $arrow["aradminemail"])
		logMessage ("editaraction (".__LINE__.") \$aradminemail changed: '$arrow[aradminemail]' to '$_POST[aradminemail]'");
			
	if ($_POST["arsubemail"] != $arrow["arsubemail"])
		logMessage ("editaraction (".__LINE__.") \$arsubemail changed: '$arrow[arsubemail]' to '$_POST[arsubemail]'");
			
	if ($_POST["armode"] != $arrow["armode"])
		logMessage ("editaraction (".__LINE__.") \$armode changed: '$arrow[armode]' to '$_POST[armode]'");
			
	if ($_POST["remtext"] != $arrow["remtext"])
		logMessage ("editaraction (".__LINE__.") \$remtext changed: '$arrow[remtext]' to '$_POST[remtext]'");
			
	if ($_POST["remhtml"] != $arrow["remhtml"])
		logMessage ("editaraction (".__LINE__.") \$remhtml changed: '$arrow[remhtml]' to '$_POST[remhtml]'");
			
	if ($_POST["smtphostname"] != $arrow["smtphostname"])
		logMessage ("editaraction (".__LINE__.") \$smtphostname changed: '$arrow[smtphostname]' to '$_POST[smtphostname]'");
			
	if ($_POST["smtpport"] != $arrow["smtpport"])
		logMessage ("editaraction (".__LINE__.") \$smtpport changed: '$arrow[smtpport]' to '$_POST[smtpport]'");
			
	if ($_POST["smtpuname"] != $arrow["smtpuname"])
		logMessage ("editaraction (".__LINE__.") \$smtpuname changed: '$arrow[smtpuname]' to '$_POST[smtpuname]'");
			
	if ($_POST["smtppwd"] != $arrow["smtppwd"])
		logMessage ("editaraction (".__LINE__.") \$smtppwd changed: '$arrow[smtppwd]' to '$_POST[smtppwd]'");
			
	if ($_POST["pophostname"] != $arrow["pophostname"])
		logMessage ("editaraction (".__LINE__.") \$pophostname changed: '$arrow[pophostname]' to '$_POST[pophostname]'");
			
	if ($_POST["popport"] != $arrow["popport"])
		logMessage ("editaraction (".__LINE__.") \$popport changed: '$arrow[popport]' to '$_POST[popport]'");
			
	if ($_POST["popuname"] != $arrow["popuname"])
		logMessage ("editaraction (".__LINE__.") \$popuname changed: '$arrow[popuname]' to '$_POST[popuname]'");
			
	if ($_POST["poppwd"] != $arrow["poppwd"])
		logMessage ("editaraction (".__LINE__.") \$poppwd changed: '$arrow[poppwd]' to '$_POST[poppwd]'");
			
	if ($_POST["arwordwrap"] != $arrow["arwordwrap"])
		logMessage ("editaraction (".__LINE__.") \$arwordwrap changed: '$arrow[arwordwrap]' to '$_POST[arwordwrap]'");
			
	if ($_POST["arwraplen"] != $arrow["arwraplen"])
		logMessage ("editaraction (".__LINE__.") \$arwraplen changed: '$arrow[arwraplen]' to '$_POST[arwraplen]'");
			
	if ($_POST["custompage"] != $arrow["custompage"])
		logMessage ("editaraction (".__LINE__.") \$custompage changed: '$arrow[custompage]' to '$_POST[custompage]'");
			
	if ($_POST["customconf"] != $arrow["customconf"])
		logMessage ("editaraction (".__LINE__.") \$customconf changed: '$arrow[customconf]' to '$_POST[customconf]'");
			
	if ($_POST["armailformat"] != $arrow["armailformat"])
		logMessage ("editaraction (".__LINE__.") \$armailformat changed: '$arrow[armailformat]' to '$_POST[armailformat]'");
}


if ($xcustomconf == 1) 
	$xcustomconf='1';
else
	$xcustomconf='';

if ($xarwordwrap == 1) 
	$xarwordwrap='1';
else
	$xarwordwrap='';

$strSQL  = "Update autoresponders set arname='$xarname',CampaignState='$xCampaignState',";
$strSQL .= "arfromemail='$xarfromemail',arreplytoemail='$xarreplytoemail',arbademail='$xarbademail',";
$strSQL .= "aradminemail='$xaradminemail',armode='$xarmode',arsubemail='$xarsubemail',";
$strSQL .= "pophostname='$xpophostname',popport='$xpopport',popuname='$xpopuname',poppwd='$xpoppwd',";
$strSQL .= "smtphostname='$xsmtphostname',smtpport='$xsmtpport',smtpuname='$xsmtpuname',smtppwd='$xsmtppwd',arwordwrap='$xarwordwrap',";
$strSQL .= "arwraplen=$xarwraplen, custompage='$xcustompage', customconf='$xcustomconf',";
$strSQL .= "aremailformat='$xaremailformat', remtext='$xremtext', remhtml='$xremhtml',";
$strSQL .= "ardescription='$ardescription', user='$user' where arid=$ID";

$result = mysql_query($strSQL, $link); 

if (!$result) 
{
	echo "<b>Unable to update record for Autoresponder $arname.<BR>Please go <a href ='void(history.back())'>back</a> and try again<br>$strSQL";
}	
	
//die("remhtml |$remhtml| remtext |$remtext|");
print("<script type='text/javascript'>\n");
print("location.href='CampaignManager.php?arid=$arid';\n");
print("</script>\n");
?>
