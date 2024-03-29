<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>
		Funding Request
	</title>
	<link rel="SHORTCUT ICON" href="http://www.prontocommercial.com/favicon.ico" />
<?php include("include/Head.php"); ?>
<link rel='stylesheet' href='./css/FundingRequest_css.php' />

<style type="text/css">
.ui-state-default {color:#fff;background: #025167;} /* active color in background */
.ui-state-hover {color:#fff;background: #5EC4CD;} /* default color in background */
</style>
</head>
<body>
<?php include("include/top.php"); ?>
<h1>Funding Request</h1>
<form id="formFundingRequest" action="#" method="post">
<div class='featurette nonFeedback'>
	<div id='Container0' class='panel nonFeedback'>
		<h3 id='FormH3Label0' title='Your Contact Info'><a href='#'></a></h3>
		<div id="Content0" class='panelContent nonFeedback'>
				<div class='hints'>We need to know what to call you.</div>
				<div>
					<label for='FullName'>Full Name</label>
					<input type="text" id="FullName" name="FullName" class='panel0Fields' tabindex="1" />
					<p id='FullNameError' class='ErrorMessage panel0Errors'>Please enter your name</p>
				</div>

				<div class='hints'>Just so we can call if necessary.</div>
				<div>
					<label for='Phone'>Phone</label>
					<input type="text" name="Phone" id="Phone" class='panel0Fields' tabindex="2" />
					<p id='PhoneError' class='ErrorMessage panel0Errors'>Please enter your phone number</p>
				</div>
				<div class='hints'>Skype is preferred if you are outside the US.</div>
				<div>
					<label for='Skype'>Skype Id</label>
					<input type="text" name="Skype" id="Skype" tabindex="3" />
					<p style='margin-left:110px;'>(optional)</p>
				</div><br/>
				<div>
					<label for='Country'>Country</label>
					<select id="Country" name="Country" class='panel0Fields' size="1" tabindex="4">
						<option value="">
							Select your country here
						</option>
						<optgroup label="common choices">
						<option value="United Kingdom">
							United Kingdom
						</option>
						<option value="United States">
							United States
						</option>
						<option value="France">
							France
						</option>
						<option value="Germany">
							Germany
						</option>
						<option value="Spain">
							Spain
						</option>
						<option value="Italy">
							Italy
						</option>
						<option value="Canada">
							Canada
						</option>
						</optgroup>
						<optgroup label="other countries">
						<option value="Afghanistan">
							Afghanistan
						</option>
						<option value="Albania">
							Albania
						</option>
						<option value="Algeria">
							Algeria
						</option>
						<option value="American Samoa">
							American Samoa
						</option>
						<option value="Andorra">
							Andorra
						</option>
						<option value="Angola">
							Angola
						</option>
						<option value="Anguilla">
							Anguilla
						</option>
						<option value="Antarctica">
							Antarctica
						</option>
						<option value="Antigua and Barbuda">
							Antigua and Barbuda
						</option>
						<option value="Argentina">
							Argentina
						</option>
						<option value="Armenia">
							Armenia
						</option>
						<option value="Aruba">
							Aruba
						</option>
						<option value="Australia">
							Australia
						</option>
						<option value="Austria">
							Austria
						</option>
						<option value="Azerbaijan">
							Azerbaijan
						</option>
						<option value="Bahamas">
							Bahamas
						</option>
						<option value="Bahrain">
							Bahrain
						</option>
						<option value="Bangladesh">
							Bangladesh
						</option>
						<option value="Barbados">
						Barbados
						</option>
						<option value="Belarus">
							Belarus
						</option>
						<option value="Belgium">
							Belgium
						</option>
						<option value="Belize">
							Belize
						</option>
						<option value="Benin">
						Benin
						</option>
						<option value="Bermuda">
							Bermuda
						</option>
						<option value="Bhutan">
							Bhutan
						</option>
						<option value="Bolivia">
							Bolivia
						</option>
						<option value="Bosnia and Herzegovina">
							Bosnia and Herzegovina
						</option>
						<option value="Botswana">
							Botswana
						</option>
						<option value="Bouvet Island">
							Bouvet Island
						</option>
						<option value="Brazil">
							Brazil
						</option>
						<option value="British Indian Ocean Territory">
							British Indian Ocean Territory
						</option>
						<option value="Brunei Darussalam">
							Brunei Darussalam
						</option>
						<option value="Bulgaria">
							Bulgaria
						</option>
						<option value="Burkina Faso">
							Burkina Faso
						</option>
						<option value="Burundi">
							Burundi
						</option>
						<option value="Cambodia">
							Cambodia
						</option>
						<option value="Cameroon">
							Cameroon
						</option>
						<option value="Canada">
							Canada
						</option>
						<option value="Cape Verde">
							Cape Verde
						</option>
						<option value="Cayman Islands">
							Cayman Islands
						</option>
						<option value="Central African Republic">
							Central African Republic
						</option>
						<option value="Chad">
							Chad
						</option>
						<option value="Chile">
							Chile
						</option>
						<option value="China">
							China
						</option>
						<option value="Christmas Island">
							Christmas Island
						</option>
						<option value="Cocos (Keeling) Islands">
							Cocos (Keeling) Islands
						</option>
						<option value="Colombia">
							Colombia
						</option>
						<option value="Comoros">
							Comoros
						</option>
						<option value="Congo">
							Congo
						</option>
						<option value="Congo, The Democratic Republic of The">
							Congo, The Demo. Repub. of The
						</option>
						<option value="Cook Islands">
							Cook Islands
						</option>
						<option value="Costa Rica">
							Costa Rica
						</option>
						<option value="Cote D'ivoire">
							Cote D'ivoire
						</option>
						<option value="Croatia">
							Croatia
						</option>
						<option value="Cuba">
							Cuba
						</option>
						<option value="Cyprus">
							Cyprus
						</option>
						<option value="Czech Republic">
							Czech Republic
						</option>
						<option value="Denmark">
							Denmark
						</option>
						<option value="Djibouti">
							Djibouti
						</option>
						<option value="Dominica">
							Dominica
						</option>
						<option value="Dominican Republic">
							Dominican Republic
						</option>
						<option value="Ecuador">
							Ecuador
						</option>
						<option value="Egypt">
							Egypt
						</option>
						<option value="El Salvador">
							El Salvador
						</option>
						<option value="Equatorial Guinea">
							Equatorial Guinea
						</option>
						<option value="Eritrea">
							Eritrea
						</option>
						<option value="Estonia">
							Estonia
						</option>
						<option value="Ethiopia">
							Ethiopia
						</option>
						<option value="Falkland Islands (Malvinas)">
							Falkland Islands (Malvinas)
						</option>
						<option value="Faroe Islands">
							Faroe Islands
						</option>
						<option value="Fiji">
							Fiji
						</option>
						<option value="Finland">
							Finland
						</option>
						<option value="France">
							France
						</option>
						<option value="French Guiana">
							French Guiana
						</option>
						<option value="French Polynesia">
							French Polynesia
						</option>
						<option value="French Southern Territories">
							French Southern Territories
						</option>
						<option value="Gabon">
							Gabon
						</option>
						<option value="Gambia">
							Gambia
						</option>
						<option value="Georgia">
							Georgia
						</option>
						<option value="Germany">
							Germany
						</option>
						<option value="Ghana">
							Ghana
						</option>
						<option value="Gibraltar">
							Gibraltar
						</option>
						<option value="Greece">
							Greece
						</option>
						<option value="Greenland">
							Greenland
						</option>
						<option value="Grenada">
							Grenada
						</option>
						<option value="Guadeloupe">
							Guadeloupe
						</option>
						<option value="Guam">
							Guam
						</option>
						<option value="Guatemala">
							Guatemala
						</option>
						<option value="Guinea">
							Guinea
						</option>
						<option value="Guinea-bissau">
							Guinea-bissau
						</option>
						<option value="Guyana">
							Guyana
						</option>
						<option value="Haiti">
							Haiti
						</option>
						<option value="Heard Island and Mcdonald Islands">
							Heard Isl and Mcdonald Isl
						</option>
						<option value="Holy See (Vatican City State)">
							Holy See (Vatican City State)
						</option>
						<option value="Honduras">
							Honduras
						</option>
						<option value="Hong Kong">
							Hong Kong
						</option>
						<option value="Hungary">
							Hungary
						</option>
						<option value="Iceland">
							Iceland
						</option>
						<option value="India">
							India
						</option>
						<option value="Indonesia">
							Indonesia
						</option>
						<option value="Iran, Islamic Republic of">
							Iran, Islamic Republic of
						</option>
						<option value="Iraq">
							Iraq
						</option>
						<option value="Ireland">
							Ireland
						</option>
						<option value="Israel">
							Israel
						</option>
						<option value="Italy">
							Italy
						</option>
						<option value="Jamaica">
							Jamaica
						</option>
						<option value="Japan">
							Japan
						</option>
						<option value="Jordan">
							Jordan
						</option>
						<option value="Kazakhstan">
							Kazakhstan
						</option>
						<option value="Kenya">
							Kenya
						</option>
						<option value="Kiribati">
							Kiribati
						</option>
						<option value="Korea, Democratic People's Republic of">
							Korea, Demo. People's Repub. of
						</option>
						<option value="Korea, Republic of">
							Korea, Republic of
						</option>
						<option value="Kuwait">
							Kuwait
						</option>
						<option value="Kyrgyzstan">
							Kyrgyzstan
						</option>
						<option value="Lao People's Democratic Republic">
							Lao People's Democratic Republic
						</option>
						<option value="Latvia">
							Latvia
						</option>
						<option value="Lebanon">
							Lebanon
						</option>
						<option value="Lesotho">
							Lesotho
						</option>
						<option value="Liberia">
							Liberia
						</option>
						<option value="Libyan Arab Jamahiriya">
							Libyan Arab Jamahiriya
						</option>
						<option value="Liechtenstein">
							Liechtenstein
						</option>
						<option value="Lithuania">
							Lithuania
						</option>
						<option value="Luxembourg">
							Luxembourg
						</option>
						<option value="Macao">
							Macao
						</option>
						<option value="Macedonia, The Former Yugoslav Republic of">
							Macedonia, Former Yugoslav
						</option>
						<option value="Madagascar">
							Madagascar
						</option>
						<option value="Malawi">
							Malawi
						</option>
						<option value="Malaysia">
							Malaysia
						</option>
						<option value="Maldives">
							Maldives
						</option>
						<option value="Mali">
							Mali
						</option>
						<option value="Malta">
							Malta
						</option>
						<option value="Marshall Islands">
							Marshall Islands
						</option>
						<option value="Martinique">
							Martinique
						</option>
						<option value="Mauritania">
							Mauritania
						</option>
						<option value="Mauritius">
							Mauritius
						</option>
						<option value="Mayotte">
							Mayotte
						</option>
						<option value="Mexico">
							Mexico
						</option>
						<option value="Micronesia, Federated States of">
							Micronesia, Federated States of
						</option>
						<option value="Moldova, Republic of">
							Moldova, Republic of
						</option>
						<option value="Monaco">
							Monaco
						</option>
						<option value="Mongolia">
							Mongolia
						</option>
						<option value="Montserrat">
							Montserrat
						</option>
						<option value="Morocco">
							Morocco
						</option>
						<option value="Mozambique">
							Mozambique
						</option>
						<option value="Myanmar">
							Myanmar
						</option>
						<option value="Namibia">
							Namibia
						</option>
						<option value="Nauru">
							Nauru
						</option>
						<option value="Nepal">
							Nepal
						</option>
						<option value="Netherlands">
							Netherlands
						</option>
						<option value="Netherlands Antilles">
							Netherlands Antilles
						</option>
						<option value="New Caledonia">
							New Caledonia
						</option>
						<option value="New Zealand">
							New Zealand
						</option>
						<option value="Nicaragua">
							Nicaragua
						</option>
						<option value="Niger">
							Niger
						</option>
						<option value="Nigeria">
							Nigeria
						</option>
						<option value="Niue">
							Niue
						</option>
						<option value="Norfolk Island">
							Norfolk Island
						</option>
						<option value="Northern Mariana Islands">
							Northern Mariana Islands
						</option>
						<option value="Norway">
							Norway
						</option>
						<option value="Oman">
							Oman
						</option>
						<option value="Pakistan">
							Pakistan
						</option>
						<option value="Palau">
							Palau
						</option>
						<option value="Palestinian Territory, Occupied">
							Palestinian Territory, Occupied
						</option>
						<option value="Panama">
							Panama
						</option>
						<option value="Papua New Guinea">
							Papua New Guinea
						</option>
						<option value="Paraguay">
							Paraguay
						</option>
						<option value="Peru">
							Peru
						</option>
						<option value="Philippines">
							Philippines
						</option>
						<option value="Pitcairn">
							Pitcairn
						</option>
						<option value="Poland">
							Poland
						</option>
						<option value="Portugal">
							Portugal
						</option>
						<option value="Puerto Rico">
							Puerto Rico
						</option>
						<option value="Qatar">
							Qatar
						</option>
						<option value="Reunion">
							Reunion
						</option>
						<option value="Romania">
							Romania
						</option>
						<option value="Russian Federation">
							Russian Federation
						</option>
						<option value="Rwanda">
							Rwanda
						</option>
						<option value="Saint Helena">
							Saint Helena
						</option>
						<option value="Saint Kitts and Nevis">
							Saint Kitts and Nevis
						</option>
						<option value="Saint Lucia">
							Saint Lucia
						</option>
						<option value="Saint Pierre and Miquelon">
							Saint Pierre and Miquelon
						</option>
						<option value="Saint Vincent and The Grenadines">
							Saint Vincent and The Grenadines
						</option>
						<option value="Samoa">
							Samoa
						</option>
						<option value="San Marino">
							San Marino
						</option>
						<option value="Sao Tome and Principe">
							Sao Tome and Principe
						</option>
						<option value="Saudi Arabia">
							Saudi Arabia
						</option>
						<option value="Senegal">
							Senegal
						</option>
						<option value="Serbia and Montenegro">
							Serbia and Montenegro
						</option>
						<option value="Seychelles">
							Seychelles
						</option>
						<option value="Sierra Leone">
							Sierra Leone
						</option>
						<option value="Singapore">
							Singapore
						</option>
						<option value="Slovakia">
							Slovakia
						</option>
						<option value="Slovenia">
							Slovenia
						</option>
						<option value="Solomon Islands">
							Solomon Islands
						</option>
						<option value="Somalia">
							Somalia
						</option>
						<option value="South Africa">
							South Africa
						</option>
						<option value="South Georgia and The South Sandwich Islands">
							South Georgia &amp; S. Sandwich Isls
						</option>
						<option value="Spain">
							Spain
						</option>
						<option value="Sri Lanka">
							Sri Lanka
						</option>
						<option value="Sudan">
							Sudan
						</option>
						<option value="Suriname">
							Suriname
						</option>
						<option value="Svalbard and Jan Mayen">
							Svalbard and Jan Mayen
						</option>
						<option value="Swaziland">
							Swaziland
						</option>
						<option value="Sweden">
							Sweden
						</option>
						<option value="Switzerland">
							Switzerland
						</option>
						<option value="Syrian Arab Republic">
							Syrian Arab Republic
						</option>
						<option value="Taiwan, Province of China">
							Taiwan, Province of China
						</option>
						<option value="Tajikistan">
							Tajikistan
						</option>
						<option value="Tanzania, United Republic of">
							Tanzania, United Republic of
						</option>
						<option value="Thailand">
							Thailand
						</option>
						<option value="Timor-leste">
							Timor-leste
						</option>
						<option value="Togo">
							Togo
						</option>
						<option value="Tokelau">
							Tokelau
						</option>
						<option value="Tonga">
							Tonga
						</option>
						<option value="Trinidad and Tobago">
							Trinidad and Tobago
						</option>
						<option value="Tunisia">
							Tunisia
						</option>
						<option value="Turkey">
							Turkey
						</option>
						<option value="Turkmenistan">
							Turkmenistan
						</option>
						<option value="Turks and Caicos Islands">
							Turks and Caicos Islands
						</option>
						<option value="Tuvalu">
							Tuvalu
						</option>
						<option value="Uganda">
							Uganda
						</option>
						<option value="Ukraine">
							Ukraine
						</option>
						<option value="United Arab Emirates">
							United Arab Emirates
						</option>
						<option value="United Kingdom">
							United Kingdom
						</option>
						<option value="United States">
							United States
						</option>
						<option value="United States Minor Outlying Islands">
							United States Minor Outlying Islands
						</option>
						<option value="Uruguay">
							Uruguay
						</option>
						<option value="Uzbekistan">
							Uzbekistan
						</option>
						<option value="Vanuatu">
							Vanuatu
						</option>
						<option value="Venezuela">
							Venezuela
						</option>
						<option value="Viet Nam">
							Viet Nam
						</option>
						<option value="Virgin Islands, British">
							Virgin Islands, British
						</option>
						<option value="Virgin Islands, U.S.">
							Virgin Islands, U.S.
						</option>
						<option value="Wallis and Futuna">
							Wallis and Futuna
						</option>
						<option value="Western Sahara">
							Western Sahara
						</option>
						<option value="Yemen">
							Yemen
						</option>
						<option value="Zambia">
							Zambia
						</option>
						<option value="Zimbabwe">
							Zimbabwe
						</option>
						</optgroup>
					</select><br/>
					<p id='CountryError' class='ErrorMessage panel0Errors'>Please enter where you live</p>
				</div>
				<div class='hints'>We promise to keep it private.</div>
				<div>
					<label for='Email'>Email</label>
					<input type="text" name="Email" id="Email" class='panel0Fields' tabindex="5" />
					<p id='EmailError' class='ErrorMessage panel0Errors'>Please enter your email address</p>
					<p id='EmailFormatError' class='ErrorMessage panel0Errors' style='margin-top:0px;'>Must be in mailbox@domain format</p>
				</div>
		</div> <!-- end of Content0 -->
	</div>
	<div id='Container1' class='panel nonFeedback'>
		<h3 id='FormH3Label1' title='Your Funding Need' class='nonFeedback'><a href='#'></a></h3>
		<div id="Content1" class='panelContent nonFeedback'>
				<label for='Category'>Request</label>
				<select name="Category" id="Category" class='panel1Fields' size="1" tabindex="10"> <!-- onchange='LoanApp(Category)' -->
					<option value=''>Select</option>
					<option value='POF'>Proof Of Funds</option>
					<option value='SBLC'>SBLC Lease</option>
					<option value='BG'>Bank Guarantee Lease</option>
					<option value='PPP'>Private Placement Program</option>
					<option value='MTN'>MTN Lease</option>
					<option value='Loan'>Commercial Loan</option>
					<option value='Other'>Other</option>
				</select>
					<p id='CategoryError' class='ErrorMessage'>Please specify funding type</p>
				<div class='hints'>Our <em>minimum</em> amount for most transactions is 1 000 000.</div>
				<div id='AmountField'>
					<label for='Amount'>Amount</label>
					<input type="text" value='$1 000 000' name="Amount" id="Amount" class='RequestField' maxlength="50" tabindex="11" />
					<p id='AmountError' class='ErrorMessage'>What amount are you are requesting?</p>
				</div>
				<div id='DollarSymbol'></div>
				<div id='EuroSymbol'></div>

					<label id='ccc' for='CurrencyType'>Currency</label> <div id='CurrencyType'></div>

				<div id='SwiftType'>
					<div style='margin-left:5px;'><p>Swift Message Type</p></div>
					<label for='None'><input id='None' name='SwiftType' onfocus='this.blur()' class="sw-button" type="radio" checked='checked' /> Not Needed</label><br/>
					<label for='MT799'><input id='MT799' name='SwiftType' onfocus='this.blur()' class="sw-button" type="radio" /> Send a MT799</label><br/>
					<label for='MT760'><input id='MT760' name='SwiftType' onfocus='this.blur()' class="sw-button" type="radio" /> Send a MT760</label>
				</div>

				<div id='TermLength' style='height:20px;width:230px;'>
					<p><label for='LengthBox'>Length</label><input type='text' value='12' name="LengthBox" id="LengthBox"
					class='RequestField' tabindex="18"  />Months</p>
					<p id='LengthError' style='margin-top:9px;' class='ErrorMessage'>How long a term are you requesting?</p>
				</div>
		</div><!-- end of Content1 -->
	</div>
	<div id='Container2' class='panel nonFeedback'>
		<h3 id='FormH3Label2' title='Your Objective'><a href='#'></a></h3>
		<div id="Content2" class='panelContent nonFeedback'><br/>
			<label for='Comments'>Describe in detail your request (double-click<span class='Highlight'> inside box </span>for more room)</label>
			<textarea name="Comments" class='panel2Fields' tabindex="20" cols='80' rows='12' id="Comments"
			onfocus="this.style.border='1px solid #00f';"
			onblur="this.style.border='1px solid silver';">
</textarea>
			<div id='CommentsEdiv'>
				<p id='CommentsError'  class='ErrorMessage panel2Errors'>We need some details about your transaction</p>

				<div id='CodeDiv'>
					<img id='CodeImage' alt='' title='verification code' src='./captcha/CaptchaSecurityImages.php' />
					<br/>The Code
				</div>
				<div id='CaptchaDiv'>
					<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Copy The Code<br/>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="text" name="Captcha" id="Captcha" class='panel2Fields' tabindex="21"  maxlength="6" size="36"
					onfocus="this.style.border='1px solid #00f'" onblur="this.style.border='1px solid silver'" /></p>
					<p id='CaptchaError' class='ErrorMessage panel2Errors'>Please copy the code</p>
					<p id='CaptchaCopyError' class='ErrorMessage panel2Errors'>Double-check the code</p>
				</div>
			</div>
			<div id='ButtonDiv'>
			<button id="SendRequestButton" type="submit" tabindex="100">Send</button> <span id='Return'></span><br/><br/><br/>
				<button id="CancelRequestButton"  type="reset" tabindex="110">Clear</button><br/>
			</div>
		</div>
	</div><!-- end of Content -->
</div>
</form>
<div id='instructions'><p>Please check that all the fields are complete before sending</p></div>
<?php include("include/bottom.php"); ?>
<script src='./js/FundingRequest_js.php'></script>
</body>
</html>
