<?php
  function insertImage( $fileName ) {
    $fName = getcwd().DIRECTORY_SEPARATOR . 'uploadedSprites/' . $fileName;
    $fName = "http://www.prontocommercial.com".DIRECTORY_SEPARATOR . 'uploadedSprites/' . $fileName;
    echo '<img src='.$fName .'>';
  }
?>
<html>
  <body>
	<p>From the server:</p>
    <?php insertImage( 'button_select.gif' ); ?>
  </body>
</html>
