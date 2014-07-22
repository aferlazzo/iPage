<?php 
// This  is the Ajax SentMonitor server code.
// What it does: it first checks to see if a row matching the arid, email, and  seqno exists
// in the messagesSent table.

// If a row exists, it sends back a string with the letter 'T' and the report row that was passed to the server.
// If a row cannot be found, it computes the amount of time from the passed variable TimeToSendMsg and the current time.
// Then it sends back a string made up of the characters 'F|' and the string of the computed time to wait before a send will 
// occur by the mailout. script.

include ("conn.php");
if (isset($_GET['arid'])) // if variables on uri (for testing) use them
{
$arid  			= $_GET['arid'];
$Email 			= $_GET['email'];
$seqno 			= $_GET['seqno'];
$row   			= $_GET['row'];
$TimeToSendMsg  = $_GET['TimeToSendMsg'];
}
else
{
$arid  			= $_POST['arid'];
$Email			= $_POST['email'];
$seqno 			= $_POST['seqno'];
$row   			= $_POST['row'];
$TimeToSendMsg	= $_POST['TimeToSendMsg'];
}
set_time_limit(0);			// don't time-out
//ignore_user_abort (TRUE);	//don't abort script even if the user disconnects. Just continue monitoring mail delivery.


function TellIt($Msg)
{
	print("<script type='text/javascript'>\n");
	print("alert(\"$Msg\");\n");
	print("</script>\n");			
}

//  update the 'Sent In' time for the subscriber
function UpdateSentIn($TimeToSendMsg)
{
//	Format the current Date & Time		
	$cDateH = date("H");
	$cDateI = date('i');
	$cDateS = date('s');  
	$cDateM = date('m');
	$cDateD = date('d');
	$cDateY = date('y');
			
	$CurrentTime = mktime($cDateH, $cDateI, $cDateS, $cDateM, $cDateD, $cDateY);
	$Offset = $TimeToSendMsg - $CurrentTime;
			
	if ($Offset < 1)
		$SentIn = "<b>Past Due</b>\n";
	else
	{
		$days = floor($Offset/85399);//a day in seconds
		$Offset = $Offset % 85399;
		$hours = floor($Offset/3600);//an hour in seconds
		$Offset = $Offset % 3600;
		$minutes = floor($Offset/60);//a minute in seconds
		$SentIn = sprintf("%u d %02u:%02u", $days, $hours, $minutes);
	}
	return($SentIn);	
}
		 
//----------------------------------------
	//$SentDate=date("YmdHmiu");
	
	$Query  = "select * from messagesSent where email='$email' and seqno=$seqno and arid=$arid";
	$result = mysql_query($Query) or die("SentMonitor.php died with mysql_query: $Query");
	$xxx = mysql_num_rows($result);

	if($xxx < 1)  // if $xxx = 0, then no match found. Update the amount of time till sent
	{
		$SentIn = UpdateSentIn($TimeToSendMsg);
		echo("F|$row|$SentIn");
	}	
	else
		echo("T$row"); //we must return the report row number that matched
?>
