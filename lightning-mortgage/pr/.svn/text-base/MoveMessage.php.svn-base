<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright © Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/

include("check1.php");
include("conn.php");
$arid=$_GET[arid];
$Direction=$_GET[direction];
$CurrentSequence=$_GET[curseq];
$PreviousSequence = $CurrentSequence - 1;
$NextSequence = $CurrentSequence + 1;

print("<p>MoveMessage (".__LINE__.")  $Direction - $CurrentSequence</p>");
	if($Direction==3) //up: put previous msg in placeholder seqno -99
	{
		$sql="Update messages set seqno=-99 where seqno=$PreviousSequence and arid=$arid";
		$result = mysql_query($sql, $link); 
		if ($result == false)
			die("<p>MoveMessage (".__LINE__.") Error on ($sql):<br />".mysql_error($link));
		
		$sql="Update messages set seqno=$PreviousSequence where seqno=$CurrentSequence and arid=$arid";
		$result = mysql_query($sql, $link); 
		if ($result == false)
			die("<p>MoveMessage (".__LINE__.") Error on ($sql):<br />".mysql_error($link));
		
		$sql="Update messages set seqno=$CurrentSequence where seqno=-99 and arid=$arid";
		$result = mysql_query($sql, $link); 
		if ($result == false)
			die("<p>MoveMessage (".__LINE__.") Error on ($sql):<br />".mysql_error($link));
	}
print("<p>MoveMessage (".__LINE__.")  $Direction - $CurrentSequence</p>");
	
	if($Direction==4) // down
	{
		$sql="Update messages set seqno=-99 where seqno=$NextSequence and arid=$arid";
		$result = mysql_query($sql, $link); 
		if ($result == false)
			die("<p>MoveMessage (".__LINE__.") Error on ($sql):<br />".mysql_error($link));

		$sql="Update messages set seqno=$NextSequence where seqno=$CurrentSequence and arid=$arid";
		$result = mysql_query($sql, $link); 
		if ($result == false)
			die("<p>MoveMessage (".__LINE__.") Error on ($sql):<br />".mysql_error($link));

		$sql="Update messages set seqno=$CurrentSequence where seqno=-99 and arid=$arid";
		$result = mysql_query($sql, $link); 
		if ($result == false)
			die("<p>MoveMessage (".__LINE__.") Error on ($sql):<br />".mysql_error($link));
	}

	print ("<script type='text/javascript'>\ntop.frames['Main'].location.href='ManageMessages.php?arid=$arid';\n</script>\n");
?>
