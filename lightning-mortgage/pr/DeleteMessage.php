<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright © Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

By default only one message at a time is  deleted. The arid (the campaign number, copied to $arid) and 
the sequence number of the message to be deleted (copied to $curseq) are passed to this script. The 
message ID of the message to be deleted is copied to $midsToDelete[0].

A sequence number ($curseq) that is negative signals that instead of one message, multiple message 
IDs are being passed in the form of ' m0=' to 'm999=' arguments. These values are placed in the array
$midsToDelete.

If the current sequence is negative, it also is understood that the absolute value of this value
is the number of messages being deleted, $NumberOfMessages.

*/

include("check1.php");
Include("conn.php");

$arid=$_GET[arid];
$curseq=$_GET[curseq];
$NumberOfMessages = 1;

if($curseq < 0)
{
	$NumberOfMessages = $curseq * -1;
	//print("DeleteMessage.php (".__LINE__.") will delete $NumberOfMessages messages. ");
	for($i=0; $i < $NumberOfMessages; $i++)
	{
		$midsToDelete[$i] = $_GET['m'.$i];
		//echo $mid[$i].' ';
	}
	//die(" are the message IDs");
	
}
else
	$midsToDelete [0] =$_GET[mid];

// first list the messages in the campaign. Then delete the message. Then reorder the messages so there are no gaps
//die("DeleteMessage.php |$arid|$curseq|$midsToDelete[0]|");
$ListQuery = "select * from messages where arid=$arid order by seqno";
$ResultMsgs = mysql_query($ListQuery) or die("DeleteMessage.php (".__LINE__.") arid |$arid| error: $msgSQL");	
$NumberOfExistingMessages = mysql_num_rows($ResultMsgs);
$DeletedSquenceNumber = $NumberOfExistingMessages + 99; //this keeps msgs from being deleted until the one we want is found
	
//print("<p>DeleteMessage.php (".__LINE__.") There are $NumberOfExistingMessages Messages in campaign:</p>");

// Now we have the Number of messages to delete in $NumberOfMessages and
// the mid(s) in $midsToDelete


for ($mcount = 0; $mcount < $NumberOfExistingMessages; $mcount++)
{
	mysql_data_seek($ResultMsgs, $mcount);
	$row	 = mysql_fetch_object($ResultMsgs);
	$subject = addslashes($row->subject);
	$mid	 = $row->mid;
	$seqno	 = $row->seqno;
	//console.log("DeleteMessage.php : Sequence: $seqno mid: $mid Subject: $subject<br />");
	
	for($i=0;$i < $NumberOfMessages;$i++)
	{
		if($midsToDelete[$i] == $mid)
		{
			$DeletedSquenceNumber = $seqno;
			// Now delete the msg
			$DeleteQuery = "delete FROM messages where mid=$midsToDelete[$i] and arid=$arid limit 1";
			//print("<p>DeleteMessage.php (".__LINE__.") Deleting message using query '$DeleteQuery'</p>"); 
			$result = mysql_query($DeleteQuery, $link);	
			if ($result == false)
				die("<p>DeleteMessage.php (".__LINE__.") Error on deleting message ($DelectQuery):<br />".mysql_error($link));
		}
		else
		{	
			// Then reorder the messages coming after the one you deleted so there are no gaps
			if (($seqno > 1) && ($seqno > $DeletedSquenceNumber))
			{	
				//print("<p>DeleteMessage.php (".__LINE__.") message: $mid seqno: $seqno is after DeletedSquenceNumber, so update the seqno</p>"); 
				$seqno--;
				$UpdateSQL = "update messages set seqno=$seqno where mid=$mid limit 1";
				$UpdateResult = mysql_query($UpdateSQL, $link);
				if($UpdateResult == false)
					die("<p>DeleteMessage.php (".__LINE__.") Error on ($UpdateSQL):<br />".mysql_error($link));
			}
		}
	}
}

//now check messages
$ListQuery = "select * from messages where arid=$arid order by seqno";
$ResultMsgs = mysql_query($ListQuery) or die("DeleteMessage.php (".__LINE__.") error: $msgSQL");	
$NumberOfExistingMessages = mysql_num_rows($ResultMsgs);

//print("<p>DeleteMessage.php (".__LINE__.") $NumberOfExistingMessages Messages are *now* in campaign:</p>");
for ($mcount = 0; $mcount < $NumberOfExistingMessages; $mcount++)
{
	mysql_data_seek($ResultMsgs, $mcount);
	$row	 = mysql_fetch_object($ResultMsgs);
	$subject = addslashes($row->subject);
	$mid	 = $row->mid;
	$seqno	 = $row->seqno;
	//print("Sequence: $seqno mid: $mid Subject: $subject<br />");
}
echo "1";
//print ("<script type='text/javascript'>\ntop.frames['Main'].location.href='ManageMessages.php?arid=$arid';\n</script>\n");
?>
