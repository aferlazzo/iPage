<?php

$uploaddir = '/home/prontoc2/public_html/UploadedData/';
/*
Usually php uses the <input type='file' name='file1'...> to upload a file using the following:
$uploadfile = $uploaddir . basename($_FILES['file1']['name']);

echo '<pre>';
if (move_uploaded_file($_FILES['file1']['tmp_name'], $uploadfile)) {
    echo "File is valid, and was successfully uploaded.\n";
} else {
    echo "Possible file upload attack!\n";
}

echo 'Here is some more debugging info:';
print_r($_FILES);

print "</pre>";

In this case we are using an array of names as in:
<input type='file' name='CISfile[]'...> so we use the following to upload the files:
*/
$bad = false;
foreach ($_FILES["CISfiles"]["error"] as $key => $error)
{
	switch($error)
	{
		case UPLOAD_ERR_OK: //Value: 0; There is no error, the file uploaded with success.
			$tmp_name = $_FILES["CISfiles"]["tmp_name"][$key];
			$name = $_FILES["CISfiles"]["name"][$key];
			move_uploaded_file($tmp_name, "$uploaddir$name");
			echo 'File "'. $name . '" was uploaded<br>';
			break;

		case UPLOAD_ERR_INI_SIZE:  //Value: 1; The uploaded file exceeds the upload_max_filesize directive in php.ini.

		case UPLOAD_ERR_FORM_SIZE:
			print('Error: File "$name" is too big to upload.');
			$bad = true;
			break;

		case UPLOAD_ERR_PARTIAL:  //  Value: 3; The uploaded file was only partially uploaded.
			print('Error: File "$name" was only partially uploaded. Please try to upload it again.');
			$bad = true;
			break;

		case UPLOAD_ERR_NO_FILE:  // Value: 4; No file was uploaded.
			break;

		case UPLOAD_ERR_NO_TMP_DIR:  // Value: 6; Missing a temporary folder. Introduced in PHP 4.3.10 and PHP 5.0.3.
			print('Error: Missing temp folder on server. File not uploaded');
			$bad = true;
			break;

		case UPLOAD_ERR_CANT_WRITE:  // Value: 7; Failed to write file to disk. Introduced in PHP 5.1.0.
			print('Error: Could not save on server. File not uploaded');
			$bad = true;
			break;
    }
}

if($bad==false)
{
		$rrr = rand(0, 100);
		rename('UploadedData', 'UploadedCISfile'.$rrr);
		mkdir('UploadedData');
		sleep(5);
		print ("<script type='text/javascript'>document.location.href='CISsent.php';\n</script>\n");
}

/*
echo 'Here is some more debugging info:';
echo '<pre>';
print_r($_FILES);
foreach ($_FILES['CISfiles'] as $position => $file) {
    // should output array with indices name, type, tmp_name, error, size
    var_dump($file);
}
print "</pre>";
*/
?>
