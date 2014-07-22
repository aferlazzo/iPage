<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright � Tony Ferlazzo 2007 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/

//include("settings.php");
include("check1.php");
Include("conn.php");
if (!(isset($_GET["arid"])))  //EditSubscriberAction.php has read the mySql user table and now has passed the user table's record of this subscriber
{

	$ID				= $_POST["arid"];
	$arid			= $_POST["arid"];
	$UserName      	= trim($_POST["UserName"]);
	$Email			= trim($_POST["Email"]);
	$MM				= $_POST["MM"];
	$DD				= $_POST["DD"];
	$YY				= $_POST["YY"];
	$hh				= $_POST["hh"];
	$mm				= $_POST["mm"];
	$MessageNumber	= $_POST["MessageNumber"];
	$uid			= $_POST["uid"];
	$vtype			= $_POST["vtype"];
	$Returned		= $_POST["Returned"];

	//print("EditSubscriber.php: found user |$UserName| email |$Email| arid |$arid|<br/>");
}
else //the arid is pass by the CampaignManager.php as the initial pass, this script calls EditSubscriberAction.php
{
	$ID=$_GET["arid"];
	$arid=$_GET["arid"];
	$Returned = 'false';  //first time thru, we haven't yet returned
	//die("received $arid from \$_GET");
}
	
$WithinScript = "I know the arid";

include("settings.php");

if ($ID=="") 
{
	echo "<b>Unable to find record for selected Autoresponder.<BR>Please go <a href ='void(history.back())'>back</a> and try again";
	exit;
}

	$result = mysql_query("SELECT * FROM autoresponders where arid=$ID", $link); 
	$num_rows = mysql_num_rows($result);
	
	if ( $num_rows < 0 ) {
		echo "<b>Unable to find record for selected Autoresponder.<BR>Please go <a href ='void(history.back())'>back</a> and try again";
		exit;
	}
	
	mysql_data_seek($result, 0);
	$row = mysql_fetch_object($result);
	//print("EditSubscriber.php: ID: $ID");
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<HTML>
<HEAD>
<TITLE>Edit Subscriber - Perfect Response</TITLE>
<meta name="robots" content="NoIndex, NoFollow">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="./css/PerfectResponse.css">
<link rel="stylesheet" type="text/css" href="./css/niftyCorners.css">
<script type="text/javascript" src="./js/PerfectResponse.js"></script>
<script type="text/javascript" src="./js/nifty.js"></script>
<style type="text/css" media="screen">
#UserNameDiv {display:none;}
#EmailDiv {display:block;}
</style>
<script type="text/javascript">
function InputUserName()
{
	document.getElementById('UserNameDiv').style.display='block';
  document.getElementById('EmailDiv').style.display='none';
	document.EditSubscriberForm.vtype.value='username';
  //alert("vtype: "+document.EditSubscriberForm.vtype.value);
} 
function InputEmail()
{
  //alert("Email selected");
	document.getElementById('EmailDiv').style.display='block';
  document.getElementById('UserNameDiv').style.display='';
	document.EditSubscriberForm.vtype.value='email';
  //alert("vtype: "+document.EditSubscriberForm.vtype.value);
} 
function isDigit(c)
{
  //alert("isDigit(): "+c);
  return ((c >= "0") && (c <= "9"));
}

function isEmpty(s)
{
  //alert("isEmpty(): |"+s+"|");
  var whitespace = " \t\n\r";
  var i;
	if((s == null) || (s.length == 0))
	  return true;
	//search string looking for characters that are not whitespace
	for (i=0; i<s.length; i++)
	{
	  var c = s.charAt(i);
		if (whitespace.indexOf(c) == -1)
		{
		  return false;
		}
	}
	return true;
}

function isInteger(field)
{
 var i, c;
 var xx = field.value;
 //alert("isInteger(): "+xx);
 if (isEmpty(xx))
 {
		   alert("Value "+field.name+" must be filled");
 		   return false;
 }
 
 for (i=0; i < xx.length; i++)
 {
 //check if all characters are numbers
 		c=xx.charAt(i);
		if(!isDigit(c))
		{
		   alert("Field "+field.name+"'s value of |"+xx+"| is not numeric");
			 return false;
		}
	}
  return true;
}
  
function isIntegerInRange(field,min,max)
{
	var s = field.value;
	//alert("isIntegerInRange(): "+s);
	 
	if (isEmpty(s))
	{
		   alert("Value "+field.name+" must be filled");
 		   return false;
	}
		 
	 if (!isInteger(field))
	   return false;
 
	var num = parseInt(s,10); //this statement adds the leading zeros
	if ((num < min) || (num > max))
	{
	 	alert("Field "+field.name+" is out of valid range. Should be "+min+" <= "+num+" <= "+max);
		return false;
	}
}

//JavaScript doesn�t have a built-in Trim function, which trims white spaces from the beginning 
//and the end of a string. These 3 very useful trim JavaScript functions � leftTrim(), rightTrim(), and allTrim().

//Lets start with leftTrim() function, which will trim all white spaces in front of a string and will return the 
//trimmed string. 
//The leftTrim JavaScript function takes one parameter, which is the string that needs to be trimmed. 
//The function then loops through each of the characters of this string, starting with the first one. 
//If the current character in the loop is a single white space � �, the function removes it from the 
//string and continues with the loop. The loop goes on until it finds character, which is different 
//than a single white space or until it reaches the end of the string. After the function exits the loop, 
//it returns the left trimmed string.

function leftTrim(sString)
{
  while (sString.substring(0,1) == ' ')
  {
    sString = sString.substring(1, sString.length);
  }
  return sString;
}


//The rightTrim() JavaScript function works in exactly the same way, except that it trims the white spaces 
//at the end of the string:

function rightTrim(sString)
{
  while (sString.substring(sString.length-1, sString.length) == ' ')
  {
    sString = sString.substring(0,sString.length-1);
  }
  return sString;
}

//The allTrim() JavaScript function combines both leftTrim() and rightTrim() functions:

function allTrim(sString)
{
  while (sString.substring(0,1) == ' ')
  {
    sString = sString.substring(1, sString.length);
  }
  while (sString.substring(sString.length-1, sString.length) == ' ')
  {
    sString = sString.substring(0,sString.length-1);
  }
  return sString;
}



function Validate(SearchType)
{
	if((isIntegerInRange(document.EditSubscriberForm.MM,1,12)==false) 
	|| (isIntegerInRange(document.EditSubscriberForm.DD,1,31)==false) 
	|| (isIntegerInRange(document.EditSubscriberForm.YY,0,99)==false) 
	|| (isIntegerInRange(document.EditSubscriberForm.hh,0,23)==false) 
	|| (isIntegerInRange(document.EditSubscriberForm.mm,0,59)==false)
	|| (isIntegerInRange(document.EditSubscriberForm.MessageNumber,0,255)==false))
	{
		 document.EditSubscriberForm.Submit2.value='Change';
		 document.EditSubscriberForm.Submit2.className='submit';
		 document.EditSubscriberForm.Submit2.blur();
		 return false;
	}

	if(SearchType == 'email')
	{
		var Email =  allTrim(document.EditSubscriberForm.Email.value);
		document.EditSubscriberForm.Email.value = Email;

		if(isEmpty(Email)) 
		{
			alert('Email address must be filled.');
			document.EditSubscriberForm.Submit2.value='Find';
			document.EditSubscriberForm.Submit2.className='submit';
			document.EditSubscriberForm.Submit2.blur();
			return false;
		}
	}

	if(SearchType == 'username')
	{
		var UserName =  allTrim(document.EditSubscriberForm.UserName.value);
		document.EditSubscriberForm.UserName.value = UserName;

		if(isEmpty(UserName)) 
		{
			alert('User Name address must be filled.');
			document.EditSubscriberForm.Submit2.value='Find';
			document.EditSubscriberForm.Submit2.className='submit';
			document.EditSubscriberForm.Submit2.blur();
			return false;
		}
	}

	if((SearchType == 'email') || (SearchType == 'username'))\nreturn true;
	alert('Error: Not a user name search or an email address search');\nreturn false;
}
alert("EditSubscriber.php xxx");
</script>
</HEAD>
<body>
<div id='Wrapper'><div id='content'>
<span class='BoxHeading'>
<input type="button" id="submit" name="submit" value="Click for helpful hints!" class="Button" onclick="Show();" onmouseover="document.getElementById('submit').style.fontWeight='bold';" onmouseout="document.getElementById('submit').style.fontWeight='normal';">
</span>
<div id="navBeta">
	<h2>Note</h2>
	<p>The User database is indexed by user number. Within each autoresponder campaign you can have records containing
	duplicate Email Addresses and names. Each user record contains a pointer to what message to send next and when to send it.
	All these field can be modified. To access a user record you must first enter its email address.</p>
	<p>Special Message Numbers</p>
	<p>0 - Welcome message</p>
	<p>253 - removed from via BounceHandler.php</p>
	<p>254 - removed from via remove.php - admin user remove</p>
	<p>255 - removed from via us.php - unsubscribe request</p>
</div>
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
<TABLE CELLSPACING='4' align="center">
	<TR> 
		<TD WIDTH='45%'></TD>
		<TD WIDTH='55%'></TD>
	</TR>
	<tr>
		<td colspan='2' align='center'><h2>
	<?php 

			if ($CampaignState == "Suspended")
				print ("Campaign is <span style='background-color: #DC143C; color: #ffffff; font-weight: bold;'>Suspended</span>\n");
			else	
				print ("Campaign is <span style='background-color: #004a8d; color: #ffffff; font-weight: bold;'>Active</span>\n");					 	
			print("<br /><span id='Grow'><i>$CampaignDescription</i></span></h2></td></tr><tr><td colspan='2' align='center'><h3>\n");
	?>
		</td>
	</TR>

	<TR> 
		<td align="center" valign="top" colspan='2'> 
<?php
		if($Returned == "false")
		{
			print("<h2>Find Subscriber</h2>\n");
		}
		else
		{
			print("<h2>Change Subscriber</h2>\n");
		}

	print(" </td>\n");
	print("</tr></table>\n");	
	
	print("<form name='EditSubscriberForm' method='post' onSubmit='return(Validate(document.EditSubscriberForm.vtype.value));' action='EditSubscriberAction.php' target='Main'>\n");
	print("  <input type='hidden' name='arid' value='$ID'>\n");
	print("  <input type='hidden' name='uid' value='$uid'>\n");
	print("  <input type='hidden' name='vtype' value='$vtype'>\n");
	print("  <input type='hidden' name='Returned' value='$Returned'>\n");

if ($Returned == "true") {
	print("<TABLE CELLSPACING='4' align='center'><tr>\n");
	print(" <td style='text-align:right;height:30px;width:150px;;'><label for='UserName'>User Name</label></td>\n");
	print(" <td style='text-align:left;height:30px;width:227px;;'>\n");  
	print("  <input type='text' name='UserName' id='UserName' size='33' value='$UserName'\n");
	print("		 onfocus='this.style.border=\"2px solid #000080\"'  onblur='this.style.border=\"2px solid gray\"'>\n");
	print("	</td>\n");
	print("</tr>\n");

	print("<tr>\n");
	print("	<td height='30' align='right'><label for='Email'>Email Address</label></td>\n");
	print("	<td align='left'>\n");  
	print("	 <input type='text' name='Email' id='Email' size='33' value='$Email'\n");
	//print("disabled \n");
	print("		onfocus='this.style.border=\"2px solid #000080\"'  onblur='this.style.border=\"2px solid gray\"'>\n");
	print("	</td>\n");
	print("</tr></table>\n");
}	
else
{	
?>
 <TABLE CELLSPACING='4' align="center"><tr><td colspan='2' style='text-align:center;'>
 Search by: Email<input type='radio' name='radiogroup' class='radiogroup' value'EE' checked  onclick='InputEmail();'>
 Name <input type='radio' name='radiogroup' class='radiogroup' value'NN' onclick='InputUserName();'>
 </td></tr></table>
<div id='EmailDiv'>
<TABLE CELLSPACING='4' align="center">
	<tr>
		<td height='30' width='45%' align='right'><label for='Email'>Email Address</label></td>
		<td align='left'>  
		 <input type='text' name='Email' id='Email' size='40'
			title='Enter the name you want to show as&#013the "From:" name for the mail campaign'
			onfocus='this.style.border="2px solid #000080"'  onblur='this.style.border="2px solid gray"'>
		</td>
	</tr></table>
</div>
<div id='UserNameDiv'>
<TABLE CELLSPACING='4' align="center">
	<tr>
		<td height='30' width='45%' align='right'><label for='UserName'>User Name</label></td>
		<td align='left'>  
		 <input type='text' name='UserName' id='UserName' size='40'
			title='Enter the name you want to show as&#013the "From:" name for the mail campaign'
			onfocus='this.style.border="2px solid #000080"'  onblur='this.style.border="2px solid gray"'>
		</td>
	</tr></table>
</div>

<?php	
}

	
if ($Returned == "true")
{
	print("<TABLE CELLSPACING='4' align='center'><tr>\n");
	print("	<td style='text-align:right;height:30px;width:150px;'><label for='MM'>MM</label>/<label for='DD'>DD</label>/<label for='YY'>YY</label>\n");
	print("			<label for='hh'>hh</label>:<label for='mm'>mm</label><br /><b>to send</b></td>\n");
	print("	<td style='text-align:left;height:30px;width:227px;'>\n");  
	printf("		<input type='text' name='MM' id='MM' size='2' value='%02d'\n", $MM);
	print("			title='Enter when you want the message to be sent.' style='width:20px;text-align:center;'\n");
	printf("				onfocus='this.style.border=\"2px solid #000080\"'  onblur='this.style.border=\"2px solid gray\"'><b>/</b><input type='text' name='DD' id='DD' size='2' value='%02d'\n", $DD);
	print("			title='Enter when you want the message to be sent.'  style='width:20px;text-align:center;'\n");
	printf("				onfocus='this.style.border=\"2px solid #000080\"'  onblur='this.style.border=\"2px solid gray\"'><b>/</b><input type='text' name='YY' id='YY' size='2' value='%02d'\n", $YY);
	print("			title='Enter when you want the message to be sent.'  style='width:20px;text-align:center;'\n");
	print("				onfocus='this.style.border=\"2px solid #000080\"'  onblur='this.style.border=\"2px solid gray\"'>&nbsp;&nbsp;\n");
	printf("		<input type='text' name='hh' id='hh' size='2' value='%02d' onchange='Validate(this.value);'\n", $hh);
	print("			title='Enter when you want the message to be sent.'  style='width:20px;text-align:center;'\n");
	printf("			onfocus='this.style.border=\"2px solid #000080\"'  onblur='this.style.border=\"2px solid gray\"'><b>:</b><input type='text' name='mm' id='mm' size='2' value='%02d'\n", $mm);
	print("			title='Enter when you want the message to be sent.'  style='width:20px;text-align:center;'\n");
	print("				onfocus='this.style.border=\"2px solid #000080\"'  onblur='this.style.border=\"2px solid gray\"'>\n");
	print("	</td>\n");
	print("</tr>\n");
	print("<tr>\n");
	print("	<td style='text-align:right;height:30px;width:150px;'><label for='MessageNumber'>Message number</label></td>\n");
	print("	<td style='text-align:left;height:30px;width:227px;'>\n");  
	print("		<input type='text' name='MessageNumber' id='MessageNumber' size='3' value='$MessageNumber'\n");
	print("			title='Enter the message number to be sent' style='width:30px;text-align:center;'\n");
	print("				onfocus='this.style.border=\"2px solid #000080\"'  onblur='this.style.border=\"2px solid gray\"'>\n");
	print("	</td>\n");
	print("</tr></table>\n");
}
else  //must still define so Validation function will work correctly
{
	printf("		<input type='hidden' name='MM' id='MM' value='1'\n");
	printf("		<input type='hidden' name='DD' id='DD' value='1'\n");
	printf("		<input type='hidden' name='YY' id='YY' value='1'\n");
	printf("		<input type='hidden' name='hh' id='hh' value='1'\n");
	printf("		<input type='hidden' name='mm' id='mm' value='1'\n");
	printf("		<input type='hidden' name='MessageNumber' id='MessageNumber' value='1'\n");
}
	print("<TABLE CELLSPACING='4' align='center'><tr>\n");
	print("	<td colspan='2' align='center'>\n"); 

	if ($Returned == "true")
	  print("<br><input class='submit' type='submit' name='Submit2' value='Change' onClick='if (confirm(\"Do you really want to *CHANGE* this subscriber settings?\") == true) {this.value=\"Changing\"; return true; } else return false;'\n"); 
	else
	  print("<br><input class='submit' type='submit' name='Submit2' value='Find' onClick='this.value=\"Finding\"'\n"); 
 	print("onMouseover='this.className=\"MouseOver\"' onMouseout=\"this.className='submit'\">&nbsp;\n");
	print("		<input class='cancel' type='button' value='Cancel' onClick='window.location.href=\"CampaignManager.php?arid=$arid&cmd=1\"'\n");
 	print("		onMouseover=\"this.className='MouseOver'\" onMouseout=\"this.className='cancel'\"><br />&nbsp;</td></TR></TABLE>\n");
	print("</form>\n");

	JumpToCampaign($link, $arid); 
	ReferenceLinks($arid);
	print("</div>\n"); 
?>
</div> <!-- end of Wrapper -->
</BODY>
</HTML>
