<?php
require ("../include/authenticate.php");
?>
<HTML>
<HEAD>
<TITLE>Lightning Mortgage Comments page</TITLE>
</HEAD>

<BODY BGCOLOR="FFFFFF" TEXT="000000">
        <table width="500" border="0" cellspacing="0" cellpadding="0" align="center">
            <tr>
              <td bgcolor="#FFFFFF">
<?php      
	$Host="localhost";
	$DBname="lightnin_LoanApps";
	/* first, connect to the MySQL DBMS on this server */
	
	$Link=mysql_connect ($Host, $User, $Password) or die ('In Comments.php, I cannot connect to the DBMS because: '.mysql_error());
               
	$Query = "SELECT * FROM `ApplicantInfo` WHERE 1 AND `SSN` = $SSN";
	//print ("<br>line ".__LINE__." in Comments SSN=|$SSN||Query=|$Query|\n");

	$Result=mysql_db_query($DBname, $Query, $Link);
	$Row=mysql_fetch_array($Result);
	$ApplicantName = $Row[ApplicantName];
	
	$Query = "SELECT * FROM `WorkingStatusInfo` WHERE 1 AND `id` = $id AND `SSN` = $SSN";
	$Result=mysql_db_query($DBname, $Query, $Link);
	$Row=mysql_fetch_array($Result);
	//print ("<br>line ".__LINE__." in Comments SSN=|$SSN|ID=|$id|Query=|$Query|<br>Comments=|$Row[Comments]|\n");
 
 	print ("<textarea rows='30' name='Comments' cols='100'>Applicant Name: $ApplicantName\n\n$Row[Comments]</textarea>");
 ?>
            </td>
            </tr>
        </table>
</BODY>
</HTML>