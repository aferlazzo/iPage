<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright � Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/
print("<style type='text/css'>\n");	
print("@import 'PerfectResponse.css';\n");
print("h1, h2, p {color:#039;font-family:verdana;white-space:nowrap;}\n");
print("</style>\n");

$Destination = "images";
print("<p>Uploaded Images Directory<br />'http://www.lightning-mortgage.com/pr/uploadedimages/'</p>"); 
if ($handle = opendir("uploadedimages")) {
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
            print("<p>$file</p>");
        }
    }
    closedir($handle);
}
?>
