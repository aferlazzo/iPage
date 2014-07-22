<?php if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <title>
      slider test
    </title>
<!-- from include("include/Head.php"); -->
<script type="text/javascript" src="http://www.google.com/jsapi?key=ABQIAAAAFhI-zWC1OHnIWn-NgpM59RQEvnDN41A_YXsu9RDCiPeB95ezzhRg9hvePm9aPDvoXLeCm7abWSWrHws">
</script>
<script type="text/javascript">
google.load("jquery", "1.4.2");
google.load("jqueryui", "1.8.1");
</script>
<!-- a custom UA api has to be created on the jquery page:                              http://jqueryui.com/download/ -->
<link type="text/css" href="./css/smoothness/jquery-ui-1.8.custom.css" rel="stylesheet">
<!--<script src="./js/jquery.validate.min.js" type="text/javascript"></script>-->
<script src='./js/slidertest.js' type="text/javascript"></script>
<style type="text/css">
div#AmountBox {
position:absolute;left:55px;top:130px;
}
div#amountSlider{
position:absolute;left:55px;top:175px;
}
div#LengthHead {
position:absolute;left:55px;top:230px;
}
div#lengthSlider {
position:absolute;left:55px;top:270px;
}
	/* specifies dealing with the sliders themselves */

    div#amountSlider {background:#6d6;}     /* this is the base, the right side, of the slider */
    div#amountSlider .ui-slider-range {		/* this is the (left side) background fill color of the slider */
	background:#090;}
	
	div#amountSlider .ui-slider-handle {
	background:#0e0;
	z-index:2;
	width:10px;
	height:20px;
	}
    div#amountSlider .ui-state-active{           /* active part is the handle when click and held */
	background:#ff0;
	} 
	
    div#lengthSlider {background:#66b;}     /* this is the (right side) plain background fill color of the slider */
    div#lengthSlider .ui-slider-range {
	background:#008;}						/* this is the (left side) background fill color of the slider */

    div#lengthSlider .ui-slider-handle {    /* the handle must be on z-index higher than tic marks or tic marks show through */
    background:#00e;
	z-index:2;
	width:10px;
	height:20px;
	}            
    div#lengthSlider .ui-state-active{           /* active part is the handle when click and held */
	background:#f00;
	} 
	
    .ui-slider-horizontal {					/* height of the slider graphic */
    height:12px;
	}
    span.ui-slider-tic {					/* for tic marks */
    position: absolute;
    z-index:1;								/* assuming the slider graphic is a z-index 0, we must be on a plane above the background color to show tics */
    left: 0;
    width:0;								/* width of tic mark */
    height:11px;							/* height of tic mark inside slider graphic */
    top:-29px;								/* distance above the ordered list (ol) spans we add below*/
    }
    </style>
</head>
<body>

		<div id='AmountBox'>
			<label for='Amount'>Amount</label>
			<input type="text" value='$300 000 000' name="Amount" id="Amount" class='RequestField' maxlength="50" tabindex="10" style='text-align:right;width:135px;' onfocus="this.style.border='2px solid #00f'" onblur="this.style.border='1px solid silver'">
		</div>
		<div id="amountSlider"></div>
		<div id='LengthHead'>
			<label for='LengthBox'>Length</label>
			<input type='text' value='12' name="LengthBox" id="LengthBox" class='RequestField' style='text-align:right;width:20px;'> Months
		</div>
		<div id="lengthSlider"></div>

</body>
</html>
