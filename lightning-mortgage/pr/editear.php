<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright � Tony Ferlazzo 2004
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/

include("check1.php");
Include("conn.php");
$ID=$_GET["arid"];
$arid=$_GET["arid"];
$WithinScript = "I know the arid";
Include("settings.php");
	$result = mysql_query("SELECT * FROM autoresponders where arid=$ID", $link);
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
<TITLE>Perfect Response Edit Subscribe/Unsubscribe Messages</TITLE>
<meta name="robots" content="NoIndex, NoFollow">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="./css/PerfectResponse.css">
<script language="JavaScript1.2">
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

function LLogout()
{
	if (confirm('Do you really want to logout?'))
	{
		top.location.href='logout.php';  //bust out of frames
		return (false);
	}

	return(true);
}

function deletear(id)
{
	if(confirm("Deleting this autoresponder will also delete all users and messages under it.\nAre you sure you want to delete this autoresponder?"))
	location.href="deletear.php?arid="+id;
}
//-->
</script>
</HEAD>
<body  onload="window.document.Campaign.consubject.focus();">

<div class="content">
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
<TABLE width='540' BORDER='0' CELLPADDING='4' CELLSPACING=0 align="center">
	<tr>
		<td align='center'>
			<h2>Email Campaign <i><?php echo $row->arname; ?></i></h2>
		</td>
	</TR>
	<TR>
		<TD>
			<form action="configupdate.php" name="Campaign" Method="post">
				<?php print ("<input type='hidden' name='arid' value='$arid'>"); ?>
				<h2 align="center">Edit Subscribe & Unsubscribe Messages</h2>
		</td>
	</tr>
	<tr>
		<td align="center"><p><label for="consubject">Welcome Subject</label></p></td>
	</tr>
	<tr align="center">
		<td>
			<p>
				<input name="consubject" id="consubject" type="text" value="<?php echo $row->consubject; ?>" size="60">
			</p>
		</td>
	</tr>
	<tr align="center">
		<td valign="top"><p><label for="conbody">Welcome Body</label>&nbsp;
			<?php
				$Length = strlen($row->conbody);
				print ("(Size: $Length characters)");
			?></p>
		</td>
	</tr>

	<tr align="center">
		<td valign="top">
			<p>
				<textarea name="conbody" id="conbody" rows="20" cols="65"><?php echo $row->conbody; ?></textarea>
			</p>
		</td>
	</tr>

	<tr align="center">
		<td>
			<p><label for="welconfsubject">'Subscription Confirmation' Subject</label></p>
		</td>
	</tr>
	<tr align="center">
		<td>
			<p>
				<input name="welconfsubject" id="welconfsubject" type="text" value="<?php echo $row->welconfsubject; ?>" size="60">
			</p>
		</td>
	</tr>
	<tr align="center">
		<td valign="top"><p><label for='welconfbody'>'Subscription Confirmation' Body</label>&nbsp;
			<?php
				$Length = strlen($row->welconfbody);
				print ("(Size: $Length characters)");
			?></p>
		</td>
	</tr>
	<tr align="center">
		<td valign="top">
			<p>
				<textarea name="welconfbody" id="welconfbody" rows="20" cols="65"><?php echo $row->welconfbody; ?></textarea>
			</p>
		</td>
	</tr>

	<tr align="center">
		<td colspan="2"><p><label for="remconsubject">'Removal Confirmation' Subject</label></p>
		</td>
	</tr>
	<tr align="center">
		<td colspan="2">
			<p>
				<input name="remconsubject" id="remconsubject" type="text" value="<?php echo $row->remconsubject; ?>" size="60">
			</p>
		</td>
	</tr>
	<tr align="center">
		<td colspan="2" valign="top"><p><label for="remconbody">'Removal Confirmation' Body</label>&nbsp;
			<?php
				$Length=strlen($row->remconbody);
				print ("(Size: $Length characters)");
			?></p>
		</td>
	</tr>
	<tr align="center">
		<td colspan="2" valign="top">
			<p>
				<textarea name="remconbody" id="remconbody" rows="20" cols="65"><?php echo $row->remconbody; ?></textarea>
			</p>
		</td>
	</tr>
<!--		This was for 2-step opt-out. But we always do a 1-step opt-out, as per the CAN-SPAN laws.
	<tr>
		<td align="left">In 2-step removal configurations, the 'Removal Notification' Message is sent after a subscriber is deleted from a email campaign list.</td>
	</tr>
	<tr align="center">
		<td><b>'Removal Notification' Subject:</b>
		</td>
	</tr>
	<tr align="center">
		<td>
			<p>
				<input name="remsubject" type="text" value="<?php echo $row->remsubject; ?>" size="60">
			</p>
		</td>
	</tr>
	<tr align="center">
		<td valign="top"><b>'Removal Notification' Body</b>
			<?php
				$Length = strlen($row->rembody);
				print ("(Size: $Length characters)");
			?>
		</td>
	</tr>
	<tr align="center">
		<td valign="top">
			<p>
				<textarea name="rembody" rows="20" cols="65"><?php echo $row->rembody; ?></textarea>
			</p>
		</td>
	</tr>
-->
	<tr>
		<td align="center">&nbsp;</td>
	</tr>
	<tr>
		<td align="center">
			<input class='submit' type="submit" name="Submit" value="Save" onClick="this.value='Now Saving ...'"
 			onMouseover="this.className='MouseOver'" onMouseout="this.className='submit'">&nbsp;
			<input class='cancel' type='button' value='Cancel' onClick='window.history.back()'
 			onMouseover="this.className='MouseOver'" onMouseout="this.className='cancel'">
		</td>
	</tr>
</TABLE>
</div>

<?php
	JumpToCampaign($link, $arid);
	print("</div>\n");
	ReferenceLinks($arid);
?>
</BODY>
</HTML>
