function setOpacity(obj, opacity) {
if ((isFirefox == 0) && (isNS == 0))
  opacity = (opacity == 100)?99.999:opacity;
  // IE/Win
if ((isFirefox == 0) && (isNS == 0))
  obj.style.filter = "alpha(opacity:"+opacity+")";
  // Safari<1.2, Konqueror
if ((isFirefox == 0) && (isNS == 0))
  obj.style.KHTMLOpacity = opacity/100;
  // Older Mozilla and Firefox
  // Safari 1.2, newer Firefox and Mozilla, CSS3
  //alert("isFirefox "+isFirefox+" isNS "+isNS);
  
if ((isFirefox == 1) && (isNS == 1))
{
 //alert("Firefox");
 //obj.style.opacity = opacity/100;
}
else if (isNS == 1)
{
 //alert("NetScape");
  //obj.style.MozOpacity = opacity/100;
}
}


var animateDelay = 15;
var object = null;
var Path = null;
var cX = null; 
var nextX = 0, nextP=0;

function ShowElement(Element)
{document.getElementById(Element).style.visibility = 'visible';}
function BlankElement(Element)
{document.getElementById(Element).style.visibility = 'hidden';}

function Blank()
{
ShowElement('Lucio');
ShowElement('Maze');
ShowElement('MazePath');
BlankElement('Box2');
BlankElement('EndPosition');
BlankElement('Box3');
}
function Invert()
{
BlankElement('Approval');
//BlankElement('Maze');
BlankElement('MazePath');
Path = document.getElementById('Maze');
setOpacity(Path, 25);
ShowElement('Box2');
ShowElement('EndPosition');
ShowElement('Box3');
}

function initAnimateRight(objectID) {
object = document.getElementById(objectID);
Path = document.getElementById('MazePath');

cX =  object.offsetLeft;
nextX=0;nextP=40;
object.style.top = '300px';
setTimeout ('animateObjectRight()',500);
}

function animateObjectRight()  {
if (nextX <= 480)
{ 
var nX = cX + 2;
object.style.left = nX + 'px';

if(nextX%30 == 0)
 Path.style.clip='rect(260px, '+nextP+'px, 442px, 20px)';

if((nextX == 100) || (nextX == 200) || (nextX == 300) || (nextX == 400)){
switch(nextX)
{
case 100: BlankElement('Lucio');
ShowElement('Apply');
object = document.getElementById('Apply');
nX = 0;
break;
case 200: BlankElement('Apply');
ShowElement('Document');
object = document.getElementById('Document');
nX = 100;
break;
case 300: BlankElement('Document');
ShowElement('Appraisal');
object = document.getElementById('Appraisal');
nX = 200;
break;
case 400: BlankElement('Appraisal');
ShowElement('Approval');
object = document.getElementById('Approval');
object.style.top = '-26px';
//alert(object.offsetTop);
nX = 300;
break;
}}

cX = nX;
nextX=nextX + 2;
nextP=nextP + 2;
setTimeout ('animateObjectRight()',animateDelay);
}
else
{
Path.style.clip='rect(260px, 550px, 440px, 20px)';
setTimeout ("Invert()", 750);
}
return;
}