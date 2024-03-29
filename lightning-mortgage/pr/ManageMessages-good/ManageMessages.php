<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright � Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/

//
//	Manage Messages
//

//	Every campaign will have the following common messages:
//	seqno	subject
//	-------	---------
//    -4		Broadcast Message
//	  -3		Subscription Confirmation Message, in a 2-step opt-in
//	  -2		Welcome Message
//	  -1		Unsubscribe Acknowledgement Message
//	   0		Campaign Signature


include("check1.php");
Include("conn.php");
$arid=$_GET["arid"];
$WithinScript = "I know the arid";
include("settings.php");

	$MessageSelectResult = mysql_query("SELECT * FROM messages where arid=$arid order by seqno", $link); 
	$NumberOfMessages = mysql_num_rows($MessageSelectResult);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<HTML>
<HEAD>
<TITLE> Manage Messages - Perfect Response</TITLE>
<meta name="robots" content="NoIndex, NoFollow">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="./css/PerfectResponse.css">
<link rel="stylesheet" type="text/css" href="./css/ManageMessages.css">
<link rel="stylesheet" type="text/css" href="./css/niftyCorners.css">
<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery.ui.all.css" rel="stylesheet">
	<script type="text/javascript" src="http://www.google.com/jsapi"></script>
	<script type="text/javascript">
	google.load("jquery", "1.4.2");
	google.load("jqueryui", "1.8.2");
	</script>

<script type="text/javascript" src="./js/PerfectResponse.js"></script>
<script type="text/javascript" src="./js/nifty.js"></script>
<script type="text/javascript" src="./js/ManageMessages.js"></script>
<style type="text/css">

</style>

</HEAD>
<body>
<div id="Wrapper"><div id="content">
<span class="BoxHeading">
<input type="button" id="submit" name="submit" value="Click for helpful hints!" class="Button" onclick="Show();" onmouseover="document.getElementById('submit').style.fontWeight='bold';" onmouseout="document.getElementById('submit').style.fontWeight='normal';">
</span>
<div id="navBeta">
	<h2>Notes about Messages</h2>
	<p>Click on a message's subject line to edit it. You may also reorder messages using the
	'move up' and 'move down' commands. You can also delete email campaign messages here. </p>
	
	<p>There are 5 default message entries:</p>
	<p>The <i>Confirmation</i> message will be sent out immediately to confirm the subscription
	in <b>2-step</b> opt-in campaigns.</p>

	<p>The <i>Welcome</i> message is sent out immediately to all subscribers. For 2-step opt-in
	campaigns, the message will be sent out only after the subscriber confirms the subscription request.</p>
	
	<p>The <i>Unsubscribe</i> message is sent out immediately after a subscriber requests subscription termination
	or when manually deleted from the subscription list.</p>
	
	<p>The <i>Campaign Messages Signature</i> is text that is appended to every message.
	This would normally consist of your name and contact information. You might want to include special offers 
	in a 'P.S.' too.</p>
	<p>The <i>Immediate Broadcast Message</i>that will get sent without delay, when you are ready to send it.</p>
	<p>All other messages are sent out after a specified delay.</p>
</div>


<?php 
	print("<h2>Manage Messages</h2><h1 id='Grow'><i>$CampaignDescription</i></h1>\n");

	if($NumberOfMessages > 0)
	{
		print("<script type='text/javascript'>arid='$arid';</script>\n"); //put the arid in a javascript variable
		
		//fill javascript arrays with values from php/MySQL
		for($count=0;$count<$NumberOfMessages;$count++)
		{
			mysql_data_seek($MessageSelectResult, $count);
			$row = mysql_fetch_object($MessageSelectResult);

			print("<script type='text/javascript'>\n");
			print("midArray[$count]	= $row->mid; seqArray[$count]	= $row->seqno; " .
				  "subjectArray[$count]	= \"$row->subject\"; delayArray[$count] = $row->delay;\n");
			
			//this is for debugging only to display values in console.log
			//print("console.log('seqArray[$count]: |' + seqArray[$count] + '| midArray[$count]: |' + midArray[$count] + '| delayArray[$count]: |' + delayArray[$count] + '| subjectArray[$count]: |' + subjectArray[$count] +'|');\n");
			print("</script>\n"); 
		}
?>	

<script type='text/javascript'>
	WriteMessageTable(arid, seqArray, midArray, subjectArray, delayArray);
</script>			
<!-- - -Select All, Select None, Delete Selected- - -->
	<div style='clear:left;width:390px;height:30px;margin:30px auto 0;'><form action='#'>
		<div style='float:left;margin:0 10px;'>
		<input class='submit' type='submit' name='chkA' value='Select All' onclick='checkAll(midArray.length, "checked", seqArray);return(false);'
		onMouseover="this.className='MouseOver'" onMouseout="this.className='submit'" title='Select *ALL* messages'>
		</div>

		<div style='float:left;margin:0 10px;'>
		<input class='cancel' type='submit' name='chkN' value='Select None' onclick='checkAll(midArray.length, "", seqArray);return(false);'
		onMouseover="this.className='MouseOver'" onMouseout="this.className='cancel'" title='Deselect message'>
		</div>
		
		<div style='float:left;margin:0 10px;'>
		<input class='submit' type='button' name='DeleteMsg' value='Delete Selected' onClick="deleteChecked(arid, midArray.length, midArray, seqArray);"
		onMouseover="this.className='MouseOver'" onMouseout="this.className='submit'"></form></div>
	</div>
<?php
	}
	else  // if no messages exist
	{
?>
	<div style='height=30px;text-align:right;'>
	&nbsp;<select size='1' disabled name='xcmd' onChange='submit();'>
	<option selected value='0'>Select One</option></select>  &lt;No Messages&gt;</div>
<?php
	}
?>
<!-- - -Commit, Cancel Sort Buttons- - -->
<!--
	<div style='clear:left;width:225px;height:30px;margin:30px auto 0;'>
		<div style='float:left;margin:0 10px;'><form action='sortMessages.php' target='Monitor'>
		<input type='hidden' name='arid' value='<?php echo $arid;?>'>
		<input class='submit' type='submit' name='sortMsg' value='Sort Ok' 
		onMouseover="this.className='MouseOver'" onMouseout="this.className='submit'" title='Rewrites message send sequence'>
		</form></div>

		<div style='float:left;margin:0 10px;'><form action='#'>
		<input class='cancel' type='button' name='cancelSort' value='Cancel Sort' onClick='javascript:window.location.reload()'
		onMouseover="this.className='MouseOver'" onMouseout="this.className='cancel'" title='Cancels resequencing of messages'>
		</form></div>
	</div>
-->	

<!-- - -Add, Instant Test, Campaign Buttons- - -->

	<div style='clear:left;width:320px;height:30px;margin:30px auto 0;'>
		<div style='float:left;margin:0 10px;'><form action='AddMessage.php' target='Monitor'>
		<input type='hidden' name='arid' value='<?php echo $arid;?>'>
		<input class='submit' type='submit' name='AddMsg' value='Add' onClick='this.value="Adding"'
		onMouseover="this.className='MouseOver'" onMouseout="this.className='submit'" title='Add another message'>
		</form></div>

		<div style='float:left;margin:0 10px;'><form action='InstantTest.php'>
		<input type='hidden' name='arid' value='<?php echo $arid;?>'>
		<input class='cancel' type='submit' name='OtherT' value='Instant Test'  onClick="this.value='Testing'"
		onMouseover="this.className='MouseOver'" onMouseout="this.className='cancel'" title='Send an instant test of one or all messages'>
		</form></div>

		<div style='float:left;margin:0 10px;'><form action='CampaignManager.php'>
		<input type='hidden' name='arid' value='<?php echo $arid;?>'>
		<input class='submit' type='submit' name='OtherT' value='Campaign' onClick="this.value='Campaign'"
		onMouseover="this.className='MouseOver'" onMouseout="this.className='submit'" title='Do other campaign tasks'>
		</form></div>
	</div>

<?php
	JumpToCampaign($link, $arid); 
	ReferenceLinks($arid);
?>
</div></div> <!-- end of Wrapper -->
<!--
<div class="demo"> 
	
<div id="draggable2" class="ui-widget-content"> 
	<p>Drag me to my target</p> 
</div> 
 
<div id="droppable2" class="ui-widget-header"> 
	<p>Drop here</p> 
</div> 
</div>
-->
</BODY>
</HTML>
