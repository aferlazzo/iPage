<?php

/*

Perfect Response - Email Marketing at Its Best!
Copyright � Tony Ferlazzo 2004 
Version 1.0 Written by: Tony Ferlazzo, tony@lightning-mortgage.com

*/

include("check1.php");
Include("conn.php");
$ToArid			= $_GET["ToArid"];
$arid			= $_GET["ToArid"];
$FromArid		= $_GET['FromArid'];
$CloneUsers 	= $_GET["CloneUsers"];
$CloneMessages	= $_GET["CloneMessages"];
if ($ToArid=='')	//incase we are cloning the entire AR, the arid won't yet be assigned...
	$arid		= $_GET["FromArid"];

//die("CloneAR (".__LINE__.") For cloning an entire campaign: $FromArid CloneMessages: $CloneMessages CloneUsers: $CloneUsers");

$WithinScript="I know the arid";
include("settings.php");
		
	// get existing campaign
	
	$result = mysql_query("SELECT * FROM autoresponders where arid=$FromArid", $link); 
	$num_rows = mysql_num_rows($result);
	
	if ( $num_rows < 1 ) 
		die("Unable to find Autoresponder $FromArid.");
	// ----- to clone the AR, both $CloneMessages == 1 and $CloneUsers == 1
	
//die("CloneAR (".__LINE__.") selected $num_rows existing campaign: $FromArid CloneMessages: $CloneMessages CloneUsers: $CloneUsers");
	
	if (($CloneMessages == 1) && ($CloneUsers == 1))
	{
		mysql_data_seek($result, 0);
		$row = mysql_fetch_object($result);	
	
		$arname			= $row->arname;
		$arfromemail	= $row->arfromemail;
		$arreplytoemail = $row->arreplytoemail;
		$arbademail 	= $row->arbademail;
		$aradminemail	= $row->aradminemail;
		$mansubject 	= $row->mansubject;	
		$manbody 		= addslashes($row->manbody);
		$conpage 		= $row->conpage;
		$remhtml 		= addslashes($row->remhtml);
		$remtext 		= addslashes($row->remtext);
		$pophostname 	= $row->pophostname;
		$popuname 		= $row->popuname;
		$poppwd 		= $row->poppwd;
		$popport 		= $row->popport;
		$smtphostname 	= $row->smtphostname;
		$smtpuname 		= $row->smtpuname;
		$smtppwd 		= $row->smtppwd;
		$smtpport 		= $row->smtpport;
		$jsmsg 			= $row->jsmsg;
		$arsubemail 	= addslashes($row->arsubemail);
		$CampaignState 	= "Suspended";
		$customconf 	= $row->customconf;
		$aremailformat	= $row->aremailformat;
		$arwraplen 		= $row->arwraplen;
		$arwordwrap 	= $row->arwordwrap;
		$custompage 	= addslashes($row->custompage);
		$ardescription 	= "Clone:".addslashes($row->ardescription);
		$user		 	= $row->user;
		
		$SQL_InsertStatement= "insert into autoresponders (arname,
				arfromemail,
				arreplytoemail,
				arbademail,
				aradminemail,
				armode,
				mansubject,
				manbody,
				conpage,
				remhtml,
				remtext,
				pophostname,
				popuname,
				poppwd,
				popport,
				smtphostname,
				smtpuname,
				smtppwd,
				smtpport,
				jsmsg,
				arsubemail,
				CampaignState,
				aremailformat,
				arwraplen,
				arwordwrap,
				customconf,
				custompage,
				ardescription,
				user) 
						
		values	('$arname',
				'$arfromemail',
				'$arreplytoemail',
				'$arbademail', 
				'$aradminemail',
				$armode,
				'$mansubject',
				'$manbody',
				'$conpage',
				'$remhtml',
				'$remtext',		
				'$pophostname',
				'$popuname',
				'$poppwd',
				'$popport',
				'$smtphostname',
				'$smtpuname',
				'$smtppwd',
				'$smtpport',
				'$jsmsg',
				'$arsubemail',
				'$CampaignState',
				$aremailformat,
				$arwraplen,
				$arwordwrap,
				$customconf,
				'$custompage',
				'$ardescription',
				'$user')";	
		$result  = mysql_query($SQL_InsertStatement) or die("CloneAR (".__LINE__.") campaign clone insert failed: $SQL_InsertStatement");
		if ($result == false)
			die("<p>CloneAR (".__LINE__.") Error on ($SQL_InsertStatement):<br />".mysql_error($link));
		
		$ToArid=mysql_insert_id(); //now get the assigned arid for the inserted record

		if ($ToArid=="") 
			die("<b>CloneAR: Error receiving Autoresponder: '$ToArid'.");
	}
	// - - - - - - - - - - - - - - Clone Messages - - - - - - - - - - - - - - - - - - - - - - - - - - //
	
	if ($CloneMessages == 1)
	{
		//print("<p>CloneAR (".__LINE__.") From $FromArid to $ToArid. Copying Messages</p>"); 
		$msgSQL = "select * from messages where arid=$ToArid";
		$result_msg = mysql_query($msgSQL) or die("CloneAR (".__LINE__.") error: $msgSQL");	
		$NumberOfExistingMessages = mysql_num_rows($result_msg);
		if ($NumberOfExistingMessages == 0) // if this is a cloned campaign in the making
			$NumberOfExistingMessages = 5;	// then make room for sequence numbers -4, -3, -2, -1, and 0 
		$msgSQL = "select * from messages where arid=$FromArid order by seqno";
		$result_msg = mysql_query($msgSQL) or die("CloneAR (".__LINE__.") error: $msgSQL");	
		$NumberOfMessages = mysql_num_rows($result_msg);
		//die("CloneAR (".__LINE__.") There are $NumberOfMessages messages in campaign $FromArid to be cloned<br>");
	


		//	Every campaign will have the following common messages:
		//	seqno	subject
		//	-------	---------
		//	-4			Broadcast
		//	-3			Subscription Confirmation Message, in a 2-step opt-in
		//	-2			Welcome Message
		//	-1			Unsubscribe Acknowledgement Message
		//	 0			Campaign Signature
		//
		// When adding a new autoresponder, these empty messages will need to be created. 

		for ($i=-4; $i<1;$i++)
		{
			$DeleteQuery = "delete FROM messages where seqno='$i' and arid=$ToArid limit 1";
			$result = mysql_query($DeleteQuery, $link);	
			if ($result == false)
			{
				print("console.log('CloneAR ('.__LINE__.') Error on delete seqno $i:'.mysql_error($link));\n");
				print("<p>CloneAR.php (".__LINE__.") Error on deleting message ($DelectQuery):<br />".mysql_error($link));
			}
			//else
				//print("console.log('CloneAR ('.__LINE__.') deleted seqno $i:'.mysql_error($link));\n");
		}
		
		$result = mysql_query("INSERT INTO messages (arid, subject, body, delay, seqno) VALUES ($ToArid, 'Broadcast Message', '', 0, -4)", $link) or die("CloneAR: error -3");
		if ($result == false)
		{
			print("console.log('CloneAR ('.__LINE__.') Error on 'insert seqno -4:'.mysql_error($link));\n");
			die("<p>CloneAR ('.__LINE__.') Error on 'insert seqno -3:".mysql_error($link)."</p>");
		}
		$result = mysql_query("INSERT INTO messages (arid, subject, body, delay, seqno) VALUES ($ToArid, 'Subscription Confirmation Message', '', 0, -3)", $link) or die("CloneAR: error -3");
		if ($result == false)
		{
			print("console.log('CloneAR ('.__LINE__.') Error on 'insert seqno -3:'.mysql_error($link));\n");
			die("<p>CloneAR ('.__LINE__.') Error on 'insert seqno -3:".mysql_error($link)."</p>");
		}
		$result = mysql_query("INSERT INTO messages (arid, subject, body, delay, seqno) VALUES ($ToArid, 'Welcome Message', '', 0, -2)", $link) or die("CloneAR: error -2");
		if ($result == false)
		{
			print("console.log('CloneAR ('.__LINE__.') Error on 'insert seqno -2:'.mysql_error($link));\n");
			die("<p>CloneAR ('.__LINE__.') Error on 'insert seqno -2:".mysql_error($link)."</p>");
		}
		$result = mysql_query("INSERT INTO messages (arid, subject, body, delay, seqno) VALUES ($ToArid, 'Unsubscribe Acknowledgement Message', '', 0, -1)", $link) or die("CloneAR: error -1");
		if ($result == false)
		{
			print("console.log('CloneAR ('.__LINE__.') Error on 'insert seqno -1:'.mysql_error($link));\n");
			die("<p>CloneAR ('.__LINE__.') Error on 'insert seqno -1:".mysql_error($link)."</p>");
		}
		$result = mysql_query("INSERT INTO messages (arid, subject, body, delay, seqno) VALUES ($ToArid, 'Campaign Signature', '', 0, 0)", $link) or die("CloneAR: error 0");
		if ($result == false)
		{
			print("console.log('CloneAR ('.__LINE__.') Error on 'insert seqno 0:'.mysql_error($link));\n");
			die("<p>CloneAR ('.__LINE__.') Error on 'insert seqno 0:".mysql_error($link)."</p>");
		}
		//die("CloneAR (".__LINE__.") For cloning an entire campaign. We must put the new arid of the new campaign into the \$ToArid variable: $ToArid");

		//print("<p>CloneAR (".__LINE__.") From $FromArid to $ToArid. Copy Subscribers: $CloneUsers Copy Messages: $CloneMessages</p>"); 
	
		if ( $NumberOfMessages > 0 )
		{
			for ($i=0; $i < $NumberOfMessages; $i++)	// copy each message to the new arid
			{
				mysql_data_seek($result_msg, $i);
				$row	 = mysql_fetch_object($result_msg);
				$subject = addslashes($row->subject);
				$body	 = addslashes($row->body);
				$mid	 = $row->mid;
				if($row->seqno < 1) //for confirmation msg, welcome, opt-out msg, and msg signature
				{
					$seqno = $row->seqno;
					$UpdateQuery = "Update messages set body='$body' where seqno=$seqno and arid=$ToArid limit 1";
					$result  = mysql_query($UpdateQuery) or die("CloneAR (".__LINE__.") message clone update failed: $UpdateQuery");
					if ($result == false)
						die("<p>CloneAR (".__LINE__.") Error on ($UpdateQuery):<br />".mysql_error($link));
					//die("seqno: $seqno subject: $subject body<br />$body");
				}
				else
				{
					$delay	 = $row->delay;
					$seqno	 = $row->seqno + $NumberOfExistingMessages - 4; // the 3 special msg: -3 -2, -1, 0
	
					$SQL_InsertStatement = "INSERT INTO messages (arid, subject, body, delay, seqno) VALUES ($ToArid, '$subject', '$body', $delay, $seqno)";
					$result  = mysql_query($SQL_InsertStatement) or die("CloneAR (".__LINE__.") message clone insert failed: $SQL_InsertStatement");
					if ($result == false)
						die("<p>CloneAR (".__LINE__.") Error on ($SQL_InsertStatement):<br />".mysql_error($link));
				}
			}
			print("<script type='text/javascript'>;alert ('Copied $NumberOfMessages messages from campaign $FromArid to campaign $ToArid');</script>");
		}
		else
			print("<script type='text/javascript'>;alert ('No Messages found in campaign $FromArid to copy to campaign $ToArid');</script>");
	}
	// - - - - - - - - - - - - - - Clone Subscribers - - - - - - - - - - - - - - - - - - - - - - - - - - //
	
	if ($CloneUsers == 1)
	{
		//print("<p>CloneAR (".__LINE__.") From $FromArid to $ToArid. Copying Subscribers</p>"); 
		$userSQL = "select * from users where arid=$FromArid";
		$QueryResult = mysql_query($userSQL) or die("CloneAR (".__LINE__.") error: $userSQL");
		$NumberOfUsers = mysql_num_rows($QueryResult);
		//print("CloneAR (".__LINE__.") There are $NumberOfUsers subscribers in $FromArid to be cloned.<br/>");
		
		if ( $NumberOfUsers > 0 )
		{
			for ($i=0; $i < $NumberOfUsers; $i++)	// copy each user to the new campaign
			{
				mysql_data_seek($QueryResult, $i);
				$FromRow		= mysql_fetch_object($QueryResult);
				$fname			= addslashes($FromRow->fname);
				$lname			= addslashes($FromRow->lname);
				$email			= $FromRow->email;
				$ip				= $FromRow->ip;
				$method			= $FromRow->method;
				$confirmed		= $FromRow->confirmed;
				$senddate		= $FromRow->senddate;
				$currentmsg		= $FromRow->currentmsg;
				$confdel		= $FromRow->confdel;
				$UserDefined1	= addslashes($FromRow->UserDefined1);
				$UserDefined2	= addslashes($FromRow->UserDefined2);
				$UserDefined3	= addslashes($FromRow->UserDefined3);
				$UserDefined4	= addslashes($FromRow->UserDefined4);
					
				//check for duplicates before adding users
				
				$SQL_Statement = "select * from users where email='$email' and arid=$ToArid";
				$DupQuery_Result =  mysql_query($SQL_Statement, $link) or die ("CloneAR (".__LINE__.") db query failed: ". mysql_error($link));
				$Matches = mysql_num_rows($DupQuery_Result);

				if ($Matches == 0)	//There's no existing record in the db for this email address/campaign
				{
					$SQL_InsertStatement = "INSERT INTO users (arid, fname, lname, email, ip, method, confirmed, senddate, currentmsg, confdel, UserDefined1, UserDefined2, UserDefined3, UserDefined4) 
					VALUES ($ToArid, '$fname', '$lname', '$email', '$ip', '$method', '$confirmed', 0, -2, '$confdel', '$UserDefined1', '$UserDefined2', '$UserDefined3', '$UserDefined4')";
					$result  = mysql_query($SQL_InsertStatement) or die("CloneAR (".__LINE__.") user clone insert failed: $SQL_InsertStatement");
					if ($result == false)
						die("<p>CloneAR (".__LINE__.") Error on ($SQL_InsertStatement):<br />".mysql_error($link));
					//print ("CloneAR (".__LINE__.") Added user $fname &lt;$email&gt; cloned from autoresponder ($Clonedarid)<br>");
				}
				else //a matching subscriber email already exists in this campaign
				{
					//print("CloneAR (".__LINE__.") user $fname &lt;$email&gt; already exists in arid |$ToArid|. ***Note  that the user may not be an active subscriber.<br>");
					$SQL_UpdateStatement  = "update users set fname='$fname', lname='$lname', ip='$ip', method='$method', confirmed='$confirmed', "; 
					$SQL_UpdateStatement .= "senddate=0, currentmsg=-2, confdel='$confdel', UserDefined1='$UserDefined1', UserDefined2='$UserDefined2', ";
					$SQL_UpdateStatement .= "UserDefined3='$UserDefined3', UserDefined4='$UserDefined4' where arid=$ToArid and email='$email' limit 1"; 
					$result  = mysql_query($SQL_UpdateStatement) or die("CloneAR (".__LINE__.") user clone update failed: $SQL_UpdateStatement");
					if ($result == false)
						die("<p>CloneAR (".__LINE__.") Error on ($SQL_UpdateStatement):<br />".mysql_error($link));
				}
			}
			
			print("<script type='text/javascript'>;alert ('Cloned $NumberOfUsers subscribers from campaign $FromArid to campaign $ToArid');</script>");
		}
		else
			print("<script type='text/javascript'>;alert ('No subscribers found in campaign $FromArid to copy to campaign $ToArid');</script>");
		
	}

	print("<script language='javascript'>window.location.href='CampaignManager.php?arid=$ToArid&cmd=1';</script>\n");
?>
