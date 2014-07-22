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
			var select = $("#Amount");
			var slider = $("<div id='slider'></div>").insertAfter(select).slider({
				animate: true,
				step: 1,
				range: "min",
				min: 1,
				orientation: 'vertical',
				max: 500,
				start: function(event, ui){
					$('#current_value').empty();
					slide_int = setInterval(update_slider, 10);	
				},
				slide: function(event, ui){
					select[0].selectedIndex = ui.value - 1;
				},
				stop: function(event, ui){
					clearInterval(slide_int);
				    slide_int = null;
				}
			});
			$("#Amount").click(function() {
				slider.slider("value", this.value);			
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
		
function update_slider() {
    var offset = $('.ui-slider-handle').offset();
    var value = $('#slider').slider('option', 'value');
	
	value = formatNumber(value,0,' ','','','','-','');
	
    $('#current_value').text("Amount is "+value+" 000 000").css({top:offset.top });
    $('#current_value').fadeIn();
}
	</script> 
	<style type="text/css"> 
		#wrap{
			width:400px;
			height:450px;
			margin:5px auto;
			padding:10px;
			border:1px solid silver;
		}

		#slider{
			float:left;
			height:300px;
			margin:4px;
		}
		#current_value{
			float:left;
			margin-top:150px;
			height:300px;
			width:200px;
			/* position:absolute; to have literal remain next to slider tool */
			padding:4px;
		}

#slider .ui-slider-range { background: #009900; }	
#slider .ui-slider-handle { background: silver; border:1px solid #000;}
#slider a:active {background:red;}
	</style> 
</head> 
 
<body class="ui-widget-content">
	<div id="wrap"> 
		<h2>Amount Slide Bar</h2> 
		<h3>Move the slider around to pick the amount<br>(1 000 000 minimum, 1 000 increments)</h3> 
		<form id='frmFundingRequest'>
			<input type='text' name='Amount' id='Amount'>
			<div id="current_value"></div> 
		</form>
	</div> 
</body> 
</html> 