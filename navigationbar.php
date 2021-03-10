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

          <!-- Bare de navigation !-->

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
  