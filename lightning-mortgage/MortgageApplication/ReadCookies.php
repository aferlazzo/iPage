<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ReadCookies</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<script type="text/javascript">
var AppInfo = GetMyValue("AppInfo");
var URLlist = GetMyValue("URLlist");
var Decoded = unescape(URLlist);

var Variables = Decoded.split("\&");
alert("Decoded List: "+Decoded+"\nVariables found: "+Variables.length);
var test = GetMyValue("test");
alert("test: "+test);

function GetMyValue (CookieName)
{
var Name, Value;
var Beginning, Middle, End;
Beginning = 0;

while (Beginning < document.cookie.length)
{
	// find the next equals sign
	Middle = document.cookie.indexOf('=', Beginning);

	// find the next semicolon
	End = document.cookie.indexOf(';', Beginning);

	if (End == -1)	// if no semicolon exists, it's the last cookie...
		End = document.cookie.length;

	// if nothing is in the cookie, blank out its value
	if ((Middle > End) || (Middle == -1))
	{
		Name = document.cookie.substring(Beginning, End);
		Value = "";
	}
	else
	{
		//extract the Name and value
		Name = document.cookie.substring(Beginning, Middle);
		Value = document.cookie.substring(Middle + 1, End);
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

</script>
<style type="text/css">
div#Overall, div#Co-Overall {float:left;background:#EBF5F5;border:2px solid #099;height:320px;width:436px;text-align:center;}
div#Overall {border-right:none;}
div#labels, div#data, div#co-labels, div#co-data {height:180px;width:120px;float:right;padding:5px;color:#009;font-size:100%;margin:0;}
div#data, div#co-data {padding:5px;width:280px;}
div#labels p, div#co-labels p {height:30px;margin:0;text-align:right;}
div#data input,div#data select, div#co-data input,div#co-data select {font-size:90%;line-height:100%;}
div#data p, div#co-data p {height:30px;margin:0;width:280px;}
#Form {margin:0;padding:0;}
h1, h2, h3, p {background:transparent;color:#066;font-weight:bold;}
</style>
</head>

<body>
</body>
</html>
