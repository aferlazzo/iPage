<?php
require_once("Swift-4.0.6/lib/swift_required.php");
$transport = Swift_SmtpTransport::newInstance('localhost', 25);
$mailer = Swift_Mailer::newInstance($transport);
$message=Swift_Message::newInstance();
$message->setSubject('test mail ...');
$message->setFrom(array('aferlazzo@gmail.com'=>'sender'));
$headers = $message->getHeaders();
$message->setTo(array('tferlazzo@gmail.com'=> 'recipient'));
$message->setBody('Thus is a test message ');
$result=$mailer->send($message, $failures);
echo $result;
?>