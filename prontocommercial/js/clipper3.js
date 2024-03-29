
	// The goal of this web page is to provide a way to provide the css clip parameters or the proper background image parameters
	// for a sprite element. We make that magic happen by using the drag and resize widgets from jQuery and manually keeping the
	// rectangle being modified by jQuery aligned with the area specified by the clip property of the div making up that layer.

	// Here's how it works:
	// theImageContainer and theClippedContainer are duplicate divs that are two separate layers at the start of the script.
	// zoomFactor is 100% at start. Later on much of theClippedContainer layer is hidden from view except for the clip
	// property's rectangle.

	// theRectangle is a third layer. It sits on top of theClippedContainer layer and enables the user to drag and resize
	// a rectangular area over the particular element of the sprite image. This area must be kept in synch with the clip
	// property of theClippedContainer layer in order to provide visual feedback to the user that the clip property has the
	// correct parameters.

	// Key Areas of the script

	// filelistAPIsupport() function : Run onload

	// 1. and 2. handleFileSelect() : function (if FileList API is supported by browse)

	// 1. $('#btn').click(function() : The 'Show It' button is clicked to retrieve an image
	// 2. pageSetup() function : Sets up the web page parameters and displays the image

	// 3. clipIt function : Whenever a form amount is changed the image parameters must be changed to reflect new values
	// 4. $('.amt').keyup(function() : Handles the upArrow and downArrow functionality with form amount fields
	// 5. $('.amt').change(function() : Ensures that invalid form amounts are not entered
	// 6. colorInBackground() function : Handles the background color slider control
	// 7. $("#zoomFactor").slider() function : When the zoom slider is changed the scale of all the images on the page must also be adjusted
	// 8. realignTheRectangle() function : Keeps the clipArea and theRectangle in alignment at all times
	// 9. #theImageWrapper mousedown() function : This section handles the initial location for theRectangle

	// $('#theRectangle').draggable() function : defines the functionality when theRectangle is dragged by user
	// $('#theRectangle').resizable() function : defines the functionality when theRectangle is resized by user





	function filelistAPIsupport(){
		// Check for the FileList API support.

		if (window.FileList) {
			//alert('Great news! FileList API is supported.');
			document.getElementById('supportsHTML5').style.display='block';
			return true;
		} else {
			document.getElementById('notSupported').style.display='block';
			alert('Unfortunately the FileList API is not fully supported by this browser.');
			return false;
		}
	}

onload=filelistAPIsupport();


$(document).ready(function(){
	$( "#tabs" ).tabs();
	// the image width and height are set when the image is read from disk.
	var trueImageWidth, trueImageHeight, trueClip = [], mouseInside = false;
	zoomFactor = 1, trueColorValue = 9, showOnlySelected = false, formFilesInitialized = false;

	$('#showOnlySelection').removeProp('checked');
	$('#debugOnOff').removeProp('checked');

	function logIt(msg){
		$("#log").append(msg + "<br>");
		var objDiv = document.getElementById("log");//scroll to bottom of log
		objDiv.scrollTop = objDiv.scrollHeight;
	}

	$('#logDiv').resizable({handles: 's',
							resize: function(){
								var s = $(document).width(),
									l = $(this).width();
								$(this).css('left', s - l - 8);
								//logIt('document width: '+s);
						}
	});

	// - - - - - - - - - - - - - - - - - - - - - -

	// 6. colorInBackground() function : Handles the background color slider control.
	// Called at pageSetup and when backgroundColor slider is moved.

	// - - - - - - - - - - - - - - - - - - - - - -

	function colorInBackground(colorValue){
		var c = ['#000', '#111', '#222', '#333', '#444', '#555', '#666', '#777', '#888', '#999', '#000', '#bbb', '#ccc', '#ddd', '#eee', '#fff', 'transparent'];
		$('#theImageContainer, #theClippedContainer').css('backgroundColor', c[colorValue]);
		if (colorValue < 16)
			$('#colorLegend span').text('Color ' + c[colorValue]);
		else
			$('#colorLegend span').text('Transparent');
	}


	// - - - - - - - - - - - - - - - - - - - - - -

	// 3. clipIt function : Whenever a form amount is changed the image parameters must be changed to reflect new values
	// Update theClipContainer Parameters whenever a value is changed. The user sees the parameters in the Focus Rectangle
	// and CSS Selection fieldsets in the form

	// - - - - - - - - - - - - - - - - - - - - - -

	function clipIt(){
		var imageFile					= $('#eFile').val(),
			theRectangleFieldsTop		= parseFloat($('#theRectangleFieldsTop')	.val()).toFixed(1) / zoomFactor,
			theRectangleFieldsRight		= parseFloat($('#theRectangleFieldsRight')	.val()).toFixed(1) / zoomFactor,
			theRectangleFieldsBottom	= parseFloat($('#theRectangleFieldsBottom')	.val()).toFixed(1) / zoomFactor,
			theRectangleFieldsLeft		= parseFloat($('#theRectangleFieldsLeft')	.val()).toFixed(1) / zoomFactor,
			theRectangleFieldsWidth		= parseFloat($('#theRectangleFieldsWidth')	.val()).toFixed(1) / zoomFactor,
			theRectangleFieldsHeight	= parseFloat($('#theRectangleFieldsHeight')	.val()).toFixed(1) / zoomFactor,
			cssPosition, clipArea;

		clipArea	= 'rect('+  theRectangleFieldsTop    * zoomFactor + 'px, ' +
								theRectangleFieldsRight  * zoomFactor + 'px, ' +
								theRectangleFieldsBottom * zoomFactor + 'px, ' +
								theRectangleFieldsLeft   * zoomFactor + 'px)';

		$('#theClippedContainer').css({'clip': clipArea});
		cssPosition	= $('#theImageContainer').css('position');

		$('#cssDisplayed').html('<p style=\'margin-top:0;\'>for sprite:<br>cssSelector {<br>background-image: url(\'' + imageFile + '\');<br>' +
						'background-position: ' + (theRectangleFieldsLeft * -1).toFixed(1) + 'px ' + (theRectangleFieldsTop * -1).toFixed(1) + 'px;<br>'+
						'position: absolute;<br>' +
						'height: '   + theRectangleFieldsHeight.toFixed(1) + 'px;<br>' +
						'width: '    + theRectangleFieldsWidth.toFixed(1) + 'px;}</p>' +
						'<p>for clipped area:<br>cssSelector {<br>' +
						'background-image: url(\'' + imageFile + '\');<br>' +
						'position: ' + cssPosition + ';<br>' +
						'width: '    + theRectangleFieldsWidth.toFixed(1) + 'px;<br>' +
						'height: '   + theRectangleFieldsHeight.toFixed(1) + 'px;<br>' +
						'clip:'      + clipArea + ';}</p>');
	}
	// - - - - - - - - - - - - - - - - - - - - - -

	// 1. and 2. (*** if FileList API is supported by browser ***)
	// Uses the new HTML 5 API to do local file read in javascript.
	// This is the function to run when a file is selected by the user.

	// - - - - - - - - - - - - - - - - - - - - - -

	function handleFileSelect(evt) {
		var f, files = evt.target.files; // FileList object

		$('.ui-resizable-handle .ui-resizable-se .ui-icon .ui-icon-gripsmall-diagonal-se').css('display', 'none');
		// Loop through the FileList

			f = files[0];
			// Only process image files.
			if ((f.type === 'image/png') || (f.type === 'image/gif') || (f.type === 'image/jpeg')) {
				var reader = new FileReader();

				// Closure to capture the file information.
				reader.onload = (function(theFile) {
					return function(e) {
						$('.theSpriteImage').attr('src', e.target.result)
											.css('display', 'block');
						$('#eFile').val(theFile.name);				//fill-in the name of the file that was selected

						$('#temporaryImage').load(function(){ // make sure image is loaded
							trueImageWidth   = $('#temporaryImage').width();
							trueImageHeight  = $('#temporaryImage').height();
							$('#eHeight').val(trueImageHeight);
							$('#eWidth').val(trueImageWidth);

							// set image on page and populate form fields
							$('#theImageWrapper, #theImageContainer, #theClippedContainer')
										.css({'width': trueImageWidth, 'height': trueImageHeight});

							$('#theRectangleFieldsWidth,  #theRectangleFieldsRight').val(0);	// set the form field values
							$('#theRectangleFieldsHeight, #theRectangleFieldsBottom').val(0);
							$('#theRectangleFieldsTop, #theRectangleFieldsLeft').val(0);

							// allow scaling of image to take place by making width & height 100% and then changing size of the containers
							$('#theImage, #theClippedImage').css({'width': '100%', 'height': '100%'});
							clipIt();
						});
					};
				})(f);
				// Read in the image file as a data URL.
				reader.readAsDataURL(f);
				$("#zoomFactor").slider('option', 'value', 1);	//reset slider to 1 in case it was set
				$('#showOnlySelection').removeProp('checked');
			}else{
				$('#theClippedContainer').css('clip', 'rect(-999px -999px -999px -999px)');
				$('#eFile').val('');
				$('#theRectangleFieldsTop, #theRectangleFieldsLeft, #theRectangleFieldsBottom, #theRectangleFieldsRight, #theRectangleFieldsWidth, #theRectangleFieldsHeight').val(0);
				alert('So sorry.\nPresently only png, gif, or jpeg files can be processed.');
			}
	}
	  document.getElementById('browsedFileName').addEventListener('change', handleFileSelect, false);

	// - - - - - - - - - - - - - - - - - - - - - -

	// 2. pageSetup() function : *** for browsers that don't support FileList API only ***
	// Sets up the web page parameters and displays the image
	// Setup theImageContainer and theRectangle at start of script

	// - - - - - - - - - - - - - - - - - - - - - -

	function pageSetup(){
		var imageFile = $('#eFile').val();	// the name of the file keyed in or choosen

		$('.theSpriteImage').attr('src', imageFile)
							.css('display', 'block');
		$('#theRectangle, theClipedContainer').removeAttr("style");

		$('#temporaryImage').load(function(){ // make sure image is loaded
			//imageWidth   = $('#temporaryImage').width();
			//imageHeight  = $('#temporaryImage').height();
			$('#eHeight').val(trueImageHeight);
			$('#eWidth').val(trueImageWidth);

			$('#theImageWrapper, #theImageContainer, #theClippedContainer')
						.css({'width': trueImageWidth, 'height': trueImageHeight});

			// allow scaling of image to take place by making width & height 100% and then changing size of the containers
			$('#theImage, #theClippedImage').css({'width': '100%', 'height': '100%'});

			// set up initial image background
			colorInBackground(trueColorValue);
		});
	}


	// - - - - - - - - - - - - - - - - - - - - - -

	//	if the HTML5 Filelist API is not supported...

	// 1. $('#btn').click(function() : The 'Show It' button is clicked to retrieve an image
	// What happens when the showIt button gets pressed.  This kicks off the script processing

	// - - - - - - - - - - - - - - - - - - - - - -

	$('#btn').click(function(){
		// console.log('btn.click() function');

		if($('#eFile').val() === ''){
			alert('Please enter the pathname of the Sprite File');
		}else{
			//alert('keyed in image name: '+ $('#eFile').val());
			pageSetup();
			clipIt();
		}
	});


	// Show the entire image or only Clipped portion checkbox. cannot use toggle

	$('#showOnlySelection').change(function(){
		logIt('before ShowOnly checkedproperty: '+ $(this).prop('checked'));

		if ($(this).prop('checked') === true){
			$('#theImageContainer').css('display', 'block');
			$(this).removeProp('checked');
		}else{
			$('#theImageContainer').css('display', 'none');
			$(this).prop('checked', true);
		}
		logIt('after ShowOnly checkmark property: '+ $(this).prop('checked'));
	});

	// Show debug log checkbox. cannot use toggle with checkboxes

	$('#debugOnOff').change(function(){
		logIt('before ' + $(this).prop('id') + ' checked property: '+ $(this).prop('checked'));

		if ($(this).prop('checked') === true){
			$('#logDiv').css('display', 'none');
			$(this).removeProp('checked');
		}else{
			$('#logDiv').css('display', 'block');
			$(this).prop('checked', true);
		}
		logIt('after ' + $(this).prop('id') + ' checked property: '+ $(this).prop('checked'));
	});


	// - - - - - - - - - - - - - - - - - - - - - -

	// 4. $('.amt').keyup(function() : Handles the upArrow and downArrow functionality with form amount fields
	//	when upArrow or downArrow keys are pressed they will adjust the input value
	// $('input').keypress(function (event){ return event.keyCode == 13 ? false : true; });	// disable Enter key

	// - - - - - - - - - - - - - - - - - - - - - -

	$('.amt').keyup(function(evt) {  // use keyup because keypress works only with firefox, not chrome
		var keyCode = (evt.which) ? evt.which : evt.keyCode,
			thisValue = parseFloat($(this).val()).toFixed(1);


		if ((keyCode == 38) || (keyCode == 40))	// or (up arrow or down arrow key)
		{
			//console.log('keyCode: ' + keyCode);

			if (keyCode === 38)		//	was key pressed an arrowUp key?
			{
				thisValue++;
			}

			if (keyCode === 40)		//	was key pressed an arrowDown key?
			{
				thisValue--;
			}
			evt.preventDefault();
			$(this).val(thisValue);
			$('.amt').change();
		}
	});



	// - - - - - - - - - - - - - - - - - - - - - -

	// 8. realignTheRectangle() function : Keeps the clipArea and theRectangle in alignment.
	// The top layer holds theRectangle, the moveable area that is dragged and resized.
	// The real trick here is to align the second layer, the layer with the clipped area that appears
	// the 'show through' the otherwise opaque version of the image, which is in the third layer.

	//	Layer Name			Stacked		zindex	Opacity		notes
	//						order
	//	theRectangle		on top		12		1.0			draggable/resizable transparent rectangle
	//	theClippedContainer	middle		11		1.0			fully visible image in clipped area, hidden everywhere else
	//	theImageContainer	bottom		10		0.5			Opaque version of full image

	// called when ...
	//	- amount on the form is changed by user
	//	- zoomFactor slider is changed by user
	//	- theRectangle is dragged or resized using handles by user

	// - - - - - - - - - - - - - - - - - - - - - -

	function realignTheRectangle(rTop, rLeft, rBottom, rRight, rWidth, rHeight) {
		var clipArea;
		trueClip[0] = rTop    / zoomFactor;		// save *true* updated values
		trueClip[1] = rRight  / zoomFactor;
		trueClip[2] = rBottom / zoomFactor;
		trueClip[3] = rLeft   / zoomFactor;
		// update theRectangle
		$('#theRectangle').css({'top': rTop,
							  'right': rRight,
							 'bottom': rBottom,
							   'left': rLeft,
							  'width': rWidth,
							 'height': rHeight});

		// update the web page 'Selected Rectangle' form fields
		$('#theRectangleFieldsTop')		.val(rTop);
		$('#theRectangleFieldsRight')	.val(rRight);
		$('#theRectangleFieldsBottom')	.val(rBottom);
		$('#theRectangleFieldsLeft')	.val(rLeft);
		$('#theRectangleFieldsWidth')	.val(rWidth);
		$('#theRectangleFieldsHeight')	.val(rHeight);

		// update clipArea

		clipArea = 'rect('+ rTop + 'px ' + rRight + 'px ' + rBottom + 'px ' + rLeft + 'px)';
		$('#theClippedContainer').css({'clip': clipArea});  //alignment is here
		logIt('realignTheRectangle() | zoomFactor: '+zoomFactor+' new clipArea: '+clipArea);
	}



	// - - - - - - - - - - - - - - - - - - - - - -

	// 5. $('.amt').change(function() : Ensures that invalid form amounts are not entered
	// if any input variable changes are keyed in theRectangle is updated

	// - - - - - - - - - - - - - - - - - - - - - -

	$('.amt').change(function(){
		var imageWidth = trueImageWidth * zoomFactor,
			imageHeight = trueImageHeight * zoomFactor,
			thisValue	= parseFloat($(this)					   .val()),
			aTop		= parseFloat($('#theRectangleFieldsTop')   .val()),
			aLeft		= parseFloat($('#theRectangleFieldsLeft')  .val()),
			aBottom		= parseFloat($('#theRectangleFieldsBottom').val()),
			aRight		= parseFloat($('#theRectangleFieldsRight') .val()),
			aWidth		= parseFloat($('#theRectangleFieldsWidth') .val()),
			aHeight		= parseFloat($('#theRectangleFieldsHeight').val());

		switch ($(this).attr('id'))
		{
			case 'theRectangleFieldsWidth':
							aWidth = thisValue;
							aRight = aLeft + thisValue;

							if (thisValue > imageWidth){
								thisValue = aWidth = aRight = imageWidth;
								aLeft = 0;
							}

							if (thisValue < 0){
								thisValue = aWidth = 0;
									aRight = aLeft;
							}

							if((aLeft + thisValue) > imageWidth){
								aRight = imageWidth;
								aLeft  = imageWidth - aWidth;
							}
							break;

			case 'theRectangleFieldsHeight':
							aHeight = thisValue;
							aBottom = aTop + thisValue;

							if (thisValue > imageHeight){
								thisValue = aBottom = aHeight = imageHeight;
								aTop = 0;
							}

							if (thisValue < 0){
								thisValue = aHeight = 0;
								aBottom = aTop;
							}

							if((aTop + thisValue) > imageHeight){
								aBottom = imageHeight;
								aTop    = imageHeight - aHeight;
							}
							break;

			case 'theRectangleFieldsLeft':
							aLeft = thisValue;
							aWidth = aRight - thisValue;

							if (thisValue < 0){
								thisValue = aLeft = 0;
								aWidth = aRight;
							}

							if (thisValue > aRight){
								thisValue = aLeft = aRight;
								aWidth = 0;
							}

							if((aWidth + thisValue) > imageWidth){
								aRight = imageWidth;
								aWidth = imageWidth - thisValue;
							}
							break;

			case 'theRectangleFieldsTop':
							aTop = thisValue;
							aHeight = aBottom - thisValue;

							if (thisValue < 0){
								thisValue = aTop = 0;
								aHeight = aBottom;
							}

							if(thisValue > aBottom){
								thisValue = aTop = aBottom;
								aHeight = 0;
							}

							if((aHeight + thisValue) > imageHeight){
								aBottom = imageHeight;
								aHeight = imageHeight - thisValue;
							}
							break;

			case 'theRectangleFieldsRight':
							if (aWidth < 0){
								aWidth = 0;
								aRight = thisValue = aLeft;
							}

							aRight = thisValue;
							aWidth = thisValue - aLeft;

							if (thisValue > imageWidth){
								thisValue = aRight = imageWidth;
								aWidth = thisValue - aLeft;
							}

							if (thisValue < aLeft){
								thisValue = aRight = aLeft;
								aWidth = 0;
							}

							if (thisValue < 0){
								thisValue = aWidth = aRight = aLeft = 0;
							}
							break;

			case 'theRectangleFieldsBottom':
							aBottom = thisValue;
							aHeight = thisValue - aTop;

							if (thisValue > imageHeight){
								thisValue = aBottom = imageHeight;
								aHeight = thisValue - aTop;
							}

							if (thisValue < aTop){
								thisValue = aBottom = aTop;
								aHeight = 0;
							}
							break;
		}

		$(this).val(thisValue);		// update the corresponding form amount field

		logIt('*end* '+ $(this).attr('id')+' changed - aWidth: '+aWidth+' aLeft: '+aLeft+' aRight: '+aRight+' | aHeight: '+aHeight+ ' aTop: '+aTop+ ' aBottom: '+aBottom);

		$('#theRectangle').css({'height': aHeight, 'width': aWidth});

		realignTheRectangle(aTop, aLeft, aBottom, aRight, aWidth, aHeight);
		clipIt();

	});


	$("#backgroundColor").slider({
									min:0,
									max:16,
									value:9,
									create: function(event, ui) {
										$('a', this).attr('tabIndex', '3');
									},
									change: function(event, ui) {
										trueColorValue = ui.value;
										colorInBackground(ui.value);
									}
	});




	// - - - - - - - - - - - - - - - - - - - - - -

	// 7. $("#zoomFactor").slider() function : Handles the zoom factor slider
	// the slider itself

	// - - - - - - - - - - - - - - - - - - - - - -

	$("#zoomFactor").slider({
						min: 1.0,
						max: 3.0,
					  value: 1.0,
					   step: 0.1,
					 change: function(event, ui) {

			var cTop, cRight, cBottom, cLeft, cHeight, cWidth, clipArray = [],	//extract clipArea to this array
				bb, imageWidth, imageHeight, windowHeight, windowWidth,
				image_to_pageHeightRatio, image_to_pageWidthRatio;

			zoomFactor = ui.value;
			$('#zoomFactorText').text(zoomFactor);

			if(zoomFactor > 1)
				$('#theRectangleFields legend').text('Magnified Selected Area');
			else
				$('#theRectangleFields legend').text('Selected Area');

			imageWidth  = trueImageWidth * ui.value;
			imageHeight = trueImageHeight * ui.value;

			windowHeight = $('body').innerHeight();
			windowWidth  = $('body').innerWidth();
			image_to_pageHeightRatio  = imageHeight / windowHeight;
			image_to_pageWidthRatio   = imageWidth / windowWidth;
			//console.log('image_to_pageWidthRatio: '+image_to_pageWidthRatio+' image_to_pageHeightRatio: '+image_to_pageHeightRatio);
			var x = $('#theClippedContainer').css('clip');
			if (x == 'auto'){		//if cliparea is *not* yet set
				//console.log('zoomFactor slide change - Read clip property of #theClippedContainer. Result: '+ x);
				clipArray[0] = 0;
				clipArray[1] = 0; // was trueImageWidth;
				clipArray[2] = 0; // was trueImageHeight;
				clipArray[3] = 0;
				clipArray[4] = 0; // was trueImageWidth;
				clipArray[5] = 0; // was trueImageHeight;
			}else{
				clipArray = ($('#theClippedContainer').css('clip')).split(' '); // start with "rect(999px 888px 777px 666px)"
				// index 0 will be 'rect(999px', so remove the non-numeric junk
				bb = clipArray[0];
				clipArray[0] = bb.substr(5);
				for (var i=0;i<4;i++)	//clean-up any other non-numerics like 'px' or ',' or ')' or '%'
					clipArray[i] = parseFloat(clipArray[i]);
				clipArray[4] = clipArray[1]  - clipArray[3]; // width
				clipArray[5] = clipArray[2]  - clipArray[0]; // height
			}


			//console.log('zoomFactor slide change - read clip property Top: '+clipArray[0]+' Right: '+clipArray[1]+ ' Bottom: '+clipArray[2]+' Left: '+clipArray[3]+' Width: '+clipArray[4]+' Height: '+clipArray[5]);

			$('#eWidth').val(trueImageWidth * zoomFactor);
			$('#eHeight').val(trueImageHeight * zoomFactor);

			cTop     = trueClip[0] * zoomFactor; // use true clip area for resizing
			cRight   = trueClip[1] * zoomFactor;
			cBottom  = trueClip[2] * zoomFactor;
			cLeft    = trueClip[3] * zoomFactor;

			cWidth   = cRight - cLeft;
			cHeight  = cBottom - cTop;

			logIt('zoomFactor: ' + zoomFactor+ ' cTop: '+cTop+' cRight: '+cRight+ ' cBottom: '+cBottom+' cLeft: '+cLeft+' cWidth: '+cWidth+' cHeight: '+cHeight);

			// adjust scaled image by allowing browser to resize image so the aspect ratio will remain somewhat unchanged
			// allow scaling of image to take place by making width & height 100% and then changing size of the containers

			$('#theImageWrapper, #theImageContainer, #theClippedContainer')
						.css({'width' : imageWidth, 'height': imageHeight});
			$('#theImageContainer, #theClippedContainer')
						.css({'bottom' : trueImageHeight * zoomFactor, 'right': trueImageWidth * zoomFactor});

			if (image_to_pageHeightRatio > image_to_pageWidthRatio){
				$('#theImage, #theClippedImage').css({'width': 'auto', 'height': '100%'});
			}else{
				$('#theImage, #theClippedImage').css({'width': '100%', 'height': 'auto'});
			}

			// adjust the clip area on zoomed page
			$('#theClippedContainer').css({'clip': 'rect('+cTop+'px '+cRight+'px '+cBottom+'px '+cLeft+'px)'});
			realignTheRectangle(cTop, cLeft, cBottom, cRight, cWidth, cHeight);

			colorInBackground(trueColorValue);
		}
	});



/*

		function mouseDownListener(){
			$('#theRectangle').removeAttr('style').css({'position': 'absolute', 'zIndex': 12});
			$('#theImageWrapper').bind('mousedown', theImageWrapperMouseDown)	// re-bind original mousedown handler
								 .unbind('mousedown', mouseDownListener);		// remove mousedown listener
			logIt('*** listener detected mousedown event *** re-binding original handler');
		}
*/

	// - - - - - - - - - - - - - - - - - - - - -

	// 9. theImageWrapperMouseDown() : This function handles the initial location for theRectangle by
	// monitoring mousedown events within theImageWrapper. If the user presses down and drags the mouse
	// then theRectangle is positioned over that location and grown/shrunk as reflected by mouse movements.

	// When the mouse button is released the drawing of theRectangle is relinquished to the .draggable()
	// and .resizable() plug-in routines, as configured below this routine, from within the jQuery UI.

	// At draw-time we must sort out if the originating point is the X-coordinate the left-most or right-most
	// point, and if the Y-coordinate is top-most or bottom-most point, and then accumulate the dimensions
	// of theRectangle from that point.

	// note: measurement is from the top-left corner of page. That means:
	//		top is smaller than bottom
	//		left is smaller than right

	// - - - - - - - - - - - - - - - - - - - - -

	function theImageWrapperMouseDown(){
		var msg, drawStarted=false, rTop, rRight, rBottom, rLeft, rWidth, rHeight,
		currentX, currentY, xDirection = '', yDirection = '';
		//yDirection: 'TtoB' means top-to-bottom, 'BtoT' means bottom-to-top, xDirection:'LtoR' means left-to-right, 'RtoL' means right-to-left

		if (mouseInside === false){	//when mouse is inside a rectangle, let the draggable()/resizable() routines handle processing
			logIt("<br>theImageWrapperMouseDown. Begin drawing ...<br>");
			$('#theRectangle').removeAttr('style').css({'position': 'absolute', 'zIndex': 12});
			// *---------------------------------

			// theImageWrapperMouseMove is an inner function to theImageWrapperMouseDown

			// *---------------------------------
			function theImageWrapperMouseMove(event) {
				var swapping = false;
				if (mouseInside === false){	//when mouse is inside a rectangle, let the draggable()/resizable() routines handle processing
					currentY = event.pageY - 90;		// top:90 and left:480 is the offset of theImage on the page
					currentX = event.pageX - 480;		// we begin at this first point

					if (drawStarted === false){
						drawStarted = true;
						rTop  = +currentY;
						rLeft = +currentX;		// we begin at this first point
						logIt('... at ('+rLeft+', '+rTop+')');
						$('#theRectangle').css({'left': rLeft, 'top': rTop});
					}else{
						logIt('next point ('+currentX+', '+currentY+')');
						// now we need a direction
						switch (yDirection){
							case 'TtoB':
							rBottom = currentY;
							break;

							case 'BtoT':
							rTop = currentY;
							break;

							case '':
								if (rTop > currentY){
									yDirection ='BtoT';
									rBottom = rTop;
									rTop    = currentY;
								}else{
									yDirection ='TtoB';
									rBottom = currentY;
								}
							break;
						}
						rHeight = rBottom - rTop;

						if (rHeight < 0){  // means we must swap top and bottom along with origin
							swapping = true;
							event.pageY = rTop;
							rTop = rBottom;
							rBottom = event.pageY;
							yDirection = yDirection === 'BtoT' ? 'TtoB' : 'BtoT';
						}
						// now we need a direction
						switch (xDirection){
							case 'LtoR':
							rRight = currentX;
							break;

							case 'RtoL':
							rLeft = currentX;
							break;

							case '':
								if (rLeft > currentX){
									xDirection ='LtoR';
									rRight  = rLeft;
									rLeft   = currentX;
								}else{
									xDirection ='RtoL';
									rRight = currentX;
								}
							break;
						}

						rWidth  = rRight - rLeft;

						if (rWidth < 0){  // means we must swap right and left along with origin
							swapping = true;
							event.pageX = rLeft;
							rLeft = rRight;
							rRight = event.pageX;
							xDirection = xDirection === 'LtoR' ? 'RtoL' : 'LtoR';
						}

						if (swapping === true){
							swapping = false;
							$('#theRectangle').css({'right': rRight, 'bottom': rBottom,'width': rWidth, 'height':rHeight});
							msg = 'mouse move flips coordinates. origin: '+ yDirection+xDirection+' now left-top ('+ rLeft + ", " + rTop + ') right-bottom ('+rRight+', '+rBottom+') width: '+rWidth+' height: '+rHeight;
						}

						realignTheRectangle(rTop, rLeft, rBottom, rRight, rWidth, rHeight);
						logIt(msg);
					}
				}
			}		// end of theImageWrapperMouseMove()

			// *---------------------------------

			// mouseup is an inner function to theImageWrapperMouseDown

			// *---------------------------------

			$('#theImageWrapper').mouseup(function(){
				$('#theImageWrapper').unbind('mousemove');
				var msg = "mouseup() ends drawing at (";
				msg += currentX + ", " + currentY + ')';
				logIt(msg);
				clipIt();

			});

			// as part of theImageWrapperMouseDown() processing bind the mousemove
			$('#theImageWrapper').bind('mousemove', theImageWrapperMouseMove);
		} // end mouseInside == false
	} // end of theImageWrapperMouseDown()

	$('#theImageWrapper').bind('mousedown', theImageWrapperMouseDown);  // set original mousedown handler



	$('#theRectangle').hover(function(){
		mouseInside = true;
		logIt('<br>The mouse has entered theRectangle.<br>');
	}, function(){
		mouseInside = false;
		logIt('<br>The mouse has left theRectangle. <br>');
	});


/*
	// reset theRectangle drawing bindings if user clicks on 'New Selection' button
	$('#newSelection').click(function(){
		logIt('clicked on \'New Selection\' button clicked to re-bind original mousedown handler');
		$('#theRectangle').removeAttr('style').css({'position': 'absolute', 'zIndex': 12});
		$('#theImageWrapper').bind('mousedown', theImageWrapperMouseDown)		//start drawing the next theRectangle
							 .unbind('mousedown', mouseDownListener);			// remove mousedown listener
	});
*/



	// - - - - - - - - - - - - - - - - - - - - - -

	// draggable

	// - - - - - - - - - - - - - - - - - - - - - -

	$('#theRectangle').draggable({
					handles: 'all',
				containment: 'parent',
					 cursor: 'crosshair',
					opacity: 0.5,
					start: function(event, ui){
						var cont = $('#theRectangle').draggable('option', 'containment');
						var cHeight = $(cont).height();
						var cWidth = $(cont).width();
						logIt('<p>start of drag. containment: '+cont.id+' height: '+cHeight+' width: '+cWidth+'</p>');
					},
						// the draggable ui returns coordinates relative to the page, not any container
					   drag: function(event, ui) {
			var dTop, dLeft, dBottom, dRight, dWidth, dHeight, iTop, iLeft;

			$("#theImage").unbind('mousemove'); //no longer need this now that we can see theRectangle.
			$("#theImage").unbind('mousedown');

			iTop	= parseInt($('#theImageWrapper').css('top'), 10);
			iLeft	= parseInt($('#theImageWrapper').css('left'), 10);
			dTop	= ui.offset.top  - iTop;
			dLeft	= ui.offset.left - iLeft;
			//console.log('draggable() returns top: '+(ui.offset.top - iTop) +' left: '+(ui.offset.left - iLeft));
			dWidth	= $(this).width();
			dHeight	= $(this).height();
			dBottom	= dTop  + dHeight;
			dRight	= dLeft + dWidth;
			realignTheRectangle(dTop, dLeft, dBottom, dRight, dWidth, dHeight);
			clipIt();
		}
	});


	// - - - - - - - - - - - - - - - - - - - - - -

	// resizable

	// - - - - - - - - - - - - - - - - - - - - - -

	$('#theRectangle').resizable({
				   //disabled: true,
					handles: 'n, e, s, w',
				//	 helper: 'theRectangleHelper',
				containment: 'parent',
				  minHeight: 10,
				   minWidth: 10,
					 resize: function(event, resizedArea) {

		// this function is called when user uses the n, e, s, w cursor handles to resize theRectangle
		// jQuery resizable documentation states:
		// resizedArea.position - {top, left} current position
		// resizedArea.size - {width, height} current size

			var	rTop, rRight, rBottom, rLeft, rWidth, rHeight,
				imageWidth = trueImageWidth * zoomFactor,
				imageHeight = trueImageHeight * zoomFactor;

			$("#theImage").unbind('mousemove'); //no longer need this now that we can see theRectangle.
			$("#theImage").unbind('downFlag');

			rTop    = resizedArea.position.top;
			rBottom = resizedArea.position.top + resizedArea.size.height;
			rLeft   = resizedArea.position.left;
			rRight  = resizedArea.position.left + resizedArea.size.width;
			rHeight = resizedArea.size.height;
			rWidth  = resizedArea.size.width;

			if (rHeight > 0){
				if(resizedArea.position.top <= 0){
					//console.log('Prevented from to dragging outside rTop');
					rTop = 0;
				}
				else{
					rTop = +resizedArea.position.top;		// so adjust coordinates
				}

				if((resizedArea.position.top + resizedArea.size.height) > imageHeight){
					rBottom = imageHeight;
					rHeight = imageHeight - rTop;
				}
				if (rHeight > imageHeight)
					rHeight = imageHeight;

				if (rHeight <= 0){
					rHeight = rHeight = 0;
					rBottom = rTop;
				}

				if (rTop <= 0){
					rTop = 0;
				}

				if(rTop >= imageHeight){
					rTop = rBottom = rHeight = imageHeight;
				}
			}

			if (rWidth > 0){
				if(rLeft <= 0){
					rLeft = 0;
					rRight = rWidth;
				}

				if(rLeft >= imageWidth){
					rLeft= rRight = rWidth = imageWidth;
				}
				if (rLeft < 0)
					rLeft = 0;

				if((rLeft + rWidth) > imageWidth){
					rRight = imageWidth;
					rWidth = imageWidth - rLeft;
				}

				if (rWidth > imageWidth){
					rWidth = imageWidth;
				}
			}

			if (rWidth <= 0){
				rWidth = rWidth = 0;
				rLeft = rRight;
			}

			realignTheRectangle(rTop, rLeft, rBottom, rRight, rWidth, rHeight);
			clipIt();
		}
	});
});
