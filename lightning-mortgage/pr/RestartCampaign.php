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
include("settings.php");

$maxSQL = "select max(seqno) as maxseq from messages where arid=$arid";
$result_max = mysql_query($maxSQL) or die("$maxSQL");
mysql_data_seek($result_max, 0);
$maxrow = mysql_fetch_object($result_max);	
$maxmsg=$maxrow->maxseq;

$SQL_Statement = "select count(*) as c from users where (confirmed='Y' AND arid=$arid AND currentmsg<253)"; 
$result = mysql_query($SQL_Statement) or die("resetar.php (".__LINE__.") died: $SQL_Statement");
$row =  mysql_fetch_object($result);
$Everyone = $row->c;

$SQL_Statement = "select count(*) as c from users where (confirmed='Y' AND currentmsg>=$maxmsg AND arid=$arid AND currentmsg<253)"; 
$result = mysql_query($SQL_Statement) or die("resetar.php (".__LINE__.") died: $SQL_Statement");
$row =  mysql_fetch_object($result);
$Finished = $row->c;

$SQL_Statement = "select count(*) as c from users where confirmed='Y' AND currentmsg<$maxmsg AND arid=$arid AND currentmsg<253"; 
$result = mysql_query($SQL_Statement) or die("resetar.php (".__LINE__.") died: $SQL_Statement");
$row =  mysql_fetch_object($result);
$Current = $row->c;


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<HTML>
<HEAD>
<TITLE>Perfect Response Restart Mail Campaign</TITLE>
<meta name="robots" content="NoIndex, NoFollow">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="./css/PerfectResponse.css">
<link rel="stylesheet" type="text/css" href="./css/niftyCorners.css">
<script type="text/javascript" src="./js/nifty.js"></script>
<script type="text/javascript">
function LLogout()
{
	if (confirm('Do you really want to logout?'))
	{
		top.location.href='logout.php';  //bust out of frames
		return (false);
	}
	
	return(true);
}
function Show()
{
//alert(document.getElementById('navBeta').style.display);
if (document.getElementById('navBeta').style.display == '')
{
document.getElementById('navBeta').style.display='block';
document.getElementById('submit').value='Click to hide hints!';
document.getElementById('submit').style.borderWidth='2px';
document.getElementById('submit').style.borderStyle='solid';
document.getElementById('submit').style.borderColor='#ffffff';
document.getElementById('submit').style.backgroundColor='#939';
//document.getElementById('submit').focus();
}
else
{
document.getElementById('navBeta').style.display='';
document.getElementById('submit').value='Click for helpful hints!';
document.getElementById('submit').style.borderWidth='2px';
document.getElementById('submit').style.borderStyle='solid';
document.getElementById('submit').style.borderColor='#ffffff';
document.getElementById('submit').style.backgroundColor='#004a8d';
//document.getElementById('submit').focus();
}
}

function manar(id)
{
	location.href="EditCampaign.php?arid="+id;
}
<?php
print("function CheckIt()\n");
print("{\n");
print("  if(document.frmresetar.reset[0].checked)\n");
print("  {\n");
print("		Count=$Everyone;\n");
//print("		alert('reset: 0 checked: '+Count);\n");
print("  }\n");

print("  if(document.frmresetar.reset[1].checked)\n");
print("  {\n");
print("		Count=$Finished;\n");
//print("		alert('reset: 1 checked: '+Count);\n");
print("  }\n");

print("  if(document.frmresetar.reset[2].checked)\n");
print("  {\n");
print("		Count=$Current;\n");
//print("		alert('reset: 2 checked: '+Count);\n");
print("  }\n");

print("if (Count == 0) {\n");
print("alert('No subscribers selected'); return(false);}");
print("return(confirm('Are you sure you want to restart '+Count+' subscribers in this campaign?'));");
print("}\n");
?>


//-------------------------------
//
//To do rounded corners on the <div id=' contents':
//
//(link rel="stylesheet" type="text/css" href="./css/niftyCorners.css")
//(script type="text/javascript" src="./js/nifty.js"></script)
//
//The function NiftyCheck performs a check for DOM support. If the test has passed,
//the Rounded function is called, that is now the only one function that you should 
//call to get nifty corners. It accepts five parameters, that are in order:
//
//   1. A CSS selector that indicates on wich elements apply the function
//   2. A string that indicates which corners to round: all, top, bottom, etc.
//   3. Outer color of the rounded corners
//   4. Inner color of the rounded corners
//   5. An optional fifth parameter, that will contain the options for Nifty Corners
//
//-------------------------------
window.onload=function(){
if(!NiftyCheck())
    return;
Rounded("div.Wrapper","all","#FFE4C4","#48D1CC","border #000080");
}
</script>
</HEAD>
<body>
<div class="Wrapper"><div class="content" style='height:430px;'>
<span class="BoxHeading">
<input type="button" id="submit" name="submit" value="Click for helpful hints!" class="Button" onclick="Show();" onmouseover="document.getElementById('submit').style.fontWeight='bold';" onmouseout="document.getElementById('submit').style.fontWeight='normal';">
</span>
<div id="navBeta">
	<h2>Did You Know?</h2>
	<p>	<b>Important:</b> <i>Perfect Response</i>&#153; is a great system.</p>
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
<TABLE BORDER='0' CELLPADDING='4' CELLSPACING=0 align="center">
	<TR> 
		<TD align='center' colspan='2'> 
			<h2>Restart Campaign Messages to
	<?php 
		print("<br /><span id='Grow'><i>$CampaignDescription</i></span></h2>");
	?>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td valign='middle'>
			<p align="left">It is a good idea to restart a campaign if you update or change the messages.</p>
		</td>
	</tr>
	<tr> 
		<td width="15%" align='right'>
			<?php print("<form name='frmresetar' method='post' onSubmit='return(CheckIt());'"); ?> 
				action='RestartCampaignAction.php' target='Monitor'>			
		<?php print("<input type='hidden' name='arid' id='arid' value='$arid'>"); ?>
			<p><input class='radiogroup' type="RADIO" name="reset" id="reset0" value="0" checked></p>
		</td>
		<td width="85%" align="LEFT">
			<p><label for="reset0" style='font-weight:normal;line-height:12pt;padding-right:30px;'>Restart all subscribers. Everyone (all <?php echo "$Everyone"; ?> subscribers) will start receiving the campaign from the beginning.</label></p>
		</td>
	</tr>

	<tr> 
		<td width="15%" align='right'>
			<p><input class='radiogroup'  type="RADIO" name="reset" id="reset1" value="1"></p>
		</td>
		<td align="LEFT">
			<p><label for="reset1" style='font-weight:normal;line-height:12pt;padding-right:30px;'>Restart only those subscribers (<?php echo "$Finished"; ?> subscribers) who have completed the campaign.</label></p>
		</td>
	</tr>

	<tr> 
		<td width="15%" align='right'>
			<p><input type="RADIO" class='radiogroup' name="reset" id="reset2" value="2"></p>
		</td>
		<td align="LEFT"> 
			<p><label for="reset2" style='font-weight:normal;line-height:12pt;padding-right:30px;'>Restart only subscribers (<?php echo "$Current"; ?> subscribers) who are currently receiving the campaign.</label></p>
		</td>
	</tr>
	<tr>
		<td colspan='2'>
			<p align="center">
				<input class='submit' type="submit" value="Restart" name="submit" 
	 			onMouseover="this.className='MouseOver'" onMouseout="this.className='submit'">&nbsp;
			<input class='cancel' type='button' value='Cancel' onClick='window.location.href="CampaignManager.php?arid=<?php echo $arid ?>&cmd=1"' 
 			onMouseover="this.className='MouseOver'" onMouseout="this.className='cancel'">
			</p>
			</form>
		</td>
	</tr>
</table>
<?php
	JumpToCampaign($link, $arid); 
	ReferenceLinks($arid);
	print("</div>\n"); 
?>
</div> <!-- end of Wrapper -->
</BODY>
</HTML>
