function QuakeMe()
{
if(parent.moveBy)
{
for(i=16;i>0;i--)
{
parent.moveBy(0,i);
parent.moveBy(i,0);
parent.moveBy(0,-i);
parent.moveBy(-i,0);
}
}
}
function AddFavorite()
{
window.external.AddFavorite('http:\/\/www.lightning-mortgage.com','Lightning Mortgage - Good or bad credit, no problem')
}
var debugging=false;
function UpdateCookie(Setting)
{
XX='SavedFilter='+Setting;
d.cookie=XX;
return(true);
}

function ExitPage()
{
var Page="http:\/\/www.lightning-mortgage.com/Administrative/ExitSurvey.php";
var HereBefore=GetMyValue("WebVisitorAlreadyRegistered");
/*
if((Exit==true)&&(HereBefore!=1))
{
if(confirm("Would you like to participate in a brief\n3-question Lightning Mortgage survey?\nIf so, a survey will pop-up."))
{
d.cookie="WebVisitorAlreadyRegistered=1; expires=Fri, 31 Dec 2006 23:59:59 GMT; ";
var NewWin=window.open(Page,"NewWin","width=725,height=590,scrollbars=yes,menubar=no");
NewWin.window.focus();
}
}
*/
}
function fontSizer(inc,unit)
{
if(!d.getElementById)
return;
SizeIndex+=inc;
if(SizeIndex<0)
{
SizeIndex=0;
}
if(SizeIndex>3)
{
SizeIndex=3;
}
GetDIV=d.getElementById('ContentDIV');
for(i=0;i<tags.length;i++)
{
getAllTags=GetDIV.getElementsByTagName(tags[i]);
for(k=0;k<getAllTags.length;k++)
{
getAllTags[k].style.fontSize=(unit=='px')?pixelArray[SizeIndex]+unit:emArray[SizeIndex]+unit;
}
}
}
function WhiteBackground()
{
if(d.styleSheets)
{
if(d.styleSheets[0])
var styleSheet=d.styleSheets[0];
}
else
var styleSheet=d.style;
var GetButton=new Array;
if(!d.styleSheets)
{
if(WhiteDIV==false)
{
WhiteDIV=true;
d.body.bgcolor="#ffffff";
}
}
else
{
if(styleSheet.rules)
styleSheet.cssRules=styleSheet.rules;
if(styleSheet.cssRules[0].selectorText.toLowerCase()!="body")
styleSheet=d.styleSheets[1];
for(var x=0;x<styleSheet.cssRules.length;x++)
{
if(styleSheet.cssRules[x].selectorText.toLowerCase()=="div.content")
{
styleSheet.cssRules[x].style.backgroundRepeat="no-repeat";
if(WhiteDIV==true)
{
WhiteDIV=false;
styleSheet.cssRules[x].style.backgroundColor="transparent";
GetButton=d.getElementById('WhiteButton');
GetButton.value="White Background";
}
else
{
WhiteDIV=true;
styleSheet.cssRules[x].style.backgroundColor="#ffffff";
GetButton=d.getElementById('WhiteButton');
GetButton.value="Colorful Background";
}
}
}
}
}
function ShowURLPath()
{
var path = "";
var href = d.location.href;
var SubString = href.split("/");
for (var i = 3; i < (SubString.length-1); i++)
{	
path+="<A class='Top' HREF='"+href.substring(0,href.indexOf(SubString[i])+SubString[i].length)+"/'>";
if(SubString[i]=="~lightnin")
	path+="Secure Server Page";
else
	path+=SubString[i];
path+="</A> <span style='font-weight: bold;'>\xbb</span> ";
}
i=SubString.length-1; /* number of SubStrings */
if(SubString[i]=="Answers")
path+="<A class='Top' HREF=\""+href.substring(0,href.indexOf(SubString[i])+SubString[i].length)+"\"\>Loan Process<\/A\>";
else
path+="<A class='Top' HREF=\""+href.substring(0,href.indexOf(SubString[i])+SubString[i].length)+"\"\>"+SubString[i]+"<\/A\>";
if(path.length==27)
d.write("You are here:   index.php");
else
d.write("You are here:   "+path);
}
var loadtime="0";
var loading=true;
var s="s";
{refresh()}
function refresh() {
setTimeout("tcount()",250);
}
function tcount() {
if (loading)
loadtime=loadtime+++0.25;refresh()
}
function LoadDone() {
if (loadtime==1)
s="";
window.status="Page load time: "+loadtime+" second"+s;
}

