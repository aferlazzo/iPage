<?php
print('<pre>');
//phpinfo();
print_r($GLOBALS);
print('</pre>');
$sName = $GLOBALS[_SERVER][SERVER_NAME];
print("server: |$sName| ".$GLOBALS[_SERVER][SERVER_NAME]);
?>