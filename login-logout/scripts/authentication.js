async function authenticate() {
	document.getElementById("log_in").hidden = true;

	var login = document.getElementById("login").value;
	var password = document.getElementById("password").value;

	const url="php/authentication.php?login=" + login + "&password=" + password;

	try {
		const response = await fetch(url);

		if(!response.ok) {
			throw new Error(`Response text: ${response.status}`);
		}

		const text = await response.text();

		document.cookie = "Login_ID=" + text + "; expires=" + new Date(Date.now() + 60000 * 1440).toUTCString() + "; SameSite=Lax; path=" + window.location.pathname + "; secure";
		document.cookie = "Second_cookie_to_test_in_case_of_multiple_cookies=2c0m4y==t929c482uc2cu0t9" + "; expires=" + new Date(Date.now() + 60000 * 1).toUTCString() + "; SameSite=Lax; path=/logging; secure";	

		window.location.reload();
	} catch(error) {
		console.log(error.message);
	}
}










async function deauthenticate() {
	document.getElementById("log_out").hidden = true;

	try {
		const response = await fetch("php/deauthentication.php?login=First Subject :)&password=12345");

		if(!response.ok) {
			throw new Error(`Response text: ${response.status}`);
		}

		const json = await response.text();
		
		console.log(json);

		document.cookie = "Login_ID=; expires=Thu, 01 Jan 1970 00:00:00 GMT; Samesite=Lax; path=" + window.location.pathname +";";
		
		window.location.reload();
	} catch (error) {
		console.log(error.message);
	}
}