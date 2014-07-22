<?php
include("conn.php");
$WithinScript = "I am embedded in another script";
include("settings.php");
print("<link rel='stylesheet' type='text/css' href='./css/PerfectResponse.css'>");
print("<style type='text/css'>\n");	
print("h1, h2, p {color:#039;font-family:verdana;white-space:nowrap;}\n");
print("</style>\n");


$dir="mailout.stop";

if (file_exists($dir) == false)
{
	if (mkdir($dir)) 
	{
		logMessage("lock (".__LINE__.") The Kill Switch was thrown for all mailout processes");
		print("<h2>The Kill Switch was throw for all mailout processes.<br />The mailout process is now locked.</h2>");
	}
}
else 
{
	logMessage("lock (".__LINE__.") The mailout processes were already locked.");
	print("<h2>Could not lock Perfect Response mailout process<br />(Process is already locked...)</h2>");
}
?>
