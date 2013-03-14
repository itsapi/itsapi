var httpRequest;
			  
function formAction(url, ids, element) {
	var queryStr = url + '?';
	for (var i = 0; i < ids.length; i++) {
		queryStr = queryStr + ids[i] + '=' + document.getElementById(ids[i]).value + '&';
	}
	makeRequest(queryStr, element);
};
 
function makeRequest(url, element) {
	if (window.XMLHttpRequest) { // Mozilla, Safari, ...
		httpRequest = new XMLHttpRequest();
	} else if (window.ActiveXObject) { // IE
		try {
			httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} 
		catch (e) {
			try {
				httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} 
			catch (e) {}
		}
	}
 
	if (!httpRequest) {
		alert('Giving up :( Cannot create an XMLHTTP instance');
		return false;
	}
	httpRequest.onreadystatechange = alertContents;
	httpRequest.open('GET', url);
	httpRequest.send();
}
 
function alertContents() {
	if (httpRequest.readyState === 4) {
		if (httpRequest.status === 200) {
			document.getElementById('messagesList').innerHTML = document.getElementById('messagesList').htmlContent = httpRequest.responseText;
		}
	}
}
