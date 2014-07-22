<?php
/*

Copyright � Tony Ferlazzo 2004 
Perfect Response Version 4.0+ Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/
$user = $_COOKIE["UName"];
include("check1.php");
include("conn.php");
$arid=$_GET["arid"];
$WithinScript = "I know the arid";
include("settings.php");
if ($debugIt == 2)
	logMessage ("Add.php (".__LINE__.") ready to import \$arid: $arid");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<HTML>
<HEAD>
<TITLE>Add Subscribers - Perfect Response</TITLE>
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
	<h2>Add Subscribers Help</h2>
	<p><b>Important: </b><i>Perfect Response</i> has a built-in 
		email-address checking routine that verifies the 
		format of each email address. We recommend you add 
		no more than approximately 100 email addresses at a time.	
		Then wait for the checking routine to complete. Be patient. 
		This process could take a long time</p>	
		
	<p>If you have a relatively slow connection to the Internet, a busy server,
		or just a heavily loaded network then you may receive a time-out message when adding.
		If this happens, simply remember to add no more than 100 email addresses at a time.</p>
	
	<p>You can manually add one or more subscribers into <i>Perfect Response</i>.</b> There are 
		two ways you can add subscribers:</p>

				<li><b>Email addresses only:</b> In this case, simply 
					enter one email address per line in the 'Add' box 
					below. Example:<br>&nbsp;<br> 
				</li>

					<p>example@example.com<br>
					example@example.com<br>
					example@example.com<br>&nbsp;</p>

				<li><b>Email addresses and names:</b> In this case, names 
					and email addresses must be separated with the &quot;pipe&quot; 
					character (|). Example:<br>&nbsp;<br>
				</li>

 					<p>John|john@net1.com<br>
					Jane Doe|jane@3com.com<br>
					Jonathan L Smith|jls@ge.com</p>
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
<TABLE width='100%' BORDER=0 CELLPADDING='4' CELLSPACING='0' align="center">
	<TR>
		<td colspan='3' align="center" valign="top"> 
			<h2>Add Subscribers to
	<?php 
		print("<br /><span id='Grow'><i>$CampaignDescription</i></span></h2>");
	?>
		</td>
	</tr>
	<tr> 
		<td colspan='3' align="center"> 
			<form name="Add" method="post" action="AddAction.php" target='Monitor'>
			<h3>Enter Subscribers Here</h3>
		</td>
	</tr>
	<tr>
		<td style='width:100%;text-align:center;' colspan='3'>
			<textarea name="Emails_For_Action" wrap="soft" cols="60" rows="10"></textarea>

			<input type="hidden" name="hdnActionText" value="add">
			<input type="hidden" name="arid" <?php echo "value='$arid'"; ?>>
		</td>
	</tr>
	<tr>
		<td></td>
		<td align='left' colspan='3'>
			<h3><br>Select Welcome Message Options</h3>
		</td>
	</tr>
	<tr> 
		<td width="20%" align="right"> 
			<p><input class='radiogroup' type="RADIO" name="Auto_Sender" id="Auto_Sender0" value="0"></p>
		</td>
		<td align="LEFT"> 
			<p><label for="Auto_Sender0"><b>DO NOT</b> send the 'Welcome' message</label></p>
		</td>
		<td width="20%"</td>
	</tr>
	<tr> 
		<td align="right">
			<p><input class='radiogroup' type="RADIO" name="Auto_Sender" id="Auto_Sender1" value="1" checked></p>
		</td>
		<td align="LEFT">
			<p><label for="Auto_Sender1"><b>Send</b> the 'Welcome' message</label></p>
		</td>
		<td width="20%"</td>
	</tr>

	<tr>
		<td></td>
		<td align='left' colspan='3'>
			<h3>Select Email Campaign Option</h3>
		</td>
	</tr>
	<tr>
		<td align="right">
			<p><input class='radiogroup' type="RADIO" name="CurrentMessage" id="CurrentMessage999" value="999" ></p>
		</td>
		<td align="LEFT"><p><label for="CurrentMessage999"><b>DO NOT</b> begin their Email Campaign</label></p>
		</td>
		<td width="20%"</td>
	</tr>
	<tr> 
		<td align="right">
			<p><input class='radiogroup' type="RADIO" name="CurrentMessage" id="CurrentMessage1" value="1" checked></p>
		</td>
		<td align="LEFT"><p><label for="CurrentMessage1"><b>Begin</b> their Email Campaign.</label></p>
		</td>
		<td width="20%"</td>
	</tr>
	<tr>
		<td colspan='3' align='center'>
				<input class='submit' type="submit" value="Add" name="submit2" onClick="this.value='Adding'"
	 			onMouseover="this.className='MouseOver'" onMouseout="this.className='submit'">&nbsp;	
				
				<input class='cancel' type='button' value='Cancel' onClick='window.location.href="CampaignManager.php?arid=<?php echo $arid ?>&cmd=1"' 
				onMouseover="this.className='MouseOver'" onMouseout="this.className='cancel'">
		</td>
	</tr>
	</form>
</TABLE>
<?php
	JumpToCampaign($link, $arid); 
	ReferenceLinks($arid);
	print("</div></div>\n"); 

?>
</BODY>
</HTML>
