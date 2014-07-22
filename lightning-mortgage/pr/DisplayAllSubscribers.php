<?php
$user = $_COOKIE["UName"];
include ("conn.php");
$WithinScript = "I am embedded in another script";
include("settings.php");

/*

Perfect Response - Email Marketing at Its Best!
Copyright © Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<HTML>
<HEAD>
<TITLE>Display All Subscribers</TITLE>
<meta name="robots" content="NoIndex, NoFollow">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="./css/PerfectResponse.css">
<link rel="stylesheet" type="text/css" href="./css/niftyCorners.css">
<script type="text/javascript" src="./js/PerfectResponse.js"></script>
<script type="text/javascript" src="./js/nifty.js"></script>
<style type="text/css">
th, td {font-family: Verdana, Arial, Helvetica;font-size:8pt;white-space:nowrap;}
td {font-weight:normal;}
</style>
</HEAD>
<BODY>
<div id='ProgressBarOutline'><div id='ProgressBar'></div></div>

<div id="Wrapper"><div id="xxx">

<TABLE id="content" style='text-align:left;'>
<?php
$ar_result = mysql_query("SELECT * FROM autoresponders where user='$user'", $link);
$ar_row = mysql_fetch_object($ar_result);
$num_rows_ar = mysql_num_rows($ar_result);
if($num_rows_ar > 0)
{
	print ("<tr><th colspan='3' style='text-align:center;'><h2>All Subscribers In All Campaigns</h2></th></tr>\n");
	print ("<tr><th colspan='3'><p>");
	print ("As of ".date('l F j, Y g:i A')."</p></th></tr>\n");	
	print ("<tr><th>Del Edit </th><th style='width:400px;text-align:left;'>Name &lt;Email Address&gt;</th>\n");
	print ("<th style='width:300px;'>Campaign Number and Name</th><th style='width:150px;text-align:right;'>Msg #</th></tr>\n");

	for($ccount=0;$ccount<$num_rows_ar;$ccount++)
	{	
		mysql_data_seek($ar_result, $ccount);
		$ar_row	= mysql_fetch_object($ar_result);
		$arid = $ar_row->arid;
		$SQL_Statement = "select * from users where currentmsg < 253 and arid=$arid order by fname";
		$Query_Result = mysql_query($SQL_Statement);
		$num_rows_usr = mysql_num_rows($Query_Result);
		$TotalSubscribers = $num_rows_usr;

		if ($num_rows_usr > 0)
		{
			for($ucount=0;$ucount<$num_rows_usr;$ucount++)
			{	
				mysql_data_seek($Query_Result, $ucount);
				$rowSubscriber 			= mysql_fetch_object($Query_Result);
				$Email_Address 			= $rowSubscriber->email;
				$MessageNumberInSequence= $rowSubscriber->currentmsg;
				$TimeToSendMsg 			= $rowSubscriber->senddate;
				$Full_Name 				= trim($rowSubscriber->fname." ".$rowSubscriber->lname);
				$MsgNumber				= $rowSubscriber->currentmsg;
				$uid					= $rowSubscriber->uid;
				
				$ThisTR = $ar_row->arid."Row".$ucount;
				print ("<tr id='$ThisTR' onMouseover='this.style.backgroundColor=\"#fff\";' onMouseout='this.style.backgroundColor=\"transparent\"'>");
			print("<form name='MyForm$ThisTR' method='post' target='Main' action='EditSubscriberAction.php'>\n");
			print("<td><input id='chk$ThisTR' class='radiogroup' type='checkbox' style='height:16px;margin:0 5px 0 5px;padding:0;vertical-align:bottom;' onclick='DeleteRow(\"$Email_Address\", $arid, $ucount);'>\n");

			print("<input type='hidden' name='Returned' value='false'>\n");
			print("<input type='hidden' name='arid'  value='$arid'>\n");
			print("<input type='hidden' name='Email' value='$Email_Address'>\n");
			print("<input type='hidden' name='uid'   value='$uid'>\n");
			print("<input type='hidden' name='vtype' value='email'>\n");
			print("<input id='Editchk$ThisTR' class='radiogroup' type='checkbox' style='height:16px;margin:0;padding:0;vertical-align:bottom;' onclick='this.form.submit();'></form></td>\n");
	
	
	
				//print("<form name='MyForm$ThisTR' method='get'>\n");
				//print("<td> <input id='chk$ThisTR' class='radiogroup' type='checkbox' style='height:16px;margin:0;padding:0;vertical-align:bottom;' onclick='DeleteRow(\"$Email_Address\", $ar_row->arid, $ucount);'></form></td>\n");
				print ("<td>$Full_Name &lt;$Email_Address&gt;</td><td>$ar_row->arid $ar_row->ardescription</td><td style='text-align:right;'>$MsgNumber</td></tr>\n");
				print("<script type='text/javascript'>ProgressBar($ucount, $TotalSubscribers, 500);</script>\n");
				flush();
				ob_flush();
			}
		}
		else
		{	
			print("<script type='text/javascript'>ProgressBar(0, 100, 500);</script>\n");
			print("<tr><td><h2>You have not yet created any subscribers.</h2></td></tr>");
		}
	}
}
else
{
	print("<script type='text/javascript'>ProgressBar(0, 100, 500);</script>\n");
	print("<tr><td><h2>You have not yet created an email campaign</h2></td></tr>");
}
	
print("</table>\n");	

?>
</div></div>
</body>
</html>
