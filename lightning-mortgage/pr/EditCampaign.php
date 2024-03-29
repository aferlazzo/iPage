<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright � Tony Ferlazzo 2004 
Version 1.0 Written by: Anthony Ferlazzo, anthony@prontocommercial.com

*/

//include("settings.php");
include("check1.php");
Include("conn.php");
$arid=$_GET["arid"];
$CampaignState=$_GET["CampaignState"];
$WithinScript = "I know the arid";
include("settings.php");

if ($arid=="") 
{
	echo "<b>Unable to find record for selected Autoresponder.<BR>Please go <a href ='void(history.back())'>back</a> and try again";
	exit;
}

	$result = mysql_query("SELECT * FROM autoresponders where arid=$arid", $link); 
	$num_rows = mysql_num_rows($result);
	
	if ( $num_rows < 0 ) {
		echo "<b>Unable to find record for selected Autoresponder.<BR>Please go <a href ='void(history.back())'>back</a> and try again";
		exit;
	}
	
	mysql_data_seek($result, 0);
	$row = mysql_fetch_object($result);	
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<HTML>
<HEAD>
<TITLE>Campaign Settings - Perfect Response</TITLE>
<meta name="robots" content="NoIndex, NoFollow">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="./css/PerfectResponse.css">
<link rel="stylesheet" type="text/css" href="./css/niftyCorners.css">
<script type="text/javascript" src="./js/PerfectResponse.js"></script>
<script type="text/javascript" src="./js/nifty.js"></script>
</HEAD>
<body>
<div id="Wrapper"><div id="content">
<span class="BoxHeading">
<input type="button" id="submit" name="submit" value="Click for helpful hints!" class="Button" onclick="Show();" onmouseover="document.getElementById('submit').style.fontWeight='bold';" onmouseout="document.getElementById('submit').style.fontWeight='normal';">
</span>
<div id="navBeta">
	<h2>Note</h2>
<p><span style="background-color: #DC143C; color: #ffffff;">Suspended</span> campaigns do not send messages.</p>
<p>Perfect Response uses the mailbox you specify to send and receive mail, it doesn't know what your address is.</p> 
<p>Before you can use Perfect Response to send out messages you'll need to tell it what mailbox to use, and which
mail server to send it from. Be careful specifying the mail server. Typically you'll want to leave the setting as 'localhost'
because you'll want to have this server send the messages for you.</p>
<p>If you put in your SMTP server's address messages will 
have to be forwarded from this server to your SMTP server before being sent to a recipient's SMTP server for delivery. It is
an extra step that is unnecessary most of the time.</p>
<p>If the SMTP server is not localhost, and ONLY if it requires authentication, enter the mailbox/password that will send 
email on your behalf (often set the same as 'Send From Email Address').</p>
<p>Wordwrap and Max Line Length settings are only used when sending text messages.</p>
</div>
<div class="title"> 
<table>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td width="45%"><td>
		<td width="55%"><h2>&nbsp;</h2>
		</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
</table>
</div>
<TABLE CELLSPACING='4' align="center">
	<TR> 
		<TD WIDTH='45%'></TD>
		<TD WIDTH='55%'></TD>
	</TR>
	<tr>
		<td colspan='2' align='center'><h2>
	<?php 

			if ($CampaignState == "Suspended")
				print ("Campaign is <span style='background-color: #DC143C; color: #ffffff; font-weight: bold;'>Suspended</span>");
			else	
				print ("Campaign is <span style='background-color: #004a8d; color: #ffffff; font-weight: bold;'>Active</span>");					 	
			print("<br /><span id='Grow'><i>$CampaignDescription</i></span></h2></td></tr><tr><td colspan='2' align='center'><h3>");
	?>
		</td>
	</TR>

	<TR> 
		<td align="center" valign="top" colspan='2'> 
			<h2>Edit The Existing Campaign</h2>
			<form name="form1" method="post" action="EditCampaignAction.php"> <!--onsubmit="alert('armode: '+ form1.armode.value);"-->
			<input type="hidden" name="arid" value="<?php echo $arid ?>">
		</td>
	</tr>
	<tr>
		<td height="15" align="right"><label for="ardescription">Campaign Description</label></td>
		<td align="left">  
			<input type="text" name="ardescription" id="ardescription" size="33" value="<?php echo $row->ardescription; ?>"
				title="Enter the campaign description.&#013Only you will see this description."
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		</td>
	</tr>
	<tr>
		<td height="15" align="right"><label for="arname">From Name</label></td>
		<td align="left">  
			<input type="text" name="arname" id="arname" size="33" value="<?php echo $row->arname; ?>"
				title="Enter the name you want to show as&#013the 'From:' name for the mail campaign"
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		</td>
	</tr>
	<tr>
		<td height="15" align="right"><b>Campaign Status</b></td>
		<td align="left">
			<select style='<?php if ($row->CampaignState=="Suspended") echo 'background:red' ?>' name="CampaignState"
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
			
			<option style="background:#fff;" title="Active: Messages are sent\nSuspended: Messages are not sent" <?php if ($row->CampaignState=="Active")  echo " selected" ?> value="Active">Active</option>
			<option style="background:#DC143C;" title="Active: Messages are sent\nSuspended: Messages are not sent" <?php if ($row->CampaignState=="Suspended") echo "selected" ?> value="Suspended">Suspended</option>
			</select>
		</td>
	</tr>

	<tr>
		<td height="15" align="right"><label for="arfromemail">Send From Email Address</label></td>
		<td align="left">  
				<input type="text" name="arfromemail" id="arfromemail" size="33" value="<?php echo $row->arfromemail;?>"
					title="Enter the email address to be used to send the message."
					onfocus="this.style.border='2px solid #000080'"  
					onblur="this.style.border='2px solid gray';document.form1.popuname.value=document.form1.arfromemail.value;">
		</td>
	</tr>
	<tr> 
		<td height="15" align="right"><label for="smtphostname">SMTP Server Name</label></td>
		<td align="left">  
			<input type="text" name="smtphostname" id="smtphostname" size="33" value="<?php echo $row->smtphostname;?>"
				title="Enter the mail server that sends email on your behalf. Default is localhost."
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		</td>
	</tr>
	<tr> 
		<td height="15" align="right"><label for="smtpport">SMTP Server Port</label></td>
		<td align="left">  
			<input style="text-align: right" type="text" name="smtpport" id="smtpport" size="5" value="<?php echo $row->smtpport;?>"
				title="By default, the port number used for smtp mail is 25."
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		</td>
	</tr>
	<tr> 
		<td height="15" align="right"><label for="smtpuname">SMTP Mailbox Name</label></td>
		<td align="left">  
			<input type="text" name="smtpuname" id="smtpuname" size="33" value="<?php echo $row->smtpuname;?>"
				title="Fill only if the SMTP server requires authentication."
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		</td>
	</tr>
	<tr> 
		<td height="15" align="right"><label for="smtppwd">SMTP Mailbox Password</label></td>
		<td align="left">  
			<input type="password" name="smtppwd" id="smtppwd" size="33" value="<?php echo $row->smtppwd;?>"
				title="Fill only if the SMTP server requires authentication."
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		</td>
	</tr>


	<tr> 
		<td height="15" align="right"><label for="arreplytoemail">(Optional) Reply-To Email</label></td>
		<td align="left">  
			<input type="text" name="arreplytoemail" id="arreplytoemail" size="33" value="<?php echo $row->arreplytoemail;?>"
				title="Replies to messages sent will go here.&#013If left blank, replies will go to the 'Sent From:' address"
					onfocus="this.style.border='2px solid #000080'"  
					onblur="this.style.border='2px solid gray';document.form1.arbademail.value=document.form1.arreplytoemail.value;document.form1.aradminemail.value=document.form1.arreplytoemail.value;">
		</td>
	</tr>
	<tr> 
		<td height="15" align="right"><label for="arbademail">Bad Address Notifications</label></td>
		<td align="left">  
			<input type="text" name="arbademail" id="arbademail" size="33" value="<?php echo $row->arbademail;?>"
			 	title="If left blank, 'bad address' notices will go to the 'Sent From:' address"
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		</td>
	</tr>
	<tr> 
		<td height="15" align="right"><label for="aradminemail">Admin/Abuse Notification Email</label></td>
		<td align="left">  
			<input type="text" name="aradminemail" id="aradminemail" size="33" value="<?php echo $row->aradminemail;?>"
				title="Unsubscribe problem notifications will be sent to this email address"
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		 </td>
	</tr>
	<tr> 
		<td height="15" align="right"><label for="armode">Subscription Mode</label></td>
		<td  align="left" size="33">  
			<select name="armode" id="armode"
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
				<option value="1" title="Double Opt-In subscription requests have a confirmation e-mail sent\nprior to subscribing the requestor" <?php if ($row->armode==1) echo "selected";?>>Single Opt-In</option>
				<option value="2" title="Double Opt-In subscription requests have a confirmation e-mail sent\nprior to subscribing the requestor" <?php if ($row->armode==2) echo "selected";?>>Double Opt-In</option>
			</select>
		</td>
	</tr>
	<tr> 
		<td height="15" align="right"><label for="arsubemail">Email Accepting Subscriptions</label></td>
		<td align="left">  
			<input type="text" name="arsubemail" id="arsubemail" size="33" value="<?php echo $row->arsubemail;?>"
				title="If left blank, subscriptions cannot be made via&#013an e-mail with 'Subscribe' in the Subject: line.<br>CAUTION: Do not use someone's 'live' account.<br>Non-autoresponder messages will get deleted."
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		</td>
	</tr>


	<tr> 
		<td height="15" align="right"><label for="popuname">Receiving Mailbox Name</label></td>
		<td align="left">  
			<input type="text" name="popuname" id="popuname" size="33" value="<?php echo $row->popuname;?>"
				title="Enter the user name/mailbox on the mail server that receives email on your behalf (normally set&#013the same as 'Send From Email Address')"
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		</td>
	</tr>
	<tr> 
		<td height="15" align="right"><label for="poppwd">Receiving Mailbox Password</label></td>
		<td align="left">  
			<input type="password" name="poppwd" id="poppwd" size="33" value="<?php echo $row->poppwd;?>"
				title="Enter the password for the POP3 user name on the mail server that receives email on your behalf (password for 'Send From Email Address')"
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		</td>
	<tr> 
		<td height="15" align="right"><label for="pophostname">Your (POP3) Receiving Server</label></td>
		<td align="left">  
			<input type="text" name="pophostname" id="pophostname" size="33" value="<?php echo $row->pophostname;?>"
				title="Enter the mail server that receives email on your behalf"
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		</td>
	</tr>
	<tr> 
		<td height="15" align="right"><label for="popport">POP3 Your (POP3) Server Port</label></td>
		<td align="left">  
			<input style="text-align: right" type="text" name="popport" id="popport" size="5" value="<?php echo $row->popport;?>"
				title="By default, the port number used for POP3 mail is 110"
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		</td>
	</tr>

	<tr> 
		<td height="15" align="right"><label for="arwordwrap">Enable Wordwrap</label></td>
		<td align="left"> 
			<input type="checkbox" class='radiogroup' name="arwordwrap" id="arwordwrap" title='It is recommended that your autowrap settings be set to 60 characters by default' 
			value='1' <?php if ($row->arwordwrap==1) { echo checked ; } ?>
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
					
					
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Max Line Length</b>
			<select name="arwraplen">
		<?php
		 		for($k=50;$k<=71;$k++)
				{
					print("<option value=$k");
					
					if($row->arwraplen==$k) 
						print (" selected");
					
					print (">$k </option>");
				}
		?> 
			</select>

		</td>
	</tr>
	<tr> 
		<td height="15" align="right"><label for="customconf">Custom Confirmation Page</label></td>
		<td align="left"> 
			<input type="checkbox" class='radiogroup' name="customconf" id="customconf" value=1 <?php if ($row->customconf==1) { echo checked ; } ?>
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">

				&nbsp;<label for="aremailformat">Message Format</label>
			<select name="aremailformat" id="aremailformat">
				<option value="0" title="Do you want the user to go to a custom page after making a web subscription?" <?php if ($row->aremailformat==0) echo "selected";?>>Text</option>
				<option value="1" title="Do you want the user to go to a custom page after making a web subscription?" <?php if ($row->aremailformat==1) echo "selected";?>>HTML</option>
			</select>
		</td>
	</tr>
	<tr>
		<td height="15" align="right"><label for="custompage">URL of Custom Page</label></td>
		<td align="left">  
			<input type="text" name="custompage" id="custompage" size="33" value="<?php echo $row->custompage;?>"
				title="Enter the web page you want the user to go to after making a web subscription"
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		</td>
	</tr>
	<tr> 
		<td height="15" align="right"><label for="remhtml">Html Message Removal Prompt</label></td>
		<td align="left">
			<input name="remhtml" id="remhtml" size="33" value="<?php echo $row->remhtml;?>"
				title="Enter the notice you want to display just above the unsubscribe URL included at then end of every HTML message sent"
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		</td>
	</tr>
	<tr>
		<td height="15" align="right"><label for="remtext">Text Message Removal Prompt</label></td>
		<td align="left">
			<input name="remtext" id="remtext" size="33" value="<?php echo $row->remtext;?>"
				title="Enter the notice you want to display just above the unsubscribe URL included at then end of every Text message sent"
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		</td>
	</tr>
	<tr>
		<td align="right"> 
			<br><input class='submit' type="submit" name="Submit2" value="Save" onClick="this.value='Saving'"
 			onMouseover="this.className='MouseOver'" onMouseout="this.className='submit'">&nbsp;
			<input class='cancel' type='button' value='Cancel' onClick='window.location.href="CampaignManager.php?arid=<?php echo $arid ?>&cmd=1"' 
 			onMouseover="this.className='MouseOver'" onMouseout="this.className='cancel'"><br />&nbsp;
			</form>
		</td>
		<td>
<?php

	print("<form name=InstantForm' action='InstantTestAction.php' method='post'>\n");
	print ("<input type='hidden' name='arid' value='$arid'>\n");
	print ("<input type='hidden' name='MsgNo' value='-2'>\n");
	print ("<input type='hidden' name='InstantTestFullName' 	value= '$row->arname';>\n");
	print ("<input type='hidden' name='InstantTestEmailAddress' value= '$row->arfromemail';>\n");
	print ("<input type='hidden' name='smtpport'				value= '$row->smtpport';>\n");	
	//die("EditCampaiggn (".__LINE__.") smtp port '$row->smtpport'");
	print ("<input type='hidden' name='InstantTestUserDefined1'	value= '';>\n");
	print ("<input type='hidden' name='InstantTestUserDefined2'	value= '';>\n");
	print ("<input type='hidden' name='InstantTestUserDefined3'	value= '';>\n");
	print ("<input type='hidden' name='InstantTestUserDefined4'	value= '';>\n");

	
	print ("<input class='submit' type='submit' name='OtherT' value='Send Test to Campaign Originator' style='width:270px;' onClick=\"this.value='Testing'\" ");
	print ("onMouseover=\"this.className='MouseOver'\" onMouseout=\"this.className='submit'\" title='Send an instant test of the welcome message to $arfromemail'>\n");
	print ("</form>\n");
?>
		</td>
	</TR>
</TABLE>
<?php
	JumpToCampaign($link, $arid); 
	ReferenceLinks($arid);
	print("</div>\n"); 
?>
</div> <!-- end of Wrapper -->
</BODY>
</HTML>
