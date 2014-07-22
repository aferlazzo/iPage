	var numberOfPanels, panelIndex = 0, pageScrollTimer, currentPage = 0,
		newIndex, activeColor = '#002c85', defaultColor = '#1A83A3', highlightColor = '#c5073d',
		defaultBackground = '#fff',
		scrollActive = true, mSecViewTime = 1, fullPanelWidth = 680, aniSpeed = 'slow',  PageName,
		scrollControls, pause, resume, helpAvailable,
		feedbackName, feedbackEmail, feedbackText, feedbackData, headVertical = false,
		//	----------------------  for vibration effect  ---------------------------------------
		vibrationInterval = 90, vibrationDuration= 2000, shake= 4, vibrateIndex = 0, vibrationSelector = $('#upArrow'), baseT,
		// for progress bar
		milliSeconds=0, percentComplete=0, progressTimer, progressInterval, headingArray = [], h3Array = [],
		wordPixelOffset = 0, selectorPixelOffset = 0;	// for use with heading array

	// function curtesy of quirksmode.org...

	//	you can query three properties of the BrowserDetect object:

	//	* Browser name: BrowserDetect.browser
	//	* Browser version: BrowserDetect.version
	//	* OS name: BrowserDetect.OS

var BrowserDetect = {
	init: function () {
		this.browser = this.searchString(this.dataBrowser) || "An unknown browser";
		this.version = this.searchVersion(navigator.userAgent) || this.searchVersion(navigator.appVersion) || "an unknown version";
		this.OS = this.searchString(this.dataOS) || "an unknown OS";
	},
	searchString: function (data) {
		for (var i=0;i<data.length;i++)	{
			var dataString = data[i].string;
			var dataProp = data[i].prop;
			this.versionSearchString = data[i].versionSearch || data[i].identity;
			if (dataString) {
				if (dataString.indexOf(data[i].subString) !== -1)
					return data[i].identity;
			}
			else if (dataProp)
				return data[i].identity;
		}
	},
	searchVersion: function (dataString) {
		var index = dataString.indexOf(this.versionSearchString);
		if (index === -1) return;
		return parseFloat(dataString.substring(index+this.versionSearchString.length+1));
	},
	dataBrowser: [
		{
			string: navigator.userAgent,
			subString: "Chrome",
			identity: "Chrome"
		},
		{	string: navigator.userAgent,
			subString: "OmniWeb",
			versionSearch: "OmniWeb/",
			identity: "OmniWeb"
		},
		{
			string: navigator.vendor,
			subString: "Apple",
			identity: "Safari",
			versionSearch: "Version"
		},
		{
			prop: window.opera,
			identity: "Opera"
		},
		{
			string: navigator.vendor,
			subString: "iCab",
			identity: "iCab"
		},
		{
			string: navigator.vendor,
			subString: "KDE",
			identity: "Konqueror"
		},
		{
			string: navigator.userAgent,
			subString: "Firefox",
			identity: "Firefox"
		},
		{
			string: navigator.vendor,
			subString: "Camino",
			identity: "Camino"
		},
		{		// for newer Netscapes (6+)
			string: navigator.userAgent,
			subString: "Netscape",
			identity: "Netscape"
		},
		{
			string: navigator.userAgent,
			subString: "MSIE",
			identity: "Explorer",
			versionSearch: "MSIE"
		},
		{
			string: navigator.userAgent,
			subString: "Gecko",
			identity: "Mozilla",
			versionSearch: "rv"
		},
		{		// for older Netscapes (4-)
			string: navigator.userAgent,
			subString: "Mozilla",
			identity: "Netscape",
			versionSearch: "Mozilla"
		}
	],
	dataOS : [
		{
			string: navigator.platform,
			subString: "Win",
			identity: "Windows"
		},
		{
			string: navigator.platform,
			subString: "Mac",
			identity: "Mac"
		},
		{
			   string: navigator.userAgent,
			   subString: "iPhone",
			   identity: "iPhone/iPod"
	    },
		{
			string: navigator.platform,
			subString: "Linux",
			identity: "Linux"
		}
	]

};
BrowserDetect.init();
	//	end of browser detect



$(document).ready(function(){
	var EasingArray = ['easeOutQuart', 'easeOutCubic', 'easeInOutCubic', 'easeOutSine',
	'easeOutQuad', 'easeInOutQuad',	'easeOutBack', 'easeInBack', 'easeOutElastic',
	'easeInOutBack', 'easeOutBounce', 'easeInBounce', 'swing', 'bounceOut', 'elasticOut'], easingType = EasingArray[4];

	// heading array is comprised of:

	// [w] first index is word number: 1, 2, or 3
	// [w][c] second index is the character number containing 4 possible elements
	// [w][c][0] the ascii character itself,
	// [w][c][1] pixel width of character,
	// [w][c][2] pixel offset from beginning of word
	// [w][c][3] pixel offset from beginning of heading

	// [0][0][0] contains the number of words in heading
	// [0][0][1] contains the number of characters in word 1...
	// [0][0][n] contains the number of characters in word n

	function populateArray(mySelector, myArray, MyArrayLiteral){
		// separate mySelector into spans, using the lettering plug-in, so there are word# and char# classes.
		var w, c, x;
		$(mySelector).lettering('words').children('span').lettering();

		for (w=0; w <= $(mySelector + ' > span').length; w++){
			myArray[w] = [];
			for (c=0; c <= $('span', mySelector + ' > span').length; c++){
				myArray[w][c] = [];
				for (x=0; x < 4; x++)
					myArray[w][c][x] = [];
			}
		}

		//console.log('populateArray() created array '+ MyArrayLiteral + ' to hold '+ ($(mySelector + ' > span').length) +' words. Next task is to fill it.');

		myArray[0][0][0] = $(mySelector + ' > span').length;	// put in the number of words in array

		//console.log('populateArray() put in words');

		$(mySelector + ' > span').each(function(q){							// for each word
			//console.log('populateArray() processing '+ $("span", this).length + ' characters in ' + $(this).attr('class'));
			myArray[0][0][(q+1)] = $('span', this).length;	// number of charcters in each word

			$("span", this).each(function(index){						// for each char in word
				var wordClass = $(this).parent().attr('class'),
					w = parseInt(wordClass.substring(4), 10),	// set index: get word number, eg 'wordx' where x is position 5
					c = index + 1, x;

				if (c === 1){	// reset the word's left offset if at the start of a word
					wordPixelOffset = 0;
					selectorPixelOffset += 10;  // this accounts for the space between words
				}

				myArray[w][c][0] = $(this).html();
				myArray[w][c][1] = parseInt($(this).css('width'), 10);
				myArray[w][c][2] = wordPixelOffset;
				myArray[w][c][3] = selectorPixelOffset;
				wordPixelOffset     += parseInt($(this).css('width'), 10);	// add character's width to cummulative word offset
				selectorPixelOffset += parseInt($(this).css('width'), 10);	// add character's width to cummulative selector's offset
				$(mySelector+' .word'+w).css({'left': myArray[1][1][3]});			// the offset of the first word's first character
				$(this).animate({'left': myArray[w][c][3]}, aniSpeed, 'easeInBounce'); // the character left offset
			});
		});

		//console.log('populateArray() number of words in heading: '+ myArray[0][0][0]);
		//console.log('populateArray() number of characters in word 1: '+ myArray[0][0][1]);
		//console.log('populateArray() number of characters in word 2: '+ myArray[0][0][2]);
		//console.log('populateArray() number of characters in word 3: '+ myArray[0][0][3]);
		return myArray;
	}


	//console.log('Preparing to populate array. There are '+ $('#absoluteHead > span').length +' words in #head');


	function dump3Darray(tbl, tblName){
		var title='', titleLiteral='', literal='There are '+tbl[0][0][0]+' words in the array.', w, c, x;
		//console.log('dump3Darray(): '+ literal);

		for (w = 1; w <= tbl[0][0][0]; w++){	// # words
			literal='There are '+tbl[0][0][w]+' characters in word '+ w + '.';
			//console.log('dump3Darray(): '+ literal);

			for (c = 1; c <= tbl[0][0][w]; c++){	// # chars in word
				for (x=0; x < 4; x++){
					if (x === 0){
						title += tbl[w][c][0];
						//console.log('dump3Darray() '+tblName+'['+w+']['+c+']['+x+'] = "' + tbl[w][c][x] + '";');
					}else{
						//console.log('dump3Darray() '+tblName+'['+w+']['+c+']['+x+'] = ' + tbl[w][c][x] + ';');
					}
				}
			}
			//console.log('dump3Darray() '+tblName+'word '+w+': '+ title);
			titleLiteral += title + ' ';
			title='';
		}
		//console.log('dump3Darray() '+tblName+'The complete title: '+ titleLiteral);
	}

	headingArray = populateArray('#absoluteHead', headingArray, 'headingArray');
	$('#absoluteHead .word1').attr('title', 'Click on \'Pronto\' to join the Conga dance');
	$('#absoluteHead .word2').attr('title', 'Turn the tables by clicking here, or go click on \'Funding\'. You know you want to...');
	$('#absoluteHead .word3').attr('title', 'Click on \'Funding\' to watch me slide off.\rClick again to slide back on.');

	//dump3Darray(headingArray, 'headingArray');

	function randomFromTo(from, to){
       return Math.floor(Math.random() * (to - from + 1) + from);
    }

	function stopRockingWord(wordN){
		$(wordN).css({'-moz-transform': 'none',
				   '-webkit-transform': 'none'});
	}

	function straightenOutLetter(letterN, wordN){
		$(letterN, wordN).css({'-moz-transform': 'none',
							'-webkit-transform': 'none'});
		//$(letterN, wordN).css({'filter': 'progid:DXImageTransform.Microsoft.BasicImage(rotation=0)'});
		//console.log(x + ' ended rotation');
	}

	// The challenge is to convert a h3 header from display:inline-block to to diplay:block
	// and position:static to position:absolute, zIndex:7

	function changeColor(myArray, myName){
		var x = parseInt(myArray[0][0][0], 10), c, w, aaa;

		for (w = 1; w <= x; w++){
			console.log('changeColor: array: '+myName+ ' word'+w);
			for (c = 1; c <= myArray[0][0][w]; c++){					// c is character number of the word, obtained from array
				aaa = myName + ' > .word' + w + ' > .char'+ c;
				console.log('changeColor: $(' + aaa +'): '+ myArray[w][c][0]);
				$(aaa).animate({'color': '#000', 'paddingBottom': 4}, 'slow', easingType).delay(1000).animate({'paddingBottom': 0}, 'slow', easingType);

			}
		}
	}

	/*
	 * - - - - - - - - - - - - - - - - -+
	 *									|
	 *	rotate Heading around the frame	|
	 *									|
	 * - - - - - - - - - - - - - - - - -+
	 */

	function doLetterConga(charNumber, wordNumber){
		var c = parseInt(charNumber.substring(5), 10),			// get the character number from class name
			w = parseInt(wordNumber.substring(5), 10),			// get the word number from class name
			rockingAngle = 30, intervalID,
			letterToRock = wordNumber + ' > ' + charNumber;

		// non-Microsoft browsers, use rockingAngle  of 30 degrees or -30 degrees to rotate the letter.
		// Since the rockLetter function is defined within doLetterConga, the scope of the variables
		// defined above extend into rockLetter. This is how we get around passing arguments to rockLetter
		// when it is called via setInterval.

		function rockLetter(){
			rockingAngle = rockingAngle * -1;
			$(letterToRock).css({'-moz-transform': 'rotate('+rockingAngle+'deg)',
							  '-webkit-transform': 'rotate('+rockingAngle+'deg)'});
		}


		// this function is reiterative. It calls itself, going through the words in the heading

		if (c > parseInt(headingArray[0][0][w], 10)){			// if already gone through all letters in word...
			if (w <= headingArray[0][0][0]){				// if not at end of words
				doLetterConga('.char1', '.word'+(w+1));	// repeat this function for 1st char in next word
			}
		}

		// for the character in *this* instance of the function, rotate the character around the frame

		$(charNumber, wordNumber).animate({'left': -175}, 500, 'easeOutQuad', function(){	// move on-page letter to position -65px

			// Notice: The value of the letterToRock variable is unique to each instance of this doLetterConga function.

			intervalID = window.setInterval(rockLetter, 300);		// rock letter back and forth

			if (c <= parseInt(headingArray[0][0][w], 10)){		// repeat this function for remaining letters in word
				doLetterConga('.char'+(c+1), wordNumber);
			}

			$(charNumber, wordNumber).animate({'top': 545}, 3900, 'easeOutQuad', function(){		// move the letter down
				$(charNumber, wordNumber).animate({'left': 690}, 3500, 'easeOutQuad', function(){	// move the letter to the right
					$(charNumber, wordNumber).animate({'top': 0},3800, 'easeOutQuad', function(){	// move back up and to its original position.
						$(charNumber, wordNumber).animate({'left': headingArray[w][c][3]}, 2400, 'easeOutQuad', function(){
							straightenOutLetter(charNumber, wordNumber);
							window.clearInterval(intervalID);
							$(charNumber, '#absoluteHead').css('color', '#fff');
						});
					});
				});
			});
		});
	}

	function colorIt(selector, color){
		var sss;
		$(selector).css({'color': color});
		sss = headVertical === true ? '2px 2px 2px #000' : '2px -2px 2px #000';
		$(selector).css({'text-shadow': sss,		// X, Y, blur radius
				 '-webkit-text-shadow': sss,
					'-moz-text-shadow': sss,
					  '-o-text-shadow': sss});
	}

	function moveShadow(theHeading){
		var sss;
		if (headVertical === true){
			sss = '2px 2px 2px #000';
		}else{
			sss = '2px -2px 2px #000';
		}

		//console.log('headVertical: '+headVertical + ' sss: ' + sss);

		$(theHeading+' > span > span')
			.css({'textShadow': sss,
		  '-webkit-textShadow': sss,
			 '-moz-textShadow': sss,
			   '-o-textShadow': sss});
		$(theHeading+' > span')
			.css({'textShadow': sss,
		  '-webkit-textShadow': sss,
			 '-moz-textShadow': sss,
			   '-o-textShadow': sss});
		$(theHeading)
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
          *
          Measuring from the center (since featureContainer is centered) we take
          half the width to get to the sides. Use a negative number to specify
          the left side. Subtract 40 to allow for space to put the vertical heading.

          * So  -1 * (380) - 40 = -420: The vertical absoluteHead is too far left.
          * But we didn't account for the non-centered nature of the absoluteWrapper,
          * and consquently the featureContainer.
          *
          * Through pure observation and testing we can see the vertical absoluteHead
          * should be -290. Calculating backwards, this means...
          *
          *      -290 = -40 + ( -250 )
          * -290 + 40 = -40 + ( -250 ) + 40
          *      -250 = -250
          *
          *
          * calculating amount the off-centeredness of the absoluteWrapper...
          * if absoluteWrapper width = 890 as opposed to 760 for a difference of 130

          * 890 - 760 = 130 / 2 = 65 is the offset to the right that the absoluteWrapper is off center.
          * -250 + 65 = -185
*/

	function swingLikeaHinge(theHeading){
		var h=0, intervalID, objWidth=parseInt($('#featureContainer').css('width'), 10),
			objHalfWidth = objWidth / 2;

		if (headVertical === false){
			headVertical = true;
			$(theHeading).delay(50).animate({'transform': 'rotate(-90deg)', 'left': -230}, 'slow', 'easeOutSine', function(){
				moveShadow(theHeading);
				$(theHeading).animate({'top': 260}, 800, 'easeOutBounce');		// slide down
			});
		}else{
			headVertical = false;
			$(theHeading).delay(50).animate({'transform': 'rotate(0deg)', 'left': -210}, 'slow', 'easeOutSine', function(){
				$(theHeading).animate({'left': 173}, 800, 'easeOutBounce');		//slide back to the right
				moveShadow(theHeading);
			});
		}
	}


	$('#absoluteHead .word3').click(function(){	// if we click on the word 'Funding'
		//e.stopImmediatePropagation();		// stop other matching bound events from being triggered
		if (BrowserDetect.browser == 'Explorer'){
		//if (BrowserDetect.browser === 'xxx'){
			alert('Unfortunately you are using ' + BrowserDetect.browser +
			' (Microsoft Internet Explorer), which doesn\'t support this cool functionality.' +
			' Use a modern browser like Chrome or Firefox to see this great visual effect.');
		}else{
			colorIt('#absoluteHead span', '#fff');
			$('#absoluteWrapper').animate({'transform': 'rotate(-45deg)'}, 'slow', 'easeOutSine');
			$('#absoluteHead').animate({'left': -230}, 2500, 'easeOutQuad', function(){	// move the char left
				swingLikeaHinge('#absoluteHead');
				$('#absoluteWrapper').delay(1000).animate({'transform': 'rotate(0deg)'}, 'slow', 'easeOutSine');

				$('#absoluteWrapper').delay(1000).animate({'transform': 'rotate(-45deg)'}, 'slow', 'easeOutSine', function(){
					$(this).animate({'transform': 'rotate(0deg)'}, 'slow', 'easeOutSine');
					$('#absoluteHead').animate({'left':-210, 'top': 0}, 'slow', 'easeOutBack');
					swingLikeaHinge('#absoluteHead');
				});
			});
		}
	});

	$('#absoluteHead .word2').click(function(){		// if we click on the word 'Commercial'
		if (BrowserDetect.browser === 'Explorer'){
			alert('Unfortunately you are using ' + BrowserDetect.browser +
			' (Microsoft Internet Explorer), which doesn\'t support this cool functionality.' +
			' Use a modern browser like Chrome or Firefox to see this great visual effect.');
		}else{
			colorIt('#absoluteHead span', '#fff');
			$('#absoluteWrapper').animate({'transform': 'rotate(180deg)'}, 1000, 'easeOutSine')
							.delay(1500).animate({'transform': 'rotate(0deg)'}, 1000, 'easeOutSine');
		}
	});

	$('#absoluteHead .word1').click(function(){		// if we click on the word 'Pronto'
		colorIt('#absoluteHead span', '#fff');
		doLetterConga('.char1', '.word1');
	});


	$('#absoluteHead .word1').hover(function(){
		colorIt('#absoluteHead .word1 span', highlightColor);
	}, function(){
		colorIt('#absoluteHead .word1 span', '#fff');
	});
	$('#absoluteHead .word2').hover(function(){
		colorIt('#absoluteHead .word2 span', activeColor);
	}, function(){
		colorIt('#absoluteHead .word2 span', '#fff');
	});
	$('#absoluteHead .word3').hover(function(){
		colorIt('#absoluteHead .word3 span', defaultColor);
	}, function(){
		colorIt('#absoluteHead .word3 span', '#fff');
	});

	function dropToContacts(){
		$('.word1', '#absoluteHead').animate({'top': 450, 'left': (headingArray[1][1][2])}, 'slow', 'easeOutQuad');
		$('.word2', '#absoluteHead').animate({'top': 450, 'left': (headingArray[2][1][2])}, 'slow', 'easeOutQuad');
		$('.word3', '#absoluteHead').animate({'top': 450, 'left': (headingArray[3][1][2])}, 'slow', 'easeOutQuad');
	}

	// move the #absoluteHead back to its original place

	function returnHeading(){
		$('.word1', '#absoluteHead').animate({'top': 0, 'left': headingArray[1][1][2]}, 'slow', 'easeOutQuad');
		$('.word2', '#absoluteHead').animate({'top': 0, 'left': headingArray[2][1][2]}, 'slow', 'easeOutQuad');
		$('.word3', '#absoluteHead').animate({'top': 0, 'left': headingArray[3][1][2]}, 'slow', 'easeOutQuad');
	}


/*  for testing easing methods
	var easingIndex = 0;

	$('body').append("<input type='button' id='easingButton' value="+easingType + " style='position:fixed;z-index:22;top:15px;left:15px;'/>");

	$('#easingButton').click(function(){
		if (++easingIndex == EasingArray.length)
			easingIndex = 0;

		easingType = EasingArray[easingIndex];
		$(this).val(easingType);
	});
*/


	function updatePtrColor(){
		var panelPtr = $('.panelPtr');

		panelPtr.removeClass('activeColorBackground'); //set all the ptr circles to the default color
		panelPtr.eq(panelIndex).addClass('activeColorBackground');	//make the active one to be active color - dark blue
	}


	function updatePanel(oldP, newP){
		$('.panel').eq(oldP).css('top', 0).animate({'top': -400},
		{

			step: function(now, fx){									//	use 'step' synchronize the animation of 2 pages
				$('.panel').eq(newP).css('top', (now + 400));
			}

		}, aniSpeed, easingType, updatePtrColor());
	}



	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//
	//																//
	//	panelChanger() is the driving function of this script,		//
	//	occuring at set intervals.									//
	//																//
	//	It activates the panes in sequence, wrapping back to the	//
	//	first pane when the last has been viewed-					//
	//																//
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -//

	function panelChanger() {
		var last= panelIndex;

		panelIndex++;
		if (panelIndex >= numberOfPanels){
			panelIndex=0;
		}
		//console.log('limit is '+ numberOfPanels +' changing from panel '+last +' to panel '+ panelIndex);
		updatePanel(last, panelIndex);
		percentComplete = 0;		// reset progress bar
	}

	//update the progressbar on frame 100 times for each panel
	function updateProgressBar(){
		percentComplete++;
		$('#progressBar').css({'top': percentComplete + '%', 'height':3});
		//console.log('progressBar top: ' + $('#progressBar').css('top'));
		if (percentComplete > 100){
			panelChanger();
		}
	}




	// for mSecViewTime slider

	function writePercentageCookie(cookieValue){
		document.cookie="percentage="+cookieValue+"; expires=Wednesday, 01-Aug-2040 08:00:00 GMT; path=/";
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

		$("#speedSlider").slider( "option", "value", index);  // initial slider value
		$("#speedSlider a").css({'font-weight': '700', 'color': '#fff','textAlign': 'center'}).html(-1 * index);
		//console.log('initial slider value: '+ index);
		return index;
	}



	function addPointerElement(num) {
		var ni = document.getElementById('scrollControls');			// parent div element

		var newDiv = document.createElement('div');
		var divIdName = 'pointer'+num;
		newDiv.setAttribute('id',divIdName);
		newDiv.setAttribute('class','panelPtr defaultColorBackground');
		ni.appendChild(newDiv);
		var newPtr = document.getElementById(divIdName);
		newPtr.style.display = 'block';
		newPtr.style.top = ((num+1) * 30)+"px";
		newDiv.innerHTML = num+1;
	}

	function pauseScroll(){
		//console.log('pausing');
		scrollActive = false;
		pause.css('display', 'none').stop(true, false);
		resume.css('display', 'block');					// make toggle icon 'resume'
		window.clearInterval(pageScrollTimer);			// clear old timers
		window.clearInterval(progressTimer);
		percentComplete = 0;							// reset progress bar
		$('#progressBar').css('height', percentComplete + '%');
		//console.log("pauseScroll: cleared 'pageScrollTimer' vibrationInterval");
	}


	//	This is where we set up the panelsContainer to be comprised of 400px high panels stacked sequentially.
	//	Given this structure we can scroll through the panels by adjusting the 'top' attribute of the panelsContainer element.

	//	The scrollControls are positioned along the right side of the viewport has a circle pointer to each panel.

	function setPageScrollControls() {
		var index, tt, hh, ppp='';
		scrollControls = $('#scrollControls');

		scrollControls.addClass('opaque');
		numberOfPanels = $('.panel').size();
		//	this shows me what is in the container: console.log('panelsContainer ' + $('#panelsContainer').html());


		for (index = 0; index < numberOfPanels; index++){
			addPointerElement(index);
			$("#pointer"+index).attr('title', "Go to '"+$("h3").eq(index).text()+"'");
		}

		hh = parseInt(scrollControls.css('height'), 10);			//	Now center the Ptr circles vertically in the panel
		tt = (400 - hh) / 2;
		scrollControls.css('top', tt);


		$('#pointer0').delay().addClass('activeColorBackground');

		// ----- Note that these functions must be defined after the panelPtr divs are created in the housekeeping function.
		// ----- Otherwise they will not work.

		//don't let the pointer become focused on the screen
		$('#pointer0').bind('focus', function(){
			$(this).blur();
		});

		//alert('panel0 moving from top: '+ (-400) + ' to top:0');
		$('.panel').eq(0).animate({'top': 0}, aniSpeed, easingType);		//	first .panel should be displayed


		//alert("$('.panelPtr').get(0): "+$('.panelPtr').get(0));

		//	Once panelPtrs are defined in DOM we can define this event handler: if we click on a panelPtr, go directly to that panel

		//	If a pointer circle is directly clicked ...
		$('.panelPtr').click(function(){
			pauseScroll();
			var last = panelIndex;
			panelIndex = parseInt($(this).attr('id').substr(7), 10);			//	get the new index number
			if ( last !== panelIndex){
				updatePanel(last, panelIndex);
			}
		});

		$('#speedSliderDiv, #upArrow, #downArrow, #scrollControls').hover(function(){
			$(this).removeClass('opaque');
		}, function(){
			$(this).addClass('opaque');
		});

		//	hover over pointer circles to change their colors
		$('.panelPtr').hover(function(){
			$(this).addClass('highlightColorBackground');
		}, function(){
			$(this).removeClass('highlightColorBackground');
		});
	}		//	end of housekeeping


	function restartScroll(){
		//console.log('restarting scroll');
		scrollActive = true;
		pause.css('display', 'block');									// make toggle icon 'pause'
		resume.css('display', 'none');
		progressInterval = mSecViewTime / 100;							// update progress bar 100 times
		progressTimer = window.setInterval(updateProgressBar, progressInterval);
	}

	//	A click on resume button toggles rotation
	$('#resume').click(function(){
		panelChanger();		// change the panel immediately
		restartScroll();
	});
	$('#pause').click(function(){
		pauseScroll();
	});

	// define slider having allowable values of -9 to 0. The orientation of slider fill necessatates having 0 be
	// the largest number, hence negative values

	$("#speedSlider")
		.slider({ orientation: 'vertical',
						range: 'min',
						  min: -20,
						 step: 1,
						  max: -1,
						value: readPercentageCookie()
				});

	// bind the change method for slider: if slider is moved (value set or changed) this function fires off.

	$("#speedSlider").bind( "slidechange", function(event, ui){
		var pc = ui.value;
		//console.log('speedSlider value was set or changed: new percentage cookie value is: '+pc);
		if (isNaN(pc) === false)			// don't write invalid cookies
			writePercentageCookie(pc);
		pc = (pc - 1) * -5;			// pc now has a value of 10, 20, 30, 40, 50, 60, 70, 80, 90 or 100
		if (mSecViewTime > (200 * pc)){
			panelChanger();				// immediately update the page if the slider change decreased the view time
		}
		mSecViewTime = 200 * pc;		// view-time of panels may be 2,000 to 20,000 milliseconds (2 to 20 seconds)
		pauseScroll();
		restartScroll();
		//console.log('new mSecViewTime is '+mSecViewTime+' percentage: '+ pc+'%');
		pc = (-1 * ui.value);
		$("#speedSlider a").css({'font-weight': '700', 'color': '#fff','textAlign': 'center'}).html(pc);
	});

	// ------------------ the Contact Us button toggle logic ------------------------------------

	$('#contBtn').click(function(){			// // // // This is the 'Contact Us' button toggle logic // // // //
		var panel = $('#contactPanel'), x,
		down = parseInt(panel.css('height'), 10) === 0 ? true : false;	// initially set to 0 in css file

		panel.animate({
					'height': (down ? 405 : 0),
		   'backgroundColor': (down ? defaultColor : 'transparent')},
					  'slow', easingType);
		$(this).css('backgroundColor', down ? highlightColor : defaultColor);
		if (down){
			dropToContacts();
		}else{
			returnHeading();
		}
	});

	$('#helpBtn').click(function(){			// // // // This is the 'Help' button toggle logic // // // //
		if(helpAvailable === true){
			var panel = $('.panel'),
				needsHelp = ($('#helpPanel').css('height') === '0px' ? true : false);	// initially set to 0 in css file
			$('#helpPanel').animate({
					'height': (needsHelp ? 405 : 0),
				 'marginTop': (needsHelp ? 0 : 405)},
					  1000, easingType);
			if(needsHelp){
				$('#speedSliderDiv, #upArrow, #downArrow, #scrollControls').removeClass('opaque');
				panel.addClass('opaque');
			}else{
				$('#speedSliderDiv, #upArrow, #downArrow, #scrollControls').addClass('opaque');
				panel.removeClass('opaque');
			}

			panel.css({'backgroundColor': needsHelp ? '#faa' : '#fff'});
			$(this).css('backgroundColor', needsHelp ?  highlightColor : defaultColor);
		}
		else
			alert("Help is presently only available on scrolling pages. Please move to a page that scrolls and press the 'Scroll Help' button again.");
	});

		//for *feedback* pull-out window -----------------------------------------------------

	function resetPage(){
		$('#feedbackWrapper').css('width','35px');
		//$('#ExpandedComments').css({'display': 'none', 'background': 'red'});
	}

	//in non-IE browsers, the feedback block, even hidden, interferes with the
	//requestForm fields because it is on a z-index plane over the form.
	//The problem is resolved by narrowing the width of the feedbackWrapper div
	//when it is hidden.
	$("#feedbackButton").toggle(function(){
		$('#feedbackWrapper').animate({'width':'450px'}, 'fast', function(){
			$("#feedbackPanel").show("blind", { direction: "left" }, 'slow');
		});
	},
	function(){
		$('#feedbackWrapper').animate({'width':'35px'}, 'fast', function(){
			$("#feedbackPanel").hide("blind", { direction: "left" }, 'slow');
		});
	});

	//if the feedback form's cancel button is pressed
	$('#feedbackCancel input').click(function () {
		$('#feedbackWrapper').css('width','35px');
		$("#feedbackPanel").hide("blind", { direction: "left" }, 'slow');
	});

	//when the feedback form's submit button is clicked...
	$('#feedbackSubmit input').click(function (e) {
		e.preventDefault();
		//Get the feedbackData from all the fields
		feedbackName = $('#feedbackName');
		feedbackEmail = $('#feedbackEmail');
		feedbackText = $('#feedbackText');

		//organize the data properly
		feedbackData = 'feedbackName=' + feedbackName.val() + '&feedbackEmail=' + feedbackEmail.val() + '&feedbackText=' +
		feedbackText.val();

		//disabled all the text fields
		$('.feedbackField').attr('disabled','true');

		//start the ajax routine to send the form to sendfeedback.php
		$.ajax({
			url: "SendFeedback.php",			//this is the php file that processes the data and send mail
			type: "GET",						//GET method is used
			data: feedbackData,					//pass the data
			cache: false,						//Do not cache the page
			success: function (html) {			//if sendfeedback.php returned 1/true (send mail success)
				if (html==='1') {					//hide the send button
					$('#block202').hide();
					$('#done202').show('slow');//show the success message
				}
				else //otherwise, if sendfeedback.php returned 0/false (send mail failed)
				{
					alert('Sorry, unexpected AJAX error\n|' + html + '|\nPlease try again.');
					$('.feedbackField').removeAttr('disabled');
					$('#done202').hide();
				}
			}
		});

		$("#feedbackPanel").hide("blind", { direction: "left" }, 'slow', function() {
			$('#feedbackWrapper').css('width','35px');
		});
	});

	//end of *feedback* pull-out window -------------------------------------------------

	//for *procedures* pull-out window --------------------------------------------------

	$("#feedbackButton img").focus(function(){
		$(this).blur();
	});

	$("#proceduresButton img").focus(function(){
		$(this).blur();
	});

	$("#proceduresWrapper").toggle(function(){
		$("#proceduresPanel").show("blind", { direction: "right" }, 'slow', function(){
			$('#proceduresWrapper').css('width','437px');
		});
	},
	function(){
		$("#proceduresPanel").hide("blind", { direction: "right" }, 'slow', function() {
			$('#proceduresWrapper').css('width','35px');
		});
	});

	//end of *procedures* pull-out window -------------------------------------------------


	// // // // // // // // // // // // // // // // // // // // // // // //
	//																	 //
	//		This is the pullout and pulloutSelected tabs hover logic	 //
	//																	 //
	//		<div class='roundedCorners pullout' id='p6'>				 //
	//		<a tabindex='-1'  href='AboutUs.php'>About Us</a>			 //
	//	</div>															 //
	//																	 //
	// // // // // // // // // // // // // // // // // // // // // // // //

	$('.pullout').hover(function(){										// when hovering over a pull-out tab
		$('.Tag', this).fadeOut('fast');
		$(this)
			.addClass('highlightColorBackground')
			.stop(true, false).animate({'left':85}, 400, 'easeOutBounce');

		$('.dpd a', this).fadeIn('fast');
	},
	function(){
		$('.Tag', this).fadeIn('fast');
		$(this)
			.removeClass('highlightColorBackground')
			.stop(true, false).animate({'left':0}, 400, 'easeOutBounce');
		$('.dpd a', this).fadeOut('fast');
	});

	$('#featureTabContainer li, .pullout').click(function(){
		var dest = $('a', this).attr('href');
		//console.log('click to '+dest);
		window.location=dest;				// let user click anywhere in tab li or .pullout
	});




	function vibrate(){
		$(vibrationSelector).stop(true,false)
				.css({'top': baseT + Math.round(Math.random() * shake) - ((shake + 1) / 2)});
	}

	function stopVibration(){
		window.clearInterval(vibrateIndex);
		$(vibrationSelector).stop(true,false)
				   .css({'top': baseT});
	}

	function startVibration(mySelector, baseTop){
		vibrationSelector = mySelector;
		baseT = baseTop;
		vibrateIndex = window.setInterval(vibrate, vibrationInterval);
		window.setTimeout(stopVibration, vibrationDuration);
	}

	// hovering over arrow icons causes vibration
	$('#upArrow').hover(function(){
		startVibration(this, 15);
	}, function(){
		stopVibration();
		$(this).css('padding-bottom', 0);
	});

	$('#downArrow').hover(function(){
		startVibration(this, 345);
	}, function(){
		stopVibration();
		$(this).css('padding-top', 0);
	});


	$('#upArrow').click(function(){		//	go back 1 page
		var x, panel = $('.panel');
		stopVibration();
		pauseScroll();
		x=panelIndex;
		panelIndex--;
		if (panelIndex < 0){
			panelIndex = numberOfPanels - 1;
		}
		panel.eq(x).css('top', 0).stop(true, false).animate({'top': 400},
		{
			step: function(now, fx){
				panel.eq(panelIndex).css('top', (now - 400)).stop(true, false);
			}
		},
				aniSpeed, easingType, updatePtrColor());
	});



	$('#downArrow').click(function(){		//	advance 1 page by pressing the down arrow or the resume button
		var x, panel = $('.panel');
		stopVibration();
		pauseScroll();
		x=panelIndex;
		panelIndex++;
		if (panelIndex >= numberOfPanels){
			panelIndex = 0;
		}
		//scroll up the last panel above the view frame
		panel.eq(x).css({'top': 0}).animate({'top': -400},
		{
			step: function(now, fx){		// and along with it scroll the next one into view
				panel.eq(panelIndex).css('top', (now + 400)).stop(false, false);// true, true
			}
		},
			aniSpeed, easingType, updatePtrColor());

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

		//change the active page's btn colors to show which button is active at page load time

	function adjustButtonColor()  // returns the index number for current page so btnSelected class can be added
	{
		var k=99, i = 99, Page, PageN;

		Page=window.location.pathname;		// get this page's full URI
		PageN=Page.lastIndexOf("\\");		// this will allow checking of a trailing slash, '/'

		if (PageN < 1){						// did the url include a file name, or was it just the domain?
			PageN=Page.lastIndexOf("/");
		}
		PageName=Page.substr(PageN + 1);	// get the index of the page name
		switch(PageName){
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
				$('h1').css('display', 'block'); /* show h1 headers on the page */
				k = 0;
				break;
			case 'CISdocuments.php':
				$('h1').css('display', 'block'); /* show h1 headers on the page */
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

		if (i < 7){				// if a btn for new page was found, make the background the active color.
			$('#buttonContainer li').eq(i).css('backgroundColor', activeColor); // dark blue
		}

		if (k < 6)					// otherwise a pull-out tab must have been clicked, so add the class 'pulloutSelected' to the pullout[n]
		{
			$('.pullout').eq(k).css('backgroundColor', activeColor);// dark blue
		}

		if ((i < 6) || (k === 2) || (k === 4) || (k === 5)){
			$('#upArrow, #downArrow, #speedSliderDiv').css('display', 'block');
			helpAvailable = true;
		}else{
			helpAvailable = false;
			$('#progressBarWrapper, #progressBar').css('display', 'none');
		}
	}  // end of adjustButtonColor()


	// script starts here

	$("#speedSlider .ui-widget-header, #speedSlider .ui-slider-handle").css('background', defaultColor);
	$('#speedSlider').get();											// wait until slider is defined
	setPageScrollControls();
	pause = $('#pause');
	resume = $('#resume');
	mSecViewTime = -2000 * (parseInt(readPercentageCookie(), 10) - 1);		// get the scroll speedSliderDiv indicator at script start & put on handle
	// mSecViewTime now has a value of 2,000; 4,000; 6,000; 8,000; 10,000; 12,000; 14,000; 16,000; 18,000; or 20,000 milliseconds
	adjustButtonColor();
});   //end of jquery
