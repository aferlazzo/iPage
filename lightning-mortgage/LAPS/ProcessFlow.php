<?php
require ("../include/authenticate.php");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<html>
<head>

<title>Process Flow Documentation</title>
<script language="JavaScript" src="https://host373.ipowerweb.com/~lightnin/js/Common.js">
</script>
<link rel="stylesheet" href="../css/AdministrativeStyles.css" type="text/css">
<!--[if IE 6]>
<style type="text/css">
html
{
  scrollbar-base-color: #F4F4F4;
  scrollbar-arrow-color: #FFFFFF;
  scrollbar-track-color: #002179;
  scrollbar-face-color: #000099;
  scrollbar-3dlight-color: #000099;
}
</style>
<![endif]-->
</head>

<body>
<div class="Main" id="MainDIV">
<div class="Content" id="ContentDIV">
<h1>LAPS Process Flow</h1>
	<table border="0" cellpadding="4" cellspacing="0" width="720">
		<tr>
			<td width="25%">
				<form action='ApplicantMaster.php'>
				<p><br /><input class='Submit' type='submit' value='LAPS Home' style='color:#fff;'></p>
				</form>
			</td>
			<td width="50%">
				<font face="Verdana" color="#000099"><?php print ("<b>Welcome, $RealName</b>");?></font>
			</td>
			<td width="25%">
				<form action='SystemDocumentation.php'>
				<p><br /><input class='Submit' type='submit' value='Other Documentation'></p>
				</form>
			</td>
		</tr>
	</table>

	<table border="0" cellpadding="4" cellspacing="0" width="730">
		<tr>
			<td align="left">
				<p>
<?php if ($UserLevel == "Admin")
{
	print ("When an applicant fills out an application he receives a confirmation screen offering him a method of correcting ");
	print ("mistakes. Once confirmed, the applicant's data is entered in the database. The applicant then is taken to the AAA ");
	print ("Credit  credit card processing screen. His identifying information is passed so that the proper credit report will be generated ");
	print ("by iCredit Visions and saved in our credit report 'mailbox.'<br><br>");

	print ("The confirmed applicant data is also sent via e-mail so that we are aware of the new application. An ");
	print ("auto-reply is sent to the applicant when the application is submitted. An auto-reply message is submitted to the ");
	print ("applicant when the credit report is generated. Sending both of these auto-reply messages is triggered by the receipt of ");
	print ("properly formatted sender, subject, and body e-mail. The text describing an applicant's specific request from the online application is placed in ");
	print ("the Daily Progress Report. Daily Progress records are continually created and modified during loan processing for ");
	print ("recordkeeping and loan tracking. Copy of applicant e-mail sent and from borrowers helps with recordkeeping.");
	print ("<br><br>");
	print ("");
	print ("When an application has a credit report run by the borrower, we import the loan into Calyx Point using the most ");
	print ("appropriate template for the applicant (single or married, purchase or refinance, rate & term or cash-out?). ");
	print ("Liabilities from the credit report are imported. The credit report is then reviewed. Public records (predominantly ");
	print ("bankruptcies and tax liens) are noted. Erroneously reported debt (e.g. same name, different social security number) ");
	print ("and duplicate entries are noted. Correcting these errors is important because it may result in a higher credit score ");
	print ("during a rapid rescore. This could also greatly affect the DTI ratios.<br><br>");

	print ("Loan details like appraisal, underwriting, doc request & completed dates are kept in Point. These details are uploaded into ");
	print ("LAPS via the LAPS Console menu choice.");
  	print ("</font><br><br>");
}
else
{
	print ("When an applicant fills out an apxxxxxxxxxxhx xxcxxvxs a cxxxxxxatxon scrxxn oxxxrxnx xxx a xxtxox ox corrxctxnx");
	print ("xxstaxxs. Oncx conxxrxxx, txx appxxcant's xata xs xntxrxx xn txx xatabasx. Txx appxicant txen xs taxen to txe AAA");
	print ("credxt carx procxssxnx scrxxn. xxs xxxntxxyxnx xnxorxatxon xs passxx so txat txx propxr crxxxt rxport wxxx bx xxnxratxx");
	print ("by xCrxxxt Vxsxons anx savxx xn our crxxxt rxport 'xaxxbox.'<br><br>");

	print ("Txx conxxrxxx appxxcant xata xs axso sxnt vxa x-xaxx to our xaxxboxxs so txat wx arx awarx ox txx nxw appxxcatxon. An");
	print ("auto-rxpxy xs sxnt to txx appxxcant wxxn txx appxxcatxon xs subxxttxx. A sxconx auto-rxpxy xxssaxx xs subxxttxx to txx");
	print ("appxxcant wxxn txx crxxxt rxport xs xxnxratxx. Sxnxxnx botx ox txxsx auto-rxpxy xxssaxxs xs trxxxxrxx by txx rxcxxpt ox");
	print ("propxrxy xorxxx x-xaxx. Txx txxt xxscrxbxnx an appxxcant's spxcxxxc rxquxst xrox txx onxxnx appxxcatxon xs pxacxx xn");
	print ("txx xaxxy Proxrxss Rxport. xaxxy Proxrxss rxcorxs arx contxnuaxxy crxatxx anx xoxxxxxx xurxnx xoan procxssxnx xor");
	print ("rxcorx xxxpxnx anx xoan tracxxnx. Copy-anx-pastx ox appxxcant x-xaxx sxnt anx rxcxxvxx xxxps wxtx rxcorx xxxpxnx.");
	print ("<br><br>");
	print ("");
	print ("Wxxn an appxxcatxon xas a crxxxt rxport run by txx borrowxr, wx xxport txx xoan xnto Caxyx Poxnt usxnx txx xost");
	print ("approprxatx txxpxatx xor txx appxxcant (sxnxxx or xarrxxx, purcxasx or rxxxnancx, ratx & txrx or casx-out?).");
	print ("xxabxxxtxxs xrox txx crxxxt rxport arx xxportxx. Txx crxxxt rxport xs txxn rxvxxwxx. Pubxxc rxcorxs (prxxoxxnantxy");
	print ("banxruptcxxs anx tax xxxns) arx notxx. xrronxousxy rxportxx xxbt (x.x. saxx naxx, xxxxxrxnt socxax sxcurxty nuxbxr)");
	print ("anx xupxxcatx xntrxxs arx notxx. Corrxctxnx txxsx xrrors xs xxportant bxcausx xt xay rxsuxt xn a xxxxxr crxxxt scorx");
	print ("xurxnx a rapxx rxscorx. Txxs couxx axso xrxatxy axxxct txx xTx ratxos.<br><br>");

	print ("xoan xxtaxxs-appraxsax, unxxrwrxtxnx, xoc rxquxst coxpxxtxx xatxs-arx xxpt xn Poxnt. Txxsx xxtaxxs arx upxoaxxx xnto");
	print ("xAPS vxa txx xAPS Consoxx xxnu cxoxcx.");
  	print ("</font><br><br>");
}
?>
			</p></td>
		</tr>
	</table>
	</div>


<!--  * * * * * * * * * * * * * * * * COMMON FOOTER  * * * * * * * * * * * * * * * -->
<?php include("../include/bottom.php"); ?>
<?php include("../include/top.php"); ?>
<!--  * * * * * * * * * * * * * * * * * * * End of COMMON HEADER * * * * * * * * * * * * * * * * * * -->
</body>
</html>
