<!DOCTYPE html>
<html>
<head>
<title>CIS Form</title>
<meta charset=utf-8>
<meta name="copyright" content="Copyright 2006, Anthony Ferlazzo, Pronto Commercial Funding" >
<meta name="rating" content="General" >
<meta name="robots" content="Index, ALL, follow" >
  <meta name="OWNER" content="Pronto Commercial Funding" >
  <link rel="SHORTCUT ICON" href="http://www.prontocommercial.com/favicon.ico" >
<?php include("include/head.php"); ?>
<link rel='stylesheet' href='./css/CISform.css' >
</head>
<body>
<?php include("include/top.php"); ?>
	<div id='directions'></div>
		<div id='carouselControls2'>
			<div id='nextTab' title='Go to the next part of the Funding Request form'></div>
			<div id='pointers' style='position:absolute;left:35px;margin-top:-4px;'></div>
		</div>
	<form id='formCISform' action="#" method="post">
		<div id='controlTablet'>
			<div id="cisTabs" class="ui-tabs">
				<ul>
					<li><a href="#cisContact">Contact</a></li>
					<li><a href="#cisCompany">Company</a></li>
					<li><a href="#cisService">Request</a></li>
					<li><a href="#cisBank">Receiving Bank</a></li>
					<li><a href="#cisUse">Use</a></li>
				</ul>

					<div id='cisContact' class='controlsDiv'><!-- cisContact - Part 1 -->
						<label for='Principal'>Principal Name</label><input name="Principal" id="Principal" ><br >
						<label for='Passport'>Passport Number</label><input type='text' name="Passport" id="Passport" ><br >
						<label for='Expiration'>Expiration Date</label><input type='text' name="Expiration" id="Expiration" ><br >
						<label for='DOB'>Date Of Birth</label><input type='text' name="DOB" id="DOB" ><br >
						<label for='Address'>Permanent Address</label><input type='text' name="Address" id="Address" ><br >
						<label for='City'>City</label><input type='text' name="City" id="City" ><br >
						<label for='State'>State</label><input type='text' name="State" id="State" ><br >
						<label for='Country' class='countryRightMargin'>Country</label>
							<select name="Country" id="Country" size="1">
									<option value="" selected='selected'>
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
							</select>
						<label for='Phone1'>Primary Phone Number</label><input type='text' name="Phone1" id="Phone1" ><br >
						<label for='Phone2'>Second Phone Number</label><input type='text' name="Phone2" id="Phone2" ><br >
						<label for='Email'>Email Address</label><input type='text' name="Email" id="Email" ><br >
					</div><!-- end Part 1 -->

					<div id='cisCompany' class='controlsDiv ui-tabs-hide'><!-- Company - Part 2 -->
						<label for='cName'>Company Name</label><input type='text' name="cName" id="cName" ><br >
						<div>
							<label for='cStructure'>Business Structure</label>
							<select name="cStructure" id="cStructure" onchange='checkS(this.value);'>
								<option value='x' selected='selected'>Select One</option>
								<option>Individual</option>
								<option>Corporation</option>
								<option>LLC</option>
								<option>Company - Other</option>
							</select><br>
						</div>
						<label for='cType'>Business Type</label><input type='text' name="cType" id="cType" ><br >
						<label for='cAddress'>Company Address</label><input type='text' name="cAddress" id="cAddress" ><br >
						<label for='cCity'>Company City</label><input type='text' name="cCity" id="cCity" ><br >
						<label for='cState'>Company State</label><input type='text' name="cState" id="cState" ><br >
						<div>
							<label for='cCountry' class='countryRightMargin'>Country</label>
							<select name="cCountry" id="cCountry" size="1">
									<option value="" selected='selected'>
										Select the company's country here
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
							</select>
						</div>
						<label for='cPhone'>Telephone Number</label><input type='text' name="cPhone" id="cPhone" ><br >
						<label for='cFax'>Fax Number</label><input type='text' name="cFax" id="cFax" ><br >
						<label for='pIncorp'>Place of Incorporation</label><input type='text' name="pIncorp" id="pIncorp" ><br >
						<label for='dIncorp'>Date of Incorporation</label><input type='text' name="dIncorp" id="dIncorp" ><br >
						<label for='ID'>Employer ID Number</label><input type='text' name="ID" id="ID" >
					</div><!-- end Part 2 -->

					<div id='cisService' class='controlsDiv ui-tabs-hide'><!-- Funding Request - Part 3 -->
						<label for='Category'>Your Need</label><select name='Category' id='Category'>
							<option value='x' selected='selected'>Select One</option>
							<option value='POF'>Proof Of Funds</option>
							<option value='Lease'>Lease An Instrument</option>
							<option value='Finance'>Finance An Instrument</option>
							<option value='PPP'>Private Placement Program</option>
							<option value='Loan'>Commercial Loan</option>
							<option value='Other'>Other</option>
						</select>
						<label for='Amount'>Amount</label><input type='text' name="Amount" id="Amount"><br >
						<label for='Term'>Desired Leasing Term</label><input type='text' name="Term" id="Term" ><br >
						<label for='DesiredClose'>Desired Closing Date</label><input type='text' name="DesiredClose" id="DesiredClose" ><br >
						<div id='tt'>
							<span class='bType'>Bank Must be in Top-25</span>
							<input type='radio' id='ty' name='Top25' class='Top25' ><label for='ty'>Yes</label>
							<input type='radio' id='tn' name='Top25' class='Top25' checked='checked' ><label for='tn'>No</label>
						</div>
						<br ><label for='DesiredBank'>Desired Bank Name</label><input type='text' name="DesiredBank" id="DesiredBank" ><br >
						<div id='messageType'>
							<span class='bType'>SWIFT Message Required</span><br >
							<input type='radio' id='m1' class='MessageType' name='MessageType' checked='checked' onchange='checkM(this.value);'><label for='m1'>None</label><br >
							<input type='radio' id='m2' class='MessageType' name='MessageType' onchange='checkM(this.value);'><label for='m2'>MT-799</label><br >
							<input type='radio' id='m3' class='MessageType' name='MessageType' onchange='checkM(this.value);'><label for='m3'>MT-760</label><br >
						</div>
					</div><!-- end Part 3 -->

					<div    id='cisBank' class='controlsDiv ui-tabs-hide'><!-- Bank - Part 4 -->
						<label for='BankName'>Bank Name</label><input type='text' name="BankName" id="BankName" ><br >
						<label for='BankAddress'>Bank Address</label><input type='text' name="BankAddress" id="BankAddress" ><br >
						<label for='Swift'>SWIFT Code</label><input type='text' name="Swift" id="Swift" ><br >
						<label for='OfficerName'>Bank Officer Name</label><input type='text' name="OfficerName" id="OfficerName" ><br >
						<label for='bPhone'>Telephone Number</label><input type='text' name="bPhone" id="bPhone" ><br >
						<label for='bFax'>Fax Number</label><input type='text' name="bFax" id="bFax" ><br >

						<label for='beName'>Beneficiary Name</label><input type='text' name="beName" id="beName" ><br >
						<label for='AccountNumber'>Account Number</label><input type='text' name="AccountNumber" id="AccountNumber" ><br >
						<label for='Routing'>Routing Code</label><input type='text' name="Routing" id="Routing"><br >
						<label for='AccountName'>Account Name</label><input type='text' name="AccountName" id="AccountName" ><br >
						<label for='AccountSignatory'>Account Signatory</label><input type='text' name="AccountSignatory" id="AccountSignatory" >
					</div><!-- end Part 4 -->

					<div     id='cisUse' class='controlsDiv ui-tabs-hide'><!-- Use of Funds - Part 5 -->
						<div style='margin-top:0;width:100%;text-align:center;'>
							<textarea cols='100' rows='22' name='instrumentUse'>Provide a detailed description of how you will be using the account or bank instrument here. Provide ALL necessary information including payment and delivery plans.</textarea>
						</div>
						<input type='button' value='Send CIS' id="cisSendRequestButton">&nbsp;<span id='cisFormReturn'></span>
					</div><!-- end Part 5 -->
			</div> <!-- cisTabs -->
		</div> <!-- controlTablet -->
	</form>
<?php include("./include/bottom.php"); ?>
<script src='./js/CISform.js'></script>
</body>
</html>
