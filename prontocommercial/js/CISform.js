var cisForm = {
	FullName: "",
	Phone:  "",
	Country: "",
	Email: "",
	Category: "",
	Principal: "",
	Passport: "",
	Expiration: "",
	DOB: "",
	Address: "",
	City: "",
	State: "",
	Phone1: "",
	Phone2: "",
	BankName: "",
	BankAddress: "",
	Swift: "",
	OfficerName: "",
	bPhone: "",
	bFax: "",
	beName: "",
	AccountNumber: "",
	Routing: "",
	AccountName: "",
	AccountSignatory: "",
	cStructure: "",
	cName: "",
	cType: "",
	cAddress: "",
	cCity: "",
	cState: "",
	cCountry: "",
	cPhone: "",
	cFax: "",
	pIncorp: "",
	dIncorp: "",
	ID: "",
	Amount: "",
	Term: "",
	DesiredClose: "",
	DesiredBank: "",
	instrumentUse: "",
	MessageType: "",
	Top25: "",
	MyData: "",
	Request: "",
	activeTab: 0,
	totalTabs: 0,
	xxx: ""
};


	var checkS = function (Applicant) {
		if (Applicant==="Corporation"){
			$('.corp').css('display', 'inline');
		}else{
			$('.corp').css('display', 'none');
		}

		if (Applicant==="Individual"){
			$('.nin').css('display', 'inline');
		}else{
			$('.nin').css('display', 'none');
		}
	}

	var checkM = function (Type) {
		//alert('MT: '+Type);
		if (Type === "None"){
			$('.mt').css('display', 'none');
		}else{
			$('.mt').css('display', 'inline');
		}
	}

var writeCookie = function (cookieName, cookieValue){
		document.cookie=cookieName+"="+cookieValue+"; expires=Wednesday, 01-Aug-2040 08:00:00 GMT";
};

var readCookie = function (cookieName) {
		var index, countbegin, countend;
		if(document.cookie) {
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
		return;
};




	//------------------------------------------------------------------
	//AJAX stuff: if submit the form within the CISform.php is clicked
	//------------------------------------------------------------------

	$('#Principal').val(readCookie('FullName'));

	$('#Principal').blur(function() {
		cisForm.Principal	= $.trim($('#Principal').val());
		writeCookie('FullName', cisForm.FullName);
	});


	$('#Phone').val(readCookie('Phone'));

	$('#Phone').blur(function() {
		writeCookie('Phone', cisForm.Phone);
	});

	$('#Country, #cCountry').val(readCookie('Country'));

	$('#Country').blur(function() {
		cisForm.Country	= $.trim($('#Country').find('option:selected').text());
		writeCookie('Country', cisForm.Country);
	});


	$('#Email').val(readCookie('Email'));

	$('#Email').blur(function() {
		writeCookie('Email', cisForm.Email);
	});

	$('#Email').val(readCookie('Email'));

	$('#Email').blur(function() {
		cisForm.Email	= $.trim($('#Email').val());
		writeCookie('Email', cisForm.Email);
	});


	$('#Category').val(readCookie('Category'));

	$('#Category').blur(function() {
		cisForm.Category	= $.trim($('#Category').find('option:selected').text());
		writeCookie('Category', cisForm.Category);
	});


	$('#cisSendRequestButton').click(function(e) {
		e.preventDefault();

		cisForm.Principal					= $('#Principal').val();
		cisForm.Phone						= $('#Phone').val();
		cisForm.Passport					= $('#Passport').val();
		cisForm.Expiration				= $('#Expiration').val();
		cisForm.DOB						= $('#DOB').val();
		cisForm.Address					= $('#Address').val();
		cisForm.City							= $('#City').val();
		cisForm.State						= $('#State').val();
		cisForm.Country					= $('#Country option:selected').val();
		cisForm.Phone1					= $('#Phone1').val();
		cisForm.Phone2					= $('#Phone2').val();
		cisForm.Email						= $('#Email').val();
		cisForm.BankName				= $('#BankName').val();
		cisForm.BankAddress			= $('#BankAddress').val();
		cisForm.Swift						= $('#Swift').val();
		cisForm.OfficerName			= $('#OfficerName').val();
		cisForm.bPhone					= $('#bPhone').val();
		cisForm.bFax						= $('#bFax').val();
		cisForm.beName					= $('#beName').val();
		cisForm.AccountNumber		= $('#AccountNumber').val();
		cisForm.Routing					= $('#Routing').val();
		cisForm.AccountName			= $('#AccountName').val();
		cisForm.AccountSignatory	= $('#AccountSignatory').val();
		cisForm.cStructure				= $('#cStructure option:selected').val();
		cisForm.cName					= $('#cName').val();
		cisForm.cType						= $('#cType').val();
		cisForm.cAddress				= $('#cAddress').val();
		cisForm.cCity						= $('#cCity').val();
		cisForm.cState						= $('#cState').val();
		cisForm.cCountry					= $('#cCountry option:selected').val();
		cisForm.cPhone					= $('#cPhone').val();
		cisForm.cFax						= $('#cFax').val();
		cisForm.pIncorp					= $('#pIncorp').val();
		cisForm.dIncorp					= $('#dIncorp').val();
		cisForm.ID							= $('#ID').val();
		cisForm.Category					= $('#Category option:selected').val();
		cisForm.Amount					= $('#Amount').val();
		cisForm.Term						= $('#Term').val();
		cisForm.DesiredClose			= $('#DesiredClose').val();
		cisForm.DesiredBank			= $('#DesiredBank').val();
		cisForm.instrumentUse		= $('textarea[name=instrumentUse]').val();

		cisForm.MessageType='???';
		if($('.MessageType').eq(0).attr('checked')){
			cisForm.MessageType = 'none';}
		if($('.MessageType').eq(1).attr('checked')){
			cisForm.MessageType = 'MT-799';}
		if($('.MessageType').eq(2).attr('checked')){
			cisForm.MessageType = 'MT-760';}
		//alert(cisForm.MessageType);

		cisForm.Top25='???';
		if($('.Top25').eq(0).attr('checked')){
			cisForm.Top25 = 'Yes';}
		if($('.Top25').eq(1).attr('checked')){
			cisForm.Top25 = 'No';}
		//alert(cisForm.Top25);

		//organize the form data properly
		cisForm.MyData =
		'&Principal=' 				+ cisForm.Principal +
		'&Phone=' 				+ cisForm.Phone +
		'&Passport=' 				+ cisForm.Passport +
		'&Expiration=' 			+ cisForm.Expiration +
		'&DOB=' 					+ cisForm.DOB +
		'&Address=' 				+ cisForm.Address +
		'&City=' 					+ cisForm.City +
		'&State=' 					+ cisForm.State +
		'&Country='				+ cisForm.Country +
		'&Phone1='				+ cisForm.Phone1 +
		'&Phone2='				+ cisForm.Phone2 +
		'&Email=' 					+ cisForm.Email +
		'&BankName=' 			+ cisForm.BankName +
		'&BankAddress=' 		+ cisForm.BankAddress +
		'&Swift=' 					+ cisForm.Swift +
		'&OfficerName=' 			+ cisForm.OfficerName +
		'&bPhone='				+ cisForm.bPhone +
		'&bFax=' 					+ cisForm.bFax +
		'&beName=' 				+ cisForm.beName +
		'&AccountNumber=' 	+ cisForm.AccountNumber +
		'&Routing=' 				+ cisForm.Routing +
		'&AccountName=' 		+ cisForm.AccountName +
		'&AccountSignatory='	+ 	cisForm.AccountSignatory +
		'&cStructure='			+ cisForm.cStructure +
		'&cName=' 				+ cisForm.cName +
		'&cType=' 					+ cisForm.cType +
		'&cAddress='				+ cisForm.cAddress +
		'&cCity='					+ cisForm.cCity +
		'&cState=' 					+ cisForm.cState +
		'&cCountry=' 				+ cisForm.cCountry +
		'&cPhone=' 				+ cisForm.cPhone +
		'&cFax=' 					+ cisForm.cFax +
		'&pIncorp='				+ cisForm.pIncorp +
		'&dIncorp=' 				+ cisForm.dIncorp +
		'&ID=' 						+ cisForm.ID +
		'&Category=' 				+ cisForm.Category +
		'&Amount=' 				+ cisForm.Amount +
		'&Term=' 					+ cisForm.Term +
		'&DesiredClose='		+ cisForm.DesiredClose +
		'&Top25=' 				+ cisForm.Top25 +
		'&DesiredBank=' 		+ cisForm.DesiredBank +
		'&MessageType=' 		+ cisForm.MessageType +
		'&instrumentUse=' 		+ cisForm.instrumentUse;

		$.post("CISformAction.php", cisForm.MyData, function(data){
			//alert("Data Loaded: " + data);

			if(data === '1'){
				location.href='CISdocuments.php';
			}else{
				$('#cisFormReturn').html(data);
			}
		});
	}); //end click on SendRequest button

	function sayIt(tabIndex){
		var ins;
		switch(tabIndex)
		{
			case 0:	ins = "<p>We need to have some information about you. Please complete all sections by clicking on each tab.</p><p>In this case, the 'Contact' is the person who will be signing the contact and who has authority to complete the transaction.<p>";
					break;
			case 1: ins = "<p>If you are requesting the request on behalf of an organization please complete this portion. Otherwise you may leave it blank.<p>";
					break;
			case 2:	ins = "<p>Thank you for spending the time and effort to provide us with the many details answers. Your effort will be rewarded when we deliver the product the meets your needs.<p>";
					break;
			case 3:	ins = "<p>Your bank information is needed so that the loan or instrument can be delivered to you. If your request is for a Proof of Funds account then we will send you the bank information for the account.<p>";
					break;
			case 4:	ins = "<p>Provide a detailed description of how you will be using the account or bank instrument in the space provided. Provide ALL necessary information including payment and delivery plans.<p><p>We will make every effort to provide a solution that meets your needs, so we want to understand exactly what you need and dates or deadlines you require.</p>";
					break;
			default: ins = "Well, this is rather embarrassing...I'm lost!";
					break;
		}

		$('#directions').css('display', 'none').html("<h1>Client<br/>Information<br/>Sheet</h1>"+ins).fadeIn(1500);
	}

	// updates the tab and ptr circle colors
	function moveToTab(tabIndex){
		//	Update the Ptr colors
		$('.cisPanelPtr').each(function(index){
				$(this).removeClass('activeColorBackground');	// change the circle color of all Ptr circles
				$('.forTabProcessing').eq(index).removeClass('activeColorBackground').removeClass('ui-state-focus')
									  .css({'backgroundColor': DEFAULTCOLOR});
		});
		$('.cisPanelPtr').eq(tabIndex).addClass('activeColorBackground');			// change circle color

		$('.forTabProcessing').eq(tabIndex).addClass('activeColorBackground')				//	Update the tab colors
								 .css({'backgroundColor': ACTIVECOLOR})
								 .children().css({'color' : '#fff'}); // for letter coloring

		//	Display the div used along with the tab to show tab content
		//$('#cisTabs > div').addClass('ui-tabs-hide');		//	hide all the child divs associated with #cisTabs
		//$('#cisTabs > div').eq(tabIndex).removeClass('ui-tabs-hide');
		$( "#cisTabs" ).tabs( "option", "selected", tabIndex );				// go to the specified tab

		sayIt(tabIndex);
	}

	//	At script load this is executed

	$( "#cisTabs" ).tabs();					//	cisTabs are used in controlTablet

	//	the css has left:-999px so the this animate will slide the div to the right on page
	$('#controlTablet').animate({'left': '240px'}, 1000, 'easeOutCirc');

	//$('.pauseResume').remove();  //delete selectors from DOM and their bound events
	$('#carouselControls').remove();  //delete selectors from DOM and their bound events

	cisForm.totalTabs = $('li', '.ui-tabs-nav').size();

	$('li', '.ui-tabs-nav').each(function(index){					// for each tab...
		$('#pointers').append("<div class='cisPanelPtr' id='pointer"+index+"'>"+(index+1)+"</div>");
		$('li', '#cisTabs').eq(index).addClass('forTabProcessing');
		cisForm.xxx = $('.forTabProcessing').eq(index).text();						// Get text of each tab and put on title or coorespondinding ptr
		$('#pointer'+index).addClass('defaultColorBackground').attr('title', 'Fill in \''+ cisForm.xxx+'\' information');
		$('.forTabProcessing').eq(index).addClass('defaultColorBackground').css({'backgroundImage' : 'none', 'borderColor' : ACTIVECOLOR});
		$('.forTabProcessing').eq(index).children().css({'color' : '#fff'});	// for tab letter coloring
		$('.controlsDiv').eq(index).css('backgroundColor', '#ddd');	// for tab's body color
	});

	// nextTab is the button with a right triangle before the circles on page
	$('#nextTab').click(function(){
		cisForm.activeTab = parseInt($('#pointers').children('.activeColorBackground').index(), 10);
		cisForm.activeTab = cisForm.activeTab + 1;
		if (cisForm.activeTab >= cisForm.totalTabs) {
			cisForm.activeTab = 0;
		}

		moveToTab(cisForm.activeTab);
	});



	$('.cisPanelPtr').hover(function(){
		$(this).addClass('highlightColorBackground');
	}, function(){
		$(this).removeClass('highlightColorBackground');
	});

	//	if a cisPanelPtr is clicked directly
	$('.cisPanelPtr').click(function(){
		cisForm.activeTab = parseInt($(this).attr('id').substr(7), 10);	//	get the index number
		//console.log('ptr2 '+cisForm.activeTab+' clicked directly');

		//$('#cisTabs a').eq(cisForm.activeTab).click();
		moveToTab(cisForm.activeTab);
	});

	$('#cisTabs a').hover(function(){
		//console.log('hover on forTabProcessing');
		$(this).addClass('highlightColorBackground');
	}, function(){
		//console.log('hover off forTabProcessing');
		$(this).removeClass('highlightColorBackground');
	});

		//	If a tab is clicked ...
	$('#cisTabs a').click(function(){
		cisForm.activeTab = $(this).parent().index();		// get the index of the li element clicked.
		moveToTab(cisForm.activeTab);
	});



	$('.ui-state-default').css({'backgroundColor': DEFAULTCOLOR, 'backgroundImage': 'none'});
	$('.ui-tabs-selected').css({'backgroundColor': ACTIVECOLOR, 'backgroundImage': 'none'});

	$('.forTabProcessing').eq(0).addClass('activeColorBackground'); 	// first tab by default is active at start
	$('#pointer0').addClass('activeColorBackground'); 						// first circle pointer is active at start
	sayIt(0);

