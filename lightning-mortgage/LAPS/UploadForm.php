<html>
<head>
<title>Upload Form</title>
<!-- This file sends the file to be uploaded to the php script 'upload.php' which then processes it. -->

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF" text="#000099000">
<p>FILE Upload Demo page</p>
<form name="form1" method="post" action="Upload.php" enctype="multipart/form-data">
<p>File to be uploaded.
<input type="file" name="FileName">  
</p>
<p>
<input type="submit" name="Submit" value="Submit">
</p>
</form>
<p>&nbsp; </p>
</body>
</html>