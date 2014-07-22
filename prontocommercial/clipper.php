<?php
	$eFile   = "";
	$eWidth  = 0;
	$eHeight = 0;

	if(count($_POST) > 0){
		$eFile     = $_POST['eFile'];
		//$eFile = $_FILES['eFile']['name'];
		//print("received: |$eFile|<br>");


		if(trim($eFile) == ""){
			print("<script type='text/javascript'>alert('Image was not found.');</script>");
		}else{
			$size = @getimagesize($eFile);	// try obtaining the image size of supplied path

			if(($size == 0)	|| ($size == FALSE)){
				print("<script type='text/javascript'>alert('Image \'$eFile\' was not found. Please key-in the full pathname.');</script>");
			}else{
				$theRectangleFieldsRight  = $eWidth  = $size[0];
				$theRectangleFieldsBottom = $eHeight = $size[1];
			}
		}
	}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset=utf-8>
<title>Clipper - CSS Sprite & Clip Utility</title>
	<script  type='text/javascript' src="http://www.google.com/jsapi?key=ABQIAAAAFhI-zWC1OHnIWn-NgpM59RQEvnDN41A_YXsu9RDCiPeB95ezzhRg9hvePm9aPDvoXLeCm7abWSWrHws"></script>
	<script type='text/javascript'>
	google.load("jquery", "1");
	google.load("jqueryui", "1");
	</script>
<link rel="stylesheet" type='text/css' href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css">
<link rel="stylesheet" type='text/css' href="css/clipper.css">
<script type='text/javascript' src='js/clipper.js'></script>
</head>
<body>
	<h1>Clipper: Aid to Sprite Item and Clip Property Sizing</h1>
		<div id='theImageWrapper'>
			<div id='theImageContainer'></div>
			<div id='theClippedContainer'></div>
			<div id='theRectangle'></div>
		</div>

	<form id='clipForm'  onsubmit='return sendingValues();' action='clipper.php' method='post'>   <!--ctype="multipart/form-data" -->
		<fieldset id='fullImageFields'>
			<legend>Full Image Parameters</legend>
			<!-- for each input, the name argument is for form processing, the id is for jquery processing -->
<?php
			if ($eFile == "")
				print("<label for='eFile'>Image File Pathname</label><input type='file' name='eFile' id='eFile'>\n");
			else
				print("<label for='eFile'>Image File Pathname</label><input type='text' value='$eFile' name='eFile' id='eFile'>\n");
?>
			<input type='submit' value='Get Image'>
			<div class='hh'>
				<label for='eWidth'>Width</label><input disabled type='text' value='<?php echo $eWidth ?>' name='eWidth' id='eWidth' class='amt'> px
				<div id='backgroundColor'></div><div id='colorLegend'>Background Color</div>
			</div>
			<div class='hh'>
				<label for='eHeight'>Height</label><input disabled type='text' value='<?php echo $eHeight ?>' name='eHeight' id='eHeight' class='amt'> px
				<div id='zoomFactor'></div><div id='zoomLegend'><span>100%&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;200%&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;300%</span><br>Image Zoom</div>
			</div>
		</fieldset>

		<fieldset id='theRectangleFields'>
			<legend>The Focus Rectangle</legend>
			<div class='hh amth'><label for='theRectangleFieldsTop'>Top Offset</label><input type='text' value=0 name='theRectangleFieldsTop' id='theRectangleFieldsTop' class='amt'> px</div>
			<div class='hh amth'><label for='theRectangleFieldsBottom'>Bottom Limit</label><input type='text' value=0 name='theRectangleFieldsBottom' id='theRectangleFieldsBottom' class='amt'> px</div>

			<div class='hh amtw'><label for='theRectangleFieldsWidth'>Width</label><input type='text' value=0 name='theRectangleFieldsWidth' id='theRectangleFieldsWidth' class='amt'> px</div>
			<div class='hh amth'><label for='theRectangleFieldsHeight'>Height</label><input type='text' value=0 name='theRectangleFieldsHeight' id='theRectangleFieldsHeight' class='amt'> px</div>

			<div class='hh amtw'><label for='theRectangleFieldsLeft'>Left Offset</label><input type='text' value=0 name='theRectangleFieldsLeft' id='theRectangleFieldsLeft' class='amt'> px</div>
			<div class='hh amtw'><label for='theRectangleFieldsRight'>Right Limit</label><input type='text'  value=0 name='theRectangleFieldsRight' id='theRectangleFieldsRight' class='amt'> px</div>
		</fieldset>
		<fieldset id='cssFields'>
			<legend>CSS For Selection</legend>
			<div id='cssDisplayed'></div>
		</fieldset>
		<fieldset id='referenceFields'>
			<legend>For Reference</legend>
			<div class='rel'>
				<div id='refOriginalElement'>
					<div id='refDescription'>Entire<br>Image<br>File</div>
					<div id='refClippedArea'>Clipped<br>Area</div>
					<div id='refTopLine'>top</div><div id='topArrow'></div>
					<div id='refRightLine'>right</div><div id='rightArrow'></div>
					<div id='refBottomLine'>bottom</div><div id='bottomArrow'></div>
					<div id='refLeftLine'>left</div><div id='leftArrow'></div>
					<div id='refClippedWidth'>width</div><div id='refClippedHeight'>height</div>
				</div>
			</div>
		</fieldset>
	</form>
</body>
</html>
