

	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -+
	//															|
	// 		 swingLikeaHinge									|
	//															|
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -+

	function swingLikeaHinge(theHeading, direction){
		var degrees=0, intervalID;

		function slowlyPivot(){
			//console.log('slowly() Pivoting #Head to '+degrees+' degrees');

			$(theHeading).css({ '-moz-transform': 'rotate('+degrees+'deg)',			// Pivot 90 degrees counter-clockwise
							 '-webkit-transform': 'rotate('+degrees+'deg)',
								  '-o-transform': 'rotate('+degrees+'deg)',
								 '-ms-transform': 'rotate('+degrees+'deg)'});

			if (direction === 'down'){
				if (degrees <= -90){
					clearInterval(intervalID);
				}else{
					degrees--;
				}
			}else{
				if (degrees >= 0){
					clearInterval(intervalID);
				}else{
					degrees++;
				}
			}
		}

		if (direction === 'up')
			degrees = -90;

		intervalID = setInterval(slowlyPivot, 15);		// execute the slowlyPivot function every 15 mSeconds
	}


					swingLikeaHinge('#Head', 'down');

					swingLikeaHinge('#Head', 'up');
