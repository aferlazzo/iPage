<?php
$username="prontoc2_anthony";
$password="1commguru";


echo "Using:<br/>MySQL Username=$username<br />MySQL Password=$password</br />";

if (($username!=FALSE)&&($password!=FALSE))
{
    $link = mysql_connect('localhost', $username, $password)
        or die('Could not connect: ' . mysql_error());
	
    // Performing SQL query
    $query = 'show variables';
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    

    // Printing results in HTML
    echo "<p><b>Variables:</b></p>";
    echo "<table>\n";
    while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
        echo "\t<tr>\n";
        foreach ($line as $col_value) {
            echo "\t\t<td>$col_value</td>\n";
        }
        echo "\t</tr>\n";
    }
    echo "</table>\n";
    
    // Free resultset
    mysql_free_result($result);
    
    // Performing SQL query
    $query = 'show status';
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());

    // Printing results in HTML
    echo "<p><b>Status:</b></p>";
    echo "<table>\n";
    while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
        echo "\t<tr>\n";
        foreach ($line as $col_value) {
            echo "\t\t<td>$col_value</td>\n";
        }
        echo "\t</tr>\n";
    }
    echo "</table>\n";

    // Free resultset
    mysql_free_result($result);

    // Closing connection
    mysql_close($link);
}
?>

