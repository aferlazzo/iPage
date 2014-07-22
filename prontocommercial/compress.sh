#!/bin/bash

#		compress.sh 2/18/11 - Anthony Ferlazzo
#		Use Yahoo's YUIcompressor to minify javascript and css files for  prontocommercial.com website
#		To use this shell script enter the following from a terminal window: sh compress.sh

#		The directory structure of the site is all html files are at the root. php is used on the files to force
#		gzip compression because the isp doesn't enable compression to be done via the apache server directives
#		mod_deflate or mod_gzip. Like every other isp, they charge by bandwidth used and compressing data eats into
#		their revenue. At least that sounds like a valid rationale.

#		Notice that the source files, those css and javascript files we start with that are uncompressed, are
#		stored in the css-src and js-src files, respectively. The html code looks at the css and js directories
#		for these files. The yuicompressor normally writes compressed files in these directories but with a menu
#		system in this bash script we can directory it to merely copy the uncompressed files to the proper directory.

#		Instead we add the directive in the php.ini file in the root: auto_prepend_file = /home/prontoc2/public_html/gzip-enable.php
#		The file gzip-enable.php contains just the following:

#			<?php
#			// Do not delete! This script is used to compress .js and .css files when loaded by the user. See php.ini.
#			if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();
#			?>

#		The other requirement is that we rename html file to use the .php suffix. This is not a real problem since I also
#		use 3 common files on the website to make simplier maintenance of the common header and footer using php include commands.

#		One of the problems with compressing the minifying the css and js files is that debugging using firebug on the browser
#		is much harder.

#normal="normal compression"
#debug="allow firebug debug source"
#quit="exit to main menu"
loop="true"
while [ $loop = "true" ]
do
	clear
	tput cup 2 21; echo "Pronto Commercial Funding"
	tput cup 4 14; echo "javascript and css file Compression Script"
	tput cup 6 10; echo "n - Normal Compression"
	tput cup 7 10; echo "d - Debugging Mode (Do Not compress files)"
	tput cup 8 10; echo "q - Quit"
	tput cup 10 14; echo "choice:"
	tput cup 10 22; read opt


	if [ $opt = "n" ]
	then
		echo compressing ProntoCommercial.js
		java -jar ~/yuicompressor-2.4.2/build/yuicompressor-2.4.2.jar --type js /var/www/js-src/ProntoCommercial.js -o /var/www/js/ProntoCommercial.js
		echo compressing FundingRequest.js
		java -jar ~/yuicompressor-2.4.2/build/yuicompressor-2.4.2.jar --type js /var/www/js-src/FundingRequest.js -o /var/www/js/FundingRequest.js
		echo compressing CISform.js
		java -jar ~/yuicompressor-2.4.2/build/yuicompressor-2.4.2.jar --type js /var/www/js-src/CISform.js -o /var/www/js/CISform.js
		echo compressing Glossary.js
		java -jar ~/yuicompressor-2.4.2/build/yuicompressor-2.4.2.jar --type js /var/www/js-src/Glossary.js -o /var/www/js/Glossary.js

		#echo touching files
		#touch /var/www/js-src/ProntoCommercial.js /var/www/js/ProntoCommercial.js
		#touch /var/www/js-src/FundingRequest.js /var/www/js/FundingRequest.js
		#touch /var/www/js-src/CISform.js  /var/www/js/CISform.js
		#touch /var/www/js-src/Glossary.js /var/www/js/Glossary.js

		#echo list update time of files
		#ls -l /var/www/js-src/ProntoCommercial.js
		#ls -l /var/www/js/ProntoCommercial.js

		#ls -l /var/www/js-src/FundingRequest.js
		#ls -l /var/www/js/FundingRequest.js
		#ls -l /var/www/js-src/CISform.js
		#ls -l /var/www/js/CISform.js
		#ls -l /var/www/js-src/Glossary.js
		#ls -l /var/www/js/Glossary.js

		echo compressing ProntoCommercial.css
		java -jar ~/yuicompressor-2.4.2/build/yuicompressor-2.4.2.jar --type css /var/www/css-src/ProntoCommercial.css -o /var/www/css/ProntoCommercial.css
		echo compressing FFundingRequest.css
		java -jar ~/yuicompressor-2.4.2/build/yuicompressor-2.4.2.jar --type css /var/www/css-src/FundingRequest.css -o /var/www/css/FundingRequest.css
		echo compressing CISform.css
		java -jar ~/yuicompressor-2.4.2/build/yuicompressor-2.4.2.jar --type css /var/www/css-src/CISform.css -o /var/www/css/CISform.css
		echo compressing Glossary.css
		java -jar ~/yuicompressor-2.4.2/build/yuicompressor-2.4.2.jar --type css /var/www/css-src/Glossary.css -o /var/www/css/Glossary.css
	fi


	if [ $opt = "d" ]
	then
		echo copying javascript files

		cp /var/www/js-src/ProntoCommercial.js	/var/www/js/ProntoCommercial.js
		cp /var/www/js-src/FundingRequest.js	/var/www/js/FundingRequest.js
		cp /var/www/js-src/CISform.js			/var/www/js/CISform.js
		cp /var/www/js-src/Glossary.js			/var/www/js/Glossary.js

		echo copying css files

		cp /var/www/css-src/ProntoCommercial.css	/var/www/css/ProntoCommercial.css
		cp /var/www/css-src/FundingRequest.css		/var/www/css/FundingRequest.css
		cp /var/www/css-src/CISform.css				/var/www/css/CISform.css
		cp /var/www/css-src/Glossary.css			/var/www/css/Glossary.css
	fi

	if [ $opt = "q" ]
	then
		echo ending
		loop="false"
	fi
done
