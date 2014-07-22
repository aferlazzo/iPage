<?php
require ("../include/authenticate.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<html>
<head>

<title>Applicant System Documentation</title>
<script language="JavaScript" src="https://host373.ipowerweb.com/~lightnin/js/Common.js">
</script>
<link rel="stylesheet" href="../css/AdministrativeStyles.css" type="text/css">
<!--[if IE 6]>
<style type="text/css">
html
{
  scrollbar-base-color: #F4F4F4;
  scrollbar-arrow-color: #FFFFFF;
  scrollbar-track-color: #002179;
  scrollbar-face-color: #000099;
  scrollbar-3dlight-color: #000099;
}
</style>
<![endif]-->
</head>

<body>
<div class="Main" id="MainDIV">
<div class="Content" id="ContentDIV">

    <h1>LAPS System Documentation</h1>
	<table border="0" cellpadding="4" cellspacing="0" width='720'>
       <tr>
		<td align='left' width="20%">
		<form action='ApplicantMaster.php'>
		<p align='left'><input class='Submit' type='submit' value='LAPS Home' style='color:#fff;'></p>
		</form>
		 </td>
		<td width="50%"><font face="Verdana" color="#000099">
         <?php print ("<b>Welcome, $RealName</b>");?></font></td>
	  		<td align='right' width="30%">&nbsp;</td>
       </tr>

	   <tr>
        <td colspan="3">
        	<p>The Applicant System has two major components. One group of web pages deals 
        	with borrower interaction with the system. This is the home page visitors come to, where they fill out a secure 
        	loan application, where their credit report is run (actually handled by AAA Credit) and contains other pages 
        	where their questions are answered. A secure and password-protected personalized loan status page ('My Loan 
        	Status') for each active loan is also available.</p>
        	
        	<p>Another group of web pages make up the Applicant System Console. This is where 
        	the Applicant System is maintained by administrative personnel, where loans are exported to Point, and 
        	where Point loan status information is imported. These pages are secure. They are password protected and 
        	run on a secure server.
  			</p>
			</td>
		  </tr>
<?php print ("\n<tr>\n");?>

		   <td><br>&nbsp;<br>
		   </td>
		   <td><li><p>

<?php
	if ($UserLevel == "Admin")
		print ("<a href='ProcessFlow.php'>Description of Process Flow");
	else
		print ("<a href='ProcessFlow.php'>Description of Process Flow");
?>

		   </p></li></td>
		  </tr>
<?php print ("\n<tr>\n");?>

		    <td>&nbsp;<br></td>
		    <td><li><p>

<?php
	if ($UserLevel == "Admin")
		print ("<a href='BorrowerPages.php'>Documentation for Website Pages");
	else
		print ("<a href='BorrowerPages.php'>Documentation for Website Pages");
?>

			</p></li></td>
		  </tr>
<?php print ("\n<tr>\n");?>

		  <td><br>&nbsp;<br></td>
		  <td><li><p>

<?php
	if ($UserLevel == "Admin")
		print ("<a href='AdministrativePages.php'>Documentation for Administrative Pages");
	else
		print ("<a href='AdministrativePages.php'>Documentation for Administrative Pages");
?>

		    </p></li></td>
	      </tr>
	      <tr>
		  <td width='20%'>&nbsp;<br></td>
		   <td><li><p>
				<a href='TechnicalSpecs.php'>Technical Specifications</li>
		<br />&nbsp;</p></li></td>
  </tr>
 </table>
</div>

<!--  * * * * * * * * * * * * * * * * COMMON FOOTER  * * * * * * * * * * * * * * * -->
<?php include("../include/bottom.php"); ?>
<?php include("../include/top.php"); ?>
<!--  * * * * * * * * * * * * * * * * * * * End of COMMON HEADER * * * * * * * * * * * * * * * * * * -->
</body>
</html>
