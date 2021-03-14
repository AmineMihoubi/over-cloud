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
        
        <?php
         session_start();
         require 'ConnectDb.php';

        ?>
        
        <!-- bare de navigation-->
        <div id = navigationBar></div>
        <script>
        $(function(){
        $("#navigationBar").load("navigationbar.php");
        });
        </script>

    <div id = listeAlbums>
      <?php
        $db = ConnectDb::getInstance();
        $sql = "SELECT id_album,nom FROM album where fk_id_galerie = (select fk_id_galerie from utilisateur_galerie where fk_id_utilisateur like '{$_SESSION['idUtilisateur']}')";
        $result = mysqli_query($db,$sql);


        while($row =  mysqli_fetch_array($result)) {
          $idAlbum = $row['id_album'];
          $nom = $row['nom'];
          echo "<script> ajouterAlbums(","'$idAlbum',","'$nom',",");</script>"; 

        }
      ?>
    </div> 
  </body>