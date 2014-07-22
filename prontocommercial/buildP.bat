@echo off
echo creating .min files

p:


java -jar "c:\Documents and Settings\Tony\My Documents\Webtools\yuicompressor-2.4.2\build\yuicompressor-2.4.2.jar" -o js\ProntoCommon.min.js js\ProntoCommon.js
java -jar "c:\Documents and Settings\Tony\My Documents\Webtools\yuicompressor-2.4.2\build\yuicompressor-2.4.2.jar" -o js\FundingRequest.min.js js\FundingRequest.js
java -jar "c:\Documents and Settings\Tony\My Documents\Webtools\yuicompressor-2.4.2\build\yuicompressor-2.4.2.jar" -o js\jquery.corner.min.js js\jquery.corner.js
java -jar "c:\Documents and Settings\Tony\My Documents\Webtools\yuicompressor-2.4.2\build\yuicompressor-2.4.2.jar" -o js\Glossary.min.js js\Glossary.js

java -jar "c:\Documents and Settings\Tony\My Documents\Webtools\yuicompressor-2.4.2\build\yuicompressor-2.4.2.jar" -o css\ProntoStyles.min.css css\ProntoStyles.css
java -jar "c:\Documents and Settings\Tony\My Documents\Webtools\yuicompressor-2.4.2\build\yuicompressor-2.4.2.jar" -o css\FundingRequest.min.css css\FundingRequest.css
java -jar "c:\Documents and Settings\Tony\My Documents\Webtools\yuicompressor-2.4.2\build\yuicompressor-2.4.2.jar" -o css\Glossary.min.css css\Glossary.css
echo uploading files...
ftp -d -s:buildP_ftp_cmds.txt
if %errorlevel% == 1 (echo FTP Failed
) else (echo FTP Succeeded)
pause
