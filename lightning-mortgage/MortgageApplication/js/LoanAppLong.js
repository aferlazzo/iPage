
function Validator(smartform)
{
  var error = ""; 
   if (smartform.email.value == "")
  {
    error += "Your email address is required information and this form cannot be submitted without it. Please enter a valid email address at the top of this form in the Email Address form field.  This will prevent you from loosing all of your information.\n";
  }
  if ((smartform.email.value.indexOf ('@',0) == -1 ||
   smartform.email.value.indexOf ('.',0) == -1) &&
   smartform.email.value != "")
  {
    error += "You must include an accurate email address. Use the following format: username@domain.com";
  } 
if (error != "")
  {
    alert(error);
	document.smartform.email.focus()
    return (false);
  } 
  if (document.smartform.password.value == "") {
alert("You must enter a password in order for your application to be submitted.")
document.smartform.password.focus()
   return (false);
  } else {
    return (true);
  }
}

function checkPass() {
   var passwd = document.smartform.password.value;
   var test = /(\w{6,})/g;
   var test2 = /\W/;
   if (!passwd.match(test) || passwd.match(test2)) {
      alert ("You must enter a password in order for your application to be submitted. Your password must contain 6 to 12 characters, and only be made up of letters and/or numbers")
document.smartform.password.focus();
   }
}


function mark(face,field_color,text_color){
if (document.documentElement){
face.style.backgroundColor=field_color;
face.style.color=text_color;
}
}

var clickedButton = false;

function check() {
    if (clickedButton) {
        clickedButton = false;
        return true;
    }
    else
        return false;
}

function offCheckboxSpouse()
{
  var the_box = document.smartform.cb_income_used;
  if (the_box.checked == true) {
    document.smartform.cb_income_not_used.checked = false;
  }
}

function onCheckboxSpouse()
{
  var the_box = document.smartform.cb_income_not_used;
  if (the_box.checked == true) {
    document.smartform.cb_income_used.checked = false;
  }
}

function offCheckboxImprove()
{
  var the_box = document.smartform.improve_made;
  if (the_box.checked == true) {
    document.smartform.improve_to_be_made.checked = false;
  }
}

function onCheckboxImprove()
{
  var the_box = document.smartform.improve_to_be_made;
  if (the_box.checked == true) {
    document.smartform.improve_made.checked = false;
  }
}

function offCheckboxEstate()
{
  var the_box = document.smartform.fee_simple;
  if (the_box.checked == true) {
    document.smartform.leasehold.checked = false;
  }
}

function onCheckboxEstate()
{
  var the_box = document.smartform.leasehold;
  if (the_box.checked == true) {
    document.smartform.fee_simple.checked = false;
  }
}

function offCheckboxOwn1()
{
  var the_box = document.smartform.b_own_home;
  if (the_box.checked == true) {
    document.smartform.b_rent_home.checked = false;
  }
}

function onCheckboxOwn1()
{
  var the_box = document.smartform.b_rent_home;
  if (the_box.checked == true) {
    document.smartform.b_own_home.checked = false;
  }
}

function offCheckboxOwn2()
{
  var the_box = document.smartform.b_former_own;
  if (the_box.checked == true) {
    document.smartform.b_former_rent.checked = false;
  }
}

function onCheckboxOwn2()
{
  var the_box = document.smartform.b_former_rent;
  if (the_box.checked == true) {
    document.smartform.b_former_own.checked = false;
  }
}

function offCheckboxOwn3()
{
  var the_box = document.smartform.b_2former_own;
  if (the_box.checked == true) {
    document.smartform.b_2former_rent.checked = false;
  }
}

function onCheckboxOwn3()
{
  var the_box = document.smartform.b_2former_rent;
  if (the_box.checked == true) {
    document.smartform.b_2former_own.checked = false;
  }
}

function offCheckboxCBOwn1()
{
  var the_box = document.smartform.cb_own_home;
  if (the_box.checked == true) {
    document.smartform.cb_rent_home.checked = false;
  }
}

function onCheckboxCBOwn1()
{
  var the_box = document.smartform.cb_rent_home;
  if (the_box.checked == true) {
    document.smartform.cb_own_home.checked = false;
  }
}

function offCheckboxCBOwn2()
{
  var the_box = document.smartform.cb_former_own;
  if (the_box.checked == true) {
    document.smartform.cb_former_rent.checked = false;
  }
}

function onCheckboxCBOwn2()
{
  var the_box = document.smartform.cb_former_rent;
  if (the_box.checked == true) {
    document.smartform.cb_former_own.checked = false;
  }
}

function offCheckboxCBOwn3()
{
  var the_box = document.smartform.cb_2former_own;
  if (the_box.checked == true) {
    document.smartform.cb_2former_rent.checked = false;
  }
}

function onCheckboxCBOwn3()
{
  var the_box = document.smartform.cb_2former_rent;
  if (the_box.checked == true) {
    document.smartform.cb_2former_own.checked = false;
  }
}


function offCheckbox()
{
  var the_box = document.smartform.add_res_record1;
  if (the_box.checked == true) {
    document.smartform.add_res_record1no.checked = false;
  }
}

function onCheckbox()
{
  var the_box = document.smartform.add_res_record1no;
  if (the_box.checked == true) {
    document.smartform.add_res_record1.checked = false;
  }
}

function offCheckbox2()
{
  var the_box = document.smartform.add_res_record2;
  if (the_box.checked == true) {
    document.smartform.add_res_record2no.checked = false;
  }
}

function onCheckbox2()
{
  var the_box = document.smartform.add_res_record2no;
  if (the_box.checked == true) {
    document.smartform.add_res_record2.checked = false;
  }
}

function offCheckboxCBres1()
{
  var the_box = document.smartform.add_cbres_record1;
  if (the_box.checked == true) {
    document.smartform.add_cbres_record1no.checked = false;
  }
}

function onCheckboxCBres1()
{
  var the_box = document.smartform.add_cbres_record1no;
  if (the_box.checked == true) {
    document.smartform.add_cbres_record1.checked = false;
  }
}

function offCheckboxCBres2()
{
  var the_box = document.smartform.add_cbres_record2;
  if (the_box.checked == true) {
    document.smartform.add_cbres_record2no.checked = false;
  }
}

function onCheckboxCBres2()
{
  var the_box = document.smartform.add_cbres_record2no;
  if (the_box.checked == true) {
    document.smartform.add_cbres_record2.checked = false;
  }
}

function offCheckboxEmploy1()
{
  var the_box = document.smartform.add_employed_record1;
  if (the_box.checked == true) {
    document.smartform.add_employed_record1no.checked = false;
  }
}

function onCheckboxEmploy1()
{
  var the_box = document.smartform.add_employed_record1no;
  if (the_box.checked == true) {
    document.smartform.add_employed_record1.checked = false;
  }
}

function offCheckboxEmploy2()
{
  var the_box = document.smartform.add_employed_record2;
  if (the_box.checked == true) {
    document.smartform.add_employed_record2no.checked = false;
  }
}

function onCheckboxEmploy2()
{
  var the_box = document.smartform.add_employed_record2no;
  if (the_box.checked == true) {
    document.smartform.add_employed_record2.checked = false;
  }
}

function offCheckboxProp1()
{
  var the_box = document.smartform.add_prop_record1;
  if (the_box.checked == true) {
    document.smartform.add_prop_record1no.checked = false;
  }
}

function onCheckboxProp1()
{
  var the_box = document.smartform.add_prop_record1no;
  if (the_box.checked == true) {
    document.smartform.add_prop_record1.checked = false;
  }
}

function offCheckboxProp2()
{
  var the_box = document.smartform.add_prop_record2;
  if (the_box.checked == true) {
    document.smartform.add_prop_record2no.checked = false;
  }
}

function onCheckboxProp2()
{
  var the_box = document.smartform.add_prop_record2no;
  if (the_box.checked == true) {
    document.smartform.add_prop_record2.checked = false;
  }
}

function offCheckboxBank1()
{
  var the_box = document.smartform.add_bank_record1;
  if (the_box.checked == true) {
    document.smartform.add_bank_record1no.checked = false;
  }
}

function onCheckboxBank1()
{
  var the_box = document.smartform.add_bank_record1no;
  if (the_box.checked == true) {
    document.smartform.add_bank_record1.checked = false;
  }
}

function offCheckboxBank2()
{
  var the_box = document.smartform.add_bank_record2;
  if (the_box.checked == true) {
    document.smartform.add_bank_record2no.checked = false;
  }
}

function onCheckboxBank2()
{
  var the_box = document.smartform.add_bank_record2no;
  if (the_box.checked == true) {
    document.smartform.add_bank_record2.checked = false;
  }
}

function offCheckboxBank3()
{
  var the_box = document.smartform.add_bank_record3;
  if (the_box.checked == true) {
    document.smartform.add_bank_record3no.checked = false;
  }
}

function onCheckboxBank3()
{
  var the_box = document.smartform.add_bank_record3no;
  if (the_box.checked == true) {
    document.smartform.add_bank_record3.checked = false;
  }
}

function offCheckboxLiab1()
{
  var the_box = document.smartform.add_liab_record1;
  if (the_box.checked == true) {
    document.smartform.add_liab_record1no.checked = false;
  }
}

function onCheckboxLiab1()
{
  var the_box = document.smartform.add_liab_record1no;
  if (the_box.checked == true) {
    document.smartform.add_liab_record1.checked = false;
  }
}

function offCheckboxLiab2()
{
  var the_box = document.smartform.add_liab_record2;
  if (the_box.checked == true) {
    document.smartform.add_liab_record2no.checked = false;
  }
}

function onCheckboxLiab2()
{
  var the_box = document.smartform.add_liab_record2no;
  if (the_box.checked == true) {
    document.smartform.add_liab_record2.checked = false;
  }
}

function offCheckboxLiab3()
{
  var the_box = document.smartform.add_liab_record3;
  if (the_box.checked == true) {
    document.smartform.add_liab_record3no.checked = false;
  }
}

function onCheckboxLiab3()
{
  var the_box = document.smartform.add_liab_record3no;
  if (the_box.checked == true) {
    document.smartform.add_liab_record3.checked = false;
  }
}

function offCheckboxLiab4()
{
  var the_box = document.smartform.add_liab_record4;
  if (the_box.checked == true) {
    document.smartform.add_liab_record4no.checked = false;
  }
}

function onCheckboxLiab4()
{
  var the_box = document.smartform.add_liab_record4no;
  if (the_box.checked == true) {
    document.smartform.add_liab_record4.checked = false;
  }
}

function offCheckboxLiab5()
{
  var the_box = document.smartform.add_liab_record5;
  if (the_box.checked == true) {
    document.smartform.add_liab_record5no.checked = false;
  }
}

function onCheckboxLiab5()
{
  var the_box = document.smartform.add_liab_record5no;
  if (the_box.checked == true) {
    document.smartform.add_liab_record5.checked = false;
  }
}

function offCheckboxLiab6()
{
  var the_box = document.smartform.add_liab_record6;
  if (the_box.checked == true) {
    document.smartform.add_liab_record6no.checked = false;
  }
}

function onCheckboxLiab6()
{
  var the_box = document.smartform.add_liab_record6no;
  if (the_box.checked == true) {
    document.smartform.add_liab_record6.checked = false;
  }
}

function offCheckboxB1()
{
  var the_box = document.smartform.b_self_employed;
  if (the_box.checked == true) {
    document.smartform.b_not_self_employed.checked = false;
  }
}

function onCheckboxB1()
{
  var the_box = document.smartform.b_not_self_employed;
  if (the_box.checked == true) {
    document.smartform.b_self_employed.checked = false;
  }
}

function offCheckboxCB1()
{
  var the_box = document.smartform.cb_self_employed;
  if (the_box.checked == true) {
    document.smartform.cb_not_self_employed.checked = false;
  }
}

function onCheckboxCB1()
{
  var the_box = document.smartform.cb_not_self_employed;
  if (the_box.checked == true) {
    document.smartform.cb_self_employed.checked = false;
  }
}

function offCheckboxB2()
{
  var the_box = document.smartform.b_self_employer2;
  if (the_box.checked == true) {
    document.smartform.b_other_not_self_employed.checked = false;
  }
}

function onCheckboxB2()
{
  var the_box = document.smartform.b_other_not_self_employed;
  if (the_box.checked == true) {
    document.smartform.b_self_employer2.checked = false;
  }
}

function offCheckboxCB2()
{
  var the_box = document.smartform.cb_self_employer2;
  if (the_box.checked == true) {
    document.smartform.cb_other_not_self_employed.checked = false;
  }
}

function onCheckboxCB2()
{
  var the_box = document.smartform.cb_other_not_self_employed;
  if (the_box.checked == true) {
    document.smartform.cb_self_employer2.checked = false;
  }
}

function offCheckboxB3()
{
  var the_box = document.smartform.b_self_employer3;
  if (the_box.checked == true) {
    document.smartform.b_other_not_self_employed3.checked = false;
  }
}

function onCheckboxB3()
{
  var the_box = document.smartform.b_other_not_self_employed3;
  if (the_box.checked == true) {
    document.smartform.b_self_employer3.checked = false;
  }
}

function offCheckboxCB3()
{
  var the_box = document.smartform.cb_self_employer3;
  if (the_box.checked == true) {
    document.smartform.cb_other_not_self_employed3.checked = false;
  }
}

function onCheckboxCB3()
{
  var the_box = document.smartform.cb_other_not_self_employed3;
  if (the_box.checked == true) {
    document.smartform.cb_self_employer3.checked = false;
  }
}

function offCheckboxOINB1()
{
  var the_box = document.smartform.b_explain_one;
  if (the_box.checked == true) {
    document.smartform.cb_explain_one.checked = false;
  }
}

function onCheckboxOINB1()
{
  var the_box = document.smartform.cb_explain_one;
  if (the_box.checked == true) {
    document.smartform.b_explain_one.checked = false;
  }
}

function offCheckboxOINB2()
{
  var the_box = document.smartform.b_explain_two;
  if (the_box.checked == true) {
    document.smartform.cb_explain_two.checked = false;
  }
}

function onCheckboxOINB2()
{
  var the_box = document.smartform.cb_explain_two;
  if (the_box.checked == true) {
    document.smartform.b_explain_two.checked = false;
  }
}

function offCheckboxOINB3()
{
  var the_box = document.smartform.b_explain_three;
  if (the_box.checked == true) {
    document.smartform.cb_explain_three.checked = false;
  }
}

function onCheckboxOINB3()
{
  var the_box = document.smartform.cb_explain_three;
  if (the_box.checked == true) {
    document.smartform.b_explain_three.checked = false;
  }
}

function offCheckboxOINB4()
{
  var the_box = document.smartform.b_explain_four;
  if (the_box.checked == true) {
    document.smartform.cb_explain_four.checked = false;
  }
}

function onCheckboxOINB4()
{
  var the_box = document.smartform.cb_explain_four;
  if (the_box.checked == true) {
    document.smartform.b_explain_four.checked = false;
  }
}

function offCheckboxJoint()
{
  var the_box = document.smartform.statement_completed_jointly;
  if (the_box.checked == true) {
    document.smartform.statement_completed_not_jointly.checked = false;
  }
}

function onCheckboxJoint()
{
  var the_box = document.smartform.statement_completed_not_jointly;
  if (the_box.checked == true) {
    document.smartform.statement_completed_jointly.checked = false;
  }
}

function offCheckboxBA()
{
  var the_box = document.smartform.ba_yes;
  if (the_box.checked == true) {
    document.smartform.ba_no.checked = false;
  }
}

function onCheckboxBA()
{
  var the_box = document.smartform.ba_no;
  if (the_box.checked == true) {
    document.smartform.ba_yes.checked = false;
  }
}

function offCheckboxCBA()
{
  var the_box = document.smartform.cba_yes;
  if (the_box.checked == true) {
    document.smartform.cba_no.checked = false;
  }
}

function onCheckboxCBA()
{
  var the_box = document.smartform.cba_no;
  if (the_box.checked == true) {
    document.smartform.cba_yes.checked = false;
  }
}

function offCheckboxBB()
{
  var the_box = document.smartform.bb_yes;
  if (the_box.checked == true) {
    document.smartform.bb_no.checked = false;
  }
}

function onCheckboxBB()
{
  var the_box = document.smartform.bb_no;
  if (the_box.checked == true) {
    document.smartform.bb_yes.checked = false;
  }
}

function offCheckboxCBB()
{
  var the_box = document.smartform.cbb_yes;
  if (the_box.checked == true) {
    document.smartform.cbb_no.checked = false;
  }
}

function onCheckboxCBB()
{
  var the_box = document.smartform.cbb_no;
  if (the_box.checked == true) {
    document.smartform.cbb_yes.checked = false;
  }
}

function offCheckboxBC()
{
  var the_box = document.smartform.bc_yes;
  if (the_box.checked == true) {
    document.smartform.bc_no.checked = false;
  }
}

function onCheckboxBC()
{
  var the_box = document.smartform.bc_no;
  if (the_box.checked == true) {
    document.smartform.bc_yes.checked = false;
  }
}

function offCheckboxCBC()
{
  var the_box = document.smartform.cbc_yes;
  if (the_box.checked == true) {
    document.smartform.cbc_no.checked = false;
  }
}

function onCheckboxCBC()
{
  var the_box = document.smartform.cbc_no;
  if (the_box.checked == true) {
    document.smartform.cbc_yes.checked = false;
  }
}

function offCheckboxBD()
{
  var the_box = document.smartform.bd_yes;
  if (the_box.checked == true) {
    document.smartform.bd_no.checked = false;
  }
}

function onCheckboxBD()
{
  var the_box = document.smartform.bd_no;
  if (the_box.checked == true) {
    document.smartform.bd_yes.checked = false;
  }
}

function offCheckboxCBD()
{
  var the_box = document.smartform.cbd_yes;
  if (the_box.checked == true) {
    document.smartform.cbd_no.checked = false;
  }
}

function onCheckboxCBD()
{
  var the_box = document.smartform.cbd_no;
  if (the_box.checked == true) {
    document.smartform.cbd_yes.checked = false;
  }
}

function offCheckboxBE()
{
  var the_box = document.smartform.be_yes;
  if (the_box.checked == true) {
    document.smartform.be_no.checked = false;
  }
}

function onCheckboxBE()
{
  var the_box = document.smartform.be_no;
  if (the_box.checked == true) {
    document.smartform.be_yes.checked = false;
  }
}

function offCheckboxCBE()
{
  var the_box = document.smartform.cbe_yes;
  if (the_box.checked == true) {
    document.smartform.cbe_no.checked = false;
  }
}

function onCheckboxCBE()
{
  var the_box = document.smartform.cbe_no;
  if (the_box.checked == true) {
    document.smartform.cbe_yes.checked = false;
  }
}

function offCheckboxBF()
{
  var the_box = document.smartform.bf_yes;
  if (the_box.checked == true) {
    document.smartform.bf_no.checked = false;
  }
}

function onCheckboxBF()
{
  var the_box = document.smartform.bf_no;
  if (the_box.checked == true) {
    document.smartform.bf_yes.checked = false;
  }
}

function offCheckboxCBF()
{
  var the_box = document.smartform.cbf_yes;
  if (the_box.checked == true) {
    document.smartform.cbf_no.checked = false;
  }
}

function onCheckboxCBF()
{
  var the_box = document.smartform.cbf_no;
  if (the_box.checked == true) {
    document.smartform.cbf_yes.checked = false;
  }
}

function offCheckboxBG()
{
  var the_box = document.smartform.bg_yes;
  if (the_box.checked == true) {
    document.smartform.bg_no.checked = false;
  }
}

function onCheckboxBG()
{
  var the_box = document.smartform.bg_no;
  if (the_box.checked == true) {
    document.smartform.bg_yes.checked = false;
  }
}

function offCheckboxCBG()
{
  var the_box = document.smartform.cbg_yes;
  if (the_box.checked == true) {
    document.smartform.cbg_no.checked = false;
  }
}

function onCheckboxCBG()
{
  var the_box = document.smartform.cbg_no;
  if (the_box.checked == true) {
    document.smartform.cbg_yes.checked = false;
  }
}

function offCheckboxBH()
{
  var the_box = document.smartform.bh_yes;
  if (the_box.checked == true) {
    document.smartform.bh_no.checked = false;
  }
}

function onCheckboxBH()
{
  var the_box = document.smartform.bh_no;
  if (the_box.checked == true) {
    document.smartform.bh_yes.checked = false;
  }
}

function offCheckboxCBH()
{
  var the_box = document.smartform.cbh_yes;
  if (the_box.checked == true) {
    document.smartform.cbh_no.checked = false;
  }
}

function onCheckboxCBH()
{
  var the_box = document.smartform.cbh_no;
  if (the_box.checked == true) {
    document.smartform.cbh_yes.checked = false;
  }
}

function offCheckboxBI()
{
  var the_box = document.smartform.bi_yes;
  if (the_box.checked == true) {
    document.smartform.bi_no.checked = false;
  }
}

function onCheckboxBI()
{
  var the_box = document.smartform.bi_no;
  if (the_box.checked == true) {
    document.smartform.bi_yes.checked = false;
  }
}

function offCheckboxCBI()
{
  var the_box = document.smartform.cbi_yes;
  if (the_box.checked == true) {
    document.smartform.cbi_no.checked = false;
  }
}

function onCheckboxCBI()
{
  var the_box = document.smartform.cbi_no;
  if (the_box.checked == true) {
    document.smartform.cbi_yes.checked = false;
  }
}

function offCheckboxBJ()
{
  var the_box = document.smartform.bj_yes;
  if (the_box.checked == true) {
    document.smartform.bj_no.checked = false;
  }
}

function onCheckboxBJ()
{
  var the_box = document.smartform.bj_no;
  if (the_box.checked == true) {
    document.smartform.bj_yes.checked = false;
  }
}

function offCheckboxCBJ()
{
  var the_box = document.smartform.cbj_yes;
  if (the_box.checked == true) {
    document.smartform.cbj_no.checked = false;
  }
}

function onCheckboxCBJ()
{
  var the_box = document.smartform.cbj_no;
  if (the_box.checked == true) {
    document.smartform.cbj_yes.checked = false;
  }
}

function offCheckboxBK()
{
  var the_box = document.smartform.bk_yes;
  if (the_box.checked == true) {
    document.smartform.bk_no.checked = false;
  }
}

function onCheckboxBK()
{
  var the_box = document.smartform.bk_no;
  if (the_box.checked == true) {
    document.smartform.bk_yes.checked = false;
  }
}

function offCheckboxCBK()
{
  var the_box = document.smartform.cbk_yes;
  if (the_box.checked == true) {
    document.smartform.cbk_no.checked = false;
  }
}

function onCheckboxCBK()
{
  var the_box = document.smartform.cbk_no;
  if (the_box.checked == true) {
    document.smartform.cbk_yes.checked = false;
  }
}

function offCheckboxBL()
{
  var the_box = document.smartform.bl_yes;
  if (the_box.checked == true) {
    document.smartform.bl_no.checked = false;
  }
}

function onCheckboxBL()
{
  var the_box = document.smartform.bl_no;
  if (the_box.checked == true) {
    document.smartform.bl_yes.checked = false;
  }
}

function offCheckboxCBL()
{
  var the_box = document.smartform.cbl_yes;
  if (the_box.checked == true) {
    document.smartform.cbl_no.checked = false;
  }
}

function onCheckboxCBL()
{
  var the_box = document.smartform.cbl_no;
  if (the_box.checked == true) {
    document.smartform.cbl_yes.checked = false;
  }
}

function offCheckboxBM()
{
  var the_box = document.smartform.bm_yes;
  if (the_box.checked == true) {
    document.smartform.bm_no.checked = false;
  }
}

function onCheckboxBM()
{
  var the_box = document.smartform.bm_no;
  if (the_box.checked == true) {
    document.smartform.bm_yes.checked = false;
  }
}

function offCheckboxCBM()
{
  var the_box = document.smartform.cbm_yes;
  if (the_box.checked == true) {
    document.smartform.cbm_no.checked = false;
  }
}

function onCheckboxCBM()
{
  var the_box = document.smartform.cbm_no;
  if (the_box.checked == true) {
    document.smartform.cbm_yes.checked = false;
  }
}

function offCheckboxBHISP()
{
  var the_box = document.smartform.b_hisp;
  if (the_box.checked == true) {
    document.smartform.b_not_hisp.checked = false;
  }
}

function onCheckboxBHISP()
{
  var the_box = document.smartform.b_not_hisp;
  if (the_box.checked == true) {
    document.smartform.b_hisp.checked = false;
  }
}

function offCheckboxCBHISP()
{
  var the_box = document.smartform.cb_hisp;
  if (the_box.checked == true) {
    document.smartform.cb_not_hisp.checked = false;
  }
}

function onCheckboxCBHISP()
{
  var the_box = document.smartform.cb_not_hisp;
  if (the_box.checked == true) {
    document.smartform.cb_hisp.checked = false;
  }
}

function offCheckboxBSEX()
{
  var the_box = document.smartform.b_male;
  if (the_box.checked == true) {
    document.smartform.b_female.checked = false;
  }
}

function onCheckboxBSEX()
{
  var the_box = document.smartform.b_female;
  if (the_box.checked == true) {
    document.smartform.b_male.checked = false;
  }
}

function offCheckboxCBSEX()
{
  var the_box = document.smartform.cb_male;
  if (the_box.checked == true) {
    document.smartform.cb_female.checked = false;
  }
}

function onCheckboxCBSEX()
{
  var the_box = document.smartform.cb_female;
  if (the_box.checked == true) {
    document.smartform.cb_male.checked = false;
  }
}

var isNav4 = false, isNav5 = false, isIE4 = false
var strSeperator = "/"; 
var vDateType = 1;
var vYearType = 4;
var vYearLength = 4;
var err = 0;
if(navigator.appName == "Netscape") {
if (navigator.appVersion < "5") {
isNav4 = true;
isNav5 = false;
}
else
if (navigator.appVersion > "4") {
isNav4 = false;
isNav5 = true;
   }
}
else {
isIE4 = true;
}
function DateFormat(vDateName, vDateValue, e, dateCheck, dateType) {
vDateType = dateType;

if (vDateValue == "~") {
alert("AppVersion = "+navigator.appVersion+" \nNav. 4 Version = "+isNav4+" \nNav. 5 Version = "+isNav5+" \nIE Version = "+isIE4+" \nYear Type = "+vYearType+" \nDate Type = "+vDateType+" \nSeparator = "+strSeperator);
vDateName.value = "";
vDateName.focus();
return true;
}

var whichCode = (window.Event) ? e.which : e.keyCode;

if (vDateValue.length > 8 && isNav4) {
if ((vDateValue.indexOf("-") >= 1) || (vDateValue.indexOf("/") >= 1))
return true;
}

var alphaCheck = " abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ/-";
if (alphaCheck.indexOf(vDateValue) >= 1) {
if (isNav4) {
vDateName.value = "";
vDateName.focus();
vDateName.select();
return false;
}
else {
vDateName.value = vDateName.value.substr(0, (vDateValue.length-1));
return false;
   }
}
if (whichCode == 8)
return false;
else {

var strCheck = '47,48,49,50,51,52,53,54,55,56,57,58,59,95,96,97,98,99,100,101,102,103,104,105';
if (strCheck.indexOf(whichCode) != -1) {
if (isNav4) {
if (((vDateValue.length < 6 && dateCheck) || (vDateValue.length == 7 && dateCheck)) && (vDateValue.length >=1)) {
alert("Invalid Date!\nPlease check to see if the date is correct.\nPlease go back and re-enter\nthe date in the following format:\n mm/dd/yyyy");
vDateName.value = "";
vDateName.focus();
vDateName.select();
return false;
}
if (vDateValue.length == 6 && dateCheck) {
var mDay = vDateName.value.substr(2,2);
var mMonth = vDateName.value.substr(0,2);
var mYear = vDateName.value.substr(4,4)

if (mYear.length == 2 && vYearType == 4) {
var mToday = new Date();

var checkYear = mToday.getFullYear() + 30; 
var mCheckYear = '20' + mYear;
if (mCheckYear >= checkYear)
mYear = '19' + mYear;
else
mYear = '20' + mYear;
}
var vDateValueCheck = mMonth+strSeperator+mDay+strSeperator+mYear;
if (!dateValid(vDateValueCheck)) {
alert("Invalid Date!\nPlease check to see if the date is correct.\nPlease go back and re-enter\nthe date in the following format:\n mm/dd/yyyy");
vDateName.value = "";
vDateName.focus();
vDateName.select();
return false;
}
return true;
}
else {

if (vDateValue.length >= 8  && dateCheck) {
if (vDateType == 1) // mmddyyyy
{
var mDay = vDateName.value.substr(2,2);
var mMonth = vDateName.value.substr(0,2);
var mYear = vDateName.value.substr(4,4)
vDateName.value = mMonth+strSeperator+mDay+strSeperator+mYear;
}

var vDateTypeTemp = vDateType;
vDateType = 1;
var vDateValueCheck = mMonth+strSeperator+mDay+strSeperator+mYear;
if (!dateValid(vDateValueCheck)) {
alert("Invalid Date!\nPlease check to see if the date is correct.\nPlease go back and re-enter\nthe date in the following format:\n mm/dd/yyyy");
vDateType = vDateTypeTemp;
vDateName.value = "";
vDateName.focus();
vDateName.select();
return false;
}
vDateType = vDateTypeTemp;
return true;
}
else {
if (((vDateValue.length < 8 && dateCheck) || (vDateValue.length == 9 && dateCheck)) && (vDateValue.length >=1)) {
alert("Invalid Date!\nPlease check to see if the date is correct.\nPlease go back and re-enter\nthe date in the following format:\n mm/dd/yyyy");
vDateName.value = "";
vDateName.focus();
vDateName.select();
return false;
         }
      }
   }
}
else {

if (((vDateValue.length < 8 && dateCheck) || (vDateValue.length == 9 && dateCheck)) && (vDateValue.length >=1)) {
alert("Invalid Date!\nPlease check to see if the date is correct.\nPlease go back and re-enter\nthe date in the following format:\n mm/dd/yyyy");
vDateName.value = "";
vDateName.focus();
return true;
}

if (vDateValue.length >= 8 && dateCheck) {

if (vDateType == 1) // mm/dd/yyyy
{
var mMonth = vDateName.value.substr(0,2);
var mDay = vDateName.value.substr(3,2);
var mYear = vDateName.value.substr(6,4)
}
if (vDateType == 2) // yyyy/mm/dd
{
var mYear = vDateName.value.substr(0,4)
var mMonth = vDateName.value.substr(5,2);
var mDay = vDateName.value.substr(8,2);
}
if (vDateType == 3) // dd/mm/yyyy
{
var mDay = vDateName.value.substr(0,2);
var mMonth = vDateName.value.substr(3,2);
var mYear = vDateName.value.substr(6,4)
}
if (vYearLength == 4) {
if (mYear.length < 4) {
alert("Invalid Date!\nPlease check to see if the date is correct.\nPlease go back and re-enter\nthe date in the following format:\n mm/dd/yyyy");
vDateName.value = "";
vDateName.focus();
return true;
   }
}

var vDateTypeTemp = vDateType;

vDateType = 1;

var vDateValueCheck = mMonth+strSeperator+mDay+strSeperator+mYear;
if (mYear.length == 2 && vYearType == 4 && dateCheck) {

var mToday = new Date();

var checkYear = mToday.getFullYear() + 30; 
var mCheckYear = '20' + mYear;
if (mCheckYear >= checkYear)
mYear = '19' + mYear;
else
mYear = '20' + mYear;
vDateValueCheck = mMonth+strSeperator+mDay+strSeperator+mYear;

if (vDateTypeTemp == 1) // mm/dd/yyyy
vDateName.value = mMonth+strSeperator+mDay+strSeperator+mYear;
}

if (!dateValid(vDateValueCheck)) {
alert("Invalid Date!\nPlease check to see if the date is correct.\nPlease go back and re-enter\nthe date in the following format:\n mm/dd/yyyy");
vDateType = vDateTypeTemp;
vDateName.value = "";
vDateName.focus();
return true;
}
vDateType = vDateTypeTemp;
return true;
}
else {
if (vDateType == 1) {
if (vDateValue.length == 2) {
vDateName.value = vDateValue+strSeperator;
}
if (vDateValue.length == 5) {
vDateName.value = vDateValue+strSeperator;
   }
}
if (vDateType == 2) {
if (vDateValue.length == 4) {
vDateName.value = vDateValue+strSeperator;
}
if (vDateValue.length == 7) {
vDateName.value = vDateValue+strSeperator;
   }
} 
if (vDateType == 3) {
if (vDateValue.length == 2) {
vDateName.value = vDateValue+strSeperator;
}
if (vDateValue.length == 5) {
vDateName.value = vDateValue+strSeperator;
   }
}
return true;
   }
}
if (vDateValue.length == 10&& dateCheck) {
if (!dateValid(vDateName)) {

alert("Invalid Date!\nPlease check to see if the date is correct.\nPlease go back and re-enter\nthe date in the following format:\n mm/dd/yyyy");
vDateName.focus();
vDateName.select();
   }
}
return false;
}
else {

if (isNav4) {
vDateName.value = "";
vDateName.focus();
vDateName.select();
return false;
}
else
{
vDateName.value = vDateName.value.substr(0, (vDateValue.length-1));
return false;
         }
      }
   }
}
function dateValid(objName) {
var strDate;
var strDateArray;
var strDay;
var strMonth;
var strYear;
var intday;
var intMonth;
var intYear;
var booFound = false;
var datefield = objName;
var strSeparatorArray = new Array("-"," ","/",".");
var intElementNr;

var strMonthArray = new Array(12);
strMonthArray[0] = "Jan";
strMonthArray[1] = "Feb";
strMonthArray[2] = "Mar";
strMonthArray[3] = "Apr";
strMonthArray[4] = "May";
strMonthArray[5] = "Jun";
strMonthArray[6] = "Jul";
strMonthArray[7] = "Aug";
strMonthArray[8] = "Sep";
strMonthArray[9] = "Oct";
strMonthArray[10] = "Nov";
strMonthArray[11] = "Dec";

strDate = objName;
if (strDate.length < 1) {
return true;
}
for (intElementNr = 0; intElementNr < strSeparatorArray.length; intElementNr++) {
if (strDate.indexOf(strSeparatorArray[intElementNr]) != -1) {
strDateArray = strDate.split(strSeparatorArray[intElementNr]);
if (strDateArray.length != 3) {
err = 1;
return false;
}
else {
strDay = strDateArray[0];
strMonth = strDateArray[1];
strYear = strDateArray[2];
}
booFound = true;
   }
}
if (booFound == false) {
if (strDate.length>5) {
strDay = strDate.substr(0, 2);
strMonth = strDate.substr(2, 2);
strYear = strDate.substr(4);
   }
}

if (strYear.length == 2) {
strYear = '20' + strYear;
}
strTemp = strDay;
strDay = strMonth;
strMonth = strTemp;
intday = parseInt(strDay, 10);
if (isNaN(intday)) {
err = 2;
return false;
}
intMonth = parseInt(strMonth, 10);
if (isNaN(intMonth)) {
for (i = 0;i<12;i++) {
if (strMonth.toUpperCase() == strMonthArray[i].toUpperCase()) {
intMonth = i+1;
strMonth = strMonthArray[i];
i = 12;
   }
}
if (isNaN(intMonth)) {
err = 3;
return false;
   }
}
intYear = parseInt(strYear, 10);
if (isNaN(intYear)) {
err = 4;
return false;
}
if (intMonth>12 || intMonth<1) {
err = 5;
return false;
}
if ((intMonth == 1 || intMonth == 3 || intMonth == 5 || intMonth == 7 || intMonth == 8 || intMonth == 10 || intMonth == 12) && (intday > 31 || intday < 1)) {
err = 6;
return false;
}
if ((intMonth == 4 || intMonth == 6 || intMonth == 9 || intMonth == 11) && (intday > 30 || intday < 1)) {
err = 7;
return false;
}
if (intMonth == 2) {
if (intday < 1) {
err = 8;
return false;
}
if (LeapYear(intYear) == true) {
if (intday > 29) {
err = 9;
return false;
   }
}
else {
if (intday > 28) {
err = 10;
return false;
      }
   }
}
return true;
}
function LeapYear(intYear) {
if (intYear % 100 == 0) {
if (intYear % 400 == 0) { return true; }
}
else {
if ((intYear % 4) == 0) { return true; }
}
return false;
}


nextfield = "email"; // name of first box on page
netscape = "";
ver = navigator.appVersion; len = ver.length;
for(iln = 0; iln < len; iln++) if (ver.charAt(iln) == "(") break;
netscape = (ver.charAt(iln+1).toUpperCase() != "C");

function keyDown(DnEvents) { // handles keypress
// determines whether Netscape or Internet Explorer
k = (netscape) ? DnEvents.which : window.event.keyCode;
if (k == 13) { // enter key pressed
if (nextfield == 'done') return true; // submit, we finished all fields
else { // we're not done yet, send focus to next box
eval('document.smartform.' + nextfield + '.focus()');
return false;
      }
   }
}

document.onkeydown = keyDown; // work together to analyze keystrokes
if (netscape) document.captureEvents(Event.KEYDOWN|Event.KEYUP);


function ValidateBage(){
	var dt=document.smartform.b_age
	if (findDate(dt.value)==false){
		dt.focus()
		return false
	}
    return true
 }
 
function ValidateCBage(){
	var dt=document.smartform.cb_age
	if (findDate(dt.value)==false){
		dt.focus()
		return false
	}
    return true
 }

function findInteger(s){
	var i;
    for (i = 0; i < s.length; i++){ 
	var c = s.charAt(i);
    if (((c < "0") || (c > "9"))) return false;
    }
    
    return true;
}

var separator= "/";
var beginYear=1900;
var endYear=2050;


function searchCharacters(s, folder){
	var i;
    var result = "";
    for (i = 0; i < s.length; i++){   
    var c = s.charAt(i);
    if (folder.indexOf(c) == -1) result += c;
    }
    return result;
}

function adjustFeb (year){
	return (((year % 4 == 0) && ( (!(year % 100 == 0)) || (year % 400 == 0))) ? 29 : 28 );
}
function adjustDays(n) {
	for (var i = 1; i <= n; i++) {
		this[i] = 31
		if (i==4 || i==6 || i==9 || i==11) {this[i] = 30}
		if (i==2) {this[i] = 29}
   } 
   return this
}

function findDate(dateString){
	var daysInMonth = adjustDays(12)
	var pos1=dateString.indexOf(separator)
	var pos2=dateString.indexOf(separator,pos1+1)
	var stringMonth=dateString.substring(0,pos1)
	var stringDay=dateString.substring(pos1+1,pos2)
	var sYear=dateString.substring(pos2+1)
	stringYear=sYear
	if (stringDay.charAt(0)=="0" && stringDay.length>1) stringDay=stringDay.substring(1)
	if (stringMonth.charAt(0)=="0" && stringMonth.length>1) stringMonth=stringMonth.substring(1)
	for (var i = 1; i <= 3; i++) {
		if (stringYear.charAt(0)=="0" && stringYear.length>1) stringYear=stringYear.substring(1)
	}
	month=parseInt(stringMonth)
	day=parseInt(stringDay)
	year=parseInt(stringYear)
	if (pos1==-1 || pos2==-1){
		alert("Please go back and enter the proper DATE FORMAT.  The date format should be : mm/dd/yyyy")
		return false
	}
	if (stringMonth.length<1 || month<1 || month>12){
		alert("Please go back and enter a valid MONTH in the DOB field")
		return false
	}
	if (stringDay.length<1 || day<1 || day>31 || (month==2 && day>adjustFeb(year)) || day > daysInMonth[month]){
		alert("Please go back and enter a valid DAY in the DOB field")
		return false
	}
	if (sYear.length != 4 || year==0 || year<beginYear || year>endYear){
		alert("Please go back and enter a valid 4 DIGIT YEAR between "+beginYear+" and "+endYear+" in the DOB field")
		return false
	}
	if (dateString.indexOf(separator,pos2+1)!=-1 || findInteger(searchCharacters(dateString, separator))==false){
		alert("Please go back and enter a valid DATE in the DOB field")
		return false
	}
return true
}

function changeResDiv1(res_div1,res_change1)
{
  var res_style1 = getStyleObject(res_div1);
  if (res_style1 != false)
  {
    res_style1.display = res_change1;
  }
}

function changeResDiv2(res_div2,res_change2)
{
  var res_style2 = getStyleObject(res_div2);
  if (res_style2 != false)
  {
    res_style2.display = res_change2;
  }
}

function hideRes1()
{
  changeResDiv1("res_questions1","none");
 
}

function hideRes2()
{
  changeResDiv2("res_questions2","none");
}

function changeCBResDiv1(cbres_div1,cbres_change1)
{
  var cbres_style1 = getStyleObject(cbres_div1);
  if (cbres_style1 != false)
  {
    cbres_style1.display = cbres_change1;
  }
}

function changeCBResDiv2(cbres_div2,cbres_change2)
{
  var cbres_style2 = getStyleObject(cbres_div2);
  if (cbres_style2 != false)
  {
    cbres_style2.display = cbres_change2;
  }
}

function hideCBRes1()
{
  changeCBResDiv1("cbres_questions1","none");
 
}

function hideCBRes2()
{
  changeCBResDiv2("cbres_questions2","none");
}



function changeEmployDiv1(the_div1,the_change1)
{
  var the_style1 = getStyleObject(the_div1);
  if (the_style1 != false)
  {
    the_style1.display = the_change1;
  }
}

function changeEmployDiv2(the_div2,the_change2)
{
  var the_style2 = getStyleObject(the_div2);
  if (the_style2 != false)
  {
    the_style2.display = the_change2;
  }
}

function hideAll1()
{
  changeEmployDiv1("employment_questions1","none");
 
}

function hideAll2()
{
  changeEmployDiv2("employment_questions2","none");
}

function changePropDiv1(prop_div1,prop_change1)
{
  var prop_style1 = getStyleObject(prop_div1);
  if (prop_style1 != false)
  {
    prop_style1.display = prop_change1;
  }
}

function changePropDiv2(prop_div2,prop_change2)
{
  var prop_style2 = getStyleObject(prop_div2);
  if (prop_style2 != false)
  {
    prop_style2.display = prop_change2;
  }
}

function hideProp1()
{
  changePropDiv1("prop_questions1","none");
 
}

function hideProp2()
{
  changePropDiv2("prop_questions2","none");
}

function changeBankDiv1(bank_div1,bank_change1)
{
  var bank_style1 = getStyleObject(bank_div1);
  if (bank_style1 != false)
  {
    bank_style1.display = bank_change1;
  }
}

function changeBankDiv2(bank_div2,bank_change2)
{
  var bank_style2 = getStyleObject(bank_div2);
  if (bank_style2 != false)
  {
    bank_style2.display = bank_change2;
  }
}

function changeBankDiv3(bank_div3,bank_change3)
{
  var bank_style3 = getStyleObject(bank_div3);
  if (bank_style3 != false)
  {
    bank_style3.display = bank_change3;
  }
}


function hideBank1()
{
  changeBankDiv1("bank_questions1","none");
 
}

function hideBank2()
{
  changeBankDiv2("bank_questions2","none");
 
}

function hideBank3()
{
  changeBankDiv3("bank_questions3","none");
 
}

function changeLiabDiv1(liab_div1,liab_change1)
{
  var liab_style1 = getStyleObject(liab_div1);
  if (liab_style1 != false)
  {
    liab_style1.display = liab_change1;
  }
}

function changeLiabDiv2(liab_div2,liab_change2)
{
  var liab_style2 = getStyleObject(liab_div2);
  if (liab_style2 != false)
  {
    liab_style2.display = liab_change2;
  }
}

function changeLiabDiv3(liab_div3,liab_change3)
{
  var liab_style3 = getStyleObject(liab_div3);
  if (liab_style3 != false)
  {
    liab_style3.display = liab_change3;
  }
}

function changeLiabDiv4(liab_div4,liab_change4)
{
  var liab_style4 = getStyleObject(liab_div4);
  if (liab_style4 != false)
  {
    liab_style4.display = liab_change4;
  }
}

function changeLiabDiv5(liab_div5,liab_change5)
{
  var liab_style5 = getStyleObject(liab_div5);
  if (liab_style5 != false)
  {
    liab_style5.display = liab_change5;
  }
}

function changeLiabDiv6(liab_div6,liab_change6)
{
  var liab_style6 = getStyleObject(liab_div6);
  if (liab_style6 != false)
  {
    liab_style6.display = liab_change6;
  }
}

function hideLiab1()
{
  changeLiabDiv1("liab_questions1","none");
 
}

function hideLiab2()
{
  changeLiabDiv2("liab_questions2","none");
 
}

function hideLiab3()
{
  changeLiabDiv3("liab_questions3","none");
 
}

function hideLiab4()
{
  changeLiabDiv4("liab_questions4","none");
 
}

function hideLiab5()
{
  changeLiabDiv5("liab_questions5","none");
 
}

function hideLiab6()
{
  changeLiabDiv6("liab_questions6","none");
 
}

function getStyleObject(objectId) {
  if (document.getElementById && document.getElementById(objectId)) {
    return document.getElementById(objectId).style;
  } else if (document.all && document.all(objectId)) {
    return document.all(objectId).style;
  } else {
    return false;
  }
}

function textCounter(field, countfield, maxlimit) {
if (field.value.length > maxlimit) // if too long...trim it!
field.value = field.value.substring(0, maxlimit);
// otherwise, update 'characters left' counter
else 
countfield.value = maxlimit - field.value.length;
}


function pickOneLAF(obj) {
max = 1;

laf_va = obj.form.laf_va.checked;
laf_fha = obj.form.laf_fha.checked;
laf_conv = obj.form.laf_conv.checked;
laf_fmha = obj.form.laf_fmha.checked;
laf_other = obj.form.laf_other.checked;

count = (laf_va ? 1 : 0) + (laf_fha ? 1 : 0) + (laf_conv ? 1 : 0) + (laf_fmha ? 1 : 0) + (laf_other ? 1 : 0);

if (count > max) {
alert("You may only check " + max + " box in this section! \nUncheck your previous selection if you want to pick another.");
obj.checked = false;
   }
}

function pickOneAMORT(obj) {
max = 1;

fixed = obj.form.fixed.checked;
amort_other = obj.form.amort_other.checked;
amort_gpm = obj.form.amort_gpm.checked;
amort_arm = obj.form.amort_arm.checked;


count = (fixed ? 1 : 0) + (amort_other ? 1 : 0) + (amort_gpm ? 1 : 0) + (amort_arm ? 1 : 0);

if (count > max) {
alert("You may only check " + max + " box in this section! \nUncheck your previous selection if you want to pick another.");
obj.checked = false;
   }
}

function pickOnePURP(obj) {
max = 1;

purch = obj.form.purch.checked;
constr = obj.form.constr.checked;
purp_other = obj.form.purp_other.checked;
purp_refi = obj.form.purp_refi.checked;
const_perm = obj.form.const_perm.checked;

count = (purch ? 1 : 0) + (constr ? 1 : 0) + (purp_other ? 1 : 0) + (purp_refi ? 1 : 0) + (const_perm ? 1 : 0);

if (count > max) {
alert("You may only check " + max + " box in this section! \nUncheck your previous selection if you want to pick another.");
obj.checked = false;
   }
}

function pickOneRES(obj) {
max = 1;

prime_res = obj.form.prime_res.checked;
second_res = obj.form.second_res.checked;
invest = obj.form.invest.checked;

count = (prime_res ? 1 : 0) + (second_res ? 1 : 0) + (invest ? 1 : 0);

if (count > max) {
alert("You may only check " + max + " box in this section! \nUncheck your previous selection if you want to pick another.");
obj.checked = false;
   }
}

function pickOneBMAR(obj) {
max = 1;

b_married = obj.form.b_married.checked;
b_separated = obj.form.b_separated.checked;
b_unmarried = obj.form.b_unmarried.checked;

count = (b_married ? 1 : 0) + (b_separated ? 1 : 0) + (b_unmarried ? 1 : 0);

if (count > max) {
alert("You may only check " + max + " box in this section! \nUncheck your previous selection if you want to pick another.");
obj.checked = false;
   }
}


function pickOneCBMAR(obj) {
max = 1;

cb_married = obj.form.cb_married.checked;
cb_separated = obj.form.cb_separated.checked;
cb_unmarried = obj.form.cb_unmarried.checked;

count = (cb_married ? 1 : 0) + (cb_separated ? 1 : 0) + (cb_unmarried ? 1 : 0);

if (count > max) {
alert("You may only check " + max + " box in this section! \nUncheck your previous selection if you want to pick another.");
obj.checked = false;
   }
}

function floor(number)
{
  return Math.floor(number*Math.pow(10,2))/Math.pow(10,2);
}

function checksum()
{
  var mi = document.smartform.interest_rate.value / 1200;
  var nTerm = document.smartform.number_of_months.value;
  var nMonPmt = floor(document.smartform.loan_amount.value * ( mi / ( 1 - Math.pow( 1 + mi, -nTerm ) ) ) );
  var nMonTax = floor(document.smartform.yearly_taxes.value / 12);
  var nMonHaz = floor(document.smartform.yearly_insurance.value / 12);

  document.smartform.proposed_pi.value = nMonPmt;
  document.smartform.proposed_re_taxes.value = nMonTax;
  document.smartform.proposed_hazard_insurance.value = nMonHaz;
  document.smartform.proposed_total_expenses.value = floor(nMonPmt + nMonTax + nMonHaz);
}


function calcloan(form) {

	if ( TE_digit(form.loan_amount.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Amount Applied For field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.interest_rate.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Interest Rate field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.number_of_months.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) are allowed in the Number of Months field!  Please go back and remove any comma's (,) dollar signs ($) or non-numeric characters from this field.");
              return false;                     }

	if ( TE_digit(form.yearly_taxes.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Yearly Taxes field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.yearly_insurance.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Yearly Insurance field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.proposed_other_financing.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Proposed Other Financing (P&I) field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.proposed_mi.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Proposed Mortgage Insurance field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.proposed_hoa_dues.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Proposed Homeowner Association Dues field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.proposed_other_expenses.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Proposed Other Expenses field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	form.proposed_total_expenses.value = Fix(eval(form.proposed_pi.value-0) + (form.proposed_other_financing.value-0) + (form.proposed_hazard_insurance.value-0) + (form.proposed_re_taxes.value-0) + (form.proposed_mi.value-0) + (form.proposed_hoa_dues.value-0) + (form.proposed_other_expenses.value-0));

	if ( TE_digit(form.details_purchase_price.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Purchase Price field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.details_improvements_value.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Alterations, Improvements, Repairs field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.details_land_only_value.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Land (if acquired separately) field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.details_refinance_amount.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Refinance (include debts to be paid) field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.details_estimated_prepaids.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Estimated Prepaid Items field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.details_estimated_closing_costs.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Estimated Closing Costs field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.details_pmi_mip_funding_fee.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the PMI, MIP, Funding Fee field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.details_discount_price.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Discount (if Borrower will pay) field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.details_subordinate_financing_amount.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Subordinate Financing field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.details_seller_paid_closing_costs.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Borrowers Closing Costs Paid By Seller field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.details_other_costs.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Other Credits field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.details_loan_amount_no_mi.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Loan Amount (exclude PMI, MIP, Funding Fee field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.details_pmi_mip_funding_fee_financed.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the PMI, MIP, Funding Fee Financed field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	form.details_total_costs.value = Fix(eval(form.details_purchase_price.value-0) + (form.details_improvements_value.value-0) + (form.details_land_only_value.value-0) + (form.details_refinance_amount.value-0) + (form.details_estimated_prepaids.value-0) + (form.details_estimated_closing_costs.value-0) + (form.details_pmi_mip_funding_fee.value-0) + (form.details_discount_price.value-0));

	form.details_loan_amount_m_plus_n.value = Fix(eval(form.details_loan_amount_no_mi.value-0) + (form.details_pmi_mip_funding_fee_financed.value-0));

	form.details_cash_from_to_borrower.value = Fix(eval(form.details_subordinate_financing_amount.value-0) + (form.details_seller_paid_closing_costs.value-0) + (form.details_other_costs.value-0) + (form.details_loan_amount_m_plus_n.value-0) - (form.details_total_costs.value-0));

}

var b_res_street = "";
var b_res_city = "";
var b_res_state = "";
var b_res_zip = "";
var cb_res_street = "";
var cb_res_city = "";
var cb_res_state = "";
var cb_res_zip = "";
var cb_phone = "";
var cb_married = "";
var cb_separated = "";
var cb_unmarried = "";
var cb_own_home = "";
var cb_rent_home = "";
var cb_yrs_at_res = "";

function InitSaveVariables (form){
b_res_street = form.b_res_street.value;
b_res_city = form.b_res_city.value;
b_res_state = form.b_res_state.value;
b_res_zip = form.b_res_zip.value;
cb_phone = form.cb_phone.value;
cb_married = form.cb_married.checked;
cb_separated = form.cb_separated.checked;
cb_unmarried = form.cb_unmarried.checked;
cb_own_home = form.cb_own_home.checked;
cb_rent_home = form.cb_rent_home.checked;
cb_yrs_at_res = form.cb_yrs_at_res.value;

}

function duplicate (form){
if (form.copy.checked) {
InitSaveVariables (form);
form.b_res_street.value = form.subj_prop_street.value;
form.b_res_city.value = form.subj_prop_city.value;
form.b_res_state.value = form.subj_prop_state.value;
form.b_res_zip.value = form.subj_prop_zip.value;
}
else {
form.b_res_street.value = b_res_street;
form.b_res_city.value = b_res_city;
form.b_res_state.value = b_res_state;
form.b_res_zip.value = b_res_zip;
   }
}

function duplicate2 (form){
if (form.copy2.checked) {
InitSaveVariables (form);
form.cb_res_street.value = form.b_res_street.value;
form.cb_res_city.value = form.b_res_city.value;
form.cb_res_state.value = form.b_res_state.value;
form.cb_res_zip.value = form.b_res_zip.value;
form.cb_phone.value = form.b_phone.value;
form.cb_married.checked = form.b_married.checked;
form.cb_separated.checked = form.b_separated.checked;
form.cb_unmarried.checked = form.b_unmarried.checked;
form.cb_own_home.checked = form.b_own_home.checked;
form.cb_rent_home.checked = form.b_rent_home.checked;
form.cb_yrs_at_res.value = form.b_yrs_at_res.value;

}
else {
form.cb_res_street.value = cb_res_street;
form.cb_res_city.value = cb_res_city;
form.cb_res_state.value = cb_res_state;
form.cb_res_zip.value = cb_res_zip;
form.cb_phone.value = cb_phone;
form.cb_married.checked = cb_married;
form.cb_separated.checked = cb_separated;
form.cb_unmarried.checked = cb_unmarried;
form.cb_own_home.checked = cb_own_home;
form.cb_rent_home.checked = cb_rent_home;
form.cb_yrs_at_res.value = cb_yrs_at_res;

   }
}



function calcincome(form) {

	if ( TE_digit(form.b_base_income.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Borrower's Base Employment Income field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.cb_base_income.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Co-Borrower's Base Employment Income field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.b_overtime_income.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Borrower's Overtime field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.cb_overtime_income.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Co-Borrower's Overtime field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.b_bonus_income.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Borrower's Bonuses field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.cb_bonus_income.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Co-Borrower's Bonuses field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.b_commission_income.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Borrower's Commissions field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.cb_commission_income.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Co-Borrower's Commissions field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.b_dividend_income.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Borrower's Dividends/Interest field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.cb_dividend_income.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Co-Borrower's Dividends/Interest field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.b_rental_income.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Borrower's Net Rental Income field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.cb_rental_income.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Co-Borrower's Net Rental Income field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.b_other_income.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Borrower's Other Income field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.cb_other_income.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Co-Borrower's Other Income field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	form.total_base_income.value = Fix(eval(form.b_base_income.value-0) + (form.cb_base_income.value-0));

	form.total_overtime_income.value = Fix(eval(form.b_overtime_income.value-0) + (form.cb_overtime_income.value-0));

	form.total_bonus_income.value = Fix(eval(form.b_bonus_income.value-0) + (form.cb_bonus_income.value-0));

	form.total_commission_income.value = Fix(eval(form.b_commission_income.value-0) + (form.cb_commission_income.value-0));

	form.total_dividend_income.value = Fix(eval(form.b_dividend_income.value-0) + (form.cb_dividend_income.value-0));

	form.total_rental_income.value = Fix(eval(form.b_rental_income.value-0) + (form.cb_rental_income.value-0));

	form.total_other_income.value = Fix(eval(form.b_other_income.value-0) + (form.cb_other_income.value-0));

	form.b_total_income.value = Fix(eval(form.b_base_income.value-0) + (form.b_overtime_income.value-0) + (form.b_bonus_income.value-0) + (form.b_commission_income.value-0) + (form.b_dividend_income.value-0) + (form.b_rental_income.value-0) + (form.b_other_income.value-0));

	form.cb_total_income.value = Fix(eval(form.cb_base_income.value-0) + (form.cb_overtime_income.value-0) + (form.cb_bonus_income.value-0) + (form.cb_commission_income.value-0) + (form.cb_dividend_income.value-0) + (form.cb_rental_income.value-0) + (form.cb_other_income.value-0));

	form.total_household_income.value = Fix(eval(form.b_total_income.value-0) + (form.cb_total_income.value-0));

}

function calchousing(form) {

	if ( TE_digit(form.housing_expense_rent.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Present Rent field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.current_pi.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Present First Mortgage (P&I) field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.current_other_financing.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Present Other Financing (P&I) field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.current_hazard_insurance.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Present Hazard Insurance field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.current_re_taxes.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Present Real Estate Taxes field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.current_mi.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Present Mortgage Insurance field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.current_hoa_dues.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Present Homeowner Association Dues field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.current_other_expenses.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Present Other Expenses field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	form.current_total_expenses.value = Fix(eval(form.housing_expense_rent.value-0) + (form.current_pi.value-0) + (form.current_other_financing.value-0) + (form.current_hazard_insurance.value-0) + (form.current_re_taxes.value-0) + (form.current_mi.value-0) + (form.current_hoa_dues.value-0) + (form.current_other_expenses.value-0));

}

function calcasset(form) {


if ( TE_digit(form.prop_one_market_value.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Market Value field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

if ( TE_digit(form.prop_two_market_value.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Market Value field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

if ( TE_digit(form.prop_three_market_value.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Market Value field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }


	if ( TE_digit(form.prop_one_gross_rental_income.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Gross Rental Income field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }


         if ( TE_digit(form.prop_one_mort_pymt.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Mortgage Payments field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

 
         if ( TE_digit(form.prop_one_other_expense.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Maint., Taxes, Ins. field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }
 
         if  (form.prop_one_gross_rental_income.value ==  0 ) {                              
                              form.prop_one_net_rental_income.value = "0";
                              } else {
	                                  form.prop_one_net_rental_income.value = Fix(eval(form.prop_one_gross_rental_income.value-0) - (form.prop_one_mort_pymt.value-0) - (form.prop_one_other_expense.value-0));
                                } 
                                      
	if ( TE_digit(form.prop_two_gross_rental_income.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Gross Rental Income field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }


         if ( TE_digit(form.prop_two_mort_pymt.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Mortgage Payments field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

 
         if ( TE_digit(form.prop_two_other_expense.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Maint., Taxes, Ins. field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }
 
         if  (form.prop_two_gross_rental_income.value ==  0 ) {                              
                              form.prop_two_net_rental_income.value = "0";
                              } else {
	                                  form.prop_two_net_rental_income.value = Fix(eval(form.prop_two_gross_rental_income.value-0) - (form.prop_two_mort_pymt.value-0) - (form.prop_two_other_expense.value-0));
                                } 
                                      

	   if ( TE_digit(form.prop_three_gross_rental_income.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Gross Rental Income field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }


         if ( TE_digit(form.prop_three_mort_pymt.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Mortgage Payments field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

 
         if ( TE_digit(form.prop_three_other_expense.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Maint., Taxes, Ins. field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }
 
         if  (form.prop_three_gross_rental_income.value ==  0 ) {                              
                              form.prop_three_net_rental_income.value = "0";
                              } else {
	                                  form.prop_three_net_rental_income.value = Fix(eval(form.prop_three_gross_rental_income.value-0) - (form.prop_three_mort_pymt.value-0) - (form.prop_three_other_expense.value-0));
                                }

	if ( TE_digit(form.deposit_amount.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Amount of Deposit field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.bank_amount_one.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Cash or Market Value field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.bank_amount_two.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Cash or Market Value field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.bank_amount_three.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Cash or Market Value field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.bank_amount_four.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Cash or Market Value field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.stock_value_one.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Cash or Market Value field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.stock_value_two.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Cash or Market Value field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.life_ins_value_one.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Cash or Market Value field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.retirement_fund_value.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Vested Interest in Retirement Fund field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.business_owned_value.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Net Worth Of Business(es) Owned field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.auto_one_value.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Cash or Market Value field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.auto_two_value.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Cash or Market Value field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.auto_three_value.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Cash or Market Value field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.other_assets_value_one.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Cash or Market Value field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.other_assets_value_two.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Cash or Market Value field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.other_assets_value_three.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Cash or Market Value field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	form.subtotal_liquid_assets.value = Fix(eval(form.deposit_amount.value-0) + (form.bank_amount_one.value-0) + (form.bank_amount_two.value-0) + (form.bank_amount_three.value-0) + (form.bank_amount_four.value-0) + (form.stock_value_one.value-0) + (form.stock_value_two.value-0) + (form.life_ins_value_one.value-0));

	form.total_prop_market_value.value = Fix(eval(form.prop_one_market_value.value-0) + (form.prop_two_market_value.value-0) + (form.prop_three_market_value.value-0));

	form.total_prop_mort_lien_value.value = Fix(eval(form.prop_one_mort_lien_value.value-0) + (form.prop_two_mort_lien_value.value-0) + (form.prop_three_mort_lien_value.value-0));

	form.total_prop_gross_rental_income.value = Fix(eval(form.prop_one_gross_rental_income.value-0) + (form.prop_two_gross_rental_income.value-0) + (form.prop_three_gross_rental_income.value-0));

	form.total_prop_mort_pymts.value = Fix(eval(form.prop_one_mort_pymt.value-0) + (form.prop_two_mort_pymt.value-0) + (form.prop_three_mort_pymt.value-0));

	form.total_prop_other_expense.value = Fix(eval(form.prop_one_other_expense.value-0) + (form.prop_two_other_expense.value-0) + (form.prop_three_other_expense.value-0));

	form.total_prop_net_rental_income.value = Fix(eval(form.prop_one_net_rental_income.value-0) + (form.prop_two_net_rental_income.value-0) + (form.prop_three_net_rental_income.value-0));

	form.real_estate_owned_value.value = Fix(eval(form.prop_one_market_value.value-0) + (form.prop_two_market_value.value-0) + (form.prop_three_market_value.value-0));

	form.effective_gross_rent_vacancy_factor.value = Fix(eval(form.total_prop_gross_rental_income.value-0) * (.75));

	form.effective_net_rental_income.value = Fix(eval(form.effective_gross_rent_vacancy_factor.value-0) - (form.total_prop_mort_pymts.value-0) - (form.total_prop_other_expense.value-0));

	form.total_auto_value.value = Fix(eval(form.auto_one_value.value-0) + (form.auto_two_value.value-0) + (form.auto_three_value.value-0));
	
	form.total_other_assets.value = Fix(eval(form.other_assets_value_one.value-0) + (form.other_assets_value_two.value-0) + (form.other_assets_value_three.value-0));

	form.total_all_assets.value = Fix(eval(form.subtotal_liquid_assets.value-0) + (form.total_prop_market_value.value-0) + (form.retirement_fund_value.value-0) + (form.business_owned_value.value-0) + (form.total_auto_value.value-0) + (form.total_other_assets.value-0));

	form.total_net_worth.value = Fix(eval(form.total_all_assets.value-0) - (form.total_liabilities.value-0));

}

function calcliability(form) {

	if ( TE_digit(form.monthly_pymt_one.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Monthly Payment field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.unpaid_balance_one.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Unpaid Balance field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.monthly_pymt_two.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Monthly Payment field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.unpaid_balance_two.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Unpaid Balance field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.monthly_pymt_three.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Monthly Payment field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.unpaid_balance_three.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Unpaid Balance field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.monthly_pymt_four.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Monthly Payment field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.unpaid_balance_four.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Unpaid Balance field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.monthly_pymt_five.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Monthly Payment field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.unpaid_balance_five.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Unpaid Balance field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.monthly_pymt_six.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Monthly Payment field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.unpaid_balance_six.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Unpaid Balance field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.monthly_pymt_seven.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Monthly Payment field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.unpaid_balance_seven.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Unpaid Balance field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.other_monthly_pymt.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Payments Owed To field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	if ( TE_digit(form.job_related_monthly_pymt.value) == false) {
              alert("OOPS!  Only numeric characters (0 through 9) or a decimal point (.) are allowed in the Child Care, Union Dues, ets. field!  Please go back and remove any comma's (,) or dollar signs ($) from this field.");
              return false;                     }

	form.total_liabilities.value = Fix(eval(form.unpaid_balance_one.value-0) + (form.unpaid_balance_two.value-0) + (form.unpaid_balance_three.value-0) + (form.unpaid_balance_four.value-0) + (form.unpaid_balance_five.value-0) + (form.unpaid_balance_six.value-0) + (form.unpaid_balance_seven.value-0));

	form.total_net_worth.value = Fix(eval(form.total_all_assets.value-0) - (form.total_liabilities.value-0));

	form.liabilities_total_monthly_pymts.value = Fix(eval(form.monthly_pymt_one.value-0) + (form.monthly_pymt_two.value-0) + (form.monthly_pymt_three.value-0) + (form.monthly_pymt_four.value-0) + (form.monthly_pymt_five.value-0) + (form.monthly_pymt_six.value-0) + (form.monthly_pymt_seven.value-0) + (form.other_monthly_pymt.value-0) + (form.job_related_monthly_pymt.value-0));

}

function Fix(number) {
        return(Math.round(number*10000000)/10000000);
}

function TE_digit(element) {
         var alpha = "~`!@#$%^&*()_+|-=\{}[]:\;'<>,/?abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

         for ( var o = 0; o < element.length; o++) {
               for ( var i = 0; i < alpha.length; i++) {  
                if ( element.charAt(o) == alpha.charAt(i) ) { return false;} 
                                                      }   
                                                   }
         return true;
                           }



function MM_openBrWindow(theURL,winName,features) { //v2.0

  window.open(theURL,winName,features);

}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.0
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
if(!x && document.getElementById) x=document.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
