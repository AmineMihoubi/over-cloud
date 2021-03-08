<html>
  <head>
    <meta charset="utf-8" />
    <!-- importer le fichier de style -->
    <link
      rel="stylesheet" href="css\styles.css" media="screen" type="text/css"/>
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
    <!-- Barre de navigation -->
    <div id = navigationBar>
        <ul>
            <h2><?php
             echo $nomGalerie;
             ?></h2>
            <li><a href="albums.php"><i class = icon-Album></i>Albums</a></li>
            <li><a href=""><i class = icon-Photo></i>Photos</a></li>
            <li><a href="parametresGalerie.php"><i class = icon-ParametresGalerie></i>Paramètres</a></li>
            <li><a href=""><i class = icon-Participants></i>Participants</a></li>
            <li id="paraUtilisateur"><a href="parametresUtilisateurs.php"><i class=icon-ParametresUtilisateur></i>
              <?php
                  $user = $_SESSION['nom'];
                  echo  $user;
              ?></a></li>
          </ul>
    </div>

    <div id = listeAlbums>
      <div class = carteAlbum>
      <img src="image/nophoto.jfif" alt="Pas d'image">
      <h4><b>Album blabla</b></h4>
      </div>     
      
      <div class = carteAlbum>
      <img src="image/nophoto.jfif" alt="Pas d'image">
      <h4><b>Album de voiture</b></h4>
      </div> 

    </div> 
  </body>