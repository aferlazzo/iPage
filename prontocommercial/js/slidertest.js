		var currencySymbol = "$"; // we start with currency symbol $ and the USD button having class='ui-state-active'

		$(document).ready(function(){
		/* set up the Amount and Length sliders */
			var aInterval = null;
			$('#amountSlider').slider({
				animate: true,
				step: 1000000,
				range: "min",
				min: 1000000,
				orientation: 'horizontal',
				max: 500000000,
				value: 300000000,
				start: function(event, ui){
					$('#current_value').empty();
					aInterval = setInterval(UpdateAmtTextBox, 1);	
				},
				slide: function(event, ui){
					setTimeout(UpdateAmtTextBox, 1);  
				},
				stop: function(event, ui){
					clearInterval(aInterval);
				    aInterval = null;
				}
			});	
			
			var lInterval = null;
			$('#lengthSlider').slider({
				animate: true,
				step: 1,
				range: "min",
				min: 1,
				value: 12,
				orientation: 'horizontal',
				max: 15,
				start: function(event, ui){
					$('#LengthBox').empty();
					lInterval = setInterval(UpdateLengthBox, 10);	
				},
				slide: function(event, ui){
					setTimeout(UpdateLengthBox, 10);  
				},
				stop: function(event, ui){
					clearInterval(lInterval);
				    lInterval = null;
				}	
			});
			
			//link the Amount textbox changes to the amountSlider
			$('#Amount').change(function(e) {
				var amt=document.getElementById('Amount').value;
				amountTypedIn(amt);
				e.preventDefault();
			});
			
			//link the Length textbox changes to the lengthSlider
			$('#LengthBox').change(function(e) {
				var amt=document.getElementById('LengthBox').value;
				lengthTypedIn(amt);
				e.preventDefault();
			});
	
			//link the USD button to putting the '$' symbol in the Amount box
			$('#USD').click(function(e) {
				Currency = 'USD';
				$('#USD').show( "pulsate", "fast" );
				currencySymbol = '$';
				UpdateAmtTextBox();
				e.preventDefault();
			});
				
			//link the EURO button 
			$('#EURO').click(function(e) {
				Currency = 'USD';
				currencySymbol = '\u20ac';
				$('#EURO').show( "pulsate", "fast" );
				UpdateAmtTextBox();
				e.preventDefault();
			});
		
		var sliderWidth= $('#amountSlider').css('width');  	//length of amountSlider in px
		sliderWidth = '600px';								//adjust width
		$('#amountSlider').css('width', sliderWidth);
		var digitpattern=/\d+/;  							//just give me the digits in the exec (the regular expression
		var sliderEnd = digitpattern.exec(sliderWidth);
		var sliderMiddle = sliderEnd/2;						//these are the 3 labels we'll add
		var sStartLabel  = '$1,000,000';
		var sMiddleLabel = '$250,000,000';
		var sEndLabel    = '$500,000,000';

		var numberOfTicMarks = 50;							// 50 tics should be sufficient without being too crowded
		var tic = new Array(numberOfTicMarks);				// this creates an array with 50 elements
		var ticOffset = sliderEnd / (numberOfTicMarks - 1);
		for(i=0; i<=numberOfTicMarks; i++)					// and fills the table with the x-location of each tic mark
			tic[i] = i * ticOffset;

		//create an order list <ol> just beneath the slider graphic (inside the <div> element tic mark headers
		//put the horizontal list of <li> elements that will hold the labels 
		$('#amountSlider').append('<ol class="amountSliderScale ui-slider" style="position:relative;font-size:10px;">\n'+
		'<li class="sStart"  style="position:absolute;left:0;">'+sStartLabel+'</li>\n'+
		'<li class="sMiddle" style="position:absolute;left:'+ parseInt(sliderMiddle - 40) + 'px;">'+sMiddleLabel+'</li>\n'+
		'<li class="sEnd"    style="position:absolute;right:0;">'+sEndLabel+'</li></ol>\n');
		
		//now set the style attributes for amountSliderScale ol below the slider graphic
		$('.amountSliderScale').css('list-style-type','none').css('margin','28px 0 0 0').css('padding', 0).css('width', sliderWidth);
		$('.amountSliderScale li').css('display', 'inline');  //make sure the amountSliderScale ol li's are on one horizontal line
		
		var sliderBorderColor = $('.ui-slider').css('borderRightColor');	//use the same color for the tic marks as the slider
		// now add the spans for actual lengthTic marks
		for(i=1; i<numberOfTicMarks - 1; i++)
			$('.amountSliderScale').find('.sStart').prepend('<span class="ui-slider-tic ui-widget-content" style="left:'+tic[i]+'px;background:'+sliderBorderColor+';"></span>\n');
	
	//---------------------------------------------------------------------------------------------
	
		var lengthWidth  = $('#lengthSlider').css('width');  		//length of lengthSlider in px
		lengthWidth = '400px';
		$('#lengthSlider').css('width', lengthWidth);
		var lengthEnd    = digitpattern.exec(lengthWidth);

		numberOfTicMarks = 15;										// for the 15 months in the lengthSlider scale 
		var lengthTic = new Array(numberOfTicMarks);  				// this creates an array with 15 elements
		ticOffset = lengthEnd / Math.round(numberOfTicMarks - 1);	// the array describes the tic mark offsets
		for(i=0; i<=numberOfTicMarks; i++)							// and fills the table with the x-location of each tic mark
			lengthTic[i] = i * ticOffset;
			
		//create an order list <ol> just beneath the slider graphic (inside the <div> element tic mark headers
		$('#lengthSlider').append('<ol class="lengthSliderScale ui-slider" style="position:relative;font-size:10px;">\n');
		//put the horizontal list of <li> elements that will hold the labels (the numbers 1-15)
		$('.lengthSliderScale').append('<li class="lStart" style="position:absolute;left:0;">1</li>\n');

		for(i=1; i<numberOfTicMarks; i++)
			$('.lengthSliderScale').append('<li style="position:absolute;left:'+ eval(lengthTic[i] - (i / 2)) + 'px;">'+ eval(1 + i) +'</li>\n');	
		$('.lengthSliderScale').append('</ol>\n');
		
		//now set the style attributes for lengthSliderScale ol below the slider graphic
		$('.lengthSliderScale').css('list-style-type','none').css('margin','28px 0 0 0').css('padding', 0).css('width', lengthWidth);
		$('.lengthSliderScale li').css('display', 'inline');  //this makes the lengthSliderScale ol li's to be displayed on one horizontal line
		// now add the spans for actual lengthTic marks
		for(i=1; i<numberOfTicMarks - 1; i++)
			$('.lengthSliderScale').find('.lStart').prepend('<span class="ui-slider-tic ui-widget-content" style="left:'+lengthTic[i]+'px;background:'+sliderBorderColor+';width:.01px;"></span>\n');
	});	

/*
let's say that we want to display the number with no decimal places using 
spaces for thousands separators (a common international standard) and a 
period for the decimal point. It is a monetary value but we don't know if 
it is euros or USD so we'll leave the currency indicators blank. If the 
number is negative we'll keep the - on the front. If our number field is 
mynum then we would just replace the reference to mynum that is displaying 
with the following to display our formatted version.

formatNumber(mynum,0,' ','.','','','-','')
*/		
function formatNumber(num,dec,thou,pnt,curr1,curr2,n1,n2) {
var x = Math.round(num * Math.pow(10,dec));
if (x >= 0) n1=n2='';
var y = (''+Math.abs(x)).split('');
var z = y.length - dec;
 if (z<0) z--;
 for(var i = z;
 i < 0;
 i++) y.unshift('0');
 if (z<0) z = 1;
 y.splice(z, 0, pnt);
 if(y[0] == pnt) y.unshift('0');
 while (z > 3) {z-=3;
 y.splice(z,0,thou);
}var r = curr1+n1+y.join('')+n2+curr2;
return r;
}
//when the slider is moved change the amount in the textbox		
function UpdateLengthBox() {
    var offset = $('#lengthSlider .ui-slider-handle').offset();
    var value = $('#lengthSlider').slider('option', 'value');
	
    //$('#current_value').text(value).css({top:offset.top });
	
	document.getElementById('LengthBox').value=value;
}
//when the slider is moved change the amount in the textbox		
function UpdateAmtTextBox() {
    var value = $('#amountSlider').slider('option', 'value');
	value = formatNumber(value,0,' ','',currencySymbol,'','-','');
	document.getElementById('Amount').value=value;
}
//when Amount textbox is updated, remove non-numerics and update slider
function amountTypedIn(amt)
{
	// make slider's value equal to amount typed in
	//first remove any non-numerics
	var pattern = /[^0-9]/g;
	amt = amt.replace(pattern, "");
	$('#slider').slider('value', amt);
	(amt < 1000000)  ? amt=1000000 : amt=amt;
	(amt > 500000000) ? amt=500000000 : amt=amt;
	document.getElementById("Amount").value = formatNumber(amt,0,' ','',currencySymbol,'','-','');
	$('#amountSlider').slider('option', 'value', amt);
	UpdateAmtTextBox(); 	//we call this in case an out of range number was entered
}
// make lengthSlider's value equal to length typed in
function lengthTypedIn(amt)
{
	//first remove any non-numerics
	var pattern = /[^0-9]/g;
	amt = amt.replace(pattern, "");
	(amt < 1)  ? amt=1 : amt=amt;
	(amt > 15) ? amt=15 : amt=amt;
	$('#lengthSlider').slider('option', 'value', amt);
	UpdateLengthBox(); //we call this in case an out of range number was entered
}