<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright � Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/
include("check1.php");
$user			= $_COOKIE["UName"];
include("conn.php");


$ID				= $_POST["arid"];
$arid			= $_POST["arid"];
$arname 		= $_POST["arname"];
$arfromemail	= $_POST["arfromemail"];
$arreplytoemail	= $_POST["arreplytoemail"];
$arbademail 	= $_POST["arbademail"];
$aradminemail 	= $_POST["aradminemail"];
$armode			= $_POST["armode"];
//mansubject
//manbody
//conpage
$remhtml		= $_POST["remhtml"];
$remtext		= $_POST["remtext"];

$smtphostname 	= $_POST["smtphostname"];
$smtpport 		= $_POST["smtpport"];
$smtpuname 		= $_POST["smtpuname"];
$smtppwd 		= $_POST["smtppwd"];
$pophostname 	= $_POST["pophostname"];
$popuname 		= $_POST["popuname"];
$poppwd 		= $_POST["poppwd"];
$popport 		= $_POST["popport"];
//jsmsg

$arsubemail 	= $_POST["arsubemail"];
$CampaignState	= $_POST["CampaignState"];
$aremailformat 	= $_POST["aremailformat"];
$arwraplen		= $_POST["arwraplen"];
$arwordwrap 	= $_POST["arwordwrap"];
$customconf		= $_POST["customconf"];
$custompage	 	= $_POST["custompage"];

$ardescription	= $_POST["ardescription"];
//user
//LockKey
//LockExpiryTime
//die("addaraction (".__LINE__.")user $user arid $arid description $ardescription<br />");

$WithinScript = "I am embedded in another script";
include("settings.php");

if ($debugIt > 0)
{
	logMessage ("addaraction (".__LINE__.") \$arid: $arid<br>");
	logMessage ("addaraction (".__LINE__.") \$arname: $arname<br>");	
	logMessage ("addaraction (".__LINE__.") \$CampaignState: $CampaignState<br>");
	logMessage ("addaraction (".__LINE__.") \$ardescription: $ardescription<br>");
	logMessage ("addaraction (".__LINE__.") \$arfromemail: $arfromemail<br>");
	logMessage ("addaraction (".__LINE__.") \$arreplytoemail: $arreplytoemail<br>");
	logMessage ("addaraction (".__LINE__.") \$arbademail: $arbademail<br>");
	logMessage ("addaraction (".__LINE__.") \$aradminemail: $aradminemail<br>");
	logMessage ("addaraction (".__LINE__.") \$arsubemail: $arsubemail<br>");
	logMessage ("addaraction (".__LINE__.") \$armode: $armode<br>");
	logMessage ("addaraction (".__LINE__.") \$remtext: $remtext<br>");
	logMessage ("addaraction (".__LINE__.") \$remhtml: $remhtml<br>");
	logMessage ("addaraction (".__LINE__.") \$pophostname: $pophostname<br>");
	logMessage ("addaraction (".__LINE__.") \$popport: $popport<br>");
	logMessage ("addaraction (".__LINE__.") \$popuname: $popuname<br>");
	logMessage ("addaraction (".__LINE__.") \$poppwd: $poppwd<br>");
	logMessage ("addaraction (".__LINE__.") \$smtphostname: $smtphostname<br>");
	logMessage ("addaraction (".__LINE__.") \$smtpport: $smtpport<br>");
	logMessage ("addaraction (".__LINE__.") \$smtpuname: $smtpuname<br>");
	logMessage ("addaraction (".__LINE__.") \$smtppwd: $smtppwd<br>");
	logMessage ("addaraction (".__LINE__.") \$customconpage: $customconpage<br>");
	logMessage ("addaraction (".__LINE__.") \$arwordwrap: $arwordwrap<br>"); 
	logMessage ("addaraction (".__LINE__.") \$arwraplen: $wraplen<br>");
	logMessage ("addaraction (".__LINE__.") \$custompage: $custompage<br>"); 
	logMessage ("addaraction (".__LINE__.") \$customconf: $customconf<br>");
	logMessage ("addaraction (".__LINE__.") \$aremailformat: $aremailformat<br>");
}

if ($chkcustompage!=1) 
	$chkcustompage=0;

if ($arwordwrap!=1) 
	$arwordwrap=0;

$ARinsert ="insert into prontoc2_pr.autoresponders (arname, CampaignState, arfromemail, arreplytoemail, ";
$ARinsert.="arbademail, aradminemail, armode, arsubemail, smtphostname, smtpport, smtpuname, smtppwd, pophostname, popport, popuname, poppwd, ";
$ARinsert.=" customconf, custompage, arwordwrap, arwraplen, remtext, remhtml, aremailformat, ardescription, user) ";

$ARinsert.="values(";
if(strlen($arname) == 0)
	$ARinsert.='NULL, ';
else
	$ARinsert.="'$arname', ";
if(strlen($CampaignState) == 0)
	$ARinsert.="NULL, ";
else
	$ARinsert.="'$CampaignState', ";
if(strlen($arfromemail) == 0)
	$ARinsert.="NULL, ";
else
	$ARinsert.="'$arfromemail', ";
if(strlen($arreplytoemail) == 0)
	$ARinsert.="NULL, ";
else
	$ARinsert.="'$arreplytoemail', " ;
if(strlen($arbademail) == 0)
	$ARinsert.="NULL, ";
else
	$ARinsert.="'$arbademail', ";
if(strlen($aradminemail) == 0)
	$ARinsert.="NULL, ";
else
	$ARinsert.="'$aradminemail', " ;

if(strlen($armode) == 0)
	$ARinsert.='1, ';
else
	$ARinsert.="$armode, ";
if(strlen($arsubemail) == 0)
	$ARinsert.="NULL, ";
else
	$ARinsert.="'$arsubemail', ";
if(strlen($smtphostname) == 0)
	$ARinsert.="NULL, ";
else
	$ARinsert.="'$smtphostname', ";
if(strlen($smtpport) == 0)
	$ARinsert.="25, ";
else
	$ARinsert.="$smtpport, " ;
if(strlen($smtpuname) == 0)
	$ARinsert.="NULL, ";
else
	$ARinsert.="'$smtpuname', ";
if(strlen($smtppwd) == 0)
	$ARinsert.="NULL, ";
else
	$ARinsert.="'$smtppwd', " ;
	
	
if(strlen($pophostname) == 0)
	$ARinsert.="NULL, ";
else
	$ARinsert.="'$pophostname', ";
if(strlen($popport) == 0)
	$ARinsert.="110, ";
else
	$ARinsert.="$popport, " ;
if(strlen($popuname) == 0)
	$ARinsert.="NULL, ";
else
	$ARinsert.="'$popuname', ";
if(strlen($poppwd) == 0)
	$ARinsert.="NULL, ";
else
	$ARinsert.="'$poppwd', ";

	
	
	
if(strlen($customconf) == 0)
	$ARinsert.="0, ";
else
	$ARinsert.="$customconf, " ;

if(strlen($custompage) == 0)
	$ARinsert.="NULL, ";
else
	$ARinsert.="'$custompage', ";
if(strlen($arwordwrap) == 0)
	$ARinsert.="0, ";
else
	$ARinsert.="$arwordwrap, ";
if(strlen($arwraplen) == 0)
	$ARinsert.="60, ";
else
	$ARinsert.="$arwraplen, ";
if(strlen($remtext) == 0)
	$ARinsert.="NULL, ";
else
	$ARinsert.="'$remtext', ";
if(strlen($remhtml) == 0)
	$ARinsert.="NULL, ";
else
	$ARinsert.="'$remhtml', " ;

if(strlen($aremailformat) == 0)
	$ARinsert.="0, ";
else
	$ARinsert.="$aremailformat, " ;
if(strlen($ardescription) == 0)
	$ARinsert.="NULL, ";
else
	$ARinsert.="'$ardescription', ";
if(strlen($user) == 0)
	$ARinsert.="NULL)";
else
	$ARinsert.="'$user')";	


$result = mysql_query($ARinsert, $link) or die("AddCampaignAction.php (".__LINE__.") insert error SQL is<br />$ARinsert<br />");

$arid=mysql_insert_id(); //now get the assigned arid for the inserted record
mysql_close($link);

//	Every campaign will have the following common messages:
//	squno	subject
//	-------	---------
//	996		Subscription Confirmation Message, in a 2-step opt-in
//	997		Welcome Message
//	998		Unscuscribe Acknowledgement Message
//	999		Campaign Signature
//
// When adding a new autoresponder, these empty messages will need to be created. 
// This is accomplished by having AddCampaign.php pass the $NewAR variable

print ("<html><head></head><body><form name='AddMsg' enctype='multipart/form-data' method='post' action='AddMessageAction.php'>");
print ("<input type='hidden' name='arid' value=$arid>");
print ("<input type='hidden' name='MAX_FILE_SIZE' value='300000'>");

print ("<input type='hidden' name='subject' value= ''>");
print ("<input type='hidden' name='body' value= ''>");
print ("<input type='hidden' name='delay' value= ''>");
print ("<input type='hidden' name='NewAR' value=true>");

print ("<script language='Javascript'>document.AddMsg.submit();</script>");
print ("</form></body></html>");
die("debug");

//die("remhtml |$remhtml| remtext |$remtext|");
print ("<script javascript>location.href='manar.php';</script>");	
//Header("Location: manar.php"); 
?>
