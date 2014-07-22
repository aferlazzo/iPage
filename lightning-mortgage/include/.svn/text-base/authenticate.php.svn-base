<?php
// 	Script for Authentication Using a MySQL Database
// 	The cool thing about PHP code is that it never gets sent to the browser. They can't "view source" to
//	see how it's done!!


//	Important! This routine must be run prior to HTML running.

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
//
//	Validate Username/Passwords Using a Database
//	From http://www.zend.com/zend/tut/authentication.php#Heading1
//	This final example shows how to compare an authentication dialog box username/password pair
//	with a list of username/password pairs residing in a database table. The example below uses PHP's
//	MySQL connection functions. However, you can use any built-in database connectivity function suitable
//	to your particular environment.
//
//	Suppose that your table is called "users" and looks something like this:
//
//	+-----------+-----------+-----------+
//	|RealName	|UserName	|Password	|
//	+-----------+-----------+-----------+
//	|Joe Smith	|joe 		|ai890d		|
//	|Jane Smith	|jane 		|29hj0jk 	|
//	|Mary Smith	|mary		|fsSS92 	|
//	|Bob Smith	|bob 		|2NNg8ed 	|
//	|Dilbert	|dilbert 	|a76zFs		|
//	+-----------+-----------+-----------+
//
//	To exact a match for both a username and a password, your SQL statement could be:
//
//	SELECT * FROM Users
//	WHERE username='$PHP_AUTH_USER' and password='$PHP_AUTH_PW'
//	From the above example, a positive result will be returned when the values for $PHP_AUTH_USER
//	AND $PHP_AUTH_PW both match exactly with their username and password field counterparts, as
//	entered in the users table.
//
//	Code Flow
//	Initially assume that the user has not been authorized, by assigning the (Boolean) flag $auth
//	the value 'false';
//	Use isset() to verify whether or not values already exist for $PHP_AUTH_USER and $PHP_AUTH_PW.
//	Prompt the browser to display an authentication dialog box if no value exists for either
//	$PHP_AUTH_USER or $PHP_AUTH_PW. $auth remains defined as 'false'.
//	If values have been assigned to $PHP_AUTH_USER and $PHP_AUTH_PW, connect to the database and
//	execute a query.
//	If the query returns at least one row, then a match has been found. Set $auth to 'true' to
//	indicate that the user has been authenticated. Display a success message.
//	If the user has not been authenticated, $auth remains false and prompt the browser to display
//	the dialog box.
//
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -


/* variables to access Database */

	$Host="localhost";
	$User="lightnin_Tony";
	$Password="ipowerwe";
	$DBname="lightnin_LoanApps";
	$TableName="Users";

$auth = false; // Assume user is not authenticated

/*
Use isset() to verify whether or not values already exist for $PHP_AUTH_USER and $PHP_AUTH_PW.
Within the same statement, if values do exist for both variables, then compare them to the hard
coded values in the script.
Prompt the browser to display an authentication dialog box if $PHP_AUTH_USER is not defined as
'user' or $PHP_AUTH_PW is not defined as 'open'. Otherwise, prompt the browser to display a success message.
If both the username and password match hard-coded values in the script, then print a success message.

*/

if (isset($PHP_AUTH_USER) && isset($PHP_AUTH_PW)) //Are these two global variables set?
{												  //If so, see if the names match the database...

    // Connect to MySQL

    mysql_connect ($Host, $User, $Password) or die ('Unable to connect to server or database.');

    // Select database on MySQL server

    mysql_select_db( $DBname ) or die ( 'Unable to select database.' );

    // Formulate the query

    $sql = "SELECT * FROM $TableName WHERE
            username = '$PHP_AUTH_USER' AND
            password = '$PHP_AUTH_PW'";

    // Execute the query and put results in $Result

    $Result = mysql_query( $sql ) or die ( 'Unable to execute query.' );

    // Get number of rows in $result.

    $num = mysql_numrows( $Result );

    if ( $num != 0 )
    {

        // A matching row was found - the user is authenticated.


        $Record=mysql_fetch_array($Result);	// fetch the matching row in the User table
		$RealName = $Record[RealName];
		//print("User Name is $Record[RealName]<br>\n");
		$UserLevel=$Record[AdminUserGuest];
		//print("User Level is $UserLevel<br>\n");

		if (($UserLevel == "Admin") || ($UserLevel == "Guest"))
			$auth = true;
		else
		{
			//print ("Page requesting authorization: $PHP_SELF<br>\n");

			if (strstr($_SERVER['PHP_SELF'], "MyLoanStatus.php"))
				$auth = true;
		}
    }
}

if ( ! $auth ) {

    header( 'WWW-Authenticate: Basic realm="LAPS"' );
    header( 'HTTP/1.0 401 Unauthorized' );
    //echo 'Authorization failed! You must be an Administrator or Guest to access the console.';
    print ("<H1>Authorization Required</H1>This server could not verify that you are ");
	print ("authorized to access the document requested. Either you supplied the wrong ");
	print ("credentials (e.g., bad password), or your browser doesn't understand how to ");
	print ("supply the credentials required.<P><HR>");

	print ("<ADDRESS>Tony Security at www.lightning-mortgage.com Port 80</ADDRESS>");
    exit;

}
// else
// {
//     echo '<P>You are authorized!</P>';
// }
?>