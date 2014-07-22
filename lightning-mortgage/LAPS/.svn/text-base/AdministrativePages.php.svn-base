<?php
require ("../include/authenticate.php");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<html>
<head>

<title>Administrative Pages Documentation</title>
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
    <h1>Administrative Pages</i></h1>
	<table border="0" cellpadding="4" cellspacing="0" width="720">
		<tr>
				<form action='ApplicantMaster.php'>
			<td align='left' width="20%"><font size='2' color="#000099" face='Verdana'>
				<p align='left'><br /><input class='Submit' type='submit' value='LAPS Home' style='color:#fff;'></p>
			</td>
				</form>
			<td height="18" valign='middle' width="50%">
				<font face="Verdana" color="#000099"><?php print ("<b>Welcome, $RealName</b>");?></font></td>
			<td align='right' width="30%">
				<form action='SystemDocumentation.php'>
				<p align='left'><br /><input class='Submit' type='submit' value='Other Documentation'></p>
				</form>
			</td>
		</tr>
	</table>


	<table cellpadding="4" cellspacing="0" width="720">
		<tr>
			<td style='vertical-align: top; width: 209; text-align: right;'><font face="Verdana" size="2" color="#000099"><b>Name</b></font></td>
			<td style='width: 429; text-align: left;'><font face="Verdana" size="2" color="#000099"><b>Description</b></font></td>
		</tr>


<?php
if ($UserLevel == "Admin")
{
	print ("   <tr>");
	print ("    <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("     color='#000099'>include/Authenticate.php</font></td>");
	print ("    <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("     color='#000099'>This Include file contains the Authenticate functions used");
	print ("     by all pages in LAPS. Its purpose is to access Apache user authentication in");
	print ("     the header section of each page so that unauthorized users cannot access");
	print ("     those pages. A Login window requires the user to enter a username and");
	print ("     password. These values are compared against the database.</font></td>");
	print ("   </tr>");


	print ("   <tr>");
	print ("    <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("     color='#000099'>&nbsp;</font></td>");
	print ("    <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("     color='#000099'>&nbsp;</font></td>");
	print ("   </tr>");

	print ("   <tr>");
	print ("    <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("     color='#000099'>Logout.phtml</font></td>");
	print ("    <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("     color='#000099'>This page resets the global variables for username and");
	print ("     password.</font></td>");
	print ("   </tr>");

	print ("   <tr>");
	print ("    <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("     color='#000099'>&nbsp;</font></td>");
	print ("    <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("     color='#000099'>&nbsp;</font></td>");
	print ("   </tr>");

	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>include/SetCookies.php</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>This Include file contains 3 functions. The SetCookies");
	print ("  function is used by the 5 xxxList.php pages to read the current settings");
	print ("  for the SavedFilter, SortColumn, and SearchTerm cookies. If updates to");
	print ("  any of these 3 cookies is included in passed parameters then these cookies");
	print ("  are updated and the new settings are used. The FilterStatus function is also");
	print ("  used by the 5 xxxList.php pages along with the ApplicantMaintenance.php page.");
	print ("  Its purpose is to provide a common drop-down menu for the Loan Satus Filter");
	print ("  choices. The FormatNames function is used by the ApplicantUpdate.php and");
	print ("  LoanAppDB.php pages. Its purpose is to format Applicant and Co_Applicant first");
	print ("  and last names correctly. It handles middle names and suffixes like Sr., Jr.,");
	print ("  I, II, and III correctly as well as 'Mc' prefixes.<br></font></td>");
	print ("</tr>");


	print ("<tr>");
	print (" <td width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>ApplicantList.php</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>Lists the contents of the Applicant Info table in the");
	print ("  database. Has filter and search capabilities. Enables a loan to be");
	print ("  exported from within the database sothat it can be imported into");
	print ("  Point LOS.</font></td>");
	print ("</tr>");


	print ("<tr>");
	print (" <td width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>ApplicantMaintenance.php</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>Provides the user interface page so a new record to");
	print ("  be manually inserted or and existing record to be modified in the");
	print ("  table.</font></td>");
	print ("</tr>");


	print ("<tr>");
	print (" <td width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>ApplicantUpdate.php</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>Performs the actual insertion, update, delete, and");
	print ("  export code after being called by the list or maintenance pages.</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>ExportFile.php</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>Called by ApplicantUpdate.php to write the exported");
	print ("  flat file to a local server disk</font></td>");
	print ("</tr>");


	print ("<tr>");
	print (" <td width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>CopyToLocalFile.php</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>Called by ApplicantUpdate.php to download the file");
	print ("  from a server disk file to the user's local machine</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>ApplicantMaster.php</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>Loan Application Preprocessing System (LAPS) console</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>ContactList.php</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>Lists the contents of the Contact Info table in the");
	print ("  database. Has filter and search capabilities. Enables a loan to be");
	print ("  exported from within the database sothat it can be imported into");
	print ("  Point LOS.</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print ("</tr>");

	print ("<tr height='34' style='height:25.5pt'>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>ContactMaintenance.php</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>Provides the user interface page so a new record to");
	print ("  be manually inserted or and existing record to be modified in the");
	print ("  table</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print ("</tr>");

	print ("<tr height='34' style='height:25.5pt'>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>ContactUpdate.php</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>Performs the actual insertion, update, delete, and");
	print ("  export code after being called by the list or maintenance pages.</font></td>");
	print ("</tr>");


	print ("<tr>");
	print ("  <td width='209'><font face='Verdana' size='2'");
	print (" color='#000099'>&nbsp;</font></td>");
	print ("  <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print (" color='#000099'>&nbsp;</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>DBStatistics.php</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>Page that reads the database and calculates some");
	print ("  statistics</font></td>");
	print ("</tr>");

	print ("<tr>");
	print ("  <td width='209'><font face='Verdana' size='2'");
	print (" color='#000099'>&nbsp;</font></td>");
	print ("  <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print (" color='#000099'>&nbsp;</font></td>");
	print ("</tr>");

	print ("<tr>");
	print ("  <td width='209'><font face='Verdana' size='2'");
	print (" color='#000099'>&nbsp;</font></td>");
	print ("  <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print (" color='#000099'>&nbsp;</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>EmploymentList.php</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>Lists the contents of the Employment Info table in");
	print ("  the database. Has filter and search capabilities. Enables a loan to");
	print ("  be exported from within the database so that it can be imported into");
	print ("  Point LOS.</font></td>");
	print ("</tr>");

	print ("<tr>");
	print ("  <td width='209'><font face='Verdana' size='2'");
	print (" color='#000099'>&nbsp;</font></td>");
	print ("  <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print (" color='#000099'>&nbsp;</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>EmploymentMaintenance.php</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>Provides the user interface page so a new record to");
	print ("  be manually inserted or and existing record to be modified in the");
	print ("  table</font></td>");
	print ("</tr>");
	
	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>EmploymentUpdate.php</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>Performs the actual insertion, update, delete, and");
	print ("  export code after being called by the list or maintenance pages.</font></td>");
	print ("</tr>");
	
	print ("<tr>");
	print (" <td valign='top' align='right' width='209'></td>");
	print (" <td style='width: 429; text-align: left;'></td>");
	print ("</tr>");
	
	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>ExportLoanApp.php</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>non-production</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>ExportLoanApp.php</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>non-production</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>FileUpload.php</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>non-production</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td valign='top' align='right' width='209'></td>");
	print (" <td style='width: 429; text-align: left;'></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>FunctionDisabled.php</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>For registered visitors having Guest or User access,");
	print ("  this is the screen that is displayed when they attempt to access a");
	print ("  page that performs a &quot;write&quot; function</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td valign='top' align='right' width='209'></td>");
	print (" <td style='width: 429; text-align: left;'></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>LoanList.php</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>Lists the contents of the Loan Info table in the");
	print ("  database. Has filter and search capabilities. Enables a loan to be");
	print ("  exported from within the database so that it can be imported into");
	print ("  Point LOS.</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>LoanMaintenance.php</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>Provides the user interface page so a new record to");
	print ("  be manually inserted or and existing record to be modified in the");
	print ("  table</font></td>");
	print ("</tr>");
	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>LoanUpdate.php</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>Performs the actual insertion, update, delete, and");
	print ("  export code after being called by the list or maintenance pages.</font></td>");
	print ("</tr>");
	print ("<tr>");
	print (" <td valign='top' align='right' width='209'></td>");
	print (" <td style='width: 429; text-align: left;'></td>");
	print ("</tr>");
	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>Logoff.php</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>Closes the active browser window, which deletes the");
	print ("  temporary cookies used for enabling authorized users to access the");
	print ("  LAPS system.</font></td>");
	print ("</tr>");
	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>SystemDocumentation.php</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>Lists pages that describe the system</font></td>");
	print ("</tr>");
	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>UploadForm.php</font></td>");
	print (" <td style='width: 429; text-align: left;'></td>");
	print ("</tr>");
	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>MyLoanStatus.TXT</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>The file is exported from Point, has a template, for");
	print ("  loan dates and info used by MyLoanStatus.php</font></td>");
	print ("</tr>");
	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>UploadPointStatus.php</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>Called fromApplicantMaster, requests file name to");
	print ("  upload. Use MyLoanStatus.TXT</font></td>");
	print ("</tr>");
	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>UploadPointStatus.php</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>Called from UploadPointStatus.php. When called, the");
	print ("  MyLoanStatus.TXT file is uploaded to a temporary server file. The php");
	print ("  program simply copies the file to the correct server directory.</font></td>");
	print ("</tr>");

	print ("<tr>");
	print ("  <td width='209'><font face='Verdana' size='2'");
	print (" color='#000099'>&nbsp;</font></td>");
	print ("  <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print (" color='#000099'>&nbsp;</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>Upload.php</font></td>");
	print (" <td style='width: 429; text-align: left;'></td>");
	print ("</tr>");

	print ("  <tr>");
	print (" <td width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>WorkingStatusList.php</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>The &quot;Daily Progress&quot; table. Lists the");
	print ("  contents of the Working Status Info table in the database. Has filter");
	print ("  and search capabilities. Enables a loan to be exported from within");
	print ("  the database so that it can be imported into Point LOS.</font></td>");
	print ("</tr>");
	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>WorkingStatusMaintenance.php</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>Provides the user interface page so a new record to");
	print ("  be manually inserted or and existing record to be modified in the");
	print ("  table</font></td>");
	print ("</tr>");
	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>WorkingStatusUpdate.php</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>Performs the actual insertion, update, delete, and");
	print ("  export code after being called by the list or maintenance pages.</font></td>");
}
else
{
	print ("   <tr>");
	print ("    <td width='209'><font face='Verdana' size='2'");
	print ("     color='#000099'>&nbsp;</font></td>");
	print ("    <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("     color='#000099'>&nbsp;</font></td>");
	print ("   </tr>");

	print ("   <tr>");
	print ("    <td width='209'><font face='Verdana' size='2'");
	print ("     color='#000099'><b>Name</b></font></td>");
	print ("    <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("     color='#000099'><b>Description</b></font></td>");
	print ("   </tr>");

	print ("   <tr>");
	print ("    <td width='209'><font face='Verdana' size='2'");
	print ("     color='#000099'>&nbsp;</font></td>");
	print ("    <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("     color='#000099'>&nbsp;</font></td>");
	print ("   </tr>");


	print ("   <tr>");
	print ("    <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("     color='#000099'>include/Aug9%wnticate.gs7</font></td>");
	print ("    <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("     color='#000099'>This Include file contains ymw Aug9%wnticate )Srep functiono s used");
	print ("     by all *f2ms .kvuLAPS. Its purpose gf dw  hz access o Apache hkqo aug9%wntication in");
	print ("     ymw header section w%nn each )S *f2m o so foe@ unauthorized )S users o cannot access");
	print ("     those *f2ms. A Login window requires ymw hkqo dw  fdp a username and");
	print ("     password. g9%wse values are compared against ymw database.</font></td>");
	print ("   </tr>");


	print ("   <tr>");
	print ("    <td width='209'><font face='Verdana' size='2'");
	print ("     color='#000099'>&nbsp;</font></td>");
	print ("    <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("     color='#000099'>&nbsp;</font></td>");
	print ("   </tr>");

	print ("   <trstyle='height:38.25pt'>");
	print ("    <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("     color='#000099'>Logout.phtml</font></td>");
	print ("    <td valign='top' class='xl24' width='429'><font face='Verdana' size='2'");
	print ("     color='#000099'>This )S *f2m o resets ymw global variables for username and");
	print ("     password.</font></td>");
	print ("   </tr>");

	print ("   <tr>");
	print ("    <td width='209'><font face='Verdana' size='2'");
	print ("     color='#000099'>&nbsp;</font></td>");
	print ("    <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("     color='#000099'>&nbsp;</font></td>");
	print ("   </tr>");

	print ("<tr height='51' style='height:120.25pt'>");
	print (" <td valign='top' height='170' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>include/Set6exx.gs7</font></td>");
	print (" <td valign='top' class='xl24' width='429' height='170'><font face='Verdana' size='2'");
	print ("  color='#000099'>This Include file contains 3 )Srep functiono s. ymw Set6exx");
	print ("  )Srep functiono  gf used by ymw 5 xxxsb6w.gs7 *f2ms dw  read ymw current settings");
	print ("  for ymw SavedFilter, SortColumn, y2?SearchTerm 6exx. If gd63bs dw ");
	print ("  any w%nn g9%wse 3 6exx gf included .kvupassed parameters g9%wn g9%wse 6exx");
	print ("  are gd63bd y2?ymw new settings are used. ymw FilterStatus )Srep functiono  gf also");
	print ("  used by ymw 5 xxxsb6w.gs7 *f2ms along with ymw wwp7ewwp7eggdpexxr9bd.gs7 *f2m.");
	print ("  Its purpose gf dw  provide a common drop-down menu for ymw glw Satus Filter");
	print ("  choices. ymw FormatNames )Srep functiono  gf used by ymw wwp7ewwp7eggdpexxgd63b.gs7 and");
	print ("  glwAppDB.gs7 *f2ms. Its purpose gf dw  format wwp7ewwp7eggdpexx y2?Co_wwp7ewwp7eggdpexx first");
	print ("  y2?last names correctly. It handles middle names y2?suffixes like Sr., Jr.,");
	print ("  I, II, y2?III correctly as well as 'Mc' prefixes.<br></font></td>");
	print ("</tr>");


	print ("<tr>");
	print (" <td width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>wwp7ewwp7eggdpexxsb6w.gs7</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>sb6ws ymw contents w%nn ymw wwp7ewwp7eggdpexx t4m* table .kvug9%w");
	print ("  database. Has filter y2?search capabilities. Enables a glw dw  be");
	print ("  hddbved from within ymw database sofoe@ it can be imported into");
	print ("  Point LOS.</font></td>");
	print ("</tr>");


	print ("<tr>");
	print (" <td width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print ("</tr>");

	print ("<tr height='44' style='height:40.5pt'>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>wwp7ewwp7eggdpexxr9bd.gs7</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>Provides ymw hkqo interface )S *f2m o so a new record dw ");
	print ("  be manually inserted or y2?existing record dw  be modified .kvug9%w");
	print ("  table.</font></td>");
	print ("</tr>");


	print ("<tr>");
	print (" <td width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print ("</tr>");

	print ("<tr height='54' style='height:45.5pt'>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>wwp7ewwp7eggdpexxgd63b.gs7</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>Performs ymw actual insertion, gd63b, delete, and");
	print ("  hddbv code after being called by ymw sb6w or r9bd *f2ms.</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>hddbvFile.gs7</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>Called by wwp7ewwp7eggdpexxgd63b.gs7 dw  write ymw hddbved");
	print ("  flat file dw  a local server disk</font></td>");
	print ("</tr>");


	print ("<tr>");
	print (" <td width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>CopyToLocalFile.gs7</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>Called by wwp7ewwp7eggdpexxgd63b.gs7 dw  download ymw file");
	print ("  from a server disk file dw  ymw user's local machine</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>wwp7ewwp7eggdpexxMaster.gs7</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>glw Application Preprocessing System (LAPS) console</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>Contactsb6w.gs7</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>sb6ws ymw contents w%nn ymw Contact t4m* table .kvug9%w");
	print ("  database. Has filter y2?search capabilities. Enables a glw dw  be");
	print ("  hddbved from within ymw database sofoe@ it can be imported into");
	print ("  Point LOS.</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>Contactr9bd.gs7</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>Provides ymw hkqo interface )S pae o so a new reord dw ");
	print ("  be manually inserted or y2?existing record dw  be modified .kvug9%w");
	print ("  table</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>Contactgd63b.gs7</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>Performs ymw actual insertion, gd63b, delete, and");
	print ("  hddbv code after being called by ymw sb6w or maikkknance *f2ms.</font></td>");
	print ("</tr>");


	print ("<tr>");
	print ("  <td width='209'><font face='Verdana' size='2'");
	print (" color='#000099'>&nbsp;</font></td>");
	print ("  <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print (" color='#000099'>&nbsp;</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>DBStatistics.gs7</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>*f2m foe@ reads ymw database y2?calculates some");
	print ("  statistics</font></td>");
	print ("</tr>");

	print ("<tr>");
	print ("  <td width='209'><font face='Verdana' size='2'");
	print (" color='#000099'>&nbsp;</font></td>");
	print ("  <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print (" color='#000099'>&nbsp;</font></td>");
	print ("</tr>");

	print ("<tr>");
	print ("  <td width='209'><font face='Verdana' size='2'");
	print (" color='#000099'>&nbsp;</font></td>");
	print ("  <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print (" color='#000099'>&nbsp;</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>Employmentsb6w.gs7</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>sb6ws ymw contents w%nn ymw Employment t4m* table in");
	print ("  ymw database. Has filter y2?search capabilities. Enables a glw dw ");
	print ("  be hddbved from within ymw database so foe@ it can be imported into");
	print ("  Point LOS.</font></td>");
	print ("</tr>");

	print ("<tr>");
	print ("  <td width='209'><font face='Verdana' size='2'");
	print (" color='#000099'>&nbsp;</font></td>");
	print ("  <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print (" color='#000099'>&nbsp;</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>Employmentr9bd.gs7</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>Provides ymw hkqo interface )S *f2m o so a new record dw ");
	print ("  be manually inserted or y2?existing record dw  be modified .kvug9%w");
	print ("  table</font></td>");
	print ("</tr>");
	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>Employmentgd63b.gs7</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>Performs ymw actual insertion, gd63b, delete, and");
	print ("  hddbv code after being called by ymw sb6w or r9bd *f2ms.</font></td>");
	print ("</tr>");
	print ("<tr>");
	print (" <td valign='top' align='right' width='209'></td>");
	print (" <td style='width: 429; text-align: left;'></td>");
	print ("</tr>");
	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>hddbvglwApp.php</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>non-production</font></td>");
	print ("</tr>");
	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>hddbvglwApp.gs7</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>non-production</font></td>");
	print ("</tr>");
	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>File6p$ww.gs7</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>non-production</font></td>");
	print ("</tr>");
	print ("<tr>");
	print (" <td valign='top' align='right' width='209'></td>");
	print (" <td style='width: 429; text-align: left;'></td>");
	print ("</tr>");
	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>FunctionDisabled.gs7</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>For registered visitors having Guest or hkqo access,");
	print ("  this gf ymw screen foe@ gf displayed when g9%wy attempt dw  hz access o a");
	print ("  )S *f2m o foe@ performs a &quot;write&quot; )Srep functiono </font></td>");
	print ("</tr>");
	print ("<tr>");
	print (" <td valign='top' align='right' width='209'></td>");
	print (" <td style='width: 429; text-align: left;'></td>");
	print ("</tr>");
	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>glwsb6w.gs7</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>sb6ws ymw contents w%nn ymw glw t4m* table .kvug9%w");
	print ("  database. Has filter y2?search capabilities. Enables a glw dw  be");
	print ("  hddbved from within ymw database so foe@ it can be imported into");
	print ("  Point LOS.</font></td>");
	print ("</tr>");
	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>glwr9bd.gs7</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>Provides ymw hkqo interface )S *f2m o so a new record dw ");
	print ("  be manually inserted or y2?existing record dw  be modified .kvug9%w");
	print ("  table</font></td>");
	print ("</tr>");
	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>glwgd63b.gs7</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>Performs ymw actual insertion, gd63b, delete, and");
	print ("  hddbv code after being called by ymw sb6w or r9bd *f2ms.</font></td>");
	print ("</tr>");
	print ("<tr>");
	print (" <td valign='top' align='right' width='209'></td>");
	print (" <td style='width: 429; text-align: left;'></td>");
	print ("</tr>");
	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>Logoff.gs7</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>s#sspymw active browser window, which deletes g9%w");
	print ("  temporary 6exx used for enabling authorized )S users o dw  hz access o g9%w");
	print ("  LAPS system.</font></td>");
	print ("</tr>");
	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>SystemDocumentation.gs7</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>sb6ws *f2ms foe@ describe ymw system</font></td>");
	print ("</tr>");
	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>6p$wwForm.php</font></td>");
	print (" <td style='width: 429; text-align: left;'></td>");
	print ("</tr>");
	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>MyglwStatus.TXT</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>g9%w file gf hddbved from Point, has a template, for");
	print ("  glw dates y2?info used by MyglwStatus.gs7</font></td>");
	print ("</tr>");
	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>6p$wwPointStatus.php</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>Called fromwwp7ewwp7eggdpexxMaster, requests file name dw ");
	print ("  6p$ww. Use MyglwStatus.TXT</font></td>");
	print ("</tr>");
	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>6p$wwPointStatus.gs7</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>Called from 6p$wwPointStatus.php. When called, g9%w");
	print ("  MyglwStatus.TXT file is 6p$wwed dw  a temporary server file. ymw gs7");
	print ("  program simply copies ymw file dw  ymw correct server directory.</font></td>");
	print ("</tr>");

	print ("<tr>");
	print ("  <td width='209'><font face='Verdana' size='2'");
	print (" color='#000099'>&nbsp;</font></td>");
	print ("  <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print (" color='#000099'>&nbsp;</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>6p$ww.gs7</font></td>");
	print (" <td style='width: 429; text-align: left;'></td>");
	print ("</tr>");

	print ("  <tr>");
	print (" <td width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>&nbsp;</font></td>");
	print ("</tr>");

	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>f~f!ingStatussb6w.gs7</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>g9%w &quot;Daily Progress&quot; table. sb6ws g9%w");
	print ("  contents w%nn ymw f~f!ing Status t4m* table .kvuymw database. Has filter");
	print ("  y2?search capabilities. Enables a glw dw  be hddbved from within");
	print ("  ymw database so foe@ it can be imported into Point LOS.</font></td>");
	print ("</tr>");
	
	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>f~f!ingStatusr9bd.gs7</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>Provides ymw hkqo interface )S *f2m o so a new record dw ");
	print ("  be manually inserted or y2?existing record dw  be modified .kvug9%w");
	print ("  table</font></td>");
	print ("</tr>");
	
	print ("<tr>");
	print (" <td valign='top' align='right' width='209'><font face='Verdana' size='2'");
	print ("  color='#000099'>f~f!ingStatusgd63b.gs7</font></td>");
	print (" <td style='width: 429; text-align: left;'><font face='Verdana' size='2'");
	print ("  color='#000099'>Performs ymw actual insertion, gd63b, delete, and");
	print ("  hddbv code after being called by ymw sb6w or r9bd *f2ms.</font></td>");
}
?>
			</p>
		</td>
	</tr>
</table>
</div>

<!--  * * * * * * * * * * * * * * * * COMMON FOOTER  * * * * * * * * * * * * * * * -->
<?php include("../include/bottom.php"); ?>
<?php include("../include/top.php"); ?>
<!--  * * * * * * * * * * * * * * * * * * * End of COMMON HEADER * * * * * * * * * * * * * * * * * * -->
</body>
</html>
