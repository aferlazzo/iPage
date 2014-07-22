<?php
$value = 'something from somewhere';

setcookie("TestCookie", $value,0,'/'); /* expire at end of session */
//setcookie("TestCookie", $value, time()+3600,'/');  /* expire in 1 hour */
//setcookie("TestCookie", $value, time()+3600, "/", ".example.com", 1);

// Print an individual cookie
echo "Our cookie: ". $_COOKIE["TestCookie"] . " all cookies: ";

// Another way to debug/test is to view all cookies
print_r($_COOKIE);
?>
