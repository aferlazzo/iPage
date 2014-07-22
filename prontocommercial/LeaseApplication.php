<?php if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta name="generator" content="HTML Tidy for Windows (vers 14 February 2006), see www.w3.org">
	<title>
	Lease Application - Pronto Commercial Funding
	</title>
	<meta http-equiv="Content-Type" content="text/html; charset=us-ascii">
	<meta name="copyright" content=
	"Copyright 2007, Anthony Ferlazzo, Pronto Commercial Funding">
	<meta name="rating" content="General">
	<meta name="robots" content="Index, ALL, follow">
	<meta name="Description" content="Lease Application Form">
	<meta name="OWNER" content="Pronto Commercial Funding">
	<link rel="SHORTCUT ICON" href="http://www.prontocommercial.com/favicon.ico">
<?php
	if (file_exists("./css/ProntoStylesCompressed.css"))
		print("<link rel='stylesheet' href='./css/ProntoStylesCompressed.css' type='text/css'>\n");
	else
		print("<link rel='stylesheet' href='./css/ProntoStyles.css' type='text/css'>\n");
	
	if (file_exists("./css/FundingRequestCompressed.css"))
		print("<link rel='stylesheet' href='./css/FundingRequestCompressed.css' type='text/css'>\n");
	else
		print("<link rel='stylesheet' href='./css/FundingRequest.css' type='text/css'>\n");
?>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
<?php
	if (file_exists("./js/ProntoCommonCompressed.js"))
		print("<script src='./js/ProntoCommonCompressed.js' type='text/javascript'>\n");
	else
		print("<script src='./js/ProntoCommon.js' type='text/javascript'>\n");
?></script>
	<script src="./js/FundingRequest.js" type="text/javascript"></script>
</head>
<body onload='PositionCursor(document.formLeaseApp);'>
	<?php include("include/top.php"); ?>
	<!--<h1>Make Your Request</h1>-->
	<div id='Form'>
		<h1>Lease Application</h1>
	<form id="formLeaseApp" name="formLeaseApp" action="#" method="post">
	<fieldset>
	<legend>Please tell us what you need and how to reach you</legend>	
	<div id='wrapper' class='Highlight'>
		<div id='LeftBox'>
			<div class='BoxRow'>
				<label for='Bname'>Beneficiary Name</label>
				<input type="text" name="Bname" id="Bname" class='RequestField' maxlength="50"
					tabindex="10" size="36" style='width:125px;' onfocus=
					"this.style.border='2px solid #00f';" onblur=
					"this.style.border='1px solid silver'">
			</div>
			<div class='BoxRow'>
				<label for='Cname'>Company Name</label>
				<input type="text" name="Cname" id="Cname" class='RequestField' maxlength="50"
					tabindex="10" size="36" style='width:125px;' onfocus=
					"this.style.border='2px solid #00f';" onblur=
					"this.style.border='1px solid silver'">
			</div>
			<div class='BoxRow'>
				<label for='Address'>Address</label>
				<input type="text" name="Address" id="Address" class='RequestField' maxlength="50"
					tabindex="10" size="36" style='width:125px;' onfocus=
					"this.style.border='2px solid #00f';" onblur=
					"this.style.border='1px solid silver'">
			</div>
			<div class='BoxRow'>
				<label for='ZipCode'>Zip Code</label>
				<input type="text" name="ZipCode" id="ZipCode" class='RequestField' maxlength="50"
					tabindex="10" size="36" style='width:125px;' onfocus=
					"this.style.border='2px solid #00f';" onblur=
					"this.style.border='1px solid silver'">
			</div>
			<div class='BoxRow'>
				<label for='Currency'>Currency</label>
				<select tabindex="15" id="Currency" name="Currency" class='RequestField' size="1"
				onfocus="this.style.border='1px solid #000080'" onblur=
				"this.style.border='1px solid silver'" 
				style='background:#fff;border:1px solid silver;'
					onMouseOver='this.style.backgroundColor="#39c";this.style.color="#fff";this.style.border="2px solid #00f";'
					onMouseOut= 'this.style.backgroundColor="#fff";this.style.color="#000";this.style.border="1px solid silver";'>
					<option value="USD">USD</option>
					<option value='EURO'>EURO</option>
				</select>
			</div>
			<div class='BoxRow'>
				<label for='Months'>Length</label>
				<select name="Months" id="Months" class='RequestField' size="1" tabindex="20"
					onfocus="this.style.border='1px solid #000080'" onblur=
					"this.style.border='1px solid silver'" style=
					'background:#fff;border:1px solid silver;'
					onMouseOver='this.style.backgroundColor="#39c";this.style.color="#fff";this.style.border="2px solid #00f";'
					onMouseOut= 'this.style.backgroundColor="#fff";this.style.color="#000";this.style.border="1px solid silver";'>
					<option value='1'>1</option>
					<option value='2'>2</option>
					<option value='3'>3</option>
					<option value='4'>4</option>
					<option value='5'>5</option>
					<option value='6'>6</option>
					<option value='7'>7</option>
					<option value='8'>8</option>
					<option value='9'>9</option>
					<option value='10'>10</option>
					<option value='11'>11</option>
					<option selected value='12'>12</option>
					<option value='13'>13</option>
					<option value='14'>14</option>
					<option value='15'>15</option>
				</select> Months
			</div>

			<div class='BoxRow' style='margin:-20px 0;text-align:left;height:95px;min-height:95px;background:transparent;'>
			<label for='Swift'></label>
				<fieldset style='margin:0;padding:0;width:105px;height:90px;background:transparent;'>
					<legend>SWIFT Type</legend>
					<label for='Swift' class='SwiftLabel'>None</label>   
					<input tabindex='25' type='radio' class='radio' name='Swift' id='SwiftNone' value='None'
					class='RequestField' onfocus='this.blur();'><br>
					<label for='Swift' class='SwiftLabel'>MT-799</label>
					<input tabindex='26' type='radio' class='radio' name='Swift' id='SwiftMT799' value='MT799'
					class='RequestField' onfocus='this.blur();'><br>
					<label for='SwiftMT760' class='SwiftLabel'>MT-760</label>
					<input tabindex='27' type='radio' class='radio' name='Swift' id='SwiftMT760' value='MT760' 
					class='RequestField' onfocus='this.blur();'>
				</fieldset>
			</div>
		</div>
		<div id='RightBox'>
			<div class='BoxRow'>
				<label for='FullName'>Name</label>
				<input type="text" id="FullName" name="FullName" class='RequestField' maxlength=
					"50" tabindex="35" size="36" onfocus=
					"this.style.border='2px solid #00f'" onblur=
					"this.style.border='1px solid silver'">
			</div>
			<div class='BoxRow'>
				<label for='Phone'>Phone</label>
				<input type="text" name="Phone" id="Phone" class='RequestField' maxlength="50"
					size="36" tabindex="40" onfocus=
					"this.style.border='2px solid #00f'" onblur=
					"this.style.border='1px solid silver'">
			</div>
			<div class='BoxRow'>
				<label for='Skype'>Skype ID</label>
				<input type="text" name="Skype" id="Skype" class='RequestField' maxlength="50"
					size="36" tabindex="45" onfocus=
					"this.style.border='2px solid #00f'" onblur=
					"this.style.border='1px solid silver'">
			</div>
			<div class='BoxRow'>
				<label for='Country'>Country</label>
				<select id="Country" name="Country" class='RequestField' size="1" tabindex="50" 
					onfocus="this.style.border='2px solid #00f';" onblur=
					"this.style.border='1px solid silver'" 
					style='width:210px;background:#fff;border:1px solid silver;'
					onMouseOver='this.style.backgroundColor="#39c";this.style.color="#fff";this.style.border="2px solid #00f";'
					onMouseOut= 'this.style.backgroundColor="#fff";this.style.color="#000";this.style.border="1px solid silver";'>
						<option value="Select">Select</option>
						<optgroup label="common choices">
							<option value="United Kingdom">United Kingdom</option> 
							<option value="United States">United States</option> 
							<option value="France">France</option> 
							<option value="Germany">Germany</option> 
							<option value="Spain">Spain</option> 
							<option value="Italy">Italy</option> 
							<option value="Canada">Canada</option> 
						</optgroup>
						<optgroup label="other countries">
							<option value="Afghanistan">Afghanistan</option> 
							<option value="Albania">Albania</option> 
							<option value="Algeria">Algeria</option> 
							<option value="American Samoa">American Samoa</option> 
							<option value="Andorra">Andorra</option> 
							<option value="Angola">Angola</option> 
							<option value="Anguilla">Anguilla</option> 
							<option value="Antarctica">Antarctica</option> 
							<option value="Antigua and Barbuda">Antigua and Barbuda</option> 
							<option value="Argentina">Argentina</option> 
							<option value="Armenia">Armenia</option> 
							<option value="Aruba">Aruba</option> 
							<option value="Australia">Australia</option> 
							<option value="Austria">Austria</option> 
							<option value="Azerbaijan">Azerbaijan</option> 
							<option value="Bahamas">Bahamas</option> 
							<option value="Bahrain">Bahrain</option> 
							<option value="Bangladesh">Bangladesh</option> 
							<option value="Barbados">Barbados</option> 
							<option value="Belarus">Belarus</option> 
							<option value="Belgium">Belgium</option> 
							<option value="Belize">Belize</option> 
							<option value="Benin">Benin</option> 
							<option value="Bermuda">Bermuda</option> 
							<option value="Bhutan">Bhutan</option> 
							<option value="Bolivia">Bolivia</option> 
							<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option> 
							<option value="Botswana">Botswana</option> 
							<option value="Bouvet Island">Bouvet Island</option> 
							<option value="Brazil">Brazil</option> 
							<option value="British Indian Ocean Territory">British Indian Ocean Territory</option> 
							<option value="Brunei Darussalam">Brunei Darussalam</option> 
							<option value="Bulgaria">Bulgaria</option> 
							<option value="Burkina Faso">Burkina Faso</option> 
							<option value="Burundi">Burundi</option> 
							<option value="Cambodia">Cambodia</option> 
							<option value="Cameroon">Cameroon</option> 
							<option value="Canada">Canada</option> 
							<option value="Cape Verde">Cape Verde</option> 
							<option value="Cayman Islands">Cayman Islands</option> 
							<option value="Central African Republic">Central African Republic</option> 
							<option value="Chad">Chad</option> 
							<option value="Chile">Chile</option> 
							<option value="China">China</option> 
							<option value="Christmas Island">Christmas Island</option> 
							<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option> 
							<option value="Colombia">Colombia</option> 
							<option value="Comoros">Comoros</option> 
							<option value="Congo">Congo</option> 
							<option value="Congo, The Democratic Republic of The">Congo, The Demo. Repub. of The</option> 
							<option value="Cook Islands">Cook Islands</option> 
							<option value="Costa Rica">Costa Rica</option> 
							<option value="Cote D'ivoire">Cote D'ivoire</option> 
							<option value="Croatia">Croatia</option> 
							<option value="Cuba">Cuba</option> 
							<option value="Cyprus">Cyprus</option> 
							<option value="Czech Republic">Czech Republic</option> 
							<option value="Denmark">Denmark</option> 
							<option value="Djibouti">Djibouti</option> 
							<option value="Dominica">Dominica</option> 
							<option value="Dominican Republic">Dominican Republic</option> 
							<option value="Ecuador">Ecuador</option> 
							<option value="Egypt">Egypt</option> 
							<option value="El Salvador">El Salvador</option> 
							<option value="Equatorial Guinea">Equatorial Guinea</option> 
							<option value="Eritrea">Eritrea</option> 
							<option value="Estonia">Estonia</option> 
							<option value="Ethiopia">Ethiopia</option> 
							<option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option> 
							<option value="Faroe Islands">Faroe Islands</option> 
							<option value="Fiji">Fiji</option> 
							<option value="Finland">Finland</option> 
							<option value="France">France</option> 
							<option value="French Guiana">French Guiana</option> 
							<option value="French Polynesia">French Polynesia</option> 
							<option value="French Southern Territories">French Southern Territories</option> 
							<option value="Gabon">Gabon</option> 
							<option value="Gambia">Gambia</option> 
							<option value="Georgia">Georgia</option> 
							<option value="Germany">Germany</option> 
							<option value="Ghana">Ghana</option> 
							<option value="Gibraltar">Gibraltar</option> 
							<option value="Greece">Greece</option> 
							<option value="Greenland">Greenland</option> 
							<option value="Grenada">Grenada</option> 
							<option value="Guadeloupe">Guadeloupe</option> 
							<option value="Guam">Guam</option> 
							<option value="Guatemala">Guatemala</option> 
							<option value="Guinea">Guinea</option> 
							<option value="Guinea-bissau">Guinea-bissau</option> 
							<option value="Guyana">Guyana</option> 
							<option value="Haiti">Haiti</option> 
							<option value="Heard Island and Mcdonald Islands">Heard Isl and Mcdonald Isl</option> 
							<option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option> 
							<option value="Honduras">Honduras</option> 
							<option value="Hong Kong">Hong Kong</option> 
							<option value="Hungary">Hungary</option> 
							<option value="Iceland">Iceland</option> 
							<option value="India">India</option> 
							<option value="Indonesia">Indonesia</option> 
							<option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option> 
							<option value="Iraq">Iraq</option> 
							<option value="Ireland">Ireland</option> 
							<option value="Israel">Israel</option> 
							<option value="Italy">Italy</option> 
							<option value="Jamaica">Jamaica</option> 
							<option value="Japan">Japan</option> 
							<option value="Jordan">Jordan</option> 
							<option value="Kazakhstan">Kazakhstan</option> 
							<option value="Kenya">Kenya</option> 
							<option value="Kiribati">Kiribati</option> 
							<option value="Korea, Democratic People's Republic of">Korea, Demo. People's Repub. of</option> 
							<option value="Korea, Republic of">Korea, Republic of</option> 
							<option value="Kuwait">Kuwait</option> 
							<option value="Kyrgyzstan">Kyrgyzstan</option> 
							<option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option> 
							<option value="Latvia">Latvia</option> 
							<option value="Lebanon">Lebanon</option> 
							<option value="Lesotho">Lesotho</option> 
							<option value="Liberia">Liberia</option> 
							<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option> 
							<option value="Liechtenstein">Liechtenstein</option> 
							<option value="Lithuania">Lithuania</option> 
							<option value="Luxembourg">Luxembourg</option> 
							<option value="Macao">Macao</option> 
							<option value="Macedonia, The Former Yugoslav Republic of">Macedonia, Former Yugoslav </option> 
							<option value="Madagascar">Madagascar</option> 
							<option value="Malawi">Malawi</option> 
							<option value="Malaysia">Malaysia</option> 
							<option value="Maldives">Maldives</option> 
							<option value="Mali">Mali</option> 
							<option value="Malta">Malta</option> 
							<option value="Marshall Islands">Marshall Islands</option> 
							<option value="Martinique">Martinique</option> 
							<option value="Mauritania">Mauritania</option> 
							<option value="Mauritius">Mauritius</option> 
							<option value="Mayotte">Mayotte</option> 
							<option value="Mexico">Mexico</option> 
							<option value="Micronesia, Federated States of">Micronesia, Federated States of</option> 
							<option value="Moldova, Republic of">Moldova, Republic of</option> 
							<option value="Monaco">Monaco</option> 
							<option value="Mongolia">Mongolia</option> 
							<option value="Montserrat">Montserrat</option> 
							<option value="Morocco">Morocco</option> 
							<option value="Mozambique">Mozambique</option> 
							<option value="Myanmar">Myanmar</option> 
							<option value="Namibia">Namibia</option> 
							<option value="Nauru">Nauru</option> 
							<option value="Nepal">Nepal</option> 
							<option value="Netherlands">Netherlands</option> 
							<option value="Netherlands Antilles">Netherlands Antilles</option> 
							<option value="New Caledonia">New Caledonia</option> 
							<option value="New Zealand">New Zealand</option> 
							<option value="Nicaragua">Nicaragua</option> 
							<option value="Niger">Niger</option> 
							<option value="Nigeria">Nigeria</option> 
							<option value="Niue">Niue</option> 
							<option value="Norfolk Island">Norfolk Island</option> 
							<option value="Northern Mariana Islands">Northern Mariana Islands</option> 
							<option value="Norway">Norway</option> 
							<option value="Oman">Oman</option> 
							<option value="Pakistan">Pakistan</option> 
							<option value="Palau">Palau</option> 
							<option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option> 
							<option value="Panama">Panama</option> 
							<option value="Papua New Guinea">Papua New Guinea</option> 
							<option value="Paraguay">Paraguay</option> 
							<option value="Peru">Peru</option> 
							<option value="Philippines">Philippines</option> 
							<option value="Pitcairn">Pitcairn</option> 
							<option value="Poland">Poland</option> 
							<option value="Portugal">Portugal</option> 
							<option value="Puerto Rico">Puerto Rico</option> 
							<option value="Qatar">Qatar</option> 
							<option value="Reunion">Reunion</option> 
							<option value="Romania">Romania</option> 
							<option value="Russian Federation">Russian Federation</option> 
							<option value="Rwanda">Rwanda</option> 
							<option value="Saint Helena">Saint Helena</option> 
							<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
							<option value="Saint Lucia">Saint Lucia</option> 
							<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option> 
							<option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option> 
							<option value="Samoa">Samoa</option> 
							<option value="San Marino">San Marino</option> 
							<option value="Sao Tome and Principe">Sao Tome and Principe</option> 
							<option value="Saudi Arabia">Saudi Arabia</option> 
							<option value="Senegal">Senegal</option> 
							<option value="Serbia and Montenegro">Serbia and Montenegro</option> 
							<option value="Seychelles">Seychelles</option> 
							<option value="Sierra Leone">Sierra Leone</option> 
							<option value="Singapore">Singapore</option> 
							<option value="Slovakia">Slovakia</option> 
							<option value="Slovenia">Slovenia</option> 
							<option value="Solomon Islands">Solomon Islands</option> 
							<option value="Somalia">Somalia</option> 
							<option value="South Africa">South Africa</option> 
							<option value="South Georgia and The South Sandwich Islands">South Georgia &amp; S. Sandwich Isls</option> 
							<option value="Spain">Spain</option> 
							<option value="Sri Lanka">Sri Lanka</option> 
							<option value="Sudan">Sudan</option> 
							<option value="Suriname">Suriname</option> 
							<option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option> 
							<option value="Swaziland">Swaziland</option> 
							<option value="Sweden">Sweden</option> 
							<option value="Switzerland">Switzerland</option> 
							<option value="Syrian Arab Republic">Syrian Arab Republic</option> 
							<option value="Taiwan, Province of China">Taiwan, Province of China</option> 
							<option value="Tajikistan">Tajikistan</option> 
							<option value="Tanzania, United Republic of">Tanzania, United Republic of</option> 
							<option value="Thailand">Thailand</option> 
							<option value="Timor-leste">Timor-leste</option> 
							<option value="Togo">Togo</option> 
							<option value="Tokelau">Tokelau</option> 
							<option value="Tonga">Tonga</option> 
							<option value="Trinidad and Tobago">Trinidad and Tobago</option> 
							<option value="Tunisia">Tunisia</option> 
							<option value="Turkey">Turkey</option> 
							<option value="Turkmenistan">Turkmenistan</option> 
							<option value="Turks and Caicos Islands">Turks and Caicos Islands</option> 
							<option value="Tuvalu">Tuvalu</option> 
							<option value="Uganda">Uganda</option> 
							<option value="Ukraine">Ukraine</option> 
							<option value="United Arab Emirates">United Arab Emirates</option> 
							<option value="United Kingdom">United Kingdom</option> 
							<option value="United States">United States</option> 
							<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option> 
							<option value="Uruguay">Uruguay</option> 
							<option value="Uzbekistan">Uzbekistan</option> 
							<option value="Vanuatu">Vanuatu</option> 
							<option value="Venezuela">Venezuela</option> 
							<option value="Viet Nam">Viet Nam</option> 
							<option value="Virgin Islands, British">Virgin Islands, British</option> 
							<option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option> 
							<option value="Wallis and Futuna">Wallis and Futuna</option> 
							<option value="Western Sahara">Western Sahara</option> 
							<option value="Yemen">Yemen</option> 
							<option value="Zambia">Zambia</option> 
							<option value="Zimbabwe">Zimbabwe</option>
						</optgroup>
				</select>
			</div>
			<div class='BoxRow'>
				<label for='Email'>E-mail</label>
				<input type="text" name="Email" id="Email" class='RequestField' maxlength="50" 
					size="36" tabindex="55" onfocus=
					"this.style.border='2px solid #00f'" onblur=
					"this.style.border='1px solid silver'">
			</div>
		</div> <!--end Right Box -->
		<br style='clear:left;'>
		<p style='width:100%;text-align:center;margin:0;background:transparent;'>
		Now enter additional details and comments about you request below<br>
		<textarea id="Comments" name="Comments" class='RequestField' tabindex="60"  cols='60' rows='12' id=
		"Comments" onfocus="this.style.border='2px solid #00f'" 
		onblur="this.style.border='1px solid silver'"
		onMouseOver='this.style.backgroundColor="#39c";this.style.color="#fff";'
		onMouseOut= 'this.style.backgroundColor="#fff";this.style.color="#000";'>
</textarea></p>
		<p style='width:100%;text-align:center;margin:12px 0;background:transparent;'>
		This test is just to foil the spammers who are choking the Internet</p>
		<div id='LeftBox2'>
			<div class='BoxRow2'>
				<label for='CaptchaImage' style='margin-top:8px;'>The Code</label>
				<img id='CaptchaImage' alt='click for new code' title='verification code'  
				src='./captcha/CaptchaSecurityImages.php' onclick='location.reload(true);'>				
			</div>
		</div>
		<div id='RightBox2'>
			<div class='BoxRow2' style='margin-top:6px;'> 
				<label for='security_code'>Copy The Code</label>
				<input type="text" name="security_code" id="security_code"
					style='width:60px;'	maxlength="6" size="36" tabindex="95" 
					onfocus="this.style.border='2px solid #00f'" onblur=
					"this.style.border='2px solid silver'">
			</div>
		</div>
	</div> <!-- end wrapper -->
	<div id='BottomBox'>
		<button id="SendRequestButton" type="submit" tabindex="100"
		onmousedown="this.style.background='url(./images/menu/MenuShapes.png) -586px -74px'"
		onmouseout="this.style.background='url(./images/menu/MenuShapes.png) -407px -74px'"
		onfocus='this.blur()'></button>
	</div>
	</fieldset>
	</form>	
	</div> <!-- end Form -->
	<div id='SuccessDiv'>
		<h1>Thank You</h1>
		<p>Your request has been sent. You will be contacted by email or phone to move forward with your request.</p>
	</div>
	<div id='MsgDiv2'>
		<p>One moment while we redirect you to:</p>
		<h3>The <span class='Highlight'>Commercial Mortgage Application page.</span>
		</h3>
	</div>




<?php include("./include/bottom.php"); ?>
<script type="text/javascript">PositionCursor(document.frmFeedBack);</script>
</body>
</html>
