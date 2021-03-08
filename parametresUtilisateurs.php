<html>
    <head>
       <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="css/styles.css" media="screen" type="text/css">
        <script src="/Over-Cloud/js/parametres.js"></script>
    </head>

    <body>
          <!-- Selectionne la galerie avec l'id 1-->
  <?php
       require 'ConnectDb.php';
       session_start();
       $idGalerie = 1;
       $db = ConnectDb::getInstance(); 
       $sql = "SELECT nom,individuel FROM galerie where id_galerie = '$idGalerie'";
       $query = mysqli_query($db,$sql);
       $result = mysqli_fetch_assoc($query);
           $nomGalerie = $result['nom'];
           $individuelGalerie = $result['individuel'];
  ?>
        <div id = navigationBar>
            <ul>
                <h2><?php
                 echo $nomGalerie;
                ?></h2>
                <li><a href="albums.php">Albums</a></li>
                <li><a href="">Photos</a></li>
                <li><a href="parametresGalerie.php">Paramètres</a></li>
                <li><a href="">Participants</a></li>
                <li id = "paraUtilisateur"><a href="parametresUtilisateurs.php">
                  <?php
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
                <textarea id = nom><?php
                        $user = $_SESSION['nom'];
                        // afficher le nom
                        echo  $user;
                ?></textarea>
                <h9>Adresse couriel : </h9>
                <textarea id = adresse><?php
                        $email = $_SESSION['email'];
                        // afficher l'adresse courriel
                        echo  $email;
                ?></textarea>
                <h5>Modifier le mot de passe de votre compte</h5>
                <h9>Mot de passe actuel : </h9>
                <textarea id = mdp> </textarea>
                <h9>Nouveau mot de passe : </h9>
                <textarea id = newmdp></textarea>
         
            </div>
                <div id = buttonConfirmation>
                    <button type="button" onclick="modifierInformations()">Confirmer les changements!</button>
                </div>

        </div>



    </body>
</html>