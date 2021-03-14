<!importé de Lewi Hussey>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<title>CodePen - Calm breeze login screen</title>
		<link rel="stylesheet" href="./css/login.css">

	</head>

	<body>
		<!-- partial:index.partial.html -->
		<div class="wrapper">
			<div class="container">

				<form class="form" action="verification.php" method="POST">
					<h1>Connexion</h1>

					<label>Adresse e-mail</label>
					<input type="text" placeholder="Entrer votre adresse mail" name="email" required>

					<label>Mot de passe</label>
					<input type="password" placeholder="Entrer le mot de passe" name="password" required>

					<input type="submit" id='login-button' value='LOGIN'>
					<?php
					if (isset($_GET['erreur'])) {
						$err = $_GET['erreur'];
						if ($err == 1 || $err == 2)
							echo "<p style='color:red'>Email ou mot de passe incorrect</p>";
					}
					?><h4 id=goto-subscribe onclick="myFunction()">Créer un compte !</h4>
				</form>
			</div>

			<ul class="bg-bubbles">
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
			</ul>
		</div>
		<!-- partial -->
		<script>
			function myFunction() {
				window.location.href = "inscription.php";
			}
		</script>

	</body>

	</html>