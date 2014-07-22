		</section> <!-- end of feature -->
		<section id='helpPanel'>
			<p style='margin:30px 0;'>Click (or use pageUp key) to single-step backward &rarr;</p>
			<p style='margin:48px 0 14px;'>Click to stop or restart scrolling &rarr;</p>
			<p style='margin:36px 0 14px;'>Click a number to go to specific panel &rarr;</p>
			<p style='margin:36px 0 70px; text-align:left;'>&larr; Drag the numbered bar up/down to adjust scroll speed</p>
			<p style='margin:34px 0 40px; text-align:left;'>&larr; Page scroll indicator</p>
			<p style='margin:0;'>Click (or use pageDown key) to single-step forward &rarr;</p>
		</section>
		<section id='contactPanel' class='roundedCorners'>
			<h1>Contact Us</h1>
			<div class='contactIcon' id='c1'></div><div class='contactText'>
						<p>
							Send <a href='./FundingRequest.php'>Funding Requests</a> for the
							best response<br/>and to describe your project. You can also email
						</p>
						<div class='contactEmail'></div>
					</div>
			<div class='contactIcon' id='c2'></div><div class='contactText'>
						<p>
							Our office phone number is +1.925.399.5359<br/>
							We are in the Pacific Time Zone, GMT -8 hours.
						</p>
					</div>
			<div class='contactIcon' id='c3'></div><div class='contactText'>
						<p>
							Search for us on Skype using
						</p>
						<div class='contactEmail'></div>
					</div>
			<div class='contactIcon' id='c4'></div><div class='contactText'>
						<p>
							Our office is in Pleasanton, CA USA
						</p>
					</div>
		</section> <!-- end of contact panel -->
	</section> <!-- end of featureContainer -->
	<footer>
		<p class='footerP'>&copy; Pronto Commercial Funding 2006-<span id='thisYear'></span> All Rights Reserved.</p>
	</footer> <!-- Bottom -->
</section> <!--end of pageWrapper -->

	<!--this is for feedback pullout-->
	<section id='feedbackWrapper'>
		<section id='feedbackPanel' class='roundedCorners'>
			<section id='block202'>
				<form id='feedbackForm' action="#" method="get">
					<p>Have any questions? Want to make a comment?<br/>If so, here is a place to do it. Want to discuss a project?<br/>Make a <a href='FundingRequest.php'>Funding Request</a> instead.</p>
					<p><input type="text" class="feedbackField" id="feedbackName" onfocus="if (this.value=='Name') this.value='';" value="Name" size="30" maxlength="50"/></p>
					<p><input type="text" class="feedbackField" id='feedbackEmail' onfocus="if (this.value=='email (if you\'d like a reply)') this.value='';" value="email (if you'd like a reply)" size="30" maxlength="50"/></p>
					<p><textarea cols='40' rows='40' class="feedbackField" name='feedbackText' id='feedbackText' onfocus="if (this.value=='Feedback') this.value='';" >Feedback</textarea></p>
					<div><p><input id='feedbackSubmit' name="submit" type="submit" value="Send"/></p></div>
					<div><p><input id='feedbackCancel' name="cancel" type="reset" value="Cancel"/></p></div>
				</form>
			</section>
			<section id='done202'>
				<div id='feedbackSentMsg'><strong>Thank you!</strong> We have received your message.<br/><br/>Click the 'Feedback' button again to close this window.</div>
				<div id="clear202"></div>
			</section>
		</section>
		<div id="feedbackButton">
			<img src='./images/spriteMe.png' alt=''>
		</div>
	</section><!-- feedbackWrapper -->

	<!--this is for Procedures pullout-->
	<section id='proceduresWrapper'>
		<section id='proceduresPanel' class='roundedCorners'>
			<div id='proceduresText' class='roundedCorners'>
				<h2>Our Step-By-Step Process</h2>

				<p>1. Fill out our Client Information Sheet</p>

				<p>2. Complete and return it along with a color copy of your passport,
				a corporate resolution if you are leasing on behalf of your corporation,
				and a bank statement showing you have the fee available to spend</p>

				<p>3. A contract is then sent back along with escrow instructions</p>

				<p>4. Once the fee is wired into escrow we will have the bank instrument or POF account set-up</p>

				<p>5. Within 48 hours your POF account will be ready to be verified</p>

				<p>6. The MT-799 or MT-760 is sent according to your request</p>
			</div>
		</section>
		<div id="proceduresButton">
			<img src='./images/spriteMe.png' alt=''>
		</div>
	</section><!-- proceduresWrapper -->

<script type='text/javascript'>
//google analytics
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-16743285-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
document.close();
</script>
<script src='./js/jquery.lettering-0.6.min.js'></script>
<script src='./js/jquery.transform.light.js'></script>
<script src='./js/ProntoCommercial.js'></script>
