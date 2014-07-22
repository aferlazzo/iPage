<?php
require ("../include/authenticate.php");
?>

<!DOCTYPE html PUBLIC "-//W3//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/2000/REC-xhtml1-20000126/DTD/xhtml1-transitional.dtd">
<html xlns="http://www.w3.org.1999.xhtml">
<head>
	<title>Upload Point Status</title>
</head>
<!-- This page is called by UploadPointStatus.php -->
<body>
<?php

//	The variable should be set to the complete relative path to the directory into which the files
//	should be uploaded. This starts with /home/ etc on a linux server and normally c:\inetpub\wwwroot\ on
//	a windows server. The specified directory should have read, write and execute permissions for all users
//	(chmod 0777 on linux).

	$path_to_upload_dir = "../cgi-bin/uploads";

	if (is_dir("$path_to_upload_dir/"))
	{
		print("$path_to_upload_dir is an existing server directory<BR>\n");
	}
	else
	{
		die("$path_to_upload_dir is NOT an existing server directory<BR>\n");
	}

	//	The relivant html form is:
	//	<form name="form1" method="POST" action="Upload.php" enctype="multipart/form-data">
	//	<input type="hidden" name="MAX_FILE_SIZE" value="30000">
	//	<p>File to be uploaded.
	//	<input type="file" name="InputFilePath">  <!-- type='file' creates an upload window. -->
	//	</p>
	//	<p>
	//	<input type="submit" name="Submit" value="Submit">
	//	</p>
	//	</form>

	//	We use input type="file" in the form that calls this routine (see above).
	//	The chosen file is uploaded when the user presses the submit button. When it
	//	is uploaded, the server places it in a temporary directory. The copy function
	//	duplicates the file in a new location.

	if(isset($_POST['InputFilePath']))
	{
	    $InputFilePath = $_POST['InputFilePath'];
	}

	echo "Temporary File name |".$_FILES['InputFilePath']['name']."|<br>\n";
	//echo "Temporary File type |".$_FILES['InputFilePath']['type']."|<br>\n";
	//echo "Temporary File size |".$_FILES['InputFilePath']['size']."|<br>\n";
	//echo "Temporary File error |".$_FILES['InputFilePath']['error']."|<br>\n";
	$InputFileName = $_FILES['InputFilePath']['name'];

	$path_parts = pathinfo($InputFilePath);
	//echo "Literal Directory name |" . $path_parts["dirname"] . "|<br>\n";
	//echo "Literal Basename |" . $path_parts["basename"] . "|<br>\n";
	//echo "Literal Extension |" . $path_parts["extension"] . "|<br>\n";
	$DirectoryName = dirname($InputFilePath);
	$FileName = basename($InputFilePath);
	//print("Direcory name is $DirectoryName<br>\n");
	print("Temporary File name is $InputFilePath<br>\n");

//	The next piece of code opens another conditional to see if the file has been copied from the temporary
//	directory on the server to the specified directory in the variable above. It reports back whether the
//	file was copied to the directory successfully.

	if(copy($InputFilePath, "$path_to_upload_dir/".$InputFileName))
	{
		print("Your File was uploaded successful!");
	}
	else
	{
		die("ERROR, your file <b>was not</b> uploaded");
	}

	unlink ("$InputFilePath"); // delete the temporary file

	//go to a new page
	print("<script language='JavaScript'>location.href='ApplicantMaster.php'</script>");
?>
</body>
</html>