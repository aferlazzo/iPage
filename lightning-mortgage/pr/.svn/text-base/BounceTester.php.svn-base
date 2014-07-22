<?php
/*
 * BounceTester.php
 */

?><HTML>
<HEAD>
<TITLE>Bounce Tester - Perfect Response</TITLE>
<style type="text/css">
body {font-family:Verdana,Arial,Helvetica,sans-serif;}
</style>
</HEAD>
<BODY>
<?php

	require("pop3.php");

	$u=$_GET['u'];
	$p=$_GET['p'];
	$debugscript=$_GET['debug']; 
//die("|$debugscript|$u|$p|");
	if ($debugscript == "")
		$d=0;
	else
		$d=1;

	$pop3=new pop3_class;
	$pop3->hostname="mail.lightning-mortgage.com";/* POP 3 server host name                 */
	$pop3->port=110;                         /* POP 3 server host port                      */
	if($u=="")
	{
	$user="EmailCampaigns@lightning-mortgage.com";  /* Authentication user name             */
	$password="pr";                          /* Authentication password                     */
	}
	else
	{
	$user=$u."@lightning-mortgage.com"; 
	$password=$p;
	}
	$pop3->realm="";                         /* Authentication realm or domain              */
	$pop3->workstation="";                   /* Workstation for NTLM authentication         */
	$apop=0;                                 /* Use APOP authentication                     */
	$pop3->authentication_mechanism="USER";  /* SASL authentication mechanism               */
	$pop3->debug=$d;                         /* If = 1, output debug information            */
	$pop3->html_debug=1;                     /* Debug information is in HTML                */
	$pop3->join_continuation_header_lines=1; /* Concatenate headers split in multiple lines */

	if(($error=$pop3->Open())=="")
	{
		if($pop3->debug == 1)
			echo "<PRE>Connected to the POP3 server &quot;".$pop3->hostname."&quot;.</PRE>\n";
		if(($error=$pop3->Login($user,$password,$apop))=="")
		{
			echo "<h2>User &quot;$user&quot; is Logged In</h2>\n";
			if(($error=$pop3->Statistics($messages,$size))=="")
			{
				echo "<h2>There are $messages messages in the mailbox</h2>\n"; //with a total of $size bytes.</h1>\n";
				$result=$pop3->ListMessages("",0);
				$Pattern="^From:.+MAILER-DAEMON@.*";
				if(GetType($result)=="array")
				{
					if($messages>0)
					{
						for($MsgNo=1;$MsgNo<=$messages;$MsgNo++)
						if(($error=$pop3->RetrieveMessage($MsgNo,$headers,$body,-1))=="")// -1 = entire messages
						{	
							for($HdrNo=0; $HdrNo<count($headers);$HdrNo++)
							{
								if(eregi($Pattern, $headers[$HdrNo]))
								{
									//echo "<PRE>regular expression match: Msg No. $MsgNo Header[$HdrNo] - ",HtmlSpecialChars($headers[$HdrNo]),"</PRE>\n";
									DetermineBadAddress($pop3, $MsgNo, $body);
									break;
								}
								if ($headers[$HdrNo]=="From: postmaster@hotmail.com")
								{		
									//echo "<PRE>hotmail.com match: Msg No. $MsgNo Header[$HdrNo] - ",HtmlSpecialChars($headers[$HdrNo]),"</PRE>\n";
									HotmailBadAddress($pop3, $MsgNo, $body[10]);
									break;
								}
								if(substr($headers[$HdrNo],0,5) == "From:")
									echo "NONSTANDARD: |",HtmlSpecialChars($headers[$HdrNo]),"|<br />";
							}
							
							if($HdrNo >= count($headers)) //if message not standard format...
							{
								echo "<h2>Msg No. $MsgNo Header:</h2>";
								for($line=0;$line<count($headers);$line++)
								{
									If ((substr(strtolower($headers[$line]),0,5)== "date:") ||
									    (substr(strtolower($headers[$line]),0,5)== "from:") ||
									    (substr(strtolower($headers[$line]),0,3)== "to:") ||
									    (substr(strtolower($headers[$line]),0,8)== "subject:"))
									echo HtmlSpecialChars($headers[$line]),"<br />\n";
								}
								echo "<h2>Msg No. $MsgNo Message:</h2>";
								$htmlText='t';
								for($line=0;$line<count($body);$line++)
								{
$string=eregi_replace("\'|\"","",$body[$line]);
$pos=strpos(strtolower($string),"meta http-equiv=content-type content=text/html");
if($pos !== FALSE) //note: !== has special meaning, "I found it"
{
  echo "<h2>html content...</h2>";
  $htmlText='h';
}
else
{
	$pos=strpos(strtolower($string),"meta content=text/html");
	if($pos !== FALSE) //note: !== has special meaning, "I found it"
	{
	  echo "<h2>html content...</h2>";
	  $htmlText='h';
	}
	else
	{
		$pos=strpos(strtolower($string),"content-type: text/html");
		if($pos !== FALSE) //note: !== has special meaning, "I found it"
		{
		  echo "<h2>html content...</h2>";
		  $htmlText='h';
		}
		else
		{
			$pos=strpos(strtolower($string),"content-disposition: attachment;");
			if($pos !== FALSE) //note: !== has special meaning, "I found it"
			{
			  echo "<h2>attachment here...</h2>";
			  $htmlText='a';
			}
		}
	}
}
/*
$string=substr(strtolower($body[$line]),1,49);
$string=eregi_replace("\'|\"","",$string);
if(substr($string,0,4)=="meta")
	echo $string,"<br />";
*/
if ($htmlText=='t')
	echo HtmlSpecialChars($body[$line]),"<br />\n";
								}
							}
						}
					}
					if($error==""
					&& ($error=$pop3->Close())=="")
					{
						if($messages > 0)
							echo "<h1>End of Messages</h1>";
						if($pop3->debug == 1)
							echo "<PRE>Disconnected from the POP3 server &quot;".$pop3->hostname."&quot;.</PRE>\n";
					}
				}
				else
					$error=$result;
			}
		}
	}
	if($error!="")
		echo "<H2>Error: ",HtmlSpecialChars($error),"</H2>";

if(($messages > 0) && ($u == ""))
{						
?>
<script type="text/javascript">
if(confirm("Do you want to process the bounced messages?") == true)
  document.location="BounceHandler.php";
</script>
<?php
}
else
{
?>
<script type="text/javascript">
if(confirm("Ok?") == true)
  window.history.go(-1);
</script>
<?php
}
function HotmailBadAddress($pop3, $MsgNo, $line)
{
	//echo "<PRE>Msg No. $MsgNo Message[10]  - ",HtmlSpecialChars($line),"</PRE>\n";

	$BadAddr = trim($line);
	//print("Msg No. $MsgNo - Bad email found: $BadAddr<br />");

	if(($error=$pop3->DeleteMessage($MsgNo))=="")
	{
		//echo "<PRE>Marked message ",$MsgNo," for deletion.</PRE>\n";

		if(($error=$pop3->ResetDeletedMessages())=="")
		{
			//echo "<PRE>Reset the list of messages to be deleted.</PRE>\n";
		}
	}
}


function DetermineBadAddress($pop3, $MsgNo, $body)
{
for($line=0;$line<count($body);$line++)
{
	$Pattern =" \(unrecoverable error\)";
	$Addr = ereg_replace($Pattern, "", trim($body[$line]));

	//echo "<PRE>Msg No. $MsgNo Message[$line]  - ",HtmlSpecialChars($Addr),"</PRE>\n";
	
	  
//5.1.0 - Unknown address error 550-'5.1.1 unknown or illegal alias: jjordan11@midsouth.rr.com'	  
//12345678901234567890123456789012345678901234567890123456789012345678901234567890

	$Pattern="5.1.0 - Unknown address error 550-'5.1.1 unknown or illegal alias: ";

	if(substr($Addr,0,67) == $Pattern)
	{
		$Addr = ereg_replace($Pattern, "<", $Addr);
		$Addr = ereg_replace("'", "", $Addr);
		$Addr = $Addr.">";
		//print("Fixed: ".phplSpecialChars($Addr)."<br />");
	}
//The following message to <carolinaskies@carolina.rr.com> was undeliverable.	
	$Pattern ="(The following message to <)(.*)(> was undeliverable.)";
	$Addr = ereg_replace($Pattern, "\<\\2>", $Addr);
	//print("xxx $Addr<br>");

//Your mail to the following recipients could not be delivered because they are not accepting mail from
//next line is mailbox...

	$Pattern="Your mail to the following recipients could not be delivered because they are not accepting mail from";
	if(stristr($Addr, $Pattern) != false)
		$Addr="\<".$body[$line + 1]."@aol.com>";
	
//<markmorrison@consultant.com>): host
	$Pattern ="(.+)(>\): host)";
	$Addr = ereg_replace($Pattern, "\\1>", $Addr);

	$Addr = trim($Addr);
	$End = strlen($Addr) - 3;
	
	if (substr($Addr,0,1)=='<')
	{
	  if((substr($Addr,$End+1,2)==">:") || (substr($Addr,$End+2,1)==">"))
	  {
	  	$Pattern="^<?([0-9a-z]+)([ 0-9a-z\.-_]+)@([-_0-9a-z]+)\.([0-9a-z]+)([>:]+)?$"; //email address matching pattern
		$Replace="\\1\\2@\\3.\\4";
		$BadAddr=eregi_replace($Pattern, $Replace, $Addr);
		/*
		print("<PRE>   Addr:|".phplSpecialChars($Addr)."|</PRE><br />");
		print("<PRE>Replace:|".phplSpecialChars($Replace)."|</PRE><br />");
		print("<PRE>Pattern:|".phplSpecialChars($Pattern)."|</PRE><br />");
		print("<PRE>BadAddr:|".phplSpecialChars($BadAddr)."|</PRE><br />");
		*/
	    print("<h2>Msg No. $MsgNo - Bad email found: ".phplSpecialChars($BadAddr)."</h2>");

		if(($error=$pop3->DeleteMessage($MsgNo))=="")
		{
			//echo "<PRE>Marked message ",$MsgNo," for deletion.</PRE>\n";

			if(($error=$pop3->ResetDeletedMessages())=="")
			{
				//echo "<PRE>Reset the list of messages to be deleted.</PRE>\n";
			}
		}
		break;
	  }
	}
}
}
?>

</BODY>
</HTML>
