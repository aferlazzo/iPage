<?php
require ("../include/authenticate.php");
?>

<!DOCTYPE html PUBLIC "-//W3//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/2000/REC-xhtml1-20000126/DTD/xhtml1-transitional.dtd">
<html xlns="http://www.w3.org.1999.xhtml">
<head>
<title>TableFix</title>
</head>

<body>

<?php

include ("../include/SetCookies.php");

/* variables to access Database */

	$Host="localhost";
	$DBname="lightnin_LoanApps";
	$TableName="WorkingStatusInfo";


	$Debug = false;

	/* first, connect to the MySQL DBMS on this server */

	$Link=mysql_connect ($Host, $User, $Password) or die ('I cannot connect to the DBMS because: '.mysql_error());

	$Query = "SELECT * from $TableName order by ReportDate";

    $Result=mysql_db_query($DBname, $Query, $Link);

	while ($Row=mysql_fetch_array($Result))
	{
		$ReportDate=$Row[ReportDate];
		$SSN=$Row[SSN];
		print ("Date Inserted $Row[ReportDate] \n");
		print ("SSN $Row[SSN] ");
		$Array = explode("/", $ReportDate);
		print ("Month $Array[0] Day $Array[1] Year $Array[2] ");
		$NewDate = $Array[2]."/".$Array[0]."/".$Array[1];
		print ("NewDate $NewDate<br />\n");
			
		$UpdateQuery = "UPDATE $TableName SET ReportDate='$NewDate' WHERE SSN='$SSN'";
/*
		if (!mysql_query ($UpdateQuery, $Link))
		{
			die("TableFix (".__LINE__.") The query was:<br>$Query2<br>\n");	
		}
*/
	}
?>
</body>

</html>