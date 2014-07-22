<?php
// Define some constants
define( "RECIPIENT_NAME", "Anthony Ferlazzo" );
define( "RECIPIENT_EMAIL", "aferlazzo@gmail.com" );
define( "EMAIL_SUBJECT", "Visitor Message" );
// Read the form values
$success = false;
$senderName  = $_POST['senderName'];
$senderEmail = $_POST['senderEmail'];
$message     = $_POST['message'];

  // If all values exist, send the email
  if ( $senderName && $senderEmail && $message ) {
    $recipient = RECIPIENT_NAME . " <" . RECIPIENT_EMAIL . ">";
    $headers = "From: " . $senderName . " <" . $senderEmail . ">";
    $success = mail( $recipient, EMAIL_SUBJECT, $message, $headers );
  }
  // Return an appropriate response to the browser
  ?>
  <!doctype html>
  <html>
  <head>
    <title>Thanks!</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css" />
    <style>
        h2{text-align: center;}
    </style>
  </head>
  <body>
    <div data-role="page" id="contactResult" data-add-back-btn="true">
      <div data-role="content">
      <?php if ( $success ) { ?>
            <div style="text-align: center;">
              <h1>Thanks!</h1>
              <p>Thanks for sending your message! We'll get back to you shortly.</p>
    </div>
<?php } else { ?>
    <div style="text-align: center;">
      <h1>Upon Error</h1>
      <h2>Oops!</h2>
      <p style="color: red">
          There was a problem sending your message. Please make sure your email address is correct.<br><br>
          <a href="#contact" data-rel="back" data-role="button" data-inline="true">Try Again</a>
        </p>
      </div>
<?php } ?>
    </div>
    <div data-role="footer" data-position="fixed" data-id="nav">
      <div data-role="navbar">
        <ul>
            <li><a href="#home" data-transition="slide">Home</a></li>
            <li><a href="#recruiters" data-transition="slideup" class="ui-btn-active ui-state-persist">Recruiters</a></li>
            <li><a href="#employers" data-transition="slidedown">Employers</a></li>
            <li><a href="#contact" data-transition="flow">Contact</a></li>
            <li><a href="#about" data-transition="slidedown">About</a></li>
        </ul>
     </div>
   </div>
  </div>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>
</body>
</html>