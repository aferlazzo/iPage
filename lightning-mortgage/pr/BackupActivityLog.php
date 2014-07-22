<?php
/*

Perfect Response - Email Marketing at Its Best!
Copyright © Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/

$FileName = "Logs/PerfectResponseLog";
$user = ucwords(strtolower($_COOKIE["UName"]));

?>
<script language="JavaScript">
	if (!confirm('Do you really want to archive the log file?')) 
		window.history.back();
</script>

<?php


//This is a function to emulate the php 5.0 function file_put_contents()

set_include_path(get_include_path()."/home/lightnin/public_html/pr/PHP_Compat/Compat/Function");
//----------------------------------------------------------------------------------
// $Id: file_put_contents.php,v 1.27 2007/04/17 10:09:56 arpad Exp $


if (!defined('FILE_USE_INCLUDE_PATH')) {
    define('FILE_USE_INCLUDE_PATH', 1);
}

if (!defined('LOCK_EX')) {
    define('LOCK_EX', 2);
}

if (!defined('FILE_APPEND')) {
    define('FILE_APPEND', 8);
}


/**
 * Replace file_put_contents()
 *
 * @category    PHP
 * @package     PHP_Compat
 * @license     LGPL - http://www.gnu.org/licenses/lgpl.phpl
 * @copyright   2004-2007 Aidan Lister <aidan@php.net>, Arpad Ray <arpad@php.net>
 * @link        http://php.net/function.file_put_contents
 * @author      Aidan Lister <aidan@php.net>
 * @version     $Revision: 1.27 $
 * @internal    resource_context is not supported
 * @since       PHP 5
 * @require     PHP 4.0.0 (user_error)
 */
function php_compat_file_put_contents($filename, $content, $flags = null, $resource_context = null)
{
    // If $content is an array, convert it to a string
    if (is_array($content)) {
        $content = implode('', $content);
    }

    // If we don't have a string, throw an error
    if (!is_scalar($content)) {
        user_error('file_put_contents() The 2nd parameter should be either a string or an array',
            E_USER_WARNING);
        return false;
    }

    // Get the length of data to write
    $length = strlen($content);

    // Check what mode we are using
    $mode = ($flags & FILE_APPEND) ?
                'a' :
                'wb';

    // Check if we're using the include path
    $use_inc_path = ($flags & FILE_USE_INCLUDE_PATH) ?
                true :
                false;

    // Open the file for writing
    if (($fh = @fopen($filename, $mode, $use_inc_path)) === false) {
        user_error('file_put_contents() failed to open stream: Permission denied',
            E_USER_WARNING);
        return false;
    }

    // Attempt to get an exclusive lock
    $use_lock = ($flags & LOCK_EX) ? true : false ;
    if ($use_lock === true) {
        if (!flock($fh, LOCK_EX)) {
            return false;
        }
    }

    // Write to the file
    $bytes = 0;
    if (($bytes = @fwrite($fh, $content)) === false) {
        $errormsg = sprintf('file_put_contents() Failed to write %d bytes to %s',
                        $length,
                        $filename);
        user_error($errormsg, E_USER_WARNING);
        return false;
    }

    // Close the handle
    @fclose($fh);

    // Check all the data was written
    if ($bytes != $length) {
        $errormsg = sprintf('file_put_contents() Only %d of %d bytes written, possibly out of free disk space.',
                        $bytes,
                        $length);
        user_error($errormsg, E_USER_WARNING);
        return false;
    }

    // Return length
    return $bytes;
} // end of function


// Define function
if (!function_exists('file_put_contents')) 
{
    function file_put_contents($filename, $content, $flags = null, $resource_context = null)
    {
        return php_compat_file_put_contents($filename, $content, $flags, $resource_context);
    }
} 
//----------------------------------------------------------------------------------

	$Size = filesize("$FileName.txt");

if ($Size > 0)
{
	for ($i=1; $i < 100; $i++)
	{
		if (!file_exists("$FileName$i.txt"))
		{
			$xxx = @fopen("$FileName$i.txt", "w"); //create file 
			if ($xxx == false)
				die("<p>BackupActivityLog.php (".__LINE__.") Error opening/creating: $FileName$i.txt</p>");
			fclose($xxx);					
			chmod("$FileName$i.txt", 0666); //change file permissions writeable
			$fData=file_get_contents("$FileName.txt");
			$result=file_put_contents("$FileName$i.txt", $fData);
			if($result == false)
				die("<p>BackupActivityLog.php (".__LINE__.") Error writing $FileName$i.txt</p>");
			break;
		}
	}
	
	// truncate the file
	@chmod("$FileName.txt", 0666); //change file permissions writeable
	$Handle=fopen("$FileName.txt","w");
	fclose($Handle);

	print("<script language='JavaScript' type='text/javascript'>\n");
	print("alert('Archived log to \"$FileName$i.txt\"');\n");
	print("window.location.href='home.php'");
	print("</script>");
			
}
else  // size == 0
{
	print("<script language='JavaScript' type='text/javascript'>\n");
	print("alert(' \"$FileName.txt\" is empty and was not backed up.');\n");
	print("window.location.href='home.php'");
	print("</script>");
}
?>
