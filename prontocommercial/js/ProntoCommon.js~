//jquery code starts here
    
	//These variables are for panelChanger only
	var startingPanel, endingPanel, panelIndex = 0, rotateTimer, currentCarousel = 0;
	var Dir = 1, newIndex, activeColor = '#015158', defaultColor = '#2ec4cd';
	//these 2 arrays hold the activePosition (left side) and defaultPosition (right side) of each slide
	var activePosition = [], defaultPosition = [], defaultBackground = '#fff';
	
	var newHTML ='Get started today. Submit a <a href="CISform.doc">Client Information ';
	newHTML		+='Sheet</a> &amp; passport right now. Attach it to your email sent to ';
	var mmail='<a href="mailto:';
	mmail+='&#112;&#114;&#111;&#110;&#116;&#111;&#99;&#111;&#109;&#109;&#101;&#114;&#99;&#105;&#97;&#108;';
	mmail+='@&#103;&#109;&#97;&#105;&#108;&#46;&#99;&#111;&#109;">email</a>.';
	//for plane functions
	var timerId1 = 0, timerId2 = 0, cookieLabel;
	var EaseType = ['easeOutQuart', 'easeOutCubic', 'easeInOutCubic', 'easeOutSine', 
	'easeOutQuad', 'easeInOutQuad',	'easeOutBack', 'easeInBack', 'easeOutElastic', 
	'easeInOutBack', 'easeOutBounce', 'easeInBounce'];
	var h3Width = 26, viewTime = 3500, fullPanelWidth = 527, aniSpeed = 8000, easingMethod = EaseType[11];//'easeOutQuart';
	

	$('#IncreaseSize').hover(function() {
		$(this).css('color', defaultColor);
	},function() {
		$(this).css('color', activeColor);
	});	
	$('#DecreaseSize').hover(function() {
		$(this).css('color', defaultColor);
	},function() {
		$(this).css('color', activeColor);
	});
	// Put the panel's title up on the H1 header and make the H3 dark blue;
	function activateH1(i){
		var title;
		
		title =  $('h3').eq(i).attr('title');					//get 'title' from the current h3 element
		//alert(title);
		
		$('.feature > h1').text(title);									//put the 'title' in the page's h1 element
		
		$('h3').each(function(){								//color all the h3 headers light blue
			$(this).css('backgroundColor', defaultColor);
		});	

		$('h3').eq(i).css('backgroundColor', activeColor);	// make the active h3 header dark blue	
	}


	//activate the panes in sequence, wrapping back to the first pane when the last has been viewed
	function panelChanger() {
		var newPosition, i;
	
		// if going backward, here's how to loop around
		if (Dir == -1){
			if (panelIndex < 1){  // if at first panel, jump to last
				for(i=1;i<(endingPanel);i++){
					panelIndex = i;
					newPosition = activePosition[panelIndex];
					$('.panel').eq(panelIndex)
					.css('width', fullPanelWidth).css('display', 'block')
					.stop().animate({left: newPosition}, {speed: aniSpeed}, easingMethod);
				}
				panelIndex = endingPanel - 1;
			}
			else
			{
				newPosition = defaultPosition[panelIndex];	
					$('.panel').eq(panelIndex)
					.css('width', fullPanelWidth).css('display', 'block')
					.stop().animate({left: newPosition}, {speed: aniSpeed}, easingMethod);
				panelIndex--;
			}
			
			activateH1(panelIndex);
		}
		else // if moving forward . . .
		{
			panelIndex++;
			if (panelIndex < endingPanel) //if not at the end of the panels, just move the current one to the active position
			{
				newPosition = activePosition[panelIndex];
				$('.panel').eq(panelIndex)
					.css('width', fullPanelWidth).css('display', 'block')
					.stop().animate({left: newPosition}, {speed: aniSpeed}, easingMethod);
				activateH1(panelIndex);
					
			}
			else		// we are at the end of the panels so move all except the first to the default position
			{			// looping backward
				for(i=1;i<endingPanel;i++)
				{
					panelIndex = endingPanel - i;
					newPosition = defaultPosition[panelIndex];	
					$('.panel').eq(panelIndex)
						.css('width', fullPanelWidth).css('display', 'block')
						.stop().animate({left: newPosition}, {speed: aniSpeed}, easingMethod);	// now use jquery to slowly move it left
				}
				panelIndex = 0;
				activateH1(panelIndex);
			}
		}	
	}

	function pauseCarousel(){
		var cookie_name = "carousel"; 

		document.cookie=cookie_name+"=0; expires=Wednesday, 01-Aug-2040 08:00:00 GMT"; //to pause
		$('#pause') .css('display', 'none'); 
		$('#resume').css('display', 'block'); // make toggle icon 'resume'
		window.clearInterval (rotateTimer);
	}
	
	function ToggleCarousel() {
		var cookie_name = "carousel", uri, shortString; 
		var CarouselSetting, countbegin, countend, index = -1;
		
		if(document.cookie) {
			index = document.cookie.indexOf(cookie_name);
		}
		
		if(index == -1){
			 // if no cookies exists, create one and set it to a running Carousel
			document.cookie=cookie_name+"=1; expires=Wednesday, 01-Aug-2040 08:00:00 GMT";
			index = document.cookie.indexOf(cookie_name);
		} 
		
		// carousel cookie	Meaning		Label Setting
		//			1			running		"Pause Carousel"
		//			0			paused		"Resume Carousel"
	
		countbegin = (document.cookie.indexOf("=", index) + 1);  // set positions to read the cookie
		countend = document.cookie.indexOf(";", index);
		if (countend == -1) {
			countend = document.cookie.length;
		}
	
		uri = window.location.href;	//name of page
		shortString = uri.indexOf("/FundingRequest.php");			//see if it is 'FundingRequest.php'
		if ((shortString > -1))	//if so, do not let carousel begin rotating
		{
			//alert("hey wait a minute...we're in FundingRequest.php");
			CarouselSetting = 0;
			$('#pause') .css('display', 'none'); 
			$('#resume').css('display', 'block'); // with this webpage always show icon 'resume'
		}
		else // if not in FundingRequest.php...
		{	//read cookie
			CarouselSetting = document.cookie.substring(countbegin, countend);
		
			if (CarouselSetting == 1)	//if current setting is 1, as in running the accordion carousel
			{									// so toggle the setting
				CarouselSetting = 0;			// we are toggling the setting, so change cookie to 0, to continue
				
				$('#pause') .css('display', 'none'); // make toggle icon 'pause'
				$('#resume').css('display', 'block');

				pauseCarousel();
			}
			else			//otherwise set it to pause
			{
				CarouselSetting = 1;
				document.cookie=cookie_name+"=1; expires=Wednesday, 01-Aug-2040 08:00:00 GMT";
				$('#pause') .css('display', 'block'); // make toggle icon 'pause'
				$('#resume').css('display', 'none');
				rotateTimer=window.setInterval(panelChanger, viewTime);	//start rotating
			}
		}
		return(CarouselSetting);
	}	
	
	
	function ReadCookie(cookie_name) {
			// carousel cookie	Meaning		Label Setting
			//			1			running		"Pause Carousel"
			//			0			paused		"Resume Carousel"
		
		var count = 1; //default is 1, to continue running the carousel and/or NOT show planes
		var countbegin, countend, index, shortString;
		var uri = window.location.href;	//name of page
		shortString = uri.indexOf("/FundingRequest.php");			//see if it is 'FundingRequest.php'
		if ((cookie_name == 'carousel') && (shortString > -1))	//if so, do not let carousel begin rotating
		{	
			//alert("hey wait a minute...we're in FundingRequest.php");
			return(0);
		}	
		
		if(document.cookie) //any cookies exist?
		{
				index = document.cookie.indexOf(cookie_name);	//yes, see if this cookie exists
				if (index != -1) {								//if it does then read the cookie
					countbegin = (document.cookie.indexOf("=", index) + 1);
					countend = document.cookie.indexOf(";", index);
					if (countend == -1) {
						countend = document.cookie.length;
					}
					count = document.cookie.substring(countbegin, countend);
				}
		}
		
		return (count);		//return contents of cookie
	}
		
	//For loading and space efficiency, ./images/AccordionMenu.png holds all vertical headers that show on the pages.
	//startingPanel points to the first vertical header on this page, endingPanel is the one after the last page header
	//each header is 24px wide
	//by default, each graphic has a light blue background: rgb(94, 196, 205) or #5EC4CD is hex color notation
	//the active accordion section's color is dark blue: rgb(2, 81, 103) or #025167 is hex color notation
	
	function housekeepingStuff() {
		var i, xNy, xpos, Masking; 

		// put the graphic in each h3 element
		for (i = startingPanel; i < endingPanel; i++)
		{
			xNy = (-24 * i + 'px 0');
			$($('h3').get(i-startingPanel)).css('backgroundPosition', xNy);	 //adjust position in graphic to display h3 element correctly(width is 24px each)
			$($('h3').get(i-startingPanel)).css('backgroundColor', defaultColor); // initialize on page load w/default light blue color
			if((i-startingPanel) == 0){
				$('h3').css('backgroundColor', activeColor);			//for first h3, highlight of dark blue	
			}
		}	

		
		//now that the h3 headers are set on the page, let's normalize the pane index start and end
		endingPanel = endingPanel - startingPanel;
		panelIndex = startingPanel = 0;

		//add unique class based on the index number and a unique z-index for each h3
		$('h3').each(function(index){
			$(this).addClass('index_'+index);			//add the index number as a class to each h3 element. 
			i = index + 5;
			$('.panel').eq(index).css('zIndex', i);		// each .panel should have a different z-index and be h3Width further right
			//alert('panel '+index + ' setting zIndex to be '+ i);
			if(index == endingPanel){
				$(this).addClass('last_index');
				//alert('last z was '+ i);
			}
		});		
		
		//	endingPosition = room for a panel and h3 element for other panel. 
		//	Currently each panel size is 430 = h3Width (30) + panelContent width (400)
	
		var endingPosition = fullPanelWidth + (h3Width * (endingPanel - 2)); 
	
		for (i = endingPanel; i > 0; i--){
			xpos = endingPosition - ((i - 1) * h3Width);
			defaultPosition[endingPanel - i] = xpos; //create an array of default left positions for the panels
		}
		
		for(i = 0; i < endingPanel; i++){
			xpos = i * h3Width;
			activePosition[i] = xpos;		//create an array of active left positions for the panels
			$('.panel').eq(i).css('width', h3Width).css('left', defaultPosition[i]);
		}
		Masking = (774 - endingPosition) + 'px';
		$('.featuretteMask').css('width', Masking);
	}

	//	**** remember, this function is run just on initial load *****
	
	function rotateAccordion(){	
		housekeepingStuff();

		$('.panel').eq(0)	// panel should be located at first default position 
			.css('width', fullPanelWidth).css('display', 'block')
			.filter(':not(:animated)').stop().animate({left:0}, {speed: aniSpeed}, easingMethod);	// until it is 0, the first active position.
		//should the carousel be paused or running?
		var currentCarousel = ReadCookie("carousel");			//check cookie at start-up 

		// carousel cookie	Meaning		Label Setting
		//			1			running		"Pause Carousel"
		//			0			paused		"Resume Carousel"
		
		if(currentCarousel == 1)			//if cookie is set to one (or doesn't exist) , resume carousel...
		{
			rotateTimer=window.setInterval(panelChanger, viewTime);	//start rotating
			$('#pause') .css('display', 'block'); // make toggle icon 'pause'
			$('#resume').css('display', 'none');
		}
		else
		{
			window.clearInterval (rotateTimer);							//otherwise, pause carousel
			$('#pause') .css('display', 'none'); 
			$('#resume').css('display', 'block'); // make toggle icon 'resume'
		}	
	}	

	
	function currentTab()
	{
		var $selected = $('.tab_selected');
		$selected.addClass('tab').removeClass('.tab_selected');
		if ($selected.hasClass('startTab') == true)
			return(0);
		if ($selected.hasClass('pofTab') == true)
			return(1);
		if ($selected.hasClass('pppTab') == true)
			return(2);
		if ($selected.hasClass('ifTab') == true)
			return(3);
		if ($selected.hasClass('ilTab') == true)
			return(4);
		if ($selected.hasClass('clTab') == true)
			return(5)
		if ($selected.hasClass('frTab') == true)
			return(6);
		return(-1);
	}
	
$(document).ready(function(){
	//--------------------------
    $('.rounded').corner();				// rounds all divs with class 'rounded'
	$('#featureElementsContainer').corner().fadeTo("fast", 0.85);
	/*$('.startTab').corner();
	$('.pofTab').corner();
	$('.pppTab').corner();
	$('.ifTab').corner();
	$('.ilTab').corner();
	$('.clTab').corner();
	$('.frTab').corner();
	$('.cnTab').corner();		//fully rounded tabs*/
	$('#FeedbackButton').uncorner().corner('right');
	/*
	if($.browser.msie !== true){				//test for IE browser which cannot round div w/border: groove correctly
		$('.feature').corner('8px');
	}
	*/
	$('#featureElementsContainer').corner("bottom 16px"); //chaining commands together; the featureElementContainer is rounded only at the bottom
	
	//$('.feature').corner("round 8px");  //for divs framed with highlighted color
		
	// -------for next/prev page loading
		
	$('#prevButton').click(function(){
		var nextTab = currentTab();
		if(nextTab > -1)
		{
			nextTab--;
			if (nextTab < 0)
				nextTab = 6;
			location.href=$('.tab').eq(nextTab).attr('href');
		}
	});
	
	$('#nextButton').click(function(){
		var nextTab = currentTab();
		if(nextTab > -1)
		{
			nextTab++;
			if (nextTab > 6)
				nextTab = 0;
			location.href=$('.tab').eq(nextTab).attr('href');
		}
	});


	//----------pause/continue toggler--------------

	$('.pauseResume').hover(function(){
			$(this).css('marginTop', 3);
		}, function(){
			$(this).css('marginTop', 5);
	});	

	// the pause/continue header is clicked
	$('.pauseResume').mousedown(function(){
		$(this).css('marginTop', 1);
		ToggleCarousel();
	});

	$('.pauseResume').mouseup(function(){	
		$(this).css('marginTop', 5);
	});	
	// ---------------------------------------------
	
	$('#backwardOne').click(function(){
		pauseCarousel();
		Dir = -1;		
		panelChanger();		
		Dir = 1;
	});
	
	$('#forwardOne').click(function(){
		pauseCarousel();
		panelChanger();
	});
	
	//this adds the 'shine' when hovering over a h3 title bar
	$('.h3Wrapper').hover(function() {
		$(this).find('.h3Shine')
			.css('opacity','0.6')
			.css("backgroundPositionY",-300)
			.animate({backgroundPositionY: 300},700);

	},function() {
		$(this).find('.h3Shine')
			.css('opacity','1')
			.css("backgroundPositionY",-550)
			.animate({backgroundPositionY: 550},700);
	});
	
	
	
	
	// if a h3 header is clicked directly, just go there.

	$('h3').click(function(){
		var i;
		var index = $(this).attr('class'); //class will be index_x
		
		var targetIndex = parseInt(index.substring(6), 10);
		if(panelIndex < targetIndex){
			for(i= panelIndex; i < targetIndex; i++){
				$('#forwardOne').trigger('click');
			}
		}
		
		if(panelIndex > targetIndex){
			for(i=panelIndex; i > targetIndex; i--)
				$('#backwardOne').trigger('click');
		}
	});

	$('.cnTab').toggle(function(){			// // // // This is the Contact Us toggle logic // // // // 
		$('#contactPanel').css('display', 'block');
		$('#carouselControls, #speedSlider').css('display', 'none');		
		//$('.feature').css('borderColor', '#025167');
		$('.slider-nav').css('display', 'none');
		$('#extraTabsContainer')
				.stop()
				.animate({height: 420, top:0, backgroundColor: defaultColor}, {speed: 'slow'}, easingMethod);
	},
	function(){
		$('.feature').css('borderColor', '#025167');
		$('#extraTabsContainer')
				.stop()
				.animate({height: 0, top:420, backgroundColor: defaultBackground}, {speed: 'slow'}, easingMethod);
		$('.slider-nav').css('display', 'block');
		$('#contactPanel').css('display', 'none');
		$('#carouselControls').css('display', 'block');
	});
	
	/////////////////////////////////////////////////////////////////////////////////////////////
	// Remember, when making a change to this file, delete the ProntoCommon.min.js file!!!	  //
	///////////////////////////////////////////////////////////////////////////////////////////	
	var DebugPlanes = false;
	var DebugFundingRequests = false;
	  
	if (DebugPlanes == true){
		$('#planeDebugForm').css('display', 'block');
	}
	if (DebugFundingRequests == true)
	{
		$('#requestDebugForm').css('display', 'block');
		$('#eventsDebugForm').css('display', 'block');
		$('#Bubble').css('display', 'block');
	}

	function littlePlane1()  //starts from left
	{
		var randomEase=Math.floor(Math.random()*6);
		var randomTop=Math.floor(Math.random()*700);
		var randomStart=Math.floor(Math.random()*2000) + 12000;		//pick a number from 0 and 2,000
		
		document.getElementById('mdelay1').value=0;

		$('#plane1').css('visibility', 'visible');
		$("#plane1").css("top",randomTop);
		$("#plane1").css("left","-10px");  //start left:-10
		$("#plane1").css("visibility","visible");

		//put values on web page to debug
		document.getElementById('mdelay1').value = randomStart / 1000.0;	//put these values on the web page
		document.getElementById('functionName1').value = 'littlePlane1()';
		document.getElementById('top1').value  = randomTop;  //put these values on the web page
		document.getElementById('left1').value = '-10px';
		document.getElementById('topdest1').value ='+=110px';
		document.getElementById('leftdest1').value = '1400px';
		document.getElementById('Easing1').value = EaseType[randomEase];

		$("#plane1").animate({"left":1400, "top": '+=110'},6000, EaseType[randomEase]); // animate plane1 for 12 seconds from left:-10 to 1400, lowering 110px	
	}
	
	function littlePlane2()  //starts from right side of page
	{

		var randomEase=Math.floor(Math.random()*6);
		var randomTop=Math.floor(Math.random()*700);
		var randomStart=Math.floor(Math.random()*2000) + 6000;		//pick a number from 0 and 2,000. Add 12 seconds to it.
		
		document.getElementById('mdelay2').value=0;
		
		$('#plane2').css('visibility', 'visible');
		$("#plane2").css("top",randomTop);
		$("#plane2").css("left","1400px");
		$("#plane2").css("visibility","visible");

		//put values on web page to debug
		document.getElementById('mdelay2').value = randomStart / 1000.0;  //put these values on the web page
		document.getElementById('functionName2').value = 'littlePlane2()';
		document.getElementById('top2').value = randomTop;  //put these values on the web page
		document.getElementById('left2').value = '1400px';
		document.getElementById('topdest2').value = '-=180px';
		document.getElementById('leftdest2').value = '-80px';
		document.getElementById('Easing2').value = EaseType[randomEase];

		$("#plane2").animate({"left": '-80px', "top": '-=180'},6000, EaseType[randomEase]); // animate plane2 for 12 seconds moving toward x=-80px y= raising 180px
	}	
	
	// write cookie if it does not exist
	// if it exists, toogle to to opposite

	function ToggleCookie(cookie_name) 
	{
		var countbegin, countend, index;
		
		if(document.cookie) {
			index = document.cookie.indexOf(cookie_name);
		} else {
			index = -1;
		}

		if (index == -1) { // if no cookie exists, create one and set it to show planes
			if(cookie_name == 'firstTime'){
				document.cookie=cookie_name+"=Y; expires=Wednesday, 01-Aug-2040 08:00:00 GMT";
			}
			else{
				document.cookie=cookie_name+"=0; expires=Wednesday, 01-Aug-2040 08:00:00 GMT";
			}
		} 
		countbegin = (document.cookie.indexOf("=", index) + 1);  // set positions to read the cookie
		countend = document.cookie.indexOf(";", index);
		if (countend == -1) {
			countend = document.cookie.length;
		}
		//read cookie
		var cookieSetting = document.cookie.substring(countbegin, countend);
		
		if (cookieSetting == 1)	//if current setting is 1, to hide planes
		{						//change cookie to 0, to show
			document.cookie=cookie_name+"=0; expires=Wednesday, 01-Aug-2040 08:00:00 GMT";
			$('#ShowHide').html('Hide Planes'); // make toggle label the opposite
			cookieSetting = 0;
		}
		else			//otherwise set it to hide
		if (cookieSetting == 0)
		{
			document.cookie=cookie_name+"=1; expires=Wednesday, 01-Aug-2040 08:00:00 GMT";
			$('#ShowHide').html('Show Planes'); // make toggle label the opposite
			cookieSetting = 1;
		}
		
		if (cookieSetting == 'Y')
		{
			document.cookie=cookie_name+"=N; expires=Wednesday, 01-Aug-2040 08:00:00 GMT";
			//alert('set '+ cookie_name + ' to N');
			cookieSetting = 'Y';
		}
		
		return(cookieSetting);
	}	
	
	// for the "Show Planes/ Hide Planes" tag
	$("#ShowHide").hover(function(){$(this).css('cursor', 'pointer').css('backgroundColor','#fff').css('color','blue');
	}, 
			 function(){$(this).css('cursor', 'default').css('backgroundColor','transparent').css('color','#007');
	});		

	var currentStatus = ReadCookie("ShowPlanes"); //at start-up check cookie
	
	if(currentStatus == 0)			//at start up, if cookie is set to show planes...
	{
		littlePlane1();
		littlePlane2();
		timerId1 = window.setInterval(littlePlane1, 7000);
		timerId2 = window.setInterval(littlePlane2, 7000);	
		cookieLabel = 'Hide Planes'; //put the opposite on the page
	}
	else
	{
		$('#plane1').css('visibility', 'hidden');
		$('#plane2').css('visibility', 'hidden');
		window.clearInterval (timerId1);
		window.clearInterval (timerId2);	
		cookieLabel = 'Show Planes'; //put the opposite on the page
	}
	
	$('#ShowHide').html(cookieLabel).css('font-weight','900').css('color', '#007'); // set the label initially on page
	
	//if the show/hide plane label on the web page is clicked
	$('#ShowHide').click(function(){
		if(ToggleCookie('ShowPlanes') == 0)
			{
				littlePlane1();
				littlePlane2();
				timerId1 = window.setInterval(littlePlane1, 7000);
				timerId2 = window.setInterval(littlePlane2, 7000);	
				cookieLabel = 'Hide Planes'; //put the opposite on the page
			}
			else
			{
				$('#plane1').css('visibility', 'hidden');
				$('#plane2').css('visibility', 'hidden');
				window.clearInterval (timerId1);
				window.clearInterval (timerId2);
			}
	});
			
		//for *feedback* pull-out window -----------------------------------------------------
	
	function resetPage(){
		$('#container200').css('width','35px');
		$(".nonFeedback").fadeTo("fast", 1.0);
		$('#Content2New').css('display', 'none');
	}
	var visitorname, email, feedback, data, ShowHideToggle = 0;

	$("#FeedbackButton").toggle(function(e){
			$(".nonFeedback").fadeTo("fast", 0.2, function(e){
				$('#container200').css('width','444px');	//in non-IE browsers, the feedback block, even hidden, interferes with the 
														//requestForm fields because it is on a z-index plane over the form.
														//The problem is resolved by narrowing the width of the feedback form div
														//when it is hidden.
					$("#slide-panel201").show("blind", { direction: "left" }, 'slow').stop();
				});
				
				//alert('toggle opened feedback. was at panel '+panelIndex);
				e.preventDefault();
	},
		function(e){		
			$("#slide-panel201").hide("blind", { direction: "left" }, 'slow', function() {
				//alert('toggle closed feedback. activating panel '+panelIndex);
				resetPage();
			});
			
			e.preventDefault();
	});
	
	//if the form's cancel button is pressed
	$('#cancel202').click(function (e) {			
		ShowHideToggle = 0;	
		$("#slide-panel201").hide("blind", { direction: "left" }, 'slow', function() {
			resetPage();
		});
		e.preventDefault();
	});	

	//when the submit button on the feedback pull-up window is clicked...
	$('#submit202').click(function (e) {		
	
		//Get the data from all the fields
		visitorname = $('input[name=visitorname]');
		email = $('input[name=email]');
		feedback = $('textarea[name=feedbacktext]');

		//organize the data properly
		data = 'visitorname=' + visitorname.val() + '&email=' + email.val() + '&feedback=' +
		feedback.val();
	
		//disabled all the text fields
		$('.feedbackfield').attr('disabled','true');		
		
		//start the ajax routine to send the form to sendfeedback.php
		$.ajax({
			//this is the php file that processes the data and send mail
			url: "SendFeedback.php",	
			
			//GET method is used
			type: "GET",

			//pass the data			
			data: data,		
			
			//Do not cache the page
			cache: false,
			
			//success
			success: function (html) {
				//if sendfeedback.php returned 1/true (send mail success)
				if (html==1) {
					//hide the send button
					$('.block202').hide();					
					
					//show the success message
					$('#done202').fadeIn('slow');
				}					
				else //otherwise, if sendfeedback.php returned 0/false (send mail failed)
				{
					alert('Sorry, unexpected AJAX error\n|' + html + '|\nPlease try again.');
					$('.feedbackfield').removeAttr('disabled');
					$('.loading202').hide();
				}					
			}			
		});
		
		ShowHideToggle = 0;	
		$("#slide-panel201").hide("blind", { direction: "left" }, 'slow', function() {
			resetPage();
		});

		//alert('Send closed feedback. activating panel '+panelIndex);
		e.preventDefault();
	});	
	
	//end of *feedback* pull-out window -----------------------------------------------------
	
// common eyeCatcher window routines
		if(maxSize == undefined)
			var maxSize = 460;

	$('#windowClose').click(function(){
		$('.pageCatcher').hide();
	});
	$('#windowMax').click(function(){
		$('#windowMax').hide();
		$('#windowMin').show();
		$('#windowContent').css('height', (maxSize - 40) + 'px');  //maxSize should be globally defined
		$('.pageCatcher').css('height', maxSize + 'px');  //maxSize should be globally defined
	});
	$('#windowMin').click(function(){
		$('#windowMin').hide();
		$('#windowMax').show();
		$('.pageCatcher').css('height', '30px');
	});
	
	$('#windowTopContent').toggle(function(){
		$('#windowMax').hide();
		$('#windowMin').show();
		$('#windowContent').css('height', (maxSize - 40) + 'px');  //maxSize should be globally defined
		$('.pageCatcher').css('height', maxSize + 'px');  //maxSize should be globally defined
	},
	function(){
		$('#windowMin').hide();
		$('#windowMax').show();
		$('.pageCatcher').css('height', '30px');
	});

		var firstTimeGuide = 
		"<p class='eyeText'>It looks like you've never visited this website. No problem.<\/p>" +
		"<p class='eyeText'>Here's a tip: The website is split into 5 major web pages, discussing each of our products.<\/p>" +
		"<p class='eyeText'>They are represented by the tab menu on top, along with 'Home' and 'Funding Request.'<\/p>" +
		"<p class='eyeText'>Within each web page are a set of slides that are controled by the 3 buttons, " +
		"for <i>back 1 slide, pause/resume, and forward 1 slide</i>. They slides scroll much too fast to be completely read " +
		"so press the pause button. When paused, you can still scroll through the slides.<\/p>" +
		"<p class='eyeText'>Did we say 'Welcome'?<\/p>" +
		"<p class='eyeText'>Please have fun, learn a lot, and perhaps submit a funding request if a product looks like it fits your need.<\/p>";
		var firstTimeTop = "Welcome To Our Website!";

		$('#windowContent').html(firstTimeGuide).addClass('Resizable').addClass('rounded');
		$('#windowTopContent').html(firstTimeTop);

	if(ToggleCookie("firstTime") == 'Y')	
	{
		$('.pageCatcher')
				.css('display', 'block').css('height', '450px')
				.corner()
				.resizable({ alsoResize: '.Resizable', maxHeight: 470, minHeight: 30, minWidth: 250})
				.draggable()
				.fadeTo("fast", 0.85)
				.animate({top: '35%', left: '35%'}, 500, easingMethod);
		$('#windowTopContent').click();
	}
	
	//--------------set up the speed slider --------------------
function UpdateSpeed(){
	var value = $('#speedSlider').slider('option', 'value');
	//alert('slider says ' + value);
	viewTime = 6000 - (value * 500);
	if(ReadCookie("carousel") == 1){ //if running, change on-the-fly
		window.clearInterval(rotateTimer);
		rotateTimer=window.setInterval(panelChanger, viewTime);	//restart rotating
	}
}	
	$('#speedSlider').slider({
		animate: true,
		step: 1,
		range: "min",
		min: 1,
		orientation: 'horizontal',
		max: 10,
		value: 5,
		stop: function(event, ui){
			UpdateSpeed();
		}
	});	

	//for slider ----------------------------------------------

	//these are the 3 labels we'll add
	var sStartLabel  = 'slow';
	var sMiddleLabel = 'medium';
	var sEndLabel    = 'fast';
	$('#speedSlider').css('backgroundColor', defaultColor);
	$('#speedSlider  .ui-slider-range').css('backgroundColor', activeColor);
	$('#speedSlider a.ui-slider-handle').css('backgroundColor', defaultColor);
	$('#speedSlider a.ui-slider-handle').hover(function(){
		$(this).css('backgroundColor', activeColor);
	},
		function(){
		$(this).css('backgroundColor', defaultColor);
	});

	// -----------------end of slider specifics -----------------------------

	$('.featurette').css('display', 'block'); //featurette is initially display:none while it preloads

	$('#para').html(newHTML+mmail);
	$('#eemail').html(mmail);

});   //end of jquery


	function loanSpecial()
	{
		popDialog  = "<p>If you have a strong banking relationship with your bank we can bring a JV partner ";
		popDialog += "on your behalf to secure a commercial loan. The JV partner will come to the table with ";
		popDialog += "any  collateral that is acceptable to your bank to secure the loan. Process only takes ";
		popDialog += "15-30 days. In order for us to consider your project please forward:</p>";
		popDialog += "<ul><li>A 1 or 2 page summary of your project</li>";
		popDialog += "<li>A Client Information Sheet</li></ul>";			
		
		var $dialog = $('<div class="dialogBox"></div>')
			.html(popDialog)
			.dialog({
					autoOpen: true,
					title: 'Are you Looking For a JV Partner?',
					zIndex: 355,
					width: 500,
					buttons: { "Okay": function() { $(this).dialog("close"); } },
/*
					open: function(){
							$(this).parent().show("slide", { direction: "left" }, 2000);
							return(false);
						},
*/
					beforeclose: function(){
							$(this).parent().hide("slide", { direction: "right" }, 2000);
							return(false);
						}
		});
	}
	
	function insuranceWraps()
	{
		popDialog  = "<p>Have a mine or other asset? We are now offering<br/>";
		popDialog += "insurance wraps of assets for 4%. This offer is on a<br/>";
		popDialog += "limited basis. Contact us for details.</p>";
					
		var $dialog = $('<div class="dialogBox"></div>')
			.html(popDialog)
			.dialog({
					autoOpen: true,
					title: 'New Offering: Insurance Wraps',
					zIndex: 355,
					width: 400,
					buttons: { "Okay": function() { $(this).dialog("close"); } },
/*
					open: function(){
							$(this).parent().show("slide", { direction: "left" }, 2000);
							return(false);
						},
*/
					beforeclose: function(){
							$(this).parent().hide("slide", { direction: "right" }, 2000);
							return(false);
						}
		});
	}
//change the active page's tab color

	function adjustColors()  // returns the index number for current page so tab_selected class can be added
	{
		var i = 99, Page, PageN, PageName;
		
		Page=window.location.pathname;
		PageN=Page.lastIndexOf("\\");
		
		if (PageN < 1){
			PageN=Page.lastIndexOf("/");
		}
		PageName=Page.substr(PageN + 1);
	
		if((PageName == 'FundingRequest.php') || (PageName == 'FundingRequestSent.php'))
		{
			$('.frTab').addClass('tab_selected').removeClass('tab');
			i = 6;
		}
		else
		{
			if(PageName == 'CommercialLoans.php'){
				i = 5;
				//loanSpecial();
			}
			else
				if(PageName == 'BankInstrumentFinancing.php'){
					i = 3;
				}
				else
					if(PageName == 'BankInstrumentLeasing.php'){
						i = 4;
					}
					else
						if(PageName == 'ProofOfFunds.php'){
							i = 1;
						}
						else
							if(PageName == 'PrivatePlacementProgram.php'){
								i = 2;
								//insuranceWraps();
							}
							else
								if((PageName == 'index.php') || (PageName.length == 0)){
									i = 0;
								}
	
			//add the class 'tab_selected' to the tab[n] div in the featureTabsContainer div 
			if (i < 7)  // if a tab for new page was found, make the background lighter.
			{
				$('.tab').eq(i).addClass('tab_selected').removeClass('tab');
				//alert('i == '+i);
			}
		}
		
		if (i == 99){
			$('.feature').css('overflow-y', 'auto'); // make feature a scrolling div 
		}
		if (PageName == 'Glossay.php'){
			$('.feature').css('overflow-y', 'hidden');
		}
	}
	

	jQuery.event.add(window, "load", adjustColors);

	function BiggerFontSize(tagName) {
	
		var p, max, i, s;
	   p = document.getElementsByTagName(tagName);

	// For font size adjustments 
		max=20;
	   for(i=0;i<p.length;i++) {
	      if(p[i].style.fontSize) {
	         s = parseInt(p[i].style.fontSize.replace("px",""), 10);
	      } else {
	         s = 12; // if unspecified (therefore inherited) use 12px
	      }
	      if(s!=max) {
	         s += 1;
	      }
	      p[i].style.fontSize = s+"px";
	   }
	}
	
	function SmallerFontSize(tagName) {
	   var p, s, min, i;
	   p = document.getElementsByTagName(tagName);
	// For font size adjustments 
		min=8;
		
	   for(i=0;i<p.length;i++) {
	      if(p[i].style.fontSize) {
	         s = parseInt(p[i].style.fontSize.replace("px",""), 10);
	      } else {
	         s = 12;
	      }
	      if(s!=min) {
	         s -= 1;
	      }
	      p[i].style.fontSize = s+"px";
	   }
	}
		
	
	function increaseFontSize() {
		BiggerFontSize('p');
		BiggerFontSize('li');
	}
	function decreaseFontSize() {
		SmallerFontSize('p');
		SmallerFontSize('li');
	}