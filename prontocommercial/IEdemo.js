	var headVertical = false;


$(document).ready(function(){


	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -+
	//															|
	// Because swingLikeaHinge is a callback function with		|
	// an argument it must be passed via a separate function	|
	//															|
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -+

	function swingLikeaHinge(theHeading){
		var h=0, intervalID, objWidth=parseInt($('#featureContainer').css('width'), 10),
			objHalfWidth = objWidth / 2;

		if (headVertical === false){
			headVertical = true;
			$(theHeading).animate({'transform': 'rotate(-90deg)', 'left': -225}, 'slow', 'easeOutSine', function(){
				$(theHeading).animate({'top': 460}, 800, 'easeOutBounce');		// slide down
			});
		}else{
			headVertical = false;
			$(theHeading).animate({'transform': 'rotate(0deg)', 'left': -225}, 'slow', 'easeOutSine', function(){
				$(theHeading).animate({'left': 200}, 800, 'easeOutBounce');		//slide back to the right
			});
		}
	}


	$('#word3').click(function(){	// if we click on the word 'Funding'
		//e.stopImmediatePropagation();		// stop other matching bound events from being triggered

			$('#absoluteWrapper').animate({'transform': 'rotate(-45deg)'}, 'slow', 'easeOutSine');
			$('#absoluteHead').animate({'left': -225}, 500, 'easeOutQuad', function(){	// move the char left
				swingLikeaHinge('#absoluteHead');
				$('#absoluteWrapper').animate({'transform': 'rotate(0deg)'}, 'slow', 'easeOutSine');

				$('#absoluteWrapper').delay(1000).animate({'transform': 'rotate(-45deg)'}, 'slow', 'easeOutSine', function(){
					$(this).animate({'transform': 'rotate(0deg)'}, 'slow', 'easeOutSine');
					$('#absoluteHead').animate({'left':-225, 'top': 0}, 'slow', 'easeOutBack');
					swingLikeaHinge('#absoluteHead');
				});
			});
	});

	$('#word2').click(function(){		// if we click on the word 'Commercial'
			$('#absoluteWrapper').animate({'transform': 'rotate(180deg)'}, 500, 'easeOutSine')
							.delay(1000).animate({'transform': 'rotate(0deg)'}, 500, 'easeOutSine');
	});

});   //end of jquery
