<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright � Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/
?>
<?php
include("check1.php");
include("conn.php");
$arid=$_GET["arid"];
$WithinScript = "I know the arid";
include("settings.php");
include("removesettings.php");
if($Is_Custom==1)
$GoTo=$RedirectPage;
else
$GoTo="$Installation_Path/thankyou.php";

$result = mysql_query("SELECT jsmsg FROM autoresponders where arid=$arid", $link); 
$num_rows = mysql_num_rows($result); 	
mysql_data_seek($result, 0);
$row = mysql_fetch_object($result);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<HTML>
<HEAD>
<TITLE>Perfect Response HTML Generator</TITLE>
<meta name="robots" content="NoIndex, NoFollow">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="./css/PerfectResponse.css">
<link rel="stylesheet" type="text/css" href="./css/niftyCorners.css">
<script type="text/javascript" src="./js/PerfectResponse.js"></script>
<script type="text/javascript" src="./js/nifty.js"></script>
</HEAD>
<body>
<div id="Wrapper"><div id="content">
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
<TABLE width='100%' BORDER='0' CELLPADDING='4' CELLSPACING=0 align="center">
	<TR> 
		<TD WIDTH=300></TD>
		<TD WIDTH=322></TD>
	</TR>
	<tr>
		<td colspan='2' align='center'>
<?php print("<h2 id='Grow'><i>$CampaignDescription</i></h2>"); ?>
		</td>
	</TR>
	<tr>
		<td colspan='2' align='center'>
			<h3>HTML Code for Subscribe/Unsubscribe Forms</h3>
		</td>
	</tr>
	
	<TR>
		<TD colspan='2' style='text-align:left;'>
			<p>You can use this method 
			of modifying your web pages to solicit and accept subscriptions to email 
			campaigns and to accept unsubscribe requests.
		</td>
	</tr>

	<tr> 
		<td colspan='2' style='text-align:left;'>
			<p><b>Create Opt-in Form</b> Copy and paste this code anywhere on your html page.</td></p>
	</tr>
	<tr> 
		<td colspan='2' align='center'>
			<textarea name="form" cols="60" rows="10">
&lt;Form Action="<? echo $Installation_Path ?>/optin.php" Method="post"&gt;
&lt;Input type="Hidden" name="arid" value="<? echo $arid ?>"&gt;
&lt;Input type="Hidden" name="redirect" value="<? echo $GoTo ?>"&gt;
&lt;B&gt;Name&lt;/B&gt;:	&lt;Input Type="Text" name="Full_Name">&lt;br&gt;
&lt;B&gt;Email&lt;/B&gt;:	&lt;Input Type="Text" Name="Email_Address"&gt;&lt;br>&lt;br&gt;
&lt;Input Type="Submit" Value="Sign Me Up!"&gt;
&lt;/Form&gt;</textarea>
		</td>
	</tr>

	<tr> 
		<td colspan='2' style='text-align:left;'>
			<p><b>To create a Removal/Unsubscribe Form</b> Copy and paste this code anywhere on your html page.<p>
		</td>
	</tr>
	<tr> 
		<td colspan='2' align='center'>
			<textarea name="form" cols="60" rows="8">&lt;Form Action=&quot;<? echo $Installation_Path ?>/us.php&quot; Method=&quot;post&quot;&gt;
&lt;Input type=&quot;Hidden&quot; name=&quot;arid&quot; value=&quot;<? echo $arid; ?>&quot;&gt;
&lt;Input type=&quot;Hidden&quot; name=&quot;ra&quot; value=&quot;<? echo $arid; ?>&quot;&gt;
&lt;B&gt;Email:&lt;/B&gt;	&lt;Input Type=&quot;Text&quot; Name=&quot;RE&quot;&gt;&lt;br&gt;&lt;br&gt;
&lt;Input Type=&quot;Submit&quot; Value=&quot;Unsubscribe&quot;&gt;&lt;br&gt;
&lt;/Form&gt;</textarea>
		</td>
	</tr>

	<tr> 
		<td colspan='2' style='text-align:left;'>
			<p><b>For A single line to add to email body</b> Copy and paste this code anywhere on your html page.<p>
		</td>
	</tr>
	<tr> 
		<td colspan='2' align='center'>
			<textarea name="form" cols="60" rows="2"><? echo $Removal_Link_Text ?>%EmailAddress%</textarea>
		</td>
	</tr>

	<tr>
		<td colspan='2' align="center"> 
	<?php
			print ("<form action='CampaignManager.php' method='get'>");
			print ("<input type='hidden' name='arid' value='$arid'>");
			print ("<input class='cancel' type='submit' name='OtherT' value='Continue' ");
			print ("onMouseover=\"this.className='MouseOver'\" onMouseout=\"this.className='cancel'\">");
		?>
		</td></form>
	</tr>
</table>
<?php
	JumpToCampaign($link, $arid); 
	ReferenceLinks($arid);
?>
</div></div> <!-- end of Wrapper -->

</BODY>
</HTML>
