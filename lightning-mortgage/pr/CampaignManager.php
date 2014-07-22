<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright © Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/

// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =//
//																					//
// CampaignManager.php: This script displays the menu of tasks for an Autoresponder	//
//																					//
// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =//


$cmd  = $_GET['cmd']; 		// 3 = delete, 2 = clone, 1 = manage
$arid = $_GET["arid"];		// autoresponder number
include("check1.php");		// cookie exists?
include("conn.php"); 		// for logging messages
$user = $_COOKIE["UName"];
include("settings.php");	// Include the phpmailer function and footer functions

$result = mysql_query("SELECT * FROM autoresponders where user='$user' and arid=$arid", $link); 
$num_rows = mysql_num_rows($result);
//mysql_data_seek($result, 0) or die(logMessage("DoAutoresponder (".__LINE__.") Could not move pointer to autoresponder row"));
$arrow = mysql_fetch_object($result) or die(logMessage("DoAutoresponder (".__LINE__.") Could not read next autoresponder row"));
$CampaignState = $arrow->CampaignState;
$CampaignDescription = $arrow->ardescription;
$result = mysql_query("SELECT * FROM users where arid=$arid and confirmed='Y' and currentmsg < 253", $link); //list only active subscribers 
$num_rows = mysql_num_rows($result);
$numusers=0;
if($num_rows>0)
{
	$NumberOfUsers=$num_rows;
}

if ($cmd == 3)	// request is a delete of autoresponder, if a delete
{
	//die ("arid $arid Display_Name '$CampaignDescription'");
	print ("<script javascript>location.href='DeleteCampaign.php?arid=$arid';</script>\n");
}

if ($cmd == 2) //clone
{
	// if a clone AR command is sent from manar.php
	print ("<form name='formClone' id='formClone' action='CloneAR.php' method='get'>\n");
	print ("<input type='hidden' name='FromArid' value='$arid'>\n");
	print ("<input type='hidden' name='CloneMessages' value=1>\n");
	print ("<input type='hidden' name='CloneUsers' value=1>\n</form>\n");	
	print ("<script type='text/javascript'>\ntop.frames['Main'].location.href='CloneAR.php?FromArid=$arid&CloneMessages=1&CloneUsers=1';\n</script>\n");
	die("CampaignManager (".__LINE__.") Should not have reached this line");
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<HTML>
<HEAD>
<!--

Perfect Response - Email Marketing at Its Best!
Copyright © Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com
-->

<TITLE>Campaign Manager  - Perfect Response</TITLE>
<meta name="robots" content="NoIndex, NoFollow">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="./css/PerfectResponse.css">
<link rel="stylesheet" type="text/css" href="./css/niftyCorners.css">
<script type="text/javascript" src="./js/PerfectResponse.js"></script>
<script type="text/javascript" src="./js/nifty.js"></script>
<style type="text/css" media="screen">
.Action {float:left;width:230px;text-align:right;font-size:small;line-height:24px;}
.Action a {color:#800000;}
.Description {float:left;text-align:left;font-size:small;font-weight:normal;line-height:24px;}
</style>
<script type="text/javascript">
<!--

function manar(id)
{
	location.href="EditCampaign.php?arid="+id;
}

function deletear(id, Aname)
{
	if(confirm("Deleting this autoresponder email campaign '"+id+" - "+Aname+"' will also delete all users and messages in it.\nAre you sure you want to delete this autoresponder?"))
		location.href="deletear.php?arid="+id;
	else
		location.href="manar.php";
}

function CloneAR(id, Aname)
{
	if(confirm("Cloning this autoresponder email campaign '"+id+" - "+Aname+"' will clone both users and messages in it.\nAre you sure you want to clone this autoresponder?"))
		location.href='CloneAR.php?arid='+id+'&NewArid=&CloneUsers=1&CloneMessages=1';
	else
		location.href="manar.php";
}

function CopyMessagesFrom(id, Aname)
{
	if(confirm("Copying messages from email campaign '"+id+" - "+Aname+"' will also delete existing messages (if any).\nAre you sure you want to copy messages?"))
		return true;
	else
		return false;
}

function VerifyMessageCopy()
{
	/*Aname=document.formClone.NextAridName.value;*/
	
	if (confirm("Are you sure you want to import the messages into this campaign?"))
		return(true);
	else
		return(false);
}

function VerifySubscriberCopy()
{
	/* Aname=document.formClone.NextAridName.value;*/
	
	if (confirm("Are you sure you want to import the subscribers into this campaign?"))
		return(true);
	else
		return(false);
}



//-->
</script>
</HEAD>
<body>
<div id="Wrapper"><div id="content">
<span class="BoxHeading">
<input type="button" id="submit" name="submit" value="Click for helpful hints!" class="Button" onclick="Show();" onmouseover="document.getElementById('submit').style.fontWeight='bold';" onmouseout="document.getElementById('submit').style.fontWeight='normal';">
</span>
<div id="navBeta">
	<h2>Campaign Tips</h2>

	<p>	It is quite easy to create and edit <i>Perfect Response</i>&#153; campaign messages. Yet you may find the
	features on your word processing or email programs to be much more robust in terms of editing and spell-checking.</p>
	<p>Just copy and paste message text from those systems right into <i>Perfect Response</i>, including HTML codes
	if you're sending messages formatted with HTML.</p>

	<p>We have found that people like to receive HTML formatted message because of the sometimes dazzling effects. Yet
	they don't like the bulky overhead that these messages carry. You might be better served by sending plain text messages
	that are clear, concise, and makes use of white space.</p>

	<p>Use the <i>Message Test</i> function to send yourself the messages. Make sure your messages don't appear to be
	crunched into one big paragraph.</p>
	<p>Delete Bounced Messages - If you have a unique mailbox specified for receiving undeliverable messages (as specified in 
	the Campaign Settings under Receiving Server, and Receiving Mailbox Name) then that mailbox will be read and the email addresses specified in
	those messages will be removed from the campaign database. Otherwise, if you receive the undeliverable messages in a mailbox
	you use for other email, you can paste those messages in the Delete Bounced page's text box that appears.</p> 
</div>
<h2>
	<?php 
			print ("<div class='Action'>Campaign is </div><div class='Description'style='margin-left:10px;'>");
			if ($CampaignState == "Suspended")
			{
				print("<form name='ToggleForm' action=''>\n");
				print("<input id='CampaignButton' type='button' name='submit2' onClick='ToggleCampaignStatus($arid)'\n");
				print("onmouseover=\"document.getElementById('CampaignButton').style.fontWeight='bold';\"\n"); 
				print("onmouseout=\"document.getElementById('CampaignButton').style.fontWeight='normal';\"\n");
 				print("value='Suspended' style='width:90px;background:#DC143C;color:#fff;'></form>\n");	
			}
			if ($CampaignState == "Active")
			{
				print("<form name='ToggleForm' action=''>\n");
				print("<input id='CampaignButton' type='button' name='submit3' onClick='ToggleCampaignStatus($arid)'\n");
				print("onmouseover=\"document.getElementById('CampaignButton').style.fontWeight='bold';\"\n"); 
				print("onmouseout=\"document.getElementById('CampaignButton').style.fontWeight='normal';\"\n");
	 			print("value='Active' style='width:90px;background:#004a8d;color:#fff;'></form>\n");	
			}
				 					 	
			print("</div><br style='clear:left;'>Campaign Manager: <i>$CampaignDescription</i></h2>\n"); 
//---Add Subscribers -------------------------
			print("<div class='Action'><a href='Add.php?arid=$arid'>\n");  
			print("Add</a></div><div class='Description'>&nbsp;- Manually add subscribers</div><br style='clear:left;'>\n");

//---Remove Bad Subscribers ------------	
			print("<div class='Action'><a href='DeleteBounced.php?arid=$arid'>\n"); 
			print("Remove Bounced</a></div><div class='Description'>&nbsp;- Those who are bouncing messages</div><br style='clear:left;'>\n");
	
//---Edit Subscribers ---------------------------	
			print("<div class='Action'><a href='EditSubscriber.php?arid=$arid'>\n"); 
			print("Edit</a></div><div class='Description'>&nbsp;- Email, Name, date, current msg</div><br style='clear:left;'>\n");

//---Display Subscribers ------------------------
			if ($NumberOfUsers >0)
			{
				print("<div class='Action'><a target='Monitor' href='DisplaySubscribers.php?arid=$arid'>\n");
				print("Display</a></div><div class='Description'>&nbsp;- The ".number_format($NumberOfUsers)." subscribers</div><br style='clear:left;'>\n");
			}

//---Special Mail Subscribers ------------------------
			if ($NumberOfUsers >0)
			{
				print("<div class='Action'><a target='Monitor' href='MailSubscribers.php?arid=$arid'>\n");
				print("Special Mail</a></div><div class='Description'>&nbsp;- The ".number_format($NumberOfUsers)." subscribers</div><br style='clear:left;'>\n");
			}

//---Export Subscribers ------------------------
			if ($NumberOfUsers >0)
			{
				print("<div class='Action'><a target='Monitor' href='export.php?arid=$arid'>\n");
				print("Export</a></div><div class='Description'>&nbsp;- The ".number_format($NumberOfUsers)." subscribers</div><br style='clear:left;'>\n");
			}
					
//---Copy Subscribers ------------------------
			$AutoresponderResult 	= mysql_query("SELECT * FROM autoresponders where user='$user' order by ardescription", $link); 
			$NumberOfAutoresponders = mysql_num_rows($AutoresponderResult); 		

			if($NumberOfAutoresponders > 0) //autoresponder=mail campaign
			{
				print ("<form name='formCopy' action='CloneAR.php' method='get'>\n");
				print ("<input type='hidden' name='ToArid' value='$arid'>\n");
				print ("<input type='hidden' name='CloneMessages' value=0>\n");
				print ("<input type='hidden' name='CloneUsers' value=1>\n");
				print ("<div class='Action'>Copy subscribers from</div><div class='Description'>&nbsp;\n");
				print ("<select style='color:#800000;font-weight:bold;font-size:12px;width:230px;' size='1' name='FromArid' onChange='if(VerifySubscriberCopy()==true) submit();'>\n");
				print ("<option selected value='0'>Select Existing Email Campaign</option>\n");

				for($count=0; $count < $NumberOfAutoresponders; $count++) 
				{
					mysql_data_seek($AutoresponderResult, $count); //set db pointer to next autoresponder
					$AutoresponderRow	= mysql_fetch_object($AutoresponderResult);
					$FromArid			= $AutoresponderRow->arid;
					$FromAridName		= $AutoresponderRow->ardescription;

					if ($arid != $FromArid) //can't copy from the current autoresponder
						printf ("<option value='$FromArid'>%03s $FromAridName</option>\n",$FromArid);
				}

				print ("</select></div><br style='clear:left'>\n");
				print ("</form>\n");
			}

			print("<hr>\n"); 
//---Verify Subscriber email/ip address ---- 			
			//print("<div class='Action'><a href='spam.php?arid=$arid'>\n"); 
			//print("Spam Tracking</a></div><div class='Description'>&nbsp;- Verify by email or IP address</div>\n");

//---Broadcast -------------------------------
//			print("<div class='Action'><a href='BroadcastAll.php?arid=$arid'>\n"); 
//			print("Broadcast</a></div><div class='Description'>&nbsp;- Immediate send to all subscribers</div><br style='clear:left;'>\n");

//---Restart Campaign ------------------------
			print("<div class='Action'><a href='RestartCampaign.php?arid=$arid'>\n"); 
			print("Restart Campaign</a></div><div class='Description'>&nbsp;- For all or some subscribers</div><br style='clear:left;'>\n");

//---Check for Duplicate Subscribers ------------	
			print("<div class='Action'><a target='Monitor' href='DuplicateCheck.php?arid=$arid'>\n"); 
			print("Duplicate Check</a></div><div class='Description'>&nbsp;- Deletes duplicate subscribers</div><br style='clear:left;'>\n");
//---Remove Subscribers -------------------------
			print("<div class='Action'><a href='Remove.php?arid=$arid'>\n"); 
			print("Remove</a></div><div class='Description'>&nbsp;- Manually remove subscribers</div><br style='clear:left;'>\n");

			print("<hr>\n"); 

//---Manage Messages ------------------------
			$result = mysql_query("SELECT * FROM messages where arid=$arid", $link); 
			$NumberOfMessages = mysql_num_rows($result);  
			$NumberOfMessages--;	//don't count the footer as a message
			$NumberOfMessages = $NumberOfMessages - 4; //to account for the subscribe/signature messages
			
			print ("<div class='Action'><a href='ManageMessages.php?arid=$arid'> ");
			
			if ($NumberOfMessages == 0)
				print ("Manage Messages</a></div><div class='Description'>&nbsp;- Add messages</div><br style='clear:left;'>\n");
			else
				print ("Manage Messages</a></div><div class='Description'>&nbsp;- Add/Change/Delete the <b>$NumberOfMessages</b> messages</div><br style='clear:left;'>\n");

//---Message Test ----------------------------
//			print("<div class='Action'><a href='InstantTest.php?arid=$arid'>\n");  
//			print("Message Test</a></div><div class='Description'>&nbsp;- Send one or all messages</div><br style='clear:left;'>\n");

			//print("<hr>\n"); 
			
//---Clone Messages -------------------------
			$AutoresponderResult 	= mysql_query("SELECT * FROM autoresponders where user='$user' order by ardescription", $link); 
			$NumberOfAutoresponders = mysql_num_rows($AutoresponderResult); 		

			if($NumberOfAutoresponders > 0) //autoresponder=mail campaign
			{
				print ("<form name='formClone' action='CloneAR.php' method='get'>\n");
				print ("<input type='hidden' name='ToArid' value='$arid'>\n");
				print ("<input type='hidden' name='CloneMessages' value=1>\n");
				print ("<input type='hidden' name='CloneUsers' value=0>\n");
				print ("<div class='Action'>Copy messages from</div><div class='Description'>&nbsp;\n");
				print ("<select style='color:#800000;font-weight:bold;font-size:12px;width:230px;' size='1' name='FromArid'\nonChange='if(VerifyMessageCopy()==true) submit();'>\n");
				print ("<option selected value='0'>Select Existing Email Campaign</option>\n");

				for($count=0; $count < $NumberOfAutoresponders; $count++) 
				{		
					mysql_data_seek($AutoresponderResult, $count); //set db pointer to next autoresponder
					$AutoresponderRow	= mysql_fetch_object($AutoresponderResult);
					$FromArid			= $AutoresponderRow->arid;
					$FromAridName		= $AutoresponderRow->ardescription;

					if ($arid != $FromArid) //can't clone from the current autoresponder
//						print ("<option value='$NextArid'>$NextArid $NextAridName </option>\n");
						printf ("<option value='$FromArid'>%03s $FromAridName</option>\n",$FromArid);
				}

				print ("</select></div><br style='clear:left'>\n");
				print ("</form>\n");
			}

			print("<hr>\n"); 

//---Campaign Settings -------------------------------
			print("<div class='Action'><a target='Main' href='EditCampaign.php?arid=$arid&CampaignState=$CampaignState'>\n");  
		print("Campaign	Settings</a></div><div class='Description'>&nbsp;- Edit campaign's configuration</div><br style='clear:left;'>\n");

//---Check for Subscriber/unsubscribe code ----				
			print("<div class='Action'><a href='htmlcode.php?arid=$arid'>\n");  
			print("Subscribe/Unsubscribe Code</a></div><div class='Description'>&nbsp;- Copy HTML code for these pages</div><br style='clear:left;'>\n");
	JumpToCampaign($link, $arid); 
	ReferenceLinks($arid);
?>
</div></div> <!-- end of Wrapper -->

</BODY>
</HTML>
