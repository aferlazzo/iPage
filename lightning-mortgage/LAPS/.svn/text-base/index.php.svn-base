<?php
require ("../include/authenticate.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<html>
<head>
<!--
// / / / / / / / / / / / / / / / / / / / / / / / / / / / /	/
//															/
//  /LAPS/index.php is a copy of /LAPS/ApplicantMaster.php 	/
//															/
// / / / / / / / / / / / / / / / / / / / / / / / / / / / /	/
-->

<title>LAPS: Loan Applicant Processing System Console</title>
<script language="JavaScript" src="../js/Common.js" type="text/javascript">
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
<style type="text/css">
	div.Menu 
	{
		border-width: 0px; 
		border-style: solid;
		border-color: red; 

		padding:1em 0 1em 0; 
		width: 720px;
	}
	div.LeftSide
	{
		border-width: 0px; 
		border-style: solid;
		border-color: #000099; 
	
		position: relative;
		float: left;
		width: 30%;
		/*padding-right: 4px;*/
	}
	div.RightSide
	{
		border-width: 0px; 
		border-style: solid;
		border-color: #000099; 
		position: relative;
		float: right;
		left: -2em; /* closes the gap between the LeftSide and RightSide divisions */
	}	
</style>
</head>

<body topmargin="0" leftmargin="0">
<script>
  if (window.location.href.substring(0,5)!="https"){ window.location.replace('https://host373.ipowerweb.com/~lightnin/LAPS/ApplicantMaster.php') }
</script>

<div class="Main" id="MainDIV">
<div class="Content" id="ContentDIV">


<?php

// unset ($PHP_AUTH_USER); // unset these variables so user is prompted at the start of this program for a user ID
// unset ($PHP_AUTH_PW);

/*
if ($auth == true)
	print ("Authorized<br>\n");
else
	print ("Unauthorized<br>\n");
*/
/* create cookies for the username and password */
//print("<script language='Javascript'>document.cookie='User=lightnin_AppInp';document.cookie='Password=meso1';</script>");

//print("<script language='Javascript'>alert('returned ' + GetMyValue('User'));</script>");
//print("<script language='Javascript'>User= GetMyValue('User');</script>");
//print("<script language='Javascript'>alert('returned ' + GetMyValue('Password'));</script>");
//print("<script language='Javascript'>Password = GetMyValue('Password');</script>");

//print("User variable set to $User<br>\n");
//print("Password variable set to $Password<br>\n");


//testing  function.....
function GetIPaddress()
{
	//----------------------------------//
	//									//
	//	Get the visitor's IP Address	//
	//									//
	//----------------------------------//

	if ($_SERVER)
	{
		if ( $_SERVER[HTTP_X_FORWARDED_FOR] )
	    {
	      $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	    }
	    elseif ( $_SERVER["HTTP_CLIENT_IP"] )
	    {
	      $realip = $_SERVER["HTTP_CLIENT_IP"];
	    }
	    else
	    {
	      $realip = $_SERVER["REMOTE_ADDR"];
	    }
	}
	else
	{
	    if ( getenv( 'HTTP_X_FORWARDED_FOR' ) )
	    {
	      $realip = getenv( 'HTTP_X_FORWARDED_FOR' );
	    }
	    elseif ( getenv( 'HTTP_CLIENT_IP' ) )
	    {
	      $realip = getenv( 'HTTP_CLIENT_IP' );
	    }
	    else
	    {
	      $realip = getenv( 'REMOTE_ADDR' );
	    }

	  	if ($realip == "12.232.7.116")
		{
			print ("Unauthorized Access!<br>\n");
			exit;
		}
		else
		{
			print("$realip<br>\n");
			print ("Your IP Address passed<br>\n");
		}
	}
}

?>

<h1>LAPS - Loan Applicant Processing System</h1>

<?php print ("<p style='width: 720px; text-align: center; font-weight: bold; border-width: 0px; border-style: dashed; border-color: green;'>Welcome, $RealName</p>");?>

	<div class="Menu">
	
	<div class="LeftSide">
		<p style='text-align: right;'>
		<a href="https://host373.ipowerweb.com/~lightnin/LAPS/WorkingStatusList.php">
			Daily Progress Report</a></p>

		<p style='text-align: right;'>
		<a href="https://host373.ipowerweb.com/~lightnin/LAPS/ApplicantList.php">
			Applicant Info</a></p>

		<p style='text-align: right;'>
		<a href="https://host373.ipowerweb.com/~lightnin/LAPS/LoanList.php">
			Loan Info</a></p>

		<p style='text-align: right;'>
		<a href="https://host373.ipowerweb.com/~lightnin/LAPS/ContactList.php">
			Contact Info</a></p>

		<p style='text-align: right;'>
		<a href="https://host373.ipowerweb.com/~lightnin/LAPS/EmploymentList.php">
           		 Employment Info</a></p>
           		 
<?php
		if ($UserLevel == "Admin")
			print("<p style='text-align: right;'><a href='https://host373.ipowerweb.com/~lightnin/LAPS/UploadPointStatus.php'>Upload Point Status</a></td>");
		else
			print("<p style='text-align: right;'><a href='FunctionDisabled.php'>Upload Point Status</a></td>");
?>

		<p style='text-align: right;'>
		<a href='https://host373.ipowerweb.com/~lightnin/LAPS/DBStatistics.php'>Statistics</a>

		<p style='text-align: right;'>
		<a href='https://host373.ipowerweb.com/~lightnin/LAPS/SystemDocumentation.php'>System Documentation</a>

		<p style="text-align: right;">
		<a href="https://host373.ipowerweb.com/~lightnin/LAPS/Logout.phtml">Logoff</a></p>
	</div> <!-- end of LeftSide division -->
	
	<div class="RightSide">
		<p onMouseOver='this.style.color="#ffffff"; this.style.backgroundColor="#000099";'
			onMouseOut='this.style.color="#000099"; this.style.backgroundColor="transparent";'
			onClick='this.style.display="none";'>View/Edit/Enter activity and status updates</p></td>

		<p onMouseOver='this.style.color="#ffffff"; this.style.backgroundColor="#000099";'
			onMouseOut='this.style.color="#000099"; this.style.backgroundColor="transparent";'
			onClick='this.style.display="none";'>Export loans to Point, view/edit applicant personal data</p></td>

		<p onMouseOver='this.style.color="#ffffff"; this.style.backgroundColor="#000099";'
			onMouseOut='this.style.color="#000099"; this.style.backgroundColor="transparent";'
			onClick='this.style.display="none";'>View/Edit existing loan details</p></td>

		<p onMouseOver='this.style.color="#ffffff"; this.style.backgroundColor="#000099";'
			onMouseOut='this.style.color="#000099"; this.style.backgroundColor="transparent";'
			onClick='this.style.display="none";'>View/Edit addresses and phone numbers</p></td>

		<p onMouseOver='this.style.color="#ffffff"; this.style.backgroundColor="#000099";'
			onMouseOut='this.style.color="#000099"; this.style.backgroundColor="transparent";'
			onClick='this.style.display="none";'>View/Edit employment information</p></td>

		<p onMouseOver='this.style.color="#ffffff"; this.style.backgroundColor="#000099";'
			onMouseOut='this.style.color="#000099"; this.style.backgroundColor="transparent";'
			onClick='this.style.display="none";'>Upload the loan status from Point LOS for 'My Loan Status' queries</p></td>

		<p onMouseOver='this.style.color="#ffffff"; this.style.backgroundColor="#000099";'
			onMouseOut='this.style.color="#000099"; this.style.backgroundColor="transparent";'
			onClick='this.style.display="none";'>Loan Applicant statistics</p></td>

		<p onMouseOver='this.style.color="#ffffff"; this.style.backgroundColor="#000099";'
			onMouseOut='this.style.color="#000099"; this.style.backgroundColor="transparent";'
			onClick='this.style.display="none";'>How the system works, what each webpage does</p></td>

		<p onMouseOver='this.style.color="#ffffff"; this.style.backgroundColor="#000099";'
			onMouseOut='this.style.color="#000099"; this.style.backgroundColor="transparent";'
			onClick='this.style.display="none";'>Logoff the Applicant System Console</p></td>
	</div> <!-- end of RightSide division -->
	</div> <!-- end of Menu division -->
	<!--<br style="clear: both;">-->
	<p style="width: 720px; border-width: 0px; border-style: dashed; border-color: green;">Unauthorized use of this system is strictly prohibited.</p>
	<p style="width: 720px; border-width: 0px; border-style: dashed; border-color: green;">The use of this passworded system is
	granted to personnel who have purchased a software license. We are strict believers in privacy at the corporate
	and private levels and will prosecute you to the fullest extent of the law if you use this system without authorization.</p>
	</div> <!-- end of main division -->

<!--  * * * * * * * * * * * * * * * * COMMON FOOTER  * * * * * * * * * * * * * * * -->
<?php 
include("../include/bottom.php");
include("../include/top.php"); 
?>

</body>
</html>
