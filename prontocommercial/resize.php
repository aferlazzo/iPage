<!DOCTYPE html>
<html>
<head>
<!--
  <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js"></script>
-->
<?php include("include/Head.php"); ?>  
  <style type="text/css">
    #resizable { width: 100px; height: 100px; background: silver; }
  </style>
  <script>
  $(document).ready(function() {
    $("#resizable").resizable();
  });
  </script>
</head>
<body style="font-size:62.5%;">
  
<div id="resizable"></div>

</body>
</html>