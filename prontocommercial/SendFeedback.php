<?php

//Retrieve form data.
//GET - user submitted data using AJAX
//POST - in case user does not support javascript, we'll use POST instead

	if($_GET){
		$t='GET';
		$feedbackName  = $_GET['feedbackName'];
		$feedbackEmail = $_GET['feedbackEmail'];
		$feedbackText  = $_GET['feedbackText'];
	}else{
		if($_POST){
			$t='POST';
			$feedbackName  = $_POST['feedbackName'];
			$feedbackEmail = $_POST['feedbackEmail'];
			$feedbackText  = $_POST['feedbackText'];
		}else{
			die('error: no feedback data received');
		}
	}

//die(" text received via $t: feedbackName |$feedbackName| feedbackEmail |$feedbackEmail| feedbackText |$feedbackText| ");
//Simple mail function with HTML header
function sendmail($to, $subject, $message, $from, $replyto)
{
	$headers  = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
	$headers .= 'From: ' . $from . "\r\n";
	$headers .= 'Reply-To: ' . $replyto. "\r\n";

	$result = mail($to,$subject,stripslashes($message), $headers);

	if ($result == 1)
		return "1"; //success
	else
		return "0";
}


//die("name: $feedbackName, email $feedbackEmail, text $feedbackText");

//recipient
$to = 'Anthony Ferlazzo <aferlazzo@gmail.com>';
//sender
$from = 'Pronto Web Visitor<website.visitor@prontocommercial.com>';

//subject and the html message
$subject = 'Web Site Feedback';
$message  = '<html>';
$message .= '<head>';
$message .= '</head>';
$message .= '<body>';
$message .= '<table style="font-family: sans-serif;">';
$message .= '<tr><td style="width:100px;text-align:right;margin-right:6px;vertical-align:top;">';
$message .= 'Visitor name: </td><td>'. htmlspecialchars ($feedbackName, ENT_QUOTES) . '</td></tr>';
$message .= '<tr><td style="width:100px;text-align:right;margin-right:6px;vertical-align:top;">';
$message .= 'Email: </td><td>' . htmlspecialchars ($feedbackEmail, ENT_QUOTES) . '</td></tr>';
$message .= '<tr><td style="width:100px;text-align:right;margin-right:6px;vertical-align:top;">';
$message .= 'Feedback: </td><td>' . htmlspecialchars($feedbackText, ENT_QUOTES) . '</td></tr>';
$message .= '</table>';
$message .= '</body>';
$message .= '</html>';



//send the mail
$result = sendmail($to, $subject, $message, $from, $feedbackEmail);
//die("to: $to, subject $subject, message $message, from " . htmlspecialchars($from, ENT_QUOTES) . ", email $feedbackEmail");
echo $result;
?>
