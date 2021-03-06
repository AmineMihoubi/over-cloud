<html>
  <head>
    <meta charset="utf-8" />
    <!-- importer le fichier de style -->
    <link
      rel="stylesheet" href="css\styles.css" media="screen" type="text/css"/>
  </head>

  <body>
    <!-- Barre de navigation -->
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