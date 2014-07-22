function DisplaySecondLoan(Scenario)
{
if(LI1.style.height == '240pt')
{
LI1.style.height='340pt';
Cell2nd1.style.height='71pt';

/*

Must make sure to specify that these divisions are inside the division LI1 (LoanInput1's major box
these lines go to line 1815 in CompareLoans.php once they are put in css and the height can be adjusted

document.write("<div class='Celly' style='text-align:left;width:10em;height:71pt;background:silver;color:#009;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2nd Term<br \/>");
document.write("&nbsp;<input class='cr' type='radio' name='Term2nd1'  <?php if ($Term2nd1==30) echo checked ?> value='30'>&nbsp;30 Years<br \/>");
document.write("&nbsp;<input class='cr' type='radio' name='Term2nd1'  <?php if ($Term2nd1==25) echo checked ?> value='25'>&nbsp;25 Years<br \/>");
document.write("&nbsp;<input class='cr' type='radio' name='Term2nd1'  <?php if ($Term2nd1==15) echo checked ?> value='15'>&nbsp;15 Years<\/div>");
document.write("<div class='Celly' style='text-align:left;width:9.5em;height:71pt;background:silver;color:#009;'>");
document.write("2nd Rate<br \/><input class='c' type='text' name='Rate2nd1' style='text-align:right;' size='4' value='<?php echo $Rate2nd1 ?>'>%<br \/>");
document.write("<input class='cr' type='checkbox' name='HELOC2nd1' onclick='document.F.HELOC2nd1.value='Y'' <?php if ($HELOC2nd1=='Y') echo checked ?> value=<?php echo $HELOC2nd1 ?>>HELOC<\/div>");
document.write("<div class='Celly' style='height:71pt;background:silver;color:#009;'>");
document.write("HELOC Details<br \/>&nbsp;Index&nbsp;<input class='c' type='text' name='Index2nd1' style='text-align:right;'");
document.write("size='4' value='<?php echo $Index2nd1 ?>'>%<br \/>Margin&nbsp;<input class='c' type='text' name='Margin2nd1' ");
document.write("style='text-align:right;' size='4' value='<?php echo $Margin2nd1 ?>'>%<\/div>");
document.write("<div class='Celly' style='height:71pt;background:silver;color:#009;'>HELOC Caps<br \/>");
document.write("First&nbsp;<input class='c' type='text' name='First2nd1' style='text-align:right;' size='3'"); 
document.write("value='<?php echo $First2nd1 ?>'>%<br \/>");
document.write("&nbsp;Each&nbsp;<input class='c' type='text' name='Each2nd1' style='text-align:right;' size='3'"); 
document.write("value='<?php echo $Each2nd1 ?>'>%<br \/>");
document.write("&nbsp;Life&nbsp;<input class='c' type='text' name='Life2nd1' style='text-align:right;' size='3'"); 
document.write("value='<?php echo $Life2nd1 ?>'>%<\/div>");
*/
}
else
{
LI1.style.height='240pt';
Cell2nd1.style.height='0';
}
}

/*

Sets a cookie

*/

function SetMyValue(CName, CVal)
{
var ExpDate=new Date().toGMTString();
var Exp = ExpDate.replace("2004", "2005");
//alert("Name: "+CName+ " Value: "+CVal+" Date: "+Exp);

document.cookie=CName+'='+CVal+';';
//document.cookie=CName+'='+CVal+';expires='+ExpDate;
}

/*

Gets the value of a cookie

*/

function GetMyValue (CookieName)
{
var CName, Value;
var Beginning, Middle, End;

alert ("GetMyValue() was passed CookieName=" + CookieName);

//if there is an entry for this cookie show it to me
Beginning = 0;

while (Beginning < document.cookie.length)
{
	// find the next equals sign
	Middle = document.cookie.indexOf('=', Beginning);

	// find the next semicolon
	End = document.cookie.indexOf(';', Beginning);

	if (End == -1)	// if no semicolon exists, it's the last cookie...
		End = document.cookie.length;

	// if nothing is in the cookie, blank out it's value
	if ((Middle > End) || (Middle == -1))
	{
		CName = document.cookie.substring(Beginning, End);
		Value = "";
	}
	else
	{
		//extract the Name and value
		CName = document.cookie.substring(Beginning, Middle);
		Value = document.cookie.substring(Middle + 1, End);
	}
	// add the cookie to the associative array
	cookies[CName] = unescape(Value);
	// jump over the next space to the Beginning of next cookie
	Beginning = End + 2;
}

	alert('GetMyValue() returns --> cookies[' + CookieName + ']=' + cookies[CookieName]);
	return(cookies[CookieName]);
}

// Insure that all required fields exist

/*

validates the form

*/

function Validate()
{
	//alert("validating...");
    if ((document.F.Balance1.value == null) || (document.F.Balance1.length == 0) || (document.F.Balance1.value == 0))
    {
	  alert("Please enter Loan Scenario One's ("+document.F.Name1.value+") Principal Balance");
	  document.F.Balance1.focus();
      document.F.Balance1.select();
      return (false);
    }
    if ((document.F.Rate1.value == null) || (document.F.Rate1.length == 0) || (document.F.Rate1.value == 0))
    {
	  alert("Please enter Loan Scenario One's ("+document.F.Name1.value+") Interest Rate");
	  document.F.Rate1.style.background="#ff0000";
	  document.F.Rate1.style.value="99000";
	  document.F.Rate1.focus();
      document.F.Rate1.select();
      return (false);
    }

    if ((document.F.Balance2.value == null) || (document.F.Balance2.length == 0) || (document.F.Balance2.value == 0) ||
      (document.F.Rate2.value == null) || (document.F.Rate2.length == 0) || (document.F.Rate2.value == 0))
    {
	  alert("Please enter the Principal Balance and Interest Rate for loan 2 in the comparison");
	  document.F.Balance2.focus();
      document.F.Balance2.select();
      return (false);
    }
	//alert("validated...1");
	// if first two Term radio buttons (30- and 15-year term) are not checked
	
	if ((document.F.Term1[0].checked==false) && (document.F.Term1[1].checked==false)) 
	{
		if ((document.F.Index1.value == null) || (document.F.Index1.value == 0) || (document.F.Index1.length == 0) ||
	    (document.F.Margin1.value == null) || (document.F.Margin1.value == 0) || (document.F.Margin1.length == 0))
		{
		  alert("Loan 1 ARM comparisons must include the index rate and margin");
		  document.F.Index1.focus();
    	  document.F.Index1.select();
		  return (false);	
		}
	}
	//alert("validated...2");
	// if first two Term radio buttons (30- and 15-year term) are not checked
	/*
	for (var i = 0; i < document.F.Term2.length; i++)
	if (document.F.Term2[i].checked)
	{
		alert("$Term2[0]: "+document.F.Term2[0].value+" checked? "+document.F.Term2[0].checked);
		alert("$Term2[1]: "+document.F.Term2[1].value+" checked? "+document.F.Term2[1].checked);
		alert("$Term2["+i+"]: "+document.F.Term2[i].value+" checked? "+document.F.Term2[i].checked);
	}
	
	*/
	if ((document.F.Term2[0].checked==false) && (document.F.Term2[1].checked==false)) 
	{
	//alert("xxxxxxxxxxx");
		if ((document.F.Index2.value == null) || (document.F.Index2.length == 0) ||
		    (document.F.Margin2.value == null) || (document.F.Margin2.length == 0))
		{
		  alert("Loan 2 ARM comparisons must include the index rate and margin");
		  document.F.Index2.focus();
    	  document.F.Index2.select();
		  return (false);	
		}
		
	}
	
	//alert("pppppppppp");
	
	//alert("validated...3. document.F.NextLoan2.value |"+document.F.NextLoan2.value+"|");
    if (!(document.F.NextLoan2.value == null) && (document.F.NextLoan2.value == "Y"))
	{
      if ((document.F.Balance3.value == null) || (document.F.Balance3.value=="") || (document.F.Balance3.value == 0) ||
      (document.F.Rate3.value == null) && (document.F.Rate3.value=="") || (document.F.Rate3.value == 0))
    	{
		  alert("Please enter the Principal Balance and Interest Rate for loan 3 in the comparison");
		  document.F.Principal3.focus();
    	  document.F.Principal3.select();
    	  return (false);
    	} 
		
		/*
		for (var i = 0; i < document.F.Term3.length; i++)
		if (document.F.Term3[i].checked)
		{
			alert("$Term3[0]: "+document.F.Term3[0].value+" checked? "+document.F.Term3[0].checked);
			alert("$Term3[1]: "+document.F.Term3[1].value+" checked? "+document.F.Term3[1].checked);
			alert("$Term3["+i+"]: "+document.F.Term3[i].value+" checked? "+document.F.Term3[i].checked);
		}
		*/		
		// if first two Term radio buttons (30- and 15-year term) are not checked
	
		if ((document.F.Term3[0].checked==false) && (document.F.Term3[1].checked==false)) 
		{
			if ((document.F.Index3.value == null) || (document.F.Index3.value == 0) || (document.F.Index3.value=="") ||
	 	   (document.F.Margin3.value == null) || (document.F.Margin3.value == 0) || (document.F.Margin3.value==""))
			{
			  alert("Loan 3 ARM comparisons must include the index rate and margin");
			  document.F.Index3.focus();
    		  document.F.Index3.select();
			  return (false);
			}	
	    }
	}
	//alert("validated...4.")
	if((document.F.NextLoan2.checked == true) && (document.F.NextLoan3.checked == true))
	{
	  //alert("document.F.NextLoan3.value is true");
	  
      if ((document.F.Balance4.value == null) || (document.F.Balance4.value=="") || (document.F.Balance4.value == 0) ||
      (document.F.Rate4.value == null) || (document.F.Rate4.value=="") || (document.F.Rate4.value == 0))
      {
	   alert("Please enter the Principal Balance and Interest Rate for loan 4 in the comparison");
	   document.F.Principal4.focus();
  	   document.F.Principal4.select();	   
       return (false);
      }
	
	  // if first two Term radio buttons (30- and 15-year term) are not checked
	
	  if ((document.F.Term4[0].checked==false) && (document.F.Term4[1].checked==false)) 
	  {
		if ((document.F.Index4.value == null) || (document.F.Index4.value == 0) || (document.F.Index4.value=="") ||
	    (document.F.Margin4.value == null) || (document.F.Margin4.value == 0) || (document.F.Margin4.value==""))
		{
		  alert("Loan 4 ARM comparisons must include the index rate and margin");
		  document.F.Index4.focus();
    	  document.F.Index4.select();
		  return (false);	
		}
	  }
	}

  //alert("Loan comparison: "+ document.F.Cyears.value + " years");

	if ((document.F.Cyears.value < 1) || (document.F.Cyears.value > 40))
	{
	  alert("Loan comparisons must be between 1 and 40 years");
	  document.F.Cyears.focus();
      document.F.Cyears.select();
	  return (false);
	}

	document.F.Ready.value='Y';
	//alert("validated...");
	return(true);  
}


/*

These functions are for copying, pasting, and clearing loan scenarios

*/

var SavedName="undefined", SavedBalance2nd, SavedRate2nd, SavedPropValue, SavedBalance, SavedIO, SavedRate, SavedIndex, SavedMargin, SavedProjection, SavedFirst, SavedEach, SavedLife, SavedNRCC, SavedPPitems, SavedPoints, SavedPMI, SavedInsurance, SavedTaxes;
var SavedTerm = new Array(7);
var SavedTerm2nd = new Array(2);

// -- -- -- -- -- -- -- -- Clear Scenario -- -- -- -- -- -- -- --
function ClearScenario(ScenarioNo)
{
var i;

if (ScenarioNo == 1)
{
if (document.F.Second1.value=="Y") { document.F.Balance2nd1.value=""; document.F.Rate2nd1.value=""; }
document.F.Name1.value = ""; document.F.PropValue.value = ""; document.F.DebtPaid.value = ""; document.F.Balance1.value = ""; document.F.IO1.value = ""; document.F.Rate1.value = ""; 
for (i = 0; i < 7; i++)
{
  document.F.Term1[i].value = ""; 
  document.F.Term1[i].checked = false; 
}
if (document.F.Second1.value=="Y")
for (i = 0; i < 2; i++)
{
  document.F.Term2nd1[i].value = ""; 
  document.F.Term2nd1[i].checked = false; 
}
document.F.Index1.value = ""; document.F.Margin1.value = ""; document.F.Projection1.value = ""; document.F.First1.value = ""; document.F.Each1.value = ""; document.F.Life1.value = ""; document.F.NRCC1.value = ""; document.F.PPitems1.value = ""; document.F.Points1.value = ""; document.F.PMI1.value = ""; document.F.Insurance1.value = ""; document.F.Taxes1.value = "";
}
if (ScenarioNo == 2)
{
if (document.F.Second2.value=="Y") { document.F.Balance2nd2.value=""; document.F.Rate2nd2.value=""; }
document.F.Name2.value = ""; document.F.Balance2.value = ""; document.F.IO2.value = ""; document.F.Rate2.value = "";
for (i = 0; i < 7; i++)
{
  document.F.Term2[i].value = ""; 
  document.F.Term2[i].checked = false; 
}
if (document.F.Second2.value=="Y")
for (i = 0; i < 2; i++)
{
  document.F.Term2nd2[i].value = ""; 
  document.F.Term2nd2[i].checked = false; 
}
document.F.Index2.value = ""; document.F.Margin2.value = ""; document.F.Projection2.value = ""; document.F.First2.value = ""; document.F.Each2.value = ""; document.F.Life2.value = ""; document.F.NRCC2.value = ""; document.F.PPitems2.value = ""; document.F.Points2.value = ""; document.F.PMI2.value = ""; document.F.Insurance2.value = ""; document.F.Taxes2.value = "";
}
if (ScenarioNo == 3)
{
if (document.F.Second3.value=="Y") { document.F.Balance2nd3.value=""; document.F.Rate2nd3.value=""; }
document.F.Name3.value = ""; document.F.Balance3.value = ""; document.F.IO3.value = ""; document.F.Rate3.value = "";
for (i = 0; i < 7; i++)
{
  document.F.Term3[i].value = ""; 
  document.F.Term3[i].checked = false; 
}
if (document.F.Second3.value=="Y")
for (i = 0; i < 2; i++)
{
  document.F.Term2nd3[i].value = ""; 
  document.F.Term2nd3[i].checked = false; 
}
document.F.Index3.value = ""; document.F.Margin3.value = ""; document.F.Projection3.value = ""; document.F.First3.value = ""; document.F.Each3.value = ""; document.F.Life3.value = ""; document.F.NRCC3.value = ""; document.F.PPitems3.value = ""; document.F.Points3.value = ""; document.F.PMI3.value = ""; document.F.Insurance3.value = ""; document.F.Taxes3.value = "";
}
if (ScenarioNo == 4)
{
if (document.F.Second4.value=="Y") { document.F.Balance2nd4.value=""; document.F.Rate2nd4.value=""; }
document.F.Name4.value = ""; document.F.Balance4.value = ""; document.F.IO4.value = ""; document.F.Rate4.value = "";
for (i = 0; i < 7; i++)
{
  document.F.Term4[i].value = ""; 
  document.F.Term4[i].checked = false; 
}
if (document.F.Second4.value=="Y")
for (i = 0; i < 2; i++)
{
  document.F.Term2nd4[i].value = ""; 
  document.F.Term2nd4[i].checked = false; 
}
document.F.Index4.value = ""; document.F.Margin4.value = ""; document.F.Projection4.value = ""; document.F.First4.value = ""; document.F.Each4.value = ""; document.F.Life4.value = ""; document.F.NRCC4.value = ""; document.F.PPitems4.value = ""; document.F.Points4.value = ""; document.F.PMI4.value = ""; document.F.Insurance4.value = ""; document.F.Taxes4.value = "";
}
}
// -- -- -- -- -- -- -- -- Copy Scenario -- -- -- -- -- -- -- --
function CopyScenario(ScenarioNo)
{
var i;
SavedBalance2nd="";
SavedRate2nd="";

if (ScenarioNo == 1)
{
if(document.F.Second1.value == "Y") 
{
SavedBalance2nd = document.F.Balance2nd1.value; 
SavedRate2nd = document.F.Rate2nd1.value; 
}
SavedName = document.F.Name1.value; 
SavedPropValue = document.F.PropValue.value; 
SavedBalance = document.F.Balance1.value; 
SavedIO = document.F.IO1.value; 
SavedRate = document.F.Rate1.value; 
for (i = 0; i < 7; i++)
  if (document.F.Term1[i].checked)
  {
    SavedTerm[i] = document.F.Term1[i].value;
    //alert("SavedTerm["+i+"]: "+SavedTerm[i]);
  }
  else
    SavedTerm[i] = "";
for (i = 0; i < 2; i++)
if(document.F.Second1.value == "Y") 
  if (document.F.Term2nd1[i].checked)
  {
    SavedTerm2nd[i] = document.F.Term2nd1[i].value;
  }
  else
    SavedTerm2nd[i] = "";
else
  SavedTerm2nd[i] = "";

SavedIndex = document.F.Index1.value; 
SavedMargin = document.F.Margin1.value; 
SavedProjection = document.F.Projection1.value; 
SavedFirst = document.F.First1.value; 
SavedEach = document.F.Each1.value; 
SavedLife = document.F.Life1.value; 
SavedNRCC = document.F.NRCC1.value; 
SavedPPitems = document.F.PPitems1.value; 
SavedPoints = document.F.Points1.value; 
SavedPMI = document.F.PMI1.value; 
SavedInsurance = document.F.Insurance1.value; 
SavedTaxes = document.F.Taxes1.value;
}
if (ScenarioNo == 2)
{
if(document.F.Second2.value == "Y") 
{
SavedBalance2nd = document.F.Balance2nd2.value; 
SavedRate2nd = document.F.Rate2nd2.value; 
}
SavedName = document.F.Name2.value; 
SavedBalance = document.F.Balance2.value; 
SavedIO = document.F.IO2.value; 
SavedRate = document.F.Rate2.value; 
for (i = 0; i < 7; i++)
  if (document.F.Term2[i].checked)
  {
    SavedTerm[i] = document.F.Term2[i].value;
    //alert("SavedTerm["+i+"]: "+SavedTerm[i]);
  }
  else
    SavedTerm[i] = "";
for (i = 0; i < 2; i++)
if(document.F.Second2.value == "Y") 
  if (document.F.Term2nd2[i].checked)
  {
    SavedTerm2nd[i] = document.F.Term2nd2[i].value;
  }
  else
    SavedTerm2nd[i] = "";
else
  SavedTerm2nd[i] = "";

SavedIndex = document.F.Index2.value; 
SavedMargin = document.F.Margin2.value; 
SavedProjection = document.F.Projection2.value; 
SavedFirst = document.F.First2.value; 
SavedEach = document.F.Each2.value; 
SavedLife = document.F.Life2.value; 
SavedNRCC = document.F.NRCC2.value; 
SavedPPitems = document.F.PPitems2.value; 
SavedPoints = document.F.Points2.value; 
SavedPMI = document.F.PMI2.value; 
SavedInsurance = document.F.Insurance2.value; 
SavedTaxes = document.F.Taxes2.value;
}
if (ScenarioNo == 3)
{
if(document.F.Second3.value == "Y") 
{
SavedBalance2nd = document.F.Balance2nd3.value; 
SavedRate2nd = document.F.Rate2nd3.value; 
}
SavedName = document.F.Name3.value; 
SavedBalance = document.F.Balance3.value; 
SavedIO = document.F.IO3.value; 
SavedRate = document.F.Rate3.value; 
for (i = 0; i < 7; i++)
  if (document.F.Term3[i].checked)
  {
    SavedTerm[i] = document.F.Term3[i].value;
    //alert("SavedTerm["+i+"]: "+SavedTerm[i]);
  }
  else
    SavedTerm[i] = "";
for (i = 0; i < 2; i++)
if(document.F.Second3.value == "Y") 
  if (document.F.Term2nd3[i].checked)
  {
    SavedTerm2nd[i] = document.F.Term2nd3[i].value;
  }
  else
    SavedTerm2nd[i] = "";
else
  SavedTerm2nd[i] = "";

SavedIndex = document.F.Index3.value; 
SavedMargin = document.F.Margin3.value; 
SavedProjection = document.F.Projection3.value; 
SavedFirst = document.F.First3.value; 
SavedEach = document.F.Each3.value; 
SavedLife = document.F.Life3.value; 
SavedNRCC = document.F.NRCC3.value; 
SavedPPitems = document.F.PPitems3.value; 
SavedPoints = document.F.Points3.value; 
SavedPMI = document.F.PMI3.value; 
SavedInsurance = document.F.Insurance3.value; 
SavedTaxes = document.F.Taxes3.value;
}
if (ScenarioNo == 4)
{
if(document.F.Second4.value == "Y") 
{
SavedBalance2nd = document.F.Balance2nd4.value; 
SavedRate2nd = document.F.Rate2nd4.value; 
}
SavedName = document.F.Name4.value; 
SavedBalance = document.F.Balance4.value; 
SavedIO = document.F.IO4.value; 
SavedRate = document.F.Rate4.value; 
for (i = 0; i < 7; i++)
  if (document.F.Term4[i].checked)
  {
    SavedTerm[i] = document.F.Term4[i].value;
    //alert("SavedTerm["+i+"]: "+SavedTerm[i]);
  }
  else
    SavedTerm[i] = "";
for (i = 0; i < 2; i++)
if(document.F.Second4.value == "Y") 
  if (document.F.Term2nd4[i].checked)
  {
    SavedTerm2nd[i] = document.F.Term2nd4[i].value;
  }
  else
    SavedTerm2nd[i] = "";
else
  SavedTerm2nd[i] = "";

SavedIndex = document.F.Index4.value; 
SavedMargin = document.F.Margin4.value; 
SavedProjection = document.F.Projection4.value; 
SavedFirst = document.F.First4.value; 
SavedEach = document.F.Each4.value; 
SavedLife = document.F.Life4.value; 
SavedNRCC = document.F.NRCC4.value; 
SavedPPitems = document.F.PPitems4.value; 
SavedPoints = document.F.Points4.value; 
SavedPMI = document.F.PMI4.value; 
SavedInsurance = document.F.Insurance4.value; 
SavedTaxes = document.F.Taxes4.value;
}
}
// -- -- -- -- -- -- -- -- Paste Scenario -- -- -- -- -- -- -- --
function PasteScenario(ScenarioNo)
{
var i;

if (SavedName == "undefined")
  return;
if (ScenarioNo == 1)
{
document.F.Balance2nd1.value = SavedBalance2nd; 
document.F.Rate2nd1.value = SavedRate2nd; 
document.F.Name1.value = SavedName; 
document.F.Balance1.value = SavedBalance; 
document.F.IO1.value = SavedIO; 
document.F.Rate1.value = SavedRate; 
for (i = 0; i < 7; i++)
  if (SavedTerm[i] != "")
  {
    document.F.Term1[i].value = SavedTerm[i];
	document.F.Term1[i].click();
  }
for (i = 0; i < 2; i++)
  if (SavedTerm2nd[i] != "")
  {
    document.F.Term2nd1[i].value = SavedTerm2nd[i];
	document.F.Term2nd1[i].click();
  }
document.F.Index1.value = SavedIndex; 
document.F.Margin1.value = SavedMargin; 
document.F.Projection1.value = SavedProjection; 
document.F.First1.value = SavedFirst; 
document.F.Each1.value = SavedEach; 
document.F.Life1.value = SavedLife; 
document.F.NRCC1.value = SavedNRCC; 
document.F.PPitems1.value = SavedPPitems; 
document.F.Points1.value = SavedPoints; 
document.F.PMI1.value = SavedPMI; 
document.F.Insurance1.value = SavedInsurance; 
document.F.Taxes1.value = SavedTaxes;
}
if (ScenarioNo == 2)
{
document.F.Balance2nd2.value = SavedBalance2nd; 
document.F.Rate2nd2.value = SavedRate2nd; 
document.F.Name2.value = SavedName; 
document.F.Balance2.value = SavedBalance; 
document.F.IO2.value = SavedIO; 
document.F.Rate2.value = SavedRate; 
for (i = 0; i < 7; i++)
  if (SavedTerm[i] != "")
  {
    document.F.Term2[i].value = SavedTerm[i];
	document.F.Term2[i].click();
  }
for (i = 0; i < 2; i++)
  if (SavedTerm2nd[i] != "")
  {
    document.F.Term2nd2[i].value = SavedTerm2nd[i];
	document.F.Term2nd2[i].click();
  }
document.F.Index2.value = SavedIndex; 
document.F.Margin2.value = SavedMargin; 
document.F.Projection2.value = SavedProjection; 
document.F.First2.value = SavedFirst; 
document.F.Each2.value = SavedEach; 
document.F.Life2.value = SavedLife; 
document.F.NRCC2.value = SavedNRCC; 
document.F.PPitems2.value = SavedPPitems; 
document.F.Points2.value = SavedPoints; 
document.F.PMI2.value = SavedPMI; 
document.F.Insurance2.value = SavedInsurance; 
document.F.Taxes2.value = SavedTaxes;
}
if (ScenarioNo == 3)
{
document.F.Balance2nd3.value = SavedBalance2nd; 
document.F.Rate2nd3.value = SavedRate2nd; 
document.F.Name3.value = SavedName; 
document.F.Balance3.value = SavedBalance; 
document.F.IO3.value = SavedIO; 
document.F.Rate3.value = SavedRate; 
for (i = 0; i < 7; i++)
  if (SavedTerm[i] != "")
  {
    document.F.Term3[i].value = SavedTerm[i];
	document.F.Term3[i].click();
  }
for (i = 0; i < 2; i++)
  if (SavedTerm2nd[i] != "")
  {
    document.F.Term2nd3[i].value = SavedTerm2nd[i];
	document.F.Term2nd3[i].click();
  }
document.F.Index3.value = SavedIndex; 
document.F.Margin3.value = SavedMargin; 
document.F.Projection3.value = SavedProjection; 
document.F.First3.value = SavedFirst; 
document.F.Each3.value = SavedEach; 
document.F.Life3.value = SavedLife; 
document.F.NRCC3.value = SavedNRCC; 
document.F.PPitems3.value = SavedPPitems; 
document.F.Points3.value = SavedPoints; 
document.F.PMI3.value = SavedPMI; 
document.F.Insurance3.value = SavedInsurance; 
document.F.Taxes3.value = SavedTaxes;
}
if (ScenarioNo == 4)
{
document.F.Balance2nd4.value = SavedBalance2nd; 
document.F.Rate2nd4.value = SavedRate2nd; 
document.F.Name4.value = SavedName; 
document.F.Balance4.value = SavedBalance; 
document.F.IO4.value = SavedIO; 
document.F.Rate4.value = SavedRate; 
for (i = 0; i < 7; i++)
  if (SavedTerm[i] != "")
  {
    document.F.Term4[i].value = SavedTerm[i];
	document.F.Term4[i].click();
  }
for (i = 0; i < 2; i++)
  if (SavedTerm2nd[i] != "")
  {
    document.F.Term2nd4[i].value = SavedTerm2nd[i];
	document.F.Term2nd4[i].click();
  }
document.F.Index4.value = SavedIndex; 
document.F.Margin4.value = SavedMargin; 
document.F.Projection4.value = SavedProjection; 
document.F.First4.value = SavedFirst; 
document.F.Each4.value = SavedEach; 
document.F.Life4.value = SavedLife; 
document.F.NRCC4.value = SavedNRCC; 
document.F.PPitems4.value = SavedPPitems; 
document.F.Points4.value = SavedPoints; 
document.F.PMI4.value = SavedPMI; 
document.F.Insurance4.value = SavedInsurance; 
document.F.Taxes4.value = SavedTaxes;
}
}