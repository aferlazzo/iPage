/* globalstrict:true, validthis:true, jquery:true, browser:true */
var preloaded = [],

// these CAPITALIZED variables are constants and should not be modified after declaration
	ACTIVECOLOR				= '#002c85',
	DEFAULTCOLOR			= '#1A83A3',
	HIGHLIGHTCOLOR			= '#c5073d',
	EASINGTYPE					= 'easeOutQuad',
	VIBRATION_INTERVAL	= 90,
	VIBRATION_DURATION	= 2000,
	SHAKE							= 4,


	// Creates an object  for the feedback form

	feedback = {
		name: '',
		email: '',
		text: ''
	};




(function () {
	var i, xxx = ['./images/ProntoBackground.png', './images/lightbluecrosshatch.gif', './images/spriteMe.png'];

	for (i = 0; i < 3; i++) {
		preloaded[i] = document.createElement('img');
		preloaded[i].setAttribute('src', xxx[i]);
	}
})();


	//	- - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

	//	We have several objects important to this script

	//	1. PanelObjects have to do with the panels themselves
	//	2. ScrollObject has to do with scrolling the panels
	//	3. CharacterObject - part of heading
	//	4. WordObject - part of heading
	//	5. HeadingObject - part of heading
	//	6. FeedbackObject - for feedback form

	//	- - - - - - - - - - - - - - - - - - - - - - - - - - - - - -


	// Creating objects: let's define the character, word and heading object

	function CharacterObject() {
		this.asciiChar = '';
		this.pixelWidth = 0;
		this.wordOffset = 0;
		this.headingOffset = 0;
		this.rockingTimeoutId = '';
	}


	function WordObject() {
		this.numberOfCharacters = 0;
		this.char = [];		// each WordObject has an array of characters

		//this.addChar = function (w, c) {
			//wordArray[w].char[c] = new CharacterObject();		// add a char property to the word object
			//var wword1 = wordArray[w];
			//wword1.char[c] = new CharacterObject();		// add a char property to the word object
		//};
	}

		var wordArray = ["empty",  new WordObject(),  new WordObject(),  new WordObject()];

	function HeadingObject() {
		this.headVertical = false;
		this.numberOfWords = 0;
		this.mySelector = '#absoluteHead';

		// separate mySelector into spans, using the lettering plug-in, so there are word# and char# classes.
		this.initialize = function () {
			var w, c, wordPixelOffset = 0, selectorPixelOffset = 0;

			$(this.mySelector).lettering('words').children('span').lettering();

			this.numberOfWords = $(this.mySelector + ' > span').length;

			for (w = 1; w <= this.numberOfWords; w++) {
				wordArray[w].numberOfCharacters = $('.word' +  w  +  ' > span').length;

				//console.log('word' + w + ' has ' +  wordArray[w].numberOfCharacters + ' characters');

				for (c = 1; c <= wordArray[w].numberOfCharacters; c++) {
					if (c === 1) {								// reset the word's left offset if at the start of a word
						wordPixelOffset = 0;
						selectorPixelOffset += 10;				// this accounts for the space between words
					}

					// add a CharacterObject to the wordw object for each character
					//wordArray[w].addChar(w, c);
					wordArray[w].char[c] = new CharacterObject();
					wordArray[w].char[c].asciiChar		= $('.word' + w + ' .char' + c).text();
					wordArray[w].char[c].pixelWidth		= parseInt($('.word' + w + ' .char' + c).css('width'), 10);
					wordArray[w].char[c].wordOffset		= wordPixelOffset;
					wordArray[w].char[c].headingOffset	= selectorPixelOffset;
					wordPixelOffset     += parseInt($('.word' + w + ' .char' + c).css('width'), 10);		// add character's width to cummulative word offset
					selectorPixelOffset += parseInt($('.word' + w + ' .char' + c).css('width'), 10);		// add character's width to cummulative selector's offset

					if (c === 1)
						$(this.mySelector + ' .word' + w).css({'left': wordArray[w].char[c].headingOffset});		// display the character on page

					$(this.mySelector + ' .word' + w + ' .char' + c).css({'left': wordArray[w].char[c].wordOffset});		// display the character on page
				}
			}

			$('#absoluteHead .word1').attr('title', 'Click on \'Pronto\' to join the Conga dance');
			$('#absoluteHead .word2').attr('title', 'Turn the tables by clicking here, or go click on \'Funding\'. You know you want to...');
			$('#absoluteHead .word3').attr('title', 'Click on \'Funding\' to watch me slide off.\rClick again to slide back on.');
		};

		this.dropToContacts = function () {
			$('.word1', '#absoluteHead').animate({'top': 450, 'left': wordArray[1].char[1].headingOffset}, 'slow', 'easeOutQuad');
			$('.word2', '#absoluteHead').animate({'top': 450, 'left': wordArray[2].char[1].headingOffset}, 'slow', 'easeOutQuad');
			$('.word3', '#absoluteHead').animate({'top': 450, 'left': wordArray[3].char[1].headingOffset}, 'slow', 'easeOutQuad');
		};

		// move the #absoluteHead back to its original place

		this.returnHeading = function () {
			$('.word1', '#absoluteHead').animate({'top': 0, 'left': 0}, 'slow', 'easeOutQuad');
			$('.word2', '#absoluteHead').animate({'top': 0, 'left': wordArray[2].char[1].headingOffset}, 'slow', 'easeOutQuad');
			$('.word3', '#absoluteHead').animate({'top': 0, 'left': wordArray[3].char[1].headingOffset}, 'slow', 'easeOutQuad');
		};
	}		// end HeadingObject


	// In order to use the object created with a constructor function, we must create a new instance of the object like so...

	var theHeading = new HeadingObject();
	theHeading.initialize();


	function straightenOutLetter(letterN, wordN) {
		$(wordN + ' > ' + letterN).css({'-moz-transform': 'rotate(0deg)',
									 '-webkit-transform': 'rotate(0deg)'});
	}


	/*
	 * - - - - - - - - - - - - - - - - -+
	 *									|
	 *	rotate Heading around the frame	|
	 *									|
	 * - - - - - - - - - - - - - - - - -+
	 */

	function doLetterConga(charNumber, wordNumber) {
		var c = parseInt(charNumber.substring(5), 10),			// get the character number from class name
			w = parseInt(wordNumber.substring(5), 10),			// get the word number from class name
			h, d, rockingAngle = 30,
			letterToRock = wordNumber + ' > ' + charNumber;

		// non-Microsoft browsers, use rockingAngle  of 30 degrees or -30 degrees to rotate the letter.
		// Since the rockLetter function is defined within doLetterConga, the scope of the variables
		// defined above extend into rockLetter. This is how we get around passing arguments to rockLetter
		// when it is called via setInterval.

		function rockLetter() {
			rockingAngle = rockingAngle * -1;
			$(letterToRock).css({'-moz-transform': 'rotate(' + rockingAngle + 'deg)',
							  '-webkit-transform': 'rotate(' + rockingAngle + 'deg)'});
			wordArray[w].char[c].rockingTimeoutId = window.setTimeout(rockLetter, 300);
		}


		if (c >= wordArray[w].numberOfCharacters) {			// if already gone through all letters in word...
			if (w < theHeading.numberOfWords) {					// if not at end of words
				doLetterConga('.char1', '.word' + (w + 1));			// repeat this function for 1st char in next word
			}
		}

		// for the character in *this* instance of the function, rotate the character around the frame
		h = -175 - wordArray[w].char[1].headingOffset;
		d = (w > 1 && c === 1) ? 500 : 0;

		$(charNumber, wordNumber).delay(d).animate({'left': h}, 500, 'easeOutQuad', function () {	// move on-page letter to left of frame

			// Notice: The value of the letterToRock variable is unique to each instance of this doLetterConga function.

			rockLetter();		// rock letter back and forth

			if (c < wordArray[w].numberOfCharacters) {		// repeat this function for remaining letters in word
				doLetterConga('.char' + (c + 1), wordNumber);
			}

			$(charNumber, wordNumber).animate({'top': 545}, 3900, 'easeOutQuad', function () {
				// move the letter down
				var h = 690 - wordArray[w].char[1].headingOffset;
				$(charNumber, wordNumber).animate({'left': h}, 3500, 'easeOutQuad', function () {
					// move the letter to the right
					$(charNumber, wordNumber).animate({'top': 0}, 3800, 'easeOutQuad', function () {
						// move back up and to its original position.
						$(charNumber, wordNumber).animate({'left': wordArray[w].char[c].wordOffset}, 2400, 'easeOutQuad', function () {
							window.clearTimeout(wordArray[w].char[c].rockingTimeoutId);
							straightenOutLetter(charNumber, wordNumber);
							$(charNumber, '#absoluteHead').css('color', '#fff');
						});
					});
				});
			});
		});
	}


	function colorIt(className, color) {
		var sss;
		$(className).css('color', color);
		sss = theHeading.headVertical === true ? '2px 2px 2px #000' : '2px -2px 2px #000';

		$(className).css({'text-shadow': sss,		// X, Y, blur radius
				 '-webkit-text-shadow': sss,
					'-moz-text-shadow': sss,
					  '-o-text-shadow': sss});
	}

	function moveShadow(mySelector) {
		var sss;

		sss = theHeading.headVertical === true ? '2px 2px 2px #000' : '2px -2px 2px #000';

		$(mySelector + ' > span > span')
			.css({'textShadow': sss,
		  '-webkit-textShadow': sss,
			 '-moz-textShadow': sss,
			   '-o-textShadow': sss});
		$(mySelector + ' > span')
			.css({'textShadow': sss,
		  '-webkit-textShadow': sss,
			 '-moz-textShadow': sss,
			   '-o-textShadow': sss});
		$(mySelector)
			.css({'textShadow': sss,
		  '-webkit-textShadow': sss,
			 '-moz-textShadow': sss,
			   '-o-textShadow': sss});
	}

	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -+
	//															|
	// Because swingLikeaHinge is a callback function with		|
	// an argument it must be passed via a separate function	|
	//															|
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -+
/*
		The page changes from this:                To this:

			   Heading
	  +--------------------------+        +--------------------------+
	  |    featureContainer      |       g|    featureContainer      |
	  |                          |       n|                          |
	  | <---------760----------> |       i| <---------760----------> |
	  |        objWidth          |       d|                          |
	  |                          |       a|                          |
	  |                          |       e|                          |
	  | <---380----><----380---> |       H| <---380----><----380---> |
	  | objHalfWidth objHalfWidth|        |                          |
	  |                          |        |                          |
	  +--------------------------+        +--------------------------+
	  (-380 is left offset)             (-420, with absoluteHead that is 40 wide, is the left offset)
*/


	function swingLikeaHinge() {
		var h = 0, intervalID, objWidth = parseInt($('#featureContainer').css('width'), 10),
			objHalfWidth = objWidth / 2;

		if (theHeading.headVertical === false) {
			theHeading.headVertical = true;
			$(theHeading.mySelector).delay(50).animate({'transform': 'rotate(-90deg)', 'left': -215}, 'slow', 'easeOutSine', function () {
				moveShadow(theHeading.mySelector);
				$(theHeading.mySelector).animate({'top': 260}, 800, 'easeOutBounce');		// slide down
			});
		}else{
			theHeading.headVertical = false;

			$(theHeading.mySelector).delay(50).animate({'transform': 'rotate(0deg)', 'left': -210}, 'slow', 'easeOutSine', function () {
				$(theHeading.mySelector).animate({'left': 173}, 800, 'easeOutBounce');		//slide back to the right
				moveShadow(theHeading.mySelector);
			});
		}
	}







	$('#absoluteHead .word3').click(function () {	// if we click on the word 'Funding'
		if ((document.documentMode>=5) && (document.documentMode<=8)) {		// running IE?
			alert('Unfortunately you are using (Microsoft Internet Explorer), which doesn\'t support this cool functionality.' +
			' Use a modern browser like Chrome or Firefox to see this great visual effect.');
		}else{
			colorIt('.'+this.className+' span', '#fff');
			$('#absoluteWrapper').animate({'transform': 'rotate(-45deg)'}, 'slow', 'easeOutSine');
			$('#absoluteHead').animate({'left': -230}, 2500, 'easeOutQuad', function () {	// move the char left
				swingLikeaHinge();
				$('#absoluteWrapper').delay(1000).animate({'transform': 'rotate(0deg)'}, 'slow', 'easeOutSine');

				$('#absoluteWrapper').delay(1000).animate({'transform': 'rotate(-45deg)'}, 'slow', 'easeOutSine', function () {
					$(this).animate({'transform': 'rotate(0deg)'}, 'slow', 'easeOutSine');
					$('#absoluteHead').animate({'left':-210, 'top': 0}, 'slow', 'easeOutBack');
					swingLikeaHinge();
				});
			});
		}
	});

	$('#absoluteHead .word2').click(function () {		// if we click on the word 'Commercial'
		if ((document.documentMode>=5) && (document.documentMode<=8)) {		// running IE?
			alert('Unfortunately you are using (Microsoft Internet Explorer), which doesn\'t support this cool functionality.' +
			' Use a modern browser like Chrome or Firefox to see this great visual effect.');
		}else{
			colorIt('.'+this.className+' span', '#fff');
			$('#absoluteWrapper').animate({'transform': 'rotate(180deg)'}, 1000, 'easeOutSine')
							.delay(1500).animate({'transform': 'rotate(0deg)'}, 1000, 'easeOutSine');
		}
	});

	$('#absoluteHead .word1').click(function () {		// if we click on the word 'Pronto'
		colorIt('.'+this.className+' span', '#fff');
		doLetterConga('.char1', '.word1');
	});


	$('#absoluteHead .word1, #absoluteHead .word2, #absoluteHead .word3').hover(function () {
		colorIt('.'+this.className+' span', HIGHLIGHTCOLOR);
	}, function () {
		colorIt('.'+this.className+' span', '#fff');
	});








	// ------------------ the 'Contact Us' button toggle logic ------------------------------------

	$('#contBtn').click(function () {			// // // // This is the 'Contact Us' button toggle logic // // // //
		var contactPanel = $('#contactPanel'), x,
		down = parseInt(contactPanel.css('height'), 10) === 0 ? true : false;	// initially set to 0 in css file

		contactPanel.animate({
					'height': (down ? 405 : 0),
		   'backgroundColor': (down ? DEFAULTCOLOR : 'transparent')},
					  'slow', EASINGTYPE);
		$(this).css('backgroundColor', down ? HIGHLIGHTCOLOR : DEFAULTCOLOR);
		if (down) {
			theHeading.dropToContacts();
		}else{
			theHeading.returnHeading();
		}
	});





	// yet another object constructor
	// PanelObject - let's define the panel object using the Object Constructor function

	function PanelObject (pNumber) {
		this.pNumber = pNumber;

		this.setActivePtrColor = function () {
				$('.panelPtr').each(function () {
					$(this).removeClass('activeColorBackground');
				});
				$('.panelPtr').eq(pNumber).addClass('activeColorBackground');
		};

		this.scrollPanels = function () {
				var lastPanel;
				$('.panel').each(function(i) {
					var t = $(this).css('top');
					//alert('panel ' + i + ' has top at ' + t);
					if (t === '0px')
						lastPanel = i;
				});
				//alert('last panel was: ' + lastPanel);
				$('.panel').eq(lastPanel).animate({'top': -400},
				{
					step: function(now, fx) {							//	use 'step' to synchronize the animation of 2 panels
						$('.panel').eq(pNumber).css('top', (now + 400));
					}
				});
		};
	}


	// object constructor
	// scroll - let's define the scroll object using the Object Constructor function
	// and define 6 properties and 9 methods of the object to handle scrolling chores.

	var scroll = {
		paused: false,
		panelViewTimer: null,
		percentComplete: 0,
		baseT: 0,
		vibrationSelector: null,
		vibrateInterval: 0,
		viewTimePercentile: 1,	// time each panel gets viewed--according to cookie read and then, perhaps, adjusted by speedSlider--divided into 100 parts
		panelArray: [],

		pauseScroll: function () {
			paused = true;
			$('#pauseControl').css('display', 'none');
			$('#resumeControl').css('display', 'block');	// toggle to 'resume' icon
			window.clearTimeout(scroll.panelViewTimer);
			scroll.percentComplete = 0;						// reset progress bar
			$('#progressBar').css('height', 0);
		},

		updateProgressBar: function () {
			scroll.percentComplete++;
			$('#progressBar').css({'top':scroll.percentComplete + '%', 'height':3});

			if (scroll.percentComplete > 100) {
				scroll.changePanel();
			}
			$(window).blur(function() {			// There's no reason to scroll if not in the foreground
				if (paused === false) {
					scroll.pauseScroll();
					//console.log('stopped');
				}
			});

			$(window).focus(function() {
				if (paused === true) {
					scroll.restartScroll();
					//console.log('restarted');
				}
			});

			//console.log('scroll.updateProgressBar: next instance to be run in ' + scroll.viewTimePercentile + ' ms');
			if (paused === false)
				scroll.panelViewTimer = window.setTimeout(scroll.updateProgressBar, scroll.viewTimePercentile);
		},

		restartScroll: function () {
			paused = false;
			$('#pauseControl').css('display', 'block');		// toggle to 'pause' icon
			$('#resumeControl').css('display', 'none');
			scroll.updateProgressBar();
		},

		vibrate: function () {
			//alert('vibrate ' +  scroll.vibrationSelector);
			$(scroll.vibrationSelector).stop(true,false)
					.css({'top': scroll.baseT + Math.round(Math.random() * SHAKE) - ((SHAKE + 1) / 2)});
		},

		stopVibration: function () {
			window.clearInterval(scroll.vibrateInterval);
			$(scroll.vibrationSelector).stop(true,false).css({'top': scroll.baseT});
		},

		startVibration: function () {
			scroll.vibrateInterval = window.setInterval(scroll.vibrate, VIBRATION_INTERVAL);
			window.setTimeout(scroll.stopVibration, VIBRATION_DURATION);
		},

		// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//
		//																//
		//	changePanel is the workhorse function in this script.		//
		//																//
		//	It displays panes in sequence, wrapping back to				//
		//	the first pane when the thisPanel has been viewed-			//
		//																//
		// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//

		changePanel: function () {
			var thisPanel = 0, nextPanel = 0;

			scroll.percentComplete = 0;		// reset progress indicator
			$('.panelPtr').each(function(index) {
				if($(this).hasClass('activeColorBackground'))
					thisPanel = index;
			});

			nextPanel = thisPanel + 1;
			if (nextPanel >= $('.panel').size()) {
				nextPanel = 0;
			}

			if ($('.panel').size() > 1){
				scroll.panelArray[nextPanel].scrollPanels();
				scroll.panelArray[nextPanel].setActivePtrColor();
			}
		},


		// This method adds a round 'pointer' button for each panel to
		// easily directly jump between panels

		addPointerElement: function (panelNumber) {
			var ni = document.getElementById('scrollControls');		// parent div element

			var newDiv = document.createElement('div');
			var divIdName = 'pointer' + panelNumber;
			newDiv.setAttribute('id',divIdName);
			newDiv.setAttribute('class','panelPtr defaultColorBackground');
			ni.appendChild(newDiv);
			var newPtr = document.getElementById(divIdName);
			newPtr.style.display = 'block';
			newPtr.style.top = ((panelNumber + 1) * 30) + "px";
			newDiv.innerHTML = panelNumber + 1;

			// We want to dynamically reference a variable, which is simply a window object.
			// The problem is we don't know what the name of the variable until the function is called

			scroll.panelArray[panelNumber] = new PanelObject(panelNumber);		// create a new panel object as the pointers are added
		},


		//	This is where we set up the panelsContainer to be comprised of 400px high panels stacked sequentially.
		//	Given this structure we can scroll through the panels by adjusting the 'top' attribute of the panelsContainer element.

		//	The scrollControls are positioned along the right side of the viewport has a circle pointer to each panel.

		// this method is called from jquery's slideCreate method

		setPageScrollControls: function () {
			var index, tt, hh, ppp = '',
				scrollControls = $('#scrollControls');

			scrollControls.addClass('opaque');
			//	this shows me what is in the container: console.log('panelsContainer ' + $('#panelsContainer').html());

			for (index = 0; index < $('.panel').size(); index++) {
				scroll.addPointerElement(index);
				$("#pointer" + index).attr('title', "Go to '" + $("h3").eq(index).text() + "'");
			}

			hh = parseInt(scrollControls.css('height'), 10);			//	Now center the Ptr circles vertically in the panel
			tt = (400 - hh) / 2;
			scrollControls.css('top', tt);


			//don't let a pointer on the screen become focused
			$('.pointer').bind('focus', function () {
				$(this).blur();
			});


			$('#speedSliderDiv, #upArrow, #downArrow, #scrollControls').hover(function () {
				$(this).removeClass('opaque');
			}, function () {
				$(this).addClass('opaque');
			});


			// setPageScrollControls inner functions

			//	Once panelPtrs are defined in DOM we can define this event handler:
			//	If a pointer circle is directly clicked ...
			$('.panelPtr').click(function () {
				var thisPanel = -99,
					nextPanel = parseInt($(this).attr('id').substr(7), 10);
				scroll.pauseScroll();
				$('.panelPtr').each(function(index) {
					if($(this).hasClass('activeColorBackground'))
						thisPanel = index;
				});

				if ( thisPanel !== nextPanel) {
					//scrollPanels(thisPanel, nextPanel);
					scroll.panelArray[nextPanel].scrollPanels();
					scroll.panelArray[nextPanel].setActivePtrColor();
				}
			});


			//	hovering over pointer circles changes their colors
			$('.panelPtr').hover(function () {
				$(this).addClass('highlightColorBackground');
			}, function () {
				$(this).removeClass('highlightColorBackground');
			});
		}		//	end of setPageScrollControls()

	};	// end of scroll object




	// hovering over arrow icons causes them to vibrate

	$('#upArrow').hover(function () {
		scroll.vibrationSelector = '#' + $(this).attr('id');
		scroll.baseT = 15;
		scroll.startVibration();
	}, function () {
		scroll.stopVibration();
		$(this).css('padding-bottom', 0);
	});

	$('#downArrow').hover(function () {
		scroll.vibrationSelector = '#' + $(this).attr('id');
		scroll.baseT = 345;
		scroll.startVibration();
	}, function () {
		scroll.stopVibration();
		$(this).css('padding-top', 0);
	});


	$('#upArrow').click(function () {		//	go back 1 page
		var panel = $('.panel'), thisPanel = -99, nextPanel = -99;
		scroll.stopVibration();
		scroll.pauseScroll();
		$('.panelPtr').each(function(index) {
			if($(this).hasClass('activeColorBackground'))
				thisPanel = index;
		});

		nextPanel = thisPanel - 1;

		if (nextPanel < 0) {
			nextPanel = $('.panel').size() - 1;
		}

		scroll.panelArray[nextPanel].scrollPanels();
		scroll.panelArray[nextPanel].setActivePtrColor();
	});



	$('#downArrow').click(function () {		//	advance 1 page
		var panel = $('.panel'), thisPanel = -99, nextPanel = -99;
		scroll.stopVibration();
		scroll.pauseScroll();
		$('.panelPtr').each(function(index) {
			if($(this).hasClass('activeColorBackground'))
				thisPanel = index;
		});

		nextPanel = thisPanel + 1;
		if (nextPanel >= $('.panel').size()) {
			nextPanel = 0;
		}
		//scroll up the thisPanel above the view frame
		panel.eq(thisPanel).css({'top': 0}).animate({'top': -400},
		{
			step: function(now, fx) {		// and along with it scroll the next one into view
				panel.eq(nextPanel).css('top', (now + 400));
			}
		});

		scroll.panelArray[nextPanel].scrollPanels();
		scroll.panelArray[nextPanel].setActivePtrColor();
	});

	//	when thePageUp or PageDown keys are pressed they will act like the ArrowUp or ArrowDown icon were clicked

	$(document).keyup(function(evt) {  // keypress works only with firefox, not chrome
		var keyCode = (evt.which) ? evt.which : evt.keyCode;

		if (keyCode === 33)		//	was key pressed a pageUp key?
		{
			$('#upArrow').click();
		}
		if (keyCode === 34)		//	was key pressed a pageDown key?
		{
			$('#downArrow').click();
		}
	});


	// cookie for speedSlider

	function writePercentageCookie(cookieValue) {
		document.cookie = "percentage=" + cookieValue + "; expires=Wednesday, 01-Aug-2040 08:00:00 GMT; path=/";
	}

	function readPercentageCookie() {
		var index, countbegin, countend;

		index = document.cookie.indexOf("percentage");				// see if cookie exists
		if (index !== -1) {
			countbegin = (document.cookie.indexOf("=", index) + 1);
			countend = document.cookie.indexOf(";", index);
			if (countend === -1) {
				countend = document.cookie.length;
			}
			index = parseInt(document.cookie.substring(countbegin, countend), 10);
		}
		else
		{
			writePercentageCookie(-20);							// not found so write default of 20 seconds per panel');
			index = -9;
		}

		$("#speedSlider").slider( "option", "value", index);	// initial slider value
		$("#speedSlider a").css({'font-weight': '700', 'color': '#fff','textAlign': 'center'}).html(-1 * index);
		//console.log('initial slider value: '+ index);

		return index;
	}


	$("#speedSlider").bind("slidecreate", function () {
		var lastPanel = $('.panel').size() - 1;
		//console.log('speedSlider CREATE event occurred');
		$("#speedSlider .ui-widget-header, #speedSlider .ui-slider-handle").css('background', DEFAULTCOLOR);
		$('#speedSlider').get();	// wait until slider is defined
		scroll.setPageScrollControls();

		$('.panel').eq(0).css('top', 400).animate({'top': 0},'slow', 'easeOutQuad');
		$('#pointer0').addClass('activeColorBackground');
		scroll.restartScroll();

		var v = Math.abs($(this).slider( "option", "value" ));
		$("#speedSlider a").css({'font-weight': '700', 'color': '#fff','textAlign': 'center'}).html(v);
		scroll.viewTimePercentile = 20 * (v - 1);		// set the initial scroll speed
	});

	$("#speedSlider").bind("slidechange", function(event, ui) {
			var pc = ui.value;
			//console.log('speedSlider SLIDE event occurred');
			if (isNaN(pc) === false)		// don't write invalid cookies
				writePercentageCookie(pc);
			scroll.viewTimePercentile = -20 * (pc - 1);	// adjust view-time of panels
			scroll.pauseScroll();
			scroll.changePanel();					// immediately update the page
			scroll.restartScroll();
			pc = (-1 * ui.value);
			$("#speedSlider a").css({'font-weight': '700', 'color': '#fff','textAlign': 'center'}).html(pc);
	});


	// Define a slider object. The orientation of slider fill necessatates having 0 be
	// the largest number, hence negative values.

	// Notice sliders use the 'literal notation' way of creating an object instead of the constructor version.
	// The literal version uses : rather than = to define properties and methods like the constructor method uses.

	// Another difference: The 'constructor function' way has its properties and methods defined with the
	// keyword ‘this’ in front of it, whereas the literal version does not.


	$("#speedSlider")
		.slider({ orientation: 'vertical',
						range: 'min',
						  min: -20,
						 step: 1,
						  max: -1,
						value: readPercentageCookie()
		});


	//	A click on resume button toggles rotation
	$('#resumeControl').click(function () {
		scroll.changePanel();		// change the panel immediately
		scroll.restartScroll();
	});
	$('#pauseControl').click(function () {
		scroll.pauseScroll();
	});


	$('#helpBtn').click(function () {
		if ($('#progressBar').css('display') === 'block') {
			var panel = $('.panel'),
				needsHelp = ($('#helpPanel').css('height') === '0px' ? true : false);	// initially set to 0 in css file
			$('#helpPanel').animate({
					'height': (needsHelp ? 405 : 0),
				 'marginTop': (needsHelp ? 0 : 405)},
					  1000, EASINGTYPE);
			if(needsHelp) {
				$('#speedSliderDiv, #upArrow, #downArrow, #scrollControls').removeClass('opaque');
				panel.addClass('opaque');
			}else{
				$('#speedSliderDiv, #upArrow, #downArrow, #scrollControls').addClass('opaque');
				panel.removeClass('opaque');
			}

			panel.css({'backgroundColor': needsHelp ? '#faa' : '#fff'});
			$(this).css('backgroundColor', needsHelp ?  HIGHLIGHTCOLOR : DEFAULTCOLOR);
		}
		else
			alert("Help is presently only available on scrolling pages. Please move to a page that scrolls and press the 'Scroll Help' button again.");
	});

	// -------------------------------

	// for *feedback* pull-out window

	// -------------------------------



	$("#feedbackButton img").focus(function () {
		$(this).blur();
	});

	function resetPage () {
		$('#feedbackWrapper').css('width','35px');
		//$('#ExpandedComments').css({'display': 'none', 'background': 'red'});
	}

	$("#feedbackButton").click(function () {
		if ($('#feedbackWrapper').css('left') === '-455px') {
			$('#feedbackWrapper').animate({'left':-5}, 'slow');
		}else{
			$('#feedbackWrapper').animate({'left':-455}, 'slow');
		}
	});


	//if the feedback form's cancel button is pressed
	$('#feedbackCancel').click(function () {
		$('#feedbackWrapper').animate({'left':-455}, 'slow');
	});

	//when the feedback form's submit button is clicked...
	$('#feedbackSubmit').click(function (e) {
		var feedbackData;

		e.preventDefault();
		//Get the feedbackData from all the input fields
		feedback.name  = $('#feedbackName').val();
		feedback.email = $('#feedbackEmail').val();
		feedback.text  = $('#feedbackText').val();

		//organize the data properly
		feedbackData = 'feedbackName=' + feedback.name + '&feedbackEmail=' + feedback.email + '&feedbackText=' + feedback.text;

		//disabled all the text fields
		$('.feedbackField').attr('disabled','true');

		//start the ajax routine to send the form to sendfeedback.php
		$.ajax({
			 url: "SendFeedback.php",			//this is the php file that processes the data and send mail
			type: "GET",						//GET or POST method is used
			data: feedbackData,					//pass the data
			success: function (msg) {			//if sendfeedback.php returned 1/true (send mail success)
				if (msg === '1') {				//hide the send button
					$('#block202').hide();
					$('#done202').show('slow');//show the success message
				}
				else //otherwise, if sendfeedback.php returned 0/false (send mail failed)
				{
					alert('Sorry, unexpected AJAX error\n|' + msg + '|\nPlease try again.');
					$('.feedbackField').removeAttr('disabled');
					$('#done202').hide();
				}
			}
		});
		//alert('feedback sent ' + feedbackData + ' via a GET request');

		$('#feedbackWrapper').animate({'left':-455}, 'slow');
	});


	//for *procedures* pull-out window

	$("#proceduresButton img").focus(function () {
		$(this).blur();
	});

	$("#proceduresButton").toggle(function () {
		$("#proceduresWrapper").animate({ 'right': -5 }, 'slow');
	},
	function () {
		$("#proceduresWrapper").animate({ 'right': -402 }, 'slow');
	});

	//end of *procedures* pull-out window


	// // // // // // // // // // // // // // // // // // // // // // // //
	//																	 //
	//		This is the pullout and pulloutSelected tabs hover logic	 //
	//																	 //
	//		<div class = 'roundedCorners pullout' id = 'p6'>			 //
	//		<a tabindex = '-1'  href = 'AboutUs.php'>About Us</a>		 //
	//	</div>															 //
	//																	 //
	// // // // // // // // // // // // // // // // // // // // // // // //

	$('.pullout').hover(function () {
		$('.Tag', this).fadeOut('fast');
		$(this)
			.addClass('highlightColorBackground')
			.stop(true, false).animate({'left':85}, 400, 'easeOutBounce');

		$('.dpd a', this).fadeIn('fast');
	},
	function () {
		$('.Tag', this).fadeIn('fast');
		$(this)
			.removeClass('highlightColorBackground')
			.stop(true, false).animate({'left':0}, 400, 'easeOutBounce');
		$('.dpd a', this).fadeOut('fast');
	});

	$('#featureTabContainer li, .pullout').click(function () {
		var dest = $('a', this).attr('href');
		//console.log('click to ' + dest);
		window.location = dest;				// let user click anywhere in tab li or .pullout
	});


	(function () {	// self-executing anonymous function
					// for copyright notice
		var Today = new Date();
		$('#thisYear').text(Today.getFullYear());
	})();


	//change the active page's button colors to show which button is active at page load time

	(function () {  // returns the index number for current page so btnSelected class can be added

		var k = 99, i = 99, Page, PageN, PageName;

		Page = window.location.pathname;	// get this page's full URI
		PageN = Page.lastIndexOf("\\");		// this will allow checking of a trailing slash, '/'

		if (PageN < 1) {					// did the url include a file name, or was it just the domain?
			PageN = Page.lastIndexOf("/");
		}
		PageName = Page.substr(PageN + 1);	// get the index of the page name
		switch(PageName) {
			case 'FundingRequest.php':
			case 'FundingRequestSent.php':
				i = 6;
				break;
			case 'CommercialLoans.php':
				i = 5;
				break;
			case 'BankInstrumentFinancing.php':
				i = 3;
				break;
			case 'BankInstrumentLeasing.php':
				i = 4;
				break;
			case 'ProofOfFunds.php':
				i = 1;
				break;
			case 'PrivatePlacementProgram.php':
				i = 2;
				break;
			case 'CISform.php':
				$('h1').css('display', 'block');
				k = 0;
				break;
			case 'CISdocuments.php':
				$('h1').css('display', 'block');
				k = 1;
				break;
			case 'AboutUs.php':
				k = 2;
				break;
			case 'Glossary.php':
				//$('.feature').css('overflow-y', 'hidden');
				k = 3;
				break;
			case 'PrivacyPolicy.php':
				k = 4;
				break;
			case 'Legal.php':
				k = 5;
				break;
			case 'index.php':
			case '':
				i = 0;
				break;
		}

		if (i < 7) {			// if a btn for new page was found, make the background the active color.
			$('#buttonContainer li').eq(i).css('backgroundColor', ACTIVECOLOR);
		}

		if (k < 6)				// otherwise a pull-out tab may have been clicked
		{
			$('.pullout').eq(k).css('backgroundColor', ACTIVECOLOR);
		}

		if ((i < 6) || (k === 2) || (k === 4) || (k === 5)) {
			$('#upArrow, #downArrow, #speedSliderDiv').css('display', 'block');
		}else{
			$('#progressBarWrapper, #progressBar, #pauseControl').css('display', 'none');
		}
	})();  // end of adjustButtonColor()
