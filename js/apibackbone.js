$(document).ready(function(){

	var currentTime	= new Date(),
		month = currentTime.getMonth() + 1,
		day= currentTime.getDate(),
		year  = currentTime.getFullYear(),
		minD  = month + "/" + day + "/" + year,
		tripDateType = 'depart'; // 'depart or return',

	// initialize window width information
	
	(function(){
			var w, x = $(window).width();   // returns width of browser viewport
			$('.returnedDataWrapper').width(w);   // returns width of browser viewport
	})();
	

		
	
	//TripDate Model is really just a date in the format mm/dd/yyyy, greater than or equal to today's date
	//----------------
	
	var TripDate = Backbone.Model.extend({
		defaults: {
			minD	: minD
		}
	});
	

	//The TripDateView listens for changes to its model, re-rendering. Since there's a one-to-one correspondence 
	//between a TripDate and a TripDateView in this app, we set a direct reference on the model for convenience.
	
	//TripDate View, a jquery datepicker calendar
	//-------------------

	var TripDateView = Backbone.View.extend({
		
		//The TripDateView listens for changes to its model, re-rendering. Since there's a one-to-one 
		//correspondence between a TripDate and a TripDateView in this app, we set a direct reference on the model for convenience.


		initialize: function(){
			var myField = tripDateType === 'depart' ? '#departDate' : '#returnDate';
			
			if (tripDateType === 'depart') {
				$("#departDateCalendar").datepicker({
										minDate:minD,  
										autosize:true,
										dateFormat:'mm/dd/yy',
										gotoCurrent: true,
										altField: myField  });
				this.model.bind('change', this.render, this);
			}else{
				$("#returnDateCalendar").datepicker({
										minDate:minD,  
										autosize:true,
										dateFormat:'mm/dd/yy',
										gotoCurrent: true,
										altField: myField  });
				this.model.bind('change', this.render, this);
			}
		},
		

		render: function() {
			if (tripDateType === 'depart or return') {
				alert('type uninitialized');
			}
			
			if (tripDateType === 'depart') {
			
				$("#departDateCalendar").datepicker({
										minDate:minD,  
										autosize:true,
										dateFormat:'mm/dd/yy',
										gotoCurrent: true,
										altField: '#departDate'  });
			}else{
				$("#returnDateCalendar").datepicker({
										minDate:minD,  
										autosize:true,
										dateFormat:'mm/dd/yy',
										gotoCurrent: true,
										altField: '#returnDate'  });
			}
		}
	});
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	// The datepicker has control of the calendar. CSS class dateField is either CSS id departDate or returnDate
	// which refer to the two date fields in the input form.
	
	// When a date is entered
	
	$('.dateField').blur(function(){
		var myField = tripDateType === 'depart' ? '#departDate' : '#returnDate',
			saapDepartDate = $(myField).val(),
			saapReturnDate = $(myField).val(),
			dArray = saapDepartDate.split('/'),
			dmm = dArray[0],
			ddd = dArray[1], maxDays,
			dyyyy = dArray[2],
			days = [0,31,28,31,30,31,30,31,31,30,31,30,31],
			trimmedDate;
		
		$.trim(dmm);
		$.trim(ddd);
		$.trim(dyyyy);
		trimmedDate = dmm + '/' + ddd + '/' + dyyyy;
		$(myField).val(trimmedDate);
		

		if (dyyyy % 4 === 0){	// leap year
			days[2] = 29;
		}

		// if the date field blurred is blank, take no action
		
		if (((myField === 'depart') && (saapDepartDate === '')) ||  ((myField === 'return') && (saapReturnDate === ''))) {
			return;
		}

		if (dArray.length !== 3){
			alert('Please key-in a valid date (mm/dd/yyyy)');
			$(myField).val('');
			$(myField).focus();
		}

		// correct month and day fields if there are any leading spaces
	
		if(dmm < 10){
			if(dmm[0] !== 0){
				dmm[1] = dmm[0];
				dmm[0] = 0;
			}
		}
		
		if (ddd < 10){
			if(ddd[0] !== 0){
				ddd[1] = ddd[0];
				ddd[0] = 0;
			}
		}
		
		// make sure the day and month fields are within valid ranges
		maxDays = days[parseInt(dmm, 10)];
		if (typeof maxDays === 'undefined'){
			maxDays = 0;
		}
			
		if (ddd > maxDays || ddd < 1 || dmm > 12){
			alert('Please choose a valid date (mm/dd/yyyy)');
			$('#departDate').focus();
		}else{
			if (myField === '#departDate'){
				$("#departDateCalendar").datepicker( "setDate" , saapDepartDate ); // update the calendar
			}else{
				$("#returnDateCalendar").datepicker( "setDate" , saapReturnDate ); // update the calendar
			}
		}	
	});

	
	
	// returned data from askForDestinationInfo
	
	function showDestinationInfo(obj){
		var i, nearby='';
		
		if (obj === "No data found"){
			console.log('City not in database');
		} else {
			$('#CityName').text(obj.LocationData.CityName);
			$('#AirportCode').text(obj.LocationData.AirportCode);
			$('#LocationDesc').text(obj.LocationData.LocationDesc);
			
			for (i = 0; i < obj.LocationData.NearbyAirports.length; i++){
				nearby += obj.LocationData.NearbyAirports;	// = []
				if (i > 0 && i < (obj.LocationData.NearbyAirports.length - 1)){
					nearby += ', ';
				}
			}
			$('#NearbyAirports').text(nearby);
			$('#FlightFareForecast').attr('href', obj.Links.FlightFareForecast.Link_usage);
			$('#FlightFareRange').attr('href', obj.Links.FlightFareRange.Link_usage);
			$('#Flights').attr('href', obj.Links.Flights.Link_usage);
			$('#Hotels').attr('href', obj.Links.Hotels.Link_usage);
			$('#Insight').attr('href', obj.Links.Insight.Link_usage);
			$('#Latitude').text(obj.LocationData.Position.Latitude);
			$('#Longitude').text(obj.LocationData.Position.Longitude);
			$('.UrlData').css('display', 'inline');
		}
	}
	
	
	// When the Destination URL button is pressed...
	
	function askForDestinationInfo(saapOrigin, saapDestination, saapDepartDate, saapReturnDate){
		// http://165.225.129.113:8090/api/1.0.0/destinations/SFO?api_key=546869732069732074686520496e666f53747265746368204b6579		

		var destinationUrlData = '',
			sendUrl='http://165.225.129.113:8090/api/1.0.0/destinations/',
			sendUri = 'api_key=546869732069732074686520496e666f53747265746368204b6579',
			jqxhdr;
		
		sendUrl += saapDestination;					
		
		console.log('askForDestinationInfo call');
		
		jqxhdr = $.get(sendUrl, sendUri, function(returnedData, textStatus){

			destinationUrlData = returnedData;
			console.log("text status: " + textStatus);
	
			if(returnedData === 'No data found'){
				alert(returnedData + ' for destination: ' + saapDestination);
				return;
			}
			
			showDestinationInfo(destinationUrlData);			// this will list several objects
		})
		.error(function() { console.log("askForDestinationInfo Ajax error"); });
	}
	
	
	
	
	
	
	
	

	
	
	// returned data from askForHotelList
	// iterate through returned hotels to display
	
	function showHotelList(properties, api_key, startdate, enddate){
		var generatedHtml='', hotelUrl='', hotelURI='', avg, phone='', phn='', i, x, city, hotel;
		
		for(x=0; x < properties.length; x++) {
			hotelUrl  = 'http://165.225.129.113:8090/api/1.0.0/destinations/';
			hotelUrl += properties[x].HotelCityCode + '/hotels/' + properties[x].HotelCode;

			hotelURI  = 'api_key=' + api_key + '&startdate=' + startdate + '&enddate=' + enddate;

generatedHtml += '<li id="hotel' +x + 'Wrapper"><ul>';		
			generatedHtml += '<li><span class="hotelDetail" id="hotel' + x + '" hotel="' + properties[x].HotelCode + '" city="' + properties[x].HotelCityCode + '">' + properties[x].HotelName + '</span></li>';

			
			//generatedHtml += '<li>Hotel Code: '	+ properties[x].HotelCode + '</li>';
			generatedHtml += '<li>'	+ properties[x].Address.AddressLine + '</li>';
			generatedHtml += '<li>'	+ properties[x].Address.City + ', ';
			generatedHtml += properties[x].Address.StateProv + ' ';
			generatedHtml += properties[x].Address.ZipCode + '</li>';
			
			phone = properties[x].ContactNumbers.ContactNumber.PhoneNumber;
			if (phone[0] === 1){
				phn = '1.';
				i = 1;
			}else{
				phn = '';
				i = 0;
			}
			phn += phone.substr(i,3) + '.';
			i += 3;
			phn += phone.substr(i,3) + '.';
			i += 3;
			phn += phone.substr(i,4);
			
			generatedHtml += '<li><br>Phone: '		+ phn + '</li>';

			//generatedHtml += '<li>Latitude: '	+ properties[x].Position.Latitude;
			//generatedHtml += ' Longitude: '	+ properties[x].Position.Longitude + '</li>';
			if (properties[x].RateRange){
				avg = properties[x].RateRange.AvgRate;
				avg = Math.round(parseFloat(avg, 10) * 100) / 100;
				
				generatedHtml += '<li><br>Avg Rate: $'	+ avg.toFixed(2) + '</li>';
				generatedHtml += '<li>Max Rate: $'	+ properties[x].RateRange.MaxRate + '</li>';
				generatedHtml += '<li>Min Rate: $'	+ properties[x].RateRange.MinRate + '<br>&nbsp;</li>';
			}else{
				generatedHtml += '<li><br>Call for rates<br>&nbsp;</li>';
			}
generatedHtml += '</ul></li>';
		}

		$('#hotelsDiv ul').html(generatedHtml);
			
		// An event handler cannot be attached to elements that do not yet exist in the DOM,
		// so we must define the click handler here.

		for(x=0; x < properties.length; x++) {
			hotelId = '#hotel'+x;
			//alert($(hotelId).attr('city'));
			$(hotelId).on('click', {hotelId: hotelId}, function(event){
				event.preventDefault();
				//console.log("Defining jquery anchor handler for "+ event.data.hotelId);
				var city  = $(event.data.hotelId).attr('city');
				var hotel = $(event.data.hotelId).attr('hotel');
				//console.log('depart date: ' + startdate);
				//console.log('return date: ' + enddate); 
				//console.log('city code: '   + city);
				//console.log('hotel code: '  + hotel);
				
				askForHotelDetails(startdate, enddate, city, hotel);
			});
		}

/*
	$('.hotelDetail').each(function() {
		console.log("setting up jquery anchor handler for hotelDetail");
		$(this).on('click', function(e){
			e.preventDefault();
			alert('jquery \'hotel detail\' link was clicked (within each loop)');
			console.log("jquery anchor handler for hotelDetail (within each loop)");
			askForHotelDetails(departDate, returnDate, hotelCityCode, hotelCode);
		});
	});
*/
	


	}
	
	
	// Display hotel details when they are returned
	
	function showHotelDetails(details){	
		if (details.OTA_HotelAvailRS.Errors){
			alert(details.OTA_HotelAvailRS.Errors.Error[0].Code + '\n\r' + details.OTA_HotelAvailRS.Errors.Error[0].$t);
		}else{
			var generatedHtml, i,
			
				HotelCityCode	= details.OTA_HotelAvailRS.RoomStays.RoomStay.BasicPropertyInfo.HotelCityCode,
				HotelCode		= details.OTA_HotelAvailRS.RoomStays.RoomStay.BasicPropertyInfo.HotelCode,
				HotelName		= details.OTA_HotelAvailRS.RoomStays.RoomStay.BasicPropertyInfo.HotelName,

				Services		= details.OTA_HotelAvailRS.RoomStays.RoomStay.BasicPropertyInfo.Services.Service,
				

				Address			= details.OTA_HotelAvailRS.RoomStays.RoomStay.BasicPropertyInfo.Address.AddressLine,
				City			= details.OTA_HotelAvailRS.RoomStays.RoomStay.BasicPropertyInfo.Address.CityName,
				State			= details.OTA_HotelAvailRS.RoomStays.RoomStay.BasicPropertyInfo.Address.StateProv.StateCode,
				ZipCode			= details.OTA_HotelAvailRS.RoomStays.RoomStay.BasicPropertyInfo.Address.PostalCode;
			
			generatedHtml  = '<li>' + HotelName + '</li>';	
			/*
			generatedHtml += '<li>Hotel Code: '	+ HotelCode + '</li>';
			generatedHtml += '<li><br>'	+ Address + '</li>';
			generatedHtml += '<li>'	+ City + ', ';
			generatedHtml += State + ' ';
			generatedHtml += ZipCode + '</li>';
			*/
			generatedHtml += '<li><br><b>Hotel Services</b><br> </li>';
			
			for(i = 0; i < Services.length; i++){
				generatedHtml += '<li>&#8226;  ' + Services[i].CodeDetail + '</li>';
			}


			$('#hotelDiv ul').html(generatedHtml);
		}
	}
	
	
	
	// When the Hotel details are requested...
	
	function askForHotelDetails(departDate, returnDate, hotelCityCode, hotelCode){
	//http://165.225.129.113:8090/api/1.0.0/destinations/SFO/hotels?api_key=546869732069732074686520496e666f53747265746368204b6579&startdate=2012-04-26&enddate=2012-04-30&pagenumber=3&pagesize=25

		var destinationHotelsData = '', jqxhdr,
			sendUri, sendUrl='http://165.225.129.113:8090/api/1.0.0/destinations/',
			api_key = '546869732069732074686520496e666f53747265746368204b6579';

		// click test -----------------------------
/*		
		departDate = '2012-05-05';
		returnDate = '2012-05-11';
		hotelCityCode = 'las';
		hotelCode=36802; // doubletree club by Hilton
*/	
		// ----------------------------------
		
		sendUrl += hotelCityCode + '/hotels/' + hotelCode;
		
		sendUri  = 'api_key=' + api_key + '&startdate=' + departDate + '&enddate=' + returnDate;
		sendUri += '&pagenumber=3&pagesize=25';		

		
		// LOCAL SERVER testing 
		
		//sendUrl='apiServer.php';
		//sendUri = 'apitype=hotels&api_key='+api_key,

		

		
		
					
		console.log('askForHotelDetails call: ' + sendUrl + '?' + sendUri);

		jqxhdr = $.getJSON(sendUrl, sendUri, function(returnedData, textStatus){
			destinationHotelData = returnedData;			
			console.log("text status: " + textStatus);
			
			if(returnedData === 'No hotels found. Please change the search criteria.'){
				alert("Couldn't find a match for the chosen destination for the spacified date range.");
				console.log("Couldn't find a match for the chosen destination for the spacified date range.");
				console.log(sendUrl+'?'+sendUri);
				return;
			}
			
			destinationHotelDetails = returnedData;
						
			//console.log("complete. destinationUrlData: " + destinationHotelDetails);

			showHotelDetails(destinationHotelDetails);
		})
		.error(function() { console.log("askForHotelList error"); });
	}
	
	
	// When the Hotel List button is pressed...
	
	function askForHotelList(saapOrigin, saapDestination, saapDepartDate, saapReturnDate){
	//http://165.225.129.113:8090/api/1.0.0/destinations/SFO/hotels?api_key=546869732069732074686520496e666f53747265746368204b6579&startdate=2012-04-26&enddate=2012-04-30&pagenumber=3&pagesize=25

		var destinationHotelsData = '', jqxhdr,
			sendUrl='http://165.225.129.113:8090/api/1.0.0/destinations/',
			api_key = '546869732069732074686520496e666f53747265746368204b6579';
		
		sendUrl += saapDestination;					
		sendUrl += '/hotels';

		var	sendUri = 'api_key='+api_key;
		sendUri += '&startdate='+saapDepartDate;
		sendUri += '&enddate='+saapReturnDate;
		sendUri += '&pagenumber=3&pagesize=25';
		
		
		// for testing
		//sendUrl='apiServer.php';
		//sendUri = 'apitype=hotels&api_key='+api_key,

					
		console.log('askForHotelList call: ' + sendUrl + '?' + sendUri);

		jqxhdr = $.getJSON(sendUrl, sendUri, function(returnedData, textStatus){
			destinationHotelData = returnedData;			
			console.log("text status: " + textStatus);
			
			if(returnedData === 'No hotels found. Please change the search criteria.'){
				alert("Couldn't find any hotels for the chosen destination for the spacified date range.");
				console.log("Couldn't find any hotels for the chosen destination for the spacified date range.");
				console.log(sendUrl+'?'+sendUri);
				return;
			}
			
			destinationHotelsData = returnedData.MTX_HotelSearchRS.Properties.Property;
						
			//console.log("complete. destinationUrlData: " + destinationHotelsData);

			showHotelList(destinationHotelsData, api_key, saapDepartDate, saapReturnDate);
		})
		.error(function() { console.log("askForHotelDetails error"); });
	}
	
	
	
	
	$('#hotelSlider').bxSlider({
		mode: 'vertical'
	});
	
	
	// takes input from page and returns an object
	
	var formInput = function(entered){
		entered.saapOrigin = $('#origin').val();
		entered.saapDestination = $('#destination').val();

		entered.saapDepartDate = $('#departDate').val();
		entered.saapReturnDate = $('#returnDate').val();

		entered.dmm = entered.saapDepartDate.substr(0,2);
		entered.ddd = entered.saapDepartDate.substr(3,2);
		entered.dyyyy = entered.saapDepartDate.substr(6,4);

		entered.rmm = entered.saapReturnDate.substr(0,2);
		entered.rdd = entered.saapReturnDate.substr(3,2);
		entered.ryyyy = entered.saapReturnDate.substr(6,4);

		return entered;
	}

	
	// When the Hotel Detail Button is clicked
	
	$('#hotelDetail').click(function(e){
		e.preventDefault();
		console.log('hotel Detail button clicked');
		askForHotelDetails('2012-05-05', '2012-05-11', 'las', 36802);
	});
	
	
	
	// Edits input when builds the URL when 'Destination Info' button is clicked

	$('#destinationInfo').click(function(){
		var entered = {};
		entered =	{
						saapOrigin: '',
						saapDestination: '',
						saapDepartDate: '',
						saapReturnDate: '',
						dmm: '',
						ddd: '',
						dyyyy: '',
						rmm: '',
						rdd: '',
						ryyyy: ''
					};
		entered = formInput(entered);
			
		//console.log(' depart: '+ (dyyyy+dmm+ddd) + 'return: '+(ryyyy+rmm+rdd) );
		if ((entered.ryyyy + entered.rmm + entered.rdd) < (entered.dyyyy + entered.dmm + entered.ddd)){
			alert('return date is before depart date');
		}else{
			if(entered.saapDestination === '' || entered.saapOrigin === ''){
				alert('origin and destination must be specified');
			}else{
				entered.saapDestination = entered.saapDestination.toUpperCase();
				/*
				if ((entered.saapDestination !== 'SFO')
				&&  (entered.saapDestination !== 'LAS')
				&&  (entered.saapDestination !== 'LAX')) {
					alert('hotel data is only available for SFO, LAS, and LAX');
				}else{
				*/
				askForDestinationInfo(entered.saapOrigin, entered.saapDestination, entered.dyyyy + '-' + entered.dmm + '-' + entered.ddd, entered.ryyyy + '-' + entered.rmm + '-' + entered.rdd);
			}
		}			
	});
	



	// Edits input when builds the URL when 'Hotel List' button is pressed

	$('#hotelList').click(function(){
		var entered = {};
		entered =	{
						saapOrigin: '',
						saapDestination: '',
						saapDepartDate: '',
						saapReturnDate: '',
						dmm: '',
						ddd: '',
						dyyyy: '',
						rmm: '',
						rdd: '',
						ryyyy: ''
					};
		entered = formInput(entered);
			
		//console.log(' depart: '+ (dyyyy+dmm+ddd) + 'return: '+(ryyyy+rmm+rdd) );
		if ((entered.ryyyy + entered.rmm + entered.rdd) < (entered.dyyyy + entered.dmm + entered.ddd)){
			alert('return date is before depart date');
		}else{
			if(entered.saapDestination === '' || entered.saapOrigin === ''){
				alert('origin and destination must be specified');
			}else{
				entered.saapDestination = entered.saapDestination.toUpperCase();
				/*
				if ((entered.saapDestination !== 'SFO')
				&&	(entered.saapDestination !== 'LAS')
				&&	(entered.saapDestination !== 'LAX'))	{
					alert('hotel data is only available for SFO, LAS, and LAX');
				}else{
				*/
				askForHotelList(entered.saapOrigin, entered.saapDestination, entered.dyyyy + '-' + entered.dmm + '-' + entered.ddd, entered.ryyyy + '-' + entered.rmm + '-' + entered.rdd);
			}
		}			
	});
	
	// display the Depart Calendar
	
	var DDate = new TripDateView({model: TripDate});

	// display the Depart Calendar

	tripDateType = 'return';
	var RDate = new TripDateView({model: TripDate});
});
