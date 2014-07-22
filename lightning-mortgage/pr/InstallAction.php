<?php

if ($dbname != "website_PerfectResponse")  // check to see if they've entered something
{
	$fp = fopen ("db.inc.php", "w+");
	$SettingStr="<?\n\$dbhostname = \"$dbhostname\";".
	"\n\$dbname = \"$dbname\";".
	"\n\$dbuname = \"$dbuname\";".
	"\n\$dbpwd = \"$dbpwd\";".
	"\n?>";
	fwrite($fp,$SettingStr);
	fclose($fp);

	$link = @mysql_connect("$dbhostname", "$dbuname", "$dbpwd") or die ("Unable to connect to MySQL server<br>Make sure you are using correct Server Name,Username and Password<br>Please go <a href='javascript:history.back();'>back</a> and check again");
	@mysql_select_db("$dbname", $link) or die ("Unable to connect to the Database<br>Make sure you are using correct Database Name<br>And user has access to the database<br>Please go <a href='javascript:history.back();'>back</a> and check again");

	$CSQL="select * from admin";
	$result=@mysql_query($CSQL, $link);

	if($result)
	{
		echo "<i>Perfect Response</i> database already exists.<br>Delete all existing tables if you want to perform a new intallation";
		exit;
	}
	
	$CSQL="CREATE TABLE 'admin' (
  'Type' enum('client','user','demo') NOT NULL default 'demo',
  'Eval' enum('true','false') NOT NULL default 'true',
  'JoinDate' bigint(15) NOT NULL default '0',
  'adminname' varchar(20) default NULL,
  'adminpwd' varchar(15) default NULL,
  'StartPage' varchar(40) NOT NULL default './DisplayPage.php',
  'arurl' varchar(255) default 'http://www.lightning-mortgage.com/pr',
  'ClientOnPage' varchar(4) NOT NULL default '',
  'SleepTime' tinyint(3) NOT NULL default '1',
  'ClientName' varchar(40) NOT NULL default '',
  'ConsultantName' varchar(40) default 'RE Consultant',
  'UName' varchar(40) NOT NULL default 'Ruser',
  'CName' varchar(40) NOT NULL default 'client4Ruser',
  'adminemail' varchar(50) default NULL,
  'manarid' tinyint(3) unsigned default NULL,
  'ActivityLogging' tinyint(3) NOT NULL default '0',
  'Ad' int(10) unsigned default '0',
  'FirstName' varchar(20) NOT NULL default '',
  'LastName' varchar(20) NOT NULL default '',
  'CreditCard' varchar(20) NOT NULL default '',
  'Month' smallint(6) NOT NULL default '0',
  'Year' smallint(6) NOT NULL default '0',
  'Street' varchar(40) NOT NULL default '',
  'City' varchar(20) NOT NULL default '',
  'State' varchar(20) NOT NULL default '',
  'Zip' varchar(10) NOT NULL default '',
  'category' varchar(10) NOT NULL default '',
  'phone' varchar(15) NOT NULL default '',
  UNIQUE KEY 'adminname' ('adminname'),
  KEY 'adminemail' ('adminemail'))";								

	$result=@mysql_query($CSQL, $link) or die("Could not create admin table ($CSQL) Error: $msgSQL");

die("created admin table");

	$CSQL="CREATE TABLE autoresponders (arid int(8) unsigned NOT NULL auto_increment,
										arname varchar(100) default NULL,
										arfromemail varchar(100) default NULL,
										arreplytoemail varchar(100) default NULL,
										arbademail varchar(100) default NULL,
										aradminemail varchar(100) default NULL,
										armode tinyint(1) default '1',
										mansubject varchar(100) default NULL,
										manbody text,
										conpage varchar(255) default NULL,
										remhtml varchar(100) default NULL,
										remtext varchar(100) default NULL,
										smtphostname varchar(100) default NULL,
										smtpport tinyint(3) unsigned default '110',
										smtpuname varchar(50) default NULL,
										smtppwd varchar(25) default NULL,
										pophostname varchar(100) default NULL,
										popuname varchar(50) default NULL,
										poppwd varchar(25) default NULL,
										popport tinyint(3) unsigned default '110',
										jsmsg varchar(255) default NULL,
										arsubemail varchar(100) default NULL,
										CampaignState varchar(10) default NULL,
										aremailformat tinyint(1) unsigned default '0',
										arwraplen tinyint(3) unsigned default '60',
										arwordwrap tinyint(1) unsigned default '0',
										customconf tinyint(1) unsigned default '0',
										custompage varchar(255) default NULL,
										ardescription varchar(30) default NULL,
										user varchar(15) default NULL,
										PRIMARY KEY  (arid),
										UNIQUE KEY arid (arid),
										KEY arid_2 (arid))";
	$result=@mysql_query($CSQL, $link) or die("Could not create autoresponders table ($CSQL) Error: $msgSQL");


	$CSQL="CREATE TABLE messages   (mid int(10)
									unsigned NOT NULL auto_increment,
									arid tinyint(3) unsigned default '0',
									subject varchar(255) default NULL,
									body text,
									delay tinyint(3) default '0',
									seqno int(4) default '0',
									PRIMARY KEY  (mid),
									UNIQUE KEY mid (mid),
									KEY mid_2 (mid))";
	$result=@mysql_query($CSQL, $link) or die("Could not create messages table ($CSQL) Error: $msgSQL");
/*
	$CSQL="CREATE TABLE users  (uid int(8) unsigned NOT NULL auto_increment,
								arid int(6) unsigned default '0',
								fname varchar(25) default NULL,
								lname varchar(25) default NULL,
								email varchar(100) default NULL,
								ip varchar(15) default NULL,
								method char(1) default 'I',
								confirmed char(1) default 'N',
								senddate INT default '0',
								currentmsg tinyint(3) unsigned default NULL,
								confdel char(1) default 'N',
								UserDefined1 varchar(25) default NULL,
								UserDefined2 varchar(25) default NULL,
								UserDefined3 varchar(25) default NULL,
								UserDefined4 varchar(25) default NULL,
								PRIMARY KEY (uid);
*/								
	$CSQL="CREATE TABLE 'users' (
  'uid' int(8) unsigned NOT NULL auto_increment,
  'arid' int(6) unsigned default '0',
  'fname' varchar(35) default NULL,
  'lname' varchar(35) default NULL,
  'email' varchar(100) default NULL,
  'ip' varchar(15) default NULL,
  'method' char(1) default 'I',
  'confirmed' char(1) default 'N',
  'senddate' int(11) default '0',
  'currentmsg' tinyint(3) unsigned default NULL,
  'confdel' char(1) default 'N',
  'UserDefined1' varchar(25) default NULL,
  'UserDefined2' varchar(25) default NULL,
  'UserDefined3' varchar(25) default NULL,
  'UserDefined4' varchar(25) default NULL,
  'LockKey' int(11) unsigned NOT NULL,
  'LockExpiryTime' bigint(20) NOT NULL default '0',
  PRIMARY KEY  ('uid')
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 PACK_KEYS=1 AUTO_INCREMENT=1 ";

	$result=@mysql_query($CSQL, $link) or die("Could not create users table ($CSQL) Error: $msgSQL");

	// The value doesn't work out-of-the box!!

	$CSQL="INSERT INTO admin VALUES('admin',
									'admin',
									'http://www.prontocommercial.com/pr',
									'/usr/bin/perl',
									'admin@prontocommercial.com', 140,1,45)";
	$result=@mysql_query($CSQL, $link) or die("Could not create admin entry ($CSQL) Error: $msgSQL");


	$CSQL="CREATE TABLE autoresponders (arid int(8) unsigned NOT NULL auto_increment,
											arname varchar(100) default NULL,
											arfromemail varchar(100) default NULL,
											arreplytoemail varchar(100) default NULL,
											arbademail varchar(100) default NULL,
											aradminemail varchar(100) default NULL,
											armode tinyint(1) default '1',
											mansubject varchar(100) default NULL,
											manbody text,
											conpage varchar(255) default NULL,
											remhtml varchar(100) default NULL,
											remtext varchar(100) default NULL,
											smtphostname varchar(100) default NULL,
											smtpport tinyint(3) unsigned default '110',
											smtpuname varchar(50) default NULL,
											smtppwd varchar(25) default NULL,
											pophostname varchar(100) default NULL,
											popuname varchar(50) default NULL,
											poppwd varchar(25) default NULL,
											popport tinyint(3) unsigned default '110',
											jsmsg varchar(255) default NULL,
											arsubemail varchar(100) default NULL,
											CampaignState varchar(10) default NULL,
											aremailformat tinyint(1) unsigned default '0',
											arwraplen tinyint(3) unsigned default '60',
											arwordwrap tinyint(1) unsigned default '0',
											customconf tinyint(1) unsigned default '0',
											custompage varchar(255) default NULL,
											PRIMARY KEY  (arid),
											UNIQUE KEY arid (arid),
										KEY arid_2 (arid))";
	$result=@mysql_query($CSQL, $link) or die("Could not create users table ($CSQL) Error: $msgSQL");

	$CSQL="INSERT INTO autoresponders VALUES(0,
										'initial build',
										'', '', '', '',1,'','','','','','','','',110,'','','',0,60,0,0,'')";
	$result=@mysql_query($CSQL, $link) or die("Could not create admin entry ($CSQL) Error: $msgSQL");
}


?>
<html>
<head>
<title>Perfect Response Installer</TITLE>
<meta name="robots" content="NoIndex, NoFollow">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="./css/PerfectResponse.css">
</head>

<body>
<div class="content">
<div class="title">
<table  width='95%' BORDER=0 CELLPADDING='4' CELLSPACING='0' align="center">
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td width="45%"><td>
		<td width="55%"><h2>&nbsp;</h2>
		</td>
	</tr>
	<tr><td>
</div>

<h2><i>Perfect Response</i>&#153; Installer 1.5</font></i></b><br></h2>

<?php
	if ($dbname == "website_PerfectResponse")
	{
		print("<font color='#FFFFFF' size='2' face='Verdana, Arial, Helvetica, sans-serif'>");
		print("<b>Install Incomplete. Please enter the database location information</b><br><br>&nbsp;");
	}
	else
	{
?>
  <p><br>
    <font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica, sans-serif">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>Perfect Response</i> has detected that the absolute path of your <i>Perfect Response</i> scripts is </font>
    <b><font face="Arial, Helvetica, sans-serif" color="#FFFFFF" size="2">
    <?php echo dirname($SCRIPT_FILENAME) ?></font></b><br>
<!--
      <br>
      In order to perform automated mail out and email capture please setup cron
      event on following files:<b><br>
      <br>
      </b>1- mailout.php<br>
      <br>
      </b>You need to schedule these jobs on daiy basis on whatever time you think
      is suitable.</font></p>
    <p><font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica, sans-serif">To
      schedule cron jobs, use one of the following methods.</font></p>
    <p><font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Method
      1:</strong></font></p>
    <p><font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica, sans-serif">Login
      to you hosting control panel and schedule cron as:</font></p>
    <p><b><font face="Arial, Helvetica, sans-serif" color="#FFFFFF" size="2">00
      00 * * * /usr/bin/php <?php echo dirname($SCRIPT_FILENAME) ?>/mailout.php</p>
    <p><font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Method
      2:</strong></font></p>
    <p><font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica, sans-serif">Make
      a text file named cron.txt with following entries. And add it to crontab using
      ssh or telnet.</font></p>
    <p><b><font face="Arial, Helvetica, sans-serif" color="#FFFFFF" size="2">00 00 * * * /usr/bin/php <?php echo dirname($SCRIPT_FILENAME) ?>/mailout.php</b></p>
-->

<ul>
<li><font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica, sans-serif">
  /usr/bin/php is your php interpreter path. Many hosting companies also have /usr/local/bin/php as its path.<br>
  Confirm this path with your hosting company's support department if you cannot access the database.</font></li>
<li><font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica, sans-serif">
<?php echo dirname($SCRIPT_FILENAME) ?>
  is the detected absolute path where your <i>Perfect Response</i> script files resides.</font></li>
</ul>

  </b> Your default password is <b>admin</b>. Please click <a href="default.php"><b>here</b></a> to access <i>Perfect Response</i>.<b><br>
  <br>
</table>
</div>

<?php
}
?>

<div class="footer">
	<p style="text-align: center"><a href="manar.php" title="Work with another Campaign">
	Work with another Email Campaign</a>&nbsp;::&nbsp;
	<a href="home.php" title="Perfect Response Home...">Return Home</a>&nbsp;::&nbsp;
	<a href='<?php echo "$PHP_SELF?arid=$arid" ?>' onclick="return(LLogout());">Logout</a>
	</center></p>
</div>
</body>
</html>
