<?php
include("conn.php");
//The baseline script will use Swiftmail version 4.0.6 to send smtp messages

//this causes the Swift Mailer to be autoloaded/included

require_once './Swift-4.0.6/lib/swift_required.php';
$Referrer		= $_GET['Referrer'];
$SenderName 	= $_GET['SenderName'];
$SenderEmail 	= $_GET['SenderEmail'];
$ReplytoName 	= $_GET['ReplytoName'];
$ReplytoEmail 	= $_GET['ReplytoEmail'];
$UserId 		= $_GET['UserId'];
$Password 		= $_GET['Password'];
$RecipientName 	= $_GET['RecipientName'];
$RecipientEmail = $_GET['RecipientEmail'];
$Subject 		= $_GET['Subject'];
$SMTPhost 		= $_GET['SMTPhost'];
$saved			= $SMTPport;
$SMTPport 		= $_GET['SMTPport'];

if($SMTPport == "")
	$SMTPport = $saved;
//die ($saved.'|'.$SMTPport);
$Encryption 	= $_GET['Encryption'];
$Debug 			= $_GET['Debug'];



//print("$Subject, $RecipientName, $RecipientEmail, $SenderName, $SenderEmail, $ReplytoName, $ReplytoEmail<br/>");
//print("$msg, $Debug, $SMTPhost, $SMTPport, $Encryption, $UserId, $Password");
//die("referrer: $Referrer");
/*
Creating Messages

Creating messages in Swift Mailer is done by making use of the various MIME entities provided with the library. 
Complex messages can be quickly created with very little effort.

1. Quick Reference for Creating a Message 
You can think of creating a Message as being similar to the steps you perform when you click the Compose button 
in your mail client. You give it a subject, specify some recipients, add any attachments and write your message.

2. Message Basics 
A message is a container for anything you want to send to somebody else. There are several basic aspects of a 
message that you should know.

3. Adding Content to Your Message 
Rich content can be added to messages in Swift Mailer with relative ease by calling methods such as setSubject(), 
setBody(), addPart() and attach().

4. Adding Recipients to Your Message 
Recipients are specified within the message itself via setTo(), setCc() and setBcc(). Swift Mailer reads these 
recipients from the message when it gets sent so that it knows where to send the message to.

5. Specifying Sender Details 
An email must include information about who sent it. Usually this is managed by the From: address, however there 
are other options.

6. Requesting a Read Receipt 
It is possible to request a read-receipt to be sent to an address when the email is opened. To request a read 
receipt set the address with setReadReceiptTo().

7. Setting the Character Set 
The character set of the message (and it's MIME parts) is set with the setCharset() method. You can also change the 
global default of UTF-8 by working with the Swift_Preferences class.

8. Setting the Line Length 
The length of lines in a message can be changed by using the setMaxLineLength() method on the message. It should be
kept to less than 1000 characters.

9. Setting the Message Priority 
You can change the priority of the message with setPriority(). Setting the priority will not change the way your 
email is sent – it is purely an indicative setting for the recipient.
*/

/*
1. To create a Message:

Call the newInstance() method of Swift_Message.
Set your sender address (From:) with setFrom() or setSender().
Set a subject line with setSubject().
Set recipients with setTo(), setCc() and/or setBcc().
Set a body with setBody().
Add attachments with attach().
*/
function CreateMessage($Debug, $Subject, $RecipientName, $RecipientEmail, $SenderName, $SenderEmail, $ReplytoName, $ReplytoEmail, $TextMsg, $HTMLmsg)
{
	if ($Debug == 2)
		print("SwiftTestAction (".__LINE__.") Subject |$Subject| RecipientName |$RecipientName| RecipientEmail |$RecipientEmail| SenderName |$SenderName| SenderEmail |$SenderEmail| ReplytoName |$ReplytoName| ReplytoEmail |$ReplytoEmail|");
		
	//1. Create the message
	$message = Swift_Message::newInstance();

	//3. Give it a body
	if($TextMsg != "")
		$message->setBody($TextMsg);
	else
		if($HTMLmsg != "")
			$message->setBody($HTMLmsg, 'text/html');
			
	//3a. And optionally an alternative body
	//$message->addPart($HTMLmsg, 'text/html');

	//3b. Optionally add optional attachments
	
	// ->attach(Swift_Attachment::fromPath('my-document.pdf'))
 
	//3c. Give the message a subject
	$message->setSubject($Subject);

	//4. Add recipients. Set the To addresses with an associative array
try{
	$message->setTo(array($RecipientEmail => $RecipientName));
}
catch (Swift_RfcComplianceException  $e)
{
	logMessage('SwiftTestAction.php ('.__LINE__.')  SetTo error: ' . $e->getMessage());
    print('SwiftTestAction.php ('.__LINE__.')  SetTo error: ' . $e->getMessage());	
}
	//5. Add sender details. Set the From address with an associative array
try{
	$message->setFrom(array($SenderEmail => $SenderName));
}
catch (Swift_RfcComplianceException  $e)
{
	logMessage('SwiftTestAction.php ('.__LINE__.')  SetFrom error: ' . $e->getMessage());
    print('SwiftTestAction.php ('.__LINE__.')  SetFrom error: ' . $e->getMessage());	
}
	;
	if (($ReplytoEmail != "") && ($ReplytoName != ""))
	{
		try{
		$message->setReplyTo(array($ReplytoEmail => $ReplytoName));
		}
		catch (Swift_RfcComplianceException  $e)
		{
			logMessage('SwiftTestAction.php ('.__LINE__.')  setReplyTo error: ' . $e->getMessage());
			print('SwiftTestAction.php ('.__LINE__.')  setReplyTo error: ' . $e->getMessage());	
		}
	}
	;
	//6. optional red-receipt
	//$message->setReadReceiptTo('your@address.tld');
	
	//7. Change the global setting (suggested)
	Swift_Preferences::getInstance()->setCharset('iso-8859-2');

	//8. Setting the Line Length	
	$message->setMaxLineLength(1000);

	return($message);
}
/*
To send a Message:

Create a Transport from one of the provided Transports – Swift_SmtpTransport, Swift_SendmailTransport, Swift_MailTransport or one of the aggregate Transports.
Create an instance of the Swift_Mailer class, using the Transport as it's constructor parameter.
Create a Message according to the instructions laid out in Creating Messages
Send the message via the send() or the batchSend() methods on the Mailer object.

Justhost SMTP port 465 - SSL
*/
function SendMessage($message, $Debug, $SMTPhost, $SMTPport, $Encryption, $UserId, $Password, $Referrer)
{
	if ($Debug == 2)
		print("SwiftTestAction (".__LINE__.") message |$message| Debug |$Debug| SMTPhost |$SMTPhost| SMTPport |$SMTPport| Encryption |$Encryption| UserId |$UserId| Password |$Password| Referrer |$Referrer|<br/>");
	
	//Create the Transport
	$transport = Swift_SmtpTransport::newInstance();
	
	try{
		$transport->setHost($SMTPhost);
	}
	catch (Swift_TransportException $e)
	{
		logMessage('SwiftTestAction.php ('.__LINE__.')  SMTP host $SMTPhost error: ' . $e->getMessage());
		print('SwiftTestAction.php ('.__LINE__.')  SMTP host $SMTPhost error: ' . $e->getMessage());	
	}
	
	try{
		$transport->setPort($SMTPport);
	}
	catch (Swift_TransportException $e)
	{
		logMessage('SwiftTestAction.php ('.__LINE__.')  SMTP port $SMTPport error: ' . $e->getMessage());
		print('SwiftTestAction.php ('.__LINE__.')  SMTP port $SMTPport error: ' . $e->getMessage());	
	}

	$transport->setEncryption($Encryption);
	$transport->setUsername($UserId);
	$transport->setPassword($Password);

	//Create the Mailer using your created Transport
	$mailer = Swift_Mailer::newInstance($transport);
	
	//To use the ArrayLogger
	if ($Debug > 0)
	{
		$logger = new Swift_Plugins_Loggers_ArrayLogger();
		$mailer->registerPlugin(new Swift_Plugins_LoggerPlugin($logger));
	}

	//Send the message

	try
	{
		$result = $mailer->send($message, $failures);
	}
	catch (Swift_TransportException $e)
	{
		logMessage('SwiftTestAction.php ('.__LINE__.') Swift_TransportException error: ' . $e->getMessage());
		print('SwiftTestAction.php ('.__LINE__.') Swift_TransportException error: ' . $e->getMessage());	
	}

	if ($Referrer == "SwiftTest.htm")
	{
		if ($result == 1)
			print("send was a success!");
		else	
		if ($result== 0)
		{
			print("send failed. Failures:");
			print_r($failures);
		}
		else
			print("send request result was $result");
		
		if ($Debug == 2) // Dump the log contents		
			echo $logger->dump();
	}

	return($result);	
}	

	
	if ($Referrer == "SwiftTest.htm")
	{
		$TextMsg = 'This is the plain text message body. Had this been an actual message there would be snappy marketing verbiage here.';
		$HTMLmsg = '<p>This is the <em>html</em> message body. Had this been an actual message there would be snappy marketing verbiage here.</p>';

		$msg = CreateMessage($Debug, $Subject, $RecipientName, $RecipientEmail, $SenderName, $SenderEmail, $ReplytoName, $ReplytoEmail, $TextMsg, $HTMLmsg);
		
		//Let's check the message headers
		//Fetch the HeaderSet from a Message object
		if ($Debug == 2)
		{
			$headers = $msg->getHeaders();
			print("<p>Message Headers</p>");
			echo nl2br($headers->toString());
		}

		//die("SwiftTestAction (".__LINE__.") msg |$msg| Debug |$Debug| SMTPhost |$SMTPhost| SMTPport |$SMTPport| Encryption |$Encryption| UserId |$UserId| Password |$Password| Referrer |$Referrer|<br/>");

		SendMessage($msg, $Debug, $SMTPhost, $SMTPport, $Encryption, $UserId, $Password, $Referrer);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>
      Swift Mailer Test Action
    </title>
  </head>
  <body>
    <form id='ttt' action="SwiftTest.htm" method='post'>
	<input type='submit' value='Return' />
	</form>
</body>
</html>
<?php
	}
?>