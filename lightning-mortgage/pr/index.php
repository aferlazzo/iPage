<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright © Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/
if (!($_COOKIE["UName"]==""))
{
	//die("UName: |$_COOKIE[\"UName\"]|");
	header("Location: http://www.lightning-mortgage.com/pr/PerfectResponse.htm"); 
	exit;                 
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<HTML>
<HEAD>
<TITLE>Perfect Response</TITLE>
<meta name="robots" content="NoIndex, NoFollow">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="./css/PerfectResponse.css">
<link rel="stylesheet" type="text/css" href="./css/niftyCorners.css">
<script type="text/javascript" src="./js/PerfectResponse.js"></script>
<script type="text/javascript" src="./js/nifty.js"></script>
<style type="text/css">
p{
text-align:justify;
padding:1em 2em;
}
</style>
</HEAD>
<body>

<div id="Wrapper"><div id="content">
<div class="title" style='display:block;'> 
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
<p><i>Perfect Response</i> is an advanced Email Marketing System. Here's how it works. Any series 
of messages, lessons, or reports decide to create can make up an 'Email Campaign.' Those messages 
can be sent out to people who sign up to receive them. </p>

<p>Unlike sending a newsletter to a list of subscribers, which all subscribers receive at the same
time, this system is an autoresponder. It automatically responds to subscription requests given to
it from your web page. Don't have a web page that accepts sign up requests yet? You can also manually
import one or more subscribers from an existing list of names and email addresses.</p>

<p>As people sign up to receive your messages, lessons, or sales letters, they each start receiving
your predefined messages in the sequence you specify. There is virtually no limit to the number of 
different email campaigns or messages in a campaign that you may have.</p>

<p>You can develop one email campaign for prospective customers, another for past clients, and a
third for referral sources. The variety of uses for this service is limited only by your imagination.
These message can be plain text or HTML formatted.</p>
<form name='Start' action='http://www.lightning-mortgage.com/pr/login.php' method="post">
<input class='submit' type='submit' name='Login' id='Login' value='Login' onClick="this.value='Login'"
onMouseover="this.className='MouseOver'" onMouseout="this.className='submit'" onfocus="if(this.blur) this.blur();">
</form>
<p>Problems? Email <a href='mailto:anthony@lightning-mortgage.com'>anthony@lightning-mortgage.com</a> for assistance.</p>
</div></div>
</BODY>
</HTML>