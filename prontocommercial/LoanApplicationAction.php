<!DOCTYPE html PUBLIC "-//W3c//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Loan Application Confirmation</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta name="copyright" content="Copyright 2006, Anthony Ferlazzo, Pronto Commercial Funding">
<meta name="rating" content="General">
<meta name="robots" content="Index, ALL">
<meta name="description"
content="Commercial Mortgage and Leasing.">
<meta name="keywords"
content="commercial mortgage, commercial leasing, equipment leasing, commercial loans">
<link rel="shortcut icon" href="favicon.ico">
	<?php
	if (file_exists("./css/ProntoStylesCompressed.css"))
		print("<link rel='stylesheet' href='./css/ProntoStylesCompressed.css' type='text/css'>\n");
	else
		print("<link rel='stylesheet' href='./css/ProntoStyles.css' type='text/css'>\n");
?>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
<?php
	if (file_exists("./js/ProntoCommonCompressed.js"))
		print("<script src='./js/ProntoCommonCompressed.js' type='text/javascript'>\n");
	else
		print("<script src='./js/ProntoCommon.js' type='text/javascript'>\n");
?>
</script>
<style type="text/css">
p {font-family:sans-serif;}
div.Label {float:left;width:50%;}
div.Label p {margin:0;text-align:right;}
div.Data {float:left;width:45%;margin-left:6px;}
div.Data p {margin:0;}
</style>
</head>
<body>
<?php include("include/top.php"); ?>
<h1>Data Review and Confirmation</h1>
<p>Please review the information you entered and press the <span style='background:yellow;'>Confirmed</span> button below.</p>

<?php

//---------------
//
// Get the visitor's IP Address
//
//---------------
function GetIP()
{
if ($_SERVER)
{
	if ( $_SERVER[HTTP_X_FORWARDED_FOR] )
	{
	$realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	}
	elseif ( $_SERVER["HTTP_CLIENT_IP"] )
	{
	$realip = $_SERVER["HTTP_CLIENT_IP"];
	}
	else
	{
	$realip = $_SERVER["REMOTE_ADDR"];
	}
}
else
{
	if ( getenv( 'HTTP_X_FORWARDED_FOR' ) )
	{
	$realip = getenv( 'HTTP_X_FORWARDED_FOR' );
	}
	elseif ( getenv( 'HTTP_CLIENT_IP' ) )
	{
	$realip = getenv( 'HTTP_CLIENT_IP' );
	}
	else
	{
	$realip = getenv( 'REMOTE_ADDR' );
	}
}

return $realip;
}



//---------------
//
// This handles leading zeroes correctly, by using the "%s" instead of "%d" argument to sscanf().
// This function assumes that the input has been stripped of all non-integer values.
//
//---------------


function formatPhone($phone)
{
	if (empty($phone)) return "";
	if (strlen($phone) == 7)
			sscanf($phone, "%3s%4s", $prefix, $exchange);
	else if (strlen($phone) == 10)
			sscanf($phone, "%3s%3s%4s", $area, $prefix, $exchange);
	else if (strlen($phone) > 10)
			sscanf($phone, "%3s%3s%4s%s", $area, $prefix, $exchange, $extension);
	else
			return "unknown phone format: $phone";
	$out = "";
	$out .= isset($area) ? '(' . $area . ') ' : "";
	$out .= $prefix . '-' . $exchange;
	$out .= isset($extension) ? ' x' . $extension : "";
	return $out;
}

//---------------
//
// This is where the actual PHP begins.
// The calling page could have been a method  of Post of Get
//
//---------------

$Entity           = $_POST['Entity'];
$EntityType       = $_POST['EntityType'];
$Address          = $_POST['Address'];
$Years            = $_POST['Years'];
$City             = $_POST['City'];
$State            = $_POST['State'];
$Zip              = $_POST['Zip'];
$Name1            = $_POST['Name1'];
$Percentage1      = $_POST['Percentage1'];
$NetWorth1  		= $_POST['NetWorth1'];
$LiquidAssets1    = $_POST['LiquidAssets1'];
$Credit1          = $_POST['Credit1'];
$Name2            = $_POST['Name2'];
$Percentage2      = $_POST['Percentage2'];
$NetWorth2  		= $_POST['NetWorth2'];
$LiquidAssets2    = $_POST['LiquidAssets2'];
$Credit2          = $_POST['Credit3'];
$Name3            = $_POST['Name3'];
$Percentage3      = $_POST['Percentage3'];
$NetWorth3  		= $_POST['NetWorth3'];
$LiquidAssets3    = $_POST['LiquidAssets3'];
$Credit3          = $_POST['Credit3'];
$Name4            = $_POST['Name4'];
$Percentage4      = $_POST['Percentage4'];
$NetWorth4 		= $_POST['NetWorth4'];
$LiquidAssets4    = $_POST['LiquidAssets4'];
$Credit4          = $_POST['Credit4'];
$PastBK           = $_POST['PastBK'];
$PastDerog        = $_POST['PastDerog'];

$Description      = $_POST['Description'];
$Purpose          = $_POST['Purpose'];

$Price            = $_POST['Price'];
$Earnest          = $_POST['Earnest'];
$DownPayment      = $_POST['DownPayment'];
$Contract         = $_POST['Contract'];
$Closing          = $_POST['Closing'];
$SellerF          = $_POST['SellerF'];

$cPprice          = $_POST['cPprice'];
$cLAvalue         = $_POST['cLAvalue'];
$cCbalance        = $_POST['cCbalance'];
$cMpayment        = $_POST['cMpayment'];
$cPPP             = $_POST['cPPP'];
$cIcost           = $_POST['cIcost'];

$cPdate           = $_POST['cPdate'];
$cLAdate          = $_POST['cLAdate'];
$cMdate           = $_POST['cMdate'];
$cLname           = $_POST['cLname'];
$cPPPamount       = $_POST['cPPPamount'];
$cPcost           = $_POST['cPcost'];
$cIdescription    = $_POST['cIdescription'];

$COuse            = $_POST['COuse'];

$cnLprice         = $_POST['cnLprice'];
$cnLAvalue        = $_POST['cnLAvalue'];
$cnPAvalue        = $_POST['cnPAvalue'];
$cnLbalance       = $_POST['cnLbalance'];
$cnCprice         = $_POST['cnCprice'];
$cnIcomplete      = $_POST['cnIcomplete'];
$cnExistingM      = $_POST['cnExistingM'];
$cnLPdate         = $_POST['cnLPdate'];
$cnLAdate         = $_POST['cnLAdate'];
$cnPAdate         = $_POST['cnPAdate'];
$cnBuiltBy        = $_POST['cnBuiltBy'];
$cnPreSold        = $_POST['cnPreSold'];
$cnMcomplete      = $_POST['cnMcomplete'];
$cnSfinancing     = $_POST['cnSfinancing'];

$Pname            = $_POST['Pname'];
$Email            = $_POST['Email'];
$Ophone           = $_POST['Ophone'];
$Cell             = $_POST['Cell'];
$Fax              = $_POST['Fax'];
$Referred         = $_POST['Referred'];
$Comments         = $_POST['Comments'];

// now that we've obtained the calling page's form variables, display them to the visitor

print("<div class='Label'><p><b>Business Entity:</b></p></div><div class='Data'><p>$Entity</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Entity Type:</b></p></div><div class='Data'><p>$EntityType</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Address:</b></p></div><div class='Data'><p>$Address</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>City:</b></p></div><div class='Data'><p>$City</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>State:</b></p></div><div class='Data'><p>$State</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Zip:</b></p></div><div class='Data'><p>$Zip</p></div><br style='clear:left;'>");
print("<br><div class='Label'><p><b>Years:</b></p></div><div class='Data'><p>$Years</p></div><br style='clear:left;'>");
print("<br><div class='Label'><p><b>Principal/Owner Name:</b></p></div><div class='Data'><p>$Name1</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Percentage Owned:</b></p></div><div class='Data'><p>$Percentage1</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Net Worth:</b></p></div><div class='Data'><p>$NetWorth1</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Liquid Assets:</b></p></div><div class='Data'><p>$LiquidAssets1</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Estimated Credit Score:</b></p></div><div class='Data'><p>$Credit1</p></div><br style='clear:left;'>");
print("<br><div class='Label'><p><b>Principal/Owner Name:</b></p></div><div class='Data'><p>$Name2</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Percentage Owned:</b></p></div><div class='Data'><p>$Percentage2</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Net Worth:</b></p></div><div class='Data'><p>$NetWorth2</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Liquid Assets:</b></p></div><div class='Data'><p>$LiquidAssets2</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Estimated Credit Score:</b></p></div><div class='Data'><p>$Credit2</p></div><br style='clear:left;'>");
print("<br><div class='Label'><p><b>Principal/Owner Name:</b></p></div><div class='Data'><p>$Name3</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Percentage Owned:</b></p></div><div class='Data'><p>$Percentage3</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Net Worth:</b></p></div><div class='Data'><p>$NetWorth3</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Liquid Assets:</b></p></div><div class='Data'><p>$LiquidAssets3</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Estimated Credit Score:</b></p></div><div class='Data'><p>$Credit3</p></div><br style='clear:left;'>");
print("<br><div class='Label'><p><b>Principal/Owner Name:</b></p></div><div class='Data'><p>$Name4</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Percentage Owned:</b></p></div><div class='Data'><p>$Percentage4</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Net Worth:</b></p></div><div class='Data'><p>$NetWorth4</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Liquid Assets:</b></p></div><div class='Data'><p>$LiquidAssets4</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Estimated Credit Score:</b></p></div><div class='Data'><p>$Credit4</p></div><br style='clear:left;'>");
print("<br><div class='Label'><p><b>Past (5 years) Bankruptcy:</b></p></div><div class='Data'><p>$PastBK</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Past (5 years) Derogatory Public Record:</b></p></div><div class='Data'><p>$PastDerog</p></div><br style='clear:left;'>");

print("<div class='Label'><p><b>Project Description:</b></p></div><div class='Data'><p>$Description</p></div><br style='clear:left;'>");
print("<br><div class='Label'><p><b>Purpose:</b></p></div><div class='Data'><p>$Purpose</p></div><br style='clear:left;'>");

if ($Purpose == 'Purchase')
{
print("<br><div class='Label'><p><b>Price:</b></p></div><div class='Data'><p>$Price</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Earnest:</b></p></div><div class='Data'><p>$Earnest</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>DownPayment:</b></p></div><div class='Data'><p>$DownPayment</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Contract:</b></p></div><div class='Data'><p>$Contract</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Closing:</b></p></div><div class='Data'><p>$Closing</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>SellerF:</b></p></div><div class='Data'><p>$SellerF</p></div><br style='clear:left;'>");
}

if (($Purpose == 'Refinance') || ($Purpose == 'Cashout'))
{
print("<br><div class='Label'><p><b>cPprice:</b></p></div><div class='Data'><p>$cPprice</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>cLAvalue:</b></p></div><div class='Data'><p>$cLAvalue</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>cCbalance:</b></p></div><div class='Data'><p>$cCbalance</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>cMpayment:</b></p></div><div class='Data'><p>$cMpayment</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>cPPP:</b></p></div><div class='Data'><p>$cPPP</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>cIcost:</b></p></div><div class='Data'><p>$cIcost</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>cPdate:</b></p></div><div class='Data'><p>$cPdate</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>cLAdate:</b></p></div><div class='Data'><p>$cLAdate</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>cMdate:</b></p></div><div class='Data'><p>$cMdate</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>cLname:</b></p></div><div class='Data'><p>$cLname</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>cPPPamount:</b></p></div><div class='Data'><p>$cPPPamount</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>cPcost:</b></p></div><div class='Data'><p>$cPcost</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>cIdescription:</b></p></div><div class='Data'><p>$cIdescription</p></div><br style='clear:left;'>");
}

if ($Purpose == 'Cashout')
	print("<br><div class='Label'><p><b>COuse:</b></p></div><div class='Data'><p>$COuse</p></div><br style='clear:left;'>");

if ($Purpose == 'Construction')
{
print("<br><div class='Label'><p><b>Land Cost:</b></p></div><div class='Data'><p>$cnLprice</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Date Land Purchased:</b></p></div><div class='Data'><p>$cnLPdate</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Land: Last Appraised Value:</b></p></div><div class='Data'><p>$cnLAvalue</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Date Land Appraised:</b></p></div><div class='Data'><p>$cnLAdate</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Project: Last Appraised Value:</b></p></div><div class='Data'><p>$cnPAvalue</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Date Project Appraised:</b></p></div><div class='Data'><p>$cnPAdate</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Existing Lien Balance:</b></p></div><div class='Data'><p>$cnLbalance</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Cost of Construction:</b></p></div><div class='Data'><p>$cnCprice</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Infrastructure Complete:</b></p></div><div class='Data'><p>$cnIcomplete</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Funds Available For Construction:</b></p></div><div class='Data'><p>$cnExistingM</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Built By:</b></p></div><div class='Data'><p>$cnBuiltBy</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Number of Units PreSold:</b></p></div><div class='Data'><p>$cnPreSold</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Master Plan Complete:</b></p></div><div class='Data'><p>$cnMcomplete</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Seller Financing Available:</b></p></div><div class='Data'><p>$cnSfinancing</p></div><br style='clear:left;'>");
}
print("<br><div class='Label'><p><b>Person Completing This Form:</b></p></div><div class='Data'><p>$Pname</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Email:</b></p></div><div class='Data'><p>$Email</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Office Phone:</b></p></div><div class='Data'><p>$Ophone</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Cell Phone:</b></p></div><div class='Data'><p>$Cell</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Fax:</b></p></div><div class='Data'><p>$Fax</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Referred By:</b></p></div><div class='Data'><p>$Referred</p></div><br style='clear:left;'>");
print("<div class='Label'><p><b>Comments About The Situation:</b></p></div><div class='Data'><p>$Comments</p></div><br style='clear:left;'>");


	$message  = "<p style='margin:0;font-family:sans-serif;'><b>Date Sent:</b> ".date ("l dS of F Y h:i:s A")."</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>IP Address: </b>".$IPaddress."</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Name: </b>".$Pname."</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Email: </b>".$Email."</p>";

	$message .= "<p style='margin:0;font-family:sans-serif;'><br><b>Business Entity:</b> $Entity</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>EntityType:</b> $EntityType</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Address:</b> $Address</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>City:</b> $City</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>State:</b> $State</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Zip:</b> $Zip</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Years In Business:</b> $Years</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><br><b>Principal/Owner Name:</b> $Name1</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Ownership Percentage:</b> $Percentage1</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Net Worth:</b> $NetWorth1</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Liquid Assets:</b> $LiquidAssets1</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Estimated Credit Score:</b> $Credit1</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><br><b>Principal/Owner Name:</b> $Name2</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Ownership Percentage:</b> $Percentage2</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Net Worth:</b> $NetWorth2</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Liquid Assets:</b> $LiquidAssets2</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Estimated Credit Score:</b> $Credit2</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><br><b>Principal/Owner Name:</b> $Name3</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Ownership Percentage:</b> $Percentage3</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Net Worth:</b> $NetWorth3</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Liquid Assets:</b> $LiquidAssets3</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Estimated Credit Score:</b> $Credit3</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><br><b>Principal/Owner Name:</b> $Name4</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Ownership Percentage:</b> $Percentage4</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Net Worth:</b> $NetWorth4</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Liquid Assets:</b> $LiquidAssets4</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Estimated Credit Score:</b> $Credit4</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><br><b>Any Principal have a past (5 years) bankruptcy:</b> $PastBK</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Any Principal have a past (5 years) derogatory public record:</b> $PastDerog</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Project Description:</b> $Description</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><br><b>Loan Purpose:</b> $Purpose</p>";

	if ($Purpose == 'Purchase')
	{
	$message .= "<p style='margin:0;font-family:sans-serif;'><br><b>Purchase Price:</b> $Price</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Earnest Money Deposit:</b> $Earnest</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Down Payment:</b> $DownPayment</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Have a Contract:</b> $Contract</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Desired Closing:</b> $Closing</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Seller Financing Available:</b> $SellerF</p>";
	}

	if (($Purpose == 'Refinance') || ($Purpose == 'Cashout'))
	{
	$message .= "<p style='margin:0;font-family:sans-serif;'><br><b>Original Purchase Price:</b> $Pprice</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Date Purchased:</b> $cPdate</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Appraised Value:</b> $cAvalue</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Date Appraised:</b> $cLAdate</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Current Balance:</b> $cCbalance</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Monthly Payment:</b> $cMpayment</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>PPP:</b> $cPPP</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>PPPamount:</b> $cPPPamount</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Cost of Improvements Made:</b> $cIcost</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Maturity Date:</b> $cMdate</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Current Lien Holder Name:</b> $cLname</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Cost of Proposed Improvements:</b> $cPcost</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Description of Improvements:</b> $cIdescription</p>";
	}

	if ($Purpose == 'Cashout')
		$message .= "<p style='margin:0;font-family:sans-serif;'><br><b>Cash Out use of funds:</b> $COuse</p>";

	if ($Purpose == 'Construction')
	{
	$message .= "<p style='margin:0;font-family:sans-serif;'><br><b>Land Cost:</b> $cnLprice</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Date Land Purchased:</b> $cnLPdate</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Land Last Appraised Value:</b> $cnLAvalue</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Date Land Appraised:</b> $cnLAdate</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Project Last Appraised Value:</b> $cnPAvalue</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Project Appraised Date:</b> $cnPAdate</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Existing Lien On Land Balance:</b> $cnLbalance</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Cost of Construction:</b> $cnCprice</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Infrastructure Complete:</b> $cnIcomplete</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Money for Project:</b> $cnExistingM</p>";


	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Built By:</b> $cnBuiltBy</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Number PreSold:</b> $cnPreSold</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Master Plan Complete:</b> $cnMcomplete</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Seller Financing Available:</b> $cnSfinancing</p>";
	}


	$message .= "<p style='margin:0;font-family:sans-serif;'><br><b>Name of Person Filling Out Form:</b> $Pname</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Email:</b> $Email</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Office Phone:</b> $Ophone</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Cell Phone:</b> $Cell</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Fax:</b> $Fax</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Referred By:</b> $Referred</p>";
	$message .= "<p style='margin:0;font-family:sans-serif;'><b>Comments: </b>";

	$SituationLine = explode("\r\n", $Comments);

		for ($k=0; $k < count($SituationLine); $k++)
			$message.= $SituationLine[$k]."<br>";
	$message .= " </p>";

$mmm = urlencode($message);
print("<form name='ConfirmForm' action='LoanApplicationSent.php' method='post'>");
print("<input type='hidden' name='Message' value='$mmm'>");
print("<input type='hidden' name='Email' value='$Email'>");
print("<input type='hidden' name='Pname' value='$Pname'>");
/*
print("<br><input type='submit' value='Confirmed'>&nbsp;&nbsp;");
print("<input type='button' value='Make Corrections' onclick='window.history.back()'>");
*/

print("<br><input class='Button' type='submit' id='Submit' name='Submit' value='Confirmed' style='width:90px;'\n");
print("onMouseover='this.style.backgroundColor=\"#fff\";this.style.color=\"#009\";this.style.border=\"2px solid #009\";' \n"); 
print("onMouseOut='this.style.backgroundColor=\"#134584\";this.style.color=\"#fff\";this.style.border=\"2px solid #ccc\";'>&nbsp;&nbsp;\n");
print("<input class='Button' type='button' id='BBack' name='Submit' value='Make Corrections' style='width:120px;' onclick='window.history.back()'\n");
print("onMouseover='this.style.backgroundColor=\"#fff\";this.style.color=\"#009\";this.style.border=\"2px solid #009\";' \n"); 
print("onMouseOut='this.style.backgroundColor=\"#134584\";this.style.color=\"#fff\";this.style.border=\"2px solid #ccc\";'>\n");
print("</form><br>&nbsp;");

?>
<?php include("./include/bottom.php"); ?>
</body>
</html>
