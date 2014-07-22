<!DOCTYPE html>
<html>
<head>
	<title>
	bump
	</title>
	<meta charset=utf-8>
	<link rel="SHORTCUT ICON" href="http://www.prontocommercial.com/favicon.ico">
	<?php include("include/head.php"); ?>
	<style>
		h4#test{text-align:left;font-size:28px;margin: 5px 0 5px 50px;white-space:nowrap;}
		.bump {display:block;position:absolute;width:250px;height:45px;top:52px;background-color:#fff;text-align:left;}
		#easeType {z-index:24;position:absolute;left:20px;top:300px;}
	</style>
</head>
<body>
<?php include("include/top.php"); ?>
			<h1>bump testing</h1>
			<div id='panelsContainer'>
				<div class='panel'>
					<div class='panelContent'>
						<h3>bump testing  <span id='iii'></span></h3>
						<h4 id='test'>Past Clients Know We Are Honest<span id='test1' class='bump'>Pay Attention</span><span id='test2' class='bump'>Have The Answers</span><span id='test3' class='bump'>Get the Job Done</span></h4>
						<h3 id='converge'></h3>
					</div>
				</div>
				<select id='easeType' name='easeType' size="1">
					<option value='easeInQuart'>easeInQuart</option>
					<option value='easeOutQuart'>easeOutQuart</option>
					<option value='easeInOutQuart'>easeInOutQuart</option>
					<option value='easeInQuint'>easeInQuint</option>
					<option value='easeOutQuint'>easeOutQuint</option>
					<option value='easeOutOutQuint'>easeInOutQuint</option>
					<option value='easeInCubic'>easeInCubic</option>
					<option value='easeOutCubic'>easeOutCubic</option>
					<option value='easeInOutCubic'>easeInOutCubic</option>
					<option value='easeInQuad'>easeInQuad</option>
					<option value='easeOutQuad'>easeOutQuad</option>
					<option value='easeInOutQuad'>easeInOutQuad</option>
					<option value='easeInSine'>easeInSine</option>
					<option value='easeOutSine'>easeOutSine</option>
					<option value='easeInOutSine'>easeInOutSine</option>
					<option value='easeInBounce'>easeInBounce</option>
					<option value='easeOutBounce'>easeOutBounce</option>
					<option value='easeInOutBounce' selected='selected'>easeInOutBounce</option>
					<option value='easeInExpo'>easeInExpo</option>
					<option value='easeOutExpo'>easeOutExpo</option>
					<option value='easeInOutExpo'>easeInOutExpo</option>
					<option value='easeInSine'>easeInSine</option>
					<option value='easeOutSine'>easeOutSine</option>
					<option value='swing'>swing</option>
					<option value='linear'>linear</option>
				</select>
			</div>
<?php include("./include/bottom.php"); ?>
<script>


	$(document).ready(function(){

		$('#pause').click();			//stop the page rotation

		// The effect will be to slide text1, 2, and 3 from the left (999px to 352px) into and on top of the tail end of
		// an initial text heading resulting in an animated text effect.

		function bumpIt(eee){
			$('#test1, #test2, #test3').css({'left': 999}).stop(true, true); // starting point of 'bumping' text
			$('#iii').text(eee);
			$('#test1').delay(1500).animate({'left': 352}, 400, eee, function(){
				$('#test2').delay(1500).animate({'left': 352}, 400, eee, function(){
					$('#test3').delay(1500).animate({'left': 352}, 400, eee);
				});
			});
		}


		$('#easeType').change(function(){
			var eee = $('#easeType option:selected').val();
			bumpIt(eee);
		});

		bumpIt('easeInOutBounce');

	});
</script>
</body>
</html>
