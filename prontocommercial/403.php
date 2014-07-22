<?php

header("HTTP/1.0 403 Forbidden");

function SendMessage($Subject, $Message)
{
	$IPaddr = GetIP();
	$text = $Message;
	$html = '<html><body>'.nl2br($Message).'</body></html>';
	$crlf = "\n";

	$To = "prontocommercial";
	$To .= "@gmail.com";
		// the email address of the person receiving the email
	$From = addslashes("Web Surfer")."<anthony@prontocommercial.com>";
	$SendDate = date('r');

	$To = $To; //.", ".$cc;
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
	$headers .= 'From: ' . $From . "\r\n";
	$headers .= 'Reply-To: ' . $replyto . "\r\n";

	//print("to: $To<br>subject: $Subject<br>headers: $headers<br>message:<br>$Message");
	$sent = mail($To,$Subject,$Message,$headers);

	if ($sent == true)
		return('1');
	else
		return('E');
}


//~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ 	\\
//												\\
// Get the visitor's IP Address			\\
//												\\
//~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~	\\

function GetIP()
{
if ($_SERVER)
{
	if ( $_SERVER[HTTP_X_FORWARDED_FOR] )
	{
	$realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	}
	elseif ( $_SERVER["HTTP_CLIENT_IP"] )
	{
	$realip = $_SERVER["HTTP_CLIENT_IP"];
	}
	else
	{
	$realip = $_SERVER["REMOTE_ADDR"];
	}
}
else
{
	if ( getenv( 'HTTP_X_FORWARDED_FOR' ) )
	{
	$realip = getenv( 'HTTP_X_FORWARDED_FOR' );
	}
	elseif ( getenv( 'HTTP_CLIENT_IP' ) )
	{
	$realip = getenv( 'HTTP_CLIENT_IP' );
	}
	else
	{
	$realip = getenv( 'REMOTE_ADDR' );
	}
}

return $realip;
}


$IPaddr = GetIP();
//print("Referrer name 2: ". $_SERVER['REQUEST_URI']);

if ($_SERVER['REQUEST_URI'] != "/404.php")
{
	$s=$_SERVER['REQUEST_URI'];
	$s=ereg_replace("&","|",$s);
	$raw=$s=ereg_replace("\?","|",$s);
	$Start = 3 + strpos($s,"|q=");
	if ($Start < 4)   //if not found
	{
		$raw="'q=' not found in |".$s."|";
		$Start = 3 + strpos($s,"|p=");  //try this for a Yahoo search
	}
	else
		$raw="'q=' found in |".$s."| at position ".$Start;
	$s=substr($s,$Start);
	$End=strpos($s,"|");

	if ($End > 0)
		$Searched=substr($s, 0, $End);
	else
		$Searched=$s;
	$Searched=eregi_replace("\+"," ",$Searched);
	$Searched=eregi_replace("%20"," ",$Searched);
	$Searched=eregi_replace("%25","%",$Searched);
	$Searched=eregi_replace("%3F","?",$Searched);

	$s=substr($_SERVER['REQUEST_URI'],7);
	$x = strpos($s,"/");
	if($x > 0)
		$SearchEngine = substr($s, 0, $x);
	else
		$SearchEngine = $s;
	$Message = "<p>Search Engine (Referrer): '$SearchEngine', Search Term: '$Searched'</p>\n";
	//die("Testing |$Message|");

	$Message .= "</p><p>(message generated by '".$_SERVER['PHP_SELF']."')</p>.";
}


// ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~\\
// 																						\\
// If the new page wasn't found, we'll have to get input from the	\\
// visitor. The rest of the page is just a nicely done (if I do say so	\\
// myself) 403 Page Not Found error. 										\\
//																						\\
// ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~\\

	$Message = "<p>A request for page |".$_SERVER['REQUEST_URI']."| was unfilled because ... well ... you can't do that.</p>";
	$Message .= "<p>The visitor at IP address ".$IPaddr.", ".gethostbyaddr($IPaddr)." could not be redirected because there is no replacement page.</p>";

	if ($_SERVER['REQUEST_URI'] == "/403.php")
		$Message .= "<p>Had this been a real error, you would have been told to stay calm and update the 403 error handler.</p>";
	else
		$Message .= "<p>The error handler page, 403.php, doesn't have a redirect page for this page. Please investigate ASAP.</p>";

	$Message .= "<p>User agent: ".  $_SERVER['HTTP_USER_AGENT'] . "</p>\n";

	$Message .= "<p>host name: ".  gethostbyaddr($_SERVER['REMOTE_ADDR']) . "</p>\n";
	if ($_SERVER['REQUEST_URI'] != "")
		$Message .= "<p>Referrer name: ".  $_SERVER['REQUEST_URI'] . "</p>\n";

	$Message .= "<p>(message generated by '".$_SERVER['PHP_SELF']."')</p>\n.\n";
	$Subject = "Pronto Commercial: Error From IP ".$IPaddr." Unsuccessful Redirect of Web Page ".$_SERVER['REQUEST_URI'];

	//die("Subject: $Subject<br>Message: $Message");

	SendMessage($Subject, $Message);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset=utf-8>
	<base href="http://www.prontocommercial.com" >
	<title>403 Error - Not Permitted</title>
	<link rel="SHORTCUT ICON" href=
	"http://www.prontocommercial.com/favicon.ico">
	<?php include("./include/head.php"); ?>
	<style type='css/text'>
	#sl, #speedSlider {display:hidden;}
	</style>
	</head>

<body>
	<?php include("./include/top.php"); ?>
				<h1>Excuse me, but you can't go there...</h1>				<h3>Excuse me, but you can't go there...</h3>

				<p>A request for page was unfilled because ... well ... you can't do that.</p>

				<p>
				Surely, you'll soon be on your way and forget about this little web page screw-up.</p>

				<p>
				Click on <a href="javascript:history.back()">RETURN</a> to
				return to the previous page.</p>

<p><br>&nbsp;</p>
<?php include("./include/bottom.php"); ?>
</body>
</html>
