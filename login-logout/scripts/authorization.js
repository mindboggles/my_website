async function authorize() {
	const url = "php/authorization.php";

	try {
		const response = await fetch(url);

		if(!response.ok) {
			throw new Error(`Response text: ${response.status}`);
		}

		const text = await response.text();

		if(text == "") {
			console.log(text);

			document.cookie = "Login_ID=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/logging";

			document.getElementById("log_in").hidden = false;
		} else {
			var json = JSON.parse(text);

			document.getElementById("log_in").hidden = true;
			document.getElementById("greeting").innerHTML = "Hi, " + json["Name"];
			document.getElementById("log_out").hidden = false;
		}
	} catch (error) {
		console.log(error.message);
	}
}

authorize();