#!/bin/sh
#
# The shell script is named spriteMiner.sh
# The execute bit is set for file permissions on this file
# To run the shell script go to a terminal session and type 'sh spriteMiner.sh'
#
# The script is used to create compressed .css and .js files for the website

# the .netrc file in the home directory contains the user ID, password, and
# macro for uploading the files to the host
# The maco called 'init' is executed automatically, after successful login

clear
echo creating 1 .min file

cd ~/public_html
echo "spriteMiner.js"
java -jar ~/Webtools/yuicompressor-2.4.2/build/yuicompressor-2.4.2.jar -o js/spriteMiner.min.js js/spriteMiner.js
#
echo
echo "uploading file"
# echo "At the 'ftp>' prompt enter the macro name '\$uploadpronto' and press the Enter key"
echo
echo "ftp host userID, password, and macro definition is in the .netrc file"
#
cd ..
echo copy files
mv .netrc .netrc-full
mv .netrc-spriteMiner .netrc
echo change .netrc permissions to 600
chmod 600 .netrc
cd ~/public_html
echo now ftp
ftp www.prontocommercial.com 21
echo done with ftp
cd ..
mv .netrc .netrc-spriteMiner
mv .netrc-full .netrc
chmod 600 .netrc