<?php
$coid=$_GET['coid'];
$transtype=$_GET['transtype'];
$charge=$_GET['charge'];
$to_email=$_GET['to_email'];
$cc_email=$_GET['cc_email'];
$email_subj=$_GET['email_subj'];
$returnURL=$_GET['returnURL'];
$cancelURL=$_GET['cancelURL'];
$errorURL=$_GET['errorURL'];
$a_fullname=$_GET['a_fullname'];
$a_ssn=$_GET['a_ssn'];
$co_fullname=$_GET['co_fullname'];
$co_ssn=$_GET['co_ssn'];
$ca_fullstreet_name=$_GET['ca_fullstreet_name'];
$ca_city=$_GET['ca_city'];
$ca_state=$_GET['ca_state'];
$ca_zipcode=$_GET['ca_zipcode'];
$bill_email=$_GET['bill_email'];
$bill_phone=$_GET['bill_phone'];
$autopopcc=$_GET['autopopcc'];
$AppInfo="ID=".$coid."&a_fullname=".$a_fullname."&a_lname=".$a_lname."&a_fname=".$a_fname."&a_mi=".$a_mi."&a_gen=".$a_gen."&a_ssn=".$a_ssn
			  ."&co_fullname=".$co_fullname."&co_lname=".$co_lname."&co_fname=".$co_fname."&co_mi=".$co_mi."&co_gen=".$co_gen."&co_ssn=".$co_ssn
			  ."&bill_phone=".$bill_phone."&bill_email=".$bill_email."&ca_fullstreet_name=".$ca_fullstreet_name
			  ."&houseno=".$houseno."&direction=".$direction."&streetname=".$streetname
			  ."&streettype=".$streettype."&aptno=".$aptno."&city=".$ca_city."&state=".$ca_state."&zipcode="
			  .$ca_zipcode."&autopopcc=".$autopopcc;

$URLlist="returnURL=".$returnURL."&cancelURL=".$cancelURL."&errorURL=".$errorURL."&charge=".$charge."&to_email=".$to_email."&cc_email=".$cc_email."&email_subj=".$email_subj;
/*
print("coid: $coid<br />transtype: $transtype<br />charge: $charge<br />to_email: $to_email<br />");
print("cc_email: $cc_email<br />email_subj: $email_subj<br />returnURL: $returnURL<br />cancelURL: $cancelURL<br />");
print("errorURL: $errorURL<br />");
print("a_fullname: $a_fullname<br />");
print("a_ssn: $a_ssn<br />");
print("co_fullname: $co_fullname<br />co_ssn: $co_ssn<br />ca_fullstreet_name: $ca_fullstreet_name<br />");
print("ca_city: $ca_city<br />ca_state: $ca_state<br />ca_zipcode: $ca_zipcode<br />bill_email: $bill_email<br />");
print("bill_phone: $bill_phone<br />autopopcc: $autopopcc<br />");

print("AppInfo=$AppInfo<br />");
print("URLlist=$URLlist<br />");
*/
//ID=9202&UID=0&appID=9258&fullname=&lname=Ferlazzo&fname=Anthony&mi=&gen=&billphone=925-399-5359&billemail=anthony@lightning-mortgage.com&fullstreetname=2114 Delucchi Dr&houseno=2114&direction=&streetname=Delucchi Dr&streettype=&aptno=&city=Pleasanton&state=CA&zipcode=94588&autopopcc=Y


?>
<script type="text/javascript">
function SetMyValue (CookieName, Value)
{
var MyDate = new Date();
var Day = MyDate.getDate();
Day = Day + 1;
MyDate.setDate(Day);
var DDate=MyDate.toString();

document.cookie=CookieName+'='+Value+'; expires='+DDate+'; Path=/';
//alert("In LoginAction.php SetMyValue() has set cookie "+CookieName+" to value "+Value);
}

SetMyValue('AppInfo', escape('<?php echo "$AppInfo" ?>'));
SetMyValue('URLlist', escape('<?php echo "$URLlist" ?>'));
//SetMyValue('test',"testSet");

window.location="https://host373.ipowerweb.com/~lightnin/MortgageApplication/CreditRequest.php";
</script>