<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<html>
<head>
<title>Loan Application Long Form</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta name="description" content="blank">
<meta name="keywords" content="blank">
<meta name="copyright" content="Copyright 2006, Tony Ferlazzo, Lightning Mortgage">
<meta name="rating" content="General">
<meta name="robots" content="Index, ALL">
<script src="http://www.google.com/coop/cse/brand?form=cse-search-box&lang=en" type="text/javascript"></script>
<link rel="stylesheet" href="../css/MortgageApplicationStyles.css" type="text/css">
<link rel="stylesheet" href="../css/Tabs.css" type="text/css">
<script src='js/DateTimePicker.js' type='text/javascript'></script>
<script src='js/LoanAppLong.js' type='text/javascript'></script>
<style type='text/css'>
h2 {width:620px;}
div.app {width:620px;background:#eee;margin:0 auto 4px;}

</style>
<!--[if IE 6]>
<style type="text/css">
html
{
	scrollbar-base-color: #EBF5F5;
	scrollbar-arrow-color: #FFF;
	scrollbar-track-color: #007B5D;
	scrollbar-face-color: #099;
	scrollbar-3dlight-color: #099;
}
</style>
<![endif]-->
</head>

<body onload="('images/helpA.gif'),('images/helpB.gif')">

<?php include('../include/top.php'); ?>
	<!-- Embedded Page Body -->
<div id="Heading" style="width:75%;">
<div class="Title"><h1 id="Small">Online<br />Residential</h1></div>
<div class="Title">
<div id="Big"><h1>Loan Application</h1></div>
<div id="BigShadow"><h1>Loan Application</h1></div></div>
</div>
<p>This mortgage application is an online version of the
official 1003 form for serious borrowers who have detailed information about their loan.
These web pages was designed to make it easy to enter the information.</p>
<p>Please <a href="#./Help/Instructions" onClick="MM_openBrWindow('./Help/Instructions.php','instructions','scrollbars=yes,resizable=yes,width=640,height=500,screenX=0,screenY=0,top=0,left=0')">Click
here for instructions</a> before you begin the application.</p>

<h2>TYPE OF MORTGAGE AND TERMS OF LOAN</h2>
<form method="POST" NAME="smartform" action="https://host373.ipowerweb.com/~lightnin/MortgageApplication/LoanAppLong.php" onSubmit="return Validator(smartform); clickedButton"><a NAME="tab1"></a>

<div class='app'><p>
*Enter Your E-mail Address: (Required field)
<input style="background-color:#E2FBFE" NAME="email" SIZE="30" MAXLENGTH="80" onFocus="nextfield ='password';">
</p></div>
<div class='app'><p>
*Choose Your Own Password: (Required field)
<input style="background-color:#E2FBFE" NAME="password" TYPE="password" SIZE="30" MAXLENGTH="80" onBlur="checkPass();" onFocus="nextfield ='agent_name';">
</p></div>

<center>
<table border=0 width="620" cellpadding="0" cellspacing="2" bgcolor="#FFFFFF" bordercolor="#FFFFFF" >
  <tr>
    <td width="620" bgcolor="#FFFFFF">
      <div align="center"><font face="Arial, Helvetica, sans-serif" size="-1">
        <b>If you are in contact with a loan officer or interviewer, enter
        their name below: </b></font></div>
    </td>
  </tr>
  <tr>
    <td width="620" bgcolor="#B6EFFA">
      <div align="center"><font face="Arial,Helvetica" size=-1> Loan
        Officer or Interviewer's Name: </font>
        <input onBlur="mark(this,'#ffffff','#000000')" name="agent_name" size="30" maxlength="30" onFocus="nextfield ='cb_income_used'; mark(this,'#ffffcc','#0000FF')">
<script type="text/javascript">
<!--
var UnFmtNme = location.search.substring(1);
var RemChar = "+"; // character to remove from string.
var AddChar = " "; // charactor to replace previous char removed.
while (UnFmtNme.indexOf(RemChar)>-1) {
pos= UnFmtNme.indexOf(RemChar);
UnFmtNme = "" + (UnFmtNme.substring(0, pos) + AddChar +
UnFmtNme.substring((pos + RemChar.length), UnFmtNme.length));
}
document.smartform.agent_name.value = UnFmtNme;
//-->
</script>
          </div>
        </td>
      </tr>
    </table>
    <br>
  </center>
    <p>


<center>
    <table BORDER=0 WIDTH="620" cellpadding="0" cellspacing="2" >
      <tr>
        <td VALIGN=TOP width="51"><a href="#./Help/Help01" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help01','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help01.php','help01','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.cb_income_used.focus()"><img src="images/helpB.gif" name="help01" border=0 height=15 width=46></a>
        </td>
        <td width="541" bgcolor="#B6EFFA"><font face="Arial,Helvetica" size=-1>
          <input onBlur="mark(this,'#B6EFFA','#000000')" type="checkbox" value="X" name="cb_income_used" onClick="offCheckboxSpouse();" onFocus="nextfield ='cb_income_not_used'; mark(this,'#ffffcc','#0000FF')">
          The income or assets of a person other than the "Borrower" (including
          the Borrowers spouse) <b><font color="#C20303">will be used</font></b>
          as a basis for loan qualification.</font></td>
      </tr>
      <tr>
        <td width="47"></td>
        <td width="541"></td>
      </tr>
      <tr>
        <td VALIGN=TOP width="51">&nbsp; </td>
        <td width="541" bgcolor="#B6EFFA"><font face="Arial,Helvetica" size=-1>
          <input onBlur="mark(this,'#B6EFFA','#000000')" type="checkbox" value="X" name="cb_income_not_used"  onClick="onCheckboxSpouse();" onFocus="nextfield ='laf_va'; mark(this,'#ffffcc','#0000FF')">
          The income or assets of the Borrower's spouse <b><font color="#C20303">will
          not be used</font></b> as a basis for loan qualification.</font></td>
      </tr>
    </table>
  </center>

<p>
<center>

    <p><a NAME="help1"></a><a NAME="help2"></a><a NAME="help3"></a><a NAME="help3b"></a></p>
      <table width="620" border="0" cellspacing="0" cellpadding="0">
        <tr>

        <td width="64" valign="top"><a href="#./Help/Help1" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help1','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help1.php','help1','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.laf_va.focus()"><img src="images/helpB.gif" name="help1" border=0 height=15 width=46></a></td>

        <td width="567">
          <table width="567" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td rowspan="2" valign="middle" align="center" bgcolor="#B6EFFA">
                <div align="center">
                  <p><font face="Arial,Helvetica" size="-1"><b>Loan Applied<br>
                    </b></font><font face="Arial,Helvetica" size="-1"><b>For:</b></font><font size="-1" face="Arial, Helvetica, sans-serif">(Choose one)</font></p>
                  </div>
              </td>
              <td bgcolor="#B6EFFA">
                <div align="left"><font face="Arial,Helvetica"><font face="Arial,Helvetica"><font size=-1>
                  <input onBlur="mark(this,'#B6EFFA','#000000')" type="checkbox" value="X" name="laf_va" onClick="pickOneLAF(this)" onFocus="nextfield ='laf_conv'; mark(this,'#ffffcc','#0000FF')">
                  </font></font><font size=-1>V.A </font></font></div>
              </td>
              <td bgcolor="#B6EFFA">
                <div align="left"><font face="Arial,Helvetica"><font face="Arial,Helvetica"><font size=-1>
                  <input onBlur="mark(this,'#B6EFFA','#000000')" type="checkbox" value="X" name="laf_conv" onClick="pickOneLAF(this)" onFocus="nextfield ='laf_fha'; mark(this,'#ffffcc','#0000FF')">
                  </font></font><font size=-1>Conventional </font></font></div>
              </td>
              <td bgcolor="#B6EFFA">
                <div align="left"><font face="Arial,Helvetica"><font face="Arial,Helvetica">
                  <input onBlur="mark(this,'#B6EFFA','#000000')" type="checkbox" value="X" name="laf_other" onClick="pickOneLAF(this)" onFocus="nextfield ='laf_other_explain'; mark(this,'#ffffcc','#0000FF')">
                  </font><font size=-1>Other </font> </font></div>
              </td>
            </tr>
            <tr>
              <td bgcolor="#B6EFFA">
                <div align="left"><font face="Arial,Helvetica"><font face="Arial,Helvetica"><font face="Arial,Helvetica"><font size=-1>
                  <input onBlur="mark(this,'#B6EFFA','#000000')" type="checkbox" value="X" name="laf_fha" onClick="pickOneLAF(this)" onFocus="nextfield ='laf_fmha'; mark(this,'#ffffcc','#0000FF')">
                  </font></font><font size=-1>FHA</font></font><font size=-1>
                  </font></font></div>
              </td>
              <td bgcolor="#B6EFFA">
                <div align="left"><font size="2" face="Arial, Helvetica, sans-serif">
                  <input onBlur="mark(this,'#B6EFFA','#000000')" type="checkbox" value="X" name="laf_fmha" onClick="pickOneLAF(this)" onFocus="nextfield ='laf_other'; mark(this,'#ffffcc','#0000FF')">
                  USDA/Rural Housing Service</font> </div>
              </td>
              <td bgcolor="#B6EFFA">
                <div align="center"><font size="2" face="Arial, Helvetica, sans-serif">If
                  Other (Type)
                  <input onBlur="mark(this,'#ffffff','#000000')" name="laf_other_explain" size="12" maxlength="15" onFocus="nextfield ='loan_amount'; mark(this,'#ffffcc','#0000FF')">
                  </font></div>
              </td>
            </tr>
          </table>

        </td>
        </tr>
      </table>

    <table width="620" border="0" cellspacing="2" cellpadding="0" bgcolor="#FFFFFF">
      <tr>
        <td width="51"><a href="#./Help/Help2" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help2','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help2.php','help2','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.loan_amount.focus()"><img src="images/helpB.gif" name="help2" border=0 height=15 width=46></a></td>
        <td width="282" bgcolor="#B6EFFA">
          <div align="center"><font face="Arial, Helvetica, sans-serif" size="-1"><b>Loan,
            Tax &amp; Insurance Information</b></font></div>
        </td>
        <td width="287" bgcolor="#B6EFFA">
          <div align="left">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%">
                  <div align="right"><font face="Arial,Helvetica" size="-1">Amount
                    Applied For: </font></div>
                </td>
                <td width="5%">
                  <div align="center"><font face="Arial,Helvetica" size="-1">$</font></div>
                </td>
                <td width="45%"><font face="Arial,Helvetica" size="-1">
                  <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="loan_amount" onChange="checksum();calcloan(this.form,'loan_amount');" size="12" maxlength="12" value="" onFocus="nextfield ='interest_rate'; mark(this,'#ffffcc','#0000FF')">
                  </font></td>
              </tr>
            </table>
          </div>
        </td>
      </tr>
      <tr>
        <td width="51"><a href="#./Help/Help3" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help3','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help3.php','help3','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.interest_rate.focus()"><img src="images/helpB.gif" name="help3" border=0 height=15 width=46></a></td>
        <td width="282" bgcolor="#B6EFFA">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="50%">
                <div align="right"><font face="Arial,Helvetica" size="-1">Interest
                  Rate:&nbsp;</font></div>
              </td>
              <td width="5%">&nbsp; </td>
              <td width="45%"><font face="Arial,Helvetica" size="-1">
                <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="interest_rate" onChange="checksum();calcloan(this.form,'interest_rate');" size="7" maxlength="7" value="" onFocus="nextfield ='number_of_months'; mark(this,'#ffffcc','#0000FF')">
                </font></td>
            </tr>
          </table>
        </td>
        <td width="287" bgcolor="#B6EFFA">
          <div align="left">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%">
                  <div align="right"><font face="Arial,Helvetica" size="-1">Number
                    of Months: </font></div>
                </td>
                <td width="5%">&nbsp;</td>
                <td width="45%"><font face="Arial,Helvetica" size="-1">
                  <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="number_of_months" onChange="checksum();calcloan(this.form,'number_of_months');" size="3" maxlength="3" value="" onFocus="nextfield ='yearly_taxes'; mark(this,'#ffffcc','#0000FF')">
                  </font></td>
              </tr>
            </table>
          </div>
        </td>
      </tr>
      <tr>
        <td width="51"><a href="#./Help/Help3b" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help3b','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help3b.php','help3b','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.yearly_taxes.focus()"><img src="images/helpB.gif" name="help3b" border=0 height=15 width=46></a></td>
        <td width="282" bgcolor="#B6EFFA">
          <div align="left">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%">
                  <div align="right"><font face="Arial,Helvetica" size="-1">Yearly
                    Taxes: </font></div>
                </td>
                <td width="5%">
                  <div align="center"><font face="Arial,Helvetica" size="-1">
                    $</font></div>
                </td>
                <td width="45%"><font face="Arial,Helvetica" size="-1">
                  <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="yearly_taxes" onChange="checksum();calcloan(this.form,'yearly_taxes'); " size="12" maxlength="12" value="" onFocus="nextfield ='yearly_insurance'; mark(this,'#ffffcc','#0000FF')">
                  </font></td>
              </tr>
            </table>
          </div>
        </td>
        <td width="287" bgcolor="#B6EFFA">
          <div align="left">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%">
                  <div align="right"><font face="Arial,Helvetica" size="-1">Yearly
                    Insurance: </font></div>
                </td>
                <td width="5%">
                  <div align="center"><font face="Arial,Helvetica" size="-1">$</font></div>
                </td>
                <td width="45%"><font face="Arial,Helvetica" size="-1">
                  <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="yearly_insurance" onChange="checksum();calcloan(this.form,'yearly_insurance');" size="12" maxlength="12" value="" onFocus="nextfield ='fixed'; mark(this,'#ffffcc','#0000FF')">
                  </font></td>
              </tr>
            </table>
          </div>
        </td>
      </tr>
    </table>

    <table width="620" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td width="51"><a href="#./Help/Help4" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help4','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help4.php','help4','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.fixed.focus()"><img src="images/helpB.gif" border=0 height=15 width=46></a></td>
        <td rowspan="2" bgcolor="#B6EFFA" width="151">
          <div align="center"><font face="Arial,Helvetica" size="-1"><b><a name="help4"></a>Amortization Type:</b><br>(Choose one)</font></div>
        </td>
        <td width="116" bgcolor="#B6EFFA">
          <div align="left"><font face="Arial,Helvetica" size="-1">
            <input onBlur="mark(this,'#B6EFFA','#000000')" type="checkbox" value="X" name="fixed" onClick="pickOneAMORT(this)" onFocus="nextfield ='amort_other'; mark(this,'#ffffcc','#0000FF')">
            Fixed Rate </font></div>
        </td>
        <td width="75" bgcolor="#B6EFFA">
          <div align="left"><font face="Arial,Helvetica" size="-1">
            <input onBlur="mark(this,'#B6EFFA','#000000')" type="checkbox" value="X" name="amort_other" onClick="pickOneAMORT(this)" onFocus="nextfield ='amort_gpm'; mark(this,'#ffffcc','#0000FF')">
            Other </font></div>
        </td>
        <td width="215" bgcolor="#B6EFFA">
          <div align="right"><font face="Arial,Helvetica" size="-1">If Other (explain)
            <input onBlur="mark(this,'#ffffff','#000000')" name="amort_explain" size="12" maxlength="30" onFocus="nextfield ='arm_type'; mark(this,'#ffffcc','#0000FF')">
            </font></div>
        </td>
      </tr>
      <tr>
        <td width="51">&nbsp;</td>
        <td width="116" bgcolor="#B6EFFA">
          <div align="left"><font face="Arial,Helvetica" size="-1">
            <input onBlur="mark(this,'#B6EFFA','#000000')" type="checkbox" value="X" name="amort_gpm" onClick="pickOneAMORT(this)" onFocus="nextfield ='amort_arm'; mark(this,'#ffffcc','#0000FF')">
            GPM </font></div>
        </td>
        <td width="75" bgcolor="#B6EFFA">
          <div align="left"><font face="Arial,Helvetica" size="-1">
            <input onBlur="mark(this,'#B6EFFA','#000000')" type="checkbox" value="X" name="amort_arm" onClick="pickOneAMORT(this)" onFocus="nextfield ='amort_explain'; mark(this,'#ffffcc','#0000FF')">
            ARM </font></div>
        </td>
        <td width="215" bgcolor="#B6EFFA">
          <div align="right"><font face="Arial,Helvetica" size="-1">If ARM (type)
            <input onBlur="mark(this,'#ffffff','#000000')" name="arm_type" size="12" maxlength="30" onFocus="nextfield ='subj_prop_street'; mark(this,'#ffffcc','#0000FF')">
            </font></div>
        </td>
      </tr>
    </table>
    <br>
    <br>
  </center>
  <center>
    <table BORDER=1 CELLSPACING=0 CELLPADDING=0 WIDTH="620" bordercolor="#006633" >
      <tr>
        <td bgcolor="#66CC33">
          <center>
            <a name="help5"></a><a NAME="tab3"></a><font face="Arial, Helvetica, sans-serif" color="#FFFFFF" size=+0><b>PROPERTY INFORMATION AND PURPOSE OF LOAN</b></font><a name="help6"></a><a name="help7"></a>
          </center>
</td>
</tr>
</table>
    <br>
  </center>
  <div align="center">

  </div>
  <center>
    <table width="620" border="0" cellspacing="2" cellpadding="0" align="center">
      <tr>
        <td width="51">&nbsp;</td>
        <td width="537" colspan="2" bgcolor="#C1F4B5"><b><font face="Arial,Helvetica" size="-1">Subject Property Address:</font></b></td>
      </tr>
      <tr>
        <td width="51"><a href="#./Help/Help5" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help5','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help5.php','help5','scrollbars=yes,resizable=yes,width=400,height=250')" onFocus="blur();document.smartform.subj_prop_street.focus()"><img src="images/helpB.gif" name="help5" border=0 height=15 width=46></a></td>
        <td width="220" bgcolor="#C1F4B5">
          <div align="right"><font face="Arial,Helvetica" size="-1">Street: </font></div>
        </td>
        <td width="317" bgcolor="#C1F4B5"> <font face="Arial,Helvetica" size="-1">
          <input onBlur="mark(this,'#ffffff','#000000')" name="subj_prop_street" size="30" maxlength="50" onFocus="nextfield ='subj_prop_city'; mark(this,'#ffffcc','#0000FF')">
          </font> </td>
      </tr>
      <tr>
        <td width="51">&nbsp;</td>
        <td width="220" bgcolor="#C1F4B5">
          <div align="right"><font face="Arial,Helvetica" size="-1">City, State,
            Zip:&nbsp;</font></div>
        </td>
        <td width="317" bgcolor="#C1F4B5"> <font face="Arial,Helvetica" size="-1">
          <input onBlur="mark(this,'#ffffff','#000000')" name="subj_prop_city" size="10" maxlength="25" onFocus="nextfield ='subj_prop_state'; mark(this,'#ffffcc','#0000FF')">
          <input onBlur="mark(this,'#ffffff','#000000')" name="subj_prop_state" size="3" maxlength="20" onFocus="nextfield ='subj_prop_zip'; mark(this,'#ffffcc','#0000FF')">
          <input onBlur="mark(this,'#ffffff','#000000')" name="subj_prop_zip" size="5" maxlength="10" onFocus="nextfield ='subj_prop_apn'; mark(this,'#ffffcc','#0000FF')">
          </font> </td>
      </tr>
      <tr>
        <td width="51"><a href="#./Help/Help6" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help6','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help6.php','help6','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.subj_prop_apn.focus()"><img src="images/helpB.gif" name="help6" border=0 height=15 width=46></a></td>
        <td width="220" bgcolor="#C1F4B5">
          <div align="right"><font face="Arial,Helvetica" size="-1">APN or Parcel
            Number:&nbsp;</font></div>
        </td>
        <td width="317" bgcolor="#C1F4B5"> <font face="Arial,Helvetica" size="-1">
          <input onBlur="mark(this,'#ffffff','#000000')" name="subj_prop_apn" size="30" maxlength="80" onFocus="nextfield ='num_units'; mark(this,'#ffffcc','#0000FF')">
          </font> </td>
      </tr>
      <tr>
        <td width="51"><a href="#./Help/Help7" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help7','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help7.php','help7','scrollbars=yes,resizable=yes,width=500,height=250')" onFocus="blur();document.smartform.num_units.focus()"><img src="images/helpB.gif" name="help7" border=0 height=15 width=46></a></td>
        <td width="220" bgcolor="#C1F4B5">
          <div align="right"><font face="Arial,Helvetica" size="-1">Number of
            Units:&nbsp;</font></div>
        </td>
        <td width="317" bgcolor="#C1F4B5"> <font face="Arial,Helvetica" size="-1">
          <input onBlur="mark(this,'#ffffff','#000000')" name="num_units" size="4" maxlength="4" onFocus="nextfield ='year_built'; mark(this,'#ffffcc','#0000FF')">
          &nbsp;&nbsp;&nbsp;&nbsp;Year Built:
          <input onBlur="mark(this,'#ffffff','#000000')" name="year_built" size="4" maxlength="4" onFocus="nextfield ='purch'; mark(this,'#ffffcc','#0000FF')">
          </font> </td>
      </tr>
    </table>
    <br>
    <table width="620" border="0" cellspacing="2" cellpadding="0" align="center">
      <tr>
        <td width="52"><a href="#./Help/Help8" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help8','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help8.php','help8','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.purch.focus()"><img src="images/helpB.gif" name="help8" border=0 height=15 width=46></a></td>
        <td colspan="3" bgcolor="#C1F4B5"><font face="Arial,Helvetica" color="#000000" size="-1"><a name="help8"></a><b>Purpose
          of Loan:&nbsp;</b> (Choose one)</font></td>
      </tr>
      <tr>
        <td width="52">&nbsp;</td>
        <td bgcolor="#C1F4B5" width="135">
          <div align="left"><font face="Arial,Helvetica" size="-1">
            <input onBlur="mark(this,'#C1F4B5','#000000')" type="checkbox" value="X" name="purch" onClick="pickOnePURP(this)" onFocus="nextfield ='constr'; mark(this,'#ffffcc','#0000FF')">Purchase </font></div>
        </td>
        <td width="153" bgcolor="#C1F4B5">
          <div align="left"><font face="Arial,Helvetica" size="-1">
            <input onBlur="mark(this,'#C1F4B5','#000000')" type="checkbox" value="X" name="constr" onClick="pickOnePURP(this)" onFocus="nextfield ='purp_other'; mark(this,'#ffffcc','#0000FF')">Construction </font></div>
        </td>
        <td width="270" bgcolor="#C1F4B5">
          <div align="left"><font face="Arial,Helvetica" size="-1">
            <input onBlur="mark(this,'#C1F4B5','#000000')" type="checkbox" value="X" name="purp_other" onClick="pickOnePURP(this)" onFocus="nextfield ='purp_refi'; mark(this,'#ffffcc','#0000FF')">Other </font></div>
        </td>
      </tr>
      <tr>
        <td width="52">&nbsp;</td>
        <td bgcolor="#C1F4B5" width="135">
          <div align="left"><font face="Arial,Helvetica" size="-1">
            <input onBlur="mark(this,'#C1F4B5','#000000')" type="checkbox" value="X" name="purp_refi" onClick="pickOnePURP(this)" onFocus="nextfield ='const_perm'; mark(this,'#ffffcc','#0000FF')">Refinance </font></div>
        </td>
        <td width="153" bgcolor="#C1F4B5">
          <div align="left"><font face="Arial,Helvetica" size="-1">
            <input onBlur="mark(this,'#C1F4B5','#000000')" type="checkbox" value="X" name="const_perm" onClick="pickOnePURP(this)" onFocus="nextfield ='purp_explain'; mark(this,'#ffffcc','#0000FF')">Constr.-permanent </font></div>
        </td>
        <td width="270" bgcolor="#C1F4B5">
          <div align="left"><font face="Arial,Helvetica" size="-1">&nbsp;&nbsp;If other (explain)
            <input onBlur="mark(this,'#ffffff','#000000')" name="purp_explain" size="12" maxlength="30" onFocus="nextfield ='prime_res'; mark(this,'#ffffcc','#0000FF')">
            </font></div>
        </td>
      </tr>
    </table>
    <br>
    <table width="620" border="0" cellspacing="2" cellpadding="0" align="center">
      <tr>
        <td width="51"><a href="#./Help/Help9" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help9','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help9.php','help9','scrollbars=yes,resizable=yes,width=500,height=260')" onFocus="blur();document.smartform.prime_res.focus()"><img src="images/helpB.gif" name="help9" border=0 height=15 width=46></a></td>
        <td colspan="3" bgcolor="#C1F4B5"><font face="Arial,Helvetica" color="#000000" size="-1"><b><a name="help9"></a>Property
          will be:</b> (Choose one)</font></td>
      </tr>
      <tr>
        <td width="51">&nbsp;</td>
        <td bgcolor="#C1F4B5" width="177">
          <div align="left"><font face="Arial,Helvetica" size="-1">
            <input onBlur="mark(this,'#C1F4B5','#000000')" type="checkbox" value="X" name="prime_res" onClick="pickOneRES(this)" onFocus="nextfield ='second_res'; mark(this,'#ffffcc','#0000FF')">Primary Residence&nbsp; </font></div>
        </td>
        <td width="208" bgcolor="#C1F4B5">
          <div align="left"><font face="Arial,Helvetica" size="-1">
            <input onBlur="mark(this,'#C1F4B5','#000000')" type="checkbox" value="X" name="second_res" onClick="pickOneRES(this)" onFocus="nextfield ='invest'; mark(this,'#ffffcc','#0000FF')">Secondary Residence&nbsp; </font></div>
        </td>
        <td width="158" bgcolor="#C1F4B5">
          <div align="left"><font face="Arial,Helvetica" size="-1">
            <input onBlur="mark(this,'#C1F4B5','#000000')" type="checkbox" value="X" name="invest" onClick="pickOneRES(this)" onFocus="nextfield ='const_yr'; mark(this,'#ffffcc','#0000FF')">Investment&nbsp; </font></div>
        </td>
      </tr>
    </table>
    <br>
    <table width="620" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="10">
          <div align="center"><b><font face="Arial,Helvetica" size=-1>Complete
            below if construction or construction-to-permanent loan<a name="help10"></a><a name="help11"></a><a name="help12"></a></font></b></div>
        </td>
      </tr>
      <tr>
        <td valign="top" height="29">
          <table width="100%" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td width="51"><a href="#./Help/Help10" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help10','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help10.php','help10','scrollbars=yes,resizable=yes,width=500,height=250')" onFocus="blur();document.smartform.const_yr.focus()"><img src="images/helpB.gif" name="help10" border=0 height=15 width=46></a></td>
              <td bgcolor="#C1F4B5" width="310">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="60%">
                      <div align="right"><font face="Arial,Helvetica" size=-1>Year
                        Lot Acquired:&nbsp;</font></div>
                    </td>
                    <td width="40%">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="const_yr" size="4" maxlength="4" onFocus="nextfield ='const_cost'; mark(this,'#ffffcc','#0000FF')">
                    </td>
                  </tr>
                </table>
              </td>
              <td bgcolor="#C1F4B5" width="251">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="50%">
                      <div align="right"><font face="Arial,Helvetica" size=-1>Original
                        Cost:&nbsp;$&nbsp;</font></div>
                    </td>
                    <td>
                      <input onBlur="mark(this,'#ffffff','#000000')" name="const_cost" size="8" maxlength="10" onFocus="nextfield ='const_liens'; mark(this,'#ffffcc','#0000FF')">
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td width="51"><a href="#./Help/Help11" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help11','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help11.php','help11','scrollbars=yes,resizable=yes,width=500,height=250')" onFocus="blur();document.smartform.const_liens.focus()"><img src="images/helpB.gif" name="help11" border=0 height=15 width=46></a></td>
              <td bgcolor="#C1F4B5" width="310">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="60%">
                      <div align="right"><font face="Arial,Helvetica" size=-1>Amount
                        Existing Liens: $&nbsp;</font></div>
                    </td>
                    <td width="40%">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="const_liens" size="8" maxlength="10" onFocus="nextfield ='const_value_lot'; mark(this,'#ffffcc','#0000FF')">
                    </td>
                  </tr>
                </table>
              </td>
              <td bgcolor="#C1F4B5" width="251">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="50%">
                      <div align="right"><font face="Arial,Helvetica" size=-1>Value
                        of Lot: $&nbsp;</font></div>
                    </td>
                    <td>
                      <input onBlur="mark(this,'#ffffff','#000000')" name="const_value_lot" size="8" maxlength="10" onFocus="nextfield ='const_cost_improve'; mark(this,'#ffffcc','#0000FF')">
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td width="51"><a href="#./Help/Help12" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help12','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help12.php','help12','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.const_cost_improve.focus()"><img src="images/helpB.gif" name="help12" border=0 height=15 width=46></a></td>
              <td bgcolor="#C1F4B5" width="310">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="60%">
                      <div align="right"><font face="Arial,Helvetica" size=-1>Cost
                        of Improvements: $&nbsp;</font></div>
                    </td>
                    <td width="40%">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="const_cost_improve" size="8" maxlength="10" onFocus="nextfield ='const_total_value'; mark(this,'#ffffcc','#0000FF')">
                    </td>
                  </tr>
                </table>
              </td>
              <td bgcolor="#C1F4B5" width="251">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="50%">
                      <div align="right"><font face="Arial,Helvetica" size=-1>Total
                        Value: $&nbsp;</font></div>
                    </td>
                    <td>
                      <input onBlur="mark(this,'#ffffff','#000000')" name="const_total_value" size="8" maxlength="10" onFocus="nextfield ='refi_yr'; mark(this,'#ffffcc','#0000FF')">
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>

        </td>
      </tr>
    </table>
    <br>
    <table width="620" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top" height="142">
          <div align="center"><a name="help13"></a><a name="help14"></a><a name="help15"></a><b><font face="Arial,Helvetica" size=-1>Complete below if this is a refinance loan</font></b></div>
          <table width="100%" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td width="51"><a href="#./Help/Help13" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help13','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help13.php','help13','scrollbars=yes,resizable=yes,width=500,height=280')" onFocus="blur();document.smartform.refi_yr.focus()"><img src="images/helpB.gif" name="help13" border=0 height=15 width=46></a></td>
              <td width="252" bgcolor="#C1F4B5">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="61%">
                      <div align="right"><font face="Arial,Helvetica" size=-1>Year
                        Acquired:&nbsp;</font></div>
                    </td>
                    <td width="39%">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="refi_yr" size="4" maxlength="4" onFocus="nextfield ='refi_cost'; mark(this,'#ffffcc','#0000FF')">
                    </td>
                  </tr>
                </table>
              </td>
              <td width="309" bgcolor="#C1F4B5">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="40%">
                      <div align="right"><font face="Arial,Helvetica" size=-1>Original
                        Cost:&nbsp;$&nbsp;</font></div>
                    </td>
                    <td>
                      <input onBlur="mark(this,'#ffffff','#000000')" name="refi_cost" size="8" maxlength="10" onFocus="nextfield ='refi_exist_liens'; mark(this,'#ffffcc','#0000FF')">
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td width="51"><a href="#./Help/Help14" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help14','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help14.php','help14','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.refi_exist_liens.focus()"><img src="images/helpB.gif" name="help14" border=0 height=15 width=46></a></td>
              <td width="252" bgcolor="#C1F4B5">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="61%">
                      <div align="right"><font face="Arial,Helvetica" size=-1>Amount
                        Existing Liens:&nbsp;$&nbsp;</font></div>
                    </td>
                    <td width="39%">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="refi_exist_liens" size="8" maxlength="10" onFocus="nextfield ='purpose_of_refi'; mark(this,'#ffffcc','#0000FF')">
                    </td>
                  </tr>
                </table>
              </td>
              <td width="309" bgcolor="#C1F4B5">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="40%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Purpose
                        of Refi:&nbsp;</font></font></div>
                    </td>
                    <td>
                      <select name="purpose_of_refi" onFocus="nextfield ='improve_made';">
                        <option value="">Please Select</option>
                        <option value="No Cash-Out">No Cash-Out</option>
                        <option value="Cash-Out/Other">Cash-Out/Other</option>
                        <option value="Cash-Out/Home Improvement">Cash-Out/Home Improvement</option>
                        <option value="Cash-Out/Debt Consolidation">Cash-Out/Debt Consolidation</option>
                        <option value="Limited Cash-Out">Limited Cash-Out</option>
                      </select>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td width="51"><a href="#./Help/Help15" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help15','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help15.php','help15','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.improve_made.focus()"><img src="images/helpB.gif" name="help15" border=0 height=15 width=46></a></td>
              <td width="252" bgcolor="#C1F4B5">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="49%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Imprvements
                        made: </font></font></div>
                    </td>
                    <td width="51%">
                      <input onBlur="mark(this,'#C1F4B5','#000000')" type="checkbox" value="X" name="improve_made" onClick="offCheckboxImprove();" onFocus="nextfield ='improve_to_be_made'; mark(this,'#ffffcc','#0000FF')">
                      <font face="Arial,Helvetica"><font size=-1>To be made:</font></font>
<input onBlur="mark(this,'#C1F4B5','#000000')" type="checkbox" value="X" name="improve_to_be_made" onClick="onCheckboxImprove();" onFocus="nextfield ='improve_cost'; mark(this,'#ffffcc','#0000FF')">
                    </td>
                  </tr>
                </table>
              </td>
              <td width="309" bgcolor="#C1F4B5">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="59%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Cost
                        of Improvements: $ </font></font></div>
                    </td>
                    <td width="41%">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="improve_cost" size="8" maxlength="10" onFocus="nextfield ='improvements_description'; mark(this,'#ffffcc','#0000FF')">
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td width="51">&nbsp;</td>
              <td colspan="2" bgcolor="#C1F4B5">
                <div align="center"><font face="Arial,Helvetica"><font size=-1>
                  Please Describe improvements (if any):
                  <input onBlur="mark(this,'#ffffff','#000000')" name="improvements_description" size="35" maxlength="35" onFocus="nextfield ='title_held_in'; mark(this,'#ffffcc','#0000FF')">
                  </font></font></div>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <br>
    <br>
  </center>
    <center>
    <table BORDER=1 CELLSPACING=0 CELLPADDING=0 WIDTH="620" BGCOLOR="#D1149D" bordercolor="#811270" >
      <tr>
<td>
<center><a NAME="tab4"></a><b><font face="Arial,Helvetica"><font color="#FFFFFF"><font size=+0>VESTING
INFORMATION&nbsp;</font></font></font></b><a NAME="help16"></a><a NAME="help17"></a></center>
</td>
</tr>
</table>
    <br>
  </center>

<center>
    <table BORDER=0 WIDTH="620" >
      <tr>
        <td width="51"><a href="#./Help/Help16" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help16','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help16.php','help16','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.title_held_in.focus()"><img src="images/helpB.gif" name="help16" border=0 height=15 width=46></a></td>
        <td rowspan="2" bgcolor="#E8C6E1"><font face="Arial,Helvetica"><font size=-1>Title
          will be held in what names (enter below):</font></font>
          <center>
            <input onBlur="mark(this,'#ffffff','#000000')" NAME="title_held_in" SIZE="60" MAXLENGTH="60" onFocus="nextfield ='title_held_manner'; mark(this,'#ffffcc','#0000FF')">
          </center>
        </td>
      </tr>
      <tr>
        <td width="51">&nbsp;</td>
      </tr>
      <tr>
        <td width="51"><a href="#./Help/Help17" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help17','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help17.php','help17','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.title_held_manner.focus()"><img src="images/helpB.gif" name="help17" border=0 height=15 width=46></a></td>
        <td rowspan="2" bgcolor="#E8C6E1"><a NAME="help18"></a><font face="Arial,Helvetica"><font size=-1>Manner
          in which title will be held (enter below):</font></font>
          <center>
            <input onBlur="mark(this,'#ffffff','#000000')" NAME="title_held_manner" SIZE="60" MAXLENGTH="60" onFocus="nextfield ='source_down_pymt'; mark(this,'#ffffcc','#0000FF')">
          </center>
        </td>
      </tr>
      <tr>
        <td width="51">&nbsp;</td>
      </tr>
      <tr>
        <td width="51"><a href="#./Help/Help18" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help18','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help18.php','help18','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.source_down_pymt.focus()"><img src="images/helpB.gif" name="help18" border=0 height=15 width=46></a></td>
        <td rowspan="2" bgcolor="#E8C6E1"><a NAME="help19"></a><font face="Arial,Helvetica"><font size=-1>Source
          of Down Payment, Settlement Charges and/or Subordinate Financing:<br>
          </font></font><font face="Arial,Helvetica"><font size=-1>Please explain:&nbsp;</font></font>
          <center>
		  <select name="source_down_pymt" onFocus="nextfield ='fee_simple';">
                        <option value="">Please Select</option>
                        <option value="Checking/Savings">Checking/Savings</option>
                        <option value="Deposit on Sales Contract">Deposit on Sales Contract</option>
                        <option value="Equity Sold on Property">Equity Sold on Property</option>
                        <option value="Equity Pending from Sale">Equity Pending from Sale</option>
                        <option value="Equity Pending from Subject Property">Equity Pending from Subject Property</option>
						<option value="Gift Funds">Gift Funds</option>
                        <option value="Stocks and Bonds">Stocks and Bonds</option>
                        <option value="Lot Equity">Lot Equity</option>
                        <option value="Bridge Loan">Bridge Loan</option>
						<option value="Secured Borrowed Funds">Secured Borrowed Funds</option>
                        <option value="Unsecured Borrowed Funds">Unsecured Borrowed Funds</option>
						<option value="Trust Funds">Trust Funds</option>
                        <option value="Retirement Funds">Retirement Funds</option>
                        <option value="Rent with option to purchase">Rent with option to purchase</option>
                        <option value="Life insurance cash value">Life insurance cash value</option>
                        <option value="Sale of Chattel">Sale of Chattel</option>
						<option value="Trade Equity">Trade Equity</option>
                        <option value="Sweat Equity">Sweat Equity</option>
                        <option value="Cash on hand">Cash on hand</option>
                        <option value="Other">Other</option>
                      </select>
          </center>
        </td>
      </tr>
      <tr>
        <td width="51">&nbsp;</td>
      </tr>
      <tr>
        <td width="51"><a href="#./Help/Help19" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help19','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help19.php','help19','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.fee_simple.focus()"><img src="images/helpB.gif" name="help19" border=0 height=15 width=46></a></td>
        <td width="530" bgcolor="#E8C6E1"><font face="Arial,Helvetica"><font size=-1>Estate
          will be held in:&nbsp; Fee Simple:&nbsp;
          <input onBlur="mark(this,'#E8C6E1','#000000')" type="checkbox" value="X" name="fee_simple" onClick="offCheckboxEstate();" onFocus="nextfield ='leasehold'; mark(this,'#ffffcc','#0000FF')">
          </font><font face="Arial,Helvetica"><font size=-1>Leasehold:&nbsp;</font></font>
          <input onBlur="mark(this,'#E8C6E1','#000000')" type="checkbox" value="X" name="leasehold" onClick="onCheckboxEstate();" onFocus="nextfield ='leasehold_date'; mark(this,'#ffffcc','#0000FF')">
          </font></td>
      </tr>
      <tr>
        <td width="51">&nbsp;</td>
        <td width="530" bgcolor="#E8C6E1"><font face="Arial,Helvetica"><font size=-1>If
          Leasehold Estate, enter expiration date:
          <input onBlur="mark(this,'#ffffff','#000000')" name="leasehold_date" size="10" maxlength="10" onFocus="nextfield ='b_first_name'; mark(this,'#ffffcc','#0000FF')">
          </font></font></td>
      </tr>
    </table>
    <br>
    <br>
  </center>

<center>
  </center>

<center>
  </center>

<center>
    <table BORDER=1 CELLSPACING=0 CELLPADDING=0 WIDTH="620" bgcolor="#E98458" bordercolor="#B74915" >
      <tr BGCOLOR="#B34E03">
        <td bgcolor="#E98458">
          <center>
            <a NAME="tab5"></a><b><font face="Arial, Helvetica, sans-serif"><font color="#FFFFFF"><font size=+0>BORROWER
            INFORMATION&nbsp;</font></font></font></b><a NAME="help20"></a><a NAME="help21"></a><a NAME="help22"></a><a NAME="help23"></a>
</center>
</td>
</tr>
</table>
    <br>
    <table width="620" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td width="51">&nbsp;</td>
        <td colspan="3">
          <div align="left"><b><font face="Arial,Helvetica" size="-1">Enter Borrower's
            Name Below </font></b><font face="Arial,Helvetica" size="-1">(include
            Jr. or Sr. if applicable)</font></div>
        </td>
      </tr>
      <tr>
        <td width="51"><a href="#./Help/Help20" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help20','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help20.php','help20','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.b_first_name.focus()"><img src="images/helpB.gif" name="help20" border=0 height=15 width=46></a></td>
        <td width="239" bgcolor="#FFDBBF">
          <div align="right"><font face="Arial,Helvetica"><font size=-1>First
            Name:</font><font face="Arial,Helvetica" size="-1">
            <input onBlur="mark(this,'#ffffff','#000000')" name="b_first_name" size="15" maxlength="20" onFocus="nextfield ='b_mi_name'; mark(this,'#ffffcc','#0000FF')">
            </font><font size=-1>&nbsp;</font></font></div>
        </td>
        <td width="77" bgcolor="#FFDBBF">
          <div align="center"><font face="Arial,Helvetica" size="-1">Mi.:</font>
            <font face="Arial,Helvetica" size="-1">
            <input onBlur="mark(this,'#ffffff','#000000')" name="b_mi_name" size="2" maxlength="4" onFocus="nextfield ='b_last_name'; mark(this,'#ffffcc','#0000FF')">
            </font></div>
        </td>
        <td width="225" bgcolor="#FFDBBF">
          <div align="center"><font face="Arial,Helvetica"><font size=-1>Last
            Name:</font><font face="Arial,Helvetica" size="-1">
            <input onBlur="mark(this,'#ffffff','#000000')" name="b_last_name" size="15" maxlength="25" onFocus="nextfield ='b_soc_sec'; mark(this,'#ffffcc','#0000FF')">
            </font></font> </div>
        </td>
      </tr>
      <tr>
        <td width="51">&nbsp;</td>
        <td width="239" bgcolor="#FFDBBF">
          <div align="right"><font face="Arial,Helvetica"><font face="Arial,Helvetica" size="-1">
            </font><font size=-1>Soc. Sec. No.:</font><font face="Arial,Helvetica" size="-1">
            <input onBlur="mark(this,'#ffffff','#000000')" name="b_soc_sec" size="15" maxlength="15" onFocus="nextfield ='b_phone'; mark(this,'#ffffcc','#0000FF')">
            </font><font size=-1>&nbsp;</font></font></div>
        </td>
        <td colspan="2" bgcolor="#FFDBBF"><font face="Arial,Helvetica"><font size=-1>Home
          Phone:</font><font face="Arial,Helvetica" size="-1">
          <input onBlur="mark(this,'#ffffff','#000000')" name="b_phone" size="15" maxlength="20" onFocus="nextfield ='b_age'; mark(this,'#ffffcc','#0000FF')">
          </font></font> </td>
      </tr>
    </table>
    <br>
    <table width="620" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td width="50"><a href="#./Help/Help21" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help21','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help21.php','help21','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.b_age.focus()"><img src="images/helpB.gif" name="help21" border=0 height=15 width=46></a></td>
        <td bgcolor="#FFDBBF" width="248">
          <div align="center"><font face="Arial,Helvetica" size="-1">DOB (mm/dd/yyyy):
		  <input type="text" id="b_age" name="b_age" size='10' maxlength="10" onFocus="javascript:vDateType='1',nextfield='b_school'; mark(this,'#ffffcc','#0000FF')" onKeyUp="DateFormat(this,this.value,event,false,'1')" onBlur="DateFormat(this,this.value,event,true,'1'); mark(this,'#ffffff','#000000')">&nbsp;<a href="javascript:NewCal('b_age','mmddyyyy')" onFocus="blur();document.smartform.b_school.focus()"><img src="cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></font></div>
        </td>
        <td bgcolor="#FFDBBF" width="314">
          <div align="center"><font face="Arial,Helvetica"><font face="Arial,Helvetica" size="-1">Yrs.
            in School:</font><font size=-1>
            <input onBlur="mark(this,'#ffffff','#000000')" name="b_school" size="2" maxlength="2" onFocus="nextfield ='b_married'; mark(this,'#ffffcc','#0000FF')">
            &nbsp;</font></font></div>
        </td>
      </tr>
      <tr>
        <td width="50">&nbsp;</td>
        <td colspan="2" bgcolor="#FFDBBF"><font face="Arial,Helvetica"><font size=-1>
          </font></font><font face="Arial,Helvetica" size="-1">&nbsp;Marital Status:</font>
          <font face="Arial,Helvetica"><font size=-1>
          <input onBlur="mark(this,'#FFDBBF','#000000')" type="checkbox" value="X" name="b_married" onClick="pickOneBMAR(this)" onFocus="nextfield ='b_separated'; mark(this,'#ffffcc','#0000FF')">
          </font></font><font face="Arial,Helvetica" size="-1">Married&nbsp;&nbsp;</font><font face="Arial,Helvetica"><font size=-1>
          </font><font face="Arial,Helvetica" size="-1">
          <input onBlur="mark(this,'#FFDBBF','#000000')" type="checkbox" value="X" name="b_separated" onClick="pickOneBMAR(this)" onFocus="nextfield ='b_unmarried'; mark(this,'#ffffcc','#0000FF')">
          Separated&nbsp;&nbsp;</font></font> <font face="Arial,Helvetica" size="-1">
          <input onBlur="mark(this,'#FFDBBF','#000000')" type="checkbox" value="X" name="b_unmarried" onClick="pickOneBMAR(this)" onFocus="nextfield ='b_depend'; mark(this,'#ffffcc','#0000FF')">
          Unmarried</font> <font face="Arial,Helvetica" size="-2">(includes single,
          divorced, widowed)</font> </td>
      </tr>
    </table>
    <br>
    <table width="620" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td width="51"><a href="#./Help/Help22" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help22','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help22.php','help22','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.b_depend.focus()"><img src="images/helpB.gif" name="help22" border=0 height=15 width=46></a></td>
        <td width="246" bgcolor="#FFDBBF"><font face="Arial,Helvetica"><font size=-1>&nbsp;&nbsp;Dependents:</font></font>
          <font face="Arial,Helvetica"><font size=-1>(How many?)&nbsp;</font></font>
          <input onBlur="mark(this,'#ffffff','#000000')" name="b_depend" size="2" maxlength="2" onFocus="nextfield ='b_dep_ages'; mark(this,'#ffffcc','#0000FF')">
        </td>
        <td width="315" bgcolor="#FFDBBF"><font face="Arial,Helvetica"><font size="-1">&nbsp;&nbsp;What
          are their ages?
          <input onBlur="mark(this,'#ffffff','#000000')" name="b_dep_ages" size="15" maxlength="15" onFocus="nextfield ='copy'; mark(this,'#ffffcc','#0000FF')">
          </font></font></td>
      </tr>
    </table>
    <br>
    <table width="620" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td width="53">
          <div align="center"><font face="Arial, Helvetica, sans-serif" size="-1" color="#FF0000"><b><font color="#C20303">NOTE:</font></b></font></div>
        </td>
        <td colspan="2" bgcolor="#FFFFFF"><font face="Arial, Helvetica, sans-serif" size="-1" color="#B34E03"><b>&nbsp;<font color="#C20303">&nbsp;If
          Borrower address is the same as Subject Property address, check the
          box:</font>
          <input onBlur="mark(this,'#FFDBBF','#000000')" type="checkbox" name="copy"
onClick="javascript:duplicate(this.form);" value="checkbox" onFocus="nextfield ='b_res_street'; mark(this,'#ffffcc','#0000FF')">
          </b></font></td>
      </tr>
      <tr>
        <td width="53"><a href="#./Help/Help23" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help23','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help23.php','help23','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.b_res_street.focus()"><img src="images/helpB.gif" name="help23" border=0 height=15 width=46></a></td>
        <td colspan="2"><b><font face="Arial,Helvetica" size="-1">Present Address:</font></b></td>
      </tr>
      <tr>
        <td width="53">&nbsp;</td>
        <td width="402" bgcolor="#FFDBBF">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="32%">
                <div align="right"><font face="Arial,Helvetica" size="-1">Street:&nbsp;
                  </font></div>
              </td>
              <td width="68%"> <font face="Arial,Helvetica" size="-1">
                <input onBlur="mark(this,'#ffffff','#000000')" name="b_res_street" size="30" maxlength="30" onFocus="nextfield ='b_own_home'; mark(this,'#ffffcc','#0000FF')">
                </font> </td>
            </tr>
          </table>
        </td>
        <td width="157" bgcolor="#FFDBBF"><font face="Arial,Helvetica" size="-1">
          Own:
          <input onBlur="mark(this,'#FFDBBF','#000000')" type="checkbox" value="X" name="b_own_home" onClick="offCheckboxOwn1();" onFocus="nextfield ='b_rent_home'; mark(this,'#ffffcc','#0000FF')">
          &nbsp;Rent</font>: <font face="Arial,Helvetica" size="-1">
          <input onBlur="mark(this,'#FFDBBF','#000000')" type="checkbox" value="X" name="b_rent_home"  onClick="onCheckboxOwn1();" onFocus="nextfield ='b_res_city'; mark(this,'#ffffcc','#0000FF')">
          </font> </td>
      </tr>
      <tr>
        <td width="53">&nbsp;</td>
        <th width="402" bgcolor="#FFDBBF">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="32%">
                <div align="right"><font face="Arial,Helvetica" size="-1">City,
                  State, Zip:&nbsp;</font></div>
              </td>
              <td width="68%"> <font face="Arial,Helvetica"><font face="Arial,Helvetica" size="-1">
                <input onBlur="mark(this,'#ffffff','#000000')" name="b_res_city" size="10" maxlength="20" onFocus="nextfield ='b_res_state'; mark(this,'#ffffcc','#0000FF')">
                </font><font size=-1>
                <input onBlur="mark(this,'#ffffff','#000000')" name="b_res_state" size="3" maxlength="20" onFocus="nextfield ='b_res_zip'; mark(this,'#ffffcc','#0000FF')">
                <input onBlur="mark(this,'#ffffff','#000000')" name="b_res_zip" size="5" maxlength="10" onFocus="nextfield ='b_yrs_at_res'; mark(this,'#ffffcc','#0000FF')">
                </font></font> </td>
            </tr>
          </table>
        </th>
        <td bgcolor="#FFDBBF" width="157"><font face="Arial,Helvetica" size="-1">&nbsp;&nbsp;Number
          of years:</font> <font face="Arial,Helvetica" size="-1">
          <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="b_yrs_at_res" size="4" maxlength="4" onFocus="nextfield ='add_res_record1'; mark(this,'#ffffcc','#0000FF')">
          </font> </td>
      </tr>
    </table>
   <table BORDER=0 WIDTH="620" align="center">
  <tr>

        <td width="579" bgcolor="#FFDBBF"><b><font face="Arial,Helvetica"><font size=-1>If
          Mailing Address is different than Present Address above, click &quot;Yes&quot;:&nbsp;&nbsp;</font><font face="Arial, Helvetica, sans-serif" size="2"><b><font face="Arial,Helvetica"><font face="Arial, Helvetica, sans-serif" size="-1">Yes:
          <input onBlur="mark(this,'#FFDBBF','#000000')" type="checkbox" name="add_res_record1" onClick="hideRes1(); changeResDiv1('res_questions1','block'); offCheckbox(); if (this.checked) document.smartform.b_former_street.focus();" onFocus="mark(this,'#ffffcc','#0000FF');">
          &nbsp;&nbsp; No:</font> <font face="Arial, Helvetica, sans-serif" size="-1">
          </font><font face="Arial, Helvetica, sans-serif" size="2"><b><font face="Arial,Helvetica"><font face="Arial, Helvetica, sans-serif" size="-1">
          <input onBlur="mark(this,'#FFDBBF','#000000')" type="checkbox" name="add_res_record1no" onClick="hideRes1(); onCheckbox();"  onFocus="nextfield='copy2'; mark(this,'#ffffcc','#0000FF')">
          </font></font></b></font></font></b></font></font></b></td>
      </tr>
    </table>
	</center>
    <br>
<div id="res_questions1" style="margin-left:0px; display:none">



<center>
    <table BORDER=0 WIDTH="620" >
      <tr>
          <td width="579"><b><font face="Arial,Helvetica"><font size=-1>If Mailing
            Address is different than Present Address above, enter Mailing Address
            below:<a name="help24"></a></font></font></b></td>
      </tr>
    </table>
  </center>
<center>
      <table BORDER=0 WIDTH="620" >
        <tr>
          <td WIDTH="46"><a href="#./Help/Help24" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help24','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help24.php','help24','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.b_former_street.focus()"><img src="images/helpB.gif" name="help24" border=0 height=15 width=46></a></td>
          <td WIDTH="124"><b><font face="Arial,Helvetica"><font size="-1">Mailing
            Address:</font></font></b></td>
          <td WIDTH="436"></td>
        </tr>
        <tr>
          <td ALIGN=RIGHT width="46">&nbsp;</td>
          <td ALIGN=RIGHT width="124" bgcolor="#FFDBBF"><font face="Arial,Helvetica"><font size=-1>Street:&nbsp;</font></font></td>
          <td width="436" bgcolor="#FFDBBF">
            <input onBlur="mark(this,'#ffffff','#000000')" NAME="b_former_street" SIZE="30" MAXLENGTH="30" onFocus="nextfield ='b_former_city'; mark(this,'#ffffcc','#0000FF')">
          </td>
        </tr>
        <tr>
          <td ALIGN=RIGHT width="46">&nbsp;</td>
          <td ALIGN=RIGHT width="124" bgcolor="#FFDBBF"><font face="Arial,Helvetica"><font size=-1>City,
            State, Zip:&nbsp;</font></font></td>
          <td width="436" bgcolor="#FFDBBF">
            <input onBlur="mark(this,'#ffffff','#000000')" NAME="b_former_city" SIZE="10" MAXLENGTH="20" onFocus="nextfield ='b_former_state'; mark(this,'#ffffcc','#0000FF')">
            <input onBlur="mark(this,'#ffffff','#000000')" NAME="b_former_state" SIZE="3" MAXLENGTH="20" onFocus="nextfield ='b_former_zip'; mark(this,'#ffffcc','#0000FF')">
            <input onBlur="mark(this,'#ffffff','#000000')" NAME="b_former_zip" SIZE="5" MAXLENGTH="10" onFocus="nextfield ='add_res_record2'; mark(this,'#ffffcc','#0000FF')">
          </td>
        </tr>
      </table>
    </center>

<table border=0 width="620" align="center" >
  <tr>
        <td width="579" bgcolor="#FFDBBF"><b><font face="Arial,Helvetica"><font size=-1>If
          residing at Present Address for less than two years, click &quot;Yes&quot;:&nbsp;&nbsp;</font><font face="Arial, Helvetica, sans-serif" size="2"><b><font face="Arial,Helvetica"><font face="Arial, Helvetica, sans-serif" size="-1">Yes:
          <input onBlur="mark(this,'#FFDBBF','#000000')" type="checkbox" name="add_res_record2" onClick="hideRes2(); changeResDiv2('res_questions2','block'); offCheckbox2(); if (this.checked) document.smartform.b_2former_street.focus();" onFocus="mark(this,'#ffffcc','#0000FF');">
      &nbsp;&nbsp; No:</font> <font face="Arial, Helvetica, sans-serif" size="-1">
      <input onBlur="mark(this,'#FFDBBF','#000000')" type="checkbox" name="add_res_record2no" onClick="hideRes2(); onCheckbox2();"  onFocus="nextfield='copy2'; mark(this,'#ffffcc','#0000FF')">
          </font></font></b></font></font></b></td>
  </tr>
</table>
    <br>
  </div>
<div id="res_questions2" style="margin-left:0px;display:visible">
<center><table BORDER=0 WIDTH="620" >
<tr>
          <td><b><font face="Arial,Helvetica"><font size=-1>If residing at Present
            Address for less than two years, complete the following:<a name="help24A"></a></font></font></b></td>

<td></td>
</tr>
</table></center>

<center>
    <table BORDER=0 WIDTH="620" >
      <tr>
        <td WIDTH="51"><a href="#./Help/Help24A" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help24A','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help24A.php','help24A','scrollbars=yes,resizable=yes,width=500,height=260')" onFocus="blur();document.smartform.b_2former_street.focus()"><img src="images/helpB.gif" name="help24A" border=0 height=15 width=46></a></td>
          <td WIDTH="118"><b><font face="Arial,Helvetica"><font size=-1>Former
            Address:&nbsp;</font></font></b></td>
          <td WIDTH="277"></td>
          <td width="156"></td>
      </tr>
      <tr>
        <td ALIGN=RIGHT width="51">&nbsp;</td>
          <td ALIGN=RIGHT width="118" bgcolor="#FFDBBF"><font face="Arial,Helvetica"><font size=-1>Street:&nbsp;</font></font></td>
          <td width="277" bgcolor="#FFDBBF">
            <input onBlur="mark(this,'#ffffff','#000000')" name="b_2former_street" size="30" maxlength="30" onFocus="nextfield ='b_2former_own'; mark(this,'#ffffcc','#0000FF')">
        </td>
          <td width="156" bgcolor="#FFDBBF"><font face="Arial,Helvetica"><font size=-1>Own:&nbsp;
            <input onBlur="mark(this,'#FFDBBF','#000000')" type="checkbox" value="X" name="b_2former_own" onClick="offCheckboxOwn3();" onFocus="nextfield ='b_2former_rent'; mark(this,'#ffffcc','#0000FF')">
          &nbsp; Rent:&nbsp;</font></font>
          <input onBlur="mark(this,'#FFDBBF','#000000')" type="checkbox" value="X" name="b_2former_rent" onClick="onCheckboxOwn3();" onFocus="nextfield ='b_2former_city'; mark(this,'#ffffcc','#0000FF')">
        </td>
      </tr>
      <tr>
        <td ALIGN=RIGHT width="51">&nbsp;</td>
          <td ALIGN=RIGHT width="118" bgcolor="#FFDBBF"><font face="Arial,Helvetica"><font size=-1>City,
            State, Zip:&nbsp;</font></font></td>
          <td width="277" bgcolor="#FFDBBF">
            <input onBlur="mark(this,'#ffffff','#000000')" name="b_2former_city" size="10" maxlength="20" onFocus="nextfield ='b_2former_state'; mark(this,'#ffffcc','#0000FF')">
          <input onBlur="mark(this,'#ffffff','#000000')" name="b_2former_state" size="3" maxlength="20" onFocus="nextfield ='b_2former_zip'; mark(this,'#ffffcc','#0000FF')">
          <input onBlur="mark(this,'#ffffff','#000000')" name="b_2former_zip" size="5" maxlength="10" onFocus="nextfield ='b_2former_yrs'; mark(this,'#ffffcc','#0000FF')">
        </td>
          <td width="156" bgcolor="#FFDBBF"><font face="Arial,Helvetica"><font size=-1>Number
            of years:</font></font>
            <input onBlur="mark(this,'#ffffff','#000000')" name="b_2former_yrs" size="4" maxlength="4" onFocus="nextfield ='copy2'; mark(this,'#ffffcc','#0000FF')">
        </td>
      </tr>
    </table>
      <br>
      <br>
    </center>
  </div>
<center>
    <table BORDER=1 CELLSPACING=0 CELLPADDING=0 WIDTH="620" bordercolor="#246664" BGCOLOR="#00CCCC" >
      <tr>
        <td>
          <center>
            <a NAME="tab6"></a><b><font face="Arial, Helvetica, sans-serif"><font color="#FFFFFF"><font size=+0>CO-BORROWER
            INFORMATION&nbsp;</font></font></font></b><a NAME="help25"></a><a NAME="help26"></a><a NAME="help27"></a><a NAME="help28"></a>
          </center>
</td>
</tr>
</table>
    <br>
    <table width="620" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td width="51">
          <div align="center"><b><font face="Arial, Helvetica, sans-serif" size="-1" color="#C20303">NOTE:</font></b></div>
        </td>
        <td colspan="3" bgcolor="#FFFFFF">&nbsp;<font face="Arial, Helvetica, sans-serif" size="-1" color="#008080"><b><font color="#C20303">If
          Co-Borrower information is the same as Borrower, check the box:
          <input onBlur="mark(this,'#FFFFFF','#000000')" type="checkbox" name="copy2"
onClick="javascript:duplicate2(this.form);" value="checkbox" onFocus="nextfield ='cb_first_name'; mark(this,'#ffffcc','#0000FF')">
          </font> </b></font></td>
      </tr>
      <tr>
        <td width="51">&nbsp;</td>
        <td colspan="3"><b><font face="Arial,Helvetica" size="-1">Enter Co-Borrower's
          Name Below </font></b><font face="Arial,Helvetica" size="-1">(include
          Jr. or Sr. if applicable)</font></td>
      </tr>
      <tr>
        <td width="51"><a href="#./Help/Help25" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help25','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help25.php','help25','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.cb_first_name.focus()"><img src="images/helpB.gif" name="help25" border=0 height=15 width=46></a></td>
        <td width="239" bgcolor="#C7F3EA">
          <div align="right"><font face="Arial,Helvetica"><font size=-1>First
            Name:</font><font size=-1>
            <input onBlur="mark(this,'#ffffff','#000000')" name="cb_first_name" size="15" maxlength="20" onFocus="nextfield ='cb_mi_name'; mark(this,'#ffffcc','#0000FF')">
            &nbsp;</font></font></div>
        </td>
        <td width="77" bgcolor="#C7F3EA">
          <div align="center"><font face="Arial,Helvetica" size="-1">Mi.:
            <input onBlur="mark(this,'#ffffff','#000000')" name="cb_mi_name" size="2" maxlength="4" onFocus="nextfield ='cb_last_name'; mark(this,'#ffffcc','#0000FF')">
            </font> </div>
        </td>
        <td width="225" bgcolor="#C7F3EA">
          <div align="center"><font face="Arial,Helvetica"><font size=-1>Last
            Name:</font><font face="Arial,Helvetica" size="-1">
            <input onBlur="mark(this,'#ffffff','#000000')" name="cb_last_name" size="15" maxlength="25" onFocus="nextfield ='cb_soc_sec'; mark(this,'#ffffcc','#0000FF')">
            </font></font> </div>
        </td>
      </tr>
      <tr>
        <td width="51">&nbsp;</td>
        <td width="239" bgcolor="#C7F3EA">
          <div align="right"><font face="Arial,Helvetica"><font face="Arial,Helvetica" size="-1">
            </font><font size=-1>Soc. Sec. No.:</font><font size=-1>
            <input onBlur="mark(this,'#ffffff','#000000')" name="cb_soc_sec" size="15" maxlength="20" onFocus="nextfield ='cb_phone'; mark(this,'#ffffcc','#0000FF')">
            &nbsp;</font></font></div>
        </td>
        <td bgcolor="#C7F3EA" colspan="2"><font face="Arial,Helvetica"><font size=-1>Home
          Phone:</font><font size=-1>
          <input onBlur="mark(this,'#ffffff','#000000')" name="cb_phone" size="15" maxlength="20" onFocus="nextfield ='cb_age'; mark(this,'#ffffcc','#0000FF')">
          </font></font> </td>
      </tr>
    </table>
    <br>
    <table width="620" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td width="50"><a href="#./Help/Help26" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help26','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help26.php','help26','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.cb_age.focus()"><img src="images/helpB.gif" name="help26" border=0 height=15 width=46></a></td>
        <td bgcolor="#C7F3EA" width="249">
          <div align="center"><font face="Arial,Helvetica" size="-1">DOB (mm/dd/yyyy):
            <input type="text" id="cb_age" name="cb_age" size='10' maxlength="10" onFocus="javascript:vDateType='1',nextfield='cb_school'; mark(this,'#ffffcc','#0000FF')" onKeyUp="DateFormat(this,this.value,event,false,'1')" onBlur="DateFormat(this,this.value,event,true,'1'); mark(this,'#ffffff','#000000');">&nbsp;<a href="javascript:NewCal('cb_age','mmddyyyy')" onFocus="blur();document.smartform.cb_school.focus()"><img src="cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></font></div>
        </td>
        <td bgcolor="#C7F3EA" width="313">
          <div align="center"><font face="Arial,Helvetica"><font face="Arial,Helvetica" size="-1">Yrs.
            in School:</font><font size=-1> &nbsp;
            <input onBlur="mark(this,'#ffffff','#000000')" name="cb_school" size="2" maxlength="2" onFocus="nextfield ='cb_married'; mark(this,'#ffffcc','#0000FF')">
            </font></font></div>
        </td>
      </tr>
      <tr>
        <td width="50">&nbsp;</td>
        <td colspan="2" bgcolor="#C7F3EA"><font face="Arial,Helvetica" size="-1">&nbsp;Marital Status:&nbsp;&nbsp;</font> <font face="Arial,Helvetica"><font size=-1>
          <input onBlur="mark(this,'#C7F3EA','#000000')" type="checkbox" value="X" name="cb_married" onClick="pickOneCBMAR(this)" onFocus="nextfield ='cb_separated'; mark(this,'#ffffcc','#0000FF')">
          </font></font><font face="Arial,Helvetica" size="-1">Married&nbsp;&nbsp;</font><font face="Arial,Helvetica"><font size=-1>
          </font><font face="Arial,Helvetica" size="-1">
          <input onBlur="mark(this,'#C7F3EA','#000000')" type="checkbox" value="X" name="cb_separated" onClick="pickOneCBMAR(this)" onFocus="nextfield ='cb_unmarried'; mark(this,'#ffffcc','#0000FF')">
          Separated&nbsp;&nbsp;</font></font> <font face="Arial,Helvetica" size="-1">
          <input onBlur="mark(this,'#C7F3EA','#000000')" type="checkbox" value="X" name="cb_unmarried" onClick="pickOneCBMAR(this)" onFocus="nextfield ='cb_depend'; mark(this,'#ffffcc','#0000FF')">
          Unmarried&nbsp;&nbsp;</font> <font face="Arial,Helvetica" size="-2">(includes single, divorced, widowed)</font> </td>
      </tr>
    </table>
    <br>
    <table width="620" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td width="51"><a href="#./Help/Help27" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help27','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help27.php','help27','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.cb_depend.focus()"><img src="images/helpB.gif" name="help27" border=0 height=15 width=46></a></td>
        <td width="246" bgcolor="#C7F3EA"><font face="Arial,Helvetica"><font size=-1>&nbsp;&nbsp;Dependents:</font></font>
          <font face="Arial,Helvetica"><font size=-1>(How many?)&nbsp;</font></font>
          <input onBlur="mark(this,'#ffffff','#000000')" name="cb_depend" size="2" maxlength="2" onFocus="nextfield ='b_dep_ages'; mark(this,'#ffffcc','#0000FF')">
        </td>
        <td width="315" bgcolor="#C7F3EA"><font face="Arial,Helvetica"><font size="-1">&nbsp;&nbsp;What
          are their ages?
          <input onBlur="mark(this,'#ffffff','#000000')" name="cb_dep_ages" size="15" maxlength="15" onFocus="nextfield ='cb_res_street'; mark(this,'#ffffcc','#0000FF')">
          </font></font></td>
      </tr>
    </table>
    <br>
    <table width="620" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td width="52"><a href="#./Help/Help28" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help28','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help28.php','help28','scrollbars=yes,resizable=yes,width=500,height=240')" onFocus="blur();document.smartform.cb_res_street.focus()"><img src="images/helpB.gif" name="help28" border=0 height=15 width=46></a></td>
        <td colspan="2"><b><font face="Arial,Helvetica" size="-1">Present Address:</font></b></td>
      </tr>
      <tr>
        <td width="52">&nbsp;</td>
        <td width="355" bgcolor="#C7F3EA">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="38%">
                <div align="right"><font face="Arial,Helvetica" size="-1">Street:&nbsp;                  </font></div>
              </td>
              <td width="62%"> <font face="Arial,Helvetica" size="-1">
                <input onBlur="mark(this,'#ffffff','#000000')" name="cb_res_street" size="30" maxlength="30" onFocus="nextfield ='cb_own_home'; mark(this,'#ffffcc','#0000FF')">
                </font> </td>
            </tr>
          </table>
        </td>
        <td width="205" bgcolor="#C7F3EA"><font face="Arial,Helvetica" size="-1">
          &nbsp;<font face="Arial,Helvetica" size="-1">Own:</font><b><font face="Arial,Helvetica" size="-1">
          <input onBlur="mark(this,'#C7F3EA','#000000')" type="checkbox" value="X" name="cb_own_home" onClick="offCheckboxCBOwn1();" onFocus="nextfield ='cb_rent_home'; mark(this,'#ffffcc','#0000FF')">
          </font></b><font face="Arial,Helvetica" size="-1">&nbsp;Rent:</font><b>
          <input onBlur="mark(this,'#C7F3EA','#000000')" type="checkbox" value="X" name="cb_rent_home" onClick="onCheckboxCBOwn1();" onFocus="nextfield ='cb_res_city'; mark(this,'#ffffcc','#0000FF')">
          </b></font></td>
      </tr>
      <tr>
        <td width="52">&nbsp;</td>
        <th width="355" bgcolor="#C7F3EA">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="38%">
                <div align="right"><font face="Arial,Helvetica" size="-1">City,
                  State, Zip:&nbsp;</font></div>
              </td>
              <td width="62%"> <font face="Arial,Helvetica" size="-1">
                <input onBlur="mark(this,'#ffffff','#000000')" name="cb_res_city" size="10" maxlength="20" onFocus="nextfield ='cb_res_state'; mark(this,'#ffffcc','#0000FF')">
                <input onBlur="mark(this,'#ffffff','#000000')" name="cb_res_state" size="3" maxlength="20" onFocus="nextfield ='cb_res_zip'; mark(this,'#ffffcc','#0000FF')">
                <input onBlur="mark(this,'#ffffff','#000000')" name="cb_res_zip" size="5" maxlength="10" onFocus="nextfield ='cb_yrs_at_res'; mark(this,'#ffffcc','#0000FF')">
                </font> </td>
            </tr>
          </table>
        </th>
        <td width="205" bgcolor="#C7F3EA"><font face="Arial,Helvetica" size="-1">&nbsp;Number of years:</font>
          <input onBlur="mark(this,'#ffffff','#000000')" name="cb_yrs_at_res" size="4" maxlength="4" onFocus="nextfield ='add_cbres_record1'; mark(this,'#ffffcc','#0000FF')">
        </td>
      </tr>
    </table>
	<table BORDER=0 WIDTH="620" align="center" >
  <tr>

        <td width="579" bgcolor="#C7F3EA"><b><font face="Arial,Helvetica"><font size=-1>
          If Mailing Address is different than Present Address above, click &quot;Yes&quot;:&nbsp;&nbsp;</font><font face="Arial, Helvetica, sans-serif" size="2"><b><font face="Arial,Helvetica"><font face="Arial, Helvetica, sans-serif" size="-1">Yes:
          <input onBlur="mark(this,'#C7F3EA','#000000')" type="checkbox" name="add_cbres_record1" onClick="hideCBRes1(); changeCBResDiv1('cbres_questions1','block'); offCheckboxCBres1(); if (this.checked) document.smartform.cb_former_street.focus();" onFocus="mark(this,'#ffffcc','#0000FF');">
          &nbsp;&nbsp; No:</font> <font face="Arial, Helvetica, sans-serif" size="-1">
          <input onBlur="mark(this,'#C7F3EA','#000000')" type="checkbox" name="add_cbres_record1no" onClick="hideCBRes1(); onCheckboxCBres1();" onFocus="nextfield='b_employer_name'; mark(this,'#ffffcc','#0000FF')">
          </font></font></b></font></font></b></td>
      </tr>
    </table>
	<br>
  </center>
	<div id="cbres_questions1" style="margin-left:0px;display:none">
<center>
      <table BORDER=0 WIDTH="620" >
      <tr>
          <td width="576"><b><font face="Arial,Helvetica"><font size=-1>If Mailing
            Address is different than Present Address above, enter Mailing Address
            below:<a name="help29"></a></font></font></b></td>
      </tr>
    </table>
  </center>
<center>
      <table BORDER=0 WIDTH="620">
        <tr>
          <td WIDTH="46"><a href="#./Help/Help29" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help29','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help29.php','help29','scrollbars=yes,resizable=yes,width=500,height=260')" onFocus="blur();document.smartform.cb_former_street.focus()"><img src="images/helpB.gif" name="help29" border=0 height=15 width=46></a></td>
          <td WIDTH="230"><b><font face="Arial,Helvetica"><font size="-1">Mailing
            Address:</font></font></b></td>
          <td WIDTH="330"><font face="Arial,Helvetica"></font></td>
        </tr>
        <tr>
          <td ALIGN=RIGHT width="46">&nbsp;</td>
          <td ALIGN=RIGHT bgcolor="#C7F3EA" colspan="2"><font face="Arial,Helvetica"></font>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="24%">
                  <div align="right"><font face="Arial,Helvetica"><font size=-1>Street:&nbsp;</font><font face="Arial,Helvetica"></font></font></div>
                </td>
                <td width="76%">
                  <input onBlur="mark(this,'#ffffff','#000000')" name="cb_former_street" size="30" maxlength="30" onFocus="nextfield ='cb_former_city'; mark(this,'#ffffcc','#0000FF')">
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td ALIGN=RIGHT width="46">&nbsp;</td>
          <td ALIGN=RIGHT bgcolor="#C7F3EA" colspan="2"><font face="Arial,Helvetica"></font>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="24%">
                  <div align="right"><font face="Arial,Helvetica"><font face="Arial,Helvetica"><font size=-1>City,
                    State, Zip:&nbsp;</font></font></font></div>
                </td>
                <td width="76%">
                  <input onBlur="mark(this,'#ffffff','#000000')" name="cb_former_city" size="10" maxlength="20" onFocus="nextfield ='cb_former_state'; mark(this,'#ffffcc','#0000FF')">
                  <input onBlur="mark(this,'#ffffff','#000000')" name="cb_former_state" size="3" maxlength="20" onFocus="nextfield ='cb_former_zip'; mark(this,'#ffffcc','#0000FF')">
                  <input onBlur="mark(this,'#ffffff','#000000')" name="cb_former_zip" size="5" maxlength="10" onFocus="nextfield ='add_cbres_record2'; mark(this,'#ffffcc','#0000FF')">
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
	 <table border=0 width="620" align="center" >
  <tr>
          <td width="579" bgcolor="#C7F3EA"><b><font face="Arial,Helvetica"><font size=-1>If
            residing at Present Address for less than two years, click &quot;Yes&quot;:&nbsp;&nbsp;</font><font face="Arial, Helvetica, sans-serif" size="2"><b><font face="Arial,Helvetica"><font face="Arial, Helvetica, sans-serif" size="-1">Yes:
            <input onBlur="mark(this,'#C7F3EA','#000000')" type="checkbox" name="add_cbres_record2" onClick="hideCBRes2(); changeCBResDiv2('cbres_questions2','block'); offCheckboxCBres2(); if (this.checked) document.smartform.cb_2former_street.focus();" onFocus="mark(this,'#ffffcc','#0000FF');">
      &nbsp;&nbsp; No:</font> <font face="Arial, Helvetica, sans-serif" size="-1">
      <input onBlur="mark(this,'#C7F3EA','#000000')" type="checkbox" name="add_cbres_record2no" onClick="hideCBRes2(); onCheckboxCBres2();" onFocus="nextfield='b_employer_name'; mark(this,'#ffffcc','#0000FF')">
	  </font></font></b></font></font></b></td>
  </tr>
</table>

    <br>
  </center>
</div>
<div id="cbres_questions2" style="margin-left:0px;display:visible">
<center>

    <table BORDER=0 WIDTH="620" >
      <tr>
          <td width="582"><b><font face="Arial,Helvetica"><font size=-1>If residing
            at Present Address for less than two years, complete the following:<a name="help29A"></a></font></font></b></td>
      </tr>
    </table>
  </center>

<center>
      <table BORDER=0 WIDTH="620" >
        <tr>
          <td WIDTH="51"><a href="#./Help/Help29A" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help29A','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help29A.php','help29A','scrollbars=yes,resizable=yes,width=500,height=250')" onFocus="blur();document.smartform.cb_2former_street.focus()"><img src="images/helpB.gif" name="help29A" border=0 height=15 width=46></a></td>
          <td WIDTH="132"><b><font face="Arial,Helvetica"><font size=-1>Former
            Address:</font></font></b></td>
          <td WIDTH="218"><font face="Arial,Helvetica"></font></td>
          <td width="201"></td>
        </tr>
        <tr>
          <td ALIGN=RIGHT width="51">&nbsp;</td>
          <td ALIGN=RIGHT bgcolor="#C7F3EA" colspan="2">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="38%">
                  <div align="right"><font face="Arial,Helvetica"><font size=-1>Street:&nbsp;</font><font face="Arial,Helvetica"></font></font></div>
                </td>
                <td width="62%">
                  <input onBlur="mark(this,'#ffffff','#000000')" name="cb_2former_street" size="30" maxlength="30" onFocus="nextfield ='cb_2former_own'; mark(this,'#ffffcc','#0000FF')">
                </td>
              </tr>
            </table>
            <font face="Arial,Helvetica"></font> </td>
          <td bgcolor="#C7F3EA" width="201"><font face="Arial,Helvetica"><font size=-1>&nbsp;Own:
<input onBlur="mark(this,'#C7F3EA','#000000')" type="checkbox" value="X" name="cb_2former_own" onClick="offCheckboxCBOwn3();" onFocus="nextfield ='cb_2former_rent'; mark(this,'#ffffcc','#0000FF')">
            &nbsp;Rent:</font></font>
<input onBlur="mark(this,'#C7F3EA','#000000')" type="checkbox" value="X" name="cb_2former_rent" onClick="onCheckboxCBOwn3();" onFocus="nextfield ='cb_2former_city'; mark(this,'#ffffcc','#0000FF')">
          </td>
        </tr>
        <tr>
          <td ALIGN=RIGHT width="51">&nbsp;</td>
          <td ALIGN=RIGHT bgcolor="#C7F3EA" colspan="2"><font face="Arial,Helvetica"></font>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="38%">
                  <div align="right"><font face="Arial,Helvetica"><font face="Arial,Helvetica"><font size=-1>City,
                    State, Zip:&nbsp;</font></font></font></div>
                </td>
                <td width="62%">
                  <input onBlur="mark(this,'#ffffff','#000000')" name="cb_2former_city" size="10" maxlength="20" onFocus="nextfield ='cb_2former_state'; mark(this,'#ffffcc','#0000FF')">
                  <input onBlur="mark(this,'#ffffff','#000000')" name="cb_2former_state" size="3" maxlength="20" onFocus="nextfield ='cb_2former_zip'; mark(this,'#ffffcc','#0000FF')">
                  <input onBlur="mark(this,'#ffffff','#000000')" name="cb_2former_zip" size="5" maxlength="10" onFocus="nextfield ='cb_2former_yrs'; mark(this,'#ffffcc','#0000FF')">
                </td>
              </tr>
            </table>

          </td>
          <td bgcolor="#C7F3EA" width="201"><font face="Arial,Helvetica"><font size=-1>&nbsp;Number of years:</font></font>
            <input onBlur="mark(this,'#ffffff','#000000')" name="cb_2former_yrs" size="4" maxlength="4" onFocus="nextfield ='b_employer_name'; mark(this,'#ffffcc','#0000FF')">
          </td>
        </tr>
      </table>
  </center>
    <br>
    <br>
  </div>
<center>
    <table BORDER=1 CELLSPACING=0 CELLPADDING=0 WIDTH="620" BGCOLOR="#0099FF" bordercolor="#003399" >
      <tr>
<td>
<center><a NAME="tab7"></a><b><font face="Arial, Helvetica, sans-serif"><font color="#FFFFFF"><font size=+0>EMPLOYMENT
INFORMATION&nbsp;</font></font></font></b><a NAME="help30"></a><a NAME="help31"></a><a NAME="help32"></a></center>
</td>
</tr>
</table>
    <br>
    <table border=0 width="620" align="center" >
  <tr>
        <td width="47">&nbsp;</td>
        <td width="112">&nbsp;</td>
        <td width="221"><b><font face="Arial,Helvetica" size="-1">&nbsp;&nbsp;Borrower</font></b></td>
        <td width="222"><b><font face="Arial,Helvetica" size="-1">&nbsp;&nbsp;Co-Borrower</font></b></td>
  </tr>
  <tr>
        <td width="47"><a href="#./Help/Help30" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help30','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help30.php','help30','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.b_employer_name.focus()"><img src="images/helpB.gif" name="help30" border=0 height=15 width=46></a></td>
        <td width="112" bgcolor="#BDDDF4">
          <div align=right><font face="Arial,Helvetica" size="-1">Employer Name:&nbsp;</font></div>
    </td>
        <td width="221" bgcolor="#E1EFFB"> <font face="Arial,Helvetica" size="-1">
          <input onBlur="mark(this,'#ffffff','#000000')" name="b_employer_name" size="20" maxlength="40" onFocus="nextfield ='cb_employer_name'; mark(this,'#ffffcc','#0000FF')">
      </font> </td>
        <td width="222" bgcolor="#BDDDF4"> <font face="Arial,Helvetica" size="-1">
          <input onBlur="mark(this,'#ffffff','#000000')" name="cb_employer_name" size="20" maxlength="40" onFocus="nextfield ='b_employer_street'; mark(this,'#ffffcc','#0000FF')">
      </font> </td>
  </tr>
  <tr>
        <td width="47">&nbsp;</td>
        <td width="112" bgcolor="#BDDDF4">
          <div align=right><font face="Arial,Helvetica" size="-1">Street Address:&nbsp;</font></div>
    </td>
        <td width="221" bgcolor="#E1EFFB"> <font face="Arial,Helvetica" size="-1">
          <input onBlur="mark(this,'#ffffff','#000000')" name="b_employer_street" size="20" maxlength="40" onFocus="nextfield ='cb_employer_street'; mark(this,'#ffffcc','#0000FF')">
      </font> </td>
        <td width="222" bgcolor="#BDDDF4"> <font face="Arial,Helvetica" size="-1">
          <input onBlur="mark(this,'#ffffff','#000000')" name="cb_employer_street" size="20" maxlength="40" onFocus="nextfield ='b_employer_city'; mark(this,'#ffffcc','#0000FF')">
      </font> </td>
  </tr>
  <tr>
        <td width="47">&nbsp;</td>
        <td width="112" bgcolor="#BDDDF4">
          <div align=right><font face="Arial,Helvetica" size="-1">City, State, Zip:&nbsp;</font></div>
    </td>
        <td width="221" bgcolor="#E1EFFB"> <font face="Arial,Helvetica" size="-1">
          <input onBlur="mark(this,'#ffffff','#000000')" name="b_employer_city" size="10" maxlength="20" onFocus="nextfield ='b_employer_state'; mark(this,'#ffffcc','#0000FF')">
      <input onBlur="mark(this,'#ffffff','#000000')" name="b_employer_state" size="3" maxlength="20" onFocus="nextfield ='b_employer_zip'; mark(this,'#ffffcc','#0000FF')">
      <input onBlur="mark(this,'#ffffff','#000000')" name="b_employer_zip" size="5" maxlength="10" onFocus="nextfield ='cb_employer_city'; mark(this,'#ffffcc','#0000FF')">
      </font> </td>
        <td width="222" bgcolor="#BDDDF4"> <font face="Arial,Helvetica" size="-1">
          <input onBlur="mark(this,'#ffffff','#000000')" name="cb_employer_city" size="10" maxlength="20" onFocus="nextfield ='cb_employer_state'; mark(this,'#ffffcc','#0000FF')">
      <input onBlur="mark(this,'#ffffff','#000000')" name="cb_employer_state" size="3" maxlength="20" onFocus="nextfield ='cb_employer_zip'; mark(this,'#ffffcc','#0000FF')">
      <input onBlur="mark(this,'#ffffff','#000000')" name="cb_employer_zip" size="5" maxlength="10" onFocus="nextfield ='b_employer_phone'; mark(this,'#ffffcc','#0000FF')">
      </font> </td>
  </tr>
  <tr>
        <td width="47">&nbsp;</td>
        <td width="112" bgcolor="#BDDDF4">
          <div align=right><font face="Arial,Helvetica" size="-1">Work Phone:&nbsp;</font></div>
    </td>
        <td width="221" bgcolor="#E1EFFB"> <font face="Arial,Helvetica" size="-1">
          <input onBlur="mark(this,'#ffffff','#000000')" name="b_employer_phone" size="20" maxlength="20" onFocus="nextfield ='cb_employer_phone'; mark(this,'#ffffcc','#0000FF')">
      </font> </td>
        <td width="222" bgcolor="#BDDDF4"> <font face="Arial,Helvetica" size="-1">
          <input onBlur="mark(this,'#ffffff','#000000')" name="cb_employer_phone" size="20" maxlength="20" onFocus="nextfield ='b_employer_position'; mark(this,'#ffffcc','#0000FF')">
      </font> </td>
  </tr>
  <tr>
        <td width="47"><a href="#./Help/Help31" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help31','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help31.php','help31','scrollbars=yes,resizable=yes,width=500,height=195')" onFocus="blur();document.smartform.b_employer_position.focus()"><img src="images/helpB.gif" name="help31" border=0 height=15 width=46></a></td>
        <td width="112" bgcolor="#BDDDF4">
          <div align=right><font face="Arial,Helvetica" size="-1">Position/title:&nbsp;</font></div>
    </td>
        <td width="221" bgcolor="#E1EFFB"> <font face="Arial,Helvetica" size="-1">
          <input onBlur="mark(this,'#ffffff','#000000')" name="b_employer_position" size="20" maxlength="20" onFocus="nextfield ='cb_employer_position'; mark(this,'#ffffcc','#0000FF')">
      </font> </td>
        <td width="222" bgcolor="#BDDDF4"> <font face="Arial,Helvetica" size="-1">
          <input onBlur="mark(this,'#ffffff','#000000')" name="cb_employer_position" size="20" maxlength="20" onFocus="nextfield ='b_employer_bus_type'; mark(this,'#ffffcc','#0000FF')">
      </font> </td>
  </tr>
  <tr>
        <td width="47">&nbsp;</td>
        <td width="112" bgcolor="#BDDDF4">
          <div align=right><font face="Arial,Helvetica" size="-1">Business Type:&nbsp;</font></div>
    </td>
        <td width="221" bgcolor="#E1EFFB"> <font face="Arial,Helvetica" size="-1">
          <input onBlur="mark(this,'#ffffff','#000000')" name="b_employer_bus_type" size="20" maxlength="20" onFocus="nextfield ='cb_employer_bus_type'; mark(this,'#ffffcc','#0000FF')">
      </font> </td>
        <td width="222" bgcolor="#BDDDF4"> <font face="Arial,Helvetica" size="-1">
          <input onBlur="mark(this,'#ffffff','#000000')" name="cb_employer_bus_type" size="20" maxlength="20" onFocus="nextfield ='b_self_employed'; mark(this,'#ffffcc','#0000FF')">
      </font> </td>
  </tr>
  <tr>
        <td width="47"><a href="#./Help/Help32" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help32','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help32.php','help32','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.b_self_employed.focus()"><img src="images/helpB.gif" name="help32" border=0 height=15 width=46></a></td>
        <td width="112" bgcolor="#BDDDF4">
          <div align=right><font face="Arial,Helvetica" size="-1">Self Employed?:&nbsp;</font></div>
    </td>
        <td width="221" bgcolor="#E1EFFB"><font face="Arial, Helvetica, sans-serif" size="-1">&nbsp;Yes:
          <input onBlur="mark(this,'#E1EFFB','#000000')" type="checkbox" value="X" name="b_self_employed" onClick="offCheckboxB1();" onFocus="nextfield ='b_not_self_employed'; mark(this,'#ffffcc','#0000FF')">
          No:</font><font face="Arial, Helvetica, sans-serif" size="-1">
          <input onBlur="mark(this,'#E1EFFB','#000000')" type="checkbox" value="X" name="b_not_self_employed" onClick="onCheckboxB1();" onFocus="nextfield ='cb_self_employed'; mark(this,'#ffffcc','#0000FF')">
      </font> </td>
        <td width="222" bgcolor="#BDDDF4"><font face="Arial,Helvetica" size="-1">&nbsp;Yes:
          <input onBlur="mark(this,'#BDDDF4','#000000')" type="checkbox" value="X" name="cb_self_employed" onClick="offCheckboxCB1();" onFocus="nextfield ='cb_not_self_employed'; mark(this,'#ffffcc','#0000FF')">
          </font>&nbsp;<font face="Arial,Helvetica" size="-1"> No:</font>
<input onBlur="mark(this,'#BDDDF4','#000000')" type="checkbox" value="X" name="cb_not_self_employed" onClick="onCheckboxCB1();" onFocus="nextfield ='b_yrs_on_job'; mark(this,'#ffffcc','#0000FF')">
    </td>
  </tr>
  <tr>
        <td width="47">&nbsp;</td>
        <td width="112" bgcolor="#BDDDF4">
          <div align="right"><font face="Arial,Helvetica" size="-1">Years on Job:&nbsp;</font></div>
    </td>
        <td width="221" bgcolor="#E1EFFB"><font face="Arial,Helvetica" size="-1">
          <input onBlur="mark(this,'#ffffff','#000000')" name="b_yrs_on_job" size="4" maxlength="4" onFocus="nextfield ='cb_yrs_on_job'; mark(this,'#ffffcc','#0000FF')">
      </font></td>
        <td width="222" bgcolor="#BDDDF4"><font face="Arial,Helvetica" size="-1">
          <input onBlur="mark(this,'#ffffff','#000000')" name="cb_yrs_on_job" size="4" maxlength="4" onFocus="nextfield ='b_yrs_in_prof'; mark(this,'#ffffcc','#0000FF')">
      </font></td>
  </tr>
  <tr>
        <td width="47">&nbsp;</td>
        <td width="112" bgcolor="#BDDDF4">
          <div align=right> <font face="Arial,Helvetica" size="-1">Yrs. in profession:&nbsp;</font></div>
    </td>
        <td width="221" bgcolor="#E1EFFB"><font face="Arial,Helvetica" size="-1">
          <input onBlur="mark(this,'#ffffff','#000000')" name="b_yrs_in_prof" size="4" maxlength="4" onFocus="nextfield ='cb_yrs_in_prof'; mark(this,'#ffffcc','#0000FF')">
      </font> </td>
        <td width="222" bgcolor="#BDDDF4"><font face="Arial,Helvetica" size="-1">
          <input onBlur="mark(this,'#ffffff','#000000')" name="cb_yrs_in_prof" size="4" maxlength="4" onFocus="nextfield ='add_employed_record1'; mark(this,'#ffffcc','#0000FF')">
      </font> </td>
  </tr>
</table>
<table width="620" border="0" cellpadding="0" align="center" cellspacing="0">
  <tr>
    <td>
      <table width="100%" border="0" cellspacing="2" cellpadding="5">
        <tr>
              <td width="39"><font size="2" face="Arial, Helvetica, sans-serif"><b><font color="#C20303" size="-1">NOTE:</font></b></font></td>
              <td width="329" bgcolor="#BDDDF4"><font face="Arial, Helvetica, sans-serif" size="2"><b>If
                you have been employed <font face="Arial,Helvetica"><font size=-1>in
                this position for less than two years or you are currently employed
                in more than one position, Click &quot;Yes&quot; at the right
                and continue.</font></font></b></font></td>
              <td width="214" bgcolor="#BDDDF4"><font face="Arial, Helvetica, sans-serif" size="2"><b><font face="Arial,Helvetica"><font face="Arial, Helvetica, sans-serif" size="-1">Yes:
                <input onBlur="mark(this,'#BDDDF4','#000000')" type="checkbox" name="add_employed_record1" onClick="hideAll1(); changeEmployDiv1('employment_questions1','block'); offCheckboxEmploy1(); if (this.checked) document.smartform.b_employer2_name.focus();" onFocus="mark(this,'#ffffcc','#0000FF')">
                &nbsp;&nbsp; No:</font> <font face="Arial, Helvetica, sans-serif" size="-1">
                </font><font face="Arial, Helvetica, sans-serif" size="2"><b><font face="Arial,Helvetica"><font face="Arial, Helvetica, sans-serif" size="-1">
                <input onBlur="mark(this,'#BDDDF4','#000000')" type="checkbox" name="add_employed_record1no" onClick="hideAll1(); onCheckboxEmploy1();" onFocus="nextfield='b_base_income'; mark(this,'#ffffcc','#0000FF')">
                </font></font></b></font></font></b></font></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<br>
  </center>
<div id="employment_questions1" style="margin-left:0px;display:none">
  <table BORDER=0 WIDTH="620" align="center" >
    <tr>
      <td><font size="2" face="Arial, Helvetica, sans-serif"><b>&nbsp;Please complete
        the section below:<a name="help35"></a><a name="help33"></a><a name="help34"></a></b></font></td>
    </tr>
  </table>

    <br>
    <table BORDER=0 WIDTH="620" align="center" >
    <tr>
        <td width="47">&nbsp;</td>
        <td width="106">&nbsp;</td>
        <td width="227"><b><font face="Arial,Helvetica"><font size=-1>&nbsp;&nbsp;Borrower</font></font></b></td>
        <td width="222"><b><font face="Arial,Helvetica"><font size=-1>&nbsp;&nbsp;Co-Borrower</font></font></b></td>
    </tr>
    <tr>
        <td width="47"><a href="#./Help/Help33" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help33','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help33.php','help33','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.b_employer2_name.focus()"><img src="images/helpB.gif" name="help33" border=0 height=15 width=46></a></td>
        <td width="106" bgcolor="#BDDDF4">
          <div align=right><font face="Arial,Helvetica"><font size=-1>Employer Name:&nbsp;</font></font></div>
      </td>
        <td width="227" bgcolor="#E1EFFB">
          <input onBlur="mark(this,'#ffffff','#000000')" NAME="b_employer2_name" SIZE="20" MAXLENGTH="40" onFocus="nextfield ='cb_employer2_name'; mark(this,'#ffffcc','#0000FF')">
      </td>
        <td width="222" bgcolor="#BDDDF4">
          <input onBlur="mark(this,'#ffffff','#000000')" NAME="cb_employer2_name" SIZE="20" MAXLENGTH="40" onFocus="nextfield ='b_employer2_street'; mark(this,'#ffffcc','#0000FF')">
      </td>
    </tr>
    <tr>
        <td width="47">&nbsp;</td>
        <td width="106" bgcolor="#BDDDF4">
          <div align=right><font face="Arial,Helvetica"><font size=-1>Street Address:&nbsp;</font></font></div>
      </td>
        <td width="227" bgcolor="#E1EFFB">
          <input onBlur="mark(this,'#ffffff','#000000')" NAME="b_employer2_street" SIZE="20" MAXLENGTH="20" onFocus="nextfield ='cb_employer2_street'; mark(this,'#ffffcc','#0000FF')">
      </td>
        <td width="222" bgcolor="#BDDDF4">
          <input onBlur="mark(this,'#ffffff','#000000')" NAME="cb_employer2_street" SIZE="20" MAXLENGTH="20" onFocus="nextfield ='b_employer2_city'; mark(this,'#ffffcc','#0000FF')">
      </td>
    </tr>
    <tr>
        <td width="47">&nbsp;</td>
        <td width="106" bgcolor="#BDDDF4">
          <div align=right><font face="Arial,Helvetica"><font size=-1>City, State,
          Zip:&nbsp;</font></font></div>
      </td>
        <td width="227" bgcolor="#E1EFFB">
          <input onBlur="mark(this,'#ffffff','#000000')" NAME="b_employer2_city" SIZE="10" MAXLENGTH="20" onFocus="nextfield ='b_employer2_state'; mark(this,'#ffffcc','#0000FF')">
        <input onBlur="mark(this,'#ffffff','#000000')" NAME="b_employer2_state" SIZE="3" MAXLENGTH="20" onFocus="nextfield ='b_employer2_zip'; mark(this,'#ffffcc','#0000FF')">
        <input onBlur="mark(this,'#ffffff','#000000')" NAME="b_employer2_zip" SIZE="5" MAXLENGTH="10" onFocus="nextfield ='cb_employer2_city'; mark(this,'#ffffcc','#0000FF')">
      </td>
        <td width="222" bgcolor="#BDDDF4">
          <input onBlur="mark(this,'#ffffff','#000000')" NAME="cb_employer2_city" SIZE="10" MAXLENGTH="20" onFocus="nextfield ='cb_employer2_state'; mark(this,'#ffffcc','#0000FF')">
        <input onBlur="mark(this,'#ffffff','#000000')" NAME="cb_employer2_state" SIZE="3" MAXLENGTH="20" onFocus="nextfield ='cb_employer2_zip'; mark(this,'#ffffcc','#0000FF')">
        <input onBlur="mark(this,'#ffffff','#000000')" NAME="cb_employer2_zip" SIZE="5" MAXLENGTH="10" onFocus="nextfield ='b_employer2_phone'; mark(this,'#ffffcc','#0000FF')">
      </td>
    </tr>
    <tr>
        <td width="47">&nbsp;</td>
        <td width="106" bgcolor="#BDDDF4">
          <div align=right><font face="Arial,Helvetica"><font size=-1>Work Phone:&nbsp;</font></font></div>
      </td>
        <td width="227" bgcolor="#E1EFFB">
          <input onBlur="mark(this,'#ffffff','#000000')" NAME="b_employer2_phone" SIZE="20" MAXLENGTH="20" onFocus="nextfield ='cb_employer2_phone'; mark(this,'#ffffcc','#0000FF')">
      </td>
        <td width="222" bgcolor="#BDDDF4">
          <input onBlur="mark(this,'#ffffff','#000000')" NAME="cb_employer2_phone" SIZE="20" MAXLENGTH="20" onFocus="nextfield ='b_employer2_position'; mark(this,'#ffffcc','#0000FF')">
      </td>
    </tr>
    <tr>
        <td width="47"><a href="#./Help/Help34" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help34','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help34.php','help34','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.b_employer2_position.focus()"><img src="images/helpB.gif" name="help34" border=0 height=15 width=46></a></td>
        <td width="106" bgcolor="#BDDDF4">
          <div align=right><font face="Arial,Helvetica"><font size=-1>Position/title:&nbsp;</font></font></div>
      </td>
        <td width="227" bgcolor="#E1EFFB">
          <input onBlur="mark(this,'#ffffff','#000000')" NAME="b_employer2_position" SIZE="20" MAXLENGTH="20" onFocus="nextfield ='cb_employer2_position'; mark(this,'#ffffcc','#0000FF')">
      </td>
        <td width="222" bgcolor="#BDDDF4">
          <input onBlur="mark(this,'#ffffff','#000000')" NAME="cb_employer2_position" SIZE="20" MAXLENGTH="20" onFocus="nextfield ='b_employer2_bus_type'; mark(this,'#ffffcc','#0000FF')">
      </td>
    </tr>
    <tr>
        <td width="47">&nbsp;</td>
        <td width="106" bgcolor="#BDDDF4">
          <div align=right><font face="Arial,Helvetica"><font size=-1>Business Type:&nbsp;</font></font></div>
      </td>
        <td width="227" bgcolor="#E1EFFB">
          <input onBlur="mark(this,'#ffffff','#000000')" NAME="b_employer2_bus_type" SIZE="20" MAXLENGTH="20" onFocus="nextfield ='cb_employer2_bus_type'; mark(this,'#ffffcc','#0000FF')">
      </td>
        <td width="222" bgcolor="#BDDDF4">
          <input onBlur="mark(this,'#ffffff','#000000')" NAME="cb_employer2_bus_type" SIZE="20" MAXLENGTH="20" onFocus="nextfield ='b_self_employer2'; mark(this,'#ffffcc','#0000FF')">
      </td>
    </tr>
    <tr>
        <td width="47"><a href="#./Help/Help35" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help35','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help35.php','help35','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.b_self_employer2.focus()"><img src="images/helpB.gif" name="help35" border=0 height=15 width=46></a></td>
        <td width="106" bgcolor="#BDDDF4">
          <div align=right><font face="Arial,Helvetica"><font size=-1>Self Employed?:&nbsp;</font></font></div>
      </td>
        <td width="227" bgcolor="#E1EFFB"><font face="Arial,Helvetica"><font size=-1>&nbsp;Yes:
          <input onBlur="mark(this,'#E1EFFB','#000000')" type="checkbox" value="X" name="b_self_employer2" onClick="offCheckboxB2();" onFocus="nextfield ='b_other_not_self_employed'; mark(this,'#ffffcc','#0000FF')">
          No:</font></font>
          <input onBlur="mark(this,'#E1EFFB','#000000')" type="checkbox" value="No" NAME="b_other_not_self_employed" onClick="onCheckboxB2();" onFocus="nextfield ='cb_self_employer2'; mark(this,'#ffffcc','#0000FF')">
      </td>
        <td width="222" bgcolor="#BDDDF4"><font face="Arial,Helvetica"><font size=-1>&nbsp;Yes:
          <input onBlur="mark(this,'#BDDDF4','#000000')" type="checkbox" value="X" NAME="cb_self_employer2"  onClick="offCheckboxCB2();" onFocus="nextfield ='cb_other_not_self_employed'; mark(this,'#ffffcc','#0000FF')">
          No:</font></font>
<input onBlur="mark(this,'#BDDDF4','#000000')" type="checkbox" value="No" NAME="cb_other_not_self_employed"  onClick="onCheckboxCB2();" onFocus="nextfield ='b_dates_from'; mark(this,'#ffffcc','#0000FF')">
      </td>
    </tr>
    <tr>
        <td width="47">&nbsp;</td>
        <td width="106" bgcolor="#BDDDF4">
          <div align=right><font face="Arial,Helvetica"><font size=-1>Dates, from:&nbsp;</font></font></div>
      </td>
        <td width="227" bgcolor="#E1EFFB">
          <input NAME="b_dates_from" id="b_dates_from" SIZE="10" MAXLENGTH="10" onFocus="javascript:vDateType='1',nextfield='b_dates_to'; mark(this,'#ffffcc','#0000FF')" onKeyUp="DateFormat(this,this.value,event,false,'1')" onBlur="DateFormat(this,this.value,event,true,'1'); mark(this,'#ffffff','#000000')"><a href="javascript:NewCal('b_dates_from','mmddyyyy')" onFocus="blur();document.smartform.b_dates_to.focus()"><img src="cal.gif" width="16" height="16" border="0" alt="Pick a date"></a>
          <font face="Arial,Helvetica"><font size=-1>to:</font></font>
<input NAME="b_dates_to" id="b_dates_to" SIZE="10" MAXLENGTH="10" onFocus="javascript:vDateType='1',nextfield='cb_dates_from'; mark(this,'#ffffcc','#0000FF')" onKeyUp="DateFormat(this,this.value,event,false,'1')" onBlur="DateFormat(this,this.value,event,true,'1'); mark(this,'#ffffff','#000000')"><a href="javascript:NewCal('b_dates_to','mmddyyyy')" onFocus="blur();document.smartform.cb_dates_from.focus()"><img src="cal.gif" width="16" height="16" border="0" alt="Pick a date"></a>
      </td>
        <td width="222" bgcolor="#BDDDF4">
          <input NAME="cb_dates_from" id="cb_dates_from" SIZE="10" MAXLENGTH="10" onFocus="javascript:vDateType='1',nextfield='cb_dates_to'; mark(this,'#ffffcc','#0000FF')" onKeyUp="DateFormat(this,this.value,event,false,'1')" onBlur="DateFormat(this,this.value,event,true,'1'); mark(this,'#ffffff','#000000')"><a href="javascript:NewCal('cb_dates_from','mmddyyyy')" onFocus="blur();document.smartform.cb_dates_to.focus()"><img src="cal.gif" width="16" height="16" border="0" alt="Pick a date"></a>
          <font face="Arial,Helvetica"><font size=-1>to:</font></font>
<input NAME="cb_dates_to" id="cb_dates_to" SIZE="10" MAXLENGTH="10" onFocus="javascript:vDateType='1',nextfield='b_employer2_income'; mark(this,'#ffffcc','#0000FF')" onKeyUp="DateFormat(this,this.value,event,false,'1')" onBlur="DateFormat(this,this.value,event,true,'1'); mark(this,'#ffffff','#000000')"><a href="javascript:NewCal('cb_dates_to','mmddyyyy')" onFocus="blur();document.smartform.b_employer2_income.focus()"><img src="cal.gif" width="16" height="16" border="0" alt="Pick a date"></a>
      </td>
    </tr>
    <tr>
        <td width="47">&nbsp;</td>
        <td width="106" bgcolor="#BDDDF4">
          <div align=right><font face="Arial,Helvetica"><font size=-1>Monthly Income:&nbsp;</font></font></div>
      </td>
        <td width="227" bgcolor="#E1EFFB"><font face="Arial,Helvetica"><font size=-1>&nbsp;$</font></font>
          <input onBlur="mark(this,'#ffffff','#000000')" NAME="b_employer2_income" SIZE="10" MAXLENGTH="10" onFocus="nextfield ='cb_employer2_income'; mark(this,'#ffffcc','#0000FF')">
      </td>
        <td width="222" bgcolor="#BDDDF4"><font face="Arial,Helvetica"><font size=-1>&nbsp;$</font></font>
          <input onBlur="mark(this,'#ffffff','#000000')" NAME="cb_employer2_income" SIZE="10" MAXLENGTH="10" onFocus="nextfield ='add_employed_record2'; mark(this,'#ffffcc','#0000FF')">
      </td>
    </tr>
  </table>
  <table width="620" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td>
        <table width="100%" border="0" cellspacing="2" cellpadding="5">
          <tr>
              <td width="39"><font size="2" face="Arial, Helvetica, sans-serif"><b><font color="#C20303" size="-1">NOTE:</font></b></font></td>
              <td width="329" bgcolor="#BDDDF4"> <font face="Arial, Helvetica, sans-serif" size="-1"><b>If
                you have been employed in this position for less than two years
                or you are currently employed in more than one position, Click
                &quot;Yes&quot; at the right and continue.</b></font></td>
              <td width="214" bgcolor="#BDDDF4"><font face="Arial, Helvetica, sans-serif" size="-1">Yes:
                <input onBlur="mark(this,'#BDDDF4','#000000')" type="checkbox" name="add_employed_record2" onClick="hideAll2(); changeEmployDiv2('employment_questions2','block'); offCheckboxEmploy2(); if (this.checked) document.smartform.b_employer3_name.focus();" onFocus="mark(this,'#ffffcc','#0000FF')">
              &nbsp;&nbsp; No:</font> <font face="Arial, Helvetica, sans-serif" size="-1">
              <input onBlur="mark(this,'#BDDDF4','#000000')" type="checkbox" name="add_employed_record2no" onClick="hideAll2(); onCheckboxEmploy2();" onFocus="nextfield='b_base_income'; mark(this,'#ffffcc','#0000FF')">
			  </font></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <br>
  </div>
    <div id="employment_questions2" style="margin-left:0px;display:none">
  <table BORDER=0 WIDTH="620" align="center" >
    <tr>
        <td>&nbsp;<font size="2" face="Arial, Helvetica, sans-serif"><b>Please
          complete the section below:<a name="help33A"></a><a name="help34A"></a><a name="help35A"></a></b></font></td>
    </tr>
  </table>
  <br>

  <center>
  </center>

<table BORDER=0 WIDTH="620" align="center" >
    <tr>

      <td width="48">&nbsp;</td>

        <td width="104">&nbsp;</td>

        <td width="226"><b><font face="Arial,Helvetica"><font size=-1>&nbsp;&nbsp;Borrower</font></font></b></td>

        <td width="224"><b><font face="Arial,Helvetica"><font size=-1>&nbsp;&nbsp;Co-Borrower</font></font></b></td>
      </tr>
      <tr>

      <td width="48"><a href="#./Help/Help33A" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help33A','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help33A.php','help33A','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.b_employer3_name.focus()"><img src="images/helpB.gif" name="help33A" border=0 height=15 width=46></a></td>

        <td width="104" bgcolor="#BDDDF4">
          <div align=right><font face="Arial,Helvetica"><font size=-1>Employer Name:&nbsp;</font></font></div>
        </td>

        <td width="226" bgcolor="#E1EFFB">
          <input onBlur="mark(this,'#ffffff','#000000')" name="b_employer3_name" size="20" maxlength="40" onFocus="nextfield ='cb_employer3_name'; mark(this,'#ffffcc','#0000FF')">
      </td>

        <td width="224" bgcolor="#BDDDF4">
          <input onBlur="mark(this,'#ffffff','#000000')" name="cb_employer3_name" size="20" maxlength="40" onFocus="nextfield ='b_employer3_street'; mark(this,'#ffffcc','#0000FF')">
      </td>
      </tr>
      <tr>

      <td width="48">&nbsp;</td>

        <td width="104" bgcolor="#BDDDF4">
          <div align=right><font face="Arial,Helvetica"><font size=-1>Street Address:&nbsp;</font></font></div>
        </td>

        <td width="226" bgcolor="#E1EFFB">
          <input onBlur="mark(this,'#ffffff','#000000')" name="b_employer3_street" size="20" maxlength="20" onFocus="nextfield ='cb_employer3_street'; mark(this,'#ffffcc','#0000FF')">
        </td>

        <td width="224" bgcolor="#BDDDF4">
          <input onBlur="mark(this,'#ffffff','#000000')" name="cb_employer3_street" size="20" maxlength="20" onFocus="nextfield ='b_employer3_city'; mark(this,'#ffffcc','#0000FF')">
        </td>
      </tr>
      <tr>

      <td width="48">&nbsp;</td>

        <td width="104" bgcolor="#BDDDF4">
          <div align=right><font face="Arial,Helvetica"><font size=-1>City, State,
            Zip:&nbsp;</font></font></div>
        </td>

        <td width="226" bgcolor="#E1EFFB">
          <input onBlur="mark(this,'#ffffff','#000000')" name="b_employer3_city" size="10" maxlength="20" onFocus="nextfield ='b_employer3_state'; mark(this,'#ffffcc','#0000FF')">
          <input onBlur="mark(this,'#ffffff','#000000')" name="b_employer3_state" size="3" maxlength="20" onFocus="nextfield ='b_employer3_zip'; mark(this,'#ffffcc','#0000FF')">
          <input onBlur="mark(this,'#ffffff','#000000')" name="b_employer3_zip" size="5" maxlength="10" onFocus="nextfield ='cb_employer3_city'; mark(this,'#ffffcc','#0000FF')">
        </td>

        <td width="224" bgcolor="#BDDDF4">
          <input onBlur="mark(this,'#ffffff','#000000')" name="cb_employer3_city" size="10" maxlength="20" onFocus="nextfield ='cb_employer3_state'; mark(this,'#ffffcc','#0000FF')">
          <input onBlur="mark(this,'#ffffff','#000000')" name="cb_employer3_state" size="3" maxlength="20" onFocus="nextfield ='cb_employer3_zip'; mark(this,'#ffffcc','#0000FF')">
          <input onBlur="mark(this,'#ffffff','#000000')" name="cb_employer3_zip" size="5" maxlength="10" onFocus="nextfield ='b_employer3_phone'; mark(this,'#ffffcc','#0000FF')">
        </td>
      </tr>
      <tr>

      <td width="48">&nbsp;</td>

        <td width="104" bgcolor="#BDDDF4">
          <div align=right><font face="Arial,Helvetica"><font size=-1>Work Phone:&nbsp;</font></font></div>
        </td>

        <td width="226" bgcolor="#E1EFFB">
          <input onBlur="mark(this,'#ffffff','#000000')" name="b_employer3_phone" size="20" maxlength="20" onFocus="nextfield ='cb_employer3_phone'; mark(this,'#ffffcc','#0000FF')">
        </td>

        <td width="224" bgcolor="#BDDDF4">
          <input onBlur="mark(this,'#ffffff','#000000')" name="cb_employer3_phone" size="20" maxlength="20" onFocus="nextfield ='b_employer3_position'; mark(this,'#ffffcc','#0000FF')">
        </td>
      </tr>
      <tr>

      <td width="48"><a href="#./Help/Help34A" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help34A','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help34A.php','help34A','scrollbars=yes,resizable=yes,width=500,height=260')" onFocus="blur();document.smartform.b_employer3_position.focus()"><img src="images/helpB.gif" name="help34A" border=0 height=15 width=46></a></td>

        <td width="104" bgcolor="#BDDDF4">
          <div align=right><font face="Arial,Helvetica"><font size=-1>Position/title:&nbsp;</font></font></div>
        </td>

        <td width="226" bgcolor="#E1EFFB">
          <input onBlur="mark(this,'#ffffff','#000000')" name="b_employer3_position" size="20" maxlength="20" onFocus="nextfield ='cb_employer3_position'; mark(this,'#ffffcc','#0000FF')">
        </td>

        <td width="224" bgcolor="#BDDDF4">
          <input onBlur="mark(this,'#ffffff','#000000')" name="cb_employer3_position" size="20" maxlength="20" onFocus="nextfield ='b_employer3_bus_type'; mark(this,'#ffffcc','#0000FF')">
        </td>
      </tr>
      <tr>

      <td width="48">&nbsp;</td>

        <td width="104" bgcolor="#BDDDF4">
          <div align=right><font face="Arial,Helvetica"><font size=-1>Business
            Type:&nbsp;</font></font></div>
        </td>

        <td width="226" bgcolor="#E1EFFB">
          <input onBlur="mark(this,'#ffffff','#000000')" name="b_employer3_bus_type" size="20" maxlength="20" onFocus="nextfield ='cb_employer3_bus_type'; mark(this,'#ffffcc','#0000FF')">
        </td>

        <td width="224" bgcolor="#BDDDF4">
          <input onBlur="mark(this,'#ffffff','#000000')" name="cb_employer3_bus_type" size="20" maxlength="20" onFocus="nextfield ='b_self_employer3'; mark(this,'#ffffcc','#0000FF')">
        </td>
      </tr>
      <tr>

      <td width="48"><a href="#./Help/Help35A" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help35A','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help35A.php','help35A','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.b_self_employer3.focus()"><img src="images/helpB.gif" name="help35A" border=0 height=15 width=46></a></td>

        <td width="104" bgcolor="#BDDDF4">
          <div align=right><font face="Arial,Helvetica"><font size=-1>Self Employed?:&nbsp;</font></font></div>
        </td>

        <td width="226" bgcolor="#E1EFFB"><font face="Arial,Helvetica"><font size=-1>&nbsp;Yes:
          <input onBlur="mark(this,'#E1EFFB','#000000')" type="checkbox" value="X" name="b_self_employer3" onClick="offCheckboxB3();" onFocus="nextfield ='b_other_not_self_employed3'; mark(this,'#ffffcc','#0000FF')">
          No:</font></font>
          <input onBlur="mark(this,'#E1EFFB','#000000')" type="checkbox" value="No" name="b_other_not_self_employed3" onClick="onCheckboxB3();" onFocus="nextfield ='cb_self_employer3'; mark(this,'#ffffcc','#0000FF')">
        </td>

        <td width="224" bgcolor="#BDDDF4"><font face="Arial,Helvetica"><font size=-1>&nbsp;Yes:
          <input onBlur="mark(this,'#BDDDF4','#000000')" type="checkbox" value="X" name="cb_self_employer3" onClick="offCheckboxCB3();" onFocus="nextfield ='cb_other_not_self_employed3'; mark(this,'#ffffcc','#0000FF')">
          No:</font></font>
          <input onBlur="mark(this,'#BDDDF4','#000000')" type="checkbox" value="No" name="cb_other_not_self_employed3" onClick="onCheckboxCB3();" onFocus="nextfield ='b_dates3_from'; mark(this,'#ffffcc','#0000FF')">
        </td>
      </tr>
      <tr>

      <td width="48">&nbsp;</td>

        <td width="104" bgcolor="#BDDDF4">
          <div align=right><font face="Arial,Helvetica"><font size=-1>Dates, from:&nbsp;</font></font></div>
        </td>

        <td width="226" bgcolor="#E1EFFB">
          <input name="b_dates3_from" id="b_dates3_from" size="10" maxlength="10" onFocus="javascript:vDateType='1',nextfield='b_dates3_to'; mark(this,'#ffffcc','#0000FF')" onKeyUp="DateFormat(this,this.value,event,false,'1')" onBlur="DateFormat(this,this.value,event,true,'1'); mark(this,'#ffffff','#000000')"><a href="javascript:NewCal('b_dates3_from','mmddyyyy')" onFocus="blur();document.smartform.b_dates3_to.focus()"><img src="cal.gif" width="16" height="16" border="0" alt="Pick a date"></a>
          <font face="Arial,Helvetica"><font size=-1>to:</font></font>
<input name="b_dates3_to" id="b_dates3_to" size="10" maxlength="10" onFocus="javascript:vDateType='1',nextfield='cb_dates3_from'; mark(this,'#ffffcc','#0000FF')" onKeyUp="DateFormat(this,this.value,event,false,'1')" onBlur="DateFormat(this,this.value,event,true,'1'); mark(this,'#ffffff','#000000')"><a href="javascript:NewCal('b_dates3_to','mmddyyyy')" onFocus="blur();document.smartform.cb_dates3_from.focus()"><img src="cal.gif" width="16" height="16" border="0" alt="Pick a date"></a>
        </td>

        <td width="224" bgcolor="#BDDDF4">
          <input name="cb_dates3_from" id="cb_dates3_from" size="10" maxlength="10" onFocus="javascript:vDateType='1',nextfield='cb_dates3_to'; mark(this,'#ffffcc','#0000FF')" onKeyUp="DateFormat(this,this.value,event,false,'1')" onBlur="DateFormat(this,this.value,event,true,'1'); mark(this,'#ffffff','#000000')"><a href="javascript:NewCal('cb_dates3_from','mmddyyyy')" onFocus="blur();document.smartform.cb_dates3_to.focus()"><img src="cal.gif" width="16" height="16" border="0" alt="Pick a date"></a>
          <font face="Arial,Helvetica"><font size=-1>to:</font></font>
<input name="cb_dates3_to" id="cb_dates3_to" size="10" maxlength="10" onFocus="javascript:vDateType='1',nextfield='b_employer3_income'; mark(this,'#ffffcc','#0000FF')" onKeyUp="DateFormat(this,this.value,event,false,'1')" onBlur="DateFormat(this,this.value,event,true,'1'); mark(this,'#ffffff','#000000')"><a href="javascript:NewCal('cb_dates3_to','mmddyyyy')" onFocus="blur();document.smartform.b_employer3_income.focus()"><img src="cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
      </tr>
      <tr>

      <td width="48">&nbsp;</td>

        <td width="104" bgcolor="#BDDDF4">
          <div align=right><font face="Arial,Helvetica"><font size=-1>Monthly
            Income:&nbsp;</font></font></div>
        </td>

        <td width="226" bgcolor="#E1EFFB"><font face="Arial,Helvetica"><font size=-1>&nbsp;$</font></font>
          <input onBlur="mark(this,'#ffffff','#000000')" name="b_employer3_income" size="10" maxlength="10" onFocus="nextfield ='cb_employer3_income'; mark(this,'#ffffcc','#0000FF')">
        </td>

        <td width="224" bgcolor="#BDDDF4"><font face="Arial,Helvetica"><font size=-1>&nbsp;$</font></font>
          <input onBlur="mark(this,'#ffffff','#000000')" name="cb_employer3_income" size="10" maxlength="10" onFocus="nextfield ='b_base_income'; mark(this,'#ffffcc','#0000FF')">

        </td>
      </tr>
    </table>
    <br>
    <br>
  </div>
<center>
    <table BORDER=1 CELLSPACING=0 CELLPADDING=0 WIDTH="620" BGCOLOR="#FF8487" bordercolor="#C20303" >
      <tr>
<td>
<center>
            <a name="help36"></a><a NAME="tab8"></a><b><font face="Arial, Helvetica, sans-serif"><font color="#FFFFFF"><font size=+0>GROSS
            MONTHLY INCOME</font></font></font></b>
</center>
</td>
</tr>
</table>
    <br>
  </center>

<center>
    <table BORDER=0 WIDTH="620" >
      <tr>
        <td></td>
      </tr>
      <tr>
        <td><font face="Arial,Helvetica" size="-1">Below, enter your income in
          the Borrower and Co-Borrower fields <b>only</b> without the "<b>$</b>".&nbsp;
          The form will automatically total your entries in the <b><font color="#C20303">RED</font></b>
          'Total' fields for you.&nbsp;</font><font face="Arial,Helvetica"></font></td>
      </tr>
    </table>
    <br>
  </center>

<center>
    <table BORDER=0 WIDTH="620" >
      <tr>
        <td width="55"></td>
        <td width="213"></td>
        <td width="115"></td>
        <td width="110"></td>
        <td width="105"></td>
      </tr>
      <tr>
        <td width="55"><a href="#./Help/Help36" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help36','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help36.php','help36','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.b_base_income.focus()"><img src="images/helpB.gif" name="help36" border=0 height=15 width=46></a></td>
        <td width="213">
          <div align="center"><b><font face="Arial,Helvetica"><font color="#000000"><font size=-1>Gross
            Monthly Income</font></font></font></b></div>
        </td>
        <td width="115">
          <div align="center"><b><font face="Arial,Helvetica"><font color="#000000"><font size=-1>Borrower</font></font></font></b></div>
        </td>
        <td width="110">
          <div align="center"><b><font face="Arial,Helvetica"><font color="#000000"><font size=-1>Co-Borrower</font></font></font></b></div>
        </td>
        <td width="105">
          <div align="center"><b><font face="Arial,Helvetica"><font size=-1>Total</font></font></b></div>
        </td>
      </tr>
      <tr>
        <td width="55"></td>
        <td width="213"></td>
        <td width="115"></td>
        <td width="110"></td>
        <td width="105"></td>
      </tr>
      <tr>
        <td width="55">&nbsp;</td>
        <td width="213" bgcolor="#FFD2D6"><font face="Arial,Helvetica"><font color="#000000"><font size=-1>&nbsp;&nbsp;Base
          Employment Income:&nbsp;</font></font></font></td>
        <td ALIGN=CENTER width="115" bgcolor="#FFECF1"> <font face="Arial,Helvetica"><font size=-1>$</font></font>
          <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="b_base_income" value="" SIZE="10" onChange="calcincome(this.form,'b_base_income');" onFocus="nextfield ='cb_base_income'; mark(this,'#ffffcc','#0000FF')">
        </td>
        <td ALIGN=CENTER width="110" bgcolor="#FFD2D6"> <font face="Arial,Helvetica"><font size=-1>$</font></font>
          <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="cb_base_income" value="" SIZE="10" onChange="calcincome(this.form,'cb_base_income');" onFocus="nextfield ='b_overtime_income'; mark(this,'#ffffcc','#0000FF')">
        </td>
        <td ALIGN=CENTER BGCOLOR="#C20303" width="105"> <font face="Arial,Helvetica"><font size="-1" color="#FFFFFF"><b>$</b></font></font>
          <input type="text" NAME="total_base_income" value="" SIZE="10" onFocus="blur();document.smartform.b_overtime_income.focus()" onchange="this.form.b_base_income.value + this.form.cb_base_income.value; calcincome(this.form,'field');">
        </td>
      </tr>
      <tr>
        <td width="55">&nbsp;</td>
        <td width="213" bgcolor="#FFD2D6"><font face="Arial,Helvetica"><font size=-1>&nbsp;&nbsp;Overtime:&nbsp;</font></font></td>
        <td ALIGN=CENTER width="115" bgcolor="#FFECF1"> <font face="Arial,Helvetica"><font size=-1>$</font></font>
          <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="b_overtime_income" value="" SIZE="10" onChange="calcincome(this.form,'b_overtime_income');" onFocus="nextfield ='cb_overtime_income'; mark(this,'#ffffcc','#0000FF')">
        </td>
        <td ALIGN=CENTER width="110" bgcolor="#FFD2D6"> <font face="Arial,Helvetica"><font size=-1>$</font></font>
          <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="cb_overtime_income" value="" SIZE="10" onChange="calcincome(this.form,'cb_overtime_income');" onFocus="nextfield ='b_bonus_income'; mark(this,'#ffffcc','#0000FF')">
        </td>
        <td ALIGN=CENTER BGCOLOR="#C20303" width="105"> <font face="Arial,Helvetica"><font size="-1" color="#FFFFFF"><b>$</b></font></font>
          <input type="text" NAME="total_overtime_income" value="" SIZE="10" onFocus="blur();document.smartform.b_bonus_income.focus()" onchange="this.form.B_overtime_income.value + this.form.cb_overtime_income.value; calcincome(this.form,'field');">
        </td>
      </tr>
      <tr>
        <td width="55">&nbsp;</td>
        <td width="213" bgcolor="#FFD2D6"><font face="Arial,Helvetica"><font size=-1>&nbsp;&nbsp;Bonuses:&nbsp;</font></font></td>
        <td ALIGN=CENTER width="115" bgcolor="#FFECF1"> <font face="Arial,Helvetica"><font size=-1>$</font></font>
          <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="b_bonus_income" value="" SIZE="10" onChange="calcincome(this.form,'b_bonus_income');" onFocus="nextfield ='cb_bonus_income'; mark(this,'#ffffcc','#0000FF')">
        </td>
        <td ALIGN=CENTER width="110" bgcolor="#FFD2D6"> <font face="Arial,Helvetica"><font size=-1>$</font></font>
          <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="cb_bonus_income" value="" SIZE="10" onChange="calcincome(this.form,'cb_bonus_income');" onFocus="nextfield ='b_commission_income'; mark(this,'#ffffcc','#0000FF')">
        </td>
        <td ALIGN=CENTER BGCOLOR="#C20303" width="105"> <font face="Arial,Helvetica"><font size="-1" color="#FFFFFF"><b>$</b></font></font>
          <input type="text" NAME="total_bonus_income" value="" SIZE="10" onFocus="blur();document.smartform.b_commission_income.focus()" onchange="this.form.B_bonus_income.value + this.form.cb_bonus_income.value; calcincome(this.form,'field');">
        </td>
      </tr>
      <tr>
        <td width="55">&nbsp;</td>
        <td width="213" bgcolor="#FFD2D6"><font face="Arial,Helvetica"><font size=-1>&nbsp;&nbsp;Commissions:&nbsp;</font></font></td>
        <td ALIGN=CENTER width="115" bgcolor="#FFECF1"> <font face="Arial,Helvetica"><font size=-1>$</font></font>
          <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="b_commission_income" value="" SIZE="10" onChange="calcincome(this.form,'b_commission_income');" onFocus="nextfield ='cb_commission_income'; mark(this,'#ffffcc','#0000FF')">
        </td>
        <td ALIGN=CENTER width="110" bgcolor="#FFD2D6"> <font face="Arial,Helvetica"><font size=-1>$</font></font>
          <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="cb_commission_income" value="" SIZE="10" onChange="calcincome(this.form,'cb_commission_income');" onFocus="nextfield ='b_dividend_income'; mark(this,'#ffffcc','#0000FF')">
        </td>
        <td ALIGN=CENTER BGCOLOR="#C20303" width="105"> <font face="Arial,Helvetica"><font size="-1" color="#FFFFFF"><b>$</b></font></font>
          <input type="text" NAME="total_commission_income" value="" SIZE="10" onFocus="blur();document.smartform.b_dividend_income.focus()" onchange="this.form.B_commission_income.value + this.form.cb_commission_income.value; calcincome(this.form,'field');">
        </td>
      </tr>
      <tr>
        <td width="55">&nbsp;</td>
        <td width="213" bgcolor="#FFD2D6"><font face="Arial,Helvetica"><font size=-1>&nbsp;&nbsp;Dividends/Interest:</font></font></td>
        <td ALIGN=CENTER width="115" bgcolor="#FFECF1"> <font face="Arial,Helvetica"><font size=-1>$</font></font>
          <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="b_dividend_income" value="" SIZE="10" onChange="calcincome(this.form,'b_dividend_income');" onFocus="nextfield ='cb_dividend_income'; mark(this,'#ffffcc','#0000FF')">
        </td>
        <td ALIGN=CENTER width="110" bgcolor="#FFD2D6"> <font face="Arial,Helvetica"><font size=-1>$</font></font>
          <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="cb_dividend_income" value="" SIZE="10" onChange="calcincome(this.form,'cb_dividend_income');" onFocus="nextfield ='b_rental_income'; mark(this,'#ffffcc','#0000FF')">
        </td>
        <td ALIGN=CENTER BGCOLOR="#C20303" width="105"> <font face="Arial,Helvetica"><font size="-1" color="#FFFFFF"><b>$</b></font></font>
          <input type="text" NAME="total_dividend_income" value="" SIZE="10" onFocus="blur();document.smartform.b_rental_income.focus()" onchange="this.form.B_dividend_income.value + this.form.cb_dividend_income.value; calcincome(this.form,'field');">
        </td>
      </tr>
      <tr>
        <td width="55">&nbsp;</td>
        <td width="213" bgcolor="#FFD2D6"><font face="Arial,Helvetica"><font size=-1>&nbsp;&nbsp;Net
          Rental Income:&nbsp;</font></font></td>
        <td ALIGN=CENTER width="115" bgcolor="#FFECF1"> <font face="Arial,Helvetica"><font size=-1>$</font></font>
          <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="b_rental_income" value="" SIZE="10" onChange="calcincome(this.form,'b_rental_income');" onFocus="nextfield ='cb_rental_income'; mark(this,'#ffffcc','#0000FF')">
        </td>
        <td ALIGN=CENTER width="110" bgcolor="#FFD2D6"> <font face="Arial,Helvetica"><font size=-1>$</font></font>
          <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="cb_rental_income" value="" SIZE="10" onChange="calcincome(this.form,'cb_rental_income');" onFocus="nextfield ='b_other_income'; mark(this,'#ffffcc','#0000FF')">
        </td>
        <td ALIGN=CENTER BGCOLOR="#C20303" width="105"> <font face="Arial,Helvetica"><font size="-1" color="#FFFFFF"><b>$</b></font></font>
          <input type="text" NAME="total_rental_income" value="" SIZE="10" onFocus="blur();document.smartform.b_other_income.focus()" onchange="this.form.B_rental_income.value + this.form.cb_rental_income.value; calcincome(this.form,'field');">
        </td>
      </tr>
      <tr>
        <td width="55">&nbsp;</td>
        <td width="213" bgcolor="#FFD2D6"><font face="Arial,Helvetica"><font size=-1><b><font color="#C20303">&nbsp;<font size="3">&nbsp;<font color="#C20303" size="4">*</font></font></font></b>Other
          Income:&nbsp;</font></font></td>
        <td ALIGN=CENTER width="115" bgcolor="#FFECF1"> <font face="Arial,Helvetica"><font size=-1>$</font></font>
          <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="b_other_income" value="" SIZE="10" onChange="calcincome(this.form,'b_other_income');" onFocus="nextfield ='cb_other_income'; mark(this,'#ffffcc','#0000FF')">
        </td>
        <td ALIGN=CENTER width="110" bgcolor="#FFD2D6"> <font face="Arial,Helvetica"><font size=-1>$</font></font>
          <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="cb_other_income" value="" SIZE="10" onChange="calcincome(this.form,'cb_other_income');" onFocus="nextfield ='b_explain_one'; mark(this,'#ffffcc','#0000FF')">
        </td>
        <td ALIGN=CENTER BGCOLOR="#C20303" width="105"> <font face="Arial,Helvetica"><font size="-1" color="#FFFFFF"><b>$</b></font></font>
          <input type="text" NAME="total_other_income" value="" SIZE="10" onFocus="blur();document.smartform.b_explain_one.focus()" onchange="this.form.B_other_income.value + this.form.cb_other_income.value; calcincome(this.form,'field');">
        </td>
      </tr>
      <tr>
        <td width="55">&nbsp;</td>
        <td width="213" bgcolor="#FFD2D6"><b><font face="Arial,Helvetica"><font size=-1>&nbsp;&nbsp;Total:</font></font></b></td>
        <td ALIGN=CENTER BGCOLOR="#C20303" width="115"> <font face="Arial,Helvetica"><font size="-1" color="#FFFFFF"><b>$</b></font></font>
          <input type="text" NAME="b_total_income" SIZE="10" onFocus="blur();document.smartform.b_explain_one.focus()" onChange="this.form.field.value + this.form.B_base_income.value + this.form.b_overtime_income.value + this.form.b_bonus_income.value + this.form.b_commission_income.value + this.form.b_dividend_income.value + this.form.b_rental_income.value + this.form.b_other_income.value; calcincome(this.form,'field');">
        </td>
        <td ALIGN=CENTER BGCOLOR="#C20303" width="110"> <font face="Arial,Helvetica"><font size="-1" color="#FFFFFF"><b>$</b></font></font>
          <input type="text" NAME="cb_total_income" SIZE="10" onFocus="blur();document.smartform.b_explain_one.focus()" onChange="this.form.field.value + this.form.cB_base_income.value + this.form.cb_overtime_income.value + this.form.cb_bonus_income.value + this.form.cb_commission_income.value + this.form.cb_dividend_income.value + this.form.cb_rental_income.value + this.form.cb_other_income.value; calcincome(this.form,'field');">
        </td>
        <td ALIGN=CENTER BGCOLOR="#C20303" width="105"> <font face="Arial,Helvetica"><font size="-1" color="#FFFFFF"><b>$</b></font></font>
          <input type="text" NAME="total_household_income" SIZE="10" onFocus="blur();document.smartform.b_explain_one.focus()" onChange="this.form.field.value + this.form.b_total_income.value + this.form.cb_total_income.value; calcincome(this.form,'field');">
        </td>
      </tr>
    </table>
  </center>

<p><a NAME="help37"></a>
<center>
    <table BORDER=0 WIDTH="620" >
      <tr>
        <td><font face="Arial,Helvetica"><b><font color="#C20303"><font size="4" color="#C20303">*</font></font></b><font size=-1>The
          section below is for explaining your entry in "Other Income" in the
          above section (if any).&nbsp; This may include Retirement, Social Security,
          Child support, Alimony or Separate Maintenance income. <b>If you did
          not enter anything in the "Other Income" field above, skip the section
          below and move on to "Combined Monthly Housing Expense".</b></font></font>
          <p><font face="Arial,Helvetica"><font size=-1><b><font color="#C20303">NOTICE:</font></b>
            The Borrower and Co-Borrower do not need to reveal this information
            if they don't want it to be considered for repaying this loan.</font></font>
        </td>
      </tr>
    </table>
    <br>
  </center>

<center>
    <table BORDER=0 WIDTH="620" >
      <tr>
        <td width="51"><a href="#./Help/Help37" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help37','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help37.php','help37','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.b_explain_one.focus()"><img src="images/helpB.gif" name="help37" border=0 height=15 width=46></a></td>
        <td width="160">
          <div align="center"><b><font face="Arial,Helvetica"><font size=-1>Borrower
            (B), or</font></font></b> <br>
            <b><font face="Arial,Helvetica"><font size=-1>Co-Borrower (C)</font></font></b></div>
        </td>
        <td width="255">
          <div align="center"><b><font face="Arial,Helvetica"><font size=-1>Describe
            Other Income</font></font></b> </div>
        </td>
        <td width="132">
          <div align="center"><b><font face="Arial,Helvetica"><font size=-1>Monthly
            Income</font></font></b></div>
        </td>
      </tr>
      <tr>
        <td width="51">&nbsp;</td>
        <td width="160" bgcolor="#FFD2D6">
          <div align="center"><font face="Arial,Helvetica"><font size=-1>B:&nbsp;
            <input onBlur="mark(this,'#FFD2D6','#000000')" type="checkbox" value="B" NAME="b_explain_one" onClick="offCheckboxOINB1();" onFocus="nextfield ='cb_explain_one'; mark(this,'#ffffcc','#0000FF')">
            &nbsp; C:&nbsp;</font></font>
            <input onBlur="mark(this,'#FFD2D6','#000000')" type="checkbox" value="C" NAME="cb_explain_one" onClick="onCheckboxOINB1();" onFocus="nextfield ='explanation_one'; mark(this,'#ffffcc','#0000FF')">
          </div>
        </td>
        <td width="255" bgcolor="#FFD2D6">
          <div align="center">
		  <select name="explanation_one" onFocus="nextfield ='explanation_one_income';">
                        <option value="">Please Select</option>
                        <option value="Military Base Pay">Military Base Pay</option>
                        <option value="Military Rations Allowance">Military Rations Allowance</option>
                        <option value="Military Flight Pay">Military Flight Pay</option>
                        <option value="Military Hazard Pay">Military Hazard Pay</option>
                        <option value="Military Clothes Allowance">Military Clothes Allowance</option>
						<option value="Military Quarters Allowance">Military Quarters Allowance</option>
                        <option value="Military Prop Pay">Military Prop Pay</option>
						<option value="Military Overseas Pay">Military Overseas Pay</option>
						<option value="Military Combat Pay">Military Combat Pay</option>
						<option value="Military Variable Housing Allowance">Military Variable Housing Allowance</option>
						<option value="Alimony/Child Support Income">Alimony/Child Support Income</option>
						<option value="Notes Receivable/Installment">Notes Receivable/Installment</option>
						<option value="Pension/Retirement Income">Pension/Retirement Income</option>
						<option value="Social Security/Disability Income">Social Security/Disability Income</option>
						<option value="Real Estate/Mortgage Differential">Real Estate/Mortgage Differential</option>
						<option value="Trust Income">Trust Income</option>
						<option value="Unemployment/Welfare Income">Unemployment/Welfare Income</option>
						<option value="Automobile/Expense Account Income">Automobile/Expense Account Income</option>
						<option value="Foster Care">Foster Care</option>
						<option value="VA Benefits (non-education)">VA Benefits (non-education)</option>
						<option value="Other Income">Other Income</option>
						<option value="Base Employment Income">Base Employment Income</option>
						<option value="Overtime">Overtime</option>
						<option value="Bonuses">Bonuses</option>
						<option value="Commissions">Commissions</option>
						<option value="Dividends/Interest">Dividends/Interest</option>
						<option value="Subject Property Net Cash Flow">Subject Property Net Cash Flow</option>
						<option value="Net Rental Income">Net Rental Income</option>
                      </select>
          </div>
        </td>
        <td width="132" bgcolor="#FFD2D6">
          <div align="center"><font face="Arial,Helvetica"><font size=-1>$</font></font>
            <input onBlur="mark(this,'#ffffff','#000000')" NAME="explanation_one_income" SIZE="12" onFocus="nextfield ='b_explain_two'; mark(this,'#ffffcc','#0000FF')">
          </div>
        </td>
      </tr>
      <tr>
        <td width="51">&nbsp;</td>
        <td width="160" bgcolor="#FFD2D6">
          <div align="center"><font face="Arial,Helvetica"><font size=-1>B:&nbsp;
            <input onBlur="mark(this,'#FFD2D6','#000000')" type="checkbox" value="B" NAME="b_explain_two" onClick="offCheckboxOINB2();" onFocus="nextfield ='cb_explain_two'; mark(this,'#ffffcc','#0000FF')">
            &nbsp; C:&nbsp;</font></font>
            <input onBlur="mark(this,'#FFD2D6','#000000')" type="checkbox" value="C" NAME="cb_explain_two" onClick="onCheckboxOINB2();" onFocus="nextfield ='explanation_two'; mark(this,'#ffffcc','#0000FF')">
          </div>
        </td>
        <td width="255" bgcolor="#FFD2D6">
          <div align="center">
            <select name="explanation_two" onFocus="nextfield ='explanation_two_income';">
                        <option value="">Please Select</option>
                        <option value="Military Base Pay">Military Base Pay</option>
                        <option value="Military Rations Allowance">Military Rations Allowance</option>
                        <option value="Military Flight Pay">Military Flight Pay</option>
                        <option value="Military Hazard Pay">Military Hazard Pay</option>
                        <option value="Military Clothes Allowance">Military Clothes Allowance</option>
						<option value="Military Quarters Allowance">Military Quarters Allowance</option>
                        <option value="Military Prop Pay">Military Prop Pay</option>
						<option value="Military Overseas Pay">Military Overseas Pay</option>
						<option value="Military Combat Pay">Military Combat Pay</option>
						<option value="Military Variable Housing Allowance">Military Variable Housing Allowance</option>
						<option value="Alimony/Child Support Income">Alimony/Child Support Income</option>
						<option value="Notes Receivable/Installment">Notes Receivable/Installment</option>
						<option value="Pension/Retirement Income">Pension/Retirement Income</option>
						<option value="Social Security/Disability Income">Social Security/Disability Income</option>
						<option value="Real Estate/Mortgage Differential">Real Estate/Mortgage Differential</option>
						<option value="Trust Income">Trust Income</option>
						<option value="Unemployment/Welfare Income">Unemployment/Welfare Income</option>
						<option value="Automobile/Expense Account Income">Automobile/Expense Account Income</option>
						<option value="Foster Care">Foster Care</option>
						<option value="VA Benefits (non-education)">VA Benefits (non-education)</option>
						<option value="Other Income">Other Income</option>
						<option value="Base Employment Income">Base Employment Income</option>
						<option value="Overtime">Overtime</option>
						<option value="Bonuses">Bonuses</option>
						<option value="Commissions">Commissions</option>
						<option value="Dividends/Interest">Dividends/Interest</option>
						<option value="Subject Property Net Cash Flow">Subject Property Net Cash Flow</option>
						<option value="Net Rental Income">Net Rental Income</option>
                      </select>
          </div>
        </td>
        <td width="132" bgcolor="#FFD2D6">
          <div align="center"><font face="Arial,Helvetica"><font size=-1>$</font></font>
            <input onBlur="mark(this,'#ffffff','#000000')" NAME="explanation_two_income" SIZE="12" onFocus="nextfield ='b_explain_three'; mark(this,'#ffffcc','#0000FF')">
          </div>
        </td>
      </tr>
      <tr>
        <td width="51">&nbsp;</td>
        <td width="160" bgcolor="#FFD2D6">
          <div align="center"><font face="Arial,Helvetica"><font size=-1>B:&nbsp;
            <input onBlur="mark(this,'#FFD2D6','#000000')" type="checkbox" value="B" NAME="b_explain_three" onClick="offCheckboxOINB3();" onFocus="nextfield ='cb_explain_three'; mark(this,'#ffffcc','#0000FF')">
            &nbsp; C:&nbsp;</font></font>
            <input onBlur="mark(this,'#FFD2D6','#000000')" type="checkbox" value="C" NAME="cb_explain_three" onClick="onCheckboxOINB3();" onFocus="nextfield ='explanation_three'; mark(this,'#ffffcc','#0000FF')">
          </div>
        </td>
        <td width="255" bgcolor="#FFD2D6">
          <div align="center">
            <select name="explanation_three" onFocus="nextfield ='explanation_three_income';">
                        <option value="">Please Select</option>
                        <option value="Military Base Pay">Military Base Pay</option>
                        <option value="Military Rations Allowance">Military Rations Allowance</option>
                        <option value="Military Flight Pay">Military Flight Pay</option>
                        <option value="Military Hazard Pay">Military Hazard Pay</option>
                        <option value="Military Clothes Allowance">Military Clothes Allowance</option>
						<option value="Military Quarters Allowance">Military Quarters Allowance</option>
                        <option value="Military Prop Pay">Military Prop Pay</option>
						<option value="Military Overseas Pay">Military Overseas Pay</option>
						<option value="Military Combat Pay">Military Combat Pay</option>
						<option value="Military Variable Housing Allowance">Military Variable Housing Allowance</option>
						<option value="Alimony/Child Support Income">Alimony/Child Support Income</option>
						<option value="Notes Receivable/Installment">Notes Receivable/Installment</option>
						<option value="Pension/Retirement Income">Pension/Retirement Income</option>
						<option value="Social Security/Disability Income">Social Security/Disability Income</option>
						<option value="Real Estate/Mortgage Differential">Real Estate/Mortgage Differential</option>
						<option value="Trust Income">Trust Income</option>
						<option value="Unemployment/Welfare Income">Unemployment/Welfare Income</option>
						<option value="Automobile/Expense Account Income">Automobile/Expense Account Income</option>
						<option value="Foster Care">Foster Care</option>
						<option value="VA Benefits (non-education)">VA Benefits (non-education)</option>
						<option value="Other Income">Other Income</option>
						<option value="Base Employment Income">Base Employment Income</option>
						<option value="Overtime">Overtime</option>
						<option value="Bonuses">Bonuses</option>
						<option value="Commissions">Commissions</option>
						<option value="Dividends/Interest">Dividends/Interest</option>
						<option value="Subject Property Net Cash Flow">Subject Property Net Cash Flow</option>
						<option value="Net Rental Income">Net Rental Income</option>
                      </select>
          </div>
        </td>
        <td width="132" bgcolor="#FFD2D6">
          <div align="center"><font face="Arial,Helvetica"><font size=-1>$</font></font>
            <input onBlur="mark(this,'#ffffff','#000000')" NAME="explanation_three_income" SIZE="12" onFocus="nextfield ='b_explain_four'; mark(this,'#ffffcc','#0000FF')">
          </div>
        </td>
      </tr>
      <tr>
        <td width="51">&nbsp;</td>
        <td width="160" bgcolor="#FFD2D6">
          <div align="center"><font face="Arial,Helvetica"><font size=-1>B:&nbsp;
            <input onBlur="mark(this,'#FFD2D6','#000000')" type="checkbox" value="B" NAME="b_explain_four" onClick="offCheckboxOINB4();" onFocus="nextfield ='cb_explain_four'; mark(this,'#ffffcc','#0000FF')">
            &nbsp; C:&nbsp;</font></font>
            <input onBlur="mark(this,'#FFD2D6','#000000')" type="checkbox" value="C" NAME="cb_explain_four" onClick="onCheckboxOINB4();" onFocus="nextfield ='explanation_four'; mark(this,'#ffffcc','#0000FF')">
          </div>
        </td>
        <td width="255" bgcolor="#FFD2D6">
          <div align="center">
            <select name="explanation_four" onFocus="nextfield ='explanation_four_income';">
                        <option value="">Please Select</option>
                        <option value="Military Base Pay">Military Base Pay</option>
                        <option value="Military Rations Allowance">Military Rations Allowance</option>
                        <option value="Military Flight Pay">Military Flight Pay</option>
                        <option value="Military Hazard Pay">Military Hazard Pay</option>
                        <option value="Military Clothes Allowance">Military Clothes Allowance</option>
						<option value="Military Quarters Allowance">Military Quarters Allowance</option>
                        <option value="Military Prop Pay">Military Prop Pay</option>
						<option value="Military Overseas Pay">Military Overseas Pay</option>
						<option value="Military Combat Pay">Military Combat Pay</option>
						<option value="Military Variable Housing Allowance">Military Variable Housing Allowance</option>
						<option value="Alimony/Child Support Income">Alimony/Child Support Income</option>
						<option value="Notes Receivable/Installment">Notes Receivable/Installment</option>
						<option value="Pension/Retirement Income">Pension/Retirement Income</option>
						<option value="Social Security/Disability Income">Social Security/Disability Income</option>
						<option value="Real Estate/Mortgage Differential">Real Estate/Mortgage Differential</option>
						<option value="Trust Income">Trust Income</option>
						<option value="Unemployment/Welfare Income">Unemployment/Welfare Income</option>
						<option value="Automobile/Expense Account Income">Automobile/Expense Account Income</option>
						<option value="Foster Care">Foster Care</option>
						<option value="VA Benefits (non-education)">VA Benefits (non-education)</option>
						<option value="Other Income">Other Income</option>
						<option value="Base Employment Income">Base Employment Income</option>
						<option value="Overtime">Overtime</option>
						<option value="Bonuses">Bonuses</option>
						<option value="Commissions">Commissions</option>
						<option value="Dividends/Interest">Dividends/Interest</option>
						<option value="Subject Property Net Cash Flow">Subject Property Net Cash Flow</option>
						<option value="Net Rental Income">Net Rental Income</option>
                      </select>
          </div>
        </td>
        <td width="132" bgcolor="#FFD2D6">
          <div align="center"><font face="Arial,Helvetica"><font size=-1>$</font></font>
            <input onBlur="mark(this,'#ffffff','#000000')" NAME="explanation_four_income" SIZE="12" onFocus="nextfield ='housing_expense_rent'; mark(this,'#ffffcc','#0000FF')">
          </div>
        </td>
      </tr>
    </table>
    <br>
    <br>
  </center>

<center>
    <table BORDER=1 CELLSPACING=0 CELLPADDING=0 WIDTH="620" BGCOLOR="#62EEB3" bordercolor="#12A77E" >
      <tr>
<td>
<center><a NAME="tab9"></a><b><font face="Arial, Helvetica, sans-serif"><font color="#FFFFFF"><font size=+0>COMBINED
MONTHLY HOUSING EXPENSE</font></font></font></b><a NAME="help38"></a></center>
</td>
</tr>
</table></center>

<center>
    <table BORDER=0 WIDTH="620" >
      <tr>
        <td width="53"></td>
        <td width="323"></td>
        <td width="118"></td>
        <td width="108"></td>
      </tr>
      <tr>
        <td width="53"><a href="#./Help/Help38" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help38','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help38.php','help38','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.housing_expense_rent.focus()"><img src="images/helpB.gif" name="help38" border=0 height=15 width=46></a></td>
        <td width="323">
          <div align="center"><b><font face="Arial,Helvetica"><font size=-1>Combined
            Monthly Housing Expense</font></font></b></div>
        </td>
        <td width="118">
          <center>
            <b><font face="Arial,Helvetica"><font size=-1>Present</font></font></b>
          </center>
        </td>
        <td width="108">
          <center>
            <b><font face="Arial,Helvetica"><font size=-1>Proposed</font></font></b>
          </center>
        </td>
      </tr>
      <tr>
        <td width="53"></td>
        <td width="323"></td>
        <td width="118"></td>
        <td width="108"></td>
      </tr>
      <tr>
        <td width="53">&nbsp;</td>
        <td width="323" bgcolor="#D9FBEC"><font face="Arial,Helvetica"><font size=-1>&nbsp;&nbsp;Rent:&nbsp;</font></font></td>
        <td ALIGN=CENTER width="118" bgcolor="#ECFDF7"><font face="Arial, Helvetica, sans-serif" size="2">
          $
          <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="housing_expense_rent" value="" SIZE="10" onChange="calchousing(this.form,'housing_expense_rent');" onFocus="nextfield ='current_pi'; mark(this,'#ffffcc','#0000FF')">
          </font></td>
        <td width="108"></td>
      </tr>
      <tr>
        <td width="53">&nbsp;</td>
        <td width="323" bgcolor="#D9FBEC"><font face="Arial,Helvetica"><font size=-1>&nbsp;&nbsp;First Mortgage (P&amp;I):&nbsp;</font></font></td>
        <td ALIGN=CENTER width="118" bgcolor="#ECFDF7"><font face="Arial, Helvetica, sans-serif" size="2">
          $
          <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="current_pi" value="" SIZE="10" onChange="calchousing(this.form,'current_pi');" onFocus="nextfield ='current_other_financing'; mark(this,'#ffffcc','#0000FF')">
          </font></td>
        <td ALIGN=CENTER BGCOLOR="#C20303" width="108"> <font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><b>$</b></font>
          <font size="2" face="Arial, Helvetica, sans-serif">
          <input type="text" NAME="proposed_pi" value="" SIZE="10" onFocus="blur();document.smartform.current_other_financing.focus()" onChange="calchousing(this.form,'proposed_pi');">
          </font></td>
      </tr>
      <tr>
        <td width="53">&nbsp;</td>
        <td width="323" bgcolor="#D9FBEC"><font face="Arial,Helvetica"><font size=-1>&nbsp;&nbsp;Other Financing (P&amp;I):&nbsp;</font></font></td>
        <td ALIGN=CENTER width="118" bgcolor="#ECFDF7"><font face="Arial, Helvetica, sans-serif" size="2">
          $
          <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="current_other_financing" value="" SIZE="10" onChange="calchousing(this.form,'current_other_financing');" onFocus="nextfield ='proposed_other_financing'; mark(this,'#ffffcc','#0000FF')">
          </font></td>
        <td ALIGN=CENTER width="108" bgcolor="#D9FBEC"><font size="2" face="Arial, Helvetica, sans-serif">
          $
          <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="proposed_other_financing" value="" SIZE="10" onChange="calcloan(this.form,'proposed_other_financing');" onFocus="nextfield ='current_hazard_insurance'; mark(this,'#ffffcc','#0000FF')">
          </font></td>
      </tr>
      <tr>
        <td width="53">&nbsp;</td>
        <td width="323" bgcolor="#D9FBEC"><font face="Arial,Helvetica"><font size=-1>&nbsp;&nbsp;Hazard Insurance:&nbsp;</font></font></td>
        <td ALIGN=CENTER width="118" bgcolor="#ECFDF7"><font face="Arial, Helvetica, sans-serif" size="2">
          $
          <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="current_hazard_insurance" value="" SIZE="10" onChange="calchousing(this.form,'current_hazard_insurance');" onFocus="nextfield ='current_re_taxes'; mark(this,'#ffffcc','#0000FF')">
          </font></td>
        <td ALIGN=CENTER BGCOLOR="#C20303" width="108"><font size="2" face="Arial, Helvetica, sans-serif">
          </font><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><b>$</b></font><font size="2" face="Arial, Helvetica, sans-serif">
          <input type="text" NAME="proposed_hazard_insurance" value="" SIZE="10" onFocus="blur();document.smartform.current_re_taxes.focus()" onChange="calchousing(this.form,'proposed_hazard_insurance');">
          </font></td>
      </tr>
      <tr>
        <td width="53">&nbsp;</td>
        <td width="323" bgcolor="#D9FBEC"><font face="Arial,Helvetica"><font size=-1>&nbsp;&nbsp;Real Estate Taxes:&nbsp;</font></font></td>
        <td ALIGN=CENTER width="118" bgcolor="#ECFDF7"><font face="Arial, Helvetica, sans-serif" size="2">
          $
          <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="current_re_taxes" value="" SIZE="10" onChange="calchousing(this.form,'current_re_taxes');" onFocus="nextfield ='current_mi'; mark(this,'#ffffcc','#0000FF')">
          </font></td>
        <td ALIGN=CENTER BGCOLOR="#C20303" width="108"><font size="2" face="Arial, Helvetica, sans-serif">
          </font><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><b>$</b></font><font size="2" face="Arial, Helvetica, sans-serif">
          <input type="text" NAME="proposed_re_taxes" value="" SIZE="10" onFocus="blur();document.smartform.current_mi.focus()" onChange="calchousing(this.form,'proposed_re_taxes');">
          </font></td>
      </tr>
      <tr>
        <td width="53">&nbsp;</td>
        <td width="323" bgcolor="#D9FBEC"><font face="Arial,Helvetica"><font size=-1>&nbsp;&nbsp;Mortgage Insurance:&nbsp;</font></font></td>
        <td ALIGN=CENTER width="118" bgcolor="#ECFDF7"><font face="Arial, Helvetica, sans-serif" size="2">
          $
          <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="current_mi" value="" SIZE="10" onChange="calchousing(this.form,'current_mi');" onFocus="nextfield ='proposed_mi'; mark(this,'#ffffcc','#0000FF')">
          </font></td>
        <td ALIGN=CENTER width="108" bgcolor="#D9FBEC"><font size="2" face="Arial, Helvetica, sans-serif">
          $
          <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="proposed_mi" value="" SIZE="10" onChange="calcloan(this.form,'proposed_mi');" onFocus="nextfield ='current_hoa_dues'; mark(this,'#ffffcc','#0000FF')">
          </font></td>
      </tr>
      <tr>
        <td width="53">&nbsp;</td>
        <td width="323" bgcolor="#D9FBEC"><font face="Arial,Helvetica"><font size=-1>&nbsp;&nbsp;Homeowner Association Dues:</font></font></td>
        <td ALIGN=CENTER width="118" bgcolor="#ECFDF7"><font face="Arial, Helvetica, sans-serif" size="2">
          $
          <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="current_hoa_dues" value="" SIZE="10" onChange="calchousing(this.form,'current_hoa_dues');" onFocus="nextfield ='proposed_hoa_dues'; mark(this,'#ffffcc','#0000FF')">
          </font></td>
        <td ALIGN=CENTER width="108" bgcolor="#D9FBEC"><font size="2" face="Arial, Helvetica, sans-serif">
          $
          <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="proposed_hoa_dues" value="" SIZE="10" onChange="calcloan(this.form,'proposed_hoa_dues');" onFocus="nextfield ='current_other_expenses'; mark(this,'#ffffcc','#0000FF')">
          </font></td>
      </tr>
      <tr>
        <td width="53">&nbsp;</td>
        <td width="323" bgcolor="#D9FBEC"><font face="Arial,Helvetica"><font size=-1>&nbsp;&nbsp;Other Expenses:&nbsp;</font></font></td>
        <td ALIGN=CENTER width="118" bgcolor="#ECFDF7"><font face="Arial, Helvetica, sans-serif" size="2">
          $
          <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="current_other_expenses" value="" SIZE="10" onChange="calchousing(this.form,'current_other_expenses');" onFocus="nextfield ='proposed_other_expenses'; mark(this,'#ffffcc','#0000FF')">
          </font></td>
        <td ALIGN=CENTER width="108" bgcolor="#D9FBEC"><font size="2" face="Arial, Helvetica, sans-serif">
          $
          <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="proposed_other_expenses" value="" SIZE="10" onChange="calcloan(this.form,'proposed_other_expenses');" onFocus="nextfield ='reo1_present_res'; mark(this,'#ffffcc','#0000FF')">
          </font></td>
      </tr>
      <tr>
        <td width="53">&nbsp;</td>
        <td width="323" bgcolor="#D9FBEC"><b><font face="Arial,Helvetica"><font size=-1>&nbsp;&nbsp;Total:&nbsp;</font></font></b></td>
        <td ALIGN=CENTER BGCOLOR="#C20303" width="118"><font face="Arial, Helvetica, sans-serif" size="2">
          </font><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><b>$</b></font><font face="Arial, Helvetica, sans-serif" size="2">
          <input type="text" NAME="current_total_expenses" SIZE="10" onFocus="blur();document.smartform.reo1_present_res.focus()" onChange="this.form.field.value + form.current_pi.value + form.current_other_financing.value + form.current_hazard_insurance.value + form.current_re_taxes.value + form.current_mi.value + form.current_hoa_dues.value + form.current_other_expenses.value; calchousing(this.form,'field');">
          </font></td>
        <td ALIGN=CENTER BGCOLOR="#C20303" width="108"><font size="2" face="Arial, Helvetica, sans-serif">
          </font><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><b>$</b></font><font size="2" face="Arial, Helvetica, sans-serif">
          <input type="text" NAME="proposed_total_expenses" SIZE="10" onFocus="blur();document.smartform.reo1_present_res.focus()" onChange="this.form.field.value + form.proposed_pi.value + form.proposed_other_financing.value + form.proposed_hazard_insurance.value + form.proposed_re_taxes.value + form.proposed_mi.value + form.proposed_hoa_dues.value + form.proposed_other_expenses.value; calcloan(this.form,'field');">
          </font></td>
      </tr>
    </table>
    <br>
    <br>
  </center>

<center>
    <table BORDER=1 CELLSPACING=0 CELLPADDING=0 WIDTH="620" BGCOLOR="#DF82F7" bordercolor="#9F18A3" >
      <tr>
<td>
<center><a NAME="tab10"></a><b><font face="Arial, Helvetica, sans-serif"><font color="#FFFFFF"><font size=+0>SCHEDULE
OF REAL ESTATE OWNED</font></font></font></b><a NAME="help43"></a></center>
</td>
</tr>
</table>
    <br>
  </center>

<center>
    <table BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH="620">
      <tr>
        <td><b><font face="Arial,Helvetica"><font size=-1>Property Address (#1):</font></font></b></td>
      </tr>
    </table>
    <table width="620" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td bgcolor="#F5DBF9" width="165"><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;Check
                if this property is: </font></td>
              <td bgcolor="#F5DBF9" width="24">
                <input onBlur="mark(this,'#F5DBF9','#000000')" type="checkbox" name="reo1_present_res" value="X" onFocus="nextfield ='reo1_subj_prop'; mark(this,'#ffffcc','#0000FF')">
              </td>
              <td bgcolor="#F5DBF9" width="172"><font size="2" face="Arial, Helvetica, sans-serif">your
                current residence, or:</font></td>
              <td bgcolor="#F5DBF9" width="21">
                <input onBlur="mark(this,'#F5DBF9','#000000')" type="checkbox" name="reo1_subj_prop" value="X" onFocus="nextfield ='reo1_street'; mark(this,'#ffffcc','#0000FF')">
              </td>
              <td bgcolor="#F5DBF9" width="238"><font face="Arial, Helvetica, sans-serif" size="2">the
                subject property for this application.</font></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <table width="620" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="54" valign="top">
          <table width="100%" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td><b><a href="#./Help/Help43" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help43','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help43.php','help43','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.reo1_street.focus()"><img src="images/helpB.gif" name="help43" border=0 height=15 width=46></a></b></td>
            </tr>
          </table>
        </td>
        <td width="305">
          <table width="100%" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td bgcolor="#F5DBF9" height="28">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="40%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Street:&nbsp;</font></font></div>
                    </td>
                    <td width="60%">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="reo1_street" size="20" maxlength="40" onFocus="nextfield ='reo1_city'; mark(this,'#ffffcc','#0000FF')">
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td bgcolor="#F5DBF9" height="28">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="40%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>City,
                        State, ZIP:&nbsp;</font></font></div>
                    </td>
                    <td width="60%">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="reo1_city" size="20" maxlength="40" onFocus="nextfield ='reo1_status'; mark(this,'#ffffcc','#0000FF')">
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td bgcolor="#F5DBF9" height="28">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="40%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Status:&nbsp;</font></font></div>
                    </td>
                    <td width="60%"><font face="Arial,Helvetica"><font size=-1>
                      <select name="reo1_status" onFocus="nextfield ='reo1_type';">
                        <option value="">Please Select</option>
                        <option value="S">Sold</option>
                        <option value="PS">Pending Sale</option>
                        <option value="R">Rental</option>
                        <option value="H">Retained</option>
                      </select>
                      </font></font></td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td bgcolor="#F5DBF9" height="28">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="40%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Property
                        Type:&nbsp;</font></font> </div>
                    </td>
                    <td width="60%">
                      <select name="reo1_type" onFocus="nextfield ='prop_one_market_value';">
                        <option value="">Please Select</option>
                        <option value="SFR">Single Family Res.</option>
                        <option value="CNDO">Condo</option>
                        <option value="TSE">Townhouse</option>
                        <option value="COOP">Co-operative</option>
                        <option value="2-4U">2 - 4 Unit Prop.</option>
                        <option value="5U+">Multi Family Prop.</option>
                        <option value="MFG">Mfd./Mobile Home</option>
                        <option value="CNR">Commercial/Nonres.</option>
                        <option value="MUR">Mixed Use/Res.</option>
                        <option value="FRM">Farm</option>
                        <option value="HBC">Home/Bus. Combined</option>
                        <option value="LND">Land</option>
                      </select>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td bgcolor="#F5DBF9" height="28">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="50%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>
                        Present Market Value:&nbsp;</font></font></div>
                    </td>
                    <td width="50%">
                      <div align="center"> <font face="Arial,Helvetica"><font size="2" face="Arial, Helvetica, sans-serif">$</font></font>
                        <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="prop_one_market_value" value="" size="10" onChange="calcasset(this.form,'prop_one_market_value');" onFocus="nextfield ='prop_one_mort_lien_value'; mark(this,'#ffffcc','#0000FF')">
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
        <td width="261">
          <table width="100%" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td bgcolor="#F5DBF9" height="28">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="55%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Mortgage
                        Liens:&nbsp;</font></font> </div>
                    </td>
                    <td width="45%">
                      <div align="center"><font size="2" face="Arial, Helvetica, sans-serif">$</font>
                        <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="prop_one_mort_lien_value" value="" size="10" onChange="calcasset(this.form,'prop_one_mort_lien_value');" onFocus="nextfield ='prop_one_mort_pymt'; mark(this,'#ffffcc','#0000FF')">
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td bgcolor="#F5DBF9" height="28">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="55%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Mortgage
                        Payments:&nbsp;</font></font> </div>
                    </td>
                    <td width="45%">
                      <div align="center"><font size="2" face="Arial, Helvetica, sans-serif">$</font>
                        <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="prop_one_mort_pymt" value="" size="10" onChange="calcasset(this.form,'prop_one_mort_pymt');" onFocus="nextfield ='prop_one_other_expense'; mark(this,'#ffffcc','#0000FF')">
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td bgcolor="#F5DBF9" height="28">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="55%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Maint.,
                        Taxes, Ins.:&nbsp;</font></font></div>
                    </td>
                    <td width="45%">
                      <div align="center"> <font size="2" face="Arial, Helvetica, sans-serif">$</font>
                        <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="prop_one_other_expense" value="" size="10" onChange="calcasset(this.form,'prop_one_other_expense');" onFocus="nextfield ='prop_one_gross_rental_income'; mark(this,'#ffffcc','#0000FF')">
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td bgcolor="#F5DBF9" height="28">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="55%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Gross
                        Rental Income:&nbsp;</font></font></div>
                    </td>
                    <td width="45%">
                      <div align="center"><font face="Arial,Helvetica"><font size="2" face="Arial, Helvetica, sans-serif">$</font><font size=-1>
                        <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="prop_one_gross_rental_income" value="" size="10" onChange="calcasset(this.form,'prop_one_gross_rental_income');" onFocus="nextfield ='add_prop_record1'; mark(this,'#ffffcc','#0000FF')">
                        </font></font></div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td bgcolor="#F5DBF9" height="28">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="55%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Net
                        Rental Income:&nbsp;</font></font></div>
                    </td>
                    <td width="45%" bgcolor="#C20303">
                      <div align="center"> <font size="2" face="Arial, Helvetica, sans-serif"><b><font color="#FFFFFF">$</font></b></font>
                        <input type="text" name="prop_one_net_rental_income" size="10" maxlength="10" onFocus="blur();document.smartform.add_prop_record1.focus()" onChange="this.form.field.value - form.prop_one_gross_rental_income.value - form.prop_one_mort_pymt.value - form.prop_one_other_expense.value; calcasset(this.form,'field');">
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
	<table BORDER=0 WIDTH="620" align="center" >
  <tr>

    <td width="579" bgcolor="#F5DBF9"><b><font face="Arial,Helvetica"><font size=-1>If
      you would like to add another property, click &quot;Yes&quot;:&nbsp;&nbsp;</font><font face="Arial, Helvetica, sans-serif" size="2"><b><font face="Arial,Helvetica"><font face="Arial, Helvetica, sans-serif" size="-1">Yes:
      <input onBlur="mark(this,'#F5DBF9','#000000')" type="checkbox" name="add_prop_record1" onClick="hideProp1(); changePropDiv1('prop_questions1','block'); offCheckboxProp1(); if (this.checked) document.smartform.reo2_present_res.focus();" onFocus="mark(this,'#ffffcc','#0000FF')">
      &nbsp;&nbsp; No:</font> <font face="Arial, Helvetica, sans-serif" size="-1">
      <input onBlur="mark(this,'#F5DBF9','#000000')" type="checkbox" name="add_prop_record1no" onClick="hideProp1(); onCheckboxProp1();" onFocus="nextfield='statement_completed_jointly'; mark(this,'#ffffcc','#0000FF')">
	  </font></font></b></font></font></b></td>
      </tr>
    </table>


    <br>
	<div id="prop_questions1" style="margin-left:0px;display:none">
    <table border=0 cellspacing=0 cellpadding=0 width="620" >
      <tr>
        <td><b><font face="Arial,Helvetica"><font size=-1>Property Address (#2):</font></font></b></td>
      </tr>
    </table>
      <table width="620" border="0" cellspacing="2" cellpadding="0">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td bgcolor="#F5DBF9" width="165"><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;Check
                  if this property is: </font></td>
                <td bgcolor="#F5DBF9" width="24">
                  <input onBlur="mark(this,'#F5DBF9','#000000')" type="checkbox" name="reo2_present_res" value="X" onFocus="nextfield='reo2_subj_prop'; mark(this,'#ffffcc','#0000FF')">
                </td>
                <td bgcolor="#F5DBF9" width="172"><font size="2" face="Arial, Helvetica, sans-serif">your
                  current residence, or:</font></td>
                <td bgcolor="#F5DBF9" width="21">
                  <input onBlur="mark(this,'#F5DBF9','#000000')" type="checkbox" name="reo2_subj_prop" value="X" onFocus="nextfield='reo2_street'; mark(this,'#ffffcc','#0000FF')">
                </td>
                <td bgcolor="#F5DBF9" width="238"><font face="Arial, Helvetica, sans-serif" size="2">the
                  subject property for this application.</font></td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <table width="620" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="54" valign="top">&nbsp; </td>
        <td width="305">
          <table width="100%" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td bgcolor="#F5DBF9" height="28">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                      <td width="40%">
                        <div align="right"><font face="Arial,Helvetica"><font size=-1>Street:&nbsp;</font></font></div>
                    </td>
                      <td width="60%">
                        <input onBlur="mark(this,'#ffffff','#000000')" name="reo2_street" size="20" maxlength="40" onFocus="nextfield ='reo2_city'; mark(this,'#ffffcc','#0000FF')">
                      </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td bgcolor="#F5DBF9" height="28">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                      <td width="40%">
                        <div align="right"><font face="Arial,Helvetica"><font size=-1>City,
                          State, ZIP:&nbsp;</font></font></div>
                    </td>
                      <td width="60%">
                        <input onBlur="mark(this,'#ffffff','#000000')" name="reo2_city" size="20" maxlength="40" onFocus="nextfield ='reo2_status'; mark(this,'#ffffcc','#0000FF')">
                      </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td bgcolor="#F5DBF9" height="28">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                      <td width="40%">
                        <div align="right"><font face="Arial,Helvetica"><font size=-1>Status:&nbsp;</font></font></div>
                    </td>
                      <td width="60%"><font face="Arial,Helvetica"><font size=-1>
                        <select name="reo2_status" onFocus="nextfield ='reo2_type';">
                        <option value="">Please Select</option>
                        <option value="S">Sold</option>
                        <option value="PS">Pending Sale</option>
                        <option value="R">Rental</option>
						<option value="H">Retained</option>
                      </select>
                        </font></font></td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td bgcolor="#F5DBF9" height="28">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                      <td width="40%">
                        <div align="right"><font face="Arial,Helvetica"><font size=-1>Property
                          Type:&nbsp;</font></font> </div>
                    </td>
                      <td width="60%">
                        <select name="reo2_type" onFocus="nextfield ='prop_two_market_value';">
                        <option value="">Please Select</option>
                        <option value="SFR">Single Family Res.</option>
						<option value="CNDO">Condo</option>
                        <option value="TSE">Townhouse</option>
                        <option value="COOP">Co-operative</option>
                        <option value="2-4U">2 - 4 Unit Prop.</option>
                        <option value="5U+">Multi Family Prop.</option>
                        <option value="MFG">Mfd./Mobile Home</option>
                        <option value="CNR">Commercial/Nonres.</option>
						<option value="MUR">Mixed Use/Res.</option>
						<option value="FRM">Farm</option>
						<option value="HBC">Home/Bus. Combined</option>
						<option value="LND">Land</option>
                      </select>
                      </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td bgcolor="#F5DBF9" height="28">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="50%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>
                        Present Market Value:&nbsp;</font></font></div>
                    </td>
                    <td width="50%">
                      <div align="center"><font face="Arial,Helvetica"><font size="2" face="Arial, Helvetica, sans-serif">$</font></font>
                        <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="prop_two_market_value" value="" size="10" onChange="calcasset(this.form,'prop_two_market_value');" onFocus="nextfield ='prop_two_mort_lien_value'; mark(this,'#ffffcc','#0000FF')">
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
        <td width="261">
          <table width="100%" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td bgcolor="#F5DBF9" height="28">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="55%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Mortgage
                        Liens:&nbsp;</font></font> </div>
                    </td>
                    <td width="45%">
                      <div align="center"><font size="2" face="Arial, Helvetica, sans-serif">$</font>
                        <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="prop_two_mort_lien_value" value="" size="10" onChange="calcasset(this.form,'prop_two_mort_lien_value');" onFocus="nextfield ='prop_two_mort_pymt'; mark(this,'#ffffcc','#0000FF')">
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td bgcolor="#F5DBF9" height="28">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="55%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Mortgage
                        Payments:&nbsp;</font></font> </div>
                    </td>
                    <td width="45%">
                      <div align="center"><font size="2" face="Arial, Helvetica, sans-serif">$</font>
                        <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="prop_two_mort_pymt" value="" size="10" onChange="calcasset(this.form,'prop_two_mort_pymt');" onFocus="nextfield ='prop_two_other_expense'; mark(this,'#ffffcc','#0000FF')">
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td bgcolor="#F5DBF9" height="28">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="55%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Maint.,
                        Taxes, Ins.:&nbsp;</font></font></div>
                    </td>
                    <td width="45%">
                      <div align="center"> <font size="2" face="Arial, Helvetica, sans-serif">$</font>
                        <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="prop_two_other_expense" value="" size="10" onChange="calcasset(this.form,'prop_two_other_expense');" onFocus="nextfield ='prop_two_gross_rental_income'; mark(this,'#ffffcc','#0000FF')">
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td bgcolor="#F5DBF9" height="28">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="55%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Gross
                        Rental Income:&nbsp;</font></font></div>
                    </td>
                    <td width="45%">
                      <div align="center"><font face="Arial,Helvetica"><font size="2" face="Arial, Helvetica, sans-serif">$</font><font size=-1>
                        <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="prop_two_gross_rental_income" value="" size="10" onChange="calcasset(this.form,'prop_two_gross_rental_income');" onFocus="nextfield ='add_prop_record2'; mark(this,'#ffffcc','#0000FF')">
                        </font></font></div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td bgcolor="#F5DBF9" height="28">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="55%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Net
                        Rental Income:&nbsp;</font></font></div>
                    </td>
                    <td width="45%" bgcolor="#C20303">
                      <div align="center"> <font size="2" face="Arial, Helvetica, sans-serif"><b><font color="#FFFFFF">$</font></b></font>
                        <input type="text" name="prop_two_net_rental_income" size="10" maxlength="10" onFocus="blur();document.smartform.add_prop_record2.focus()" onChange="this.form.field.value - form.prop_two_gross_rental_income.value - form.prop_two_mort_pymt.value - form.prop_two_other_expense.value; calcasset(this.form,'field');">
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
	<table border=0 width="620" align="center" >
  <tr>
      <td width="579" bgcolor="#F5DBF9"><b><font face="Arial,Helvetica"><font size=-1>If
        you would like to add another property, click &quot;Yes&quot;:&nbsp;&nbsp;</font><font face="Arial, Helvetica, sans-serif" size="2"><b><font face="Arial,Helvetica"><font face="Arial, Helvetica, sans-serif" size="-1">Yes:
        <input onBlur="mark(this,'#F5DBF9','#000000')" type="checkbox" name="add_prop_record2" onClick="hideProp2(); changePropDiv2('prop_questions2','block'); offCheckboxProp2(); if (this.checked) document.smartform.reo3_present_res.focus();" onFocus="mark(this,'#ffffcc','#0000FF')">
        &nbsp;&nbsp; No:</font> <font face="Arial, Helvetica, sans-serif" size="-1">
        <input onBlur="mark(this,'#F5DBF9','#000000')" type="checkbox" name="add_prop_record2no" onClick="hideProp2(); onCheckboxProp2();" onFocus="nextfield='statement_completed_jointly'; mark(this,'#ffffcc','#0000FF')">
		</font></font></b></font></font></b></td>
  </tr>
</table>

    <br>
	</div>
	<div id="prop_questions2" style="margin-left:0px;display:none">
    <table border=0 cellspacing=0 cellpadding=0 width="620" >
      <tr>
        <td><b><font face="Arial,Helvetica"><font size=-1>Property Address (#3):</font></font></b></td>
      </tr>
    </table>
      <table width="620" border="0" cellspacing="2" cellpadding="0">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td bgcolor="#F5DBF9" width="165"><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;Check
                  if this property is: </font></td>
                <td bgcolor="#F5DBF9" width="24">
                  <input onBlur="mark(this,'#F5DBF9','#000000')" type="checkbox" name="reo3_present_res" value="X" onFocus="nextfield='reo3_subj_prop'; mark(this,'#ffffcc','#0000FF')">
                </td>
                <td bgcolor="#F5DBF9" width="172"><font size="2" face="Arial, Helvetica, sans-serif">your
                  current residence, or:</font></td>
                <td bgcolor="#F5DBF9" width="21">
                  <input onBlur="mark(this,'#F5DBF9','#000000')" type="checkbox" name="reo3_subj_prop" value="X" onFocus="nextfield='reo3_street'; mark(this,'#ffffcc','#0000FF')">
                </td>
                <td bgcolor="#F5DBF9" width="238"><font face="Arial, Helvetica, sans-serif" size="2">the
                  subject property for this application.</font></td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <table width="620" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="54" valign="top">&nbsp; </td>
        <td width="305">
          <table width="100%" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td bgcolor="#F5DBF9" height="28">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                      <td width="40%">
                        <div align="right"><font face="Arial,Helvetica"><font size=-1>Street:&nbsp;</font></font></div>
                    </td>
                      <td width="60%">
                        <input onBlur="mark(this,'#ffffff','#000000')" name="reo3_street" size="20" maxlength="40" onFocus="nextfield ='reo3_city'; mark(this,'#ffffcc','#0000FF')">
                      </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td bgcolor="#F5DBF9" height="28">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                      <td width="40%">
                        <div align="right"><font face="Arial,Helvetica"><font size=-1>City,
                          State, ZIP:&nbsp;</font></font></div>
                    </td>
                      <td width="60%">
                        <input onBlur="mark(this,'#ffffff','#000000')" name="reo3_city" size="20" maxlength="40" onFocus="nextfield ='reo3_status'; mark(this,'#ffffcc','#0000FF')">
                      </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td bgcolor="#F5DBF9" height="28">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                      <td width="40%">
                        <div align="right"><font face="Arial,Helvetica"><font size=-1>Status:&nbsp;</font></font></div>
                    </td>
                      <td width="60%"><font face="Arial,Helvetica"><font size=-1>
                        <select name="reo3_status" onFocus="nextfield ='reo3_type';">
                        <option value="">Please Select</option>
                        <option value="S">Sold</option>
                        <option value="PS">Pending Sale</option>
                        <option value="R">Rental</option>
						<option value="H">Retained</option>
                      </select>
                        </font></font></td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td bgcolor="#F5DBF9" height="28">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                      <td width="40%">
                        <div align="right"><font face="Arial,Helvetica"><font size=-1>Property
                          Type:&nbsp;</font></font> </div>
                    </td>
                      <td width="60%">
                        <select name="reo3_type" onFocus="nextfield ='prop_three_market_value';">
                        <option value="">Please Select</option>
                        <option value="SFR">Single Family Res.</option>
						<option value="CNDO">Condo</option>
                        <option value="TSE">Townhouse</option>
                        <option value="COOP">Co-operative</option>
                        <option value="2-4U">2 - 4 Unit Prop.</option>
                        <option value="5U+">Multi Family Prop.</option>
                        <option value="MFG">Mfd./Mobile Home</option>
                        <option value="CNR">Commercial/Nonres.</option>
						<option value="MUR">Mixed Use/Res.</option>
						<option value="FRM">Farm</option>
						<option value="HBC">Home/Bus. Combined</option>
						<option value="LND">Land</option>
                      </select>
                      </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td bgcolor="#F5DBF9" height="28">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="50%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>
                        Present Market Value:&nbsp;</font></font></div>
                    </td>
                    <td width="50%">
                      <div align="center"><font face="Arial,Helvetica"><font size="2" face="Arial, Helvetica, sans-serif">$</font></font>
                        <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="prop_three_market_value" value="" size="10" onChange="calcasset(this.form,'prop_three_market_value');" onFocus="nextfield ='prop_three_mort_lien_value'; mark(this,'#ffffcc','#0000FF')">
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
        <td width="261">
          <table width="100%" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td bgcolor="#F5DBF9" height="28">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="55%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Mortgage
                        Liens:&nbsp;</font></font> </div>
                    </td>
                    <td width="45%">
                      <div align="center"><font size="2" face="Arial, Helvetica, sans-serif">$</font>
                        <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="prop_three_mort_lien_value" value="" size="10" onChange="calcasset(this.form,'prop_three_mort_lien_value');" onFocus="nextfield ='prop_three_mort_pymt'; mark(this,'#ffffcc','#0000FF')">
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td bgcolor="#F5DBF9" height="28">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="55%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Mortgage
                        Payments:&nbsp;</font></font> </div>
                    </td>
                    <td width="45%">
                      <div align="center"><font size="2" face="Arial, Helvetica, sans-serif">$</font>
                        <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="prop_three_mort_pymt" value="" size="10" onChange="calcasset(this.form,'prop_three_mort_pymt');" onFocus="nextfield ='prop_three_other_expense'; mark(this,'#ffffcc','#0000FF')">
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td bgcolor="#F5DBF9" height="28">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="55%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Maint.,
                        Taxes, Ins.:&nbsp;</font></font></div>
                    </td>
                    <td width="45%">
                      <div align="center"> <font size="2" face="Arial, Helvetica, sans-serif">$</font>
                        <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="prop_three_other_expense" value="" size="10" onChange="calcasset(this.form,'prop_three_other_expense');" onFocus="nextfield ='prop_three_gross_rental_income'; mark(this,'#ffffcc','#0000FF')">
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td bgcolor="#F5DBF9" height="28">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="55%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Gross
                        Rental Income:&nbsp;</font></font></div>
                    </td>
                    <td width="45%">
                      <div align="center"><font face="Arial,Helvetica"><font size="2" face="Arial, Helvetica, sans-serif">$</font><font size=-1>
                        <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="prop_three_gross_rental_income" value="" size="10" onChange="calcasset(this.form,'prop_three_gross_rental_income');" onFocus="nextfield ='statement_completed_jointly'; mark(this,'#ffffcc','#0000FF')">
                        </font></font></div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td bgcolor="#F5DBF9" height="28">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="55%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Net
                        Rental Income:&nbsp;</font></font></div>
                    </td>
                    <td width="45%" bgcolor="#C20303">
                      <div align="center"> <font size="2" face="Arial, Helvetica, sans-serif"><b><font color="#FFFFFF">$</font></b></font>
                        <input type="text" name="prop_three_net_rental_income" size="10" maxlength="10" onFocus="blur();document.smartform.statement_completed_jointly.focus()" onChange="this.form.field.value - form.prop_three_gross_rental_income.value - form.prop_three_mort_pymt.value - form.prop_three_other_expense.value; calcasset(this.form,'field');">
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
	</div>
    <br>
    <br>
  </center>

<center>
  </center>

<center>
    <table BORDER=0 WIDTH="620" >
      <tr>
        <td VALIGN=TOP>
          <center>
            <font face="Arial,Helvetica"><font size=-1>Total Present Market Value:&nbsp;</font></font>
          </center>
        </td>
        <td WIDTH="10"></td>
        <td VALIGN=TOP>
          <center>
            <font face="Arial,Helvetica"><font size=-1>Total Mortgage Liens:</font></font>
          </center>
        </td>
        <td WIDTH="10"></td>
        <td VALIGN=TOP>
          <center>
            <font face="Arial,Helvetica"><font size=-1>Total Gross Rental Income:&nbsp;</font></font>
          </center>
        </td>
        <td WIDTH="10"></td>
        <td VALIGN=TOP>
          <center>
            <font face="Arial,Helvetica"><font size=-1>Rental Income with</font></font>
            <br>
            <font face="Arial,Helvetica"><font size=-1>25% Vacancy Factor:</font></font>
          </center>
        </td>
      </tr>
      <tr>
        <td ALIGN=CENTER BGCOLOR="#C20303">
          <center>
            <b><font color="#FFFFFF">$&nbsp;</font></b>
            <input type="text" name="total_prop_market_value" size="10" maxlength="20" onFocus="blur();document.smartform.statement_completed_jointly.focus()" onChange="this.form.field.value + form.prop_one_market_value.value + form.prop_two_market_value.value + form.prop_three_market_value.value; calcasset(this.form,'field');">
          </center>
        </td>
        <td>&nbsp;</td>
        <td BGCOLOR="#C20303">
          <center>
            <b><font color="#FFFFFF">$&nbsp;</font></b>
            <input type="text" name="total_prop_mort_lien_value" size="10" maxlength="20" onFocus="blur();document.smartform.statement_completed_jointly.focus()" onChange="this.form.field.value + form.prop_one_mort_lien_value.value + form.prop_two_mort_lien_value.value + form.prop_three_mort_lien_value.value; calcasset(this.form,'field');">
          </center>
        </td>
        <td>&nbsp;</td>
        <td BGCOLOR="#C20303">
          <center>
            <b><font color="#FFFFFF">$&nbsp;</font></b>
            <input type="text" name="total_prop_gross_rental_income" size="10" maxlength="20" onFocus="blur();document.smartform.statement_completed_jointly.focus()" onChange="this.form.field.value - form.total_prop_gross_rental_income.value * .75; calcasset(this.form,'field');">
          </center>
        </td>
        <td></td>
        <td BGCOLOR="#C20303">
          <center>
            <b><font color="#FFFFFF">$&nbsp;</font></b>
            <input type="text" name="effective_gross_rent_vacancy_factor" size="10" maxlength="20" onFocus="blur();document.smartform.statement_completed_jointly.focus()" onChange="this.form.field.value + form.prop_one_gross_rental_income.value + form.prop_two_gross_rental_income.value + form.prop_three_gross_rental_income.value; calcasset(this.form,'field');">
          </center>
        </td>
      </tr>
      <tr>
        <td VALIGN=TOP>
          <center>
            <font face="Arial,Helvetica"><font size=-1>Total Mortgage Payments:&nbsp;</font></font>
          </center>
        </td>
        <td></td>
        <td VALIGN=TOP>
          <center>
            <font face="Arial,Helvetica"><font size=-1>Total Maint., Taxes, Ins.:&nbsp;</font></font>
          </center>
        </td>
        <td></td>
        <td VALIGN=TOP>
          <center>
            <font face="Arial,Helvetica"><font size=-1>Total reported Net Rental
            Income:&nbsp;</font></font>
          </center>
        </td>
        <td></td>
        <td VALIGN=TOP>
          <center>
            <font face="Arial,Helvetica"><font size=-1>Effective Net Rental Income:&nbsp;</font></font>
          </center>
        </td>
      </tr>
      <tr>
        <td BGCOLOR="#C20303">
          <center>
            <b><font color="#FFFFFF">$&nbsp;</font></b>
            <input type="text" name="total_prop_mort_pymts" size="10" maxlength="20" onFocus="blur();document.smartform.statement_completed_jointly.focus()" onChange="this.form.field.value + form.prop_one_mort_pymt.value + form.prop_two_mort_pymt.value + form.prop_three_mort_pymt.value; calcasset(this.form,'field');">
          </center>
        </td>
        <td></td>
        <td BGCOLOR="#C20303">
          <center>
            <b><font color="#FFFFFF">$&nbsp;</font></b>
            <input type="text" name="total_prop_other_expense" size="10" maxlength="20" onFocus="blur();document.smartform.statement_completed_jointly.focus()" onChange="this.form.field.value + form.prop_one_other_expense.value + form.prop_two_other_expense.value + form.prop_three_other_expense.value; calcasset(this.form,'field');">
          </center>
        </td>
        <td></td>
        <td BGCOLOR="#C20303">
          <center>
            <b><font color="#FFFFFF">$&nbsp;</font></b>
            <input type="text" name="total_prop_net_rental_income" size="10" maxlength="20" onFocus="blur();document.smartform.statement_completed_jointly.focus()" onChange="this.form.field.value + form.prop_one_net_rental_income.value + form.prop_two_net_rental_income.value + form.prop_three_net_rental_income.value; calcasset(this.form,'field');">
          </center>
        </td>
        <td></td>
        <td BGCOLOR="#C20303">
          <center>
            <b><font color="#FFFFFF">$&nbsp;</font></b>
            <input type="text" name="effective_net_rental_income" size="10" maxlength="20" onFocus="blur();document.smartform.statement_completed_jointly.focus()" onChange="this.form.field.value - form.effective_gross_rent_vacancy_factor.value - form.total_prop_mort_pymts.value - form.total_prop_other_expense.value; calcasset(this.form,'field');">
          </center>
        </td>
      </tr>
    </table>
    <br>
    <br>
  </center>

<center>
    <table BORDER=1 CELLSPACING=0 CELLPADDING=0 WIDTH="620" BGCOLOR="#3E96B7" bordercolor="#286277" >
      <tr>
<td>
<center><a NAME="tab11"></a><b><font face="Arial, Helvetica, sans-serif"><font color="#FFFFFF"><font size=+0>INFORMATION
ABOUT YOUR ASSETS</font></font></font></b><a NAME="help39"></a></center>
</td>
</tr>
</table>
    <br>
  </center>

<center>
    <table BORDER=0 WIDTH="620" >
      <tr>
        <td><font face="Arial,Helvetica"><font size=-1>The Statement below and
          any applicable supporting schedules may be completed jointly by both
          married and unmarried Co-Borrowers if their assets and liabilities are
          sufficiently joined so that the Statement can be meaningfully and fairly
          presented on a combined basis; otherwise separate Statements and Schedules
          are required. If the Co-Borrower section was completed about a spouse,
          this Statement and supporting schedules must be completed about that
          spouse also.</font></font></td>
      </tr>
    </table>
    <br>
  </center>

<center>
    <table BORDER=0 WIDTH="620" >
      <tr>
        <td width="51"><a href="#./Help/Help39" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help39','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help39.php','help39','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.statement_completed_jointly.focus()"><img src="images/helpB.gif" name="help39" border=0 height=15 width=46></a></td>
        <td width="567" bgcolor="#ACD5E3">
          <div align="left"><font face="Arial,Helvetica"><font size=-1>&nbsp;The Assets
            and Liabilities section below will be completed: </font><font face="Arial,Helvetica"><font size=-1>&nbsp;Jointly</font></font><font face="Arial,Helvetica"><font size=-1>
            <input onBlur="mark(this,'#ACD5E3','#000000')" type="checkbox" value="X" name="statement_completed_jointly" onClick="offCheckboxJoint();" onFocus="nextfield ='statement_completed_not_jointly'; mark(this,'#ffffcc','#0000FF')">
            </font></font><font face="Arial,Helvetica"><font size=-1>&nbsp;&nbsp;
            Not Jointly</font></font><font size=-1>
            <input onBlur="mark(this,'#ACD5E3','#000000')" type="checkbox" value="X" name="statement_completed_not_jointly" onClick="onCheckboxJoint();" onFocus="nextfield ='deposit_held_by'; mark(this,'#ffffcc','#0000FF')">
            </font></font></div>
        </td>
      </tr>
      <tr>
        <td width="51">&nbsp;</td>
        <td width="567" bgcolor="#ACD5E3">
          <div align="left"><font face="Arial,Helvetica"><font size=-1>&nbsp;Cash deposit
            toward purchase held by (enter party):
            <input onBlur="mark(this,'#ffffff','#000000')" name="deposit_held_by" size="20" maxlength="30" onFocus="nextfield ='deposit_amount'; mark(this,'#ffffcc','#0000FF')">
            </font></font></div>
        </td>
      </tr>
      <tr>
        <td width="51">&nbsp;</td>
        <td width="567" bgcolor="#ACD5E3">
          <div align="left"><font face="Arial,Helvetica"><font size=-1>&nbsp;Amount
            of Deposit held for down payment: $
            <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="deposit_amount" value="" size="10" onChange="calcasset(this.form,'deposit_amount');" onFocus="nextfield ='bnk1_name'; mark(this,'#ffffcc','#0000FF')">
            </font></font></div>
        </td>
      </tr>
    </table>
  </center>
  <a NAME="help40"></a>
  <table BORDER=0 WIDTH="620" align="center" >
    <tr>
<td>
<center>
            <b><font face="Arial,Helvetica" color="#3E96B7">List checking and
            savings accounts below</font></b>
          </center>
</td>
</tr>
</table>
    <br>

  <table width="620" border="0" cellspacing="2" cellpadding="0" align="center">
    <tr>
        <td><font face="Arial,Helvetica"><font size=-1><b>Name and address of
          Bank, S&amp;L, or Credit Union (#1):</b></font></font> </td>
      </tr>
    </table>
    <div align="center"></div>

  <table width="620" border="0" cellspacing="2" cellpadding="0" align="center">
    <tr>
        <td width="51"><a href="#./Help/Help40" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help40','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help40.php','help40','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.bnk1_name.focus()"><img src="images/helpB.gif" name="help40" border=0 height=15 width=46></a></td>
        <td width="280" bgcolor="#ACD5E3">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="98">
                <div align="right"><font face="Arial,Helvetica"><font size=-1>Name:&nbsp;</font></font></div>
              </td>
              <td width="182">
                <input onBlur="mark(this,'#ffffff','#000000')" name="bnk1_name" size="20" maxlength="40" onFocus="nextfield ='bnk1_street'; mark(this,'#ffffcc','#0000FF')">
              </td>
            </tr>
          </table>
        </td>
        <td width="280" bgcolor="#ACD5E3">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="49%">
                <div align="right"><font face="Arial,Helvetica"><font size=-1>Account Number:&nbsp;</font></font></div>
              </td>
              <td width="51%">
                <input onBlur="mark(this,'#ffffff','#000000')" name="bank_account_number_one" size="20" onFocus="nextfield ='bank_amount_one'; mark(this,'#ffffcc','#0000FF')">
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td width="51">&nbsp;</td>
        <td width="280" bgcolor="#ACD5E3">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="98">
                <div align="right"><font face="Arial,Helvetica"><font size=-1>Street:&nbsp;</font></font></div>
              </td>
              <td width="182">
                <input onBlur="mark(this,'#ffffff','#000000')" name="bnk1_street" size="20" maxlength="30" onFocus="nextfield ='bnk1_city'; mark(this,'#ffffcc','#0000FF')">
              </td>
            </tr>
          </table>
        </td>
        <td width="280" bgcolor="#ACD5E3">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="49%">
                <div align="right"><font face="Arial,Helvetica"><font size=-1>Cash
                  or Market Value:&nbsp;</font></font> </div>
              </td>
              <td width="51%"> <font size="2" face="Arial, Helvetica, sans-serif">&nbsp;$</font>
                <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="bank_amount_one" value="" size="10" onChange="calcasset(this.form,'bank_amount_one');" onFocus="nextfield ='add_bank_record1'; mark(this,'#ffffcc','#0000FF')">
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td width="51">&nbsp;</td>
        <td colspan="2" bgcolor="#ACD5E3">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="98">
                <div align="right"><font face="Arial,Helvetica"><font size=-1>City,
                  State, ZIP:&nbsp;</font></font></div>
              </td>
              <td width="462">
                <input onBlur="mark(this,'#ffffff','#000000')" name="bnk1_city" size="20" maxlength="20" onFocus="nextfield ='bnk1_state'; mark(this,'#ffffcc','#0000FF')">
                <input onBlur="mark(this,'#ffffff','#000000')" name="bnk1_state" size="3" maxlength="20" onFocus="nextfield ='bnk1_zip'; mark(this,'#ffffcc','#0000FF')">
                <input onBlur="mark(this,'#ffffff','#000000')" name="bnk1_zip" size="5" maxlength="10" onFocus="nextfield ='bank_account_number_one'; mark(this,'#ffffcc','#0000FF')">
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <table border=0 width="620" align="center" >
      <tr>

      <td width="579" bgcolor="#ACD5E3"><b><font face="Arial,Helvetica"><font size=-1>If
        you would like to add another account, click &quot;Yes&quot;:&nbsp;&nbsp;</font><font face="Arial, Helvetica, sans-serif" size="2"><b><font face="Arial,Helvetica"><font face="Arial, Helvetica, sans-serif" size="-1">Yes:
        <input onBlur="mark(this,'#ACD5E3','#000000')" type="checkbox" name="add_bank_record1" onClick="hideBank1(); changeBankDiv1('bank_questions1','block'); offCheckboxBank1(); if (this.checked) document.smartform.bnk2_name.focus();" onFocus="mark(this,'#ffffcc','#0000FF')">
          &nbsp;&nbsp; No:</font> <font face="Arial, Helvetica, sans-serif" size="-1">
          <input onBlur="mark(this,'#ACD5E3','#000000')" type="checkbox" name="add_bank_record1no" onClick="hideBank1(); onCheckboxBank1();" onFocus="nextfield='stk1_name'; mark(this,'#ffffcc','#0000FF')">
		  </font></font></b></font></font></b></td>
      </tr>
    </table>
    <br>
<div id="bank_questions1" style="margin-left:0px;display:none">

  <table width="620" border="0" cellspacing="2" cellpadding="0" align="center">
    <tr>
        <td><font face="Arial,Helvetica"><font size=-1><b>Name and address of
          Bank, S&amp;L, or Credit Union (#2):</b></font></font> </td>
      </tr>
    </table>

  <table width="620" border="0" cellspacing="2" cellpadding="0" align="center">
    <tr>
        <td width="51">&nbsp;</td>
        <td width="280" bgcolor="#ACD5E3">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="98">
                <div align="right"><font face="Arial,Helvetica"><font size=-1>Name:&nbsp;</font></font></div>
              </td>
              <td width="182">
                <input onBlur="mark(this,'#ffffff','#000000')" name="bnk2_name" size="20" maxlength="40" onFocus="nextfield ='bnk2_street'; mark(this,'#ffffcc','#0000FF')">
              </td>
            </tr>
          </table>
        </td>
        <td width="280" bgcolor="#ACD5E3">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="49%">
                <div align="right"><font face="Arial,Helvetica"><font size=-1>Account
                  Number:&nbsp;</font></font></div>
              </td>
              <td width="51%">
                <input onBlur="mark(this,'#ffffff','#000000')" name="bank_account_number_two" size="20" onFocus="nextfield ='bank_amount_two'; mark(this,'#ffffcc','#0000FF')">
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td width="51">&nbsp;</td>
        <td width="280" bgcolor="#ACD5E3">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="98">
                <div align="right"><font face="Arial,Helvetica"><font size=-1>Street:&nbsp;</font></font></div>
              </td>
              <td width="182">
                <input onBlur="mark(this,'#ffffff','#000000')" name="bnk2_street" size="20" maxlength="30" onFocus="nextfield ='bnk2_city'; mark(this,'#ffffcc','#0000FF')">
              </td>
            </tr>
          </table>
        </td>
        <td width="280" bgcolor="#ACD5E3">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="49%">
                <div align="right"><font face="Arial,Helvetica"><font size=-1>Cash
                  or Market Value:&nbsp;</font></font> </div>
              </td>
              <td width="51%"> <font size="2" face="Arial, Helvetica, sans-serif">&nbsp;$</font>
<input onBlur="mark(this,'#ffffff','#000000')" type="text" name="bank_amount_two" value="" size="10" onChange="calcasset(this.form,'bank_amount_two');" onFocus="nextfield ='add_bank_record2'; mark(this,'#ffffcc','#0000FF')">
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td width="51">&nbsp;</td>
        <td colspan="2" bgcolor="#ACD5E3">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="98">
                <div align="right"><font face="Arial,Helvetica"><font size=-1>City,
                  State, ZIP:&nbsp;</font></font></div>
              </td>
              <td width="462">
                <input onBlur="mark(this,'#ffffff','#000000')" name="bnk2_city" size="20" maxlength="20" onFocus="nextfield ='bnk2_state'; mark(this,'#ffffcc','#0000FF')">
                <input onBlur="mark(this,'#ffffff','#000000')" name="bnk2_state" size="3" maxlength="20" onFocus="nextfield ='bnk2_zip'; mark(this,'#ffffcc','#0000FF')">
                <input onBlur="mark(this,'#ffffff','#000000')" name="bnk2_zip" size="5" maxlength="10" onFocus="nextfield ='bank_account_number_two'; mark(this,'#ffffcc','#0000FF')">
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <table border=0 width="620" align="center" >
      <tr>
        <td width="579" bgcolor="#ACD5E3"><b><font face="Arial,Helvetica"><font size=-1>If
          you would like to add another account, click &quot;Yes&quot;:&nbsp;&nbsp;</font><font face="Arial, Helvetica, sans-serif" size="2"><b><font face="Arial,Helvetica"><font face="Arial, Helvetica, sans-serif" size="-1">Yes:
          <input onBlur="mark(this,'#ACD5E3','#000000')" type="checkbox" name="add_bank_record2" onClick="hideBank2(); changeBankDiv2('bank_questions2','block'); offCheckboxBank2(); if (this.checked) document.smartform.bnk3_name.focus();" onFocus="mark(this,'#ffffcc','#0000FF')">
          &nbsp;&nbsp; No:</font> <font face="Arial, Helvetica, sans-serif" size="-1">
          <input onBlur="mark(this,'#ACD5E3','#000000')" type="checkbox" name="add_bank_record2no" onClick="hideBank2(); onCheckboxBank2();" onFocus="nextfield='stk1_name'; mark(this,'#ffffcc','#0000FF')">
          </font></font></b></font></font></b></td>
      </tr>
    </table>
    <br>
    </div>

<div id="bank_questions2" style="margin-left:0px;display:none">

  <table width="620" border="0" cellspacing="2" cellpadding="0" align="center">
    <tr>
        <td><font face="Arial,Helvetica"><font size=-1><b>Name and address of
          Bank, S&amp;L, or Credit Union (#3):</b></font></font> </td>
      </tr>
    </table>

  <table width="620" border="0" cellspacing="2" cellpadding="0" align="center">
    <tr>
        <td width="51">&nbsp;</td>
        <td width="280" bgcolor="#ACD5E3">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="98">
                <div align="right"><font face="Arial,Helvetica"><font size=-1>Name:&nbsp;</font></font></div>
              </td>
              <td width="182">
                <input onBlur="mark(this,'#ffffff','#000000')" name="bnk3_name" size="20" maxlength="40" onFocus="nextfield ='bnk3_street'; mark(this,'#ffffcc','#0000FF')">
              </td>
            </tr>
          </table>
        </td>
        <td width="280" bgcolor="#ACD5E3">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="49%">
                <div align="right"><font face="Arial,Helvetica"><font size=-1>Account
                  Number:&nbsp;</font></font></div>
              </td>
              <td width="51%">
                <input onBlur="mark(this,'#ffffff','#000000')" name="bank_account_number_three" size="20" onFocus="nextfield ='bank_amount_three'; mark(this,'#ffffcc','#0000FF')">
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td width="51">&nbsp;</td>
        <td width="280" bgcolor="#ACD5E3">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="98">
                <div align="right"><font face="Arial,Helvetica"><font size=-1>Street:&nbsp;</font></font></div>
              </td>
              <td width="182">
                <input onBlur="mark(this,'#ffffff','#000000')" name="bnk3_street" size="20" maxlength="30" onFocus="nextfield ='bnk3_city'; mark(this,'#ffffcc','#0000FF')">
              </td>
            </tr>
          </table>
        </td>
        <td width="280" bgcolor="#ACD5E3">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="49%">
                <div align="right"><font face="Arial,Helvetica"><font size=-1>Cash
                  or Market Value:&nbsp;</font></font> </div>
              </td>
              <td width="51%"> <font size="2" face="Arial, Helvetica, sans-serif">&nbsp;$</font>
                <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="bank_amount_three" value="" size="10" onChange="calcasset(this.form,'bank_amount_three');" onFocus="nextfield ='add_bank_record3'; mark(this,'#ffffcc','#0000FF')">
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td width="51">&nbsp;</td>
        <td colspan="2" bgcolor="#ACD5E3">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="98">
                <div align="right"><font face="Arial,Helvetica"><font size=-1>City,
                  State, ZIP:&nbsp;</font></font></div>
              </td>
              <td width="462">
                <input onBlur="mark(this,'#ffffff','#000000')" name="bnk3_city" size="20" maxlength="20" onFocus="nextfield ='bnk3_state'; mark(this,'#ffffcc','#0000FF')">
                <input onBlur="mark(this,'#ffffff','#000000')" name="bnk3_state" size="3" maxlength="20" onFocus="nextfield ='bnk3_zip'; mark(this,'#ffffcc','#0000FF')">
                <input onBlur="mark(this,'#ffffff','#000000')" name="bnk3_zip" size="5" maxlength="10" onFocus="nextfield ='bank_account_number_three'; mark(this,'#ffffcc','#0000FF')">
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <table border=0 width="620" align="center" >
    <tr>
        <td width="579" bgcolor="#ACD5E3"><b><font face="Arial,Helvetica"><font size=-1>If
          you would like to add another account, click &quot;Yes&quot;:&nbsp;&nbsp;</font><font face="Arial, Helvetica, sans-serif" size="2"><b><font face="Arial,Helvetica"><font face="Arial, Helvetica, sans-serif" size="-1">Yes:
          <input onBlur="mark(this,'#ACD5E3','#000000')" type="checkbox" name="add_bank_record3" onClick="hideBank3(); changeBankDiv3('bank_questions3','block'); offCheckboxBank3(); if (this.checked) document.smartform.bnk4_name.focus();" onFocus="mark(this,'#ffffcc','#0000FF')">
          &nbsp;&nbsp; No:</font> <font face="Arial, Helvetica, sans-serif" size="-1">
          <input onBlur="mark(this,'#ACD5E3','#000000')" type="checkbox" name="add_bank_record3no" onClick="hideBank3(); onCheckboxBank3();" onFocus="nextfield='stk1_name'; mark(this,'#ffffcc','#0000FF')">
          </font></font></b></font></font></b></td>
    </tr>
  </table>
  <br>
  </div>
  <div id="bank_questions3" style="margin-left:0px;display:none">

  <table width="620" border="0" cellspacing="2" cellpadding="0" align="center">
    <tr>
        <td><font face="Arial,Helvetica"><font size=-1><b>Name and address of
          Bank, S&amp;L, or Credit Union (#4):</b></font></font> </td>
      </tr>
    </table>

  <table width="620" border="0" cellspacing="2" cellpadding="0" align="center">
    <tr>
        <td width="51">&nbsp;</td>
        <td width="280" bgcolor="#ACD5E3">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="98">
                <div align="right"><font face="Arial,Helvetica"><font size=-1>Name:&nbsp;</font></font></div>
              </td>
              <td width="182">
                <input onBlur="mark(this,'#ffffff','#000000')" name="bnk4_name" size="20" maxlength="40" onFocus="nextfield ='bnk4_street'; mark(this,'#ffffcc','#0000FF')">
              </td>
            </tr>
          </table>
        </td>
        <td width="280" bgcolor="#ACD5E3">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="49%">
                <div align="right"><font face="Arial,Helvetica"><font size=-1>Account
                  Number:&nbsp;</font></font></div>
              </td>
              <td width="51%">
                <input onBlur="mark(this,'#ffffff','#000000')" name="bank_account_number_four" size="20" onFocus="nextfield ='bank_amount_four'; mark(this,'#ffffcc','#0000FF')">
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td width="51">&nbsp;</td>
        <td width="280" bgcolor="#ACD5E3">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="98">
                <div align="right"><font face="Arial,Helvetica"><font size=-1>Street:&nbsp;</font></font></div>
              </td>
              <td width="182">
                <input onBlur="mark(this,'#ffffff','#000000')" name="bnk4_street" size="20" maxlength="30" onFocus="nextfield ='bnk4_city'; mark(this,'#ffffcc','#0000FF')">
              </td>
            </tr>
          </table>
        </td>
        <td width="280" bgcolor="#ACD5E3">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="49%">
                <div align="right"><font face="Arial,Helvetica"><font size=-1>Cash
                  or Market Value:&nbsp;</font></font> </div>
              </td>
              <td width="51%"> <font size="2" face="Arial, Helvetica, sans-serif">&nbsp;$</font>
                <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="bank_amount_four" value="" size="10" onChange="calcasset(this.form,'bank_amount_four');" onFocus="nextfield ='stk1_name'; mark(this,'#ffffcc','#0000FF')">
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td width="51">&nbsp;</td>
        <td colspan="2" bgcolor="#ACD5E3">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="98">
                <div align="right"><font face="Arial,Helvetica"><font size=-1>City,
                  State, ZIP:&nbsp;</font></font></div>
              </td>
              <td width="462">
                <input onBlur="mark(this,'#ffffff','#000000')" name="bnk4_city" size="20" maxlength="20" onFocus="nextfield ='bnk4_state'; mark(this,'#ffffcc','#0000FF')">
                <input onBlur="mark(this,'#ffffff','#000000')" name="bnk4_state" size="3" maxlength="20" onFocus="nextfield ='bnk4_zip'; mark(this,'#ffffcc','#0000FF')">
                <input onBlur="mark(this,'#ffffff','#000000')" name="bnk4_zip" size="5" maxlength="10" onFocus="nextfield ='bank_account_number_four'; mark(this,'#ffffcc','#0000FF')">
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <br>
	</div>
  <center>
  </center>
<center>
    <table BORDER=0 WIDTH="620" >
      <tr>
        <td></td>
      </tr>
      <tr>
        <td>
          <center>
            <b><font face="Arial,Helvetica" color="#3E96B7" size="3"><a name="help41"></a>Stocks
            and Bonds</font></b>
          </center>
        </td>
      </tr>
    </table>
    <br>
    <table width="620" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td><font face="Arial,Helvetica"><font size=-1><b>Company Name/Number
          &amp; Description (#1):</b></font></font> </td>
      </tr>
    </table>
    <table width="620" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td width="51"><a href="#./Help/Help41" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help41','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help41.php','help41','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.stk1_name.focus()"><img src="images/helpB.gif" name="help41" border=0 height=15 width=46></a></td>
        <td width="216" bgcolor="#ACD5E3"><font face="Arial,Helvetica"><font size=-1>&nbsp;Name:&nbsp;
          <input onBlur="mark(this,'#ffffff','#000000')" name="stk1_name" size="20" maxlength="30" onFocus="nextfield ='stk1_num'; mark(this,'#ffffcc','#0000FF')">
          </font></font></td>
        <td width="90" bgcolor="#ACD5E3"><font face="Arial,Helvetica"><font size=-1>&nbsp;No.:&nbsp;
          <input onBlur="mark(this,'#ffffff','#000000')" name="stk1_num" size="5" maxlength="10" onFocus="nextfield ='stock_value_one'; mark(this,'#ffffcc','#0000FF')">
          </font></font></td>
        <td width="247" bgcolor="#ACD5E3"><font face="Arial,Helvetica"><font size=-1>&nbsp;Cash
          or Market Value:&nbsp;</font></font> <font face="Arial, Helvetica, sans-serif" size="2">$</font>
          <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="stock_value_one" value="" size="10" onChange="calcasset(this.form,'stock_value_one');" onFocus="nextfield ='stk2_name'; mark(this,'#ffffcc','#0000FF')">
        </td>
      </tr>
    </table>
    <br>
    <table width="620" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td><font face="Arial,Helvetica"><font size=-1><b>Company Name/Number
          &amp; Description (#2):</b></font></font> </td>
      </tr>
    </table>
    <table width="620" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td width="51">&nbsp;</td>
        <td width="216" bgcolor="#ACD5E3"><font face="Arial,Helvetica"><font size=-1>&nbsp;Name:&nbsp;
          <input onBlur="mark(this,'#ffffff','#000000')" name="stk2_name" size="20" maxlength="30" onFocus="nextfield ='stk2_num'; mark(this,'#ffffcc','#0000FF')">
          </font></font></td>
        <td width="90" bgcolor="#ACD5E3"><font face="Arial,Helvetica"><font size=-1>&nbsp;No.:&nbsp;
          <input onBlur="mark(this,'#ffffff','#000000')" name="stk2_num" size="5" maxlength="10" onFocus="nextfield ='stock_value_two'; mark(this,'#ffffcc','#0000FF')">
          </font></font></td>
        <td width="247" bgcolor="#ACD5E3"><font face="Arial,Helvetica"><font size=-1>&nbsp;Cash
          or Market Value:&nbsp;</font></font> <font face="Arial, Helvetica, sans-serif" size="2">$</font>
          <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="stock_value_two" value="" size="10" onChange="calcasset(this.form,'stock_value_two');" onFocus="nextfield ='life_ins_face_amount_one'; mark(this,'#ffffcc','#0000FF')">
        </td>
      </tr>
    </table>
    <br>
  </center>

<center>
  </center>
<center>
    <table BORDER=0 WIDTH="620" >
      <tr>
        <td>
          <center>
            <b><font face="Arial,Helvetica"><font color="#008080"><a name="help42"></a></font><font color="#3E96B7" size="3">Life
            Insurance Information</font></font></b>
          </center>
        </td>
      </tr>
    </table>
    <br>
  </center>

<center>
    <table BORDER=0 WIDTH="620" >
      <tr>
        <td VALIGN=TOP WIDTH="51"><a href="#./Help/Help42" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help42','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help42.php','help42','scrollbars=yes,resizable=yes,width=500,height=230')" onFocus="blur();document.smartform.life_ins_face_amount_one.focus()"><img src="images/helpB.gif" name="help42" border=0 height=15 width=46></a></td>
        <td VALIGN=TOP bgcolor="#ACD5E3"><font face="Arial,Helvetica"><font size=-1>&nbsp;Life
          Insurance Face Amount (#1):</font></font> <font size="2" face="Arial, Helvetica, sans-serif">$</font>
          <input onBlur="mark(this,'#ffffff','#000000')" NAME="life_ins_face_amount_one" SIZE="10" onFocus="nextfield ='life_ins_value_one'; mark(this,'#ffffcc','#0000FF')">
        </td>
        <td VALIGN=TOP bgcolor="#ACD5E3"><font face="Arial,Helvetica"><font size=-1>&nbsp;Cash
          or Market Value:</font></font> <font size="2" face="Arial, Helvetica, sans-serif">$</font>
<input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="life_ins_value_one" value="" SIZE="10" onChange="calcasset(this.form,'life_ins_value_one');" onFocus="nextfield ='retirement_fund_value'; mark(this,'#ffffcc','#0000FF')">
        </td>
      </tr>
    </table>
    <br>
  </center>

<center><table BORDER=0 WIDTH="400" >
<tr>
<td>
          <div align=right><font face="Arial,Helvetica" color="#3E96B7" size="3"><b>SUBTOTAL
            LIQUID ASSETS = $</b></font><b><font face="Arial,Helvetica">&nbsp;</font></b></div>
</td>

<td ALIGN=CENTER BGCOLOR="#C20303"><input type="text" NAME="subtotal_liquid_assets" SIZE="12" MAXLENGTH="20" onFocus="blur();document.smartform.retirement_fund_value.focus()" onChange="this.form.field.value + form.deposit_amount.value + form.bank_amount_one.value + form.bank_amount_two.value + form.bank_amount_three.value + form.bank_amount_four.value + form.stock_value_one.value + form.stock_value_two.value + form.life_ins_value_one.value + form.life_ins_value_two.value; calcasset(this.form,'field');"></td>
</tr>
</table>
    <br>
  </center>
<center>
    <table BORDER=0 WIDTH="620" >
      <tr>
        <td>
          <center>
            <b><font face="Arial,Helvetica" color="#3E96B7"><a name="help45"></a><a name="help46"></a><a name="help47"></a>Real
            Estate, Retirement, Business, Auto &amp; Other Assets</font></b>
          </center>
        </td>
      </tr>
    </table>
    <table width="620" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td width="47">&nbsp;</td>
        <td colspan="4">
          <div align="center"><font face="Arial, Helvetica, sans-serif" size="-1"><b><font size="3">Type
            of Asset</font></b></font></div>
        </td>
        <td width="146">
          <div align="center"><font face="Arial,Helvetica" size="-1"><b>Cash or
            Market Value:</b></font> </div>
        </td>
      </tr>
      <tr>
        <td width="47">&nbsp;</td>
        <td bgcolor="#ACD5E3" colspan="4"><font face="Arial,Helvetica" size=-1>&nbsp;Market value of real estate from schedule of real estate owned:</font></td>
        <td width="146" bgcolor="#C20303">
          <div align="center"><font face="Arial, Helvetica, sans-serif" size="-1"><b><font color="#FFFFFF">$</font></b>
            </font>
            <input type="text" name="real_estate_owned_value" size="10" maxlength="20" onFocus="blur();document.smartform.retirement_fund_value.focus()" onChange="this.form.field.value + form.prop_one_market_value.value + form.prop_two_market_value.value + form.prop_three_market_value.value; calcasset(this.form,'field');">
          </div>
        </td>
      </tr>
      <tr>
        <td width="47"><a href="#./Help/Help45" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help45','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help45.php','help45','scrollbars=yes,resizable=yes,width=500,height=175')" onFocus="blur();document.smartform.retirement_fund_value.focus()"><img src="images/helpB.gif" name="help45" border=0 height=15 width=46></a></td>
        <td bgcolor="#ACD5E3" colspan="4"><font face="Arial,Helvetica" size="-1">&nbsp;Vested interest in retirement fund:&nbsp;</font></td>
        <td width="146" bgcolor="#ACD5E3">
          <div align="center"><font face="Arial, Helvetica, sans-serif" size="-1">$
            <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="retirement_fund_value" value="" size="10" onChange="calcasset(this.form,'retirement_fund_value');" onFocus="nextfield ='business_owned_value'; mark(this,'#ffffcc','#0000FF')">
            </font> </div>
        </td>
      </tr>
      <tr>
        <td width="47"><a href="#./Help/Help46" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help46','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help46.php','help46','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.business_owned_value.focus()"><img src="images/helpB.gif" name="help46" border=0 height=15 width=46></a></td>
        <td bgcolor="#ACD5E3" colspan="4"><font face="Arial,Helvetica" size="-1">&nbsp;Net worth of business(es) owned:&nbsp;</font></td>
        <td width="146" bgcolor="#ACD5E3">
          <div align="center"> <font face="Arial,Helvetica" size="-1">$
            <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="business_owned_value" value="" size="10" onChange="calcasset(this.form,'business_owned_value');" onFocus="nextfield ='auto_one_year'; mark(this,'#ffffcc','#0000FF')">
            </font> </div>
        </td>
      </tr>
      <tr>
        <td width="47"><a href="#./Help/Help47" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help47','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help47.php','help47','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.auto_one_year.focus()"><img src="images/helpB.gif" name="help47" border=0 height=15 width=46></a></td>
        <td width="57" bgcolor="#ACD5E3"><font face="Arial,Helvetica" size="-1">&nbsp;Auto
          #1:&nbsp;</font> </td>
        <td width="95" bgcolor="#ACD5E3"><font face="Arial,Helvetica"><font size=-1>Year:</font></font>
          <input onBlur="mark(this,'#ffffff','#000000')" name="auto_one_year" size="4" maxlength="4" onFocus="nextfield ='auto_one_make'; mark(this,'#ffffcc','#0000FF')">
        </td>
        <td width="130" bgcolor="#ACD5E3"><font face="Arial,Helvetica"><font size=-1>Make:
          <input onBlur="mark(this,'#ffffff','#000000')" name="auto_one_make" size="10" maxlength="10" onFocus="nextfield ='auto_one_model'; mark(this,'#ffffcc','#0000FF')">
          </font></font></td>
        <td width="131" bgcolor="#ACD5E3"><font face="Arial,Helvetica"><font size=-1>Model:
          <input onBlur="mark(this,'#ffffff','#000000')" name="auto_one_model" size="10" maxlength="10" onFocus="nextfield ='auto_one_value'; mark(this,'#ffffcc','#0000FF')">
          </font></font></td>
        <td width="146" bgcolor="#ACD5E3">
          <div align="center"><font face="Arial,Helvetica" size="-1">$
            <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="auto_one_value" value="" size="10" onChange="calcasset(this.form,'auto_one_value');" onFocus="nextfield ='auto_two_year'; mark(this,'#ffffcc','#0000FF')">
            </font></div>
        </td>
      </tr>
      <tr>
        <td width="47">&nbsp;</td>
        <td bgcolor="#ACD5E3"><font face="Arial,Helvetica"><font size=-1>&nbsp;Auto
          #2:&nbsp;</font></font> </td>
        <td bgcolor="#ACD5E3"><font face="Arial,Helvetica"><font size=-1>Year:
          <input onBlur="mark(this,'#ffffff','#000000')" name="auto_two_year" size="4" maxlength="4" onFocus="nextfield ='auto_two_make'; mark(this,'#ffffcc','#0000FF')">
          </font></font></td>
        <td bgcolor="#ACD5E3"><font face="Arial,Helvetica"><font size=-1>Make:
          <input onBlur="mark(this,'#ffffff','#000000')" name="auto_two_make" size="10" maxlength="10" onFocus="nextfield ='auto_two_model'; mark(this,'#ffffcc','#0000FF')">
          </font></font></td>
        <td bgcolor="#ACD5E3"><font face="Arial,Helvetica"><font size=-1>Model:
          <input onBlur="mark(this,'#ffffff','#000000')" name="auto_two_model" size="10" maxlength="10" onFocus="nextfield ='auto_two_value'; mark(this,'#ffffcc','#0000FF')">
          </font></font></td>
        <td width="146" bgcolor="#ACD5E3">
          <div align="center"><font face="Arial,Helvetica" size="-1">$
            <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="auto_two_value" value="" size="10" onChange="calcasset(this.form,'auto_two_value');" onFocus="nextfield ='auto_three_year'; mark(this,'#ffffcc','#0000FF')">
            </font></div>
        </td>
      </tr>
      <tr>
        <td width="47">&nbsp;</td>
        <td bgcolor="#ACD5E3"><font face="Arial,Helvetica"><font size=-1>&nbsp;Auto
          #3:</font></font> </td>
        <td bgcolor="#ACD5E3"><font face="Arial,Helvetica"><font size=-1>Year:
          <input onBlur="mark(this,'#ffffff','#000000')" name="auto_three_year" size="4" maxlength="4" onFocus="nextfield ='auto_three_make'; mark(this,'#ffffcc','#0000FF')">
          </font></font></td>
        <td bgcolor="#ACD5E3"><font face="Arial,Helvetica"><font size=-1>Make:
          <input onBlur="mark(this,'#ffffff','#000000')" name="auto_three_make" size="10" maxlength="10" onFocus="nextfield ='auto_three_model'; mark(this,'#ffffcc','#0000FF')">
          </font></font></td>
        <td bgcolor="#ACD5E3"><font face="Arial,Helvetica"><font size=-1>Model:
          <input onBlur="mark(this,'#ffffff','#000000')" name="auto_three_model" size="10" maxlength="10" onFocus="nextfield ='auto_three_value'; mark(this,'#ffffcc','#0000FF')">
          </font></font></td>
        <td width="146" bgcolor="#ACD5E3">
          <div align="center"><font face="Arial,Helvetica" size="-1">$
            <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="auto_three_value" value="" size="10" onChange="calcasset(this.form,'auto_three_value');" onFocus="nextfield ='other_assets_description_one'; mark(this,'#ffffcc','#0000FF')">
            </font></div>
        </td>
      </tr>
      <tr>
        <td width="47">&nbsp;</td>
        <td bgcolor="#ACD5E3" colspan="4">
          <div align="right"><b><font face="Arial,Helvetica"><font size=-1>TOTAL
            AUTO VALUE =&nbsp;</font></font></b> </div>
        </td>
        <td width="146" bgcolor="#C20303">
          <div align="center"><font face="Arial,Helvetica" size="-1">$</font>
            <input type="text" name="total_auto_value" size="10" maxlength="20" onFocus="blur();document.smartform.other_assets_description_one.focus()" onChange="this.form.field.value + form.auto_one_value.value + form.auto_two_value.value + form.auto_three_value.value + form.auto_four_value.value; calcasset(this.form,'field');">
          </div>
        </td>
      </tr>
      <tr>
        <td width="47"><a href="#./Help/Help48" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help48','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help48.php','help48','scrollbars=yes,resizable=yes,width=500,height=200')" onFocus="blur();document.smartform.other_assets_description_one.focus()"><img src="images/helpB.gif" name="help48" border=0 height=15 width=46></a></td>
        <td bgcolor="#ACD5E3" colspan="4"><font face="Arial, Helvetica, sans-serif" size="-1">&nbsp;Other #1: </font><font face="Arial,Helvetica"><font size=-1>Description:
          <input onBlur="mark(this,'#ffffff','#000000')" name="other_assets_description_one" size="30" maxlength="30" onFocus="nextfield ='other_assets_value_one'; mark(this,'#ffffcc','#0000FF')">
          </font></font></td>
        <td width="146" bgcolor="#ACD5E3">
          <div align="center"><font face="Arial,Helvetica" size="-1">$
            <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="other_assets_value_one" value="" size="10" onChange="calcasset(this.form,'other_assets_value_one');" onFocus="nextfield ='other_assets_description_two'; mark(this,'#ffffcc','#0000FF')">
            </font></div>
        </td>
      </tr>
      <tr>
        <td width="47">&nbsp;</td>
        <td bgcolor="#ACD5E3" colspan="4"><font face="Arial, Helvetica, sans-serif" size="-1">&nbsp;Other #2: </font><font face="Arial,Helvetica"><font size=-1>Description:
          <input onBlur="mark(this,'#ffffff','#000000')" name="other_assets_description_two" size="30" maxlength="30" onFocus="nextfield ='other_assets_value_two'; mark(this,'#ffffcc','#0000FF')">
          </font></font></td>
        <td width="146" bgcolor="#ACD5E3">
          <div align="center"><font face="Arial,Helvetica" size="-1">$
            <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="other_assets_value_two" value="" size="10" onChange="calcasset(this.form,'other_assets_value_two');" onFocus="nextfield ='other_assets_description_three'; mark(this,'#ffffcc','#0000FF')">
            </font></div>
        </td>
      </tr>
      <tr>
        <td width="47">&nbsp;</td>
        <td bgcolor="#ACD5E3" colspan="4"><font face="Arial, Helvetica, sans-serif" size="-1">&nbsp;Other #3: </font><font face="Arial,Helvetica"><font size=-1>Description:
          <input onBlur="mark(this,'#ffffff','#000000')" name="other_assets_description_three" size="30" maxlength="30" onFocus="nextfield ='other_assets_value_three'; mark(this,'#ffffcc','#0000FF')">
          </font></font></td>
        <td width="146" bgcolor="#ACD5E3">
          <div align="center"><font face="Arial,Helvetica" size="-1">$
            <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="other_assets_value_three" value="" size="10" onChange="calcasset(this.form,'other_assets_value_three');" onFocus="nextfield ='liab1_rental_prop'; mark(this,'#ffffcc','#0000FF')">
            </font></div>
        </td>
      </tr>
      <tr>
        <td width="47">&nbsp;</td>
        <td bgcolor="#ACD5E3" colspan="4">
          <div align="right"><b><font face="Arial,Helvetica" size="-1">TOTAL OF
            ALL ASSETS =&nbsp;</font></b> </div>
        </td>
        <td width="146" bgcolor="#C20303">
          <div align="center"><font face="Arial,Helvetica" size="-1">$</font>
            <input type="text" name="total_other_assets" size="10" maxlength="20" onFocus="blur();document.smartform.liab1_rental_prop.focus()" onChange="this.form.field.value + form.other_assets_value_one.value + form.other_assets_value_two.value + form.other_assets_value_three.value; calcasset(this.form,'field');">
          </div>
        </td>
      </tr>
    </table>
    <br>
  </center>
  <center>
  </center>

<center><table BORDER=0 WIDTH="400" >
<tr>
<td>
          <div align=right><b><font face="Arial,Helvetica" size="-1">TOTAL OF ALL ASSETS
            =</font><font face="Arial,Helvetica"> $</font></b></div>
</td>

<td BGCOLOR="#C20303">
<center><input type="text" NAME="total_all_assets" SIZE="10" MAXLENGTH="20" onFocus="blur();document.smartform.liab1_rental_prop.focus()" onChange="this.form.field.value + form.subtotal_liquid_assets.value + form.total_prop_market_value.value + form.retirement_fund_value.value + form.business_owned_value.value + form.total_auto_value.value + form.total_other_assets.value; calcasset(this.form,'field');"></center>
</td>
</tr>
</table>
    <br>
    <br>
  </center>

<center>
    <table BORDER=1 CELLSPACING=0 CELLPADDING=0 WIDTH="620" bordercolor="#CC0066" BGCOLOR="#FF0066" >
      <tr>
        <td>
          <center>
            <a NAME="tab12"></a><b><font face="Arial, Helvetica, sans-serif"><font color="#FFFFFF"><font size=+0>INFORMATION
            ABOUT YOUR LIABILITIES</font></font></font></b><a NAME="help49"></a>
          </center>
</td>
</tr>
</table>
    <br>
  </center>

  <table BORDER=0 WIDTH="620" align="center" >
    <tr>
        <td><font face="Arial,Helvetica"><font size=-1><b>Liabilities and Pledged
          Assets:</b> List the creditor's name, address and account number for
          all outstanding debts, including automobile loans, revolving charge
          accounts, real estate loans, alimony, child support, stock pledges,
          etc.&nbsp; Check the "<b>Paid off</b>" box indicating those liabilities
          which will be satisfied upon sale of real estate owned or upon refinancing
          of the subject property.&nbsp; <b>Do not list normal household bills
          such as electricity, water, garbage, cable, phone, etc.</b></font></font></td>
      </tr>
    </table>

  <p>
  <table width="620" border="0" cellspacing="2" cellpadding="0" align="center">
    <tr>
      <td><font face="Arial,Helvetica"><font size=-1><b>&nbsp;Name and Address
        of Company (#1):</b></font></font></td>
    </tr>
  </table>
  <table width="620" border="0" cellspacing="2" cellpadding="0" align="center">
    <tr>
      <td width="48"><a href="#./Help/Help49" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help49','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help49.php','help49','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.liab1_rental_prop.focus()"><img src="images/helpB.gif" name="help49" border=0 height=15 width=46></a>
      </td>
      <td width="566">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr bgcolor="#FCCFDB">
            <td width="159">
              <div align="right"><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;Check
                if this liability is: </font></div>
            </td>
            <td width="27">
              <input onBlur="mark(this,'#FCCFDB','#000000')" type="checkbox" name="liab1_rental_prop" value="X" onFocus="nextfield='liab1_subj_prop'; mark(this,'#ffffcc','#0000FF')">
            </td>
            <td width="122"><font size="2" face="Arial, Helvetica, sans-serif">a
              rental property, or</font></td>
            <td width="23">
              <input onBlur="mark(this,'#FCCFDB','#000000')" type="checkbox" name="liab1_subj_prop" value="X" onFocus="nextfield='liab1_type'; mark(this,'#ffffcc','#0000FF')">
            </td>
            <td width="236"><font face="Arial, Helvetica, sans-serif" size="2">the
              subject property for this application.</font></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <table width="620" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>

      <td width="50" valign="top">&nbsp; </td>
        <td width="306">
          <table width="100%" border="0" cellspacing="2" cellpadding="0">
            <tr>

            <td height="28" bgcolor="#FCCFDB">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="35%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Liability Type: </font></font></div>
                    </td>

                  <td width="65%">
                    <select name="liab1_type" onFocus="nextfield ='liab1_name';">
                      <option>Please Select</option>
                      <option value="I">Installment Loan</option>
                      <option value="O">30 Day Chg. Acct.</option>
                      <option value="R">Rev. Chg. Acct.</option>
                      <option value="C">Heloc</option>
                      <option value="M">Mortgage</option>
                      <option value="F">Lease Payments</option>
                      <option value="N">Liens</option>
                      <option value="A">Taxes</option>
                      <option value="Z">Other</option>
                    </select>
                  </td>
                  </tr>
                </table>

              </td>
            </tr>
            <tr>
              <td height="28" bgcolor="#FCCFDB">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="35%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Name:
                        </font></font></div>
                    </td>
                    <td width="65%">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="liab1_name" size="20" maxlength="40" onFocus="nextfield ='liab1_street'; mark(this,'#ffffcc','#0000FF')">
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td height="28" bgcolor="#FCCFDB">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="35%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Street:
                        </font></font></div>
                    </td>
                    <td width="65%">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="liab1_street" size="20" maxlength="30" onFocus="nextfield ='liab1_city'; mark(this,'#ffffcc','#0000FF')">
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td height="28" bgcolor="#FCCFDB">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="35%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>City,
                        State, ZIP</font></font>: </div>
                    </td>
                    <td width="65%">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="liab1_city" size="10" maxlength="20" onFocus="nextfield ='liab1_state'; mark(this,'#ffffcc','#0000FF')">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="liab1_state" size="3" maxlength="20" onFocus="nextfield ='liab1_zip'; mark(this,'#ffffcc','#0000FF')">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="liab1_zip" size="5" maxlength="10" onFocus="nextfield ='monthly_pymt_one'; mark(this,'#ffffcc','#0000FF')">
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
        <td width="118">
          <table width="100%" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="30" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>Monthly
                        Payment:</font></font></div>
                    </td>
                  </tr>
                  <tr>
                    <td height="28" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>$
                        <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="monthly_pymt_one" value="" size="10" maxlength="15" onChange="calcliability(this.form,'monthly_pymt_one');" onFocus="nextfield ='unpaid_balance_one'; mark(this,'#ffffcc','#0000FF')">
                        </font></font></div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="30" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>Unpaid
                        Balance:</font></font></div>
                    </td>
                  </tr>
                  <tr>
                    <td height="28" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>$
                        <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="unpaid_balance_one" value="" size="10" maxlength="15" onChange="calcliability(this.form,'unpaid_balance_one');" onFocus="nextfield ='liability_acct_number_one'; mark(this,'#ffffcc','#0000FF')">
                        </font></font></div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
        <td width="146">
          <table width="100%" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td colspan="2">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="30" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>Account
                        Number:</font></font></div>
                    </td>
                  </tr>
                  <tr>
                    <td height="28" bgcolor="#FCCFDB">
                      <div align="center">
                        <input onBlur="mark(this,'#ffffff','#000000')" name="liability_acct_number_one" size="16" maxlength="30" onFocus="nextfield ='months_left_to_pay_one'; mark(this,'#ffffcc','#0000FF')">
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="50%" height="30" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>Mos.
                        left:</font></font></div>
                    </td>
                  </tr>
                  <tr>
                    <td height="28" bgcolor="#FCCFDB">
                      <div align="center">
                        <input onBlur="mark(this,'#ffffff','#000000')" name="months_left_to_pay_one" size="3" onFocus="nextfield ='pay_off_one'; mark(this,'#ffffcc','#0000FF')">
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
              <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="50%" height="30" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>Paid
                        off:</font></font> </div>
                    </td>
                  </tr>
                  <tr>
                    <td height="28" bgcolor="#FCCFDB">
                      <div align="center">
                        <input onBlur="mark(this,'#FCCFDB','#000000')" type="checkbox" value="*" name="pay_off_one" onFocus="nextfield ='add_liab_record1'; mark(this,'#ffffcc','#0000FF')">
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
	<table border=0 width="620" align="center" >
  <tr>
      <td width="579" bgcolor="#FCCFDB"><b><font face="Arial,Helvetica"><font size=-1>&nbsp;If
        you would like to add another liability, click &quot;Yes&quot;:&nbsp;&nbsp;</font><font face="Arial, Helvetica, sans-serif" size="2"><b><font face="Arial,Helvetica"><font face="Arial, Helvetica, sans-serif" size="-1">Yes:
        <input onBlur="mark(this,'#FCCFDB','#000000')" type="checkbox" name="add_liab_record1" onClick="hideLiab1(); changeLiabDiv1('liab_questions1','block'); offCheckboxLiab1(); if (this.checked) document.smartform.liab2_rental_prop.focus();" onFocus="mark(this,'#ffffcc','#0000FF')">
      &nbsp;&nbsp; No:</font> <font face="Arial, Helvetica, sans-serif" size="-1">
      <input onBlur="mark(this,'#FCCFDB','#000000')" type="checkbox" name="add_liab_record1no" onClick="hideLiab1(); onCheckboxLiab1();" onFocus="nextfield='other_pymts_owed_to'; mark(this,'#ffffcc','#0000FF')">
	  </font></font></b></font></font></b></td>
  </tr>
</table>
<br>
  <div id="liab_questions1" style="margin-left:0px;display:none">
    <p>
    <table width="620" border="0" cellspacing="2" cellpadding="0" align="center">
      <tr>
        <td><font face="Arial,Helvetica"><font size=-1><b>&nbsp;Name and Address
          of Company (#2):</b></font></font></td>
      </tr>
    </table>
    <table width="620" border="0" cellspacing="2" cellpadding="0" align="center">
      <tr>
        <td>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="51">&nbsp;</td>
              <td width="159" bgcolor="#FCCFDB"><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;Check
                if this liability is for: </font></td>
              <td width="27" bgcolor="#FCCFDB">
                <input onBlur="mark(this,'#FCCFDB','#000000')" type="checkbox" name="liab2_rental_prop" value="X" onFocus="nextfield='liab2_subj_prop'; mark(this,'#ffffcc','#0000FF')">
              </td>
              <td width="122" bgcolor="#FCCFDB"><font size="2" face="Arial, Helvetica, sans-serif">a
                rental property, or</font></td>
              <td width="23" bgcolor="#FCCFDB">
                <input onBlur="mark(this,'#FCCFDB','#000000')" type="checkbox" name="liab2_subj_prop" value="X" onFocus="nextfield='liab2_type'; mark(this,'#ffffcc','#0000FF')">
              </td>
              <td width="236" bgcolor="#FCCFDB"><font face="Arial, Helvetica, sans-serif" size="2">the
                subject property for this application.</font></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <table width="620" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
        <td width="50" valign="top">&nbsp; </td>
        <td width="306">
          <table width="100%" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td height="28" bgcolor="#FCCFDB">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="35%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Liability Type: </font></font></div>
                    </td>

                  <td width="65%">
                    <select name="liab2_type" onFocus="nextfield ='liab2_name';">
                      <option>Please Select</option>
                      <option value="I">Installment Loan</option>
                      <option value="O">30 Day Chg. Acct.</option>
                      <option value="R">Rev. Chg. Acct.</option>
                      <option value="C">Heloc</option>
                      <option value="M">Mortgage</option>
                      <option value="F">Lease Payments</option>
                      <option value="N">Liens</option>
                      <option value="A">Taxes</option>
                      <option value="Z">Other</option>
                    </select>
                  </td>
                  </tr>
                </table>


              </td>
            </tr>
            <tr>
              <td height="28" bgcolor="#FCCFDB">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="35%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Name:
                        </font></font></div>
                    </td>
                    <td width="65%">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="liab2_name" size="20" maxlength="40" onFocus="nextfield ='liab2_street'; mark(this,'#ffffcc','#0000FF')">
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td height="28" bgcolor="#FCCFDB">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="35%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Street:
                        </font></font></div>
                    </td>
                    <td width="65%">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="liab2_street" size="20" maxlength="30" onFocus="nextfield ='liab2_city'; mark(this,'#ffffcc','#0000FF')">
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td height="28" bgcolor="#FCCFDB">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="35%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>City,
                        State, ZIP</font></font>: </div>
                    </td>
                    <td width="65%">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="liab2_city" size="10" maxlength="20" onFocus="nextfield ='liab2_state'; mark(this,'#ffffcc','#0000FF')">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="liab2_state" size="3" maxlength="20" onFocus="nextfield ='liab2_zip'; mark(this,'#ffffcc','#0000FF')">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="liab2_zip" size="5" maxlength="10" onFocus="nextfield ='monthly_pymt_two'; mark(this,'#ffffcc','#0000FF')">
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
        <td width="118">
          <table width="100%" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="30" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>Monthly
                        Payment:</font></font></div>
                    </td>
                  </tr>
                  <tr>
                    <td height="28" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>$
                        <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="monthly_pymt_two" value="" size="10" maxlength="15" onChange="calcliability(this.form,'monthly_pymt_two');" onFocus="nextfield ='unpaid_balance_two'; mark(this,'#ffffcc','#0000FF')">
                        </font></font></div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="30" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>Unpaid
                        Balance:</font></font></div>
                    </td>
                  </tr>
                  <tr>
                    <td height="28" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>$
                        <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="unpaid_balance_two" value="" size="10" maxlength="15" onChange="calcliability(this.form,'unpaid_balance_two');" onFocus="nextfield ='liability_acct_number_two'; mark(this,'#ffffcc','#0000FF')">
                        </font></font></div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
        <td width="146">
          <table width="100%" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td colspan="2">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="30" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>Account
                        Number:</font></font></div>
                    </td>
                  </tr>
                  <tr>
                    <td height="28" bgcolor="#FCCFDB">
                      <div align="center">
                        <input onBlur="mark(this,'#ffffff','#000000')" name="liability_acct_number_two" size="16" maxlength="30" onFocus="nextfield ='months_left_to_pay_two'; mark(this,'#ffffcc','#0000FF')">
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="50%" height="30" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>Mos.
                        left:</font></font></div>
                    </td>
                  </tr>
                  <tr>
                    <td height="28" bgcolor="#FCCFDB">
                      <div align="center">
                        <input onBlur="mark(this,'#ffffff','#000000')" name="months_left_to_pay_two" size="3" onFocus="nextfield ='pay_off_two'; mark(this,'#ffffcc','#0000FF')">
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
              <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="50%" height="30" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>Paid
                        off:</font></font> </div>
                    </td>
                  </tr>
                  <tr>
                    <td height="28" bgcolor="#FCCFDB">
                      <div align="center">
                        <input onBlur="mark(this,'#FCCFDB','#000000')" type="checkbox" value="*" name="pay_off_two" onFocus="nextfield ='add_liab_record2'; mark(this,'#ffffcc','#0000FF')">
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <table border=0 width="620" align="center" >
  <tr>
        <td width="579" bgcolor="#FCCFDB"><b><font face="Arial,Helvetica"><font size=-1>&nbsp;If
          you would like to add another liability, click &quot;Yes&quot;:&nbsp;&nbsp;</font><font face="Arial, Helvetica, sans-serif" size="2"><b><font face="Arial,Helvetica"><font face="Arial, Helvetica, sans-serif" size="-1">Yes:
          <input onBlur="mark(this,'#FCCFDB','#000000')" type="checkbox" name="add_liab_record2" onClick="hideLiab2(); changeLiabDiv2('liab_questions2','block'); offCheckboxLiab2(); if (this.checked) document.smartform.liab3_rental_prop.focus();" onFocus="mark(this,'#ffffcc','#0000FF')">
          &nbsp;&nbsp; No:</font> <font face="Arial, Helvetica, sans-serif" size="-1">
          <input onBlur="mark(this,'#FCCFDB','#000000')" type="checkbox" name="add_liab_record2no" onClick="hideLiab2(); onCheckboxLiab2();" onFocus="nextfield='other_pymts_owed_to'; mark(this,'#ffffcc','#0000FF')">
          </font></font></b></font></font></b></td>
  </tr>
</table>
  </div>
  <div id="liab_questions2" style="margin-left:0px;display:none">
    <br>
    <table width="620" border="0" cellspacing="2" cellpadding="0" align="center">
      <tr>
        <td><font face="Arial,Helvetica"><font size=-1><b>&nbsp;Name and Address
          of Company (#3):</b></font></font></td>
      </tr>
    </table>
    <table width="620" border="0" cellspacing="2" cellpadding="0" align="center">
      <tr>
        <td>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="51">&nbsp;</td>
              <td width="159" bgcolor="#FCCFDB"><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;Check
                if this liability is for: </font></td>
              <td width="27" bgcolor="#FCCFDB">
                <input onBlur="mark(this,'#FCCFDB','#000000')" type="checkbox" name="liab3_rental_prop" value="X" onFocus="nextfield='liab3_subj_prop'; mark(this,'#ffffcc','#0000FF')">
              </td>
              <td width="122" bgcolor="#FCCFDB"><font size="2" face="Arial, Helvetica, sans-serif">a
                rental property, or</font></td>
              <td width="23" bgcolor="#FCCFDB">
                <input onBlur="mark(this,'#FCCFDB','#000000')" type="checkbox" name="liab3_subj_prop" value="X" onFocus="nextfield='liab3_type'; mark(this,'#ffffcc','#0000FF')">
              </td>
              <td width="236" bgcolor="#FCCFDB"><font face="Arial, Helvetica, sans-serif" size="2">the
                subject property for this application.</font></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>


<table width="620" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
        <td width="50" valign="top">&nbsp; </td>
        <td width="306">
          <table width="100%" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td height="28" bgcolor="#FCCFDB">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="35%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Liability Type: </font></font></div>
                    </td>

                  <td width="65%">
                    <select name="liab3_type" onFocus="nextfield ='liab3_name';">
                      <option>Please Select</option>
                      <option value="I">Installment Loan</option>
                      <option value="O">30 Day Chg. Acct.</option>
                      <option value="R">Rev. Chg. Acct.</option>
                      <option value="C">Heloc</option>
                      <option value="M">Mortgage</option>
                      <option value="F">Lease Payments</option>
                      <option value="N">Liens</option>
                      <option value="A">Taxes</option>
                      <option value="Z">Other</option>
                    </select>
                  </td>
                  </tr>
                </table>



              </td>
            </tr>
            <tr>
              <td height="28" bgcolor="#FCCFDB">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="35%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Name:
                        </font></font></div>
                    </td>
                    <td width="65%">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="liab3_name" size="20" maxlength="40" onFocus="nextfield ='liab3_street'; mark(this,'#ffffcc','#0000FF')">
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td height="28" bgcolor="#FCCFDB">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="35%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Street:
                        </font></font></div>
                    </td>
                    <td width="65%">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="liab3_street" size="20" maxlength="30" onFocus="nextfield ='liab3_city'; mark(this,'#ffffcc','#0000FF')">
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td height="28" bgcolor="#FCCFDB">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="35%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>City,
                        State, ZIP</font></font>: </div>
                    </td>
                    <td width="65%">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="liab3_city" size="10" maxlength="20" onFocus="nextfield ='liab3_state'; mark(this,'#ffffcc','#0000FF')">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="liab3_state" size="3" maxlength="20" onFocus="nextfield ='liab3_zip'; mark(this,'#ffffcc','#0000FF')">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="liab3_zip" size="5" maxlength="10" onFocus="nextfield ='monthly_pymt_three'; mark(this,'#ffffcc','#0000FF')">
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
        <td width="118">
          <table width="100%" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="30" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>Monthly
                        Payment:</font></font></div>
                    </td>
                  </tr>
                  <tr>
                    <td height="28" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>$
                        <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="monthly_pymt_three" value="" size="10" maxlength="15" onChange="calcliability(this.form,'monthly_pymt_three');" onFocus="nextfield ='unpaid_balance_three'; mark(this,'#ffffcc','#0000FF')">
                        </font></font></div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="30" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>Unpaid
                        Balance:</font></font></div>
                    </td>
                  </tr>
                  <tr>
                    <td height="28" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>$
                        <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="unpaid_balance_three" value="" size="10" maxlength="15" onChange="calcliability(this.form,'unpaid_balance_three');" onFocus="nextfield ='liability_acct_number_three'; mark(this,'#ffffcc','#0000FF')">
                        </font></font></div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
        <td width="146">
          <table width="100%" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td colspan="2">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="30" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>Account
                        Number:</font></font></div>
                    </td>
                  </tr>
                  <tr>
                    <td height="28" bgcolor="#FCCFDB">
                      <div align="center">
                        <input onBlur="mark(this,'#ffffff','#000000')" name="liability_acct_number_three" size="16" maxlength="30" onFocus="nextfield ='months_left_to_pay_three'; mark(this,'#ffffcc','#0000FF')">
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="50%" height="30" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>Mos.
                        left:</font></font></div>
                    </td>
                  </tr>
                  <tr>
                    <td height="28" bgcolor="#FCCFDB">
                      <div align="center">
                        <input onBlur="mark(this,'#ffffff','#000000')" name="months_left_to_pay_three" size="3" onFocus="nextfield ='pay_off_three'; mark(this,'#ffffcc','#0000FF')">
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
              <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="50%" height="30" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>Paid
                        off:</font></font> </div>
                    </td>
                  </tr>
                  <tr>
                    <td height="28" bgcolor="#FCCFDB">
                      <div align="center">
                        <input onBlur="mark(this,'#FCCFDB','#000000')" type="checkbox" value="*" name="pay_off_three" onFocus="nextfield ='add_liab_record3'; mark(this,'#ffffcc','#0000FF')">
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <table border=0 width="620" align="center" >
  <tr>
        <td width="579" bgcolor="#FCCFDB"><b><font face="Arial,Helvetica"><font size=-1>&nbsp;If
          you would like to add another liability, click &quot;Yes&quot;:&nbsp;&nbsp;</font><font face="Arial, Helvetica, sans-serif" size="2"><b><font face="Arial,Helvetica"><font face="Arial, Helvetica, sans-serif" size="-1">Yes:
          <input onBlur="mark(this,'#FCCFDB','#000000')" type="checkbox" name="add_liab_record3" onClick="hideLiab3(); changeLiabDiv3('liab_questions3','block'); offCheckboxLiab3(); if (this.checked) document.smartform.liab4_rental_prop.focus();" onFocus="mark(this,'#ffffcc','#0000FF')">
          &nbsp;&nbsp; No:</font> <font face="Arial, Helvetica, sans-serif" size="-1">
          <input onBlur="mark(this,'#FCCFDB','#000000')" type="checkbox" name="add_liab_record3no" onClick="hideLiab3(); onCheckboxLiab3();" onFocus="nextfield='other_pymts_owed_to'; mark(this,'#ffffcc','#0000FF')">
          </font></font></b></font></font></b></td>
  </tr>
</table>
  </div>
  <div id="liab_questions3" style="margin-left:0px;display:none">
    <br>
    <table width="620" border="0" cellspacing="2" cellpadding="0" align="center">
      <tr>
        <td><font face="Arial,Helvetica"><font size=-1><b>&nbsp;Name and Address
          of Company (#4):</b></font></font></td>
      </tr>
    </table>
    <table width="620" border="0" cellspacing="2" cellpadding="0" align="center">
      <tr>
        <td>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="51">&nbsp;</td>
              <td width="159" bgcolor="#FCCFDB"><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;Check
                if this liability is for: </font></td>
              <td width="27" bgcolor="#FCCFDB">
                <input onBlur="mark(this,'#FCCFDB','#000000')" type="checkbox" name="liab4_rental_prop" value="X" onFocus="nextfield='liab4_subj_prop'; mark(this,'#ffffcc','#0000FF')">
              </td>
              <td width="122" bgcolor="#FCCFDB"><font size="2" face="Arial, Helvetica, sans-serif">a
                rental property, or</font></td>
              <td width="23" bgcolor="#FCCFDB">
                <input onBlur="mark(this,'#FCCFDB','#000000')" type="checkbox" name="liab4_subj_prop" value="X" onFocus="nextfield='liab4_type'; mark(this,'#ffffcc','#0000FF')">
              </td>
              <td width="236" bgcolor="#FCCFDB"><font face="Arial, Helvetica, sans-serif" size="2">the
                subject property for this application.</font></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>


<table width="620" border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>
        <td width="50" valign="top">&nbsp; </td>
        <td width="306">
          <table width="100%" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td height="28" bgcolor="#FCCFDB">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="35%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Liability Type: </font></font></div>
                    </td>

                  <td width="65%">
                    <select name="liab4_type" onFocus="nextfield ='liab4_name';">
                      <option>Please Select</option>
                      <option value="I">Installment Loan</option>
                      <option value="O">30 Day Chg. Acct.</option>
                      <option value="R">Rev. Chg. Acct.</option>
                      <option value="C">Heloc</option>
                      <option value="M">Mortgage</option>
                      <option value="F">Lease Payments</option>
                      <option value="N">Liens</option>
                      <option value="A">Taxes</option>
                      <option value="Z">Other</option>
                    </select>
                  </td>
                  </tr>
                </table>




              </td>
            </tr>
            <tr>
              <td height="28" bgcolor="#FCCFDB">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="35%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Name:
                        </font></font></div>
                    </td>
                    <td width="65%">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="liab4_name" size="20" maxlength="40" onFocus="nextfield ='liab4_street'; mark(this,'#ffffcc','#0000FF')">
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td height="28" bgcolor="#FCCFDB">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="35%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Street:
                        </font></font></div>
                    </td>
                    <td width="65%">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="liab4_street" size="20" maxlength="30" onFocus="nextfield ='liab4_city'; mark(this,'#ffffcc','#0000FF')">
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td height="28" bgcolor="#FCCFDB">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="35%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>City,
                        State, ZIP</font></font>: </div>
                    </td>
                    <td width="65%">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="liab4_city" size="10" maxlength="20" onFocus="nextfield ='liab4_state'; mark(this,'#ffffcc','#0000FF')">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="liab4_state" size="3" maxlength="20" onFocus="nextfield ='liab4_zip'; mark(this,'#ffffcc','#0000FF')">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="liab4_zip" size="5" maxlength="10" onFocus="nextfield ='monthly_pymt_four'; mark(this,'#ffffcc','#0000FF')">
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
        <td width="118">
          <table width="100%" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="30" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>Monthly
                        Payment:</font></font></div>
                    </td>
                  </tr>
                  <tr>
                    <td height="28" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>$
                        <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="monthly_pymt_four" value="" size="10" maxlength="15" onChange="calcliability(this.form,'monthly_pymt_four');" onFocus="nextfield ='unpaid_balance_four'; mark(this,'#ffffcc','#0000FF')">
                        </font></font></div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="30" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>Unpaid
                        Balance:</font></font></div>
                    </td>
                  </tr>
                  <tr>
                    <td height="28" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>$
                        <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="unpaid_balance_four" value="" size="10" maxlength="15" onChange="calcliability(this.form,'unpaid_balance_four');" onFocus="nextfield ='liability_acct_number_four'; mark(this,'#ffffcc','#0000FF')">
                        </font></font></div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
        <td width="146">
          <table width="100%" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td colspan="2">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="30" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>Account
                        Number:</font></font></div>
                    </td>
                  </tr>
                  <tr>
                    <td height="28" bgcolor="#FCCFDB">
                      <div align="center">
                        <input onBlur="mark(this,'#ffffff','#000000')" name="liability_acct_number_four" size="16" maxlength="30" onFocus="nextfield ='months_left_to_pay_four'; mark(this,'#ffffcc','#0000FF')">
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="50%" height="30" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>Mos.
                        left:</font></font></div>
                    </td>
                  </tr>
                  <tr>
                    <td height="28" bgcolor="#FCCFDB">
                      <div align="center">
                        <input onBlur="mark(this,'#ffffff','#000000')" name="months_left_to_pay_four" size="3" onFocus="nextfield ='pay_off_four'; mark(this,'#ffffcc','#0000FF')">
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
              <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="50%" height="30" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>Paid
                        off:</font></font> </div>
                    </td>
                  </tr>
                  <tr>
                    <td height="28" bgcolor="#FCCFDB">
                      <div align="center">
                        <input onBlur="mark(this,'#FCCFDB','#000000')" type="checkbox" value="*" name="pay_off_four" onFocus="nextfield ='add_liab_record4'; mark(this,'#ffffcc','#0000FF')">
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <table border=0 width="620" align="center" >
    <tr>
        <td width="579" bgcolor="#FCCFDB"><b><font face="Arial,Helvetica"><font size=-1>&nbsp;If
          you would like to add another liability, click &quot;Yes&quot;:&nbsp;&nbsp;</font><font face="Arial, Helvetica, sans-serif" size="2"><b><font face="Arial,Helvetica"><font face="Arial, Helvetica, sans-serif" size="-1">Yes:
          <input onBlur="mark(this,'#FCCFDB','#000000')" type="checkbox" name="add_liab_record4" onClick="hideLiab4(); changeLiabDiv4('liab_questions4','block'); offCheckboxLiab4(); if (this.checked) document.smartform.liab5_rental_prop.focus();" onFocus="mark(this,'#ffffcc','#0000FF')">
          &nbsp;&nbsp; No:</font> <font face="Arial, Helvetica, sans-serif" size="-1">
          <input onBlur="mark(this,'#FCCFDB','#000000')" type="checkbox" name="add_liab_record4no" onClick="hideLiab4(); onCheckboxLiab4();" onFocus="nextfield='other_pymts_owed_to'; mark(this,'#ffffcc','#0000FF')">
          </font></font></b></font></font></b></td>
    </tr>
  </table>
    <p>
	 </div>
  <div id="liab_questions4" style="margin-left:0px;display:none">
    <table width="620" border="0" cellspacing="2" cellpadding="0" align="center">
      <tr>
        <td><font face="Arial,Helvetica"><font size=-1><b>&nbsp;Name and Address
          of Company (#5):</b></font></font></td>
      </tr>
    </table>
    <table width="620" border="0" cellspacing="2" cellpadding="0" align="center">
      <tr>
        <td>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="51">&nbsp;</td>
              <td width="159" bgcolor="#FCCFDB"><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;Check
                if this liability is for: </font></td>
              <td width="27" bgcolor="#FCCFDB">
                <input onBlur="mark(this,'#FCCFDB','#000000')" type="checkbox" name="liab5_rental_prop" value="X" onFocus="nextfield='liab5_subj_prop'; mark(this,'#ffffcc','#0000FF')">
              </td>
              <td width="122" bgcolor="#FCCFDB"><font size="2" face="Arial, Helvetica, sans-serif">a
                rental property, or</font></td>
              <td width="23" bgcolor="#FCCFDB">
                <input onBlur="mark(this,'#FCCFDB','#000000')" type="checkbox" name="liab5_subj_prop" value="X" onFocus="nextfield='liab5_type'; mark(this,'#ffffcc','#0000FF')">
              </td>
              <td width="236" bgcolor="#FCCFDB"><font face="Arial, Helvetica, sans-serif" size="2">the
                subject property for this application.</font></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>


    <table width="620" border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>
        <td width="50" valign="top">&nbsp; </td>
        <td width="306">
          <table width="100%" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td height="28" bgcolor="#FCCFDB">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="35%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Liability Type: </font></font></div>
                    </td>

                  <td width="65%">
                    <select name="liab5_type" onFocus="nextfield ='liab5_name';">
                      <option>Please Select</option>
                      <option value="I">Installment Loan</option>
                      <option value="O">30 Day Chg. Acct.</option>
                      <option value="R">Rev. Chg. Acct.</option>
                      <option value="C">Heloc</option>
                      <option value="M">Mortgage</option>
                      <option value="F">Lease Payments</option>
                      <option value="N">Liens</option>
                      <option value="A">Taxes</option>
                      <option value="Z">Other</option>
                    </select>
                  </td>
                  </tr>
                </table>





              </td>
            </tr>
            <tr>
              <td height="28" bgcolor="#FCCFDB">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="35%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Name:
                        </font></font></div>
                    </td>
                    <td width="65%">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="liab5_name" size="20" maxlength="40" onFocus="nextfield ='liab5_street'; mark(this,'#ffffcc','#0000FF')">
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td height="28" bgcolor="#FCCFDB">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="35%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Street:
                        </font></font></div>
                    </td>
                    <td width="65%">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="liab5_street" size="20" maxlength="30" onFocus="nextfield ='liab5_city'; mark(this,'#ffffcc','#0000FF')">
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td height="28" bgcolor="#FCCFDB">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="35%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>City,
                        State, ZIP</font></font>: </div>
                    </td>
                    <td width="65%">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="liab5_city" size="10" maxlength="20" onFocus="nextfield ='liab5_state'; mark(this,'#ffffcc','#0000FF')">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="liab5_state" size="3" maxlength="20" onFocus="nextfield ='liab5_zip'; mark(this,'#ffffcc','#0000FF')">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="liab5_zip" size="5" maxlength="10" onFocus="nextfield ='monthly_pymt_five'; mark(this,'#ffffcc','#0000FF')">
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
        <td width="118">
          <table width="100%" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="30" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>Monthly
                        Payment:</font></font></div>
                    </td>
                  </tr>
                  <tr>
                    <td height="28" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>$
                        <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="monthly_pymt_five" value="" size="10" maxlength="15" onChange="calcliability(this.form,'monthly_pymt_five');" onFocus="nextfield ='unpaid_balance_five'; mark(this,'#ffffcc','#0000FF')">
                        </font></font></div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="30" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>Unpaid
                        Balance:</font></font></div>
                    </td>
                  </tr>
                  <tr>
                    <td height="28" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>$
                        <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="unpaid_balance_five" value="" size="10" maxlength="15" onChange="calcliability(this.form,'unpaid_balance_five');" onFocus="nextfield ='liability_acct_number_five'; mark(this,'#ffffcc','#0000FF')">
                        </font></font></div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
        <td width="146">
          <table width="100%" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td colspan="2">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="30" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>Account
                        Number:</font></font></div>
                    </td>
                  </tr>
                  <tr>
                    <td height="28" bgcolor="#FCCFDB">
                      <div align="center">
                        <input onBlur="mark(this,'#ffffff','#000000')" name="liability_acct_number_five" size="16" maxlength="30" onFocus="nextfield ='months_left_to_pay_five'; mark(this,'#ffffcc','#0000FF')">
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="50%" height="30" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>Mos.
                        left:</font></font></div>
                    </td>
                  </tr>
                  <tr>
                    <td height="28" bgcolor="#FCCFDB">
                      <div align="center">
                        <input onBlur="mark(this,'#ffffff','#000000')" name="months_left_to_pay_five" size="3" onFocus="nextfield ='pay_off_five'; mark(this,'#ffffcc','#0000FF')">
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
              <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="50%" height="30" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>Paid
                        off:</font></font> </div>
                    </td>
                  </tr>
                  <tr>
                    <td height="28" bgcolor="#FCCFDB">
                      <div align="center">
                        <input onBlur="mark(this,'#FCCFDB','#000000')" type="checkbox" value="*" name="pay_off_five" onFocus="nextfield ='add_liab_record5'; mark(this,'#ffffcc','#0000FF')">
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <table border=0 width="620" align="center" >
    <tr>
        <td width="579" bgcolor="#FCCFDB"><b><font face="Arial,Helvetica"><font size=-1>&nbsp;If
          you would like to add another liability, click &quot;Yes&quot;:&nbsp;&nbsp;</font><font face="Arial, Helvetica, sans-serif" size="2"><b><font face="Arial,Helvetica"><font face="Arial, Helvetica, sans-serif" size="-1">Yes:
          <input onBlur="mark(this,'#FCCFDB','#000000')" type="checkbox" name="add_liab_record5" onClick="hideLiab5(); changeLiabDiv5('liab_questions5','block'); offCheckboxLiab5(); if (this.checked) document.smartform.liab6_rental_prop.focus();" onFocus="mark(this,'#ffffcc','#0000FF')">
          &nbsp;&nbsp; No:</font> <font face="Arial, Helvetica, sans-serif" size="-1">
          <input onBlur="mark(this,'#FCCFDB','#000000')" type="checkbox" name="add_liab_record5no" onClick="hideLiab5(); onCheckboxLiab5();" onFocus="nextfield='other_pymts_owed_to'; mark(this,'#ffffcc','#0000FF')">
          </font></font></b></font></font></b></td>
    </tr>
  </table>
    <p>
	</div>
  <div id="liab_questions5" style="margin-left:0px;display:none">
    <table width="620" border="0" cellspacing="2" cellpadding="0" align="center">
      <tr>
        <td><font face="Arial,Helvetica"><font size=-1><b>&nbsp;Name and Address
          of Company (#6):</b></font></font></td>
      </tr>
    </table>
    <table width="620" border="0" cellspacing="2" cellpadding="0" align="center">
      <tr>
        <td>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="51">&nbsp;</td>
              <td width="159" bgcolor="#FCCFDB"><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;Check
                if this liability is for: </font></td>
              <td width="27" bgcolor="#FCCFDB">
                <input onBlur="mark(this,'#FCCFDB','#000000')" type="checkbox" name="liab6_rental_prop" value="X" onFocus="nextfield='liab6_subj_prop'; mark(this,'#ffffcc','#0000FF')">
              </td>
              <td width="122" bgcolor="#FCCFDB"><font size="2" face="Arial, Helvetica, sans-serif">a
                rental property, or</font></td>
              <td width="23" bgcolor="#FCCFDB">
                <input onBlur="mark(this,'#FCCFDB','#000000')" type="checkbox" name="liab6_subj_prop" value="X" onFocus="nextfield='liab6_type'; mark(this,'#ffffcc','#0000FF')">
              </td>
              <td width="236" bgcolor="#FCCFDB"><font face="Arial, Helvetica, sans-serif" size="2">the
                subject property for this application.</font></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>


<table width="620" border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>
        <td width="50" valign="top">&nbsp; </td>
        <td width="306">
          <table width="100%" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td height="28" bgcolor="#FCCFDB">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="35%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Liability Type: </font></font></div>
                    </td>

                  <td width="65%">
                    <select name="liab6_type" onFocus="nextfield ='liab6_name';">
                      <option>Please Select</option>
                      <option value="I">Installment Loan</option>
                      <option value="O">30 Day Chg. Acct.</option>
                      <option value="R">Rev. Chg. Acct.</option>
                      <option value="C">Heloc</option>
                      <option value="M">Mortgage</option>
                      <option value="F">Lease Payments</option>
                      <option value="N">Liens</option>
                      <option value="A">Taxes</option>
                      <option value="Z">Other</option>
                    </select>
                  </td>
                  </tr>
                </table>






              </td>
            </tr>
            <tr>
              <td height="28" bgcolor="#FCCFDB">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="35%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Name:
                        </font></font></div>
                    </td>
                    <td width="65%">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="liab6_name" size="20" maxlength="40" onFocus="nextfield ='liab6_street'; mark(this,'#ffffcc','#0000FF')">
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td height="28" bgcolor="#FCCFDB">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="35%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Street:
                        </font></font></div>
                    </td>
                    <td width="65%">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="liab6_street" size="20" maxlength="30" onFocus="nextfield ='liab6_city'; mark(this,'#ffffcc','#0000FF')">
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td height="28" bgcolor="#FCCFDB">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="35%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>City,
                        State, ZIP</font></font>: </div>
                    </td>
                    <td width="65%">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="liab6_city" size="10" maxlength="20" onFocus="nextfield ='liab6_state'; mark(this,'#ffffcc','#0000FF')">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="liab6_state" size="3" maxlength="20" onFocus="nextfield ='liab6_zip'; mark(this,'#ffffcc','#0000FF')">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="liab6_zip" size="5" maxlength="10" onFocus="nextfield ='monthly_pymt_six'; mark(this,'#ffffcc','#0000FF')">
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
        <td width="118">
          <table width="100%" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="30" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>Monthly
                        Payment:</font></font></div>
                    </td>
                  </tr>
                  <tr>
                    <td height="28" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>$
                        <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="monthly_pymt_six" value="" size="10" maxlength="15" onChange="calcliability(this.form,'monthly_pymt_six');" onFocus="nextfield ='unpaid_balance_six'; mark(this,'#ffffcc','#0000FF')">
                        </font></font></div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="30" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>Unpaid
                        Balance:</font></font></div>
                    </td>
                  </tr>
                  <tr>
                    <td height="28" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>$
                        <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="unpaid_balance_six" value="" size="10" maxlength="15" onChange="calcliability(this.form,'unpaid_balance_six');" onFocus="nextfield ='liability_acct_number_six'; mark(this,'#ffffcc','#0000FF')">
                        </font></font></div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
        <td width="146">
          <table width="100%" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td colspan="2">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="30" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>Account
                        Number:</font></font></div>
                    </td>
                  </tr>
                  <tr>
                    <td height="28" bgcolor="#FCCFDB">
                      <div align="center">
                        <input onBlur="mark(this,'#ffffff','#000000')" name="liability_acct_number_six" size="16" maxlength="30" onFocus="nextfield ='months_left_to_pay_six'; mark(this,'#ffffcc','#0000FF')">
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="50%" height="30" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>Mos.
                        left:</font></font></div>
                    </td>
                  </tr>
                  <tr>
                    <td height="28" bgcolor="#FCCFDB">
                      <div align="center">
                        <input onBlur="mark(this,'#ffffff','#000000')" name="months_left_to_pay_six" size="3" onFocus="nextfield ='pay_off_six'; mark(this,'#ffffcc','#0000FF')">
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
              <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="50%" height="30" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>Paid
                        off:</font></font> </div>
                    </td>
                  </tr>
                  <tr>
                    <td height="28" bgcolor="#FCCFDB">
                      <div align="center">
                        <input onBlur="mark(this,'#FCCFDB','#000000')" type="checkbox" value="*" name="pay_off_six" onFocus="nextfield ='add_liab_record6'; mark(this,'#ffffcc','#0000FF')">
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <table border=0 width="620" align="center" >
    <tr>
        <td width="579" bgcolor="#FCCFDB"><b><font face="Arial,Helvetica"><font size=-1>&nbsp;If
          you would like to add another liability, click &quot;Yes&quot;:&nbsp;&nbsp;</font><font face="Arial, Helvetica, sans-serif" size="2"><b><font face="Arial,Helvetica"><font face="Arial, Helvetica, sans-serif" size="-1">Yes:
          <input onBlur="mark(this,'#FCCFDB','#000000')" type="checkbox" name="add_liab_record6" onClick="hideLiab6(); changeLiabDiv6('liab_questions6','block'); offCheckboxLiab6(); if (this.checked) document.smartform.liab7_rental_prop.focus();" onFocus="mark(this,'#ffffcc','#0000FF')">
          &nbsp;&nbsp; No:</font> <font face="Arial, Helvetica, sans-serif" size="-1">
          <input onBlur="mark(this,'#FCCFDB','#000000')" type="checkbox" name="add_liab_record6no" onClick="hideLiab6(); onCheckboxLiab6();" onFocus="nextfield='other_pymts_owed_to'; mark(this,'#ffffcc','#0000FF')">
          </font></font></b></font></font></b></td>
    </tr>
  </table>
    <p>
	 </div>
  <div id="liab_questions6" style="margin-left:0px;display:none">
    <table width="620" border="0" cellspacing="2" cellpadding="0" align="center">
      <tr>
        <td><font face="Arial,Helvetica"><font size=-1><b>&nbsp;Name and Address
          of Company (#7):</b></font></font></td>
      </tr>
    </table>
    <table width="620" border="0" cellspacing="2" cellpadding="0" align="center">
      <tr>
        <td>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="51">&nbsp;</td>
              <td width="159" bgcolor="#FCCFDB"><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;Check
                if this liability is for: </font></td>
              <td width="27" bgcolor="#FCCFDB">
                <input onBlur="mark(this,'#FCCFDB','#000000')" type="checkbox" name="liab7_rental_prop" value="X" onFocus="nextfield='liab7_subj_prop'; mark(this,'#ffffcc','#0000FF')">
              </td>
              <td width="122" bgcolor="#FCCFDB"><font size="2" face="Arial, Helvetica, sans-serif">a
                rental property, or</font></td>
              <td width="23" bgcolor="#FCCFDB">
                <input onBlur="mark(this,'#FCCFDB','#000000')" type="checkbox" name="liab7_subj_prop" value="X" onFocus="nextfield='liab7_type'; mark(this,'#ffffcc','#0000FF')">
              </td>
              <td width="236" bgcolor="#FCCFDB"><font face="Arial, Helvetica, sans-serif" size="2">the
                subject property for this application.</font></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>


<table width="620" border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>
        <td width="50" valign="top">&nbsp; </td>
        <td width="306">
          <table width="100%" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td height="28" bgcolor="#FCCFDB">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="35%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Liability Type: </font></font></div>
                    </td>

                  <td width="65%">
                    <select name="liab7_type" onFocus="nextfield ='liab7_name';">
                      <option>Please Select</option>
                      <option value="I">Installment Loan</option>
                      <option value="O">30 Day Chg. Acct.</option>
                      <option value="R">Rev. Chg. Acct.</option>
                      <option value="C">Heloc</option>
                      <option value="M">Mortgage</option>
                      <option value="F">Lease Payments</option>
                      <option value="N">Liens</option>
                      <option value="A">Taxes</option>
                      <option value="Z">Other</option>
                    </select>
                  </td>
                  </tr>
                </table>







              </td>
            </tr>
            <tr>
              <td height="28" bgcolor="#FCCFDB">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="35%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Name:
                        </font></font></div>
                    </td>
                    <td width="65%">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="liab7_name" size="20" maxlength="40" onFocus="nextfield ='liab7_street'; mark(this,'#ffffcc','#0000FF')">
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td height="28" bgcolor="#FCCFDB">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="35%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>Street:
                        </font></font></div>
                    </td>
                    <td width="65%">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="liab7_street" size="20" maxlength="30" onFocus="nextfield ='liab7_city'; mark(this,'#ffffcc','#0000FF')">
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td height="28" bgcolor="#FCCFDB">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="35%">
                      <div align="right"><font face="Arial,Helvetica"><font size=-1>City,
                        State, ZIP</font></font>: </div>
                    </td>
                    <td width="65%">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="liab7_city" size="10" maxlength="20" onFocus="nextfield ='liab7_state'; mark(this,'#ffffcc','#0000FF')">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="liab7_state" size="3" maxlength="20" onFocus="nextfield ='liab7_zip'; mark(this,'#ffffcc','#0000FF')">
                      <input onBlur="mark(this,'#ffffff','#000000')" name="liab7_zip" size="5" maxlength="10" onFocus="nextfield ='monthly_pymt_seven'; mark(this,'#ffffcc','#0000FF')">
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
        <td width="118">
          <table width="100%" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="30" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>Monthly
                        Payment:</font></font></div>
                    </td>
                  </tr>
                  <tr>
                    <td height="28" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>$
                        <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="monthly_pymt_seven" value="" size="10" maxlength="15" onChange="calcliability(this.form,'monthly_pymt_seven');" onFocus="nextfield ='unpaid_balance_seven'; mark(this,'#ffffcc','#0000FF')">
                        </font></font></div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="30" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>Unpaid
                        Balance:</font></font></div>
                    </td>
                  </tr>
                  <tr>
                    <td height="28" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>$
                        <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="unpaid_balance_seven" value="" size="10" maxlength="15" onChange="calcliability(this.form,'unpaid_balance_seven');" onFocus="nextfield ='liability_acct_number_seven'; mark(this,'#ffffcc','#0000FF')">
                        </font></font></div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
        <td width="146">
          <table width="100%" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td colspan="2">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="30" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>Account
                        Number:</font></font></div>
                    </td>
                  </tr>
                  <tr>
                    <td height="28" bgcolor="#FCCFDB">
                      <div align="center">
                        <input onBlur="mark(this,'#ffffff','#000000')" name="liability_acct_number_seven" size="16" maxlength="30" onFocus="nextfield ='months_left_to_pay_seven'; mark(this,'#ffffcc','#0000FF')">
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="50%" height="30" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>Mos.
                        left:</font></font></div>
                    </td>
                  </tr>
                  <tr>
                    <td height="28" bgcolor="#FCCFDB">
                      <div align="center">
                        <input onBlur="mark(this,'#ffffff','#000000')" name="months_left_to_pay_seven" size="3" onFocus="nextfield ='pay_off_seven'; mark(this,'#ffffcc','#0000FF')">
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
              <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="50%" height="30" bgcolor="#FCCFDB">
                      <div align="center"><font face="Arial,Helvetica"><font size=-1>Paid
                        off:</font></font> </div>
                    </td>
                  </tr>
                  <tr>
                    <td height="28" bgcolor="#FCCFDB">
                      <div align="center">
                        <input onBlur="mark(this,'#FCCFDB','#000000')" type="checkbox" value="*" name="pay_off_seven" onFocus="nextfield ='other_pymts_owed_to'; mark(this,'#ffffcc','#0000FF')">
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
	</div>
    <br>

  <table width="620" border="0" cellspacing="2" cellpadding="0" align="center">
    <tr>
        <td><a name="help50"></a><a name="help51"></a><b><font face="Arial,Helvetica"><font size=-1>&nbsp;Alimony/Child
          Support/Separate Maintenance&nbsp;</font></font></b> </td>
      </tr>
    </table>

  <table width="620" border="0" cellspacing="2" cellpadding="0" align="center">
    <tr>
        <td width="51"><a href="#./Help/Help50" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help50','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help50.php','help50','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.other_pymts_owed_to.focus()"><img src="images/helpB.gif" name="help50" border=0 height=15 width=46></a></td>
        <td width="333" bgcolor="#FCCFDB">
          <p align="center"><font face="Arial,Helvetica"><font size=-1>Payments
            owed to:<br>
            </font></font>
            <input onBlur="mark(this,'#ffffff','#000000')" name="other_pymts_owed_to" size="40" maxlength="40" onFocus="nextfield ='other_monthly_pymt'; mark(this,'#ffffcc','#0000FF')">
          </p>
          </td>
        <td width="228" bgcolor="#FCCFDB">
          <p align="center"><font face="Arial,Helvetica"><font size=-1>Monthly
            Payment:<br>
            </font></font><font face="Arial,Helvetica"><font size=-1>$</font></font>
            <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="other_monthly_pymt" value="" size="10" onChange="calcliability(this.form,'other_monthly_pymt');" onFocus="nextfield ='job_related_expense'; mark(this,'#ffffcc','#0000FF')">
          </p>
          </td>
      </tr>
    </table>
    <br>

  <table width="620" border="0" cellspacing="2" cellpadding="0" align="center">
    <tr>
        <td><b><font face="Arial,Helvetica"><font size=-1>&nbsp;Job Related Expense</font></font></b></td>
      </tr>
    </table>

  <table width="620" border="0" cellspacing="2" cellpadding="0" align="center">
    <tr>
        <td width="51"><a href="#./Help/Help51" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help51','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help51.php','help51','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.job_related_expense.focus()"><img src="images/helpB.gif" name="help51" border=0 height=15 width=46></a></td>
        <td width="333" bgcolor="#FCCFDB">
          <p align="center"><font face="Arial,Helvetica"><font size="-1">Child
            Care, Union Dues, etc.<br>
            </font></font>
            <input onBlur="mark(this,'#ffffff','#000000')" name="job_related_expense" size="40" maxlength="40" onFocus="nextfield ='job_related_monthly_pymt'; mark(this,'#ffffcc','#0000FF')">
          </p>
          </td>
        <td width="228" bgcolor="#FCCFDB">
          <p align="center"><font face="Arial,Helvetica"><font size=-1>Monthly
            Payment:<br>
            </font></font><font face="Arial,Helvetica"><font size=-1>$
            <input onBlur="mark(this,'#ffffff','#000000')" type="text" name="job_related_monthly_pymt" value="" size="10" onChange="calcliability(this.form,'job_related_monthly_pymt');" onFocus="nextfield ='alt_personal_name_one'; mark(this,'#ffffcc','#0000FF')">
            </font></font></p>
          </td>
      </tr>
    </table>
    <br>

  <table width="500" border="0" cellspacing="2" cellpadding="0" align="center">
    <tr>
        <td width="204">
          <div align="center"><font face="Arial, Helvetica, sans-serif" size="-1"><b>TOTAL
            MONTHLY PAYMENTS</b></font></div>
        </td>
        <td width="141">
          <div align="center"><font face="Arial,Helvetica" size="-1"><b>TOTAL
            LIABILITIES</b></font><font face="Arial,Helvetica"></font></div>
        </td>
        <td width="147">
          <div align="center"><font face="Arial,Helvetica" size="-1"><b>TOTAL
            NET WORTH</b></font></div>
        </td>
      </tr>
      <tr>
        <td width="204" bgcolor="#CC0000">
          <div align="center"><font face="Arial, Helvetica, sans-serif" size="-1" color="#FFFFFF"><b>$</b></font><font face="Arial, Helvetica, sans-serif" size="-1">
            <input type="text" name="liabilities_total_monthly_pymts" size="10" maxlength="20" onFocus="blur();document.smartform.alt_personal_name_one.focus()" onChange="this.form.field.value + form.monthly_pymt_one.value + form.monthly_pymt_two.value + form.monthly_pymt_three.value + form.monthly_pymt_four.value + form.monthly_pymt_five.value + form.monthly_pymt_six.value + form.monthly_pymt_seven.value + form.other_monthly_pymt.value + form.job_related_monthly_pymt.value ; calcliability(this.form,'field');">
            </font></div>
        </td>
        <td width="141" bgcolor="#CC0000">
          <div align="center"><font face="Arial, Helvetica, sans-serif" size="-1" color="#FFFFFF"><b>$</b></font><font face="Arial, Helvetica, sans-serif" size="-1">
            <input type="text" name="total_liabilities" size="10" maxlength="20" onFocus="blur();document.smartform.alt_personal_name_one.focus()" onChange="this.form.field.value + form.unpaid_balance_one.value + form.unpaid_balance_two.value + form.unpaid_balance_three.value + form.unpaid_balance_four.value + form.unpaid_balance_five.value + form.unpaid_balance_six.value + form.unpaid_balance_seven.value ; calcliability(this.form,'field');">
            </font></div>
        </td>
        <td width="147" bgcolor="#CC0000">
          <div align="center"><font face="Arial, Helvetica, sans-serif" size="-1" color="#FFFFFF"><b>$</b></font><font face="Arial, Helvetica, sans-serif" size="-1">
            <input type="text" name="total_net_worth" size="10" maxlength="20" onFocus="blur();document.smartform.alt_personal_name_one.focus()" onChange="this.form.field.value + form.total_all_assets.value - form.total_liabilities.value; calcliability(this.form,'field');">
            </font></div>
        </td>
      </tr>
    </table>
    <br>

  <table width="620" border="0" cellspacing="2" cellpadding="0" align="center">
    <tr>
        <td><b><font face="Arial,Helvetica"><font size=-1><a name="help52"></a>List
          any additional names under which credit has previously been received
          and indicate appropriate creditor name(s) and account number(s) below.</font></font></b></td>
      </tr>
    </table>

  <table border=0 cellspacing=2 cellpadding=0 width="620" align="center" >
    <tr>
        <td width="51"><a href="#./Help/Help52" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help52','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help52.php','help52','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.alt_personal_name_one.focus()"><img src="images/helpB.gif" name="help52" border=0 height=15 width=46></a></td>
        <td bgcolor="#FCCFDB">
          <div align="center"><font face="Arial,Helvetica"><font size=-1>Alternate
            Name (#1):</font></font><br>
            <input onBlur="mark(this,'#ffffff','#000000')" name="alt_personal_name_one" size="20" maxlength="45" onFocus="nextfield ='alt_creditor_name_one'; mark(this,'#ffffcc','#0000FF')">
          </div>
        </td>
        <td bgcolor="#FCCFDB">
          <div align="center"><font face="Arial,Helvetica"><font size=-1>Creditor:</font></font><br>
            <input onBlur="mark(this,'#ffffff','#000000')" name="alt_creditor_name_one" size="20" maxlength="45" onFocus="nextfield ='alt_acct_number_one'; mark(this,'#ffffcc','#0000FF')">
          </div>
        </td>
        <td bgcolor="#FCCFDB">
          <div align="center"><font face="Arial,Helvetica"><font size=-1>Account
            Number:</font></font><br>
            <input onBlur="mark(this,'#ffffff','#000000')" name="alt_acct_number_one" size="16" maxlength="30" onFocus="nextfield ='alt_personal_name_two'; mark(this,'#ffffcc','#0000FF')">
          </div>
        </td>
      </tr>
      <tr>
        <td width="51">&nbsp;</td>
        <td bgcolor="#FCCFDB">
          <div align="center"><font face="Arial,Helvetica"><font size=-1>Alternate
            Name (#2):</font></font><br>
            <input onBlur="mark(this,'#ffffff','#000000')" name="alt_personal_name_two" size="20" maxlength="45" onFocus="nextfield ='alt_creditor_name_two'; mark(this,'#ffffcc','#0000FF')">
          </div>
        </td>
        <td bgcolor="#FCCFDB">
          <div align="center"><font face="Arial,Helvetica"><font size=-1>Creditor:</font></font><br>
            <input onBlur="mark(this,'#ffffff','#000000')" name="alt_creditor_name_two" size="20" maxlength="45" onFocus="nextfield ='alt_acct_number_two'; mark(this,'#ffffcc','#0000FF')">
          </div>
        </td>
        <td bgcolor="#FCCFDB">
          <div align="center"><font face="Arial,Helvetica"><font size=-1>Account
            Number:</font></font><br>
            <input onBlur="mark(this,'#ffffff','#000000')" name="alt_acct_number_two" size="16" maxlength="30" onFocus="nextfield ='details_purchase_price'; mark(this,'#ffffcc','#0000FF')">
          </div>
        </td>
      </tr>
    </table>

  <br>
  <br>
  <center>
    <table BORDER=1 CELLSPACING=0 CELLPADDING=0 WIDTH="620" BGCOLOR="#007EBB" bordercolor="#00557D" >
      <tr>
<td>
<center><a NAME="tab13"></a><b><font face="Arial, Helvetica, sans-serif"><font color="#FFFFFF"><font size=+0>DETAILS
OF TRANSACTION</font></font></font></b><a NAME="help53"></a><a NAME="help54"></a></center>
</td>
</tr>
</table>
    <br>
  </center>

<center>
    <table BORDER=0 COLS=1 WIDTH="620" >
      <tr>
        <td><a NAME="help55"></a><font face="Arial,Helvetica"><font size=-1><b>The
          following section is designed to be completed with the help of your
          loan officer.</b>&nbsp; Not all of the fields will apply to your situation.
          If you are unsure what to enter in the fields in this section, leave
          this&nbsp;<a NAME="help56"></a>section blank.&nbsp; When your loan officer
          meets with you or sends you a printed copy of this application for your
          signature(s), the necessary fields will be filled in.</font></font>
          <p><a NAME="help57"></a><font face="Arial,Helvetica"><font size=-1>Most
            of the information below will be on your "Good Faith Estimate" that
            your loan officer will send you within three days of your submission
            of this application.</font></font>
        </td>
      </tr>
    </table>
    <br>
  </center>

<center>
    <table BORDER=0 WIDTH="620" >
      <tr>
        <td width="51"><a href="#./Help/Help53" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help53','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help53.php','help53','scrollbars=yes,resizable=yes,width=500,height=240')" onFocus="blur();document.smartform.details_purchase_price.focus()"><img src="images/helpB.gif" name="help53" border=0 height=15 width=46></a></td>
        <td bgcolor="#C1E3FF">
          <div align="center"><a NAME="help58"></a><font face="Arial,Helvetica"><font size=-1>a.</font></font></div>
        </td>
        <td bgcolor="#C1E3FF"><font face="Arial,Helvetica"><font size=-1>Purchase
          price:&nbsp;</font></font></td>
        <td bgcolor="#C1E3FF">
          <center>
            <font face="Arial,Helvetica"><font size=-1>$&nbsp;</font></font>
            <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="details_purchase_price" value="" SIZE="10" onChange="calcloan(this.form,'details_purchase_price');" onFocus="nextfield ='details_improvements_value'; mark(this,'#ffffcc','#0000FF')">
          </center>
        </td>
      </tr>
      <tr>
        <td><a href="#./Help/Help54" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help54','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help54.php','help54','scrollbars=yes,resizable=yes,width=500,height=185')" onFocus="blur();document.smartform.details_improvements_value.focus()"><img src="images/helpB.gif" name="help54" border=0 height=15 width=46></a></td>
        <td bgcolor="#C1E3FF">
          <div align="center"><a NAME="help59"></a><font face="Arial,Helvetica"><font size=-1>b&nbsp;</font></font></div>
        </td>
        <td bgcolor="#C1E3FF"><font face="Arial,Helvetica"><font size=-1>Alterations,
          improvements, repairs:&nbsp;</font></font></td>
        <td bgcolor="#C1E3FF">
          <center>
            <font face="Arial,Helvetica"><font size=-1>$&nbsp;</font></font>
            <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="details_improvements_value" value="" SIZE="10" onChange="calcloan(this.form,'details_improvements_value');" onFocus="nextfield ='details_land_only_value'; mark(this,'#ffffcc','#0000FF')">
          </center>
        </td>
      </tr>
      <tr>
        <td><a href="#./Help/Help55" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help55','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help55.php','help55','scrollbars=yes,resizable=yes,width=500,height=240')" onFocus="blur();document.smartform.details_land_only_value.focus()"><img src="images/helpB.gif" name="help55" border=0 height=15 width=46></a></td>
        <td bgcolor="#C1E3FF">
          <div align="center"><a NAME="help60"></a><font face="Arial,Helvetica"><font size=-1>c.</font></font></div>
        </td>
        <td bgcolor="#C1E3FF"><font face="Arial,Helvetica"><font size=-1>Land
          (if acquired separately):&nbsp;</font></font></td>
        <td bgcolor="#C1E3FF">
          <center>
            <font face="Arial,Helvetica"><font size=-1>$&nbsp;</font></font>
            <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="details_land_only_value" value="" SIZE="10" onChange="calcloan(this.form,'details_land_only_value');" onFocus="nextfield ='details_refinance_amount'; mark(this,'#ffffcc','#0000FF')">
          </center>
        </td>
      </tr>
      <tr>
        <td><a href="#./Help/Help56" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help56','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help56.php','help56','scrollbars=yes,resizable=yes,width=500,height=255')" onFocus="blur();document.smartform.details_refinance_amount.focus()"><img src="images/helpB.gif" name="help56" border=0 height=15 width=46></a></td>
        <td bgcolor="#C1E3FF">
          <div align="center"><a NAME="help61"></a><font face="Arial,Helvetica"><font size=-1>d.</font></font></div>
        </td>
        <td bgcolor="#C1E3FF"><font face="Arial,Helvetica"><font size=-1>Refinance
          (include debts to be paid off):</font></font></td>
        <td bgcolor="#C1E3FF">
          <center>
            <font face="Arial,Helvetica"><font size=-1>$&nbsp;</font></font>
            <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="details_refinance_amount" value="" SIZE="10" onChange="calcloan(this.form,'details_refinance_amount');" onFocus="nextfield ='details_estimated_prepaids'; mark(this,'#ffffcc','#0000FF')">
          </center>
        </td>
      </tr>
      <tr>
        <td><a href="#./Help/Help57" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help57','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help57.php','help57','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.details_estimated_prepaids.focus()"><img src="images/helpB.gif" name="help57" border=0 height=15 width=46></a></td>
        <td bgcolor="#C1E3FF">
          <div align="center"><a NAME="help62"></a><font face="Arial,Helvetica"><font size=-1>e.</font></font></div>
        </td>
        <td bgcolor="#C1E3FF"><font face="Arial,Helvetica"><font size=-1>Estimated
          prepaid items:</font></font></td>
        <td bgcolor="#C1E3FF">
          <center>
            <font face="Arial,Helvetica"><font size=-1>$&nbsp;</font></font>
            <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="details_estimated_prepaids" value="" SIZE="10" onChange="calcloan(this.form,'details_estimated_prepaids');" onFocus="nextfield ='details_estimated_closing_costs'; mark(this,'#ffffcc','#0000FF')">
          </center>
        </td>
      </tr>
      <tr>
        <td><a href="#./Help/Help58" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help58','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help58.php','help58','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.details_estimated_closing_costs.focus()"><img src="images/helpB.gif" name="help58" border=0 height=15 width=46></a></td>
        <td bgcolor="#C1E3FF">
          <div align="center"><a NAME="help63"></a><font face="Arial,Helvetica"><font size=-1>f.</font></font></div>
        </td>
        <td bgcolor="#C1E3FF"><font face="Arial,Helvetica"><font size=-1>Estimated
          closing costs:&nbsp;</font></font></td>
        <td bgcolor="#C1E3FF">
          <center>
            <font face="Arial,Helvetica"><font size=-1>$&nbsp;</font></font>
            <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="details_estimated_closing_costs" value="" SIZE="10" onChange="calcloan(this.form,'details_estimated_closing_costs');" onFocus="nextfield ='details_pmi_mip_funding_fee'; mark(this,'#ffffcc','#0000FF')">
          </center>
        </td>
      </tr>
      <tr>
        <td><a href="#./Help/Help59" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help59','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help59.php','help59','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.details_pmi_mip_funding_fee.focus()"><img src="images/helpB.gif" name="help59" border=0 height=15 width=46></a></td>
        <td bgcolor="#C1E3FF">
          <div align="center"><a NAME="help64"></a><font face="Arial,Helvetica"><font size=-1>g.</font></font></div>
        </td>
        <td bgcolor="#C1E3FF"><font face="Arial,Helvetica"><font size=-1>PMI,
          MIP, Funding Fee:&nbsp;</font></font></td>
        <td bgcolor="#C1E3FF">
          <center>
            <font face="Arial,Helvetica"><font size=-1>$&nbsp;</font></font>
            <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="details_pmi_mip_funding_fee" value="" SIZE="10" onChange="calcloan(this.form,'details_pmi_mip_funding_fee');" onFocus="nextfield ='details_discount_price'; mark(this,'#ffffcc','#0000FF')">
          </center>
        </td>
      </tr>
      <tr>
        <td><a href="#./Help/Help60" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help60','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help60.php','help60','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.details_discount_price.focus()"><img src="images/helpB.gif" name="help60" border=0 height=15 width=46></a></td>
        <td bgcolor="#C1E3FF">
          <div align="center"><a NAME="help65"></a><font face="Arial,Helvetica"><font size=-1>h.</font></font></div>
        </td>
        <td bgcolor="#C1E3FF"><font face="Arial,Helvetica"><font size=-1>Discount
          (if Borrower will pay):&nbsp;</font></font></td>
        <td bgcolor="#C1E3FF">
          <center>
            <font face="Arial,Helvetica"><font size=-1>$&nbsp;</font></font>
            <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="details_discount_price" value="" SIZE="10" onChange="calcloan(this.form,'details_discount_price');" onFocus="nextfield ='details_subordinate_financing_amount'; mark(this,'#ffffcc','#0000FF')">
          </center>
        </td>
      </tr>
      <tr>
        <td><a href="#./Help/Help61" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help61','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help61.php','help61','scrollbars=yes,resizable=yes,width=500,height=140')" onFocus="blur();document.smartform.details_subordinate_financing_amount.focus()"><img src="images/helpB.gif" name="help61" border=0 height=15 width=46></a></td>
        <td bgcolor="#C1E3FF">
          <div align="center"><a NAME="help66"></a><b><font face="Arial,Helvetica"><font size=-1>i.</font></font></b></div>
        </td>
        <td bgcolor="#C1E3FF"><b><font face="Arial,Helvetica"><font size=-1>Total
          costs (automatic total for items a through h above):&nbsp;</font></font></b></td>
        <td BGCOLOR="#C20303">
          <center>
            <b><font face="Arial,Helvetica"><font color="#FFFFFF"><font size=-1>$</font></font></font></b>
            <input type="text" NAME="details_total_costs" SIZE="10" MAXLENGTH="20" onFocus="blur();document.smartform.details_subordinate_financing_amount.focus()" onChange="this.form.field.value + form.details_purchase_price.value + form.details_improvements_value.value + form.details_land_only_value.value + form.details_refinance_amount.value + form.details_estimated_prepaids.value + form.details_estimated_closing_costs.value + form.details_pmi_mip_funding_fee.value + form.details_discount_price.value; calcloan(this.form,'field');">
          </center>
        </td>
      </tr>
      <tr>
        <td><a href="#./Help/Help62" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help62','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help62.php','help62','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.details_subordinate_financing_amount.focus()"><img src="images/helpB.gif" name="help62" border=0 height=15 width=46></a></td>
        <td bgcolor="#C1E3FF">
          <div align="center"><a NAME="help67"></a><font face="Arial,Helvetica"><font size=-1>j.</font></font></div>
        </td>
        <td bgcolor="#C1E3FF"><font face="Arial,Helvetica"><font size=-1>Subordinate
          financing:&nbsp;</font></font></td>
        <td bgcolor="#C1E3FF">
          <center>
            <font face="Arial,Helvetica"><font size=-1>$&nbsp;</font></font>
            <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="details_subordinate_financing_amount" value="" SIZE="10" onChange="calcloan(this.form,'details_subordinate_financing_amount');" onFocus="nextfield ='details_seller_paid_closing_costs'; mark(this,'#ffffcc','#0000FF')">
          </center>
        </td>
      </tr>
      <tr>
        <td><a href="#./Help/Help63" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help63','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help63.php','help63','scrollbars=yes,resizable=yes,width=500,height=210')" onFocus="blur();document.smartform.details_seller_paid_closing_costs.focus()"><img src="images/helpB.gif" name="help63" border=0 height=15 width=46></a></td>
        <td bgcolor="#C1E3FF">
          <div align="center"><a NAME="help68"></a><font face="Arial,Helvetica"><font size=-1>k.</font></font></div>
        </td>
        <td bgcolor="#C1E3FF"><font face="Arial,Helvetica"><font size=-1>Borrower's
          closing costs paid by Seller:</font></font></td>
        <td bgcolor="#C1E3FF">
          <center>
            <font face="Arial,Helvetica"><font size=-1>$&nbsp;</font></font>
            <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="details_seller_paid_closing_costs" value="" SIZE="10" onChange="calcloan(this.form,'details_seller_paid_closing_costs');" onFocus="nextfield ='details_other_costs_explain'; mark(this,'#ffffcc','#0000FF')">
          </center>
        </td>
      </tr>
      <tr>
        <td VALIGN=TOP><a href="#./Help/Help64" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help64','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help64.php','help64','scrollbars=yes,resizable=yes,width=500,height=220')" onFocus="blur();document.smartform.details_other_costs_explain.focus()"><img src="images/helpB.gif" name="help64" border=0 height=15 width=46></a></td>
        <td VALIGN=TOP bgcolor="#C1E3FF">
          <div align="center"><font face="Arial,Helvetica"><font size=-1>l.</font></font></div>
        </td>
        <td VALIGN=TOP bgcolor="#C1E3FF">
          <center>
            <table BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH="100%" >
              <tr>
                <td><font face="Arial,Helvetica"><font size=-1>Other Credits (explain
                  below):</font></font></td>
                <td>
                  <div align=right><font face="Arial,Helvetica"><font size=-1>(enter
                    amount)</font></font></div>
                </td>
              </tr>
            </table>
          </center>
          <font size="1" face="arial, helvetica, sans-serif"> ( You may enter
          up to <b><font color="#C20303">60</font></b> characters. )<br>
<textarea onBlur="mark(this,'#ffffff','#000000')" NAME=details_other_costs_explain ROWS="3" COLS="30" WRAP="PHYSICAL" onKeyDown="textCounter(this.form.details_other_costs_explain,this.form.counter_details,60);" onKeyUp="textCounter(this.form.details_other_costs_explain,this.form.counter_details,60);" onFocus="nextfield ='details_other_costs'; mark(this,'#ffffcc','#0000FF')"></textarea>
<input readonly type=text name=counter_details size=3 maxlength=3 value="60" onFocus="blur();document.smartform.details_other_costs.focus()"> characters remaining</font><br>

        </td>
        <td VALIGN=TOP bgcolor="#C1E3FF">
          <center>
            <font face="Arial,Helvetica"><font size=-1>$&nbsp;</font></font>
            <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="details_other_costs" value="" SIZE="10" onChange="calcloan(this.form,'details_other_costs');" onFocus="nextfield ='details_loan_amount_no_mi'; mark(this,'#ffffcc','#0000FF')">
          </center>
        </td>
      </tr>
      <tr>
        <td><a href="#./Help/Help65" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help65','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help65.php','help65','scrollbars=yes,resizable=yes,width=500,height=220')" onFocus="blur();document.smartform.details_loan_amount_no_mi.focus()"><img src="images/helpB.gif" name="help65" border=0 height=15 width=46></a></td>
        <td bgcolor="#C1E3FF">
          <div align="center"><font face="Arial,Helvetica"><font size=-1>m.</font></font></div>
        </td>
        <td bgcolor="#C1E3FF"><font face="Arial,Helvetica"><font size=-1>Loan
          amount (exclude PMI, MIP, Funding Fee financed):</font></font></td>
        <td bgcolor="#C1E3FF">
          <center>
            <font face="Arial,Helvetica"><font size=-1>$&nbsp;</font></font>
            <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="details_loan_amount_no_mi" value="" SIZE="10" onChange="calcloan(this.form,'details_loan_amount_no_mi');" onFocus="nextfield ='details_pmi_mip_funding_fee_financed'; mark(this,'#ffffcc','#0000FF')">
          </center>
        </td>
      </tr>
      <tr>
        <td><a href="#./Help/Help66" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help66','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help66.php','help66','scrollbars=yes,resizable=yes,width=500,height=170')" onFocus="blur();document.smartform.details_pmi_mip_funding_fee_financed.focus()"><img src="images/helpB.gif" name="help66" border=0 height=15 width=46></a></td>
        <td bgcolor="#C1E3FF">
          <div align="center"><font face="Arial,Helvetica"><font size=-1>n.</font></font></div>
        </td>
        <td bgcolor="#C1E3FF"><font face="Arial,Helvetica"><font size=-1>PMI,
          MIP, Funding Fee financed:&nbsp;</font></font></td>
        <td bgcolor="#C1E3FF">
          <center>
            <font face="Arial,Helvetica"><font size=-1>$&nbsp;</font></font>
            <input onBlur="mark(this,'#ffffff','#000000')" type="text" NAME="details_pmi_mip_funding_fee_financed" value="" SIZE="10" onChange="calcloan(this.form,'details_pmi_mip_funding_fee_financed');" onFocus="nextfield ='ba_yes'; mark(this,'#ffffcc','#0000FF')">
          </center>
        </td>
      </tr>
      <tr>
        <td><a href="#./Help/Help67" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help67','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help67.php','help67','scrollbars=yes,resizable=yes,width=500,height=230')" onFocus="blur();document.smartform.ba_yes.focus()"><img src="images/helpB.gif" name="help67" border=0 height=15 width=46></a></td>
        <td bgcolor="#C1E3FF">
          <div align="center"><font face="Arial,Helvetica"><font size=-1>o.</font></font></div>
        </td>
        <td bgcolor="#C1E3FF"><font face="Arial,Helvetica"><font size=-1>Loan
          amount (automatic totals for items <b>m</b> + <b>n</b> above):&nbsp;</font></font></td>
        <td BGCOLOR="#C20303">
          <center>
            <b><font face="Arial,Helvetica"><font color="#FFFFFF"><font size=-1>$&nbsp;</font></font></font></b>
            <input type="text" NAME="details_loan_amount_m_plus_n" SIZE="10" MAXLENGTH="20" onFocus="blur();document.smartform.ba_yes.focus()" onChange="this.form.field.value + form.details_loan_amount_no_mi.value + form.details_pmi_mip_funding_fee_financed.value; calcloan(this.form,'field');">
          </center>
        </td>
      </tr>
      <tr>
        <td><a href="#./Help/Help68" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help68','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help68.php','help68','scrollbars=yes,resizable=yes,width=500,height=250')" onFocus="blur();document.smartform.ba_yes.focus()"><img src="images/helpB.gif" name="help68" border=0 height=15 width=46></a></td>
        <td bgcolor="#C1E3FF">
          <div align="center"><b><font face="Arial,Helvetica"><font size=-1>p.</font></font></b></div>
        </td>
        <td bgcolor="#C1E3FF"><font face="Arial,Helvetica"><font size=-1><b>Cash
          from/to Borrower </b>(automatic totals: <b>j</b>,<b>k</b>,<b>l </b>&amp;
          <b>o</b> minus<b> i </b>above):&nbsp;</font></font></td>
        <td BGCOLOR="#C20303">
          <center>
            <b><font face="Arial,Helvetica"><font color="#FFFFFF"><font size=-1>$&nbsp;</font></font></font></b>
            <input type="text" NAME="details_cash_from_to_borrower" SIZE="10" MAXLENGTH="20" onFocus="blur();document.smartform.ba_yes.focus()" onChange="this.form.field.value + form.details_subordinate_financing_amount.value + form.details_seller_paid_closing_costs.value + form.details_other_costs.value + form.details_loan_amount_m_plus_n.value - form.details_total_costs.value; calcloan(this.form,'field');">
          </center>
        </td>
      </tr>
    </table>
    <br>
    <br>
  </center>

<center>
    <table BORDER=1 CELLSPACING=0 CELLPADDING=0 WIDTH="620" BGCOLOR="#4EC297" bordercolor="#308968" >
      <tr>
<td>
<center><a NAME="tab14"></a><b><font face="Arial, Helvetica, sans-serif"><font color="#FFFFFF"><font size=+0>DECLARATIONS</font></font></font></b></center>
</td>
</tr>
</table>
    <br>
  </center>

<center>
    <table BORDER=0 WIDTH="620" >
      <tr>
        <td VALIGN=TOP width="51"><a href="#./Help/Help69" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help69','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help69.php','help69','scrollbars=yes,resizable=yes,width=500,height=250')" onFocus="blur();document.smartform.ba_yes.focus()"><img src="images/helpB.gif" name="help69" border=0 height=15 width=46></a></td>
        <td VALIGN=TOP width="556"><a NAME="help69"></a><b><font face="Arial,Helvetica"><font size=-1>Answer
          the questions below to the best of your knowledge for the Borrower and
          Co-Borrower (if any).</font></font></b></td>
      </tr>
    </table>
    <br>
  </center>

<center>
    <table BORDER=0 WIDTH="620" >
      <tr>
        <td width="15"><font face="Arial,Helvetica"><font size=-1>&nbsp;</font></font></td>
        <td width="408"></td>
        <td width="92">
          <center>
            <b><font face="Arial,Helvetica"><font size=-1>Borrower</font></font></b>
          </center>
        </td>
        <td width="87">
          <center>
            <b><font face="Arial,Helvetica"><font size=-1>Co-Borrower</font></font></b>
          </center>
        </td>
      </tr>
      <tr>
        <td VALIGN=TOP width="15" bgcolor="#C5EBDD">
          <div align="center"><font face="Arial,Helvetica"><font size=-1>a.</font></font></div>
        </td>
        <td VALIGN=TOP width="408" bgcolor="#C5EBDD"><font face="Arial,Helvetica"><font size=-1>Are
          there any outstanding judgments against you?</font></font></td>
        <td VALIGN=TOP width="100" bgcolor="#E1F4ED">
          <center>
            <table BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH="100%" >
              <tr>
                <td><font face="Arial,Helvetica" size=-1>Yes</font></td>
                <td><input onBlur="mark(this,'#E1F4ED','#000000')" type="checkbox" value="X" name="ba_yes" onClick="offCheckboxBA();" onFocus="nextfield ='ba_no'; mark(this,'#ffffcc','#0000FF')"></td>
                <td><font face="Arial, Helvetica" size="-1">No</font></td>
                <td><input onBlur="mark(this,'#E1F4ED','#000000')" type="checkbox" value="X" name="ba_no" onClick="onCheckboxBA();" onFocus="nextfield ='cba_yes'; mark(this,'#ffffcc','#0000FF')"></td>
              </tr>
            </table>
          </center>
        </td>
        <td VALIGN=TOP width="100" bgcolor="#C5EBDD">
          <center>
            <table BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH="100%" >
              <tr>
                <td><font face="Arial,Helvetica" size=-1>Yes</font></td>
                <td><input onBlur="mark(this,'#C5EBDD','#000000')" type="checkbox" value="X" name="cba_yes" onClick="offCheckboxCBA();" onFocus="nextfield ='cba_no'; mark(this,'#ffffcc','#0000FF')"></td>
				<td><font face="Arial,Helvetica" size=-1>No</font></td>
                <td><input onBlur="mark(this,'#C5EBDD','#000000')" type="checkbox" value="X" name="cba_no" onClick="onCheckboxCBA();" onFocus="nextfield ='bb_yes'; mark(this,'#ffffcc','#0000FF')"></td>
              </tr>
            </table>
          </center>
        </td>
      </tr>
      <tr>
        <td VALIGN=TOP width="15" bgcolor="#C5EBDD">
          <div align="center"><font face="Arial,Helvetica" size=-1>b.</font></div>
        </td>
        <td VALIGN=TOP width="408" bgcolor="#C5EBDD"><font face="Arial,Helvetica"><font size=-1>Have
          you been bankrupt within the last 7 years?&nbsp;</font></font></td>
        <td VALIGN=TOP width="100" bgcolor="#E1F4ED">
          <center>
            <table BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH="100%" >
              <tr>
                <td><font face="Arial,Helvetica" size=-1>Yes</font></td>
                <td><input onBlur="mark(this,'#E1F4ED','#000000')" type="checkbox" value="X" name="bb_yes" onClick="offCheckboxBB();" onFocus="nextfield ='bb_no'; mark(this,'#ffffcc','#0000FF')"></td>
                <td><font face="Arial,Helvetica" size=-1>No</font></td>
                <td><input onBlur="mark(this,'#E1F4ED','#000000')" type="checkbox" value="X" name="bb_no" onClick="onCheckboxBB();" onFocus="nextfield ='cbb_yes'; mark(this,'#ffffcc','#0000FF')"></td>
              </tr>
            </table>
          </center>
        </td>
        <td VALIGN=TOP width="100" bgcolor="#C5EBDD">
          <center>
            <table BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH="100%" >
              <tr>
                <td><font face="Arial,Helvetica" size=-1>Yes</font></td>
                <td><input onBlur="mark(this,'#C5EBDD','#000000')" type="checkbox" value="X" name="cbb_yes" onClick="offCheckboxCBB();" onFocus="nextfield ='cbb_no'; mark(this,'#ffffcc','#0000FF')"></td>
                <td><font face="Arial,Helvetica" size=-1>No</font></td>
                <td><input onBlur="mark(this,'#C5EBDD','#000000')" type="checkbox" value="X" name="cbb_no" onClick="onCheckboxCBB();" onFocus="nextfield ='bc_yes'; mark(this,'#ffffcc','#0000FF')"></td>
              </tr>
            </table>
          </center>
        </td>
      </tr>
      <tr>
        <td VALIGN=TOP width="15" bgcolor="#C5EBDD">
          <div align="center"><font face="Arial,Helvetica" size=-1>c.</font></div>
        </td>
        <td VALIGN=TOP width="408" bgcolor="#C5EBDD"><font face="Arial,Helvetica" size=-1>Have
          you had property foreclosed upon or given title or deed in lieu thereof
          in the last 7 years?&nbsp;</font></td>
        <td VALIGN=TOP width="100" bgcolor="#E1F4ED">
          <center>
            <table BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH="100%" >
              <tr>
                <td><font face="Arial,Helvetica" size=-1>Yes</font></td>
                <td><input onBlur="mark(this,'#E1F4ED','#000000')" type="checkbox" value="X" name="bc_yes" onClick="offCheckboxBC();" onFocus="nextfield ='bc_no'; mark(this,'#ffffcc','#0000FF')"></td>
                <td><font face="Arial,Helvetica" size=-1>No</font></td>
                <td><input onBlur="mark(this,'#E1F4ED','#000000')" type="checkbox" value="X" name="bc_no" onClick="onCheckboxBC();" onFocus="nextfield ='cbc_yes'; mark(this,'#ffffcc','#0000FF')"></td>
              </tr>
            </table>
          </center>
        </td>
        <td VALIGN=TOP width="100" bgcolor="#C5EBDD">
          <center>
            <table BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH="100%" >
              <tr>
                <td><font face="Arial,Helvetica" size=-1>Yes</font></td>
                <td><input onBlur="mark(this,'#C5EBDD','#000000')" type="checkbox" value="X" name="cbc_yes" onClick="offCheckboxCBC();" onFocus="nextfield ='cbc_no'; mark(this,'#ffffcc','#0000FF')"></td>
                <td><font face="Arial,Helvetica" size=-1>No</font></td>
                <td><input onBlur="mark(this,'#C5EBDD','#000000')" type="checkbox" value="X" name="cbc_no" onClick="onCheckboxCBC();" onFocus="nextfield ='bd_yes'; mark(this,'#ffffcc','#0000FF')"></td>
              </tr>
            </table>
          </center>
        </td>
      </tr>
      <tr>
        <td VALIGN=TOP width="15" bgcolor="#C5EBDD">
          <div align="center"><font face="Arial,Helvetica" size=-1>d.</font></div>
        </td>
        <td VALIGN=TOP width="408" bgcolor="#C5EBDD"><font face="Arial,Helvetica" size=-1>Are
          you a party to a lawsuit?</font></td>
        <td VALIGN=TOP width="100" bgcolor="#E1F4ED">
          <center>
            <table BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH="100%" >
              <tr>
                <td><font face="Arial,Helvetica" size=-1>Yes</font></td>
                <td><input onBlur="mark(this,'#E1F4ED','#000000')" type="checkbox" value="X" name="bd_yes" onClick="offCheckboxBD();" onFocus="nextfield ='bd_no'; mark(this,'#ffffcc','#0000FF')"></td>
                <td><font face="Arial,Helvetica" size=-1>No</font></td>
                <td><input onBlur="mark(this,'#E1F4ED','#000000')" type="checkbox" value="X" name="bd_no" onClick="onCheckboxBD();" onFocus="nextfield ='cbd_yes'; mark(this,'#ffffcc','#0000FF')"></td>
              </tr>
            </table>
          </center>
        </td>
        <td VALIGN=TOP width="100" bgcolor="#C5EBDD">
          <center>
            <table BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH="100%" >
              <tr>
                <td><font face="Arial,Helvetica" size=-1>Yes</font></td>
                <td><input onBlur="mark(this,'#C5EBDD','#000000')" type="checkbox" value="X" name="cbd_yes" onClick="offCheckboxCBD();" onFocus="nextfield ='cbd_no'; mark(this,'#ffffcc','#0000FF')"></td>
                <td><font face="Arial,Helvetica" size=-1>No</font></td>
                <td><input onBlur="mark(this,'#C5EBDD','#000000')" type="checkbox" value="X" name="cbd_no" onClick="onCheckboxCBD();" onFocus="nextfield ='be_yes'; mark(this,'#ffffcc','#0000FF')"></td>
              </tr>
            </table>
          </center>
        </td>
      </tr>
      <tr>
        <td VALIGN=TOP width="15" bgcolor="#C5EBDD">
          <div align="center"><font face="Arial,Helvetica" size=-1>e.</font></div>
        </td>
        <td width="408" bgcolor="#C5EBDD"><font face="Arial,Helvetica" size=-1>Have
          you directly or indirectly been obligated on a loan which resulted in
          foreclosure, transfer of title in lieu of foreclosure, or judgment?&nbsp;</font></td>
        <td VALIGN=TOP width="100" bgcolor="#E1F4ED">
          <center>
            <table BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH="100%" >
              <tr>
                <td><font face="Arial,Helvetica" size=-1>Yes</font></td>
                <td><input onBlur="mark(this,'#E1F4ED','#000000')" type="checkbox" value="X" name="be_yes" onClick="offCheckboxBE();" onFocus="nextfield ='be_no'; mark(this,'#ffffcc','#0000FF')"></td>
                <td><font face="Arial,Helvetica" size=-1>No</font></td>
                <td><input onBlur="mark(this,'#E1F4ED','#000000')" type="checkbox" value="X" name="be_no" onClick="onCheckboxBE();" onFocus="nextfield ='cbe_yes'; mark(this,'#ffffcc','#0000FF')"></td>
              </tr>
            </table>
          </center>
        </td>
        <td VALIGN=TOP width="100" bgcolor="#C5EBDD">
          <center>
            <table BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH="100%" >
              <tr>
                <td><font face="Arial,Helvetica" size=-1>Yes</font></td>
                <td><input onBlur="mark(this,'#C5EBDD','#000000')" type="checkbox" value="X" name="cbe_yes" onClick="offCheckboxCBE();" onFocus="nextfield ='cbe_no'; mark(this,'#ffffcc','#0000FF')"></td>
                <td><font face="Arial,Helvetica" size=-1>No</font></td>
                <td><input onBlur="mark(this,'#C5EBDD','#000000')" type="checkbox" value="X" name="cbe_no" onClick="onCheckboxCBE();" onFocus="nextfield ='bf_yes'; mark(this,'#ffffcc','#0000FF')"></td>
              </tr>
            </table>
          </center>
        </td>
      </tr>
      <tr>
        <td VALIGN=TOP width="15" bgcolor="#C5EBDD">
          <div align="center"><font face="Arial,Helvetica" size=-1>f.</font></div>
        </td>
        <td VALIGN=TOP width="408" bgcolor="#C5EBDD"><font face="Arial,Helvetica" size=-1>Are
          you presently delinquent or in default on any Federal debt or any other
          loan, mortgage, financial obligation, bond or loan guarantee?</font></td>
        <td VALIGN=TOP width="100" bgcolor="#E1F4ED">
          <center>
            <table BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH="100%" >
              <tr>
                <td><font face="Arial,Helvetica" size=-1>Yes</font></td>
                <td><input onBlur="mark(this,'#E1F4ED','#000000')" type="checkbox" value="X" name="bf_yes" onClick="offCheckboxBF();" onFocus="nextfield ='bf_no'; mark(this,'#ffffcc','#0000FF')"></td>
                <td><font face="Arial,Helvetica" size=-1>No</font></td>
                <td><input onBlur="mark(this,'#E1F4ED','#000000')" type="checkbox" value="X" name="bf_no" onClick="onCheckboxBF();" onFocus="nextfield ='cbf_yes'; mark(this,'#ffffcc','#0000FF')"></td>
              </tr>
            </table>
          </center>
        </td>
        <td VALIGN=TOP width="100" bgcolor="#C5EBDD">
          <center>
            <table BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH="100%" >
              <tr>
                <td><font face="Arial,Helvetica" size=-1>Yes</font></td>
                <td><input onBlur="mark(this,'#C5EBDD','#000000')" type="checkbox" value="X" name="cbf_yes" onClick="offCheckboxCBF();" onFocus="nextfield ='cbf_no'; mark(this,'#ffffcc','#0000FF')"></td>
                <td><font face="Arial,Helvetica" size=-1>No</font></td>
                <td><input onBlur="mark(this,'#C5EBDD','#000000')" type="checkbox" value="X" name="cbf_no" onClick="onCheckboxCBF();" onFocus="nextfield ='bg_yes'; mark(this,'#ffffcc','#0000FF')"></td>
              </tr>
            </table>
          </center>
        </td>
      </tr>
      <tr>
        <td VALIGN=TOP width="15" bgcolor="#C5EBDD">
          <div align="center"><font face="Arial,Helvetica" size=-1>g.</font></div>
        </td>
        <td VALIGN=TOP width="408" bgcolor="#C5EBDD"><font face="Arial,Helvetica" size=-1>Are
          you obligated to pay alimony, child support or separate maintenance?&nbsp;</font></td>
        <td VALIGN=TOP width="100" bgcolor="#E1F4ED">
          <center>
            <table BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH="100%" >
              <tr>
                <td><font face="Arial,Helvetica" size=-1>Yes</font></td>
                <td><input onBlur="mark(this,'#E1F4ED','#000000')" type="checkbox" value="X" name="bg_yes" onClick="offCheckboxBG();" onFocus="nextfield ='bg_no'; mark(this,'#ffffcc','#0000FF')"></td>
                <td><font face="Arial,Helvetica" size=-1>No</font></td>
                <td><input onBlur="mark(this,'#E1F4ED','#000000')" type="checkbox" value="X" name="bg_no" onClick="onCheckboxBG();" onFocus="nextfield ='cbg_yes'; mark(this,'#ffffcc','#0000FF')"></td>
              </tr>
            </table>
          </center>
        </td>
        <td VALIGN=TOP width="100" bgcolor="#C5EBDD">
          <center>
            <table BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH="100%" >
              <tr>
                <td><font face="Arial,Helvetica" size=-1>Yes</font></td>
                <td><input onBlur="mark(this,'#C5EBDD','#000000')" type="checkbox" value="X" name="cbg_yes" onClick="offCheckboxCBG();" onFocus="nextfield ='cbg_no'; mark(this,'#ffffcc','#0000FF')"></td>
                <td><font face="Arial,Helvetica" size=-1>No</font></td>
                <td><input onBlur="mark(this,'#C5EBDD','#000000')" type="checkbox" value="X" name="cbg_no" onClick="onCheckboxCBG();" onFocus="nextfield ='bh_yes'; mark(this,'#ffffcc','#0000FF')"></td>
              </tr>
            </table>
          </center>
        </td>
      </tr>
      <tr>
        <td VALIGN=TOP width="15" bgcolor="#C5EBDD">
          <div align="center"><font face="Arial,Helvetica" size=-1>h.</font></div>
        </td>
        <td VALIGN=TOP width="408" bgcolor="#C5EBDD"><font face="Arial,Helvetica" size=-1>Is
          any part of the down payment borrowed?&nbsp;</font></td>
        <td VALIGN=TOP width="100" bgcolor="#E1F4ED">
          <center>
            <table BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH="100%">
              <tr>
                <td><font face="Arial,Helvetica" size=-1>Yes</font></td>
                <td><input onBlur="mark(this,'#E1F4ED','#000000')" type="checkbox" value="X" name="bh_yes" onClick="offCheckboxBH();" onFocus="nextfield ='bh_no'; mark(this,'#ffffcc','#0000FF')"></td>
                <td><font face="Arial,Helvetica" size=-1>No</font></td>
                <td><input onBlur="mark(this,'#E1F4ED','#000000')" type="checkbox" value="X" NAME="bh_no" onClick="onCheckboxBH();" onFocus="nextfield ='cbh_yes'; mark(this,'#ffffcc','#0000FF')"></td>
              </tr>
            </table>
          </center>
        </td>
        <td VALIGN=TOP width="100" bgcolor="#C5EBDD">
          <center>
            <table BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH="100%" >
              <tr>
                <td><font face="Arial,Helvetica" size=-1>Yes</font></td>
                <td><input onBlur="mark(this,'#C5EBDD','#000000')" type="checkbox" value="X" NAME="cbh_yes" onClick="offCheckboxCBH();" onFocus="nextfield ='cbh_no'; mark(this,'#ffffcc','#0000FF')"></td>
                <td><font face="Arial,Helvetica" size=-1>No</font></td>
                <td><input onBlur="mark(this,'#C5EBDD','#000000')" type="checkbox" value="X" NAME="cbh_no" onClick="onCheckboxCBH();" onFocus="nextfield ='bi_yes'; mark(this,'#ffffcc','#0000FF')"></td>
              </tr>
            </table>
          </center>
        </td>
      </tr>
      <tr>
        <td VALIGN=TOP width="15" bgcolor="#C5EBDD">
          <div align="center"><font face="Arial,Helvetica" size=-1>i.</font></div>
        </td>
        <td VALIGN=TOP width="408" bgcolor="#C5EBDD"><font face="Arial,Helvetica" size=-1>Are
          you a co-maker or endorser on a note?</font></td>
        <td VALIGN=TOP width="100" bgcolor="#E1F4ED">
          <center>
            <table BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH="100%" >
              <tr>
                <td><font face="Arial,Helvetica" size=-1>Yes</font></td>
                <td><input onBlur="mark(this,'#E1F4ED','#000000')" type="checkbox" value="X" NAME="bi_yes" onClick="offCheckboxBI();" onFocus="nextfield ='bi_no'; mark(this,'#ffffcc','#0000FF')"></td>
                <td><font face="Arial,Helvetica" size=-1>No</font></td>
                <td><input onBlur="mark(this,'#E1F4ED','#000000')" type="checkbox" value="X" NAME="bi_no" onClick="onCheckboxBI();" onFocus="nextfield ='cbi_yes'; mark(this,'#ffffcc','#0000FF')"></td>
              </tr>
            </table>
          </center>
        </td>
        <td VALIGN=TOP width="100" bgcolor="#C5EBDD">
          <center>
            <table BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH="100%" >
              <tr>
                <td><font face="Arial,Helvetica" size=-1>Yes</font></td>
                <td><input onBlur="mark(this,'#C5EBDD','#000000')" type="checkbox" value="X" NAME="cbi_yes" onClick="offCheckboxCBI();" onFocus="nextfield ='cbi_no'; mark(this,'#ffffcc','#0000FF')"></td>
                <td><font face="Arial,Helvetica" size=-1>No</font></td>
                <td><input onBlur="mark(this,'#C5EBDD','#000000')" type="checkbox" value="X" NAME="cbi_no" onClick="onCheckboxCBI();" onFocus="nextfield ='bj_yes'; mark(this,'#ffffcc','#0000FF')"></td>
              </tr>
            </table>
          </center>
        </td>
      </tr>
      <tr>
        <td width="15" bgcolor="#C5EBDD">
          <div align="center"><b><font face="Arial,Helvetica" size=-1 color="#C20303">---</font></b></div>
        </td>
        <td width="408" bgcolor="#C5EBDD"><b><font face="Arial,Helvetica" size=-1 color="#C20303">---------------------------------------------------------------</font></b></td>
        <td width="100" bgcolor="#E1F4ED"></td>
        <td width="100" bgcolor="#C5EBDD"></td>
      </tr>
      <tr>
        <td VALIGN=TOP width="15" bgcolor="#C5EBDD">
          <div align="center"><font face="Arial,Helvetica" size=-1>j.</font></div>
        </td>
        <td VALIGN=TOP width="408" bgcolor="#C5EBDD"><font face="Arial,Helvetica" size=-1>Are
          you a U.S. citizen?</font></td>
        <td VALIGN=TOP width="100" bgcolor="#E1F4ED">
          <center>
            <table BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH="100%" >
              <tr>
                <td><font face="Arial,Helvetica" size=-1>Yes</font></td>
                <td><input onBlur="mark(this,'#E1F4ED','#000000')" type="checkbox" value="X" NAME="bj_yes" onClick="offCheckboxBJ();" onFocus="nextfield ='bj_no'; mark(this,'#ffffcc','#0000FF')"></td>
                <td><font face="Arial,Helvetica" size=-1>No</font></td>
                <td><input onBlur="mark(this,'#E1F4ED','#000000')" type="checkbox" value="X" NAME="bj_no" onClick="onCheckboxBJ();" onFocus="nextfield ='cbj_yes'; mark(this,'#ffffcc','#0000FF')"></td>
              </tr>
            </table>
          </center>
        </td>
        <td VALIGN=TOP width="100" bgcolor="#C5EBDD">
          <center>
            <table BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH="100%" >
              <tr>
                <td><font face="Arial,Helvetica" size=-1>Yes</font></td>
                <td><input onBlur="mark(this,'#C5EBDD','#000000')" type="checkbox" value="X" NAME="cbj_yes" onClick="offCheckboxCBJ();" onFocus="nextfield ='cbj_no'; mark(this,'#ffffcc','#0000FF')"></td>
                <td><font face="Arial,Helvetica" size=-1>No</font></td>
                <td><input onBlur="mark(this,'#C5EBDD','#000000')" type="checkbox" value="X" NAME="cbj_no" onClick="onCheckboxCBJ();" onFocus="nextfield ='bk_yes'; mark(this,'#ffffcc','#0000FF')"></td>
              </tr>
            </table>
          </center>
        </td>
      </tr>
      <tr>
        <td VALIGN=TOP width="15" bgcolor="#C5EBDD">
          <div align="center"><font face="Arial,Helvetica" size=-1>k.</font></div>
        </td>
        <td VALIGN=TOP width="408" bgcolor="#C5EBDD"><font face="Arial,Helvetica" size=-1>Are
          you a permanent resident alien?</font></td>
        <td VALIGN=TOP width="100" bgcolor="#E1F4ED">
          <center>
            <table BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH="100%" >
              <tr>
                <td><font face="Arial,Helvetica" size=-1>Yes</font></td>
                <td><input onBlur="mark(this,'#E1F4ED','#000000')" type="checkbox" value="X" NAME="bk_yes" onClick="offCheckboxBK();" onFocus="nextfield ='bk_no'; mark(this,'#ffffcc','#0000FF')"></td>
                <td><font face="Arial,Helvetica" size=-1>No</font></td>
                <td><input onBlur="mark(this,'#E1F4ED','#000000')" type="checkbox" value="X" NAME="bk_no" onClick="onCheckboxBK();" onFocus="nextfield ='cbk_yes'; mark(this,'#ffffcc','#0000FF')"></td>
              </tr>
            </table>
          </center>
        </td>
        <td VALIGN=TOP width="100" bgcolor="#C5EBDD">
          <center>
            <table BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH="100%" >
              <tr>
                <td><font face="Arial,Helvetica" size=-1>Yes</font></td>
                <td><input onBlur="mark(this,'#C5EBDD','#000000')" type="checkbox" value="X" NAME="cbk_yes" onClick="offCheckboxCBK();" onFocus="nextfield ='cbk_no'; mark(this,'#ffffcc','#0000FF')"></td>
                <td><font face="Arial,Helvetica" size=-1>No</font></td>
                <td><input onBlur="mark(this,'#C5EBDD','#000000')" type="checkbox" value="X" NAME="cbk_no" onClick="onCheckboxCBK();" onFocus="nextfield ='bl_yes'; mark(this,'#ffffcc','#0000FF')"></td>
              </tr>
            </table>
          </center>
        </td>
      </tr>
      <tr>
        <td VALIGN=TOP width="15" bgcolor="#C5EBDD">
          <div align="center"><font face="Arial,Helvetica" size=-1>l.</font></div>
        </td>
        <td VALIGN=TOP width="408" bgcolor="#C5EBDD"><font face="Arial,Helvetica" size=-1><b>Do
          you intend to occupy the property as your primary residence?</b>&nbsp;
          If yes, complete question <b>m</b> below.</font></td>
        <td VALIGN=TOP width="100" bgcolor="#E1F4ED">
          <center>
            <table BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH="100%" >
              <tr>
                <td><font face="Arial,Helvetica" size=-1>Yes</font></td>
                <td><input onBlur="mark(this,'#E1F4ED','#000000')" type="checkbox" value="X" NAME="bl_yes" onClick="offCheckboxBL();" onFocus="nextfield ='bl_no'; mark(this,'#ffffcc','#0000FF')"></td>
                <td><font face="Arial,Helvetica" size=-1>No</font></td>
                <td><input onBlur="mark(this,'#E1F4ED','#000000')" type="checkbox" value="X" NAME="bl_no" onClick="onCheckboxBL();" onFocus="nextfield ='cbl_yes'; mark(this,'#ffffcc','#0000FF')"></td>
              </tr>
            </table>
          </center>
        </td>
        <td VALIGN=TOP width="100" bgcolor="#C5EBDD">
          <center>
            <table BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH="100%" >
              <tr>
                <td><font face="Arial,Helvetica" size=-1>Yes</font></td>
                <td><input onBlur="mark(this,'#C5EBDD','#000000')" type="checkbox" value="X" NAME="cbl_yes" onClick="offCheckboxCBL();" onFocus="nextfield ='cbl_no'; mark(this,'#ffffcc','#0000FF')"></td>
                <td><font face="Arial,Helvetica" size=-1>No</font></td>
                <td><input onBlur="mark(this,'#C5EBDD','#000000')" type="checkbox" value="X" NAME="cbl_no" onClick="onCheckboxCBL();" onFocus="nextfield ='bm_yes'; mark(this,'#ffffcc','#0000FF')"></td>
              </tr>
            </table>
          </center>
        </td>
      </tr>
      <tr>
        <td VALIGN=TOP width="15" bgcolor="#C5EBDD">
          <div align="center"><font face="Arial,Helvetica" size=-1>m.</font></div>
        </td>
        <td VALIGN=TOP width="408" bgcolor="#C5EBDD"><font face="Arial,Helvetica" size=-1>Have
          you had an ownership interest in a property in the last three years?</font></td>
        <td VALIGN=TOP width="100" bgcolor="#E1F4ED">
          <center>
            <table BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH="100%" >
              <tr>
                <td><font face="Arial,Helvetica" size=-1>Yes</font></td>
                <td><input onBlur="mark(this,'#E1F4ED','#000000')" type="checkbox" value="X" NAME="bm_yes" onClick="offCheckboxBM();" onFocus="nextfield ='bm_no'; mark(this,'#ffffcc','#0000FF')"></td>
                <td><font face="Arial,Helvetica" size=-1>No</font></td>
                <td><input onBlur="mark(this,'#E1F4ED','#000000')" type="checkbox" value="X" NAME="bm_no" onClick="onCheckboxBM();" onFocus="nextfield ='cbm_yes'; mark(this,'#ffffcc','#0000FF')"></td>
              </tr>
            </table>
          </center>
        </td>
        <td VALIGN=TOP width="100" bgcolor="#C5EBDD">
          <center>
            <table BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH="100%" >
              <tr>
                <td><font face="Arial,Helvetica" size=-1>Yes</font></td>
                <td><input onBlur="mark(this,'#C5EBDD','#000000')" type="checkbox" value="X" NAME="cbm_yes" onClick="offCheckboxCBM();" onFocus="nextfield ='cbm_no'; mark(this,'#ffffcc','#0000FF')"></td>
                <td><font face="Arial,Helvetica" size=-1>No</font></td>
                <td><input onBlur="mark(this,'#C5EBDD','#000000')" type="checkbox" value="X" NAME="cbm_no" onClick="onCheckboxCBM();" onFocus="nextfield ='b_ownership_property_type'; mark(this,'#ffffcc','#0000FF')"></td>
              </tr>
            </table>
          </center>
        </td>
      </tr>
      <tr>
        <td width="15" bgcolor="#C5EBDD"></td>
        <td VALIGN=TOP width="408" bgcolor="#C5EBDD"><font face="Arial,Helvetica"><font size=-1>(<b>1</b>)&nbsp;
          What type of property did you own? - -principal residence (PR), second
          home (SH), or investment property (IP).</font></font></td>
        <td VALIGN=TOP width="100" bgcolor="#E1F4ED">
          <div align="center">
            <select NAME="b_ownership_property_type" onFocus="nextfield ='cb_ownership_property_type';">
              <option VALUE=""></option>
              <option VALUE="PR">PR</option>
              <option VALUE="SH">SH</option>
              <option VALUE="IP">IP</option>
            </select>
          </div>
        </td>
        <td VALIGN=TOP width="100" bgcolor="#C5EBDD">
          <div align="center">
            <select NAME="cb_ownership_property_type" onFocus="nextfield ='b_ownership_title_held';">
              <option VALUE=""></option>
              <option VALUE="PR">PR</option>
              <option VALUE="SH">SH</option>
              <option VALUE="IP">IP</option>
            </select>
          </div>
        </td>
      </tr>
      <tr>
        <td width="15" bgcolor="#C5EBDD"></td>
        <td VALIGN=TOP width="408" bgcolor="#C5EBDD"><font face="Arial,Helvetica"><font size=-1>(<b>2</b>)&nbsp;
          How did you hold title to the home?- - solely by yourself (S), jointly
          with your spouse (SP), or jointly with another person (O).&nbsp;</font></font></td>
        <td VALIGN=TOP width="100" bgcolor="#E1F4ED">
          <div align="center">
            <select NAME="b_ownership_title_held" onFocus="nextfield ='cb_ownership_title_held';">
              <option VALUE=""></option>
              <option VALUE="S">S</option>
              <option VALUE="SP">SP</option>
              <option VALUE="O">O</option>
            </select>
          </div>
        </td>
        <td VALIGN=TOP width="100" bgcolor="#C5EBDD">
          <div align="center">
            <select NAME="cb_ownership_title_held" onFocus="nextfield ='declarations_explanation';">
              <option VALUE=""></option>
              <option VALUE="S">S</option>
              <option VALUE="SP">SP</option>
              <option VALUE="O">O</option>
            </select>
          </div>
        </td>
      </tr>
    </table>
    <br>
  </center>

<center><table BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH="620" >
<tr>
        <td bgcolor="#C5EBDD"><font face="Arial,Helvetica"><font size=-1>&nbsp;If you answered
          "<b>Yes</b>" to any questions <b>a</b> through <b>i</b> above, please
          explain in the space provided below</font></font> <br>
          <font size="1" face="arial, helvetica, sans-serif"> ( You may enter
          up to <b><font color="#C20303">400</font></b> characters. )<br>
<textarea onBlur="mark(this,'#FFFFFF','#000000')" NAME=declarations_explanation ROWS="3" COLS="40" WRAP="PHYSICAL" onKeyDown="textCounter(this.form.declarations_explanation,this.form.declarations_details,400);" onKeyUp="textCounter(this.form.declarations_explanation,this.form.declarations_details,400);" onFocus="nextfield ='b_private'; mark(this,'#ffffcc','#0000FF')"></textarea>
<input readonly type=text name=declarations_details size=3 maxlength=3 value="400" onFocus="blur();document.smartform.b_private.focus()"> characters remaining</font>
        </td>
</tr>
</table>
    <br>
    <br>
  </center>

<center>
    <table BORDER=1 CELLSPACING=0 CELLPADDING=0 WIDTH="620" BGCOLOR="#D0928A" bordercolor="#B85C50" >
      <tr>
<td>
<center><a NAME="tab15"></a><b><font face="Arial, Helvetica, sans-serif"><font color="#FFFFFF"><font size=+0>INFORMATION
FOR GOVERNMENT MONITORING PURPOSES</font></font></font></b></center>
</td>
</tr>
</table>
    <br>
    <table width="620" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font face="Arial,Helvetica"><font size=-2>The following information
          is requested by the Federal Government for certain types of loans related
          to a dwelling, in order to monitor the Lender's compliance with equal
          credit opportunity, fair housing and home mortgage disclosure laws.&nbsp;
          You are not required to furnish this information, but are encouraged
          to do so.&nbsp; The law provides that&nbsp; Lender may neither discriminate
          on the basis of this information, nor on whether you choose to furnish
          it.&nbsp; If you furnish the information, please provide both ethnicity
          and race. For race, you may check more than one designation. If you
          do not furnish ethnicity, race or sex, under Federal regulations, this
          lender is required to note the information on the basis of visual observaition
          or sirname. If you do not wish to furnish the information, please check
          the box below.&nbsp; (Lender must review the above material to assure
          that the disclosures satisfy all requirements to which the Lender is
          subject under applicable state law for the particular type of loan applied
          for.)</font></font></td>
      </tr>
    </table>
    <br>
    <table border=0 cellspacing=0 cellpadding=0 cols=2 width="620" >
      <tr>
        <td>
          <center>
            <a name="help70"></a><b><font face="Arial,Helvetica"><font size=-1>Borrower</font></font></b>
          </center>
        </td>
        <td>
          <center>
            <b><font face="Arial,Helvetica"><font size=-1>Co-Borrower</font></font></b>
          </center>
        </td>
      </tr>
      <tr>
        <td><a href="#./Help/Help70" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('help70','','images/helpA.gif',0)" onClick="MM_openBrWindow('./Help/Help70.php','help70','scrollbars=yes,resizable=yes,width=500,height=330')" onFocus="blur();document.smartform.b_private.focus()"><img src="images/helpB.gif" name="help70" border=0 height=15 width=46></a></td>
        <td>&nbsp;</td>
      </tr>
    </table>
    <br>
    <table width="620" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td colspan="2">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr bgcolor="#EDD7D3">
              <td width="27">
                <input onBlur="mark(this,'#EDD7D3','#000000')" type="checkbox" value="X" name="b_private" onFocus="nextfield ='cb_private'; mark(this,'#ffffcc','#0000FF')">
              </td>
              <td width="280" bgcolor="#EDD7D3"><font face="Arial,Helvetica"><font size=-1>I
                do not wish to furnish this information</font></font></td>
            </tr>
          </table>
        </td>
        <td colspan="2">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr bgcolor="#E0B9B4">
              <td width="27">
                <input onBlur="mark(this,'#E0B9B4','#000000')" type="checkbox" value="X" name="cb_private" onFocus="nextfield ='b_hisp'; mark(this,'#ffffcc','#0000FF')">
              </td>
              <td width="280" bgcolor="#E0B9B4"><font face="Arial,Helvetica"><font size=-1>I
                do not wish to furnish this information</font></font></td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="27">&nbsp;</td>
              <td width="280">
                <div align="center"><font face="Arial, Helvetica, sans-serif" size="2"><b>Ethnicity:</b></font></div>
              </td>
            </tr>
          </table>
        </td>
        <td colspan="2">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="27">&nbsp;</td>
              <td width="280">
                <div align="center"><font face="Arial, Helvetica, sans-serif" size="2"><b>Ethnicity</b></font></div>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr bgcolor="#EDD7D3">
              <td width="27">
                <input onBlur="mark(this,'#EDD7D3','#000000')" type="checkbox" value="X" name="b_hisp" onClick="offCheckboxBHISP();" onFocus="nextfield ='b_not_hisp'; mark(this,'#ffffcc','#0000FF')">
              </td>
              <td width="126"><font size="2" face="Arial, Helvetica, sans-serif">Hispanic
                or Latino</font></td>
            </tr>
          </table>
        </td>
        <td>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr bgcolor="#EDD7D3">
              <td width="27">
                <input onBlur="mark(this,'#EDD7D3','#000000')" type="checkbox" value="X" name="b_not_hisp" onClick="onCheckboxBHISP();" onFocus="nextfield ='cb_hisp'; mark(this,'#ffffcc','#0000FF')">
              </td>
              <td width="126"><font size="2" face="Arial, Helvetica, sans-serif">Not
                Hispanic-Latino</font></td>
            </tr>
          </table>
        </td>
        <td>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr bgcolor="#E0B9B4">
              <td width="27">
                <input onBlur="mark(this,'#E0B9B4','#000000')" type="checkbox" value="X" name="cb_hisp" onClick="offCheckboxCBHISP();" onFocus="nextfield ='cb_not_hisp'; mark(this,'#ffffcc','#0000FF')">
              </td>
              <td width="126"><font size="2" face="Arial, Helvetica, sans-serif">Hispanic
                or Latino</font></td>
            </tr>
          </table>
        </td>
        <td>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr bgcolor="#E0B9B4">
              <td width="27">
                <input onBlur="mark(this,'#E0B9B4','#000000')" type="checkbox" value="X" name="cb_not_hisp"  onClick="onCheckboxCBHISP();" onFocus="nextfield ='b_amer_indian'; mark(this,'#ffffcc','#0000FF')">
              </td>
              <td width="126"><font size="2" face="Arial, Helvetica, sans-serif">Not
                Hispanic-Latino</font></td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="27">&nbsp;</td>
              <td width="280">
                <div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><b>Race:</b></font></div>
              </td>
            </tr>
          </table>
        </td>
        <td colspan="2">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="27">&nbsp;</td>
              <td width="280">
                <div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><b>Race:</b></font></div>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#EDD7D3">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="27">
                <input onBlur="mark(this,'#EDD7D3','#000000')" type="checkbox" value="X" name="b_amer_indian" onFocus="nextfield ='cb_amer_indian'; mark(this,'#ffffcc','#0000FF')">
              </td>
              <td width="280"><font size="2" face="Arial, Helvetica, sans-serif">American
                Indian or Alaskan Native</font></td>
            </tr>
          </table>
        </td>
        <td colspan="2" bgcolor="#E0B9B4">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="27">
                <input onBlur="mark(this,'#E0B9B4','#000000')" type="checkbox" value="X" name="cb_amer_indian" onFocus="nextfield ='b_api'; mark(this,'#ffffcc','#0000FF')">
              </td>
              <td width="280"><font size="2" face="Arial, Helvetica, sans-serif">American
                Indian or Alaskan Native</font></td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#EDD7D3">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="27">
                <input onBlur="mark(this,'#EDD7D3','#000000')" type="checkbox" value="X" name="b_api" onFocus="nextfield ='cb_api'; mark(this,'#ffffcc','#0000FF')">
              </td>
              <td width="280"><font size="2" face="Arial, Helvetica, sans-serif">Asian</font></td>
            </tr>
          </table>
        </td>
        <td colspan="2" bgcolor="#E0B9B4">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="27">
                <input onBlur="mark(this,'#E0B9B4','#000000')" type="checkbox" value="X" name="cb_api" onFocus="nextfield ='b_aa'; mark(this,'#ffffcc','#0000FF')">
              </td>
              <td width="280"><font size="2" face="Arial, Helvetica, sans-serif">Asian</font></td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#EDD7D3">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="27">
                <input onBlur="mark(this,'#EDD7D3','#000000')" type="checkbox" value="X" name="b_aa" onFocus="nextfield ='cb_aa'; mark(this,'#ffffcc','#0000FF')">
              </td>
              <td width="280"><font size="2" face="Arial, Helvetica, sans-serif">Black
                or African American</font></td>
            </tr>
          </table>
        </td>
        <td colspan="2" bgcolor="#E0B9B4">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="27">
                <input onBlur="mark(this,'#E0B9B4','#000000')" type="checkbox" value="X" name="cb_aa" onFocus="nextfield ='b_hawaiian'; mark(this,'#ffffcc','#0000FF')">
              </td>
              <td width="280"><font size="2" face="Arial, Helvetica, sans-serif">Black
                or African American</font></td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#EDD7D3">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="27">
                <input onBlur="mark(this,'#EDD7D3','#000000')" type="checkbox" value="X" name="b_hawaiian" onFocus="nextfield ='cb_hawaiian'; mark(this,'#ffffcc','#0000FF')">
              </td>
              <td width="280"><font size="2" face="Arial, Helvetica, sans-serif">Native
                Hawaiian or Other Pacific Islander</font></td>
            </tr>
          </table>
        </td>
        <td colspan="2" bgcolor="#E0B9B4">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="27">
                <input onBlur="mark(this,'#E0B9B4','#000000')" type="checkbox" value="X" name="cb_hawaiian" onFocus="nextfield ='b_white'; mark(this,'#ffffcc','#0000FF')">
              </td>
              <td width="280"><font size="2" face="Arial, Helvetica, sans-serif">Native
                Hawaiian or Other Pacific Islander</font></td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#EDD7D3">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="27">
                <input onBlur="mark(this,'#EDD7D3','#000000')" type="checkbox" value="X" name="b_white" onFocus="nextfield ='cb_white'; mark(this,'#ffffcc','#0000FF')">
              </td>
              <td width="280"><font size="2" face="Arial, Helvetica, sans-serif">White</font></td>
            </tr>
          </table>
        </td>
        <td colspan="2" bgcolor="#E0B9B4">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="27">
                <input onBlur="mark(this,'#E0B9B4','#000000')" type="checkbox" value="X" name="cb_white" onFocus="nextfield ='b_male'; mark(this,'#ffffcc','#0000FF')">
              </td>
              <td width="280"><font size="2" face="Arial, Helvetica, sans-serif">White</font></td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td colspan="2" height="20">
           <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="27">&nbsp;</td>
                <td width="280">
                  <div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><b>Sex:</b></font></div>
                </td>
              </tr>
            </table>
          </td>
        <td colspan="2" height="20">
           <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="27">&nbsp;</td>
                <td width="280">
                  <div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><b>Sex:</b></font></div>
                </td>
              </tr>
            </table>
          </td>
      </tr>
      <tr>
        <td>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr bgcolor="#EDD7D3">
              <td width="27">
                <input onBlur="mark(this,'#EDD7D3','#000000')" type="checkbox" value="X" name="b_male" onClick="offCheckboxBSEX();" onFocus="nextfield ='b_female'; mark(this,'#ffffcc','#0000FF')">
              </td>
              <td width="126"><font face="Arial,Helvetica"><font size=-1>Male</font></font></td>
            </tr>
          </table>
        </td>
        <td>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr bgcolor="#EDD7D3">
              <td width="27">
                <input onBlur="mark(this,'#EDD7D3','#000000')" type="checkbox" value="X" name="b_female" onClick="onCheckboxBSEX();" onFocus="nextfield ='cb_male'; mark(this,'#ffffcc','#0000FF')">
              </td>
              <td width="126"><font face="Arial,Helvetica"><font size=-1>Female</font></font></td>
            </tr>
          </table>
        </td>
        <td>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr bgcolor="#E0B9B4">
              <td width="27">
                <input onBlur="mark(this,'#E0B9B4','#000000')" type="checkbox" value="X" name="cb_male"  onClick="offCheckboxCBSEX();" onFocus="nextfield ='cb_female'; mark(this,'#ffffcc','#0000FF')">
              </td>
              <td width="126"><font face="Arial,Helvetica"><font size=-1>Male</font></font></td>
            </tr>
          </table>
        </td>
        <td>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr bgcolor="#E0B9B4">
              <td width="27">
                <input onBlur="mark(this,'#E0B9B4','#000000')" type="checkbox" value="X" name="cb_female" onClick="onCheckboxCBSEX();" onFocus="nextfield ='ff_interview'; mark(this,'#ffffcc','#0000FF')">
              </td>
              <td width="126"><font face="Arial,Helvetica"><font size=-1>Female</font></font></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <br>
    <table width="620" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td> <b><font face="Arial, Helvetica, sans-serif" size="2">This application
          was taken by (select below):</font></b></td>
      </tr>
    </table>
    <table width="620" border="0" cellspacing="0" cellpadding="0">
      <tr bgcolor="#E0B9B4">
        <td width="24"><font face="Arial, Helvetica, sans-serif" size="2">
          <input onBlur="mark(this,'#E0B9B4','#000000')" type="checkbox" value="X" name="ff_interview" onFocus="nextfield ='mail_interview'; mark(this,'#ffffcc','#0000FF')">
          </font></td>
        <td width="150"><font face="Arial, Helvetica, sans-serif" size="2">Face-to-face
          interview</font></td>
        <td width="24"> <font face="Arial, Helvetica, sans-serif" size="2">
          <input onBlur="mark(this,'#E0B9B4','#000000')" type="checkbox" value="X" name="mail_interview" onFocus="nextfield ='phone_interview'; mark(this,'#ffffcc','#0000FF')">
          </font></td>
        <td width="58"><font face="Arial, Helvetica, sans-serif" size="2">Mail</font></td>
        <td width="26"><font face="Arial, Helvetica, sans-serif" size="2">
          <input onBlur="mark(this,'#E0B9B4','#000000')" type="checkbox" value="X" name="phone_interview" onFocus="nextfield ='internet_interview'; mark(this,'#ffffcc','#0000FF')">
          </font></td>
        <td width="88"><font face="Arial, Helvetica, sans-serif" size="2">Telephone</font></td>
        <td width="26"><font face="Arial, Helvetica, sans-serif" size="2">
          <input onBlur="mark(this,'#E0B9B4','#000000')" type="checkbox" value="X" name="internet_interview" onFocus="nextfield ='submit'; mark(this,'#ffffcc','#0000FF')">
          </font></td>
        <td width="224"><font face="Arial, Helvetica, sans-serif" size="2">Internet</font></td>
      </tr>
    </table>
    <br>
    <br>
  </center>

<center>
  </center>

<center>
    <table border=0 cellspacing=2 cellpadding=0 width="620" >
      <tr>
        <td><font face="Arial,Helvetica" size="-1"><b><font color="#C20303">Don't
          Forget:</font></b> The Borrower and Co-Borrower (if any) need to sign
          the application <b>on the third and forth pages</b> before you give
          the application to your broker or lender. When you click the &quot;Submit&quot;
          button, you will be able to view and print the Fannie Mae application.
          If you wish to <b>print your application</b> when it appears on the
          screen,<b><font color="#008080"> </font></b></font><b><font face="Arial,Helvetica" size="-1"><a href="#./Help/Printing" onClick="MM_openBrWindow('./Help/Printing.php','printing','scrollbars=yes,resizable=yes,toolbar=yes,menubar=yes,width=640,height=420,screenX=0,screenY=0,top=0,left=0')"><font color="#C20303">"click
          here for printing instructions"</font></a></font></b><font face="Arial,Helvetica" size="-1" color="#C20303"></font><font face="Arial,Helvetica" size="-1">.
          After printing out the printing instructions, close the printing instructions
          window and click on the &quot;Submit&quot; button below.</font></td>
      </tr>
    </table>
    </center>

<center>
<p><input TYPE="submit" name="submit" value="Submit" onClick="clickedButton=true">
    <br>
  </center>

  <p>
  <p>
</form>
</div>
<!--ih:includeHTML file="../include/bottom.php"-->
		<!--
		// http://www.lightning-mortgage.com/include/bottom-root.php is a copy of the contents ../include/bottom.php. It is the
		// web page bottom border that is inserted in all appropriate .php pages located at
		// the root level of the website.
		-->
		<div id='RightFrame'></div><div style='clear:left;'></div>
		<div id='LeftFrame' style='height:102px;'></div>
		<div class="Bottom2">
			<div style="float:right;height:90px;width:80px;">
				<img border='0' src='../images/equalhouse.gif' alt='Equal housing lender' style="">
			</div>
			<a href="http://www.lightning-mortgage.com/Administrative/SiteMap.php">Site Map</a>&nbsp;|
			<a href="http://www.lightning-mortgage.com/Administrative/Calculators.php">Calculators</a>&nbsp;|
			<a href="http://www.lightning-mortgage.com/Answers/GlossaryAD.php">Glossary</a>&nbsp;|
			<a href="http://www.lightning-mortgage.com/Administrative/PrivacyPolicy.php">Privacy Policy</a>&nbsp;|
			<a href="http://www.lightning-mortgage.com/Administrative/Legal.php">Legal</a>&nbsp;|
			<a href="http://www.lightning-mortgage.com/Administrative/AffiliateLinks.php">Affiliates</a><br />

			<p class="CenterSmall" style='text-align:center;'>Click on <a href="http://www.lightning-mortgage.com/Administrative/Feedback.php">feedback</a> 
			or call (866) 822-8500 for assistance - Last Updated:
			<script language="JavaScript1.2" type="text/javascript">
			<!--
				var lastMod = new Date(document.lastModified);
				var MM = lastMod.getMonth() + 1;
				var DD = lastMod.getDate();
				document.write(MM+"\/"+DD+"\/"+lastMod.getFullYear());
			//-->
			</script>
			</p>

			<p class="CenterSmall" style="margin:0;">This Website is NOT intended as a solicitation to customers in any jurisdiction in which we
			are not authorized to operate. 

			<script type="text/javascript">
				var Today 	= new Date();
				var ThisYear 	= Today.getFullYear();
				var DayName = Today.getDate();
				document.write("&copy; Lightning Mortgage 2002-" + ThisYear + " All Rights Reserved. No part of this website may be ");
			</script>

			reused commercially without the expressed written consent of Lightning Mortgage.
			This site is directed at, and made available to, persons in the continental U.S., Alaska and Hawaii only.</p>
		</div><!-- Bottom2 silver -->
		<div id='RightFrame' style='height:102px;'></div><div style='clear:left;'></div>
		<div id='BottomLeftCorner'></div><div id='BottomFrame'></div><div id='BottomRightCorner'></div>	
	</div> <!-- ContentBackground yellow -->	
</div> <!-- Main -->

<SCRIPT language="JavaScript" type="text/javascript"> 
<!--
BType();
SetContentHeight();
//-->
</SCRIPT>
<!--/ih:includeHTML-->
<!--ih:includeHTML file="../include/top.php-new"--><!-- ./include/top-root.php is a copy of the contents ./include/top.php with the directory levels changed-->
<div class="Top">
	<div id='MS'>
		<a href="http://www.lightning-mortgage.com/Answers/MortgageInsiderSecrets.php" class="Top" onfocus="if(this.blur) this.blur();">
		<img src="../images/SignUp.jpg" onMouseover='this.src="../images/SignUpHover.jpg"' onMouseout='this.src="../images/SignUp.jpg"' 
		style='border:none;' alt='sign-up'></a>
	</div><!--MS-->
	<div id='TipTop'>
		<a class="Logo" onfocus="if(this.blur) this.blur();" href="http://www.lightning-mortgage.com/index.php">
		<img src="../images/Lightning-Mortgage.jpg" style="border:none;"
		alt="Lightning Mortgage - Mortgages, even with Bad Credit" title="Lucio is in the house!"></a>
	</div><!--TipTop-->
	<noscript>
	<!--
	<p style="text-align:center;border:5px dotted #fff;font-size:large;color:#fff;">
	<br />Warning! Either your browser does not support JavaScript or it is currently disabled.<br />
	This website requires JavaScript to be properly viewed. Please enable JavaScript.<br />&nbsp;</p>
	//-->
	</noscript>
	<br style="clear:both;"> <!-- tabs here -->
	<div id="TabDiv">
		<div id="navTab">
			<script language="JavaScript" type="text/javascript">
			<!--
			ShowNewTabs(Directory);
			//-->
			</SCRIPT>
		</div><!--navTab-->
	</div><!-- TabDiv-->
</div><!--Top-->

<div class="TopFrame">
	<div class="TFL"></div>
	<div id='BelowTabs'>
		<a href="http://www.lightning-mortgage.com/Survey.php" title="Take our Satisfaction Survey"
		class="Top">Survey</a>&nbsp;|
		<a href="http://www.lightning-mortgage.com/Administrative/Feedback.php" title="Ask questions and give us feedback"
		class="Top">Questions?</a>&nbsp;|
		<a href="http://www.lightning-mortgage.com/Administrative/AboutUs.php" title="About Us"
		class="Top">About</a>&nbsp;|
		<a href="http://www.lightning-mortgage.com/Administrative/ContactUs.php" title="How to contact us"
		class="Top">Contact</a>&nbsp;|
		<a href="#" title="opens a new window" onclick="if (window.MapWindow) window.MapWindow.close();MapWindow=open('../Administrative/WhereWeLend.php',
			'pcalculator','height=520,width=600,top=0,left=0,alwaysRaised=yes,resizable=no,scrollbars=no,menubar=no,titlebar=yes,toolbar=no, scroll=yes');"
		class="Top">Where We Lend</a><img src="../images/NewWindow.gif" alt="opens new window">
	</div> <!-- BelowTabs -->
	<div class="TFR">
		<script language="JavaScript" type="text/javascript">
		<!--
		ShowSearchButton();
		//d.getElementById('ContentDIV').style.visibility = 'visible';
		-->
		</script>
	</div><!--TFR-->
</div>

<div class="Main">
	<div id="ContentBackground" style='background:transparent;'>
		<div id='TopLeftCorner'></div><div id='TopFrame'></div><div id='TopRightCorner'></div>
		<div style='clear:left;'></div>

		<div id='LeftFrame'></div>
		<div id="ContentDIV">
<!-- TopFrame -->
<!--/ih:includeHTML-->
</body>
</html>
