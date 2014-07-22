<html>
<head>
<title>CreateDB</title>
</head>
<body>
<?php
$Host="localhost";
$User="lightnin_Tony";
$Password="ipowerwe";
$DBname="lightnin_LoanApps";
$TableName="TestDB";

print ("Attempting to connect to the DBMS<BR>\n");
/* first connect to the MySQL DBMS on this server */
$Link=mysql_connect ($Host, $User, $Password) or die ('I cannot connect to the DBMS because: '.mysql_error());

print ("Connect to the DBMS was successful!<BR>\n");

/* now create the new database */
// if (mysql_create_db('$DBname', $Link))
// {
//	print ("The database '$DBname' was successfully created!<br>\n");
// }
// else
// {
//    print("Getting ready to create a table called '$TestDB'<br>\n");
// }

	/* now create a table in $DBname */

	$Query="CREATE table $TableName (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	DateEntered TIMESTAMP (14),
	ApplicantName VARCHAR (40),
	DOB VARCHAR (10),
	Street VARCHAR (30),
	City VARCHAR (40),
	State VARCHAR (2),
	Zip VARCHAR (10),
	WorkPhone VARCHAR (13),
	HomePhone VARCHAR (13),
	BestCallTime VARCHAR (10),
	BestCallNumber VARCHAR (6),
	email VARCHAR (20),
	SSN VARCHAR (11) UNIQUE,
	Situation TEXT)";

	if (mysql_db_query ($DBname, $Query, $Link))
	{
	  print ("Database table, $TableName, creation was successful!<br>\n");
	}
	else
	{
	  print ("Database table, $TableName, creation failed!<br>\n");
	}
// }
// else
// {
// 	print ("The database '$DBname' could not be created!<br>");
// }


mysql_close($Link);
?>

</body>

</html>
