<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright � Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/

	$UserName = $_POST[UserName];
	$pwd = $_POST[pwd];
	$Redirect=$_POST[Redirect];
	if ($UserName == "")
	{
?>
<script type="text/javascript">
alert("Please enter User Name");
window.history.go(-1);
</script>
<?php
    }
	
	if ($pwd == "")
	{
?>
<script type="text/javascript">
alert("Please enter password");
window.history.go(-1);
</script>
<?php
    }
	
	//print("loginaction. (".__LINE__.") not connected");
	include("conn.php");	
	$result = mysql_query("SELECT * FROM admin where adminname = '$UserName'", $link) or die("Login process is terminating: Cannot access the administration database"); 
	$num_rows = mysql_num_rows($result); 	
	mysql_close($link);
		
	if($num_rows > 0)
	{
		mysql_data_seek($result, 0);
		$row = mysql_fetch_object($result);
		$pwdlen=strlen($row->adminpwd);

		if ($pwdlen==0)
		{
		  //die("password length ".$pwdlen);
?>
<script type="text/javascript">
alert("No match on password");
window.location.replace('/pr/login.php');
</script>
<?php
		}

		if(strcmp($row->adminpwd,$pwd)==0)
		{
			setcookie("UName",$UserName, time()+60*60*2400,"/"); //cookie expires in 100 days (24 hours * 100)
?>
<script type="text/javascript">
//alert("logined in!");
window.location.href='/pr/PerfectResponse.htm';
</script>
<?php
		}	
		//die("admin password from db: $row->adminpwd<br />Password Entered $pwd");  
?>
<script type="text/javascript">
window.location.href="PasswordError.php?U=<?php echo $UserName ?>";
</script>
<?php
	}	
	else
	{
?>
<script type="text/javascript">
<!--
var UUU="<?php echo $UserName ?>";
alert("Login Name "+UUU+" not registered.");
window.location.replace('/pr/login.php');
//-->
</script>
<?php
	}
?> 