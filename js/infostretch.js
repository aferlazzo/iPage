$(document).ready(function(){
	initiate_geolocation();

	$('#fetch').click(function(){
		$('#test').text(''); // clear last city's weather
		$('#test').weatherfeed([$('#woeid').val()],{'unit':'f','image':false,'link':false,'wind':false, 'highlow':false });
	});

	// just a test
	//$('#test').weatherfeed(['UKXX0085'],{'unit':'f','image':false,'link':false,'wind':false, 'highlow':false });

	$('input').live("keypress", function(e) {
	            /* ENTER PRESSED*/
	            if (e.keyCode == 13) {
	                /* FOCUS ELEMENT idx is index of field in form */
	                var inputs = $(this).parents("form").eq(0).find(":input:visible");
	                var idx = inputs.index(this);
	
	                if (idx == inputs.length - 1) {
	                    inputs[0].select();
	                } else {
	                    inputs[idx + 1].focus(); //  handles submit button
	                    inputs[idx + 1].select();
	                }
	                return false; // ignore Enter key
	            }
	        });

});


function initiate_geolocation() {
	navigator.geolocation.getCurrentPosition(handle_geolocation_query,handle_errors);
}

function handle_errors(error) { 
	switch(error.code)
	{
		case error.PERMISSION_DENIED: alert("user did not share geolocation data");
		break;

		case error.POSITION_UNAVAILABLE: alert("could not detect current position");
		break;

		case error.TIMEOUT: alert("retrieving position timed out");
		break;

		default: alert("unknown error");
		break;
	}
}

function handle_geolocation_query(position){
	$('#myLatitude').text(position.coords.latitude);
	$('#myLongitude').text(position.coords.longitude);
	//alert('Lat: ' + position.coords.latitude + ' Lon: ' + position.coords.longitude);
}
