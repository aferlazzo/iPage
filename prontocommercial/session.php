<?php
/*
//path to store variables (required by JustHost)
*/
session_save_path("/home/prontoc2/php"); 
session_start();

$_SESSION['security_code']= 'testing code passed';
$SessionCode = $_SESSION['security_code'];
print("Sending |$SessionCode|");
?>