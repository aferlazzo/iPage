<!DOCTYPE html>
<html>
<head>
<title>CIS Documents</title>
<meta charset=utf-8>
<meta name="copyright" content="Copyright 2006, Anthony Ferlazzo, Pronto Commercial Funding" >
<meta name="rating" content="General" >
<meta name="robots" content="Index, ALL, follow" >
<meta name="OWNER" content="Pronto Commercial Funding" >
<link rel="SHORTCUT ICON" href="http://www.prontocommercial.com/favicon.ico" >
<?php include("include/head.php"); ?>
<style type='text/css'>
#pause{display:none !important;}
label {float:left;cursor:pointer;display:inline-block}
p.form{margin:6px 0;text-align:center;}
p#start {margin:0 7px 0 170px;font-weight:600;}
p#start, input.form {float:left;display:inline-block;}
#submit {margin-left:360px;}
input.radio {padding:2px;}
table#docs {margin:0 auto;border-collapse: collapse;table-layout:fixed;clear:left;}
table#docs td {width: 330px;text-align:right;}
table#docs td, label {font-size:12px;padding:2px 4px 0;}
table#docs tr {height:25px;}
.nin {visibility: hidden;}
#other {
margin:5px 0 0 0;
width:780px;
height:330px;
white-space:nowrap;
padding:5px 0 5px 0;
}
#submit{cursor:pointer;}
#submit:hover {background-Color:#0f0}
</style>
</head>
<body>
<?php include("include/top.php"); ?>
	<h1>Upload Client Documents</h1>
	<div id='other'>
		<p id='start'>You are applying as</p>
		<input class='form' type='radio' id='t1' name='cs' onclick='checkS("An Individual");' ><label for='t1'>An Individual</label>
		<input class='form' type='radio' id='t2' name='cs' checked='checked' onclick='checkS("A Corporation");' ><label for='t2'>A Corporation</label>
		<input class='form' type='radio' id='t3' name='cs' onclick='checkS("A LLC");' ><label for='t3'>A LLC</label>
		<input class='form' type='radio' id='t4' name='cs' onclick='checkS("A Other");' ><label for='t4'>Other Company</label>
		<!-- The data encoding type, enctype, MUST be specified as below -->
		<form enctype="multipart/form-data" action="CISdocumentsAction.php" method="post">
		    <!-- MAX_FILE_SIZE must precede the file input field -->
			<p class='form'><input type="hidden" name="MAX_FILE_SIZE" value="50000000"></p>
			<table id='docs' summary='the documents for upload'>
				<tr><td class='corp'>Attach a Certificate of Incorporation</td><td class='corp'><input class='form' type="file" name="CISfiles[]"></td></tr>
				<tr><td class='corp'>Attach a Corporate Resolution</td><td class='corp'><input class='form' type="file" name="CISfiles[]"></td></tr>
				<tr class='ccc'><td class='ccc'>All companies must submit an identification/registration document</td><td class='ccc'><input class='form' type="file" name="CISfiles[]"></td></tr>
				<tr><td colspan='2' style='text-align:center;'>Individual applicants must supply <b>two forms</b> of identification (Passport, State ID, Utility Bill, Etc.)</td></tr>
				<tr><td><input class='form' type="file" name="CISfiles[]"></td><td><input class='form' type="file" name="CISfiles[]"></td></tr>
				<tr class='ccc'><td colspan='2' style='text-align:center;'>Associated or authorized applicants must provide <b>two forms</b> of identification to prove their residence and identity</td></tr>
				<tr><td class='ccc'><input class='form' type="file" name="CISfiles[]"></td><td class='ccc'><input class='form' type="file" name="CISfiles[]"></td></tr>
				<tr><td>Attach a bank statement showing the ability to pay the leasing fee</td><td><input class='form' type="file" name="CISfiles[]"></td></tr>
				<tr><td>Include the verbiage for the MT-799 or MT-760 message if applicable</td><td><input class='form' type="file" name="CISfiles[]"></td></tr>
				<tr><td colspan='2' style='text-align:center;'>All information requested is in accordance with International Money Laundering Regulations and the US Patriot Act</td></tr>
			</table>
			<p class='form'><input class='form' type="submit" id='submit' value="Send Files" onclick="document.getElementById('submit').style.backgroundColor='#f00'"></p>
		</form>
	</div>

<?php include("./include/bottom.php"); ?>
<script type='text/javascript'>
	//do a little jquery
	$(document).ready(function(){
		$('#other').show("slide", { direction: "up" }, 600);
	});

	function checkS(Applicant)
	{
		//alert(Applicant);
		$('#other').css('display', 'block');
		if (Applicant=="A Corporation")
		{
			$('.corp').parent().fadeIn(1000);
		}
		else
		{
			$('.corp').parent().fadeOut(1000);
		}

		if (Applicant=="An Individual")
		{
			$('.ccc').fadeOut(1000);
			$('.nin').fadeIn(1000);
		}
		else
		{
			$('.nin').fadeOut(1000);
			$('.ccc').fadeIn(1000);
		}

	}
</script>
</body>
</html>
