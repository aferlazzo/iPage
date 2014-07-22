	function sendingValues(){
		//alert('File Id: ' + $('#eFile').val() + '\n value: ' + document.getElementById("eFile").value);
		if ($('#eFile').val() == ""){
			alert('Please specify a pathname');
			return false;
		}
	}

$(document).ready(function(){
	//	when upArrow or downArrow keys are pressed they will adjust the input value
	//$('.amt').keyup(function(evt) {  // use keyUp because keypress works only with firefox, not chrome

	$('.amt').keyup(function(evt) {  // use keyUp because keypress works only with firefox, not chrome
		var keyCode = (evt.which) ? evt.which : evt.keyCode;
		//alert('keyCode: ' + keyCode);
		if (keyCode === 38)		//	was key pressed an arrowUp key?
		{
			//alert('current value is ' + $(this).val());
			$(this).val(parseInt($(this).val()) + 1);
		}
		if (keyCode === 40)		//	was key pressed an arrowDown key?
		{
			$(this).val(parseInt($(this).val()) - 1);
		}
		clipIt();
	});

	// Update the Clip Parameters when something changes

	function clipIt(){
		var theFile 			= $('#eFile').val(),
			theWidth 			= +($('#eWidth').val()),
			theHeight			= +($('#eHeight').val()),
			theTop				= +($('#theTop').val()),
			theRight			= +($('#theRight').val()),
			theBottom			= +($('#theBottom').val()),
			theLeft				= +($('#theLeft').val()),
			theClipArea			= 'rect('+ theTop + 'px ' + theRight + 'px ' + theBottom + 'px ' + theLeft + 'px)',
			cssPosition			= $('#theFocusArea').css('position'),
			theRectangleWidth	= theRight - theLeft,
			theRectangleHeight	= theBottom - theTop,
			theRectangleTop		= theTop  + parseInt($('#theFocusArea').css('top')),
			theRectangleLeft	= theLeft + parseInt($('#theFocusArea').css('left')),

		//console.log('top: ' + theRectangleTop + ' = ' + theTop + ' + ' + parseInt($('#theFocusArea').css('top')) + ' left: ' + theRectangleLeft + ' = ' + theLeft + ' + ' + parseInt($('#theFocusArea').css('left')));

			spriteLeft = theLeft > 0 ? theLeft * -1 : 0,
			spriteTop = theTop > 0 ? theTop * -1 : 0;
		$('#cssDisplayed').html('<p>for sprite:<br>cssSelectorWrapper {<br>background-image: url(\'' + theFile + '\') '+ spriteLeft + ' ' + spriteTop + ';<br>'+
							'position: absolute;<br>' +
							'height: ' + (theBottom - theTop) + ' px;<br>' +
							'width: ' + (theRight - theLeft) + 'px;}</p>' +
							'<p>for clipped area:<br>cssSelector {<br>' +
							'background-image: url(\'' + theFile + '\');<br>' +
							'position: ' +  cssPosition + ';<br>' +
							'width: ' +		theWidth + 'px;<br>' +
							'height: ' +	theHeight + 'px;<br>' +
							'clip:' +		theClipArea + ';}</p>');

		theFileName = document.getElementById('eFile').value;
		$('#theFullImage').css({'backgroundImage': 'url("'+theFileName+'")', 'width': theWidth, 'height': theHeight});
		$('#theFocusArea').css({'backgroundImage': 'url("'+theFileName+'")', 'width': theWidth, 'height': theHeight, 'clip': theClipArea});
		$('#theRectangle').css({'top': theRectangleTop, 
							 'height': theRectangleHeight,
							   'left': theRectangleLeft, 
							  'width': theRectangleWidth});
	}

	// if any input variable changes are entered ...
	$('.amt').change(function(){
		clipIt();
	});

	$("#backgroundColor").slider({	min:0, 
									max:15, 
									value:7,  
									change: function(event, ui) {
										c = ['#000', '#111', '#222', '#333', '#444', '#555', '#666', '#777', '#888', '#999', '#aaa', '#bbb', '#ccc', '#ddd', '#eee', '#fff']; 
										$('#theFullImage, #theFocusArea, #theRectangle').css('backgroundColor', c[ui.value]);
										$('#theRectangle').css('opacity', '.10');
									}
							});
	
	
	$('#clipForm').draggable({'handle': 'legend'});

	$('#theRectangle').draggable({containment: '#theFullImage',
									 'cursor': 'crosshair',
										 stop: function(event, ui) {
							var offsetTop	= parseInt($('#theFocusArea').css('top'), 10),	// theRectangle coordinates are relative to web page
								offsetLeft	= parseInt($('#theFocusArea').css('left'), 10),	// but clipAre is relative to the image itself
								top			= ui.offset.top - offsetTop,
								left		= ui.offset.left - offsetLeft,
								width		= parseInt($('#theRectangle').css('width'), 10),	// does not change in a drag
								height		= parseInt($('#theRectangle').css('height'), 10),	// ditto
								bottom		= top + height,
								right		= left + width,
								clipArea	= 'rect('+top+'px '+right+'px '+bottom+'px '+left+'px)';
								//console.log('dragging: new rectangle: top ' + top + ' left ' + left + ' width ' + width + ' height ' + height + ' ' + clipArea);
								$('#theFocusArea').css({'clip': clipArea});
								$('#theTop').val(top);
								$('#theBottom').val(bottom);
								$('#theLeft').val(left);
								$('#theRight').val(right);
								clipIt();
							}
						})

					  .resizable({  handles: 'n, e, s, w',
								containment: '#theFullImage',
								  minHeight: 0,
								   minWidth: 0,
									   stop: function(event, ui) {
						var offsetTop	= parseInt($('#theFocusArea').css('top'), 10),		// theRectangle coordinates are relative to web page
							offsetLeft	= parseInt($('#theFocusArea').css('left'), 10),		// but clipAre is relative to the image itself
							top			= ui.position.top - offsetTop,
							//left		= ui.position.left - offsetLeft,
							//width		= ui.size.width,
							left		= parseInt($('#theRectangle').css('left'), 10) - offsetLeft, // ui.position.left - offsetLeft,
							width		= (ui.size.width > 0 ? ui.size.width : parseInt($('#theRectangle').css('width'), 10)),
							height		= ui.size.height,
							bottom		= top + height,
							right		= left + width,
							clipArea	= 'rect('+top+'px '+right+'px '+bottom+'px '+left+'px)';

							// documentarion states: 
							// ui.position - {top, left} current position
							// ui.size - {width, height} current size

	console.log('resizing ui.size.width: ' + ui.size.width + ' ui.size.height: ' + ui.size.height + ' ui.position.top: ' + ui.position.top + ' ui.position.left: ' + ui.position.left);
	//console.log('rectangle width: ' + $('#theRectangle').css('width') + ' ui.size.width: ' + ui.size.width + ' height: ' + ui.size.height + ' top: ' + ui.position.top + ' ui.position.left: ' + ui.position.left + ' rectangle left: ' + $('#theRectangle').css('left') );
	//console.log('resizing: new rectangle: top ' + top + ' left ' + left + ' width ' + width + ' height ' + height + ' ' + clipArea);
							$('#theFocusArea').css({'clip': clipArea});
							$('#theTop').val(top);
							$('#theBottom').val(bottom);
							$('#theLeft').val(left);
							$('#theRight').val(right);
							clipIt();
						}
					});

	// Enter defaults at start of script

	var theWidth = +($('#eWidth').val()),		// coordinates of the clipped image, theFocusArea
		theHeight = +($('#eHeight').val()),
		theLeft, theRight, theTop, theBottom;

	if (theWidth < 300){
		$('#theLeft').val(Math.round(theWidth * 0.1));
		$('#theRight').val(Math.round(theWidth * 0.9));
	}else{
		$('#theLeft').val(40);
		$('#theRight').val(250);
	}

	if (theHeight < 300){
		$('#theTop').val(Math.round(theHeight * 0.1));
		$('#theBottom').val(Math.round(theHeight * 0.9));
	}else{
		$('#theTop').val(40);
		$('#theBottom').val(250);
	}
	clipIt();
});
