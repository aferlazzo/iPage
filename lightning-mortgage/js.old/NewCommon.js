var d=document;
function Unblock()
{
window.SecondWindow=open("http://www.lightning-mortgage.com/Answers/UnblockingMessages.php", "RemoteControl", 
"height=710,width=700,scrollbars=yes,left=1,top=1,screenx=1,screeny=1");
}
function AdjustHeight(Parent,LL,RR)  
{  
// get actual height of each column, take the bigger one.
var ll = d.getElementById(LL).offsetHeight;
var rr = d.getElementById(RR).offsetHeight;
var hh = Math.max(ll, rr);
if (hh == 0)
textHeight = "100%";
else
textHeight = hh + "px";
d.getElementById(LL).style.height = textHeight;
d.getElementById(RR).style.height = textHeight;
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
function ppp()
{
d.cookie='UName=null; expires=Thu, 01-Jan-1970 00:00:01 GMT; path=/;';
//window.location.href='../Administrative/BusinessPractices.php';
window.location.reload( true );
}
var tags=new Array('div','td','tr','p','b','table','strong','emphasis','a','pre','sub','sup','i','th','cp','ul','ol','li','dt','dd');
var pixelArray=new Array('10','12','14','18','20','24','30');
var emArray=new Array('0.7','0.9','1.0','1.5','2.0','2.5','3');
var getAllTags=new Array;
var GetDIV=new Array;
var SizeIndex=1;
var WhiteDIV=false;

function isBlank(){
value=d.Atomz.elements['sp-q'].value;
if((value.indexOf("Your search word(s)")==-1)&&(value!=""))
return true;
else
return false;
}
var userString=new Array();
userString[0]="It was great how you kept me informed as to the status of my refinancing, and the transaction was completed in a timely and flawless manner.<br />-Laury L.";
userString[1]="We received personal and speedy responses and now have a nice low interest rate.<br />-Catherine and Harlan T.";
userString[2]="I appreciate your efforts and candor; please feel free to have any future clients contact me regarding your integrity.<br />-Matthew M.";
userString[3]="I just wanted to thank you for all your hard work.  I'm so glad to pay off most of my bills...what a relief ! When I need another mortgage, I will contact you.<br />-Evelyn K.";
userString[4]="Thank you for everything on this loan - it has all been pretty smooth and we are happy with our financing and closing!!! You guys do a great job!!</br />-Tricia and Carl S.";
userString[5]="I must commend you for your professionalism and diligence.  Kudos to you and keep up the great work. You solved all my problems!<br />- Joe B.";
userString[6]="First of all the information I got from the website was the most up front detailed info that I have seen. It answered all my questions.  Thanks for being there.<br />-Stephanie D.";
var currentString=0;
var activeColor=254;
var isIE=d.all;
var delay;
isIE>-1?delay=8:delay=150;
var hexValues=new Array('00','01','02','03','04','05','06','07','08','09','0A','0B','0C','0D','0E','0F','10','11','12','13','14','15','16','17','18','19','1A','1B','1C','1D','1E','1F','20','21','22','23','24','25','26','27','28','29','2A','2B','2C','2D','2E','2F','30','31','32','33','34','35','36','37','38','39','3A','3B','3C','3D','3E','3F','40','41','42','43','44','45','46','47','48','49','4A','4B','4C','4D','4E','4F','50','51','52','53','54','55','56','57','58','59','5A','5B','5C','5D','5E','5F','60','61','62','63','64','65','66','67','68','69','6A','6B','6C','6D','6E','6F','70','71','72','73','74','75','76','77','78','79','7A','7B','7C','7D','7E','7F','80','81','82','83','84','85','86','87','88','89','8A','8B','8C','8D','8E','8F','90','91','92','93','94','95','96','97','98','99','9A','9B','9C','9D','9E','9F','A0','A1','A2','A3','A4','A5','A6','A7','A8','A9','AA','AB','AC','AD','AE','AF','B0','B1','B2','B3','B4','B5','B6','B7','B8','B9','BA','BB','BC','BD','BE','BF','C0','C1','C2','C3','C4','C5','C6','C7','C8','C9','CA','CB','CC','CD','CE','CF','D0','D1','D2','D3','D4','D5','D6','D7','D8','D9','DA','DB','DC','DD','DE','DF','E0','E1','E2','E3','E4','E5','E6','E7','E8','E9','EA','EB','EC','ED','EE','EF','F0','F1','F2','F3','F4','F5','F6','F7','F8','F9','FA','FB','FC','FD','FE','FF');
function fadeText(direction)
{
d.getElementById("Testimonial").innerHTML=userString[currentString];
d.getElementById("Testimonial").style.color=hexValues[activeColor]+hexValues[activeColor]+hexValues[activeColor];
if(direction)
{
activeColor-=10;
if(activeColor<=0)
{
activeColor=0;
clearInterval(fadeInterval);
fadeInterval=setInterval("fadeText("+0+")",delay);
}
}
else
{
activeColor+=10;
if(activeColor>=255)
{
activeColor=254;
clearInterval(fadeInterval);
currentString++;
if(currentString==userString.length)currentString=0;
fadeInterval=setInterval("fadeText("+1+")",delay);
}
}
}
function doClock()
{
var t=new Date();
var a=doClock.arguments;
var str="";
var i,a1,lang="1";
var month=new Array('January','Jan','February','Feb','March','Mar','April','Apr','May','May','June','Jun','July','Jul','August','Aug','September','Sep','October','Oct','November','Nov','December','Dec');
var tday=new Array('Sunday','Sun','Monday','Mon','Tuesday','Tue','Wednesday','Wed','Thursday','Thr','Friday','Fri','Saturday','Sat');
for(i=0;i<a.length;i++)
{
a1=a[i].charAt(1);
switch(a[i].charAt(0))
{
case "M":
if((Number(a1)==3)&&((t.getMonth()+1)<10))
str+="0";
str+=(Number(a1)>1)?t.getMonth()+1:month[t.getMonth()*2+Number(a1)];
break;
case "D":
if((Number(a1)==1)&&(t.getDate()<10))
str+="0";
str+=t.getDate();
break;
case "Y":
str+=(a1=='0')?t.getFullYear():t.getFullYear().toString().substring(2);
break;
case "W":
str+=tday[t.getDay()*2+Number(a1)];
break;
default:str+=unescape(a[i]);
}
}
return str;
}
var Cookies = new Object;
function GetMyValue (CookieName)
{
var Name, Value;
var Beginning, Middle, End;
Beginning = 0;

while (Beginning < d.cookie.length)
{
	// find the next equals sign
	Middle = d.cookie.indexOf('=', Beginning);

	// find the next semicolon
	End = d.cookie.indexOf(';', Beginning);

	if (End == -1)	// if no semicolon exists, it's the last cookie...
		End = d.cookie.length;

	// if nothing is in the cookie, blank out its value
	if ((Middle > End) || (Middle == -1))
	{
		Name = d.cookie.substring(Beginning, End);
		Value = "";
	}
	else
	{
		//extract the Name and value
		Name = d.cookie.substring(Beginning, Middle);
		Value = d.cookie.substring(Middle + 1, End);
	}
	if(Name == CookieName)
	{
		return(Value);
	}
	// jump over the next space to the Beginning of next cookie
	Beginning = End + 2;
}
	return("");
}
function ViewHUD1(DeleteIt)
{
ShowHUD1Lines=GetMyValue("HUD1Registered");
var MyDate = new Date();
var Day = MyDate.getDate();
Day = Day + 1;
MyDate.setDate(Day);
DDate=MyDate.toString();
if (DeleteIt=="delete")
{
d.cookie="HUD1Registered=deleted; expires=Thu, 01-Jan-1970 00:00:01 GMT"+DDate;
d.cookie="HUD1Registered=0; expires=Thu, 01-Jan-1970 00:00:01 GMT"+DDate;
ShowHUD1Lines="0";
}
else
{
d.cookie="HUD1Registered=1; expires="+DDate;
ShowHUD1Lines="1";
}
return(ShowHUD1Lines);
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
