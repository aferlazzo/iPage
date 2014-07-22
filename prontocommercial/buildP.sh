#!/bin/sh
#
# The shell script is named buildP.sh
# The execute bit is set for file permissions on this file
# To run the shell script go to a terminal session and type 'sh buildP.sh'
#
# The script is used to create compressed .css and .js files for the website

# the .netrc file in the home directory contains the user ID, password, and
# macro for uploading the files to the host
# The maco called 'init' is executed automatically, after successful login

clear
echo creating 6 .min files

cd ~/public_html
echo "ProntoCommon.js"
java -jar ~/Webtools/yuicompressor-2.4.2/build/yuicompressor-2.4.2.jar -o js/ProntoCommon.min.js js/ProntoCommon.js
echo "FundingRequest.js"
java -jar ~/Webtools/yuicompressor-2.4.2/build/yuicompressor-2.4.2.jar -o js/FundingRequest.min.js js/FundingRequest.js
echo "Glossary.js"
java -jar ~/Webtools/yuicompressor-2.4.2/build/yuicompressor-2.4.2.jar -o js/Glossary.min.js js/Glossary.js
echo "ProntoStyles.css"
java -jar ~/Webtools/yuicompressor-2.4.2/build/yuicompressor-2.4.2.jar -o css/ProntoStyles.min.css css/ProntoStyles.css
echo "FundingRequest.css"
java -jar ~/Webtools/yuicompressor-2.4.2/build/yuicompressor-2.4.2.jar -o css/FundingRequest.min.css css/FundingRequest.css
echo "Glossary.css"
java -jar ~/Webtools/yuicompressor-2.4.2/build/yuicompressor-2.4.2.jar -o css/Glossary.min.css css/Glossary.css

#
echo
echo "uploading files."
# echo "At the 'ftp>' prompt enter the macro name '\$uploadpronto' and press the Enter key"
echo
echo "ftp host userID, password, and macro definition is in the .netrc file"
#
ftp www.prontocommercial.com 21

#$ uploadpronto
