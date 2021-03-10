<html>
    <head>
       <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="css/styles.css" media="screen" type="text/css">
        <script src="/Over-Cloud/js/parametres.js"></script>
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    </head>


    <body>
        <!-- bare de navigation-->
        <?php
         session_start();
        ?>
        <div id = navigationBar></div>
        <script>
        $(function(){
        $("#navigationBar").load("navigationbar.php");
        });
        </script>

        <!-- Parametres utilisateur-->
        <div id = photoProfil>
            <img src="image/profilExemple.PNG" alt="Photo de profil">
        </div>
        
        <div id = carteParametresUtilisateur>

            <div id = carteText>
                <h5>Modifier les informations de votre compte</h5>

                <form action="modificationUtilisateur.php" method="POST">
                <h9>Nom complet : </h9>
                <input type="text" class = "champSaisie" placeholder="<?php echo $_SESSION['nom'] ?>" name="nom">
                <h9>Adresse couriel : </h9>
                <input type="text" class = "champSaisie" placeholder="<?php echo $_SESSION['email']; ?>" name="email">    

                <h5>Modifier le mot de passe de votre compte</h5>
                <h9>Mot de passe actuel : </h9>
                <input type="password" class = "champSaisie" placeholder="Mot de passe actuel" name="mdp"> 
                <h9>Nouveau mot de passe : </h9>
                <input type="password" class = "champSaisie" placeholder="Nouveau mot de passe" name="new-mdp"> 

                <input type="submit" class = "buttonConfirmer" name="submit" value="Confirmer!">  
                </form>

         
            </div>

        </div>

    </body>
</html>