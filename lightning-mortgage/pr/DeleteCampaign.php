<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright © Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/

include("check1.php");
Include("conn.php");
$ID=$_GET["arid"];
$result = mysql_query("delete FROM autoresponders where arid=$ID", $link);
if($result != true)
	die ("delete $ID from autoresponders result is: |$result|");
$result = mysql_query("delete FROM users where arid=$ID", $link);
if($result != true)
	die ("delete $ID from users result is: |$result|");
$result = mysql_query("delete FROM messages where arid=$ID", $link);
if($result != true)
	die ("delete $ID from messages result is: |$result|");

//die("deleted arid $ID FROM autoresponders, users, messages successful");
Header("Location: ManageCampaigns.php"); 
?>