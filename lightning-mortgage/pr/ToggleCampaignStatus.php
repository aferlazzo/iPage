<?php
//echo "success";

$user	= $_COOKIE['UName'];
include("conn.php");
if (isset($_GET['arid']))
	$arid = $_GET['arid'];
else
	$arid = $_POST['arid'];

if($arid == "")
	echo("empty");
else
{
	$SQL = "select * from autoresponders where arid=$arid";
	$result_ar = mysql_query($SQL) or die("ToggleCampaignStatus (".__LINE__.") $SQL");
	$arrow = mysql_fetch_array($result_ar);

	if ($arrow['CampaignState'] == "Active") 
	{
		$strSQL  = "Update autoresponders set CampaignState='Suspended' where arid=$arid";
		$result = mysql_query($strSQL, $link); 
		if ($result == true) 
			echo("T|S|$arid");
		else
			echo("F|$arid");
	}
	elseif ($arrow['CampaignState'] == "Suspended") 
	{
		$strSQL  = "Update autoresponders set CampaignState='Active' where arid=$arid";
		$result = mysql_query($strSQL, $link); 
		if ($result == true) 
			echo("T|A|$arid");
		else
			echo("F|$arid");
	}
	else
		echo("F|$arid");
}
?>
