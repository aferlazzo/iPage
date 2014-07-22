var d=document;
// debug can be either 'none', 'alert', or 'textarea' depending 
// on the kind of debugging I want to do
var debug="none";

var redirectString;
var alphaChars="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ. ";
var numChars="0123456789-";
var error;
var error_n;  // name
var error_sig; 
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

var isNameReq=true;     
var isSignatureReq=true; 
var isStreetReq=true;   
var isemailReq=true;    
var isZipReq=true;      
var isCityReq=true;     
var isStateReq=true;    

var isSSReq=true;       
var isCoSSReq=false;    

var isPriceReq=true;    
var isPTypeReq=true;    
var isValueReq=true;    
var isInterestReq=true; 
var isBalanceReq=true;  

var isHphoneReq=false;  
var isWphoneReq=false;  

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
          d.main.Situation.value += the_message + "\n";
        }
}
// - - - - - - - - - - - - - -
function reset_error()
{
 doError("reset_error() start");
 error_n=false;
 error_sig=false;
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

/* Make sure the Applicant's Name field has been entered.                */
/* If it has, it cannot contain numbers                                  */
/* If it does contain invalid characters, display the appropriate error  */

function validate_name()
{
 var SpaceFound="n";
 
 doError("Start validate_name, ApplicantName = |" + d.main.ApplicantName.value + "|");
 
 if(isNameReq)
 {
  d.main.ApplicantName.value = d.main.ApplicantName.value.trim(); // erase leading/trailing whitespace
 }

 for(var i=0; i<d.main.ApplicantName.value.length; i++)
 {
  for(var j=0; j<alphaChars.length; j++)
  {
   if(d.main.ApplicantName.value.charAt(i)==" ")	// A switch to later make sure there is at least two separate blocks of characters
   {
      SpaceFound="y";
   }
  
   if(alphaChars.charAt(j)==d.main.ApplicantName.value.charAt(i))
   {
    break;
   }

   if(j==(alphaChars.length-1))
   {
       errormsg+='"' + d.main.ApplicantName.value.charAt(i) + '"' + ' is an invalid character for Name.\n';
       error_n=true;
   }

   if(error_n)
   {
    d.main.ApplicantName.select();
   }
  }
 }
 
 if ((SpaceFound != "y" && isNameReq==true) || (isNameReq==true && d.main.ApplicantName.value == "")) 
 {
     errormsg+='Please enter your first and last name in the field (separated with a space).\n';
     error_n=true;
     d.main.ApplicantName.focus();
     d.main.ApplicantName.select();     
 }
}

/* Make sure the Signature field has been entered.	*/
/* If it has, it cannot contain numbers				*/
/* If it does contain invalid characters,			*/
/* display the appropriate error					*/
function validate_signature()
{
 var SpaceFound="n";
 
 doError("Start validate_signature, signature = |" + d.main.Signature.value + "|");
 
 if(isSignatureReq)
 {
  d.main.Signature.value = d.main.Signature.value.trim(); // erase leading/training whitespace
 }

 for(var i=0; i<d.main.Signature.value.length; i++)
 {
  for(var j=0; j<alphaChars.length; j++)
  {
   if(alphaChars.charAt(j)==" ")	// A switch to later make sure there is at least two separate blocks of characters
   {
      SpaceFound="y";
   }
  
   if(alphaChars.charAt(j)==d.main.Signature.value.charAt(i))
   {
    break;
   }

   if(j==(alphaChars.length-1))
   {
       errormsg+='"' + d.main.Signature.value.charAt(i) + '"' + ' is an invalid character for Signature.\n';
       error_sig=true;
   }

   if(error_sig)
   {
    d.main.Signature.select();
   }
  }
 }
 
 if ((SpaceFound != "y" && isSignatureReq==true) || (isSignatureReq==true && d.main.Signature.value == ""))
 {
     errormsg+='Please enter your full name as a Digital Signature.\n';
     error_sig=true;
	 if ((typeof(d.main.Signature.value) == undefined) || (d.main.Signature.value == ''))
		 d.main.Signature.value=' ';

     d.main.Signature.focus();
     d.main.Signature.select();     
 }
}

/* Make sure the CoApplicant's Name field has been entered correctly if  */
/* entered.  If it has, it cannot contain numbers       		 */
/* If it does, display the appropriate error  				 */

function validate_co_name()
{
 CoSpaceFound="n";
 
 doError("Start validate_co_name, Co_ApplicantName = |" + d.main.Co_ApplicantName.value + "|");

 d.main.Co_ApplicantName.value = d.main.Co_ApplicantName.value.trim();
  
 if(d.main.Co_ApplicantName.value=="") /* if no Co_Applicant, just return from the function */
 {
   return;
 }
 

 for(var i=0; i<d.main.Co_ApplicantName.value.length; i++)
 {
  for(var j=0; j<alphaChars.length; j++)
  {
   if(alphaChars.charAt(j)==" ")
   {
      CoSpaceFound="y";
   }
  
   if(alphaChars.charAt(j)==d.main.Co_ApplicantName.value.charAt(i))
   {
    break;
   }

   if(j==(alphaChars.length-1))
   {
       errormsg+='"' + d.main.Co_ApplicantName.value.charAt(i) + '"' + ' is an invalid character for Co-Borrower Name.\n';
       error_cn=true;
   }

   if(error_cn)
   {
    d.main.Co_ApplicantName.focus();
    d.main.Co_ApplicantName.select();
   }
  }
 } 
 
 if (CoSpaceFound=="n") /* if something was entered ... */
 {
     errormsg+="Please enter coApplicatant's first and last name in the field.\n";
     error_cn=true;
     d.main.Co_ApplicantName.focus();
     d.main.Co_ApplicantName.select();
 }
}

/* Make sure the PropertyCity field has been entered. 			 */
/* If it has, it can contain only alpha characters    			 */
/* If it does, display the appropriate error          			 */
function validate_city()
{
 doError("Start validate_city, PropertyCity = |" + d.main.PropertyCity.value + "|");
 if(isCityReq)
 {
  d.main.PropertyCity.value = d.main.PropertyCity.value.trim();
  
  if(d.main.PropertyCity.value=="")
  {
   errormsg+='Please enter the City.\n';
   error_c=true;
   if((!error_n)&&(!error_ad)){
     d.main.PropertyCity.focus();
     d.main.PropertyCity.select();
   }
  }
 }
 for(var i=0; i<d.main.PropertyCity.value.length; i++)
 {
  for(var j=0; j<alphaChars.length; j++)
  {
   if(alphaChars.charAt(j)==d.main.PropertyCity.value.charAt(i))
   {
    break;
   }
   else
   {
    if(j==(alphaChars.length-1))
    {
     errormsg+='"' + d.main.PropertyCity.value.charAt(i) + '"' + ' is an invalid character for City.\n';
     error_c=true;
    }
   }
   if(error_c)
   {
     if((!error_n)&&(!error_ad)){
       d.main.PropertyCity.focus();
       d.main.PropertyCity.select();
     }
   }
  }
 }
}


/* Make sure the Street (Street field) has been entered.  		 */
/* If it does, display the appropriate error              		 */

function validate_Street()
{
  var SpaceFound="n";
  var AlphaNumericChars = alphaChars + numChars;

 doError("Start validate_Street, Street = |" + d.main.Street.value + "|");
 
 if(isStreetReq)
 {
  d.main.Street.value = d.main.Street.value.trim();

  if(d.main.Street.value=="")
  {
   errormsg+='Please enter your Street Address.\n';
   error_ad=true;
   
   if(!error_n)
   {
    d.main.Street.focus();
    d.main.Street.select();
   }
  }
 }
 
 
 for(var i=0; i<d.main.Street.value.length; i++)
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
   
  
   if(AlphaNumericChars.charAt(j)==d.main.Street.value.charAt(i))
   {
    break;
   }
   else
   {
    if(j==(AlphaNumericChars.length-1))
    {
     errormsg+='"' + d.main.Street.value.charAt(i) + '"' + ' is an invalid character for Street.\n';
     error_ad=true;
    }
   }
   if(error_c)
   {
     if(!error_n)
     {
       d.main.Street.focus();
       d.main.Street.select();
     }
   }
  }
 }
 
 if (SpaceFound != "z")
 {
      errormsg+='Please enter your street number and name AND the street type (Rd, St, Ave, etc) in the field (separated with a space).\n';
      error_ad=true;
      d.main.ApplicantName.focus();
      d.main.ApplicantName.select();     
 }
 
 doError("End validate_Street()");
}

/* Make sure the State (State field) has been entered.  		 */
/* If it does, display the appropriate error              		 */
function validate_State()
{
 doError("Start validate_State, State = |" + d.main.PropertyState.value + "|\nisStateReq " + isStateReq);
 
 if(isStateReq)
 {
  if(d.main.PropertyState.value=="XX")
  {
   errormsg+="Please enter your Property's State location.\n";
   error_st=true;
   
   if(!error_n)
   {
    d.main.PropertyState.focus();
   }
  }
 }
 doError("End validate_State()");
}

/* Make sure the Impounds field has been entered.	  		 */
/* If it does, display the appropriate error              		 */

function validate_Impounds()
{
 doError("Start validate_Impounds, Impounds = |" + d.main.Impounds[0].checked + "|" + d.main.Impounds[1].checked + "|\n");
 
 if((d.main.Impounds[0].checked==false) && (d.main.Impounds[1].checked==false))
 {
   errormsg+="Please choose whether property Taxes and/or Insurance is included in your CURRENT monthly payment.\n";
   error_im=true;
   
   if(!error_n)
   {
    d.main.Impounds[0].focus();
   }
 }
 doError("d.main.Impounds.length " + d.main.Impounds.length +"\nerror_im " + error_im);
 doError("End validate_Impounds()");
}

/* Make sure the email field has been entered.                		 */
/* If it has, it must contain am '@' sign and a '.' (period)  		 */
/* If it doesn't, display the appropriate error            		 */

function validate_email()
{
 doError("Start validate_email, email = |" + d.main.email.value + "|");

 if(isemailReq) 
 {
  d.main.email.value = d.main.email.value.trim();
  
  if(d.main.email.value=="")
  {
   errormsg+='Please enter a valid E-mail Address: (e.g. john@yahoo.com)\n';
   error_m=true;
   if((!error_n)&&(!error_ad)&&(!error_c))
   {
    d.main.email.focus();
    d.main.email.select();
    return;
   }
  }
  else
  {  /* e-mail is not blank */
     doError("starting to really validate |" + d.main.email.value + "|");

     /* 1+@3+ [or x@x.x] is as close as we will test */

    if(d.main.email.value.length<5) 
    {
     error_m=true;
    }

    if(d.main.email.value.indexOf("@")<1) 
    {
     error_m=true;
    }
    
    if((d.main.email.value.length - d.main.email.value.indexOf("@")) < 4) 
    {
     error_m=true;
    }

    if(error_m)
    {
      if((!error_n)&&(!error_ad)&&(!error_c))
      {
        errormsg+='Please enter a valid E-mail Address: (e.g. john@yahoo.com)\n';
        d.main.email.focus();  /* select highlights the existing data, focus just activates the box */
        d.main.email.select();
      }
    }
  }
 }
 else /* e-mail is not required, so just return */
 { 
   return;
 }
}

/* Make sure the PropertyZipcode field has been entered.  		 */
/* If it has, it can contain only number characters       		 */
/* If it does, display the appropriate error              		 */

function validate_zip()
{
 doError("Start validate_zip, PropertyZipcode= |" + d.main.PropertyZipcode.value + "|");

 if(isZipReq)
 {
  d.main.PropertyZipcode.value = d.main.PropertyZipcode.value.trim(); 
  
  if(d.main.PropertyZipcode.value=="")
  {
   errormsg+='Please enter Zip Code.\n';
   error_z=true;
   if((!error_n)&&(!error_ad)&&(!error_m))
   {
    d.main.PropertyZipcode.focus();
    d.main.PropertyZipcode.select();
   }
  }

  if(!(d.main.PropertyZipcode.value.length==5)&&!(d.main.PropertyZipcode.value.length==9))
  {
   errormsg+='Zip Code must be 5 or 9 digits.\n';
   error_z=true;
   if((!error_n)&&(!error_ad)&&(!error_m))
   {
    d.main.PropertyZipcode.focus();
    d.main.PropertyZipcode.select();
   }
  }
 }
 for(var i=0; i<d.main.PropertyZipcode.value.length; i++)
 {
  for(var j=0; j<numChars.length; j++)
  {
   if(numChars.charAt(j)==d.main.PropertyZipcode.value.charAt(i))
   {
    break;
   }
   else
   {
    if(j==(numChars.length-1))
    {
     errormsg+='"' + d.main.PropertyZipcode.value.charAt(i) + '"' + ' is an invalid character for Property Zip.\n';
     error_z=true;
    }
   }
   if(error_z)
   {
    if((!error_n)&&(!error_ad)&&(!error_m))
    {
     d.main.PropertyZipcode.focus();
     d.main.PropertyZipcode.select();
    }
   }
  }
 }
}

// This function strips non-digit characters from the SSN using the neat Regular Expression matching method, .replace() 
// and returns a correctly formatted phone number.


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

/* Make sure the SSN field has been entered.                        	 */
/* If it has, it can contain only number characters                 	 */
/* If it does, display the appropriate error                        	 */

function validate_ss()
{
 doError("Start validate_ss, SSN= |" + d.main.SSN.value + "|");

 if(isSSReq)
 {
  d.main.SSN.value = d.main.SSN.value.trim();
   
  if(d.main.SSN.value=="")
  {
   errormsg+="Please enter Borrower's Social Security Number.\n";
   error_s=true;
   if((!error_n)&&(!error_ad)&&(!error_m)&&(!error_z))
   {
    d.main.SSN.focus();
    d.main.SSN.select();
   }
  }

  d.main.SSN.value = formatSSN(d.main.SSN.value);

  if(!(d.main.SSN.value.length==11))
  {
   errormsg+="Borrower's Social Security Number must be 9 digits (dashes are also required).\n";
   error_s=true;
   
   if((!error_n)&&(!error_ad)&&(!error_m)&&(!error_z))
   {
    d.main.SSN.focus();
    d.main.SSN.select();
   }
  }
 
  
  for(var i=0; i<d.main.SSN.value.length; i++) /* for each character in the SSN string...*/
  {
   for(var j=0; j<numChars.length; j++) /* for each 'number' character...*/
   {
    doError('Checking "' + d.main.SSN.value.charAt(i) + '" at position ' + (i + 1) + ' with ' + numChars.charAt(j) + ' for match');

    if(numChars.charAt(j)==d.main.SSN.value.charAt(i)) /* if the SSN character is a 'number' */
    {
       break; /* ... then break out of the for loops */
    }
    else
    {  /* if (at position 3 OR 6 of SSN) & is a dash */
      if((i==3||i==6)&&(d.main.SSN.value.charAt(i)=='-'))
      {
        break;
      }
      else
      {
        if(j==(numChars.length-1))
        {
          doError("character " + d.main.SSN.value.charAt(i) + " at position " + (i + 1)  + " fails matching tests");
          errormsg+='"' + d.main.SSN.value.charAt(i) + '" at position ' + (i + 1) + ' in field is an invalid character for Borrower Social Security Number.\n';
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
    d.main.SSN.focus();
    d.main.SSN.select();
   }
  }    
 }
}

/* Make sure the Co_SSN field has been entered.				 */
/* If it has, it can contain only number characters                 	 */
/* If it does, display the appropriate error                        	 */

function validate_co_ss()
{
 doError("Start validate_co_ss, Co_SSN= |" + d.main.Co_SSN.value + "|");

 if(isSSReq)
 {
  d.main.Co_SSN.value = d.main.Co_SSN.value.trim();
   
  if(d.main.Co_SSN.value=="")
  {
   errormsg+="Please enter Co-Borrower's Social Security Number OR delete the Co-Borrower's name.\n";
   error_cs=true;
   if((!error_n)&&(!error_ad)&&(!error_m)&&(!error_z))
   {
    d.main.Co_SSN.focus();
    d.main.Co_SSN.select();
   }
  }
  
  /*  invalid:666-00-999-
   * position:01234567890
   *
   */
   
  d.main.Co_SSN.value = formatSSN(d.main.Co_SSN.value);

  if(!(d.main.Co_SSN.value.length==9)&&!(d.main.Co_SSN.value.length==11))
  {
   errormsg+="Co-Borrower's Social Security Number must be 9 digits (dashes are also required).\n";
   error_cs=true;
   if((!error_n)&&(!error_ad)&&(!error_m)&&(!error_z))
   {
    d.main.Co_SSN.focus();
    d.main.Co_SSN.select();
   }
  }
  
  for(var i=0; i<d.main.Co_SSN.value.length; i++) /* for each character in the Co_SSN string...*/
  {
   for(var j=0; j<numChars.length; j++) /* for each 'number' character...*/
   {
    doError('Checking "' + d.main.Co_SSN.value.charAt(i) + '" at position ' + (i + 1) + ' with ' + numChars.charAt(j) + ' for match');

    if(numChars.charAt(j)==d.main.Co_SSN.value.charAt(i)) /* if the Co_SSN character is a 'number' */
    {
       break; /* ... then break out of the for loops */
    }
    else
    {  /* if (at position 3 OR 6 of Co_SSN) & is a dash */
      if((i==3||i==6)&&(d.main.Co_SSN.value.charAt(i)=='-'))
      {
        break;
      }
      else
      {
        if(j==(numChars.length-1))
        {
          doError("character " + d.main.Co_SSN.value.charAt(i) + " at position " + (i + 1)  + " fails matching tests");
          errormsg+='"' + d.main.Co_SSN.value.charAt(i) + '" at position ' + (i + 1) + ' in field is an invalid character for Co-Borrower Social Security Number.\n';
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
    d.main.Co_SSN.focus();
    d.main.Co_SSN.select();
   }
  }    
 }
 doError("End of validate_co_ss()");
}

// This function strips non-digit characters from the phone number using the neat Regular Expression matching method, .replace() 
// and returns a correctly formatted phone number. This is a much clearer method than the character-by-character check.


function FormatPhone(Phone)
{
	var Pattern, Area, Prefix, Exchange;

	var OldPhone = Phone;
	
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
	
	var NewPhone = Phone.replace(Pattern, "$1-$2-$3");	// replace the pattern against the string Phone. 
	
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

// Format dates so they are 2 digit month and day values
// and returns a correctly formatted phone number.

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

/* Make sure the HomePhone field has been entered. 			 */
/* If it has, it can contain only number characters			 */
/* If it does, display the appropriate error       			 */

function validate_HomePhone()
{
 doError("Start validate_HomePhone, HomePhone= |" + d.main.HomePhone.value + "|");

 if(isHphoneReq)
 {
  d.main.HomePhone.value = d.main.HomePhone.value.trim(); 
  
  if(d.main.HomePhone.value=="")
  {
   errormsg+='Please enter Home Phone Number.\n';
   error_hp=true;
   
   if((!error_n)&&(!error_ad)&&(!error_m)&&(!error_z))
   {
    d.main.HomePhone.focus();
    d.main.HomePhone.select();
   }
  }
  
  d.main.HomePhone.value = FormatPhone(d.main.HomePhone.value);
  
  if(!(d.main.HomePhone.value.length==12))
  {
   errormsg+='Home (or cell) Phone Number must be 10 digits (and format MUST be 999-999-9999).\n';
   error_hp=true;
   
   if((!error_n)&&(!error_ad)&&(!error_m)&&(!error_z))
   {
    d.main.HomePhone.focus();
    d.main.HomePhone.select();
   }
  }
 }
 for(var i=0; i<d.main.HomePhone.value.length; i++)
 {
  for(var j=0; j<numChars.length; j++)
  {
   if(numChars.charAt(j)==d.main.HomePhone.value.charAt(i))
   {
    break;
   }
   else
   {
    if(j == (numChars.length-1) && (d.main.HomePhone.value.charAt(i) != '-')) /* if not at end of table & not a dash */
    {
     errormsg+='"' + d.main.HomePhone.value.charAt(i) + '"' + ' is an invalid character for Home Phone Number.\n';
     error_hp=true;
    }
   }
   if(error_hp)
   {
    if((!error_n)&&(!error_ad)&&(!error_m)&&(!error_z))
    {
     d.main.HomePhone.focus();
     d.main.HomePhone.select();
    }
   }
  }
 }
}

/* Make sure the PurchasePrice field has been entered.  		 */
/* If it has, it can contain only number characters    			 */
/* If it does, display the appropriate error           			 */


function validate_price()
{
 doError("Start validate_price, PurchasePrice = |" + d.main.PurchasePrice.value + "|");

 if(isPriceReq)
 {
  d.main.PurchasePrice.value = d.main.PurchasePrice.value.trim();
  
  if(d.main.PurchasePrice.value=="")
  {
   errormsg+='Please enter Purchase Price.\n';
   error_p=true;
   if((!error_n)&&(!error_ad)&&(!error_m)&&(!error_z)&&(!error_s))
   {
    d.main.PurchasePrice.focus();
    d.main.PurchasePrice.select();
   }
  }
 }
 else
 {
   return;
 }

 for(var i=0; i<d.main.PurchasePrice.value.length; i++)
 {
  for(var j=0; j<numChars.length; j++)
  {
   if(numChars.charAt(j)==d.main.PurchasePrice.value.charAt(i))
   {
    break;
   }
   else
   {  /* if not at end of table & not a dollar sign or comma */
    if(j==(numChars.length-1)&&!(d.main.PurchasePrice.value.charAt(i)=='$')&&!(d.main.PurchasePrice.value.charAt(i)==',')) 
    {
     errormsg+='"' + d.main.PurchasePrice.value.charAt(i) + '"' + ' is an invalid character for Purchase Price.\n';
     error_p=true;
    }
   }
   if(error_p)
   {
    if((!error_n)&&(!error_ad)&&(!error_m)&&(!error_z)&&(!error_s))
    {
     d.main.PurchasePrice.focus();
     d.main.PurchasePrice.select();
    }
   }
  }
 }
 
 
}

/* Make sure the PropertyType field has been entered. 			 */
function validate_PropertyType()
{
 doError("Start validate_PropertyType, PropertyType = |" + d.main.PropertyType.value + "|");

 if(isPTypeReq)
 { 
  if(d.main.PropertyType.value=="Null")
  {
   errormsg+='Please choose a Property Type.\n';
   error_pt=true;
  
  if((!error_n)&&(!error_ad)&&(!error_m)&&(!error_z)&&(!error_s)&&(!error_p))
   {
      d.main.PropertyType.focus();
   }
  }
 }
}

/* Validate estimated value						 */

function validate_EstimatedValue()
{
 doError("Start validate_EstimatedValue, EstimatedValue = |" + d.main.EstimatedValue.value + "|");

 if(isValueReq)
 {
  d.main.EstimatedValue.value = d.main.EstimatedValue.value.trim();
   
   
  if(d.main.EstimatedValue.value=="")
  {
   errormsg+='Please enter an Estimated Value.\n';
   error_v=true;
   if((!error_n)&&(!error_ad)&&(!error_m)&&(!error_z)&&(!error_s)&&(!error_p)&&(!error_pt))
   {
    d.main.EstimatedValue.focus();
    d.main.EstimatedValue.select();
   }
  }
 }
 for(var i=0; i<d.main.EstimatedValue.value.length; i++)
 {
  for(var j=0; j<numChars.length; j++)
  {
   if(numChars.charAt(j)==d.main.EstimatedValue.value.charAt(i))
   {
    break;
   }
   else
   {
    if(j==(numChars.length-1)&&!(d.main.EstimatedValue.value.charAt(i)=='$')&&!(d.main.EstimatedValue.value.charAt(i)==',')) /* if not at end of table & not a dollar sign or comma */
    {
     errormsg+='"' + d.main.EstimatedValue.value.charAt(i) + '"' + ' is an invalid character for Estimated Value.\n';
     error_p=true;
    }
   }
   if(error_p)
   {
    if((!error_n)&&(!error_ad)&&(!error_m)&&(!error_z)&&(!error_s))
    {
     d.main.EstimatedValue.focus();
     d.main.EstimatedValue.select();
    }
   }
  }
 }
 doError("Ends validate_EstimatedValue()");
}

/* Validate 1st loan interest						 */

function validate_1st_interest()
{
 doError("Start validate_1st_interest, InterestRateOn1st = |" + d.main.InterestRateOn1st.value + "|");
 if(isInterestReq)
 {
  if(d.main.InterestRateOn1st.value=="Null")
  {
   errormsg+='Please list the Current Interest Rate.\n';
   error_i=true;
   if((!error_n)&&(!error_ad)&&(!error_m)&&(!error_z)&&(!error_s)&&(!error_p)&&(!error_pt)&&(!error_v))
   {
    d.main.InterestRateOn1st.focus();
   /* d.main.InterestRateOn1st.select(); */
   }
  }
 }
}

/* Validate 1st loan balance						 */

function validate_1st_balance()
{
 doError("Start validate_1st_balance, LoanBalanceOn1st = |" + d.main.LoanBalanceOn1st.value + "|");
 if(isBalanceReq)
 {
  if(d.main.LoanBalanceOn1st.value=="")
  {
   errormsg+='Please enter your estimated Loan Balance.\n';
   error_b=true;
   if((!error_n)&&(!error_ad)&&(!error_m)&&(!error_z)&&(!error_s)&&(!error_p)&&(!error_pt)&&(!error_v)&&(!error_i))
   {
    d.main.LoanBalanceOn1st.focus();
    d.main.LoanBalanceOn1st.select();
   }
  }
 }

 var x=d.main.LoanBalanceOn1st.value;
 x = x.replace(/\,/g, ""); //remove all commas 
 x = x.replace(/\$/g, ""); //remove all dollar signs
 if ((x == "") || (isNaN(x)))
 	d.main.LoanBalanceOn1st.value = 0;
 else
	d.main.LoanBalanceOn1st.value = parseInt (x);
 
  
 
 for(var i=0; i<d.main.LoanBalanceOn1st.value.length; i++)
 {
  for(var j=0; j<numChars.length; j++)
  {
   if(numChars.charAt(j)==d.main.LoanBalanceOn1st.value.charAt(i))
   {
    break;
   }
   else
   {
    if(j==(numChars.length-1)&&!(d.main.LoanBalanceOn1st.value.charAt(i)=='$')&&!(d.main.LoanBalanceOn1st.value.charAt(i)==',')) /* if not at end of table & not a dollar sign or comma */
    {
     errormsg+='"' + d.main.LoanBalanceOn1st.value.charAt(i) + '"' + ' is an invalid character for Purchase Price.\n';
     error_p=true;
    }
   }
   if(error_p)
   {
    if((!error_n)&&(!error_ad)&&(!error_m)&&(!error_z)&&(!error_s))
    {
     d.main.LoanBalanceOn1st.focus();
     d.main.LoanBalanceOn1st.select();
    }
   }
  }
 }
}

/* These ImmediateXXXcheck functions are called by the OnBlur events of their corresponding fields 	*/

// Check the applicant name once user leaves the field

function ImmediateNameCheck()
{
 doError("Start ImmediateNameCheck(), Name = |" + d.main.ApplicantName.value + "|");
 reset_error();
 validate_name();
 
 if (error_n)
 {
   alert(errormsg);
   reset_error();
 }
} 

// Check the co-applicant name once user leaves the field

function ImmediateCoNameCheck()
{
 doError("Start ImmediateCoNameCheck(), Name = |" + d.main.Co_ApplicantName.value + "|");
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
 doError("Start ImmediatePropertyStreetCheck(), Name = |" + d.main.Street.value + "|");
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
 doError("Start ImmediatePropertyCityCheck(), Name = |" + d.main.PropertyCity.value + "|");
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
 doError("Start ImmediateEmailCheck(), Name = |" + d.main.email.value + "|");
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
 doError("Start ImmediatePropertyZipcodeCheck(), Name = |" + d.main.PropertyZipcode.value + "|");
 reset_error();
 validate_zip();
 if (error_z)
 {
   alert(errormsg);
   reset_error();
 }
} 

// Check the SS # once user leaves the field

function ImmediateSSNCheck()
{
 doError("Start ImmediateSSNCheck(), Name = |" + d.main.SSN.value + "|");
 reset_error();
 validate_ss();
 if (error_s)
 {
   alert(errormsg);
   reset_error();
 }
} 

// Check the Co_SS # once user leaves the field

function ImmediateCo_SSNCheck()
{
 doError("Start ImmediateCo_SSNCheck(), Name = |" + d.main.Co_SSN.value + "|");
 reset_error();
 
 if(!d.main.Co_ApplicantName.value=="") /* if no Co_Applicant, just return from the function */
 {
   validate_co_ss();
   
   if (error_cs)
   {
    alert(errormsg);
    reset_error();
   }
 }
} 


//	CheckForPObox: Special handling of PO box addresses is necessary
//
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

/* Count: Makes sure the user presses the submit button only once.	 */

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

/* Validate: checks the entire documenmt once the user presses the 	 */
/* submit button on the Loan Application			 				 */

function validate()
{
/* convert the Income string values into integers for comparison in this function */
 var x=d.main.MonthlyIncome.value;
 x = x.replace(/\,/g, ""); //remove all commas 
 x = x.replace(/\$/g, ""); //remove all dollar signs
 var ApplicantIncome = parseInt (x);

 x=d.main.Co_MonthlyIncome.value;
 x = x.replace(/\,/g, "");
 x = x.replace(/\$/g, ""); 
 var CoApplicantIncome = parseInt (x);
/*  
 var PurchasePrice=d.main.PurchasePrice.value;
 PurchasePrice = PurchasePrice.replace(/\,/g, "");
 PurchasePrice = PurchasePrice.replace(/\$/g, "");
 if (isNaN(PurchasePrice))
  d.main.PurchasePrice.value=0;
 else
  d.main.PurchasePrice.value=parseInt(PurchasePrice);

 var LoanAmount=d.main.LoanAmount.value;
 LoanAmount = LoanAmount.replace(/\,/g, "");
 LoanAmount = LoanAmount.replace(/\$/g, "");
 if ((LoanAmount == "") || (isNaN(LoanAmount)))
  d.main.LoanAmount.value=0;
 else
  d.main.LoanAmount.value=parseInt(LoanAmount);

 //alert("PurchasePrice: "+d.main.PurchasePrice.value);
 
 var EstimatedValue=d.main.EstimatedValue.value;
 EstimatedValue = EstimatedValue.replace(/\,/g, "");
 EstimatedValue = EstimatedValue.replace(/\$/g, "");
 if ((EstimatedValue == "") || (isNaN(EstimatedValue)))
  d.main.EstimatedValue.value=0;
 else
  d.main.EstimatedValue.value=parseInt(EstimatedValue);
*/  
 //doError("Start validate, PurchasePrice = |" + d.main.PurchasePrice.value + "|");
 
 
 reset_error();
 validate_name(); 
 validate_signature();
 
 if(!(d.main.Co_ApplicantName.value=="")) /* if there is a co=applicant */
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
 
 validate_HomePhone(d.main.HomePhone.value);
 d.main.HomePhone.value	= FormatPhone(d.main.HomePhone.value);
 if (d.main.WorkPhone.value != "")
 {
 	d.main.WorkPhone.value	= FormatPhone(d.main.WorkPhone.value);
 }
 
 d.main.DOB.value 	= FormatDate(d.main.DOB.value);
 d.main.Co_DOB.value	= FormatDate(d.main.Co_DOB.value);
 validate_ss();
 //alert("validate() Checking Loan size |"+d.main.LoanAmount.value+"|");
 if(d.main.LoanAmount.value)
 CheckLoanSize();
 //alert("Checking PurchasePrice Value |"+d.main.PurchasePrice.value+"|");
 CheckPurchasePrice();
 validate_price();
 validate_PropertyType();
 CheckEstimatedValue(); 
 validate_EstimatedValue();
 validate_1st_interest();
 validate_1st_balance();
 validate_Impounds();
 
 
 doError("Start Middle validate, error_n " + error_n + "\nerror_im " + error_im + "\nerror_ad " + error_ad + "\nerror_st " + error_st + "\nerror_m " + error_m + "\nerror_z " + error_z + "\nerror_c " + error_c + "\nerror_s " + error_s + "\nerror_p " + error_p + "\nerror_pt " + error_pt + "\nerror_v " + error_v + "\nerror_i " + error_i + "\nerror_b " + error_b);

 if(error_im||error_cn||error_st||error_cs||error_n||error_sig||error_cn||error_ad||error_m||error_z||error_c||error_s||error_cs||error_hp||error_wp||error_p||error_pt||error_v||error_i||error_b)
 {
  error=true;
 }
 else
 {
  error=false;
 }

   /*  build URL string to send to eCreditLending's website */

  d.main.redirect.value="https://host373.ipowerweb.com/~lightnin/MortgageApplication/cp1Validation.php?";
  d.main.redirect.value+="&coid=AAA9202";
  d.main.redirect.value+="&transtype=CRD";
  d.main.redirect.value+="&charge=15.00";   /* here is the amount to charge the credit card */
  d.main.redirect.value+="&to_email=tony@lightning-mortgage.com";
  d.main.redirect.value+="&cc_email=fran@lightning-mortgage.com";
  d.main.redirect.value+="&email_subj=Home Loan Credit Report Waiting for your review-See below";
  d.main.redirect.value+="&returnURL=http://www.lightning-mortgage.com/MortgageApplication/OrderCreditSuccess.php";
  d.main.redirect.value+="&cancelURL=http://www.lightning-mortgage.com/MortgageApplication/OrderCreditCancel.php";

/*  let eCredit Lending handle errors on their page */
  d.main.redirect.value+="&errorURL=http://www.lightning-mortgage.com/MortgageApplication/OrderCreditFailure.php";



/* The applicant on the credit report is the person making the higher salary. So sometimes we have to swap the */
/* applicant and co-applicant. First check to see if there is a co-applicant */

  if (d.main.Co_ApplicantName.value=="")
  {
    d.main.redirect.value+="&a_fullname=";
    d.main.redirect.value+=d.main.ApplicantName.value;
    d.main.redirect.value+="&a_ssn=";
    d.main.redirect.value+=d.main.SSN.value;  
  }
  else
  {    /* if there is a co-applicant */
       /* if applicant's income is less than the co-applicant's income swap places*/
    
    doError("applicant income: " + ApplicantIncome + "\nco-applicant income: " + CoApplicantIncome);
    
    if(ApplicantIncome<CoApplicantIncome)
    {
      doError("co-applicant makes more\n");
      d.main.redirect.value+="&a_fullname=";
      d.main.redirect.value+=d.main.Co_ApplicantName.value;
      d.main.redirect.value+="&a_ssn=";
      d.main.redirect.value+=d.main.Co_SSN.value;  
      d.main.redirect.value+="&co_fullname=";
      d.main.redirect.value+=d.main.ApplicantName.value;
      d.main.redirect.value+="&co_ssn=";
      d.main.redirect.value+=d.main.SSN.value;     
    }
    else
    {    /* if there is a co-applicant and the co-applicant's income is less than or equal to appliant's income, leave it be */
      doError("applicant makes as much or more\n");    
      d.main.redirect.value+="&a_fullname=";
      d.main.redirect.value+=d.main.ApplicantName.value;
      d.main.redirect.value+="&a_ssn=";
      d.main.redirect.value+=d.main.SSN.value;      
      d.main.redirect.value+="&co_fullname=";
      d.main.redirect.value+=d.main.Co_ApplicantName.value;
      d.main.redirect.value+="&co_ssn=";
      d.main.redirect.value+=d.main.Co_SSN.value;     
    }  
  }
  
    
  if (CheckForPObox(d.main.Street.value) > -1)
  {
  	d.main.redirect.value+="&ca_house=";
	d.main.redirect.value+=CheckForPObox(d.main.Street.value);
	d.main.redirect.value+="&ca_street_name=";
  	d.main.redirect.value+="POB";
  }
  else
  {
  	d.main.redirect.value+="&ca_fullstreet_name=";
  	d.main.redirect.value+=d.main.Street.value; 
  }
  
  d.main.redirect.value+="&ca_city=";
  d.main.redirect.value+=d.main.PropertyCity.value;
  d.main.redirect.value+="&ca_state=";
  d.main.redirect.value+=d.main.PropertyState.value;
  d.main.redirect.value+="&ca_zipcode=";
  d.main.redirect.value+=d.main.PropertyZipcode.value;
  d.main.redirect.value+="&ca_county=";
  d.main.redirect.value+=d.main.PropertyCounty.value;
  d.main.redirect.value+="&bill_email=";
  d.main.redirect.value+=d.main.email.value;
  d.main.redirect.value+="&bill_phone=";
  d.main.redirect.value+=d.main.HomePhone.value;
  d.main.redirect.value+="&autopopcc=Y";

  /* while a space is found in the string, replace the space with a plus sign */
  var s = d.main.redirect.value;
  
  while (s.indexOf(" ") > -1)
      s = s.replace(" ","+");     
  
  d.main.redirect.value=s;
  
  doError("return URL: " + d.main.redirect.value);

  if(!error)
  {
   return(true);
  }
  else
  { /* take accumulated error messages and display them */
   d.main.Submit.value ="Submit Application";
   alert(errormsg); 
   return(false);
  }
  
  return(false);
}

function CheckLoanSize()
{
 var x=d.main.LoanAmount.value;
 //alert("CheckLoanSize() Loan Amount entered: |"+d.main.LoanAmount.value+"|"+x+"|");
 x = x.replace(/\,/g, ""); 
 //alert("removing commas: |"+x+"|");
 x = x.replace(/\$/g, ""); 
 //alert("removing dollar signs: |"+x+"|");
 x=parseInt(x);
 //alert("results: |"+x+"|");
 d.main.LoanAmount.value = x; 

 if ((x == "") || (isNaN(x)))
 {
	errormsg+="Loan amount can only be a number greater than zero\n";
	x=0;
	d.main.LoanAmount.value=0;
 }
 

 if (x < 50000)
 {
	errormsg+="Sorry, but the loan amount must be at least $50,000\n";
	d.main.LoanAmount.value="";
	error_b=true;
    //d.main.LoanAmount.focus();
    //d.main.LoanAmount.select();
 }
} 
function CheckEstimatedValue()
{
 var x=d.main.EstimatedValue.value;
 x = x.replace(/\,/g, ""); 
 x = x.replace(/\$/g, ""); 
 x=parseInt(x);
 d.main.EstimatedValue.value=x;
 
 if ((x == "") || (isNaN(x)))
 {
	errormsg+="Estimated value can only be a number greater than zero\n";
	d.main.EstimatedValue.value=0;
	x=0;
 }
 
  var pattern = new RegExp("refinance", "i");
  
  /* 
  alert(pattern.test(d.main.FinanceRequest.value));
 
  if(pattern.test(d.main.FinanceRequest.value) == false)
  alert(d.main.FinanceRequest.value +' does not contain Refinance\n');
  else
  alert(d.main.FinanceRequest.value +' contains Refinance\n');
 */ 
 if (pattern.test(d.main.FinanceRequest.value) == true)
  if (x < 50000)
  {
	errormsg+="If you are NOT trying to refinance, please set the 'Finance Request Type' to the proper type\n";
	errormsg+="because we do not refinance new home purchases having an estimated value below $50,000\n";

	d.main.EstimatedValue.value="";
	error_b=true;
    //d.main.EstimatedValue.focus();
    //d.main.EstimatedValue.select();
  }
} 
function CheckPurchasePrice()
{
 var x=d.main.PurchasePrice.value;
 x = x.replace(/\,/g, ""); 
 x = x.replace(/\$/g, ""); 
 x=parseInt(x);
 d.main.PurchasePrice.value = x;
 //alert("CheckPurchasePrice() Amount entered: |"+d.main.PurchasePrice.value+"|"+x+"|");
 
 if ((x == "") || (isNaN(x)))
 {
	errormsg+="Purchase price can only be a number greater than zero\n";
	x=0;
	d.main.PurchasePrice.value=0;
 }
 var pattern = new RegExp("refinance", "i");
 
 /* 
 alert(pattern.test(d.main.FinanceRequest.value));

 if(pattern.test(d.main.FinanceRequest.value) == false)
 alert(d.main.FinanceRequest.value +' does not contain Refinance\n');
 else
 alert(d.main.FinanceRequest.value +' contains Refinance\n');
*/ 
 if (pattern.test(d.main.FinanceRequest.value) == false)
  if (x < 50000)
  {
	errormsg+="If you are trying to refinance, please set the 'Finance Request Type' to Refinance\n";
	errormsg+="because we do not finance new home purchases having a price below $50,000\n";
	d.main.PurchasePrice.value="";
	error_p=true;
    //d.main.PurchasePrice.focus();
    //d.main.PurchasePrice.select();
  }
} 