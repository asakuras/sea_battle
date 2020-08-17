/**
 * @author Marc Gaetano
 */

// To use this function to make an AJAX request, just call it
// with the following parameters:
//
// * url: the PHP script you want to call on the server
// * method: 'get' or 'post'
// * parameters: the parameters of the PHP script in the form of a
//   JavaScript object (like "{name: 'Marc', nationality: 'French'}")
// * onSuccess: the function to call after the request succeeded
// * onFailure: the function to call after the request failed
// 
// Notice that the two callbacks 'onSuccess' and 'onFailure' can
// be omitted
//
function ajaxRequest(url,method,parameters,onSuccess,onFailure) {
	
	function getMethod(method) {
		if ( typeof method != "string" )
			throw method + ": bad method (choose 'GET' or 'POST')";
		method = method.trim().toLowerCase();
		if ( method != 'get' && method != 'post' )
			throw method + ": bad method (choose 'GET' or 'POST')";
		return method;
	}

	function getParameters(method,parameters) {
		if ( typeof parameters != "object" )
			throw method + ": bad parameters (must be an object)";
		if ( method === "get") {
			let params = [];
			for ( param in parameters )
				params.push(param + "=" + encodeURIComponent(parameters[param]));
			return params.join("&");
		}
		else {
			let params = new FormData();
			for ( param in parameters ) {
				params.append(param,parameters[param]);
			}
			return params;
		}
	}
	
	method = getMethod(method);

	let xmlhttp = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");

	if ( onSuccess && onFailure ) {
		xmlhttp.onload = onSuccess;
		xmlhttp.onerror = onFailure;
	}

	if ( method === 'get' ) {
		if ( parameters == "" )
			xmlhttp.open("GET",url,true);
		else
			xmlhttp.open("GET",url + "?" + getParameters("get",parameters),true);
		xmlhttp.send();
	}
	else {
		xmlhttp.open("POST",url,true);
		xmlhttp.send(getParameters("post",parameters));
	}
}
