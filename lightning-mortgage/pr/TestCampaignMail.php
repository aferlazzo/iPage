<?php

	print("<form name=InstantForm' action='TestCampaignMailAction.php' method='post'>\n");
	print ("<input type='hidden' name='arid' value='176'>\n");
	print ("<input type='hidden' name='MsgNo' value='-2'>\n");
	print ("<input type='hidden' name='InstantTestFullName' 	value= 'Anthony Ferlazzo';>\n");
	print ("<input type='hidden' name='InstantTestEmailAddress' value= 'aferlazzo@gmail.com';>\n");
	print ("<input type='hidden' name='InstantTestUserDefined1'	value= '';>\n");
	print ("<input type='hidden' name='InstantTestUserDefined2'	value= '';>\n");
	print ("<input type='hidden' name='InstantTestUserDefined3'	value= '';>\n");
	print ("<input type='hidden' name='InstantTestUserDefined4'	value= '';>\n");
	print ("<input class='submit' type='submit' name='OtherT' value='Send Test to Campaign Originator' style='width:270px;' onClick=\"this.value='Testing'\" ");
	print ("onMouseover=\"this.className='MouseOver'\" onMouseout=\"this.className='submit'\" title='Send an instant test of the welcome message to $arfromemail'>\n");
	print ("</form>\n");
?>
