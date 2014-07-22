<?php
session_start();
print("<img src='captcha.png'><br />string<br />");
//Encrypt the posted code field and then compare with the stored key
if(md5($_POST['code']) != $_SESSION['key'])
{
die("Error: You must enter the code correctly");
}else{
echo 'You entered the code correctly';
}
?>