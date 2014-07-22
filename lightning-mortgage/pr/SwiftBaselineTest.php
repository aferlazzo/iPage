<?php

//The baseline script will use Swiftmail version 4.0.6 to send smtp messages

//this causes the Swift Mailer to be autoloaded/included

require_once './Swift-4.0.6/lib/swift_required.php';
$debug = 0;
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
function CreateMessage()
{
	//1. Create the message
	$message = Swift_Message::newInstance()

	//3. Give it a body
	->setBody('This is the plain text message body. Had this been an actual message there would be snappy marketing verbiage here.')

	//3a. And optionally an alternative body
	->addPart('<p>This is the <em>html</em> message body. Had this been an actual message there would be snappy marketing verbiage here.</p>', 'text/html')

	//3b. Optionally add optional attachments
	
	// ->attach(Swift_Attachment::fromPath('my-document.pdf'))
 
	//3c. Give the message a subject
	->setSubject('Test SwiftMailer 4.0.6')

	//4. Add recipients. Set the To addresses with an associative array
	->setTo(array('aferlazzo@gmail.com' => 'Anthony Ferlazzo'))

	//5. Add sender details. Set the From address with an associative array
	->setFrom(array('noreply@lightning-mortgage.com' => 'Lightning Mortgage Mailer'))
	->setReplyTo(array('anthony@lightning-mortgage.com' => 'Anthony Ferlazzo'))
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
function SendMessage($message, $debug)
{
	//Create the Transport
	$transport = Swift_SmtpTransport::newInstance()
	->setHost('mail.lightning-mortgage.com')
	->setPort(465)
	->setEncryption('ssl')
	->setUsername('noreply+lightning-mortgage.com')
	->setPassword('1commguru')
	;

	//Create the Mailer using your created Transport
	$mailer = Swift_Mailer::newInstance($transport);
	
	//To use the ArrayLogger
	if ($debug == 1)
	{
		$logger = new Swift_Plugins_Loggers_ArrayLogger();
		$mailer->registerPlugin(new Swift_Plugins_LoggerPlugin($logger));
	}
	
	//Send the message
	$result = $mailer->send($message);
	print("send request result was $result");
	
	
	// Dump the log contents
	if ($debug == 1)
		echo $logger->dump();
}	





	$msg = CreateMessage();
		
	//Let's check the message headers
	//Fetch the HeaderSet from a Message object
	if ($debug == 1)
	{
		$headers = $msg->getHeaders();
		print("<p>Message Headers</p>");
		echo nl2br($headers->toString());
	}

	SendMessage($msg, $debug);
?>