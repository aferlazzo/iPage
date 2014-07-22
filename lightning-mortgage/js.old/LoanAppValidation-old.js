
// debug can be either 'none', 'alert', or 'textarea' depending 
// on the kind of debugging I want to do
// If set to 'textarea' then display debugging messages in the loan application's 'Situation' text area field

var debug="none";

var redirectString;
var alphaChars="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ. ";
var numChars="0123456789-";
var error;
var error_n;  // name
var error_cn; // co_name
var CoSpaceFound;
var error_ad; // address
var error_st; // State
var error_m;  // e-mail
var error_z;  // zipcode
var error_c;  // city
var error_s;  // SSN
var error_cs; // co_SSN
var error_hp; // home phone
var error_wp; // work phone
var error_p;  // price
var error_pt; // property type
var error_v;  // estimated value
var error_i;  // interest rate
var error_b;  // loan balance
var error_im; // impounds
var errormsg;


//- - - - Customize if input requirements change - - - - - - - - - - - - - - - -

var isNameReq=true;     // True if ApplicantName field required else False
var isStreetReq=true;   // True if Street field (called 'Street') required else False
var isemailReq=true;    // True if email required else False
var isZipReq=true;      // True if Zip required else False
var isCityReq=true;     // True if City required else False
var isStateReq=true;    // True if State required else False

var isSSReq=true;       // True if social security # required else False
var isCoSSReq=false;    // True if social security # required else False

var isPriceReq=true;    // True if purchase price required else False
var isPTypeReq=true;    // True if property type required else False
var isValueReq=true;    // True if estimated value required else False
var isInterestReq=true; // True if Interest Rate is required else False
var isBalanceReq=true;  // True if Balance is required else False

var isHphoneReq=false;  // True if home phone is required else False
var isWphoneReq=false;  // True if work phone is required else False

/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
/*																														*/
/*																														*/
/*	Create prototype functions for string trimming 																		*/
/* 																														*/
/*	Regular Expression syntax is used to match patterns and delete them from the left and right sides of strings		*/
/*																														*/
/*	The regular expression /^\s+/ is translated to:	any whitespace character at the beginning of a string.				*/
/*																														*/
/*	The regular expression /^\s+/ is translated to:	any whitespace character at the end of a string.					*/
/*																														*/
/*			/ - The forward slash character	is the brackets. This begins and ends the Regular Expression				*/
/*			    character class.																						*/
/*																														*/
/*			^ - A "Regular Expression" positional symbol. This means "At the beginning (left) of the string"			*/
/*			\s - Any whitespace character. Same as [\t\n\r\f\v]															*/
/*			+ - A "Regular Expression" repetition symbol that means one or more of the previous item					*/
/*																														*/
/*			/ - The forward slash character	is the ending "bracket." for the Regular Expression							*/
/*			    character class.																						*/
/*																														*/
/*			$ - A "Regular Expression" positional symbol. This means "At the end (right) of the string"					*/
/*																														*/
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/


function strltrim() {
    return this.replace(/^\s+/,'');
}

function strrtrim() {
    return this.replace(/\s+$/,'');
}
function strtrim() {
    return this.replace(/^\s+/,'').replace(/\s+$/,'');
}

String.prototype.ltrim = strltrim;
String.prototype.rtrim = strrtrim;
String.prototype.trim  = strtrim;




//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// doError is the error handling routine
// depending on the type of debug message
// it presents either no debug message, an alert
// or puts the message in a textarea
//

function doError(the_message)
{
   if (debug == "alert")
   {
	alert(the_message);
   }
   else if (debug == "textarea")
        {
          document.main.Situation.value += the_message + "\n";
        }
}
// - - - - - - - - - - - - - -
function reset_error()
{
 doError("reset_error() start");
 error_n=false;
 error_cn=false;
 CoSpaceFound="n";
 error_ad=false;
 error_st=false;
 error_m=false;
 error_z=false;
 error_c=false;
 error_s=false;
 error_cs=false;
 error_hp=false;
 error_wp=false;
 error_p=false; 
 error_pt=false;
 error_v=false;
 error_i=false;
 error_b=false;
 error_im=false;
 
 errormsg='Following Errors Occured ::\n_____________________________\n\n';
}

/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
/*									 */
/* Make sure the Applicant's Name field has been entered.                */
/* If it has, it cannot contain numbers                                  */
/* If it does contain invalid characters, display the appropriate error  */
/*									 */
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */

function validate_name()
{
 var SpaceFound="n";
 
 doError("Start validate_name, ApplicantName = |" + document.main.ApplicantName.value + "|");
 
 if(isNameReq)
 {
  document.main.ApplicantName.value = document.main.ApplicantName.value.trim(); // erase leading/training whitespace
  /*******************
  if(document.main.ApplicantName.value=="")	// Examine the field. If not entered...
  {
   errormsg+='Please enter your Name.\n';	// ...in form the user
   error_n=true;
   document.main.ApplicantName.focus();		// ...and put the cursor in the field
   document.main.ApplicantName.select();
   SpaceFound="y";
  }
  ********************/
 }

 for(var i=0; i<document.main.ApplicantName.value.length; i++)
 {
  for(var j=0; j<alphaChars.length; j++)
  {
   if(alphaChars.charAt(j)==" ")	// A switch to later make sure there is at least two separate blocks of characters
   {
      SpaceFound="y";
   }
  
   if(alphaChars.charAt(j)==document.main.ApplicantName.value.charAt(i))
   {
    break;
   }

   if(j==(alphaChars.length-1))
   {
       errormsg+='"' + document.main.ApplicantName.value.charAt(i) + '"' + ' is an invalid character for Name.\n';
       error_n=true;
   }

   if(error_n)
   {
    document.main.ApplicantName.select();
   }
  }
 }
 
 if (SpaceFound != "y" && isNameReq==true && document.main.ApplicantName.value != "")
 {
     errormsg+='Please enter your first and last name in the field (separated with a space).\n';
     error_n=true;
     document.main.ApplicantName.focus();
     document.main.ApplicantName.select();     
 }
}

/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
/*									 */
/* Make sure the CoApplicant's Name field has been entered correctly if  */
/* entered.  If it has, it cannot contain numbers       		 */
/* If it does, display the appropriate error  				 */
/*									 */
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */

function validate_co_name()
{
 CoSpaceFound="n";
 
 doError("Start validate_co_name, Co_ApplicantName = |" + document.main.Co_ApplicantName.value + "|");

 document.main.Co_ApplicantName.value = document.main.Co_ApplicantName.value.trim();
  
 if(document.main.Co_ApplicantName.value=="") /* if no Co_Applicant, just return from the function */
 {
   return;
 }
 

 for(var i=0; i<document.main.Co_ApplicantName.value.length; i++)
 {
  for(var j=0; j<alphaChars.length; j++)
  {
   if(alphaChars.charAt(j)==" ")
   {
      CoSpaceFound="y";
   }
  
   if(alphaChars.charAt(j)==document.main.Co_ApplicantName.value.charAt(i))
   {
    break;
   }

   if(j==(alphaChars.length-1))
   {
       errormsg+='"' + document.main.Co_ApplicantName.value.charAt(i) + '"' + ' is an invalid character for Co-Borrower Name.\n';
       error_cn=true;
   }

   if(error_cn)
   {
    document.main.Co_ApplicantName.focus();
    document.main.Co_ApplicantName.select();
   }
  }
 } 
 
 if (CoSpaceFound=="n") /* if something was entered ... */
 {
     errormsg+="Please enter coApplicatant's first and last name in the field.\n";
     error_cn=true;
     document.main.Co_ApplicantName.focus();
     document.main.Co_ApplicantName.select();
 }
}

/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
/*									 */
/* Make sure the PropertyCity field has been entered. 			 */
/* If it has, it can contain only alpha characters    			 */
/* If it does, display the appropriate error          			 */
/*									 */
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */

function validate_city()
{
 doError("Start validate_city, PropertyCity = |" + document.main.PropertyCity.value + "|");
 if(isCityReq)
 {
  document.main.PropertyCity.value = document.main.PropertyCity.value.trim();
  
  if(document.main.PropertyCity.value=="")
  {
   errormsg+='Please enter the City.\n';
   error_c=true;
   if((!error_n)&&(!error_ad)){
     document.main.PropertyCity.focus();
     document.main.PropertyCity.select();
   }
  }
 }
 for(var i=0; i<document.main.PropertyCity.value.length; i++)
 {
  for(var j=0; j<alphaChars.length; j++)
  {
   if(alphaChars.charAt(j)==document.main.PropertyCity.value.charAt(i))
   {
    break;
   }
   else
   {
    if(j==(alphaChars.length-1))
    {
     errormsg+='"' + document.main.PropertyCity.value.charAt(i) + '"' + ' is an invalid character for City.\n';
     error_c=true;
    }
   }
   if(error_c)
   {
     if((!error_n)&&(!error_ad)){
       document.main.PropertyCity.focus();
       document.main.PropertyCity.select();
     }
   }
  }
 }
}



/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
/*									 */
/* Make sure the Street (Street field) has been entered.  		 */
/* If it does, display the appropriate error              		 */
/*									 */
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */

function validate_Street()
{
  var SpaceFound="n";
  var AlphaNumericChars = alphaChars + numChars;

 doError("Start validate_Street, Street = |" + document.main.Street.value + "|");
 
 if(isStreetReq)
 {
  document.main.Street.value = document.main.Street.value.trim();

  if(document.main.Street.value=="")
  {
   errormsg+='Please enter your Street Address.\n';
   error_ad=true;
   
   if(!error_n)
   {
    document.main.Street.focus();
    document.main.Street.select();
   }
  }
 }
 
 
 for(var i=0; i<document.main.Street.value.length; i++)
 {
  for(var j=0; j<AlphaNumericChars.length; j++)
  {
   // A switch to later make sure there is at least three separate blocks of characters
   // SpaceFound Legend:
   // n = no space
   // y = 1 space found
   // z = 2 paces found
   
   if(alphaChars.charAt(j)==" " && SpaceFound=="y" && alphaChars.charAt(j-1)!=" ") 
   {
      SpaceFound="z";
   }

   if(alphaChars.charAt(j)==" " && SpaceFound=="n") // A switch to later make sure there is at least three separate blocks of characters
   {
      SpaceFound="y";
   }
   
  
   if(AlphaNumericChars.charAt(j)==document.main.Street.value.charAt(i))
   {
    break;
   }
   else
   {
    if(j==(AlphaNumericChars.length-1))
    {
     errormsg+='"' + document.main.Street.value.charAt(i) + '"' + ' is an invalid character for Street.\n';
     error_ad=true;
    }
   }
   if(error_c)
   {
     if(!error_n)
     {
       document.main.Street.focus();
       document.main.Street.select();
     }
   }
  }
 }
 
 if (SpaceFound != "z")
 {
      errormsg+='Please enter your street number and name AND the street type (Rd, St, Ave, etc) in the field (separated with a space).\n';
      error_ad=true;
      document.main.ApplicantName.focus();
      document.main.ApplicantName.select();     
 }
 
 doError("End validate_Street()");
}

/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
/*									 */
/* Make sure the State (State field) has been entered.  		 */
/* If it does, display the appropriate error              		 */
/*									 */
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */

function validate_State()
{
 doError("Start validate_State, State = |" + document.main.PropertyState.value + "|\nisStateReq " + isStateReq);
 
 if(isStateReq)
 {
  if(document.main.PropertyState.value=="XX")
  {
   errormsg+="Please enter your Property's State location.\n";
   error_st=true;
   
   if(!error_n)
   {
    document.main.PropertyState.focus();
   }
  }
 }
 doError("End validate_State()");
}

/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
/*									 */
/* Make sure the Impounds field has been entered.	  		 */
/* If it does, display the appropriate error              		 */
/*									 */
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */

function validate_Impounds()
{
 doError("Start validate_Impounds, Impounds = |" + document.main.Impounds[0].checked + "|" + document.main.Impounds[1].checked + "|\n");
 
 if((document.main.Impounds[0].checked==false) && (document.main.Impounds[1].checked==false))
 {
   errormsg+="Please choose whether property Taxes and/or Insurance is included in your CURRENT monthly payment.\n";
   error_im=true;
   
   if(!error_n)
   {
    document.main.Impounds[0].focus();
   }
 }
 doError("document.main.Impounds.length " + document.main.Impounds.length +"\nerror_im " + error_im);
 doError("End validate_Impounds()");
}

/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
/*									 */
/* Make sure the email field has been entered.                		 */
/* If it has, it must contain am '@' sign and a '.' (period)  		 */
/* If it doesn't, display the appropriate error            		 */
/*									 */
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */

function validate_email()
{
 doError("Start validate_email, email = |" + document.main.email.value + "|");

 if(isemailReq) 
 {
  document.main.email.value = document.main.email.value.trim();
  
  if(document.main.email.value=="")
  {
   errormsg+='Please enter a valid E-mail Address: (e.g. john@yahoo.com)\n';
   error_m=true;
   if((!error_n)&&(!error_ad)&&(!error_c))
   {
    document.main.email.focus();
    document.main.email.select();
    return;
   }
  }
  else
  {  /* e-mail is not blank */
     doError("starting to really validate |" + document.main.email.value + "|");

     /* 1+@3+ [or x@x.x] is as close as we will test */

    if(document.main.email.value.length<5) 
    {
     error_m=true;
    }

    if(document.main.email.value.indexOf("@")<1) 
    {
     error_m=true;
    }
    
    if((document.main.email.value.length - document.main.email.value.indexOf("@")) < 4) 
    {
     error_m=true;
    }

    if(error_m)
    {
      if((!error_n)&&(!error_ad)&&(!error_c))
      {
        errormsg+='Please enter a valid E-mail Address: (e.g. john@yahoo.com)\n';
        document.main.email.focus();  /* select highlights the existing data, focus just activates the box */
        document.main.email.select();
      }
    }
  }
 }
 else /* e-mail is not required, so just return */
 { 
   return;
 }
}

/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
/*									 */
/* Make sure the PropertyZipcode field has been entered.  		 */
/* If it has, it can contain only number characters       		 */
/* If it does, display the appropriate error              		 */
/*									 */
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */

function validate_zip()
{
 doError("Start validate_zip, PropertyZipcode= |" + document.main.PropertyZipcode.value + "|");

 if(isZipReq)
 {
  document.main.PropertyZipcode.value = document.main.PropertyZipcode.value.trim(); 
  
  if(document.main.PropertyZipcode.value=="")
  {
   errormsg+='Please enter Zip Code.\n';
   error_z=true;
   if((!error_n)&&(!error_ad)&&(!error_m))
   {
    document.main.PropertyZipcode.focus();
    document.main.PropertyZipcode.select();
   }
  }

  if(!(document.main.PropertyZipcode.value.length==5)&&!(document.main.PropertyZipcode.value.length==9))
  {
   errormsg+='Zip Code must be 5 or 9 digits.\n';
   error_z=true;
   if((!error_n)&&(!error_ad)&&(!error_m))
   {
    document.main.PropertyZipcode.focus();
    document.main.PropertyZipcode.select();
   }
  }
 }
 for(var i=0; i<document.main.PropertyZipcode.value.length; i++)
 {
  for(var j=0; j<numChars.length; j++)
  {
   if(numChars.charAt(j)==document.main.PropertyZipcode.value.charAt(i))
   {
    break;
   }
   else
   {
    if(j==(numChars.length-1))
    {
     errormsg+='"' + document.main.PropertyZipcode.value.charAt(i) + '"' + ' is an invalid character for Property Zip.\n';
     error_z=true;
    }
   }
   if(error_z)
   {
    if((!error_n)&&(!error_ad)&&(!error_m))
    {
     document.main.PropertyZipcode.focus();
     document.main.PropertyZipcode.select();
    }
   }
  }
 }
}



//---------------
//
// This function strips non-digit characters from the SSN using the neat Regular Expression matching method, .replace() 
// and returns a correctly formatted phone number.
//
//---------------


function formatSSN(SSN)
{
	var Pattern, NewSSN, Area, Prefix, Exchange;
	
	var OldSSN = SSN;
	
	if (SSN == "")
	{
		errormsg+='Social Security Number is required.\n';
		error_s=true;
		return (OldSSN);
	}



	SSN=SSN.replace(/\D/g,"");			// Replace *all* (the g is for global) non-digits with nothing, first

	
	Pattern = /(\d{3})(\d{2})(\d{4})/;		// Regular Expression: pattern 3 digits, 3 digits, 4 digits. 
	
	OldSSN = SSN;				
	
	NewSSN = SSN.replace(Pattern, "$1-$2-$3");	// replace the pattern against the string SSN. 
	
	//alert("$1 =|" + RegExp.$1 + "| $2=|" + RegExp.$2 + "| $3=|" + RegExp.$3 + "|");
	
	if (NewSSN.length != 11)
	{
		errormsg+='"' + NewSSN + '"' + ' needs 9 digits. Field has ' + (NewSSN.length - 2) + ' digits.\n';
		error_s=true;
		return(OldSSN);
	}
	
	// alert ("Old SSN |" + OldSSN + "|");
	// alert ("New Formatted SSN |" + NewSSN + "| length is " + NewSSN.length);
		
	return (NewSSN);
}





/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
/*									 */
/* Make sure the SSN field has been entered.                        	 */
/* If it has, it can contain only number characters                 	 */
/* If it does, display the appropriate error                        	 */
/*									 */
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */


function validate_ss()
{
 doError("Start validate_ss, SSN= |" + document.main.SSN.value + "|");

 if(isSSReq)
 {
  document.main.SSN.value = document.main.SSN.value.trim();
   
  if(document.main.SSN.value=="")
  {
   errormsg+="Please enter Borrower's Social Security Number.\n";
   error_s=true;
   if((!error_n)&&(!error_ad)&&(!error_m)&&(!error_z))
   {
    document.main.SSN.focus();
    document.main.SSN.select();
   }
  }

  document.main.SSN.value = formatSSN(document.main.SSN.value);

  if(!(document.main.SSN.value.length==11))
  {
   errormsg+="Borrower's Social Security Number must be 9 digits (dashes are also required).\n";
   error_s=true;
   
   if((!error_n)&&(!error_ad)&&(!error_m)&&(!error_z))
   {
    document.main.SSN.focus();
    document.main.SSN.select();
   }
  }
 
  
  for(var i=0; i<document.main.SSN.value.length; i++) /* for each character in the SSN string...*/
  {
   for(var j=0; j<numChars.length; j++) /* for each 'number' character...*/
   {
    doError('Checking "' + document.main.SSN.value.charAt(i) + '" at position ' + (i + 1) + ' with ' + numChars.charAt(j) + ' for match');

    if(numChars.charAt(j)==document.main.SSN.value.charAt(i)) /* if the SSN character is a 'number' */
    {
       break; /* ... then break out of the for loops */
    }
    else
    {  /* if (at position 3 OR 6 of SSN) & is a dash */
      if((i==3||i==6)&&(document.main.SSN.value.charAt(i)=='-'))
      {
        break;
      }
      else
      {
        if(j==(numChars.length-1))
        {
          doError("character " + document.main.SSN.value.charAt(i) + " at position " + (i + 1)  + " fails matching tests");
          errormsg+='"' + document.main.SSN.value.charAt(i) + '" at position ' + (i + 1) + ' in field is an invalid character for Borrower Social Security Number.\n';
          error_s=true;
        }
      }
    } /* end else */
    
    
   }  /* end of inner for loop */
  }   /* end of outer for loop */ 
  
  if(error_s)
  {
   if((!error_n)&&(!error_ad)&&(!error_m)&&(!error_z))
   {
    document.main.SSN.focus();
    document.main.SSN.select();
   }
  }    
 }
}

/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
/*									 */
/* Make sure the Co_SSN field has been entered.				 */
/* If it has, it can contain only number characters                 	 */
/* If it does, display the appropriate error                        	 */
/*									 */
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */

function validate_co_ss()
{
 doError("Start validate_co_ss, Co_SSN= |" + document.main.Co_SSN.value + "|");

 if(isSSReq)
 {
  document.main.Co_SSN.value = document.main.Co_SSN.value.trim();
   
  if(document.main.Co_SSN.value=="")
  {
   errormsg+="Please enter Co-Borrower's Social Security Number OR delete the Co-Borrower's name.\n";
   error_cs=true;
   if((!error_n)&&(!error_ad)&&(!error_m)&&(!error_z))
   {
    document.main.Co_SSN.focus();
    document.main.Co_SSN.select();
   }
  }
  
  /*  invalid:666-00-999-
   * position:01234567890
   *
   */
   
  document.main.Co_SSN.value = formatSSN(document.main.Co_SSN.value);

  if(!(document.main.Co_SSN.value.length==9)&&!(document.main.Co_SSN.value.length==11))
  {
   errormsg+="Co-Borrower's Social Security Number must be 9 digits (dashes are also required).\n";
   error_cs=true;
   if((!error_n)&&(!error_ad)&&(!error_m)&&(!error_z))
   {
    document.main.Co_SSN.focus();
    document.main.Co_SSN.select();
   }
  }
  
  for(var i=0; i<document.main.Co_SSN.value.length; i++) /* for each character in the Co_SSN string...*/
  {
   for(var j=0; j<numChars.length; j++) /* for each 'number' character...*/
   {
    doError('Checking "' + document.main.Co_SSN.value.charAt(i) + '" at position ' + (i + 1) + ' with ' + numChars.charAt(j) + ' for match');

    if(numChars.charAt(j)==document.main.Co_SSN.value.charAt(i)) /* if the Co_SSN character is a 'number' */
    {
       break; /* ... then break out of the for loops */
    }
    else
    {  /* if (at position 3 OR 6 of Co_SSN) & is a dash */
      if((i==3||i==6)&&(document.main.Co_SSN.value.charAt(i)=='-'))
      {
        break;
      }
      else
      {
        if(j==(numChars.length-1))
        {
          doError("character " + document.main.Co_SSN.value.charAt(i) + " at position " + (i + 1)  + " fails matching tests");
          errormsg+='"' + document.main.Co_SSN.value.charAt(i) + '" at position ' + (i + 1) + ' in field is an invalid character for Co-Borrower Social Security Number.\n';
          error_cs=true;
        }
      }
    } /* end else */
    
    
   }  /* end of inner for loop */
  }   /* end of outer for loop */ 
  
  if(error_cs)
  {
   if((!error_n)&&(!error_ad)&&(!error_m)&&(!error_z))
   {
    document.main.Co_SSN.focus();
    document.main.Co_SSN.select();
   }
  }    
 }
 doError("End of validate_co_ss()");
}

//---------------
//
// This function strips non-digit characters from the phone number using the neat Regular Expression matching method, .replace() 
// and returns a correctly formatted phone number. This is a much clearer method than the character-by-character check.
//
//---------------


function FormatPhone(Phone)
{
	var Pattern, Area, Prefix, Exchange;

	OldPhone = Phone;
	
	if (Phone == "")  /* we already tested before coming here that the work phone existed */
	{
		errormsg+='Home Phone Number is required.\n';
		error_hp=true;
		return (OldPhone);
	}
	
	
							// \D means non-digit	
	Phone=Phone.replace(/\D/g,"");			// Replace *all* (the g is for global) non-digits with nothing, first
	
	
	Pattern = /(^\d{3})(\d{3})(\d{4}$)/;		// Regular Expression: pattern 3 digits, 3 digits, 4 digits. 
	
	OldPhone = Phone;				
	
	NewPhone = Phone.replace(Pattern, "$1-$2-$3");	// replace the pattern against the string Phone. 
	
	//alert("$1 =|" + RegExp.$1 + "| $2=|" + RegExp.$2 + "| $3=|" + RegExp.$3 + "|");
	
	if (NewPhone.length != 12)
	{
		errormsg+='"' + NewPhone + '"' + ' needs 10 digits. Field has ' + (NewPhone.length - 2) + ' digits.\n';
		error_hp=true;
		return(OldPhone);
	}
	
	// alert ("Old Phone |" + OldPhone + "|");
	// alert ("New Formatted Phone |" + NewPhone + "| length is " + NewPhone.length);
		
	return (NewPhone);
}

//---------------
//
// This function formats dates so thewy are 2 digit month and day values
// and returns a correctly formatted phone number.
//
//---------------


function FormatDate(MyDate)
{
	var Pattern, MM, DD, YY, MyMM, MyDD, MyYY, OldDate, NewDate;

	OldDate = MyDate;
	
	if (MyDate == "")
	{
		return (OldDate);
	}
	
	// Regular Expression: pattern 1 or 2 digits, slash or dash, 1 or 2 digits, slash or dash, 2 to 4 digits. 
	
	Pattern = /(^\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{2,4}$)/;
	
			
	
	NewDate = MyDate.replace(Pattern, "$1-$3-$5");	// replace the pattern against the string MyDate. 
	
	//alert("NewDate=|" + NewDate +"| $1 =|" + RegExp.$1 + "| $3=|" + RegExp.$3 + "| $5=|" + RegExp.$5 + "|");
	MM = RegExp.$1;
	DD = RegExp.$3;
	YY = RegExp.$5;
	
	if (MM.length == 1)
		MyMM = "0" + MM;
	else
		MyMM = MM;

	if (DD.length == 1)
		MyDD = "0" + DD;
	else
		MyDD = DD;
		
	if (YY.length == 2)
		MyYY = "19" + YY;
	else
		MyYY = YY;	
	
	NewDate = MyMM + '-' + MyDD + '-' +MyYY
	
	// alert ("Old Date |" + OldDate + "|");
	// alert ("New Formatted Date |" + NewDate + "| length is " + NewDate.length);
		
	return (NewDate);
}

/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
/*									 */
/* Make sure the HomePhone field has been entered. 			 */
/* If it has, it can contain only number characters			 */
/* If it does, display the appropriate error       			 */
/*									 */
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */

function validate_HomePhone()
{
 doError("Start validate_HomePhone, HomePhone= |" + document.main.HomePhone.value + "|");

 if(isHphoneReq)
 {
  document.main.HomePhone.value = document.main.HomePhone.value.trim(); 
  
  if(document.main.HomePhone.value=="")
  {
   errormsg+='Please enter Home Phone Number.\n';
   error_hp=true;
   
   if((!error_n)&&(!error_ad)&&(!error_m)&&(!error_z))
   {
    document.main.HomePhone.focus();
    document.main.HomePhone.select();
   }
  }
  
  document.main.HomePhone.value = FormatPhone(document.main.HomePhone.value);
  
  if(!(document.main.HomePhone.value.length==12))
  {
   errormsg+='Home (or cell) Phone Number must be 10 digits (and format MUST be 999-999-9999).\n';
   error_hp=true;
   
   if((!error_n)&&(!error_ad)&&(!error_m)&&(!error_z))
   {
    document.main.HomePhone.focus();
    document.main.HomePhone.select();
   }
  }
 }
 for(var i=0; i<document.main.HomePhone.value.length; i++)
 {
  for(var j=0; j<numChars.length; j++)
  {
   if(numChars.charAt(j)==document.main.HomePhone.value.charAt(i))
   {
    break;
   }
   else
   {
    if(j == (numChars.length-1) && (document.main.HomePhone.value.charAt(i) != '-')) /* if not at end of table & not a dash */
    {
     errormsg+='"' + document.main.HomePhone.value.charAt(i) + '"' + ' is an invalid character for Home Phone Number.\n';
     error_hp=true;
    }
   }
   if(error_hp)
   {
    if((!error_n)&&(!error_ad)&&(!error_m)&&(!error_z))
    {
     document.main.HomePhone.focus();
     document.main.HomePhone.select();
    }
   }
  }
 }
}



/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
/*									 */
/* Make sure the PurchasePrice field has been entered.  		 */
/* If it has, it can contain only number characters    			 */
/* If it does, display the appropriate error           			 */
/*									 */
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */

function validate_price()
{
 doError("Start validate_price, PurchasePrice = |" + document.main.PurchasePrice.value + "|");

 if(isPriceReq)
 {
  document.main.PurchasePrice.value = document.main.PurchasePrice.value.trim();
  
  if(document.main.PurchasePrice.value=="")
  {
   errormsg+='Please enter Purchase Price.\n';
   error_p=true;
   if((!error_n)&&(!error_ad)&&(!error_m)&&(!error_z)&&(!error_s))
   {
    document.main.PurchasePrice.focus();
    document.main.PurchasePrice.select();
   }
  }
 }
 else
 {
   return;
 }

 for(var i=0; i<document.main.PurchasePrice.value.length; i++)
 {
  for(var j=0; j<numChars.length; j++)
  {
   if(numChars.charAt(j)==document.main.PurchasePrice.value.charAt(i))
   {
    break;
   }
   else
   {  /* if not at end of table & not a dollar sign or comma */
    if(j==(numChars.length-1)&&!(document.main.PurchasePrice.value.charAt(i)=='$')&&!(document.main.PurchasePrice.value.charAt(i)==',')) 
    {
     errormsg+='"' + document.main.PurchasePrice.value.charAt(i) + '"' + ' is an invalid character for Purchase Price.\n';
     error_p=true;
    }
   }
   if(error_p)
   {
    if((!error_n)&&(!error_ad)&&(!error_m)&&(!error_z)&&(!error_s))
    {
     document.main.PurchasePrice.focus();
     document.main.PurchasePrice.select();
    }
   }
  }
 }
 
 
}


/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
/*									 */
/* Make sure the PropertyType field has been entered. 			 */
/*									 */
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */

function validate_PropertyType()
{
 doError("Start validate_PropertyType, PropertyType = |" + document.main.PropertyType.value + "|");

 if(isPTypeReq)
 { 
  if(document.main.PropertyType.value=="Null")
  {
   errormsg+='Please choose a Property Type.\n';
   error_pt=true;
  
  if((!error_n)&&(!error_ad)&&(!error_m)&&(!error_z)&&(!error_s)&&(!error_p))
   {
      document.main.PropertyType.focus();
    /*document.main.PropertyType.select();*/  // don't "select" drop down box fields
   }
  }
 }
}

/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
/*									 */
/* Validate estimated value						 */
/*									 */
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */


function validate_EstimatedValue()
{
 doError("Start validate_EstimatedValue, EstimatedValue = |" + document.main.EstimatedValue.value + "|");

 if(isValueReq)
 {
  document.main.EstimatedValue.value = document.main.EstimatedValue.value.trim();
   
  if(document.main.EstimatedValue.value=="")
  {
   errormsg+='Please enter an Estimated Value.\n';
   error_v=true;
   if((!error_n)&&(!error_ad)&&(!error_m)&&(!error_z)&&(!error_s)&&(!error_p)&&(!error_pt))
   {
    document.main.EstimatedValue.focus();
    document.main.EstimatedValue.select();
   }
  }
 }
 for(var i=0; i<document.main.EstimatedValue.value.length; i++)
 {
  for(var j=0; j<numChars.length; j++)
  {
   if(numChars.charAt(j)==document.main.EstimatedValue.value.charAt(i))
   {
    break;
   }
   else
   {
    if(j==(numChars.length-1)&&!(document.main.EstimatedValue.value.charAt(i)=='$')&&!(document.main.EstimatedValue.value.charAt(i)==',')) /* if not at end of table & not a dollar sign or comma */
    {
     errormsg+='"' + document.main.EstimatedValue.value.charAt(i) + '"' + ' is an invalid character for Estimated Value.\n';
     error_p=true;
    }
   }
   if(error_p)
   {
    if((!error_n)&&(!error_ad)&&(!error_m)&&(!error_z)&&(!error_s))
    {
     document.main.EstimatedValue.focus();
     document.main.EstimatedValue.select();
    }
   }
  }
 }
 doError("Ends validate_EstimatedValue()");
}

/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
/*									 */
/* Validate 1st loan interest						 */
/*									 */
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */


function validate_1st_interest()
{
 doError("Start validate_1st_interest, InterestRateOn1st = |" + document.main.InterestRateOn1st.value + "|");
 if(isInterestReq)
 {
  if(document.main.InterestRateOn1st.value=="Null")
  {
   errormsg+='Please list the Current Interest Rate.\n';
   error_i=true;
   if((!error_n)&&(!error_ad)&&(!error_m)&&(!error_z)&&(!error_s)&&(!error_p)&&(!error_pt)&&(!error_v))
   {
    document.main.InterestRateOn1st.focus();
   /* document.main.InterestRateOn1st.select(); */
   }
  }
 }
}


/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
/*									 */
/* Validate 1st loan balance						 */
/*									 */
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */



function validate_1st_balance()
{
 doError("Start validate_1st_balance, LoanBalanceOn1st = |" + document.main.LoanBalanceOn1st.value + "|");
 if(isBalanceReq)
 {
  if(document.main.LoanBalanceOn1st.value=="")
  {
   errormsg+='Please enter your estimated Loan Balance.\n';
   error_b=true;
   if((!error_n)&&(!error_ad)&&(!error_m)&&(!error_z)&&(!error_s)&&(!error_p)&&(!error_pt)&&(!error_v)&&(!error_i))
   {
    document.main.LoanBalanceOn1st.focus();
    document.main.LoanBalanceOn1st.select();
   }
  }
 }
 for(var i=0; i<document.main.LoanBalanceOn1st.value.length; i++)
 {
  for(var j=0; j<numChars.length; j++)
  {
   if(numChars.charAt(j)==document.main.LoanBalanceOn1st.value.charAt(i))
   {
    break;
   }
   else
   {
    if(j==(numChars.length-1)&&!(document.main.LoanBalanceOn1st.value.charAt(i)=='$')&&!(document.main.LoanBalanceOn1st.value.charAt(i)==',')) /* if not at end of table & not a dollar sign or comma */
    {
     errormsg+='"' + document.main.LoanBalanceOn1st.value.charAt(i) + '"' + ' is an invalid character for Purchase Price.\n';
     error_p=true;
    }
   }
   if(error_p)
   {
    if((!error_n)&&(!error_ad)&&(!error_m)&&(!error_z)&&(!error_s))
    {
     document.main.LoanBalanceOn1st.focus();
     document.main.LoanBalanceOn1st.select();
    }
   }
  }
 }
}

/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
/*													*/
/* These ImmediateXXXcheck functions are called by the OnBlur events of their corresponding fields 	*/
/*													*/
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/

// - - - - - - - - - -
// Check the applicant name once user leaves the field
// - - - - - - - - - -

function ImmediateNameCheck()
{
 doError("Start ImmediateNameCheck(), Name = |" + document.main.ApplicantName.value + "|");
 reset_error();
 validate_name();
 
 if (error_n)
 {
   alert(errormsg);
   reset_error();
 }
} 

// - - - - - - - - - -
// Check the co-applicant name once user leaves the field
// - - - - - - - - - -

function ImmediateCoNameCheck()
{
 doError("Start ImmediateCoNameCheck(), Name = |" + document.main.Co_ApplicantName.value + "|");
 reset_error();
 validate_co_name();
 if (error_cn)
 {
   alert(errormsg);
   reset_error();
 }
} 


// - - - - - - - - - -
// Check the PropertyStreet once user leaves the field
// - - - - - - - - - -

function ImmediatePropertyStreetCheck()
{
 doError("Start ImmediatePropertyStreetCheck(), Name = |" + document.main.Street.value + "|");
 reset_error();
 validate_Street();
 if (error_ad)
 {
   alert(errormsg);
   reset_error();
 }
} 

// - - - - - - - - - -
// Check the PropertyCity once user leaves the field
// - - - - - - - - - -

function ImmediatePropertyCityCheck()
{
 doError("Start ImmediatePropertyCityCheck(), Name = |" + document.main.PropertyCity.value + "|");
 reset_error();
 validate_city();
 if (error_c)
 {
   alert(errormsg);
   reset_error();
 }
} 


// - - - - - - - - - -
// Check the EmailAddress once user leaves the field
// - - - - - - - - - -

function ImmediateEmailCheck()
{
 doError("Start ImmediateEmailCheck(), Name = |" + document.main.email.value + "|");
 reset_error();
 
 validate_email();
   
 if (error_m)
 {
     alert(errormsg);
     reset_error();
 }
} 

// - - - - - - - - - -
// Check the Zipcode once user leaves the field
// - - - - - - - - - -

function ImmediatePropertyZipcodeCheck()
{
 doError("Start ImmediatePropertyZipcodeCheck(), Name = |" + document.main.PropertyZipcode.value + "|");
 reset_error();
 validate_zip();
 if (error_z)
 {
   alert(errormsg);
   reset_error();
 }
} 

// - - - - - - - - - -
// Check the SS # once user leaves the field
// - - - - - - - - - -

function ImmediateSSNCheck()
{
 doError("Start ImmediateSSNCheck(), Name = |" + document.main.SSN.value + "|");
 reset_error();
 validate_ss();
 if (error_s)
 {
   alert(errormsg);
   reset_error();
 }
} 

// - - - - - - - - - -
// Check the Co_SS # once user leaves the field
// - - - - - - - - - -

function ImmediateCo_SSNCheck()
{
 doError("Start ImmediateCo_SSNCheck(), Name = |" + document.main.Co_SSN.value + "|");
 reset_error();
 
 if(!document.main.Co_ApplicantName.value=="") /* if no Co_Applicant, just return from the function */
 {
   validate_co_ss();
   
   if (error_cs)
   {
    alert(errormsg);
    reset_error();
   }
 }
} 




// -- - - - - - - - - - - - -
//
//	CheckForPObox: Special handling of PO box addresses is necessary
//
// -- - - - - - - - - - - - -
function CheckForPObox(Address)
{
	
	var Pattern = /^PO Box/i;
	
	var QQ = -1;
	
	Address=Address.replace(/\./g, "");		//remove periods if any
	
	var MyResult = Address.search(Pattern);		//look for |PO Box|
	
	//alert("Address =|" + Address + "|, MyResult=" + MyResult);
	 
	if(MyResult > -1)
	{
		Pattern = /\d+/;
		QQ=Pattern.exec(Address);
	}
	
	return (QQ);
}

/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
/*									 */
/* Count: Makes sure the user presses the submit button only once.	 */
/*									 */
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */

var SubmitCounter = 0;

function Count() 
{
	SubmitCounter++;
	
	if (counter > 2) 
	{ 
		return false; 
	}
	
	if(counter > 1) 
	{
		alert('Sometimes the servers are a bit slow. ' + 
			'One click is sufficient.\n\nI\'m sure the ' + 
			'server will respond in a few seconds.\n\n' + 
			'Thank you for your patience.');
		return false;
	}
	
	return true;
}

/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
/*									 */
/* Validate: checks the entire documenmt once the user presses the 	 */
/* submit button on the Loan Application 				 */
/*									 */
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */

function validate()
{
/* convert the Income string values into integers for comparison in this function */

 var ApplicantIncome = parseInt (document.main.MonthlyIncome.value);
 var CoApplicantIncome = parseInt (document.main.Co_MonthlyIncome.value);
  
 doError("Start validate, PurchasePrice = |" + document.main.PurchasePrice.value + "|");
 
 
 reset_error();
 validate_name();
 
 if(!(document.main.Co_ApplicantName.value=="")) /* if there is a co=applicant */
 {  
   validate_co_name();
   if (CoSpaceFound=="y")
   {
     validate_co_ss();  /* if there is a valid co-appliant name, make sure there is a social security number, too */
   }
 }
 
 validate_Street();
 validate_city();
 validate_State();
 validate_email();
 validate_zip();
 
 validate_HomePhone(document.main.HomePhone.value);
 document.main.HomePhone.value	= FormatPhone(document.main.HomePhone.value);
 
 if (document.main.WorkPhone.value != "")
 {
 	document.main.WorkPhone.value	= FormatPhone(document.main.WorkPhone.value);
 }
 
 document.main.DOB.value 	= FormatDate(document.main.DOB.value);
 document.main.Co_DOB.value	= FormatDate(document.main.Co_DOB.value);
 validate_ss();
 validate_price();
 validate_PropertyType();
 validate_EstimatedValue();
 validate_1st_interest();
 validate_1st_balance();
 validate_Impounds();
 
 
 doError("Start Middle validate, error_n " + error_n + "\nerror_im " + error_im + "\nerror_ad " + error_ad + "\nerror_st " + error_st + "\nerror_m " + error_m + "\nerror_z " + error_z + "\nerror_c " + error_c + "\nerror_s " + error_s + "\nerror_p " + error_p + "\nerror_pt " + error_pt + "\nerror_v " + error_v + "\nerror_i " + error_i + "\nerror_b " + error_b);

 if(error_im||error_cn||error_st||error_cs||error_n||error_cn||error_ad||error_m||error_z||error_c||error_s||error_cs||error_hp||error_wp||error_p||error_pt||error_v||error_i||error_b)
 {
  error=true;
 }
 else
 {
  error=false;
 }

   /*  build URL string to send to eCreditLending's website */

  document.main.redirect.value="https://ecreditlending.com/V2.00/cp1Validation.aspx?";
  document.main.redirect.value+="&coid=9202";
  document.main.redirect.value+="&transtype=CRD";
  document.main.redirect.value+="&charge=15.00";   /* here is the amount to charge the credit card */
  document.main.redirect.value+="&to_email=tony@lightning-mortgage.com";
  document.main.redirect.value+="&cc_email=fran@lightning-mortgage.com";
  document.main.redirect.value+="&email_subj=Home Loan Credit Report Waiting for your review-See below";
  document.main.redirect.value+="&returnURL=http://www.lightning-mortgage.com/MortgageApplication/OrderCreditSuccess.php";
  document.main.redirect.value+="&cancelURL=http://www.lightning-mortgage.com/MortgageApplication/OrderCreditCancel.php";

/*  let eCredit Lending handle errors on their page */
  document.main.redirect.value+="&errorURL=http://www.lightning-mortgage.com/MortgageApplication/OrderCreditFailure.php";



/* The applicant on the credit report is the person making the higher salary. So sometimes we have to swap the */
/* applicant and co-applicant. First check to see if there is a co-applicant */

  if (document.main.Co_ApplicantName.value=="")
  {
    document.main.redirect.value+="&a_fullname=";
    document.main.redirect.value+=document.main.ApplicantName.value;
    document.main.redirect.value+="&a_ssn=";
    document.main.redirect.value+=document.main.SSN.value;  
  }
  else
  {    /* if there is a co-applicant */
       /* if applicant's income is less than the co-applicant's income swap places*/
    
    doError("applicant income: " + ApplicantIncome + "\nco-applicant income: " + CoApplicantIncome);
    
    if(ApplicantIncome<CoApplicantIncome)
    {
      doError("co-applicant makes more\n");
      document.main.redirect.value+="&a_fullname=";
      document.main.redirect.value+=document.main.Co_ApplicantName.value;
      document.main.redirect.value+="&a_ssn=";
      document.main.redirect.value+=document.main.Co_SSN.value;  
      document.main.redirect.value+="&co_fullname=";
      document.main.redirect.value+=document.main.ApplicantName.value;
      document.main.redirect.value+="&co_ssn=";
      document.main.redirect.value+=document.main.SSN.value;     
    }
    else
    {    /* if there is a co-applicant and the co-applicant's income is less than or equal to appliant's income, leave it be */
      doError("applicant makes as much or more\n");    
      document.main.redirect.value+="&a_fullname=";
      document.main.redirect.value+=document.main.ApplicantName.value;
      document.main.redirect.value+="&a_ssn=";
      document.main.redirect.value+=document.main.SSN.value;      
      document.main.redirect.value+="&co_fullname=";
      document.main.redirect.value+=document.main.Co_ApplicantName.value;
      document.main.redirect.value+="&co_ssn=";
      document.main.redirect.value+=document.main.Co_SSN.value;     
    }  
  }
  
    
 //To remove the leading and trailing blanks from a string variable Street
/*
  doError("Before trim -Street|" + document.main.Street.value + "|");
  document.main.Street.value = Street.trim();
  doError("After trim -Street|" + document.main.Street.value + "|");
*/


  if (CheckForPObox(document.main.Street.value) > -1)
  {
  	document.main.redirect.value+="&ca_house=";
	document.main.redirect.value+=CheckForPObox(document.main.Street.value);
	document.main.redirect.value+="&ca_street_name=";
  	document.main.redirect.value+="POB";
  }
  else
  {
  	document.main.redirect.value+="&ca_fullstreet_name=";
  	document.main.redirect.value+=document.main.Street.value; 
  }
  
  document.main.redirect.value+="&ca_city=";
  document.main.redirect.value+=document.main.PropertyCity.value;
  document.main.redirect.value+="&ca_state=";
  document.main.redirect.value+=document.main.PropertyState.value;
  document.main.redirect.value+="&ca_zipcode=";
  document.main.redirect.value+=document.main.PropertyZipcode.value;
  document.main.redirect.value+="&ca_county=";
  document.main.redirect.value+=document.main.PropertyCounty.value;
  document.main.redirect.value+="&bill_email=";
  document.main.redirect.value+=document.main.email.value;
  document.main.redirect.value+="&bill_phone=";
  document.main.redirect.value+=document.main.HomePhone.value;
  document.main.redirect.value+="&autopopcc=Y";

  /* while a space is found in the string, replace the space with a plus sign */
  var s = document.main.redirect.value;
  
  while (s.indexOf(" ") > -1)
      s = s.replace(" ","+");     
  
  document.main.redirect.value=s;
  
  doError("return URL: " + document.main.redirect.value);

  if(!error)
  {
   return(true);
  }
  else
  { /* take accumulated error messages and display them */
   document.main.Submit.value  ="Submit";
   alert(errormsg); 
   return(false);
  }
  
  alert("Error! Loan Application Error!\nThis message should never appear.");
}