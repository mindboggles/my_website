<!DOCTYPE html>
<html lang="EN">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Logging page</title>
		<link rel="stylesheet" href="../by_tag.css">
	</head>
	<body >
		<header>
			<h1>Login page</h1>
		</header>

		<main>
			<form id="login_form" onsubmit="event.preventDefault();" hidden>
				<fieldset>
					<legend>Authentication</legend>

					<p>
						<label for="login">Login</label>
					</p>

					<p>
						<input type="text" id="login" name="login">
					</p>

					<p>
						<label for="password">Password</label>
					</p>

					<p>
						<input type="password" id="password" name="password" autocomplete="off">
					</p>

					<p>
						<button onmouseup="authenticate();">Log in</button>
					</p>
				</fieldset>
			</form>

			<section id="logout_section" hidden>
				<h2 id="greeting"></h2>

				<p>
					<button  onclick="deauthenticate();">Log out</button>
				</p>
			</section>
		</main>

		<footer>
			<p>Login: bilbobaggins</p>
			<p>Password: myring!123</p>
		</footer>
	</body>

	<script src="scripts/authorization.js" defer></script>
	<script src="scripts/authentication.js" defer></script>
</html>