<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright � Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/

if($_COOKIE["UName"]=="")
{
?>
<script type="text/javascript">
//alert("x Going to: default.php");
window.location.href="login.php";
</script>
<?php
}
//----------------------------
//
// This function is a ****Special***** 'footer' for this page 
//
//----------------------------
if (!function_exists(xxxJumpToCampaign))
{
	function xxxJumpToCampaign($link, $arid)
	{
		$user = $_COOKIE["UName"];
		//die("addar (".__LINE__.") would jump to script $_SERVER[SCRIPT_NAME]");
		print("<hr><table style='margin:0 auto;'><tr><td>\n");
		$AutoresponderResult 	= mysql_query("SELECT * FROM autoresponders where user='$user' order by ardescription", $link); 
		$NumberOfAutoresponders = mysql_num_rows($AutoresponderResult); 		

		if($NumberOfAutoresponders > 0) //autoresponder=email campaign
		{
			print ("<form name='formJump' action='EditCampaign.php' method='get'>\n");  //this script
			print ("<input type='hidden' name='NewArid' value='$arid'>\n");
			print ("<input type='hidden' name='cmd' value=1>\n");
			print ("<div class='Description'>&nbsp;\n");
			print ("<select style='color:#800000;font-weight:bold;font-size:12px;width:230px;' size='1' name='arid' onChange='submit();'>\n");
			print ("<option selected value='0'>Work With Another Email Campaign</option>\n");

			for($count=0; $count < $NumberOfAutoresponders; $count++) 
			{
				mysql_data_seek($AutoresponderResult, $count); //set db pointer to next autoresponder
				$AutoresponderRow	= mysql_fetch_object($AutoresponderResult);
				$NextArid			= $AutoresponderRow->arid;
				$NextAridName		= $AutoresponderRow->ardescription;

				if ($arid != $NextArid) //can't jump from the current autoresponder
					printf ("<option value='$NextArid'>%03s $NextAridName</option>\n",$NextArid);
			}
			print ("</form>");
		}
		
		print("</td><td style='text-align:center;'>::&nbsp;<a href='manar.php' title=''>View All Campaigns</a></td></tr></table>\n"); 
	}
}	


if (!function_exists(xxxReferenceLinks))
{
	function xxxReferenceLinks()
	{
		print("<div id='navKappa'>\n");
		print("<div id='navKappaPadlock' onMouseOver='this.style.backgroundColor=\"silver\"' onMouseOut='this.style.backgroundColor=\"transparent\"'>\n");
		print("<a href='unlock.php' target='Monitor' title='If you stopped all campaigns, unlock (restart) them here.' onMouseOver='this.style.backgroundColor=\"transparent\"'>\n");
		print("<img src='./images/unlocked.png' alt='If you stopped all campaigns, restart them here.' style='border:none;'></a></div>\n");

		print("<div id='navKappaLinks'>\n");

		print("<a href='DisplayLog.php?f=activity' title='View the Activity Log' target='LogFile'>Refresh Log</a> ::\n"); 
		print("<a href='home.php'>Home</a> :: <a href='mailout.php' target='Monitor'>Send All Past Due</a> :: \n");
		print("<a href='/pr/home.php?arid=143&amp;cmd=1' onclick='return(LLogout());'>Logout</a></div>\n");

		print("<div id='navKappaStop' onMouseOver='this.style.backgroundColor=\"silver\"' onMouseOut='this.style.backgroundColor=\"transparent\"'>\n");
		print("<a href='lock.php' target='Monitor' title='Made a mistake? Immediately lock (stop) the email Send process.' onMouseOver='this.style.backgroundColor=\"transparent\"'>\n");
		print("<img src='./images/stop.gif' alt='Made a mistake? Immediately stop the email Send process.' style='border:none;'></a></div><br style='clear:left;'></div>\n");
		print("<br />&nbsp;\n");
	}
}
?>
