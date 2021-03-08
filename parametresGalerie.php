<html>
    <head>
       <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="css\styles.css" media="screen" type="text/css">
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

        <div id = carteParametresGalerie>
            <div id = carteText>
                <h5>Paramètres de la galerie</h5>
                    <div id = infoText>
                        <i>Les galeries servent à contenir les albums photos afin de les partager avec tout le monde, ou seulement à ceux qui ont la permission.
                            Partagez des photos, ou participez aux discussions sur celle-çi avec les personnes de votre choix !
                        </i>
                    </div>
                <h9>Changez le nom de la galerie :</h9>
                <textarea><?php echo $nomGalerie; ?></textarea> 
                <br></br>
                <h9>Selectionnez le paramètre de confidentialité :</h9>   
                <select>
                    <option  value="1">Galerie public</option>
                    <option  value="2">Galerie fermée</option>
                </select>
            </div>

                 <div id = buttonConfirmation>
            <button type="button" onclick="alert('Les changements ont été enregistrés')">Confirmer les changements!</button>
                 </div>
           <br></br>      
           <br></br>      
        <h9 id = lien>Lien de la galerie : www.Over-Cloud.com/h5Dh42</h9>
             
        </div>

    


        </div>
    </body>