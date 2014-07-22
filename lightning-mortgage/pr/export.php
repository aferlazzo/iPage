<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright © Tony Ferlazzo 2004
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/
$user = $_COOKIE["UName"];
include("check1.php");
include("conn.php");
$arid=$_GET["arid"];
$cmd=$_GET["cmd"];
$WithinScript = "I know the arid";
Include("settings.php");


$result = mysql_query("SELECT * FROM users where arid=$arid and confirmed='Y' and currentmsg<253 order by fname", $link);
$num_rows = mysql_num_rows($result);

if ($num_rows < 1)
{
	logMessage ("export (".__LINE__.") \$CampaignDescription '$CampaignDescription' no subscribers found");
	echo "<br><br>There appears to be <b>No Subcribers</b> for '$CampaignDescription'.<br>";
	exit;
}


$CampaignName=str_replace("'", "", $CampaignDescription);
$efilename=str_replace(" ", "_","export/$CampaignName.txt"); // replace the campaign name spaces with underscores

if ($debugIt > 0)
	logMessage ("export (".__LINE__.") \$efilename '$efilename' found '$num_rows' subscribers");

//Try setting permissions for re-write

if (file_exists("export")==false) //first check that the 'export' directory exists. If not then create it
	mkdir(export, 0744);

//chdir("export");

if (file_exists($efilename)==true)
{
	logMessage ("export (".__LINE__.") file $efilename EXISTS. Making writable.");
	@chmod ("$efilename", 0777);
	@touch  ("$efilename");
	@chmod ("$efilename", 0777);
}
else
	logMessage ("export (".__LINE__.") file $efilename DOES NOT exist. Never exported, perhaps.");

print("<h2>Preparing Export</h2>");
$FILE= fopen($efilename,"w+");
if($num_rows>0)
{
	mysql_data_seek($result, 0);
	$row = mysql_fetch_object($result);
	$SettingStr  = "Export of '$CampaignDescription' ($num_rows subscribers) As of ".date('l F j, Y g:i A',time())."\n";
	$SettingStr .= "6 fields, separated by the '|' character: Subscriber Name, Email Address, User Defined fields 1-4\n\n";
	for($count=0;$count<$num_rows;$count++)
	{
		mysql_data_seek($result, $count);
		$row = mysql_fetch_object($result);
		$SettingStr=$SettingStr."|$row->fname|$row->email";
		$SettingStr=$SettingStr."|$row->UserDefined1";
		$SettingStr=$SettingStr."|$row->UserDefined2";
		$SettingStr=$SettingStr."|$row->UserDefined3";
		$SettingStr=$SettingStr."|$row->UserDefined4|\n";
	}

	$SettingStr=$SettingStr."\nEnd of Export report.\n";
}

fwrite($FILE,$SettingStr);
fclose($FILE);
@chmod ("$efilename", 0755); //make read-only


//now display file
print("<script type='text/javascript'>\n");
print("location.href='$efilename'\n");
print("</script>\n");

/*
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<HTML>
<HEAD>
<TITLE>Perfect Response Display or Export</TITLE>
<meta name="robots" content="NoIndex, NoFollow">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="./css/PerfectResponse.css">
<script type="text/javascript">
<!--
function LLogout()
{
	if (confirm('Do you really want to logout?'))
	{
		top.location.href='logout.php';  //bust out of frames
		return (false);
	}

	return(true);
}
var Size=125;
function GrowIt()
{
Size=Size+10;
var I=Size+'%';
document.getElementById('Grow').style.fontSize=I;
if(Size>=200)
 clearInterval(timer);
}
function SSS()
{
//timer=setInterval('GrowIt()', 20);
}
//-->
</script>

</HEAD>
<body onload="SSS();window.document.Export.Display.focus();">
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

<h2>Export Subscribers</h2>
<p><?php echo $num_rows; ?> subscribers are in this email campaign.<br>&nbsp;</p>
<div style='margin:0 auto;text-align:center;width:58%;'>
<?php
print ("<div style='float:left;padding:0 1em;'><form name='Export' action='DisplaySubscribers.php'>");
print ("<input type='hidden' name='arid' value='$arid'>");
print ("<input class='submit' type='submit' name='Display' value='Display' onClick=\"this.value='Displaying'\" ");
print ("onMouseover=\"this.className='MouseOver'\" onMouseout=\"this.className='submit'\">");
print ("</form></div><div style='float:left;padding:0 1em;'><form action='$efilename'>");
print ("<input class='cancel' type='submit' name='Export' value='Export' onClick=\"this.value='Exporting';\" ");
print ("onMouseover=\"this.className='MouseOver'\" onMouseout=\"this.className='cancel'\">");
print ("</form></div><div style='float:left;padding:0 1em;'><form>");
?>
</form></div><br style="clear:left;"></div>


<?php
	JumpToCampaign($link, $arid);
	print("</div>\n");
	ReferenceLinks($arid);
?>
</BODY>
</HTML>
*/
?>
