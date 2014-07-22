<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta name="GENERATOR" content="Microsoft FrontPage 4.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<title>CreateDBTable</title>
<meta name="Microsoft Border" content="tb, default">
</head>

<body>



<?php
	$Host="localhost";
	$User="lightnin_Tony";
	$Password="ipowerwe";
	$DBname="lightnin_LoanApps";
	$TableName="AppMaster2222";

	print ("Attempting to connect to the DBMS<BR>\n");
	/* first connect to the MySQL DBMS on this server */
	$Link=mysql_connect ($Host, $User, $Password) or die ('I cannot connect to the DBMS because: '.mysql_error());

	print ("Connect to the DBMS was successful!<BR>\nA database called '$DBname' has already been created manually<br>\n");

/* somehow we must open the database $DBname within the DBMS, right???? */
    mysql_select_db ($DBname);

    print("Getting ready to create a table called '$TableName'<br>\n");

	/* now create a table in $DBname */
	$Query="CREATE table $TableName (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	DateEntered TIMESTAMP,
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
	Employer VARCHAR (25),
	MonthlyIncome INT UNSIGNED NOT NULL,
	B2002Income INT UNSIGNED NOT NULL,
	EmployerTime INT UNSIGNED NOT NULL,
	Position VARCHAR (25),
	Co_ApplicantName VARCHAR (40),
	Co_DOB VARCHAR (10),
	Co_SSN VARCHAR (11) UNIQUE,
	Co_Employer VARCHAR (25),
	Co_MonthlyIncome INT UNSIGNED NOT NULL,
	Co_2002Income INT UNSIGNED NOT NULL,
	Co_EmployerTime INT UNSIGNED NOT NULL,
	Co_Position VARCHAR (25),
	EstCreditRating  VARCHAR (13),
	MonthlyCreditCardDebt INT UNSIGNED NOT NULL,
	MonthlyOtherDebt INT UNSIGNED NOT NULL,
	FinanceRequest VARCHAR (15),
	LoanAmount INT UNSIGNED NOT NULL,
	PropertyType VARCHAR (10),
	PurchasePrice INT UNSIGNED NOT NULL,
	EstimatedValue INT UNSIGNED NOT NULL,
	Current1stLender VARCHAR (20),
	InterestRateOn1st FLOAT NOT NULL,
	LoanBalanceOn1st INT UNSIGNED NOT NULL,
	MonthlyPaymentOn1st INT UNSIGNED NOT NULL,
	Current2ndLender VARCHAR (20),
	InterestRateOn2nd FLOAT NOT NULL,
	LoanBalanceOn2nd INT UNSIGNED NOT NULL,
	MonthlyPaymentOn2nd INT UNSIGNED NOT NULL,
	HowReferred VARCHAR (20),
	Situation TEXT,
	recipient VARCHAR (20),
	cc VARCHAR (20),
	IPaddress VARCHAR (15))";

	if (mysql_db_query ($DBName, $Query, $Link))
	{
	  print ("Database table, $TableName, creation was successful!<br>\n");
	}
	else
	{
	  print ("Database table, $TableName, creation failed!<br>\n");
	}


	mysql_close($Link);
?>

<p>Done table creation</p>
</body>

</html>
</script>