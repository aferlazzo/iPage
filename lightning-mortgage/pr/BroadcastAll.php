<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright � Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/

include("check1.php");
Include("conn.php");
$arid=$_GET["arid"];
$WithinScript = "I know the arid";
Include("settings.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<HTML>
<HEAD>
<TITLE>Perfect Response Broadcast</TITLE>
<meta name="robots" content="NoIndex, NoFollow">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="./css/PerfectResponse.css">
<link rel="stylesheet" type="text/css" href="./css/niftyCorners.css">
<script type="text/javascript" src="./js/PerfectResponse.js"></script>
<script type="text/javascript" src="./js/nifty.js"></script>
<script type="text/javascript">
<!--

function manar(id)
{
	location.href="EditCampaign.php?arid="+id;
}

function Validate()
{
	var Subject = document.MsgForm.txtMessage_Subject.value;
	var Text=document.MsgForm.txtMessage_Text.value;
	
	if ((Subject == "") || (Text == ""))
	{
		alert("The Subject and the Message cannot be blank.");
		document.MsgForm.Submit.value = "Send";
		return(false);
	}
	if (Text.length <100)
	{
		if(confirm("Are you sure you want to send:\n\nSubject: "+Subject+"\nBody:\n"+Text) == false)
		{
			document.MsgForm.Submit.value = "Send";
			return(false);
		}
	}
	else
	{
		if(confirm("Are you sure you want to send:\n\nSubject: "+Subject+"\nBody:\n"+Text.substr(0,100)+"...") == false)
		{
			document.MsgForm.Submit.value = "Send";
			return(false);
		}
	}

	return(true);
}
	
function PostedIt()
{
	
	if (Validate() == true)
	{
		alert("This broardcast has already been sent!");
		return (false);
	}
	
	return(confirm('This message will be sent to all subscribers of email campaign \'<?php echo $CampaignDescription; ?>.\'\nAre you sure your message is ready to be sent?'));
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
	<h2>Broadcast Help</h2>
	<p>Remember to add a message signature. Unlike other campaign email
	which has the campaign signature attached to it, broadcast messages do not
	include the default signature lines.</p>
	
	<p>You can personalize both the subject and/or message 
	bodys by using %FullName% and %EmailAddress% (note case sensitivity).</p>
	<p>Example: Hello, %FullName%! How are you? </p>
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
<TABLE CELLPADDING='4' CELLSPACING=0 align="center">
	<TR> 
		<td align="center" colspan='2'><h2>Broadcast a message to subscribers of
	<?php 
		print("<br /><span id='Grow'><i>$CampaignDescription</i></span></h2>");
	?>
		</td>
	</tr>
	
	<tr> 
		<td align='left' colspan='2'> 
		<?php
			print("<p align='justify'>You can use the pre-defined personalization fields, too.</p>"); 
			 print("<form name='MsgForm' onSubmit='return(PostedIt);' method='post' "); 
			$directory=dirname(__FILE__);
			//print("in demo directory".stristr($directory, 'demo'));

			if (stristr($directory, "demo")) 
			{
				print (">");
				logMessage("BroadcastAll (".__LINE__.") **Not sending broadcast from demo**");
			}
			else
				print("action='BroadcastAllAction.php' target='Monitor'>");
		?>

			<input type="hidden" name="arid" <?php echo "value=\"$arid\"" ?>>
			<input type="hidden" name="CampaignDescription" value="<?php echo '$CampaignDescription' ?>">
			<input type="hidden" name="enctype" value="multipart/form-data">
		</td>
	</tr>
	<tr>
		<td colspan='2' align='center' valign='middle'>
			<p style='text-align: center;'><label for="txtMessage_Subject">Subject</label></p>
		</td>
	</tr>
	<tr>
		<td colspan='2' align='center'>
			<p><input name="txtMessage_Subject" id="txtMessage_Subject" type="text" title="Put your message's subject here" size="78"></p>
		</td>
	</tr>
	<tr>
		<td colspan='2' align='center' valign='top'>
			<p><label for="txtMessage_Text">Message</label></p>
		</td>
	</tr>
	<tr>
		<td colspan='2' align="center"> 
			<textarea name="txtMessage_Text" id="txtMessage_Text" cols="60" rows="15" title="Enter your message here"
				wrap="VIRTUAL"></textarea><br />&nbsp;</p>
			<p align="center">
			<input class='submit' type="submit" name="Submit" id="Submit" value="Send Broadcast" onClick="this.value='Now Sending ...'; return(Validate());"
 			onMouseover="this.className='MouseOver'" onMouseout="this.className='submit'">&nbsp;
			<input class='cancel' type='button' value='Cancel' onClick='window.location.href="CampaignManager.php?arid=<?php echo $arid ?>&cmd=1"' 
 			onMouseover="this.className='MouseOver'" onMouseout="this.className='cancel'">
				
			</p>
			</form>
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
