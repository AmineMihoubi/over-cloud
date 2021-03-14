<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Inscription</title>
  <link rel="stylesheet" href="./css/login.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="wrapper">
	<div class="container">
		<h1>Bienvenue</h1>

		<?php
			$done = 'false';
			if(isset($_POST['sub-btn'])) {
				$db_username = 'root';
				$db_password = '';
				$db_name     = 'overcloud';
				$db_host     = 'localhost';

				//Connecting to the database
				$conn = mysqli_connect($db_host, $db_username, $db_password,$db_name);

				if(!$conn){
					die("could not connect to database: " . mysqli_connect_error());
				}

				$email = mysqli_real_escape_string($conn,htmlspecialchars($_POST['mail']));
				$prenom = mysqli_real_escape_string($conn,htmlspecialchars($_POST['prenom']));
				$nom = mysqli_real_escape_string($conn,htmlspecialchars($_POST['nom']));
    			$password = mysqli_real_escape_string($conn,htmlspecialchars($_POST['pwd']));
				$password2 = mysqli_real_escape_string($conn,htmlspecialchars($_POST['pwd2']));
				if($password == $password2){
					$sql="insert into utilisateur (prenom, nom, mdp, courriel) VALUES ('$prenom', '$nom', '$password', '$email')";
					$res=mysqli_query($conn,$sql);
					if($res){
						echo "test";
						$done = 'true';
						echo "<script> location.href='./index.php'; </script>";
						exit;
					}else{
						echo "le courriel entré est déjà utilisé";
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
			<input type="submit" id="sub-button" name="sub-btn" value="Inscription"/>
			<a href="./index.php" style="color:#FFFFFF;">Déjà inscrit?</a>
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
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script  src="./js/subscribe.js"></script>

</body>
</html>
