<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Loan Application - Pronto Commercial Funding</title>
	<meta http-equiv="Content-Type" content="text/html; charset=us-ascii"/>
	<meta name="copyright" content=
	"Copyright 2006, Anthony Ferlazzo, Pronto Commercial Funding"/>
	<meta name="rating" content="General"/>
	<meta name="robots" content="Index, ALL, follow"/>
	<meta name="keywords" content=
	"commercial mortgage, commercial leasing, equipment leasing, commercial loans,commercial real estate loans, commercial mortgages, Broker, Brokerage, commercial real estate, Commercial, commercial lender, commercial lender magazine, commercial lenders, Debt, Finance, Financial, Financing, find mortgage, fixed rates, Funding, Investment, Land, loan, loans, Lend, Lender, Loan, loan applications, Loans, LTV, Money, mortgage banking, Mortgage, mortgage, mortgage banking, Mortgages, online lenders, Real Estate, real estate lenders, real estate loans, commercial real estate loans, commercial mortgages, commercial real estate, sba loan, small business loan, loan, loans, property loan, property lending, sba, small business administration"/>
	<meta name="description" content=
	"Commercial Property Lenders - SBA Loans, Property Loans, SBA Loan Specialists.."/>
	<meta name="OWNER" content=" Pronto Commercial Funding"/>
	<link rel="shortcut icon" href="favicon.ico"/>
<?php include("include/Head.php"); ?>
<script type="text/javascript">
function ShowInfo(did)
{
	document.getElementById(did).style.display='block';

	if (did =='Pinfo')
	{
		HideInfo('Rinfo');
		HideInfo('Cinfo');
		HideInfo('CNinfo');
		document.getElementById('App').style.height='1140px';
		//document.getElementById('ContentBackground').style.height='1300px';
		//document.getElementById('ContentDIV').style.height='1230px';
		//document.getElementById('ContentBackground').style.backgroundColor='red';
	}

	if (did =='Cinfo')
	{
		document.getElementById('Ctitle').style.display='block';
		document.getElementById('Rtitle').style.display='none';

		document.getElementById('Rinfo').style.display='block';
		document.getElementById('Rinfo').style.height='340px';
		HideInfo('Pinfo');
		HideInfo('CNinfo');
		//document.getElementById('App').style.height='1260px';
		document.getElementById('App').style.height='1350px';
		//document.getElementById('ContentBackground').style.height='1520px';
		//document.getElementById('ContentDIV').style.height='1370px';
	}

	if (did =='Rinfo')
	{
		document.getElementById('Rinfo').style.height='300px';
		document.getElementById('Ctitle').style.display='none';
		document.getElementById('Rtitle').style.display='block';

		HideInfo('Pinfo');
		HideInfo('Cinfo');
		HideInfo('CNinfo');
		document.getElementById('App').style.height='1300px';
		//document.getElementById('ContentBackground').style.height='1520px';
		//document.getElementById('ContentDIV').style.height='1390px';
	}
	if (did =='CNinfo')
	{
		document.getElementById('Ctitle').style.display='none';
		document.getElementById('Rtitle').style.display='none';

		HideInfo('Rinfo');
		HideInfo('Pinfo');
		HideInfo('Cinfo');
		document.getElementById('App').style.height='1280px';
		//document.getElementById('App').style.backgroundColor='red';
		//document.getElementById('ContentBackground').style.height='1440px';
		//document.getElementById('ContentDIV').style.height='1360px';
	}
}
function HideInfo(did)
{
	document.getElementById(did).style.display='none';
}
function Validate()
{
	if (document.AppForm.Pname.value == '')
	{
		alert('Please enter your name');
		document.AppForm.Pname.focus();
		return (false);
	}
	if (document.AppForm.Email.value == '')
	{
		alert('Please enter your email address');
		document.AppForm.Email.focus();
		return (false);
	}
	if (document.AppForm.Ophone.value == '')
	{
		alert('Please enter your primary (office) phone number');
		document.AppForm.Ophone.focus();
		return (false);
	}
	return(true);
}
function CheckPurpose()
{
if (document.AppForm.Purpose[0].checked)
	ShowInfo('Pinfo');

if (document.AppForm.Purpose[1].checked)
	ShowInfo('Rinfo');

if (document.AppForm.Purpose[2].checked)
	ShowInfo('Cinfo');

if (document.AppForm.Purpose[3].checked)
	ShowInfo('CNinfo');
}
</script>
<style type="text/css">
div#App {margin:20px 0 0 0;text-align:left;width:690px;padding:0;background:transparent;height:1000px;}
/*div#ContentBackground {height:1250px;}*/
div.A1, div.B1, div.C1, div.F1, div.G1 {text-align:left;height:22px;float:left;padding:4px;font-size:10pt;white-space:nowrap;}
div.A1 {width:339px;background:transparent;}
div.B1 {width:160px;}
div.C1 {width:126px;}
div.F1 {width:280px;}
div.G1 {width:220px;}
div.D1 {text-align:right;width:110px;height:22px;float:left;padding:4px;font-size:10pt;}
div.E1 {text-align:right;width:156px;height:22px;float:left;padding:4px;font-size:10pt;}
p.sh {font-size:10pt;vertical-align:top;margin:0;}
.Label {margin-top:14px;display:block;}
input {margin:0;padding:0;background:#D9DDF9;}
.Radio {margin:0 4px 0 0;background:transparent;}
#Pinfo, #Rinfo, #Cinfo, #CNinfo {display:none;}
#Pinfo {height:140px;margin:0;background:transparent;}
#Rinfo {height:300px;margin:0;background:transparent;}
#Cinfo {height:440px;margin:0;background:transparent;}
#CNinfo {height:270px;margin:0;background:transparent;}
#AppForm {margin:0;padding:0;}
h1 {margin:0 0 10px 0;}

input#Submit, input#Cancel {width:60px;}
</style>
</head>
<body onload='CheckPurpose();'>
<?php include("include/top.php"); ?>

				<form id='AppForm' name='AppForm' style=
				'background:transparent;padding:0 0 0 20px;' method="post"
				onsubmit='return(Validate());' action=
				'https://cl139.justhost.com/~prontoc2/LoanApplicationAction.php'>
					<div id='App'>
						<h1>Commercial Mortgage Loan Application</h1><!--
<h2>Pronto Commercial Funding Loan Application</h2>

<div style='height:50px;'>
<div class='D1'></div>
<div class='B1'>2114 Delucchi Dr</div>
<div class='D1'>Phone</div>
<div class='G1'>(925) 399-5359</div>
<div class='D1' style='clear:left;'></div>
<div class='B1'>Pleasanton, CA 94588</div>
<div class='D1'>Fax</div>
<div class='G1'>(925) 215-4577</div>
</div>
<br style='clear:left;'>
-->

						<h2>Borrower Information</h2>

						<div style=
						'background:transparent;height:340px;width:695px;'>
							<div class='D1' style='text-align:bottom;'>
								Borrowing Entity
							</div>

							<div class='F1'>
								<input type='text' name='Entity' id='Entity'
								style='width:252px;'>
							</div>

							<div class='F1' style='width:298px;'>
								<input type='radio' class='Radio' name=
								'EntityType' id='EntityType' value=
								'Individual'>Individual <input type='radio'
								class='Radio' name='EntityType' id='EntityType'
								value='Partnership'>Partnership <input type=
								'radio' class='Radio' name='EntityType' id=
								'EntityType' value='Corporation'>Corporation
							</div><br style='clear:left;'>

							<div class='D1'>
								Mailing Address
							</div>

							<div class='F1'>
								<input type='text' name='Address' id='Address'
								style='width:252px;'>
							</div>

							<div class='C1'>
								Years in Business
							</div>

							<div class='B1' style='width:40px;'>
								<input type='text' name='Years' id='Years'
								style='width:30px;'>
							</div><br style='clear:left;'>

							<div class='D1'>
								City
							</div>

							<div class='F1'>
								<input type='text' name='City' id='City' style=
								'width:252px;'>
							</div>

							<div class='D1' style=
							'width:36px;text-align:bottom;'>
								State
							</div>

							<div class='D1' style='width:88px;'>
								<select name='State' id='State'>
									<option selected value=''>
										Select One
									</option>

									<option value="AK">
										AK
									</option>

									<option value="AL">
										AL
									</option>

									<option value="AR">
										AR
									</option>

									<option value="AZ">
										AZ
									</option>

									<option value="CA">
										CA
									</option>

									<option value="CO">
										CO
									</option>

									<option value="CT">
										CT
									</option>

									<option value="DC">
										DC
									</option>

									<option value="DE">
										DE
									</option>

									<option value="FL">
										FL
									</option>

									<option value="GA">
										GA
									</option>

									<option value="HI">
										HI
									</option>

									<option value="IA">
										IA
									</option>

									<option value="ID">
										ID
									</option>

									<option value="IL">
										IL
									</option>

									<option value="IN">
										IN
									</option>

									<option value="KS">
										KS
									</option>

									<option value="KY">
										KY
									</option>

									<option value="LA">
										LA
									</option>

									<option value="MA">
										MA
									</option>

									<option value="MD">
										MD
									</option>

									<option value="ME">
										ME
									</option>

									<option value="MI">
										MI
									</option>

									<option value="MN">
										MN
									</option>

									<option value="MO">
										MO
									</option>

									<option value="MS">
										MS
									</option>

									<option value="MT">
										MT
									</option>

									<option value="NC">
										NC
									</option>

									<option value="ND">
										ND
									</option>

									<option value="NE">
										NE
									</option>

									<option value="NH">
										NH
									</option>

									<option value="NJ">
										NJ
									</option>

									<option value="NM">
										NM
									</option>

									<option value="NV">
										NV
									</option>

									<option value="NY">
										NY
									</option>

									<option value="OH">
										OH
									</option>

									<option value="OK">
										OK
									</option>

									<option value="OR">
										OR
									</option>

									<option value="PA">
										PA
									</option>

									<option value="RI">
										RI
									</option>

									<option value="SC">
										SC
									</option>

									<option value="SD">
										SD
									</option>

									<option value="TN">
										TN
									</option>

									<option value="TX">
										TX
									</option>

									<option value="UT">
										UT
									</option>

									<option value="VA">
										VA
									</option>

									<option value="VT">
										VT
									</option>

									<option value="WA">
										WA
									</option>

									<option value="WI">
										WI
									</option>

									<option value="WV">
										WV
									</option>

									<option value="WY">
										WY
									</option>
								</select>
							</div>

							<div class='D1' style='width:36px;'>
								Zip
							</div>

							<div class='D1' style='width:56px;'>
								<input type='text' name='Zip' id='Zip' style=
								'width:70px;'>
							</div><br style='clear:left;'>

							<div class='F1' id='EntityType' style=
							'text-align:center;'>
								Principal or Guarantor Name
							</div>

							<div class='B1' style='width:90px;'>
								Ownership %
							</div>

							<div class='B1' style=
							'width:90px;text-align:center;'>
								Net Worth
							</div>

							<div class='B1' style='width:90px;'>
								Liquid Assets
							</div>

							<div class='B1' style='width:90px;'>
								Credit Rating
							</div>

							<div class='F1'>
								<input type='text' name='Name1' style=
								'width:270px;'>
							</div>

							<div class='B1' style='width:90px;'>
								<input type='text' name='Percentage1' style=
								'width:82px;'>
							</div>

							<div class='B1' style='width:90px;'>
								<input type='text' name='NetWorth1' style=
								'width:82px;'>
							</div>

							<div class='B1' style='width:90px;'>
								<input type='text' name='LiquidAssets1' style=
								'width:82px;'>
							</div>

							<div class='B1' style='width:90px;'>
								<input type='text' name='Credit1' style=
								'width:82px;'>
							</div>

							<div class='F1'>
								<input type='text' name='Name2' style=
								'width:270px;'>
							</div>

							<div class='B1' style='width:90px;'>
								<input type='text' name='Percentage2' style=
								'width:82px;'>
							</div>

							<div class='B1' style='width:90px;'>
								<input type='text' name='NetWorth2' style=
								'width:82px;'>
							</div>

							<div class='B1' style='width:90px;'>
								<input type='text' name='LiquidAssets2' style=
								'width:82px;'>
							</div>

							<div class='B1' style='width:90px;'>
								<input type='text' name='Credit2' style=
								'width:82px;'>
							</div>

							<div class='F1'>
								<input type='text' name='Name3' style=
								'width:270px;'>
							</div>

							<div class='B1' style='width:90px;'>
								<input type='text' name='Percentage3' style=
								'width:82px;'>
							</div>

							<div class='B1' style='width:90px;'>
								<input type='text' name='NetWorth3' style=
								'width:82px;'>
							</div>

							<div class='B1' style='width:90px;'>
								<input type='text' name='LiquidAssets3' style=
								'width:82px;'>
							</div>

							<div class='B1' style='width:90px;'>
								<input type='text' name='Credit3' style=
								'width:82px;'>
							</div>

							<div class='F1'>
								<input type='text' name='Name4' style=
								'width:270px;'>
							</div>

							<div class='B1' style='width:90px;'>
								<input type='text' name='Percentage4' style=
								'width:82px;'>
							</div>

							<div class='B1' style='width:90px;'>
								<input type='text' name='NetWorth4' style=
								'width:82px;'>
							</div>

							<div class='B1' style='width:90px;'>
								<input type='text' name='LiquidAssets4' style=
								'width:82px;'>
							</div>

							<div class='B1' style='width:90px;'>
								<input type='text' name='Credit4' style=
								'width:82px;'>
							</div>

							<div style=
							'clear:left;width:470px;padding:4px;float:left;text-align:bottom;'>
							Has any Borrower had a foreclosure or bankruptcy in
							the last 5 years?
							</div>

							<div class='C1'>
								<input type='radio' class='Radio' name='PastBK'
								id='PastBK' value='Yes'>Yes <input type='radio'
								class='Radio' name='PastBK' id='PastBK' value=
								'No'>No
							</div>

							<div style=
							'clear:left;width:470px;padding:4px;float:left;text-align:bottom;'>
							Has any Borrower had a derogatory public record in
							the last 5 years?
							</div>

							<div class='C1'>
								<input type='radio' class='Radio' name=
								'PastDerog' id='PastDerog' value='Yes'>Yes
								<input type='radio' class='Radio' name=
								'PastDerog' id='PastDerog' value='No'>No
							</div>
						</div><br/>

						<h2>Loan Information</h2>

						<div style=
						'background:transparent;height:80px;padding:4px;margin:0;'>
						<p class='sh'>Project Description</p><input type='text'
							id='Description' name='Description' style=
							'width:655px;'>

							<div class='C1' style='margin:4 0 -4;'>
								Loan Purpose
							</div>

							<div class='C1' id='PinfoButton'>
								<input type='radio' class='Radio' name=
								'Purpose' value='Purchase' onclick=
								"ShowInfo('Pinfo');">Purchase
							</div>

							<div class='C1' id='RinfoButton'>
								<input type='radio' class='Radio' name=
								'Purpose' value='Refinance' onclick=
								"ShowInfo('Rinfo');">Refinance
							</div>

							<div class='C1' id='CinfoButton'>
								<input type='radio' class='Radio' name=
								'Purpose' value='Cashout' onclick=
								"ShowInfo('Cinfo');">Cashout
							</div>

							<div class='C1' id='CNinfoButton'>
								<input type='radio' class='Radio' name=
								'Purpose' value='Construction' onclick=
								"ShowInfo('CNinfo');">Construction
							</div>
						</div>

						<div id='Pinfo'>
							<h2>Purchase</h2>

							<div class='A1' style='height:110px;'>
								<div class='E1'>
									Purchase Price $
								</div>

								<div class='B1'>
									<input type='text' name='Price' id='Price'
									style='width:150px;'>
								</div>

								<div class='E1' style='clear:both;'>
									Earnest Money $
								</div>

								<div class='B1'>
									<input type='text' name='Earnest' id=
									'Earnest' style='width:150px;'>
								</div>

								<div class='E1' style='clear:both;'>
									Down Payment $
								</div>

								<div class='B1'>
									<input type='text' name='DownPayment' id=
									'DownPayment' style='width:150px;'>
								</div>
							</div>

							<div class='A1' style=
							'height:110px;background:transparent;width:334px;'>
								<div class='E1'>
									In Contract
								</div>

								<div class='B1'>
									<input type='radio' class='Radio' name=
									'Contract' id='Contract' value='Yes'>Yes
									<input type='radio' class='Radio' name=
									'Contract' id='Contract' value='No'>No
								</div>

								<div class='E1' style='clear:both;'>
									Desired Closing
								</div>

								<div class='B1'>
									<select name='Closing' id='Closing'>
										<option selected value=''>
											Select One
										</option>

										<option>
											30 days or less
										</option>

										<option>
											60 days
										</option>

										<option>
											90 days
										</option>

										<option>
											120 days
										</option>
									</select>
								</div>

								<div class='E1' style='clear:both;'>
									Seller Could Finance
								</div>

								<div class='B1'>
									<input type='radio' class='Radio' name=
									'SellerF' id='SellerF' value='Yes'>Yes
									<input type='radio' class='Radio' name=
									'SellerF' id='SellerF' value='No'>No
								</div>
							</div>
						</div>

						<div id='Rinfo'>
							<h2 id='Rtitle'>Refinance</h2>

							<h2 id='Ctitle'>Cash-Out Refinance</h2>

							<div class='A1' style='height:216px;'>
								<div class='E1'>
									Purchase Price $
								</div>

								<div class='B1'>
									<input type='text' name='cPprice' id=
									'cPprice' style='width:150px;'>
								</div>

								<div class='E1' style='clear:both;'>
									Last Appraised Value $
								</div>

								<div class='B1'>
									<input type='text' name='cLAvalue' id=
									'cLAvalue' style='width:150px;'>
								</div>

								<div class='E1' style='clear:both;'>
									Current Balance $
								</div>

								<div class='B1'>
									<input type='text' name='cCbalance' id=
									'cCbalance' style='width:150px;'>
								</div>

								<div class='E1' style='clear:both;'>
									Monthly Payment $
								</div>

								<div class='B1'>
									<input type='text' name='cMpayment' id=
									'cMpayment' style='width:150px;'>
								</div>

								<div class='E1' style='clear:both;'>
									Pre-Payment Penalty
								</div>

								<div class='B1'>
									<input type='radio' class='Radio' name=
									'cPPP' id='cPPP' value='Yes'>Yes
									<input type='radio' class='Radio' name=
									'cPPP' id='cPPP' value='No'>No
								</div>

								<div class='E1' style='clear:both;'>
									Cost of Improvements $<br>
									Made   
								</div>

								<div class='B1'>
									<input type='text' name='cIcost' id=
									'cIcost' style='width:150px;'>
								</div>
							</div>

							<div class='A1' style='height:216px;width:334px;'>
								<div class='E1'>
									Date Purchased
								</div>

								<div class='B1'>
									<input type='text' name='cPdate' id=
									'cPdate' style='width:150px;'>
								</div>

								<div class='E1' style='clear:both;'>
									Date Appraised
								</div>

								<div class='B1'>
									<input type='text' name='cLAdate' id=
									'cLAdate' style='width:150px;'>
								</div>

								<div class='E1' style='clear:both;'>
									Maturity Date
								</div>

								<div class='B1'>
									<input type='text' name='cMdate' id=
									'cMdate' style='width:150px;'>
								</div>

								<div class='E1' style='clear:both;'>
									Current Lien Holder
								</div>

								<div class='B1'>
									<input type='text' name='cLname' id=
									'cLname' style='width:150px;'>
								</div>

								<div class='E1' style='clear:both;'>
									Pre-Payment Amount $
								</div>

								<div class='B1'>
									<input type='text' name='cPPPamount' id=
									'cPPPamount' style='width:150px;'>
								</div>

								<div class='E1' style='clear:both;'>
									Cost of Proposed $<br>
									Improvements   
								</div>

								<div class='B1'>
									<input type='text' name='cPcost' id=
									'cPcost' style='width:150px;'>
								</div>
							</div>

							<div class='A1' style=
							'height:40px;clear:left;width:682px;'>
								<p class='sh'>Description of
								Improvements</p><input type='text' id=
								'cIdescription' name='cIdescription' style=
								'width:682px;'>
							</div>

							<div class='A1' style='height:40px;width:682px;'
							id='Cinfo'>
								<p class='sh'>Use Of Cash-out
								Proceeds</p><input type='text' id='COuse' name=
								'COuse' style='width:682px;'>
							</div>
						</div>

						<div id='CNinfo'>
							<h2>Construction</h2>

							<div class='A1'>
								<div class='E1'>
									Land Cost $
								</div>

								<div class='B1'>
									<input type='text' name='cnLprice' id=
									'cnLprice' style='width:150px;'>
								</div>

								<div class='E1' style='clear:both;'>
									Land Last Appraised $
								</div>

								<div class='B1'>
									<input type='text' name='cnLAvalue' id=
									'cnLAvalue' style='width:150px;'>
								</div>

								<div class='E1' style='clear:both;'>
									Proj Last Appraised $
								</div>

								<div class='B1'>
									<input type='text' name='cnPAvalue' id=
									'cnPAvalue' style='width:150px;'>
								</div>

								<div class='E1' style='clear:both;'>
									Existing Lien on Land $
								</div>

								<div class='B1'>
									<input type='text' name='cnLbalance' id=
									'cnLbalance' style='width:150px;'>
								</div>

								<div class='E1' style='clear:both;'>
									Cost of Construction $
								</div>

								<div class='B1'>
									<input type='text' name='cnCprice' id=
									'cnCprice' style='width:150px;'>
								</div>

								<div class='E1' style='clear:both;'>
									Infrastructure Complete
								</div>

								<div class='B1'>
									<input type='radio' class='Radio' name=
									'cnIcomplete' id='cnIcomplete' value=
									'Yes'>Yes <input type='radio' class='Radio'
									name='cnIcomplete' id='cnIcomplete' value=
									'No'>No
								</div>

								<div class='E1' style='clear:both;'>
									Money for Project $
								</div>

								<div class='B1'>
									<input type='text' name='cnExistingM' id=
									'cnExistingM' style='width:150px;'>
								</div>
							</div>

							<div class='A1' style='width:334px;'>
								<div class='E1'>
									Date Land Purchased
								</div>

								<div class='B1'>
									<input type='text' name='cnLPdate' id=
									'cnLdate' style='width:150px;'>
								</div>

								<div class='E1' style='clear:both;'>
									Date Land Appraised
								</div>

								<div class='B1'>
									<input type='text' name='cnLAdate' id=
									'cnLAdate' style='width:150px;'>
								</div>

								<div class='E1' style='clear:both;'>
									Date Project Appraised
								</div>

								<div class='B1'>
									<input type='text' name='cnPAdate' id=
									'cnPAdate' style='width:150px;'>
								</div>

								<div class='E1' style='clear:both;'>
									To Be Built By
								</div>

								<div class='B1'>
									<select name='cnBuiltBy' id='cnBuiltBy'>
										<option selected value=''>
											Select One
										</option>

										<option>
											Owner
										</option>

										<option>
											Contractor
										</option>
									</select>
								</div>

								<div class='E1' style='clear:both;'>
									Numb. of Units Pre-Sold
								</div>

								<div class='B1'>
									<input type='text' name='cnPreSold' id=
									'cnPreSold' style='width:100px'>
								</div>

								<div class='E1' style='clear:both;'>
									Master Plan Complete
								</div>

								<div class='B1'>
									<input type='radio' class='Radio' name=
									'cnMcomplete' id='cnMcomplete' value=
									'Yes'>Yes <input type='radio' class='Radio'
									name='cnMcomplete' id='cnMcomplete' value=
									'No'>No
								</div>

								<div class='E1' style='clear:both;'>
									Seller Could Finance
								</div>

								<div class='B1'>
									<input type='radio' class='Radio' name=
									'cnSfinancing' id='cnSfinancing' value=
									'Yes'>Yes <input type='radio' class='Radio'
									name='cnSfinancing' id='cnSfinancing'
									value='No'>No
								</div>
							</div>
						</div>

						<h2>Direct Contact Information</h2>

						<div id='ContactXX' style=
						'height:116px;background:transparent;'>
							<div class='A1' style=
							'height:106px;background:transparent;float:left;width:48%;'>
							<div class='D1' style='width:90px;'>
									Your Name
								</div>

								<div class='G1'>
									<input type='text' name='Pname' id='Pname'
									style='width:210px;'>
								</div>

								<div class='D1' style='width:90px;clear:left;'>
									Email Address
								</div>

								<div class='G1'>
									<input type='text' name='Email' id='Email'
									style='width:210px;'>
								</div>

								<div class='D1' style='width:90px;clear:left;'>
								</div>

								<div class='G1'></div>
							</div>

							<div class='A1' style=
							'height:106px;background:transparent;width:48%;'>
								<div class='D1' style='width:90px;'>
									Office Phone
								</div>

								<div class='G1'>
									<input type='text' name='Ophone' id=
									'Ophone' style='width:150px;'>
								</div>

								<div class='D1' style='width:90px;clear:left;'>
									Cell Phone
								</div>

								<div class='G1'>
									<input type='text' name='Cell' id='Cell'
									style='width:150px;'>
								</div>

								<div class='D1' style='width:90px;clear:left;'>
									Fax
								</div>

								<div class='G1'>
									<input type='text' name='Fax' id='Fax'
									style='width:150px;'>
								</div>
							</div><br style='clear:left;'>

							<div style=
							'background:transparent;height:240px;padding:4px;text-align:left;'>
							<p class='sh'>How did you hear about us? If
							referred, from whom?</p><input type='text' id=
							'Referred' name='Referred' style='width:675px;'>

								<p class='sh'>Comments about your current
								situation</p>
								<textarea id='Comments' name='Comments' style=
								'height:160px;width:675px;padding:0;margin:0;background:#D9DDF9'>

</textarea>
							</div>

							<p style='text-align:center;'><input class='Button'
							type='submit' id='Submit' name='Submit'
							onmouseover='this.style.backgroundColor="#fff";this.style.color="#009";this.style.border="2px solid #009";'
							onmouseout=
							'this.style.backgroundColor="#134584";this.style.color="#fff";this.style.border="2px solid #ccc";'
							value='Send'>         <input class='Button' type="button"
							id='Cancel' name='Cancel' onmouseover=
							'this.style.backgroundColor="#fff";this.style.color="#009";this.style.border="2px solid #009";'
							onmouseout=
							'this.style.backgroundColor="#134584";this.style.color="#fff";this.style.border="2px solid #ccc";'
							value='Cancel' onclick=
							'if (confirm("Are you sure you want to erase the data already entered?") == true) document.AppForm.reset();'>
							</p>
						</div>
					</div><!--ih:app -->
				</form><br>
				<br>

<?php include("include/bottom.php"); ?>
</body>
</html>
