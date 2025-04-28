<!DOCTYPE html>
<html lang="EN">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Login-logout</title>
		<link rel="stylesheet" href="../by_tag.css">
	</head>
	<body>
		<main>
			<!-- <form id="login_form" onsubmit="event.preventDefault();" hidden> -->
				<fieldset id="log_in" hidden>
					<legend>Authentication</legend>

					<p>
						<label for="login">Login</label>
					</p>

					<p>
						<input type="text" id="login" name="login" value="bilbobaggins">
					</p>

					<p>
						<label for="password">Password</label>
					</p>

					<p>
						<input type="password" id="password" name="password" autocomplete="off" value="myring!123">
					</p>

					<p>
						<button onmouseup="authenticate();">Log in</button>
					</p>
				</fieldset>
			<!-- </form> -->
			<fieldset id="log_out" hidden>
				<h1 id="greeting"></h1>

				<p>
					<button onmouseup="deauthenticate();">Log out</button>
				</p>
			</fieldset>
		</main>
	</body>

	<script src="scripts/authorization.js" defer></script>
	<script src="scripts/authentication.js" defer></script>
</html>