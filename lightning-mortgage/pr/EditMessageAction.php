<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright � Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/

$mid		= $_POST['mid'];
$arid		= $_POST['arid'];
$subject	= $_POST["subject"];
$body		= $_POST["PerfectResponseMessage"];
$delay		= $_POST["delay"];

include("check1.php");
Include("conn.php");

mysql_query("update messages set arid=$arid, subject='$subject', body='$body', delay=$delay where mid=$mid and arid=$arid", $link) or 
	die("editmsgaction (".__LINE__.") Failed: update messages set arid=$arid, subject='$subject', body='$body', delay=$delay where mid=$mid and arid=$arid");


if (is_uploaded_file($ufile))
{
	$tempUmask = umask();
	umask(0000);
	
	if ($debugIt == 2)
		print("Attempting to create: attachments/$arid\n");
	
	if (!file_exists("attachments/$arid"))
		@mkdir("attachments/$arid", 0777);
	
	if (!file_exists("attachments/$arid$mid"))
		@mkdir("attachments/$arid/$mid", 0777);
	
	$fname = $_FILES['ufile']['name'];
	$Destination = "attachments/$arid/$mid/$fname";
	
	move_uploaded_file($ufile, $Destination);
	
	if ($debugIt == 2)
		print ("addmsgaction (".__LINE__.") copied '$fname' to '$Destination'");
		
	//copy($ufile, "attachments/$arid/$mid/$fname");
	//umask($tempUmask);
}	

if (is_uploaded_file($uimage))
{
	$uimage = $_FILES['uimage']['name'];
	$uimagetmp = $_FILES['uimage']['tmp_name'];
	//logMessage("editmsgaction (".__LINE__.") Attempting to upload image: $uimage");

	$Destination = "/home/lightnin/public_html/pr/uploadedimages/$uimage";
	
	$Result = move_uploaded_file($uimagetmp, $Destination);
	if($Result == false)
		logMessage("editmsgaction (".__LINE__.") Error uploading |$uimagetmp| to |$Destination|");
	else
	{
		//logMessage("editmsgaction (".__LINE__.") Image upload complete");
	}	

}	
$result = mysql_query("update messages set subject='$subject',body='$body',delay=$delay where mid=$mid", $link);
mysql_close($link);
print("<script type='text/javascript'>\nparent.Monitor.document.open();\n</script>\n");
print("<script type='text/javascript'>\nparent.Monitor.document.close();\n</script>\n");
print("<script type='text/javascript'>\nparent.Main.location.href='ManageMessages.php?arid=$arid';\n</script>\n");
?>
