<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Inscription</title>
	<link rel="stylesheet" href="../css/styles.css">

</head>

<body style="background-color: white;">

	<div class="accueil">

		<div class="image-accueil">
			<img src="../image/photo-page-accueil.jpg">
		</div>


		<div class="formulaire">
			<img src="../image/logo-overcloud.png">
			<h1>Bienvenue</h1>

			<?php
			session_start();
			$done = 'false';
			if (isset($_POST['sub-btn'])) {
				$db_username = 'root';
				$db_password = '';
				$db_name     = 'overcloud';
				$db_host     = 'localhost';

				//Connecting to the database
				$db = mysqli_connect($db_host, $db_username, $db_password, $db_name);

				if (!$db) {
					die("could not connect to database: " . mysqli_connect_error());
				}

				$email = mysqli_real_escape_string($db, htmlspecialchars($_POST['mail']));
				$prenom = mysqli_real_escape_string($db, htmlspecialchars($_POST['prenom']));
				$nom = mysqli_real_escape_string($db, htmlspecialchars($_POST['nom']));
				$password = mysqli_real_escape_string($db, htmlspecialchars($_POST['pwd']));
				$password2 = mysqli_real_escape_string($db, htmlspecialchars($_POST['pwd2']));
				if ($password == $password2) {
					$sql = "insert into utilisateur (prenom, nom, mdp, courriel) VALUES ('$prenom', '$nom', '$password', '$email')";
					$res = mysqli_query($db, $sql);
					if ($res) {
						$done = 'true';

						$requete = "SELECT id_utilisateur, nom, prenom FROM utilisateur WHERE courriel = '" . $email . "'";
						$exec_requete = mysqli_query($db, $requete);
						$reponse      = mysqli_fetch_assoc($exec_requete);
						$_SESSION['idUtilisateur'] = $reponse['id_utilisateur'];
						$_SESSION['nomUtilisateur'] = $reponse['nom'];
						$_SESSION['prenomUtilisateur'] = $reponse['prenom'];
						echo "<script> location.href='../index.php'; </script>";
						exit;
					} else {
						echo "Ce courriel est déjà utilisé!";
					}
				}
			}

			?>

			<input type="hidden" id="done" value="<?php echo $done ?>" onchange="redirectToLogin()" />

			<form method="post">
				<input type="text" name="mail" placeholder="E-mail">
				<input type="text" name="prenom" placeholder="Prénom">
				<input type="text" name="nom" placeholder="Nom">
				<input type="password" name="pwd" placeholder="Mot de passe">
				<input type="password" name="pwd2" placeholder="Confirmation">
				<input type="submit" id="sub-button" name="sub-btn" value="Inscription" />
				<br></br>
				<a href="../index.php" style="color:#E1BEE7;">Vous possedez déjà un compte? </a>
			</form>
		</div>

	</div>
	<!-- partial -->
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script src="../js/subscribe.js"></script>

</body>

</html>