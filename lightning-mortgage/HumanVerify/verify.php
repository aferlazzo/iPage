<? 
//First fetch the value submitted by the user
$HumanVerifyId=$HTTP_POST_VARS["HumanVerifyID"];

//Then send this value to HumanVerify and fetch the results 
$html = join(file("http://www.humanverify.com/a2zverify/a2zcheck.asp?u=lightning&id=$HumanVerifyId"),''); 

//compare results
if ($html=="True"){
	//If results was True, this is a valid user
	print "<h1>Valid User</h1>";
}else{
	//else the user is invalid
	print "<h1>Invalid User</h1>";
}

?>