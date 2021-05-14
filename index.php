<html>

<head>
    <meta charset="utf-8">
    <!-- importer le fichier de style -->
    <link rel="stylesheet" href="./css/styles.css" media="screen" type="text/css" />
</head>

<body style="background-color: white;">

<div class="accueil">

<div style="float: left;">

<img src="./image/photo-page-accueil.jpg" style="margin-left: 150px; margin-top:100px;">
</div>

        <div class="formulaire">
            <!-- zone de connexion -->
            <img src="./image/logo-overcloud.png">
            <form action="./php/verification.php" method="POST">
                <h1>Connexion</h1>
                <input type="text" placeholder="Courriel" name="email" required>
                <input type="password" placeholder="Mot de passe" name="password" required>
                <input type="submit" id='submit' value='Connexion'>
                <?php
                if (isset($_GET['erreur'])) {
                    $err = $_GET['erreur'];
                    if ($err == 1 || $err == 2)
                        echo "<p style='color:red'>Email ou mot de passe incorrect</p>";
                }
                ?>
                <p class="nouveau-compte"><a href="#" id=creerCompte onclick="myFunction()">Pas de compte? Inscrivez-vous!</p>
            </form>
        </div>


    <script>
        function myFunction() {
            window.location.href = "./pages/inscription.php";
        }
    </script>

</div>

</body>

</html>