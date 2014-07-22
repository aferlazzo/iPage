<?php

// Swift Mailer is located within the 'pr' directory
//print($_SERVER['SERVER_NAME']);
 
if (($_SERVER['SERVER_NAME'] == "www.lightning-mortgage.com") || ($_SERVER['SERVER_NAME'] == "lightning-mortgage.ipower.com"))
{
 if(define("DEFAULT_LIBRARY_PATH", "/home/users/web/b668/ipw.lightning-mortgage/public_html/pr/Swift-3.3.1-php4/lib") == false)
 	die("DEFAULT_LIBRARY_PATH define failed");
}
else
if ($_SERVER['SERVER_NAME'] == "www.prontocommercial.com")
{
	if (define("DEFAULT_LIBRARY_PATH", "/home/users/web/b1398/ipw.prontoco/public_html/pr/Swift-3.3.1-php4/lib") == false)
	 	die("DEFAULT_LIBRARY_PATH define failed");
}
else
	die("SwiftNeeded (".__LINE__.") No match for Server Name ".$_SERVER['SERVER_NAME']);

require_once DEFAULT_LIBRARY_PATH . '/Swift.php';
require_once DEFAULT_LIBRARY_PATH . "/Swift/Connection/SMTP.php";

//In order for the SMTP connection to perform authentication, some “Authenticator” classes are used. 
//These are individual units of code which know how to perform some common authentication procedures 
//over SMTP. The procedures are “LOGIN”, “PLAIN” and “CRAM-MD5”. 
//require_once DEFAULT_LIBRARY_PATH . "/Swift/Authenticator/LOGIN.php";
//require_once DEFAULT_LIBRARY_PATH . "/Swift/Authenticator/PLAIN.php";
//require_once DEFAULT_LIBRARY_PATH . "/Swift/Authenticator/CRAMMD5.php";
//if it could be used...
//require_once DEFAULT_LIBRARY_PATH . '/Swift/Authenticator/$PopB4Smtp$.php';
/* alternative method...*/
require_once DEFAULT_LIBRARY_PATH . '/class.pop3.php';

    /**
     * Changes every end of line from CR or LF to CRLF.  
     * return string
     */
if (!function_exists(FixEOL))
{    function FixEOL($str) 
	{
		$LE = "\n";

        $str = str_replace("\r\n", "\n", $str);
        $str = str_replace("\r", "\n", $str);
        $str = str_replace("\n", $LE, $str);
        return $str;
    }
}


if (!function_exists(WrapText))
{
	/**
     * Wraps message for use with mailers that do not
     * automatically perform wrapping and for quoted-printable.
     * return string
     */
    function WrapText($TextMessage, $MaxLineLength, $qp_mode = false) 
	{
		$LE = "\n";
        $soft_break = ($qp_mode) ? sprintf(" =%s", $LE) : $LE;

        $TextMessage = FixEOL($TextMessage);
        if (substr($TextMessage, -1) == $LE)
            $TextMessage = substr($TextMessage, 0, -1);

        $Line = explode($LE, $TextMessage); //separate file by new line characters
        $TextMessage = "";
        for ($i=0 ;$i < count($Line); $i++)  //for each line
        {
          $LineArray = explode(" ", $Line[$i]); //separate into words
          $LineBuffer = "";
          for ($e = 0; $e<count($LineArray); $e++)  //for each word
          {
              $Word = $LineArray[$e];  
              if ($qp_mode and (strlen($Word) > $MaxLineLength))
              {
                $space_left = $MaxLineLength - strlen($LineBuffer) - 1;
                if ($e != 0)  //if not on 1st line
                {
                    if ($space_left > 20)
                    {
                        $len = $space_left;
                        if (substr($Word, $len - 1, 1) == "=")
                          $len--;
                        elseif (substr($Word, $len - 2, 1) == "=")
                          $len -= 2;
                        $part = substr($Word, 0, $len);
                        $Word = substr($Word, $len);
                        $LineBuffer .= " " . $part;
                        $TextMessage .= $LineBuffer . sprintf("=%s", $LE);
                    }
                    else
                    {
                        $TextMessage .= $LineBuffer . $soft_break;
                    }
                    $LineBuffer = "";
                }
				
                while (strlen($Word) > 0)
                {
                    $len = $MaxLineLength;
                    if (substr($Word, $len - 1, 1) == "=")
                        $len--;
                    elseif (substr($Word, $len - 2, 1) == "=")
                        $len -= 2;
                    $part = substr($Word, 0, $len);
                    $Word = substr($Word, $len);

                    if (strlen($Word) > 0)
                        $TextMessage .= $part . sprintf("=%s", $LE);
                    else
                        $LineBuffer = $part;
                }
              }
              else
              {
                $buf_o = $LineBuffer;
                $LineBuffer .= ($e == 0) ? $Word : (" " . $Word); 

                if (strlen($LineBuffer) > $MaxLineLength and $buf_o != "")
                {
                    $TextMessage .= $buf_o . $soft_break;
                    $LineBuffer = $Word;
                }
              }
          }
          $TextMessage .= $LineBuffer . $LE;
        }

        return $TextMessage;
    }
}
if (!function_exists(WrapTest))
{
function WrapTest()
{
	$MessageText  = "A few weeks ago we sent our Glazer-Kennedy Insider's Circle? Members a letter giving them ONE OF THE MOST GENEROUS AND EXCITING FREE OFFERS that we've ever extended, including a FREE Sales Strategies Seminar, this September.\n";
	$MessageText .= "The event was sold out BUT ...\n";
	$MessageText .= "The Good News is that we've had some cancellations!  Boy are those poor souls going to miss out.\n";
	$MessageText .= "The Bad News is that we've only got 5 seats available.\n";
	$MessageText .= "This is your ONLY CHANCE and you'll need to hurry to secure your seat.  To find out all the details click onto the link below:\n";
	$MessageText .= "http://www.dankennedy.com/strategyseminar/\n";
	$MessageText .= "You don't want to miss this one-of-a-kind-event.  As you know, it's increasingly rare to get me personally presenting new or advanced material in a relatively small group setting. This is a Seminar you get to BE A PART OF AND PARTICIPATE IN, not \"just attend.\"\n";
	$MessageText .= "Don't miss out twice!";
	$Formatted = WrapText($MessageText, 75);
	print("<pre>$Formatted</pre");
}
}

if (!function_exists(SendUsingPOPB4SMTPauthentication))
{
function SendUsingPOPB4SMTPauthentication($SMTP_HOST, $POP3_HOST, $POP3_USER, $POP3_PASS, $SMTPTimeout, $SMTP_PORT)
{	
	$smtp = new Swift_Connection_SMTP("$SMTP_HOST", $SMTP_PORT); //create a new instance of the smtp connector loading the server name and the smtp port for the campaign
	/*
	print("<h3>SwiftNeeded (".__LINE__.") default Timeout: ".$smtp->getTimeout()."<br />\n");
	print("<h3>SwiftNeeded (".__LINE__.") port: ".$smtp->getPort()."<br />\n");
	print("<h3>SwiftNeeded (".__LINE__.") server: ".$smtp->getServer()."<br />\n");
	*/
	$smtp->setTimeout($SMTPTimeout);
	//print("<h3>SwiftNeeded (".__LINE__.") new Timeout: ".$smtp->getTimeout()."<br />\n");
		
	//If it could be used, we'd load the PopB4Smtp authenticator with the pop3 hostname
	//$smtp->attachAuthenticator(new Swift_Authenticator_PopB4Smtp("$POP3_HOST"));
		
	/* alternative method...*/

	$pop = new POP3();  //Needed only once, only if the smtp server uses pop before smtp authenication.
	//The Authorise parameters are as follows:
	//$pop->Authorise('pop3.example.com', 110, 30, 'mailer', 'password', 1);
	//1. pop3.example.com - The POP3 Mail Server Name (hostname or IP address)
	//2. 110 - The POP3 Port on which to connect (default is usually 110, but check with your host)
	//3. 30 - A connection time-out value (in seconds)
	//4. mailer - The POP3 Username required to logon
	//5. password - The POP3 Password required to logon
	//6. 1 - The class debug level (0 = off, 1+ = debug output is echoed to the browser)

	$pop->Authorise("$POP3_HOST", 110, 30, "$POP3_USER", "$POP3_PASS", 1);
		
	//Here is where the problem OLD resides: These smtp variables cannot be sent to ipowerweb, so the swift popb4smtp cannot be used
	$smtp->setUsername("$POP3_USER");  
	$smtp->setPassword("$POP3_PASS");
				
	//die("before creating Swift Instance");
		
	// this is where we attempt to do all that we have set-up to this point
		
	$swift =& new Swift($smtp);
	return($swift);
}
}
// - - - - - - - - - - - - - - // - - - - - - - - - - - //
//														//
//	SwiftMailer: This is where all email is sent out	//
//										 				//
//  - - - - - - - - - - - - // - - - - - - - - - - - - -//

if (!function_exists(SwiftMailer))
{
	function SwiftMailer($ToEmail, $ToName, $Subject, $TextBody, $HTMLBody, $Attachment, $HTML, $arid, $SMTPDebugging, $SMTPTimeout)
	{
		GLOBAL $EmailAddressReplyTo, $debugIt, $Installation_Path, $Display_Name, $SMTPport, $EmailAddressFrom;
		GLOBAL $SMTPmailServer, $SMTPmailbox, $SMTPpassword, $Wrap_On, $Length_Of_Wrap; //read from the system configuration

		logMessage("SwiftNeeded (".__LINE__.") SwiftMailer setup check: SMTPDebugging |$SMTPDebugging| SMTPTimeout |$SMTPTimeout|");
		logMessage("SwiftNeeded (".__LINE__.") Name |$ToName| Subject |$Subject|");
			
		//die("$HTMLBody");	
		
		if(($TextBody == "") && ($HTMLBody == ""))
		{
			logMessage("SwiftNeeded (".__LINE__.") message is empty");
			die("<h1>SwiftNeeded (".__LINE__.") message is empty</h1>");
		}
	
		$Sent = false;
		
		// in addition to mailout.php, 6 other scripts send out email
		if (($_SESSION['LockKey'] != "InstantTestAction.php") //if not a one-off email request then honor the kill switch
		&& ($_SESSION['LockKey'] != "AddAction.php") 
		&& ($_SESSION['LockKey'] != "BroadcastAllAction.php") 
		&& ($_SESSION['LockKey'] != "optin.php") 
	 	&& ($_SESSION['LockKey'] != "RemoveAction.php.php") 
		&& ($_SESSION['LockKey'] != "RetrievePassword.php") 
		&& ($_SESSION['LockKey'] != "us.php"))
		{
	  		if((file_exists("mailout.stop")))  // If this file exists, the script will end. This is a kill switch.
				die(logMessage ("SwiftNeeded (".__LINE__.") KILL SWITCH: A file named mailout.stop exists. Script halted."));
		}

		// Create a Swift instance. In order to do this, we are using the smtp protocol. There are 4 methods of authentication:
		// none, popb4smtp, ssl, and tls.
		//ipowerweb uses popb4smtp. It uses the default port of 25
		//sbcglobal uses ssl. The (standard) port it uses is 465
		$SMTP_HOST = $SMTPmailServer;
		$POP3_HOST = $SMTPmailServer; //ipowerweb servers use the same pop3 name as smtp servers
		$POP3_USER = $SMTPmailbox;
		$POP3_PASS = $SMTPpassword;
		$FROM_NAME = $Display_Name;
		$FROM_ADDRESS = $EmailAddressFrom;
		//die("SwiftNeeded (".__LINE__.") SMTP port |$SMTPport|");
		$SMTP_PORT = $SMTPport;
		$SMTP_ENCRYPTION = false;
		//Connect to localhost on port 25

		// this is untested but probably works: $swift =& new Swift(new Swift_Connection_SMTP("localhost"));
		
		//print("SwiftNeeded (".__LINE__.") \$SMTP_HOST $SMTP_HOST \$POP3_HOST $POP3_HOST \$POP3_USER $POP3_USER \$POP3_PASS $POP3_PASS<br />");
		$swift = SendUsingPOPB4SMTPauthentication($SMTP_HOST, $POP3_HOST, $POP3_USER, $POP3_PASS, $SMTPTimeout, $SMTP_PORT);
		/*
		The SMTP logging system provides the following levels of log information:

		0 = Off (Swift_Log::LOG_NOTHING or SWIFT_LOG_NOTHING in PHP4)
		1 = Errors only (Swift_Log::LOG_ERRORS or SWIFT_LOG_ERRORS in PHP4)
		2 = Failed deliveries (Swift_Log::LOG_FAILURES or SWIFT_LOG_FAILURES in PHP4)
		3 = Network commands (Swift_Log::LOG_NETWORK or SWIFT_LOG_NETWORK in PHP4)
		4 = Everything (Swift_Log::LOG_EVERYTHING or SWIFT_LOG_EVERYTHING in PHP4)

		Each succesive error level includes everything below it, so if you set an error level of “3” you’ll also get log entries as levels 1 and 2 being logged.

		To set the log level:
		*/
		$log =& Swift_LogContainer::getLog();
  		if ($SMTPDebugging == 1) //set in mailout depending on the system configuration setting
			$log->setLogLevel(SWIFT_LOG_NETWORK);
		else
			$log->setLogLevel(SWIFT_LOG_NOTHING);
		$log->setMaxSize(1); //It’s advised to set the log size to a maximum length of 1
		//Create the message instance. Make it HTML.
		//$message = new Swift_Message();
		if ($HTML == 1)
		{
			//$message->setContentType("text/html");
			$wrappedHTMLBody = htmlWrapper(addslashes($HTMLBody));
			$mmBody = stripslashes($wrappedHTMLBody);
			//$message->attach(new Swift_Message_Part("$mmBody", "text/html"));
			$message = new Swift_Message("$Subject", "$mmBody", "text/html");
		}
		else
		{
			if ($Wrap_On == 1)
				$mmBody = WrapText($TextBody, $Length_Of_Wrap);
			else
				$mmBody = $TextBody;
			//$message->attach(new Swift_Message_Part("$mmBody"));
			$message = new Swift_Message("$Subject", "$mmBody");
		}
			
		//$message->setSubject($Subject);
		//Create the sender from the details we've been given, depending on the smtp server
		$Sender = new Swift_Address("$FROM_ADDRESS", "$FROM_NAME");
		$Recipient = new Swift_Address("$ToEmail", "$ToName");
		
		//if ($Attachment != "")
			//$mail->AddAttachment("$Attachment");// attachment
	
		// check to see if connection is alive before sending
		
		/*$Stat = $smtp->isAlive();
		if($Stat == false)
		{
			print("<h3>SwiftNeeded (".__LINE__.") isAlive: false<br />\n");
		    die(logMessage("SwiftNeeded (".__LINE__.") Connect isAlive: false"));
		}
		*/

		//the send method throws a "Swift_ConnectionException" if an error occurs. We are instructing swift
		//that we expect an exception and if it happens we want to log the message produced by it.
		Swift_Errors::expect($e, "Swift_ConnectionException");
	
		//debugging: show me the message before it is sent:
		//this adds just enough delay to build the message...
		$stream =& $message->build();
		//print("SwiftNeeded (".__LINE__.") Message body |".$stream->readFull()."|"); //Dumps the email contents
		
		
		//Now check if Swift actually sends it
		$Sent = $swift->send($message, $Recipient, $Sender); 
		if ($e !== null)
		{
		    logMessage("SwiftNeeded (".__LINE__.") A send error occurred " . $e->getMessage());
		    print("<h3>SwiftNeeded (".__LINE__.") A send error occurred " . $e->getMessage() ."</h3>\n");
		}
		else 
			Swift_Errors::clear("Swift_ConnectionException");	
	
		//print("SwiftNeeded (".__LINE__.") Sent HTML message to $ToName &lt;$ToEmail&gt; via $SMTP_HOST");
		//$RetryCount++;
			
		//usleep(0500000);	// 0.5 seconds between sends
		sleep(2);				// at least 1 second between send attempts
		if ($Sent==false)
		{
			if ($debugIt > 0)
				logMessage("SwiftNeeded (".__LINE__.") * Error * NOT SENT, Message:'$ErrorInfo' &lt;$ToEmail&gt; '$Subject'");

			sleep(1); // 1 second between retries
		}
		else
		{
			if ($debugIt > 0)
				logMessage ("SwiftNeeded (".__LINE__.") Session |".$_SESSION['LockKey']."| sending to: $ToName &lt;$ToEmail&gt; Subject: |$Subject| SwiftMailer ".SWIFT_VERSION);
		}
		
		//To get data back out of the log:
		if ($SMTPDebugging == 1)
		{
			$log = Swift_LogContainer::getLog();
			$Log = $log->dump(true);
			//print("SwiftNeeded (".__LINE__.") debugging<br />$Log");
	        $LogArray = explode("\n", $Log); //separate log by new line characters
	        for ($i=0 ;$i < count($LogArray); $i++)  //for each line
				logSMTPmessage($LogArray[$i]);
		}
		
		return(true);
	}
}	
 
/* -------------------------------------------------------		
		if($Sent == false)
		{
			if ($debugIt > 0)
			{
				logMessage("SwiftNeeded (".__LINE__.") Retry Count was exceeded. '$ToName' &lt;$ToEmail&gt; Subject: $mail->Subject not sent");
				logMessage("SwiftNeeded (".__LINE__.") PHPmailer error: |$mail->ErrorInfo| SMTPmailbox |$mail->Username| SMTPpassword |$mail->Password| server |$SMTPmailServer| port |$SMTPport| SMTPDebugging |$SMTPDebugging| SMTPTimeout |$SMTPTimeout|");
				//logMessage("Body: $mail->Body");
				//logMessage("SwiftNeeded (".__LINE__.") error '$ToName' arid '$arid' server '$SMTPmailServer' Error Detail: " . $mail->ErrorInfo);		   
			}	
			return(false);
		}
		else
		{
		  //if in a frame the script is not being executed by a person visition the web site (imagecron)

		  print("<script type='text/javascript'>\n");
		  print("if(self.location != top.location)\n");  // if in a frame
		  print("{\n");
		
			if ($SMTPDebugging == 1)
			  	print ("document.writeln('<br /> - - - - SMTP: Debugging - Transaction Complete- - - - - - - - - <br />');\n");
		  print("}\n</script>\n");
		}
*/
?>
