<?php

print("<h1>Running script from ".$_SERVER['SERVER_NAME']."</h1>");
$SMTP_HOST = "tls://smtp.gmail.com";
$SMTP_PORT = 465;
$sock = @fsockopen("$SMTP_HOST", $SMTP_PORT, $errno, $errstr, 30); 
echo "<br />Connection attempt to $SMTP_HOST on port $SMTP_PORT results: "; 
//var_dump($sock); 
if ($errno > 0)
	echo "Error# " . $errno . ". Error message: " . $errstr . "<br/>";
else
	echo "Success!<br />";

$SMTP_HOST = "ssl://smtp.att.yahoo.com"; 
$SMTP_PORT = 465; 
$sock = @fsockopen("$SMTP_HOST", $SMTP_PORT, $errno, $errstr, 30); 
echo "<br />Connection attempt to $SMTP_HOST on port $SMTP_PORT results: "; 
//var_dump($sock); 
if ($errno > 0)
	echo "Error# " . $errno . ". Error message: " . $errstr . "<br/>";
else
	echo "Success!<br />";

$SMTP_HOST = "tcp://mail.prontocommercial.com"; 
$SMTP_PORT = 25; 
$sock = @fsockopen("$SMTP_HOST", $SMTP_PORT, $errno, $errstr, 30); 
echo "<br />Connection attempt to $SMTP_HOST on port $SMTP_PORT results: "; 
//var_dump($sock); 
if ($errno > 0)
	echo "Error# " . $errno . ". Error message: " . $errstr . "<br/>";
else
	echo "Success!<br />";

$SMTP_HOST = "tcp://mail.lightning-mortgage.com"; 
$SMTP_PORT = 25; 
$sock = @fsockopen("$SMTP_HOST", $SMTP_PORT, $errno, $errstr, 30); 
echo "<br />Connection attempt to $SMTP_HOST on port $SMTP_PORT results: "; 
//var_dump($sock); 
if ($errno > 0)
	echo "Error# " . $errno . ". Error message: " . $errstr . "<br/>";
else
	echo "Success!<br />";

?>
