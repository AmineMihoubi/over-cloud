<html>
    <head>
       <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="/Over-Cloud/css/connexion.css" media="screen" type="text/css" />
    </head>
    <body>
        <div id="container">
            <!-- zone de connexion -->
            
            <form action="verification.php" method="POST">
                <h1>Connexion</h1>
                
                <label><b>Adresse e-mail</b></label>
                <input type="text" placeholder="Entrer votre adresse mail" name="email" required>

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="password" required>

                <input type="submit" id='submit' value='LOGIN' >
                <?php
                if(isset($_GET['erreur'])){
                    $err = $_GET['erreur'];
                    if($err==1 || $err==2)
                        echo "<p style='color:red'>Email ou mot de passe incorrect</p>";
                }
                ?><h4 id=creerCompte onclick="myFunction()">Créer un compte !</h4>
            </form>
        </div>

        <script>
function myFunction() {
    window.location.href = "inscription.php";
}
</script>

    </body>
</html>