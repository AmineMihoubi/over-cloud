<html>
    <head>
       <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="css/styles.css" media="screen" type="text/css">
    </head>

    <body>
        <div id = navigationBar>
            <ul>
                <h2> Nom de la galerie</h2>
                <li><a href="albums.php">Albums</a></li>
                <li><a href="">Photos</a></li>
                <li><a href="parametresGalerie.php">Paramètres</a></li>
                <li><a href="">Participants</a></li>
                <li id = "paraUtilisateur"><a href="parametresUtilisateurs.php">
                  <?php
                  session_start();
                  $user = $_SESSION['nom'];
                   echo  $user;
                  ?></a></li>
              </ul>
        </div>

        <div id = photoProfil>
            <img src="image/profilExemple.PNG" alt="Photo de profil">
        </div>
        
        <div id = carteParametresUtilisateur>

            <div id = carteText>
                <h5>Modifier les informations de votre compte</h5>
                <h9>Nom complet : </h9>
                <textarea><?php
                        $user = $_SESSION['nom'];
                        // afficher le nom
                        echo  $user;
                ?></textarea>
                <h9>Adresse couriel : </h9>
                <textarea><?php
                        $email = $_SESSION['email'];
                        // afficher l'adresse courriel
                        echo  $email;
                ?></textarea>
                <h5>Modifier le mot de passe de votre compte</h5>
                <h9>Mot de passe actuel : </h9>
                <textarea> </textarea>
                <h9>Nouveau mot de passe : </h9>
                <textarea></textarea>
         
            </div>
                <div id = buttonConfirmation>
                    <button type="button" onclick="alert('Les changements ont été enregistrés')">Confirmer les changements!</button>
                </div>

        </div>



    </body>
</html>