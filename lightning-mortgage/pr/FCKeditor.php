<?php
if(!ini_set("include_path", "fckeditor")) 
	die("Could not set include path<br>");
//else
//	print("set was successful: include_path set to 'FCKeditor'<br>");

include("fckeditor/fckeditor.php") ;
?>
<html>
  <head>
    <title>FCKeditor - Sample</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  </head>
  <body>
<!--
    <form action="savedata.php" method="post">
-->
<?php
//$oFCKeditor = new FCKeditor('FCKeditor1') ;
//$oFCKeditor->BasePath = 'FCKeditor/';
//$oFCKeditor->Value = 'Default text in editor';
//$oFCKeditor->Create() ;
?>
<!--
      <br>
      <input type="submit" value="Submit">
    </form>
-->
<form action="/post/sampleposteddata.php" method="post" target="_blank">
    <div><input type="hidden" id="FCKeditor1" name="FCKeditor1" value="This is some &lt;strong&gt;sample text&lt;/strong&gt;. You are using &lt;a href=&quot;http://www.fckeditor.net/&quot;&gt;FCKeditor&lt;/a&gt;." style="display:none" />
	<input type="hidden" id="FCKeditor1___Config" value="CustomConfigurationsPath=/fckeditor.config.js" style="display:none" />
	<iframe id="FCKeditor1___Frame" src="/pr/fckeditor/editor/fckeditor.phpl?InstanceName=FCKeditor1&amp;Toolbar=Default" width="80%" height="400" frameborder="0" scrolling="no"></iframe></div> <br />
    <input type="submit" value="Submit" />
</form>

  </body>
</html>
