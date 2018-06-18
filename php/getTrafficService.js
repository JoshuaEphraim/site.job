var request = new ActiveXObject("Msxml2.XMLHTTP.3.0");
var url = "http://site.job/php/getTrafficService.php";
request.open("GET", url);
request.send(null);
WScript.Sleep(500);