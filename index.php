<html>

<head>
    <meta charset="utf-8">
    <!-- importer le fichier de style -->
    <link rel="stylesheet" href="./css/login.css" media="screen" type="text/css" />
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <!-- zone de connexion -->

            <form action="./php/verification.php" method="POST">
                <h1>Connexion</h1>
                <input type="text" placeholder="Courriel" name="email" required>
                <input type="password" placeholder="Mot de passe" name="password" required>
                <input type="submit" id='submit' value='LOGIN'>
                <?php
                if (isset($_GET['erreur'])) {
                    $err = $_GET['erreur'];
                    if ($err == 1 || $err == 2)
                        echo "<p style='color:red'>Email ou mot de passe incorrect</p>";
                }
                ?>
                <input type="button" id=creerCompte onclick="myFunction()" value="Créer un compte !">
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

    <script>
        function myFunction() {
            window.location.href = "./pages/inscription.php";
        }
    </script>

</body>

</html>