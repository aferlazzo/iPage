function NoEnterKey(field, event, nextfield)
{
	var key, keychar;
	if (window.event)
		key = window.event.keyCode
	else
		if (event)
			key = event.which;
		else
			return(true);

	keychar = String.fromCharCode(key);

	// check for Enter key

	if (key == 13)
	{
		eval('document.main.' + nextfield + '.focus()'); // simulate into tab
		return(false);
	}

	return(true);
}

var animateDelay = 1;
var object = null;
var Path = null;
var cX = null; 
var cY = null; 
var fX = null; 
var fY = null; 
var nextX = 700;
	
function initAnimateLeft(objectID) {
	object = document.getElementById(objectID);
	
	cX = fX =  object.offsetLeft;
	cY = fY =  object.offsetTop;
	object.style.top = '290px';
	setTimeout ('animateObjectLeft()',animateDelay);	
}

function animateObjectLeft()  {
	if (nextX > -130)
	{ 
		var nX = cX - 2;
		var nY = cY;
		object.style.left = nX + 'px';
		cX = nX;
		cY = nY;
		nextX=nextX - 2;
		setTimeout ('animateObjectLeft()',animateDelay);
	}
	return;
}
