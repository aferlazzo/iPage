<?php
    $mail_from = "tferlazzo@comcast.net";
    $mail_path = "~/usr/sbin/sendmail -i -t";
    $mail_to = "tony@lightning-mortgage.com";

    $mail_subject = "Are you Reading Me?";

    ini_set("sendmail_from", $mail_from);
    ini_set("sendmail_path", $mail_path);


    /* message */
	$message = '
	<html>
	<head>
	 <title>An HTML Message</title>
	</head>
	<body>
    We are returning from an Away mission to the <BR>archeological ruins on
Duldrums IV in a small <BR>shuttlecraft, the Walkman. Accompanying me were
<BR>Ensign Row, for security, Kaiko, for botany, and <BR>Guinan, for comic
relief. I myself had discovered <BR>a particularly interesting find, the eating
bowl <BR>of a small domesticated animal. We were lucky <BR>enough to find animal
sailva fossilized on the <BR>bowl, which my tricorder informs me is over 500
<BR>years old. <BR>    <BR>    "Imagine that," said Picard, caressing the
<BR>bowl foundly. <BR>    "Imprints of animal spit," said Ensign Row. <BR>
"500 year old fossilized remains of animal <BR>saliva," Picard corrected. "Think
of how much we <BR>can learn. How much did the animal slobber over <BR>its
dinner? What was the size of its typical <BR>globs of saliva? Ah, there is so
much information <BR>here!" He smiled, looking like a 12 year old. <BR>
"Captain, we\'re coming on an energy field," <BR>said Row. In a few seconds, it
was tearing the <BR>Walkman apart. <BR>    "Contact the ship!" said Picard.
"Beam us <BR>up!" <BR>    "I can\'t!" said Whoopi. "I\'m getting a busy
<BR>signal!" <BR>    Picard grunted. "It\'s probably Dr. Crusher, <BR>talking to
that Wesley child again. Use emergency <BR>override, and break through!" <BR>
Contact was established. "Beam us out of <BR>here!" said Picard. <BR>    Moments
later, in the transporter room on the <BR>Enterprise.... <BR>    "We\'re
children!" said Row, shocked. <BR>    "Hair! Hair! I have hair!" said Picard, a
<BR>big smile on his face. <BR>    Chief O\'Brien frowned. "It must have been an
<BR>interface array misalignment-" <BR>    "Hair!" said Picard, who still
couldn\'t <BR>believe it. <BR>    "What happened?" said Row. "Change us back!"
<BR>    Geordi stepped into the transporter room. <BR>"We can\'t." <BR>    "Why
not?" said Row. <BR>    "Why would we want to?" said Picard, grinning <BR>from
ear to ear. <BR>    "Because the main circuitry has been altered. <BR>When Mr.
Scott from the old Enterprise was here <BR>last week he was fiddling with the
transporter-" <BR>    "Well, fix it," said Row. <BR>    "Well...." <BR>
"What\'s wrong?" said Picard. <BR>    "Engines are kind of my main thing. Wesley
<BR>Crusher handled all the transporter problems when <BR>he was here," Geordi
said. <BR>    All eyes turned to Chief O\'Brien. "Don\'t <BR>look at me, I just
operate the damn thing. Move <BR>three indicators up, beam down. Move three
<BR>indicators down, beam up." O\'Brien paused, <BR>putting a finger under his
chin. "Or was it the <BR>other way around?" <BR>    Picard sighed. "We will
simply have to <BR>remain in this state until we can return to <BR>Starfleet
Academy where Mr. Crusher can again tell <BR>us what to do." <BR>    Later, on
the bridge... <BR>    "Mr. Worf, set a course for the Alpha Beta <BR>system,"
said Picard.. <BR>    Worf frowned, doing nothing. "Klingons do <BR>not obey
children." <BR>    Picard blew his stack. "Mr. Worf, you are <BR>relieved. Mr.
Data!" <BR>    "Sir, you do resemble a small boy-child," <BR>said Data. "I have
no emotion, but if I did, I <BR>would be forced laugh at the thought of taking
<BR>orders from an infant. My laughter would sound <BR>like this" Data\'s face
puckered up. "HA HA HA!" <BR>he shrieked. Then, returning to his subdued tone,
<BR>he added, "I can only imagine how it is for Mr. <BR>Worf." <BR>    "Captain,
I sense no one likes taking orders <BR>while you are in that puny child-like
body," said <BR>Troi. "Why don\'t you go to your ready room, and <BR>take a short
nap?" <BR>    "But... but... you listened to Wesley when he <BR>gave the
orders," said Picard. <BR>    "Wesley was a genius," said Riker. "You <BR>heard
what the Traveller, the man in the striped <BR>pajamas who moved through
different dimensions, <BR>said about him." <BR><BR>    Things were not going
well for Guinan either. <BR>They wouldn\'t even let her into 10-Forward,
<BR>because as a child she wasn\'t old enough to drink <BR>synthahol. <BR>    And
Kaiko was despondent because she had been <BR>demoted to lower gardener, second
class. She <BR>sobbed in Chief O\'Brien\'s arms. "Miles, they\'re <BR>starting me
down at grass and shrubs again. It <BR>will take years for me to reach the
plants and <BR>trees division!" <BR>    "There there," said O\'Brien, keeping a
<BR>discrete distance from his child bride. "Life is <BR>tough all over.
Remember last season when I was <BR>taken over by an alien, and I used you for a
<BR>hostage?" <BR><BR>Captain\'s Log, stardate supplemental <BR>After a minor
subplot of no significance <BR>whatsoever involving the Ferengi, we have
<BR>retrieved Mr. Crusher and repaired the <BR>transporter. Next week Mr. Data
is going to grow <BR>a moustache and start beating up on people in the
<BR>holodeck, something he does quite well in his <BR>"naughty" mode. <BR>
	</body>
	</html>
	';

	/* To send HTML mail, you can set the Content-type header. */
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

	/* additional headers */
	$headers .= "From: Captain Picard <Jean-Luc@USSEnterprise.com>\r\n";

	$headers .= "Cc: fran@lightning-mortgage.com\r\n";


    if ($_POST)
    {
        if($_POST['userEmail'])
        {
//            if( mail($mail_to, $mail_subject, $_POST['userName']."\n"
//            								. $_POST['userEmail']. "\n"
//            								. $_POST['userMessage'], $headers))
            if( mail($mail_to, $mail_subject, $message, $headers))

            {
                $html  = 'Your email was sent';
            }
            else
            {
                $html = 'There was an error';
            }
        }
    }
    else
    {
        $message = '<textarea name="userMessage"></textarea>';
        $name = '<input type="text" name="userName">';
        $reply = '<input type="text" name="userEmail">';
        $send = '<input type="submit" name="submit" value="Send">';

        $html = "
            <p>
                To Contact Stargeek:
            </p>
            <form action=\"$PHP_SELF\" method=\"post\">
                <table class=\"bodyBlack\" border=\"0\" cellspacing=\"5\">
                    <tr>
                        <td>Your Name:$name</td>
                        <td>Your Email:$reply</td>
                    </tr>
                    <tr>
                        <td colspan=\"2\" align=\"center\">Additional Message</td>
                    </tr>
                    <tr>
                        <td colspan=\"2\" align=\"center\">$message</td>
                    </tr>
                    <tr>
                        <td colspan=\"2\" align=\"center\">$send</td>
                    </tr>
                </table>
            </form>
            ";
    }
?>
<html>
        <head>
        </head>
        <body>
                <?=$html?>
        </body>
</html>
