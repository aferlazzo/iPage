<?php if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip'))
	ob_start("ob_gzhandler");
else
	ob_start();
session_save_path("/home/prontoc2/php");
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>
		Funding Test
	</title>
<?php include("include/Head.php"); ?>
<?php
	if (file_exists("./css/FundingRequest.min.css"))
		print("<link rel='stylesheet' href='./css/FundingRequest.min.css' type='text/css' />\n");
	else
		print("<link rel='stylesheet' href='./css/FundingRequest.css' type='text/css' />\n");
?>
</head>
<body>
<?php include("include/top.php"); ?>
<form id="formFundingRequest" action="#" method="post">
<h1>Funding Test</h1>
<div class='featurette '>
	<div id='Container1' class='panel '>
		<h3 id='FormH3Label1' title='Your Funding Need' class=''><a href='#'></a></h3>
		<div id="Content1" class='panelContent '>
				<label for='Category'>Funding Request
				<select name="Category" id="Category" class='panel1Fields' onchange='LoanApp(Category)' size="1" tabindex="10">
					<option value="">Select</option>
					<option value='POF'>Proof Of Funds</option>
					<option value='SBLC'>SBLC Lease</option>
					<option value='BG'>Bank Guarantee Lease</option>
					<option value='PPP'>Private Placement Program</option>
					<option value='MTN'>MTN Lease</option>
					<option value='Loan'>Commercial Loan</option>
					<option value='Other'>Other</option>
				</select></label>
					<p id='CategoryError' style='margin-top:9px;' class='ErrorMessage'>Please specify funding type</p>

				<div class='hints'>Our minimum for most transactions is 1 000 000.</div>
				<div>
					<label for='Amount'>Amount</label>
					<input type="text" value='$300 000 000' name="Amount" id="Amount" class='RequestField' maxlength="50" tabindex="11" />
					<p id='AmountError' style='margin-top:9px;' class='ErrorMessage'>What amount are you are requesting?</p>
				</div>

				<div class='hints' style='width:150px;margin-right:30px;'>The dollar sign and Euro symbols are added to the amount above automatically.</div>
				<div id='CurrencyType'>
					<label for='Currency'>Currency</label> <input type='checkbox' id='Currency' class='jquery-checkbox'/>
				</div>

				<div id='SwiftType'>
					<div style='margin-left:5px;'><p>Swift Message Type</p></div>
					<input name='SwiftType' value="None"  class="sw-button" type="radio" checked /><label for='SwiftType'>Not Needed</label><br/>
					<input name='SwiftType' value="MT799" class="sw-button" type="radio" /><label for='SwiftType'>Send a MT799</label><br/>
					<input name='SwiftType' value="MT760" class="sw-button" type="radio" /><label for='SwiftType'>Send a MT760</label>
				</div>

				<div id='TermLength' style='height:20px;width:230px;'>
					<p><label for='LengthBox'>Length</label><input type='text' value='12' name="LengthBox" id="LengthBox"
					class='RequestField' style='width:20px;margin:0 5px;' tabindex="18"  />Months</p>
					<p id='LengthError' style='margin-top:9px;' class='ErrorMessage'>How long a term are you requesting?</p>
				</div>
				<div id="amountSlider" style='height:20px;display:none'></div>
				<div id="lengthSlider" style='height:20px;display:none;'></div>
		</div><!-- end of Content1 -->
	</div>
	<div id='Container2' class='panel '>
		<h3 id='FormH3Label2' title='Your Objective'><a href='#'></a></h3>
		<div id="Content2" class='panelContent '>
			<label for='Comments'>Describe in detail your request (double-click box for more room)</label>
			<div><textarea name="Comments" class='panel2Fields' tabindex="20" cols='80' rows='12' id="Comments"
			onfocus="this.style.border='1px solid #00f';"
			onblur="this.style.border='1px solid silver';">
</textarea></div>
			<div id='CommentsEdiv'>
				<p id='CommentsError'  class='ErrorMessage panel2Errors'>We need some details about your transaction</p>

				<div id='CodeDiv'>
					<img id='CodeImage' alt='' title='verification code' src='./captcha/CaptchaSecurityImages.php' />
					<br/>The Code
				</div>
				<div id='CaptchaDiv'>
					<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Copy The Code
					<input type="text" name="Captcha" id="Captcha" class='panel2Fields' tabindex="21"  maxlength="6" size="36"
					onfocus="this.style.border='1px solid #00f'" onblur="this.style.border='1px solid silver'" /></p>
					<p id='CaptchaError' style='margin-top:12px;' class='ErrorMessage panel2Errors'>Please copy the code</p>
					<p id='CaptchaCopyError' style='margin-top:0;' class='ErrorMessage panel2Errors'>Double-check the code</p>
				</div>
			</div>
			<div id='ButtonDiv'>
				<button id="SendRequestButton" type="submit" tabindex="100">Send</button> <span id='Return'></span><br/><br/><br/>
				<button id="CancelRequestButton" type="reset" tabindex="110">Cancel</button><br/>
			</div>
		</div>
	</div><!-- end of Content -->
</div>
</form>
<?php include("include/bottom.php"); ?>
<?php
	if (file_exists("./js/FundingRequest.min.js"))
		print("<script src='./js/FundingRequest.min.js' type='text/javascript'></script>\n");
	else
		print("<script src='./js/FundingRequest.js' type='text/javascript'></script>\n");
?>

<script type='text/javascript'>
//<![CDATA[
$(document).ready(function(){
startingPanel=28;
endingPanel=31;
rotateAccordion();
});
//]]>
</script>
</body>
</html>
