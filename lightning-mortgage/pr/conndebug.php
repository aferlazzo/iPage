<?php
$dbhostname = "lightning-mortgage.ipowermysql.com";
$dbname = "lightnin_PerfectResponse";
$dbuname = "lightnin_tony";
$dbpwd = "ipowerwe";

$link = mysql_connect("$dbhostname", "$dbuname", "$dbpwd");
	if($link == false)
	{
		print("<p>conndebug (".__LINE__.") mysql_connect(\"$dbhostname\", \"$dbuname\", \"$dbpwd\");"); 		
		print("<p>conndebug (".__LINE__.") Could not connect to the database. Error: |".mysql_error()."|</p>");
		//print("<p>conndebug (".__LINE__.") dbhostname: |$dbhostname|</p>"); 		
		//print("<p>conndebug (".__LINE__.") dbuname: |$dbuname|</p>"); 		
		//print("<p>conndebug (".__LINE__.") dbpwd: |$dbpwd|</p>"); 
	} 
	else
	{
		print("<p>linked</p>");
		$Result = mysql_select_db("$dbname", $link);
		if (!$Result)
		{
			print("<p>conndebug (".__LINE__.") Could not select database |$dbname| ".mysql_error()."</p>");
		}
	}
?>
