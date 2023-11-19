function signIn(){


    // Get the URL parameters with the Node Mcu Local ID
	const urlParams = new URLSearchParams(window.location.search);


	// Store the value of the 'localId' parameter from the URL
	const localId = urlParams.get('local');

	

	let oauth2Endpoint = "https://accounts.google.com/o/oauth2/v2/auth";
	let form = document.createElement('form');
	form.setAttribute('method','GET');
	form.setAttribute('action',oauth2Endpoint);

	let params = {

	"client_id":"802530843235-7tu3o3ad0v1pkorb7ddhmq19sf7uphe4.apps.googleusercontent.com",
	"redirect_uri":"https://elmejordominiodepruebasdelahistoriadelahumanidad.shop",
	"response_type":"token",
	"scope":"https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/youtube.readonly https://www.googleapis.com/auth/calendar",
	"include_granted_scopes":"true",
	'state':localId,
//	"access_type":"offline"
	};
	for (var p in params){

	let input = document.createElement('input');
	input.setAttribute('type','hidden');
	input.setAttribute('name',p);
	input.setAttribute('value', params[p]);
	form.appendChild(input);
	}

	document.body.appendChild(form);


	form.submit();

}
