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
<TITLE>Remove Sunbscribers - Prefect Response</TITLE>
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
		strTemp = strInput.substring(strInput.length - 1);
	}

	while (strTemp == " ") 
	{
		strInput = strInput.substring(0, strInput.length - 1);

		if (strInput.length == 0) 
		{
			strTemp = "";
		} 
		else 
		{
			strTemp = strInput.substring(strInput.length - 1);
		}
	}

	if (strInput.length == 0) 
	{
		strTemp = "";
	} 
	else 
	{
		strTemp = strInput.substring(0, 1);
	}

	while (strTemp == " ") 
	{
		strInput = strInput.substring(1);

		if (strInput.length == 0) 
		{
			strTemp = "";
		} 
		else 
		{
			strTemp = strInput.substring(0, 1);
		}
	}

	return strInput;

}//close Trim Function

function Validate()
{
	var objName = document.Remove;
	var xxx;

	if (objName.tareaRemoveText.value == "")
	{
		alert("Please enter the Email Address(es) to remove")
		objName.tareaRemoveText.focus();
		return false;
	}

	return true;
}

//-->
</script>
</HEAD>
<body>
<div id="Wrapper"><div id="content">
<span class='BoxHeading'>
<input type="button" id="submit" name="submit" value="Click for helpful hints!" class="Button" onclick="Show();" onmouseover="document.getElementById('submit').style.fontWeight='bold';" onmouseout="document.getElementById('submit').style.fontWeight='normal';">
</span>
<div id="navBeta">
	<h2>Note</h2>
	<p>The User database is indexed by user number. Within each autoresponder campaign you can have records containing
	duplicate Email Addresses and names. When you remove a subscriber, you don't delete the user record. You actually just update the message number.</p>

	<p>253 - removed from via BounceHandler.php</p>
	<p>254 - removed from via remove.php - admin user remove</p>
	<p>255 - removed from via us.php - unsubscribe request</p>
</div>

<h2>Delete Subscribers from<br />
<?php print("<i>$CampaignDescription</i></h2>\n"); ?>
<form name="Remove" onSubmit="return(Validate());" method="post" action="RemoveAction.php" target='Monitor'>
<input type="hidden" name="arid" value="<?php echo $arid;?>">		
<p style="text-align:left;padding:1em;font-weight:normal"><i>Perfect Response</i> lets subscribers remove themselves 
automatically and securely. You also have the ability to delete subscribers manually. Simply add one 
email address per line in the text box below.</p>
<p style="text-align:left;padding:1em;font-weight:normal">Remember: It is okay to leave the <>: brackets around the addresses.</p>
<textarea name="tareaRemoveText" wrap="hard" rows="8" cols="55"></textarea><br />&nbsp;			
<input type='hidden' id='arid' name='arid' value="<?php echo $arid; ?>">
<table width="100%">
	<tr>
		<td align="right" width="15%"> 
			<input class='radiogroup' type="RADIO" name="Send_Removal_Email" id="Send_Removal_Email0" value="0" checked>
		</td>
		<td align="LEFT" width="85%"><label for="Send_Removal_Email0"><b>DO NOT</b> send an &quot;unsubscribe&quot;email notice</label></td>
	</tr>
	<tr> 
		<td align="right" width="15%"> 
			<input class='radiogroup' type="RADIO" name="Send_Removal_Email" id="Send_Removal_Email1" value="1">
		</td>
		<td align="LEFT" width="85%"><label for="Send_Removal_Email1"><b>Send</b> an &quot;unsubscribe&quot;email notice</label></td>
	</tr>
	<tr>
		<td colspan='2' style='text-align:center;vertical-align:middle;'>
				<br><input class='submit' type="submit" value="Remove" name="submit" onClick="this.value='Removing'"
	 			onMouseover="this.className='MouseOver'" onMouseout="this.className='submit'">&nbsp;
				
				<input class='cancel' type='button' value='Cancel' onClick='window.location.href="CampaignManager.php?arid=<?php echo $arid ?>&amp;cmd=1"' 
				onMouseover="this.className='MouseOver'" onMouseout="this.className='cancel'">
		</td>
	</tr>
  </table>
</form>
<?php
	JumpToCampaign($link, $arid); 
	ReferenceLinks($arid);
?>
</div></div> <!-- end of Wrapper -->

</BODY>
</HTML>
