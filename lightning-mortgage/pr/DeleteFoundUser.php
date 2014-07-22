<?php
include("check1.php");
include("conn.php");
$email=$_POST['email'];
$arid=$_POST['arid'];
if(($email=="") || ($arid==""))
	exit("F");

$WithinScript = "I know the arid";
include("settings.php");
// Update the record from the users database. We do not delete unsubscriptions so that those addresses won't 
// be erroneously added a second time.
$DeleteQuery ="UPDATE users set currentmsg='254' where arid=$arid AND email='$email' limit 1";
//really delete with this:
//$DeleteQuery = "delete FROM users where email='$email' and arid=$arid limit 1";
$UserResult = mysql_query($DeleteQuery, $link);
if($UserResult == true)
	exit("T$DeleteQuery");
else
	exit("F");
