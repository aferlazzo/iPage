<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <meta name="generator" content=
    "HTML Tidy for Windows (vers 14 February 2006), see www.w3.org">
    <title>
      Certificate of Deposit Leasing
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=us-ascii">
    <meta name="copyright" content=
    "Copyright 2010, Anthony Ferlazzo, Pronto Commercial Funding">
    <meta name="rating" content="General">
    <meta name="robots" content="Index, ALL, follow">
    <meta name="Description" content=
    "CD leasing, Certificate of Deposit Leasing - Now with special pricing">
    <meta name="Keywords" content=
    "CD leasing, Certificate of Deposit Leasing">
    <meta name="OWNER" content="Pronto Commercial Funding">
    <link rel="SHORTCUT ICON" href=
    "http://www.prontocommercial.com/favicon.ico">
	<?php include("include/Head.php"); ?>
</head>
  <body>
		<!--
		<input type='button' id='sss' value='STOP Tumbling 0' style='margin:15px;'/>
		<div id='out'></div>
		-->
    <?php include("include/top.php"); ?>
    <h1>
      Certificate of Deposit Leasing
    </h1>
    <p>
		This is probably the best program to come across my desk this year.</p>

	<p>My provider's primary business is to loan bank instruments to clients to be used as collateral, credit enhancement, or a
		balance sheet enhancement for qualified transactions around the world.
		They have the ability to issue and deliver cash backed bank instruments in the form of Standby Letters of Credit, Bank
		Guarantees, and Certificates of Deposit.</p>
	<ul>Issuing banks include
			<li>HSBC London</li>
			<li>Barclays London</li>
			<li>ABN Amro Amsterdam</li>
			<li>UBS Zurich or Geneva</li>
	</ul>
	<p>
		We issue bank instruments for a minimum amount of $10,000,000.00 (Ten Million United States Dollars/Euros) and above.
		Bank Instruments can be leased for terms of one (1), three (3), and five (5) years, with the option to renew prior to
		maturity.
	</p>

	<h2>Advantages of Bank Instruments</h2>

	<p>What makes our collateral such a powerful funding tool?</p>
	<ul>
		<li>The bank instruments we provide are one hundred percent (100%) cash backed collateral.</li>
		<li>Under certain circumstances, we can cause the issuance and delivery of a bank instrument in the name of our client as
			beneficiary, or assign a bank instrument to their favor.</li>
		<li>We only require a corporate undertaking to return the bank instrument at maturity.</li>
		<li>The beneficiary has the option to</li>
			<ol><li>Return the bank instrument fifteen (15) days prior to maturity</li>
			<li>Pay the face value of the bank instrument at maturity</li>
			<li>Renew the bank instrument for an additional term.</li></ol>
		The option to purchase the borrowed asset is unique in the marketplace.
		<li>We issue our bank instruments at top European banks to assure worldwide acceptance of the instruments.</li>
		<li>Collateral based project funding has less strenuous requirements for the borrower�s financial strength than traditional
			project funding.</li>
	</ul>
<?php include("./include/bottom.php"); ?>
<script>
	$(document).ready(function(){
		var DIV_CODE=0, INTERVAL_ID=1, TOP_INDEX=2,								// initialize constants to use with the 2 dimensional array
		divArray = [[], []], //initialize a 2 dimensional array, first index are actual counters, second index is 0, 1, or 2.
		letterLimit, i, currentLetter=0, k=0;
		var pattern = /[a-zA-Z0-9,./\\!@#$%^&*()-_+=]/;
		var letters = $('.feature').text(); //.reverse();  //put all the characters in the body in one string





		var offset = $('.feature').offset();
		$('.feature').css('backgroundColor', 'red');
		console.log(".feature div is left: " + offset.left + ", top: " + offset.top);
		var offset = $('h1', '.feature').offset();
		$('h1', '.feature').css('backgroundColor', '#fff');
		var h1Text = $('h1', '.feature').text();
		console.log(".feature h1 is left: " + offset.left + ", top: "+ offset.top +", h1 Text: |" + h1Text+'|');




		var xxx = $('.feature').html();
		console.log('feature.html(): '+xxx);


		for (i=0; i < 20; i++)
			if(pattern.test(letters [i])!= false)			//send only non-whitespace characters to the console
			{

				console.log('letter ['+i+']: '+letters[i]);

			}





		function stringLettersRight()
		{
			var e, f;

			for (e = 0; e < currentLetter; e++){					// don't let the letters pile up at the bottom of the page...
					f = parseInt($('#n'+e).css('left')) + 8;
					$('#n'+e).css('left', f);
			}
		}

		// start the cycle with the next letter

		function nextLetter()
		{
			currentLetter++;															// the next letter
			stringLettersRight();
			console.log('nextLetter() '+currentLetter);
			divArray[[currentLetter], [TOP_INDEX]] = 0;		// initialize tumbling action
			tumbleDown(currentLetter);
		}

		// This function changes the top position of the letter's DIV 1 pixel at a time.
		// Once the index positioning the top (the divArrayTumbleIndex) reaches 600, clear the repetative kick-off routine.

		function goDown(xx)
		{
			var tt, ll;

			$('#n'+xx).css({'top': divArray[[xx], [TOP_INDEX]], 'left': 35});
			tt = $('#n'+xx).css('top');
			ll = $('#n'+xx).css('left');

			//console.log('goDown() id: #n'+ xx+' top: '+tt+' left: '+ll+' index: '+divArray[[xx], [TOP_INDEX]]);
			divArray[[xx], [TOP_INDEX]] += 4;				// position DIV top to the pixel 4 down
			if (divArray[[xx], [TOP_INDEX]] > 600)	//continue dropping until  reaching 600 from the top
			{
				console.log('goDown() is clearing interval for n'+xx), window.clearInterval(divArray[[xx], [INTERVAL_ID]]);
				nextLetter();
			}
/*
			if(divArray[[xx], [TOP_INDEX]] % 100 == 0)
				console.log("goDown() letter "+divArray[[xx], [DIV_CODE]]+" is at index "+ divArray[[xx], [TOP_INDEX]]);
*/
		}

		// this function fires off the repetative call to the goDown function.
		// Every 20 milliseconds goDown is called with the letter's id as the sole argument of goDown.
		// This is also where the STOP button is bound and unbound.
		//

		function tumbleDown(xx)
		{
			//console.log();
			divArray[[xx], [INTERVAL_ID]] = window.setInterval(goDown, 20, xx);
			$('#sss').unbind('click');		//unbind old click handler from the button

			$('#sss').val('STOP Tumbling '+xx);	//Put the current DIV number on the button face

			$('#sss').bind('click', xx, function(e){		// button click now does this
				console.log('tumbleDown() The Stop Button has cleared interval for n'+xx);
				window.clearInterval(divArray[[xx], [INTERVAL_ID]]);
				$('#sss').val('STOPPED');
				$('#n'+xx).css('top', 600);		//drop the letter completely down

				if(xx < letterLimit)
					nextLetter();
			});
		}

		//	Start here. . .

		//	make these HTML elements the first in the body

		$('body').prepend("<input type='button' id='sss' value='STOP Tumbling 0' style='position:fixed;z-index:22;top:15px;left:45px;'/>");
		$('body').prepend("<div id='letterDivs'></div>");

		//	Create a DIV around the letter that has a unique ID. The DIV must be absolutely positioned, so
		//	it can be positioned around the web page.

		//	Initialize table entries for the DIV

		for(i=0; i < letters.length; i++)
		{
			if(pattern.test(letters [i])!= false)			//only add non-whitespace characters to the array
			{

				divArray[[currentLetter], [DIV_CODE]] = "<div style='position:absolute;top:-99px;left:-99px;color:#fff;' id='n"+currentLetter+"'>"+letters[i]+"</div>";
				//console.log(divArray[[currentLetter], [DIV_CODE]]);
				$('#letterDivs').append(divArray[[currentLetter], [DIV_CODE]]);
				divArray[[currentLetter], [TOP_INDEX]] = 0;
				divArray[[currentLetter], [INTERVAL_ID]] = 0;
				currentLetter++;
			}
		}

		letterLimit = currentLetter;
		currentLetter = 0;
		console.log('kicking off tumbleDown(0)');
		tumbleDown(0); // start tumbling the first letter
	});
</script>
  </body>
</html>
