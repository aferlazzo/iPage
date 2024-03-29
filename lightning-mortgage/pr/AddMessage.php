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

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<HTML>
<HEAD>
<TITLE>Perfect Response Add Message</TITLE>
<meta name="robots" content="NoIndex, NoFollow">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="./css/PerfectResponse.css">
<link rel="stylesheet" type="text/css" href="./css/niftyCorners.css">
<script type="text/javascript" src="./js/PerfectResponse.js"></script>
<script type="text/javascript" src="./js/nifty.js"></script>
<script type="text/javascript" src="../fckeditor/fckeditor.js"></script>
<script type="text/javascript">
<!--//

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
	var objName = document.AddMsg;
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
//-->
</script>
</HEAD>

<body>
<div id="Wrapper"><div id="content">
<span class="BoxHeading">
<input type="button" id="submit" name="submit" value="Click for helpful hints!" class="Button" onclick="Show();" onmouseover="document.getElementById('submit').style.fontWeight='bold';" onmouseout="document.getElementById('submit').style.fontWeight='normal';">
</span>
<div id="navBeta">
	<h2>Add Msg Help</h2>
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

	<p align="left"><i>Perfect Response</i> has a built-in character autowrap feature! 
	Now all messages you send will properly formatted and visible 
	to every Internet user -- no matter what email program they're 
	using. Even AOL� and Netscape Mail� users will get perfectly 
	formatted messages every time!</p>

	<p align="left">It's recommended that your autowrap settings should 
	be 60 characters by default. This mail campaign's settings page will also 
	allow you to specify plain text or HTML mailings. If you're sending 
	HTML messages, copy and paste the code from your HTML or email editor into the message box.</p>
	
	<p>If you want to add an image to your message, you must first upload it to the server. After
	it is uploaded you may use the 'Insert Image' tool withing the message editor.</p>
	
</div>
	 	<?php 
			print("<h3>Add New Message for<br /><span id='Grow'>$CampaignDescription</span></h3><h3>");

		 	if ($CampaignState == "Suspended")
		 		print ("The Campaign is <span style='background-color: #DC143C; color: #ffffff; font-weight: bold;'>Suspended</span>");
		 	else	
		 		print ("The Campaign is <span style='background-color: #004a8d; color: #ffffff; font-weight: bold;'>Active</span>");					 	

	 	?></h3>

		<form name="AddMsg" onSubmit="return(Validate());" 
		method="post"  action="AddMessageAction.php" target='Monitor' enctype='multipart/form-data'> 
		<div style='text-align:left;margin-left:10px;'>
		
		<input type='hidden' name='arid' value='<?php echo $arid ?>'>
		<input type='hidden' name='MAX_FILE_SIZE' value='300000'>

		<p><label for="subject">Subject</label></p>

		<input type="text" name="subject" id="subject" size="60"
					onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">
		<p><label for="PerfectResponseMessage">Body</label></p>
		</div><div style='text-align:left;height:430px;padding:0;margin:0;'> 
		<textarea name="PerfectResponseMessage" cols="62" rows="15"></textarea></div>


		<div style='text-align:left;margin-left:10px;'>
			<p style='margin:10px 0;'><label for="ufile">Attachment</label></p>
			<p><input type="file" name="ufile" id="ufile" size="60"
				onfocus="this.style.border='2px solid #000080'"  onblur="this.style.border='2px solid gray'">

			<p style='margin:10px 0;'><label for="uimage">Upload an Image For Inserting Into A Message</label></p>
			<p><input type='file' name='uimage' id='ufile' size='60' value=''	onfocus=\"this.style.border='2px solid #000080'\"  onblur=\"this.style.border='2px solid gray'\"></p>
			<p style='margin:10px 0;'>Uploaded to 'http://www.lightning-mortgage.com/pr/uploadedimages/'. 

			<p style='margin:10px 0;'><label for="delay">Send this message</label>&nbsp;
				<select name="delay" size="1">
			<?php 
				for($num=1;$num<32;$num++)
					print ("<option value=$num>$num</option>\n");
			?>
				</select>&nbsp;
				days after previous message.</p>

			<p style='margin:10px 0;text-align:center;'> 
			<input class='submit' type="submit" name="OtherT" value="Add Message" onClick="this.value='Now Adding ...'"
 			onMouseover="this.className='MouseOver'" onMouseout="this.className='submit'">&nbsp;
			<input class='cancel' type='button' value='Cancel' onClick='window.location.href="ManageMessages.php?arid=<?php echo $arid ?>&cmd=1"' 
 			onMouseover="this.className='MouseOver'" onMouseout="this.className='cancel'">
			<input class='submit' type='button' name='OtherT' value='List Uploaded' style='width:110px;' onClick='top.frames["Monitor"].location.href="ViewImages.php"' 
 			onMouseover="this.className='MouseOver'" onMouseout="this.className='submit'"></p></div>
</form>
<?php
	JumpToCampaign($link, $arid); 
	ReferenceLinks($arid);
?>
</div></div> <!-- end of Wrapper -->
</BODY>
</HTML>
