<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright � Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/
// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =// 
//																						//
// InstantTest.php: This script sends out all messages in a mail campaign at one time	//
//																						//
// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =// 

$arid = $_GET["arid"];
$MsgNoToTest = $_GET["MsgNoToTest"];
//die("InstantTest.php (".__LINE__.") MsgNoToTest |$MsgNoToTest|\n"); 
include("check1.php");
Include("conn.php");
$WithinScript = "I know the arid";
include("settings.php");
include("removesettings.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<HTML>
<HEAD>
<TITLE>Message Test - Perfect Response</TITLE>
<meta name="robots" content="NoIndex, NoFollow">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="./css/PerfectResponse.css">
<link rel="stylesheet" type="text/css" href="./css/niftyCorners.css">
<script type="text/javascript" src="./js/PerfectResponse.js"></script>
<script type="text/javascript" src="./js/nifty.js"></script>
<script type="text/javascript">
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



function checkEmail(strEmail)
{
	emailflag="";

	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(strEmail))
	{
		//submit = 0;

		emailflag="true";
	}
	else
	{
		emailflag="false";
	}

	return emailflag;

}//Ending check mail function

function checkMsgNo(strMsgNo)
{
	MsgNoflag="";

	if (/[0-9Bb]/.test(strMsgNo))
		MsgNoflag="true";
	else
		MsgNoflag="false";

	return MsgNoflag;

}//Ending check MsgNo function




/* replace "'" with "`" ---- we do this for PHP because it uses the apostrophe character */

function ConvertApostrophe(Comments)
{
	// alert("length of comments is " + Comments.value.length);

	for(var i=0; i<Comments.value.length; i++)
	{
		if(Comments.value.charAt(i)=="'")
		{
			// alert("Converting |" + Comments.value.charAt(i) + "|");
			Comments.value.charAt(i).value="�";
			// alert("Converted to |" + Comments.value.charAt(i) + "|");
		 }
	}

	return(Comments.value);
}


function Validate()
{
	var objName = document.Instant;
	var xxx;

	if(Trim(objName.MsgNo.value) != "")
		if(checkMsgNo(objName.MsgNo.value) == "false")
		{
			alert("Please enter a number (leave blank for all messages)")
			objName.MsgNo.focus();
			return false;
		}

	if(Trim(objName.InstantTestFullName.value) == "")
	{
		alert("Please enter your name")
		objName.InstantTestFullName.focus();
		return false;
	}

	if(Trim(objName.InstantTestEmailAddress.value) == "")
	{
		alert("Please enter the E-mail address to receive the messages");
		objName.InstantTestEmailAddress.focus();
		return false;
	}

	if(checkEmail(objName.InstantTestEmailAddress.value) == "false")
	{
		alert("Please enter a valid E-mail address");
		objName.InstantTestEmailAddress.focus();
		return false;
	}
	return true;
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
	<h2>A Suggestion</h2>
	<p>It is a good idea to send the mail campaign to yourself before activating the campaign. 
	Edit and spell-check the messages the messages. Does your campaign message flow? </p>
	<p>Are	you reminding the subscriber to act now? Is your contact information included in each message?</p>
	<p>Message '0' to send a test of the Welcome Message.</p>
	<p>Message 'B' to send a test of the Broadcast Message.</p>
	
</div>

<form name="Instant" onSubmit="return(Validate());" method="post" action="InstantTestAction.php">
<input type="hidden" name="arid" value=<?php echo "$arid" ?>>
<TABLE width='95%' BORDER='0' CELLPADDING='4' CELLSPACING=0 align="center">
	<TR>
		<td align='center' colspan='2'> 
			<h2>Message Test for
	<?php 
		print("<br /><span id='Grow'><i>$CampaignDescription</i></span></h2>");
	?>

		</td>
	</tr>
	<tr> 
<?php
	$MessageSelectResult = mysql_query("SELECT * FROM messages where arid=$arid order by seqno", $link); 
	$NumberOfMessages = mysql_num_rows($MessageSelectResult); 	
?>
	
			<td align="right" width="40%"><label for="MsgNo">Message Number to Send</label></td>
			<td	align="left">

				<select name="MsgNo" id="MsgNo" size="1" style='width:220px;'>
			<?php 
				for($num=0;$num<=$NumberOfMessages;$num++)
				{
					mysql_data_seek($MessageSelectResult, $num);
					$row = mysql_fetch_object($MessageSelectResult);
					$seqno   = $row->seqno;
					$Subject = $row->subject;
					
					if ($num == 0) //always list this choice 
					{
						print ("<option ");
						if($MsgNoToTest == "")
							print ("selected");
						print (" style='width:220px;' value=''>Send All Messages</option>\n");
					}
					if ($seqno == -4 )
					{
						print ("<option ");
						if($seqno == $MsgNoToTest)
							print ("selected");
						print (" style='width:220px;' value='-4'>Broadcast - $Subject</option>\n");
					}
					if ($seqno == -2 )
					{
						print ("<option ");
						if($seqno == $MsgNoToTest)
							print ("selected");
						print (" style='width:220px;' value='0'>Welcome - $Subject</option>\n");
					}
					if ($seqno > 0 )
					{
						print ("<option ");
						if($seqno == $MsgNoToTest)
							print ("selected");
						print(" style='width:220px;' value='$seqno'>$seqno - $Subject</option>\n");
					}
				}
			?>
				</select></td></tr>
				
	<tr> 
		<td align="right" width="40%"><label for="InstantTestFullName">Send To Name</label></td>
		<td	align="left">
			<input type="text" name="InstantTestFullName" id="InstantTestFullName" size="33"
				title="Enter the recipient's Full Name you want to send email campaign messages"
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		</td>
	</tr>
	<tr>
		<td align="right" width="40%"><label for="InstantTestEmailAddress" >Send To Email Address</label</td>
		<td	align="left">	
			<input type="text" name="InstantTestEmailAddress" id="InstantTestEmailAddress" size="33"
				title="Enter the recipient's email address"
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		</td>
	</tr>
	<tr> 
		<td	align="right"><label for="InstantTestUserDefined1">(Optional) User Defined1</label></td>
		<td	align="left">	
			<input type="text" name="InstantTestUserDefined1" id="InstantTestUserDefined1" size="33"
				title="if you request the subscriber to provide you with an optional user variable (address, phone number, shoe size, etc) enter the answer here"
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		</td>
	</tr>
	<tr> 
		<td	align="right"><label for="InstantTestUserDefined2">(Optional) User Defined2</label></td>
		<td	align="left">	
			<input type="text" name="InstantTestUserDefined2" id="InstantTestUserDefined2" size="33"
				title="if you request the subscriber to provide you with an optional user variable (address, phone number, shoe size, etc) enter the answer here"
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		</td>
	</tr>
	<tr> 
		<td	align="right"><label for="InstantTestUserDefined3">(Optional) User Defined3</label></td>
		<td	align="left">	
			<input type="text" name="InstantTestUserDefined3" id="InstantTestUserDefined3" size="33"
				title="if you request the subscriber to provide you with an optional user variable (address, phone number, shoe size, etc) enter the answer here"
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		</td>
	</tr>
	<tr> 
		<td	align="right"><label for="InstantTestUserDefined4">(Optional) User Defined4</label></td>
		<td	align="left">	
			<input type="text" name="InstantTestUserDefined4" id="InstantTestUserDefined4" size="33"
				title="if you request the subscriber to provide you with an optional user variable (address, phone number, shoe size, etc) enter the answer here"
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		</td>
	</tr>
	<tr> 
		<td colspan="2" align="center"> 
			<br><input class='submit' type="submit" name="Submit2" value="Send Test" onClick="this.value='Sending'"
 			onMouseover="this.className='MouseOver'" onMouseout="this.className='submit'">&nbsp;
			<input class='cancel' type='button' value='Cancel' onClick='history.back()'
 			onMouseover="this.className='MouseOver'" onMouseout="this.className='cancel'"><br>&nbsp;
		 </td>
	</tr>
</TABLE>
</form>
<?php
	JumpToCampaign($link, $arid); 
	ReferenceLinks($arid);
?>
</div></div>
</BODY>
</HTML>
