<?php
	require_once "php/Model.php";
	require_once "php/Controller.php";
	require_once "php/View.php";
?>
<!DOCTYPE html>
<html lang="EN">
	<head>
		<title>MVC</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../by_tag.css">
	</head>

	<body>
		<main>
			<h1>Hello, world!</h1>

			<section>
				<p>
					<?php
						$model = new Model();
						$controller = new Controller();
						$view = new View();

						if (isset($_GET['action'])) {
							$model = $controller->{$_GET['action']}($model);
						}

						echo $view->output($model);
					?>
				</p>
				<p><?php var_dump($model); ?></p>
				<p><?php var_dump($controller); ?></p>
				<p><?php var_dump($view); ?></p>
			</section>
		</main>
	</body>
</html>