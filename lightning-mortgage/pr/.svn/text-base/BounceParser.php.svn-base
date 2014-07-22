<?php
/*
 * testing.....no implemented
 * parse_message.php
 *
 * @(#) $Header: /home/mlemos/cvsroot/pop3/parse_message.php,v 1.3 2006/06/14 03:55:28 mlemos Exp $
 * Taken from: Parsing a message with Manuel Lemos' PHP POP3 and MIME Parser classes
 *
 */

?>
<html>
<head>
<title>Bounce Parser</title>
</head>
<body>
<center><h1>Parsing a message with Manuel Lemos' PHP POP3 and MIME Parser classes</h1></center>
<hr />
<?php

	require('mime_parser.php');
	require('pop3.php');

	stream_wrapper_register('pop3', 'pop3_stream');  /* Register the pop3 stream handler class */

	$user=UrlEncode("");
	$password=UrlEncode("");
	$realm=UrlEncode("");                         /* Authentication realm or domain            */
	$workstation=UrlEncode("");                   /* Workstation for NTLM authentication       */
	$apop=0;                                      /* Use APOP authentication                   */
	$authentication_mechanism=UrlEncode("USER");  /* SASL authentication mechanism             */
	$debug=1;                                     /* Output debug information                  */
	$html_debug=1;                                /* Debug information is in HTML              */
	$message=1;
	$message_file='pop3://'.$user.':'.$password.'@localhost/'.$message.
		'?debug='.$debug.'&html_debug='.$html_debug.'&realm='.$realm.'&workstation='.$workstation.
		'&apop='.$apop.'&authentication_mechanism='.$authentication_mechanism;
	/*
	 * Access Gmail POP account
	 */
	/*
 	$message_file='pop3://'.$user.':'.$password.'@pop.gmail.com:995/1?tls=1&debug=1&html_debug=1';
 	 */

	$mime=new mime_parser_class;

	/*
	 * Set to 0 for not decoding the message bodies
	 */
	$mime->decode_bodies = 1;

	$parameters=array(
		'File'=>$message_file,
		
		/* Read a message from a string instead of a file */
		/* 'Data'=>'My message data string',              */

		/* Save the message body parts to a directory     */
		/* 'SaveBody'=>'/tmp',                            */

		/* Do not retrieve or save message body parts     */
		   'SkipBody'=>1,
	);
	$success=$mime->Decode($parameters, $decoded);


	if(!$success)
		echo '<h2>MIME message decoding error: '.phplSpecialChars($mime->error)."</h2>\n";
	else
	{
		echo '<h2>MIME message decoding successful</h2>'."\n";
		echo (count($decoded)==1 ? '1 message was found.' : count($decoded).' messages were found.'),"\n";
		for($message = 0; $message < count($decoded); $message++)
		{
			echo '<pre>Message ',($message+1),':',"\n";
			var_dump($decoded[$message]);
			echo '</pre>';
		}
	}
?>
<hr />
</body>
</html>
