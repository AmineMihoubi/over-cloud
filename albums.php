<html>
  <head>
    <meta charset="utf-8" />
    <!-- importer le fichier de style -->
    <link
      rel="stylesheet" href="css\styles.css" media="screen" type="text/css"/>
      <script src= "js/album.js"></script>
      <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  </head>

  <body>
        <!-- bare de navigation-->
        <?php
         session_start();
         require 'ConnectDb.php';
        ?>
        <div id = navigationBar></div>
        <script>
        $(function(){
        $("#navigationBar").load("navigationbar.php");
        });
        </script>

    <div id = listeAlbums>
      <?php
        $db = ConnectDb::getInstance();
        $sql = "SELECT id_album,nom FROM album where fk_id_galerie = 1";
        $result = mysqli_query($db,$sql);

        while($row =  mysqli_fetch_array($result)) {
          $idAlbum = $row['id_album'];
          $nom = $row['nom'];
          echo "<script> ajouterAlbums(","'$idAlbum',","'$nom',",");</script>"; 

        }
      ?>
    </div> 
  </body>