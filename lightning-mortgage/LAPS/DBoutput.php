<html>
<head>
<title>DBoutput form handler</title>
</head>
<body>
<?php
/* this page retrieves and displays the data in the database 'lightnin_LoanApps' */


/* variables to access Database */

	$Host="localhost";
	$User="lightnin_Tony";
	$Password="ipowerwe";
	$DBname="lightnin_LoanApps";
	$TableName="TestDB";
    $DateOpenedYY="pp";
    $DateOpenedMM="pp";
	$DateOpenedDD="pp";

	print ("Attempting to connect to the DBMS<BR>\n");
	/* first, connect to the MySQL DBMS on this server */
	$Link=mysql_connect ($Host, $User, $Password) or die ('I cannot connect to the DBMS because: '.mysql_error());

	print ("Connect to the DBMS was successful!<BR>\n");
	/* select everything fromthe table */
    $Query = "SELECT * from $TableName";
    $Result=mysql_db_query($DBname, $Query, $Link);
/*
	if (mysql_db_query ($DBname, $Query, $Link))
	{
		print("The query was successfully executed!<br>\n");
	}
	else
	{
		print("The query was successfully executed!<br>\n");
	}
*/
	// create a table
	print ("<table border=1 cellspacing=2 cellpadding=2 align=center>\n");
	print ("<tr align=center valign=top>\n");
	print ("<td align=center width=\"7%\" valign=top><font face='Verdana' size='2' color='#000099'>Date Entered</font></td>\n");
	print ("<td align=center width=\"15%\" valign=top><font face='Verdana' size='2' color='#000099'>Applicant Name</font></td>\n");
	/*
	print ("<td align=center valign=top><font face='Verdana' size='2' color='#000099'>Date of Birth</font></td>\n");
	*/
	print ("<td align=center width=\"8%\" valign=top><font face='Verdana' size='2' color='#000099'>Street</font></td>\n");
	print ("<td align=center width=\"8%\" valign=top><font face='Verdana' size='2' color='#000099'>City</font></td>\n");
	print ("<td align=center width=\"3%\"valign=top><font face='Verdana' size='2' color='#000099'>State</font></td>\n");
	print ("<td align=center width=\"8%\" valign=top><font face='Verdana' size='2' color='#000099'>Zip</font></td>\n");
	print ("<td align=center width=\"9%\" valign=top><font face='Verdana' size='2' color='#000099'>Work Phone</font></td>\n");
	print ("<td align=center width=\"9%\" valign=top><font face='Verdana' size='2' color='#000099'>Home Phone</font></td>\n");
	/*
	print ("<td align=center width=\"8%\" valign=top><font face='Verdana' size='2' color='#000099'>Best Time To Call</font></td>\n");
	print ("<td align=center valign=top><font face='Verdana' size='2' color='#000099'>Best Phone to Call</font></td>\n");
	*/
	print ("<td align=center width=\"8%\" valign=top><font face='Verdana' size='2' color='#000099'>E-mail Address</font></td>\n");
	print ("<td align=center width=\"8%\" valign=top><font face='Verdana' size='2' color='#000099'>Social Security Number</font></td>\n");
	/*
	print ("<td align=center width=\"8%\" valign=top><font face='Verdana' size='2' color='#000099'>Situation</font></td>\n");
	*/
	print ("</tr>\n"); // end of row

	// fetch the results from the database

	while ($Row=mysql_fetch_array($Result))
	{          /* date stored in "date("YmdHis")" format and stored in a 'carchar (14)' formated field */

		print ("<tr align=center valign=top>\n");
		print ("<td align=center valign=top><font face='Verdana' size='2' color='#000099'>$Row[DateEntered]</font></td>\n");
		print ("<td align=center valign=top><font face='Verdana' size='2' color='#000099'>$Row[ApplicantName]</font></td>\n");
		/*
		print ("<td align=center valign=top><font face='Verdana' size='2' color='#000099'>$Row[DOB]</font></td>\n");
		*/
		print ("<td align=center valign=top><font face='Verdana' size='2' color='#000099'>$Row[Street]</font></td>\n");
		print ("<td align=center valign=top><font face='Verdana' size='2' color='#000099'>$Row[City]</font></td>\n");
		print ("<td align=center valign=top><font face='Verdana' size='2' color='#000099'>$Row[State]</font></td>\n");
		print ("<td align=center valign=top><font face='Verdana' size='2' color='#000099'>$Row[Zip]</font></td>\n");
		print ("<td align=center valign=top><font face='Verdana' size='2' color='#000099'>$Row[WorkPhone]</font></td>\n");
		print ("<td align=center valign=top><font face='Verdana' size='2' color='#000099'>$Row[HomePhone]</font></td>\n");
		/*
		print ("<td align=center valign=top><font face='Verdana' size='2' color='#000099'>$Row[BestCallTime]</font></td>\n");
		print ("<td align=center valign=top><font face='Verdana' size='2' color='#000099'>$Row[BestCallNumber]</font></td>\n");
		*/
		print ("<td align=center valign=top><font face='Verdana' size='2' color='#000099'>$Row[email]</font></td>\n");
		print ("<td align=center valign=top><font face='Verdana' size='2' color='#000099'>$Row[SSN]</font></td>\n");
		print ("</tr>\n"); // end of row
		/*
		print ("<td align=left valign=top colspan='12'><font face='Verdana' size='2' color='#000099'>$Row[Situation]</font></td>\n");
		print ("</tr>\n"); // end of row
		*/
	}

	mysql_close($Link);
?>
</body>
</html>