<?php
	// Do not delete! This script is used to compress .js and .css files when loaded by the user. See php.ini.

if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();
?>
