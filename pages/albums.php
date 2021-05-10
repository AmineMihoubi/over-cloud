<?php
session_start();
require '../php/ConnectDb.php';
if ($_GET['id'] != null) {
  $_SESSION['idGalerie'] = $_GET['id'];
  $_SESSION['urlPrecedent'] = $_SERVER['REQUEST_URI'];
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <!-- importer le fichier de style -->
  <link rel="stylesheet" href="../css/styles.css" media="screen" type="text/css" />
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>

<body>
  <div>
    <!-- bare de navigation-->
    <div id=navigationBar></div>
    <script>
      $(function() {
        $("#navigationBar").load("navigationbar.php");
      });
    </script>

    <?php
    if (!isset($_SESSION['idUtilisateur']) || empty($_SESSION['idUtilisateur'])) {
      header('Location: ../index.php');
    }

    if ($_GET['id'] != null) {
      $_SESSION['idGalerie'] = $_GET['id'];
    }
    ?>

        <div class="container">
        <?php
        $id = $_SESSION['idGalerie'];
        $db = ConnectDb::getInstance();

        $typeSql = "SELECT prive FROM galerie where id_galerie = '$id'";
        $resultType = mysqli_query($db, $typeSql);
        $row1 =  mysqli_fetch_array($resultType);
        $typeAlbum = $row1['prive'];

        if ($typeAlbum == 1) {
          $ownerSQL = "SELECT fk_id_utilisateur FROM utilisateur_galerie where fk_id_galerie = '$id'";
          $resultOwner = mysqli_query($db, $ownerSQL);
          $row2 =  mysqli_fetch_array($resultOwner);
          $ownerID = $row2['fk_id_utilisateur'];
          if ($_SESSION['idUtilisateur'] != $ownerID) {
            header('Location: 404.php');
          }
        }

        $sql = "SELECT id_album, nom FROM album where fk_id_galerie = '$id'";
        $result = mysqli_query($db, $sql);
        ?>

        <div class="display">
          <?php
          $id = $_SESSION['idGalerie'];
          $sql = "SELECT id_album, nom FROM album where fk_id_galerie = '$id'";
          $result = mysqli_query($db, $sql);

          while ($row =  mysqli_fetch_array($result)) {
            $idAlbum = $row['id_album'];
            $nom = $row['nom'];

            echo "
            <a href='photoAlbum?id=$idAlbum'>
                <div class = card>
                <img src= ../image/album.png> 
                <h3>$nom</h3>
               
                </div> </a>";
          }
          ?>
          <a href='creation-album.php'>
            <div class=creation>
              <h1>+</h1>
            </div></a>
          
        </div>
    </div>
  </div>

</body>