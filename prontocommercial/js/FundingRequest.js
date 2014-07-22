
	function writeCookie(cookieName, cookieValue){
		document.cookie=cookieName+"="+cookieValue+"; expires=Wednesday, 01-Aug-2040 08:00:00 GMT";
}
	function readCookie(cookieName) {
		var index, countbegin, countend, count = 1; //default is 1
		if(document.cookie)
		{
			index = document.cookie.indexOf(cookieName);			//see if cookie exists
			if (index !== -1) {										//if so, read cookie
				countbegin = (document.cookie.indexOf("=", index) + 1);
				countend = document.cookie.indexOf(";", index);
				if (countend === -1) {
					countend = document.cookie.length;
				}
				return document.cookie.substring(countbegin, countend);
			}
		}
		return "";
	}

$(document).ready(function(){
	var activeTab = 0, totalTabs, Currency = 'USD', SwiftType = 'None', activeColor = '#002c85', defaultColor = '#1A83A3',
		FullName, Phone, Skype, Country, Email, Category, Amount, LengthBox, Comments, Captcha, Scode = 0, arg0, arg1, arg2, argx;

	// for the fields in the first tab
	$('#FullName').val(readCookie('FullName'));
	FullName = readCookie('FullName');
	$('#Phone').val(readCookie('Phone'));
	Phone = readCookie('Phone');
	$('#Country').val(readCookie('Country'));
	Country = readCookie('Country');
	if ((Country === '') || (Country === "undefined")){
		Country = 'Select';
		writeCookie('Country', 'Select');
	}
	$('#Email').val(readCookie('Email'));
	Email	= readCookie('Email');
	$('#Category').val(readCookie('Category'));
	Category = readCookie('Category');
	if ((Category === '') || (Category === "undefined")){
		Category = 'Select';
		writeCookie('Category', 'Select');
	}
	//alert('Category |'+Category+'|');
	$('#Comments').val(readCookie('Comments'));
	Comments = readCookie('Comments');

	function sayIt(tabIndex){
		var ins;
		switch(tabIndex)
		{
			case 0:	ins = "We must have some information about you. Please complete all sections by clicking on each tab.";
					break;
			case 1: ins = "Now you must provide some specifics about what you'd lie from us.";
					break;
			case 2:	ins = "Thank you for spending the time and effort to provide us with the many detailed answers. Your effort will be rewarded when we deliver the product that meets your needs.";
					break;
			default: ins = "Well, this is rather embarrassing...I'm lost!";
					break;
		}

		$('p', '#directions').text(ins).fadeIn(500);
	}

	function moveToTab(tabIndex){
		//	Update the colors on Ptr circles and tabs, then jump to the appropriate tab
		$('.fundingPanelPtr').each(function(index){
				$(this).removeClass('activeColorBackground');	// change the circle color of all Ptr circles
				$('.forTabProcessing').eq(index).removeClass('activeColorBackground').removeClass('ui-state-focus')
									  .css({'backgroundColor': defaultColor});
		});
		$('.fundingPanelPtr').eq(tabIndex).addClass('activeColorBackground');			// change circle color

		$('.forTabProcessing').eq(tabIndex).addClass('activeColorBackground')			//	Update the tab colors
								 .css({'backgroundColor': activeColor})
								 .children().css({'color' : '#fff'});					// for letter coloring

		//	Display the div used along with the tab to show tab content
		$( "#fundingRequestTab" ).tabs( "option", "selected", tabIndex );				// go to the specified tab

		sayIt(tabIndex);
	}

	//	set up the tabs
	$( "#fundingRequestTab" ).tabs();				//	fundingRequestTab are used in controlTablet

	$('.fundingRequestTab').hover(function(){
		$(this).addClass('highlightColorBackground');
	}, function(){
		$(this).removeClass('highlightColorBackground');
	});

	$('#ccc, #CurrencyType, #DollarSymbol, #EuroSymbol').toggle(function() {
			//console.log($(this).parent().attr('id')+ ' toggle EURO');
			$('#CurrencyType').css('backgroundPosition', '0px -60px');
			$('#EuroSymbol').css('display', 'block');
			$('#DollarSymbol').css('display', 'none');
			Currency = 'EURO';
	}, function(){
			//console.log($(this).parent().attr('id')+ ' toggle USD');
			$('#CurrencyType').css('backgroundPosition', '0 0');
			$('#EuroSymbol').css('display', 'none');
			$('#DollarSymbol').css('display', 'block');
			Currency = 'USD';
	});

	//**********************************************************************************//
	//																					//
	//	The tabs are each searched for errors in their fields.							//
	//	This is where the contents of that tab is checked for validity.					//
	//																					//
	//**********************************************************************************//

	function checkTab0ForErrors(){
		var xxx;

		//for every input or select, and trigger a blur() to see if errors are detected by blur script bound to the ID
		$('#Country').focus().delay(200).blur();
			$('#Country').select(); // needed to focus in order to blur the select box
		$('#fundingRequestContact input').each(function(i) {
			xxx = $(this).attr('id');
			//alert('Tab 0: checking validity of field: '+xxx);
			$('#'+xxx).trigger('blur'); //cause a blur of the field to trigger the routine bound to it
		});

		activeTab = 0;
		moveToTab(activeTab);		//	show user the tab's errors

	}

	//moving away from the second tab....

	function checkTab1ForErrors(){
		var xxx;

		//for every input or select, and trigger a blur() to see if errors are detected by blur script bound to the ID
		$('#Category').focus().delay(200).blur();
			$('#Category').select(); // needed to focus in order to blur the select box
		$('#fundingRequestCategory input').each(function(i) {
			xxx = $(this).attr('id');
			//alert('Tab 1: checking validity of field: '+xxx);
			$('#'+xxx).trigger('blur'); //cause a blur of the field to trigger the routine bound to it
		});

		activeTab = 1;
		moveToTab(activeTab);		//	show user the tab's errors
	}

	//moving away from the third tab....

	function checkTab2ForErrors(){
		var xxx;

		Comments = $('#Comments').val();
		if (Comments === '')
		{
			$('#CommentsError').css("color",  'red').css("backgroundColor", 'yellow');
			$('#Comments').addClass('Error');
		}
		else{
			$('#CommentsError').css("color",  '#ddd').css("backgroundColor", '#ddd');
			$('#Comments').removeClass('Error');
		}

		Captcha = $('#Captcha').val();
		if (Captcha === '')
		{
			$('#CaptchaError').css("color",  'red').css("backgroundColor", 'yellow');
			$('#Captcha').addClass('Error');
		}
		else{
			$('#CaptchaError').css("color",  '#ddd').css("backgroundColor", '#ddd');
			$('#Captcha').removeClass('Error');
		}

		activeTab = 2;
		moveToTab(activeTab);		//	show user the tab's errors
	}

	//*****disable the Enter key ********
	$('select, input').live('keydown', function(e) {
		var keyCode = e.keyCode || e.which;
		//console.log('keycode pressed: '+keyCode+' on field: '+$(this).attr('id'));

		if (keyCode === 9)		//	was this a tab key?
		{
			//	this code is to gracefully switch from tab 0 to tab 1 if tabbed into it
			if ($(this).attr('id') === 'Email') { //this is last field on tab 0
				e.preventDefault();
				checkTab0ForErrors();
				activeTab = 1;
				moveToTab(activeTab);
				$('#Category').focus();
			}
			//	this code is to gracefully switch to tab 2 if tabbed into it
			if ($(this).attr('id') === 'LengthBox'){
				e.preventDefault();
				checkTab1ForErrors();
				activeTab = 2;
				moveToTab(activeTab);
				$('#Comments').select();
			}

			//	this code is to gracefully switch to tab 0 if tabbed into it
			if ($(this).attr('id') === 'Captcha'){
				e.preventDefault();
				checkTab1ForErrors();
				activeTab = 0;
				moveToTab(activeTab);
				$('#FullName').select();
			}
		}

		return (keyCode === 13) ? false : true;
	});

	//***********************************


	$('#FullName').blur(function() {
		FullName = $('#FullName').val();
		writeCookie('FullName', FullName);
		if (FullName.length === 0){
			$('#FullNameError').css("color",  'red').css("backgroundColor", 'yellow');
			$('#FullName').addClass('Error');
		}
		else{
			$('#FullNameError').css("color",  '#ddd').css("backgroundColor", '#ddd');
			$('#FullName').removeClass('Error');
		}
	});

	$('#Phone').blur(function() {
		Phone = $('#Phone').val();
		writeCookie('Phone', Phone);
		if (Phone.length === 0) {
			$('#PhoneError').css("color",  'red').css("backgroundColor", 'yellow');
			$('#Phone').addClass('Error');
		}
		else{
			$('#PhoneError').css("color",  '#ddd').css("backgroundColor", '#ddd');
			$('#Phone').removeClass('Error');
		}
	});

	$('#Country').blur(function(e) {
		Country		= $('#Country option:selected').val();
		writeCookie('Country', Country);
		if(Country === "Select"){
			$('#CountryError').css("color",  'red').css("backgroundColor", 'yellow');
			$('#Country').addClass('Error');
		}else{
			$('#CountryError').css("color",  '#ddd').css("backgroundColor", '#ddd');
			$('#Country').removeClass('Error');
		}
	});

	$('#Email').blur(function() {
		Email	= $('#Email').val();
		writeCookie('Email', Email);
		if (Email.length === 0){
			$('#EmailFormatError').css("margin-top", '0').css("color", '#ddd').css("backgroundColor", '#ddd');
			$('#EmailError').css("margin-top", '0').css("color", 'red').css("backgroundColor", 'yellow');
			$('#Email').addClass('Error');
		}
		else
		{
			$('#EmailError').css("margin-top", '0').css("color", '#ddd').css("backgroundColor", '#ddd');
			if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(Email)){		// if invalid format
				$('#EmailFormatError').css("margin-top", '-24px').css("color", '#ddd').css("backgroundColor", '#ddd');
				$('#Email').removeClass('Error');
		}else{
				$('#EmailFormatError').css("margin-top", '-24px').css("color", 'red').css("backgroundColor", 'yellow');
				$('#Email').addClass('Error');
			}
		}
	});

	// for fields in tab 2
	// when the Category field was blurred...

	$('#Category').blur(function(e) {
		Category = $('#Category option:selected').val();
		writeCookie('Category', Category);
		if(Category === "Select"){
			$('#CategoryError').css("color",  'red').css("backgroundColor", 'yellow');
			$('#Category').addClass('Error');
		}else{
			$('#CategoryError').css("color",  '#ddd').css("backgroundColor", '#ddd');
			$('#Category').removeClass('Error');
		}
	});

	$('#Amount').blur(function() {
		Amount = parseInt($('#Amount').val().split(' ').join(''));
		if (Amount < 1000000) {
			$('#AmountError').css("color",  'red').css("backgroundColor", 'yellow');
			$('#Amount').addClass('Error');
		}
		else{
			$('#AmountError').css("color",  '#ddd').css("backgroundColor", '#ddd');
			$('#Amount').removeClass('Error');
		}
	});

	//here is the click logic for Swift type buttons

	$('.sw-button').click(function(e){
		$('.sw-button').each(function(i){
			$(this).removeClass('checked');
		});
		$(this).addClass('checked');
	});

	//	For the fields in the third tab

	// This code is to expand and restore the Comments textarea in the form
	$('#Comments').dblclick(function(){
		//ExpandedComments, ExpandedCommentsP, and ExpandedCommentsText are all specified in the include/top.php file
		$('#ExpandedComments').css('backgroundColor', defaultColor).css('display', 'block');
		$('#ExpandedCommentsText').val($('#Comments').val());
		document.getElementById('ExpandedCommentsText').focus();
	});
	$('#ExpandedComments').dblclick(function(){
		//ExpandedComments, ExpandedCommentsP, and ExpandedCommentsText are all in the include/top.php file
		$('#ExpandedComments').css('display', 'none');
		$('#Comments').val($('#ExpandedCommentsText').val());
		document.getElementById('Comments').focus();
	});


	function createRandomEquation(){
		//return a random integers between 0 and 10
		arg0 = parseInt((Math.floor(Math.random()*100)).toFixed(0));
		argx = parseInt((Math.floor(Math.random()*11)).toFixed(0));
		arg2 = parseInt((Math.floor(Math.random()*11)).toFixed(0));
		//alert('numbers are '+ arg0 + ' ' + argx + ' ' + arg2);
		if (argx > 5){
			arg1 = ' + ';
			Scode = arg0 + arg2;
		}
		else{
			arg1 = ' - ';
			if (arg0 < arg2){
				var arg4 = arg0;
				arg0 = arg2;
				arg2 = arg4;
			}
			Scode = arg0 - arg2;
		}
		var s = arg0 + arg1 + arg2;

		$('#Equation').text(s);
	}

	createRandomEquation();

	$('#Captcha').blur(function() {
		var Captcha = $('#Captcha').val();				//	value of field on page

		if (Captcha.length === 0)						//	if nothing was entered by user
		{
			$('#CaptchaCopyError').css({"margin-top": '0', "color": '#ddd', "backgroundColor": '#ddd'});
			$('#Captcha').removeClass('Error');
			$('#CaptchaError').css({"margin-top": '0', "color": 'red', "backgroundColor": 'yellow'});
			$('#Captcha').addClass('Error');
		}
		else
		{								//	if something was entered, then the only error could be an non-equal code
			$('#CaptchaError').css({"margin-top": '0',"color": '#ddd', "backgroundColor": '#ddd'});
			$('#Captcha').removeClass('Error');
			if(Scode !== parseInt(Captcha)){
				$('#CaptchaCopyError').css({"margin-top": '-24px',"color": 'red',"backgroundColor": 'yellow'});
				$('#Captcha').addClass('Error');
			}else{
				$('#CaptchaCopyError').css({"margin-top": '-24px',"color": '#ddd', "backgroundColor": '#ddd'});
				$('#Captcha').removeClass('Error');
			}
		}

		return false; //must tell caller we're done with checking
	});


	$('button').addClass('activeColorBackground');		//	make all buttons active colored

	$('button').hover(function(){
		$(this).addClass('highlightColorBackground');
	}, function(){
		$(this).removeClass('highlightColorBackground');
	});

	$('#SendRequestButton').click(function(e) {
		var vv, stat, ph, MyData, errors;
		//When button is clicked prevent form submission by default.
		e.preventDefault();

		// now look at each error message and determine if the display css attribute is set to block or none
		// if any field is display:block then don't leave tab

		activeTab = 2;
		checkTab2ForErrors();		// check for errors on this tab

		activeTab = 1;
		checkTab1ForErrors();

		activeTab = 0;
		checkTab0ForErrors();

		moveToTab(activeTab);
		activeTab=2;

		// has everything been filled in?
		errors='';

		if ((Comments === undefined) || (Comments === "")){
			errors += "Project Details field is blank\n\r";
			activeTab = 2;
		}
		if ((Captcha === "") || (Scode !== parseInt(Captcha))){
			errors += "Human being verification field is invalid\n\r";
			activeTab = 2;
		}
		if ((Category === undefined) || (Category === "Select") || (Category === "")){
			errors += "Request field must be chosen\n\r";
			activeTab = 1;
		}
		if ((FullName === undefined) || (FullName === '')){
			errors += "Name field is blank\n\r";
			activeTab = 0;
		}
		if ((Phone === undefined) || (Phone === "")){
			errors += "Phone field is blank\n\r";
			activeTab = 0;
		}
		if ((Country === undefined) || (Country === "Select") || (Country === "")){
			errors += "Country field must be chosen\n\r";
			activeTab = 0;
		}
		if ((Email === undefined) || (Email === "")){
			errors += "Email field is blank\n\r";
			activeTab = 0;
		}
		else
			if ($('#Email').hasClass('Error') === true){
				errors += "Email field is invalid\n\r";
				activeTab = 0;
			}

		if ((errors === "") && ($('#Comments').hasClass('Error') === false)
		 && ($('#Captcha').hasClass('Error') === false)
		 && ($('#Category').hasClass('Error') === false)
		 && ($('#FullName').hasClass('Error') === false)
		 && ($('#Phone').hasClass('Error') === false)
		 && ($('#Country').hasClass('Error') === false)
		 && ($('#Email').hasClass('Error') === false))
		{
			$('#SendRequestBox').remove(); 				//	hide the button to prevent repeated send requests

			$('.sw-button').each(function(i){			//	determine which Swift Type is checked
				vv = $(this).attr('id');
				stat = $(this).hasClass('checked');
				if(stat === true){
					SwiftType = vv;
				}
			});

			FullName		= $('input[name=FullName]').val();
			ph				= $('input[name=Phone]').val();
			var pattern = /(\d{3})(\d{3})(\d{4})/;
			if(ph.length === 10){
				Phone=ph.replace(pattern, "$1.$2.$3");
			}
			else{
				Phone=ph;
			}
			Country		= $('#Country option:selected').val();
			Category	= $('#Category option:selected').val();
			Comments	= $('#Comments').val();
			Skype		= $('#Skype').val();
			Email		= $('#Email').val();
			Amount		= $('#Amount').val();
			LengthBox	= $('#LengthBox').val();
			Captcha		= $('#Captcha').val();
			//alert(Captcha);
			//organize the form data properly
			MyData = 'Category=' + Category + '&Amount=' + Amount +
			'&Currency=' + Currency + '&Months=' + LengthBox+
			'&Swift=' + SwiftType + '&FullName=' + encodeURIComponent(FullName) +
			'&Phone=' + encodeURIComponent(Phone) + '&Skype=' + Skype +
			'&Country=' + Country + '&Email=' + Email +
			'&Captcha=' + Captcha + '&arg0=' + arg0 + '&arg1=' + encodeURIComponent(arg1) + '&arg2=' + arg2 +
			'&Comments=' + encodeURIComponent(Comments);
			//alert(MyData)

			$.get('FundingRequestAction.php', MyData, function(data){
				$('#Return').html(data);

				if(data === '1'){
					window.location='FundingRequestSent.php';
				}
			});
		} // end no errors === true
		else{
			alert(errors);
			moveToTab(activeTab);
		}
	}); //end click on SendRequest button

	// start over on tab 0 after fields are cleared
	$('#CancelRequestButton').click(function(e) {
		activeTab = 0;
		moveToTab(activeTab);
	});

	//**************************************************************************//
	//																			//
	//		Here is where we alter the default definitions from ProntoCommon.js	//
	//		so that funding requests will get done correctly.					//
	//																			//
	//**************************************************************************//

	var formWidth=475;

	//	the css has left:-999px so the this animate will slide the div to the right on page
	$('#controlTablet').animate({'left': '240px'}, 1000, 'easeOutCirc');

	$('.pauseResume').remove();  //delete selectors from DOM and their bound events
	$('#carouselControls').remove();  //delete selectors from DOM and their bound events

	//console.log('tabControls at left:20');
	totalTabs = $('li', '.ui-tabs-nav').size();

	$('li', '.ui-tabs-nav').each(function(index){					// for each tab...
		$('#pointers').append("<div class='fundingPanelPtr' id='pointer"+index+"'>"+(index+1)+"</div>");
		$('li', '#fundingRequestTab').eq(index).addClass('forTabProcessing');
		xxx = $('.forTabProcessing').eq(index).text();						// Get text of each tab and put on title or coorespondinding ptr
		$('#pointer'+index).addClass('defaultColorBackground').attr('title', 'Fill in \''+ xxx+'\' information');
		$('.forTabProcessing').eq(index).addClass('defaultColorBackground').css({'backgroundImage' : 'none', 'borderColor' : activeColor});
		$('.forTabProcessing').eq(index).children().css({'color' : '#fff'});	// for tab letter coloring
		$('.controlsDiv').eq(index).css({'backgroundColor': '#ddd'});	// for tab's body color
	});

	// nextTab is the button with a right triangle before the circles on page
	$('#nextTab').click(function(){
		if(activeTab === 0){	// needed because if last tab was 0, it has Country field, a <select> field
			$('#Country').focus().delay(200).blur();					// and this highlights the field as being an error
		}
		activeTab=$('#pointers').children('.activeColorBackground').index();
		activeTab++;	//	add 1 to the index number
		if (activeTab >= totalTabs)
			activeTab = 0;

		moveToTab(activeTab);
		if(activeTab === 1)	// needed because the 1st field on tab 1 (the second tab) is a <select> field
			$('#Category').focus();
	});

	$('.fundingPanelPtr').hover(function(){
		$(this).addClass('highlightColorBackground');
	}, function(){
		$(this).removeClass('highlightColorBackground');
	});

	//	if a Ptr (one of the circles) is clicked directly
	$('.fundingPanelPtr').click(function(){
		if(activeTab === 0){	// needed because if last tab was 0, it has Country field, a <select> field
			$('#Country').focus().delay(200).blur();					// and this highlights the field as being an error
		}
		activeTab = parseInt($(this).attr('id').substr(7));	//	get the index number

		moveToTab(activeTab);
		if(activeTab === 1)	// needed because the 1st field on tab 1 is a <select> field
			$('#Category').focus();
	});

	$('#fundingRequestTab a').hover(function(){
		//console.log('hover on fundingRequestTab');
		$(this).addClass('highlightColorBackground');
	}, function(){
		//console.log('hover off fundingRequestTab');
		$(this).removeClass('highlightColorBackground');
	});

		//	If a tab itself is clicked ...
	$('#fundingRequestTab a').click(function(){
		if(activeTab === 0){	// needed because if last tab was 0, it has Country field, a <select> field
			$('#Country').focus().delay(200).blur();					// and this highlights the field as being an error
		}
		activeTab = $(this).parent().index();		// get the index of the li element clicked.
		moveToTab(activeTab);
		if(activeTab === 1)	// needed because the 1st field on tab 1 is a <select> field
			$('#Category').focus();
	});

	$('.ui-state-default').css({'backgroundColor': defaultColor, 'backgroundImage': 'none'});
	$('.ui-tabs-selected').css({'backgroundColor': activeColor, 'backgroundImage': 'none'});

	$('#pointer0').addClass('activeColorBackground'); 			// first tab by default is active at start
	sayIt(0);

	$('#FullName').focus();

}); // end jquery
