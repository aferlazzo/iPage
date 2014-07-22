<?php if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html> 
<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
 
	<title>Amount Slider - jQuery UI Slider Demo</title> 
	<!-- a custom UA api has to be created on the jquery page:	http://jqueryui.com/download/ -->
	<link type="text/css" href="css/smoothness/jquery-ui-1.8.custom.css" rel="stylesheet" />	
	<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script> 
	<script type="text/javascript" src="js/jquery-ui-1.8.custom.min.js"></script> 
	<script type="text/javascript"> 

	var slide_int = null;

			$(function(){	
			$('#FormTabs').tabs();
			$(".tabs-bottom .ui-tabs-nav, .tabs-bottom .ui-tabs-nav > *") 
			.removeClass("ui-corner-all ui-corner-top") 
			.addClass("ui-corner-bottom");
		
			//bind the first tab Next button to the tab 2
			var $tabs = $('#FormTabs').tabs(); 	// the first tab in FormTabs div selected
			$('#n0').click(function() {		// bind click event to link
				$tabs.tabs('select', 1); 	// switch to  tab 2
				return false;
			});
		
			//bind the second tab Next button to the tab 3
			$('#n1').click(function() {		// bind click event to link
				$tabs.tabs('select', 2); 	// switch to  tab 3
				return false;
			});
			
			//bind the second tab Previous button to the tab 1
			$('#p0').click(function() {		// bind click event to link
				$tabs.tabs('select', 0); 	// switch to  tab 1
				return false;
			});

			//bind the third tab Previous button to the tab 2
			$('#p1').click(function() {		// bind click event to link
				$tabs.tabs('select', 1); 	// switch to  tab 2
				return false;
			});
			
			$('#slider').slider({
				animate: true,
				step: 1000000,
				range: "min",
				min: 1000000,
				orientation: 'horizontal',
				max: 500000000,
				start: function(event, ui){
					$('#current_value').empty();
					slide_int = setInterval(UpdateAmtTextBox, 20);	
				},
				slide: function(event, ui){
					setTimeout(UpdateAmtTextBox, 20);  
				},
				stop: function(event, ui){
					clearInterval(slide_int);
				    slide_int = null;
				}
			});	
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
function UpdateAmtTextBox() {
    var offset = $('.ui-slider-handle').offset();
    var value = $('#slider').slider('option', 'value');
	
	value = formatNumber(value,0,' ','','','','-','');
	
    //$('#current_value').text("Amount is "+value+" Million").css({top:offset.top });
	
	document.getElementById('Amount').value=value;
	$('#Amount').fadeIn();
}
//when Amount textbox is updated, remove non-numerics and update slider
function amountTypedIn(amt)
{
	// make slider's value equal to amount typed in
	
	//first remove any nonnumerics
	var pattern = /[^0-9]/g;
	amt = amt.replace(pattern, "");
	$('#slider').slider('value', amt);
	document.getElementById("Amount").value = formatNumber(amt,0,' ','','','','-','');
	document.getElementById("slider").value = amt;
}


	</script> 
	<style type="text/css"> 
		#wrap{
			width:600px;
			height:400px;
			margin:5px auto;
			padding:10px;
			border:1px solid silver;
			min-height:400px;
		}

		#slider{
			width:560px;
			height:8px;
			margin:5px 0;
			padding:0;
			background:yellow; /* base color */
		}
		#current_value{
			margin-left:25px;
			width:180px;
			/*position:absolute;*/
			padding:4px;
			display:hidden;
		}
		#FormTabs{
			font-size:12px;
			height:200px;
		}

		.tabs-bottom { position: relative; } 
		.tabs-bottom .ui-tabs-panel { height: 140px; overflow: auto; } 
		.tabs-bottom .ui-tabs-nav { position: absolute !important; left: 0; bottom: 0; right:0; padding: 0 0.2em 0.2em 0; } 
		.tabs-bottom .ui-tabs-nav li { margin-top: -2px !important; margin-bottom: 1px !important; border-top: none; border-bottom-width: 1px; }
		.ui-tabs-selected { margin-top: -3px !important; }

#slider .ui-slider-range { background: #009900; }	
#slider .ui-slider-handle { background: silver; border:1px solid #000;}
#slider a:active {background:red;} /* range's color */
	</style> 
</head> 
 
<body>
	<div id="wrap"> 
		<div id="FormTabs" class='tabs-bottom'> 
			<ul> 
				<li><a href="#FormTabs-1">Your Need</a></li> 
				<li><a href="#FormTabs-2">To Reach You</a></li> 
				<li><a href="#FormTabs-3">Objective</a></li> 
			</ul> 
			<div id="FormTabs-1">
				<h3>Move the slider around to pick the amount</h3> 
				<form id='ff'>
					<label for='Amount'>Amount</label>
					<input type='text' style='text-align:right;' name='Amount' id='Amount' onchange='amountTypedIn(this.value);'>

					<div id="slider"></div> 
					<input type='button' id='n0' value='Next'>
			</div> 
			<div id="FormTabs-2">Phasellus mattis tincidunt nibh. Cras orci urna, blandit id, pretium vel, aliquet ornare, felis. Maecenas scelerisque sem non nisl. Fusce sed lorem in enim dictum bibendum.
				<input type='button' id='p0' value='Previous'>
				<input type='button' id='n1' value='Next'>
			</div> 
			<div id="FormTabs-3">
				<input type='button' id='p1' value='Previous'>
				</form>
			</div> 
		</div> 	
	</div>
</body> 
</html> 