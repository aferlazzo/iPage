@echo off
echo creating .min files
L:
cd \

java -jar "c:\Documents and Settings\Tony\My Documents\My Webs\yuicompressor-2.4.2\build\yuicompressor-2.4.2.jar" -o js\Common.min.js js\Common.js

java -jar "c:\Documents and Settings\Tony\My Documents\My Webs\yuicompressor-2.4.2\build\yuicompressor-2.4.2.jar" -o css\Tabs.min.css css\Tabs.css
java -jar "c:\Documents and Settings\Tony\My Documents\My Webs\yuicompressor-2.4.2\build\yuicompressor-2.4.2.jar" -o css\AdministrativeStyles.min.css css\AdministrativeStyles.css
java -jar "c:\Documents and Settings\Tony\My Documents\My Webs\yuicompressor-2.4.2\build\yuicompressor-2.4.2.jar" -o css\AnswersStyles.min.css css\AnswersStyles.css
java -jar "c:\Documents and Settings\Tony\My Documents\My Webs\yuicompressor-2.4.2\build\yuicompressor-2.4.2.jar" -o css\CreditScoresStyles.min.css css\CreditScoresStyles.css
java -jar "c:\Documents and Settings\Tony\My Documents\My Webs\yuicompressor-2.4.2\build\yuicompressor-2.4.2.jar" -o css\IndexStyles.min.css css\IndexStyles.css
java -jar "c:\Documents and Settings\Tony\My Documents\My Webs\yuicompressor-2.4.2\build\yuicompressor-2.4.2.jar" -o css\InterestRatesStyles.min.css css\InterestRatesStyles.css
java -jar "c:\Documents and Settings\Tony\My Documents\My Webs\yuicompressor-2.4.2\build\yuicompressor-2.4.2.jar" -o css\LoanTypesStyles.min.css css\LoanTypesStyles.css
java -jar "c:\Documents and Settings\Tony\My Documents\My Webs\yuicompressor-2.4.2\build\yuicompressor-2.4.2.jar" -o css\MortgageApplicationStyles.min.css css\MortgageApplicationStyles.css
echo uploading files...
ftp -d -s:buildL_ftp_cmds.txt
pause