<?php
/*
//path to store variables (required by JustHost)
*/
	session_save_path("/home/prontoc2/php");  
    session_start();
 
    if (isset($_POST['process'])) {
        if (!isset($_SESSION['captcha']))
            die('Form accessed incorrectly');
 
        if (isset($_POST['captcha']) && $_POST['captcha'] == $_SESSION['captcha']) {
            die('CAPTCHA text matched! Phrase was ' . $_SESSION['captcha']);
        }
        else {
            die('CAPTCHA text did not match. Phrase was ' . $_SESSION['captcha'] . ', you entered ' . $_POST['captcha']);
        }
    }
    else {
        // generate a new CAPTCHA phrase
        $_SESSION['captcha'] = substr(md5(uniqid(null)), 0, 4);
   }
?>
<html>
    <head>
        <title>CAPTCHA Demo</title>
    </head>
    <body>
        <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
            <img src="createcap.php" /><br />
            Enter phrase: <input type="text" name="captcha" /><br />
 
            <input type="submit" name="process" value="Submit" />
        </form>
    </body>
</html>