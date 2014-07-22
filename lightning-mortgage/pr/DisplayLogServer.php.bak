<?php
if (isset($_GET['CFname']))  //for testing use command line URI
	$CFname = $_GET['CFname'];
else
	$CFname = $_POST['CFname'];

	if(CFname=="")
		echo "File Name is unknown";
/*
echo $CFname;
*/
$handle = fopen($CFname, "w");
fclose($handle);
echo("T");
?>
