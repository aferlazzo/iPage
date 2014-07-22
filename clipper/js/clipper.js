
	// The goal of this web page is to provide a way to provide the css clip parameters or the proper background image parameters
	// for a sprite element. We make that magic happen by using the drag and resize widgets from jQuery and manually keeping the
	// rectangle being modified by jQuery aligned with the area specified by the clip property of the div making up that layer.

	// Here's how it works:
	// theImageContainer and theClippedContainer are duplicate divs that are two separate layers at the start of the script.


	// theRectangle is a third layer. It sits on top of theClippedContainer layer and enables the user to drag and resize
	// a rectangular area over the particular element of the sprite image. This area must be kept in synch with the clip
	// property of theClippedContainer layer in order to provide visual feedback to the user that the clip property has the
	// correct parameters.

	// Key Areas of the script

	// filelistAPIsupport() function : Run onload

	// 1. and 2. handleFileSelect() : function (if FileList API is supported by browse)

	// 3. clipIt function : Whenever a form amount is changed the image parameters must be changed to reflect new values
	// 4. $('.amt').keyup(function() : Handles the upArrow and downArrow functionality with form amount fields
	// 5. $('.amt').change(function() : Ensures that invalid form amounts are not entered
	// 6. canvasContrast() function : Handles the background color slider control
	// 7.
	// 8. realignTheRectangle() function : Keeps the clipArea and theRectangle in alignment at all times
	// 9. #theImageWrapper mousedown() function : This section handles the initial location for theRectangle

	// $('#theRectangle').draggable() function : defines the functionality when theRectangle is dragged by user
	// $('#theRectangle').resizable() function : defines the functionality when theRectangle is resized by user



	//first wrap everything up in an aunonymous functon

(function(){
	var debug = {
		bug: "",
		hostname:"",
		bugMe: function(msg){
			if (debug.bug === 'debug=true')
				console.log(msg);
		}
	};

	debug.hostname = location.hostname == "" ? "cannot run the script from a local drive" : location.hostname;
	debug.bug = location.search.substring(1);
	debug.bugMe("hostname: " + debug.hostname );
	debug.bugMe("debug switch: " + debug.bug);

	if (debug.hostname !== location.hostname){
		alert("Sorry, but you " + debug.hostname);
		return -1;
	}




	(function (){
		// Check for the FileList API support.

		if (window.FileList) {
			debug.bugMe('Great news! FileList API is supported.');
			document.getElementById('supportsHTML5').style.display='block';
			return true;
		} else {
			document.getElementById('notSupported').style.display='block';
			alert('Unfortunately the FileList API is not fully supported by this browser.');
			return false;
		}
	})();





	$( "#tabs" ).tabs();
	// the image width and height are set when the image is read from disk.
	var trueImageWidth,
	trueImageHeight,
	trueClip = [],
	mouseInside = false,
	trueColorValue = 9,
	showOnlySelected = false,
	formFilesInitialized = false;
	$( "#tabs" ).css("display","inline");


	// - - - - - - - - - - - - - - - - - - - - - -

	// 6. canvasContrast() function : Handles the background color slider control.
	// Called at pageSetup and when backgroundColor slider is moved.

	// - - - - - - - - - - - - - - - - - - - - - -

	function canvasContrast(colorValue){
		var c = ['#000', '#111', '#222', '#333', '#444', '#555', '#666', '#777', '#888', '#999', '#aaa', '#bbb', '#ccc', '#ddd', '#eee', '#fff', 'transparent'];
		$('#theImageContainer, #theClippedContainer, #previewImage').css({'backgroundColor': c[colorValue]});
		if (colorValue < 16) {
			//$('#bkColor').css('backgroundColor', c[colorValue]);
			$('#contrast').css({'backgroundImage':'none', 'backgroundColor': c[colorValue]});
		}
		else
			$('#contrast').css('background', 'url("images/transparent.png") 0 0 repeat');
	}


	// - - - - - - - - - - - - - - - - - - - - - -

	// 3. clipIt function : Whenever a form amount is changed the image parameters must be changed to reflect new values
	// Update theClipContainer Parameters whenever a value is changed. The user sees the parameters in the Focus Rectangle
	// and CSS Selection fieldsets in the form

	// - - - - - - - - - - - - - - - - - - - - - -

	function clipIt(){
		var imageFile					= $('#eFile').val(),
			theRectangleFieldsTop		= parseFloat($('#theRectangleFieldsTop')	.val()).toFixed(1),
			theRectangleFieldsRight		= parseFloat($('#theRectangleFieldsRight')	.val()).toFixed(1),
			theRectangleFieldsBottom	= parseFloat($('#theRectangleFieldsBottom')	.val()).toFixed(1),
			theRectangleFieldsLeft		= parseFloat($('#theRectangleFieldsLeft')	.val()).toFixed(1),
			theRectangleFieldsWidth		= parseFloat($('#theRectangleFieldsWidth')	.val()).toFixed(1),
			theRectangleFieldsHeight	= parseFloat($('#theRectangleFieldsHeight')	.val()).toFixed(1),
			cssPosition, clipArea, xPosition, yPosition,
			previewWidth, previewHeight, previewCanvas = document.getElementById('previewCanvas'), w, h,
			ctx = previewCanvas.getContext('2d'), imageSrc;
			//maxWidth = parseInt($('#canvasId').css('width')),
			//maxHeight = parseInt($('#canvasId').css('height'));


		imageSrc = document.getElementById("theImage");


		w = parseInt(theRectangleFieldsRight);
		h = parseInt(theRectangleFieldsBottom);
		clipArea	= 'rect('+  parseInt(theRectangleFieldsTop) + 'px, ' +

								(w <= trueImageWidth ? w : trueImageWidth) + 'px, ' +
								(h <= trueImageHeight ? h : trueImageHeight) + 'px, ' +

								parseInt(theRectangleFieldsLeft) + 'px)';

		$('#theClippedContainer').css({'clip': clipArea});
		cssPosition	= $('#theImageContainer').css('position');
		xPosition = (theRectangleFieldsLeft * -1).toFixed(0);
		yPosition = (theRectangleFieldsTop * -1).toFixed(0);
		w = (+theRectangleFieldsWidth).toFixed(0);
		h = (+theRectangleFieldsHeight).toFixed(0);
		previewWidth = w <= trueImageWidth ? w : trueImageWidth;
		previewHeight = h <= trueImageHeight ? h : trueImageHeight;

		$('#css1Displayed').html('<p>for sprite:<br>cssSelector {<br>' +
						'background-image: url("' + imageFile + '");<br>' +
						'background-position: ' + xPosition + 'px ' + yPosition + 'px;<br>'+
						'position: absolute;<br>' +
						'width: '    + previewWidth + 'px; ' +
						'height: '   + previewHeight + 'px;}</p>');

		$('#css2Displayed').html('<p>for clipped area:<br>cssSelector {<br>' +
						'background-image: url(\'' + imageFile + '\');<br>' +
						'position: ' + cssPosition + ';<br>' +
						'width: '    + previewWidth + 'px; ' +
						'height: '   + previewHeight + 'px;<br>' +
						'clip:'      + clipArea + ';}</p>');


		$('#previewImage').css({			//  'background-image': 'url("' + imageFile + '")',
						   'background-position': xPosition + ' ' + yPosition,
									  'position': 'absolute',
										 'width': previewWidth,
										'height': previewHeight});

		$('#previewCanvas').attr('width', trueImageWidth).attr('height', trueImageHeight);

		$('#previewDiv').css({'width': previewWidth, 'height': previewHeight});

		ctx.drawImage(imageSrc, 0, 0, trueImageWidth, trueImageHeight, xPosition, yPosition, trueImageWidth, trueImageHeight);
	}



		// - - - - - - - - -//
		//					//
		//		Canvas		//
		//		related		//
		//					//
		// - - - - - - - - -//



	var CanvasObject = function () {
		this.backgroundColor = 'rgba(0, 0, 0, 0)';

		// read the rgba of the canvas context at position (x,y) for width / height of 1 pixel
		this.getPixelColor = function(ctx, x, y) {
			var imageData = ctx.getImageData(x, y, 1, 1);
				bytes = imageData.data;
				red   = bytes[0],
				green = bytes[1],
				blue  = bytes[2],
				alpha = bytes[3];

			return "rgba("+red+", "+green+", "+blue+", "+alpha+")";
		}

		// create an image DOM element
		// then use the canvas API 'drawImage' to place the image object at (0,0)

		this.getImageSrc = function(imageSrc, ctx) {
			var img = document.createElement('IMG');
			img.setAttribute('id', 'myImage');

			img.onload = function(){
				ctx.drawImage(img, 0, 0)
			}
			img.src = imageSrc;
		}



		this.fineTuneSizing = function(currentBackgroundColor, ctx, leftEdge, topEdge, h, w) {
			var foundEdge = false, mustExpand = false, rightEdge = leftEdge + w, bottomEdge = topEdge + h, xStart, yStart;

			debug.bugMe('fine-tuning start. leftEdge: '+leftEdge+' topEdge: '+topEdge+' height: '+h+' width: '+w+' comparing edge pixels to currentBackgroundColor: ' + currentBackgroundColor);


			// fine-tune left

			while (foundEdge == false)
			{
				for (i = topEdge; i<= bottomEdge; i++) {
					if (this.getPixelColor(ctx, leftEdge, i) !== currentBackgroundColor) {
						leftEdge--;
						w++;
						debug.bugMe('found color not matching currentBackgroundColor at row '+i+'. Expanding left to '+leftEdge+'. Width is now '+w);


						if(leftEdge > 0)
							mustExpand = true;
						else{
							leftEdge = 0;
							w--;
							mustExpand = false;
						}
						break;



					}
					else
						debug.bugMe('left position ('+leftEdge+', '+i+')  matches currentBackgroundColor');
				}
				if (mustExpand === true) {
					mustExpand = false;
				}else{
					foundEdge = true;
					debug.bugMe('left fine-tuned to '+leftEdge);
				}
				debug.bugMe('found leftEdge: ' + foundEdge);
			}

			debug.bugMe('fine-tuning done with left. leftEdge: '+leftEdge+' topEdge: '+topEdge+' height: '+h+' width: '+w+' comparing edge pixels to currentBackgroundColor: ' + currentBackgroundColor);

			// fine-tune top

			mustExpand = foundEdge = false;

			while (foundEdge == false)
			{
				for (i = leftEdge; i<= rightEdge; i++) {
					if (this.getPixelColor(ctx, i, topEdge) !== currentBackgroundColor) {
						topEdge--;
						h++;
						debug.bugMe('found color not currentBackgroundColor at row '+i+'. Expanding top to '+topEdge+'. Height is now '+h);



						if(topEdge > 0)
							mustExpand = true;
						else{
							mustExpand = false;
							h--;
							topEdge = 0;
						}

						break;






					}
					else
						debug.bugMe('top position ('+i+', '+topEdge+') matches currentBackgroundColor');
				}
				if (mustExpand === true) {
					mustExpand = false;
				}else{
					foundEdge = true;
					debug.bugMe('top fine-tuned to '+topEdge);
				}
				debug.bugMe('found topEdge: ' + foundEdge);
			}

			debug.bugMe('fine-tuning done with top. leftEdge: '+leftEdge+' topEdge: '+topEdge+' height: '+h+' width: '+w+' comparing edge pixels to currentBackgroundColor: ' + currentBackgroundColor);

			// fine-tune right

			mustExpand = foundEdge = false;
			rightEdge = leftEdge + w;

			while (foundEdge == false)
			{
				for (i = topEdge; i<= bottomEdge; i++) {
					if (this.getPixelColor(ctx, rightEdge, i) !== currentBackgroundColor) {
						rightEdge++;
						w++;
						debug.bugMe('found color not matching currentBackgroundColor at row '+i+'. Expanding right to '+rightEdge+'. Width is now '+w);


						if(rightEdge < trueImageWidth)
							mustExpand = true;
						else{
							mustExpand = false;
							rightEdge = trueImageWidth;
							w--;
						}

						break;






					}
					else
						debug.bugMe('right position ('+rightEdge+', '+i+') matches currentBackgroundColor');
				}
				if (mustExpand === true) {
					mustExpand = false;
				}else{
					foundEdge = true;
					debug.bugMe('right fine-tuned to '+rightEdge);
				}
				debug.bugMe('found rightEdge: ' + foundEdge);
			}

			debug.bugMe('fine-tuning done with right. leftEdge: '+leftEdge+' topEdge: '+topEdge+' height: '+h+' width: '+w+' comparing edge pixels to currentBackgroundColor: ' + currentBackgroundColor);

			// fine-tune bottom

			mustExpand = foundEdge = false;
			bottomEdge = topEdge + h;

			while (foundEdge == false)
			{
				for (i = leftEdge; i<= rightEdge; i++) {
					if (this.getPixelColor(ctx, i, bottomEdge) !== currentBackgroundColor) {
						bottomEdge++;
						h++
						debug.bugMe('found color not matching currentBackgroundColor at row '+i+'. Expanding bottom to '+bottomEdge+'. Height is now '+h);






						if(bottomEdge < trueImageHeight)
							mustExpand = true;
						else{
							mustExpand = false;
							bottomEdge = trueImageHeight;
							h--;
						}

						break;

					}
					else
						debug.bugMe('bottom position ('+i+', '+bottomEdge+') matches currentBackgroundColor');
				}
				if (mustExpand === true) {
					mustExpand = false;
				}else{
					foundEdge = true;
					debug.bugMe('bottom fine-tuned to '+bottomEdge);
				}
				debug.bugMe('found bottomEdge: ' + foundEdge);
			}

			debug.bugMe('fine-tuning done with bottom. leftEdge: '+leftEdge+' topEdge: '+topEdge+' height: '+h+' width: '+w+' comparing edge pixels to currentBackgroundColor: ' + currentBackgroundColor);

			// in case element extends to edge of the sprite

			if (leftEdge === -1){
				leftEdge = 0;
				w--;
			}
			if (rightEdge > trueImageWidth){
				rightEdge = trueImageWidth;
				w--;
			}

			if (topEdge === -1){
				topEdge = 0;
				h--;
			}
			if (bottomEdge > trueImageHeight){
				bottomEdge = trueImageHeight;
				h--;
			}




			debug.bugMe('fineTuneSizing() found edges')

/*
			// remove the 1 pixel BLANK border from the element and the 1 pixel border
			w -= 3;
			h -= 3;
			leftEdge++;
			topEdge += 2;
*/


			//$('#onTop').css({'left': leftEdge, 'top': topEdge, 'height':h, 'width':w});
			xStart = (leftEdge + rightEdge)/2;
			yStart = (topEdge + bottomEdge)/2;
			$('#onTop').css({'left': xStart, 'top': yStart, 'height':1, 'width':1})
						.animate({'left': leftEdge, 'top': topEdge, 'height':h, 'width':w}, 'slow', function(){
							realignTheRectangle(topEdge, leftEdge, bottomEdge, rightEdge, w, h);
							clipIt();
							$('#onTop').css('display', 'none');

							$( "#tabs" ).tabs('select', 1); // switch to Output tab
						});
		}		// end of fineTuneSizing




		// Beginning where the canvas is clicked determine where there is a pixel matching the currentBackgroundColor by first looking along the y-axis.
		// Save the coordinates of the pixels matching currentBackgroundColor at topEdge and bottomEdge. Next do the same for the x-axis, saving at leftEdge and rightEdge.

		this.roughSizing = function(currentBackgroundColor, ctx, x, y) {
			var topEdge, rightEdge, bottomEdge, leftEdge, h, w, color, foundIt = false;

			debug.bugMe('roughtSizing() comparing pixels to ' + currentBackgroundColor);

			for (topEdge = y; ((topEdge > 0) && (foundIt === false)); topEdge--) {
				if (this.getPixelColor(ctx, x, topEdge) === currentBackgroundColor) {
					foundIt = true;
				}
			}
			foundIt = false;

			for (bottomEdge = y; ((bottomEdge < trueImageHeight) && (foundIt === false)); bottomEdge++) {
				if (this.getPixelColor(ctx, x, bottomEdge) === currentBackgroundColor) {
					foundIt = true;
				}
			}
			foundIt = false;

			for (leftEdge = x; ((leftEdge > 0) && (foundIt === false)); leftEdge--) {
				if (this.getPixelColor(ctx, leftEdge, y) === currentBackgroundColor) {
					foundIt = true;
				}
			}
			foundIt = false;

			for (rightEdge = x; ((rightEdge < trueImageWidth) && (foundIt === false)); rightEdge++) {
				if (this.getPixelColor(ctx, rightEdge, y) === currentBackgroundColor) {
					foundIt = true;
				}
			}

			h = bottomEdge - topEdge;
			w = rightEdge - leftEdge;
			debug.bugMe('roughSizing() getDimensions: start ('+ leftEdge + ', ' + topEdge + ')...end (' + rightEdge + ', ' + bottomEdge + ')');

			this.fineTuneSizing(currentBackgroundColor, ctx, leftEdge, topEdge, h, w);
		}
	}











	// - - - - - - - - - - - - - - - - - - - - - -

	// 1. and 2. (*** if FileList API is supported by browser ***)
	// Uses the new HTML 5 API to do local file read in javascript.
	// This is the function run when a file is selected by the user.

	// - - - - - - - - - - - - - - - - - - - - - -


	function handleFileSelect(evt) {
		var imagesHere, i, f, files = evt.target.files; // FileList object

		// reset:

		$('#canvasId').attr('width', 0).attr('height', 0);

		imagesHere = $('.theSpriteImage').size();
		debug.bugMe('number of sprite images in memory: ' + imagesHere);
		for (i=0; i< imagesHere; i++){
			$('.theSpriteImage').eq(i).removeAttr('src');
			debug.bugMe('removing src from Id: ' + $('.theSpriteImage').eq(i).attr('id'));
		}
		//debug.bugMe('after remove, number of sprite images in memory: '+$('.theSpriteImage').size());


		$('#theImageWrapper, div#theImageContainer, #theClippedContainer, #theRectangle, #onTop, #theRectangle')
				.css({'width':0, 'height': 0, 'top': 0, 'bottom': 0, 'left': 0, 'right': 0});


		$('#theImageWrapper').css({'top': 90, 'left': 480});

		$('#theClipperContainer').css({'clip': 'rect(0, 0, 0, 0)'});


		$('#onTop, .theSpriteImage').css({'display':'none'});



		f = files[0];

			// Progess only image files.
		if ((f.type === 'image/png') || (f.type === 'image/jpeg')) {
		var reader = new FileReader();

		// function to capture the file read by the FileList API.
		reader.onload = (function(theFile) {
			return function(e) {
				var imageRead = e.target.result,
					theCanvas = new CanvasObject();		// create a new canvas object

				$('.theSpriteImage').attr('src', e.target.result)
									.css('display', 'block');
				$('#eFile').val(theFile.name);				// fill-in the name of the file that was selected

				$('#temporaryImage').load(function(){		// when sprite image is loaded
					var X, Y, canvas = document.getElementById('canvasId'),
						ctx = canvas.getContext('2d');		// now get the '2d' context for the draw functions

					trueImageWidth   = $('#temporaryImage').width();
					trueImageHeight  = $('#temporaryImage').height();

					$('#eHeight').val(trueImageHeight);
					$('#eWidth').val(trueImageWidth);

					// set image on page and populate form fields
					$('#theImageWrapper, #theImageContainer, #theClippedContainer')
								.css({'width': trueImageWidth, 'height': trueImageHeight});

					// now update the canvas with the size of the image
					$('#canvasId').attr('width', trueImageWidth).attr('height', trueImageHeight);

					theCanvas.getImageSrc(imageRead, ctx);		// create image read from disk, put on canvas.

					// when mouse is moved inside the canvas
					$(canvas).mousemove(function(e){			// bind this function to the mousemove event
						X = e.layerX;
						Y = e.layerY;
					});





					$(canvas).click(function() {
						debug.bugMe('canvas clicked');
						$('#onTop').css('display', 'block');
						var colorClicked = theCanvas.getPixelColor(ctx, X, Y);		// different browsers support layerX, pageX, clientX, etc onmousemove

						radio = $('#fgColor').is(':checked');
						debug.bugMe('forground radio button is ' + radio);
						if ($('#fgColor').is(':checked') === true){
							$('#fgDiv').css('backgroundColor', colorClicked);
							if (colorClicked !== theCanvas.backgroundColor) {
								debug.bugMe('clicked at position ('+X+', '+Y+') color was '+colorClicked+' backgroundColor: '+ theCanvas.backgroundColor);
								theCanvas.roughSizing(theCanvas.backgroundColor, ctx, X, Y);
							}
						}else{
							debug.bugMe('background color clicked: '+colorClicked);

							if(colorClicked === 'rgba(0, 0, 0, 0)'){
								$('#bkDiv').css('background', 'url("images/transparent.png") 0 0 repeat');
							}else{
								$('#bkDiv').css({'background': 'none', 'backgroundColor': colorClicked});
							}

							theCanvas.backgroundColor = colorClicked;
							$('#fgColor').attr('checked', true);
						}
					});




					//$('#theImageWrapper').css('display', 'block');
					$('#theRectangleFieldsWidth,  #theRectangleFieldsRight').val(0);	// set the form field values
					$('#theRectangleFieldsHeight, #theRectangleFieldsBottom').val(0);
					$('#theRectangleFieldsTop,    #theRectangleFieldsLeft').val(0);

					// allow scaling of image to take place by making width & height 100% and then changing size of the containers
					$('#theImage, #theClippedImage').css({'width': '100%', 'height': '100%'});
					clipIt();
				});
			};
		})(f);


		// Read in the image file as a data URL.
		reader.readAsDataURL(f);
	}else{
		$('#theClippedContainer').css('clip', 'rect(-999px -999px -999px -999px)');
		$('#eFile').val('');
		$('#theRectangleFieldsTop, #theRectangleFieldsLeft, #theRectangleFieldsBottom, #theRectangleFieldsRight, #theRectangleFieldsWidth, #theRectangleFieldsHeight').val(0);
		alert('So sorry.\nPresently only png, gif, or jpeg files can be processed.');
		}
	}		// end of handleFileSelect function





	document.getElementById('browsedFileName').addEventListener('change', handleFileSelect, false);







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
			debug.bugMe('keyCode: ' + keyCode);

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

	// 8. realignTheRectangle() function : Keeps the clipArea, theRectangle, and onTop in alignment.
	// The top layer holds theRectangle, the moveable area that is dragged and resized.
	// The real trick here is to align the second layer, the layer with the clipped area that appears
	// the 'show through' the otherwise opaque version of the image, which is in the third layer.

	//	Layer Id			Stacked		zindex	Opacity		notes
	//						order
	//	onTop					1		20		1.0			has the blue rectangle border

	//	theRectangle			2		15		1.0			draggable/resizable transparent rectangle
	//	canvasId				3		12		1.0			HTML5 canvas can be read & written directly
	//	theClippedContainer		4		11		1.0			fully visible image in clipped area, hidden everywhere else
	//	theImageContainer		5		10		0.5			Opaque version of full image

	// called when ...
	//	- amount on the form is changed by user
	//	- theRectangle is dragged or resized using handles by user

	// - - - - - - - - - - - - - - - - - - - - - -

	function realignTheRectangle(rTop, rLeft, rBottom, rRight, rWidth, rHeight) {
		var clipArea;
		trueClip[0] = rTop;
		trueClip[1] = rRight;
		trueClip[2] = rBottom;
		trueClip[3] = rLeft;

		// update theRectangle and onTop divs
		$('#theRectangle, #onTop').css({'top': rTop,
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
	}



	// - - - - - - - - - - - - - - - - - - - - - -

	// 5. $('.amt').change(function() : Ensures that invalid form amounts are not entered
	// if any input variable changes are keyed in theRectangle is updated

	// - - - - - - - - - - - - - - - - - - - - - -

	$('.amt').change(function(){
		var imageWidth = trueImageWidth,
			imageHeight = trueImageHeight,
			thisValue	= parseFloat($(this)					   .val()),
			aTop		= parseFloat($('#theRectangleFieldsTop')   .val()),
			aLeft		= parseFloat($('#theRectangleFieldsLeft')  .val()),
			aBottom		= parseFloat($('#theRectangleFieldsBottom').val()),
			aRight		= parseFloat($('#theRectangleFieldsRight') .val()),
			aWidth		= parseFloat($('#theRectangleFieldsWidth') .val()),
			aHeight		= parseFloat($('#theRectangleFieldsHeight').val());

		switch (this.id)
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


		$('#theRectangle').css({'height': aHeight, 'width': aWidth});

		realignTheRectangle(aTop, aLeft, aBottom, aRight, aWidth, aHeight);
		clipIt();

	});		// end of $('.amt').change(function()


	$("#contrastSlider").slider({
									min:0,
									max:16,
									value:9,
									create: function(event, ui) {
										$('a', this).attr('tabIndex', '3');
									},
									change: function(event, ui) {
										trueColorValue = ui.value;
										canvasContrast(ui.value);
									}
	});







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
		var drawStarted=false, rTop, rRight, rBottom, rLeft, rWidth, rHeight,
		currentX, currentY, xDirection = '', yDirection = '';
		//yDirection: 'TtoB' means top-to-bottom, 'BtoT' means bottom-to-top, xDirection:'LtoR' means left-to-right, 'RtoL' means right-to-left

		if (mouseInside === false){	//when mouse is inside a rectangle, let the draggable()/resizable() routines handle processing
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
						$('#theRectangle').css({'left': rLeft, 'top': rTop});
					}else{
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
						}

						realignTheRectangle(rTop, rLeft, rBottom, rRight, rWidth, rHeight);
					}
				}
			}		// end of theImageWrapperMouseMove()

			// *---------------------------------

			// mouseup is an inner function to theImageWrapperMouseDown

			// *---------------------------------

			$('#theImageWrapper').mouseup(function(){
				$('#theImageWrapper').unbind('mousemove');
				clipIt();

			});

			// as part of theImageWrapperMouseDown() processing bind the mousemove
			$('#theImageWrapper').bind('mousemove', theImageWrapperMouseMove);
		} // end mouseInside == false
	} // end of theImageWrapperMouseDown()


	$('#theImageWrapper').bind('mousedown', theImageWrapperMouseDown);  // set original mousedown handler





	$('#theRectangle').hover(function(){
		mouseInside = true;
	}, function(){
		mouseInside = false;
	});




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
			debug.bugMe('draggable() returns top: '+(ui.offset.top - iTop) +' left: '+(ui.offset.left - iLeft));
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
				imageWidth = trueImageWidth,
				imageHeight = trueImageHeight;

			$('#theRectangle').css('border', '1px solid #00f');

			$("#theImage").unbind('mousemove'); //no longer need this now that we can see theRectangle.
			$("#theImage").unbind('downFlag');

			rTop    = resizedArea.position.top;
			rBottom = resizedArea.position.top + resizedArea.size.height;
			rLeft   = resizedArea.position.left;
			rRight  = resizedArea.position.left + resizedArea.size.width;
			rHeight = resizedArea.size.height;
			rWidth  = resizedArea.size.width;
			debug.bugMe('resizing ('+rLeft+', '+rTop+') to ('+rRight+', '+rBottom+')');

			if (rHeight > 0){
				if(resizedArea.position.top <= 0){
					debug.bugMe('Prevented from resizing outside rTop');
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
			}else{
				if (rWidth > 0){
					if(rLeft <= 0){
						debug.bugMe('Prevented from resizing outside rLeft');
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
			}
				realignTheRectangle(rTop, rLeft, rBottom, rRight, rWidth, rHeight);
				clipIt();
			}
	});
})();
