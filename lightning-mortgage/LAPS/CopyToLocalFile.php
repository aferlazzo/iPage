<?php
//	header("Content-type: application/octet-stream");
//	header("Content-Disposition: attachment, filename='Avery.txt'");
//	header("Content-length: ".filesize('./cgi-bin/formdata/Avery.txt'));
//	header("Content-type: application/force-download");
//	header("Connection: close");
//	header("Expires: 0");
//	@readfile('./cgi-bin/formdata/Avery.txt');

$Tempfile = $_GET[TheFile];

if ($Tempfile == Null)
	$Tempfile = "appmst.txt";


$ExportFileName = "appmst.txt";


// fix for IE catching or PHP bug issue
header("Pragma: public");
header("Expires: 0"); // set expiration time
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
// browser must download file from server instead of cache

// force download dialog
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");

// use the Content-Disposition header to supply a recommended filename and
// force the browser to display the save dialog.
//header("Content-Disposition: attachment; filename=".basename($FileName).";");
header("Content-Disposition: attachment; filename=".$Tempfile.";");

/*
The Content-transfer-encoding header should be binary (changed to text for my file), since the file will be read
directly from the disk and the raw bytes passed to the downloading computer.
The Content-length header is useful to set for downloads. The browser will be able to
show a progress meter as a file downloads. The content-lenght can be determines by
filesize function returns the size of a file.
*/
header("Content-Transfer-Encoding: text");
header("Content-Length: ".filesize($ExportFileName));
readfile("$ExportFileName");
//header ("Location: ApplicantList.php");  //go here after download is complete
exit;
exit("<script>window.location='ApplicantList.php</script>\n"); // jump back

?>
<!doctype html public "-//w3//dtd html 4.01 transitional//en"
					  "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>CopyToLocalFile form handler</title>
<!--

Copies the exported applicant record from the server file to a local file by forcing a download to occur.

-->
<script language="VBScript">
function PointImport()  ' activate the named application
Dim shell

Set shell = CreateObject("WScript.Shell")
shell.Run """C:\winpoint\import.exe"" c:\appmst.txt c:\appmst.imp c:\pntdata\borrower"
end function

function DeleteTempfile()
dim filesysdelfile

Set filesysdelfile = CreateObject("Scripting.FileSystemObject")
filesysdelfile.DeleteFile "c:\appmst.txt",True
Set filesysdelfile = Nothing
end function
</script>
</head>
<body>
<?php
print("before read<br>\n");
print("past read<br>\n");
print("<script>window.location='ApplicantList.php';</script>\n"); //go to this page
exit("Shouldn't reach here");
?>

</body>
</html>