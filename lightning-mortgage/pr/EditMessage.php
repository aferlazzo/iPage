<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright © Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/

include("check1.php");
Include("conn.php");

	$arid	= $_GET[arid];
	$mid	= $_GET[mid];
	$curseq	= $_GET[curseq];
	//$Aname	= $_POST[Aname];

$WithinScript = "I know the arid";
include("settings.php");
	
//print("editmsg (".__LINE__.") arid: $arid curseq: $curseq cmd: $cmd");

$result = mysql_query("SELECT * FROM autoresponders where arid=$arid", $link); 
mysql_data_seek($result, 0);
$row = mysql_fetch_object($result);	
$CampaignDescription = $row->ardescription;

$result = mysql_query("SELECT * FROM messages where mid=$mid and arid=$arid", $link); 
mysql_data_seek($result, 0);
$row = mysql_fetch_object($result);	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<HTML>
<HEAD>
<TITLE>Perfect Response Edit Message</TITLE>
<meta name="robots" content="NoIndex, NoFollow">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="./css/PerfectResponse.css">
<link rel="stylesheet" type="text/css" href="./css/niftyCorners.css">
<style type="text/css">
form {margin:0; padding:0;}
</style>
<script type="text/javascript" src="./js/PerfectResponse.js"></script>
<script type="text/javascript" src="./js/nifty.js"></script>
<script type="text/javascript" src="../fckeditor/fckeditor.js"></script>
<script type="text/javascript">
<!--//
function ListStatus(id)
{
	
	var msg = "nodeName: "+currentElement.nodeName+"\n";

	msg += "nodeType: "+currentElement.nodeType+"\n";
	msg += "nodeValue: "+currentElement.nodeValue+"\n";
	alert (msg);
}

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

function Validate()
{
	var objName = document.EditMsg;
	var xxx;

	if(Trim(objName.subject.value) == "")
	{
		alert("Please enter the message's subject")
		objName.subject.focus();
		return false;
	}

	if(Trim(objName.PerfectResponseMessage.value) == "")
	{
		alert("Please enter some text in the message body");
		objName.PerfectResponseMessage.focus();
		return false;
	}

	return true;
}



function ValidateBroadcast()
{
	var Subject = document.BroadcastSendForm.txtMessage_Subject.value;
	var Text=document.BroadcastSendForm.txtMessage_Text.value;
	
	if ((Subject == "") || (Text == ""))
	{
		alert("The Subject and the Message cannot be blank.");
		document.MsgForm.Submit.value = "Send";
		return(false);
	}
	if (Text.length <100)
	{
		if(confirm("Are you sure you want to send:\n\nSubject: "+Subject+"\nBody:\n"+Text) == false)
		{
			document.BroadcastSendForm.Submit.value = "Send";
			return(false);
		}
	}
	else
	{
		if(confirm("Are you sure you want to send:\n\nSubject: "+Subject+"\nBody:\n"+Text.substr(0,100)+"...") == false)
		{
			document.BroadcastSendForm.Submit.value = "Send";
			return(false);
		}
	}

	return(true);
}
	
function PostedIt()
{
	
	if (ValidateBroadcast() == true)
	{
		alert("This broadcast has already been sent!");
		return (false);
	}
	
	return(confirm('This message will be sent to all subscribers of email campaign \'<?php echo $CampaignDescription; ?>.\'\nAre you sure your message is ready to be sent?'));
}



//-->
</script>
</HEAD>
<body>
<div id="Wrapper"><div id="content">
<span class="BoxHeading">
<input type="button" id="submit" name="submit" value="Click for helpful hints!" class="Button" onclick="Show();" onmouseover="document.getElementById('submit').style.fontWeight='bold';" onmouseout="document.getElementById('submit').style.fontWeight='normal';">
</span>
<div id="navBeta">
	<h2>Edit Msg Help</h2>
	<p>You can personalize both the subject and/or message 
	bodys by using<br />%FullName% and %EmailAddress% (note case sensitivity).</p>
	<p>Use %Confirmation% to display the 2-step confirmation string.</p>
	<p>Example: Hello, %FullName%! How are you? Confirm subscription by clicking on %Confirmation%</p>

	<p>You can also define up to 4 custom personalization
	fields:<br>%UserDefined1%,<br>%UserDefined2%,<br>%UserDefined3%,
	and<br>%UserDefined4%.</p>
	
	<p>An example of using these fields is if you wanted to request your prospect's address. You
	could store it in field %UserDefined1%.</p> 

	<p>In the message body: Your home at %UserDefined1% must be big.</p>

	<p align="left"><i>Perfect Response</i>™ has a built-in character autowrap feature! 
	Now all messages you send will properly formatted and visible 
	to every Internet user -- no matter what email program they're 
	using. Even AOL™ and Netscape Mail™ users will get perfectly 
	formatted messages every time!</p>

	<p align="left">It's recommended that your autowrap settings should 
	be 60 characters by default. This mail campaign's settings page will also 
	allow you to specify plain text or HTML mailings. If you're sending 
	HTML messages, copy and paste the code from your HTML or email editor into the message box.</p>
	
	<p>If you want to add an image to your message, you must first upload it to the server. After
	it is uploaded you may use the 'Insert Image' tool withing the message editor.</p>
</div>
<?php
	print ("<h3>Edit <i>");
	if ($curseq == -4)
		print ("Immediate Broadcast Message");
	elseif ($curseq == -3)
		print ("Subscription Confirmation Message");
	elseif ($curseq == -2)
		print ("Welcome Message");
	elseif ($curseq == -1)
		print ("Unsubscribe Acknowledgement Message");
	elseif ($curseq == 0)
		print ("<i>Campaign Messages Signature");
	else
		print ("Message $curseq");
				
	print(" for<br />$CampaignDescription</i></h3>\n");
			
	print("<form name='EditMsg' target='Main' onSubmit='return(Validate());' enctype='multipart/form-data' method='post' action='EditMessageAction.php'>\n");

	print ("<input type='hidden' name='mid' value='$row->mid'>\n");
	print ("<input type='hidden' name='arid' value='$arid'>\n");
	print ("<input type='hidden' name='MAX_FILE_SIZE' value='300000'>\n\n");
	
	if ($curseq != 0)
	{
		print("<p><label for='subject'>Subject</label></p>\n");
		$Subject=eregi_replace('"',"&quot",$row->subject);
		print("<input type='text' name='subject' id='subject' size='60' value=\"$Subject\" \n");
		print("onfocus=\"this.style.border='2px solid #000080'\"  onblur=\"this.style.border='2px solid gray'\">\n");
	}
	
	//die("died (".__LINE__.") for debugging |$row->body|");

	print("<div style='text-align:left;margin-left:10px;'>");
	print("<p><label for='PerfectResponseMessage'>Body</label></p>");
	print("</div><div style='text-align:left;height:430px;'>\n"); 
	print("<textarea name='PerfectResponseMessage' id='PerfectResponseMessage' cols='70' rows='15' style='width:550px;height:400px;'>".$row->body."</textarea>");
	print("</div><div style='float:left;margin-left:100px;'>\n");
	if ($curseq > 0)
	{	
		print("<p style='margin:10px 0;'><label for='delay'>Send this message</label>&nbsp;\n");
		print("	<select name='delay' id='delay' size='1'>\n");

		for($num=1;$num<32;$num++)
		{
			print("<option value=$num");
					
			if ($row->delay==$num)
				print (" selected");
						
			print(">$num </option>\n");
		}

		print("</select>&nbsp;days after previous message</p>\n");
	}	//end of 'if ($curseq > 0)'
	else
		print("<input type='hidden' name='delay' value=0>\n");
?>
	</div><br style='clear:left;'><div style='float:left;margin-left:16px;'>
	<input class='submit' type="submit" name='OtherT' value="Save" onClick="this.value='Saving'"
	onMouseover="this.className='MouseOver'" onMouseout="this.className='submit'">
	</div><div style='float:left;margin-left:16px;'>
	<input class='cancel' type='button' name='OtherT' value='Cancel' onClick='window.location.href="ManageMessages.php?arid=<?php echo $arid ?>&cmd=1"' 
	onMouseover="this.className='MouseOver'" onMouseout="this.className='cancel'"></form>
<?php
	print("</div><div style='float:left;margin-left:16px;'><form name=InstantForm' action='InstantTest.php' method='get'>\n");
	print ("<input type='hidden' name='arid' value='$arid'>\n");
	print ("<input type='hidden' name='MsgNoToTest' value='$curseq'>\n");
	print ("<input class='submit' type='submit' name='OtherT' value='Instant Test' style='width:110px;' onClick=\"this.value='Testing'\" ");
	print ("onMouseover=\"this.className='MouseOver'\" onMouseout=\"this.className='submit'\" title='Send an instant test of one or all messages'>\n");
	print ("</form></div><div style='float:left;margin-left:16px;'><form name=InstantForm' action='ViewImages.php' target='Monitor' method='get'>\n");
	print ("<input class='cancel' type='submit' name='OtherT' value='List Uploaded' style='width:110px;' \n"); 
	print ("onMouseover=\"this.className='MouseOver'\" onMouseout=\"this.className='cancel'\"></form>\n");

	if ($curseq == -4)
	{
		print("</div><div style='float:left;margin-left:16px;'><form name='BroadcastSendForm' onSubmit='return(PostedIt);' method='post' action='BroadcastAllAction.php' target='Monitor'>\n");
		print("<input type='hidden' name='arid' value='$arid'>\n");
		print("<input type='hidden' name=\"CampaignDescription\" value='$CampaignDescription'>\n");
		$Subject=eregi_replace('"',"&quot",$row->subject);
		print("<input type='hidden' name='txtMessage_Subject' id='txtMessage_Subject' value=\"$Subject\">\n");
		print("<input type='hidden' name='txtMessage_Text' id='txtMessage_Text' value=\"$row->body\"></form>\n");
		print ("</div><div style='float:left;margin-left:16px;'>\n");
		print("<input class='submit' type='submit' name='OtherT' value='Send Now' onClick='this.value=\"Sending\";window.location.href=\"ManageMessages.php?arid=$arid&cmd=1\"' \n"); 
		print("onMouseover=\"this.className='MouseOver'\" onMouseout=\"this.className='submit'\">\n"); 
	}
	
	print("</div><br style='clear:left;'><br />\n");
		
	JumpToCampaign($link, $arid); 
	ReferenceLinks($arid);
?>
</div></div>

</BODY>
</HTML>
