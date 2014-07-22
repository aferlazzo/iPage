<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright � Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/
include("check1.php");
Include("conn.php");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<HTML>
<HEAD>
<TITLE>Perfect Response Add Email Campaign</TITLE>
<meta name="robots" content="NoIndex, NoFollow">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="./css/PerfectResponse.css">
<link rel="stylesheet" type="text/css" href="./css/niftyCorners.css">
<script type="text/javascript" src="./js/PerfectResponse.js"></script>
<script type="text/javascript" src="./js/nifty.js"></script>
<script type="text/javascript">
<!--
function Trim(strInput) 
{
	if(strInput.length == 0) 
	{
		return "";
	} 
	else 
	{
		strTemp = strInput.substring(strInput.length - 1)
	}

	while (strTemp == " ") 
	{
		strInput = strInput.substring(0, strInput.length - 1)

		if (strInput.length == 0) 
		{
			strTemp = "";
		} 
		else 
		{
			strTemp = strInput.substring(strInput.length - 1)
		}
	}

	if (strInput.length == 0) 
	{
		strTemp = "";
	} 
	else 
	{
		strTemp = strInput.substring(0, 1)
	}

	while (strTemp == " ") 
	{
		strInput = strInput.substring(1)

		if (strInput.length == 0) 
		{
			strTemp = "";
		} 
		else 
		{
			strTemp = strInput.substring(0, 1)
		}
	}

	return strInput;

}//close Trim Function

function Validate()
{
	var objName = document.form1;
	var xxx;

	if(Trim(objName.ardescription.value) == "")
	{
		alert("Please enter the Mail Campaign Name")
		objName.ardescription.focus();
		return false;
	}
	if(Trim(objName.arname.value) == "")
	{
		alert("Please enter the Name messages will come from")
		objName.arname.focus();
		return false;
	}

	return true;
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
<h2>Notes</h2>
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
<form name="form1" onSubmit="return(Validate());" method="post" action="AddCampaignAction.php">
<TABLE CELLSPACING='4' align="center">
	<TR> 
		<TD WIDTH='45%'></TD>
		<TD WIDTH='55%'></TD>
	</TR>
	<tr>
		<td colspan='2' align='center'> 
			<b><font face="Verdana, Arial, Helvetica, sans-serif" size="4"><br>
	<tr><td colspan='2' align='center'>
	<h3>New Email Campaign is <span style='background-color: #DC143C; color: #ffffff; font-weight: bold;'>Suspended</span></h3>
		</font></b></td>
	</TR>

	<tr>
		<td colspan='2' align="center"> 
			<h2><span id='Grow'><i>Create New Email Campaign</i></span></h2>
		</td>
	</tr>
	<tr>
		<td height="30" align="right"><label for="ardescription">Campaign Description</label></td>
		<td align="left">  
			<input type="text" name="ardescription" id="ardescription" size="33"
				title="Enter the campaign description.&#013Only you will see this description."
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		</td>
	</tr>
	<tr>
		<td height="15" align="right"><label for="arname">From Name</label></td>
		<td align="left">  
			<input type="text" name="arname" id="arname" size="33"
				title="Enter the name you want to show as&#013the 'From:' name for the mail campaign"
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		</td>
	</tr>
	
	<tr>
		<td height="15" align="right"><b>Campaign Status</b></td>
		<td align="left">
			<select style='background:red' name="CampaignState"
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
			
			<option style="background:#fff;" title="Active: Messages are sent\nSuspended: Messages are not sent"  value="Active">Active</option>
			<option style="background:#DC143C;" title="Active: Messages are sent\nSuspended: Messages are not sent" selected value="Suspended">Suspended</option>
			</select>
		</td>	</tr>

	<tr>
		<td height="15" align="right"><label for="arfromemail">Send From Email Address</label></td>
		<td align="left">  
				<input type="text" name="arfromemail" id="arfromemail" size="33" 
					title="Enter the email address to be used as the sender of the message."
					onfocus="this.style.border='2px solid #000080'"  
					onblur="this.style.border='2px solid gray';document.form1.popuname.value=document.form1.arfromemail.value;">
		</td>
	</tr>
	<tr> 
		<td height="15" align="right"><label for="smtphostname">SMTP Server Name</label></td>
		<td align="left">  
			<input type="text" name="smtphostname" id="smtphostname" size="33" value='localhost'
				title="Enter the mail server that sends email on your behalf. Default is 'localhost'"
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		</td>
	</tr>
	<tr> 
		<td height="15" align="right"><label for="smtpport">SMTP Server Port</label></td>
		<td align="left">  
			<input style="text-align: right" type="text" name="smtpport" id="smtpport" size="5" value="25"
				title="By default, the port number used for smtp mail is 25"
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		</td>
	</tr>
	<tr> 
		<td height="15" align="right"><label for="smtpuname">SMTP Sending Mailbox Name</label></td>
		<td align="left">  
			<input type="text" name="smtpuname" id="smtpuname" size="33" 
				title="Fill only if the SMTP server requires authentication."
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		</td>
	</tr>
	<tr> 
		<td height="15" align="right"><label for="smtppwd">SMTP Sending Mailbox Password</label></td>
		<td align="left">  
			<input type="password" name="smtppwd" id="smtppwd" size="33" 
				title="Fill only if the SMTP server requires authenication."
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		</td>
	</tr>
	<tr> 
		<td height="15" align="right"><label for="arreplytoemail">(Optional) Reply-To Email</label></td>
		<td align="left">  
			<input type="text" name="arreplytoemail" id="arreplytoemail" size="33" 
				title="Replies to messages sent will go here.&#013If left blank, replies will go to the 'Sent From:' address"
					onfocus="this.style.border='2px solid #000080'"  
					onblur="this.style.border='2px solid gray';document.form1.arbademail.value=document.form1.arreplytoemail.value;document.form1.aradminemail.value=document.form1.arreplytoemail.value;">
		</td>
	</tr>
	<tr> 
		<td height="15" align="right"><label for="arbademail">Bad Address Notifications</label></td>
		<td align="left">  
			<input type="text" name="arbademail" id="arbademail" size="33" 
			 	title="If left blank, 'bad address' notices will go to the 'Sent From:' address"
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		</td>
	</tr>
	<tr> 
		<td height="15" align="right"><label for="aradminemail">Admin/Abuse Notification Email</label></td>
		<td align="left">  
			<input type="text" name="aradminemail" id="aradminemail" size="33" 
				title="Unsubscribe problem notifications will be sent to this email address"
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		 </td>
	</tr>
	<tr> 
		<td height="15" align="right"><label for="armode">Subscription Mode</label></td>
		<td  align="left" size="33">  
			<select name="armode" id="armode"
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
				<option value="1" title="Double Opt-In subscription requests have a confirmation e-mail sent\nprior to subscribing the requestor" selected>Single Opt-In</option>
				<option value="2" title="Double Opt-In subscription requests have a confirmation e-mail sent\nprior to subscribing the requestor">Double Opt-In</option>
			</select>
		</td>
	</tr>

	<tr> 
		<td height="15" align="right"><label for="arsubemail">Email Accepting Subscriptions</label></td>
		<td align="left">  
			<input type="text" name="arsubemail" id="arsubemail" size="33"
				title="If left blank, subscriptions cannot be made via an e-mail with 'Subscribe' in the Subject: line.<br>CAUTION: Do not use someone's 'live' account.<br>Non-autoresponder messages will get deleted."
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		</td>
	</tr>


	<tr> 
		<td height="15" align="right"><label for="pophostname">Your (POP3) Receiving Server</label></td>
		<td align="left">  
			<input type="text" name="pophostname" id="pophostname" size="33"
				title="Enter the mail server that receives email on your behalf"
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		</td>
	</tr>
	<tr> 
		<td height="15" align="right"><label for="popport">Your (POP3) Server Port</label></td>
		<td align="left">  
			<input style="text-align: right" type="text" name="popport" id="popport" size="5" value="110"
				title="By default, the port number used for POP3 mail is 110"
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		</td>
	</tr>


	<tr> 
		<td height="15" align="right"><label for="popuname">Receiving Mailbox Name</label></td>
		<td align="left">  
			<input type="text" name="popuname" id="popuname" size="33" 
				title="Enter the user name/mailbox on the mail server that receives email on your behalf (normally set&#013the same as 'Send From Email Address')"
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		</td>
	</tr>
	<tr> 
		<td height="15" align="right"><label for="poppwd">Receiving Mailbox Password</label></td>
		<td align="left">  
			<input type="password" name="poppwd" id="poppwd" size="33" 
				title="Enter the password for the POP3 user name on the mail server that receives email on your behalf"
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		</td>
	</tr>

	<tr> 
		<td height="15" align="right"><label for="arwordwrap">Enable Wordwrap</label></td>
		<td align="left"> 
			<input type="checkbox" class='radiogroup' name="arwordwrap" id="arwordwrap" title='It is recommended that your autowrap settings be set to 60 characters by default' 
			value='1' checked 
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
					
					
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Max Line Length</b>
			<select name="wraplen">
		<?php
		 		for($k=50;$k<=71;$k++)
				{
					print("<option value=$k");
					
					if($k==65) 
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
			<input type="checkbox" class='radiogroup' name="customconf" id="customconf" value=1
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">

				&nbsp;<label for="aremailformat">Message Format</label>
			<select name="aremailformat" id="aremailformat">
				<option value="0" title="Do you want the user to go to a custom page after making a web subscription?">Text</option>
				<option value="1" title="Do you want the user to go to a custom page after making a web subscription?">HTML</option>
			</select>
		</td>
	</tr>
	<tr>
		<td height="15" align="right"><label for="custompage">URL of Custom Page</label></td>
		<td align="left">  
			<input type="text" name="custompage" id="custompage" size="33" 
				title="Enter the web page you want the user to go to after making a web subscription"
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		</td>
	</tr>
	<tr> 
		<td height="15" align="right"><label for="remhtml">HTML Message Removal Prompt</label></td>
		<td align="left">
			<input name="remhtml" id="remhtml" size="33" value='Click to opt-out'
				title="Enter the notice you want to display just above the unsubscribe URL included at then end of every HTML message sent"
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		</td>
	</tr>
	<tr>
		<td height="15" align="right"><label for="remtext">Text Message Removal Prompt</label></td>
		<td align="left">
			<input name="remtext" id="remtext" size="33" value='Click to opt-out:'
				title="Enter the notice you want to display just above the unsubscribe URL included at then end of every Text message sent"
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center"> 
			<br><input class='submit' type="submit" name="Submit2" value="Save" onClick="this.value='Now Saving ...'"
 			onMouseover="this.className='MouseOver'" onMouseout="this.className='submit'">&nbsp;
			<input class='cancel' type='button' value='Cancel' onClick='window.location.href="ManageCampaigns.php"' 
 			onMouseover="this.className='MouseOver'" onMouseout="this.className='cancel'"><br />&nbsp;
			</form>
		</td>
	</TR>
</TABLE>
<?php
	xxxJumpToCampaign($link, 0); 
	xxxReferenceLinks();
	print("</div>\n"); 
?>
</div> <!-- end of Wrapper -->
</BODY>
</HTML>
