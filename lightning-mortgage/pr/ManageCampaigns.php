<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright � Tony Ferlazzo 2004
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/

include("check1.php");
$user = $_COOKIE["UName"];
$PrintUser = ucwords(strtolower($_COOKIE["UName"]));
include("conn.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<HTML>
<HEAD>
<TITLE>Manage Campaigns</TITLE>
<meta name="robots" content="NoIndex, NoFollow">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="./css/PerfectResponse.css">
<link rel="stylesheet" type="text/css" href="./css/niftyCorners.css">
<script type="text/javascript" src="./js/PerfectResponse.js"></script>
<script type="text/javascript" src="./js/nifty.js"></script>
<style type="text/css">
label:hover { 
background:#fff; 
font-weight:bold;
cursor:pointer; 
}
</style>
</HEAD>
<body>
<div id="Wrapper"><div id="content">
<span class="BoxHeading">
<input type="button" id="submit" name="submit" value="Click for helpful hints!" class="Button" onclick="Show();" onmouseover="document.getElementById('submit').style.fontWeight='bold';" onmouseout="document.getElementById('submit').style.fontWeight='normal';">
</span>
<div id="navBeta">
	<h2>Tips</h2>
	<p>Click on a Campaign name to manage its configuration, messages, and subscribers.</p>
	<p>Campaigns with a <span style="background: #DC143C; color: #ffffff;">Red</span> background are suspended 
	and do not send messages.</p>
	<p>Choose the 'Clone' action in order to copy the entire mail campaign: all the messages and the
	subscribers. If you only want to copy the messages or the subscribers, then first create a new campaign.</p>
</div>
<?php

print("<h1>Manage Campaigns</h1>");
?>

	<TABLE summary="" width='95%' BORDER='0' CELLPADDING='4' CELLSPACING='4' align="center">
	
	
	<tr>
		<td style='text-align:center;width:100px;'><p><br /><b>Action</b></p></td>
		<td style='text-align:left;width:730px;'><p><br /><b>Campaign Description</b></p></td>
		<td style='width:70px;'><p><b>Active<br />Subscribers</b></p></td>
		<td  style='text-align:center;width:35px;'><p><br /><b>Msgs</b></p></td>
	</tr>
		<?php
			$AutoresponderResult 	= mysql_query("SELECT * FROM autoresponders where user='$user' order by ardescription", $link);
			$NumberOfAutoresponders = mysql_num_rows($AutoresponderResult);

			if($NumberOfAutoresponders > 0) //autoresponder=mail campaign
			{
				//obtain # of users & msgs  for each autoresponder/mail campaign

				for($count=0; $count < $NumberOfAutoresponders; $count++)
				{
					mysql_data_seek($AutoresponderResult, $count); //set db pointer to next autoresponder
					$AutoresponderRow = mysql_fetch_object($AutoresponderResult);
					$NextArid = $AutoresponderRow->arid;
					$UsersResult 	= mysql_query("SELECT * FROM users where arid=$NextArid and confirmed='Y' and currentmsg < 253", $link);
					$MessagesResult = mysql_query("SELECT * FROM messages where arid=$NextArid", $link);

					$NumberOfUsers 		= mysql_num_rows($UsersResult);
					$NumberOfMessages 	= mysql_num_rows($MessagesResult);
					//print("arid= $NextArid \$NumberOfUsers $NumberOfUsers \$NumberOfMessages $NumberOfMessages<br>");
					$NumberOfMessages = $NumberOfMessages - 3; //to account for the subscribe/signature messages


					print ("<tr>\n");
					print ("<td height='15'>\n");

					print ("<form name='manar$AutoresponderRow->arid' action='CampaignManager.php' method='get'>\n");
					print ("<input type='hidden' name='arid' value='$AutoresponderRow->arid'>\n");
					print ("<input type='hidden' name='FromArid' value='$AutoresponderRow->arid'>\n");
					// commands:
					print ("<p><select size='1' name='cmd' onChange='submit()'>\n");
					print ("<option value='0'>Select One</option>\n");
					print ("<option selected value='1'>Manage</option>\n");
					print ("<option value='2'>Clone</option>\n");
					print ("<option value='3'>Delete</option>\n");
					print ("</select></p>\n");
					print ("</form>");
					print ("</td>\n");
					print ("<td style='text-align:left;background: ");

					if ($AutoresponderRow->CampaignState == "Suspended")
						print ("#DC143C; color: #ffffff; font-weight: bold;'>\n");
					else
						print ("transparent;'>\n");

					print ("<p onclick='document.manar$AutoresponderRow->arid.cmd.value=1;document.manar$AutoresponderRow->arid.submit();'><label>");
					printf ("%03d", $AutoresponderRow->arid);
					print (": $AutoresponderRow->ardescription</label><p></td>\n");
					print ("<td align='right'><p><b>".number_format($NumberOfUsers)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></p></td>\n");
					print ("<td align='center'><p><b>".($NumberOfMessages - 1)."</b></p></td>\n");
					print ("</tr>\n");
				} //end for loop
			} // end if

			print ("</table><hr style='width:95%;color:#039'><table  summary='' style='width:95%;BORDER:none;PADDING:4px;text-align:center;'>");
			print ("<tr><td style='text-align:center;width:100%;'>");
			print ("<form action='AddCampaign.php'>");
			print ("<input type='hidden' name='arid' value='$arid'>");
			print ("<input class='submit' type='submit' name='AddArg' value='Add New' onClick=\"this.style.width='130px';this.value='Adding'\"");
 			print ("onMouseover=\"this.className='MouseOver'\" onMouseout=\"this.value='Add New';this.className='submit';this.style.width='80px';\">");

			print ("&nbsp;&nbsp;&nbsp;");
			print ("<input class='cancel' type='button' name='button' value='Home' onClick=\"this.value='Exiting Page...';location='home.php'\"");
 			print ("onMouseover=\"this.className='MouseOver'\" onMouseout=\"this.value='Home';this.className='cancel'\">");
			print ("</form></td></tr></table>");
		 ?>
	
<?php
	xxxReferenceLinks();
?>
</div> <!-- end of Wrapper -->

</BODY>
</HTML>
