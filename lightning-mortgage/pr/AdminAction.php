<?php
include("check1.php");
Include("conn.php");

$user = ucwords(strtolower($_COOKIE["UName"]));
$adminname  = $_POST['adminname'];
$adminpwd   = $_POST['adminpwd'];
$adminemail = $_POST['adminemail'];

// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =//
//																					//
// AdminAction.php: This script changes passwords and clones demo campaign for 		//
// new users																		//
//																					//
// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =//
/*

Perfect Response - Email Marketing at Its Best!
Copyright © Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<HTML>
<HEAD>
<TITLE>Admin Action - Perfect Response</TITLE>
<meta name="robots" content="NoIndex, NoFollow">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="./css/PerfectResponse.css">
<link rel="stylesheet" type="text/css" href="./css/niftyCorners.css">
<script type="text/javascript" src="./js/nifty.js"></script>
<script type="text/javascript">
<!--

//-------------------------------
//
//To do rounded corners on the <div id=' contents':
//
//(link rel="stylesheet" type="text/css" href="./css/niftyCorners.css")
//(script type="text/javascript" src="./js/nifty.js"></script)
//
//The function NiftyCheck performs a check for DOM support. If the test has passed,
//the Rounded function is called, that is now the only one function that you should 
//call to get nifty corners. It accepts five parameters, that are in order:
//
//   1. A CSS selector that indicates on wich elements apply the function
//   2. A string that indicates which corners to round: all, top, bottom, etc.
//   3. Outer color of the rounded corners
//   4. Inner color of the rounded corners
//   5. An optional fifth parameter, that will contain the options for Nifty Corners
//
//-------------------------------
window.onload=function(){
if(!NiftyCheck())
    return;
Rounded("div.Wrapper","all","#FFE4C4","#48D1CC","border #000080");
document.CloneIt.Submit.focus()
}
</script>
</HEAD>
<body>
<div class="Wrapper"style='width:540px;'><div class="content" style='background:#48D1CC; width:538px;'>
<?php

///die("|$user|$adminname|"); 
if ((strcasecmp($user,"admin")==0) && (strcasecmp($adminname,"admin") != 0))
{
	$strSQL  = "Insert admin set adminname='$adminname', adminpwd='$adminpwd', adminemail='$adminemail'";
	$result = mysql_query($strSQL, $link); 

	if (!$result) 
		print("<h2>Unable to Create Admin User '$adminname'</h2><p>".mysql_error()."</p>");
	else
		print("<h2>Admin User '$adminname' Created</h2>");
}
else
{
	$strSQL = "update admin set adminname='$adminname', adminpwd='$adminpwd' adminemail='$adminemail' where adminname='$adminname'";
	$result = mysql_query($strSQL, $link); 

	if (!$result){ 
		print("<h2>Unable to Update Admin User '$adminname'</h2><p>".mysql_error()."</p>");
		print("<p>strSQL is |$strSQL|</p>");
		
	}
	else
		print("<h2>Admin User '$adminname' Updated</h2>");
}
?>
	<form style='margin:16px auto 0;width:99%;text-align:center;'><input class='cancel' name='Cancel' type='button' id='Cancel' value='Continue' onClick='window.location.href="home.php"'
	onMouseover="this.className='MouseOver'" onMouseout="this.className='cancel'"></form>
</div></div>
</body>
</html>
